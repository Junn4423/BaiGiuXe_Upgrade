"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/VehicleManagementDialog.css"
import { 
  layDanhSachPhuongTien, 
  themPhuongTien, 
  capNhatPhuongTien, 
  xoaPhuongTien,
  layALLLoaiPhuongTien 
} from "../../api/api"

const VehicleManagementDialog = ({ onClose }) => {
  const [vehicles, setVehicles] = useState([])
  const [vehicleTypes, setVehicleTypes] = useState([])
  const [selectedVehicle, setSelectedVehicle] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [isLoading, setIsLoading] = useState(false)
  const [isSubmitting, setIsSubmitting] = useState(false)

  // Form data state
  const [formData, setFormData] = useState({
    bienSo: '',
    maLoaiPT: '',
  })

  // Error state
  const [errors, setErrors] = useState({})

  // Load vehicles and vehicle types when component mounts
  useEffect(() => {
    console.log("VehicleManagementDialog mounted, loading data...")
    loadData()
  }, [])

  const loadData = async () => {
    try {
      setIsLoading(true)
      console.log("Loading vehicles and vehicle types...")
      
      const [vehicleList, typeList] = await Promise.all([
        layDanhSachPhuongTien(),
        layALLLoaiPhuongTien()
      ])
      
      console.log("Loaded vehicles:", vehicleList)
      console.log("Loaded vehicle types:", typeList)
      
      setVehicles(Array.isArray(vehicleList) ? vehicleList : [])
      setVehicleTypes(Array.isArray(typeList) ? typeList : [])
    } catch (error) {
      console.error("Error loading data:", error)
      alert("Lỗi tải dữ liệu: " + error.message)
      setVehicles([])
      setVehicleTypes([])
    } finally {
      setIsLoading(false)
    }
  }

  const handleSelectVehicle = (vehicle) => {
    console.log("Selected vehicle:", vehicle)
    setSelectedVehicle(vehicle)
    setFormData({
      bienSo: vehicle.bienSo || "",
      maLoaiPT: vehicle.maLoaiPT || "",
    })
    setIsEditing(false)
    setErrors({})
  }

  const handleNewVehicle = () => {
    console.log("Creating new vehicle")
    setSelectedVehicle(null)
    setIsEditing(true)
    setFormData({
      bienSo: "",
      maLoaiPT: "",
    })
    setErrors({})
  }

  const handleEdit = () => {
    if (!selectedVehicle) {
      alert("Vui lòng chọn phương tiện cần sửa")
      return
    }
    console.log("Editing vehicle:", selectedVehicle)
    setIsEditing(true)
    setErrors({})
  }

  const validateForm = () => {
    const newErrors = {}

    if (!formData.bienSo.trim()) {
      newErrors.bienSo = "Vui lòng nhập biển số xe"
    }

    if (!formData.maLoaiPT) {
      newErrors.maLoaiPT = "Vui lòng chọn loại phương tiện"
    }

    setErrors(newErrors)
    return Object.keys(newErrors).length === 0
  }

  const handleSave = async () => {
    console.log("Saving vehicle...")
    if (!validateForm()) return

    try {
      setIsSubmitting(true)
      const vehicleData = {
        bienSo: formData.bienSo.trim().toUpperCase(),
        maLoaiPT: formData.maLoaiPT,
      }

      console.log("Vehicle data to save:", vehicleData)

      let result
      if (selectedVehicle) {
        // Update existing vehicle
        console.log("Updating existing vehicle:", selectedVehicle.bienSo)
        result = await capNhatPhuongTien(vehicleData)
      } else {
        // Add new vehicle
        console.log("Adding new vehicle")
        result = await themPhuongTien(vehicleData)
      }

      console.log("Save result:", result)

      if (result && result.success !== false) {
        alert(selectedVehicle ? "Cập nhật phương tiện thành công!" : "Thêm phương tiện thành công!")
        await loadData()
        setIsEditing(false)
        setSelectedVehicle(vehicleData)
        setFormData(vehicleData)
      } else {
        alert(result?.message || "Không thể lưu phương tiện")
      }
    } catch (error) {
      console.error("Error saving vehicle:", error)
      alert("Lỗi lưu phương tiện: " + error.message)
    } finally {
      setIsSubmitting(false)
    }
  }

  const handleDelete = async () => {
    if (!selectedVehicle) {
      alert("Vui lòng chọn phương tiện cần xóa")
      return
    }

    if (window.confirm(`Bạn có chắc muốn xóa phương tiện "${selectedVehicle.bienSo}"?`)) {
      try {
        setIsSubmitting(true)
        console.log("Deleting vehicle:", selectedVehicle.bienSo)
        const result = await xoaPhuongTien(selectedVehicle.bienSo)
        console.log("Delete result:", result)

        if (result && result.success !== false) {
          alert("Xóa phương tiện thành công!")
          await loadData()
          clearForm()
        } else {
          alert(result?.message || "Không thể xóa phương tiện")
        }
      } catch (error) {
        console.error("Error deleting vehicle:", error)
        alert("Lỗi xóa phương tiện: " + error.message)
      } finally {
        setIsSubmitting(false)
      }
    }
  }

  const clearForm = () => {
    console.log("Clearing form")
    setFormData({
      bienSo: "",
      maLoaiPT: "",
    })
    setSelectedVehicle(null)
    setIsEditing(false)
    setErrors({})
  }

  const handleCancel = () => {
    console.log("Canceling edit")
    if (selectedVehicle) {
      setFormData({
        bienSo: selectedVehicle.bienSo || "",
        maLoaiPT: selectedVehicle.maLoaiPT || "",
      })
    } else {
      clearForm()
    }
    setIsEditing(false)
    setErrors({})
  }

  const updateField = (field, value) => {
    console.log(`Changing ${field} to:`, value)
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }))
    
    // Clear error when user starts typing
    if (errors[field]) {
      setErrors(prev => ({
        ...prev,
        [field]: ''
      }))
    }
  }

  const getSelectedVehicleTypeLabel = () => {
    if (!selectedVehicle?.maLoaiPT) return "Chưa xác định"
    const type = vehicleTypes.find(t => t.maLoaiPT === selectedVehicle.maLoaiPT)
    return type ? `${type.tenLoaiPT} (${type.maLoaiPT})` : selectedVehicle.maLoaiPT
  }

  const getVehicleTypeLabel = (maLoaiPT) => {
    const type = vehicleTypes.find(t => t.maLoaiPT === maLoaiPT)
    return type ? `${type.tenLoaiPT} (${type.maLoaiPT})` : maLoaiPT
  }

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
                <h4>Danh sách phương tiện ({vehicles.length})</h4>
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
                  <div className="no-data">
                    Chưa có phương tiện nào
                  </div>
                ) : (
                  <table className="vehicle-table">
                    <thead>
                      <tr>
                        <th>Biển số</th>
                        <th>Loại phương tiện</th>
                        <th>Mã loại</th>
                      </tr>
                    </thead>
                    <tbody>
                      {vehicles.map((vehicle, index) => (
                        <tr 
                          key={vehicle.bienSo || index}
                          className={selectedVehicle?.bienSo === vehicle.bienSo ? 'selected' : ''}
                          onClick={() => handleSelectVehicle(vehicle)}
                        >
                          <td>{vehicle.bienSo}</td>
                          <td>{getVehicleTypeLabel(vehicle.maLoaiPT)}</td>
                          <td>{vehicle.maLoaiPT}</td>
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
                    ? (selectedVehicle ? "Sửa phương tiện" : "Thêm phương tiện mới")
                    : (selectedVehicle ? "Thông tin phương tiện" : "Chưa chọn phương tiện")
                  }
                </h4>
                {!isEditing && selectedVehicle && (
                  <div className="action-buttons">
                    <button 
                      className="btn btn-primary" 
                      onClick={handleEdit}
                      disabled={isSubmitting}
                    >
                      ✏️ Sửa
                    </button>
                    <button 
                      className="btn btn-danger" 
                      onClick={handleDelete}
                      disabled={isSubmitting}
                    >
                      🗑️ Xóa
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
                          onChange={(e) => updateField('bienSo', e.target.value)}
                          disabled={!isEditing || isSubmitting}
                          placeholder="Nhập biển số xe"
                          className={errors.bienSo ? 'error' : ''}
                          style={{ textTransform: 'uppercase' }}
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
                          onChange={(e) => updateField('maLoaiPT', e.target.value)}
                          disabled={!isEditing || isSubmitting}
                          className={errors.maLoaiPT ? 'error' : ''}
                        >
                          <option value="">-- Chọn loại phương tiện --</option>
                          {vehicleTypes.map((type) => (
                            <option key={type.maLoaiPT} value={type.maLoaiPT}>
                              {type.tenLoaiPT} ({type.maLoaiPT})
                            </option>
                          ))}
                        </select>
                        {errors.maLoaiPT && (
                          <span className="error-message">{errors.maLoaiPT}</span>
                        )}
                      </div>
                    </div>

                    {/* Display info when not editing */}
                    {!isEditing && selectedVehicle && (
                      <div className="info-section">
                        <div className="info-row">
                          <span className="info-label">Biển số:</span>
                          <span className="info-value">{selectedVehicle.bienSo}</span>
                        </div>
                        <div className="info-row">
                          <span className="info-label">Loại phương tiện:</span>
                          <span className="info-value">{getSelectedVehicleTypeLabel()}</span>
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
                    {isSubmitting ? "Đang lưu..." : "💾 Lưu"}
                  </button>
                  <button 
                    className="btn btn-cancel" 
                    onClick={handleCancel}
                    disabled={isSubmitting}
                  >
                    ❌ Hủy
                  </button>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default VehicleManagementDialog
