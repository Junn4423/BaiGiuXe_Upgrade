"use client"

import { useState, useEffect } from "react"
import "../assets/styles/Header.css"
import { layDanhSachKhu } from "../api/api"

const Header = ({
  onModeChange,
  onZoneChange,
  onOpenCameraConfig,
  onOpenPricingPolicy,
  onOpenParkingZone,
  onTestCardScan,
}) => {
  const [currentTime, setCurrentTime] = useState(new Date())
  const [currentMode, setCurrentMode] = useState("vao")
  const [currentVehicleType, setCurrentVehicleType] = useState("xe_may")
  const [zones, setZones] = useState([])
  const [selectedZone, setSelectedZone] = useState(null)
  const [showMenu, setShowMenu] = useState(false)

  // Update time every second
  useEffect(() => {
    const timer = setInterval(() => {
      setCurrentTime(new Date())
    }, 1000)
    return () => clearInterval(timer)
  }, [])

  // Load zones on mount
  useEffect(() => {
    loadZones()
  }, [])

  const loadZones = async () => {
    try {
      const zoneList = await layDanhSachKhu()
      setZones(zoneList || [])
      if (zoneList && zoneList.length > 0) {
        setSelectedZone(zoneList[0])
        if (onZoneChange) {
          onZoneChange(zoneList[0])
        }
      }
    } catch (error) {
      console.error("Error loading zones:", error)
    }
  }

  const getModeText = () => {
    if (currentMode === "vao") {
      return currentVehicleType === "xe_may" ? "Chế độ: XE MÁY VÀO" : "Chế độ: XE HƠI VÀO"
    } else {
      return currentVehicleType === "xe_may" ? "Chế độ: XE MÁY RA" : "Chế độ: XE HƠI RA"
    }
  }

  const switchMode = () => {
    let newMode = currentMode
    let newVehicleType = currentVehicleType

    if (currentMode === "vao" && currentVehicleType === "xe_may") {
      newMode = "ra"
      newVehicleType = "xe_may"
    } else if (currentMode === "ra" && currentVehicleType === "xe_may") {
      newMode = "vao"
      newVehicleType = "oto"
    } else if (currentMode === "vao" && currentVehicleType === "oto") {
      newMode = "ra"
      newVehicleType = "oto"
    } else {
      newMode = "vao"
      newVehicleType = "xe_may"
    }

    setCurrentMode(newMode)
    setCurrentVehicleType(newVehicleType)

    if (onModeChange) {
      onModeChange(newMode, newVehicleType)
    }
  }

  const handleZoneChange = (event) => {
    const zoneIndex = Number.parseInt(event.target.value)
    const zone = zones[zoneIndex]
    setSelectedZone(zone)
    if (onZoneChange) {
      onZoneChange(zone)
    }
  }

  const formatTime = (date) => {
    return date.toLocaleString("vi-VN", {
      day: "2-digit",
      month: "2-digit",
      year: "numeric",
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
    })
  }

  const handleLogout = () => {
    if (window.confirm("Bạn có chắc muốn đăng xuất?")) {
      window.location.reload()
    }
  }

  return (
    <div className="header-container">
      <div className="header-content">
        <div className="header-title">HỆ THỐNG QUẢN LÝ BÃI XE</div>

        {/* Menu */}
        <div className="menu-container">
          <button className="menu-button" onClick={() => setShowMenu(!showMenu)}>
            ☰ Menu
          </button>
          {showMenu && (
            <div className="menu-dropdown">
              <button className="menu-item" onClick={onOpenCameraConfig}>
                Cấu hình Camera
              </button>
              <button className="menu-item" onClick={onOpenPricingPolicy}>
                Chính sách giá
              </button>
              <button className="menu-item" onClick={onOpenParkingZone}>
                Quản lý khu vực
              </button>
              <button className="menu-item" onClick={onTestCardScan}>
                Test Quét Thẻ
              </button>
              <div className="menu-separator"></div>
              <button className="menu-item" onClick={handleLogout}>
                Đăng xuất
              </button>
            </div>
          )}
        </div>

        <div className="zone-selector">
          <span className="zone-label">Khu vực:</span>
          <select className="zone-select" value={zones.indexOf(selectedZone)} onChange={handleZoneChange}>
            {zones.map((zone, index) => (
              <option key={index} value={index}>
                {zone.tenKhuVuc || zone.maKhuVuc}
              </option>
            ))}
          </select>
        </div>
      </div>

      <div className="status-bar">
        <div className="current-time">Thời gian hiện tại: {formatTime(currentTime)}</div>
        <div style={{ display: "flex", alignItems: "center" }}>
          <span className="current-mode">{getModeText()}</span>
          <button className="mode-switch-button" onClick={switchMode}>
            Chuyển chế độ
          </button>
        </div>
      </div>
    </div>
  )
}

export default Header
