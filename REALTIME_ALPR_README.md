# 🚗 Parking Lot Management System với Realtime License Plate Detection

## 📋 Tổng quan

Hệ thống quản lý bãi đỗ xe tích hợp nhận dạng biển số xe realtime sử dụng AI với các tính năng:

- ✅ **Realtime License Plate Detection**: Nhận dạng biển số xe liên tục 15fps
- ✅ **Overlay Bounding Boxes**: Khung vuông hiển thị vị trí biển số trên camera
- ✅ **Dual Camera Support**: Camera biển số vào/ra với detection riêng biệt  
- ✅ **Fallback Mechanism**: Tự động sử dụng biển số từ realtime nếu API timeout
- ✅ **Backend ALPR Service**: Python FastAPI service với fast_alpr library
- ✅ **Electron Application**: Desktop app với RTSP streaming

## 🏗️ Kiến trúc hệ thống

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Frontend      │    │   Backend       │    │   Electron      │
│   (React)       │    │   (Python)      │    │   (Desktop)     │
│                 │    │                 │    │                 │
│ • RTSPPlayer    │◄──►│ • ALPR Service  │◄──►│ • Main Process  │
│ • Camera UI     │    │ • fast_alpr     │    │ • RTSP Server   │
│ • Overlay       │    │ • FastAPI       │    │ • File System   │
└─────────────────┘    └─────────────────┘    └─────────────────┘
```

## 🚀 Cài đặt và Chạy

### Bước 1: Setup Python Environment (Lần đầu)

```batch
# Chạy file setup để cài đặt Python environment
SETUP_PYTHON_ENV.bat
```

### Bước 2: Chạy Production Mode

```batch
# Build frontend và start toàn bộ hệ thống
START_PARKING_SYSTEM.bat
```

### Bước 3: Chạy Development Mode (cho dev)

```batch
# Start development servers
START_DEV_MODE.bat
```

## 🔧 Cấu hình

### Camera Setup
- Cấu hình RTSP URLs trong camera management
- Đảm bảo cameras có chức năng "BIENSO" cho license plate detection

### ALPR Service
- Port: `127.0.0.1:5001`
- Model: Tự động load fast_alpr model
- Endpoint: `POST /detect` cho realtime detection

### Realtime Detection Settings
- Frame rate: 15 FPS
- Timeout: 1 giây (fallback mechanism)
- Overlay: Bounding boxes với màu lime

## 📁 Cấu trúc Project

```
parkinglot/
├── backend/
│   └── bienso/
│       ├── fast_alpr_service.py     # Python ALPR service
│       └── venv/                    # Python virtual environment
├── frontend/
│   └── src/
│       └── components/
│           ├── RTSPPlayer.jsx       # Realtime detection overlay
│           └── CameraComponent.jsx  # Camera UI with license plate display
├── electron-app/
│   ├── main.js                      # Electron main process
│   └── rtsp-streaming-server.js     # RTSP server
├── START_PARKING_SYSTEM.bat         # Production launcher
├── START_DEV_MODE.bat              # Development launcher
└── SETUP_PYTHON_ENV.bat           # Python environment setup
```

## 🎯 Tính năng Realtime Detection

### RTSPPlayer Component
- Capture frames từ RTSP stream liên tục
- Send frames đến ALPR service qua HTTP POST
- Vẽ bounding boxes overlay trên canvas
- Callback `onPlateDetected` để update UI

### CameraComponent
- Hiển thị detected license plates dưới camera panels
- Fallback text: "Chờ nhận diện..." khi chưa detect
- Update real-time theo kết quả từ RTSPPlayer

### Backend ALPR Service
- FastAPI server với endpoint `/detect`
- Xử lý multipart form data (image files)
- Trả về JSON với bounding boxes và plate text
- CORS enabled cho Electron/React frontend

## 🔄 Luồng hoạt động

1. **Camera Streaming**: RTSP streams được hiển thị trong RTSPPlayer
2. **Frame Capture**: Tự động capture frames 15fps từ video element
3. **ALPR Detection**: Send frames đến Python service qua HTTP
4. **Overlay Rendering**: Vẽ bounding boxes trên canvas overlay
5. **UI Update**: Update license plate text dưới camera panels
6. **Fallback**: Khi scan thẻ, nếu API timeout → dùng detected plate từ realtime

## 🐛 Troubleshooting

### ALPR Service không start
```batch
# Kiểm tra Python environment
cd backend\bienso
venv\Scripts\activate
python fast_alpr_service.py
```

### Camera không hiển thị
- Kiểm tra RTSP URLs trong camera config
- Đảm bảo cameras accessible từ network

### Realtime detection không hoạt động
- Kiểm tra console browser (F12) 
- Verify ALPR service: http://127.0.0.1:5001/healthz
- Check network requests trong Developer Tools

### Performance issues
- Giảm frame rate trong RTSPPlayer (SNAP_INTERVAL)
- Optimize camera resolution
- Check CPU/GPU usage của ALPR service

## 📊 Monitoring

### ALPR Service Health
```bash
GET http://127.0.0.1:5001/healthz
```

### Debug Console Logs
- RTSPPlayer: Realtime detection logs
- CameraComponent: Plate display updates  
- Main UI: Card scanning và fallback logic

## 🔒 Security Notes

- ALPR service chỉ bind localhost (127.0.0.1)
- CORS enabled cho development, giới hạn trong production
- No authentication required cho internal service

## 📈 Performance Tips

1. **GPU Acceleration**: Install fast_alpr với GPU support
2. **Memory Management**: Limit frame queue size trong RTSPPlayer  
3. **Network Optimization**: Giảm resolution hoặc frame rate nếu cần
4. **Model Optimization**: Sử dụng lighter ALPR models cho realtime

## 🎉 Kết quả mong đợi

- ✅ 2 panel camera biển số (vào/ra) có overlay detection realtime
- ✅ Bounding boxes hiển thị vị trí biển số 
- ✅ Text detected hiển thị dưới camera panels
- ✅ Fallback mechanism khi scan thẻ và API timeout
- ✅ Desktop application hoạt động ổn định với tất cả tính năng

---

**Lưu ý**: Đảm bảo có kết nối internet để download models lần đầu và cameras accessible qua RTSP.
