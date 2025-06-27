"use client"

import React, { useState } from "react"
import "../assets/styles/VehicleInfoComponent.css"

const VehicleInfoComponent = React.forwardRef(({ currentMode, currentVehicleType, onModeChange, workConfig }, ref) => {
  const [vehicleInfo, setVehicleInfo] = useState({
    ma_the: "",
    trang_thai: "",
  })

  const [cardReaderStatus, setCardReaderStatus] = useState({
    text: "SẴN SÀNG ĐỌC THẺ",
    color: "#10b981",
  })

  const [vehicleStatus, setVehicleStatus] = useState({
    text: "CHỜ XE VÀO/RA",
    color: "#6b7280",
  })

  const [parkingFee, setParkingFee] = useState("")

  // Update vehicle info
  const updateVehicleInfo = (newInfo) => {
    console.log(`📝 VehicleInfoComponent.updateVehicleInfo called with:`, newInfo)
    setVehicleInfo((prev) => ({
      ...prev,
      ma_the: newInfo.ma_the || prev.ma_the,
      trang_thai: newInfo.trang_thai || prev.trang_thai,
    }))

    if (newInfo.phi) {
      setParkingFee(newInfo.phi)
    }
    console.log(`📝 Vehicle info updated - mã thẻ: ${newInfo.ma_the}`)
  }

  // Update card reader status
  const updateCardReaderStatus = (text, color) => {
    setCardReaderStatus({ text: text.toUpperCase(), color })
  }

  // Update vehicle status
  const updateVehicleStatus = (text, color) => {
    setVehicleStatus({ text: text.toUpperCase(), color })
  }

  // Update parking fee
  const updateParkingFee = (fee) => {
    setParkingFee(fee)
  }

  // Clear vehicle info
  const clearVehicleInfo = () => {
    setVehicleInfo({
      ma_the: "",
      trang_thai: "",
    })
    setParkingFee("")
    setCardReaderStatus({ text: "SẴN SÀNG ĐỌC THẺ", color: "#10b981" })
    setVehicleStatus({ text: "CHỜ XE VÀO/RA", color: "#6b7280" })
  }

  // Legacy methods for compatibility
  const displayEntryVehicleImageInConfirmation = () => {}
  const displayPlaceholderEntryImage = () => {}
  const restoreOriginalConfirmationFrame = () => {}
  const showButtonsForVehicleType = () => {}

  // Handle mode toggle
  const handleModeToggle = () => {
    const newMode = currentMode === "vao" ? "ra" : "vao"
    if (onModeChange) {
      onModeChange(newMode, currentVehicleType)
    }
    clearVehicleInfo()
  }

  // Get status color class
  const getStatusColorClass = (color) => {
    const colorMap = {
      "#10b981": "success",
      "#ef4444": "error",
      "#dc2626": "error",
      "#f59e0b": "warning",
      "#3b82f6": "info",
      "#0369a1": "info",
      "#6b7280": "neutral",
    }
    return colorMap[color] || "neutral"
  }

  // Get vehicle type display name
  const getVehicleTypeDisplay = () => {
    if (!workConfig?.vehicle_type) return "CHƯA CẤU HÌNH"
    return workConfig.vehicle_type === "xe_may" ? "XE MÁY" : "Ô TÔ"
  }

  // Get zone display name
  const getZoneDisplay = () => {
    if (!workConfig?.zone) return "CHƯA CẤU HÌNH"
    return workConfig.zone.toUpperCase()
  }

  // Expose methods to parent component
  React.useImperativeHandle(ref, () => ({
    updateVehicleInfo,
    updateCardReaderStatus,
    updateVehicleStatus,
    updateParkingFee,
    clearVehicleInfo,
    displayEntryVehicleImageInConfirmation,
    displayPlaceholderEntryImage,
    restoreOriginalConfirmationFrame,
    showButtonsForVehicleType,
  }))

  return (
    <div className="vehicle-info-container">
      {/* Work Configuration Display */}
      <div className="config-section">
        <div className="config-header">CẤU HÌNH LÀM VIỆC</div>
        <div className="config-grid">
          <div className="config-item">
            <span className="config-label">KHU VỰC:</span>
            <span className="config-value zone">{getZoneDisplay()}</span>
          </div>
          {/* <div className="config-item">
            <span className="config-label">LOẠI XE:</span>
            <span className="config-value vehicle">{getVehicleTypeDisplay()}</span>
          </div> */}
        </div>
      </div>

      {/* Mode Control */}
      <div className="mode-section">
        <div className="mode-header">CHỂ ĐỘ HOẠT ĐỘNG</div>
        <div className="mode-control">
          <div className="mode-display">
            <span className={`mode-value ${currentMode}`}>{currentMode === "vao" ? "XE VÀO" : "XE RA"}</span>
          </div>
          <button
            className={`mode-toggle-btn ${currentMode}`}
            onClick={(e) => e.preventDefault()}
            tabIndex={-1}
            style={{ pointerEvents: "none" }}
          >
            CHUYỂN {currentMode === "vao" ? "RA" : "VÀO"}
          </button>
        </div>
      </div>

      {/* Status Display */}
      <div className="status-section">
        <div className="status-header">TRẠNG THÁI HỆ THỐNG</div>
        <div className="status-grid">
          <div className="status-item">
            <span className="status-label">ĐẦU ĐỌC THẺ:</span>
            <span className={`status-value ${getStatusColorClass(cardReaderStatus.color)}`}>
              {cardReaderStatus.text}
            </span>
          </div>
          <div className="status-item">
            <span className="status-label">TRẠNG THÁI XE:</span>
            <span className={`status-value ${getStatusColorClass(vehicleStatus.color)}`}>{vehicleStatus.text}</span>
          </div>
        </div>
      </div>

      {/* Vehicle Information - Simplified */}
      <div className="vehicle-section">
        <div className="vehicle-header">THÔNG TIN XE</div>
        <div className="vehicle-grid">
          <div className="vehicle-item">
            <span className="vehicle-label">MÃ THẺ:</span>
            <span className="vehicle-value card-id">{vehicleInfo.ma_the || "---"}</span>
          </div>
          <div className="vehicle-item">
            <span className="vehicle-label">TRẠNG THÁI:</span>
            <span
              className={`vehicle-value status ${vehicleInfo.trang_thai === "Đã ra" ? "completed" : vehicleInfo.trang_thai === "Trong bãi" ? "active" : ""}`}
            >
              {vehicleInfo.trang_thai || "---"}
            </span>
          </div>
        </div>
      </div>

      {/* Parking Fee Display */}
      <div className="fee-section">
        <div className="fee-header">PHÍ GỬI XE</div>
        <div className="fee-display">
          <span className="fee-amount">{parkingFee ? parkingFee : "0 VNĐ"}</span>
        </div>
      </div>
    </div>
  )
})

export default VehicleInfoComponent
