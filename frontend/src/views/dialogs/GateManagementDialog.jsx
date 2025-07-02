"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/GateManagementDialog.css"
import { layDanhSachCong, themCong, capNhatCong, xoaCong } from "../../api/api"

const GateManagementDialog = ({ onClose, onSave, zoneId, zoneName }) => {
  const [gates, setGates] = useState([])
  const [selectedGate, setSelectedGate] = useState(null)
  const [isEditing, setIsEditing] = useState(false)
  const [loading, setLoading] = useState(false)
  const [formData, setFormData] = useState({
    maCong: "",
    tenCong: "",
    loaiCong: "VAO", // VAO, RA
    maKhuVuc: zoneId || "",
    trangThai: "HOAT_DONG",
    moTa: "",
    ipAddress: "",
    port: "80",
  })

  useEffect(() => {
    if (zoneId) {
      setFormData(prev => ({ ...prev, maKhuVuc: zoneId }))
      loadGates()
    }
  }, [zoneId])

  const loadGates = async () => {
    try {
      setLoading(true)
      const gateData = await layDanhSachCong()
      const zoneGates = gateData.filter(gate => gate.maKhuVuc === zoneId)
      setGates(Array.isArray(zoneGates) ? zoneGates : [])
    } catch (error) {
      console.error("Error loading gates:", error)
      alert("Lỗi tải danh sách cổng: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleSubmit = async (e) => {
    e.preventDefault()
    
    if (!formData.maCong || !formData.tenCong) {
      alert("Vui lòng điền đầy đủ thông tin bắt buộc")
      return
    }

    try {
      setLoading(true)
      let result
      
      const gateData = {
        ...formData,
        maKhuVuc: zoneId
      }
      
      if (isEditing) {
        result = await capNhatCong(gateData)
      } else {
        result = await themCong(gateData)
      }
      
      if (result.success) {
        alert(isEditing ? "Cập nhật cổng thành công!" : "Thêm cổng thành công!")
        resetForm()
        loadGates()
        onSave()
      } else {
        throw new Error(result.message || "Thao tác thất bại")
      }
    } catch (error) {
      console.error("Error saving gate:", error)
      alert("Lỗi: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleEdit = (gate) => {
    setFormData({...gate})
    setSelectedGate(gate)
    setIsEditing(true)
  }

  const handleDelete = async (gate) => {
    if (!window.confirm(`Bạn có chắc muốn xóa cổng "${gate.tenCong}"?`)) {
      return
    }

    try {
      setLoading(true)
      const result = await xoaCong(gate.maCong)
      
      if (result.success) {
        alert("Xóa cổng thành công!")
        loadGates()
        onSave()
      } else {
        throw new Error(result.message || "Xóa thất bại")
      }
    } catch (error) {
      console.error("Error deleting gate:", error)
      alert("Lỗi xóa cổng: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const resetForm = () => {
    setFormData({
      maCong: "",
      tenCong: "",
      loaiCong: "VAO",
      maKhuVuc: zoneId,
      trangThai: "HOAT_DONG",
      moTa: "",
      ipAddress: "",
      port: "80",
    })
    setSelectedGate(null)
    setIsEditing(false)
  }

  const handleInputChange = (field, value) => {
    setFormData(prev => ({
      ...prev,
      [field]: value
    }))
  }

  const testGateConnection = async (ipAddress, port) => {
    if (!ipAddress) {
      alert("Chưa có địa chỉ IP để test")
      return
    }
    
    try {
      setLoading(true)
      // Simulate connection test
      const testUrl = `http://${ipAddress}:${port}`
      alert(`Đang test kết nối đến: ${testUrl}`)
      // In real implementation, you would make an actual request
    } catch (error) {
      alert("Lỗi test kết nối: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  return (
    <div className="dialog-overlay">
      <div className="dialog-container extra-large">
        <div className="dialog-header">
          <h2 className="dialog-title">Quản Lý Cổng - {zoneName}</h2>
          <button className="dialog-close" onClick={onClose}>×</button>
        </div>

        <div className="dialog-subtitle">
          Quản lý cổng ra vào cho khu vực {zoneName}
        </div>

        <div className="dialog-content main-sidebar">
          {/* Left Panel - Gate List */}
          <div className="dialog-panel">
            <div className="dialog-panel-title">
              Danh Sách Cổng ({gates.length})
            </div>
            
            <div className="gate-list">
              {loading ? (
                <div className="loading-message">Đang tải...</div>
              ) : gates.length === 0 ? (
                <div className="empty-message">Chưa có cổng nào</div>
              ) : (
                gates.map((gate, index) => (
                  <div key={gate.maCong || index} className="gate-item">
                    <div className="gate-info">
                      <div className="gate-name">{gate.tenCong}</div>
                      <div className="gate-details">
                        <span className={`gate-type ${gate.loaiCong.toLowerCase()}`}>
                          {gate.loaiCong === 'VAO' ? 'Vào' : 'Ra'}
                        </span>
                        <span className={`gate-status ${gate.trangThai.toLowerCase().replace('_', '-')}`}>
                          {gate.trangThai === 'HOAT_DONG' ? 'Hoạt động' : 'Tạm dừng'}
                        </span>
                      </div>
                      {gate.ipAddress && (
                        <div className="gate-ip">{gate.ipAddress}:{gate.port}</div>
                      )}
                    </div>
                    
                    <div className="gate-actions">
                      <button 
                        className="btn-icon edit" 
                        onClick={() => handleEdit(gate)}
                        title="Sửa"
                      >
                        Sửa
                      </button>
                      <button 
                        className="btn-icon test" 
                        onClick={() => testGateConnection(gate.ipAddress, gate.port)}
                        title="Test kết nối"
                      >
                        Test
                      </button>
                      <button 
                        className="btn-icon delete" 
                        onClick={() => handleDelete(gate)}
                        title="Xóa"
                      >
                        Xóa
                      </button>
                    </div>
                  </div>
                ))
              )}
            </div>
          </div>

          {/* Right Panel - Gate Form */}
          <div className="dialog-panel">
            <div className="dialog-panel-title">
              {isEditing ? "Sửa Cổng" : "Thêm Cổng Mới"}
            </div>
            
            <form onSubmit={handleSubmit} className="gate-form">
              <div className="form-group">
                <label>Mã Cổng *</label>
                <input
                  type="text"
                  value={formData.maCong}
                  onChange={(e) => handleInputChange("maCong", e.target.value)}
                  placeholder="Nhập mã cổng"
                  required
                />
              </div>

              <div className="form-group">
                <label>Tên Cổng *</label>
                <input
                  type="text"
                  value={formData.tenCong}
                  onChange={(e) => handleInputChange("tenCong", e.target.value)}
                  placeholder="Nhập tên cổng"
                  required
                />
              </div>

              <div className="form-group">
                <label>Loại Cổng</label>
                <select
                  value={formData.loaiCong}
                  onChange={(e) => handleInputChange("loaiCong", e.target.value)}
                >
                  <option value="VAO">Cổng Vào</option>
                  <option value="RA">Cổng Ra</option>
                </select>
              </div>

              <div className="form-group">
                <label>Trạng Thái</label>
                <select
                  value={formData.trangThai}
                  onChange={(e) => handleInputChange("trangThai", e.target.value)}
                >
                  <option value="HOAT_DONG">Hoạt động</option>
                  <option value="TAM_DUNG">Tạm dừng</option>
                </select>
              </div>

              <div className="form-group">
                <label>Địa chỉ IP</label>
                <input
                  type="text"
                  value={formData.ipAddress}
                  onChange={(e) => handleInputChange("ipAddress", e.target.value)}
                  placeholder="192.168.1.100"
                />
              </div>

              <div className="form-group">
                <label>Port</label>
                <input
                  type="number"
                  value={formData.port}
                  onChange={(e) => handleInputChange("port", e.target.value)}
                  placeholder="80"
                />
              </div>

              <div className="form-group">
                <label>Mô Tả</label>
                <textarea
                  value={formData.moTa}
                  onChange={(e) => handleInputChange("moTa", e.target.value)}
                  placeholder="Nhập mô tả cổng"
                  rows="3"
                />
              </div>

              <div className="form-actions">
                <button 
                  type="submit" 
                  className="btn btn-primary"
                  disabled={loading}
                >
                  {loading ? "Đang xử lý..." : (isEditing ? "Cập nhật" : "Thêm mới")}
                </button>
                
                {isEditing && (
                  <button 
                    type="button" 
                    className="btn btn-secondary"
                    onClick={resetForm}
                  >
                    Hủy
                  </button>
                )}
                
                <button 
                  type="button" 
                  className="btn btn-info"
                  onClick={() => testGateConnection(formData.ipAddress, formData.port)}
                  disabled={!formData.ipAddress}
                >
                  Test kết nối
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  )
}

export default GateManagementDialog
