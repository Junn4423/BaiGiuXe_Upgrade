# Hướng dẫn đóng gói ứng dụng Electron cho Windows, Mac và Linux

## Chuẩn bị trước khi build

### 1. Cài đặt dependencies
```bash
# Trong thư mục electron-app
npm install

# Trong thư mục frontend
cd ../frontend
npm install
cd ../electron-app
```

### 2. Chuẩn bị icon files
Thêm các file icon sau vào thư mục `electron-app/assets/`:
- `icon.ico` (256x256 pixels) - Cho Windows
- `icon.png` (512x512 pixels) - Cho Linux
- `icon.icns` (512x512 pixels) - Cho macOS

### 3. Build frontend trước
```bash
npm run build-frontend
```

## Build cho Windows

### Option 1: Sử dụng npm script
```bash
npm run build-win
```

### Option 2: Sử dụng batch script
```bash
build-windows.bat
```

### Output Windows:
- `dist/Parking Lot Management Setup.exe` - Installer
- `dist/Parking Lot Management.exe` - Portable

## Build cho macOS (trên macOS)

### Cài đặt thêm cho macOS:
```bash
# Cần có Xcode Command Line Tools
xcode-select --install
```

### Build:
```bash
npm run build-mac
```

### Output macOS:
- `dist/Parking Lot Management-1.0.0.dmg` - DMG installer
- `dist/Parking Lot Management-1.0.0-mac.zip` - ZIP archive

## Build cho Linux (trên Linux/WSL)

### Cài đặt thêm cho Linux:
```bash
# Ubuntu/Debian
sudo apt install fakeroot dpkg rpm

# CentOS/RHEL
sudo yum install rpm-build
```

### Build:
```bash
npm run build-linux
```

### Output Linux:
- `dist/Parking Lot Management-1.0.0.AppImage` - Portable
- `dist/parking-lot-management_1.0.0_amd64.deb` - Debian package
- `dist/parking-lot-management-1.0.0.x86_64.rpm` - RPM package

## Build cho tất cả platforms

### Sử dụng script tự động:
```bash
# Windows
build-all.bat

# macOS/Linux
chmod +x build-all.sh
./build-all.sh
```

### Hoặc:
```bash
npm run build-all
```

## Khắc phục lỗi thường gặp

### 1. Lỗi symlink trên Windows
Chạy PowerShell hoặc Command Prompt với quyền Administrator:
```bash
# Bật Developer Mode hoặc chạy với admin
# Settings > Update & Security > For developers > Developer mode: On
```

### 2. Lỗi thiếu icon
```bash
# Thêm icon files vào assets/ hoặc tạm thời disable icon
npm run build-win -- --config.win.icon=null
```

### 3. Lỗi code signing
```bash
# Tạm thời disable code signing
npm run build-win -- --config.win.certificateFile=null
```

### 4. Lỗi NSIS
```bash
# Cài đặt NSIS trên Windows
# Download từ: https://nsis.sourceforge.io/Download
```

## Cấu trúc output sau khi build

```
dist/
├── win-unpacked/                 # Windows unpacked
├── linux-unpacked/               # Linux unpacked  
├── mac/                          # macOS unpacked
├── Parking Lot Management Setup.exe    # Windows installer
├── Parking Lot Management.exe          # Windows portable
├── Parking Lot Management-1.0.0.dmg    # macOS DMG
├── parking-lot-management_1.0.0_amd64.deb  # Linux DEB
└── parking-lot-management-1.0.0.x86_64.rpm # Linux RPM
```

## Publish và Distribution

### 1. GitHub Releases
Cấu hình trong package.json:
```json
"publish": {
  "provider": "github",
  "owner": "your-username", 
  "repo": "parking-lot-management"
}
```

### 2. Auto-updater
Thêm electron-updater:
```bash
npm install electron-updater
```

## Testing

### Test trên Windows:
1. Chạy installer: `dist/Parking Lot Management Setup.exe`
2. Test portable: `dist/Parking Lot Management.exe`

### Test shortcuts:
- F12: Mở trang thống kê
- Ctrl+F12: Mở trang thống kê (alternative)

## Performance Tips

1. **Giảm kích thước bundle:**
   - Xóa dev dependencies trong production
   - Nén assets và images
   - Tree-shaking unused code

2. **Tăng tốc build:**
   - Sử dụng electron-rebuild cho native modules
   - Cache node_modules
   - Build trên SSD

3. **Cross-platform:**
   - Test trên VM hoặc GitHub Actions
   - Sử dụng Docker cho consistent builds
