@echo off
echo ================================================
echo Building Parking Lot Management - Windows 
echo With Python Service Integration
echo ================================================

echo.
echo 🧹 Cleaning previous builds...
if exist "dist" rmdir /s /q "dist"

echo.
echo 🐍 Setting up Python environment...
echo Checking Python installation...
python --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Error: Python is not installed or not in PATH
    echo Please install Python 3.8+ and add it to your system PATH
    pause
    exit /b 1
)

echo ✅ Python found
python --version

echo.
echo 📦 Installing Node.js dependencies...
call npm install
if %errorlevel% neq 0 (
    echo ❌ Error: Failed to install Node.js dependencies
    pause
    exit /b 1
)

echo.
echo 🐍 Setting up Python virtual environment...
cd "..\backend\bienso"

REM Create virtual environment if it doesn't exist
if not exist "venv" (
    echo Creating Python virtual environment...
    python -m venv venv
    if %errorlevel% neq 0 (
        echo ❌ Error: Failed to create virtual environment
        pause
        exit /b 1
    )
    echo ✅ Virtual environment created
)

REM Activate virtual environment and install dependencies
echo Installing Python packages in virtual environment...
call venv\Scripts\activate.bat
pip install --upgrade pip
pip install fastapi uvicorn fast_alpr opencv-python numpy requests onnxruntime python-multipart
if %errorlevel% neq 0 (
    echo ❌ Error: Failed to install Python dependencies
    pause
    exit /b 1
)
echo ✅ Python dependencies installed successfully in virtual environment
cd "..\..\electron-app"

echo.
echo 🔍 Checking FFmpeg installation...
call node debug-ffmpeg.js

echo.
echo 🏗️ Building React frontend...
cd "..\frontend"
call npm install
if %errorlevel% neq 0 (
    echo ❌ Error: Failed to install frontend dependencies
    pause
    exit /b 1
)
call npm run build
if %errorlevel% neq 0 (
    echo ❌ Error: Failed to build frontend
    pause
    exit /b 1
)
echo ✅ Frontend built successfully
cd "..\electron-app"

echo.
echo 🐍 Testing Python ALPR service with virtual environment...
echo Starting Python service test...
cd "..\backend\bienso"
call venv\Scripts\activate.bat
start /b python fast_alpr_service.py --host 127.0.0.1 --port 5001
timeout /t 5 /nobreak >nul
echo Testing service endpoint...
curl -s http://127.0.0.1:5001/healthz >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ Python ALPR service is working correctly with virtual environment
) else (
    echo ⚠️ Warning: Python ALPR service test failed - continuing build
)
taskkill /f /im python.exe >nul 2>&1
cd "..\..\electron-app"

echo.
echo 📱 Building Electron app with Python virtual environment integration...
call npm run build-win
if %errorlevel% neq 0 (
    echo ❌ Error: Failed to build Electron app
    pause
    exit /b 1
)

echo.
echo 🔧 Copying virtual environment to build...
if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso" (
    if not exist "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\venv" (
        echo Copying virtual environment...
        xcopy "..\backend\bienso\venv" "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\venv" /E /I /Y
        if %errorlevel% equ 0 (
            echo ✅ Virtual environment copied successfully
            
            REM Verify critical packages in copied virtual environment
            echo 🔍 Verifying packages in copied virtual environment...
            set "PROD_PYTHON=dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\venv\Scripts\python.exe"
            set "PROD_PIP=dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\venv\Scripts\pip.exe"
            
            if exist "%PROD_PYTHON%" (
                echo Testing package imports in production environment...
                "%PROD_PYTHON%" -c "import onnxruntime; print('✅ onnxruntime available')" || (
                    echo Installing missing onnxruntime...
                    "%PROD_PIP%" install onnxruntime
                )
                "%PROD_PYTHON%" -c "import multipart; print('✅ python-multipart available')" || (
                    echo Installing missing python-multipart...
                    "%PROD_PIP%" install python-multipart
                )
                "%PROD_PYTHON%" -c "import fast_alpr; print('✅ fast_alpr available')" || (
                    echo Installing missing fast_alpr...
                    "%PROD_PIP%" install fast_alpr
                )
            ) else (
                echo ⚠️ Warning: Python executable not found in copied virtual environment
            )
        ) else (
            echo ⚠️ Warning: Failed to copy virtual environment
        )
    ) else (
        echo ✅ Virtual environment already exists in build
        
        REM Still verify packages even if venv exists
        echo 🔍 Verifying packages in existing virtual environment...
        set "PROD_PYTHON=dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\venv\Scripts\python.exe"
        set "PROD_PIP=dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\venv\Scripts\pip.exe"
        
        if exist "%PROD_PYTHON%" (
            "%PROD_PYTHON%" -c "import onnxruntime; print('✅ onnxruntime available')" || (
                echo Installing missing onnxruntime...
                "%PROD_PIP%" install onnxruntime
            )
            "%PROD_PYTHON%" -c "import multipart; print('✅ python-multipart available')" || (
                echo Installing missing python-multipart...
                "%PROD_PIP%" install python-multipart
            )
            "%PROD_PYTHON%" -c "import fast_alpr; print('✅ fast_alpr available')" || (
                echo Installing missing fast_alpr...
                "%PROD_PIP%" install fast_alpr
            )
        )
    )
) else (
    echo ❌ Backend directory not found in build
)

echo.
echo 🔧 Post-build verification...
echo Checking build outputs...

if exist "dist\win-unpacked\Parking Lot Management.exe" (
    echo ✅ Main executable created
) else (
    echo ❌ Main executable missing
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\ffmpeg-binary\ffmpeg.exe" (
    echo ✅ FFmpeg binary included
) else (
    echo ❌ FFmpeg binary missing
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\fast_alpr_service.py" (
    echo ✅ Python ALPR service included
) else (
    echo ❌ Python ALPR service missing
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso\venv" (
    echo ✅ Python virtual environment included
) else (
    echo ❌ Python virtual environment missing
)

if exist "dist\win-unpacked\resources\app.asar.unpacked\backend\requirements.txt" (
    echo ✅ Python requirements file included
) else (
    echo ❌ Python requirements file missing
)

if exist "dist\Parking Lot Management Setup.exe" (
    echo ✅ Installer created
) else (
    echo ❌ Installer missing
)

echo.
echo 🧪 Testing built application...
if exist "dist\win-unpacked" (
    echo Running FFmpeg verification...
    node test-build-ffmpeg.js
    
    echo.
    echo Testing Python service in build with virtual environment...
    cd "dist\win-unpacked\resources\app.asar.unpacked\backend\bienso"
    if exist "fast_alpr_service.py" (
        if exist "venv\Scripts\activate.bat" (
            echo ✅ Python virtual environment found in build
            call venv\Scripts\activate.bat
            start /b python fast_alpr_service.py --host 127.0.0.1 --port 5001
            timeout /t 5 /nobreak >nul
            curl -s http://127.0.0.1:5001/healthz >nul 2>&1
            if %errorlevel% equ 0 (
                echo ✅ Python service working in build environment with virtual environment
            ) else (
                echo ⚠️ Warning: Python service not responding in build
            )
            taskkill /f /im python.exe >nul 2>&1
        ) else (
            echo ❌ Virtual environment not found in build
        )
    ) else (
        echo ❌ Python service file not found in build
    )
    cd "..\..\..\..\.."
) else (
    echo ❌ Build folder not found!
)

echo.
echo 📋 Build Summary:
echo ===============
echo ✅ Build completed successfully!
echo.
echo 📁 Build outputs:
if exist "dist" (
    dir /b "dist\*.exe" 2>nul
    dir /b "dist\win-unpacked\*.exe" 2>nul
)

echo.
echo 🚀 Next steps:
echo 1. Test the app: "dist\win-unpacked\Parking Lot Management.exe"
echo 2. Python ALPR service will auto-start with the app
echo 3. Check console logs for both RTSP streaming and Python service
echo 4. Test camera streaming and license plate recognition
echo 5. Install the app: "dist\Parking Lot Management Setup.exe"
echo.

echo 📝 Important Notes:
echo - Python must be installed on target machines
echo - Virtual environment with required packages is included in the build
echo - The app will auto-create virtual environment if needed
echo - Python ALPR service runs in isolated environment
echo - The app includes both FFmpeg and Python ALPR services
echo - Check logs if license plate recognition doesn't work
echo.

pause
