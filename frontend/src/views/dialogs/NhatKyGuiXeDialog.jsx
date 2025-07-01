"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/dialog-base.css"
import { layNhatKyGuiXeTheoThe, layDanhSachThe } from "../../api/api"

const NhatKyGuiXeDialog = ({ onClose, initialCardId = "" }) => {
  const [cards, setCards] = useState([])
  const [selectedCard, setSelectedCard] = useState(initialCardId)
  const [selectedDate, setSelectedDate] = useState("all")
  const [logs, setLogs] = useState([])
  const [isLoading, setIsLoading] = useState(false)
  const [error, setError] = useState("")

  useEffect(() => {
    loadCards()
    if (initialCardId) {
      loadLogs(initialCardId, "all")
    }
  }, [initialCardId])

  const loadCards = async () => {
    try {
      const cardsData = await layDanhSachThe()
      setCards(Array.isArray(cardsData) ? cardsData : [])
    } catch (error) {
      setError("Không thể tải danh sách thẻ: " + error.message)
    }
  }

  const loadLogs = async (cardId, date) => {
    if (!cardId) return

    try {
      setIsLoading(true)
      setError("")
      
      const logsData = await layNhatKyGuiXeTheoThe(cardId, date)
      setLogs(Array.isArray(logsData) ? logsData : [])
    } catch (error) {
      setError("Không thể tải nhật ký: " + error.message)
      setLogs([])
    } finally {
      setIsLoading(false)
    }
  }

  const handleCardChange = (cardId) => {
    setSelectedCard(cardId)
    if (cardId) {
      loadLogs(cardId, selectedDate)
    } else {
      setLogs([])
    }
  }

  const handleDateChange = (date) => {
    setSelectedDate(date)
    if (selectedCard) {
      loadLogs(selectedCard, date)
    }
  }

  const formatDateTime = (dateTimeStr) => {
    if (!dateTimeStr) return "N/A"
    try {
      const date = new Date(dateTimeStr)
      return date.toLocaleString('vi-VN')
    } catch {
      return dateTimeStr
    }
  }

  const formatCurrency = (amount) => {
    if (!amount) return "0 đ"
    return new Intl.NumberFormat('vi-VN', { 
      style: 'currency', 
      currency: 'VND' 
    }).format(amount)
  }

  const getSelectedCardInfo = () => {
    return cards.find(card => card.uidThe === selectedCard)
  }

  const getTotalSessionsToday = () => {
    const today = new Date().toISOString().split('T')[0]
    return logs.filter(log => log.sessions?.some(session => 
      session.gioVao?.startsWith(today)
    )).length
  }

  const getTotalFee = () => {
    return logs.reduce((total, log) => {
      return total + (log.sessions?.reduce((sessionTotal, session) => {
        return sessionTotal + (session.phi || 0)
      }, 0) || 0)
    }, 0)
  }

  return (
    <div className="dialog-overlay">
      <div className="dialog-container extra-large">
        {/* Left Panel - Controls & List */}
        <div className="dialog-left-panel">
          <div className="dialog-title-bar">
            <span className="dialog-title">Nhật Ký Gửi Xe</span>
            <button className="dialog-close" onClick={onClose}>✕</button>
          </div>

          <div className="dialog-content">
            <div className="dialog-form-group">
              <label className="dialog-label">Chọn Thẻ</label>
              <select
                className="dialog-select"
                value={selectedCard}
                onChange={(e) => handleCardChange(e.target.value)}
              >
                <option value="">-- Chọn thẻ --</option>
                {cards.map((card) => (
                  <option key={card.uidThe} value={card.uidThe}>
                    {card.uidThe} - {card.loaiThe} {card.bienSoXe ? `(${card.bienSoXe})` : ""}
                  </option>
                ))}
              </select>
            </div>

            <div className="dialog-form-group">
              <label className="dialog-label">Chọn Ngày</label>
              <select
                className="dialog-select"
                value={selectedDate}
                onChange={(e) => handleDateChange(e.target.value)}
              >
                <option value="all">Tất cả</option>
                <option value={new Date().toISOString().split('T')[0].split('-').reverse().join('-')}>
                  Hôm nay
                </option>
                <option value={new Date(Date.now() - 86400000).toISOString().split('T')[0].split('-').reverse().join('-')}>
                  Hôm qua
                </option>
              </select>
            </div>

            {isLoading && (
              <div style={{ textAlign: 'center', padding: '2rem', color: '#6b7280' }}>
                Đang tải dữ liệu...
              </div>
            )}

            {!isLoading && logs.length > 0 && (
              <div style={{ maxHeight: '400px', overflowY: 'auto' }}>
                {logs.map((log, logIndex) => (
                  <div key={logIndex} className="dialog-info-card" style={{ marginBottom: '1rem' }}>
                    <div style={{ fontSize: '0.9rem', fontWeight: '600', marginBottom: '0.5rem', color: '#1f2937' }}>
                      Ngày: {log.ngay}
                    </div>
                    
                    {log.sessions && log.sessions.map((session, sessionIndex) => (
                      <div key={sessionIndex} style={{ 
                        padding: '1rem', 
                        background: '#f8fafc', 
                        borderRadius: '8px', 
                        marginBottom: '0.5rem',
                        border: '1px solid #e2e8f0'
                      }}>
                        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '0.5rem', fontSize: '0.8rem' }}>
                          <div><strong>Mã phiên:</strong> {session.maPhien}</div>
                          <div><strong>Biển số:</strong> {session.bienSo || "N/A"}</div>
                          <div><strong>Vị trí:</strong> {session.viTriGui}</div>
                          <div><strong>Trạng thái:</strong> 
                            <span style={{ 
                              color: session.trangThai === 'TRONG_BAI' ? '#059669' : '#dc2626',
                              fontWeight: '600',
                              marginLeft: '0.25rem'
                            }}>
                              {session.trangThai}
                            </span>
                          </div>
                          <div><strong>Giờ vào:</strong> {formatDateTime(session.gioVao)}</div>
                          <div><strong>Giờ ra:</strong> {formatDateTime(session.gioRa)}</div>
                          <div><strong>Thời gian:</strong> {session.tongPhut ? `${session.tongPhut} phút` : "N/A"}</div>
                          <div><strong>Phí:</strong> 
                            <span style={{ color: '#059669', fontWeight: '600', marginLeft: '0.25rem' }}>
                              {formatCurrency(session.phi)}
                            </span>
                          </div>
                        </div>
                        
                        {session.logs && session.logs.length > 0 && (
                          <div style={{ marginTop: '0.5rem' }}>
                            <div style={{ fontSize: '0.75rem', fontWeight: '600', color: '#6b7280', marginBottom: '0.25rem' }}>
                              Chi tiết quét:
                            </div>
                            {session.logs.map((scanLog, scanIndex) => (
                              <div key={scanIndex} style={{ 
                                fontSize: '0.7rem', 
                                color: '#6b7280',
                                padding: '0.25rem 0',
                                borderLeft: '2px solid #e5e7eb',
                                paddingLeft: '0.5rem',
                                marginLeft: '0.5rem'
                              }}>
                                {formatDateTime(scanLog.thoiGianQuet)} - {scanLog.tenCamera} - {scanLog.huongQuet}
                                {scanLog.khopBienSo ? " ✓" : " ✗"}
                              </div>
                            ))}
                          </div>
                        )}
                      </div>
                    ))}
                  </div>
                ))}
              </div>
            )}

            {!isLoading && selectedCard && logs.length === 0 && (
              <div style={{ textAlign: 'center', padding: '2rem', color: '#6b7280' }}>
                Không có dữ liệu nhật ký cho thẻ này
              </div>
            )}

            {error && <div className="dialog-error">{error}</div>}
          </div>

          <div className="dialog-footer">
            <button className="dialog-btn dialog-btn-secondary" onClick={onClose}>
              Đóng
            </button>
          </div>
        </div>

        {/* Right Panel - Card Info & Statistics */}
        <div className="dialog-right-panel">
          {selectedCard && (
            <>
              <div className="dialog-info-card">
                <div className="dialog-info-title">Thông Tin Thẻ</div>
                {(() => {
                  const cardInfo = getSelectedCardInfo()
                  return cardInfo ? (
                    <div style={{ fontSize: '0.85rem', lineHeight: '1.6', color: '#6b7280' }}>
                      <div><strong>UID:</strong> {cardInfo.uidThe}</div>
                      <div><strong>Loại:</strong> {cardInfo.loaiThe}</div>
                      <div><strong>Biển số:</strong> {cardInfo.bienSoXe || "Chưa có"}</div>
                      <div><strong>Chính sách:</strong> {cardInfo.maChinhSach || "Chưa có"}</div>
                      <div><strong>Trạng thái:</strong> 
                        <span style={{ 
                          color: cardInfo.trangThai === "1" ? '#059669' : '#dc2626',
                          fontWeight: '600',
                          marginLeft: '0.25rem'
                        }}>
                          {cardInfo.trangThai === "1" ? "Hoạt động" : "Tạm khóa"}
                        </span>
                      </div>
                      <div><strong>Ngày phát hành:</strong> {cardInfo.ngayPhatHanh || "N/A"}</div>
                    </div>
                  ) : (
                    <div style={{ color: '#6b7280' }}>Đang tải thông tin...</div>
                  )
                })()}
              </div>

              <div className="dialog-info-card">
                <div className="dialog-info-title">Thống Kê</div>
                <div style={{ fontSize: '0.85rem', lineHeight: '1.6', color: '#6b7280' }}>
                  <div><strong>Tổng phiên:</strong> {logs.length}</div>
                  <div><strong>Phiên hôm nay:</strong> {getTotalSessionsToday()}</div>
                  <div><strong>Tổng phí:</strong> 
                    <span style={{ color: '#059669', fontWeight: '600', marginLeft: '0.25rem' }}>
                      {formatCurrency(getTotalFee())}
                    </span>
                  </div>
                </div>
              </div>

              <div className="dialog-info-card">
                <div className="dialog-info-title">Hướng Dẫn</div>
                <div style={{ fontSize: '0.8rem', color: '#6b7280', lineHeight: '1.5' }}>
                  • Chọn thẻ để xem lịch sử gửi xe<br/>
                  • Lọc theo ngày để xem chi tiết<br/>
                  • Dữ liệu được lưu theo từng ngày<br/>
                  • Chi tiết quét camera hiển thị đường đi của xe
                </div>
              </div>
            </>
          )}

          {!selectedCard && (
            <div className="dialog-info-card">
              <div className="dialog-info-title">Chọn Thẻ</div>
              <div style={{ fontSize: '0.85rem', color: '#6b7280', textAlign: 'center', padding: '2rem' }}>
                Vui lòng chọn thẻ để xem nhật ký gửi xe
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  )
}

export default NhatKyGuiXeDialog
