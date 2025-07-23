#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script xóa dữ liệu trong database face recognition
CẢNH BÁO: Script này sẽ xóa tất cả dữ liệu nhân viên và điểm danh!
"""

import os
from datetime import datetime
from models.database import db, User, Attendance
from app import app

def backup_database():
    """Tạo backup database trước khi xóa"""
    try:
        timestamp = datetime.now().strftime("%Y%m%d_%H%M%S")
        backup_file = f"backup_before_clear_{timestamp}.sql"
        
        # Backup SQLite database
        db_path = "attendance.db"
        if os.path.exists(db_path):
            backup_path = f"backups/{backup_file}"
            os.makedirs("backups", exist_ok=True)
            
            import shutil
            shutil.copy2(db_path, backup_path)
            print(f"✅ Backup tạo thành công: {backup_path}")
            return backup_path
        else:
            print("⚠️ Không tìm thấy file database để backup")
            return None
            
    except Exception as e:
        print(f"❌ Lỗi tạo backup: {str(e)}")
        return None

def clear_attendance_data():
    """Xóa tất cả dữ liệu điểm danh"""
    try:
        count = Attendance.query.count()
        if count > 0:
            Attendance.query.delete()
            db.session.commit()
            print(f"✅ Đã xóa {count} bản ghi điểm danh")
        else:
            print("ℹ️ Không có dữ liệu điểm danh để xóa")
    except Exception as e:
        print(f"❌ Lỗi xóa dữ liệu điểm danh: {str(e)}")
        db.session.rollback()

def clear_user_data():
    """Xóa tất cả dữ liệu nhân viên"""
    try:
        count = User.query.count()
        if count > 0:
            User.query.delete()
            db.session.commit()
            print(f"✅ Đã xóa {count} nhân viên")
        else:
            print("ℹ️ Không có dữ liệu nhân viên để xóa")
    except Exception as e:
        print(f"❌ Lỗi xóa dữ liệu nhân viên: {str(e)}")
        db.session.rollback()

def get_database_stats():
    """Hiển thị thống kê database hiện tại"""
    try:
        user_count = User.query.count()
        attendance_count = Attendance.query.count()
        
        print(f"📊 THỐNG KÊ DATABASE HIỆN TẠI:")
        print(f"   👥 Nhân viên: {user_count}")
        print(f"   📝 Bản ghi điểm danh: {attendance_count}")
        
        if user_count > 0:
            print(f"\n📋 DANH SÁCH NHÂN VIÊN:")
            users = User.query.limit(10).all()
            for user in users:
                print(f"   - {user.employee_id}: {user.name} ({user.department or 'N/A'})")
            if user_count > 10:
                print(f"   ... và {user_count - 10} nhân viên khác")
        
        return user_count, attendance_count
        
    except Exception as e:
        print(f"❌ Lỗi lấy thống kê: {str(e)}")
        return 0, 0

def clear_static_faces():
    """Xóa ảnh trong thư mục static/faces nếu có"""
    try:
        faces_dir = "static/faces"
        if os.path.exists(faces_dir):
            files = os.listdir(faces_dir)
            image_files = [f for f in files if f.lower().endswith(('.jpg', '.jpeg', '.png', '.bmp', '.gif'))]
            
            if image_files:
                for file in image_files:
                    file_path = os.path.join(faces_dir, file)
                    os.remove(file_path)
                print(f"✅ Đã xóa {len(image_files)} file ảnh trong static/faces")
            else:
                print("ℹ️ Không có file ảnh trong static/faces")
        else:
            print("ℹ️ Thư mục static/faces không tồn tại")
            
    except Exception as e:
        print(f"❌ Lỗi xóa ảnh static: {str(e)}")

def reset_database_sequences():
    """Reset auto-increment sequences"""
    try:
        # Đối với SQLite, chúng ta cần reset sqlite_sequence
        from sqlalchemy import text
        db.session.execute(text("DELETE FROM sqlite_sequence WHERE name IN ('users', 'attendance')"))
        db.session.commit()
        print("✅ Đã reset auto-increment sequences")
    except Exception as e:
        print(f"⚠️ Không thể reset sequences: {str(e)}")

def main():
    """Hàm chính"""
    print("🗑️  FACE RECOGNITION DATABASE CLEANER")
    print("Script xóa tất cả dữ liệu trong hệ thống face recognition")
    print("=" * 60)
    
    with app.app_context():
        # Hiển thị thống kê hiện tại
        print("\n1️⃣ KIỂM TRA DỮ LIỆU HIỆN TẠI:")
        user_count, attendance_count = get_database_stats()
        
        if user_count == 0 and attendance_count == 0:
            print("\n✅ Database đã sạch, không cần xóa gì!")
            return
        
        # Xác nhận từ người dùng
        print(f"\n⚠️  CẢNH BÁO: Script này sẽ xóa:")
        print(f"   - {user_count} nhân viên")
        print(f"   - {attendance_count} bản ghi điểm danh")
        print(f"   - Tất cả ảnh trong static/faces")
        print(f"   - Reset auto-increment sequences")
        
        print(f"\n❗ HÀNH ĐỘNG NÀY KHÔNG THỂ HOÀN TÁC!")
        
        confirm1 = input(f"\nBạn có chắc chắn muốn xóa tất cả dữ liệu? (yes/no): ").strip().lower()
        if confirm1 != 'yes':
            print("Hủy bỏ thao tác xóa.")
            return
        
        confirm2 = input(f"Nhập 'DELETE' để xác nhận: ").strip()
        if confirm2 != 'DELETE':
            print("Hủy bỏ thao tác xóa.")
            return
        
        # Tạo backup
        print(f"\n2️⃣ TẠO BACKUP:")
        backup_path = backup_database()
        
        # Bắt đầu xóa dữ liệu
        print(f"\n3️⃣ BẮT ĐẦU XÓA DỮ LIỆU:")
        
        # Xóa dữ liệu điểm danh trước (vì có foreign key)
        clear_attendance_data()
        
        # Xóa dữ liệu nhân viên
        clear_user_data()
        
        # Xóa ảnh static
        clear_static_faces()
        
        # Reset sequences
        reset_database_sequences()
        
        print(f"\n4️⃣ KIỂM TRA KẾT QUẢ:")
        get_database_stats()
        
        print(f"\n" + "=" * 60)
        print(f"✅ HOÀN TẤT XÓA DỮ LIỆU!")
        if backup_path:
            print(f"💾 Backup lưu tại: {backup_path}")
        print(f"🚀 Database đã sẵn sàng cho import mới!")
        print(f"💡 Chạy: python import_employees.py để import từ ERP")

if __name__ == "__main__":
    main() 