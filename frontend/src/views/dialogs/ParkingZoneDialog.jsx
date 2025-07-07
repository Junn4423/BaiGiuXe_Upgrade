"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/ParkingZoneDialog.css"
import { layDanhSachKhuVuc, themKhuVuc, capNhatKhuVuc, xoaKhuVuc, layDanhSachCamera, layDanhSachCong } from "../../api/api"
import AddCameraDialog from "./AddCameraDialog"
import GateManagementDialog from "./GateManagementDialog" 

const ParkingZoneDialog = ({ onClose }) => {
  const [zones, setZones] = useState([])
  const [selectedZone, setSelectedZone] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [isLoading, setIsLoading] = useState(false)
  const [showAddCamera, setShowAddCamera] = useState(false)
  const [showGateManagement, setShowGateManagement] = useState(false) // State cho dialog cổng
  const [showZoneDetails, setShowZoneDetails] = useState(false) // State cho xem chi tiết
  const [zoneStats, setZoneStats] = useState({}) // Thống kê camera/cổng theo khu vực
  const [zoneCameras, setZoneCameras] = useState([]) // Danh sách camera trong khu vực chi tiết
  const [zoneGates, setZoneGates] = useState([]) // Danh sách cổng trong khu vực chi tiết
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
      // Fetch all cameras and gates
      const allCameras = await layDanhSachCamera()
      const allGates = await layDanhSachCong()
      const stats = {}
      for (const zone of zoneList) {
        const cams = allCameras.filter(c => c.maKhuVuc === zone.maKhuVuc)
        const gates = allGates.filter(g => g.maKhuVuc === zone.maKhuVuc)
        stats[zone.maKhuVuc] = {
          tongCamera: cams.length,
          cameraVao: cams.filter(c => c.chucNangCamera === 'VAO').length,
          cameraRa: cams.filter(c => c.chucNangCamera === 'RA').length,
          tongCong: gates.length,
          congVao: gates.filter(g => g.loaiCong === 'VAO').length,
          congRa: gates.filter(g => g.loaiCong === 'RA').length
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
    // Load detailed lists
    loadZoneDetails(zone.maKhuVuc)
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
    // Load detailed lists
    loadZoneDetails(zone.maKhuVuc)
    setShowZoneDetails(true)
  }

  // Hàm quản lý cổng
  const handleManageGates = (zone) => {
    setSelectedZone(zone)
    setShowGateManagement(true)
  }

  // Load cameras and gates for detail view
  const loadZoneDetails = async (maKhuVuc) => {
    try {
      const cams = await layDanhSachCamera()
      const gates = await layDanhSachCong()
      setZoneCameras(cams.filter(c => c.maKhuVuc === maKhuVuc))
      setZoneGates(gates.filter(g => g.maKhuVuc === maKhuVuc))
    } catch (error) {
      console.error("Error loading zone details:", error)
      setZoneCameras([])
      setZoneGates([])
    }
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

              <div className="details-row">
                <div className="details-label">Danh sách Camera:</div>
                <div className="details-value">
                  {zoneCameras.length > 0 ? (
                    <ul>
                      {zoneCameras.map(camera => (
                        <li key={camera.maCamera}>{camera.tenCamera} ({camera.chucNangCamera})</li>
                      ))}
                    </ul>
                  ) : "Không có camera trong khu vực này."}
                </div>
              </div>

              <div className="details-row">
                <div className="details-label">Danh sách Cổng:</div>
                <div className="details-value">
                  {zoneGates.length > 0 ? (
                    <ul>
                      {zoneGates.map(gate => (
                        <li key={gate.maCong}>{gate.tenCong} ({gate.loaiCong})</li>
                      ))}
                    </ul>
                  ) : "Không có cổng trong khu vực này."}
                </div>
              </div>
            </div>
          )}
        </div>
      </div>
    )
  }

  // Hàm xử lý camera
  const handleAddCamera = (zone) => {
    console.log("Adding camera for zone:", zone)
    setSelectedZone(zone)
    setShowAddCamera(true)
  }

  const handleDeleteCameraDialog = (zone) => {
    console.log("Delete camera for zone:", zone)
    // Hiển thị dialog xác nhận hoặc danh sách camera để xóa
    if (window.confirm(`Bạn có chắc muốn xóa camera cho khu vực "${zone.tenKhuVuc}"?`)) {
      handleDeleteCamera(zone)
    }
  }

  const handleDeleteCamera = async (zone) => {
    try {
      setIsLoading(true)
      // Lấy danh sách camera của khu vực
      const allCameras = await layDanhSachCamera()
      const zoneCameras = allCameras.filter(c => c.maKhuVuc === zone.maKhuVuc)
      
      if (zoneCameras.length === 0) {
        alert("Không có camera nào trong khu vực này")
        return
      }

      // Hiển thị danh sách camera để chọn xóa
      const cameraNames = zoneCameras.map(c => `${c.tenCamera} (${c.maCamera})`).join('\n')
      const confirmDelete = window.confirm(`Khu vực "${zone.tenKhuVuc}" có ${zoneCameras.length} camera:\n${cameraNames}\n\nBạn có chắc muốn xóa tất cả camera này?`)
      
      if (confirmDelete) {
        // Xóa tất cả camera của khu vực (giả sử có API xóa camera)
        // await xoaCamera(zone.maKhuVuc)
        alert("Chức năng xóa camera đang được phát triển")
        // Reload data
        await loadZones()
      }
    } catch (error) {
      console.error("Error deleting cameras:", error)
      alert("Lỗi xóa camera: " + error.message)
    } finally {
      setIsLoading(false)
    }
  }

  // Đóng dialog camera
  const handleCloseAddCamera = () => {
    setShowAddCamera(false)
    setSelectedZone(null)
    // Reload zones để cập nhật số lượng camera
    loadZones()
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
                        <th>Quản lý Camera</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      {zones.length === 0 ? (
                        <tr><td colSpan="7" className="no-data">Không có khu vực</td></tr>
                      ) : (
                        zones.map(zone => (
                          <tr key={zone.maKhuVuc} className={selectedZone?.maKhuVuc === zone.maKhuVuc ? 'selected' : ''}>
                            <td>{zone.maKhuVuc}</td>
                            <td>{zone.tenKhuVuc}</td>
                            <td>{zoneStats[zone.maKhuVuc]?.tongCamera || 0}</td>
                            <td>{zoneStats[zone.maKhuVuc]?.tongCong || 0}</td>
                            <td>{zone.moTa || '-'}</td>
                            <td className="action-buttons">
                              <button className="btn btn-info" onClick={() => handleSelectZone(zone) & handleViewDetails(zone)}>Chi tiết</button>
                              <button className="btn btn-success" onClick={() => handleSelectZone(zone) & handleManageGates(zone)}>Cổng</button>
                              <button className="btn btn-secondary" onClick={() => { handleSelectZone(zone); setIsEditing(true) }}>Sửa</button>
                              <button className="btn btn-danger" onClick={() => { handleSelectZone(zone); handleDelete() }}>Xóa</button>
                            </td>
                          </tr>
                        ))
                      )}
                    </tbody>
                  </table>
                )}
              </div>
            </div>

            {/* Right Panel - Zone Details */}
            <div className="zone-form-panel">
              <div className="panel-header">
                <h4>{isEditing ? (selectedZone ? 'Chỉnh Sửa Khu Vực' : 'Thêm Khu Vực Mới') : 'Chi Tiết Khu Vực'}</h4>
              </div>

              {isEditing ? (
                <div className="zone-edit-form">
                  <div className="form-group">
                    <label className="form-label" htmlFor="maKhuVuc">Mã Khu Vực *</label>
                    <input
                      type="text"
                      id="maKhuVuc"
                      value={formData.maKhuVuc}
                      onChange={(e) => handleInputChange('maKhuVuc', e.target.value)}
                      placeholder="Nhập mã khu vực (VD: K001)"
                      disabled={!!selectedZone}
                    />
                  </div>
                  
                  <div className="form-group">
                    <label className="form-label" htmlFor="tenKhuVuc">Tên Khu Vực *</label>
                    <input
                      type="text"
                      id="tenKhuVuc"
                      value={formData.tenKhuVuc}
                      onChange={(e) => handleInputChange('tenKhuVuc', e.target.value)}
                      placeholder="Nhập tên khu vực (VD: Khu A)"
                    />
                  </div>
                  
                  <div className="form-group">
                    <label className="form-label" htmlFor="moTa">Mô Tả</label>
                    <textarea
                      id="moTa"
                      value={formData.moTa}
                      onChange={(e) => handleInputChange('moTa', e.target.value)}
                      placeholder="Nhập mô tả về khu vực..."
                      rows="3"
                    />
                  </div>
                </div>
              ) : selectedZone ? (
                <div className="zone-details-enhanced">
                  <div className="zone-info-card">
                    <h4>{selectedZone.tenKhuVuc}</h4>
                    <div className="zone-info-grid">
                      <div className="info-item">
                        <div className="info-label">Mã Khu Vực</div>
                        <div className="info-value">{selectedZone.maKhuVuc}</div>
                      </div>
                      <div className="info-item">
                        <div className="info-label">Mô Tả</div>
                        <div className="info-value">{selectedZone.moTa || "Chưa có mô tả"}</div>
                      </div>
                    </div>
                  </div>

                  <div className="equipment-section">
                    <h5>Camera Giám Sát</h5>
                    <div className="equipment-list">
                      {zoneCameras.length > 0 ? (
                        zoneCameras.map(camera => (
                          <div key={camera.maCamera} className="equipment-item">
                            <span className="equipment-name">{camera.tenCamera}</span>
                            <span className={`equipment-type ${camera.chucNangCamera?.toLowerCase()}`}>
                              {camera.chucNangCamera}
                            </span>
                          </div>
                        ))
                      ) : (
                        <div className="no-equipment">
                          Chưa có camera nào được cấu hình
                        </div>
                      )}
                    </div>
                  </div>

                  <div className="equipment-section">
                    <h5>Cổng Ra Vào</h5>
                    <div className="equipment-list">
                      {zoneGates.length > 0 ? (
                        zoneGates.map(gate => (
                          <div key={gate.maCong} className="equipment-item">
                            <span className="equipment-name">{gate.tenCong}</span>
                            <span className={`equipment-type ${gate.loaiCong?.toLowerCase()}`}>
                              {gate.loaiCong}
                            </span>
                          </div>
                        ))
                      ) : (
                        <div className="no-equipment">
                          Chưa có cổng nào được cấu hình
                        </div>
                      )}
                    </div>
                  </div>

                  <div className="zone-management-section">
                    <h5>Quản Lý Thiết Bị</h5>
                    <div className="management-buttons">
                      <button 
                        className="btn btn-camera" 
                        onClick={() => setShowAddCamera(true)}
                        disabled={isLoading}
                      >
                        Quản lý Camera
                      </button>
                      <button 
                        className="btn btn-gate" 
                        onClick={() => setShowGateManagement(true)}
                        disabled={isLoading}
                      >
                        Quản lý Cổng
                      </button>
                    </div>
                  </div>
                </div>
              ) : (
                <div className="no-selection">
                  <p>Chọn một khu vực từ danh sách để xem chi tiết</p>
                </div>
              )}

              {/* Action Buttons */}
              <div className="button-group">
                <button className="btn btn-primary" onClick={handleNewZone} disabled={isLoading}>
                  Thêm mới
                </button>

                {selectedZone && !isEditing && (
                  <>
                    <button className="btn btn-secondary" onClick={handleEdit} disabled={isLoading}>
                      Chỉnh sửa
                    </button>
                    <button className="btn btn-danger" onClick={handleDelete} disabled={isLoading}>
                      Xóa
                    </button>
                  </>
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
            maKhuVuc={selectedZone.maKhuVuc}
            onClose={handleCloseAddCamera}
            onSave={handleCloseAddCamera}
          />
        )}

        {showGateManagement && selectedZone && (
          <GateManagementDialog
            onClose={() => setShowGateManagement(false)}
            onSave={async () => { await loadZones(); setShowGateManagement(false); }}
            zoneId={selectedZone.maKhuVuc}
            zoneName={selectedZone.tenKhuVuc}
          />
        )}
      </div>
    </div>
  )
}

export default ParkingZoneDialog
