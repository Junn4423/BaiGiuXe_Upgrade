"use client"

import React, { useState, useRef, useEffect } from "react"
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
    cameraInPlate: "/placeholder.svg?height=240&width=320&text=Camera+Vào+Biển+Số",
    cameraInFace: "/placeholder.svg?height=240&width=320&text=Camera+Vào+Khuôn+Mặt",
    cameraOutPlate: "/placeholder.svg?height=240&width=320&text=Camera+Ra+Biển+Số",
    cameraOutFace: "/placeholder.svg?height=240&width=320&text=Camera+Ra+Khuôn+Mặt",
    capturePanel1: "/placeholder.svg?height=240&width=320&text=Ảnh+Chụp+Biển+Số",
    capturePanel2: "/placeholder.svg?height=240&width=320&text=Ảnh+Chụp+Khuôn+Mặt",
  })

  const [cameraStatus, setCameraStatus] = useState({
    cameraInPlate: "online",
    cameraInFace: "online",
    cameraOutPlate: "online",
    cameraOutFace: "online",
  })

  const restoreTimer = useRef(null)

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

  // Get camera info from zone
  const getCameraInfo = (type) => {
    if (!zoneInfo) return "Chưa cấu hình"

    switch (type) {
      case "cameraInPlate":
        return zoneInfo.cameraVao?.find((c) => c.chucNangCamera === "BIENSO")?.tenCamera || "Camera Vào Biển Số"
      case "cameraInFace":
        return zoneInfo.cameraVao?.find((c) => c.chucNangCamera === "KHUONMAT")?.tenCamera || "Camera Vào Khuôn Mặt"
      case "cameraOutPlate":
        return zoneInfo.cameraRa?.find((c) => c.chucNangCamera === "BIENSO")?.tenCamera || "Camera Ra Biển Số"
      case "cameraOutFace":
        return zoneInfo.cameraRa?.find((c) => c.chucNangCamera === "KHUONMAT")?.tenCamera || "Camera Ra Khuôn Mặt"
      default:
        return "Chưa có"
    }
  }

  // Update camera frame with live feed
  const updateCameraFrame = (cameraType, imageData) => {
    setCameraFeeds((prev) => ({ ...prev, [cameraType]: imageData }))
  }

  // Set camera status
  const setCameraStatusState = (cameraType, status) => {
    setCameraStatus((prev) => ({ ...prev, [cameraType]: status }))
  }

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

  const renderCameraFrame = (cameraKey, title, isActive, showLicensePlate = false, direction = null) => (
    <div className={`camera-panel ${isActive ? "active-mode" : ""}`}>
      <div className="panel-header">
        <div className="panel-title">{title}</div>
        <div className={`panel-status ${cameraStatus[cameraKey] || "online"}`}>
          <div className="status-dot"></div>
          <span>{(cameraStatus[cameraKey] || "online") === "online" ? "LIVE" : "OFF"}</span>
        </div>
      </div>
      <div className="panel-display">
        <img src={cameraFeeds[cameraKey] || "/placeholder.svg"} alt={title} className="live-feed" />
      </div>
      <div className="panel-info">{getCameraInfo(cameraKey)}</div>
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
        />
      </div>
      <div className="panel-info">{isStatic ? "Ảnh đã chụp" : "Chờ chụp ảnh"}</div>
    </div>
  )

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

export default CameraComponent
