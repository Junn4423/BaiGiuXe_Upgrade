@echo off
echo ================================================
echo   FIXING ELECTRON HEADERS FOR NODE-HID BUILD
echo ================================================

echo.
echo Clearing electron-gyp cache...
if exist "%USERPROFILE%\.electron-gyp" (
    rmdir /s /q "%USERPROFILE%\.electron-gyp"
    echo Electron-gyp cache cleared
)

echo.
echo Downloading electron headers manually...
REM Install electron-download to get headers
call npm install electron-download --no-save

echo.
echo Setting environment variables for electron build...
set npm_config_target=37.0.0
set npm_config_arch=x64
set npm_config_target_arch=x64
set npm_config_disturl=https://electronjs.org/headers
set npm_config_runtime=electron
set npm_config_cache=%cd%\.npm
set npm_config_build_from_source=true

echo.
echo Pre-downloading electron headers...
node -e "
const electronDownload = require('electron-download');
electronDownload({
  version: '37.0.0',
  arch: 'x64',
  platform: 'win32',
  cache: '%cd%\\.npm'
}, function(err, zipPath) {
  if (err) {
    console.error('Failed to download electron:', err);
  } else {
    console.log('Electron headers downloaded:', zipPath);
  }
});
"

echo.
echo Installing node-hid with prebuilt check...
call npm install node-hid --build-from-source --target=37.0.0 --runtime=electron --arch=x64

if %ERRORLEVEL% neq 0 (
    echo ❌ Build from source failed, trying alternative methods...
    
    echo Trying with electron-rebuild...
    call npx electron-rebuild -f -w node-hid
    
    if %ERRORLEVEL% neq 0 (
        echo ❌ All build methods failed
        echo ⚠️ USB relay features will be disabled
        echo To enable USB relay:
        echo 1. Install Visual Studio Build Tools 2019/2022
        echo 2. Install Python 3.8+
        echo 3. Run: npm install node-hid --build-from-source
        exit /b 1
    )
)

echo ✅ node-hid installed successfully
exit /b 0
