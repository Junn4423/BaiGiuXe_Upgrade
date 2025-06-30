import tkinter as tk
from tkinter import ttk, messagebox
from PIL import Image, ImageTk
import datetime
import os
import json

# Import các UI components
from .header_component import HeaderComponent
from .camera_component import CameraComponent
from .vehicle_info_component import VehicleInfoComponent
from .vehicle_list_component import VehicleListComponent

class GiaoDienQuanLyBaiXe:    
    def __init__(self, root, quan_ly_camera, quan_ly_xe, dau_doc_the):
        self.root = root
                
        # Lưu trữ vị trí chuột cho việc di chuyển cửa sổ
        self.x = None
        self.y = None
        
        # Lưu trữ các đối tượng quản lý
        self.quan_ly_camera = quan_ly_camera
        self.quan_ly_xe = quan_ly_xe
        self.dau_doc_the = dau_doc_the

        # Biến khu vực
        self.danh_sach_khu = []
        self.khu_hien_tai = None
        
        # Các biến UI khác
        self.xe_hien_tai = None
        self.dang_quet = False
        self._che_do_hien_tai = "vao"
        self._loai_xe_hien_tai = "xe_may"
        
        # Khởi tạo UI
        self.tao_giao_dien()
        self.setup_connections()
        self.start_services()
        # Sau khi UI render xong 1.2s, load config từ file work_config.json để cập nhật UI
        self.root.after(500, self.load_work_config_and_update_ui)
        self.bind_reload_shortcut()  # Thêm dòng này để bind F5

    def tao_title_bar(self):
        """Tạo thanh tiêu đề tùy chỉnh"""
        # Title bar frame
        title_bar = tk.Frame(self.root, bg="#1e3a8a", height=40)
        title_bar.pack(fill=tk.X, side=tk.TOP)
        title_bar.pack_propagate(False)
        
        
        # Nút thoát
        exit_button = tk.Button(
            title_bar,
            text="✕",
            bg="#1e3a8a",
            fg="white",
            font=("Helvetica", 13),
            bd=0,
            highlightthickness=0,
            command=self.confirm_exit
        )
        exit_button.pack(side=tk.RIGHT, padx=10)
        
        # Hiệu ứng hover cho nút thoát
        def on_enter(e):
            exit_button.configure(bg="#dc2626")
        def on_leave(e):
            exit_button.configure(bg="#1e3a8a")
        
        exit_button.bind("<Enter>", on_enter)
        exit_button.bind("<Leave>", on_leave)
        
        # Cho phép di chuyển cửa sổ khi kéo thanh tiêu đề
        title_bar.bind("<Button-1>", self.start_move)
        title_bar.bind("<B1-Motion>", self.on_move)
        # title_label.bind("<Button-1>", self.start_move)
        # title_label.bind("<B1-Motion>", self.on_move)
        
        # Logo và tên ứng dụng
        title_label = tk.Label(
            title_bar,
            text="SOF.VN",
            bg="#1e3a8a",
            fg="white",
            font=("Helvetica", 12, "bold")
        )
        title_label.pack(side=tk.LEFT, padx=10)
        
        # Button frame bên phải
        button_frame = tk.Frame(title_bar, bg="#1e3a8a")
        button_frame.pack(side=tk.RIGHT, fill=tk.Y)
        
        # Button styles
        button_font = ("Helvetica", 10)
        button_width = 45
        button_height = 25
        button_bg = "#1e3a8a"
        button_fg = "white"
        button_hoverbg = "#2563eb"
          # Minimize button
        min_btn = tk.Label(
            button_frame,
            text="−",
            width=3,
            font=button_font,
            bg=button_bg,
            fg=button_fg,
            cursor="hand2"
        )
        min_btn.pack(side=tk.LEFT, padx=2)
        min_btn.bind("<Button-1>", self.minimize_window)
        min_btn.bind("<Enter>", lambda e: min_btn.config(bg=button_hoverbg))
        min_btn.bind("<Leave>", lambda e: min_btn.config(bg=button_bg))
        
        # Maximize/Restore button
        self.max_btn = tk.Label(
            button_frame,
            text="❐",
            width=3,
            font=button_font,
            bg=button_bg,
            fg=button_fg
        )
        self.max_btn.pack(side=tk.LEFT, padx=2)
                
        # Bind events
        def on_enter(e, btn):
            btn.config(bg=button_hoverbg)
            
        def on_leave(e, btn):
            btn.config(bg=button_bg)
        
        # Bind title bar dragging
        title_bar.bind("<Button-1>", self.start_move)
        title_bar.bind("<B1-Motion>", self.on_move)
        title_label.bind("<Button-1>", self.start_move)
        title_label.bind("<B1-Motion>", self.on_move)
        
            
        
        self.max_btn.bind("<Button-1>", self.toggle_maximize)
        self.max_btn.bind("<Enter>", lambda e: on_enter(e, self.max_btn))
        self.max_btn.bind("<Leave>", lambda e: on_leave(e, self.max_btn))

    def start_move(self, event):
        """Bắt đầu di chuyển cửa sổ"""
        self.x = event.x
        self.y = event.y

    def on_move(self, event):
        """Di chuyển cửa sổ"""
        deltax = event.x - self.x
        deltay = event.y - self.y
        x = self.root.winfo_x() + deltax
        y = self.root.winfo_y() + deltay
        self.root.geometry(f"+{x}+{y}")
    def toggle_maximize(self, event=None):
        """Chuyển đổi giữa maximize và normal state"""
        if self.root.state() == 'zoomed':
            self.root.state('normal')
            self.max_btn.config(text="❐")
        else:
            self.root.state('zoomed')
            self.max_btn.config(text="❏")
    
    def minimize_window(self, event=None):
        """Thu nhỏ cửa sổ xuống taskbar"""
        self.root.iconify()
    
    def confirm_exit(self, event=None):
        """Xác nhận thoát ứng dụng"""
        if messagebox.askyesno("Xác nhận thoát", "Bạn có chắc muốn thoát khỏi ứng dụng?"):
            # Cleanup trước khi thoát
            self.cleanup()
            # Thoát ứng dụng
            self.root.quit()
            self.root.destroy()

    def tao_giao_dien(self):
        """Tạo giao diện chính"""
        # Tạo title bar tùy chỉnh
        self.tao_title_bar()
        
        # Main container with reduced padding for more space
        khung_chinh = tk.Frame(self.root, bg="#f0f9ff")
        khung_chinh.pack(fill=tk.BOTH, expand=True, padx=10, pady=10)

        # Thêm toolbar
        self.tao_toolbar(khung_chinh)

        # Header component
        self.header_component = HeaderComponent(khung_chinh, self.quan_ly_xe)
        
        # Tab control với style
        self.setup_tab_styles()
        self.tab_control = ttk.Notebook(khung_chinh)
        self.tab_control.pack(fill=tk.BOTH, expand=True)
        
        # Tab quản lý
        self.tab_quan_ly = ttk.Frame(self.tab_control, style="TFrame")
        self.tab_control.add(self.tab_quan_ly, text="Quản Lý Xe Ra Vào")
        
        # Tab danh sách
        self.tab_danh_sach = ttk.Frame(self.tab_control, style="TFrame")
        self.tab_control.add(self.tab_danh_sach, text="Danh Sách Xe Trong Bãi")
        
        # Tạo nội dung cho các tab
        self.tao_tab_quan_ly()
        self.tao_tab_danh_sach()

    def tao_toolbar(self, parent):
        """Tạo toolbar chứa các nút cấu hình"""
        toolbar = tk.Frame(parent, bg="#0f172a", height=40)
        toolbar.pack(fill=tk.X, pady=(0, 10))

        # Style cho các nút
        button_style = {
            "font": ("Helvetica", 11),
            "bg": "#0f172a",
            "fg": "white",
            "activebackground": "#1e293b",
            "activeforeground": "white",
            "bd": 0,
            "padx": 15,
            "pady": 5,
            "cursor": "hand2"
        }

        # Nút cấu hình camera
        btn_camera = tk.Button(
            toolbar,
            text="Cấu hình Camera",
            command=self.mo_cau_hinh_camera,
            **button_style
        )
        btn_camera.pack(side=tk.LEFT, padx=2)

        # Nút cấu hình chính sách giá
        btn_price = tk.Button(
            toolbar,
            text="Chính sách giá",
            command=self.mo_chinh_sach_gia,
            **button_style
        )
        btn_price.pack(side=tk.LEFT, padx=2)

        # Nút quản lý khu vực
        btn_parking_zone = tk.Button(
            toolbar,
            text="Quản lý khu vực",
            command=self.mo_quan_ly_khu_vuc,
            **button_style
        )
        btn_parking_zone.pack(side=tk.LEFT, padx=2)

        # Tạo separator
        tk.Frame(toolbar, width=2, bg="#1e293b").pack(side=tk.LEFT, fill=tk.Y, padx=10, pady=5)
        self.user_label = tk.Label(
            toolbar,
            text="Xin chào, Admin",
            font=("Helvetica", 11),
            bg="#0f172a",
            fg="white"
        )
        self.user_label.pack(side=tk.RIGHT, padx=15)

        btn_logout = tk.Button(
            toolbar,
            text="Đăng xuất",
            command=self.dang_xuat,
            **button_style
        )
        btn_logout.pack(side=tk.RIGHT, padx=2)

        # Nút cấu hình làm việc
        btn_work_config = tk.Button(
            toolbar,
            text="Cấu hình làm việc",
            command=self.mo_cau_hinh_lam_viec,
            **button_style
        )
        btn_work_config.pack(side=tk.LEFT, padx=2)

    def setup_tab_styles(self):
        """Thiết lập style cho tabs"""
        style = ttk.Style()
        style.configure("TNotebook", background="#f0f9ff", borderwidth=0)
        style.configure("TNotebook.Tab", background="#e0f2fe", foreground="grey", 
                       padding=[15, 5], font=('Helvetica', 11, 'bold'))
        style.map("TNotebook.Tab", background=[("selected", "#0369a1")], 
                 foreground=[("selected", "black")])
        style.configure("TFrame", background="#f0f9ff")

    def tao_tab_quan_ly(self):
        """Tạo tab quản lý xe với responsive layout"""
        # Configure grid weights for responsiveness
        self.tab_quan_ly.grid_rowconfigure(0, weight=1)
        self.tab_quan_ly.grid_columnconfigure(0, weight=2)  # Camera takes 60%
        self.tab_quan_ly.grid_columnconfigure(1, weight=1)  # Info takes 40%
        
        # Left panel - Camera component (responsive)
        bang_trai = tk.Frame(self.tab_quan_ly, bg="#ffffff")
        bang_trai.grid(row=0, column=0, sticky="nsew", padx=(10, 5), pady=10)
        
        self.camera_component = CameraComponent(bang_trai)

        # Right panel - Vehicle info component (responsive)  
        bang_phai = tk.Frame(self.tab_quan_ly, bg="#ffffff")
        bang_phai.grid(row=0, column=1, sticky="nsew", padx=(5, 10), pady=10)
        
        self.vehicle_info_component = VehicleInfoComponent(
            bang_phai, self.quan_ly_xe, self.quan_ly_camera, self.dau_doc_the
        )

    def tao_tab_danh_sach(self):
        """Tạo tab danh sách xe"""
        self.vehicle_list_component = VehicleListComponent(self.tab_danh_sach, self.quan_ly_xe)

    def setup_connections(self):
        """Thiết lập kết nối giữa các components"""
        # Kết nối camera với UI
        self.quan_ly_camera.dat_ui(self)
        self.quan_ly_xe.dat_ui(self)
        self.dau_doc_the.dat_ui(self)
        
        # Kết nối mode change callback
        self.vehicle_info_component.set_mode_change_callback(
            self.header_component.update_mode_display
        )
        
        # Load danh sách khu
        self.khu_hien_tai = self.header_component.tai_danh_sach_khu()
        if self.khu_hien_tai:
            self.camera_component.cap_nhat_camera_cong_theo_khu(self.khu_hien_tai)

        # Khi chọn khu vực mới
        def enhanced_callback(event=None):
            khu = original_callback(event) #type: ignore
            if khu:
                self.khu_hien_tai = khu
                self.camera_component.cap_nhat_camera_cong_theo_khu(khu)
        self.header_component.khi_chon_khu = enhanced_callback

        # --- Gọi hàm ẩn/hiện nút chế độ theo loại xe khi khởi động ---
        try:
    
            config = getattr(self, 'config_khoi_dong', None)
            if config and 'loai_xe' in config:
                print(f"[DEBUG] main_ui.setup_connections: Gọi hien_nut_theo_loai_xe với loai_xe={config['loai_xe']}")
                self.vehicle_info_component.hien_nut_theo_loai_xe(config['loai_xe'])
            else:
                print("[DEBUG] main_ui.setup_connections: Không có config ban đầu, hiển thị tất cả nút.")
                self.vehicle_info_component.hien_nut_theo_loai_xe(None)
        except Exception as e:
            print(f"[DEBUG] main_ui.setup_connections: Lỗi khi gọi hien_nut_theo_loai_xe: {e}")

    def start_services(self):
        """Khởi động các dịch vụ"""
        self.quan_ly_camera.bat_dau_camera()
        self.dau_doc_the.bat_dau_doc_the()

    # ===== CAMERA METHODS =====
    def cap_nhat_khung_camera_vao(self, anh):
        """Cập nhật khung hình camera vào"""
        self.camera_component.cap_nhat_khung_camera_vao(anh)
            
    def cap_nhat_khung_camera_ra(self, anh):
        """Cập nhật khung hình camera ra"""
        self.camera_component.cap_nhat_khung_camera_ra(anh)
    
    def cap_nhat_khung_camera_vao_face(self, anh):
        """Cập nhật khung hình camera vào face"""
        self.camera_component.cap_nhat_khung_camera_vao_face(anh)
    
    def cap_nhat_khung_camera_ra_face(self, anh):
        """Cập nhật khung hình camera ra face"""
        self.camera_component.cap_nhat_khung_camera_ra_face(anh)

    def hien_thi_anh_chup_tren_camera(self, duong_dan_anh, che_do="vao"):
        """Hiển thị ảnh chụp trực tiếp trên khung camera tương ứng"""
        self.camera_component.hien_thi_anh_chup_tren_camera(duong_dan_anh, che_do)

    def hien_thi_anh_chup_face_tren_camera(self, duong_dan_anh, che_do="vao"):
        """Hiển thị ảnh chụp face trực tiếp trên khung camera face"""
        self.camera_component.hien_thi_anh_chup_face_tren_camera(duong_dan_anh, che_do)

    def khoi_phuc_live_camera_feeds(self):
        """Khôi phục tất cả camera về chế độ live feed"""
        self.camera_component.khoi_phuc_live_camera_feeds()

    def hien_thi_anh_vao_sau_xe_ra_thanh_cong(self, anh_vao_url, anh_mat_vao_url):
        """Hiển thị ảnh xe vào và ảnh mặt vào sau khi xe ra thành công"""
        self.camera_component.hien_thi_anh_vao_sau_xe_ra_thanh_cong(anh_vao_url, anh_mat_vao_url)

    def cap_nhat_anh_gan_day(self, img):
        """Cập nhật ảnh gần đây nhất"""
        self.camera_component.cap_nhat_anh_gan_day(img)

    # ===== VEHICLE INFO METHODS =====
    def cap_nhat_thong_tin_xe(self, xe_info):
        """Cập nhật thông tin xe"""
        self.vehicle_info_component.update_vehicle_info(xe_info)

    def cap_nhat_trang_thai_dau_doc(self, trang_thai, color="#0369a1"):
        """Cập nhật trạng thái đầu đọc thẻ"""
        self.vehicle_info_component.update_card_reader_status(trang_thai, color)

    def xoa_thong_tin(self):
        """Xóa thông tin xe"""
        self.vehicle_info_component.xoa_thong_tin()

    def cap_nhat_trang_thai_xe_vao(self, ma_the, bien_so, success, error_message):
        """Cập nhật trạng thái xe vào"""
        if success:
            trang_thai = f"Xe vào thành công - Biển số: {bien_so}"
            color = "#0369a1"  # Màu xanh
        else:
            trang_thai = f"Lỗi xe vào: {error_message}"
            color = "#dc2626"  # Màu đỏ
        self.vehicle_info_component.update_vehicle_status(trang_thai, color)
        # Khôi phục camera sau khi quét
        self.khoi_phuc_live_camera_feeds()

    def cap_nhat_trang_thai_xe_ra(self, ma_the, bien_so, success, error_message):
        """Cập nhật trạng thái xe ra"""
        if success:
            trang_thai = f"Xe ra thành công - Biển số: {bien_so}"
            color = "#0369a1"  # Màu xanh
        else:
            trang_thai = f"Lỗi xe ra: {error_message}"
            color = "#dc2626"  # Màu đỏ
        self.vehicle_info_component.update_vehicle_status(trang_thai, color)
        # Khôi phục camera sau khi quét
        self.khoi_phuc_live_camera_feeds()

    # ===== VEHICLE LIST METHODS =====
    def cap_nhat_danh_sach_xe(self, danh_sach_xe, la_moi=True):
        """Cập nhật danh sách xe"""
        self.vehicle_list_component.cap_nhat_danh_sach_xe(danh_sach_xe)

    def cap_nhat_thong_ke(self, stats):
        """Cập nhật thống kê"""
        self.vehicle_list_component.cap_nhat_thong_ke(stats)

    # ===== LICENSE PLATE METHODS =====
    def cap_nhat_bien_so(self, bien_so):
        """Cập nhật hiển thị biển số"""
        self.camera_component.update_license_plate_display(bien_so)

    # ===== UTILITY METHODS =====
    def hien_thi_thong_bao(self, tieu_de, thong_bao):
        """Hiển thị thông báo"""
        messagebox.showinfo(tieu_de, thong_bao)
    
    def hien_thi_loi(self, tieu_de, thong_bao):
        """Hiển thị lỗi"""
        messagebox.showerror(tieu_de, thong_bao)

    def khi_dong_cua_so(self):
        """Xử lý khi đóng cửa sổ"""
        # Dừng camera
        self.quan_ly_camera.dung_camera()
        # Dừng đọc thẻ
        self.dau_doc_the.dung_doc_the()
        # Đóng cửa sổ
        self.root.destroy()

    # ===== BACKWARD COMPATIBILITY METHODS =====
    # Các method này để đảm bảo tương thích với code cũ
    
    @property
    def che_do_hien_tai(self):
        """Lấy chế độ hiện tại"""
        if hasattr(self, 'vehicle_info_component') and self.vehicle_info_component:
            return self.vehicle_info_component.che_do_hien_tai
        return self._che_do_hien_tai

    @che_do_hien_tai.setter 
    def che_do_hien_tai(self, value):
        """Đặt chế độ hiện tại"""
        self._che_do_hien_tai = value
        if hasattr(self, 'vehicle_info_component') and self.vehicle_info_component:
            self.vehicle_info_component.che_do_hien_tai = value

    @property
    def loai_xe_hien_tai(self):
        """Lấy loại xe hiện tại"""
        if hasattr(self, 'vehicle_info_component') and self.vehicle_info_component:
            return self.vehicle_info_component.loai_xe_hien_tai
        return getattr(self, '_loai_xe_hien_tai', 'xe_may')

    @loai_xe_hien_tai.setter
    def loai_xe_hien_tai(self, value):
        """Đặt loại xe hiện tại"""
        self._loai_xe_hien_tai = value
        if hasattr(self, 'vehicle_info_component') and self.vehicle_info_component:
            self.vehicle_info_component.loai_xe_hien_tai = value

    @property
    def trang_thai_dau_doc(self):
        """Lấy widget trạng thái đầu đọc"""
        return self.vehicle_info_component.trang_thai_dau_doc

    @property 
    def khung_hien_thi_bien_so(self):
        """Lấy widget hiển thị biển số"""
        return self.camera_component.khung_hien_thi_bien_so

    @property
    def nhan_bien_so(self):
        """Lấy label biển số"""
        return self.vehicle_info_component.nhan_bien_so

    @property
    def nhan_gio_vao(self):
        """Lấy label giờ vào"""
        return self.vehicle_info_component.nhan_gio_vao

    @property
    def nhan_gio_ra(self):
        """Lấy label giờ ra"""
        return self.vehicle_info_component.nhan_gio_ra

    @property
    def nhan_ma_the(self):
        """Lấy label mã thẻ"""
        return self.vehicle_info_component.nhan_ma_the

    @property
    def nhan_thoi_gian_do(self):
        """Lấy label thời gian đỗ"""
        return self.vehicle_info_component.nhan_thoi_gian_do

    @property
    def nhan_phi(self):
        """Lấy label phí"""
        return self.vehicle_info_component.nhan_phi

    @property
    def nhan_chinh_sach(self):
        """Lấy label chính sách"""
        return self.vehicle_info_component.nhan_chinh_sach

    @property
    def nhan_cong_vao_info(self):
        """Lấy label cổng vào"""
        return self.vehicle_info_component.nhan_cong_vao_info

    @property
    def nhan_cong_ra_info(self):
        """Lấy label cổng ra"""
        return self.vehicle_info_component.nhan_cong_ra_info

    @property
    def nhan_trang_thai(self):
        """Lấy label trạng thái"""
        return self.vehicle_info_component.nhan_trang_thai

    @property
    def bang_danh_sach_xe(self):
        """Lấy bảng danh sách xe"""
        return self.vehicle_list_component.bang_danh_sach_xe

    def hien_thi_anh_xe_vao_trong_xac_nhan_ra(self, anh_vao_url, bien_so_vao, ma_the):
        """Hiển thị ảnh xe vào trong xác nhận ra"""
        self.vehicle_info_component.hien_thi_anh_xe_vao_trong_xac_nhan_ra(anh_vao_url, bien_so_vao, ma_the)

    def hien_thi_placeholder_anh_xe_vao_don_gian(self, bien_so_vao, ma_the):
        """Hiển thị placeholder ảnh xe vào đơn giản"""
        self.vehicle_info_component.hien_thi_placeholder_anh_xe_vao_don_gian(bien_so_vao, ma_the)

    def khoi_phuc_khung_xac_nhan_ra_ban_dau(self):
        """Khôi phục khung xác nhận ra ban đầu"""
        self.vehicle_info_component.khoi_phuc_khung_xac_nhan_ra_ban_dau()

    def mo_cau_hinh_camera(self):
        """Mở dialog cấu hình camera"""
        from dialogs.CameraConfigDialog import CameraConfigDialog
        config_dialog = CameraConfigDialog(self.root)
        ket_qua = config_dialog.show()
        if ket_qua == "save":
            # Cập nhật lại camera nếu cần
            self.quan_ly_camera.cap_nhat_cau_hinh()

    def mo_chinh_sach_gia(self):
        """Mở dialog cấu hình chính sách giá"""
        from dialogs.PricingPolicyDialog import PricingPolicyDialog
        try:
            import server.api as api
            policies = api.layALLChinhSachGia()
            if not policies:
                messagebox.showwarning("Cảnh báo", "Không có dữ liệu chính sách giá")
                return
                
            PricingPolicyDialog(self.root)
        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể mở cấu hình chính sách giá: {str(e)}")    
    def mo_quan_ly_khu_vuc(self):
        """Mở dialog quản lý khu vực"""
        try:
            from dialogs.ParkingZoneDialog import ParkingZoneDialog
            dialog = ParkingZoneDialog(parent=self.root)
        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể mở quản lý khu vực: {str(e)}")
            return

    def dang_xuat(self):
        """Xử lý đăng xuất"""
        if messagebox.askyesno("Xác nhận", "Bạn có chắc muốn đăng xuất?"):
            # Dừng các dịch vụ
            self.quan_ly_camera.dung_camera()
            self.dau_doc_the.dung_doc_the()
            # Đóng cửa sổ chính
            self.root.destroy()
            import os
            import sys
            os.execl(sys.executable, sys.executable, *sys.argv)

    def cleanup(self):
        """Dọn dẹp tài nguyên trước khi thoát"""
        try:
            # Hủy các timer nếu có
            if hasattr(self, 'camera_component'):
                self.camera_component.cleanup()
                
            # Dừng các services
            if self.quan_ly_camera:
                self.quan_ly_camera.stop()
            if self.quan_ly_xe:
                self.quan_ly_xe.stop()
            if self.dau_doc_the:
                self.dau_doc_the.stop()
        except:
            pass

    def cap_nhat_che_do_theo_config(self, config):
        print("[DEBUG] ĐÃ VÀO cap_nhat_che_do_theo_config")
        loai_xe = config.get('loai_xe')
        print(f"[DEBUG] main_ui.cap_nhat_che_do_theo_config: loai_xe={loai_xe}, config={config}")
        if loai_xe:
            self.loai_xe_hien_tai = loai_xe
            self.vehicle_info_component.hien_nut_theo_loai_xe(loai_xe)
        else:
            print("[DEBUG] Không tìm thấy loai_xe trong config, hiển thị tất cả nút.")
            self.vehicle_info_component.hien_nut_theo_loai_xe(None)

    def mo_cau_hinh_lam_viec(self):
        """Mở WorkConfigDialog và cập nhật UI theo config mới"""
        from dialogs.WorkConfigDialog import WorkConfigDialog
        def on_config_saved(config):
            print(f"[DEBUG] main_ui.mo_cau_hinh_lam_viec: Nhận config từ WorkConfigDialog: {config}")
            # Gọi cập nhật UI sau 100ms để đảm bảo widget đã render xong
            self.root.after(100, lambda: self.cap_nhat_che_do_theo_config(config))
        dialog = WorkConfigDialog(self.root, on_config_saved=on_config_saved)
        dialog.grab_set()

    def load_work_config_and_update_ui(self):
        """Đọc file work_config.json và cập nhật UI theo config lưu trước đó"""
        config_path = os.path.join(os.path.dirname(__file__), '../server/config/work_config.json')
        try:
            if os.path.exists(config_path):
                with open(config_path, 'r', encoding='utf-8') as f:
                    config = json.load(f)
                print(f"[DEBUG] Đọc work_config.json thành công: {config}")
                self.cap_nhat_che_do_theo_config(config)
                # Nếu có mã khu vực, cập nhật camera_component
                ma_khu_vuc = config.get('ma_khu_vuc')
                if ma_khu_vuc:
                    print(f"[DEBUG] load_work_config_and_update_ui: Gọi cap_nhat_camera_cong_theo_khu với ma_khu_vuc={ma_khu_vuc}")
                    self.camera_component.cap_nhat_camera_cong_theo_khu(ma_khu_vuc)
            else:
                print(f"[DEBUG] Không tìm thấy file work_config.json tại {config_path}")
        except Exception as e:
            print(f"[DEBUG] Lỗi đọc work_config.json: {e}")

    def reload_main_ui(self, event=None):
        """Reload toàn bộ trang làm việc chính khi bấm F5"""
        import os
        import sys
        os.execl(sys.executable, sys.executable, *sys.argv)

    def bind_reload_shortcut(self):
        """Bind phím F5 để reload giao diện chính"""
        self.root.bind('<F5>', self.reload_main_ui)
