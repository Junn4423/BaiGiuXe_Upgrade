# Hệ thống Background Upload với Left Toast

## Tóm tắt cập nhật

### 🚀 Tính năng mới
1. **Background Upload Service**: Upload MinIO trong background sau khi fallback local
2. **Left Toast Notifications**: Thông báo riêng ở góc trái cho background uploads
3. **Automatic Database Update**: Tự động cập nhật database khi background upload thành công
4. **Sequential Toast System**: Toast hiển thị tuần tự, không đè lên nhau

### 🔧 Cách hoạt động

#### Luồng xử lý khi upload ảnh:
```
1. Capture Image (plate/face)
2. Try MinIO upload (timeout 2s)
   ├─ Success → return MinIO URLs
   └─ Timeout/Fail → fallback to local + add to background queue
3. Continue vehicle entry/exit process normally
4. Background service retry MinIO upload
5. Show left toast when background upload succeeds/fails
6. Auto update database with MinIO URLs
```

### 📁 Files đã tạo/cập nhật

#### Tạo mới:
- `frontend/src/services/backgroundUploadService.js` - Service quản lý background upload
- `frontend/src/components/LeftToast.jsx` - Toast component ở góc trái
- `frontend/src/components/BackgroundUploadManager.jsx` - Component tích hợp

#### Cập nhật:
- `frontend/src/api/api.js` - Thêm support cho background upload với session context
- `frontend/src/components/Toast.jsx` - Sửa lỗi nháy liên tục
- `frontend/src/views/main/main_UI.jsx` - Tích hợp BackgroundUploadManager

### 🎯 Cách sử dụng

#### Upload với session context (có thể update database):
```javascript
// Vehicle entry
const plateResult = await uploadLicensePlateImage(plateBlob, {
  sessionId: 'PM2025001',
  // updateType sẽ auto set thành 'plate_in'
});

const faceResult = await uploadFaceImage(faceBlob, {
  sessionId: 'PM2025001',
  updateType: 'face_in'
});

// Vehicle exit  
const exitPlateResult = await uploadLicensePlateOutImage(plateBlob, {
  sessionId: 'PM2025001',
  // updateType sẽ auto set thành 'plate_out'
});

const exitFaceResult = await uploadFaceImage(faceBlob, {
  sessionId: 'PM2025001',
  updateType: 'face_out'
});
```

#### Upload thông thường (không cần update database):
```javascript
// Vẫn hoạt động như cũ
const result = await uploadLicensePlateImage(plateBlob);
```

### 🎨 UI/UX Improvements

#### Left Toast Examples:
- ✅ "Upload thành công: Ảnh biển số vào" (3s, green)
- ❌ "Upload thất bại: Ảnh khuôn mặt (3 lần thử)" (4s, red)  
- 📤 "Đang upload: Ảnh biển số ra" (info, blue)

#### Right Toast (main flow) Examples:
- ✅ "Xe vào thành công!" (1s, green)
- ⚠️ "Fallback local storage" (1s, warning)
- ❌ "Lỗi xử lý xe ra" (1s, red)

### 🔄 Background Service Features

#### Smart Retry Logic:
- **Max retries**: 3 lần
- **Backoff**: 10s, 20s, 30s (exponential)
- **Timeout**: 30s cho background upload (dài hơn main flow)

#### Automatic Cleanup:
- Queue cleanup mỗi 60 giây
- Remove completed/failed items
- Memory management

#### Debug Panel (development only):
```
Background Upload
Processing: ✅
Queue: 2
Pending: 1  
Retrying: 1
```

### 📊 Database Auto-Update

Khi background upload thành công, hệ thống tự động cập nhật:

```sql
-- Vehicle entry
UPDATE pm_nc0009 SET anhVao = 'http://minio.../plate.jpg' WHERE maPhien = 'PM2025001';
UPDATE pm_nc0009 SET anhMatVao = 'http://minio.../face.jpg' WHERE maPhien = 'PM2025001';

-- Vehicle exit  
UPDATE pm_nc0009 SET anhRa = 'http://minio.../plate_out.jpg' WHERE maPhien = 'PM2025001';
UPDATE pm_nc0009 SET anhMatRa = 'http://minio.../face_out.jpg' WHERE maPhien = 'PM2025001';
```

### 🛠️ Technical Details

#### Background Upload Service:
- **Singleton pattern**: Một instance duy nhất
- **Event-driven**: Callback system cho success/error
- **Configurable**: Retry count, timeout, delay
- **Safe**: Không fail main flow nếu background service lỗi

#### Toast Queue System:
- **Sequential processing**: Một toast mỗi lần
- **Configurable duration**: Default 1s (main), 3s (left)
- **Animation**: Smooth slide in/out
- **Position separation**: Right (main), Left (background)

### 🚦 Flow Examples

#### Scenario 1: MinIO hoạt động tốt
```
1. User scans card
2. Capture images
3. Upload to MinIO (success < 2s)
4. Continue vehicle entry
5. Save session with MinIO URLs
6. Show "Xe vào thành công!" toast
```

#### Scenario 2: MinIO timeout → Background upload success
```
1. User scans card  
2. Capture images
3. Try MinIO upload (timeout after 2s)
4. Fallback to local storage
5. Add to background queue
6. Continue vehicle entry with local paths
7. Show "Xe vào thành công!" toast
8. [Background] Retry MinIO upload (success)
9. [Background] Update database with MinIO URLs  
10. Show left toast "Upload thành công: Ảnh biển số vào"
```

#### Scenario 3: MinIO timeout → Background upload failed
```
1-7. Same as scenario 2
8. [Background] Retry MinIO upload (fail 3 times)
9. Show left toast "Upload thất bại: Ảnh biển số vào (3 lần thử)"
10. Local storage remains as backup
```

### 🎛️ Configuration

#### Background Service Settings:
```javascript
// In backgroundUploadService.js
maxRetries: 3           // Max retry attempts
retryDelay: 10000       // Base delay between retries (ms)
timeoutMs: 30000        // Upload timeout (ms)
cleanupInterval: 60000  // Queue cleanup interval (ms)
```

#### Toast Settings:
```javascript
// Main toast (right)
duration: 1000          // 1 second

// Left toast (background)  
successDuration: 3000   // 3 seconds
errorDuration: 4000     // 4 seconds
```

### 💡 Benefits

1. **Improved UX**: Không block main flow khi MinIO chậm
2. **Reliability**: Luôn có backup plan (local → MinIO)
3. **Transparency**: User biết được background upload status
4. **Data Integrity**: Auto update database khi MinIO sẵn sàng
5. **Performance**: Main flow nhanh, background xử lý retry
6. **User-friendly**: Toast notifications không confusing

### 🧪 Testing

#### Test Cases:
1. **Normal flow**: MinIO hoạt động tốt
2. **Timeout flow**: MinIO chậm → fallback → background success
3. **Complete failure**: MinIO down → fallback → background fail  
4. **Mixed scenarios**: Một số ảnh MinIO, một số local
5. **Toast queue**: Multiple rapid uploads

#### Debug Commands:
```javascript
// In browser console
window.debugImageSystem.testImageUpload()           // Test upload system
backgroundUploadService.getStatus()                 // Check queue status
backgroundUploadService.clearCompleted()            // Manual cleanup
```

### 🔮 Future Enhancements

1. **Progress tracking**: Show upload progress in left toast
2. **Batch operations**: Group multiple background uploads
3. **Network detection**: Pause/resume based on connection
4. **Storage quotas**: Monitor local storage usage
5. **Analytics**: Track success rates, performance metrics
