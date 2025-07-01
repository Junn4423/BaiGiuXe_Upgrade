"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/dialog-base.css"
import { layDanhSachPhuongTien, themPhuongTien, capNhatPhuongTien, xoaPhuongTien, layALLLoaiPhuongTien } from "../../api/api"

const QuanLyPhuongTienDialog = ({ onClose }) => {
  const [vehicles, setVehicles] = useState([])
  const [vehicleTypes, setVehicleTypes] = useState([])
  const [isLoading, setIsLoading] = useState(false)
  const [error, setError] = useState("")
  const [selectedVehicle, setSelectedVehicle] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [formData, setFormData] = useState({
    bienSo: "",
    maLoaiPT: ""
  })

  useEffect(() => {
    loadData()
  }, [])

  const loadData = async () => {
    try {
      setIsLoading(true)
      const [vehiclesData, typesData] = await Promise.all([
        layDanhSachPhuongTien(),
        layALLLoaiPhuongTien()
      ])
      
      setVehicles(Array.isArray(vehiclesData) ? vehiclesData : [])
      setVehicleTypes(Array.isArray(typesData) ? typesData : [])
      setError("")
    } catch (error) {
      setError("Không thể tải dữ liệu: " + error.message)
    } finally {
      setIsLoading(false)
    }
  }

  const handleAdd = () => {
    setSelectedVehicle(null)
    setFormData({ bienSo: "", maLoaiPT: "" })
    setIsEditing(true)
  }

  const handleEdit = (vehicle) => {
    setSelectedVehicle(vehicle)
    setFormData({
      bienSo: vehicle.bienSo,
      maLoaiPT: vehicle.maLoaiPT
    })
    setIsEditing(true)
  }

  const handleSave = async () => {
    try {
      if (!formData.bienSo.trim() || !formData.maLoaiPT) {
        setError("Vui lòng nhập đầy đủ thông tin")
        return
      }

      setIsLoading(true)
      
      let result
      if (selectedVehicle) {
        result = await capNhatPhuongTien(formData)
      } else {
        result = await themPhuongTien(formData)
      }

      if (result && result.success) {
        await loadData()
        setIsEditing(false)
        setError("")
      } else {
        throw new Error(result?.message || "Có lỗi xảy ra")
      }
    } catch (error) {
      setError(error.message)
    } finally {
      setIsLoading(false)
    }
  }

  const handleDelete = async (bienSo) => {
    if (!window.confirm("Bạn có chắc muốn xóa phương tiện này?")) {
      return
    }

    try {
      setIsLoading(true)
      const result = await xoaPhuongTien(bienSo)
      
      if (result && result.success) {
        await loadData()
        setError("")
      } else {
        throw new Error(result?.message || "Có lỗi xảy ra")
      }
    } catch (error) {
      setError(error.message)
    } finally {
      setIsLoading(false)
    }
  }

  const getVehicleTypeName = (maLoaiPT) => {
    const type = vehicleTypes.find(vt => vt.maLoaiPT === maLoaiPT)
    return type ? type.tenLoaiPT : maLoaiPT
  }

  return (
    <div className="dialog-overlay">
      <div className="dialog-container extra-large">
        {/* Left Panel - Form */}
        <div className="dialog-left-panel">
          <div className="dialog-title-bar">
            <span className="dialog-title">Quản Lý Phương Tiện</span>
            <button className="dialog-close" onClick={onClose}>✕</button>
          </div>

          <div className="dialog-content">
            {!isEditing ? (
              <>
                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1rem' }}>
                  <h3>Danh Sách Phương Tiện</h3>
                  <button className="dialog-btn dialog-btn-primary" onClick={handleAdd}>
                    + Thêm Mới
                  </button>
                </div>

                <div style={{ maxHeight: '400px', overflowY: 'auto', border: '1px solid #e5e7eb', borderRadius: '8px' }}>
                  <table style={{ width: '100%', borderCollapse: 'collapse' }}>
                    <thead style={{ background: '#f9fafb', borderBottom: '1px solid #e5e7eb' }}>
                      <tr>
                        <th style={{ padding: '0.75rem', textAlign: 'left', fontSize: '0.875rem', fontWeight: '600' }}>Biển Số</th>
                        <th style={{ padding: '0.75rem', textAlign: 'left', fontSize: '0.875rem', fontWeight: '600' }}>Loại PT</th>
                        <th style={{ padding: '0.75rem', textAlign: 'center', fontSize: '0.875rem', fontWeight: '600' }}>Thao Tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      {vehicles.map((vehicle, index) => (
                        <tr key={index} style={{ borderBottom: '1px solid #f3f4f6' }}>
                          <td style={{ padding: '0.75rem', fontSize: '0.875rem', fontFamily: 'monospace' }}>
                            {vehicle.bienSo}
                          </td>
                          <td style={{ padding: '0.75rem', fontSize: '0.875rem' }}>
                            {getVehicleTypeName(vehicle.maLoaiPT)}
                          </td>
                          <td style={{ padding: '0.75rem', textAlign: 'center' }}>
                            <button
                              onClick={() => handleEdit(vehicle)}
                              style={{ marginRight: '0.5rem', padding: '0.25rem 0.5rem', fontSize: '0.75rem' }}
                              className="dialog-btn dialog-btn-secondary"
                            >
                              Sửa
                            </button>
                            <button
                              onClick={() => handleDelete(vehicle.bienSo)}
                              style={{ padding: '0.25rem 0.5rem', fontSize: '0.75rem', background: '#dc2626', color: 'white', border: 'none', borderRadius: '4px' }}
                            >
                              Xóa
                            </button>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                  
                  {vehicles.length === 0 && (
                    <div style={{ padding: '2rem', textAlign: 'center', color: '#6b7280' }}>
                      Chưa có phương tiện nào
                    </div>
                  )}
                </div>
              </>
            ) : (
              <>
                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1rem' }}>
                  <h3>{selectedVehicle ? "Sửa Phương Tiện" : "Thêm Phương Tiện Mới"}</h3>
                  <button className="dialog-btn dialog-btn-secondary" onClick={() => setIsEditing(false)}>
                    ← Quay Lại
                  </button>
                </div>

                <div className="dialog-form-group">
                  <label className="dialog-label">Biển Số *</label>
                  <input
                    type="text"
                    className="dialog-input"
                    value={formData.bienSo}
                    onChange={(e) => setFormData(prev => ({ ...prev, bienSo: e.target.value.toUpperCase() }))}
                    placeholder="Nhập biển số xe"
                    style={{ fontFamily: 'monospace', fontSize: '1.1rem' }}
                    disabled={!!selectedVehicle} // Không cho sửa biển số khi edit
                  />
                </div>

                <div className="dialog-form-group">
                  <label className="dialog-label">Loại Phương Tiện *</label>
                  <select
                    className="dialog-select"
                    value={formData.maLoaiPT}
                    onChange={(e) => setFormData(prev => ({ ...prev, maLoaiPT: e.target.value }))}
                  >
                    <option value="">-- Chọn loại phương tiện --</option>
                    {vehicleTypes.map((type) => (
                      <option key={type.maLoaiPT} value={type.maLoaiPT}>
                        {type.maLoaiPT} - {type.tenLoaiPT}
                      </option>
                    ))}
                  </select>
                </div>
              </>
            )}

            {error && <div className="dialog-error">{error}</div>}
          </div>

          <div className="dialog-footer">
            <button className="dialog-btn dialog-btn-secondary" onClick={onClose}>
              Đóng
            </button>
            {isEditing && (
              <button 
                className="dialog-btn dialog-btn-primary" 
                onClick={handleSave}
                disabled={isLoading || !formData.bienSo.trim() || !formData.maLoaiPT}
              >
                {isLoading ? "Đang lưu..." : (selectedVehicle ? "Cập Nhật" : "Thêm Mới")}
              </button>
            )}
          </div>
        </div>

        {/* Right Panel - Statistics */}
        <div className="dialog-right-panel">
          <div className="dialog-info-card">
            <div className="dialog-info-title">Thống Kê</div>
            <div style={{ fontSize: '0.85rem', lineHeight: '1.6', color: '#6b7280' }}>
              <div><strong>Tổng phương tiện:</strong> {vehicles.length}</div>
              <div><strong>Loại phương tiện:</strong> {vehicleTypes.length}</div>
            </div>
          </div>

          <div className="dialog-info-card">
            <div className="dialog-info-title">Phân Loại Phương Tiện</div>
            <div style={{ fontSize: '0.8rem', color: '#6b7280' }}>
              {vehicleTypes.map(type => {
                const count = vehicles.filter(v => v.maLoaiPT === type.maLoaiPT).length
                return (
                  <div key={type.maLoaiPT} style={{ padding: '0.25rem 0', display: 'flex', justifyContent: 'space-between' }}>
                    <span>{type.tenLoaiPT}</span>
                    <span style={{ fontWeight: '600' }}>{count}</span>
                  </div>
                )
              })}
            </div>
          </div>

          <div className="dialog-info-card">
            <div className="dialog-info-title">Hướng Dẫn</div>
            <div style={{ fontSize: '0.8rem', color: '#6b7280', lineHeight: '1.5' }}>
              • Biển số phải là duy nhất trong hệ thống<br/>
              • Không thể thay đổi biển số sau khi tạo<br/>
              • Chọn đúng loại phương tiện để áp dụng chính sách giá phù hợp<br/>
              • Xóa phương tiện sẽ không ảnh hưởng đến các phiên gửi xe đã tồn tại
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default QuanLyPhuongTienDialog
