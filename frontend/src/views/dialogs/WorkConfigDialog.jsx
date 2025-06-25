"use client"

import { useEffect, useState } from "react"
import "../../assets/styles/WorkConfigDialog.css"
import { layDanhSachKhuVuc, layALLLoaiPhuongTien, refreshAuthToken } from "../../api/api"

const WorkConfigDialog = ({ onConfigSaved, onClose }) => {
  const [zones, setZones] = useState([]) // full object
  const [vehicleTypes, setVehicleTypes] = useState([]) // full object
  const [selectedZone, setSelectedZone] = useState(null) // object
  const [selectedVehicleType, setSelectedVehicleType] = useState(null) // object
  const [saving, setSaving] = useState(false)
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState("")

  useEffect(() => {
    fetchData()
  }, [])

  const fetchData = async () => {
    try {
      setLoading(true)
      setError("")

      console.log("WorkConfigDialog: Refreshing auth token...")
      // Luôn refresh token trước khi load data
      await refreshAuthToken()

      console.log("WorkConfigDialog: Loading zones and vehicle types...")

      // Load zones
      const zonesData = await layDanhSachKhuVuc()
      console.log("WorkConfigDialog: Zones data:", zonesData)
      setZones(Array.isArray(zonesData) ? zonesData : [])

      // Load vehicle types
      const vehicleData = await layALLLoaiPhuongTien()
      console.log("WorkConfigDialog: Vehicle types data:", vehicleData)
      setVehicleTypes(Array.isArray(vehicleData) ? vehicleData : [])
    } catch (e) {
      console.error("WorkConfigDialog: Error loading data:", e)
      setError("Không thể tải dữ liệu khu vực hoặc loại xe: " + e.message)
      setZones([])
      setVehicleTypes([])
    } finally {
      setLoading(false)
    }
  }

  // Xử lý chọn khu vực
  const handleZoneChange = (e) => {
    const zoneObj = zones.find((z) => (z.tenKhuVuc || z.name) === e.target.value)
    console.log("Selected zone:", zoneObj)
    setSelectedZone(zoneObj || null)
  }

  // Xử lý chọn loại xe
  const handleVehicleTypeChange = (e) => {
    const vtObj = vehicleTypes.find((v) => (v.tenLoaiPT || v.name) === e.target.value)
    console.log("Selected vehicle type:", vtObj)
    setSelectedVehicleType(vtObj || null)
  }

  const handleSave = async () => {
    setSaving(true)
    setError("")
    try {
      if (!selectedZone || !selectedVehicleType) {
        throw new Error("Chưa chọn đủ thông tin")
      }

      // Build config đúng format
      const config = {
        zone: selectedZone.tenKhuVuc || selectedZone.name,
        zone_data: selectedZone,
        vehicle_type: selectedVehicleType.tenLoaiPT || selectedVehicleType.name,
        loai_xe: selectedVehicleType.maLoaiPT || selectedVehicleType.code || "",
        ma_khu_vuc: selectedZone.maKhuVuc || selectedZone.code || "",
      }

      console.log("Saving work config:", config)
      localStorage.setItem("work_config", JSON.stringify(config))

      if (onConfigSaved) onConfigSaved(config)
      if (onClose) onClose()
    } catch (e) {
      console.error("Error saving config:", e)
      setError("Lỗi khi lưu cấu hình: " + e.message)
    }
    setSaving(false)
  }

  const handleRefresh = () => {
    console.log("Refreshing data...")
    fetchData()
  }

  return (
    <div className="workconfig-dialog-overlay">
      <div className="workconfig-dialog">
        <div className="workconfig-title-bar">
          <span className="workconfig-title">Cấu hình làm việc</span>
          <button className="workconfig-close" onClick={onClose}>
            ✕
          </button>
        </div>

        <div className="workconfig-header">
          Vui lòng chọn khu vực và loại xe để bắt đầu
          <button className="refresh-button" onClick={handleRefresh} disabled={loading}>
            {loading ? "Đang tải..." : "Làm mới"}
          </button>
        </div>

        <div className="workconfig-content">
          {loading ? (
            <div className="loading-message">Đang tải dữ liệu...</div>
          ) : (
            <>
              <div className="workconfig-card">
                <div className="workconfig-card-title">Chọn khu vực làm việc</div>
                <select
                  className="workconfig-select"
                  value={selectedZone ? selectedZone.tenKhuVuc || selectedZone.name : ""}
                  onChange={handleZoneChange}
                  disabled={loading}
                >
                  <option value="">-- Chọn khu vực --</option>
                  {zones.map((z, i) => (
                    <option key={i} value={z.tenKhuVuc || z.name}>
                      {z.tenKhuVuc || z.name}
                    </option>
                  ))}
                </select>
                <div className="data-info">Có {zones.length} khu vực</div>
              </div>

              <div className="workconfig-card">
                <div className="workconfig-card-title">Chọn loại xe</div>
                <select
                  className="workconfig-select"
                  value={selectedVehicleType ? selectedVehicleType.tenLoaiPT || selectedVehicleType.name : ""}
                  onChange={handleVehicleTypeChange}
                  disabled={loading}
                >
                  <option value="">-- Chọn loại xe --</option>
                  {vehicleTypes.map((v, i) => (
                    <option key={i} value={v.tenLoaiPT || v.name}>
                      {v.tenLoaiPT || v.name}
                    </option>
                  ))}
                </select>
                <div className="data-info">Có {vehicleTypes.length} loại xe</div>
              </div>

              <div className="workconfig-card">
                <div className="workconfig-card-title">Cấu hình hiện tại</div>
                <div className="workconfig-config-text">
                  Khu vực: {selectedZone ? selectedZone.tenKhuVuc || selectedZone.name : "Chưa chọn"}
                  <br />
                  Loại xe:{" "}
                  {selectedVehicleType ? selectedVehicleType.tenLoaiPT || selectedVehicleType.name : "Chưa chọn"}
                </div>
              </div>
            </>
          )}
        </div>

        {error && <div className="workconfig-error">{error}</div>}

        <div className="workconfig-footer">
          <button
            className="workconfig-start-btn"
            onClick={handleSave}
            disabled={saving || loading || !selectedZone || !selectedVehicleType}
          >
            {saving ? "Đang lưu..." : "BẮT ĐẦU LÀM VIỆC"}
          </button>
        </div>
      </div>
    </div>
  )
}

export default WorkConfigDialog
