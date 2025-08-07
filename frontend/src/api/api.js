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
    loaiXe: session.loaiXe || "0", // Thêm loaiXe vào payload
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
  const payload = { table: "pm_nc0004_1", func: "data" };
  return callApiWithAuth(payload);
}

export async function themKhuVuc(khuVuc) {
  const payload = {
    table: "pm_nc0004_1",
    func: "add",
    maKhuVuc: khuVuc.maKhuVuc,
    tenKhuVuc: khuVuc.tenKhuVuc,
    moTa: khuVuc.moTa || "",
  };
  return callApiWithAuth(payload);
}

export async function capNhatKhuVuc(khuVuc) {
  const payload = {
    table: "pm_nc0004_1",
    func: "edit",
    maKhuVuc: khuVuc.maKhuVuc,
    tenKhuVuc: khuVuc.tenKhuVuc,
    moTa: khuVuc.moTa,
  };
  return callApiWithAuth(payload);
}

export async function xoaKhuVuc(maKhuVuc) {
  const payload = { table: "pm_nc0004_1", func: "delete", maKhuVuc };
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

  const response = await Promise.race([
    fetch(api_BienSo, {
      method: "POST",
      body: formData,
      // Không set Content-Type để browser tự động thêm boundary cho multipart/form-data
    }),
    new Promise((_, reject) => 
      setTimeout(() => reject(new Error("License plate API timeout (1 second)")), 1000)
    )
  ]);

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

// -------------------- DIRECT FOLDER Image Upload API (MinIO Disabled) --------------------

/**
 * Upload image to direct folder storage with automatic date-based directory structure
 * @param {Blob|File} imageBlob - Image file to upload
 * @param {string} prefix - Filename prefix (license_plate, license_plate_out, khuon_mat, etc.)
 * @param {Object} options - Additional options (for future compatibility)
 * @param {string} options.sessionId - Session ID for database update
 * @param {string} options.updateType - Type of update (plate_in, plate_out, face_in, face_out)
 * @returns {Promise<Object>} - Upload results from direct folder storage
 */
export async function uploadImageToLocal(imageBlob, prefix = 'image', options = {}) {
  try {
    console.log('🔄 Starting image upload...', {
      blob: imageBlob,
      type: imageBlob.type,
      size: imageBlob.size,
      prefix: prefix,
      options: options
    });

    // Use provided filename if available, otherwise generate new one
    let filename;
    if (options.filename) {
      filename = options.filename;
      console.log('🏷️ Using provided filename:', filename);
    } else {
      // Generate timestamp-based filename
      const timestamp = new Date().toISOString().replace(/[:.]/g, '-').replace('T', 'T').slice(0, -1) + 'Z';
      const extension = getFileExtension(imageBlob);
      filename = `${prefix}_${timestamp}.${extension}`;
      console.log('🏷️ Generated new filename:', filename);
    }

    // Try local storage first if enabled
    if (await isLocalStorageEnabled()) {
      try {
        const localResult = await saveToUserDefinedFolder(imageBlob, filename, prefix);
        if (localResult.success) {
          console.log('✅ Local Storage Success:', localResult);
          return {
            success: true,
            filename: filename,
            filePath: localResult.filePath,
            fullPath: localResult.fullPath,
            primaryUrl: localResult.url || filename, // Return filename for database
            urls: [localResult.url || filename],
            isLocal: true,
            message: 'Lưu ảnh local thành công'
          };
        }
      } catch (localError) {
        console.warn('Local storage failed, falling back to server:', localError);
      }
    }

    // Fallback to server storage
    const serverResult = await uploadToLocalServer(imageBlob, filename);
    
    if (serverResult.success) {
      console.log('✅ Server Storage Success:', serverResult);
      return {
        success: true,
        filename: filename,
        filePath: serverResult.filePath,
        fullPath: serverResult.fullPath,
        primaryUrl: filename, // Return filename for database
        urls: [filename],
        isLocal: false,
        message: serverResult.message
      };
    } else {
      throw new Error(serverResult.message || 'Upload failed');
    }

  } catch (error) {
    console.error('Image upload failed:', error);
    throw new Error(`Image upload failed: ${error.message}`);
  }
}

// Alias for backward compatibility - now uses direct folder storage instead of MinIO
export const uploadImageToMinIO = uploadImageToLocal;

// Helper functions for local storage
async function isLocalStorageEnabled() {
  try {
    const enabled = localStorage.getItem('local_storage_enabled') === 'true';
    const path = localStorage.getItem('image_storage_path');
    return enabled && path && path.trim() !== '';
  } catch (error) {
    return false;
  }
}

async function saveToUserDefinedFolder(imageBlob, filename, prefix) {
  try {
    let basePath = localStorage.getItem('image_storage_path');
    
    // Check if saved path is old Documents path and use default instead
    if (!basePath || basePath.includes('Documents') || basePath.includes('ParkingLotApp')) {
      console.warn('⚠️ Old or missing storage path detected, using default: C:/ParkingLot_Images/');
      basePath = 'C:/ParkingLot_Images';
      // Don't update localStorage here to avoid infinite loops
    }

    // Create date-based subdirectory structure (same as backend)
    const year = new Date().getFullYear();
    const month = String(new Date().getMonth() + 1).padStart(2, '0');
    const day = String(new Date().getDate()).padStart(2, '0');
    
    const subFolder = `Nam_${year}/Thang_${month}/Ngay_${day}`;
    const fullFolderPath = `${basePath}/${subFolder}`;
    
    console.log(`💾 Saving to storage folder: ${fullFolderPath}/${filename}`);

    // Check if running in Electron
    if (window.electronAPI && window.electronAPI.saveImage) {
      // Create directory if not exists
      if (window.electronAPI.createDirectory) {
        console.log(`Creating directory: ${fullFolderPath}`);
        await window.electronAPI.createDirectory(fullFolderPath);
        console.log(`Directory ensured: ${fullFolderPath}`);
      }

      const arrayBuffer = await imageBlob.arrayBuffer();
      const uint8Array = new Uint8Array(arrayBuffer);
      
      // Save using absolute path - ĐỒNG BỘ với backend path structure
      const electronSaveData = {
        data: Array.from(uint8Array),
        fileName: filename,
        folder: fullFolderPath // Use absolute path matching backend
      };
      
      const filePath = await window.electronAPI.saveImage(electronSaveData);
      console.log(`✅ Local storage save successful: ${filePath}`);
      
      return {
        success: true,
        filePath: filePath,
        fullPath: `${fullFolderPath}/${filename}`,
        url: `${subFolder}/${filename}` // Return relative path for database storage (matches backend expectation)
      };
    } else {
      throw new Error('Electron API không khả dụng');
    }
  } catch (error) {
    console.error('Save to user-defined folder failed:', error);
    throw error;
  }
}

// Helper function for direct folder storage upload
export async function uploadToLocalServer(imageBlob, filename) {
  try {
    console.log('📁 Uploading to direct folder storage...', { filename, size: imageBlob.size });

    // Create FormData
    const formData = new FormData();
    
    // Ensure file has proper format
    const file = new File([imageBlob], filename, {
      type: imageBlob.type || 'image/jpeg',
      lastModified: Date.now()
    });

    formData.append('image', file);
    formData.append('filename', filename);
    
    // Add storage path if available from localStorage
    const storagePath = localStorage.getItem('image_storage_path');
    if (storagePath && storagePath.trim() !== '') {
      // Check if the custom path contains the old Documents path - if so, don't use it
      if (storagePath.includes('Documents\\ParkingLotApp') || storagePath.includes('Documents/ParkingLotApp')) {
        console.warn('⚠️ Old storage path detected, using default instead:', storagePath);
        console.log('Using default storage path: C:/ParkingLot_Images/');
        // Don't add storage_path to formData - let backend use default
      } else {
        formData.append('storage_path', storagePath);
        console.log('Using custom storage path:', storagePath);
      }
    } else {
      console.log('No custom storage path set, using default: C:/ParkingLot_Images/');
    }

    // Log FormData for debugging
    console.log('Direct Folder Upload FormData:', {
      filename: filename,
      fileSize: file.size,
      fileType: file.type
    });

    // Upload to local backend using upload1.php (direct folder storage)
    const uploadUrl = url_api.replace('/index.php', '/upload1.php');
    
    const response = await fetch(uploadUrl, {
      method: 'POST',
      body: formData
      // Don't set Content-Type to let browser set multipart/form-data boundary
    });

    console.log('Direct Folder Upload Response Status:', response.status);

    if (!response.ok) {
      const errorText = await response.text();
      console.error('Direct Folder Upload Error:', errorText);
      throw new Error(`Upload failed: ${response.status} - ${errorText}`);
    }

    const result = await response.json();
    
    if (!result.success) {
      throw new Error(result.message || 'Upload failed');
    }

    return result;

  } catch (error) {
    console.error('Direct folder storage upload failed:', error);
    throw error;
  }
}

// COMMENTED OUT: MinIO upload functions
/*
// Helper function for MinIO upload with timeout
export async function uploadToMinIOWithTimeout(imageBlob, filename, timeoutMs) {
  return new Promise(async (resolve, reject) => {
    // Set timeout
    const timeoutId = setTimeout(() => {
      reject(new Error(`MinIO upload timeout after ${timeoutMs}ms`));
    }, timeoutMs);

    try {
      // Create FormData
      const formData = new FormData();
      
      // Ensure file has proper format
      const file = new File([imageBlob], filename, {
        type: imageBlob.type || 'image/jpeg',
        lastModified: Date.now()
      });

      formData.append('image', file);
      formData.append('filename', filename);

      // Log FormData for debugging
      console.log('MinIO Upload FormData:', {
        filename: filename,
        fileSize: file.size,
        fileType: file.type
      });

      // Upload to MinIO backend
      const uploadUrl = url_api.replace('/index.php', '/upload.php');
      
      const response = await fetch(uploadUrl, {
        method: 'POST',
        body: formData
        // Don't set Content-Type to let browser set multipart/form-data boundary
      });

      console.log('MinIO Upload Response Status:', response.status);

      if (!response.ok) {
        const errorText = await response.text();
        console.error('MinIO Upload Error:', errorText);
        clearTimeout(timeoutId);
        reject(new Error(`Upload failed: ${response.status} - ${errorText}`));
        return;
      }

      const result = await response.json();
      clearTimeout(timeoutId);
      
      // Check if at least one server succeeded
      const successfulUploads = result.filter(r => r.status === 'success');
      if (successfulUploads.length === 0) {
        reject(new Error('All MinIO servers failed'));
        return;
      }

      resolve({
        success: true,
        filename: filename,
        results: result,
        urls: result.map(r => r.url).filter(url => url),
        primaryUrl: successfulUploads[0]?.url
      });

    } catch (error) {
      clearTimeout(timeoutId);
      reject(error);
    }
  });
}
*/

// COMMENTED OUT: Local storage fallback (no longer needed)
/*
// Helper function for local storage fallback
async function saveToLocalStorage(imageBlob, filename, prefix) {
  try {
    const folderName = prefix === 'license_plate' || prefix === 'license_plate_out' ? 'anhchup_bienso' : 'anhchup_khuonmat';
    const basePath = 'C:\\Users\\Chung\\Documents\\ParkingLotApp\\assets\\imgAnhChup';
    const fullFolderPath = `${basePath}\\${folderName}`;
    
    console.log(`💾 Saving to local storage: ${fullFolderPath}\\${filename}`);

    // Check if running in Electron
    if (window.electronAPI && window.electronAPI.saveImage) {
      try {
        // Create directory if not exists
        if (window.electronAPI.createDirectory) {
          console.log(`Creating directory: ${fullFolderPath}`);
          await window.electronAPI.createDirectory(fullFolderPath);
          console.log(`Directory ensured: ${fullFolderPath}`);
        }

        const arrayBuffer = await imageBlob.arrayBuffer();
        const uint8Array = new Uint8Array(arrayBuffer);
        
        const saveData = {
          data: Array.from(uint8Array),
          fileName: filename,
          folder: `assets\\imgAnhChup\\${folderName}` // Relative path for Electron
        };
        
        const filePath = await window.electronAPI.saveImage(saveData);
        console.log(`Local storage save successful: ${filePath}`);
        
        return {
          success: true,
          filePath: filePath
        };
      } catch (electronError) {
        console.error('Electron save failed:', electronError);
        throw electronError;
      }
    } else {
      // Fallback for web version - auto download
      console.log('Web version - using auto download');
      
      // Try to create directory structure in browser (limited support)
      try {
        if ('showDirectoryPicker' in window) {
          // Modern browser with File System Access API
          console.log('Browser supports File System Access API');
        }
      } catch (fsError) {
        console.log('Using download fallback');
      }
      
      const url = URL.createObjectURL(imageBlob);
      const a = document.createElement('a');
      a.href = url;
      a.download = filename;
      a.style.display = 'none';
      
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      URL.revokeObjectURL(url);
      
      return {
        success: true,
        filePath: `Downloads\\${filename}`
      };
    }
  } catch (error) {
    console.error('Local storage save failed:', error);
    throw error;
  }
}
*/

/**
 * Upload license plate image (entry)
 * @param {Blob|File} imageBlob - License plate image
 * @param {Object} options - Additional options
 * @param {string} options.sessionId - Session ID for database update
 * @param {string} options.filename - Custom filename to use
 * @returns {Promise<Object>} - Upload results
 */
export async function uploadLicensePlateImage(imageBlob, options = {}) {
  return uploadImageToLocal(imageBlob, 'license_plate_in', {
    ...options,
    updateType: 'plate_in'
  });
}

/**
 * Upload license plate image (exit)
 * @param {Blob|File} imageBlob - License plate image
 * @param {Object} options - Additional options
 * @param {string} options.sessionId - Session ID for database update
 * @param {string} options.filename - Custom filename to use
 * @returns {Promise<Object>} - Upload results
 */
export async function uploadLicensePlateOutImage(imageBlob, options = {}) {
  return uploadImageToLocal(imageBlob, 'license_plate_out', {
    ...options,
    updateType: 'plate_out'
  });
}

/**
 * Upload face/driver image
 * @param {Blob|File} imageBlob - Face/driver image
 * @param {Object} options - Additional options
 * @param {string} options.sessionId - Session ID for database update
 * @param {string} options.updateType - face_in or face_out
 * @param {string} options.filename - Custom filename to use
 * @returns {Promise<Object>} - Upload results
 */
export async function uploadFaceImage(imageBlob, options = {}) {
  // Xác định prefix dựa trên updateType
  const prefix = options.updateType === 'face_out' ? 'face_out' : 'face_in';
  
  return uploadImageToLocal(imageBlob, prefix, {
    ...options,
    updateType: options.updateType || 'face_in'
  });
}

/**
 * Get local image URL from filename using POST method
 * @param {string} filename - Image filename stored in database
 * @returns {Promise<string>} - Base64 data URL of the image
 */
export async function getImageUrl(filename) {
  if (!filename) {
    console.warn('🚫 getImageUrl: Empty filename provided');
    return '';
  }
  
  // If it's already a full URL, return as is
  if (filename.startsWith('http://') || filename.startsWith('https://') || filename.startsWith('data:')) {
    console.log(`🔗 getImageUrl: Returning existing URL for ${filename}`);
    return filename;
  }
  
  try {
    // Extract date from filename timestamp like "2025-08-05T11-40-10-594Z"
    let year, month, day;
    const timestampMatch = filename.match(/(\d{4})-(\d{2})-(\d{2})T/);
    
    if (timestampMatch) {
      year = timestampMatch[1];
      month = timestampMatch[2];
      day = timestampMatch[3];
      console.log(`📅 getImageUrl: Extracted date from ${filename} -> ${year}-${month}-${day}`);
    } else {
      // Fallback to current date if can't extract from filename
      year = new Date().getFullYear();
      month = String(new Date().getMonth() + 1).padStart(2, '0');
      day = String(new Date().getDate()).padStart(2, '0');
      console.warn(`⚠️ getImageUrl: Could not extract date from ${filename}, using current date: ${year}-${month}-${day}`);
    }
    
    console.log(`🔍 getImageUrl: Looking for image: ${filename} on date ${year}-${month}-${day}`);
    
    const baseUrl = url_api.replace('/index.php', '');
    const apiUrl = `${baseUrl}/getImage.php`;
    
    console.log(`🌐 getImageUrl: Making request to ${apiUrl}`);
    
    const response = await fetch(apiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams({
        year: year,
        month: month,
        day: day,
        file: filename
      })
    });
    
    console.log(`📡 getImageUrl: Response status ${response.status} for ${filename}`);
    
    if (response.ok) {
      const result = await response.json();
      if (result.base64) {
        console.log(`✅ getImageUrl: Successfully loaded image: ${filename} (${result.base64.length} chars)`);
        return result.base64; // Return base64 data URL
      } else {
        console.warn(`❌ getImageUrl: No base64 data in response for ${filename}:`, result);
      }
    } else {
      const errorText = await response.text();
      console.warn(`❌ getImageUrl: Failed to load image: ${filename}, status: ${response.status}, error: ${errorText}`);
    }
    
    return ''; // Return empty string on failure
  } catch (error) {
    console.error(`💥 getImageUrl: Error loading image ${filename}:`, error);
    return '';
  }
}

/**
 * Get backup URLs - for local storage, return empty array since we only have one endpoint
 * FallbackImage will rely on getImageUrl as primary source
 * @param {string} filename - Image filename stored in database
 * @returns {Array<string>} - Array of direct URLs (empty for local storage)
 */
export function getBackupImageUrls(filename) {
  if (!filename) return [];
  
  // For local storage with single endpoint, return empty array
  // FallbackImage will use getImageUrl() as primary source
  console.log(`getBackupImageUrls called for ${filename} - using primary getImageUrl only`);
  return [];
}

// COMMENTED OUT: MinIO URL functions
/*
/**
 * Get full MinIO image URL from filename
 * @param {string} filename - Image filename stored in database
 * @returns {string} - Full MinIO URL (primary server)
 */
/*
export function getImageUrl(filename) {
  if (!filename) return '';
  
  // If it's already a full URL, return as is
  if (filename.startsWith('http://') || filename.startsWith('https://')) {
    return filename;
  }
  
  // Construct MinIO URL from filename - sử dụng server đầu tiên làm primary
  return `http://192.168.1.19:9000/parking-lot-images/${filename}`;
}
*/

/*
/**
 * Get backup MinIO URLs from filename for redundancy
 * Thứ tự ưu tiên: 192.168.1.19, 192.168.1.90, 192.168.1.94
 * @param {string} filename - Image filename stored in database
 * @returns {Array<string>} - Array of all MinIO URLs in priority order
 */
/*
export function getBackupImageUrls(filename) {
  if (!filename) return [];
  
  // If it's already a full URL, extract filename and generate all URLs
  if (filename.startsWith('http://') || filename.startsWith('https://')) {
    const urlParts = filename.split('/');
    const extractedFilename = urlParts[urlParts.length - 1];
    
    // Tạo URLs cho tất cả servers, ưu tiên server hiện tại
    const currentServer = filename.match(/\/\/([\d\.:]+)/)?.[1];
    const allServers = ['192.168.1.19:9000', '192.168.1.90:9000', '192.168.1.94:9000'];
    
    // Đưa server hiện tại lên đầu
    const orderedServers = currentServer 
      ? [currentServer, ...allServers.filter(s => s !== currentServer)]
      : allServers;
      
    return orderedServers.map(server => `http://${server}/parking-lot-images/${extractedFilename}`);
  }
  
  // Construct URLs for all MinIO servers in priority order
  const servers = ['192.168.1.19:9000', '192.168.1.90:9000', '192.168.1.94:9000'];
  return servers.map(server => `http://${server}/parking-lot-images/${filename}`);
}
*/

/**
 * Check if image URL is accessible (simplified for local storage)
 * @param {string} url - Image URL to check
 * @returns {Promise<boolean>} - True if accessible
 */
export async function checkImageUrl(url) {
  if (!url) return false;
  
  try {
    // For local server, try a simple fetch to check if file exists
    const response = await fetch(url, { method: 'HEAD' });
    return response.ok;
  } catch (error) {
    console.warn('Error checking image URL:', error);
    return false;
  }
}

/**
 * Get working image URL from filename (simplified for local storage)
 * @param {string} filename - Image filename stored in database
 * @returns {Promise<string>} - Working URL or empty string
 */
export async function getWorkingImageUrl(filename) {
  const url = getImageUrl(filename);
  
  console.log(`Checking local image URL: ${url}`);
  const isWorking = await checkImageUrl(url);
  
  if (isWorking) {
    console.log(`Local image URL working: ${url}`);
    return url;
  } else {
    console.warn(`Local image URL not working: ${url}`);
    return '';
  }
}

/**
 * Get file extension from blob/file
 * @param {Blob|File} file - File object
 * @returns {string} - File extension
 */
function getFileExtension(file) {
  if (file.name) {
    const extension = file.name.split('.').pop();
    if (extension && extension !== file.name) {
      return extension.toLowerCase();
    }
  }
  
  // Fallback based on MIME type
  if (file.type) {
    if (file.type.includes('jpeg') || file.type.includes('jpg')) {
      return 'jpg';
    } else if (file.type.includes('png')) {
      return 'png';
    }
  }
  
  // Default fallback
  return 'jpg';
}

/**
 * Utility function to generate parking lot image filename
 * @param {string} prefix - Image type prefix
 * @param {string} extension - File extension
 * @returns {string} - Generated filename
 */
export function generateParkingImageFilename(prefix = 'image', extension = 'jpg') {
  const timestamp = new Date().toISOString().replace(/[:.]/g, '-').replace('T', 'T').slice(0, -1) + 'Z';
  return `${prefix}_${timestamp}.${extension}`;
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
// export async function capNhatTrangThaiChoDo(maChoDo, trangThai) {
//   const payload = {
//     table: "pm_nc0005",
//     func: "chinhSuaTrangThai",
//     maChoDo: maChoDo,
//     trangThai: trangThai,
//   };
//   return callApiWithAuth(payload);
// }

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

// /**
//  * Tính toán ngày kết thúc chính sách VIP
//  * @param {string} startDate - Ngày bắt đầu (YYYY-MM-DD)
//  * @param {number} tongNgay - Tổng số ngày
//  * @returns {string} Ngày kết thúc (YYYY-MM-DD)
//  */
// export function tinhNgayKetThucChinhSach(startDate, tongNgay) {
//   if (!startDate || !tongNgay || tongNgay <= 0) {
//     return "";
//   }

//   const start = new Date(startDate);
//   if (isNaN(start.getTime())) {
//     return "";
//   }

//   const endDate = new Date(start);
//   endDate.setDate(start.getDate() + tongNgay - 1); // -1 vì bao gồm ngày bắt đầu

//   return endDate.toISOString().split("T")[0]; // Format YYYY-MM-DD
// }

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

/**
 * Tính phí gửi xe cho một mã phiên
 * @param {string} maPhien - Mã phiên gửi xe
 * @param {string} uidThe - UID thẻ (optional, để kiểm tra miễn phí)
 * @returns {Promise<Object>} Kết quả tính phí
 */
export const tinhPhiGuiXe = async (maPhien, uidThe = null) => {
    try {
        console.log(`💰 Bắt đầu tính phí cho phiên: ${maPhien}, thẻ: ${uidThe || 'N/A'}`);

        if (!maPhien) {
            return {
                success: false,
                phi: 0,
                tongPhut: 0,
                message: "Thiếu mã phiên"
            };
        }

        // B1: Nếu có uidThe, kiểm tra xem thẻ có được miễn phí không
        if (uidThe) {
            try {
                const isFree = await kiemTraTheMienPhi(uidThe);
                
                // B2: Nếu được miễn phí, trả về phí là 0
                if (isFree) {
                    console.log(`✅ Thẻ ${uidThe} được miễn phí (không phải thẻ KHACH).`);
                    return {
                        success: true,
                        phi: 0,
                        tongPhut: 0,
                        message: "Thẻ thuộc đối tượng miễn phí"
                    };
                }
                console.log(`💰 Thẻ ${uidThe} là thẻ KHACH, tiến hành tính phí.`);
            } catch (freeCheckError) {
                console.warn(`⚠️ Lỗi kiểm tra miễn phí, tiếp tục tính phí:`, freeCheckError);
            }
        }

        // B3: Gọi API backend để tính phí
        const payload = { 
            table: "pm_nc0008", 
            func: "tinhPhiGuiXe", 
            maPhien: maPhien 
        };
        
        console.log(`💰 Gọi API tính phí với payload:`, payload);
        const response = await callApiWithAuth(payload);
        console.log(`💰 Response từ API:`, response);
        
        // Xử lý response từ backend
        if (response) {
            // Check if response has success property directly
            if (response.success !== undefined) {
                return {
                    success: response.success,
                    phi: response.phi || response.fee || 0,
                    tongPhut: response.tongPhut || response.totalMinutes || 0,
                    message: response.message || (response.success ? "Tính phí thành công" : "Lỗi tính phí")
                };
            }
            // Check if response has data property
            else if (response.data) {
                return {
                    success: true,
                    phi: response.data.phi || response.data.fee || 0,
                    tongPhut: response.data.tongPhut || response.data.totalMinutes || 0,
                    message: response.data.message || "Tính phí thành công"
                };
            }
            // Legacy format - assume success if response exists
            else {
                return {
                    success: true,
                    phi: response.phi || response.fee || 0,
                    tongPhut: response.tongPhut || response.totalMinutes || 0,
                    message: response.message || "Tính phí thành công"
                };
            }
        } else {
            return {
                success: false,
                phi: 0,
                tongPhut: 0,
                message: "Không nhận được response từ server"
            };
        }
    } catch (error) {
        console.error('❌ Lỗi khi tính phí gửi xe:', error);
        return {
            success: false,
            phi: 0,
            tongPhut: 0,
            message: error.message || "Lỗi tính phí"
        };
    }
};

/**
 * Kiểm tra loại thẻ để xác định miễn phí
 * @param {string} uidThe - UID thẻ
 * @returns {Promise<boolean>} true nếu được miễn phí
 */
export async function kiemTraTheMienPhi(uidThe) {
  try {
    const danhSachThe = await layDanhSachThe()
    const the = danhSachThe.find(t => t.uidThe === uidThe)
    
    if (the) {
      // Chỉ thẻ KHACH mới phải trả phí
      return the.loaiThe !== "KHACH"
    }
    
    return false
  } catch (error) {
    console.error("Lỗi kiểm tra thẻ miễn phí:", error)
    return false
  }
}

/**
 * Lấy thông tin thẻ theo UID với thông tin chi tiết
 * @param {string} uidThe - UID thẻ
 * @returns {Promise<Object>} Thông tin thẻ
 */
export async function layThongTinTheChiTiet(uidThe) {
  const payload = {
    table: "pm_nc0003",
    func: "timTheTuUID",
    uidThe: uidThe
  }
  const result = await callApiWithAuth(payload)
  
  if (result && result.length > 0) {
    const the = result[0]
    return {
      success: true,
      data: {
        uidThe: the.uidThe,
        loaiThe: the.loaiThe,
        trangThai: the.trangThai,
        ngayPhatHanh: the.ngayPhatHanh,
        bienSoXe: the.bienSoXe,
        maChinhSach: the.maChinhSach,
        ngayKetThucCS: the.ngayKetThucCS,
        laMienPhi: the.loaiThe !== "KHACH" // Chỉ thẻ KHACH phải trả phí
      }
    }
  }
  
  return {
    success: false,
    message: "Không tìm thấy thẻ"
  }
}

/**
 * Thêm phiên gửi xe với logic xử lý vị trí theo loại xe
 * @param {Object} session - Thông tin phiên gửi xe
 * @returns {Promise<Object>} Kết quả thêm phiên
 */
export async function themPhienGuiXeVoiViTri(session) {
  try {
    // Lấy thông tin loại xe từ biển số
    let loaiXe = "0" // Mặc định xe nhỏ
    let viTriGui = null
    
    if (session.bienSo) {
      const thongTinLoaiXe = await layThongTinLoaiXeTuBienSo(session.bienSo)
      loaiXe = thongTinLoaiXe.loaiXe || "0"
      
      // Nếu là xe lớn (loaiXe = "1"), tìm slot trống
      if (loaiXe === "1") {
        const slotResult = await laySlotTrongChoXeLon(session.maKhuVuc)
        if (slotResult.success) {
          viTriGui = slotResult.maChoDo
          
          // Cập nhật trạng thái slot thành đã dùng
          await capNhatTrangThaiChoDo(viTriGui, "1")
        } else {
          return {
            success: false,
            message: "Không còn chỗ đỗ cho xe lớn"
          }
        }
      }
      // Xe nhỏ không cần vị trí đỗ cụ thể
    }
    
    // Tạo phiên gửi xe
    const sessionData = {
      ...session,
      viTriGui: viTriGui, // null cho xe nhỏ, có giá trị cho xe lớn
      loaiXe: loaiXe
    }
    
    return await themPhienGuiXe(sessionData)
  } catch (error) {
    console.error("Lỗi thêm phiên gửi xe:", error)
    return {
      success: false,
      message: error.message
    }
  }
}

// Lấy thông tin quyền hạn người dùng từ lv_lv0007
export async function layThongTinQuyenHanNguoiDung(userCode) {
  try {
    console.log(`Đang lấy thông tin quyền hạn cho người dùng: ${userCode}`);
    
    const payload = {
      table: "pm_nc0011",
      func: "select",
      code: userCode
    };

    const result = await callApiWithAuth(payload);
    
    if (result && result.success && result.data) {
      console.log(`Lấy thông tin quyền hạn thành công:`, result.data);
      return {
        success: true,
        ...result.data
      };
    } else {
      console.error(`Lỗi lấy thông tin quyền hạn:`, result?.message || "Unknown error");
      return {
        success: false,
        message: result?.message || "Không thể lấy thông tin quyền hạn",
        isAdmin: false,
        permissions: {
          canAccessConfig: false,
          canAccessCamera: false,
          canAccessPricing: false,
          canAccessZone: false,
          canAccessVehicle: false,
          canAccessVehicleType: false,
          canAccessRfid: false
        }
      };
    }
  } catch (error) {
    console.error(`Exception khi lấy thông tin quyền hạn:`, error);
    return {
      success: false,
      message: `Lỗi hệ thống: ${error.message}`,
      isAdmin: false,
      permissions: {
        canAccessConfig: false,
        canAccessCamera: false,
        canAccessPricing: false,
        canAccessZone: false,
        canAccessVehicle: false,
        canAccessVehicleType: false,
        canAccessRfid: false
      }
    };
  }
}

// Kiểm tra quyền hạn người dùng (helper function)
export async function kiemTraQuyenHanNguoiDung(userCode) {
  const userPermissions = await layThongTinQuyenHanNguoiDung(userCode);
  return userPermissions;
}

// Lấy danh sách thẻ RFID từ bảng pm_nc0003

// -------------------- Image URL Helpers --------------------

// Tách filename từ URL ảnh để lưu vào database
export function extractFilenameFromImageUrl(imageUrl) {
  try {
    if (!imageUrl || typeof imageUrl !== 'string') {
      return '';
    }
    
    // Extract filename from URL pattern: http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-10T03-04-54-531Z.jpg
    const urlParts = imageUrl.split('/');
    const filename = urlParts[urlParts.length - 1];
    
    console.log(`🖼️ Tách filename từ URL: ${imageUrl} -> ${filename}`);
    return filename;
  } catch (error) {
    console.error(`❌ Lỗi tách filename từ URL: ${error.message}`);
    return '';
  }
}

// Tạo URL đầy đủ từ filename để hiển thị ảnh
export function constructImageUrlFromFilename(filename, serverIndex = 0) {
  try {
    if (!filename || typeof filename !== 'string') {
      return '';
    }
    
    // Nếu đã là URL đầy đủ thì return luôn
    if (filename.startsWith('http://') || filename.startsWith('https://')) {
      return filename;
    }
    
    // Tạo URL từ filename với các MinIO servers
    const minioServers = [
      'http://192.168.1.19:9000',
      'http://192.168.1.90:9000', 
      'http://192.168.1.94:9000'
    ];
    
    const baseUrl = minioServers[serverIndex] || minioServers[0];
    const fullUrl = `${baseUrl}/parking-lot-images/${filename}`;
    
    console.log(`🖼️ Tạo URL từ filename: ${filename} -> ${fullUrl}`);
    return fullUrl;
  } catch (error) {
    console.error(`❌ Lỗi tạo URL từ filename: ${error.message}`);
    return '';
  }
}

// =============================================================================
// PHÂN QUYỀN & XÁC THỰC
// =============================================================================

// Lấy thông tin quyền hạn người dùng theo token
// export async function layThongTinQuyenHanNhanVien(token) {
//   try {
//     const payload = {
//       table: 'lv_lv0007',
//       func: 'layThongTinTaiKhoanTheoToken',
//       token: token // đổi từ lv097 ➜ token để backend nhận đúng
//     };
//     const data = await callApiWithAuth(payload);

//     if (Array.isArray(data) && data.length > 0) {
//       const userInfo = data[0];
//       const isAdmin = userInfo.quyenHan === '0';
//       return {
//         success: true,
//         data: {
//           taiKhoanDN: userInfo.taiKhoanDN,
//           ten: userInfo.ten,
//           roleQuyen: userInfo.roleQuyen,
//           quyenHan: userInfo.quyenHan,
//           isAdmin,
//           permissions: {
//             canAccessConfig: isAdmin,
//             canAccessCamera: isAdmin,
//             canAccessPricing: isAdmin,
//             canAccessZone: isAdmin,
//             canAccessVehicle: isAdmin,
//             canAccessVehicleType: isAdmin,
//             canAccessRfid: isAdmin
//           }
//         }
//       };
//     }
//     return { success: false, message: 'Không tìm thấy thông tin người dùng' };
//   } catch (error) {
//     console.error('❌ [API Error] Lỗi lấy thông tin quyền hạn:', error);
//     return { success: false, message: `Lỗi kết nối: ${error.message}` };
//   }
// }

// =============================================================================
// QUẢN LÝ SLOT ĐỖ XE
// =============================================================================

// Lấy slot trống cho xe lớn
export async function laySlotTrongChoXeLon(maKhuVuc = null) {
  try {
    // Lấy toàn bộ danh sách chỗ đỗ
    let spots = await layDanhSachChoDo();

    if (!Array.isArray(spots)) {
      return { success: false, message: 'Không lấy được danh sách chỗ đỗ' };
    }

    // Lọc theo khu vực (nếu có)
    if (maKhuVuc) {
      spots = spots.filter((s) => s.maKhuVuc === maKhuVuc);
    }

    // Lọc slot trống (trangThai = 0)
    const freeSpots = spots.filter((s) => s.trangThai === '0' || s.trangThai === 0);

    if (freeSpots.length === 0) {
      return { success: false, message: 'Không còn chỗ đỗ trống' };
    }

    // Sắp xếp theo mã chỗ đỗ (tăng dần) => P0001, P0002 ...
    freeSpots.sort((a, b) => a.maChoDo.localeCompare(b.maChoDo, undefined, { numeric: true }));

    const bestSpot = freeSpots[0];

    return {
      success: true,
      maChoDo: bestSpot.maChoDo,
      maKhuVuc: bestSpot.maKhuVuc,
      tenKhuVuc: bestSpot.tenKhuVuc || '',
    };
  } catch (error) {
    console.error('❌ [API Error] Lỗi lấy slot trống:', error);
    return { success: false, message: `Lỗi kết nối: ${error.message}` };
  }
}

// Cập nhật trạng thái chỗ đỗ
export async function capNhatTrangThaiChoDo(maChoDo, trangThai) {
  try {
    const payload = {
      table: 'pm_nc0005',
      func: 'chinhSuaTrangThai',
      maChoDo,
      trangThai
    };
    return await callApiWithAuth(payload);
  } catch (error) {
    console.error('❌ [API Error] Lỗi cập nhật slot:', error);
    return { success: false, message: `Lỗi kết nối: ${error.message}` };
  }
}

// =============================================================================
// NHẬN DIỆN LOẠI XE
// =============================================================================

// Lấy thông tin loại xe từ biển số
export async function layThongTinLoaiXeTuBienSo(bienSo) {
  try {
    console.log(`🚗 [API] Tìm loại xe từ biển số: ${bienSo}`);
    
    // Gọi API lấy thông tin phương tiện
    const response = await fetch(`${getBaseUrl()}/kebao.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        table: 'pm_nc0002',
        func: 'data'
      })
    });
    
    if (!response.ok) {
      throw new Error(`HTTP ${response.status}`);
    }
    
    const vehicles = await response.json();
    console.log(`🚗 [API Response] Danh sách phương tiện:`, vehicles);
    
    if (Array.isArray(vehicles)) {
      const foundVehicle = vehicles.find(v => 
        v.bienSo === bienSo || v.lv001 === bienSo
      );
      
      if (foundVehicle) {
        // Lấy thông tin loại xe từ pm_nc0001
        const vehicleTypes = await layALLLoaiPhuongTien();
        if (Array.isArray(vehicleTypes)) {
          const vehicleType = vehicleTypes.find(vt => 
            vt.maLoaiPT === foundVehicle.maLoaiPT || vt.lv001 === foundVehicle.maLoaiPT
          );
          
          if (vehicleType) {
            console.log(`✅ [API] Tìm thấy loại xe từ biển số:`, vehicleType);
            return {
              success: true,
              data: {
                maLoaiPT: vehicleType.maLoaiPT,
                tenLoaiPT: vehicleType.tenLoaiPT,
                loaiXe: vehicleType.loaiXe // 0 = xe nhỏ, 1 = xe lớn
              }
            };
          }
        }
      }
      
      console.log(`⚠️ [API] Không tìm thấy thông tin loại xe từ biển số`);
      return {
        success: false,
        message: 'Không tìm thấy thông tin loại xe từ biển số'
      };
    } else {
      throw new Error('Dữ liệu phương tiện không hợp lệ');
    }
  } catch (error) {
    console.error(`❌ [API Error] Lỗi tìm loại xe:`, error);
    return {
      success: false,
      message: `Lỗi kết nối: ${error.message}`
    };
  }
}

// =============================================================================
// TÍNH TOÁN CHÍNH SÁCH RFID
// =============================================================================

// Tính ngày kết thúc chính sách từ tên chính sách và ngày bắt đầu
export function tinhNgayKetThucChinhSach(tenChinhSach, ngayBatDau) {
  try {
    console.log(`📅 [API] Tính ngày kết thúc cho chính sách: ${tenChinhSach}, từ ngày: ${ngayBatDau}`);
    
    if (!tenChinhSach || !ngayBatDau) {
      throw new Error('Thiếu tên chính sách hoặc ngày bắt đầu');
    }
    
    const startDate = new Date(ngayBatDau);
    if (isNaN(startDate.getTime())) {
      throw new Error('Ngày bắt đầu không hợp lệ');
    }
    
    // Parse pattern: CS_[VEHICLE_TYPE]_[DURATION][UNIT]
    // Improved regex to handle various formats
    const match = tenChinhSach.match(/(\d+)(T|TH|THANG|N|NAM|H)$/i);
    
    if (!match) {
      console.warn(`⚠️ [API] Không thể parse chính sách: ${tenChinhSach}`);
      return null;
    }
    
    const duration = parseInt(match[1]);
    const unit = match[2].toUpperCase();
    
    console.log(`📅 [API] Parsed: ${duration} ${unit}`);
    
    const endDate = new Date(startDate);
    
    switch (unit) {
      case 'T':
        endDate.setDate(endDate.getWeek() + duration);
      case 'TH':
        endDate.setMonth(endDate.getMonth() + duration); 
      case 'THANG':
        endDate.setMonth(endDate.getMonth() + duration);
        break;
      case 'N':
        endDate.setDate(endDate.getDate() + duration);
        break;
      case 'NAM':
        endDate.setFullYear(endDate.getFullYear() + duration);
        break;
      case 'H':
        endDate.setHours(endDate.getHours() + duration);
        break;
      default:
        throw new Error(`Đơn vị thời gian không hỗ trợ: ${unit}`);
    }
    
    console.log(`✅ [API] Ngày kết thúc tính được: ${endDate.toISOString()}`);
    return endDate.toISOString().split('T')[0]; // Return YYYY-MM-DD format
    
  } catch (error) {
    console.error(`❌ [API Error] Lỗi tính ngày kết thúc:`, error);
    return null;
  }
}

// Helper: Trả về base URL (thư mục chứa các PHP endpoint)
export function getBaseUrl() {
  try {
    if (!url_api) return "";
    const lastSlashIdx = url_api.lastIndexOf("/");
    if (lastSlashIdx === -1) return url_api;
    return url_api.substring(0, lastSlashIdx);
  } catch (err) {
    console.error("getBaseUrl error", err);
    return "";
  }
}

// Lấy thông tin quyền hạn người dùng theo token + code
export async function layThongTinQuyenHanNhanVien(token, userCode) {
  try {
    if (!token || !userCode) {
      throw new Error('Thiếu token hoặc userCode');
    }

    const payload = {
      table: 'lv_lv0007',
      func: 'layThongTinTaiKhoanTheoToken',
      token: token
    };

    const res = await fetch(url_api, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-USER-CODE': userCode,
        'X-USER-TOKEN': token
      },
      body: JSON.stringify(payload)
    });

    if (!res.ok) {
      throw new Error(`HTTP ${res.status}`);
    }

    const data = await res.json();

    if (Array.isArray(data) && data.length > 0) {
      const userInfo = data[0];
      const isAdmin = userInfo.quyenHan === '0';
      return {
        success: true,
        data: {
          taiKhoanDN: userInfo.taiKhoanDN,
          ten: userInfo.ten,
          roleQuyen: userInfo.roleQuyen,
          quyenHan: userInfo.quyenHan,
          isAdmin,
          permissions: {
            canAccessConfig: isAdmin,
            canAccessCamera: isAdmin,
            canAccessPricing: isAdmin,
            canAccessZone: isAdmin,
            canAccessVehicle: isAdmin,
            canAccessVehicleType: isAdmin,
            canAccessRfid: isAdmin
          }
        }
      };
    }
    return { success: false, message: 'Không tìm thấy thông tin người dùng' };
  } catch (error) {
    console.error('[API Error] Lỗi lấy thông tin quyền hạn:', error);
    return { success: false, message: `Lỗi kết nối: ${error.message}` };
  }
}

// ==================== QUẢN LÝ NHÂN VIÊN (lv_lv0007) ====================

/**
 * Lấy danh sách tất cả nhân viên
 * @returns {Promise<Array>} Danh sách nhân viên với thông tin: taiKhoanDN, nguoiThem, roleQuyen, matKhau, ten, quyenHan
 */
export async function layDanhSachNhanVien() {
  const payload = {
    table: "lv_lv0007",
    func: "data"
  };
  return callApiWithAuth(payload);
}

/**
 * Lấy thông tin tài khoản theo token
 * @param {string} token - Token để xác thực
 * @returns {Promise<Array>} Thông tin tài khoản
 */
export async function layThongTinTaiKhoanTheoToken(token) {
  const payload = {
    table: "lv_lv0007",
    func: "layThongTinTaiKhoanTheoToken",
    token: token
  };
  return callApiWithAuth(payload);
}

/**
 * Thêm nhân viên mới
 * @param {Object} nhanVien - Thông tin nhân viên
 * @param {string} nhanVien.taiKhoanDN - Tài khoản đăng nhập (-> lv001)
 * @param {string} nhanVien.nguoiThem - Người thêm (-> lv003)
 * @param {string} nhanVien.roleQuyen - Role quyền (-> lv004)
 * @param {string} nhanVien.matKhau - Mật khẩu (-> lv005)
 * @param {string} nhanVien.ten - Tên nhân viên (-> lv006)
 * @param {string} nhanVien.quyenHan - Quyền hạn (-> lv900)
 * @returns {Promise<Object>} Kết quả thêm nhân viên
 */
export async function themNhanVien(nhanVien) {
  const payload = {
    table: "lv_lv0007",
    func: "add",
    taiKhoanDN: nhanVien.taiKhoanDN,  // -> lv001
    nguoiThem: nhanVien.nguoiThem,    // -> lv003
    roleQuyen: nhanVien.roleQuyen,    // -> lv004
    matKhau: nhanVien.matKhau,        // -> lv005
    ten: nhanVien.ten,                // -> lv006
    quyenHan: nhanVien.quyenHan       // -> lv900
  };
  return callApiWithAuth(payload);
}

/**
 * Cập nhật thông tin nhân viên
 * @param {Object} nhanVien - Thông tin nhân viên cần cập nhật
 * @param {string} nhanVien.taiKhoanDN - Tài khoản đăng nhập (-> lv001)
 * @param {string} nhanVien.nguoiThem - Người thêm (-> lv003)
 * @param {string} nhanVien.roleQuyen - Role quyền (-> lv004)
 * @param {string} nhanVien.matKhau - Mật khẩu (-> lv005)
 * @param {string} nhanVien.ten - Tên nhân viên (-> lv006)
 * @param {string} nhanVien.quyenHan - Quyền hạn (-> lv900)
 * @returns {Promise<Object>} Kết quả cập nhật
 */
export async function capNhatNhanVien(nhanVien) {
  const payload = {
    table: "lv_lv0007",
    func: "edit",
    taiKhoanDN: nhanVien.taiKhoanDN,  // -> lv001
    nguoiThem: nhanVien.nguoiThem,    // -> lv003
    roleQuyen: nhanVien.roleQuyen,    // -> lv004
    matKhau: nhanVien.matKhau,        // -> lv005
    ten: nhanVien.ten,                // -> lv006
    quyenHan: nhanVien.quyenHan       // -> lv900
  };
  return callApiWithAuth(payload);
}


// ==================== QUẢN LÝ KHU VỰC LÀM VIỆC NHÂN VIÊN (pm_nc0011) ====================

/**
 * Lấy danh sách khu vực làm việc của nhân viên
 * @returns {Promise<Array>} Danh sách khu vực làm việc
 */
export async function layDanhSachKhuVucLamViec() {
  const payload = {
    table: "pm_nc0011",
    func: "data"
  };
  return callApiWithAuth(payload);
}

/**
 * Thêm khu vực làm việc cho nhân viên
 * @param {Object} khuVucLamViec - Thông tin khu vực làm việc
 * @param {string} khuVucLamViec.maKhuVuc - Mã khu vực
 * @param {string} khuVucLamViec.taiKhoanDN - Tài khoản đăng nhập nhân viên
 * @param {string} khuVucLamViec.moTa - Mô tả
 * @returns {Promise<Object>} Kết quả thêm
 */
export async function themKhuVucLamViec(khuVucLamViec) {
  const payload = {
    table: "pm_nc0011",
    func: "add",
    maKhuVuc: khuVucLamViec.maKhuVuc,
    taiKhoanDN: khuVucLamViec.taiKhoanDN,
    moTa: khuVucLamViec.moTa
  };
  return callApiWithAuth(payload);
}

/**
 * Xóa khu vực làm việc của nhân viên
 * @param {string} maKhuVuc - Mã khu vực
 * @param {string} taiKhoanDN - Tài khoản đăng nhập nhân viên
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function xoaKhuVucLamViec(maKhuVuc, taiKhoanDN) {
  const payload = {
    table: "pm_nc0011",
    func: "delete",
    maKhuVuc: maKhuVuc,
    taiKhoanDN: taiKhoanDN
  };
  return callApiWithAuth(payload);
}

/**
 * Lấy khu vực làm việc của một nhân viên cụ thể
 * @param {string} taiKhoanDN - Tài khoản đăng nhập nhân viên
 * @returns {Promise<Array>} Danh sách khu vực làm việc của nhân viên
 */
export async function layKhuVucLamViecCuaNhanVien(taiKhoanDN) {
  const payload = {
    table: "pm_nc0011",
    func: "layKhuVucLamViecCuaNhanVien",
    taiKhoanDN: taiKhoanDN
  };
  return callApiWithAuth(payload);
}

// ==================== HELPER FUNCTIONS CHO NHÂN VIÊN ====================

/**
 * @deprecated Sử dụng layThongTinTaiKhoanTheoToken thay thế
 */
export async function layNhanVienTheoMa(token) {
  return layThongTinTaiKhoanTheoToken(token);
}

/**
 * @deprecated Chức năng này chưa được implement trong backend
 */
export async function xoaNhanVien(taiKhoanDN) {
  const payload = {
    table: "lv_lv0007",
    func: "delete",
    taiKhoanDN: taiKhoanDN
  };
  return callApiWithAuth(payload);
}

/**
 * @deprecated Chức năng này chưa được implement trong backend
 */
export async function datLaiMatKhauNhanVien(maNhanVien, matKhauMoi) {
  console.warn("API datLaiMatKhauNhanVien chưa được implement trong backend");
  return { success: false, message: "Chức năng chưa được hỗ trợ" };
}

// ==================== THỐNG KÊ (STATISTICS) ====================
export async function layThongKeDoanhThu({ fromDate, toDate }) {
  const payload = {
    table: "statistics",
    func: "revenue",
    fromDate,
    toDate,
  };
  return callApiWithAuth(payload);
}

export async function layThongKeLoaiXe({ fromDate, toDate }) {
  const payload = {
    table: "statistics",
    func: "vehicleTypeCounts",
    fromDate,
    toDate,
  };
  return callApiWithAuth(payload);
}

export async function layTiLeLapDay() {
  const payload = {
    table: "statistics",
    func: "occupancy",
  };
  return callApiWithAuth(payload);
}

// ==================== THỐNG KÊ NÂNG CAO ====================

/**
 * Lấy thống kê tổng quan hệ thống
 * @returns {Promise<Object>} Thống kê tổng quan
 */
export async function layThongKeTongQuan() {
  try {
    const payload = {
      table: "statistics",
      func: "systemOverview"
    };
    return callApiWithAuth(payload);
  } catch (error) {
    console.error('[API Error] Lỗi lấy thống kê tổng quan:', error);
    return {
      totalCards: 0,
      totalEmployees: 0,
      totalZones: 0,
      totalCameras: 0,
      totalGates: 0,
      totalSessions: 0,
      activeSessionsToday: 0
    };
  }
}

/**
 * Lấy thống kê xe trong bãi theo thời gian
 * @param {Object} params - Tham số thống kê
 * @returns {Promise<Object>} Thống kê xe trong bãi
 */
export async function layThongKeXeTrongBai({ fromDate, toDate }) {
  try {
    const payload = {
      table: "statistics", 
      func: "vehiclesInParking",
      fromDate,
      toDate
    };
    return callApiWithAuth(payload);
  } catch (error) {
    console.error('[API Error] Lỗi lấy thống kê xe trong bãi:', error);
    return { hourlyData: [], totalIn: 0, totalOut: 0 };
  }
}

/**
 * Lấy thống kê doanh thu theo từng loại thẻ
 * @param {Object} params - Tham số thống kê
 * @returns {Promise<Object>} Thống kê doanh thu theo loại thẻ
 */
export async function layThongKeDoanhThuTheoLoaiThe({ fromDate, toDate }) {
  try {
    const payload = {
      table: "statistics",
      func: "revenueByCardType", 
      fromDate,
      toDate
    };
    return callApiWithAuth(payload);
  } catch (error) {
    console.error('[API Error] Lỗi lấy thống kê doanh thu theo loại thẻ:', error);
    return { cardTypes: [], totalRevenue: 0 };
  }
}

/**
 * Lấy thống kê hiệu suất camera
 * @param {Object} params - Tham số thống kê
 * @returns {Promise<Object>} Thống kê camera
 */
export async function layThongKeHieuSuatCamera({ fromDate, toDate }) {
  try {
    const payload = {
      table: "statistics",
      func: "cameraPerformance",
      fromDate, 
      toDate
    };
    return callApiWithAuth(payload);
  } catch (error) {
    console.error('[API Error] Lỗi lấy thống kê camera:', error);
    return { cameras: [], totalScans: 0, successRate: 0 };
  }
}

/**
 * Lấy thống kê theo khu vực
 * @param {Object} params - Tham số thống kê
 * @returns {Promise<Object>} Thống kê theo khu vực
 */
export async function layThongKeTheoKhuVuc({ fromDate, toDate }) {
  try {
    const payload = {
      table: "statistics",
      func: "zoneStatistics",
      fromDate,
      toDate
    };
    return callApiWithAuth(payload);
  } catch (error) {
    console.error('[API Error] Lỗi lấy thống kê theo khu vực:', error);
    return { zones: [], busiest: null };
  }
}

/**
 * Lấy thống kê nhân viên hoạt động
 * @param {Object} params - Tham số thống kê  
 * @returns {Promise<Object>} Thống kê nhân viên
 */
export async function layThongKeNhanVien({ fromDate, toDate }) {
  try {
    const payload = {
      table: "statistics", 
      func: "employeeActivity",
      fromDate,
      toDate
    };
    return callApiWithAuth(payload);
  } catch (error) {
    console.error('[API Error] Lỗi lấy thống kê nhân viên:', error);
    return { 
      totalEmployees: 0,
      activeEmployees: 0,
      byRole: [],
      byStatus: []
    };
  }
}

/**
 * Lấy thống kê thời gian gửi xe trung bình
 * @param {Object} params - Tham số thống kê
 * @returns {Promise<Object>} Thống kê thời gian
 */
export async function layThongKeThoiGianTrungBinh({ fromDate, toDate }) {
  try {
    const payload = {
      table: "statistics",
      func: "averageParkingTime", 
      fromDate,
      toDate
    };
    return callApiWithAuth(payload);
  } catch (error) {
    console.error('[API Error] Lỗi lấy thống kê thời gian:', error);
    return { averageTime: 0, byVehicleType: [], distribution: [] };
  }
}

/**
 * Lấy top thẻ sử dụng nhiều nhất
 * @param {Object} params - Tham số thống kê
 * @returns {Promise<Object>} Top thẻ
 */
export async function layTopTheSuDung({ fromDate, toDate, limit = 10 }) {
  try {
    const payload = {
      table: "statistics",
      func: "topCards",
      fromDate,
      toDate,
      limit
    };
    return callApiWithAuth(payload);
  } catch (error) {
    console.error('[API Error] Lỗi lấy top thẻ:', error);
    return { topCards: [] };
  }
}

/**
 * Lấy thống kê lỗi và sự cố
 * @param {Object} params - Tham số thống kê
 * @returns {Promise<Object>} Thống kê lỗi
 */
export async function layThongKeLoiSuCo({ fromDate, toDate }) {
  try {
    const payload = {
      table: "statistics",
      func: "errorAnalysis",
      fromDate,
      toDate
    };
    return callApiWithAuth(payload);
  } catch (error) {
    console.error('[API Error] Lỗi lấy thống kê lỗi:', error);
    return { 
      plateErrors: 0,
      cameraErrors: 0, 
      cardErrors: 0,
      systemErrors: 0
    };
  }
}