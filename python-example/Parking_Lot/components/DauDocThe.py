import threading
import keyboard
from server import api
from dialogs.ThemTheDialog import hien_thi_dialog_them_the
import tkinter.messagebox as messagebox

class DauDocThe:
    def __init__(self):
        self.luong_doc_the = None
        self.dang_chay = False
        self.dang_quet = False
        self.ui = None
        self.quan_ly_xe = None
        self.quan_ly_camera = None
        self.bo_dem_the = ""

    def dat_ui(self, ui):
        self.ui = ui
        self.quan_ly_xe = ui.quan_ly_xe
        self.quan_ly_camera = ui.quan_ly_camera

    def bat_dau_doc_the(self):
        self.luong_doc_the = threading.Thread(target=self.vong_lap_doc_the, daemon=True)
        self.dang_chay = True
        self.luong_doc_the.start()

    def dung_doc_the(self):
        self.dang_chay = False
        if self.luong_doc_the and self.luong_doc_the.is_alive():
            self.luong_doc_the.join(1.0)

    def reset_trang_thai_quet(self):
        """Reset trạng thái quét thẻ để cho phép quét tiếp"""
        self.dang_quet = False
        self.bo_dem_the = ""

    def vong_lap_doc_the(self):
        try:
            while self.dang_chay:
                event = keyboard.read_event()
                if event.event_type == keyboard.KEY_DOWN:
                    if event.name == 'enter':
                        if self.bo_dem_the and not self.dang_quet:
                            self.dang_quet = True
                            ma_the = self.bo_dem_the
                            if self.ui:
                                # Hiển thị thông báo đang xử lý thay vì thành công
                                self.ui.root.after(0, lambda: self.ui.cap_nhat_trang_thai_dau_doc(f"Đang xử lý thẻ: {ma_the}...", "#f39c12"))
                                self.ui.root.after(100, lambda id=ma_the: self.xu_ly_quet_the(id))
                            self.bo_dem_the = ""
                        else:
                            self.bo_dem_the = ""
                    elif len(event.name) == 1:
                        self.bo_dem_the += event.name
        except Exception as e:
            print(f"Lỗi đầu đọc thẻ: {e}")

    def xu_ly_quet_the(self, ma_the):
        try:
            if self.ui:
                self.ui.cap_nhat_trang_thai_dau_doc(f"Đang xử lý thẻ: {ma_the}...", "#f39c12")
            
            if self.ui and self.quan_ly_camera and self.quan_ly_xe:
                che_do_hien_tai = self.ui.che_do_hien_tai
                khu = getattr(self.ui, 'khu_hien_tai', None)
                if not khu:
                    print("Không có khu hiện tại!")
                    if self.ui:
                        self.ui.cap_nhat_trang_thai_dau_doc("Lỗi: Không có khu hiện tại", "#e74c3c")
                    return
                
                if che_do_hien_tai == "vao":
                    cong_vao_str = khu['congVao'][0]['maCong'] if khu.get('congVao') and len(khu['congVao']) > 0 else "N/A"
                    camera_id = khu['cameraVao'][0]['maCamera'] if khu.get('cameraVao') and len(khu['cameraVao']) > 0 else "N/A"
                    khung_hinh_chup, bien_so, duong_dan_face_vao = self.quan_ly_camera.chup_anh(ma_the, che_do="vao")
                    print(f"Ảnh xe vào: {khung_hinh_chup}, Biển số: {bien_so}, Ảnh face vào: {duong_dan_face_vao}")  # Debug
                    
                    # Cập nhật biển số xe vào khung biển số
                    if bien_so and self.ui:
                        self.ui.khung_hien_thi_bien_so.config(text=bien_so.upper())
                    if not khung_hinh_chup:
                        print("Lỗi: Không chụp được ảnh xe vào")
                        if self.ui:
                            self.ui.cap_nhat_trang_thai_dau_doc("Lỗi: Không chụp được ảnh xe vào", "#e74c3c")
                        return
                    
                    # Gọi xử lý xe vào - method này sẽ tự báo kết quả
                    res = self.quan_ly_xe.xu_ly_xe_vao(ma_the, khung_hinh_chup, bien_so, None, cong_vao_str, camera_id, duong_dan_face_vao)
                      # Kiểm tra nếu có lỗi thẻ không tồn tại
                    if res and isinstance(res, dict) and not res.get("success", True):
                        message = res.get("message", "Có lỗi xảy ra")
                        
                        # Nếu lỗi liên quan đến thẻ không tồn tại
                        if ("không tồn tại" in message.lower() or 
                            "chưa tồn tại" in message.lower() or 
                            "not found" in message.lower() or 
                            "không tìm thấy" in message.lower() or
                            "not exist" in message.lower() or
                            "does not exist" in message.lower()):
                            if self.ui:
                                self.ui.cap_nhat_trang_thai_dau_doc(f"Thẻ {ma_the} chưa được đăng ký", "#f39c12")
                            
                            # Hiển thị dialog hỏi có muốn thêm thẻ không
                            answer = messagebox.askyesno(
                                "Thẻ chưa đăng ký",
                                f"Thẻ {ma_the} chưa được đăng ký trong hệ thống.\n\nBạn có muốn thêm thẻ này không?",
                                icon="question"
                            )
                            
                            if answer:
                                # Hiển thị dialog thêm thẻ
                                ket_qua = hien_thi_dialog_them_the(self.ui.root, ma_the)
                                
                                if ket_qua == "success":
                                    # Thẻ đã được thêm thành công, thử lại xử lý xe vào
                                    if self.ui:
                                        self.ui.cap_nhat_trang_thai_dau_doc(f"Thẻ {ma_the} đã được thêm, đang xử lý lại...", "#27ae60")
                                    # Gọi lại xử lý xe vào
                                    self.quan_ly_xe.xu_ly_xe_vao(ma_the, khung_hinh_chup, bien_so, None, cong_vao_str, camera_id, duong_dan_face_vao)
                                else:
                                    # User hủy hoặc có lỗi
                                    if self.ui:
                                        self.ui.cap_nhat_trang_thai_dau_doc("Đã hủy thêm thẻ", "#95a5a6")
                            else:
                                # User không muốn thêm thẻ
                                if self.ui:
                                    self.ui.cap_nhat_trang_thai_dau_doc("Từ chối thêm thẻ", "#95a5a6")
                        else:
                            # Lỗi khác, hiển thị lỗi bình thường
                            if self.ui:
                                self.ui.hien_thi_loi("Lỗi xe vào", message)
                
                else:  # che_do_hien_tai == "ra"
                    cong_ra_str = khu['congRa'][0]['maCong'] if khu.get('congRa') and len(khu['congRa']) > 0 else "N/A"
                    camera_id = khu['cameraRa'][0]['maCamera'] if khu.get('cameraRa') and len(khu['cameraRa']) > 0 else "N/A"
                    anh_ra_path, bien_so_ra, duong_dan_face_ra = self.quan_ly_camera.chup_anh(ma_the, che_do="ra")
                    print(f"Ảnh xe ra: {anh_ra_path}, Biển số: {bien_so_ra}, Ảnh face ra: {duong_dan_face_ra}")  # Debug
                    
                    # Cập nhật biển số xe ra khung biển số
                    if bien_so_ra and self.ui:
                        self.ui.khung_hien_thi_bien_so.config(text=bien_so_ra.upper())
                    if not anh_ra_path:
                        print("Lỗi: Không chụp được ảnh xe ra")
                        if self.ui:
                            self.ui.cap_nhat_trang_thai_dau_doc("Lỗi: Không chụp được ảnh xe ra", "#e74c3c")
                        return
                    
                    plate_match = 1
                    # Gọi xử lý xe ra - method này sẽ tự báo kết quả
                    res = self.quan_ly_xe.xu_ly_xe_ra(
                        ma_the,
                        anh_ra_path,
                        cong_ra_str,
                        camera_id,
                        plate_match,
                        bien_so_ra,
                        duong_dan_face_ra
                    )
                    
                    # Kiểm tra nếu có lỗi thẻ không tồn tại cho xe ra
                    if res and isinstance(res, dict) and not res.get("success", True):
                        message = res.get("message", "Có lỗi xảy ra")
                          # Nếu lỗi liên quan đến thẻ không tồn tại
                        if ("không tồn tại" in message.lower() or 
                            "chưa tồn tại" in message.lower() or 
                            "not found" in message.lower() or 
                            "not exist" in message.lower() or 
                            "does not exist" in message.lower() or 
                            "không tìm thấy" in message.lower()):
                            if self.ui:
                                self.ui.cap_nhat_trang_thai_dau_doc(f"Thẻ {ma_the} chưa được đăng ký", "#f39c12")
                            
                            # Hiển thị dialog hỏi có muốn thêm thẻ không
                            answer = messagebox.askyesno(
                                "Thẻ chưa đăng ký", 
                                f"Thẻ {ma_the} chưa được đăng ký trong hệ thống.\n\nBạn có muốn thêm thẻ này không?",
                                icon="question"
                            )
                            
                            if answer:
                                # Hiển thị dialog thêm thẻ
                                ket_qua = hien_thi_dialog_them_the(self.ui.root, ma_the)
                                
                                if ket_qua == "success":
                                    # Thẻ đã được thêm thành công, nhưng xe ra thì không thể thử lại được
                                    if self.ui:
                                        self.ui.cap_nhat_trang_thai_dau_doc(f"Thẻ {ma_the} đã được thêm thành công", "#27ae60")
                                else:
                                    # User hủy hoặc có lỗi
                                    if self.ui:
                                        self.ui.cap_nhat_trang_thai_dau_doc("Đã hủy thêm thẻ", "#95a5a6")
                            else:
                                # User không muốn thêm thẻ
                                if self.ui:
                                    self.ui.cap_nhat_trang_thai_dau_doc("Từ chối thêm thẻ", "#95a5a6")
                        else:
                            # Lỗi khác, hiển thị lỗi bình thường
                            if self.ui:
                                self.ui.hien_thi_loi("Lỗi xe ra", message)
        
        except Exception as e:
            print(f"Lỗi xử lý quét thẻ: {e}")
            if self.ui:
                self.ui.cap_nhat_trang_thai_dau_doc(f"Lỗi xử lý thẻ: {str(e)}", "#e74c3c")
        finally:
            self.reset_trang_thai_quet()