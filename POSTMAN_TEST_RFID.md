# Postman Test Body cho API Thêm Thẻ RFID (ĐÃ SỬA LỖI FOREIGN KEY)

## Endpoint

```
POST http://192.168.1.94/parkinglot/services.sof.vn/index.php
```

## Headers

```
Content-Type: application/json
X-USER-CODE: [user_code_sau_khi_login]
X-USER-TOKEN: [user_token_sau_khi_login]
```

## ⚠️ VẤN ĐỀ ĐÃ KHẮC PHỤC

- **Foreign Key Constraint**: Thẻ KHACH giờ sẽ set `lv005 = NULL` thay vì chuỗi rỗng
- **Enum Constraint**: Database đã hỗ trợ `NHANVIEN` trong enum
- **Logic**: Backend tự động set NULL cho biển số khi không cần thiết

## Body JSON - Test 1: Thẻ KHACH (thẻ thường - không cần biển số)

```json
{
  "table": "pm_nc0003",
  "func": "add",
  "uidThe": "TEST001",
  "loaiThe": "KHACH",
  "trangThai": "1"
}
```

## Body JSON - Test 2: Thẻ VIP (có biển số)

```json
{
  "table": "pm_nc0003",
  "func": "add",
  "uidThe": "TEST002",
  "loaiThe": "VIP",
  "trangThai": "1",
  "bienSoXe": "86B12345",
  "maChinhSach": "CS_XE_MAY_3T",
  "ngayKetThucCS": "2025-12-31"
}
```

## Body JSON - Test 3: Thẻ VIP (không có biển số - khách vãng lai)

```json
{
  "table": "pm_nc0003",
  "func": "add",
  "uidThe": "TEST003",
  "loaiThe": "VIP",
  "trangThai": "1"
}
```

## Body JSON - Test 4: Thẻ NHANVIEN (sẽ được map thành VIP)

```json
{
  "table": "pm_nc0003",
  "func": "add",
  "uidThe": "TEST004",
  "loaiThe": "NHANVIEN",
  "trangThai": "1",
  "bienSoXe": "86B67890",
  "maChinhSach": "CS_NHANVIEN",
  "ngayKetThucCS": "2026-01-31"
}
```

## Body JSON - Test 5: Thẻ NHANVIEN (không có biển số)

```json
{
  "table": "pm_nc0003",
  "func": "add",
  "uidThe": "TEST005",
  "loaiThe": "NHANVIEN",
  "trangThai": "1"
}
```

## Cách lấy Authentication Token

### 1. Đăng nhập trước để lấy token:

```
POST http://192.168.1.94/parkinglot/login.sof.vn/index.php
```

Body:

```json
{
  "action": "login",
  "username": "[your_username]",
  "password": "[your_password]"
}
```

### 2. Từ response, lấy code và token để dùng trong header

## Expected Responses

### Success:

```json
{
  "success": true,
  "message": "Thêm mới thành công"
}
```

### Error (trước khi fix):

```json
{
  "success": false,
  "message": "Biển số xe không hợp lệ hoặc chưa đăng ký trong hệ thống"
}
```

### Error (duplicate):

```json
{
  "success": false,
  "message": "Thẻ với UID này đã tồn tại"
}
```

## Notes

- Thẻ KHACH: không cần truyền bienSoXe, maChinhSach, ngayKetThucCS
- Thẻ VIP/NHANVIEN: có thể có hoặc không có biển số
- Backend sẽ tự động map NHANVIEN → VIP (tạm thời)
- UID thẻ phải unique
- trangThai: "1" = active, "0" = inactive
