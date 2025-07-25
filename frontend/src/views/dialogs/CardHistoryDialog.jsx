"use client"

import { useState, useEffect } from "react"
import "../../assets/styles/CardHistoryDialog.css"
import { layNhatKyTheoThe, getImageUrl } from "../../api/api"
import FallbackImage from "../../components/FallbackImage"

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
                      <div className="session-main-info">
                        <div className="session-id-row">
                          <span className="session-id">Phiên: {session.maPhien}</span>
                          <span className={`session-status ${getStatusClass(session.trangThai)}`}>
                            {getStatusText(session.trangThai)}
                          </span>
                        </div>
                        <div className="session-details-row">
                          <div className="detail-item">
                            <span className="detail-label">Ngày:</span>
                            <span className="detail-value">{session.ngay}</span>
                          </div>
                          <div className="detail-item">
                            <span className="detail-label">Biển số:</span>
                            <span className="detail-value">{session.bienSo || "N/A"}</span>
                          </div>
                          <div className="detail-item">
                            <span className="detail-label">Vị trí:</span>
                            <span className="detail-value">{session.viTriGui || "N/A"}</span>
                          </div>
                        </div>
                        <div className="session-time-row">
                          <div className="time-item">
                            <span className="time-label">Giờ vào:</span>
                            <span className="time-value">{formatDateTime(session.gioVao)}</span>
                          </div>
                          {session.gioRa && (
                            <div className="time-item">
                              <span className="time-label">Giờ ra:</span>
                              <span className="time-value">{formatDateTime(session.gioRa)}</span>
                            </div>
                          )}
                          {session.tongPhut && (
                            <div className="time-item">
                              <span className="time-label">Thời gian:</span>
                              <span className="time-value">{session.tongPhut} phút</span>
                            </div>
                          )}
                        </div>
                      </div>
                      <div className="session-actions">
                        {session.phi > 0 && (
                          <div className="fee-display">
                            <span className="fee-label">Phí:</span>
                            <span className="fee-value">{formatCurrency(session.phi)}</span>
                          </div>
                        )}
                        <button className="expand-button">
                          {expandedSession === session.maPhien ? "Thu gọn ▲" : "Chi tiết ▼"}
                        </button>
                      </div>
                    </div>

                    {expandedSession === session.maPhien && (
                      <div className="session-expanded">
                        <div className="session-expanded-content">
                          {/* Technical Information */}
                          <div className="expanded-section">
                            <h5 className="section-title">Thông tin kỹ thuật</h5>
                            <div className="info-grid">
                              <div className="info-item">
                                <label>Cổng vào:</label>
                                <span>{session.congVao || "N/A"}</span>
                              </div>
                              <div className="info-item">
                                <label>Cổng ra:</label>
                                <span>{session.congRa || "N/A"}</span>
                              </div>
                              <div className="info-item">
                                <label>Loại phương tiện:</label>
                                <span>{session.loaiPhuongTien || "N/A"}</span>
                              </div>
                              <div className="info-item">
                                <label>Chính sách:</label>
                                <span>{session.maChinhSach || "N/A"}</span>
                              </div>
                            </div>
                            {session.ghiChu && (
                              <div className="note-section">
                                <label>Ghi chú:</label>
                                <span>{session.ghiChu}</span>
                              </div>
                            )}
                          </div>

                          {/* Images Section */}
                          {(session.anhVao || session.anhRa) && (
                            <div className="expanded-section">
                              <h5 className="section-title">Hình ảnh gửi xe</h5>
                              <div className="main-images-grid">
                                {session.anhVao && (
                                  <div className="main-image-item">
                                    <div className="image-header">
                                      <span className="image-label">Ảnh xe vào</span>
                                      <span className="image-time">{formatDateTime(session.gioVao)}</span>
                                    </div>
                                    <div className="image-container">
                                      <FallbackImage 
                                        filename={session.anhVao} 
                                        alt="Ảnh xe vào" 
                                        className="main-session-image"
                                        placeholder={
                                          <div className="image-placeholder">
                                            <div className="placeholder-icon">📷</div>
                                            <div className="placeholder-text">Không có ảnh vào</div>
                                          </div>
                                        }
                                      />
                                    </div>
                                  </div>
                                )}
                                {session.anhRa && (
                                  <div className="main-image-item">
                                    <div className="image-header">
                                      <span className="image-label">Ảnh xe ra</span>
                                      <span className="image-time">{formatDateTime(session.gioRa)}</span>
                                    </div>
                                    <div className="image-container">
                                      <FallbackImage 
                                        filename={session.anhRa} 
                                        alt="Ảnh xe ra" 
                                        className="main-session-image"
                                        placeholder={
                                          <div className="image-placeholder">
                                            <div className="placeholder-icon">📷</div>
                                            <div className="placeholder-text">Không có ảnh ra</div>
                                          </div>
                                        }
                                      />
                                    </div>
                                  </div>
                                )}
                              </div>
                            </div>
                          )}

                          {/* Detailed Scan Logs */}
                          {session.nhatKy && session.nhatKy.length > 0 && (
                            <div className="expanded-section">
                              <h5 className="section-title">Lịch sử quét thẻ ({session.nhatKy.length} lần quét)</h5>
                              <div className="scan-logs-list">
                                {session.nhatKy.map((log, index) => (
                                  <div key={log.idNhatKy || index} className="scan-log-item">
                                    <div className="scan-log-header">
                                      <div className="scan-info">
                                        <span className="scan-time">{formatDateTime(log.thoiGianQuet)}</span>
                                        <span className="scan-camera">{log.tenCamera || `Camera ${log.maCamera}`}</span>
                                        <span className={`scan-direction ${log.huongQuet === "VAO" ? "direction-in" : "direction-out"}`}>
                                          {log.huongQuet === "VAO" ? "🔵 Vào" : "🔴 Ra"}
                                        </span>
                                        <span className={`scan-match ${log.khopBienSo ? "match-yes" : "match-no"}`}>
                                          {log.khopBienSo ? "✅ Khớp biển số" : "❌ Không khớp"}
                                        </span>
                                      </div>
                                    </div>
                                    {log.anhQuet && (
                                      <div className="scan-image-container">
                                        <FallbackImage 
                                          filename={log.anhQuet} 
                                          alt={`Ảnh quét lần ${index + 1}`}
                                          className="scan-log-image"
                                          placeholder={
                                            <div className="scan-image-placeholder">
                                              <span>🚫</span>
                                              <span>Không tải được ảnh</span>
                                            </div>
                                          }
                                        />
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
