@echo off
chcp 65001 >nul
echo ================================================
echo     USB RELAY DEPENDENCY INSTALLER
echo ================================================
echo.

cd /d "%~dp0electron-app"

echo Installing node-hid dependency for USB Relay control...
echo.

echo Current directory: %CD%
echo Installing node-hid...

call npm install node-hid
if %errorlevel% neq 0 (
    echo ❌ Failed to install node-hid dependency
    echo.
    echo This might be due to:
    echo 1. Missing Visual Studio Build Tools
    echo 2. Missing Python 3.x
    echo 3. Missing Windows SDK
    echo.
    echo Solutions:
    echo 1. Install Visual Studio Build Tools: https://visualstudio.microsoft.com/downloads/
    echo 2. Install Python 3.x from: https://www.python.org/downloads/
    echo 3. Run: npm install --global windows-build-tools
    echo.
    pause
    exit /b 1
)

echo.
echo ✅ node-hid dependency installed successfully!
echo.
echo You can now use USB Relay control features in the Electron app.
echo.
pause
