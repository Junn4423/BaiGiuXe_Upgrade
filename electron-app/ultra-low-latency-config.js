/**
 * Ultra Low Latency Configuration for Parking System RTSP Streaming
 * Target: <500ms latency while maintaining license plate readability
 *
 * Key optimizations:
 * 1. FFmpeg parameters optimized for minimal buffering
 * 2. WebSocket configuration for immediate delivery
 * 3. Network stack optimizations
 * 4. Higher resolution for better license plate detection
 */

const ULTRA_LOW_LATENCY_CONFIG = {
  // FFmpeg Configuration
  ffmpeg: {
    input: {
      rtsp_transport: "tcp",
      rtsp_flags: "prefer_tcp",
      fflags: "nobuffer+flush_packets",
      flags: "low_delay",
      probesize: 32768, // 32KB probe size
      analyzeduration: 100000, // 100ms analysis
      max_delay: 100000, // 100ms max delay
    },

    video: {
      codec: "libx264",
      preset: "ultrafast", // Fastest encoding
      tune: "zerolatency", // Zero latency tuning
      crf: 23, // Good quality for license plates
      pixel_format: "yuv420p",
      profile: "baseline",
      level: "3.1",
      resolution: "1280x720", // Good for license plate reading
      framerate: 25, // Smooth motion
      gop_size: 10, // Small GOP for low latency
      keyint_min: 5, // Frequent keyframes
      x264_params:
        "sliced-threads=1:sync-lookahead=0:rc-lookahead=0:intra-refresh=1:bframes=0:ref=1:me=dia:subme=1:trellis=0",
    },

    output: {
      format: "mp4",
      movflags: "empty_moov+default_base_moof+frag_keyframe+dash+delay_moov",
      frag_duration: 200000, // 200ms fragments
      min_frag_duration: 100000, // 100ms min fragments
      reset_timestamps: 1,
      flush_packets: 1,
    },
  },

  // WebSocket Configuration
  websocket: {
    perMessageDeflate: false, // Disable compression
    maxPayload: 5 * 1024 * 1024, // 5MB max payload
    backlog: 10, // Limited connection queue
    clientTracking: true,
    verifyClient: false, // Skip verification
    handleProtocols: false, // Skip protocol handling

    // Socket optimizations
    setNoDelay: true, // Disable Nagle algorithm
    setKeepAlive: true, // Keep connections alive
    keepAliveInitialDelay: 30000, // 30s keepalive

    // Send options
    sendOptions: {
      binary: true,
      compress: false,
      fin: true,
    },
  },

  // Health Check Configuration
  healthCheck: {
    heartbeatInterval: 15000, // 15s ping interval
    streamCheckInterval: 30000, // 30s stream health check
    stuckThreshold: 20000, // 20s to consider stream stuck
    statsLoggingInterval: 200, // Log stats every 200 chunks
  },

  // Performance Monitoring
  monitoring: {
    targetLatency: 500, // Target <500ms
    maxAcceptableLatency: 1000, // Alert if >1s
    measurementInterval: 10000, // Measure every 10s
    logLevel: "info", // Logging level
  },
};

// Helper function to build FFmpeg arguments
function buildFFmpegArgs(rtspUrl, config = ULTRA_LOW_LATENCY_CONFIG) {
  const { input, video, output } = config.ffmpeg;

  return [
    // Input options
    "-rtsp_transport",
    input.rtsp_transport,
    "-rtsp_flags",
    input.rtsp_flags,
    "-fflags",
    input.fflags,
    "-flags",
    input.flags,
    "-probesize",
    input.probesize.toString(),
    "-analyzeduration",
    input.analyzeduration.toString(),
    "-max_delay",
    input.max_delay.toString(),
    "-i",
    rtspUrl,

    // Video processing
    "-c:v",
    video.codec,
    "-preset",
    video.preset,
    "-tune",
    video.tune,
    "-crf",
    video.crf.toString(),
    "-pix_fmt",
    video.pixel_format,
    "-profile:v",
    video.profile,
    "-level",
    video.level,
    "-s",
    video.resolution,
    "-r",
    video.framerate.toString(),
    "-g",
    video.gop_size.toString(),
    "-keyint_min",
    video.keyint_min.toString(),
    "-x264-params",
    video.x264_params,
    "-an", // No audio

    // Output options
    "-f",
    output.format,
    "-movflags",
    output.movflags,
    "-frag_duration",
    output.frag_duration.toString(),
    "-min_frag_duration",
    output.min_frag_duration.toString(),
    "-reset_timestamps",
    output.reset_timestamps.toString(),
    "-flush_packets",
    output.flush_packets.toString(),
    "pipe:1",
  ];
}

// Helper function to configure WebSocket
function configureWebSocket(ws, config = ULTRA_LOW_LATENCY_CONFIG) {
  const { websocket } = config;

  ws.binaryType = "arraybuffer";

  if (ws._socket) {
    ws._socket.setNoDelay(websocket.setNoDelay);
    ws._socket.setKeepAlive(
      websocket.setKeepAlive,
      websocket.keepAliveInitialDelay
    );
  }

  return websocket.sendOptions;
}

// Latency measurement utility
class LatencyMonitor {
  constructor(config = ULTRA_LOW_LATENCY_CONFIG) {
    this.config = config.monitoring;
    this.measurements = [];
    this.lastMeasurement = Date.now();
  }

  measureLatency() {
    const now = Date.now();
    const latency = now - this.lastMeasurement;
    this.measurements.push({ timestamp: now, latency });

    // Keep only recent measurements
    const cutoff = now - 60000; // Last 1 minute
    this.measurements = this.measurements.filter((m) => m.timestamp > cutoff);

    return latency;
  }

  getAverageLatency() {
    if (this.measurements.length === 0) return 0;
    const sum = this.measurements.reduce((acc, m) => acc + m.latency, 0);
    return sum / this.measurements.length;
  }

  isPerformanceGood() {
    const avgLatency = this.getAverageLatency();
    return avgLatency <= this.config.targetLatency;
  }

  getStats() {
    const avgLatency = this.getAverageLatency();
    const maxLatency = Math.max(...this.measurements.map((m) => m.latency));
    const minLatency = Math.min(...this.measurements.map((m) => m.latency));

    return {
      average: Math.round(avgLatency),
      max: maxLatency,
      min: minLatency,
      sampleCount: this.measurements.length,
      targetMet: avgLatency <= this.config.targetLatency,
    };
  }
}

module.exports = {
  ULTRA_LOW_LATENCY_CONFIG,
  buildFFmpegArgs,
  configureWebSocket,
  LatencyMonitor,
};
