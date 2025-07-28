const { spawn } = require('child_process')
const path = require('path')

console.log('🧪 Testing production app with console output...')

// Path to built app
const appPath = path.join(__dirname, 'dist', 'win-unpacked', 'Parking Lot Management.exe')

console.log(`Starting app: ${appPath}`)

// Start the app with console output
const app = spawn(`"${appPath}"`, [], {
  stdio: 'pipe', // Capture stdout/stderr
  shell: true
})

let isAppStarted = false

app.stdout.on('data', (data) => {
  const output = data.toString()
  console.log('📱 [APP STDOUT]:', output.trim())
  
  if (output.includes('RTSP streaming server started')) {
    isAppStarted = true
    console.log('✅ RTSP server confirmed started')
    
    // Test RTSP connection after server starts
    setTimeout(() => {
      testRTSPConnection()
    }, 2000)
  }
})

app.stderr.on('data', (data) => {
  const output = data.toString()
  console.log('📱 [APP STDERR]:', output.trim())
})

app.on('close', (code) => {
  console.log(`📱 App exited with code: ${code}`)
})

app.on('error', (err) => {
  console.error('❌ Failed to start app:', err.message)
})

function testRTSPConnection() {
  console.log('\n🧪 Testing RTSP connection...')
  
  const WebSocket = require('ws')
  
  // Test basic connection first
  const testWs = new WebSocket('ws://localhost:9999')
  
  testWs.on('open', () => {
    console.log('✅ WebSocket server is responding on port 9999')
    testWs.close()
    
    // Test with sample RTSP URL
    console.log('🎥 Testing with sample RTSP URL...')
    const rtspWs = new WebSocket('ws://localhost:9999?rtsp=rtsp://test:test@example.com/stream&cameraId=test1')
    
    let timeout = setTimeout(() => {
      console.log('⏰ RTSP test timeout')
      rtspWs.close()
    }, 5000)
    
    rtspWs.on('open', () => {
      console.log('✅ RTSP WebSocket connected')
    })
    
    rtspWs.on('message', (data) => {
      console.log(`📦 Received data chunk: ${data.length} bytes`)
      clearTimeout(timeout)
      rtspWs.close()
    })
    
    rtspWs.on('error', (err) => {
      console.error('❌ RTSP WebSocket error:', err.message)
    })
    
    rtspWs.on('close', (code, reason) => {
      console.log(`🔚 RTSP connection closed: ${code} ${reason}`)
    })
  })
  
  testWs.on('error', (err) => {
    console.error('❌ WebSocket server not responding:', err.message)
  })
}

// Kill app after 30 seconds if still running
setTimeout(() => {
  console.log('⏰ Killing app after 30 seconds...')
  app.kill('SIGTERM')
}, 30000)
