import tkinter as tk
from tkinter import ttk
from PIL import Image, ImageTk
import os

class VehicleInfoComponent:
    def __init__(self, parent, quan_ly_xe, quan_ly_camera, dau_doc_the):
        self.parent = parent
        self.quan_ly_xe = quan_ly_xe
        self.quan_ly_camera = quan_ly_camera
        self.dau_doc_the = dau_doc_the
        self.che_do_hien_tai = "vao"
        self.loai_xe_hien_tai = "xe_may"
        self.create_vehicle_info_panel()

    def create_vehicle_info_panel(self):
        """Tạo panel thông tin xe với responsive design"""
        # Configure parent for responsive layout
        self.parent.grid_rowconfigure(0, weight=1)
        self.parent.grid_rowconfigure(1, weight=0)  # Card reader
        self.parent.grid_rowconfigure(2, weight=0)  # Mode buttons
        self.parent.grid_rowconfigure(3, weight=0)  # Confirmation frame
        self.parent.grid_columnconfigure(0, weight=1)
          # Info frame with rounded corners
        style = ttk.Style()
        style.configure('Rounded.TLabelframe', 
                       background='#f0f9ff',
                       borderwidth=2,
                       relief='groove')
        style.configure('Rounded.TLabelframe.Label',
                       font=("Helvetica", 12, "bold"),
                       foreground='#0369a1',
                       background='#f0f9ff')
        
        khung_thong_tin = ttk.LabelFrame(
            self.parent,
            text="Thông Tin Xe",
            padding=(5, 5, 5, 5),
            style='Rounded.TLabelframe'
        )
        
        # Create canvas for rounded corners
        canvas = tk.Canvas(khung_thong_tin,
                          background='#f0f9ff',
                          bd=0,
                          highlightthickness=0,
                          relief='ridge')
        canvas.place(x=0, y=0, relwidth=1, relheight=1)
        
        # Function to create rounded rectangle
        def create_rounded_rect(x1, y1, x2, y2, radius=25):
            points = [
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
                x1, y1
            ]
            return canvas.create_polygon(points, smooth=True, fill='#f0f9ff')
        khung_thong_tin.grid(row=0, column=0, sticky="nsew", pady=(0, 5))
        
        khung_truong = tk.Frame(khung_thong_tin, bg="#f0f9ff")
        khung_truong.pack(fill=tk.BOTH, expand=True, pady=5)
        
        # Fields
        self.create_info_fields(khung_truong)
        
        # Reader frame
        self.create_card_reader_frame()
        
        # Mode selection buttons
        self.create_mode_buttons()

        # Confirmation frame
        self.create_confirmation_frame()

    def create_info_fields(self, parent):
        """Tạo các trường thông tin"""
        # Define all fields but only display Trạng thái
        fields = [
            ("Trạng thái:", "nhan_trang_thai"),
            ("Biển số xe:", "nhan_bien_so"),
            ("Giờ vào:", "nhan_gio_vao"), 
            ("Giờ ra:", "nhan_gio_ra"),
            ("Mã thẻ:", "nhan_ma_the"),
            ("Thời gian đỗ:", "nhan_thoi_gian_do"),
            ("Phí gửi xe:", "nhan_phi"),
            ("Chính sách giá:", "nhan_chinh_sach"),
            ("Cổng vào:", "nhan_cong_vao_info"),
            ("Cổng ra:", "nhan_cong_ra_info")
        ]
        
        for i, (label_text, attr_name) in enumerate(fields):
            # Create label and field for Trạng thái only
            if attr_name == "nhan_trang_thai":
                tk.Label(parent, text=label_text, font=("Helvetica", 11, "bold"), 
                        bg="#f0f9ff", fg="#0f172a").grid(row=0, column=0, sticky="w", pady=5)
                
                label = tk.Label(parent, text="", font=("Helvetica", 11), 
                               bg="white", width=20, anchor="w", padx=5, 
                               relief=tk.SUNKEN, bd=1)
                label.grid(row=0, column=1, sticky="w", pady=5)
                setattr(self, attr_name, label)
            else:
                # Create invisible labels for other fields to maintain functionality
                label = tk.Label(parent, text="")
                setattr(self, attr_name, label)

        # Create but don't display the total fee label
        self.nhan_phi_lon = tk.Label(parent, text="0 VND", font=("Helvetica", 16, "bold"))

    def create_card_reader_frame(self):
        """Tạo khung đầu đọc thẻ với responsive design"""
        khung_dau_doc = tk.LabelFrame(
            self.parent, text="Đầu Đọc Thẻ", font=("Helvetica", 12, "bold"), 
            bg="#f0f9ff", fg="#0369a1", padx=5, pady=5, 
            relief=tk.GROOVE, bd=2
        )
        khung_dau_doc.grid(row=1, column=0, sticky="ew", pady=(5, 5))
        
        self.trang_thai_dau_doc = tk.Label(
            khung_dau_doc, text="Đang chờ quẹt thẻ...", 
            font=("Helvetica", 11, "bold"), fg="#0369a1", bg="#e0f2fe",
            pady=8, relief=tk.RIDGE, bd=1
        )
        self.trang_thai_dau_doc.pack(fill=tk.X, padx=5, pady=5)

    def create_mode_buttons(self):
        """Tạo 1 nút chuyển chế độ duy nhất"""
        khung_che_do = tk.LabelFrame(
            self.parent, text="Chế Độ Hoạt Động", font=("Helvetica", 12, "bold"), 
            bg="#f0f9ff", fg="#0369a1", padx=5, pady=5, 
            relief=tk.GROOVE, bd=2
        )
        khung_che_do.grid(row=2, column=0, sticky="ew", pady=(5, 0))
        khung_che_do.grid_columnconfigure(0, weight=1)

        # Mặc định cho phép cả hai loại xe
        self.allowed_vehicle_types = ["xe_may", "oto"]

        self.btn_mode = tk.Button(
            khung_che_do,
            text=self._get_mode_text(),
            font=("Helvetica", 12, "bold"),
            bg="#10b981", fg="white", padx=15, pady=8, relief=tk.RAISED, bd=2,
            cursor="hand2", activebackground="#059669", activeforeground="white",
            command=self.switch_mode
        )
        self.btn_mode.grid(row=0, column=0, sticky="ew", padx=5, pady=5)

    def _get_mode_text(self):
        if self.che_do_hien_tai == "vao" and self.loai_xe_hien_tai == "xe_may":
            return "Xe máy vào"
        elif self.che_do_hien_tai == "ra" and self.loai_xe_hien_tai == "xe_may":
            return "Xe máy ra"
        elif self.che_do_hien_tai == "vao" and self.loai_xe_hien_tai == "oto":
            return "Xe hơi vào"
        else:
            return "Xe hơi ra"

    def switch_mode(self):
        # Chỉ chuyển đổi trong allowed_vehicle_types
        vt = self.allowed_vehicle_types
        if len(vt) == 1:
            # Chỉ 1 loại xe, chỉ chuyển vào/ra
            if self.che_do_hien_tai == "vao":
                self.che_do_hien_tai = "ra"
            else:
                self.che_do_hien_tai = "vao"
            self.loai_xe_hien_tai = vt[0]
        else:
            # Đủ 2 loại xe, chuyển 4 trạng thái
            if self.che_do_hien_tai == "vao" and self.loai_xe_hien_tai == "xe_may":
                self.che_do_hien_tai = "ra"
                self.loai_xe_hien_tai = "xe_may"
            elif self.che_do_hien_tai == "ra" and self.loai_xe_hien_tai == "xe_may":
                self.che_do_hien_tai = "vao"
                self.loai_xe_hien_tai = "oto"
            elif self.che_do_hien_tai == "vao" and self.loai_xe_hien_tai == "oto":
                self.che_do_hien_tai = "ra"
                self.loai_xe_hien_tai = "oto"
            else:
                self.che_do_hien_tai = "vao"
                self.loai_xe_hien_tai = "xe_may"
        self.btn_mode.config(text=self._get_mode_text())
        self.xoa_thong_tin()
        self.dau_doc_the.dang_quet = False
        self.quan_ly_camera.chuyen_doi_camera(self.che_do_hien_tai)
        self.notify_mode_change()
        if self.parent and hasattr(self.parent, 'khoi_phuc_live_camera_feeds'):
            self.parent.khoi_phuc_live_camera_feeds()

    def hien_nut_theo_loai_xe(self, loai_xe):
        """Cập nhật loại xe được phép chuyển chế độ (chỉ 1 nút duy nhất)"""
        if loai_xe == "xe_may":
            self.allowed_vehicle_types = ["xe_may"]
            self.che_do_hien_tai = "vao"
            self.loai_xe_hien_tai = "xe_may"
        elif loai_xe == "oto":
            self.allowed_vehicle_types = ["oto"]
            self.che_do_hien_tai = "vao"
            self.loai_xe_hien_tai = "oto"
        else:
            self.allowed_vehicle_types = ["xe_may", "oto"]
        self.btn_mode.config(text=self._get_mode_text())

    def notify_mode_change(self):
        """Thông báo thay đổi chế độ cho các component khác"""
        # Callback để thông báo cho header component
        if hasattr(self, 'on_mode_change_callback') and self.on_mode_change_callback:
            self.on_mode_change_callback(self.che_do_hien_tai, self.loai_xe_hien_tai)

    def set_mode_change_callback(self, callback):
        """Đặt callback cho việc thay đổi chế độ"""
        self.on_mode_change_callback = callback

    def xoa_thong_tin(self):
        """Xóa thông tin hiển thị"""
        self.nhan_bien_so.config(text="")
        self.nhan_gio_vao.config(text="")
        self.nhan_gio_ra.config(text="")
        self.nhan_ma_the.config(text="")
        self.nhan_thoi_gian_do.config(text="")
        self.nhan_phi.config(text="")
        self.nhan_chinh_sach.config(text="")
        self.nhan_cong_vao_info.config(text="")
        self.nhan_cong_ra_info.config(text="")
        self.nhan_trang_thai.config(text="")
        self.nhan_phi_lon.config(text="0 VND") # Clear the new prominent fee label

    def kiem_tra_bien_so(self):
        """Kiểm tra biển số xe"""
        if self.quan_ly_xe.xe_hien_tai:
            khung_chup, bien_so_phat_hien = self.quan_ly_camera.chup_anh()
            if khung_chup is not None:
                self.quan_ly_xe.kiem_tra_bien_so(bien_so_phat_hien)
        else:
            from tkinter import messagebox
            messagebox.showinfo("Thông báo", "Vui lòng chọn một xe từ danh sách để kiểm tra biển số.")

    def update_vehicle_info(self, xe_info):
        """Cập nhật thông tin xe trên giao diện"""
        if xe_info:
            self.nhan_bien_so.config(text=xe_info.get('bienSo', ''))
            self.nhan_gio_vao.config(text=xe_info.get('gioVao', ''))
            self.nhan_gio_ra.config(text=xe_info.get('gioRa', ''))
            self.nhan_ma_the.config(text=xe_info.get('maThe', ''))
            self.nhan_thoi_gian_do.config(text=xe_info.get('thoiGianDo', ''))
            self.nhan_phi.config(text=xe_info.get('phi', ''))
            self.nhan_chinh_sach.config(text=xe_info.get('chinhSach', ''))
            self.nhan_cong_vao_info.config(text=xe_info.get('congVao', ''))
            self.nhan_cong_ra_info.config(text=xe_info.get('congRa', ''))
            self.nhan_trang_thai.config(text=xe_info.get('trangThai', ''))

    def cap_nhat_phi_gui_xe(self, phi):
        """Cập nhật hiển thị phí gửi xe"""
        print(f"🔍 DEBUG (VehicleInfoComponent.cap_nhat_phi_gui_xe): Nhận được giá trị phí: {phi}")
        try:
            phi_formatted = f"{int(float(phi)):,} VND"
            self.nhan_phi.config(text=phi_formatted)
            self.nhan_phi_lon.config(text=phi_formatted) # Update the new prominent fee label
        except Exception as e:
            print(f"Lỗi cập nhật phí gửi xe: {e}")
            self.nhan_phi.config(text=str(phi))
            self.nhan_phi_lon.config(text=str(phi))

    def update_card_reader_status(self, status, color="#0369a1"):
        """Cập nhật trạng thái đầu đọc thẻ"""
        self.trang_thai_dau_doc.config(text=status, fg=color)

    def hien_thi_anh_xe_vao_trong_xac_nhan_ra(self, anh_vao_url, bien_so_vao, ma_the):
        """Hiển thị ảnh xe vào trong xác nhận ra"""
        try:
            if not anh_vao_url or not os.path.exists(anh_vao_url):
                print(f"Ảnh không tồn tại: {anh_vao_url}")
                return
                
            anh_pil = Image.open(anh_vao_url)
            anh_resize = anh_pil.resize((450, 330), Image.Resampling.LANCZOS)
            anh_tk = ImageTk.PhotoImage(anh_resize)
            
            # Hiển thị ảnh trong khung xác nhận
            self.khung_xac_nhan_ra.config(image=anh_tk)
            self.khung_xac_nhan_ra.image = anh_tk
            
            # Cập nhật thông tin
            self.nhan_bien_so_vao.config(text=f"Biển số vào: {bien_so_vao}")
            self.nhan_ma_the_vao.config(text=f"Mã thẻ: {ma_the}")
            
        except Exception as e:
            print(f"Lỗi hiển thị ảnh xe vào trong xác nhận ra: {e}")

    def hien_thi_placeholder_anh_xe_vao_don_gian(self, bien_so_vao, ma_the):
        """Hiển thị placeholder ảnh xe vào đơn giản"""
        try:
            # Tạo ảnh placeholder
            anh_placeholder = Image.new('RGB', (450, 330), color='#333333')
            anh_tk = ImageTk.PhotoImage(anh_placeholder)
            
            # Hiển thị ảnh trong khung xác nhận
            self.khung_xac_nhan_ra.config(image=anh_tk)
            self.khung_xac_nhan_ra.image = anh_tk
            
            # Cập nhật thông tin
            self.nhan_bien_so_vao.config(text=f"Biển số vào: {bien_so_vao}")
            self.nhan_ma_the_vao.config(text=f"Mã thẻ: {ma_the}")
            
        except Exception as e:
            print(f"Lỗi hiển thị placeholder ảnh xe vào: {e}")

    def khoi_phuc_khung_xac_nhan_ra_ban_dau(self):
        """Khôi phục khung xác nhận ra ban đầu"""
        try:
            # Xóa ảnh
            self.khung_xac_nhan_ra.config(image='')
            self.khung_xac_nhan_ra.image = None
            
            # Xóa thông tin
            self.nhan_bien_so_vao.config(text="")
            self.nhan_ma_the_vao.config(text="")
            
        except Exception as e:
            print(f"Lỗi khôi phục khung xác nhận ra: {e}")

    def create_confirmation_frame(self):
        """Tạo khung xác nhận xe ra"""
        khung_xac_nhan = tk.LabelFrame(
            self.parent, text="Xác Nhận Xe Ra", font=("Helvetica", 12, "bold"), 
            bg="#f0f9ff", fg="#0369a1", padx=5, pady=5, 
            relief=tk.GROOVE, bd=2
        )
        khung_xac_nhan.grid(row=3, column=0, sticky="ew", pady=(5, 0))

        # Khung hiển thị ảnh
        self.khung_xac_nhan_ra = tk.Label(khung_xac_nhan, bg="white")
        self.khung_xac_nhan_ra.pack(fill=tk.BOTH, expand=True, padx=5, pady=5)

        # Load ảnh mặc định từ assets/sof.png
        try:
            default_image_path = os.path.join("assets", "sof.png")
            if os.path.exists(default_image_path):
                anh_pil = Image.open(default_image_path)
                anh_resize = anh_pil.resize((450, 330), Image.Resampling.LANCZOS)
                anh_tk = ImageTk.PhotoImage(anh_resize)
                self.khung_xac_nhan_ra.config(image=anh_tk)
                self.khung_xac_nhan_ra.image = anh_tk  # Giữ reference để tránh garbage collection
                print(f"✅ Đã load ảnh mặc định từ {default_image_path}")
            else:
                print(f"❌ Không tìm thấy ảnh mặc định tại {default_image_path}")
        except Exception as e:
            print(f"❌ Lỗi load ảnh mặc định: {e}")

        # Khung thông tin
        khung_thong_tin = tk.Frame(khung_xac_nhan, bg="#f0f9ff")
        khung_thong_tin.pack(fill=tk.X, padx=5, pady=5)

        self.nhan_bien_so_vao = tk.Label(
            khung_thong_tin, text="", font=("Helvetica", 11, "bold"),
            bg="#f0f9ff", fg="#0369a1"
        )
        self.nhan_bien_so_vao.pack(anchor="w")

        self.nhan_ma_the_vao = tk.Label(
            khung_thong_tin, text="", font=("Helvetica", 11, "bold"),
            bg="#f0f9ff", fg="#0369a1"
        )
        self.nhan_ma_the_vao.pack(anchor="w")

    def update_vehicle_status(self, trang_thai, color="#0369a1"):
        """Cập nhật trạng thái xe"""
        self.nhan_trang_thai.config(text=trang_thai, fg=color)
        # Tự động xóa trạng thái sau 5 giây
        self.parent.after(5000, self.xoa_trang_thai)

    def xoa_trang_thai(self):
        """Xóa trạng thái"""
        self.nhan_trang_thai.config(text="")
