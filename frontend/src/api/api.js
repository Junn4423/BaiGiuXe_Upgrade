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
    bienSo: session.bienSo || "",
    viTriGui: session.viTriGui,
    chinhSach: session.chinhSach,
    congVao: session.congVao,
    gioVao: session.gioVao,
    anhVao: session.anhVao || "",
    anhMatVao: session.anhMatVao || "",
    trangThai: session.trangThai || "TRONG_BAI",
    camera_id: session.camera_id,
    plate_match: session.plate_match || 0,
    plate: session.plate || ""
  }
  // Remove undefined/null values to avoid API issues
  Object.keys(payload).forEach(key => {
    if (payload[key] === undefined || payload[key] === null) {
      delete payload[key]
    }
  })
  console.log("📤 Sending themPhienGuiXe payload:", payload)
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

//lay danh sach cong
export async function layDanhSachCong() {
  const payload = { table: "pm_nc0007", func: "data" }
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
 * @param {string} [theRFID.bienSoXe] - Biển số xe (optional)
 * @param {string} [theRFID.maChinhSach] - Mã chính sách (optional)
 * @param {string} [theRFID.ngayKetThucCS] - Ngày kết thúc chính sách (optional)
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatTheRFID(theRFID) {
  const payload = {
    table: "pm_nc0003",
    func: "edit",
    uidThe: theRFID.uidThe,
    loaiThe: theRFID.loaiThe,
    trangThai: theRFID.trangThai,
    ngayPhatHanh: theRFID.ngayPhatHanh,
    bienSoXe: theRFID.bienSoXe,
    maChinhSach: theRFID.maChinhSach,
    ngayKetThucCS: theRFID.ngayKetThucCS
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

// -------------------- Card History Management Functions --------------------
/**
 * Lấy nhật ký theo thẻ từ bảng pm_nc0010
 * @param {string} maThe - Mã thẻ RFID
 * @param {string} ngay - Ngày theo định dạng dd-mm-yyyy, hoặc "all" cho tất cả
 * @returns {Promise<Object>} Nhật ký phiên gửi xe
 */
export async function layNhatKyTheoThe(maThe, ngay = "all") {
  const payload = { 
    table: "pm_nc0010", 
    func: "layNhatKyTheoThe",
    maThe: maThe,
    ngay: ngay
  }
  return callApiWithAuth(payload)
}

// -------------------- Vehicle Search Functions --------------------
/**
 * Tìm phiên gửi xe theo biển số
 * @param {string} bienSo - Biển số xe
 * @returns {Promise<Array>} Danh sách phiên gửi xe
 */
export async function timPhienTheoBienSo(bienSo) {
  const payload = { 
    table: "pm_nc0009", 
    func: "timPhienTheoBienSo", 
    bienSo: bienSo 
  }
  return callApiWithAuth(payload)
}

// -------------------- Extended Parking Session Functions --------------------
/**
 * Cập nhật trạng thái phiên gửi xe thành "ĐANG GỬI"
 * @param {string} maPhien - Mã phiên gửi xe
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatTrangThaiDangGui(maPhien) {
  const payload = { 
    table: "pm_nc0009", 
    func: "edit_TrangThai", 
    maPhien: maPhien 
  }
  return callApiWithAuth(payload)
}

// -------------------- Gate Management Functions --------------------
/**
 * Thêm cổng mới
 * @param {Object} cong - Thông tin cổng
 * @returns {Promise<Object>} Kết quả thêm cổng
 */
export async function themCong(cong) {
  const payload = {
    table: "pm_nc0007",
    func: "add",
    maCong: cong.maCong,
    tenCong: cong.tenCong,
    loaiCong: cong.loaiCong,
    viTriLapDat: cong.viTriLapDat,
    maKhuVuc: cong.maKhuVuc
  }
  return callApiWithAuth(payload)
}

/**
 * Cập nhật thông tin cổng
 * @param {Object} cong - Thông tin cổng
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatCong(cong) {
  const payload = {
    table: "pm_nc0007",
    func: "edit",
    maCong: cong.maCong,
    tenCong: cong.tenCong,
    loaiCong: cong.loaiCong,
    viTriLapDat: cong.viTriLapDat,
    maKhuVuc: cong.maKhuVuc
  }
  return callApiWithAuth(payload)
}

/**
 * Xóa cổng
 * @param {string} maCong - Mã cổng
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaCong(maCong) {
  const payload = { 
    table: "pm_nc0007", 
    func: "delete", 
    maCong: maCong 
  }
  return callApiWithAuth(payload)
}

// -------------------- Extended Camera Functions --------------------
/**
 * Cập nhật URL RTSP của camera
 * @param {string} maCamera - Mã camera
 * @param {string} rtspUrl - URL RTSP mới
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatRTSPCamera(maCamera, rtspUrl) {
  const payload = {
    table: "pm_nc0006_2",
    func: "updateUrl",
    id: maCamera,
    data: { rtsp_url: rtspUrl }
  }
  return callApiWithAuth(payload)
}

// -------------------- Extended Zone Functions --------------------
/**
 * Lấy thông tin khu vực theo mã
 * @param {string} maKhuVuc - Mã khu vực
 * @returns {Promise<Object>} Thông tin khu vực
 */
export async function layKhuVucTheoMa(maKhuVuc) {
  const payload = {
    table: "pm_nc0004_2",
    func: "getById",
    maKhuVuc: maKhuVuc
  }
  return callApiWithAuth(payload)
}

// -------------------- Parking Spot Management Functions --------------------
/**
 * Lấy danh sách chỗ đỗ xe
 * @returns {Promise<Array>} Danh sách chỗ đỗ xe
 */
export async function layDanhSachChoDo() {
  const payload = { table: "pm_nc0005", func: "data" }
  return callApiWithAuth(payload)
}

/**
 * Thêm chỗ đỗ xe mới
 * @param {Object} choDo - Thông tin chỗ đỗ xe
 * @returns {Promise<Object>} Kết quả thêm chỗ đỗ xe
 */
export async function themChoDo(choDo) {
  const payload = {
    table: "pm_nc0005",
    func: "add",
    maChoDo: choDo.maChoDo,
    maKhuVuc: choDo.maKhuVuc,
    trangThai: choDo.trangThai || "TRONG"
  }
  return callApiWithAuth(payload)
}

/**
 * Cập nhật thông tin chỗ đỗ xe
 * @param {Object} choDo - Thông tin chỗ đỗ xe
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatChoDo(choDo) {
  const payload = {
    table: "pm_nc0005",
    func: "edit",
    maChoDo: choDo.maChoDo,
    maKhuVuc: choDo.maKhuVuc,
    trangThai: choDo.trangThai
  }
  return callApiWithAuth(payload)
}

/**
 * Xóa chỗ đỗ xe
 * @param {string} maChoDo - Mã chỗ đỗ xe
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaChoDo(maChoDo) {
  const payload = { 
    table: "pm_nc0005", 
    func: "delete", 
    maChoDo: maChoDo 
  }
  return callApiWithAuth(payload)
}

// -------------------- Vehicle Management Functions --------------------
/**
 * Lấy danh sách phương tiện
 * @returns {Promise<Array>} Danh sách phương tiện
 */
export async function layDanhSachPhuongTien() {
  const payload = { table: "pm_nc0002", func: "data" }
  return callApiWithAuth(payload)
}

/**
 * Thêm phương tiện mới
 * @param {Object} phuongTien - Thông tin phương tiện
 * @returns {Promise<Object>} Kết quả thêm phương tiện
 */
export async function themPhuongTien(phuongTien) {
  const payload = {
    table: "pm_nc0002",
    func: "add",
    bienSo: phuongTien.bienSo,
    maLoaiPT: phuongTien.maLoaiPT
  }
  return callApiWithAuth(payload)
}

/**
 * Cập nhật thông tin phương tiện
 * @param {Object} phuongTien - Thông tin phương tiện
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatPhuongTien(phuongTien) {
  const payload = {
    table: "pm_nc0002",
    func: "edit",
    bienSo: phuongTien.bienSo,
    maLoaiPT: phuongTien.maLoaiPT
  }
  return callApiWithAuth(payload)
}

/**
 * Xóa phương tiện
 * @param {string} bienSo - Biển số xe
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaPhuongTien(bienSo) {
  const payload = { 
    table: "pm_nc0002", 
    func: "delete", 
    bienSo: bienSo 
  }
  return callApiWithAuth(payload)
}

// -------------------- Extended RFID Card Functions --------------------
/**
 * Tìm thẻ từ UID
 * @param {string} uidThe - UID thẻ RFID
 * @returns {Promise<Array>} Thông tin thẻ
 */
export async function timTheTuUID(uidThe) {
  const payload = { 
    table: "pm_nc0003", 
    func: "timTheTuUID", 
    uidThe: uidThe 
  }
  return callApiWithAuth(payload)
}

/**
 * Xóa thẻ RFID
 * @param {string} uidThe - UID thẻ RFID
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaTheRFID(uidThe) {
  const payload = { 
    table: "pm_nc0003", 
    func: "delete", 
    uidThe: uidThe 
  }
  return callApiWithAuth(payload)
}

// -------------------- Advanced Pricing Functions --------------------
/**
 * Lấy danh sách chính sách giá theo table pm_nc0008 từ ngocchung.php
 * @returns {Promise<Array>} Danh sách chính sách giá
 */
export async function layDanhSachChinhSachGia() {
  const payload = { table: "pm_nc0008", func: "data" }
  return callApiWithAuth(payload)
}

/**
 * Thêm chính sách giá mới (từ kebao.php)
 * @param {Object} chinhSach - Thông tin chính sách giá
 * @returns {Promise<Object>} Kết quả thêm chính sách
 */
export async function themChinhSachGiaKebao(chinhSach) {
  const payload = {
    table: "pm_nc0008",
    func: "add",
    maChinhSach: chinhSach.maChinhSach,
    maLoaiPT: chinhSach.maLoaiPT,
    thoiGian: chinhSach.thoiGian,
    donGia: chinhSach.donGia,
    quaGio: chinhSach.quaGio,
    donGiaQuaGio: chinhSach.donGiaQuaGio,
    loaiChinhSach: chinhSach.loaiChinhSach,
    tongNgay: chinhSach.tongNgay
  }
  return callApiWithAuth(payload)
}

/**
 * Cập nhật chính sách giá (từ kebao.php)
 * @param {Object} chinhSach - Thông tin chính sách giá
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatChinhSachGiaKebao(chinhSach) {
  const payload = {
    table: "pm_nc0008",
    func: "edit",
    maChinhSach: chinhSach.maChinhSach,
    maLoaiPT: chinhSach.maLoaiPT,
    thoiGian: chinhSach.thoiGian,
    donGia: chinhSach.donGia,
    quaGio: chinhSach.quaGio,
    donGiaQuaGio: chinhSach.donGiaQuaGio,
    loaiChinhSach: chinhSach.loaiChinhSach,
    tongNgay: chinhSach.tongNgay
  }
  return callApiWithAuth(payload)
}

/**
 * Xóa chính sách giá (từ kebao.php)
 * @param {string} maChinhSach - Mã chính sách giá
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaChinhSachGiaKebao(maChinhSach) {
  const payload = { 
    table: "pm_nc0008", 
    func: "delete", 
    maChinhSach: maChinhSach 
  }
  return callApiWithAuth(payload)
}

// -------------------- Camera Management Functions (kebao.php) --------------------
/**
 * Lấy danh sách camera từ kebao.php
 * @returns {Promise<Array>} Danh sách camera
 */
export async function layDanhSachCameraKebao() {
  const payload = { table: "pm_nc0006_1", func: "data" }
  return callApiWithAuth(payload)
}

/**
 * Thêm camera mới (từ kebao.php)
 * @param {Object} camera - Thông tin camera
 * @returns {Promise<Object>} Kết quả thêm camera
 */
export async function themCameraKebao(camera) {
  const payload = {
    table: "pm_nc0006_1",
    func: "add",
    maCamera: camera.maCamera,
    tenCamera: camera.tenCamera,
    loaiCamera: camera.loaiCamera,
    chucNangCamera: camera.chucNangCamera,
    maKhuVuc: camera.maKhuVuc,
    linkRTSP: camera.linkRTSP
  }
  return callApiWithAuth(payload)
}

/**
 * Cập nhật camera (từ kebao.php)
 * @param {Object} camera - Thông tin camera
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatCameraKebao(camera) {
  const payload = {
    table: "pm_nc0006_1",
    func: "edit",
    maCamera: camera.maCamera,
    tenCamera: camera.tenCamera,
    loaiCamera: camera.loaiCamera,
    chucNangCamera: camera.chucNangCamera,
    maKhuVuc: camera.maKhuVuc,
    linkRTSP: camera.linkRTSP
  }
  return callApiWithAuth(payload)
}

/**
 * Xóa camera (từ kebao.php)
 * @param {string} maCamera - Mã camera
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaCameraKebao(maCamera) {
  const payload = { 
    table: "pm_nc0006_1", 
    func: "delete", 
    maCamera: maCamera 
  }
  return callApiWithAuth(payload)
}

// -------------------- Gate Management Functions (kebao.php) --------------------
/**
 * Lấy danh sách cổng từ kebao.php (pm_nc0007)
 * @returns {Promise<Array>} Danh sách cổng
 */
export async function layDanhSachCongKebao() {
  const payload = { table: "pm_nc0007", func: "data" }
  return callApiWithAuth(payload)
}

/**
 * Thêm cổng mới (từ kebao.php)
 * @param {Object} cong - Thông tin cổng
 * @returns {Promise<Object>} Kết quả thêm cổng
 */
export async function themCongKebao(cong) {
  const payload = {
    table: "pm_nc0007",
    func: "add",
    maCong: cong.maCong,
    tenCong: cong.tenCong,
    loaiCong: cong.loaiCong,
    viTriLapDat: cong.viTriLapDat,
    maKhuVuc: cong.maKhuVuc
  }
  return callApiWithAuth(payload)
}

/**
 * Cập nhật cổng (từ kebao.php)
 * @param {Object} cong - Thông tin cổng
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatCongKebao(cong) {
  const payload = {
    table: "pm_nc0007",
    func: "edit",
    maCong: cong.maCong,
    tenCong: cong.tenCong,
    loaiCong: cong.loaiCong,
    viTriLapDat: cong.viTriLapDat,
    maKhuVuc: cong.maKhuVuc
  }
  return callApiWithAuth(payload)
}

/**
 * Xóa cổng (từ kebao.php)
 * @param {string} maCong - Mã cổng
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaCongKebao(maCong) {
  const payload = { 
    table: "pm_nc0007", 
    func: "delete", 
    maCong: maCong 
  }
  return callApiWithAuth(payload)
}

// -------------------- Parking Session Functions (kebao.php) --------------------
/**
 * Lấy phiên gửi xe theo UID thẻ (từ kebao.php)
 * @param {string} uidThe - UID thẻ RFID
 * @returns {Promise<Array>} Danh sách phiên gửi xe
 */
export async function layPhienGuiXeTheoUIDKebao(uidThe) {
  const payload = { 
    table: "pm_nc0009", 
    func: "layPhienGuiXeTuUID", 
    uidThe: uidThe 
  }
  return callApiWithAuth(payload)
}

/**
 * Lấy phiên gửi xe đã ra theo UID thẻ (từ kebao.php)
 * @param {string} uidThe - UID thẻ RFID
 * @returns {Promise<Array>} Danh sách phiên gửi xe đã hoàn thành
 */
export async function layPhienGuiXeDaRaTheoUIDKebao(uidThe) {
  const payload = { 
    table: "pm_nc0009", 
    func: "layPhienGuiXeTuUID_Da_Ra", 
    uidThe: uidThe 
  }
  return callApiWithAuth(payload)
}

/**
 * Tìm phiên gửi xe theo biển số (từ kebao.php)
 * @param {string} bienSo - Biển số xe
 * @returns {Promise<Array>} Danh sách phiên gửi xe
 */
export async function timPhienTheoBS(bienSo) {
  const payload = { 
    table: "pm_nc0009", 
    func: "timPhienTheoBienSo", 
    bienSo: bienSo 
  }
  return callApiWithAuth(payload)
}

/**
 * Tạo bảng cho phiên làm việc (từ kebao.php)
 * @returns {Promise<Object>} Kết quả tạo bảng
 */
export async function taoBangChoPhienLamViecKebao() {
  const payload = { 
    table: "pm_nc0009", 
    func: "taoBangChoPhienLamViec" 
  }
  return callApiWithAuth(payload)
}

/**
 * Cập nhật trạng thái phiên gửi xe (từ kebao.php)
 * @param {string} maPhien - Mã phiên gửi xe
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatTrangThaiPhienKebao(maPhien) {
  const payload = { 
    table: "pm_nc0009", 
    func: "edit_TrangThai", 
    maPhien: maPhien 
  }
  return callApiWithAuth(payload)
}

// -------------------- Zone Management Functions (ngocchung.php) --------------------
/**
 * Lấy khu vực theo ID (từ ngocchung.php)
 * @param {string} maKhuVuc - Mã khu vực
 * @returns {Promise<Object>} Thông tin khu vực
 */
export async function layKhuVucTheoID(maKhuVuc) {
  const payload = { 
    table: "pm_nc0004_2", 
    func: "getById", 
    maKhuVuc: maKhuVuc 
  }
  return callApiWithAuth(payload)
}

/**
 * Thêm khu vực mới (từ ngocchung.php)
 * @param {Object} khuVuc - Thông tin khu vực
 * @returns {Promise<Object>} Kết quả thêm khu vực
 */
export async function themKhuVucNgocChung(khuVuc) {
  const payload = {
    table: "pm_nc0004_2",
    func: "add",
    maKhuVuc: khuVuc.maKhuVuc,
    tenKhuVuc: khuVuc.tenKhuVuc,
    moTa: khuVuc.moTa
  }
  return callApiWithAuth(payload)
}

/**
 * Cập nhật khu vực (từ ngocchung.php)
 * @param {Object} khuVuc - Thông tin khu vực
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatKhuVucNgocChung(khuVuc) {
  const payload = {
    table: "pm_nc0004_2",
    func: "edit",
    maKhuVuc: khuVuc.maKhuVuc,
    tenKhuVuc: khuVuc.tenKhuVuc,
    moTa: khuVuc.moTa
  }
  return callApiWithAuth(payload)
}

/**
 * Xóa khu vực (từ ngocchung.php)
 * @param {string} maKhuVuc - Mã khu vực
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaKhuVucNgocChung(maKhuVuc) {
  const payload = { 
    table: "pm_nc0004_2", 
    func: "delete", 
    maKhuVuc: maKhuVuc 
  }
  return callApiWithAuth(payload)
}

// -------------------- Camera URL Update Functions (ngocchung.php) --------------------
/**
 * Cập nhật URL RTSP của camera (từ ngocchung.php)
 * @param {string} id - ID camera
 * @param {string} rtspUrl - URL RTSP mới
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatURLCamera(id, rtspUrl) {
  const payload = {
    table: "pm_nc0006_2",
    func: "updateUrl",
    id: id,
    data: { rtsp_url: rtspUrl }
  }
  return callApiWithAuth(payload)
}

// -------------------- Pricing Policy Functions (ngocchung.php) --------------------
/**
 * Lấy tất cả chính sách giá (từ ngocchung.php)
 * @returns {Promise<Array>} Danh sách chính sách giá
 */
export async function layTatCaChinhSachGiaNgocChung() {
  const payload = { 
    table: "pm_nc0008", 
    func: "getAllPolicies" 
  }
  return callApiWithAuth(payload)
}

/**
 * Tạo chính sách giá mới (từ ngocchung.php)
 * @param {Object} policy - Thông tin chính sách giá
 * @returns {Promise<Object>} Kết quả tạo chính sách
 */
export async function taoChinhSachGiaNgocChung(policy) {
  const payload = {
    table: "pm_nc0008",
    func: "createPolicy",
    ...policy
  }
  return callApiWithAuth(payload)
}

/**
 * Cập nhật chính sách giá (từ ngocchung.php)
 * @param {Object} policy - Thông tin chính sách giá
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatChinhSachGiaNgocChung(policy) {
  const payload = {
    table: "pm_nc0008",
    func: "updatePolicy",
    ...policy
  }
  return callApiWithAuth(payload)
}

/**
 * Xóa chính sách giá (từ ngocchung.php)
 * @param {string} policyId - ID chính sách giá
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaChinhSachGiaNgocChung(policyId) {
  const payload = {
    table: "pm_nc0008",
    func: "deletePolicy",
    policyId: policyId
  }
  return callApiWithAuth(payload)
}

/**
 * Tính phí gửi xe (từ ngocchung.php)
 * @param {Object} data - Dữ liệu tính phí
 * @returns {Promise<Object>} Kết quả tính phí
 */
export async function tinhPhiGuiXeNgocChung(data) {
  const payload = {
    table: "pm_nc0008",
    func: "tinhPhiGuiXe",
    ...data
  }
  return callApiWithAuth(payload)
}

/**
 * Lấy chính sách từ phương tiện (từ ngocchung.php)
 * @param {string} maLoaiPT - Mã loại phương tiện
 * @returns {Promise<Object>} Chính sách giá
 */
export async function layChinhSachTuPTNgocChung(maLoaiPT) {
  const payload = {
    table: "pm_nc0008",
    func: "layChinhSachTuPT",
    maLoaiPT: maLoaiPT
  }
  return callApiWithAuth(payload)
}

// -------------------- History Functions (ngocchung.php) --------------------
/**
 * Lấy nhật ký theo thẻ (từ ngocchung.php)
 * @param {string} uidThe - UID thẻ RFID
 * @returns {Promise<Array>} Nhật ký thẻ
 */
export async function layNhatKyTheoTheNgocChung(uidThe) {
  const payload = {
    table: "pm_nc0010",
    func: "layNhatKyTheoThe",
    uidThe: uidThe
  }
  return callApiWithAuth(payload)
}
