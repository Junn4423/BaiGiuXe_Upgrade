"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/VehicleTypeDialog.css"
import { 
  layALLLoaiPhuongTien, 
  themLoaiPhuongTien, 
  capNhatLoaiPhuongTien, 
  xoaLoaiPhuongTien 
} from "../../api/api"

const VehicleTypeDialog = ({ onClose }) => {
  const [vehicleTypes, setVehicleTypes] = useState([])
  const [selectedType, setSelectedType] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [isLoading, setIsLoading] = useState(false)
  const [isSubmitting, setIsSubmitting] = useState(false)

  // Form data state
  const [formData, setFormData] = useState({
    maLoaiPT: '',
    tenLoaiPT: '',
    moTa: '',
    loaiXe: 0, // 0: xe máy, 1: ô tô
  })

  const [errors, setErrors] = useState({})

  // Vehicle type options
  const VEHICLE_TYPE_OPTIONS = [
    { label: 'Xe máy', value: 0 },
    { label: 'Ô tô', value: 1 },
  ]

  // Load vehicle types when component mounts
  useEffect(() => {
    console.log("VehicleTypeDialog mounted, loading data...")
    loadData()
  }, [])

  const loadData = async () => {
    try {
      setIsLoading(true)
      const vehicleTypeData = await layALLLoaiPhuongTien()
      
      if (vehicleTypeData && vehicleTypeData.length > 0) {
        setVehicleTypes(vehicleTypeData)
        console.log(`Loaded ${vehicleTypeData.length} vehicle types`)
      } else {
        console.log("No vehicle types found")
        setVehicleTypes([])
      }
    } catch (error) {
      console.error("Error loading vehicle types:", error)
      setVehicleTypes([])
    } finally {
      setIsLoading(false)
    }
  }

  const validateForm = () => {
    const newErrors = {}

    if (!formData.maLoaiPT?.trim()) {
      newErrors.maLoaiPT = "Mã loại phương tiện không được để trống"
    }

    if (!formData.tenLoaiPT?.trim()) {
      newErrors.tenLoaiPT = "Tên loại phương tiện không được để trống"
    }

    if (formData.loaiXe !== 0 && formData.loaiXe !== 1) {
      newErrors.loaiXe = "Loại xe phải là xe máy hoặc ô tô"
    }

    setErrors(newErrors)
    return Object.keys(newErrors).length === 0
  }

  const handleSubmit = async (e) => {
    e.preventDefault()
    
    if (!validateForm()) {
      return
    }

    try {
      setIsSubmitting(true)
      console.log("Submitting vehicle type:", formData)

      if (isEditing && selectedType) {
        // Update existing vehicle type
        await capNhatLoaiPhuongTien(formData)
        console.log("Vehicle type updated successfully")
      } else {
        // Create new vehicle type
        await themLoaiPhuongTien(formData)
        console.log("Vehicle type created successfully")
      }

      // Reload data and reset form
      await loadData()
      resetForm()
    } catch (error) {
      console.error("Error saving vehicle type:", error)
      setErrors({ submit: "Có lỗi xảy ra khi lưu loại phương tiện" })
    } finally {
      setIsSubmitting(false)
    }
  }

  const handleEdit = (vehicleType) => {
    console.log("Editing vehicle type:", vehicleType)
    setSelectedType(vehicleType)
    setFormData({
      maLoaiPT: vehicleType.maLoaiPT || '',
      tenLoaiPT: vehicleType.tenLoaiPT || '',
      moTa: vehicleType.moTa || '',
      loaiXe: parseInt(vehicleType.loaiXe) || 0,
    })
    setIsEditing(true)
    setErrors({})
  }

  const handleDelete = async (maLoaiPT) => {
    if (!window.confirm("Bạn có chắc chắn muốn xóa loại phương tiện này?")) {
      return
    }

    try {
      setIsLoading(true)
      console.log("Deleting vehicle type:", maLoaiPT)
      await xoaLoaiPhuongTien(maLoaiPT)
      console.log("Vehicle type deleted successfully")
      await loadData()
      
      // Reset form if the deleted item was being edited
      if (selectedType && selectedType.maLoaiPT === maLoaiPT) {
        resetForm()
      }
    } catch (error) {
      console.error("Error deleting vehicle type:", error)
      alert("Có lỗi xảy ra khi xóa loại phương tiện")
    } finally {
      setIsLoading(false)
    }
  }

  const resetForm = () => {
    setFormData({
      maLoaiPT: '',
      tenLoaiPT: '',
      moTa: '',
      loaiXe: 0,
    })
    setSelectedType(null)
    setIsEditing(false)
    setErrors({})
  }

  const handleInputChange = (field, value) => {
    setFormData(prev => ({ ...prev, [field]: value }))
    // Clear error when user starts typing
    if (errors[field]) {
      setErrors(prev => ({ ...prev, [field]: '' }))
    }
  }

  return (
    <div className="dialog-overlay" onClick={(e) => e.target === e.currentTarget && onClose()}>
      <div className="vehicle-type-dialog">
        <div className="dialog-header">
          <h3>Quản lý loại phương tiện</h3>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          <div className="content-layout">
            {/* Vehicle Type List Panel */}
            <div className="vehicle-type-list-panel">
              <div className="panel-header">
                <h4>Danh sách loại phương tiện</h4>
                <div className="header-actions">
                  <button 
                    className="refresh-button"
                    onClick={loadData}
                    disabled={isLoading}
                  >
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
                ) : vehicleTypes.length > 0 ? (
                  <div className="vehicle-type-list">
                    {vehicleTypes.map((vehicleType) => (
                      <div 
                        key={vehicleType.maLoaiPT} 
                        className={`vehicle-type-item ${selectedType?.maLoaiPT === vehicleType.maLoaiPT ? 'selected' : ''}`}
                      >
                        <div className="vehicle-type-info">
                          <div className="vehicle-type-main">
                            <span className="vehicle-type-code">{vehicleType.maLoaiPT}</span>
                            <span className="vehicle-type-name">{vehicleType.tenLoaiPT}</span>
                          </div>
                          <div className="vehicle-type-details">
                            <span className="vehicle-type-category">
                              {vehicleType.loaiXe == 1 ? "Ô tô" : "Xe máy"}
                            </span>
                            {vehicleType.moTa && (
                              <span className="vehicle-type-description">{vehicleType.moTa}</span>
                            )}
                          </div>
                        </div>
                        <div className="vehicle-type-actions">
                          <button 
                            className="edit-button"
                            onClick={() => handleEdit(vehicleType)}
                          >
                            Sửa
                          </button>
                          <button 
                            className="delete-button"
                            onClick={() => handleDelete(vehicleType.maLoaiPT)}
                          >
                            Xóa
                          </button>
                        </div>
                      </div>
                    ))}
                  </div>
                ) : (
                  <div className="empty-state">
                    <div className="empty-icon"></div>
                    <h4>Chưa có loại phương tiện</h4>
                    <p>Tạo loại phương tiện đầu tiên bằng form bên phải</p>
                  </div>
                )}
              </div>
            </div>

            {/* Vehicle Type Form Panel */}
            <div className="vehicle-type-form-panel">
              <div className="panel-header">
                <h4>{isEditing ? 'Sửa loại phương tiện' : 'Thêm loại phương tiện mới'}</h4>
                {isEditing && (
                  <button 
                    className="cancel-edit-button"
                    onClick={resetForm}
                  >
                    Hủy sửa
                  </button>
                )}
              </div>

              <div className="panel-content">
                <form onSubmit={handleSubmit} className="vehicle-type-form">
                  {errors.submit && (
                    <div className="error-message submit-error">
                      {errors.submit}
                    </div>
                  )}

                  <div className="form-group">
                    <label htmlFor="maLoaiPT">Mã loại phương tiện *</label>
                    <input
                      type="text"
                      id="maLoaiPT"
                      value={formData.maLoaiPT}
                      onChange={(e) => handleInputChange('maLoaiPT', e.target.value)}
                      className={errors.maLoaiPT ? 'error' : ''}
                      placeholder="VD: XM01, OTO01"
                      disabled={isEditing} // Không cho sửa mã khi đang edit
                    />
                    {errors.maLoaiPT && (
                      <span className="error-message">{errors.maLoaiPT}</span>
                    )}
                  </div>

                  <div className="form-group">
                    <label htmlFor="tenLoaiPT">Tên loại phương tiện *</label>
                    <input
                      type="text"
                      id="tenLoaiPT"
                      value={formData.tenLoaiPT}
                      onChange={(e) => handleInputChange('tenLoaiPT', e.target.value)}
                      className={errors.tenLoaiPT ? 'error' : ''}
                      placeholder="VD: Xe máy Honda, Ô tô 4 chỗ"
                    />
                    {errors.tenLoaiPT && (
                      <span className="error-message">{errors.tenLoaiPT}</span>
                    )}
                  </div>

                  <div className="form-group">
                    <label htmlFor="loaiXe">Loại xe *</label>
                    <select
                      id="loaiXe"
                      value={formData.loaiXe}
                      onChange={(e) => handleInputChange('loaiXe', parseInt(e.target.value))}
                      className={errors.loaiXe ? 'error' : ''}
                    >
                      {VEHICLE_TYPE_OPTIONS.map(option => (
                        <option key={option.value} value={option.value}>
                          {option.label}
                        </option>
                      ))}
                    </select>
                    {errors.loaiXe && (
                      <span className="error-message">{errors.loaiXe}</span>
                    )}
                  </div>

                  <div className="form-group">
                    <label htmlFor="moTa">Mô tả</label>
                    <textarea
                      id="moTa"
                      value={formData.moTa}
                      onChange={(e) => handleInputChange('moTa', e.target.value)}
                      placeholder="Mô tả chi tiết về loại phương tiện..."
                      rows={3}
                    />
                  </div>

                  <div className="form-actions">
                    <button 
                      type="button" 
                      className="cancel-button"
                      onClick={resetForm}
                      disabled={isSubmitting}
                    >
                      Hủy
                    </button>
                    <button 
                      type="submit" 
                      className="submit-button"
                      disabled={isSubmitting}
                    >
                      {isSubmitting ? (
                        <>
                          <span className="loading-spinner small"></span>
                          {isEditing ? 'Đang cập nhật...' : 'Đang tạo...'}
                        </>
                      ) : (
                        isEditing ? 'Cập nhật' : 'Tạo mới'
                      )}
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default VehicleTypeDialog
