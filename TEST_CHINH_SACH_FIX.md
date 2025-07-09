# Test Fix Chính Sách Giá Không Đúng

## Vấn đề
Phần mã chính sách giá (lv005) của bảng pm_nc0009 đang không lưu đúng chính sách của thẻ được sử dụng để quét vào. Hiện tại quét thẻ nào cũng ra chính sách CS_XEMAY_4H.

## Nguyên nhân
- Hệ thống đang ưu tiên sử dụng chính sách từ workConfig (loại xe trong cấu hình làm việc) thay vì chính sách đã được gán cho từng thẻ
- Logic fallback luôn trả về CS_XEMAY_4H khi không xác định được chính sách

## Giải pháp đã áp dụng
Sửa logic trong `main_UI.jsx` để:

1. **Ưu tiên chính sách từ thẻ**: Khi quét thẻ vào, hệ thống sẽ lấy chính sách từ trường `maChinhSach` (lv006) trong bảng `pm_nc0003`
2. **Fallback an toàn**: Chỉ khi thẻ chưa có chính sách gán sẵn thì mới sử dụng logic cũ dựa trên loại xe từ workConfig

## Code Changes

### File: `frontend/src/views/main/main_UI.jsx`
```javascript
// B1: Lấy thông tin thẻ để kiểm tra chính sách đã gán
let pricingPolicy = null;
try {
  const cardList = await layDanhSachThe();
  const currentCard = cardList.find(card => card.uidThe === cardId);
  
  if (currentCard && currentCard.maChinhSach && currentCard.maChinhSach.trim() !== '') {
    // Ưu tiên sử dụng chính sách đã gán cho thẻ
    pricingPolicy = currentCard.maChinhSach.trim();
    console.log(`🎯 Sử dụng chính sách từ thẻ: ${pricingPolicy}`);
  } else {
    console.log(`⚠️ Thẻ ${cardId} chưa có chính sách gán sẵn, sử dụng fallback`);
  }
} catch (cardError) {
  console.error("Lỗi khi lấy thông tin thẻ:", cardError);
}

// B2: Nếu thẻ chưa có chính sách, sử dụng logic cũ (fallback)
if (!pricingPolicy) {
  // ... existing logic
}
```

## Testing

### Test case 1: Thẻ có chính sách gán sẵn
```sql
-- Ví dụ thẻ từ database
('04042003', '', 1, '2025-07-02', '44B4423', 'CS_OT_2NAM', '0000-00-00')
('8888888', 'VIP', 1, '2025-07-01', '82B433333', 'CS_OT_3Th', '2025-09-29')
```
**Kết quả mong đợi**: Quét thẻ 04042003 → chính sách CS_OT_2NAM

### Test case 2: Thẻ chưa có chính sách
```sql
-- Ví dụ thẻ từ database  
('0000000', 'KHACH', 1, '2025-07-01', '', '', '0000-00-00')
```
**Kết quả mong đợi**: Sử dụng fallback dựa trên workConfig

## Database Schema Reference

### pm_nc0003 (Thẻ RFID)
- `lv006`: Mã chính sách giá (FK → pm_nc0008.lv001)

### pm_nc0009 (Phiên gửi xe)  
- `lv005`: Mã chính sách giá (FK → pm_nc0008.lv001) - field bị lưu sai

## Expected Impact
- Thẻ VIP sẽ sử dụng đúng chính sách ô tô thay vì xe máy
- Thẻ có chính sách đặc biệt sẽ sử dụng đúng chính sách đã được cấu hình
- Fallback vẫn hoạt động cho các thẻ chưa được cấu hình chính sách
