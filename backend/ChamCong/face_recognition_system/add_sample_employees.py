#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script thêm nhân viên mẫu vào hệ thống Face Recognition
Sử dụng khi không có ERP System hoặc cần test dữ liệu
"""

import os
import numpy as np
from datetime import datetime
from PIL import Image, ImageDraw, ImageFont
import tempfile

# Import from our face recognition system
from models.database import db, User
from models.face_recognition_module import FaceRecognition
from app import app

class SampleEmployeeCreator:
    def __init__(self):
        self.face_recognizer = FaceRecognition()
        self.imported_count = 0
        self.error_count = 0
        
    def create_sample_image(self, name, employee_id):
        """Tạo ảnh mẫu với text để có face encoding"""
        # Tạo ảnh 300x300 với background trắng
        img = Image.new('RGB', (300, 300), color=(255, 255, 255))
        draw = ImageDraw.Draw(img)
        
        # Vẽ hình chữ nhật làm khuôn mặt
        face_box = [(75, 75), (225, 225)]
        draw.rectangle(face_box, fill='lightblue', outline='blue', width=3)
        
        # Vẽ mắt
        draw.ellipse([(110, 120), (130, 140)], fill='black')  # Mắt trái
        draw.ellipse([(170, 120), (190, 140)], fill='black')  # Mắt phải
        
        # Vẽ mũi
        draw.polygon([(145, 150), (155, 150), (150, 170)], fill='pink')
        
        # Vẽ miệng
        draw.arc([(130, 175), (170, 195)], start=0, end=180, fill='red', width=3)
        
        # Viết tên và ID
        try:
            # Thử dùng font mặc định
            font = ImageFont.load_default()
        except:
            font = None
            
        draw.text((150, 250), name, fill='black', anchor='mm', font=font)
        draw.text((150, 270), f"ID: {employee_id}", fill='gray', anchor='mm', font=font)
        
        return img
    
    def image_to_face_encoding(self, image):
        """Chuyển đổi PIL Image thành face encoding"""
        try:
            # Lưu ảnh tạm
            with tempfile.NamedTemporaryFile(suffix='.jpg', delete=False) as temp_file:
                image.save(temp_file.name, 'JPEG')
                temp_file_path = temp_file.name
            
            try:
                # Sử dụng method encode_face_from_image hiện có
                with open(temp_file_path, 'rb') as image_file:
                    face_encoding, error = self.face_recognizer.encode_face_from_image(image_file)
                    return face_encoding, error
            finally:
                # Xóa file tạm
                os.unlink(temp_file_path)
                
        except Exception as e:
            return None, f"Lỗi xử lý ảnh: {str(e)}"
    
    def add_sample_employee(self, name, employee_id, department, position):
        """Thêm một nhân viên mẫu"""
        print(f"Đang thêm nhân viên: {name} ({employee_id})")
        
        # Kiểm tra nhân viên đã tồn tại chưa
        existing_user = User.query.filter_by(employee_id=employee_id).first()
        if existing_user:
            print(f"  - Nhân viên {employee_id} đã tồn tại, bỏ qua")
            return
        
        # Tạo ảnh mẫu
        sample_image = self.create_sample_image(name, employee_id)
        
        # Chuyển đổi thành face encoding
        face_encoding, error = self.image_to_face_encoding(sample_image)
        if error:
            print(f"  - Lỗi tạo face encoding: {error}")
            # Tạo encoding giả để test
            face_encoding = np.random.random(128)
            print(f"  - Sử dụng encoding ngẫu nhiên để test")
        
        # Lưu ảnh vào static/faces (tùy chọn)
        try:
            faces_dir = "static/faces"
            os.makedirs(faces_dir, exist_ok=True)
            image_path = os.path.join(faces_dir, f"{employee_id}.jpg")
            sample_image.save(image_path, 'JPEG')
            print(f"  - Đã lưu ảnh: {image_path}")
        except Exception as e:
            print(f"  - Lỗi lưu ảnh: {str(e)}")
        
        # Tạo user mới
        try:
            new_user = User(
                name=name,
                employee_id=employee_id,
                department=department,
                position=position,
                face_encoding=face_encoding
            )
            
            db.session.add(new_user)
            db.session.commit()
            
            print(f"  - ✅ Thêm thành công: {name}")
            self.imported_count += 1
            
        except Exception as e:
            print(f"  - ❌ Lỗi lưu database: {str(e)}")
            db.session.rollback()
            self.error_count += 1
    
    def add_all_sample_employees(self):
        """Thêm tất cả nhân viên mẫu"""
        print("🚀 Bắt đầu thêm nhân viên mẫu...")
        print("=" * 50)
        
        # Danh sách nhân viên mẫu
        sample_employees = [
            {
                'name': 'Nguyen Van An',
                'employee_id': 'NV001',
                'department': 'Engineering',
                'position': 'Software Developer'
            },
            {
                'name': 'Tran Thi Binh',
                'employee_id': 'NV002', 
                'department': 'Engineering',
                'position': 'Tester'
            },
            {
                'name': 'Le Hoang Cuong',
                'employee_id': 'NV003',
                'department': 'Sales',
                'position': 'Sale Manager'
            },
            {
                'name': 'Pham Thi Dung',
                'employee_id': 'NV004',
                'department': 'HR',
                'position': 'HR Specialist'
            },
            {
                'name': 'Hoang Van Em',
                'employee_id': 'NV005',
                'department': 'Engineering',
                'position': 'DevOps Engineer'
            },
            {
                'name': 'Ngo Thi Phuong',
                'employee_id': 'NV006',
                'department': 'Marketing',
                'position': 'Content Creator'
            },
            {
                'name': 'Dang Van Giang',
                'employee_id': 'NV007',
                'department': 'Engineering',
                'position': 'Senior Developer'
            },
            {
                'name': 'Vo Thi Ha',
                'employee_id': 'NV008',
                'department': 'Accounting',
                'position': 'Accountant'
            }
        ]
        
        # Thêm từng nhân viên
        for emp in sample_employees:
            try:
                self.add_sample_employee(
                    emp['name'], 
                    emp['employee_id'], 
                    emp['department'], 
                    emp['position']
                )
            except Exception as e:
                print(f"❌ Lỗi thêm nhân viên {emp['employee_id']}: {str(e)}")
                self.error_count += 1
        
        # Reload known faces sau khi thêm
        print("\n🔄 Đang reload known faces...")
        users = User.query.all()
        self.face_recognizer.load_known_faces(users)
        
        # Thống kê kết quả
        print("\n" + "=" * 50)
        print("📊 KẾT QUẢ THÊM NHÂN VIÊN MẪU:")
        print(f"✅ Thành công: {self.imported_count}")
        print(f"❌ Lỗi: {self.error_count}")
        print(f"📋 Tổng: {len(sample_employees)}")
        print("=" * 50)

def main():
    """Hàm chính"""
    print("👥 SAMPLE EMPLOYEES CREATOR")
    print("Công cụ thêm nhân viên mẫu cho hệ thống chấm công")
    print()
    
    confirm = input("Tiếp tục thêm nhân viên mẫu? (y/N): ").strip().lower()
    if confirm != 'y':
        print("Hủy thêm nhân viên.")
        return
    
    # Bắt đầu thêm
    with app.app_context():
        creator = SampleEmployeeCreator()
        creator.add_all_sample_employees()

if __name__ == "__main__":
    main() 