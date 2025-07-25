# Image Fallback System Implementation

## Tổng quan
Đã implement hệ thống fallback cho việc hiển thị ảnh từ MinIO servers. Khi server chính (192.168.1.19) không hoạt động, hệ thống sẽ tự động thử load ảnh từ các server backup (192.168.1.90, 192.168.1.94).

## Files đã thay đổi

### 1. `frontend/src/api/api.js`
**Cập nhật các hàm xử lý URL ảnh:**
- `getImageUrl()`: Giữ nguyên logic cũ (trả về URL server chính)
- `getBackupImageUrls()`: Cải tiến để trả về tất cả URLs theo thứ tự ưu tiên
- `checkImageUrl()`: Hàm mới để kiểm tra tính khả dụng của URL
- `getWorkingImageUrl()`: Hàm mới để tìm URL đầu tiên có thể load được

**Thứ tự ưu tiên servers:**
1. `192.168.1.19:9000` (Primary)
2. `192.168.1.90:9000` (Backup 1)  
3. `192.168.1.94:9000` (Backup 2)

### 2. `frontend/src/components/FallbackImage.jsx` ⭐ **MỚI**
**Component React với fallback system:**
- Tự động thử load ảnh từ tất cả servers theo thứ tự
- Hiển thị loading indicator trong quá trình thử load
- Hiển thị placeholder khi không load được ảnh nào
- Callback functions cho success/error events
- Hook `useFallbackImage` để sử dụng trong custom components

**Props:**
```jsx
<FallbackImage 
  filename="image_filename.jpg"
  alt="Alt text"
  className="css-class"
  style={{}}
  placeholder={<div>Custom placeholder</div>}
  onLoadSuccess={(url, serverIndex) => {}}
  onLoadError={(error) => {}}
  showLoadingIndicator={true}
/>
```

### 3. Components đã cập nhật để sử dụng FallbackImage:

#### `frontend/src/views/dialogs/BienSoLoiDialog.jsx`
- Thay thế tất cả `<img src={getImageUrl(filename)}>` bằng `<FallbackImage filename={filename}>`
- Thêm custom placeholders cho từng loại ảnh (xe, khuôn mặt)

#### `frontend/src/views/dialogs/CardHistoryDialog.jsx`  
- Cập nhật hiển thị ảnh trong lịch sử thẻ RFID
- Cập nhật ảnh trong chi tiết log quét thẻ
- Thêm placeholders phù hợp với kích thước ảnh

#### `frontend/src/components/LicensePlateConfirmDialog.jsx`
- Cập nhật hiển thị ảnh khuôn mặt trong dialog xác nhận biển số
- Maintain existing logic với enhanced image loading

## Cách hoạt động

### 1. Automatic Fallback Process
```
1. User request hiển thị ảnh với filename: "license_plate_2025-07-25T03-11-53-051Z.jpg"
2. FallbackImage component tạo list URLs:
   - http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-25T03-11-53-051Z.jpg
   - http://192.168.1.90:9000/parking-lot-images/license_plate_2025-07-25T03-11-53-051Z.jpg  
   - http://192.168.1.94:9000/parking-lot-images/license_plate_2025-07-25T03-11-53-051Z.jpg
3. Thử load từng URL theo thứ tự:
   - Nếu URL 1 thành công → hiển thị ảnh
   - Nếu URL 1 failed → thử URL 2 (sau 500ms delay)
   - Nếu URL 2 failed → thử URL 3 (sau 500ms delay)
   - Nếu tất cả failed → hiển thị placeholder
```

### 2. Visual States
- **Loading**: Hiển thị "📷 Loading..." hoặc custom placeholder
- **Success**: Hiển thị ảnh từ server khả dụng đầu tiên
- **Error**: Hiển thị "🚫 Không tải được ảnh" hoặc custom placeholder

### 3. Console Logging
```javascript
🔍 Trying to load image: license_plate_2025-07-25T03-11-53-051Z.jpg [array_of_urls]
🔄 Trying URL 1/3: http://192.168.1.19:9000/parking-lot-images/...
⚠️ Failed to load from: http://192.168.1.19:9000/parking-lot-images/...
🔄 Trying URL 2/3: http://192.168.1.90:9000/parking-lot-images/...
✅ Successfully loaded from: http://192.168.1.90:9000/parking-lot-images/...
```

## Lợi ích

### 1. Improved User Experience
- Không còn "broken image" khi server chính down
- Automatic retry với servers backup
- Loading states để user biết hệ thống đang xử lý

### 2. System Resilience  
- Fault tolerance cho MinIO infrastructure
- Graceful degradation khi servers không khả dụng
- Maintain functionality ngay cả khi primary server offline

### 3. Monitoring & Debugging
- Detailed console logging để tracking server health
- Success/error callbacks để implement monitoring
- Clear visual feedback về trạng thái loading

## Performance Considerations

### 1. Image Loading Optimization
- 500ms delay giữa các lần retry để tránh overwhelm network
- crossOrigin='anonymous' để support CORS
- Automatic cleanup của Image objects

### 2. Memory Management
- Proper cleanup của failed Image objects
- URL revocation để prevent memory leaks
- Efficient state management trong React components

### 3. Network Efficiency
- Sequential loading (không load parallel để tiết kiệm bandwidth)
- Timeout mechanisms để tránh hang indefinitely
- Reuse existing URLs khi possible

## Migration Guide

### Cách convert existing img tags:

**Trước:**
```jsx
<img 
  src={getImageUrl(filename)} 
  alt="Image" 
  className="my-image" 
/>
```

**Sau:**
```jsx
<FallbackImage 
  filename={filename}
  alt="Image"
  className="my-image"
  placeholder={<div>Custom loading...</div>}
/>
```

### Sử dụng hook trong custom components:
```jsx
import { useFallbackImage } from '../components/FallbackImage';

function MyComponent({ filename }) {
  const { src, loading, error } = useFallbackImage(filename);
  
  if (loading) return <div>Loading...</div>;
  if (error) return <div>Error loading image</div>;
  
  return <img src={src} alt="My image" />;
}
```

## Testing

### 1. Test Scenarios
- ✅ Server 192.168.1.19 online: Hiển thị ảnh từ server chính
- ✅ Server 192.168.1.19 offline, 192.168.1.90 online: Fallback success
- ✅ Chỉ server 192.168.1.94 online: Fallback success  
- ✅ Tất cả servers offline: Hiển thị placeholder
- ✅ Filename không tồn tại: Hiển thị placeholder

### 2. Performance Testing
- Load time comparison: fallback vs single server
- Memory usage monitoring
- Network request patterns

### 3. User Interface Testing  
- Visual feedback during loading
- Placeholder display consistency
- Responsive behavior

## Future Enhancements

### 1. Health Monitoring
- Implement health check endpoints cho MinIO servers
- Smart server prioritization based on response times
- Automatic server status dashboard

### 2. Caching Strategies
- Browser caching policies
- Service worker implementation
- CDN integration possibilities

### 3. Advanced Fallback
- Local storage cache cho recently accessed images
- Progressive image loading (thumbnail → full resolution)
- Server load balancing based on availability

## Troubleshooting

### Common Issues:
1. **CORS errors**: Ensure MinIO servers có proper CORS headers
2. **Slow loading**: Check network connectivity to backup servers
3. **Memory leaks**: Monitor browser dev tools for orphaned Image objects

### Debug Commands:
```javascript
// Test specific image
window.debugImageSystem.testImageUrl('filename.jpg')

// Check all server health
window.debugImageSystem.checkAllServers()

// Monitor performance  
window.debugImageSystem.monitorLoadTimes()
```
