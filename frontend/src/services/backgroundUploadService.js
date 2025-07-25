// Background Upload Service
// Quản lý việc upload ảnh lên MinIO trong background sau khi đã fallback local

import { uploadToMinIOWithTimeout } from '../api/api.js';

class BackgroundUploadService {
  constructor() {
    this.uploadQueue = [];
    this.isProcessing = false;
    this.maxRetries = 3;
    this.retryDelay = 10000; // 10 seconds between retries
    this.successCallback = null;
    this.errorCallback = null;
    
    console.log('🔄 Background Upload Service initialized');
  }

  /**
   * Set callback functions for success/error notifications
   */
  setCallbacks(onSuccess, onError) {
    this.successCallback = onSuccess;
    this.errorCallback = onError;
  }

  /**
   * Add image to background upload queue
   * @param {Object} uploadData - Upload data containing blob, filename, prefix, etc.
   */
  addToQueue(uploadData) {
    const queueItem = {
      id: Date.now() + Math.random(),
      ...uploadData,
      retries: 0,
      addedAt: new Date().toISOString(),
      status: 'pending'
    };

    this.uploadQueue.push(queueItem);
    console.log(`📤 Added to background queue: ${queueItem.filename}`, {
      queueLength: this.uploadQueue.length,
      item: queueItem
    });

    // Start processing if not already running
    if (!this.isProcessing) {
      this.startProcessing();
    }

    return queueItem.id;
  }

  /**
   * Start processing the upload queue
   */
  async startProcessing() {
    if (this.isProcessing) return;
    
    this.isProcessing = true;
    console.log('🚀 Starting background upload processing...');

    while (this.uploadQueue.length > 0) {
      const item = this.uploadQueue.shift();
      await this.processItem(item);
      
      // Small delay between uploads to avoid overwhelming servers
      await new Promise(resolve => setTimeout(resolve, 1000));
    }

    this.isProcessing = false;
    console.log('✅ Background upload processing completed');
  }

  /**
   * Process a single upload item
   */
  async processItem(item) {
    console.log(`🔄 Processing background upload: ${item.filename} (attempt ${item.retries + 1})`);
    
    try {
      item.status = 'uploading';
      
      // Try MinIO upload with longer timeout for background uploads
      const result = await uploadToMinIOWithTimeout(item.blob, item.filename, 30000); // 30 second timeout
      
      if (result.success) {
        console.log(`✅ Background upload successful: ${item.filename}`, result);
        
        item.status = 'success';
        item.completedAt = new Date().toISOString();
        item.result = result;

        // Update database with MinIO URLs if needed
        await this.updateDatabase(item, result);

        // Show success notification
        if (this.successCallback) {
          this.successCallback({
            filename: item.filename,
            originalType: item.originalType || 'image',
            urls: result.urls,
            primaryUrl: result.primaryUrl,
            uploadedAt: item.completedAt
          });
        }

      } else {
        throw new Error('MinIO upload returned failure');
      }

    } catch (error) {
      console.warn(`⚠️ Background upload failed: ${item.filename}`, error.message);
      
      item.retries++;
      item.lastError = error.message;
      item.status = 'failed';

      if (item.retries < this.maxRetries) {
        // Retry after delay
        console.log(`🔄 Scheduling retry ${item.retries + 1}/${this.maxRetries} for: ${item.filename}`);
        item.status = 'retrying';
        
        setTimeout(() => {
          this.uploadQueue.push(item);
          if (!this.isProcessing) {
            this.startProcessing();
          }
        }, this.retryDelay * item.retries); // Exponential backoff
        
      } else {
        // Max retries reached
        console.error(`❌ Background upload failed permanently: ${item.filename}`, {
          retries: item.retries,
          error: error.message
        });

        if (this.errorCallback) {
          this.errorCallback({
            filename: item.filename,
            originalType: item.originalType || 'image',
            error: error.message,
            retries: item.retries
          });
        }
      }
    }
  }

  /**
   * Update database with MinIO URLs after successful background upload
   */
  async updateDatabase(item, result) {
    try {
      // Only update if we have the session ID and database update is needed
      if (item.sessionId && item.updateType) {
        const { capNhatPhienGuiXe } = await import('../api/api.js');
        
        const updateData = {
          maPhien: item.sessionId
        };

        // Map update type to correct field
        switch (item.updateType) {
          case 'plate_in':
            updateData.anhVao = result.primaryUrl;
            break;
          case 'plate_out':
            updateData.anhRa = result.primaryUrl;
            break;
          case 'face_in':
            updateData.anhMatVao = result.primaryUrl;
            break;
          case 'face_out':
            updateData.anhMatRa = result.primaryUrl;
            break;
        }

        await capNhatPhienGuiXe(updateData);
        console.log(`🗄️ Database updated for session ${item.sessionId}:`, updateData);
      }
    } catch (dbError) {
      console.warn('⚠️ Failed to update database after background upload:', dbError.message);
      // Don't fail the whole upload for database errors
    }
  }

  /**
   * Get queue status
   */
  getStatus() {
    return {
      isProcessing: this.isProcessing,
      queueLength: this.uploadQueue.length,
      pendingItems: this.uploadQueue.filter(item => item.status === 'pending').length,
      retryingItems: this.uploadQueue.filter(item => item.status === 'retrying').length
    };
  }

  /**
   * Clear completed items from queue (for memory management)
   */
  clearCompleted() {
    const before = this.uploadQueue.length;
    this.uploadQueue = this.uploadQueue.filter(item => 
      item.status !== 'success' && item.status !== 'failed'
    );
    const after = this.uploadQueue.length;
    
    if (before !== after) {
      console.log(`🧹 Cleared ${before - after} completed items from background queue`);
    }
  }
}

// Global singleton instance
const backgroundUploadService = new BackgroundUploadService();

export default backgroundUploadService;
