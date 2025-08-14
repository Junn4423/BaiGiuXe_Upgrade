# Ultra Low Latency RTSP Streaming Optimization

## Mục tiêu

Giảm độ trễ streaming từ 2 giây xuống **< 500ms** (0.3-0.5 giây) mà không làm giảm chất lượng video cho việc đọc biển số xe.

## Các tối ưu hóa đã thực hiện

### 1. FFmpeg Parameters

```bash
# Input optimizations
-rtsp_transport tcp
-rtsp_flags prefer_tcp
-fflags nobuffer+flush_packets
-flags low_delay
-probesize 32768          # Giảm probe size
-analyzeduration 100000   # Giảm thời gian phân tích xuống 100ms
-max_delay 100000         # Giới hạn delay tối đa 100ms

# Video encoding optimized for license plates
-c:v libx264
-preset ultrafast         # Encoding nhanh nhất
-tune zerolatency        # Tối ưu cho độ trễ zero
-crf 23                  # Chất lượng tốt cho biển số
-s 1280x720             # Độ phân giải cao hơn cho biển số
-r 25                   # Frame rate cao hơn
-g 10                   # GOP nhỏ hơn (keyframe mỗi 10 frame)
-keyint_min 5           # Keyframe thường xuyên hơn

# Advanced x264 parameters
-x264-params "sliced-threads=1:sync-lookahead=0:rc-lookahead=0:intra-refresh=1:bframes=0:ref=1:me=dia:subme=1:trellis=0"

# Output streaming
-f mp4
-movflags "empty_moov+default_base_moof+frag_keyframe+dash+delay_moov"
-frag_duration 200000    # Fragment 200ms
-min_frag_duration 100000 # Fragment tối thiểu 100ms
-flush_packets 1         # Flush ngay lập tức
```

### 2. WebSocket Optimizations

```javascript
// Server configuration
{
  perMessageDeflate: false,     // Tắt compression
  maxPayload: 5 * 1024 * 1024, // Giảm payload xuống 5MB
  backlog: 10,                 // Giới hạn connection queue
  clientTracking: true,
  verifyClient: false,         // Bỏ qua verification
  handleProtocols: false       // Bỏ qua protocol handling
}

// Socket optimizations
ws._socket.setNoDelay(true)           // Tắt Nagle algorithm
ws._socket.setKeepAlive(true, 30000)  // Keep-alive 30s

// Send options
client.send(chunk, {
  binary: true,
  compress: false,
  fin: true
})
```

### 3. Health Check Optimizations

- Giảm heartbeat interval từ 30s xuống 15s
- Giảm stream health check từ 45s xuống 30s
- Giảm stuck detection từ 30s xuống 20s
- Tối ưu logging frequency để giảm overhead

### 4. Process Optimizations

```javascript
// Spawn với tối ưu hóa
spawn(ffmpegPath, ffmpegArgs, {
  stdio: ["ignore", "pipe", "pipe"],
  windowsHide: true, // Ẩn console window
  detached: false, // Giữ attached
  env: {
    ...process.env,
    FFREPORT: "level=16", // Minimal logging
  },
});
```

## Cách sử dụng

### 1. Test hiệu suất

```bash
cd electron-app
node latency-test.js rtsp://your-camera-ip/stream 30000
```

### 2. Kiểm tra cấu hình

```bash
node debug-ffmpeg.js
```

### 3. Khởi động với cấu hình mới

```bash
npm start
# hoặc
.\START_PARKING_SYSTEM.bat
```

## Monitoring và Debugging

### Latency Monitoring

File `ultra-low-latency-config.js` bao gồm:

- `LatencyMonitor` class để đo độ trễ
- Configuration helpers
- Performance monitoring utilities

### Test Results

Script `latency-test.js` sẽ tạo file kết quả:

```
latency-test-results-[timestamp].json
```

## Kết quả mong đợi

### Trước tối ưu hóa:

- Latency: ~2000ms
- Resolution: 640x480
- Frame rate: 15fps
- GOP size: 30

### Sau tối ưu hóa:

- **Latency: <500ms** ✅
- **Resolution: 1280x720** ✅ (Tốt hơn cho đọc biển số)
- **Frame rate: 25fps** ✅ (Mượt hơn)
- **GOP size: 10** ✅ (Độ trễ thấp hơn)

## Lưu ý quan trọng

### Yêu cầu mạng

- Băng thông tối thiểu: 2-3 Mbps cho 1280x720@25fps
- Độ trễ mạng: <50ms
- Packet loss: <1%

### Yêu cầu phần cứng

- CPU: Đủ mạnh cho H.264 encoding ultrafast
- RAM: Tối thiểu 4GB
- GPU: Có thể sử dụng hardware acceleration nếu có

### Camera settings

- Đảm bảo camera hỗ trợ TCP transport
- Cấu hình camera với bitrate phù hợp (1-2 Mbps)
- Tắt audio stream nếu không cần thiết

## Troubleshooting

### Latency vẫn cao (>1s)

1. Kiểm tra network latency đến camera
2. Kiểm tra CPU usage trong khi streaming
3. Test với resolution thấp hơn (960x540)
4. Kiểm tra camera settings

### Frame drops/stuttering

1. Tăng network buffer size
2. Kiểm tra bandwidth utilization
3. Giảm frame rate xuống 20fps
4. Tăng fragment duration lên 300ms

### Connection issues

1. Kiểm tra RTSP URL và credentials
2. Test với VLC player trước
3. Kiểm tra firewall settings
4. Thử UDP transport nếu TCP có vấn đề

## Advanced Tuning

### Network stack optimization

```javascript
// Thêm vào socket options
socket.setNoDelay(true);
socket.setKeepAlive(true, 30000);
socket.setTimeout(5000);
```

### OS-level optimizations

```bash
# Windows: Tăng network buffer
netsh int tcp set global autotuninglevel=normal

# Linux: Tăng socket buffer
echo 'net.core.rmem_max = 67108864' >> /etc/sysctl.conf
echo 'net.core.wmem_max = 67108864' >> /etc/sysctl.conf
```

## Files được tối ưu hóa

1. `rtsp-streaming-server.js` - Main streaming server
2. `rtsp-server.js` - Alternative streaming implementation
3. `ultra-low-latency-config.js` - Configuration utilities
4. `latency-test.js` - Performance testing tool

Với các tối ưu hóa này, hệ thống sẽ đạt được latency <500ms mà vẫn duy trì chất lượng video tốt cho việc nhận diện biển số xe! 🚗⚡
