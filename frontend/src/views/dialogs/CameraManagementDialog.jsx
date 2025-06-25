"use client"

import { useState, useEffect } from "react"
import { layDanhSachCamera, layDanhSachKhuVuc, themCamera, capNhatCamera, xoaCamera } from "../../api/api"

const CameraManagementDialog = ({ isOpen, onClose }) => {
  const [cameras, setCameras] = useState([])
  const [zones, setZones] = useState([])
  const [selectedCamera, setSelectedCamera] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [formData, setFormData] = useState({
    maCamera: "",
    tenCamera: "",
    loaiCamera: "VAO", // VAO, RA
    chucNangCamera: "BIENSO", // BIENSO, KHUONMAT
    maKhuVuc: "",
    linkRTSP: "",
  })

  useEffect(() => {
    if (isOpen) {
      loadData()
    }
  }, [isOpen])

  const loadData = async () => {
    try {
      const [cameraData, zoneData] = await Promise.all([layDanhSachCamera(), layDanhSachKhuVuc()])
      setCameras(cameraData || [])
      setZones(zoneData || [])
    } catch (error) {
      console.error("Error loading data:", error)
    }
  }

  const handleSubmit = async (e) => {
    e.preventDefault()
    try {
      if (isEditing) {
        await capNhatCamera(formData)
      } else {
        await themCamera(formData)
      }
      await loadData()
      resetForm()
    } catch (error) {
      console.error("Error saving camera:", error)
      alert("Lỗi khi lưu camera: " + error.message)
    }
  }

  const handleEdit = (camera) => {
    setSelectedCamera(camera)
    setFormData(camera)
    setIsEditing(true)
  }

  const handleDelete = async (maCamera) => {
    if (confirm("Bạn có chắc chắn muốn xóa camera này?")) {
      try {
        await xoaCamera(maCamera)
        await loadData()
      } catch (error) {
        console.error("Error deleting camera:", error)
        alert("Lỗi khi xóa camera: " + error.message)
      }
    }
  }

  const resetForm = () => {
    setFormData({
      maCamera: "",
      tenCamera: "",
      loaiCamera: "VAO",
      chucNangCamera: "BIENSO",
      maKhuVuc: "",
      linkRTSP: "",
    })
    setSelectedCamera(null)
    setIsEditing(false)
  }

  const testRTSP = (rtspUrl) => {
    if (!rtspUrl) {
      alert("Chưa có URL RTSP")
      return
    }

    // Open test window
    const testWindow = window.open("", "_blank", "width=640,height=480")
    testWindow.document.write(`
      <html>
        <head><title>Test RTSP Camera</title></head>
        <body style="margin:0;padding:20px;background:#000;">
          <h3 style="color:white;">Testing RTSP: ${rtspUrl}</h3>
          <div id="player-container"></div>
          <script>
            // Import RTSPPlayer component here if needed
            // For now, just show the URL
            document.getElementById('player-container').innerHTML = 
              '<p style="color:white;">RTSP URL: ${rtspUrl}</p>' +
              '<p style="color:white;">Open Electron app to test streaming</p>';
          </script>
        </body>
      </html>
    `)
  }

  if (!isOpen) return null

  return (
    <div className="dialog-overlay">
      <div className="dialog-container" style={{ maxWidth: "1200px", width: "90%" }}>
        <div className="dialog-header">
          <h2>Quản Lý Camera</h2>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content" style={{ display: "flex", gap: "20px" }}>
          {/* Form Panel */}
          <div style={{ flex: "0 0 400px" }}>
            <h3>{isEditing ? "Sửa Camera" : "Thêm Camera Mới"}</h3>
            <form onSubmit={handleSubmit}>
              <div className="form-group">
                <label>Mã Camera:</label>
                <input
                  type="text"
                  value={formData.maCamera}
                  onChange={(e) => setFormData({ ...formData, maCamera: e.target.value })}
                  required
                  disabled={isEditing}
                />
              </div>

              <div className="form-group">
                <label>Tên Camera:</label>
                <input
                  type="text"
                  value={formData.tenCamera}
                  onChange={(e) => setFormData({ ...formData, tenCamera: e.target.value })}
                  required
                />
              </div>

              <div className="form-group">
                <label>Loại Camera:</label>
                <select
                  value={formData.loaiCamera}
                  onChange={(e) => setFormData({ ...formData, loaiCamera: e.target.value })}
                >
                  <option value="VAO">Vào</option>
                  <option value="RA">Ra</option>
                </select>
              </div>

              <div className="form-group">
                <label>Chức Năng:</label>
                <select
                  value={formData.chucNangCamera}
                  onChange={(e) => setFormData({ ...formData, chucNangCamera: e.target.value })}
                >
                  <option value="BIENSO">Biển Số</option>
                  <option value="KHUONMAT">Khuôn Mặt</option>
                </select>
              </div>

              <div className="form-group">
                <label>Khu Vực:</label>
                <select
                  value={formData.maKhuVuc}
                  onChange={(e) => setFormData({ ...formData, maKhuVuc: e.target.value })}
                  required
                >
                  <option value="">-- Chọn khu vực --</option>
                  {zones.map((zone) => (
                    <option key={zone.maKhuVuc} value={zone.maKhuVuc}>
                      {zone.tenKhuVuc}
                    </option>
                  ))}
                </select>
              </div>

              <div className="form-group">
                <label>Link RTSP:</label>
                <input
                  type="text"
                  value={formData.linkRTSP}
                  onChange={(e) => setFormData({ ...formData, linkRTSP: e.target.value })}
                  placeholder="rtsp://username:password@ip:port/path"
                  required
                />
                <small style={{ color: "#666", fontSize: "12px" }}>
                  Ví dụ: rtsp://admin:password@192.168.1.100/h264/ch1/main/av_stream
                </small>
              </div>

              <div className="form-actions">
                <button type="submit" className="btn-primary">
                  {isEditing ? "Cập Nhật" : "Thêm Mới"}
                </button>
                <button type="button" onClick={resetForm} className="btn-secondary">
                  Hủy
                </button>
                {formData.linkRTSP && (
                  <button type="button" onClick={() => testRTSP(formData.linkRTSP)} className="btn-info">
                    Test RTSP
                  </button>
                )}
              </div>
            </form>
          </div>

          {/* Camera List Panel */}
          <div style={{ flex: 1 }}>
            <h3>Danh Sách Camera ({cameras.length})</h3>
            <div style={{ maxHeight: "500px", overflowY: "auto" }}>
              <table className="data-table">
                <thead>
                  <tr>
                    <th>Mã</th>
                    <th>Tên</th>
                    <th>Loại</th>
                    <th>Chức năng</th>
                    <th>Khu vực</th>
                    <th>RTSP</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  {cameras.map((camera) => (
                    <tr key={camera.maCamera}>
                      <td>{camera.maCamera}</td>
                      <td>{camera.tenCamera}</td>
                      <td>
                        <span className={`badge ${camera.loaiCamera === "VAO" ? "badge-success" : "badge-warning"}`}>
                          {camera.loaiCamera}
                        </span>
                      </td>
                      <td>
                        <span
                          className={`badge ${camera.chucNangCamera === "BIENSO" ? "badge-primary" : "badge-info"}`}
                        >
                          {camera.chucNangCamera}
                        </span>
                      </td>
                      <td>{camera.maKhuVuc}</td>
                      <td>
                        <div style={{ maxWidth: "200px", overflow: "hidden", textOverflow: "ellipsis" }}>
                          {camera.linkRTSP}
                        </div>
                      </td>
                      <td>
                        <button
                          onClick={() => handleEdit(camera)}
                          className="btn-sm btn-primary"
                          style={{ marginRight: "5px" }}
                        >
                          Sửa
                        </button>
                        <button
                          onClick={() => handleDelete(camera.maCamera)}
                          className="btn-sm btn-danger"
                          style={{ marginRight: "5px" }}
                        >
                          Xóa
                        </button>
                        <button onClick={() => testRTSP(camera.linkRTSP)} className="btn-sm btn-info">
                          Test
                        </button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default CameraManagementDialog
