# Production Build Guide - Windows

## Tổng quan
Hướng dẫn này sẽ giúp bạn tạo bản build production cho hệ thống Parking Lot Management trên Windows.

## Yêu cầu hệ thống

### Phần mềm cần thiết:
- **Node.js** (v16+ recommended)
- **npm** (v8+ recommended) 
- **Python** (v3.8+ cho backend)
- **Git** (để quản lý source code)

### Kiểm tra môi trường:
```bash
node --version
npm --version
python --version
git --version
```

## Chuẩn bị Build

### 1. Cài đặt dependencies
```bash
cd electron-app
npm install
```

### 2. Cài đặt Python dependencies (nếu cần)
```bash
cd ../backend
pip install -r requirements.txt
```

### 3. Build frontend
```bash
cd ../frontend
npm install
npm run build
```

## Các phương pháp Build Production

### Phương pháp 1: Script tự động (Khuyến nghị)
```bash
cd electron-app
.\build-production-windows.bat
```

**Tính năng của script:**
- ✅ Tự động clean cache và build cũ
- ✅ Verify FFmpeg installation
- ✅ Build frontend với optimizations
- ✅ Build Electron app với compression cao
- ✅ Tạo cả installer và portable app
- ✅ Verify build outputs
- ✅ Test FFmpeg trong production build

### Phương pháp 2: Manual commands
```bash
cd electron-app

# Clean previous builds
npm run prebuild

# Set production environment
set NODE_ENV=production

# Build with optimization
npm run build-production
```

### Phương pháp 3: Full production build
```bash
npm run build-production-full
```

## Build Outputs

Sau khi build thành công, bạn sẽ có các file trong `dist/`:

### 1. Windows Installer (NSIS)
- **File:** `Parking Lot Management Setup.exe`
- **Loại:** Full installer với uninstaller
- **Kích cỡ:** ~150-200MB
- **Phân phối:** End users, production deployment

### 2. Portable Application  
- **File:** `Parking Lot Management [version].exe`
- **Loại:** Single executable, no installation needed
- **Kích cỡ:** ~150-200MB
- **Phân phối:** Quick testing, portable usage

### 3. Unpacked Application
- **Thư mục:** `win-unpacked/`
- **File chính:** `Parking Lot Management.exe`
- **Loại:** Development testing, debugging
- **Phân phối:** Internal testing only

## Verification và Testing

### 1. Automated Testing
```bash
npm run test-production
```

### 2. Manual Testing Checklist

#### Basic Functionality:
- [ ] App khởi động không lỗi
- [ ] UI hiển thị đúng
- [ ] Navigation hoạt động
- [ ] Responsive design

#### Core Features:
- [ ] Camera streaming (RTSP)
- [ ] License plate recognition (ALPR)
- [ ] Database operations
- [ ] File upload/download
- [ ] Python backend integration

#### Performance:
- [ ] App khởi động nhanh (<10 giây)
- [ ] Memory usage ổn định
- [ ] CPU usage không cao
- [ ] No memory leaks

#### Integration:
- [ ] FFmpeg video processing
- [ ] MinIO file storage
- [ ] MySQL database
- [ ] Python ALPR service

## Troubleshooting

### Build Errors

#### 1. FFmpeg Missing
**Lỗi:** `FFmpeg binary not found`
**Giải pháp:**
```bash
node debug-ffmpeg.js
node ffmpeg-downloader.js
```

#### 2. Frontend Build Failed
**Lỗi:** `Frontend build failed`
**Giải pháp:**
```bash
cd ../frontend
rm -rf node_modules
npm install
npm run build
```

#### 3. Python Dependencies
**Lỗi:** `Python requirements missing`
**Giải pháp:**
```bash
cd ../backend
pip install --upgrade pip
pip install -r requirements.txt
```

#### 4. Node Modules Issues
**Lỗi:** `Module not found`
**Giải pháp:**
```bash
cd electron-app
rm -rf node_modules
npm cache clean --force
npm install
```

### Runtime Errors

#### 1. App Won't Start
- Kiểm tra Windows compatibility
- Chạy từ Command Prompt để xem error logs
- Verify Visual C++ Redistributables

#### 2. Camera Not Working
- Kiểm tra RTSP URL
- Verify FFmpeg integration
- Check firewall settings

#### 3. Database Connection
- Verify MySQL service running
- Check connection strings
- Test network connectivity

## Performance Optimization

### Build Optimizations
- **Compression:** Maximum (level 9)
- **Tree shaking:** Enabled
- **Minification:** Enabled  
- **Source maps:** Disabled

### Runtime Optimizations
- **ASAR packaging:** Enabled với exceptions
- **Code signing:** Disabled (for faster builds)
- **Auto-updater:** Disabled

## Distribution

### Internal Testing
1. Dùng `win-unpacked/` version
2. Test đầy đủ tính năng
3. Document bugs và issues

### Production Release
1. Dùng `Setup.exe` installer
2. Test installation process
3. Verify uninstaller works
4. Test on clean Windows machines

### Portable Distribution
1. Dùng portable `.exe` file
2. Test trên máy không có dependencies
3. Verify all features work standalone

## Best Practices

### 1. Version Management
- Update `package.json` version trước build
- Tag Git commits cho production builds
- Keep build logs cho debugging

### 2. Testing Strategy
- Test trên nhiều Windows versions
- Test với và không có internet
- Test với antivirus software

### 3. Documentation
- Document configuration changes
- Keep changelog updated
- Maintain deployment notes

## Support và Debug

### Log Files
- **Electron:** `%APPDATA%/parking-lot-management/logs/`
- **Python:** Backend log files
- **FFmpeg:** Console output

### Debug Mode
```bash
# Development mode for debugging
npm run dev
```

### Production Debug
```bash
# Enable console in production
set DEBUG=true
.\dist\win-unpacked\Parking\ Lot\ Management.exe
```

---

**Lưu ý:** Luôn test production build trên clean Windows machine trước khi phân phối.
