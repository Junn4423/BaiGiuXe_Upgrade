"use client"

import { useState, useEffect, useMemo } from "react"
import "../../assets/styles/dialog-base.css"
import {
  layDanhSachChinhSachGiaV2,
  themChinhSachV2,
  suaChinhSachV2,
  xoaChinhSachV2,
  layALLLoaiPhuongTien,
  taoMaChinhSachTuDong,
  tinhTongNgay,
} from "../../api/api"

const PricingPolicyDialog = ({ onClose }) => {
  const [policies, setPolicies] = useState([])
  const [vehicleTypes, setVehicleTypes] = useState([])
  const [selectedPolicy, setSelectedPolicy] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [isLoading, setIsLoading] = useState(false)
  const [isSubmitting, setIsSubmitting] = useState(false)

  // Form data state - cập nhật theo mobile app
  const [formData, setFormData] = useState({
    maChinhSach: "",
    maLoaiPT: "",
    thoiGian: 0,
    donGia: 0,
    quaGio: 0,
    donGiaQuaGio: 0,
    loaiChinhSach: "",
    tongNgay: 0,
  })

  // Enhanced states theo mobile app
  const [errors, setErrors] = useState({})
  const [policyType, setPolicyType] = useState("N") // Đồng bộ với mobile: 'N' cho Ngày
  const [policyCount, setPolicyCount] = useState(1)
  const [isSpecialOffer, setIsSpecialOffer] = useState(false)

  // Policy type options - đồng bộ với mobile app
  const POLICY_TYPE_OPTIONS = [
    { label: "Ngày", value: "N", days: 1 },
    { label: "Tuần", value: "T", days: 7 },
    { label: "Tháng", value: "Th", days: 30 },
    { label: "Năm", value: "NAM", days: 365 },
  ]

  // Load policies when component mounts
  useEffect(() => {
    console.log("PricingPolicyDialog mounted, loading data...")
    loadData()
  }, [])

  // Tự động tính mã chính sách khi thay đổi cấu hình (realtime update)
  const maChinhSach = useMemo(() => {
    if (formData.maLoaiPT && policyType && policyCount && isSpecialOffer) {
      return taoMaChinhSachTuDong(formData.maLoaiPT, policyType, policyCount)
    } else if (formData.maLoaiPT && !isSpecialOffer) {
      return `CS_${formData.maLoaiPT.toUpperCase()}_BASE`
    }
    return ""
  }, [formData.maLoaiPT, policyType, policyCount, isSpecialOffer])

  // Tự động tính tổng ngày (realtime update)
  useEffect(() => {
    if (isSpecialOffer) {
      const totalDays = tinhTongNgay(policyType, policyCount)
      const typeOption = POLICY_TYPE_OPTIONS.find((t) => t.value === policyType)
      const newLoaiChinhSach = `${policyCount} ${typeOption?.label || ""}`

      setFormData((prev) => ({
        ...prev,
        tongNgay: totalDays,
        loaiChinhSach: newLoaiChinhSach,
      }))
      console.log(`Đã cập nhật tongNgay: ${totalDays}, loaiChinhSach: "${newLoaiChinhSach}" cho chính sách VIP`)
    } else {
      setFormData((prev) => ({
        ...prev,
        tongNgay: 0,
        loaiChinhSach: policyType, // Dùng policyType thay vì để trống
      }))
      console.log(`Đã reset tongNgay về 0 và loaiChinhSach về "${policyType}" cho chính sách thường`)
    }
  }, [policyType, policyCount, isSpecialOffer])

  // Cập nhật mã chính sách tự động (realtime update)
  useEffect(() => {
    setFormData((prev) => ({
      ...prev,
      maChinhSach: maChinhSach,
    }))
  }, [maChinhSach])

  const loadData = async () => {
    try {
      setIsLoading(true)
      const [policyData, vehicleData] = await Promise.all([layDanhSachChinhSachGiaV2(), layALLLoaiPhuongTien()])

      setPolicies(Array.isArray(policyData) ? policyData : [])
      setVehicleTypes(Array.isArray(vehicleData) ? vehicleData : [])
    } catch (error) {
      console.error("Lỗi load dữ liệu:", error)
      alert("Lỗi tải dữ liệu: " + error.message)
    } finally {
      setIsLoading(false)
    }
  }

  const handleSelectPolicy = (policy) => {
    console.log("Selected policy:", policy)
    setSelectedPolicy(policy)

    // Parse policy data
    const isVIP = policy.tongNgay > 0
    setIsSpecialOffer(isVIP)

    if (isVIP) {
      // Parse loaiChinhSach to extract type and count
      const match = policy.loaiChinhSach?.match(/(\d+)\s*(\w+)/)
      if (match) {
        const count = Number.parseInt(match[1])
        const typeLabel = match[2]
        const typeOption = POLICY_TYPE_OPTIONS.find((opt) => opt.label === typeLabel)
        if (typeOption) {
          setPolicyType(typeOption.value)
          setPolicyCount(count)
          console.log(
            `Parsed VIP policy - type: ${typeOption.value}, count: ${count}, loaiChinhSach: "${policy.loaiChinhSach}", tongNgay: ${policy.tongNgay}`,
          )
        }
      }
    } else {
      // Reset về giá trị mặc định cho chính sách thường
      setPolicyType("N")
      setPolicyCount(1)
      console.log("Selected normal policy - reset policyType: N, policyCount: 1")
    }

    setFormData({
      maChinhSach: policy.maChinhSach || "",
      maLoaiPT: policy.maLoaiPT || "",
      thoiGian: policy.thoiGian || 0,
      donGia: policy.donGia || 0,
      quaGio: policy.quaGio || 0,
      donGiaQuaGio: policy.donGiaQuaGio || 0,
      loaiChinhSach: policy.loaiChinhSach || "",
      tongNgay: policy.tongNgay || 0,
    })
    setIsEditing(false)
    setErrors({})
  }

  const handleNewPolicy = () => {
    console.log("Creating new policy")
    setSelectedPolicy(null)
    setIsEditing(true)
    setIsSpecialOffer(false)
    setPolicyType("N")
    setPolicyCount(1)
    setFormData({
      maChinhSach: "",
      maLoaiPT: "",
      thoiGian: 240, // 4 tiếng mặc định
      donGia: 5000,
      quaGio: 0,
      donGiaQuaGio: 2000,
      loaiChinhSach: "",
      tongNgay: 0,
    })
    setErrors({})
  }

  const handleEdit = () => {
    if (!selectedPolicy) {
      alert("Vui lòng chọn chính sách cần sửa")
      return
    }
    console.log("Editing policy:", selectedPolicy)
    setIsEditing(true)
    setErrors({})
  }

  const validateForm = () => {
    const newErrors = {}

    if (!formData.maChinhSach.trim()) {
      newErrors.maChinhSach = "Mã chính sách không được để trống"
    }

    if (!formData.maLoaiPT) {
      newErrors.maLoaiPT = "Vui lòng chọn loại phương tiện"
    }

    if (isSpecialOffer) {
      if (policyCount <= 0) {
        newErrors.policyCount = "Số lượng phải lớn hơn 0"
      }
      if (formData.donGia <= 0) {
        newErrors.donGia = "Giá gói phải lớn hơn 0"
      }
    } else {
      if (formData.thoiGian <= 0) {
        newErrors.thoiGian = "Thời gian phải lớn hơn 0"
      }
      if (formData.donGia <= 0) {
        newErrors.donGia = "Đơn giá phải lớn hơn 0"
      }
      if (formData.quaGio === 1 && formData.donGiaQuaGio <= 0) {
        newErrors.donGiaQuaGio = "Đơn giá quá giờ phải lớn hơn 0"
      }
    }

    setErrors(newErrors)
    return Object.keys(newErrors).length === 0
  }

  const handleSave = async () => {
    console.log("Submitting policy...")
    if (!validateForm()) return

    try {
      setIsLoading(true)

      // Đảm bảo dữ liệu submit có đầy đủ thông tin từ state hiện tại
      const submitData = {
        ...formData,
        // Tính toán lại tongNgay và loaiChinhSach để đảm bảo chính xác tại thời điểm submit
        tongNgay: isSpecialOffer ? tinhTongNgay(policyType, policyCount) : 0,
        loaiChinhSach: isSpecialOffer
          ? `${policyCount} ${POLICY_TYPE_OPTIONS.find((t) => t.value === policyType)?.label || ""}`
          : policyType, // Nếu không ưu đãi, dùng policyType
      }

      console.log("=== DEBUG SUBMIT DATA ===")
      console.log("Submit data:", submitData)
      console.log("isSpecialOffer:", isSpecialOffer)
      console.log("policyType:", policyType)
      console.log("policyCount:", policyCount)
      console.log("lv008 (tongNgay):", submitData.tongNgay)
      console.log("lv007 (loaiChinhSach):", submitData.loaiChinhSach)
      console.log("==========================")

      let result
      if (selectedPolicy) {
        result = await suaChinhSachV2(submitData)
      } else {
        result = await themChinhSachV2(submitData)
      }

      if (result?.success) {
        alert(selectedPolicy ? "Cập nhật chính sách thành công!" : "Thêm chính sách thành công!")
        setIsEditing(false)
        await loadData()
      } else {
        alert(result?.message || "Không thể lưu chính sách")
      }
    } catch (error) {
      console.error("Lỗi submit form:", error)
      alert("Có lỗi xảy ra: " + error.message)
    } finally {
      setIsLoading(false)
    }
  }

  const handleDelete = async () => {
    if (!selectedPolicy) {
      alert("Vui lòng chọn chính sách cần xóa")
      return
    }

    if (window.confirm(`Bạn có chắc muốn xóa chính sách "${selectedPolicy.maChinhSach}"?`)) {
      try {
        setIsLoading(true)
        const result = await xoaChinhSachV2(selectedPolicy.maChinhSach)

        if (result?.success) {
          alert("Xóa chính sách thành công!")
          await loadData()
          clearForm()
        } else {
          alert(result?.message || "Không thể xóa chính sách")
        }
      } catch (error) {
        console.error("Lỗi xóa:", error)
        alert("Có lỗi xảy ra khi xóa: " + error.message)
      } finally {
        setIsLoading(false)
      }
    }
  }

  const clearForm = () => {
    setFormData({
      maChinhSach: "",
      maLoaiPT: "",
      thoiGian: 240,
      donGia: 5000,
      quaGio: 0,
      donGiaQuaGio: 2000,
      loaiChinhSach: "",
      tongNgay: 0,
    })
    setSelectedPolicy(null)
    setIsEditing(false)
    setIsSpecialOffer(false)
    setPolicyType("N")
    setPolicyCount(1)
    setErrors({})
  }

  const handleCancel = () => {
    if (selectedPolicy) {
      handleSelectPolicy(selectedPolicy)
    } else {
      clearForm()
    }
    setIsEditing(false)
  }

  const updateField = (field, value) => {
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }))
    if (errors[field]) {
      setErrors((prev) => ({ ...prev, [field]: "" }))
    }
  }

  const formatCurrency = (amount) => {
    return new Intl.NumberFormat("vi-VN", {
      style: "currency",
      currency: "VND",
    }).format(amount)
  }

  return (
    <div className="dialog-overlay">
      <div className="dialog-container large">
        <div className="dialog-header">
          <h3 className="dialog-title">Quản Lý Chính Sách Giá</h3>
          <button className="dialog-close" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-body">
          <div className="content-layout">
            {/* Left Panel - Policy List */}
            <div className="panel list-panel">
              <div className="panel-header">
                <h4 className="panel-title">Danh Sách Chính Sách ({policies.length})</h4>
                <div className="header-actions">
                  <button className="refresh-button" onClick={loadData} disabled={isLoading}>
                    ↻ Làm mới
                  </button>
                </div>
              </div>

              <div className="panel-content">
                {isLoading ? (
                  <div className="loading-state">
                    <div className="loading-spinner"></div>
                    <p>Đang tải dữ liệu...</p>
                  </div>
                ) : policies.length === 0 ? (
                  <div className="empty-state">
                    <div className="empty-icon">💰</div>
                    <h4>Chưa có chính sách</h4>
                    <p>Thêm chính sách giá đầu tiên</p>
                  </div>
                ) : (
                  <div className="item-list">
                    {policies.map((policy, index) => (
                      <div
                        key={policy.maChinhSach || index}
                        className={`item-card ${selectedPolicy?.maChinhSach === policy.maChinhSach ? "selected" : ""}`}
                        onClick={() => handleSelectPolicy(policy)}
                      >
                        <div className="item-header">
                          <div>
                            <span className="item-code">{policy.maChinhSach}</span>
                            <span className="item-name">{policy.maLoaiPT}</span>
                          </div>
                          <div>
                            {policy.tongNgay > 0 ? (
                              <span
                                style={{
                                  background: "#10b981",
                                  color: "white",
                                  padding: "0.25rem 0.5rem",
                                  borderRadius: "4px",
                                  fontSize: "0.75rem",
                                }}
                              >
                                VIP
                              </span>
                            ) : (
                              <span
                                style={{
                                  background: "#6b7280",
                                  color: "white",
                                  padding: "0.25rem 0.5rem",
                                  borderRadius: "4px",
                                  fontSize: "0.75rem",
                                }}
                              >
                                Thường
                              </span>
                            )}
                          </div>
                        </div>
                        <div className="item-details">
                          <div>
                            {policy.tongNgay > 0
                              ? `${policy.loaiChinhSach} (${policy.tongNgay} ngày)`
                              : `${policy.thoiGian} phút`}
                          </div>
                          <div style={{ fontWeight: "600", color: "#10b981" }}>{formatCurrency(policy.donGia)}</div>
                          <div style={{ fontSize: "0.75rem", color: "#6b7280" }}>
                            Quá giờ: {policy.quaGio ? "Có" : "Không"}
                          </div>
                        </div>
                      </div>
                    ))}
                  </div>
                )}
              </div>
            </div>

            {/* Right Panel - Policy Form */}
            <div className="panel form-panel">
              <div className="panel-header">
                <h4 className="panel-title">
                  {isEditing ? (selectedPolicy ? "Sửa chính sách" : "Thêm chính sách mới") : "Chi tiết chính sách"}
                </h4>
              </div>

              <div className="panel-content">
                {!selectedPolicy && !isEditing ? (
                  <div className="empty-state">
                    <div className="empty-icon"></div>
                    <h4>Thêm chính sách</h4>
                    <p>Tạo chính sách giá mới cho hệ thống</p>
                    <button className="btn btn-primary" onClick={handleNewPolicy}>
                      + Thêm Chính Sách Mới
                    </button>
                  </div>
                ) : (
                  <div className="form-container">
                    <div className="form-group">
                      <label className="form-label">Mã chính sách *</label>
                      <input
                        type="text"
                        className={`form-input ${errors.maChinhSach ? "error" : ""}`}
                        value={formData.maChinhSach}
                        onChange={(e) => updateField("maChinhSach", e.target.value)}
                        disabled={!isEditing}
                        placeholder="Mã chính sách sẽ tự động sinh"
                      />
                      {errors.maChinhSach && <span className="error-message">{errors.maChinhSach}</span>}
                    </div>

                    <div className="form-group">
                      <label className="form-label">Loại phương tiện *</label>
                      <select
                        className={`form-select ${errors.maLoaiPT ? "error" : ""}`}
                        value={formData.maLoaiPT}
                        onChange={(e) => updateField("maLoaiPT", e.target.value)}
                        disabled={!isEditing}
                      >
                        <option value="">Chọn loại phương tiện</option>
                        {vehicleTypes.map((vt) => (
                          <option key={vt.maLoaiPT} value={vt.maLoaiPT}>
                            {vt.tenLoaiPT}
                          </option>
                        ))}
                      </select>
                      {errors.maLoaiPT && <span className="error-message">{errors.maLoaiPT}</span>}
                    </div>

                    {isEditing && (
                      <div className="form-group">
                        <label style={{ display: "flex", alignItems: "center", gap: "0.5rem" }}>
                          <input
                            type="checkbox"
                            checked={isSpecialOffer}
                            onChange={(e) => setIsSpecialOffer(e.target.checked)}
                          />
                          <span className="form-label" style={{ margin: 0 }}>
                            Chính sách ưu đãi đặc biệt (VIP)
                          </span>
                        </label>
                      </div>
                    )}

                    {isSpecialOffer ? (
                      // Form cho chính sách VIP
                      <>
                        <div style={{ display: "grid", gridTemplateColumns: "1fr 1fr", gap: "1rem" }}>
                          <div className="form-group">
                            <label className="form-label">Loại chính sách *</label>
                            <select
                              className="form-select"
                              value={policyType}
                              onChange={(e) => setPolicyType(e.target.value)}
                              disabled={!isEditing}
                            >
                              {POLICY_TYPE_OPTIONS.map((type) => (
                                <option key={type.value} value={type.value}>
                                  {type.label}
                                </option>
                              ))}
                            </select>
                          </div>

                          <div className="form-group">
                            <label className="form-label">Số lượng *</label>
                            <input
                              type="number"
                              className={`form-input ${errors.policyCount ? "error" : ""}`}
                              value={policyCount}
                              onChange={(e) => setPolicyCount(Number.parseInt(e.target.value) || 1)}
                              disabled={!isEditing}
                              min="1"
                            />
                            {errors.policyCount && <span className="error-message">{errors.policyCount}</span>}
                          </div>
                        </div>

                        <div className="form-group">
                          <label className="form-label">Tổng số ngày</label>
                          <input
                            type="number"
                            className="form-input"
                            value={formData.tongNgay}
                            disabled
                            style={{ backgroundColor: "#f3f4f6" }}
                          />
                          <small style={{ fontSize: "0.75rem", color: "#6b7280" }}>
                            Tự động tính từ loại chính sách và số lượng
                          </small>
                        </div>

                        <div className="form-group">
                          <label className="form-label">
                            Giá gói ({policyCount}{" "}
                            {POLICY_TYPE_OPTIONS.find((t) => t.value === policyType)?.label.toLowerCase()}) *
                          </label>
                          <input
                            type="number"
                            className={`form-input ${errors.donGia ? "error" : ""}`}
                            value={formData.donGia}
                            onChange={(e) => updateField("donGia", Number.parseInt(e.target.value) || 0)}
                            disabled={!isEditing}
                            min="0"
                            step="1000"
                          />
                          {errors.donGia && <span className="error-message">{errors.donGia}</span>}
                        </div>
                      </>
                    ) : (
                      // Form cho chính sách thường
                      <>
                        <div className="form-group">
                          <label className="form-label">Thời gian (phút) *</label>
                          <input
                            type="number"
                            className={`form-input ${errors.thoiGian ? "error" : ""}`}
                            value={formData.thoiGian}
                            onChange={(e) => updateField("thoiGian", Number.parseInt(e.target.value) || 0)}
                            disabled={!isEditing}
                            min="1"
                          />
                          {errors.thoiGian && <span className="error-message">{errors.thoiGian}</span>}
                        </div>

                        <div className="form-group">
                          <label className="form-label">Đơn giá cơ bản (VNĐ) *</label>
                          <input
                            type="number"
                            className={`form-input ${errors.donGia ? "error" : ""}`}
                            value={formData.donGia}
                            onChange={(e) => updateField("donGia", Number.parseInt(e.target.value) || 0)}
                            disabled={!isEditing}
                            min="0"
                            step="1000"
                          />
                          {errors.donGia && <span className="error-message">{errors.donGia}</span>}
                        </div>

                        {isEditing && (
                          <div className="form-group">
                            <label style={{ display: "flex", alignItems: "center", gap: "0.5rem" }}>
                              <input
                                type="checkbox"
                                checked={formData.quaGio === 1}
                                onChange={(e) => updateField("quaGio", e.target.checked ? 1 : 0)}
                              />
                              <span className="form-label" style={{ margin: 0 }}>
                                Có tính phí quá giờ
                              </span>
                            </label>
                          </div>
                        )}

                        {formData.quaGio === 1 && (
                          <div className="form-group">
                            <label className="form-label">Đơn giá quá giờ (VNĐ) *</label>
                            <input
                              type="number"
                              className={`form-input ${errors.donGiaQuaGio ? "error" : ""}`}
                              value={formData.donGiaQuaGio}
                              onChange={(e) => updateField("donGiaQuaGio", Number.parseInt(e.target.value) || 0)}
                              disabled={!isEditing}
                              min="0"
                              step="1000"
                            />
                            {errors.donGiaQuaGio && <span className="error-message">{errors.donGiaQuaGio}</span>}
                          </div>
                        )}
                      </>
                    )}

                    {/* Action Buttons */}
                    {isEditing ? (
                      <div style={{ display: "flex", gap: "0.75rem", marginTop: "1.5rem" }}>
                        <button className="btn btn-primary" onClick={handleSave} disabled={isLoading}>
                          {isLoading ? "Đang lưu..." : "Lưu"}
                        </button>
                        <button className="btn btn-secondary" onClick={handleCancel} disabled={isLoading}>
                          Hủy
                        </button>
                      </div>
                    ) : selectedPolicy ? (
                      <div style={{ display: "flex", gap: "0.75rem", marginTop: "1.5rem" }}>
                        <button className="btn btn-primary" onClick={handleEdit} disabled={isLoading}>
                          Sửa
                        </button>
                        <button className="btn btn-danger" onClick={handleDelete} disabled={isLoading}>
                          Xóa
                        </button>
                      </div>
                    ) : null}
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>

        <div className="dialog-footer">
          <button className="btn btn-secondary" onClick={onClose}>
            Đóng
          </button>
          {!isEditing && (
            <button className="btn btn-primary" onClick={handleNewPolicy}>
              + Thêm Chính Sách
            </button>
          )}
        </div>
      </div>
    </div>
  )
}

export default PricingPolicyDialog
