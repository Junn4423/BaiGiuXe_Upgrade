// api.js - Chuyển đổi các hàm Python sang React (JS)
// Lưu ý: Cần chỉnh sửa urlApi cho đúng endpoint backend của bạn

import { api_BienSo, url_api, url_login_api } from "./url";

const urlApi = url_api; // Thay đổi cho đúng backend
const urlLoginApi = url_login_api;

// -------------------- Authentication helpers --------------------
let authCache = null; // Lưu token sau lần đăng nhập đầu tiên

async function getAuthToken(username = "admin", password = "1") {
  // Luôn lấy token mới để đảm bảo không bị expired
  console.log("Getting fresh auth token...");

  const payload = {
    txtUserName: username,
    txtPassword: password,
  };

  const res = await fetch(urlLoginApi, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload),
  });

  if (!res.ok) {
    throw new Error("Không thể đăng nhập để lấy token");
  }

  authCache = await res.json();
  console.log("Got auth token:", authCache);
  return authCache;
}

async function getAuthHeaders() {
  const authData = await getAuthToken();
  return {
    "Content-Type": "application/json",
    "X-USER-CODE": authData.code,
    "X-USER-TOKEN": authData.token,
  };
}

async function callApiWithAuth(payload) {
  console.log("Calling API with auth:", payload);
  const headers = await getAuthHeaders();
  console.log("Using headers:", headers);

  const res = await fetch(urlApi, {
    method: "POST",
    headers,
    body: JSON.stringify(payload),
  });

  const result = await handleApiResponse(res);
  console.log("API response:", result);
  return result;
}

function handleApiResponse(response) {
  if (!response.ok) {
    console.error("API response not ok:", response.status, response.statusText);
    throw new Error(`Network response was not ok: ${response.status}`);
  }

  return response.json().then((data) => {
    console.log("Raw API response:", data);

    if (typeof data === "object" && data.success === false) {
      throw new Error(data.message || "API error");
    }
    return data;
  });
}

// -------------------- API Functions --------------------

export async function layALLLoaiPhuongTien() {
  const payload = { table: "pm_nc0001", func: "data" };
  return callApiWithAuth(payload);
}

export async function themLoaiPhuongTien(loaiPhuongTien) {
  const payload = {
    table: "pm_nc0001",
    func: "add",
    maLoaiPT: loaiPhuongTien.maLoaiPT,
    tenLoaiPT: loaiPhuongTien.tenLoaiPT,
    moTa: loaiPhuongTien.moTa,
    loaiXe: loaiPhuongTien.loaiXe, 
  };
  return callApiWithAuth(payload);
}
// Cập nhật loại phương tiện
export async function capNhatLoaiPhuongTien(loaiPhuongTien) {
  const payload = {
    table: "pm_nc0001",
    func: "edit",
    maLoaiPT: loaiPhuongTien.maLoaiPT,
    tenLoaiPT: loaiPhuongTien.tenLoaiPT,
    moTa: loaiPhuongTien.moTa,
    loaiXe: loaiPhuongTien.loaiXe, 
  };
  return callApiWithAuth(payload);
}

// Xóa loại phương tiện
export async function xoaLoaiPhuongTien(maLoaiPT) {
  const payload = { table: "pm_nc0001", func: "delete", maLoaiPT };
  return callApiWithAuth(payload);
}

export async function layDanhSachCamera() {
  const payload = { table: "pm_nc0006_1", func: "data" };
  return callApiWithAuth(payload);
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
  };
  return callApiWithAuth(payload);
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
  };
  return callApiWithAuth(payload);
}

export async function xoaCamera(maCamera) {
  const payload = { table: "pm_nc0006_1", func: "delete", maCamera };
  return callApiWithAuth(payload);
}

// --- Thêm các hàm API còn lại chuyển từ Python sang JS ---

export async function layALLPhienGuiXe() {
  const payload = { table: "pm_nc0009", func: "data" };
  return callApiWithAuth(payload);
}

export async function themPhienGuiXe(session) {
  const payload = {
    table: "pm_nc0009",
    func: "add",
    uidThe: session.uidThe,
    bienSo: session.bienSo || "",
    chinhSach: session.chinhSach,
    congVao: session.congVao,
    gioVao: session.gioVao,
    anhVao: session.anhVao || "",
    anhMatVao: session.anhMatVao || "",
    trangThai: session.trangThai || "TRONG_BAI",
    camera_id: session.camera_id,
    plate_match: session.plate_match || 0,
    plate: session.plate || "",
  };

  // Kiểm tra loại xe để xử lý vị trí gửi
  // loaiXe = "0": không cần vị trí gửi (xe máy, xe đạp, ...)
  // loaiXe = "1": yêu cầu vị trí gửi (ô tô, xe tải, ...)
  if (session.loaiXe === "1" || session.loaiXe === 1) {
    // Chỉ thêm viTriGui khi loaiXe = 1 VÀ có dữ liệu viTriGui
    if (session.viTriGui !== undefined && session.viTriGui !== null) {
      payload.viTriGui = session.viTriGui;
      console.log("Loại xe = 1: Yêu cầu vị trí gửi:", session.viTriGui);
    } else {
      console.log("Loại xe = 1: Không có vị trí gửi được cung cấp");
    }
  } else if (session.loaiXe === "0" || session.loaiXe === 0) {
    // Loại xe = 0: không cần vị trí gửi, không thêm field viTriGui vào payload
    console.log("Loại xe = 0: Không cần vị trí gửi");
  } else {
    // Trường hợp không xác định loaiXe, không thêm viTriGui
    console.log("Loại xe không xác định, không thêm vị trí gửi");
  }

  // Remove undefined/null values to avoid API issues
  Object.keys(payload).forEach((key) => {
    if (payload[key] === undefined || payload[key] === null) {
      delete payload[key];
    }
  });

  console.log("📤 Sending themPhienGuiXe payload:", payload);
  console.log(
    "🔍 Loại xe:",
    session.loaiXe,
    "| Vị trí gửi:",
    payload.viTriGui || "Không có"
  );
  return callApiWithAuth(payload);
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
  };
  return callApiWithAuth(payload);
}

export async function loadPhienGuiXeTheoMaThe(maThe) {
  const payload = {
    table: "pm_nc0009",
    func: "layPhienGuiXeTuUID",
    uidThe: maThe,
  };
  return callApiWithAuth(payload);
}

export async function loadPhienGuiXeTheoMaThe_XeRa(maThe) {
  const payload = {
    table: "pm_nc0009",
    func: "layPhienGuiXeTuUID_Da_Ra",
    uidThe: maThe,
  };
  return callApiWithAuth(payload);
}

export async function taoBangChoPhienLamViec() {
  const payload = { table: "pm_nc0009", func: "taoBangChoPhienLamViec" };
  return callApiWithAuth(payload);
}

// export async function tinhPhiGuiXe(maPhien) {
//   const payload = { table: "pm_nc0008", func: "tinhPhiGuiXe", maPhien };
//   return callApiWithAuth(payload);
// }

export async function layChinhSachGiaTheoLoaiPT(maLoaiPT) {
  const payload = { table: "pm_nc0008", func: "layChinhSachTuPT", maLoaiPT };
  return callApiWithAuth(payload);
}

export async function themThe(uidThe, loaiThe, trangThai = "1") {
  // Wrapper function for backward compatibility
  return themTheRFID({ uidThe, loaiThe, trangThai });
}

// -------------------- Pricing Policy Functions --------------------
export async function layALLChinhSachGia() {
  const payload = { table: "pm_nc0008", func: "getAllPolicies" };
  const res = await callApiWithAuth(payload);
  return res.data || [];
}
// Alias for backward compatibility: original import in RfidManagerDialogClean.jsx expects layChinhSachGia
export { layALLChinhSachGia as layChinhSachGia };

// Additional aliases for RFID card functions used in RfidManagerDialogClean.jsx
export { capNhatTheRFID as capNhatThe };
export { xoaTheRFID as xoaThe };

export async function themChinhSachGia(chinhSach) {
  console.log("themChinhSachGia called with:", chinhSach);
  const payload = {
    table: "pm_nc0008",
    func: "createPolicy",
    policyData: chinhSach,
  };
  return callApiWithAuth(payload);
}

export async function capNhatChinhSachGia(maChinhSach, chinhSach) {
  console.log("capNhatChinhSachGia called with:", maChinhSach, chinhSach);
  const payload = {
    table: "pm_nc0008",
    func: "updatePolicy",
    policyId: maChinhSach,
    policyData: chinhSach,
  };
  return callApiWithAuth(payload);
}

export async function xoaChinhSachGia(maChinhSach) {
  console.log("xoaChinhSachGia called with:", maChinhSach);
  const payload = {
    table: "pm_nc0008",
    func: "deletePolicy",
    policyId: maChinhSach,
  };
  return callApiWithAuth(payload);
}

//lay danh sach cong
export async function layDanhSachCong() {
  const payload = { table: "pm_nc0007", func: "data" };
  return callApiWithAuth(payload);
}

// -------------------- Zone Management Functions --------------------
export async function layDanhSachKhuVuc() {
  const payload = { table: "pm_nc0004_2", func: "data" };
  return callApiWithAuth(payload);
}

export async function themKhuVuc(khuVuc) {
  const payload = {
    table: "pm_nc0004_2",
    func: "add",
    maKhuVuc: khuVuc.maKhuVuc,
    tenKhuVuc: khuVuc.tenKhuVuc,
    moTa: khuVuc.moTa || "",
  };
  return callApiWithAuth(payload);
}

export async function capNhatKhuVuc(khuVuc) {
  const payload = {
    table: "pm_nc0004_2",
    func: "edit",
    maKhuVuc: khuVuc.maKhuVuc,
    tenKhuVuc: khuVuc.tenKhuVuc,
    moTa: khuVuc.moTa,
  };
  return callApiWithAuth(payload);
}

export async function xoaKhuVuc(maKhuVuc) {
  const payload = { table: "pm_nc0004_2", func: "delete", maKhuVuc };
  return callApiWithAuth(payload);
}

export async function layDanhSachKhu() {
  const payload = { table: "pm_nc0004_1", func: "khu_vuc_camera_cong" };
  return callApiWithAuth(payload);
}

// --- Bổ sung các hàm API còn thiếu từ Python sang JS ---

export async function xoaPhienGuiXe(maPhien) {
  const payload = { table: "pm_nc0009", func: "delete", maPhien };
  return callApiWithAuth(payload);
}

// Force refresh auth token - để gọi khi cần làm mới token
export async function refreshAuthToken() {
  console.log("Forcing auth token refresh...");
  authCache = null; // Clear cache
  return await getAuthToken();
}

// -------------------- RFID Card Management Functions --------------------

/**
 * Lấy danh sách tất cả thẻ RFID
 * @returns {Promise<Array>} Danh sách thẻ RFID
 */
export async function layDanhSachThe() {
  const payload = { table: "pm_nc0003", func: "data" };
  return callApiWithAuth(payload);
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
  };
  return callApiWithAuth(payload);
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
    ngayKetThucCS: theRFID.ngayKetThucCS,
  };
  return callApiWithAuth(payload);
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
  };
  return callApiWithAuth(payload);
}

/**
 * Xóa thẻ RFID
 * @param {string} uidThe - UID của thẻ RFID cần xóa
 * @returns {Promise<Object>} Kết quả xóa thẻ
 */
export async function xoaTheRFID(uidThe) {
  const payload = {
    table: "pm_nc0003",
    func: "delete",
    uidThe: uidThe,
  };
  return callApiWithAuth(payload);
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
      name: imageBlob.name || "license_plate.jpg",
    });

    // Chỉ sử dụng FormData method vì server không hỗ trợ Base64
    return await nhanDangBienSoFormData(imageBlob);
  } catch (error) {
    console.error("❌ Lỗi nhận dạng biển số:", error);
    throw new Error(`Không thể nhận dạng biển số: ${error.message}`);
  }
}

/**
 * Gửi ảnh biển số lên API nhận dạng (phương pháp FormData)
 * @param {Blob|File} imageBlob - Ảnh biển số dạng Blob hoặc File
 * @returns {Promise<Object>} - Kết quả nhận dạng biển số
 */
async function nhanDangBienSoFormData(imageBlob) {
  console.log("📤 Trying FormData method...");

  // Tạo FormData để gửi file - khớp với Postman
  const formData = new FormData();

  // Đảm bảo file có đúng định dạng như Postman
  const file = new File([imageBlob], "license_plate.jpg", {
    type: "image/jpeg",
    lastModified: Date.now(),
  });

  // API server mong đợi field tên là 'file' chứ không phải 'image'
  formData.append("file", file);

  // Log FormData để debug
  console.log("📤 FormData entries:");
  for (const [key, value] of formData.entries()) {
    console.log(
      `  ${key}:`,
      value instanceof File
        ? {
            name: value.name,
            type: value.type,
            size: value.size,
          }
        : value
    );
  }

  const response = await fetch(api_BienSo, {
    method: "POST",
    body: formData,
    // Không set Content-Type để browser tự động thêm boundary cho multipart/form-data
  });

  console.log("📡 Response status (FormData):", response.status);
  console.log(
    "📡 Response headers:",
    Object.fromEntries(response.headers.entries())
  );

  if (!response.ok) {
    // Log response text để debug lỗi 422
    const errorText = await response.text();
    console.error("❌ API Error Response (FormData):", errorText);
    throw new Error(
      `HTTP error! status: ${response.status}, message: ${errorText}`
    );
  }

  const result = await response.json();
  console.log("✅ Kết quả nhận dạng biển số (FormData):", result);
  return result;
}

/**
 * Convert blob/file to base64 string (utility function)
 * @param {Blob|File} blob - File blob
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
    ngay: ngay,
  };
  return callApiWithAuth(payload);
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
    bienSo: bienSo,
  };
  return callApiWithAuth(payload);
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
    maPhien: maPhien,
  };
  return callApiWithAuth(payload);
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
    maKhuVuc: cong.maKhuVuc,
  };
  return callApiWithAuth(payload);
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
    maKhuVuc: cong.maKhuVuc,
  };
  return callApiWithAuth(payload);
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
    maCong: maCong,
  };
  return callApiWithAuth(payload);
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
    data: { rtsp_url: rtspUrl },
  };
  return callApiWithAuth(payload);
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
    maKhuVuc: maKhuVuc,
  };
  return callApiWithAuth(payload);
}

// -------------------- Parking Spot Management Functions --------------------
/**
 * Lấy danh sách chỗ đỗ xe
 * @returns {Promise<Array>} Danh sách chỗ đỗ xe
 */
export async function layDanhSachChoDo() {
  const payload = { table: "pm_nc0005", func: "data" };
  return callApiWithAuth(payload);
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
    trangThai: choDo.trangThai || "TRONG",
  };
  return callApiWithAuth(payload);
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
    trangThai: choDo.trangThai,
  };
  return callApiWithAuth(payload);
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
    maChoDo: maChoDo,
  };
  return callApiWithAuth(payload);
}

/**
 * Lấy danh sách chỗ đỗ xe theo khu vực
 * @param {string} maKhuVuc - Mã khu vực
 * @returns {Promise<Array>} Danh sách chỗ đỗ xe trong khu vực
 */
export async function layChoDauXeTheoKhu(maKhuVuc) {
  const payload = {
    table: "pm_nc0005",
    func: "loadChoDauXeTheoKhu",
    maKhuVuc: maKhuVuc,
  };
  return callApiWithAuth(payload);
}

/**
 * Đồng bộ hóa trạng thái chỗ đỗ xe
 * @returns {Promise<Object>} Kết quả đồng bộ
 */
export async function dongBoTrangThaiChoDo() {
  const payload = {
    table: "pm_nc0005",
    func: "sync_data",
  };
  return callApiWithAuth(payload);
}

/**
 * Thay đổi trạng thái chỗ đỗ
 * @param {string} maChoDo - Mã chỗ đỗ
 * @param {string} trangThai - Trạng thái mới (0/1)
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatTrangThaiChoDo(maChoDo, trangThai) {
  const payload = {
    table: "pm_nc0005",
    func: "chinhSuaTrangThai",
    maChoDo: maChoDo,
    trangThai: trangThai,
  };
  return callApiWithAuth(payload);
}

// -------------------- Vehicle Management Functions --------------------
/**
 * Lấy danh sách phương tiện
 * @returns {Promise<Array>} Danh sách phương tiện
 */
export async function layDanhSachPhuongTien() {
  const payload = { table: "pm_nc0002", func: "data" };
  return callApiWithAuth(payload);
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
    maLoaiPT: phuongTien.maLoaiPT,
  };
  return callApiWithAuth(payload);
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
    maLoaiPT: phuongTien.maLoaiPT,
  };
  return callApiWithAuth(payload);
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
    bienSo: bienSo,
  };
  return callApiWithAuth(payload);
}

// -------------------- Enhanced Pricing Policy Functions --------------------
/**
 * Lấy danh sách chính sách giá theo table pm_nc0008 từ ngocchung.php
 * @returns {Promise<Array>} Danh sách chính sách giá
 */
export async function layDanhSachChinhSachGia() {
  const payload = { table: "pm_nc0008", func: "data" };
  return callApiWithAuth(payload);
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
    tongNgay: chinhSach.tongNgay,
  };
  return callApiWithAuth(payload);
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
    tongNgay: chinhSach.tongNgay,
  };
  return callApiWithAuth(payload);
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
    maChinhSach: maChinhSach,
  };
  return callApiWithAuth(payload);
}

// -------------------- Camera Management Functions (kebao.php) --------------------
/**
 * Lấy danh sách camera từ kebao.php
 * @returns {Promise<Array>} Danh sách camera
 */
export async function layDanhSachCameraKebao() {
  const payload = { table: "pm_nc0006_1", func: "data" };
  return callApiWithAuth(payload);
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
    linkRTSP: camera.linkRTSP,
  };
  return callApiWithAuth(payload);
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
    linkRTSP: camera.linkRTSP,
  };
  return callApiWithAuth(payload);
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
    maCamera: maCamera,
  };
  return callApiWithAuth(payload);
}

// -------------------- Gate Management Functions (kebao.php) --------------------
/**
 * Lấy danh sách cổng từ kebao.php (pm_nc0007)
 * @returns {Promise<Array>} Danh sách cổng
 */
export async function layDanhSachCongKebao() {
  const payload = { table: "pm_nc0007", func: "data" };
  return callApiWithAuth(payload);
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
    maKhuVuc: cong.maKhuVuc,
  };
  return callApiWithAuth(payload);
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
    maKhuVuc: cong.maKhuVuc,
  };
  return callApiWithAuth(payload);
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
    maCong: maCong,
  };
  return callApiWithAuth(payload);
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
    uidThe: uidThe,
  };
  return callApiWithAuth(payload);
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
    uidThe: uidThe,
  };
  return callApiWithAuth(payload);
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
    bienSo: bienSo,
  };
  return callApiWithAuth(payload);
}

/**
 * Tạo bảng cho phiên làm việc (từ kebao.php)
 * @returns {Promise<Object>} Kết quả tạo bảng
 */
export async function taoBangChoPhienLamViecKebao() {
  const payload = {
    table: "pm_nc0009",
    func: "taoBangChoPhienLamViec",
  };
  return callApiWithAuth(payload);
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
    maPhien: maPhien,
  };
  return callApiWithAuth(payload);
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
    maKhuVuc: maKhuVuc,
  };
  return callApiWithAuth(payload);
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
    moTa: khuVuc.moTa,
  };
  return callApiWithAuth(payload);
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
    moTa: khuVuc.moTa,
  };
  return callApiWithAuth(payload);
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
    maKhuVuc: maKhuVuc,
  };
  return callApiWithAuth(payload);
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
    data: { rtsp_url: rtspUrl },
  };
  return callApiWithAuth(payload);
}

// -------------------- Pricing Policy Functions (ngocchung.php) --------------------
/**
 * Lấy tất cả chính sách giá (từ ngocchung.php)
 * @returns {Promise<Array>} Danh sách chính sách giá
 */
export async function layTatCaChinhSachGiaNgocChung() {
  const payload = {
    table: "pm_nc0008",
    func: "getAllPolicies",
  };
  return callApiWithAuth(payload);
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
    ...policy,
  };
  return callApiWithAuth(payload);
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
    ...policy,
  };
  return callApiWithAuth(payload);
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
    policyId: policyId,
  };
  return callApiWithAuth(payload);
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
    ...data,
  };
  return callApiWithAuth(payload);
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
    maLoaiPT: maLoaiPT,
  };
  return callApiWithAuth(payload);
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
    uidThe: uidThe,
  };
  return callApiWithAuth(payload);
}

// -------------------- Enhanced RFID Card Functions (từ mobile app) --------------------

/**
 * Thêm thẻ RFID với đầy đủ thông tin (theo mobile app)
 * @param {string} uidThe - UID thẻ RFID
 * @param {string} loaiThe - Loại thẻ (KHACH, VIP, NHANVIEN)
 * @param {string} trangThai - Trạng thái thẻ (mặc định: "1")
 * @param {string} bienSoXe - Biển số xe (optional)
 * @param {string} maChinhSach - Mã chính sách (optional)
 * @param {string} ngayKetThucCS - Ngày kết thúc chính sách (optional)
 * @returns {Promise<Object>} Kết quả thêm thẻ
 */
export async function themTheMobile(
  uidThe,
  loaiThe,
  trangThai = "1",
  bienSoXe = "",
  maChinhSach = "",
  ngayKetThucCS = ""
) {
  const payload = {
    table: "pm_nc0003",
    func: "add",
    uidThe: uidThe,
    loaiThe: loaiThe,
    trangThai: trangThai,
    bienSoXe: bienSoXe,
    maChinhSach: maChinhSach,
    ngayKetThucCS: ngayKetThucCS,
  };
  return callApiWithAuth(payload);
}

/**
 * Lấy thông tin thẻ RFID theo UID (theo mobile app)
 * @param {string} uidThe - UID thẻ RFID
 * @returns {Promise<Array>} Thông tin thẻ
 */
export async function layTheRFIDTheoUID(uidThe) {
  const payload = {
    table: "pm_nc0003",
    func: "timTheTuUID",
    uidThe: uidThe,
  };
  return callApiWithAuth(payload);
}

/**
 * Cập nhật thẻ RFID theo mobile app
 * @param {Object} theRFID - Thông tin thẻ RFID
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatTheRFIDMobile(theRFID) {
  const payload = {
    table: "pm_nc0003",
    func: "edit",
    uidThe: theRFID.uidThe,
    loaiThe: theRFID.loaiThe,
    trangThai: theRFID.trangThai,
    bienSoXe: theRFID.bienSoXe || "",
    maChinhSach: theRFID.maChinhSach || "",
    ngayKetThucCS: theRFID.ngayKetThucCS || "",
    // ngayPhatHanh sẽ được giữ nguyên ở backend
  };
  return callApiWithAuth(payload);
}

/**
 * Lấy tất cả thẻ RFID (theo mobile app)
 * @returns {Promise<Array>} Danh sách thẻ RFID
 */
export async function layTatCaTheRFID() {
  return layDanhSachThe(); // Sử dụng function có sẵn
}

/**
 * Lấy thông tin thẻ đang có xe gửi (theo mobile app)
 * @param {string} uidThe - UID thẻ RFID
 * @returns {Promise<Array>} Thông tin thẻ và phiên gửi xe
 */
export async function thongTinTheDangCoXeGui(uidThe) {
  return timTheDangCoPhien(uidThe); // Sử dụng function có sẵn
}

// -------------------- Enhanced Pricing Policy Functions (Mobile App Standard) --------------------
/**
 * Lấy danh sách tất cả chính sách giá (theo chuẩn mobile app)
 * @returns {Promise<Array>} Danh sách chính sách giá
 */
export async function layAllChinhSach() {
  const payload = { table: "pm_nc0008", func: "data" };
  return callApiWithAuth(payload);
}

/**
 * Thêm chính sách giá mới (theo chuẩn mobile app)
 * @param {Object} chinhSach - Thông tin chính sách giá
 * @returns {Promise<Object>} Kết quả thêm chính sách
 */
export async function themChinhSach(chinhSach) {
  const payload = {
    table: "pm_nc0008",
    func: "add",
    maChinhSach: chinhSach.maChinhSach,
    maLoaiPT: chinhSach.maLoaiPT,
    thoiGian: chinhSach.thoiGian,
    donGia: chinhSach.donGia,
    quaGio: chinhSach.quaGio || 0,
    donGiaQuaGio: chinhSach.donGiaQuaGio || 0,
    loaiChinhSach: chinhSach.loaiChinhSach || "",
    tongNgay: chinhSach.tongNgay || 0,
  };
  return callApiWithAuth(payload);
}

/**
 * Cập nhật chính sách giá (theo chuẩn mobile app)
 * @param {Object} chinhSach - Thông tin chính sách giá
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function suaChinhSach(chinhSach) {
  const payload = {
    table: "pm_nc0008",
    func: "edit",
    maChinhSach: chinhSach.maChinhSach,
    maLoaiPT: chinhSach.maLoaiPT,
    thoiGian: chinhSach.thoiGian,
    donGia: chinhSach.donGia,
    quaGio: chinhSach.quaGio || 0,
    donGiaQuaGio: chinhSach.donGiaQuaGio || 0,
    loaiChinhSach: chinhSach.loaiChinhSach || "",
    tongNgay: chinhSach.tongNgay || 0,
  };
  return callApiWithAuth(payload);
}

/**
 * Xóa chính sách giá (theo chuẩn mobile app)
 * @param {string} maChinhSach - Mã chính sách giá
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaChinhSach(maChinhSach) {
  const payload = {
    table: "pm_nc0008",
    func: "delete",
    maChinhSach: maChinhSach,
  };
  return callApiWithAuth(payload);
}

/**
 * Tính toán ngày kết thúc chính sách VIP
 * @param {string} startDate - Ngày bắt đầu (YYYY-MM-DD)
 * @param {number} tongNgay - Tổng số ngày
 * @returns {string} Ngày kết thúc (YYYY-MM-DD)
 */
export function tinhNgayKetThucChinhSach(startDate, tongNgay) {
  if (!startDate || !tongNgay || tongNgay <= 0) {
    return "";
  }

  const start = new Date(startDate);
  if (isNaN(start.getTime())) {
    return "";
  }

  const endDate = new Date(start);
  endDate.setDate(start.getDate() + tongNgay - 1); // -1 vì bao gồm ngày bắt đầu

  return endDate.toISOString().split("T")[0]; // Format YYYY-MM-DD
}

/**
 * Tạo mã chính sách tự động theo cấu hình
 * @param {string} maLoaiPT - Mã loại phương tiện
 * @param {string} loaiChinhSach - Loại chính sách (NGAY, THANG, NAM)
 * @param {number} soLuong - Số lượng (1 ngày, 3 tháng, 1 năm)
 * @returns {string} Mã chính sách tự động
 */
export function taoMaChinhSachTuDong(maLoaiPT, loaiChinhSach, soLuong) {
  if (!maLoaiPT || !loaiChinhSach || !soLuong) {
    return "";
  }

  // Đồng bộ với mobile app - sử dụng policyType value trực tiếp
  const typeCode =
    {
      N: "N", // Ngày
      T: "T", // Tuần
      Th: "Th", // Tháng
      NAM: "NAM", // Năm
    }[loaiChinhSach] || "N";

  const vehicleCode = maLoaiPT.toUpperCase().replace(/\s/g, "_");
  return `CS_${vehicleCode}_${soLuong}${typeCode}`;
}

/**
 * Tính tổng số ngày từ loại chính sách và số lượng
 * @param {string} loaiChinhSach - Loại chính sách (NGAY, THANG, NAM)
 * @param {number} soLuong - Số lượng
 * @returns {number} Tổng số ngày
 */
export function tinhTongNgay(loaiChinhSach, soLuong) {
  // Đồng bộ với mobile app
  const multiplier =
    {
      N: 1, // Ngày
      T: 7, // Tuần
      Th: 30, // Tháng
      NAM: 365, // Năm
    }[loaiChinhSach] || 1;

  return soLuong * multiplier;
}

/**
 * Lấy danh sách chính sách theo chuẩn backend pm_nc0008
 * @returns {Promise<Array>} Danh sách chính sách với đầy đủ thông tin
 */
export async function layDanhSachChinhSachGiaV2() {
  const payload = { table: "pm_nc0008", func: "getAllPolicies" };
  try {
    const response = await callApiWithAuth(payload);
    if (response && response.success && response.data) {
      // Map data để đảm bảo format đúng
      return response.data.map((policy) => ({
        maChinhSach: policy.lv001,
        maLoaiPT: policy.lv002,
        thoiGian: parseInt(policy.lv003) || 0,
        donGia: parseFloat(policy.lv004) || 0,
        quaGio: parseInt(policy.lv005) || 0,
        donGiaQuaGio: parseFloat(policy.lv006) || 0,
        loaiChinhSach: policy.lv007 || "",
        tongNgay: parseInt(policy.lv008) || 0,
      }));
    }
    return [];
  } catch (error) {
    console.error("Lỗi layDanhSachChinhSachGiaV2:", error);
    throw error;
  }
}

/**
 * Thêm chính sách giá mới (backend pm_nc0008)
 * @param {Object} chinhSach - Thông tin chính sách
 * @returns {Promise<Object>} Kết quả thêm
 */
export async function themChinhSachV2(chinhSach) {
  const payload = {
    table: "pm_nc0008",
    func: "createPolicy",
    policyData: {
      lv001: chinhSach.maChinhSach,
      lv002: chinhSach.maLoaiPT,
      lv003: chinhSach.thoiGian,
      lv004: chinhSach.donGia,
      lv005: chinhSach.quaGio,
      lv006: chinhSach.donGiaQuaGio,
      lv007: chinhSach.loaiChinhSach,
      lv008: chinhSach.tongNgay,
    },
  };
  console.log("themChinhSachV2 - Payload gửi đi:", payload);
  console.log(
    "themChinhSachV2 - tongNgay value:",
    chinhSach.tongNgay,
    "type:",
    typeof chinhSach.tongNgay
  );
  return callApiWithAuth(payload);
}

/**
 * Cập nhật chính sách giá (backend pm_nc0008)
 * @param {Object} chinhSach - Thông tin chính sách
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function suaChinhSachV2(chinhSach) {
  const payload = {
    table: "pm_nc0008",
    func: "updatePolicy",
    policyId: chinhSach.maChinhSach,
    policyData: {
      lv001: chinhSach.maChinhSach,
      lv002: chinhSach.maLoaiPT,
      lv003: chinhSach.thoiGian,
      lv004: chinhSach.donGia,
      lv005: chinhSach.quaGio,
      lv006: chinhSach.donGiaQuaGio,
      lv007: chinhSach.loaiChinhSach,
      lv008: chinhSach.tongNgay,
    },
  };
  console.log("suaChinhSachV2 - Payload gửi đi:", payload);
  console.log(
    "suaChinhSachV2 - tongNgay value:",
    chinhSach.tongNgay,
    "type:",
    typeof chinhSach.tongNgay
  );
  return callApiWithAuth(payload);
}

/**
 * Xóa chính sách giá (backend pm_nc0008)
 * @param {string} maChinhSach - Mã chính sách
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaChinhSachV2(maChinhSach) {
  const payload = {
    table: "pm_nc0008",
    func: "deletePolicy",
    policyId: maChinhSach,
  };
  return callApiWithAuth(payload);
}

// ==================== Camera Management Advanced Functions ====================

/**
 * Kiểm tra trạng thái hoạt động của camera (online/offline)
 * @param {string} maCamera - Mã camera cần kiểm tra
 * @returns {Promise<Object>} Trạng thái camera
 */
export async function kiemTraTrangThaiCamera(maCamera) {
  const payload = {
    table: "pm_nc0006_1",
    func: "checkStatus",
    maCamera: maCamera,
  };
  return callApiWithAuth(payload);
}

/**
 * Lấy danh sách camera theo khu vực
 * @param {string} maKhuVuc - Mã khu vực
 * @returns {Promise<Array>} Danh sách camera trong khu vực
 */
export async function layDanhSachCameraTheoKhuVuc(maKhuVuc) {
  const payload = {
    table: "pm_nc0006_1",
    func: "getByArea",
    maKhuVuc: maKhuVuc,
  };
  return callApiWithAuth(payload);
}

/**
 * Cập nhật link RTSP của camera
 * @param {string} maCamera - Mã camera
 * @param {string} linkRTSP - Link RTSP mới
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatLinkCamera(maCamera, linkRTSP) {
  const payload = {
    table: "pm_nc0006_1",
    func: "updateRTSP",
    maCamera: maCamera,
    linkRTSP: linkRTSP,
  };
  return callApiWithAuth(payload);
}

/**
 * Lấy danh sách camera theo loại (vào/ra)
 * @param {string} chucNangCamera - Chức năng camera (vào/ra)
 * @returns {Promise<Array>} Danh sách camera theo chức năng
 */
export async function layDanhSachCameraTheoLoai(chucNangCamera) {
  const payload = {
    table: "pm_nc0006_1",
    func: "getByFunction",
    chucNangCamera: chucNangCamera,
  };
  return callApiWithAuth(payload);
}

/**
 * Kiểm tra trạng thái tất cả camera
 * @returns {Promise<Array>} Trạng thái tất cả camera
 */
export async function kiemTraTrangThaiTatCaCamera() {
  const payload = {
    table: "pm_nc0006_1",
    func: "checkAllStatus",
  };
  return callApiWithAuth(payload);
}

/**
 * Tạo URL RTSP đầy đủ từ thông tin camera
 * @param {Object} camera - Thông tin camera
 * @returns {string} URL RTSP đầy đủ
 */
export function taoURLRTSP(camera) {
  if (!camera.linkRTSP) return "";

  // Nếu đã có protocol thì trả về như cũ
  if (camera.linkRTSP.startsWith("rtsp://")) {
    return camera.linkRTSP;
  }

  // Tạo URL RTSP đầy đủ
  return `rtsp://${camera.linkRTSP}`;
}

/**
 * Test kết nối RTSP của camera
 * @param {string} rtspUrl - URL RTSP cần test
 * @returns {Promise<Object>} Kết quả test kết nối
 */
export async function testKetNoiRTSP(rtspUrl) {
  try {
    // Tạo một video element để test stream
    const video = document.createElement("video");
    video.src = rtspUrl;
    video.muted = true;

    return new Promise((resolve) => {
      const timeout = setTimeout(() => {
        resolve({
          success: false,
          message: "Timeout - không thể kết nối trong 5 giây",
          url: rtspUrl,
        });
      }, 5000);

      video.onloadstart = () => {
        clearTimeout(timeout);
        resolve({
          success: true,
          message: "Kết nối RTSP thành công",
          url: rtspUrl,
        });
      };

      video.onerror = (error) => {
        clearTimeout(timeout);
        resolve({
          success: false,
          message: `Lỗi kết nối RTSP: ${error.message || "Unknown error"}`,
          url: rtspUrl,
        });
      };
    });
  } catch (error) {
    return {
      success: false,
      message: `Lỗi test RTSP: ${error.message}`,
      url: rtspUrl,
    };
  }
}

/**
 * Lấy thống kê camera (tổng số, online, offline)
 * @returns {Promise<Object>} Thống kê camera
 */
export async function layThongKeCamera() {
  const payload = {
    table: "pm_nc0006_1",
    func: "getStatistics",
  };
  return callApiWithAuth(payload);
}

/**
 * Cập nhật cấu hình camera (độ phân giải, FPS, etc.)
 * @param {string} maCamera - Mã camera
 * @param {Object} cauHinh - Cấu hình camera
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatCauHinhCamera(maCamera, cauHinh) {
  const payload = {
    table: "pm_nc0006_1",
    func: "updateConfig",
    maCamera: maCamera,
    ...cauHinh,
  };
  return callApiWithAuth(payload);
}

/**
 * Lấy lịch sử hoạt động của camera
 * @param {string} maCamera - Mã camera
 * @param {string} tuNgay - Từ ngày (YYYY-MM-DD)
 * @param {string} denNgay - Đến ngày (YYYY-MM-DD)
 * @returns {Promise<Array>} Lịch sử hoạt động
 */
export async function layLichSuCamera(maCamera, tuNgay, denNgay) {
  const payload = {
    table: "pm_nc0006_1",
    func: "getHistory",
    maCamera: maCamera,
    tuNgay: tuNgay,
    denNgay: denNgay,
  };
  return callApiWithAuth(payload);
}

/**
 * Phân loại camera theo cổng vào/ra và trạng thái
 * @returns {Promise<Object>} Camera được phân loại theo cổng và trạng thái
 */
export async function phanLoaiCameraTheoTrangThai() {
  try {
    const danhSachCamera = await layDanhSachCamera();
    const trangThaiTatCa = await kiemTraTrangThaiTatCaCamera();

    const ketQua = {
      cameraVao: [],
      cameraRa: [],
      cameraOnline: [],
      cameraOffline: [],
      tongSo: danhSachCamera.length || 0,
    };

    if (Array.isArray(danhSachCamera)) {
      danhSachCamera.forEach((camera) => {
        // Phân loại theo chức năng
        if (
          camera.chucNangCamera === "vào" ||
          camera.chucNangCamera === "Vào"
        ) {
          ketQua.cameraVao.push(camera);
        } else if (
          camera.chucNangCamera === "ra" ||
          camera.chucNangCamera === "Ra"
        ) {
          ketQua.cameraRa.push(camera);
        }

        // Phân loại theo trạng thái (giả định có thông tin trạng thái)
        const trangThai = trangThaiTatCa?.find(
          (t) => t.maCamera === camera.maCamera
        );
        if (trangThai?.online) {
          ketQua.cameraOnline.push(camera);
        } else {
          ketQua.cameraOffline.push(camera);
        }
      });
    }

    return ketQua;
  } catch (error) {
    console.error("Lỗi phân loại camera:", error);
    return {
      cameraVao: [],
      cameraRa: [],
      cameraOnline: [],
      cameraOffline: [],
      tongSo: 0,
      error: error.message,
    };
  }
}

/**
 * Lấy danh sách phiên gửi xe với thông tin vị trí đỗ xe (lv004)
 * @returns {Promise<Array>} Danh sách phiên gửi xe với vị trí đỗ
 */
export async function layPhienGuiXeCoViTri() {
  const payload = {
    table: "pm_nc0009",
    func: "data",
    includeViTri: true, // Flag để đảm bảo lv004 được bao gồm
  };
  const result = await callApiWithAuth(payload);

  // Đảm bảo mapping đúng từ database response
  if (Array.isArray(result)) {
    return result.map((phien) => ({
      ...phien,
      viTriGui: phien.lv004 || phien.viTriGui, // Map lv004 to viTriGui
      // Các field khác giữ nguyên
      maPhien: phien.maPhien || phien.lv001,
      uidThe: phien.uidThe || phien.lv002,
      bienSo: phien.bienSo || phien.lv003,
      chinhSach: phien.chinhSach || phien.lv005,
      congVao: phien.congVao || phien.lv006,
      gioVao: phien.gioVao || phien.lv007,
      anhVao: phien.anhVao || phien.lv008,
      anhMatVao: phien.anhMatVao || phien.lv009,
      congRa: phien.congRa || phien.lv010,
      gioRa: phien.gioRa || phien.lv011,
      anhRa: phien.anhRa || phien.lv012,
      anhMatRa: phien.anhMatRa || phien.lv013,
      trangThai: phien.trangThai || phien.lv014,
    }));
  }

  return result;
}

/**
 * Tạo nhật ký quét thẻ với thời gian từ frontend
 * @param {Object} scanLogData - Dữ liệu nhật ký quét thẻ
 * @param {string} scanLogData.sessionId - Mã phiên gửi xe
 * @param {string} scanLogData.cameraId - Mã camera
 * @param {string} scanLogData.scanTime - Thời gian quét (từ client)
 * @param {string} scanLogData.imagePath - Đường dẫn ảnh
 * @param {number} scanLogData.plateMatch - Khớp biển số (0/1)
 * @param {string} scanLogData.direction - Hướng quét ('entry'/'exit')
 * @returns {Promise<Object>} Kết quả tạo nhật ký
 */
export async function themNhatKyQuetTheVoiThoiGian(scanLogData) {
  const payload = {
    table: "pm_nc0010",
    func: "addWithClientTime",
    sessionId: scanLogData.sessionId,
    cameraId: scanLogData.cameraId,
    clientTime: scanLogData.scanTime,
    imagePath: scanLogData.imagePath,
    plateMatch: scanLogData.plateMatch || 0,
    direction: scanLogData.direction || 'entry'
  };
  return callApiWithAuth(payload);
}

// Hàm mới để kiểm tra xem thẻ có được miễn phí không
export const kiemTraMienPhiTheoThe = async (uidThe) => {
    if (!uidThe) {
        console.error("UID thẻ là bắt buộc");
        return false; // Giả định không được miễn phí nếu không có UID
    }
    try {
        // Gọi API để lấy thông tin thẻ theo UID
        const response = await callApiWithAuth({
            table: 'pm_nc0003',
            func: 'timTheTuUID',
            uidThe: uidThe
        });
        // API trả về một mảng, ta lấy phần tử đầu tiên
        if (response.data && response.data.length > 0) {
            const cardInfo = response.data[0];
            // Nếu loaiThe không phải là "KHACH" thì miễn phí
            return cardInfo.loaiThe !== 'KHACH';
        }
        return false; // Mặc định không miễn phí nếu không tìm thấy thẻ
    } catch (error) {
        console.error('Lỗi khi kiểm tra miễn phí theo thẻ:', error);
        // Trong trường hợp lỗi, an toàn nhất là giả định không được miễn phí
        return false;
    }
};


// Hàm tính phí gửi xe
export const tinhPhiGuiXe = async (maPhien, uidThe = null) => {
    try {
        // B1: Nếu có uidThe, kiểm tra xem thẻ có được miễn phí không
        if (uidThe) {
            const isFree = await kiemTraMienPhiTheoThe(uidThe);
            
            // B2: Nếu được miễn phí, trả về phí là 0
            if (isFree) {
                console.log(`Thẻ ${uidThe} được miễn phí.`);
                return {
                    success: true,
                    phi: 0,
                    tongPhut: 0,
                    message: "Thẻ thuộc đối tượng miễn phí."
                };
            }
            console.log(`Thẻ ${uidThe} không được miễn phí, tiến hành tính phí cho phiên ${maPhien}.`);
        } else {
            console.log(`Không có uidThe, tiến hành tính phí trực tiếp cho phiên ${maPhien}.`);
        }

        // B3: Tiếp tục quy trình tính phí từ backend
        const payload = { table: "pm_nc0008", func: "tinhPhiGuiXe", maPhien };
        const response = await callApiWithAuth(payload);
        
        // Ensure response format matches what VehicleInfoComponent expects
        if (response && response.data) {
            return {
                success: true,
                phi: response.data.phi || response.data.fee || 0,
                tongPhut: response.data.tongPhut || response.data.totalMinutes || 0,
                message: response.data.message || "Tính phí thành công"
            };
        } else {
            return {
                success: false,
                phi: 0,
                tongPhut: 0,
                message: "Không có dữ liệu phí từ server"
            };
        }
    } catch (error) {
        console.error('Lỗi khi tính phí gửi xe:', error);
        return {
            success: false,
            phi: 0,
            tongPhut: 0,
            message: error.message || "Lỗi tính phí"
        };
    }
};
