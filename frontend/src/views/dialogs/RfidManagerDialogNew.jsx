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
  
  // Thêm states mới theo mobile app
  const [policies, setPolicies] = useState([]) // Danh sách chính sách giá
  const [cardsWithVehicles, setCardsWithVehicles] = useState(new Set()) // Thẻ đang có xe gửi
  const [showPolicyAssignment, setShowPolicyAssignment] = useState(false) // Dialog gán chính sách
  const [selectedCardForPolicy, setSelectedCardForPolicy] = useState(null) // Thẻ được chọn để gán chính sách

  // Form state
  const [formData, setFormData] = useState({
    uidThe: "",
    loaiThe: "NHANVIEN",
    trangThai: "1",
    bienSoXe: "",
    maChinhSach: "",
    ngayKetThucCS: "",
    tongNgay: 0, // Số ngày có hiệu lực của chính sách
    ngayBatDauCS: "", // Ngày bắt đầu chính sách
    ghiChu: "" // Ghi chú thêm
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
    loadPolicies() // Load danh sách chính sách
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

  // Thêm function để load chính sách giá
  const loadPolicies = async () => {
    try {
      // const policyList = await layDanhSachChinhSachGia()
      // Tạm thời dùng dữ liệu mẫu
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

  // Kiểm tra thẻ đang có xe gửi
  const checkCardsWithVehicles = async () => {
    try {
      const cardsWithVehicleSet = new Set()
      
      for (const card of cards) {
        try {
          // const vehicleData = await kiemTraTheCoXeGui(card.uidThe)
          // if (vehicleData && vehicleData.length > 0) {
          //   cardsWithVehicleSet.add(card.uidThe)
          // }
          
          // Tạm thời mô phỏng 
          if (Math.random() > 0.7) {
            cardsWithVehicleSet.add(card.uidThe)
          }
        } catch (error) {
          console.error(`Error checking vehicle for card ${card.uidThe}:`, error)
        }
      }
      
      setCardsWithVehicles(cardsWithVehicleSet)
    } catch (error) {
      console.error("Error checking cards with vehicles:", error)
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
      ngayKetThucCS: card.ngayKetThucCS || "",
      tongNgay: card.tongNgay || 0,
      ngayBatDauCS: card.ngayBatDauCS || "",
      ghiChu: card.ghiChu || ""
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
      ngayKetThucCS: "",
      tongNgay: 0,
      ngayBatDauCS: "",
      ghiChu: ""
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

  // Tính toán ngày hết hạn chính sách
  const calculatePolicyEndDate = (startDate, policyDays) => {
    if (!startDate || !policyDays) return ""
    
    const start = new Date(startDate)
    const endDate = new Date(start.getTime() + (policyDays * 24 * 60 * 60 * 1000))
    return endDate.toISOString().split('T')[0]
  }

  // Gán chính sách cho thẻ VIP
  const handleAssignPolicy = (card) => {
    setSelectedCardForPolicy(card)
    setFormData({
      ...formData,
      uidThe: card.uidThe,
      maChinhSach: card.maChinhSach || "",
      ngayBatDauCS: card.ngayBatDauCS || new Date().toISOString().split('T')[0],
      ngayKetThucCS: card.ngayKetThucCS || "",
      tongNgay: card.tongNgay || 0
    })
    setShowPolicyAssignment(true)
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
                      <th>Chính sách</th>
                      <th>Có xe gửi</th>
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
                        <td>{card.uidThe}</td>
                        <td>
                          <span className={`badge ${card.loaiThe === 'VIP' ? 'badge-premium' : 
                            card.loaiThe === 'NHANVIEN' ? 'badge-info' : 'badge-default'}`}>
                            {card.loaiThe}
                          </span>
                        </td>
                        <td>
                          <span className={`badge ${card.trangThai === '1' ? 'badge-success' : 'badge-danger'}`}>
                            {card.trangThai === '1' ? 'Hoạt động' : 'Ngừng'}
                          </span>
                        </td>
                        <td>{card.bienSoXe || 'Chưa có'}</td>
                        <td>
                          {card.maChinhSach ? (
                            <div className="policy-info">
                              <span className="policy-name">{card.maChinhSach}</span>
                              {card.ngayKetThucCS && (
                                <small className="policy-expire">
                                  Hết hạn: {new Date(card.ngayKetThucCS).toLocaleDateString()}
                                </small>
                              )}
                            </div>
                          ) : (
                            <span className="no-policy">Chưa có</span>
                          )}
                        </td>
                        <td>
                          <span className={`vehicle-status ${cardsWithVehicles.has(card.uidThe) ? 'has-vehicle' : 'no-vehicle'}`}>
                            {cardsWithVehicles.has(card.uidThe) ? '🚗 Có xe' : '🚫 Trống'}
                          </span>
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
                            {(card.loaiThe === 'VIP' || card.loaiThe === 'NHANVIEN') && (
                              <button 
                                className="btn-small btn-info"
                                onClick={(e) => {
                                  e.stopPropagation()
                                  handleAssignPolicy(card)
                                }}
                                title="Gán chính sách"
                              >
                                💳
                              </button>
                            )}
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

                  <div className="form-group">
                    <label>Ngày Bắt Đầu Chính Sách</label>
                    <input
                      type="date"
                      className="dialog-input"
                      value={formData.ngayBatDauCS || ''}
                      onChange={(e) => setFormData({...formData, ngayBatDauCS: e.target.value})}
                    />
                  </div>

                  <div className="form-group">
                    <label>Số Ngày Có Hiệu Lực</label>
                    <input
                      type="number"
                      className="dialog-input"
                      value={formData.tongNgay || 0}
                      onChange={(e) => setFormData({...formData, tongNgay: Number(e.target.value)})}
                      placeholder="VD: 30"
                    />
                  </div>

                  <div className="form-group">
                    <label>Ghi Chú</label>
                    <textarea
                      className="dialog-textarea"
                      value={formData.ghiChu || ''}
                      onChange={(e) => setFormData({...formData, ghiChu: e.target.value})}
                      placeholder="Nhập ghi chú thêm về thẻ"
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

      {/* Policy Assignment Dialog */}
      {showPolicyAssignment && selectedCardForPolicy && (
        <div className="dialog-overlay">
          <div className="dialog-container">
            <div className="dialog-header">
              <h3>Gán Chính Sách - Thẻ {selectedCardForPolicy.uidThe}</h3>
              <button 
                className="close-button" 
                onClick={() => setShowPolicyAssignment(false)}
              >
                ×
              </button>
            </div>

            <div className="dialog-content">
              <div className="form-container">
                <div className="form-group">
                  <label>Chính Sách:</label>
                  <select
                    className="dialog-select"
                    value={formData.maChinhSach}
                    onChange={(e) => {
                      const selectedPolicy = policies.find(p => p.maChinhSach === e.target.value)
                      setFormData({
                        ...formData,
                        maChinhSach: e.target.value,
                        tongNgay: selectedPolicy?.tongNgay || 0,
                        ngayKetThucCS: selectedPolicy && formData.ngayBatDauCS ? 
                          calculatePolicyEndDate(formData.ngayBatDauCS, selectedPolicy.tongNgay) : ""
                      })
                    }}
                  >
                    <option value="">Chọn chính sách</option>
                    {policies.map(policy => (
                      <option key={policy.maChinhSach} value={policy.maChinhSach}>
                        {policy.tenChinhSach} ({policy.tongNgay} ngày) - {policy.donGia?.toLocaleString()}đ
                      </option>
                    ))}
                  </select>
                </div>

                <div className="form-group">
                  <label>Ngày Bắt Đầu:</label>
                  <input
                    type="date"
                    className="dialog-input"
                    value={formData.ngayBatDauCS}
                    onChange={(e) => {
                      const selectedPolicy = policies.find(p => p.maChinhSach === formData.maChinhSach)
                      setFormData({
                        ...formData,
                        ngayBatDauCS: e.target.value,
                        ngayKetThucCS: selectedPolicy ? 
                          calculatePolicyEndDate(e.target.value, selectedPolicy.tongNgay) : ""
                      })
                    }}
                  />
                </div>

                <div className="form-group">
                  <label>Ngày Kết Thúc:</label>
                  <input
                    type="date"
                    className="dialog-input"
                    value={formData.ngayKetThucCS}
                    readOnly
                    style={{ backgroundColor: '#f5f5f5' }}
                  />
                  <small className="form-help">
                    Tự động tính từ ngày bắt đầu và số ngày của chính sách
                  </small>
                </div>

                <div className="form-group">
                  <label>Số Ngày Hiệu Lực:</label>
                  <input
                    type="number"
                    className="dialog-input"
                    value={formData.tongNgay}
                    readOnly
                    style={{ backgroundColor: '#f5f5f5' }}
                  />
                </div>

                <div className="form-group">
                  <label>Ghi Chú:</label>
                  <textarea
                    className="dialog-textarea"
                    value={formData.ghiChu}
                    onChange={(e) => setFormData({...formData, ghiChu: e.target.value})}
                    placeholder="Ghi chú về việc gán chính sách..."
                    rows="3"
                  />
                </div>

                <div className="button-group">
                  <button 
                    className="btn btn-success"
                    onClick={async () => {
                      try {
                        setLoading(true)
                        // await capNhatChinhSachChoThe(formData)
                        alert("Gán chính sách thành công!")
                        setShowPolicyAssignment(false)
                        loadCards()
                      } catch (error) {
                        alert("Lỗi gán chính sách: " + error.message)
                      } finally {
                        setLoading(false)
                      }
                    }}
                    disabled={loading || !formData.maChinhSach || !formData.ngayBatDauCS}
                  >
                    {loading ? "Đang lưu..." : "Gán Chính Sách"}
                  </button>
                  <button 
                    className="btn btn-cancel"
                    onClick={() => setShowPolicyAssignment(false)}
                  >
                    Hủy
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}

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
