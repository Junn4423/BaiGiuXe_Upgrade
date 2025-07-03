"use client"

import { useState, useEffect } from "react"
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
  const [showCardHistory, setShowCardHistory] = useState(false)
  const [selectedCardForHistory, setSelectedCardForHistory] = useState(null)
  const [showAddDialog, setShowAddDialog] = useState(false)
  const [isEditing, setIsEditing] = useState(false)
  
  // Enhanced states from mobile app
  const [policies, setPolicies] = useState([])
  const [cardsWithVehicles, setCardsWithVehicles] = useState(new Set())
  const [showPolicyAssignment, setShowPolicyAssignment] = useState(false)
  const [selectedCardForPolicy, setSelectedCardForPolicy] = useState(null)
  const [validationErrors, setValidationErrors] = useState({})

  // Form state - theo chuẩn mobile app
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

  // Tự động tính ngày kết thúc chính sách khi thay đổi (realtime update)
  useEffect(() => {
    console.log(`useEffect triggered - maChinhSach: ${formData.maChinhSach}, ngayBatDauCS: ${formData.ngayBatDauCS}`)
    console.log(`Available policies count: ${policies.length}`)
    
    if (formData.maChinhSach && formData.ngayBatDauCS) {
      const selectedPolicy = policies.find(p => p.maChinhSach === formData.maChinhSach)
      console.log(`Selected policy for ${formData.maChinhSach}:`, selectedPolicy)
      
      if (selectedPolicy && selectedPolicy.tongNgay > 0) {
        const endDate = calculatePolicyEndDate(formData.ngayBatDauCS, selectedPolicy.tongNgay)
        console.log(`Calculated end date: ${endDate}`)
        
        // Chỉ cập nhật nếu ngày kết thúc thực sự thay đổi
        if (endDate && endDate !== formData.ngayKetThucCS) {
          console.log(`Updating formData with new end date: ${endDate}`)
          setFormData(prev => ({
            ...prev,
            ngayKetThucCS: endDate,
            tongNgay: selectedPolicy.tongNgay
          }))
        }
      } else {
        console.log(`No policy found or tongNgay <= 0`)
      }
    } else {
      console.log(`Missing maChinhSach or ngayBatDauCS`)
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
      console.log(`Loaded policies from API:`, policyList)
      setPolicies(policyList || [])
    } catch (error) {
      console.error("Error loading policies:", error)
      // Fallback với dữ liệu mẫu
      const fallbackPolicies = [
        { maChinhSach: "CS_VIP_1T", tenChinhSach: "VIP 1 Tháng", tongNgay: 30, donGia: 500000 },
        { maChinhSach: "CS_VIP_3T", tenChinhSach: "VIP 3 Tháng", tongNgay: 90, donGia: 1400000 },
        { maChinhSach: "CS_VIP_1NAM", tenChinhSach: "VIP 1 Năm", tongNgay: 365, donGia: 5000000 }
      ]
      console.log(`Using fallback policies:`, fallbackPolicies)
      setPolicies(fallbackPolicies)
    }
  }

  const filterCards = () => {
    let filtered = [...cards]

    // Search filter
    if (searchTerm) {
      filtered = filtered.filter(card =>
        card.uidThe?.toLowerCase().includes(searchTerm.toLowerCase()) ||
        card.bienSoXe?.toLowerCase().includes(searchTerm.toLowerCase()) ||
        card.loaiThe?.toLowerCase().includes(searchTerm.toLowerCase())
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
    setEditingCard(null)
    setValidationErrors({})
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
    setIsEditing(true)
    setShowAddDialog(true)
  }

  const handleSaveCard = async () => {
    // Validation trước khi submit
    if (!validateCardForm()) {
      return
    }

    try {
      setLoading(true)
      let result

      if (isEditing) {
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
            console.log(`Tính lại ngày kết thúc: ${formData.ngayBatDauCS} + ${selectedPolicy.tongNgay} ngày = ${finalEndDate}`)
          }
        }

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
        // Thông báo thành công
        const cardTypeName = cardTypes.find(t => t.value === formData.loaiThe)?.label || formData.loaiThe
        const successMessage = isEditing 
          ? `Đã cập nhật thẻ ${formData.uidThe} (${cardTypeName}) thành công!`
          : `Đã thêm thẻ ${formData.uidThe} (${cardTypeName}) thành công!${
              formData.bienSoXe.trim() ? `\nBiển số: ${formData.bienSoXe.trim()}` : ''
            }`
        
        alert(successMessage)
        setShowAddDialog(false)
        loadCards()
        if (onSave) onSave()
      } else {
        throw new Error(result?.message || "Thao tác thất bại")
      }
    } catch (error) {
      console.error("Error saving card:", error)
      alert("Lỗi: " + error.message)
    } finally {
      setLoading(false)
    }
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
        loadCards()
        if (onSave) onSave()
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
        console.log(` Auto-calculate end date: ${formData.ngayBatDauCS} + ${selectedPolicy.tongNgay} days = ${calculatedEndDate}`)
        
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

  const calculatePolicyEndDate = (startDate, policyDays) => {
    console.log(`calculatePolicyEndDate called with: startDate=${startDate}, policyDays=${policyDays}`)
    
    if (!startDate || !policyDays || policyDays <= 0) {
      console.log(`Invalid input for calculatePolicyEndDate`)
      return ''
    }
    
    const endDate = tinhNgayKetThucChinhSach(startDate, policyDays)
    console.log(`Tính ngày kết thúc chính sách: ${startDate} + ${policyDays} ngày = ${endDate}`)
    return endDate
  }

  const formatDate = (dateString) => {
    if (!dateString) return "N/A"
    return new Date(dateString).toLocaleDateString("vi-VN")
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
                {validationErrors.bienSoXe && (
                  <span className="error-text">{validationErrors.bienSoXe}</span>
                )}
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
                      {policy.maChinhSach} {policy.tongNgay ? `(${policy.tongNgay} ngày)` : ''}
                    </option>
                  ))}
                </select>
              </div>

              {/* Hiển thị ngày bắt đầu và kết thúc nếu có chính sách */}
              {formData.maChinhSach && (
                <>
                  <div className="form-group">
                    <label>Ngày bắt đầu chính sách</label>
                    <input
                      type="date"
                      value={formData.ngayBatDauCS}
                      onChange={(e) => handleInputChange("ngayBatDauCS", e.target.value)}
                    />
                    {validationErrors.ngayBatDauCS && (
                      <span className="error-text">{validationErrors.ngayBatDauCS}</span>
                    )}
                  </div>

                  <div className="form-group">
                    <label>Ngày kết thúc chính sách</label>
                    <input
                      type="date"
                      value={formData.ngayKetThucCS}
                      onChange={(e) => handleInputChange("ngayKetThucCS", e.target.value)}
                      readOnly
                      style={{ backgroundColor: '#f5f5f5' }}
                    />
                    <small className="form-text">Được tính tự động từ chính sách và ngày bắt đầu</small>
                  </div>
                </>
              )}

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
