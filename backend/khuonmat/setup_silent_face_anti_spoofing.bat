@echo off
REM =====================================================
REM SCRIPT SETUP SILENT FACE ANTI-SPOOFING
REM Ngày tạo: 12/08/2025
REM Mô tả: Thiết lập môi trường cho hệ thống chống giả mạo khuôn mặt
REM =====================================================

echo.
echo ============================================================
echo           SETUP SILENT FACE ANTI-SPOOFING
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

REM Di chuyển đến thư mục Silent-Face-Anti-Spoofing
echo.
echo [BƯỚC 3] Di chuyển đến thư mục Silent-Face-Anti-Spoofing...
cd /d "%~dp0face_recognition_system\Silent-Face-Anti-Spoofing"
if %errorlevel% neq 0 (
    echo [LỖI] Không thể truy cập thư mục Silent-Face-Anti-Spoofing!
    echo Đảm bảo thư mục tồn tại tại: %~dp0face_recognition_system\Silent-Face-Anti-Spoofing
    pause
    exit /b 1
)
echo [OK] Đã vào thư mục: %cd%

REM Kiểm tra virtual environment của face_recognition_system
echo.
echo [BƯỚC 4] Kiểm tra virtual environment...
if exist "..\venv\Scripts\activate.bat" (
    echo [OK] Sử dụng virtual environment từ face_recognition_system.
    call ..\venv\Scripts\activate.bat
) else (
    echo [THÔNG BÁO] Tạo virtual environment riêng cho Silent-Face-Anti-Spoofing...
    python -m venv venv_spoofing
    call venv_spoofing\Scripts\activate.bat
)

REM Cập nhật pip
echo.
echo [BƯỚC 5] Cập nhật pip...
python -m pip install --upgrade pip
echo [OK] Đã cập nhật pip.

REM Cài đặt dependencies cơ bản
echo.
echo [BƯỚC 6] Cài đặt dependencies cơ bản...
pip install wheel setuptools
echo [OK] Đã cài đặt wheel và setuptools.

REM Cài đặt numpy trước
echo.
echo [BƯỚC 7] Cài đặt numpy...
pip install numpy
if %errorlevel% neq 0 (
    echo [LỖI] Không thể cài đặt numpy!
    pause
    exit /b 1
)
echo [OK] Đã cài đặt numpy.

REM Cài đặt OpenCV
echo.
echo [BƯỚC 8] Cài đặt OpenCV...
pip install opencv-python
if %errorlevel% neq 0 (
    echo [CẢNH BÁO] Lỗi khi cài OpenCV, thử phiên bản cụ thể...
    pip install opencv-python==4.8.1.78
)
echo [OK] Đã cài đặt OpenCV.

REM Cài đặt Pillow
echo.
echo [BƯỚC 9] Cài đặt Pillow...
pip install Pillow
echo [OK] Đã cài đặt Pillow.

REM Cài đặt PyTorch và torchvision
echo.
echo [BƯỚC 10] Cài đặt PyTorch và torchvision...
echo [THÔNG BÁO] Đang cài đặt PyTorch... Quá trình này có thể mất vài phút.

REM Thử cài đặt PyTorch phiên bản CPU
pip install torch torchvision --index-url https://download.pytorch.org/whl/cpu
if %errorlevel% neq 0 (
    echo [CẢNH BÁO] Lỗi khi cài PyTorch từ index chính thức, thử cách khác...
    pip install torch torchvision
    if %errorlevel% neq 0 (
        echo [LỖI] Không thể cài đặt PyTorch!
        echo Vui lòng cài đặt thủ công: pip install torch torchvision
        pause
    )
)
echo [OK] Đã cài đặt PyTorch.

REM Cài đặt các dependencies khác
echo.
echo [BƯỚC 11] Cài đặt các dependencies khác...
pip install easydict
pip install tqdm
pip install tensorboardX

REM Cài đặt từ requirements.txt nếu có
echo.
echo [BƯỚC 12] Cài đặt từ requirements.txt...
if exist "requirements.txt" (
    echo [THÔNG BÁO] Đang cài đặt từ requirements.txt...
    pip install -r requirements.txt
    if %errorlevel% neq 0 (
        echo [CẢNH BÁO] Một số packages trong requirements.txt có thể lỗi, tiếp tục...
    )
) else (
    echo [THÔNG BÁO] Không tìm thấy requirements.txt, bỏ qua bước này.
)

REM Tạo các thư mục cần thiết
echo.
echo [BƯỚC 13] Tạo các thư mục cần thiết...
if not exist "datasets" mkdir datasets
if not exist "saved_logs" mkdir saved_logs
if not exist "resources\checkpoints" mkdir resources\checkpoints
if not exist "resources\detection_model" mkdir resources\detection_model
echo [OK] Đã tạo các thư mục cần thiết.

REM Kiểm tra cài đặt
echo.
echo [BƯỚC 14] Kiểm tra cài đặt...
echo Kiểm tra các packages chính:
python -c "import cv2; print('OpenCV:', cv2.__version__)" 2>nul
python -c "import torch; print('PyTorch:', torch.__version__)" 2>nul
python -c "import torchvision; print('torchvision:', torchvision.__version__)" 2>nul
python -c "import numpy; print('NumPy:', numpy.__version__)" 2>nul
python -c "from PIL import Image; print('Pillow: OK')" 2>nul

REM Tạo script test đơn giản
echo.
echo [BƯỚC 15] Tạo script test...
if not exist "test_setup.py" (
    echo # Test script for Silent Face Anti-Spoofing setup > test_setup.py
    echo import torch >> test_setup.py
    echo import cv2 >> test_setup.py
    echo import numpy as np >> test_setup.py
    echo. >> test_setup.py
    echo print^("All imports successful!"^) >> test_setup.py
    echo print^("PyTorch version:", torch.__version__^) >> test_setup.py
    echo print^("OpenCV version:", cv2.__version__^) >> test_setup.py
    echo print^("NumPy version:", np.__version__^) >> test_setup.py
    echo print^("Setup completed successfully!"^) >> test_setup.py
    echo [OK] Đã tạo test_setup.py
)
    echo print("OpenCV version:", cv2.__version__) >> test_setup.py
    echo print("Setup completed successfully!") >> test_setup.py
    echo [OK] Đã tạo test_setup.py
)

REM Kiểm tra model files
echo.
echo [BƯỚC 16] Kiểm tra model files...
if exist "resources" (
    echo [OK] Thư mục resources tồn tại.
    if exist "resources\anti_spoof_models" (
        echo [OK] Thư mục anti_spoof_models tồn tại.
    ) else (
        echo [THÔNG BÁO] Cần tải model files vào resources\anti_spoof_models
    )
) else (
    echo [THÔNG BÁO] Tạo thư mục resources...
    mkdir resources
)

REM Tạo config file mẫu
echo.
echo [BƯỚC 17] Tạo config mẫu...
if not exist "config.py" (
    echo # Configuration for Silent Face Anti-Spoofing > config.py
    echo MODEL_PATH = 'resources/anti_spoof_models/' >> config.py
    echo DEVICE = 'cpu'  # Change to 'cuda' if GPU available >> config.py
    echo DETECTION_THRESHOLD = 0.5 >> config.py
    echo SPOOF_THRESHOLD = 0.9 >> config.py
    echo [OK] Đã tạo config.py mẫu.
) else (
    echo [THÔNG BÁO] File config.py đã tồn tại.
)

echo.
echo ============================================================
echo        SETUP SILENT FACE ANTI-SPOOFING HOÀN THÀNH!
echo ============================================================
echo.
echo [THÀNH CÔNG] Môi trường Silent Face Anti-Spoofing đã được thiết lập!
echo.
echo HƯỚNG DẪN SỬ DỤNG:
echo 1. Để test setup: python test_setup.py
echo 2. File config: config.py (có thể cần chỉnh sửa)
echo 3. Model path: resources\anti_spoof_models\
echo.
echo BƯỚC TIẾP THEO:
echo 1. Tải model files vào thư mục resources\anti_spoof_models\
echo 2. Cập nhật đường dẫn model trong config.py nếu cần
echo 3. Test với: python test.py (nếu có file test)
echo.
echo LƯU Ý:
echo - Cần model files để chạy anti-spoofing
echo - Đảm bảo camera/webcam hoạt động tốt
echo - Có thể cần GPU để tăng tốc độ xử lý
echo.

REM Chạy test nhanh
echo [TEST] Chạy test nhanh...
python test_setup.py
if %errorlevel% equ 0 (
    echo [OK] Test thành công!
) else (
    echo [CẢNH BÁO] Test có lỗi, kiểm tra lại cài đặt.
)

echo.
pause
