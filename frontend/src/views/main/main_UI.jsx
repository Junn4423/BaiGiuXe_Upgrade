"use client";

import { useEffect, useRef, useState, useMemo } from "react";
import { getCurrentDateTime } from "../../utils/timeUtils";
import "../../assets/styles/main_UI.css";
import CameraComponent from "../../components/CameraComponent";
import VehicleInfoComponent from "../../components/VehicleInfoComponent";
import VehicleListComponent from "../../components/VehicleListComponent";
import QuanLyCamera from "../../components/QuanLyCamera";
import QuanLyXe from "../../components/QuanLyXe";
import DauDocThe from "../../components/DauDocThe";
import {
  nhanDangBienSo,
  extractFilenameFromImageUrl,
  constructImageUrlFromFilename,
  layThongTinLoaiXeTuBienSo,
  laySlotTrongChoXeLon,
  capNhatTrangThaiChoDo,
  restartCameraSystem,
} from "../../api/api";
import { useUser } from "../../utils/userContext";
import BienSoLoiDialog from "../dialogs/BienSoLoiDialog";
import CameraConfigDialog from "../dialogs/CameraConfigDialog";
import ParkingZoneDialog from "../dialogs/ParkingZoneDialog";
import PricingPolicyDialog from "../dialogs/PricingPolicyDialog";
import RfidManagerDialog from "../dialogs/RfidManagerDialogClean";
import ThemTheDialog from "../dialogs/ThemTheDialog";
import WorkConfigDialog from "../dialogs/WorkConfigDialog";
import VehicleManagementDialog from "../dialogs/VehicleManagementDialog";
import VehicleTypeDialog from "../dialogs/VehicleTypeDialog";
import EmployeePermissionDialog from "../dialogs/EmployeePermissionDialog";
import ImageCaptureModal from "../../components/ImageCaptureModal";
import LicensePlateConfirmDialog from "../../components/LicensePlateConfirmDialog";
import AttendanceDialog from "../../components/AttendanceDialog";
import { useToast } from "../../components/Toast";
import BackgroundUploadManager from "../../components/BackgroundUploadManager";
import { layDanhSachCamera, layDanhSachKhu } from "../../api/api";
import {
  cleanupObjectUrls,
  getEnvironmentInfo,
  initializeStorageCleanup,
} from "../../utils/imageUtils";
import { layALLLoaiPhuongTien, relayTestSequence } from "../../api/api";
import StatisticsPage from "../../components/StatisticsPage";
import SystemSettings from "../SystemSettings";
import { processAttendanceImage } from "../../api/apiChamCong";
import { layDanhSachPhuongTien } from "../../api/api";
import faceAPI from "../../api/apiFaceRecognition";
const MainUI = () => {
  const { showToast, ToastContainer } = useToast();

  // User context để lấy thông tin quyền hạn
  const {
    currentUser,
    permissions,
    hasPermission,
    isAdmin,
    logout: contextLogout,
  } = useUser();

  // Debug log quyền hạn khi có thay đổi
  useEffect(() => {
    if (currentUser) {
      console.log("Thông tin người dùng hiện tại:", currentUser);
      console.log("Quyền hạn hiện tại:", permissions);
      console.log("Là admin:", isAdmin());

      // Show permission toast
      const permissionStatus = isAdmin()
        ? "Quyền Admin - Truy cập tất cả chức năng"
        : "Quyền User - Một số chức năng bị hạn chế";
      showToast(permissionStatus, isAdmin() ? "success" : "warning", 4000);
    }
  }, [currentUser, permissions]);

  // State management
  const [activeTab, setActiveTab] = useState("management");
  const [currentMode, setCurrentMode] = useState("vao");
  const currentModeRef = useRef("vao"); // Add ref to track current mode
  const [currentVehicleType, setCurrentVehicleType] = useState("xe_may");
  const [currentZone, setCurrentZone] = useState(null);
  const [workConfig, setWorkConfig] = useState(null);
  const [zoneInfo, setZoneInfo] = useState(null);

  // Keep ref in sync with state
  useEffect(() => {
    currentModeRef.current = currentMode;
  }, [currentMode]);

  // Set currentMode based on workConfig layout mode
  useEffect(() => {
    if (workConfig?.default_mode) {
      const layoutMode = workConfig.default_mode;
      if (layoutMode === "vao") {
        setCurrentMode("vao");
      } else if (layoutMode === "ra") {
        setCurrentMode("ra");
      }
      // For "2luong" mode, keep dynamic switching behavior
    }
  }, [workConfig]);

  // Component refs
  const cameraManagerRef = useRef();
  const vehicleManagerRef = useRef();
  const cardReaderRef = useRef();
  const cameraComponentRef = useRef();
  const vehicleInfoComponentRef = useRef();
  const vehicleListComponentRef = useRef();

  // Reset key for camera components (to force cleanup on logout/login)
  const [cameraResetKey, setCameraResetKey] = useState(0);

  // Dialog states
  const [showCameraConfig, setShowCameraConfig] = useState(false);
  const [showPricingPolicy, setShowPricingPolicy] = useState(false);
  const [showParkingZone, setShowParkingZone] = useState(false);
  const [showWorkConfig, setShowWorkConfig] = useState(false);
  const [showAddCard, setShowAddCard] = useState(false);
  const [showLicensePlateError, setShowLicensePlateError] = useState(false);
  const [showRfidManager, setShowRfidManager] = useState(false);
  const [autoOpenAddCard, setAutoOpenAddCard] = useState(false);
  const [prefilledCardId, setPrefilledCardId] = useState("");
  const [showLicensePlateConfirm, setShowLicensePlateConfirm] = useState(false);
  const [showVehicleManagement, setShowVehicleManagement] = useState(false);
  const [showVehicleType, setShowVehicleType] = useState(false);
  const [showEmployeePermission, setShowEmployeePermission] = useState(false);
  const [showStatistics, setShowStatistics] = useState(false);
  const [showAttendance, setShowAttendance] = useState(false);
  const [showSystemSettings, setShowSystemSettings] = useState(false);

  // Card scanning and image capture
  const [showImageCaptureModal, setShowImageCaptureModal] = useState(false);
  const [capturedImages, setCapturedImages] = useState({
    plateImage: null,
    faceImage: null,
    plateImageBlob: null,
    faceImageBlob: null,
  });

  // Auto face recognition monitoring
  const [autoFaceRecognitionEnabled, setAutoFaceRecognitionEnabled] =
    useState(true);
  const [isRestartingCamera, setIsRestartingCamera] = useState(false); // NEW: Track camera restart state
  const [restartMessage, setRestartMessage] = useState(""); // NEW: Track restart progress message
  const [lastProcessedPlate, setLastProcessedPlate] = useState("");
  const [vehicleDatabase, setVehicleDatabase] = useState([]); // Cache pm_nc0002 data
  const [isProcessingFace, setIsProcessingFace] = useState(false); // For UI indicator
  const plateMonitoringRef = useRef(null);
  const processingFaceRef = useRef(false);
  const [scannedCardId, setScannedCardId] = useState("");
  const [imagesSavedToDisc, setImagesSavedToDisc] = useState(false); // **NEW: Track if images are saved to disc**
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

  // Debug workConfig state changes
  useEffect(() => {
    console.log("WorkConfig state changed:", workConfig);
    if (workConfig) {
      console.log("Current workConfig.loai_xe:", workConfig.loai_xe);
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
            `Electron App: Ảnh sẽ tự động lưu vào ${envInfo.saveLocation}`,
            "success",
            1000
          );
        } else {
          showToast(`Web App: Ảnh sẽ được download tự động`, "info", 4000);
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
        console.log("F2 pressed - testing card scan with ID:", testCardId);
        handleCardScanned(testCardId);
      } else if (
        event.key === "F12" ||
        (event.ctrlKey && event.key === "F12")
      ) {
        event.preventDefault();
        setShowStatistics((prev) => !prev);
      }
    };

    window.addEventListener("keydown", handleKeyDown);
    return () => window.removeEventListener("keydown", handleKeyDown);
  }, []);

  // Load work configuration
  const loadWorkConfig = () => {
    try {
      const savedConfig = localStorage.getItem("work_config");
      console.log("Loading work config from localStorage:", savedConfig);

      if (savedConfig) {
        const config = JSON.parse(savedConfig);
        console.log("Parsed work config:", config);
        console.log("Vehicle type in config:", config.loai_xe);

        // Ensure state update happens in next tick
        setWorkConfig(config);
        setCurrentVehicleType(config.loai_xe || "xe_may");
        setCurrentMode(config.default_mode || "vao");

        // Additional log after state update
        console.log("WorkConfig state will be updated to:", config);

        // Force verify the state was set
        setTimeout(() => {
          console.log("Verifying workConfig state after 100ms delay...");
          console.log("workConfig state is:", workConfig);
          if (!workConfig && savedConfig) {
            console.warn("workConfig state is still null, forcing re-parse...");
            const reparsedConfig = JSON.parse(savedConfig);
            setWorkConfig(reparsedConfig);
          }
        }, 100);
      } else {
        console.log(
          "No work config found in localStorage, using default config"
        );
        // setShowWorkConfig(true); // Hidden as requested
      }
    } catch (error) {
      console.error("Error loading work config:", error);
      // setShowWorkConfig(true); // Hidden as requested
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

  // Load vehicle database for auto face recognition
  const loadVehicleDatabase = async () => {
    try {
      const vehicleList = await layDanhSachPhuongTien();
      if (Array.isArray(vehicleList)) {
        setVehicleDatabase(vehicleList);
        console.log(`📋 Loaded ${vehicleList.length} vehicles from pm_nc0002`);
      }
    } catch (error) {
      console.error("❌ Error loading vehicle database:", error);
    }
  };

  // Check if license plate exists in vehicle database
  const checkLicensePlateInDatabase = (licensePlate) => {
    if (!licensePlate || !Array.isArray(vehicleDatabase)) return null;

    const normalizedPlate = licensePlate.trim().toUpperCase();
    return vehicleDatabase.find(
      (v) => (v.bienSo || v.lv001 || "").toUpperCase() === normalizedPlate
    );
  };

  // Capture face image from camera stream (temporary, no save)
  const captureTempFaceImage = async () => {
    try {
      if (!cameraManagerRef.current) {
        console.log("❌ Camera manager not available");
        return null;
      }

      const tempCardId = `temp_${Date.now()}`;
      const mode = currentMode === "vao" ? "vao" : "ra";

      console.log("📸 Capturing temp face image...");

      // Use the same capture method as normal flow
      const captureResult = await cameraManagerRef.current.captureImage(
        tempCardId,
        mode
      );

      // Extract face image from result
      const faceImage = captureResult[2]; // faceImage is at index 2

      if (faceImage?.blob) {
        console.log("✅ Temp face image captured successfully");
        return faceImage;
      } else {
        console.log("❌ No face image blob in capture result");
        return null;
      }
    } catch (error) {
      console.error("❌ Error capturing temp face image:", error);
      return null;
    }
  };

  // Process face recognition for detected license plate
  const processFaceRecognition = async (licensePlate, vehicleInfo) => {
    if (processingFaceRef.current) {
      console.log("🔄 Face recognition already in progress, skipping...");
      return;
    }

    processingFaceRef.current = true;
    setIsProcessingFace(true);
    console.log(`🎯 Processing face recognition for: ${licensePlate}`);

    // **MỚI: Kiểm tra nếu là khách vãng lai thì bỏ qua nhận diện khuôn mặt**
    const ownerName = vehicleInfo?.tenChuXe || vehicleInfo?.lv003 || "";
    if (ownerName.trim().toLowerCase() === "khách vãng lai") {
      console.log(
        `🚫 Bỏ qua nhận diện khuôn mặt cho biển số ${licensePlate} - Khách vãng lai: ${ownerName}`
      );
      processingFaceRef.current = false;
      setIsProcessingFace(false);
      return;
    }

    let tempImageUrl = null;
    try {
      // Capture temp face image
      const faceImage = await captureTempFaceImage();
      if (!faceImage?.blob) {
        console.log("❌ No face image captured");
        return;
      }

      tempImageUrl = faceImage.url; // Store for cleanup

      // Send to face recognition service
      const recognizeResult = await faceAPI.recognizeFace(faceImage.blob);

      if (
        recognizeResult.success &&
        recognizeResult.faces &&
        recognizeResult.faces.length > 0
      ) {
        const recognizedFace = recognizeResult.faces[0];
        if (
          recognizedFace.name &&
          recognizedFace.employee_id &&
          recognizedFace.confidence
        ) {
          console.log("✅ Face recognized:", recognizedFace);

          // ✅ KIỂM TRA CHÍNH XÁC: Biển số detected phải khớp với employee_id
          const faceEmployeeId = (recognizedFace.employee_id || "")
            .toUpperCase()
            .trim();
          const detectedPlate = (licensePlate || "").toUpperCase().trim();

          if (faceEmployeeId === detectedPlate) {
            console.log(
              "✅ PERFECT MATCH: Face employee_id matches detected plate:",
              {
                detectedPlate: detectedPlate,
                faceEmployeeId: faceEmployeeId,
                ownerName: recognizedFace.name,
                confidence: recognizedFace.confidence,
              }
            );

            // Show welcome toast
            const welcomeMessage = `Xin chào ${recognizedFace.name}, biển số: ${recognizedFace.employee_id}, đang mở cổng`;
            showToast && showToast(welcomeMessage, "success", 5000);

            // Trigger relay sequence
            try {
              if (
                typeof window !== "undefined" &&
                window.electronAPI &&
                window.electronAPI.relayControl
              ) {
                await relayTestSequence(1, 1000);
                console.log("✅ Relay sequence activated");
                showToast &&
                  showToast("🎛️ Đã kích hoạt cổng tự động", "info", 3000);
              } else {
                console.warn("⚠️ Relay control not available");
              }
            } catch (relayError) {
              console.error("❌ Relay error:", relayError);
            }
          } else {
            console.log(
              `❌ PLATE MISMATCH: Detected plate "${detectedPlate}" != Face employee_id "${faceEmployeeId}" - SKIPPING gate activation`
            );
            showToast &&
              showToast(
                `Biển số không khớp với khuôn mặt: ${detectedPlate} != ${faceEmployeeId}`,
                "warning",
                4000
              );
          }
        }
      } else {
        console.log("❌ No face recognized or invalid response");
      }
    } catch (error) {
      console.error("❌ Face recognition error:", error);
    } finally {
      // Clean up temp image blob and URL to save memory
      if (tempImageUrl) {
        try {
          URL.revokeObjectURL(tempImageUrl);
          console.log("🧹 Cleaned up temp image URL");
        } catch (e) {
          console.warn("⚠️ Warning cleaning up temp image:", e);
        }
      }

      processingFaceRef.current = false;
      setIsProcessingFace(false);
    }
  };

  // Monitor plate-text changes
  const startPlateMonitoring = () => {
    if (plateMonitoringRef.current) {
      clearInterval(plateMonitoringRef.current);
    }

    console.log(
      "🔍 Starting plate monitoring with vehicle database:",
      vehicleDatabase.length,
      "vehicles"
    );
    plateMonitoringRef.current = setInterval(() => {
      if (!autoFaceRecognitionEnabled || processingFaceRef.current) return;

      try {
        const plateTextDiv = document.querySelector(".plate-text");
        if (!plateTextDiv || !plateTextDiv.textContent) return;

        const currentPlate = plateTextDiv.textContent.trim();
        if (!currentPlate || currentPlate === "" || currentPlate === "N/A")
          return;

        // Skip if same as last processed plate (avoid duplicate processing)
        if (currentPlate === lastProcessedPlate) return;

        // ✅ STRICT CHECK: Only process if plate exists EXACTLY in database
        const vehicleInfo = checkLicensePlateInDatabase(currentPlate);
        if (vehicleInfo) {
          // ✅ EXACT MATCH: Verify the plate matches exactly
          const registeredPlate = (
            vehicleInfo.bienSo ||
            vehicleInfo.lv001 ||
            ""
          ).toUpperCase();
          const detectedPlate = currentPlate.toUpperCase();

          if (registeredPlate === detectedPlate) {
            console.log(
              `🎯 EXACT MATCH: License plate ${currentPlate} found in database:`,
              {
                owner: vehicleInfo.tenChuXe || vehicleInfo.lv003,
                type: vehicleInfo.maLoaiPT || vehicleInfo.lv002,
                registeredPlate: registeredPlate,
              }
            );
            setLastProcessedPlate(currentPlate);
            processFaceRecognition(currentPlate, vehicleInfo);
          } else {
            console.log(
              `⚠️ PLATE MISMATCH: Detected "${detectedPlate}" but registered "${registeredPlate}" - SKIPPING`
            );
            setLastProcessedPlate(currentPlate);
          }
        } else {
          // Only log once per plate to avoid spam
          if (currentPlate !== lastProcessedPlate) {
            console.log(
              `ℹ️ License plate ${currentPlate} not found in database - SKIPPING face recognition`
            );
            setLastProcessedPlate(currentPlate);
          }
        }
      } catch (error) {
        console.error("❌ Plate monitoring error:", error);
      }
    }, 1500); // Check every 1.5 seconds for better responsiveness
  };

  // Load vehicle database on component mount
  useEffect(() => {
    loadVehicleDatabase();
  }, []);

  // Start/stop plate monitoring based on auto face recognition setting
  useEffect(() => {
    if (autoFaceRecognitionEnabled && vehicleDatabase.length > 0) {
      console.log("🔍 Starting auto license plate monitoring...");
      startPlateMonitoring();
    } else {
      if (plateMonitoringRef.current) {
        clearInterval(plateMonitoringRef.current);
        plateMonitoringRef.current = null;
        console.log("⏹️ Stopped license plate monitoring");
      }
    }

    // Cleanup on unmount
    return () => {
      if (plateMonitoringRef.current) {
        clearInterval(plateMonitoringRef.current);
      }
    };
  }, [autoFaceRecognitionEnabled, vehicleDatabase]);

  // Reload vehicle database periodically (every 5 minutes)
  useEffect(() => {
    const reloadInterval = setInterval(() => {
      loadVehicleDatabase();
    }, 5 * 60 * 1000);

    return () => clearInterval(reloadInterval);
  }, []);

  // Setup connections between components
  const setupConnections = () => {
    const uiInterface = {
      // Dynamic getters for current state
      get currentMode() {
        return currentMode;
      },
      get currentVehicleType() {
        return currentVehicleType;
      },
      get currentZone() {
        return currentZone;
      },
      get workConfig() {
        return workConfig;
      },

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
      showLicensePlateErrorDialog: (data) => {
        return new Promise((resolve) => {
          const handleDialogConfirm = (result) => {
            setShowLicensePlateError(false);
            resolve(result);
          };

          setShowLicensePlateError({
            show: true,
            ...data,
            onConfirm: handleDialogConfirm,
          });
        });
      },

      // Utility methods
      showNotification: (title, message) => {
        // Show as toast warning for camera fallback issues
        if (title.includes("Camera") || message.includes("camera")) {
          showToast(`${message}`, "warning", 6000);
        }
      },
      showError: (title, message) => {
        console.error(`Error: ${title} - ${message}`);
        showToast(`${title}: ${message}`, "error", 5000);
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

      if (event.key === "Tab") {
        event.preventDefault();
        setActiveTab((prev) => (prev === "management" ? "list" : "management"));
      }
      // Space: switch mode (vao <-> ra) - only for dual lane mode
      if (event.code === "Space" || event.key === " ") {
        event.preventDefault();

        // Check if spacebar switching is allowed (only for dual lane mode)
        let layoutMode = workConfig?.default_mode;

        // Backup: check localStorage directly if workConfig not loaded yet
        if (!layoutMode) {
          try {
            const savedConfig = localStorage.getItem("work_config");
            if (savedConfig) {
              const config = JSON.parse(savedConfig);
              layoutMode = config.default_mode || "2luong";
            } else {
              layoutMode = "2luong"; // default fallback
            }
          } catch (e) {
            layoutMode = "2luong"; // default fallback on error
          }
        }

        if (layoutMode === "2luong") {
          setCurrentMode((prev) => {
            const newMode = prev === "vao" ? "ra" : "vao";
            currentModeRef.current = newMode; // Update ref immediately
            return newMode;
          });
        } else {
          // For entry and exit modes, spacebar switching is disabled
          console.log(
            `Spacebar switching disabled for ${layoutMode} mode. Please restart and login to change mode.`
          );
          showToast(
            "Không thể chuyển chế độ bằng phím cách. Vui lòng khởi động lại và đăng nhập để thay đổi chế độ.",
            "warning"
          );
        }
      }
      // Debug: D key to debug workConfig
      if (event.key === "d" || event.key === "D") {
        event.preventDefault();
        debugWorkConfig();
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
    console.log(`Mode changed to ${mode}, re-setting up connections`);
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
  const openEmployeePermission = () => setShowEmployeePermission(true);
  const openSystemSettings = () => setShowSystemSettings(true);

  // Check if RTSP server is ready
  const checkRTSPServerReady = async () => {
    try {
      console.log("🔍 Checking RTSP server readiness...");

      // Try to connect to RTSP server health check endpoint
      const response = await fetch("http://localhost:9999/health", {
        method: "GET",
        timeout: 3000,
      });

      if (response.ok) {
        console.log("✅ RTSP server is ready");
        return true;
      } else {
        console.log("⚠️ RTSP server responded but not ready");
        return false;
      }
    } catch (error) {
      console.log("❌ RTSP server not ready:", error.message);
      return false;
    }
  };

  // Handle camera system restart
  const handleRestartCameraSystem = async () => {
    if (isRestartingCamera) return; // Prevent multiple clicks

    // Confirm dialog
    const confirmRestart = window.confirm(
      "Bạn có chắc muốn khởi động lại toàn bộ hệ thống camera?\n\n" +
        "Điều này sẽ:\n" +
        "• Khởi động lại RTSP Streaming Server\n" +
        "• Khởi động lại Face Recognition Service\n" +
        "• Khởi động lại ALPR Service\n" +
        "• Reset toàn bộ màn hình\n\n" +
        "Quá trình này có thể mất 15-20 giây."
    );

    if (!confirmRestart) {
      return;
    }

    try {
      setIsRestartingCamera(true);
      setRestartMessage("Đang khởi động lại camera services...");
      showToast("🔄 Đang khởi động lại hệ thống camera...", "info", 3000);

      const result = await restartCameraSystem();

      if (result.success) {
        setRestartMessage("Camera services đã restart thành công!");
        showToast("✅ " + result.message, "success", 3000);

        // Wait longer for RTSP server to be fully ready
        setTimeout(() => {
          setRestartMessage("Đang kiểm tra RTSP server...");

          // Check if RTSP server is ready before resetting screen
          checkRTSPServerReady().then((isReady) => {
            if (isReady) {
              setRestartMessage("RTSP server sẵn sàng! Đang reset màn hình...");
              showToast("🔄 Đang reset màn hình...", "info", 2000);

              // Reset screen after confirming RTSP server is ready
              setTimeout(() => {
                setRestartMessage("Đang tải lại hệ thống...");
                showToast("🎯 Đang tải lại hệ thống...", "info", 2000);
                window.location.reload();
              }, 2000);
            } else {
              // If RTSP server not ready, wait a bit more and reload anyway
              setRestartMessage("RTSP server chưa sẵn sàng, đang reload...");
              showToast("⚠️ Đang reload để kết nối lại...", "warning", 2000);
              setTimeout(() => {
                window.location.reload();
              }, 3000);
            }
          });
        }, 8000); // Wait 8 seconds for services to be ready
      } else {
        showToast("❌ " + result.message, "error", 5000);
        setIsRestartingCamera(false);
        setRestartMessage("");
      }
    } catch (error) {
      console.error("Error restarting camera system:", error);
      showToast("❌ Lỗi khởi động lại camera: " + error.message, "error", 5000);
      setIsRestartingCamera(false);
      setRestartMessage("");
    }
    // Note: Don't reset isRestartingCamera here since we're reloading the page
  };

  const reloadMainUI = () => {
    window.location.reload();
  };

  const logout = () => {
    if (window.confirm("Bạn có chắc muốn đăng xuất?")) {
      console.log("🔄 Logout initiated - resetting camera connections");

      // Increment reset key to force camera cleanup
      setCameraResetKey((prev) => prev + 1);

      // Clear user context
      contextLogout();

      cleanup();

      // Add slight delay to allow cleanup to complete
      setTimeout(() => {
        window.location.reload();
      }, 100);
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
      console.log(`DEBUG: Checking session status for card ${cardId}`);
      const { loadPhienGuiXeTheoMaThe, layDanhSachThe } = await import(
        "../../api/api"
      );

      // Check if card exists
      const cardList = await layDanhSachThe();
      const cardExists = cardList?.find((card) => card.uidThe === cardId);
      console.log(`DEBUG: Card exists:`, cardExists);

      // Check active sessions
      const activeSessions = await loadPhienGuiXeTheoMaThe(cardId);
      console.log(`DEBUG: Active sessions:`, activeSessions);

      return {
        cardExists: !!cardExists,
        activeSessions: activeSessions,
        hasActiveSession: activeSessions && activeSessions.length > 0,
      };
    } catch (error) {
      console.error(`DEBUG: Error checking card session:`, error);
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
    console.log("handleWorkConfigSave called with config:", config);
    setWorkConfig(config);
    setCurrentVehicleType(config.loai_xe || "xe_may");
    setShowWorkConfig(false);

    // Reload config from localStorage to ensure it's properly saved
    setTimeout(() => {
      const savedConfig = localStorage.getItem("work_config");
      if (savedConfig) {
        const reloadedConfig = JSON.parse(savedConfig);
        console.log("Config reloaded from localStorage:", reloadedConfig);
        setWorkConfig(reloadedConfig);
      }
    }, 100);
  };

  // Calculate estimated parking fee based on pricing policy
  const calculateEstimatedFee = (pricingPolicy) => {
    try {
      if (!pricingPolicy || !pricingPolicy.maChinhSach) {
        return 0;
      }

      // Phí cơ bản từ chính sách
      let baseFee = 0;
      if (typeof pricingPolicy === "object") {
        baseFee = pricingPolicy.donGia || pricingPolicy.phi || 0;
      } else if (typeof pricingPolicy === "string") {
        // Fallback for string policy - will need to fetch from API
        baseFee = 5000; // Default fee
      }

      return baseFee;
    } catch (error) {
      console.error("Error calculating estimated fee:", error);
      return 0;
    }
  };

  // Debug function to verify workConfig
  const debugWorkConfig = () => {
    console.log("=== WORK CONFIG DEBUG ===");
    const rawConfig = localStorage.getItem("work_config");
    console.log("Raw localStorage value:", rawConfig);

    if (rawConfig) {
      try {
        const parsed = JSON.parse(rawConfig);
        console.log("Parsed config:", parsed);
        console.log("Config keys:", Object.keys(parsed));
        console.log("loai_xe value:", parsed.loai_xe);
        console.log("loai_xe type:", typeof parsed.loai_xe);
        console.log("vehicle_type value:", parsed.vehicle_type);
      } catch (e) {
        console.error("Failed to parse config:", e);
      }
    } else {
      console.log("No config in localStorage");
    }

    console.log("Current workConfig state:", workConfig);
    console.log("Current workConfig state is null:", workConfig === null);
    console.log("Current workConfig state type:", typeof workConfig);

    // Check if state update is pending
    setTimeout(() => {
      console.log("WorkConfig state after timeout:", workConfig);
    }, 50);

    console.log("=== END DEBUG ===");
  };

  // Computed workConfig for components (with fallback)
  const effectiveWorkConfigForComponents = useMemo(() => {
    if (workConfig) {
      return workConfig;
    }

    // Fallback: try to get from localStorage directly
    try {
      const savedConfig = localStorage.getItem("work_config");
      if (savedConfig) {
        const parsed = JSON.parse(savedConfig);
        console.log("Using fallback workConfig for components:", parsed);
        return parsed;
      }
    } catch (error) {
      console.error("Failed to get fallback workConfig:", error);
    }

    return null;
  }, [workConfig]);

  // Helper function to get effective workConfig (can be called from any function)
  const getEffectiveWorkConfig = () => {
    if (workConfig) {
      return workConfig;
    }

    // Fallback: try to get from localStorage directly
    try {
      const savedConfig = localStorage.getItem("work_config");
      if (savedConfig) {
        const parsed = JSON.parse(savedConfig);
        console.log("Using fallback workConfig:", parsed);
        return parsed;
      }
    } catch (error) {
      console.error("Failed to get fallback workConfig:", error);
    }

    return null;
  };

  // Handle card scanning
  const handleCardScanned = async (cardId) => {
    console.log("handleCardScanned called with cardId:", cardId);
    console.log("currentModeRef.current:", currentModeRef.current);
    console.log("workConfig at time of card scan:", workConfig);
    console.log(
      "workConfig.loai_xe at time of card scan:",
      workConfig?.loai_xe
    );

    // Get effective workConfig using helper function
    const effectiveWorkConfig = getEffectiveWorkConfig();
    console.log("Effective workConfig:", effectiveWorkConfig);

    // Debug workConfig structure
    debugWorkConfig();

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

        // Kiểm tra quyền admin để thêm thẻ mới
        if (!isAdmin()) {
          showToast(
            `Thẻ ${cardId} chưa được đăng ký. Chỉ Admin mới có quyền thêm thẻ mới.`,
            "error",
            5000
          );
          return;
        }

        // Mở RFID dialog với thông tin thẻ được pre-fill
        setPrefilledCardId(cardId);
        setAutoOpenAddCard(true);
        setShowRfidManager(true);
        showToast(
          `Thẻ ${cardId} chưa được đăng ký. Mở dialog RFID để thêm thẻ mới.`,
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
            `Thẻ ${cardId} đã tồn tại trong phiên gửi xe!`,
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
          console.log(
            "About to call captureImage - cameraManagerRef.current:",
            !!cameraManagerRef.current
          );
          console.log(
            "Available methods:",
            Object.keys(cameraManagerRef.current || {})
          );

          const captureResult = await cameraManagerRef.current.captureImage(
            cardId,
            actualMode
          );

          plateImage = captureResult[0];
          licensePlate = captureResult[1];
          faceImage = captureResult[2];

          console.log("Image capture result:", {
            plateImage: plateImage ? "có" : "không có",
            plateImageType: typeof plateImage,
            plateImageUrl: plateImage?.url,
            plateImageIsPlaceholder: plateImage?.isPlaceholder,
            faceImage: faceImage ? "có" : "không có",
            faceImageType: typeof faceImage,
            faceImageUrl: faceImage?.url,
            faceImageIsPlaceholder: faceImage?.isPlaceholder,
            licensePlate,
          });

          setCapturedImages({
            plateImage: plateImage?.url || plateImage,
            faceImage: faceImage?.url || faceImage,
            plateImageBlob: plateImage?.blob,
            faceImageBlob: faceImage?.blob,
          });

          // ✅ IMAGES ALREADY DISPLAYED BY QuanLyCamera - No need to display again
          console.log(
            "✅ Images captured and should be displayed by QuanLyCamera:",
            {
              plateImageUrl: plateImage?.url,
              faceImageUrl: faceImage?.url,
              hasPlateBlob: !!plateImage?.blob,
              hasFaceBlob: !!faceImage?.blob,
            }
          );

          // Xử lý chấm công khi có ảnh khuôn mặt - CHỈ ở chế độ xe vào
          if (actualMode === "vao" && faceImage?.blob) {
            console.log(
              "🎯 Bắt đầu xử lý chấm công với ảnh khuôn mặt (mode: vào)"
            );

            // Lấy biển số từ div plate-text trong camera panel (tối ưu)
            const getDisplayedLicensePlate = () => {
              try {
                // Sử dụng querySelector với cache element nếu có thể
                const plateTextDiv = document.querySelector(".plate-text");
                if (plateTextDiv && plateTextDiv.textContent) {
                  const plateText = plateTextDiv.textContent.trim();
                  if (plateText && plateText !== "" && plateText !== "N/A") {
                    console.log("Biển số từ plate-text div:", plateText);
                    return plateText;
                  }
                }
                return null;
              } catch (error) {
                console.warn("Không thể lấy biển số từ plate-text div:", error);
                return null;
              }
            };

            const displayedPlate = getDisplayedLicensePlate();
            const finalLicensePlate =
              displayedPlate || licensePlate || recognizedLicensePlate || "";

            console.log(
              "Biển số cuối cùng sử dụng cho chấm công:",
              finalLicensePlate
            );

            // Chạy chấm công bất đồng bộ để không chặn UI
            setTimeout(async () => {
              try {
                // 1) Kiểm tra biển số có trong pm_nc0002 - CHÍNH XÁC
                let vehicleOwnerInfo = null;
                try {
                  const vehicleList = await layDanhSachPhuongTien();

                  // ✅ STRICT MATCH: Tìm xe với biển số chính xác 100%
                  const matchedVehicle = Array.isArray(vehicleList)
                    ? vehicleList.find((v) => {
                        const registeredPlate = (v.bienSo || v.lv001 || "")
                          .toUpperCase()
                          .trim();
                        const detectedPlate = (finalLicensePlate || "")
                          .toUpperCase()
                          .trim();
                        return (
                          registeredPlate === detectedPlate &&
                          registeredPlate !== ""
                        );
                      })
                    : null;

                  if (matchedVehicle) {
                    vehicleOwnerInfo = {
                      licensePlate:
                        matchedVehicle.bienSo || matchedVehicle.lv001,
                      ownerName:
                        matchedVehicle.tenChuXe || matchedVehicle.lv003,
                      ownerImagePath:
                        matchedVehicle.duongDanKhuonMat || matchedVehicle.lv004,
                      vehicleType:
                        matchedVehicle.maLoaiPT || matchedVehicle.lv002,
                    };
                    console.log(
                      "🎯 EXACT MATCH: Tìm thấy xe trong pm_nc0002 với biển số chính xác:",
                      {
                        detected: finalLicensePlate,
                        registered: vehicleOwnerInfo.licensePlate,
                        owner: vehicleOwnerInfo.ownerName,
                      }
                    );
                  } else {
                    console.log(
                      `❌ KHÔNG TÌM THẤY: Biển số "${finalLicensePlate}" không có trong database pm_nc0002 - BỎ QUA nhận diện khuôn mặt`
                    );
                  }
                } catch (e) {
                  console.warn("Không tải được danh sách pm_nc0002:", e);
                }

                // 🚀 XỬ LÝ CHẤM CÔNG CHO TẤT CẢ BIỂN SỐ (kể cả khách vãng lai)
                if (faceImage?.blob) {
                  console.log(
                    "🔍 Bắt đầu nhận diện khuôn mặt cho biển số:",
                    finalLicensePlate,
                    vehicleOwnerInfo ? "(đã đăng ký)" : "(khách vãng lai)"
                  );

                  try {
                    // 2) Gửi ảnh khuôn mặt tới face recognition service
                    const recognizeResult = await faceAPI.recognizeFace(
                      faceImage.blob
                    );

                    if (
                      recognizeResult.success &&
                      recognizeResult.faces &&
                      recognizeResult.faces.length > 0
                    ) {
                      const recognizedFace = recognizeResult.faces[0];

                      // ✅ KIỂM TRA CHÍNH XÁC: Biển số nhận dạng phải khớp với employee_id
                      if (
                        recognizedFace.name &&
                        recognizedFace.employee_id &&
                        recognizedFace.confidence
                      ) {
                        const faceEmployeeId = (
                          recognizedFace.employee_id || ""
                        )
                          .toUpperCase()
                          .trim();
                        const detectedPlate = (finalLicensePlate || "")
                          .toUpperCase()
                          .trim();

                        // 🚀 CHẤM CÔNG TỰ ĐỘNG: Luôn thực hiện khi nhận diện khuôn mặt thành công
                        // Không cần kiểm tra biển số khớp, chỉ cần có ảnh khuôn mặt và nhận diện được
                        console.log(
                          "🚀 Bắt đầu chấm công tự động cho nhân viên:",
                          {
                            employeeName: recognizedFace.name,
                            employeeId: recognizedFace.employee_id,
                            licensePlate: finalLicensePlate,
                            confidence: recognizedFace.confidence,
                          }
                        );

                        try {
                          // Gọi API chấm công bất đồng bộ để không chặn UI
                          setTimeout(async () => {
                            try {
                              const attendanceResult =
                                await processAttendanceImage(
                                  faceImage.blob,
                                  finalLicensePlate,
                                  showToast,
                                  currentMode
                                );

                              if (attendanceResult) {
                                console.log(
                                  "✅ Chấm công thành công:",
                                  attendanceResult
                                );
                              } else {
                                console.log(
                                  "ℹ️ Chấm công bỏ qua (có thể là khách hàng)"
                                );
                              }
                            } catch (attendanceError) {
                              console.error(
                                "❌ Lỗi chấm công:",
                                attendanceError
                              );
                              // Không hiển thị lỗi cho user để tránh spam
                            }
                          }, 100); // Delay nhỏ để không ảnh hưởng performance
                        } catch (error) {
                          console.error("❌ Lỗi khởi tạo chấm công:", error);
                        }

                        // ✅ RÀNG BUỘC CHẶT CHẼ: employee_id phải khớp với biển số detected
                        // VÀ biển số phải có trong database (đã đăng ký)
                        if (
                          faceEmployeeId === detectedPlate &&
                          vehicleOwnerInfo
                        ) {
                          console.log(
                            "✅ MATCH HOÀN HẢO: Nhận diện khuôn mặt và biển số khớp:",
                            {
                              detectedPlate: detectedPlate,
                              faceEmployeeId: faceEmployeeId,
                              ownerName: recognizedFace.name,
                              confidence: recognizedFace.confidence,
                            }
                          );

                          // 3) Hiển thị toast thông báo xin chào
                          const welcomeMessage = `Xin chào ${recognizedFace.name}, biển số: ${recognizedFace.employee_id}, đang mở cổng`;
                          showToast &&
                            showToast(welcomeMessage, "success", 5000);

                          // 4) Kích hoạt relay sequence (module 1)
                          try {
                            console.log("🎛️ Kích hoạt relay sequence module 1");

                            // Kiểm tra môi trường Electron trước khi thực hiện
                            if (
                              typeof window !== "undefined" &&
                              window.electronAPI &&
                              window.electronAPI.relayControl
                            ) {
                              // Chạy test sequence trên relay module 1 lần
                              await relayTestSequence(1, 1000);
                              console.log(
                                "✅ Đã kích hoạt relay sequence thành công"
                              );

                              // Toast thông báo relay đã kích hoạt
                              showToast &&
                                showToast(
                                  "🎛️ Đã kích hoạt cổng tự động",
                                  "info",
                                  3000
                                );
                            } else {
                              console.warn(
                                "⚠️ Relay control không khả dụng (không phải Electron environment)"
                              );
                              // Trong môi trường web browser, chỉ log thông báo
                              showToast &&
                                showToast(
                                  "⚠️ Relay control không khả dụng trong môi trường web",
                                  "warning",
                                  3000
                                );
                            }
                          } catch (relayError) {
                            console.error(
                              "❌ Lỗi kích hoạt relay:",
                              relayError
                            );
                            showToast &&
                              showToast(
                                "❌ Lỗi kích hoạt cổng tự động",
                                "error",
                                3000
                              );
                          }
                        } else {
                          console.log(
                            `❌ BIỂN SỐ KHÔNG KHỚP: Detected plate "${detectedPlate}" != Face employee_id "${faceEmployeeId}" - BỎ QUA mở cổng`
                          );
                          showToast &&
                            showToast(
                              `Biển số không khớp với khuôn mặt đã đăng ký: ${detectedPlate} != ${faceEmployeeId}`,
                              "warning",
                              4000
                            );
                        }
                      } else {
                        console.log(
                          "❌ Không nhận diện được khuôn mặt hoặc format response không đúng"
                        );
                        showToast &&
                          showToast(
                            "Không nhận diện được khuôn mặt",
                            "warning",
                            2000
                          );
                      }
                    } else {
                      console.log(
                        "❌ Face recognition service trả về lỗi hoặc không tìm thấy khuôn mặt"
                      );
                      showToast &&
                        showToast(
                          "Không nhận diện được khuôn mặt trong ảnh",
                          "warning",
                          2000
                        );
                    }
                  } catch (faceRecognitionError) {
                    console.error(
                      "❌ Lỗi nhận diện khuôn mặt:",
                      faceRecognitionError
                    );
                    showToast &&
                      showToast(
                        "Lỗi kết nối tới dịch vụ nhận diện khuôn mặt",
                        "error",
                        3000
                      );
                  }
                } else if (!vehicleOwnerInfo) {
                  console.log(
                    "ℹ️ Biển số không có trong database pm_nc0002:",
                    finalLicensePlate,
                    "- BỎ QUA nhận diện khuôn mặt"
                  );
                  // Không hiển thị thông báo cho trường hợp này để tránh spam
                } else {
                  console.log("⚠️ Không có ảnh khuôn mặt để xử lý");
                }
              } catch (error) {
                console.error("❌ Lỗi xử lý chấm công tự động:", error);
              }
            }, 50); // Giảm delay để responsive hơn
          }

          // Update status after capture and display
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus(
              "ẢNH ĐÃ HIỂN THỊ",
              "#10b981"
            );
          } // Auto recognize license plate after capture
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

                // Only display plate text if confidence >= 90%
                if (
                  recognizedLicensePlate &&
                  confidence >= 0.9 &&
                  cameraComponentRef.current
                ) {
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
                    `Nhận dạng biển số: ${recognizedLicensePlate}`,
                    "success",
                    3000
                  );
                } else if (recognizedLicensePlate && confidence < 0.9) {
                  // License plate detected but confidence too low
                  if (vehicleInfoComponentRef.current) {
                    const confidencePercent = (confidence * 100).toFixed(1);
                    vehicleInfoComponentRef.current.updateCardReaderStatus(
                      `ĐỘ TIN CẬY THẤP: ${recognizedLicensePlate} (${confidencePercent}%)`,
                      "#f59e0b"
                    );
                  }
                  showToast(
                    `Độ tin cậy biển số thấp: ${recognizedLicensePlate} (${(
                      confidence * 100
                    ).toFixed(1)}% < 90%)`,
                    "warning",
                    4000
                  );
                  // Clear the displayed plate text since confidence is too low
                  recognizedLicensePlate = null;
                } else {
                  if (vehicleInfoComponentRef.current) {
                    vehicleInfoComponentRef.current.updateCardReaderStatus(
                      "KHÔNG NHẬN DẠNG ĐƯỢC BIỂN SỐ",
                      "#ef4444"
                    );
                  }
                  showToast(`Không nhận dạng được biển số`, "warning", 3000);
                }
              }
            } catch (recognitionError) {
              console.error(
                "Error recognizing license plate:",
                recognitionError
              );

              // FALLBACK: Try to get detected plate from realtime detection
              const mode = actualMode === "vao" ? "in" : "out";
              const realtimeDetectedPlate =
                cameraComponentRef.current?.getLastDetectedPlate?.(mode);

              if (realtimeDetectedPlate) {
                recognizedLicensePlate = realtimeDetectedPlate;
                console.log(
                  `✅ Using realtime detected plate as fallback: ${recognizedLicensePlate}`
                );

                if (vehicleInfoComponentRef.current) {
                  vehicleInfoComponentRef.current.updateCardReaderStatus(
                    `BIỂN SỐ (REALTIME): ${recognizedLicensePlate}`,
                    "#10b981"
                  );
                }

                showToast(
                  `Sử dụng biển số từ nhận dạng realtime: ${recognizedLicensePlate}`,
                  "success",
                  4000
                );
              } else {
                if (vehicleInfoComponentRef.current) {
                  vehicleInfoComponentRef.current.updateCardReaderStatus(
                    "LỖI NHẬN DẠNG BIỂN SỐ",
                    "#ef4444"
                  );
                }
                showToast(
                  `Lỗi nhận dạng biển số: ${recognitionError.message}`,
                  "error",
                  4000
                );
              }
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
                themPhienGuiXeVoiViTri,
              } = await import("../../api/api");
              const {
                validateAndEnsurePricingPolicy,
                themPhienGuiXeWithValidation,
              } = await import("../../utils/sessionValidation");

              // B1: Lấy thông tin thẻ để kiểm tra chính sách đã gán
              let pricingPolicy = null;
              try {
                const cardList = await layDanhSachThe();
                const currentCard = cardList.find(
                  (card) => card.uidThe === cardId
                );

                if (
                  currentCard &&
                  currentCard.maChinhSach &&
                  currentCard.maChinhSach.trim() !== ""
                ) {
                  // Ưu tiên sử dụng chính sách đã gán cho thẻ
                  pricingPolicy = currentCard.maChinhSach.trim();
                  console.log(`Sử dụng chính sách từ thẻ: ${pricingPolicy}`);
                } else {
                  console.log(
                    `Thẻ ${cardId} chưa có chính sách gán sẵn, sử dụng fallback`
                  );
                }
              } catch (cardError) {
                console.error("Lỗi khi lấy thông tin thẻ:", cardError);
              }

              // B2: Nếu thẻ chưa có chính sách, sử dụng workConfig để xác định default policy
              if (!pricingPolicy) {
                console.log("Debug workConfig state:", effectiveWorkConfig);
                console.log(
                  "effectiveWorkConfig.loai_xe:",
                  effectiveWorkConfig?.loai_xe
                );
                console.log(
                  "effectiveWorkConfig.vehicle_type:",
                  effectiveWorkConfig?.vehicle_type
                );
                console.log(
                  "typeof effectiveWorkConfig:",
                  typeof effectiveWorkConfig
                );
                console.log(
                  "effectiveWorkConfig keys:",
                  effectiveWorkConfig
                    ? Object.keys(effectiveWorkConfig)
                    : "null"
                );

                if (effectiveWorkConfig?.loai_xe) {
                  const vehicleType = effectiveWorkConfig.loai_xe.toLowerCase();

                  // Support multiple formats: "oto", "OT", "ô tô", etc.
                  if (
                    vehicleType === "oto" ||
                    vehicleType === "ot" ||
                    vehicleType.includes("oto") ||
                    vehicleType.includes("ô tô")
                  ) {
                    pricingPolicy = "CS_OTO_4H";
                    console.log(
                      `Thẻ chưa có chính sách, sử dụng default cho ô tô: ${pricingPolicy} (từ ${effectiveWorkConfig.loai_xe})`
                    );
                  } else if (
                    vehicleType === "xe_may" ||
                    vehicleType === "xm" ||
                    vehicleType.includes("xe máy") ||
                    vehicleType.includes("xe may")
                  ) {
                    pricingPolicy = "CS_XEMAY_4H";
                    console.log(
                      `Thẻ chưa có chính sách, sử dụng default cho xe máy: ${pricingPolicy} (từ ${effectiveWorkConfig.loai_xe})`
                    );
                  } else {
                    // Fallback for other vehicle types - default to small vehicle
                    pricingPolicy = "CS_XEMAY_4H";
                    console.log(
                      `Loại xe không xác định (${effectiveWorkConfig.loai_xe}), mặc định xe máy: ${pricingPolicy}`
                    );
                  }
                } else {
                  // No workConfig vehicle type - default to small vehicle
                  pricingPolicy = "CS_XEMAY_4H";
                  console.log(
                    `WorkConfig không có loại xe (effectiveWorkConfig: ${JSON.stringify(
                      effectiveWorkConfig
                    )}), mặc định xe máy: ${pricingPolicy}`
                  );
                }
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
              if (!apiSuccess && effectiveWorkConfig?.entry_gate) {
                entryGate = effectiveWorkConfig.entry_gate;
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
              if (
                typeof effectiveWorkConfig === "object" &&
                effectiveWorkConfig
              ) {
                maKhuVuc =
                  effectiveWorkConfig.ma_khu_vuc ||
                  effectiveWorkConfig.maKhuVuc ||
                  effectiveWorkConfig.zone_code ||
                  effectiveWorkConfig.zone;
              }

              // Bước 1: Kiểm tra loại xe từ workConfig trước (CHÍNH)
              if (effectiveWorkConfig?.loai_xe) {
                console.log(
                  `DEBUG: effectiveWorkConfig.loai_xe = "${
                    effectiveWorkConfig.loai_xe
                  }" (type: ${typeof effectiveWorkConfig.loai_xe})`
                );

                // Normalize vehicle type for comparison
                const vehicleType = effectiveWorkConfig.loai_xe.toLowerCase();
                console.log(`DEBUG: Normalized vehicleType = "${vehicleType}"`);

                // Mapping workConfig vehicle type to database format
                if (
                  vehicleType === "oto" ||
                  vehicleType === "ot" ||
                  vehicleType.includes("oto") ||
                  vehicleType.includes("ô tô")
                ) {
                  loaiXe = "1"; // Xe lớn
                  console.log(
                    `Loại xe từ workConfig: Ô tô (loaiXe = 1) - từ "${effectiveWorkConfig.loai_xe}"`
                  );
                } else if (
                  vehicleType === "xe_may" ||
                  vehicleType === "xm" ||
                  vehicleType.includes("xe máy") ||
                  vehicleType.includes("xe may")
                ) {
                  loaiXe = "0"; // Xe nhỏ
                  console.log(
                    `Loại xe từ workConfig: Xe máy (loaiXe = 0) - từ "${effectiveWorkConfig.loai_xe}"`
                  );
                } else {
                  // WorkConfig có thể chứa mã loại phương tiện trực tiếp từ pm_nc0001
                  try {
                    const vehicleTypes = await layALLLoaiPhuongTien();
                    const matchedType = vehicleTypes.find(
                      (vt) =>
                        vt.maLoaiPT === effectiveWorkConfig.loai_xe ||
                        vt.tenLoaiPT === effectiveWorkConfig.vehicle_type
                    );

                    if (matchedType) {
                      loaiXe = matchedType.loaiXe?.toString() || "0";
                      console.log(
                        `Loại xe từ workConfig mapping: ${matchedType.tenLoaiPT} (loaiXe = ${loaiXe})`
                      );
                    } else {
                      loaiXe = "0"; // Default to small vehicle
                      console.log(
                        `Không tìm thấy mapping cho loại xe: ${effectiveWorkConfig.loai_xe}, mặc định xe nhỏ`
                      );
                    }
                  } catch (error) {
                    console.error(`Lỗi khi mapping loại xe:`, error);
                    loaiXe = "0"; // Fallback to small vehicle
                  }
                }
              }
              // Bước 2: Nếu không có workConfig, fallback về biển số (FALLBACK)
              else if (recognizedLicensePlate) {
                console.log(
                  `WorkConfig không có loại xe, đang kiểm tra từ biển số: ${recognizedLicensePlate}`
                );
                try {
                  const thongTinLoaiXe = await layThongTinLoaiXeTuBienSo(
                    recognizedLicensePlate
                  );

                  if (thongTinLoaiXe.success) {
                    loaiXe = thongTinLoaiXe.loaiXe;
                    console.log(
                      `Loại xe từ biển số: ${loaiXe} (0=xe nhỏ, 1=xe lớn)`
                    );
                  } else {
                    console.log(
                      `Không tìm thấy loại xe từ biển số, mặc định là xe nhỏ`
                    );
                  }
                } catch (error) {
                  console.error(`Lỗi khi lấy loại xe từ biển số:`, error);
                  loaiXe = "0";
                }
              } else {
                console.log(
                  `Không có workConfig và biển số, mặc định là xe nhỏ`
                );
                loaiXe = "0";
              }

              console.log(
                `Kết quả cuối cùng: loaiXe = ${loaiXe} (từ ${
                  effectiveWorkConfig?.loai_xe ? "workConfig" : "fallback"
                })`
              );

              // Fallback cuối: chỉ suy luận từ mã chính sách khi cần (cho trường hợp thẻ có policy nhưng workConfig không có loại xe)
              if (
                (loaiXe === "0" || loaiXe === 0) &&
                pricingPolicy &&
                !effectiveWorkConfig?.loai_xe
              ) {
                const policyUpper = pricingPolicy.toUpperCase();
                if (
                  policyUpper.includes("OTO") ||
                  policyUpper.includes("OT") ||
                  policyUpper.includes("BUS") ||
                  policyUpper.includes("16CHO") ||
                  policyUpper.includes("12CHO")
                ) {
                  loaiXe = "1";
                  console.log(
                    `Suy luận loaiXe=1 từ policy ${pricingPolicy} (chỉ khi workConfig không có loại xe)`
                  );
                }
              }

              console.log(`Kết quả nhận diện loại xe: loaiXe = ${loaiXe}`);

              // Xử lý cấp slot đỗ xe dựa trên loaiXe từ pm_nc0001.lv004
              if (loaiXe === "1") {
                console.log(
                  `Xe lớn (loaiXe = 1) - đang tìm slot trống từ pm_nc0005...`
                );

                try {
                  const slotResult = await laySlotTrongChoXeLon(maKhuVuc);

                  if (slotResult.success) {
                    parkingSpot = slotResult.maChoDo;
                    console.log(
                      `Đã tìm thấy slot: ${parkingSpot} tại khu vực ${slotResult.tenKhuVuc}`
                    );

                    // Cập nhật trạng thái slot thành đã dùng (lv003 = 1)
                    const updateResult = await capNhatTrangThaiChoDo(
                      parkingSpot,
                      "1"
                    );
                    if (updateResult.success) {
                      console.log(
                        `Đã cập nhật trạng thái slot ${parkingSpot} thành đã dùng (lv003 = 1)`
                      );
                    } else {
                      console.error(
                        `Lỗi cập nhật trạng thái slot: ${updateResult.message}`
                      );
                    }
                  } else {
                    // Không còn slot cho xe lớn
                    if (vehicleInfoComponentRef.current) {
                      vehicleInfoComponentRef.current.updateCardReaderStatus(
                        "KHÔNG CÒN CHỖ ĐỖ CHO XE LỚN",
                        "#ef4444"
                      );
                    }
                    showToast("Không còn chỗ đỗ cho xe lớn!", "error", 5000);
                    return;
                  }
                } catch (error) {
                  console.error(`Lỗi khi tìm slot cho xe lớn:`, error);
                  showToast("Lỗi hệ thống khi tìm chỗ đỗ!", "error", 5000);
                  return;
                }
              } else if (loaiXe === "0") {
                console.log(
                  `Xe nhỏ (loaiXe = 0) - không cần slot cụ thể, viTriGui = null`
                );
                parkingSpot = null; // Xe nhỏ không cần vị trí đỗ cụ thể
              } else {
                console.log(
                  `Loại xe không xác định (loaiXe = ${loaiXe}), mặc định không cần slot`
                );
                parkingSpot = null;
              }

              // Get entry camera by calling API directly
              let cameraId = null;

              try {
                const { layDanhSachKhu } = await import("../../api/api");
                const zonesResponse = await layDanhSachKhu();

                if (zonesResponse && Array.isArray(zonesResponse)) {
                  let actualZoneCode = null;

                  if (
                    typeof effectiveWorkConfig === "object" &&
                    effectiveWorkConfig
                  ) {
                    actualZoneCode =
                      effectiveWorkConfig.ma_khu_vuc ||
                      effectiveWorkConfig.maKhuVuc ||
                      effectiveWorkConfig.zone_code ||
                      effectiveWorkConfig.zone;
                  } else if (typeof effectiveWorkConfig === "string") {
                    actualZoneCode = effectiveWorkConfig;
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

              // Prepare session data - chỉ lưu filename vào database
              const plateImageFilename =
                plateImage?.filename ||
                extractFilenameFromImageUrl(plateImage?.url || plateImage) ||
                "";
              const faceImageFilename =
                faceImage?.filename ||
                extractFilenameFromImageUrl(faceImage?.url || faceImage) ||
                "";

              console.log(
                `Image processing: plateImage filename=${plateImageFilename}, faceImage filename=${faceImageFilename}`
              );

              const sessionData = {
                uidThe: cardId,
                bienSo: recognizedLicensePlate || "",
                chinhSach: pricingPolicy,
                congVao: entryGate,
                gioVao: getCurrentDateTime(), // Sử dụng utility function để lấy thời gian hệ thống
                anhVao: plateImageFilename, // Chỉ lưu filename vào database
                anhMatVao: faceImageFilename, // Chỉ lưu filename vào database
                trangThai: "TRONG_BAI",
                camera_id: cameraId,
                plate_match: recognizedLicensePlate ? 1 : 0,
                plate: recognizedLicensePlate || "",
                loaiXe: loaiXe,
                viTriGui: parkingSpot, // null cho xe nhỏ, có giá trị cho xe lớn
              };

              // Debug log to check image data
              console.log("DEBUG sessionData images:", {
                plateImageType: typeof plateImage,
                plateImageValue: plateImage,
                plateImageFilename: plateImage?.filename,
                faceImageType: typeof faceImage,
                faceImageValue: faceImage,
                faceImageFilename: faceImage?.filename,
                anhVaoInSession: sessionData.anhVao,
                anhMatVaoInSession: sessionData.anhMatVao,
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
                // **MỚI: UPLOAD ẢNH VÀO Ổ ĐĨA CHỈ SAU KHI PHIÊN GỬI XE THÀNH CÔNG**
                if (
                  cameraManagerRef.current &&
                  cameraManagerRef.current.uploadCapturedImages
                ) {
                  try {
                    console.log(
                      "🚀 Session created successfully, now uploading images to disk..."
                    );
                    const uploadResults =
                      await cameraManagerRef.current.uploadCapturedImages(
                        plateImage,
                        faceImage
                      );
                    if (uploadResults.errors.length === 0) {
                      console.log(
                        "✅ All images uploaded to disk after successful session"
                      );
                      showToast(
                        "Ảnh đã được lưu vào ổ đĩa thành công",
                        "success",
                        2000
                      );
                    } else {
                      console.warn(
                        "⚠️ Some images failed to upload:",
                        uploadResults.errors
                      );
                      showToast(
                        "Một số ảnh không lưu được vào ổ đĩa",
                        "warning",
                        3000
                      );
                    }
                  } catch (uploadError) {
                    console.error(
                      "❌ Error uploading images after session:",
                      uploadError
                    );
                    showToast("Lỗi lưu ảnh vào ổ đĩa", "error", 3000);
                  }
                }

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
                    vehicleInfoComponentRef.current.updateParkingFee(
                      `${estimatedFee.toLocaleString()} VNĐ (dự kiến)`
                    );
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
                if (
                  vehicleListComponentRef.current &&
                  vehicleListComponentRef.current.refreshVehicleList
                ) {
                  vehicleListComponentRef.current.refreshVehicleList();
                }

                let successMessage = `Xe vào thành công! Thẻ: ${cardId}`;
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
              console.error("Error saving parking session:", sessionError);
              if (vehicleInfoComponentRef.current) {
                vehicleInfoComponentRef.current.updateCardReaderStatus(
                  "LỖI LƯU PHIÊN GỬI XE",
                  "#ef4444"
                );
              }

              // Kiểm tra nếu lỗi là thẻ chưa tồn tại trong hệ thống
              const errorMessage = sessionError.message || "";
              if (
                errorMessage.includes("chưa tồn tại trong hệ thống") ||
                errorMessage.includes("chưa được đăng ký")
              ) {
                // Hiển thị thông báo và mở dialog RFID với auto-open add dialog
                showToast(
                  "Thẻ RFID chưa được đăng ký. Đang mở trang quản lý thẻ RFID...",
                  "warning",
                  4000
                );

                // Delay một chút để user đọc thông báo, sau đó mở dialog RFID với auto-open
                setTimeout(() => {
                  setAutoOpenAddCard(true);
                  setShowRfidManager(true);
                }, 1500);
              } else {
                // Thông báo lỗi khác
                showToast(
                  `Lỗi lưu phiên gửi xe: ${errorMessage}. Ảnh không được lưu vào ổ đĩa.`,
                  "error",
                  6000
                );
              }

              console.log(
                "⚠️ Session creation failed - images will NOT be saved to disk"
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
              console.log(`Searching for active session for card: ${cardId}`);

              let activeSessions;
              try {
                activeSessions = await loadPhienGuiXeTheoMaThe(cardId);
                console.log(`Active sessions result:`, {
                  type: typeof activeSessions,
                  isArray: Array.isArray(activeSessions),
                  length: activeSessions?.length,
                  content: activeSessions,
                });
              } catch (apiError) {
                console.error(
                  `API Error loading sessions for card ${cardId}:`,
                  apiError
                );
                if (vehicleInfoComponentRef.current) {
                  vehicleInfoComponentRef.current.updateCardReaderStatus(
                    "LỖI TẢI DỮ LIỆU",
                    "#ef4444"
                  );
                }
                showToast(
                  `Lỗi tải dữ liệu phiên gửi xe: ${apiError.message}`,
                  "error",
                  5000
                );
                return;
              }

              if (!activeSessions || activeSessions.length === 0) {
                // No active session found - this card is not currently parked
                console.log(`No active session found for card ${cardId}`);
                console.log(`API Response:`, activeSessions);
                console.log(`Possible reasons:`);
                console.log(`   1. Card never entered parking lot`);
                console.log(`   2. Card already exited parking lot`);
                console.log(`   3. Database inconsistency`);
                console.log(
                  `Debug: Run debugCheckCardSession("${cardId}") in console for details`
                );

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
                    ghi_chu:
                      "Kiểm tra: 1) Thẻ đã vào bãi? 2) Thẻ đã ra bãi rồi?",
                  });
                }
                showToast(
                  `Thẻ ${cardId} không có xe trong bãi. Kiểm tra: đã vào bãi chưa hoặc đã ra rồi?`,
                  "error",
                  10000
                );
                return;
              }

              // Get the most recent active session
              const activeSession = activeSessions[0];

              // **MỚI: Hiển thị ảnh vào ngay khi tìm thấy phiên để đối chiếu**
              try {
                const { getImageUrl } = await import("../../api/api");

                // Lấy đường dẫn ảnh biển số vào và ảnh khuôn mặt vào từ activeSession
                const entryPlateImage =
                  activeSession.anhVao || activeSession.lv011;
                const entryFaceImage =
                  activeSession.anhMatVao || activeSession.lv015;

                console.log("Entry images from session (early display):", {
                  entryPlateImage,
                  entryFaceImage,
                  sessionData: activeSession,
                });

                let entryPlateUrl = null;
                let entryFaceUrl = null;

                // Tải ảnh biển số vào nếu có
                if (entryPlateImage) {
                  try {
                    entryPlateUrl = await getImageUrl(entryPlateImage);
                    console.log(
                      "✅ Early loaded entry plate image:",
                      entryPlateUrl
                    );
                  } catch (error) {
                    console.warn(
                      "❌ Failed to early load entry plate image:",
                      error
                    );
                  }
                }

                // Tải ảnh khuôn mặt vào nếu có
                if (entryFaceImage) {
                  try {
                    entryFaceUrl = await getImageUrl(entryFaceImage);
                    console.log(
                      "✅ Early loaded entry face image:",
                      entryFaceUrl
                    );
                  } catch (error) {
                    console.warn(
                      "❌ Failed to early load entry face image:",
                      error
                    );
                  }
                }

                // Hiển thị ảnh vào lên các panel đối chiếu ngay lập tức
                if (entryPlateUrl || entryFaceUrl) {
                  console.log(
                    "🎯 Early displaying entry images for comparison:",
                    {
                      entryPlateUrl,
                      entryFaceUrl,
                    }
                  );

                  // Gọi hàm displayEntryImagesAfterExit để hiển thị ảnh
                  if (cameraComponentRef.current) {
                    cameraComponentRef.current.displayEntryImagesAfterExit(
                      entryPlateUrl,
                      entryFaceUrl
                    );
                  }

                  // Thông báo cho người dùng biết đã tải được ảnh vào
                  showToast(
                    "Đã tải ảnh vào để đối chiếu. Vui lòng chụp ảnh ra.",
                    "info",
                    3000
                  );
                } else {
                  console.log(
                    "ℹ️ No entry images found in session data for early display"
                  );
                }
              } catch (imageError) {
                console.warn(
                  "⚠️ Error in early loading/displaying entry images:",
                  imageError
                );
                // Không throw error vì đây là tính năng phụ
              }

              // Get exit gate and camera by calling API directly
              let exitGate = null;
              let exitCameraId = null;

              try {
                const { layDanhSachKhu } = await import("../../api/api");
                const zonesResponse = await layDanhSachKhu();

                // Find current zone using workConfig
                let actualZoneCode = null;

                if (
                  typeof effectiveWorkConfig === "object" &&
                  effectiveWorkConfig
                ) {
                  // Try common field names
                  actualZoneCode =
                    effectiveWorkConfig.ma_khu_vuc ||
                    effectiveWorkConfig.maKhuVuc ||
                    effectiveWorkConfig.zone_code ||
                    effectiveWorkConfig.zone;
                } else if (typeof effectiveWorkConfig === "string") {
                  actualZoneCode = effectiveWorkConfig;
                }

                // Fallback: use first available zone if nothing found
                if (!actualZoneCode && zonesResponse?.length > 0) {
                  actualZoneCode = zonesResponse[0].maKhuVuc;
                }

                // Debug available zones
                if (zonesResponse && Array.isArray(zonesResponse)) {
                  console.log(
                    `DEBUG XE RA: Available zones:`,
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
                      `XE RA: Exit camera từ API cameraRa[0]: ${exitCameraId}`
                    );
                  }
                } else {
                  console.log(
                    `XE RA: Không tìm thấy zone ${actualZoneCode} trong API response`
                  );
                }
              } catch (apiError) {
                console.error(`XE RA: Lỗi gọi API layDanhSachKhu:`, apiError);

                // Fallback to workConfig if API fails
                if (effectiveWorkConfig?.exit_gate) {
                  exitGate = effectiveWorkConfig.exit_gate;
                  console.log(
                    `XE RA: Fallback exit gate từ workConfig: ${exitGate}`
                  );
                }
              }

              console.log(
                `XE RA: Final Exit Values: exitGate=${exitGate}, exitCameraId=${exitCameraId}`
              );

              // Log warning if values are null but allow processing to continue
              if (!exitGate) {
                console.warn(
                  `XE RA: WARNING - exitGate is null. API payload will have null congRa.`
                );
              }

              if (!exitCameraId) {
                console.warn(
                  `XE RA: WARNING - exitCameraId is null. Camera data may be missing in API payload.`
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
                effectiveWorkConfig
              );
            } catch (exitError) {
              console.error("Error processing vehicle exit:", exitError);
              if (vehicleInfoComponentRef.current) {
                vehicleInfoComponentRef.current.updateCardReaderStatus(
                  "LỖI XỬ LÝ XE RA",
                  "#ef4444"
                );
              }
              showToast(`Lỗi xử lý xe ra: ${exitError.message}`, "error", 5000);

              // Still show captured images even if exit processing fails
              const saveMessage = environmentInfo?.isElectron
                ? `Đã lưu ảnh nhưng có lỗi xử lý xe ra cho thẻ: ${cardId}`
                : `Đã download ảnh nhưng có lỗi xử lý xe ra cho thẻ: ${cardId}`;

              showToast(saveMessage, "warning", 4000);
            }
          }
        } catch (error) {
          console.error("Error in card scanning process:", error);
          if (vehicleInfoComponentRef.current) {
            vehicleInfoComponentRef.current.updateCardReaderStatus(
              "LỖI XỬ LÝ THẺ",
              "#ef4444"
            );
          }

          // Kiểm tra nếu lỗi là thẻ chưa tồn tại trong hệ thống
          const errorMessage = error.message || "";
          if (
            errorMessage.includes("chưa tồn tại trong hệ thống") ||
            errorMessage.includes("chưa được đăng ký")
          ) {
            // Hiển thị thông báo và mở dialog RFID với auto-open add dialog
            showToast(
              "Thẻ RFID chưa được đăng ký. Đang mở trang quản lý thẻ RFID...",
              "warning",
              4000
            );

            // Delay một chút để user đọc thông báo, sau đó mở dialog RFID với auto-open
            setTimeout(() => {
              setAutoOpenAddCard(true);
              setShowRfidManager(true);
            }, 1500);
          } else {
            // Lỗi khác
            showToast(`Lỗi xử lý thẻ: ${errorMessage}`, "error", 5000);
          }
        }
      }
    } catch (error) {
      console.error("Error capturing images:", error);
      if (vehicleInfoComponentRef.current) {
        vehicleInfoComponentRef.current.updateCardReaderStatus(
          "LỖI CHỤP ẢNH",
          "#ef4444"
        );
      }
      showToast(
        `Lỗi chụp ảnh cho thẻ: ${cardId} (${actualMode})`,
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

      // Extract filenames for exit images
      const plateImageExitFilename =
        plateImage?.filename ||
        extractFilenameFromImageUrl(plateImage?.url || plateImage) ||
        "";
      const faceImageExitFilename =
        faceImage?.filename ||
        extractFilenameFromImageUrl(faceImage?.url || faceImage) ||
        "";

      console.log(
        `Exit image processing: plateImage filename=${plateImageExitFilename}, faceImage filename=${faceImageExitFilename}`
      );

      const exitSessionData = {
        maPhien: activeSession.maPhien,
        congRa: exitGate,
        gioRa: getCurrentDateTime(), // Sử dụng utility function để lấy thời gian hệ thống
        anhRa: plateImageExitFilename, // Chỉ lưu filename vào database
        anhMatRa: faceImageExitFilename, // Chỉ lưu filename vào database
        camera_id: exitCameraId,
        plate_match: recognizedLicensePlate ? 1 : 0,
        plate: recognizedLicensePlate || "",
      };

      const updateResult = await capNhatPhienGuiXe(exitSessionData);

      if (updateResult && updateResult.success) {
        // **MỚI: UPLOAD ẢNH XE RA VÀ KHUÔN MẶT RA VÀO Ổ ĐĨA CHỈ SAU KHI CẬP NHẬT PHIÊN THÀNH CÔNG**
        if (
          cameraManagerRef.current &&
          cameraManagerRef.current.uploadCapturedImages
        ) {
          try {
            console.log(
              "Exit session updated successfully, now uploading exit images to disk..."
            );
            const uploadResults =
              await cameraManagerRef.current.uploadCapturedImages(
                plateImage,
                faceImage
              );
            if (uploadResults.errors.length === 0) {
              console.log(
                "All exit images uploaded to disk after successful session update"
              );
              showToast(
                "Ảnh xe ra đã được lưu vào ổ đĩa thành công",
                "success",
                2000
              );
            } else {
              console.warn(
                "Some exit images failed to upload:",
                uploadResults.errors
              );
              showToast(
                "Một số ảnh xe ra không lưu được vào ổ đĩa",
                "warning",
                3000
              );
            }
          } catch (uploadError) {
            console.error(
              "Error uploading exit images after session update:",
              uploadError
            );
            showToast("Lỗi lưu ảnh xe ra vào ổ đĩa", "error", 3000);
          }
        }

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
            console.log(
              `Main flow: Updating vehicle info with exit details and fee`
            );
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
            const formattedFee =
              parkingFee > 0 ? `${parkingFee.toLocaleString()} VNĐ` : "0 VNĐ";
            console.log(
              `Main flow: Also explicitly updating parking fee display to ${formattedFee}`
            );
            vehicleInfoComponentRef.current.updateParkingFee(formattedFee);
          }

          // Refresh vehicle list to show updated exit
          if (
            vehicleListComponentRef.current &&
            vehicleListComponentRef.current.refreshVehicleList
          ) {
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

          // **MỚI: Hiển thị ảnh vào để đối chiếu khi xe ra thành công**
          try {
            const { getImageUrl } = await import("../../api/api");

            // Lấy đường dẫn ảnh biển số vào và ảnh khuôn mặt vào từ activeSession
            const entryPlateImage = activeSession.anhVao || activeSession.lv011;
            const entryFaceImage =
              activeSession.anhMatVao || activeSession.lv015;

            console.log("Entry images from session:", {
              entryPlateImage,
              entryFaceImage,
              sessionData: activeSession,
            });

            let entryPlateUrl = null;
            let entryFaceUrl = null;

            // Tải ảnh biển số vào nếu có
            if (entryPlateImage) {
              try {
                entryPlateUrl = await getImageUrl(entryPlateImage);
                console.log("✅ Loaded entry plate image:", entryPlateUrl);
              } catch (error) {
                console.warn("❌ Failed to load entry plate image:", error);
              }
            }

            // Tải ảnh khuôn mặt vào nếu có
            if (entryFaceImage) {
              try {
                entryFaceUrl = await getImageUrl(entryFaceImage);
                console.log("✅ Loaded entry face image:", entryFaceUrl);
              } catch (error) {
                console.warn("❌ Failed to load entry face image:", error);
              }
            }

            // Hiển thị ảnh vào lên các panel đối chiếu
            if (entryPlateUrl || entryFaceUrl) {
              console.log("🎯 Displaying entry images for comparison:", {
                entryPlateUrl,
                entryFaceUrl,
              });

              // Gọi hàm displayEntryImagesAfterExit để hiển thị ảnh
              if (cameraComponentRef.current) {
                cameraComponentRef.current.displayEntryImagesAfterExit(
                  entryPlateUrl,
                  entryFaceUrl
                );
              }
            } else {
              console.log("ℹ️ No entry images found in session data");
            }
          } catch (imageError) {
            console.warn(
              "⚠️ Error loading/displaying entry images:",
              imageError
            );
            // Không throw error vì đây là tính năng phụ, không ảnh hưởng đến logic chính
          }

          const feeText =
            parkingFee > 0
              ? ` | Phí: ${new Intl.NumberFormat("vi-VN", {
                  style: "currency",
                  currency: "VND",
                }).format(parkingFee)}`
              : "";
          showToast(
            `Xe ra thành công! Thẻ: ${cardId}${feeText}`,
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
            `Xe ra thành công! Thẻ: ${cardId} (Lỗi tính phí: ${feeError.message})`,
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
      console.error("Error processing vehicle exit:", error);
      if (vehicleInfoComponentRef.current) {
        vehicleInfoComponentRef.current.updateCardReaderStatus(
          "LỖI XỬ LÝ XE RA",
          "#ef4444"
        );
      }
      showToast(`Lỗi xử lý xe ra: ${error.message}`, "error", 5000);
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
        getEffectiveWorkConfig()
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
          {currentUser && (
            <div className="user-info">
              <span className="user-name"> {currentUser.userCode}</span>
              <span className="config-separator">|</span>
              <span className={`user-role ${isAdmin() ? "admin" : "user"}`}>
                {isAdmin() ? "ADMIN" : "USER"}
              </span>
            </div>
          )}
        </div>

        <div className="toolbar-right">
          {false && hasPermission("canAccessConfig") && (
            <button
              className="toolbar-btn"
              onClick={openWorkConfig}
              title="Cấu hình làm việc"
            >
              CẤU HÌNH
            </button>
          )}
          {hasPermission("canAccessCamera") && (
            <button
              className="toolbar-btn"
              onClick={openCameraConfig}
              title="Cấu hình camera"
            >
              CAMERA
            </button>
          )}
          {hasPermission("canAccessPricing") && (
            <button
              className="toolbar-btn"
              onClick={openPricingPolicy}
              title="Chính sách giá cả"
            >
              GIÁ CẢ
            </button>
          )}
          {hasPermission("canAccessZone") && (
            <button
              className="toolbar-btn"
              onClick={openParkingZoneManagement}
              title="Quản lý khu vực"
            >
              KHU VỰC
            </button>
          )}
          {hasPermission("canAccessVehicle") && (
            <button
              className="toolbar-btn"
              onClick={openVehicleManagement}
              title="Quản lý phương tiện"
            >
              CHỦ PHƯƠNG TIỆN
            </button>
          )}
          {hasPermission("canAccessVehicleType") && (
            <button
              className="toolbar-btn"
              onClick={openVehicleType}
              title="Quản lý loại xe"
            >
              LOẠI XE
            </button>
          )}
          {isAdmin() && (
            <button
              className="toolbar-btn"
              onClick={openEmployeePermission}
              title="Quản lý phân quyền nhân viên"
            >
              NHÂN VIÊN
            </button>
          )}
          {hasPermission("canAccessRfid") && (
            <button
              className="toolbar-btn"
              onClick={openRfidManager}
              title="Quản lý thẻ RFID"
            >
              THẺ RFID
            </button>
          )}
          <button
            className="toolbar-btn attendance-btn"
            onClick={() => setShowAttendance(true)}
            title="Xem chấm công hôm nay"
          >
            CHẤM CÔNG
          </button>
          <button
            className={`toolbar-btn refresh-camera-btn ${
              isRestartingCamera ? "restarting disabled" : ""
            }`}
            onClick={handleRestartCameraSystem}
            disabled={isRestartingCamera}
            title={
              isRestartingCamera
                ? "Đang khởi động lại hệ thống camera và reset màn hình..."
                : "Khởi động lại toàn bộ hệ thống camera + Reset màn hình\n• RTSP Streaming Server\n• Face Recognition Service\n• ALPR Service\n• Reset UI toàn bộ\n\nSử dụng khi camera bị lỗi hoặc không hoạt động"
            }
          >
            {isRestartingCamera ? "🔄 RESTARTING..." : "🔄 REFRESH CAMERA"}
          </button>
          <button
            className={`toolbar-btn ${
              autoFaceRecognitionEnabled ? "active" : ""
            }`}
            onClick={() => {
              setAutoFaceRecognitionEnabled(!autoFaceRecognitionEnabled);
              showToast &&
                showToast(
                  `Auto Face Recognition ${
                    !autoFaceRecognitionEnabled ? "Bật" : "Tắt"
                  }`,
                  "info",
                  2000
                );
            }}
            title={`${
              autoFaceRecognitionEnabled ? "Tắt" : "Bật"
            } tự động nhận diện khuôn mặt`}
            style={{
              backgroundColor: autoFaceRecognitionEnabled
                ? "#10b981"
                : "#6b7280",
              color: "white",
            }}
          >
            {autoFaceRecognitionEnabled ? "🎯 AUTO ON" : "🎯 AUTO OFF"}
          </button>
          <button
            className="toolbar-btn settings-btn"
            onClick={openSystemSettings}
            title="Cài đặt hệ thống"
          >
            CÀI ĐẶT
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

        {/* Auto Face Recognition Status Indicator */}
        {autoFaceRecognitionEnabled && (
          <div
            style={{
              marginLeft: "auto",
              display: "flex",
              alignItems: "center",
              color: "#10b981",
              fontSize: "12px",
              fontWeight: "bold",
            }}
          >
            <span style={{ marginRight: "5px" }}>🎯</span>
            <span>
              AUTO MONITORING ({vehicleDatabase.length} vehicles)
              {isProcessingFace && (
                <span style={{ color: "#f59e0b" }}> • PROCESSING...</span>
              )}
            </span>
          </div>
        )}
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
              key={`camera-component-${cameraResetKey}`}
              ref={cameraComponentRef}
              currentMode={currentMode}
              zoneInfo={zoneInfo}
              workConfig={workConfig}
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
            workConfig={effectiveWorkConfigForComponents}
            onVehicleSelect={(vehicle) => {
              console.log("Selected vehicle:", vehicle);
            }}
          />
        </div>
      </div>

      {/* Hidden Logic Components */}
      <div style={{ display: "none" }}>
        <QuanLyCamera ref={cameraManagerRef} />
        <QuanLyXe ref={vehicleManagerRef} workConfig={workConfig} />
        <DauDocThe ref={cardReaderRef} currentMode={currentMode} />
      </div>

      {/* WorkConfigDialog hidden as requested */}
      {false && showWorkConfig && (
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
          onClose={() => {
            setShowRfidManager(false);
            setAutoOpenAddCard(false); // Reset auto-open state
            setPrefilledCardId(""); // Reset prefilled card ID
          }}
          onSave={() => {
            console.log("RFID cards updated");
            setShowRfidManager(false);
            setAutoOpenAddCard(false); // Reset auto-open state
            setPrefilledCardId(""); // Reset prefilled card ID
          }}
          autoOpenAddDialog={autoOpenAddCard}
          prefilledCardId={prefilledCardId}
        />
      )}

      {showVehicleManagement && (
        <VehicleManagementDialog
          onClose={() => setShowVehicleManagement(false)}
        />
      )}

      {showVehicleType && (
        <VehicleTypeDialog onClose={() => setShowVehicleType(false)} />
      )}

      {showEmployeePermission && (
        <EmployeePermissionDialog
          onClose={() => setShowEmployeePermission(false)}
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
            if (showLicensePlateError.onConfirm) {
              showLicensePlateError.onConfirm(result);
            } else {
              setShowLicensePlateError(false);
            }
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

      {/* Attendance Dialog */}
      <AttendanceDialog
        isOpen={showAttendance}
        onClose={() => setShowAttendance(false)}
      />

      {/* Toast Notifications */}
      <ToastContainer />

      {/* Background Upload Manager */}
      <BackgroundUploadManager />

      {/* Statistics Page Overlay */}
      {showStatistics && (
        <StatisticsPage onClose={() => setShowStatistics(false)} />
      )}

      {/* System Settings Dialog */}
      {showSystemSettings && (
        <SystemSettings onClose={() => setShowSystemSettings(false)} />
      )}

      {/* Camera Restart Overlay */}
      {isRestartingCamera && (
        <div className="camera-restart-overlay">
          <div className="camera-restart-content">
            <div className="camera-restart-spinner"></div>
            <div className="camera-restart-title">🔄 REFRESH CAMERA</div>
            <div className="camera-restart-message">
              {restartMessage || "Đang khởi động lại hệ thống camera..."}
            </div>
            <div className="camera-restart-progress">
              Vui lòng chờ trong giây lát...
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default MainUI;
