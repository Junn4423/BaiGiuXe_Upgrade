# Import dữ liệu test vào XAMPP

## ✅ Phiên bản tương thích XAMPP

File `generate_test_data_xampp.sql` đã được tối ưu cho XAMPP/MySQL:

### 🔧 Các điều chỉnh cho XAMPP:

- **Bỏ JSON functions**: Thay bằng CASE statements
- **Đơn giản hóa random plate**: Không dùng JSON_EXTRACT
- **Thêm progress tracking**: Hiển thị tiến độ mỗi 30 ngày
- **Safe mode handling**: Tự động disable/enable SQL_SAFE_UPDATES
- **Error handling**: Dùng TRUNCATE thay vì DELETE
- **Memory optimization**: Tối ưu cho MySQL/MariaDB

## 🚀 Cách import vào XAMPP:

### 1. Mở phpMyAdmin:

```
http://localhost/phpmyadmin
```

### 2. Chọn database `pm`

### 3. Import file SQL:

- Tab **Import**
- Choose file: `generate_test_data_xampp.sql`
- Format: **SQL**
- Click **Go**

### 4. Hoặc dùng command line:

```bash
# Vào thư mục XAMPP/mysql/bin
cd C:\xampp\mysql\bin

# Import file
mysql -u root -p pm < "D:\CongTy\Chung\BaiGiuXe\BaiGiuXe_Upgrade\backend\sql\generate_test_data_xampp.sql"
```

## ⏱️ Thời gian thực thi:

- **phpMyAdmin**: 10-15 phút
- **Command line**: 5-8 phút
- **Progress**: Hiển thị mỗi 30 ngày (8 lần update)

## 📊 Kết quả mong đợi:

### Dữ liệu được tạo:

- **234 bảng partition**: `pm_nc0009_01012025` → `pm_nc0009_21082025`
- **~20,000+ records** tổng cộng
- **50-150 sessions/ngày** ngẫu nhiên

### Kiểm tra sau khi import:

```sql
-- Xem tổng số bảng được tạo
SHOW TABLES LIKE 'pm_nc0009_%';

-- Xem số records một vài bảng
SELECT COUNT(*) FROM pm_nc0009_01012025 WHERE lv014='DA_RA';
SELECT COUNT(*) FROM pm_nc0009_15062025 WHERE lv014='DA_RA';

-- Test báo cáo 3 tháng
SELECT COUNT(*) as total_3_months FROM (
    SELECT * FROM pm_nc0009_22052025 WHERE lv014='DA_RA'
    UNION ALL
    SELECT * FROM pm_nc0009_22062025 WHERE lv014='DA_RA'
    UNION ALL
    SELECT * FROM pm_nc0009_22072025 WHERE lv014='DA_RA'
) t;
```

## 🛠️ Troubleshooting XAMPP:

### Nếu timeout:

```sql
-- Tăng timeout trong phpMyAdmin
SET SESSION wait_timeout = 3600;
SET SESSION interactive_timeout = 3600;
```

### Nếu memory limit:

- Sửa `php.ini`: `memory_limit = 512M`
- Sửa `my.ini`: `max_allowed_packet = 64M`
- Restart XAMPP

### Nếu procedure error:

```sql
-- Kiểm tra quyền
SHOW GRANTS FOR 'root'@'localhost';

-- Enable procedure creation
SET GLOBAL log_bin_trust_function_creators = 1;
```

## ✅ Validation:

Sau khi import thành công, test ngay:

1. **Frontend → Statistics → Detailed Report**
2. **Date range**: 2025-02-22 to 2025-08-22 (6 tháng)
3. **Export Excel** → Sẽ có 6 sheets với dữ liệu đầy đủ

## 📈 Kết quả Excel mong đợi:

- **Sheet 1**: Tổng quan (~18,000 sessions, ~200M VNĐ revenue)
- **Sheet 2**: Daily report (154 ngày chi tiết)
- **Sheet 3**: Payment breakdown (4 phương thức)
- **Sheet 4**: Vehicle breakdown (4 loại xe)
- **Sheet 5**: Hourly breakdown (24 giờ)
- **Sheet 6**: Details (10,000 records gần nhất)

## 🗑️ Xóa test data:

```sql
-- Xóa tất cả bảng partition
DROP TABLE pm_nc0009_01012025, pm_nc0009_02012025; -- ...manual list

-- Hoặc dùng script
SELECT CONCAT('DROP TABLE ', table_name, ';')
FROM information_schema.tables
WHERE table_name LIKE 'pm_nc0009_%';
```

Script này 100% tương thích với XAMPP và sẽ tạo đủ dữ liệu để test đầy đủ chức năng báo cáo Excel!
