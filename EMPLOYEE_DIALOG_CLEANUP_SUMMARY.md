# Employee Dialog Backend Alignment Summary

## 🎯 **Vấn đề đã giải quyết**
Giao diện Employee Permission Dialog có nhiều trường dư thừa và không khớp với backend PHP structure. Backend đang map theo pattern:

```php
// Backend PHP mapping (lv_lv0007 table)
$lv_lv0007->lv001 = $input['taiKhoanDN']   // taiKhoanDN -> lv001
$lv_lv0007->lv003 = $input['nguoiThem']    // nguoiThem -> lv003  
$lv_lv0007->lv004 = $input['roleQuyen']    // roleQuyen -> lv004
$lv_lv0007->lv005 = $input['matKhau']      // matKhau -> lv005
$lv_lv0007->lv006 = $input['ten']          // ten -> lv006
$lv_lv0007->lv900 = $input['quyenHan']     // quyenHan -> lv900
```

## ✅ **Những thay đổi đã thực hiện**

### 1. **API Functions (api.js)**
- Cập nhật documentation cho `themNhanVien()` và `capNhatNhanVien()`
- Thêm mapping comments để hiểu rõ cách backend xử lý

### 2. **Frontend Form Structure (EmployeePermissionDialog.jsx)**

**Trước đây (có nhiều trường dư thừa):**
```javascript
const [formData, setFormData] = useState({
  lv001: "", // User ID
  lv002: "", // User Group ID
  lv003: "", // First Name
  lv004: "", // Last Name
  lv005: "", // Password
  lv006: "", // Employee ID
  lv095: "1", // Active Status
  lv099: "default", // Themes
  lv900: "" // Notes
})
```

**Sau khi sửa (chỉ những trường cần thiết):**
```javascript
const [formData, setFormData] = useState({
  lv001: "", // User ID (taiKhoanDN)
  lv004: "", // Role Quyền (roleQuyen) 
  lv006: "", // Tên nhân viên (ten)
  lv005: "", // Password (matKhau)
  lv900: "0" // Quyền hạn (quyenHan)
})
```

### 3. **Data Mapping Functions**

**handleSelectEmployee() - Map từ backend response:**
```javascript
setFormData({
  lv001: employee.lv001 || "",      // taiKhoanDN từ backend
  lv004: employee.lv004 || "",      // roleQuyen từ backend  
  lv006: employee.lv006 || "",      // ten từ backend
  lv005: "", // Never show password
  lv900: employee.lv900 || "0"      // quyenHan từ backend
})
```

**handleSave() - Map sang API format:**
```javascript
const employeeData = {
  taiKhoanDN: formData.lv001,    // lv001 -> taiKhoanDN
  nguoiThem: "admin",           // Fixed value
  roleQuyen: formData.lv004,    // lv004 -> roleQuyen
  ten: formData.lv006,          // lv006 -> ten
  quyenHan: formData.lv900,     // lv900 -> quyenHan
  ...(formData.lv005 ? { matKhau: formData.lv005 } : {})
}
```

### 4. **UI Form Fields**

**Loại bỏ các trường không cần thiết:**
- ❌ First Name/Last Name riêng lẻ → ✅ Tên nhân viên duy nhất
- ❌ Employee ID riêng → ✅ Sử dụng User ID
- ❌ Active Status → ✅ Mặc định hoạt động
- ❌ Theme settings → ✅ Loại bỏ
- ❌ Notes field → ✅ Loại bỏ

**Các trường còn lại:**
- ✅ **Tài Khoản Đăng Nhập** (lv001 → taiKhoanDN)
- ✅ **Tên Nhân Viên** (lv006 → ten)  
- ✅ **Mật Khẩu** (lv005 → matKhau)
- ✅ **Role Quyền** (lv004 → roleQuyen)
- ✅ **Quyền Hạn** (lv900 → quyenHan)

### 5. **Permission Groups Update**
```javascript
const PERMISSION_GROUPS = [
  { value: "0", label: "Toàn quyền", description: "Toàn quyền hệ thống" },
  { value: "1", label: "Nhân Viên QL Vào", description: "Quản lý xe vào bãi" },
  { value: "2", label: "Nhân Viên QL Ra", description: "Quản lý xe ra khỏi bãi" },
  { value: "3", label: "Nhân Viên QL Vào Ra", description: "Quản lý xe vào và ra" }
]
```

### 6. **Display và Filter Functions**
- Employee list display sử dụng `emp.lv001`, `emp.lv006`, `emp.lv004`, `emp.lv900`
- Filter functions sử dụng đúng field names từ backend
- Statistics cập nhật để count đúng theo `lv900` field

## 🔧 **Backend Structure Alignment**

| Frontend Field | Backend Field | Description |
|---------------|---------------|-------------|
| `lv001` | `taiKhoanDN` | Tài khoản đăng nhập |
| `lv004` | `roleQuyen` | Role quyền (0-3) |
| `lv005` | `matKhau` | Mật khẩu |
| `lv006` | `ten` | Tên nhân viên |
| `lv900` | `quyenHan` | Quyền hạn (0-3) |
| (fixed) | `nguoiThem` | Người thêm (admin) |

## 📋 **Validation Rules**
- ✅ Tài khoản đăng nhập: Required, unique
- ✅ Tên nhân viên: Required
- ✅ Mật khẩu: Required cho record mới
- ✅ Role quyền: Required, phải chọn từ dropdown
- ✅ Quyền hạn: Default = "0" (Toàn quyền)

## 🎯 **Kết quả**
- ✅ Loại bỏ hoàn toàn các trường dư thừa
- ✅ Form gọn gàng, chỉ hiển thị trường cần thiết
- ✅ Data mapping chính xác với backend PHP
- ✅ API calls alignment với backend structure
- ✅ Validation rules phù hợp với business logic
- ✅ Permission groups cập nhật theo yêu cầu thực tế

## 🧪 **Testing Checklist**
- [ ] Load danh sách nhân viên
- [ ] Thêm nhân viên mới 
- [ ] Cập nhật thông tin nhân viên
- [ ] Xóa nhân viên (nếu backend support)
- [ ] Reset password
- [ ] Filter theo role quyền
- [ ] Search theo tài khoản/tên
- [ ] Statistics hiển thị đúng

Dialog giờ đây chỉ focus vào những trường thực sự cần thiết và align hoàn toàn với backend structure!
