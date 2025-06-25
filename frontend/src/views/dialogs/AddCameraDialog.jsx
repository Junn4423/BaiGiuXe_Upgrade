"use client"

import { useState } from "react"
import "../../assets/styles/AddCameraDialog.css"
import { themCamera, capNhatCamera } from "../../api/api"

const AddCameraDialog = ({ maKhuVuc, cameraData = null, onClose, onSave }) => {
  const [form, setForm] = useState({
    maCamera: cameraData?.maCamera || "",
    tenCamera: cameraData?.tenCamera || "",
    loaiCamera: cameraData?.loaiCamera || "",
    chucNangCamera: cameraData?.chucNangCamera || "",
    linkRTSP: cameraData?.linkRTSP || "",
    maKhuVuc: maKhuVuc || "",
  })
  const [loading, setLoading] = useState(false)

  const isEditing = !!cameraData

  const handleInputChange = (field, value) => {
    setForm((prev) => ({ ...prev, [field]: value }))
  }

  const validateInput = () => {
    if (!form.maCamera && !isEditing) {
      alert("Vui lòng nhập mã camera")
      return false
    }
    if (!form.tenCamera) {
      alert("Vui lòng nhập tên camera")
      return false
    }
    if (!form.loaiCamera) {
      alert("Vui lòng chọn loại camera")
      return false
    }
    if (!form.chucNangCamera) {
      alert("Vui lòng chọn chức năng camera")
      return false
    }
    return true
  }

  const handleSubmit = async () => {
    if (!validateInput()) return

    try {
      setLoading(true)
      let result

      if (isEditing) {
        result = await capNhatCamera(form)
      } else {
        result = await themCamera(form)
      }

      if (result.success) {
        alert(isEditing ? "Cập nhật camera thành công" : "Thêm camera thành công")
        if (onSave) onSave()
        onClose()
      } else {
        alert("Lỗi: " + (result.message || "Không thể lưu camera"))
      }
    } catch (error) {
      console.error("Error saving camera:", error)
      alert("Lỗi: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  return (
    <div className="dialog-overlay">
      <div className="add-camera-dialog">
        <div className="dialog-header">
          <h3>{isEditing ? "Sửa Camera" : "Thêm Camera"}</h3>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          <div className="form-group">
            <label>Mã camera:</label>
            <input
              type="text"
              value={form.maCamera}
              onChange={(e) => handleInputChange("maCamera", e.target.value)}
              disabled={isEditing}
              placeholder="Nhập mã camera"
            />
          </div>

          <div className="form-group">
            <label>Tên camera:</label>
            <input
              type="text"
              value={form.tenCamera}
              onChange={(e) => handleInputChange("tenCamera", e.target.value)}
              placeholder="Nhập tên camera"
            />
          </div>

          <div className="form-group">
            <label>Loại camera:</label>
            <select value={form.loaiCamera} onChange={(e) => handleInputChange("loaiCamera", e.target.value)}>
              <option value="">Chọn loại camera</option>
              <option value="VAO">Vào</option>
              <option value="RA">Ra</option>
            </select>
          </div>

          <div className="form-group">
            <label>Chức năng:</label>
            <select value={form.chucNangCamera} onChange={(e) => handleInputChange("chucNangCamera", e.target.value)}>
              <option value="">Chọn chức năng</option>
              <option value="BIENSO">Biển số</option>
              <option value="KHUONMAT">Khuôn mặt</option>
            </select>
          </div>

          <div className="form-group">
            <label>Link RTSP:</label>
            <input
              type="text"
              value={form.linkRTSP}
              onChange={(e) => handleInputChange("linkRTSP", e.target.value)}
              placeholder="rtsp://..."
            />
          </div>

          <div className="form-group">
            <label>Mã khu vực:</label>
            <input type="text" value={form.maKhuVuc} disabled className="disabled-input" />
          </div>
        </div>

        <div className="dialog-footer">
          <button className="save-button" onClick={handleSubmit} disabled={loading}>
            {loading ? "Đang lưu..." : isEditing ? "Cập nhật" : "Thêm mới"}
          </button>
          <button className="cancel-button" onClick={onClose}>
            Hủy
          </button>
        </div>
      </div>
    </div>
  )
}

export default AddCameraDialog
