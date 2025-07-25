import React, { useState, useEffect } from 'react';

const LeftToast = ({ message, type = 'info', duration = 3000, onClose }) => {
  const [isVisible, setIsVisible] = useState(true);

  useEffect(() => {
    // Start fade out animation before duration ends
    const fadeOutTimer = setTimeout(() => {
      setIsVisible(false);
    }, duration - 300);

    // Complete removal after fade out
    const removeTimer = setTimeout(() => {
      onClose && onClose();
    }, duration);

    return () => {
      clearTimeout(fadeOutTimer);
      clearTimeout(removeTimer);
    };
  }, [duration, onClose]);

  const getBackgroundColor = () => {
    switch (type) {
      case 'success':
        return '#10b981'; // Green
      case 'error':
        return '#ef4444'; // Red
      case 'warning':
        return '#f59e0b'; // Orange
      case 'info':
      default:
        return '#3b82f6'; // Blue
    }
  };

  const getIcon = () => {
    switch (type) {
      case 'success':
        return 'success';
      case 'error':
        return 'error';
      case 'warning':
        return 'warning';
      case 'info':
      default:
        return 'info';
    }
  };

  return (
    <div style={{
      position: 'fixed',
      top: '20px',
      left: '20px', // Position on the left
      backgroundColor: getBackgroundColor(),
      color: 'white',
      padding: '12px 16px',
      borderRadius: '8px',
      boxShadow: '0 4px 12px rgba(0,0,0,0.3)',
      zIndex: 9998, // Lower than main toast to avoid conflicts
      fontSize: '14px',
      fontWeight: '500',
      maxWidth: '350px',
      minWidth: '280px',
      transition: 'all 0.3s ease-out',
      transform: isVisible ? 'translateX(0)' : 'translateX(-100%)',
      opacity: isVisible ? 1 : 0,
      display: 'flex',
      alignItems: 'center',
      gap: '8px'
    }}>
      <span style={{ fontSize: '16px' }}>{getIcon()}</span>
      <span style={{ flex: 1 }}>{message}</span>
    </div>
  );
};

export const useLeftToast = () => {
  const [toasts, setToasts] = useState([]);
  const [toastQueue, setToastQueue] = useState([]);
  const [isProcessing, setIsProcessing] = useState(false);

  // Process toast queue sequentially
  useEffect(() => {
    const processNext = async () => {
      if (isProcessing || toastQueue.length === 0) return;

      setIsProcessing(true);
      const nextToast = toastQueue[0];
      
      // Remove from queue
      setToastQueue(prev => prev.slice(1));
      
      // Show toast
      setToasts([nextToast]);
      
      // Wait for display duration
      await new Promise(resolve => setTimeout(resolve, nextToast.duration || 3000));
      
      // Remove toast
      setToasts([]);
      
      // Small delay between toasts
      await new Promise(resolve => setTimeout(resolve, 200));
      
      setIsProcessing(false);
    };

    if (!isProcessing && toastQueue.length > 0) {
      processNext();
    }
  }, [toastQueue.length, isProcessing]);

  const showLeftToast = (message, type = 'info', duration = 3000) => {
    const id = Date.now() + Math.random();
    const toast = { id, message, type, duration };
    
    // Add to queue
    setToastQueue(prev => [...prev, toast]);
  };

  const LeftToastContainer = () => (
    <div style={{ 
      position: 'fixed', 
      top: '20px', 
      left: '20px', 
      zIndex: 9998,
      pointerEvents: 'none' 
    }}>
      {toasts.map(toast => (
        <LeftToast
          key={toast.id}
          message={toast.message}
          type={toast.type}
          duration={toast.duration}
          onClose={() => {
            // Toasts are auto-managed by queue system
          }}
        />
      ))}
      <style jsx>{`
        @keyframes slideInLeft {
          from {
            transform: translateX(-100%);
            opacity: 0;
          }
          to {
            transform: translateX(0);
            opacity: 1;
          }
        }
        @keyframes slideOutLeft {
          from {
            transform: translateX(0);
            opacity: 1;
          }
          to {
            transform: translateX(-100%);
            opacity: 0;
          }
        }
      `}</style>
    </div>
  );

  return { showLeftToast, LeftToastContainer };
};

export default LeftToast;
