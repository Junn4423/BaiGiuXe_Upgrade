@echo off
REM Script to handle node-hid installation with multiple fallback methods
echo ================================================
echo   INSTALLING NODE-HID FOR USB RELAY CONTROL
echo ================================================

echo.
echo Method 1: Trying prebuilt binaries...
call npm install node-hid --force --prefer-prebuilt --no-optional

if %ERRORLEVEL% equ 0 (
    echo ✅ node-hid installed successfully with prebuilt binaries
    exit /b 0
)

echo.
echo Method 2: Trying electron-prebuilt-compile...
call npm install node-hid --electron-prebuilt-compile-cache

if %ERRORLEVEL% equ 0 (
    echo ✅ node-hid installed successfully with electron compile cache
    exit /b 0
)

echo.
echo Method 3: Trying ignore scripts...
set npm_config_rebuild=false
set npm_config_build_from_source=false
call npm install node-hid --ignore-scripts --force

if %ERRORLEVEL% equ 0 (
    echo ✅ node-hid installed successfully without scripts
    exit /b 0
)

echo.
echo Method 4: Trying with legacy-peer-deps...
call npm install node-hid --legacy-peer-deps --force

if %ERRORLEVEL% equ 0 (
    echo ✅ node-hid installed successfully with legacy peer deps
    exit /b 0
)

echo.
echo Method 5: Trying manual download approach...
if not exist "node_modules\node-hid" (
    mkdir "node_modules\node-hid"
)

REM Try to copy from another working installation or download
echo Attempting to find existing node-hid installation...
for /d %%i in (C:\Users\*\AppData\Roaming\npm\node_modules\node-hid*) do (
    if exist "%%i" (
        echo Found node-hid at: %%i
        xcopy "%%i" "node_modules\node-hid\" /E /Y /Q
        if %ERRORLEVEL% equ 0 (
            echo ✅ node-hid copied successfully
            exit /b 0
        )
    )
)

echo.
echo ❌ All installation methods failed
echo.
echo The app will work but USB relay features will be disabled
echo.
echo To enable USB relay features manually:
echo 1. Install Python 3.8+ from https://www.python.org/downloads/
echo 2. Install Visual Studio Build Tools from:
echo    https://visualstudio.microsoft.com/visual-cpp-build-tools/
echo 3. Run: npm install --global windows-build-tools
echo 4. Run: npm config set python python
echo 5. Run: npm install node-hid --force
echo.
echo Alternative: Use USB relay control software separately
echo.
exit /b 0
