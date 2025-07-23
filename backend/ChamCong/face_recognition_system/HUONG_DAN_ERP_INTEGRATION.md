# HƯỚNG DẪN TÍCH HỢP ERP - BẢNG tc_lv0012

## Tổng quan

Hệ thống face recognition đã được tích hợp với bảng `tc_lv0012` trong database ERP `erp_sofv4_0`. Mỗi lần nhận diện khuôn mặt thành công, dữ liệu chấm công sẽ được ghi vào cả hai nơi:

1. **Database nội bộ** (SQLite): Bảng `attendance`
2. **Database ERP** (MySQL): Bảng `tc_lv0012`

## Cấu trúc bảng tc_lv0012

| Cột     | Kiểu dữ liệu | Mô tả | Giá trị |
|---------|-------------|--------|---------|
| `lv001` | VARCHAR(50) | Mã nhân viên | Từ User.employee_id |
| `lv002` | DATE        | Ngày điểm danh (yyyy-mm-dd) | Ngày hiện tại |
| `lv003` | TIME        | Giờ điểm danh (HH:MM:SS) | Giờ hiện tại |
| `lv004` | VARCHAR(32) | Loại điểm danh | 'IN' (mặc định) |
| `lv005` | VARCHAR(32) | Nguồn điểm danh | 'Camera' (mặc định) |
| `lv099` | CHAR(32)    | IP của camera | '192.168.1.89' |

## Cấu hình kết nối

File: `config_import.py`

```python
# Database ERP
ERP_MAIN_CONFIG = {
    'host': '192.168.1.90',
    'port': 3306,
    'user': 'faceuser',
    'password': 'THU@1982',
    'database': 'erp_sofv4_0',
    'charset': 'utf8mb4'
}

# Cấu hình bảng chấm công
ATTENDANCE_TABLE = 'tc_lv0012'
ATTENDANCE_COLUMNS = {
    'employee_id': 'lv001',    # Mã nhân viên
    'date': 'lv002',           # Ngày điểm danh
    'time': 'lv003',           # Giờ điểm danh
    'type': 'lv004',           # Loại điểm danh
    'source': 'lv005',         # Nguồn điểm danh
    'camera_ip': 'lv099'       # IP camera
}
```

## Cách thức hoạt động

### 1. Chấm công tự động (Camera)

Khi camera nhận diện khuôn mặt thành công:

1. **Kiểm tra điều kiện:**
   - Nhân viên đã được đăng ký trong hệ thống
   - Chưa chấm công trong 10 phút gần đây (tránh trùng lặp)

2. **Ghi dữ liệu:**
   - Ghi vào SQLite (bảng `attendance`)
   - Ghi vào MySQL ERP (bảng `tc_lv0012`)

3. **Dữ liệu được ghi:**
   ```sql
   INSERT INTO tc_lv0012 (lv001, lv002, lv003, lv004, lv005, lv099) 
   VALUES ('MP0123', '2025-07-01', '13:47:44', 'IN', 'Camera', '192.168.1.89');
   ```

### 2. Chấm công thủ công (API)

Endpoint: `POST /api/check_attendance`

```json
{
    "user_id": 1
}
```

Tương tự như chấm công tự động, nhưng được kích hoạt bằng API call.

## Tính năng

### 1. Kiểm tra kết nối ERP

```bash
python test_erp_integration.py
```

### 2. Demo chấm công

```bash
python demo_erp_attendance.py
```

### 3. Lịch sử chấm công

Lấy lịch sử 7 ngày gần đây:

```python
from models.erp_integration import erp_attendance

history = erp_attendance.get_attendance_history('MP0123', days=7)
for record in history:
    print(f"{record['date']} {record['time']} - {record['source']}")
```

### 4. Kiểm tra chấm công gần đây

```python
# Kiểm tra trong 10 phút gần đây
has_recent = erp_attendance.check_recent_attendance('MP0123', minutes=10)
```

## Xử lý lỗi

### 1. Lỗi kết nối MySQL

**Triệu chứng:** `mysql.connector.Error`

**Giải pháp:**
- Kiểm tra MySQL server có đang chạy
- Xác minh thông tin kết nối trong `config_import.py`
- Kiểm tra firewall/network

### 2. Lỗi thiếu cột

**Triệu chứng:** `Unknown column 'lv099'`

**Giải pháp:**
```bash
python check_tc_lv0012_structure.py
```

### 3. Lỗi quyền truy cập

**Triệu chứng:** `Access denied`

**Giải pháp:**
```sql
GRANT INSERT, SELECT ON erp_sofv4_0.tc_lv0012 TO 'faceuser'@'%';
FLUSH PRIVILEGES;
```

## Monitoring

### 1. Kiểm tra logs

```bash
# Xem logs trong terminal khi chạy app
python app.py
```

### 2. Kiểm tra dữ liệu ERP

```sql
-- Xem chấm công hôm nay
SELECT lv001, lv002, lv003, lv005, lv099 
FROM tc_lv0012 
WHERE lv002 = CURDATE() 
ORDER BY lv003 DESC;

-- Thống kê theo ngày
SELECT lv002, COUNT(*) as so_luot_cham_cong
FROM tc_lv0012 
WHERE lv002 >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
GROUP BY lv002 
ORDER BY lv002 DESC;
```

### 3. So sánh dữ liệu

Kiểm tra tính nhất quán giữa SQLite và MySQL:

```bash
python check_database.py
```

## Bảo trì

### 1. Backup dữ liệu

```bash
# Backup SQLite
cp attendance.db backup/attendance_$(date +%Y%m%d).db

# Backup MySQL
mysqldump -h 192.168.1.90 -u faceuser -p erp_sofv4_0 tc_lv0012 > backup/tc_lv0012_$(date +%Y%m%d).sql
```

### 2. Dọn dẹp dữ liệu cũ

```sql
-- Xóa dữ liệu test (nếu có)
DELETE FROM tc_lv0012 WHERE lv001 = 'TEST001';

-- Xóa dữ liệu cũ hơn 1 năm (nếu cần)
DELETE FROM tc_lv0012 WHERE lv002 < DATE_SUB(CURDATE(), INTERVAL 1 YEAR);
```

## Troubleshooting

### Problem: Chấm công không ghi vào ERP

**Kiểm tra:**
1. Kết nối MySQL: `python test_erp_integration.py`
2. Quyền user: `SHOW GRANTS FOR 'faceuser'@'%';`
3. Cấu trúc bảng: `DESCRIBE tc_lv0012;`

### Problem: Dữ liệu không đồng bộ

**Nguyên nhân:** Lỗi ERP không làm fail chấm công nội bộ

**Giải pháp:** Kiểm tra logs và chạy sync thủ công nếu cần

## Kết luận

✅ **Đã hoàn thành:**
- Tích hợp với bảng tc_lv0012
- Ghi dữ liệu song song (SQLite + MySQL)  
- Kiểm tra trùng lặp
- Test và demo thành công

🔧 **Bảo trì định kỳ:**
- Kiểm tra kết nối ERP hàng tuần
- Backup dữ liệu hàng tháng
- Monitor logs để phát hiện lỗi sớm

📧 **Hỗ trợ:**
- Chạy `python test_erp_integration.py` để chẩn đoán
- Xem logs chi tiết trong terminal
- Kiểm tra cấu hình trong `config_import.py` 