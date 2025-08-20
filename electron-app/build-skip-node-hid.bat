@echo off
echo ================================================
echo   PARKING LOT MANAGEMENT - PRODUCTION BUILD
echo        SKIP NODE-HID STRATEGY
echo ================================================

REM Set production environment
set NODE_ENV=production

echo.
echo Cleaning previous builds and cache...
if exist "dist" rmdir /s /q "dist"
if exist "build" rmdir /s /q "build"
call npm cache clean --force

echo.
echo Removing node-hid to avoid build conflicts...
call npm uninstall node-hid

echo.
echo Installing/Updating dependencies (excluding node-hid)...
call npm install --production=false

echo.
echo Verifying FFmpeg installation...
call node debug-ffmpeg.js

echo.
echo Running prebuild tasks...
call node prebuild.js

echo.
echo Verifying backend service files...
echo Checking ALPR files...
if exist "..\backend\bienso\run_fast_alpr_service.bat" (
    echo ✅ ALPR batch file found
) else (
    echo ❌ ALPR batch file missing
)

if exist "..\backend\bienso\run_fast_alpr_service_silent.bat" (
    echo ✅ ALPR silent batch file found
) else (
    echo ❌ ALPR silent batch file missing
)

echo.
echo Checking Face Recognition files...
if exist "..\backend\khuonmat\run_fast_face_service.bat" (
    echo ✅ Face Recognition batch file found
) else (
    echo ❌ Face Recognition batch file missing
)

if exist "..\backend\khuonmat\run_fast_face_service_silent.bat" (
    echo ✅ Face Recognition silent batch file found
) else (
    echo ❌ Face Recognition silent batch file missing
)

echo.
echo Building React frontend (Production)...
cd "../frontend"
if not exist "node_modules" (
    echo Installing frontend dependencies...
    call npm install
)
call npm run build
if %ERRORLEVEL% neq 0 (
    echo Frontend build failed!
    cd "../electron-app"
    pause
    exit /b 1
)
cd "../electron-app"

echo.
echo Building Electron app for Windows (Production)...
call npm run build-win

if %ERRORLEVEL% neq 0 (
    echo Electron build failed!
    pause
    exit /b 1
)

echo.
echo Creating node-hid stub in production build...
if exist "dist\win-unpacked\resources\app.asar.unpacked" (
    mkdir "dist\win-unpacked\resources\app.asar.unpacked\node_modules\node-hid" 2>nul
    echo // Stub for node-hid - install manually if USB relay needed > "dist\win-unpacked\resources\app.asar.unpacked\node_modules\node-hid\index.js"
    echo module.exports = { >> "dist\win-unpacked\resources\app.asar.unpacked\node_modules\node-hid\index.js"
    echo   devices: function() { return []; }, >> "dist\win-unpacked\resources\app.asar.unpacked\node_modules\node-hid\index.js"
    echo   HID: function() { throw new Error('node-hid not installed - USB relay disabled'); } >> "dist\win-unpacked\resources\app.asar.unpacked\node_modules\node-hid\index.js"
    echo }; >> "dist\win-unpacked\resources\app.asar.unpacked\node_modules\node-hid\index.js"
    echo ✅ node-hid stub created
)

echo.
echo Verifying build outputs...
if exist "dist\win-unpacked\Parking Lot Management.exe" (
    echo ✅ Main executable created successfully
) else (
    echo ❌ Main executable missing
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\ffmpeg-binary\ffmpeg.exe" (
    echo ✅ FFmpeg binary included
) else (
    echo ❌ FFmpeg binary missing
)

if exist "dist\Parking Lot Management Setup.exe" (
    echo ✅ Windows installer created
) else (
    echo ❌ Windows installer missing
)

echo.
echo Verifying backend services in build...
if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\run_fast_alpr_service_silent.bat" (
    echo ✅ ALPR silent batch file included in build
) else (
    echo ❌ ALPR silent batch file missing in build
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\khuonmat\run_fast_face_service_silent.bat" (
    echo ✅ Face Recognition silent batch file included in build
) else (
    echo ❌ Face Recognition silent batch file missing in build
)

echo.
echo Build Statistics:
echo ===================
for %%f in ("dist\*.exe") do (
    echo Installer: %%~nxf - Size: %%~zf bytes
)
for %%f in ("dist\win-unpacked\*.exe") do (
    echo Main App: %%~nxf - Size: %%~zf bytes
)

echo.
echo ================================================
echo            PRODUCTION BUILD COMPLETE!
echo ================================================
echo.
echo Build outputs location: %cd%\dist\
echo.
echo ⭐ FEATURES INCLUDED:
echo   ✅ Main Electron application
echo   ✅ React frontend (production build)
echo   ✅ RTSP streaming server
echo   ✅ FFmpeg video processing
echo   ✅ License Plate Recognition (ALPR) service
echo   ✅ Face Recognition service
echo   ✅ Backend Python services
echo   ⚠️  USB Relay control (stub created - needs manual setup)
echo.
echo 📋 TESTING CHECKLIST:
echo   1. Run: "dist\win-unpacked\Parking Lot Management.exe"
echo   2. Verify main interface loads correctly
echo   3. Check camera streaming functionality
echo   4. Test ALPR service startup
echo   5. Test Face Recognition service
echo   6. Verify parking lot management features
echo.
echo 🚀 DEPLOYMENT NOTES:
echo   • Target machines need Python 3.8+ for AI services
echo   • USB relay control disabled (node-hid stub installed)
echo   • App will work without USB relay functionality
echo.
echo 💡 TO ENABLE USB RELAY ON TARGET MACHINE:
echo   1. Install Visual Studio Build Tools 2022
echo   2. Install Python 3.8+
echo   3. Navigate to app installation folder
echo   4. Run: npm install node-hid
echo   5. Restart the application
echo.

pause
