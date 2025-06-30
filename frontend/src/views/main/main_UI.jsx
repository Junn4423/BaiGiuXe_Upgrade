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
import RfidManagerDialog from "../dialogs/RfidManagerDialog"
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
  const [showRfidManager, setShowRfidManager] = useState(false)
  
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
  const openRfidManager = () => setShowRfidManager(true)

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

    // Step 1: Check if card exists in database
    try {
      console.log(`🔍 Checking if card ${cardId} exists in database...`)
      if (vehicleInfoComponentRef.current) {
        vehicleInfoComponentRef.current.updateCardReaderStatus("ĐANG KIỂM TRA THẺ...", "#f59e0b")
      }

      // Load all cards to check existence
      const { layDanhSachThe, timTheDangCoPhien } = await import("../../api/api")
      const cardList = await layDanhSachThe()
      
      if (!cardList || !Array.isArray(cardList)) {
        throw new Error("Không thể tải danh sách thẻ")
      }

      const cardExists = cardList.find(card => card.uidThe === cardId)
      
      if (!cardExists) {
        console.log(`❌ Card ${cardId} not found in database - opening add card dialog`)
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateCardReaderStatus("THẺ CHƯA ĐĂNG KÝ", "#ef4444")
        }
        
        // Open add card dialog with scanned card ID
        setShowAddCard({ show: true, cardId: cardId })
        showToast(`🔔 Thẻ ${cardId} chưa được đăng ký. Vui lòng thêm thẻ mới.`, 'warning', 5000)
        return
      }

      console.log(`✅ Card ${cardId} found in database:`, cardExists)
      
      // Step 2: Check if card has active parking session (only for "vao" mode)
      if (actualMode === 'vao') {
        console.log(`🔍 Checking if card ${cardId} has active parking session...`)
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateCardReaderStatus("KIỂM TRA PHIÊN GỬI XE...", "#f59e0b")
        }

        const activeSession = await timTheDangCoPhien(cardId)
        
        if (activeSession && activeSession.length > 0) {
          console.log(`❌ Card ${cardId} already has active parking session:`, activeSession)
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus("THẺ ĐÃ CÓ PHIÊN GỬI XE", "#ef4444")
          }
          showToast(`❌ Thẻ ${cardId} đã tồn tại trong phiên gửi xe!`, 'error', 5000)
          return
        }
      }

      console.log(`✅ Card ${cardId} is valid and ready for processing`)

      // Update vehicle info with scanned card
      if (vehicleInfoComponentRef.current) {
        console.log(`📝 Updating vehicle info with card: ${cardId} and mode: ${actualMode}`)
        vehicleInfoComponentRef.current.updateVehicleInfo({ 
          ma_the: cardId,
          trang_thai: `Xe ${actualMode === 'vao' ? 'vào' : 'ra'}` 
        })
        vehicleInfoComponentRef.current.updateCardReaderStatus("ĐANG CHỤP ẢNH...", "#f59e0b")
      }

      // Step 3: Capture images from camera
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
            plateImage: plateImage?.url || plateImage,
            faceImage: faceImage?.url || faceImage,
            plateImageBlob: plateImage?.blob,
            faceImageBlob: faceImage?.blob
          })

          // Display captured images on camera panels
          if (cameraComponentRef.current) {
            console.log(`📺 Displaying images on camera panels for card ${cardId}`)
            if (plateImage?.url || plateImage) {
              console.log(`📺 Displaying plate image on panel 1:`, plateImage?.url || plateImage)
              cameraComponentRef.current.displayCapturedImage(plateImage?.url || plateImage, 1)
            }
            
            if (faceImage?.url || faceImage) {
              console.log(`📺 Displaying face image on panel 2:`, faceImage?.url || faceImage)
              cameraComponentRef.current.displayCapturedFaceImage(faceImage?.url || faceImage)
            }
          }

          // Update status after capture and display
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus("ẢNH ĐÃ HIỂN THỊ", "#10b981")
          }

          // Auto recognize license plate after capture
          let recognizedLicensePlate = null
          if (plateImage?.blob || capturedImages.plateImageBlob) {
            console.log(`🚗 Starting automatic license plate recognition for ${actualMode} mode...`)
            
            if (vehicleInfoComponentRef.current) {
              vehicleInfoComponentRef.current.updateCardReaderStatus("ĐANG NHẬN DẠNG BIỂN SỐ...", "#f59e0b")
            }
            
            try {
              const blob = plateImage?.blob || capturedImages.plateImageBlob
              if (blob) {
                console.log(`📤 Sending image for recognition, blob size: ${blob.size} bytes`)
                const recognitionResult = await nhanDangBienSo(blob)
                console.log(`✅ License plate recognition result:`, recognitionResult)
                
                let confidence = 0
                
                if (recognitionResult && recognitionResult.ket_qua && recognitionResult.ket_qua.length > 0) {
                  const firstResult = recognitionResult.ket_qua[0]
                  console.log(`🔍 Processing OCR result:`, firstResult)
                  
                  if (firstResult.ocr) {
                    if (typeof firstResult.ocr === 'string') {
                      const textMatch = firstResult.ocr.match(/text='([^']+)'/)
                      const confMatch = firstResult.ocr.match(/confidence=([0-9.]+)/)
                      
                      if (textMatch) recognizedLicensePlate = textMatch[1]
                      if (confMatch) confidence = parseFloat(confMatch[1])
                    } else if (typeof firstResult.ocr === 'object') {
                      recognizedLicensePlate = firstResult.ocr.text || null
                      confidence = firstResult.ocr.confidence || 0
                    }
                  }
                }
                
                console.log(`🏷️ Extracted license plate: ${recognizedLicensePlate}, confidence: ${confidence}`)
                
                if (recognizedLicensePlate && cameraComponentRef.current) {
                  const direction = actualMode === 'vao' ? 'in' : 'out'
                  cameraComponentRef.current.updateLicensePlateDisplay(recognizedLicensePlate, null, direction)
                  
                  if (vehicleInfoComponentRef.current) {
                    const confidencePercent = (confidence * 100).toFixed(1)
                    vehicleInfoComponentRef.current.updateCardReaderStatus(
                      `BIỂN SỐ: ${recognizedLicensePlate} (${confidencePercent}%)`, 
                      "#10b981"
                    )
                  }
                  
                  showToast(`🏷️ Nhận dạng biển số: ${recognizedLicensePlate}`, 'success', 3000)
                } else {
                  if (vehicleInfoComponentRef.current) {
                    vehicleInfoComponentRef.current.updateCardReaderStatus("KHÔNG NHẬN DẠNG ĐƯỢC BIỂN SỐ", "#ef4444")
                  }
                  showToast(`❌ Không nhận dạng được biển số`, 'warning', 3000)
                }
              }
            } catch (recognitionError) {
              console.error("❌ Error recognizing license plate:", recognitionError)
              if (vehicleInfoComponentRef.current) {
                vehicleInfoComponentRef.current.updateCardReaderStatus("LỖI NHẬN DẠNG BIỂN SỐ", "#ef4444")
              }
              showToast(`❌ Lỗi nhận dạng biển số: ${recognitionError.message}`, 'error', 4000)
            }
          }

          // Step 4: Save parking session for "vao" mode
          if (actualMode === 'vao') {
            console.log(`💾 Saving parking session for card ${cardId}...`)
            
            if (vehicleInfoComponentRef.current) {
              vehicleInfoComponentRef.current.updateCardReaderStatus("ĐANG LƯU PHIÊN GỬI XE...", "#f59e0b")
            }

            try {
              // Get dynamic data from APIs
              console.log(`🔍 Loading dynamic configuration data...`)
              
              // Import APIs and validation utilities
              const { layChinhSachMacDinhChoLoaiPT } = await import("../../api/api")
              const { validateAndEnsurePricingPolicy, themPhienGuiXeWithValidation } = await import("../../utils/sessionValidation")
              
              // Determine vehicle type based on work config
              let vehicleTypeCode = "XE_MAY" // default
              if (workConfig?.loai_xe) {
                // Map display names to codes
                const vehicleTypeMapping = {
                  "xe_may": "XE_MAY",
                  "oto": "OT"
                }
                vehicleTypeCode = vehicleTypeMapping[workConfig.loai_xe] || "XE_MAY"
              }
              
              console.log(`🚗 Vehicle type determined: ${vehicleTypeCode}`)
              
              // Get pricing policy using helper function (logic from python-example)
              console.log(`🔍 Getting pricing policy for workConfig.loai_xe: ${workConfig?.loai_xe}, vehicleTypeCode: ${vehicleTypeCode}`)
              const rawPricingPolicy = await layChinhSachMacDinhChoLoaiPT(workConfig?.loai_xe, vehicleTypeCode)
              console.log(`✅ Raw pricing policy from helper: ${rawPricingPolicy}`)
              
              // Apply validation middleware to ensure policy is always valid
              const pricingPolicy = validateAndEnsurePricingPolicy(rawPricingPolicy, workConfig?.loai_xe, vehicleTypeCode)
              console.log(`✅ Final validated pricing policy: ${pricingPolicy}`)
              
              // Extra validation to ensure we have a valid policy
              if (!pricingPolicy || pricingPolicy === "" || pricingPolicy === null || pricingPolicy === undefined) {
                console.error(`❌ CRITICAL: Got invalid pricing policy after validation: ${pricingPolicy}`)
                console.error(`❌ workConfig:`, workConfig)
                console.error(`❌ vehicleTypeCode:`, vehicleTypeCode)
                console.error(`❌ rawPricingPolicy:`, rawPricingPolicy)
                throw new Error("Không thể xác định chính sách giá phù hợp. Vui lòng kiểm tra cấu hình.")
              }
              
              // Get entry gate from zone info, work config, or API (pm_nc0007)
              let entryGate = null
              if (zoneInfo?.cameraVao && zoneInfo.cameraVao.length > 0) {
                // Use first available entry camera as gate identifier
                entryGate = zoneInfo.cameraVao[0].tenCamera || zoneInfo.cameraVao[0].maCamera
              } else if (workConfig?.entry_gate) {
                entryGate = workConfig.entry_gate
              }
              // Nếu vẫn chưa có entryGate, lấy từ bảng pm_nc0007
              if (!entryGate) {
                try {
                  const { layDanhSachCong } = await import("../../api/api")
                  const gateRes = await layDanhSachCong()
                  let gates = gateRes?.data || gateRes || []
                  if (Array.isArray(gates) && gates.length > 0) {
                    // Ưu tiên cổng thuộc zone hiện tại nếu có
                    if (zoneInfo?.maKhuVuc) {
                      const zoneGate = gates.find(g => g.maKhuVuc === zoneInfo.maKhuVuc)
                      if (zoneGate) entryGate = zoneGate.tenCong || zoneGate.maCong
                    }
                    // Nếu vẫn chưa có, lấy cổng đầu tiên
                    if (!entryGate) entryGate = gates[0].tenCong || gates[0].maCong
                  } else {
                    entryGate = "GATE_UNKNOWN"
                  }
                  console.log("🔑 Entry gate lấy từ pm_nc0007:", entryGate)
                } catch (err) {
                  console.error("❌ Không lấy được danh sách cổng từ pm_nc0007:", err)
                  entryGate = "GATE_UNKNOWN"
                }
              }
              if (!entryGate) entryGate = "GATE_UNKNOWN"

              // Get parking spot from work config or generate based on zone
              let parkingSpot = "A01" // default
              if (workConfig?.parking_spot) {
                parkingSpot = workConfig.parking_spot
              } else if (zoneInfo?.maKhuVuc) {
                // Generate parking spot based on zone code and timestamp
                const timestamp = new Date().getTime().toString().slice(-3)
                parkingSpot = `${zoneInfo.maKhuVuc}-${timestamp}`
              }
              
              // Get camera ID
              let cameraId = "CAM001" // default
              if (zoneInfo?.cameraVao && zoneInfo.cameraVao.length > 0) {
                cameraId = zoneInfo.cameraVao[0].maCamera
              }
              
              console.log(`📋 Dynamic configuration loaded:`, {
                vehicleTypeCode,
                pricingPolicy,
                entryGate,
                parkingSpot,
                cameraId,
                zoneCode: zoneInfo?.maKhuVuc
              })

              // Prepare session data with dynamic values
              const currentTime = new Date()
              
              // Final safety check for pricing policy
              let finalPricingPolicy = pricingPolicy
              if (!finalPricingPolicy || finalPricingPolicy.trim() === '') {
                console.error(`❌ CRITICAL: pricingPolicy is invalid: ${finalPricingPolicy}`)
                // Emergency fallback based on vehicleTypeCode
                finalPricingPolicy = (vehicleTypeCode === "OT") ? "CS_OTO_4H" : "CS_XEMAY_4H"
                console.log(`🚨 Emergency fallback policy: ${finalPricingPolicy}`)
              }
              
              const sessionData = {
                uidThe: cardId,
                bienSo: recognizedLicensePlate || "",
                viTriGui: parkingSpot,
                chinhSach: finalPricingPolicy,
                congVao: entryGate,
                gioVao: currentTime.toISOString().slice(0, 19).replace("T", " "), // Format: YYYY-MM-DD HH:mm:ss
                anhVao: plateImage?.url || plateImage || "",
                anhMatVao: faceImage?.url || faceImage || "",
                trangThai: "TRONG_BAI", // Explicitly set status
                camera_id: cameraId,
                plate_match: recognizedLicensePlate ? 1 : 0, // 1 if license plate recognized, 0 otherwise
                plate: recognizedLicensePlate || ""
              }

              console.log(`💾 Session data to save (with dynamic config):`, sessionData)
              
              // Extra detailed logging for debugging
              console.log(`🔍 DEBUGGING SESSION DATA:`)
              console.log(`  - uidThe: "${sessionData.uidThe}" (type: ${typeof sessionData.uidThe})`)
              console.log(`  - chinhSach: "${sessionData.chinhSach}" (type: ${typeof sessionData.chinhSach})`)
              console.log(`  - congVao: "${sessionData.congVao}" (type: ${typeof sessionData.congVao})`)
              console.log(`  - gioVao: "${sessionData.gioVao}" (type: ${typeof sessionData.gioVao})`)

              // Validate required fields before sending
              const requiredFields = ['uidThe', 'chinhSach', 'congVao', 'gioVao']
              const missingFields = requiredFields.filter(field => !sessionData[field] || sessionData[field] === "" || sessionData[field] === null || sessionData[field] === undefined)
              
              if (missingFields.length > 0) {
                console.error(`❌ MISSING FIELDS DETECTED:`, missingFields)
                console.error(`❌ FULL SESSION DATA:`, sessionData)
                throw new Error(`Thiếu thông tin bắt buộc: ${missingFields.join(', ')}`)
              }

              console.log(`✅ All required fields present, sending to API...`)

              // Use enhanced API call with built-in validation
              const result = await themPhienGuiXeWithValidation(sessionData)
              
              console.log(`📥 API Response:`, result)

              if (result && result.success) {
                console.log(`✅ Parking session saved successfully:`, result)
                
                if (vehicleInfoComponentRef.current) {
                  vehicleInfoComponentRef.current.updateCardReaderStatus("XE VÀO THÀNH CÔNG", "#10b981")
                  vehicleInfoComponentRef.current.updateVehicleStatus("XE ĐÃ VÀO BÃI", "#10b981")
                  // Update parking info
                  vehicleInfoComponentRef.current.updateVehicleInfo({
                    ma_the: cardId,
                    bien_so: recognizedLicensePlate || "Chưa nhận dạng",
                    vi_tri: parkingSpot,
                    chinh_sach: pricingPolicy,
                    cong_vao: entryGate,
                    trang_thai: "Xe đã vào bãi"
                  })
                }
                
                showToast(`✅ Xe vào thành công! Thẻ: ${cardId} | Vị trí: ${parkingSpot}`, 'success', 5000)
                
                // Show success info for 3 seconds before clearing
                setTimeout(() => {
                  if (vehicleInfoComponentRef.current) {
                    vehicleInfoComponentRef.current.clearVehicleInfo()
                  }
                  // Restore camera feeds
                  if (cameraComponentRef.current) {
                    cameraComponentRef.current.restoreCaptureFeeds()
                  }
                }, 3000)
                
              } else {
                throw new Error(result?.message || "Không thể lưu phiên gửi xe")
              }

            } catch (sessionError) {
              console.error("❌ Error saving parking session:", sessionError)
              if (vehicleInfoComponentRef.current) {
                vehicleInfoComponentRef.current.updateCardReaderStatus("LỖI LƯU PHIÊN GỬI XE", "#ef4444")
              }
              showToast(`❌ Lỗi lưu phiên gửi xe: ${sessionError.message}`, 'error', 5000)
            }
          } else {
            // For "ra" mode, process vehicle exit
            console.log(`🚪 Processing vehicle exit for card ${cardId}...`)
            
            if (vehicleInfoComponentRef.current) {
              vehicleInfoComponentRef.current.updateCardReaderStatus("ĐANG XỬ LÝ XE RA...", "#f59e0b")
            }

            try {
              // Find active parking session for this card
              const { loadPhienGuiXeTheoMaThe, capNhatPhienGuiXe, tinhPhiGuiXe } = await import("../../api/api")
              
              console.log(`🔍 Loading active session for card ${cardId}...`)
              const activeSessions = await loadPhienGuiXeTheoMaThe(cardId)
              
              if (!activeSessions || activeSessions.length === 0) {
                throw new Error("Không tìm thấy phiên gửi xe cho thẻ này")
              }

              // Get the most recent active session
              const activeSession = activeSessions[0]
              console.log(`✅ Found active session:`, activeSession)

              // Get exit gate from zone info or work config
              let exitGate = "GATE01" // default
              if (zoneInfo?.cameraRa && zoneInfo.cameraRa.length > 0) {
                exitGate = zoneInfo.cameraRa[0].tenCamera || zoneInfo.cameraRa[0].maCamera || "GATE01"
              } else if (workConfig?.exit_gate) {
                exitGate = workConfig.exit_gate
              }

              // Get exit camera ID
              let exitCameraId = "CAM002" // default
              if (zoneInfo?.cameraRa && zoneInfo.cameraRa.length > 0) {
                exitCameraId = zoneInfo.cameraRa[0].maCamera
              }

              // Update session with exit information
              const exitSessionData = {
                maPhien: activeSession.maPhien,
                congRa: exitGate,
                gioRa: new Date().toISOString(),
                anhRa: plateImage?.url || plateImage || "",
                anhMatRa: faceImage?.url || faceImage || "",
                camera_id: exitCameraId,
                plate_match: recognizedLicensePlate ? 1 : 0, // 1 if license plate recognized, 0 otherwise
                plate: recognizedLicensePlate || ""
              }

              console.log(`💾 Exit session data to update:`, exitSessionData)

              // Update parking session with exit data
              const updateResult = await capNhatPhienGuiXe(exitSessionData)

              if (updateResult && updateResult.success) {
                console.log(`✅ Exit session updated successfully:`, updateResult)
                
                // Calculate parking fee
                try {
                  console.log(`💰 Calculating parking fee for session ${activeSession.maPhien}...`)
                  const feeResult = await tinhPhiGuiXe(activeSession.maPhien)
                  console.log(`💰 Fee calculation result:`, feeResult)
                  
                  let parkingFee = 0
                  let parkingDuration = 0
                  
                  if (feeResult && feeResult.success) {
                    parkingFee = feeResult.phi || feeResult.fee || 0
                    parkingDuration = feeResult.tongPhut || feeResult.duration || 0
                  }

                  if (vehicleInfoComponentRef.current) {
                    vehicleInfoComponentRef.current.updateCardReaderStatus("XE RA THÀNH CÔNG", "#10b981")
                    vehicleInfoComponentRef.current.updateVehicleStatus("XE ĐÃ RA KHỎI BÃI", "#10b981")
                    vehicleInfoComponentRef.current.updateParkingFee(parkingFee)
                    
                    // Update vehicle info with exit details
                    vehicleInfoComponentRef.current.updateVehicleInfo({
                      ma_the: cardId,
                      bien_so: recognizedLicensePlate || activeSession.bienSo || "Chưa nhận dạng",
                      vi_tri: activeSession.viTriGui || "N/A",
                      cong_ra: exitGate,
                      thoi_gian_gui: parkingDuration ? `${parkingDuration} phút` : "N/A",
                      phi_gui_xe: parkingFee,
                      trang_thai: "Xe đã ra khỏi bãi"
                    })
                  }

                  // Update license plate display with fee
                  if (cameraComponentRef.current && recognizedLicensePlate) {
                    cameraComponentRef.current.updateLicensePlateDisplay(recognizedLicensePlate, parkingFee, 'out')
                  }

                  const feeText = parkingFee > 0 ? ` | Phí: ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(parkingFee)}` : ""
                  showToast(`✅ Xe ra thành công! Thẻ: ${cardId}${feeText}`, 'success', 5000)

                } catch (feeError) {
                  console.error("❌ Error calculating parking fee:", feeError)
                  // Still show success for exit, just without fee info
                  if (vehicleInfoComponentRef.current) {
                    vehicleInfoComponentRef.current.updateCardReaderStatus("XE RA THÀNH CÔNG (CHƯA TÍNH PHÍ)", "#f59e0b")
                    vehicleInfoComponentRef.current.updateVehicleStatus("XE ĐÃ RA KHỎI BÃI", "#10b981")
                  }
                  showToast(`✅ Xe ra thành công! Thẻ: ${cardId} (Lỗi tính phí: ${feeError.message})`, 'warning', 5000)
                }
                
                // Show success info for 5 seconds before clearing (longer for exit to review fee)
                setTimeout(() => {
                  if (vehicleInfoComponentRef.current) {
                    vehicleInfoComponentRef.current.clearVehicleInfo()
                  }
                  // Restore camera feeds
                  if (cameraComponentRef.current) {
                    cameraComponentRef.current.restoreCaptureFeeds()
                  }
                }, 5000)

              } else {
                throw new Error(updateResult?.message || "Không thể cập nhật phiên gửi xe")
              }

            } catch (exitError) {
              console.error("❌ Error processing vehicle exit:", exitError)
              if (vehicleInfoComponentRef.current) {
                vehicleInfoComponentRef.current.updateCardReaderStatus("LỖI XỬ LÝ XE RA", "#ef4444")
              }
              showToast(`❌ Lỗi xử lý xe ra: ${exitError.message}`, 'error', 5000)
              
              // Still show captured images even if exit processing fails
              const saveMessage = environmentInfo?.isElectron 
                ? `⚠️ Đã lưu ảnh nhưng có lỗi xử lý xe ra cho thẻ: ${cardId}`
                : `⚠️ Đã download ảnh nhưng có lỗi xử lý xe ra cho thẻ: ${cardId}`
              
              showToast(saveMessage, 'warning', 4000)
            }
          }

        } catch (error) {
          console.error("❌ Error capturing images:", error)
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus("LỖI CHỤP ẢNH", "#ef4444")
          }
          showToast(`❌ Lỗi chụp ảnh cho thẻ: ${cardId} (${actualMode})`, 'error', 5000)
        }
      }

    } catch (error) {
      console.error("❌ Error in card scanning process:", error)
      if (vehicleInfoComponentRef.current) {
        vehicleInfoComponentRef.current.updateCardReaderStatus("LỖI XỬ LÝ THẺ", "#ef4444")
      }
      showToast(`❌ Lỗi xử lý thẻ: ${error.message}`, 'error', 5000)
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
          <button className="toolbar-btn" onClick={openRfidManager}>
            THẺ RFID
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

      {showRfidManager && (
        <RfidManagerDialog
          onClose={() => setShowRfidManager(false)}
          onSave={() => {
            console.log("RFID cards updated")
            setShowRfidManager(false)
          }}
        />
      )}

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
