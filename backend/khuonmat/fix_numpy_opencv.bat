@echo off
REM =====================================================
REM SCRIPT SỬA LỖI NUMPY VÀ OPENCV COMPATIBILITY
REM Ngày tạo: 12/08/2025
REM Mô tả: Sửa xung đột NumPy 2.x và OpenCV
REM =====================================================

echo.
echo ============================================================
echo           SỬA LỖI NUMPY - OPENCV COMPATIBILITY
echo ============================================================
echo.

echo [VẤN ĐỀ] NumPy 2.3.2 không tương thích với OpenCV 4.8.1.78
echo [GIẢI PHÁP] Downgrade NumPy về phiên bản 1.x hoặc upgrade OpenCV
echo.

REM Di chuyển đến thư mục face_recognition_system
cd /d "%~dp0face_recognition_system"
if %errorlevel% neq 0 (
    echo [LỖI] Không thể truy cập thư mục face_recognition_system!
    pause
    exit /b 1
)

echo [BƯỚC 1] Kích hoạt virtual environment...
if not exist "venv\Scripts\activate.bat" (
    echo [LỖI] Virtual environment không tồn tại!
    pause
    exit /b 1
)

call venv\Scripts\activate.bat
echo [OK] Đã kích hoạt virtual environment.

echo.
echo [BƯỚC 2] Kiểm tra phiên bản hiện tại...
echo NumPy version:
python -c "import numpy; print(numpy.__version__)" 2>nul || echo "NumPy không import được"

echo OpenCV version:
python -c "import cv2; print(cv2.__version__)" 2>nul || echo "OpenCV không import được"

echo.
echo [BƯỚC 3] Chọn giải pháp sửa lỗi...
echo [1] Downgrade NumPy về 1.24.3 (Khuyến nghị - ổn định)
echo [2] Upgrade OpenCV về phiên bản mới nhất (có thể có lỗi khác)
echo [3] Reinstall cả NumPy và OpenCV với phiên bản tương thích
echo [0] Hủy bỏ
echo.
set /p fix_choice="Chọn giải pháp (0-3): "

if "%fix_choice%"=="0" goto :end
if "%fix_choice%"=="1" goto :downgrade_numpy
if "%fix_choice%"=="2" goto :upgrade_opencv
if "%fix_choice%"=="3" goto :reinstall_both

echo [LỖI] Lựa chọn không hợp lệ!
pause
goto :end

:downgrade_numpy
echo.
echo [THỰC HIỆN] Downgrade NumPy về phiên bản 1.24.3...
echo.
pip uninstall numpy -y
pip install numpy==1.24.3
if %errorlevel% equ 0 (
    echo [OK] Đã downgrade NumPy thành công!
) else (
    echo [LỖI] Không thể downgrade NumPy!
)
goto :test_fix

:upgrade_opencv
echo.
echo [THỰC HIỆN] Upgrade OpenCV về phiên bản mới nhất...
echo.
pip uninstall opencv-python -y
pip install opencv-python
if %errorlevel% equ 0 (
    echo [OK] Đã upgrade OpenCV thành công!
) else (
    echo [LỖI] Không thể upgrade OpenCV!
)
goto :test_fix

:reinstall_both
echo.
echo [THỰC HIỆN] Reinstall cả NumPy và OpenCV với phiên bản tương thích...
echo.
echo Gỡ cài đặt packages cũ...
pip uninstall numpy opencv-python -y

echo.
echo Cài đặt phiên bản tương thích...
pip install numpy==1.24.3
pip install opencv-python==4.8.1.78

if %errorlevel% equ 0 (
    echo [OK] Đã reinstall thành công!
) else (
    echo [LỖI] Có lỗi khi reinstall!
)
goto :test_fix

:test_fix
echo.
echo ============================================================
echo                    KIỂM TRA KẾT QUẢ
echo ============================================================
echo.

echo [TEST] Kiểm tra NumPy...
python -c "import numpy; print('✓ NumPy:', numpy.__version__)" 2>nul
if %errorlevel% equ 0 (
    echo [OK] NumPy import thành công!
) else (
    echo [LỖI] NumPy vẫn có lỗi!
)

echo.
echo [TEST] Kiểm tra OpenCV...
python -c "import cv2; print('✓ OpenCV:', cv2.__version__)" 2>nul
if %errorlevel% equ 0 (
    echo [OK] OpenCV import thành công!
) else (
    echo [LỖI] OpenCV vẫn có lỗi!
)

echo.
echo [TEST] Kiểm tra PyTorch...
python -c "import torch; print('✓ PyTorch:', torch.__version__)" 2>nul
if %errorlevel% equ 0 (
    echo [OK] PyTorch import thành công!
) else (
    echo [LỖI] PyTorch có lỗi!
)

echo.
echo [TEST] Kiểm tra face_recognition...
python -c "import face_recognition; print('✓ face_recognition: OK')" 2>nul
if %errorlevel% equ 0 (
    echo [OK] face_recognition import thành công!
) else (
    echo [CẢNH BÁO] face_recognition có lỗi (có thể do dlib)!
)

echo.
echo [TEST] Test tổng hợp...
cd Silent-Face-Anti-Spoofing
python test_setup.py
if %errorlevel% equ 0 (
    echo [THÀNH CÔNG] Tất cả packages hoạt động bình thường!
) else (
    echo [CẢNH BÁO] Vẫn có một số lỗi!
)

echo.
echo ============================================================
echo                       KẾT QUẢ
echo ============================================================
echo.
echo TRẠNG THÁI SAU KHI SỬA:
python -c "
try:
    import numpy, cv2, torch
    print('✓ All critical packages working!')
    print(f'  - NumPy: {numpy.__version__}')
    print(f'  - OpenCV: {cv2.__version__}')  
    print(f'  - PyTorch: {torch.__version__}')
except Exception as e:
    print('✗ Still have issues:', str(e))
"

echo.
echo KHUYẾN NGHỊ:
echo - Nếu vẫn có lỗi, thử restart Command Prompt
echo - Kiểm tra có processes khác đang sử dụng Python không
echo - Có thể cần reinstall toàn bộ virtual environment

:end
echo.
pause
