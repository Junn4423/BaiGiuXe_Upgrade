const WebSocket = require('ws')

function testRTSPConnection() {
  console.log('🧪 Testing RTSP WebSocket connection...')
  
  // Test connection to RTSP server
  const ws = new WebSocket('ws://localhost:9999?rtsp=rtsp://admin:admin@192.168.1.100:554/cam/realmonitor?channel=1&subtype=0&cameraId=camera1')
  
  let dataReceived = 0
  const connectionTime = Date.now()
  
  ws.on('open', () => {
    console.log('✅ WebSocket connected to RTSP server')
  })
  
  ws.on('message', (data) => {
    dataReceived += data.length
    if (dataReceived % (100 * 1024) < data.length) { // Log every ~100KB
      console.log(`📦 Streaming... received ${(dataReceived / 1024).toFixed(1)}KB`)
    }
    
    // Check for MP4 header
    if (data.length > 8) {
      const header = data.toString('hex', 0, 8)
      if (header.includes('667479') || header.includes('6d6f6f') || header.includes('6d646174')) {
        console.log('✅ MP4 data detected:', header)
      }
    }
  })
  
  ws.on('error', (error) => {
    console.error('❌ WebSocket error:', error.message)
  })
  
  ws.on('close', (code, reason) => {
    const duration = Date.now() - connectionTime
    console.log(`🔚 Connection closed after ${duration}ms`)
    console.log(`   Code: ${code}, Reason: ${reason}`)
    console.log(`   Total data received: ${(dataReceived / 1024).toFixed(1)}KB`)
    process.exit(0)
  })
  
  // Close after 10 seconds
  setTimeout(() => {
    console.log('⏰ Test timeout, closing connection...')
    ws.close()
  }, 10000)
}

// Test if server is running
const testConnection = new WebSocket('ws://localhost:9999')
testConnection.on('open', () => {
  console.log('🎯 RTSP server is running on port 9999')
  testConnection.close()
  
  // Now test with RTSP URL (you'll need to update this with real camera URL)
  testRTSPConnection()
})

testConnection.on('error', (err) => {
  console.error('❌ RTSP server not running on port 9999:', err.message)
  console.log('💡 Make sure the Electron app is running first')
  process.exit(1)
})
