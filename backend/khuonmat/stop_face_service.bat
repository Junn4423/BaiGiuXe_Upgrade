@echo off
REM =====================================================
REM Stop Face Recognition Service
REM =====================================================

echo Stopping Face Recognition Service...

REM Tìm và đóng process Python chạy fast_face_service.py
for /f "tokens=2" %%i in ('wmic process where "commandline like '%%fast_face_service.py%%' and name='python.exe'" get processid /value 2^>nul ^| find "="') do (
    set PID=%%i
)

if defined PID (
    echo Found Face Recognition Service with PID: %PID%
    taskkill /PID %PID% /F >nul 2>&1
    echo Face Recognition Service stopped successfully.
) else (
    echo Face Recognition Service is not running.
)

REM Đóng cửa sổ "Face Recognition Service" nếu có
taskkill /FI "WINDOWTITLE eq Face Recognition Service" /F >nul 2>&1

echo.
pause
