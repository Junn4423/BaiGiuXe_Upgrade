@echo off
echo ================================================
echo   PYTHON ENVIRONMENT SETUP FOR ELECTRON BUILD
echo ================================================

REM Check if Python is installed
python --version >nul 2>&1
if %ERRORLEVEL% neq 0 (
    echo Python not found in PATH
    echo.
    echo Please install Python from: https://www.python.org/downloads/
    echo Make sure to check "Add Python to PATH" during installation
    echo.
    pause
    exit /b 1
)

echo Python found
python --version

echo.
echo Setting up Python build tools...

REM Install required build tools
python -m pip install --upgrade pip
python -m pip install setuptools wheel

REM Install Microsoft Visual C++ Build Tools if needed
echo.
echo Note: If you encounter build errors, you may need to install:
echo Microsoft Visual C++ Build Tools 2019 or newer
echo Download from: https://visualstudio.microsoft.com/visual-cpp-build-tools/

echo.
echo Setting npm configuration for Python...
call npm config set python python
call npm config set msvs_version 2019

echo.
echo Python environment setup complete
echo.
pause
