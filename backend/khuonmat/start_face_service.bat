@echo off
REM =====================================================
REM Start Face Recognition Service
REM Tương tự bienso service
REM =====================================================

echo Starting Face Recognition Service...

REM Kiểm tra nếu service đang chạy
tasklist /FI "WINDOWTITLE eq Face Recognition Service" 2>NUL | find /I /N "python.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo Face Recognition Service is already running!
    pause
    exit /b
)

REM Chạy service ở chế độ ẩn
echo Launching Face Recognition Service in background...
start "Face Recognition Service" /B /MIN cmd /c run_fast_face_service_silent.bat

echo.
echo Face Recognition Service started successfully!
echo Service is running on http://127.0.0.1:5055
echo.
echo To stop the service, run stop_face_service.bat
echo.

timeout /t 3 >nul
exit /b
