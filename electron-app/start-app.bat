@echo off
title Parking Lot Management System Launcher

echo ================================================
echo    Parking Lot Management System Launcher
echo ================================================
echo.

REM Check if this is a built app or development environment
if exist "Parking Lot Management.exe" (
    echo 🔧 Production mode detected
    set "MODE=PRODUCTION"
) else (
    echo 🔧 Development mode detected  
    set "MODE=DEVELOPMENT"
)

echo.
echo 🐍 Checking Python environment...

REM Check Python installation
python --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Python is not installed or not in PATH
    echo.
    echo To use license plate recognition, please:
    echo 1. Install Python 3.8+ from https://python.org
    echo 2. Make sure "Add Python to PATH" is checked
    echo 3. Restart this application
    echo.
    echo ⚠️ Continuing without license plate recognition...
    timeout /t 5 /nobreak >nul
    goto :launch_app
)

echo ✅ Python found:
python --version

REM Install dependencies if needed
echo.
echo 📦 Setting up Python dependencies...

if "%MODE%"=="PRODUCTION" (
    if exist "resources\app.asar.unpacked\backend\requirements.txt" (
        cd "resources\app.asar.unpacked\backend"
        pip install -r requirements.txt --quiet --disable-pip-version-check
        cd "..\..\.."
    )
) else (
    if exist "..\backend\requirements.txt" (
        cd "..\backend"
        pip install -r requirements.txt --quiet --disable-pip-version-check
        cd "..\electron-app"
    )
)

echo ✅ Python environment ready

:launch_app
echo.
echo 🚀 Starting Parking Lot Management System...

if "%MODE%"=="PRODUCTION" (
    start "" "Parking Lot Management.exe"
) else (
    call npm start
)

echo.
echo 📝 System Information:
echo - Mode: %MODE%
echo - Python: Available for license plate recognition
echo - RTSP: Enabled for camera streaming
echo - Time: %date% %time%
echo.
echo 💡 Tips:
echo - Press F11 to toggle fullscreen
echo - Check console for system logs
echo - Ensure cameras are connected and configured
echo.

if "%MODE%"=="PRODUCTION" (
    echo Application started! Check the app window.
) else (
    echo Development server started! Check console for logs.
)

pause
