@echo off
echo ================================================
echo   PARKING LOT MANAGEMENT - PRODUCTION BUILD
echo              Windows Platform
echo ================================================

REM Set production environment
set NODE_ENV=production

echo.
echo Cleaning previous builds and cache...
if exist "dist" rmdir /s /q "dist"
if exist "build" rmdir /s /q "build"
call npm cache clean --force

echo.
echo Setting up Python build environment...
call setup-python-build.bat
if %ERRORLEVEL% neq 0 (
    echo ⚠️ Python setup had warnings, but continuing build...
    echo This may affect optional native dependencies but won't stop the build.
)

echo.
echo Installing/Updating dependencies...
call npm install --production=false

echo.
echo Verifying FFmpeg installation...
call node debug-ffmpeg.js

echo.
echo Running prebuild tasks...
call node prebuild.js

echo.
echo Verifying ALPR batch files...
if exist "..\backend\bienso\run_fast_alpr_service.bat" (
    echo ALPR batch file found
) else (
    echo ALPR batch file missing
)

if exist "..\backend\bienso\run_fast_alpr_service_silent.bat" (
    echo ALPR silent batch file found
) else (
    echo ALPR silent batch file missing
)

echo.
echo Verifying Face Recognition batch files...
if exist "..\backend\khuonmat\run_fast_face_service.bat" (
    echo Face Recognition batch file found
) else (
    echo Face Recognition batch file missing
)

if exist "..\backend\khuonmat\run_fast_face_service_silent.bat" (
    echo Face Recognition silent batch file found
) else (
    echo Face Recognition silent batch file missing
)

echo.
echo Verifying Relay Service batch files...
if exist "..\backend\relay\start_relay_service.bat" (
    echo Relay Service batch file found
) else (
    echo Relay Service batch file missing
)

if exist "..\backend\relay\stop_relay_service.bat" (
    echo Relay Service stop batch file found
) else (
    echo Relay Service stop batch file missing
)

if exist "..\backend\relay\fast_relay_service.py" (
    echo Relay Service Python file found
) else (
    echo Relay Service Python file missing
)

echo.
echo Building React frontend (Production)...
cd "../frontend"
if not exist "node_modules" (
    echo Installing frontend dependencies...
    call npm install
)
echo Setting Node.js memory limit for build...
set NODE_OPTIONS=--max-old-space-size=8192
call npm run build
if %ERRORLEVEL% neq 0 (
    echo Frontend build failed!
    cd "../electron-app"
    pause
    exit /b 1
)
cd "../electron-app"

echo.
echo Building Electron app for Windows (Production)...
call npm run build-win

if %ERRORLEVEL% neq 0 (
    echo Electron build failed!
    pause
    exit /b 1
)

echo.
echo Verifying build outputs...
if exist "dist\win-unpacked\Parking Lot Management.exe" (
    echo Main executable created successfully
) else (
    echo Main executable missing
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\ffmpeg-binary\ffmpeg.exe" (
    echo FFmpeg binary included
) else (
    echo FFmpeg binary missing
)

if exist "dist\Parking Lot Management Setup.exe" (
    echo Windows installer created
) else (
    echo Windows installer missing
)

if exist "dist\Parking Lot Management*.exe" (
    echo Portable executable created
) else (
    echo Portable executable missing
)

echo.
echo Verifying ALPR components in build...
if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\run_fast_alpr_service_silent.bat" (
    echo ALPR silent batch file included in build
) else (
    echo ALPR silent batch file missing in build
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\fast_alpr_service.py" (
    echo ALPR Python service included in build
) else (
    echo ALPR Python service missing in build
)

echo.
echo Verifying Face Recognition components in build...
if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\khuonmat\run_fast_face_service_silent.bat" (
    echo Face Recognition silent batch file included in build
) else (
    echo Face Recognition silent batch file missing in build
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\khuonmat\fast_face_service.py" (
    echo Face Recognition Python service included in build
) else (
    echo Face Recognition Python service missing in build
)

echo.
echo Verifying Relay Service components in build...
if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\relay\start_relay_service.bat" (
    echo Relay Service batch file included in build
) else (
    echo Relay Service batch file missing in build
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\relay\fast_relay_service.py" (
    echo Relay Service Python file included in build
) else (
    echo Relay Service Python file missing in build
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\relay\requirements_relay_service.txt" (
    echo Relay Service requirements included in build
) else (
    echo Relay Service requirements missing in build
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\relay\SETUP_RELAY_SERVICE.bat" (
    echo Relay Service setup script included in build
) else (
    echo Relay Service setup script missing in build
)

echo.
echo Build Statistics:
echo ===================
for %%f in ("dist\*.exe") do (
    echo Installer: %%~nxf - Size: %%~zf bytes
)
for %%f in ("dist\win-unpacked\*.exe") do (
    echo Main App: %%~nxf - Size: %%~zf bytes
)

echo.
echo Testing FFmpeg in production build...
if exist "dist\win-unpacked" (
    echo Running FFmpeg verification test...
    call node test-build-ffmpeg.js
) else (
    echo Build directory not found!
)

echo.
echo Testing Relay Service in production build...
if exist "dist\win-unpacked" (
    echo Running Relay Service verification test...
    call node test-relay-build.js
) else (
    echo Build directory not found!
)

echo.
echo ================================================
echo     PRODUCTION BUILD COMPLETE WITH SERVICES
echo ================================================
echo.
echo Build outputs location: %cd%\dist\
echo.
echo Available distributions:
echo   • Setup Installer: "Parking Lot Management Setup.exe"
echo   • Portable App: "Parking Lot Management [version].exe"
echo   • Unpacked App: "win-unpacked\Parking Lot Management.exe"
echo.
echo 🚀 TO START PRODUCTION SYSTEM:
echo   1. Run: .\START_PRODUCTION_SYSTEM.bat (created automatically)
echo   2. Or manually run services in this order:
echo      - ALPR Service: cd ..\backend\bienso ^& run_fast_alpr_service_silent.bat
echo      - Face Service: cd ..\backend\khuonmat ^& run_fast_face_service_silent.bat
echo      - Relay Service: cd ..\backend\relay ^& start_relay_service.bat
echo      - Electron App: npm start
echo.
echo 📋 SERVICES INCLUDED IN BUILD:
echo   • ALPR Service (License Plate Recognition)
echo   • Face Recognition Service
echo   • Fast Relay Service (USB Relay Control)
echo   • Electron Main Application
echo.

echo.
echo Creating production startup script...
echo @echo off> "..\START_PRODUCTION_SYSTEM.bat"
echo chcp 65001 ^>nul>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo    PARKING LOT MANAGEMENT - PRODUCTION STARTUP>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM Tạo timestamp cho log>> "..\START_PRODUCTION_SYSTEM.bat"
echo for /f "tokens=1-4 delims=/ " %%%%a in ('date /t') do set "current_date=%%%%a-%%%%b-%%%%c">> "..\START_PRODUCTION_SYSTEM.bat"
echo for /f "tokens=1-2 delims=: " %%%%a in ('time /t') do set "current_time=%%%%a-%%%%b">> "..\START_PRODUCTION_SYSTEM.bat"
echo set "timestamp=%%current_date%%_%%current_time%%">> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo [%%timestamp%%] Starting Parking Lot Management System...>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM BƯỚC 1: DỪNG CÁC SERVICES CŨ (NẾU CÓ)>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo [%%timestamp%%] Step 1: Stopping existing services...>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Stopping ALPR Service...>> "..\START_PRODUCTION_SYSTEM.bat"
echo cd /d "%%~dp0backend\bienso">> "..\START_PRODUCTION_SYSTEM.bat"
echo if exist "stop_alpr_service.bat" (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     call stop_alpr_service.bat ^>nul 2^>^&1>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ✅ ALPR Service stopped>> "..\START_PRODUCTION_SYSTEM.bat"
echo ) else (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ⚠️  ALPR stop script not found, killing Python processes...>> "..\START_PRODUCTION_SYSTEM.bat"
echo     taskkill /F /IM python.exe ^>nul 2^>^&1>> "..\START_PRODUCTION_SYSTEM.bat"
echo )>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Stopping Face Recognition Service...>> "..\START_PRODUCTION_SYSTEM.bat"
echo cd /d "%%~dp0backend\khuonmat">> "..\START_PRODUCTION_SYSTEM.bat"
echo if exist "stop_face_service.bat" (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     call stop_face_service.bat ^>nul 2^>^&1>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ✅ Face Recognition Service stopped>> "..\START_PRODUCTION_SYSTEM.bat"
echo ) else (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ⚠️  Face Recognition stop script not found, killing Python processes...>> "..\START_PRODUCTION_SYSTEM.bat"
echo     taskkill /F /IM python.exe ^>nul 2^>^&1>> "..\START_PRODUCTION_SYSTEM.bat"
echo )>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Stopping Fast Relay Service...>> "..\START_PRODUCTION_SYSTEM.bat"
echo cd /d "%%~dp0backend\relay">> "..\START_PRODUCTION_SYSTEM.bat"
echo if exist "stop_relay_service.bat" (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     call stop_relay_service.bat ^>nul 2^>^&1>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ✅ Fast Relay Service stopped>> "..\START_PRODUCTION_SYSTEM.bat"
echo ) else (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ⚠️  Relay stop script not found, killing Python processes...>> "..\START_PRODUCTION_SYSTEM.bat"
echo     taskkill /F /IM python.exe ^>nul 2^>^&1>> "..\START_PRODUCTION_SYSTEM.bat"
echo )>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Waiting for services to fully stop...>> "..\START_PRODUCTION_SYSTEM.bat"
echo timeout /t 3 /nobreak ^>nul>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM BƯỚC 2: KIỂM TRA PYTHON ENVIRONMENT>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo [%%timestamp%%] Step 2: Checking Python environments...>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Checking ALPR Python environment...>> "..\START_PRODUCTION_SYSTEM.bat"
echo cd /d "%%~dp0backend\bienso">> "..\START_PRODUCTION_SYSTEM.bat"
echo if not exist "venv\Scripts\activate.bat" (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ❌ ALPR Python virtual environment not found!>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo Please create Python venv first:>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo    cd backend\bienso>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo    python -m venv venv>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo    venv\Scripts\activate>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo    pip install fastapi uvicorn fast_alpr opencv-python numpy>> "..\START_PRODUCTION_SYSTEM.bat"
echo     pause>> "..\START_PRODUCTION_SYSTEM.bat"
echo     exit /b 1>> "..\START_PRODUCTION_SYSTEM.bat"
echo )>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo ✅ ALPR Python environment found>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Checking Face Recognition Python environment...>> "..\START_PRODUCTION_SYSTEM.bat"
echo cd /d "%%~dp0backend\khuonmat">> "..\START_PRODUCTION_SYSTEM.bat"
echo if not exist "face_recognition_system\venv\Scripts\activate.bat" (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ❌ Face Recognition Python virtual environment not found!>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo Please run setup_face_recognition.bat first>> "..\START_PRODUCTION_SYSTEM.bat"
echo     pause>> "..\START_PRODUCTION_SYSTEM.bat"
echo     exit /b 1>> "..\START_PRODUCTION_SYSTEM.bat"
echo )>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo ✅ Face Recognition Python environment found>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Checking Fast Relay Python environment...>> "..\START_PRODUCTION_SYSTEM.bat"
echo cd /d "%%~dp0backend\relay">> "..\START_PRODUCTION_SYSTEM.bat"
echo if not exist "venv\Scripts\activate.bat" (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ⚠️  Fast Relay Python virtual environment not found!>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo Setting up relay service environment...>> "..\START_PRODUCTION_SYSTEM.bat"
echo     python -m venv venv>> "..\START_PRODUCTION_SYSTEM.bat"
echo     if exist "venv\Scripts\activate.bat" (>> "..\START_PRODUCTION_SYSTEM.bat"
echo         call venv\Scripts\activate.bat>> "..\START_PRODUCTION_SYSTEM.bat"
echo         pip install -r requirements_relay_service.txt>> "..\START_PRODUCTION_SYSTEM.bat"
echo         echo ✅ Fast Relay Python environment created>> "..\START_PRODUCTION_SYSTEM.bat"
echo     ) else (>> "..\START_PRODUCTION_SYSTEM.bat"
echo         echo ❌ Failed to create relay environment - continuing without relay service>> "..\START_PRODUCTION_SYSTEM.bat"
echo     )>> "..\START_PRODUCTION_SYSTEM.bat"
echo ) else (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ✅ Fast Relay Python environment found>> "..\START_PRODUCTION_SYSTEM.bat"
echo )>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM BƯỚC 3: KHỞI ĐỘNG ALPR BACKEND SERVICE>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo [%%timestamp%%] Step 3: Starting ALPR Backend Service...>> "..\START_PRODUCTION_SYSTEM.bat"
echo cd /d "%%~dp0backend\bienso">> "..\START_PRODUCTION_SYSTEM.bat"
echo start "ALPR Service" cmd /k "venv\Scripts\activate ^&^& python fast_alpr_service.py --host 127.0.0.1 --port 5001">> "..\START_PRODUCTION_SYSTEM.bat"
echo echo ✅ ALPR Service starting on http://127.0.0.1:5001>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM Wait for ALPR service to start>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Waiting for ALPR service to initialize...>> "..\START_PRODUCTION_SYSTEM.bat"
echo timeout /t 8 /nobreak ^>nul>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM Test ALPR service health>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Testing ALPR service health...>> "..\START_PRODUCTION_SYSTEM.bat"
echo powershell -Command "try { $response = Invoke-WebRequest -Uri 'http://127.0.0.1:5001/healthz' -UseBasicParsing -TimeoutSec 10; if($response.StatusCode -eq 200) { Write-Host '✅ ALPR Service is ready' } else { Write-Host '❌ ALPR Service health check failed (Status: ' $response.StatusCode ')' } } catch { Write-Host '❌ ALPR Service is not responding:' $_.Exception.Message }">> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM BƯỚC 4: KHỞI ĐỘNG FACE RECOGNITION SERVICE>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo [%%timestamp%%] Step 4: Starting Face Recognition Service...>> "..\START_PRODUCTION_SYSTEM.bat"
echo cd /d "%%~dp0backend\khuonmat">> "..\START_PRODUCTION_SYSTEM.bat"
echo start "Face Recognition Service" cmd /k "face_recognition_system\venv\Scripts\activate ^&^& python fast_face_service.py --host 127.0.0.1 --port 5055">> "..\START_PRODUCTION_SYSTEM.bat"
echo echo ✅ Face Recognition Service starting on http://127.0.0.1:5055>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM Wait for Face service to start>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Waiting for Face Recognition service to initialize...>> "..\START_PRODUCTION_SYSTEM.bat"
echo timeout /t 8 /nobreak ^>nul>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM Test Face service health>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Testing Face Recognition service health...>> "..\START_PRODUCTION_SYSTEM.bat"
echo powershell -Command "try { $response = Invoke-WebRequest -Uri 'http://127.0.0.1:5055/healthz' -UseBasicParsing -TimeoutSec 10; if($response.StatusCode -eq 200) { Write-Host '✅ Face Recognition Service is ready' } else { Write-Host '❌ Face Recognition Service health check failed (Status: ' $response.StatusCode ')' } } catch { Write-Host '❌ Face Recognition Service is not responding:' $_.Exception.Message }">> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM BƯỚC 5: KHỞI ĐỘNG FAST RELAY SERVICE>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo [%%timestamp%%] Step 5: Starting Fast Relay Service...>> "..\START_PRODUCTION_SYSTEM.bat"
echo cd /d "%%~dp0backend\relay">> "..\START_PRODUCTION_SYSTEM.bat"
echo if exist "venv\Scripts\activate.bat" (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     start "Fast Relay Service" cmd /k "venv\Scripts\activate ^&^& python fast_relay_service.py">> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ✅ Fast Relay Service starting on http://127.0.0.1:5003>> "..\START_PRODUCTION_SYSTEM.bat"
echo     .>> "..\START_PRODUCTION_SYSTEM.bat"
echo     REM Wait for Relay service to start>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo Waiting for Fast Relay service to initialize...>> "..\START_PRODUCTION_SYSTEM.bat"
echo     timeout /t 5 /nobreak ^>nul>> "..\START_PRODUCTION_SYSTEM.bat"
echo     .>> "..\START_PRODUCTION_SYSTEM.bat"
echo     REM Test Relay service health>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo Testing Fast Relay service health...>> "..\START_PRODUCTION_SYSTEM.bat"
echo     powershell -Command "try { $response = Invoke-WebRequest -Uri 'http://127.0.0.1:5003/healthz' -UseBasicParsing -TimeoutSec 10; if($response.StatusCode -eq 200) { Write-Host '✅ Fast Relay Service is ready' } else { Write-Host '❌ Fast Relay Service health check failed (Status: ' $response.StatusCode ')' } } catch { Write-Host '❌ Fast Relay Service is not responding:' $_.Exception.Message }">> "..\START_PRODUCTION_SYSTEM.bat"
echo ) else (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ⚠️  Fast Relay Service environment not found - continuing without relay control>> "..\START_PRODUCTION_SYSTEM.bat"
echo )>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM BƯỚC 6: KHỞI ĐỘNG ELECTRON APP>> "..\START_PRODUCTION_SYSTEM.bat"
echo REM ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo [%%timestamp%%] Step 6: Starting Electron Application...>> "..\START_PRODUCTION_SYSTEM.bat"
echo cd /d "%%~dp0electron-app">> "..\START_PRODUCTION_SYSTEM.bat"
echo if not exist "node_modules" (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo Installing electron dependencies...>> "..\START_PRODUCTION_SYSTEM.bat"
echo     call npm install>> "..\START_PRODUCTION_SYSTEM.bat"
echo     if %%errorlevel%% neq 0 (>> "..\START_PRODUCTION_SYSTEM.bat"
echo         echo ❌ Failed to install electron dependencies>> "..\START_PRODUCTION_SYSTEM.bat"
echo         pause>> "..\START_PRODUCTION_SYSTEM.bat"
echo         exit /b 1>> "..\START_PRODUCTION_SYSTEM.bat"
echo     )>> "..\START_PRODUCTION_SYSTEM.bat"
echo )>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Starting Electron app...>> "..\START_PRODUCTION_SYSTEM.bat"
echo call npm start>> "..\START_PRODUCTION_SYSTEM.bat"
echo if %%errorlevel%% neq 0 (>> "..\START_PRODUCTION_SYSTEM.bat"
echo     echo ❌ Failed to start Electron app>> "..\START_PRODUCTION_SYSTEM.bat"
echo     pause>> "..\START_PRODUCTION_SYSTEM.bat"
echo     exit /b 1>> "..\START_PRODUCTION_SYSTEM.bat"
echo )>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo      PARKING LOT MANAGEMENT SYSTEM READY!>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo ================================================>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Services running:>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo   • ALPR Service: http://127.0.0.1:5001>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo   • Face Recognition: http://127.0.0.1:5055>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo   • Fast Relay: http://127.0.0.1:5003>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo   • Electron App: Running>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo echo Press Ctrl+C to stop all services>> "..\START_PRODUCTION_SYSTEM.bat"
echo.>> "..\START_PRODUCTION_SYSTEM.bat"
echo pause>> "..\START_PRODUCTION_SYSTEM.bat"

echo ✅ START_PRODUCTION_SYSTEM.bat created successfully
echo.

pause
