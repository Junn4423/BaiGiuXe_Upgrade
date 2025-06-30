import tkinter as tk
from components.ui import GiaoDienQuanLyBaiXe
from components.QuanLyCamera import QuanLyCamera
from components.QuanLyXe import QuanLyXe  
from components.DauDocThe import DauDocThe

print('✓ Import tất cả components thành công!')

# Test khởi tạo (không hiển thị GUI)
root = tk.Tk()
root.withdraw()  # Ẩn cửa sổ

quan_ly_camera = QuanLyCamera()
quan_ly_xe = QuanLyXe()
dau_doc_the = DauDocThe()

app = GiaoDienQuanLyBaiXe(root, quan_ly_camera, quan_ly_xe, dau_doc_the)
print('✓ Khởi tạo UI với components mới thành công!')

root.destroy()
print('✓ Test hoàn tất!')
