#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script import dữ liệu nhân viên từ ERP System vào Face Recognition System
- Lấy thông tin nhân viên từ: erp_sofv4_0.hr_lv0020
- Lấy ảnh nhân viên từ: erp_sof_documents_v4_0.hr_lv0041
- Import vào hệ thống face recognition
"""

import mysql.connector
import os
import io
from PIL import Image
import tempfile
from datetime import datetime

# Import from our face recognition system
from models.database import db, User
from models.face_recognition_module import FaceRecognition
from app import app

# Import cấu hình
from config_import import (
    ERP_MAIN_CONFIG, ERP_DOCS_CONFIG, 
    EMPLOYEE_TABLE, EMPLOYEE_COLUMNS,
    IMAGE_TABLE, IMAGE_COLUMNS,
    IMPORT_CONFIG
)

class ERPImporter:
    def __init__(self):
        # Database connection configs from config file
        self.erp_main_config = ERP_MAIN_CONFIG
        self.erp_docs_config = ERP_DOCS_CONFIG
        
        self.face_recognizer = FaceRecognition()
        self.imported_count = 0
        self.skipped_count = 0
        self.error_count = 0
        
    def connect_to_erp_main(self):
        """Kết nối đến database chính ERP (erp_sofv4_0)"""
        try:
            conn = mysql.connector.connect(**self.erp_main_config)
            return conn
        except mysql.connector.Error as e:
            print(f"Lỗi kết nối ERP main database: {e}")
            return None
    
    def connect_to_erp_docs(self):
        """Kết nối đến database documents ERP (erp_sof_documents_v4_0)"""
        try:
            conn = mysql.connector.connect(**self.erp_docs_config)
            return conn
        except mysql.connector.Error as e:
            print(f"Lỗi kết nối ERP docs database: {e}")
            return None
    
    def get_employees_from_erp(self):
        """Lấy danh sách nhân viên từ bảng hr_lv0020"""
        conn = self.connect_to_erp_main()
        if not conn:
            return []
        
        try:
            cursor = conn.cursor(dictionary=True)
            query = """
                SELECT 
                    lv001 as employee_id,
                    lv002 as name,
                    lv003 as department,
                    lv004 as position
                FROM hr_lv0020 
                WHERE lv001 IS NOT NULL 
                  AND lv002 IS NOT NULL 
                  AND lv001 != ''
                  AND lv002 != ''
            """
            cursor.execute(query)
            employees = cursor.fetchall()
            print(f"Tìm thấy {len(employees)} nhân viên trong ERP")
            return employees
            
        except mysql.connector.Error as e:
            print(f"Lỗi truy vấn nhân viên: {e}")
            return []
        finally:
            conn.close()
    
    def get_employee_image(self, employee_id):
        """Lấy ảnh nhân viên từ bảng hr_lv0041"""
        conn = self.connect_to_erp_docs()
        if not conn:
            return None
        
        try:
            cursor = conn.cursor()
            query = """
                SELECT lv008 
                FROM hr_lv0041 
                WHERE lv002 = %s 
                  AND lv008 IS NOT NULL
                LIMIT 1
            """
            cursor.execute(query, (employee_id,))
            result = cursor.fetchone()
            
            if result and len(result) > 0 and result[0] is not None:
                blob_data = result[0]
                return blob_data  # BLOB data
            return None
            
        except mysql.connector.Error as e:
            print(f"Lỗi lấy ảnh cho nhân viên {employee_id}: {e}")
            return None
        finally:
            conn.close()
    
    def blob_to_face_encoding(self, blob_data):
        """Chuyển đổi BLOB data thành face encoding"""
        try:
            # Tạo file tạm từ BLOB data
            with tempfile.NamedTemporaryFile(suffix='.jpg', delete=False) as temp_file:
                temp_file.write(blob_data)
                temp_file_path = temp_file.name
            
            try:
                # Mở file tạm như một file upload object
                with open(temp_file_path, 'rb') as image_file:
                    # Sử dụng method encode_face_from_image hiện có
                    face_encoding, error = self.face_recognizer.encode_face_from_image(image_file)
                    return face_encoding, error
            finally:
                # Xóa file tạm
                os.unlink(temp_file_path)
                
        except Exception as e:
            return None, f"Lỗi xử lý ảnh: {str(e)}"
    
    def import_employee(self, employee_data):
        """Import một nhân viên vào hệ thống"""
        employee_id = employee_data['employee_id']
        name = employee_data['name']
        department = employee_data['department'] if 'department' in employee_data else ''
        position = employee_data['position'] if 'position' in employee_data else ''
        
        print(f"Đang import nhân viên: {name} ({employee_id})")
        
        # Kiểm tra nhân viên đã tồn tại chưa
        existing_user = User.query.filter_by(employee_id=employee_id).first()
        if existing_user:
            print(f"  - Nhân viên {employee_id} đã tồn tại, bỏ qua")
            self.skipped_count += 1
            return
        
        # Lấy ảnh từ ERP docs
        image_blob = self.get_employee_image(employee_id)
        if not image_blob:
            print(f"  - Không tìm thấy ảnh cho nhân viên {employee_id}")
            self.error_count += 1
            return
        
        # Chuyển đổi BLOB thành face encoding
        face_encoding, error = self.blob_to_face_encoding(image_blob)
        if error:
            print(f"  - Lỗi xử lý ảnh: {error}")
            self.error_count += 1
            return
        
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
            
            print(f"  - ✅ Import thành công: {name}")
            self.imported_count += 1
            
        except Exception as e:
            print(f"  - ❌ Lỗi lưu database: {str(e)}")
            db.session.rollback()
            self.error_count += 1
    
    def import_all_employees(self):
        """Import tất cả nhân viên từ ERP"""
        print("🚀 Bắt đầu import nhân viên từ ERP...")
        print("=" * 50)
        
        # Lấy danh sách nhân viên
        employees = self.get_employees_from_erp()
        if not employees:
            print("❌ Không tìm thấy nhân viên nào để import!")
            return
        
        # Import từng nhân viên
        for emp in employees:
            try:
                self.import_employee(emp)
            except Exception as e:
                print(f"❌ Lỗi import nhân viên {emp.get('employee_id', 'Unknown')}: {str(e)}")
                self.error_count += 1
        
        # Reload known faces sau khi import
        print("\n🔄 Đang reload known faces...")
        users = User.query.all()
        self.face_recognizer.load_known_faces(users)
        
        # Thống kê kết quả
        print("\n" + "=" * 50)
        print("📊 KẾT QUẢ IMPORT:")
        print(f"✅ Thành công: {self.imported_count}")
        print(f"⏭️  Bỏ qua (đã tồn tại): {self.skipped_count}")
        print(f"❌ Lỗi: {self.error_count}")
        print(f"📋 Tổng: {len(employees)}")
        print("=" * 50)

def main():
    """Hàm chính"""
    print("🏢 ERP to Face Recognition Import Tool")
    print("Công cụ import nhân viên từ ERP vào hệ thống chấm công")
    print()
    
    # Cấu hình database connection
    print("⚙️  Vui lòng kiểm tra cấu hình database trong file import_employees.py:")
    print("   - Host, user, password cho erp_sofv4_0")
    print("   - Host, user, password cho erp_sof_documents_v4_0")
    print()
    
    confirm = input("Tiếp tục import? (y/N): ").strip().lower()
    if confirm != 'y':
        print("Hủy import.")
        return
    
    # Bắt đầu import
    with app.app_context():
        importer = ERPImporter()
        importer.import_all_employees()

if __name__ == "__main__":
    main() 