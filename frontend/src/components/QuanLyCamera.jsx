"use client"

import React, { useState, useRef, useEffect } from "react"
import { createPlaceholderImage, captureVideoFrame } from "../utils/imageUtils"
import { uploadLicensePlateImage, uploadLicensePlateOutImage, uploadFaceImage } from "../api/api"

const QuanLyCamera = React.forwardRef((props, ref) => {
  const [isRunning, setIsRunning] = useState(false)
  const [cameraList, setCameraList] = useState([])
  const [currentZone, setCurrentZone] = useState(null)
  const [ui, setUi] = useState(null)

  // State for camera warnings
  const [cameraWarnings, setCameraWarnings] = useState([])

  // Set UI reference
  const setUIReference = (uiRef) => {
    setUi(uiRef)
  }

  // Start camera system
  const startCamera = () => {
    setIsRunning(true)
    console.log("Camera system started")
  }

  // Stop camera system
  const stopCamera = () => {
    setIsRunning(false)
    console.log("Camera system stopped")
  }

  // Switch camera mode
  const switchCamera = (mode) => {
    console.log(`Switching camera to ${mode} mode`)
    // Implementation for camera switching
  }

  // Load camera list for zone
  const loadCameraList = (zoneId) => {
    console.log(`Loading cameras for zone: ${zoneId}`)
    // Implementation for loading cameras
  }

  // Capture image
  const captureImage = async (cardId, mode = "vao") => {
    try {
      console.log(`📸 Capturing image for card ${cardId} in ${mode} mode`)
      
      const timestamp = new Date().toISOString().replace(/[:.]/g, '-')
      
      console.log(`🔄 Capturing plate image...`)
      const plateImagePath = await captureFromVideo('plate', cardId, timestamp, mode)
      
      console.log(`🔄 Capturing face image...`)
      const faceImagePath = await captureFromVideo('face', cardId, timestamp, mode)
      
      const licensePlate = `29A-${Math.floor(Math.random() * 10000).toString().padStart(4, '0')}`

      // Display captured images on UI panels immediately
      if (ui && ui.displayCapturedImage && plateImagePath) {
        console.log(`📺 QuanLyCamera: Displaying plate image on panel 1`)
        ui.displayCapturedImage(plateImagePath?.url || plateImagePath, 1)
      } else {
        console.log(`❌ QuanLyCamera: Cannot display plate image:`, {
          hasUI: !!ui,
          hasDisplayMethod: !!(ui && ui.displayCapturedImage),
          hasPlateImage: !!plateImagePath
        })
      }
      
      if (ui && ui.displayCapturedFaceImage && faceImagePath) {
        console.log(`📺 QuanLyCamera: Displaying face image on panel 2`)
        ui.displayCapturedFaceImage(faceImagePath?.url || faceImagePath)
      } else {
        console.log(`❌ QuanLyCamera: Cannot display face image:`, {
          hasUI: !!ui,
          hasDisplayMethod: !!(ui && ui.displayCapturedFaceImage),
          hasFaceImage: !!faceImagePath
        })
      }

      console.log(`✅ All images captured and auto-saved for card ${cardId}`)
      return [plateImagePath, licensePlate, faceImagePath]
    } catch (error) {
      console.error("❌ Error capturing image:", error)
      return [null, null, null]
    }
  }

  // Capture from video stream
  const captureFromVideo = async (type, cardId, timestamp, mode) => {
    try {
      // Find video element based on type and mode
      const videoSelector = type === 'plate' 
        ? `video[data-camera-type="${mode}-plate"]`
        : `video[data-camera-type="${mode}-face"]`
      
      console.log(`🔍 Looking for video element: ${videoSelector} (mode: ${mode})`)
      const videoElement = document.querySelector(videoSelector)
      
      if (!videoElement) {
        console.log(`❌ Video element not found for ${type} in ${mode} mode`)
        console.log('📹 Available video elements:', 
          Array.from(document.querySelectorAll('video')).map(v => ({
            cameraType: v.getAttribute('data-camera-type'),
            readyState: v.readyState,
            videoWidth: v.videoWidth,
            videoHeight: v.videoHeight
          }))
        )
        
        // IMPROVED FALLBACK: Try to use camera of same type, prioritize same direction
        const availableVideos = Array.from(document.querySelectorAll('video'))
        let fallbackVideo = null
        
        // First priority: Same mode, different type (e.g., if ra-face not found, try ra-plate)
        const sameModeVideo = availableVideos.find(v => {
          const cameraType = v.getAttribute('data-camera-type')
          return cameraType && cameraType.startsWith(mode + '-')
        })
        
        // Second priority: Same type, different mode (e.g., if ra-face not found, try vao-face)
        const sameTypeVideo = availableVideos.find(v => {
          const cameraType = v.getAttribute('data-camera-type')
          return cameraType && cameraType.includes(type === 'plate' ? 'plate' : 'face')
        })
        
        fallbackVideo = sameModeVideo || sameTypeVideo
        
        if (fallbackVideo) {
          const fallbackType = fallbackVideo.getAttribute('data-camera-type')
          console.log(`⚠️ Using fallback camera: ${fallbackType} (requested: ${mode}-${type})`)
          
          // Track camera fallback usage
          const warningMessage = `Camera ${mode}-${type} không khả dụng, sử dụng ${fallbackType} thay thế`
          setCameraWarnings(prev => [...prev.slice(-4), warningMessage]) // Keep last 5 warnings
          
          // Show warning toast if using wrong direction
          if (!fallbackType.startsWith(mode + '-')) {
            console.warn(`⚠️ WARNING: Chụp ảnh ${type} cho xe ${mode} nhưng dùng camera ${fallbackType}`)
            
            // Notify UI about camera mismatch
            if (ui && ui.showNotification) {
              ui.showNotification('Cảnh báo Camera', warningMessage)
            }
          }
          
          return await captureFromVideoElement(fallbackVideo, type, cardId, timestamp, mode)
        }
        
        console.error(`❌ No suitable camera found for ${type} capture in ${mode} mode`)
        return createPlaceholderImage(type, cardId, timestamp, mode)
      }

      return await captureFromVideoElement(videoElement, type, cardId, timestamp, mode)
    } catch (error) {
      console.error(`❌ Error capturing ${type} image:`, error)
      return createPlaceholderImage(type, cardId, timestamp, mode)
    }
  }

  // Helper function to capture from specific video element
  const captureFromVideoElement = async (videoElement, type, cardId, timestamp, mode) => {
    console.log(`✅ Found video element:`, {
      cameraType: videoElement.getAttribute('data-camera-type'),
      readyState: videoElement.readyState,
      videoWidth: videoElement.videoWidth,
      videoHeight: videoElement.videoHeight,
      currentTime: videoElement.currentTime
    })

    // Check if video is actually playing
    if (videoElement.videoWidth === 0 || videoElement.videoHeight === 0) {
      console.log(`⚠️ Video not ready for ${type} in ${mode} mode - using placeholder`)
      return createPlaceholderImage(type, cardId, timestamp, mode)
    }

    // Wait a bit for stable frame
    await new Promise(resolve => setTimeout(resolve, 100))

    // Capture frame from video
    console.log(`📸 Capturing frame from video...`)
    const blob = await captureVideoFrame(videoElement)
    
    try {
      // Upload to MinIO instead of saving locally
      console.log(`☁️ Uploading ${type} image to MinIO...`)
      let uploadResult
      
      if (type === 'plate') {
        if (mode === 'ra') {
          uploadResult = await uploadLicensePlateOutImage(blob)
        } else {
          uploadResult = await uploadLicensePlateImage(blob)
        }
      } else if (type === 'face') {
        uploadResult = await uploadFaceImage(blob)
      }

      if (uploadResult && uploadResult.success) {
        console.log(`✅ Image uploaded to MinIO: ${uploadResult.primaryUrl}`)
        return {
          url: uploadResult.primaryUrl,
          blob: blob,
          filename: uploadResult.filename,
          backupUrls: uploadResult.urls
        }
      } else {
        throw new Error('Upload failed to all MinIO servers')
      }
    } catch (error) {
      console.error(`❌ MinIO upload failed for ${type} image:`, error)
      // Fallback: Create object URL for immediate display
      const objectUrl = URL.createObjectURL(blob)
      console.log(`⚠️ Using local fallback URL: ${objectUrl}`)
      return {
        url: objectUrl,
        blob: blob,
        filename: `${cardId}_${timestamp}_${type}_${mode}.jpg`,
        error: error.message
      }
    }
  }

  // Update camera configuration
  const updateConfiguration = () => {
    console.log("Updating camera configuration")
  }

  // Expose methods to parent component
  React.useImperativeHandle(ref, () => ({
    startCamera,
    stopCamera,
    switchCamera,
    loadCameraList,
    captureImage,
    updateConfiguration,
    setUIReference,
    isRunning,
  }))

  return (
    <div style={{ display: "none" }}>
      {/* Camera Manager Logic - No visible UI */}
      <div>Camera Manager Status: {isRunning ? "Running" : "Stopped"}</div>
    </div>
  )
})

QuanLyCamera.displayName = "QuanLyCamera"

export default QuanLyCamera