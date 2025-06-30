import tkinter as tk
from tkinter import ttk
from PIL import Image, ImageTk
import os

class CameraComponent:
    def __init__(self, parent):
        self.parent = parent
        self.dang_hien_thi_anh_tinh_vao = False
        self.dang_hien_thi_anh_tinh_ra = False
        self.dang_hien_thi_anh_tinh_vao_face = False
        self.dang_hien_thi_anh_tinh_ra_face = False
        self.timer_khoi_phuc_camera = None
        self.camera_hien_tai = "vao"  # Mặc định là camera vào
        self.zone_info = None  # Store zone information
        self.create_camera_frames()

    def create_camera_frames(self):
        """Tạo các khung camera với responsive design"""
        # Configure grid weights for responsiveness  
        self.parent.grid_rowconfigure(0, weight=1)
        self.parent.grid_rowconfigure(1, weight=1)
        self.parent.grid_rowconfigure(2, weight=0)  # License plate row
        self.parent.grid_columnconfigure(0, weight=1)
        self.parent.grid_columnconfigure(1, weight=1)

        # Main camera row
        self.create_main_cameras()
        
        # Face detection row
        self.create_face_cameras()
        
        # License plate display row
        self.create_license_plate_display()

    def create_main_cameras(self):
        """Tạo camera chính"""        # Camera vào
        style = ttk.Style()
        style.configure('RoundedLabelframe.TLabelframe', 
                       background='#f0f9ff',
                       borderwidth=2,
                       relief='groove')
        style.configure('RoundedLabelframe.TLabelframe.Label',
                       font=("Helvetica", 12, "bold"),
                       foreground='#0369a1',
                       background='#f0f9ff')
            
        khung_camera_vao = ttk.LabelFrame(
            self.parent, text="Camera Vào (...)", 
            padding=(5, 5, 5, 5),
            style='RoundedLabelframe.TLabelframe'
        )
        # Add rounded corners using canvas
        canvas = tk.Canvas(khung_camera_vao, 
                          background='#f0f9ff',
                          bd=0, 
                          highlightthickness=0)
        canvas.place(x=0, y=0, relwidth=1, relheight=1)
        # Create rounded rectangle
        canvas.create_roundrectangle = lambda x1, y1, x2, y2, radius: canvas.create_polygon(
            x1+radius, y1,
            x2-radius, y1,
            x2, y1,
            x2, y1+radius,
            x2, y2-radius,
            x2, y2,
            x2-radius, y2,
            x1+radius, y2,
            x1, y2,
            x1, y2-radius,
            x1, y1+radius,
            x1, y1,
            smooth=True
        )
        khung_camera_vao.grid(row=0, column=0, sticky="nsew", padx=(0, 5), pady=(0, 5))
        
        self.khung_hien_thi_camera_vao = tk.Label(khung_camera_vao, bg="black")
        self.khung_hien_thi_camera_vao.pack(fill=tk.BOTH, expand=True, padx=0, pady=0)
        
        anh_camera_vao = Image.new('RGB', (400, 300), color='#333333')
        self.anh_camera_vao = ImageTk.PhotoImage(anh_camera_vao)
        self.khung_hien_thi_camera_vao.config(image=self.anh_camera_vao)
        
        self.nhan_cong_vao = tk.Label(
            khung_camera_vao, text="Cổng vào: ...", font=("Helvetica", 10, "bold"), 
            bg="#f0f9ff", fg="#0369a1"
        )
        self.nhan_cong_vao.pack(pady=(5, 0))

        # Camera ra
        khung_camera_ra = tk.LabelFrame(
            self.parent, text="Camera Ra (...)", font=("Helvetica", 12, "bold"),
            bg="#f0f9ff", fg="#0369a1", padx=5, pady=5, relief=tk.GROOVE, bd=2
        )
        khung_camera_ra.grid(row=0, column=1, sticky="nsew", padx=(5, 0), pady=(0, 5))        
        self.khung_hien_thi_camera_ra = tk.Label(khung_camera_ra, bg="black")
        self.khung_hien_thi_camera_ra.pack(fill=tk.BOTH, expand=True, padx=0, pady=0)
        
        anh_camera_ra = Image.new('RGB', (400, 300), color='#333333')
        self.anh_camera_ra = ImageTk.PhotoImage(anh_camera_ra)
        self.khung_hien_thi_camera_ra.config(image=self.anh_camera_ra)
        
        self.nhan_cong_ra = tk.Label(
            khung_camera_ra, text="Cổng ra: ...", font=("Helvetica", 10, "bold"), 
            bg="#f0f9ff", fg="#0369a1"
        )
        self.nhan_cong_ra.pack(pady=(5, 0))

    def create_face_cameras(self):
        """Tạo camera nhận diện khuôn mặt"""
        # Camera vào face
        khung_camera_vao_face = tk.LabelFrame(
            self.parent, text="Camera khuôn mặt vào", 
            font=("Helvetica", 12, "bold"), bg="#f0f9ff", fg="#0369a1",
            padx=5, pady=5, relief=tk.GROOVE, bd=2
        )
        khung_camera_vao_face.grid(row=1, column=0, sticky="nsew", padx=(0, 5), pady=(5, 5))
        
        self.khung_hien_thi_camera_vao_face = tk.Label(khung_camera_vao_face, bg="black")
        self.khung_hien_thi_camera_vao_face.pack(fill=tk.BOTH, expand=True, padx=0, pady=0)
        
        anh_trong = Image.new('RGB', (400, 300), color='#333333')
        self.anh_camera_vao_face = ImageTk.PhotoImage(anh_trong)
        self.khung_hien_thi_camera_vao_face.config(image=self.anh_camera_vao_face)

        # Camera ra face
        khung_camera_ra_face = tk.LabelFrame(
            self.parent, text="Camera khuôn mặt ra", 
            font=("Helvetica", 12, "bold"), bg="#f0f9ff", fg="#0369a1",
            padx=5, pady=5, relief=tk.GROOVE, bd=2
        )
        khung_camera_ra_face.grid(row=1, column=1, sticky="nsew", padx=(5, 0), pady=(5, 5))
        
        self.khung_hien_thi_camera_ra_face = tk.Label(khung_camera_ra_face, bg="black")
        self.khung_hien_thi_camera_ra_face.pack(fill=tk.BOTH, expand=True, padx=0, pady=0)
        
        self.anh_camera_ra_face = ImageTk.PhotoImage(anh_trong)
        self.khung_hien_thi_camera_ra_face.config(image=self.anh_camera_ra_face)

    def create_license_plate_display(self):
        """Tạo khung hiển thị biển số"""
        khung_bien_so = tk.LabelFrame(
            self.parent, text="Biển Số Xe", font=("Helvetica", 12, "bold"), 
            bg="#f0f9ff", fg="#0369a1", padx=5, pady=5, 
            relief=tk.GROOVE, bd=2
        )
        khung_bien_so.grid(row=2, column=0, columnspan=2, sticky="ew", padx=0, pady=(5, 0))

        self.khung_hien_thi_bien_so = tk.Label(
            khung_bien_so, text="", font=("Helvetica", 16, "bold"), 
            bg="white", fg="#0369a1", height=3, anchor="center"
        )
        self.khung_hien_thi_bien_so.pack(fill=tk.BOTH, expand=True, padx=5, pady=5)

    def cap_nhat_khung_camera_vao(self, anh):
        """Cập nhật khung hình camera vào"""
        if not self.dang_hien_thi_anh_tinh_vao:
            self.anh_camera_vao = ImageTk.PhotoImage(anh)
            self.khung_hien_thi_camera_vao.config(image=self.anh_camera_vao)
            
    def cap_nhat_khung_camera_ra(self, anh):
        """Cập nhật khung hình camera ra"""
        if not self.dang_hien_thi_anh_tinh_ra:
            self.anh_camera_ra = ImageTk.PhotoImage(anh)
            self.khung_hien_thi_camera_ra.config(image=self.anh_camera_ra)
    
    def cap_nhat_khung_camera_vao_face(self, anh):
        """Cập nhật khung hình camera vào face"""
        if not self.dang_hien_thi_anh_tinh_vao_face:
            self.anh_camera_vao_face = ImageTk.PhotoImage(anh)
            self.khung_hien_thi_camera_vao_face.config(image=self.anh_camera_vao_face)
    
    def cap_nhat_khung_camera_ra_face(self, anh):
        """Cập nhật khung hình camera ra face"""
        if not self.dang_hien_thi_anh_tinh_ra_face:
            self.anh_camera_ra_face = ImageTk.PhotoImage(anh)
            self.khung_hien_thi_camera_ra_face.config(image=self.anh_camera_ra_face)

    def hien_thi_anh_chup_tren_camera(self, duong_dan_anh, che_do="vao"):
        """Hiển thị ảnh chụp trực tiếp trên khung camera tương ứng và tự động khôi phục live feed sau 3 giây"""
        try:
            if not duong_dan_anh or not os.path.exists(duong_dan_anh):
                print(f"Ảnh không tồn tại: {duong_dan_anh}")
                return
            
            # Hủy timer cũ nếu có
            if self.timer_khoi_phuc_camera:
                self.parent.winfo_toplevel().after_cancel(self.timer_khoi_phuc_camera)
            
            # Load ảnh từ file
            from PIL import Image
            anh_pil = Image.open(duong_dan_anh)
            
            # Resize ảnh phù hợp với khung camera (450x330)
            anh_resize = anh_pil.resize((450, 330), Image.Resampling.LANCZOS)
            
            # Chọn khung camera tương ứng để hiển thị
            if che_do == "vao":
                # Đánh dấu đang hiển thị ảnh tĩnh
                self.dang_hien_thi_anh_tinh_vao = True
                # Hiển thị trên camera vào
                self.anh_camera_vao = ImageTk.PhotoImage(anh_resize)
                self.khung_hien_thi_camera_vao.config(image=self.anh_camera_vao)
                print(f"Đã hiển thị ảnh chụp trên camera vào: {duong_dan_anh}")
            else:
                # Đánh dấu đang hiển thị ảnh tĩnh
                self.dang_hien_thi_anh_tinh_ra = True
                # Hiển thị trên camera ra
                self.anh_camera_ra = ImageTk.PhotoImage(anh_resize)
                self.khung_hien_thi_camera_ra.config(image=self.anh_camera_ra)
                print(f"Đã hiển thị ảnh chụp trên camera ra: {duong_dan_anh}")
            
            # Tự động khôi phục live feed sau 6 giây
            self.timer_khoi_phuc_camera = self.parent.winfo_toplevel().after(6000, lambda: self.khoi_phuc_live_camera_feeds())
                
        except Exception as e:
            print(f"Lỗi hiển thị ảnh chụp trên camera {che_do}: {e}")

    def hien_thi_anh_chup_face_tren_camera(self, duong_dan_anh, che_do="vao"):
        """Hiển thị ảnh chụp face trực tiếp trên khung camera face"""
        try:
            if not duong_dan_anh or not os.path.exists(duong_dan_anh):
                print(f"Ảnh face không tồn tại: {duong_dan_anh}")
                return
                
            if self.timer_khoi_phuc_camera:
                self.parent.after_cancel(self.timer_khoi_phuc_camera)
            
            anh_pil = Image.open(duong_dan_anh)
            anh_resize = anh_pil.resize((450, 330), Image.Resampling.LANCZOS)
            
            if che_do == "vao":
                self.dang_hien_thi_anh_tinh_vao_face = True
                self.anh_camera_vao_face = ImageTk.PhotoImage(anh_resize)
                self.khung_hien_thi_camera_vao_face.config(image=self.anh_camera_vao_face)
            else:
                self.dang_hien_thi_anh_tinh_ra_face = True
                self.anh_camera_ra_face = ImageTk.PhotoImage(anh_resize)
                self.khung_hien_thi_camera_ra_face.config(image=self.anh_camera_ra_face)
                  
            self.timer_khoi_phuc_camera = self.parent.after(6000, self.khoi_phuc_live_camera_feeds)
        except Exception as e:
            print(f"Lỗi hiển thị ảnh face trên camera {che_do}: {e}")

    def khoi_phuc_live_camera_feeds(self):
        """Khôi phục live feed camera"""
        print("Khôi phục tất cả camera về chế độ live feed...")
        # Reset cờ hiệu
        self.dang_hien_thi_anh_tinh_vao = False
        self.dang_hien_thi_anh_tinh_ra = False
        self.dang_hien_thi_anh_tinh_vao_face = False
        self.dang_hien_thi_anh_tinh_ra_face = False
        
        # Hủy bỏ timer nếu đang chạy
        if self.timer_khoi_phuc_camera:
            self.parent.winfo_toplevel().after_cancel(self.timer_khoi_phuc_camera)
            self.timer_khoi_phuc_camera = None
        
        # Khởi động lại luồng camera chính dựa trên chế độ hiện tại
        self.chuyen_doi_camera(self.camera_hien_tai) # Gọi chuyen_doi_camera với chế độ hiện tại

    def cap_nhat_camera_cong_theo_khu(self, ma_khu_vuc=None):
        """
        Cập nhật thông tin camera/cổng theo khu vực, lấy dữ liệu từ API backend mới
        Nếu truyền ma_khu_vuc thì sẽ tìm khu đó, không thì lấy khu đầu tiên
        """
        from server import api as server_api
        ds_khu = server_api.lay_khu_vuc_camera_cong()
        if not ds_khu:
            # Không có dữ liệu
            self.nhan_cong_vao.config(text="Cổng vào: ...")
            self.nhan_cong_ra.config(text="Cổng ra: ...")
            self.khung_hien_thi_camera_vao.master.config(text="Camera Vào (...)")
            self.khung_hien_thi_camera_ra.master.config(text="Camera Ra (...)")
            return
        # Chọn khu vực phù hợp
        khu = None
        if ma_khu_vuc:
            for k in ds_khu:
                if k.get('maKhuVuc') == ma_khu_vuc:
                    khu = k
                    break
        if not khu:
            khu = ds_khu[0]
        # Cổng vào
        if khu.get('congVao') and len(khu['congVao']) > 0:
            cong_vao = khu['congVao'][0]
            self.nhan_cong_vao.config(text=f"Cổng vào: {cong_vao.get('tenCong', '...')} ({cong_vao.get('maCong', '...')})")
        else:
            self.nhan_cong_vao.config(text="Cổng vào: ...")
        # Cổng ra
        if khu.get('congRa') and len(khu['congRa']) > 0:
            cong_ra = khu['congRa'][0]
            self.nhan_cong_ra.config(text=f"Cổng ra: {cong_ra.get('tenCong', '...')} ({cong_ra.get('maCong', '...')})")
        else:
            self.nhan_cong_ra.config(text="Cổng ra: ...")
        # Camera vào
        if khu.get('cameraVao') and len(khu['cameraVao']) > 0:
            cam_vao = khu['cameraVao'][0]
            vi_tri_vao = cam_vao.get('viTriLapDat') or cam_vao.get('chucNangCamera') or ''
            self.khung_hien_thi_camera_vao.master.config(
                text=f"Camera Vào ({cam_vao.get('maCamera', '...')} - {vi_tri_vao})"
            )
        else:
            self.khung_hien_thi_camera_vao.master.config(text="Camera Vào (...)")
        # Camera ra
        if khu.get('cameraRa') and len(khu['cameraRa']) > 0:
            cam_ra = khu['cameraRa'][0]
            vi_tri_ra = cam_ra.get('viTriLapDat') or cam_ra.get('chucNangCamera') or ''
            self.khung_hien_thi_camera_ra.master.config(
                text=f"Camera Ra ({cam_ra.get('maCamera', '...')} - {vi_tri_ra})"
            )
        else:
            self.khung_hien_thi_camera_ra.master.config(text="Camera Ra (...)" )

    def load_anh_tu_url(self, url_path):
        """Load ảnh từ URL database"""
        try:
            if not url_path:
                return None
            
            print(f"🔍 DEBUG: Đường dẫn ảnh nhận được: '{url_path}'")
            
            if url_path.startswith("server/"):
                local_path = url_path.replace("\\", "/").replace("//", "/")
                current_dir = os.getcwd()
                full_path = os.path.join(current_dir, local_path)
                full_path = os.path.normpath(full_path)
                
                print(f"🔍 DEBUG: Đường dẫn đầy đủ: '{full_path}'")
                
                if os.path.exists(full_path):
                    print(f"✅ File tồn tại, đang load ảnh...")
                    image = Image.open(full_path)
                    print(f"✅ Load ảnh thành công, kích thước: {image.size}")
                    return image
                else:
                    print(f"❌ File không tồn tại: {full_path}")
                    filename = os.path.basename(url_path)
                    alt_path = os.path.join(current_dir, "server", "images", filename)
                    
                    if os.path.exists(alt_path):
                        print(f"✅ Tìm thấy file tại đường dẫn thay thế")
                        image = Image.open(alt_path)
                        return image
                    else:
                        print(f"❌ Không tìm thấy file ở đường dẫn thay thế")
                        return None
            else:
                if os.path.exists(url_path):
                    image = Image.open(url_path)
                    return image
                else:
                    return None
                    
        except Exception as e:
            print(f"❌ Lỗi load ảnh từ URL {url_path}: {e}")
            return None

    def hien_thi_anh_vao_sau_xe_ra_thanh_cong(self, anh_vao_url, anh_mat_vao_url):
        """Hiển thị ảnh xe vào và ảnh mặt vào sau khi xe ra thành công"""
        try:
            print(f"🎯 Hiển thị ảnh vào sau xe ra thành công - Xe: {anh_vao_url}, Face: {anh_mat_vao_url}")
            
            if self.timer_khoi_phuc_camera:
                self.parent.after_cancel(self.timer_khoi_phuc_camera)
            
            if anh_vao_url:
                self.hien_thi_anh_vao_tren_camera_vao_tu_url(anh_vao_url)
            
            if anh_mat_vao_url:
                self.hien_thi_anh_mat_vao_tren_camera_vao_face_tu_url(anh_mat_vao_url)
            
            self.timer_khoi_phuc_camera = self.parent.after(6000, self.khoi_phuc_live_camera_feeds)
            
        except Exception as e:
            print(f"❌ Lỗi hiển thị ảnh vào sau xe ra: {e}")

    def hien_thi_anh_vao_tren_camera_vao_tu_url(self, anh_vao_url):
        """Hiển thị ảnh xe vào từ URL database lên camera vào"""
        try:
            anh_vao_pil = self.load_anh_tu_url(anh_vao_url)
            if anh_vao_pil:
                anh_resize = anh_vao_pil.resize((450, 330), Image.Resampling.LANCZOS)
                self.dang_hien_thi_anh_tinh_vao = True
                self.anh_camera_vao = ImageTk.PhotoImage(anh_resize)
                self.khung_hien_thi_camera_vao.config(image=self.anh_camera_vao)
        except Exception as e:
            print(f"❌ Lỗi hiển thị ảnh xe vào trên camera vào: {e}")

    def hien_thi_anh_mat_vao_tren_camera_vao_face_tu_url(self, anh_mat_vao_url):
        """Hiển thị ảnh mặt vào từ URL database lên camera vào face"""
        try:
            anh_mat_vao_pil = self.load_anh_tu_url(anh_mat_vao_url)
            if anh_mat_vao_pil:
                anh_resize = anh_mat_vao_pil.resize((450, 330), Image.Resampling.LANCZOS)
                self.dang_hien_thi_anh_tinh_vao_face = True
                self.anh_camera_vao_face = ImageTk.PhotoImage(anh_resize)
                self.khung_hien_thi_camera_vao_face.config(image=self.anh_camera_vao_face)
        except Exception as e:
            print(f"❌ Lỗi hiển thị ảnh mặt vào trên camera vào face: {e}")

    def update_license_plate_display(self, bien_so, phi=None):
        """
        Cập nhật hiển thị biển số và phí gửi xe (nếu có).
        """
        if phi is not None:
            text = f"Biển số: {bien_so}\nPhí gửi xe: {phi:,.0f} VNĐ"
        else:
            text = f"Biển số: {bien_so}"
        self.khung_hien_thi_bien_so.config(text=text)

    def cap_nhat_anh_gan_day(self, img):
        """Cập nhật ảnh gần đây nhất"""
        try:
            if img:
                # Chuyển đổi PIL Image thành PhotoImage
                img_tk = ImageTk.PhotoImage(img)
                if self.camera_hien_tai == "vao":
                    self.anh_camera_vao = img_tk
                    self.khung_hien_thi_camera_vao.config(image=img_tk)
                else:
                    self.anh_camera_ra = img_tk
                    self.khung_hien_thi_camera_ra.config(image=img_tk)
        except Exception as e:
            print(f"Lỗi cập nhật ảnh gần đây: {e}")

    def chuyen_doi_camera(self, che_do):
        """Chuyển đổi camera hiện tại"""
        self.camera_hien_tai = che_do

    def cleanup(self):
        """Dọn dẹp tài nguyên camera"""
        try:
            # Hủy timer nếu đang chạy
            if self.timer_khoi_phuc_camera:
                self.parent.after_cancel(self.timer_khoi_phuc_camera)
                self.timer_khoi_phuc_camera = None
                
            # Xóa tham chiếu đến ảnh
            self.anh_camera_vao = None
            self.anh_camera_ra = None
            self.anh_camera_vao_face = None
            self.anh_camera_ra_face = None
        except:
            pass

    def update_zone_info(self, zone_info):
        """Cập nhật thông tin khu vực"""
        self.zone_info = zone_info
        self.update_labels()
        
    def update_labels(self):
        """Cập nhật nhãn camera và cổng dựa trên thông tin khu vực"""
        if not self.zone_info:
            return
            
        # Update camera labels
        camera_vao = "Chưa có" if not self.zone_info.get("cameraVao") else self.zone_info["cameraVao"][0]["tenCamera"]
        camera_ra = "Chưa có" if not self.zone_info.get("cameraRa") else self.zone_info["cameraRa"][0]["tenCamera"]
        
        # Update gate labels
        cong_vao = "Chưa có" if not self.zone_info.get("congVao") else self.zone_info["congVao"][0]["tenCong"]
        cong_ra = "Chưa có" if not self.zone_info.get("congRa") else self.zone_info["congRa"][0]["tenCong"]
        
        self.khung_camera_vao.config(text=f"Camera Vào ({camera_vao})")
        self.khung_camera_ra.config(text=f"Camera Ra ({camera_ra})")
        self.khung_cong_vao.config(text=f"Cổng vào: {cong_vao}")
        self.khung_cong_ra.config(text=f"Cổng ra: {cong_ra}")
