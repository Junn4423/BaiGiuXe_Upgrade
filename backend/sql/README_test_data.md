# Hướng dẫn tạo dữ liệu test cho hệ thống báo cáo

## 📋 Mô tả

Script `generate_test_data.sql` tạo dữ liệu test cho hệ thống bãi giữ xe từ ngày 01/01/2025 đến 21/08/2025 để test chức năng báo cáo Excel.

## 🗄️ Cấu trúc dữ liệu được tạo

### Bảng chính: `pm_nc0009` và các bảng partition `pm_nc0009_ddmmyyyy`

**Các trường quan trọng:**

- `lv001`: Session ID (unique)
- `lv002`: UID thẻ RFID
- `lv003`: Biển số xe (ngẫu nhiên theo format VN)
- `lv004`: Vị trí gửi xe (A001-A100)
- `lv005`: Mã chính sách giá
- `lv008`: Thời gian vào
- `lv009`: Thời gian ra
- `lv010`: Tổng phút gửi (15-480 phút)
- `lv013`: Phí thu được
- `lv014`: Trạng thái = 'DA_RA'
- `mienGiam`: Miễn giảm (10% khách có miễn giảm)
- `phuongThucTT`: Phương thức thanh toán

### Dữ liệu ngẫu nhiên được tạo:

**Biển số:** Format chuẩn VN (51A1-234.56, 29B2-567.89...)

**Loại xe và chính sách giá:**

- 60% xe máy (`CS_XEMAY_4H`): 5K/4h, 5K/h thêm
- 25% ô tô (`CS_OTO_4H`): 15K/4h, 5K/h thêm
- 10% xe 6 chỗ (`CS_XE_69CHO_1N`): 30 VNĐ/2h
- 5% ô tô 7 ngày (`CS_OT_7N`): 5K/4h, 2K/h thêm

**Phương thức thanh toán:**

- 70% tiền mặt
- 15% QR code
- 10% thẻ
- 5% chuyển khoản

**Khối lượng dữ liệu:**

- 50-150 phiên/ngày (ngẫu nhiên)
- Tổng cộng ~20,000+ bản ghi cho 234 ngày
- Thời gian gửi: 15 phút - 8 giờ

## 🚀 Cách sử dụng

### 1. Backup database trước khi chạy:

```bash
mysqldump -u root -p pm > pm_backup_$(date +%Y%m%d).sql
```

### 2. Chạy script tạo dữ liệu:

```bash
mysql -u root -p pm < generate_test_data.sql
```

### 3. Kiểm tra kết quả:

```sql
-- Xem tổng số bản ghi
SELECT COUNT(*) FROM pm_nc0009 WHERE lv014='DA_RA';

-- Xem doanh thu theo tháng
SELECT
    YEAR(lv008) as nam,
    MONTH(lv008) as thang,
    COUNT(*) as so_phien,
    SUM(lv013) as doanh_thu,
    AVG(lv013) as gia_trung_binh
FROM pm_nc0009
WHERE lv014='DA_RA'
GROUP BY YEAR(lv008), MONTH(lv008)
ORDER BY nam, thang;

-- Kiểm tra một bảng partition cụ thể
SELECT COUNT(*) FROM pm_nc0009_15062025 WHERE lv014='DA_RA';
```

## 📊 Test báo cáo Excel

Sau khi có dữ liệu, có thể test:

1. **Báo cáo 30 ngày:** 2025-07-23 → 2025-08-22
2. **Báo cáo 3 tháng:** 2025-05-22 → 2025-08-22
3. **Báo cáo 6 tháng:** 2025-02-22 → 2025-08-22
4. **Báo cáo 1 năm:** 2025-01-01 → 2025-08-22

## ⚠️ Lưu ý

- Script này sẽ **XÓA** dữ liệu cũ trong các bảng partition
- Chỉ tạo dữ liệu cho các ngày trước ngày hiện tại (< 2025-08-22)
- Dữ liệu ngày hiện tại được insert vào bảng chính `pm_nc0009`
- Thời gian thực thi: ~5-10 phút tùy máy

## 🔧 Tùy chỉnh

Có thể sửa trong script:

- `sessions_per_day`: Số phiên/ngày (hiện tại 50-150)
- Tỷ lệ loại xe (hiện tại 60% xe máy, 25% ô tô...)
- Phạm vi thời gian gửi xe (15-480 phút)
- Tỷ lệ miễn giảm (10%)

## 🗑️ Xóa dữ liệu test

```sql
-- Xóa tất cả bảng partition test
DROP TABLE IF EXISTS pm_nc0009_01012025, pm_nc0009_02012025, pm_nc0009_03012025;
-- ... (hoặc dùng script)

-- Xóa dữ liệu trong bảng chính
DELETE FROM pm_nc0009 WHERE lv001 > 1000000;
```
