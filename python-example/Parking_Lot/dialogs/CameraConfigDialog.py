import tkinter as tk
from tkinter import ttk, messagebox
import json
import os
import requests
from server.url import url_api
import tkinter.font as tkfont
from dialogs.AddCameraDialog import AddCameraDialog

class CameraConfigDialog:
    def __init__(self, parent):
        self.parent = parent
        self.ket_qua = None
        self.zones = []  # Danh sách khu vực
        self.cameras = []
        self.selected_zone_id = None
        self.tao_dialog()

    def load_zones(self):
        try:
            response = requests.post(
                url_api,
                json={
                    'table': 'pm_nc0004_2', 
                    'func': 'data'
                }
            )
            try:
                result = response.json()
            except json.JSONDecodeError:
                messagebox.showerror("Lỗi", "Phản hồi từ server không phải JSON hợp lệ khi tải khu vực.")
                return
            if isinstance(result, list):
                self.zones = result
                zone_names = [f"{z.get('maKhuVuc', '')} - {z.get('tenKhuVuc', '')}" for z in self.zones]
                self.zone_combo['values'] = zone_names
                if zone_names:
                    self.zone_combo.current(0)
                    self.on_zone_selected()
            else:
                messagebox.showerror("Lỗi", "Không thể tải danh sách khu vực")
        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể tải danh sách khu vực: {str(e)}")

    def load_cameras(self, zone_id=None):
        """Load danh sách camera từ server theo khu vực"""
        try:
            payload = {
                'table': 'pm_nc0006_1',
                'func': 'data'
            }
            if zone_id:
                payload['maKhuVuc'] = zone_id
            response = requests.post(
                url_api,
                json=payload
            )
            try:
                result = response.json()
            except json.JSONDecodeError:
                messagebox.showerror("Lỗi", "Phản hồi từ server không phải JSON hợp lệ.")
                return
            if isinstance(result, list):
                self.cameras = result
                camera_names = [cam['tenCamera'] for cam in self.cameras]
                self.camera_combo['values'] = camera_names
                if camera_names:
                    self.camera_combo.current(0)
                    self.load_camera_config(self.cameras[0])
                else:
                    self.camera_combo.set("")
                    for entry in self.entries.values():
                        entry.delete(0, tk.END)
                    self.url_label.config(text="rtsp://username:password@ip:port/h264/ch1/main/av_stream")
            else:
                messagebox.showerror("Lỗi", "Không thể tải danh sách camera")
        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể tải danh sách camera: {str(e)}")

    def tao_dialog(self):
        """Tạo dialog cấu hình camera"""
        self.dialog = tk.Toplevel(self.parent)
        self.dialog.title("Cấu Hình Camera")
        window_width = 1200
        window_height = 600
        screen_width = self.dialog.winfo_screenwidth()
        screen_height = self.dialog.winfo_screenheight()
        x = (screen_width - window_width) // 2
        y = (screen_height - window_height) // 2
        self.dialog.geometry(f'{window_width}x{window_height}+{x}+{y}')
        self.dialog.resizable(True, True)
        self.dialog.transient(self.parent)
        self.dialog.grab_set()
        style = ttk.Style()
        style.configure('Config.TFrame', background='#f0f4f8')
        style.configure('Config.TLabelframe', background='#f0f4f8')
        style.configure('Config.TLabelframe.Label', font=('Helvetica', 12, 'bold'), foreground='#1e3a8a')
        style.configure('Header.TLabel', font=('Helvetica', 16, 'bold'), foreground='#1e3a8a')
        style.configure('URL.TLabel', font=('Consolas', 10), foreground='#374151')
        style.configure('Config.TButton', font=('Helvetica', 10), padding=10)
        main_frame = ttk.Frame(self.dialog, padding=20, style='Config.TFrame')
        main_frame.pack(fill='both', expand=True)
        header_frame = ttk.Frame(main_frame, style='Config.TFrame')
        header_frame.pack(fill='x', pady=(0, 20))
        ttk.Label(
            header_frame,
            text="Cấu Hình Camera",
            style='Header.TLabel'
        ).pack(side='left')
        # Camera selection frame
        camera_frame = ttk.LabelFrame(
            main_frame,
            text="Chọn Khu Vực & Camera",
            padding=15,
            style='Config.TLabelframe'
        )
        camera_frame.pack(fill='x', pady=(0, 20))
        selection_frame = ttk.Frame(camera_frame)
        selection_frame.pack(fill='x', pady=5)
        # Combobox chọn khu vực
        ttk.Label(selection_frame, text="Khu vực:", font=('Helvetica', 11)).pack(side='left', padx=(0, 5))
        self.zone_combo = ttk.Combobox(
            selection_frame,
            width=30,
            state="readonly",
            font=('Helvetica', 11)
        )
        self.zone_combo.pack(side='left', padx=(0, 15))
        self.zone_combo.bind('<<ComboboxSelected>>', self.on_zone_selected)
        # Combobox chọn camera
        ttk.Label(selection_frame, text="Camera:", font=('Helvetica', 11)).pack(side='left', padx=(0, 5))
        self.camera_combo = ttk.Combobox(
            selection_frame,
            width=30,
            state="readonly",
            font=('Helvetica', 11)
        )
        self.camera_combo.pack(side='left', padx=(0, 10))
        self.camera_combo.bind('<<ComboboxSelected>>', self.on_camera_selected)
        # Nút thêm camera mới
        ttk.Button(
            selection_frame,
            text="Thêm Camera Mới",
            command=self.them_camera_moi,
            style='Config.TButton'
        ).pack(side='left')
        # Form frame
        form_frame = ttk.LabelFrame(
            main_frame,
            text="Thông Tin Kết Nối",
            padding=15,
            style='Config.TLabelframe'
        )
        form_frame.pack(fill='x', pady=(0, 20))
        form_frame.columnconfigure(1, weight=1)
        form_frame.columnconfigure(3, weight=1)
        self.entries = {}
        fields = [
            ('IP Address', 'ip', 0),
            ('Username', 'username', 0),
            ('Password', 'password', 2),
            ('Port', 'port', 2)
        ]
        for i, (label, key, col) in enumerate(fields):
            row = i if col == 0 else i - 2
            ttk.Label(
                form_frame,
                text=label + ":",
                font=('Helvetica', 11)
            ).grid(row=row, column=col, padx=10, pady=10, sticky='e')
            self.entries[key] = ttk.Entry(
                form_frame,
                width=30,
                font=('Helvetica', 11)
            )
            self.entries[key].grid(row=row, column=col+1, padx=10, pady=10, sticky='ew')
        self.entries['username'].insert(0, "admin")
        self.entries['port'].insert(0, "554")
        url_frame = ttk.LabelFrame(
            main_frame,
            text="RTSP URL",
            padding=15,
            style='Config.TLabelframe'
        )
        url_frame.pack(fill='x', pady=(0, 20))
        self.url_label = ttk.Label(
            url_frame,
            text="rtsp://username:password@ip:port/h264/ch1/main/av_stream",
            style='URL.TLabel',
            wraplength=700
        )
        self.url_label.pack(padx=5, pady=5)
        for entry in self.entries.values():
            entry.bind('<KeyRelease>', self.cap_nhat_url)
        button_frame = ttk.Frame(main_frame, style='Config.TFrame')
        button_frame.pack(fill='x', pady=(10, 0))
        ttk.Button(
            button_frame,
            text="Quay Lại",
            command=self.quay_lai_che_do,
            style='Config.TButton'
        ).pack(side='left', padx=5)
        ttk.Button(
            button_frame,
            text="Hủy",
            command=self.huy,
            style='Config.TButton'
        ).pack(side='right', padx=5)
        ttk.Button(
            button_frame,
            text="Lưu Cấu Hình",
            command=self.luu_cau_hinh,
            style='Config.TButton'
        ).pack(side='right', padx=5)
        # Load danh sách khu vực
        self.load_zones()

    def on_zone_selected(self, event=None):
        """Khi chọn khu vực, chỉ hiển thị camera thuộc khu vực đó từ cả 2 bảng pm_nc0004_1 và pm_nc0006_1"""
        idx = self.zone_combo.current()
        if idx >= 0 and idx < len(self.zones):
            zone = self.zones[idx]
            self.selected_zone_id = zone['maKhuVuc']
            cameras = []
            camera_ids = set()
            # 1. Lấy camera từ pm_nc0004_1 (API khu_vuc_camera_cong)
            try:
                api_url = url_api
                payload = {
                    'table': 'pm_nc0004_1',
                    'func': 'khu_vuc_camera_cong'
                }
                resp = requests.post(api_url, json=payload)
                data = resp.json()
                if isinstance(data, list):
                    for khu in data:
                        if khu.get('maKhuVuc') == self.selected_zone_id:
                            # cameraVao, cameraRa có thể là list mã hoặc dict
                            for cam in khu.get('cameraVao', []) + khu.get('cameraRa', []):
                                if isinstance(cam, dict):
                                    cam_id = cam.get('maCamera')
                                else:
                                    cam_id = cam
                                if cam_id:
                                    camera_ids.add(cam_id)
                            break
            except Exception as e:
                print(f"Lỗi lấy camera từ pm_nc0004_1: {e}")
            # 2. Lấy camera chi tiết từ pm_nc0006_1 (API cũ)
            camera_detail = []
            try:
                payload = {
                    'table': 'pm_nc0006_1',
                    'func': 'data',
                    'maKhuVuc': self.selected_zone_id
                }
                resp = requests.post(url_api, json=payload)
                data = resp.json()
                if isinstance(data, list):
                    camera_detail = data
            except Exception as e:
                print(f"Lỗi lấy camera từ pm_nc0006_1: {e}")
            # Lọc camera_detail chỉ lấy camera có mã nằm trong camera_ids (nếu có), nếu không thì lấy tất cả camera của khu vực
            if camera_ids:
                cameras = [cam for cam in camera_detail if cam.get('maCamera') in camera_ids]
            else:
                cameras = camera_detail
            self.cameras = cameras
            camera_names = [cam.get('tenCamera', cam.get('maCamera', '')) for cam in self.cameras]
            self.camera_combo['values'] = camera_names
            if camera_names:
                self.camera_combo.current(0)
                self.load_camera_config(self.cameras[0])
            else:
                self.camera_combo.set("")
                for entry in self.entries.values():
                    entry.delete(0, tk.END)
                self.url_label.config(text="rtsp://username:password@ip:port/h264/ch1/main/av_stream")
        else:
            self.selected_zone_id = None
            self.cameras = []
            self.camera_combo['values'] = []
            self.camera_combo.set("")
            for entry in self.entries.values():
                entry.delete(0, tk.END)
            self.url_label.config(text="rtsp://username:password@ip:port/h264/ch1/main/av_stream")

    def on_camera_selected(self, event=None):
        """Xử lý sự kiện khi chọn camera từ combobox"""
        selected_index = self.camera_combo.current()
        if selected_index >= 0:
            self.load_camera_config(self.cameras[selected_index])

    def load_camera_config(self, camera):
        """Load cấu hình camera được chọn"""
        try:
            # Clear current entries
            for entry_widget in self.entries.values():
                entry_widget.delete(0, tk.END)
                
            # Parse URL RTSP từ cấu hình hiện tại
            rtsp_url = camera.get('linkRSTP', '')
            if rtsp_url:
                # Format: rtsp://username:password@ip:port/h264/ch1/main/av_stream
                parts = rtsp_url.replace('rtsp://', '').split('@')
                if len(parts) == 2:
                    auth = parts[0].split(':')
                    if len(auth) == 2:
                        self.entries['username'].insert(0, auth[0])
                        self.entries['password'].insert(0, auth[1])
                        
                    ip_port = parts[1].split('/')[0].split(':')
                    if len(ip_port) == 2:
                        self.entries['ip'].insert(0, ip_port[0])
                        self.entries['port'].insert(0, ip_port[1])
            
            # Set default values if not loaded from URL
            if not self.entries['username'].get():
                self.entries['username'].insert(0, "admin")
            if not self.entries['port'].get():
                self.entries['port'].insert(0, "554")
                        
            self.cap_nhat_url()
        except Exception as e:
            print(f"Lỗi khi load cấu hình camera: {str(e)}")
            
    def cap_nhat_url(self, event=None):
        """Cập nhật URL preview khi người dùng nhập liệu"""
        try:
            config = {
                "ip": self.entries['ip'].get(),
                "username": self.entries['username'].get(),
                "password": self.entries['password'].get(),
                "port": self.entries['port'].get()
            }
            
            # Tạo URL RTSP
            rtsp_url = f"rtsp://{config['username']}:{config['password']}@{config['ip']}:{config['port']}/h264/ch1/main/av_stream"
            self.url_label.config(text=rtsp_url)
        except:
            self.url_label.config(text="rtsp://username:password@ip:port/h264/ch1/main/av_stream")
            
    def luu_cau_hinh(self):
        """Lưu cấu hình camera và cập nhật vào url.py"""
        try:
            selected_index = self.camera_combo.current()
            if selected_index < 0:
                messagebox.showerror("Lỗi", "Vui lòng chọn camera!")
                return

            camera = self.cameras[selected_index]
            camera_id = camera['maCamera']
            camera_name = camera.get('tenCamera', '').upper()

            # Kiểm tra dữ liệu
            config = {
                "ip": self.entries['ip'].get(),
                "username": self.entries['username'].get(),
                "password": self.entries['password'].get(),
                "port": self.entries['port'].get()
            }

            if not all(config.values()):
                messagebox.showerror("Lỗi", "Vui lòng điền đầy đủ thông tin!")
                return

            # Tạo URL RTSP
            rtsp_url = f"rtsp://{config['username']}:{config['password']}@{config['ip']}:{config['port']}/h264/ch1/main/av_stream"

            # Gọi API cập nhật URL
            response = requests.post(
                url_api,
                json={
                    'table': 'pm_nc0006_2',
                    'func': 'updateUrl',
                    'id': camera_id,
                    'data': {
                        'rtsp_url': rtsp_url
                    }
                }
            )

            if response.status_code == 200:
                try:
                    data = response.json()
                except json.JSONDecodeError:
                    messagebox.showerror("Lỗi", "Phản hồi từ server không phải JSON hợp lệ khi lưu cấu hình.")
                    return

                if data.get('success'):
                    # --- Cập nhật vào file url.py ---
                    url_file = os.path.join(os.path.dirname(__file__), '../server/url.py')
                    with open(url_file, 'r', encoding='utf-8') as f:
                        lines = f.readlines()

                    # Xác định biến cần cập nhật
                    if "VÀO" in camera_name or "IN" in camera_name:
                        var_name = "rtsp_url_in"
                    elif "RA" in camera_name or "OUT" in camera_name:
                        var_name = "rtsp_url_out"
                    else:
                        var_name = None

                    if var_name:
                        for i, line in enumerate(lines):
                            if line.strip().startswith(var_name):
                                lines[i] = f'{var_name} = "{rtsp_url}" #updated by CameraConfigDialog\n'
                        with open(url_file, 'w', encoding='utf-8') as f:
                            f.writelines(lines)

                    messagebox.showinfo("Thành công", "Đã lưu cấu hình camera và cập nhật url.py!")
                else:
                    messagebox.showerror("Lỗi", data.get('message', 'Không thể lưu cấu hình'))
            else:
                messagebox.showerror("Lỗi", "Không thể kết nối đến máy chủ (mã trạng thái: " + str(response.status_code) + ")")

        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể lưu cấu hình: {str(e)}")
            
    def huy(self):
        """Hủy cấu hình"""
        self.ket_qua = "cancel"
        self.dialog.destroy()

    def quay_lai_che_do(self):
        """Quay lại dialog chọn chế độ khởi động"""
        self.ket_qua = "back_to_startup"
        self.dialog.destroy()
        
    def them_camera_moi(self):
        """Mở dialog thêm camera mới cho khu vực đang chọn"""
        if not self.selected_zone_id:
            messagebox.showerror("Lỗi", "Vui lòng chọn khu vực trước khi thêm camera!")
            return
        dialog = AddCameraDialog(self.dialog, ma_khu_vuc=self.selected_zone_id)
        result = dialog.show()
        if result == "saved":
            self.load_cameras(zone_id=self.selected_zone_id)

    def show(self):
        """Hiển thị dialog và chờ kết quả"""
        self.parent.wait_window(self.dialog)
        return self.ket_qua