# Hướng dẫn Fix Lỗi Thiếu Chính Sách Khi Thêm Phiên Gửi Xe

## Vấn đề đã được giải quyết

### 1. Backend Validation (đã có sẵn)
File: `backend/api.py` - Function `themPhienGuiXe()`

```python
# Validation các trường bắt buộc
if not session.chinhSach:
    return {"success": False, "message": "Thiếu chính sách giá (chinhSach)"}
```

**Các trường được validation:**
- `uidThe` (mã thẻ)
- `chinhSach` (chính sách giá)
- `congVao` (cổng vào)
- `gioVao` (giờ vào)

### 2. Frontend Helper Function (đã thêm)
File: `frontend/src/api/api.js`

```javascript
export async function layChinhSachMacDinhChoLoaiPT(loaiXe, maLoaiPT) {
  // Logic tự động chọn chính sách theo loại phương tiện
  // Tương tự như python-example/QuanLyXe.py
}
```

**Logic:**
1. Thử lấy chính sách từ API theo mã loại phương tiện
2. Nếu không có, fallback theo loại xe từ WorkConfig:
   - `xe_may` → `CS_XEMAY_4H`
   - `oto` → `CS_OTO_4H`

### 3. Frontend Main UI (đã cập nhật)
File: `frontend/src/views/main/main_UI.jsx`

```javascript
// Import helper function
const { layChinhSachMacDinhChoLoaiPT } = await import("../../api/api")

// Lấy chính sách tự động
const pricingPolicy = await layChinhSachMacDinhChoLoaiPT(workConfig?.loai_xe, vehicleTypeCode)
```

**Thay thế logic cũ** (có thể thất bại) bằng **logic mới** (luôn có fallback).

## Cách Kiểm tra Fix

### 1. Test Backend
```bash
cd backend
python test_chinh_sach.py
```

### 2. Test Frontend
1. Mở Developer Console trong browser
2. Quét thẻ xe vào
3. Kiểm tra logs:
   ```
   🚗 Vehicle type determined: XE_MAY
   ✅ Selected pricing policy: CS_XEMAY_4H
   💾 Session data to save: {...chinhSach: "CS_XEMAY_4H"...}
   ✅ All required fields present, sending to API...
   ```

### 3. Kiểm tra Database
Sau khi thêm phiên gửi xe thành công, kiểm tra table `pm_nc0009`:
- Trường `chinhSach` không được để trống
- Các trường bắt buộc khác đều có giá trị

## Các Case Cần Test

### Case 1: WorkConfig có loại xe = "xe_may"
- **Expected:** chinhSach = "CS_XEMAY_4H"

### Case 2: WorkConfig có loại xe = "oto" 
- **Expected:** chinhSach = "CS_OTO_4H"

### Case 3: Không có WorkConfig hoặc API lỗi
- **Expected:** chinhSach = "CS_XEMAY_4H" (fallback mặc định)

### Case 4: Có chính sách từ API
- **Expected:** chinhSach = giá trị từ API (policies[0].lv001)

## Logs Để Theo dõi

### Frontend logs:
```
🔍 Đang lấy chính sách mặc định cho loại xe: xe_may, mã loại PT: XE_MAY
💰 Chính sách tìm được từ API cho XE_MAY: [...]
✅ Chọn chính sách từ API: CS_XEMAY_4H
📋 Required fields check: uidThe=1234567890, chinhSach=CS_XEMAY_4H
```

### Backend logs:
```
📤 Backend sending themPhienGuiXe payload: {...}
📋 Required fields check: uidThe=1234567890, chinhSach=CS_XEMAY_4H, congVao=GATE01, gioVao=2024-01-15 10:30:00
```

## Tương thích với Python-example

Logic này được đồng bộ với `python-example/Parking_Lot/components/QuanLyXe.py`:

```python
# Tự động xác định mã chính sách nếu chưa có
if not chinh_sach and self.ui:
    if self.ui.che_do_hien_tai == "vao":
        if self.ui.loai_xe_hien_tai == "xe_may":
            chinh_sach = "CS_XEMAY_4H"
        elif self.ui.loai_xe_hien_tai == "oto":
            chinh_sach = "CS_OTO_4H"
```

## Lỗi có thể gặp và Cách fix

### Lỗi: "Thiếu chính sách giá (chinhSach)"
**Nguyên nhân:** Helper function không hoạt động đúng
**Fix:** Kiểm tra WorkConfig và API chính sách

### Lỗi: "Thiếu mã thẻ (uidThe)"
**Nguyên nhân:** Card reader không truyền đúng dữ liệu
**Fix:** Kiểm tra DauDocThe.jsx và main_UI.jsx

### Lỗi: Network/API timeout
**Nguyên nhân:** Backend không phản hồi
**Fix:** Sử dụng fallback policy mặc định

## Kết luận

✅ **Đã fix:** Logic tự động chọn chính sách theo loại phương tiện
✅ **Đã sync:** Logic đồng bộ với python-example  
✅ **Đã validate:** Backend validation đầy đủ
✅ **Đã test:** Script test backend sẵn sàng
✅ **Đã document:** Hướng dẫn kiểm tra và debug

Hệ thống hiện tại đảm bảo luôn có chính sách phù hợp khi tạo phiên gửi xe.
