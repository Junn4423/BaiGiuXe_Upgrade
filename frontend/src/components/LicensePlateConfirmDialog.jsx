import React, { useState, useEffect } from "react";
import "../assets/styles/LicensePlateConfirmDialog.css"; 
import { getImageUrl } from "../api/api"; 

const LicensePlateConfirmDialog = ({
  isOpen,
  onClose,
  onConfirm,
  entryData = {},
  exitData = {},
  detectedPlate = "",
  originalPlate = "",
}) => {
  const [editedPlate, setEditedPlate] = useState(
    detectedPlate || originalPlate
  );

  useEffect(() => {
    setEditedPlate(detectedPlate || originalPlate);
  }, [detectedPlate, originalPlate]);

  if (!isOpen) return null;

  const handleConfirm = () => {
    onConfirm({
      confirmed: true,
      licensePlate: editedPlate,
      originalPlate: originalPlate,
      detectedPlate: detectedPlate,
    });
  };

  const handleCancel = () => {
    onConfirm({
      confirmed: false,
      licensePlate: editedPlate,
      originalPlate: originalPlate,
      detectedPlate: detectedPlate,
    });
  };

  return (
    <div className="license-plate-confirm-overlay">
      <div className="license-plate-confirm-dialog">
        <div className="dialog-header">
          <h2>Xác nhận biển số xe ra</h2>
          <button className="close-btn" onClick={handleCancel}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          <div className="plate-comparison">
            <div className="plate-info">
              <div className="plate-row">
                <span className="plate-label">Biển số xe vào:</span>
                <span className="plate-value original">
                  {originalPlate || "Không có"}
                </span>
              </div>
              <div className="plate-row">
                <span className="plate-label">Biển số nhận dạng:</span>
                <span className="plate-value detected">
                  {detectedPlate || "Không nhận dạng được"}
                </span>
              </div>
              <div className="plate-row">
                <span className="plate-label">Biển số chính xác:</span>
                <input
                  type="text"
                  value={editedPlate}
                  onChange={(e) => setEditedPlate(e.target.value.toUpperCase())}
                  className="plate-input"
                  placeholder="Nhập biển số chính xác"
                  autoFocus
                />
              </div>
            </div>

            {originalPlate !== detectedPlate &&
              originalPlate &&
              detectedPlate && (
                <div className="warning-message">
                  Biển số xe ra khác với biển số xe vào. Vui lòng kiểm tra
                  lại!
                </div>
              )}
          </div>

          <div className="images-comparison">
            <div className="image-section">
              <h3>Ảnh xe vào</h3>
              <div className="image-grid">
                <div className="image-item">
                  <span className="image-label">Khuôn mặt vào</span>
                  {entryData.faceImage ? (
                    <img
                      src={getImageUrl(entryData.faceImage)}
                      alt="Khuôn mặt xe vào"
                      className="comparison-image"
                    />
                  ) : (
                    <div className="no-image">Không có ảnh</div>
                  )}
                </div>
              </div>
            </div>

            <div className="image-section">
              <h3>Ảnh xe ra</h3>
              <div className="image-grid">
                <div className="image-item">
                  <span className="image-label">Khuôn mặt ra</span>
                  {exitData.faceImage ? (
                    <img
                      src={getImageUrl(exitData.faceImage)}
                      alt="Khuôn mặt xe ra"
                      className="comparison-image"
                    />
                  ) : (
                    <div className="no-image">Không có ảnh</div>
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="dialog-actions">
          <button className="btn-cancel" onClick={handleCancel}>
            Hủy
          </button>
          <button
            className="btn-confirm"
            onClick={handleConfirm}
            disabled={!editedPlate.trim()}
          >
            Xác nhận xe ra
          </button>
        </div>
      </div>
    </div>
  );
};

export default LicensePlateConfirmDialog;
