# Tích Hợp Mã Phiên Chấm Công (Attendance Code Integration)

## Mô tả thay đổi

Đã thêm tính năng gửi `attendance_code` khi thực hiện chấm công. Mã phiên được lấy từ bảng `pm_nc0009` (cột `lv001`) của phiên gửi xe đang hoạt động và được gửi cùng với ảnh chấm công.

## Cấu trúc API Response mới

Khi chấm công thành công, API sẽ trả về:

```json
{
    "attendance_code": "mame",
    "message": "Điểm danh thành công cho Nguyễn Ngọc Thạch",
    "status": "late",
    "success": true,
    "user": {
        "department": "CODING",
        "employee_id": "0774021824",
        "name": "Nguyễn Ngọc Thạch",
        "position": "Không có"
    }
}
```

## Các thay đổi thực hiện

### 1. Frontend - API Chấm Công (`apiChamCong.js`)

#### Thêm function lấy mã phiên hiện tại:
```javascript
async function getCurrentActiveSessionId() {
  // Gọi API để lấy mã phiên từ bảng pm_nc0009 
  // Điều kiện: lv014 = 'DANG_GUI' (đang gửi xe)
  // Sắp xếp: theo lv008 DESC (giờ vào mới nhất)
}
```

#### Cập nhật `attendanceByImage()`:
- Lấy mã phiên hiện tại trước khi gửi request
- Thêm `attendance_code` vào FormData nếu có mã phiên
- Lưu `attendance_code` vào localStorage record

#### Cập nhật `attendanceByBase64()`:
- Lấy mã phiên hiện tại trước khi gửi request  
- Thêm `attendance_code` vào JSON body nếu có mã phiên
- Lưu `attendance_code` vào localStorage record

### 2. Backend - API Endpoint (`kebao.php`)

#### Thêm case `getCurrentActiveSession` trong pm_nc0009:
```php
case "getCurrentActiveSession":
    $sql = "SELECT lv001, lv002, lv003, lv008, lv014 FROM pm_nc0009 WHERE lv014 = 'DANG_GUI' ORDER BY lv008 DESC";
    // Trả về danh sách phiên gửi xe đang hoạt động
```

## Luồng hoạt động

1. **Khi chấm công được kích hoạt:**
   - Gọi `getCurrentActiveSessionId()` để lấy mã phiên hiện tại
   - Tìm phiên gửi xe có trạng thái `DANG_GUI` (đang gửi)
   - Lấy phiên mới nhất (theo thời gian vào)

2. **Gửi request chấm công:**
   - **Form Data (với image file):** Thêm field `attendance_code`
   - **JSON (với base64):** Thêm property `attendance_code`
   - Server chấm công nhận được cả ảnh và mã phiên

3. **Xử lý response:**
   - Lưu `attendance_code` từ response hoặc từ request
   - Ghi log với thông tin đầy đủ
   - Lưu record vào localStorage

## Cách test

1. **Mở file test:** `test_attendance_code.html`
2. **Test lấy mã phiên:** Click "Test lấy mã phiên"
3. **Test mock chấm công:** Click "Test attendance API"

## Lưu ý quan trọng

1. **Điều kiện hoạt động:**
   - Phải có ít nhất 1 phiên gửi xe với trạng thái `DANG_GUI`
   - Nếu không có phiên nào, chấm công vẫn hoạt động nhưng không có `attendance_code`

2. **Tương thích ngược:**
   - Code cũ vẫn hoạt động bình thường
   - `attendance_code` là optional, không bắt buộc

3. **Logging:**
   - Tất cả requests đều được log với thông tin `attendance_code`
   - Giúp debug và theo dõi

## API Endpoints liên quan

- **Lấy mã phiên:** `POST /services.sof.vn/index.php`
  ```json
  {
    "table": "pm_nc0009",
    "func": "getCurrentActiveSession"
  }
  ```

- **Chấm công (Form):** `POST /api/attendance_image`
  ```
  FormData:
  - image: file
  - attendance_code: string (optional)
  ```

- **Chấm công (JSON):** `POST /api/attendance_image`
  ```json
  {
    "image_base64": "...",
    "attendance_code": "optional_session_id"
  }
  ```

## Troubleshooting

### Không lấy được mã phiên:
- Kiểm tra có phiên gửi xe nào đang `DANG_GUI` không
- Kiểm tra kết nối database
- Xem console log để debug

### Chấm công không có attendance_code:
- Chấm công vẫn hoạt động bình thường
- Chỉ là thiếu thông tin mã phiên
- Không ảnh hưởng đến chức năng chính

### Server chấm công không nhận attendance_code:
- Kiểm tra server chấm công đã được cập nhật chưa
- Xem log request/response 
- Đảm bảo format đúng (FormData vs JSON)
