"use client"

import { useState } from "react"
import "../../assets/styles/BienSoLoiDialog.css"
import "../../assets/styles/global-dialog-theme.css"

const BienSoLoiDialog = ({
  onClose,
  onConfirm,
  cardId = "",
  oldLicensePlate = "",
  newLicensePlate = "",
  entryImage = "",
  exitImage = "",
  entryFaceImage = "",
  exitFaceImage = "",
}) => {
  const [correctedLicensePlate, setCorrectedLicensePlate] = useState(newLicensePlate)

  const handleConfirm = () => {
    if (onConfirm) {
      onConfirm({
        action: "confirm",
        correctedLicensePlate: correctedLicensePlate.trim(),
      })
    }
  }

  const handleRescan = () => {
    if (onConfirm) {
      onConfirm({
        action: "rescan",
      })
    }
  }

  const handleCancel = () => {
    if (onConfirm) {
      onConfirm({
        action: "cancel",
      })
    }
  }

  return (
    <div className="dialog-overlay">
      <div className="biensoi-dialog">
        <div className="dialog-header">
          <h3>Biển Số Không Khớp</h3>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          <div className="info-section">
            <div className="info-row">
              <label>Mã thẻ:</label>
              <span className="card-id">{cardId}</span>
            </div>
            <div className="info-row">
              <label>Biển số vào:</label>
              <span className="old-plate">{oldLicensePlate}</span>
            </div>
            <div className="info-row">
              <label>Biển số ra:</label>
              <span className="new-plate">{newLicensePlate}</span>
            </div>
          </div>

          <div className="images-section">
            <div className="image-group">
              <div className="image-container">
                <div className="image-title">Ảnh xe vào</div>
                <img
                  src={entryImage || "/placeholder.svg?height=200&width=300"}
                  alt="Xe vào"
                  className="vehicle-image"
                />
              </div>
              <div className="image-container">
                <div className="image-title">Ảnh xe ra</div>
                <img src={exitImage || "/placeholder.svg?height=200&width=300"} alt="Xe ra" className="vehicle-image" />
              </div>
            </div>

            {(entryFaceImage || exitFaceImage) && (
              <div className="image-group">
                <div className="image-container">
                  <div className="image-title">Ảnh mặt vào</div>
                  <img
                    src={entryFaceImage || "/placeholder.svg?height=150&width=150"}
                    alt="Mặt vào"
                    className="face-image"
                  />
                </div>
                <div className="image-container">
                  <div className="image-title">Ảnh mặt ra</div>
                  <img
                    src={exitFaceImage || "/placeholder.svg?height=150&width=150"}
                    alt="Mặt ra"
                    className="face-image"
                  />
                </div>
              </div>
            )}
          </div>

          <div className="correction-section">
            <label htmlFor="corrected-plate">Biển số chính xác:</label>
            <input
              id="corrected-plate"
              type="text"
              value={correctedLicensePlate}
              onChange={(e) => setCorrectedLicensePlate(e.target.value.toUpperCase())}
              placeholder="Nhập biển số chính xác"
              className="plate-input"
            />
          </div>
        </div>

        <div className="dialog-footer">
          <button className="btn btn-primary" onClick={handleConfirm}>
            Xác nhận
          </button>
          <button className="btn btn-secondary" onClick={handleRescan}>
            Quét lại
          </button>
          <button className="btn btn-cancel" onClick={handleCancel}>
            Hủy
          </button>
        </div>
      </div>
    </div>
  )
}

export default BienSoLoiDialog
