/**
 * Utility functions for time handling
 * Đảm bảo thời gian luôn được lấy từ frontend (client-side)
 */

/**
 * Lấy thời gian hiện tại từ hệ thống client theo format MySQL datetime
 * @returns {string} Thời gian theo format "YYYY-MM-DD HH:mm:ss" (local time, không phải UTC)
 */
export function getCurrentDateTime() {
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0');
  const day = String(now.getDate()).padStart(2, '0');
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const seconds = String(now.getSeconds()).padStart(2, '0');
  
  return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

/**
 * Lấy thời gian hiện tại từ hệ thống client theo format ISO string
 * @returns {string} Thời gian theo format ISO
 */
export function getCurrentISOString() {
  return new Date().toISOString();
}

/**
 * Format thời gian từ Date object sang format MySQL datetime
 * @param {Date} date - Date object cần format
 * @returns {string} Thời gian theo format "YYYY-MM-DD HH:mm:ss" (local time)
 */
export function formatDateTimeForDatabase(date = new Date()) {
  if (!(date instanceof Date)) {
    date = new Date(date);
  }
  
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  const hours = String(date.getHours()).padStart(2, '0');
  const minutes = String(date.getMinutes()).padStart(2, '0');
  const seconds = String(date.getSeconds()).padStart(2, '0');
  
  return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

/**
 * Lấy timestamp hiện tại (milliseconds)
 * @returns {number} Timestamp
 */
export function getCurrentTimestamp() {
  return Date.now();
}

/**
 * Chuyển đổi thời gian từ string sang Date object
 * @param {string} dateTimeString - Chuỗi thời gian
 * @returns {Date} Date object
 */
export function parseDateTime(dateTimeString) {
  return new Date(dateTimeString);
}

/**
 * Format thời gian để hiển thị cho người dùng (tiếng Việt)
 * @param {string|Date} dateTime - Thời gian cần format
 * @returns {string} Thời gian đã format
 */
export function formatDateTimeForDisplay(dateTime) {
  if (!dateTime) return "N/A";
  
  const date = typeof dateTime === 'string' ? new Date(dateTime) : dateTime;
  if (isNaN(date.getTime())) return "N/A";
  
  return date.toLocaleString('vi-VN', {
    year: 'numeric',
    month: '2-digit', 
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit'
  });
}

/**
 * Tính thời gian chênh lệch giữa 2 thời điểm (tính bằng phút)
 * @param {string|Date} startTime - Thời gian bắt đầu
 * @param {string|Date} endTime - Thời gian kết thúc (mặc định là hiện tại)
 * @returns {number} Số phút chênh lệch
 */
export function calculateDurationInMinutes(startTime, endTime = new Date()) {
  const start = typeof startTime === 'string' ? new Date(startTime) : startTime;
  const end = typeof endTime === 'string' ? new Date(endTime) : endTime;
  
  if (isNaN(start.getTime()) || isNaN(end.getTime())) {
    return 0;
  }
  
  return Math.floor((end.getTime() - start.getTime()) / (1000 * 60));
}

/**
 * Kiểm tra xem thời gian có hợp lệ không
 * @param {string|Date} dateTime - Thời gian cần kiểm tra
 * @returns {boolean} True nếu thời gian hợp lệ
 */
export function isValidDateTime(dateTime) {
  if (!dateTime) return false;
  
  const date = typeof dateTime === 'string' ? new Date(dateTime) : dateTime;
  return !isNaN(date.getTime());
}

/**
 * Tạo dữ liệu session với thời gian vào từ client-side
 * @param {Object} sessionData - Dữ liệu session cơ bản
 * @returns {Object} Session data với thời gian client-side
 */
export function createSessionWithClientTime(sessionData) {
  return {
    ...sessionData,
    gioVao: getCurrentDateTime(), // Luôn dùng thời gian client-side
  };
}

/**
 * Cập nhật dữ liệu session với thời gian ra từ client-side  
 * @param {Object} sessionData - Dữ liệu session cần cập nhật
 * @returns {Object} Session data với thời gian ra client-side
 */
export function updateSessionWithExitTime(sessionData) {
  return {
    ...sessionData,
    gioRa: getCurrentDateTime(), // Luôn dùng thời gian client-side
    trangThai: "DA_RA"
  };
}

// Export default object với tất cả functions
export default {
  getCurrentDateTime,
  getCurrentISOString,
  formatDateTimeForDatabase,
  getCurrentTimestamp,
  parseDateTime,
  formatDateTimeForDisplay,
  calculateDurationInMinutes,
  isValidDateTime,
  createSessionWithClientTime,
  updateSessionWithExitTime
};
