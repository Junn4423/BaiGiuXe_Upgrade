import React, { useState, useEffect } from "react"
import { nhanDangBienSo } from "../api/api"
import "../assets/styles/ImageCaptureModal.css"

const ImageCaptureModal = ({ isOpen, onClose, images, cardId, saveToDisc = false }) => {
  const [licensePlateResult, setLicensePlateResult] = useState(null)
  const [isRecognizing, setIsRecognizing] = useState(false)
  const [recognitionError, setRecognitionError] = useState(null)

  // Tự động nhận dạng biển số khi modal mở và có ảnh biển số
  useEffect(() => {
    if (isOpen && (images.plateImageBlob || images.plateImage) && !licensePlateResult && !isRecognizing) {
      recognizeLicensePlate()
    }
  }, [isOpen, images.plateImage, images.plateImageBlob])

  // Reset state khi modal đóng
  useEffect(() => {
    if (!isOpen) {
      setLicensePlateResult(null)
      setIsRecognizing(false)
      setRecognitionError(null)
    }
  }, [isOpen])

  const recognizeLicensePlate = async () => {
    if (!images.plateImageBlob && !images.plateImage) {
      console.warn("Không có ảnh biển số để nhận dạng")
      return
    }

    setIsRecognizing(true)
    setRecognitionError(null)
    
    try {
      console.log("Bắt đầu nhận dạng biển số...")
      
      let blob = images.plateImageBlob
      
      // If no blob stored, convert from URL
      if (!blob && images.plateImage) {
        const response = await fetch(images.plateImage)
        blob = await response.blob()
      }
      
      // Gửi lên API nhận dạng
      const result = await nhanDangBienSo(blob)
      
      console.log("Kết quả nhận dạng:", result)
      
      // Transform API response to match our expected format
      const transformedResult = transformApiResponse(result)
      setLicensePlateResult(transformedResult)
      
    } catch (error) {
      console.error("Lỗi nhận dạng biển số:", error)
      setRecognitionError(error.message)
    } finally {
      setIsRecognizing(false)
    }
  }

  // Transform API response to a consistent format
  const transformApiResponse = (apiResult) => {
    if (apiResult && apiResult.ket_qua && apiResult.ket_qua.length > 0) {
      const firstResult = apiResult.ket_qua[0]
      
      // Extract license plate text from OCR result
      let licensePlate = "N/A"
      let confidence = 0
      
      if (firstResult.ocr) {
        // Handle different OCR result formats
        if (typeof firstResult.ocr === 'string') {
          // Parse string format: "OcrResult(text='86B821322', confidence=0.913814127445221)"
          const textMatch = firstResult.ocr.match(/text='([^']+)'/)
          const confMatch = firstResult.ocr.match(/confidence=([0-9.]+)/)
          
          if (textMatch) licensePlate = textMatch[1]
          if (confMatch) confidence = parseFloat(confMatch[1])
        } else if (typeof firstResult.ocr === 'object') {
          // Handle object format
          licensePlate = firstResult.ocr.text || "N/A"
          confidence = firstResult.ocr.confidence || 0
        }
      }
      
      return {
        license_plate: licensePlate,
        confidence: confidence,
        processing_time: apiResult.processing_time || 0,
        raw_result: apiResult // Keep original for debugging
      }
    }
    
    // Fallback for unexpected format
    return {
      license_plate: "N/A",
      confidence: 0,
      processing_time: 0,
      raw_result: apiResult
    }
  }

  if (!isOpen) return null

  // Debug function to check video elements
  const debugVideoElements = () => {
    const videos = Array.from(document.querySelectorAll('video'))
    console.log('Debug Video Elements:', videos.map(v => ({
      element: v,
      cameraType: v.getAttribute('data-camera-type'),
      readyState: v.readyState,
      videoWidth: v.videoWidth,
      videoHeight: v.videoHeight,
      currentTime: v.currentTime,
      src: v.src
    })))
  }

  // Setup auto-save folder
  const setupAutoSave = async () => {
    if ('showDirectoryPicker' in window) {
      try {
        const dirHandle = await window.showDirectoryPicker()
        localStorage.setItem('autoSaveDirectory', JSON.stringify({
          name: dirHandle.name,
          setup: true
        }))
        alert(`Đã thiết lập thư mục lưu tự động: ${dirHandle.name}`)
      } catch (error) {
        console.warn('User cancelled directory selection')
      }
    } else {
      alert('Trình duyệt không hỗ trợ File System Access API. Ảnh sẽ tự động download.')
    }
  }

  return (
    <div className="image-capture-modal-overlay">
      <div className="image-capture-modal">
        <div className="image-capture-modal-header">
          <h2>Ảnh Chụp Được</h2>
          <button className="close-button" onClick={onClose}>
            ×
          </button>
        </div>
        
        <div className="image-capture-modal-body">
          <div className="card-info">
            <h3>Mã Thẻ: <span className="card-id">{cardId}</span></h3>
            <p style={{ 
              color: saveToDisc ? '#059669' : '#f59e0b', 
              fontWeight: '600', 
              margin: '8px 0 0 0',
              fontSize: '14px'
            }}>
              {saveToDisc 
                ? 'Ảnh đã được tự động lưu vào thư mục sau khi xe vào thành công' 
                : 'Ảnh tạm thời - sẽ lưu vào ổ đĩa khi phiên gửi xe thành công'}
            </p>
          </div>

          {/* Kết quả nhận dạng biển số */}
          {images.plateImage && (
            <div className="license-plate-recognition">
              <h3>Nhận Dạng Biển Số</h3>
              
              {isRecognizing && (
                <div className="recognition-status recognizing">
                  <span className="spinner">⏳</span>
                  Đang nhận dạng biển số...
                </div>
              )}
              
              {recognitionError && (
                <div className="recognition-status error">
                  <span></span>
                  Lỗi nhận dạng: {recognitionError}
                  <button 
                    className="retry-btn"
                    onClick={recognizeLicensePlate}
                    style={{
                      marginLeft: '10px',
                      padding: '4px 8px',
                      backgroundColor: '#f59e0b',
                      color: 'white',
                      border: 'none',
                      borderRadius: '4px',
                      fontSize: '12px',
                      cursor: 'pointer'
                    }}
                  >
                    Thử Lại
                  </button>
                </div>
              )}
              
              {licensePlateResult && (
                <div className="recognition-result">
                  <div className="recognition-status success">
                    <span></span>
                    Nhận dạng thành công!
                  </div>
                  
                  <div className="license-plate-info">
                    {licensePlateResult.license_plate && (
                      <div className="plate-number">
                        <strong>Biển Số: </strong>
                        <span className="plate-text">{licensePlateResult.license_plate}</span>
                      </div>
                    )}
                    
                    {licensePlateResult.confidence && (
                      <div className="confidence">
                        <strong>Độ Tin Cậy: </strong>
                        <span className={`confidence-value ${licensePlateResult.confidence > 0.8 ? 'high' : licensePlateResult.confidence > 0.6 ? 'medium' : 'low'}`}>
                          {(licensePlateResult.confidence * 100).toFixed(1)}%
                        </span>
                      </div>
                    )}
                    
                    {licensePlateResult.processing_time && (
                      <div className="processing-time">
                        <strong>Thời Gian Xử Lý: </strong>
                        <span>{licensePlateResult.processing_time.toFixed(2)}s</span>
                      </div>
                    )}
                  </div>
                </div>
              )}
            </div>
          )}
          
          <div className="images-grid">{images.plateImage && (
              <div className="image-container">
                <h4>Ảnh Biển Số</h4>
                <img src={images.plateImage} alt="Biển số xe" className="captured-image" />
              </div>
            )}
            
            {images.faceImage && (
              <div className="image-container">
                <h4>Ảnh Khuôn Mặt</h4>
                <img src={images.faceImage} alt="Khuôn mặt" className="captured-image" />
              </div>
            )}
          </div>
          
          <div className="modal-actions">
            <button className="btn-debug" onClick={debugVideoElements} style={{
              backgroundColor: '#6b7280',
              color: 'white',
              border: 'none',
              padding: '8px 16px',
              borderRadius: '4px',
              marginRight: '8px',
              fontSize: '14px'
            }}>
              Debug Video
            </button>
            
            {(images.plateImage || images.plateImageBlob) && !isRecognizing && (
              <button 
                className="btn-recognition" 
                onClick={recognizeLicensePlate}
                style={{
                  backgroundColor: '#3b82f6',
                  color: 'white',
                  border: 'none',
                  padding: '8px 16px',
                  borderRadius: '4px',
                  marginRight: '8px',
                  fontSize: '14px',
                  cursor: 'pointer'
                }}
              >
                Nhận Dạng Lại
              </button>
            )}
            
            <button className="btn-primary" onClick={onClose}>
              Xác Nhận
            </button>
            <button className="btn-secondary" onClick={onClose}>
              Đóng
            </button>
          </div>
        </div>
      </div>
    </div>
  )
}

export default ImageCaptureModal
