"use client"

import React, { useState, useRef, useEffect, useMemo } from "react"
import RTSPPlayer from "./RTSPPlayer"
import "../assets/styles/CameraComponent.css"

const CameraComponent = ({ currentMode = "vao", zoneInfo }) => {
  const [staticImageStates, setStaticImageStates] = useState({
    capturePanel1: false,
    capturePanel2: false,
  })

  const [licensePlateTexts, setLicensePlateTexts] = useState({
    in: "",
    out: "",
  })

  const [cameraFeeds, setCameraFeeds] = useState({
    capturePanel1:
      "data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIwIiBoZWlnaHQ9IjI0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPsOCbmggQ2jhu6VwIEJpZW4gU+G7kTwvdGV4dD48L3N2Zz4=",
    capturePanel2:
      "data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIwIiBoZWlnaHQ9IjI0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPsOCbmggQ2jhu6VwIEtodcO0biBN4bq3dDwvdGV4dD48L3N2Zz4=",
  })

  const [cameraStatus, setCameraStatus] = useState({
    cameraInPlate: "online",
    cameraInFace: "online",
    cameraOutPlate: "online",
    cameraOutFace: "online",
  })

  const restoreTimer = useRef(null)

  // Memoize camera data để tránh re-render không cần thiết
  const cameraData = useMemo(() => {
    if (!zoneInfo) return {}

    console.log(`🎯 Memoizing camera data for zone:`, zoneInfo.maKhuVuc)

    return {
      cameraInPlate: {
        camera: zoneInfo.cameraVao?.find((c) => c.chucNangCamera === "BIENSO"),
        rtspUrl: zoneInfo.cameraVao?.find((c) => c.chucNangCamera === "BIENSO")?.linkRTSP || null,
        cameraId: zoneInfo.cameraVao?.find((c) => c.chucNangCamera === "BIENSO")?.maCamera || "unknown",
        name: zoneInfo.cameraVao?.find((c) => c.chucNangCamera === "BIENSO")?.tenCamera || "Camera Vào Biển Số",
      },
      cameraInFace: {
        camera: zoneInfo.cameraVao?.find((c) => c.chucNangCamera === "KHUONMAT"),
        rtspUrl: zoneInfo.cameraVao?.find((c) => c.chucNangCamera === "KHUONMAT")?.linkRTSP || null,
        cameraId: zoneInfo.cameraVao?.find((c) => c.chucNangCamera === "KHUONMAT")?.maCamera || "unknown",
        name: zoneInfo.cameraVao?.find((c) => c.chucNangCamera === "KHUONMAT")?.tenCamera || "Camera Vào Khuôn Mặt",
      },
      cameraOutPlate: {
        camera: zoneInfo.cameraRa?.find((c) => c.chucNangCamera === "BIENSO"),
        rtspUrl: zoneInfo.cameraRa?.find((c) => c.chucNangCamera === "BIENSO")?.linkRTSP || null,
        cameraId: zoneInfo.cameraRa?.find((c) => c.chucNangCamera === "BIENSO")?.maCamera || "unknown",
        name: zoneInfo.cameraRa?.find((c) => c.chucNangCamera === "BIENSO")?.tenCamera || "Camera Ra Biển Số",
      },
      cameraOutFace: {
        camera: zoneInfo.cameraRa?.find((c) => c.chucNangCamera === "KHUONMAT"),
        rtspUrl: zoneInfo.cameraRa?.find((c) => c.chucNangCamera === "KHUONMAT")?.linkRTSP || null,
        cameraId: zoneInfo.cameraRa?.find((c) => c.chucNangCamera === "KHUONMAT")?.maCamera || "unknown",
        name: zoneInfo.cameraRa?.find((c) => c.chucNangCamera === "KHUONMAT")?.tenCamera || "Camera Ra Khuôn Mặt",
      },
    }
  }, [zoneInfo]) // Chỉ re-memoize khi zone thực sự thay đổi

  // Restore capture panels
  const restoreCaptureFeeds = () => {
    console.log("Restoring capture panels...")
    setStaticImageStates({
      capturePanel1: false,
      capturePanel2: false,
    })

    if (restoreTimer.current) {
      clearTimeout(restoreTimer.current)
      restoreTimer.current = null
    }
  }

  // Display captured image on capture panel
  const displayCapturedImage = (imagePath, panelNumber = 1) => {
    if (!imagePath) {
      console.log(`Image does not exist: ${imagePath}`)
      return
    }

    if (restoreTimer.current) {
      clearTimeout(restoreTimer.current)
    }

    const panelKey = `capturePanel${panelNumber}`
    setStaticImageStates((prev) => ({ ...prev, [panelKey]: true }))
    setCameraFeeds((prev) => ({ ...prev, [panelKey]: imagePath }))

    console.log(`Displayed captured image on ${panelKey}: ${imagePath}`)
    restoreTimer.current = setTimeout(restoreCaptureFeeds, 6000)
  }

  // Display captured face image
  const displayCapturedFaceImage = (imagePath) => {
    displayCapturedImage(imagePath, 2)
  }

  // Display entry images after successful exit
  const displayEntryImagesAfterExit = (entryImageUrl, entryFaceUrl) => {
    console.log(`Display entry images after successful exit - Plate: ${entryImageUrl}, Face: ${entryFaceUrl}`)

    if (restoreTimer.current) {
      clearTimeout(restoreTimer.current)
    }

    if (entryImageUrl) {
      setStaticImageStates((prev) => ({ ...prev, capturePanel1: true }))
      setCameraFeeds((prev) => ({ ...prev, capturePanel1: entryImageUrl }))
    }

    if (entryFaceUrl) {
      setStaticImageStates((prev) => ({ ...prev, capturePanel2: true }))
      setCameraFeeds((prev) => ({ ...prev, capturePanel2: entryFaceUrl }))
    }

    restoreTimer.current = setTimeout(restoreCaptureFeeds, 6000)
  }

  // Update license plate display
  const updateLicensePlateDisplay = (licensePlate, fee = null, direction = "in") => {
    const displayText = fee !== null ? `${licensePlate} - ${fee.toLocaleString()} VNĐ` : licensePlate || ""
    setLicensePlateTexts((prev) => ({
      ...prev,
      [direction]: displayText,
    }))
  }

  // Update camera frame with live feed
  const updateCameraFrame = (cameraType, imageData) => {
    // This method is kept for compatibility but live feeds are handled by RTSPPlayer
    console.log(`updateCameraFrame called for ${cameraType}`)
  }

  // Set camera status
  const setCameraStatusState = (cameraType, status) => {
    setCameraStatus((prev) => ({ ...prev, [cameraType]: status }))
  }

  // Handle camera connection events - memoize để tránh re-render
  const handleCameraConnected = React.useCallback((cameraType) => {
    console.log(`Camera ${cameraType} connected`)
    setCameraStatusState(cameraType, "online")
  }, [])

  const handleCameraError = React.useCallback((cameraType, error) => {
    console.error(`Camera ${cameraType} error:`, error)
    setCameraStatusState(cameraType, "offline")
  }, [])

  // Cleanup on unmount
  useEffect(() => {
    return () => {
      if (restoreTimer.current) {
        clearTimeout(restoreTimer.current)
      }
    }
  }, [])

  // Expose methods to parent component
  React.useImperativeHandle(
    React.forwardRef(() => null),
    () => ({
      displayCapturedImage,
      displayCapturedFaceImage,
      displayEntryImagesAfterExit,
      updateLicensePlateDisplay,
      restoreCaptureFeeds,
      updateCameraFrame,
      setCameraStatus: setCameraStatusState,
    }),
  )

  const renderCameraFrame = (cameraKey, title, isActive, showLicensePlate = false, direction = null) => {
    const data = cameraData[cameraKey]
    const status = cameraStatus[cameraKey] || "online"

    if (!data) {
      return (
        <div className={`camera-panel ${isActive ? "active-mode" : ""}`}>
          <div className="panel-header">
            <div className="panel-title">{title}</div>
            <div className="panel-status offline">
              <div className="status-dot"></div>
              <span>OFF</span>
            </div>
          </div>
          <div className="panel-display">
            <div
              style={{
                width: "320px",
                height: "240px",
                background: "#333",
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
                color: "#999",
                fontSize: "12px",
              }}
            >
              No Camera Data
            </div>
          </div>
          <div className="panel-info">Chưa cấu hình</div>
        </div>
      )
    }

    return (
      <div className={`camera-panel ${isActive ? "active-mode" : ""}`}>
        <div className="panel-header">
          <div className="panel-title">{title}</div>
          <div className={`panel-status ${status}`}>
            <div className="status-dot"></div>
            <span>{status === "online" ? "LIVE" : "OFF"}</span>
          </div>
        </div>
        <div className="panel-display">
          {data.rtspUrl && data.rtspUrl.startsWith("rtsp://") ? (
            <RTSPPlayer
              key={`${data.cameraId}-${data.rtspUrl}`} // Key để tránh re-mount không cần thiết
              rtspUrl={data.rtspUrl}
              cameraId={data.cameraId}
              width={320}
              height={240}
              onConnected={() => handleCameraConnected(cameraKey)}
              onError={(error) => handleCameraError(cameraKey, error)}
              className="live-feed"
            />
          ) : (
            <div
              style={{
                width: "320px",
                height: "240px",
                background: "#333",
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
                color: "#999",
                fontSize: "12px",
              }}
            >
              No Valid RTSP URL
            </div>
          )}
        </div>
        <div className="panel-info">{data.name}</div>
        {showLicensePlate && (
          <div className="license-plate-overlay">
            {licensePlateTexts[direction] ? (
              <div className="plate-text">{licensePlateTexts[direction]}</div>
            ) : (
              <div className="plate-placeholder">Chờ nhận diện...</div>
            )}
          </div>
        )}
      </div>
    )
  }

  const renderCapturePanel = (panelKey, title, isStatic) => (
    <div className={`camera-panel ${isStatic ? "has-image" : ""}`}>
      <div className="panel-header">
        <div className="panel-title">{title}</div>
        <div className="panel-status">
          <span>{isStatic ? "CAPTURED" : "READY"}</span>
        </div>
      </div>
      <div className="panel-display">
        <img
          src={cameraFeeds[panelKey] || "/placeholder.svg"}
          alt={title}
          className={isStatic ? "captured-image" : "placeholder"}
          style={{ width: "320px", height: "240px", objectFit: "cover" }}
        />
      </div>
      <div className="panel-info">{isStatic ? "Ảnh đã chụp" : "Chờ chụp ảnh"}</div>
    </div>
  )

  // Debug log để kiểm tra re-render
  console.log(`🔄 CameraComponent render - Zone: ${zoneInfo?.maKhuVuc}, Mode: ${currentMode}`)

  return (
    <div className="camera-container">
      {/* Camera Grid - 3x2 layout */}
      <div className="camera-grid-3x2">
        {/* Row 1: Camera Vào Biển Số, Ảnh Biển Số, Camera Ra Biển Số */}
        {renderCameraFrame("cameraInPlate", "Camera Vào - Biển Số", currentMode === "vao", true, "in")}
        {renderCapturePanel("capturePanel1", "ẢNH CHỤP BIỂN SỐ", staticImageStates.capturePanel1)}
        {renderCameraFrame("cameraOutPlate", "Camera Ra - Biển Số", currentMode === "ra", true, "out")}

        {/* Row 2: Camera Vào Khuôn Mặt, Ảnh Khuôn Mặt, Camera Ra Khuôn Mặt */}
        {renderCameraFrame("cameraInFace", "Camera Vào - Khuôn Mặt", currentMode === "vao")}
        {renderCapturePanel("capturePanel2", "ẢNH CHỤP KHUÔN MẶT", staticImageStates.capturePanel2)}
        {renderCameraFrame("cameraOutFace", "Camera Ra - Khuôn Mặt", currentMode === "ra")}
      </div>
    </div>
  )
}

export default React.memo(CameraComponent) // Memo để tránh re-render không cần thiết
