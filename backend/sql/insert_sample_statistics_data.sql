-- ========================================
-- INSERT SAMPLE DATA FOR PM_NC0012-15 TABLES
-- Dữ liệu mẫu để test thống kê
-- ========================================

-- ==============================
-- DỮ LIỆU MẪU CHO pm_nc0013 (THIẾT BỊ)
-- ==============================
INSERT IGNORE INTO pm_nc0013 (lv002, lv003, lv004, lv005, lv006, lv011, lv007, lv008) VALUES
('Camera Cổng 1', 'CAMERA', 'Camera ANPR Cổng Vào Chính', 'CAM_001', 1, 'HOAT_DONG', 'Cổng chính', '192.168.1.100'),
('Camera Cổng 2', 'CAMERA', 'Camera ANPR Cổng Ra Chính', 'CAM_002', 1, 'HOAT_DONG', 'Cổng chính', '192.168.1.101'),
('Camera Khu A', 'CAMERA', 'Camera giám sát khu A', 'CAM_003', 2, 'HOAT_DONG', 'Khu vực A', '192.168.1.102'),
('Barrier Vào', 'BARRIER', 'Barrier Tự Động Cổng Vào', 'BAR_001', 1, 'HOAT_DONG', 'Cổng vào', '192.168.1.110'),
('Barrier Ra', 'BARRIER', 'Barrier Tự Động Cổng Ra', 'BAR_002', 1, 'HOAT_DONG', 'Cổng ra', '192.168.1.111'),
('Đầu đọc RFID 1', 'RFID_READER', 'Đầu đọc thẻ từ cổng vào', 'RFID_001', 1, 'HOAT_DONG', 'Cổng vào', '192.168.1.120'),
('Đầu đọc RFID 2', 'RFID_READER', 'Đầu đọc thẻ từ cổng ra', 'RFID_002', 1, 'HOAT_DONG', 'Cổng ra', '192.168.1.121'),
('LED Display Vào', 'LED_DISPLAY', 'Màn hình LED hiển thị thông tin', 'LED_001', 1, 'HOAT_DONG', 'Cổng vào', '192.168.1.130'),
('Speaker Cổng 1', 'SPEAKER', 'Loa thông báo cổng vào', 'SPK_001', 1, 'HOAT_DONG', 'Cổng vào', '192.168.1.140'),
('Sensor Khu A', 'SENSOR', 'Cảm biến đếm xe khu A', 'SNS_001', 2, 'BAO_TRI', 'Khu vực A', '192.168.1.150');

-- ==============================
-- DỮ LIỆU MẪU CHO pm_nc0012 (SỰ CỐ)
-- ==============================
INSERT IGNORE INTO pm_nc0012 (lv002, lv003, lv004, lv005, lv006, lv012, lv014, lv011) VALUES
('2025-08-19 08:30:00', 'CAMERA_LOI', 'TK_001', '29A-12345', 'Camera cổng 1 không nhận diện được biển số xe 29A-12345', 'DA_GIAI_QUYET', 1, 0),
('2025-08-19 09:15:00', 'BARRIER_LOI', 'TK_002', '30B-67890', 'Barrier không mở sau khi quét thẻ RFID hợp lệ', 'DA_GIAI_QUYET', 1, 0),
('2025-08-19 10:45:00', 'KHIEU_NAI_KHACH', 'TK_003', '31C-11111', 'Khách hàng khiếu nại tính phí sai, xe ra muộn 5 phút', 'DANG_XU_LY', 1, 50000),
('2025-08-19 11:20:00', 'THE_LOI', 'TK_004', '32D-22222', 'Thẻ RFID không đọc được, khách yêu cầu hỗ trợ', 'DA_GIAI_QUYET', 1, 0),
('2025-08-19 14:30:00', 'BIEN_SO_MO', 'TK_005', '33E-33333', 'Không nhận diện được biển số do mờ, nhập thủ công', 'DA_GIAI_QUYET', 1, 0),
('2025-08-19 15:45:00', 'MAT_VE', 'TK_006', '34F-44444', 'Khách hàng mất vé, tính phí tối đa theo quy định', 'DA_GIAI_QUYET', 1, 0),
('2025-08-19 16:10:00', 'SYSTEM_ERROR', NULL, NULL, 'Hệ thống mất kết nối database trong 3 phút', 'DA_GIAI_QUYET', 1, 0),
('2025-08-19 17:00:00', 'KHIEU_NAI_KHACH', 'TK_007', '35G-55555', 'Khách phản ánh chỗ đỗ bị xe khác chiếm chỗ', 'MOI', 1, 0);

-- ==============================
-- DỮ LIỆU MẪU CHO pm_nc0014 (LOG THIẾT BỊ)
-- ==============================
INSERT IGNORE INTO pm_nc0014 (lv002, lv003, lv004, lv005, lv006, lv008, lv009, lv011) VALUES
(1, 'GATE_IN', 'LANE_1', 'UP', 'Camera khởi động thành công', 480, 5, 1),
(2, 'GATE_OUT', 'LANE_1', 'UP', 'Camera hoạt động bình thường', 480, 0, 1),
(3, 'PARK_A', 'ZONE_A', 'UP', 'Camera giám sát khu A online', 470, 10, 1),
(4, 'GATE_IN', 'LANE_1', 'ERROR', 'Barrier bị kẹt, không mở được', 0, 15, 1),
(4, 'GATE_IN', 'LANE_1', 'UP', 'Barrier đã được sửa và hoạt động trở lại', 465, 15, 1),
(5, 'GATE_OUT', 'LANE_1', 'UP', 'Barrier cổng ra hoạt động bình thường', 480, 0, 1),
(6, 'GATE_IN', 'LANE_1', 'UP', 'RFID reader cổng vào online', 480, 0, 1),
(7, 'GATE_OUT', 'LANE_1', 'UP', 'RFID reader cổng ra online', 480, 0, 1),
(8, 'GATE_IN', 'LANE_1', 'UP', 'LED display hiển thị bình thường', 480, 0, 1),
(9, 'GATE_IN', 'LANE_1', 'UP', 'Speaker phát âm thanh rõ ràng', 480, 0, 1),
(10, 'PARK_A', 'ZONE_A', 'MAINTENANCE', 'Sensor khu A đang bảo trì', 0, 120, 1),
(1, 'GATE_IN', 'LANE_1', 'RESTART', 'Camera khởi động lại sau update firmware', 5, 5, 1);

-- ==============================
-- DỮ LIỆU MẪU CHO pm_nc0015 (LOG HỆ THỐNG)
-- ==============================
INSERT IGNORE INTO pm_nc0015 (lv002, lv003, lv006, lv007, lv008, lv009, lv010) VALUES
('2025-08-19 08:00:00', '192.168.1.100', 'USER_LOGIN', 'Admin đăng nhập hệ thống', 1, 'THANH_CONG', 150),
('2025-08-19 08:15:00', '192.168.1.101', 'VEHICLE_ENTRY', 'Xe 29A-12345 vào bãi đỗ', 1, 'THANH_CONG', 200),
('2025-08-19 08:30:00', '192.168.1.100', 'CAMERA_ERROR', 'Camera cổng 1 gặp lỗi nhận diện biển số', 1, 'THAT_BAI', 5000),
('2025-08-19 08:35:00', '192.168.1.100', 'MANUAL_ENTRY', 'Nhập thủ công biển số 29A-12345', 1, 'THANH_CONG', 300),
('2025-08-19 09:00:00', '192.168.1.102', 'VEHICLE_EXIT', 'Xe 30B-67890 ra khỏi bãi đỗ', 1, 'THANH_CONG', 250),
('2025-08-19 09:15:00', '192.168.1.110', 'BARRIER_ERROR', 'Barrier cổng vào không mở được', 1, 'THAT_BAI', 8000),
('2025-08-19 09:20:00', '192.168.1.100', 'MANUAL_OPEN', 'Mở barrier thủ công cho xe 31C-11111', 1, 'THANH_CONG', 500),
('2025-08-19 10:00:00', '192.168.1.100', 'SYSTEM_BACKUP', 'Sao lưu dữ liệu hệ thống tự động', 0, 'THANH_CONG', 30000),
('2025-08-19 11:30:00', '192.168.1.101', 'RFID_ERROR', 'Thẻ RFID không đọc được', 1, 'THAT_BAI', 2000),
('2025-08-19 12:00:00', '192.168.1.100', 'REPORT_GENERATE', 'Tạo báo cáo thống kê tự động', 0, 'THANH_CONG', 5000),
('2025-08-19 14:00:00', '192.168.1.100', 'DATABASE_OPTIMIZE', 'Tối ưu hóa database tự động', 0, 'THANH_CONG', 15000),
('2025-08-19 16:00:00', '192.168.1.100', 'USER_LOGOUT', 'Admin đăng xuất khỏi hệ thống', 1, 'THANH_CONG', 100);

COMMIT;

-- ==============================
-- THỐNG KÊ KIỂM TRA
-- ==============================
SELECT 'Thiết bị (pm_nc0013)' as bang, COUNT(*) as so_ban_ghi FROM pm_nc0013
UNION ALL
SELECT 'Sự cố (pm_nc0012)' as bang, COUNT(*) as so_ban_ghi FROM pm_nc0012
UNION ALL
SELECT 'Log thiết bị (pm_nc0014)' as bang, COUNT(*) as so_ban_ghi FROM pm_nc0014
UNION ALL
SELECT 'Log hệ thống (pm_nc0015)' as bang, COUNT(*) as so_ban_ghi FROM pm_nc0015;
