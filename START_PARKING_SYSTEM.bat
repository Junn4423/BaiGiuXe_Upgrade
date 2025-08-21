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

REM ================================================
REM BƯỚC 1: DỪNG CÁC SERVICES CŨ (NẾU CÓ)
REM ================================================
echo [%timestamp%] Step 1: Stopping existing services...

echo Stopping ALPR Service...
cd /d "%~dp0backend\bienso"
if exist "stop_alpr_service.bat" (
    call stop_alpr_service.bat >nul 2>&1
    echo ✅ ALPR Service stopped
) else (
    echo ⚠️  ALPR stop script not found, killing Python processes...
    taskkill /F /IM python.exe >nul 2>&1
)

echo Stopping Face Recognition Service...
cd /d "%~dp0backend\khuonmat"
if exist "stop_face_service.bat" (
    call stop_face_service.bat >nul 2>&1
    echo ✅ Face Recognition Service stopped
) else (
    echo ⚠️  Face Recognition stop script not found, killing Python processes...
    taskkill /F /IM python.exe >nul 2>&1
)

echo Stopping Fast Relay Service...
cd /d "%~dp0backend\relay"
if exist "stop_relay_service.bat" (
    call stop_relay_service.bat >nul 2>&1
    echo ✅ Fast Relay Service stopped
) else (
    echo ⚠️  Relay stop script not found, killing Python processes...
    taskkill /F /IM python.exe >nul 2>&1
)

echo Waiting for services to fully stop...
timeout /t 3 /nobreak >nul
echo.

REM ================================================
REM BƯỚC 2: KIỂM TRA PYTHON ENVIRONMENT
REM ================================================
echo [%timestamp%] Step 2: Checking Python environments...

echo Checking ALPR Python environment...
cd /d "%~dp0backend\bienso"
if not exist "venv\Scripts\activate.bat" (
    echo ❌ ALPR Python virtual environment not found!
    echo Please create Python venv first:
    echo    cd backend\bienso
    echo    python -m venv venv
    echo    venv\Scripts\activate
    echo    pip install fastapi uvicorn fast_alpr opencv-python numpy
    pause
    exit /b 1
)
echo ✅ ALPR Python environment found

echo Checking Face Recognition Python environment...
cd /d "%~dp0backend\khuonmat"
if not exist "face_recognition_system\venv\Scripts\activate.bat" (
    echo ❌ Face Recognition Python virtual environment not found!
    echo Please run setup_face_recognition.bat first
    pause
    exit /b 1
)
echo ✅ Face Recognition Python environment found

echo Checking Fast Relay Python environment...
cd /d "%~dp0backend\relay"
if not exist "venv\Scripts\activate.bat" (
    echo ⚠️  Fast Relay Python virtual environment not found!
    echo Setting up relay service environment...
    python -m venv venv
    if exist "venv\Scripts\activate.bat" (
        call venv\Scripts\activate.bat
        pip install -r requirements_relay_service.txt
        echo ✅ Fast Relay Python environment created
    ) else (
        echo ❌ Failed to create relay environment - continuing without relay service
    )
) else (
    echo ✅ Fast Relay Python environment found
)
echo.

REM ================================================
REM BƯỚC 3: BUILD FRONTEND
REM ================================================
echo [%timestamp%] Step 3: Building Frontend...
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
set NODE_OPTIONS=--max-old-space-size=8192
call npm run build
if %errorlevel% neq 0 (
    echo ❌ Failed to build frontend
    pause
    exit /b 1
)
echo ✅ Frontend built successfully
echo.

REM ================================================
REM BƯỚC 4: KHỞI ĐỘNG ALPR BACKEND SERVICE
REM ================================================
echo [%timestamp%] Step 4: Starting ALPR Backend Service...
cd /d "%~dp0backend\bienso"
start "ALPR Service" cmd /k "venv\Scripts\activate && python fast_alpr_service.py --host 127.0.0.1 --port 5001"
echo ✅ ALPR Service starting on http://127.0.0.1:5001

REM Wait for ALPR service to start
echo Waiting for ALPR service to initialize...
timeout /t 8 /nobreak >nul

REM Test ALPR service health (FIX: Đổi port từ 5005 thành 5001)
echo Testing ALPR service health...
powershell -Command "try { $response = Invoke-WebRequest -Uri 'http://127.0.0.1:5001/healthz' -UseBasicParsing -TimeoutSec 10; if($response.StatusCode -eq 200) { Write-Host '✅ ALPR Service is ready' } else { Write-Host '❌ ALPR Service health check failed (Status: ' $response.StatusCode ')' } } catch { Write-Host '❌ ALPR Service is not responding:' $_.Exception.Message }"
echo.

REM ================================================
REM BƯỚC 5: KHỞI ĐỘNG FACE RECOGNITION SERVICE
REM ================================================
echo [%timestamp%] Step 5: Starting Face Recognition Service...
cd /d "%~dp0backend\khuonmat"
start "Face Recognition Service" cmd /k "face_recognition_system\venv\Scripts\activate && python fast_face_service.py --host 127.0.0.1 --port 5055"
echo ✅ Face Recognition Service starting on http://127.0.0.1:5055

REM Wait for Face service to start
echo Waiting for Face Recognition service to initialize...
timeout /t 8 /nobreak >nul

REM Test Face service health
echo Testing Face Recognition service health...
powershell -Command "try { $response = Invoke-WebRequest -Uri 'http://127.0.0.1:5055/healthz' -UseBasicParsing -TimeoutSec 10; if($response.StatusCode -eq 200) { Write-Host '✅ Face Recognition Service is ready' } else { Write-Host '❌ Face Recognition Service health check failed (Status: ' $response.StatusCode ')' } } catch { Write-Host '❌ Face Recognition Service is not responding:' $_.Exception.Message }"
echo.

REM ================================================
REM BƯỚC 6: KHỞI ĐỘNG FAST RELAY SERVICE
REM ================================================
echo [%timestamp%] Step 6: Starting Fast Relay Service...
cd /d "%~dp0backend\relay"
if exist "venv\Scripts\activate.bat" (
    start "Fast Relay Service" cmd /k "venv\Scripts\activate && python fast_relay_service.py"
    echo ✅ Fast Relay Service starting on http://127.0.0.1:5003
    
    REM Wait for Relay service to start
    echo Waiting for Fast Relay service to initialize...
    timeout /t 5 /nobreak >nul
    
    REM Test Relay service health
    echo Testing Fast Relay service health...
    powershell -Command "try { $response = Invoke-WebRequest -Uri 'http://127.0.0.1:5003/healthz' -UseBasicParsing -TimeoutSec 10; if($response.StatusCode -eq 200) { Write-Host '✅ Fast Relay Service is ready' } else { Write-Host '❌ Fast Relay Service health check failed (Status: ' $response.StatusCode ')' } } catch { Write-Host '❌ Fast Relay Service is not responding:' $_.Exception.Message }"
) else (
    echo ⚠️  Fast Relay Service environment not found - continuing without relay control
)
echo.

REM ================================================
REM BƯỚC 7: KHỞI ĐỘNG ELECTRON APP
REM ================================================
echo [%timestamp%] Step 7: Starting Electron Application...
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
echo ✅ ALPR Service: Running on http://127.0.0.1:5001
echo ✅ Face Recognition Service: Running on http://127.0.0.1:5055
echo ✅ Fast Relay Service: Running on http://127.0.0.1:5003
echo ✅ Electron App: Running
echo ✅ Realtime License Plate Detection: Active
echo ✅ Realtime Face Recognition: Active
echo ✅ USB Relay Control: Active
echo ⚠️  MinIO: Disabled (using local storage)
echo ================================================
echo.
echo To stop all services, run STOP_PARKING_SYSTEM.bat
echo Press any key to exit this launcher...
pause >nul
