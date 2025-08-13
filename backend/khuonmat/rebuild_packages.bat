@echo off
cd /d "%~dp0"

echo ================================================================
echo              REBUILD PYTHON PACKAGES FIX
echo ================================================================
echo.
echo This script will rebuild packages that may need pybind11^>=2.12
echo and fix NumPy/OpenCV compatibility issues.
echo.

if not exist "venv" (
    echo [ERROR] Virtual environment not found!
    echo Please run setup first.
    pause
    exit /b 1
)

echo [1] Activating virtual environment...
call venv\Scripts\activate.bat

echo.
echo [2] Checking current package versions...
echo Current NumPy version:
python -c "import numpy; print(numpy.__version__)" 2>nul
echo Current OpenCV version:
python -c "import cv2; print(cv2.__version__)" 2>nul
echo Current pybind11 version:
python -c "import pybind11; print(pybind11.__version__)" 2>nul || echo pybind11 not installed

echo.
echo [3] Upgrading build tools...
python -m pip install --upgrade pip
pip install --upgrade setuptools wheel
pip install "pybind11>=2.12"

echo.
echo [4] Fixing NumPy/OpenCV compatibility...
echo Uninstalling current OpenCV and NumPy...
pip uninstall -y opencv-python opencv-contrib-python numpy

echo.
echo [5] Installing compatible versions...
pip install numpy==1.24.3
pip install opencv-python==4.8.1.78

echo.
echo [6] Rebuilding packages that need pybind11...
echo Reinstalling dlib (requires rebuild)...
pip uninstall -y dlib
pip install dlib --no-cache-dir

echo Reinstalling face_recognition...
pip uninstall -y face_recognition
pip install face_recognition --no-cache-dir

echo.
echo [7] Installing other dependencies...
pip install -r requirements.txt --force-reinstall

echo.
echo [8] Testing imports...
python -c "
try:
    import numpy as np
    import cv2
    import torch
    import dlib
    import face_recognition
    print('All imports successful!')
    print(f'NumPy: {np.__version__}')
    print(f'OpenCV: {cv2.__version__}')
    print(f'PyTorch: {torch.__version__}')
    print(f'face_recognition: OK')
except Exception as e:
    print(f'Import error: {e}')
"

echo.
echo ================================================================
echo                     REBUILD COMPLETE
echo ================================================================
echo If you still get errors, try:
echo 1. Install Visual C++ Build Tools
echo 2. Restart computer and try again
echo 3. Use a different Python version
echo ================================================================
pause
