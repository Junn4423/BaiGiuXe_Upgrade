# Parking Lot Management - Build Guide với Python Integration

## 📋 Tổng quan

Hệ thống quản lý bãi đỗ xe với tích hợp Python ALPR (Automatic License Plate Recognition) service. Ứng dụng Electron kết hợp với React frontend và Python backend để nhận dạng biển số xe tự động.

## 🔧 Yêu cầu hệ thống

### Bắt buộc:
- **Node.js** 16+ và npm
- **Python** 3.8+ (với pip)
- **Windows** 10/11 (cho build Windows)

### Tùy chọn:
- **Git** (để clone repository)
- **Visual Studio Code** (recommended IDE)

## 🚀 Hướng dẫn Setup

### 1. Cài đặt Python Dependencies

```bash
cd electron-app
./setup-python-deps.bat
```

### 2. Test Python Service

```bash
./test-python-service.bat
```

### 3. Build Application

#### Build thông thường:
```bash
./build-windows.bat
```

#### Build với Python integration (Recommended):
```bash
./build-windows-python-integrated.bat
```

#### Build nâng cao:
```bash
./build-windows-enhanced.bat
```

## 📁 Cấu trúc file được tạo

### Development Scripts:
- `setup-python-deps.bat` - Cài đặt Python dependencies
- `test-python-service.bat` - Test Python ALPR service
- `start-app.bat` - Khởi động ứng dụng với full setup

### Build Scripts:
- `build-windows-python-integrated.bat` - **Build với Python integration**
- `build-windows-enhanced.bat` - Build với kiểm tra toàn diện
- `build-windows.bat` - Build cơ bản

## 🔄 Quy trình Build chi tiết

### `build-windows-python-integrated.bat` thực hiện:

1. **🧹 Cleanup** - Xóa build cũ
2. **🐍 Python Setup** - Kiểm tra và cài đặt Python dependencies
3. **📦 Node.js Dependencies** - Cài đặt npm packages
4. **🏗️ Frontend Build** - Build React application
5. **🧪 Service Testing** - Test Python ALPR service
6. **📱 Electron Build** - Build ứng dụng Electron
7. **🔧 Verification** - Kiểm tra các thành phần
8. **📋 Summary** - Báo cáo kết quả

### Output files trong `dist/`:
- `Parking Lot Management Setup.exe` - Installer
- `win-unpacked/` - Unpacked application
  - `Parking Lot Management.exe` - Main executable
  - `resources/app.asar.unpacked/backend/` - Python service files
  - `resources/app.asar.unpacked/ffmpeg-binary/` - FFmpeg binaries

## 🎯 Tính năng tích hợp

### Python ALPR Service:
- ✅ Tự động khởi động với ứng dụng
- ✅ Auto-restart khi crash
- ✅ Health check endpoints
- ✅ Real-time license plate recognition
- ✅ FastAPI backend trên port 5001

### RTSP Streaming:
- ✅ Camera streaming support
- ✅ FFmpeg integration
- ✅ Real-time video processing

### Electron Features:
- ✅ Full-screen application
- ✅ Cross-platform file operations
- ✅ Image saving and management
- ✅ Directory operations

## 🛠️ Troubleshooting

### Python Issues:
```bash
# Test Python installation
python --version

# Test pip installation
pip --version

# Reinstall dependencies
pip install -r ../backend/requirements.txt --force-reinstall
```

### Build Issues:
```bash
# Clean all dependencies
rm -rf node_modules
rm -rf dist
npm install

# Clean Python cache
python -c "import sys; print(sys.path)"
pip cache purge
```

### Service Issues:
```bash
# Test ALPR service manually
cd ../backend/bienso
python fast_alpr_service.py

# Check port availability
netstat -an | findstr 5001
```

## 📱 Chạy ứng dụng

### Development:
```bash
npm run start-with-python
```

### Production (sau khi build):
```bash
./start-app.bat
# hoặc
dist/win-unpacked/Parking Lot Management.exe
```

## 🔍 Monitoring & Logs

### Console logs sẽ hiển thị:
- ✅ Python service status
- ✅ RTSP server status  
- ✅ FFmpeg operations
- ✅ License plate detection results
- ✅ Camera streaming status

### Service endpoints:
- **ALPR Health Check**: http://127.0.0.1:5001/healthz
- **ALPR Detection**: http://127.0.0.1:5001/detect (POST)
- **RTSP Server**: Port 9999

## 📞 Support

Nếu gặp vấn đề:
1. Chạy `test-python-service.bat` để kiểm tra Python service
2. Kiểm tra console logs trong ứng dụng
3. Verify Python và Node.js versions
4. Check firewall settings cho ports 5001, 9999

---

**Happy coding! 🚗💨**
