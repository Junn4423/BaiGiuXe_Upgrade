# HƯỚNG DẪN SETUP FACE RECOGNITION SYSTEM

## 📋 Tổng quan

Bộ script này giúp thiết lập môi trường cho:

- **Face Recognition System**: Hệ thống nhận diện khuôn mặt
- **Silent Face Anti-Spoofing**: Hệ thống chống giả mạo khuôn mặt

## � Cách sử dụng nhanh

### 1. Khởi động hệ thống (Khuyến nghị):

```batch
manage_face_recognition.bat
```

Menu quản lý toàn diện với các tùy chọn:

- [1] Start Face Recognition System
- [2] Test Silent Face Anti-Spoofing
- [3] Setup/Install Dependencies
- [4] Check System Status
- [5] Configuration Menu
- [6] Troubleshooting

### 2. Setup lần đầu:

```batch
setup_master_simple.bat
```

Hoặc kiểm tra requirements trước:

```batch
check_requirements.bat
```

### 3. Chạy Face Recognition:

```batch
cd face_recognition_system
start_face_recognition.bat
```

### 4. Test Anti-Spoofing:

```batch
cd face_recognition_system\Silent-Face-Anti-Spoofing
run_test.bat
```

## �🔧 Yêu cầu hệ thống

### Bắt buộc:

- **OS**: Windows 10/11 (64-bit khuyến nghị)
- **Python**: 3.8 hoặc cao hơn
- **RAM**: Tối thiểu 4GB (khuyến nghị 8GB+)
- **Disk**: Ít nhất 5GB trống
- **Internet**: Để tải packages
- **Camera**: Webcam hoặc camera USB

### Tùy chọn:

- **Visual Studio Build Tools**: Cho dlib compilation
- **CUDA**: Cho GPU acceleration
- **Git**: Cho version control

## 🚀 Cách sử dụng

### Bước 1: Kiểm tra requirements

```batch
check_requirements.bat
```

Script này sẽ kiểm tra tất cả yêu cầu hệ thống và đưa ra khuyến nghị.

### Bước 2: Setup tổng hợp (Khuyến nghị)

```batch
setup_master.bat
```

Script chính với menu lựa chọn:

- [1] Setup Face Recognition System
- [2] Setup Silent Face Anti-Spoofing
- [3] Setup cả hai hệ thống
- [4] Chỉ tạo virtual environment

### Bước 3: Setup riêng lẻ (Tùy chọn)

#### Face Recognition System:

```batch
setup_face_recognition.bat
```

#### Silent Face Anti-Spoofing:

```batch
setup_silent_face_anti_spoofing.bat
```

## 📁 Cấu trúc thư mục sau setup

```
backend/khuonmat/
├── setup_master.bat                 # Script setup tổng hợp
├── setup_face_recognition.bat       # Setup Face Recognition
├── setup_silent_face_anti_spoofing.bat # Setup Anti-Spoofing
├── check_requirements.bat           # Kiểm tra requirements
├── README_SETUP.md                  # File này
└── face_recognition_system/
    ├── venv/                        # Virtual environment
    ├── app.py                       # Flask application
    ├── config.py                    # Database configuration
    ├── requirements.txt             # Python dependencies
    ├── static/uploads/              # Upload folder
    ├── templates/                   # HTML templates
    ├── models/                      # ML models
    └── Silent-Face-Anti-Spoofing/
        ├── venv_spoofing/           # Virtual env cho anti-spoofing
        ├── resources/               # Model files
        ├── src/                     # Source code
        ├── test_setup.py            # Test script
        └── config.py                # Anti-spoofing config
```

## ⚙️ Cấu hình

### 1. Database Configuration

Chỉnh sửa `face_recognition_system/config.py`:

```python
SQLALCHEMY_DATABASE_URI = 'mysql+mysqlconnector://username:password@localhost/database_name'
SECRET_KEY = 'your-secret-key-here'
```

### 2. Anti-Spoofing Configuration

Chỉnh sửa `Silent-Face-Anti-Spoofing/config.py`:

```python
MODEL_PATH = 'resources/anti_spoof_models/'
DEVICE = 'cpu'  # hoặc 'cuda' nếu có GPU
DETECTION_THRESHOLD = 0.5
SPOOF_THRESHOLD = 0.9
```

## 🏃‍♂️ Chạy ứng dụng

### Face Recognition System:

```batch
cd face_recognition_system
venv\Scripts\activate
python app.py
```

### Test Anti-Spoofing:

```batch
cd face_recognition_system\Silent-Face-Anti-Spoofing
python test_setup.py
```

## 🔍 Troubleshooting

### Lỗi thường gặp:

#### 1. `dlib installation failed`

**Nguyên nhân**: Thiếu Visual C++ Build Tools
**Giải pháp**:

- Cài đặt Visual C++ Redistributable
- Hoặc cài pre-compiled wheel: `pip install dlib-19.22.99-cp39-cp39-win_amd64.whl`

#### 2. `face_recognition import error`

**Nguyên nhân**: dlib chưa cài đặt đúng
**Giải pháp**:

- Cài đặt dlib trước
- Sau đó cài face_recognition

#### 3. `MySQL connection failed`

**Nguyên nhân**: MySQL server chưa chạy hoặc config sai
**Giải pháp**:

- Khởi động MySQL server
- Kiểm tra connection string trong config.py

#### 4. `Camera not detected`

**Nguyên nhân**: Driver camera chưa cài hoặc camera bị khóa
**Giải pháp**:

- Cài đặt driver camera
- Kiểm tra camera trong Device Manager
- Đóng các ứng dụng khác đang sử dụng camera

#### 5. `Permission denied`

**Nguyên nhân**: Không đủ quyền ghi file
**Giải pháp**: Chạy Command Prompt với quyền Administrator

### Debug commands:

```batch
# Kiểm tra Python packages
pip list

# Test import
python -c "import cv2, face_recognition, torch; print('All OK')"

# Kiểm tra camera
python -c "import cv2; cap=cv2.VideoCapture(0); print('Camera OK' if cap.isOpened() else 'Camera Error')"
```

## 📦 Dependencies chính

### Face Recognition System:

- Flask 2.3.3
- OpenCV 4.8.1.78
- face_recognition 1.3.0
- SQLAlchemy 3.0.5
- MySQL Connector 8.2.0

### Silent Face Anti-Spoofing:

- PyTorch
- torchvision
- OpenCV
- NumPy
- easydict

## 🔄 Update và Maintenance

### Cập nhật dependencies:

```batch
cd face_recognition_system
venv\Scripts\activate
pip install --upgrade -r requirements.txt
```

### Backup cấu hình:

- Sao lưu file `config.py`
- Sao lưu thư mục `models/`
- Sao lưu database

### Reset environment:

```batch
rmdir /s /q venv
setup_face_recognition.bat
```

## 📞 Hỗ trợ

### Trước khi báo lỗi:

1. Chạy `check_requirements.bat` để kiểm tra hệ thống
2. Kiểm tra log files trong `saved_logs/`
3. Test từng component riêng lẻ

### Thông tin cần cung cấp khi báo lỗi:

- Output của `check_requirements.bat`
- Thông báo lỗi đầy đủ
- Python version và OS version
- Các bước đã thực hiện

## 📝 License

Tuân theo license của các project gốc:

- Face Recognition: MIT License
- Silent Face Anti-Spoofing: Apache License 2.0

---

**Lưu ý**: Đảm bảo tuân thủ các quy định về bảo mật và quyền riêng tư khi sử dụng hệ thống nhận diện khuôn mặt.
