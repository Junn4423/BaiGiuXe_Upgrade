import tkinter as tk
import datetime

class HeaderComponent:
    def __init__(self, parent, quan_ly_xe):
        self.parent = parent
        self.quan_ly_xe = quan_ly_xe
        self.che_do_hien_tai = "vao"
        self.loai_xe_hien_tai = "xe_may"
        self.khu_hien_tai = None
        self.danh_sach_khu = []
        self.create_header()
        self.create_status_bar()
        self.cap_nhat_thoi_gian()
        self.tai_danh_sach_khu()

    def create_header(self):
        """Tạo header với title"""
        # Main header frame
        khung_tieu_de = tk.Frame(self.parent, bg="#0f172a")
        khung_tieu_de.pack(fill=tk.X, pady=(0, 20))


    def create_status_bar(self):
        """Tạo thanh trạng thái"""
        thanh_trang_thai = tk.Frame(self.parent, bg="#0f172a", height=30)
        thanh_trang_thai.pack(fill=tk.X, pady=(20, 0))
        
        thoi_gian_hien_tai = datetime.datetime.now().strftime("%d/%m/%Y %H:%M:%S")
        self.nhan_thoi_gian = tk.Label(
            thanh_trang_thai, text=f"Thời gian hiện tại: {thoi_gian_hien_tai}",
            font=("Helvetica", 10), fg="white", bg="#0f172a", pady=5
        )
        self.nhan_thoi_gian.pack(side=tk.RIGHT, padx=10)
        
        self.nhan_che_do = tk.Label(
            thanh_trang_thai, text="Chế độ: XE MÁY VÀO",
            font=("Helvetica", 10, "bold"), fg="white", bg="#0f172a", pady=5
        )
        self.nhan_che_do.pack(side=tk.LEFT, padx=10)

    def cap_nhat_thoi_gian(self):
        """Cập nhật thời gian"""
        thoi_gian_hien_tai = datetime.datetime.now().strftime("%d/%m/%Y %H:%M:%S")
        self.nhan_thoi_gian.config(text=f"Thời gian hiện tại: {thoi_gian_hien_tai}")
        self.parent.after(1000, self.cap_nhat_thoi_gian)

    def update_mode_display(self, che_do, loai_xe):
        """Cập nhật hiển thị chế độ"""
        self.che_do_hien_tai = che_do
        self.loai_xe_hien_tai = loai_xe
        
        if che_do == "vao":
            if loai_xe == "xe_may":
                text = "Chế độ: XE MÁY VÀO"
            else:
                text = "Chế độ: XE HƠI VÀO"
        else:
            if loai_xe == "xe_may":
                text = "Chế độ: XE MÁY RA"
            else:
                text = "Chế độ: XE HƠI RA"
        
        self.nhan_che_do.config(text=text)
        
    #button để chuyển đổi chế độ
    def tao_button_chuyen_che_do(self, khung_cha):
        """Tạo button để chuyển đổi chế độ vào/ra và loại xe (ngắn gọn)"""
        self.button_chuyen_che_do = tk.Button(
            khung_cha, text="Chuyển chế độ", command=self.chuyen_che_do,
            font=("Helvetica", 10), bg="#1e293b", fg="white", width=12, padx=4, pady=3
        )
        self.button_chuyen_che_do.pack(side=tk.LEFT, padx=6)

    def tai_danh_sach_khu(self, ma_khu_vuc=None):
        """
        Tải danh sách khu vực và chọn khu theo mã khu vực truyền vào (nếu có).
        Nếu không truyền mã khu vực thì lấy khu đầu tiên.
        """
        try:
            import server.api as api
            ds = api.lay_danh_sach_khu()
            self.danh_sach_khu = ds if ds else []
            # Không còn cập nhật combobox nữa
            if self.danh_sach_khu:
                khu = None
                if ma_khu_vuc:
                    for k in self.danh_sach_khu:
                        if (isinstance(k, dict) and k.get('maKhuVuc') == ma_khu_vuc) or \
                           (hasattr(k, 'maKhuVuc') and getattr(k, 'maKhuVuc', None) == ma_khu_vuc):
                            khu = k
                            break
                if not khu:
                    khu = self.danh_sach_khu[0]
                self.khu_hien_tai = khu
                return self.khu_hien_tai
        except Exception as e:
            print("Lỗi lấy danh sách khu:", e)
            return None

    def khi_chon_khu(self, event=None):
        """Xử lý khi chọn khu"""
        idx = self.combo_khu.current()
        if idx < 0 or idx >= len(self.danh_sach_khu):
            return None
        self.khu_hien_tai = self.danh_sach_khu[idx]
        return self.khu_hien_tai
