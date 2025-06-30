import tkinter as tk
from tkinter import ttk, messagebox
import server.api as api

class PricingPolicyDialog:
    def __init__(self, parent):
        self.parent = parent
        self.dialog = tk.Toplevel(parent)
        self.dialog.title("Quản Lý Chính Sách Giá")
        
        # Cấu hình cửa sổ
        window_width = 1200
        window_height = 800
        screen_width = self.dialog.winfo_screenwidth()
        screen_height = self.dialog.winfo_screenheight()
        x = (screen_width - window_width) // 2
        y = (screen_height - window_height) // 2
        self.dialog.geometry(f'{window_width}x{window_height}+{x}+{y}')
        self.dialog.transient(parent)
        self.dialog.grab_set()
        
        # Thiết lập style
        self.setup_styles()
        
        self.init_ui()
        self.load_policies()
        parent.wait_window(self.dialog)

    def setup_styles(self):
        style = ttk.Style()
        
        # Main style configuration
        style.configure('Policy.TFrame', background='#f0f4f8')
        style.configure('Policy.TLabelframe', background='#f0f4f8')
        style.configure('Policy.TLabelframe.Label', 
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
                       padding=10)
        
        style.configure('Delete.TButton',
                       font=('Helvetica', 10),
                       padding=10)
        
        # Treeview styles
        style.configure('Policy.Treeview',
                       font=('Helvetica', 10),
                       rowheight=30)
        
        style.configure('Policy.Treeview.Heading',
                       font=('Helvetica', 11, 'bold'))

    def init_ui(self):
        # Main container with padding
        main_frame = ttk.Frame(self.dialog, padding="20", style='Policy.TFrame')
        main_frame.pack(fill=tk.BOTH, expand=True)

        # Header with back button
        header_frame = ttk.Frame(main_frame, style='Policy.TFrame')
        header_frame.pack(fill=tk.X, pady=(0, 20))
        
        ttk.Button(
            header_frame,
            text="Quay lại",
            style='Action.TButton',
            command=self.quay_lai
        ).pack(side=tk.LEFT)
        
        ttk.Label(
            header_frame,
            text="Quản Lý Chính Sách Giá",
            style='Header.TLabel'
        ).pack(side=tk.LEFT, padx=20)

        # Container for tree and form
        content_frame = ttk.Frame(main_frame, style='Policy.TFrame')
        content_frame.pack(fill=tk.BOTH, expand=True)

        # Treeview panel
        tree_frame = ttk.LabelFrame(
            content_frame,
            text="Danh Sách Chính Sách",
            padding="15",
            style='Policy.TLabelframe'
        )
        tree_frame.pack(fill=tk.BOTH, expand=True, side=tk.LEFT, padx=(0, 10))

        columns = ("Mã chính sách", "Loại xe", "Thời gian (phút)", 
                  "Đơn giá gói", "Tính quá giờ", "Đơn giá quá giờ")
        
        self.tree = ttk.Treeview(
            tree_frame,
            columns=columns,
            show="headings",
            style='Policy.Treeview'
        )
        
        # Configure columns
        for col in columns:
            self.tree.heading(col, text=col)
            self.tree.column(col, width=120)

        # Add scrollbar
        scrollbar = ttk.Scrollbar(tree_frame, orient=tk.VERTICAL, command=self.tree.yview)
        self.tree.configure(yscrollcommand=scrollbar.set)
        
        self.tree.pack(side=tk.LEFT, fill=tk.BOTH, expand=True)
        scrollbar.pack(side=tk.RIGHT, fill=tk.Y)

        # Form panel
        form_frame = ttk.LabelFrame(
            content_frame,
            text="Thông Tin Chính Sách",
            padding="15",
            style='Policy.TLabelframe'
        )
        form_frame.pack(fill=tk.Y, side=tk.LEFT, padx=(10, 0))

        # Form fields with better layout
        fields = [
            ("Mã chính sách:", "policy_id"),
            ("Loại xe:", "vehicle_type"),
            ("Thời gian (phút):", "time_limit"),
            ("Đơn giá gói:", "base_price"),
            ("Đơn giá quá giờ:", "over_time_price")
        ]

        self.entries = {}
        
        for i, (label_text, field_name) in enumerate(fields):
            field_frame = ttk.Frame(form_frame, style='Policy.TFrame')
            field_frame.pack(fill=tk.X, pady=5)
            
            ttk.Label(
                field_frame,
                text=label_text,
                style='Form.TLabel'
            ).pack(anchor=tk.W)
            
            if field_name == "vehicle_type":
                self.entries[field_name] = ttk.Combobox(
                    field_frame,
                    values=["XE_MAY", "OT"],
                    width=28,
                    font=('Helvetica', 11)
                )
            else:
                self.entries[field_name] = ttk.Entry(
                    field_frame,
                    width=30,
                    font=('Helvetica', 11)
                )
            self.entries[field_name].pack(fill=tk.X, pady=(5, 0))

        # Checkbox for overtime
        check_frame = ttk.Frame(form_frame, style='Policy.TFrame')
        check_frame.pack(fill=tk.X, pady=10)
        
        self.over_time = tk.BooleanVar()
        ttk.Checkbutton(
            check_frame,
            text="Tính phí quá giờ",
            variable=self.over_time,
            style='Policy.TCheckbutton'
        ).pack(anchor=tk.W)

        # Button frame
        button_frame = ttk.Frame(form_frame, style='Policy.TFrame')
        button_frame.pack(fill=tk.X, pady=(20, 0))

        # Action buttons with better styling
        buttons = [
            ("Thêm mới", self.add_policy, 'Action.TButton'),
            ("Cập nhật", self.update_policy, 'Action.TButton'),
            ("Xóa", self.delete_policy, 'Delete.TButton'),
            ("Làm mới", self.clear_form, 'Action.TButton')
        ]

        for text, command, style in buttons:
            ttk.Button(
                button_frame,
                text=text,
                command=command,
                style=style
            ).pack(side=tk.LEFT, padx=5)

        # Bind tree selection
        self.tree.bind('<<TreeviewSelect>>', self.on_select)

    def quay_lai(self):
        """Quay lại màn hình trước"""
        self.ket_qua = "back_to_startup"
        self.dialog.destroy()

    def load_policies(self):
        try:
            policies = api.layALLChinhSachGia()
            for item in self.tree.get_children():
                self.tree.delete(item)
            for policy in policies:
                self.tree.insert('', tk.END, values=(
                    policy['lv001'],
                    policy['lv002'],
                    policy['lv003'],
                    policy['lv004'],
                    "Có" if int(policy['lv005']) else "Không",
                    policy['lv006']
                ))
        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể tải dữ liệu: {str(e)}")

    def on_select(self, event):
        selected_items = self.tree.selection()
        if not selected_items:
            return
        item = self.tree.item(selected_items[0])
        values = item['values']
        self.entries['policy_id'].delete(0, tk.END)
        self.entries['policy_id'].insert(0, values[0])
        self.entries['vehicle_type'].set(values[1])
        self.entries['time_limit'].delete(0, tk.END)
        self.entries['time_limit'].insert(0, values[2])
        self.entries['base_price'].delete(0, tk.END)
        self.entries['base_price'].insert(0, values[3])
        self.over_time.set(values[4] == "Có")
        self.entries['over_time_price'].delete(0, tk.END)
        self.entries['over_time_price'].insert(0, values[5])

    def validate_input(self):
        if not self.entries['policy_id'].get():
            messagebox.showwarning("Lỗi", "Vui lòng nhập mã chính sách")
            return False
        if not self.entries['vehicle_type'].get():
            messagebox.showwarning("Lỗi", "Vui lòng chọn loại xe")
            return False
        try:
            time_limit = int(self.entries['time_limit'].get())
            if time_limit <= 0:
                messagebox.showwarning("Lỗi", "Thời gian phải lớn hơn 0")
                return False
        except ValueError:
            messagebox.showwarning("Lỗi", "Thời gian không hợp lệ")
            return False
        try:
            base_price = float(self.entries['base_price'].get())
            if base_price < 0:
                messagebox.showwarning("Lỗi", "Đơn giá gói không được âm")
                return False
        except ValueError:
            messagebox.showwarning("Lỗi", "Đơn giá gói không hợp lệ")
            return False
        try:
            over_time_price = float(self.entries['over_time_price'].get())
            if over_time_price < 0:
                messagebox.showwarning("Lỗi", "Đơn giá quá giờ không được âm")
                return False
        except ValueError:
            messagebox.showwarning("Lỗi", "Đơn giá quá giờ không hợp lệ")
            return False
        return True

    def add_policy(self):
        if not self.validate_input():
            return
        policy_data = {
            'lv001': self.entries['policy_id'].get(),
            'lv002': self.entries['vehicle_type'].get(),
            'lv003': int(self.entries['time_limit'].get()),
            'lv004': float(self.entries['base_price'].get()),
            'lv005': 1 if self.over_time.get() else 0,
            'lv006': float(self.entries['over_time_price'].get())
        }
        try:
            result = api.themChinhSachGia(policy_data)
            if result['success']:
                messagebox.showinfo("Thành công", "Thêm chính sách thành công")
                self.load_policies()
                self.clear_form()
            else:
                messagebox.showwarning("Lỗi", result['message'])
        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể thêm chính sách: {str(e)}")

    def update_policy(self):
        if not self.entries['policy_id'].get():
            messagebox.showwarning("Lỗi", "Vui lòng chọn chính sách cần cập nhật")
            return
        if not self.validate_input():
            return
        policy_data = {
            'lv002': self.entries['vehicle_type'].get(),
            'lv003': int(self.entries['time_limit'].get()),
            'lv004': float(self.entries['base_price'].get()),
            'lv005': 1 if self.over_time.get() else 0,
            'lv006': float(self.entries['over_time_price'].get())
        }
        try:
            result = api.capNhatChinhSachGia(self.entries['policy_id'].get(), policy_data)
            if result['success']:
                messagebox.showinfo("Thành công", "Cập nhật chính sách thành công")
                self.load_policies()
                self.clear_form()
            else:
                messagebox.showwarning("Lỗi", result['message'])
        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể cập nhật chính sách: {str(e)}")

    def delete_policy(self):
        if not self.entries['policy_id'].get():
            messagebox.showwarning("Lỗi", "Vui lòng chọn chính sách cần xóa")
            return
        if messagebox.askyesno("Xác nhận", "Bạn có chắc chắn muốn xóa chính sách này?"):
            try:
                result = api.xoaChinhSachGia(self.entries['policy_id'].get())
                if result['success']:
                    messagebox.showinfo("Thành công", "Xóa chính sách thành công")
                    self.load_policies()
                    self.clear_form()
                else:
                    messagebox.showwarning("Lỗi", result['message'])
            except Exception as e:
                messagebox.showerror("Lỗi", f"Không thể xóa chính sách: {str(e)}")

    def clear_form(self):
        for entry in self.entries.values():
            entry.delete(0, tk.END)
        self.entries['time_limit'].insert(0, '240')
        self.entries['base_price'].insert(0, '5000')
        self.over_time.set(False)
        self.entries['over_time_price'].insert(0, '2000')