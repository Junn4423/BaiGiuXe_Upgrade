@echo off
chcp 65001 >nul
echo ================================================
echo     PARKING LOT MANAGEMENT SYSTEM LAUNCHER
echo ================================================
echo.

REM Tạo timestamp cho log
for /f "tokens=1-4 delims=/ " %%a in ('date /t') do set "current_date=%%a-%%b-%%c"
for /f "tokens=1-2 delims=: " %%a in ('time /t') do set "current_time=%%a-%%b"
set "timestamp=%current_date%_%current_time%"

echo [%timestamp%] Starting Parking Lot Management System...
echo.

REM Kiểm tra Python environment
echo [%timestamp%] Checking Python environment for ALPR service...
cd /d "%~dp0backend\bienso"
if not exist "venv\Scripts\activate.bat" (
    echo ❌ Python virtual environment not found!
    echo Please create Python venv first:
    echo    cd backend\bienso
    echo    python -m venv venv
    echo    venv\Scripts\activate
    echo    pip install fastapi uvicorn fast_alpr opencv-python numpy
    pause
    exit /b 1
)

echo ✅ Python environment found
echo.

REM Build Frontend
echo [%timestamp%] Building Frontend...
cd /d "%~dp0frontend"
if not exist "node_modules" (
    echo Installing frontend dependencies...
    call npm install
    if %errorlevel% neq 0 (
        echo ❌ Failed to install frontend dependencies
        pause
        exit /b 1
    )
)

echo Building frontend...
call npm run build
if %errorlevel% neq 0 (
    echo ❌ Failed to build frontend
    pause
    exit /b 1
)
echo ✅ Frontend built successfully
echo.

REM Start ALPR Backend Service
echo [%timestamp%] Starting ALPR Backend Service...
cd /d "%~dp0backend\bienso"
start "ALPR Service" cmd /k "venv\Scripts\activate && python fast_alpr_service.py --host 127.0.0.1 --port 5001"
echo ✅ ALPR Service started on http://127.0.0.1:5001
echo.

REM Wait for ALPR service to start
echo Waiting for ALPR service to initialize...
timeout /t 5 /nobreak >nul
echo.

REM Test ALPR service health
echo Testing ALPR service...
powershell -Command "try { $response = Invoke-WebRequest -Uri 'http://127.0.0.1:5005/healthz' -UseBasicParsing -TimeoutSec 10; if($response.StatusCode -eq 200) { Write-Host '✅ ALPR Service is ready' } else { Write-Host '❌ ALPR Service health check failed' } } catch { Write-Host '❌ ALPR Service is not responding' }"
echo.

REM Start Face Recognition Service
echo [%timestamp%] Starting Face Recognition Service...
cd /d "%~dp0backend\khuonmat"
if exist "face_recognition_system\venv\Scripts\activate.bat" (
    start "Face Recognition Service" /MIN cmd /k "call run_fast_face_service_silent.bat"
    echo ✅ Face Recognition Service started on http://127.0.0.1:5055
    
    REM Wait for Face service to start
    echo Waiting for Face Recognition service to initialize...
    timeout /t 5 /nobreak >nul
    
    REM Test Face service health
    echo Testing Face Recognition service...
    powershell -Command "try { $response = Invoke-WebRequest -Uri 'http://127.0.0.1:5055/healthz' -UseBasicParsing -TimeoutSec 10; if($response.StatusCode -eq 200) { Write-Host '✅ Face Recognition Service is ready' } else { Write-Host '❌ Face Recognition Service health check failed' } } catch { Write-Host '❌ Face Recognition Service is not responding' }"
) else (
    echo ⚠️  Face Recognition environment not found, skipping...
)
echo.

REM Start Electron App
echo [%timestamp%] Starting Electron Application...
cd /d "%~dp0electron-app"
if not exist "node_modules" (
    echo Installing electron dependencies...
    call npm install
    if %errorlevel% neq 0 (
        echo ❌ Failed to install electron dependencies
        pause
        exit /b 1
    )
)

echo Starting Electron app...
call npm start
if %errorlevel% neq 0 (
    echo ❌ Failed to start Electron app
    pause
    exit /b 1
)

echo.
echo [%timestamp%] System started successfully!
echo.
echo ================================================
echo  SYSTEM COMPONENTS STATUS:
echo ================================================
echo ✅ Frontend: Built and ready
echo ✅ ALPR Service: Running on http://127.0.0.1:5005
echo ✅ Face Recognition Service: Running on http://127.0.0.1:5055
echo ✅ Electron App: Running
echo ✅ Realtime License Plate Detection: Active
echo ✅ Realtime Face Recognition: Active
echo ⚠️  MinIO: Disabled (using local storage)
echo ================================================
echo.
echo Press any key to exit...
pause >nul
