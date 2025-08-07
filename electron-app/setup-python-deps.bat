@echo off
REM ================================================
REM Python Dependencies Setup for Parking Lot App
REM ================================================

echo 🐍 Setting up Python environment for Parking Lot Management...

REM Check if Python is installed
python --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Error: Python is not installed or not in PATH
    echo.
    echo Please install Python 3.8+ from https://python.org
    echo Make sure to check "Add Python to PATH" during installation
    echo.
    pause
    exit /b 1
)

echo ✅ Python found:
python --version

echo.
echo 📦 Installing required Python packages...

REM Check if we're in development or production environment
if exist "..\backend\requirements.txt" (
    echo 🔧 Development environment detected
    cd "..\backend"
    pip install -r requirements.txt
    if %errorlevel% neq 0 (
        echo ❌ Failed to install Python dependencies
        pause
        exit /b 1
    )
    cd "..\electron-app"
) else if exist "backend\requirements.txt" (
    echo 🔧 Production environment detected
    cd "backend"
    pip install -r requirements.txt
    if %errorlevel% neq 0 (
        echo ❌ Failed to install Python dependencies
        pause
        exit /b 1
    )
    cd ".."
) else (
    echo ❌ requirements.txt not found
    echo Looking for:
    echo - ..\backend\requirements.txt
    echo - backend\requirements.txt
    pause
    exit /b 1
)

echo ✅ Python dependencies installed successfully!
echo.
echo 🧪 Testing Python modules...

python -c "import fastapi; print('✅ FastAPI OK')" 2>nul || echo "❌ FastAPI not installed"
python -c "import uvicorn; print('✅ Uvicorn OK')" 2>nul || echo "❌ Uvicorn not installed"
python -c "import cv2; print('✅ OpenCV OK')" 2>nul || echo "❌ OpenCV not installed"
python -c "import numpy; print('✅ NumPy OK')" 2>nul || echo "❌ NumPy not installed"

echo.
echo 🎉 Python setup completed!
echo The ALPR service should now work properly.
echo.
pause
