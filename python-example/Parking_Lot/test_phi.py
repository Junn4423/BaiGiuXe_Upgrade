import requests
from datetime import datetime, timedelta
import models
import server.url as url
from server import api # Import api module
from typing import List

def test_tinh_phi():
    print("--- Bắt đầu kiểm tra tính phí gửi xe ---")

    test_uid_the = "TESTCARD1234"
    test_bien_so = "86TEST4H"
    test_chinh_sach = "CS_XEMAY_4H"

    # Bước 0: Đăng ký thẻ RFID nếu chưa tồn tại
    print(f"\n--- Bước 0: Đăng ký thẻ RFID {test_uid_the} ---")
    try:
        them_the_result = api.themThe(uid_the=test_uid_the, loai_the="Thẻ test", trang_thai="1")
        if them_the_result.get("success"):
            print(f"Thẻ {test_uid_the} đã được đăng ký hoặc đã tồn tại: {them_the_result.get("message")}")
        else:
            if "đã tồn tại" not in them_the_result.get("message", ""):
                print(f"Lỗi khi đăng ký thẻ {test_uid_the}: {them_the_result.get("message")}")
                return
            else:
                print(f"Thẻ {test_uid_the} đã tồn tại (bỏ qua đăng ký): {them_the_result.get("message")}")
    except Exception as e:
        print(f"Lỗi gọi API thêm thẻ: {e}")
        return

    # Bước 0.5: Kiểm tra và kết thúc phiên đang gửi cũ nếu có
    print(f"\n--- Bước 0.5: Kiểm tra và kết thúc phiên đang gửi cũ cho thẻ {test_uid_the} (nếu có) ---")
    try:
        existing_sessions = api.loadPhienGuiXeTheoMaThe(test_uid_the)
        if existing_sessions:
            print(f"Tìm thấy {len(existing_sessions)} phiên đang gửi cho thẻ {test_uid_the}. Đang tiến hành kết thúc...")
            for session_to_end in existing_sessions:
                # Cập nhật thông tin xe ra cho phiên cũ
                session_to_end.congRa = "GATE_OUT_AUTO"
                session_to_end.gioRa = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
                session_to_end.anhRa = "auto_exit_image.jpg"
                session_to_end.anhMatRa = ""
                session_to_end.plate_match = 1
                session_to_end.plate = session_to_end.bienSo # Giữ nguyên biển số cũ
                # session_to_end.trangThai = "DA_RA" # Backend sẽ tự cập nhật trạng thái khi xe ra

                print(f"  - Đang cập nhật phiên cũ {session_to_end.maPhien} thành DA_RA...")
                update_old_session_result = api.capNhatPhienGuiXe(session_to_end)
                print(f"    Kết quả cập nhật phiên cũ: {update_old_session_result}")
                
                if update_old_session_result.get("success"):
                    print(f"  - Đang tính phí cho phiên cũ {session_to_end.maPhien}...")
                    phi_old_session_result = api.tinhPhiGuiXe(session_to_end.maPhien)
                    print(f"    Kết quả tính phí phiên cũ: {phi_old_session_result}")
                else:
                    print("    ⚠️ Cập nhật phiên cũ thất bại. Có thể vẫn còn phiên đang gửi.")
        else:
            print(f"Không tìm thấy phiên nào đang gửi cho thẻ {test_uid_the}.")
    except Exception as e:
        print(f"Lỗi trong quá trình kết thúc phiên cũ: {e}")
        # Không return, cố gắng tiếp tục test chính

    # 1. Tạo một phiên gửi xe (xe vào)
    # Giả lập thời gian vào là 4 tiếng 1 phút trước thời điểm hiện tại
    gioVao = (datetime.now() - timedelta(hours=7, minutes=-1)).strftime("%Y-%m-%d %H:%M:%S") # Để test thời gian dài hơn

    session_vao = models.PhienGuiXe(
        uidThe=test_uid_the,
        bienSo=test_bien_so,
        chinhSach=test_chinh_sach,
        congVao="GATE_IN1",
        gioVao=gioVao,
        anhVao="test_image_vao.jpg",
        anhMatVao=""
    )

    print(f"\n--- Bước 1: Thêm phiên gửi xe (xe vào) với giờ vào: {gioVao} ---")
    try:
        them_phien_result = api.themPhienGuiXe(session_vao)
        print(f"Kết quả thêm phiên: {them_phien_result}")
        if not them_phien_result.get("success"):
            print("Lỗi: Không thể thêm phiên gửi xe. Vui lòng kiểm tra lại thông tin thẻ/biển số/chính sách và log backend.")
            return

        ma_phien_moi = str(them_phien_result.get("maPhien")) # Đảm bảo là string
        if not ma_phien_moi:
            print("Lỗi: Không lấy được mã phiên sau khi thêm.")
            return
        print(f"Mã phiên mới được tạo: {ma_phien_moi}")

        # 1.5. Load lại phiên gửi xe vừa tạo để có đầy đủ thông tin trước khi cập nhật
        print(f"\n--- Bước 1.5: Load lại phiên gửi xe đang gửi cho mã thẻ: {test_uid_the} ---")
        loaded_sessions_after_entry = api.loadPhienGuiXeTheoMaThe(test_uid_the)
        if not loaded_sessions_after_entry:
            print(f"Lỗi: Không tìm thấy phiên gửi xe đang gửi cho mã thẻ {test_uid_the} sau khi thêm.")
            return
        # Lấy phiên đang gửi mới nhất (là phiên vừa được thêm vào)
        current_session = loaded_sessions_after_entry[0]
        print(f"Phiên đang gửi được tải: {current_session}")

    except Exception as e:
        print(f"Lỗi khi thêm phiên gửi xe: {e}")
        return

    # 2. Cập nhật phiên gửi xe (xe ra)
    # Giả lập thời gian ra là ngay bây giờ
    gioRa = datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    # Cập nhật thông tin xe ra vào phiên đã tải (current_session)
    current_session.congRa = "GATE_OUT1"
    current_session.gioRa = gioRa
    current_session.anhRa = "test_image_ra.jpg"
    current_session.anhMatRa = ""
    current_session.plate_match = 1
    current_session.plate = test_bien_so # Biển số xe ra khớp với biển số vào

    print(f"\n--- Bước 2: Cập nhật phiên gửi xe (xe ra) với giờ ra: {gioRa} ---")
    try:
        # Truyền đối tượng current_session đã được cập nhật đầy đủ
        cap_nhat_phien_result = api.capNhatPhienGuiXe(current_session)
        print(f"Kết quả cập nhật phiên: {cap_nhat_phien_result}")
        if not cap_nhat_phien_result.get("success"):
            print("Lỗi: Không thể cập nhật phiên gửi xe. Vui lòng kiểm tra lại log backend.")
            return
    except Exception as e:
        print(f"Lỗi khi cập nhật phiên gửi xe: {e}")
        return

    # 3. Gọi API tính phí
    print(f"\n--- Bước 3: Gọi API tính phí cho mã phiên: {ma_phien_moi} ---")
    try:
        phi_result = api.tinhPhiGuiXe(ma_phien_moi)
        print(f"Kết quả tính phí: {phi_result}")

        if phi_result.get("success"):
            phi_tinh_duoc = float(phi_result.get("phi", 0)) # Chuyển sang float để so sánh
            tong_phut = int(phi_result.get("tongPhut", 0)) # Chuyển sang int
            print(f"\n✅ Phí tính được: {phi_tinh_duoc} VND")
            print(f"✅ Tổng thời gian gửi: {tong_phut} phút")
            
            # Cần điều chỉnh logic kiểm tra theo chính sách mới của bạn
            # Chính sách: 5000đ/4 tiếng, sau đó cứ thêm 4 tiếng là thêm 5000
            # Ví dụ: 3 tiếng vẫn 5000, 4-7 tiếng là 10000, 8-11 tiếng là 15000
            expected_fee = 5000.00
            base_time_minutes = 4 * 60 # 4 tiếng = 240 phút
            fee_per_block = 5000.00

            if tong_phut > base_time_minutes:
                # Tính số block vượt quá, làm tròn lên
                over_time_minutes = tong_phut - base_time_minutes
                num_additional_blocks = math.ceil(over_time_minutes / base_time_minutes)
                expected_fee += num_additional_blocks * fee_per_block

            # So sánh với một sai số nhỏ do tính toán số thực
            if abs(phi_tinh_duoc - expected_fee) < 0.01:
                print(f"👍 Phí {expected_fee} VND là chính xác cho {tong_phut} phút.")
            else:
                print(f"⚠️ Phí không khớp mong đợi. Expected: {expected_fee}, Got: {phi_tinh_duoc}")

        else:
            print(f"❌ Lỗi khi tính phí: {phi_result.get('message', 'Lỗi không xác định')}")
    except Exception as e:
        print(f"Lỗi khi gọi API tính phí: {e}")
        import traceback
        traceback.print_exc()

    print("\n--- Kết thúc kiểm tra tính phí gửi xe ---")

if __name__ == "__main__":
    import math # Cần import math cho ceil
    test_tinh_phi()
