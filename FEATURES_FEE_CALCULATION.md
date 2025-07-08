# Tích Hợp Tính Phí Gửi Xe trong VehicleInfoComponent

## Tổng Quan
VehicleInfoComponent đã được cập nhật để tích hợp chức năng tính phí gửi xe tự động sử dụng API `tinhPhiGuiXe` từ backend PHP.

## Tính Năng Mới

### 1. Tính Phí Tự Động
- **Kích hoạt**: Tự động tính phí khi xe ra (currentMode === "ra") và có mã phiên
- **API**: Sử dụng `tinhPhiGuiXe(maPhien)` từ file `api.js`
- **Backend**: Gọi function `tinhPhiGuiXe` trong `ngocchung.php` (table: pm_nc0008)

### 2. Giao Diện Người Dùng
- **Hiển thị mã phiên**: Thêm trường "MÃ PHIÊN" trong phần thông tin xe
- **Nút tính lại phí**: Nút "🔄" bên cạnh tiêu đề "PHÍ GỬI XE" (chỉ hiện khi ở chế độ xe ra)
- **Trạng thái loading**: Hiệu ứng loading khi đang tính phí
- **Format hiển thị**: "XX,XXX VNĐ (Xh Ym)" - bao gồm cả phí và thời gian

### 3. Phương Thức Mới trong VehicleInfoComponent

#### `calculateParkingFee(maPhien)`
```javascript
// Tính phí gửi xe cho một mã phiên
const result = await calculateParkingFee("PHIEN_001")
// Returns: { success: true/false, phi: number, tongPhut: number, message?: string }
```

#### `updateVehicleInfoWithSession(vehicleData, sessionData)`
```javascript
// Cập nhật thông tin xe kèm theo dữ liệu phiên
updateVehicleInfoWithSession(
  { ma_the: "THE001", trang_thai: "Trong bãi" },
  { maPhien: "PHIEN_001", sessionId: "SESSION_001" }
)
```

#### `triggerFeeCalculation()`
```javascript
// Kích hoạt tính phí thủ công (được gọi khi click nút 🔄)
await triggerFeeCalculation()
```

## Logic Tính Phí (Backend)

### API Call Flow
1. **Frontend**: `tinhPhiGuiXe(maPhien)` → `api.js`
2. **API**: `callApiWithAuth({ table: "pm_nc0008", func: "tinhPhiGuiXe", maPhien })`
3. **Backend**: `ngocchung.php` → case "pm_nc0008" → func "tinhPhiGuiXe"

### Backend Logic (`ngocchung.php`)
```php
case "tinhPhiGuiXe":
    // 1. Lấy thông tin phiên gửi xe từ pm_nc0009
    $phienQuery = "SELECT p.lv001, p.lv005, p.lv010, p.lv008, p.lv009
                   FROM pm_nc0009 p WHERE p.lv001 = '$maPhien'";
    
    // 2. Lấy chính sách giá từ pm_nc0008
    $csQuery = "SELECT * FROM pm_nc0008 WHERE lv001 = '{$phien['lv005']}'";
    
    // 3. Tính phí dựa trên thời gian và chính sách
    $phi = (float)$chinhSach['lv004']; // Phí cơ bản
    $thoiGianCoBan = (int)$chinhSach['lv003']; // Thời gian cơ bản (phút)
    $coTinhPhiQuaGio = (int)$chinhSach['lv005']; // Có tính phí quá giờ?
    $donGiaQuaGioBlock = (float)$chinhSach['lv006']; // Đơn giá cho mỗi block quá giờ
    
    // 4. Nếu quá giờ và có cấu hình phí quá giờ
    if ($coTinhPhiQuaGio == 1 && $tongPhut > $thoiGianCoBan) {
        $phutQuaGio = $tongPhut - $thoiGianCoBan;
        $soBlockQuaGio = ceil($phutQuaGio / $thoiGianCoBan); 
        $phi += $soBlockQuaGio * $donGiaQuaGioBlock;
    }
    
    // 5. Cập nhật phí vào database
    $updateQuery = "UPDATE pm_nc0009 SET lv013 = $phi WHERE lv001 = '$maPhien'";
```

### Database Schema
- **pm_nc0009** (Phiên gửi xe):
  - `lv001`: Mã phiên (Primary Key)
  - `lv005`: Mã chính sách giá 
  - `lv010`: Tổng thời gian (phút)
  - `lv013`: Phí gửi xe (được cập nhật bởi API)

- **pm_nc0008** (Chính sách giá):
  - `lv001`: Mã chính sách (Primary Key)
  - `lv003`: Thời gian cơ bản (phút)
  - `lv004`: Phí cơ bản (VNĐ)
  - `lv005`: Có tính phí quá giờ (0/1)
  - `lv006`: Đơn giá quá giờ cho mỗi block (VNĐ)

## Cách Sử Dụng

### 1. Tích Hợp với VehicleManager
```javascript
// Trong VehicleManager, đảm bảo truyền mã phiên khi cập nhật UI
const vehicleData = {
  ma_the: cardId,
  ma_phien: session.maPhien, // ← Quan trọng!
  bien_so: licensePlate,
  trang_thai: "Trong bãi"
}
this.ui.updateVehicleInfo(vehicleData)
```

### 2. Tích Hợp với main_UI.jsx
```javascript
// Khi xe ra, truyền mã phiên để tự động tính phí
vehicleInfoComponentRef.current.updateVehicleInfo({
  ma_the: cardId,
  ma_phien: activeSession.maPhien, // ← Để tự động tính phí
  trang_thai: "Xe đã ra khỏi bãi"
})
```

### 3. Sử Dụng Phương Thức Ref
```javascript
// Tính phí thủ công
if (vehicleInfoComponentRef.current) {
  const result = await vehicleInfoComponentRef.current.calculateParkingFee("PHIEN_001")
  if (result.success) {
    console.log(`Phí: ${result.phi} VNĐ`)
  }
}

// Kích hoạt tính phí từ UI  
vehicleInfoComponentRef.current.triggerFeeCalculation()
```

## Testing

### 1. Browser Console Testing
```javascript
// Load test functions
// (sẽ được load tự động từ testFeeCalculation.js)

// Test với một mã phiên
await testFeeCalculation("PHIEN_001")

// Test với nhiều mã phiên
await testMultipleFeeCalculations(["PHIEN_001", "PHIEN_002", "PHIEN_003"])

// Test tích hợp với component
await testVehicleInfoComponentFeeCalculation()
```

### 2. Manual Testing
1. Chạy ứng dụng và chuyển về chế độ "XE RA"
2. Quét thẻ xe có phiên gửi xe đang hoạt động
3. Quan sát:
   - Mã phiên xuất hiện trong thông tin xe
   - Phí được tự động tính và hiển thị
   - Nút "🔄" xuất hiện bên cạnh "PHÍ GỬI XE"
4. Click nút "🔄" để tính lại phí

## CSS Classes Mới

### `.fee-calculate-btn`
```css
.fee-calculate-btn {
  background: rgba(251, 191, 36, 0.2);
  border: 1px solid rgba(251, 191, 36, 0.3);
  border-radius: 6px;
  padding: 4px 8px;
  color: #fbbf24;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
}
```

### `.fee-amount.calculating`
```css
.fee-amount.calculating {
  color: #f59e0b;
  animation: pulse-calculating 1.5s ease-in-out infinite;
}
```

### `.vehicle-value.session-id`
```css
.vehicle-value.session-id {
  color: #3b82f6;
  font-family: 'Courier New', monospace;
  font-weight: 600;
}
```

## Lưu Ý

### 1. Error Handling
- Component xử lý lỗi API và hiển thị thông báo lỗi thay vì phí
- Timeout protection: không gọi API liên tục nếu đang processing
- Fallback values khi thiếu dữ liệu

### 2. Performance
- Chỉ tính phí khi thực sự cần (chế độ xe ra + có mã phiên)
- Cache result trong session để tránh gọi API lặp lại không cần thiết
- Loading states để UX tốt hơn

### 3. Compatibility
- Giữ nguyên tất cả API cũ để không breaking changes
- Thêm methods mới thông qua `useImperativeHandle`
- CSS responsive cho mobile

## Files Đã Thay Đổi

1. **VehicleInfoComponent.jsx**: Logic tính phí chính
2. **VehicleInfoComponent.css**: Styles cho UI mới
3. **main_UI.jsx**: Truyền mã phiên khi cập nhật thông tin xe
4. **VehicleManager.js**: Bao gồm mã phiên trong vehicle data
5. **testFeeCalculation.js**: Functions để test chức năng mới

## API Dependencies

### Required
- `tinhPhiGuiXe(maPhien)` từ `api.js`
- Backend PHP: `ngocchung.php` case "pm_nc0008" func "tinhPhiGuiXe"

### Database Tables
- `pm_nc0009`: Phiên gửi xe (đọc thông tin, cập nhật phí)
- `pm_nc0008`: Chính sách giá (đọc để tính phí)
