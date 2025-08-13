@echo off
REM =====================================================
REM SCRIPT QUẢN LÝ FACE RECOGNITION SYSTEM
REM Ngày tạo: 12/08/2025
REM Mô tả: Menu chính để quản lý các thành phần
REM =====================================================

:main_menu
cls
echo.
echo ================================================================
echo            FACE RECOGNITION SYSTEM MANAGER
echo ================================================================
echo.
echo Current Directory: %cd%
echo.
echo [1] Start Face Recognition System (Flask App)
echo [2] Test Silent Face Anti-Spoofing
echo [3] Setup/Install Dependencies
echo [4] Check System Status
echo [5] Configuration Menu
echo [6] Troubleshooting
echo [0] Exit
echo.
echo ================================================================
set /p choice="Choose an option (0-6): "

if "%choice%"=="0" goto :exit
if "%choice%"=="1" goto :start_face_recognition
if "%choice%"=="2" goto :test_anti_spoofing
if "%choice%"=="3" goto :setup_menu
if "%choice%"=="4" goto :check_status
if "%choice%"=="5" goto :config_menu
if "%choice%"=="6" goto :troubleshooting

echo [ERROR] Invalid choice! Please try again.
pause
goto :main_menu

:start_face_recognition
echo.
echo ================================================================
echo              STARTING FACE RECOGNITION SYSTEM
echo ================================================================
echo.
cd /d "%~dp0face_recognition_system"
if exist "start_face_recognition.bat" (
    call start_face_recognition.bat
) else (
    echo [ERROR] start_face_recognition.bat not found!
    echo Running app.py directly...
    if exist "venv\Scripts\activate.bat" (
        call venv\Scripts\activate.bat
        python app.py
    ) else (
        echo [ERROR] Virtual environment not found!
        echo Please run setup first.
    )
)
echo.
pause
goto :main_menu

:test_anti_spoofing
echo.
echo ================================================================
echo              TESTING SILENT FACE ANTI-SPOOFING
echo ================================================================
echo.
cd /d "%~dp0face_recognition_system\Silent-Face-Anti-Spoofing"
if exist "run_test.bat" (
    call run_test.bat
) else (
    echo [INFO] run_test.bat not found, running test directly...
    cd ..
    if exist "venv\Scripts\activate.bat" (
        call venv\Scripts\activate.bat
        cd Silent-Face-Anti-Spoofing
        python test_setup.py
    ) else (
        echo [ERROR] Virtual environment not found!
    )
)
echo.
pause
goto :main_menu

:setup_menu
echo.
echo ================================================================
echo                     SETUP MENU
echo ================================================================
echo.
echo [1] Full Setup (Face Recognition + Anti-Spoofing)
echo [2] Setup Face Recognition Only
echo [3] Setup Anti-Spoofing Only
echo [4] Create Virtual Environment Only
echo [5] Install Missing Dependencies
echo [0] Back to Main Menu
echo.
set /p setup_choice="Choose setup option (0-5): "

if "%setup_choice%"=="0" goto :main_menu
if "%setup_choice%"=="1" call "%~dp0setup_master_simple.bat"
if "%setup_choice%"=="2" call "%~dp0setup_face_recognition.bat"
if "%setup_choice%"=="3" call "%~dp0setup_silent_face_anti_spoofing.bat"
if "%setup_choice%"=="4" goto :create_venv
if "%setup_choice%"=="5" goto :install_deps

pause
goto :main_menu

:create_venv
echo.
echo Creating virtual environment...
cd /d "%~dp0face_recognition_system"
python -m venv venv
echo Virtual environment created!
pause
goto :main_menu

:install_deps
echo.
echo Installing dependencies...
cd /d "%~dp0face_recognition_system"
if exist "venv\Scripts\activate.bat" (
    call venv\Scripts\activate.bat
    pip install -r requirements.txt
    echo Dependencies installed!
) else (
    echo [ERROR] Virtual environment not found!
)
pause
goto :main_menu

:check_status
echo.
echo ================================================================
echo                    SYSTEM STATUS CHECK
echo ================================================================
echo.

echo [CHECK] Python Installation:
python --version 2>nul
if %errorlevel% equ 0 (
    echo ✓ Python: OK
) else (
    echo ✗ Python: NOT FOUND
)

echo.
echo [CHECK] Virtual Environment:
if exist "%~dp0face_recognition_system\venv\Scripts\activate.bat" (
    echo ✓ Virtual Environment: EXISTS
    
    cd /d "%~dp0face_recognition_system"
    call venv\Scripts\activate.bat
    echo   - Checking packages:
    python -c "import flask; print('  ✓ Flask:', flask.__version__)" 2>nul || echo "  ✗ Flask: NOT INSTALLED"
    python -c "import cv2; print('  ✓ OpenCV:', cv2.__version__)" 2>nul || echo "  ✗ OpenCV: NOT INSTALLED"
    python -c "import torch; print('  ✓ PyTorch:', torch.__version__)" 2>nul || echo "  ✗ PyTorch: NOT INSTALLED"
    python -c "import face_recognition; print('  ✓ face_recognition: OK')" 2>nul || echo "  ✗ face_recognition: NOT INSTALLED"
) else (
    echo ✗ Virtual Environment: NOT FOUND
)

echo.
echo [CHECK] Configuration Files:
if exist "%~dp0face_recognition_system\config.py" (
    echo ✓ config.py: EXISTS
) else (
    echo ✗ config.py: NOT FOUND
)

if exist "%~dp0face_recognition_system\app.py" (
    echo ✓ app.py: EXISTS
) else (
    echo ✗ app.py: NOT FOUND
)

echo.
echo [CHECK] Directory Structure:
if exist "%~dp0face_recognition_system\static\uploads" (
    echo ✓ uploads directory: EXISTS
) else (
    echo ✗ uploads directory: NOT FOUND
)

if exist "%~dp0face_recognition_system\Silent-Face-Anti-Spoofing" (
    echo ✓ Silent-Face-Anti-Spoofing: EXISTS
) else (
    echo ✗ Silent-Face-Anti-Spoofing: NOT FOUND
)

echo.
echo [CHECK] Camera Test:
cd /d "%~dp0face_recognition_system"
if exist "venv\Scripts\activate.bat" (
    call venv\Scripts\activate.bat
    python -c "
import cv2
cap = cv2.VideoCapture(0)
if cap.isOpened():
    print('✓ Camera: AVAILABLE')
    cap.release()
else:
    print('✗ Camera: NOT AVAILABLE')
" 2>nul || echo "✗ Camera test failed"
) else (
    echo "✗ Cannot test camera (no virtual environment)"
)

echo.
pause
goto :main_menu

:config_menu
echo.
echo ================================================================
echo                   CONFIGURATION MENU
echo ================================================================
echo.
echo [1] Edit Face Recognition Config
echo [2] Edit Anti-Spoofing Config
echo [3] View Current Configuration
echo [4] Reset Configuration to Default
echo [0] Back to Main Menu
echo.
set /p config_choice="Choose config option (0-4): "

if "%config_choice%"=="0" goto :main_menu
if "%config_choice%"=="1" notepad "%~dp0face_recognition_system\config.py"
if "%config_choice%"=="2" notepad "%~dp0face_recognition_system\Silent-Face-Anti-Spoofing\config.py"
if "%config_choice%"=="3" goto :view_config
if "%config_choice%"=="4" goto :reset_config

goto :main_menu

:view_config
echo.
echo Current Face Recognition Configuration:
echo ========================================
if exist "%~dp0face_recognition_system\config.py" (
    type "%~dp0face_recognition_system\config.py"
) else (
    echo config.py not found!
)
echo.
pause
goto :main_menu

:reset_config
echo.
echo Resetting configuration to default...
cd /d "%~dp0face_recognition_system"
echo # Face Recognition System Configuration > config.py
echo SQLALCHEMY_DATABASE_URI = 'mysql+mysqlconnector://root:@localhost/face_recognition' >> config.py
echo SECRET_KEY = 'your-secret-key-here' >> config.py
echo UPLOAD_FOLDER = 'static/uploads' >> config.py
echo MAX_CONTENT_LENGTH = 16 * 1024 * 1024  # 16MB max file upload >> config.py
echo Configuration reset to default!
pause
goto :main_menu

:troubleshooting
echo.
echo ================================================================
echo                    TROUBLESHOOTING
echo ================================================================
echo.
echo Common Issues and Solutions:
echo.
echo 1. "ModuleNotFoundError: No module named 'torch'"
echo    → Make sure virtual environment is activated
echo    → Run: venv\Scripts\activate.bat
echo.
echo 2. "Camera not detected"
echo    → Check if camera is connected
echo    → Close other applications using camera
echo    → Update camera drivers
echo.
echo 3. "MySQL connection failed"
echo    → Start MySQL server
echo    → Check database credentials in config.py
echo    → Create database 'face_recognition'
echo.
echo 4. "face_recognition import error"
echo    → Install Visual C++ Redistributable
echo    → Reinstall dlib and face_recognition
echo.
echo 5. "Flask app won't start"
echo    → Check if port 5000 is available
echo    → Check app.py for syntax errors
echo    → Verify all dependencies installed
echo.
echo 6. "AttributeError: _ARRAY_API not found" OR NumPy/OpenCV compatibility
echo    → NumPy 2.x incompatible with OpenCV 4.8.x
echo    → Need to downgrade to NumPy 1.24.3
echo.
echo 7. "Some module may need to rebuild with pybind11>=2.12"
echo    → Need to rebuild packages with updated build tools
echo    → Especially dlib and face_recognition
echo.
echo [1] Run System Diagnostic
echo [2] Reinstall Dependencies
echo [3] Reset Virtual Environment
echo [4] Quick Fix NumPy/OpenCV Issue
echo [5] Advanced NumPy/OpenCV Fix
echo [6] Rebuild Packages (pybind11 fix)
echo [0] Back to Main Menu
echo.
set /p trouble_choice="Choose option (0-6): "

if "%trouble_choice%"=="0" goto :main_menu
if "%trouble_choice%"=="1" call "%~dp0check_requirements.bat"
if "%trouble_choice%"=="2" goto :reinstall_deps
if "%trouble_choice%"=="3" goto :reset_venv
if "%trouble_choice%"=="4" call "%~dp0quick_fix_numpy.bat"
if "%trouble_choice%"=="5" call "%~dp0fix_numpy_opencv.bat"
if "%trouble_choice%"=="6" call "%~dp0rebuild_packages.bat"

goto :main_menu

:reinstall_deps
echo.
echo Reinstalling dependencies...
cd /d "%~dp0face_recognition_system"
if exist "venv" (
    call venv\Scripts\activate.bat
    pip install --upgrade --force-reinstall -r requirements.txt
    echo Dependencies reinstalled!
) else (
    echo Virtual environment not found!
)
pause
goto :main_menu

:reset_venv
echo.
echo Resetting virtual environment...
cd /d "%~dp0face_recognition_system"
if exist "venv" rmdir /s /q venv
python -m venv venv
call venv\Scripts\activate.bat
pip install -r requirements.txt
echo Virtual environment reset and dependencies installed!
pause
goto :main_menu

:exit
echo.
echo ================================================================
echo                    GOODBYE!
echo ================================================================
echo.
echo Thank you for using Face Recognition System Manager!
echo.
pause
exit /b 0
