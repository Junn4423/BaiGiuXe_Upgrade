const fs = require('fs')
const path = require('path')

console.log('🔧 Pre-build: Setting up FFmpeg...')

// Create ffmpeg-binary directory
const ffmpegBinaryDir = path.join(__dirname, 'ffmpeg-binary')
if (!fs.existsSync(ffmpegBinaryDir)) {
  fs.mkdirSync(ffmpegBinaryDir, { recursive: true })
  console.log('📁 Created ffmpeg-binary directory')
}

// Copy FFmpeg from ffmpeg-static to our binary directory
try {
  const ffmpegStatic = require('ffmpeg-static')
  const ffmpegTarget = path.join(ffmpegBinaryDir, 'ffmpeg.exe')
  
  if (fs.existsSync(ffmpegStatic) && !fs.existsSync(ffmpegTarget)) {
    fs.copyFileSync(ffmpegStatic, ffmpegTarget)
    console.log(`✅ Copied FFmpeg from ${ffmpegStatic} to ${ffmpegTarget}`)
  } else if (fs.existsSync(ffmpegTarget)) {
    console.log('✅ FFmpeg binary already exists in ffmpeg-binary/')
  }
} catch (e) {
  console.error('❌ Error setting up FFmpeg binary:', e.message)
}

// Ensure ffmpeg-downloader will work
try {
  const { downloadFFmpeg } = require('./ffmpeg-downloader')
  downloadFFmpeg().then(ffmpegPath => {
    console.log(`✅ FFmpeg ready at: ${ffmpegPath}`)
  }).catch(e => {
    console.error('❌ FFmpeg setup failed:', e)
  })
} catch (e) {
  console.error('❌ Pre-build error:', e)
}

// Check if ffmpeg-static is properly installed
try {
  const ffmpegStatic = require('ffmpeg-static')
  console.log(`📦 ffmpeg-static path: ${ffmpegStatic}`)
  
  if (fs.existsSync(ffmpegStatic)) {
    const stats = fs.statSync(ffmpegStatic)
    console.log(`✅ ffmpeg-static binary exists (${stats.size} bytes)`)
  } else {
    console.log('❌ ffmpeg-static binary not found!')
  }
} catch (e) {
  console.error('❌ ffmpeg-static not available:', e.message)
}

console.log('✅ Pre-build setup complete')
