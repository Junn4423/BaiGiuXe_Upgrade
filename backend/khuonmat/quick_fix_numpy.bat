@echo off
REM =====================================================
REM SCRIPT SỬA NHANH LỖI NUMPY-OPENCV
REM =====================================================

echo.
echo [QUICK FIX] Sửa lỗi NumPy-OpenCV compatibility...
echo.

cd /d "%~dp0face_recognition_system"
call venv\Scripts\activate.bat

echo [ACTION] Downgrading NumPy to 1.24.3 (compatible version)...
pip uninstall numpy -y
pip install numpy==1.24.3

echo.
echo [TEST] Checking fix...
python -c "import numpy, cv2; print(f'✓ NumPy: {numpy.__version__}, OpenCV: {cv2.__version__}')" 2>nul

if %errorlevel% equ 0 (
    echo [SUCCESS] Fixed! Now you can run tests.
) else (
    echo [ERROR] Still have issues. Try full fix script.
)

echo.
pause
