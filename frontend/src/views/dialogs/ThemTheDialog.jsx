"use client"

import { useState } from "react"
import "../../assets/styles/ThemTheDialog.css"
import { themThe } from "../../api/api"

const ThemTheDialog = ({ onClose, onSave, cardId = "" }) => {
  const [formData, setFormData] = useState({
    uid: cardId,
    loaiThe: "Thẻ thường",
    trangThai: "1",
  })
  const [isLoading, setIsLoading] = useState(false)

  const cardTypes = ["Thẻ thường", "Thẻ VIP", "Thẻ tháng", "Thẻ nhân viên", "Thẻ khách"]

  const handleInputChange = (field, value) => {
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }))
  }

  const handleSave = async () => {
    try {
      if (!formData.uid.trim()) {
        alert("Vui lòng nhập UID thẻ")
        return
      }

      setIsLoading(true)

      const result = await themThe(formData.uid, formData.loaiThe, formData.trangThai)

      if (result && result.success) {
        alert("Thêm thẻ thành công!")
        if (onSave) {
          onSave(formData)
        }
      } else {
        alert("Lỗi thêm thẻ: " + (result?.message || "Unknown error"))
      }
    } catch (error) {
      console.error("Error adding card:", error)
      alert("Lỗi thêm thẻ: " + error.message)
    } finally {
      setIsLoading(false)
    }
  }

  const handleCancel = () => {
    onClose()
  }

  return (
    <div className="dialog-overlay">
      <div className="them-the-dialog">
        <div className="dialog-header">
          <h3>Thêm Thẻ Mới</h3>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          <div className="card-preview">
            <div className="card-icon">🏷️</div>
            <div className="card-info">
              <div className="card-uid">{formData.uid || "Chưa có UID"}</div>
              <div className="card-type">{formData.loaiThe}</div>
            </div>
          </div>

          <div className="form-section">
            <div className="form-group">
              <label htmlFor="uid">UID Thẻ:</label>
              <input
                id="uid"
                type="text"
                value={formData.uid}
                onChange={(e) => handleInputChange("uid", e.target.value)}
                placeholder="Nhập UID thẻ"
                disabled={!!cardId} // Disable if cardId is provided
                className={cardId ? "readonly" : ""}
              />
              {cardId && <small className="help-text">UID được tự động điền từ thẻ đã quét</small>}
            </div>

            <div className="form-group">
              <label htmlFor="loaiThe">Loại Thẻ:</label>
              <select
                id="loaiThe"
                value={formData.loaiThe}
                onChange={(e) => handleInputChange("loaiThe", e.target.value)}
              >
                {cardTypes.map((type, index) => (
                  <option key={index} value={type}>
                    {type}
                  </option>
                ))}
              </select>
            </div>

            <div className="form-group">
              <label htmlFor="trangThai">Trạng Thái:</label>
              <select
                id="trangThai"
                value={formData.trangThai}
                onChange={(e) => handleInputChange("trangThai", e.target.value)}
              >
                <option value="1">Hoạt động</option>
                <option value="0">Không hoạt động</option>
              </select>
            </div>
          </div>

          <div className="info-section">
            <div className="info-item">
              <span className="info-label">Thời gian tạo:</span>
              <span className="info-value">{new Date().toLocaleString("vi-VN")}</span>
            </div>
            <div className="info-item">
              <span className="info-label">Người tạo:</span>
              <span className="info-value">Admin</span>
            </div>
          </div>
        </div>

        <div className="dialog-footer">
          <button className="btn btn-primary" onClick={handleSave} disabled={isLoading}>
            {isLoading ? "Đang xử lý..." : "Thêm Thẻ"}
          </button>
          <button className="btn btn-cancel" onClick={handleCancel}>
            Hủy
          </button>
        </div>
      </div>
    </div>
  )
}

export default ThemTheDialog
