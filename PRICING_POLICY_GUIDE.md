# Hướng dẫn Cấu hình Chính sách Giá

## Vấn đề "Thiếu chính sách"

### Nguyên nhân
- Chưa cấu hình chính sách giá cho loại phương tiện trong WorkConfig
- API không tìm thấy chính sách phù hợp với loại xe đã chọn

### Cách khắc phục

#### 1. Kiểm tra WorkConfig
```javascript
// Mở DevTools > Console và chạy:
console.log("Work config:", localStorage.getItem("work_config"))
```

#### 2. Tạo chính sách giá
1. Vào **Quản lý chính sách giá** 
2. Thêm chính sách cho loại xe:
   - **XE_MAY**: Tạo chính sách với mã như "CS_XEMAY_4H"
   - **OT**: Tạo chính sách với mã như "CS_OTO_4H"

#### 3. Cấu hình làm việc
1. Vào **Cấu hình làm việc**
2. Chọn đúng loại phương tiện đã tạo chính sách
3. Lưu cấu hình

#### 4. Test chính sách
```javascript
// Mở DevTools > Console và chạy:
await layChinhSachMacDinhChoLoaiPT("XE_MAY")
await layChinhSachMacDinhChoLoaiPT("OT")
```

### Logic mặc định
- Nếu không tìm thấy chính sách trong database, hệ thống sẽ dùng:
  - `CS_XEMAY_4H` cho xe máy
  - `CS_OTO_4H` cho ô tô

### Debug logs
Kiểm tra Console để xem:
- `🚗 Vehicle type determined from work config`
- `💰 Retrieved pricing policy`
- `📋 Required fields check`

### API liên quan
- `layChinhSachGiaTheoLoaiPT()` - Lấy chính sách theo loại PT
- `layChinhSachMacDinhChoLoaiPT()` - Lấy chính sách mặc định
- `themPhienGuiXe()` - Tạo phiên gửi xe (yêu cầu chính sách)
