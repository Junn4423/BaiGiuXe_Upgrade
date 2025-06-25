"use client"

import React, { useState, useRef } from "react"

const QuanLyCamera = () => {
  const [currentCamera, setCurrentCamera] = useState("vao")
  const [rtspUrls, setRtspUrls] = useState({
    cameraIn: null,
    cameraOut: null,
    cameraInFace: null,
    cameraOutFace: null,
  })
  const [lastFrames, setLastFrames] = useState({
    cameraIn: null,
    cameraOut: null,
    cameraInFace: null,
    cameraOutFace: null,
  })
  const [capturedImage, setCapturedImage] = useState(null)
  const [cameraRunning, setCameraRunning] = useState(false)
  const [licensePlateApi, setLicensePlateApi] = useState(null)

  const cameraThreads = useRef({})

  // Start cameras
  const startCamera = () => {
    setCameraRunning(true)
    console.log("Starting cameras")

    // Simulate camera feeds
    const simulateCamera = (cameraType) => {
      const interval = setInterval(() => {
        if (!cameraRunning) {
          clearInterval(interval)
          return
        }

        // Generate mock frame data
        const mockFrame = {
          timestamp: Date.now(),
          data: `/placeholder.svg?height=240&width=320&text=${cameraType}`,
        }

        setLastFrames((prev) => ({
          ...prev,
          [cameraType]: mockFrame,
        }))

        console.log(`Frame captured from ${cameraType}`)
      }, 1000 / 30) // 30 FPS

      return interval
    }

    // Start all camera feeds
    cameraThreads.current.cameraIn = simulateCamera("cameraIn")
    cameraThreads.current.cameraOut = simulateCamera("cameraOut")
    cameraThreads.current.cameraInFace = simulateCamera("cameraInFace")
    cameraThreads.current.cameraOutFace = simulateCamera("cameraOutFace")
  }

  // Stop cameras
  const stopCamera = () => {
    setCameraRunning(false)
    console.log("Stopping cameras")

    // Clear all intervals
    Object.values(cameraThreads.current).forEach((interval) => {
      if (interval) clearInterval(interval)
    })

    cameraThreads.current = {}
  }

  // Switch current camera
  const switchCamera = (mode) => {
    setCurrentCamera(mode)
    console.log(`Switched current camera to: ${mode}`)
  }

  // Capture image
  const captureImage = (cardId = null, mode = "vao") => {
    let imagePath = null
    let facePath = null
    let licensePlate = null

    if (cardId) {
      imagePath = `server/images/${cardId}_${Date.now()}.jpg`
      facePath = `server/images/${cardId}_face_${Date.now()}.jpg`
      licensePlate = `XX1234${Math.floor(Math.random() * 1000)}`
    }

    // Log values for testing
    console.log("Capture image:", { cardId, mode, imagePath, licensePlate, facePath })

    setCapturedImage(imagePath)

    return [imagePath, licensePlate, facePath]
  }

  // Load camera list
  const loadCameraList = (zoneCode = null) => {
    try {
      // Mock camera data - replace with actual API call
      const mockCameras = [
        {
          maCamera: "CAM001",
          tenCamera: "Camera Vào 1",
          loaiCamera: "VAO",
          chucNangCamera: "BIENSO",
          maKhuVuc: "KV001",
          linkRTSP: "rtsp://192.168.1.100:554/stream1",
        },
        {
          maCamera: "CAM002",
          tenCamera: "Camera Ra 1",
          loaiCamera: "RA",
          chucNangCamera: "BIENSO",
          maKhuVuc: "KV001",
          linkRTSP: "rtsp://192.168.1.101:554/stream1",
        },
        {
          maCamera: "CAM003",
          tenCamera: "Camera Face Vào",
          loaiCamera: "VAO",
          chucNangCamera: "KHUONMAT",
          maKhuVuc: "KV001",
          linkRTSP: "rtsp://192.168.1.102:554/stream1",
        },
        {
          maCamera: "CAM004",
          tenCamera: "Camera Face Ra",
          loaiCamera: "RA",
          chucNangCamera: "KHUONMAT",
          maKhuVuc: "KV001",
          linkRTSP: "rtsp://192.168.1.103:554/stream1",
        },
      ]

      // Filter by zone if specified
      const filteredCameras = zoneCode ? mockCameras.filter((cam) => cam.maKhuVuc === zoneCode) : mockCameras

      // Reset URLs
      const newUrls = {
        cameraIn: null,
        cameraOut: null,
        cameraInFace: null,
        cameraOutFace: null,
      }

      // Assign URLs based on camera type and function
      filteredCameras.forEach((cam) => {
        const { loaiCamera, chucNangCamera, linkRTSP } = cam

        if (loaiCamera === "VAO" && chucNangCamera === "BIENSO" && linkRTSP && !newUrls.cameraIn) {
          newUrls.cameraIn = linkRTSP
        } else if (loaiCamera === "RA" && chucNangCamera === "BIENSO" && linkRTSP && !newUrls.cameraOut) {
          newUrls.cameraOut = linkRTSP
        } else if (loaiCamera === "VAO" && chucNangCamera === "KHUONMAT" && linkRTSP && !newUrls.cameraInFace) {
          newUrls.cameraInFace = linkRTSP
        } else if (loaiCamera === "RA" && chucNangCamera === "KHUONMAT" && linkRTSP && !newUrls.cameraOutFace) {
          newUrls.cameraOutFace = linkRTSP
        }
      })

      setRtspUrls(newUrls)

      console.log(`Selected camera URLs for zone ${zoneCode}:`, newUrls)
    } catch (error) {
      console.error("Error loading camera list from API:", error)
    }
  }

  // Expose methods to parent component
  React.useImperativeHandle(
    React.forwardRef(() => null),
    () => ({
      startCamera,
      stopCamera,
      switchCamera,
      captureImage,
      loadCameraList,
    }),
  )

  return (
    <div>
      <h3>QuanLyCamera Logic (No UI)</h3>
      {/* Camera management logic only */}
    </div>
  )
}

export default QuanLyCamera
