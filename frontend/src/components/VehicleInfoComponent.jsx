"use client"

import React, { useState } from "react"
import "../assets/styles/VehicleInfoComponent.css"
import { tinhPhiGuiXe } from "../api/api"

const VehicleInfoComponent = React.forwardRef(({ currentMode, currentVehicleType, onModeChange, workConfig }, ref) => {
  const [vehicleInfo, setVehicleInfo] = useState({
    ma_the: "",
    trang_thai: "",
    ma_phien: "", // Thêm mã phiên để tính phí
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
  const [isCalculatingFee, setIsCalculatingFee] = useState(false)

  // Calculate parking fee using tinhPhiGuiXe API
  const calculateParkingFee = async (maPhien) => {
    if (!maPhien) {
      console.log("Không có mã phiên để tính phí")
      return
    }

    try {
      setIsCalculatingFee(true)
      console.log(`Đang tính phí cho mã phiên: ${maPhien}`)
      
      // Pass card ID if available for free card checking
      const result = await tinhPhiGuiXe(maPhien, vehicleInfo.ma_the)
      console.log(`Kết quả tính phí:`, result)
      
      if (result && result.success) {
        const phi = result.phi || 0
        const tongPhut = result.tongPhut || 0
        
        // Format fee display
        const feeFormatted = phi > 0 ? `${phi.toLocaleString()} VNĐ` : "0 VNĐ"
        const durationText = tongPhut > 0 ? ` (${Math.floor(tongPhut / 60)}h ${tongPhut % 60}m)` : ""
        
        setParkingFee(feeFormatted + durationText)
        console.log(`Đã cập nhật phí: ${feeFormatted}`)
        
        return { success: true, phi, tongPhut }
      } else {
        const errorMsg = result?.message || "Lỗi tính phí"
        setParkingFee(`Lỗi: ${errorMsg}`)
        console.log(`Lỗi tính phí: ${errorMsg}`)
        return { success: false, message: errorMsg }
      }
    } catch (error) {
      console.error("Lỗi khi tính phí gửi xe:", error)
      setParkingFee("Lỗi tính phí")
      return { success: false, message: error.message }
    } finally {
      setIsCalculatingFee(false)
    }
  }

  // Update vehicle info
  const updateVehicleInfo = (newInfo) => {
    console.log(`VehicleInfoComponent.updateVehicleInfo called with:`, newInfo)
    console.log(`Current parking fee before vehicle info update:`, parkingFee)
    setVehicleInfo((prev) => ({
      ...prev,
      ma_the: newInfo.ma_the || prev.ma_the,
      trang_thai: newInfo.trang_thai || prev.trang_thai,
      ma_phien: newInfo.ma_phien || newInfo.sessionId || prev.ma_phien,
    }))

    // Don't auto-calculate fee here - let the main flow handle it
    // This prevents duplicate fee calculations that can overwrite correct results
    if ((newInfo.ma_phien || newInfo.sessionId) && currentMode === "ra") {
      const sessionId = newInfo.ma_phien || newInfo.sessionId
      console.log(`Session ID received for exit mode: ${sessionId} (fee calculation handled by main flow)`)
    }

    // Update fee display if fee is provided in the vehicle info
    if (newInfo.phi || newInfo.phi_gui_xe) {
      const fee = newInfo.phi || newInfo.phi_gui_xe;
      console.log(`Setting parking fee from vehicle info: ${fee}`);
      
      // Handle different fee formats (number, formatted string, etc.)
      let formattedFee = "";
      if (typeof fee === 'number') {
        formattedFee = fee > 0 ? `${fee.toLocaleString()} VNĐ` : "0 VNĐ";
      } else if (typeof fee === 'string') {
        // If already formatted (contains VND, VNĐ), use as is
        if (fee.includes('VND') || fee.includes('VNĐ')) {
          formattedFee = fee.replace('VND', 'VNĐ'); // Normalize to VNĐ
        } else {
          // Try to parse as number and format
          const numericFee = parseInt(fee.replace(/[^\d]/g, ''));
          formattedFee = numericFee > 0 ? `${numericFee.toLocaleString()} VNĐ` : "0 VNĐ";
        }
      } else {
        formattedFee = "0 VNĐ";
      }
      
      setParkingFee(formattedFee);
      console.log(`Parking fee updated to: ${formattedFee}`);
    }
    console.log(`Vehicle info updated - mã thẻ: ${newInfo.ma_the}`)
    console.log(`Parking fee after vehicle info update:`, parkingFee)
  }

  // Update vehicle info with session data for fee calculation
  const updateVehicleInfoWithSession = (vehicleData, sessionData = null) => {
    console.log(`VehicleInfoComponent.updateVehicleInfoWithSession called:`, { vehicleData, sessionData })
    
    const newInfo = {
      ma_the: vehicleData.ma_the || vehicleData.cardId,
      trang_thai: vehicleData.trang_thai || vehicleData.status,
      ma_phien: sessionData?.maPhien || sessionData?.sessionId || vehicleData.ma_phien || vehicleData.sessionId,
    }
    
    updateVehicleInfo(newInfo)
  }

  // Manual fee calculation trigger
  const triggerFeeCalculation = async () => {
    if (!vehicleInfo.ma_phien) {
      console.log("Không có mã phiên để tính phí")
      updateCardReaderStatus("THIẾU MÃ PHIÊN", "#ef4444")
      setTimeout(() => {
        updateCardReaderStatus("SẴN SÀNG ĐỌC THẺ", "#10b981")
      }, 2000)
      return
    }

    updateCardReaderStatus("ĐANG TÍNH PHÍ...", "#f59e0b")
    const result = await calculateParkingFee(vehicleInfo.ma_phien)
    
    if (result.success) {
      updateCardReaderStatus("TÍNH PHÍ THÀNH CÔNG", "#10b981")
    } else {
      updateCardReaderStatus("LỖI TÍNH PHÍ", "#ef4444")
    }
    
    setTimeout(() => {
      updateCardReaderStatus("SẴN SÀNG ĐỌC THẺ", "#10b981")
    }, 2000)
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
    console.log(`VehicleInfoComponent.updateParkingFee called with:`, fee)
    console.log(`Current parking fee before update:`, parkingFee)
    
    // Ensure fee is properly formatted
    let formattedFee = "";
    if (typeof fee === 'number') {
      formattedFee = fee > 0 ? `${fee.toLocaleString()} VNĐ` : "0 VNĐ";
    } else if (typeof fee === 'string') {
      // If already contains VND or VNĐ, normalize it
      if (fee.includes('VND') || fee.includes('VNĐ')) {
        formattedFee = fee.replace('VND', 'VNĐ'); // Normalize to VNĐ
      } else {
        // Try to parse as number and format
        const numericFee = parseInt(fee.replace(/[^\d]/g, ''));
        formattedFee = numericFee > 0 ? `${numericFee.toLocaleString()} VNĐ` : "0 VNĐ";
      }
    } else {
      formattedFee = fee || "0 VNĐ";
    }
    
    setParkingFee(formattedFee)
    console.log(`Parking fee updated to:`, formattedFee)
  }

  // Clear vehicle info
  const clearVehicleInfo = () => {
    setVehicleInfo({
      ma_the: "",
      trang_thai: "",
      ma_phien: "",
    })
    setParkingFee("")
    setIsCalculatingFee(false)
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
    updateVehicleInfoWithSession,
    updateCardReaderStatus,
    updateVehicleStatus,
    updateParkingFee,
    clearVehicleInfo,
    displayEntryVehicleImageInConfirmation,
    displayPlaceholderEntryImage,
    restoreOriginalConfirmationFrame,
    showButtonsForVehicleType,
    calculateParkingFee,
    triggerFeeCalculation,
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
          {vehicleInfo.ma_phien && (
            <div className="vehicle-item">
              <span className="vehicle-label">MÃ PHIÊN:</span>
              <span className="vehicle-value session-id">{vehicleInfo.ma_phien}</span>
            </div>
          )}
        </div>
      </div>

      {/* Parking Fee Display */}
      <div className="fee-section">
        <div className="fee-header">
          PHÍ GỬI XE
          {currentMode === "ra" && vehicleInfo.ma_phien && (
            <button
              className="fee-calculate-btn"
              onClick={triggerFeeCalculation}
              disabled={isCalculatingFee}
              title="Tính lại phí gửi xe"
            >
              {isCalculatingFee ? "⏳" : ""}
            </button>
          )}
        </div>
        <div className="fee-display">
          <span className={`fee-amount ${parkingFee && parkingFee.includes('dự kiến') ? 'estimated' : 'final'} ${isCalculatingFee ? 'calculating' : ''}`}>
            {isCalculatingFee ? "Đang tính..." : parkingFee || "0 VNĐ"}
          </span>
        </div>
      </div>
    </div>
  )
})

export default VehicleInfoComponent
