# -*- coding: utf-8 -*-
"""
Cấu hình kết nối database cho import ERP
Vui lòng điều chỉnh các thông số kết nối theo hệ thống của bạn
"""

# Cấu hình database ERP chính (chứa thông tin nhân viên)
ERP_MAIN_CONFIG = {
    'host': '192.168.1.90',      # IP server MySQL ERP
    'port': 3306,             # Port MySQL
    'user': 'faceuser',           # Username MySQL
    'password': 'THU@1982',           # Password MySQL
    'database': 'nhansu_erp_sofv4_0',
    'charset': 'utf8mb4'
}

# Cấu hình database ERP documents (chứa ảnh nhân viên)
ERP_DOCS_CONFIG = {
    'host': '192.168.1.90',      # IP server MySQL ERP Documents
    'port': 3306,             # Port MySQL
    'user': 'faceuser',           # Username MySQL
    'password': 'THU@1982',           # Password MySQL
    'database': 'nhansu_sof_documents_v4_0',
    'charset': 'utf8mb4'
}

# Cấu hình bảng và cột
EMPLOYEE_TABLE = 'hr_lv0020'
EMPLOYEE_COLUMNS = {
    'employee_id': 'lv001',   # Cột mã nhân viên
    'name': 'lv002',          # Cột tên nhân viên
    'department': 'lv003',    # Cột phòng ban (có thể để None)
    'position': 'lv004'       # Cột chức vụ (có thể để None)
}

IMAGE_TABLE = 'hr_lv0041'
IMAGE_COLUMNS = {
    'employee_id': 'lv002',   # Cột mã nhân viên (khóa ngoại)
    'image_blob': 'lv008'     # Cột chứa ảnh BLOB
}

# Cấu hình bảng chấm công ERP
ATTENDANCE_TABLE = 'tc_lv0012'
ATTENDANCE_COLUMNS = {
    'employee_id': 'lv001',    # Mã nhân viên
    'date': 'lv002',          # Ngày tháng năm điểm danh (yyyy-mm-dd)
    'time': 'lv003',          # Giờ điểm danh (00:00:00)
    'type': 'lv004',          # Loại điểm danh (default: null)
    'source': 'lv005',        # Nguồn điểm danh (default: 'Camera')
    'camera_ip': 'lv099'      # IP của camera
}

# Thiết lập import
IMPORT_CONFIG = {
    'batch_size': 10,                    # Số nhân viên xử lý cùng lúc
    'skip_existing': True,               # Bỏ qua nhân viên đã tồn tại
    'require_image': True,               # Bắt buộc phải có ảnh mới import
    'face_encoding_tolerance': 0.4,      # Độ chính xác nhận diện (0.4 = 60%)
    'temp_image_format': '.jpg'          # Định dạng file tạm cho xử lý ảnh
}

# Cấu hình camera IP
CAMERA_CONFIG = {
    'ip': '192.168.1.89',               # IP camera từ RTSP URL
    'default_source': 'Camera'          # Nguồn mặc định
} 