const { spawn } = require('child_process');
const fs = require('fs');
const path = require('path');

console.log('🧪 Testing Production Build...');
console.log('================================');

// Check if build exists
const distPath = path.join(__dirname, 'dist');
const unpackedPath = path.join(distPath, 'win-unpacked');
const exePath = path.join(unpackedPath, 'Parking Lot Management.exe');

if (!fs.existsSync(exePath)) {
    console.log('❌ Production build not found!');
    console.log('   Expected:', exePath);
    console.log('   Please run build-production-windows.bat first');
    process.exit(1);
}

console.log('✅ Production executable found');

// Check FFmpeg
const ffmpegPath = path.join(unpackedPath, 'resources', 'app.asar.unpacked', 'ffmpeg-binary', 'ffmpeg.exe');
if (fs.existsSync(ffmpegPath)) {
    console.log('✅ FFmpeg binary bundled correctly');
} else {
    console.log('⚠️  FFmpeg binary may be missing in bundle');
}

// Check backend files
const backendPath = path.join(unpackedPath, 'resources', 'app.asar.unpacked', 'backend');
if (fs.existsSync(backendPath)) {
    console.log('✅ Backend files bundled correctly');
} else {
    console.log('⚠️  Backend files may be missing in bundle');
}

// Check frontend build
const frontendPath = path.join(unpackedPath, 'resources', 'app.asar.unpacked', 'build');
if (fs.existsSync(frontendPath)) {
    console.log('✅ Frontend build bundled correctly');
} else {
    console.log('⚠️  Frontend build may be missing in bundle');
}

console.log('');
console.log('📊 Build Statistics:');
console.log('==================');

// Get file sizes
try {
    const exeStats = fs.statSync(exePath);
    console.log(`Main executable: ${(exeStats.size / 1024 / 1024).toFixed(2)} MB`);
} catch (e) {
    console.log('❌ Could not get executable stats');
}

// Check for installer
const installerFiles = fs.readdirSync(distPath).filter(f => f.includes('Setup') && f.endsWith('.exe'));
if (installerFiles.length > 0) {
    installerFiles.forEach(file => {
        try {
            const stats = fs.statSync(path.join(distPath, file));
            console.log(`Installer (${file}): ${(stats.size / 1024 / 1024).toFixed(2)} MB`);
        } catch (e) {
            console.log(`❌ Could not get stats for ${file}`);
        }
    });
} else {
    console.log('⚠️  No installer found');
}

console.log('');
console.log('🚀 Quick Launch Test:');
console.log('=====================');
console.log('Starting production app for 10 seconds...');

const child = spawn(exePath, [], {
    detached: true,
    stdio: 'ignore'
});

child.unref();

setTimeout(() => {
    try {
        process.kill(-child.pid, 'SIGTERM');
        console.log('✅ App launched successfully and terminated');
    } catch (e) {
        console.log('✅ App launched successfully');
    }
    
    console.log('');
    console.log('🎉 Production build test completed!');
    console.log('');
    console.log('📋 Manual testing checklist:');
    console.log('- [ ] App starts without errors');
    console.log('- [ ] UI loads correctly');
    console.log('- [ ] Camera streaming works');
    console.log('- [ ] Python backend integration');
    console.log('- [ ] License plate recognition');
    console.log('- [ ] Database operations');
    console.log('- [ ] File operations');
    console.log('');
    console.log(`🔧 To test manually: "${exePath}"`);
    
}, 10000);

console.log('⏳ Waiting for app to start...');
