const { spawn } = require("child_process")
const WebSocket = require("ws")
const ffmpegPath = require("ffmpeg-static")
const url = require("url")

class RTSPStreamingServer {
  constructor(port = 9999) {
    this.port = port
    this.activeStreams = new Map() // Map<rtspUrl, {ffmpeg, clients}>
    this.wss = null
  }

  start() {
    // Create WebSocket server
    this.wss = new WebSocket.Server({
      port: this.port,
      perMessageDeflate: false,
      maxPayload: 1024 * 1024 * 10, // 10MB max payload
    })

    console.log(`🚀 RTSP WebSocket server started on port ${this.port}`)

    this.wss.on("connection", (ws, req) => {
      const query = url.parse(req.url, true).query
      const rtspUrl = query.rtsp
      const cameraId = query.cameraId || "unknown"

      console.log(`📹 New client connected for camera ${cameraId}`)
      console.log(`🔗 RTSP URL: ${rtspUrl}`)

      if (!rtspUrl) {
        console.error("❌ No RTSP URL provided")
        ws.close(1008, "RTSP URL required")
        return
      }

      // Store client info
      ws.rtspUrl = rtspUrl
      ws.cameraId = cameraId
      ws.isAlive = true

      // Setup ping/pong for connection health
      ws.on("pong", () => {
        ws.isAlive = true
      })

      // Get or create stream
      this.getOrCreateStream(rtspUrl, cameraId, ws)

      // Handle WebSocket close
      ws.on("close", (code, reason) => {
        console.log(`📱 Client disconnected for camera ${cameraId}: ${code} ${reason}`)
        this.handleClientDisconnect(ws)
      })

      ws.on("error", (err) => {
        console.error(`❌ WebSocket error for camera ${cameraId}:`, err)
        this.handleClientDisconnect(ws)
      })
    })

    // Setup heartbeat to detect broken connections
    const heartbeat = setInterval(() => {
      this.wss.clients.forEach((ws) => {
        if (!ws.isAlive) {
          console.log(`💔 Terminating dead connection for camera ${ws.cameraId}`)
          return ws.terminate()
        }
        ws.isAlive = false
        ws.ping()
      })
    }, 30000) // Check every 30 seconds

    this.wss.on("close", () => {
      clearInterval(heartbeat)
    })

    // Cleanup on process exit
    process.on("SIGINT", this.cleanup.bind(this))
    process.on("SIGTERM", this.cleanup.bind(this))
  }

  getOrCreateStream(rtspUrl, cameraId, ws) {
    let streamInfo = this.activeStreams.get(rtspUrl)

    if (!streamInfo || streamInfo.ffmpeg.killed) {
      // Create new FFmpeg process
      console.log(`🎬 Starting new FFmpeg process for camera ${cameraId}`)

      // Simple FFmpeg args based on source-stream-camera-success
      const ffmpegArgs = [
        // Input options - basic and compatible
        "-rtsp_transport",
        "tcp",
        "-i",
        rtspUrl,

        // Video processing - simple and stable
        "-c:v",
        "libx264",
        "-preset",
        "ultrafast",
        "-tune",
        "zerolatency",
        "-pix_fmt",
        "yuv420p",
        "-profile:v",
        "baseline",
        "-level",
        "3.1",
        "-s",
        "640x480",
        "-r",
        "15",
        "-b:v",
        "500k",
        "-maxrate",
        "600k",
        "-bufsize",
        "1200k",
        "-g",
        "30",
        "-keyint_min",
        "15",
        "-an", // No audio

        // Output options - MP4 fragmented for streaming
        "-f",
        "mp4",
        "-movflags",
        "empty_moov+default_base_moof+frag_keyframe",
        "pipe:1",
      ]

      console.log(`🔧 FFmpeg command: ${ffmpegPath} ${ffmpegArgs.join(" ")}`)

      const ffmpeg = spawn(ffmpegPath, ffmpegArgs, {
        stdio: ["ignore", "pipe", "pipe"],
      })

      streamInfo = {
        ffmpeg: ffmpeg,
        clients: new Set(),
        lastData: null,
        startTime: Date.now(),
        restartCount: 0,
        isRestarting: false,
      }

      this.activeStreams.set(rtspUrl, streamInfo)

      // Handle FFmpeg stdout (video data)
      ffmpeg.stdout.on("data", (chunk) => {
        streamInfo.lastData = chunk
        // Broadcast to all clients for this stream
        streamInfo.clients.forEach((client) => {
          if (client.readyState === WebSocket.OPEN) {
            try {
              client.send(chunk)
            } catch (err) {
              console.error("❌ Error sending data to client:", err)
              streamInfo.clients.delete(client)
            }
          } else {
            // Remove dead clients
            streamInfo.clients.delete(client)
          }
        })
      })

      // Handle FFmpeg stderr (logs)
      ffmpeg.stderr.on("data", (chunk) => {
        const error = chunk.toString()

        // Skip frame progress logs and version info
        if (
          error.includes("frame=") ||
          error.includes("fps=") ||
          error.includes("time=") ||
          error.includes("bitrate=") ||
          error.includes("speed=") ||
          error.includes("dup=") ||
          error.includes("drop=") ||
          error.includes("ffmpeg version") ||
          error.includes("built with") ||
          error.includes("configuration:") ||
          error.includes("libav") ||
          error.includes("libsw") ||
          error.includes("libpostproc") ||
          error.includes("-vsync is deprecated")
        ) {
          return
        }

        console.log(`📺 FFmpeg [${cameraId}]:`, error.trim())

        // Check for critical errors that require restart
        if (
          error.includes("Connection refused") ||
          error.includes("No route to host") ||
          error.includes("Connection timed out") ||
          error.includes("Server returned 4") ||
          error.includes("Server returned 5") ||
          error.includes("Invalid data found") ||
          error.includes("method SETUP failed") ||
          error.includes("RTSP connection failed") ||
          error.includes("Protocol not found") ||
          error.includes("End of file") ||
          (error.includes("Option") && error.includes("not found"))
        ) {
          console.error(`💥 Critical error for camera ${cameraId}: ${error.trim()}`)

          // Kill process to trigger restart
          setTimeout(() => {
            if (!ffmpeg.killed && streamInfo.clients.size > 0) {
              console.log(`🔄 Killing process to restart for camera ${cameraId}`)
              ffmpeg.kill("SIGTERM")
            }
          }, 2000)
        }
      })

      ffmpeg.on("exit", (code, signal) => {
        console.log(`🔚 FFmpeg process for camera ${cameraId} exited with code ${code}, signal ${signal}`)

        // Clean exit or manual kill - don't restart
        if (code === 0 || signal === "SIGKILL") {
          console.log(`✅ Clean exit for camera ${cameraId}, not restarting`)
          this.activeStreams.delete(rtspUrl)
          return
        }

        // Prevent multiple restart attempts
        if (streamInfo.isRestarting) {
          console.log(`⚠️ Already restarting camera ${cameraId}, skipping...`)
          return
        }

        // Only auto-restart if there are still clients and restart count is reasonable
        if (streamInfo.clients.size > 0 && streamInfo.restartCount < 3) {
          streamInfo.isRestarting = true
          streamInfo.restartCount++
          const delay = 3000 + streamInfo.restartCount * 2000 // 3s, 5s, 7s

          console.log(
            `🔄 Auto-restarting FFmpeg for camera ${cameraId} in ${delay}ms (attempt ${streamInfo.restartCount}/3)...`,
          )

          setTimeout(() => {
            if (streamInfo.clients.size > 0 && streamInfo.isRestarting) {
              // Create new stream info to avoid reference issues
              this.activeStreams.delete(rtspUrl)

              // Get first client to restart stream
              const firstClient = Array.from(streamInfo.clients)[0]
              if (firstClient && firstClient.readyState === WebSocket.OPEN) {
                this.getOrCreateStream(rtspUrl, cameraId, firstClient)
              }
            }
          }, delay)
        } else {
          console.log(
            `❌ Not restarting FFmpeg for camera ${cameraId} (clients: ${streamInfo.clients.size}, restarts: ${streamInfo.restartCount})`,
          )
          this.activeStreams.delete(rtspUrl)
        }
      })

      ffmpeg.on("error", (err) => {
        console.error(`💥 FFmpeg process error for camera ${cameraId}:`, err)
        this.activeStreams.delete(rtspUrl)
      })
    }

    // Add client to stream
    streamInfo.clients.add(ws)
    console.log(`👥 Added client to stream. Total clients: ${streamInfo.clients.size}`)

    // Send last data if available (for faster initial display)
    if (streamInfo.lastData && ws.readyState === WebSocket.OPEN) {
      try {
        ws.send(streamInfo.lastData)
      } catch (err) {
        console.error("❌ Error sending initial data:", err)
      }
    }
  }

  handleClientDisconnect(ws) {
    const rtspUrl = ws.rtspUrl
    if (!rtspUrl) return

    const streamInfo = this.activeStreams.get(rtspUrl)
    if (streamInfo) {
      streamInfo.clients.delete(ws)
      console.log(`👋 Removed client from stream. Remaining clients: ${streamInfo.clients.size}`)

      // Kill stream if no more clients after a delay
      if (streamInfo.clients.size === 0) {
        setTimeout(() => {
          const currentStreamInfo = this.activeStreams.get(rtspUrl)
          if (currentStreamInfo && currentStreamInfo.clients.size === 0) {
            console.log(`🗑️ No more clients for ${rtspUrl}, killing stream`)
            this.killStream(rtspUrl)
          }
        }, 15000) // Wait 15 seconds before killing
      }
    }
  }

  killStream(rtspUrl) {
    const streamInfo = this.activeStreams.get(rtspUrl)
    if (streamInfo && !streamInfo.ffmpeg.killed) {
      console.log(`🔪 Killing FFmpeg process for ${rtspUrl}`)
      streamInfo.ffmpeg.kill("SIGKILL")
    }
    this.activeStreams.delete(rtspUrl)
  }

  cleanup() {
    console.log("🧹 Shutting down RTSP streaming server...")

    // Kill all FFmpeg processes
    for (const [rtspUrl, streamInfo] of this.activeStreams) {
      console.log(`🔪 Killing FFmpeg process for ${rtspUrl}`)
      if (!streamInfo.ffmpeg.killed) {
        streamInfo.ffmpeg.kill("SIGKILL")
      }
    }

    this.activeStreams.clear()

    if (this.wss) {
      this.wss.close()
    }
  }

  stop() {
    this.cleanup()
  }
}

module.exports = RTSPStreamingServer
