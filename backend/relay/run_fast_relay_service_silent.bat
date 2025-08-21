@echo off
REM Silent start for Fast Relay Service (no console window)

REM Change to relay directory
cd /d "%~dp0"

REM Check if venv exists, if not create it
if not exist "venv" (
    python -m venv venv >nul 2>&1
)

REM Activate virtual environment and start service silently
call venv\Scripts\activate.bat
pip install -r requirements_relay_service.txt >nul 2>&1

REM Start the relay service in background
start /B python fast_relay_service.py >fast_relay_service.log 2>&1
