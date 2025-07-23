# 🚀 HƯỚNG DẪN NHANH: IMPORT NHÂN VIÊN TỪ ERP

## 📝 Checklist trước khi import

- [ ] Database ERP đang chạy và có thể kết nối
- [ ] Có user MySQL với quyền đọc database ERP
- [ ] Đã cấu hình file `config_import.py`
- [ ] Đã test kết nối thành công

## ⚙️ Cấu hình nhanh

### 1. Chỉnh sửa `config_import.py`:
```python
ERP_MAIN_CONFIG = {
    'host': '192.168.1.90',     # IP của server ERP
    'user': 'faceuser',         # Username MySQL
    'password': 'your_pass',    # Password MySQL  
    'database': 'erp_sofv4_0'   # Database chính
}

ERP_DOCS_CONFIG = {
    'host': '192.168.1.90',     # IP của server ERP
    'user': 'faceuser',         # Username MySQL
    'password': 'your_pass',    # Password MySQL
    'database': 'erp_sof_documents_v4_0'  # Database ảnh
}
```

### 2. Test kết nối:
```bash
python testconnect.py
```

## 🎯 Các lệnh chính

### Import nhân viên từ ERP:
```bash
python import_employees.py
```

### Kiểm tra kết quả:
```bash
python check_database.py
```

### Xóa dữ liệu (nếu cần import lại):
```bash
python clear_database.py
```

### Thêm nhân viên mẫu (để test):
```bash
python add_sample_employees.py
```

## 📊 Kết quả mong đợi

✅ **Thành công:**
```
🚀 Bắt đầu import nhân viên từ ERP...
Tìm thấy X nhân viên trong ERP
Đang import nhân viên: Tên NV (Mã NV)
  - ✅ Import thành công: Tên NV

📊 KẾT QUẢ IMPORT:
✅ Thành công: X
❌ Lỗi: 0
```

❌ **Lỗi thường gặp:**
- `Access denied` → Sai username/password
- `Connection refused` → Sai IP hoặc MySQL không chạy
- `Table doesn't exist` → Sai tên database/bảng
- `Không tìm thấy ảnh` → Nhân viên chưa có ảnh trong ERP

## 🔧 Troubleshooting nhanh

1. **Lỗi kết nối:**
   ```bash
   # Test MySQL trực tiếp
   mysql -h IP -u USER -p
   ```

2. **Không import được:**
   - Kiểm tra log chi tiết khi chạy script
   - Xem file `config_import.py` có đúng không
   - Test với `python testconnect.py`

3. **Import thành công nhưng không nhận diện được:**
   - Kiểm tra chất lượng ảnh trong ERP
   - Đảm bảo ảnh có khuôn mặt rõ ràng
   - Chạy lại để reload face encodings

## 📞 Liên hệ hỗ trợ

Nếu gặp vấn đề, cung cấp thông tin:
- Output của `python check_database.py`
- Log error khi chạy import
- Cấu hình trong `config_import.py` (che password)

---
*Tài liệu đầy đủ: `HUONG_DAN_IMPORT.md`* 