"use client";

import { useEffect, useRef, useState } from "react";
import { getCurrentDateTime } from "../../utils/timeUtils";
import "../../assets/styles/main_UI.css";
import CameraComponent from "../../components/CameraComponent";
import VehicleInfoComponent from "../../components/VehicleInfoComponent";
import VehicleListComponent from "../../components/VehicleListComponent";
import QuanLyCamera from "../../components/QuanLyCamera";
import QuanLyXe from "../../components/QuanLyXe";
import DauDocThe from "../../components/DauDocThe";
import { nhanDangBienSo } from "../../api/api";
import BienSoLoiDialog from "../dialogs/BienSoLoiDialog";
import CameraConfigDialog from "../dialogs/CameraConfigDialog";
import ParkingZoneDialog from "../dialogs/ParkingZoneDialog";
import PricingPolicyDialog from "../dialogs/PricingPolicyDialog";
import RfidManagerDialog from "../dialogs/RfidManagerDialogClean";
import ThemTheDialog from "../dialogs/ThemTheDialog";
import WorkConfigDialog from "../dialogs/WorkConfigDialog";
import VehicleManagementDialog from "../dialogs/VehicleManagementDialog";
import VehicleTypeDialog from "../dialogs/VehicleTypeDialog";
import ImageCaptureModal from "../../components/ImageCaptureModal";
import LicensePlateConfirmDialog from "../../components/LicensePlateConfirmDialog";
import { useToast } from "../../components/Toast";
import { layDanhSachCamera, layDanhSachKhu } from "../../api/api";
import { cleanupObjectUrls, getEnvironmentInfo, initializeStorageCleanup } from "../../utils/imageUtils";

const MainUI = () => {
  const { showToast, ToastContainer } = useToast();

  // State management
  const [activeTab, setActiveTab] = useState("management");
  const [currentMode, setCurrentMode] = useState("vao");
  const currentModeRef = useRef("vao"); // Add ref to track current mode

  // Keep ref in sync with state
  useEffect(() => {
    currentModeRef.current = currentMode;
  }, [currentMode]);
  const [currentVehicleType, setCurrentVehicleType] = useState("xe_may");
  const [currentZone, setCurrentZone] = useState(null);
  const [workConfig, setWorkConfig] = useState(null);
  const [zoneInfo, setZoneInfo] = useState(null);

  // Component refs
  const cameraManagerRef = useRef();
  const vehicleManagerRef = useRef();
  const cardReaderRef = useRef();
  const cameraComponentRef = useRef();
  const vehicleInfoComponentRef = useRef();
  const vehicleListComponentRef = useRef();

  // Dialog states
  const [showCameraConfig, setShowCameraConfig] = useState(false);
  const [showPricingPolicy, setShowPricingPolicy] = useState(false);
  const [showParkingZone, setShowParkingZone] = useState(false);
  const [showWorkConfig, setShowWorkConfig] = useState(false);
  const [showAddCard, setShowAddCard] = useState(false);
  const [showLicensePlateError, setShowLicensePlateError] = useState(false);
  const [showRfidManager, setShowRfidManager] = useState(false);
  const [showLicensePlateConfirm, setShowLicensePlateConfirm] = useState(false);
  const [showVehicleManagement, setShowVehicleManagement] = useState(false);
  const [showVehicleType, setShowVehicleType] = useState(false);

  // Card scanning and image capture
  const [showImageCaptureModal, setShowImageCaptureModal] = useState(false);
  const [capturedImages, setCapturedImages] = useState({
    plateImage: null,
    faceImage: null,
    plateImageBlob: null,
    faceImageBlob: null,
  });
  const [scannedCardId, setScannedCardId] = useState("");
  const [environmentInfo, setEnvironmentInfo] = useState(null);
  const rfidBuffer = useRef("");

  // Initialize components and connections
  useEffect(() => {
    // Initialize storage cleanup on app start
    initializeStorageCleanup();
    
    loadWorkConfig();
    setupConnections();
    startServices();
    bindShortcuts();

    return () => {
      cleanup();
    };
  }, []);

  // Load zone info when work config changes
  useEffect(() => {
    if (workConfig && workConfig.ma_khu_vuc) {
      loadZoneInfo(workConfig.ma_khu_vuc);
    } else if (workConfig && workConfig.zone) {
      loadZoneInfo(workConfig.zone);
    }
  }, [workConfig]);

  // Check environment and setup auto-save info
  useEffect(() => {
    const checkEnvironment = async () => {
      try {
        const envInfo = await getEnvironmentInfo();
        setEnvironmentInfo(envInfo);

        if (envInfo.isElectron) {
          showToast(
            `✅ Electron App: Ảnh sẽ tự động lưu vào ${envInfo.saveLocation}`,
            "success",
            6000
          );
        } else {
          showToast(`🌐 Web App: Ảnh sẽ được download tự động`, "info", 4000);
        }
      } catch (error) {
        console.error("Error checking environment:", error);
      }
    };
    checkEnvironment();
  }, []);

  // Card scanning effect
  useEffect(() => {
    const handleKeyDown = (event) => {
      // Ignore if typing in input fields
      const tag = event.target.tagName.toLowerCase();
      if (
        tag === "input" ||
        tag === "textarea" ||
        event.target.isContentEditable
      )
        return;

      // Ignore modifier keys
      if (event.ctrlKey || event.altKey || event.metaKey) return;

      // Only allow digits and letters
      if (/^[a-zA-Z0-9]$/.test(event.key)) {
        rfidBuffer.current += event.key;
      } else if (event.key === "Enter") {
        if (rfidBuffer.current.length > 0) {
          handleCardScanned(rfidBuffer.current);
          rfidBuffer.current = "";
        }
      } else if (event.key === "Backspace") {
        rfidBuffer.current = rfidBuffer.current.slice(0, -1);
      } else if (event.key === "F2") {
        // Test hotkey - simulate card scan
        event.preventDefault();
        const testCardId = "0002468477";
        console.log("🔥 F2 pressed - testing card scan with ID:", testCardId);
        handleCardScanned(testCardId);
      }
    };

    window.addEventListener("keydown", handleKeyDown);
    return () => window.removeEventListener("keydown", handleKeyDown);
  }, []);

  // Load work configuration
  const loadWorkConfig = () => {
    try {
      const savedConfig = localStorage.getItem("work_config");
      if (savedConfig) {
        const config = JSON.parse(savedConfig);
        setWorkConfig(config);
        setCurrentVehicleType(config.loai_xe || "xe_may");
        setCurrentMode(config.default_mode || "vao");
      } else {
        setShowWorkConfig(true);
      }
    } catch (error) {
      console.error("Error loading work config:", error);
      setShowWorkConfig(true);
    }
  };

  // Load zone information with cameras
  const loadZoneInfo = async (zoneCode) => {
    try {
      const zonesResponse = await layDanhSachKhu();
      const actualZoneCode = workConfig?.ma_khu_vuc || zoneCode;
      const zone = zonesResponse.find((z) => z.maKhuVuc === actualZoneCode);

      if (!zone) {
        console.error(`Zone not found: ${actualZoneCode}`);
        return;
      }

      const zoneInfoData = {
        ...zone,
        allCameras: [...(zone.cameraVao || []), ...(zone.cameraRa || [])],
      };

      setZoneInfo(zoneInfoData);
      setCurrentZone(zoneInfoData);
    } catch (error) {
      console.error("Error loading zone info:", error);
    }
  };

  // Setup connections between components
  const setupConnections = () => {
    const uiInterface = {
      // Dynamic getters for current state
      get currentMode() { return currentMode; },
      get currentVehicleType() { return currentVehicleType; },
      get currentZone() { return currentZone; },
      get workConfig() { return workConfig; },

      // Camera methods
      displayCapturedImage: (imagePath, panelNumber) => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.displayCapturedImage(
            imagePath,
            panelNumber
          );
        }
      },
      displayCapturedFaceImage: (imagePath) => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.displayCapturedFaceImage(imagePath);
        }
      },
      displayEntryImagesAfterExit: (entryImageUrl, entryFaceUrl) => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.displayEntryImagesAfterExit(
            entryImageUrl,
            entryFaceUrl
          );
        }
      },
      updateLicensePlateDisplay: (licensePlate, fee, direction) => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.updateLicensePlateDisplay(
            licensePlate,
            fee,
            direction
          );
        }
      },
      restoreCaptureFeeds: () => {
        if (cameraComponentRef.current) {
          cameraComponentRef.current.restoreCaptureFeeds();
        }
      },

      // Vehicle info methods
      updateVehicleInfo: (vehicleInfo) => {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateVehicleInfo(vehicleInfo);
        }
      },
      updateCardReaderStatus: (status, color) => {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateCardReaderStatus(status, color);
        }
      },
      updateVehicleStatus: (status, color) => {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateVehicleStatus(status, color);
        }
      },
      updateParkingFee: (fee) => {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateParkingFee(fee);
        }
      },
      clearVehicleInfo: () => {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.clearVehicleInfo();
        }
      },

      // Vehicle list methods
      updateVehicleList: (vehicles) => {
        if (vehicleListComponentRef.current) {
          vehicleListComponentRef.current.updateVehicleList(vehicles);
        }
      },
      updateStatistics: (stats) => {
        if (vehicleListComponentRef.current) {
          vehicleListComponentRef.current.updateStatistics(stats);
        }
      },

      // Dialog methods
      openAddCardDialog: (cardId) => setShowAddCard({ show: true, cardId }),
      openLicensePlateErrorDialog: (data) =>
        setShowLicensePlateError({ show: true, ...data }),

      // Utility methods
      showNotification: (title, message) => {
        // Show as toast warning for camera fallback issues
        if (title.includes("Camera") || message.includes("camera")) {
          showToast(`⚠️ ${message}`, "warning", 6000);
        }
      },
      showError: (title, message) => {
        console.error(`❌ Error: ${title} - ${message}`);
        showToast(`❌ ${title}: ${message}`, "error", 5000);
      },
      
      // Card handling
      handleCardScanned: (cardId) => {
        console.log(`↻ UI Interface handleCardScanned called with: ${cardId}`);
        handleCardScanned(cardId);
      },
    };

    // Set UI references in components
    if (cameraManagerRef.current) {
      cameraManagerRef.current.setUIReference(uiInterface);
    }
    if (vehicleManagerRef.current) {
      vehicleManagerRef.current.setUIReference(uiInterface);
    }
    if (cardReaderRef.current) {
      cardReaderRef.current.setUIReference(uiInterface);
    }
  };

  // Start services
  const startServices = () => {
    if (cameraManagerRef.current) {
      cameraManagerRef.current.startCamera();
    }
    if (cardReaderRef.current) {
      cardReaderRef.current.startCardReader();
    }
  };

  // Bind keyboard shortcuts
  const bindShortcuts = () => {
    const handleKeyDown = (event) => {
      // Only handle on main content (not in input, textarea, etc.)
      const tag = event.target.tagName.toLowerCase();
      if (
        tag === "input" ||
        tag === "textarea" ||
        event.target.isContentEditable
      )
        return;

      // Tab: toggle between management <-> vehicle list
      if (event.key === "Tab") {
        event.preventDefault();
        setActiveTab((prev) => (prev === "management" ? "list" : "management"));
      }
      // Space: switch mode (vao <-> ra)
      if (event.code === "Space" || event.key === " ") {
        event.preventDefault();
        setCurrentMode((prev) => {
          const newMode = prev === "vao" ? "ra" : "vao";
          currentModeRef.current = newMode; // Update ref immediately
          return newMode;
        });
      }
    };
    document.addEventListener("keydown", handleKeyDown);
    return () => document.removeEventListener("keydown", handleKeyDown);
  };

  // Handle mode change
  const handleModeChange = (mode, vehicleType) => {
    setCurrentMode(mode);
    currentModeRef.current = mode; // Update ref immediately
    setCurrentVehicleType(vehicleType);

    // Clear vehicle info
    if (vehicleInfoComponentRef.current) {
      vehicleInfoComponentRef.current.clearVehicleInfo();
    }

    // Reset card reader scanning state
    if (cardReaderRef.current && cardReaderRef.current.resetScanningState) {
      cardReaderRef.current.resetScanningState();
    }

    // Switch camera mode
    if (cameraManagerRef.current) {
      cameraManagerRef.current.switchCamera(mode);
    }

    // Restore capture feeds
    if (cameraComponentRef.current) {
      cameraComponentRef.current.restoreCaptureFeeds();
    }

    // Re-setup connections to ensure all components have updated UI interface
    console.log(`🔄 Mode changed to ${mode}, re-setting up connections`);
    setupConnections();
  };

  // Handle zone change
  const handleZoneChange = (zone) => {
    setCurrentZone(zone);
    if (cameraManagerRef.current && zone) {
      cameraManagerRef.current.loadCameraList(zone.maKhuVuc);
    }
  };

  // Toolbar handlers
  const openCameraConfig = () => setShowCameraConfig(true);
  const openPricingPolicy = () => setShowPricingPolicy(true);
  const openParkingZoneManagement = () => setShowParkingZone(true);
  const openWorkConfig = () => setShowWorkConfig(true);
  const openRfidManager = () => setShowRfidManager(true);
  const openVehicleManagement = () => setShowVehicleManagement(true);
  const openVehicleType = () => setShowVehicleType(true);

  const reloadMainUI = () => {
    window.location.reload();
  };

  const logout = () => {
    if (window.confirm("Bạn có chắc muốn đăng xuất?")) {
      cleanup();
      window.location.reload();
    }
  };

  // Cleanup resources
  const cleanup = () => {
    try {
      if (cameraManagerRef.current) {
        cameraManagerRef.current.stopCamera();
      }
      if (cardReaderRef.current) {
        cardReaderRef.current.stopCardReader();
      }
    } catch (error) {
      console.error("Error during cleanup:", error);
    }
  };

  // Debug function to check card session status
  const debugCheckCardSession = async (cardId) => {
    try {
      console.log(`🔍 DEBUG: Checking session status for card ${cardId}`);
      const { loadPhienGuiXeTheoMaThe, layDanhSachThe } = await import("../../api/api");
      
      // Check if card exists
      const cardList = await layDanhSachThe();
      const cardExists = cardList?.find(card => card.uidThe === cardId);
      console.log(`🔍 DEBUG: Card exists:`, cardExists);
      
      // Check active sessions
      const activeSessions = await loadPhienGuiXeTheoMaThe(cardId);
      console.log(`🔍 DEBUG: Active sessions:`, activeSessions);
      
      return {
        cardExists: !!cardExists,
        activeSessions: activeSessions,
        hasActiveSession: activeSessions && activeSessions.length > 0
      };
    } catch (error) {
      console.error(`🔍 DEBUG: Error checking card session:`, error);
      return { error: error.message };
    }
  };

  // Make debug function available globally for console testing
  useEffect(() => {
    window.debugCheckCardSession = debugCheckCardSession;
    return () => {
      delete window.debugCheckCardSession;
    };
  }, []);

  // Cleanup resources
  const cleanupOld = () => {
    try {
      if (cameraManagerRef.current) {
        cameraManagerRef.current.stopCamera();
      }
      if (cardReaderRef.current) {
        cardReaderRef.current.stopCardReader();
      }
    } catch (error) {
      console.error("Error during cleanup:", error);
    }
  };

  // Handle work config save
  const handleWorkConfigSave = (config) => {
    setWorkConfig(config);
    setCurrentVehicleType(config.loai_xe || "xe_may");
    setShowWorkConfig(false);
  };

  // Calculate estimated parking fee based on pricing policy
  const calculateEstimatedFee = (pricingPolicy) => {
    try {
      if (!pricingPolicy || !pricingPolicy.maChinhSach) {
        return 0;
      }

      // Phí cơ bản từ chính sách
      let baseFee = 0;
      if (typeof pricingPolicy === 'object') {
        baseFee = pricingPolicy.donGia || pricingPolicy.phi || 0;
      } else if (typeof pricingPolicy === 'string') {
        // Fallback for string policy - will need to fetch from API
        baseFee = 5000; // Default fee
      }

      return baseFee;
    } catch (error) {
      console.error("Error calculating estimated fee:", error);
      return 0;
    }
  };

  // Handle card scanning
  const handleCardScanned = async (cardId) => {
    console.log("🔥 handleCardScanned called with cardId:", cardId);
    console.log("🔥 currentModeRef.current:", currentModeRef.current);
    
    const actualMode = currentModeRef.current;
    setScannedCardId(cardId);

    // Step 1: Check if card exists in database
    try {
      if (vehicleInfoComponentRef.current) {
        vehicleInfoComponentRef.current.updateCardReaderStatus(
          "ĐANG KIỂM TRA THẺ...",
          "#f59e0b"
        );
      }

      const { layDanhSachThe, timTheDangCoPhien } = await import(
        "../../api/api"
      );
      const cardList = await layDanhSachThe();

      if (!cardList || !Array.isArray(cardList)) {
        throw new Error("Không thể tải danh sách thẻ");
      }

      const cardExists = cardList.find((card) => card.uidThe === cardId);

      if (!cardExists) {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateCardReaderStatus(
            "THẺ CHƯA ĐĂNG KÝ",
            "#ef4444"
          );
        }

        setShowAddCard({ show: true, cardId: cardId });
        showToast(
          `🔔 Thẻ ${cardId} chưa được đăng ký. Vui lòng thêm thẻ mới.`,
          "warning",
          5000
        );
        return;
      }

      // Step 2: Check if card has active parking session (only for "vao" mode)
      if (actualMode === "vao") {
        if (vehicleInfoComponentRef.current) {
          vehicleInfoComponentRef.current.updateCardReaderStatus(
            "KIỂM TRA PHIÊN GỬI XE...",
            "#f59e0b"
          );
        }

        const activeSession = await timTheDangCoPhien(cardId);

        if (activeSession && activeSession.length > 0) {
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus(
              "THẺ ĐÃ CÓ PHIÊN GỬI XE",
              "#ef4444"
            );
          }
          showToast(
            `❌ Thẻ ${cardId} đã tồn tại trong phiên gửi xe!`,
            "error",
            5000
          );
          return;
        }
      }

      // Update vehicle info with scanned card
      if (vehicleInfoComponentRef.current) {
        vehicleInfoComponentRef.current.updateVehicleInfo({
          ma_the: cardId,
          trang_thai: `Xe ${actualMode === "vao" ? "vào" : "ra"}`,
        });
        vehicleInfoComponentRef.current.updateCardReaderStatus(
          "ĐANG CHỤP ẢNH...",
          "#f59e0b"
        );
      }

      // Step 3: Capture images from camera
      let plateImage = null;
      let faceImage = null;
      let licensePlate = null;

      if (cameraManagerRef.current) {
        try {
          console.log("🔥 About to call captureImage - cameraManagerRef.current:", !!cameraManagerRef.current);
          console.log("🔥 Available methods:", Object.keys(cameraManagerRef.current || {}));
          
          const captureResult = await cameraManagerRef.current.captureImage(cardId, actualMode);
          
          plateImage = captureResult[0];
          licensePlate = captureResult[1]; 
          faceImage = captureResult[2];

          console.log("📸 Image capture result:", {
            plateImage: plateImage ? "có" : "không có",
            plateImageType: typeof plateImage,
            plateImageUrl: plateImage?.url,
            faceImage: faceImage ? "có" : "không có", 
            faceImageType: typeof faceImage,
            faceImageUrl: faceImage?.url,
            licensePlate
          });

          setCapturedImages({
            plateImage: plateImage?.url || plateImage,
            faceImage: faceImage?.url || faceImage,
            plateImageBlob: plateImage?.blob,
            faceImageBlob: faceImage?.blob,
          });

          // Display captured images on camera panels
          if (cameraComponentRef.current) {
            if (plateImage?.url || plateImage) {
              console.log("📺 Displaying plate image:", plateImage?.url || plateImage);
              cameraComponentRef.current.displayCapturedImage(
                plateImage?.url || plateImage,
                1
              );
            } else {
              console.warn("❌ No plate image to display");
            }

            if (faceImage?.url || faceImage) {
              console.log("📺 Displaying face image:", faceImage?.url || faceImage);
              cameraComponentRef.current.displayCapturedFaceImage(
                faceImage?.url || faceImage
              );
            } else {
              console.warn("❌ No face image to display");
            }
          }

          // Update status after capture and display
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus(
              "ẢNH ĐÃ HIỂN THỊ",
              "#10b981"
            );
          }

          // Auto recognize license plate after capture
          let recognizedLicensePlate = null;
          if (plateImage?.blob || capturedImages.plateImageBlob) {
            if (vehicleInfoComponentRef.current) {
              vehicleInfoComponentRef.current.updateCardReaderStatus(
                "ĐANG NHẬN DẠNG BIỂN SỐ...",
                "#f59e0b"
              );
            }

            try {
              const blob = plateImage?.blob || capturedImages.plateImageBlob;
              if (blob) {
                const recognitionResult = await nhanDangBienSo(blob);
                let confidence = 0;

                if (
                  recognitionResult &&
                  recognitionResult.ket_qua &&
                  recognitionResult.ket_qua.length > 0
                ) {
                  const firstResult = recognitionResult.ket_qua[0];

                  if (firstResult.ocr) {
                    if (typeof firstResult.ocr === "string") {
                      const textMatch = firstResult.ocr.match(/text='([^']+)'/);
                      const confMatch =
                        firstResult.ocr.match(/confidence=([0-9.]+)/);

                      if (textMatch) recognizedLicensePlate = textMatch[1];
                      if (confMatch) confidence = parseFloat(confMatch[1]);
                    } else if (typeof firstResult.ocr === "object") {
                      recognizedLicensePlate = firstResult.ocr.text || null;
                      confidence = firstResult.ocr.confidence || 0;
                    }
                  }
                }

                if (recognizedLicensePlate && cameraComponentRef.current) {
                  const direction = actualMode === "vao" ? "in" : "out";
                  cameraComponentRef.current.updateLicensePlateDisplay(
                    recognizedLicensePlate,
                    null,
                    direction
                  );

                  if (vehicleInfoComponentRef.current) {
                    const confidencePercent = (confidence * 100).toFixed(1);
                    vehicleInfoComponentRef.current.updateCardReaderStatus(
                      `BIỂN SỐ: ${recognizedLicensePlate} (${confidencePercent}%)`,
                      "#10b981"
                    );
                  }

                  showToast(
                    `🏷️ Nhận dạng biển số: ${recognizedLicensePlate}`,
                    "success",
                    3000
                  );
                } else {
                  if (vehicleInfoComponentRef.current) {
                    vehicleInfoComponentRef.current.updateCardReaderStatus(
                      "KHÔNG NHẬN DẠNG ĐƯỢC BIỂN SỐ",
                      "#ef4444"
                    );
                  }
                  showToast(`❌ Không nhận dạng được biển số`, "warning", 3000);
                }
              }
            } catch (recognitionError) {
              console.error(
                "Error recognizing license plate:",
                recognitionError
              );
              if (vehicleInfoComponentRef.current) {
                vehicleInfoComponentRef.current.updateCardReaderStatus(
                  "LỖI NHẬN DẠNG BIỂN SỐ",
                  "#ef4444"
                );
              }
              showToast(
                `❌ Lỗi nhận dạng biển số: ${recognitionError.message}`,
                "error",
                4000
              );
            }
          }

          // Step 4: Save parking session for "vao" mode
          if (actualMode === "vao") {
            if (vehicleInfoComponentRef.current) {
              vehicleInfoComponentRef.current.updateCardReaderStatus(
                "ĐANG LƯU PHIÊN GỬI XE...",
                "#f59e0b"
              );
            }

            try {
              const { 
                layChinhSachGiaTheoLoaiPT,
                layDanhSachThe,
                layThongTinLoaiXeTuBienSo, 
                laySlotTrongChoXeLon,
                capNhatTrangThaiChoDo,
                themPhienGuiXeVoiViTri 
              } = await import("../../api/api");
              const {
                validateAndEnsurePricingPolicy,
                themPhienGuiXeWithValidation,
              } = await import("../../utils/sessionValidation");

              // B1: Lấy thông tin thẻ để kiểm tra chính sách đã gán
              let pricingPolicy = null;
              try {
                const cardList = await layDanhSachThe();
                const currentCard = cardList.find(card => card.uidThe === cardId);
                
                if (currentCard && currentCard.maChinhSach && currentCard.maChinhSach.trim() !== '') {
                  // Ưu tiên sử dụng chính sách đã gán cho thẻ
                  pricingPolicy = currentCard.maChinhSach.trim();
                  console.log(`🎯 Sử dụng chính sách từ thẻ: ${pricingPolicy}`);
                } else {
                  console.log(`⚠️ Thẻ ${cardId} chưa có chính sách gán sẵn, sử dụng fallback`);
                }
              } catch (cardError) {
                console.error("Lỗi khi lấy thông tin thẻ:", cardError);
              }

              // B2: Nếu thẻ chưa có chính sách, sử dụng logic cũ (fallback)
              if (!pricingPolicy) {
                // Determine vehicle type based on work config
                let vehicleTypeCode = null;
                if (workConfig?.loai_xe) {
                  const vehicleTypeMapping = {
                    xe_may: "XE_MAY",
                    oto: "OT",
                  };
                  vehicleTypeCode =
                    vehicleTypeMapping[workConfig.loai_xe] || null;
                }

                // Get pricing policy from vehicle type
                let rawPricingPolicy = null;
                if (vehicleTypeCode) {
                  rawPricingPolicy = await layChinhSachGiaTheoLoaiPT(
                    vehicleTypeCode
                  );
                }

                pricingPolicy = validateAndEnsurePricingPolicy(
                  rawPricingPolicy,
                  workConfig?.loai_xe,
                  vehicleTypeCode
                );
              }

              if (!pricingPolicy) {
                throw new Error(
                  "Chưa cấu hình loại xe. Vui lòng mở Cấu Hình Làm Việc và chọn loại xe."
                );
              }

              // Get entry gate by calling API directly
              let entryGate = null;
              let apiSuccess = false;

              try {
                const { layDanhSachKhu } = await import("../../api/api");
                const zonesResponse = await layDanhSachKhu();

                if (zonesResponse && Array.isArray(zonesResponse)) {
                  let actualZoneCode = null;

                  if (typeof workConfig === "object" && workConfig) {
                    actualZoneCode =
                      workConfig.ma_khu_vuc ||
                      workConfig.maKhuVuc ||
                      workConfig.zone_code ||
                      workConfig.zone;
                  } else if (typeof workConfig === "string") {
                    actualZoneCode = workConfig;
                  }

                  if (!actualZoneCode && zonesResponse.length > 0) {
                    actualZoneCode = zonesResponse[0].maKhuVuc;
                  }

                  const currentZone = zonesResponse.find(
                    (z) => z.maKhuVuc === actualZoneCode
                  );

                  if (currentZone?.congVao?.length > 0) {
                    const congVaoFirst = currentZone.congVao[0];
                    entryGate = congVaoFirst.maCong || congVaoFirst.tenCong;
                    apiSuccess = true;
                  }
                }
              } catch (apiError) {
                console.error("Error calling layDanhSachKhu:", apiError);
              }

              // Fallback to workConfig if API failed
              if (!apiSuccess && workConfig?.entry_gate) {
                entryGate = workConfig.entry_gate;
              }

              if (!entryGate) {
                console.warn(
                  "WARNING: entryGate is null. Will proceed without gate info."
                );
              }

              // Fallback: get from pm_nc0007 if no gate found
              if (!entryGate) {
                try {
                  const { layDanhSachCong } = await import("../../api/api");
                  const gateRes = await layDanhSachCong();
                  let gates = gateRes?.data || gateRes || [];
                  if (Array.isArray(gates) && gates.length > 0) {
                    if (zoneInfo?.maKhuVuc) {
                      const zoneGate = gates.find(
                        (g) => g.maKhuVuc === zoneInfo.maKhuVuc
                      );
                      if (zoneGate)
                        entryGate = zoneGate.maCong || zoneGate.tenCong;
                    }
                    if (!entryGate)
                      entryGate = gates[0].maCong || gates[0].tenCong;
                  }
                } catch (err) {
                  console.error("Error getting gates from pm_nc0007:", err);
                }
              }

              // Ưu tiên lấy loại xe từ workConfig, fallback về biển số
              let loaiXe = "0"; // Mặc định xe nhỏ
              let parkingSpot = null;
              let maKhuVuc = null;

              // Lấy mã khu vực hiện tại
              if (typeof workConfig === "object" && workConfig) {
                maKhuVuc = workConfig.ma_khu_vuc || workConfig.maKhuVuc || 
                          workConfig.zone_code || workConfig.zone;
              }

              // Bước 1: Kiểm tra loại xe từ workConfig trước
              if (workConfig?.loai_xe) {
                if (workConfig.loai_xe === "oto") {
                  loaiXe = "1"; // Xe lớn
                  console.log(`🚗 Loại xe từ workConfig: Ô tô (loaiXe = 1)`);
                } else if (workConfig.loai_xe === "xe_may") {
                  loaiXe = "0"; // Xe nhỏ
                  console.log(`🏍️ Loại xe từ workConfig: Xe máy (loaiXe = 0)`);
                }
              } 
              // Bước 2: Nếu không có workConfig, fallback về biển số
              else if (recognizedLicensePlate) {
                console.log(`🚗 WorkConfig không có loại xe, đang kiểm tra từ biển số: ${recognizedLicensePlate}`);
                const thongTinLoaiXe = await layThongTinLoaiXeTuBienSo(recognizedLicensePlate);
                
                if (thongTinLoaiXe.success) {
                  loaiXe = thongTinLoaiXe.loaiXe;
                  console.log(`✅ Loại xe từ biển số: ${loaiXe} (0=xe nhỏ, 1=xe lớn)`);
                } else {
                  console.log(`⚠️ Không tìm thấy loại xe từ biển số, mặc định là xe nhỏ`);
                }
              } else {
                console.log(`⚠️ Không có workConfig và biển số, mặc định là xe nhỏ`);
              }

              // Nếu là xe lớn (loaiXe = "1"), tìm và đặt slot
              if (loaiXe === "1") {
                console.log(`🚗 Xe lớn - đang tìm slot trống...`);
                const slotResult = await laySlotTrongChoXeLon(maKhuVuc);
                
                if (slotResult.success) {
                  parkingSpot = slotResult.maChoDo;
                  console.log(`✅ Đã tìm thấy slot: ${parkingSpot}`);
                  
                  // Cập nhật trạng thái slot thành đã dùng
                  await capNhatTrangThaiChoDo(parkingSpot, "1");
                  console.log(`✅ Đã cập nhật trạng thái slot ${parkingSpot} thành đã dùng`);
                } else {
                  // Không còn slot cho xe lớn
                  if (vehicleInfoComponentRef.current) {
                    vehicleInfoComponentRef.current.updateCardReaderStatus(
                      "KHÔNG CÒN CHỖ ĐỖ CHO XE LỚN",
                      "#ef4444"
                    );
                  }
                  showToast("❌ Không còn chỗ đỗ cho xe lớn!", "error", 5000);
                  return;
                }
              } else {
                console.log(`🏍️ Xe nhỏ - không cần slot cụ thể`);
              }

              // Get entry camera by calling API directly
              let cameraId = null;

              try {
                const { layDanhSachKhu } = await import("../../api/api");
                const zonesResponse = await layDanhSachKhu();

                if (zonesResponse && Array.isArray(zonesResponse)) {
                  let actualZoneCode = null;

                  if (typeof workConfig === "object" && workConfig) {
                    actualZoneCode =
                      workConfig.ma_khu_vuc ||
                      workConfig.maKhuVuc ||
                      workConfig.zone_code ||
                      workConfig.zone;
                  } else if (typeof workConfig === "string") {
                    actualZoneCode = workConfig;
                  }

                  if (!actualZoneCode && zonesResponse.length > 0) {
                    actualZoneCode = zonesResponse[0].maKhuVuc;
                  }

                  const currentZone = zonesResponse.find(
                    (z) => z.maKhuVuc === actualZoneCode
                  );

                  if (currentZone?.cameraVao?.length > 0) {
                    cameraId = currentZone.cameraVao[0].maCamera;
                  }
                }
              } catch (apiError) {
                console.error(
                  "Error calling layDanhSachKhu for camera:",
                  apiError
                );
              }

              if (!cameraId) {
                console.warn(
                  "WARNING: cameraId is null. Camera data may be missing in API payload."
                );
              }

              // Prepare session data
              const sessionData = {
                uidThe: cardId,
                bienSo: recognizedLicensePlate || "",
                chinhSach: pricingPolicy,
                congVao: entryGate,
                gioVao: getCurrentDateTime(), // Sử dụng utility function để lấy thời gian hệ thống
                anhVao: plateImage?.url || plateImage || "",
                anhMatVao: faceImage?.url || faceImage || "",
                trangThai: "TRONG_BAI",
                camera_id: cameraId,
                plate_match: recognizedLicensePlate ? 1 : 0,
                plate: recognizedLicensePlate || "",
                loaiXe: loaiXe,
                viTriGui: parkingSpot, // null cho xe nhỏ, có giá trị cho xe lớn
              };

              // Debug log to check image data
              console.log("🔍 DEBUG sessionData images:", {
                plateImageType: typeof plateImage,
                plateImageValue: plateImage,
                plateImageUrl: plateImage?.url,
                faceImageType: typeof faceImage,
                faceImageValue: faceImage,
                faceImageUrl: faceImage?.url,
                anhVaoInSession: sessionData.anhVao,
                anhMatVaoInSession: sessionData.anhMatVao
              });

              // Validate required fields
              const requiredFields = [
                "uidThe",
                "chinhSach",
                "congVao",
                "gioVao",
              ];
              const missingFields = requiredFields.filter(
                (field) => !sessionData[field]
              );

              if (missingFields.length > 0) {
                throw new Error(
                  `Thiếu thông tin bắt buộc: ${missingFields.join(", ")}`
                );
              }

              // Save session
              const result = await themPhienGuiXeWithValidation(sessionData);

              if (result && result.success) {
                // Calculate estimated parking fee
                const estimatedFee = calculateEstimatedFee(pricingPolicy);

                if (vehicleInfoComponentRef.current) {
                  vehicleInfoComponentRef.current.updateCardReaderStatus(
                    "XE VÀO THÀNH CÔNG",
                    "#10b981"
                  );
                  vehicleInfoComponentRef.current.updateVehicleStatus(
                    "XE ĐÃ VÀO BÃI",
                    "#10b981"
                  );
                  
                  // Update estimated parking fee
                  if (estimatedFee > 0) {
                    vehicleInfoComponentRef.current.updateParkingFee(`${estimatedFee.toLocaleString()} VNĐ (dự kiến)`);
                  }

                  vehicleInfoComponentRef.current.updateVehicleInfo({
                    ma_the: cardId,
                    bien_so: recognizedLicensePlate || "Chưa nhận dạng",
                    vi_tri: parkingSpot,
                    chinh_sach: pricingPolicy,
                    cong_vao: entryGate,
                    trang_thai: "Xe đã vào bãi",
                    phi_du_kien: estimatedFee,
                  });
                }

                // Refresh vehicle list to show new entry
                if (vehicleListComponentRef.current && vehicleListComponentRef.current.refreshVehicleList) {
                  vehicleListComponentRef.current.refreshVehicleList();
                }

                let successMessage = `✅ Xe vào thành công! Thẻ: ${cardId}`;
                if (loaiXe === "1" && parkingSpot) {
                  successMessage += ` | Vị trí: ${parkingSpot}`;
                }

                showToast(successMessage, "success", 5000);

                setTimeout(() => {
                  if (vehicleInfoComponentRef.current) {
                    vehicleInfoComponentRef.current.clearVehicleInfo();
                  }
                  if (cameraComponentRef.current) {
                    cameraComponentRef.current.restoreCaptureFeeds();
                  }
                }, 3000);
              } else {
                throw new Error(
                  result?.message || "Không thể lưu phiên gửi xe"
                );
              }
            } catch (sessionError) {
              console.error("❌ Error saving parking session:", sessionError);
              if (vehicleInfoComponentRef.current) {
                vehicleInfoComponentRef.current.updateCardReaderStatus(
                  "LỖI LƯU PHIÊN GỬI XE",
                  "#ef4444"
                );
              }
              showToast(
                `❌ Lỗi lưu phiên gửi xe: ${sessionError.message}`,
                "error",
                5000
              );
            }
          } else {
            // For "ra" mode, process vehicle exit
            if (vehicleInfoComponentRef.current) {
              vehicleInfoComponentRef.current.updateCardReaderStatus(
                "ĐANG XỬ LÝ XE RA...",
                "#f59e0b"
              );
            }

            try {
              // Find active parking session for this card
              const { loadPhienGuiXeTheoMaThe } = await import("../../api/api");
              console.log(`🔍 Searching for active session for card: ${cardId}`);
              
              let activeSessions;
              try {
                activeSessions = await loadPhienGuiXeTheoMaThe(cardId);
                console.log(`🔍 Active sessions result:`, {
                  type: typeof activeSessions,
                  isArray: Array.isArray(activeSessions),
                  length: activeSessions?.length,
                  content: activeSessions
                });
              } catch (apiError) {
                console.error(`❌ API Error loading sessions for card ${cardId}:`, apiError);
                if (vehicleInfoComponentRef.current) {
                  vehicleInfoComponentRef.current.updateCardReaderStatus(
                    "LỖI TẢI DỮ LIỆU",
                    "#ef4444"
                  );
                }
                showToast(
                  `❌ Lỗi tải dữ liệu phiên gửi xe: ${apiError.message}`,
                  "error",
                  5000
                );
                return;
              }

              if (!activeSessions || activeSessions.length === 0) {
                // No active session found - this card is not currently parked
                console.log(`❌ No active session found for card ${cardId}`);
                console.log(`🔍 API Response:`, activeSessions);
                console.log(`💡 Possible reasons:`);
                console.log(`   1. Card never entered parking lot`);
                console.log(`   2. Card already exited parking lot`);
                console.log(`   3. Database inconsistency`);
                console.log(`🔧 Debug: Run debugCheckCardSession("${cardId}") in console for details`);
                
                if (vehicleInfoComponentRef.current) {
                  vehicleInfoComponentRef.current.updateCardReaderStatus(
                    "THẺ CHƯA CÓ PHIÊN GỬI XE",
                    "#ef4444"
                  );
                  vehicleInfoComponentRef.current.updateVehicleStatus(
                    "KHÔNG TÌM THẤY XE TRONG BÃI",
                    "#ef4444"
                  );
                  vehicleInfoComponentRef.current.updateVehicleInfo({
                    ma_the: cardId,
                    trang_thai: "Thẻ chưa có xe trong bãi",
                    ghi_chu: "Kiểm tra: 1) Thẻ đã vào bãi? 2) Thẻ đã ra bãi rồi?"
                  });
                }
                showToast(
                  `❌ Thẻ ${cardId} không có xe trong bãi. Kiểm tra: đã vào bãi chưa hoặc đã ra rồi?`,
                  "error",
                  10000
                );
                return;
              }

              // Get the most recent active session
              const activeSession = activeSessions[0];

              // Get exit gate and camera by calling API directly
              let exitGate = null;
              let exitCameraId = null;

              try {
                const { layDanhSachKhu } = await import("../../api/api");
                const zonesResponse = await layDanhSachKhu();

                // Find current zone using workConfig
                let actualZoneCode = null;

                if (typeof workConfig === "object" && workConfig) {
                  // Try common field names
                  actualZoneCode =
                    workConfig.ma_khu_vuc ||
                    workConfig.maKhuVuc ||
                    workConfig.zone_code ||
                    workConfig.zone;
                } else if (typeof workConfig === "string") {
                  actualZoneCode = workConfig;
                }

                // Fallback: use first available zone if nothing found
                if (!actualZoneCode && zonesResponse?.length > 0) {
                  actualZoneCode = zonesResponse[0].maKhuVuc;
                }

                // Debug available zones
                if (zonesResponse && Array.isArray(zonesResponse)) {
                  console.log(
                    `🔍 DEBUG XE RA: Available zones:`,
                    zonesResponse.map((z) => ({
                      maKhuVuc: z.maKhuVuc,
                      tenKhuVuc: z.tenKhuVuc,
                    }))
                  );
                }

                const currentZone = zonesResponse.find(
                  (z) => z.maKhuVuc === actualZoneCode
                );

                if (currentZone) {
                  // Get exit gate
                  if (currentZone.congRa && currentZone.congRa.length > 0) {
                    const congRaFirst = currentZone.congRa[0];
                    exitGate =
                      congRaFirst.maCong || congRaFirst.tenCong || null;
                  }

                  // Get exit camera
                  if (currentZone.cameraRa && currentZone.cameraRa.length > 0) {
                    const cameraRaFirst = currentZone.cameraRa[0];
                    exitCameraId = cameraRaFirst.maCamera || null;
                    console.log(
                      `� XE RA: Exit camera từ API cameraRa[0]: ${exitCameraId}`
                    );
                  }
                } else {
                  console.log(
                    `❌ XE RA: Không tìm thấy zone ${actualZoneCode} trong API response`
                  );
                }
              } catch (apiError) {
                console.error(
                  `❌ XE RA: Lỗi gọi API layDanhSachKhu:`,
                  apiError
                );

                // Fallback to workConfig if API fails
                if (workConfig?.exit_gate) {
                  exitGate = workConfig.exit_gate;
                  console.log(
                    `🚪 XE RA: Fallback exit gate từ workConfig: ${exitGate}`
                  );
                }
              }

              console.log(
                `🔍 XE RA: Final Exit Values: exitGate=${exitGate}, exitCameraId=${exitCameraId}`
              );

              // Log warning if values are null but allow processing to continue
              if (!exitGate) {
                console.warn(
                  `⚠️ XE RA: WARNING - exitGate is null. API payload will have null congRa.`
                );
              }

              if (!exitCameraId) {
                console.warn(
                  `⚠️ XE RA: WARNING - exitCameraId is null. Camera data may be missing in API payload.`
                );
              }

              // Check license plates between entry and exit
              const entryPlate = activeSession.bienSo || "";
              const exitPlate = recognizedLicensePlate || "";

              const shouldShowConfirmDialog =
                (entryPlate && exitPlate && entryPlate !== exitPlate) ||
                (entryPlate && !exitPlate) ||
                (!entryPlate && exitPlate);

              if (shouldShowConfirmDialog) {
                setShowLicensePlateConfirm({
                  show: true,
                  entryData: {
                    faceImage: activeSession.anhMatVao || null,
                  },
                  exitData: {
                    faceImage: faceImage?.url || faceImage || null,
                  },
                  originalPlate: entryPlate,
                  detectedPlate: exitPlate,
                  activeSession,
                  exitGate,
                  exitCameraId,
                  plateImage,
                  faceImage,
                });

                return;
              }

              // Nếu biển số khớp hoặc không có vấn đề, tiếp tục xử lý bình thường
              await processVehicleExit(
                activeSession,
                exitGate,
                exitCameraId,
                plateImage,
                faceImage,
                recognizedLicensePlate,
                cardId,
                workConfig
              );
            } catch (exitError) {
              console.error("❌ Error processing vehicle exit:", exitError);
              if (vehicleInfoComponentRef.current) {
                vehicleInfoComponentRef.current.updateCardReaderStatus(
                  "LỖI XỬ LÝ XE RA",
                  "#ef4444"
                );
              }
              showToast(
                `❌ Lỗi xử lý xe ra: ${exitError.message}`,
                "error",
                5000
              );

              // Still show captured images even if exit processing fails
              const saveMessage = environmentInfo?.isElectron
                ? `⚠️ Đã lưu ảnh nhưng có lỗi xử lý xe ra cho thẻ: ${cardId}`
                : `⚠️ Đã download ảnh nhưng có lỗi xử lý xe ra cho thẻ: ${cardId}`;

              showToast(saveMessage, "warning", 4000);
            }
          }
        } catch (error) {
          console.error("❌ Error in card scanning process:", error);
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus(
              "LỖI XỬ LÝ THẺ",
              "#ef4444"
            );
          }
          showToast(`❌ Lỗi xử lý thẻ: ${error.message}`, "error", 5000);
        }
      }
    } catch (error) {
      console.error("❌ Error capturing images:", error);
      if (vehicleInfoComponentRef.current) {
        vehicleInfoComponentRef.current.updateCardReaderStatus(
          "LỖI CHỤP ẢNH",
          "#ef4444"
        );
      }
      showToast(
        `❌ Lỗi chụp ảnh cho thẻ: ${cardId} (${actualMode})`,
        "error",
        5000
      );
    }
  };

  // Process vehicle exit after license plate confirmation
  const processVehicleExit = async (
    activeSession,
    exitGate,
    exitCameraId,
    plateImage,
    faceImage,
    recognizedLicensePlate,
    cardId,
    workConfig = null
  ) => {
    try {
      const { capNhatPhienGuiXe, tinhPhiGuiXe } = await import("../../api/api");

      const exitSessionData = {
        maPhien: activeSession.maPhien,
        congRa: exitGate,
        gioRa: getCurrentDateTime(), // Sử dụng utility function để lấy thời gian hệ thống
        anhRa: plateImage?.url || plateImage || "",
        anhMatRa: faceImage?.url || faceImage || "",
        camera_id: exitCameraId,
        plate_match: recognizedLicensePlate ? 1 : 0,
        plate: recognizedLicensePlate || "",
      };

      const updateResult = await capNhatPhienGuiXe(exitSessionData);

      if (updateResult && updateResult.success) {
        // Calculate parking fee
        try {
          const feeResult = await tinhPhiGuiXe(activeSession.maPhien, cardId);
          let parkingFee = 0;
          let parkingDuration = 0;

          if (feeResult && feeResult.success) {
            parkingFee = feeResult.phi || feeResult.fee || 0;
            parkingDuration = feeResult.tongPhut || feeResult.duration || 0;
          }

          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus(
              "XE RA THÀNH CÔNG",
              "#10b981"
            );
            vehicleInfoComponentRef.current.updateVehicleStatus(
              "XE ĐÃ RA KHỎI BÃI",
              "#10b981"
            );
            
            // Update vehicle info with exit details INCLUDING fee
            console.log(`Main flow: Updating vehicle info with exit details and fee`);
            vehicleInfoComponentRef.current.updateVehicleInfo({
              ma_the: cardId,
              ma_phien: activeSession.maPhien, // Add session ID for fee calculation
              bien_so:
                recognizedLicensePlate ||
                activeSession.bienSo ||
                "Chưa nhận dạng",
              vi_tri: activeSession.viTriGui || null, // Không có default
              cong_ra: exitGate,
              thoi_gian_gui: parkingDuration ? `${parkingDuration} phút` : null, // Không có default
              phi_gui_xe: parkingFee, // This will be handled by updateVehicleInfo
              trang_thai: "Xe đã ra khỏi bãi",
            });
            
            // Also explicitly update parking fee display for extra safety
            const formattedFee = parkingFee > 0 ? `${parkingFee.toLocaleString()} VNĐ` : "0 VNĐ";
            console.log(`Main flow: Also explicitly updating parking fee display to ${formattedFee}`);
            vehicleInfoComponentRef.current.updateParkingFee(formattedFee);
          }

          // Refresh vehicle list to show updated exit
          if (vehicleListComponentRef.current && vehicleListComponentRef.current.refreshVehicleList) {
            vehicleListComponentRef.current.refreshVehicleList();
          }

          // Update license plate display with fee
          if (cameraComponentRef.current && recognizedLicensePlate) {
            cameraComponentRef.current.updateLicensePlateDisplay(
              recognizedLicensePlate,
              parkingFee,
              "out"
            );
          }

          const feeText =
            parkingFee > 0
              ? ` | Phí: ${new Intl.NumberFormat("vi-VN", {
                  style: "currency",
                  currency: "VND",
                }).format(parkingFee)}`
              : "";
          showToast(
            `✅ Xe ra thành công! Thẻ: ${cardId}${feeText}`,
            "success",
            5000
          );
        } catch (feeError) {
          console.error("Error calculating parking fee:", feeError);
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus(
              "XE RA THÀNH CÔNG (CHƯA TÍNH PHÍ)",
              "#f59e0b"
            );
            vehicleInfoComponentRef.current.updateVehicleStatus(
              "XE ĐÃ RA KHỎI BÃI",
              "#10b981"
            );
          }
          showToast(
            `✅ Xe ra thành công! Thẻ: ${cardId} (Lỗi tính phí: ${feeError.message})`,
            "warning",
            5000
          );
        }

        // Show success info for 5 seconds before clearing
        setTimeout(() => {
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.clearVehicleInfo();
          }
          // Restore camera feeds
          if (cameraComponentRef.current) {
            cameraComponentRef.current.restoreCaptureFeeds();
          }
        }, 5000);
      } else {
        throw new Error(
          updateResult?.message || "Không thể cập nhật phiên gửi xe"
        );
      }
    } catch (error) {
      console.error("❌ Error processing vehicle exit:", error);
      if (vehicleInfoComponentRef.current) {
        vehicleInfoComponentRef.current.updateCardReaderStatus(
          "LỖI XỬ LÝ XE RA",
          "#ef4444"
        );
      }
      showToast(`❌ Lỗi xử lý xe ra: ${error.message}`, "error", 5000);
    }
  };

  // Handle license plate confirmation from modal
  const handleLicensePlateConfirm = async (result) => {
    const { activeSession, exitGate, exitCameraId, plateImage, faceImage } =
      showLicensePlateConfirm;
    const cardId = activeSession.uidThe;

    setShowLicensePlateConfirm(false);

    if (result.confirmed) {
      const correctedLicensePlate = result.licensePlate;

      await processVehicleExit(
        activeSession,
        exitGate,
        exitCameraId,
        plateImage,
        faceImage,
        correctedLicensePlate,
        cardId,
        workConfig
      );
    } else {
      showToast("Đã hủy xử lý xe ra", "info", 3000);

      if (cameraComponentRef.current) {
        cameraComponentRef.current.restoreCaptureFeeds();
      }
    }
  };

  // Close image capture modal
  const handleCloseImageModal = () => {
    setShowImageCaptureModal(false);
    setCapturedImages({
      plateImage: null,
      faceImage: null,
      plateImageBlob: null,
      faceImageBlob: null,
    });
    setScannedCardId("");

    cleanupObjectUrls();
  };

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
              <span className="config-vehicle">
                {workConfig.vehicle_type?.toUpperCase()}
              </span>
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
          <button className="toolbar-btn" onClick={openVehicleManagement}>
            PHƯƠNG TIỆN
          </button>
          <button className="toolbar-btn" onClick={openVehicleType}>
            LOẠI XE
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
            <CameraComponent
              ref={cameraComponentRef}
              currentMode={currentMode}
              zoneInfo={zoneInfo}
            />
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
            workConfig={workConfig}
            onVehicleSelect={(vehicle) => {
              console.log("Selected vehicle:", vehicle);
            }}
          />
        </div>
      </div>

      {/* Hidden Logic Components */}
      <div style={{ display: "none" }}>
        <QuanLyCamera ref={cameraManagerRef} />
        <QuanLyXe
          ref={vehicleManagerRef}
          loaiXe={workConfig?.loai_xe || currentVehicleType === "oto" ? 1 : 0}
          workConfig={workConfig}
        />
        <DauDocThe 
          ref={cardReaderRef} 
          currentMode={currentMode}
        />
      </div>

      {/* Dialogs */}
      {showWorkConfig && (
        <WorkConfigDialog
          onClose={() => setShowWorkConfig(false)}
          onConfigSaved={handleWorkConfigSave}
        />
      )}

      {showCameraConfig && (
        <CameraConfigDialog
          onClose={() => setShowCameraConfig(false)}
          onSave={(config) => {
            console.log("Camera config saved:", config);
            setShowCameraConfig(false);
            // Reload zone info to get updated cameras
            if (workConfig && workConfig.zone) {
              loadZoneInfo(workConfig.zone);
            }
          }}
        />
      )}

      {showPricingPolicy && (
        <PricingPolicyDialog onClose={() => setShowPricingPolicy(false)} />
      )}

      {showParkingZone && (
        <ParkingZoneDialog onClose={() => setShowParkingZone(false)} />
      )}

      {showRfidManager && (
        <RfidManagerDialog
          onClose={() => setShowRfidManager(false)}
          onSave={() => {
            console.log("RFID cards updated");
            setShowRfidManager(false);
          }}
        />
      )}

      {showVehicleManagement && (
        <VehicleManagementDialog
          onClose={() => setShowVehicleManagement(false)}
        />
      )}

      {showVehicleType && (
        <VehicleTypeDialog
          onClose={() => setShowVehicleType(false)}
        />
      )}

      {showAddCard && showAddCard.show && (
        <ThemTheDialog
          cardId={showAddCard.cardId}
          onClose={() => setShowAddCard(false)}
          onSave={(cardData) => {
            console.log("Card added:", cardData);
            setShowAddCard(false);
          }}
        />
      )}

      {showLicensePlateError && showLicensePlateError.show && (
        <BienSoLoiDialog
          {...showLicensePlateError}
          onClose={() => setShowLicensePlateError(false)}
          onConfirm={(result) => {
            console.log("License plate error result:", result);
            setShowLicensePlateError(false);
          }}
        />
      )}

      {/* License Plate Confirm Dialog */}
      {showLicensePlateConfirm && (
        <LicensePlateConfirmDialog
          isOpen={!!showLicensePlateConfirm}
          onClose={() => setShowLicensePlateConfirm(false)}
          onConfirm={handleLicensePlateConfirm}
          entryData={{
            faceImage: showLicensePlateConfirm.entryData?.faceImage,
          }}
          exitData={{
            faceImage: showLicensePlateConfirm.exitData?.faceImage,
          }}
          detectedPlate={showLicensePlateConfirm.detectedPlate || ""}
          originalPlate={showLicensePlateConfirm.originalPlate || ""}
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
  );
};

export default MainUI;
