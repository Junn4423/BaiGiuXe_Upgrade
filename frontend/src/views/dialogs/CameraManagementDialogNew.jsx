"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/dialog-base.css"
import { 
  layDanhSachCameraKebao, 
  themCameraKebao, 
  capNhatCameraKebao, 
  xoaCameraKebao,
  layDanhSachKhuVuc,
  capNhatURLCamera
} from "../../api/api"

const CameraManagementDialogNew = ({ onClose, onSave }) => {
  const [cameras, setCameras] = useState([])
  const [zones, setZones] = useState([])
  const [selectedZone, setSelectedZone] = useState("")
  const [selectedCamera, setSelectedCamera] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [loading, setLoading] = useState(false)
  const [formData, setFormData] = useState({
    maCamera: "",
    tenCamera: "",
    loaiCamera: "VAO",
    chucNangCamera: "BIENSO",
    maKhuVuc: "",
    linkRTSP: "",
  })

  useEffect(() => {
    loadData()
  }, [])

  const loadData = async () => {
    try {
      setLoading(true)
      
      // Load zones
      const zonesData = await layDanhSachKhuVuc()
      setZones(Array.isArray(zonesData) ? zonesData : [])
      
      // Load cameras
      const camerasData = await layDanhSachCameraKebao()
      setCameras(Array.isArray(camerasData) ? camerasData : [])
      
    } catch (error) {
      console.error("Error loading data:", error)
      alert("Lỗi tải dữ liệu: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleSubmit = async (e) => {
    e.preventDefault()
    
    if (!formData.maCamera || !formData.tenCamera || !formData.maKhuVuc) {
      alert("Vui lòng điền đầy đủ thông tin")
      return
    }

    try {
      setLoading(true)
      let result
      
      if (isEditing) {
        result = await capNhatCameraKebao(formData)
      } else {
        result = await themCameraKebao(formData)
      }
      
      if (result.success) {
        alert(isEditing ? "Cập nhật camera thành công!" : "Thêm camera thành công!")
        resetForm()
        loadData()
      } else {
        throw new Error(result.message || "Thao tác thất bại")
      }
    } catch (error) {
      console.error("Error saving camera:", error)
      alert("Lỗi: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleEdit = (camera) => {
    setFormData({...camera})
    setSelectedCamera(camera)
    setIsEditing(true)
  }

  const handleDelete = async (camera) => {
    if (!window.confirm(`Bạn có chắc muốn xóa camera "${camera.tenCamera}"?`)) {
      return
    }

    try {
      setLoading(true)
      const result = await xoaCameraKebao(camera.maCamera)
      
      if (result.success) {
        alert("Xóa camera thành công!")
        loadData()
      } else {
        throw new Error(result.message || "Xóa thất bại")
      }
    } catch (error) {
      console.error("Error deleting camera:", error)
      alert("Lỗi xóa camera: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleUpdateURL = async (camera, newUrl) => {
    try {
      setLoading(true)
      const result = await capNhatURLCamera(camera.maCamera, newUrl)
      
      if (result.success) {
        alert("Cập nhật URL thành công!")
        loadData()
      } else {
        throw new Error(result.message || "Cập nhật thất bại")
      }
    } catch (error) {
      console.error("Error updating URL:", error)
      alert("Lỗi cập nhật URL: " + error.message)
    } finally {
      setLoading(false)
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
      alert("Chưa có URL RTSP để test")
      return
    }
    
    // Mở URL RTSP trong tab mới (VLC player hoặc browser sẽ xử lý)
    window.open(rtspUrl, '_blank')
  }

  const getFilteredCameras = () => {
    if (!selectedZone) return cameras
    return cameras.filter(camera => camera.maKhuVuc === selectedZone)
  }

  const getZoneName = (maKhuVuc) => {
    const zone = zones.find(z => z.maKhuVuc === maKhuVuc)
    return zone ? zone.tenKhuVuc : maKhuVuc
  }

  return (
    <div className="dialog-overlay">
      <div className="dialog-container extra-large">
        <div className="dialog-header">
          <h2 className="dialog-title">Quản Lý Camera</h2>
          <button className="dialog-close" onClick={onClose}>×</button>
        </div>

        <div className="dialog-subtitle">
          Quản lý camera ANPR và camera giám sát trong hệ thống
        </div>

        <div className="dialog-content main-sidebar">
          {/* Left Panel - Camera List */}
          <div className="dialog-panel">
            <div className="dialog-panel-title">
              Danh Sách Camera ({getFilteredCameras().length})
            </div>
            
            {/* Zone Filter */}
            <div className="form-group" style={{marginBottom: '16px'}}>
              <label>Lọc theo khu vực:</label>
              <select 
                className="dialog-select"
                value={selectedZone}
                onChange={(e) => setSelectedZone(e.target.value)}
              >
                <option value="">Tất cả khu vực</option>
                {zones.map(zone => (
                  <option key={zone.maKhuVuc} value={zone.maKhuVuc}>
                    {zone.tenKhuVuc}
                  </option>
                ))}
              </select>
            </div>

            {loading ? (
              <div className="dialog-loading">Đang tải...</div>
            ) : (
              <div style={{maxHeight: '400px', overflowY: 'auto'}}>
                <table className="dialog-table">
                  <thead>
                    <tr>
                      <th>Mã</th>
                      <th>Tên Camera</th>
                      <th>Loại</th>
                      <th>Chức năng</th>
                      <th>Khu vực</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    {getFilteredCameras().map(camera => (
                      <tr 
                        key={camera.maCamera}
                        style={{
                          backgroundColor: selectedCamera?.maCamera === camera.maCamera ? '#e0f2fe' : ''
                        }}
                      >
                        <td>{camera.maCamera}</td>
                        <td>{camera.tenCamera}</td>
                        <td>
                          <span className={`badge ${camera.loaiCamera === 'VAO' ? 'badge-success' : 'badge-warning'}`}>
                            {camera.loaiCamera}
                          </span>
                        </td>
                        <td>{camera.chucNangCamera}</td>
                        <td>{getZoneName(camera.maKhuVuc)}</td>
                        <td>
                          <div style={{display: 'flex', gap: '8px'}}>
                            <button 
                              className="dialog-btn dialog-btn-sm dialog-btn-primary"
                              onClick={() => handleEdit(camera)}
                            >
                              Sửa
                            </button>
                            <button 
                              className="dialog-btn dialog-btn-sm dialog-btn-danger"
                              onClick={() => handleDelete(camera)}
                            >
                              Xóa
                            </button>
                            {camera.linkRTSP && (
                              <button 
                                className="dialog-btn dialog-btn-sm dialog-btn-secondary"
                                onClick={() => testRTSP(camera.linkRTSP)}
                              >
                                Test
                              </button>
                            )}
                          </div>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            )}
          </div>

          {/* Right Panel - Camera Form */}
          <div className="dialog-panel primary">
            <div className="dialog-panel-title">
              {isEditing ? "Chỉnh Sửa Camera" : "Thêm Camera Mới"}
            </div>

            <form onSubmit={handleSubmit}>
              <div className="dialog-grid cols-2">
                <div className="form-group">
                  <label>Mã Camera *</label>
                  <input
                    type="text"
                    className="dialog-input"
                    value={formData.maCamera}
                    onChange={(e) => setFormData({...formData, maCamera: e.target.value})}
                    disabled={isEditing}
                    placeholder="VD: CAM001"
                    required
                  />
                </div>

                <div className="form-group">
                  <label>Tên Camera *</label>
                  <input
                    type="text"
                    className="dialog-input"
                    value={formData.tenCamera}
                    onChange={(e) => setFormData({...formData, tenCamera: e.target.value})}
                    placeholder="VD: Camera cổng vào chính"
                    required
                  />
                </div>

                <div className="form-group">
                  <label>Loại Camera *</label>
                  <select
                    className="dialog-select"
                    value={formData.loaiCamera}
                    onChange={(e) => setFormData({...formData, loaiCamera: e.target.value})}
                    required
                  >
                    <option value="VAO">Vào</option>
                    <option value="RA">Ra</option>
                  </select>
                </div>

                <div className="form-group">
                  <label>Chức Năng *</label>
                  <select
                    className="dialog-select"
                    value={formData.chucNangCamera}
                    onChange={(e) => setFormData({...formData, chucNangCamera: e.target.value})}
                    required
                  >
                    <option value="BIENSO">Nhận dạng biển số</option>
                    <option value="KHUONMAT">Nhận dạng khuôn mặt</option>
                  </select>
                </div>

                <div className="form-group">
                  <label>Khu Vực *</label>
                  <select
                    className="dialog-select"
                    value={formData.maKhuVuc}
                    onChange={(e) => setFormData({...formData, maKhuVuc: e.target.value})}
                    required
                  >
                    <option value="">Chọn khu vực</option>
                    {zones.map(zone => (
                      <option key={zone.maKhuVuc} value={zone.maKhuVuc}>
                        {zone.tenKhuVuc}
                      </option>
                    ))}
                  </select>
                </div>

                <div className="form-group">
                  <label>Link RTSP</label>
                  <div style={{display: 'flex', gap: '8px'}}>
                    <input
                      type="text"
                      className="dialog-input"
                      value={formData.linkRTSP}
                      onChange={(e) => setFormData({...formData, linkRTSP: e.target.value})}
                      placeholder="rtsp://192.168.1.100:554/stream"
                    />
                    <button 
                      type="button"
                      className="dialog-btn dialog-btn-secondary"
                      onClick={() => testRTSP(formData.linkRTSP)}
                    >
                      Test
                    </button>
                  </div>
                </div>
              </div>

              {selectedCamera && (
                <div className="info-section" style={{marginTop: '20px', padding: '16px', background: '#f0f9ff', borderRadius: '8px'}}>
                  <h4>Thông tin hiện tại:</h4>
                  <p><strong>Mã:</strong> {selectedCamera.maCamera}</p>
                  <p><strong>Tên:</strong> {selectedCamera.tenCamera}</p>
                  <p><strong>Khu vực:</strong> {getZoneName(selectedCamera.maKhuVuc)}</p>
                  {selectedCamera.linkRTSP && (
                    <p><strong>RTSP:</strong> <code>{selectedCamera.linkRTSP}</code></p>
                  )}
                </div>
              )}

              <div style={{marginTop: '24px', display: 'flex', gap: '12px'}}>
                <button 
                  type="submit" 
                  className="dialog-btn dialog-btn-primary"
                  disabled={loading}
                >
                  {loading ? "Đang xử lý..." : (isEditing ? "Cập nhật" : "Thêm mới")}
                </button>
                
                {isEditing && (
                  <button 
                    type="button"
                    className="dialog-btn dialog-btn-secondary"
                    onClick={resetForm}
                  >
                    Hủy chỉnh sửa
                  </button>
                )}
              </div>
            </form>
          </div>
        </div>

        <div className="dialog-footer">
          <button className="dialog-btn dialog-btn-primary" onClick={onSave}>
            Lưu & Đóng
          </button>
          <button className="dialog-btn dialog-btn-secondary" onClick={onClose}>
            Đóng
          </button>
        </div>
      </div>

      <style jsx>{`
        .badge {
          padding: 4px 8px;
          border-radius: 4px;
          font-size: 12px;
          font-weight: 600;
          text-transform: uppercase;
        }
        
        .badge-success {
          background: #dcfce7;
          color: #166534;
        }
        
        .badge-warning {
          background: #fef3c7;
          color: #92400e;
        }
        
        .dialog-btn-sm {
          padding: 4px 8px;
          font-size: 12px;
        }
        
        .form-group {
          margin-bottom: 16px;
        }
        
        .form-group label {
          display: block;
          margin-bottom: 4px;
          font-weight: 600;
          color: #374151;
        }
      `}</style>
    </div>
  )
}

export default CameraManagementDialogNew
