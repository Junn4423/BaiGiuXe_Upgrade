import React, { useState, useEffect } from 'react';
import '../assets/styles/VehicleStatusNotification.css';

const VehicleStatusNotification = ({ 
  message, 
  type = 'info', 
  isVisible = false, 
  onClose,
  autoHideDelay = 5000 
}) => {
  const [shouldRender, setShouldRender] = useState(isVisible);

  useEffect(() => {
    if (isVisible) {
      setShouldRender(true);
      
      // Auto hide after delay
      if (autoHideDelay > 0) {
        const timer = setTimeout(() => {
          handleClose();
        }, autoHideDelay);
        
        return () => clearTimeout(timer);
      }
    }
  }, [isVisible, autoHideDelay]);

  const handleClose = () => {
    if (onClose) {
      onClose();
    }
  };

  const handleAnimationEnd = () => {
    if (!isVisible) {
      setShouldRender(false);
    }
  };

  if (!shouldRender) return null;

  const getIcon = () => {
    switch (type) {
      case 'success':
        return '✅';
      case 'error':
        return '❌';
      case 'warning':
        return '⚠️';
      case 'info':
      default:
        return 'ℹ️';
    }
  };

  const getTitle = () => {
    switch (type) {
      case 'success':
        return 'Thành công';
      case 'error':
        return 'Lỗi';
      case 'warning':
        return 'Cảnh báo';
      case 'info':
      default:
        return 'Thông tin';
    }
  };

  return (
    <div 
      className={`vehicle-status-notification ${type} ${isVisible ? 'visible' : 'hidden'}`}
      onAnimationEnd={handleAnimationEnd}
    >
      <div className="notification-content">
        <div className="notification-icon">
          {getIcon()}
        </div>
        <div className="notification-text">
          <div className="notification-title">
            {getTitle()}
          </div>
          <div className="notification-message">
            {message}
          </div>
        </div>
        <button 
          className="notification-close" 
          onClick={handleClose}
          aria-label="Đóng thông báo"
        >
          ×
        </button>
      </div>
      
      {autoHideDelay > 0 && (
        <div 
          className="notification-progress"
          style={{ 
            animationDuration: `${autoHideDelay}ms`,
            animationPlayState: isVisible ? 'running' : 'paused'
          }}
        />
      )}
    </div>
  );
};

// Container component for managing multiple notifications
export const VehicleNotificationContainer = () => {
  const [notifications, setNotifications] = useState([]);

  const addNotification = (notification) => {
    const id = Date.now() + Math.random();
    const newNotification = {
      id,
      ...notification,
      isVisible: true
    };
    
    setNotifications(prev => [...prev, newNotification]);
    
    return id;
  };

  const removeNotification = (id) => {
    setNotifications(prev => 
      prev.map(notification => 
        notification.id === id 
          ? { ...notification, isVisible: false }
          : notification
      )
    );
    
    // Remove from DOM after animation
    setTimeout(() => {
      setNotifications(prev => prev.filter(notification => notification.id !== id));
    }, 300);
  };

  // Expose methods globally
  useEffect(() => {
    window.showVehicleNotification = addNotification;
    return () => {
      delete window.showVehicleNotification;
    };
  }, []);

  return (
    <div className="vehicle-notification-container">
      {notifications.map(notification => (
        <VehicleStatusNotification
          key={notification.id}
          message={notification.message}
          type={notification.type}
          isVisible={notification.isVisible}
          autoHideDelay={notification.autoHideDelay}
          onClose={() => removeNotification(notification.id)}
        />
      ))}
    </div>
  );
};

export default VehicleStatusNotification;
