# Debug Guide: Lỗi "Thiếu Chính Sách" (Missing Policy)

## Mô tả lỗi
Khi quét thẻ để tạo phiên gửi xe, hệ thống báo lỗi "thiếu chính sách" (missing policy).

## Nguyên nhân có thể
1. **API không trả về chính sách**: Hàm `layChinhSachGiaTheoLoaiPT()` không tìm được chính sách từ backend
2. **Work Config thiếu**: `workConfig.loai_xe` không được cấu hình đúng
3. **Mapping sai**: Vehicle type mapping không đúng (`xe_may` → `XE_MAY`, `oto` → `OT`)
4. **Fallback logic lỗi**: Logic fallback không hoạt động

## Các bước debug

### 1. Kiểm tra logs trong browser console
Mở Developer Tools (F12) và xem console khi quét thẻ. Tìm các log sau:

```
🔍 Đang lấy chính sách mặc định cho loại xe: xe_may, mã loại PT: XE_MAY
🌐 Đang gọi API để lấy chính sách cho XE_MAY...
💰 Chính sách tìm được từ API cho XE_MAY: [...]
✅ Chọn chính sách từ API: CS_XEMAY_4H
```

### 2. Kiểm tra Work Config
Xem giá trị của `workConfig`:
```javascript
// Trong console browser
console.log("Work Config:", JSON.parse(localStorage.getItem('workConfig')));
```

### 3. Test hàm pricing policy
Chạy debug script:
```javascript
// Load và chạy test script
import('./src/utils/debugPricingPolicy.js');
window.testPricingPolicy.runAllTests();
```

### 4. Kiểm tra session data trước khi gửi
Tìm log sau trong console:
```
🔍 DEBUGGING SESSION DATA:
  - uidThe: "12345" (type: string)
  - chinhSach: "CS_XEMAY_4H" (type: string)  <-- Phải có giá trị
  - congVao: "GATE01" (type: string)
  - gioVao: "2024-01-01 12:00:00" (type: string)
```

## Các bước khắc phục

### 1. Đảm bảo Work Config được cấu hình
```javascript
// Cấu hình trong StartupDialog
const workConfig = {
  loai_xe: "xe_may", // hoặc "oto"
  // ... các config khác
};
localStorage.setItem('workConfig', JSON.stringify(workConfig));
```

### 2. Kiểm tra Pricing Policy trong hệ thống
- Vào menu "Quản lý chính sách giá"
- Đảm bảo có ít nhất một chính sách cho mỗi loại xe
- Mã chính sách thường là: `CS_XEMAY_4H`, `CS_OTO_4H`

### 3. Kiểm tra backend API
Test API endpoint:
```bash
curl -X POST "http://192.168.1.94/parkinglot/services.sof.vn/index.php" \
-H "Content-Type: application/json" \
-d '{
  "table": "pm_nc0008",
  "func": "layChinhSachTuPT", 
  "maLoaiPT": "XE_MAY"
}'
```

### 4. Force fallback policy (emergency fix)
Nếu cần sửa nhanh, có thể hardcode fallback:
```javascript
// Trong layChinhSachMacDinhChoLoaiPT()
// Thêm dòng này ở đầu hàm
return "CS_XEMAY_4H"; // Emergency fallback
```

## Code locations để kiểm tra

### Frontend
- `frontend/src/api/api.js` - Hàm `layChinhSachMacDinhChoLoaiPT()`
- `frontend/src/views/main/main_UI.jsx` - Logic tạo session data
- `frontend/src/utils/debugPricingPolicy.js` - Test script

### Backend  
- `backend/api.py` - Validation logic cho `themPhienGuiXe()`
- Backend endpoint cho `layChinhSachTuPT`

## Cấu trúc dữ liệu

### Work Config
```javascript
{
  "loai_xe": "xe_may", // "xe_may" hoặc "oto"
  "entry_gate": "GATE01",
  "parking_spot": "A01",
  // ...
}
```

### Vehicle Type Mapping
```javascript
const vehicleTypeMapping = {
  "xe_may": "XE_MAY",
  "oto": "OT"
}
```

### Fallback Policies
- Xe máy: `CS_XEMAY_4H`
- Ô tô: `CS_OTO_4H`

## Validation checks đã thêm

1. **Trong helper function**: Kiểm tra API response và fallback
2. **Trong main_UI.jsx**: Validation pricing policy trước khi tạo session
3. **Trong session data**: Final safety check trước khi gửi
4. **Enhanced logging**: Chi tiết debug info

## Nếu vẫn lỗi

1. Kiểm tra network requests trong DevTools
2. Xem backend logs nếu có access
3. Test với hardcoded policy để isolate vấn đề
4. Kiểm tra database có pricing policies không

## Test cases coverage
- Normal case: có work config và API trả về policy
- API fail: API không trả về, dùng fallback
- No work config: dùng default mapping
- All null/empty: dùng absolute fallback
- Mixed cases: một số field null, một số có giá trị
