# Hướng Dẫn Chuyển Đổi Hệ Thống Relay API

## 📋 Tổng Quan

Hệ thống relay đã được chuyển đổi hoàn toàn từ **node-hid/Electron IPC** sang **Python FastAPI HTTP Service**. Điều này mang lại nhiều lợi ích:

- ✅ **Stability**: Ổn định hơn, ít lỗi crash
- ✅ **Maintainability**: Dễ bảo trì và debug hơn
- ✅ **Scalability**: Có thể mở rộng và tích hợp dễ dàng
- ✅ **Independence**: Service độc lập, không phụ thuộc vào Electron

## 🚀 Cách Sử Dụng

### 1. Khởi Động Relay Service

**Tự động (khuyến nghị):**
Service sẽ tự động khởi động khi bạn chạy ứng dụng chính.

**Thủ công:**

```bash
# Chạy batch file setup (chỉ cần 1 lần đầu)
SETUP_RELAY_SERVICE.bat

# Khởi động service
backend\relay\START_RELAY_SERVICE.bat

# Dừng service
backend\relay\STOP_RELAY_SERVICE.bat
```

### 2. Sử dụng Relay Control UI

1. Mở ứng dụng parking system
2. Vào **Relay Control** từ menu
3. Nhấn **"Kết nối"** để kết nối USB relay
4. Sử dụng các chức năng:
   - **Individual Control**: Điều khiển từng relay
   - **Bitmask Control**: Điều khiển theo pattern
   - **Test Functions**: Các chức năng test

### 3. API Endpoints Mới

Service chạy trên `http://localhost:5003` với các endpoint:

| Endpoint                 | Method | Mô tả                               |
| ------------------------ | ------ | ----------------------------------- |
| `/connect`               | POST   | Kết nối USB relay                   |
| `/disconnect`            | POST   | Ngắt kết nối                        |
| `/control`               | POST   | Điều khiển relay cụ thể             |
| `/control-bitmask`       | POST   | Điều khiển bằng bitmask             |
| `/turn-off-all`          | POST   | Tắt tất cả relay                    |
| `/test-sequence`         | POST   | Test tuần tự                        |
| `/test-bitmask-patterns` | POST   | Test các pattern                    |
| `/sequence-test`         | POST   | **MỚI**: Loop mở full relay tuần tự |
| `/health`                | GET    | Kiểm tra trạng thái service         |
| `/device-info`           | GET    | Thông tin thiết bị                  |

### 4. Thay Đổi Trong Code

**Trước (relayService):**

```javascript
import relayService from "../services/relayService";

// Sử dụng
await relayService.connect();
await relayService.controlRelay(1, true);
```

**Sau (API calls):**

```javascript
import { relayConnect, relayControl } from "../api/api.js";

// Sử dụng
const result = await relayConnect();
if (result.success) {
  await relayControl(1, true);
}
```

## 🔧 Troubleshooting

### Service Không Khởi Động

```bash
# Kiểm tra Python và dependencies
python --version
pip list | grep hidapi

# Reinstall dependencies
cd backend\relay
pip install -r requirements.txt
```

### USB Relay Không Kết Nối

1. Kiểm tra device có cắm vào không
2. Kiểm tra driver USB đã cài đặt
3. Chạy với quyền Administrator
4. Kiểm tra Windows Device Manager

### Port 5003 Bị Chiếm

```bash
# Kiểm tra process nào đang dùng port
netstat -ano | findstr :5003

# Kill process (thay PID)
taskkill /PID <PID> /F
```

## 📁 Cấu Trúc File Mới

```
backend/relay/
├── fast_relay_service.py          # Main Python service
├── relaycontrolHTTP.js           # HTTP client wrapper (nếu cần)
├── requirements.txt              # Python dependencies
├── START_RELAY_SERVICE.bat       # Khởi động service
├── STOP_RELAY_SERVICE.bat        # Dừng service
└── SETUP_RELAY_SERVICE.bat       # Setup môi trường

frontend/src/api/api.js            # Relay API functions
frontend/src/components/RelayControl.jsx  # Updated UI component
```

## 🧪 Test Functions

### 1. Test Sequence

Bật/tắt tuần tự từng relay với delay tùy chỉnh:

```javascript
await relayTestSequence((cycles = 1), (delayMs = 800));
```

### 2. Test Bitmask Patterns

Thử các pattern bitmask khác nhau:

```javascript
await relayTestBitmaskPatterns((cycles = 1), (delayMs = 1000));
```

### 3. Sequence Test (MỚI)

Loop mở full relay tuần tự 1 lần - pattern cố định:

```javascript
await relaySequenceTest();
```

## ⚡ Performance & Monitoring

### Health Check

```bash
curl http://localhost:5003/health
```

### Device Info

```bash
curl http://localhost:5003/device-info
```

### Logs

- Service logs: Console khi chạy service
- Electron logs: DevTools Console
- Error logs: Sẽ hiển thị trong Toast notifications

## 🔒 Security

- Service chỉ chạy trên localhost
- Không cần authentication cho local calls
- Port 5003 chỉ bind local interface

## 📈 Migration Status

- ✅ Python FastAPI service created
- ✅ HTTP client wrapper implemented
- ✅ Electron IPC handlers updated
- ✅ Frontend UI converted to API calls
- ✅ Batch scripts for service management
- ✅ All test functions working
- ✅ New sequence-test endpoint added
- ✅ Complete code conversion finished

## 🎯 Next Steps

1. Test thoroughly in production environment
2. Monitor service stability
3. Add more advanced features if needed
4. Consider adding authentication for remote access
5. Implement service auto-restart mechanism

---

_Cập nhật: $(date)_
_Service Status: Production Ready ✅_
