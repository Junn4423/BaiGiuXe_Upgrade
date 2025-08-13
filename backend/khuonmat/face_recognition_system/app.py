from flask import Flask, render_template, request, jsonify, Response, session, abort
import cv2
import os
from datetime import datetime, date, timedelta
import threading
import time
from werkzeug.utils import secure_filename
from functools import wraps
import json
import mysql.connector
from config_import import ERP_MAIN_CONFIG, ERP_DOCS_CONFIG, EMPLOYEE_TABLE, EMPLOYEE_COLUMNS, IMAGE_TABLE, IMAGE_COLUMNS
import base64

from models.database import db, User, Attendance
from models.face_recognition_module import FaceRecognition
from models.erp_integration import erp_attendance
import sys
sys.path.append('Silent-Face-Anti-Spoofing/src')
# Thêm CORS
from flask_cors import CORS
import numpy as np
try:
    import face_recognition
    FACE_RECOGNITION_AVAILABLE = True
except ImportError:
    print("WARNING: face_recognition module not available. Face recognition features will be disabled.")
    FACE_RECOGNITION_AVAILABLE = False
    # Mock face_recognition module
    class MockFaceRecognition:
        @staticmethod
        def face_encodings(*args, **kwargs):
            return []
        @staticmethod
        def face_locations(*args, **kwargs):
            return []
        @staticmethod
        def compare_faces(*args, **kwargs):
            return []
        @staticmethod
        def face_distance(*args, **kwargs):
            return []
        @staticmethod
        def load_image_file(*args, **kwargs):
            return None
    face_recognition = MockFaceRecognition()
from PIL import Image as PILImage
import io

app = Flask(__name__)
CORS(app)  # Cho phép tất cả origin, có thể cấu hình chi tiết hơn nếu muốn
app.config['SECRET_KEY'] = 'your-secret-key-here'
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///attendance.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['UPLOAD_FOLDER'] = 'static/faces'

# Initialize database
db.init_app(app)

# Initialize face recognition
face_recognizer = FaceRecognition()

# Global variables for camera
camera = None
camera_thread = None
is_camera_running = False

# Create upload folder if not exists
os.makedirs(app.config['UPLOAD_FOLDER'], exist_ok=True)

ADMIN_PASSWORD = os.environ.get('ADMIN_PASSWORD', 'admin123')

# Lưu whitelist IP vào file để quản lý động
IP_WHITELIST_FILE = 'ip_whitelist.json'

def load_ip_whitelist():
    try:
        with open(IP_WHITELIST_FILE, 'r') as f:
            return json.load(f)
    except Exception:
        return ['127.0.0.1', '::1']

def save_ip_whitelist(ips):
    with open(IP_WHITELIST_FILE, 'w') as f:
        json.dump(ips, f)

# --- BỎ KIỂM TRA IP WHITELIST ---
# @app.before_request
# def restrict_ip():
#     if request.endpoint and request.endpoint.startswith('static'):
#         return  # Cho phép truy cập static
#     if request.path.startswith('/api/ip_whitelist') or request.path.startswith('/api/admin_login') or request.path.startswith('/api/admin_logout'):
#         return  # Cho phép admin login/logout và quản lý IP
#     allowed_ips = load_ip_whitelist()
#     if request.remote_addr not in allowed_ips:
#         return jsonify({'success': False, 'message': 'IP not allowed'}), 403

def init_db():
    """Initialize database tables"""
    with app.app_context():
        db.create_all()

def load_known_faces():
    """Load all known faces from database"""
    users = User.query.all()
    face_recognizer.load_known_faces(users)

def perform_auto_attendance(user_id):
    """Automatically perform attendance check for a user"""
    try:
        today = date.today()
        current_time = datetime.now()
        
        # Lấy thông tin nhân viên để có mã nhân viên cho ERP
        user = User.query.get(user_id)
        if not user:
            print(f"Không tìm thấy user với ID: {user_id}")
            return
        
        # Tìm bản ghi điểm danh gần nhất trong ngày
        last_attendance = Attendance.query.filter_by(user_id=user_id, date=today).order_by(Attendance.check_in_time.desc()).first()
        if last_attendance:
            last_time = last_attendance.check_in_time
            if (current_time - last_time).total_seconds() < 600:
                return  # Chưa đủ 10 phút, không tạo bản ghi mới
        
        # Kiểm tra ERP có chấm công gần đây không (tránh trùng lặp)
        if erp_attendance.check_recent_attendance(user.employee_id, minutes=10):
            print(f"Nhân viên {user.employee_id} đã chấm công ERP trong 10 phút gần đây")
            return
        
        status = 'present'
        if current_time.hour > 8 or (current_time.hour == 8 and current_time.minute > 30):
            status = 'late'
        
        # 1. Ghi vào database nội bộ (SQLite)
        new_attendance = Attendance(
            user_id=user_id,
            check_in_time=current_time,
            date=today,
            status=status
        )
        db.session.add(new_attendance)
        db.session.commit()
        
        # 2. Ghi vào database ERP (MySQL tc_lv0012)
        erp_success = erp_attendance.create_attendance_record(
            employee_id=user.employee_id,
            attendance_time=current_time
        )
        
        if erp_success:
            print(f"Chấm công thành công cho {user.name} ({user.employee_id}) - Cả nội bộ và ERP")
        else:
            print(f"Chấm công nội bộ thành công cho {user.name}, nhưng lỗi ghi ERP")
            
    except Exception as e:
        print(f"Error in auto attendance: {str(e)}")

class Camera:
    def __init__(self):
        self.rtsp_url = "rtsp://admin:VLRLXT@192.168.1.89/h264/ch1/main/av_stream"
        self.video = cv2.VideoCapture(self.rtsp_url)
        self.is_running = self.video.isOpened()
        self.lock = threading.Lock()
        self.frame = None
        
        if self.is_running:
            self.thread = threading.Thread(target=self._reader, daemon=True)
            self.thread.start()

    def _reader(self):
        """Read frames from camera in a thread"""
        while self.is_running:
            ret, frame = self.video.read()
            if not ret:
                print("Lỗi đọc khung hình, ngắt luồng đọc.")
                self.is_running = False
                break
            with self.lock:
                self.frame = frame
        self.video.release()

    def get_frame(self):
        """Get the latest frame from the thread"""
        with self.lock:
            if self.frame is None:
                return None
            return self.frame.copy()

    def is_opened(self):
        return self.is_running
        
    def stop(self):
        self.is_running = False
        if hasattr(self, 'thread'):
            self.thread.join() # Wait for the thread to finish

def generate_frames():
    """Generate frames for video streaming with optimized face recognition"""
    global camera
    
    last_attendance_check = {}
    frame_count = 0
    # Store last known locations and names to draw on every frame
    last_face_locations = []
    last_face_names = []
    
    # FPS calculation
    fps = 0
    fps_frame_count = 0
    start_time = time.time()
    
    while True:
        if camera is None or not camera.is_opened():
            break
            
        frame = camera.get_frame()
        if frame is None:
            time.sleep(0.1) # Wait if no frame is available
            continue

        frame_count += 1
        
        # Chỉ nhận diện khuôn mặt mỗi 8 khung hình để giảm tải CPU
        if frame_count % 8 == 0:
            # We run the heavy recognition task
            face_locations, face_names, face_ids = face_recognizer.recognize_face_from_frame(frame)
            last_face_locations = face_locations
            last_face_names = face_names
            
            # Tự động điểm danh
            current_time = time.time()
            for user_id, user_name in zip(face_ids, face_names):
                if user_id and user_name != "Unknown":
                    if user_id not in last_attendance_check or current_time - last_attendance_check[user_id] > 600:
                        with app.app_context():
                            perform_auto_attendance(user_id)
                        last_attendance_check[user_id] = current_time
            
        # Vẽ lên frame (luôn luôn vẽ, sử dụng kết quả nhận diện cuối cùng)
        frame = face_recognizer.draw_faces_on_frame(frame, last_face_locations, last_face_names)

        # Tính toán và hiển thị FPS
        fps_frame_count += 1
        elapsed_time = time.time() - start_time
        if elapsed_time > 1:
            fps = fps_frame_count / elapsed_time
            start_time = time.time()
            fps_frame_count = 0
            
        cv2.putText(frame, f"FPS: {fps:.2f}", (10, 30), cv2.FONT_HERSHEY_SIMPLEX, 1, (255, 255, 255), 2, cv2.LINE_AA)
        
        # Encode frame để gửi đi
        ret, buffer = cv2.imencode('.jpg', frame, [int(cv2.IMWRITE_JPEG_QUALITY), 80])
        frame_bytes = buffer.tobytes()
        
        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame_bytes + b'\r\n')

@app.route('/')
def index():
    """Trang chủ"""
    return render_template('index.html')

@app.route('/register')
def register():
    """Trang đăng ký người dùng mới"""
    return render_template('register.html')

@app.route('/attendance')
def attendance():
    """Trang điểm danh"""
    global is_camera_running, camera
    status = is_camera_running and camera is not None and camera.is_opened()
    return render_template('attendance.html', camera_status=status, now_timestamp=time.time())

@app.route('/report')
def report():
    """Trang báo cáo điểm danh"""
    date_str = request.args.get('date', date.today().strftime('%Y-%m-%d'))
    try:
        report_date = datetime.strptime(date_str, '%Y-%m-%d').date()
    except ValueError:
        report_date = date.today()
        
    attendances = Attendance.query.filter_by(date=report_date).all()
    return render_template('report.html', attendances=attendances, date=report_date)

@app.route('/video_feed')
def video_feed():
    """Video streaming route"""
    return Response(generate_frames(),
                    mimetype='multipart/x-mixed-replace; boundary=frame')

@app.route('/api/register', methods=['POST'])
def api_register():
    """API đăng ký người dùng mới"""
    try:
        # Get form data
        name = request.form.get('name')
        employee_id = request.form.get('employee_id')
        department = request.form.get('department')
        position = request.form.get('position')
        # Check if user exists
        existing_user = User.query.filter_by(employee_id=employee_id).first()
        if existing_user:
            return jsonify({'success': False, 'message': 'Mã nhân viên đã tồn tại'})
        
        # Get uploaded image
        if 'image' not in request.files:
            return jsonify({'success': False, 'message': 'Không tìm thấy ảnh'})
        
        image = request.files['image']
        
        # Encode face
        face_encoding, error = face_recognizer.encode_face_from_image(image)
        
        if error:
            return jsonify({'success': False, 'message': error})
        
        # Save to database
        new_user = User(
            name=name,
            employee_id=employee_id,
            department=department,
            position=position,
            face_encoding=face_encoding
        )
        
        db.session.add(new_user)
        db.session.commit()
        
        # Reload known faces
        load_known_faces()
        
        return jsonify({'success': True, 'message': 'Đăng ký thành công'})
        
    except Exception as e:
        return jsonify({'success': False, 'message': str(e)})

@app.route('/api/register_base64', methods=['POST'])
def api_register_base64():
    """API đăng ký người dùng mới với ảnh base64"""
    try:
        data = request.get_json()
        
        if not data:
            return jsonify({'success': False, 'message': 'Không có dữ liệu JSON'})
        
        # Get form data
        name = data.get('name') if data else None
        employee_id = data.get('employee_id') if data else None
        department = data.get('department') if data else None
        position = data.get('position') if data else None
        image_base64 = data.get('image_base64') if data else None
        
        # Validate required fields
        if not all([name, employee_id, image_base64]):
            return jsonify({'success': False, 'message': 'Vui lòng nhập đủ thông tin bắt buộc'})
        
        # Check if user exists
        existing_user = User.query.filter_by(employee_id=employee_id).first()
        if existing_user:
            return jsonify({'success': False, 'message': 'Mã nhân viên đã tồn tại'})
        
        # Encode face from base64
        face_encoding, error = face_recognizer.encode_face_from_base64(image_base64)
        
        if error:
            return jsonify({'success': False, 'message': error})
        
        # Save to database
        new_user = User(
            name=name,
            employee_id=employee_id,
            department=department,
            position=position,
            face_encoding=face_encoding
        )
        
        db.session.add(new_user)
        db.session.commit()
        
        # Reload known faces
        load_known_faces()
        
        return jsonify({'success': True, 'message': 'Đăng ký thành công'})
        
    except Exception as e:
        return jsonify({'success': False, 'message': str(e)})

@app.route('/api/start_camera', methods=['POST'])
def start_camera():
    """Start camera for attendance"""
    global camera, is_camera_running

    # Nếu đã có camera nhưng không còn mở, dọn dẹp và reset trạng thái
    if camera and not camera.is_opened():
        camera.stop()
        camera = None
        is_camera_running = False

    if is_camera_running and camera and camera.is_opened():
        return jsonify({'success': True})  # Camera đã chạy, không tạo mới

    # Clean up previous camera instance if it exists (phòng trường hợp chưa reset ở trên)
    if camera:
        camera.stop()
        camera = None

    camera = Camera()

    if camera.is_opened():
        is_camera_running = True
        # Give the camera some time to start grabbing frames
        time.sleep(2.0)
        return jsonify({'success': True})
    else:
        camera = None
        is_camera_running = False
        return jsonify({'success': False, 'message': 'Không thể kết nối đến camera. Vui lòng kiểm tra lại URL RTSP hoặc kết nối mạng.'})

@app.route('/api/stop_camera', methods=['POST'])
def stop_camera():
    """Stop camera"""
    global camera, is_camera_running
    
    if camera:
        camera.stop()
        camera = None
    
    is_camera_running = False
    return jsonify({'success': True, 'message': 'Đã tắt camera.'})

@app.route('/api/check_attendance', methods=['POST'])
def check_attendance():
    try:
        user_id = request.json.get('user_id')
        if not user_id:
            return jsonify({'success': False, 'message': 'Không tìm thấy user_id'})
        
        # Lấy thông tin nhân viên
        user = User.query.get(user_id)
        if not user:
            return jsonify({'success': False, 'message': 'Không tìm thấy nhân viên'})
        
        today = date.today()
        current_time = datetime.now()
        
        # Tìm bản ghi điểm danh gần nhất của user (trong ngày)
        last_attendance = Attendance.query.filter_by(user_id=user_id, date=today).order_by(Attendance.check_in_time.desc()).first()
        if last_attendance:
            # Lấy thời điểm cuối cùng user quét (giờ vào hoặc ra, ưu tiên giờ ra nếu có)
            last_time = last_attendance.check_out_time or last_attendance.check_in_time
            if (current_time - last_time).total_seconds() < 600:
                return jsonify({'success': False, 'message': 'Bạn chỉ được điểm danh 1 lần mỗi 10 phút. Vui lòng thử lại sau.'})
        
        # Kiểm tra ERP có chấm công gần đây không
        if erp_attendance.check_recent_attendance(user.employee_id, minutes=10):
            return jsonify({'success': False, 'message': 'Đã chấm công trong ERP gần đây, vui lòng thử lại sau.'})
        
        status = 'present'
        if current_time.hour > 8 or (current_time.hour == 8 and current_time.minute > 30):
            status = 'late'
        
        # 1. Ghi vào database nội bộ (SQLite)
        new_attendance = Attendance(
            user_id=user_id,
            check_in_time=current_time,
            date=today,
            status=status
        )
        db.session.add(new_attendance)
        db.session.commit()
        
        # 2. Ghi vào database ERP (MySQL tc_lv0012)
        erp_success = erp_attendance.create_attendance_record(
            employee_id=user.employee_id,
            attendance_time=current_time
        )
        
        if erp_success:
            return jsonify({'success': True, 'message': f'Điểm danh thành công cho {user.name} - Đã ghi vào cả hệ thống nội bộ và ERP'})
        else:
            return jsonify({'success': True, 'message': f'Điểm danh nội bộ thành công cho {user.name}, nhưng có lỗi ghi ERP'})
            
    except Exception as e:
        return jsonify({'success': False, 'message': str(e)})

@app.route('/api/get_attendance_stats', methods=['GET'])
def get_attendance_stats():
    """Get attendance statistics"""
    try:
        today = date.today()
        
        # Total employees
        total_employees = User.query.count()
        
        # Present today
        present_today = Attendance.query.filter_by(date=today).count()
        
        # Late today
        late_today = Attendance.query.filter_by(date=today, status='late').count()
        
        # On time today
        on_time_today = Attendance.query.filter_by(date=today, status='present').count()
        
        return jsonify({
            'success': True,
            'data': {
                'total_employees': total_employees,
                'present_today': present_today,
                'late_today': late_today,
                'on_time_today': on_time_today,
                'absent_today': total_employees - present_today
            }
        })
        
    except Exception as e:
        return jsonify({'success': False, 'message': str(e)})

@app.route('/api/get_recent_activity', methods=['GET'])
def get_recent_activity():
    """Trả về 10 hoạt động điểm danh gần nhất"""
    try:
        records = (
            db.session.query(Attendance, User)
            .join(User, Attendance.user_id == User.id)
            .order_by(Attendance.check_in_time.desc())
            .limit(10)
            .all()
        )
        activities = []
        for att, user in records:
            activities.append({
                'name': user.name,
                'department': user.department,
                'time': att.check_in_time.strftime('%H:%M:%S %d/%m/%Y') if att.check_in_time else '',
                'status': 'Điểm danh'  # Luôn trả về 'Điểm danh'
            })
        return jsonify({'success': True, 'activities': activities})
    except Exception as e:
        return jsonify({'success': False, 'message': str(e), 'activities': []})

@app.route('/api/employees', methods=['GET'])
def get_employees():
    """Get list of employees"""
    try:
        users = User.query.all()
        employees = [
            {
                'id': u.id,
                'name': u.name,
                'employee_id': u.employee_id,
                'department': u.department,
                'position': u.position,
                'created_at': u.created_at.strftime('%Y-%m-%d %H:%M:%S') if u.created_at else ''
            }
            for u in users
        ]
        return jsonify({'success': True, 'employees': employees})
    except Exception as e:
        return jsonify({'success': False, 'message': str(e), 'employees': []})

@app.route('/api/erp_employee_info', methods=['GET'])
def get_erp_employee_info():
    """API lấy thông tin và ảnh nhân viên từ ERP theo mã nhân viên"""
    employee_id = request.args.get('employee_id')
    if not employee_id:
        return jsonify({'success': False, 'message': 'Thiếu mã nhân viên'}), 400
    # Lấy thông tin nhân viên
    try:
        conn = mysql.connector.connect(**ERP_MAIN_CONFIG)
        cursor = conn.cursor(dictionary=True)
        query = f"""
            SELECT {EMPLOYEE_COLUMNS['employee_id']} as employee_id,
                   {EMPLOYEE_COLUMNS['name']} as name,
                   {EMPLOYEE_COLUMNS['department']} as department,
                   {EMPLOYEE_COLUMNS['position']} as position
            FROM {EMPLOYEE_TABLE}
            WHERE {EMPLOYEE_COLUMNS['employee_id']} = %s
            LIMIT 1
        """
        cursor.execute(query, (employee_id,))
        emp = cursor.fetchone()
        cursor.close()
        conn.close()
        if not emp:
            return jsonify({'success': False, 'message': 'Không tìm thấy nhân viên'}), 404
        if not isinstance(emp, dict):
            return jsonify({'success': False, 'message': 'Lỗi dữ liệu trả về từ ERP'}), 500
        # emp có thể là dict (cursor dictionary=True) hoặc tuple (nếu lỗi), chỉ set key nếu là dict
        emp['image_base64'] = None
    except Exception as e:
        return jsonify({'success': False, 'message': f'Lỗi truy vấn thông tin: {str(e)}'}), 500
    # Lấy ảnh nhân viên
    try:
        conn = mysql.connector.connect(**ERP_DOCS_CONFIG)
        cursor = conn.cursor()
        query = f"""
            SELECT {IMAGE_COLUMNS['image_blob']} 
            FROM {IMAGE_TABLE} 
            WHERE {IMAGE_COLUMNS['employee_id']} = %s AND {IMAGE_COLUMNS['image_blob']} IS NOT NULL
            LIMIT 1
        """
        cursor.execute(query, (employee_id,))
        result = cursor.fetchone()
        cursor.close()
        conn.close()
        if result and len(result) > 0:
            image_blob = result[0]  # Truy cập tuple bằng chỉ số
            if isinstance(image_blob, (bytes, bytearray)):
                image_base64 = base64.b64encode(image_blob).decode('utf-8')
                emp['image_base64'] = f"data:image/jpeg;base64,{image_base64}"
            else:
                emp['image_base64'] = None
        else:
            emp['image_base64'] = None
    except Exception as e:
        emp['image_base64'] = None
    return jsonify({'success': True, 'employee': emp})

@app.route('/api/register_from_erp', methods=['POST'])
def register_from_erp():
    """API đăng ký nhân viên mới từ ERP chỉ với mã nhân viên"""
    employee_id = request.args.get('employee_id') or (request.json.get('employee_id') if request.is_json else None)
    if not employee_id:
        return jsonify({'success': False, 'message': 'Thiếu mã nhân viên'}), 400
    # Kiểm tra đã tồn tại trong hệ thống chưa
    existing_user = User.query.filter_by(employee_id=employee_id).first()
    if existing_user:
        return jsonify({'success': False, 'message': 'Nhân viên đã tồn tại trong hệ thống'}), 409
    # Lấy thông tin từ ERP
    try:
        conn = mysql.connector.connect(**ERP_MAIN_CONFIG)
        cursor = conn.cursor(dictionary=True)
        query = f"""
            SELECT {EMPLOYEE_COLUMNS['employee_id']} as employee_id,
                   {EMPLOYEE_COLUMNS['name']} as name,
                   {EMPLOYEE_COLUMNS['department']} as department,
                   {EMPLOYEE_COLUMNS['position']} as position
            FROM {EMPLOYEE_TABLE}
            WHERE {EMPLOYEE_COLUMNS['employee_id']} = %s
            LIMIT 1
        """
        cursor.execute(query, (employee_id,))
        emp = cursor.fetchone()
        cursor.close()
        conn.close()
        if not emp or not isinstance(emp, dict):
            return jsonify({'success': False, 'message': 'Không tìm thấy nhân viên trong ERP'}), 404
    except Exception as e:
        return jsonify({'success': False, 'message': f'Lỗi truy vấn thông tin ERP: {str(e)}'}), 500
    # Lấy ảnh từ ERP
    try:
        conn = mysql.connector.connect(**ERP_DOCS_CONFIG)
        cursor = conn.cursor()
        query = f"""
            SELECT {IMAGE_COLUMNS['image_blob']} 
            FROM {IMAGE_TABLE} 
            WHERE {IMAGE_COLUMNS['employee_id']} = %s AND {IMAGE_COLUMNS['image_blob']} IS NOT NULL
            LIMIT 1
        """
        cursor.execute(query, (employee_id,))
        result = cursor.fetchone()
        cursor.close()
        conn.close()
        if not result or len(result) == 0 or not isinstance(result[0], (bytes, bytearray)):
            return jsonify({'success': False, 'message': 'Không tìm thấy ảnh nhân viên trong ERP'}), 404
        image_blob = result[0]
    except Exception as e:
        return jsonify({'success': False, 'message': f'Lỗi truy vấn ảnh ERP: {str(e)}'}), 500
    # Encode face từ ảnh ERP
    import io
    image_file = io.BytesIO(image_blob)
    face_encoding, error = face_recognizer.encode_face_from_image(image_file)
    if error:
        return jsonify({'success': False, 'message': f'Lỗi nhận diện khuôn mặt: {error}'}), 400
    # Đăng ký vào hệ thống
    try:
        new_user = User(
            name=emp.get('name'),
            employee_id=emp.get('employee_id'),
            department=emp.get('department'),
            position=emp.get('position'),
            face_encoding=face_encoding
        )
        db.session.add(new_user)
        db.session.commit()
        load_known_faces()
        return jsonify({'success': True, 'message': 'Đăng ký thành công', 'employee': {
            'employee_id': emp.get('employee_id'),
            'name': emp.get('name'),
            'department': emp.get('department'),
            'position': emp.get('position')
        }})
    except Exception as e:
        db.session.rollback()
        return jsonify({'success': False, 'message': f'Lỗi lưu vào hệ thống: {str(e)}'}), 500

@app.route('/api/attendance_image', methods=['POST'])
def attendance_image():
    """API điểm danh bằng cách gửi ảnh (file hoặc base64)"""
    try:
        # Ưu tiên nhận file ảnh (form-data), nếu không có thì nhận base64 (JSON)
        if 'image' in request.files:
            image_file = request.files['image']
            # Encode khuôn mặt từ file ảnh
            face_encoding, error = face_recognizer.encode_face_from_image(image_file)
        else:
            data = request.get_json()
            if not data or 'image_base64' not in data:
                return jsonify({'success': False, 'message': 'Thiếu ảnh (file hoặc base64)'}), 400
            image_base64 = data['image_base64']
            face_encoding, error = face_recognizer.encode_face_from_base64(image_base64)
        if error:
            return jsonify({'success': False, 'message': error}), 400
        # So sánh với known faces
        matches = face_recognition.compare_faces(face_recognizer.known_face_encodings, face_encoding, tolerance=0.4)
        face_distances = face_recognition.face_distance(face_recognizer.known_face_encodings, face_encoding)
        if len(face_distances) == 0 or not any(matches):
            return jsonify({'success': False, 'message': 'Không nhận diện được nhân viên phù hợp'}), 404
        best_match_index = int(np.argmin(face_distances))
        if not matches[best_match_index]:
            return jsonify({'success': False, 'message': 'Không nhận diện được nhân viên phù hợp'}), 404
        user_id = face_recognizer.known_face_ids[best_match_index]
        user = User.query.get(user_id)
        if not user:
            return jsonify({'success': False, 'message': 'Không tìm thấy nhân viên'}), 404
        # Chống giả mạo (anti-spoofing)
        # Nếu gửi file thì đọc lại thành numpy array, nếu base64 thì đã có array
        if 'image' in request.files:
            image_file.stream.seek(0)
            image = face_recognition.load_image_file(image_file)
        else:
            # Đã decode ở encode_face_from_base64, nhưng cần lại array cho anti-spoof
            image_bytes = base64.b64decode(image_base64.split(',')[1] if ',' in image_base64 else image_base64)
            pil_img = PILImage.open(io.BytesIO(image_bytes))
            image = np.array(pil_img)
        # Lấy bbox khuôn mặt
        face_locations = face_recognition.face_locations(image)
        if len(face_locations) == 0:
            return jsonify({'success': False, 'message': 'Không tìm thấy khuôn mặt trong ảnh'}), 400
        top, right, bottom, left = face_locations[0]
        bbox = [left, top, right-left, bottom-top]
        is_real, spoof_score = face_recognizer.anti_spoofing.is_real_face(image, bbox)
        if not is_real:
            return jsonify({'success': False, 'message': 'Phát hiện khuôn mặt giả mạo!'}), 400
        # Kiểm tra 10 phút như logic check_attendance
        today = date.today()
        current_time = datetime.now()
        last_attendance = Attendance.query.filter_by(user_id=user_id, date=today).order_by(Attendance.check_in_time.desc()).first()
        if last_attendance:
            last_time = last_attendance.check_out_time or last_attendance.check_in_time
            if (current_time - last_time).total_seconds() < 600:
                return jsonify({'success': False, 'message': 'Bạn chỉ được điểm danh 1 lần mỗi 10 phút. Vui lòng thử lại sau.'}), 429
        if erp_attendance.check_recent_attendance(user.employee_id, minutes=10):
            return jsonify({'success': False, 'message': 'Đã chấm công trong ERP gần đây, vui lòng thử lại sau.'}), 429
        status = 'present'
        if current_time.hour > 8 or (current_time.hour == 8 and current_time.minute > 30):
            status = 'late'
        # Ghi vào database nội bộ (SQLite)
        new_attendance = Attendance(
            user_id=user_id,
            check_in_time=current_time,
            date=today,
            status=status
        )
        db.session.add(new_attendance)
        db.session.commit()
        # Ghi vào database ERP (MySQL tc_lv0012)
        erp_success = erp_attendance.create_attendance_record(
            employee_id=user.employee_id,
            attendance_time=current_time
        )
        if erp_success:
            return jsonify({'success': True, 'message': f'Điểm danh thành công cho {user.name}', 'user': {'name': user.name, 'employee_id': user.employee_id, 'department': user.department, 'position': user.position}, 'status': status})
        else:
            return jsonify({'success': True, 'message': f'Điểm danh nội bộ thành công cho {user.name}, nhưng có lỗi ghi ERP', 'user': {'name': user.name, 'employee_id': user.employee_id, 'department': user.department, 'position': user.position}, 'status': status})
    except Exception as e:
        return jsonify({'success': False, 'message': str(e)}), 500

def admin_required(f):
    @wraps(f)
    def wrapper(*args, **kwargs):
        if not session.get('is_admin'):
            return jsonify({'success': False, 'message': 'Unauthorized'}), 401
        return f(*args, **kwargs)
    return wrapper

@app.route('/api/admin_login', methods=['POST'])
def admin_login():
    data = request.get_json() or {}
    pwd = data.get('password')
    if pwd == ADMIN_PASSWORD:
        session['is_admin'] = True
        return jsonify({'success': True})
    return jsonify({'success': False, 'message': 'Sai mật khẩu'}), 401

@app.route('/api/admin_logout', methods=['POST'])
def admin_logout():
    session.pop('is_admin', None)
    return jsonify({'success': True})

@app.route('/api/report', methods=['GET'])
@admin_required
def api_report():
    """Return attendance records in JSON for given date"""
    try:
        date_str = request.args.get('date', date.today().strftime('%Y-%m-%d'))
        report_date = datetime.strptime(date_str, '%Y-%m-%d').date()
    except ValueError:
        report_date = date.today()

    records = (
        db.session.query(Attendance, User)
        .join(User, Attendance.user_id == User.id)
        .filter(Attendance.date == report_date)
        .all()
    )
    res = []
    for att, user in records:
        res.append({
            'name': user.name,
            'employee_id': user.employee_id,
            'department': user.department,
            'check_in_time': att.check_in_time.strftime('%H:%M:%S') if att.check_in_time else '',
            'check_out_time': att.check_out_time.strftime('%H:%M:%S') if att.check_out_time else '',
            'status': 'Đúng giờ' if att.status == 'present' else ('Trễ' if att.status == 'late' else att.status)
        })
    return jsonify({'success': True, 'records': res})

@app.route('/api/ip_whitelist', methods=['GET'])
@admin_required
def get_ip_whitelist():
    return jsonify({'success': True, 'ips': load_ip_whitelist()})

@app.route('/api/ip_whitelist', methods=['POST'])
@admin_required
def add_ip_whitelist():
    data = request.get_json() or {}
    ip = data.get('ip')
    if not ip:
        return jsonify({'success': False, 'message': 'Thiếu IP'}), 400
    ips = load_ip_whitelist()
    if ip in ips:
        return jsonify({'success': False, 'message': 'IP đã tồn tại'}), 400
    ips.append(ip)
    save_ip_whitelist(ips)
    return jsonify({'success': True})

@app.route('/api/ip_whitelist', methods=['DELETE'])
@admin_required
def delete_ip_whitelist():
    data = request.get_json() or {}
    ip = data.get('ip')
    if not ip:
        return jsonify({'success': False, 'message': 'Thiếu IP'}), 400
    ips = load_ip_whitelist()
    if ip not in ips:
        return jsonify({'success': False, 'message': 'IP không tồn tại'}), 400
    ips.remove(ip)
    save_ip_whitelist(ips)
    return jsonify({'success': True})

if __name__ == '__main__':
    init_db()
    with app.app_context():
        load_known_faces()
    app.run(debug=True, host='0.0.0.0', port=5005) 