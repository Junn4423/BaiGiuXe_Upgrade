import mysql.connector

try:
    conn = mysql.connector.connect(
        host="192.168.1.90",     # IP của máy chạy XAMPP
        user="faceuser",      # user bạn tạo
        password="THU@1982",
        database="erp_sofv4_0"
    )
    
    print("✅ Kết nối MySQL thành công!")
    print(f"📊 Database: {conn.database}")
    print(f"🌐 Host: {conn.server_host}:{conn.server_port}")
    
    # Test query đơn giản
    cursor = conn.cursor()
    cursor.execute("SELECT VERSION()")
    version = cursor.fetchone()
    print(f"🔢 MySQL Version: {version[0]}")
    
    cursor.close()
    conn.close()
    print("🔌 Đã đóng kết nối.")
    
except mysql.connector.Error as err:
    print(f"❌ Lỗi kết nối MySQL: {err}")
except Exception as e:
    print(f"❌ Lỗi khác: {e}")
