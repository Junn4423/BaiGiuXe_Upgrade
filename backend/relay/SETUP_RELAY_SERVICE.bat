@echo off
echo Setting up Fast Relay Service...
echo ================================

REM Change to relay directory
cd /d "%~dp0"

echo Current directory: %CD%

REM Check if venv exists and if it's corrupted, recreate it
if exist "venv" (
    echo Checking existing virtual environment...
    call venv\Scripts\activate.bat 2>nul
    if errorlevel 1 (
        echo Virtual environment appears corrupted, recreating...
        rmdir /s /q venv 2>nul
        goto create_venv
    ) else (
        echo Virtual environment already exists and working
        goto install_deps
    )
) else (
    goto create_venv
)

:create_venv
echo Creating Python virtual environment for relay service...
python -m venv venv
if errorlevel 1 (
    echo ERROR: Failed to create virtual environment
    echo Please ensure Python 3.8+ is installed and in PATH
    pause
    exit /b 1
)
echo Virtual environment created successfully

:install_deps
REM Activate virtual environment
echo Activating virtual environment...
call venv\Scripts\activate.bat

REM Install dependencies without upgrading pip (to avoid permission issues)
echo Installing relay service dependencies...
python -m pip install -r requirements_relay_service.txt --no-warn-script-location

if errorlevel 1 (
    echo ERROR: Failed to install dependencies
    pause
    exit /b 1
)

echo Dependencies installed successfully

REM Test USB relay device connection
echo Testing USB relay device connection...
python -c "import hid; device = hid.device(); device.open(0x16C0, 0x05DF); print('USB Relay device found and working!'); device.close()" 2>nul

if errorlevel 1 (
    echo WARNING: USB Relay device not detected
    echo Please ensure the USB relay device is connected
    echo The service will still work in mock mode
) else (
    echo USB Relay device detected successfully
)

echo.
echo ================================
echo Setup completed successfully!
echo ================================
echo You can now:
echo 1. Start the service: start_relay_service.bat
echo 2. Test the service: test_relay_service.bat
echo 3. View API docs: http://127.0.0.1:5003/docs
echo ================================

pause
