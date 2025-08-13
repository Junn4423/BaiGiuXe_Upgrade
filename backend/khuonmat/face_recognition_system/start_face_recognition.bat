@echo off
REM =====================================================
REM SCRIPT KHỞI ĐỘNG FACE RECOGNITION SYSTEM
REM Ngày tạo: 12/08/2025
REM Mô tả: Kích hoạt venv và chạy Flask app
REM =====================================================

echo.
echo ============================================================
echo              FACE RECOGNITION SYSTEM STARTUP
echo ============================================================
echo.

REM Di chuyển đến thư mục face_recognition_system
cd /d "%~dp0"
echo [INFO] Thư mục hiện tại: %cd%

echo.
echo [BƯỚC 1] Kiểm tra virtual environment...
if not exist "venv\Scripts\activate.bat" (
    echo [LỖI] Virtual environment không tồn tại!
    echo.
    echo HƯỚNG DẪN KHẮC PHỤC:
    echo 1. Chạy setup_face_recognition.bat để cài đặt môi trường
    echo 2. Hoặc tạo virtual environment: python -m venv venv
    echo 3. Sau đó cài đặt dependencies: pip install -r requirements.txt
    echo.
    pause
    exit /b 1
)
echo [OK] Virtual environment đã sẵn sàng.

echo.
echo [BƯỚC 2] Kích hoạt virtual environment...
call venv\Scripts\activate.bat
echo [OK] Đã kích hoạt virtual environment.

echo.
echo [BƯỚC 3] Kiểm tra Python packages...
python -c "import flask; print('Flask:', flask.__version__)" 2>nul
if %errorlevel% neq 0 (
    echo [LỖI] Flask chưa được cài đặt!
    echo Đang cài đặt Flask...
    pip install flask==2.3.3
)

python -c "import cv2; print('OpenCV:', cv2.__version__)" 2>nul
if %errorlevel% neq 0 (
    echo [LỖI] OpenCV chưa được cài đặt!
    echo Đang cài đặt OpenCV...
    pip install opencv-python==4.8.1.78
)

python -c "import face_recognition; print('face_recognition: OK')" 2>nul
if %errorlevel% neq 0 (
    echo [CẢNH BÁO] face_recognition chưa được cài đặt!
    echo Một số tính năng có thể không hoạt động.
)

echo [OK] Packages kiểm tra hoàn tất.

echo.
echo [BƯỚC 4] Kiểm tra cấu hình...
if exist "config.py" (
    echo [OK] File config.py tồn tại.
) else (
    echo [CẢNH BÁO] File config.py không tồn tại!
    echo Tạo file config mẫu...
    echo # Face Recognition System Configuration > config.py
    echo SQLALCHEMY_DATABASE_URI = 'mysql+mysqlconnector://root:@localhost/face_recognition' >> config.py
    echo SECRET_KEY = 'your-secret-key-here' >> config.py
    echo UPLOAD_FOLDER = 'static/uploads' >> config.py
    echo MAX_CONTENT_LENGTH = 16 * 1024 * 1024  # 16MB max file upload >> config.py
    echo [OK] Đã tạo config.py mẫu.
)

echo.
echo [BƯỚC 5] Tạo thư mục cần thiết...
if not exist "static\uploads" mkdir static\uploads
if not exist "instance" mkdir instance
if not exist "models" mkdir models
echo [OK] Đã tạo các thư mục cần thiết.

echo.
echo [BƯỚC 6] Kiểm tra kết nối database...
echo [THÔNG BÁO] Kiểm tra MySQL connection...
python -c "try: import mysql.connector; print('MySQL connector available'); except ImportError: print('Warning: MySQL connector not installed')" 2>nul

echo.
echo [BƯỚC 7] Kiểm tra camera...
echo [THÔNG BÁO] Kiểm tra camera...
python -c "import cv2; cap = cv2.VideoCapture(0); print('Camera: Available' if cap.isOpened() else 'Camera: Not available or in use'); cap.release() if cap.isOpened() else None" 2>nul

echo.
echo ============================================================
echo                    KHỞI ĐỘNG ỨNG DỤNG
echo ============================================================
echo.

echo [THÔNG BÁO] Chuẩn bị khởi động Face Recognition System...
echo.
echo URL ứng dụng sẽ là: http://localhost:5000
echo Để dừng ứng dụng: Ctrl+C
echo.
echo Đang khởi động...
echo.

REM Khởi động Flask app
python app.py

echo.
echo ============================================================
echo               ỨNG DỤNG ĐÃ DỪNG
echo ============================================================
echo.
pause
