"use client"

import { useEffect, useRef, useState, useCallback } from "react"

const RTSPPlayer = ({ rtspUrl, cameraId, width = 320, height = 240, onError, onConnected, className = "" }) => {
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
    console.log(`✅ Camera ${stableCameraId.current} connected successfully`)
    onConnected?.()
  }, [onConnected])

  const handleError = useCallback(
    (errorMsg) => {
      console.error(`❌ Camera ${stableCameraId.current} error: ${errorMsg}`)
      onError?.(errorMsg)
    },
    [onError],
  )

  useEffect(() => {
    // Prevent multiple initializations
    if (initializingRef.current) {
      console.log(`⚠️ Already initializing camera ${cameraId}, skipping...`)
      return
    }

    mountedRef.current = true
    console.log(`🎥 RTSPPlayer useEffect triggered for camera ${cameraId}`)
    console.log(`🔗 RTSP URL: ${rtspUrl}`)

    if (!rtspUrl) {
      console.log("❌ No RTSP URL provided")
      setError("No RTSP URL provided")
      return
    }

    if (!rtspUrl.startsWith("rtsp://")) {
      console.log("❌ Invalid RTSP URL format")
      setError("Invalid RTSP URL format")
      return
    }

    console.log(`✅ Starting RTSP Player initialization for camera ${cameraId}`)
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
        console.log(`🔌 Connecting to WebSocket for camera ${cameraId} (attempt ${reconnectAttemptsRef.current + 1})`)

        const ws = new WebSocket(wsUrl)
        wsRef.current = ws
        ws.binaryType = "arraybuffer"

        // Add connection timeout
        const connectionTimeout = setTimeout(() => {
          if (ws.readyState === WebSocket.CONNECTING) {
            console.error(`⏰ WebSocket connection timeout for camera ${cameraId}`)
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
          console.log(`✅ WebSocket connected for camera ${cameraId}`)
          setIsConnected(true)
          setError(null)
          reconnectAttemptsRef.current = 0 // Reset reconnect attempts on successful connection
          handleConnected()
        }

        ws.onerror = (e) => {
          clearTimeout(connectionTimeout)
          console.error(`❌ WebSocket error for camera ${cameraId}:`, e)
          if (mountedRef.current && initializingRef.current) {
            setError("WebSocket connection error")
            setIsConnected(false)
            handleError("WebSocket connection error")
          }
        }

        ws.onclose = (e) => {
          clearTimeout(connectionTimeout)
          console.warn(`🔌 WebSocket closed for camera ${cameraId}: ${e.code} ${e.reason}`)

          if (!mountedRef.current || !initializingRef.current) return

          setIsConnected(false)

          // Auto-reconnect with exponential backoff, but only if component is still mounted
          if (e.code !== 1000 && stableRtspUrl.current && reconnectAttemptsRef.current < maxReconnectAttempts) {
            const delay = Math.min(10000 * Math.pow(2, reconnectAttemptsRef.current), 60000) // Max 60 seconds
            console.log(
              `🔄 Scheduling reconnect for camera ${cameraId} in ${delay}ms (attempt ${reconnectAttemptsRef.current + 1}/${maxReconnectAttempts})`,
            )

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

            console.log(`📦 Received video chunk for camera ${cameraId}: ${chunk.length} bytes`)

            if (!sourceBuffer) {
              console.warn(`⚠️ SourceBuffer not available for camera ${cameraId}`)
              return
            }

            if (!isInitializedRef.current) {
              console.warn(`⚠️ SourceBuffer not initialized for camera ${cameraId}`)
              console.warn(`⚠️ isInitializedRef.current: ${isInitializedRef.current}`)
              return
            }

            // Limit queue size to prevent memory issues
            if (queueRef.current.length > 5) {
              console.warn(`⚠️ Queue too large for camera ${cameraId}, clearing old chunks`)
              queueRef.current = queueRef.current.slice(-2) // Keep only last 2 chunks
            }

            // Queue the chunk
            queueRef.current.push(chunk)

            // Process queue if not updating
            if (!sourceBuffer.updating && queueRef.current.length > 0) {
              try {
                const nextChunk = queueRef.current.shift()
                console.log(`📽️ Appending video chunk for camera ${cameraId}: ${nextChunk.length} bytes`)
                sourceBuffer.appendBuffer(nextChunk)
              } catch (err) {
                console.error(`❌ Error appending buffer for camera ${cameraId}:`, err)
                queueRef.current = []
              }
            }
          } catch (err) {
            console.error(`❌ Error processing WebSocket message for camera ${cameraId}:`, err)
          }
        }
      } catch (err) {
        console.error(`❌ Error connecting WebSocket for camera ${cameraId}:`, err)
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
          console.error(`❌ Video element not found for camera ${cameraId}`)
          // Retry after a short delay
          setTimeout(() => {
            if (mountedRef.current && initializingRef.current) {
              initializePlayer()
            }
          }, 100)
          return
        }

        console.log(`🎥 Video element ready for camera ${cameraId}`)
        console.log(`🎥 Video readyState: ${video.readyState}`)

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

        console.log(`🔧 Creating MediaSource for camera ${cameraId}`)

        // Clean up any existing MediaSource
        if (mediaSourceRef.current) {
          try {
            if (mediaSourceRef.current.readyState === "open") {
              mediaSourceRef.current.endOfStream()
            }
          } catch (err) {
            console.warn(`⚠️ Error cleaning up old MediaSource: ${err}`)
          }
        }

        // Create new MediaSource
        const mediaSource = new MediaSource()
        mediaSourceRef.current = mediaSource

        console.log(`📺 MediaSource created, readyState: ${mediaSource.readyState}`)

        // Handle MediaSource events
        const handleSourceOpen = () => {
          if (!mountedRef.current || !initializingRef.current) {
            console.log(`⚠️ Component unmounted during sourceopen for camera ${cameraId}`)
            return
          }

          console.log(`📺 MediaSource opened for camera ${cameraId}`)
          console.log(`📺 MediaSource readyState: ${mediaSource.readyState}`)

          const mime = 'video/mp4; codecs="avc1.42E01E"'
          console.log(`🎬 Checking MIME support: ${mime}`)

          if (!MediaSource.isTypeSupported(mime)) {
            const errorMsg = `Unsupported MIME type: ${mime}`
            console.error(errorMsg)
            setError(errorMsg)
            handleError(errorMsg)
            return
          }

          try {
            console.log(`🎬 Creating SourceBuffer for camera ${cameraId}`)
            const sourceBuffer = mediaSource.addSourceBuffer(mime)
            sourceBufferRef.current = sourceBuffer

            console.log(`✅ SourceBuffer created successfully for camera ${cameraId}`)
            isInitializedRef.current = true // Use ref instead of state
            console.log(`✅ isInitializedRef.current set to: ${isInitializedRef.current}`)

            // Handle buffer updates
            const handleUpdateEnd = () => {
              if (!mountedRef.current || !initializingRef.current) return

              console.log(`🔄 SourceBuffer updateend for camera ${cameraId}`)

              // Mark that we have video data
              if (!hasVideoData) {
                console.log(`🎬 First video data processed for camera ${cameraId}`)
                setHasVideoData(true)
              }

              // Process next chunk in queue
              if (queueRef.current.length > 0 && !sourceBuffer.updating) {
                try {
                  const nextChunk = queueRef.current.shift()
                  console.log(`📽️ Processing next queued chunk for camera ${cameraId}: ${nextChunk.length} bytes`)
                  sourceBuffer.appendBuffer(nextChunk)
                } catch (err) {
                  console.error(`❌ Error appending queued buffer for camera ${cameraId}:`, err)
                  queueRef.current = []
                }
              }
            }

            const handleSourceBufferError = (e) => {
              console.error(`❌ SourceBuffer error for camera ${cameraId}:`, e)
              queueRef.current = []
            }

            sourceBuffer.addEventListener("updateend", handleUpdateEnd)
            sourceBuffer.addEventListener("error", handleSourceBufferError)

            // Connect to WebSocket after SourceBuffer is ready
            console.log(`🔌 SourceBuffer ready, connecting WebSocket for camera ${cameraId}`)
            connectWebSocket()
          } catch (err) {
            console.error(`❌ Error creating source buffer for camera ${cameraId}:`, err)
            setError(err.message)
            handleError(err.message)
          }
        }

        const handleSourceClose = () => {
          console.log(`📺 MediaSource closed for camera ${cameraId}`)
        }

        const handleSourceEnded = () => {
          console.log(`📺 MediaSource ended for camera ${cameraId}`)
        }

        const handleSourceError = (e) => {
          console.error(`📺 MediaSource error for camera ${cameraId}:`, e)
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
        console.log(`🔗 Setting video src to: ${objectURL} for camera ${cameraId}`)
        video.src = objectURL

        // Add video event listeners for debugging
        const handleLoadStart = () => {
          console.log(`📹 Video loadstart for camera ${cameraId}`)
        }

        const handleLoadedMetadata = () => {
          console.log(`📹 Video metadata loaded for camera ${cameraId}`)
          console.log(`📹 Video dimensions: ${video.videoWidth}x${video.videoHeight}`)
          console.log(`📹 Video duration: ${video.duration}`)
        }

        const handleCanPlay = () => {
          console.log(`📹 Video can play for camera ${cameraId}`)
        }

        const handlePlaying = () => {
          console.log(`📹 Video playing for camera ${cameraId}`)
        }

        const handleVideoError = (e) => {
          console.error(`📹 Video error for camera ${cameraId}:`, e)
          console.error(`📹 Video error code: ${video.error?.code}`)
          console.error(`📹 Video error message: ${video.error?.message}`)
        }

        video.addEventListener("loadstart", handleLoadStart)
        video.addEventListener("loadedmetadata", handleLoadedMetadata)
        video.addEventListener("canplay", handleCanPlay)
        video.addEventListener("playing", handlePlaying)
        video.addEventListener("error", handleVideoError)

        // Check if MediaSource is already open (race condition)
        if (mediaSource.readyState === "open") {
          console.log(`📺 MediaSource already open for camera ${cameraId}, calling handler directly`)
          setTimeout(() => handleSourceOpen(), 0)
        }

        // Timeout fallback if sourceopen doesn't fire
        setTimeout(() => {
          if (mountedRef.current && initializingRef.current && !isInitializedRef.current) {
            console.error(`⏰ MediaSource sourceopen timeout for camera ${cameraId}`)
            console.error(`📺 MediaSource readyState: ${mediaSource.readyState}`)
            console.error(`📹 Video readyState: ${video.readyState}`)
            console.error(`📹 Video src: ${video.src}`)

            // If MediaSource is open but SourceBuffer not created, force create it
            if (mediaSource.readyState === "open" && !sourceBufferRef.current) {
              console.log(`🔧 Force creating SourceBuffer for camera ${cameraId}`)
              handleSourceOpen()
            } else {
              setError("MediaSource initialization timeout")
              handleError("MediaSource initialization timeout")
            }
          }
        }, 5000) // 5 second timeout
      } catch (err) {
        console.error(`❌ Error initializing player for camera ${cameraId}:`, err)
        setError(err.message)
        handleError(err.message)
      }
    }

    // Start initialization
    initializePlayer()

    return () => {
      console.log(`🧹 Cleaning up RTSP Player for camera ${cameraId}`)
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
          console.warn(`⚠️ Error ending media source for camera ${cameraId}:`, err)
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
              <div style={{ fontSize: "16px", marginBottom: "8px" }}>❌</div>
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
              <div style={{ fontSize: "16px", marginBottom: "8px" }}>📺</div>
              <div style={{ fontWeight: "bold", marginBottom: "4px" }}>Loading Video...</div>
              <div style={{ fontSize: "10px", opacity: 0.8 }}>Processing video data</div>
              <div style={{ fontSize: "10px", opacity: 0.6, marginTop: "4px" }}>Camera: {cameraId}</div>
            </div>
          ) : (
            <div>
              <div style={{ fontSize: "16px", marginBottom: "8px" }}>🔄</div>
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
