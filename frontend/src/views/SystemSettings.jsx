"use client"
import React, { useState, useEffect } from 'react'
import { useToast } from '../components/Toast'
import '../assets/styles/SystemSettings.css'

const SystemSettings = ({ onClose }) => {
  const { showToast } = useToast()
  const [imageStoragePath, setImageStoragePath] = useState('')
  const [isLocalStorageEnabled, setIsLocalStorageEnabled] = useState(false)
  // const [minioTimeout, setMinioTimeout] = useState(5) // DEPRECATED - no longer using MinIO
  const [loading, setLoading] = useState(false)

  useEffect(() => {
    loadSettings()
  }, [])

  const loadSettings = () => {
    try {
      const savedPath = localStorage.getItem('image_storage_path') || ''
      const savedEnabled = localStorage.getItem('local_storage_enabled') === 'true'
      // const savedTimeout = localStorage.getItem('minio_timeout') || '5' // DEPRECATED
      
      // Check if saved path is the old Documents path and clear it
      if (savedPath && (savedPath.includes('Documents\\ParkingLotApp') || savedPath.includes('Documents/ParkingLotApp'))) {
        console.warn('⚠️ Detected old storage path, clearing it:', savedPath);
        localStorage.removeItem('image_storage_path');
        setImageStoragePath('');
        showToast('Đã phát hiện và xóa đường dẫn cũ. Hệ thống sẽ sử dụng thư mục mặc định C:/ParkingLot_Images/', 'info');
      } else {
        setImageStoragePath(savedPath);
      }
      
      setIsLocalStorageEnabled(savedEnabled)
      // setMinioTimeout(parseInt(savedTimeout)) // DEPRECATED
    } catch (error) {
      console.error('Lỗi tải cài đặt:', error)
    }
  }

  const handleSelectFolder = async () => {
    try {
      if (window.electronAPI) {
        // Electron environment
        const selectedPath = await window.electronAPI.chooseSaveDirectory()
        if (selectedPath) {
          setImageStoragePath(selectedPath)
          showToast('Đã chọn thư mục thành công', 'success')
        }
      } else {
        // Web environment - show directory picker if available
        if ('showDirectoryPicker' in window) {
          const dirHandle = await window.showDirectoryPicker()
          setImageStoragePath(dirHandle.name)
          showToast('Đã chọn thư mục (Web mode)', 'success')
        } else {
          showToast('Chức năng chọn thư mục không khả dụng trên trình duyệt này', 'warning')
        }
      }
    } catch (error) {
      console.error('Lỗi chọn thư mục:', error)
      if (error.message && error.message.includes('User cancelled')) {
        console.log('Người dùng đã hủy chọn thư mục')
      } else {
        showToast('Lỗi chọn thư mục', 'error')
      }
    }
  }

  const createImageFolders = async (basePath) => {
    try {
      if (window.electronAPI) {
        // Create folders using Electron API
        await window.electronAPI.createDirectory(`${basePath}/anhchup_khuonmat`)
        await window.electronAPI.createDirectory(`${basePath}/anhchup_bienso`)
        return true
      } else {
        // Web environment - cannot create actual folders
        console.log('Web mode: Folders would be created at:', basePath)
        return true
      }
    } catch (error) {
      console.error('Lỗi tạo thư mục:', error)
      return false
    }
  }

  const handleSaveSettings = async () => {
    if (!imageStoragePath) {
      showToast('Vui lòng chọn thư mục lưu ảnh', 'warning')
      return
    }

    setLoading(true)
    try {
      // Create image folders if local storage is enabled
      if (isLocalStorageEnabled) {
        const foldersCreated = await createImageFolders(imageStoragePath)
        if (!foldersCreated) {
          showToast('Lỗi tạo thư mục con', 'error')
          setLoading(false)
          return
        }
      }

      // Save settings to localStorage
      localStorage.setItem('image_storage_path', imageStoragePath)
      localStorage.setItem('local_storage_enabled', isLocalStorageEnabled.toString())
      // localStorage.setItem('minio_timeout', minioTimeout.toString()) // DEPRECATED

      // Save to global config for other components
      window.systemConfig = {
        imageStoragePath,
        isLocalStorageEnabled,
        // minioTimeout // DEPRECATED
      }

      showToast('Đã lưu cài đặt thành công', 'success')
      
      // Tắt trang sau khi lưu thành công
      setTimeout(() => {
        if (onClose) {
          onClose()
        }
      }, 1000) // Delay 1 giây để user thấy toast message
      
    } catch (error) {
      console.error('Lỗi lưu cài đặt:', error)
      showToast('Lỗi lưu cài đặt', 'error')
    } finally {
      setLoading(false)
    }
  }

  const handleTestPath = async () => {
    if (!imageStoragePath) {
      showToast('Vui lòng chọn thư mục trước', 'warning')
      return
    }

    try {
      if (window.electronAPI) {
        const exists = await window.electronAPI.pathExists(imageStoragePath)
        if (exists) {
          // Kiểm tra 2 thư mục con
          const folder1 = `${imageStoragePath}/anhchup_khuonmat`
          const folder2 = `${imageStoragePath}/anhchup_bienso`
          
          const folder1Exists = await window.electronAPI.pathExists(folder1)
          const folder2Exists = await window.electronAPI.pathExists(folder2)
          
          if (folder1Exists && folder2Exists) {
            showToast('Đã tạo thành công - cả 2 thư mục con đều có sẵn', 'success')
          } else {
            const missingFolders = []
            if (!folder1Exists) missingFolders.push('anhchup_khuonmat')
            if (!folder2Exists) missingFolders.push('anhchup_bienso')
            
            showToast(`Thư mục hợp lệ nhưng thiếu: ${missingFolders.join(', ')}`, 'warning')
          }
        } else {
          showToast('Thư mục không tồn tại', 'error')
        }
      } else {
        showToast('Không thể kiểm tra thư mục trong web mode', 'info')
      }
    } catch (error) {
      console.error('Lỗi kiểm tra thư mục:', error)
      showToast('Lỗi kiểm tra thư mục', 'error')
    }
  }

  const handleResetToDefault = () => {
    const defaultPath = 'C:/ParkingLot_Images'
    setImageStoragePath(defaultPath)
    showToast('Đã đặt lại về thư mục mặc định', 'success')
  }

  return (
    <div className="system-settings">
      <div className="settings-container">
        <div className="settings-header">
          <h1>Cài đặt hệ thống</h1>
          <p>Cấu hình các thông số chung của hệ thống</p>
          <button className="close-btn" onClick={onClose}>×</button>
        </div>

        <div className="settings-content">
          {/* Image Storage Settings */}
          <div className="settings-section">
            <h2> Cài đặt lưu trữ ảnh</h2>
            
            <div className="setting-item">
              <label className="setting-label">
                <input
                  type="checkbox"
                  checked={isLocalStorageEnabled}
                  onChange={(e) => setIsLocalStorageEnabled(e.target.checked)}
                />
                Bật lưu trữ ảnh cục bộ (Local Storage)
              </label>
              <p className="setting-description">
                Khi bật, ảnh sẽ được lưu cả trên MinIO và máy cục bộ để backup
              </p>
            </div>

            {isLocalStorageEnabled && (
              <>
                <div className="setting-item">
                  <label className="setting-label">Thư mục lưu ảnh:</label>
                  <div className="path-selector">
                    <input
                      type="text"
                      value={imageStoragePath}
                      readOnly
                      placeholder="Chọn thư mục lưu ảnh..."
                      className="path-input"
                    />
                    <button 
                      className="btn btn-primary"
                      onClick={handleSelectFolder}
                    >
                       Chọn thư mục
                    </button>
                    <button 
                      className="btn btn-secondary"
                      onClick={handleTestPath}
                      disabled={!imageStoragePath}
                    >
                      ✓ Kiểm tra
                    </button>
                    <button 
                      className="btn btn-warning"
                      onClick={handleResetToDefault}
                      title="Đặt lại về thư mục mặc định C:/ParkingLot_Images/"
                    >
                      🔄 Mặc định
                    </button>
                  </div>
                  <p className="setting-description">
                    Hệ thống sẽ tự động tạo 2 thư mục con: "anhchup_khuonmat" và "anhchup_bienso"
                  </p>
                </div>

                {/* DEPRECATED: MinIO timeout settings
                <div className="setting-item">
                  <label className="setting-label">Timeout MinIO (giây):</label>
                  <input
                    type="number"
                    min="1"
                    max="30"
                    value={minioTimeout}
                    onChange={(e) => setMinioTimeout(parseInt(e.target.value) || 5)}
                    className="timeout-input"
                  />
                  <p className="setting-description">
                    Thời gian chờ upload lên MinIO trước khi fallback về local storage
                  </p>
                </div>
                */}
              </>
            )}
          </div>

          {/* System Information */}
          <div className="settings-section">
            <h2> Thông tin hệ thống</h2>
            
            <div className="info-grid">
              <div className="info-item">
                <label>Môi trường:</label>
                <span>{window.electronAPI ? 'Electron App' : 'Web Browser'}</span>
              </div>
              
              <div className="info-item">
                <label>MinIO Servers:</label>
                <span>
                  192.168.1.19, 192.168.1.90, 192.168.1.94
                </span>
              </div>
              
              <div className="info-item">
                <label>Bucket:</label>
                <span>parking-lot-images</span>
              </div>
              
              <div className="info-item">
                <label>Fallback System:</label>
                <span className={isLocalStorageEnabled ? 'status-enabled' : 'status-disabled'}>
                  {isLocalStorageEnabled ? 'Đã bật' : 'Tắt'}
                </span>
              </div>
            </div>
          </div>

          {/* Storage Rules */}
          <div className="settings-section">
            <h2> Quy tắc lưu trữ</h2>
            
            <div className="rules-list">
              <div className="rule-item">
                <span className="rule-number">1</span>
                <div className="rule-content">
                  <strong>Upload ưu tiên:</strong> Hệ thống sẽ cố gắng upload lên MinIO trước
                </div>
              </div>
              
              <div className="rule-item">
                <span className="rule-number">2</span>
                <div className="rule-content">
                  <strong>Backup cục bộ:</strong> Nếu bật local storage, ảnh sẽ được lưu song song
                </div>
              </div>
              
              <div className="rule-item">
                <span className="rule-number">3</span>
                <div className="rule-content">
                  <strong>Direct folder storage:</strong> Ảnh được lưu trực tiếp vào thư mục C:/ParkingLot_Images/
                </div>
              </div>
              
              <div className="rule-item">
                <span className="rule-number">4</span>
                <div className="rule-content">
                  <strong>Background retry:</strong> Thử upload lại MinIO trong 30s nền
                </div>
              </div>
              
              <div className="rule-item">
                <span className="rule-number">5</span>
                <div className="rule-content">
                  <strong>Load ảnh:</strong> Hiển thị từ MinIO, fallback về local nếu lỗi
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="settings-footer">
          <button 
            className="btn btn-secondary" 
            onClick={onClose}
          >
            Hủy
          </button>
          <button 
            className="btn btn-primary" 
            onClick={handleSaveSettings}
            disabled={loading}
          >
            {loading ? 'Đang lưu...' : 'Lưu cài đặt'}
          </button>
        </div>
      </div>
    </div>
  )
}

export default SystemSettings
