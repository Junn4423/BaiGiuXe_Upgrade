@echo off
echo ================================================
echo   PYTHON ENVIRONMENT SETUP FOR ELECTRON BUILD
echo ================================================

REM Check if Python is installed
python --version >nul 2>&1
if %ERRORLEVEL% neq 0 (
    echo ❌ Python not found in PATH
    echo.
    echo Please install Python from: https://www.python.org/downloads/
    echo Make sure to check "Add Python to PATH" during installation
    echo.
    pause
    exit /b 1
)

echo ✅ Python found
python --version

echo.
echo Setting up Python build tools...

REM Install required build tools
python -m pip install --upgrade pip
python -m pip install setuptools wheel

REM Check if we can build native modules
echo.
echo Testing Python build environment...
python -c "import setuptools; print('Setuptools available')"
if %ERRORLEVEL% neq 0 (
    echo ⚠️ Setuptools not available, but continuing...
)

echo.
echo ✅ Python environment setup complete
echo.
echo Note: If you encounter native module build errors during npm install,
echo you may need to install Microsoft Visual C++ Build Tools.
echo.
pause
