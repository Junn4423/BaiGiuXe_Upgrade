@echo off
echo ========================================
echo    RELAY API SYSTEM TEST SCRIPT
echo ========================================
echo.

REM Kiểm tra Python
echo [1/6] Checking Python installation...
python --version >nul 2>&1
if %ERRORLEVEL% neq 0 (
    echo ❌ Python not found! Please install Python 3.7+
    pause
    exit /b 1
)
echo ✅ Python found

REM Kiểm tra dependencies
echo.
echo [2/6] Checking Python dependencies...
cd /d "%~dp0backend\relay"
pip show hidapi >nul 2>&1
if %ERRORLEVEL% neq 0 (
    echo ❌ hidapi not found! Installing...
    pip install hidapi
)

pip show fastapi >nul 2>&1
if %ERRORLEVEL% neq 0 (
    echo ❌ fastapi not found! Installing...
    pip install fastapi
)

pip show uvicorn >nul 2>&1
if %ERRORLEVEL% neq 0 (
    echo ❌ uvicorn not found! Installing...
    pip install uvicorn
)
echo ✅ All dependencies ready

REM Kiểm tra port 5003
echo.
echo [3/6] Checking port 5003 availability...
netstat -an | find ":5003" | find "LISTENING" >nul 2>&1
if %ERRORLEVEL% equ 0 (
    echo ⚠️ Port 5003 is already in use. Stopping existing service...
    taskkill /F /IM python.exe /FI "WINDOWTITLE eq Relay Service*" >nul 2>&1
    timeout /t 2 >nul
)
echo ✅ Port 5003 is available

REM Khởi động service
echo.
echo [4/6] Starting Relay Service...
start "Relay Service" cmd /c "python fast_relay_service.py"
timeout /t 5

REM Test health endpoint
echo.
echo [5/6] Testing service health...
curl -s http://localhost:5003/health >nul 2>&1
if %ERRORLEVEL% neq 0 (
    echo ❌ Service health check failed!
    echo Make sure the service is running on port 5003
    pause
    exit /b 1
)
echo ✅ Service is healthy

REM Test basic endpoints
echo.
echo [6/6] Testing API endpoints...

echo Testing /health...
curl -s http://localhost:5003/health
echo.

echo Testing /device-info...
curl -s http://localhost:5003/device-info
echo.

echo.
echo ========================================
echo     🎉 ALL TESTS COMPLETED! 🎉
echo ========================================
echo.
echo Service is running on: http://localhost:5003
echo.
echo Available endpoints:
echo   - GET  /health           (Health check)
echo   - GET  /device-info      (Device information)
echo   - POST /connect          (Connect to relay)
echo   - POST /disconnect       (Disconnect from relay)
echo   - POST /control          (Control specific relay)
echo   - POST /control-bitmask  (Control with bitmask)
echo   - POST /turn-off-all     (Turn off all relays)
echo   - POST /test-sequence    (Test sequence)
echo   - POST /test-bitmask-patterns (Test bitmask patterns)
echo   - POST /sequence-test    (NEW: Sequence test full loop)
echo.
echo 📋 Next steps:
echo   1. Open your parking system application
echo   2. Go to Relay Control menu
echo   3. Click 'Kết nối' to connect USB relay
echo   4. Test all functions
echo.
echo 🛑 To stop the service: STOP_RELAY_SERVICE.bat
echo.
pause
