
'============================================================
' VBScript: start_minio_hidden.vbs
' Mục đích: Tự động khởi chạy MinIO server ẩn cửa sổ CMD
'============================================================
Option Explicit

' === CẤU HÌNH ===
Dim minioExePath, minioDataDir, consolePort, apiPort
minioExePath  = "C:\minio-data\minio.exe"     ' Đường dẫn đến minio.exe
minioDataDir  = "C:\minio-data"             ' Thư mục chứa dữ liệu MinIO
consolePort   = "9090"                       ' Cổng dashboard
apiPort       = "9000"                       ' Cổng API S3

' === THAM SỐ CHO MINIO ===
Dim args
args = " server " & minioDataDir & _
       " --console-address :" & consolePort

' === KHỞI CHẠY MINIO ẨN ===
Dim WshShell
Set WshShell = CreateObject("WScript.Shell")
WshShell.Run Chr(34) & minioExePath & Chr(34) & args, 0, False

' Thông báo đã chạy (có thể comment dòng dưới nếu không cần)
WshShell.Popup "MinIO server is starting hidden..., API:" & apiPort & ", Console:" & consolePort, 3, "MinIO Launcher"
