@echo off
echo Testing Fast Relay Service...
echo ============================

REM Change to relay directory
cd /d "%~dp0"

REM Activate virtual environment
if exist "venv\Scripts\activate.bat" (
    call venv\Scripts\activate.bat
)

echo Testing relay service endpoints...
echo.

REM Test health check
echo 1. Testing health check endpoint...
curl -X GET "http://127.0.0.1:5003/healthz" -H "accept: application/json"
echo.
echo.

REM Test relay status
echo 2. Testing relay status endpoint...
curl -X GET "http://127.0.0.1:5003/relay/status" -H "accept: application/json"
echo.
echo.

REM Test individual relay control
echo 3. Testing individual relay control...
echo    - Turning ON relay 1...
curl -X POST "http://127.0.0.1:5003/relay/control" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"relay_num\": 1, \"state\": true}"
echo.
timeout /t 2 >nul

echo    - Turning OFF relay 1...
curl -X POST "http://127.0.0.1:5003/relay/control" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"relay_num\": 1, \"state\": false}"
echo.
echo.

REM Test multiple relay control
echo 4. Testing multiple relay control...
echo    - Turning ON relays 1 and 3 (bitmask 5)...
curl -X POST "http://127.0.0.1:5003/relay/control-multiple" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"bitmask\": 5}"
echo.
timeout /t 2 >nul

REM Test turn off all relays
echo 5. Testing turn off all relays...
curl -X POST "http://127.0.0.1:5003/relay/all-off" -H "accept: application/json"
echo.
echo.

REM Test sequence test
echo 6. Testing sequence test (1 cycle, 500ms delay)...
curl -X POST "http://127.0.0.1:5003/relay/sequence-test" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"cycles\": 1, \"delay_ms\": 500}"
echo.
echo.

echo Test completed!
echo API documentation: http://127.0.0.1:5003/docs
pause
