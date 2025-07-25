import React, { useState, useEffect, useCallback } from 'react'

const Toast = ({ message, type = 'success', duration = 1000, onClose }) => {
  const [isVisible, setIsVisible] = useState(true)

  useEffect(() => {
    // Start fade out animation before duration ends
    const fadeOutTimer = setTimeout(() => {
      setIsVisible(false)
    }, duration - 300) // Start fade out 300ms before end

    // Complete removal after fade out
    const removeTimer = setTimeout(() => {
      onClose && onClose()
    }, duration)

    return () => {
      clearTimeout(fadeOutTimer)
      clearTimeout(removeTimer)
    }
  }, [duration, onClose])

  const bgColor = type === 'success' ? '#10b981' : 
                  type === 'error' ? '#ef4444' : 
                  type === 'warning' ? '#f59e0b' : '#3b82f6'

  return (
    <div style={{
      position: 'fixed',
      top: '20px',
      right: '20px',
      backgroundColor: bgColor,
      color: 'white',
      padding: '12px 20px',
      borderRadius: '8px',
      boxShadow: '0 4px 12px rgba(0,0,0,0.3)',
      zIndex: 9999,
      fontSize: '14px',
      fontWeight: '500',
      maxWidth: '300px',
      transition: 'all 0.3s ease-out',
      transform: isVisible ? 'translateX(0)' : 'translateX(100%)',
      opacity: isVisible ? 1 : 0,
      animation: isVisible ? 'slideIn 0.3s ease-out' : 'slideOut 0.3s ease-out'
    }}>
      {message}
    </div>
  )
}

export const useToast = () => {
  const [toasts, setToasts] = useState([])
  const [toastQueue, setToastQueue] = useState([])
  const [isProcessing, setIsProcessing] = useState(false)

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
      
      // Wait for display duration (1 second as requested)
      await new Promise(resolve => setTimeout(resolve, nextToast.duration || 1000));
      
      // Remove toast
      setToasts([]);
      
      // Small delay between toasts
      await new Promise(resolve => setTimeout(resolve, 100));
      
      setIsProcessing(false);
    };

    processNext();
  }, [toastQueue.length, isProcessing]);

  const showToast = useCallback((message, type = 'success', duration = 1000) => {
    const id = Date.now() + Math.random(); // Ensure unique ID
    const toast = { id, message, type, duration };
    
    // Add to queue instead of showing immediately
    setToastQueue(prev => [...prev, toast]);
  }, []); // Remove dependency array to prevent infinite re-creation

  const ToastContainer = () => (
    <div style={{ 
      position: 'fixed', 
      top: '20px', 
      right: '20px', 
      zIndex: 9999,
      pointerEvents: 'none' 
    }}>
      {toasts.map(toast => (
        <Toast
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
        @keyframes slideIn {
          from {
            transform: translateX(100%);
            opacity: 0;
          }
          to {
            transform: translateX(0);
            opacity: 1;
          }
        }
        @keyframes slideOut {
          from {
            transform: translateX(0);
            opacity: 1;
          }
          to {
            transform: translateX(100%);
            opacity: 0;
          }
        }
      `}</style>
    </div>
  )

  return { showToast, ToastContainer }
}

export default Toast
