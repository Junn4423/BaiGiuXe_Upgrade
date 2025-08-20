@echo off
echo ================================================
echo   INSTALLING NODE-HID WITH PREBUILT BINARIES
echo ================================================

echo.
echo Method 1: Installing from prebuilt binaries...
call npm install node-hid --prefer-offline --no-rebuild --ignore-scripts

if %ERRORLEVEL% equ 0 (
    echo ✅ node-hid installed with prebuilt binaries
    exit /b 0
)

echo.
echo Method 2: Trying with electron-rebuild...
call npm install electron-rebuild --no-save
call npx electron-rebuild --version 37.0.0 --arch x64 --module-dir node_modules/node-hid

if %ERRORLEVEL% equ 0 (
    echo ✅ node-hid rebuilt successfully
    exit /b 0
)

echo.
echo Method 3: Using alternative USB HID library...
call npm uninstall node-hid
call npm install usb-detection --save

if %ERRORLEVEL% equ 0 (
    echo ✅ Alternative USB library installed
    echo ⚠️  You may need to update relay control code to use usb-detection
    exit /b 0
)

echo.
echo Method 4: Manual prebuilt download...
mkdir prebuilt 2>nul
cd prebuilt
curl -L -o node-hid.tar.gz "https://github.com/node-hid/node-hid/releases/download/v2.2.0/node-hid-v2.2.0-electron-v37.0.0-win32-x64.tar.gz"
if exist node-hid.tar.gz (
    tar -xzf node-hid.tar.gz
    copy *.node ..\node_modules\node-hid\build\Release\ 2>nul
    cd ..
    echo ✅ Manual prebuilt installation completed
    exit /b 0
)

cd ..
echo ❌ All installation methods failed
echo ⚠️  USB relay features will be disabled in the final build
echo.
echo To enable USB relay features later:
echo 1. Install Visual Studio Build Tools 2022
echo 2. Install Python 3.8+ 
echo 3. Run: npm install node-hid --build-from-source
echo.
exit /b 1
