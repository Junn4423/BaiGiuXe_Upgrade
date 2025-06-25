"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/ParkingZoneDialog.css"
import { layDanhSachKhuVuc, themKhuVuc, capNhatKhuVuc, xoaKhuVuc } from "../../api/api"
import AddCameraDialog from "./AddCameraDialog"

const ParkingZoneDialog = ({ onClose }) => {
  const [zones, setZones] = useState([])
  const [selectedZone, setSelectedZone] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [isLoading, setIsLoading] = useState(false)
  const [showAddCamera, setShowAddCamera] = useState(false)
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
    } catch (error) {
      console.error("Error loading zones:", error)
      alert("Lỗi tải danh sách khu vực: " + error.message)
      setZones([])
    } finally {
      setIsLoading(false)
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
                        <th>Mô Tả</th>
                      </tr>
                    </thead>
                    <tbody>
                      {zones.length === 0 ? (
                        <tr>
                          <td colSpan="3" className="no-data">
                            Không có dữ liệu
                          </td>
                        </tr>
                      ) : (
                        zones.map((zone, index) => (
                          <tr
                            key={zone.maKhuVuc || index}
                            className={selectedZone?.maKhuVuc === zone.maKhuVuc ? "selected" : ""}
                            onClick={() => handleSelectZone(zone)}
                          >
                            <td>{zone.maKhuVuc}</td>
                            <td>{zone.tenKhuVuc}</td>
                            <td>{zone.moTa || ""}</td>
                          </tr>
                        ))
                      )}
                    </tbody>
                  </table>
                )}
              </div>
            </div>

            {/* Right Panel - Zone Form */}
            <div className="zone-form-panel">
              <div className="panel-header">
                <h4>Thông Tin Khu Vực</h4>
              </div>

              <div className="form-container">
                <div className="form-group">
                  <label>Mã Khu Vực:</label>
                  <input
                    type="text"
                    value={formData.maKhuVuc}
                    onChange={(e) => handleInputChange("maKhuVuc", e.target.value)}
                    disabled={!isEditing}
                    placeholder="Nhập mã khu vực"
                  />
                </div>

                <div className="form-group">
                  <label>Tên Khu Vực:</label>
                  <input
                    type="text"
                    value={formData.tenKhuVuc}
                    onChange={(e) => handleInputChange("tenKhuVuc", e.target.value)}
                    disabled={!isEditing}
                    placeholder="Nhập tên khu vực"
                  />
                </div>

                <div className="form-group">
                  <label>Mô Tả:</label>
                  <textarea
                    value={formData.moTa}
                    onChange={(e) => handleInputChange("moTa", e.target.value)}
                    disabled={!isEditing}
                    placeholder="Nhập mô tả khu vực"
                    rows="4"
                  />
                </div>
              </div>

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
              // Reload zone data if needed
            }}
          />
        )}
      </div>
    </div>
  )
}

export default ParkingZoneDialog
