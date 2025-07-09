@echo off

REM ============================================================
REM Batch file: stop_minio.bat
REM Mục đích: Dừng (kill) tất cả tiến trình minio.exe
REM ============================================================

echo Stopping MinIO server...
taskkill /F /IM minio.exe >nul 2>&1

if %ERRORLEVEL% EQU 0 (
    echo MinIO server has been stopped successfully.
) else (
    echo No MinIO process found or failed to stop.
)
pause
