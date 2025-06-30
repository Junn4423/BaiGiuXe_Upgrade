import tkinter as tk
from tkinter import ttk, messagebox
import json
import os
from .PricingPolicyDialog import PricingPolicyDialog
# from .WorkConfigDialog import WorkConfigDialog
import server.api as api

class StartupDialog:
    def __init__(self, parent):
        self.parent = parent
        self.ket_qua = None
        self.tao_dialog()
        
    def tao_dialog(self):
        """Tạo dialog chọn chế độ khởi động"""
        self.dialog = tk.Toplevel(self.parent)
        self.dialog.title("Chọn Chế Độ Khởi Động")
        self.dialog.state('zoomed')
        self.dialog.geometry("400x300")
        self.dialog.resizable(False, False)
        
        # Đặt dialog ở giữa màn hình
        self.dialog.update_idletasks()
        width = self.dialog.winfo_width()
        height = self.dialog.winfo_height()
        x = (self.dialog.winfo_screenwidth() // 2) - (width // 2)
        y = (self.dialog.winfo_screenheight() // 2) - (height // 2)
        self.dialog.geometry(f'{width}x{height}+{x}+{y}')
        
        # Tạo frame chính
        main_frame = tk.Frame(self.dialog, padx=20, pady=20)
        main_frame.pack(fill=tk.BOTH, expand=True)
        
        # Tiêu đề
        tk.Label(
            main_frame,
            text="Chọn Chế Độ Khởi Động",
            font=("Helvetica", 14, "bold"),
            pady=10
        ).pack()
        
        # Nút bắt đầu phiên làm việc
        btn_start = tk.Button(
            main_frame,
            text="Bắt Đầu Phiên Làm Việc",
            font=("Helvetica", 12),
            bg="#3b82f6",
            fg="white",
            padx=20,
            pady=10,
            command=self.bat_dau_lam_viec
        )
        btn_start.pack(pady=10)
        
        # Nút cấu hình camera
        btn_config = tk.Button(
            main_frame,
            text="Cấu Hình Camera",
            font=("Helvetica", 12),
            bg="#10b981",
            fg="white",
            padx=20,
            pady=10,
            command=self.cau_hinh_camera
        )
        btn_config.pack(pady=10)
        
        # Nút cấu hình chính sách giá
        btn_pricing = tk.Button(
            main_frame,
            text="Cấu Hình Chính Sách Giá",
            font=("Helvetica", 12),
            bg="#8b5cf6",
            fg="white",
            padx=20,
            pady=10,
            command=self.cau_hinh_chinh_sach_gia
        )
        btn_pricing.pack(pady=10)
        
        # Đặt dialog là modal
        self.dialog.transient(self.parent)
        self.dialog.grab_set()
        
    # def bat_dau_lam_viec(self):
    #     """Xử lý khi chọn bắt đầu phiên làm việc"""
    #     # Mở dialog cấu hình làm việc
    #     config_dialog = WorkConfigDialog(self.dialog)
    #     cau_hinh = config_dialog.show()
        
    #     if cau_hinh is None:
    #         return
            
    #     self.ket_qua = {
    #         "action": "start",
    #         "config": cau_hinh
    #     }
    #     self.dialog.destroy()
        
    def cau_hinh_camera(self):
        """Xử lý khi chọn cấu hình camera"""
        self.ket_qua = "config"
        self.dialog.destroy()
        
    def cau_hinh_chinh_sach_gia(self):
        """Xử lý khi chọn cấu hình chính sách giá"""
        try:
            policies = api.layALLChinhSachGia()
            if not policies:
                messagebox.showwarning("Cảnh báo", "Không có dữ liệu chính sách giá")
                return
                
            PricingPolicyDialog(self.dialog)
        except Exception as e:
            messagebox.showerror("Lỗi", f"Không thể mở cấu hình chính sách giá: {str(e)}")