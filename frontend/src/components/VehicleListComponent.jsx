"use client"

import React, { useState, useEffect } from "react"
import "../assets/styles/VehicleListComponent.css"
import { layALLPhienGuiXe, layALLLoaiPhuongTien } from "../api/api"
import ParkingLotManagement from "../views/ParkingLotManagement"

const VehicleListComponent = ({ onVehicleSelect, workConfig }) => {
  const [vehicles, setVehicles] = useState([])
  const [statistics, setStatistics] = useState({
    totalVehicles: 0,
    motorcycles: 0,
    cars: 0,
    totalRevenue: 0,
  })
  const [searchTerm, setSearchTerm] = useState("")
  const [filterType, setFilterType] = useState("all")
  const [filterStatus, setFilterStatus] = useState("all") // Add status filter
  const [sortBy, setSortBy] = useState("timeIn")
  const [sortOrder, setSortOrder] = useState("desc")
  const [now, setNow] = useState(Date.now())
  const [lastUpdated, setLastUpdated] = useState(null)
  const [isRefreshing, setIsRefreshing] = useState(false)
  
  // State for parking lot management
  const [showParkingManagement, setShowParkingManagement] = useState(false)
  const [selectedVehicleForParking, setSelectedVehicleForParking] = useState(null)

  // State for vehicle type mapping
  const [vehicleTypeMapping, setVehicleTypeMapping] = useState(new Map())
  const [availableVehicleTypes, setAvailableVehicleTypes] = useState([])

  // Load vehicle type mapping from API
  const loadVehicleTypeMapping = async () => {
    try {
      console.log('🔄 Loading vehicle type mapping from API...')
      const vehicleTypes = await layALLLoaiPhuongTien()
      
      if (Array.isArray(vehicleTypes)) {
        const mapping = new Map()
        const typesList = []
        
        vehicleTypes.forEach(type => {
          const maLoaiPT = type.maLoaiPT
          const tenLoaiPT = type.tenLoaiPT
          const loaiXe = type.loaiXe // 0 = xe nhỏ, 1 = xe lớn
          
          mapping.set(maLoaiPT, {
            name: tenLoaiPT,
            loaiXe: loaiXe,
            isLargeVehicle: loaiXe === 1 || loaiXe === "1"
          })
          
          typesList.push({
            code: maLoaiPT,
            name: tenLoaiPT,
            loaiXe: loaiXe
          })
        })
        
        setVehicleTypeMapping(mapping)
        setAvailableVehicleTypes(typesList)
        
        console.log('✅ Vehicle type mapping loaded:', {
          totalTypes: vehicleTypes.length,
          mapping: Object.fromEntries(mapping),
          typesList
        })
      }
    } catch (error) {
      console.error('❌ Error loading vehicle type mapping:', error)
      // Fallback to basic mapping
      const fallbackMapping = new Map([
        ['XE_MAY', { name: 'Xe máy', loaiXe: 0, isLargeVehicle: false }],
        ['OT', { name: 'Ô tô', loaiXe: 1, isLargeVehicle: true }],
        ['XE_BUS', { name: 'Xe bus', loaiXe: 1, isLargeVehicle: true }],
        ['XE_16CHO', { name: 'Xe 16 chỗ', loaiXe: 1, isLargeVehicle: true }],
        ['XE_12CHO', { name: 'Xe 12 chỗ', loaiXe: 1, isLargeVehicle: true }]
      ])
      setVehicleTypeMapping(fallbackMapping)
      console.log('⚠️ Using fallback vehicle type mapping')
    }
  }

  // Helper function to determine vehicle type from various sources
  const determineVehicleType = (item) => {
    let vehicleTypeCode = null
    let vehicleTypeName = "Xe máy" // default fallback
    let isLargeVehicle = false

    // Bước 1: Ưu tiên loaiXe từ database nếu nó là mã loại phương tiện
    if (item.loaiXe && typeof item.loaiXe === 'string' && vehicleTypeMapping.has(item.loaiXe)) {
      vehicleTypeCode = item.loaiXe
      const typeInfo = vehicleTypeMapping.get(vehicleTypeCode)
      vehicleTypeName = typeInfo.name
      isLargeVehicle = typeInfo.isLargeVehicle
      console.log(`🚗 Vehicle ${item.bienSo}: Từ loaiXe DB = ${vehicleTypeCode} -> ${vehicleTypeName}`)
    }
    // Bước 2: Nếu loaiXe là số (0/1), mapping theo cách cũ nhưng ưu tiên xe lớn từ policy
    else if (item.loaiXe !== undefined && item.loaiXe !== null) {
      if (item.loaiXe === 1 || item.loaiXe === "1") {
        // Kiểm tra policy để xác định loại xe lớn cụ thể
        if (item.chinhSach) {
          vehicleTypeCode = extractVehicleTypeFromPolicy(item.chinhSach)
          if (vehicleTypeCode && vehicleTypeMapping.has(vehicleTypeCode)) {
            const typeInfo = vehicleTypeMapping.get(vehicleTypeCode)
            vehicleTypeName = typeInfo.name
            isLargeVehicle = typeInfo.isLargeVehicle
            console.log(`🚗 Vehicle ${item.bienSo}: loaiXe=1 + policy ${item.chinhSach} -> ${vehicleTypeName}`)
          } else {
            vehicleTypeName = "Ô tô"
            isLargeVehicle = true
            console.log(`🚗 Vehicle ${item.bienSo}: loaiXe=1 fallback -> Ô tô`)
          }
        } else {
          vehicleTypeName = "Ô tô"
          isLargeVehicle = true
          console.log(`🚗 Vehicle ${item.bienSo}: loaiXe=1 -> Ô tô`)
        }
      } else if (item.loaiXe === 0 || item.loaiXe === "0") {
        vehicleTypeName = "Xe máy"
        isLargeVehicle = false
        console.log(`🏍️ Vehicle ${item.bienSo}: loaiXe=0 -> Xe máy`)
      }
    }
    // Bước 3: Fallback - parse từ policy name
    else if (item.chinhSach) {
      vehicleTypeCode = extractVehicleTypeFromPolicy(item.chinhSach)
      if (vehicleTypeCode && vehicleTypeMapping.has(vehicleTypeCode)) {
        const typeInfo = vehicleTypeMapping.get(vehicleTypeCode)
        vehicleTypeName = typeInfo.name
        isLargeVehicle = typeInfo.isLargeVehicle
        console.log(`🚗 Vehicle ${item.bienSo}: Từ policy ${item.chinhSach} -> ${vehicleTypeName}`)
      } else {
        // Fallback detection từ policy name
        if (item.chinhSach.toLowerCase().includes("oto") || 
            item.chinhSach.toLowerCase().includes("car") ||
            item.chinhSach.toLowerCase().includes("auto")) {
          vehicleTypeName = "Ô tô"
          isLargeVehicle = true
        } else {
          vehicleTypeName = "Xe máy"
          isLargeVehicle = false
        }
        console.log(`🔍 Vehicle ${item.bienSo}: Policy fallback ${item.chinhSach} -> ${vehicleTypeName}`)
      }
    }
    // Bước 4: CHỈ KHI TẠO MỚI - dùng workConfig
    else if (workConfig?.vehicle_type && item.trangThai === "DANG_GUI") {
      if (workConfig.vehicle_type === "oto") {
        vehicleTypeName = "Ô tô"
        isLargeVehicle = true
        console.log(`🚗 Vehicle ${item.bienSo}: Xe mới từ workConfig -> Ô tô`)
      } else if (workConfig.vehicle_type === "xe_may") {
        vehicleTypeName = "Xe máy"
        isLargeVehicle = false
        console.log(`🏍️ Vehicle ${item.bienSo}: Xe mới từ workConfig -> Xe máy`)
      }
    }

    return {
      code: vehicleTypeCode,
      name: vehicleTypeName,
      isLargeVehicle: isLargeVehicle,
      // For backward compatibility
      vehicleType: isLargeVehicle ? "oto" : "xe_may"
    }
  }

  // Helper function to extract vehicle type code from policy name
  const extractVehicleTypeFromPolicy = (policyName) => {
    if (!policyName) return null
    
    // Parse pattern: CS_[VEHICLE_TYPE]_[TIME]
    // Examples: CS_XE_BUS_10N, CS_XE_16CHO_4H, CS_OTO_4H, CS_XEMAY_4H
    const match = policyName.match(/^CS_(.+?)_\d+[HN]?$/i)
    if (match) {
      let vehicleType = match[1].toUpperCase()
      
      // Handle special cases and aliases
      if (vehicleType === 'XEMAY') {
        vehicleType = 'XE_MAY'
      } else if (vehicleType === 'OTO') {
        vehicleType = 'OT'
      }
      
      return vehicleType
    }
    
    return null
  }

  // Load vehicle data from API with realtime updates
  const fetchVehicles = async () => {
    try {
      setIsRefreshing(true)
      console.log('🔄 Refreshing vehicle list...')
      console.log('📋 Current workConfig:', workConfig) // Debug log
      const apiData = await layALLPhienGuiXe()
      
      // Debug: Log sample data to check loaiXe field
      if (Array.isArray(apiData) && apiData.length > 0) {
        console.log('🔍 DEBUG: Sample vehicle data from API:', {
          sampleCount: Math.min(3, apiData.length),
          samples: apiData.slice(0, 3).map(item => ({
            bienSo: item.bienSo,
            loaiXe: item.loaiXe,
            loaiXeType: typeof item.loaiXe,
            chinhSach: item.chinhSach
          }))
        })
        console.log('🔍 DEBUG: workConfig.vehicle_type:', workConfig?.vehicle_type)
        console.log('📋 NOTE: Ưu tiên dữ liệu từ database (loaiXe) thay vì workConfig để tính phí chính xác')
        console.log('📋 HƯỚNG DẪN: WorkConfig chỉ ảnh hưởng xe MỚI vào. Xe cũ giữ nguyên loại xe và chính sách khi vào.')
      }
      
      // Map API data to component format based on pm_nc0009 structure
      const mappedVehicles = (Array.isArray(apiData) ? apiData : []).map((item, idx) => {
        // Determine vehicle type using the enhanced logic
        const vehicleTypeInfo = determineVehicleType(item)

        // Format duration from phutGui (minutes)
        let duration = "---"
        if (item.phutGui && item.phutGui > 0) {
          const hours = Math.floor(item.phutGui / 60)
          const minutes = item.phutGui % 60
          duration = `${hours}h ${minutes}m`
        }

        // Map status from trangThai
        let status = "Đã ra" // default
        if (item.trangThai === "DANG_GUI") {
          status = "Trong bãi"
        } else if (item.trangThai === "DA_RA") {
          status = "Đã ra"
        }

        // Format fee
        let fee = 0
        if (item.phi && typeof item.phi === 'number') {
          fee = item.phi
        }

        return {
          id: item.maPhien || `temp_${idx}`,
          sessionId: item.maPhien,
          licensePlate: item.bienSo || "---",
          cardId: item.uidThe || "---",
          vehicleType: vehicleTypeInfo.vehicleType, // For backward compatibility (xe_may/oto)
          vehicleTypeName: vehicleTypeInfo.name, // New field for display name
          vehicleTypeCode: vehicleTypeInfo.code, // New field for type code
          isLargeVehicle: vehicleTypeInfo.isLargeVehicle, // New field for size classification
          timeIn: item.gioVao || null,
          timeOut: item.gioRa || null,
          duration: duration,
          fee: fee,
          status: status,
          zone: item.viTriGui || "---",
          // Additional fields for reference
          policy: item.chinhSach || "---",
          gateIn: item.congVao || "---",
          gateOut: item.congRa || "---",
          // Debug: Thêm thông tin debug
          _debug: {
            originalLoaiXe: item.loaiXe,
            workConfigType: workConfig?.vehicle_type,
            policyName: item.chinhSach,
            determinedType: vehicleTypeInfo.name,
            determinedCode: vehicleTypeInfo.code,
            feeValue: item.phi,
            status: item.trangThai
          },
          // Note: Intentionally exclude image fields (anhVao, anhRa)
        }
      })

      console.log(`🔄 Vehicle type mapping summary: WorkConfig=${workConfig?.vehicle_type}, Total vehicles=${mappedVehicles.length}`)
      
      // Debug: Log vehicle type distribution
      const typeDistribution = {}
      mappedVehicles.forEach(v => {
        const typeName = v.vehicleTypeName || v.vehicleType
        typeDistribution[typeName] = (typeDistribution[typeName] || 0) + 1
      })
      console.log('📊 Vehicle type distribution:', typeDistribution)
      
      // Debug: Log pricing issues if any
      const pricingIssues = mappedVehicles.filter(v => v._debug && v._debug.feeValue !== undefined && v._debug.feeValue > 0 && v._debug.determinedType !== workConfig?.vehicle_type && v._debug.status === 'DA_RA')
      if (pricingIssues.length > 0) {
        console.warn(`💰 Phát hiện ${pricingIssues.length} xe ĐÃ RA có khác biệt loại xe so với WorkConfig:`)
        pricingIssues.forEach(v => {
          console.warn(`  - ${v.licensePlate}: WorkConfig=${workConfig?.vehicle_type}, Thực tế=${v._debug.determinedType}, Phí=${v._debug.feeValue}, Policy=${v._debug.policyName}`)
        })
        console.info(`📋 NOTE: Điều này bình thường vì xe đã vào trước khi thay đổi WorkConfig. Chỉ xe mới vào mới áp dụng WorkConfig hiện tại.`)
      }
      
      setVehicles(mappedVehicles)
      
      // Update statistics based on current status and vehicle types
      const motorcycles = mappedVehicles.filter(v => !v.isLargeVehicle && v.status === "Trong bãi").length
      const cars = mappedVehicles.filter(v => v.isLargeVehicle && v.status === "Trong bãi").length
      const totalVehicles = motorcycles + cars
      const totalRevenue = mappedVehicles
        .filter(v => v.status === "Đã ra") // Only count completed sessions
        .reduce((sum, v) => sum + (v.fee || 0), 0)
      
      setStatistics({ totalVehicles, motorcycles, cars, totalRevenue })
      setLastUpdated(new Date())
      console.log(`✅ Vehicle list updated: ${totalVehicles} vehicles in parking, ${mappedVehicles.length} total sessions`)
    } catch (error) {
      console.error('❌ Error fetching vehicles:', error)
      setVehicles([])
      setStatistics({ totalVehicles: 0, motorcycles: 0, cars: 0, totalRevenue: 0 })
    } finally {
      setIsRefreshing(false)
    }
  }

  // Initial load and setup realtime updates
  useEffect(() => {
    // Load vehicle type mapping first
    loadVehicleTypeMapping().then(() => {
      fetchVehicles()
    })
    
    // Set up auto-refresh every 30 seconds
    const refreshInterval = setInterval(() => {
      fetchVehicles()
    }, 30000) // 30 seconds
    
    return () => clearInterval(refreshInterval)
  }, [])

  // Re-fetch when workConfig changes to update vehicle types
  useEffect(() => {
    if (workConfig) {
      console.log('📋 WorkConfig changed, refreshing vehicle list for type sync...')
      fetchVehicles()
    }
  }, [workConfig?.vehicle_type])

  // Update 'now' every second for realtime duration
  useEffect(() => {
    const timer = setInterval(() => setNow(Date.now()), 1000)
    return () => clearInterval(timer)
  }, [])

  // Update vehicle list with external data
  const updateVehicleList = (newVehicles) => {
    setVehicles(Array.isArray(newVehicles) ? newVehicles : [])
  }

  // Force refresh from API
  const refreshVehicleList = () => {
    console.log('🔄 Manual refresh triggered')
    fetchVehicles()
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
      
      // Enhanced type filter with support for all vehicle types
      const matchesTypeFilter = filterType === "all" || 
        filterType === vehicle.vehicleType || // Backward compatibility (xe_may/oto)
        filterType === vehicle.vehicleTypeCode || // Match by type code (XE_BUS, XE_16CHO, etc.)
        (filterType === "large" && vehicle.isLargeVehicle) || // Filter large vehicles
        (filterType === "small" && !vehicle.isLargeVehicle) // Filter small vehicles
        
      const matchesStatusFilter = filterStatus === "all" || vehicle.status === filterStatus
      return matchesSearch && matchesTypeFilter && matchesStatusFilter
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
      refreshVehicleList,
      fetchVehicles,
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
          <div className="stat-header">XE NHỎ</div>
          <div className="stat-value">{statistics.motorcycles}</div>
        </div>
        <div className="stat-card">
          <div className="stat-header">XE LỚN</div>
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
              <option value="small">Xe nhỏ (xe máy, xe đạp, ...)</option>
              <option value="large">Xe lớn (ô tô, xe bus, ...)</option>
              <option value="xe_may">Xe máy</option>
              <option value="oto">Ô tô</option>
              {availableVehicleTypes.map(type => (
                <option key={type.code} value={type.code}>
                  {type.name}
                </option>
              ))}
            </select>

            <select value={filterStatus} onChange={(e) => setFilterStatus(e.target.value)} className="filter-select">
              <option value="all">Tất cả trạng thái</option>
              <option value="Trong bãi">Trong bãi</option>
              <option value="Đã ra">Đã ra</option>
            </select>

            <select value={sortBy} onChange={(e) => setSortBy(e.target.value)} className="sort-select">
              <option value="timeIn">Thời gian vào</option>
              <option value="licensePlate">Biển số</option>
              <option value="fee">Phí gửi xe</option>
              <option value="duration">Thời gian đỗ</option>
              <option value="status">Trạng thái</option>
            </select>

            <button onClick={() => setSortOrder(sortOrder === "asc" ? "desc" : "asc")} className="sort-order-btn">
              {sortOrder === "asc" ? "Tăng dần" : "Giảm dần"}
            </button>
            
            <button 
              onClick={() => setShowParkingManagement(true)} 
              className="parking-management-btn"
              title="Xem sơ đồ bãi đỗ xe"
            >
              Sơ đồ bãi đỗ
            </button>
            
            <button 
              onClick={refreshVehicleList} 
              className="refresh-btn"
              disabled={isRefreshing}
              title="Làm mới danh sách"
            >
              {isRefreshing ? "Đang tải..." : "Làm mới"}
            </button>
          </div>
          
          {lastUpdated && (
            <div className="last-updated">
              Cập nhật lần cuối: {lastUpdated.toLocaleTimeString('vi-VN')}
            </div>
          )}
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
                    <td className="vehicle-type">{vehicle.vehicleTypeName || vehicle.vehicleType}</td>
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
                          Xem
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
