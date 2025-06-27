// imageUtils.js - Utility functions for image capture and saving

// Store created URLs for cleanup
const createdUrls = new Set()

/**
 * Clean up object URLs to prevent memory leaks
 */
export const cleanupObjectUrls = () => {
  createdUrls.forEach(url => {
    URL.revokeObjectURL(url)
  })
  createdUrls.clear()
  console.log('🧹 Cleaned up object URLs')
}

/**
 * Save blob as image file to assets folder
 * @param {Blob} blob - Image blob
 * @param {string} fileName - File name
 * @param {string} type - 'plate' or 'face'
 * @returns {Promise<{url: string, blob: Blob}>} - Object URL and original blob
 */
export const saveImageToAssets = async (blob, fileName, type) => {
  try {
    const folderName = type === 'plate' ? 'anhchup_bienso' : 'anhchup_khuonmat'
    
    // Create object URL for immediate display
    const objectUrl = URL.createObjectURL(blob)
    createdUrls.add(objectUrl)
    
    // Convert blob to base64 for localStorage backup
    const base64 = await blobToBase64(blob)
    const storageKey = `captured_image_${fileName}`
    localStorage.setItem(storageKey, base64)
    
    // AUTO SAVE: Try to save automatically
    await autoSaveImage(blob, fileName, folderName)
    
    console.log(`🔗 Object URL created: ${objectUrl}`)
    
    // Return both URL and blob for API calls
    return {
      url: objectUrl,
      blob: blob
    }
    
  } catch (error) {
    console.error(`❌ Error saving ${type} image:`, error)
    throw error
  }
}

/**
 * Auto save image - tries multiple methods silently
 */
const autoSaveImage = async (blob, fileName, folderName) => {
  try {
    // Method 1: Check if running in Electron (PRIORITY)
    if (window.electronAPI && window.electronAPI.saveImage) {
      try {
        const arrayBuffer = await blob.arrayBuffer()
        const uint8Array = new Uint8Array(arrayBuffer)
        
        const filePath = await window.electronAPI.saveImage({
          data: Array.from(uint8Array),
          fileName: fileName,
          folder: `assets/imgAnhChup/${folderName}`
        })
        
        console.log(`✅ Auto-saved via Electron to: ${filePath}`)
        
        // Show success notification with option to open folder
        if (window.electronAPI.showInExplorer) {
          console.log(`📂 File saved to: ${filePath}`)
          // Optionally show in explorer - uncomment if needed
          // await window.electronAPI.showInExplorer(filePath)
        }
        
        return filePath
      } catch (electronError) {
        console.warn('⚠️ Electron auto-save failed:', electronError.message)
      }
    }
    
    // Method 2: Fallback to browser download for web version
    const downloadPath = await silentAutoDownload(blob, fileName, folderName)
    console.log(`📥 Auto-downloaded: ${downloadPath}`)
    return downloadPath
    
  } catch (error) {
    console.warn('⚠️ Auto-save failed:', error.message)
    // Don't throw - this is best effort
    return null
  }
}

/**
 * Silent auto-download - downloads immediately without user interaction
 */
const silentAutoDownload = async (blob, fileName, folderName) => {
  return new Promise((resolve) => {
    const url = URL.createObjectURL(blob)
    const a = document.createElement('a')
    
    // Set download attributes
    a.href = url
    a.download = `${fileName}` // Clean filename
    a.style.position = 'absolute'
    a.style.left = '-9999px'
    a.style.opacity = '0'
    
    // Add to DOM briefly
    document.body.appendChild(a)
    
    // Trigger download immediately
    setTimeout(() => {
      a.click()
      
      // Cleanup after a short delay
      setTimeout(() => {
        try {
          document.body.removeChild(a)
          URL.revokeObjectURL(url)
        } catch (e) {
          // Ignore cleanup errors
        }
        resolve(`Downloads/${fileName}`)
      }, 50)
    }, 1)
  })
}

/**
 * Save using Electron IPC
 */
const saveWithElectron = async (blob, fileName, folderName) => {
  try {
    // Convert blob to array buffer
    const arrayBuffer = await blob.arrayBuffer()
    const uint8Array = new Uint8Array(arrayBuffer)
    
    // Call Electron IPC to save file
    const filePath = await window.electronAPI.saveImage({
      data: Array.from(uint8Array),
      fileName: fileName,
      folder: `assets/imgAnhChup/${folderName}`
    })
    
    return filePath
  } catch (error) {
    console.error('❌ Electron save error:', error)
    throw error
  }
}

/**
 * Auto download with better UX
 */
const saveWithAutoDownload = async (blob, fileName, folderName) => {
  return new Promise((resolve) => {
    const url = URL.createObjectURL(blob)
    const a = document.createElement('a')
    a.href = url
    a.download = `${folderName}_${fileName}`
    a.style.display = 'none'
    
    // Auto-click the download link
    document.body.appendChild(a)
    
    // Small delay to ensure DOM is ready
    setTimeout(() => {
      a.click()
      
      // Cleanup after download
      setTimeout(() => {
        document.body.removeChild(a)
        URL.revokeObjectURL(url)
        resolve(`downloads/${folderName}_${fileName}`)
      }, 100)
    }, 10)
  })
}

/**
 * Save using File System Access API
 */
const saveWithFileSystemAPI = async (blob, fileName, folderName) => {
  try {
    // Get or create directory handle
    const dirHandle = await getDirHandle(folderName)
    
    // Create file
    const fileHandle = await dirHandle.getFileHandle(fileName, { create: true })
    const writable = await fileHandle.createWritable()
    
    await writable.write(blob)
    await writable.close()
    
    console.log(`✅ File saved to file system: ${folderName}/${fileName}`)
    return `assets/imgAnhChup/${folderName}/${fileName}`
    
  } catch (error) {
    console.error('❌ File System API error:', error)
    throw error
  }
}

/**
 * Get or create directory handle
 */
const getDirHandle = async (folderName) => {
  const rootKey = 'parking_root_dir'
  let rootHandle = await getStoredDirHandle(rootKey)
  
  if (!rootHandle) {
    // First time - ask user to select/create directory
    rootHandle = await window.showDirectoryPicker()
    await storeDirHandle(rootKey, rootHandle)
  }
  
  // Create nested folders: assets/imgAnhChup/folderName
  const assetsHandle = await getOrCreateDir(rootHandle, 'assets')
  const imgHandle = await getOrCreateDir(assetsHandle, 'imgAnhChup')
  const typeHandle = await getOrCreateDir(imgHandle, folderName)
  
  return typeHandle
}

/**
 * Get or create subdirectory
 */
const getOrCreateDir = async (parentHandle, name) => {
  try {
    return await parentHandle.getDirectoryHandle(name)
  } catch {
    return await parentHandle.getDirectoryHandle(name, { create: true })
  }
}

/**
 * Store directory handle
 */
const storeDirHandle = async (key, handle) => {
  const opfsRoot = await navigator.storage.getDirectory()
  const fileHandle = await opfsRoot.getFileHandle(`${key}.json`, { create: true })
  const writable = await fileHandle.createWritable()
  await writable.write(JSON.stringify({ handle: handle.name }))
  await writable.close()
}

/**
 * Get stored directory handle
 */
const getStoredDirHandle = async (key) => {
  try {
    const opfsRoot = await navigator.storage.getDirectory()
    const fileHandle = await opfsRoot.getFileHandle(`${key}.json`)
    // This is a simplified version - in reality, you'd need to restore the actual handle
    return null // For now, always ask user
  } catch {
    return null
  }
}

/**
 * Fallback: Auto download file
 */
const saveWithDownload = async (blob, fileName, folderName) => {
  const url = URL.createObjectURL(blob)
  const a = document.createElement('a')
  a.href = url
  a.download = `${folderName}_${fileName}`
  document.body.appendChild(a)
  a.click()
  document.body.removeChild(a)
  URL.revokeObjectURL(url)
  
  console.log(`📥 File downloaded: ${folderName}_${fileName}`)
  return `downloads/${folderName}_${fileName}`
}

/**
 * Convert blob to base64
 * @param {Blob} blob 
 * @returns {Promise<string>}
 */
const blobToBase64 = (blob) => {
  return new Promise((resolve, reject) => {
    const reader = new FileReader()
    reader.onload = () => resolve(reader.result)
    reader.onerror = reject
    reader.readAsDataURL(blob)
  })
}

/**
 * Create placeholder image canvas
 * @param {string} type - 'plate' or 'face'
 * @param {string} cardId - Card ID
 * @param {string} timestamp - Timestamp
 * @param {string} mode - 'vao' or 'ra'
 * @returns {string} - Data URL of placeholder image
 */
export const createPlaceholderImage = (type, cardId, timestamp, mode) => {
  const canvas = document.createElement('canvas')
  canvas.width = 640
  canvas.height = 480
  const ctx = canvas.getContext('2d')
  
  // Draw placeholder background
  ctx.fillStyle = '#f0f0f0'
  ctx.fillRect(0, 0, canvas.width, canvas.height)
  
  // Draw border
  ctx.strokeStyle = '#ddd'
  ctx.lineWidth = 2
  ctx.strokeRect(0, 0, canvas.width, canvas.height)
  
  // Draw text
  ctx.fillStyle = '#666'
  ctx.font = 'bold 28px Arial'
  ctx.textAlign = 'center'
  ctx.fillText(`${type === 'plate' ? 'BIỂN SỐ' : 'KHUÔN MẶT'}`, canvas.width/2, canvas.height/2 - 60)
  
  ctx.font = '20px Arial'
  ctx.fillText(`${mode.toUpperCase()}`, canvas.width/2, canvas.height/2 - 20)
  
  ctx.font = 'bold 24px monospace'
  ctx.fillStyle = '#dc2626'
  ctx.fillText(`${cardId}`, canvas.width/2, canvas.height/2 + 20)
  
  ctx.font = '16px Arial'
  ctx.fillStyle = '#666'
  ctx.fillText(new Date().toLocaleString('vi-VN'), canvas.width/2, canvas.height/2 + 60)
  
  return canvas.toDataURL('image/jpeg', 0.8)
}

/**
 * Capture frame from video element
 * @param {HTMLVideoElement} videoElement 
 * @returns {Promise<Blob>}
 */
export const captureVideoFrame = (videoElement) => {
  return new Promise((resolve, reject) => {
    try {
      const canvas = document.createElement('canvas')
      canvas.width = videoElement.videoWidth || 640
      canvas.height = videoElement.videoHeight || 480
      const ctx = canvas.getContext('2d')
      
      console.log(`📸 Capturing frame: ${canvas.width}x${canvas.height}`)
      
      // Draw current video frame
      ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height)
      
      // Convert to blob với quality cao hơn và format rõ ràng
      canvas.toBlob((blob) => {
        if (blob) {
          console.log(`✅ Frame captured:`, {
            size: blob.size,
            type: blob.type,
            dimensions: `${canvas.width}x${canvas.height}`
          })
          resolve(blob)
        } else {
          reject(new Error('Failed to capture video frame'))
        }
      }, 'image/jpeg', 0.95) // Tăng quality từ 0.8 lên 0.95
    } catch (error) {
      console.error('❌ Error capturing video frame:', error)
      reject(error)
    }
  })
}

/**
 * Check if running in Electron and get environment info
 */
export const getEnvironmentInfo = async () => {
  const isElectron = !!(window.electronAPI && window.electronAPI.isElectron)
  
  if (isElectron) {
    try {
      const paths = await window.electronAPI.getAppPaths()
      return {
        isElectron: true,
        platform: window.electronAPI.platform,
        paths: paths,
        autoSaveSupported: true,
        saveLocation: paths.defaultImageFolder
      }
    } catch (error) {
      console.error('Error getting Electron paths:', error)
      return {
        isElectron: true,
        platform: 'unknown',
        autoSaveSupported: false,
        saveLocation: 'Unknown'
      }
    }
  }
  
  return {
    isElectron: false,
    platform: 'web',
    autoSaveSupported: false,
    saveLocation: 'Downloads folder (browser download)'
  }
}

/**
 * Open the folder containing saved images (Electron only)
 */
export const openImageFolder = async (filePath) => {
  if (window.electronAPI && window.electronAPI.showInExplorer) {
    try {
      await window.electronAPI.showInExplorer(filePath)
      return true
    } catch (error) {
      console.error('Error opening folder:', error)
      return false
    }
  }
  return false
}
