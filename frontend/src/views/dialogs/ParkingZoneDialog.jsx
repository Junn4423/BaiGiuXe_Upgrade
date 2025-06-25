"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/ParkingZoneDialog.css"
import { layDanhSachKhuVuc, themKhuVuc, capNhatKhuVuc, xoaKhuVuc } from "../../api/api"
import AddCameraDialog from "./AddCameraDialog"

const ParkingZoneDialog = ({ onClose }) => {
  const [zones, setZones] = useState([])
  const [selectedZone, setSelectedZone] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [showAddCamera, setShowAddCamera] = useState(false)
  const [formData, setFormData] = useState({
    maKhuVuc: "",
    tenKhuVuc: "",
    moTa: "",
  })

  useEffect(() => {
    loadZones()
  }, [])

  const loadZones = async () => {
    try {
      const zoneList = await layDanhSachKhuVuc()
      console.log("Loaded zones:", zoneList)
      setZones(Array.isArray(zoneList) ? zoneList : [])
    } catch (error) {
      console.error("Error loading zones:", error)
      alert("Lỗi tải danh sách khu vực: " + error.message)
    }
  }

  const handleSelectZone = (zone) => {
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
    // Clear form completely
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
    setIsEditing(true)
  }

  const handleSave = async () => {
    try {
      if (!formData.maKhuVuc.trim() || !formData.tenKhuVuc.trim()) {
        alert("Vui lòng nhập đầy đủ mã khu vực và tên khu vực")
        return
      }

      const zoneData = {
        maKhuVuc: formData.maKhuVuc.trim(),
        tenKhuVuc: formData.tenKhuVuc.trim(),
        moTa: formData.moTa.trim() || "",
      }

      console.log("Saving zone data:", zoneData)

      if (selectedZone) {
        // Update existing zone
        const result = await capNhatKhuVuc(zoneData)
        console.log("Update result:", result)
        if (result && result.success) {
          alert("Cập nhật khu vực thành công!")
        } else {
          alert(result?.message || "Cập nhật khu vực thất bại!")
          return
        }
      } else {
        // Add new zone
        const result = await themKhuVuc(zoneData)
        console.log("Add result:", result)
        if (result && result.success) {
          alert("Thêm khu vực thành công!")
        } else {
          alert(result?.message || "Thêm khu vực thất bại!")
          return
        }
      }

      // Reload zones and reset form
      await loadZones()
      setIsEditing(false)
      setSelectedZone(null)
      setFormData({
        maKhuVuc: "",
        tenKhuVuc: "",
        moTa: "",
      })
    } catch (error) {
      console.error("Error saving zone:", error)
      alert("Lỗi lưu khu vực: " + error.message)
    }
  }

  const handleDelete = async () => {
    if (!selectedZone) {
      alert("Vui lòng chọn khu vực cần xóa")
      return
    }

    if (window.confirm(`Bạn có chắc muốn xóa khu vực "${selectedZone.tenKhuVuc}"?`)) {
      try {
        const result = await xoaKhuVuc(selectedZone.maKhuVuc)
        console.log("Delete result:", result)
        if (result && result.success) {
          alert("Xóa khu vực thành công!")
          await loadZones()
          setSelectedZone(null)
          setFormData({
            maKhuVuc: "",
            tenKhuVuc: "",
            moTa: "",
          })
          setIsEditing(false)
        } else {
          alert(result?.message || "Xóa khu vực thất bại!")
        }
      } catch (error) {
        console.error("Error deleting zone:", error)
        alert("Lỗi xóa khu vực: " + error.message)
      }
    }
  }

  const handleCancel = () => {
    if (selectedZone) {
      setFormData({
        maKhuVuc: selectedZone.maKhuVuc || "",
        tenKhuVuc: selectedZone.tenKhuVuc || "",
        moTa: selectedZone.moTa || "",
      })
    } else {
      setFormData({
        maKhuVuc: "",
        tenKhuVuc: "",
        moTa: "",
      })
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
        <div className="dialog-header">
          <h3>Quản Lý Khu Vực Đỗ Xe</h3>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          <div className="zones-section">
            <div className="zones-list">
              <div className="list-header">
                <h4>Danh Sách Khu Vực</h4>
                <button className="btn btn-primary" onClick={handleNewZone}>
                  Thêm Mới
                </button>
              </div>
              <div className="zones-table">
                <table>
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
                        <td colSpan="3" style={{ textAlign: "center", padding: "20px" }}>
                          Không có dữ liệu
                        </td>
                      </tr>
                    ) : (
                      zones.map((zone, index) => (
                        <tr
                          key={zone.maKhuVuc || index}
                          className={selectedZone?.maKhuVuc === zone.maKhuVuc ? "selected" : ""}
                          onClick={() => handleSelectZone(zone)}
                          style={{ cursor: "pointer" }}
                        >
                          <td>{zone.maKhuVuc}</td>
                          <td>{zone.tenKhuVuc}</td>
                          <td>{zone.moTa || ""}</td>
                        </tr>
                      ))
                    )}
                  </tbody>
                </table>
              </div>
            </div>

            <div className="zone-details">
              <div className="details-header">
                <h4>Thông Tin Khu Vực</h4>
                <div className="action-buttons">
                  {selectedZone && !isEditing && (
                    <>
                      <button className="btn btn-secondary" onClick={handleEdit}>
                        Sửa
                      </button>
                      <button className="btn btn-danger" onClick={handleDelete}>
                        Xóa
                      </button>
                      <button className="btn btn-info" onClick={() => setShowAddCamera(true)}>
                        Quản lý Camera
                      </button>
                    </>
                  )}
                  {isEditing && (
                    <>
                      <button className="btn btn-primary" onClick={handleSave}>
                        Lưu
                      </button>
                      <button className="btn btn-cancel" onClick={handleCancel}>
                        Hủy
                      </button>
                    </>
                  )}
                </div>
              </div>

              <div className="form-section">
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
                    rows="3"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="dialog-footer">
          <button className="btn btn-cancel" onClick={onClose}>
            Đóng
          </button>
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
