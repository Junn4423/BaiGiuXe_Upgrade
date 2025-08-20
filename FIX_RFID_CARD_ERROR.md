# Hướng dẫn sửa lỗi "Biển số xe không hợp lệ hoặc chưa đăng ký trong hệ thống"

## Vấn đề

- Frontend hỗ trợ 3 loại thẻ: `KHACH`, `VIP`, `NHANVIEN`
- Database enum chỉ hỗ trợ 2 loại: `'VIP','KHACH'`
- Khi thêm thẻ `NHANVIEN`, MySQL báo lỗi enum constraint

## Giải pháp tạm thời (ĐÃ THỰC HIỆN)

- Sửa backend để map `NHANVIEN` → `VIP` tạm thời
- File đã sửa: `backend/php/services.sof.vn/kebao.php`

## Giải pháp lâu dài (CẦN THỰC HIỆN)

1. Chạy script SQL để cập nhật enum:

   ```sql
   ALTER TABLE `pm_nc0003`
   MODIFY COLUMN `lv002` enum('VIP','KHACH','NHANVIEN') NOT NULL DEFAULT 'KHACH' COMMENT 'Loại thẻ';
   ```

2. Sau khi cập nhật database, có thể revert lại backend để không cần map nữa

## Kiểm tra

- Thẻ `KHACH`: không cần biển số → gửi `null` hoặc chuỗi rỗng
- Thẻ `VIP`/`NHANVIEN`: có thể có hoặc không có biển số
- Logic hiện tại cho phép thẻ VIP/NHANVIEN không có biển số (cho khách vãng lai)

## File liên quan

- `backend/php/services.sof.vn/kebao.php` - Logic nghiệp vụ thẻ RFID
- `backend/sql/update_pm_nc0003_enum.sql` - Script cập nhật database
- `frontend/src/views/dialogs/RfidManagerDialogClean.jsx` - Giao diện quản lý thẻ
- `frontend/src/api/api.js` - API calls
