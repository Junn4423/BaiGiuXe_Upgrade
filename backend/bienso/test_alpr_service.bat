@echo off
echo ========================================
echo    Fast ALPR Service Tester
echo ========================================

REM Test if the service is running
echo 🧪 Testing Fast ALPR Service...
echo.

REM Test health endpoint
echo 📡 Testing health endpoint...
curl -s http://127.0.0.1:5001/healthz
if %ERRORLEVEL% equ 0 (
    echo.
    echo ✅ Health check passed!
) else (
    echo.
    echo ❌ Health check failed - service may not be running
    echo 💡 Make sure to run 'run_fast_alpr_service.bat' first
    goto :end
)

echo.
echo 📋 Service Information:
echo   URL: http://127.0.0.1:5001
echo   Health: http://127.0.0.1:5001/healthz
echo   Detect: http://127.0.0.1:5001/detect (POST)
echo.

REM Check if we have a test image
if exist "test_image.jpg" (
    echo 🖼️  Testing detection with test_image.jpg...
    curl -X POST -F "file=@test_image.jpg" http://127.0.0.1:5001/detect
    echo.
) else (
    echo 💡 To test detection, place a test image named 'test_image.jpg' in this folder
    echo    and run this script again.
)

:end
echo.
echo ========================================
echo    Test Complete
echo ========================================
pause
