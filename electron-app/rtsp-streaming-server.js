const { spawn } = require("child_process");
const WebSocket = require("ws");
const path = require("path");
const fs = require("fs");

// Handle ffmpeg path for both development and production
let ffmpegPath;
try {
  console.log("🔍 [DEBUG] Initializing FFmpeg path resolution...");
  console.log("🔍 [DEBUG] NODE_ENV:", process.env.NODE_ENV);
  console.log("🔍 [DEBUG] __dirname:", __dirname);
  console.log("🔍 [DEBUG] process.resourcesPath:", process.resourcesPath);

  // In development, use ffmpeg-static
  if (process.env.NODE_ENV === "development") {
    ffmpegPath = require("ffmpeg-static");
    console.log("🔍 [DEBUG] Using development FFmpeg:", ffmpegPath);
  } else {
    console.log("🔍 [DEBUG] Production mode - checking for packaged FFmpeg...");

    // Try multiple possible paths for packaged app - PRIORITIZE app.asar.unpacked paths
    const possiblePaths = [
      // FIRST: ASAR unpacked paths (these can be executed)
      ...(process.resourcesPath
        ? [
            path.join(
              process.resourcesPath,
              "app.asar.unpacked",
              "ffmpeg-binary",
              "ffmpeg.exe"
            ),
            path.join(
              process.resourcesPath,
              "app.asar.unpacked",
              "node_modules",
              "ffmpeg-static",
              "ffmpeg.exe"
            ),
            path.join(
              process.resourcesPath,
              "app.asar.unpacked",
              "node_modules",
              "ffmpeg-static",
              "bin",
              "win32",
              "x64",
              "ffmpeg.exe"
            ),
            path.join(process.resourcesPath, "ffmpeg.exe"),
          ]
        : []),

      // SECOND: Development-style paths (for when running from source)
      path.join(__dirname, "ffmpeg-binary", "ffmpeg.exe"),
      path.join(__dirname, "node_modules", "ffmpeg-static", "ffmpeg.exe"),
      path.join(
        __dirname,
        "node_modules",
        "ffmpeg-static",
        "bin",
        "win32",
        "x64",
        "ffmpeg.exe"
      ),

      // LAST: System ffmpeg as fallback
      "ffmpeg",
    ];

    console.log("🔍 [DEBUG] Checking possible FFmpeg paths:");
    possiblePaths.forEach((p, index) => {
      try {
        const exists = p === "ffmpeg" || fs.existsSync(p);
        console.log(
          `🔍 [DEBUG] ${index + 1}. ${p} - ${
            exists ? "✅ EXISTS" : "❌ NOT FOUND"
          }`
        );
        if (exists && p !== "ffmpeg") {
          const stats = fs.statSync(p);
          console.log(`🔍 [DEBUG]    Size: ${stats.size} bytes`);
        }
      } catch (e) {
        console.log(`� [DEBUG] ${index + 1}. ${p} - ❌ ERROR: ${e.message}`);
      }
    });

    ffmpegPath =
      possiblePaths.find((p) => {
        try {
          const exists = p === "ffmpeg" || fs.existsSync(p);
          if (exists && p !== "ffmpeg") {
            console.log(`🔍 [DEBUG] ✅ Selected FFmpeg path: ${p}`);
          }
          return exists;
        } catch (e) {
          console.log(`🔍 [DEBUG] ❌ Error checking ${p}: ${e.message}`);
          return false;
        }
      }) || "ffmpeg";

    console.log(`🔍 [DEBUG] Final FFmpeg path: ${ffmpegPath}`);

    // If no FFmpeg found, try to setup
    if (ffmpegPath === "ffmpeg") {
      console.log(
        "🔍 [DEBUG] ⚠️ No bundled FFmpeg found, attempting to setup..."
      );
      try {
        const { downloadFFmpeg } = require("./ffmpeg-downloader");
        downloadFFmpeg()
          .then((path) => {
            ffmpegPath = path;
            console.log(`🔍 [DEBUG] ✅ FFmpeg setup complete: ${path}`);
          })
          .catch((e) => {
            console.error("🔍 [DEBUG] ❌ Failed to setup FFmpeg:", e);
          });
      } catch (e) {
        console.error("🔍 [DEBUG] ❌ FFmpeg downloader error:", e);
      }
    }
  }
} catch (error) {
  console.error(
    "🔍 [DEBUG] ❌ Error loading ffmpeg-static, falling back to system ffmpeg:",
    error
  );
  ffmpegPath = "ffmpeg";
}

const url = require("url");
const http = require("http");

class RTSPStreamingServer {
  constructor(port = 9999) {
    this.port = port;
    this.activeStreams = new Map(); // Map<rtspUrl, {ffmpeg, clients}>
    this.wss = null;
    this.httpServer = null;
  }

  start() {
    // Create HTTP server first
    this.httpServer = http.createServer((req, res) => {
      // Handle health check endpoint
      if (req.url === '/health' && req.method === 'GET') {
        res.writeHead(200, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify({ 
          status: 'ok', 
          timestamp: new Date().toISOString(),
          activeStreams: this.activeStreams.size,
          websocketConnections: this.wss ? this.wss.clients.size : 0
        }));
        return;
      }
      
      // Default response for other requests
      res.writeHead(404, { 'Content-Type': 'text/plain' });
      res.end('Not Found');
    });

    // Create WebSocket server using the HTTP server
    this.wss = new WebSocket.Server({
      server: this.httpServer,
      perMessageDeflate: false, // Disable compression for lowest latency
      maxPayload: 1024 * 1024 * 3, // Reduced to 3MB for faster processing
      clientTracking: true,
      // Ultimate low-latency WebSocket settings
      handshakeTimeout: 3000, // Reduced to 3 seconds
      heartbeatInterval: 25000, // More frequent heartbeat
      dropConnectionOnKeepaliveTimeout: true,
      keepaliveGracePeriod: 3000, // Shorter grace period
      // Additional performance optimizations
      backlog: 100, // Larger connection backlog
      verifyClient: false, // Skip verification for speed
      noDelay: true, // TCP_NODELAY for immediate transmission
    });

    // Start the HTTP server
    this.httpServer.listen(this.port, () => {
      console.log(`🚀 RTSP WebSocket server started on port ${this.port}`);
      console.log(`🏥 Health check endpoint available at http://localhost:${this.port}/health`);
    });

    this.wss.on("connection", (ws, req) => {
      const query = url.parse(req.url, true).query;
      const rtspUrl = query.rtsp;
      const cameraId = query.cameraId || "unknown";

      console.log(`📹 New client connected for camera ${cameraId}`);
      console.log(`🔗 RTSP URL: ${rtspUrl}`);
      console.log(`🔍 [DEBUG] Client count: ${this.wss.clients.size}`);
      console.log(`🔍 [DEBUG] Query params:`, query);

      if (!rtspUrl) {
        console.error("❌ No RTSP URL provided");
        console.error("🔍 [DEBUG] Request URL:", req.url);
        console.error("🔍 [DEBUG] Query object:", query);
        ws.close(1008, "RTSP URL required");
        return;
      }

      // Store client info
      ws.rtspUrl = rtspUrl;
      ws.cameraId = cameraId;
      ws.isAlive = true;

      // Setup ping/pong for connection health
      ws.on("pong", () => {
        ws.isAlive = true;
      });

      // Get or create stream
      this.getOrCreateStream(rtspUrl, cameraId, ws);

      // Handle WebSocket close
      ws.on("close", (code, reason) => {
        console.log(
          `📱 Client disconnected for camera ${cameraId}: ${code} ${reason}`
        );
        this.handleClientDisconnect(ws);
      });

      ws.on("error", (err) => {
        console.error(`❌ WebSocket error for camera ${cameraId}:`, err);
        this.handleClientDisconnect(ws);
      });
    });

    // Setup heartbeat to detect broken connections
    const heartbeat = setInterval(() => {
      this.wss.clients.forEach((ws) => {
        if (!ws.isAlive) {
          console.log(
            `💔 Terminating dead connection for camera ${ws.cameraId}`
          );
          return ws.terminate();
        }
        ws.isAlive = false;
        ws.ping();
      });
    }, 30000); // Check every 30 seconds

    // Enhanced stream health monitoring with DTS/PTS error detection
    const streamHealthCheck = setInterval(() => {
      for (const [rtspUrl, streamInfo] of this.activeStreams) {
        const timeSinceStart = Date.now() - streamInfo.startTime;
        const timeSinceLastData = Date.now() - streamInfo.lastDataTime;
        const hasClients = streamInfo.clients.size > 0;
        const isStuck = hasClients && timeSinceLastData > 10000; // 10s timeout

        // Check for DTS/PTS errors
        if (streamInfo.dtsErrors && streamInfo.dtsErrors > 10) {
          console.log(
            `💥 DTS/PTS errors detected for ${rtspUrl}, restarting stream...`
          );
          streamInfo.ffmpeg.kill("SIGTERM");
          streamInfo.dtsErrors = 0; // Reset counter
        } else if (isStuck && !streamInfo.isRestarting) {
          console.log(
            `🔧 Stream appears stuck for ${rtspUrl} (${Math.round(
              timeSinceLastData / 1000
            )}s since last data), restarting...`
          );
          streamInfo.ffmpeg.kill("SIGTERM");
        }

        // Enhanced logging with health status
        if (hasClients && timeSinceStart % 300000 < 30000) {
          // Every 5 minutes
          const health = isStuck
            ? "STUCK"
            : timeSinceLastData < 5000
            ? "HEALTHY"
            : "SLOW";
          console.log(
            `📊 Stream [${health}] for ${rtspUrl}: ${
              streamInfo.dataCount
            } chunks, ${streamInfo.clients.size} clients, ${Math.round(
              timeSinceStart / 1000
            )}s uptime`
          );
        }
      }
    }, 30000); // Check every 30 seconds

    this.wss.on("close", () => {
      clearInterval(heartbeat);
      clearInterval(streamHealthCheck);
    });

    // Cleanup on process exit
    process.on("SIGINT", this.cleanup.bind(this));
    process.on("SIGTERM", this.cleanup.bind(this));
  }

  getOrCreateStream(rtspUrl, cameraId, ws) {
    let streamInfo = this.activeStreams.get(rtspUrl);

    // Check if we need to create a new stream
    const needNewStream =
      !streamInfo ||
      streamInfo.ffmpeg.killed ||
      streamInfo.ffmpeg.exitCode !== null ||
      streamInfo.ffmpeg.signalCode !== null;

    if (needNewStream) {
      // Preserve existing clients if stream exists
      let existingClients = new Set();
      if (streamInfo && streamInfo.clients) {
        existingClients = new Set(streamInfo.clients);
        console.log(
          `🔄 Preserving ${existingClients.size} existing clients for camera ${cameraId}`
        );
      }

      // Clean up old stream if exists
      if (streamInfo) {
        console.log(`🗑️ Cleaning up old stream for camera ${cameraId}`);
        if (!streamInfo.ffmpeg.killed) {
          streamInfo.ffmpeg.kill("SIGKILL");
        }
        this.activeStreams.delete(rtspUrl);
      }

      // Create new FFmpeg process
      console.log(`🎬 Starting new FFmpeg process for camera ${cameraId}`);
      console.log(`🔍 [DEBUG] Using FFmpeg binary: ${ffmpegPath}`);
      console.log(
        `🔍 [DEBUG] FFmpeg exists check: ${fs.existsSync(ffmpegPath)}`
      );

      // Test FFmpeg binary before spawning
      if (ffmpegPath !== "ffmpeg") {
        try {
          const stats = fs.statSync(ffmpegPath);
          console.log(`🔍 [DEBUG] FFmpeg file size: ${stats.size} bytes`);
          console.log(
            `🔍 [DEBUG] FFmpeg permissions: ${stats.mode.toString(8)}`
          );
        } catch (e) {
          console.error(
            `🔍 [DEBUG] ❌ Error reading FFmpeg stats: ${e.message}`
          );
        }
      }

      // Stable: Anti-corruption FFmpeg args for production streaming
      const ffmpegArgs = [
        // Input options - robust and stable
        "-fflags",
        "nobuffer+genpts+igndts", // Generate PTS and ignore bad DTS
        "-flags",
        "low_delay",
        "-rtsp_transport",
        "tcp",
        "-rtsp_flags",
        "prefer_tcp",
        "-probesize",
        "32",
        "-analyzeduration",
        "0",
        "-max_delay",
        "0",
        "-thread_queue_size",
        "512",
        "-use_wallclock_as_timestamps",
        "1", // Fix timestamp issues
        "-i",
        rtspUrl,

        // Video processing - stable and robust
        "-c:v",
        "libx264",
        "-preset",
        "faster", // More stable than veryfast
        "-tune",
        "zerolatency",
        "-pix_fmt",
        "yuv420p",
        "-profile:v",
        "baseline", // More compatible than main
        "-level",
        "3.1",

        // Resolution and framerate - stable settings
        "-s",
        "640x480", // Back to stable resolution
        "-r",
        "20", // Reduced for stability

        // Conservative bitrate for stability
        "-b:v",
        "800k",
        "-maxrate",
        "1000k",
        "-bufsize",
        "400k", // Larger buffer for stability

        // Conservative GOP settings
        "-g",
        "20",
        "-keyint_min",
        "10",
        "-sc_threshold",
        "40", // Enable scene change detection for better timestamps

        // Minimal x264 params to avoid conflicts
        "-x264-params",
        "sliced-threads=0:sync-lookahead=0:bframes=0:ref=1",

        // Threading
        "-threads",
        "2", // Reduced threads for stability
        "-thread_type",
        "slice",

        // No audio for maximum speed
        "-an",

        // Stable output format
        "-f",
        "mp4",
        "-movflags",
        "empty_moov+default_base_moof+frag_keyframe",
        "-frag_duration",
        "100000", // Back to 100ms for stability
        "-min_frag_duration",
        "100000",
        "-flush_packets",
        "1",
        "-avoid_negative_ts",
        "make_zero",
        "-copyts", // Preserve timestamps
        "-start_at_zero",
        "pipe:1",
      ];

      console.log(`🔧 FFmpeg command: ${ffmpegPath} ${ffmpegArgs.join(" ")}`);
      console.log(`🔍 [DEBUG] Spawning FFmpeg with:`);
      console.log(`🔍 [DEBUG] - Binary: ${ffmpegPath}`);
      console.log(
        `🔍 [DEBUG] - Args: [${ffmpegArgs.slice(0, 10).join(", ")}...]`
      );
      console.log(`🔍 [DEBUG] - Working dir: ${process.cwd()}`);

      const ffmpeg = spawn(ffmpegPath, ffmpegArgs, {
        stdio: ["ignore", "pipe", "pipe"],
      });

      console.log(`🔍 [DEBUG] FFmpeg process spawned with PID: ${ffmpeg.pid}`);

      streamInfo = {
        ffmpeg: ffmpeg,
        clients: existingClients, // Start with existing clients
        lastData: null,
        startTime: Date.now(),
        restartCount: 0,
        isRestarting: false,
        dataCount: 0,
        lastDataTime: Date.now(),
        dtsErrors: 0, // Track DTS/PTS errors
        lastHealthCheck: Date.now(),
      };

      this.activeStreams.set(rtspUrl, streamInfo);

      // Enhanced FFmpeg stdout handling - zero-latency broadcasting with quality
      ffmpeg.stdout.on("data", (chunk) => {
        streamInfo.lastData = chunk;
        streamInfo.dataCount++;
        streamInfo.lastDataTime = Date.now();

        // Priority-based immediate broadcast for ultra-low latency
        const deadClients = [];
        const chunkBuffer = Buffer.from(chunk); // Create buffer once

        // Ultra-fast iteration with priority sending
        for (const client of streamInfo.clients) {
          if (client.readyState === WebSocket.OPEN) {
            try {
              // Immediate send with optimized options
              client.send(chunkBuffer, {
                binary: true,
                compress: false,
                fin: true, // Force immediate transmission
                mask: false, // Server-side optimization
              });
            } catch (err) {
              console.error("❌ Error sending data to client:", err);
              deadClients.push(client);
            }
          } else {
            deadClients.push(client);
          }
        }

        // Batch cleanup for performance
        if (deadClients.length > 0) {
          deadClients.forEach((client) => streamInfo.clients.delete(client));
          console.log(`🔍 [DEBUG] Removed ${deadClients.length} dead clients`);
        }

        // Reduced logging frequency for performance
        if (streamInfo.dataCount <= 3) {
          console.log(
            `🔍 [DEBUG] Camera ${cameraId}: Received chunk ${streamInfo.dataCount}, size: ${chunk.length} bytes`
          );
        } else if (streamInfo.dataCount % 300 === 0) {
          // Even less frequent logging
          console.log(
            `📊 Camera ${cameraId}: ${streamInfo.dataCount} chunks sent to ${streamInfo.clients.size} clients`
          );
        }
      });

      // Handle FFmpeg stderr (logs)
      ffmpeg.stderr.on("data", (chunk) => {
        const error = chunk.toString();

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
          return;
        }

        console.log(`📺 FFmpeg [${cameraId}]:`, error.trim());

        // Enhanced DTS/PTS error detection and counting
        if (error.includes("DTS") && error.includes("invalid dropping")) {
          if (!streamInfo.dtsErrors) streamInfo.dtsErrors = 0;
          streamInfo.dtsErrors++;
          console.warn(
            `⚠️ DTS/PTS error #${streamInfo.dtsErrors} for camera ${cameraId}`
          );

          // If too many DTS errors, the stream will be restarted by health check
          return; // Don't spam logs with DTS errors
        }

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
          error.includes("Conversion failed") ||
          (error.includes("Option") && error.includes("not found"))
        ) {
          console.error(
            `💥 Critical error for camera ${cameraId}: ${error.trim()}`
          );

          // Kill process to trigger restart
          setTimeout(() => {
            if (!ffmpeg.killed && streamInfo.clients.size > 0) {
              console.log(
                `🔄 Killing process to restart for camera ${cameraId}`
              );
              ffmpeg.kill("SIGTERM");
            }
          }, 2000);
        }
      });

      ffmpeg.on("exit", (code, signal) => {
        console.log(
          `🔚 FFmpeg process for camera ${cameraId} exited with code ${code}, signal ${signal}`
        );

        // Manual kill - don't restart
        if (signal === "SIGKILL") {
          console.log(`🛑 Manual kill for camera ${cameraId}, not restarting`);
          this.activeStreams.delete(rtspUrl);
          return;
        }

        // Prevent multiple restart attempts
        if (streamInfo.isRestarting) {
          console.log(`⚠️ Already restarting camera ${cameraId}, skipping...`);
          return;
        }

        // Auto-restart if there are still clients and restart count is reasonable
        if (streamInfo.clients.size > 0 && streamInfo.restartCount < 5) {
          streamInfo.isRestarting = true;
          streamInfo.restartCount++;

          // Different delays based on exit code
          let delay = 2000; // Default 2s delay
          if (code === 0) {
            delay = 1000; // Quick restart for clean exits (normal completion)
          } else {
            delay = 3000 + streamInfo.restartCount * 1000; // Incremental delay for errors
          }

          console.log(
            `🔄 Auto-restarting FFmpeg for camera ${cameraId} in ${delay}ms (attempt ${streamInfo.restartCount}/5, exit code: ${code})...`
          );

          setTimeout(() => {
            if (streamInfo.clients.size > 0 && streamInfo.isRestarting) {
              // Create new stream info to avoid reference issues
              this.activeStreams.delete(rtspUrl);

              // Get first client to restart stream
              const firstClient = Array.from(streamInfo.clients)[0];
              if (firstClient && firstClient.readyState === WebSocket.OPEN) {
                this.getOrCreateStream(rtspUrl, cameraId, firstClient);
              }
            }
          }, delay);
        } else {
          console.log(
            `❌ Not restarting FFmpeg for camera ${cameraId} (clients: ${streamInfo.clients.size}, restarts: ${streamInfo.restartCount})`
          );
          this.activeStreams.delete(rtspUrl);
        }
      });

      ffmpeg.on("error", (err) => {
        console.error(`💥 FFmpeg process error for camera ${cameraId}:`, err);
        console.error(`🔍 [DEBUG] Error details:`);
        console.error(`🔍 [DEBUG] - Code: ${err.code}`);
        console.error(`🔍 [DEBUG] - Errno: ${err.errno}`);
        console.error(`🔍 [DEBUG] - Syscall: ${err.syscall}`);
        console.error(`🔍 [DEBUG] - Path: ${err.path}`);
        console.error(`🔍 [DEBUG] - FFmpeg path used: ${ffmpegPath}`);
        console.error(
          `🔍 [DEBUG] - FFmpeg exists: ${fs.existsSync(ffmpegPath)}`
        );
        this.activeStreams.delete(rtspUrl);
      });
    }

    // Add client to stream
    streamInfo.clients.add(ws);
    console.log(
      `👥 Added client to stream. Total clients: ${streamInfo.clients.size}`
    );

    // Send last data if available (for faster initial display)
    if (streamInfo.lastData && ws.readyState === WebSocket.OPEN) {
      try {
        ws.send(streamInfo.lastData);
      } catch (err) {
        console.error("❌ Error sending initial data:", err);
      }
    }
  }

  handleClientDisconnect(ws) {
    const rtspUrl = ws.rtspUrl;
    if (!rtspUrl) return;

    const streamInfo = this.activeStreams.get(rtspUrl);
    if (streamInfo) {
      streamInfo.clients.delete(ws);
      console.log(
        `👋 Removed client from stream. Remaining clients: ${streamInfo.clients.size}`
      );

      // Kill stream if no more clients after a delay
      if (streamInfo.clients.size === 0) {
        setTimeout(() => {
          const currentStreamInfo = this.activeStreams.get(rtspUrl);
          if (currentStreamInfo && currentStreamInfo.clients.size === 0) {
            console.log(`🗑️ No more clients for ${rtspUrl}, killing stream`);
            this.killStream(rtspUrl);
          }
        }, 15000); // Wait 15 seconds before killing
      }
    }
  }

  killStream(rtspUrl) {
    const streamInfo = this.activeStreams.get(rtspUrl);
    if (streamInfo && !streamInfo.ffmpeg.killed) {
      console.log(`🔪 Killing FFmpeg process for ${rtspUrl}`);
      streamInfo.ffmpeg.kill("SIGKILL");
    }
    this.activeStreams.delete(rtspUrl);
  }

  cleanup() {
    console.log("🧹 Shutting down RTSP streaming server...");

    // Kill all FFmpeg processes
    for (const [rtspUrl, streamInfo] of this.activeStreams) {
      console.log(`🔪 Killing FFmpeg process for ${rtspUrl}`);
      if (!streamInfo.ffmpeg.killed) {
        streamInfo.ffmpeg.kill("SIGKILL");
      }
    }

    this.activeStreams.clear();

    if (this.wss) {
      this.wss.close();
    }

    if (this.httpServer) {
      this.httpServer.close();
    }
  }

  stop() {
    this.cleanup();
  }
}

module.exports = RTSPStreamingServer;
