Nhân viên – báo cáo phải xuất (mỗi ca/ngày)
1. Báo cáo ca (sheet: Ca_BaoCao)
Thông tin ca: Ngày, Ca, Giờ bắt đầu/kết thúc, Nhân viên (ID/Tên), Cổng, Làn.
Sản lượng & vé: Số vé phát hành, vé hủy, lost ticket, số lần override/miễn giảm & tổng tiền miễn giảm.
Doanh thu: Tiền mặt/QR/Thẻ, tổng thực thu, tổng theo hệ thống, chênh lệch, tiền mặt thực nộp.
Ký duyệt: Chữ ký NV & quản lý, ghi chú bất thường.

2. Giao dịch vé lượt (sheet: GiaoDich_VeLuot)
Vé & thời điểm: TicketID, vào/ra, biển số (raw & chuẩn hóa), loại xe, khu vực.
Giá & thu tiền: Snapshot bảng giá, miễn/giảm, tiền thu.
Thiết bị & làn: Thiết bị vào/ra, cổng/làn vào–ra, điểm tin cậy ANPR, RFID_OK, link ảnh vào/ra.
Truy vết nghiệp vụ: NV thao tác, lý do điều chỉnh.

3. Sự cố/ khiếu nại (sheet: SuCo_KhieuNai)
Case log: Ngày–giờ, loại sự cố, TicketID/biển số, mô tả, ảnh chứng cứ, xử lý, thời gian xử lý (phút), kết quả, bồi thường (nếu có), trạng thái.

4. Log thiết bị (sheet: ThietBi_Log)
Thiết bị: ID, loại (camera/đầu đọc/barrier/printer…), khu vực–cổng–làn.
Sự kiện: Up/down, lỗi, mô tả, firmware; uptime/downtime (phút), MTTR, người xử lý, kết quả.

I. Doanh thu & tài chính
Theo thời gian: Doanh thu theo ngày/tuần/tháng/năm; so sánh kỳ và biểu đồ tăng trưởng.
Theo loại xe: Xe máy; ô tô (4/6/12 chỗ…).
Theo chính sách giá: Thẻ VIP; khách lẻ; gói thời gian (4H, 8H, 30 ngày…).
Theo khu vực: Khu A, Khu B, … (tầng/khối/khu vực).

II. Phương tiện & lượt gửi xe
Tổng lượt: Theo ngày/tuần/tháng; theo loại phương tiện; phân bố theo giờ trong ngày.
Trạng thái phiên: ĐANG_GỬI (DANG_GUI); ĐÃ_RA (DA_RA); ĐANG_XỬ_LÝ (DANG_XU_LY).
Xe quá hạn: Danh sách quá thời gian quy định; phí phát sinh.
Theo biển số: Top tần suất; xe lạ/mới; xe VIP thường xuyên.

III. Thẻ RFID & khách hàng
Tình trạng thẻ: VIP đang hoạt động; khách lẻ; thẻ sắp hết hạn/đã hết hạn.
Theo loại thẻ: Lượt sử dụng VIP vs khách; doanh thu theo loại thẻ.

IV. Hạ tầng & thiết bị
Camera: Số lần nhận diện biển số/khuôn mặt; tỷ lệ thành công; lỗi.
Barrier/cổng: Số lần mở vào/ra; thống kê theo từng cổng.
Chỗ đỗ: Tỷ lệ lấp đầy; chỗ đỗ sử dụng nhiều nhất; thời gian sử dụng trung bình.

V. Phân tích nâng cao
Thời gian gửi xe: Trung bình; phân bố (<1h, 1–4h, 4–8h, >8h); so sánh theo loại xe.
Giờ cao điểm: Lượt vào/ra theo giờ; xác định giờ cao điểm.
Hiệu quả sử dụng: Theo khu vực; thời gian đỗ trung bình; doanh thu/spot.
Log hệ thống: Số lần truy cập; theo IP; theo thiết bị truy cập.

VI. Xuất file & in ấn
Xuất Excel cho tất cả báo cáo.
Báo cáo cuối ngày: Chi tiết & tổng kết.
Báo cáo tháng: Tổng hợp & doanh thu.
In ấn; phiếu gửi xe cho khách hàng.

VII. Báo cáo theo yêu cầu
So sánh doanh thu giữa tháng/kỳ.
So sánh lượng xe giữa khu vực.
Phân tích xu hướng theo thời gian.