import React from 'react';
import { useLeftToast } from './LeftToast';

/**
 * Background Upload Manager Component - DEPRECATED
 * No longer needed with direct folder storage
 * Keeping minimal version for component compatibility
 */
const BackgroundUploadManager = () => {
  const { LeftToastContainer } = useLeftToast();

  return (
    <>
      <LeftToastContainer />
      {/* Background upload service is deprecated - direct folder storage doesn't need background retries */}
    </>
  );
};

export default BackgroundUploadManager;
    