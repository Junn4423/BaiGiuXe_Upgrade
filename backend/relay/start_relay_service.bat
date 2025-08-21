@echo off
echo Starting Fast Relay Service...
echo ================================

REM Change to relay directory
cd /d "%~dp0"

REM Check if venv exists, if not create it
if not exist "venv" (
    echo Creating Python virtual environment...
    python -m venv venv
    if errorlevel 1 (
        echo ERROR: Failed to create virtual environment
        echo Please ensure Python 3.8+ is installed and in PATH
        pause
        exit /b 1
    )
)

REM Activate virtual environment
echo Activating virtual environment...
call venv\Scripts\activate.bat

REM Install/upgrade dependencies
echo Installing dependencies...
pip install -r requirements_relay_service.txt

REM Check if USB relay device is connected
echo Checking USB relay device...
python -c "import hid; device = hid.device(); device.open(0x16C0, 0x05DF); print('USB Relay device found!'); device.close()" 2>nul
if errorlevel 1 (
    echo WARNING: USB Relay device not detected
    echo Please make sure the device is connected
    echo Service will run in mock mode
)

REM Start the relay service
echo Starting Fast Relay Service on http://127.0.0.1:5003
echo API docs available at: http://127.0.0.1:5003/docs
echo Press Ctrl+C to stop the service
echo ================================
python fast_relay_service.py

pause
