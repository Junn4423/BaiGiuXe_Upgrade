import React, { useState, useEffect } from 'react';
import '../assets/styles/LicensePlateErrorDialog.css';

const LicensePlateErrorDialog = ({ 
  isOpen, 
  onClose, 
  cardId, 
  entryLicensePlate, 
  exitLicensePlate, 
  exitImagePath, 
  entryImageUrl, 
  entryFaceImageUrl, 
  exitFaceImagePath 
}) => {
  const [correctedLicensePlate, setCorrectedLicensePlate] = useState(exitLicensePlate || '');
  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    if (isOpen) {
      setCorrectedLicensePlate(exitLicensePlate || '');
    }
  }, [isOpen, exitLicensePlate]);

  const handleConfirm = async () => {
    if (!correctedLicensePlate.trim()) {
      alert('Vui lòng nhập biển số xe!');
      return;
    }

    setIsLoading(true);
    try {
      onClose({
        action: 'confirm',
        licensePlate: correctedLicensePlate.trim()
      });
    } finally {
      setIsLoading(false);
    }
  };

  const handleCancel = () => {
    onClose({
      action: 'cancel'
    });
  };

  const handleIgnore = () => {
    onClose({
      action: 'ignore',
      licensePlate: entryLicensePlate
    });
  };

  if (!isOpen) return null;

  return (
    <div className="license-plate-error-overlay">
      <div className="license-plate-error-dialog">
        <div className="dialog-header">
          <h2>⚠️ Biển số xe không khớp</h2>
          <button className="close-button" onClick={handleCancel}>×</button>
        </div>

        <div className="dialog-content">
          <div className="error-message">
            <p>Phát hiện biển số xe vào và xe ra không khớp:</p>
            <div className="license-plate-comparison">
              <div className="license-plate-item entry">
                <label>Biển số vào:</label>
                <span className="license-plate">{entryLicensePlate || 'Không xác định'}</span>
              </div>
              <div className="license-plate-item exit">
                <label>Biển số ra:</label>
                <span className="license-plate">{exitLicensePlate || 'Không xác định'}</span>
              </div>
            </div>
          </div>

          <div className="vehicle-info">
            <div className="info-row">
              <label>Mã thẻ:</label>
              <span>{cardId}</span>
            </div>
          </div>

          <div className="images-section">
            <div className="image-group">
              <h3>Ảnh xe vào</h3>
              <div className="image-container">
                {entryImageUrl ? (
                  <img 
                    src={entryImageUrl} 
                    alt="Xe vào" 
                    className="vehicle-image"
                    onError={(e) => {
                      e.target.style.display = 'none';
                      e.target.nextSibling.style.display = 'block';
                    }}
                  />
                ) : (
                  <div className="no-image">Không có ảnh</div>
                )}
                <div className="no-image" style={{ display: 'none' }}>
                  Lỗi tải ảnh
                </div>
              </div>
              
              {entryFaceImageUrl && (
                <div className="face-image-container">
                  <h4>Ảnh khuôn mặt vào</h4>
                  <img 
                    src={entryFaceImageUrl} 
                    alt="Khuôn mặt vào" 
                    className="face-image"
                    onError={(e) => {
                      e.target.style.display = 'none';
                    }}
                  />
                </div>
              )}
            </div>

            <div className="image-group">
              <h3>Ảnh xe ra</h3>
              <div className="image-container">
                {exitImagePath ? (
                  <img 
                    src={exitImagePath} 
                    alt="Xe ra" 
                    className="vehicle-image"
                    onError={(e) => {
                      e.target.style.display = 'none';
                      e.target.nextSibling.style.display = 'block';
                    }}
                  />
                ) : (
                  <div className="no-image">Không có ảnh</div>
                )}
                <div className="no-image" style={{ display: 'none' }}>
                  Lỗi tải ảnh
                </div>
              </div>
              
              {exitFaceImagePath && (
                <div className="face-image-container">
                  <h4>Ảnh khuôn mặt ra</h4>
                  <img 
                    src={exitFaceImagePath} 
                    alt="Khuôn mặt ra" 
                    className="face-image"
                    onError={(e) => {
                      e.target.style.display = 'none';
                    }}
                  />
                </div>
              )}
            </div>
          </div>

          <div className="correction-section">
            <h3>Sửa biển số xe</h3>
            <div className="input-group">
              <label htmlFor="corrected-license-plate">Biển số chính xác:</label>
              <input
                id="corrected-license-plate"
                type="text"
                value={correctedLicensePlate}
                onChange={(e) => setCorrectedLicensePlate(e.target.value.toUpperCase())}
                placeholder="Nhập biển số chính xác..."
                className="license-plate-input"
                maxLength={15}
              />
            </div>
            <div className="input-hint">
              Vui lòng nhập biển số chính xác của xe để tiếp tục xử lý
            </div>
          </div>
        </div>

        <div className="dialog-footer">
          <button 
            className="btn btn-secondary" 
            onClick={handleCancel}
            disabled={isLoading}
          >
            Hủy bỏ
          </button>
          
          <button 
            className="btn btn-warning" 
            onClick={handleIgnore}
            disabled={isLoading}
          >
            Bỏ qua (Dùng biển số vào)
          </button>
          
          <button 
            className="btn btn-primary" 
            onClick={handleConfirm}
            disabled={isLoading || !correctedLicensePlate.trim()}
          >
            {isLoading ? 'Đang xử lý...' : 'Xác nhận'}
          </button>
        </div>
      </div>
    </div>
  );
};

export default LicensePlateErrorDialog;
