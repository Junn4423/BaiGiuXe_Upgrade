-- ========================================
-- PM PARKING STATISTICS DB (No Foreign Keys)
-- Compatible with XAMPP/MariaDB/MySQL
-- ========================================

-- ==============================
-- BẢNG SỰ CỐ & KHIẾU NẠI
-- ==============================
CREATE TABLE IF NOT EXISTS pm_nc0012 (
    lv001 INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID sự cố',
    lv002 DATETIME NOT NULL COMMENT 'Ngày giờ xảy ra sự cố',
    lv003 VARCHAR(100) NOT NULL COMMENT 'Loại sự cố',
    lv004 VARCHAR(50) COMMENT 'ID phiên gửi xe liên quan',
    lv005 VARCHAR(20) COMMENT 'Biển số xe liên quan',
    lv006 TEXT COMMENT 'Mô tả chi tiết sự cố',
    lv007 VARCHAR(500) COMMENT 'Link ảnh chứng cứ',
    lv008 TEXT COMMENT 'Cách xử lý',
    lv009 INT DEFAULT 0 COMMENT 'Thời gian xử lý (phút)',
    lv010 VARCHAR(200) COMMENT 'Kết quả xử lý',
    lv011 DECIMAL(15,2) DEFAULT 0 COMMENT 'Số tiền bồi thường',
    lv012 ENUM('MOI','DANG_XU_LY','DA_GIAI_QUYET','DONG') DEFAULT 'MOI' COMMENT 'Trạng thái xử lý',
    lv013 INT COMMENT 'ID nhân viên xử lý (tham chiếu tự do)',
    lv014 INT COMMENT 'ID người tạo báo cáo (tham chiếu tự do)',
    lv015 DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
    lv016 DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Ngày cập nhật',
    INDEX idx_ngay_gio (lv002),
    INDEX idx_loai_su_co (lv003),
    INDEX idx_trang_thai (lv012),
    INDEX idx_ticketID (lv004)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Quản lý sự cố và khiếu nại';


-- ==============================
-- BẢNG THIẾT BỊ
-- ==============================
CREATE TABLE IF NOT EXISTS pm_nc0013 (
    lv001 INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID thiết bị',
    lv002 VARCHAR(100) NOT NULL COMMENT 'Tên thiết bị',
    lv003 ENUM('CAMERA','BARRIER','RFID_READER','PRINTER','SPEAKER','LED_DISPLAY','SENSOR') NOT NULL COMMENT 'Loại thiết bị',
    lv004 VARCHAR(200) NOT NULL COMMENT 'Tên chi tiết thiết bị',
    lv005 VARCHAR(50) UNIQUE COMMENT 'Mã thiết bị',
    lv006 INT COMMENT 'Khu vực đặt thiết bị (tham chiếu tự do)',
    lv007 VARCHAR(200) COMMENT 'Vị trí chi tiết',
    lv008 VARCHAR(45) COMMENT 'Địa chỉ IP',
    lv009 INT COMMENT 'Port kết nối',
    lv010 VARCHAR(50) COMMENT 'Phiên bản firmware',
    lv011 ENUM('HOAT_DONG','BAO_TRI','LOI','NGUNG_HOAT_DONG') DEFAULT 'HOAT_DONG' COMMENT 'Trạng thái',
    lv012 DATE COMMENT 'Ngày lắp đặt',
    lv013 DATE COMMENT 'Ngày hết bảo hành',
    lv014 TEXT COMMENT 'Ghi chú',
    lv015 DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
    lv016 DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Ngày cập nhật',
    INDEX idx_loai_thiet_bi (lv003),
    INDEX idx_khu_vuc (lv006),
    INDEX idx_trang_thai (lv011)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Quản lý thiết bị';


-- ==============================
-- BẢNG LOG THIẾT BỊ
-- ==============================
CREATE TABLE IF NOT EXISTS pm_nc0014 (
    lv001 INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID log',
    lv002 INT NOT NULL COMMENT 'ID thiết bị (tham chiếu tự do)',
    lv003 VARCHAR(50) COMMENT 'Cổng',
    lv004 VARCHAR(50) COMMENT 'Làn',
    lv005 ENUM('UP','DOWN','ERROR','MAINTENANCE','RESTART','CONFIG_CHANGE') NOT NULL COMMENT 'Loại sự kiện',
    lv006 TEXT COMMENT 'Mô tả chi tiết',
    lv007 VARCHAR(50) COMMENT 'Phiên bản firmware',
    lv008 INT DEFAULT 0 COMMENT 'Thời gian hoạt động (phút)',
    lv009 INT DEFAULT 0 COMMENT 'Thời gian nghỉ (phút)',
    lv010 INT DEFAULT 0 COMMENT 'Mean Time To Repair',
    lv011 INT COMMENT 'ID nhân viên xử lý (tham chiếu tự do)',
    lv012 VARCHAR(200) COMMENT 'Kết quả xử lý',
    lv013 DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian log',
    INDEX idx_thiet_bi_id (lv002),
    INDEX idx_thoi_gian (lv013),
    INDEX idx_su_kien (lv005)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Log hoạt động thiết bị';


-- ==============================
-- BẢNG LOG HỆ THỐNG
-- ==============================
CREATE TABLE IF NOT EXISTS pm_nc0015 (
    lv001 INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID log',
    lv002 DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian',
    lv003 VARCHAR(45) NOT NULL COMMENT 'Địa chỉ IP',
    lv004 TEXT COMMENT 'User agent',
    lv005 VARCHAR(100) COMMENT 'Loại thiết bị',
    lv006 VARCHAR(100) NOT NULL COMMENT 'Hành động',
    lv007 TEXT COMMENT 'Mô tả',
    lv008 INT COMMENT 'ID người dùng (tham chiếu tự do)',
    lv009 ENUM('THANH_CONG','THAT_BAI','BI_CHAN') DEFAULT 'THANH_CONG' COMMENT 'Kết quả',
    lv010 INT COMMENT 'Thời gian phản hồi (ms)',
    INDEX idx_thoi_gian (lv002),
    INDEX idx_ip_address (lv003),
    INDEX idx_hanh_dong (lv006),
    INDEX idx_user_id (lv008),
    INDEX idx_ket_qua (lv009)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Log hệ thống';


-- ==============================
-- BỔ SUNG CỘT CHO BẢNG pm_nc0009
-- ==============================
ALTER TABLE pm_nc0009 
  ADD COLUMN IF NOT EXISTS lv017 TINYINT(1) DEFAULT 0 COMMENT 'Vé thất lạc',
  ADD COLUMN IF NOT EXISTS lv018 TINYINT(1) DEFAULT 0 COMMENT 'Ghi đè giá',
  ADD COLUMN IF NOT EXISTS lv019 DECIMAL(15,2) DEFAULT 0 COMMENT 'Miễn giảm',
  ADD COLUMN IF NOT EXISTS lv020 ENUM('TIEN_MAT','QR_CODE','THE','CHUYEN_KHOAN') DEFAULT 'TIEN_MAT' COMMENT 'Phương thức thanh toán',
  ADD COLUMN IF NOT EXISTS lv021 VARCHAR(50) COMMENT 'Cổng vào',
  ADD COLUMN IF NOT EXISTS lv022 VARCHAR(50) COMMENT 'Cổng ra',
  ADD COLUMN IF NOT EXISTS lv023 DECIMAL(3,2) DEFAULT 0 COMMENT 'Tin cậy ANPR',
  ADD COLUMN IF NOT EXISTS lv024 TINYINT(1) DEFAULT 0 COMMENT 'RFID OK',
  ADD COLUMN IF NOT EXISTS lv025 VARCHAR(500) COMMENT 'Ảnh vào',
  ADD COLUMN IF NOT EXISTS lv026 VARCHAR(500) COMMENT 'Ảnh ra',
  ADD COLUMN IF NOT EXISTS lv027 TEXT COMMENT 'Lý do điều chỉnh',
  ADD COLUMN IF NOT EXISTS lv028 INT COMMENT 'Chính sách giá',
  ADD COLUMN IF NOT EXISTS lv029 DATE GENERATED ALWAYS AS (DATE(lv008)) STORED COMMENT 'Ngày',
  ADD COLUMN IF NOT EXISTS lv030 TINYINT GENERATED ALWAYS AS (HOUR(lv008)) STORED COMMENT 'Giờ';

-- INDEX
CREATE INDEX IF NOT EXISTS idx_phuongThucTT ON pm_nc0009 (lv020);
CREATE INDEX IF NOT EXISTS idx_override ON pm_nc0009 (lv018);
CREATE INDEX IF NOT EXISTS idx_lostTicket ON pm_nc0009 (lv017);
CREATE INDEX IF NOT EXISTS idx_pm_nc0009_stats ON pm_nc0009 (lv029, lv014, lv013);
CREATE INDEX IF NOT EXISTS idx_pm_nc0009_pricing ON pm_nc0009 (lv005, lv029);
CREATE INDEX IF NOT EXISTS idx_pm_nc0009_zone ON pm_nc0009 (lv004, lv029);


-- ==============================
-- VIEW THỐNG KÊ
-- ==============================
DROP VIEW IF EXISTS v_daily_revenue_summary;
CREATE VIEW v_daily_revenue_summary AS
SELECT 
    lv029 as ngay,
    COUNT(*) as tong_luot,
    SUM(lv013) as doanh_thu,
    AVG(lv013) as gia_trung_binh,
    COUNT(DISTINCT lv003) as so_xe_khac_nhau,
    SUM(CASE WHEN lv020='TIEN_MAT' THEN lv013 ELSE 0 END) as tien_mat,
    SUM(CASE WHEN lv020='QR_CODE' THEN lv013 ELSE 0 END) as qr_code,
    SUM(CASE WHEN lv020='THE' THEN lv013 ELSE 0 END) as the_rfid
FROM pm_nc0009
WHERE lv014='DA_RA'
GROUP BY lv029
ORDER BY lv029 DESC;

DROP VIEW IF EXISTS v_hourly_traffic_summary;
CREATE VIEW v_hourly_traffic_summary AS
SELECT 
    lv029 as ngay,
    lv030 as gio,
    COUNT(*) as tong_luot,
    SUM(lv014 IN ('VAO','DANG_GUI')) as xe_vao,
    SUM(lv014='DA_RA') as xe_ra,
    SUM(lv013) as doanh_thu_gio
FROM pm_nc0009
GROUP BY lv029, lv030
ORDER BY lv029 DESC, lv030;


-- ==============================
-- DỮ LIỆU MẪU
-- ==============================
INSERT IGNORE INTO pm_nc0013 (lv002,lv003,lv004,lv005,lv006,lv011) VALUES
('Camera Cổng 1','CAMERA','Camera ANPR Cổng Vào Chính','CAM_001',1,'HOAT_DONG'),
('Camera Cổng 2','CAMERA','Camera ANPR Cổng Ra Chính','CAM_002',1,'HOAT_DONG'),
('Barrier Vào','BARRIER','Barrier Tự Động Cổng Vào','BAR_001',1,'HOAT_DONG'),
('Barrier Ra','BARRIER','Barrier Tự Động Cổng Ra','BAR_002',1,'HOAT_DONG'),
('Đầu đọc RFID 1','RFID_READER','Đầu đọc thẻ từ cổng vào','RFID_001',1,'HOAT_DONG');

INSERT IGNORE INTO pm_nc0012 (lv002,lv003,lv006,lv012,lv014) VALUES
('2025-08-19 08:30:00','CAMERA_LOI','Camera cổng 1 không nhận diện được biển số','DA_GIAI_QUYET',1),
('2025-08-19 14:15:00','KHIEU_NAI_KHACH','Khách hàng khiếu nại tính phí sai','DANG_XU_LY',1),
('2025-08-19 16:45:00','BARRIER_LOI','Barrier không mở sau khi quét thẻ','MOI',1);

COMMIT;
