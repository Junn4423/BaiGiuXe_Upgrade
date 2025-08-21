@echo off
chcp 65001 >nul
echo ================================================
echo     PARKING LOT MANAGEMENT SYSTEM STOPPER
echo ================================================
echo.

REM Tạo timestamp cho log
for /f "tokens=1-4 delims=/ " %%a in ('date /t') do set "current_date=%%a-%%b-%%c"
for /f "tokens=1-2 delims=: " %%a in ('time /t') do set "current_time=%%a-%%b"
set "timestamp=%current_date%_%current_time%"

echo [%timestamp%] Stopping Parking Lot Management System...
echo.

REM ================================================
REM BƯỚC 1: DỪNG ELECTRON APP
REM ================================================
echo [%timestamp%] Step 1: Stopping Electron Application...
taskkill /F /IM electron.exe >nul 2>&1
taskkill /F /IM "Parking System.exe" >nul 2>&1
echo ✅ Electron App stopped
echo.

REM ================================================
REM BƯỚC 2: DỪNG ALPR SERVICE
REM ================================================
echo [%timestamp%] Step 2: Stopping ALPR Service...
cd /d "%~dp0backend\bienso"
if exist "stop_alpr_service.bat" (
    call stop_alpr_service.bat >nul 2>&1
    echo ✅ ALPR Service stopped using script
) else (
    echo ⚠️  ALPR stop script not found, killing processes manually...
    for /f "tokens=2" %%i in ('wmic process where "commandline like '%%fast_alpr_service.py%%' and name='python.exe'" get processid /value 2^>nUL ^| find "="') do taskkill /PID %%i /F >nul 2>&1
    echo ✅ ALPR Service processes killed
)
echo.

REM ================================================
REM BƯỚC 3: DỪNG FACE RECOGNITION SERVICE
REM ================================================
echo [%timestamp%] Step 3: Stopping Face Recognition Service...
cd /d "%~dp0backend\khuonmat"
if exist "stop_face_service.bat" (
    call stop_face_service.bat >nul 2>&1
    echo ✅ Face Recognition Service stopped using script
) else (
    echo ⚠️  Face Recognition stop script not found, killing processes manually...
    for /f "tokens=2" %%i in ('wmic process where "commandline like '%%fast_face_service.py%%' and name='python.exe'" get processid /value 2^>nUL ^| find "="') do taskkill /PID %%i /F >nul 2>&1
    echo ✅ Face Recognition Service processes killed
)
echo.

REM ================================================
REM BƯỚC 4: DỪNG FAST RELAY SERVICE
REM ================================================
echo [%timestamp%] Step 4: Stopping Fast Relay Service...
cd /d "%~dp0backend\relay"
if exist "stop_relay_service.bat" (
    call stop_relay_service.bat >nul 2>&1
    echo ✅ Fast Relay Service stopped using script
) else (
    echo ⚠️  Relay stop script not found, killing processes manually...
    for /f "tokens=2" %%i in ('wmic process where "commandline like '%%fast_relay_service.py%%' and name='python.exe'" get processid /value 2^>nUL ^| find "="') do taskkill /PID %%i /F >nul 2>&1
    echo ✅ Fast Relay Service processes killed
echo.

REM ================================================
REM BƯỚC 5: DỪNG CÁC PROCESS KHÁC
REM ================================================
echo [%timestamp%] Step 5: Stopping other processes...

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
echo ✅ Face Recognition Service (Python)
echo ✅ Fast Relay Service (Python)
echo ✅ MinIO Server  
echo ✅ Frontend Development Server
echo ✅ Electron Application
echo ================================================
echo.
echo System has been stopped successfully!
echo You can now close this window.
echo.
pause
