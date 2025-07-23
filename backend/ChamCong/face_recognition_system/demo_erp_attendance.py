#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Demo tích hợp ERP - Chấm công vào bảng tc_lv0012
"""

import sys
import os
from datetime import datetime
from flask import Flask

# Thêm thư mục gốc vào sys.path để import modules
sys.path.append(os.path.dirname(os.path.abspath(__file__)))

from app import app
from models.database import db, User
from models.erp_integration import erp_attendance

def demo_attendance_integration():
    """Demo tích hợp chấm công ERP"""
    print("🎯 DEMO TÍCH HỢP CHẤM CÔNG ERP")
    print("=" * 60)
    
    with app.app_context():
        # Lấy danh sách nhân viên
        users = User.query.limit(3).all()
        
        if not users:
            print("❌ Không có nhân viên nào trong hệ thống!")
            print("💡 Hãy đăng ký nhân viên trước khi chạy demo")
            return
        
        print(f"📋 Tìm thấy {len(users)} nhân viên để demo:")
        for user in users:
            print(f"   - {user.employee_id}: {user.name} ({user.department or 'N/A'})")
        
        print(f"\n🕐 THỰC HIỆN CHẤM CÔNG DEMO...")
        print("-" * 40)
        
        success_count = 0
        total_count = len(users)
        
        for user in users:
            print(f"\n👤 Chấm công cho: {user.name} (ID: {user.employee_id})")
            
            # Kiểm tra chấm công gần đây
            has_recent = erp_attendance.check_recent_attendance(user.employee_id, minutes=5)
            if has_recent:
                print(f"   ⏰ Đã chấm công trong 5 phút gần đây - Bỏ qua")
                continue
            
            # Thực hiện chấm công
            current_time = datetime.now()
            success = erp_attendance.create_attendance_record(
                employee_id=user.employee_id,
                attendance_time=current_time
            )
            
            if success:
                print(f"   ✅ Chấm công thành công - {current_time.strftime('%H:%M:%S')}")
                success_count += 1
                
                # Hiển thị lịch sử chấm công gần đây
                history = erp_attendance.get_attendance_history(user.employee_id, days=1)
                if history:
                    latest = history[0]
                    print(f"   📊 Lịch sử: {latest['date']} {latest['time']} - {latest['source']}")
            else:
                print(f"   ❌ Lỗi chấm công")
        
        print(f"\n🏁 KẾT QUẢ DEMO:")
        print(f"   ✅ Chấm công thành công: {success_count}/{total_count}")
        print(f"   📊 Tỷ lệ thành công: {(success_count/total_count*100):.1f}%")
        
        if success_count > 0:
            print(f"\n💾 Dữ liệu đã được ghi vào:")
            print(f"   - Bảng nội bộ: attendance (SQLite)")
            print(f"   - Bảng ERP: tc_lv0012 (MySQL)")
            print(f"   - Cấu trúc: lv001={users[0].employee_id}, lv002=ngày, lv003=giờ, lv004=IN, lv005=Camera, lv099=192.168.1.89")

def check_erp_data():
    """Kiểm tra dữ liệu trong ERP"""
    print(f"\n🔍 KIỂM TRA DỮ LIỆU ERP")
    print("=" * 60)
    
    with app.app_context():
        users = User.query.limit(5).all()
        
        total_records = 0
        for user in users:
            history = erp_attendance.get_attendance_history(user.employee_id, days=7)
            if history:
                print(f"\n👤 {user.name} ({user.employee_id}):")
                for record in history[:3]:  # Hiển thị 3 bản ghi gần nhất
                    print(f"   📅 {record['date']} {record['time']} - {record['source']} (IP: {record['camera_ip']})")
                if len(history) > 3:
                    print(f"   ... và {len(history) - 3} bản ghi khác")
                total_records += len(history)
        
        print(f"\n📊 Tổng cộng: {total_records} bản ghi chấm công trong ERP")

def main():
    """Hàm chính"""
    print("🏢 DEMO HỆ THỐNG CHẤM CÔNG TÍCH HỢP ERP")
    print("=" * 70)
    print("Demo này sẽ:")
    print("- Lấy danh sách nhân viên từ hệ thống")
    print("- Thực hiện chấm công vào bảng ERP tc_lv0012") 
    print("- Hiển thị kết quả và lịch sử")
    print()
    
    # Kiểm tra kết nối ERP trước
    if not erp_attendance.test_connection():
        print("❌ Không thể kết nối ERP! Vui lòng kiểm tra cấu hình.")
        return
    
    # Chạy demo
    demo_attendance_integration()
    
    # Kiểm tra dữ liệu
    check_erp_data()
    
    print(f"\n✨ HOÀN THÀNH DEMO!")
    print("🔗 Hệ thống chấm công đã tích hợp thành công với ERP")
    print("📋 Dữ liệu chấm công sẽ được ghi vào cả SQLite (nội bộ) và MySQL (ERP)")

if __name__ == "__main__":
    main() 