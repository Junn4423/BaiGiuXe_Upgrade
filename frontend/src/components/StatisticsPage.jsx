"use client"

import { useEffect, useRef, useState } from "react"
import { layThongKeDoanhThu, layThongKeLoaiXe, layTiLeLapDay } from "../api/api"
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
  const [statsData, setStatsData] = useState({
    revenue: null,
    vehicles: null,
    occupancy: null,
  })

  const revenueChartRef = useRef(null)
  const vehicleChartRef = useRef(null)
  const occupancyChartRef = useRef(null)

  const revenueChartInstance = useRef(null)
  const vehicleChartInstance = useRef(null)
  const occupancyChartInstance = useRef(null)

  const timeRangeOptions = [
    { value: "today", label: "Hôm nay" },
    { value: "7d", label: "7 ngày" },
    { value: "30d", label: "30 ngày" },
    { value: "3m", label: "3 tháng" },
    { value: "6m", label: "6 tháng" },
  ]

  const fetchData = async () => {
    setLoading(true)
    setError(null)
    try {
      const { fromDate, toDate } = getDateRange(preset)

      // Parallel fetch
      const [revenueRes, vehicleRes, occRes] = await Promise.all([
        layThongKeDoanhThu({ fromDate, toDate }),
        layThongKeLoaiXe({ fromDate, toDate }),
        layTiLeLapDay(),
      ])

      console.log("Revenue data:", revenueRes)
      console.log("Vehicle data:", vehicleRes)
      console.log("Occupancy data:", occRes)

      setStatsData({
        revenue: revenueRes,
        vehicles: vehicleRes,
        occupancy: occRes,
      })

      // Wait for next tick to ensure DOM is updated
      setTimeout(() => {
        createCharts(revenueRes, vehicleRes, occRes)
      }, 100)
    } catch (err) {
      console.error("Statistics error:", err)
      setError(err.message || "Lỗi tải dữ liệu")
    } finally {
      setLoading(false)
    }
  }

  const createCharts = (revenueRes, vehicleRes, occRes) => {
    try {
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
    }
  }, [preset])

  // Calculate summary statistics
  const calculateSummaryStats = () => {
    if (!statsData.revenue || !statsData.vehicles || !statsData.occupancy) {
      return null
    }

    const totalRevenue = statsData.revenue.detail.reduce((sum, item) => sum + item.total, 0)
    const totalVehicles = Object.values(statsData.vehicles.data).reduce((sum, count) => sum + count, 0)
    const occupancyRate = ((statsData.occupancy.occupied / statsData.occupancy.totalSlots) * 100).toFixed(1)
    const avgDailyRevenue = totalRevenue / statsData.revenue.detail.length

    return {
      totalRevenue,
      totalVehicles,
      occupancyRate,
      avgDailyRevenue,
      availableSpots: statsData.occupancy.totalSlots - statsData.occupancy.occupied,
    }
  }

  const summaryStats = calculateSummaryStats()

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

          {loading && (
            <div className="loading-container">
              <div className="loading-spinner"></div>
              <div className="loading-text">Đang tải dữ liệu...</div>
            </div>
          )}

          {error && <div className="error-container">{error}</div>}

          {!loading && !error && summaryStats && (
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
                    TB: {Math.round(summaryStats.totalVehicles / statsData.revenue.detail.length)} xe/ngày
                  </div>
                </div>

                <div className="stat-card">
                  <div className="stat-value">{summaryStats.occupancyRate}%</div>
                  <div className="stat-label">Tỷ lệ lấp đầy</div>
                  <div
                    className={`stat-change ${summaryStats.occupancyRate > 70 ? "positive" : summaryStats.occupancyRate > 40 ? "neutral" : "negative"}`}
                  >
                    {statsData.occupancy.occupied}/{statsData.occupancy.totalSlots} chỗ
                  </div>
                </div>

                <div className="stat-card">
                  <div className="stat-value">{summaryStats.availableSpots}</div>
                  <div className="stat-label">Chỗ trống</div>
                  <div
                    className={`stat-change ${summaryStats.availableSpots > 20 ? "positive" : summaryStats.availableSpots > 5 ? "neutral" : "negative"}`}
                  >
                    Còn lại
                  </div>
                </div>
              </div>

              <div className="charts-container">
                <div className="charts-grid">
                  <div className="chart-card">
                    <h3 className="chart-title">Doanh thu theo thời gian</h3>
                    <div className="chart-content">
                      <canvas ref={revenueChartRef} className="chart-canvas"></canvas>
                    </div>
                  </div>

                  <div className="chart-card">
                    <h3 className="chart-title">Phân bố loại xe</h3>
                    <div className="chart-content">
                      <canvas ref={vehicleChartRef} className="chart-canvas"></canvas>
                    </div>
                  </div>
                </div>

                <div className="occupancy-section">
                  <div className="chart-card occupancy-chart">
                    <h3 className="chart-title">Tình trạng chỗ đỗ</h3>
                    <div className="chart-content">
                      <canvas ref={occupancyChartRef} className="chart-canvas"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </>
          )}
        </div>
      </div>
    </div>
  )
}

export default StatisticsPage
