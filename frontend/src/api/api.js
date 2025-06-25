// api.js - Chuyển đổi các hàm Python sang React (JS)
// Lưu ý: Cần chỉnh sửa urlApi cho đúng endpoint backend của bạn

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
  const payload = {
    table: "pm_nc0003",
    func: "add",
    uidThe,
    loaiThe,
    trangThai,
  }
  return callApiWithAuth(payload)
}

// -------------------- Pricing Policy Functions --------------------
export async function layALLChinhSachGia() {
  console.log("layALLChinhSachGia called")
  const payload = { table: "pm_nc0008", func: "getAllPolicies" }
  return callApiWithAuth(payload)
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
