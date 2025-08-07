@echo off
echo ================================================
echo Testing Python ALPR Service
echo ================================================

echo.
echo 🐍 Testing Python installation...
python --version
if %errorlevel% neq 0 (
    echo ❌ Python not found
    pause
    exit /b 1
)

echo.
echo 📦 Testing Python packages...
python -c "import fastapi; print('✅ FastAPI:', fastapi.__version__)" || (echo ❌ FastAPI not installed && exit /b 1)
python -c "import uvicorn; print('✅ Uvicorn:', uvicorn.__version__)" || (echo ❌ Uvicorn not installed && exit /b 1)
python -c "import cv2; print('✅ OpenCV:', cv2.__version__)" || (echo ❌ OpenCV not installed && exit /b 1)
python -c "import numpy; print('✅ NumPy:', numpy.__version__)" || (echo ❌ NumPy not installed && exit /b 1)

echo.
echo 🚀 Starting ALPR service...

REM Determine the correct path for the service
if exist "..\backend\bienso\fast_alpr_service.py" (
    set "SERVICE_PATH=..\backend\bienso\fast_alpr_service.py"
    echo 📁 Using development path
) else if exist "backend\bienso\fast_alpr_service.py" (
    set "SERVICE_PATH=backend\bienso\fast_alpr_service.py"
    echo 📁 Using production path
) else (
    echo ❌ ALPR service not found
    pause
    exit /b 1
)

echo Starting service at: %SERVICE_PATH%
start /b python "%SERVICE_PATH%"

echo.
echo ⏳ Waiting for service to start...
timeout /t 5 /nobreak >nul

echo.
echo 🧪 Testing service endpoint...
curl -s http://127.0.0.1:5001/healthz
if %errorlevel% equ 0 (
    echo.
    echo ✅ ALPR service is working correctly!
    echo Service is running on http://127.0.0.1:5001
) else (
    echo.
    echo ❌ ALPR service is not responding
    echo Check if port 5001 is available
)

echo.
echo 🛑 Stopping test service...
taskkill /f /im python.exe >nul 2>&1

echo.
echo 📋 Test completed!
pause
