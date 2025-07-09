import React, { useState, useRef } from "react";
import {
  themPhienGuiXe,
  loadPhienGuiXeTheoMaThe,
  capNhatPhienGuiXe,
  tinhPhiGuiXe,
  loadPhienGuiXeTheoMaThe_XeRa,
} from "../api/api";
import { getCurrentDateTime } from "./timeUtils";

class VehicleManager {
  constructor() {
    this._activeParkingSessions = new Map();
    this.ui = null;
    this.vehicles = [];
  }

  setUI(uiInstance) {
    this.ui = uiInstance;
  }

  /**
   * Xử lý xe vào - Lấy loại xe từ cấu hình, không dùng policy string
   */
  async processVehicleEntry(
    cardId,
    imagePath,
    licensePlate,
    policy,
    entryGate,
    cameraId,
    faceImagePath = null,
    loaiXe = null
  ) {
    try {
      console.log(
        `🚗 DEBUG processVehicleEntry: loaiXe nhận vào = ${loaiXe} (type: ${typeof loaiXe})`
      );

      // Tự động xác định chính sách nếu chưa có - từ loaiXe thay vì currentVehicleType
      if (!policy && loaiXe !== null) {
        if (loaiXe === "0" || loaiXe === 0) {
          policy = "CS_XEMAY_4H";
          console.log(`📋 Auto policy từ loaiXe=0: ${policy}`);
        } else if (loaiXe === "1" || loaiXe === 1) {
          policy = "CS_OTO_4H";
          console.log(`📋 Auto policy từ loaiXe=1: ${policy}`);
        }
      }

      // Fallback chỉ khi loaiXe không có
      if (!policy && this.ui) {
        console.log(`⚠️ FALLBACK: Không có loaiXe, dùng currentVehicleType`);
        if (this.ui.currentVehicleType === "xe_may") {
          policy = "CS_XEMAY_4H";
        } else if (this.ui.currentVehicleType === "oto") {
          policy = "CS_OTO_4H";
        }
      }

      const entryTime = getCurrentDateTime();

      const session = {
        uidThe: cardId,
        bienSo: licensePlate || "",
        viTriGui: null,
        chinhSach: policy || null, // Không có default
        congVao: entryGate || null, // Không có default
        gioVao: entryTime,
        anhVao: imagePath || "",
        anhMatVao: faceImagePath || "",
        camera_id: cameraId || null, // Không có default
        loaiXe: loaiXe || null, // Từ cấu hình, không có default
      };

      console.log(`🚗 DEBUG: Session data với loaiXe từ config:`, session);

      const apiResult = await themPhienGuiXe(session);

      // Kiểm tra kết quả API đúng cách như Python
      let success = false;
      let errorMessage = "";

      if (typeof apiResult === "object" && apiResult !== null) {
        success = apiResult.success || false;
        errorMessage = apiResult.message || "";
      } else {
        // Fallback cho trường hợp API trả về format cũ (boolean)
        success = Boolean(apiResult);
      }

      if (success) {
        this._activeParkingSessions.set(cardId, session);

        // Xác định loại xe để hiển thị UI - CHÍNH XÁC từ loaiXe
        let vehicleTypeDisplay = null;
        if (loaiXe === "1" || loaiXe === 1) {
          vehicleTypeDisplay = "oto";
          console.log(`🚗 UI Display: Ô tô (loaiXe=${loaiXe})`);
        } else if (loaiXe === "0" || loaiXe === 0) {
          vehicleTypeDisplay = "xe_may";
          console.log(`🏍️ UI Display: Xe máy (loaiXe=${loaiXe})`);
        } else {
          // Fallback để tương thích với UI cũ
          vehicleTypeDisplay = this.ui?.currentVehicleType || null;
          console.log(`⚠️ UI Display: Fallback to ${vehicleTypeDisplay}`);
        }

        // Cập nhật thông tin xe vào UI
        if (this.ui) {
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
            loai_xe: vehicleTypeDisplay,
          };
          this.ui.updateVehicleInfo(vehicleEntryData);
        }
      }

      if (this.ui) {
        this.ui.updateVehicleEntryStatus(
          cardId,
          licensePlate,
          success,
          errorMessage
        );
      }

      // Return response dict như Python để có thể kiểm tra lỗi
      if (success) {
        return { success: true, message: "Xe vào thành công" };
      } else {
        return {
          success: false,
          message: errorMessage || "Lỗi xe vào không xác định",
        };
      }
    } catch (error) {
      console.error("❌ Lỗi xử lý xe vào:", error);
      if (this.ui) {
        this.ui.updateVehicleEntryStatus(
          cardId,
          licensePlate,
          false,
          error.message
        );
      }
      return { success: false, message: error.message };
    }
  }

  /**
   * Xử lý xe ra - Dựa trên logic Python với cải thiện tự động lấy cổng ra và camera
   */
  async processVehicleExit(
    cardId,
    exitImagePath,
    exitGate = null,
    cameraId = null,
    plateMatch = null,
    exitLicensePlate = null,
    exitFaceImagePath = null,
    zoneInfo = null,
    workConfig = null
  ) {
    console.log(
      "🚗 Xử lý xe ra:",
      cardId,
      exitGate,
      cameraId,
      plateMatch,
      exitLicensePlate
    );

    try {
      // Bước 1: Load phiên gửi xe theo mã thẻ
      console.log(
        `🔍 DEBUG: Gọi API loadPhienGuiXeTheoMaThe cho mã thẻ: ${cardId}`
      );
      const response = await loadPhienGuiXeTheoMaThe(cardId);

      console.log(`🔍 DEBUG: API Response type: ${typeof response}`);
      console.log(`🔍 DEBUG: API Response:`, response);

      // Xử lý response từ API như Python
      let session = null;
      if (Array.isArray(response) && response.length > 0) {
        session = response[0];
        console.log(`🔍 DEBUG: Lấy session từ list:`, session);
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
          console.log(`❌ API trả về lỗi: ${msg}`);
          if (this.ui) {
            this.ui.updateVehicleExitStatus(cardId, "", false, msg);
          }
          return { success: false, message: msg };
        }
      } else {
        const msg =
          "Không tìm thấy phiên gửi xe hoặc format response không đúng";
        console.log(`❌ ${msg}`);
        if (this.ui) {
          this.ui.updateVehicleExitStatus(cardId, "", false, msg);
        }
        return { success: false, message: msg };
      }

      if (!session) {
        const msg = "Dữ liệu phiên gửi xe trống";
        console.log(`❌ ${msg}`);
        if (this.ui) {
          this.ui.updateVehicleExitStatus(cardId, "", false, msg);
        }
        return { success: false, message: msg };
      }

      console.log(`🔍 DEBUG: Session object:`, session);

      // Tự động xác định cổng ra và camera ID từ zoneInfo FIRST
      console.log(
        `🔍 DEBUG VehicleManager: Checking zoneInfo for exit gate/camera:`,
        {
          zoneInfo: zoneInfo,
          hasCongRa: zoneInfo?.congRa ? true : false,
          congRaCount: zoneInfo?.congRa?.length || 0,
          hasCameraRa: zoneInfo?.cameraRa ? true : false,
          cameraRaCount: zoneInfo?.cameraRa?.length || 0,
          workConfig: workConfig,
        }
      );

      if (!exitGate) {
        exitGate = null; // Không có default
        if (zoneInfo?.congRa && zoneInfo.congRa.length > 0) {
          exitGate =
            zoneInfo.congRa[0].maCong || zoneInfo.congRa[0].tenCong || null;
        } else if (workConfig?.exit_gate) {
          exitGate = workConfig.exit_gate;
        }
        console.log(`🚪 VehicleManager: Tự động xác định cổng ra: ${exitGate}`);
      }

      if (!cameraId) {
        cameraId = null; // Không có default
        if (zoneInfo?.cameraRa && zoneInfo.cameraRa.length > 0) {
          cameraId = zoneInfo.cameraRa[0].maCamera || null;
        }
        console.log(
          `📹 VehicleManager: Tự động xác định camera ID: ${cameraId}`
        );
      }

      // Lấy thông tin từ session object
      const entryLicensePlate = session.bienSo || "";
      const entryImageUrl = session.anhVao || "";
      const sessionId = session.maPhien || "";

      console.log(
        `🔍 DEBUG: Biển số vào = '${entryLicensePlate}', Biển số ra = '${exitLicensePlate}'`
      );
      console.log(`🔍 DEBUG: URL ảnh vào = '${entryImageUrl}'`);
      console.log(`🔍 DEBUG: Mã phiên = '${sessionId}'`);

      // Hiển thị ảnh xe vào ngay lập tức
      if (this.ui && entryImageUrl) {
        this.ui.displayEntryVehicleImageInConfirmation(
          entryImageUrl,
          entryLicensePlate,
          cardId
        );
      }

      // Kiểm tra biển số có khớp không
      const licensePlatesMatch = this.checkLicensePlateMatch(
        entryLicensePlate,
        exitLicensePlate
      );
      console.log(`🔍 DEBUG: Kết quả kiểm tra khớp = ${licensePlatesMatch}`);

      if (!licensePlatesMatch && this.ui) {
        console.log("🚨 Hiển thị dialog lỗi biển số");
        const dialogResult = await this.handleLicensePlateError(
          cardId,
          entryLicensePlate,
          exitLicensePlate,
          exitImagePath,
          exitFaceImagePath
        );
        console.log(`🔍 DEBUG: Kết quả dialog = ${dialogResult}`);

        if (
          typeof dialogResult === "string" &&
          dialogResult.startsWith("xac_nhan:")
        ) {
          exitLicensePlate = dialogResult.split(":", 2)[1];
          console.log(`🔍 DEBUG: Biển số mới từ dialog = ${exitLicensePlate}`);
          licensePlatesMatch = true; // Người dùng đã xác nhận
        } else if (dialogResult === "huy") {
          return { success: false, message: "Người dùng hủy bỏ" };
        } else {
          return { success: false, message: "Xử lý lỗi biển số thất bại" };
        }
      }

      // Bước 2: Cập nhật phiên gửi xe (xe ra)
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

      console.log(`🔍 DEBUG: Cập nhật phiên gửi xe:`, sessionUpdate);
      const apiResult = await capNhatPhienGuiXe(sessionUpdate);

      // Kiểm tra kết quả API
      let success = false;
      let errorMessage = "";
      if (typeof apiResult === "object" && apiResult !== null) {
        success = apiResult.success || false;
        errorMessage = apiResult.message || "";
      } else {
        success = Boolean(apiResult);
      }

      if (success) {
        console.log("✅ Cập nhật xe ra thành công, bắt đầu tính phí...");

        // Bước 3: Tính phí gửi xe
        console.log(`🔍 DEBUG: Gọi tinhPhiGuiXe cho mã phiên: ${sessionId}`);
        const feeResult = await tinhPhiGuiXe(sessionId, cardId);
        console.log(`🔍 DEBUG: Kết quả tinhPhiGuiXe:`, feeResult);

        let calculatedFee = null;
        if (feeResult && feeResult.success) {
          calculatedFee = feeResult.phi || 0;
          console.log(`✅ Tính phí thành công: ${calculatedFee}`);
        } else {
          console.log(`⚠️ Lỗi tính phí: ${feeResult?.message}`);
        }

        // Bước 4: Load lại dữ liệu hoàn chỉnh từ server
        await this.loadAndDisplayVehicleExitData(
          cardId,
          calculatedFee,
          currentTime.toISOString().slice(0, 19).replace("T", " ")
        );

        console.log(`🔍 DEBUG: Hoàn tất xử lý xe ra cho mã thẻ ${cardId}.`);

        return { success: true, message: "Xe ra thành công" };
      } else {
        const msg = errorMessage || "Lỗi cập nhật phiên gửi xe";
        if (this.ui) {
          this.ui.updateVehicleExitStatus(
            cardId,
            entryLicensePlate,
            false,
            msg
          );
        }
        return { success: false, message: msg };
      }
    } catch (error) {
      console.log(`❌ Lỗi xử lý xe ra: ${error}`);
      console.error(error);
      if (this.ui) {
        this.ui.updateVehicleExitStatus(cardId, "", false, error.message);
      }
      return { success: false, message: error.message };
    }
  }

  /**
   * Load và hiển thị dữ liệu xe ra
   */
  async loadAndDisplayVehicleExitData(
    cardId,
    calculatedFee = null,
    actualExitTime = null
  ) {
    try {
      console.log(
        `🔍 DEBUG: Bắt đầu load dữ liệu hoàn chỉnh cho mã thẻ ${cardId}`
      );
      console.log(
        `🔍 DEBUG: Phí được tính toán: ${calculatedFee}, Giờ ra thực tế: ${actualExitTime}`
      );

      // Gọi API lấy dữ liệu phiên gửi xe
      const response = await loadPhienGuiXeTheoMaThe_XeRa(cardId);

      // Xử lý response
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
          console.log(`❌ Load dữ liệu thất bại: ${msg}`);
          if (this.ui) {
            this.ui.updateVehicleExitStatus(cardId, "", false, msg);
          }
          return;
        }
      } else {
        const msg = "Không có response từ server hoặc format không đúng";
        console.log(`❌ Load dữ liệu thất bại: ${msg}`);
        if (this.ui) {
          this.ui.updateVehicleExitStatus(cardId, "", false, msg);
        }
        return;
      }

      if (!session) {
        console.log("❌ Không tìm thấy phiên gửi xe");
        if (this.ui) {
          this.ui.updateVehicleExitStatus(
            cardId,
            "",
            false,
            "Không tìm thấy phiên gửi xe"
          );
        }
        return;
      }

      console.log(`🔍 DEBUG: Session object nhận được:`, session);

      // Chuyển đổi dữ liệu sang format UI
      const vehicleData = this.convertSessionObjectToUI(
        session,
        calculatedFee,
        actualExitTime
      );
      console.log(`🔍 DEBUG: Dữ liệu UI được tạo:`, vehicleData);

      if (this.ui) {
        console.log(`🔍 DEBUG: Cập nhật UI với dữ liệu:`, vehicleData);

        // Cập nhật thông tin xe lên UI
        this.ui.updateVehicleInfo(vehicleData);

        // Cập nhật danh sách xe
        this.updateVehicleInList(vehicleData);
        this.ui.updateVehicleList(vehicleData, false);

        // Cập nhật trạng thái thành công
        this.ui.updateVehicleExitStatus(
          cardId,
          vehicleData.bien_so,
          true,
          "Xe ra thành công"
        );

        // Hiển thị ảnh vào sau khi xe ra thành công
        const entryImageUrl = session.anhVao || "";
        const entryFaceImageUrl = session.anhMatVao || "";

        console.log(
          `🎯 Gọi hiển thị ảnh vào sau xe ra thành công - Xe: ${entryImageUrl}, Face: ${entryFaceImageUrl}`
        );

        // Gọi method hiển thị ảnh vào trên camera frames
        this.ui.displayEntryImagesAfterSuccessfulExit(
          entryImageUrl,
          entryFaceImageUrl
        );

        // Đặt timer khôi phục camera sau 3 giây
        setTimeout(() => {
          this.ui.restoreLiveCameraFeeds();
        }, 3000);

        console.log(
          `✅ Đã load và hiển thị dữ liệu hoàn chỉnh cho mã thẻ ${cardId}`
        );
      }
    } catch (error) {
      console.log(`❌ Lỗi load và hiển thị dữ liệu: ${error}`);
      console.error(error);
      if (this.ui) {
        this.ui.updateVehicleExitStatus(
          cardId,
          "",
          false,
          `Lỗi load dữ liệu: ${error.message}`
        );
      }
    }
  }

  /**
   * Chuyển đổi session object từ API response sang format UI
   */
  convertSessionObjectToUI(
    session,
    overrideFee = null,
    overrideExitTime = null
  ) {
    try {
      // Lấy dữ liệu từ session object
      const entryTimeStr = session.gioVao || "";
      const exitTimeStr = overrideExitTime || session.gioRa || "";
      const licensePlate = session.bienSo || "";
      const cardId = session.uidThe || "";
      const policy = session.chinhSach || "";
      const entryGate = session.congVao || "";
      const exitGate = session.congRa || "";
      const feeValue = overrideFee !== null ? overrideFee : session.phi || "";

      console.log(`🔍 DEBUG: Trích xuất dữ liệu từ session:`);
      console.log(`  - Biển số: ${licensePlate}`);
      console.log(`  - Giờ vào: ${entryTimeStr}`);
      console.log(`  - Giờ ra: ${exitTimeStr}`);
      console.log(`  - Phí: ${feeValue}`);

      // Tính thời gian đỗ
      let parkingDurationFormatted = "";
      if (entryTimeStr && exitTimeStr) {
        try {
          const entryTime = new Date(entryTimeStr);
          const exitTime = new Date(exitTimeStr);
          const durationMs = exitTime - entryTime;

          const hours = Math.floor(durationMs / (1000 * 60 * 60));
          const minutes = Math.floor(
            (durationMs % (1000 * 60 * 60)) / (1000 * 60)
          );
          parkingDurationFormatted = `${hours}h ${minutes}m`;
        } catch (error) {
          console.log(`⚠️ Lỗi tính thời gian đỗ: ${error}`);
          parkingDurationFormatted = "N/A";
        }
      }

      // Format phí for display
      let feeFormatted = "";
      if (feeValue) {
        try {
          const fee = parseInt(feeValue);
          feeFormatted = `${fee.toLocaleString()} VNĐ`;
        } catch {
          feeFormatted = String(feeValue);
        }
      }

      // Xác định loại xe dựa trên loaiXe thay vì policy
      // loaiXe = 0: xe máy, xe đạp, xe 2 bánh
      // loaiXe = 1: ô tô, xe hơi, xe tải, xe lớn
      let vehicleType = "xe_may"; // mặc định
      const loaiXe = session.loaiXe;

      console.log(
        `🚗 DEBUG: loaiXe từ session = ${loaiXe} (type: ${typeof loaiXe})`
      );

      if (loaiXe === 1 || loaiXe === "1") {
        vehicleType = "oto";
        console.log(`🚗 Phân loại: Ô tô/xe lớn (loaiXe = ${loaiXe})`);
      } else if (loaiXe === 0 || loaiXe === "0") {
        vehicleType = "xe_may";
        console.log(`🏍️ Phân loại: Xe máy/2 bánh (loaiXe = ${loaiXe})`);
      } else {
        // Fallback: nếu không có loaiXe, dùng policy làm backup
        if (
          policy.toLowerCase().includes("oto") ||
          policy.toLowerCase().includes("xe_hoi") ||
          policy.includes("CS_OTO")
        ) {
          vehicleType = "oto";
          console.log(`🚗 Fallback: Phân loại từ policy -> Ô tô`);
        } else {
          vehicleType = "xe_may";
          console.log(`🏍️ Fallback: Phân loại từ policy -> Xe máy`);
        }
      }

      // Tạo dữ liệu UI
      const vehicleData = {
        bien_so: licensePlate,
        gio_vao: entryTimeStr,
        gio_ra: exitTimeStr,
        ma_the: cardId,
        ma_phien: session.maPhien || session.sessionId || "", // Add session ID for fee calculation
        thoi_gian_do: parkingDurationFormatted,
        phi: feeFormatted,
        phi_gui_xe: feeValue, // Pass raw fee value for calculations
        cong_vao: entryGate,
        cong_ra: exitGate,
        chinh_sach: policy,
        trang_thai: exitTimeStr ? "Đã ra" : "Trong bãi",
        loai_xe: vehicleType,
        nhan_dien_boi_api: (session.plate_match || 0) === 1,
        da_xac_minh: true,
      };

      console.log(`🔍 DEBUG: Dữ liệu UI được tạo:`, vehicleData);
      return vehicleData;
    } catch (error) {
      console.log(`❌ Lỗi chuyển đổi session object: ${error}`);
      console.error(error);

      // Fallback data
      return {
        bien_so: session.bienSo || "",
        gio_vao: session.gioVao || "",
        gio_ra: session.gioRa || "",
        ma_the: session.uidThe || "",
        ma_phien: session.maPhien || session.sessionId || "", // Add session ID for fee calculation
        thoi_gian_do: "",
        phi: "",
        phi_gui_xe: session.phi || 0, // Pass raw fee for fallback
        cong_vao: session.congVao || "",
        cong_ra: session.congRa || "",
        chinh_sach: session.chinhSach || "",
        trang_thai: "Lỗi dữ liệu",
        loai_xe: "xe_may",
        nhan_dien_boi_api: false,
        da_xac_minh: false,
      };
    }
  }

  /**
   * Kiểm tra xem biển số có khớp không
   */
  checkLicensePlateMatch(entryLicensePlate, exitLicensePlate) {
    if (!entryLicensePlate || !exitLicensePlate) {
      return false;
    }

    // Chuẩn hóa biển số (loại bỏ khoảng trắng, chuyển hoa)
    const entryClean = String(entryLicensePlate)
      .trim()
      .toUpperCase()
      .replace(/[\s\-]/g, "");
    const exitClean = String(exitLicensePlate)
      .trim()
      .toUpperCase()
      .replace(/[\s\-]/g, "");

    console.log(`So sánh biển số: '${entryClean}' vs '${exitClean}'`);

    // Kiểm tra khớp chính xác TRƯỚC
    if (entryClean === exitClean) {
      console.log("Biển số khớp chính xác");
      return true;
    }

    // Nếu độ dài khác nhau quá 2 ký tự -> không khớp
    if (Math.abs(entryClean.length - exitClean.length) > 2) {
      console.log("Biển số khác nhau quá nhiều về độ dài");
      return false;
    }

    // Kiểm tra độ tương đồng (similarity)
    const similarity = this.calculateStringSimilarity(entryClean, exitClean);

    console.log(`Độ tương đồng: ${(similarity * 100).toFixed(1)}%`);
    // Giảm threshold xuống 95% để chặt chẽ hơn
    const isSimilar = similarity >= 0.95;

    if (isSimilar) {
      console.log("Biển số được coi là khớp (similarity >= 95%)");
    } else {
      console.log("Biển số KHÔNG khớp (similarity < 95%)");
    }

    return isSimilar;
  }

  /**
   * Tính độ tương đồng giữa 2 chuỗi
   */
  calculateStringSimilarity(str1, str2) {
    const longer = str1.length > str2.length ? str1 : str2;
    const shorter = str1.length > str2.length ? str2 : str1;

    if (longer.length === 0) {
      return 1.0;
    }

    const distance = this.levenshteinDistance(longer, shorter);
    return (longer.length - distance) / longer.length;
  }

  /**
   * Tính khoảng cách Levenshtein
   */
  levenshteinDistance(str1, str2) {
    const matrix = [];

    for (let i = 0; i <= str2.length; i++) {
      matrix[i] = [i];
    }

    for (let j = 0; j <= str1.length; j++) {
      matrix[0][j] = j;
    }

    for (let i = 1; i <= str2.length; i++) {
      for (let j = 1; j <= str1.length; j++) {
        if (str2.charAt(i - 1) === str1.charAt(j - 1)) {
          matrix[i][j] = matrix[i - 1][j - 1];
        } else {
          matrix[i][j] = Math.min(
            matrix[i - 1][j - 1] + 1, // substitution
            matrix[i][j - 1] + 1, // insertion
            matrix[i - 1][j] + 1 // deletion
          );
        }
      }
    }

    return matrix[str2.length][str1.length];
  }

  /**
   * Xử lý khi biển số không khớp
   */
  async handleLicensePlateError(
    cardId,
    entryLicensePlate,
    exitLicensePlate,
    exitImagePath,
    exitFaceImagePath = null
  ) {
    try {
      // Lấy URL ảnh vào từ session hiện tại
      const response = await loadPhienGuiXeTheoMaThe(cardId);
      let entryImageUrl = null;
      let entryFaceImageUrl = null;

      if (response) {
        let session = null;
        if (Array.isArray(response) && response.length > 0) {
          session = response[0];
        } else if (
          typeof response === "object" &&
          response !== null &&
          response.success &&
          response.data
        ) {
          const data = response.data;
          session = Array.isArray(data) && data.length > 0 ? data[0] : data;
        } else if (response && typeof response === "object") {
          session = response;
        }

        if (session) {
          entryImageUrl = session.anhVao || "";
          entryFaceImageUrl = session.anhMatVao || "";
          console.log(`🔍 DEBUG Dialog: URL ảnh vào: ${entryImageUrl}`);
          console.log(`🔍 DEBUG Dialog: URL ảnh mặt vào: ${entryFaceImageUrl}`);
        }
      }

      // Hiển thị dialog với thông tin biển số không khớp
      if (this.ui && this.ui.showLicensePlateErrorDialog) {
        const dialogResult = await this.ui.showLicensePlateErrorDialog({
          cardId,
          entryLicensePlate,
          exitLicensePlate,
          exitImagePath,
          entryImageUrl,
          entryFaceImageUrl,
          exitFaceImagePath,
        });

        console.log(
          `🔍 DEBUG Dialog: Kết quả = ${dialogResult.action}, Biển số = ${dialogResult.licensePlate}`
        );

        if (dialogResult.action === "confirm" && dialogResult.licensePlate) {
          return `xac_nhan:${dialogResult.licensePlate}`;
        } else {
          return dialogResult.action || "huy";
        }
      }

      return "huy";
    } catch (error) {
      console.log(`❌ Lỗi hiển thị dialog: ${error}`);
      console.error(error);
      return "huy";
    }
  }

  /**
   * Cập nhật hoặc thêm xe vào danh sách quản lý
   */
  updateVehicleInList(vehicleData) {
    const cardId = vehicleData.ma_the;
    const licensePlate = vehicleData.bien_so;

    // Tìm xe trong danh sách
    const existingVehicleIndex = this.vehicles.findIndex(
      (vehicle) => vehicle.ma_the === cardId
    );

    if (existingVehicleIndex !== -1) {
      // Cập nhật xe hiện có
      this.vehicles[existingVehicleIndex] = {
        ...this.vehicles[existingVehicleIndex],
        ...vehicleData,
      };
      console.log(`✅ Đã cập nhật xe ${licensePlate} trong danh sách`);
    } else {
      // Thêm xe mới
      this.vehicles.push(vehicleData);
      console.log(`✅ Đã thêm xe ${licensePlate} vào danh sách`);
    }
  }

  /**
   * Quay lại chế độ quản lý
   */
  returnToManagementMode() {
    if (this.ui) {
      // Khôi phục tất cả camera về chế độ live feed
      this.ui.restoreLiveCameraFeeds();
      // Chuyển về chế độ quản lý
      this.ui.switchMode("quan_ly");
    }
  }

  /**
   * Lấy danh sách xe hiện tại
   */
  getVehicles() {
    return this.vehicles;
  }

  /**
   * Lấy phiên gửi xe đang hoạt động
   */
  getActiveParkingSessions() {
    return this._activeParkingSessions;
  }
}

export default VehicleManager;
