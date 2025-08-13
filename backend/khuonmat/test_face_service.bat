@echo off
REM =====================================================
REM Test Face Recognition Service
REM =====================================================

echo ================================================================
echo           TESTING FACE RECOGNITION SERVICE
echo ================================================================
echo.

REM Kiểm tra service có đang chạy không
echo [1] Checking if service is running...
curl -s -o nul -w "Status: %%{http_code}" http://127.0.0.1:5055/healthz
echo.
echo.

REM Nếu service chạy, thực hiện test
curl -s http://127.0.0.1:5055/healthz >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo [2] Service is running! Testing health endpoint...
    curl -X GET http://127.0.0.1:5055/healthz
    echo.
    echo.
    
    echo [3] Testing face recognition with sample image...
    echo Note: You need to send an actual image file or base64 to test recognition.
    echo.
    
    echo [4] API Endpoints available:
    echo    - GET  /healthz          : Health check
    echo    - POST /recognize        : Recognize faces (multipart/form-data or base64)
    echo    - POST /register         : Register new face
    echo.
    
    echo [5] Interactive test page:
    echo    Open test_face_service.html in your browser for interactive testing
    echo    Or visit: file:///%cd%/test_face_service.html
    echo.
) else (
    echo [ERROR] Service is not running!
    echo Please run start_face_service.bat first.
)

echo.
pause
