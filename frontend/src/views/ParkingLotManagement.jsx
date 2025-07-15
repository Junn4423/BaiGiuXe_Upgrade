"use client"

import React, { useState, useEffect } from "react"
import "../assets/styles/ParkingLotManagement.css"
import { 
  layALLPhienGuiXe, 
  layPhienGuiXeCoViTri,
  layDanhSachKhuVuc, 
  layDanhSachChoDo,
  layChoDauXeTheoKhu,
  dongBoTrangThaiChoDo,
  capNhatTrangThaiChoDo,
  themChoDo,
  capNhatChoDo,
  xoaChoDo
} from "../api/api"

const ParkingLotManagement = ({ selectedVehicle, onClose }) => {
  const [areas, setAreas] = useState([])
  const [parkingSpots, setParkingSpots] = useState([])
  const [sessions, setSessions] = useState([])
  const [selectedArea, setSelectedArea] = useState("")
  const [selectedSpot, setSelectedSpot] = useState(null)
  const [isDialogOpen, setIsDialogOpen] = useState(false)
  const [filterStatus, setFilterStatus] = useState("all")
  const [searchTerm, setSearchTerm] = useState("")
  const [editMode, setEditMode] = useState("view")
  const [loading, setLoading] = useState(false)

  useEffect(() => {
    loadInitialData()
  }, [])

  useEffect(() => {
    if (selectedVehicle) {
      // Tự động tìm vị trí đỗ của xe được chọn
      const spotForVehicle = parkingSpots.find(spot => spot.licensePlate === selectedVehicle.licensePlate)
      if (spotForVehicle) {
        setSelectedSpot(spotForVehicle)
        setSelectedArea(spotForVehicle.area)
        setIsDialogOpen(true)
      }
    }
  }, [selectedVehicle, parkingSpots])

  const loadInitialData = async () => {
    try {
      setLoading(true)
      
      // Load areas first
      const areasData = await layDanhSachKhuVuc()
      console.log("Areas loaded:", areasData)
      setAreas(areasData || [])
      
      // Load all parking spots from pm_nc0005
      const spotsData = await layDanhSachChoDo()
      console.log("Parking spots loaded:", spotsData)
      
      // Load active parking sessions from pm_nc0009
      const sessionsData = await layALLPhienGuiXe()
      console.log("Sessions loaded:", sessionsData)
      setSessions(sessionsData || [])
      
      // Transform spots data to match UI format
      const transformedSpots = transformParkingSpotsData(areasData, spotsData, sessionsData)
      setParkingSpots(transformedSpots)
      
      // Set default selected area
      if (areasData && areasData.length > 0) {
        setSelectedArea(areasData[0].maKhuVuc)
      }
      
    } catch (error) {
      console.error("Error loading parking data:", error)
    } finally {
      setLoading(false)
    }
  }

  const transformParkingSpotsData = (areas, spots, sessions) => {
    const transformedSpots = []
    
    // Create area name mapping
    const areaMap = {}
    areas.forEach(area => {
      areaMap[area.maKhuVuc] = area.tenKhuVuc
    })
    
    // Transform spots from pm_nc0005 format
    spots.forEach(spot => {
      const spotData = {
        id: spot.maChoDo,
        position: spot.maChoDo,
        area: spot.maKhuVuc,
        areaName: spot.tenKhuVuc || areaMap[spot.maKhuVuc] || spot.maKhuVuc,
        status: spot.trangThai === "1" ? "occupied" : "available"
      }
      
      // Find corresponding session for this spot
      const activeSession = sessions.find(session => 
        session.viTriGui === spot.maChoDo && 
        session.trangThai === "DANG_GUI"
      )
      
      if (activeSession) {
        spotData.status = "occupied"
        spotData.licensePlate = activeSession.bienSo
        spotData.cardId = activeSession.uidThe
        spotData.customerName = `Khách hàng ${activeSession.uidThe}`
        spotData.entryTime = activeSession.gioVao
        spotData.sessionId = activeSession.maPhien
        
        // Determine vehicle type from policy
        if (activeSession.chinhSach) {
          spotData.vehicleType = activeSession.chinhSach.toLowerCase().includes("oto") ? "oto" : "xe_may"
        }
      }
      
      transformedSpots.push(spotData)
    })
    
    console.log("Transformed spots:", transformedSpots)
    return transformedSpots
  }

  const generateParkingSpotsFromData = (areas, spots, sessions) => {
    const generatedSpots = []
    
    // Tạo spots từ database hoặc tạo mặc định
    areas.forEach(area => {
      const areaSpots = spots.filter(spot => spot.maKhuVuc === area.maKhuVuc)
      
      // Nếu không có spots được định nghĩa, tạo spots mặc định
      if (areaSpots.length === 0) {
        const defaultSpotCount = 50 // Mặc định 50 spots mỗi khu vực
        for (let i = 1; i <= defaultSpotCount; i++) {
          const spotId = `${area.maKhuVuc}-${i.toString().padStart(2, '0')}`
          generatedSpots.push({
            id: spotId,
            position: `${area.tenKhuVuc}-${i.toString().padStart(2, '0')}`,
            status: "available",
            area: area.maKhuVuc,
            areaName: area.tenKhuVuc
          })
        }
      } else {
        // Sử dụng spots từ database
        areaSpots.forEach(spot => {
          generatedSpots.push({
            id: spot.maChoDo,
            position: spot.maChoDo,
            status: spot.trangThai === "TRONG" ? "available" : "occupied",
            area: spot.maKhuVuc,
            areaName: area.tenKhuVuc
          })
        })
      }
    })
    
    // Map sessions to parking spots
    sessions.forEach(session => {
      if (session.trangThai === "TRONG_BAI" && session.viTriGui) {
        // Tìm spot tương ứng với vị trí đỗ (lv004 trong pm_nc0009)
        const spotIndex = generatedSpots.findIndex(spot => 
          spot.position.includes(session.viTriGui) || 
          spot.id === session.viTriGui
        )
        
        if (spotIndex !== -1) {
          generatedSpots[spotIndex] = {
            ...generatedSpots[spotIndex],
            status: "occupied",
            licensePlate: session.bienSo,
            cardId: session.uidThe,
            customerName: `Khách hàng ${session.uidThe}`,
            entryTime: session.gioVao,
            sessionId: session.maPhien,
            vehicleType: session.chinhSach?.toLowerCase().includes("oto") ? "oto" : "xe_may"
          }
        }
      }
    })
    
    return generatedSpots
  }

  const getSpotColor = (status) => {
    switch (status) {
      case "occupied":
        return "occupied"
      case "reserved":
        return "reserved"
      case "available":
        return "available"
      default:
        return "unavailable"
    }
  }

  const getStatusText = (status) => {
    switch (status) {
      case "occupied":
        return "Đang đỗ"
      case "reserved":
        return "Đã đặt"
      case "available":
        return "Trống"
      default:
        return "Không khả dụng"
    }
  }

  const handleSpotClick = (spot) => {
    setSelectedSpot(spot)
    setEditMode("view")
    setIsDialogOpen(true)
  }

  const handleReleaseSpot = async () => {
    if (!selectedSpot) return

    if (!window.confirm(`Bạn có chắc muốn giải phóng vị trí ${selectedSpot.position}?`)) {
      return
    }

    try {
      setLoading(true)
      
      // Update spot status to available (0)
      const result = await capNhatTrangThaiChoDo(selectedSpot.id, "0")
      
      if (result && result.success) {
        // Sync database status
        await dongBoTrangThaiChoDo()
        
        // Reload all data to ensure sync
        await loadInitialData()
        
        setIsDialogOpen(false)
        alert("Đã giải phóng vị trí thành công!")
      } else {
        throw new Error(result?.message || "Không thể giải phóng vị trí")
      }
      
    } catch (error) {
      console.error("Error releasing spot:", error)
      alert("Lỗi giải phóng vị trí: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const handleSyncStatus = async () => {
    try {
      setLoading(true)
      
      const result = await dongBoTrangThaiChoDo()
      
      if (result && result.success) {
        console.log("Sync result:", result)
        await loadInitialData()
        alert(`Đồng bộ thành công!\n${result.message}`)
      } else {
        throw new Error(result?.message || "Không thể đồng bộ")
      }
      
    } catch (error) {
      console.error("Error syncing status:", error)
      alert("Lỗi đồng bộ: " + error.message)
    } finally {
      setLoading(false)
    }
  }

  const getAreaStats = () => {
    const areaSpots = parkingSpots.filter(spot => spot.area === selectedArea)
    const occupied = areaSpots.filter(spot => spot.status === "occupied").length
    const available = areaSpots.filter(spot => spot.status === "available").length

    return { occupied, available, total: areaSpots.length }
  }

  const filteredSpots = parkingSpots
    .filter(spot => spot.area === selectedArea)
    .filter(spot => {
      if (filterStatus === "all") return true
      return spot.status === filterStatus
    })
    .filter(spot => {
      if (!searchTerm) return true
      return (
        spot.position.toLowerCase().includes(searchTerm.toLowerCase()) ||
        spot.licensePlate?.toLowerCase().includes(searchTerm.toLowerCase()) ||
        spot.customerName?.toLowerCase().includes(searchTerm.toLowerCase())
      )
    })

  const stats = getAreaStats()
  const currentArea = areas.find(area => area.maKhuVuc === selectedArea)

  return (
    <div className="parking-lot-management">
      <div className="management-container">
        {/* Header */}
        <div className="management-header">
          <div className="header-title">
            <h1>Quản lý bãi đỗ xe</h1>
            <p>Hệ thống quản lý vị trí đỗ xe ô tô</p>
          </div>
          <div className="header-actions">
            <button 
              className="sync-btn"
              onClick={handleSyncStatus}
              disabled={loading}
              title="Đồng bộ trạng thái chỗ đỗ"
            >
              ↻ Đồng bộ
            </button>
            <div className="current-time">
              {new Date().toLocaleString("vi-VN")}
            </div>
            <button className="close-btn" onClick={onClose}>
              ✕
            </button>
          </div>
        </div>

        {/* Controls */}
        <div className="management-controls">
          <div className="controls-row">
            {/* Area Selection */}
            <div className="control-group">
              <label>Khu vực:</label>
              <select 
                value={selectedArea} 
                onChange={(e) => setSelectedArea(e.target.value)}
                className="area-select"
              >
                {areas.map(area => (
                  <option key={area.maKhuVuc} value={area.maKhuVuc}>
                    {area.tenKhuVuc}
                  </option>
                ))}
              </select>
            </div>

            {/* Status Filter */}
            <div className="control-group">
              <label>Trạng thái:</label>
              <select 
                value={filterStatus} 
                onChange={(e) => setFilterStatus(e.target.value)}
                className="status-filter"
              >
                <option value="all">Tất cả</option>
                <option value="available">Trống</option>
                <option value="occupied">Đang đỗ</option>
                <option value="reserved">Đã đặt</option>
              </select>
            </div>

            {/* Search */}
            <div className="control-group">
              <label>Tìm kiếm:</label>
              <input
                type="text"
                placeholder="Tìm kiếm vị trí, biển số..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="search-input"
              />
            </div>
          </div>
        </div>

        {/* Statistics */}
        <div className="stats-grid">
          <div className="stat-card">
            <div className="stat-content">
              <div className="stat-info">
                <span className="stat-label">Tổng vị trí</span>
                <span className="stat-value">{stats.total}</span>
              </div>
              <div className="stat-icon"></div>
            </div>
          </div>

          <div className="stat-card occupied">
            <div className="stat-content">
              <div className="stat-info">
                <span className="stat-label">Đang đỗ</span>
                <span className="stat-value">{stats.occupied}</span>
              </div>
              <div className="stat-indicator occupied"></div>
            </div>
          </div>

          <div className="stat-card available">
            <div className="stat-content">
              <div className="stat-info">
                <span className="stat-label">Trống</span>
                <span className="stat-value">{stats.available}</span>
              </div>
              <div className="stat-indicator available"></div>
            </div>
          </div>

          <div className="stat-card">
            <div className="stat-content">
              <div className="stat-info">
                <span className="stat-label">Tỉ lệ sử dụng</span>
                <span className="stat-value">{stats.total > 0 ? Math.round((stats.occupied / stats.total) * 100) : 0}%</span>
              </div>
              <div className="stat-icon"></div>
            </div>
          </div>
        </div>

        {/* Parking Grid */}
        <div className="parking-grid-container">
          <div className="grid-header">
            <h3>{currentArea?.tenKhuVuc || "Khu vực"} - Sơ đồ bãi đỗ xe</h3>
          </div>
          
          <div className="parking-grid">
            {loading ? (
              <div className="loading-state">
                <div className="loading-spinner"></div>
                <p>Đang tải sơ đồ bãi đỗ xe...</p>
              </div>
            ) : (
              <div className="parking-layout">
                {/* Entrance/Exit Labels */}
                <div className="layout-labels">
                  <div className="entrance-label">Lối vào</div>
                  <div className="exit-label">Lối ra</div>
                </div>

                {/* Main Parking Spots Grid */}
                <div className="spots-grid">
                  {filteredSpots.map(spot => (
                    <div
                      key={spot.id}
                      className={`parking-spot ${getSpotColor(spot.status)}`}
                      onClick={() => handleSpotClick(spot)}
                      title={`${spot.position} - ${getStatusText(spot.status)}${spot.licensePlate ? ` - ${spot.licensePlate}` : ""}`}
                    >
                      <div className="spot-icon">
                        {spot.status === "occupied" && ""}
                        {spot.status === "reserved" && ""}
                      </div>
                      <div className="spot-number">
                        {spot.position.split("-").pop()}
                      </div>
                      {spot.licensePlate && (
                        <div className="spot-license">
                          {spot.licensePlate.split("-").pop()}
                        </div>
                      )}
                    </div>
                  ))}
                </div>

                {/* Legend */}
                <div className="parking-legend">
                  <div className="legend-item">
                    <div className="legend-color available"></div>
                    <span>Trống ({stats.available})</span>
                  </div>
                  <div className="legend-item">
                    <div className="legend-color occupied"></div>
                    <span>Đang đỗ ({stats.occupied})</span>
                  </div>
                </div>
              </div>
            )}
          </div>
        </div>

        {/* Spot Details Dialog */}
        {isDialogOpen && selectedSpot && (
          <div className="dialog-overlay">
            <div className="spot-dialog">
              <div className="dialog-header">
                <h3>Thông tin vị trí {selectedSpot.position}</h3>
                <button 
                  className="dialog-close"
                  onClick={() => setIsDialogOpen(false)}
                >
                  ✕
                </button>
              </div>

              <div className="dialog-content">
                {/* Status Badge */}
                <div className="spot-status-info">
                  <div className={`status-badge ${selectedSpot.status}`}>
                    {getStatusText(selectedSpot.status)}
                  </div>
                  <span className="spot-position">Vị trí: {selectedSpot.position}</span>
                </div>

                {/* Spot Information */}
                <div className="spot-details">
                  <div className="detail-grid">
                    <div className="detail-item">
                      <label>Biển số xe:</label>
                      <span>{selectedSpot.licensePlate || "Chưa có"}</span>
                    </div>
                    <div className="detail-item">
                      <label>Mã thẻ:</label>
                      <span>{selectedSpot.cardId || "Chưa có"}</span>
                    </div>
                    <div className="detail-item">
                      <label>Loại xe:</label>
                      <span>{selectedSpot.vehicleType === "oto" ? "Ô tô" : "Xe máy"}</span>
                    </div>
                    <div className="detail-item">
                      <label>Thời gian vào:</label>
                      <span>{selectedSpot.entryTime ? new Date(selectedSpot.entryTime).toLocaleString("vi-VN") : "Chưa có"}</span>
                    </div>
                    <div className="detail-item">
                      <label>Khu vực:</label>
                      <span>{selectedSpot.areaName}</span>
                    </div>
                    <div className="detail-item">
                      <label>Mã phiên:</label>
                      <span>{selectedSpot.sessionId || "Chưa có"}</span>
                    </div>
                  </div>
                </div>

                {/* Action Buttons */}
                <div className="dialog-actions">
                  {selectedSpot.status === "occupied" && (
                    <button 
                      className="release-btn"
                      onClick={handleReleaseSpot}
                      disabled={loading}
                    >
                      {loading ? "Đang xử lý..." : "Giải phóng vị trí"}
                    </button>
                  )}
                  
                  <button 
                    className="close-dialog-btn"
                    onClick={() => setIsDialogOpen(false)}
                  >
                    Đóng
                  </button>
                </div>
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  )
}

export default ParkingLotManagement
