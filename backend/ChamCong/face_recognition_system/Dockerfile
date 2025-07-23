# Dockerfile cho backend Flask + anti-spoofing
FROM python:3.10-slim

WORKDIR /app

# Cài các thư viện hệ thống cần thiết
RUN apt-get update && apt-get install -y \
    build-essential \
    libgl1-mesa-glx \
    libglib2.0-0 \
    && rm -rf /var/lib/apt/lists/*

# Copy requirements và cài đặt Python packages
COPY requirements.txt ./
COPY Silent-Face-Anti-Spoofing/requirements.txt ./requirements_antispoof.txt
RUN pip install --upgrade pip \
    && pip install -r requirements.txt \
    && pip install -r requirements_antispoof.txt

# Copy toàn bộ mã nguồn
COPY . .

# Tạo thư mục lưu ảnh khuôn mặt nếu chưa có
RUN mkdir -p static/faces

EXPOSE 5005

CMD ["python", "app.py"] 