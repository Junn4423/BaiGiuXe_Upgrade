// Test script to verify FFmpeg in built app
const { spawn } = require("child_process")
const path = require("path")
const fs = require("fs")

function testBuildFFmpeg() {
  console.log("🧪 Testing FFmpeg in built app...")
  
  const buildPath = path.join(__dirname, "dist", "win-unpacked")
  const resourcesPath = path.join(buildPath, "resources")
  const asarUnpackedPath = path.join(resourcesPath, "app.asar.unpacked")
  
  console.log("\n📁 Checking build structure:")
  console.log(`Build path: ${buildPath}`)
  console.log(`Exists: ${fs.existsSync(buildPath) ? '✅' : '❌'}`)
  
  if (!fs.existsSync(buildPath)) {
    console.log("❌ Build folder not found. Please run build first:")
    console.log("   npm run build-win")
    return
  }
  
  console.log(`Resources path: ${resourcesPath}`)
  console.log(`Exists: ${fs.existsSync(resourcesPath) ? '✅' : '❌'}`)
  
  console.log(`ASAR unpacked path: ${asarUnpackedPath}`)
  console.log(`Exists: ${fs.existsSync(asarUnpackedPath) ? '✅' : '❌'}`)
  
  // Check FFmpeg paths in built app
  const ffmpegPaths = [
    path.join(asarUnpackedPath, "ffmpeg-binary", "ffmpeg.exe"),
    path.join(asarUnpackedPath, "node_modules", "ffmpeg-static", "ffmpeg.exe"),
    path.join(asarUnpackedPath, "node_modules", "ffmpeg-static", "bin", "win32", "x64", "ffmpeg.exe"),
    path.join(resourcesPath, "ffmpeg.exe"),
    path.join(buildPath, "ffmpeg.exe")
  ]
  
  console.log("\n🔍 Checking FFmpeg in built app:")
  let workingFFmpeg = null
  
  ffmpegPaths.forEach((ffmpegPath, index) => {
    const exists = fs.existsSync(ffmpegPath)
    console.log(`${index + 1}. ${ffmpegPath}`)
    console.log(`   ${exists ? '✅ EXISTS' : '❌ NOT FOUND'}`)
    
    if (exists) {
      try {
        const stats = fs.statSync(ffmpegPath)
        console.log(`   Size: ${stats.size} bytes`)
        console.log(`   Modified: ${stats.mtime}`)
        if (!workingFFmpeg) {
          workingFFmpeg = ffmpegPath
        }
      } catch (e) {
        console.log(`   Error reading stats: ${e.message}`)
      }
    }
    console.log("")
  })
  
  // Test FFmpeg execution
  if (workingFFmpeg) {
    console.log(`🎯 Testing FFmpeg execution: ${workingFFmpeg}`)
    
    try {
      const ffmpeg = spawn(workingFFmpeg, ['-version'], { 
        stdio: 'pipe',
        cwd: buildPath
      })
      
      let stdout = ""
      let stderr = ""
      
      ffmpeg.stdout.on('data', (data) => {
        stdout += data.toString()
      })
      
      ffmpeg.stderr.on('data', (data) => {
        stderr += data.toString()
      })
      
      ffmpeg.on('close', (code) => {
        console.log(`\n🏁 FFmpeg test result: Exit code ${code}`)
        if (code === 0) {
          console.log("✅ FFmpeg works correctly!")
          console.log("First few lines of output:")
          console.log(stdout.split('\n').slice(0, 3).join('\n'))
        } else {
          console.log("❌ FFmpeg failed!")
          console.log("Error output:", stderr.substring(0, 500))
        }
      })
      
      ffmpeg.on('error', (err) => {
        console.log(`❌ FFmpeg execution error: ${err.message}`)
      })
      
    } catch (e) {
      console.log(`❌ Error testing FFmpeg: ${e.message}`)
    }
  } else {
    console.log("❌ No working FFmpeg found in built app!")
    console.log("\n🔧 To fix this issue:")
    console.log("1. Run: npm run prebuild")
    console.log("2. Run: npm run build-win")
    console.log("3. Check that ffmpeg-binary/ffmpeg.exe exists")
  }
  
  // Check main executable
  const mainExe = path.join(buildPath, "Parking Lot Management.exe")
  console.log(`\n📱 Main executable: ${mainExe}`)
  console.log(`Exists: ${fs.existsSync(mainExe) ? '✅' : '❌'}`)
  
  if (fs.existsSync(mainExe)) {
    const stats = fs.statSync(mainExe)
    console.log(`Size: ${(stats.size / 1024 / 1024).toFixed(2)} MB`)
  }
}

// Check if running as main script
if (require.main === module) {
  testBuildFFmpeg()
}

module.exports = { testBuildFFmpeg }
