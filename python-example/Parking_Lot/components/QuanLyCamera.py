import cv2
import numpy as np
import threading
import time
import os
import re
import requests
from PIL import Image


class QuanLyCamera:
    def __init__(self):
        self.camera_vao = None
        self.camera_ra = None
        self.camera_vao_face = None
        self.camera_ra_face = None
        self.luong_camera_vao = None
        self.luong_camera_ra = None
        self.luong_camera_vao_face = None
        self.luong_camera_ra_face = None
        self.camera_dang_chay = False
        self.khung_hinh_cuoi_vao = None
        self.khung_hinh_cuoi_ra = None
        self.khung_hinh_cuoi_vao_face = None
        self.khung_hinh_cuoi_ra_face = None
        self.anh_da_chup = None
        self.ui = None
        self.camera_hien_tai = "vao"
        os.makedirs("server/images", exist_ok=True)
        from server import url
        self.api_bien_so = url.api_BienSo
        # Lấy url camera động từ API
        self.url_rtsp_vao = None
        self.url_rtsp_ra = None
        self.url_rtsp_vao_face = None
        self.url_rtsp_ra_face = None
        self.nap_danh_sach_camera()

    def dat_ui(self, ui):
        self.ui = ui

    def bat_dau_camera(self):
        self.luong_camera_vao = threading.Thread(target=self.vong_lap_camera_vao, daemon=True)
        self.luong_camera_ra = threading.Thread(target=self.vong_lap_camera_ra, daemon=True)
        self.luong_camera_vao_face = threading.Thread(target=self.vong_lap_camera_vao_face, daemon=True)
        self.luong_camera_ra_face = threading.Thread(target=self.vong_lap_camera_ra_face, daemon=True)
        self.camera_dang_chay = True
        self.luong_camera_vao.start()
        self.luong_camera_ra.start()
        self.luong_camera_vao_face.start()
        self.luong_camera_ra_face.start()

    def dung_camera(self):
        self.camera_dang_chay = False
        if self.luong_camera_vao and self.luong_camera_vao.is_alive():
            self.luong_camera_vao.join(1.0)
        if self.luong_camera_ra and self.luong_camera_ra.is_alive():
            self.luong_camera_ra.join(1.0)
        if self.luong_camera_vao_face and self.luong_camera_vao_face.is_alive():
            self.luong_camera_vao_face.join(1.0)
        if self.luong_camera_ra_face and self.luong_camera_ra_face.is_alive():
            self.luong_camera_ra_face.join(1.0)
        if self.camera_vao is not None and self.camera_vao.isOpened():
            self.camera_vao.release()
        if self.camera_ra is not None and self.camera_ra.isOpened():
            self.camera_ra.release()
        if self.camera_vao_face is not None and self.camera_vao_face.isOpened():
            self.camera_vao_face.release()
        if self.camera_ra_face is not None and self.camera_ra_face.isOpened():
            self.camera_ra_face.release()

    def chuyen_doi_camera(self, che_do):
        self.camera_hien_tai = che_do

    def vong_lap_camera_vao(self):
        try:
            self.camera_vao = cv2.VideoCapture(self.url_rtsp_vao)
            if not self.camera_vao.isOpened():
                print(f"Lỗi: Không thể mở camera vào.")
                return
            while self.camera_dang_chay:
                ret, frame = self.camera_vao.read()
                if ret:
                    self.khung_hinh_cuoi_vao = frame
                    img = self._frame_to_img(frame)
                    if self.ui:
                        self.ui.root.after(0, self.ui.cap_nhat_khung_camera_vao, img)
                time.sleep(0.03)
        except Exception as e:
            print(f"Lỗi camera vào: {e}")
        finally:
            if self.camera_vao is not None and self.camera_vao.isOpened():
                self.camera_vao.release()

    def vong_lap_camera_ra(self):
        try:
            self.camera_ra = cv2.VideoCapture(self.url_rtsp_ra)
            if not self.camera_ra.isOpened():
                print(f"Lỗi: Không thể mở camera ra.")
                return
            while self.camera_dang_chay:
                ret, frame = self.camera_ra.read()
                if ret:
                    self.khung_hinh_cuoi_ra = frame
                    img = self._frame_to_img(frame)
                    if self.ui:
                        self.ui.root.after(0, self.ui.cap_nhat_khung_camera_ra, img)
                time.sleep(0.03)
        except Exception as e:
            print(f"Lỗi camera ra: {e}")
        finally:
            if self.camera_ra is not None and self.camera_ra.isOpened():
                self.camera_ra.release()
                    
    def vong_lap_camera_vao_face(self):
        try:
            self.camera_vao_face = cv2.VideoCapture(self.url_rtsp_vao_face)
            if not self.camera_vao_face.isOpened():
                print(f"Lỗi: Không thể mở camera vào face.")
                return
            while self.camera_dang_chay:
                ret, frame = self.camera_vao_face.read()
                if ret:
                    self.khung_hinh_cuoi_vao_face = frame
                    img = self._frame_to_img(frame)
                    if self.ui:
                        self.ui.root.after(0, self.ui.cap_nhat_khung_camera_vao_face, img)
                time.sleep(0.03)
        except Exception as e:
            print(f"Lỗi camera vào face: {e}")
        finally:
            if self.camera_vao_face is not None and self.camera_vao_face.isOpened():
                self.camera_vao_face.release()

    def vong_lap_camera_ra_face(self):
        try:
            self.camera_ra_face = cv2.VideoCapture(self.url_rtsp_ra_face)
            if not self.camera_ra_face.isOpened():
                print(f"Lỗi: Không thể mở camera ra face.")
                return
            while self.camera_dang_chay:
                ret, frame = self.camera_ra_face.read()
                if ret:
                    self.khung_hinh_cuoi_ra_face = frame
                    img = self._frame_to_img(frame)
                    if self.ui:
                        self.ui.root.after(0, self.ui.cap_nhat_khung_camera_ra_face, img)
                time.sleep(0.03)
        except Exception as e:
            print(f"Lỗi camera ra face: {e}")
        finally:
            if self.camera_ra_face is not None and self.camera_ra_face.isOpened():
                self.camera_ra_face.release()

    def chup_anh(self, ma_the=None, che_do="vao"):
        khung_hinh_cuoi = self.khung_hinh_cuoi_vao if che_do == "vao" else self.khung_hinh_cuoi_ra
        duong_dan = None
        duong_dan_face = None
        bien_so = None
        if khung_hinh_cuoi is not None:
            self.anh_da_chup = khung_hinh_cuoi.copy()
            if ma_the:
                ten_file = f"{ma_the}_{int(time.time())}.jpg"
                duong_dan = os.path.join("server/images", ten_file)
                cv2.imwrite(duong_dan, self.anh_da_chup)
                
                # Chụp ảnh face tương ứng
                if che_do == "vao" and self.khung_hinh_cuoi_vao_face is not None:
                    ten_file_face = f"{ma_the}_face_{int(time.time())}.jpg"
                    duong_dan_face = os.path.join("server/images", ten_file_face)
                    cv2.imwrite(duong_dan_face, self.khung_hinh_cuoi_vao_face)
                elif che_do == "ra" and self.khung_hinh_cuoi_ra_face is not None:
                    ten_file_face = f"{ma_the}_face_{int(time.time())}.jpg"
                    duong_dan_face = os.path.join("server/images", ten_file_face)
                    cv2.imwrite(duong_dan_face, self.khung_hinh_cuoi_ra_face)
                
                if self.api_bien_so:
                    try:
                        with open(duong_dan, "rb") as file_anh:
                            files = {"file": file_anh}
                            response = requests.post(self.api_bien_so, files=files, timeout=10)
                            if response.status_code == 200:
                                ket_qua = response.json()
                                if ket_qua.get("ket_qua"):
                                    chuoi_ocr = ket_qua["ket_qua"][0].get("ocr", "")
                                    match = re.search(r"text='(.*?)'", chuoi_ocr)
                                    if match:
                                        bien_so = match.group(1)
                    except Exception as e:
                        print("Lỗi khi gửi ảnh lên API biển số:", e)
            img = self._frame_to_img(self.anh_da_chup)
            if self.ui:
                self.ui.cap_nhat_anh_gan_day(img)
                # Hiển thị ảnh tĩnh tạm thời trên camera feed nếu có đường dẫn file
                if duong_dan:
                    self.ui.hien_thi_anh_chup_tren_camera(duong_dan, che_do)                    # Hiển thị ảnh face tương ứng với file face đã chụp
                    if duong_dan_face:
                        try:
                            self.ui.hien_thi_anh_chup_face_tren_camera(duong_dan_face, che_do)
                        except Exception as e:
                            print(f"Lỗi hiển thị ảnh face: {e}")
            return duong_dan, bien_so, duong_dan_face
        return None, None, None

    def _frame_to_img(self, frame):
        rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        target_width = 320
        target_height = 240
        height, width = rgb_frame.shape[:2]
        scale = max(target_width / width, target_height / height)
        new_width = int(width * scale)
        new_height = int(height * scale)
        rgb_frame = cv2.resize(rgb_frame, (new_width, new_height))
        start_x = max(0, (new_width - target_width) // 2)
        start_y = max(0, (new_height - target_height) // 2)
        rgb_frame = rgb_frame[start_y:start_y+target_height, start_x:start_x+target_width]
        if rgb_frame.shape[0] != target_height or rgb_frame.shape[1] != target_width:
            rgb_frame = cv2.resize(rgb_frame, (target_width, target_height))
        img = Image.fromarray(rgb_frame)
        return img

    def nap_danh_sach_camera(self, ma_khu_vuc=None):
        """
        Nạp danh sách camera từ API backend và phân loại vào/ra/face theo khu vực.
        """
        try:
            from server import api
            import json
            import os

            # Nếu không có mã khu vực truyền vào, lấy từ file config
            if not ma_khu_vuc:
                try:
                    config_path = os.path.join(os.path.dirname(__file__), '../server/config/work_config.json')
                    with open(config_path, 'r', encoding='utf-8') as f:
                        config = json.load(f)
                        ma_khu_vuc = config.get('ma_khu_vuc')
                        print(f"[DEBUG] Đọc mã khu vực từ config: {ma_khu_vuc}")
                except Exception as e:
                    print(f"[DEBUG] Lỗi đọc file config: {e}")
                    return

            if not ma_khu_vuc:
                print("[DEBUG] Không có mã khu vực, không thể load camera")
                return

            danh_sach = api.layDanhSachCamera()
            print(f"[DEBUG] Danh sách camera từ API: {danh_sach}")
            print(f"[DEBUG] Lọc camera theo mã khu vực: {ma_khu_vuc}")
            
            # Reset URLs
            self.url_rtsp_vao = None
            self.url_rtsp_ra = None
            self.url_rtsp_vao_face = None
            self.url_rtsp_ra_face = None

            # Lọc và gán URL camera theo khu vực, chỉ lấy camera đầu tiên phù hợp
            for cam in danh_sach:
                if cam.get("maKhuVuc") != ma_khu_vuc:
                    print(f"[DEBUG] Bỏ qua camera {cam.get('maCamera')} vì không thuộc khu {ma_khu_vuc}")
                    continue
                print(f"[DEBUG] Xử lý camera của khu {ma_khu_vuc}: {cam}")
                loai = cam.get("loaiCamera")
                chuc_nang = cam.get("chucNangCamera")
                url = cam.get("linkRTSP")

                if loai == "VAO" and chuc_nang == "BIENSO" and url and self.url_rtsp_vao is None:
                    self.url_rtsp_vao = url
                elif loai == "RA" and chuc_nang == "BIENSO" and url and self.url_rtsp_ra is None:
                    self.url_rtsp_ra = url
                elif loai == "VAO" and chuc_nang == "KHUONMAT" and url and self.url_rtsp_vao_face is None:
                    self.url_rtsp_vao_face = url
                elif loai == "RA" and chuc_nang == "KHUONMAT" and url and self.url_rtsp_ra_face is None:
                    self.url_rtsp_ra_face = url

            print(f"[DEBUG] URL các camera đã chọn cho khu {ma_khu_vuc}:")
            print(f"[DEBUG] Camera vào (biển số): {self.url_rtsp_vao}")
            print(f"[DEBUG] Camera ra (biển số): {self.url_rtsp_ra}")
            print(f"[DEBUG] Camera vào (khuôn mặt): {self.url_rtsp_vao_face}")
            print(f"[DEBUG] Camera ra (khuôn mặt): {self.url_rtsp_ra_face}")

        except Exception as e:
            print(f"Lỗi nạp danh sách camera từ API: {e}")