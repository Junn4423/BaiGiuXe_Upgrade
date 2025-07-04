# VEHICLE TYPE REFACTOR SUMMARY

## Mục tiêu

Sửa logic phân loại loại xe (xe máy/ô tô) dựa trên cấu hình ban đầu hoặc dialog cấu hình, không dựa vào policy string. Phân loại xe chỉ để xác định có cần vị trí gửi hay không (nhiều bánh = cần, ít bánh = không cần). Bỏ hết giá trị mặc định (default), nếu không có thì để null.

## Thay đổi thực hiện

### 1. main_UI.jsx

- **Loại bỏ default value cho vehicleTypeCode**: Thay vì default "XE_MAY", nếu không có config thì để null
- **Cải thiện logic lấy pricing policy**: Chỉ lấy khi có vehicleTypeCode, không có thì throw error yêu cầu cấu hình
- **Loại bỏ emergency fallback**: Không dùng fallback policy, bắt buộc phải có cấu hình
- **Sửa logic lấy entry gate**: Ưu tiên từ zoneInfo, sau đó workConfig, cuối cùng mới từ API. Nếu không có thì để null
- **Sửa logic parking spot**: Chỉ lấy khi loaiXe = "1" (ô tô), xe máy thì để null
- **Sửa logic camera ID**: Lấy từ zoneInfo, nếu không có thì để null
- **Loại bỏ finalParkingSpot**: Sử dụng trực tiếp parkingSpot
- **Sửa processVehicleExit**: Loại bỏ default values cho exitGate, exitCameraId

### 2. VehicleManager.js

- **Sửa processVehicleEntry**: Lấy loaiXe từ cấu hình, không fallback về currentVehicleType
- **Loại bỏ default values**: Các field như chinhSach, congVao, camera_id nếu không có thì để null
- **Cải thiện logic hiển thị UI**: Dùng loaiXe để xác định vehicleTypeDisplay, fallback chỉ khi cần thiết
- **Sửa processVehicleExit**: Loại bỏ default values cho exitGate, cameraId

### 3. api.js

- **Sửa themPhienGuiXe**: Kiểm tra loaiXe chính xác hơn (cả string và number), chỉ thêm viTriGui khi loaiXe = 1 VÀ có dữ liệu
- **Sửa themLoaiPhuongTien**: Loại bỏ default value cho loaiXe, bắt buộc phải cung cấp

## Logic phân loại xe mới

### Nguồn dữ liệu loại xe:

1. **workConfig.loai_xe** (từ cấu hình ban đầu)
2. **Dialog cấu hình** (khi user thay đổi)
3. **KHÔNG dùng policy string** để phân loại xe

### Mapping loại xe:

- **workConfig.loai_xe = "xe_may"** → vehicleTypeCode = "XE_MAY" → loaiXe = "0"
- **workConfig.loai_xe = "oto"** → vehicleTypeCode = "OT" → loaiXe = "1"

### Logic vị trí gửi:

- **loaiXe = "0"** (xe máy): Không cần vị trí gửi → viTriGui = null
- **loaiXe = "1"** (ô tô): Cần vị trí gửi → viTriGui = parkingSpot (nếu có)

### Logic cổng/camera:

- **Ưu tiên**: zoneInfo từ API `layDanhSachKhu`
- **Fallback**: workConfig
- **Cuối cùng**: API `layDanhSachCong`
- **Nếu không có**: null (không dùng default)

## Lỗi có thể xảy ra và cách xử lý

### 1. Chưa cấu hình loại xe

- **Lỗi**: "Chưa cấu hình loại xe. Vui lòng mở Cấu Hình Làm Việc và chọn loại xe."
- **Giải pháp**: Người dùng phải mở dialog WorkConfig và chọn loại xe

### 2. Chưa cấu hình chính sách giá

- **Lỗi**: "Chưa cấu hình chính sách giá. Vui lòng kiểm tra Cấu Hình Làm Việc."
- **Giải pháp**: Kiểm tra API `layChinhSachGiaTheoLoaiPT` có trả về đúng không

### 3. Không có cổng/camera

- **Xử lý**: Để null, không dùng default value
- **API sẽ nhận null**: Backend cần xử lý trường hợp này

## Kiểm tra hoạt động

### Test cases:

1. **Xe máy vào**: loaiXe = "0", không có viTriGui, có congVao/camera từ zoneInfo
2. **Ô tô vào**: loaiXe = "1", có viTriGui, có congVao/camera từ zoneInfo
3. **Xe ra**: sử dụng congRa/camera từ zoneInfo
4. **Không có cấu hình**: Hiển thị lỗi yêu cầu cấu hình
5. **Không có zone info**: Sử dụng workConfig hoặc để null

### Debug logs:

- Tất cả các hàm đều có console.log để debug
- Kiểm tra loaiXe, vehicleTypeCode, zoneInfo
- Kiểm tra payload gửi lên API

## Tương thích ngược

### Với code cũ:

- Vẫn hỗ trợ fallback trong một số trường hợp
- API vẫn xử lý được loaiXe undefined (logic cũ)
- UI vẫn hiển thị được khi không có một số thông tin

### Với database:

- Các field mới như loaiXe có thể null
- API backend cần xử lý null values
- Tương thích với structure cũ

## Kết luận

Refactor này đảm bảo:

1. ✅ Loại xe được lấy từ cấu hình, không từ policy string
2. ✅ Phân loại xe chỉ để xác định cần vị trí gửi hay không
3. ✅ Loại bỏ tất cả giá trị mặc định không cần thiết
4. ✅ Cổng/camera được lấy đúng theo khu vực từ API layDanhSachKhu
5. ✅ Logic nhất quán giữa xe vào và xe ra
6. ✅ Error handling rõ ràng khi thiếu cấu hình
7. ✅ Debug logs đầy đủ để troubleshoot

Người dùng bây giờ BẮT BUỘC phải cấu hình loại xe trong Work Config Dialog để hệ thống hoạt động đúng.
