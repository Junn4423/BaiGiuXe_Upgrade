// api.js - Chuyển đổi các hàm Python sang React (JS)
// Lưu ý: Cần chỉnh sửa urlApi cho đúng endpoint backend của bạn

import { api_BienSo } from './url'

const urlApi = "http://192.168.1.94/parkinglot/services.sof.vn/index.php" // Thay đổi cho đúng backend
const urlLoginApi = "http://192.168.1.94/parkinglot/login.sof.vn/index.php"

// -------------------- Authentication helpers --------------------
let authCache = null // Lưu token sau lần đăng nhập đầu tiên

async function getAuthToken(username = "admin", password = "1") {
  // Luôn lấy token mới để đảm bảo không bị expired
  console.log("Getting fresh auth token...")

  const payload = {
    txtUserName: username,
    txtPassword: password,
  }

  const res = await fetch(urlLoginApi, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload),
  })

  if (!res.ok) {
    throw new Error("Không thể đăng nhập để lấy token")
  }

  authCache = await res.json()
  console.log("Got auth token:", authCache)
  return authCache
}

async function getAuthHeaders() {
  const authData = await getAuthToken()
  return {
    "Content-Type": "application/json",
    "X-USER-CODE": authData.code,
    "X-USER-TOKEN": authData.token,
  }
}

async function callApiWithAuth(payload) {
  console.log("Calling API with auth:", payload)
  const headers = await getAuthHeaders()
  console.log("Using headers:", headers)

  const res = await fetch(urlApi, {
    method: "POST",
    headers,
    body: JSON.stringify(payload),
  })

  const result = await handleApiResponse(res)
  console.log("API response:", result)
  return result
}

function handleApiResponse(response) {
  if (!response.ok) {
    console.error("API response not ok:", response.status, response.statusText)
    throw new Error(`Network response was not ok: ${response.status}`)
  }

  return response.json().then((data) => {
    console.log("Raw API response:", data)

    if (typeof data === "object" && data.success === false) {
      throw new Error(data.message || "API error")
    }
    return data
  })
}

// -------------------- API Functions --------------------

export async function layALLLoaiPhuongTien() {
  const payload = { table: "pm_nc0001", func: "data" }
  return callApiWithAuth(payload)
}

export async function themLoaiPhuongTien(loaiPhuongTien) {
  const payload = {
    table: "pm_nc0001",
    func: "add",
    maLoaiPT: loaiPhuongTien.maLoaiPT,
    tenLoaiPT: loaiPhuongTien.tenLoaiPT,
    moTa: loaiPhuongTien.moTa,
  }
  return callApiWithAuth(payload)
}

export async function capNhatLoaiPhuongTien(loaiPhuongTien) {
  const payload = {
    table: "pm_nc0001",
    func: "edit",
    maLoaiPT: loaiPhuongTien.maLoaiPT,
    tenLoaiPT: loaiPhuongTien.tenLoaiPT,
    moTa: loaiPhuongTien.moTa,
  }
  return callApiWithAuth(payload)
}

export async function xoaLoaiPhuongTien(maLoaiPT) {
  const payload = { table: "pm_nc0001", func: "delete", maLoaiPT }
  return callApiWithAuth(payload)
}

export async function layDanhSachCamera() {
  const payload = { table: "pm_nc0006_1", func: "data" }
  return callApiWithAuth(payload)
}

export async function themCamera(camera) {
  const payload = {
    table: "pm_nc0006_1",
    func: "add",
    maCamera: camera.maCamera,
    tenCamera: camera.tenCamera,
    loaiCamera: camera.loaiCamera,
    chucNangCamera: camera.chucNangCamera,
    maKhuVuc: camera.maKhuVuc,
    linkRTSP: camera.linkRTSP,
  }
  return callApiWithAuth(payload)
}

export async function capNhatCamera(camera) {
  const payload = {
    table: "pm_nc0006_1",
    func: "edit",
    maCamera: camera.maCamera,
    tenCamera: camera.tenCamera,
    loaiCamera: camera.loaiCamera,
    chucNangCamera: camera.chucNangCamera,
    maKhuVuc: camera.maKhuVuc,
    linkRTSP: camera.linkRTSP,
  }
  return callApiWithAuth(payload)
}

export async function xoaCamera(maCamera) {
  const payload = { table: "pm_nc0006_1", func: "delete", maCamera }
  return callApiWithAuth(payload)
}

// --- Thêm các hàm API còn lại chuyển từ Python sang JS ---

export async function layALLPhienGuiXe() {
  const payload = { table: "pm_nc0009", func: "data" }
  return callApiWithAuth(payload)
}

export async function themPhienGuiXe(session) {
  const payload = {
    table: "pm_nc0009",
    func: "add",
    uidThe: session.uidThe,
    bienSo: session.bienSo,
    viTriGui: session.viTriGui,
    chinhSach: session.chinhSach,
    congVao: session.congVao,
    gioVao: session.gioVao,
    anhVao: session.anhVao,
    anhMatVao: session.anhMatVao,
    camera_id: session.camera_id,
  }
  return callApiWithAuth(payload)
}

export async function capNhatPhienGuiXe(session) {
  const payload = {
    table: "pm_nc0009",
    func: "edit",
    maPhien: session.maPhien,
    congRa: session.congRa,
    gioRa: session.gioRa,
    anhRa: session.anhRa,
    anhMatRa: session.anhMatRa,
    camera_id: session.camera_id,
    plate_match: session.plate_match,
    plate: session.plate,
  }
  return callApiWithAuth(payload)
}

export async function loadPhienGuiXeTheoMaThe(maThe) {
  const payload = { table: "pm_nc0009", func: "layPhienGuiXeTuUID", uidThe: maThe }
  return callApiWithAuth(payload)
}

export async function loadPhienGuiXeTheoMaThe_XeRa(maThe) {
  const payload = { table: "pm_nc0009", func: "layPhienGuiXeTuUID_Da_Ra", uidThe: maThe }
  return callApiWithAuth(payload)
}

export async function taoBangChoPhienLamViec() {
  const payload = { table: "pm_nc0009", func: "taoBangChoPhienLamViec" }
  return callApiWithAuth(payload)
}

export async function tinhPhiGuiXe(maPhien) {
  const payload = { table: "pm_nc0008", func: "tinhPhiGuiXe", maPhien }
  return callApiWithAuth(payload)
}

export async function layChinhSachGiaTheoLoaiPT(maLoaiPT) {
  const payload = { table: "pm_nc0008", func: "layChinhSachTuPT", maLoaiPT }
  return callApiWithAuth(payload)
}

export async function themThe(uidThe, loaiThe, trangThai = "1") {
  // Wrapper function for backward compatibility
  return themTheRFID({ uidThe, loaiThe, trangThai })
}

// -------------------- Pricing Policy Functions --------------------
export async function layALLChinhSachGia() {
  const payload = { table: "pm_nc0008", func: "getAllPolicies" }
  const res = await callApiWithAuth(payload)
  return res.data || []
}

export async function themChinhSachGia(chinhSach) {
  console.log("themChinhSachGia called with:", chinhSach)
  const payload = { table: "pm_nc0008", func: "createPolicy", policyData: chinhSach }
  return callApiWithAuth(payload)
}

export async function capNhatChinhSachGia(maChinhSach, chinhSach) {
  console.log("capNhatChinhSachGia called with:", maChinhSach, chinhSach)
  const payload = { table: "pm_nc0008", func: "updatePolicy", policyId: maChinhSach, policyData: chinhSach }
  return callApiWithAuth(payload)
}

export async function xoaChinhSachGia(maChinhSach) {
  console.log("xoaChinhSachGia called with:", maChinhSach)
  const payload = { table: "pm_nc0008", func: "deletePolicy", policyId: maChinhSach }
  return callApiWithAuth(payload)
}

// -------------------- Zone Management Functions --------------------
export async function layDanhSachKhuVuc() {
  const payload = { table: "pm_nc0004_2", func: "data" }
  return callApiWithAuth(payload)
}

export async function themKhuVuc(khuVuc) {
  const payload = {
    table: "pm_nc0004_2",
    func: "add",
    maKhuVuc: khuVuc.maKhuVuc,
    tenKhuVuc: khuVuc.tenKhuVuc,
    moTa: khuVuc.moTa || "",
  }
  return callApiWithAuth(payload)
}

export async function capNhatKhuVuc(khuVuc) {
  const payload = {
    table: "pm_nc0004_2",
    func: "edit",
    maKhuVuc: khuVuc.maKhuVuc,
    tenKhuVuc: khuVuc.tenKhuVuc,
    moTa: khuVuc.moTa,
  }
  return callApiWithAuth(payload)
}

export async function xoaKhuVuc(maKhuVuc) {
  const payload = { table: "pm_nc0004_2", func: "delete", maKhuVuc }
  return callApiWithAuth(payload)
}

export async function layDanhSachKhu() {
  const payload = { table: "pm_nc0004_1", func: "khu_vuc_camera_cong" }
  return callApiWithAuth(payload)
}

// --- Bổ sung các hàm API còn thiếu từ Python sang JS ---

export async function xoaPhienGuiXe(maPhien) {
  const payload = { table: "pm_nc0009", func: "delete", maPhien }
  return callApiWithAuth(payload)
}

// Force refresh auth token - để gọi khi cần làm mới token
export async function refreshAuthToken() {
  console.log("Forcing auth token refresh...")
  authCache = null // Clear cache
  return await getAuthToken()
}

// -------------------- RFID Card Management Functions --------------------

/**
 * Lấy danh sách tất cả thẻ RFID
 * @returns {Promise<Array>} Danh sách thẻ RFID
 */
export async function layDanhSachThe() {
  const payload = { table: "pm_nc0003", func: "data" }
  return callApiWithAuth(payload)
}

/**
 * Thêm thẻ RFID mới
 * @param {Object} theRFID - Thông tin thẻ RFID
 * @param {string} theRFID.uidThe - UID của thẻ
 * @param {string} theRFID.loaiThe - Loại thẻ
 * @param {string} theRFID.trangThai - Trạng thái thẻ (mặc định: "1")
 * @returns {Promise<Object>} Kết quả thêm thẻ
 */
export async function themTheRFID(theRFID) {
  const payload = {
    table: "pm_nc0003",
    func: "add",
    uidThe: theRFID.uidThe,
    loaiThe: theRFID.loaiThe,
    trangThai: theRFID.trangThai || "1",
    // ngayPhatHanh sẽ được set tự động ở backend
  }
  return callApiWithAuth(payload)
}

/**
 * Cập nhật thẻ RFID
 * @param {Object} theRFID - Thông tin thẻ RFID cần cập nhật
 * @param {string} theRFID.uidThe - UID của thẻ
 * @param {string} theRFID.loaiThe - Loại thẻ
 * @param {string} theRFID.trangThai - Trạng thái thẻ
 * @param {string} [theRFID.ngayPhatHanh] - Ngày phát hành (optional)
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatTheRFID(theRFID) {
  const payload = {
    table: "pm_nc0003",
    func: "edit",
    uidThe: theRFID.uidThe,
    loaiThe: theRFID.loaiThe,
    trangThai: theRFID.trangThai,
    ngayPhatHanh: theRFID.ngayPhatHanh, // Optional, sẽ dùng ngày hiện tại nếu không có
  }
  return callApiWithAuth(payload)
}

/**
 * Xóa thẻ RFID
 * @param {string|Array<string>} uidThe - UID thẻ hoặc mảng UID thẻ cần xóa
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaTheRFID(uidThe) {
  const payload = {
    table: "pm_nc0003", 
    func: "delete",
    uidThe: uidThe,
  }
  return callApiWithAuth(payload)
}

/**
 * Tìm thẻ đang có phiên gửi xe
 * @param {string} uidThe - UID của thẻ
 * @returns {Promise<Array>} Thông tin thẻ và phiên gửi xe
 */
export async function timTheDangCoPhien(uidThe) {
  const payload = {
    table: "pm_nc0003",
    func: "timTheDangCoPhien", 
    uidThe: uidThe,
  }
  return callApiWithAuth(payload)
}

// -------------------- License Plate Recognition API --------------------

/**
 * Gửi ảnh biển số lên API nhận dạng
 * @param {Blob|File} imageBlob - Ảnh biển số dạng Blob hoặc File
 * @returns {Promise<Object>} - Kết quả nhận dạng biển số
 */
export async function nhanDangBienSo(imageBlob) {
  try {
    console.log("🚗 Bắt đầu nhận dạng biển số...", {
      blob: imageBlob,
      type: imageBlob.type,
      size: imageBlob.size,
      name: imageBlob.name || 'license_plate.jpg'
    })
    
    // Chỉ sử dụng FormData method vì server không hỗ trợ Base64
    return await nhanDangBienSoFormData(imageBlob)
    
  } catch (error) {
    console.error("❌ Lỗi nhận dạng biển số:", error)
    throw new Error(`Không thể nhận dạng biển số: ${error.message}`)
  }
}

/**
 * Gửi ảnh biển số lên API nhận dạng (phương pháp FormData)
 * @param {Blob|File} imageBlob - Ảnh biển số dạng Blob hoặc File
 * @returns {Promise<Object>} - Kết quả nhận dạng biển số
 */
async function nhanDangBienSoFormData(imageBlob) {
  console.log("📤 Trying FormData method...")
  
  // Tạo FormData để gửi file - khớp với Postman
  const formData = new FormData()
  
  // Đảm bảo file có đúng định dạng như Postman
  const file = new File([imageBlob], 'license_plate.jpg', {
    type: 'image/jpeg',
    lastModified: Date.now()
  })
  
  // API server mong đợi field tên là 'file' chứ không phải 'image'
  formData.append('file', file)
  
  // Log FormData để debug
  console.log("📤 FormData entries:")
  for (const [key, value] of formData.entries()) {
    console.log(`  ${key}:`, value instanceof File ? {
      name: value.name,
      type: value.type,
      size: value.size
    } : value)
  }
  
  const response = await fetch(api_BienSo, {
    method: 'POST',
    body: formData,
    // Không set Content-Type để browser tự động thêm boundary cho multipart/form-data
  })
  
  console.log("📡 Response status (FormData):", response.status)
  console.log("📡 Response headers:", Object.fromEntries(response.headers.entries()))
  
  if (!response.ok) {
    // Log response text để debug lỗi 422
    const errorText = await response.text()
    console.error("❌ API Error Response (FormData):", errorText)
    throw new Error(`HTTP error! status: ${response.status}, message: ${errorText}`)
  }
  
  const result = await response.json()
  console.log("✅ Kết quả nhận dạng biển số (FormData):", result)
  return result
}

/**
 * Convert blob/file to base64 string (utility function)
 * @param {Blob|File} blob - File blob
 * @returns {Promise<string>} - base64 string
 */
export function blobToBase64(blob) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader()
    reader.onload = () => resolve(reader.result)
    reader.onerror = reject
    reader.readAsDataURL(blob)
  })
}
