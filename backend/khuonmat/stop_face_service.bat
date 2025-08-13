@echo off
REM =====================================================
REM Stop Face Recognition Service
REM =====================================================

echo Stopping Face Recognition Service...

REM Sử dụng PowerShell script để dừng service
powershell -ExecutionPolicy Bypass -File "%~dp0stop_face_service.ps1"
