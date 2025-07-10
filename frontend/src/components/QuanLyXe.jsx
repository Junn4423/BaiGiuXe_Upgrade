"use client";

import React, { useState, useEffect } from "react";
import { useVehicleManager } from "../utils/useVehicleManager";
import { getCurrentDateTime } from "../utils/timeUtils";
import LicensePlateErrorDialog from "./LicensePlateErrorDialog";
import VehicleStatusNotification, {
  VehicleNotificationContainer,
} from "./VehicleStatusNotification";

const QuanLyXe = ({ workConfig }) => {
  const {
    vehicles,
    activeSessions,
    isProcessing,
    lastError,
    setUI,
    processVehicleEntry,
    processVehicleExit,
    getVehicleByCardId,
    isVehicleParked,
    getParkingStatistics,
    clearError,
    refreshVehicleData,
  } = useVehicleManager();

  const [ui, setUiState] = useState(null);
  const [showLicensePlateDialog, setShowLicensePlateDialog] = useState(false);
  const [licensePlateDialogData, setLicensePlateDialogData] = useState(null);
  const [licensePlateDialogResolver, setLicensePlateDialogResolver] =
    useState(null);

  // Process vehicle entry
  const handleProcessVehicleEntry = async (
    cardId,
    imagePath,
    licensePlate,
    policy,
    entryGate,
    cameraId,
    faceImagePath = null
  ) => {
    // Auto-determine policy if not provided
    if (!policy) {
      // Use workConfig to determine vehicle type and policy
      if (workConfig?.loai_xe) {
        if (workConfig.loai_xe === "oto") {
          policy = "CS_OTO_4H";
        } else if (workConfig.loai_xe === "xe_may") {
          policy = "CS_XEMAY_4H";
        }
      } else if (ui) {
        // Fallback to UI state if workConfig not available
        if (ui.currentMode === "vao") {
          if (ui.currentVehicleType === "xe_may") {
            policy = "CS_XEMAY_4H";
          } else if (ui.currentVehicleType === "oto") {
            policy = "CS_OTO_4H";
          }
        }
      }
    }

    // Calculate loaiXe from workConfig
    let loaiXe = "0"; // Default: small vehicle
    if (workConfig?.loai_xe) {
      if (workConfig.loai_xe === "oto") {
        loaiXe = "1"; // Large vehicle
      } else if (workConfig.loai_xe === "xe_may") {
        loaiXe = "0"; // Small vehicle
      }
    } else if (ui && ui.currentVehicleType) {
      // Fallback to UI state
      if (ui.currentVehicleType === "oto") {
        loaiXe = "1";
      } else {
        loaiXe = "0";
      }
    }

    console.log(`🚗 QuanLyXe: Determined loaiXe = ${loaiXe} from workConfig.loai_xe = ${workConfig?.loai_xe}`);

    const entryTime = getCurrentDateTime();
    const session = {
      uidThe: cardId,
      bienSo: licensePlate || "",
      viTriGui: loaiXe === "1" ? "A01" : undefined, // Only set parking spot for large vehicles
      chinhSach: policy || "CS_XEMAY_4H", // Default policy if not provided
      congVao: entryGate || "GATE01", // Default gate if not provided
      gioVao: entryTime,
      anhVao: imagePath || "",
      anhMatVao: faceImagePath || "",
      trangThai: "TRONG_BAI", // Explicitly set status
      camera_id: cameraId || "CAM001", // Default camera ID if not provided
      plate_match: licensePlate ? 1 : 0, // 1 if license plate provided, 0 otherwise
      plate: licensePlate || "",
      loaiXe: loaiXe, // Add loaiXe to session data
    };

    try {
      const apiResult = await themPhienGuiXe(session);

      let success = false;
      let errorMessage = "";

      if (typeof apiResult === "object" && apiResult !== null) {
        success = apiResult.success || false;
        errorMessage = apiResult.message || "";
      } else {
        success = Boolean(apiResult);
      }

      if (success) {
        setActiveParkingSessions((prev) => ({ ...prev, [cardId]: session }));

        // Update vehicle info in UI
        if (ui) {
          const vehicleEntryData = {
            bien_so: licensePlate || "",
            gio_vao: entryTime,
            gio_ra: "",
            ma_the: cardId,
            thoi_gian_do: "",
            phi: "",
            chinh_sach: policy || "",
            cong_vao: entryGate,
            cong_ra: "",
            trang_thai: "Trong bãi",
            loai_xe: ui.currentVehicleType || "xe_may",
          };
          ui.updateVehicleInfo(vehicleEntryData);
        }
      }

      if (ui) {
        ui.updateVehicleEntryStatus(
          cardId,
          licensePlate,
          success,
          errorMessage
        );
      }

      return success
        ? { success: true, message: "Xe vào thành công" }
        : {
            success: false,
            message: errorMessage || "Lỗi xe vào không xác định",
          };
    } catch (error) {
      console.error("Error processing vehicle entry:", error);
      return { success: false, message: error.message };
    }
  };

  // Process vehicle exit
  const handleProcessVehicleExit = async (
    cardId,
    exitImagePath,
    exitGate,
    cameraId,
    plateMatch = null,
    exitLicensePlate = null,
    exitFaceImagePath = null
  ) => {
    try {
      // Step 1: Load parking session by card ID
      const response = await loadPhienGuiXeTheoMaThe(cardId);

      // Process response from API
      let session = null;
      if (Array.isArray(response) && response.length > 0) {
        session = response[0];
      } else if (typeof response === "object" && response !== null) {
        if (response.success && response.data) {
          const data = response.data;
          if (Array.isArray(data) && data.length > 0) {
            session = data[0];
          } else {
            session = data;
          }
        } else {
          const msg = response.message || "Không tìm thấy phiên gửi xe";
          if (ui) {
            ui.updateVehicleExitStatus(cardId, "", false, msg);
          }
          return { success: false, message: msg };
        }
      } else {
        const msg =
          "Không tìm thấy phiên gửi xe hoặc format response không đúng";
        if (ui) {
          ui.updateVehicleExitStatus(cardId, "", false, msg);
        }
        return { success: false, message: msg };
      }

      if (!session) {
        const msg = "Dữ liệu phiên gửi xe trống";
        if (ui) {
          ui.updateVehicleExitStatus(cardId, "", false, msg);
        }
        return { success: false, message: msg };
      }

      // Get information from session object
      const entryLicensePlate = session.bienSo || "";
      const entryImageUrl = session.anhVao || "";
      const sessionId = session.maPhien || "";

      // Display entry image immediately
      if (ui && entryImageUrl) {
        ui.displayEntryVehicleImageInConfirmation(
          entryImageUrl,
          entryLicensePlate,
          cardId
        );
      }

      // Check if license plates match
      const licensePlatesMatch = checkLicensePlateMatch(
        entryLicensePlate,
        exitLicensePlate
      );

      if (!licensePlatesMatch && ui) {
        const dialogResult = await handleLicensePlateError(
          cardId,
          entryLicensePlate,
          exitLicensePlate,
          exitImagePath,
          exitFaceImagePath
        );

        if (
          typeof dialogResult === "string" &&
          dialogResult.startsWith("xac_nhan:")
        ) {
          exitLicensePlate = dialogResult.split(":", 2)[1];
          const licensePlatesMatch = true; // User confirmed
        } else if (dialogResult === "huy") {
          return { success: false, message: "Người dùng hủy bỏ" };
        } else {
          return { success: false, message: "Xử lý lỗi biển số thất bại" };
        }
      }

      // Step 2: Update parking session (vehicle exit)
      const currentTime = new Date();
      const sessionUpdate = {
        maPhien: sessionId,
        uidThe: cardId,
        bienSo: entryLicensePlate,
        viTriGui: session.viTriGui,
        chinhSach: session.chinhSach || "",
        congVao: session.congVao || "",
        gioVao: session.gioVao || "",
        anhVao: session.anhVao || "",
        anhMatVao: session.anhMatVao || "",
        trangThai: "DA_RA",
        congRa: exitGate,
        gioRa: getCurrentDateTime(),
        anhRa: exitImagePath,
        anhMatRa: exitFaceImagePath || "",
        camera_id: cameraId,
        plate_match: licensePlatesMatch ? 1 : 0,
        plate: exitLicensePlate,
      };

      const apiResult = await capNhatPhienGuiXe(sessionUpdate);

      // Check API result
      let success = false;
      let errorMessage = "";
      if (typeof apiResult === "object" && apiResult !== null) {
        success = apiResult.success || false;
        errorMessage = apiResult.message || "";
      } else {
        success = Boolean(apiResult);
      }

      if (success) {
        // Step 3: Calculate parking fee
        const feeResult = await tinhPhiGuiXe(sessionId, cardId);

        let calculatedFee = null;
        if (feeResult && feeResult.success) {
          calculatedFee = feeResult.phi || 0;
        }

        // Step 4: Load and display complete data from server
        await loadAndDisplayVehicleExitData(
          cardId,
          calculatedFee,
          currentTime.toISOString().slice(0, 19).replace("T", " ")
        );

        return { success: true, message: "Xe ra thành công" };
      } else {
        const msg = errorMessage || "Lỗi cập nhật phiên gửi xe";
        if (ui) {
          ui.updateVehicleExitStatus(cardId, entryLicensePlate, false, msg);
        }
        return { success: false, message: msg };
      }
    } catch (error) {
      if (ui) {
        ui.updateVehicleExitStatus(cardId, "", false, error.message);
      }
      return { success: false, message: error.message };
    }
  };

  // Load and display vehicle exit data
  const loadAndDisplayVehicleExitData = async (
    cardId,
    calculatedFee = null,
    actualExitTime = null
  ) => {
    try {
      // Call API to get parking session data
      const response = await loadPhienGuiXeTheoMaThe_XeRa(cardId);

      // Process response
      let session = null;
      if (Array.isArray(response) && response.length > 0) {
        session = response[0];
      } else if (typeof response === "object" && response !== null) {
        if (response.success && response.data) {
          const data = response.data;
          if (Array.isArray(data) && data.length > 0) {
            session = data[0];
          } else {
            session = data;
          }
        } else {
          const msg = response.message || "Lỗi load dữ liệu từ server";
          if (ui) {
            ui.updateVehicleExitStatus(cardId, "", false, msg);
          }
          return;
        }
      } else {
        const msg = "Không có response từ server hoặc format không đ��ng";
        if (ui) {
          ui.updateVehicleExitStatus(cardId, "", false, msg);
        }
        return;
      }

      if (!session) {
        if (ui) {
          ui.updateVehicleExitStatus(
            cardId,
            "",
            false,
            "Không tìm thấy phiên gửi xe"
          );
        }
        return;
      }

      // Convert session object to UI format
      const vehicleData = convertSessionObjectToUI(
        session,
        calculatedFee,
        actualExitTime
      );

      if (ui) {
        // Update vehicle info in UI
        ui.updateVehicleInfo(vehicleData);

        // Update vehicle list
        updateVehicleInList(vehicleData);
        ui.updateVehicleList(vehicleData, false);

        // Update status to success
        ui.updateVehicleExitStatus(
          cardId,
          vehicleData.bien_so,
          true,
          "Xe ra thành công"
        );

        // **DISPLAY ENTRY IMAGES AFTER SUCCESSFUL EXIT**
        // Get entry image and face image URLs from session
        const entryImageUrl = session.anhVao || "";
        const entryFaceUrl = session.anhMatVao || "";

        // Call method to display entry images on camera frames
        ui.displayEntryImagesAfterExit(entryImageUrl, entryFaceUrl);

        // Set timer to restore camera after 3 seconds
        setTimeout(() => {
          if (ui.restoreLiveCameraFeeds) {
            ui.restoreLiveCameraFeeds();
          }
        }, 3000);
      }
    } catch (error) {
      if (ui) {
        ui.updateVehicleExitStatus(
          cardId,
          "",
          false,
          `Lỗi load dữ liệu: ${error.message}`
        );
      }
    }
  };

  // Convert session object to UI format
  const convertSessionObjectToUI = (
    session,
    overrideFee = null,
    overrideExitTime = null
  ) => {
    try {
      // Get data from session object
      const entryTimeStr = session.gioVao || "";
      const exitTimeStr =
        overrideExitTime !== null ? overrideExitTime : session.gioRa || "";
      const licensePlate = session.bienSo || "";
      const cardId = session.uidThe || "";
      const policy = session.chinhSach || "";
      const entryGate = session.congVao || "";
      const exitGate = session.congRa || "";
      const feeValue = overrideFee !== null ? overrideFee : session.phi || "";

      // Calculate parking duration
      let parkingDurationFormatted = "";
      if (entryTimeStr && exitTimeStr) {
        try {
          const entryTime = new Date(entryTimeStr);
          const exitTime = new Date(exitTimeStr);
          const duration = exitTime - entryTime;

          const hours = Math.floor(duration / (1000 * 60 * 60));
          const minutes = Math.floor(
            (duration % (1000 * 60 * 60)) / (1000 * 60)
          );
          parkingDurationFormatted = `${hours}h ${minutes}m`;
        } catch (e) {
          parkingDurationFormatted = "N/A";
        }
      }

      // Format fee
      let feeFormatted = "";
      if (feeValue) {
        try {
          const fee = Number.parseInt(feeValue);
          feeFormatted = `${fee.toLocaleString()} VND`;
        } catch {
          feeFormatted = String(feeValue);
        }
      }

      // Determine vehicle type
      let vehicleType = "xe_may"; // default
      if (
        policy &&
        (policy.toLowerCase().includes("oto") ||
          policy.toLowerCase().includes("xe_hoi") ||
          policy.includes("CS_OTO"))
      ) {
        vehicleType = "oto";
      }

      // Create UI data
      const vehicleData = {
        bien_so: licensePlate,
        gio_vao: entryTimeStr,
        gio_ra: exitTimeStr,
        ma_the: cardId,
        thoi_gian_do: parkingDurationFormatted,
        phi: feeFormatted,
        cong_vao: entryGate,
        cong_ra: exitGate,
        chinh_sach: policy,
        trang_thai: exitTimeStr ? "Đã ra" : "Trong bãi",
        loai_xe: vehicleType,
        nhan_dien_boi_api: (session.plate_match || 0) === 1,
        da_xac_minh: true,
      };

      return vehicleData;
    } catch (error) {
      // Fallback data
      return {
        bien_so: session.bienSo || "",
        gio_vao: session.gioVao || "",
        gio_ra: session.gioRa || "",
        ma_the: session.uidThe || "",
        thoi_gian_do: "",
        phi: "",
        cong_vao: session.congVao || "",
        cong_ra: session.congRa || "",
        chinh_sach: session.chinhSach || "",
        trang_thai: "Lỗi dữ liệu",
        loai_xe: "xe_may",
        nhan_dien_boi_api: false,
        da_xac_minh: false,
      };
    }
  };

  // Check license plate match
  const checkLicensePlateMatch = (entryPlate, exitPlate) => {
    if (!entryPlate || !exitPlate) {
      return false;
    }

    // Normalize license plates (remove spaces, convert to uppercase)
    const entryClean = String(entryPlate)
      .trim()
      .toUpperCase()
      .replace(/[ -]/g, "");
    const exitClean = String(exitPlate)
      .trim()
      .toUpperCase()
      .replace(/[ -]/g, "");

    // Check exact match FIRST
    if (entryClean === exitClean) {
      return true;
    }

    // **ADD STRICTER CHECK**
    // If length difference is more than 2 characters -> no match
    if (Math.abs(entryClean.length - exitClean.length) > 2) {
      return false;
    }

    // Check match with tolerance but STRICTER
    let sameChars = 0;
    for (let i = 0; i < Math.min(entryClean.length, exitClean.length); i++) {
      if (entryClean[i] === exitClean[i]) {
        sameChars++;
      }
    }
    const similarity =
      sameChars / Math.max(entryClean.length, exitClean.length);

    // **REDUCE THRESHOLD TO 95%** for stricter matching
    const isMatch = similarity >= 0.95;

    return isMatch;
  };

  // Handle license plate error
  const handleLicensePlateError = async (
    cardId,
    entryPlate,
    exitPlate,
    exitImage,
    exitFaceImage = null
  ) => {
    try {
      // This would show a dialog in the actual implementation
      // For now, return a mock result
      const userConfirmed = window.confirm(
        `Biển số không khớp!\nBiển số vào: ${entryPlate}\nBiển số ra: ${exitPlate}\n\nBạn có muốn xác nhận xe ra không?`
      );

      if (userConfirmed) {
        const correctedPlate = window.prompt(
          "Nhập biển số chính xác:",
          exitPlate
        );
        if (correctedPlate) {
          return `xac_nhan:${correctedPlate}`;
        }
      }

      return "huy";
    } catch (error) {
      return "huy";
    }
  };

  // Update vehicle in list
  const updateVehicleInList = (vehicleData) => {
    // Create list if it doesn't exist
    if (!Array.isArray(vehicles)) {
      setVehicles([]);
    }

    const cardId = vehicleData.ma_the;
    const licensePlate = vehicleData.bien_so;

    // Find vehicle in list
    const existingVehicleIndex = vehicles.findIndex(
      (vehicle) => vehicle.ma_the === cardId
    );

    if (existingVehicleIndex !== -1) {
      // Update existing vehicle
      const updatedVehicles = [...vehicles];
      updatedVehicles[existingVehicleIndex] = {
        ...updatedVehicles[existingVehicleIndex],
        ...vehicleData,
      };
      setVehicles(updatedVehicles);
    } else {
      // Add new vehicle
      setVehicles((prev) => [...prev, vehicleData]);
    }
  };

  // Set UI reference
  const setUIReference = (uiRef) => {
    setUi(uiRef);
  };

  // Expose methods to parent component
  React.useImperativeHandle(
    React.forwardRef(() => null),
    () => ({
      processVehicleEntry: handleProcessVehicleEntry,
      processVehicleExit: handleProcessVehicleExit,
      setUIReference,
      updateVehicleInList,
    })
  );

  return (
    <div>
      <h3>QuanLyXe Logic (No UI)</h3>
      {/* Vehicle management logic only */}
    </div>
  );
};

export default QuanLyXe;
