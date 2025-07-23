# Hướng dẫn chạy hệ thống bằng Docker Compose

## 1. Build và chạy toàn bộ hệ thống
```bash
docker-compose up --build
```

- Backend Flask sẽ chạy ở port 5005
- Frontend React sẽ chạy ở port 3000 (proxy về backend nếu cần)
- Ảnh khuôn mặt sẽ được lưu ở thư mục `static/faces` trên máy host

## 2. Thay đổi cấu hình ERP
- Sửa các biến môi trường trong `docker-compose.yml` phần backend:
  - ERP_HOST, ERP_PORT, ERP_USER, ERP_PASSWORD, ERP_DATABASE

## 3. Dừng hệ thống
```bash
docker-compose down
```

## 4. Lưu ý
- Đảm bảo server ERP (MySQL) có thể truy cập từ container backend (kiểm tra firewall, network)
- Nếu cần thay đổi port, sửa trong `docker-compose.yml`
- Nếu muốn xóa dữ liệu ảnh, xóa thư mục `static/faces` trên máy host 