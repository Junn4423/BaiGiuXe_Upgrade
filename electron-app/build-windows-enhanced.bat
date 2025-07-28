@echo off
echo ================================================
echo Building Parking Lot Management - Windows
echo ================================================

echo.
echo 🧹 Cleaning previous builds...
if exist "dist" rmdir /s /q "dist"

echo.
echo 📦 Installing dependencies...
call npm install

echo.
echo 🔍 Checking FFmpeg installation...
call node debug-ffmpeg.js

echo.
echo 🏗️ Building frontend...
cd "../frontend"
call npm run build
cd "../electron-app"

echo.
echo 📱 Building Electron app...
call npm run build-win

echo.
echo ✅ Build completed! Check the dist folder.
echo.
echo 📁 Build outputs:
dir /b "dist\*.exe" 2>nul
dir /b "dist\win-unpacked\*.exe" 2>nul

echo.
echo 🧪 Testing FFmpeg in unpacked app...
if exist "dist\win-unpacked" (
    echo Running FFmpeg verification...
    node test-build-ffmpeg.js
) else (
    echo ❌ Build folder not found!
)

echo.
echo 📋 Build Summary:
echo ===============
if exist "dist\win-unpacked\Parking Lot Management.exe" (
    echo ✅ Main executable created
) else (
    echo ❌ Main executable missing
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\ffmpeg-binary\ffmpeg.exe" (
    echo ✅ FFmpeg binary included
) else (
    echo ❌ FFmpeg binary missing
)

if exist "dist\Parking Lot Management Setup.exe" (
    echo ✅ Installer created
) else (
    echo ❌ Installer missing
)

echo.
echo 🚀 Next steps:
echo 1. Test the app: "dist\win-unpacked\Parking Lot Management.exe"
echo 2. Check console logs for RTSP streaming
echo 3. Test camera streaming functionality
echo.

pause
