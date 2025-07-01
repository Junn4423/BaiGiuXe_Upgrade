"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/dialog-base.css"
import { 
  layDanhSachThe, 
  themThe, 
  capNhatTheRFID, 
  xoaTheRFID,
  layNhatKyTheoTheNgocChung
} from "../../api/api"

const RfidManagerDialogNew = ({ onClose, onSave }) => {
  const [cards, setCards] = useState([])
  const [filteredCards, setFilteredCards] = useState([])
  const [selectedCard, setSelectedCard] = useState(null)
  const [editingCard, setEditingCard] = useState(null)
  const [loading, setLoading] = useState(false)
  const [searchTerm, setSearchTerm] = useState("")
  const [statusFilter, setStatusFilter] = useState("all")
  const [typeFilter, setTypeFilter] = useState("all")
  const [showHistory, setShowHistory] = useState(false)
  const [cardHistory, setCardHistory] = useState([])

  // Form state
  const [formData, setFormData] = useState({
    uidThe: "",
    loaiThe: "NHANVIEN",
    trangThai: "1",
    bienSoXe: "",
    maChinhSach: "",
    ngayKetThucCS: ""
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

  const handleEditCard = (card) => {
    setEditingCard(card)
    setFormData({
      uidThe: card.uidThe,
      loaiThe: card.loaiThe || "Thẻ thường",
      trangThai: card.trangThai || "1",
      bienSoXe: card.bienSoXe || "",
      maChinhSach: card.maChinhSach || "",
      ngayKetThucCS: card.ngayKetThucCS || ""
    })
    setSelectedCard(card)
  }

  const handleDeleteCard = async (card) => {
    if (!window.confirm(`Bạn có chắc muốn xóa thẻ "${card.uidThe}"?`)) {
      return
    }

    try {
      setLoading(true)
      const result = await xoaTheRFID(card.uidThe)
      
      if (result.success) {
        alert("Xóa thẻ thành công!")
        loadCards()
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

  const handleViewHistory = async (card) => {
    try {
      setLoading(true)
      setSelectedCard(card)
      setShowHistory(true)
      
      const history = await layNhatKyTheoTheNgocChung(card.uidThe)
      setCardHistory(history || [])
    } catch (error) {
      console.error("Error loading history:", error)
      alert("Lỗi tải lịch sử: " + error.message)
      setCardHistory([])
    } finally {
      setLoading(false)
    }
  }

  const handleFormSubmit = async () => {
    if (!formData.uidThe || !formData.loaiThe) {
      alert("Vui lòng điền đầy đủ thông tin bắt buộc")
      return
    }

    try {
      setLoading(true)
      let result
      
      if (editingCard) {
        result = await capNhatTheRFID(formData)
      } else {
        result = await themThe(formData)
      }
      
      if (result.success) {
        alert(editingCard ? "Cập nhật thẻ thành công!" : "Thêm thẻ thành công!")
        resetForm()
        loadCards()
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

  const resetForm = () => {
    setFormData({
      uidThe: "",
      loaiThe: "Thẻ thường",
      trangThai: "1",
      bienSoXe: "",
      maChinhSach: "",
      ngayKetThucCS: ""
    })
    setEditingCard(null)
    setSelectedCard(null)
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

  return (
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
            <div className="dialog-panel-title">
              Danh Sách Thẻ ({filteredCards.length})
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
                      <th>Ngày phát hành</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    {filteredCards.map(card => (
                      <tr 
                        key={card.uidThe}
                        style={{
                          backgroundColor: selectedCard?.uidThe === card.uidThe ? '#e0f2fe' : ''
                        }}
                      >
                        <td><code>{card.uidThe}</code></td>
                        <td>{card.loaiThe}</td>
                        <td>
                          <span className={`badge ${getStatusClass(card.trangThai)}`}>
                            {getStatusText(card.trangThai)}
                          </span>
                        </td>
                        <td>{card.bienSoXe || 'Chưa có'}</td>
                        <td>{formatDate(card.ngayPhatHanh)}</td>
                        <td>
                          <div style={{display: 'flex', gap: '4px'}}>
                            <button 
                              className="dialog-btn dialog-btn-sm dialog-btn-primary"
                              onClick={() => handleEditCard(card)}
                            >
                              Sửa
                            </button>
                            <button 
                              className="dialog-btn dialog-btn-sm dialog-btn-secondary"
                              onClick={() => handleViewHistory(card)}
                            >
                              Lịch sử
                            </button>
                            <button 
                              className="dialog-btn dialog-btn-sm dialog-btn-danger"
                              onClick={() => handleDeleteCard(card)}
                            >
                              Xóa
                            </button>
                          </div>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            )}
          </div>

          {/* Right Panel - Card Form or History */}
          <div className="dialog-panel primary">
            {showHistory ? (
              <>
                <div className="dialog-panel-title">
                  Lịch Sử Thẻ: {selectedCard?.uidThe}
                  <button 
                    className="dialog-btn dialog-btn-sm dialog-btn-secondary"
                    style={{float: 'right'}}
                    onClick={() => setShowHistory(false)}
                  >
                    ← Quay lại
                  </button>
                </div>
                
                <div style={{maxHeight: '500px', overflowY: 'auto'}}>
                  {cardHistory.length > 0 ? (
                    <table className="dialog-table">
                      <thead>
                        <tr>
                          <th>Thời gian</th>
                          <th>Hoạt động</th>
                          <th>Camera</th>
                          <th>Kết quả</th>
                        </tr>
                      </thead>
                      <tbody>
                        {cardHistory.map((record, index) => (
                          <tr key={index}>
                            <td>{formatDate(record.thoiGian)}</td>
                            <td>{record.hoatDong}</td>
                            <td>{record.camera}</td>
                            <td>{record.ketQua}</td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  ) : (
                    <div className="dialog-loading">Không có dữ liệu lịch sử</div>
                  )}
                </div>
              </>
            ) : (
              <>
                <div className="dialog-panel-title">
                  {editingCard ? "Chỉnh Sửa Thẻ" : "Thêm Thẻ Mới"}
                </div>

                <form onSubmit={(e) => {e.preventDefault(); handleFormSubmit();}}>
                  <div className="form-group">
                    <label>UID Thẻ *</label>
                    <input
                      type="text"
                      className="dialog-input"
                      value={formData.uidThe}
                      onChange={(e) => setFormData({...formData, uidThe: e.target.value})}
                      disabled={!!editingCard}
                      placeholder="Nhập UID thẻ"
                      required
                    />
                  </div>

                  <div className="form-group">
                    <label>Loại Thẻ *</label>
                    <select
                      className="dialog-select"
                      value={formData.loaiThe}
                      onChange={(e) => setFormData({...formData, loaiThe: e.target.value})}
                      required
                    >
                      {cardTypes.map(type => (
                        <option key={type} value={type}>{type}</option>
                      ))}
                    </select>
                  </div>

                  <div className="form-group">
                    <label>Trạng Thái *</label>
                    <select
                      className="dialog-select"
                      value={formData.trangThai}
                      onChange={(e) => setFormData({...formData, trangThai: e.target.value})}
                      required
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
                      value={formData.bienSoXe || ''}
                      onChange={(e) => setFormData({...formData, bienSoXe: e.target.value})}
                      placeholder="VD: 29A-12345"
                    />
                  </div>

                  <div className="form-group">
                    <label>Mã Chính Sách</label>
                    <input
                      type="text"
                      className="dialog-input"
                      value={formData.maChinhSach || ''}
                      onChange={(e) => setFormData({...formData, maChinhSach: e.target.value})}
                      placeholder="VD: CS_XEMAY_4H"
                    />
                  </div>

                  <div className="form-group">
                    <label>Ngày Kết Thúc Chính Sách</label>
                    <input
                      type="date"
                      className="dialog-input"
                      value={formData.ngayKetThucCS || ''}
                      onChange={(e) => setFormData({...formData, ngayKetThucCS: e.target.value})}
                    />
                  </div>

                  <button 
                    type="submit" 
                    className="dialog-btn dialog-btn-primary"
                    style={{width: '100%', marginTop: '16px'}}
                    disabled={loading}
                  >
                    {loading ? "Đang xử lý..." : (editingCard ? "Cập nhật thẻ" : "Thêm thẻ mới")}
                  </button>

                  {editingCard && (
                    <button 
                      type="button"
                      className="dialog-btn dialog-btn-secondary"
                      style={{width: '100%', marginTop: '8px'}}
                      onClick={resetForm}
                    >
                      Hủy chỉnh sửa
                    </button>
                  )}
                </form>
              </>
            )}
          </div>
        </div>

        <div className="dialog-footer">
          <button className="dialog-btn dialog-btn-primary" onClick={onSave}>
            Lưu & Đóng
          </button>
          <button className="dialog-btn dialog-btn-secondary" onClick={onClose}>
            Đóng
          </button>
        </div>
      </div>

      <style jsx>{`
        .badge {
          padding: 4px 8px;
          border-radius: 4px;
          font-size: 12px;
          font-weight: 600;
          text-transform: uppercase;
        }
        
        .badge-success {
          background: #dcfce7;
          color: #166534;
        }
        
        .badge-danger {
          background: #fecaca;
          color: #991b1b;
        }
        
        .dialog-btn-sm {
          padding: 4px 8px;
          font-size: 12px;
        }
        
        .form-group {
          margin-bottom: 16px;
        }
        
        .form-group label {
          display: block;
          margin-bottom: 4px;
          font-weight: 600;
          color: #374151;
        }
      `}</style>
    </div>
  )
}

export default RfidManagerDialogNew
