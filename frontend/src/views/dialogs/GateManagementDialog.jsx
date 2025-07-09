"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/GateManagementDialog.css"
import { 
  layDanhSachCong, 
  themCong, 
  capNhatCong, 
  xoaCong,
  layDanhSachKhuVuc
} from "../../api/api"

const GateManagementDialog = ({ onClose, onSave, selectedZone = null }) => {
  // Basic states
  const [gates, setGates] = useState([])
  const [filteredGates, setFilteredGates] = useState([])
  const [zones, setZones] = useState([])
  const [selectedGate, setSelectedGate] = useState(null)
  const [loading, setLoading] = useState(false)
  const [searchTerm, setSearchTerm] = useState("")
  const [zoneFilter, setZoneFilter] = useState(selectedZone || "all")
  const [typeFilter, setTypeFilter] = useState("all")
  
  // Dialog states
  const [showAddDialog, setShowAddDialog] = useState(false)
  const [isEditing, setIsEditing] = useState(false)
  const [validationErrors, setValidationErrors] = useState({})

  // Form state
  const [formData, setFormData] = useState({
    maCong: "",
    tenCong: "",
    loaiCong: "VAO",
    viTriLapDat: "",
    maKhuVuc: selectedZone || "",
    ghiChu: ""
  })

  // Gate types
  const gateTypes = [
    { value: 'VAO', label: 'Cổng vào', description: 'Cổng dành cho xe vào' },
    { value: 'RA', label: 'Cổng ra', description: 'Cổng dành cho xe ra' },
    { value: 'HAI_CHIEU', label: 'Cổng hai chiều', description: 'Cổng có thể vào và ra' }
  ]

  // Load data on mount
  useEffect(() => {
    loadGates()
    loadZones()
  }, [])

  // Filter gates when search/filter changes
  useEffect(() => {
    filterGates()
  }, [gates, searchTerm, zoneFilter, typeFilter])

  // Set default zone when selectedZone changes
  useEffect(() => {
    if (selectedZone) {
      setZoneFilter(selectedZone)
      setFormData(prev => ({ ...prev, maKhuVuc: selectedZone }))
    }
  }, [selectedZone])

  const loadGates = async () => {
    try {
      setLoading(true)
      const response = await layDanhSachCong()
      console.log("Gates response:", response)
      
      // Handle different response formats
      let gateData = []
      if (Array.isArray(response)) {
        gateData = response
      } else if (response && Array.isArray(response.data)) {
        gateData = response.data
      } else if (response && response.success && Array.isArray(response.data)) {
        gateData = response.data
      }
      
      setGates(gateData)
      console.log("Loaded gates:", gateData)
    } catch (error) {
      console.error("Error loading gates:", error)
      alert("Lỗi tải danh sách cổng: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const loadZones = async () => {
    try {
      const response = await layDanhSachKhuVuc()
      console.log("Zones response:", response)
      
      // Handle different response formats
      let zoneData = []
      if (Array.isArray(response)) {
        zoneData = response
      } else if (response && Array.isArray(response.data)) {
        zoneData = response.data
      }
      
      setZones(zoneData)
    } catch (error) {
      console.error("Error loading zones:", error)
    }
  }

  const filterGates = () => {
    let filtered = [...gates]

    // Search filter
    if (searchTerm) {
      filtered = filtered.filter(gate =>
        gate.maCong?.toLowerCase().includes(searchTerm.toLowerCase()) ||
        gate.tenCong?.toLowerCase().includes(searchTerm.toLowerCase()) ||
        gate.viTriLapDat?.toLowerCase().includes(searchTerm.toLowerCase())
      )
    }

    // Zone filter
    if (zoneFilter !== 'all') {
      filtered = filtered.filter(gate => gate.maKhuVuc === zoneFilter)
    }

    // Type filter
    if (typeFilter !== 'all') {
      filtered = filtered.filter(gate => gate.loaiCong === typeFilter)
    }

    setFilteredGates(filtered)
  }

  const handleAddGate = () => {
    setFormData({
      maCong: "",
      tenCong: "",
      loaiCong: "VAO",
      viTriLapDat: "",
      maKhuVuc: selectedZone || "",
      ghiChu: ""
    })
    setValidationErrors({})
    setIsEditing(false)
    setShowAddDialog(true)
  }

  const handleEditGate = (gate) => {
    setFormData({
      maCong: gate.maCong || "",
      tenCong: gate.tenCong || "",
      loaiCong: gate.loaiCong || "VAO",
      viTriLapDat: gate.viTriLapDat || "",
      maKhuVuc: gate.maKhuVuc || "",
      ghiChu: gate.ghiChu || ""
    })
    setValidationErrors({})
    setIsEditing(true)
    setShowAddDialog(true)
  }

  const handleSaveGate = async () => {
    try {
      // Validate form
      const errors = validateGateForm()
      if (Object.keys(errors).length > 0) {
        setValidationErrors(errors)
        return
      }

      setLoading(true)
      
      let result
      if (isEditing) {
        result = await capNhatCong(formData)
      } else {
        result = await themCong(formData)
      }

      console.log("Save result:", result)

      if (result && (result.success || result.success !== false)) {
        alert(isEditing ? "Cập nhật cổng thành công!" : "Thêm cổng thành công!")
        setShowAddDialog(false)
        await loadGates()
        if (onSave) onSave()
      } else {
        throw new Error(result?.message || "Thao tác thất bại")
      }
    } catch (error) {
      console.error("Error saving gate:", error)
      alert("Lỗi: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleDeleteGate = async (gate) => {
    if (!window.confirm(`Bạn có chắc muốn xóa cổng "${gate.tenCong}" (${gate.maCong})?`)) {
      return
    }

    try {
      setLoading(true)
      const result = await xoaCong(gate.maCong)
      
      if (result && (result.success || result.success !== false)) {
        alert("Xóa cổng thành công!")
        await loadGates()
        if (onSave) onSave()
      } else {
        throw new Error(result?.message || "Xóa thất bại")
      }
    } catch (error) {
      console.error("Error deleting gate:", error)
      alert("Lỗi xóa cổng: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleInputChange = (field, value) => {
    setFormData(prev => ({
      ...prev,
      [field]: value
    }))
    
    // Clear validation error for this field
    if (validationErrors[field]) {
      setValidationErrors(prev => ({
        ...prev,
        [field]: null
      }))
    }
  }

  const validateGateForm = () => {
    const errors = {}
    
    if (!formData.maCong || formData.maCong.trim() === '') {
      errors.maCong = 'Mã cổng không được để trống'
    }
    
    if (!formData.tenCong || formData.tenCong.trim() === '') {
      errors.tenCong = 'Tên cổng không được để trống'
    }
    
    if (!formData.loaiCong) {
      errors.loaiCong = 'Loại cổng không được để trống'
    }
    
    if (!formData.maKhuVuc) {
      errors.maKhuVuc = 'Khu vực không được để trống'
    }
    
    // Check for duplicate gate code (only when adding new)
    if (!isEditing && gates.some(g => g.maCong === formData.maCong)) {
      errors.maCong = 'Mã cổng đã tồn tại'
    }
    
    return errors
  }

  const getGateTypeName = (type) => {
    const gateType = gateTypes.find(t => t.value === type)
    return gateType ? gateType.label : type
  }

  const getZoneName = (zoneCode) => {
    const zone = zones.find(z => z.maKhuVuc === zoneCode)
    return zone ? zone.tenKhuVuc : zoneCode
  }

  const getGateTypeColor = (type) => {
    switch(type) {
      case 'VAO': return '#10b981'
      case 'RA': return '#ef4444'
      case 'HAI_CHIEU': return '#f59e0b'
      default: return '#6b7280'
    }
  }

  return (
    <div className="dialog-overlay">
      <div className="dialog-container large">
        <div className="dialog-header">
          <h2>Quản lý cổng</h2>
          <button className="close-btn" onClick={onClose}>×</button>
        </div>

        <div className="dialog-body">
          {/* Toolbar */}
          <div className="toolbar">
            <div className="toolbar-left">
              <button className="btn btn-primary" onClick={handleAddGate}>
                + Thêm cổng mới
              </button>
              <button className="btn btn-secondary" onClick={loadGates}>
                🔄 Tải lại
              </button>
            </div>
            
            <div className="toolbar-right">
              <input
                type="text"
                placeholder="Tìm kiếm cổng..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="search-input"
              />
            </div>
          </div>

          {/* Filters */}
          <div className="filters">
            <div className="filter-group">
              <label>Khu vực:</label>
              <select 
                value={zoneFilter} 
                onChange={(e) => setZoneFilter(e.target.value)}
                className="filter-select"
              >
                <option value="all">Tất cả khu vực</option>
                {zones.map(zone => (
                  <option key={zone.maKhuVuc} value={zone.maKhuVuc}>
                    {zone.tenKhuVuc} ({zone.maKhuVuc})
                  </option>
                ))}
              </select>
            </div>

            <div className="filter-group">
              <label>Loại cổng:</label>
              <select 
                value={typeFilter} 
                onChange={(e) => setTypeFilter(e.target.value)}
                className="filter-select"
              >
                <option value="all">Tất cả loại</option>
                {gateTypes.map(type => (
                  <option key={type.value} value={type.value}>
                    {type.label}
                  </option>
                ))}
              </select>
            </div>
          </div>

          {/* Statistics */}
          <div className="stats">
            <div className="stat-item">
              <span className="stat-label">Tổng cổng:</span>
              <span className="stat-value">{filteredGates.length}</span>
            </div>
            <div className="stat-item">
              <span className="stat-label">Cổng vào:</span>
              <span className="stat-value">{filteredGates.filter(g => g.loaiCong === 'VAO').length}</span>
            </div>
            <div className="stat-item">
              <span className="stat-label">Cổng ra:</span>
              <span className="stat-value">{filteredGates.filter(g => g.loaiCong === 'RA').length}</span>
            </div>
          </div>

          {/* Gates List */}
          <div className="gates-list">
            {loading ? (
              <div className="loading">Đang tải danh sách cổng...</div>
            ) : filteredGates.length === 0 ? (
              <div className="no-data">
                {searchTerm || zoneFilter !== 'all' || typeFilter !== 'all' 
                  ? 'Không tìm thấy cổng nào phù hợp với bộ lọc' 
                  : 'Chưa có cổng nào trong hệ thống'}
              </div>
            ) : (
              <div className="gates-grid">
                {filteredGates.map(gate => (
                  <div key={gate.maCong} className="gate-card">
                    <div className="gate-header">
                      <div className="gate-code">{gate.maCong}</div>
                      <div className="gate-actions">
                        <button 
                          className="btn btn-sm btn-outline"
                          onClick={() => handleEditGate(gate)}
                          title="Sửa cổng"
                        >
                        </button>
                        <button 
                          className="btn btn-sm btn-danger"
                          onClick={() => handleDeleteGate(gate)}
                          title="Xóa cổng"
                        >
                        </button>
                      </div>
                    </div>
                    
                    <div className="gate-info">
                      <div className="gate-name">{gate.tenCong}</div>
                      <div className="gate-type" style={{ color: getGateTypeColor(gate.loaiCong) }}>
                        {getGateTypeName(gate.loaiCong)}
                      </div>
                      <div className="gate-zone">
                        📍 {getZoneName(gate.maKhuVuc)}
                      </div>
                      {gate.viTriLapDat && (
                        <div className="gate-location">
                          📍 {gate.viTriLapDat}
                        </div>
                      )}
                    </div>
                  </div>
                ))}
              </div>
            )}
          </div>
        </div>

        <div className="dialog-footer">
          <button className="btn btn-secondary" onClick={onClose}>
            Đóng
          </button>
        </div>
      </div>

      {/* Add/Edit Gate Dialog */}
      {showAddDialog && (
        <div className="dialog-overlay">
          <div className="dialog-container">
            <div className="dialog-header">
              <h3>{isEditing ? 'Sửa cổng' : 'Thêm cổng mới'}</h3>
              <button className="close-btn" onClick={() => setShowAddDialog(false)}>×</button>
            </div>

            <div className="dialog-body">
              <div className="form-grid">
                <div className="form-group">
                  <label>Mã cổng *</label>
                  <input
                    type="text"
                    value={formData.maCong}
                    onChange={(e) => handleInputChange('maCong', e.target.value)}
                    className={`form-input ${validationErrors.maCong ? 'error' : ''}`}
                    placeholder="Nhập mã cổng (VD: GATE01)"
                    disabled={isEditing}
                  />
                  {validationErrors.maCong && (
                    <span className="error-text">{validationErrors.maCong}</span>
                  )}
                </div>

                <div className="form-group">
                  <label>Tên cổng *</label>
                  <input
                    type="text"
                    value={formData.tenCong}
                    onChange={(e) => handleInputChange('tenCong', e.target.value)}
                    className={`form-input ${validationErrors.tenCong ? 'error' : ''}`}
                    placeholder="Nhập tên cổng"
                  />
                  {validationErrors.tenCong && (
                    <span className="error-text">{validationErrors.tenCong}</span>
                  )}
                </div>

                <div className="form-group">
                  <label>Loại cổng *</label>
                  <select
                    value={formData.loaiCong}
                    onChange={(e) => handleInputChange('loaiCong', e.target.value)}
                    className={`form-select ${validationErrors.loaiCong ? 'error' : ''}`}
                  >
                    {gateTypes.map(type => (
                      <option key={type.value} value={type.value}>
                        {type.label} - {type.description}
                      </option>
                    ))}
                  </select>
                  {validationErrors.loaiCong && (
                    <span className="error-text">{validationErrors.loaiCong}</span>
                  )}
                </div>

                <div className="form-group">
                  <label>Khu vực *</label>
                  <select
                    value={formData.maKhuVuc}
                    onChange={(e) => handleInputChange('maKhuVuc', e.target.value)}
                    className={`form-select ${validationErrors.maKhuVuc ? 'error' : ''}`}
                  >
                    <option value="">Chọn khu vực</option>
                    {zones.map(zone => (
                      <option key={zone.maKhuVuc} value={zone.maKhuVuc}>
                        {zone.tenKhuVuc} ({zone.maKhuVuc})
                      </option>
                    ))}
                  </select>
                  {validationErrors.maKhuVuc && (
                    <span className="error-text">{validationErrors.maKhuVuc}</span>
                  )}
                </div>

                <div className="form-group full-width">
                  <label>Vị trí lắp đặt</label>
                  <input
                    type="text"
                    value={formData.viTriLapDat}
                    onChange={(e) => handleInputChange('viTriLapDat', e.target.value)}
                    className="form-input"
                    placeholder="Nhập vị trí lắp đặt cổng"
                  />
                </div>

                <div className="form-group full-width">
                  <label>Ghi chú</label>
                  <textarea
                    value={formData.ghiChu}
                    onChange={(e) => handleInputChange('ghiChu', e.target.value)}
                    className="form-textarea"
                    placeholder="Nhập ghi chú (tùy chọn)"
                    rows="3"
                  />
                </div>
              </div>
            </div>

            <div className="dialog-footer">
              <button className="btn btn-secondary" onClick={() => setShowAddDialog(false)}>
                Hủy
              </button>
              <button 
                className="btn btn-primary" 
                onClick={handleSaveGate}
                disabled={loading}
              >
                {loading ? 'Đang xử lý...' : (isEditing ? 'Cập nhật' : 'Thêm mới')}
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  )
}

export default GateManagementDialog
