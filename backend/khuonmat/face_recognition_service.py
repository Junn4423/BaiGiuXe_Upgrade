#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Face Recognition Microservice
Chạy như backend service, cung cấp API nhận diện khuôn mặt
"""

from flask import Flask, request, jsonify
import cv2
import os
import numpy as np
import base64
from datetime import datetime
import json
import logging
import sys

# Thêm đường dẫn cho anti-spoofing
sys.path.append('Silent-Face-Anti-Spoofing/src')

# Import các module từ hệ thống face recognition
from models.database import db, User, Attendance
from models.face_recognition_module import FaceRecognition
from models.erp_integration import erp_attendance

# Thiết lập logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler("face_recognition_service.log"),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger("face_recognition_service")

# Khởi tạo Flask app
app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///instance/attendance.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['UPLOAD_FOLDER'] = 'static/faces'

# Khởi tạo database
db.init_app(app)

# Khởi tạo face recognition
face_recognizer = FaceRecognition()

# Tạo các thư mục cần thiết nếu chưa tồn tại
os.makedirs(app.config['UPLOAD_FOLDER'], exist_ok=True)

# API Endpoints
@app.route('/api/health', methods=['GET'])
def health_check():
    """Endpoint kiểm tra trạng thái hoạt động của service"""
    return jsonify({"status": "ok", "service": "face_recognition", "timestamp": datetime.now().isoformat()})

@app.route('/api/recognize', methods=['POST'])
def recognize_face():
    """Endpoint nhận diện khuôn mặt từ hình ảnh base64"""
    try:
        # Nhận data JSON từ request
        data = request.json
        
        if not data or 'image' not in data:
            return jsonify({"error": "No image data provided"}), 400
        
        # Decode base64 image
        image_data = data['image'].split(',')[1] if ',' in data['image'] else data['image']
        image_bytes = base64.b64decode(image_data)
        
        # Chuyển đổi bytes thành numpy array
        nparr = np.frombuffer(image_bytes, np.uint8)
        frame = cv2.imdecode(nparr, cv2.IMREAD_COLOR)
        
        if frame is None:
            return jsonify({"error": "Invalid image data"}), 400
        
        # Thực hiện nhận diện khuôn mặt
        face_locations, face_names, face_ids = face_recognizer.recognize_face_from_frame(frame)
        
        # Chuẩn bị kết quả
        results = []
        for i, name in enumerate(face_names):
            result = {
                "name": name,
                "id": face_ids[i] if i < len(face_ids) else None
            }
            
            # Thêm vị trí khuôn mặt nếu có
            if i < len(face_locations):
                top, right, bottom, left = face_locations[i]
                result["location"] = {
                    "top": top,
                    "right": right,
                    "bottom": bottom,
                    "left": left
                }
            
            results.append(result)
        
        # Trả về kết quả
        logger.info(f"Recognized {len(results)} faces")
        return jsonify({"success": True, "faces": results})
    
    except Exception as e:
        logger.error(f"Error in face recognition: {str(e)}", exc_info=True)
        return jsonify({"error": str(e)}), 500

@app.route('/api/register', methods=['POST'])
def register_face():
    """Endpoint đăng ký khuôn mặt mới"""
    try:
        # Nhận data JSON từ request
        data = request.json
        
        if not data or 'image' not in data or 'name' not in data or 'user_id' not in data:
            return jsonify({"error": "Missing required fields (image, name, user_id)"}), 400
        
        # Decode base64 image
        image_data = data['image'].split(',')[1] if ',' in data['image'] else data['image']
        image_bytes = base64.b64decode(image_data)
        
        # Chuyển đổi bytes thành numpy array
        nparr = np.frombuffer(image_bytes, np.uint8)
        frame = cv2.imdecode(nparr, cv2.IMREAD_COLOR)
        
        if frame is None:
            return jsonify({"error": "Invalid image data"}), 400
        
        # Lưu thông tin người dùng
        user = User.query.filter_by(id=data['user_id']).first()
        if not user:
            user = User(id=data['user_id'], name=data['name'])
            db.session.add(user)
            db.session.commit()
        
        # Lưu hình ảnh khuôn mặt
        filename = f"{data['user_id']}_{datetime.now().strftime('%Y%m%d%H%M%S')}.jpg"
        filepath = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        cv2.imwrite(filepath, frame)
        
        # Cập nhật face recognition model
        face_recognizer.add_face(filepath, data['name'], data['user_id'])
        
        logger.info(f"Registered new face for user {data['name']} (ID: {data['user_id']})")
        return jsonify({"success": True, "message": "Face registered successfully"})
    
    except Exception as e:
        logger.error(f"Error in face registration: {str(e)}", exc_info=True)
        return jsonify({"error": str(e)}), 500

# Khởi động server
if __name__ == "__main__":
    # Tạo DB nếu chưa tồn tại
    with app.app_context():
        db.create_all()
        
    # Tải model face recognition
    with app.app_context():
        face_recognizer.load_known_faces()
        
    # Thiết lập IP và port
    host = '127.0.0.1'  # Localhost
    port = 5050  # Port khác với default Flask (5000)
    
    logger.info(f"Starting Face Recognition Service on {host}:{port}")
    app.run(host=host, port=port, debug=False)