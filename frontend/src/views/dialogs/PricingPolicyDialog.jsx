"use client"

import { useState, useEffect, useMemo } from "react"
import "../../assets/styles/PricingPolicyDialog.css"
import { 
  layDanhSachChinhSachGiaV2, 
  themChinhSachV2, 
  suaChinhSachV2, 
  xoaChinhSachV2,
  layALLLoaiPhuongTien,
  taoMaChinhSachTuDong,
  tinhTongNgay
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
    maChinhSach: '',
    maLoaiPT: '',
    thoiGian: 0,
    donGia: 0,
    quaGio: 0,
    donGiaQuaGio: 0,
    loaiChinhSach: '',
    tongNgay: 0,
  })

  // Enhanced states theo mobile app
  const [errors, setErrors] = useState({})
  const [policyType, setPolicyType] = useState('N') // Đồng bộ với mobile: 'N' cho Ngày
  const [policyCount, setPolicyCount] = useState(1)
  const [isSpecialOffer, setIsSpecialOffer] = useState(false)

  // Policy type options - đồng bộ với mobile app
  const POLICY_TYPE_OPTIONS = [
    { label: 'Ngày', value: 'N', days: 1 },
    { label: 'Tuần', value: 'T', days: 7 },
    { label: 'Tháng', value: 'Th', days: 30 },
    { label: 'Năm', value: 'NAM', days: 365 },
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
    return ''
  }, [formData.maLoaiPT, policyType, policyCount, isSpecialOffer])

  // Tự động tính tổng ngày (realtime update)
  useEffect(() => {
    if (isSpecialOffer) {
      const totalDays = tinhTongNgay(policyType, policyCount)
      const typeOption = POLICY_TYPE_OPTIONS.find(t => t.value === policyType)
      const newLoaiChinhSach = `${policyCount} ${typeOption?.label || ''}`
      
      setFormData(prev => ({
        ...prev,
        tongNgay: totalDays,
        loaiChinhSach: newLoaiChinhSach
      }))
      console.log(`Đã cập nhật tongNgay: ${totalDays}, loaiChinhSach: "${newLoaiChinhSach}" cho chính sách VIP`)
    } else {
      setFormData(prev => ({
        ...prev,
        tongNgay: 0,
        loaiChinhSach: policyType // Dùng policyType thay vì để trống
      }))
      console.log(`Đã reset tongNgay về 0 và loaiChinhSach về "${policyType}" cho chính sách thường`)
    }
  }, [policyType, policyCount, isSpecialOffer])

  // Cập nhật mã chính sách tự động (realtime update)
  useEffect(() => {
    setFormData(prev => ({
      ...prev,
      maChinhSach: maChinhSach
    }))
  }, [maChinhSach])

  const loadData = async () => {
    try {
      setIsLoading(true)
      const [policyData, vehicleData] = await Promise.all([
        layDanhSachChinhSachGiaV2(),
        layALLLoaiPhuongTien()
      ])

      setPolicies(Array.isArray(policyData) ? policyData : [])
      setVehicleTypes(Array.isArray(vehicleData) ? vehicleData : [])
    } catch (error) {
      console.error('Lỗi load dữ liệu:', error)
      alert('Lỗi tải dữ liệu: ' + error.message)
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
        const count = parseInt(match[1])
        const typeLabel = match[2]
        const typeOption = POLICY_TYPE_OPTIONS.find(opt => opt.label === typeLabel)
        if (typeOption) {
          setPolicyType(typeOption.value)
          setPolicyCount(count)
          console.log(`Parsed VIP policy - type: ${typeOption.value}, count: ${count}, loaiChinhSach: "${policy.loaiChinhSach}", tongNgay: ${policy.tongNgay}`)
        }
      }
    } else {
      // Reset về giá trị mặc định cho chính sách thường
      setPolicyType('N')
      setPolicyCount(1)
      console.log('Selected normal policy - reset policyType: N, policyCount: 1')
    }

    setFormData({
      maChinhSach: policy.maChinhSach || '',
      maLoaiPT: policy.maLoaiPT || '',
      thoiGian: policy.thoiGian || 0,
      donGia: policy.donGia || 0,
      quaGio: policy.quaGio || 0,
      donGiaQuaGio: policy.donGiaQuaGio || 0,
      loaiChinhSach: policy.loaiChinhSach || '',
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
    setPolicyType('N')
    setPolicyCount(1)
    setFormData({
      maChinhSach: '',
      maLoaiPT: '',
      thoiGian: 240, // 4 tiếng mặc định
      donGia: 5000,
      quaGio: 0,
      donGiaQuaGio: 2000,
      loaiChinhSach: '',
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
      newErrors.maChinhSach = 'Mã chính sách không được để trống'
    }

    if (!formData.maLoaiPT) {
      newErrors.maLoaiPT = 'Vui lòng chọn loại phương tiện'
    }

    if (isSpecialOffer) {
      if (policyCount <= 0) {
        newErrors.policyCount = 'Số lượng phải lớn hơn 0'
      }
      if (formData.donGia <= 0) {
        newErrors.donGia = 'Giá gói phải lớn hơn 0'
      }
    } else {
      if (formData.thoiGian <= 0) {
        newErrors.thoiGian = 'Thời gian phải lớn hơn 0'
      }
      if (formData.donGia <= 0) {
        newErrors.donGia = 'Đơn giá phải lớn hơn 0'
      }
      if (formData.quaGio === 1 && formData.donGiaQuaGio <= 0) {
        newErrors.donGiaQuaGio = 'Đơn giá quá giờ phải lớn hơn 0'
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
          ? `${policyCount} ${POLICY_TYPE_OPTIONS.find(t => t.value === policyType)?.label || ''}` 
          : policyType // Nếu không ưu đãi, dùng policyType
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
        alert(selectedPolicy ? 'Cập nhật chính sách thành công!' : 'Thêm chính sách thành công!')
        setIsEditing(false)
        await loadData()
      } else {
        alert(result?.message || 'Không thể lưu chính sách')
      }
    } catch (error) {
      console.error('Lỗi submit form:', error)
      alert('Có lỗi xảy ra: ' + error.message)
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
          alert('Xóa chính sách thành công!')
          await loadData()
          clearForm()
        } else {
          alert(result?.message || 'Không thể xóa chính sách')
        }
      } catch (error) {
        console.error('Lỗi xóa:', error)
        alert('Có lỗi xảy ra khi xóa: ' + error.message)
      } finally {
        setIsLoading(false)
      }
    }
  }

  const clearForm = () => {
    setFormData({
      maChinhSach: '',
      maLoaiPT: '',
      thoiGian: 240,
      donGia: 5000,
      quaGio: 0,
      donGiaQuaGio: 2000,
      loaiChinhSach: '',
      tongNgay: 0,
    })
    setSelectedPolicy(null)
    setIsEditing(false)
    setIsSpecialOffer(false)
    setPolicyType('N')
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
    setFormData(prev => ({
      ...prev,
      [field]: value
    }))
    if (errors[field]) {
      setErrors(prev => ({...prev, [field]: ''}))
    }
  }

  const formatCurrency = (amount) => {
    return new Intl.NumberFormat("vi-VN", {
      style: "currency",
      currency: "VND",
    }).format(amount)
  }

  const getSelectedVehicleTypeLabel = () => {
    const selected = vehicleTypes.find(vt => vt.maLoaiPT === formData.maLoaiPT)
    return selected ? selected.tenLoaiPT : 'Chọn loại phương tiện'
  }

  return (
    <div className="dialog-overlay">
      <div className="pricing-policy-dialog">
        {/* Header */}
        <div className="dialog-header">
          <h3>Quản Lý Chính Sách Giá</h3>
          <button className="close-button" onClick={onClose}>×</button>
        </div>

        <div className="dialog-content">
          <div className="content-layout">
            {/* Left Panel - Policy List */}
            <div className="policy-list-panel">
              <div className="panel-header">
                <h4>Danh Sách Chính Sách ({policies.length})</h4>
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
                        <th>Loại CS</th>
                        <th>Thời gian/Ngày</th>
                        <th>Đơn giá</th>
                        <th>Quá giờ</th>
                      </tr>
                    </thead>
                    <tbody>
                      {policies.length === 0 ? (
                        <tr>
                          <td colSpan="6" className="no-data">
                            Chưa có chính sách nào
                          </td>
                        </tr>
                      ) : (
                        policies.map((policy, index) => (
                          <tr
                            key={policy.maChinhSach || index}
                            className={selectedPolicy?.maChinhSach === policy.maChinhSach ? "selected" : ""}
                            onClick={() => handleSelectPolicy(policy)}
                          >
                            <td>{policy.maChinhSach}</td>
                            <td>{policy.maLoaiPT}</td>
                            <td>
                              {policy.tongNgay > 0 ? (
                                <span className="vip-badge">
                                  {policy.loaiChinhSach}
                                </span>
                              ) : (
                                <span className="normal-badge">Thường</span>
                              )}
                            </td>
                            <td>
                              {policy.tongNgay > 0 ? 
                                `${policy.tongNgay} ngày` : 
                                `${policy.thoiGian} phút`
                              }
                            </td>
                            <td>{formatCurrency(policy.donGia)}</td>
                            <td>
                              <span className={`status ${policy.quaGio ? "active" : "inactive"}`}>
                                {policy.quaGio ? "Có" : "Không"}
                              </span>
                            </td>
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
                <h4>{isEditing ? (selectedPolicy ? 'Sửa chính sách' : 'Thêm chính sách mới') : 'Chi tiết chính sách'}</h4>
              </div>

              <div className="form-container">
                <div className="form-group">
                  <label>Mã chính sách *</label>
                  <input
                    type="text"
                    value={formData.maChinhSach}
                    onChange={(e) => updateField('maChinhSach', e.target.value)}
                    disabled={!isEditing}
                    className={errors.maChinhSach ? 'error' : ''}
                    placeholder="Mã chính sách sẽ tự động sinh"
                  />
                  {errors.maChinhSach && <span className="error-message">{errors.maChinhSach}</span>}
                </div>

                <div className="form-group">
                  <label>Loại phương tiện *</label>
                  <select
                    value={formData.maLoaiPT}
                    onChange={(e) => updateField('maLoaiPT', e.target.value)}
                    disabled={!isEditing}
                    className={errors.maLoaiPT ? 'error' : ''}
                  >
                    <option value="">Chọn loại phương tiện</option>
                    {vehicleTypes.map(vt => (
                      <option key={vt.maLoaiPT} value={vt.maLoaiPT}>
                        {vt.tenLoaiPT}
                      </option>
                    ))}
                  </select>
                  {errors.maLoaiPT && <span className="error-message">{errors.maLoaiPT}</span>}
                </div>

                <div className="form-group checkbox-group">
                  <label className="checkbox-label">
                    <input
                      type="checkbox"
                      checked={isSpecialOffer}
                      onChange={(e) => setIsSpecialOffer(e.target.checked)}
                      disabled={!isEditing}
                    />
                    <span className="checkmark"></span>
                    Chính sách ưu đãi đặc biệt (VIP)
                  </label>
                </div>

                {isSpecialOffer ? (
                  // Form cho chính sách VIP
                  <>
                    <div className="form-row">
                      <div className="form-group">
                        <label>Loại chính sách *</label>
                        <select
                          value={policyType}
                          onChange={(e) => setPolicyType(e.target.value)}
                          disabled={!isEditing}
                        >
                          {POLICY_TYPE_OPTIONS.map(type => (
                            <option key={type.value} value={type.value}>
                              {type.label}
                            </option>
                          ))}
                        </select>
                      </div>

                      <div className="form-group">
                        <label>Số lượng *</label>
                        <input
                          type="number"
                          value={policyCount}
                          onChange={(e) => setPolicyCount(parseInt(e.target.value) || 1)}
                          disabled={!isEditing}
                          min="1"
                          className={errors.policyCount ? 'error' : ''}
                        />
                        {errors.policyCount && <span className="error-message">{errors.policyCount}</span>}
                      </div>
                    </div>

                    <div className="form-group">
                      <label>Tổng số ngày</label>
                      <input
                        type="number"
                        value={formData.tongNgay}
                        disabled
                        style={{ backgroundColor: '#f5f5f5' }}
                      />
                      <small className="form-help">
                        Tự động tính từ loại chính sách và số lượng
                      </small>
                    </div>

                    <div className="form-group">
                      <label>Giá gói ({policyCount} {POLICY_TYPE_OPTIONS.find(t => t.value === policyType)?.label.toLowerCase()}) *</label>
                      <input
                        type="number"
                        value={formData.donGia}
                        onChange={(e) => updateField('donGia', parseInt(e.target.value) || 0)}
                        disabled={!isEditing}
                        min="0"
                        step="1000"
                        className={errors.donGia ? 'error' : ''}
                      />
                      {errors.donGia && <span className="error-message">{errors.donGia}</span>}
                    </div>
                  </>
                ) : (
                  // Form cho chính sách thường
                  <>
                    <div className="form-group">
                      <label>Thời gian (phút) *</label>
                      <input
                        type="number"
                        value={formData.thoiGian}
                        onChange={(e) => updateField('thoiGian', parseInt(e.target.value) || 0)}
                        disabled={!isEditing}
                        min="1"
                        className={errors.thoiGian ? 'error' : ''}
                      />
                      {errors.thoiGian && <span className="error-message">{errors.thoiGian}</span>}
                    </div>

                    <div className="form-group">
                      <label>Đơn giá cơ bản (VNĐ) *</label>
                      <input
                        type="number"
                        value={formData.donGia}
                        onChange={(e) => updateField('donGia', parseInt(e.target.value) || 0)}
                        disabled={!isEditing}
                        min="0"
                        step="1000"
                        className={errors.donGia ? 'error' : ''}
                      />
                      {errors.donGia && <span className="error-message">{errors.donGia}</span>}
                    </div>

                    <div className="form-group checkbox-group">
                      <label className="checkbox-label">
                        <input
                          type="checkbox"
                          checked={formData.quaGio === 1}
                          onChange={(e) => updateField('quaGio', e.target.checked ? 1 : 0)}
                          disabled={!isEditing}
                        />
                        <span className="checkmark"></span>
                        Có tính phí quá giờ
                      </label>
                    </div>

                    {formData.quaGio === 1 && (
                      <div className="form-group">
                        <label>Đơn giá quá giờ (VNĐ) *</label>
                        <input
                          type="number"
                          value={formData.donGiaQuaGio}
                          onChange={(e) => updateField('donGiaQuaGio', parseInt(e.target.value) || 0)}
                          disabled={!isEditing}
                          min="0"
                          step="1000"
                          className={errors.donGiaQuaGio ? 'error' : ''}
                        />
                        {errors.donGiaQuaGio && <span className="error-message">{errors.donGiaQuaGio}</span>}
                      </div>
                    )}
                  </>
                )}

                {/* Action Buttons */}
                <div className="button-group">
                  <button 
                    className="btn btn-primary" 
                    onClick={handleNewPolicy} 
                    disabled={isLoading}
                  >
                    Thêm mới
                  </button>

                  {selectedPolicy && !isEditing && (
                    <button 
                      className="btn btn-secondary" 
                      onClick={handleEdit} 
                      disabled={isLoading}
                    >
                      Sửa
                    </button>
                  )}

                  {selectedPolicy && !isEditing && (
                    <button 
                      className="btn btn-danger" 
                      onClick={handleDelete} 
                      disabled={isLoading}
                    >
                      Xóa
                    </button>
                  )}

                  {isEditing && (
                    <>
                      <button 
                        className="btn btn-success" 
                        onClick={handleSave} 
                        disabled={isLoading}
                      >
                        {isLoading ? "Đang lưu..." : "Lưu"}
                      </button>
                      <button 
                        className="btn btn-cancel" 
                        onClick={handleCancel} 
                        disabled={isLoading}
                      >
                        Hủy
                      </button>
                    </>
                  )}

                  <button 
                    className="btn btn-refresh" 
                    onClick={clearForm} 
                    disabled={isLoading}
                  >
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
