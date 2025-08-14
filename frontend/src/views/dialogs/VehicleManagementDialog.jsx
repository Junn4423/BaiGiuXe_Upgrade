"use client";

import { useState, useEffect } from "react";
import "../../assets/styles/VehicleManagementDialog.css";
import {
  layDanhSachPhuongTien,
  themPhuongTien,
  capNhatPhuongTien,
  xoaPhuongTien,
  layALLLoaiPhuongTien,
  getImageUrl,
  getFaceImageUrl,
  registerFaceRecognition as registerFaceAPI,
  uploadOwnerFaceImage,
} from "../../api/api";
import faceAPI from "../../api/apiFaceRecognition";

// Image Viewer Modal Component
const ImageViewerModal = ({ imagePath, ownerName, onClose }) => {
  const [imageUrl, setImageUrl] = useState("");
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    const loadImage = async () => {
      if (!imagePath) {
        setError("Không có đường dẫn ảnh");
        setIsLoading(false);
        return;
      }

      try {
        setIsLoading(true);
        setError("");

        // Extract filename from path if it's a full path
        let filename = imagePath;
        if (imagePath.includes("/") || imagePath.includes("\\")) {
          filename = imagePath.split(/[/\\]/).pop();
        }

        console.log(
          `🔍 ImageViewerModal: Loading face image with filename: ${filename}`
        );

        // Use dedicated face image API for NhanDien_khuonmat folder
        const url = await getFaceImageUrl(filename);
        if (url) {
          setImageUrl(url);
          console.log(
            `✅ ImageViewerModal: Successfully loaded face image from API`
          );
        } else {
          setError("Không thể tải ảnh khuôn mặt từ server");
          console.warn(
            `❌ ImageViewerModal: Failed to load face image: ${filename}`
          );
        }
      } catch (loadError) {
        console.error("Error loading image:", loadError);
        setError(`Lỗi tải ảnh: ${loadError.message}`);
      } finally {
        setIsLoading(false);
      }
    };

    loadImage();
  }, [imagePath]);

  return (
    <div className="image-viewer-overlay" onClick={onClose}>
      <div
        className="image-viewer-content"
        onClick={(e) => e.stopPropagation()}
      >
        <div className="image-viewer-header">
          <h4>Ảnh khuôn mặt chủ xe: {ownerName}</h4>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>
        <div className="image-viewer-body">
          {isLoading ? (
            <div style={{ textAlign: "center", padding: "40px" }}>
              <div className="loading-spinner"></div>
              <p>Đang tải ảnh...</p>
            </div>
          ) : error ? (
            <div
              style={{ textAlign: "center", padding: "40px", color: "#ef4444" }}
            >
              <p>{error}</p>
              <p
                style={{ fontSize: "12px", color: "#6b7280", marginTop: "8px" }}
              >
                Đường dẫn: {imagePath}
              </p>
            </div>
          ) : (
            <img
              src={imageUrl}
              alt={`Ảnh khuôn mặt ${ownerName}`}
              style={{
                maxWidth: "100%",
                maxHeight: "80vh",
                objectFit: "contain",
              }}
              onError={() => setError("Không thể hiển thị ảnh")}
            />
          )}
        </div>
      </div>
    </div>
  );
};

const VehicleManagementDialog = ({ onClose }) => {
  const [vehicles, setVehicles] = useState([]);
  const [vehicleTypes, setVehicleTypes] = useState([]);
  const [selectedVehicle, setSelectedVehicle] = useState(null);
  const [isEditing, setIsEditing] = useState(false);
  const [isLoading, setIsLoading] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [ownerImageBlob, setOwnerImageBlob] = useState(null);
  const [ownerPreviewUrl, setOwnerPreviewUrl] = useState("");
  const [showImageViewer, setShowImageViewer] = useState(false);

  // Form data state
  const [formData, setFormData] = useState({
    bienSo: "",
    maLoaiPT: "",
    tenChuXe: "",
    duongDanKhuonMat: "",
  });

  // Error state
  const [errors, setErrors] = useState({});

  // Load vehicles and vehicle types when component mounts
  useEffect(() => {
    console.log("VehicleManagementDialog mounted, loading data...");
    loadData();
  }, []);

  const loadData = async () => {
    try {
      setIsLoading(true);
      console.log("Loading vehicles and vehicle types...");

      const [vehicleList, typeList] = await Promise.all([
        layDanhSachPhuongTien(),
        layALLLoaiPhuongTien(),
      ]);

      console.log("Loaded vehicles:", vehicleList);
      console.log("Loaded vehicle types:", typeList);

      setVehicles(Array.isArray(vehicleList) ? vehicleList : []);
      setVehicleTypes(Array.isArray(typeList) ? typeList : []);
    } catch (error) {
      console.error("Error loading data:", error);
      alert("Lỗi tải dữ liệu: " + error.message);
      setVehicles([]);
      setVehicleTypes([]);
    } finally {
      setIsLoading(false);
    }
  };

  const handleSelectVehicle = (vehicle) => {
    console.log("Selected vehicle:", vehicle);
    setSelectedVehicle(vehicle);
    setFormData({
      bienSo: vehicle.bienSo || "",
      maLoaiPT: vehicle.maLoaiPT || "",
      tenChuXe: vehicle.tenChuXe || "",
      duongDanKhuonMat: vehicle.duongDanKhuonMat || vehicle.lv004 || "",
    });
    setIsEditing(false);
    setErrors({});
    setOwnerImageBlob(null);
    if (ownerPreviewUrl) URL.revokeObjectURL(ownerPreviewUrl);
    setOwnerPreviewUrl("");
    setShowImageViewer(false);
  };

  const handleNewVehicle = () => {
    console.log("Creating new vehicle");
    setSelectedVehicle(null);
    setIsEditing(true);
    setFormData({
      bienSo: "",
      maLoaiPT: "",
      tenChuXe: "",
      duongDanKhuonMat: "",
    });
    setErrors({});
    setOwnerImageBlob(null);
    if (ownerPreviewUrl) URL.revokeObjectURL(ownerPreviewUrl);
    setOwnerPreviewUrl("");
    setShowImageViewer(false);
  };

  const handleEdit = () => {
    if (!selectedVehicle) {
      alert("Vui lòng chọn phương tiện cần sửa");
      return;
    }
    console.log("Editing vehicle:", selectedVehicle);
    setIsEditing(true);
    setErrors({});
  };

  // Helper function to create filename from owner name and license plate
  const createOwnerImageFilename = (tenChuXe, bienSo) => {
    if (!tenChuXe || !bienSo) return null;

    // Remove Vietnamese accents and special characters
    const removeVietnameseAccents = (str) => {
      return str
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .replace(/đ/g, "d")
        .replace(/Đ/g, "D")
        .replace(/[^a-zA-Z0-9]/g, "");
    };

    const cleanName = removeVietnameseAccents(tenChuXe.trim());
    const cleanPlate = removeVietnameseAccents(bienSo.trim().toUpperCase());

    return `${cleanName}_${cleanPlate}.jpg`;
  };

  // Helper function to register face with recognition service
  const registerFaceRecognition = async (
    imageBase64,
    employeeId,
    employeeName
  ) => {
    try {
      return await registerFaceAPI(imageBase64, employeeId, employeeName);
    } catch (error) {
      console.error("Face registration error:", error);
      throw error;
    }
  };

  const validateForm = () => {
    const newErrors = {};

    if (!formData.bienSo.trim()) {
      newErrors.bienSo = "Vui lòng nhập biển số xe";
    }

    if (!formData.maLoaiPT) {
      newErrors.maLoaiPT = "Vui lòng chọn loại phương tiện";
    }

    // If user has selected an image, owner name is required for proper filename generation
    if (ownerImageBlob && !formData.tenChuXe.trim()) {
      newErrors.tenChuXe = "Vui lòng nhập tên chủ xe khi đăng ký ảnh khuôn mặt";
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSave = async () => {
    console.log("Saving vehicle...");
    if (!validateForm()) return;

    try {
      setIsSubmitting(true);
      const vehicleData = {
        bienSo: formData.bienSo.trim().toUpperCase(),
        maLoaiPT: formData.maLoaiPT,
        tenChuXe: formData.tenChuXe,
        duongDanKhuonMat: formData.duongDanKhuonMat,
      };

      // Nếu có chọn file ảnh mới, upload vào C:\\ParkingLot_Images\\NhanDien_khuonmat trước khi lưu DB
      if (ownerImageBlob) {
        try {
          // Create filename using owner name and license plate
          const filename = createOwnerImageFilename(
            vehicleData.tenChuXe,
            vehicleData.bienSo
          );
          if (!filename) {
            throw new Error(
              "Không thể tạo tên file ảnh. Vui lòng nhập tên chủ xe và biển số."
            );
          }

          const {
            success,
            filename: savedFilename,
            fullPath,
            error,
          } = await uploadOwnerFaceImage(ownerImageBlob, filename);
          if (!success) {
            throw new Error(error || "Upload ảnh chủ xe thất bại");
          }

          // Convert image to base64 for face registration
          const arrayBuffer = await ownerImageBlob.arrayBuffer();
          const uint8Array = new Uint8Array(arrayBuffer);

          // Convert to base64 safely to avoid call stack issues
          let binaryString = "";
          const chunkSize = 8192; // Process in chunks to avoid call stack overflow
          for (let i = 0; i < uint8Array.length; i += chunkSize) {
            const chunk = uint8Array.slice(i, i + chunkSize);
            binaryString += String.fromCharCode.apply(null, chunk);
          }
          const base64String = btoa(binaryString);
          const imageBase64 = `data:image/jpeg;base64,${base64String}`;

          // Register face with recognition service
          try {
            console.log("Đang đăng ký khuôn mặt với hệ thống nhận diện...");
            await registerFaceRecognition(
              imageBase64,
              vehicleData.bienSo, // Use license plate as employee ID
              vehicleData.tenChuXe || vehicleData.bienSo
            );
            console.log("Đăng ký khuôn mặt thành công");
          } catch (faceError) {
            console.warn("Đăng ký khuôn mặt thất bại:", faceError);
            // Continue with vehicle registration even if face registration fails
            alert(
              `Ảnh đã được lưu nhưng đăng ký nhận diện khuôn mặt thất bại: ${faceError.message}\n\nBạn có thể thử đăng ký lại sau.`
            );
          }

          // Lưu chỉ tên file vào DB (lv004). Service verify sẽ tự ghép đường dẫn mặc định nếu cần
          vehicleData.duongDanKhuonMat = savedFilename;
        } catch (e) {
          console.error("Upload owner image error:", e);
          alert(e.message || "Không thể tải ảnh chủ xe lên thư mục mặc định");
          setIsSubmitting(false);
          return;
        }
      }

      console.log("Vehicle data to save:", vehicleData);

      let result;
      if (selectedVehicle) {
        // Update existing vehicle
        console.log("Updating existing vehicle:", selectedVehicle.bienSo);
        result = await capNhatPhuongTien(vehicleData);
      } else {
        // Add new vehicle
        console.log("Adding new vehicle");
        result = await themPhuongTien(vehicleData);
      }

      console.log("Save result:", result);

      if (result && result.success !== false) {
        alert(
          selectedVehicle
            ? "Cập nhật phương tiện thành công!"
            : "Thêm phương tiện thành công!"
        );
        await loadData();
        setIsEditing(false);
        setSelectedVehicle(vehicleData);
        setFormData(vehicleData);
        setOwnerImageBlob(null);
        if (ownerPreviewUrl) URL.revokeObjectURL(ownerPreviewUrl);
        setOwnerPreviewUrl("");
      } else {
        alert(result?.message || "Không thể lưu phương tiện");
      }
    } catch (error) {
      console.error("Error saving vehicle:", error);
      alert("Lỗi lưu phương tiện: " + error.message);
    } finally {
      setIsSubmitting(false);
    }
  };

  const handleDelete = async () => {
    if (!selectedVehicle) {
      alert("Vui lòng chọn phương tiện cần xóa");
      return;
    }

    if (
      window.confirm(
        `Bạn có chắc muốn xóa phương tiện "${selectedVehicle.bienSo}"?`
      )
    ) {
      try {
        setIsSubmitting(true);
        console.log("Deleting vehicle:", selectedVehicle.bienSo);

        // 1. Xóa phương tiện từ database chính
        const result = await xoaPhuongTien(selectedVehicle.bienSo);
        console.log("Delete result:", result);

        if (result && result.success !== false) {
          // 2. Xóa dữ liệu khuôn mặt từ face recognition service (nếu có)
          try {
            // Sử dụng biển số làm employee_id để xóa trong face service
            const faceDeleteResult = await faceAPI.deleteUser(
              selectedVehicle.bienSo
            );
            console.log("Face recognition delete result:", faceDeleteResult);

            if (faceDeleteResult.success) {
              console.log(
                "Successfully deleted face data for:",
                selectedVehicle.bienSo
              );
              if (
                faceDeleteResult.deleted_images &&
                faceDeleteResult.deleted_images.length > 0
              ) {
                console.log(
                  "Deleted face images:",
                  faceDeleteResult.deleted_images
                );
              }
            } else {
              console.warn(
                "Could not delete face data:",
                faceDeleteResult.message
              );
              // Không báo lỗi cho user vì dữ liệu chính đã xóa thành công
            }
          } catch (faceError) {
            console.error("Error deleting face recognition data:", faceError);
            // Không báo lỗi cho user vì dữ liệu chính đã xóa thành công
          }

          alert("Xóa phương tiện thành công!");
          await loadData();
          clearForm();
        } else {
          alert(result?.message || "Không thể xóa phương tiện");
        }
      } catch (error) {
        console.error("Error deleting vehicle:", error);
        alert("Lỗi xóa phương tiện: " + error.message);
      } finally {
        setIsSubmitting(false);
      }
    }
  };

  const clearForm = () => {
    console.log("Clearing form");
    setFormData({
      bienSo: "",
      maLoaiPT: "",
      tenChuXe: "",
      duongDanKhuonMat: "",
    });
    setSelectedVehicle(null);
    setIsEditing(false);
    setErrors({});
    setOwnerImageBlob(null);
    if (ownerPreviewUrl) URL.revokeObjectURL(ownerPreviewUrl);
    setOwnerPreviewUrl("");
    setShowImageViewer(false);
  };

  const handleCancel = () => {
    console.log("Canceling edit");
    if (selectedVehicle) {
      setFormData({
        bienSo: selectedVehicle.bienSo || "",
        maLoaiPT: selectedVehicle.maLoaiPT || "",
        tenChuXe: selectedVehicle.tenChuXe || "",
        duongDanKhuonMat:
          selectedVehicle.duongDanKhuonMat || selectedVehicle.lv004 || "",
      });
    } else {
      clearForm();
    }
    setIsEditing(false);
    setErrors({});
    setOwnerImageBlob(null);
    if (ownerPreviewUrl) URL.revokeObjectURL(ownerPreviewUrl);
    setOwnerPreviewUrl("");
  };

  const updateField = (field, value) => {
    console.log(`Changing ${field} to:`, value);
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }));

    // Clear error when user starts typing
    if (errors[field]) {
      setErrors((prev) => ({
        ...prev,
        [field]: "",
      }));
    }
  };

  const getSelectedVehicleTypeLabel = () => {
    if (!selectedVehicle?.maLoaiPT) return "Chưa xác định";
    const type = vehicleTypes.find(
      (t) => t.maLoaiPT === selectedVehicle.maLoaiPT
    );
    return type
      ? `${type.tenLoaiPT} (${type.maLoaiPT})`
      : selectedVehicle.maLoaiPT;
  };

  const getVehicleTypeLabel = (maLoaiPT) => {
    const type = vehicleTypes.find((t) => t.maLoaiPT === maLoaiPT);
    return type ? `${type.tenLoaiPT} (${type.maLoaiPT})` : maLoaiPT;
  };

  // Handle image file selection
  const handleImageFileSelect = async () => {
    try {
      // Create file input element
      const input = document.createElement("input");
      input.type = "file";
      input.accept = "image/*";
      input.multiple = false;

      input.onchange = async (event) => {
        const file = event.target.files?.[0];
        if (!file) return;

        // Validate file type
        if (!file.type.startsWith("image/")) {
          alert("Vui lòng chọn file ảnh (jpg, png, etc.)");
          return;
        }

        // Validate file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
          alert("File ảnh quá lớn. Vui lòng chọn file nhỏ hơn 5MB.");
          return;
        }

        // Store the blob and create preview URL
        setOwnerImageBlob(file);

        // Clean up previous preview URL
        if (ownerPreviewUrl) {
          URL.revokeObjectURL(ownerPreviewUrl);
        }

        const previewUrl = URL.createObjectURL(file);
        setOwnerPreviewUrl(previewUrl);
      };

      input.click();
    } catch (error) {
      console.error("Error selecting image file:", error);
      alert("Lỗi chọn file ảnh: " + error.message);
    }
  };

  // Handle view owner image
  const handleViewOwnerImage = async () => {
    if (!selectedVehicle?.duongDanKhuonMat && !selectedVehicle?.lv004) {
      alert("Chủ xe này chưa có ảnh khuôn mặt");
      return;
    }

    setShowImageViewer(true);
  };

  return (
    <div className="dialog-overlay">
      <div className="vehicle-management-dialog">
        <div className="dialog-header">
          <h3>Quản Lý Phương Tiện</h3>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          <div className="content-layout">
            {/* Vehicle List Panel */}
            <div className="vehicle-list-panel">
              <div className="panel-header">
                <h4>Danh sách chủ phương tiện ({vehicles.length})</h4>
                <div className="action-buttons">
                  <button
                    className="btn btn-success"
                    onClick={handleNewVehicle}
                    disabled={isSubmitting}
                  >
                    + Thêm mới
                  </button>
                  <button
                    className="btn btn-refresh"
                    onClick={loadData}
                    disabled={isLoading || isSubmitting}
                  >
                    ↻ Làm mới
                  </button>
                </div>
              </div>

              <div className="vehicle-table-container">
                {isLoading ? (
                  <div className="loading-message">
                    <div className="loading-spinner"></div>
                    Đang tải dữ liệu...
                  </div>
                ) : vehicles.length === 0 ? (
                  <div className="no-data">Chưa có phương tiện nào</div>
                ) : (
                  <table className="vehicle-table">
                    <thead>
                      <tr>
                        <th>Biển số</th>
                        <th>Loại phương tiện</th>
                        <th>Mã loại</th>
                        <th>Chủ phương tiện</th>
                        <th>Ảnh (lv004)</th>
                      </tr>
                    </thead>
                    <tbody>
                      {vehicles.map((vehicle, index) => (
                        <tr
                          key={vehicle.bienSo || index}
                          className={
                            selectedVehicle?.bienSo === vehicle.bienSo
                              ? "selected"
                              : ""
                          }
                          onClick={() => handleSelectVehicle(vehicle)}
                        >
                          <td>{vehicle.bienSo}</td>
                          <td>{getVehicleTypeLabel(vehicle.maLoaiPT)}</td>
                          <td>{vehicle.maLoaiPT}</td>
                          <td>{vehicle.tenChuXe || ""}</td>
                          <td
                            style={{
                              fontFamily: "monospace",
                              fontSize: "0.85rem",
                            }}
                          >
                            {vehicle.duongDanKhuonMat || vehicle.lv004 || ""}
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                )}
              </div>
            </div>

            {/* Vehicle Form Panel */}
            <div className="vehicle-form-panel">
              <div className="panel-header">
                <h4>
                  {isEditing
                    ? selectedVehicle
                      ? "Sửa chủ phương tiện"
                      : "Thêm chủ phương tiện"
                    : selectedVehicle
                    ? "Thông tin chủ phương tiện"
                    : "Chưa chọn chủ phương tiện"}
                </h4>
                {!isEditing && selectedVehicle && (
                  <div className="action-buttons">
                    <button
                      className="btn btn-primary"
                      onClick={handleEdit}
                      disabled={isSubmitting}
                    >
                      Sửa
                    </button>
                    <button
                      className="btn btn-danger"
                      onClick={handleDelete}
                      disabled={isSubmitting}
                    >
                      Xóa
                    </button>
                  </div>
                )}
              </div>

              <div className="form-container">
                {!selectedVehicle && !isEditing ? (
                  <div className="no-selection">
                    <p>Vui lòng chọn phương tiện từ danh sách hoặc thêm mới</p>
                  </div>
                ) : (
                  <div className="form-section">
                    <div className="form-row">
                      <div className="form-group">
                        <label htmlFor="bienSo">
                          Biển số xe <span className="required">*</span>
                        </label>
                        <input
                          type="text"
                          id="bienSo"
                          value={formData.bienSo}
                          onChange={(e) =>
                            updateField("bienSo", e.target.value)
                          }
                          disabled={!isEditing || isSubmitting}
                          placeholder="Nhập biển số xe"
                          className={errors.bienSo ? "error" : ""}
                          style={{ textTransform: "uppercase" }}
                        />
                        {errors.bienSo && (
                          <span className="error-message">{errors.bienSo}</span>
                        )}
                      </div>

                      <div className="form-group">
                        <label htmlFor="maLoaiPT">
                          Loại phương tiện <span className="required">*</span>
                        </label>
                        <select
                          id="maLoaiPT"
                          value={formData.maLoaiPT}
                          onChange={(e) =>
                            updateField("maLoaiPT", e.target.value)
                          }
                          disabled={!isEditing || isSubmitting}
                          className={errors.maLoaiPT ? "error" : ""}
                        >
                          <option value="">-- Chọn loại phương tiện --</option>
                          {vehicleTypes.map((type) => (
                            <option key={type.maLoaiPT} value={type.maLoaiPT}>
                              {type.tenLoaiPT} ({type.maLoaiPT})
                            </option>
                          ))}
                        </select>
                        {errors.maLoaiPT && (
                          <span className="error-message">
                            {errors.maLoaiPT}
                          </span>
                        )}
                      </div>
                    </div>

                    <div className="form-row">
                      <div className="form-group">
                        <label htmlFor="tenChuXe">
                          Chủ phương tiện
                          {ownerImageBlob && (
                            <span className="required">*</span>
                          )}
                        </label>
                        <input
                          type="text"
                          id="tenChuXe"
                          value={formData.tenChuXe}
                          onChange={(e) =>
                            updateField("tenChuXe", e.target.value)
                          }
                          disabled={!isEditing || isSubmitting}
                          placeholder="Nhập tên chủ xe"
                          className={errors.tenChuXe ? "error" : ""}
                        />
                        {errors.tenChuXe && (
                          <span className="error-message">
                            {errors.tenChuXe}
                          </span>
                        )}
                      </div>

                      <div className="form-group">
                        <label htmlFor="duongDanKhuonMat">
                          Ảnh khuôn mặt chủ xe
                        </label>
                        <div
                          style={{
                            display: "flex",
                            gap: 8,
                            alignItems: "center",
                          }}
                        >
                          <input
                            type="text"
                            id="duongDanKhuonMat"
                            value={formData.duongDanKhuonMat}
                            onChange={(e) =>
                              updateField("duongDanKhuonMat", e.target.value)
                            }
                            disabled={!isEditing || isSubmitting}
                            placeholder="Tên file ảnh khuôn mặt"
                            style={{ flex: 1 }}
                          />
                          {isEditing && (
                            <button
                              className="btn btn-secondary"
                              type="button"
                              onClick={handleImageFileSelect}
                              disabled={isSubmitting}
                            >
                              Chọn ảnh
                            </button>
                          )}
                          {!isEditing &&
                            selectedVehicle &&
                            (selectedVehicle.duongDanKhuonMat ||
                              selectedVehicle.lv004) && (
                              <button
                                className="btn btn-info"
                                type="button"
                                onClick={handleViewOwnerImage}
                              >
                                Xem ảnh
                              </button>
                            )}
                        </div>
                        {ownerPreviewUrl && (
                          <div style={{ marginTop: 8 }}>
                            <img
                              src={ownerPreviewUrl}
                              alt="Preview"
                              style={{
                                maxWidth: "200px",
                                maxHeight: "200px",
                                borderRadius: "4px",
                                border: "1px solid #ccc",
                              }}
                            />
                          </div>
                        )}
                        <div
                          style={{
                            color: "#6b7280",
                            fontSize: 12,
                            marginTop: 4,
                          }}
                        >
                          Ảnh sẽ được lưu với tên:{" "}
                          {formData.tenChuXe && formData.bienSo
                            ? createOwnerImageFilename(
                                formData.tenChuXe,
                                formData.bienSo
                              )
                            : "tênchủxe_biểnsố.jpg"}
                        </div>
                      </div>
                    </div>

                    {/* Display info when not editing */}
                    {!isEditing && selectedVehicle && (
                      <div className="info-section">
                        <div className="info-row">
                          <span className="info-label">Biển số:</span>
                          <span className="info-value">
                            {selectedVehicle.bienSo}
                          </span>
                        </div>
                        <div className="info-row">
                          <span className="info-label">Loại phương tiện:</span>
                          <span className="info-value">
                            {getSelectedVehicleTypeLabel()}
                          </span>
                        </div>
                        <div className="info-row">
                          <span className="info-label">Chủ phương tiện:</span>
                          <span className="info-value">
                            {selectedVehicle.tenChuXe || ""}
                          </span>
                        </div>
                        <div className="info-row">
                          <span className="info-label">Ảnh (lv004):</span>
                          <span
                            className="info-value"
                            style={{ fontFamily: "monospace" }}
                          >
                            {selectedVehicle.duongDanKhuonMat ||
                              selectedVehicle.lv004 ||
                              ""}
                          </span>
                        </div>
                      </div>
                    )}
                  </div>
                )}
              </div>

              {isEditing && (
                <div className="button-group">
                  <button
                    className="btn btn-success"
                    onClick={handleSave}
                    disabled={isSubmitting}
                  >
                    {isSubmitting ? "Đang lưu..." : "Lưu"}
                  </button>
                  <button
                    className="btn btn-cancel"
                    onClick={handleCancel}
                    disabled={isSubmitting}
                  >
                    Hủy
                  </button>
                </div>
              )}
            </div>
          </div>
        </div>

        {/* Image Viewer Modal */}
        {showImageViewer && selectedVehicle && (
          <ImageViewerModal
            imagePath={
              selectedVehicle.duongDanKhuonMat || selectedVehicle.lv004
            }
            ownerName={selectedVehicle.tenChuXe || selectedVehicle.bienSo}
            onClose={() => setShowImageViewer(false)}
          />
        )}
      </div>
    </div>
  );
};

export default VehicleManagementDialog;
