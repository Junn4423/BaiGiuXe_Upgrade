"use client";

import { useState } from "react";
import "../../assets/styles/ThemTheDialog.css";
import { themTheMobile } from "../../api/api";

const ThemTheDialog = ({ onClose, onSave, cardId = "" }) => {
  const [formData, setFormData] = useState({
    uid: cardId,
    loaiThe: "KHACH", 
    trangThai: "1",
  });
  const [isLoading, setIsLoading] = useState(false);

  console.log("=== ThemTheDialog Rendered ===");
  console.log("Card ID:", cardId);
  console.log("Form Data:", formData);

  // Map card types với value và label đúng
  const cardTypes = [
    { value: "KHACH", label: "Thẻ thường" },
    { value: "VIP", label: "Thẻ VIP" },
    { value: "THANG", label: "Thẻ tháng" },
    { value: "NHANVIEN", label: "Thẻ nhân viên" },
    { value: "KHACH", label: "Thẻ khách" }, // Cũng là KHACH
  ];

  const handleInputChange = (field, value) => {
    console.log("Input changed:", field, "=", value);
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }));
  };

  const handleSave = async () => {
    console.log("=== Saving Card ===");
    console.log("Form data to save:", formData);

    try {
      if (!formData.uid.trim()) {
        console.log("Empty UID, showing alert");
        alert("Vui lòng nhập UID thẻ");
        return;
      }

      setIsLoading(true);
      console.log("Loading state set to true");

      console.log("Calling themTheMobile API...");

      // Áp dụng logic nghiệp vụ như RfidManagerDialogClean
      const isGuestCard = formData.loaiThe === "KHACH";

      const result = await themTheMobile(
        formData.uid.trim(),
        formData.loaiThe,
        formData.trangThai,
        isGuestCard ? null : "", // Thẻ KHACH không cần biển số
        isGuestCard ? null : "", // Thẻ KHACH không cần chính sách
        isGuestCard ? null : "" // Thẻ KHACH không cần ngày kết thúc CS
      );

      console.log("API result:", result);

      if (result && result.success) {
        console.log("Card saved successfully");
        alert("Thêm thẻ thành công!");
        if (onSave) {
          console.log("Calling onSave callback");
          onSave(formData);
        }
      } else {
        console.log("Failed to save card:", result?.message);
        alert("Lỗi thêm thẻ: " + (result?.message || "Unknown error"));
      }
    } catch (error) {
      console.error("Error adding card:", error);
      alert("Lỗi thêm thẻ: " + error.message);
    } finally {
      setIsLoading(false);
      console.log("Loading state set to false");
    }
  };

  const handleCancel = () => {
    console.log("=== Cancel Button Clicked ===");
    onClose();
  };

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
            <div className="card-icon">Thẻ</div>
            <div className="card-info">
              <div className="card-uid">{formData.uid || "Chưa có UID"}</div>
              <div className="card-type">
                {cardTypes.find((t) => t.value === formData.loaiThe)?.label ||
                  formData.loaiThe}
              </div>
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
              {cardId && (
                <small className="help-text">
                  UID được tự động điền từ thẻ đã quét
                </small>
              )}
            </div>

            <div className="form-group">
              <label htmlFor="loaiThe">Loại Thẻ:</label>
              <select
                id="loaiThe"
                value={formData.loaiThe}
                onChange={(e) => handleInputChange("loaiThe", e.target.value)}
              >
                {cardTypes.map((type, index) => (
                  <option key={index} value={type.value}>
                    {type.label}
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
              <span className="info-value">
                {new Date().toLocaleString("vi-VN")}
              </span>
            </div>
            <div className="info-item">
              <span className="info-label">Người tạo:</span>
              <span className="info-value">Admin</span>
            </div>
          </div>
        </div>

        <div className="dialog-footer">
          <button
            className="btn btn-primary"
            onClick={handleSave}
            disabled={isLoading}
          >
            {isLoading ? "Đang xử lý..." : "Thêm Thẻ"}
          </button>
          <button className="btn btn-cancel" onClick={handleCancel}>
            Hủy
          </button>
        </div>
      </div>
    </div>
  );
};

export default ThemTheDialog;
