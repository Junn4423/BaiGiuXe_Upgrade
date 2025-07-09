# Sửa Lỗi Loại Xe Từ WorkConfig

## Vấn đề
- Khi chọn loại xe "oto nhiều chỗ" trong workConfig trước khi vào phiên làm việc
- Nhưng khi quét xe vào, hệ thống vẫn nhận diện là "xe máy" trong VehicleList
- Xe lớn không được cấp vị trí đỗ

## Nguyên nhân
1. **Logic xe vào** đang ưu tiên lấy loại xe từ biển số trong database thay vì từ workConfig
2. **VehicleListComponent** đang xác định loại xe dựa trên `chinhSach` (policy name) thay vì trường `loaiXe` từ database
3. **API payload** thiếu trường `loaiXe` khi lưu phiên gửi xe

## Các thay đổi đã thực hiện

### 1. Sửa logic xe vào (main_UI.jsx)
```javascript
// TRƯỚC: Lấy loại xe từ biển số trước
if (recognizedLicensePlate) {
  const thongTinLoaiXe = await layThongTinLoaiXeTuBienSo(recognizedLicensePlate);
  if (thongTinLoaiXe.success) {
    loaiXe = thongTinLoaiXe.loaiXe;
  }
}

// SAU: Ưu tiên workConfig trước, fallback về biển số
if (workConfig?.loai_xe) {
  if (workConfig.loai_xe === "oto") {
    loaiXe = "1"; // Xe lớn
  } else if (workConfig.loai_xe === "xe_may") {
    loaiXe = "0"; // Xe nhỏ
  }
} else if (recognizedLicensePlate) {
  // Fallback về biển số nếu không có workConfig
  const thongTinLoaiXe = await layThongTinLoaiXeTuBienSo(recognizedLicensePlate);
  if (thongTinLoaiXe.success) {
    loaiXe = thongTinLoaiXe.loaiXe;
  }
}
```

### 2. Sửa hiển thị loại xe (VehicleListComponent.jsx)
```javascript
// TRƯỚC: Xác định loại xe từ chinhSach
if (item.chinhSach.toLowerCase().includes("oto")) {
  vehicleType = "oto"
}

// SAU: Ưu tiên trường loaiXe từ database
if (item.loaiXe !== undefined && item.loaiXe !== null) {
  if (item.loaiXe === 1 || item.loaiXe === "1") {
    vehicleType = "oto"
  } else if (item.loaiXe === 0 || item.loaiXe === "0") {
    vehicleType = "xe_may"
  }
} else if (item.chinhSach) {
  // Fallback về policy name
  if (item.chinhSach.toLowerCase().includes("oto")) {
    vehicleType = "oto"
  }
}
```

### 3. Thêm loaiXe vào API payload (api.js)
```javascript
// Trong themPhienGuiXe()
const payload = {
  // ... existing fields
  loaiXe: session.loaiXe || "0", // Thêm loaiXe vào payload
};
```

### 4. Thêm debug logging
- Debug log trong VehicleListComponent để kiểm tra dữ liệu `loaiXe` từ API
- Console log trong main_UI để trace quá trình xác định loại xe

## Kết quả mong đợi
1. **Khi chọn "oto" trong workConfig**: 
   - `loaiXe = "1"` 
   - Xe được cấp vị trí đỗ từ pm_nc0005
   - Hiển thị "Ô tô" trong VehicleList

2. **Khi chọn "xe_may" trong workConfig**:
   - `loaiXe = "0"`
   - Xe không cần vị trí đỗ (viTriGui = null)
   - Hiển thị "Xe máy" trong VehicleList

3. **Fallback**: Nếu không có workConfig, hệ thống vẫn hoạt động bình thường bằng cách tra cứu từ biển số

## Cách test
1. Vào WorkConfig, chọn loại xe "oto"
2. Quét thẻ vào
3. Kiểm tra console log xem loại xe được xác định đúng
4. Kiểm tra VehicleList hiển thị "Ô tô"
5. Kiểm tra xe có được cấp vị trí đỗ không

## Thêm debug commands
```javascript
// Trong browser console:
// Kiểm tra workConfig hiện tại
console.log(window.mainUIRef?.workConfig)

// Kiểm tra dữ liệu từ API
layALLPhienGuiXe().then(data => {
  console.log('Sample data:', data.slice(0, 3).map(item => ({
    bienSo: item.bienSo,
    loaiXe: item.loaiXe,
    chinhSach: item.chinhSach
  })))
})
``` 