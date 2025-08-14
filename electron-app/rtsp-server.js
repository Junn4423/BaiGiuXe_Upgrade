const { spawn } = require("child_process");
const WebSocket = require("ws");
const path = require("path");
const fs = require("fs");

// Handle ffmpeg path for both development and production
let ffmpegPath;
try {
  // In development, use ffmpeg-static
  if (process.env.NODE_ENV === "development") {
    ffmpegPath = require("ffmpeg-static");
  } else {
    // In production (packaged app), look for ffmpeg in resources
    const isDev = process.env.NODE_ENV === "development";

    if (isDev) {
      ffmpegPath = require("ffmpeg-static");
    } else {
      // Try multiple possible paths for packaged app
      const possiblePaths = [
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
        "ffmpeg", // Fallback to system ffmpeg
      ];

      ffmpegPath =
        possiblePaths.find((p) => {
          try {
            return fs.existsSync(p);
          } catch (e) {
            return false;
          }
        }) || "ffmpeg";

      console.log(`🔧 Using FFmpeg path in production: ${ffmpegPath}`);
    }
  }
} catch (error) {
  console.error(
    "❌ Error loading ffmpeg-static, falling back to system ffmpeg:",
    error
  );
  ffmpegPath = "ffmpeg";
}

const url = require("url");

const WS_PORT = 9999;

// Store active FFmpeg processes
const activeStreams = new Map();

// Create WebSocket server
const wss = new WebSocket.Server({
  port: WS_PORT,
  perMessageDeflate: false,
});

console.log(`RTSP WebSocket server started on port ${WS_PORT}`);

wss.on("connection", (ws, req) => {
  const query = url.parse(req.url, true).query;
  const rtspUrl = query.rtsp;

  if (!rtspUrl) {
    console.error("No RTSP URL provided");
    ws.close(1008, "RTSP URL required");
    return;
  }

  console.log(`New WebSocket client connected for RTSP: ${rtspUrl}`);

  // Check if stream already exists
  let ffmpeg = activeStreams.get(rtspUrl);

  if (!ffmpeg || ffmpeg.killed) {
    // Create new FFmpeg process
    console.log(`Starting new FFmpeg process for: ${rtspUrl}`);

    ffmpeg = spawn(
      ffmpegPath,
      [
        // Ultra-low latency RTSP input configuration
        "-rtsp_transport",
        "tcp",
        "-rtsp_flags",
        "prefer_tcp",
        "-fflags",
        "nobuffer+flush_packets",
        "-flags",
        "low_delay",
        "-probesize",
        "32768", // Reduce probe size
        "-analyzeduration",
        "100000", // Reduce analyze duration (100ms)
        "-max_delay",
        "100000", // Max delay 100ms
        "-i",
        rtspUrl,

        // Video encoding optimized for license plate reading
        "-c:v",
        "libx264",
        "-preset",
        "ultrafast",
        "-tune",
        "zerolatency",
        "-crf",
        "23", // Good quality for license plates
        "-g",
        "10", // Smaller GOP for lower latency
        "-keyint_min",
        "5", // Minimum keyframe interval
        "-pix_fmt",
        "yuv420p",
        "-profile:v",
        "baseline",
        "-level",
        "3.1",
        "-s",
        "1280x720", // Higher resolution for license plates
        "-r",
        "25", // Higher framerate
        "-x264-params",
        "sliced-threads=1:sync-lookahead=0:rc-lookahead=0:intra-refresh=1:bframes=0:ref=1",
        "-an", // No audio

        // Output fragmented MP4 optimized for streaming
        "-f",
        "mp4",
        "-movflags",
        "empty_moov+default_base_moof+frag_keyframe+dash+delay_moov",
        "-frag_duration",
        "200000", // Fragment duration 200ms
        "-min_frag_duration",
        "100000", // Min fragment duration 100ms
        "-reset_timestamps",
        "1",
        "-flush_packets",
        "1",
        "pipe:1",
      ],
      {
        stdio: ["ignore", "pipe", "pipe"],
      }
    );

    // Store the process
    activeStreams.set(rtspUrl, ffmpeg);

    // Handle FFmpeg errors
    ffmpeg.stderr.on("data", (chunk) => {
      const error = chunk.toString();
      console.error(`FFmpeg [${rtspUrl}]:`, error);

      // Check for critical errors
      if (
        error.includes("Connection refused") ||
        error.includes("No route to host") ||
        error.includes("Invalid data found")
      ) {
        console.error(`Critical error for ${rtspUrl}, terminating...`);
        ffmpeg.kill("SIGKILL");
        activeStreams.delete(rtspUrl);
      }
    });

    ffmpeg.on("exit", (code, signal) => {
      console.log(
        `FFmpeg process for ${rtspUrl} exited with code ${code}, signal ${signal}`
      );
      activeStreams.delete(rtspUrl);
    });

    ffmpeg.on("error", (err) => {
      console.error(`FFmpeg process error for ${rtspUrl}:`, err);
      activeStreams.delete(rtspUrl);
    });
  }

  // Forward FFmpeg output to WebSocket
  const dataHandler = (chunk) => {
    if (ws.readyState === WebSocket.OPEN) {
      try {
        ws.send(chunk);
      } catch (err) {
        console.error("Error sending data to WebSocket:", err);
      }
    }
  };

  ffmpeg.stdout.on("data", dataHandler);

  // Handle WebSocket close
  ws.on("close", (code, reason) => {
    console.log(`WebSocket client disconnected: ${code} ${reason}`);

    // Remove data handler
    ffmpeg.stdout.removeListener("data", dataHandler);

    // Check if any other clients are using this stream
    const hasOtherClients = Array.from(wss.clients).some(
      (client) =>
        client !== ws &&
        client.readyState === WebSocket.OPEN &&
        url.parse(client.upgradeReq?.url || "", true).query.rtsp === rtspUrl
    );

    // Kill FFmpeg if no other clients
    if (!hasOtherClients && activeStreams.has(rtspUrl)) {
      console.log(`No more clients for ${rtspUrl}, killing FFmpeg process`);
      const process = activeStreams.get(rtspUrl);
      if (process && !process.killed) {
        process.kill("SIGKILL");
      }
      activeStreams.delete(rtspUrl);
    }
  });

  ws.on("error", (err) => {
    console.error("WebSocket error:", err);
  });
});

// Cleanup on process exit
process.on("SIGINT", () => {
  console.log("Shutting down RTSP server...");

  // Kill all FFmpeg processes
  for (const [rtspUrl, ffmpeg] of activeStreams) {
    console.log(`Killing FFmpeg process for ${rtspUrl}`);
    if (!ffmpeg.killed) {
      ffmpeg.kill("SIGKILL");
    }
  }

  activeStreams.clear();
  wss.close();
  process.exit(0);
});

process.on("SIGTERM", () => {
  console.log("Received SIGTERM, shutting down...");
  process.exit(0);
});
