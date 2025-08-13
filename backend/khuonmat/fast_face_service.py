"""
Fast Face Recognition micro-service for real-time face detection and recognition.

This service provides a lightweight FastAPI HTTP server for face recognition
that can be used by the Electron/React frontend.

Endpoints
---------
POST /recognize
    Accepts base64 image or multipart/form-data. Returns JSON::
        {
            "success": true,
            "faces": [
                {
                    "name": "John Doe",
                    "employee_id": "NV001",
                    "confidence": 0.92,
                    "bbox": {"x": 100, "y": 50, "w": 150, "h": 150}
                },
                ...
            ]
        }

POST /register
    Register a new face with employee information.

GET /healthz
    Liveness probe – returns {"status": "ok"}.
"""

from __future__ import annotations

import os
import sys
import io
import base64
from datetime import datetime, date
from typing import List, Dict, Any, Optional
import logging
import pickle

# Setup logging first
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler("fast_face_service.log"),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger("fast_face_service")

import cv2
import numpy as np
from fastapi import FastAPI, File, UploadFile, HTTPException, Form
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
import face_recognition
from sqlalchemy import create_engine, Column, Integer, String, DateTime, Date, ForeignKey, PickleType
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker, relationship

# Add path for anti-spoofing
sys.path.append(os.path.join(os.path.dirname(__file__), 'face_recognition_system'))
sys.path.append(os.path.join(os.path.dirname(__file__), 'face_recognition_system/Silent-Face-Anti-Spoofing/src'))

# Import các module cần thiết
try:
    from face_recognition_system.models.face_recognition_module import FaceRecognition
    from face_recognition_system.models.erp_integration import erp_attendance
except ImportError:
    logger.warning("Could not import face_recognition_module or erp_integration")
    # Create mock objects for development
    class FaceRecognition:
        def __init__(self):
            self.known_face_encodings = []
            self.known_face_names = []
            self.known_face_ids = []
    
    class MockERPAttendance:
        def check_recent_attendance(self, employee_id, minutes=10):
            return False
        def create_attendance_record(self, employee_id, attendance_time):
            return True
    
    erp_attendance = MockERPAttendance()

# SQLAlchemy Base
Base = declarative_base()

# Define models
class User(Base):
    __tablename__ = 'users'
    
    id = Column(Integer, primary_key=True)
    name = Column(String(100), nullable=False)
    employee_id = Column(String(50), unique=True, nullable=False)
    department = Column(String(100))
    position = Column(String(100))
    face_encoding = Column(PickleType, nullable=False)
    created_at = Column(DateTime, default=datetime.utcnow)
    
    attendances = relationship('Attendance', back_populates='user')

class Attendance(Base):
    __tablename__ = 'attendance'
    
    id = Column(Integer, primary_key=True)
    user_id = Column(Integer, ForeignKey('users.id'), nullable=False)
    check_in_time = Column(DateTime, nullable=False)
    check_out_time = Column(DateTime)
    date = Column(Date, nullable=False)
    status = Column(String(20), default='present')
    
    user = relationship('User', back_populates='attendances')

################################################################################
# Configuration
################################################################################

# Use absolute path for database to avoid path issues
BASE_DIR = os.path.dirname(__file__)
DATABASE_PATH = os.path.join(BASE_DIR, 'instance', 'attendance.db')
DATABASE_URI = f'sqlite:///{DATABASE_PATH}'
UPLOAD_FOLDER = os.path.join(BASE_DIR, 'face_recognition_system/static/faces')

# Create required directories if not exists
os.makedirs(UPLOAD_FOLDER, exist_ok=True)
os.makedirs(os.path.join(BASE_DIR, 'instance'), exist_ok=True)
os.makedirs(os.path.join(BASE_DIR, 'face_recognition_system/instance'), exist_ok=True)

# Initialize database engine
engine = create_engine(DATABASE_URI)
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

# Initialize face recognition
face_recognizer = FaceRecognition()

################################################################################
# FastAPI application
################################################################################

app = FastAPI(title="Fast Face Recognition Service", version="1.0.0")

# Allow CORS for Electron frontend
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

################################################################################
# Pydantic models
################################################################################

class FaceLocation(BaseModel):
    x: int
    y: int
    w: int
    h: int

class FaceDetection(BaseModel):
    name: str
    employee_id: Optional[str] = None
    confidence: float
    bbox: Optional[FaceLocation] = None
    department: Optional[str] = None
    position: Optional[str] = None

class RecognizeRequest(BaseModel):
    image: str  # Base64 encoded image

class RecognizeResponse(BaseModel):
    success: bool
    faces: List[FaceDetection] = []
    error: Optional[str] = None

class RegisterRequest(BaseModel):
    name: str
    employee_id: str
    department: Optional[str] = None
    position: Optional[str] = None
    image: str  # Base64 encoded image

class RegisterResponse(BaseModel):
    success: bool
    message: str
    employee_id: Optional[str] = None

################################################################################
# Helper functions
################################################################################

def get_db():
    """Get database session"""
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

def load_known_faces():
    """Load all known faces from database"""
    try:
        db_session = SessionLocal()
        users = db_session.query(User).all()
        
        known_face_encodings = []
        known_face_names = []
        known_face_ids = []
        
        for user in users:
            if user.face_encoding:
                # Decode face encoding từ string JSON
                face_encoding = np.array(eval(user.face_encoding))
                known_face_encodings.append(face_encoding)
                known_face_names.append(user.name)
                known_face_ids.append(user.id)
        
        face_recognizer.known_face_encodings = known_face_encodings
        face_recognizer.known_face_names = known_face_names
        face_recognizer.known_face_ids = known_face_ids
        
        logger.info(f"Loaded {len(known_face_encodings)} known faces")
        db_session.close()
        
    except Exception as e:
        logger.error(f"Error loading known faces: {str(e)}")

def decode_base64_image(image_base64: str) -> np.ndarray:
    """Decode base64 image to numpy array"""
    # Remove data URL prefix if exists
    if ',' in image_base64:
        image_base64 = image_base64.split(',')[1]
    
    # Decode base64
    image_bytes = base64.b64decode(image_base64)
    nparr = np.frombuffer(image_bytes, np.uint8)
    image = cv2.imdecode(nparr, cv2.IMREAD_COLOR)
    
    if image is None:
        raise ValueError("Invalid image data")
    
    return image

def perform_auto_attendance(user_id: int, employee_id: str, db_session):
    """Automatically perform attendance check for a user"""
    try:
        today = date.today()
        current_time = datetime.now()
        
        # Check recent attendance
        last_attendance = db_session.query(Attendance).filter_by(
            user_id=user_id, 
            date=today
        ).order_by(Attendance.check_in_time.desc()).first()
        
        if last_attendance:
            last_time = last_attendance.check_in_time
            if (current_time - last_time).total_seconds() < 600:
                return False, "Đã điểm danh trong 10 phút gần đây"
        
        # Check ERP attendance
        if erp_attendance.check_recent_attendance(employee_id, minutes=10):
            return False, "Đã chấm công ERP trong 10 phút gần đây"
        
        # Determine status
        status = 'present'
        if current_time.hour > 8 or (current_time.hour == 8 and current_time.minute > 30):
            status = 'late'
        
        # Create attendance record
        new_attendance = Attendance(
            user_id=user_id,
            check_in_time=current_time,
            date=today,
            status=status
        )
        db_session.add(new_attendance)
        db_session.commit()
        
        # Record to ERP
        erp_success = erp_attendance.create_attendance_record(
            employee_id=employee_id,
            attendance_time=current_time
        )
        
        if erp_success:
            return True, f"Điểm danh thành công (Cả nội bộ và ERP)"
        else:
            return True, f"Điểm danh nội bộ thành công, lỗi ghi ERP"
            
    except Exception as e:
        logger.error(f"Error in auto attendance: {str(e)}")
        return False, str(e)

################################################################################
# API Endpoints
################################################################################

@app.on_event("startup")
async def startup_event():
    """Initialize database and load known faces on startup"""
    logger.info("Starting Fast Face Recognition Service...")
    
    # Create database tables if not exist
    Base.metadata.create_all(bind=engine)
    
    # Load known faces
    load_known_faces()
    
    logger.info("Service started successfully")

@app.get("/healthz")
def health_check():
    """Health check endpoint"""
    return {
        "status": "ok", 
        "service": "fast_face_recognition",
        "timestamp": datetime.now().isoformat(),
        "known_faces": len(face_recognizer.known_face_encodings)
    }

@app.post("/recognize", response_model=RecognizeResponse)
async def recognize_face(file: Optional[UploadFile] = File(None), image_base64: Optional[str] = Form(None)):
    """Recognize faces in an image"""
    try:
        # Get image data
        if file:
            # From file upload
            image_bytes = await file.read()
            img_array = np.frombuffer(image_bytes, dtype=np.uint8)
            image = cv2.imdecode(img_array, cv2.IMREAD_COLOR)
        elif image_base64:
            # From base64
            image = decode_base64_image(image_base64)
        else:
            return RecognizeResponse(success=False, error="No image provided")
        
        if image is None:
            return RecognizeResponse(success=False, error="Invalid image data")
        
        # Detect faces
        face_locations = face_recognition.face_locations(image)
        
        if not face_locations:
            return RecognizeResponse(success=True, faces=[])
        
        # Encode faces
        face_encodings = face_recognition.face_encodings(image, face_locations)
        
        # Recognize each face
        faces = []
        db_session = SessionLocal()
        
        for (top, right, bottom, left), face_encoding in zip(face_locations, face_encodings):
            # Compare with known faces
            if len(face_recognizer.known_face_encodings) == 0:
                name = "Unknown"
                confidence = 0.0
                user_id = None
            else:
                matches = face_recognition.compare_faces(
                    face_recognizer.known_face_encodings, 
                    face_encoding,
                    tolerance=0.4
                )
                face_distances = face_recognition.face_distance(
                    face_recognizer.known_face_encodings, 
                    face_encoding
                )
                
                if any(matches):
                    best_match_index = np.argmin(face_distances)
                    if matches[best_match_index]:
                        name = face_recognizer.known_face_names[best_match_index]
                        confidence = 1.0 - face_distances[best_match_index]
                        user_id = face_recognizer.known_face_ids[best_match_index]
                        
                        # Get user details
                        user = db_session.query(User).filter_by(id=user_id).first()
                        if user:
                            # Auto attendance
                            success, message = perform_auto_attendance(user_id, user.employee_id, db_session)
                            logger.info(f"Auto attendance for {name}: {message}")
                            
                            faces.append(FaceDetection(
                                name=name,
                                employee_id=user.employee_id,
                                confidence=round(confidence, 4),
                                bbox=FaceLocation(
                                    x=left,
                                    y=top,
                                    w=right-left,
                                    h=bottom-top
                                ),
                                department=user.department,
                                position=user.position
                            ))
                        else:
                            name = "Unknown"
                            confidence = 0.0
                            user_id = None
                    else:
                        name = "Unknown"
                        confidence = 0.0
                        user_id = None
                else:
                    name = "Unknown"
                    confidence = 0.0
                    user_id = None
            
            if name == "Unknown":
                faces.append(FaceDetection(
                    name=name,
                    confidence=confidence,
                    bbox=FaceLocation(
                        x=left,
                        y=top,
                        w=right-left,
                        h=bottom-top
                    )
                ))
        
        db_session.close()
        return RecognizeResponse(success=True, faces=faces)
        
    except Exception as e:
        logger.error(f"Error in face recognition: {str(e)}", exc_info=True)
        return RecognizeResponse(success=False, error=str(e))

class VerifyResponse(BaseModel):
    success: bool
    match: bool
    confidence: float | None = None
    error: Optional[str] = None

@app.post("/verify", response_model=VerifyResponse)
async def verify_face(
    file: Optional[UploadFile] = File(None),
    image_base64: Optional[str] = Form(None),
    reference_base64: Optional[str] = Form(None),
    reference_path: Optional[str] = Form(None),
    tolerance: float = Form(0.45)
):
    """Xác thực khuôn mặt chụp so với ảnh chủ xe (từ đường dẫn hoặc base64)."""
    try:
        # Ảnh chụp
        if file is not None:
            cap_bytes = await file.read()
            cap_arr = np.frombuffer(cap_bytes, dtype=np.uint8)
            captured = cv2.imdecode(cap_arr, cv2.IMREAD_COLOR)
        elif image_base64:
            captured = decode_base64_image(image_base64)
        else:
            return VerifyResponse(success=False, match=False, error="No captured image provided", confidence=None)

        if captured is None:
            return VerifyResponse(success=False, match=False, error="Invalid captured image", confidence=None)

        # Ảnh tham chiếu (chủ phương tiện)
        reference = None
        if reference_base64:
            reference = decode_base64_image(reference_base64)
        elif reference_path:
            ref_path = reference_path.replace('/', '\\')
            if not os.path.isabs(ref_path):
                default_folder = r"C:\\ParkingLot_Images\\NhanDien_khuonmat"
                ref_path = os.path.join(default_folder, ref_path)
            if not os.path.exists(ref_path):
                return VerifyResponse(success=False, match=False, error=f"Reference image not found: {ref_path}", confidence=None)
            reference = cv2.imdecode(np.fromfile(ref_path, dtype=np.uint8), cv2.IMREAD_COLOR)

        if reference is None:
            return VerifyResponse(success=False, match=False, error="No reference image provided", confidence=None)

        # Encoding
        cap_locs = face_recognition.face_locations(captured)
        if len(cap_locs) == 0:
            return VerifyResponse(success=False, match=False, error="No face found in captured image", confidence=None)
        cap_enc = face_recognition.face_encodings(captured, cap_locs)[0]

        ref_locs = face_recognition.face_locations(reference)
        if len(ref_locs) == 0:
            return VerifyResponse(success=False, match=False, error="No face found in reference image", confidence=None)
        ref_enc = face_recognition.face_encodings(reference, ref_locs)[0]

        match = bool(face_recognition.compare_faces([ref_enc], cap_enc, tolerance=tolerance)[0])
        dist = float(face_recognition.face_distance([ref_enc], cap_enc)[0])
        confidence = round(1.0 - dist, 4)

        return VerifyResponse(success=True, match=match, confidence=confidence)

    except Exception as e:
        logger.error(f"Error in face verification: {str(e)}", exc_info=True)
        return VerifyResponse(success=False, match=False, error=str(e), confidence=None)

@app.post("/register", response_model=RegisterResponse)
async def register_face(request: RegisterRequest):
    """Register a new face"""
    try:
        db_session = SessionLocal()
        
        # Check if employee already exists
        existing_user = db_session.query(User).filter_by(employee_id=request.employee_id).first()
        if existing_user:
            db_session.close()
            return RegisterResponse(
                success=False, 
                message="Mã nhân viên đã tồn tại"
            )
        
        # Decode image
        image = decode_base64_image(request.image)
        
        # Detect faces
        face_locations = face_recognition.face_locations(image)
        if not face_locations:
            db_session.close()
            return RegisterResponse(
                success=False,
                message="Không tìm thấy khuôn mặt trong ảnh"
            )
        
        if len(face_locations) > 1:
            db_session.close()
            return RegisterResponse(
                success=False,
                message="Tìm thấy nhiều khuôn mặt, vui lòng chỉ chụp 1 người"
            )
        
        # Encode face
        face_encodings = face_recognition.face_encodings(image, face_locations)
        if not face_encodings:
            db_session.close()
            return RegisterResponse(
                success=False,
                message="Không thể mã hóa khuôn mặt"
            )
        
        face_encoding = face_encodings[0]
        
        # Save user to database
        new_user = User(
            name=request.name,
            employee_id=request.employee_id,
            department=request.department,
            position=request.position,
            face_encoding=str(face_encoding.tolist())  # Convert to JSON string
        )
        
        db_session.add(new_user)
        db_session.commit()
        
        # Save face image
        timestamp = datetime.now().strftime('%Y%m%d_%H%M%S')
        filename = f"{request.employee_id}_{timestamp}.jpg"
        filepath = os.path.join(UPLOAD_FOLDER, filename)
        cv2.imwrite(filepath, image)
        
        db_session.close()
        
        # Reload known faces
        load_known_faces()
        
        logger.info(f"Registered new face for {request.name} (ID: {request.employee_id})")
        
        return RegisterResponse(
            success=True,
            message="Đăng ký khuôn mặt thành công",
            employee_id=request.employee_id
        )
        
    except Exception as e:
        logger.error(f"Error in face registration: {str(e)}", exc_info=True)
        return RegisterResponse(
            success=False,
            message=f"Lỗi: {str(e)}"
        )

################################################################################
# Main entry point
################################################################################

def main():
    import argparse
    import uvicorn
    
    parser = argparse.ArgumentParser(description="Fast Face Recognition Service")
    parser.add_argument("--host", default="127.0.0.1", help="Bind host (default 127.0.0.1)")
    parser.add_argument("--port", type=int, default=5055, help="Bind port (default 5055)")
    parser.add_argument("--workers", type=int, default=1, help="Number of worker processes")
    args = parser.parse_args()
    
    logger.info(f"Starting service on {args.host}:{args.port}")
    
    uvicorn.run(
        "fast_face_service:app",
        host=args.host,
        port=args.port,
        workers=args.workers,
        log_level="info",
        reload=False
    )

if __name__ == "__main__":
    main()
