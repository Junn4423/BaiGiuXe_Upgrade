# Cập nhật Hệ thống Lưu Ảnh với Timeout và Toast Notification

## Tóm tắt thay đổi

### 1. MinIO Upload với Timeout 2 giây
- **Thời gian chờ**: Hệ thống sẽ chờ tối đa 2 giây để upload lên MinIO
- **Fallback tự động**: Nếu timeout hoặc thất bại, tự động chuyển sang lưu local
- **Đường dẫn local**: 
  - Biển số: `C:\Users\Chung\Documents\ParkingLotApp\assets\imgAnhChup\anhchup_bienso`
  - Khuôn mặt: `C:\Users\Chung\Documents\ParkingLotApp\assets\imgAnhChup\anhchup_khuonmat`

### 2. Tạo folder tự động
- Hệ thống tự động tạo các folder cần thiết nếu chưa tồn tại
- Hỗ trợ cả môi trường Electron và web browser

### 3. Toast Notification cải tiến
- **Hiển thị tuần tự**: Các thông báo không còn đè lên nhau
- **Thời gian hiển thị**: Mỗi toast hiện 1 giây như yêu cầu
- **Queue system**: Các toast được xếp hàng và hiển thị lần lượt
- **Animation mượt**: Thêm hiệu ứng fade in/out

## Files đã thay đổi

### Frontend
1. **`frontend/src/api/api.js`**
   - Thêm timeout 2 giây cho MinIO upload
   - Thêm fallback system sang local storage
   - Thêm helper functions cho timeout và local save

2. **`frontend/src/components/Toast.jsx`**
   - Cải tiến useToast hook với queue system
   - Thay đổi duration mặc định thành 1 giây
   - Thêm animation fade out mượt

3. **`frontend/src/utils/imageUtils.js`**
   - Cập nhật saveImageToAssets để sử dụng hệ thống mới
   - Tích hợp với MinIO + local fallback

4. **`frontend/src/utils/imageUploadExamples.js`**
   - Cập nhật logging để phân biệt MinIO vs local save
   - Thêm thông tin isLocal trong response

### Electron
5. **`electron-app/main.js`**
   - Thêm IPC handler `create-directory`
   - Hỗ trợ tạo folder tự động

6. **`electron-app/preload.js`**
   - Expose `createDirectory` function cho renderer

## Cách hoạt động mới

### Upload Process Flow
1. **Bước 1**: Thử upload lên MinIO với timeout 2 giây
2. **Bước 2**: Nếu thành công → trả về MinIO URL
3. **Bước 3**: Nếu timeout/thất bại → fallback sang local storage
4. **Bước 4**: Tạo folder nếu chưa tồn tại
5. **Bước 5**: Lưu file local và trả về đường dẫn local

### Toast Notification Flow
1. **Queue**: Mỗi toast được thêm vào queue
2. **Sequential**: Chỉ hiện 1 toast tại 1 thời điểm
3. **Duration**: Mỗi toast hiện 1 giây
4. **Delay**: Có khoảng cách 100ms giữa các toast

## Sử dụng

### Upload ảnh
```javascript
import { uploadLicensePlateImage } from '../api/api.js';

const result = await uploadLicensePlateImage(imageBlob);
if (result.success) {
  if (result.isLocal) {
    console.log('Saved locally:', result.localPath);
  } else {
    console.log('Uploaded to MinIO:', result.primaryUrl);
  }
}
```

### Toast notification
```javascript
import { useToast } from '../components/Toast';

const { showToast } = useToast();

// Thông báo sẽ hiển thị tuần tự, mỗi cái 1 giây
showToast('Upload thành công', 'success');
showToast('Lưu local thành công', 'info');
showToast('Có lỗi xảy ra', 'error');
```

## Lợi ích

1. **Reliability**: Luôn có backup plan khi MinIO không khả dụng
2. **Performance**: Timeout ngắn giúp UX tốt hơn
3. **User Experience**: Toast notification không còn bị chồng chéo
4. **Automatic**: Tự động tạo folder, không cần setup thủ công
5. **Flexible**: Hoạt động tốt cả trên Electron và web browser

## Cấu hình

- **MinIO Timeout**: 2 giây (có thể thay đổi trong `uploadToMinIOWithTimeout`)
- **Toast Duration**: 1 giây (có thể thay đổi khi gọi `showToast`)
- **Local Path**: `C:\Users\Chung\Documents\ParkingLotApp\assets\imgAnhChup\`
- **Queue Delay**: 100ms giữa các toast

## Testing

1. **Test MinIO timeout**: Ngắt kết nối mạng → upload sẽ fallback sang local
2. **Test toast queue**: Gọi nhiều `showToast` liên tiếp → hiển thị tuần tự
3. **Test folder creation**: Xóa folder → hệ thống tự tạo lại
4. **Test Electron vs web**: Kiểm tra trên cả hai môi trường
