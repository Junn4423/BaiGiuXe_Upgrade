"use client"

import { useState } from "react"
import { layALLChinhSachGia } from "../../api/api"
import PricingPolicyDialogNew from "./PricingPolicyDialogNew"
import WorkConfigDialog from "./WorkConfigDialog"
import "../../assets/styles/StartupDialog.css"
import "../../assets/styles/global-dialog-theme.css"

const StartupDialog = ({ isOpen, onClose, onResult }) => {
  const [showPricingDialog, setShowPricingDialog] = useState(false)
  const [showWorkConfigDialog, setShowWorkConfigDialog] = useState(false)

  const handleBatDauLamViec = () => {
    setShowWorkConfigDialog(true)
  }

  const handleCauHinhCamera = () => {
    if (onResult) {
      onResult({ action: "config" })
    }
    onClose()
  }

  const handleCauHinhChinhSachGia = async () => {
    try {
      const policies = await layALLChinhSachGia()
      if (!policies || policies.length === 0) {
        alert("Không có dữ liệu chính sách giá")
        return
      }
      setShowPricingDialog(true)
    } catch (error) {
      console.error("Lỗi tải chính sách giá:", error)
      alert("Không thể mở cấu hình chính sách giá")
    }
  }

  const handleWorkConfigResult = (config) => {
    setShowWorkConfigDialog(false)
    if (config) {
      if (onResult) {
        onResult({
          action: "start",
          config: config,
        })
      }
      onClose()
    }
  }

  const handlePricingDialogClose = () => {
    setShowPricingDialog(false)
  }

  if (!isOpen) return null

  return (
    <>
      <div className="startup-overlay">
        <div className="startup-dialog">
          <div className="startup-header">
            <h2>Chọn Chế Độ Khởi Động</h2>
          </div>

          <div className="startup-content">
            <button className="startup-btn start-work" onClick={handleBatDauLamViec}>
              Bắt Đầu Phiên Làm Việc
            </button>

            <button className="startup-btn config-camera" onClick={handleCauHinhCamera}>
              Cấu Hình Camera
            </button>

            <button className="startup-btn config-pricing" onClick={handleCauHinhChinhSachGia}>
              Cấu Hình Chính Sách Giá
            </button>
          </div>
        </div>
      </div>

      {/* Work Config Dialog */}
      {showWorkConfigDialog && (
        <WorkConfigDialog
          isOpen={showWorkConfigDialog}
          onClose={() => setShowWorkConfigDialog(false)}
          onResult={handleWorkConfigResult}
        />
      )}

      {/* Pricing Policy Dialog */}
      {showPricingDialog && <PricingPolicyDialogNew onClose={() => setShowPricingDialog(false)} />}
    </>
  )
}

export default StartupDialog
