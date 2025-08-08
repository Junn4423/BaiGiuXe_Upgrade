@echo off
echo Testing Production Virtual Environment
echo =====================================
echo.

REM Change to production build directory
if not exist "dist\win-unpacked" (
    echo ❌ Production build not found!
    echo Please run build-windows-python-integrated.bat first
    pause
    exit /b 1
)

cd "dist\win-unpacked"

echo 🔍 Checking virtual environment in production build...

REM Check different possible paths for virtual environment
set "VENV_PATH1=resources\app.asar.unpacked\backend\bienso\venv"
set "VENV_PATH2=resources\backend\bienso\venv"
set "VENV_PATH3=backend\bienso\venv"

echo Checking virtual environment paths:

if exist "%VENV_PATH1%\Scripts\python.exe" (
    echo ✅ Virtual environment found at: %VENV_PATH1%
    set "VENV_PATH=%VENV_PATH1%"
    set "SCRIPT_PATH=resources\app.asar.unpacked\backend\bienso\fast_alpr_service.py"
) else if exist "%VENV_PATH2%\Scripts\python.exe" (
    echo ✅ Virtual environment found at: %VENV_PATH2%
    set "VENV_PATH=%VENV_PATH2%"
    set "SCRIPT_PATH=resources\backend\bienso\fast_alpr_service.py"
) else if exist "%VENV_PATH3%\Scripts\python.exe" (
    echo ✅ Virtual environment found at: %VENV_PATH3%
    set "VENV_PATH=%VENV_PATH3%"
    set "SCRIPT_PATH=backend\bienso\fast_alpr_service.py"
) else (
    echo ❌ Virtual environment not found in any expected location
    echo Checked paths:
    echo - %VENV_PATH1%
    echo - %VENV_PATH2%
    echo - %VENV_PATH3%
    pause
    exit /b 1
)

echo.
echo 🐍 Testing Python installation in virtual environment...
"%VENV_PATH%\Scripts\python.exe" --version
if %errorlevel% neq 0 (
    echo ❌ Python not working in virtual environment
    pause
    exit /b 1
)

echo.
echo 📦 Testing required packages...
echo Testing fast_alpr...
"%VENV_PATH%\Scripts\python.exe" -c "import fast_alpr; print('✅ fast_alpr imported successfully')"
if %errorlevel% neq 0 (
    echo ❌ fast_alpr not available
    echo Installing missing packages...
    "%VENV_PATH%\Scripts\pip.exe" install fast_alpr onnxruntime python-multipart
)

echo Testing onnxruntime...
"%VENV_PATH%\Scripts\python.exe" -c "import onnxruntime; print('✅ onnxruntime imported successfully')"
if %errorlevel% neq 0 (
    echo ❌ onnxruntime not available
    echo Installing onnxruntime...
    "%VENV_PATH%\Scripts\pip.exe" install onnxruntime
)

echo Testing python-multipart...
"%VENV_PATH%\Scripts\python.exe" -c "import multipart; print('✅ python-multipart imported successfully')"
if %errorlevel% neq 0 (
    echo ❌ python-multipart not available
    echo Installing python-multipart...
    "%VENV_PATH%\Scripts\pip.exe" install python-multipart
)

echo Testing fastapi...
"%VENV_PATH%\Scripts\python.exe" -c "import fastapi; print('✅ fastapi imported successfully')"
if %errorlevel% neq 0 (
    echo ❌ fastapi not available
    echo Installing fastapi...
    "%VENV_PATH%\Scripts\pip.exe" install fastapi uvicorn
)

echo.
echo 🚀 Testing ALPR service startup...
if exist "%SCRIPT_PATH%" (
    echo Starting ALPR service...
    start /b "%VENV_PATH%\Scripts\python.exe" "%SCRIPT_PATH%" --host 127.0.0.1 --port 5001
    
    echo ⏳ Waiting for service to start...
    timeout /t 10 /nobreak >nul
    
    echo Testing service endpoint...
    curl -s http://127.0.0.1:5001/healthz
    if %errorlevel% equ 0 (
        echo.
        echo ✅ ALPR service is working correctly in production build!
        echo Service is running on http://127.0.0.1:5001
    ) else (
        echo.
        echo ❌ ALPR service is not responding
    )
    
    echo.
    echo Stopping test service...
    taskkill /f /im python.exe >nul 2>&1
) else (
    echo ❌ ALPR service script not found at: %SCRIPT_PATH%
)

echo.
echo 📋 Test Summary:
echo ==============
echo Virtual Environment: %VENV_PATH%
echo Script Path: %SCRIPT_PATH%
echo.

cd "..\..\.."
pause
