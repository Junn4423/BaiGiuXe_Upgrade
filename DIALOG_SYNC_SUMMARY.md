1. CÁC DIALOG QUẢN LÝ CẦN BỔ SUNG (so với mobile app):
Dialog Quản lý Camera (CameraManagementDialogNew.jsx)
Thiếu:
Chức năng kiểm tra camera hoạt động
Phân loại camera theo cổng (congVao/congRa)
Dialog Quản lý Thẻ RFID (RfidManagerDialogNew.jsx)
Thiếu:
Gán chính sách giá cho thẻ VIP (như mobile có)
Tính toán ngày hết hạn chính sách
Kiểm tra thẻ đang có xe gửi hay không
Hiển thị biển số gắn với thẻ VIP/Nhân viên
Dialog Quản lý Khu vực (ParkingZoneDialog.jsx)
Thiếu:
Quản lý cổng ra vào (bảng pm_nc0007)
Thống kê camera/cổng trong khu vực
Chức năng xem chi tiết khu vực với đầy đủ thông tin
Dialog Quản lý Chính sách giá (PricingPolicyDialog.jsx)
Thiếu:
Tính năng "tongNgay" cho chính sách VIP (tháng/năm)
Loại chính sách (NGAY, THANG, NAM)
Validation chặt chẽ hơn cho các trường
2. PHẦN QUÉT XE RA CẦN THÊM:
Hiện tại trong VehicleManager.js và main_UI.jsx đã có logic xe ra cơ bản, nhưng so với mobile app còn thiếu:
Tính năng quét xe ra cần bổ sung:
So sánh ảnh vào/ra: Hiển thị cả 2 ảnh (biển số + khuôn mặt) để so sánh
Xử lý biển số không khớp: Dialog cho phép sửa biển số hoặc tìm phiên theo biển số
Tìm phiên theo biển số: Khi không có thẻ, tìm xe theo biển số nhận dạng được
Hiển thị chi tiết phiên: Thời gian gửi, phí, chính sách áp dụng
Xác nhận thanh toán: Hiển thị rõ số tiền và xác nhận trước khi xe ra