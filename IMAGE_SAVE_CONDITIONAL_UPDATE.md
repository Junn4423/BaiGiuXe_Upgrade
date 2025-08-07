# Cập Nhật Hệ Thống Lưu Ảnh Có Điều Kiện

## Tổng Quan
Cập nhật hệ thống để chỉ lưu ảnh vào ổ đĩa khi phiên gửi xe thành công, tránh lưu ảnh không cần thiết khi có lỗi.

## Vấn Đề Trước Đây
- Ảnh được chụp và lưu vào ổ đĩa ngay sau khi quét thẻ
- Dù phiên gửi xe thất bại, ảnh vẫn được lưu
- Tốn không gian ổ đĩa với những ảnh không có phiên gửi xe tương ứng
- Gây khó khăn trong việc quản lý dữ liệu ảnh

## Giải Pháp Mới

### 1. Chế Độ Chụp Tạm Thời (QuanLyCamera.jsx)

**Trước:**
```javascript
// Ảnh được lưu ngay vào ổ đĩa khi chụp
const assetResult = await saveImageToAssets(blob, filename, type, mode)
```

**Sau:**
```javascript
// Chỉ tạo object URL tạm thời, không lưu ổ đĩa
const objectUrl = URL.createObjectURL(blob)
return {
  url: objectUrl, // Hiển thị ngay
  blob: blob, // Lưu cho upload sau
  pendingUpload: true, // Đánh dấu chờ upload
  temporaryOnly: true // Chỉ trong bộ nhớ
}
```

### 2. Upload Có Điều Kiện (main_UI.jsx)

**Logic mới:**
```javascript
// Chỉ upload sau khi phiên gửi xe thành công
if (result && result.success) {
  // Upload ảnh vào ổ đĩa
  const uploadResults = await cameraManagerRef.current.uploadCapturedImages(plateImage, faceImage)
  
  if (uploadResults.errors.length === 0) {
    showToast('Ảnh đã được lưu vào ổ đĩa thành công', 'success')
  }
} else {
  // Phiên gửi xe thất bại - ảnh không được lưu
  console.log('⚠️ Session creation failed - images will NOT be saved to disk')
}
```

## Các Thay Đổi Code

### 1. QuanLyCamera.jsx

**captureFromVideoElement():**
- Chỉ tạo object URL cho hiển thị tức thì
- Không gọi `saveImageToAssets()` nữa
- Đánh dấu `pendingUpload: true`

**uploadCapturedImages():**
- Chỉ được gọi sau khi phiên gửi xe thành công
- Upload thực sự ảnh vào ổ đĩa
- Cập nhật trạng thái `uploaded: true`

### 2. main_UI.jsx

**Trong xử lý xe vào:**
```javascript
if (result && result.success) {
  // Upload ảnh sau khi session thành công
  await cameraManagerRef.current.uploadCapturedImages(plateImage, faceImage)
} else {
  // Thông báo ảnh không được lưu
  showToast('Ảnh không được lưu vào ổ đĩa do lỗi phiên gửi xe', 'error')
}
```

## Lợi Ích

### 1. Tiết Kiệm Không Gian
- Chỉ lưu ảnh khi thực sự cần thiết
- Không còn ảnh "rác" từ các phiên gửi xe thất bại

### 2. Tính Nhất Quán Dữ Liệu
- Mọi ảnh trong ổ đĩa đều có phiên gửi xe tương ứng
- Dễ dàng quản lý và đồng bộ dữ liệu

### 3. Thông Báo Rõ Ràng
- User biết chính xác khi nào ảnh được lưu
- Thông báo lỗi rõ ràng khi không lưu được

### 4. Performance
- Giảm I/O disk không cần thiết
- Xử lý nhanh hơn khi có lỗi

## Flow Mới

```
1. User quét thẻ
   ↓
2. Chụp ảnh → Object URL (chỉ trong RAM)
   ↓
3. Hiển thị ảnh trên UI
   ↓
4. Xử lý phiên gửi xe
   ↓
5a. THÀNH CÔNG → Upload ảnh vào ổ đĩa + Thông báo
5b. THẤT BẠI → Giải phóng RAM + Thông báo lỗi
```

## Tương Thích Ngược
- Ảnh cũ đã lưu vẫn hoạt động bình thường
- API không thay đổi interface
- UI vẫn hiển thị ảnh như cũ

## Testing

### Test Cases
1. **Xe vào thành công:** Ảnh được lưu vào ổ đĩa
2. **Xe vào thất bại:** Ảnh không được lưu, có thông báo
3. **Lỗi mạng:** Fallback xử lý graceful
4. **Thiếu thông tin:** Validation ngăn chặn lưu sai

### Kiểm Tra
```bash
# Kiểm tra thư mục ảnh trước và sau
ls -la "C:\Users\Chung\Documents\ParkingLotApp\assets\imgAnhChup\"

# Test với thẻ không hợp lệ
# → Không có ảnh mới trong thư mục

# Test với thẻ hợp lệ
# → Có ảnh mới trong thư mục
```

## Cấu Hình

### Environment Variables
```javascript
// Có thể thêm option để force save mọi ảnh (debug mode)
const FORCE_SAVE_ALL_IMAGES = process.env.REACT_APP_FORCE_SAVE_ALL === 'true'
```

### Settings UI
Có thể thêm toggle trong SystemSettings:
- ✅ "Chỉ lưu ảnh khi xe vào thành công"
- ⬜ "Lưu tất cả ảnh (bao gồm lỗi)"

## Troubleshooting

### Ảnh không hiển thị
- Kiểm tra object URL được tạo đúng
- Kiểm tra blob data có tồn tại

### Ảnh không lưu dù session thành công
- Kiểm tra `uploadCapturedImages` có được gọi
- Kiểm tra quyền ghi file

### Memory leak
- Object URLs được giải phóng sau khi dùng xong
- Blob data được clear khi không cần

## Future Enhancements

1. **Batch Upload:** Upload nhiều ảnh cùng lúc
2. **Retry Logic:** Thử lại khi upload fail
3. **Compression:** Nén ảnh trước khi lưu
4. **Cloud Backup:** Đồng bộ lên cloud storage

## Changelog

### v1.0.0 - 2025-08-07
- ✅ Implement conditional image saving
- ✅ Add memory-only capture mode
- ✅ Update upload logic in main_UI
- ✅ Add user notifications
- ✅ Update error handling

### v1.1.0 - 2025-08-07 (FIXED IMAGE DISPLAY)
- ✅ **FIXED:** Images now display immediately on capture panels after scan
- ✅ QuanLyCamera now handles image display right after capture
- ✅ Removed duplicate display logic from main_UI.jsx  
- ✅ Logic flow: Scan → Capture & Display → Session Processing → Conditional Disk Save
- ✅ Perfect balance: Images show instantly, disk save only when needed
