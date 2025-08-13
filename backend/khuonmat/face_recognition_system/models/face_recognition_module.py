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

import cv2
import numpy as np
import os
from PIL import Image, ImageDraw, ImageFont
import io
import base64
import sys
import importlib
sys.path.append('Silent-Face-Anti-Spoofing/src')
anti_spoof_predict = importlib.import_module('anti_spoof_predict')
generate_patches = importlib.import_module('generate_patches')
utility = importlib.import_module('utility')

class AntiSpoofingWrapper:
    def __init__(self, model_dir='Silent-Face-Anti-Spoofing/resources/anti_spoof_models', device_id=0):
        self.model_dir = model_dir
        self.device_id = device_id
        self.anti_spoof = anti_spoof_predict.AntiSpoofPredict(device_id)
        self.cropper = generate_patches.CropImage()
        import os
        self.model_paths = [os.path.join(model_dir, m) for m in os.listdir(model_dir) if m.endswith('.pth')]

    def is_real_face(self, frame, bbox=None):
        # Nếu bbox chưa có, dùng detector lấy bbox
        if bbox is None:
            bbox = self.anti_spoof.get_bbox(frame)
        prediction = np.zeros((1, 3))
        for model_path in self.model_paths:
            # Lấy thông tin model
            h_input, w_input, model_type, scale = utility.parse_model_name(os.path.basename(model_path))
            param = {
                "org_img": frame,
                "bbox": bbox,
                "scale": scale,
                "out_w": w_input,
                "out_h": h_input,
                "crop": True,
            }
            if scale is None:
                param["crop"] = False
            img = self.cropper.crop(**param)
            prediction += self.anti_spoof.predict(img, model_path)
        label = np.argmax(prediction)
        value = prediction[0][label]/2
        # label==1: real, label==0: fake
        return label == 1, float(value)

class FaceRecognition:
    def __init__(self):
        self.known_face_encodings = []
        self.known_face_names = []
        self.known_face_ids = []
        self.anti_spoofing = AntiSpoofingWrapper()
        
    def load_known_faces(self, users):
        """Load face encodings từ database"""
        self.known_face_encodings = []
        self.known_face_names = []
        self.known_face_ids = []
        
        for user in users:
            if user.face_encoding is not None:
                self.known_face_encodings.append(user.face_encoding)
                self.known_face_names.append(user.name)
                self.known_face_ids.append(user.id)
    
    def encode_face_from_image(self, image_file):
        """Encode khuôn mặt từ file ảnh upload"""
        # Đọc ảnh
        image = face_recognition.load_image_file(image_file)
        
        # Tìm khuôn mặt trong ảnh
        face_locations = face_recognition.face_locations(image)
        
        if len(face_locations) == 0:
            return None, "Không tìm thấy khuôn mặt trong ảnh"
        
        if len(face_locations) > 1:
            return None, "Tìm thấy nhiều hơn 1 khuôn mặt trong ảnh"
        
        # Encode khuôn mặt
        face_encoding = face_recognition.face_encodings(image, face_locations)[0]
        
        return face_encoding, None
    
    def encode_face_from_base64(self, base64_string):
        """Encode khuôn mặt từ base64 string"""
        try:
            # Xử lý base64 string (loại bỏ header nếu có)
            if ',' in base64_string:
                base64_string = base64_string.split(',')[1]
            
            # Decode base64 thành bytes
            image_bytes = base64.b64decode(base64_string)
            
            # Chuyển bytes thành PIL Image
            image = Image.open(io.BytesIO(image_bytes))
            
            # Chuyển PIL Image thành numpy array cho face_recognition
            image_array = np.array(image)
            
            # Nếu ảnh có 4 channels (RGBA), chuyển thành RGB
            if image_array.shape[-1] == 4:
                image_array = cv2.cvtColor(image_array, cv2.COLOR_RGBA2RGB)
            # Nếu ảnh là BGR, chuyển thành RGB
            elif len(image_array.shape) == 3 and image_array.shape[-1] == 3:
                # Kiểm tra xem có phải BGR không (thường từ OpenCV)
                # PIL thường trả về RGB, nhưng để chắc chắn
                pass
            
            # Tìm khuôn mặt trong ảnh
            face_locations = face_recognition.face_locations(image_array)
            
            if len(face_locations) == 0:
                return None, "Không tìm thấy khuôn mặt trong ảnh"
            
            if len(face_locations) > 1:
                return None, "Tìm thấy nhiều hơn 1 khuôn mặt trong ảnh"
            
            # Encode khuôn mặt
            face_encoding = face_recognition.face_encodings(image_array, face_locations)[0]
            
            return face_encoding, None
            
        except Exception as e:
            return None, f"Lỗi xử lý ảnh base64: {str(e)}"
    
    def recognize_face_from_frame(self, frame):
        """Nhận diện khuôn mặt từ frame camera, tích hợp chống giả mạo"""
        small_frame = cv2.resize(frame, (0, 0), fx=0.20, fy=0.20)
        rgb_small_frame = cv2.cvtColor(small_frame, cv2.COLOR_BGR2RGB)
        face_locations = face_recognition.face_locations(rgb_small_frame)
        face_encodings = face_recognition.face_encodings(rgb_small_frame, face_locations)
        face_names = []
        face_ids = []
        # Scale lại vị trí khuôn mặt
        scaled_face_locations = [(top*5, right*5, bottom*5, left*5) for (top, right, bottom, left) in face_locations]
        for i, face_encoding in enumerate(face_encodings):
            # Chống giả mạo
            # Cắt bbox trên frame gốc (không resize)
            if i < len(scaled_face_locations):
                top, right, bottom, left = scaled_face_locations[i]
                bbox = [left, top, right-left, bottom-top]
                is_real, spoof_score = self.anti_spoofing.is_real_face(frame, bbox)
            else:
                is_real, spoof_score = False, 0.0
            if not is_real:
                face_names.append("Fake")
                face_ids.append(None)
                continue
            matches = face_recognition.compare_faces(self.known_face_encodings, face_encoding, tolerance=0.4)
            name = "Unknown"
            user_id = None
            face_distances = face_recognition.face_distance(self.known_face_encodings, face_encoding)
            if len(face_distances) > 0:
                best_match_index = np.argmin(face_distances)
                if matches[best_match_index]:
                    name = self.known_face_names[best_match_index]
                    user_id = self.known_face_ids[best_match_index]
            face_names.append(name)
            face_ids.append(user_id)
        return scaled_face_locations, face_names, face_ids
    
    def draw_faces_on_frame(self, frame, face_locations, face_names):
        """Vẽ khung và tên lên frame với font Unicode."""
        
        # Chuyển frame OpenCV (BGR) sang ảnh Pillow (RGB)
        rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        pil_image = Image.fromarray(rgb_frame)
        draw = ImageDraw.Draw(pil_image)
        
        try:
            # Tải font, tăng kích thước lên 40
            font_path = "static/fonts/DejaVuSans.ttf"
            font = ImageFont.truetype(font_path, 40)
        except IOError:
            # Fallback nếu không tìm thấy font
            font = ImageFont.load_default()

        for (top, right, bottom, left), name in zip(face_locations, face_names):
            # Vẽ khung quanh khuôn mặt
            color = (0, 255, 0) if name != "Unknown" else (0, 0, 255)
            draw.rectangle(((left, top), (right, bottom)), outline=color, width=2)
            
            # Tính toán kích thước text để vẽ background
            text_bbox = draw.textbbox((left, bottom), name, font=font)
            text_width = text_bbox[2] - text_bbox[0]
            text_height = text_bbox[3] - text_bbox[1]
            
            # Vẽ background cho text
            draw.rectangle(((left, bottom), (left + text_width + 4, bottom + text_height + 4)), fill=color)
            
            # Viết tên bằng font Unicode
            draw.text((left + 6, bottom + 2), name, font=font, fill=(255, 255, 255))
        
        # Chuyển ảnh Pillow (RGB) trở lại frame OpenCV (BGR)
        return cv2.cvtColor(np.array(pil_image), cv2.COLOR_RGB2BGR)
    
    @staticmethod
    def frame_to_base64(frame):
        """Convert frame thành base64 string để gửi qua websocket"""
        _, buffer = cv2.imencode('.jpg', frame)
        frame_base64 = base64.b64encode(buffer).decode('utf-8')
        return f"data:image/jpeg;base64,{frame_base64}" 