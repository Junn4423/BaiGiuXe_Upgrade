// Debug script to check FFmpeg availability in packaged app
const { spawn } = require("child_process")
const path = require("path")
const fs = require("fs")

function debugFFmpegPath() {
  console.log("🔍 Debugging FFmpeg paths...")
  console.log("Environment:", process.env.NODE_ENV)
  console.log("__dirname:", __dirname)
  console.log("process.resourcesPath:", process.resourcesPath || 'undefined (not in Electron)')
  console.log("process.execPath:", process.execPath)
  
  // List all possible FFmpeg paths
  const possiblePaths = [
    // Development paths
    path.join(__dirname, 'node_modules', 'ffmpeg-static', 'ffmpeg.exe'),
    path.join(__dirname, 'node_modules', 'ffmpeg-static', 'bin', 'win32', 'x64', 'ffmpeg.exe'),
    
    // Our custom binary path
    path.join(__dirname, 'ffmpeg-binary', 'ffmpeg.exe'),
    
    // System path
    'ffmpeg'
  ]
  
  // Add production ASAR paths only if running in Electron
  if (process.resourcesPath) {
    possiblePaths.splice(2, 0, 
      path.join(process.resourcesPath, 'app.asar.unpacked', 'node_modules', 'ffmpeg-static', 'ffmpeg.exe'),
      path.join(process.resourcesPath, 'app.asar.unpacked', 'node_modules', 'ffmpeg-static', 'bin', 'win32', 'x64', 'ffmpeg.exe'),
      path.join(process.resourcesPath, 'ffmpeg.exe'),
      path.join(path.dirname(process.execPath), 'ffmpeg.exe')
    )
  }
  
  console.log("\n📋 Checking possible FFmpeg paths:")
  possiblePaths.forEach((p, index) => {
    try {
      const exists = fs.existsSync(p)
      console.log(`${index + 1}. ${p} - ${exists ? '✅ EXISTS' : '❌ NOT FOUND'}`)
      
      if (exists && p !== 'ffmpeg') {
        try {
          const stats = fs.statSync(p)
          console.log(`   Size: ${stats.size} bytes, Modified: ${stats.mtime}`)
        } catch (e) {
          console.log(`   Error reading stats: ${e.message}`)
        }
      }
    } catch (e) {
      console.log(`${index + 1}. ${p} - ❌ ERROR: ${e.message}`)
    }
  })
  
  // Test ffmpeg-static require
  try {
    const ffmpegStatic = require("ffmpeg-static")
    console.log(`\n📦 ffmpeg-static require result: ${ffmpegStatic}`)
    
    if (ffmpegStatic && fs.existsSync(ffmpegStatic)) {
      console.log("✅ ffmpeg-static path is valid")
      const stats = fs.statSync(ffmpegStatic)
      console.log(`   Size: ${stats.size} bytes`)
    } else {
      console.log("❌ ffmpeg-static path is invalid")
    }
  } catch (e) {
    console.log(`❌ Error requiring ffmpeg-static: ${e.message}`)
  }
  
  // Find working FFmpeg
  const workingPath = possiblePaths.find(p => {
    try {
      return fs.existsSync(p)
    } catch (e) {
      return false
    }
  })
  
  if (workingPath) {
    console.log(`\n🎯 Selected FFmpeg path: ${workingPath}`)
    
    // Test FFmpeg execution
    try {
      console.log("\n🧪 Testing FFmpeg execution...")
      const ffmpeg = spawn(workingPath, ['-version'], { stdio: 'pipe' })
      
      ffmpeg.stdout.on('data', (data) => {
        console.log("✅ FFmpeg stdout:", data.toString().substring(0, 200) + "...")
      })
      
      ffmpeg.stderr.on('data', (data) => {
        console.log("ℹ️ FFmpeg stderr:", data.toString().substring(0, 200) + "...")
      })
      
      ffmpeg.on('close', (code) => {
        console.log(`🏁 FFmpeg test finished with code: ${code}`)
      })
      
      ffmpeg.on('error', (err) => {
        console.log(`❌ FFmpeg execution error: ${err.message}`)
      })
      
    } catch (e) {
      console.log(`❌ Error testing FFmpeg: ${e.message}`)
    }
  } else {
    console.log("\n❌ No working FFmpeg path found!")
  }
}

// Export for use in main process
if (typeof module !== 'undefined' && module.exports) {
  module.exports = { debugFFmpegPath }
}

// Run if called directly
if (require.main === module) {
  debugFFmpegPath()
}
