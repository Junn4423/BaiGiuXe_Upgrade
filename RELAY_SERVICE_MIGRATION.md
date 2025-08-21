# USB Relay Service Migration Guide

## Tổng quan

Hệ thống USB Relay đã được chuyển đổi từ sử dụng trực tiếp `node-hid` sang kiến trúc microservice với FastAPI Python service. Điều này giúp:

1. ✅ Loại bỏ dependency phức tạp `node-hid`
2. ✅ Tăng tính ổn định và dễ debug
3. ✅ Dễ dàng test và maintain
4. ✅ Tương đồng với kiến trúc của Face Recognition và ALPR services

## Cấu trúc mới

```
backend/relay/
├── fast_relay_service.py           # FastAPI service chính
├── requirements_relay_service.txt  # Python dependencies
├── start_relay_service.bat         # Script khởi động service (có console)
├── run_fast_relay_service_silent.bat # Script khởi động service (silent)
├── stop_relay_service.bat          # Script dừng service
├── test_relay_service.bat          # Script test service
└── relaycontrol.py                 # Module gốc (giữ nguyên để tham khảo)

frontend/src/services/
├── relayControl.js                 # Module cũ (node-hid) - deprecated
└── relayControlHTTP.js             # Module mới (HTTP API client)
```

## Cách sử dụng

### 1. Khởi động thủ công

```batch
cd backend\relay
.\start_relay_service.bat
```

### 2. Khởi động tự động

Service sẽ tự động khởi động khi chạy ứng dụng chính.

### 3. Test service

```batch
cd backend\relay
.\test_relay_service.bat
```

## API Endpoints

Service chạy trên `http://127.0.0.1:5003` với các endpoints:

### Health Check

```
GET /healthz
```

### Kiểm tra trạng thái relay

```
GET /relay/status
```

### Điều khiển relay đơn lẻ

```
POST /relay/control
Content-Type: application/json

{
    "relay_num": 1,     // 1-4
    "state": true       // true=ON, false=OFF
}
```

### Điều khiển nhiều relay với bitmask

```
POST /relay/control-multiple
Content-Type: application/json

{
    "bitmask": 5        // Binary: 0101 = relay 1 và 3 ON
}
```

### Tắt tất cả relay

```
POST /relay/all-off
```

### Sequence Test (mới)

```
POST /relay/sequence-test
Content-Type: application/json

{
    "cycles": 1,        // Số lần lặp (1-10, mặc định: 1)
    "delay_ms": 1000    // Độ trễ giữa các thao tác (100-10000ms, mặc định: 1000)
}
```

Endpoint này sẽ mở/đóng tuần tự từng relay (1→2→3→4) theo số cycles chỉ định.

## Thay đổi trong code

### Electron main.js

```javascript
// CŨ: Import trực tiếp node-hid
let RelayControlAPI = require("../frontend/src/services/relayControl.js");

// MỚI: Import HTTP client
let RelayControlAPI = require("../frontend/src/services/relayControlHTTP.js");
```

### API không đổi

Các function trong `RelayControlAPI` vẫn giữ nguyên interface:

```javascript
// Các function này vẫn hoạt động như cũ
await RelayControlAPI.connect();
await RelayControlAPI.controlRelay(1, true);
await RelayControlAPI.turnOn(1);
await RelayControlAPI.turnOff(1);
await RelayControlAPI.turnOffAll();
await RelayControlAPI.controlBitmask(5);
await RelayControlAPI.testSequence(1, 1000);
await RelayControlAPI.sequenceTest(1, 1000); // Function mới
```

## Troubleshooting

### Service không khởi động

1. Kiểm tra Python environment:

```batch
cd backend\relay
python --version
pip install -r requirements_relay_service.txt
```

2. Kiểm tra USB device:

```batch
python -c "import hid; device = hid.device(); device.open(0x16C0, 0x05DF); print('OK'); device.close()"
```

### Service không phản hồi

1. Kiểm tra process:

```batch
tasklist | findstr python
```

2. Kiểm tra port:

```batch
netstat -ano | findstr :5003
```

3. Restart service:

```batch
.\stop_relay_service.bat
.\start_relay_service.bat
```

### Frontend không kết nối được

1. Kiểm tra service status:

```
curl http://127.0.0.1:5003/healthz
```

2. Kiểm tra logs trong console của Electron app

## Migration Steps

### Bước 1: Install dependencies

```batch
cd electron-app
npm install axios
```

### Bước 2: Update main.js (Đã hoàn thành)

- Thay đổi import từ `relayControl.js` sang `relayControlHTTP.js`
- Thêm `startRelayService()` function
- Thêm cleanup cho `relayServiceProcess`

### Bước 3: Test

1. Khởi động ứng dụng
2. Kiểm tra logs để đảm bảo relay service đã start
3. Test các chức năng relay trong UI

## Lợi ích

1. **Stability**: Không còn lỗi `node-hid` build
2. **Debugging**: Dễ debug với Python logs
3. **Testing**: Có thể test độc lập với curl/Postman
4. **Maintenance**: Code Python dễ maintain hơn
5. **Documentation**: API docs tự động tại `/docs`

## Notes

- Service sẽ tự động tắt tất cả relay khi disconnect
- Hỗ trợ chạy trong "mock mode" nếu không có USB device
- Logs được ghi vào `fast_relay_service.log`
- API documentation có sẵn tại `http://127.0.0.1:5003/docs`
