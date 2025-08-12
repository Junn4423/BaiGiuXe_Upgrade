# 🏢 Hướng Dẫn Import Nhân Viên Từ ERP

Tài liệu này hướng dẫn cách import dữ liệu nhân viên và ảnh từ hệ thống ERP vào hệ thống face recognition attendance.

## 📋 Yêu Cầu Hệ Thống

### Database ERP
- **Database chính**: `erp_sofv4_0`
  - Bảng nhân viên: `hr_lv0020`
  - Cột mã NV: `lv001`
  - Cột tên: `lv002`
  - Cột phòng ban: `lv003`
  - Cột chức vụ: `lv004`

- **Database documents**: `erp_sof_documents_v4_0`
  - Bảng ảnh: `hr_lv0041`
  - Cột mã NV: `lv002` (khóa ngoại)
  - Cột ảnh BLOB: `lv008`

### Dependencies
```bash
pip install mysql-connector-python
```

## ⚙️ Cấu Hình

### 1. Chỉnh sửa `config_import.py`

```python
# Cấu hình database ERP chính
ERP_MAIN_CONFIG = {
    'host': 'localhost',        # IP server MySQL
    'port': 3306,
    'user': 'your_username',    # ⚠️ CẬP NHẬT
    'password': 'your_password', # ⚠️ CẬP NHẬT
    'database': 'erp_sofv4_0',
    'charset': 'utf8mb4'
}

# Cấu hình database documents
ERP_DOCS_CONFIG = {
    'host': 'localhost',        # IP server MySQL
    'port': 3306,
    'user': 'your_username',    # ⚠️ CẬP NHẬT
    'password': 'your_password', # ⚠️ CẬP NHẬT
    'database': 'erp_sof_documents_v4_0',
    'charset': 'utf8mb4'
}
```

## 🚀 Quy Trình Import

### Bước 1: Kiểm tra kết nối
```bash
python test_import.py
```

**Kết quả mong đợi:**
```
🔍 ERP Connection & Data Preview Tool
==================================================

1️⃣ Kiểm tra kết nối database:
✅ Kết nối thành công: ERP Main (erp_sofv4_0)
✅ Kết nối thành công: ERP Docs (erp_sof_documents_v4_0)

2️⃣ Preview dữ liệu nhân viên:
📋 Preview 5 nhân viên đầu tiên:
------------------------------------------------------------
ID: NV001      | Tên: Nguyễn Văn A        | Phòng ban: IT
ID: NV002      | Tên: Trần Thị B          | Phòng ban: HR

📊 Tổng số nhân viên: 150

3️⃣ Kiểm tra ảnh nhân viên:
✅ NV001: Có ảnh (45,234 bytes)
❌ NV002: Không có ảnh

📸 Tỷ lệ có ảnh: 3/5
```

### Bước 2: Chạy import
```bash
python import_employees.py
```

**Quy trình import:**
```
🏢 ERP to Face Recognition Import Tool
⚙️  Vui lòng kiểm tra cấu hình database trong file import_employees.py

Tiếp tục import? (y/N): y

🚀 Bắt đầu import nhân viên từ ERP...
==================================================
Tìm thấy 150 nhân viên trong ERP

Đang import nhân viên: Nguyễn Văn A (NV001)
  - ✅ Import thành công: Nguyễn Văn A

Đang import nhân viên: Trần Thị B (NV002)
  - Không tìm thấy ảnh cho nhân viên NV002

🔄 Đang reload known faces...

==================================================
📊 KẾT QUẢ IMPORT:
✅ Thành công: 120
⏭️  Bỏ qua (đã tồn tại): 0
❌ Lỗi: 30
📋 Tổng: 150
==================================================
```

## 🔧 Cách Hoạt Động

### 1. Quy trình xử lý ảnh BLOB
```
BLOB từ ERP → File tạm (.jpg) → Face Recognition → Face Encoding → Database
```

### 2. Xử lý lỗi thường gặp

| Lỗi | Nguyên nhân | Giải pháp |
|-----|-------------|-----------|
| `Không tìm thấy khuôn mặt` | Ảnh không rõ/không có người | Kiểm tra chất lượng ảnh |
| `Nhiều hơn 1 khuôn mặt` | Ảnh nhóm | Crop ảnh chỉ 1 người |
| `Lỗi xử lý ảnh` | BLOB không phải ảnh | Kiểm tra dữ liệu BLOB |
| `Mã nhân viên đã tồn tại` | Trùng lặp | Bỏ qua hoặc cập nhật |

### 3. Mapping dữ liệu

**Từ ERP → Face Recognition:**
```
hr_lv0020.lv001 → users.employee_id
hr_lv0020.lv002 → users.name  
hr_lv0020.lv003 → users.department
hr_lv0020.lv004 → users.position
hr_lv0041.lv008 → users.face_encoding (sau xử lý)
```

## 📊 Monitoring & Logs

### Thống kê import
- ✅ **Thành công**: Nhân viên có ảnh hợp lệ, face encoding thành công
- ⏭️ **Bỏ qua**: Nhân viên đã tồn tại trong hệ thống
- ❌ **Lỗi**: Không có ảnh, ảnh không hợp lệ, hoặc lỗi xử lý

### Log chi tiết
Script sẽ in ra:
- Tên và mã nhân viên đang xử lý
- Trạng thái xử lý (thành công/lỗi)
- Lý do lỗi cụ thể
- Thống kê tổng kết

## 🛠️ Customization

### Thay đổi cấu trúc bảng
Nếu ERP có cấu trúc khác, sửa trong `config_import.py`:

```python
EMPLOYEE_COLUMNS = {
    'employee_id': 'ma_nv',      # Thay đổi tên cột
    'name': 'ho_ten',
    'department': 'phong_ban', 
    'position': 'chuc_vu'
}
```

### Điều chỉnh độ chính xác
```python
IMPORT_CONFIG = {
    'face_encoding_tolerance': 0.4,  # 0.4 = 60% accuracy
    'require_image': True,           # Bắt buộc có ảnh
    'skip_existing': True            # Bỏ qua NV đã tồn tại
}
```

## ⚠️ Lưu Ý Quan Trọng

### 1. Backup Database
```bash
# Backup trước khi import
mysqldump -u root -p attendance > backup_before_import.sql
```

### 2. Quyền Database
Đảm bảo user MySQL có quyền:
- `SELECT` trên bảng ERP
- `INSERT, UPDATE` trên database face recognition

### 3. Performance
- Import từng batch nhỏ nếu có nhiều nhân viên
- Chạy trong giờ thấp điểm
- Monitor disk space cho face encodings

### 4. Kết nối mạng
- Đảm bảo kết nối ổn định đến MySQL server
- Timeout phù hợp cho ảnh BLOB lớn

## 🔍 Troubleshooting

### Lỗi kết nối MySQL
```bash
# Kiểm tra MySQL service
sudo systemctl status mysql

# Test kết nối
mysql -h localhost -u your_user -p
```

### Lỗi dependencies
```bash
pip install --upgrade mysql-connector-python
pip install --upgrade face-recognition
```

### Lỗi memory với ảnh lớn
Thêm vào `config_import.py`:
```python
IMPORT_CONFIG = {
    'batch_size': 5,  # Giảm từ 10 xuống 5
    'max_image_size': 1024 * 1024  # 1MB limit
}
```

## 📞 Support

Nếu gặp vấn đề, kiểm tra:
1. ✅ Cấu hình database đúng
2. ✅ Quyền truy cập MySQL  
3. ✅ Chất lượng ảnh BLOB
4. ✅ Face recognition dependencies
5. ✅ Disk space đủ cho face encodings

---

**💡 Tip**: Chạy `test_import.py` trước mỗi lần import để đảm bảo mọi thứ hoạt động tốt! 