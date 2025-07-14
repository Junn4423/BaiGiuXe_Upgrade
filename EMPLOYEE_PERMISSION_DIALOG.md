# Dialog Quản Lý Phân Quyền Nhân Viên

## Tổng quan

Dialog `EmployeePermissionDialog` được thiết kế để quản lý thông tin và phân quyền nhân viên trong hệ thống bãi xe. Dialog này tương tác với bảng `lv_lv0007` trong cơ sở dữ liệu.

## Cấu trúc bảng lv_lv0007

| Trường | Mô tả | Loại dữ liệu | Ghi chú |
|--------|-------|-------------|---------|
| lv001 | Mã người dùng (Primary Key) | VARCHAR | Duy nhất |
| lv002 | Mã nhóm quyền | VARCHAR | 1=Admin, 2=Manager, 3=Cashier, 4=Guard, 5=Staff |
| lv003 | Tên | VARCHAR | Bắt buộc |
| lv004 | Họ | VARCHAR | Tùy chọn |
| lv005 | Mật khẩu | VARCHAR | MD5 hash |
| lv006 | Mã nhân viên | VARCHAR | Bắt buộc |
| lv095 | Trạng thái hoạt động | VARCHAR | 1=Active, 0=Inactive |
| lv097 | Token đăng nhập | VARCHAR | Auto generated |
| lv099 | Giao diện | VARCHAR | default, dark, light, blue |
| lv900 | Ghi chú | TEXT | Tùy chọn |

## Tính năng chính

### 1. Hiển thị danh sách nhân viên
- Hiển thị tất cả nhân viên với thông tin cơ bản
- Hiển thị badge nhóm quyền và trạng thái
- Hỗ trợ tìm kiếm theo tên, ID, mã nhân viên
- Lọc theo nhóm quyền và trạng thái

### 2. Quản lý thông tin nhân viên
- **Thêm mới nhân viên**: Tạo tài khoản mới với đầy đủ thông tin
- **Chỉnh sửa thông tin**: Cập nhật thông tin cá nhân và quyền hạn
- **Xóa nhân viên**: Xóa tài khoản khỏi hệ thống
- **Đặt lại mật khẩu**: Reset mật khẩu cho nhân viên

### 3. Phân quyền hệ thống
Hệ thống hỗ trợ 5 cấp độ quyền hạn:

| Cấp độ | Tên | Mô tả | Quyền hạn |
|--------|-----|-------|-----------|
| 1 | Quản trị viên | Toàn quyền hệ thống | Tất cả tính năng |
| 2 | Quản lý | Quản lý bãi xe và nhân viên | Cấu hình, báo cáo, quản lý |
| 3 | Thu ngân | Thu phí và thống kê | Thu phí, xem báo cáo |
| 4 | Bảo vệ | Kiểm soát ra vào | Điều khiển cổng, camera |
| 5 | Nhân viên | Quyền cơ bản | Xem thông tin cơ bản |

### 4. Thống kê tổng quan
- Tổng số nhân viên
- Số nhân viên đang hoạt động
- Số quản trị viên
- Kết quả lọc hiện tại

## Cách sử dụng

### Import Dialog
```jsx
import EmployeePermissionDialog from './dialogs/EmployeePermissionDialog'
```

### Sử dụng trong component
```jsx
const [showEmployeeDialog, setShowEmployeeDialog] = useState(false)

// Hiển thị dialog
<button onClick={() => setShowEmployeeDialog(true)}>
  Quản lý nhân viên
</button>

// Render dialog
{showEmployeeDialog && (
  <EmployeePermissionDialog 
    onClose={() => setShowEmployeeDialog(false)}
  />
)}
```

## API Functions

Dialog sử dụng các hàm API sau từ `api.js`:

### 1. layDanhSachNhanVien()
```javascript
// Lấy danh sách tất cả nhân viên
const employees = await layDanhSachNhanVien()
```

### 2. themNhanVien(nhanVien)
```javascript
// Thêm nhân viên mới
const newEmployee = {
  lv001: "user001",
  lv002: "3", // Thu ngân
  lv003: "Nguyễn Văn",
  lv004: "A",
  lv005: "password123",
  lv006: "NV001",
  lv095: "1", // Active
  lv099: "default",
  lv900: "Ghi chú"
}
await themNhanVien(newEmployee)
```

### 3. capNhatNhanVien(nhanVien)
```javascript
// Cập nhật thông tin nhân viên
const updatedEmployee = {
  lv001: "user001",
  lv002: "2", // Thay đổi thành Manager
  lv003: "Nguyễn Văn",
  lv004: "A",
  lv006: "NV001",
  lv095: "1",
  lv099: "dark",
  lv900: "Cập nhật ghi chú"
  // lv005 có thể bỏ qua nếu không đổi mật khẩu
}
await capNhatNhanVien(updatedEmployee)
```

### 4. xoaNhanVien(userId)
```javascript
// Xóa nhân viên
await xoaNhanVien("user001")
```

### 5. datLaiMatKhauNhanVien(userId, newPassword)
```javascript
// Đặt lại mật khẩu
await datLaiMatKhauNhanVien("user001", "newPassword123")
```

### 6. thayDoiTrangThaiNhanVien(userId, status)
```javascript
// Khóa/mở khóa tài khoản
await thayDoiTrangThaiNhanVien("user001", "0") // Khóa
await thayDoiTrangThaiNhanVien("user001", "1") // Mở khóa
```

## Validation Rules

### Trường bắt buộc
- **lv001** (Mã người dùng): Không được trống, duy nhất
- **lv003** (Tên): Không được trống
- **lv006** (Mã nhân viên): Không được trống
- **lv005** (Mật khẩu): Bắt buộc khi tạo mới
- **lv002** (Nhóm quyền): Phải chọn

### Quy tắc khác
- Mã người dùng không thể thay đổi sau khi tạo
- Mật khẩu sẽ được mã hóa MD5 trên server
- Trạng thái mặc định là "Hoạt động" (lv095 = "1")
- Giao diện mặc định là "default" (lv099 = "default")

## Responsive Design

Dialog được thiết kế responsive:
- **Desktop**: Layout 2 cột (danh sách + chi tiết)
- **Tablet/Mobile**: Layout 1 cột (chuyển đổi giữa danh sách và chi tiết)

## Security Considerations

1. **Mật khẩu**: Không hiển thị mật khẩu hiện tại, chỉ cho phép đặt mới
2. **Token**: Token đăng nhập được tự động tạo và quản lý
3. **Validation**: Kiểm tra dữ liệu ở cả client và server
4. **Authorization**: Chỉ admin mới có quyền truy cập dialog này

## Error Handling

Dialog xử lý các loại lỗi sau:
- Lỗi kết nối API
- Lỗi validation dữ liệu
- Lỗi trùng lặp mã người dùng
- Lỗi quyền truy cập

## Styling

Dialog sử dụng CSS-in-JS với styled-jsx để đảm bảo:
- Tính đóng gói (encapsulation)
- Responsive design
- Theme consistency
- Accessibility

## Future Enhancements

Các tính năng có thể mở rộng:
1. Import/Export danh sách nhân viên
2. Lịch sử thay đổi quyền hạn
3. Thiết lập quyền chi tiết theo từng tính năng
4. Tích hợp với hệ thống Active Directory
5. Two-factor authentication
