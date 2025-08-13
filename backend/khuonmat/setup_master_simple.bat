@echo off
REM =====================================================
REM SCRIPT SETUP MASTER - PHIEN BAN DON GIAN
REM Ngay tao: 12/08/2025
REM Mo ta: Setup don gian khong co ky tu dac biet
REM =====================================================

echo.
echo ================================================================
echo        SETUP TONG HOP - FACE RECOGNITION SYSTEM
echo ================================================================
echo.

REM Kiem tra Python
echo [STEP 1] Checking Python installation...
python --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Python not found in PATH!
    echo Please install Python 3.8+ from: https://www.python.org/downloads/
    echo Make sure to check "Add Python to PATH" during installation.
    pause
    exit /b 1
) else (
    python --version
    echo [OK] Python is ready.
)

REM Kiem tra pip
echo.
echo [STEP 2] Checking pip...
pip --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] pip not available!
    echo Installing pip...
    python -m ensurepip --upgrade
) else (
    echo [OK] pip is ready.
)

echo.
echo ================================================================
echo                    SETUP OPTIONS
echo ================================================================
echo.
echo Choose setup method:
echo [1] Setup Face Recognition System
echo [2] Setup Silent Face Anti-Spoofing  
echo [3] Setup both systems (Recommended)
echo [4] Create virtual environment only
echo [0] Exit
echo.
set /p choice="Your choice (1-4, 0 to exit): "

if "%choice%"=="0" goto :end
if "%choice%"=="1" goto :setup_face_recognition
if "%choice%"=="2" goto :setup_anti_spoofing
if "%choice%"=="3" goto :setup_both
if "%choice%"=="4" goto :setup_venv_only

echo [ERROR] Invalid choice!
pause
goto :end

:setup_face_recognition
echo.
echo [EXECUTING] Setup Face Recognition System...
call "%~dp0setup_face_recognition.bat"
goto :end

:setup_anti_spoofing
echo.
echo [EXECUTING] Setup Silent Face Anti-Spoofing...
call "%~dp0setup_silent_face_anti_spoofing.bat"
goto :end

:setup_both
echo.
echo [EXECUTING] Setup both systems...
echo.
echo Step 1: Setup Face Recognition System
echo ----------------------------------------
call "%~dp0setup_face_recognition.bat"
if %errorlevel% neq 0 (
    echo [ERROR] Face Recognition setup failed!
    pause
    goto :end
)
echo.
echo Step 2: Setup Silent Face Anti-Spoofing
echo ----------------------------------------
call "%~dp0setup_silent_face_anti_spoofing.bat"
if %errorlevel% neq 0 (
    echo [ERROR] Anti-Spoofing setup failed!
    pause
    goto :end
)
echo.
echo [SUCCESS] Both systems setup completed!
goto :final_instructions

:setup_venv_only
echo.
echo [EXECUTING] Creating virtual environment only...
cd /d "%~dp0face_recognition_system"
if exist "venv" (
    echo [INFO] Virtual environment already exists.
    echo Do you want to recreate it? (Y/N)
    set /p recreate=
    if /i "%recreate%"=="Y" (
        rmdir /s /q venv
        python -m venv venv
        echo [OK] Virtual environment recreated.
    )
) else (
    python -m venv venv
    echo [OK] Virtual environment created.
)
goto :end

:final_instructions
echo.
echo ================================================================
echo                    SUCCESS - SETUP COMPLETED
echo ================================================================
echo.
echo USAGE INSTRUCTIONS:
echo.
echo 1. To activate virtual environment:
echo    cd face_recognition_system
echo    venv\Scripts\activate
echo.
echo 2. To run Face Recognition:
echo    python app.py
echo.
echo 3. To test Anti-Spoofing:
echo    cd Silent-Face-Anti-Spoofing
echo    python test_setup.py
echo.
echo CONFIGURATION NEEDED:
echo 1. Update database connection in: face_recognition_system\config.py
echo 2. Place model files in: Silent-Face-Anti-Spoofing\resources\
echo 3. Ensure MySQL server is running
echo.
echo CHECKLIST:
echo [ ] MySQL server started
echo [ ] Database 'face_recognition' exists
echo [ ] Camera/webcam connected
echo [ ] Model files downloaded
echo.
goto :end

:end
echo.
echo ================================================================
echo                         END
echo ================================================================
echo.
pause
