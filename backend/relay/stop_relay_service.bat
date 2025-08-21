@echo off
echo Stopping Fast Relay Service...

REM Kill all Python processes running fast_relay_service.py
for /f "tokens=2" %%i in ('tasklist /fi "imagename eq python.exe" ^| findstr python.exe') do (
    wmic process where "processid=%%i and commandline like '%%fast_relay_service.py%%'" delete >nul 2>&1
)

REM Also try to kill uvicorn processes
taskkill /f /im uvicorn.exe >nul 2>&1

echo Fast Relay Service stopped.
pause
