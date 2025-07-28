# Hướng dẫn Build App với RTSP Streaming

## Vấn đề chính
Khi `npm start` thì RTSP stream hoạt động bình thường, nhưng khi build thành exe thì không stream được camera.

## Nguyên nhân
1. **FFmpeg binary không được đóng gói đúng cách** trong app.asar
2. **Path resolution khác nhau** giữa development và production
3. **Electron ASAR packaging** không extract binary files đúng cách

## Giải pháp đã implement

### 1. Cấu hình package.json
```json
{
  "build": {
    "files": [
      "ffmpeg-binary/**/*",
      "node_modules/ffmpeg-static/**/*"
    ],
    "asarUnpack": [
      "node_modules/ffmpeg-static/**/*",
      "ffmpeg-binary/**/*"
    ]
  }
}
```

### 2. Smart FFmpeg Path Resolution
Code trong `rtsp-streaming-server.js` và `rtsp-server.js` đã được cập nhật để tìm FFmpeg ở nhiều vị trí:

```javascript
const possiblePaths = [
  // Custom backup path (highest priority)
  path.join(__dirname, 'ffmpeg-binary', 'ffmpeg.exe'),
  
  // Standard development paths
  path.join(__dirname, 'node_modules', 'ffmpeg-static', 'ffmpeg.exe'),
  
  // Production ASAR unpacked paths
  path.join(process.resourcesPath, 'app.asar.unpacked', 'node_modules', 'ffmpeg-static', 'ffmpeg.exe'),
  path.join(process.resourcesPath, 'app.asar.unpacked', 'ffmpeg-binary', 'ffmpeg.exe'),
  
  // System fallback
  'ffmpeg'
]
```

### 3. Pre-build Setup
`prebuild.js` copy FFmpeg từ node_modules vào thư mục `ffmpeg-binary/`:

```javascript
const ffmpegStatic = require('ffmpeg-static')
const ffmpegTarget = path.join(__dirname, 'ffmpeg-binary', 'ffmpeg.exe')
fs.copyFileSync(ffmpegStatic, ffmpegTarget)
```

## Hướng dẫn Build

### Cách 1: Sử dụng Enhanced Build Script
```bash
.\build-windows-enhanced.bat
```

### Cách 2: Manual Step-by-Step
```bash
# 1. Cài đặt dependencies
npm install

# 2. Chạy pre-build setup
npm run prebuild

# 3. Build Electron app
npm run build-win
```

## Kiểm tra sau khi Build

### 1. Kiểm tra FFmpeg có được đóng gói không
```bash
# Kiểm tra trong unpacked folder
dir "dist\win-unpacked\resources\app.asar.unpacked\ffmpeg-binary"
dir "dist\win-unpacked\resources\app.asar.unpacked\node_modules\ffmpeg-static"
```

### 2. Test app build với debug
Chạy app từ command line để xem logs:
```bash
"dist\win-unpacked\Parking Lot Management.exe"
```

Hoặc sử dụng test script:
```bash
node test-build-ffmpeg.js
```

### 3. Kiểm tra Console Logs
Khi app chạy, mở DevTools (F12) và kiểm tra console logs:
```
🔧 Using FFmpeg path in production: [path]
🎬 Starting new FFmpeg process for camera [id]
```

## Troubleshooting

### Lỗi 1: "FFmpeg not found"
**Giải pháp:**
1. Chạy `node debug-ffmpeg.js` để kiểm tra paths
2. Đảm bảo `ffmpeg-binary/ffmpeg.exe` tồn tại
3. Rebuild với `npm run prebuild && npm run build-win`

### Lỗi 2: "RTSP connection failed"
**Kiểm tra:**
1. Camera RTSP URL có đúng không
2. Network connection
3. FFmpeg process có start không (check console logs)

### Lỗi 3: "WebSocket connection failed"
**Kiểm tra:**
1. RTSP server có start trên port 9999 không
2. Firewall có block port không
3. Check `main.js` startRTSPStreamingServer()

### Lỗi 4: App bị crash khi start RTSP
**Giải pháp:**
1. Check `ffmpeg-binary/ffmpeg.exe` có executable permission không
2. Thử chạy app as Administrator
3. Check antivirus có block FFmpeg không

## Debug Tools

### debug-ffmpeg.js
Kiểm tra tất cả FFmpeg paths:
```bash
node debug-ffmpeg.js
```

### test-build-ffmpeg.js
Test FFmpeg trong app build:
```bash
node test-build-ffmpeg.js
```

## File Structure After Build
```
dist/
├── win-unpacked/
│   ├── Parking Lot Management.exe
│   └── resources/
│       ├── app.asar                    # Main app code
│       └── app.asar.unpacked/          # Unpacked binaries
│           ├── ffmpeg-binary/
│           │   └── ffmpeg.exe          # Our backup FFmpeg
│           └── node_modules/
│               └── ffmpeg-static/
│                   └── ffmpeg.exe      # Original FFmpeg
└── Parking Lot Management Setup.exe   # Installer
```

## Verification Checklist
- [ ] `npm start` hoạt động với RTSP streaming
- [ ] `npm run prebuild` chạy thành công
- [ ] `npm run build-win` hoàn thành không lỗi
- [ ] File `dist/win-unpacked/resources/app.asar.unpacked/ffmpeg-binary/ffmpeg.exe` tồn tại
- [ ] App build có thể start và load frontend
- [ ] RTSP streaming hoạt động trong app build
- [ ] Console logs hiển thị FFmpeg path đúng

## Tips
1. **Luôn chạy prebuild trước khi build**: `npm run prebuild`
2. **Kiểm tra logs**: Mở DevTools để xem FFmpeg path nào được sử dụng
3. **Test unpacked version trước**: Test trong `dist/win-unpacked/` trước khi test installer
4. **Backup FFmpeg**: Giữ copy của `ffmpeg-binary/ffmpeg.exe` để đảm bảo
