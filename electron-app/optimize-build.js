const fs = require('fs');
const path = require('path');

console.log('🔧 Optimizing build for production...');

// Check if we're in production mode
const isProduction = process.env.NODE_ENV === 'production';

if (isProduction) {
    console.log('✅ Production mode detected');
    
    // Verify FFmpeg binary exists
    const ffmpegPath = path.join(__dirname, 'ffmpeg-binary', 'ffmpeg.exe');
    if (fs.existsSync(ffmpegPath)) {
        console.log('✅ FFmpeg binary found');
    } else {
        console.log('⚠️  FFmpeg binary not found - downloading...');
        try {
            require('./ffmpeg-downloader.js');
        } catch (error) {
            console.error('❌ Failed to download FFmpeg:', error.message);
        }
    }
    
    // Check frontend build
    const frontendBuildPath = path.join(__dirname, '..', 'frontend', 'build');
    if (fs.existsSync(frontendBuildPath)) {
        console.log('✅ Frontend build found');
        
        // Get build stats
        const buildStats = fs.statSync(frontendBuildPath);
        console.log(`📊 Frontend build date: ${buildStats.mtime.toISOString()}`);
        
        // Check for index.html
        const indexPath = path.join(frontendBuildPath, 'index.html');
        if (fs.existsSync(indexPath)) {
            console.log('✅ Frontend index.html found');
        } else {
            console.log('❌ Frontend index.html missing');
        }
    } else {
        console.log('❌ Frontend build not found - please run frontend build first');
    }
    
    // Check Python backend requirements
    const reqPath = path.join(__dirname, '..', 'backend', 'requirements.txt');
    if (fs.existsSync(reqPath)) {
        console.log('✅ Python requirements found');
    } else {
        console.log('⚠️  Python requirements not found');
    }
    
    // Production optimization flags
    process.env.ELECTRON_BUILDER_COMPRESSION_LEVEL = '9'; // Maximum compression
    process.env.ELECTRON_BUILDER_CACHE = 'false'; // Fresh build
    
    console.log('🎯 Production optimizations applied');
} else {
    console.log('🛠️  Development mode - using standard configuration');
}

console.log('🔧 Build optimization complete!');
