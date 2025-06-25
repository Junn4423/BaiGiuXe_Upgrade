"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/CameraConfigDialog.css"
import { layDanhSachCamera, xoaCamera, layDanhSachKhu } from "../../api/api"
import AddCameraDialog from "./AddCameraDialog"

const CameraConfigDialog = ({ onClose, onSave }) => {
  const [cameras, setCameras] = useState([])
  const [zones, setZones] = useState([])
  const [selectedZone, setSelectedZone] = useState("")
  const [selectedCamera, setSelectedCamera] = useState(null)
  const [showAddDialog, setShowAddDialog] = useState(false)
  const [editingCamera, setEditingCamera] = useState(null)
  const [loading, setLoading] = useState(false)

  useEffect(() => {
    loadZones()
    loadCameras()
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

  const handleZoneChange = (event) => {
    setSelectedZone(event.target.value)
  }

  const filteredCameras = cameras.filter((camera) => !selectedZone || camera.maKhuVuc === selectedZone)

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
    await loadCameras()
  }

  const handleSave = () => {
    if (onSave) {
      onSave({ cameras, zones })
    }
    onClose()
  }

  const getCameraTypeText = (type) => {
    return type === "VAO" ? "Vào" : "Ra"
  }

  const getCameraFunctionText = (func) => {
    return func === "BIENSO" ? "Biển số" : "Khuôn mặt"
  }

  return (
    <div className="dialog-overlay">
      <div className="camera-config-dialog">
        <div className="dialog-header">
          <h2>Cấu Hình Camera</h2>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          {/* Zone Filter */}
          <div className="filter-section">
            <label>Khu vực:</label>
            <select value={selectedZone} onChange={handleZoneChange}>
              <option value="">Tất cả khu vực</option>
              {zones.map((zone) => (
                <option key={zone.maKhuVuc} value={zone.maKhuVuc}>
                  {zone.tenKhuVuc}
                </option>
              ))}
            </select>
            <button className="add-button" onClick={handleAddCamera}>
              Thêm Camera
            </button>
          </div>

          {/* Camera List */}
          <div className="camera-list">
            {loading ? (
              <div className="loading">Đang tải...</div>
            ) : (
              <table className="camera-table">
                <thead>
                  <tr>
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
                      <td>{camera.maCamera}</td>
                      <td>{camera.tenCamera}</td>
                      <td>{getCameraTypeText(camera.loaiCamera)}</td>
                      <td>{getCameraFunctionText(camera.chucNangCamera)}</td>
                      <td>{camera.maKhuVuc}</td>
                      <td className="rtsp-link">{camera.linkRTSP}</td>
                      <td>
                        <button className="edit-button" onClick={() => handleEditCamera(camera)}>
                          Sửa
                        </button>
                        <button className="delete-button" onClick={() => handleDeleteCamera(camera)}>
                          Xóa
                        </button>
                      </td>
                    </tr>
                  ))}
                  {filteredCameras.length === 0 && (
                    <tr>
                      <td colSpan="7" className="no-data">
                        Không có camera nào
                      </td>
                    </tr>
                  )}
                </tbody>
              </table>
            )}
          </div>
        </div>

        <div className="dialog-footer">
          <button className="save-button" onClick={handleSave}>
            Lưu
          </button>
          <button className="cancel-button" onClick={onClose}>
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
