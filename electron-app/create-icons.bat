@echo off
echo Tạo icon placeholder cho ứng dụng...

:: Tạo thư mục assets nếu chưa có
if not exist "assets" mkdir assets

:: Tạo file README về icons
echo # Icon Files > assets\ICON_GUIDE.md
echo. >> assets\ICON_GUIDE.md
echo Bạn cần thêm các file icon sau để build ứng dụng: >> assets\ICON_GUIDE.md
echo. >> assets\ICON_GUIDE.md
echo - icon.ico (256x256, Windows) >> assets\ICON_GUIDE.md
echo - icon.png (512x512, Linux) >> assets\ICON_GUIDE.md
echo - icon.icns (512x512, macOS) >> assets\ICON_GUIDE.md
echo. >> assets\ICON_GUIDE.md
echo Tạm thời có thể download icon miễn phí từ: >> assets\ICON_GUIDE.md
echo - https://icons8.com/icons/set/parking >> assets\ICON_GUIDE.md
echo - https://www.flaticon.com/search?word=parking >> assets\ICON_GUIDE.md

echo Icon guide đã được tạo trong assets/ICON_GUIDE.md
echo Vui lòng thêm các file icon trước khi build!
pause
