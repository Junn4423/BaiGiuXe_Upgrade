import time
import tkinter as tk
import os
import sys
from components.login import show_login_dialog
from dialogs.WorkConfigDialog import WorkConfigDialog
import cv2
import logging
from dialogs.StartupDialog import StartupDialog
from dialogs.CameraConfigDialog import CameraConfigDialog
import json
from components.QuanLyCamera import QuanLyCamera
from components.QuanLyXe import QuanLyXe
from components.DauDocThe import DauDocThe


def show_work_config_dialog(root):
    work_config = None
    def on_config_saved(config):
        nonlocal work_config
        work_config = config
        
    dialog = WorkConfigDialog(root, on_config_saved=on_config_saved)
    root.wait_window(dialog)
    return work_config

def load_camera_config():
    return None
try:
    from components.ui import GiaoDienQuanLyBaiXe
except ImportError:
    class GiaoDienQuanLyBaiXe(tk.Frame):
        def __init__(self, master, camera_manager, vehicle_manager, card_reader):
            super().__init__(master)
            self.master = master
            master.title("Hệ thống quản lý bãi xe")
            tk.Label(self, text="Giao diện chính của ứng dụng").pack(pady=20)
            tk.Button(self, text="Thoát ứng dụng", command=self.master.destroy).pack(pady=10)
            self.pack(fill=tk.BOTH, expand=True)
        
            self.tao_giao_dien()
            self.setup_connections()  # Chỉ gọi 1 lần duy nhất
            self.start_services()
            # Gọi dialog cấu hình làm việc ngay lần đầu
            self.root.after(100, self.mo_cau_hinh_lam_viec)

        def mo_cau_hinh_lam_viec(self):
            from dialogs.WorkConfigDialog import WorkConfigDialog
            def on_config_saved(config):
                print(f"[DEBUG] main_ui.mo_cau_hinh_lam_viec: Nhận config từ WorkConfigDialog: {config}")
                self.cap_nhat_che_do_theo_config(config)
                # KHÔNG GỌI setup_connections() ở đây!
            dialog = WorkConfigDialog(self.root, on_config_saved=on_config_saved)
            dialog.grab_set()

def main():
    root = tk.Tk()
    root.withdraw()     # Nếu đăng nhập thành công
    if show_login_dialog(root):
        # Hiển thị dialog cấu hình làm việc
        work_config = show_work_config_dialog(root)
        if not work_config:
            root.destroy()
            return
            
        quan_ly_camera = QuanLyCamera()
        quan_ly_xe = QuanLyXe()
        dau_doc_the = DauDocThe()        # Cấu hình cửa sổ chính
        root.state('zoomed')  # Maximize window
        root.resizable(True, True)  # Cho phép thay đổi kích thước
        
        # Thiết lập window attributes
        root.overrideredirect(True)  # Ẩn title bar mặc định của Windows
        root.attributes('-topmost', True)  # Luôn hiển thị trên cùng
        root.attributes("-alpha", 1.0)  # Đảm bảo opacity đầy đủ
        
        # Đặt icon cho taskbar
        try:
            icon_path = os.path.join(os.path.dirname(__file__), "assets", "parking_icon.ico")
            root.iconbitmap(icon_path)
            # Đăng ký taskbar icon
            import ctypes
            myappid = 'sof.vn.parking.management.1.0'  # Định danh duy nhất cho app
            ctypes.windll.shell32.SetCurrentProcessExplicitAppUserModelID(myappid)
        except Exception as e:
            print(f"Không thể load icon: {str(e)}")
            
        # Bind Alt-Tab event
        def on_alt_tab(event):
            root.deiconify()  # Hiển thị lại window khi alt-tab
            root.lift()  # Đưa window lên trên cùng
            return "break"  # Ngăn không cho event tiếp tục xử lý
            
        root.bind("<Alt-Tab>", on_alt_tab)
        root.bind("<Alt-Shift-Tab>", on_alt_tab)
        
        app = GiaoDienQuanLyBaiXe(root, quan_ly_camera, quan_ly_xe, dau_doc_the)
        root.deiconify()
        root.mainloop()

    root.destroy()

if __name__ == "__main__":
    main()