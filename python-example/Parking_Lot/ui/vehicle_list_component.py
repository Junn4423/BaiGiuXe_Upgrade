import tkinter as tk
from tkinter import ttk

class VehicleListComponent:
    def __init__(self, parent, quan_ly_xe):
        self.parent = parent
        self.quan_ly_xe = quan_ly_xe
        self.create_vehicle_list_tab()

    def create_vehicle_list_tab(self):
        """Tạo tab danh sách xe với responsive design"""
        # Configure parent grid
        self.parent.grid_rowconfigure(0, weight=0)  # Statistics
        self.parent.grid_rowconfigure(1, weight=0)  # Search/Filter  
        self.parent.grid_rowconfigure(2, weight=1)  # Vehicle table
        self.parent.grid_columnconfigure(0, weight=1)
          # Statistics frame with rounded corners
        style = ttk.Style()
        style.configure('Rounded.TFrame', 
                       background='#f0f9ff',
                       borderwidth=2,
                       relief='groove')
        
        khung_thong_ke = ttk.Frame(
            self.parent,
            style='Rounded.TFrame',
            padding=(5, 5, 5, 5)
        )
        khung_thong_ke.grid(row=0, column=0, sticky="ew", padx=10, pady=(10, 5))
        
        # Create canvas for rounded corners
        canvas = tk.Canvas(khung_thong_ke,
                          background='#f0f9ff',
                          bd=0,
                          highlightthickness=0)
        canvas.place(x=0, y=0, relwidth=1, relheight=1)
        
        def create_rounded_corners(widget, radius=25):
            x1, y1, x2, y2 = 0, 0, widget.winfo_width(), widget.winfo_height()
            canvas.create_polygon(
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
                smooth=True,
                fill='#f0f9ff'
            )
        
        # Bind to configure event to update corners when widget resizes
        khung_thong_ke.bind('<Configure>', lambda e: create_rounded_corners(khung_thong_ke))
        
        # Statistics cards
        self.create_statistics_cards(khung_thong_ke)
        
        # Search and filter frame
        self.create_search_filter_frame()
        
        # Vehicle table frame
        self.create_vehicle_table()

    def create_statistics_cards(self, parent):
        """Tạo các thẻ thống kê"""
        stats = [
            ("Tổng số xe:", "0", 0),
            ("Xe trong bãi:", "0", 1), 
            ("Tổng doanh thu:", "0 VND", 2),
            ("Xe máy / Xe hơi:", "0 / 0", 3)
        ]
        
        for tieu_de, gia_tri, cot in stats:
            self.tao_the_thong_ke(parent, tieu_de, gia_tri, cot)

    def tao_the_thong_ke(self, parent, tieu_de, gia_tri, cot):
        """Tạo một thẻ thống kê"""
        khung_the = tk.Frame(parent, bg="white", bd=2, relief=tk.RAISED)
        khung_the.grid(row=0, column=cot, padx=5, pady=5, sticky="nsew")
        
        nhan_tieu_de = tk.Label(
            khung_the, text=tieu_de, font=("Helvetica", 10, "bold"), 
            bg="#e0f2fe", fg="#0f172a", width=15, pady=5
        )
        nhan_tieu_de.pack(fill=tk.X)
        
        nhan_gia_tri = tk.Label(
            khung_the, text=gia_tri, font=("Helvetica", 14, "bold"), 
            bg="white", fg="#0369a1", pady=10
        )
        nhan_gia_tri.pack(fill=tk.X)
        
        # Lưu tham chiếu đến nhãn giá trị
        setattr(self, f"nhan_thong_ke_{cot}", nhan_gia_tri)
        
        # Đảm bảo các cột có kích thước bằng nhau
        parent.grid_columnconfigure(cot, weight=1)

    def create_search_filter_frame(self):
        """Tạo frame tìm kiếm và lọc với responsive design"""
        khung_tim_kiem = tk.LabelFrame(
            self.parent, text="Tìm Kiếm & Lọc", font=("Helvetica", 12, "bold"), 
            bg="#f0f9ff", fg="#0369a1", padx=10, pady=5, 
            relief=tk.GROOVE, bd=2
        )
        khung_tim_kiem.grid(row=1, column=0, sticky="ew", padx=10, pady=(5, 5))
        
        # Configure grid for search frame
        khung_tim_kiem.grid_columnconfigure(1, weight=1)
        
        # Search row
        tk.Label(khung_tim_kiem, text="Tìm kiếm:", font=("Helvetica", 11, "bold"), 
                bg="#f0f9ff", fg="#0f172a").grid(row=0, column=0, sticky="w", padx=(0, 5), pady=5)        
        self.o_tim_kiem = tk.Entry(khung_tim_kiem, width=30, font=("Helvetica", 11), 
                                  relief=tk.SUNKEN, bd=2)
        self.o_tim_kiem.grid(row=0, column=1, sticky="ew", padx=(0, 10), pady=5)
        self.o_tim_kiem.bind("<KeyRelease>", self.tim_kiem_xe)
        
        # Filter row
        tk.Label(khung_tim_kiem, text="Loại xe:", font=("Helvetica", 11, "bold"), 
                bg="#f0f9ff", fg="#0f172a").grid(row=1, column=0, sticky="w", padx=(0, 5), pady=5)        
        # Filter frame for radio buttons
        khung_loc_loai = tk.Frame(khung_tim_kiem, bg="#f0f9ff")
        khung_loc_loai.grid(row=1, column=1, sticky="ew", pady=5)
        
        self.loai_xe_var = tk.StringVar(value="tat_ca")
        
        # Tạo style cho Radiobutton
        style = ttk.Style()
        style.configure("TRadiobutton", background="#f0f9ff", font=("Helvetica", 11))
        
        ttk.Radiobutton(khung_loc_loai, text="Tất cả", variable=self.loai_xe_var, 
                       value="tat_ca", command=self.loc_danh_sach_xe, 
                       style="TRadiobutton").grid(row=0, column=0, sticky="w", padx=(0, 10))
        ttk.Radiobutton(khung_loc_loai, text="Xe máy", variable=self.loai_xe_var, 
                       value="xe_may", command=self.loc_danh_sach_xe, 
                       style="TRadiobutton").grid(row=0, column=1, sticky="w", padx=(0, 10))
        ttk.Radiobutton(khung_loc_loai, text="Xe hơi", variable=self.loai_xe_var, 
                       value="oto", command=self.loc_danh_sach_xe, 
                       style="TRadiobutton").grid(row=0, column=2, sticky="w", padx=(0, 10))
        
        # Status filter row
        tk.Label(khung_tim_kiem, text="Trạng thái:", font=("Helvetica", 11, "bold"), 
                bg="#f0f9ff", fg="#0f172a").grid(row=2, column=0, sticky="w", padx=(0, 5), pady=5)
        
        khung_loc_trang_thai = tk.Frame(khung_tim_kiem, bg="#f0f9ff")
        khung_loc_trang_thai.grid(row=2, column=1, sticky="ew", pady=5)
        
        self.trang_thai_var = tk.StringVar(value="tat_ca")
        ttk.Radiobutton(khung_loc_trang_thai, text="Tất cả", variable=self.trang_thai_var, 
                       value="tat_ca", command=self.loc_danh_sach_xe, 
                       style="TRadiobutton").grid(row=0, column=0, sticky="w", padx=(0, 10))
        ttk.Radiobutton(khung_loc_trang_thai, text="Trong bãi", variable=self.trang_thai_var, 
                       value="trong_bai", command=self.loc_danh_sach_xe, 
                       style="TRadiobutton").grid(row=0, column=1, sticky="w", padx=(0, 10))
        ttk.Radiobutton(khung_loc_trang_thai, text="Đã ra", variable=self.trang_thai_var, 
                       value="da_ra", command=self.loc_danh_sach_xe, 
                       style="TRadiobutton").grid(row=0, column=2, sticky="w", padx=(0, 10))

    def create_vehicle_table(self):
        """Tạo bảng danh sách xe với responsive design"""
        khung_bang = tk.LabelFrame(
            self.parent, text="Danh Sách Xe", font=("Helvetica", 12, "bold"), 
            bg="#f0f9ff", fg="#0369a1", padx=10, pady=5, relief=tk.GROOVE, bd=2
        )
        khung_bang.grid(row=2, column=0, sticky="nsew", padx=10, pady=(5, 10))
        
        # Create inner frame for table and scrollbar using pack
        table_frame = tk.Frame(khung_bang, bg="#f0f9ff")
        table_frame.pack(fill=tk.BOTH, expand=True)
        
        # Tạo style cho Treeview
        style = ttk.Style()
        style.configure("Treeview", 
                        background="#ffffff", 
                        foreground="#333333", 
                        rowheight=25, 
                        fieldbackground="#ffffff",
                        font=("Helvetica", 10))
        style.configure("Treeview.Heading", 
                        font=("Helvetica", 11, "bold"), 
                        background="#e0f2fe", 
                        foreground="#0f172a")
        style.map("Treeview", background=[("selected", "#0369a1")], 
                 foreground=[("selected", "white")])
        
        # Tạo bảng danh sách xe
        columns = ("bien_so", "loai_xe", "gio_vao", "gio_ra", "ma_the", 
                  "thoi_gian_do", "phi", "cong_vao", "cong_ra", "trang_thai")
        self.bang_danh_sach_xe = ttk.Treeview(table_frame, columns=columns, 
                                             show="headings", height=15)
        
        # Định nghĩa tiêu đề
        headings = {
            "bien_so": "Biển Số",
            "loai_xe": "Loại Xe", 
            "gio_vao": "Giờ Vào",
            "gio_ra": "Giờ Ra",
            "ma_the": "Mã Thẻ",
            "thoi_gian_do": "Thời Gian Đỗ",
            "phi": "Phí",
            "cong_vao": "Cổng Vào",
            "cong_ra": "Cổng Ra",
            "trang_thai": "Trạng Thái"
        }
        
        for col, heading in headings.items():
            self.bang_danh_sach_xe.heading(col, text=heading)
        
        # Định nghĩa độ rộng cột
        column_widths = {
            "bien_so": 100,
            "loai_xe": 80,
            "gio_vao": 120,
            "gio_ra": 120,
            "ma_the": 80,
            "thoi_gian_do": 100,
            "phi": 100,
            "cong_vao": 80,
            "cong_ra": 80,
            "trang_thai": 80
        }
        
        for col, width in column_widths.items():
            self.bang_danh_sach_xe.column(col, width=width)
        
        # Thêm thanh cuộn
        thanh_cuon = ttk.Scrollbar(table_frame, orient=tk.VERTICAL, 
                                  command=self.bang_danh_sach_xe.yview)
        self.bang_danh_sach_xe.configure(yscroll=thanh_cuon.set)
        thanh_cuon.pack(side=tk.RIGHT, fill=tk.Y)
        self.bang_danh_sach_xe.pack(side=tk.LEFT, fill=tk.BOTH, expand=True)
        
        # Gắn sự kiện chọn
        self.bang_danh_sach_xe.bind("<<TreeviewSelect>>", self.khi_chon_xe)

    def tim_kiem_xe(self, event=None):
        """Tìm kiếm xe theo từ khóa"""
        if hasattr(self.quan_ly_xe, 'tim_kiem_xe'):
            keyword = self.o_tim_kiem.get()
            self.quan_ly_xe.tim_kiem_xe(keyword)

    def loc_danh_sach_xe(self):
        """Lọc danh sách xe theo loại và trạng thái"""
        if hasattr(self.quan_ly_xe, 'loc_danh_sach_xe'):
            loai_xe = self.loai_xe_var.get()
            trang_thai = self.trang_thai_var.get()
            self.quan_ly_xe.loc_danh_sach_xe(loai_xe, trang_thai)

    def khi_chon_xe(self, event=None):
        """Xử lý khi chọn xe từ danh sách"""
        selection = self.bang_danh_sach_xe.selection()
        if selection and hasattr(self.quan_ly_xe, 'khi_chon_xe_tu_danh_sach'):
            item = self.bang_danh_sach_xe.item(selection[0])
            self.quan_ly_xe.khi_chon_xe_tu_danh_sach(item)

    def cap_nhat_danh_sach_xe(self, danh_sach_xe):
        """Cập nhật danh sách xe trong bảng"""
        # Xóa dữ liệu cũ
        for item in self.bang_danh_sach_xe.get_children():
            self.bang_danh_sach_xe.delete(item)
        
        # Chuyển đổi danh_sach_xe thành list nếu là single vehicle
        if not isinstance(danh_sach_xe, list):
            danh_sach_xe = [danh_sach_xe]
        
        # Thêm dữ liệu mới
        for xe in danh_sach_xe:
            if isinstance(xe, dict):
                self.bang_danh_sach_xe.insert("", "end", values=(
                    xe.get('bien_so', ''),
                    xe.get('loai_xe', ''),
                    xe.get('gio_vao', ''),
                    xe.get('gio_ra', ''),
                    xe.get('ma_the', ''),
                    xe.get('thoi_gian_do', ''),
                    xe.get('phi', ''),
                    xe.get('cong_vao', ''),
                    xe.get('cong_ra', ''),
                    xe.get('trang_thai', '')
                ))

    def cap_nhat_thong_ke(self, stats):
        """Cập nhật thống kê"""
        if hasattr(self, 'nhan_thong_ke_0'):
            self.nhan_thong_ke_0.config(text=str(stats.get('tong_so_xe', 0)))
        if hasattr(self, 'nhan_thong_ke_1'):
            self.nhan_thong_ke_1.config(text=str(stats.get('xe_trong_bai', 0)))
        if hasattr(self, 'nhan_thong_ke_2'):
            self.nhan_thong_ke_2.config(text=f"{stats.get('tong_doanh_thu', 0)} VND")
        if hasattr(self, 'nhan_thong_ke_3'):
            xe_may = stats.get('xe_may', 0)
            xe_hoi = stats.get('xe_hoi', 0)
            self.nhan_thong_ke_3.config(text=f"{xe_may} / {xe_hoi}")

    def refresh_data(self):
        """Làm mới dữ liệu"""
        if hasattr(self.quan_ly_xe, 'tai_danh_sach_xe'):
            self.quan_ly_xe.tai_danh_sach_xe()
