"use client"

import { useEffect, useRef, useState } from "react"

const RTSPPlayer = ({ rtspUrl, width = 320, height = 240, onError, onConnected }) => {
  const videoRef = useRef(null)
  const wsRef = useRef(null)
  const mediaSourceRef = useRef(null)
  const sourceBufferRef = useRef(null)
  const queueRef = useRef([])
  const initChunksRef = useRef([])
  const [isConnected, setIsConnected] = useState(false)
  const [error, setError] = useState(null)
  const initAppendedRef = useRef(false)

  useEffect(() => {
    if (!rtspUrl) return

    const initializePlayer = () => {
      try {
        const video = videoRef.current
        if (!video) return

        // Create MediaSource
        const mediaSource = new MediaSource()
        mediaSourceRef.current = mediaSource
        video.src = URL.createObjectURL(mediaSource)

        mediaSource.addEventListener("sourceopen", () => {
          const mime = 'video/mp4; codecs="avc1.42E01E"'

          if (!MediaSource.isTypeSupported(mime)) {
            const errorMsg = `Unsupported MIME type: ${mime}`
            console.error(errorMsg)
            setError(errorMsg)
            onError?.(errorMsg)
            return
          }

          try {
            const sourceBuffer = mediaSource.addSourceBuffer(mime)
            sourceBufferRef.current = sourceBuffer

            // Handle buffer updates
            sourceBuffer.addEventListener("updateend", () => {
              if (queueRef.current.length > 0 && !sourceBuffer.updating) {
                try {
                  sourceBuffer.appendBuffer(queueRef.current.shift())
                } catch (err) {
                  console.error("Error appending buffer:", err)
                }
              }
            })

            // Connect to WebSocket
            connectWebSocket()
          } catch (err) {
            console.error("Error creating source buffer:", err)
            setError(err.message)
            onError?.(err.message)
          }
        })

        mediaSource.addEventListener("sourceclose", () => {
          console.log("MediaSource closed")
        })

        mediaSource.addEventListener("sourceended", () => {
          console.log("MediaSource ended")
        })
      } catch (err) {
        console.error("Error initializing player:", err)
        setError(err.message)
        onError?.(err.message)
      }
    }

    const connectWebSocket = () => {
      try {
        // Generate unique WebSocket URL for this camera
        const wsUrl = `ws://localhost:9999/?rtsp=${encodeURIComponent(rtspUrl)}`
        const ws = new WebSocket(wsUrl)
        wsRef.current = ws
        ws.binaryType = "arraybuffer"

        ws.onopen = () => {
          console.log(`[WS] Connected to ${rtspUrl}`)
          setIsConnected(true)
          setError(null)
          onConnected?.()
        }

        ws.onerror = (e) => {
          console.error("[WS] Error:", e)
          setError("WebSocket connection error")
          setIsConnected(false)
          onError?.("WebSocket connection error")
        }

        ws.onclose = (e) => {
          console.warn(`[WS] Closed: ${e.code} ${e.reason}`)
          setIsConnected(false)

          // Auto-reconnect after 3 seconds if not intentionally closed
          if (e.code !== 1000) {
            setTimeout(() => {
              if (rtspUrl) {
                console.log("Attempting to reconnect...")
                connectWebSocket()
              }
            }, 3000)
          }
        }

        ws.onmessage = (ev) => {
          try {
            const chunk = new Uint8Array(ev.data)
            const sourceBuffer = sourceBufferRef.current

            if (!sourceBuffer) return

            if (!initAppendedRef.current) {
              // Collect init segments until we see 'moov' or 'ftyp'
              initChunksRef.current.push(chunk)
              const txt = new TextDecoder("ascii").decode(chunk)

              if (txt.includes("moov") || txt.includes("ftyp")) {
                // Combine all init chunks
                const initBuf = initChunksRef.current.reduce((acc, c) => {
                  const tmp = new Uint8Array(acc.length + c.length)
                  tmp.set(acc, 0)
                  tmp.set(c, acc.length)
                  return tmp
                }, new Uint8Array(0))

                try {
                  sourceBuffer.appendBuffer(initBuf)
                  initAppendedRef.current = true
                  initChunksRef.current = []
                } catch (err) {
                  console.error("Error appending init buffer:", err)
                }
              }
            } else {
              // Queue normal chunks
              queueRef.current.push(chunk)
              if (!sourceBuffer.updating && queueRef.current.length > 0) {
                try {
                  sourceBuffer.appendBuffer(queueRef.current.shift())
                } catch (err) {
                  console.error("Error appending chunk:", err)
                }
              }
            }
          } catch (err) {
            console.error("Error processing message:", err)
          }
        }
      } catch (err) {
        console.error("Error connecting WebSocket:", err)
        setError(err.message)
        onError?.(err.message)
      }
    }

    initializePlayer()

    return () => {
      // Cleanup
      if (wsRef.current) {
        wsRef.current.close(1000, "Component unmounting")
      }
      if (mediaSourceRef.current && mediaSourceRef.current.readyState === "open") {
        try {
          mediaSourceRef.current.endOfStream()
        } catch (err) {
          console.warn("Error ending media source:", err)
        }
      }
      if (videoRef.current) {
        videoRef.current.src = ""
      }

      // Reset refs
      queueRef.current = []
      initChunksRef.current = []
      initAppendedRef.current = false
    }
  }, [rtspUrl, onError, onConnected])

  return (
    <div className="rtsp-player" style={{ width, height, position: "relative" }}>
      <video
        ref={videoRef}
        autoPlay
        muted
        playsInline
        style={{
          width: "100%",
          height: "100%",
          objectFit: "cover",
          background: "#000",
        }}
      />

      {/* Connection Status Overlay */}
      {!isConnected && (
        <div
          style={{
            position: "absolute",
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            background: "rgba(0,0,0,0.8)",
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
            color: "white",
            fontSize: "12px",
            textAlign: "center",
          }}
        >
          {error ? (
            <div>
              <div>❌ Connection Error</div>
              <div style={{ fontSize: "10px", marginTop: "4px" }}>{error}</div>
            </div>
          ) : (
            <div>
              <div>🔄 Connecting...</div>
              <div style={{ fontSize: "10px", marginTop: "4px" }}>Loading RTSP stream</div>
            </div>
          )}
        </div>
      )}

      {/* Live Indicator */}
      {isConnected && (
        <div
          style={{
            position: "absolute",
            top: "8px",
            right: "8px",
            background: "rgba(16, 185, 129, 0.9)",
            color: "white",
            padding: "2px 6px",
            borderRadius: "4px",
            fontSize: "10px",
            fontWeight: "bold",
          }}
        >
          ● LIVE
        </div>
      )}
    </div>
  )
}

export default RTSPPlayer
