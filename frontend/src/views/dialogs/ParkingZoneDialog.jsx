"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/ParkingZoneDialog.css"
import "../../assets/styles/enhanced-dialogs.css"
import { layDanhSachKhuVuc, themKhuVuc, capNhatKhuVuc, xoaKhuVuc } from "../../api/api"
import AddCameraDialog from "./AddCameraDialog"
import GateManagementDialog from "./GateManagementDialog" // Thêm dialog quản lý cổng

const ParkingZoneDialog = ({ onClose }) => {
  const [zones, setZones] = useState([])
  const [selectedZone, setSelectedZone] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [isLoading, setIsLoading] = useState(false)
  const [showAddCamera, setShowAddCamera] = useState(false)
  const [showGateManagement, setShowGateManagement] = useState(false) // State cho dialog cổng
  const [showZoneDetails, setShowZoneDetails] = useState(false) // State cho xem chi tiết
  const [zoneStats, setZoneStats] = useState({}) // Thống kê camera/cổng theo khu vực
  const [formData, setFormData] = useState({
    maKhuVuc: "",
    tenKhuVuc: "",
    moTa: "",
  })

  useEffect(() => {
    console.log("ParkingZoneDialog mounted, loading zones...")
    loadZones()
  }, [])

  const loadZones = async () => {
    try {
      setIsLoading(true)
      console.log("Loading zones from API...")
      const zoneList = await layDanhSachKhuVuc()
      console.log("Loaded zones:", zoneList)
      setZones(Array.isArray(zoneList) ? zoneList : [])
      
      // Load thống kê cho từng khu vực
      await loadZoneStats(zoneList)
    } catch (error) {
      console.error("Error loading zones:", error)
      alert("Lỗi tải danh sách khu vực: " + error.message)
      setZones([])
    } finally {
      setIsLoading(false)
    }
  }

  // Thêm function để load thống kê khu vực
  const loadZoneStats = async (zoneList) => {
    try {
      const stats = {}
      for (const zone of zoneList) {
        // Giả lập API call để lấy thống kê - cần implement API thực tế
        stats[zone.maKhuVuc] = {
          tongCamera: 0,
          cameraVao: 0,
          cameraRa: 0,
          tongCong: 0,
          congVao: 0,
          congRa: 0
        }
      }
      setZoneStats(stats)
    } catch (error) {
      console.error("Error loading zone stats:", error)
    }
  }

  const handleSelectZone = (zone) => {
    console.log("Selected zone:", zone)
    setSelectedZone(zone)
    setFormData({
      maKhuVuc: zone.maKhuVuc || "",
      tenKhuVuc: zone.tenKhuVuc || "",
      moTa: zone.moTa || "",
    })
    setIsEditing(false)
    setShowZoneDetails(true)
  }

  const handleNewZone = () => {
    console.log("Creating new zone")
    setSelectedZone(null)
    setIsEditing(true)
    setFormData({
      maKhuVuc: "",
      tenKhuVuc: "",
      moTa: "",
    })
  }

  const handleEdit = () => {
    if (!selectedZone) {
      alert("Vui lòng chọn khu vực cần sửa")
      return
    }
    console.log("Editing zone:", selectedZone)
    setIsEditing(true)
  }

  const validateInput = () => {
    if (!formData.maKhuVuc.trim()) {
      alert("Vui lòng nhập mã khu vực")
      return false
    }
    if (!formData.tenKhuVuc.trim()) {
      alert("Vui lòng nhập tên khu vực")
      return false
    }
    return true
  }

  const handleSave = async () => {
    console.log("Saving zone...")
    if (!validateInput()) return

    try {
      setIsLoading(true)
      const zoneData = {
        maKhuVuc: formData.maKhuVuc.trim(),
        tenKhuVuc: formData.tenKhuVuc.trim(),
        moTa: formData.moTa.trim() || "",
      }

      console.log("Zone data to save:", zoneData)

      let result
      if (selectedZone) {
        // Update existing zone
        console.log("Updating existing zone:", selectedZone.maKhuVuc)
        result = await capNhatKhuVuc(zoneData)
      } else {
        // Add new zone
        console.log("Adding new zone")
        result = await themKhuVuc(zoneData)
      }

      console.log("Save result:", result)

      if (result && result.success) {
        alert(selectedZone ? "Cập nhật khu vực thành công!" : "Thêm khu vực thành công!")
        await loadZones()
        setIsEditing(false)
      } else {
        alert(result?.message || "Không thể lưu khu vực")
      }
    } catch (error) {
      console.error("Error saving zone:", error)
      alert("Lỗi lưu khu vực: " + error.message)
    } finally {
      setIsLoading(false)
    }
  }

  const handleDelete = async () => {
    if (!selectedZone) {
      alert("Vui lòng chọn khu vực cần xóa")
      return
    }

    if (window.confirm(`Bạn có chắc muốn xóa khu vực "${selectedZone.tenKhuVuc}"?`)) {
      try {
        setIsLoading(true)
        console.log("Deleting zone:", selectedZone.maKhuVuc)
        const result = await xoaKhuVuc(selectedZone.maKhuVuc)
        console.log("Delete result:", result)

        if (result && result.success) {
          alert("Xóa khu vực thành công!")
          await loadZones()
          clearForm()
        } else {
          alert(result?.message || "Không thể xóa khu vực")
        }
      } catch (error) {
        console.error("Error deleting zone:", error)
        alert("Lỗi xóa khu vực: " + error.message)
      } finally {
        setIsLoading(false)
      }
    }
  }

  const clearForm = () => {
    console.log("Clearing form")
    setFormData({
      maKhuVuc: "",
      tenKhuVuc: "",
      moTa: "",
    })
    setSelectedZone(null)
    setIsEditing(false)
  }

  const handleCancel = () => {
    console.log("Canceling edit")
    if (selectedZone) {
      setFormData({
        maKhuVuc: selectedZone.maKhuVuc || "",
        tenKhuVuc: selectedZone.tenKhuVuc || "",
        moTa: selectedZone.moTa || "",
      })
    } else {
      clearForm()
    }
    setIsEditing(false)
  }

  const handleInputChange = (field, value) => {
    console.log(`Changing ${field} to:`, value)
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }))
  }

  // Hàm xem chi tiết khu vực
  const handleViewDetails = (zone) => {
    setSelectedZone(zone)
    setShowZoneDetails(true)
  }

  // Hàm quản lý cổng
  const handleManageGates = (zone) => {
    setSelectedZone(zone)
    setShowGateManagement(true)
  }

  // Render thống kê tổng quan
  const renderOverallStats = () => {
    const totalZones = zones.length
    const zonesWithCamera = Object.values(zoneStats).filter(stat => stat.tongCamera > 0).length
    const totalCameras = Object.values(zoneStats).reduce((sum, stat) => sum + stat.tongCamera, 0)
    const totalGates = Object.values(zoneStats).reduce((sum, stat) => sum + stat.tongCong, 0)

    return (
      <div className="stats-overview">
        <div className="stat-card">
          <div className="stat-number">{totalZones}</div>
          <div className="stat-label">Tổng khu vực</div>
        </div>
        <div className="stat-card">
          <div className="stat-number">{zonesWithCamera}</div>
          <div className="stat-label">Có camera</div>
        </div>
        <div className="stat-card">
          <div className="stat-number">{totalCameras}</div>
          <div className="stat-label">Tổng camera</div>
        </div>
        <div className="stat-card">
          <div className="stat-number">{totalGates}</div>
          <div className="stat-label">Tổng cổng</div>
        </div>
      </div>
    )
  }

  const renderZoneDetails = () => {
    if (!selectedZone) return null
    
    const stats = zoneStats[selectedZone.maKhuVuc] || {}
    
    return (
      <div className="zone-details">
        <div className="zone-tabs">
          <button 
            className={`tab-button ${showZoneDetails ? 'active' : ''}`}
            onClick={() => setShowZoneDetails(true)}
          >
            Thông tin chi tiết
          </button>
        </div>

        <div className="tab-content">
          {showZoneDetails && (
            <div className="details-container">
              <h4>Chi tiết khu vực: {selectedZone.tenKhuVuc}</h4>
              
              <div className="details-row">
                <div className="details-label">Mã Khu Vực:</div>
                <div className="details-value">{selectedZone.maKhuVuc}</div>
              </div>
              
              <div className="details-row">
                <div className="details-label">Tên Khu Vực:</div>
                <div className="details-value">{selectedZone.tenKhuVuc}</div>
              </div>
              
              <div className="details-row">
                <div className="details-label">Mô Tả:</div>
                <div className="details-value">{selectedZone.moTa || "Không có mô tả"}</div>
              </div>
              
              <div className="details-row stats-row">
                <div className="details-label">Thống kê:</div>
                <div className="details-value">
                  <div className="stats-item">
                    <span className="stats-label">Tổng Camera:</span>
                    <span className="stats-value">{stats.tongCamera || 0}</span>
                  </div>
                  <div className="stats-item">
                    <span className="stats-label">Camera Vào:</span>
                    <span className="stats-value">{stats.cameraVao || 0}</span>
                  </div>
                  <div className="stats-item">
                    <span className="stats-label">Camera Ra:</span>
                    <span className="stats-value">{stats.cameraRa || 0}</span>
                  </div>
                  <div className="stats-item">
                    <span className="stats-label">Tổng Cổng:</span>
                    <span className="stats-value">{stats.tongCong || 0}</span>
                  </div>
                  <div className="stats-item">
                    <span className="stats-label">Cổng Vào:</span>
                    <span className="stats-value">{stats.congVao || 0}</span>
                  </div>
                  <div className="stats-item">
                    <span className="stats-label">Cổng Ra:</span>
                    <span className="stats-value">{stats.congRa || 0}</span>
                  </div>
                </div>
              </div>
            </div>
          )}
        </div>
      </div>
    )
  }

  return (
    <div className="dialog-overlay">
      <div className="parking-zone-dialog">
        {/* Header */}
        <div className="dialog-header">
          <h3>Quản Lý Khu Vực Đỗ Xe</h3>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          {/* Thống kê tổng quan */}
          {renderOverallStats()}
          
          <div className="content-layout">
            {/* Left Panel - Zone List */}
            <div className="zone-list-panel">
              <div className="panel-header">
                <h4>Danh Sách Khu Vực</h4>
              </div>

              <div className="zone-table-container">
                {isLoading ? (
                  <div className="loading-message">Đang tải dữ liệu...</div>
                ) : (
                  <table className="zone-table">
                    <thead>
                      <tr>
                        <th>Mã Khu Vực</th>
                        <th>Tên Khu Vực</th>
                        <th>Camera</th>
                        <th>Cổng</th>
                        <th>Mô Tả</th>
                      </tr>
                    </thead>
                    <tbody>
                      {zones.length === 0 ? (
                        <tr>
                          <td colSpan="5" className="no-data">
                            Không có dữ liệu
                          </td>
                        </tr>
                      ) : (
                        zones.map((zone, index) => {
                          const stats = zoneStats[zone.maKhuVuc] || {}
                          return (
                            <tr
                              key={zone.maKhuVuc || index}
                              className={selectedZone?.maKhuVuc === zone.maKhuVuc ? "selected" : ""}
                              onClick={() => handleSelectZone(zone)}
                            >
                              <td>{zone.maKhuVuc}</td>
                              <td>{zone.tenKhuVuc}</td>
                              <td>{stats.tongCamera || 0}</td>
                              <td>{stats.tongCong || 0}</td>
                              <td>{zone.moTa || ""}</td>
                            </tr>
                          )
                        })
                      )}
                    </tbody>
                  </table>
                )}
              </div>
            </div>

            {/* Right Panel - Zone Details */}
            <div className="zone-form-panel">
              <div className="panel-header">
                <h4>Chi Tiết Khu Vực</h4>
              </div>

              {selectedZone ? renderZoneDetails() : (
                <div className="no-selection">
                  <p>Chọn một khu vực để xem chi tiết</p>
                </div>
              )}

              {/* Action Buttons */}
              <div className="button-group">
                <button className="btn btn-primary" onClick={handleNewZone} disabled={isLoading}>
                  Thêm mới
                </button>

                {selectedZone && !isEditing && (
                  <button className="btn btn-secondary" onClick={handleEdit} disabled={isLoading}>
                    Cập nhật
                  </button>
                )}

                {selectedZone && !isEditing && (
                  <button className="btn btn-danger" onClick={handleDelete} disabled={isLoading}>
                    Xóa
                  </button>
                )}

                {selectedZone && !isEditing && (
                  <button className="btn btn-info" onClick={() => setShowAddCamera(true)} disabled={isLoading}>
                    Quản lý Camera
                  </button>
                )}

                {isEditing && (
                  <>
                    <button className="btn btn-success" onClick={handleSave} disabled={isLoading}>
                      {isLoading ? "Đang lưu..." : "Lưu"}
                    </button>
                    <button className="btn btn-cancel" onClick={handleCancel} disabled={isLoading}>
                      Hủy
                    </button>
                  </>
                )}

                <button className="btn btn-refresh" onClick={clearForm} disabled={isLoading}>
                  Làm mới
                </button>
              </div>
            </div>
          </div>
        </div>

        {showAddCamera && selectedZone && (
          <AddCameraDialog
            zoneId={selectedZone.maKhuVuc}
            zoneName={selectedZone.tenKhuVuc}
            onClose={() => setShowAddCamera(false)}
            onSave={() => {
              setShowAddCamera(false)
              loadZoneStats() // Reload stats after camera changes
            }}
          />
        )}

        {showGateManagement && selectedZone && (
          <GateManagementDialog
            zoneId={selectedZone.maKhuVuc}
            zoneName={selectedZone.tenKhuVuc}
            onClose={() => setShowGateManagement(false)}
            onSave={() => {
              setShowGateManagement(false)
              loadZoneStats() // Reload stats after gate changes
            }}
          />
        )}
      </div>
    </div>
  )
}

export default ParkingZoneDialog
