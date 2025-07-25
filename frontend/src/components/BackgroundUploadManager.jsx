import React, { useEffect } from 'react';
import { useLeftToast } from './LeftToast';
import backgroundUploadService from '../services/backgroundUploadService';

/**
 * Background Upload Manager Component
 * Manages background MinIO uploads and displays left-side notifications
 */
const BackgroundUploadManager = () => {
  const { showLeftToast, LeftToastContainer } = useLeftToast();

  useEffect(() => {
    // Set up callbacks for background upload service
    backgroundUploadService.setCallbacks(
      // Success callback
      (result) => {
        const typeText = getTypeDisplayText(result.originalType);
        showLeftToast(
          `Upload thành công: ${typeText}`,
          'success',
          3000
        );
        console.log('🎉 Background upload success notification:', result);
      },
      
      // Error callback
      (error) => {
        const typeText = getTypeDisplayText(error.originalType);
        showLeftToast(
          `Upload thất bại: ${typeText} (${error.retries} lần thử)`,
          'error',
          4000
        );
        console.log('💥 Background upload error notification:', error);
      }
    );

    // Cleanup completed items periodically
    const cleanupInterval = setInterval(() => {
      backgroundUploadService.clearCompleted();
    }, 60000); // Every minute

    // Initial status log
    console.log('🚀 Background Upload Manager initialized');
    console.log('📊 Initial queue status:', backgroundUploadService.getStatus());

    return () => {
      clearInterval(cleanupInterval);
    };
  }, [showLeftToast]);

  // Helper function to convert technical types to user-friendly text
  const getTypeDisplayText = (type) => {
    switch (type) {
      case 'license_plate':
        return 'Ảnh biển số vào';
      case 'license_plate_out':
        return 'Ảnh biển số ra';
      case 'khuon_mat':
        return 'Ảnh khuôn mặt';
      default:
        return 'Ảnh';
    }
  };

  return (
    <>
      <LeftToastContainer />
      
      {/* Debug panel - only show in development */}
      {process.env.NODE_ENV === 'development' && (
        <BackgroundUploadDebugPanel />
      )}
    </>
  );
};

/**
 * Debug panel for monitoring background uploads (development only)
 */
const BackgroundUploadDebugPanel = () => {
  const [status, setStatus] = React.useState(backgroundUploadService.getStatus());

  React.useEffect(() => {
    const interval = setInterval(() => {
      setStatus(backgroundUploadService.getStatus());
    }, 2000);

    return () => clearInterval(interval);
  }, []);

  if (status.queueLength === 0 && !status.isProcessing) {
    return null; // Hide when nothing is happening
  }

  return (
    <div style={{
      position: 'fixed',
      bottom: '20px',
      left: '20px',
      backgroundColor: 'rgba(0, 0, 0, 0.8)',
      color: 'white',
      padding: '8px 12px',
      borderRadius: '6px',
      fontSize: '12px',
      fontFamily: 'monospace',
      zIndex: 9997,
      minWidth: '200px'
    }}>
      <div><strong>Background Upload</strong></div>
      <div>Processing: {status.isProcessing ? '✅' : '❌'}</div>
      <div>Queue: {status.queueLength}</div>
      <div>Pending: {status.pendingItems}</div>
      <div>Retrying: {status.retryingItems}</div>
    </div>
  );
};

export default BackgroundUploadManager;
