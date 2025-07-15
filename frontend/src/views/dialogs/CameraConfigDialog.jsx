"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/CameraConfigDialog.css"
import { 
  layDanhSachCamera, 
  xoaCamera, 
  layDanhSachKhu,
  kiemTraTrangThaiTatCaCamera,
  phanLoaiCameraTheoTrangThai,
  testKetNoiRTSP,
  taoURLRTSP,
  layDanhSachCameraTheoLoai
} from "../../api/api"
import AddCameraDialog from "./AddCameraDialog"

const CameraConfigDialog = ({ onClose, onSave }) => {
  const [cameras, setCameras] = useState([])
  const [zones, setZones] = useState([])
  const [selectedZone, setSelectedZone] = useState("")
  const [selectedCamera, setSelectedCamera] = useState(null)
  const [showAddDialog, setShowAddDialog] = useState(false)
  const [editingCamera, setEditingCamera] = useState(null)
  const [loading, setLoading] = useState(false)
  
  // New states for advanced camera management
  const [cameraStatus, setCameraStatus] = useState({
    cameraVao: [],
    cameraRa: [],
    cameraOnline: [],
    cameraOffline: [],
    tongSo: 0
  })
  const [filterType, setFilterType] = useState("all") // all, vao, ra, online, offline
  const [testingCamera, setTestingCamera] = useState(null)
  const [cameraTestResults, setCameraTestResults] = useState({})
  const [showStatusPanel, setShowStatusPanel] = useState(true)

  useEffect(() => {
    loadZones()
    loadCamerasWithStatus()
  }, [])

  const loadZones = async () => {
    try {
      const zoneList = await layDanhSachKhu()
      setZones(zoneList || [])
      if (zoneList && zoneList.length > 0) {
        setSelectedZone(zoneList[0].maKhuVuc)
      }
    } catch (error) {
      console.error("Error loading zones:", error)
      alert("Lỗi tải danh sách khu vực: " + error.message)
    }
  }

  const loadCameras = async () => {
    try {
      setLoading(true)
      const cameraList = await layDanhSachCamera()
      setCameras(cameraList || [])
    } catch (error) {
      console.error("Error loading cameras:", error)
      alert("Lỗi tải danh sách camera: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  // Enhanced camera loading with status
  const loadCamerasWithStatus = async () => {
    try {
      setLoading(true)
      console.log("Loading cameras with status...")
      
      // Load camera classification and status
      const phanLoai = await phanLoaiCameraTheoTrangThai()
      setCameraStatus(phanLoai)
      
      // Load camera list
      const cameraList = await layDanhSachCamera()
      setCameras(cameraList || [])
      
      console.log("Cameras loaded with status:", {
        total: phanLoai.tongSo,
        entrance: phanLoai.cameraVao.length,
        exit: phanLoai.cameraRa.length,
        online: phanLoai.cameraOnline.length,
        offline: phanLoai.cameraOffline.length
      })
      
    } catch (error) {
      console.error("Error loading cameras with status:", error)
      alert("Lỗi tải danh sách camera: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  // Test RTSP connection for a camera
  const testCameraRTSP = async (camera) => {
    try {
      setTestingCamera(camera.maCamera)
      console.log(`Testing RTSP for camera: ${camera.tenCamera}`)
      
      const rtspUrl = taoURLRTSP(camera)
      if (!rtspUrl) {
        throw new Error("Không có URL RTSP")
      }
      
      const result = await testKetNoiRTSP(rtspUrl)
      
      // Update test results
      setCameraTestResults(prev => ({
        ...prev,
        [camera.maCamera]: {
          ...result,
          timestamp: new Date(),
          camera: camera.tenCamera
        }
      }))
      
      if (result.success) {
        alert(`Camera ${camera.tenCamera}: Kết nối RTSP thành công`)
      } else {
        alert(`Camera ${camera.tenCamera}: ${result.message}`)
      }
      
    } catch (error) {
      console.error(`❌ Error testing camera ${camera.tenCamera}:`, error)
      alert(`Lỗi test camera ${camera.tenCamera}: ${error.message}`)
      
      setCameraTestResults(prev => ({
        ...prev,
        [camera.maCamera]: {
          success: false,
          message: error.message,
          timestamp: new Date(),
          camera: camera.tenCamera
        }
      }))
    } finally {
      setTestingCamera(null)
    }
  }

  const handleZoneChange = (event) => {
    setSelectedZone(event.target.value)
  }

  const handleFilterTypeChange = (event) => {
    setFilterType(event.target.value)
  }

  // Enhanced camera filtering
  const getFilteredCameras = () => {
    let filtered = cameras

    // Filter by zone
    if (selectedZone) {
      filtered = filtered.filter(camera => camera.maKhuVuc === selectedZone)
    }

    // Filter by type/status
    switch (filterType) {
      case "vao":
        filtered = filtered.filter(camera => 
          camera.chucNangCamera === 'vào' || 
          camera.chucNangCamera === 'Vào' ||
          camera.loaiCamera === 'VAO'
        )
        break
      case "ra":
        filtered = filtered.filter(camera => 
          camera.chucNangCamera === 'ra' || 
          camera.chucNangCamera === 'Ra' ||
          camera.loaiCamera === 'RA'
        )
        break
      case "online":
        filtered = filtered.filter(camera => 
          cameraStatus.cameraOnline.some(onlineCamera => onlineCamera.maCamera === camera.maCamera)
        )
        break
      case "offline":
        filtered = filtered.filter(camera => 
          cameraStatus.cameraOffline.some(offlineCamera => offlineCamera.maCamera === camera.maCamera)
        )
        break
      default:
        // "all" - no additional filtering
        break
    }

    return filtered
  }

  const filteredCameras = getFilteredCameras()

  const handleAddCamera = () => {
    if (!selectedZone) {
      alert("Vui lòng chọn khu vực trước")
      return
    }
    setEditingCamera(null)
    setShowAddDialog(true)
  }

  const handleEditCamera = (camera) => {
    setEditingCamera(camera)
    setShowAddDialog(true)
  }

  const handleDeleteCamera = async (camera) => {
    if (!window.confirm(`Bạn có chắc muốn xóa camera ${camera.tenCamera}?`)) {
      return
    }

    try {
      setLoading(true)
      const result = await xoaCamera(camera.maCamera)
      if (result.success) {
        alert("Xóa camera thành công")
        await loadCameras()
      } else {
        alert("Lỗi xóa camera: " + (result.message || "Unknown error"))
      }
    } catch (error) {
      console.error("Error deleting camera:", error)
      alert("Lỗi xóa camera: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleCameraSaved = async () => {
    setShowAddDialog(false)
    setEditingCamera(null)
    await loadCamerasWithStatus()
  }

  const handleSave = () => {
    if (onSave) {
      onSave({ cameras, zones, cameraStatus })
    }
    onClose()
  }

  const handleRefreshStatus = async () => {
    await loadCamerasWithStatus()
  }

  const getCameraTypeText = (type) => {
    return type === "VAO" ? "Vào" : type === "RA" ? "Ra" : type
  }

  const getCameraFunctionText = (func) => {
    return func === "BIENSO" ? "Biển số" : func === "KHUONMAT" ? "Khuôn mặt" : func
  }

  const getCameraStatusIcon = (camera) => {
    const isOnline = cameraStatus.cameraOnline.some(c => c.maCamera === camera.maCamera)
    const testResult = cameraTestResults[camera.maCamera]
    
    if (testResult) {
      return testResult.success ? "🟢" : "🔴"
    }
    
    return isOnline ? "🟡" : "⚪"
  }

  const getCameraStatusText = (camera) => {
    const isOnline = cameraStatus.cameraOnline.some(c => c.maCamera === camera.maCamera)
    const testResult = cameraTestResults[camera.maCamera]
    
    if (testResult) {
      return testResult.success ? "Đã test OK" : "Test thất bại"
    }
    
    return isOnline ? "Online" : "Offline"
  }

  return (
    <div className="dialog-overlay">
      <div className="camera-config-dialog">
        <div className="dialog-header">
          <h3>Cấu Hình Camera</h3>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          {/* Status Panel */}
          {showStatusPanel && (
            <div className="status-panel">
              <div className="panel-header">
                <h4>Trạng Thái Camera</h4>
                <div className="status-controls">
                  <button 
                    className="btn btn-refresh" 
                    onClick={handleRefreshStatus}
                    disabled={loading}
                  >
                    ↻ Làm mới
                  </button>
                  <button 
                    className="btn btn-secondary" 
                    onClick={() => setShowStatusPanel(false)}
                  >
                    ▲ Ẩn
                  </button>
                </div>
              </div>
              <div className="status-summary">
                <div className="status-item">
                  <span className="status-label">Tổng số:</span>
                  <span className="status-value">{cameraStatus.tongSo}</span>
                </div>
                <div className="status-item">
                  <span className="status-label">Vào:</span>
                  <span className="status-value">{cameraStatus.cameraVao.length}</span>
                </div>
                <div className="status-item">
                  <span className="status-label">Ra:</span>
                  <span className="status-value">{cameraStatus.cameraRa.length}</span>
                </div>
                <div className="status-item">
                  <span className="status-label">Online:</span>
                  <span className="status-value">{cameraStatus.cameraOnline.length}</span>
                </div>
                <div className="status-item">
                  <span className="status-label">Offline:</span>
                  <span className="status-value">{cameraStatus.cameraOffline.length}</span>
                </div>
              </div>
            </div>
          )}
          
          {!showStatusPanel && (
            <div className="status-toggle">
              <button 
                className="btn btn-secondary" 
                onClick={() => setShowStatusPanel(true)}
              >
                ▼ Hiện trạng thái
              </button>
            </div>
          )}

          {/* Filter Section */}
          <div className="filter-section">
            <div className="panel-header">
              <h4>Bộ Lọc</h4>
            </div>
            <div className="filter-row">
              <div className="filter-group">
                <label>Khu vực:</label>
                <select value={selectedZone} onChange={handleZoneChange}>
                  <option value="">Tất cả khu vực</option>
                  {zones.map((zone) => (
                    <option key={zone.maKhuVuc} value={zone.maKhuVuc}>
                      {zone.tenKhuVuc}
                    </option>
                  ))}
                </select>
              </div>
              
              <div className="filter-group">
                <label>Loại camera:</label>
                <select value={filterType} onChange={handleFilterTypeChange}>
                  <option value="all">Tất cả</option>
                  <option value="vao">Camera vào</option>
                  <option value="ra">Camera ra</option>
                  <option value="online">Online</option>
                  <option value="offline">Offline</option>
                </select>
              </div>
              
              <button className="btn btn-primary add-button" onClick={handleAddCamera}>
                + Thêm Camera
              </button>
            </div>
          </div>

          {/* Camera List */}
          <div className="camera-list-panel">
            <div className="panel-header">
              <h4>Danh Sách Camera</h4>
            </div>
            <div className="camera-table-container">
              {loading ? (
                <div className="loading">Đang tải...</div>
              ) : (
                <table className="camera-table">
                  <thead>
                    <tr>
                      <th>Trạng thái</th>
                      <th>Mã Camera</th>
                      <th>Tên Camera</th>
                      <th>Loại</th>
                      <th>Chức năng</th>
                      <th>Khu vực</th>
                      <th>Link RTSP</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    {filteredCameras.map((camera) => (
                      <tr key={camera.maCamera}>
                        <td className="status-cell">
                          <span className="status-icon" title={getCameraStatusText(camera)}>
                            {getCameraStatusIcon(camera)}
                          </span>
                          <small>{getCameraStatusText(camera)}</small>
                        </td>
                        <td>{camera.maCamera}</td>
                        <td>{camera.tenCamera}</td>
                        <td>{getCameraTypeText(camera.loaiCamera)}</td>
                        <td>{getCameraFunctionText(camera.chucNangCamera)}</td>
                        <td>{camera.maKhuVuc}</td>
                        <td className="rtsp-link" title={camera.linkRTSP}>
                          {camera.linkRTSP?.length > 20 
                            ? camera.linkRTSP.substring(0, 20) + "..." 
                            : camera.linkRTSP
                          }
                        </td>
                        <td className="actions-cell">
                          <button 
                            className="btn btn-primary test-button" 
                            onClick={() => testCameraRTSP(camera)}
                            disabled={testingCamera === camera.maCamera}
                            title="Test kết nối RTSP"
                          >
                            {testingCamera === camera.maCamera ? "⏳" : "🔍"}
                          </button>
                          <button 
                            className="btn btn-secondary edit-button" 
                            onClick={() => handleEditCamera(camera)}
                            title="Chỉnh sửa camera"
                          >
                            
                          </button>
                          <button 
                            className="btn btn-danger delete-button" 
                            onClick={() => handleDeleteCamera(camera)}
                            title="Xóa camera"
                          >
                          
                          </button>
                        </td>
                      </tr>
                    ))}
                    {filteredCameras.length === 0 && (
                      <tr>
                        <td colSpan="8" className="no-data">
                          {filterType === "all" 
                            ? "Không có camera nào" 
                            : `Không có camera ${filterType === "vao" ? "vào" : filterType === "ra" ? "ra" : filterType}`
                          }
                        </td>
                      </tr>
                    )}
                  </tbody>
                </table>
              )}
            </div>
          </div>
        </div>

        <div className="dialog-footer">
          <button className="btn btn-success save-button" onClick={handleSave}>
            Lưu
          </button>
          <button className="btn btn-cancel cancel-button" onClick={onClose}>
            Hủy
          </button>
        </div>

        {/* Add/Edit Camera Dialog */}
        {showAddDialog && (
          <AddCameraDialog
            maKhuVuc={selectedZone}
            cameraData={editingCamera}
            onClose={() => setShowAddDialog(false)}
            onSave={handleCameraSaved}
          />
        )}
      </div>
    </div>
  )
}

export default CameraConfigDialog
