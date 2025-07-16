# Employee API Mapping Summary

## Tổng quan thay đổi
Đã hoàn thiện việc mapping API động trong EmployeePermissionDialog để kết nối với backend API từ api.js.

## Các thay đổi chính

### 1. Import API Functions
```javascript
import { 
  layDanhSachNhanVien, 
  themNhanVien, 
  capNhatNhanVien, 
  xoaNhanVien
} from "../../api/api"
```

### 2. Mapping dữ liệu từ API response sang form
**Backend API Response Format:**
```javascript
{
  taiKhoanDN: "admin",
  ten: "Nguyễn Văn Admin", 
  roleQuyen: "1",
  quyenHan: "1",
  nguoiThem: "admin",
  matKhau: "[encrypted]"
}
```

**Frontend Form Format:**
```javascript
{
  lv001: "admin",           // taiKhoanDN
  lv002: "1",              // roleQuyen  
  lv003: "Nguyễn",         // first name from ten
  lv004: "Văn Admin",      // last name from ten
  lv005: "",               // password (never shown)
  lv006: "admin",          // taiKhoanDN as employee ID
  lv095: "1",              // default active status
  lv099: "default",        // default theme
  lv900: ""                // default notes
}
```

### 3. Mapping dữ liệu từ form sang API request
**handleSave function mapping:**
```javascript
const employeeData = {
  taiKhoanDN: formData.lv001,    // User ID -> taiKhoanDN
  nguoiThem: "admin",           // Current user
  roleQuyen: formData.lv002,    // User Group ID -> roleQuyen
  ten: formData.lv003 + (formData.lv004 ? " " + formData.lv004 : ""), 
  quyenHan: formData.lv002,     // Same as roleQuyen
  ...(formData.lv005 ? { matKhau: formData.lv005 } : {})
}
```

### 4. Cập nhật các function khác
- **handleSelectEmployee:** Map API response sang form data
- **filteredEmployees:** Sử dụng `taiKhoanDN`, `ten`, `roleQuyen`
- **handleDelete:** Sử dụng `selectedEmployee.taiKhoanDN`
- **resetPassword:** Sử dụng capNhatNhanVien API với password mới
- **Employee list display:** Hiển thị `emp.ten`, `emp.taiKhoanDN`, `emp.quyenHan`
- **Statistics:** Filter theo `roleQuyen` thay vì `lv002`

### 5. Debug và Testing
- Thêm console.log để debug API response và request
- Tạo file test `testEmployeeAPI.js` để kiểm tra mapping

## API Functions được sử dụng

### layDanhSachNhanVien()
```javascript
// GET: lv_lv0007 table data
// Returns: Array of employee objects
```

### themNhanVien(employeeData)
```javascript
// POST: lv_lv0007 table add function
// Params: {taiKhoanDN, nguoiThem, roleQuyen, ten, quyenHan, matKhau}
```

### capNhatNhanVien(employeeData)  
```javascript
// PUT: lv_lv0007 table edit function
// Params: {taiKhoanDN, nguoiThem, roleQuyen, ten, quyenHan, matKhau?}
```

### xoaNhanVien(taiKhoanDN)
```javascript
// DELETE: Currently returns warning (not implemented in backend)
```

## Kiểm tra và Test

1. **Mở Developer Console**
2. **Gọi test functions:**
   ```javascript
   testEmployeeAPI()        // Test API calls
   testFormToAPIMapping()   // Test data mapping
   ```

3. **Kiểm tra EmployeePermissionDialog:**
   - Load danh sách nhân viên
   - Thêm nhân viên mới  
   - Cập nhật thông tin nhân viên
   - Reset password
   - Search và filter

## Cấu trúc dữ liệu hoàn chỉnh

### Backend Database (lv_lv0007)
- `taiKhoanDN` - Tài khoản đăng nhập (Primary Key)
- `nguoiThem` - Người thêm record
- `roleQuyen` - Role/quyền hạn (1-5)
- `matKhau` - Mật khẩu (encrypted)
- `ten` - Tên đầy đủ
- `quyenHan` - Quyền hạn cụ thể

### Permission Groups
0. "0" - Toàn quyền (Toàn quyền hệ thống)
1. "1" - Nhân Viên QL Vào (Quản lý xe vào bãi)  
2. "2" - Nhân Viên QL Ra (Quản lý xe ra khỏi bãi)
3. "3" - Nhân Viên QL Vào Ra (Quản lý xe vào và ra)

## Lưu ý
- Password reset sử dụng API capNhatNhanVien thay vì datLaiMatKhauNhanVien
- xoaNhanVien hiện tại chưa được implement ở backend
- Status filtering chưa được implement (dùng static "Hoạt động")
- Cần test với dữ liệu thực để đảm bảo mapping chính xác
