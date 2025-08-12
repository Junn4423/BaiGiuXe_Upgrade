# 📖 HƯỚNG DẪN IMPORT NHÂN VIÊN TỪ ERP

Hướng dẫn chi tiết cách import dữ liệu nhân viên từ hệ thống ERP vào Face Recognition System.

## 🎯 Mục đích

Import thông tin nhân viên và ảnh từ database ERP hiện có vào hệ thống chấm công nhận diện khuôn mặt.

## 📋 Yêu cầu hệ thống

### Database ERP cần có:
1. **Database chính** (ví dụ: `erp_sofv4_0`)
   - Bảng nhân viên (ví dụ: `hr_lv0020`)
   - Chứa thông tin: Mã NV, Tên, Phòng ban, Chức vụ

2. **Database documents** (ví dụ: `erp_sof_documents_v4_0`) 
   - Bảng ảnh (ví dụ: `hr_lv0041`)
   - Chứa ảnh nhân viên dạng BLOB

### Quyền truy cập:
- User MySQL có quyền đọc 2 database trên
- Kết nối từ server Face Recognition đến server ERP

## ⚙️ Cấu hình

### Bước 1: Cấu hình kết nối database

Chỉnh sửa file `config_import.py`:

```python
# Cấu hình database ERP chính (chứa thông tin nhân viên)
ERP_MAIN_CONFIG = {
    'host': '192.168.1.90',       # IP server MySQL ERP
    'port': 3306,                 # Port MySQL (thường là 3306)
    'user': 'faceuser',           # Username có quyền đọc
    'password': 'your_password',  # Password
    'database': 'erp_sofv4_0',    # Tên database chính
    'charset': 'utf8mb4'
}

# Cấu hình database ERP documents (chứa ảnh nhân viên)
ERP_DOCS_CONFIG = {
    'host': '192.168.1.90',           # IP server MySQL ERP Documents
    'port': 3306,                     # Port MySQL
    'user': 'faceuser',               # Username có quyền đọc
    'password': 'your_password',      # Password  
    'database': 'erp_sof_documents_v4_0',  # Tên database documents
    'charset': 'utf8mb4'
}
```

### Bước 2: Cấu hình bảng và cột

Điều chỉnh mapping bảng/cột theo cấu trúc ERP của bạn:

```python
# Bảng nhân viên
EMPLOYEE_TABLE = 'hr_lv0020'
EMPLOYEE_COLUMNS = {
    'employee_id': 'lv001',   # Cột mã nhân viên
    'name': 'lv002',          # Cột tên nhân viên
    'department': 'lv003',    # Cột phòng ban
    'position': 'lv004'       # Cột chức vụ
}

# Bảng ảnh
IMAGE_TABLE = 'hr_lv0041'
IMAGE_COLUMNS = {
    'employee_id': 'lv002',   # Cột mã nhân viên (liên kết)
    'image_blob': 'lv008'     # Cột chứa ảnh BLOB
}
```

## 🔧 Kiểm tra kết nối

### Test kết nối MySQL:
```bash
# Test trực tiếp MySQL
mysql -h 192.168.1.90 -u faceuser -p'your_password' -e "SHOW DATABASES;"

# Hoặc dùng script test
python testconnect.py
```

### Kiểm tra cấu trúc bảng:
```sql
-- Kiểm tra bảng nhân viên
SELECT * FROM hr_lv0020 LIMIT 5;

-- Kiểm tra bảng ảnh
SELECT lv002, LENGTH(lv008) as image_size 
FROM hr_lv0041 
WHERE lv008 IS NOT NULL 
LIMIT 5;
```

## 🚀 Thực hiện Import

### Bước 1: Backup dữ liệu hiện tại (nếu có)
```bash
# Kiểm tra dữ liệu hiện tại
python check_database.py

# Backup nếu cần (tùy chọn)
cp attendance.db attendance_backup_$(date +%Y%m%d_%H%M%S).db
```

### Bước 2: Xóa dữ liệu cũ (nếu cần)
```bash
# Chỉ làm nếu muốn import lại từ đầu
python clear_database.py
```

### Bước 3: Chạy import
```bash
python import_employees.py
```

### Quá trình import:
1. **Kết nối** đến database ERP
2. **Lấy danh sách** nhân viên từ bảng `hr_lv0020`
3. **Với mỗi nhân viên:**
   - Kiểm tra đã tồn tại chưa (bỏ qua nếu có)
   - Lấy ảnh từ bảng `hr_lv0041`
   - Chuyển BLOB → file tạm
   - Tạo face encoding từ ảnh
   - Lưu vào database Face Recognition
4. **Reload** known faces cho hệ thống nhận diện

## 📊 Kiểm tra kết quả

### Xem thống kê:
```bash
python check_database.py
```

### Kết quả mong đợi:
```
👥 NHÂN VIÊN:
   📊 Tổng số: X
   🆕 Mới nhất: Tên NV (Mã NV) - Thời gian
   🏢 Theo phòng ban:
      - Phòng A: X người
      - Phòng B: Y người
   
🤖 FACE ENCODINGS:
   ✅ Có encoding: X
   ❌ Không có encoding: 0
```

## ❗ Xử lý lỗi thường gặp

### Lỗi kết nối database:
```
ERROR 1045 (28000): Access denied for user 'faceuser'@'localhost'
```
**Giải pháp:**
- Kiểm tra username/password
- Kiểm tra IP host (localhost vs IP thực)
- Kiểm tra quyền user trên MySQL server

### Lỗi không tìm thấy bảng:
```
Table 'erp_sofv4_0.hr_lv0020' doesn't exist
```
**Giải pháp:**
- Kiểm tra tên database trong config
- Kiểm tra tên bảng trong EMPLOYEE_TABLE
- Kiểm tra quyền đọc bảng

### Lỗi encoding tiếng Việt:
```
'latin-1' codec can't encode character
```
**Giải pháp:**
- Thêm `charset: 'utf8mb4'` vào config
- Kiểm tra charset của database ERP

### Nhân viên không có ảnh:
```
- Không tìm thấy ảnh cho nhân viên XXX
```
**Nguyên nhân:**
- Ảnh chưa được upload vào ERP
- Tên cột không đúng trong IMAGE_COLUMNS
- Dữ liệu BLOB bị null

## 🔄 Import định kỳ

### Cập nhật dữ liệu mới:
```bash
# Script sẽ tự động bỏ qua nhân viên đã tồn tại
python import_employees.py
```

### Import toàn bộ lại:
```bash
# Xóa hết và import lại
python clear_database.py
python import_employees.py
```

## 📝 Log và Debug

### Xem log chi tiết:
Script sẽ hiển thị:
- Số nhân viên tìm thấy
- Quá trình import từng người
- Kết quả thành công/lỗi
- Thống kê cuối cùng

### Debug kết nối:
```python
# Thêm vào script test
import mysql.connector
try:
    conn = mysql.connector.connect(**ERP_MAIN_CONFIG)
    print("✅ Kết nối thành công!")
    cursor = conn.cursor()
    cursor.execute("SELECT COUNT(*) FROM hr_lv0020")
    count = cursor.fetchone()[0]
    print(f"📊 Có {count} nhân viên trong ERP")
except Exception as e:
    print(f"❌ Lỗi: {e}")
```

## 🎯 Lưu ý quan trọng

1. **Backup trước khi import** nếu đã có dữ liệu
2. **Test trên môi trường dev** trước khi chạy production
3. **Kiểm tra chất lượng ảnh** - ảnh mờ sẽ ảnh hưởng độ chính xác
4. **Face encoding** được tạo từ ảnh ERP, không phải ảnh real-time
5. **Script có thể chạy nhiều lần** - sẽ bỏ qua nhân viên đã tồn tại

## 📞 Hỗ trợ

Nếu gặp vấn đề:
1. Chạy `python check_database.py` để kiểm tra trạng thái
2. Kiểm tra log output của script import
3. Verify kết nối database với `testconnect.py`
4. Kiểm tra cấu trúc bảng ERP

---
*Cập nhật lần cuối: $(date)* 