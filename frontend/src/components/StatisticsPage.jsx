"use client"

import { useEffect, useRef, useState } from "react"
import { 
  layThongKeDoanhThu, 
  layThongKeLoaiXe, 
  layTiLeLapDay,
  layThongKeTongQuan,
  layThongKeXeTrongBai,
  layThongKeDoanhThuTheoLoaiThe,
  layThongKeHieuSuatCamera,
  layThongKeTheoKhuVuc,
  layThongKeNhanVien,
  layThongKeThoiGianTrungBinh,
  layTopTheSuDung,
  layThongKeLoiSuCo,
  layDanhSachThe,
  layDanhSachNhanVien,
  layDanhSachCamera,
  layDanhSachKhu,
  layALLPhienGuiXe
} from "../api/api"
import Chart from "chart.js/auto"
import "../assets/styles/StatisticsPage.css"

// Helper to calculate from / to dates based on preset
const getDateRange = (preset) => {
  const today = new Date()
  const toDate = today.toISOString().substring(0, 10) // yyyy-mm-dd
  let fromDate = toDate

  switch (preset) {
    case "today":
      fromDate = toDate
      break
    case "7d":
      const d7 = new Date()
      d7.setDate(d7.getDate() - 6)
      fromDate = d7.toISOString().substring(0, 10)
      break
    case "30d":
      const d30 = new Date()
      d30.setDate(d30.getDate() - 29)
      fromDate = d30.toISOString().substring(0, 10)
      break
    case "3m":
      const m3 = new Date()
      m3.setMonth(m3.getMonth() - 2)
      fromDate = m3.toISOString().substring(0, 10)
      break
    case "6m":
      const m6 = new Date()
      m6.setMonth(m6.getMonth() - 5)
      fromDate = m6.toISOString().substring(0, 10)
      break
    default:
      fromDate = toDate
  }
  return { fromDate, toDate }
}

const StatisticsPage = ({ onClose }) => {
  const [preset, setPreset] = useState("30d")
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState(null)
  const [activeTab, setActiveTab] = useState("overview")
  const [statsData, setStatsData] = useState({
    revenue: null,
    vehicles: null,
    occupancy: null,
    overview: null,
    vehiclesInParking: null,
    revenueByCardType: null,
    cameraPerformance: null,
    zoneStatistics: null,
    employeeActivity: null,
    averageParkingTime: null,
    topCards: null,
    errorAnalysis: null,
    systemCounts: {
      totalCards: 0,
      totalEmployees: 0,
      totalCameras: 0,
      totalZones: 0,
      totalSessions: 0
    }
  })

  const revenueChartRef = useRef(null)
  const vehicleChartRef = useRef(null) 
  const occupancyChartRef = useRef(null)
  const vehiclesInParkingChartRef = useRef(null)
  const revenueByCardTypeChartRef = useRef(null)
  const parkingTimeChartRef = useRef(null)
  const zoneStatsChartRef = useRef(null)

  const revenueChartInstance = useRef(null)
  const vehicleChartInstance = useRef(null)
  const occupancyChartInstance = useRef(null)
  const vehiclesInParkingChartInstance = useRef(null)
  const revenueByCardTypeChartInstance = useRef(null)
  const parkingTimeChartInstance = useRef(null)
  const zoneStatsChartInstance = useRef(null)

  const timeRangeOptions = [
    { value: "today", label: "Hôm nay" },
    { value: "7d", label: "7 ngày" },
    { value: "30d", label: "30 ngày" },
    { value: "3m", label: "3 tháng" },
    { value: "6m", label: "6 tháng" },
  ]

  const tabOptions = [
    { value: "overview", label: "Tổng quan", icon: "" },
    { value: "revenue", label: "Doanh thu", icon: "" },
    { value: "vehicles", label: "Xe cộ", icon: "" },
    { value: "system", label: "Hệ thống", icon: "" },
    { value: "performance", label: "Hiệu suất", icon: "" },
    { value: "analysis", label: "Phân tích", icon: "" }
  ]

  const fetchData = async () => {
    setLoading(true)
    setError(null)
    try {
      const { fromDate, toDate } = getDateRange(preset)

      // Fetch basic statistics (always needed)
      const [revenueRes, vehicleRes, occRes] = await Promise.all([
        layThongKeDoanhThu({ fromDate, toDate }),
        layThongKeLoaiXe({ fromDate, toDate }),
        layTiLeLapDay(),
      ])

      // Fetch system counts for overview
      const [cardsRes, employeesRes, camerasRes, zonesRes, sessionsRes] = await Promise.all([
        layDanhSachThe().catch(() => []),
        layDanhSachNhanVien().catch(() => []),
        layDanhSachCamera().catch(() => []),
        layDanhSachKhu().catch(() => []),
        layALLPhienGuiXe().catch(() => [])
      ])

      const systemCounts = {
        totalCards: Array.isArray(cardsRes) ? cardsRes.length : 0,
        totalEmployees: Array.isArray(employeesRes) ? employeesRes.length : 0,
        totalCameras: Array.isArray(camerasRes) ? camerasRes.length : 0,
        totalZones: Array.isArray(zonesRes) ? zonesRes.length : 0,
        totalSessions: Array.isArray(sessionsRes) ? sessionsRes.length : 0
      }

      // Fetch advanced statistics based on active tab
      let advancedData = {}
      
      if (activeTab === "overview" || activeTab === "system") {
        const [overviewRes, vehiclesInParkingRes] = await Promise.all([
          layThongKeTongQuan().catch(() => ({})),
          layThongKeXeTrongBai({ fromDate, toDate }).catch(() => ({}))
        ])
        advancedData.overview = overviewRes
        advancedData.vehiclesInParking = vehiclesInParkingRes
      }

      if (activeTab === "revenue" || activeTab === "overview") {
        const revenueByCardTypeRes = await layThongKeDoanhThuTheoLoaiThe({ fromDate, toDate }).catch(() => ({}))
        advancedData.revenueByCardType = revenueByCardTypeRes
      }

      if (activeTab === "performance" || activeTab === "system") {
        const [cameraRes, zoneRes] = await Promise.all([
          layThongKeHieuSuatCamera({ fromDate, toDate }).catch(() => ({})),
          layThongKeTheoKhuVuc({ fromDate, toDate }).catch(() => ({}))
        ])
        advancedData.cameraPerformance = cameraRes
        advancedData.zoneStatistics = zoneRes
      }

      if (activeTab === "analysis") {
        const [employeeRes, timeRes, topCardsRes, errorsRes] = await Promise.all([
          layThongKeNhanVien({ fromDate, toDate }).catch(() => ({})),
          layThongKeThoiGianTrungBinh({ fromDate, toDate }).catch(() => ({})),
          layTopTheSuDung({ fromDate, toDate }).catch(() => ({})),
          layThongKeLoiSuCo({ fromDate, toDate }).catch(() => ({}))
        ])
        advancedData.employeeActivity = employeeRes
        advancedData.averageParkingTime = timeRes
        advancedData.topCards = topCardsRes
        advancedData.errorAnalysis = errorsRes
      }

      console.log("Revenue data:", revenueRes)
      console.log("Vehicle data:", vehicleRes)
      console.log("Occupancy data:", occRes)
      console.log("System counts:", systemCounts)
      console.log("Advanced data:", advancedData)

      setStatsData({
        revenue: revenueRes,
        vehicles: vehicleRes,
        occupancy: occRes,
        systemCounts,
        ...advancedData
      })

      // Wait for next tick to ensure DOM is updated
      setTimeout(() => {
        createCharts(revenueRes, vehicleRes, occRes, advancedData)
      }, 100)
    } catch (err) {
      console.error("Statistics error:", err)
      setError(err.message || "Lỗi tải dữ liệu")
    } finally {
      setLoading(false)
    }
  }

  const createCharts = (revenueRes, vehicleRes, occRes, advancedData = {}) => {
    try {
      // Destroy existing charts
      if (revenueChartInstance.current) revenueChartInstance.current.destroy()
      if (vehicleChartInstance.current) vehicleChartInstance.current.destroy()
      if (occupancyChartInstance.current) occupancyChartInstance.current.destroy()
      if (vehiclesInParkingChartInstance.current) vehiclesInParkingChartInstance.current.destroy()
      if (revenueByCardTypeChartInstance.current) revenueByCardTypeChartInstance.current.destroy()
      if (parkingTimeChartInstance.current) parkingTimeChartInstance.current.destroy()
      if (zoneStatsChartInstance.current) zoneStatsChartInstance.current.destroy()

      // ---- Revenue Chart ----
      if (revenueChartInstance.current) {
        revenueChartInstance.current.destroy()
      }

      if (revenueChartRef.current && revenueRes && revenueRes.detail && Array.isArray(revenueRes.detail)) {
        const labels = revenueRes.detail.map((d) => {
          const date = new Date(d.date)
          return date.toLocaleDateString("vi-VN", {
            month: "short",
            day: "numeric",
          })
        })
        const dataValues = revenueRes.detail.map((d) => d.total)

        revenueChartInstance.current = new Chart(revenueChartRef.current, {
          type: "line",
          data: {
            labels,
            datasets: [
              {
                label: "Doanh thu (VNĐ)",
                data: dataValues,
                borderColor: "#1c315c",
                backgroundColor: "rgba(28, 49, 92, 0.1)",
                tension: 0.4,
                fill: true,
                pointBackgroundColor: "#1c315c",
                pointBorderColor: "#ffffff",
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                mode: "index",
                intersect: false,
                backgroundColor: "rgba(28, 49, 92, 0.9)",
                titleColor: "#ffffff",
                bodyColor: "#ffffff",
                borderColor: "#1c315c",
                borderWidth: 1,
                cornerRadius: 6,
                callbacks: {
                  label: (context) => `Doanh thu: ${context.parsed.y.toLocaleString("vi-VN")} VNĐ`,
                },
              },
            },
            scales: {
              x: {
                grid: {
                  display: false,
                },
                ticks: {
                  color: "#64748b",
                  font: {
                    size: 11,
                  },
                },
              },
              y: {
                grid: {
                  color: "rgba(100, 116, 139, 0.1)",
                },
                ticks: {
                  color: "#64748b",
                  font: {
                    size: 11,
                  },
                  callback: (v) => v.toLocaleString("vi-VN"),
                },
              },
            },
          },
        })
      }

      // ---- Vehicle Types Chart ----
      if (vehicleChartInstance.current) {
        vehicleChartInstance.current.destroy()
      }

      if (vehicleChartRef.current && vehicleRes && vehicleRes.data && typeof vehicleRes.data === "object") {
        const vehicleLabels = Object.keys(vehicleRes.data)
        const vehicleData = Object.values(vehicleRes.data)
        const palette = ["#1c315c", "#2a4a7c", "#3d5a9c", "#5b7bb8", "#7a9bd4"]

        vehicleChartInstance.current = new Chart(vehicleChartRef.current, {
          type: "doughnut",
          data: {
            labels: vehicleLabels,
            datasets: [
              {
                data: vehicleData,
                backgroundColor: palette.slice(0, vehicleLabels.length),
                borderWidth: 2,
                borderColor: "#ffffff",
                hoverBorderWidth: 3,
                hoverOffset: 4,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: "bottom",
                labels: {
                  padding: 15,
                  usePointStyle: true,
                  pointStyle: "circle",
                  font: {
                    size: 11,
                  },
                  color: "#1c315c",
                },
              },
              tooltip: {
                backgroundColor: "rgba(28, 49, 92, 0.9)",
                titleColor: "#ffffff",
                bodyColor: "#ffffff",
                borderColor: "#1c315c",
                borderWidth: 1,
                cornerRadius: 6,
                callbacks: {
                  label: (context) => {
                    const total = context.dataset.data.reduce((a, b) => a + b, 0)
                    const percentage = ((context.parsed / total) * 100).toFixed(1)
                    return `${context.label}: ${context.parsed} xe (${percentage}%)`
                  },
                },
              },
            },
            cutout: "60%",
          },
        })
      }

      // ---- Occupancy Chart ----
      if (occupancyChartInstance.current) {
        occupancyChartInstance.current.destroy()
      }

      if (
        occupancyChartRef.current &&
        occRes &&
        typeof occRes.totalSlots !== "undefined" &&
        typeof occRes.occupied !== "undefined"
      ) {
        const occupancyRate = ((occRes.occupied / occRes.totalSlots) * 100).toFixed(1)

        occupancyChartInstance.current = new Chart(occupancyChartRef.current, {
          type: "bar",
          data: {
            labels: ["Tổng chỗ đỗ", "Đang sử dụng", "Còn trống"],
            datasets: [
              {
                label: "Số lượng",
                data: [occRes.totalSlots, occRes.occupied, occRes.totalSlots - occRes.occupied],
                backgroundColor: ["#e2e8f0", "#1c315c", "#10b981"],
                borderColor: ["#cbd5e1", "#1c315c", "#059669"],
                borderWidth: 1,
                borderRadius: 4,
                borderSkipped: false,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: { display: false },
              tooltip: {
                backgroundColor: "rgba(28, 49, 92, 0.9)",
                titleColor: "#ffffff",
                bodyColor: "#ffffff",
                borderColor: "#1c315c",
                borderWidth: 1,
                cornerRadius: 6,
                callbacks: {
                  label: (context) => {
                    if (context.dataIndex === 1) {
                      return `Đang sử dụng: ${context.parsed.y} chỗ (${occupancyRate}%)`
                    }
                    return `${context.label}: ${context.parsed.y} chỗ`
                  },
                },
              },
            },
            scales: {
              x: {
                grid: { display: false },
                ticks: {
                  color: "#64748b",
                  font: { size: 11 },
                },
              },
              y: {
                beginAtZero: true,
                grid: { color: "rgba(100, 116, 139, 0.1)" },
                ticks: {
                  color: "#64748b",
                  font: { size: 11 },
                },
              },
            },
          },
        })
      }
    } catch (err) {
      console.error("Failed to create charts:", err)
    }
  }

  useEffect(() => {
    fetchData()
    // cleanup charts on unmount
    return () => {
      if (revenueChartInstance.current) revenueChartInstance.current.destroy()
      if (vehicleChartInstance.current) vehicleChartInstance.current.destroy()
      if (occupancyChartInstance.current) occupancyChartInstance.current.destroy()
      if (vehiclesInParkingChartInstance.current) vehiclesInParkingChartInstance.current.destroy()
      if (revenueByCardTypeChartInstance.current) revenueByCardTypeChartInstance.current.destroy()
      if (parkingTimeChartInstance.current) parkingTimeChartInstance.current.destroy()
      if (zoneStatsChartInstance.current) zoneStatsChartInstance.current.destroy()
    }
  }, [preset, activeTab])

  // Calculate summary statistics
  const calculateSummaryStats = () => {
    if (!statsData.revenue || !statsData.vehicles || !statsData.occupancy) {
      return null
    }

    const totalRevenue = statsData.revenue.detail?.reduce((sum, item) => sum + item.total, 0) || 0
    const totalVehicles = Object.values(statsData.vehicles.data || {}).reduce((sum, count) => sum + count, 0)
    const occupancyRate = statsData.occupancy.totalSlots > 0 
      ? ((statsData.occupancy.occupied / statsData.occupancy.totalSlots) * 100).toFixed(1)
      : 0
    const avgDailyRevenue = statsData.revenue.detail?.length > 0 
      ? totalRevenue / statsData.revenue.detail.length 
      : 0

    return {
      totalRevenue,
      totalVehicles,
      occupancyRate,
      avgDailyRevenue,
      availableSpots: (statsData.occupancy.totalSlots || 0) - (statsData.occupancy.occupied || 0),
    }
  }

  // Render content based on active tab
  const renderTabContent = () => {
    const summaryStats = calculateSummaryStats()

    switch (activeTab) {
      case "overview":
        return renderOverviewTab(summaryStats)
      case "revenue":
        return renderRevenueTab(summaryStats)
      case "vehicles":
        return renderVehiclesTab(summaryStats)
      case "system":
        return renderSystemTab()
      case "performance":
        return renderPerformanceTab()
      case "analysis":
        return renderAnalysisTab()
      default:
        return renderOverviewTab(summaryStats)
    }
  }

  // Overview Tab Content
  const renderOverviewTab = (summaryStats) => {
    if (!summaryStats) return <div>Đang tải dữ liệu...</div>
    
    return (
      <>
        <div className="summary-stats">
          <div className="stat-card">
            <div className="stat-value">{summaryStats.totalRevenue.toLocaleString("vi-VN")}</div>
            <div className="stat-label">Tổng doanh thu (VNĐ)</div>
            <div className="stat-change neutral">
              TB: {summaryStats.avgDailyRevenue.toLocaleString("vi-VN")} VNĐ/ngày
            </div>
          </div>

          <div className="stat-card">
            <div className="stat-value">{summaryStats.totalVehicles}</div>
            <div className="stat-label">Tổng lượt xe</div>
            <div className="stat-change positive">
              TB: {statsData.revenue?.detail?.length > 0 ? Math.round(summaryStats.totalVehicles / statsData.revenue.detail.length) : 0} xe/ngày
            </div>
          </div>

          <div className="stat-card">
            <div className="stat-value">{summaryStats.occupancyRate}%</div>
            <div className="stat-label">Tỷ lệ lấp đầy</div>
            <div
              className={`stat-change ${summaryStats.occupancyRate > 70 ? "positive" : summaryStats.occupancyRate > 40 ? "neutral" : "negative"}`}
            >
              {statsData.occupancy?.occupied || 0}/{statsData.occupancy?.totalSlots || 0} chỗ
            </div>
          </div>

          <div className="stat-card">
            <div className="stat-value">{summaryStats.availableSpots}</div>
            <div className="stat-label">Chỗ trống</div>
            <div className="stat-change neutral">Hiện tại</div>
          </div>

          {/* System overview cards */}
          <div className="stat-card">
            <div className="stat-value">{statsData.systemCounts?.totalCards || 0}</div>
            <div className="stat-label">Tổng số thẻ</div>
            <div className="stat-change neutral">Đã đăng ký</div>
          </div>

          <div className="stat-card">
            <div className="stat-value">{statsData.systemCounts?.totalEmployees || 0}</div>
            <div className="stat-label">Nhân viên</div>
            <div className="stat-change neutral">Đang hoạt động</div>
          </div>

          <div className="stat-card">
            <div className="stat-value">{statsData.systemCounts?.totalCameras || 0}</div>
            <div className="stat-label">Camera</div>
            <div className="stat-change neutral">Hệ thống</div>
          </div>

          <div className="stat-card">
            <div className="stat-value">{statsData.systemCounts?.totalZones || 0}</div>
            <div className="stat-label">Khu vực</div>
            <div className="stat-change neutral">Quản lý</div>
          </div>
        </div>

        <div className="charts-container">
          <div className="chart-row">
            <div className="chart-card">
              <h3 className="chart-title">Doanh thu theo ngày</h3>
              <canvas ref={revenueChartRef} className="chart-canvas"></canvas>
            </div>
            
            <div className="chart-card">
              <h3 className="chart-title">Tỷ lệ lấp đầy</h3>
              <canvas ref={occupancyChartRef} className="chart-canvas"></canvas>
            </div>
          </div>
        </div>
      </>
    )
  }

  // Revenue Tab Content  
  const renderRevenueTab = (summaryStats) => {
    return (
      <>
        <div className="summary-stats">
          <div className="stat-card">
            <div className="stat-value">{summaryStats?.totalRevenue?.toLocaleString("vi-VN") || 0}</div>
            <div className="stat-label">Tổng doanh thu (VNĐ)</div>
          </div>
          <div className="stat-card">
            <div className="stat-value">{summaryStats?.avgDailyRevenue?.toLocaleString("vi-VN") || 0}</div>
            <div className="stat-label">Trung bình/ngày (VNĐ)</div>
          </div>
        </div>

        <div className="charts-container">
          <div className="chart-row">
            <div className="chart-card">
              <h3 className="chart-title">Doanh thu theo ngày</h3>
              <canvas ref={revenueChartRef} className="chart-canvas"></canvas>
            </div>
            
            <div className="chart-card">
              <h3 className="chart-title">Doanh thu theo loại thẻ</h3>
              <canvas ref={revenueByCardTypeChartRef} className="chart-canvas"></canvas>
            </div>
          </div>
        </div>
      </>
    )
  }

  // Vehicles Tab Content
  const renderVehiclesTab = (summaryStats) => {
    return (
      <>
        <div className="summary-stats">
          <div className="stat-card">
            <div className="stat-value">{summaryStats?.totalVehicles || 0}</div>
            <div className="stat-label">Tổng lượt xe</div>
          </div>
          <div className="stat-card">
            <div className="stat-value">{summaryStats?.occupancyRate || 0}%</div>
            <div className="stat-label">Tỷ lệ lấp đầy</div>
          </div>
        </div>

        <div className="charts-container">
          <div className="chart-row">
            <div className="chart-card">
              <h3 className="chart-title">Phân bổ loại xe</h3>
              <canvas ref={vehicleChartRef} className="chart-canvas"></canvas>
            </div>
            
            <div className="chart-card">
              <h3 className="chart-title">Xe vào/ra theo giờ</h3>
              <canvas ref={vehiclesInParkingChartRef} className="chart-canvas"></canvas>
            </div>
          </div>
        </div>
      </>
    )
  }

  // System Tab Content
  const renderSystemTab = () => {
    return (
      <>
        <div className="summary-stats">
          <div className="stat-card">
            <div className="stat-value">{statsData.systemCounts?.totalCards || 0}</div>
            <div className="stat-label">Thẻ RFID</div>
          </div>
          <div className="stat-card">
            <div className="stat-value">{statsData.systemCounts?.totalEmployees || 0}</div>
            <div className="stat-label">Nhân viên</div>
          </div>
          <div className="stat-card">
            <div className="stat-value">{statsData.systemCounts?.totalCameras || 0}</div>
            <div className="stat-label">Camera</div>
          </div>
          <div className="stat-card">
            <div className="stat-value">{statsData.systemCounts?.totalZones || 0}</div>
            <div className="stat-label">Khu vực</div>
          </div>
        </div>

        <div className="charts-container">
          <div className="chart-row">
            <div className="chart-card">
              <h3 className="chart-title">Thống kê theo khu vực</h3>
              <canvas ref={zoneStatsChartRef} className="chart-canvas"></canvas>
            </div>
          </div>
        </div>
      </>
    )
  }

  // Performance Tab Content
  const renderPerformanceTab = () => {
    return (
      <>
        <div className="summary-stats">
          <div className="stat-card">
            <div className="stat-value">{statsData.cameraPerformance?.totalScans || 0}</div>
            <div className="stat-label">Tổng lần quét</div>
          </div>
          <div className="stat-card">
            <div className="stat-value">{statsData.cameraPerformance?.successRate || 0}%</div>
            <div className="stat-label">Tỷ lệ thành công</div>
          </div>
        </div>

        <div className="info-grid">
          <div className="info-card">
            <h4>Hiệu suất camera</h4>
            <div className="info-content">
              {statsData.cameraPerformance?.cameras?.map((camera, index) => (
                <div key={index} className="info-row">
                  <span>{camera.name}</span>
                  <span>{camera.successRate}%</span>
                </div>
              )) || <div>Chưa có dữ liệu</div>}
            </div>
          </div>
        </div>
      </>
    )
  }

  // Analysis Tab Content
  const renderAnalysisTab = () => {
    return (
      <>
        <div className="summary-stats">
          <div className="stat-card">
            <div className="stat-value">{statsData.averageParkingTime?.averageTime || 0}</div>
            <div className="stat-label">Thời gian TB (phút)</div>
          </div>
          <div className="stat-card">
            <div className="stat-value">{statsData.errorAnalysis?.plateErrors || 0}</div>
            <div className="stat-label">Lỗi biển số</div>
          </div>
        </div>

        <div className="charts-container">
          <div className="chart-row">
            <div className="chart-card">
              <h3 className="chart-title">Thời gian gửi xe trung bình</h3>
              <canvas ref={parkingTimeChartRef} className="chart-canvas"></canvas>
            </div>
          </div>
        </div>

        <div className="info-grid">
          <div className="info-card">
            <h4>Top thẻ sử dụng nhiều</h4>
            <div className="info-content">
              {statsData.topCards?.topCards?.slice(0, 10).map((card, index) => (
                <div key={index} className="info-row">
                  <span>{card.cardId}</span>
                  <span>{card.usage} lần</span>
                </div>
              )) || <div>Chưa có dữ liệu</div>}
            </div>
          </div>

          <div className="info-card">
            <h4>Thống kê lỗi</h4>
            <div className="info-content">
              <div className="info-row">
                <span>Lỗi biển số</span>
                <span>{statsData.errorAnalysis?.plateErrors || 0}</span>
              </div>
              <div className="info-row">
                <span>Lỗi camera</span>
                <span>{statsData.errorAnalysis?.cameraErrors || 0}</span>
              </div>
              <div className="info-row">
                <span>Lỗi thẻ</span>
                <span>{statsData.errorAnalysis?.cardErrors || 0}</span>
              </div>
              <div className="info-row">
                <span>Lỗi hệ thống</span>
                <span>{statsData.errorAnalysis?.systemErrors || 0}</span>
              </div>
            </div>
          </div>
        </div>
      </>
    )
  }

  return (
    <div className="statistics-overlay">
      <div className="statistics-container">
        <div className="statistics-header">
          <h2 className="statistics-title">Thống kê bãi xe</h2>
          <button className="statistics-close-btn" onClick={onClose}>
            Đóng
          </button>
        </div>

        <div className="statistics-body">
          <div className="statistics-controls">
            <div className="control-group">
              <label className="control-label">Khoảng thời gian:</label>
              <select className="time-range-select" value={preset} onChange={(e) => setPreset(e.target.value)}>
                {timeRangeOptions.map((option) => (
                  <option key={option.value} value={option.value}>
                    {option.label}
                  </option>
                ))}
              </select>
            </div>
          </div>

          {/* Tab Navigation */}
          <div className="statistics-tabs">
            {tabOptions.map((tab) => (
              <button
                key={tab.value}
                className={`tab-button ${activeTab === tab.value ? 'active' : ''}`}
                onClick={() => setActiveTab(tab.value)}
              >
                <span className="tab-icon">{tab.icon}</span>
                <span className="tab-label">{tab.label}</span>
              </button>
            ))}
          </div>

          {loading && (
            <div className="loading-container">
              <div className="loading-spinner"></div>
              <div className="loading-text">Đang tải dữ liệu...</div>
            </div>
          )}

          {error && <div className="error-container">{error}</div>}

          {!loading && !error && (
            <div className="statistics-content">
              {renderTabContent()}
            </div>
          )}
        </div>
      </div>
    </div>
  )
}

export default StatisticsPage
