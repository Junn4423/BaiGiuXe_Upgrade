"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/CardHistoryDialog.css"
import { layNhatKyTheoThe } from "../../api/api"

const CardHistoryDialog = ({ cardId, onClose }) => {
  const [history, setHistory] = useState([])
  const [loading, setLoading] = useState(false)
  const [selectedDate, setSelectedDate] = useState("")
  const [showAllDates, setShowAllDates] = useState(true)
  const [expandedSession, setExpandedSession] = useState(null)

  useEffect(() => {
    if (cardId) {
      loadHistory()
    }
  }, [cardId, selectedDate, showAllDates])

  const loadHistory = async () => {
    try {
      setLoading(true)
      let dateParam = null
      
      if (!showAllDates && selectedDate) {
        // Convert from yyyy-mm-dd to dd-mm-yyyy for API
        const [year, month, day] = selectedDate.split('-')
        dateParam = `${day}-${month}-${year}`
      }
      
      const result = await layNhatKyTheoThe(cardId, dateParam)
      
      if (result && result.success) {
        setHistory(result.data || [])
      } else {
        console.error("Error loading history:", result?.message)
        setHistory([])
      }
    } catch (error) {
      console.error("Error loading card history:", error)
      alert("Lỗi tải nhật ký: " + error.message)
      setHistory([])
    } finally {
      setLoading(false)
    }
  }

  const handleDateChange = (e) => {
    setSelectedDate(e.target.value)
    setShowAllDates(false)
  }

  const handleShowAllDates = () => {
    setShowAllDates(true)
    setSelectedDate("")
  }

  const formatDateTime = (dateTime) => {
    if (!dateTime) return "N/A"
    return new Date(dateTime).toLocaleString("vi-VN")
  }

  const formatCurrency = (amount) => {
    if (!amount) return "0 ₫"
    return new Intl.NumberFormat("vi-VN", {
      style: "currency",
      currency: "VND"
    }).format(amount)
  }

  const getStatusText = (status) => {
    switch (status) {
      case "1": return "Đã vào"
      case "2": return "Đã ra"
      case "0": return "Chờ xử lý"
      default: return "Không xác định"
    }
  }

  const getStatusClass = (status) => {
    switch (status) {
      case "1": return "status-in"
      case "2": return "status-out"
      case "0": return "status-pending"
      default: return "status-unknown"
    }
  }

  const toggleSessionDetails = (sessionId) => {
    setExpandedSession(expandedSession === sessionId ? null : sessionId)
  }

  return (
    <div className="dialog-overlay">
      <div className="card-history-dialog">
        <div className="dialog-header">
          <h2>Nhật Ký Thẻ: {cardId}</h2>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="dialog-content">
          {/* Date filter */}
          <div className="filter-section">
            <div className="date-filter">
              <div className="date-filter-group">
                <label>
                  <input
                    type="radio"
                    name="dateFilter"
                    checked={showAllDates}
                    onChange={handleShowAllDates}
                  />
                  Tất cả ngày
                </label>
                <label>
                  <input
                    type="radio"
                    name="dateFilter"
                    checked={!showAllDates}
                    onChange={() => setShowAllDates(false)}
                  />
                  Chọn ngày cụ thể:
                </label>
                <input
                  type="date"
                  value={selectedDate}
                  onChange={handleDateChange}
                  className="date-input"
                  disabled={showAllDates}
                />
              </div>
            </div>

            <button className="refresh-button" onClick={loadHistory} disabled={loading}>
              ↻ Làm mới
            </button>
          </div>

          {/* History list */}
          <div className="history-list">
            {loading ? (
              <div className="loading">Đang tải nhật ký...</div>
            ) : history.length === 0 ? (
              <div className="no-data">
                Không có dữ liệu nhật ký cho thẻ này
              </div>
            ) : (
              <div className="sessions-list">
                {history.map((session) => (
                  <div key={session.maPhien} className="session-card">
                    <div className="session-header" onClick={() => toggleSessionDetails(session.maPhien)}>
                      <div className="session-info">
                        <div className="session-title">
                          <span className="session-id">Phiên: {session.maPhien}</span>
                          <span className="session-date">{session.ngay}</span>
                        </div>
                        <div className="session-details">
                          <span className="license-plate">Biển số: {session.bienSo || "N/A"}</span>
                          <span className="parking-spot">Vị trí: {session.viTriGui || "N/A"}</span>
                          <span className={`session-status ${getStatusClass(session.trangThai)}`}>
                            {getStatusText(session.trangThai)}
                          </span>
                        </div>
                      </div>
                      <div className="session-summary">
                        <div className="time-info">
                          <div>Vào: {formatDateTime(session.gioVao)}</div>
                          {session.gioRa && <div>Ra: {formatDateTime(session.gioRa)}</div>}
                        </div>
                        <div className="fee-info">
                          {session.phi > 0 && (
                            <span className="fee">{formatCurrency(session.phi)}</span>
                          )}
                        </div>
                        <button className="expand-button">
                          {expandedSession === session.maPhien ? "▼" : "▶"}
                        </button>
                      </div>
                    </div>

                    {expandedSession === session.maPhien && (
                      <div className="session-expanded">
                        <div className="session-expanded-content">
                          <div className="session-row">
                            <div className="info-group">
                              <label>Cổng vào:</label>
                              <span>{session.congVao || "N/A"}</span>
                            </div>
                            <div className="info-group">
                              <label>Cổng ra:</label>
                              <span>{session.congRa || "N/A"}</span>
                            </div>
                            <div className="info-group">
                              <label>Thời gian gửi:</label>
                              <span>{session.tongPhut ? `${session.tongPhut} phút` : "N/A"}</span>
                            </div>
                          </div>

                          <div className="session-row">
                            <div className="info-group">
                              <label>Loại phương tiện:</label>
                              <span>{session.loaiPhuongTien || "N/A"}</span>
                            </div>
                            <div className="info-group">
                              <label>Chính sách:</label>
                              <span>{session.maChinhSach || "N/A"}</span>
                            </div>
                          </div>

                          {session.ghiChu && (
                            <div className="session-row">
                              <div className="info-group full-width">
                                <label>Ghi chú:</label>
                                <span>{session.ghiChu}</span>
                              </div>
                            </div>
                          )}

                          {/* Images */}
                          {(session.anhVao || session.anhRa) && (
                            <div className="images-section">
                              <h4>Hình ảnh:</h4>
                              <div className="images-row">
                                {session.anhVao && (
                                  <div className="image-item">
                                    <label>Ảnh vào:</label>
                                    <img src={session.anhVao} alt="Ảnh vào" className="session-image" />
                                  </div>
                                )}
                                {session.anhRa && (
                                  <div className="image-item">
                                    <label>Ảnh ra:</label>
                                    <img src={session.anhRa} alt="Ảnh ra" className="session-image" />
                                  </div>
                                )}
                              </div>
                            </div>
                          )}

                          {/* Detailed logs */}
                          {session.nhatKy && session.nhatKy.length > 0 && (
                            <div className="logs-section">
                              <h4>Chi tiết quét:</h4>
                              <div className="logs-list">
                                {session.nhatKy.map((log) => (
                                  <div key={log.idNhatKy} className="log-item">
                                    <div className="log-time">
                                      {formatDateTime(log.thoiGianQuet)}
                                    </div>
                                    <div className="log-camera">
                                      {log.tenCamera || `Camera ${log.maCamera}`}
                                    </div>
                                    <div className="log-direction">
                                      {log.huongQuet === "VAO" ? "🔵 Vào" : "🔴 Ra"}
                                    </div>
                                    <div className="log-match">
                                      {log.khopBienSo ? "Khớp biển số" : "Không khớp"}
                                    </div>
                                    {log.anhQuet && (
                                      <div className="log-image">
                                        <img src={log.anhQuet} alt="Ảnh quét" className="log-scan-image" />
                                      </div>
                                    )}
                                  </div>
                                ))}
                              </div>
                            </div>
                          )}
                        </div>
                      </div>
                    )}
                  </div>
                ))}
              </div>
            )}
          </div>

          {/* Summary */}
          {history.length > 0 && (
            <div className="summary-section">
              <div className="summary-item">
                <span className="summary-label">Tổng số phiên:</span>
                <span className="summary-value">{history.length}</span>
              </div>
              <div className="summary-item">
                <span className="summary-label">Đã hoàn thành:</span>
                <span className="summary-value">
                  {history.filter(s => s.trangThai === "2").length}
                </span>
              </div>
              <div className="summary-item">
                <span className="summary-label">Tổng phí:</span>
                <span className="summary-value">
                  {formatCurrency(history.reduce((sum, s) => sum + (s.phi || 0), 0))}
                </span>
              </div>
            </div>
          )}
        </div>

        <div className="dialog-footer">
          <button className="close-button" onClick={onClose}>
            Đóng
          </button>
        </div>
      </div>
    </div>
  )
}

export default CardHistoryDialog
