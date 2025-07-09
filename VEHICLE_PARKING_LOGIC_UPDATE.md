# Cập Nhật Logic Xử Lý Xe Vào/Ra và Tính Phí

## Tổng quan thay đổi

### 1. Logic xe vào đã được cập nhật (main_UI.jsx)
- **Kiểm tra loại xe từ biển số**: Khi xe vào, hệ thống sẽ tra cứu biển số trong bảng `pm_nc0002` để lấy `maLoaiPT`, sau đó tra trong `pm_nc0001` để lấy `loaiXe` (lv004)
- **Xử lý vị trí đỗ xe**:
  - Xe nhỏ (loaiXe = 0): Không cần vị trí cụ thể, `viTriGui` = null
  - Xe lớn (loaiXe = 1): Tự động tìm slot trống trong `pm_nc0005` và cập nhật trạng thái slot

### 2. Cập nhật tính phí (api.js)
- **Chỉ tính phí cho thẻ KHACH**: 
  - Các loại thẻ khác (NHANVIEN, VETHANG, VENAM, ...) được miễn phí
  - Hàm `kiemTraTheMienPhi()` kiểm tra loại thẻ trước khi tính phí
- **Tính phí dựa trên chính sách giá**:
  - Phí cơ bản từ lv004 
  - Phí quá giờ từ lv006 nếu có

### 3. Cải thiện UI ParkingLotManagement 
- **Thiết kế hiện đại với gradient và animation**:
  - Header với gradient background
  - Card statistics với hover effects
  - Parking spots với 3D transform effects
  - Dialog với glass morphism design
- **Responsive design** cho mọi kích thước màn hình
- **Dark mode support** tự động

### 4. Các hàm API mới được thêm

```javascript
// Lấy thông tin loại xe từ biển số
layThongTinLoaiXeTuBienSo(bienSo)

// Tìm slot trống cho xe lớn
laySlotTrongChoXeLon(maKhuVuc)

// Kiểm tra thẻ miễn phí
kiemTraTheMienPhi(uidThe)

// Lấy thông tin thẻ chi tiết
layThongTinTheChiTiet(uidThe)

// Thêm phiên gửi xe với xử lý vị trí
themPhienGuiXeVoiViTri(session)
```

## Chi tiết logic xử lý

### Khi xe vào:
1. Quét thẻ RFID
2. Nhận dạng biển số
3. Tra cứu loại xe từ biển số trong database
4. Nếu là xe lớn (ô tô):
   - Tìm slot trống trong khu vực
   - Cập nhật trạng thái slot thành "đã dùng"
   - Lưu mã slot vào phiên gửi xe
5. Nếu là xe nhỏ (xe máy):
   - Không cần slot cụ thể
   - viTriGui = null

### Khi xe ra:
1. Quét thẻ RFID
2. Tìm phiên gửi xe đang hoạt động
3. Kiểm tra loại thẻ:
   - Nếu là thẻ KHACH: Tính phí theo chính sách
   - Nếu không phải thẻ KHACH: Miễn phí
4. Nếu xe lớn có vị trí đỗ:
   - Giải phóng slot (cập nhật trạng thái về "trống")
5. Cập nhật phiên gửi xe và hiển thị phí

## Lưu ý quan trọng

1. **Không sửa file PHP backend** - Mọi logic được xử lý ở frontend thông qua api.js
2. **Không thêm icon vào UI** - Giữ giao diện đơn giản
3. **Kiểm tra dữ liệu trước khi xử lý** - Đảm bảo biển số và thông tin xe tồn tại trong database

## File đã được sửa đổi

1. `/frontend/src/api/api.js` - Thêm các hàm xử lý mới
2. `/frontend/src/views/main/main_UI.jsx` - Cập nhật logic xe vào
3. `/frontend/src/assets/styles/ParkingLotManagement.css` - Làm đẹp giao diện

## Testing

Để test các tính năng mới:

1. **Test xe vào**:
   - Thử với xe đã có trong database (có loaiXe)
   - Thử với xe chưa có (mặc định xe nhỏ)
   - Kiểm tra slot được cấp cho xe lớn

2. **Test tính phí**:
   - Thử với thẻ KHACH (phải tính phí)
   - Thử với thẻ khác (miễn phí)

3. **Test UI**:
   - Xem ParkingLotManagement với các slot
   - Test responsive trên mobile
   - Test dark mode nếu có 