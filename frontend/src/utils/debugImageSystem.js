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

// Test Image URL Fallback System
export const testImageUrlFallback = async (filename) => {
  console.log('🧪 Testing Image URL Fallback System...');
  
  try {
    const { getBackupImageUrls, checkImageUrl } = await import('../api/api.js');
    
    if (!filename) {
      filename = 'license_plate_2025-07-25T03-11-53-051Z.jpg'; // Test filename
    }
    
    console.log(`🔍 Testing filename: ${filename}`);
    
    // Get all possible URLs
    const urls = getBackupImageUrls(filename);
    console.log('📋 All possible URLs:', urls);
    
    // Test each URL
    const results = [];
    for (let i = 0; i < urls.length; i++) {
      const url = urls[i];
      console.log(`🔄 Testing URL ${i + 1}/${urls.length}: ${url}`);
      
      const startTime = performance.now();
      const isWorking = await checkImageUrl(url);
      const endTime = performance.now();
      const duration = Math.round(endTime - startTime);
      
      const result = {
        url,
        working: isWorking,
        duration,
        server: url.match(/\/\/([\d\.:]+)/)?.[1] || 'unknown'
      };
      
      results.push(result);
      
      if (isWorking) {
        console.log(`✅ Server ${result.server} working (${duration}ms)`);
      } else {
        console.log(`❌ Server ${result.server} failed (${duration}ms)`);
      }
    }
    
    // Summary
    const workingServers = results.filter(r => r.working);
    const fastestServer = workingServers.sort((a, b) => a.duration - b.duration)[0];
    
    console.log('📊 Fallback Test Summary:', {
      totalServers: results.length,
      workingServers: workingServers.length,
      failedServers: results.length - workingServers.length,
      fastestServer: fastestServer?.server || 'none',
      fastestTime: fastestServer?.duration || 'N/A'
    });
    
    return {
      filename,
      urls,
      results,
      summary: {
        totalServers: results.length,
        workingServers: workingServers.length,
        fastestServer: fastestServer?.server || 'none'
      }
    };
    
  } catch (error) {
    console.error('❌ Fallback test failed:', error);
    throw error;
  }
};

// Test all servers health
export const checkAllServersHealth = async () => {
  console.log('🏥 Checking all MinIO servers health...');
  
  const servers = [
    '192.168.1.19:9000',
    '192.168.1.90:9000', 
    '192.168.1.94:9000'
  ];
  
  const testFilename = 'test-health-check.jpg';
  const results = [];
  
  for (const server of servers) {
    const url = `http://${server}/parking-lot-images/${testFilename}`;
    console.log(`🔄 Checking server: ${server}`);
    
    try {
      const startTime = performance.now();
      
      // Try to access MinIO API endpoint
      const response = await fetch(`http://${server}/minio/health/live`, {
        method: 'GET',
        mode: 'no-cors' // To avoid CORS issues
      });
      
      const endTime = performance.now();
      const duration = Math.round(endTime - startTime);
      
      results.push({
        server,
        status: 'healthy',
        duration,
        type: 'api'
      });
      
      console.log(`✅ Server ${server} healthy (${duration}ms)`);
      
    } catch (error) {
      // Try image URL instead
      const { checkImageUrl } = await import('../api/api.js');
      const imageWorking = await checkImageUrl(url);
      
      results.push({
        server,
        status: imageWorking ? 'image-accessible' : 'failed',
        error: error.message,
        type: 'fallback'
      });
      
      if (imageWorking) {
        console.log(`⚠️ Server ${server} API not accessible but images work`);
      } else {
        console.log(`❌ Server ${server} completely failed`);
      }
    }
  }
  
  const healthyServers = results.filter(r => r.status === 'healthy').length;
  const accessibleServers = results.filter(r => r.status !== 'failed').length;
  
  console.log('📊 Server Health Summary:', {
    totalServers: servers.length,
    healthyServers,
    accessibleServers,
    failedServers: servers.length - accessibleServers
  });
  
  return results;
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
    testImageUrlFallback,
    checkAllServersHealth,
    testToastQueue,
    testFolderCreation,
    checkSystemStatus,
    monitorUploadPerformance
  };
  
  console.log('🛠️ Debug utilities loaded. Use window.debugImageSystem to test.');
}

export default {
  testImageUpload,
  testImageUrlFallback,
  checkAllServersHealth,
  testToastQueue,
  testFolderCreation,
  checkSystemStatus,
  monitorUploadPerformance
};
