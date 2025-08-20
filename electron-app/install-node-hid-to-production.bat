@echo off
echo ================================================
echo   INSTALLING REAL NODE-HID INTO PRODUCTION BUILD
echo ================================================

echo.
echo Checking production build exists...
if not exist "dist\win-unpacked\Parking Lot Management.exe" (
    echo ❌ Production build not found!
    echo Please run build-skip-node-hid.bat first
    pause
    exit /b 1
)

echo ✅ Production build found

echo.
echo Setting up temporary environment for node-hid build...
set ORIGINAL_DIR=%cd%
set BUILD_DIR=dist\win-unpacked\resources\app.asar.unpacked

cd "%BUILD_DIR%"

echo.
echo Current directory: %cd%

echo.
echo Installing node-hid into production build...
echo Target: %cd%

REM Set environment variables for electron build
set npm_config_target=37.0.0
set npm_config_arch=x64
set npm_config_target_arch=x64
set npm_config_disturl=https://electronjs.org/headers
set npm_config_runtime=electron
set npm_config_cache=%ORIGINAL_DIR%\.npm

echo.
echo Method 1: Installing node-hid with electron headers...
call npm install node-hid --build-from-source --target=37.0.0 --runtime=electron --arch=x64

if %ERRORLEVEL% equ 0 (
    echo ✅ node-hid installed successfully via Method 1
    cd "%ORIGINAL_DIR%"
    goto :success
)

echo.
echo Method 1 failed, trying Method 2: electron-rebuild...
call npm install node-hid --ignore-scripts
call npm install electron-rebuild --no-save
call npx electron-rebuild -f -w node-hid --version 37.0.0 --arch x64

if %ERRORLEVEL% equ 0 (
    echo ✅ node-hid installed successfully via Method 2
    cd "%ORIGINAL_DIR%"
    goto :success
)

echo.
echo Method 2 failed, trying Method 3: Copy prebuilt from source...
cd "%ORIGINAL_DIR%"

REM Try to copy from source node_modules if exists
if exist "node_modules\node-hid\build\Release\HID.node" (
    echo Copying node-hid from source...
    xcopy /E /I "node_modules\node-hid" "%BUILD_DIR%\node_modules\node-hid\"
    echo ✅ node-hid copied from source
    goto :success
)

echo.
echo Method 3 failed, trying Method 4: Build in main directory then copy...
echo Building node-hid in main directory...

REM Install and build in main directory first
call npm install node-hid --build-from-source --target=37.0.0 --runtime=electron --arch=x64

if %ERRORLEVEL% equ 0 (
    echo Copying built node-hid to production...
    xcopy /E /I "node_modules\node-hid" "%BUILD_DIR%\node_modules\node-hid\"
    echo ✅ node-hid built and copied successfully
    goto :success
)

echo ❌ All methods failed to install node-hid
echo.
echo SOLUTIONS:
echo 1. Install Python 3.8+ and add to PATH
echo 2. Install Visual Studio Build Tools 2022
echo 3. Run: npm config set python python
echo 4. Try running this script again
echo.
cd "%ORIGINAL_DIR%"
pause
exit /b 1

:success
echo.
echo ================================================
echo   NODE-HID INSTALLATION COMPLETE!
echo ================================================
echo.
echo Verifying installation...
if exist "%BUILD_DIR%\node_modules\node-hid\build\Release\HID.node" (
    echo ✅ HID.node binary found
) else (
    echo ❌ HID.node binary missing
)

if exist "%BUILD_DIR%\node_modules\node-hid\package.json" (
    echo ✅ node-hid package.json found
) else (
    echo ❌ node-hid package.json missing
)

echo.
echo 🎉 USB Relay control is now ENABLED in production build!
echo.
echo You can now:
echo 1. Test the app: "dist\win-unpacked\Parking Lot Management.exe"
echo 2. USB relay features should work properly
echo 3. Deploy using installer with full functionality
echo.
pause
