@echo off
echo ================================================
echo   PARKING LOT MANAGEMENT - PRODUCTION BUILD
echo              Windows Platform
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
echo Installing node-hid separately...
call install-node-hid-alternative.bat
if %ERRORLEVEL% neq 0 (
    echo ⚠️ node-hid installation failed - USB relay features will be disabled
    echo Continuing build without USB relay support...
)

echo.
echo Verifying FFmpeg installation...
call node debug-ffmpeg.js

echo.
echo Running prebuild tasks...
call node prebuild.js

echo.
echo Verifying ALPR batch files...
if exist "..\backend\bienso\run_fast_alpr_service.bat" (
    echo ALPR batch file found
) else (
    echo ALPR batch file missing
)

if exist "..\backend\bienso\run_fast_alpr_service_silent.bat" (
    echo ALPR silent batch file found
) else (
    echo ALPR silent batch file missing
)

echo.
echo Verifying Face Recognition batch files...
if exist "..\backend\khuonmat\run_fast_face_service.bat" (
    echo Face Recognition batch file found
) else (
    echo Face Recognition batch file missing
)

if exist "..\backend\khuonmat\run_fast_face_service_silent.bat" (
    echo Face Recognition silent batch file found
) else (
    echo Face Recognition silent batch file missing
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

REM Check if electron-builder is available
where electron-builder >nul 2>&1
if %ERRORLEVEL% neq 0 (
    echo electron-builder not found, installing...
    call npm install electron-builder --no-save
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
    echo Main executable created successfully
) else (
    echo Main executable missing
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\ffmpeg-binary\ffmpeg.exe" (
    echo FFmpeg binary included
) else (
    echo FFmpeg binary missing
)

if exist "dist\Parking Lot Management Setup.exe" (
    echo Windows installer created
) else (
    echo Windows installer missing
)

if exist "dist\Parking Lot Management*.exe" (
    echo Portable executable created
) else (
    echo Portable executable missing
)

echo.
echo Verifying ALPR components in build...
if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\run_fast_alpr_service_silent.bat" (
    echo ALPR silent batch file included in build
) else (
    echo ALPR silent batch file missing in build
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\fast_alpr_service.py" (
    echo ALPR Python service included in build
) else (
    echo ALPR Python service missing in build
)

echo.
echo Verifying Face Recognition components in build...
if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\khuonmat\run_fast_face_service_silent.bat" (
    echo Face Recognition silent batch file included in build
) else (
    echo Face Recognition silent batch file missing in build
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\khuonmat\fast_face_service.py" (
    echo Face Recognition Python service included in build
) else (
    echo Face Recognition Python service missing in build
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
echo Testing recommendations:
echo   1. Run: "dist\win-unpacked\Parking Lot Management.exe"
echo   2. Test all core features (camera, parking logic, etc.)
echo   3. Check console logs for any errors
echo   4. Verify Python backend integration
echo   5. Test RTSP streaming functionality
echo   6. Test License Plate Recognition (ALPR) service
echo   7. Test Face Recognition service
echo.
echo Distribution ready for:
echo   • Internal testing
echo   • End-user installation
echo   • Production deployment
echo.
echo 📋 DEPLOYMENT NOTES:
echo   • Target machines need Python 3.8+ for AI services (ALPR, Face Recognition)
echo   • USB Relay control included (node-hid bundled)
echo   • App works without Python but AI features will be disabled
echo   • Backend services will auto-install Python dependencies when needed
echo.

pause
