import React, { useEffect, useRef, useState } from "react";
import {
  layThongKeDoanhThu,
  layThongKeLoaiXe,
  layTiLeLapDay,
} from "../api/api";
import Chart from "chart.js/auto";
import "./StatisticsPage.css";

// Helper to calculate from / to dates based on preset
const getDateRange = (preset) => {
  const today = new Date();
  const toDate = today.toISOString().substring(0, 10); // yyyy-mm-dd
  let fromDate = toDate;

  switch (preset) {
    case "today":
      fromDate = toDate;
      break;
    case "30d":
      const d30 = new Date();
      d30.setDate(d30.getDate() - 29);
      fromDate = d30.toISOString().substring(0, 10);
      break;
    case "3m":
      const m3 = new Date();
      m3.setMonth(m3.getMonth() - 2);
      fromDate = m3.toISOString().substring(0, 10);
      break;
    case "6m":
      const m6 = new Date();
      m6.setMonth(m6.getMonth() - 5);
      fromDate = m6.toISOString().substring(0, 10);
      break;
    default:
      fromDate = toDate;
  }
  return { fromDate, toDate };
};

const StatisticsPage = ({ onClose }) => {
  const [preset, setPreset] = useState("today");
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const [statsData, setStatsData] = useState(null);

  const revenueChartRef = useRef(null);
  const vehicleChartRef = useRef(null);
  const occupancyChartRef = useRef(null);

  const revenueChartInstance = useRef(null);
  const vehicleChartInstance = useRef(null);
  const occupancyChartInstance = useRef(null);

  const timeRangeOptions = [
    { value: "today", label: "Hôm nay" },
    { value: "30d", label: "30 ngày" },
    { value: "3m", label: "3 tháng" },
    { value: "6m", label: "6 tháng" },
  ];

  const fetchData = async () => {
    setLoading(true);
    setError(null);
    try {
      const { fromDate, toDate } = getDateRange(preset);

      // Parallel fetch
      const [revenueRes, vehicleRes, occRes] = await Promise.all([
        layThongKeDoanhThu({ fromDate, toDate }),
        layThongKeLoaiXe({ fromDate, toDate }),
        layTiLeLapDay(),
      ]);

      // ---- Doanh thu ----
      if (revenueChartInstance.current) revenueChartInstance.current.destroy();
      const labels = revenueRes.detail.map((d) => d.date);
      const dataValues = revenueRes.detail.map((d) => d.total);
      revenueChartInstance.current = new Chart(revenueChartRef.current, {
        type: "line",
        data: {
          labels,
          datasets: [
            {
              label: "Doanh thu (VNĐ)",
              data: dataValues,
              borderColor: "#3b82f6",
              backgroundColor: "rgba(59,130,246,0.2)",
              tension: 0.2,
            },
          ],
        },
        options: {
          responsive: true,
          plugins: {
            legend: { display: true },
            tooltip: { mode: "index", intersect: false },
          },
          scales: {
            y: {
              ticks: {
                callback: (v) => v.toLocaleString(),
              },
            },
          },
        },
      });

      // ---- Vehicle type counts ----
      if (vehicleChartInstance.current) vehicleChartInstance.current.destroy();
      const vehicleLabels = Object.keys(vehicleRes.data);
      const vehicleData = Object.values(vehicleRes.data);
      const palette = ["#10b981", "#f59e0b", "#ef4444", "#3b82f6", "#8b5cf6"];
      vehicleChartInstance.current = new Chart(vehicleChartRef.current, {
        type: "doughnut",
        data: {
          labels: vehicleLabels,
          datasets: [
            {
              data: vehicleData,
              backgroundColor: palette.slice(0, vehicleLabels.length),
            },
          ],
        },
        options: { responsive: true, plugins: { legend: { position: "bottom" } } },
      });

      // ---- Occupancy ----
      if (occupancyChartInstance.current) occupancyChartInstance.current.destroy();
      occupancyChartInstance.current = new Chart(occupancyChartRef.current, {
        type: "bar",
        data: {
          labels: ["Tổng", "Đang sử dụng"],
          datasets: [
            {
              label: "Slots",
              data: [occRes.totalSlots, occRes.occupied],
              backgroundColor: ["#3b82f6", "#ef4444"],
            },
          ],
        },
        options: {
          responsive: true,
          scales: {
            y: { beginAtZero: true },
          },
          plugins: { legend: { display: false } },
        },
      });
    } catch (err) {
      console.error(err);
      setError(err.message || "Lỗi tải dữ liệu");
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchData();
    // cleanup charts on unmount
    return () => {
      revenueChartInstance.current && revenueChartInstance.current.destroy();
      vehicleChartInstance.current && vehicleChartInstance.current.destroy();
      occupancyChartInstance.current && occupancyChartInstance.current.destroy();
    };
  }, [preset]);

  return (
    <div className="dialog-overlay" style={{ zIndex: 9999 }}>
      <div className="dialog-container" style={{ width: "90%", maxWidth: 1200 }}>
        <div className="dialog-header">
          <h2>Thống kê bãi xe</h2>
          <button className="close-btn" onClick={onClose}>Đóng</button>
        </div>
        <div className="dialog-body" style={{ overflowY: "auto", maxHeight: "80vh" }}>
          <div style={{ marginBottom: 16 }}>
            <label style={{ marginRight: 8 }}>Khoảng thời gian:</label>
            <select value={preset} onChange={(e) => setPreset(e.target.value)}>
              <option value="today">Hôm nay</option>
              <option value="30d">30 ngày</option>
              <option value="3m">3 tháng</option>
              <option value="6m">6 tháng</option>
            </select>
          </div>
          {loading && <p>Đang tải dữ liệu...</p>}
          {error && <p style={{ color: "red" }}>{error}</p>}
          <div style={{ display: "grid", gridTemplateColumns: "1fr 1fr", gap: 24 }}>
            <div>
              <canvas ref={revenueChartRef}></canvas>
            </div>
            <div>
              <canvas ref={vehicleChartRef}></canvas>
            </div>
          </div>
          <div style={{ marginTop: 32 }}>
            <canvas ref={occupancyChartRef}></canvas>
          </div>
        </div>
      </div>
    </div>
  );
};

export default StatisticsPage;
