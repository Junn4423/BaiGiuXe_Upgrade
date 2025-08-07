@echo off
chcp 65001 >nul
echo ================================================
echo     DEVELOPMENT MODE LAUNCHER
echo ================================================
echo.

REM Start ALPR Backend Service
echo Starting ALPR Backend Service...
cd /d "%~dp0backend\bienso"
start "ALPR Service" cmd /k "venv\Scripts\activate && python fast_alpr_service.py --host 127.0.0.1 --port 5001"
echo ✅ ALPR Service started on http://127.0.0.1:5001

REM Wait a bit for ALPR service
timeout /t 3 /nobreak >nul

REM Start Frontend Development Server
echo Starting Frontend Development Server...
cd /d "%~dp0frontend"
start "Frontend Dev" cmd /k "npm start"
echo ✅ Frontend dev server starting on http://localhost:3000

REM Wait a bit for frontend
timeout /t 5 /nobreak >nul

REM Start Electron in Development Mode
echo Starting Electron in Development Mode...
cd /d "%~dp0electron-app"
start "Electron Dev" cmd /k "npm run dev"
echo ✅ Electron development mode started

echo.
echo ================================================
echo  DEVELOPMENT SERVERS STARTED:
echo ================================================
echo ✅ ALPR Service: http://127.0.0.1:5001
echo ✅ Frontend Dev: http://localhost:3000  
echo ✅ Electron Dev: Development mode
echo ================================================
echo.
echo All development servers are starting...
echo Check the individual windows for detailed logs.
echo.
pause
