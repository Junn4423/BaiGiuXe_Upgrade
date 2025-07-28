# RTSP Streaming Fix for Electron App Build

## Vấn đề
Khi chạy `npm start` (development mode), RTSP streaming hoạt động bình thường, nhưng khi build thành file .exe, RTSP không hoạt động mặc dù data connection vẫn bình thường.

## Nguyên nhân
1. **FFmpeg binary không được bundle đúng cách**: Package `ffmpeg-static` chứa file binary ffmpeg.exe, nhưng khi build Electron thành .exe, file binary này không được copy vào bundle hoặc không tìm thấy đúng đường dẫn.

2. **Path resolution khác nhau**: Đường dẫn đến ffmpeg khác nhau giữa development (`__dirname/node_modules/ffmpeg-static/`) và production (`process.resourcesPath/app.asar.unpacked/`).

3. **ASAR packaging**: Electron đóng gói code thành file .asar, nhưng binary files cần được unpack để có thể execute.

## Giải pháp đã implement

### 1. Cập nhật package.json - Build Configuration
```json
{
  "build": {
    "files": [
      "node_modules/ffmpeg-static/**/*"
    ],
    "asarUnpack": [
      "node_modules/ffmpeg-static/**/*"
    ]
  }
}
```

### 2. Smart FFmpeg Path Resolution
Tạo logic thông minh để tìm FFmpeg trong cả development và production:

```javascript
// rtsp-streaming-server.js
const possiblePaths = [
  // Development paths
  path.join(__dirname, 'node_modules', 'ffmpeg-static', 'ffmpeg.exe'),
  
  // Production ASAR unpacked paths
  path.join(process.resourcesPath, 'app.asar.unpacked', 'node_modules', 'ffmpeg-static', 'ffmpeg.exe'),
  
  // Custom backup path
  path.join(__dirname, 'ffmpeg-binary', 'ffmpeg.exe'),
  
  // System fallback
  'ffmpeg'
]
```

### 3. FFmpeg Backup System
Tạo system backup để copy FFmpeg binary vào thư mục riêng:

```javascript
// ffmpeg-downloader.js - Copy FFmpeg to backup location
const ffmpegStatic = require('ffmpeg-static')
fs.copyFileSync(ffmpegStatic, './ffmpeg-binary/ffmpeg.exe')
```

### 4. Debug Tools
- `debug-ffmpeg.js`: Tool để debug tất cả đường dẫn FFmpeg
- `prebuild.js`: Script chạy trước khi build để setup FFmpeg
- Logging chi tiết trong production

## Cách sử dụng

### Build với fix này:
```bash
# Method 1: Sử dụng script enhanced
.\build-windows-enhanced.bat

# Method 2: Manual
npm run prebuild
npm run build-win
```

### Kiểm tra FFmpeg:
```bash
# Test FFmpeg paths
node debug-ffmpeg.js

# Test prebuild setup
node prebuild.js
```

## Kiểm tra sau khi build

1. **Check unpacked folder**: Trong `dist/win-unpacked/resources/app.asar.unpacked/node_modules/ffmpeg-static/` phải có `ffmpeg.exe`

2. **Check console logs**: Khi chạy app build, check console để xem FFmpeg path nào được sử dụng:
   ```
   🔧 Using FFmpeg path in production: C:\path\to\ffmpeg.exe
   ```

3. **Test RTSP connection**: Mở DevTools và kiểm tra:
   - WebSocket connection đến port 9999
   - FFmpeg process logs
   - RTSP streaming data

## Troubleshooting

### Nếu vẫn không hoạt động:

1. **Thêm system FFmpeg**:
   - Download FFmpeg từ https://ffmpeg.org/download.html
   - Extract và thêm vào PATH
   - App sẽ fallback sử dụng system FFmpeg

2. **Check file permissions**:
   - Đảm bảo `ffmpeg.exe` có execute permissions
   - Chạy app với quyền administrator nếu cần

3. **Disable antivirus temporarily**:
   - Một số antivirus có thể block ffmpeg.exe
   - Thêm exception cho thư mục app

4. **Manual copy**:
   ```bash
   # Copy FFmpeg manually vào build folder
   copy "node_modules\ffmpeg-static\ffmpeg.exe" "dist\win-unpacked\ffmpeg.exe"
   ```

## Files đã thay đổi:
- ✅ `package.json` - Added asarUnpack and files config
- ✅ `rtsp-streaming-server.js` - Smart path resolution
- ✅ `rtsp-server.js` - Smart path resolution  
- ✅ `main.js` - Added debug logging
- ✅ `debug-ffmpeg.js` - Debug tool
- ✅ `ffmpeg-downloader.js` - Backup system
- ✅ `prebuild.js` - Pre-build setup
- ✅ `build-windows-enhanced.bat` - Enhanced build script

## Kết quả mong đợi:
- ✅ RTSP streaming hoạt động trong cả development và production
- ✅ FFmpeg được bundle đúng cách trong .exe file
- ✅ Fallback system đảm bảo app vẫn hoạt động ngay cả khi bundled FFmpeg bị lỗi
- ✅ Debug tools giúp troubleshoot nhanh chóng

## Note:
Nếu app của bạn sẽ deploy trên nhiều hệ điều hành khác nhau, có thể cần adjust logic để handle FFmpeg binary cho Linux/Mac:
- Linux: `ffmpeg` (no .exe extension)
- Mac: `ffmpeg` (no .exe extension)
- Windows: `ffmpeg.exe`
