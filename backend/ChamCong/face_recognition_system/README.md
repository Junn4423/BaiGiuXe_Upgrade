# Hệ thống điểm danh bằng khuôn mặt

Hệ thống điểm danh tự động sử dụng công nghệ nhận diện khuôn mặt thông qua camera.

## Tính năng

- ✅ Đăng ký nhân viên với ảnh khuôn mặt
- ✅ Điểm danh tự động khi nhận diện khuôn mặt qua camera
- ✅ Theo dõi giờ vào/ra
- ✅ Phân loại trạng thái (đúng giờ, đi muộn, vắng mặt)
- ✅ Báo cáo điểm danh theo ngày
- ✅ Giao diện web thân thiện, responsive

## Yêu cầu hệ thống

- Python 3.8+
- Camera (webcam hoặc camera USB)
- Hệ điều hành: Windows/Linux/MacOS

## Cài đặt

### 1. Clone repository
```bash
cd face_recognition_system
```

### 2. Cài đặt dependencies
```bash
pip install -r requirements.txt
```

**Lưu ý**: Trên một số hệ thống, bạn có thể cần cài đặt thêm:
- Trên Ubuntu/Debian: `sudo apt-get install cmake libboost-all-dev`
- Trên MacOS: `brew install cmake boost`

### 3. Chạy ứng dụng
```bash
python app.py
```

Ứng dụng sẽ chạy tại: http://localhost:5000

## Hướng dẫn sử dụng

### 1. Import nhân viên từ ERP (Khuyến nghị)
- Cấu hình kết nối database ERP trong `config_import.py`
- Chạy: `python import_employees.py`
- Xem hướng dẫn chi tiết: [QUICK_GUIDE_IMPORT.md](QUICK_GUIDE_IMPORT.md)

### 2. Đăng ký nhân viên mới (Thủ công)
- Vào menu "Đăng ký" 
- Điền thông tin: Họ tên, Mã nhân viên, Phòng ban, Chức vụ
- Upload ảnh khuôn mặt (ảnh rõ nét, chụp thẳng mặt)
- Nhấn "Đăng ký"

### 3. Điểm danh
- Vào menu "Điểm danh"
- Nhấn "Bật Camera"
- Đứng trước camera, hệ thống sẽ tự động nhận diện và điểm danh
- Điểm danh vào: lần đầu trong ngày
- Điểm danh ra: lần thứ hai trong ngày

### 4. Xem báo cáo
- Vào menu "Báo cáo"
- Chọn ngày cần xem
- Có thể xuất Excel, PDF hoặc in báo cáo

## Cấu trúc dự án

```
face_recognition_system/
├── app.py                 # File chính Flask app
├── requirements.txt       # Dependencies
├── config_import.py       # Cấu hình import từ ERP
├── import_employees.py    # Script import nhân viên từ ERP
├── check_database.py      # Script kiểm tra database
├── clear_database.py      # Script xóa dữ liệu
├── add_sample_employees.py # Script thêm nhân viên mẫu
├── QUICK_GUIDE_IMPORT.md  # Hướng dẫn import nhanh
├── HUONG_DAN_IMPORT.md    # Hướng dẫn import chi tiết
├── models/
│   ├── database.py       # Database models
│   └── face_recognition_module.py  # Module xử lý nhận diện
├── templates/            # HTML templates
│   ├── base.html
│   ├── index.html
│   ├── register.html
│   ├── attendance.html
│   └── report.html
├── static/
│   ├── css/             # CSS files
│   ├── js/              # JavaScript files
│   └── faces/           # Lưu ảnh khuôn mặt
└── attendance.db        # SQLite database (tự động tạo)
```

## Cấu hình

### Thay đổi thời gian điểm danh muộn
Trong `app.py`, tìm và sửa:
```python
if current_time.hour > 8 or (current_time.hour == 8 and current_time.minute > 30):
    status = 'late'
```

### Thay đổi độ chính xác nhận diện
Trong `models/face_recognition_module.py`, sửa `tolerance`:
```python
matches = face_recognition.compare_faces(self.known_face_encodings, face_encoding, tolerance=0.6)
```
Giá trị nhỏ hơn = chính xác hơn nhưng khó nhận diện hơn

## Lưu ý

1. **Ánh sáng**: Đảm bảo có đủ ánh sáng khi điểm danh
2. **Khoảng cách**: Đứng cách camera khoảng 0.5-1m
3. **Góc nhìn**: Nhìn thẳng vào camera
4. **Một người/lần**: Chỉ có một người trong khung hình khi điểm danh

## Khắc phục sự cố

### Camera không hoạt động
- Kiểm tra quyền truy cập camera
- Thử với camera index khác trong `app.py`:
  ```python
  self.video = cv2.VideoCapture(1)  # Thay 0 bằng 1, 2,...
  ```

### Không nhận diện được khuôn mặt
- Kiểm tra ánh sáng
- Đăng ký lại với ảnh rõ nét hơn
- Giảm tolerance trong face_recognition_module.py

### Lỗi cài đặt face_recognition
- Windows: Cài Visual Studio Build Tools
- Linux: `sudo apt-get install build-essential cmake`
- MacOS: `xcode-select --install`

## Bảo mật

- Thay đổi SECRET_KEY trong `app.py` trước khi deploy
- Sử dụng HTTPS khi deploy production
- Backup database định kỳ

## License

MIT License 