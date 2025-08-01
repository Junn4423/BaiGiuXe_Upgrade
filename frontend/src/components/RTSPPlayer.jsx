"use client"

import { useEffect, useRef, useState, useCallback } from "react"

const RTSPPlayer = ({ rtspUrl, cameraId, width = 320, height = 240, onError, onConnected, className = "", cameraType }) => {
  const videoRef = useRef(null)
  const wsRef = useRef(null)
  const mediaSourceRef = useRef(null)
  const sourceBufferRef = useRef(null)
  const queueRef = useRef([])
  const [isConnected, setIsConnected] = useState(false)
  const [error, setError] = useState(null)
  const isInitializedRef = useRef(false) // Use ref instead of state
  const [hasVideoData, setHasVideoData] = useState(false)
  const reconnectTimeoutRef = useRef(null)
  const reconnectAttemptsRef = useRef(0)
  const maxReconnectAttempts = 3
  const mountedRef = useRef(true)
  const initializingRef = useRef(false)

  // Stable references to prevent re-renders
  const stableRtspUrl = useRef(rtspUrl)
  const stableCameraId = useRef(cameraId)

  // Update refs when props change
  useEffect(() => {
    stableRtspUrl.current = rtspUrl
    stableCameraId.current = cameraId
  }, [rtspUrl, cameraId])

  // Memoize callbacks để tránh re-render
  const handleConnected = useCallback(() => {
    onConnected?.()
  }, [onConnected])

  const handleError = useCallback(
    (errorMsg) => {

      onError?.(errorMsg)
    },
    [onError],
  )

  useEffect(() => {
    // Prevent multiple initializations
    if (initializingRef.current) {

      return
    }

    mountedRef.current = true


    if (!rtspUrl) {

      setError("No RTSP URL provided")
      return
    }

    if (!rtspUrl.startsWith("rtsp://")) {

      setError("Invalid RTSP URL format")
      return
    }

  
    initializingRef.current = true
    reconnectAttemptsRef.current = 0
    isInitializedRef.current = false // Reset initialization flag

    const connectWebSocket = () => {
      if (!mountedRef.current || !initializingRef.current) return

      try {
        // Clear any existing reconnect timeout
        if (reconnectTimeoutRef.current) {
          clearTimeout(reconnectTimeoutRef.current)
          reconnectTimeoutRef.current = null
        }

        // Generate WebSocket URL with RTSP URL and camera ID
        const wsUrl = `ws://localhost:9999/?rtsp=${encodeURIComponent(stableRtspUrl.current)}&cameraId=${encodeURIComponent(stableCameraId.current || "unknown")}`

        const ws = new WebSocket(wsUrl)
        wsRef.current = ws
        ws.binaryType = "arraybuffer"

        // Add connection timeout
        const connectionTimeout = setTimeout(() => {
          if (ws.readyState === WebSocket.CONNECTING) {

            ws.close()
            if (mountedRef.current && initializingRef.current) {
              setError("Connection timeout - Check Electron app")
              handleError("Connection timeout - Check Electron app")
            }
          }
        }, 15000) // 15 second timeout

        ws.onopen = () => {
          if (!mountedRef.current || !initializingRef.current) return

          clearTimeout(connectionTimeout)

          setIsConnected(true)
          setError(null)
          reconnectAttemptsRef.current = 0 // Reset reconnect attempts on successful connection
          handleConnected()
        }

        ws.onerror = (e) => {
          clearTimeout(connectionTimeout)

          if (mountedRef.current && initializingRef.current) {
            setError("WebSocket connection error")
            setIsConnected(false)
            handleError("WebSocket connection error")
          }
        }

        ws.onclose = (e) => {
          clearTimeout(connectionTimeout)

          if (!mountedRef.current || !initializingRef.current) return

          setIsConnected(false)

          // Auto-reconnect with exponential backoff, but only if component is still mounted
          if (e.code !== 1000 && stableRtspUrl.current && reconnectAttemptsRef.current < maxReconnectAttempts) {
            const delay = Math.min(10000 * Math.pow(2, reconnectAttemptsRef.current), 60000) // Max 60 seconds

            reconnectTimeoutRef.current = setTimeout(() => {
              if (mountedRef.current && initializingRef.current) {
                reconnectAttemptsRef.current++
                connectWebSocket()
              }
            }, delay)
          } else if (reconnectAttemptsRef.current >= maxReconnectAttempts) {
            setError(`Max reconnection attempts reached (${maxReconnectAttempts})`)
            handleError(`Max reconnection attempts reached (${maxReconnectAttempts})`)
          }
        }

        ws.onmessage = (ev) => {
          if (!mountedRef.current || !initializingRef.current) return

          try {
            const chunk = new Uint8Array(ev.data)
            const sourceBuffer = sourceBufferRef.current
            if (!sourceBuffer) {
              return
            }

            if (!isInitializedRef.current) {
              return
            }

            // Limit queue size to prevent memory issues
            if (queueRef.current.length > 5) {
              queueRef.current = queueRef.current.slice(-2) // Keep only last 2 chunks
            }

            // Queue the chunk
            queueRef.current.push(chunk)

            // Process queue if not updating
            if (!sourceBuffer.updating && queueRef.current.length > 0) {
              try {
                const nextChunk = queueRef.current.shift()

                sourceBuffer.appendBuffer(nextChunk)
              } catch (err) {

                queueRef.current = []
              }
            }
          } catch (err) {
          }
        }
      } catch (err) {
        if (mountedRef.current && initializingRef.current) {
          setError(err.message)
          handleError(err.message)
        }
      }
    }

    const initializePlayer = async () => {
      if (!mountedRef.current || !initializingRef.current) return

      try {
        const video = videoRef.current
        if (!video) {
          // Retry after a short delay
          setTimeout(() => {
            if (mountedRef.current && initializingRef.current) {
              initializePlayer()
            }
          }, 100)
          return
        }

        // Reset state
        setIsConnected(false)
        setError(null)
        isInitializedRef.current = false
        setHasVideoData(false)
        queueRef.current = []

        // Check MediaSource support
        if (!window.MediaSource) {
          const errorMsg = "MediaSource not supported"
          console.error(errorMsg)
          setError(errorMsg)
          handleError(errorMsg)
          return
        }

        // Clean up any existing MediaSource
        if (mediaSourceRef.current) {
          try {
            if (mediaSourceRef.current.readyState === "open") {
              mediaSourceRef.current.endOfStream()
            }
          } catch (err) {
          }
        }

        // Create new MediaSource
        const mediaSource = new MediaSource()
        mediaSourceRef.current = mediaSource


        // Handle MediaSource events
        const handleSourceOpen = () => {
          if (!mountedRef.current || !initializingRef.current) {
            return
          }
          const mime = 'video/mp4; codecs="avc1.42E01E"'

          if (!MediaSource.isTypeSupported(mime)) {
            const errorMsg = `Unsupported MIME type: ${mime}`
            console.error(errorMsg)
            setError(errorMsg)
            handleError(errorMsg)
            return
          }

          try {

            const sourceBuffer = mediaSource.addSourceBuffer(mime)
            sourceBufferRef.current = sourceBuffer


            isInitializedRef.current = true // Use ref instead of state


            // Handle buffer updates
            const handleUpdateEnd = () => {
              if (!mountedRef.current || !initializingRef.current) return



              // Mark that we have video data
              if (!hasVideoData) {

                setHasVideoData(true)
              }

              // Process next chunk in queue
              if (queueRef.current.length > 0 && !sourceBuffer.updating) {
                try {
                  const nextChunk = queueRef.current.shift()

                  sourceBuffer.appendBuffer(nextChunk)
                } catch (err) {

                  queueRef.current = []
                }
              }
            }

            const handleSourceBufferError = (e) => {

              queueRef.current = []
            }

            sourceBuffer.addEventListener("updateend", handleUpdateEnd)
            sourceBuffer.addEventListener("error", handleSourceBufferError)

            // Connect to WebSocket after SourceBuffer is ready
            console.log(`🔌 SourceBuffer ready, connecting WebSocket for camera ${cameraId}`)
            connectWebSocket()
          } catch (err) {

            setError(err.message)
            handleError(err.message)
          }
        }

        const handleSourceClose = () => {

        }

        const handleSourceEnded = () => {

        }

        const handleSourceError = (e) => {

          setError("MediaSource error")
          handleError("MediaSource error")
        }

        // Add event listeners
        mediaSource.addEventListener("sourceopen", handleSourceOpen)
        mediaSource.addEventListener("sourceclose", handleSourceClose)
        mediaSource.addEventListener("sourceended", handleSourceEnded)
        mediaSource.addEventListener("error", handleSourceError)

        // Set video src to MediaSource object URL
        const objectURL = URL.createObjectURL(mediaSource)

        video.src = objectURL

        // Add video event listeners for debugging
        const handleLoadStart = () => {

        }

        const handleLoadedMetadata = () => {

        }

        const handleCanPlay = () => {

        }

        const handlePlaying = () => {

        }

        const handleVideoError = (e) => {

        }

        video.addEventListener("loadstart", handleLoadStart)
        video.addEventListener("loadedmetadata", handleLoadedMetadata)
        video.addEventListener("canplay", handleCanPlay)
        video.addEventListener("playing", handlePlaying)
        video.addEventListener("error", handleVideoError)

        // Check if MediaSource is already open (race condition)
        if (mediaSource.readyState === "open") {

          setTimeout(() => handleSourceOpen(), 0)
        }

        // Timeout fallback if sourceopen doesn't fire
        setTimeout(() => {
          if (mountedRef.current && initializingRef.current && !isInitializedRef.current) {


            // If MediaSource is open but SourceBuffer not created, force create it
            if (mediaSource.readyState === "open" && !sourceBufferRef.current) {

              handleSourceOpen()
            } else {
              setError("MediaSource initialization timeout")
              handleError("MediaSource initialization timeout")
            }
          }
        }, 5000) // 5 second timeout
      } catch (err) {

        setError(err.message)
        handleError(err.message)
      }
    }

    // Start initialization
    initializePlayer()

    return () => {
      console.log(`Cleaning up RTSP Player for camera ${cameraId}`)
      mountedRef.current = false
      initializingRef.current = false
      isInitializedRef.current = false

      // Clear reconnect timeout
      if (reconnectTimeoutRef.current) {
        clearTimeout(reconnectTimeoutRef.current)
        reconnectTimeoutRef.current = null
      }

      // Close WebSocket
      if (wsRef.current) {
        wsRef.current.close(1000, "Component unmounting")
      }

      // Clean up MediaSource
      if (mediaSourceRef.current && mediaSourceRef.current.readyState === "open") {
        try {
          mediaSourceRef.current.endOfStream()
        } catch (err) {
          console.warn(`Error ending media source for camera ${cameraId}:`, err)
        }
      }

      // Clean up video
      if (videoRef.current) {
        videoRef.current.src = ""
      }

      // Reset refs
      queueRef.current = []
      reconnectAttemptsRef.current = 0
    }
  }, []) // Empty dependency array - only run once per mount

  return (
    <div className={`rtsp-player ${className}`} style={{ width, height, position: "relative" }}>
      <video
        ref={videoRef}
        autoPlay
        muted
        playsInline
        controls={false}
        data-camera-type={cameraType}
        style={{
          width: "100%",
          height: "100%",
          objectFit: "cover",
          background: "#000",
        }}
      />

      {/* Connection Status Overlay */}
      {(!isConnected || !hasVideoData) && (
        <div
          style={{
            position: "absolute",
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            background: "rgba(0,0,0,0.8)",
            display: "flex",
            flexDirection: "column",
            alignItems: "center",
            justifyContent: "center",
            color: "white",
            fontSize: "12px",
            textAlign: "center",
            padding: "10px",
          }}
        >
          {error ? (
            <div>
              <div style={{ fontSize: "16px", marginBottom: "8px" }}></div>
              <div style={{ fontWeight: "bold", marginBottom: "4px" }}>Connection Error</div>
              <div style={{ fontSize: "10px", opacity: 0.8 }}>{error}</div>
              <div style={{ fontSize: "10px", opacity: 0.6, marginTop: "4px" }}>Camera: {cameraId}</div>
              {reconnectAttemptsRef.current > 0 && (
                <div style={{ fontSize: "10px", opacity: 0.6, marginTop: "2px" }}>
                  Attempts: {reconnectAttemptsRef.current}/{maxReconnectAttempts}
                </div>
              )}
            </div>
          ) : isConnected && !hasVideoData ? (
            <div>
              <div style={{ fontSize: "16px", marginBottom: "8px" }}></div>
              <div style={{ fontWeight: "bold", marginBottom: "4px" }}>Loading Video...</div>
              <div style={{ fontSize: "10px", opacity: 0.8 }}>Processing video data</div>
              <div style={{ fontSize: "10px", opacity: 0.6, marginTop: "4px" }}>Camera: {cameraId}</div>
            </div>
          ) : (
            <div>
              <div style={{ fontSize: "16px", marginBottom: "8px" }}></div>
              <div style={{ fontWeight: "bold", marginBottom: "4px" }}>Connecting...</div>
              <div style={{ fontSize: "10px", opacity: 0.8 }}>Loading camera {cameraId}</div>
              <div style={{ fontSize: "10px", opacity: 0.6, marginTop: "4px" }}>
                RTSP: {rtspUrl?.substring(0, 30)}...
              </div>
              {reconnectAttemptsRef.current > 0 && (
                <div style={{ fontSize: "10px", opacity: 0.6, marginTop: "2px" }}>
                  Attempt: {reconnectAttemptsRef.current + 1}/{maxReconnectAttempts}
                </div>
              )}
            </div>
          )}
        </div>
      )}

      {/* Live Indicator */}
      {isConnected && hasVideoData && (
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

      {/* Camera Info */}
      {cameraId && (
        <div
          style={{
            position: "absolute",
            bottom: "8px",
            left: "8px",
            background: "rgba(0,0,0,0.7)",
            color: "white",
            padding: "2px 6px",
            borderRadius: "4px",
            fontSize: "10px",
          }}
        >
          {cameraId}
        </div>
      )}
    </div>
  )
}

export default RTSPPlayer
