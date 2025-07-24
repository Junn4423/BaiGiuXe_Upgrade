# 🔧 Session ID Fix - Parking System

## 📋 Tóm tắt vấn đề

**Vấn đề ban đầu:** Hệ thống chỉ lấy mã phiên đầu tiên từ database (ví dụ: 534) thay vì lấy mã phiên của xe vừa vào.

**Nguyên nhân:** Logic cũ query database để lấy bất kỳ session nào có trạng thái "DANG_GUI", không đảm bảo lấy đúng session của xe vừa vào.

## ✅ Giải pháp đã triển khai

### 1. **Lưu mã phiên khi xe vào (QuanLyXe.jsx)**

```javascript
// Trước: Không lưu mã phiên từ response
const apiResult = await themPhienGuiXe(session);

// Sau: Lưu mã phiên vào localStorage
if (success && sessionId) {
  const sessionData = {
    sessionId: sessionId,           // Mã phiên từ API response
    cardId: cardId,                 // Mã thẻ
    timestamp: Date.now(),          // Thời gian tạo
    licensePlate: licensePlate,     // Biển số
    entryTime: entryTime           // Thời gian vào
  };
  localStorage.setItem(`session_${cardId}`, JSON.stringify(sessionData));
}
```

### 2. **Sử dụng mã phiên từ localStorage (apiChamCong.js)**

```javascript
// Trước: Query database
async function getCurrentActiveSessionId() {
  // Query bảng pm_nc0009 để lấy session bất kỳ
  return sessionId; // Có thể sai session
}

// Sau: Lấy từ localStorage
async function getCurrentActiveSessionId() {
  // 1. Lấy tất cả sessions từ localStorage
  // 2. Sắp xếp theo timestamp (mới nhất trước)
  // 3. Trả về session của xe vừa vào
  return latestSessionId; // Đúng session
}
```

### 3. **Xóa session khi xe ra (QuanLyXe.jsx)**

```javascript
// Sau khi xe ra thành công
localStorage.removeItem(`session_${cardId}`);
console.log(`✅ Đã xóa mã phiên cho thẻ ${cardId}`);
```

## 🔄 Luồng hoạt động mới

### 📥 **Xe Vào:**
1. Quét thẻ RFID
2. Chụp ảnh xe + khuôn mặt
3. Gọi API `themPhienGuiXe()` 
4. **Nhận mã phiên từ response (maPhien)**
5. **Lưu mã phiên vào localStorage với key `session_{cardId}`**
6. Hiển thị thông tin xe vào

### 👤 **Chấm Công:**
1. Chụp ảnh khuôn mặt
2. **Lấy mã phiên từ localStorage (session mới nhất)**
3. Gửi API chấm công với `attendance_code = mã phiên`
4. Nhận kết quả chấm công

### 📤 **Xe Ra:**
1. Quét thẻ RFID
2. Chụp ảnh xe ra
3. Cập nhật phiên gửi xe
4. **Xóa session khỏi localStorage**

## 📁 Files đã được chỉnh sửa

### 1. **`frontend/src/components/QuanLyXe.jsx`**
- ✅ Lưu `sessionId` từ API response vào localStorage
- ✅ Xóa session khi xe ra thành công
- ✅ Thêm timestamp để quản lý nhiều sessions

### 2. **`frontend/src/api/apiChamCong.js`**
- ✅ Thay đổi `getCurrentActiveSessionId()` để lấy từ localStorage
- ✅ Thêm fallback query database nếu localStorage lỗi
- ✅ Hỗ trợ cả format cũ (string) và format mới (JSON)
- ✅ Sắp xếp sessions theo timestamp

### 3. **`test_session_logic.html`** (File test mới)
- ✅ Test toàn bộ logic session
- ✅ Mô phỏng xe vào/ra
- ✅ Test chấm công có/không có session
- ✅ Quản lý localStorage

## 🧪 Testing

### **Cách test:**
1. Mở file `test_session_logic.html` trong browser
2. Thực hiện các bước:
   - **Xe Vào:** Click "Mô phỏng Xe Vào"
   - **Kiểm tra:** Click "Kiểm tra Session Hiện tại"
   - **Chấm Công:** Click "Test Chấm Công"
   - **Xe Ra:** Click "Mô phỏng Xe Ra"

### **Kết quả mong đợi:**
- ✅ Mỗi xe vào tạo 1 session riêng biệt
- ✅ Chấm công luôn lấy session của xe vừa vào (mới nhất)
- ✅ Xe ra xóa session tương ứng

## 🔧 Cấu hình LocalStorage

### **Format dữ liệu:**
```json
{
  "sessionId": "1234",
  "cardId": "123456789", 
  "timestamp": 1703123456789,
  "licensePlate": "86B82132",
  "entryTime": "2023-12-21T10:30:45.000Z"
}
```

### **Key format:** `session_{cardId}`
- Ví dụ: `session_123456789`

## 📊 Ưu điểm của giải pháp

### ✅ **Chính xác:**
- Luôn lấy đúng session của xe vừa vào
- Không bị nhầm lẫn với xe khác

### ✅ **Hiệu suất:**
- Không cần query database cho mỗi lần chấm công
- Truy cập localStorage nhanh hơn

### ✅ **Đơn giản:**
- Logic rõ ràng, dễ hiểu
- Ít phụ thuộc vào database

### ✅ **Backward Compatible:**
- Vẫn hỗ trợ format cũ
- Có fallback query database

## 🚨 Lưu ý

### **Giới hạn:**
- LocalStorage có thể bị xóa nếu user clear browser data
- Chỉ hoạt động trong cùng 1 browser/tab

### **Khuyến nghị:**
- Định kỳ dọn dẹp localStorage (xóa sessions cũ)
- Monitor logs để đảm bảo hoạt động ổn định

## 📝 Logs và Debug

### **Console logs quan trọng:**
```javascript
// Khi lưu session
✅ Đã lưu mã phiên 1234 cho thẻ 123456789 với timestamp 1703123456789

// Khi lấy session
🔍 Tìm mã phiên từ localStorage...
✅ Tìm thấy 1 sessions, lấy session mới nhất: {...}

// Khi xóa session  
✅ Đã xóa mã phiên cho thẻ 123456789 khỏi localStorage
```

## 🔮 Tương lai

### **Có thể cải thiện:**
- Thêm expiry time cho sessions
- Sync với database để backup
- Hỗ trợ multiple browsers

---

**Status:** ✅ **HOÀN THÀNH**  
**Date:** December 2024  
**Tested:** ✅ Logic test passed
