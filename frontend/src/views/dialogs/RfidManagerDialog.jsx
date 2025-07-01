"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/RfidManagerDialog.css"
import { 
  layDanhSachThe, 
  themThe, 
  capNhatTheRFID, 
  xoaTheRFID,
  timTheDangCoPhien 
} from "../../api/api"
import CardHistoryDialog from "./CardHistoryDialog"

const RfidManagerDialog = ({ onClose, onSave }) => {
  const [cards, setCards] = useState([])
  const [filteredCards, setFilteredCards] = useState([])
  const [selectedCard, setSelectedCard] = useState(null)
  const [showAddDialog, setShowAddDialog] = useState(false)
  const [editingCard, setEditingCard] = useState(null)
  const [loading, setLoading] = useState(false)
  const [searchTerm, setSearchTerm] = useState("")
  const [statusFilter, setStatusFilter] = useState("all")
  const [typeFilter, setTypeFilter] = useState("all")
  const [showCardHistory, setShowCardHistory] = useState(false)
  const [selectedCardForHistory, setSelectedCardForHistory] = useState(null)

  // Form state for add/edit
  const [formData, setFormData] = useState({
    uidThe: "",
    loaiThe: "THUONG",
    trangThai: "1"
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

  const filterCards = () => {
    let filtered = [...cards]

    // Filter by search term
    if (searchTerm) {
      filtered = filtered.filter(card => 
        card.uidThe?.toLowerCase().includes(searchTerm.toLowerCase()) ||
        card.loaiThe?.toLowerCase().includes(searchTerm.toLowerCase())
      )
    }

    // Filter by status
    if (statusFilter !== "all") {
      filtered = filtered.filter(card => card.trangThai === statusFilter)
    }

    // Filter by type
    if (typeFilter !== "all") {
      filtered = filtered.filter(card => card.loaiThe === typeFilter)
    }

    setFilteredCards(filtered)
  }

  const handleAddCard = () => {
    setEditingCard(null)
    setFormData({
      uidThe: "",
      loaiThe: "Thẻ thường",
      trangThai: "1"
    })
    setShowAddDialog(true)
  }

  const handleEditCard = (card) => {
    setEditingCard(card)
    setFormData({
      uidThe: card.uidThe,
      loaiThe: card.loaiThe,
      trangThai: card.trangThai
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

  const handleSave = () => {
    if (onSave) {
      onSave()
    }
    onClose()
  }

  const getStatusText = (status) => {
    return status === "1" ? "Hoạt động" : "Không hoạt động"
  }

  const getStatusClass = (status) => {
    return status === "1" ? "status-active" : "status-inactive"
  }

  const formatDate = (dateString) => {
    if (!dateString) return "N/A"
    return new Date(dateString).toLocaleDateString("vi-VN")
  }

  return (
    <>
      <div className="dialog-overlay">
        <div className="rfid-manager-dialog">
          <div className="dialog-header">
            <h2>Quản Lý Thẻ RFID</h2>
            <button className="close-button" onClick={onClose}>
              ×
            </button>
          </div>

          <div className="dialog-content">
            {/* Filters and search */}
            <div className="filter-section">
              <div className="search-group">
                <input
                  type="text"
                  placeholder="Tìm kiếm theo UID hoặc loại thẻ..."
                  value={searchTerm}
                  onChange={(e) => setSearchTerm(e.target.value)}
                  className="search-input"
                />
              </div>
              
              <div className="filter-group">
                <select 
                  value={statusFilter} 
                  onChange={(e) => setStatusFilter(e.target.value)}
                  className="filter-select"
                >
                  <option value="all">Tất cả trạng thái</option>
                  <option value="1">Hoạt động</option>
                  <option value="0">Không hoạt động</option>
                </select>

                <select 
                  value={typeFilter} 
                  onChange={(e) => setTypeFilter(e.target.value)}
                  className="filter-select"
                >
                  <option value="all">Tất cả loại thẻ</option>
                  {cardTypes.map((type, index) => (
                    <option key={index} value={type}>
                      {type}
                    </option>
                  ))}
                </select>

                <button className="add-button" onClick={handleAddCard}>
                  + Thêm Thẻ
                </button>
              </div>
            </div>

            {/* Cards table */}
            <div className="cards-list">
              {loading ? (
                <div className="loading">Đang tải...</div>
              ) : (
                <table className="cards-table">
                  <thead>
                    <tr>
                      <th>UID Thẻ</th>
                      <th>Loại Thẻ</th>
                      <th>Trạng Thái</th>
                      <th>Ngày Phát Hành</th>
                      <th>Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    {filteredCards.map((card) => (
                      <tr key={card.uidThe}>
                        <td className="uid-cell">{card.uidThe}</td>
                        <td>{card.loaiThe}</td>
                        <td>
                          <span className={`status-badge ${getStatusClass(card.trangThai)}`}>
                            {getStatusText(card.trangThai)}
                          </span>
                        </td>
                        <td>{formatDate(card.ngayPhatHanh)}</td>
                        <td>
                          <div className="action-buttons">
                            <button 
                              className="history-button" 
                              onClick={() => handleViewHistory(card)}
                              title="Xem nhật ký"
                            >
                              📋
                            </button>
                            <button 
                              className="edit-button" 
                              onClick={() => handleEditCard(card)}
                              title="Sửa thẻ"
                            >
                              ✏️
                            </button>
                            <button 
                              className="delete-button" 
                              onClick={() => handleDeleteCard(card)}
                              title="Xóa thẻ"
                            >
                              🗑️
                            </button>
                          </div>
                        </td>
                      </tr>
                    ))}
                    {filteredCards.length === 0 && (
                      <tr>
                        <td colSpan="5" className="no-data">
                          {searchTerm || statusFilter !== "all" || typeFilter !== "all" 
                            ? "Không tìm thấy thẻ nào" 
                            : "Chưa có thẻ nào"}
                        </td>
                      </tr>
                    )}
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
                <span className="summary-value">
                  {cards.filter(card => card.trangThai === "1").length}
                </span>
              </div>
              <div className="summary-item">
                <span className="summary-label">Không hoạt động:</span>
                <span className="summary-value">
                  {cards.filter(card => card.trangThai === "0").length}
                </span>
              </div>
            </div>
          </div>

          <div className="dialog-footer">
            <button className="refresh-button" onClick={loadCards} disabled={loading}>
              🔄 Làm mới
            </button>
            <button className="save-button" onClick={handleSave}>
              Lưu
            </button>
            <button className="cancel-button" onClick={onClose}>
              Hủy
            </button>
          </div>
        </div>
      </div>

      {/* Add/Edit Card Dialog */}
      {showAddDialog && (
        <div className="dialog-overlay">
          <div className="add-card-dialog">
            <div className="dialog-header">
              <h3>{editingCard ? "Sửa Thẻ" : "Thêm Thẻ Mới"}</h3>
              <button className="close-button" onClick={() => setShowAddDialog(false)}>
                ×
              </button>
            </div>

            <div className="dialog-content">
              <div className="form-group">
                <label>UID Thẻ:</label>
                <input
                  type="text"
                  value={formData.uidThe}
                  onChange={(e) => setFormData({...formData, uidThe: e.target.value})}
                  placeholder="Nhập UID thẻ"
                  disabled={!!editingCard}
                />
              </div>

              <div className="form-group">
                <label>Loại Thẻ:</label>
                <select
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
                <label>Trạng Thái:</label>
                <select
                  value={formData.trangThai}
                  onChange={(e) => setFormData({...formData, trangThai: e.target.value})}
                >
                  <option value="1">Hoạt động</option>
                  <option value="0">Không hoạt động</option>
                </select>
              </div>
            </div>

            <div className="dialog-footer">
              <button 
                className="save-button" 
                onClick={handleFormSubmit} 
                disabled={loading}
              >
                {loading ? "Đang lưu..." : (editingCard ? "Cập nhật" : "Thêm mới")}
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
