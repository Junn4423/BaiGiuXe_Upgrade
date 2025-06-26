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
  const [showSettingsDropdown, setShowSettingsDropdown] = useState(false)

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

  // Close dropdown when clicking outside
  useEffect(() => {
    const handleClickOutside = (event) => {
      if (!event.target.closest(".settings-dropdown")) {
        setShowSettingsDropdown(false)
      }
    }

    document.addEventListener("click", handleClickOutside)
    return () => document.removeEventListener("click", handleClickOutside)
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

  const handleSettingsClick = (action) => {
    setShowSettingsDropdown(false)
    action()
  }

  return (
    <div className="header-container">
      <div className="header-content">
        <div className="header-title">HỆ THỐNG QUẢN LÝ BÃI XE</div>

        <div className="header-actions">
          {/* Zone Selector */}
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

          {/* Settings Dropdown */}
          <div className="settings-dropdown">
            <button
              className={`settings-button ${showSettingsDropdown ? "open" : ""}`}
              onClick={() => setShowSettingsDropdown(!showSettingsDropdown)}
            >
              <svg className="item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                />
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>
              Cài đặt
              <svg
                className="dropdown-icon"
                width="16"
                height="16"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <div className={`settings-dropdown-menu ${showSettingsDropdown ? "open" : ""}`}>
              <button className="settings-dropdown-item" onClick={() => handleSettingsClick(onOpenCameraConfig)}>
                <svg className="item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"
                  />
                </svg>
                Cấu hình Camera
              </button>

              <button className="settings-dropdown-item" onClick={() => handleSettingsClick(onOpenPricingPolicy)}>
                <svg className="item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"
                  />
                </svg>
                Chính sách giá
              </button>

              <button className="settings-dropdown-item" onClick={() => handleSettingsClick(onOpenParkingZone)}>
                <svg className="item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                  />
                </svg>
                Quản lý khu vực
              </button>

              <button className="settings-dropdown-item" onClick={() => handleSettingsClick(onTestCardScan)}>
                <svg className="item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"
                  />
                </svg>
                Test Quét Thẻ
              </button>
            </div>
          </div>

          {/* Logout Button */}
          <button className="logout-button" onClick={handleLogout}>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth={2}
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
              />
            </svg>
            Đăng xuất
          </button>
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
