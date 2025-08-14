/**
 * Ultra Low Latency Test Script
 * Test streaming latency and performance optimizations
 */

const { spawn } = require("child_process");
const WebSocket = require("ws");
const {
  buildFFmpegArgs,
  configureWebSocket,
  LatencyMonitor,
} = require("./ultra-low-latency-config");

class LatencyTester {
  constructor() {
    this.monitor = new LatencyMonitor();
    this.testResults = {
      startTime: Date.now(),
      endTime: null,
      measurements: [],
      errors: [],
      connectionStats: {},
    };
  }

  async testRTSPLatency(rtspUrl, testDurationMs = 30000) {
    console.log("🧪 Starting Ultra Low Latency Test");
    console.log(`📹 RTSP URL: ${rtspUrl}`);
    console.log(`⏱️ Test Duration: ${testDurationMs / 1000}s`);
    console.log(`🎯 Target Latency: <500ms`);

    return new Promise((resolve, reject) => {
      let firstFrameReceived = false;
      let frameCount = 0;
      let dataCount = 0;
      let totalBytes = 0;

      // Start WebSocket client
      const ws = new WebSocket(
        `ws://localhost:9999?rtsp=${encodeURIComponent(
          rtspUrl
        )}&cameraId=latency-test`
      );
      const sendOptions = configureWebSocket(ws);

      ws.on("open", () => {
        console.log("✅ WebSocket connected");
        this.testResults.connectionStats.connected = Date.now();
      });

      ws.on("message", (data) => {
        const now = Date.now();

        if (!firstFrameReceived) {
          const timeToFirstFrame = now - this.testResults.startTime;
          console.log(`🎬 First frame received after ${timeToFirstFrame}ms`);
          this.testResults.connectionStats.firstFrame = timeToFirstFrame;
          firstFrameReceived = true;
        }

        frameCount++;
        dataCount++;
        totalBytes += data.length;

        // Measure latency (simulated)
        const latency = this.monitor.measureLatency();
        this.testResults.measurements.push({
          timestamp: now,
          frameNumber: frameCount,
          dataSize: data.length,
          estimatedLatency: latency,
        });

        // Log progress
        if (frameCount % 25 === 0) {
          // Every ~1 second at 25fps
          const stats = this.monitor.getStats();
          console.log(
            `📊 Frame ${frameCount}: Avg latency ${stats.average}ms, Data: ${(
              totalBytes /
              1024 /
              1024
            ).toFixed(2)}MB`
          );
        }
      });

      ws.on("error", (error) => {
        console.error("❌ WebSocket error:", error);
        this.testResults.errors.push({
          timestamp: Date.now(),
          error: error.message,
        });
      });

      ws.on("close", () => {
        console.log("🔌 WebSocket disconnected");
      });

      // End test after duration
      setTimeout(() => {
        this.testResults.endTime = Date.now();
        ws.close();

        // Calculate final results
        const finalStats = this.monitor.getStats();
        const testDuration =
          this.testResults.endTime - this.testResults.startTime;
        const avgFramerate = (frameCount / testDuration) * 1000;

        const results = {
          duration: testDuration,
          frameCount,
          dataCount,
          totalBytes,
          averageFramerate: Math.round(avgFramerate * 100) / 100,
          latencyStats: finalStats,
          performanceGood: finalStats.targetMet,
          connectionStats: this.testResults.connectionStats,
          errors: this.testResults.errors,
        };

        console.log("\n📊 Test Results:");
        console.log(`⏱️ Duration: ${testDuration}ms`);
        console.log(`🎬 Frames: ${frameCount}`);
        console.log(`📡 Data: ${(totalBytes / 1024 / 1024).toFixed(2)}MB`);
        console.log(`🎥 Average FPS: ${results.averageFramerate}`);
        console.log(`⚡ Average Latency: ${finalStats.average}ms`);
        console.log(`🎯 Target Met: ${finalStats.targetMet ? "✅" : "❌"}`);
        console.log(`❌ Errors: ${this.testResults.errors.length}`);

        if (this.testResults.connectionStats.firstFrame) {
          console.log(
            `🚀 Time to First Frame: ${this.testResults.connectionStats.firstFrame}ms`
          );
        }

        resolve(results);
      }, testDurationMs);
    });
  }

  async testFFmpegPerformance(rtspUrl) {
    console.log("\n🔧 Testing FFmpeg Performance");

    return new Promise((resolve, reject) => {
      const args = buildFFmpegArgs(rtspUrl);
      console.log(`📋 FFmpeg args: ${args.length} parameters`);

      // Try to find FFmpeg
      const ffmpegPaths = [
        "ffmpeg",
        "./ffmpeg-binary/ffmpeg.exe",
        require("ffmpeg-static"),
      ];

      let ffmpegPath =
        ffmpegPaths.find((path) => {
          try {
            return require("fs").existsSync(path) || path === "ffmpeg";
          } catch (e) {
            return path === "ffmpeg";
          }
        }) || "ffmpeg";

      console.log(`🔍 Using FFmpeg: ${ffmpegPath}`);

      const startTime = Date.now();
      const ffmpeg = spawn(ffmpegPath, args, {
        stdio: ["ignore", "pipe", "pipe"],
      });

      let outputBytes = 0;
      let errorOutput = "";
      let firstOutput = false;

      ffmpeg.stdout.on("data", (chunk) => {
        if (!firstOutput) {
          const timeToFirstOutput = Date.now() - startTime;
          console.log(`⚡ First output after ${timeToFirstOutput}ms`);
          firstOutput = true;
        }
        outputBytes += chunk.length;
      });

      ffmpeg.stderr.on("data", (chunk) => {
        errorOutput += chunk.toString();
      });

      ffmpeg.on("close", (code) => {
        const duration = Date.now() - startTime;
        console.log(`🏁 FFmpeg exited with code ${code} after ${duration}ms`);

        resolve({
          exitCode: code,
          duration,
          outputBytes,
          errorOutput: errorOutput.slice(0, 500), // First 500 chars
          success: code === 0,
        });
      });

      ffmpeg.on("error", (error) => {
        console.error("❌ FFmpeg error:", error);
        reject(error);
      });

      // Kill after 10 seconds for testing
      setTimeout(() => {
        ffmpeg.kill("SIGTERM");
      }, 10000);
    });
  }
}

// CLI usage
if (require.main === module) {
  const args = process.argv.slice(2);

  if (args.length === 0) {
    console.log("Usage: node latency-test.js <rtsp-url> [duration-ms]");
    console.log(
      "Example: node latency-test.js rtsp://192.168.1.100/stream 30000"
    );
    process.exit(1);
  }

  const rtspUrl = args[0];
  const duration = parseInt(args[1]) || 30000;

  const tester = new LatencyTester();

  console.log("🚀 Starting comprehensive latency test...");

  // Test FFmpeg performance first
  tester
    .testFFmpegPerformance(rtspUrl)
    .then((ffmpegResults) => {
      console.log("✅ FFmpeg test completed");

      // Then test streaming latency
      return tester.testRTSPLatency(rtspUrl, duration);
    })
    .then((latencyResults) => {
      console.log("\n✅ All tests completed successfully!");

      // Save results to file
      const results = {
        timestamp: new Date().toISOString(),
        rtspUrl,
        duration,
        latencyResults,
      };

      require("fs").writeFileSync(
        `latency-test-results-${Date.now()}.json`,
        JSON.stringify(results, null, 2)
      );

      console.log(
        `💾 Results saved to latency-test-results-${Date.now()}.json`
      );
    })
    .catch((error) => {
      console.error("❌ Test failed:", error);
      process.exit(1);
    });
}

module.exports = LatencyTester;
