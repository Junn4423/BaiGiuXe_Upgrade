"use client"

import { useEffect, useRef, useState } from "react"
import "../../assets/styles/main_UI.css"
import CameraComponent from "../../components/CameraComponent"
import VehicleInfoComponent from "../../components/VehicleInfoComponent"
import VehicleListComponent from "../../components/VehicleListComponent"
import QuanLyCamera from "../../components/QuanLyCamera"
import QuanLyXe from "../../components/QuanLyXe"
import DauDocThe from "../../components/DauDocThe"
import { nhanDangBienSo } from "../../api/api"
import BienSoLoiDialog from "../dialogs/BienSoLoiDialog"
import CameraConfigDialog from "../dialogs/CameraConfigDialog"
import ParkingZoneDialog from "../dialogs/ParkingZoneDialog"
import PricingPolicyDialog from "../dialogs/PricingPolicyDialog"
import ThemTheDialog from "../dialogs/ThemTheDialog"
import WorkConfigDialog from "../dialogs/WorkConfigDialog"
import ImageCaptureModal from "../../components/ImageCaptureModal"
import { useToast } from "../../components/Toast"
import { layDanhSachCamera, layDanhSachKhu } from "../../api/api"
import { cleanupObjectUrls, getEnvironmentInfo } from "../../utils/imageUtils"

const MainUI = () => {
  const { showToast, ToastContainer } = useToast()
  
  // State management
  const [activeTab, setActiveTab] = useState("management")
  const [currentMode, setCurrentMode] = useState("vao")
  const currentModeRef = useRef("vao") // Add ref to track current mode

  // Keep ref in sync with state
  useEffect(() => {
    currentModeRef.current = currentMode
  }, [currentMode])
  const [currentVehicleType, setCurrentVehicleType] = useState("xe_may")
  const [currentZone, setCurrentZone] = useState(null)
  const [workConfig, setWorkConfig] = useState(null)
  const [zoneInfo, setZoneInfo] = useState(null)

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
  
  // Card scanning and image capture
  const [showImageCaptureModal, setShowImageCaptureModal] = useState(false)
  const [capturedImages, setCapturedImages] = useState({ 
    plateImage: null, 
    faceImage: null,
    plateImageBlob: null,
    faceImageBlob: null 
  })
  const [scannedCardId, setScannedCardId] = useState("")
  const [environmentInfo, setEnvironmentInfo] = useState(null)
  const rfidBuffer = useRef("")

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

  // Load zone info when work config changes
  useEffect(() => {
    if (workConfig && workConfig.ma_khu_vuc) {
      loadZoneInfo(workConfig.ma_khu_vuc)
    }
  }, [workConfig])

  // Check environment and setup auto-save info
  useEffect(() => {
    const checkEnvironment = async () => {
      try {
        const envInfo = await getEnvironmentInfo()
        setEnvironmentInfo(envInfo)
        console.log('🖥️ Environment info:', envInfo)
        
        if (envInfo.isElectron) {
          showToast(`✅ Electron App: Ảnh sẽ tự động lưu vào ${envInfo.saveLocation}`, 'success', 6000)
        } else {
          showToast(`🌐 Web App: Ảnh sẽ được download tự động`, 'info', 4000)
        }
      } catch (error) {
        console.error('Error checking environment:', error)
      }
    }
    checkEnvironment()
  }, []) // Empty dependency array - chỉ chạy 1 lần khi mount

  // Card scanning effect
  useEffect(() => {
    const handleKeyDown = (event) => {
      // Ignore if typing in input fields
      const tag = event.target.tagName.toLowerCase()
      if (tag === "input" || tag === "textarea" || event.target.isContentEditable) return

      // Ignore modifier keys
      if (event.ctrlKey || event.altKey || event.metaKey) return

      // Only allow digits and letters
      if (/^[a-zA-Z0-9]$/.test(event.key)) {
        rfidBuffer.current += event.key
      } else if (event.key === "Enter") {
        if (rfidBuffer.current.length > 0) {
          handleCardScanned(rfidBuffer.current)
          rfidBuffer.current = ""
        }
      } else if (event.key === "Backspace") {
        rfidBuffer.current = rfidBuffer.current.slice(0, -1)
      } else if (event.key === "F2") {
        // Test hotkey - simulate card scan
        event.preventDefault()
        const testCardId = "0002468477"
        console.log(`🧪 Testing card scan with: ${testCardId}`)
        handleCardScanned(testCardId)
      }
    }

    window.addEventListener("keydown", handleKeyDown)
    return () => window.removeEventListener("keydown", handleKeyDown)
  }, [])

  // Load work configuration
  const loadWorkConfig = () => {
    try {
      const savedConfig = localStorage.getItem("work_config")
      if (savedConfig) {
        const config = JSON.parse(savedConfig)
        setWorkConfig(config)
        setCurrentVehicleType(config.loai_xe || "xe_may")
        // Set default mode from config
        setCurrentMode(config.default_mode || "vao")
        console.log("✅ Loaded work config:", config)
      } else {
        // Show work config dialog if no config exists
        console.log("⚠️ No work config found, showing dialog")
        setShowWorkConfig(true)
      }
    } catch (error) {
      console.error("❌ Error loading work config:", error)
      setShowWorkConfig(true)
    }
  }

  // Load zone information with cameras
  const loadZoneInfo = async (zoneCode) => {
    try {
      console.log(`🏢 Loading zone info for: ${zoneCode}`)

      // Load all cameras
      const camerasResponse = await layDanhSachCamera()
      console.log("📹 All cameras:", camerasResponse)

      // Load zone details
      const zonesResponse = await layDanhSachKhu()
      console.log("🏢 All zones:", zonesResponse)

      // Find current zone - use ma_khu_vuc from work config instead of zone name
      const actualZoneCode = workConfig?.ma_khu_vuc || zoneCode
      const zone = zonesResponse.find((z) => z.maKhuVuc === actualZoneCode)
      if (!zone) {
        console.error(`❌ Zone not found: ${actualZoneCode}`)
        console.log(
          "Available zones:",
          zonesResponse.map((z) => ({ maKhuVuc: z.maKhuVuc, tenKhuVuc: z.tenKhuVuc })),
        )
        return
      }

      console.log(`✅ Found zone: ${zone.tenKhuVuc} (${zone.maKhuVuc})`)

      // Filter cameras for this zone using the actual zone code
      const zoneCameras = camerasResponse.filter((camera) => camera.maKhuVuc === actualZoneCode)
      console.log(`📹 Cameras for zone ${actualZoneCode}:`, zoneCameras)

      // Group cameras by type
      const cameraVao = zoneCameras.filter((camera) => camera.loaiCamera === "VAO")
      const cameraRa = zoneCameras.filter((camera) => camera.loaiCamera === "RA")

      const zoneInfoData = {
        ...zone,
        cameraVao,
        cameraRa,
        allCameras: zoneCameras,
      }

      console.log("🏢 Zone info loaded:", zoneInfoData)
      setZoneInfo(zoneInfoData)
      setCurrentZone(zoneInfoData)
    } catch (error) {
      console.error("❌ Error loading zone info:", error)
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
      updateLicensePlateDisplay: (licensePlate, fee, direction) => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.updateLicensePlateDisplay(licensePlate, fee, direction)
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
        console.log(`📢 ${title}: ${message}`)
        // Show as toast warning for camera fallback issues
        if (title.includes('Camera') || message.includes('camera')) {
          showToast(`⚠️ ${message}`, 'warning', 6000)
        }
      },
      showError: (title, message) => {
        console.error(`❌ Error: ${title} - ${message}`)
        showToast(`❌ ${title}: ${message}`, 'error', 5000)
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
    const handleKeyDown = (event) => {
      // Only handle on main content (not in input, textarea, etc.)
      const tag = event.target.tagName.toLowerCase()
      if (tag === "input" || tag === "textarea" || event.target.isContentEditable) return

      // Tab: toggle between management <-> vehicle list
      if (event.key === "Tab") {
        event.preventDefault()
        setActiveTab((prev) => (prev === "management" ? "list" : "management"))
      }
      // Space: switch mode (vao <-> ra)
      if (event.code === "Space" || event.key === " ") {
        event.preventDefault()
        setCurrentMode((prev) => {
          const newMode = prev === "vao" ? "ra" : "vao"
          currentModeRef.current = newMode // Update ref immediately
          console.log(`🔄 Mode changed from ${prev} to ${newMode} (via Space key)`)
          return newMode
        })
      }
    }
    document.addEventListener("keydown", handleKeyDown)
    return () => document.removeEventListener("keydown", handleKeyDown)
  }

  // Handle mode change
  const handleModeChange = (mode, vehicleType) => {
    console.log(`🔄 Mode changed to ${mode}, vehicle type: ${vehicleType}`)
    setCurrentMode(mode)
    currentModeRef.current = mode // Update ref immediately
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
      console.error("❌ Error during cleanup:", error)
    }
  }

  // Handle work config save
  const handleWorkConfigSave = (config) => {
    setWorkConfig(config)
    setCurrentVehicleType(config.loai_xe || "xe_may")
    setShowWorkConfig(false)
    console.log("✅ Work config updated:", config)
  }

  // Handle card scanning
  const handleCardScanned = async (cardId) => {
    const actualMode = currentModeRef.current // Use ref to get latest mode
    console.log(`🎯 Card scanned: ${cardId} in mode: ${actualMode}`)
    setScannedCardId(cardId)

    // Update vehicle info with scanned card
    if (vehicleInfoComponentRef.current) {
      console.log(`📝 Updating vehicle info with card: ${cardId} and mode: ${actualMode}`)
      vehicleInfoComponentRef.current.updateVehicleInfo({ 
        ma_the: cardId,
        trang_thai: `Xe ${actualMode === 'vao' ? 'vào' : 'ra'}` 
      })
      vehicleInfoComponentRef.current.updateCardReaderStatus("ĐANG CHỤP ẢNH...", "#f59e0b")
    } else {
      console.error(`❌ VehicleInfoComponentRef is null - cannot update vehicle info`)
    }

    // Capture images from camera
    if (cameraManagerRef.current) {
      try {
        console.log(`📸 Capturing images for card ${cardId} in ${actualMode} mode`)
        
        const [plateImage, licensePlate, faceImage] = await cameraManagerRef.current.captureImage(cardId, actualMode)
        
        console.log(`📷 Capture results:`, {
          plateImage: plateImage ? { url: plateImage.url || plateImage, hasBlob: !!plateImage.blob } : null,
          faceImage: faceImage ? { url: faceImage.url || faceImage, hasBlob: !!faceImage.blob } : null,
          mode: actualMode
        })
        
        setCapturedImages({
          plateImage: plateImage?.url || plateImage, // Handle both new format and old format
          faceImage: faceImage?.url || faceImage,
          plateImageBlob: plateImage?.blob, // Store blob for API calls
          faceImageBlob: faceImage?.blob
        })

        // Display captured images directly on camera panels instead of modal
        if (cameraComponentRef.current) {
          console.log(`📺 Displaying images on camera panels for card ${cardId}`)
          // Display plate image on capture panel
          if (plateImage?.url || plateImage) {
            console.log(`📺 Displaying plate image on panel 1:`, plateImage?.url || plateImage)
            cameraComponentRef.current.displayCapturedImage(plateImage?.url || plateImage, 1)
          }
          
          // Display face image on capture panel  
          if (faceImage?.url || faceImage) {
            console.log(`📺 Displaying face image on panel 2:`, faceImage?.url || faceImage)
            cameraComponentRef.current.displayCapturedFaceImage(faceImage?.url || faceImage)
          }
        } else {
          console.error(`❌ CameraComponentRef is null - cannot display images`)
        }

        // Update status after capture and display
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateCardReaderStatus("ẢNH ĐÃ HIỂN THỊ", "#10b981")
        }

        // Auto recognize license plate after capture
        if (plateImage?.blob || capturedImages.plateImageBlob) {
          console.log(`🚗 Starting automatic license plate recognition for ${actualMode} mode...`)
          
          // Update status to show recognition in progress
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus("ĐANG NHẬN DẠNG BIỂN SỐ...", "#f59e0b")
          }
          
          try {
            // Use blob for recognition
            const blob = plateImage?.blob || capturedImages.plateImageBlob
            if (blob) {
              console.log(`📤 Sending image for recognition, blob size: ${blob.size} bytes`)
              const recognitionResult = await nhanDangBienSo(blob)
              console.log(`✅ License plate recognition result:`, recognitionResult)
              
              // Extract license plate from result
              let licensePlate = "N/A"
              let confidence = 0
              
              if (recognitionResult && recognitionResult.ket_qua && recognitionResult.ket_qua.length > 0) {
                const firstResult = recognitionResult.ket_qua[0]
                console.log(`🔍 Processing OCR result:`, firstResult)
                
                if (firstResult.ocr) {
                  if (typeof firstResult.ocr === 'string') {
                    // Parse string format: "OcrResult(text='86B821322', confidence=0.913814127445221)"
                    const textMatch = firstResult.ocr.match(/text='([^']+)'/)
                    const confMatch = firstResult.ocr.match(/confidence=([0-9.]+)/)
                    
                    if (textMatch) licensePlate = textMatch[1]
                    if (confMatch) confidence = parseFloat(confMatch[1])
                  } else if (typeof firstResult.ocr === 'object') {
                    licensePlate = firstResult.ocr.text || "N/A"
                    confidence = firstResult.ocr.confidence || 0
                  }
                }
              }
              
              console.log(`🏷️ Extracted license plate: ${licensePlate}, confidence: ${confidence}`)
              
              // Display license plate on camera panel
              if (cameraComponentRef.current && licensePlate !== "N/A") {
                const direction = actualMode === 'vao' ? 'in' : 'out'
                console.log(`📺 Displaying license plate: ${licensePlate} on direction: ${direction}`)
                cameraComponentRef.current.updateLicensePlateDisplay(licensePlate, null, direction)
                
                // Update status with license plate and confidence
                if (vehicleInfoComponentRef.current) {
                  const confidencePercent = (confidence * 100).toFixed(1)
                  vehicleInfoComponentRef.current.updateCardReaderStatus(
                    `BIỂN SỐ: ${licensePlate} (${confidencePercent}%)`, 
                    "#10b981"
                  )
                }
                
                // Show recognition success toast
                showToast(`🏷️ Nhận dạng biển số: ${licensePlate}`, 'success', 3000)
              } else {
                // Failed to recognize
                if (vehicleInfoComponentRef.current) {
                  vehicleInfoComponentRef.current.updateCardReaderStatus("KHÔNG NHẬN DẠNG ĐƯỢC BIỂN SỐ", "#ef4444")
                }
                showToast(`❌ Không nhận dạng được biển số`, 'warning', 3000)
              }
              
            } else {
              console.log(`❌ No blob available for license plate recognition`)
              if (vehicleInfoComponentRef.current) {
                vehicleInfoComponentRef.current.updateCardReaderStatus("KHÔNG CÓ ẢNH ĐỂ NHẬN DẠNG", "#ef4444")
              }
            }
          } catch (recognitionError) {
            console.error("❌ Error recognizing license plate:", recognitionError)
            if (vehicleInfoComponentRef.current) {
              vehicleInfoComponentRef.current.updateCardReaderStatus("LỖI NHẬN DẠNG BIỂN SỐ", "#ef4444")
            }
            showToast(`❌ Lỗi nhận dạng biển số: ${recognitionError.message}`, 'error', 4000)
          }
        } else {
          console.log(`❌ No plate image available for recognition`)
        }

        // Show success toast
        const saveMessage = environmentInfo?.isElectron 
          ? `✅ Đã lưu ảnh vào thư mục tự động cho thẻ: ${cardId} (${actualMode})`
          : `✅ Đã download ảnh tự động cho thẻ: ${cardId} (${actualMode})`
        
        showToast(saveMessage, 'success', 3000)

        // Don't open modal - images are displayed directly on panels
        // setShowImageCaptureModal(true) // REMOVED - no longer show modal
      } catch (error) {
        console.error("❌ Error capturing images:", error)
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateCardReaderStatus("LỖI CHỤP ẢNH", "#ef4444")
        }
        showToast(`❌ Lỗi chụp ảnh cho thẻ: ${cardId} (${actualMode})`, 'error', 5000)
      }
    }
  }

  // Close image capture modal
  const handleCloseImageModal = () => {
    console.log('🔒 Closing image capture modal')
    setShowImageCaptureModal(false)
    setCapturedImages({ 
      plateImage: null, 
      faceImage: null,
      plateImageBlob: null,
      faceImageBlob: null 
    })
    setScannedCardId("")
    
    // Cleanup object URLs to prevent memory leaks
    cleanupObjectUrls()
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
          tabIndex={-1}
          style={{ pointerEvents: "none", opacity: 0.7 }}
        >
          QUẢN LÝ XE RA VÀO
        </button>
        <button
          className={`tab-btn ${activeTab === "list" ? "active" : ""}`}
          tabIndex={-1}
          style={{ pointerEvents: "none", opacity: 0.7 }}
        >
          DANH SÁCH XE TRONG BÃI
        </button>
      </div>

      {/* Main Content */}
      <div className="main-content">
        {/* Management Layout (always mounted to keep camera stream) */}
        <div
          className="management-layout"
          style={{ display: activeTab === "management" ? "grid" : "none" }}
        >
          <div className="camera-section">
            <CameraComponent ref={cameraComponentRef} currentMode={currentMode} zoneInfo={zoneInfo} />
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

        {/* Vehicle List Layout (always mounted) */}
        <div
          className="list-layout"
          style={{ display: activeTab === "list" ? "block" : "none" }}
        >
          <VehicleListComponent
            ref={vehicleListComponentRef}
            onVehicleSelect={(vehicle) => {
              console.log("Selected vehicle:", vehicle)
            }}
          />
        </div>
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
            // Reload zone info to get updated cameras
            if (workConfig && workConfig.zone) {
              loadZoneInfo(workConfig.zone)
            }
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

      {/* Image Capture Modal */}
      <ImageCaptureModal
        isOpen={showImageCaptureModal}
        onClose={handleCloseImageModal}
        images={capturedImages}
        cardId={scannedCardId}
      />

      {/* Toast Notifications */}
      <ToastContainer />
    </div>
  )
}

export default MainUI
