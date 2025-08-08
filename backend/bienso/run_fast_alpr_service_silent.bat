@echo off
REM Fast ALPR Service Launcher for Production

REM Set working directory to the script location
cd /d "%~dp0"

REM Check if virtual environment exists
if exist "venv\Scripts\python.exe" (
    set PYTHON_EXE=venv\Scripts\python.exe
) else (
    set PYTHON_EXE=python
)

REM Check if fast_alpr_service.py exists
if not exist "fast_alpr_service.py" (
    echo fast_alpr_service.py not found
    exit /b 1
)

REM Activate virtual environment if it exists
if exist "venv\Scripts\activate.bat" (
    call venv\Scripts\activate.bat
)

REM Start the service silently
"%PYTHON_EXE%" fast_alpr_service.py --host 127.0.0.1 --port 5001
