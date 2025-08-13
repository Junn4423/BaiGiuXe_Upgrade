@echo off
REM =====================================================
REM SCRIPT SETUP FACE RECOGNITION SYSTEM
REM Ngày tạo: 12/08/2025
REM Mô tả: Thiết lập môi trường và dependencies cho hệ thống nhận diện khuôn mặt
REM =====================================================

echo.
echo ============================================================
echo           SETUP FACE RECOGNITION SYSTEM
echo ============================================================
echo.

REM Kiểm tra Python đã cài đặt chưa
echo [BƯỚC 1] Kiểm tra Python...
python --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [LỖI] Python chưa được cài đặt hoặc không có trong PATH!
    echo Vui lòng cài đặt Python 3.8+ trước khi tiếp tục.
    pause
    exit /b 1
)
echo [OK] Python đã sẵn sàng.

REM Kiểm tra pip
echo.
echo [BƯỚC 2] Kiểm tra pip...
pip --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [LỖI] pip không khả dụng!
    echo Đang cài đặt pip...
    python -m ensurepip --upgrade
)
echo [OK] pip đã sẵn sàng.

REM Di chuyển đến thư mục face_recognition_system
echo.
echo [BƯỚC 3] Di chuyển đến thư mục face_recognition_system...
cd /d "%~dp0face_recognition_system"
if %errorlevel% neq 0 (
    echo [LỖI] Không thể truy cập thư mục face_recognition_system!
    pause
    exit /b 1
)
echo [OK] Đã vào thư mục: %cd%

REM Tạo virtual environment
echo.
echo [BƯỚC 4] Tạo Python virtual environment...
if exist "venv" (
    echo [THÔNG BÁO] Virtual environment đã tồn tại, đang xóa để tạo mới...
    rmdir /s /q venv
)
python -m venv venv
if %errorlevel% neq 0 (
    echo [LỖI] Không thể tạo virtual environment!
    pause
    exit /b 1
)
echo [OK] Đã tạo virtual environment.

REM Kích hoạt virtual environment
echo.
echo [BƯỚC 5] Kích hoạt virtual environment...
call venv\Scripts\activate.bat
if %errorlevel% neq 0 (
    echo [LỖI] Không thể kích hoạt virtual environment!
    pause
    exit /b 1
)
echo [OK] Đã kích hoạt virtual environment.

REM Cập nhật pip trong venv
echo.
echo [BƯỚC 6] Cập nhật pip trong virtual environment...
python -m pip install --upgrade pip
echo [OK] Đã cập nhật pip.

REM Cài đặt Visual C++ build tools dependencies (cho dlib)
echo.
echo [BƯỚC 7] Cài đặt dependencies cơ bản...
pip install wheel setuptools
echo [OK] Đã cài đặt wheel và setuptools.

REM Cài đặt các packages theo thứ tự ưu tiên
echo.
echo [BƯỚC 8] Cài đặt numpy (phiên bản tương thích với OpenCV)...
pip install numpy==1.24.3
if %errorlevel% neq 0 (
    echo [CẢNH BÁO] Lỗi khi cài numpy 1.24.3, thử phiên bản 1.26.4...
    pip install numpy==1.26.4
    if %errorlevel% neq 0 (
        echo [CẢNH BÁO] Lỗi khi cài numpy, thử phiên bản mới nhất...
        pip install numpy
    )
)

echo.
echo [BƯỚC 9] Cài đặt OpenCV...
pip install opencv-python==4.8.1.78
if %errorlevel% neq 0 (
    echo [CẢNH BÁO] Lỗi khi cài OpenCV phiên bản cụ thể, thử phiên bản mới nhất...
    pip install opencv-python
)

echo.
echo [BƯỚC 10] Cài đặt Pillow...
pip install Pillow==10.0.0
if %errorlevel% neq 0 (
    echo [CẢNH BÁO] Lỗi khi cài Pillow phiên bản cụ thể, thử phiên bản mới nhất...
    pip install Pillow
)

echo.
echo [BƯỚC 11] Cài đặt dlib (có thể mất nhiều thời gian)...
echo [THÔNG BÁO] Đang tải và cài đặt dlib... Quá trình này có thể mất 5-10 phút.
pip install dlib
if %errorlevel% neq 0 (
    echo [CẢNH BÁO] Lỗi khi cài dlib từ pip, thử cài pre-compiled wheel...
    pip install https://github.com/z-mahmud22/Dlib_Windows_Python3.x/raw/main/dlib-19.22.99-cp39-cp39-win_amd64.whl
    if %errorlevel% neq 0 (
        echo [LỖI] Không thể cài dlib! Vui lòng cài Visual Studio Build Tools.
        echo Tải tại: https://visualstudio.microsoft.com/visual-cpp-build-tools/
        pause
    )
)

echo.
echo [BƯỚC 12] Cài đặt face_recognition...
pip install face-recognition==1.3.0
if %errorlevel% neq 0 (
    echo [CẢNH BÁO] Lỗi khi cài face-recognition phiên bản cụ thể...
    pip install face-recognition
)

echo.
echo [BƯỚC 13] Cài đặt các dependencies còn lại...
pip install flask==2.3.3
pip install flask-sqlalchemy==3.0.5
pip install python-dateutil==2.8.2
pip install mysql-connector-python==8.2.0

REM Cài đặt PyTorch (CPU version cho Windows)
echo.
echo [BƯỚC 14] Cài đặt PyTorch...
pip install torch==1.2.0 torchvision==0.4.0 -f https://download.pytorch.org/whl/torch_stable.html
if %errorlevel% neq 0 (
    echo [CẢNH BÁO] Lỗi khi cài PyTorch phiên bản cụ thể, cài phiên bản mới nhất...
    pip install torch torchvision
)

echo.
echo [BƯỚC 15] Cài đặt các packages khác...
pip install easydict==1.9
pip install tqdm==4.31.1
pip install tensorboardX==2.0

REM Kiểm tra cài đặt
echo.
echo [BƯỚC 16] Kiểm tra cài đặt...
echo Kiểm tra các packages chính:
python -c "import cv2; print('OpenCV:', cv2.__version__)" 2>nul
python -c "import face_recognition; print('face_recognition: OK')" 2>nul
python -c "import flask; print('Flask:', flask.__version__)" 2>nul
python -c "import torch; print('PyTorch:', torch.__version__)" 2>nul
python -c "import numpy; print('NumPy:', numpy.__version__)" 2>nul

REM Tạo thư mục cần thiết
echo.
echo [BƯỚC 17] Tạo các thư mục cần thiết...
if not exist "instance" mkdir instance
if not exist "static\uploads" mkdir static\uploads
if not exist "models" mkdir models
echo [OK] Đã tạo các thư mục cần thiết.

REM Sao chép file config mẫu
echo.
echo [BƯỚC 18] Tạo file config mẫu...
if not exist "config.py" (
    echo # Face Recognition System Configuration > config.py
    echo SQLALCHEMY_DATABASE_URI = 'mysql+mysqlconnector://root:@localhost/face_recognition' >> config.py
    echo SECRET_KEY = 'your-secret-key-here' >> config.py
    echo UPLOAD_FOLDER = 'static/uploads' >> config.py
    echo MAX_CONTENT_LENGTH = 16 * 1024 * 1024  # 16MB max file upload >> config.py
    echo [OK] Đã tạo file config.py mẫu.
) else (
    echo [THÔNG BÁO] File config.py đã tồn tại.
)

echo.
echo ============================================================
echo           SETUP FACE RECOGNITION SYSTEM HOÀN THÀNH!
echo ============================================================
echo.
echo [THÀNH CÔNG] Môi trường face recognition đã được thiết lập!
echo.
echo HƯỚNG DẪN SỬ DỤNG:
echo 1. Để kích hoạt virtual environment: venv\Scripts\activate
echo 2. Để chạy ứng dụng: python app.py
echo 3. File config: config.py (cần chỉnh sửa database connection)
echo 4. Thư mục upload: static\uploads
echo.
echo LƯU Ý:
echo - Đảm bảo MySQL đang chạy trước khi start ứng dụng
echo - Cập nhật thông tin database trong config.py
echo - Camera/webcam cần được kết nối để sử dụng tính năng nhận diện
echo.
pause
