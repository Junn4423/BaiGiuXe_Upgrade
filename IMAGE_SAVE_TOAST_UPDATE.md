# Cập nhật Hệ thống Lưu Ảnh và Toast Notification

## Tóm tắt thay đổi

### 1. Cơ chế lưu ảnh hiện tại ✅
Hệ thống sử dụng chiến lược **MinIO + Local Fallback** với timeout 2 giây:

1. **Upload MinIO**: Thử upload lên 3 server MinIO đồng thời với timeout 2s
2. **Auto Fallback**: Nếu timeout/thất bại → tự động chuyển sang local storage  
3. **Auto Create Folders**: Tự động tạo folder nếu chưa tồn tại
4. **Path Structure**:
   - Biển số: `C:\Users\Chung\Documents\ParkingLotApp\assets\imgAnhChup\anhchup_bienso`
   - Khuôn mặt: `C:\Users\Chung\Documents\ParkingLotApp\assets\imgAnhChup\anhchup_khuonmat`

### 2. Toast Notification được sửa ✅
Đã sửa lỗi nháy liên tục và triển khai hệ thống queue:

- **Sequential Display**: Thông báo hiển thị tuần tự, không đè lên nhau
- **Duration**: Mỗi toast hiển thị đúng 1 giây như yêu cầu
- **Queue System**: Hàng đợi xử lý các toast một cách có trật tự  
- **No Infinite Loop**: Loại bỏ hoàn toàn vấn đề infinite rendering

## Chi tiết kỹ thuật

### Luồng Upload Ảnh
```javascript
1. Capture Image → Blob/File
2. uploadImageToMinIO(blob, prefix)
3. Try MinIO upload (timeout 2s)
   ├─ Success → return MinIO URLs
   └─ Timeout/Fail → fallback to local storage
4. Create folder if not exists
5. Save to local path
6. Return result with isLocal flag
```

### Toast Notification Flow
```javascript
1. showToast(message, type, duration)
2. Add to queue
3. Process queue sequentially
   ├─ Show toast (1 second)
   ├─ Hide toast
   ├─ 100ms delay
   └─ Process next
```

## Files đã cập nhật

### 1. `frontend/src/api/api.js`
- Cải thiện `saveToLocalStorage()` function
- Thêm logging chi tiết cho việc tạo folder
- Cải thiện error handling cho web browser fallback

### 2. `frontend/src/components/Toast.jsx`
- Sửa lại logic `useToast` hook
- Loại bỏ `useCallback` dependencies gây infinite loop
- Đơn giản hóa queue processing logic

## Cách sử dụng

### Upload ảnh
```javascript
import { uploadLicensePlateImage, uploadFaceImage } from '../api/api.js';

// Upload ảnh biển số
const plateResult = await uploadLicensePlateImage(plateBlob);
console.log('Upload result:', plateResult);

// Check if saved locally or uploaded to MinIO
if (plateResult.isLocal) {
  console.log('Saved locally:', plateResult.localPath);
} else {
  console.log('Uploaded to MinIO:', plateResult.primaryUrl);
}

// Upload ảnh khuôn mặt
const faceResult = await uploadFaceImage(faceBlob);
```

### Toast notification
```javascript
import { useToast } from '../components/Toast';

const { showToast, ToastContainer } = useToast();

// Các thông báo sẽ hiển thị tuần tự
showToast('Upload thành công', 'success');
showToast('Lưu local', 'info');
showToast('Có lỗi xảy ra', 'error');

// Trong component render
return (
  <div>
    {/* Your content */}
    <ToastContainer />
  </div>
);
```

## Tính năng chính

### ✅ Reliability
- MinIO timeout chỉ 2 giây → UX tốt
- Local fallback đảm bảo không mất dữ liệu
- Auto folder creation

### ✅ Performance
- Parallel upload to 3 MinIO servers
- Fast timeout prevents hanging
- Efficient queue processing

### ✅ User Experience
- Toast không còn bị đè lên nhau
- Mỗi thông báo hiển thị đúng thời gian
- Visual feedback rõ ràng

### ✅ Cross-platform
- Hoạt động tốt trên Electron
- Fallback download cho web browser
- Consistent behavior

## Configuration

### MinIO Timeout
```javascript
// In uploadImageToMinIO()
const minioResult = await uploadToMinIOWithTimeout(imageBlob, filename, 2000); // 2 seconds
```

### Toast Duration
```javascript
// Default duration
showToast('Message', 'success'); // 1 second

// Custom duration (if needed in future)
showToast('Message', 'success', 2000); // 2 seconds
```

### Local Paths
```javascript
const folderName = prefix === 'license_plate' || prefix === 'license_plate_out' 
  ? 'anhchup_bienso' 
  : 'anhchup_khuonmat';

const basePath = 'C:\\Users\\Chung\\Documents\\ParkingLotApp\\assets\\imgAnhChup';
```

## Testing & Debug Tools

### 1. Test Components
- **ToastTester**: Component để test Toast system (`/components/ToastTester.jsx`)
- **Debug Utils**: Utilities để test upload system (`/utils/debugImageSystem.js`)

### 2. Browser Console Commands
```javascript
// Check system status
window.debugImageSystem.checkSystemStatus()

// Test image upload system
await window.debugImageSystem.testImageUpload()

// Test folder creation
await window.debugImageSystem.testFolderCreation()

// Performance monitoring
await window.debugImageSystem.monitorUploadPerformance(5)
```

### 3. React Component Testing
```jsx
import ToastTester from '../components/ToastTester';

// Add to your app for testing
<ToastTester />
```

## Troubleshooting

### Toast vẫn nháy
- Check console for errors
- Verify useToast hook usage
- Ensure ToastContainer is rendered once

### Local save fails
- Check Electron permissions
- Verify paths exist
- Check disk space

### MinIO timeout
- Check network connectivity
- Verify MinIO server status
- Check upload.php configuration

## Next Steps

1. **Monitor Performance**: Track upload success rates
2. **Add Metrics**: Log MinIO vs local usage
3. **Optimize**: Consider image compression
4. **Backup Strategy**: Sync local images to MinIO later
