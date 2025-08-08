@echo off
echo ========================================
echo    Stop Fast ALPR Service
echo ========================================

echo 🛑 Stopping Fast ALPR Service...

REM Find and kill Python processes running fast_alpr_service.py
for /f "tokens=2" %%i in ('tasklist /fi "imagename eq python.exe" /fo csv ^| findstr fast_alpr_service') do (
    echo Found Fast ALPR process: %%i
    taskkill /pid %%i /f
)

REM Also try to kill by port
echo 🔍 Checking for processes using port 5001...
for /f "tokens=5" %%a in ('netstat -ano ^| findstr :5001') do (
    echo Killing process using port 5001: %%a
    taskkill /pid %%a /f 2>nul
)

echo ✅ Fast ALPR Service stopped
echo.
pause
