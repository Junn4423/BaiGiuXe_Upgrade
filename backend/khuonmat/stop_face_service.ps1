Write-Host "Stopping Face Recognition Service..."

# Tìm và dừng tất cả Python processes chạy fast_face_service.py
$processes = Get-WmiObject Win32_Process | Where-Object { 
    $_.Name -eq "python.exe" -and $_.CommandLine -like "*fast_face_service.py*" 
}

$stopped = $false
foreach ($process in $processes) {
    Write-Host "Found Face Recognition Service with PID: $($process.ProcessId)"
    try {
        Stop-Process -Id $process.ProcessId -Force
        Write-Host "Successfully stopped PID: $($process.ProcessId)"
        $stopped = $true
    } catch {
        Write-Host "Failed to stop PID: $($process.ProcessId)"
    }
}

if ($stopped) {
    Write-Host "Face Recognition Service stopped successfully."
} else {
    Write-Host "Face Recognition Service is not running."
}

Write-Host ""
Read-Host "Press Enter to continue"
