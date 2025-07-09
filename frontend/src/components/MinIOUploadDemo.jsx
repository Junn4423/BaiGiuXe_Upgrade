import React, { useState } from 'react'
import { 
  uploadLicensePlateImage, 
  uploadLicensePlateOutImage, 
  uploadFaceImage,
  uploadImageToMinIO 
} from '../api/api'

const MinIOUploadDemo = () => {
  const [uploading, setUploading] = useState(false)
  const [uploadResults, setUploadResults] = useState([])

  const handleFileUpload = async (event, uploadType) => {
    const file = event.target.files[0]
    if (!file) return

    // Validate file
    if (!file.type.startsWith('image/')) {
      alert('Vui lòng chọn file ảnh!')
      return
    }

    if (file.size > 10 * 1024 * 1024) {
      alert('File quá lớn! Tối đa 10MB')
      return
    }

    try {
      setUploading(true)
      console.log(`🔄 Uploading ${uploadType} image...`, file)

      let uploadResult
      switch (uploadType) {
        case 'license_plate':
          uploadResult = await uploadLicensePlateImage(file)
          break
        case 'license_plate_out':
          uploadResult = await uploadLicensePlateOutImage(file)
          break
        case 'face':
          uploadResult = await uploadFaceImage(file)
          break
        default:
          uploadResult = await uploadImageToMinIO(file, uploadType)
      }

      if (uploadResult.success) {
        console.log('✅ Upload successful:', uploadResult)
        
        const newResult = {
          id: Date.now(),
          type: uploadType,
          filename: uploadResult.filename,
          primaryUrl: uploadResult.primaryUrl,
          servers: uploadResult.results,
          uploadTime: new Date().toLocaleString('vi-VN')
        }
        
        setUploadResults(prev => [newResult, ...prev.slice(0, 9)]) // Keep last 10 results
        alert(`✅ Upload thành công!\nFile: ${uploadResult.filename}\nURL: ${uploadResult.primaryUrl}`)
      } else {
        alert('❌ Upload thất bại!')
      }
    } catch (error) {
      console.error('❌ Upload error:', error)
      alert(`❌ Lỗi upload: ${error.message}`)
    } finally {
      setUploading(false)
    }
  }

  const clearResults = () => {
    setUploadResults([])
  }

  return (
    <div style={{ padding: '20px', backgroundColor: '#f8fafc', borderRadius: '12px', margin: '20px' }}>
      <h3 style={{ color: '#1f2937', marginBottom: '20px' }}>🌩️ MinIO Image Upload Demo</h3>
      
      {/* Upload Sections */}
      <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: '20px', marginBottom: '30px' }}>
        
        {/* License Plate Entry */}
        <div style={{ padding: '20px', backgroundColor: 'white', borderRadius: '8px', border: '2px dashed #e5e7eb' }}>
          <h4 style={{ color: '#059669', marginBottom: '10px' }}>📷 Biển Số Vào</h4>
          <input 
            type="file" 
            accept="image/*" 
            onChange={(e) => handleFileUpload(e, 'license_plate')}
            disabled={uploading}
            style={{ width: '100%', padding: '8px', marginBottom: '10px' }}
          />
          <small style={{ color: '#6b7280' }}>Ảnh biển số xe vào bãi</small>
        </div>

        {/* License Plate Exit */}
        <div style={{ padding: '20px', backgroundColor: 'white', borderRadius: '8px', border: '2px dashed #e5e7eb' }}>
          <h4 style={{ color: '#dc2626', marginBottom: '10px' }}>🚗 Biển Số Ra</h4>
          <input 
            type="file" 
            accept="image/*" 
            onChange={(e) => handleFileUpload(e, 'license_plate_out')}
            disabled={uploading}
            style={{ width: '100%', padding: '8px', marginBottom: '10px' }}
          />
          <small style={{ color: '#6b7280' }}>Ảnh biển số xe ra bãi</small>
        </div>

        {/* Face Image */}
        <div style={{ padding: '20px', backgroundColor: 'white', borderRadius: '8px', border: '2px dashed #e5e7eb' }}>
          <h4 style={{ color: '#3b82f6', marginBottom: '10px' }}>👤 Khuôn Mặt</h4>
          <input 
            type="file" 
            accept="image/*" 
            onChange={(e) => handleFileUpload(e, 'face')}
            disabled={uploading}
            style={{ width: '100%', padding: '8px', marginBottom: '10px' }}
          />
          <small style={{ color: '#6b7280' }}>Ảnh khuôn mặt tài xế</small>
        </div>

        {/* Custom Upload */}
        <div style={{ padding: '20px', backgroundColor: 'white', borderRadius: '8px', border: '2px dashed #e5e7eb' }}>
          <h4 style={{ color: '#f59e0b', marginBottom: '10px' }}>🔧 Custom</h4>
          <input 
            type="file" 
            accept="image/*" 
            onChange={(e) => handleFileUpload(e, 'test_image')}
            disabled={uploading}
            style={{ width: '100%', padding: '8px', marginBottom: '10px' }}
          />
          <small style={{ color: '#6b7280' }}>Upload với prefix tùy chọn</small>
        </div>
      </div>

      {/* Upload Status */}
      {uploading && (
        <div style={{ 
          padding: '15px', 
          backgroundColor: '#dbeafe', 
          border: '1px solid #93c5fd',
          borderRadius: '8px',
          textAlign: 'center',
          marginBottom: '20px'
        }}>
          <div style={{ color: '#1d4ed8', fontWeight: '600' }}>⏳ Đang upload lên MinIO servers...</div>
        </div>
      )}

      {/* Upload Results */}
      {uploadResults.length > 0 && (
        <div>
          <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '15px' }}>
            <h4 style={{ color: '#1f2937', margin: 0 }}>📋 Kết Quả Upload</h4>
            <button 
              onClick={clearResults}
              style={{
                padding: '6px 12px',
                backgroundColor: '#ef4444',
                color: 'white',
                border: 'none',
                borderRadius: '4px',
                cursor: 'pointer',
                fontSize: '12px'
              }}
            >
              Xóa tất cả
            </button>
          </div>
          
          <div style={{ maxHeight: '400px', overflowY: 'auto' }}>
            {uploadResults.map(result => (
              <div key={result.id} style={{ 
                padding: '15px', 
                backgroundColor: 'white', 
                border: '1px solid #e5e7eb',
                borderRadius: '8px',
                marginBottom: '10px'
              }}>
                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start', marginBottom: '10px' }}>
                  <div>
                    <div style={{ fontWeight: '600', color: '#1f2937' }}>{result.type}</div>
                    <div style={{ fontSize: '12px', color: '#6b7280' }}>{result.uploadTime}</div>
                  </div>
                  <div style={{ fontSize: '12px', color: '#059669' }}>
                    ✅ {result.servers.filter(s => s.status === 'success').length}/{result.servers.length} servers
                  </div>
                </div>
                
                <div style={{ marginBottom: '10px' }}>
                  <div style={{ fontSize: '14px', fontWeight: '500', color: '#374151' }}>📁 {result.filename}</div>
                  <div style={{ fontSize: '12px', color: '#059669', wordBreak: 'break-all' }}>
                    🔗 {result.primaryUrl}
                  </div>
                </div>

                {/* Preview image if URL is accessible */}
                <img 
                  src={result.primaryUrl} 
                  alt="Uploaded preview"
                  style={{ 
                    maxWidth: '200px', 
                    maxHeight: '150px', 
                    objectFit: 'contain',
                    border: '1px solid #e5e7eb',
                    borderRadius: '4px'
                  }}
                  onError={(e) => {
                    e.target.style.display = 'none'
                  }}
                />

                {/* Server details */}
                <details style={{ marginTop: '10px' }}>
                  <summary style={{ cursor: 'pointer', color: '#6b7280', fontSize: '12px' }}>
                    Chi tiết servers
                  </summary>
                  <div style={{ marginTop: '5px', fontSize: '11px' }}>
                    {result.servers.map((server, idx) => (
                      <div key={idx} style={{ 
                        padding: '4px 8px', 
                        backgroundColor: server.status === 'success' ? '#dcfce7' : '#fee2e2',
                        borderRadius: '4px',
                        marginBottom: '2px'
                      }}>
                        <strong>{server.server}:</strong> {server.status}
                        {server.url && <div style={{ color: '#6b7280', wordBreak: 'break-all' }}>{server.url}</div>}
                        {server.message && <div style={{ color: '#dc2626' }}>{server.message}</div>}
                      </div>
                    ))}
                  </div>
                </details>
              </div>
            ))}
          </div>
        </div>
      )}

      {/* Info */}
      <div style={{ 
        marginTop: '20px', 
        padding: '15px', 
        backgroundColor: '#f0f9ff', 
        border: '1px solid #0ea5e9',
        borderRadius: '8px',
        fontSize: '14px',
        color: '#0c4a6e'
      }}>
        <strong>ℹ️ Thông tin:</strong>
        <ul style={{ margin: '5px 0', paddingLeft: '20px' }}>
          <li>Ảnh sẽ được upload lên 3 MinIO servers: 192.168.1.19, 192.168.1.90, 192.168.1.94</li>
          <li>Format tên file: prefix_YYYY-MM-DDTHH-mm-ss-sssZ.jpg</li>
          <li>Tối đa 10MB mỗi file, hỗ trợ JPEG, PNG, GIF</li>
          <li>URL trả về có thể dùng để lưu vào database</li>
        </ul>
      </div>
    </div>
  )
}

export default MinIOUploadDemo
