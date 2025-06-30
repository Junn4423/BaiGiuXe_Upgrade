import tkinter as tk
from tkinter import ttk, messagebox
import server.api as api
from models import KhuVuc

class ParkingZoneDialog:
    def __init__(self, parent):
        self.parent = parent
        self.dialog = tk.Toplevel(parent)
        self.dialog.title("Quản Lý Khu Vực")
        
        # Cấu hình cửa sổ
        self.dialog.protocol("WM_DELETE_WINDOW", self.on_closing)
        self.dialog.update_idletasks()
        window_width = 1380
        window_height = 720
        screen_width = self.dialog.winfo_screenwidth()
        screen_height = self.dialog.winfo_screenheight()
        x = (screen_width - window_width) // 2
        y = (screen_height - window_height) // 2
        self.dialog.geometry(f'{window_width}x{window_height}+{x}+{y}')
        self.dialog.resizable(False, False)  # Prevent resizing to maintain layout
        self.dialog.transient(parent)
        self.dialog.grab_set()
        
        # Thiết lập style
        self.setup_styles()
        
        self.init_ui()
        self.load_data()
        parent.wait_window(self.dialog)

    def setup_styles(self):
        style = ttk.Style()
        
        # Main style configuration
        style.configure('Zone.TFrame', background='#f0f4f8')
        style.configure('Zone.TLabelframe', background='#f0f4f8')
        style.configure('Zone.TLabelframe.Label', 
                       font=('Helvetica', 12, 'bold'),
                       foreground='#1e3a8a')
        
        # Header style
        style.configure('Header.TLabel',
                       font=('Helvetica', 16, 'bold'),
                       foreground='#1e3a8a')
        
        # Form label style
        style.configure('Form.TLabel',
                       font=('Helvetica', 11),
                       background='#f0f4f8')
        
        # Button styles
        style.configure('Action.TButton',
                       font=('Helvetica', 10),
                       padding=8)
        
        style.configure('Delete.TButton',
                       font=('Helvetica', 10),
                       padding=8)
        
        # Treeview styles
        style.configure('Zone.Treeview',
                       font=('Helvetica', 10),
                       rowheight=25)
        
        style.configure('Zone.Treeview.Heading',
                       font=('Helvetica', 11, 'bold'))

    def init_ui(self):
        # Main container with giảm padding
        main_frame = ttk.Frame(self.dialog, padding="5", style='Zone.TFrame')
        main_frame.pack(fill=tk.BOTH, expand=True)

        # Header with back button
        header_frame = ttk.Frame(main_frame, style='Zone.TFrame')
        header_frame.pack(fill=tk.X, pady=(0, 5))
        ttk.Button(
            header_frame,
            text="Quay lại",
            style='Action.TButton',
            command=self.quay_lai
        ).pack(side=tk.LEFT)
        ttk.Label(
            header_frame,
            text="Quản Lý Khu Vực",
            style='Header.TLabel'
        ).pack(side=tk.LEFT, padx=10)

        # Container for tree and form
        content_frame = ttk.Frame(main_frame, style='Zone.TFrame')
        content_frame.pack(fill=tk.BOTH, expand=True)

        # Treeview panel - Danh sách khu vực (35%)
        tree_frame = ttk.LabelFrame(
            content_frame,
            text="Danh Sách Khu Vực",
            padding="5",
            style='Zone.TLabelframe'
        )
        tree_frame.pack(fill=tk.BOTH, expand=True, side=tk.LEFT, padx=(0, 3), ipadx=2, ipady=2)
        columns = ("Mã khu vực", "Tên khu vực", "Mô tả")
        self.tree = ttk.Treeview(
            tree_frame,
            columns=columns,
            show="headings",
            height=18,
            style='Zone.Treeview'
        )
        self.tree.column("Mã khu vực", width=90)
        self.tree.column("Tên khu vực", width=120)
        self.tree.column("Mô tả", width=140)
        for col in columns:
            self.tree.heading(col, text=col)
        scrollbar = ttk.Scrollbar(tree_frame, orient=tk.VERTICAL, command=self.tree.yview)
        self.tree.configure(yscrollcommand=scrollbar.set)
        self.tree.pack(side=tk.LEFT, fill=tk.BOTH, expand=True)
        scrollbar.pack(side=tk.RIGHT, fill=tk.Y)

        # Camera panel - Danh sách camera của khu vực (35%)
        camera_frame = ttk.LabelFrame(
            content_frame,
            text="Camera của khu vực",
            padding="5",
            style='Zone.TLabelframe'
        )
        camera_frame.pack(fill=tk.BOTH, expand=True, side=tk.LEFT, padx=(3, 3), ipadx=2, ipady=2)
        # Button thêm, sửa, xóa camera đặt ngay dưới tiêu đề
        btn_frame = ttk.Frame(camera_frame, style='Zone.TFrame')
        btn_frame.pack(fill=tk.X, pady=(0, 5), anchor=tk.NE)
        add_camera_btn = ttk.Button(
            btn_frame,
            text="Thêm Camera",
            style='Action.TButton',
            command=self.add_camera_for_zone
        )
        add_camera_btn.pack(side=tk.LEFT, padx=2)
        edit_camera_btn = ttk.Button(
            btn_frame,
            text="Sửa Camera",
            style='Action.TButton',
            command=self.edit_camera_for_zone
        )
        edit_camera_btn.pack(side=tk.LEFT, padx=2)
        delete_camera_btn = ttk.Button(
            btn_frame,
            text="Xóa Camera",
            style='Delete.TButton',
            command=self.delete_camera_for_zone
        )
        delete_camera_btn.pack(side=tk.LEFT, padx=2)
        camera_columns = ("Mã Camera", "Tên Camera", "Loại", "Chức năng", "RTSP")
        self.camera_tree = ttk.Treeview(
            camera_frame,
            columns=camera_columns,
            show="headings",
            height=10,
            style='Zone.Treeview'
        )
        for col in camera_columns:
            self.camera_tree.heading(col, text=col)
            self.camera_tree.column(col, width=80 if col!="RTSP" else 120)
        self.camera_tree.pack(side=tk.LEFT, fill=tk.BOTH, expand=True)
        camera_scrollbar = ttk.Scrollbar(camera_frame, orient=tk.VERTICAL, command=self.camera_tree.yview)
        self.camera_tree.configure(yscrollcommand=camera_scrollbar.set)
        camera_scrollbar.pack(side=tk.RIGHT, fill=tk.Y)

        # Form panel - Thông tin khu vực (30%)
        form_frame = ttk.LabelFrame(
            content_frame,
            text="Thông Tin Khu Vực",
            padding="5",
            style='Zone.TLabelframe'
        )
        form_frame.pack(fill=tk.Y, side=tk.LEFT, padx=(3, 0), ipadx=2, ipady=2)
        fields = [
            ("Mã khu vực:", "ma_khu_vuc"),
            ("Tên khu vực:", "ten_khu_vuc"),
            ("Mô tả:", "mo_ta")
        ]
        self.entries = {}
        for i, (label_text, field_name) in enumerate(fields):
            field_frame = ttk.Frame(form_frame, style='Zone.TFrame')
            field_frame.pack(fill=tk.X, pady=2)
            ttk.Label(
                field_frame,
                text=label_text,
                style='Form.TLabel'
            ).pack(anchor=tk.W)
            if field_name == "mo_ta":
                entry = tk.Text(field_frame, height=3, width=18, font=('Helvetica', 11))
            else:
                entry = ttk.Entry(field_frame, width=18, font=('Helvetica', 11))
            entry.pack(fill=tk.X, pady=(2, 0))
            self.entries[field_name] = entry
        button_frame = ttk.Frame(form_frame, style='Zone.TFrame')
        button_frame.pack(fill=tk.X, pady=(6, 0))
        buttons = [
            ("Thêm mới", self.add_zone, 'Action.TButton'),
            ("Cập nhật", self.update_zone, 'Action.TButton'),
            ("Xóa", self.delete_zone, 'Delete.TButton'),
            ("Làm mới", self.clear_form, 'Action.TButton')
        ]
        for text, command, style in buttons:
            ttk.Button(
                button_frame,
                text=text,
                command=command,
                style=style
            ).pack(side=tk.LEFT, padx=2)
        self.tree.bind('<<TreeviewSelect>>', self.on_select)

    def quay_lai(self):
        """Quay lại màn hình trước"""
        self.dialog.destroy()

    def load_data(self):
        try:
            zones = api.layDanhSachKhuVuc()
            for item in self.tree.get_children():
                self.tree.delete(item)
            for zone in zones:
                self.tree.insert("", tk.END, values=(
                    zone.maKhuVuc,
                    zone.tenKhuVuc,
                    zone.moTa
                ))
        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể tải dữ liệu: {str(e)}")

    def validate_input(self):
        ma_khu_vuc = self.entries["ma_khu_vuc"].get().strip()
        ten_khu_vuc = self.entries["ten_khu_vuc"].get().strip()
        
        if not ma_khu_vuc:
            messagebox.showwarning("Lỗi", "Vui lòng nhập mã khu vực")
            return False
        if not ten_khu_vuc:
            messagebox.showwarning("Lỗi", "Vui lòng nhập tên khu vực")
            return False
        return True

    def clear_form(self):
        self.entries["ma_khu_vuc"].config(state="normal")
        for entry in self.entries.values():
            if isinstance(entry, tk.Text):
                entry.delete("1.0", tk.END)
            else:
                entry.delete(0, tk.END)    
    def get_form_data(self):
        # Get values from entries
        ma_khu_vuc = self.entries["ma_khu_vuc"].get().strip()
        ten_khu_vuc = self.entries["ten_khu_vuc"].get().strip()
        mo_ta = self.entries["mo_ta"].get("1.0", tk.END).strip()
        
        # Ensure moTa is empty string if not provided
        if not mo_ta:
            mo_ta = ""
            
        return KhuVuc(
            maKhuVuc=ma_khu_vuc,
            tenKhuVuc=ten_khu_vuc,
            moTa=mo_ta
        )

    def load_cameras_for_zone(self, ma_khu_vuc):
        """Load danh sách camera cho khu vực"""
        try:
            # Gọi API lấy toàn bộ camera, sau đó lọc theo ma_khu_vuc
            cameras = api.layDanhSachCamera()  # Trả về list dict
            filtered = [cam for cam in cameras if cam.get('maKhuVuc') == ma_khu_vuc]
            # Xóa camera cũ
            for item in self.camera_tree.get_children():
                self.camera_tree.delete(item)
            # Thêm camera mới
            for cam in filtered:
                self.camera_tree.insert("", tk.END, values=(
                    cam.get('maCamera', ''),
                    cam.get('tenCamera', ''),
                    cam.get('loaiCamera', ''),
                    cam.get('chucNangCamera', ''),
                    cam.get('linkRTSP', '')
                ))
        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể tải danh sách camera: {str(e)}")

    def add_camera_for_zone(self):
        """Mở dialog thêm camera cho khu vực đang chọn"""
        selected = self.tree.selection()
        if not selected:
            messagebox.showwarning("Chọn khu vực", "Vui lòng chọn khu vực để thêm camera!")
            return
        values = self.tree.item(selected[0])["values"]
        ma_khu_vuc = values[0]
        try:
            from dialogs.AddCameraDialog import AddCameraDialog
            # Gọi dialog đúng chuẩn, không truy cập thuộc tính sau khi destroy
            AddCameraDialog(self.dialog, ma_khu_vuc)
            # Sau khi thêm xong, reload camera list
            self.load_cameras_for_zone(ma_khu_vuc)
        except Exception as e:
            import traceback
            print(traceback.format_exc())
            messagebox.showerror("Lỗi", f"Không thể mở dialog thêm camera: {str(e)}")

    def edit_camera_for_zone(self):
        selected = self.camera_tree.selection()
        if not selected:
            messagebox.showwarning("Chọn camera", "Vui lòng chọn camera để sửa!")
            return
        values = self.camera_tree.item(selected[0])["values"]
        ma_khu_vuc = self.entries["ma_khu_vuc"].get().strip()
        if not ma_khu_vuc:
            messagebox.showwarning("Lỗi", "Không xác định được mã khu vực!")
            return
        try:
            from dialogs.AddCameraDialog import AddCameraDialog
            camera_data = {
                'maCamera': values[0],
                'tenCamera': values[1],
                'loaiCamera': values[2],
                'chucNangCamera': values[3],
                'linkRTSP': values[4],
            }
            AddCameraDialog(self.dialog, ma_khu_vuc, camera_data)
            self.load_cameras_for_zone(ma_khu_vuc)
        except Exception as e:
            import traceback
            print(traceback.format_exc())
            messagebox.showerror("Lỗi", f"Không thể mở dialog sửa camera: {str(e)}")

    def delete_camera_for_zone(self):
        selected = self.camera_tree.selection()
        if not selected:
            messagebox.showwarning("Chọn camera", "Vui lòng chọn camera để xóa!")
            return
        values = self.camera_tree.item(selected[0])["values"]
        ma_camera = values[0]
        ma_khu_vuc = self.entries["ma_khu_vuc"].get().strip()
        if not ma_camera:
            messagebox.showwarning("Lỗi", "Không xác định được mã camera!")
            return
        if not messagebox.askyesno("Xác nhận", f"Bạn có chắc chắn muốn xóa camera {ma_camera}?"):
            return
        try:
            result = api.xoaCamera(ma_camera)
            if result.get('success'):
                messagebox.showinfo("Thành công", "Xóa camera thành công")
                self.load_cameras_for_zone(ma_khu_vuc)
            else:
                messagebox.showwarning("Lỗi", result.get('message', 'Không thể xóa camera'))
        except Exception as e:
            import traceback
            print(traceback.format_exc())
            messagebox.showerror("Lỗi", f"Không thể xóa camera: {str(e)}")

    def on_select(self, event):
        selected = self.tree.selection()
        if not selected:
            return
            
        values = self.tree.item(selected[0])["values"]
        self.clear_form()
        self.entries["ma_khu_vuc"].insert(0, values[0])
        self.entries["ma_khu_vuc"].config(state="readonly")
        self.entries["ten_khu_vuc"].insert(0, values[1])
        self.entries["mo_ta"].insert("1.0", values[2] if values[2] else "")
        # Load camera cho khu vực này
        self.load_cameras_for_zone(values[0])

    def add_zone(self):
        """
        Thêm khu vực mới theo format API chuẩn:
        {
            "table": "pm_nc0004_2",
            "func": "add",
            "maKhuVuc": "K004",
            "tenKhuVuc": "Khu B", 
            "moTa": ""
        }
        """
        # Ensure ma_khu_vuc is editable
        self.entries["ma_khu_vuc"].config(state="normal")
        
        # Validate input first
        if not self.validate_input():
            return
            
        try:
            # Get form data
            zone_data = self.get_form_data()
            
            # Call API
            print("Adding zone with data:", vars(zone_data))  # Debug log
            result = api.themKhuVuc(zone_data)
            
            # Handle response
            if result.get("success", False):
                messagebox.showinfo(
                    "Thành công",
                    result.get("message", "Thêm khu vực thành công")
                )
                self.load_data()  # Reload list
                self.clear_form()  # Clear form after successful add
                
                # Clear selection after successful add
                if self.tree.selection():
                    self.tree.selection_remove(self.tree.selection())
            else:
                messagebox.showerror(
                    "Lỗi",
                    result.get("message", "Không thể thêm khu vực")
                )
                
        except Exception as e:
            print(f"Error adding zone: {str(e)}")  # Debug log
            messagebox.showerror(
                "Lỗi",
                f"Lỗi khi thêm khu vực: {str(e)}"
            )

    def update_zone(self):
        if not self.entries["ma_khu_vuc"].get().strip():
            messagebox.showwarning("Lỗi", "Vui lòng chọn khu vực cần cập nhật")
            return
            
        if not self.validate_input():
            return
            
        try:
            zone_data = self.get_form_data()
            result = api.capNhatKhuVuc(zone_data)
            if result.get("success", False):
                messagebox.showinfo("Thành công", result.get("message", "Cập nhật khu vực thành công"))
                self.load_data()
                self.clear_form()
            else:
                messagebox.showerror("Lỗi", result.get("message", "Không thể cập nhật khu vực"))
        except Exception as e:
            messagebox.showerror("Lỗi", f"Lỗi khi cập nhật khu vực: {str(e)}")

    def delete_zone(self):
        """Xóa khu vực được chọn"""
        # Get selected zone code
        ma_khu_vuc = self.entries["ma_khu_vuc"].get().strip()
        if not ma_khu_vuc:
            messagebox.showwarning(
                "Lỗi",
                "Vui lòng chọn khu vực cần xóa"
            )
            return
            
        # Confirm deletion
        if not messagebox.askyesno(
            "Xác nhận",
            f"Bạn có chắc chắn muốn xóa khu vực {ma_khu_vuc}?"
        ):
            return
            
        try:
            # Call API to delete
            print(f"Deleting zone: {ma_khu_vuc}")  # Debug log
            result = api.xoaKhuVuc(ma_khu_vuc)
            
            # Handle response
            if result.get("success", False):
                messagebox.showinfo(
                    "Thành công",
                    result.get("message", "Xóa khu vực thành công")
                )
                self.load_data()  # Reload list
                self.clear_form()  # Clear form
                
                # Clear selection
                if self.tree.selection():
                    self.tree.selection_remove(self.tree.selection())
            else:
                messagebox.showerror(
                    "Lỗi",
                    result.get("message", "Không thể xóa khu vực")
                )
                
        except Exception as e:
            print(f"Error deleting zone: {str(e)}")  # Debug log
            messagebox.showerror(
                "Lỗi",
                f"Lỗi khi xóa khu vực: {str(e)}"
            )

    def on_closing(self):
        self.dialog.destroy()