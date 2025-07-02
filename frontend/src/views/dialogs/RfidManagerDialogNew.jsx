"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/dialog-base.css"
import "../../assets/styles/enhanced-dialogs.css"
import "../../assets/styles/RfidManagerDialog.css"
import { 
  layDanhSachThe, 
  themTheMobile,
  capNhatTheRFIDMobile, 
  xoaTheRFID,
  layNhatKyTheoTheNgocChung,
  timTheDangCoPhien,
  thongTinTheDangCoXeGui,
  layTheRFIDTheoUID,
  layDanhSachChinhSachGiaV2,
  tinhNgayKetThucChinhSach
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
  const [validationErrors, setValidationErrors] = useState({})

  // Form state - theo chuẩn mobile app
  const [formData, setFormData] = useState({
    uidThe: "",
    loaiThe: "KHACH", // Giống mobile app
    trangThai: "1",
    bienSoXe: "",
    maChinhSach: "",
    ngayKetThucCS: "",
    tongNgay: 0,
    ngayBatDauCS: "",
    ghiChu: ""
  })
  
  // Debug log current form data
  console.log(`🐛 Current formData:`, formData)

  // Card types theo mobile app
  const cardTypes = [
    { value: 'KHACH', label: 'Thẻ thường', icon: '💳', description: 'Thẻ dành cho khách thường' },
    { value: 'VIP', label: 'Thẻ VIP', icon: '💎', description: 'Thẻ VIP với ưu đãi đặc biệt' },
    { value: 'NHANVIEN', label: 'Thẻ nhân viên', icon: '👤', description: 'Thẻ dành cho nhân viên' }
  ]

  useEffect(() => {
    loadCards()
    loadPolicies()
  }, [])

  useEffect(() => {
    filterCards()
  }, [cards, searchTerm, statusFilter, typeFilter])

  // Tự động tính ngày kết thúc chính sách khi thay đổi (realtime update)
  useEffect(() => {
    console.log(`🔍 useEffect triggered - maChinhSach: ${formData.maChinhSach}, ngayBatDauCS: ${formData.ngayBatDauCS}`)
    console.log(`🔍 Available policies count: ${policies.length}`)
    console.log(`🔍 Available policies:`, policies.map(p => ({ 
      maChinhSach: p.maChinhSach, 
      tongNgay: p.tongNgay,
      donGia: p.donGia 
    })))
    
    if (formData.maChinhSach && formData.ngayBatDauCS) {
      const selectedPolicy = policies.find(p => p.maChinhSach === formData.maChinhSach)
      console.log(`🔍 Selected policy for ${formData.maChinhSach}:`, selectedPolicy)
      
      if (selectedPolicy && selectedPolicy.tongNgay > 0) {
        const endDate = calculatePolicyEndDate(formData.ngayBatDauCS, selectedPolicy.tongNgay)
        console.log(`🔍 Calculated end date: ${endDate}`)
        
        // Chỉ cập nhật nếu ngày kết thúc thực sự thay đổi
        if (endDate && endDate !== formData.ngayKetThucCS) {
          console.log(`🔍 Updating formData with new end date: ${endDate}`)
          setFormData(prev => ({
            ...prev,
            ngayKetThucCS: endDate,
            tongNgay: selectedPolicy.tongNgay
          }))
        }
      } else {
        console.log(`🔍 No policy found or tongNgay <= 0`)
      }
    } else {
      console.log(`🔍 Missing maChinhSach or ngayBatDauCS`)
    }
  }, [formData.maChinhSach, formData.ngayBatDauCS, policies])

  // Tự động set ngày bắt đầu mặc định khi chọn chính sách VIP
  useEffect(() => {
    if (formData.maChinhSach && !formData.ngayBatDauCS) {
      const selectedPolicy = policies.find(p => p.maChinhSach === formData.maChinhSach)
      if (selectedPolicy && selectedPolicy.tongNgay > 0) {
        const today = new Date().toISOString().split('T')[0] // Format YYYY-MM-DD
        setFormData(prev => ({
          ...prev,
          ngayBatDauCS: today
        }))
      }
    }
  }, [formData.maChinhSach, policies])

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
      // Lấy từ API thực tế thay vì hardcode
      const policyList = await layDanhSachChinhSachGiaV2()
      console.log(`📋 Loaded policies from API:`, policyList)
      setPolicies(policyList || [])
    } catch (error) {
      console.error("Error loading policies:", error)
      // Fallback với dữ liệu mẫu
      const fallbackPolicies = [
        { maChinhSach: "CS_VIP_1T", tenChinhSach: "VIP 1 Tháng", tongNgay: 30, donGia: 500000 },
        { maChinhSach: "CS_VIP_3T", tenChinhSach: "VIP 3 Tháng", tongNgay: 90, donGia: 1400000 },
        { maChinhSach: "CS_VIP_1NAM", tenChinhSach: "VIP 1 Năm", tongNgay: 365, donGia: 5000000 }
      ]
      console.log(`📋 Using fallback policies:`, fallbackPolicies)
      setPolicies(fallbackPolicies)
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
    setValidationErrors({})
    setFormData({
      uidThe: "",
      loaiThe: "KHACH", // Mặc định giống mobile app
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
    setValidationErrors({})
    setFormData({
      uidThe: card.uidThe,
      loaiThe: card.loaiThe || "KHACH",
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

  // Validation theo mobile app
  const validateCardForm = () => {
    const errors = {}

    // Kiểm tra UID thẻ
    if (!formData.uidThe.trim()) {
      errors.uidThe = "Vui lòng nhập mã thẻ"
    } else if (formData.uidThe.trim().length < 4) {
      errors.uidThe = "Mã thẻ phải có ít nhất 4 ký tự"
    }

    // Kiểm tra biển số bắt buộc cho VIP và NHANVIEN (như mobile app)
    if ((formData.loaiThe === 'VIP' || formData.loaiThe === 'NHANVIEN') && 
        !formData.bienSoXe.trim()) {
      errors.bienSoXe = "Vui lòng nhập biển số xe cho thẻ VIP/Nhân viên"
    }

    // Kiểm tra format biển số nếu có nhập
    if (formData.bienSoXe.trim() && formData.bienSoXe.trim().length < 7) {
      errors.bienSoXe = "Biển số xe không hợp lệ (ít nhất 7 ký tự)"
    }

    // Kiểm tra chính sách VIP phải có ngày bắt đầu
    if (formData.maChinhSach && !formData.ngayBatDauCS) {
      errors.ngayBatDauCS = "Vui lòng chọn ngày bắt đầu chính sách"
    }

    // Tự động tính ngày kết thúc nếu có chính sách và ngày bắt đầu nhưng chưa có ngày kết thúc
    if (formData.maChinhSach && formData.ngayBatDauCS && !formData.ngayKetThucCS) {
      const selectedPolicy = policies.find(p => p.maChinhSach === formData.maChinhSach)
      if (selectedPolicy && selectedPolicy.tongNgay > 0) {
        // Tính ngày kết thúc ngay lập tức
        const calculatedEndDate = tinhNgayKetThucChinhSach(formData.ngayBatDauCS, selectedPolicy.tongNgay)
        console.log(`🔧 Auto-calculate end date: ${formData.ngayBatDauCS} + ${selectedPolicy.tongNgay} days = ${calculatedEndDate}`)
        
        // Cập nhật formData với ngày kết thúc đã tính
        setFormData(prev => ({
          ...prev,
          ngayKetThucCS: calculatedEndDate,
          tongNgay: selectedPolicy.tongNgay
        }))
        
        // Không báo lỗi nếu có thể tính được
        if (!calculatedEndDate) {
          errors.ngayKetThucCS = "Không thể tính ngày kết thúc chính sách. Vui lòng kiểm tra dữ liệu."
        }
      }
    }

    setValidationErrors(errors)
    return Object.keys(errors).length === 0
  }

  const handleFormSubmit = async () => {
    // Validation trước khi submit
    if (!validateCardForm()) {
      return
    }

    try {
      setLoading(true)
      let result

      if (editingCard) {
        // Đảm bảo ngày kết thúc chính sách được tính đúng cho trường hợp edit
        let finalEndDate = formData.ngayKetThucCS
        
        // Nếu có chính sách và ngày bắt đầu nhưng chưa có ngày kết thúc, tính lại
        if (formData.maChinhSach && formData.ngayBatDauCS && !finalEndDate) {
          const selectedPolicy = policies.find(p => p.maChinhSach === formData.maChinhSach)
          if (selectedPolicy && selectedPolicy.tongNgay > 0) {
            finalEndDate = tinhNgayKetThucChinhSach(formData.ngayBatDauCS, selectedPolicy.tongNgay)
            console.log(`🔄 Tính lại ngày kết thúc cho edit: ${formData.ngayBatDauCS} + ${selectedPolicy.tongNgay} ngày = ${finalEndDate}`)
          }
        }

        // Debug log để kiểm tra dữ liệu gửi đi khi edit
        console.log(`📤 Dữ liệu gửi capNhatTheRFIDMobile:`, {
          uidThe: formData.uidThe,
          loaiThe: formData.loaiThe,
          trangThai: formData.trangThai,
          bienSoXe: formData.bienSoXe.trim() || "",
          maChinhSach: formData.maChinhSach || "",
          ngayKetThucCS: finalEndDate || "",
          tongNgayChinhSach: formData.tongNgay
        })

        // Cập nhật thẻ - sử dụng mobile app API với đầy đủ thông tin
        result = await capNhatTheRFIDMobile({
          uidThe: formData.uidThe,
          loaiThe: formData.loaiThe,
          trangThai: formData.trangThai,
          bienSoXe: formData.bienSoXe.trim() || "",
          maChinhSach: formData.maChinhSach || "",
          ngayKetThucCS: finalEndDate || ""
        })
      } else {
        // Đảm bảo ngày kết thúc chính sách được tính đúng trước khi gửi
        let finalEndDate = formData.ngayKetThucCS
        
        // Nếu có chính sách và ngày bắt đầu nhưng chưa có ngày kết thúc, tính lại
        if (formData.maChinhSach && formData.ngayBatDauCS && !finalEndDate) {
          const selectedPolicy = policies.find(p => p.maChinhSach === formData.maChinhSach)
          if (selectedPolicy && selectedPolicy.tongNgay > 0) {
            finalEndDate = tinhNgayKetThucChinhSach(formData.ngayBatDauCS, selectedPolicy.tongNgay)
            console.log(`🔄 Tính lại ngày kết thúc: ${formData.ngayBatDauCS} + ${selectedPolicy.tongNgay} ngày = ${finalEndDate}`)
          }
        }

        // Debug log để kiểm tra dữ liệu gửi đi
        console.log(`📤 Dữ liệu gửi themTheMobile:`, {
          uidThe: formData.uidThe.trim(),
          loaiThe: formData.loaiThe,
          trangThai: formData.trangThai,
          bienSoXe: formData.bienSoXe.trim() || "",
          maChinhSach: formData.maChinhSach || "",
          ngayKetThucCS: finalEndDate || "",
          tongNgayChinhSach: formData.tongNgay
        })

        // Thêm thẻ mới - sử dụng mobile app API
        result = await themTheMobile(
          formData.uidThe.trim(),
          formData.loaiThe,
          formData.trangThai,
          formData.bienSoXe.trim() || "",
          formData.maChinhSach || "",
          finalEndDate || ""
        )
      }

      if (result && result.success) {
        // Thông báo thành công giống mobile app
        const cardTypeName = cardTypes.find(t => t.value === formData.loaiThe)?.label || formData.loaiThe
        const successMessage = editingCard 
          ? `Đã cập nhật thẻ ${formData.uidThe} (${cardTypeName}) thành công!`
          : `Đã thêm thẻ ${formData.uidThe} (${cardTypeName}) thành công!${
              formData.bienSoXe.trim() ? `\nBiển số: ${formData.bienSoXe.trim()}` : ''
            }`
        
        alert(successMessage)
        setShowAddDialog(false)
        await loadCards()
      } else {
        alert("Lỗi: " + (result?.message || "Không thể lưu thẻ"))
      }
    } catch (error) {
      console.error("Error saving card:", error)
      alert("Lỗi: " + (error instanceof Error ? error.message : "Lỗi không xác định"))
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
    console.log(`🔄 calculatePolicyEndDate called with: startDate=${startDate}, policyDays=${policyDays}`)
    
    if (!startDate || !policyDays || policyDays <= 0) {
      console.log(`⚠️ Invalid input for calculatePolicyEndDate`)
      return ''
    }
    
    const endDate = tinhNgayKetThucChinhSach(startDate, policyDays)
    console.log(`🔄 Tính ngày kết thúc chính sách: ${startDate} + ${policyDays} ngày = ${endDate}`)
    return endDate
  }
  return (
    <div className="rfid-dialog">
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
                      <option key={type.value} value={type.value}>{type.label}</option>
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
                            <span className={`badge ${
                              card.loaiThe === 'VIP' ? 'badge-premium' : 
                              card.loaiThe === 'NHANVIEN' ? 'badge-info' : 
                              card.loaiThe === 'KHACH' ? 'badge-default' : 'badge-secondary'
                            }`}>
                              {cardTypes.find(t => t.value === card.loaiThe)?.label || card.loaiThe}
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
                                Sửa
                              </button>
                              <button 
                                className="btn-small btn-warning"
                                onClick={(e) => {
                                  e.stopPropagation()
                                  handleViewHistory(card)
                                }}
                                title="Xem lịch sử"
                              >
                                Lịch sử
                              </button>
                              <button 
                                className="btn-small btn-danger"
                                onClick={(e) => {
                                  e.stopPropagation()
                                  handleDeleteCard(card)
                                }}
                                title="Xóa"
                              >
                                Xóa
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
                    const count = cards.filter(card => card.loaiThe === type.value).length
                    return count > 0 ? (
                      <div key={type.value} className="type-stat">
                        <span className="type-icon">{type.icon}</span>
                        <span className="type-name">{type.label}</span>
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
                    <div><strong>Loại:</strong> {cardTypes.find(t => t.value === selectedCard.loaiThe)?.label || selectedCard.loaiThe}</div>
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
              {/* Thông báo cảnh báo giống mobile app */}
              {!editingCard && (
                <div className="warning-card" style={{
                  background: '#fff3cd',
                  border: '1px solid #ffeaa7',
                  borderRadius: '6px',
                  padding: '12px',
                  marginBottom: '16px',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '8px'
                }}>
                  <span style={{color: '#ff9800', fontSize: '18px'}}>⚠️</span>
                  <span style={{color: '#856404', fontSize: '14px'}}>
                    Thẻ RFID chưa tồn tại trong hệ thống. Vui lòng thêm thẻ mới để tiếp tục.
                  </span>
                </div>
              )}

              <div className="form-group">
                <label>Mã Thẻ RFID <span style={{color: 'red'}}>*</span></label>
                <input
                  type="text"
                  className={`dialog-input ${validationErrors.uidThe ? 'error' : ''}`}
                  value={formData.uidThe}
                  onChange={(e) => {
                    setFormData({...formData, uidThe: e.target.value})
                    if (validationErrors.uidThe) {
                      setValidationErrors({...validationErrors, uidThe: null})
                    }
                  }}
                  placeholder="Nhập mã thẻ RFID"
                  disabled={!!editingCard}
                  style={{ fontFamily: 'monospace', fontSize: '1.1rem' }}
                  maxLength={50}
                />
                {validationErrors.uidThe && (
                  <div className="error-message" style={{color: 'red', fontSize: '12px', marginTop: '4px'}}>
                    {validationErrors.uidThe}
                  </div>
                )}
              </div>

              <div className="form-group">
                <label>Loại Thẻ <span style={{color: 'red'}}>*</span></label>
                <select
                  className="dialog-select"
                  value={formData.loaiThe}
                  onChange={(e) => {
                    const newLoaiThe = e.target.value
                    setFormData({
                      ...formData, 
                      loaiThe: newLoaiThe,
                      // Reset biển số và chính sách khi đổi loại
                      bienSoXe: newLoaiThe === 'KHACH' ? '' : formData.bienSoXe, 
                      maChinhSach: newLoaiThe === 'KHACH' ? '' : formData.maChinhSach
                    })
                    // Clear validation error
                    if (validationErrors.bienSoXe && newLoaiThe === 'KHACH') {
                      setValidationErrors({...validationErrors, bienSoXe: null})
                    }
                  }}
                >
                  {cardTypes.map((type) => (
                    <option key={type.value} value={type.value}>
                      {type.icon} {type.label}
                    </option>
                  ))}
                </select>
                {/* Hiển thị mô tả loại thẻ */}
                <div style={{fontSize: '12px', color: '#666', marginTop: '4px'}}>
                  {cardTypes.find(t => t.value === formData.loaiThe)?.description}
                </div>
              </div>

              <div className="form-group">
                <label>Trạng Thái <span style={{color: 'red'}}>*</span></label>
                <select
                  className="dialog-select"
                  value={formData.trangThai}
                  onChange={(e) => setFormData({...formData, trangThai: e.target.value})}
                >
                  <option value="1">🟢 Hoạt động</option>
                  <option value="0">🔴 Không hoạt động</option>
                </select>
              </div>

              <div className="form-group">
                <label>
                  Biển Số Xe 
                  {(formData.loaiThe === 'VIP' || formData.loaiThe === 'NHANVIEN') && (
                    <span style={{color: 'red'}}>*</span>
                  )}
                </label>
                <input
                  type="text"
                  className={`dialog-input ${validationErrors.bienSoXe ? 'error' : ''}`}
                  value={formData.bienSoXe}
                  onChange={(e) => {
                    const value = e.target.value.toUpperCase()
                    setFormData({...formData, bienSoXe: value})
                    if (validationErrors.bienSoXe) {
                      setValidationErrors({...validationErrors, bienSoXe: null})
                    }
                  }}
                  placeholder={
                    formData.loaiThe === 'VIP' || formData.loaiThe === 'NHANVIEN' 
                      ? "Nhập biển số xe (bắt buộc)" 
                      : "Nhập biển số xe (tùy chọn)"
                  }
                  style={{ fontFamily: 'monospace' }}
                  maxLength={15}
                />
                {validationErrors.bienSoXe && (
                  <div className="error-message" style={{color: 'red', fontSize: '12px', marginTop: '4px'}}>
                    {validationErrors.bienSoXe}
                  </div>
                )}
                {(formData.loaiThe === 'VIP' || formData.loaiThe === 'NHANVIEN') && (
                  <div style={{fontSize: '12px', color: '#ff9800', marginTop: '4px'}}>
                    ⚠️ Biển số xe bắt buộc cho thẻ VIP/Nhân viên
                  </div>
                )}
              </div>

              {(formData.loaiThe === 'VIP' || formData.loaiThe === 'NHANVIEN') && (
                <>
                  <div className="form-group">
                    <label>Mã Chính Sách</label>
                    <select
                      className="dialog-select"
                      value={formData.maChinhSach}
                      onChange={(e) => {
                        const selectedPolicyId = e.target.value
                        const selectedPolicy = policies.find(p => p.maChinhSach === selectedPolicyId)
                        
                        console.log(`🎯 User selected policy: ${selectedPolicyId}`)
                        console.log(`🎯 Selected policy details:`, selectedPolicy)
                        
                        // Nếu chọn chính sách có tongNgay > 0 và chưa có ngày bắt đầu, tự động set ngày hôm nay
                        let startDate = formData.ngayBatDauCS
                        if (selectedPolicy?.tongNgay > 0 && !startDate) {
                          startDate = new Date().toISOString().split('T')[0] // YYYY-MM-DD
                          console.log(`🎯 Auto-set start date to today: ${startDate}`)
                        }
                        
                        // Tự động cập nhật thông tin chính sách và tính ngày kết thúc
                        const updatedFormData = {
                          ...formData, 
                          maChinhSach: selectedPolicyId,
                          tongNgay: selectedPolicy?.tongNgay || 0,
                          ngayBatDauCS: startDate
                        }
                        
                        // Tính ngày kết thúc nếu có chính sách VIP và ngày bắt đầu
                        if (selectedPolicy?.tongNgay > 0 && startDate) {
                          const calculatedEndDate = calculatePolicyEndDate(startDate, selectedPolicy.tongNgay)
                          updatedFormData.ngayKetThucCS = calculatedEndDate
                          console.log(`🎯 Auto-calculated end date: ${calculatedEndDate}`)
                        } else {
                          updatedFormData.ngayKetThucCS = "" // Clear end date for non-VIP policies
                        }
                        
                        console.log(`🎯 Final updated form data:`, updatedFormData)
                        setFormData(updatedFormData)
                      }}
                    >
                      <option value="">-- Chọn chính sách --</option>
                      {policies.map(policy => (
                        <option key={policy.maChinhSach} value={policy.maChinhSach}>
                          {policy.maChinhSach} - {policy.donGia?.toLocaleString()}đ{policy.tongNgay > 0 ? `/${policy.tongNgay} ngày` : '/lượt'}
                        </option>
                      ))}
                    </select>
                    {formData.maChinhSach && (
                      <div style={{fontSize: '12px', color: '#6b7280', marginTop: '4px'}}>
                        {(() => {
                          const selectedPolicy = policies.find(p => p.maChinhSach === formData.maChinhSach)
                          if (selectedPolicy) {
                            return selectedPolicy.tongNgay > 0 
                              ? `Chính sách VIP: ${selectedPolicy.tongNgay} ngày - ${selectedPolicy.loaiChinhSach}`
                              : `Chính sách thường: ${selectedPolicy.thoiGian} phút`
                          }
                          return ''
                        })()}
                      </div>
                    )}
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
                          
                          console.log(`📅 User changed start date: ${startDate}`)
                          console.log(`📅 Selected policy for calculation:`, selectedPolicy)
                          
                          const endDate = selectedPolicy ? calculatePolicyEndDate(startDate, selectedPolicy.tongNgay) : ""
                          
                          console.log(`📅 Calculated end date: ${endDate}`)
                          
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

              {/* Debug test button */}
              <div className="form-group">
                <button
                  type="button"
                  className="btn-secondary"
                  onClick={() => {
                    console.log('🧪 Test Button Clicked')
                    console.log('🧪 Current formData:', formData)
                    console.log('🧪 Available policies:', policies)
                    
                    if (formData.maChinhSach && formData.ngayBatDauCS) {
                      const selectedPolicy = policies.find(p => p.maChinhSach === formData.maChinhSach)
                      console.log('🧪 Selected policy:', selectedPolicy)
                      
                      if (selectedPolicy?.tongNgay) {
                        const testEndDate = tinhNgayKetThucChinhSach(formData.ngayBatDauCS, selectedPolicy.tongNgay)
                        console.log('🧪 Test calculated end date:', testEndDate)
                        
                        // Force update formData
                        setFormData(prev => ({
                          ...prev,
                          ngayKetThucCS: testEndDate
                        }))
                      }
                    }
                  }}
                  style={{ marginBottom: '10px' }}
                >
                  Test Calculate End Date
                </button>
              </div>
            </div>

            <div className="dialog-footer">
              <button 
                className="dialog-btn dialog-btn-primary" 
                onClick={handleFormSubmit} 
                disabled={loading || !formData.uidThe.trim()}
                style={{
                  opacity: loading || !formData.uidThe.trim() ? 0.6 : 1,
                  cursor: loading || !formData.uidThe.trim() ? 'not-allowed' : 'pointer'
                }}
              >
                {loading ? "Đang lưu..." : (editingCard ? "Cập Nhật" : "Thêm Mới")}
              </button>
              <button 
                className="dialog-btn dialog-btn-secondary" 
                onClick={() => {
                  setShowAddDialog(false)
                  setValidationErrors({})
                }}
                disabled={loading}
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
    </div>
  )
}

export default RfidManagerDialog
