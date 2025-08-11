"use client";
import React, { useState, useEffect } from "react";
import { useToast } from "../components/Toast";
import RelayControl from "../components/RelayControl";
import "../assets/styles/SystemSettings.css";

const SystemSettings = ({ onClose }) => {
  const { showToast } = useToast();
  const [imageStoragePath, setImageStoragePath] = useState("");
  const [isLocalStorageEnabled, setIsLocalStorageEnabled] = useState(true); // Default to true since we use local storage
  const [loading, setLoading] = useState(false);
  const [showRelayControl, setShowRelayControl] = useState(false);

  useEffect(() => {
    loadSettings();
  }, []);

  const loadSettings = () => {
    try {
      const savedPath =
        localStorage.getItem("image_storage_path") || "C:/ParkingLot_Images";
      const savedEnabled =
        localStorage.getItem("local_storage_enabled") === "true" ||
        localStorage.getItem("local_storage_enabled") === null; // Default to true if not set

      // Check if saved path is the old Documents path and clear it
      if (
        savedPath &&
        (savedPath.includes("Documents\\ParkingLotApp") ||
          savedPath.includes("Documents/ParkingLotApp"))
      ) {
        console.warn("⚠️ Detected old storage path, clearing it:", savedPath);
        localStorage.removeItem("image_storage_path");
        setImageStoragePath("C:/ParkingLot_Images");
        showToast(
          "Đã phát hiện và xóa đường dẫn cũ. Hệ thống sẽ sử dụng thư mục mặc định C:/ParkingLot_Images/",
          "info"
        );
      } else {
        setImageStoragePath(savedPath);
      }

      setIsLocalStorageEnabled(savedEnabled);
    } catch (error) {
      console.error("Lỗi tải cài đặt:", error);
    }
  };

  const handleSelectFolder = async () => {
    try {
      if (window.electronAPI) {
        // Electron environment
        const selectedPath = await window.electronAPI.chooseSaveDirectory();
        if (selectedPath) {
          setImageStoragePath(selectedPath);
          showToast("Đã chọn thư mục thành công", "success");
        }
      } else {
        // Web environment - show directory picker if available
        if ("showDirectoryPicker" in window) {
          const dirHandle = await window.showDirectoryPicker();
          setImageStoragePath(dirHandle.name);
          showToast("Đã chọn thư mục (Web mode)", "success");
        } else {
          showToast(
            "Chức năng chọn thư mục không khả dụng trên trình duyệt này",
            "warning"
          );
        }
      }
    } catch (error) {
      console.error("Lỗi chọn thư mục:", error);
      if (error.message && error.message.includes("User cancelled")) {
        console.log("Người dùng đã hủy chọn thư mục");
      } else {
        showToast("Lỗi chọn thư mục", "error");
      }
    }
  };

  const createImageFolders = async (basePath) => {
    try {
      if (window.electronAPI) {
        // Create folders using Electron API
        await window.electronAPI.createDirectory(
          `${basePath}/anhchup_khuonmat`
        );
        await window.electronAPI.createDirectory(`${basePath}/anhchup_bienso`);
        return true;
      } else {
        // Web environment - cannot create actual folders
        console.log("Web mode: Folders would be created at:", basePath);
        return true;
      }
    } catch (error) {
      console.error("Lỗi tạo thư mục:", error);
      return false;
    }
  };

  const handleSaveSettings = async () => {
    if (!imageStoragePath) {
      showToast("Vui lòng chọn thư mục lưu ảnh", "warning");
      return;
    }

    setLoading(true);
    try {
      // Create image folders if local storage is enabled
      if (isLocalStorageEnabled) {
        const foldersCreated = await createImageFolders(imageStoragePath);
        if (!foldersCreated) {
          showToast("Lỗi tạo thư mục con", "error");
          setLoading(false);
          return;
        }
      }

      // Save settings to localStorage
      localStorage.setItem("image_storage_path", imageStoragePath);
      localStorage.setItem(
        "local_storage_enabled",
        isLocalStorageEnabled.toString()
      );
      // Save to global config for other components
      window.systemConfig = {
        imageStoragePath,
        isLocalStorageEnabled,
      };

      showToast("Đã lưu cài đặt thành công", "success");

      // Tắt trang sau khi lưu thành công
      setTimeout(() => {
        if (onClose) {
          onClose();
        }
      }, 1000); // Delay 1 giây để user thấy toast message
    } catch (error) {
      console.error("Lỗi lưu cài đặt:", error);
      showToast("Lỗi lưu cài đặt", "error");
    } finally {
      setLoading(false);
    }
  };

  const handleTestPath = async () => {
    if (!imageStoragePath) {
      showToast("Vui lòng chọn thư mục trước", "warning");
      return;
    }

    try {
      if (window.electronAPI) {
        const exists = await window.electronAPI.pathExists(imageStoragePath);
        if (exists) {
          // Kiểm tra 2 thư mục con
          const folder1 = `${imageStoragePath}/anhchup_khuonmat`;
          const folder2 = `${imageStoragePath}/anhchup_bienso`;

          const folder1Exists = await window.electronAPI.pathExists(folder1);
          const folder2Exists = await window.electronAPI.pathExists(folder2);

          if (folder1Exists && folder2Exists) {
            showToast(
              "Đã tạo thành công - cả 2 thư mục con đều có sẵn",
              "success"
            );
          } else {
            const missingFolders = [];
            if (!folder1Exists) missingFolders.push("anhchup_khuonmat");
            if (!folder2Exists) missingFolders.push("anhchup_bienso");

            showToast(
              `Thư mục hợp lệ nhưng thiếu: ${missingFolders.join(", ")}`,
              "warning"
            );
          }
        } else {
          showToast("Thư mục không tồn tại", "error");
        }
      } else {
        showToast("Không thể kiểm tra thư mục trong web mode", "info");
      }
    } catch (error) {
      console.error("Lỗi kiểm tra thư mục:", error);
      showToast("Lỗi kiểm tra thư mục", "error");
    }
  };

  const handleResetToDefault = () => {
    const defaultPath = "C:/ParkingLot_Images";
    setImageStoragePath(defaultPath);
    showToast("Đã đặt lại về thư mục mặc định", "success");
  };

  return (
    <div className="system-settings">
      <div className="settings-container">
        <div className="settings-header">
          <h1>Cài đặt hệ thống</h1>
          <p>Cấu hình các thông số chung của hệ thống</p>
          <button className="close-btn" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="settings-content">
          {/* Image Storage Settings */}
          <div className="settings-section">
            <h2> Cài đặt lưu trữ ảnh</h2>

            <div className="setting-item">
              <label className="setting-label">
                <input
                  type="checkbox"
                  checked={isLocalStorageEnabled}
                  onChange={(e) => setIsLocalStorageEnabled(e.target.checked)}
                />
                Bật lưu trữ ảnh cục bộ (Local Storage)
              </label>
              <p className="setting-description">
                Khi bật, ảnh sẽ được lưu trên máy cục bộ để lưu trữ và backup
              </p>
            </div>

            {isLocalStorageEnabled && (
              <>
                <div className="setting-item">
                  <label className="setting-label">Thư mục lưu ảnh:</label>
                  <div className="path-selector">
                    <input
                      type="text"
                      value={imageStoragePath}
                      readOnly
                      placeholder="Chọn thư mục lưu ảnh..."
                      className="path-input"
                    />
                    <button
                      className="btn btn-primary"
                      onClick={handleSelectFolder}
                    >
                      Chọn thư mục
                    </button>
                    <button
                      className="btn btn-secondary"
                      onClick={handleTestPath}
                      disabled={!imageStoragePath}
                    >
                      ✓ Kiểm tra
                    </button>
                    <button
                      className="btn btn-warning"
                      onClick={handleResetToDefault}
                      title="Đặt lại về thư mục mặc định C:/ParkingLot_Images/"
                    >
                      🔄 Mặc định
                    </button>
                  </div>
                  <p className="setting-description">
                    Hệ thống sẽ tự động tạo 2 thư mục con: "anhchup_khuonmat" và
                    "anhchup_bienso"
                  </p>
                </div>
              </>
            )}
          </div>

          {/* System Information */}
          <div className="settings-section">
            <h2> Thông tin hệ thống</h2>

            <div className="info-grid">
              <div className="info-item">
                <label>Môi trường:</label>
                <span>
                  {window.electronAPI ? "Electron App" : "Web Browser"}
                </span>
              </div>

              <div className="info-item">
                <label>Lưu trữ cục bộ:</label>
                <span
                  className={
                    isLocalStorageEnabled ? "status-enabled" : "status-disabled"
                  }
                >
                  {isLocalStorageEnabled ? "Đã bật" : "Tắt"}
                </span>
              </div>

              <div className="info-item">
                <label>Thư mục lưu trữ:</label>
                <span>{imageStoragePath || "Chưa chọn"}</span>
              </div>
            </div>
          </div>

          {/* Local Storage Information */}
          <div className="settings-section">
            <h2>📁 Thông tin lưu trữ cục bộ</h2>

            <div className="rules-list">
              <div className="rule-item">
                <span className="rule-number">1</span>
                <div className="rule-content">
                  <strong>Lưu trữ cục bộ:</strong> Ảnh được lưu trực tiếp vào
                  thư mục đã chọn
                </div>
              </div>

              <div className="rule-item">
                <span className="rule-number">2</span>
                <div className="rule-content">
                  <strong>Thư mục con:</strong> Tự động tạo 2 thư mục con
                  anhchup_khuonmat và anhchup_bienso
                </div>
              </div>

              <div className="rule-item">
                <span className="rule-number">3</span>
                <div className="rule-content">
                  <strong>Truy cập nhanh:</strong> Ảnh được tải trực tiếp từ hệ
                  thống file local
                </div>
              </div>

              <div className="rule-item">
                <span className="rule-number">4</span>
                <div className="rule-content">
                  <strong>Backup dữ liệu:</strong> Có thể dễ dàng backup toàn bộ
                  thư mục hình ảnh
                </div>
              </div>
            </div>
          </div>

          {/* USB Relay Control */}
          <div className="settings-section">
            <h2>🎛️ USB Relay Control</h2>

            <div className="info-grid">
              <div className="info-item">
                <label>Thiết bị:</label>
                <span>USB Relay 4-Channel</span>
              </div>
              <div className="info-item">
                <label>Vendor ID:</label>
                <span>0x16C0</span>
              </div>
              <div className="info-item">
                <label>Product ID:</label>
                <span>0x05DF</span>
              </div>
              <div className="info-item">
                <label>Chức năng:</label>
                <span>Điều khiển cổng barie, đèn báo, khóa cửa</span>
              </div>
            </div>

            <div className="setting-item">
              <button
                className="btn btn-primary"
                onClick={() => setShowRelayControl(true)}
              >
                🎛️ Mở Panel điều khiển Relay
              </button>
              <div className="setting-description">
                Panel điều khiển cho phép test và điều khiển 4 relay đầu ra
              </div>
            </div>
          </div>
        </div>

        <div className="settings-footer">
          <button className="btn btn-secondary" onClick={onClose}>
            Hủy
          </button>
          <button
            className="btn btn-primary"
            onClick={handleSaveSettings}
            disabled={loading}
          >
            {loading ? "Đang lưu..." : "Lưu cài đặt"}
          </button>
        </div>
      </div>

      {/* Relay Control Modal */}
      {showRelayControl && (
        <RelayControl
          isOpen={showRelayControl}
          onClose={() => setShowRelayControl(false)}
        />
      )}
    </div>
  );
};

export default SystemSettings;
