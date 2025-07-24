import { url_api_chamcong, url_api } from './url.js';

// API endpoint cho chấm công
const ATTENDANCE_API_BASE = url_api_chamcong;

// Local storage để lưu dữ liệu chấm công hôm nay
const ATTENDANCE_STORAGE_KEY = 'attendance_today';

/**
 * Lấy mã phiên lớn nhất từ database pm_nc0009 (MAX(lv001))
 * @returns {Promise<string|null>} - Mã phiên hoặc null
 */
async function getCurrentActiveSessionId() {
  try {
    console.log('🔍 Lấy mã phiên lớn nhất từ bảng pm_nc0009...');
    
    const response = await fetch(url_api, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        table: "pm_nc0009",
        func: "getMaxSessionId"
      })
    });

    if (!response.ok) {
      console.error(`❌ HTTP error! status: ${response.status}`);
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    console.log('📡 Raw API response:', result);
    
    if (result && result.success && result.maxSessionId) {
      const sessionId = result.maxSessionId;
      console.log('✅ Lấy được mã phiên lớn nhất:', sessionId);
      console.log('🎯 MÃ PHIÊN DÙNG CHO CHẤM CÔNG:', sessionId);
      return sessionId;
    }
    
    console.log('⚠️ Không có phiên gửi xe nào trong database hoặc response không đúng format');
    console.log('📊 Response detail:', JSON.stringify(result, null, 2));
    return null;
  } catch (error) {
    console.error('❌ Lỗi lấy mã phiên từ database:', error);
    return null;
  }
}



/**
 * Gửi ảnh chấm công đến hệ thống nhận diện khuôn mặt
 * @param {Blob|File} imageBlob - Ảnh khuôn mặt để chấm công
 * @param {string} licensePlate - Biển số xe (tùy chọn)
 * @returns {Promise<Object>} - Kết quả chấm công
 */
export async function attendanceByImage(imageBlob, licensePlate = '') {
  try {
    console.log('📸 Bắt đầu gửi ảnh chấm công:', {
      imageSize: imageBlob.size,
      imageType: imageBlob.type,
      licensePlate
    });

    // Lấy mã phiên hiện tại
    console.log('🔍 Đang lấy mã phiên từ database...');
    const attendanceCode = await getCurrentActiveSessionId();
    
    if (attendanceCode) {
      console.log('✅ ĐÃ LẤY ĐƯỢC MÃ PHIÊN:', attendanceCode);
      console.log('🎯 MÃ PHIÊN SẼ GỬI TRONG attendance_code:', attendanceCode);
    } else {
      console.log('⚠️ KHÔNG LẤY ĐƯỢC MÃ PHIÊN - sẽ gửi chấm công không có attendance_code');
    }

    const formData = new FormData();
    
    // Tạo file từ blob
    const file = new File([imageBlob], `attendance_${Date.now()}.jpg`, {
      type: imageBlob.type || 'image/jpeg',
      lastModified: Date.now()
    });
    
    formData.append('image', file);
    
    // Thêm attendance_code nếu có mã phiên
    if (attendanceCode) {
      formData.append('attendance_code', attendanceCode);
      console.log('📦 Đã thêm attendance_code vào FormData:', attendanceCode);
    }

    console.log('🚀 Gửi request đến API chấm công...');
    const response = await fetch(`${ATTENDANCE_API_BASE}/api/attendance_image`, {
      method: 'POST',
      body: formData
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    console.log('📨 Response từ API chấm công:', result);
    
    // Kiểm tra attendance_code trong response
    if (result.attendance_code) {
      console.log('✅ API chấm công đã nhận được attendance_code:', result.attendance_code);
    } else {
      console.log('⚠️ API chấm công không trả về attendance_code');
    }

    // Nếu chấm công thành công, lưu vào localStorage
    if (result.success && result.user) {
      const attendanceRecord = {
        user: result.user,
        status: result.status,
        message: result.message,
        attendance_code: result.attendance_code || attendanceCode, // Lưu attendance_code từ response hoặc từ request
        licensePlate: licensePlate || 'Không xác định',
        timestamp: new Date().toISOString()
      };
      
      console.log('💾 Lưu record chấm công với attendance_code:', attendanceRecord.attendance_code);
      // Lưu record
      saveAttendanceRecord(attendanceRecord);
    }

    return result;
  } catch (error) {
    console.error('❌ Lỗi chấm công:', error);
    // Bỏ qua lỗi, không hiển thị cho user
    return { success: false, message: error.message };
  }
}/**
 * Gửi ảnh chấm công bằng base64
 * @param {string} imageBase64 - Ảnh base64
 * @param {string} licensePlate - Biển số xe (tùy chọn)
 * @returns {Promise<Object>} - Kết quả chấm công
 */
export async function attendanceByBase64(imageBase64, licensePlate = '') {
  try {
    console.log('📸 Bắt đầu gửi ảnh base64 chấm công:', {
      imageLength: imageBase64.length,
      licensePlate
    });

    // Lấy mã phiên hiện tại
    console.log('🔍 Đang lấy mã phiên từ database...');
    const attendanceCode = await getCurrentActiveSessionId();
    
    if (attendanceCode) {
      console.log('✅ ĐÃ LẤY ĐƯỢC MÃ PHIÊN:', attendanceCode);
      console.log('🎯 MÃ PHIÊN SẼ GỬI TRONG attendance_code:', attendanceCode);
    } else {
      console.log('⚠️ KHÔNG LẤY ĐƯỢC MÃ PHIÊN - sẽ gửi chấm công không có attendance_code');
    }

    const requestBody = {
      image_base64: imageBase64
    };

    // Thêm attendance_code nếu có mã phiên
    if (attendanceCode) {
      requestBody.attendance_code = attendanceCode;
      console.log('📦 Đã thêm attendance_code vào JSON:', attendanceCode);
    }

    console.log('🚀 Gửi request JSON đến API chấm công...');
    const response = await fetch(`${ATTENDANCE_API_BASE}/api/attendance_image`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(requestBody)
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    console.log('📨 Response từ API chấm công (base64):', result);
    
    // Kiểm tra attendance_code trong response
    if (result.attendance_code) {
      console.log('✅ API chấm công đã nhận được attendance_code:', result.attendance_code);
    } else {
      console.log('⚠️ API chấm công không trả về attendance_code');
    }

    // Nếu chấm công thành công, lưu vào localStorage
    if (result.success && result.user) {
      const attendanceRecord = {
        user: result.user,
        status: result.status,
        message: result.message,
        attendance_code: result.attendance_code || attendanceCode, // Lưu attendance_code từ response hoặc từ request
        licensePlate: licensePlate || 'Không xác định',
        timestamp: new Date().toISOString()
      };
      
      console.log('💾 Lưu record chấm công với attendance_code:', attendanceRecord.attendance_code);
      // Lưu record
      saveAttendanceRecord(attendanceRecord);
    }

    return result;
  } catch (error) {
    console.error('❌ Lỗi chấm công (base64):', error);
    // Bỏ qua lỗi, không hiển thị cho user
    return { success: false, message: error.message };
  }
}


/**
 * Xóa dữ liệu chấm công cũ (chỉ giữ 7 ngày gần nhất) - non-blocking
 */
export function cleanupOldAttendanceData() {
  // Chạy cleanup trong background để không ảnh hưởng UI
  setTimeout(() => {
    try {
      const existingData = JSON.parse(localStorage.getItem(ATTENDANCE_STORAGE_KEY) || '{}');
      const dataKeys = Object.keys(existingData);
      
      // Nếu không có dữ liệu, bỏ qua
      if (dataKeys.length === 0) return;
      
      const sevenDaysAgo = new Date();
      sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);
      
      const cleanedData = {};
      let hasChanges = false;
      
      dataKeys.forEach(dateStr => {
        const recordDate = new Date(dateStr);
        if (recordDate >= sevenDaysAgo) {
          cleanedData[dateStr] = existingData[dateStr];
        } else {
          hasChanges = true; // Có dữ liệu cũ bị xóa
        }
      });
      
      // Chỉ cập nhật localStorage nếu có thay đổi
      if (hasChanges) {
        localStorage.setItem(ATTENDANCE_STORAGE_KEY, JSON.stringify(cleanedData));
        console.log('🧹 Đã dọn dẹp dữ liệu chấm công cũ');
      }
    } catch (error) {
      console.error('❌ Lỗi cleanup dữ liệu chấm công:', error);
    }
  }, 100); // Delay để không ảnh hưởng performance chính
}

/**
 * Convert blob to base64
 * @param {Blob} blob - File blob
 * @returns {Promise<string>} - base64 string
 */
export function blobToBase64(blob) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
    reader.readAsDataURL(blob);
  });
}

/**
 * Xử lý chấm công khi chụp ảnh khuôn mặt - CHỈ thực hiện ở chế độ xe vào
 * @param {Blob|File} faceImageBlob - Ảnh khuôn mặt
 * @param {string} licensePlate - Biển số xe đã nhận diện được
 * @param {Function} showToast - Hàm hiển thị thông báo toast
 * @param {string} currentMode - Chế độ hiện tại ("vao" hoặc "ra")
 * @returns {Promise<boolean>} - True nếu chấm công thành công
 */
export async function processAttendanceImage(faceImageBlob, licensePlate = '', showToast = null, currentMode = 'vao') {
  try {
    // Early validation - return immediately for invalid cases
    if (currentMode !== 'vao') {
      console.log('ℹ️ Không xử lý chấm công ở chế độ xe ra');
      return false;
    }

    if (!faceImageBlob) {
      console.log('⚠️ Không có ảnh khuôn mặt để chấm công');
      return false;
    }

    console.log('🎯 Bắt đầu xử lý chấm công với ảnh khuôn mặt (mode: vào)');

    // Gửi ảnh chấm công với biển số đã nhận diện được
    const result = await attendanceByImage(faceImageBlob, licensePlate);

    if (result.success && result.user) {
      // Chấm công thành công - xử lý UI ngay lập tức
      const message = result.message || `Điểm danh thành công cho ${result.user.name}`;
      
      console.log('✅ Chấm công thành công:', {
        employee: result.user,
        status: result.status,
        licensePlate: licensePlate,
        message: result.message
      });

      // Hiển thị thông báo thành công ngay (non-blocking)
      if (showToast) {
        // Sử dụng setTimeout để không chặn UI
        setTimeout(() => {
          showToast(message, 'success', 3000);
        }, 0);
      }

      // Return ngay để không chặn UI, localStorage sẽ được xử lý trong attendanceByImage
      return true;
    } else {
      // Không nhận diện được nhân viên (khách hàng) - bỏ qua hoàn toàn
      console.log('Không nhận diện được nhân viên phù hợp (có thể là khách hàng), tiếp tục hoạt động bình thường');
      return false;
    }
  } catch (error) {
    console.error('Lỗi xử lý chấm công:', error);
    // Không hiển thị lỗi cho user, chỉ log để debug
    return false;
  }
}

/**
 * Lưu record chấm công vào localStorage (non-blocking)
 * @param {Object} record - Dữ liệu chấm công
 */
function saveAttendanceRecord(record) {
  // Sử dụng setTimeout để không chặn UI thread
  setTimeout(() => {
    try {
      const today = new Date().toDateString();
      const storageKey = `attendance_records_${today}`;
      
      const existingRecords = JSON.parse(localStorage.getItem(storageKey) || '[]');
      existingRecords.push(record);
      
      localStorage.setItem(storageKey, JSON.stringify(existingRecords));
      
      console.log('Đã lưu record chấm công:', {
        user: record.user?.name,
        status: record.status,
        attendance_code: record.attendance_code,
        licensePlate: record.licensePlate,
        timestamp: record.timestamp
      });
    } catch (error) {
      console.error('Lỗi lưu record chấm công:', error);
    }
  }, 0);
}

/**
 * Lấy danh sách chấm công hôm nay
 * @returns {Array} - Danh sách chấm công
 */
export function getTodayAttendanceRecords() {
  try {
    const today = new Date().toDateString();
    const storageKey = `attendance_records_${today}`;
    
    const records = JSON.parse(localStorage.getItem(storageKey) || '[]');
    
    // Sort by timestamp desc (mới nhất trước)
    return records.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp));
  } catch (error) {
    console.error('Lỗi lấy records chấm công:', error);
    return [];
  }
}

// Export functions
export { getCurrentActiveSessionId };

/**
 * Xóa dữ liệu chấm công hôm nay
 */
export function clearTodayAttendanceRecords() {
  try {
    const today = new Date().toDateString();
    const storageKey = `attendance_records_${today}`;
    
    localStorage.removeItem(storageKey);
    console.log('Đã xóa dữ liệu chấm công hôm nay');
  } catch (error) {
    console.error('Lỗi xóa records chấm công:', error);
  }
}

export default {
  attendanceByImage,
  attendanceByBase64,
  processAttendanceImage,
  getTodayAttendanceRecords,
  clearTodayAttendanceRecords,
  blobToBase64
};
