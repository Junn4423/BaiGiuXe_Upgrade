"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/RfidManagerDialog.css"
import { layTatCaTheRFID, themThe, capNhatThe, xoaThe, layChinhSachGia } from "../../api/api"
import CardHistoryDialog from "./CardHistoryDialog"

const RfidManagerDialog = ({ onClose, onSave }) => {
  // Basic states
  const [cards, setCards] = useState([])
  const [filteredCards, setFilteredCards] = useState([])
  const [selectedCard, setSelectedCard] = useState(null)
  const [loading, setLoading] = useState(false)
  const [searchTerm, setSearchTerm] = useState("")
  const [statusFilter, setStatusFilter] = useState("all")
  const [typeFilter, setTypeFilter] = useState("all")
  
  // Dialog states
  const [showCardHistory, setShowCardHistory] = useState(false)
  const [selectedCardForHistory, setSelectedCardForHistory] = useState(null)
  const [showAddDialog, setShowAddDialog] = useState(false)
  const [isEditing, setIsEditing] = useState(false)
  
  // Enhanced states
  const [policies, setPolicies] = useState([])
  const [validationErrors, setValidationErrors] = useState({})

  // Form state - clean và simple
  const [formData, setFormData] = useState({
    uidThe: "",
    loaiThe: "KHACH",
    trangThai: "1",
    bienSoXe: "",
    maChinhSach: "",
    ngayKetThucCS: "",
    tongNgay: 0,
    ngayBatDauCS: "",
    ghiChu: ""
  })

  // Card types - clean without emojis
  const cardTypes = [
    { value: 'KHACH', label: 'Thẻ thường', description: 'Thẻ dành cho khách thường' },
    { value: 'VIP', label: 'Thẻ VIP', description: 'Thẻ VIP với ưu đãi đặc biệt' },
    { value: 'NHANVIEN', label: 'Thẻ nhân viên', description: 'Thẻ dành cho nhân viên' }
  ]

  // Load data on mount
  useEffect(() => {
    loadCards()
    loadPolicies()
  }, [])

  // Filter cards when search/filter changes
  useEffect(() => {
    filterCards()
  }, [cards, searchTerm, statusFilter, typeFilter])

  const loadCards = async () => {
    try {
      setLoading(true)
      const response = await layTatCaTheRFID()
      const cardData = Array.isArray(response) ? response : []
      setCards(cardData)
    } catch (error) {
      console.error("Error loading cards:", error)
      alert("Lỗi tải danh sách thẻ: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const loadPolicies = async () => {
    try {
      const response = await layChinhSachGia()
      setPolicies(Array.isArray(response) ? response : [])
    } catch (error) {
      console.error("Error loading policies:", error)
    }
  }

  const filterCards = () => {
    let filtered = [...cards]

    // Search filter
    if (searchTerm) {
      filtered = filtered.filter(card =>
        card.uidThe?.toLowerCase().includes(searchTerm.toLowerCase()) ||
        card.bienSoXe?.toLowerCase().includes(searchTerm.toLowerCase())
      )
    }

    // Status filter
    if (statusFilter !== 'all') {
      filtered = filtered.filter(card => card.trangThai === statusFilter)
    }

    // Type filter
    if (typeFilter !== 'all') {
      filtered = filtered.filter(card => card.loaiThe === typeFilter)
    }

    setFilteredCards(filtered)
  }

  const handleAddCard = () => {
    setFormData({
      uidThe: "",
      loaiThe: "KHACH",
      trangThai: "1",
      bienSoXe: "",
      maChinhSach: "",
      ngayKetThucCS: "",
      tongNgay: 0,
      ngayBatDauCS: "",
      ghiChu: ""
    })
    setIsEditing(false)
    setShowAddDialog(true)
  }

  const handleEditCard = (card) => {
    setFormData({...card})
    setIsEditing(true)
    setShowAddDialog(true)
  }

  const handleSaveCard = async () => {
    try {
      // Validate form
      const errors = {}
      if (!formData.uidThe) errors.uidThe = "UID thẻ không được để trống"
      if (!formData.loaiThe) errors.loaiThe = "Loại thẻ không được để trống"

      if (Object.keys(errors).length > 0) {
        setValidationErrors(errors)
        return
      }

      setLoading(true)
      
      let result
      if (isEditing) {
        result = await capNhatThe(formData)
      } else {
        result = await themThe(formData)
      }

      if (result.success) {
        alert(isEditing ? "Cập nhật thẻ thành công!" : "Thêm thẻ thành công!")
        setShowAddDialog(false)
        loadCards()
        if (onSave) onSave()
      } else {
        throw new Error(result.message || "Thao tác thất bại")
      }
    } catch (error) {
      console.error("Error saving card:", error)
      alert("Lỗi: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleDeleteCard = async (card) => {
    if (!window.confirm(`Bạn có chắc muốn xóa thẻ "${card.uidThe}"?`)) {
      return
    }

    try {
      setLoading(true)
      const result = await xoaThe(card.uidThe)
      
      if (result.success) {
        alert("Xóa thẻ thành công!")
        loadCards()
        if (onSave) onSave()
      } else {
        throw new Error(result.message || "Xóa thất bại")
      }
    } catch (error) {
      console.error("Error deleting card:", error)
      alert("Lỗi xóa thẻ: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleViewHistory = (card) => {
    setSelectedCardForHistory(card.uidThe)
    setShowCardHistory(true)
  }

  const handleInputChange = (field, value) => {
    setFormData(prev => ({
      ...prev,
      [field]: value
    }))
    
    // Clear validation error for this field
    if (validationErrors[field]) {
      setValidationErrors(prev => {
        const newErrors = {...prev}
        delete newErrors[field]
        return newErrors
      })
    }
  }

  const getCardTypeName = (type) => {
    const cardType = cardTypes.find(t => t.value === type)
    return cardType ? cardType.label : type
  }

  const getStatusText = (status) => {
    return status === "1" ? "Hoạt động" : "Tạm dừng"
  }

  const getPolicyName = (policyId) => {
    const policy = policies.find(p => p.maChinhSach === policyId)
    return policy ? policy.maChinhSach : policyId
  }

  return (
    <>
      <div className="dialog-overlay">
        <div className="dialog-container extra-large">
          <div className="dialog-header">
            <h2 className="dialog-title">Quản Lý Thẻ RFID</h2>
            <button className="dialog-close" onClick={onClose}>×</button>
          </div>

          <div className="dialog-content">
            {/* Filter Section */}
            <div className="filter-section">
              <div className="search-group">
                <input
                  type="text"
                  className="search-input"
                  placeholder="Tìm kiếm theo UID hoặc biển số..."
                  value={searchTerm}
                  onChange={(e) => setSearchTerm(e.target.value)}
                />
              </div>
              
              <div className="filter-group">
                <select
                  className="filter-select"
                  value={statusFilter}
                  onChange={(e) => setStatusFilter(e.target.value)}
                >
                  <option value="all">Tất cả trạng thái</option>
                  <option value="1">Hoạt động</option>
                  <option value="0">Tạm dừng</option>
                </select>
              </div>

              <div className="filter-group">
                <select
                  className="filter-select"
                  value={typeFilter}
                  onChange={(e) => setTypeFilter(e.target.value)}
                >
                  <option value="all">Tất cả loại thẻ</option>
                  {cardTypes.map(type => (
                    <option key={type.value} value={type.value}>
                      {type.label}
                    </option>
                  ))}
                </select>
              </div>

              <button className="add-button" onClick={handleAddCard}>
                Thêm thẻ mới
              </button>
            </div>

            {/* Cards List */}
            <div className="cards-list">
              {loading ? (
                <div className="loading">Đang tải...</div>
              ) : filteredCards.length === 0 ? (
                <div className="no-data">Không có thẻ nào</div>
              ) : (
                <table className="cards-table">
                  <thead>
                    <tr>
                      <th>UID Thẻ</th>
                      <th>Loại thẻ</th>
                      <th>Biển số</th>
                      <th>Chính sách</th>
                      <th>Trạng thái</th>
                      <th>Ghi chú</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    {filteredCards.map((card, index) => (
                      <tr key={card.uidThe || index}>
                        <td>
                          <div className="uid-cell">
                            <strong>{card.uidThe}</strong>
                          </div>
                        </td>
                        <td>{getCardTypeName(card.loaiThe)}</td>
                        <td>{card.bienSoXe || "Chưa có"}</td>
                        <td>{getPolicyName(card.maChinhSach) || "Chưa có"}</td>
                        <td>
                          <span className={`status-badge ${card.trangThai === "1" ? "status-active" : "status-inactive"}`}>
                            {getStatusText(card.trangThai)}
                          </span>
                        </td>
                        <td>{card.ghiChu || ""}</td>
                        <td>
                          <div className="action-buttons">
                            <button
                              className="history-button"
                              onClick={() => handleViewHistory(card)}
                              title="Xem lịch sử"
                            >
                              Lịch sử
                            </button>
                            <button
                              className="edit-button"
                              onClick={() => handleEditCard(card)}
                              title="Sửa thẻ"
                            >
                              Sửa
                            </button>
                            <button
                              className="delete-button"
                              onClick={() => handleDeleteCard(card)}
                              title="Xóa thẻ"
                            >
                              Xóa
                            </button>
                          </div>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              )}
            </div>

            {/* Summary */}
            <div className="summary-section">
              <div className="summary-item">
                <span className="summary-label">Tổng số thẻ:</span>
                <span className="summary-value">{cards.length}</span>
              </div>
              <div className="summary-item">
                <span className="summary-label">Đang hoạt động:</span>
                <span className="summary-value">{cards.filter(c => c.trangThai === "1").length}</span>
              </div>
              <div className="summary-item">
                <span className="summary-label">Tạm dừng:</span>
                <span className="summary-value">{cards.filter(c => c.trangThai === "0").length}</span>
              </div>
            </div>
          </div>

          <div className="dialog-footer">
            <button className="refresh-button" onClick={loadCards}>
              Làm mới
            </button>
            <button className="cancel-button" onClick={onClose}>
              Đóng
            </button>
          </div>
        </div>
      </div>

      {/* Add/Edit Card Dialog */}
      {showAddDialog && (
        <div className="dialog-overlay">
          <div className="add-card-dialog">
            <div className="dialog-header">
              <h3>{isEditing ? "Sửa thẻ RFID" : "Thêm thẻ RFID mới"}</h3>
              <button className="dialog-close" onClick={() => setShowAddDialog(false)}>×</button>
            </div>
            
            <div className="dialog-content">
              <div className="form-group">
                <label>UID Thẻ *</label>
                <input
                  type="text"
                  value={formData.uidThe}
                  onChange={(e) => handleInputChange("uidThe", e.target.value)}
                  placeholder="Nhập UID thẻ"
                  disabled={isEditing}
                />
                {validationErrors.uidThe && (
                  <span className="error-text">{validationErrors.uidThe}</span>
                )}
              </div>

              <div className="form-group">
                <label>Loại thẻ *</label>
                <select
                  value={formData.loaiThe}
                  onChange={(e) => handleInputChange("loaiThe", e.target.value)}
                >
                  {cardTypes.map(type => (
                    <option key={type.value} value={type.value}>
                      {type.label}
                    </option>
                  ))}
                </select>
              </div>

              <div className="form-group">
                <label>Biển số xe</label>
                <input
                  type="text"
                  value={formData.bienSoXe}
                  onChange={(e) => handleInputChange("bienSoXe", e.target.value)}
                  placeholder="Nhập biển số xe"
                />
              </div>

              <div className="form-group">
                <label>Chính sách giá</label>
                <select
                  value={formData.maChinhSach}
                  onChange={(e) => handleInputChange("maChinhSach", e.target.value)}
                >
                  <option value="">Chọn chính sách</option>
                  {policies.map(policy => (
                    <option key={policy.maChinhSach} value={policy.maChinhSach}>
                      {policy.maChinhSach}
                    </option>
                  ))}
                </select>
              </div>

              <div className="form-group">
                <label>Trạng thái</label>
                <select
                  value={formData.trangThai}
                  onChange={(e) => handleInputChange("trangThai", e.target.value)}
                >
                  <option value="1">Hoạt động</option>
                  <option value="0">Tạm dừng</option>
                </select>
              </div>

              <div className="form-group">
                <label>Ghi chú</label>
                <textarea
                  value={formData.ghiChu}
                  onChange={(e) => handleInputChange("ghiChu", e.target.value)}
                  placeholder="Nhập ghi chú"
                  rows="3"
                />
              </div>
            </div>

            <div className="dialog-footer">
              <button 
                className="save-button" 
                onClick={handleSaveCard}
                disabled={loading}
              >
                {loading ? "Đang xử lý..." : (isEditing ? "Cập nhật" : "Thêm mới")}
              </button>
              <button 
                className="cancel-button" 
                onClick={() => setShowAddDialog(false)}
              >
                Hủy
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Card History Dialog */}
      {showCardHistory && (
        <CardHistoryDialog
          cardId={selectedCardForHistory}
          onClose={() => {
            setShowCardHistory(false)
            setSelectedCardForHistory(null)
          }}
        />
      )}
    </>
  )
}

export default RfidManagerDialog
