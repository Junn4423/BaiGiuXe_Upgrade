@echo off
chcp 65001 >nul
echo ================================================
echo     PYTHON ENVIRONMENT SETUP FOR ALPR
echo ================================================
echo.

cd /d "%~dp0backend\bienso"

echo Setting up Python virtual environment...
if exist "venv" (
    echo Virtual environment already exists. Removing old one...
    rmdir /s /q venv
)

echo Creating new virtual environment...
python -m venv venv
if %errorlevel% neq 0 (
    echo ❌ Failed to create virtual environment
    echo Make sure Python is installed and added to PATH
    pause
    exit /b 1
)

echo ✅ Virtual environment created

echo.
echo Activating virtual environment and installing packages...
call venv\Scripts\activate.bat

echo Installing core packages...
pip install --upgrade pip

echo Installing FastAPI and Uvicorn...
pip install fastapi uvicorn

echo Installing computer vision packages...
pip install opencv-python numpy

echo Installing fast_alpr package...
REM Try different package names for fast_alpr
pip install fast-alpr
if %errorlevel% neq 0 (
    echo Trying alternative package name...
    pip install fastalpr
    if %errorlevel% neq 0 (
        echo Trying yet another alternative...
        pip install fast_alpr
        if %errorlevel% neq 0 (
            echo ❌ Failed to install fast_alpr package
            echo You may need to install it manually or use a different ALPR library
            echo.
            echo Alternative options:
            echo 1. pip install easyocr
            echo 2. pip install paddlepaddle paddleocr
            echo 3. Download fast_alpr from specific source
            pause
            exit /b 1
        )
    )
)

echo Installing onnxruntime...
pip install onnxruntime
if %errorlevel% neq 0 (
    echo ❌ Failed to install onnxruntime
    pause
    exit /b 1
)

echo Installing python-multipart...
pip install python-multipart
if %errorlevel% neq 0 (
    echo ❌ Failed to install python-multipart
    pause
    exit /b 1
)

echo.
echo ✅ Python environment setup completed!
echo.
echo Testing Python imports...
python -c "import cv2; print('✅ OpenCV imported successfully')"
python -c "import numpy; print('✅ NumPy imported successfully')"
python -c "import fastapi; print('✅ FastAPI imported successfully')"
python -c "import uvicorn; print('✅ Uvicorn imported successfully')"
python -c "import onnxruntime; print('✅ onnxruntime imported successfully')"
python -c "import multipart; print('✅ python-multipart imported successfully')"

REM Test fast_alpr import
python -c "try: import fast_alpr; print('✅ fast_alpr imported successfully')
except ImportError as e: 
    try: import fastalpr; print('✅ fastalpr imported successfully')
    except ImportError as e2: print('❌ ALPR package import failed:', str(e2))"

echo.
echo Environment setup completed! You can now run START_PARKING_SYSTEM.bat
echo.
pause
