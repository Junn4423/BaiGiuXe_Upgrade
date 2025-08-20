@echo off
echo ================================================
echo   PARKING LOT MANAGEMENT - PRODUCTION BUILD
echo         With USB Relay Support (Enhanced)
echo ================================================

REM Set production environment
set NODE_ENV=production

echo.
echo Cleaning previous builds and cache...
if exist "dist" rmdir /s /q "dist"
if exist "build" rmdir /s /q "build"
call npm cache clean --force

echo.
echo Installing/Updating dependencies...
call npm install --production=false

echo.
echo Installing electron-rebuild for native modules...
call npm install electron-rebuild --no-save

echo.
echo Installing node-hid with electron-rebuild...
call npm install node-hid --save
if %ERRORLEVEL% neq 0 (
    echo ⚠️ node-hid direct install failed, trying alternative methods...
    call install-node-hid.bat
)

echo.
echo Rebuilding native modules for Electron...
call npx electron-rebuild --version=37.0.0 --arch=x64

if %ERRORLEVEL% neq 0 (
    echo ⚠️ electron-rebuild failed, trying manual node-hid installation...
    call install-node-hid.bat
)

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

if exist "..\backend\bienso\fast_alpr_service.py" (
    echo ✅ ALPR Python service found
) else (
    echo ❌ ALPR Python service missing
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

if exist "..\backend\khuonmat\fast_face_service.py" (
    echo ✅ Face Recognition Python service found
) else (
    echo ❌ Face Recognition Python service missing
)

echo.
echo Checking USB Relay support...
if exist "node_modules\node-hid" (
    echo ✅ node-hid module found - USB Relay control enabled
) else (
    echo ❌ node-hid module missing - USB Relay control disabled
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
REM Ensure electron is installed in node_modules
if not exist "node_modules\electron" (
    echo Installing electron...
    call npm install electron --no-save
)

call npm run build-win

if %ERRORLEVEL% neq 0 (
    echo Electron build failed!
    pause
    exit /b 1
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

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\fast_alpr_service.py" (
    echo ✅ ALPR Python service included in build
) else (
    echo ❌ ALPR Python service missing in build
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\khuonmat\run_fast_face_service_silent.bat" (
    echo ✅ Face Recognition silent batch file included in build
) else (
    echo ❌ Face Recognition silent batch file missing in build
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\khuonmat\fast_face_service.py" (
    echo ✅ Face Recognition Python service included in build
) else (
    echo ❌ Face Recognition Python service missing in build
)

echo.
echo Checking USB Relay support in build...
if exist "dist\win-unpacked\node_modules\node-hid" (
    echo ✅ node-hid included in build - USB Relay control enabled
) else (
    if exist "dist\win-unpacked\resources\app.asar.unpacked\node_modules\node-hid" (
        echo ✅ node-hid included in asar.unpacked - USB Relay control enabled
    ) else (
        echo ❌ node-hid missing in build - USB Relay control disabled
    )
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
echo Testing FFmpeg in production build...
if exist "dist\win-unpacked" (
    echo Running FFmpeg verification test...
    call node test-build-ffmpeg.js
) else (
    echo Build directory not found!
)

echo.
echo ================================================
echo            PRODUCTION BUILD COMPLETE!
echo ================================================
echo.
echo Build outputs location: %cd%\dist\
echo.
echo Available distributions:
echo   • Setup Installer: "Parking Lot Management Setup.exe"
echo   • Portable App: "Parking Lot Management [version].exe"
echo   • Unpacked App: "win-unpacked\Parking Lot Management.exe"
echo.
echo ⭐ FEATURES INCLUDED:
echo   ✅ Main Electron application
echo   ✅ React frontend (production build)
echo   ✅ RTSP streaming server
echo   ✅ FFmpeg video processing
echo   ✅ License Plate Recognition (ALPR) service
echo   ✅ Face Recognition service
echo   ✅ Backend Python services
if exist "node_modules\node-hid" (
    echo   ✅ USB Relay control (node-hid included)
) else (
    echo   ❌ USB Relay control (node-hid missing - install manually)
)
echo.
echo 📋 TESTING CHECKLIST:
echo   1. Run: "dist\win-unpacked\Parking Lot Management.exe"
echo   2. Verify main interface loads correctly
echo   3. Check camera streaming functionality
echo   4. Test ALPR service startup (requires Python on target)
echo   5. Test Face Recognition service (requires Python on target)
echo   6. Test USB Relay control (if node-hid is available)
echo   7. Verify parking lot management features
echo   8. Check system logs for any errors
echo.
echo 🚀 DEPLOYMENT NOTES:
echo   • Target machines need Python 3.8+ for AI services
echo   • ALPR and Face Recognition will auto-install dependencies
echo   • App works without Python but AI features will be disabled
if not exist "node_modules\node-hid" (
    echo   • USB relay control requires manual node-hid installation:
    echo     Run: npm install node-hid (requires Python + Build Tools)
)
echo.

pause
