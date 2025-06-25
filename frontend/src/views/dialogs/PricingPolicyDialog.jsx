"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/PricingPolicyDialog.css"
import { layALLChinhSachGia, themChinhSachGia, capNhatChinhSachGia, xoaChinhSachGia } from "../../api/api"

const PricingPolicyDialog = ({ onClose }) => {
  const [policies, setPolicies] = useState([])
  const [selectedPolicy, setSelectedPolicy] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [isLoading, setIsLoading] = useState(false)

  // Form data state
  const [formData, setFormData] = useState({
    policyId: "",
    vehicleType: "XE_MAY",
    timeLimit: "240",
    basePrice: "5000",
    overTimePrice: "2000",
  })
  const [overTime, setOverTime] = useState(false)

  // Load policies when component mounts
  useEffect(() => {
    console.log("PricingPolicyDialog mounted, loading policies...")
    loadPolicies()
  }, [])

  const loadPolicies = async () => {
    try {
      setIsLoading(true)
      console.log("Loading policies from API...")
      const policyList = await layALLChinhSachGia()
      console.log("Loaded policies:", policyList)

      if (Array.isArray(policyList)) {
        setPolicies(policyList)
      } else {
        console.warn("Policy list is not an array:", policyList)
        setPolicies([])
      }
    } catch (error) {
      console.error("Error loading policies:", error)
      alert("Lỗi tải danh sách chính sách giá: " + error.message)
      setPolicies([])
    } finally {
      setIsLoading(false)
    }
  }

  const handleSelectPolicy = (policy) => {
    console.log("Selected policy:", policy)
    setSelectedPolicy(policy)
    setFormData({
      policyId: policy.lv001 || "",
      vehicleType: policy.lv002 || "XE_MAY",
      timeLimit: (policy.lv003 || 240).toString(),
      basePrice: (policy.lv004 || 5000).toString(),
      overTimePrice: (policy.lv006 || 2000).toString(),
    })
    setOverTime(Number.parseInt(policy.lv005) === 1)
    setIsEditing(false)
  }

  const handleNewPolicy = () => {
    console.log("Creating new policy")
    setSelectedPolicy(null)
    setFormData({
      policyId: "",
      vehicleType: "XE_MAY",
      timeLimit: "240",
      basePrice: "5000",
      overTimePrice: "2000",
    })
    setOverTime(false)
    setIsEditing(true)
  }

  const handleEdit = () => {
    if (!selectedPolicy) {
      alert("Vui lòng chọn chính sách cần sửa")
      return
    }
    console.log("Editing policy:", selectedPolicy)
    setIsEditing(true)
  }

  const validateInput = () => {
    if (!formData.policyId.trim()) {
      alert("Vui lòng nhập mã chính sách")
      return false
    }
    if (!formData.vehicleType) {
      alert("Vui lòng chọn loại xe")
      return false
    }

    const timeLimit = Number.parseInt(formData.timeLimit)
    if (isNaN(timeLimit) || timeLimit <= 0) {
      alert("Thời gian phải lớn hơn 0")
      return false
    }

    const basePrice = Number.parseFloat(formData.basePrice)
    if (isNaN(basePrice) || basePrice < 0) {
      alert("Đơn giá gói không được âm")
      return false
    }

    const overTimePrice = Number.parseFloat(formData.overTimePrice)
    if (isNaN(overTimePrice) || overTimePrice < 0) {
      alert("Đơn giá quá giờ không được âm")
      return false
    }

    return true
  }

  const handleSave = async () => {
    console.log("Saving policy...")
    if (!validateInput()) return

    try {
      setIsLoading(true)
      const policyData = {
        lv001: formData.policyId.trim(),
        lv002: formData.vehicleType,
        lv003: Number.parseInt(formData.timeLimit),
        lv004: Number.parseFloat(formData.basePrice),
        lv005: overTime ? 1 : 0,
        lv006: Number.parseFloat(formData.overTimePrice),
      }

      console.log("Policy data to save:", policyData)

      let result
      if (selectedPolicy) {
        // Update existing policy
        console.log("Updating existing policy:", selectedPolicy.lv001)
        result = await capNhatChinhSachGia(selectedPolicy.lv001, policyData)
      } else {
        // Add new policy
        console.log("Adding new policy")
        result = await themChinhSachGia(policyData)
      }

      console.log("Save result:", result)

      if (result && result.success) {
        alert(selectedPolicy ? "Cập nhật chính sách thành công!" : "Thêm chính sách thành công!")
        await loadPolicies()
        setIsEditing(false)
      } else {
        alert(result?.message || "Không thể lưu chính sách")
      }
    } catch (error) {
      console.error("Error saving policy:", error)
      alert("Lỗi lưu chính sách: " + error.message)
    } finally {
      setIsLoading(false)
    }
  }

  const handleDelete = async () => {
    if (!selectedPolicy) {
      alert("Vui lòng chọn chính sách cần xóa")
      return
    }

    if (window.confirm(`Bạn có chắc muốn xóa chính sách "${selectedPolicy.lv001}"?`)) {
      try {
        setIsLoading(true)
        console.log("Deleting policy:", selectedPolicy.lv001)
        const result = await xoaChinhSachGia(selectedPolicy.lv001)
        console.log("Delete result:", result)

        if (result && result.success) {
          alert("Xóa chính sách thành công!")
          await loadPolicies()
          clearForm()
        } else {
          alert(result?.message || "Không thể xóa chính sách")
        }
      } catch (error) {
        console.error("Error deleting policy:", error)
        alert("Lỗi xóa chính sách: " + error.message)
      } finally {
        setIsLoading(false)
      }
    }
  }

  const clearForm = () => {
    console.log("Clearing form")
    setFormData({
      policyId: "",
      vehicleType: "XE_MAY",
      timeLimit: "240",
      basePrice: "5000",
      overTimePrice: "2000",
    })
    setOverTime(false)
    setSelectedPolicy(null)
    setIsEditing(false)
  }

  const handleCancel = () => {
    console.log("Canceling edit")
    if (selectedPolicy) {
      // Restore original values
      setFormData({
        policyId: selectedPolicy.lv001 || "",
        vehicleType: selectedPolicy.lv002 || "XE_MAY",
        timeLimit: (selectedPolicy.lv003 || 240).toString(),
        basePrice: (selectedPolicy.lv004 || 5000).toString(),
        overTimePrice: (selectedPolicy.lv006 || 2000).toString(),
      })
      setOverTime(Number.parseInt(selectedPolicy.lv005) === 1)
    } else {
      clearForm()
    }
    setIsEditing(false)
  }

  const handleInputChange = (field, value) => {
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }))
  }

  const formatCurrency = (amount) => {
    return new Intl.NumberFormat("vi-VN", {
      style: "currency",
      currency: "VND",
    }).format(amount)
  }

  const handleBackToStartup = () => {
    console.log("Back to startup")
    onClose()
  }

  return (
    <div className="dialog-overlay">
      <div className="pricing-policy-dialog">
        {/* Header */}
        <div className="dialog-header">
          <button className="back-button" onClick={handleBackToStartup}>
            Quay lại
          </button>
          <h3>Quản Lý Chính Sách Giá</h3>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          <div className="content-layout">
            {/* Left Panel - Policy List */}
            <div className="policy-list-panel">
              <div className="panel-header">
                <h4>Danh Sách Chính Sách</h4>
              </div>

              <div className="policy-table-container">
                {isLoading ? (
                  <div className="loading-message">Đang tải dữ liệu...</div>
                ) : (
                  <table className="policy-table">
                    <thead>
                      <tr>
                        <th>Mã chính sách</th>
                        <th>Loại xe</th>
                        <th>Thời gian (phút)</th>
                        <th>Đơn giá gói</th>
                        <th>Tính quá giờ</th>
                        <th>Đơn giá quá giờ</th>
                      </tr>
                    </thead>
                    <tbody>
                      {policies.length === 0 ? (
                        <tr>
                          <td colSpan="6" className="no-data">
                            Không có dữ liệu
                          </td>
                        </tr>
                      ) : (
                        policies.map((policy, index) => (
                          <tr
                            key={policy.lv001 || index}
                            className={selectedPolicy?.lv001 === policy.lv001 ? "selected" : ""}
                            onClick={() => handleSelectPolicy(policy)}
                          >
                            <td>{policy.lv001}</td>
                            <td>{policy.lv002}</td>
                            <td>{policy.lv003}</td>
                            <td>{formatCurrency(policy.lv004)}</td>
                            <td>
                              <span className={`status ${Number.parseInt(policy.lv005) ? "active" : "inactive"}`}>
                                {Number.parseInt(policy.lv005) ? "Có" : "Không"}
                              </span>
                            </td>
                            <td>{formatCurrency(policy.lv006)}</td>
                          </tr>
                        ))
                      )}
                    </tbody>
                  </table>
                )}
              </div>
            </div>

            {/* Right Panel - Policy Form */}
            <div className="policy-form-panel">
              <div className="panel-header">
                <h4>Thông Tin Chính Sách</h4>
              </div>

              <div className="form-container">
                <div className="form-group">
                  <label>Mã chính sách:</label>
                  <input
                    type="text"
                    value={formData.policyId}
                    onChange={(e) => handleInputChange("policyId", e.target.value)}
                    disabled={!isEditing || (selectedPolicy && !isEditing)}
                    placeholder="Nhập mã chính sách"
                  />
                </div>

                <div className="form-group">
                  <label>Loại xe:</label>
                  <select
                    value={formData.vehicleType}
                    onChange={(e) => handleInputChange("vehicleType", e.target.value)}
                    disabled={!isEditing}
                  >
                    <option value="XE_MAY">XE_MAY</option>
                    <option value="OT">OT</option>
                  </select>
                </div>

                <div className="form-group">
                  <label>Thời gian (phút):</label>
                  <input
                    type="number"
                    value={formData.timeLimit}
                    onChange={(e) => handleInputChange("timeLimit", e.target.value)}
                    disabled={!isEditing}
                    min="1"
                  />
                </div>

                <div className="form-group">
                  <label>Đơn giá gói:</label>
                  <input
                    type="number"
                    value={formData.basePrice}
                    onChange={(e) => handleInputChange("basePrice", e.target.value)}
                    disabled={!isEditing}
                    min="0"
                    step="1000"
                  />
                </div>

                <div className="form-group">
                  <label>Đơn giá quá giờ:</label>
                  <input
                    type="number"
                    value={formData.overTimePrice}
                    onChange={(e) => handleInputChange("overTimePrice", e.target.value)}
                    disabled={!isEditing}
                    min="0"
                    step="1000"
                  />
                </div>

                <div className="form-group checkbox-group">
                  <label>
                    <input
                      type="checkbox"
                      checked={overTime}
                      onChange={(e) => setOverTime(e.target.checked)}
                      disabled={!isEditing}
                    />
                    Tính phí quá giờ
                  </label>
                </div>

                {/* Action Buttons */}
                <div className="button-group">
                  <button className="btn btn-primary" onClick={handleNewPolicy} disabled={isLoading}>
                    Thêm mới
                  </button>

                  {selectedPolicy && !isEditing && (
                    <button className="btn btn-secondary" onClick={handleEdit} disabled={isLoading}>
                      Cập nhật
                    </button>
                  )}

                  {selectedPolicy && !isEditing && (
                    <button className="btn btn-danger" onClick={handleDelete} disabled={isLoading}>
                      Xóa
                    </button>
                  )}

                  {isEditing && (
                    <>
                      <button className="btn btn-success" onClick={handleSave} disabled={isLoading}>
                        {isLoading ? "Đang lưu..." : "Lưu"}
                      </button>
                      <button className="btn btn-cancel" onClick={handleCancel} disabled={isLoading}>
                        Hủy
                      </button>
                    </>
                  )}

                  <button className="btn btn-refresh" onClick={clearForm} disabled={isLoading}>
                    Làm mới
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default PricingPolicyDialog
