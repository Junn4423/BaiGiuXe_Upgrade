import tkinter as tk
from tkinter import ttk, messagebox
import server.api as api

class AddCameraDialog:
    def __init__(self, parent, ma_khu_vuc, camera_data=None):
        self.parent = parent
        self.camera_data = camera_data  # dict nếu sửa, None nếu thêm mới
        self.ma_khu_vuc = ma_khu_vuc    # truyền từ ngoài vào, không cho chọn
        self.dialog = tk.Toplevel(parent)
        self.dialog.title("Thêm/Sửa Camera")
        window_width = 500
        window_height = 700
        screen_width = self.dialog.winfo_screenwidth()
        screen_height = self.dialog.winfo_screenheight()
        x = (screen_width - window_width) // 2
        y = (screen_height - window_height) // 2
        self.dialog.geometry(f'{window_width}x{window_height}+{x}+{y}')
        self.dialog.transient(parent)
        self.dialog.grab_set()
        self.setup_styles()
        self.init_ui()
        if camera_data:
            self.set_form_data(camera_data)
        self.dialog.wait_window(self.dialog)

    def setup_styles(self):
        style = ttk.Style()
        style.configure('Camera.TFrame', background='#f0f4f8')
        style.configure('Camera.TLabelframe', background='#f0f4f8')
        style.configure('Camera.TLabelframe.Label', font=('Helvetica', 12, 'bold'), foreground='#1e3a8a')
        style.configure('Header.TLabel', font=('Helvetica', 15, 'bold'), foreground='#1e3a8a')
        style.configure('Form.TLabel', font=('Helvetica', 11), background='#f0f4f8')
        style.configure('Action.TButton', font=('Helvetica', 10), padding=8)
        style.configure('Delete.TButton', font=('Helvetica', 10), padding=8)

    def init_ui(self):
        main_frame = ttk.Frame(self.dialog, padding="15", style='Camera.TFrame')
        main_frame.pack(fill=tk.BOTH, expand=True)
        ttk.Label(main_frame, text="Thông Tin Camera", style='Header.TLabel').pack(pady=(0, 10))
        form_frame = ttk.LabelFrame(main_frame, text="Camera", padding="10", style='Camera.TLabelframe')
        form_frame.pack(fill=tk.BOTH, expand=True)
        fields = [
            ("Mã camera:", "maCamera"),
            ("Tên camera:", "tenCamera"),
            ("Loại camera:", "loaiCamera"),
            ("Chức năng:", "chucNangCamera"),
            ("Link RTSP:", "linkRTSP")
        ]
        self.entries = {}
        for label_text, field_name in fields:
            field_frame = ttk.Frame(form_frame, style='Camera.TFrame')
            field_frame.pack(fill=tk.X, pady=4)
            ttk.Label(field_frame, text=label_text, style='Form.TLabel').pack(anchor=tk.W)
            if field_name == "loaiCamera":
                entry = ttk.Combobox(field_frame, values=["VAO", "RA"], width=28, font=('Helvetica', 11), state="readonly")
            elif field_name == "chucNangCamera":
                entry = ttk.Combobox(field_frame, values=["BIENSO", "KHUONMAT"], width=28, font=('Helvetica', 11), state="readonly")
            else:
                entry = ttk.Entry(field_frame, width=30, font=('Helvetica', 11))
            entry.pack(fill=tk.X, pady=(2, 0))
            self.entries[field_name] = entry
        # Hiển thị mã khu vực (readonly, không cho chọn)
        khu_frame = ttk.Frame(form_frame, style='Camera.TFrame')
        khu_frame.pack(fill=tk.X, pady=4)
        ttk.Label(khu_frame, text="Mã khu vực:", style='Form.TLabel').pack(anchor=tk.W)
        self.khu_label = ttk.Entry(khu_frame, width=30, font=('Helvetica', 11), state='readonly')
        self.khu_label.pack(fill=tk.X, pady=(2, 0))
        self.khu_label.config(state='normal')
        self.khu_label.insert(0, self.ma_khu_vuc)
        self.khu_label.config(state='readonly')
        button_frame = ttk.Frame(main_frame, style='Camera.TFrame')
        button_frame.pack(fill=tk.X, pady=(12, 0))
        if self.camera_data:
            ttk.Button(button_frame, text="Cập nhật", command=self.update_camera, style='Action.TButton').pack(side=tk.LEFT, padx=5)
        else:
            ttk.Button(button_frame, text="Thêm mới", command=self.add_camera, style='Action.TButton').pack(side=tk.LEFT, padx=5)
        ttk.Button(button_frame, text="Hủy", command=self.dialog.destroy, style='Delete.TButton').pack(side=tk.LEFT, padx=5)

    def set_form_data(self, data):
        self.entries['maCamera'].insert(0, data.get('maCamera', ''))
        self.entries['maCamera'].config(state='readonly')
        self.entries['tenCamera'].insert(0, data.get('tenCamera', ''))
        self.entries['loaiCamera'].set(data.get('loaiCamera', ''))
        self.entries['chucNangCamera'].set(data.get('chucNangCamera', ''))
        self.entries['linkRTSP'].insert(0, data.get('linkRTSP', ''))

    def get_form_data(self):
        return {
            'maCamera': self.entries['maCamera'].get().strip(),
            'tenCamera': self.entries['tenCamera'].get().strip(),
            'loaiCamera': self.entries['loaiCamera'].get().strip(),
            'chucNangCamera': self.entries['chucNangCamera'].get().strip(),
            'maKhuVuc': self.ma_khu_vuc,
            'linkRTSP': self.entries['linkRTSP'].get().strip(),
        }

    def validate_input(self, is_update=False):
        if not self.entries['maCamera'].get() and not is_update:
            messagebox.showwarning("Lỗi", "Vui lòng nhập mã camera")
            return False
        if not self.entries['tenCamera'].get():
            messagebox.showwarning("Lỗi", "Vui lòng nhập tên camera")
            return False
        if not self.entries['loaiCamera'].get():
            messagebox.showwarning("Lỗi", "Vui lòng chọn loại camera")
            return False
        if not self.entries['chucNangCamera'].get():
            messagebox.showwarning("Lỗi", "Vui lòng chọn chức năng camera")
            return False
        return True

    def add_camera(self):
        if not self.validate_input():
            return
        data = self.get_form_data()
        try:
            result = api.themCamera(data)
            if result.get('success'):
                messagebox.showinfo("Thành công", "Thêm camera thành công")
                self.dialog.grab_release()  # Giải phóng grab trước khi destroy
                self.dialog.destroy()
            else:
                messagebox.showwarning("Lỗi", result.get('message', 'Không thể thêm camera'))
        except Exception as e:
            self.dialog.grab_release()
            messagebox.showerror("Lỗi", f"Không thể thêm camera: {str(e)}")

    def update_camera(self):
        if not self.validate_input(is_update=True):
            return
        data = self.get_form_data()
        try:
            result = api.capNhatCamera(data)
            if result.get('success'):
                messagebox.showinfo("Thành công", "Cập nhật camera thành công")
                self.dialog.grab_release()
                self.dialog.destroy()
            else:
                messagebox.showwarning("Lỗi", result.get('message', 'Không thể cập nhật camera'))
        except Exception as e:
            self.dialog.grab_release()
            messagebox.showerror("Lỗi", f"Không thể cập nhật camera: {str(e)}")
