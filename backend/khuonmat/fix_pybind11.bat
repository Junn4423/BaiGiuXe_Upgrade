@echo off
cd /d "%~dp0face_recognition_system"

echo ================================================================
echo                  PYBIND11 QUICK FIX
echo ================================================================
echo.
echo This will upgrade pybind11 and rebuild affected packages.
echo.

if not exist "venv" (
    echo [ERROR] Virtual environment not found!
    pause
    exit /b 1
)

call venv\Scripts\activate.bat

echo [1] Upgrading pybind11...
pip install --upgrade "pybind11>=2.12"

echo.
echo [2] Rebuilding dlib...
pip uninstall -y dlib
pip install dlib --no-cache-dir

echo.
echo [3] Rebuilding face_recognition...
pip uninstall -y face_recognition  
pip install face_recognition --no-cache-dir

echo.
echo [4] Testing...
python -c "import dlib, face_recognition; print('Rebuild successful!')"

echo.
echo ================================================================
echo                     PYBIND11 FIX DONE
echo ================================================================
pause
