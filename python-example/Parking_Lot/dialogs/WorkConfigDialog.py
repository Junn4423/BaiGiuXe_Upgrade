import tkinter as tk
from tkinter import ttk
from tkinter import messagebox
import json
import os
import server.api as api

class WorkConfigDialog(tk.Toplevel):
    def __init__(self, parent, token=None, on_config_saved=None):
        super().__init__(parent)
        self.token = token
        self.on_config_saved = on_config_saved
        self.result = None
        self.selected_zone_data = None  # Store the full zone data
          # Window setup
        self.title("Cấu hình làm việc")
        self.geometry("1280x880")  # Larger window
        self.resizable(False, False)
        
        # Remove default title bar
        self.overrideredirect(True)
        self.attributes('-topmost', True)
          # Configure style
        self.style = ttk.Style()
        self.style.configure('Config.TCombobox', 
                           font=('Segoe UI', 14),
                           padding=15)
        self.configure(bg='#f5f5f5')
        
        # Variables
        self.selected_zone = tk.StringVar()
        self.selected_vehicle_type = tk.StringVar()
        
        # Create UI
        self._create_title_bar()
        self._create_header()
        self._create_content()
        self._create_footer()
        
        # Center window
        self.update_idletasks()
        width = self.winfo_width()
        height = self.winfo_height()
        x = (self.winfo_screenwidth() // 2) - (width // 2)
        y = (self.winfo_screenheight() // 2) - (height // 2)
        self.geometry(f'{width}x{height}+{x}+{y}')
        
        # Load config
        self._load_config()
        
        # Bind ESC key
        self.bind("<Escape>", lambda e: self.destroy())

    def _create_title_bar(self):
        """Create custom title bar with close button"""
        title_bar = tk.Frame(self, bg='#2196F3', height=30)
        title_bar.pack(fill=tk.X)
        title_bar.pack_propagate(False)
        # Title
        title_label = tk.Label(
            title_bar,
            text="Cấu hình làm việc",
            bg='#2196F3',
            fg='white',
            font=('Segoe UI', 18, 'bold'),
            justify='center',
            anchor='center'
        )
        title_label.pack(side=tk.LEFT, padx=20, expand=True)
        
        # Close button
        close_btn = tk.Label(title_bar, text='✕', bg='#2196F3', 
                           fg='white', cursor='hand2',
                           font=('Segoe UI', 10))
        close_btn.pack(side=tk.RIGHT, padx=10)
        close_btn.bind('<Button-1>', lambda e: self.destroy())
        
        # Make window draggable
        title_bar.bind('<Button-1>', self._get_pos)
        title_bar.bind('<B1-Motion>', self._move_window)
    
    def _create_header(self):
        """Create blue header with icon"""
        header = tk.Frame(self, bg='#2196F3', height=60)
        header.pack(fill=tk.X)
        header.pack_propagate(False)
          # Header label
        header_label = tk.Label(header, 
                              text="Vui lòng chọn khu vực và loại xe để bắt đầu",
                              bg='#2196F3', fg='white',
                              font=('Segoe UI', 16))
        header_label.pack(pady=15)
    def _create_content(self):
        """Create main content with rounded cards"""
        content = tk.Frame(self, bg='#f5f5f5')
        content.pack(fill=tk.BOTH, expand=True, padx=30, pady=25)
        
        # Zone selection card
        zone_card = self._create_card(content, "Chọn khu vực làm việc")
        # Load zones from API
        zones_data = api.layDanhSachKhuVuc()
        zones = [zone.tenKhuVuc for zone in zones_data]  # Get zone names from the data
        zone_cb = ttk.Combobox(zone_card, 
                              textvariable=self.selected_zone,
                              values=zones, 
                              state='readonly', 
                              width=40,
                              style='Config.TCombobox')
        zone_cb.pack(pady=(5, 15))
        
        # Bind zone change event
        zone_cb.bind('<<ComboboxSelected>>', 
                    lambda e: self._update_config_display())
        
        # Vehicle type card - Load from API
        vehicle_card = self._create_card(content, "Chọn loại xe")
        vehicles_data = api.layALLLoaiPhuongTien()
        vehicle_types = [vt.tenLoaiPT for vt in vehicles_data]
        vehicle_cb = ttk.Combobox(vehicle_card,
                                textvariable=self.selected_vehicle_type,
                                values=vehicle_types,
                                state='readonly',
                                width=40,
                                style='Config.TCombobox')
        vehicle_cb.pack(pady=(5, 15))
        
        # Bind vehicle type change event
        vehicle_cb.bind('<<ComboboxSelected>>', lambda e: self._update_config_display())
        
        # Current config card
        config_card = self._create_card(content, "Cấu hình hiện tại")
        
        # Create frame to hold centered text
        text_frame = tk.Frame(config_card, bg='white')
        text_frame.pack(fill=tk.X, pady=(5, 15))
        
        # Add empty label on left for centering
        tk.Label(text_frame, bg='white', width=10).pack(side=tk.LEFT, fill=tk.X, expand=True)
        
        # Add text widget in center
        self.config_text = tk.Text(text_frame, 
                                height=4, 
                                width=30,
                                font=('Segoe UI', 16),
                                relief=tk.FLAT,
                                bg='#f8f9fa',
                                padx=15,
                                pady=10)
        self.config_text.pack(side=tk.LEFT)
        self.config_text.configure(state='disabled')
        
        # Add empty label on right for centering
        tk.Label(text_frame, bg='white', width=10).pack(side=tk.LEFT, fill=tk.X, expand=True)
        
        # Center text within Text widget
        self.config_text.tag_configure('center', justify='center')
        self.config_text.tag_add('center', '1.0', 'end')
    
    def _create_footer(self):
        """Create footer with start button"""
        footer = tk.Frame(self, bg='#f5f5f5', height=80)
        footer.pack(fill=tk.X)
        footer.pack_propagate(False)        # Get button size based on window width
        btn_width = self.winfo_width() - 60 if self.winfo_width() > 0 else 540
        
        # Start button
        start_btn = tk.Button(footer, text="BẮT ĐẦU LÀM VIỆC",
                            bg='#2196F3', fg='white',
                            font=('Segoe UI', 13, 'bold'),
                            relief=tk.FLAT, cursor='hand2',
                            command=self._on_start)
        start_btn.configure(width=btn_width//10)  # Adjust width based on window size
        start_btn.pack(pady=20, padx=30, fill=tk.X)
        
        # Hover effects
        start_btn.bind('<Enter>',
                      lambda e: start_btn.configure(bg='#1976D2'))
        start_btn.bind('<Leave>',
                      lambda e: start_btn.configure(bg='#2196F3'))
    def _create_card(self, parent, title):
        """Create a card with rounded corners and title"""
        card = tk.Frame(parent, bg='white', padx=20, pady=20)
        card.pack(fill=tk.X, pady=12)
        
        # Add shadow and rounded effect
        card.configure(relief=tk.RAISED, borderwidth=1)
        
        # Create rounded rectangle background
        canvas = tk.Canvas(card, bg='white', highlightthickness=0, height=4)
        canvas.pack(fill=tk.X, side=tk.TOP)
        canvas.create_line(0, 2, card.winfo_width(), 2, 
                         fill='#2196F3', width=4)
        
        # Title with icon
        title_frame = tk.Frame(card, bg='white')
        title_frame.pack(fill=tk.X, pady=(0, 15))
        
        if title == "Chọn khu vực làm việc":
            icon_text = "🏢"
        elif title == "Chọn loại xe":
            icon_text = "🚗"
        else:
            icon_text = "⚙️"
            
        icon_label = tk.Label(title_frame, text=icon_text,
                            font=('Segoe UI', 16),
                            bg='white')
        icon_label.pack(side=tk.LEFT)
        
        title_label = tk.Label(title_frame, text=" " + title,
                             font=('Segoe UI', 12, 'bold'),
                             bg='white', fg='#1976D2')
        title_label.pack(side=tk.LEFT, padx=5)
        
        return card
    
    def _get_pos(self, event):
        """Get position for window dragging"""
        self._offsetx = event.x
        self._offsety = event.y
        
    def _move_window(self, event):
        """Move window when dragging"""
        x = self.winfo_x() + event.x - self._offsetx
        y = self.winfo_y() + event.y - self._offsety
        self.geometry(f'+{x}+{y}')
    def _load_config(self):
        """Load current configuration"""
        # TODO: Load from API/file
        current_config = {
            "zone": "Khu vực A",
            "vehicle_type": "Xe máy"
        }
        
        # Update comboboxes
        self.selected_zone.set(current_config["zone"])
        self.selected_vehicle_type.set(current_config["vehicle_type"])
        
        # Update config display
        self._update_config_display()
        
    def _update_config_display(self):
        """Update the config text display with current selections"""
        zone = self.selected_zone.get() or "Chưa chọn"
        vehicle = self.selected_vehicle_type.get() or "Chưa chọn"
          # Update selected zone data
        self.selected_zone_data = None
        if zone != "Chưa chọn":
            zones_data = api.layDanhSachKhuVuc()
            for z in zones_data:
                # Nếu là object (Pydantic/BaseModel)
                if hasattr(z, 'tenKhuVuc') and z.tenKhuVuc == zone:
                    self.selected_zone_data = z
                    break
                # Nếu là dict
                elif isinstance(z, dict) and z.get('tenKhuVuc') == zone:
                    self.selected_zone_data = z
                    break
        
        self.config_text.configure(state='normal')
        self.config_text.delete(1.0, tk.END)        
        self.config_text.insert(tk.END, 
                              f"Khu vực: {zone}\n" + 
                              f"Loại xe: {vehicle}")
        self.config_text.tag_add('center', '1.0', 'end')  # Apply center alignment
        self.config_text.configure(state='disabled')
        
    def _on_start(self):
        """Handle start button click"""
        print("[DEBUG] Bắt đầu xử lý nút BẮT ĐẦU LÀM VIỆC")
        zone = self.selected_zone.get()
        vehicle_type = self.selected_vehicle_type.get()
        print(f"[DEBUG] Khu vực được chọn: {zone}")
        print(f"[DEBUG] Loại xe được chọn: {vehicle_type}")

        # Đảm bảo luôn cập nhật selected_zone_data
        self.selected_zone_data = None
        if zone and zone != "Chưa chọn":
            zones_data = api.layDanhSachKhuVuc()
            for z in zones_data:
                if hasattr(z, 'tenKhuVuc') and z.tenKhuVuc == zone:
                    self.selected_zone_data = z
                    break
                elif isinstance(z, dict) and z.get('tenKhuVuc') == zone:
                    self.selected_zone_data = z
                    break

        ma_khu_vuc = None
        if self.selected_zone_data:
            ma_khu_vuc = getattr(self.selected_zone_data, 'maKhuVuc', None)
            if not ma_khu_vuc and isinstance(self.selected_zone_data, dict):
                ma_khu_vuc = self.selected_zone_data.get('maKhuVuc')
        print(f"[DEBUG] Mã khu vực lấy được: {ma_khu_vuc}")

        # Luôn chuẩn hóa loại xe
        vt = (vehicle_type or "").strip().lower()
        if vt in ['xe máy', 'xe may', 'xe_may']:
            loai_xe = 'xe_may'
        elif vt in ['ô tô', 'oto', 'xe hơi', 'xe_hoi', 'xe hoi']:
            loai_xe = 'oto'
        else:
            loai_xe = None

        config = {
            "zone": zone,
            "zone_data": self.selected_zone_data,
            "vehicle_type": vehicle_type,
            "loai_xe": loai_xe,
            "ma_khu_vuc": ma_khu_vuc
        }
        print(f"[DEBUG] Config truyền ra callback: {config}")
        self.result = config
        # Lưu config vào file work_config.json
        try:
            config_path = os.path.join(os.path.dirname(__file__), '../server/config/work_config.json')
            with open(config_path, 'w', encoding='utf-8') as f:
                # Luôn chuyển zone_data về dict
                serializable_config = dict(config)
                zone_data = serializable_config.get('zone_data')
                if hasattr(zone_data, '__dict__'):
                    serializable_config['zone_data'] = dict(zone_data.__dict__)
                elif not isinstance(zone_data, dict):
                    serializable_config['zone_data'] = {}
                json.dump(serializable_config, f, ensure_ascii=False, indent=2)
            print(f"[DEBUG] Đã lưu config vào {config_path}")
        except Exception as e:
            print(f"[DEBUG] Lỗi khi lưu config vào file: {e}")
        if self.on_config_saved:
            print("[DEBUG] Gọi callback on_config_saved với config")
            self.on_config_saved(config)
        self.destroy()

    def _on_zone_selected(self, event=None):
        # Get the selected zone
        zone_name = self.selected_zone.get()
        
        # Find the full zone data
        for zone in self.zones:
            if zone["tenKhuVuc"] == zone_name:
                self.selected_zone_data = zone
                break

        if self.selected_zone_data:
            try:
                zone_info = api.get_zone_info(self.selected_zone_data["maKhuVuc"])
                self.selected_zone_data.update(zone_info)
            except Exception as e:
                messagebox.showerror("Lỗi", f"Không thể lấy thông tin khu vực: {str(e)}")

    def get_selected_zone(self):
        return self.selected_zone_data