@echo off
chcp 65001 >nul
echo ================================================
echo     STOP PARKING LOT MANAGEMENT SYSTEM
echo ================================================
echo.

echo Stopping all Parking Lot Management System services...

REM Stop ALPR Service (Python)
echo Stopping ALPR Service...
taskkill /f /im python.exe >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ ALPR Service stopped
) else (
    echo ⚠️  ALPR Service was not running
)

REM Stop MinIO Server
echo Stopping MinIO Server...
taskkill /f /im minio.exe >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ MinIO Server stopped
) else (
    echo ⚠️  MinIO Server was not running
)

REM Stop Node.js processes (Electron and Frontend dev)
echo Stopping Node.js processes...
taskkill /f /im node.exe >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ Node.js processes stopped
) else (
    echo ⚠️  Node.js processes were not running
)

REM Stop Electron processes
echo Stopping Electron processes...
taskkill /f /im electron.exe >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ Electron processes stopped
) else (
    echo ⚠️  Electron processes were not running
)

REM Stop any remaining parking-lot-management processes
taskkill /f /im "parking-lot-management.exe" >nul 2>&1

echo.
echo ================================================
echo  ALL SERVICES STOPPED
echo ================================================
echo ✅ ALPR Service (Python)
echo ✅ MinIO Server  
echo ✅ Frontend Development Server
echo ✅ Electron Application
echo ================================================
echo.
echo System has been stopped successfully!
echo You can now close this window.
echo.
pause
