import tkinter as tk
from tkinter import ttk, messagebox
from server import api

class ThemTheDialog:
    def __init__(self, parent, uid_the):
        self.parent = parent
        self.uid_the = uid_the
        self.ket_qua = None
        self.dialog = None
        
        self.tao_dialog()
    
    def tao_dialog(self):
        """Tạo dialog thêm thẻ mới"""
        self.dialog = tk.Toplevel(self.parent)
        self.dialog.title("Thêm thẻ RFID mới")
        self.dialog.geometry("480x360")
        self.dialog.resizable(False, False)
        self.dialog.transient(self.parent)
        self.dialog.grab_set()
        
        # Center dialog
        self.dialog.update_idletasks()
        x = (self.dialog.winfo_screenwidth() // 2) - (400 // 2)
        y = (self.dialog.winfo_screenheight() // 2) - (300 // 2)
        self.dialog.geometry(f"480x360+{x}+{y}")
        
        # Main frame
        main_frame = ttk.Frame(self.dialog, padding="20")
        main_frame.pack(fill=tk.BOTH, expand=True)
        
        # Title
        title_label = ttk.Label(main_frame, text="Thêm thẻ RFID mới", 
                               font=("Arial", 14, "bold"))
        title_label.pack(pady=(0, 20))
        
        # UID thẻ (readonly)
        ttk.Label(main_frame, text="UID thẻ:", font=("Arial", 10, "bold")).pack(anchor="w")
        uid_frame = ttk.Frame(main_frame)
        uid_frame.pack(fill="x", pady=(5, 15))
        
        self.uid_entry = ttk.Entry(uid_frame, font=("Arial", 10))
        self.uid_entry.pack(fill="x")
        self.uid_entry.insert(0, self.uid_the)
        self.uid_entry.config(state="readonly")
        
        # Loại thẻ
        ttk.Label(main_frame, text="Loại thẻ:", font=("Arial", 10, "bold")).pack(anchor="w")
        loai_the_frame = ttk.Frame(main_frame)
        loai_the_frame.pack(fill="x", pady=(5, 15))
        
        self.loai_the_var = tk.StringVar()
        self.loai_the_combo = ttk.Combobox(loai_the_frame, textvariable=self.loai_the_var,
                                          font=("Arial", 10))
        self.loai_the_combo['values'] = ["KHACH", "VIP", "NHANVIEN"]
        self.loai_the_combo.pack(fill="x")
        self.loai_the_combo.current(0) 
        
        # Trạng thái
        ttk.Label(main_frame, text="Trạng thái:", font=("Arial", 10, "bold")).pack(anchor="w")
        trang_thai_frame = ttk.Frame(main_frame)
        trang_thai_frame.pack(fill="x", pady=(5, 20))
        
        self.trang_thai_var = tk.StringVar()
        self.trang_thai_combo = ttk.Combobox(trang_thai_frame, textvariable=self.trang_thai_var,
                                           font=("Arial", 10))
        self.trang_thai_combo['values'] = ["Hoạt động"]
        self.trang_thai_combo.pack(fill="x")
        self.trang_thai_combo.current(0)  # Chọn mặc định "Hoạt động"
        
        # Button frame
        button_frame = ttk.Frame(main_frame)
        button_frame.pack(fill="x", pady=(20, 0))
        
        # Thêm thẻ button
        self.them_button = ttk.Button(button_frame, text="Thêm thẻ", 
                                     command=self.them_the, style="Accent.TButton")
        self.them_button.pack(side="left", padx=(0, 10))
        
        # Hủy button
        self.huy_button = ttk.Button(button_frame, text="Hủy", 
                                    command=self.huy)
        self.huy_button.pack(side="left")
        
        # Status label
        self.status_label = ttk.Label(main_frame, text="", foreground="blue")
        self.status_label.pack(pady=(10, 0))
        
        # Bind Enter key
        self.dialog.bind('<Return>', lambda e: self.them_the())
        self.dialog.bind('<Escape>', lambda e: self.huy())
        
        # Focus vào combobox loại thẻ
        self.loai_the_combo.focus()
    
    def them_the(self):
        """Xử lý thêm thẻ mới"""
        loai_the = self.loai_the_var.get().strip()
        trang_thai_text = self.trang_thai_var.get().strip()
        
        if not loai_the:
            messagebox.showerror("Lỗi", "Vui lòng chọn loại thẻ!")
            return
        
        # Convert trạng thái text thành số
        trang_thai_map = {
            "Hoạt động": "1"
        }
        trang_thai = trang_thai_map.get(trang_thai_text, "1")
        
        # Disable buttons và hiển thị trạng thái
        self.them_button.config(state="disabled")
        self.huy_button.config(state="disabled")
        self.status_label.config(text="Đang thêm thẻ...", foreground="blue")
        self.dialog.update()
        
        try:
            # Gọi API thêm thẻ
            result = api.themThe(self.uid_the, loai_the, trang_thai)
            
            if result.get("success", False):
                self.status_label.config(text="Thêm thẻ thành công!", foreground="green")
                self.dialog.update()
                self.ket_qua = "success"
                messagebox.showinfo("Thành công", "Thẻ đã được thêm vào hệ thống!")
                self.dialog.destroy()
            else:
                error_msg = result.get("message", "Lỗi không xác định")
                self.status_label.config(text=f"Lỗi: {error_msg}", foreground="red")
                messagebox.showerror("Lỗi", f"Không thể thêm thẻ: {error_msg}")
                
        except Exception as e:
            self.status_label.config(text=f"Lỗi: {str(e)}", foreground="red")
            messagebox.showerror("Lỗi", f"Có lỗi xảy ra: {str(e)}")
        
        finally:
            # Enable lại buttons
            self.them_button.config(state="normal")
            self.huy_button.config(state="normal")
    
    def huy(self):
        """Hủy dialog"""
        self.ket_qua = "cancel"
        self.dialog.destroy()
    
    def show(self):
        """Hiển thị dialog và đợi kết quả"""
        self.dialog.wait_window()
        return self.ket_qua

def hien_thi_dialog_them_the(parent, uid_the):
    dialog = ThemTheDialog(parent, uid_the)
    return dialog.show()
