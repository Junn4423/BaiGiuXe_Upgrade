// Debug utilities for image upload and toast system
// Use these in browser console for testing

// Test MinIO + Local Fallback System
export const testImageUpload = async () => {
  console.log('🧪 Testing Image Upload System...');
  
  try {
    // Create a test image blob
    const canvas = document.createElement('canvas');
    canvas.width = 640;
    canvas.height = 480;
    const ctx = canvas.getContext('2d');
    
    // Draw test content
    ctx.fillStyle = '#f0f0f0';
    ctx.fillRect(0, 0, 640, 480);
    ctx.fillStyle = '#333';
    ctx.font = '24px Arial';
    ctx.textAlign = 'center';
    ctx.fillText('Test Image', 320, 240);
    ctx.fillText(new Date().toISOString(), 320, 280);
    
    // Convert to blob
    const blob = await new Promise(resolve => {
      canvas.toBlob(resolve, 'image/jpeg', 0.8);
    });
    
    console.log('📷 Test image created:', {
      size: blob.size,
      type: blob.type
    });
    
    // Test license plate upload
    console.log('🔄 Testing license plate upload...');
    const { uploadLicensePlateImage } = await import('../api/api.js');
    const plateResult = await uploadLicensePlateImage(blob);
    
    console.log('✅ License plate upload result:', plateResult);
    
    // Test face upload
    console.log('🔄 Testing face upload...');
    const { uploadFaceImage } = await import('../api/api.js');
    const faceResult = await uploadFaceImage(blob);
    
    console.log('✅ Face upload result:', faceResult);
    
    return {
      plateResult,
      faceResult
    };
    
  } catch (error) {
    console.error('❌ Test failed:', error);
    throw error;
  }
};

// Test Toast Queue System
export const testToastQueue = async () => {
  console.log('🧪 Testing Toast Queue System...');
  
  try {
    // Import useToast (note: this needs to be called in a React component)
    console.log('📋 Testing multiple toasts...');
    
    // This is example code - needs to be run in React component context
    const testCode = `
      const { showToast } = useToast();
      
      // Test rapid fire toasts
      showToast('Test Toast 1', 'success');
      showToast('Test Toast 2', 'info');
      showToast('Test Toast 3', 'warning');
      showToast('Test Toast 4', 'error');
      showToast('Test Toast 5', 'success');
      
      console.log('🎯 5 toasts queued - should display sequentially');
    `;
    
    console.log('📝 Run this code in a React component:');
    console.log(testCode);
    
    return testCode;
    
  } catch (error) {
    console.error('❌ Toast test setup failed:', error);
    throw error;
  }
};

// Test Folder Creation
export const testFolderCreation = async () => {
  console.log('🧪 Testing Folder Creation...');
  
  try {
    if (window.electronAPI && window.electronAPI.createDirectory) {
      const testPaths = [
        'C:\\Users\\Chung\\Documents\\ParkingLotApp\\assets\\imgAnhChup\\anhchup_bienso',
        'C:\\Users\\Chung\\Documents\\ParkingLotApp\\assets\\imgAnhChup\\anhchup_khuonmat'
      ];
      
      for (const path of testPaths) {
        console.log(`📁 Creating directory: ${path}`);
        await window.electronAPI.createDirectory(path);
        console.log(`✅ Directory created: ${path}`);
      }
      
      console.log('🎯 All directories created successfully');
      return true;
      
    } else {
      console.log('🌐 Running in web browser - folder creation not available');
      return false;
    }
    
  } catch (error) {
    console.error('❌ Folder creation test failed:', error);
    throw error;
  }
};

// Check System Status
export const checkSystemStatus = () => {
  console.log('🔍 System Status Check...');
  
  const status = {
    environment: window.electronAPI ? 'Electron' : 'Web Browser',
    platform: window.electronAPI?.platform || 'unknown',
    apis: {
      electronAPI: !!window.electronAPI,
      saveImage: !!(window.electronAPI && window.electronAPI.saveImage),
      createDirectory: !!(window.electronAPI && window.electronAPI.createDirectory),
      showInExplorer: !!(window.electronAPI && window.electronAPI.showInExplorer)
    },
    storage: {
      localStorage: !!window.localStorage,
      fileSystemAPI: 'showDirectoryPicker' in window
    }
  };
  
  console.log('📊 System Status:', status);
  return status;
};

// Monitor Upload Performance
export const monitorUploadPerformance = async (iterations = 5) => {
  console.log(`🏃‍♂️ Performance Monitor - ${iterations} iterations...`);
  
  const results = [];
  
  for (let i = 0; i < iterations; i++) {
    console.log(`🔄 Iteration ${i + 1}/${iterations}`);
    
    try {
      const startTime = performance.now();
      const result = await testImageUpload();
      const endTime = performance.now();
      
      const duration = endTime - startTime;
      const iterationResult = {
        iteration: i + 1,
        duration: Math.round(duration),
        plateLocal: result.plateResult.isLocal,
        faceLocal: result.faceResult.isLocal,
        success: true
      };
      
      results.push(iterationResult);
      console.log(`✅ Iteration ${i + 1} completed in ${Math.round(duration)}ms`);
      
      // Wait between iterations
      await new Promise(resolve => setTimeout(resolve, 1000));
      
    } catch (error) {
      results.push({
        iteration: i + 1,
        error: error.message,
        success: false
      });
      console.error(`❌ Iteration ${i + 1} failed:`, error.message);
    }
  }
  
  // Calculate statistics
  const successful = results.filter(r => r.success);
  const avgDuration = successful.length > 0 
    ? Math.round(successful.reduce((sum, r) => sum + r.duration, 0) / successful.length)
    : 0;
  
  const localCount = successful.filter(r => r.plateLocal).length;
  const minioCount = successful.length - localCount;
  
  const summary = {
    total: iterations,
    successful: successful.length,
    failed: results.length - successful.length,
    avgDuration: avgDuration,
    minioUploads: minioCount,
    localSaves: localCount,
    successRate: Math.round((successful.length / iterations) * 100)
  };
  
  console.log('📊 Performance Summary:', summary);
  console.table(results);
  
  return {
    results,
    summary
  };
};

// Global debug utilities for browser console
if (typeof window !== 'undefined') {
  window.debugImageSystem = {
    testImageUpload,
    testToastQueue,
    testFolderCreation,
    checkSystemStatus,
    monitorUploadPerformance
  };
  
  console.log('🛠️ Debug utilities loaded. Use window.debugImageSystem to test.');
}

export default {
  testImageUpload,
  testToastQueue,
  testFolderCreation,
  checkSystemStatus,
  monitorUploadPerformance
};
