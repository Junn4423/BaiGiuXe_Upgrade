@echo off
echo Building Parking Lot Management for Windows...
echo.

REM Check if Node.js is installed
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo Error: Node.js is not installed or not in PATH
    pause
    exit /b 1
)

REM Check if npm is installed
npm --version >nul 2>&1
if %errorlevel% neq 0 (
    echo Error: npm is not installed or not in PATH
    pause
    exit /b 1
)

echo Step 1: Installing dependencies...
call npm install
if %errorlevel% neq 0 (
    echo Error: Failed to install dependencies
    pause
    exit /b 1
)

echo.
echo Step 2: Building React frontend...
cd ..\frontend
call npm install
call npm run build
if %errorlevel% neq 0 (
    echo Error: Failed to build frontend
    pause
    exit /b 1
)

echo.
echo Step 3: Building Electron app for Windows...
cd ..\electron-app
call npm run build-win
if %errorlevel% neq 0 (
    echo Error: Failed to build Electron app
    pause
    exit /b 1
)

echo.
echo Build completed successfully!
echo Check the 'dist' folder for the installer.
echo.
pause
