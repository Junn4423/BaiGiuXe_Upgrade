const https = require('https')
const fs = require('fs')
const path = require('path')
const { pipeline } = require('stream')
const { promisify } = require('util')

const pipelineAsync = promisify(pipeline)

// FFmpeg Windows 64-bit binary download
const FFMPEG_URL = 'https://github.com/BtbN/FFmpeg-Builds/releases/download/latest/ffmpeg-master-latest-win64-gpl.zip'
const FFMPEG_DIR = path.join(__dirname, 'ffmpeg-binary')
const FFMPEG_EXE = path.join(FFMPEG_DIR, 'ffmpeg.exe')

async function downloadFFmpeg() {
  console.log('🔽 Downloading FFmpeg binary...')
  
  // Create directory if not exists
  if (!fs.existsSync(FFMPEG_DIR)) {
    fs.mkdirSync(FFMPEG_DIR, { recursive: true })
  }
  
  // Check if already exists
  if (fs.existsSync(FFMPEG_EXE)) {
    console.log('✅ FFmpeg already exists')
    return FFMPEG_EXE
  }
  
  try {
    // For simplicity, let's copy from node_modules if available
    const ffmpegStatic = require('ffmpeg-static')
    if (fs.existsSync(ffmpegStatic)) {
      console.log('📋 Copying FFmpeg from ffmpeg-static...')
      fs.copyFileSync(ffmpegStatic, FFMPEG_EXE)
      console.log('✅ FFmpeg copied successfully')
      return FFMPEG_EXE
    }
  } catch (e) {
    console.log('⚠️ Could not use ffmpeg-static, will use fallback')
  }
  
  // Fallback: use system ffmpeg
  return 'ffmpeg'
}

module.exports = { downloadFFmpeg, FFMPEG_EXE }
