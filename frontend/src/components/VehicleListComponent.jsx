"use client"

import React, { useState, useEffect } from "react"
import "../assets/styles/VehicleListComponent.css"
import { layALLPhienGuiXe } from "../api/api"
import ParkingLotManagement from "../views/ParkingLotManagement"

const VehicleListComponent = ({ onVehicleSelect }) => {
  const [vehicles, setVehicles] = useState([])
  const [statistics, setStatistics] = useState({
    totalVehicles: 0,
    motorcycles: 0,
    cars: 0,
    totalRevenue: 0,
  })
  const [searchTerm, setSearchTerm] = useState("")
  const [filterType, setFilterType] = useState("all")
  const [sortBy, setSortBy] = useState("time_in")
  const [sortOrder, setSortOrder] = useState("desc")
  const [now, setNow] = useState(Date.now())
  
  // State for parking lot management
  const [showParkingManagement, setShowParkingManagement] = useState(false)
  const [selectedVehicleForParking, setSelectedVehicleForParking] = useState(null)

  // Load vehicle data from API
  useEffect(() => {
    async function fetchVehicles() {
      try {
        const apiData = await layALLPhienGuiXe()
        // Map API data to component format
        const mappedVehicles = (Array.isArray(apiData) ? apiData : []).map((item, idx) => ({
          id: item.maPhien || idx,
          licensePlate: item.bienSo || "",
          cardId: item.uidThe || "",
          vehicleType: item.chinhSach && item.chinhSach.toLowerCase().includes("oto") ? "oto" : "xe_may",
          timeIn: item.gioVao || null,
          timeOut: item.gioRa || null,
          duration: item.phutGui ? `${Math.floor(item.phutGui/60)}h ${item.phutGui%60}m` : "---",
          fee: item.phi || 0,
          status: item.trangThai === "DANG_GUI" ? "Trong bãi" : "Đã ra",
          zone: item.viTriGui || "",
        }))
        setVehicles(mappedVehicles)
        // Update statistics
        const motorcycles = mappedVehicles.filter(v => v.vehicleType === "xe_may" && v.status === "Trong bãi").length
        const cars = mappedVehicles.filter(v => v.vehicleType === "oto" && v.status === "Trong bãi").length
        const totalVehicles = motorcycles + cars
        const totalRevenue = mappedVehicles.reduce((sum, v) => sum + (v.fee || 0), 0)
        setStatistics({ totalVehicles, motorcycles, cars, totalRevenue })
      } catch (error) {
        setVehicles([])
        setStatistics({ totalVehicles: 0, motorcycles: 0, cars: 0, totalRevenue: 0 })
      }
    }
    fetchVehicles()
  }, [])

  // Update 'now' every second for realtime duration
  useEffect(() => {
    const timer = setInterval(() => setNow(Date.now()), 1000)
    return () => clearInterval(timer)
  }, [])

  // Update vehicle list
  const updateVehicleList = (newVehicles) => {
    setVehicles(Array.isArray(newVehicles) ? newVehicles : [])
  }

  // Update statistics
  const updateStatistics = (newStats) => {
    setStatistics(newStats)
  }

  // Filter and sort vehicles
  const filteredAndSortedVehicles = vehicles
    .filter((vehicle) => {
      const matchesSearch =
        vehicle.licensePlate.toLowerCase().includes(searchTerm.toLowerCase()) ||
        vehicle.cardId.toLowerCase().includes(searchTerm.toLowerCase())
      const matchesFilter = filterType === "all" || vehicle.vehicleType === filterType
      return matchesSearch && matchesFilter
    })
    .sort((a, b) => {
      let aValue = a[sortBy]
      let bValue = b[sortBy]

      if (sortBy === "timeIn" || sortBy === "timeOut") {
        aValue = new Date(aValue || 0)
        bValue = new Date(bValue || 0)
      }

      if (sortOrder === "asc") {
        return aValue > bValue ? 1 : -1
      } else {
        return aValue < bValue ? 1 : -1
      }
    })

  // Handle vehicle selection
  const handleVehicleSelect = (vehicle) => {
    if (onVehicleSelect) {
      onVehicleSelect(vehicle)
    }
  }

  // Handle parking management view
  const handleViewParkingSpot = (vehicle) => {
    setSelectedVehicleForParking(vehicle)
    setShowParkingManagement(true)
  }

  // Handle close parking management
  const handleCloseParkingManagement = () => {
    setShowParkingManagement(false)
    setSelectedVehicleForParking(null)
  }

  // Format time display
  const formatTime = (timeString) => {
    if (!timeString) return "---"
    try {
      const date = new Date(timeString)
      return date.toLocaleString("vi-VN", {
        day: "2-digit",
        month: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
      })
    } catch (error) {
      return timeString
    }
  }

  // Format currency
  const formatCurrency = (amount) => {
    return new Intl.NumberFormat("vi-VN").format(amount) + " VNĐ"
  }

  // Format duration (realtime for xe chưa ra, có cả giây)
  const getDuration = (vehicle) => {
    if (!vehicle.timeIn) return "---"
    if (!vehicle.timeOut) {
      // Xe chưa ra, tính realtime
      const start = new Date(vehicle.timeIn).getTime()
      const diffMs = now - start
      if (isNaN(diffMs) || diffMs < 0) return "---"
      const totalSeconds = Math.floor(diffMs / 1000)
      const hours = Math.floor(totalSeconds / 3600)
      const minutes = Math.floor((totalSeconds % 3600) / 60)
      const seconds = totalSeconds % 60
      return `${hours}h ${minutes}m ${seconds}s`
    } else {
      // Xe đã ra, lấy duration từ API hoặc tính từ timeIn/timeOut
      if (vehicle.duration && vehicle.duration !== "---") return vehicle.duration
      const start = new Date(vehicle.timeIn).getTime()
      const end = new Date(vehicle.timeOut).getTime()
      if (isNaN(start) || isNaN(end) || end < start) return "---"
      const totalSeconds = Math.floor((end - start) / 1000)
      const hours = Math.floor(totalSeconds / 3600)
      const minutes = Math.floor((totalSeconds % 3600) / 60)
      const seconds = totalSeconds % 60
      return `${hours}h ${minutes}m ${seconds}s`
    }
  }

  // Expose methods to parent component
  React.useImperativeHandle(
    React.forwardRef(() => null),
    () => ({
      updateVehicleList,
      updateStatistics,
    }),
  )

  return (
    <div className="vehicle-list-container">
      {/* Statistics Cards */}
      <div className="statistics-section">
        <div className="stat-card">
          <div className="stat-header">TỔNG XE TRONG BÃI</div>
          <div className="stat-value">{statistics.totalVehicles}</div>
        </div>
        <div className="stat-card">
          <div className="stat-header">XE MÁY</div>
          <div className="stat-value">{statistics.motorcycles}</div>
        </div>
        <div className="stat-card">
          <div className="stat-header">Ô TÔ</div>
          <div className="stat-value">{statistics.cars}</div>
        </div>
        <div className="stat-card revenue">
          <div className="stat-header">DOANH THU</div>
          <div className="stat-value">{formatCurrency(statistics.totalRevenue)}</div>
        </div>
      </div>        {/* Controls */}
        <div className="controls-section">
          <div className="search-box">
            <input
              type="text"
              placeholder="Tìm kiếm biển số hoặc mã thẻ..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="search-input"
            />
          </div>

          <div className="filter-controls">
            <select value={filterType} onChange={(e) => setFilterType(e.target.value)} className="filter-select">
              <option value="all">Tất cả loại xe</option>
              <option value="xe_may">Xe máy</option>
              <option value="oto">Ô tô</option>
            </select>

            <select value={sortBy} onChange={(e) => setSortBy(e.target.value)} className="sort-select">
              <option value="timeIn">Thời gian vào</option>
              <option value="licensePlate">Biển số</option>
              <option value="fee">Phí gửi xe</option>
              <option value="duration">Thời gian đỗ</option>
            </select>

            <button onClick={() => setSortOrder(sortOrder === "asc" ? "desc" : "asc")} className="sort-order-btn">
              {sortOrder === "asc" ? "Tăng dần" : "Giảm dần"}
            </button>
            
            <button 
              onClick={() => setShowParkingManagement(true)} 
              className="parking-management-btn"
              title="Xem sơ đồ bãi đỗ xe"
            >
              🅿️ Sơ đồ bãi đỗ
            </button>
          </div>
        </div>

      {/* Vehicle Table */}
      <div className="table-section">
        <div className="table-container">
          <table className="vehicle-table">
            <thead>
              <tr>
                <th>BIỂN SỐ</th>
                <th>MÃ THẺ</th>
                <th>LOẠI XE</th>
                <th>GIỜ VÀO</th>
                <th>GIỜ RA</th>
                <th>THỜI GIAN ĐỖ</th>
                <th>PHÍ</th>
                <th>TRẠNG THÁI</th>
                <th>KHU VỰC</th>
                <th>THAO TÁC</th>
              </tr>
            </thead>
            <tbody>
              {filteredAndSortedVehicles.length === 0 ? (
                <tr>
                  <td colSpan="10" className="no-data">
                    Không có dữ liệu
                  </td>
                </tr>
              ) : (
                filteredAndSortedVehicles.map((vehicle) => (
                  <tr key={vehicle.id} onClick={() => handleVehicleSelect(vehicle)} className="vehicle-row">
                    <td className="license-plate">{vehicle.licensePlate}</td>
                    <td className="card-id">{vehicle.cardId}</td>
                    <td className="vehicle-type">{vehicle.vehicleType === "xe_may" ? "Xe máy" : "Ô tô"}</td>
                    <td className="time-in">{formatTime(vehicle.timeIn)}</td>
                    <td className="time-out">{formatTime(vehicle.timeOut)}</td>
                    <td className="duration">{getDuration(vehicle)}</td>
                    <td className="fee">{formatCurrency(vehicle.fee)}</td>
                    <td className={`status ${vehicle.status === "Trong bãi" ? "active" : "completed"}`}>{vehicle.status}</td>
                    <td className="zone">{vehicle.zone}</td>
                    <td className="actions">
                      {vehicle.status === "Trong bãi" && (
                        <button 
                          className="view-parking-btn"
                          onClick={(e) => {
                            e.stopPropagation()
                            handleViewParkingSpot(vehicle)
                          }}
                          title="Xem vị trí đỗ xe"
                        >
                          🅿️
                        </button>
                      )}
                    </td>
                  </tr>
                ))
              )}
            </tbody>
          </table>
        </div>
      </div>
      
      {/* Parking Lot Management Modal */}
      {showParkingManagement && (
        <ParkingLotManagement 
          selectedVehicle={selectedVehicleForParking}
          onClose={handleCloseParkingManagement}
        />
      )}
    </div>
  )
}

export default VehicleListComponent
