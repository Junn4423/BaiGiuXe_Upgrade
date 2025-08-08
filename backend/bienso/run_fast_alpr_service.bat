@echo off
echo ========================================
echo    Fast ALPR Service Launcher
echo ========================================

REM Set console title
title Fast ALPR Service

REM Set working directory to the script location
cd /d "%~dp0"

echo.
echo 📍 Current directory: %cd%
echo.

REM Check if virtual environment exists
if exist "venv\Scripts\python.exe" (
    echo ✅ Virtual environment found
    set PYTHON_EXE=venv\Scripts\python.exe
) else if exist "venv\bin\python" (
    echo ✅ Virtual environment found (Linux style)
    set PYTHON_EXE=venv\bin\python
) else (
    echo ⚠️  Virtual environment not found, using system Python
    set PYTHON_EXE=python
)

echo 🐍 Using Python: %PYTHON_EXE%
echo.

REM Check if fast_alpr_service.py exists
if not exist "fast_alpr_service.py" (
    echo ❌ fast_alpr_service.py not found in current directory!
    echo    Current directory: %cd%
    exit /b 1
)

echo ✅ fast_alpr_service.py found
echo.

REM Display service info
echo 🚀 Starting Fast ALPR Service...
echo    Service will run on: http://127.0.0.1:5001
echo    Endpoints:
echo      POST /detect  - License plate detection
echo      GET  /healthz - Health check
echo.

REM Activate virtual environment if it exists and start the service
if exist "venv\Scripts\activate.bat" (
    echo 🔧 Activating virtual environment...
    call venv\Scripts\activate.bat
    echo ✅ Virtual environment activated
    echo.
)

REM Start the service with improved error handling
echo 🏃 Launching Fast ALPR Service...
echo.

"%PYTHON_EXE%" fast_alpr_service.py --host 127.0.0.1 --port 5001

REM Check exit code
if %ERRORLEVEL% neq 0 (
    echo.
    echo ❌ Fast ALPR Service exited with error code: %ERRORLEVEL%
    echo.
    echo 🔍 Common issues:
    echo   - Missing Python dependencies (run: pip install -r requirements.txt)
    echo   - Port 5001 already in use
    echo   - CUDA/GPU drivers not installed
    echo   - Virtual environment not properly set up
    echo.
) else (
    echo.
    echo ✅ Fast ALPR Service stopped normally
    echo.
)
