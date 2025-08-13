@echo off
REM =====================================================
REM Run Face Recognition Service với Virtual Environment
REM =====================================================

echo ================================================================
echo           FACE RECOGNITION SERVICE
echo ================================================================
echo.

REM Di chuyển vào thư mục hiện tại
cd /d "%~dp0"

REM Kiểm tra virtual environment
if not exist "face_recognition_system\venv\Scripts\activate.bat" (
    echo [ERROR] Virtual environment not found!
    echo Please run setup_face_recognition.bat first to create venv.
    pause
    exit /b 1
)

REM Activate virtual environment
echo Activating virtual environment...
call face_recognition_system\venv\Scripts\activate.bat

REM Kiểm tra FastAPI và uvicorn
python -c "import fastapi; import uvicorn; import face_recognition" 2>NUL
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Required packages not installed!
    echo Installing from requirements file...
    if exist "requirements_face_service.txt" (
        pip install -r requirements_face_service.txt
    ) else (
        echo Installing basic packages...
        pip install fastapi uvicorn[standard] python-multipart face-recognition opencv-python sqlalchemy
    )
)

REM Chạy service với log chi tiết
echo.
echo Starting Face Recognition Service on port 5055...
echo ================================================================
echo Service will display live logs. Press Ctrl+C to stop.
echo ================================================================
echo.

python fast_face_service.py --host 127.0.0.1 --port 5055

echo.
echo ================================================================
echo Face Recognition Service stopped.
echo ================================================================
pause
