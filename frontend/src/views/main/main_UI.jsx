"use client"

import { useEffect, useRef, useState } from "react"
import "../../assets/styles/main_UI.css"
import CameraComponent from "../../components/CameraComponent"
import VehicleInfoComponent from "../../components/VehicleInfoComponent"
import VehicleListComponent from "../../components/VehicleListComponent"
import QuanLyCamera from "../../components/QuanLyCamera"
import QuanLyXe from "../../components/QuanLyXe"
import DauDocThe from "../../components/DauDocThe"
import BienSoLoiDialog from "../dialogs/BienSoLoiDialog"
import CameraConfigDialog from "../dialogs/CameraConfigDialog"
import ParkingZoneDialog from "../dialogs/ParkingZoneDialog"
import PricingPolicyDialog from "../dialogs/PricingPolicyDialog"
import ThemTheDialog from "../dialogs/ThemTheDialog"
import WorkConfigDialog from "../dialogs/WorkConfigDialog"

const MainUI = () => {
  // State management
  const [activeTab, setActiveTab] = useState("management")
  const [currentMode, setCurrentMode] = useState("vao")
  const [currentVehicleType, setCurrentVehicleType] = useState("xe_may")
  const [currentZone, setCurrentZone] = useState(null)
  const [workConfig, setWorkConfig] = useState(null)

  // Component refs
  const cameraManagerRef = useRef()
  const vehicleManagerRef = useRef()
  const cardReaderRef = useRef()
  const cameraComponentRef = useRef()
  const vehicleInfoComponentRef = useRef()
  const vehicleListComponentRef = useRef()

  // Dialog states
  const [showCameraConfig, setShowCameraConfig] = useState(false)
  const [showPricingPolicy, setShowPricingPolicy] = useState(false)
  const [showParkingZone, setShowParkingZone] = useState(false)
  const [showWorkConfig, setShowWorkConfig] = useState(false)
  const [showAddCard, setShowAddCard] = useState(false)
  const [showLicensePlateError, setShowLicensePlateError] = useState(false)

  // Initialize components and connections
  useEffect(() => {
    loadWorkConfig()
    setupConnections()
    startServices()
    bindShortcuts()

    return () => {
      cleanup()
    }
  }, [])

  // Load work configuration
  const loadWorkConfig = () => {
    try {
      const savedConfig = localStorage.getItem("work_config")
      if (savedConfig) {
        const config = JSON.parse(savedConfig)
        setWorkConfig(config)
        setCurrentVehicleType(config.loai_xe || "xe_may")
        console.log("Loaded work config:", config)
      } else {
        // Show work config dialog if no config exists
        setShowWorkConfig(true)
      }
    } catch (error) {
      console.error("Error loading work config:", error)
      setShowWorkConfig(true)
    }
  }

  // Setup connections between components
  const setupConnections = () => {
    const uiInterface = {
      currentMode,
      currentVehicleType,
      currentZone,
      workConfig,

      // Camera methods
      displayCapturedImage: (imagePath, panelNumber) => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.displayCapturedImage(imagePath, panelNumber)
        }
      },
      displayCapturedFaceImage: (imagePath) => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.displayCapturedFaceImage(imagePath)
        }
      },
      displayEntryImagesAfterExit: (entryImageUrl, entryFaceUrl) => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.displayEntryImagesAfterExit(entryImageUrl, entryFaceUrl)
        }
      },
      updateLicensePlateDisplay: (licensePlate, fee) => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.updateLicensePlateDisplay(licensePlate, fee)
        }
      },
      restoreCaptureFeeds: () => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.restoreCaptureFeeds()
        }
      },

      // Vehicle info methods
      updateVehicleInfo: (vehicleInfo) => {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateVehicleInfo(vehicleInfo)
        }
      },
      updateCardReaderStatus: (status, color) => {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateCardReaderStatus(status, color)
        }
      },
      updateVehicleStatus: (status, color) => {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateVehicleStatus(status, color)
        }
      },
      updateParkingFee: (fee) => {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateParkingFee(fee)
        }
      },
      clearVehicleInfo: () => {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.clearVehicleInfo()
        }
      },

      // Vehicle list methods
      updateVehicleList: (vehicles) => {
        if (vehicleListComponentRef.current) {
          vehicleListComponentRef.current.updateVehicleList(vehicles)
        }
      },
      updateStatistics: (stats) => {
        if (vehicleListComponentRef.current) {
          vehicleListComponentRef.current.updateStatistics(stats)
        }
      },

      // Dialog methods
      openAddCardDialog: (cardId) => setShowAddCard({ show: true, cardId }),
      openLicensePlateErrorDialog: (data) => setShowLicensePlateError({ show: true, ...data }),

      // Utility methods
      showNotification: (title, message) => {
        console.log(`Notification: ${title} - ${message}`)
      },
      showError: (title, message) => {
        console.error(`Error: ${title} - ${message}`)
      },
    }

    // Set UI references in components
    if (cameraManagerRef.current) {
      cameraManagerRef.current.setUIReference(uiInterface)
    }
    if (vehicleManagerRef.current) {
      vehicleManagerRef.current.setUIReference(uiInterface)
    }
    if (cardReaderRef.current) {
      cardReaderRef.current.setUIReference(uiInterface)
    }
  }

  // Start services
  const startServices = () => {
    if (cameraManagerRef.current) {
      cameraManagerRef.current.startCamera()
    }
    if (cardReaderRef.current) {
      cardReaderRef.current.startCardReader()
    }
  }

  // Bind keyboard shortcuts
  const bindShortcuts = () => {
    const handleKeyPress = (event) => {
      if (event.key === "F5") {
        event.preventDefault()
        reloadMainUI()
      }
      if (event.key === "F1") {
        event.preventDefault()
        setShowWorkConfig(true)
      }
    }

    document.addEventListener("keydown", handleKeyPress)
    return () => document.removeEventListener("keydown", handleKeyPress)
  }

  // Handle mode change
  const handleModeChange = (mode, vehicleType) => {
    setCurrentMode(mode)
    setCurrentVehicleType(vehicleType)

    // Clear vehicle info
    if (vehicleInfoComponentRef.current) {
      vehicleInfoComponentRef.current.clearVehicleInfo()
    }

    // Reset card reader scanning state
    if (cardReaderRef.current && cardReaderRef.current.resetScanningState) {
      cardReaderRef.current.resetScanningState()
    }

    // Switch camera mode
    if (cameraManagerRef.current) {
      cameraManagerRef.current.switchCamera(mode)
    }

    // Restore capture feeds
    if (cameraComponentRef.current) {
      cameraComponentRef.current.restoreCaptureFeeds()
    }
  }

  // Handle zone change
  const handleZoneChange = (zone) => {
    setCurrentZone(zone)
    if (cameraManagerRef.current && zone) {
      cameraManagerRef.current.loadCameraList(zone.maKhuVuc)
    }
  }

  // Toolbar handlers
  const openCameraConfig = () => setShowCameraConfig(true)
  const openPricingPolicy = () => setShowPricingPolicy(true)
  const openParkingZoneManagement = () => setShowParkingZone(true)
  const openWorkConfig = () => setShowWorkConfig(true)

  const reloadMainUI = () => {
    window.location.reload()
  }

  const logout = () => {
    if (window.confirm("Bạn có chắc muốn đăng xuất?")) {
      cleanup()
      window.location.reload()
    }
  }

  // Cleanup resources
  const cleanup = () => {
    try {
      if (cameraManagerRef.current) {
        cameraManagerRef.current.stopCamera()
      }
      if (cardReaderRef.current) {
        cardReaderRef.current.stopCardReader()
      }
    } catch (error) {
      console.error("Error during cleanup:", error)
    }
  }

  // Handle work config save
  const handleWorkConfigSave = (config) => {
    setWorkConfig(config)
    setCurrentVehicleType(config.loai_xe || "xe_may")
    setShowWorkConfig(false)
    console.log("Work config updated:", config)
  }

  return (
    <div className="main-ui-container">
      {/* Top Toolbar */}
      <div className="top-toolbar">
        <div className="toolbar-left">
          <div className="app-title">HỆ THỐNG QUẢN LÝ BÃI XE</div>
          {workConfig && (
            <div className="config-info">
              <span className="config-zone">{workConfig.zone}</span>
              <span className="config-separator">|</span>
              <span className="config-vehicle">{workConfig.vehicle_type?.toUpperCase()}</span>
            </div>
          )}
        </div>

        <div className="toolbar-right">
          <button className="toolbar-btn" onClick={openWorkConfig}>
            CẤU HÌNH
          </button>
          <button className="toolbar-btn" onClick={openCameraConfig}>
            CAMERA
          </button>
          <button className="toolbar-btn" onClick={openPricingPolicy}>
            GIÁ CẢ
          </button>
          <button className="toolbar-btn" onClick={openParkingZoneManagement}>
            KHU VỰC
          </button>
          <button className="toolbar-btn logout-btn" onClick={logout}>
            ĐĂNG XUẤT
          </button>
        </div>
      </div>

      {/* Tab Navigation */}
      <div className="tab-navigation">
        <button
          className={`tab-btn ${activeTab === "management" ? "active" : ""}`}
          onClick={() => setActiveTab("management")}
        >
          QUẢN LÝ XE RA VÀO
        </button>
        <button className={`tab-btn ${activeTab === "list" ? "active" : ""}`} onClick={() => setActiveTab("list")}>
          DANH SÁCH XE TRONG BÃI
        </button>
      </div>

      {/* Main Content */}
      <div className="main-content">
        {activeTab === "management" && (
          <div className="management-layout">
            <div className="camera-section">
              <CameraComponent ref={cameraComponentRef} currentMode={currentMode} zoneInfo={currentZone} />
            </div>
            <div className="vehicle-info-section">
              <VehicleInfoComponent
                ref={vehicleInfoComponentRef}
                currentMode={currentMode}
                currentVehicleType={currentVehicleType}
                onModeChange={handleModeChange}
                workConfig={workConfig}
              />
            </div>
          </div>
        )}

        {activeTab === "list" && (
          <div className="list-layout">
            <VehicleListComponent
              ref={vehicleListComponentRef}
              onVehicleSelect={(vehicle) => {
                console.log("Selected vehicle:", vehicle)
              }}
            />
          </div>
        )}
      </div>

      {/* Hidden Logic Components */}
      <div style={{ display: "none" }}>
        <QuanLyCamera ref={cameraManagerRef} />
        <QuanLyXe ref={vehicleManagerRef} />
        <DauDocThe ref={cardReaderRef} />
      </div>

      {/* Dialogs */}
      {showWorkConfig && (
        <WorkConfigDialog onClose={() => setShowWorkConfig(false)} onConfigSaved={handleWorkConfigSave} />
      )}

      {showCameraConfig && (
        <CameraConfigDialog
          onClose={() => setShowCameraConfig(false)}
          onSave={(config) => {
            console.log("Camera config saved:", config)
            setShowCameraConfig(false)
          }}
        />
      )}

      {showPricingPolicy && <PricingPolicyDialog onClose={() => setShowPricingPolicy(false)} />}

      {showParkingZone && <ParkingZoneDialog onClose={() => setShowParkingZone(false)} />}

      {showAddCard && showAddCard.show && (
        <ThemTheDialog
          cardId={showAddCard.cardId}
          onClose={() => setShowAddCard(false)}
          onSave={(cardData) => {
            console.log("Card added:", cardData)
            setShowAddCard(false)
          }}
        />
      )}

      {showLicensePlateError && showLicensePlateError.show && (
        <BienSoLoiDialog
          {...showLicensePlateError}
          onClose={() => setShowLicensePlateError(false)}
          onConfirm={(result) => {
            console.log("License plate error result:", result)
            setShowLicensePlateError(false)
          }}
        />
      )}
    </div>
  )
}

export default MainUI
