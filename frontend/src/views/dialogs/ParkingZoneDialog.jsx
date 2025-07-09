"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/dialog-base.css"
import {
  layDanhSachKhuVuc,
  themKhuVuc,
  capNhatKhuVuc,
  xoaKhuVuc,
  layDanhSachCamera,
  layDanhSachCong,
} from "../../api/api"
import AddCameraDialog from "./AddCameraDialog"
import GateManagementDialog from "./GateManagementDialog"

const ParkingZoneDialog = ({ onClose }) => {
  const [zones, setZones] = useState([])
  const [selectedZone, setSelectedZone] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [isLoading, setIsLoading] = useState(false)
  const [showAddCamera, setShowAddCamera] = useState(false)
  const [showGateManagement, setShowGateManagement] = useState(false)
  const [zoneStats, setZoneStats] = useState({})
  const [zoneCameras, setZoneCameras] = useState([])
  const [zoneGates, setZoneGates] = useState([])
  const [errors, setErrors] = useState({})

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
        const cams = allCameras.filter((c) => c.maKhuVuc === zone.maKhuVuc)
        const gates = allGates.filter((g) => g.maKhuVuc === zone.maKhuVuc)
        stats[zone.maKhuVuc] = {
          tongCamera: cams.length,
          cameraVao: cams.filter((c) => c.chucNangCamera === "VAO").length,
          cameraRa: cams.filter((c) => c.chucNangCamera === "RA").length,
          tongCong: gates.length,
          congVao: gates.filter((g) => g.loaiCong === "VAO").length,
          congRa: gates.filter((g) => g.loaiCong === "RA").length,
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
    setErrors({})
    // Load detailed lists
    loadZoneDetails(zone.maKhuVuc)
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
    setErrors({})
  }

  const handleEdit = () => {
    if (!selectedZone) {
      alert("Vui lòng chọn khu vực cần sửa")
      return
    }
    console.log("Editing zone:", selectedZone)
    setIsEditing(true)
    setErrors({})
  }

  const validateInput = () => {
    const newErrors = {}

    if (!formData.maKhuVuc.trim()) {
      newErrors.maKhuVuc = "Vui lòng nhập mã khu vực"
    }
    if (!formData.tenKhuVuc.trim()) {
      newErrors.tenKhuVuc = "Vui lòng nhập tên khu vực"
    }

    setErrors(newErrors)
    return Object.keys(newErrors).length === 0
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
    setErrors({})
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
    setErrors({})
  }

  const handleInputChange = (field, value) => {
    console.log(`Changing ${field} to:`, value)
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }))
    if (errors[field]) {
      setErrors((prev) => ({ ...prev, [field]: "" }))
    }
  }

  // Load cameras and gates for detail view
  const loadZoneDetails = async (maKhuVuc) => {
    try {
      const cams = await layDanhSachCamera()
      const gates = await layDanhSachCong()
      setZoneCameras(cams.filter((c) => c.maKhuVuc === maKhuVuc))
      setZoneGates(gates.filter((g) => g.maKhuVuc === maKhuVuc))
    } catch (error) {
      console.error("Error loading zone details:", error)
      setZoneCameras([])
      setZoneGates([])
    }
  }

  // Render thống kê tổng quan
  const renderOverallStats = () => {
    const totalZones = zones.length
    const zonesWithCamera = Object.values(zoneStats).filter((stat) => stat.tongCamera > 0).length
    const totalCameras = Object.values(zoneStats).reduce((sum, stat) => sum + stat.tongCamera, 0)
    const totalGates = Object.values(zoneStats).reduce((sum, stat) => sum + stat.tongCong, 0)

    return (
      <div
        style={{
          display: "grid",
          gridTemplateColumns: "repeat(4, 1fr)",
          gap: "1rem",
          marginBottom: "1.5rem",
          padding: "1rem",
          background: "#f9fafb",
          borderRadius: "8px",
        }}
      >
        <div style={{ textAlign: "center" }}>
          <div style={{ fontSize: "1.5rem", fontWeight: "600", color: "#4f46e5" }}>{totalZones}</div>
          <div style={{ fontSize: "0.875rem", color: "#6b7280" }}>Tổng khu vực</div>
        </div>
        <div style={{ textAlign: "center" }}>
          <div style={{ fontSize: "1.5rem", fontWeight: "600", color: "#10b981" }}>{zonesWithCamera}</div>
          <div style={{ fontSize: "0.875rem", color: "#6b7280" }}>Có camera</div>
        </div>
        <div style={{ textAlign: "center" }}>
          <div style={{ fontSize: "1.5rem", fontWeight: "600", color: "#f59e0b" }}>{totalCameras}</div>
          <div style={{ fontSize: "0.875rem", color: "#6b7280" }}>Tổng camera</div>
        </div>
        <div style={{ textAlign: "center" }}>
          <div style={{ fontSize: "1.5rem", fontWeight: "600", color: "#ef4444" }}>{totalGates}</div>
          <div style={{ fontSize: "0.875rem", color: "#6b7280" }}>Tổng cổng</div>
        </div>
      </div>
    )
  }

  return (
    <div className="dialog-overlay">
      <div className="dialog-container large">
        <div className="dialog-header">
          <h3 className="dialog-title">Quản Lý Khu Vực Đỗ Xe</h3>
          <button className="dialog-close" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-body">
          {/* Thống kê tổng quan */}
          {renderOverallStats()}

          <div className="content-layout">
            {/* Left Panel - Zone List */}
            <div className="panel list-panel">
              <div className="panel-header">
                <h4 className="panel-title">Danh Sách Khu Vực ({zones.length})</h4>
                <div className="header-actions">
                  <button className="refresh-button" onClick={loadZones} disabled={isLoading}>
                    ↻ Làm mới
                  </button>
                </div>
              </div>

              <div className="panel-content">
                {isLoading ? (
                  <div className="loading-state">
                    <div className="loading-spinner"></div>
                    <p>Đang tải dữ liệu...</p>
                  </div>
                ) : zones.length === 0 ? (
                  <div className="empty-state">
                    <div className="empty-icon"></div>
                    <h4>Chưa có khu vực</h4>
                    <p>Thêm khu vực đầu tiên để bắt đầu</p>
                  </div>
                ) : (
                  <div className="item-list">
                    {zones.map((zone) => (
                      <div
                        key={zone.maKhuVuc}
                        className={`item-card ${selectedZone?.maKhuVuc === zone.maKhuVuc ? "selected" : ""}`}
                        onClick={() => handleSelectZone(zone)}
                      >
                        <div className="item-header">
                          <div>
                            <span className="item-code">{zone.maKhuVuc}</span>
                            <span className="item-name">{zone.tenKhuVuc}</span>
                          </div>
                        </div>
                        <div className="item-details">
                          <div>Camera: {zoneStats[zone.maKhuVuc]?.tongCamera || 0}</div>
                          <div>Cổng: {zoneStats[zone.maKhuVuc]?.tongCong || 0}</div>
                          <div style={{ fontSize: "0.75rem", color: "#6b7280" }}>{zone.moTa || "Không có mô tả"}</div>
                        </div>
                        <div className="item-actions">
                          <button
                            className="btn btn-primary btn-sm"
                            onClick={(e) => {
                              e.stopPropagation()
                              setSelectedZone(zone)
                              setShowAddCamera(true)
                            }}
                            title="Quản lý camera"
                          >
                            Camera
                          </button>
                          <button
                            className="btn btn-secondary btn-sm"
                            onClick={(e) => {
                              e.stopPropagation()
                              setSelectedZone(zone)
                              setShowGateManagement(true)
                            }}
                            title="Quản lý cổng"
                          >
                            Cổng
                          </button>
                        </div>
                      </div>
                    ))}
                  </div>
                )}
              </div>
            </div>

            {/* Right Panel - Zone Form */}
            <div className="panel form-panel">
              <div className="panel-header">
                <h4 className="panel-title">
                  {isEditing ? (selectedZone ? "Chỉnh Sửa Khu Vực" : "Thêm Khu Vực Mới") : "Chi Tiết Khu Vực"}
                </h4>
              </div>

              <div className="panel-content">
                {!selectedZone && !isEditing ? (
                  <div className="empty-state">
                    <div className="empty-icon"></div>
                    <h4>Chọn khu vực</h4>
                    <p>Chọn một khu vực từ danh sách để xem chi tiết</p>
                    <button className="btn btn-primary" onClick={handleNewZone}>
                      + Thêm Khu Vực Mới
                    </button>
                  </div>
                ) : isEditing ? (
                  <div className="form-container">
                    <div className="form-group">
                      <label className="form-label">Mã Khu Vực *</label>
                      <input
                        type="text"
                        className={`form-input ${errors.maKhuVuc ? "error" : ""}`}
                        value={formData.maKhuVuc}
                        onChange={(e) => handleInputChange("maKhuVuc", e.target.value)}
                        placeholder="Nhập mã khu vực (VD: K001)"
                        disabled={!!selectedZone}
                      />
                      {errors.maKhuVuc && <span className="error-message">{errors.maKhuVuc}</span>}
                    </div>

                    <div className="form-group">
                      <label className="form-label">Tên Khu Vực *</label>
                      <input
                        type="text"
                        className={`form-input ${errors.tenKhuVuc ? "error" : ""}`}
                        value={formData.tenKhuVuc}
                        onChange={(e) => handleInputChange("tenKhuVuc", e.target.value)}
                        placeholder="Nhập tên khu vực (VD: Khu A)"
                      />
                      {errors.tenKhuVuc && <span className="error-message">{errors.tenKhuVuc}</span>}
                    </div>

                    <div className="form-group">
                      <label className="form-label">Mô Tả</label>
                      <textarea
                        className="form-textarea"
                        value={formData.moTa}
                        onChange={(e) => handleInputChange("moTa", e.target.value)}
                        placeholder="Nhập mô tả về khu vực..."
                        rows="3"
                      />
                    </div>

                    <div style={{ display: "flex", gap: "0.75rem", marginTop: "1.5rem" }}>
                      <button className="btn btn-primary" onClick={handleSave} disabled={isLoading}>
                        {isLoading ? "Đang lưu..." : "Lưu"}
                      </button>
                      <button className="btn btn-secondary" onClick={handleCancel} disabled={isLoading}>
                        Hủy
                      </button>
                    </div>
                  </div>
                ) : (
                  <div className="form-container">
                    <div style={{ marginBottom: "1.5rem" }}>
                      <h4 style={{ margin: "0 0 1rem 0", color: "#374151" }}>{selectedZone.tenKhuVuc}</h4>
                      <div style={{ display: "grid", gap: "0.75rem" }}>
                        <div style={{ display: "flex", justifyContent: "space-between" }}>
                          <span style={{ fontWeight: "500", color: "#6b7280" }}>Mã Khu Vực:</span>
                          <span style={{ color: "#374151" }}>{selectedZone.maKhuVuc}</span>
                        </div>
                        <div style={{ display: "flex", justifyContent: "space-between" }}>
                          <span style={{ fontWeight: "500", color: "#6b7280" }}>Mô Tả:</span>
                          <span style={{ color: "#374151" }}>{selectedZone.moTa || "Chưa có mô tả"}</span>
                        </div>
                      </div>
                    </div>

                    <div style={{ marginBottom: "1.5rem" }}>
                      <h5 style={{ margin: "0 0 0.75rem 0", color: "#374151" }}>Camera Giám Sát</h5>
                      {zoneCameras.length > 0 ? (
                        <div style={{ display: "flex", flexDirection: "column", gap: "0.5rem" }}>
                          {zoneCameras.map((camera) => (
                            <div
                              key={camera.maCamera}
                              style={{
                                display: "flex",
                                justifyContent: "space-between",
                                padding: "0.5rem",
                                background: "#f9fafb",
                                borderRadius: "4px",
                                fontSize: "0.875rem",
                              }}
                            >
                              <span>{camera.tenCamera}</span>
                              <span
                                style={{
                                  color: camera.chucNangCamera === "VAO" ? "#10b981" : "#ef4444",
                                  fontWeight: "500",
                                }}
                              >
                                {camera.chucNangCamera}
                              </span>
                            </div>
                          ))}
                        </div>
                      ) : (
                        <p style={{ margin: 0, color: "#6b7280", fontSize: "0.875rem" }}>
                          Chưa có camera nào được cấu hình
                        </p>
                      )}
                    </div>

                    <div style={{ marginBottom: "1.5rem" }}>
                      <h5 style={{ margin: "0 0 0.75rem 0", color: "#374151" }}>Cổng Ra Vào</h5>
                      {zoneGates.length > 0 ? (
                        <div style={{ display: "flex", flexDirection: "column", gap: "0.5rem" }}>
                          {zoneGates.map((gate) => (
                            <div
                              key={gate.maCong}
                              style={{
                                display: "flex",
                                justifyContent: "space-between",
                                padding: "0.5rem",
                                background: "#f9fafb",
                                borderRadius: "4px",
                                fontSize: "0.875rem",
                              }}
                            >
                              <span>{gate.tenCong}</span>
                              <span
                                style={{
                                  color: gate.loaiCong === "VAO" ? "#10b981" : "#ef4444",
                                  fontWeight: "500",
                                }}
                              >
                                {gate.loaiCong}
                              </span>
                            </div>
                          ))}
                        </div>
                      ) : (
                        <p style={{ margin: 0, color: "#6b7280", fontSize: "0.875rem" }}>
                          Chưa có cổng nào được cấu hình
                        </p>
                      )}
                    </div>

                    <div style={{ display: "flex", gap: "0.75rem" }}>
                      <button className="btn btn-primary" onClick={handleEdit} disabled={isLoading}>
                        Chỉnh sửa
                      </button>
                      <button className="btn btn-danger" onClick={handleDelete} disabled={isLoading}>
                        Xóa
                      </button>
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>

        <div className="dialog-footer">
          <button className="btn btn-secondary" onClick={onClose}>
            Đóng
          </button>
          {!isEditing && (
            <button className="btn btn-primary" onClick={handleNewZone}>
              + Thêm Khu Vực
            </button>
          )}
        </div>

        {showAddCamera && selectedZone && (
          <AddCameraDialog
            maKhuVuc={selectedZone.maKhuVuc}
            onClose={() => setShowAddCamera(false)}
            onSave={async () => {
              await loadZones()
              setShowAddCamera(false)
            }}
          />
        )}

        {showGateManagement && selectedZone && (
          <GateManagementDialog
            onClose={() => setShowGateManagement(false)}
            onSave={async () => {
              await loadZones()
              setShowGateManagement(false)
            }}
            selectedZone={selectedZone.maKhuVuc}
          />
        )}
      </div>
    </div>
  )
}

export default ParkingZoneDialog
