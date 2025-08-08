@echo off
REM Quick launcher for Fast ALPR Service
echo Starting Fast ALPR Service...

cd /d "%~dp0"

REM Use virtual environment if available, otherwise system Python
if exist "venv\Scripts\python.exe" (
    venv\Scripts\python.exe fast_alpr_service.py
) else (
    python fast_alpr_service.py
)

pause
