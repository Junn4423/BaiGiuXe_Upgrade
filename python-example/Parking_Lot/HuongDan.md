# HƯỚNG DẪN SỬ DỤNG HỆ THỐNG QUẢN LÝ BÃI XE

## MỤC LỤC

1. [Giới thiệu](#giới-thiệu)
2. [Cài đặt và thiết lập](#cài-đặt-và-thiết-lập)
3. [Cấu trúc dự án](#cấu-trúc-dự-án)
4. [Hướng dẫn Components](#hướng-dẫn-components)
5. [Dialogs và chức năng](#dialogs-và-chức-năng)
6. [API và URL endpoints](#api-và-url-endpoints)
7. [Cấu hình Database](#cấu-hình-database)
8. [Khắc phục sự cố](#khắc-phục-sự-cố)
9. [Hướng phát triển version tiếp theo](#hướng-phát-triển)
---

## Giới thiệu

Hệ thống quản lý bãi xe là ứng dụng desktop được xây dựng bằng Python với Tkinter GUI, tích hợp công nghệ AI và IoT.

### Tính năng chính

- **Camera RTSP**: Theo dõi xe vào/ra real-time
- **AI nhận diện biển số**: Tự động phát hiện biển số xe
- **Quản lý thẻ RFID**: Hệ thống đầu đọc thẻ từ
- **Giao diện hiện đại**: UI/UX thân thiện người dùng
- **Database MySQL**: Lưu trữ dữ liệu an toàn
- **API Backend**: RESTful API cho các thao tác CRUD

---

```bash
- Cai dat exe 
pyinstaller --onefile main.py
## Cài đặt và thiết lập

### 1. Cài đặt Python

Yêu cầu: Python 3.8 trở lên

```bash
# Tải Python từ trang chính thức
# https://python.org/downloads/

# Kiểm tra phiên bản Python
python --version
```

### 2. Cài đặt thư viện

```bash
# Cài đặt tự động từ file requirements.txt
pip install -r requirements.txt
```

### Danh sách thư viện chính

- **pydantic**: Validation và serialization dữ liệu
- **pillow**: Xử lý và chỉnh sửa ảnh
- **opencv-python**: Computer vision và xử lý camera
- **requests**: HTTP client cho API calls
- **numpy**: Tính toán ma trận và mảng
- **keyboard**: Xử lý phím tắt và events
- **mysql-connector-python**: MySQL database connector

### 3. Khởi chạy ứng dụng

```bash
# Chạy ứng dụng chính
python main.py
```

---

## Cấu trúc dự án

```
Parking_Lot/
├── main.py                 # File chính để chạy ứng dụng
├── requirements.txt        # Danh sách thư viện dependencies
├── models.py              # Định nghĩa data models
├── assets/                # Tài nguyên (icon, logo, images)
├── components/            # Các component chính của ứng dụng
│   ├── ui.py             # Giao diện chính full-screen
│   ├── QuanLyXe.py       # Logic quản lý xe vào/ra
│   ├── QuanLyCamera.py   # Quản lý hệ thống camera RTSP
│   ├── DauDocThe.py      # Xử lý đầu đọc thẻ RFID
│   └── login.py          # Hệ thống xác thực người dùng
├── dialogs/              # Các dialog và popup windows
│   └── BienSoLoiDialog.py # Xử lý lỗi nhận diện biển số
└── server/               # Backend và cấu hình hệ thống
    ├── api.py            # API functions và endpoints
    ├── url.py            # Cấu hình URLs và endpoints
    ├── data/             # Dữ liệu tạm thời
    ├── images/           # Lưu trữ ảnh đã chụp
```

---

## Hướng dẫn Components

### 1. main.py - Entry Point

**Vai trò:** File khởi chạy chính của toàn bộ hệ thống

**Chức năng chính:**
- Khởi tạo và cấu hình môi trường OpenCV
- Tạo các thư mục cần thiết cho hệ thống
- Setup cấu hình database mặc định
- Hiển thị màn hình đăng nhập bảo mật
- Launch giao diện chính của ứng dụng

**Cách sử dụng:**
```bash
python main.py
```

### 2. components/ui.py - Main Interface

**Vai trò:** Giao diện người dùng chính với layout hiện đại

**Chức năng chính:**
- **Full-screen Interface**: Giao diện toàn màn hình
- **Multi-Camera Display**: Hiển thị 4 camera đồng thời
- **Control Panel**: Bảng điều khiển trực quan
- **Real-time Status**: Hiển thị trạng thái xe real-time
- **Mode Switching**: Chuyển đổi chế độ xe máy/ô tô

### 3. components/QuanLyXe.py - Vehicle Management

**Vai trò:** Xử lý toàn bộ logic nghiệp vụ quản lý xe

**Chức năng chính:**
- **Entry/Exit Logic**: Xử lý xe vào và xe ra
- **AI Integration**: Gọi API nhận diện biển số
- **RFID Processing**: Xử lý thông tin thẻ từ
- **Image Management**: Lưu ảnh xe và khuôn mặt
- **Fee Calculation**: Tính toán thời gian và phí

**Methods quan trọng:**
- `xu_ly_xe_vao()` - Xử lý quy trình xe vào
- `xu_ly_xe_ra()` - Xử lý quy trình xe ra
- `gui_anh_nhan_dien()` - Gửi ảnh đến AI service
- `luu_anh_xe()` - Lưu ảnh vào storage

### 4. components/QuanLyCamera.py - Camera System

**Vai trò:** Quản lý hệ thống camera RTSP đa kênh

**Chức năng chính:**
- **Multi-RTSP Connection**: Kết nối 4 camera RTSP
- **Real-time Streaming**: Capture frame liên tục
- **UI Integration**: Hiển thị lên giao diện
- **Error Handling**: Xử lý lỗi kết nối camera

**Camera Layout:**
- Camera IN (192.168.0.229): Chụp xe khi vào bãi
- Camera OUT (192.168.0.235): Chụp xe khi ra khỏi bãi
- Face IN (192.168.0.174): Nhận diện khuôn mặt vào
- Face OUT (192.168.0.195): Nhận diện khuôn mặt ra

### 5. components/DauDocThe.py - RFID Reader

**Vai trò:** Xử lý đầu đọc thẻ từ RFID và keyboard events

**Chức năng chính:**
- **RFID Reading**: Đọc dữ liệu từ đầu đọc thẻ
- **Card Processing**: Xử lý và validate mã thẻ
- **Data Transfer**: Gửi thông tin lên UI
- **Error Handling**: Xử lý lỗi đọc thẻ

### 6. components/login.py - Authentication

**Vai trò:** Hệ thống xác thực và bảo mật

**Thông tin đăng nhập mặc định:**
- Tài khoản: admin
- Mật khẩu: 1

---

## Dialogs và chức năng

### BienSoLoiDialog.py - License Plate Error Handler

**Khi nào xuất hiện:** Xử lý các trường hợp biển số không nhận diện được chính xác

**Triggers:**
- Biển số xe vào khác biển số xe ra
- AI nhận diện biển số không chính xác
- Cần xác nhận thủ công từ operator

**Chức năng chi tiết:**

**So sánh hình ảnh:**
- Ảnh xe vào/ra - Hiển thị song song để so sánh
- Ảnh khuôn mặt - So sánh identity người lái
- Visual comparison - Giao diện trực quan

**Chỉnh sửa biển số:**
- Manual input - Nhập biển số thủ công
- Auto-suggestion - Gợi ý dựa trên pattern
- Validation - Kiểm tra format biển số

**Control Options:**
- **Quét lại**: Scan lại biển số với AI
- **Xác nhận**: Lưu biển số đã sửa
- **Hủy**: Bỏ qua và đóng dialog

**Quy trình sử dụng:**
1. Kiểm tra ảnh - So sánh ảnh xe và khuôn mặt
2. Nhập biển số - Sửa biển số trong ô input
3. Chọn hành động - Quét lại, Xác nhận hoặc Hủy

---

## API và URL endpoints

### server/url.py - URL Configuration

**Camera RTSP URLs:**
```python
# Cấu hình địa chỉ camera RTSP
rtsp_url_in = "rtsp://admin:sof@sof.vn@192.168.0.229:554/h264/ch1/main/av_stream"      # Camera vào
rtsp_url_out = "rtsp://admin:sof@sof.vn@192.168.0.235:554/h264/ch1/main/av_stream"     # Camera ra
rtsp_url_inFace = "rtsp://admin:sof@sof.vn@192.168.0.174:554/h264/ch1/main/av_stream"  # Face vào
rtsp_url_outFace = "rtsp://admin:sof@sof.vn@192.168.0.195:554/h264/ch1/main/av_stream" # Face ra

# API nhận diện biển số - AI Service
api_BienSo = "http://192.168.1.20:8000/detect"

# API backend chính - Main Backend
url_api = "http://localhost/parkinglot/services.sof.vn/index.php"
```

### server/api.py - API Functions

**Core Functions:**
- `layALLLoaiPhuongTien()` - Lấy danh sách loại phương tiện
- `lay_danh_sach_khu()` - Lấy danh sách khu vực
- `themLoaiPhuongTien()` - Thêm loại phương tiện mới
- `handle_api_response()` - Xử lý response từ API

**Main Backend API:**
```http
POST /index.php
Content-Type: application/json

{
    "table": "pm_nc0001",
    "func": "data"
}
```

**AI License Plate Detection:**
```http
POST /detect
Content-Type: multipart/form-data

file: [IMAGE_FILE]
```

## Khắc phục sự cố

### Sự cố Camera RTSP

**Không kết nối được camera:**

**Triệu chứng:**
- Camera không hiển thị hình ảnh
- Lỗi "Connection timeout"
- Màn hình camera đen
- FPS = 0 hoặc không ổn định

**Cách khắc phục:**

1. **Kiểm tra kết nối mạng:**
```bash
# Test ping tới camera
ping 192.168.0.229
ping 192.168.0.235
ping 192.168.0.174
ping 192.168.0.195

```

2. **Test RTSP stream trực tiếp:**
```bash
# sử dụng VLC Media Player
vlc rtsp://admin:sof@sof.vn@192.168.0.229:554/h264/ch1/main/av_stream
```

3. **Kiểm tra cấu hình:**
- Đảm bảo username/password chính xác trong server/url.py
- Kiểm tra IP address của camera
- Xác nhận port và stream path

**Checklist khắc phục:**
- Camera đang online và có thể ping được
- Username/password chính xác (admin:sof@sof.vn)
- Firewall không block port 554 (RTSP)
- Stream path chính xác

### Sự cố AI Service

**Lỗi API nhận diện biển số:**

**Triệu chứng:**
- Không nhận diện được biển số
- API response lỗi 500/404/timeout
- Confidence score quá thấp
- Processing time quá lâu

**Cách khắc phục:**

1. **Kiểm tra AI service:**
```bash
# Test API endpoint
curl -X POST http://192.168.1.20:8000/detect \
  -F "file=@test_image.jpg" \
  -H "Content-Type: multipart/form-data"
```
2. **Tối ưu chất lượng ảnh:**
- Cải thiện ánh sáng
- Làm sạch camera lens
- Tăng độ phân giải ảnh
- Giảm noise và blur

**Checklist khắc phục:**
- AI service đang chạy và response HTTP 200
- Model được load thành công
- Chất lượng ảnh input tốt
- Biển số rõ nét và không bị che khuất xe đứng thẳng là tốt nhất

### Sự cố RFID Reader

**Không đọc được thẻ RFID:**

**Triệu chứng:**
- Thẻ không được phát hiện
- Dữ liệu bị lỗi/không đầy đủ
- Reader không response

2. **Kiểm tra card/tag:**
- Đảm bảo thẻ RFID hoạt động bình thường
- Test với thẻ khác để so sánh

**Checklist khắc phục:**
- RFID reader được cắm USB chắc chắn
- Thẻ RFID không bị hỏng
- Code xử lý RFID event chính xác

### Sự cố Database

2. **Kiểm tra cấu hình:**
```python
# Trong code Python
try:
    connection = mysql.connector.connect(**DB_CONFIG)
    print("Database connected successfully")
except Error as e:
    print(f"Error: {e}")
```

**Checklist khắc phục:**
- MySQL service đang chạy
- User account có đủ permissions
- Database và tables đã được tạo
- Network connection ổn định
- Connection pool không bị exhausted
- Disk space đủ cho database growth

---

## Hướng phát triển
- Dựa trên những gì đã làm được:
  + Tích hợp được API Backend và nhận diện biển số cho việc tạo phiên gửi xe lưu được hình ảnh biển số và khuôn mặt người gửi
  + Có lựa chọn thêm thẻ RFID vào CSDL khi có thông báo thẻ không tồn tại (Thẻ mới)
  + Giao diện cơ bản cho việc quản lý bãi giữ xe
  + Các chức năng quét thẻ và thông báo lỗi cho người dùng đa số đều ổn định
  + Có chức năng cho phép người dùng nhập biển số (Đối với trường hợp API nhận diện bị sai với những biển số khó đọc)
  + Tạo file .exe để trực tiếp chạy trên nền tảng windowns

- Hướng phát triển version tiếp theo:
  + Quản lý các nghiệp vụ khác:
    * Quản lý với các loại xe hơi,xe đạp(Hiện tại chỉ có xe máy là test được - Xe hơi cần có vị trí đỗ)
    * Kiểm soát chặt chẽ các nghiệp vụ tính toán chi phí gửi xe
    * Quản lý các xe đang gửi trong bãi
    * Tính tiền
  + Khác :
    * Có thể cải thiện giao diện và làm việc đa nền tảng (Mac OS, Linux, Windows(Đã có file exe))
    * Mobile App (Theo yêu cầu)