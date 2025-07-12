# Hướng dẫn đóng gói ứng dụng Parking Lot Management

## Yêu cầu hệ thống

### Tất cả platforms:
- Node.js (phiên bản 16 trở lên)
- npm hoặc yarn
- Git

### Để build cho Windows:
- Windows 10/11
- Visual Studio Build Tools (tùy chọn, cho native modules)

### Để build cho macOS:
- macOS 10.14 trở lên
- Xcode Command Line Tools

### Để build cho Linux:
- Ubuntu 18.04 trở lên (hoặc tương đương)
- build-essential package

## Cài đặt dependencies

```bash
# Trong thư mục electron-app
npm install

# Trong thư mục frontend
cd ../frontend
npm install
cd ../electron-app
```

## Build cho từng platform

### 1. Build cho Windows

#### Trên Windows:
```cmd
# Chạy script tự động
build-windows.bat

# Hoặc chạy thủ công
npm run build-frontend
npm run build-win
```

#### Output:
- `dist/Parking Lot Management Setup 1.0.0.exe` - NSIS installer
- `dist/Parking Lot Management 1.0.0.exe` - Portable version

### 2. Build cho macOS

#### Trên macOS:
```bash
# Build frontend trước
npm run build-frontend

# Build cho macOS
npm run build-mac
```

#### Output:
- `dist/Parking Lot Management-1.0.0.dmg` - DMG installer
- `dist/Parking Lot Management-1.0.0-mac.zip` - ZIP archive

### 3. Build cho Linux

#### Trên Linux:
```bash
# Build frontend trước
npm run build-frontend

# Build cho Linux
npm run build-linux
```

#### Output:
- `dist/Parking Lot Management-1.0.0.AppImage` - AppImage
- `dist/parking-lot-management_1.0.0_amd64.deb` - Debian package
- `dist/parking-lot-management-1.0.0.x86_64.rpm` - Red Hat package

### 4. Build cho tất cả platforms

#### Cross-platform build:
```bash
# Trên Linux/macOS
chmod +x build-all.sh
./build-all.sh

# Hoặc thủ công
npm run build-all
```

## Scripts có sẵn

```json
{
  "build-frontend": "cd ../frontend && npm run build",
  "prebuild": "npm run build-frontend",
  "build": "electron-builder",
  "build-win": "electron-builder --win",
  "build-mac": "electron-builder --mac", 
  "build-linux": "electron-builder --linux",
  "build-all": "electron-builder --win --mac --linux",
  "pack": "electron-builder --dir",
  "dist": "npm run build-frontend && electron-builder"
}
```

## Cấu trúc output

```
dist/
├── win-unpacked/                      # Windows unpacked
├── mac/                               # macOS unpacked
├── linux-unpacked/                    # Linux unpacked
├── Parking Lot Management Setup 1.0.0.exe    # Windows NSIS installer
├── Parking Lot Management 1.0.0.exe           # Windows portable
├── Parking Lot Management-1.0.0.dmg           # macOS DMG
├── Parking Lot Management-1.0.0-mac.zip       # macOS ZIP
├── Parking Lot Management-1.0.0.AppImage      # Linux AppImage
├── parking-lot-management_1.0.0_amd64.deb     # Linux DEB
└── parking-lot-management-1.0.0.x86_64.rpm    # Linux RPM
```

## Troubleshooting

### Lỗi thường gặp:

1. **Node.js version cũ**
   ```bash
   # Cập nhật Node.js lên phiên bản 16+
   node --version
   ```

2. **Native dependencies lỗi**
   ```bash
   # Rebuild native modules
   npm rebuild
   ```

3. **Thiếu Python (trên Windows)**
   ```bash
   # Cài Python hoặc dùng build tools
   npm install --global windows-build-tools
   ```

4. **Lỗi quyền trên Linux/macOS**
   ```bash
   # Chạy với sudo nếu cần
   sudo npm run build-linux
   ```

### Tối ưu hóa:

1. **Giảm kích thước bundle:**
   - Loại bỏ devDependencies trong production
   - Sử dụng asar packing
   - Compress native modules

2. **Tăng tốc build:**
   - Cache dependencies
   - Build song song cho nhiều platforms
   - Sử dụng Docker cho consistency

## Icons

Đặt các file icon vào thư mục `assets/`:
- `icon.ico` - Windows (256x256, 32-bit)
- `icon.png` - Linux (512x512, PNG)
- `icon.icns` - macOS (512x512, ICNS format)

## Code Signing (Tùy chọn)

### Windows:
```json
"win": {
  "certificateFile": "cert.p12",
  "certificatePassword": "password"
}
```

### macOS:
```json
"mac": {
  "identity": "Developer ID Application: Your Name"
}
```

## Distribution

Sau khi build, các file installer có thể:
- Upload lên website
- Distribute qua Microsoft Store (Windows)
- Upload lên Mac App Store (macOS)
- Distribute qua Snap Store (Linux)

## Support

Để được hỗ trợ, tạo issue trong repository với thông tin:
- Operating System
- Node.js version
- Error logs
- Steps to reproduce
