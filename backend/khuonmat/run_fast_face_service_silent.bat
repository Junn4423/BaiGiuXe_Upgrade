@echo off
REM =====================================================
REM Run Face Recognition Service in silent mode
REM =====================================================

REM Di chuyển vào thư mục hiện tại
cd /d "%~dp0"

REM Log file
set LOG_FILE=face_recognition_service.log

REM Ghi log khởi động
echo [%date% %time%] Starting Face Recognition Service... >> %LOG_FILE%

REM Kiểm tra virtual environment
if not exist "face_recognition_system\venv\Scripts\activate.bat" (
    echo [%date% %time%] ERROR: Virtual environment not found! >> %LOG_FILE%
    exit /b 1
)

REM Activate virtual environment và chạy service
call face_recognition_system\venv\Scripts\activate.bat

REM Kiểm tra và cài đặt packages nếu cần
python -c "import fastapi; import uvicorn; import face_recognition" 2>NUL
if %ERRORLEVEL% NEQ 0 (
    echo [%date% %time%] Installing required packages... >> %LOG_FILE%
    if exist "requirements_face_service.txt" (
        pip install -r requirements_face_service.txt >> %LOG_FILE% 2>&1
    ) else (
        pip install fastapi uvicorn[standard] python-multipart face-recognition opencv-python sqlalchemy >> %LOG_FILE% 2>&1
    )
)

REM Chạy service và ghi log
echo [%date% %time%] Service started on http://127.0.0.1:5055 >> %LOG_FILE%
python fast_face_service.py --host 127.0.0.1 --port 5055 >> %LOG_FILE% 2>&1

REM Ghi log khi service dừng
echo [%date% %time%] Service stopped. >> %LOG_FILE%
