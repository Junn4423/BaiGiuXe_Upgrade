"use client"

import React, { useState, useEffect } from "react"
import "../assets/styles/VehicleListComponent.css"

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

  // Mock data for demonstration
  useEffect(() => {
    const mockVehicles = [
      {
        id: 1,
        licensePlate: "29A-12345",
        cardId: "CARD001",
        vehicleType: "xe_may",
        timeIn: "2024-01-15 08:30:00",
        timeOut: null,
        duration: "2h 30m",
        fee: 15000,
        status: "Trong bãi",
        zone: "Khu A",
      },
      {
        id: 2,
        licensePlate: "30B-67890",
        cardId: "CARD002",
        vehicleType: "oto",
        timeIn: "2024-01-15 09:15:00",
        timeOut: null,
        duration: "1h 45m",
        fee: 25000,
        status: "Trong bãi",
        zone: "Khu B",
      },
      {
        id: 3,
        licensePlate: "51C-11111",
        cardId: "CARD003",
        vehicleType: "xe_may",
        timeIn: "2024-01-15 07:00:00",
        timeOut: "2024-01-15 10:30:00",
        duration: "3h 30m",
        fee: 20000,
        status: "Đã ra",
        zone: "Khu A",
      },
    ]
    setVehicles(mockVehicles)
    setStatistics({
      totalVehicles: 2,
      motorcycles: 1,
      cars: 1,
      totalRevenue: 40000,
    })
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
      </div>

      {/* Controls */}
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
              </tr>
            </thead>
            <tbody>
              {filteredAndSortedVehicles.length === 0 ? (
                <tr>
                  <td colSpan="9" className="no-data">
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
                    <td className="duration">{vehicle.duration}</td>
                    <td className="fee">{formatCurrency(vehicle.fee)}</td>
                    <td className={`status ${vehicle.status === "Trong bãi" ? "active" : "completed"}`}>
                      {vehicle.status}
                    </td>
                    <td className="zone">{vehicle.zone}</td>
                  </tr>
                ))
              )}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  )
}

export default VehicleListComponent
