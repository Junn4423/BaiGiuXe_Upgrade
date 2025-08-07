"use client"

import React, { useState, useRef, useEffect } from "react"
import { createPlaceholderImage, captureVideoFrame, saveImageToAssets } from "../utils/imageUtils"
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

  // Upload images after successful session creation - CHỈ KHI PHIÊN GỬI XE THÀNH CÔNG
  const uploadCapturedImages = async (plateImage, faceImage) => {
    console.log('📀 Starting upload to disk after successful session...')
    const results = {
      plateUpload: null,
      faceUpload: null,
      errors: []
    }

    try {
      // Upload plate image if available and has blob data
      if (plateImage && plateImage.blob && plateImage.pendingUpload) {
        console.log('💾 Uploading plate image to disk...', {
          filename: plateImage.filename,
          mode: plateImage.mode,
          hasBlob: !!plateImage.blob
        })
        
        let uploadResult
        
        if (plateImage.mode === 'ra') {
          uploadResult = await uploadLicensePlateOutImage(plateImage.blob, {
            updateType: 'plate_out',
            filename: plateImage.filename // ✅ Use original filename
          })
        } else {
          uploadResult = await uploadLicensePlateImage(plateImage.blob, {
            updateType: 'plate_in',
            filename: plateImage.filename // ✅ Use original filename
          })
        }
        
        if (uploadResult && uploadResult.success) {
          results.plateUpload = uploadResult
          plateImage.uploaded = true
          plateImage.pendingUpload = false
          console.log('✅ Plate image uploaded to disk successfully:', uploadResult.primaryUrl)
        } else {
          throw new Error('Plate image disk upload failed')
        }
      } else {
        console.log('⚠️ No plate image data for disk upload')
      }

      // Upload face image if available and has blob data
      if (faceImage && faceImage.blob && faceImage.pendingUpload) {
        console.log('💾 Uploading face image to disk...', {
          filename: faceImage.filename,
          mode: faceImage.mode,
          hasBlob: !!faceImage.blob
        })
        
        const updateType = faceImage.mode === 'ra' ? 'face_out' : 'face_in'
        const uploadResult = await uploadFaceImage(faceImage.blob, {
          updateType: updateType,
          filename: faceImage.filename // ✅ Use original filename
        })
        
        if (uploadResult && uploadResult.success) {
          results.faceUpload = uploadResult
          faceImage.uploaded = true
          faceImage.pendingUpload = false
          console.log('✅ Face image uploaded to disk successfully:', uploadResult.primaryUrl)
        } else {
          throw new Error('Face image disk upload failed')
        }
      } else {
        console.log('⚠️ No face image data for disk upload')
      }

      console.log('✅ All images uploaded to disk successfully after session success:', results)
      return results

    } catch (error) {
      console.error('❌ Error uploading images to disk:', error)
      results.errors.push(error.message)
      return results
    }
  }

  // Capture image - CHỈ CHỤP VÀ HIỂN THỊ, CHƯA LƯU VÀO Ổ ĐĨA
  const captureImage = async (cardId, mode = "vao") => {
    try {
      console.log(`📸 Capturing image for card ${cardId} in ${mode} mode (memory only, no disk save yet)`)
      
      const timestamp = new Date().toISOString().replace(/[:.]/g, '-')
      
      console.log(`Capturing plate image...`)
      const plateImagePath = await captureFromVideo('plate', cardId, timestamp, mode)
      
      console.log(`Capturing face image...`)
      const faceImagePath = await captureFromVideo('face', cardId, timestamp, mode)
      
      const licensePlate = `29A-${Math.floor(Math.random() * 10000).toString().padStart(4, '0')}`

      // **HIỂN THỊ ẢNH NGAY SAU KHI CHỤP** (trước khi lưu vào ổ đĩa)
      if (ui && ui.displayCapturedImage && plateImagePath) {
        console.log(`📸 QuanLyCamera: Displaying plate image on panel 1`)
        ui.displayCapturedImage(plateImagePath?.url || plateImagePath, 1)
      } else {
        console.log(`⚠️ QuanLyCamera: Cannot display plate image:`, {
          hasUI: !!ui,
          hasDisplayMethod: !!(ui && ui.displayCapturedImage),
          hasPlateImage: !!plateImagePath,
          plateImageUrl: plateImagePath?.url
        })
      }
      
      if (ui && ui.displayCapturedFaceImage && faceImagePath) {
        console.log(`📸 QuanLyCamera: Displaying face image on panel 2`)
        ui.displayCapturedFaceImage(faceImagePath?.url || faceImagePath)
      } else {
        console.log(`⚠️ QuanLyCamera: Cannot display face image:`, {
          hasUI: !!ui,
          hasDisplayMethod: !!(ui && ui.displayCapturedFaceImage),
          hasFaceImage: !!faceImagePath,
          faceImageUrl: faceImagePath?.url
        })
      }

      console.log(`✅ Images captured and displayed for card ${cardId} (in memory only, awaiting session success for disk save)`)
      return [plateImagePath, licensePlate, faceImagePath]
    } catch (error) {
      console.error("Error capturing image:", error)
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
      
      console.log(`Looking for video element: ${videoSelector} (mode: ${mode})`)
      const videoElement = document.querySelector(videoSelector)
      
      if (!videoElement) {
        console.log(`Video element not found for ${type} in ${mode} mode`)
        console.log('Available video elements:', 
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
          console.log(`Using fallback camera: ${fallbackType} (requested: ${mode}-${type})`)
          
          // Track camera fallback usage
          const warningMessage = `Camera ${mode}-${type} không khả dụng, sử dụng ${fallbackType} thay thế`
          setCameraWarnings(prev => [...prev.slice(-4), warningMessage]) // Keep last 5 warnings
          
          // Show warning toast if using wrong direction
          if (!fallbackType.startsWith(mode + '-')) {
            console.warn(`WARNING: Chụp ảnh ${type} cho xe ${mode} nhưng dùng camera ${fallbackType}`)
            
            // Notify UI about camera mismatch
            if (ui && ui.showNotification) {
              ui.showNotification('Cảnh báo Camera', warningMessage)
            }
          }
          
          return await captureFromVideoElement(fallbackVideo, type, cardId, timestamp, mode)
        }
        
        console.error(`No suitable camera found for ${type} capture in ${mode} mode`)
        return await createFallbackImageObject(type, cardId, timestamp, mode)
      }

      return await captureFromVideoElement(videoElement, type, cardId, timestamp, mode)
    } catch (error) {
      console.error(`Error capturing ${type} image:`, error)
      return await createFallbackImageObject(type, cardId, timestamp, mode)
    }
  }

  // Helper function to create fallback image object (consistency with new format)
  const createFallbackImageObject = async (type, cardId, timestamp, mode) => {
    try {
      const placeholderUrl = createPlaceholderImage(type, cardId, timestamp, mode)
      
      // Convert data URL to blob for consistency
      const response = await fetch(placeholderUrl)
      const blob = await response.blob()
      const objectUrl = URL.createObjectURL(blob)
      
      return {
        url: objectUrl,
        blob: blob,
        timestamp: timestamp,
        cardId: cardId,
        type: type,
        mode: mode,
        filename: `${cardId}_${timestamp}_${type}_${mode}_placeholder.jpg`,
        uploaded: false,
        pendingUpload: true,
        temporaryOnly: true,
        isPlaceholder: true // Mark as placeholder
      }
    } catch (error) {
      console.error('Error creating fallback image object:', error)
      const placeholderUrl = createPlaceholderImage(type, cardId, timestamp, mode)
      
      // Emergency fallback - return minimal object with data URL
      return {
        url: placeholderUrl, // Use data URL directly
        blob: null,
        timestamp: timestamp,
        cardId: cardId,
        type: type,
        mode: mode,
        filename: `${cardId}_${timestamp}_${type}_${mode}_placeholder.jpg`,
        uploaded: false,
        pendingUpload: false, // Can't upload data URL
        temporaryOnly: true,
        isPlaceholder: true,
        error: 'Failed to create blob from placeholder'
      }
    }
  }

  // Helper function to capture from specific video element
  const captureFromVideoElement = async (videoElement, type, cardId, timestamp, mode) => {
    console.log(`Found video element:`, {
      cameraType: videoElement.getAttribute('data-camera-type'),
      readyState: videoElement.readyState,
      videoWidth: videoElement.videoWidth,
      videoHeight: videoElement.videoHeight,
      currentTime: videoElement.currentTime
    })

    // Check if video is actually playing
    if (videoElement.videoWidth === 0 || videoElement.videoHeight === 0) {
      console.log(`Video not ready for ${type} in ${mode} mode - using placeholder`)
      return await createFallbackImageObject(type, cardId, timestamp, mode)
    }

    // Wait a bit for stable frame
    await new Promise(resolve => setTimeout(resolve, 100))

    // Capture frame from video
    console.log(`Capturing frame from video...`)
    const blob = await captureVideoFrame(videoElement)
    
    try {
      // **CHANGE: Chỉ tạo object URL tạm thời, KHÔNG lưu vào ổ đĩa ngay lập tức**
      console.log(`Creating temporary object URL for ${type} image (mode: ${mode}) - NOT saving to disk yet...`)
      
      // Create object URL for immediate display only
      const objectUrl = URL.createObjectURL(blob)
      
      // Return result with blob for later upload (only when session succeeds)
      const finalResult = {
        url: objectUrl, // For immediate display
        blob: blob, // For later upload
        timestamp: timestamp,
        cardId: cardId,
        type: type,
        mode: mode,
        filename: `${cardId}_${timestamp}_${type}_${mode}.jpg`,
        // Mark as not yet uploaded to disk
        uploaded: false,
        pendingUpload: true,
        temporaryOnly: true // Flag indicating this is only in memory
      }
      
      console.log(`${type} image prepared for ${mode} (in memory only, awaiting session success):`, {
        filename: finalResult.filename,
        hasBlob: !!finalResult.blob,
        hasUrl: !!finalResult.url,
        pendingUpload: finalResult.pendingUpload
      })
      return finalResult
    } catch (error) {
      console.error(`Temporary image processing failed for ${type} image:`, error)
      // Fallback: Create object URL for immediate display only
      const objectUrl = URL.createObjectURL(blob)
      console.log(`Using emergency fallback URL (memory only): ${objectUrl}`)
      return {
        url: objectUrl,
        blob: blob,
        filename: `${cardId}_${timestamp}_${type}_${mode}.jpg`,
        error: error.message,
        temporaryOnly: true,
        pendingUpload: true // Still mark as pending for potential retry
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
    uploadCapturedImages,
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