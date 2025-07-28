// RTSP Debug Client - Test WebSocket connection to RTSP server
const WebSocket = require('ws');

const TEST_RTSP_URL = 'rtsp://admin:123456789@192.168.1.100:554/stream1';
const WS_URL = 'ws://localhost:9999';

function testRTSPConnection() {
  console.log('🧪 Testing RTSP WebSocket Connection...');
  console.log(`📡 RTSP URL: ${TEST_RTSP_URL}`);
  console.log(`🔗 WebSocket URL: ${WS_URL}?rtsp=${encodeURIComponent(TEST_RTSP_URL)}`);
  
  const ws = new WebSocket(`${WS_URL}?rtsp=${encodeURIComponent(TEST_RTSP_URL)}`);
  
  let dataReceived = 0;
  let connectionTime = Date.now();
  
  ws.on('open', () => {
    console.log('✅ WebSocket connected successfully');
  });
  
  ws.on('message', (data) => {
    dataReceived += data.length;
    
    if (dataReceived < 1000) {
      console.log(`📦 Received ${data.length} bytes (total: ${dataReceived})`);
    } else if (dataReceived % 10000 < data.length) {
      // Log every ~10KB
      console.log(`📦 Streaming... received ${(dataReceived / 1024).toFixed(1)}KB`);
    }
    
    // Check for MP4 header
    if (data.length > 8) {
      const header = data.toString('hex', 0, 8);
      if (header.includes('667479') || header.includes('6d6f6f') || header.includes('6d646174')) {
        console.log('✅ MP4 data detected:', header);
      }
    }
  });
  
  ws.on('error', (error) => {
    console.error('❌ WebSocket error:', error.message);
  });
  
  ws.on('close', (code, reason) => {
    const duration = Date.now() - connectionTime;
    console.log(`🔚 Connection closed after ${duration}ms`);
    console.log(`   Code: ${code}, Reason: ${reason}`);
    console.log(`   Total data received: ${(dataReceived / 1024).toFixed(2)}KB`);
  });
  
  // Auto-close after 30 seconds for testing
  setTimeout(() => {
    if (ws.readyState === WebSocket.OPEN) {
      console.log('⏰ Test timeout, closing connection...');
      ws.close();
    }
  }, 30000);
}

function checkServerHealth() {
  console.log('🏥 Checking RTSP server health...');
  
  const ws = new WebSocket('ws://localhost:9999');
  
  ws.on('open', () => {
    console.log('✅ RTSP server is running on port 9999');
    ws.close();
  });
  
  ws.on('error', (error) => {
    console.error('❌ Cannot connect to RTSP server:', error.message);
    console.log('🔧 Make sure the Electron app is running and RTSP server started');
  });
}

// Export functions for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
  module.exports = { testRTSPConnection, checkServerHealth };
}

// Run if called directly
if (require.main === module) {
  const args = process.argv.slice(2);
  
  if (args.includes('--health')) {
    checkServerHealth();
  } else if (args.includes('--test')) {
    testRTSPConnection();
  } else {
    console.log('RTSP Debug Client');
    console.log('Usage:');
    console.log('  node rtsp-debug-client.js --health  # Check server health');
    console.log('  node rtsp-debug-client.js --test    # Test RTSP streaming');
    console.log('');
    
    // Do health check by default
    checkServerHealth();
  }
}
