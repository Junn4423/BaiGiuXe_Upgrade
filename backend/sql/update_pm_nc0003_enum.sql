-- Script để cập nhật enum cho bảng pm_nc0003 thêm loại thẻ NHANVIEN
-- Chạy script này để hỗ trợ thêm loại thẻ nhân viên

-- Cập nhật enum để thêm NHANVIEN
ALTER TABLE `pm_nc0003` 
MODIFY COLUMN `lv002` enum('VIP','KHACH','NHANVIEN') NOT NULL DEFAULT 'KHACH' COMMENT 'Loại thẻ';

-- Kiểm tra kết quả
DESCRIBE pm_nc0003;
