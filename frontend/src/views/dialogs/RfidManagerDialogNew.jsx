"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/dialog-base.css"
import "../../assets/styles/enhanced-dialogs.css"
import { 
  layDanhSachThe, 
  themThe, 
  capNhatTheRFID, 
  xoaTheRFID,
  layNhatKyTheoTheNgocChung,
  timTheDangCoPhien
} from "../../api/api"
import CardHistoryDialog from "./CardHistoryDialog"

const RfidManagerDialog = ({ onClose, onSave }) => {
  // Basic states
  const [cards, setCards] = useState([])
  const [filteredCards, setFilteredCards] = useState([])
  const [selectedCard, setSelectedCard] = useState(null)
  const [editingCard, setEditingCard] = useState(null)
  const [loading, setLoading] = useState(false)
  const [searchTerm, setSearchTerm] = useState("")
  const [statusFilter, setStatusFilter] = useState("all")
  const [typeFilter, setTypeFilter] = useState("all")
  
  // Dialog states
  const [showHistory, setShowHistory] = useState(false)
  const [cardHistory, setCardHistory] = useState([])
  const [showAddDialog, setShowAddDialog] = useState(false)
  const [showCardHistory, setShowCardHistory] = useState(false)
  const [selectedCardForHistory, setSelectedCardForHistory] = useState(null)
  
  // Enhanced states from mobile app
  const [policies, setPolicies] = useState([])
  const [cardsWithVehicles, setCardsWithVehicles] = useState(new Set())
  const [showPolicyAssignment, setShowPolicyAssignment] = useState(false)
  const [selectedCardForPolicy, setSelectedCardForPolicy] = useState(null)

  // Form state
  const [formData, setFormData] = useState({
    uidThe: "",
    loaiThe: "THUONG",
    trangThai: "1",
    bienSoXe: "",
    maChinhSach: "",
    ngayKetThucCS: "",
    tongNgay: 0,
    ngayBatDauCS: "",
    ghiChu: ""
  })

  const cardTypes = [
    "THUONG",
    "VIP", 
    "NHANVIEN",
    "Thẻ nhân viên",
    "Thẻ khách"
  ]

  useEffect(() => {
    loadCards()
    loadPolicies()
  }, [])

  useEffect(() => {
    filterCards()
  }, [cards, searchTerm, statusFilter, typeFilter])

  const loadCards = async () => {
    try {
      setLoading(true)
      const cardList = await layDanhSachThe()
      setCards(cardList || [])
    } catch (error) {
      console.error("Error loading cards:", error)
      alert("Lỗi tải danh sách thẻ: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const loadPolicies = async () => {
    try {
      const policyList = [
        { maChinhSach: "CS_VIP_1T", tenChinhSach: "VIP 1 Tháng", tongNgay: 30, donGia: 500000 },
        { maChinhSach: "CS_VIP_3T", tenChinhSach: "VIP 3 Tháng", tongNgay: 90, donGia: 1400000 },
        { maChinhSach: "CS_VIP_1NAM", tenChinhSach: "VIP 1 Năm", tongNgay: 365, donGia: 5000000 }
      ]
      setPolicies(policyList)
    } catch (error) {
      console.error("Error loading policies:", error)
    }
  }

  const filterCards = () => {
    let filtered = [...cards]

    if (searchTerm) {
      filtered = filtered.filter(card => 
        card.uidThe?.toLowerCase().includes(searchTerm.toLowerCase()) ||
        card.loaiThe?.toLowerCase().includes(searchTerm.toLowerCase()) ||
        card.bienSoXe?.toLowerCase().includes(searchTerm.toLowerCase())
      )
    }

    if (statusFilter !== "all") {
      filtered = filtered.filter(card => card.trangThai === statusFilter)
    }

    if (typeFilter !== "all") {
      filtered = filtered.filter(card => card.loaiThe === typeFilter)
    }

    setFilteredCards(filtered)
  }

  const handleAddCard = () => {
    setEditingCard(null)
    setFormData({
      uidThe: "",
      loaiThe: "THUONG",
      trangThai: "1",
      bienSoXe: "",
      maChinhSach: "",
      ngayKetThucCS: "",
      tongNgay: 0,
      ngayBatDauCS: "",
      ghiChu: ""
    })
    setShowAddDialog(true)
  }

  const handleEditCard = (card) => {
    setEditingCard(card)
    setFormData({
      uidThe: card.uidThe,
      loaiThe: card.loaiThe || "THUONG",
      trangThai: card.trangThai || "1",
      bienSoXe: card.bienSoXe || "",
      maChinhSach: card.maChinhSach || "",
      ngayKetThucCS: card.ngayKetThucCS || "",
      tongNgay: card.tongNgay || 0,
      ngayBatDauCS: card.ngayBatDauCS || "",
      ghiChu: card.ghiChu || ""
    })
    setShowAddDialog(true)
  }

  const handleDeleteCard = async (card) => {
    if (!window.confirm(`Bạn có chắc chắn muốn xóa thẻ ${card.uidThe}?`)) {
      return
    }

    try {
      // Check if card has active session
      const activeSession = await timTheDangCoPhien(card.uidThe)
      if (activeSession && activeSession.length > 0) {
        alert("Không thể xóa thẻ đang có phiên gửi xe!")
        return
      }

      setLoading(true)
      const result = await xoaTheRFID(card.uidThe)
      
      if (result && result.success) {
        alert("Xóa thẻ thành công")
        await loadCards()
      } else {
        alert("Lỗi xóa thẻ: " + (result?.message || "Không xác định"))
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

  const handleFormSubmit = async () => {
    if (!formData.uidThe.trim()) {
      alert("Vui lòng nhập UID thẻ")
      return
    }

    try {
      setLoading(true)
      let result

      if (editingCard) {
        result = await capNhatTheRFID(formData)
      } else {
        result = await themThe(formData.uidThe, formData.loaiThe, formData.trangThai)
      }

      if (result && result.success) {
        alert(editingCard ? "Cập nhật thẻ thành công" : "Thêm thẻ thành công")
        setShowAddDialog(false)
        await loadCards()
      } else {
        alert("Lỗi: " + (result?.message || "Không xác định"))
      }
    } catch (error) {
      console.error("Error saving card:", error)
      alert("Lỗi: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const getStatusText = (status) => {
    return status === "1" ? "Hoạt động" : "Không hoạt động"
  }

  const getStatusClass = (status) => {
    return status === "1" ? "badge-success" : "badge-danger"
  }

  const formatDate = (dateString) => {
    if (!dateString) return "N/A"
    return new Date(dateString).toLocaleDateString("vi-VN")
  }

  const calculatePolicyEndDate = (startDate, policyDays) => {
    if (!startDate || !policyDays) return ""
    
    const start = new Date(startDate)
    const endDate = new Date(start.getTime() + (policyDays * 24 * 60 * 60 * 1000))
    return endDate.toISOString().split('T')[0]
  }
  return (
    <>
      <div className="dialog-overlay">
        <div className="dialog-container extra-large">
          <div className="dialog-header">
            <h2 className="dialog-title">Quản Lý Thẻ RFID</h2>
            <button className="dialog-close" onClick={onClose}>×</button>
          </div>

          <div className="dialog-subtitle">
            Quản lý thẻ RFID và xem lịch sử sử dụng thẻ
          </div>

          <div className="dialog-content main-sidebar">
            {/* Left Panel - Card List */}
            <div className="dialog-panel">
              <div className="dialog-panel-title" style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
                <span>Danh Sách Thẻ ({filteredCards.length})</span>
                <button className="dialog-btn dialog-btn-primary" onClick={handleAddCard}>
                  + Thêm Thẻ
                </button>
              </div>
              
              {/* Search and Filters */}
              <div className="dialog-grid cols-3" style={{marginBottom: '16px'}}>
                <div className="form-group">
                  <label>Tìm kiếm:</label>
                  <input
                    type="text"
                    className="dialog-input"
                    placeholder="UID thẻ hoặc biển số..."
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                  />
                </div>
                
                <div className="form-group">
                  <label>Trạng thái:</label>
                  <select 
                    className="dialog-select"
                    value={statusFilter}
                    onChange={(e) => setStatusFilter(e.target.value)}
                  >
                    <option value="all">Tất cả</option>
                    <option value="1">Hoạt động</option>
                    <option value="0">Không hoạt động</option>
                  </select>
                </div>
                
                <div className="form-group">
                  <label>Loại thẻ:</label>
                  <select 
                    className="dialog-select"
                    value={typeFilter}
                    onChange={(e) => setTypeFilter(e.target.value)}
                  >
                    <option value="all">Tất cả</option>
                    {cardTypes.map(type => (
                      <option key={type} value={type}>{type}</option>
                    ))}
                  </select>
                </div>
              </div>

              {loading ? (
                <div className="dialog-loading">Đang tải...</div>
              ) : (
                <div style={{maxHeight: '400px', overflowY: 'auto'}}>
                  <table className="dialog-table">
                    <thead>
                      <tr>
                        <th>UID Thẻ</th>
                        <th>Loại</th>
                        <th>Trạng thái</th>
                        <th>Biển số</th>
                        <th>Chính sách</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      {filteredCards.map(card => (
                        <tr 
                          key={card.uidThe}
                          className={selectedCard?.uidThe === card.uidThe ? 'selected' : ''}
                          onClick={() => setSelectedCard(card)}
                        >
                          <td style={{ fontFamily: 'monospace' }}>{card.uidThe}</td>
                          <td>
                            <span className={`badge ${card.loaiThe === 'VIP' ? 'badge-premium' : 
                              card.loaiThe === 'NHANVIEN' ? 'badge-info' : 'badge-default'}`}>
                              {card.loaiThe}
                            </span>
                          </td>
                          <td>
                            <span className={`badge ${getStatusClass(card.trangThai)}`}>
                              {getStatusText(card.trangThai)}
                            </span>
                          </td>
                          <td style={{ fontFamily: 'monospace' }}>{card.bienSoXe || 'Chưa có'}</td>
                          <td>
                            {card.maChinhSach ? (
                              <div className="policy-info">
                                <span className="policy-name">{card.maChinhSach}</span>
                                {card.ngayKetThucCS && (
                                  <small className="policy-expire">
                                    Hết hạn: {formatDate(card.ngayKetThucCS)}
                                  </small>
                                )}
                              </div>
                            ) : (
                              <span className="no-policy">Chưa có</span>
                            )}
                          </td>
                          <td>
                            <div className="action-buttons">
                              <button 
                                className="btn-small btn-secondary"
                                onClick={(e) => {
                                  e.stopPropagation()
                                  handleEditCard(card)
                                }}
                                title="Chỉnh sửa"
                              >
                                ✏️
                              </button>
                              <button 
                                className="btn-small btn-warning"
                                onClick={(e) => {
                                  e.stopPropagation()
                                  handleViewHistory(card)
                                }}
                                title="Xem lịch sử"
                              >
                                📋
                              </button>
                              <button 
                                className="btn-small btn-danger"
                                onClick={(e) => {
                                  e.stopPropagation()
                                  handleDeleteCard(card)
                                }}
                                title="Xóa"
                              >
                                🗑️
                              </button>
                            </div>
                          </td>
                        </tr>
                      ))}
                      {filteredCards.length === 0 && (
                        <tr>
                          <td colSpan="6" className="no-data">
                            {searchTerm || statusFilter !== "all" || typeFilter !== "all" 
                              ? "Không tìm thấy thẻ nào" 
                              : "Chưa có thẻ nào"}
                          </td>
                        </tr>
                      )}
                    </tbody>
                  </table>
                </div>
              )}
            </div>

            {/* Right Panel - Statistics */}
            <div className="dialog-panel primary">
              <div className="dialog-panel-title">Thống Kê</div>
              
              <div className="dialog-info-card">
                <div className="dialog-info-title">Tổng Quan</div>
                <div className="stats-grid">
                  <div className="stat-item">
                    <span className="stat-number">{cards.length}</span>
                    <span className="stat-label">Tổng thẻ</span>
                  </div>
                  <div className="stat-item">
                    <span className="stat-number">
                      {cards.filter(card => card.trangThai === "1").length}
                    </span>
                    <span className="stat-label">Hoạt động</span>
                  </div>
                  <div className="stat-item">
                    <span className="stat-number">
                      {cards.filter(card => card.trangThai === "0").length}
                    </span>
                    <span className="stat-label">Không hoạt động</span>
                  </div>
                </div>
              </div>

              <div className="dialog-info-card">
                <div className="dialog-info-title">Phân Loại Thẻ</div>
                <div className="card-type-stats">
                  {cardTypes.map(type => {
                    const count = cards.filter(card => card.loaiThe === type).length
                    return count > 0 ? (
                      <div key={type} className="type-stat">
                        <span className="type-name">{type}</span>
                        <span className="type-count">{count}</span>
                      </div>
                    ) : null
                  })}
                </div>
              </div>

              {selectedCard && (
                <div className="dialog-info-card">
                  <div className="dialog-info-title">Chi Tiết Thẻ</div>
                  <div className="card-details">
                    <div><strong>UID:</strong> <code>{selectedCard.uidThe}</code></div>
                    <div><strong>Loại:</strong> {selectedCard.loaiThe}</div>
                    <div><strong>Trạng thái:</strong> {getStatusText(selectedCard.trangThai)}</div>
                    <div><strong>Biển số:</strong> {selectedCard.bienSoXe || 'Chưa có'}</div>
                    <div><strong>Ngày phát hành:</strong> {formatDate(selectedCard.ngayPhatHanh)}</div>
                    {selectedCard.maChinhSach && (
                      <>
                        <div><strong>Chính sách:</strong> {selectedCard.maChinhSach}</div>
                        {selectedCard.ngayKetThucCS && (
                          <div><strong>Hết hạn:</strong> {formatDate(selectedCard.ngayKetThucCS)}</div>
                        )}
                      </>
                    )}
                  </div>
                </div>
              )}
            </div>
          </div>

          <div className="dialog-footer">
            <button className="dialog-btn dialog-btn-secondary" onClick={onClose}>
              Đóng
            </button>
          </div>
        </div>
      </div>

      {/* Add/Edit Card Dialog */}
      {showAddDialog && (
        <div className="dialog-overlay">
          <div className="dialog-container">
            <div className="dialog-header">
              <h3 className="dialog-title">{editingCard ? "Sửa Thẻ" : "Thêm Thẻ Mới"}</h3>
              <button className="dialog-close" onClick={() => setShowAddDialog(false)}>×</button>
            </div>

            <div className="dialog-content">
              <div className="form-group">
                <label>UID Thẻ *</label>
                <input
                  type="text"
                  className="dialog-input"
                  value={formData.uidThe}
                  onChange={(e) => setFormData({...formData, uidThe: e.target.value})}
                  placeholder="Nhập UID thẻ"
                  disabled={!!editingCard}
                  style={{ fontFamily: 'monospace', fontSize: '1.1rem' }}
                />
              </div>

              <div className="form-group">
                <label>Loại Thẻ *</label>
                <select
                  className="dialog-select"
                  value={formData.loaiThe}
                  onChange={(e) => setFormData({...formData, loaiThe: e.target.value})}
                >
                  {cardTypes.map((type, index) => (
                    <option key={index} value={type}>
                      {type}
                    </option>
                  ))}
                </select>
              </div>

              <div className="form-group">
                <label>Trạng Thái *</label>
                <select
                  className="dialog-select"
                  value={formData.trangThai}
                  onChange={(e) => setFormData({...formData, trangThai: e.target.value})}
                >
                  <option value="1">Hoạt động</option>
                  <option value="0">Không hoạt động</option>
                </select>
              </div>

              <div className="form-group">
                <label>Biển Số Xe</label>
                <input
                  type="text"
                  className="dialog-input"
                  value={formData.bienSoXe}
                  onChange={(e) => setFormData({...formData, bienSoXe: e.target.value.toUpperCase()})}
                  placeholder="Nhập biển số xe (nếu có)"
                  style={{ fontFamily: 'monospace' }}
                />
              </div>

              {(formData.loaiThe === 'VIP' || formData.loaiThe === 'NHANVIEN') && (
                <>
                  <div className="form-group">
                    <label>Mã Chính Sách</label>
                    <select
                      className="dialog-select"
                      value={formData.maChinhSach}
                      onChange={(e) => setFormData({...formData, maChinhSach: e.target.value})}
                    >
                      <option value="">-- Chọn chính sách --</option>
                      {policies.map(policy => (
                        <option key={policy.maChinhSach} value={policy.maChinhSach}>
                          {policy.tenChinhSach} - {policy.donGia?.toLocaleString()}đ
                        </option>
                      ))}
                    </select>
                  </div>

                  {formData.maChinhSach && (
                    <div className="form-group">
                      <label>Ngày Bắt Đầu Chính Sách</label>
                      <input
                        type="date"
                        className="dialog-input"
                        value={formData.ngayBatDauCS}
                        onChange={(e) => {
                          const startDate = e.target.value
                          const selectedPolicy = policies.find(p => p.maChinhSach === formData.maChinhSach)
                          const endDate = selectedPolicy ? calculatePolicyEndDate(startDate, selectedPolicy.tongNgay) : ""
                          
                          setFormData({
                            ...formData, 
                            ngayBatDauCS: startDate,
                            ngayKetThucCS: endDate,
                            tongNgay: selectedPolicy?.tongNgay || 0
                          })
                        }}
                      />
                    </div>
                  )}

                  {formData.ngayKetThucCS && (
                    <div className="form-group">
                      <label>Ngày Kết Thúc Chính Sách</label>
                      <input
                        type="date"
                        className="dialog-input"
                        value={formData.ngayKetThucCS}
                        readOnly
                        style={{ backgroundColor: '#f3f4f6' }}
                      />
                    </div>
                  )}
                </>
              )}

              <div className="form-group">
                <label>Ghi Chú</label>
                <textarea
                  className="dialog-input"
                  value={formData.ghiChu}
                  onChange={(e) => setFormData({...formData, ghiChu: e.target.value})}
                  placeholder="Ghi chú thêm (tùy chọn)"
                  rows="3"
                />
              </div>
            </div>

            <div className="dialog-footer">
              <button 
                className="dialog-btn dialog-btn-primary" 
                onClick={handleFormSubmit} 
                disabled={loading || !formData.uidThe.trim()}
              >
                {loading ? "Đang lưu..." : (editingCard ? "Cập Nhật" : "Thêm Mới")}
              </button>
              <button 
                className="dialog-btn dialog-btn-secondary" 
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
