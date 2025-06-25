import requests
import json
from typing import List, Dict, Any
from backend import schemas as models
import backend.url as url
from server.config.api_config import call_api_with_auth
from backend.schemas import KhuVuc


def handle_api_response(response: requests.Response) -> Dict[str, Any]:
    """
    Handle API response and return appropriate data
    """
    try:
        response.raise_for_status()
        data = response.json()
        
        # If we got a success/message response
        if isinstance(data, dict):
            success = data.get('success')
            if success is not None:  # We have a success/message response
                if not success:
                    raise Exception(data.get('message', 'Unknown error from API'))
                return data
                
        # If we got direct data (like in GET requests)
        return data
        
    except requests.exceptions.HTTPError as e:
        # Try to get error message from response body
        try:
            error_data = response.json()
            error_message = error_data.get('message', f'HTTP Error: {response.status_code}')
        except:
            error_message = f'HTTP Error: {response.status_code}'
        raise Exception(error_message)
    except Exception as e:
        # Re-raise exception with original message
        raise e

def layALLLoaiPhuongTien() -> List[models.LoaiPhuongTien]:
    payload = {
        "table": "pm_nc0001",
        "func": "data"
    }
    # Sử dụng call_api_with_auth thay vì gọi trực tiếp
    raw_data = call_api_with_auth(payload)
    if raw_data:
        return [models.LoaiPhuongTien(**item) for item in raw_data]
    return []

def lay_danh_sach_khu():
    api = url.url_api
    payload = {
        "table": "pm_nc0004_1",
        "func": "khu_vuc_camera_cong"
    }
    res = requests.post(api, json=payload)
    return handle_api_response(res)

def themLoaiPhuongTien(loai_phuong_tien: models.LoaiPhuongTien) -> Dict[str, Any]:
    """
    Trả về dict chứa success và message thay vì chỉ bool
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0001",
        "func": "add",
        "maLoaiPT": loai_phuong_tien.maLoaiPT,
        "tenLoaiPT": loai_phuong_tien.tenLoaiPT,
        "moTa": loai_phuong_tien.moTa
    }
    res = requests.post(api, json=payload)
    return handle_api_response(res)

def capNhatLoaiPhuongTien(loai_phuong_tien: models.LoaiPhuongTien) -> Dict[str, Any]:
    api = url.url_api
    payload = {
        "table": "pm_nc0001",
        "func": "edit",
        "maLoaiPT": loai_phuong_tien.maLoaiPT,
        "tenLoaiPT": loai_phuong_tien.tenLoaiPT,
        "moTa": loai_phuong_tien.moTa
    }
    res = requests.post(api, json=payload)
    return handle_api_response(res)

def xoaLoaiPhuongTien(ma_loai_phuong_tien: str) -> Dict[str, Any]:
    api = url.url_api
    payload = {
        "table": "pm_nc0001",
        "func": "delete",
        "maLoaiPT": ma_loai_phuong_tien
    }
    res = requests.post(api, json=payload)
    return handle_api_response(res)

def layALLPhienGuiXe() -> List[models.PhienGuiXe]:
    api = url.url_api
    payload = {
        "table": "pm_nc0009",
        "func": "data"
    }
    res = requests.post(api, json=payload)
    raw_data = handle_api_response(res)
    # Nếu API trả về {'success': true, 'data': [...]}, thì lấy res.json()['data']
    return [models.PhienGuiXe(**item) for item in raw_data.get('data', raw_data)]

def themPhienGuiXe(session: models.PhienGuiXe) -> Dict[str, Any]:
    """
    Trả về dict chứa success và message từ API
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0009",
        "func": "add",
        "uidThe": session.uidThe,
        "bienSo": session.bienSo,
        "viTriGui": getattr(session, "viTriGui", None),
        "chinhSach": session.chinhSach,
        "congVao": session.congVao,
        "gioVao": session.gioVao,
        "anhVao": session.anhVao,
        "anhMatVao": session.anhMatVao,
        "camera_id": getattr(session, "camera_id", None), 
    }
    payload = {k: v for k, v in payload.items() if v is not None}
    
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print("Lỗi gọi API:", str(e))
        print("Status code:", res.status_code if 'res' in locals() else 'N/A')
        print("Response text:", res.text if 'res' in locals() else 'N/A')
        # Trả về dict với thông tin lỗi
        return {
            "success": False,
            "message": str(e)
        }

def capNhatPhienGuiXe(session: models.PhienGuiXe) -> Dict[str, Any]:
    api = url.url_api
    payload = {
        "table": "pm_nc0009",
        "func": "edit",
        "maPhien": session.maPhien,
        "congRa": session.congRa,
        "gioRa": session.gioRa,
        "anhRa": session.anhRa,
        "anhMatRa": session.anhMatRa,
        "camera_id": getattr(session, "camera_id", None),
        "plate_match": getattr(session, "plate_match", None),
        "plate": getattr(session, "plate", None),
    }
    payload = {k: v for k, v in payload.items() if v is not None}
    print("Payload gửi lên:", payload)
    
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print("Lỗi gọi API:", str(e))
        return {
            "success": False,
            "message": str(e)
        }

def loadPhienGuiXeTheoMaThe(ma_the: str) -> List[models.PhienGuiXe]:
    api = url.url_api
    payload = {
        "table": "pm_nc0009",
        "func": "layPhienGuiXeTuUID",
        "uidThe": ma_the
    }
    try:
        res = requests.post(api, json=payload)
        raw_data = handle_api_response(res)
        return [models.PhienGuiXe(**item) for item in raw_data] if raw_data else []
    except Exception as e:
        print(f"Lỗi load phiên gửi xe theo mã thẻ {ma_the}: {str(e)}")
        return []

def loadPhienGuiXeTheoMaThe_XeRa(ma_the: str) -> List[models.PhienGuiXe]:
    api = url.url_api
    payload = {
        "table": "pm_nc0009",
        "func": "layPhienGuiXeTuUID_Da_Ra",
        "uidThe": ma_the
    }
    try:
        res = requests.post(api, json=payload)
        raw_data = handle_api_response(res)
        # Nếu API trả về dict có key 'data' thì lấy data, còn không thì lấy raw_data
        if isinstance(raw_data, dict) and "data" in raw_data:
            data = raw_data["data"]
        else:
            data = raw_data
        return [models.PhienGuiXe(**item) for item in data] if data else []
    except Exception as e:
        print(f"Lỗi load phiên gửi xe (xe ra) theo mã thẻ {ma_the}: {str(e)}")
        return []

def themThe(uid_the: str, loai_the: str, trang_thai: str = "1") -> Dict[str, Any]:
    """
    Thêm thẻ mới vào hệ thống
    
    Args:
        uid_the (str): UID của thẻ RFID
        loai_the (str): Loại thẻ (VD: "Thẻ thường", "Thẻ VIP", etc.)
        trang_thai (str): Trạng thái thẻ (mặc định là "1" - hoạt động)
    
    Returns:
        Dict[str, Any]: Response từ API chứa success và message
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0003",
        "func": "add",
        "uidThe": uid_the,
        "loaiThe": loai_the,
        "trangThai": trang_thai
    }
    
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print(f"Lỗi gọi API thêm thẻ {uid_the}: {str(e)}")
        return {
            "success": False,
            "message": str(e)
        }

def taoBangChoPhienLamViec() -> Dict[str, Any]:
    """
    Gọi API để tạo bảng cho phiên làm việc mới
    
    Returns:
        Dict[str, Any]: Response từ API chứa success và message
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0009",
        "func": "taoBangChoPhienLamViec"
    }
    
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print(f"Lỗi gọi API tạo bảng cho phiên làm việc: {str(e)}")
        return {
            "success": False,
            "message": str(e)
        }

def tinhPhiGuiXe(ma_phien: str) -> Dict[str, Any]:
    """
    Tính phí gửi xe dựa trên thời gian gửi và chính sách giá
    
    Args:
        ma_phien (str): Mã phiên gửi xe
        
    Returns:
        Dict[str, Any]: Response chứa thông tin phí và thời gian gửi
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0008",
        "func": "tinhPhiGuiXe",
        "maPhien": ma_phien
    }
    
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print(f"Lỗi tính phí gửi xe cho phiên {ma_phien}: {str(e)}")
        return {
            "success": False,
            "message": str(e)
        }

def layALLChinhSachGia() -> List[Dict[str, Any]]:
    """
    Lấy danh sách tất cả chính sách giá
    
    Returns:
        List[Dict[str, Any]]: Danh sách chính sách giá
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0008",
        "func": "getAllPolicies"
    }
    try:
        res = requests.post(api, json=payload)
        raw_data = handle_api_response(res)
        return raw_data.get('data', []) if isinstance(raw_data, dict) else raw_data
    except Exception as e:
        print(f"Lỗi lấy danh sách chính sách giá: {str(e)}")
        return []

def themChinhSachGia(chinh_sach: Dict[str, Any]) -> Dict[str, Any]:
    """
    Thêm chính sách giá mới
    
    Args:
        chinh_sach (Dict[str, Any]): Thông tin chính sách giá cần thêm
        
    Returns:
        Dict[str, Any]: Response từ API chứa success và message
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0008",
        "func": "createPolicy",
        "policyData": chinh_sach
    }
    
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print(f"Lỗi thêm chính sách giá: {str(e)}")
        return {
            "success": False,
            "message": str(e)
        }

def capNhatChinhSachGia(ma_chinh_sach: str, chinh_sach: Dict[str, Any]) -> Dict[str, Any]:
    """
    Cập nhật chính sách giá
    
    Args:
        ma_chinh_sach (str): Mã chính sách cần cập nhật
        chinh_sach (Dict[str, Any]): Thông tin chính sách giá mới
        
    Returns:
        Dict[str, Any]: Response từ API chứa success và message
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0008",
        "func": "updatePolicy",
        "policyId": ma_chinh_sach,
        "policyData": chinh_sach
    }
    
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print(f"Lỗi cập nhật chính sách giá {ma_chinh_sach}: {str(e)}")
        return {
            "success": False,
            "message": str(e)
        }

def xoaChinhSachGia(ma_chinh_sach: str) -> Dict[str, Any]:
    """
    Xóa chính sách giá
    
    Args:
        ma_chinh_sach (str): Mã chính sách cần xóa
        
    Returns:
        Dict[str, Any]: Response từ API chứa success và message
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0008",
        "func": "deletePolicy",
        "policyId": ma_chinh_sach
    }
    
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print(f"Lỗi xóa chính sách giá {ma_chinh_sach}: {str(e)}")
        return {
            "success": False,
            "message": str(e)
        }

def layChinhSachGiaTheoLoaiPT(ma_loai_pt: str) -> List[Dict[str, Any]]:
    """
    Lấy chính sách giá theo loại phương tiện
    
    Args:
        ma_loai_pt (str): Mã loại phương tiện
        
    Returns:
        List[Dict[str, Any]]: Danh sách chính sách giá
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0008",
        "func": "layChinhSachTuPT",
        "maLoaiPT": ma_loai_pt
    }
    
    try:
        res = requests.post(api, json=payload)
        raw_data = handle_api_response(res)
        return raw_data if isinstance(raw_data, list) else []
    except Exception as e:
        print(f"Lỗi lấy chính sách giá theo loại PT {ma_loai_pt}: {str(e)}")
        return []

def layDanhSachKhuVuc():
    """
    Lấy danh sách khu vực đỗ xe
    Returns: List[KhuVuc]
    """
    try:
        api = url.url_api
        payload = {
            "table": "pm_nc0004_2",
            "func": "data"
        }
        res = requests.post(api, json=payload)
        
        result = handle_api_response(res)
        khu_vuc_list = []
        
        for item in result:
            # Skip empty entries
            if not item.get("maKhuVuc"):
                continue
                
            kv = KhuVuc(
                maKhuVuc=item.get("maKhuVuc", ""),
                tenKhuVuc=item.get("tenKhuVuc", ""),
                moTa=item.get("moTa", "")
            )
            khu_vuc_list.append(kv)
            
        return khu_vuc_list
    except Exception as e:
        print(f"Error in layDanhSachKhuVuc: {str(e)}")
        return []

def themKhuVuc(khu_vuc: KhuVuc) -> Dict[str, Any]:
    """
    Thêm khu vực đỗ xe mới theo format API chuẩn
    Args:
        khu_vuc (KhuVuc): Đối tượng khu vực cần thêm
    Returns:
        Dict[str, Any]: Response từ API chứa success và message
    """
    try:
        api = url.url_api
        payload = {
            "table": "pm_nc0004_2",
            "func": "add",
            "maKhuVuc": khu_vuc.maKhuVuc,
            "tenKhuVuc": khu_vuc.tenKhuVuc,
            "moTa": khu_vuc.moTa if khu_vuc.moTa else ""  # Đảm bảo moTa là chuỗi rỗng nếu None
        }
        
        print("Sending payload to API:", payload)  # Debug log
        res = requests.post(api, json=payload)
        print("API Response status code:", res.status_code)  # Debug log
        print("API Raw response text:", res.text)  # Debug log
        
        try:
            result = handle_api_response(res) 
            print("Handled API response:", result)  # Debug log
            return result
        except json.JSONDecodeError as je:
            print(f"JSON Decode error: {str(je)}")
            # Nếu thêm thành công nhưng response không phải JSON
            if res.status_code == 200:
                return {
                    "success": True,
                    "message": "Thêm khu vực thành công"
                }
            else:
                return {
                    "success": False,
                    "message": f"Lỗi khi xử lý response: {str(je)}"
                }
            
    except Exception as e:
        print(f"Error in themKhuVuc: {str(e)}")
        return {
            "success": False,
            "message": str(e)
        }

def capNhatKhuVuc(khu_vuc: KhuVuc) -> Dict[str, Any]:
    """
    Cập nhật thông tin khu vực đỗ xe
    Args:
        khu_vuc (KhuVuc): Đối tượng khu vực cần cập nhật
    Returns:
        Dict[str, Any]: Response từ API chứa success và message
    """
    try:
        api = url.url_api
        payload = {
            "table": "pm_nc0004_2",
            "func": "edit",
            "maKhuVuc": khu_vuc.maKhuVuc,
            "tenKhuVuc": khu_vuc.tenKhuVuc,
            "moTa": khu_vuc.moTa
        }
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        return {
            "success": False,
            "message": str(e)
        }

def xoaKhuVuc(ma_khu_vuc: str) -> Dict[str, Any]:
    """
    Xóa khu vực đỗ xe
    Args:
        ma_khu_vuc (str): Mã khu vực cần xóa
    Returns:
        Dict[str, Any]: Response từ API chứa success và message
    """
    try:
        api = url.url_api
        payload = {
            "table": "pm_nc0004_2",  # Sửa lại table đúng với API post
            "func": "delete",
            "maKhuVuc": ma_khu_vuc
        }
        
        print("Sending delete payload:", payload)  # Debug log
        res = requests.post(api, json=payload)
        print("Delete Response status:", res.status_code)  # Debug log
        print("Delete Raw response:", res.text)  # Debug log
        
        try:
            result = handle_api_response(res)
            print("Handled delete response:", result)  # Debug log
            return result
        except json.JSONDecodeError as je:
            print(f"JSON Decode error in delete: {str(je)}")
            # Nếu xóa thành công nhưng response không phải JSON
            if res.status_code == 200:
                return {
                    "success": True,
                    "message": "Xóa khu vực thành công"
                }
            else:
                return {
                    "success": False,
                    "message": f"Lỗi khi xử lý response: {str(je)}"
                }
                
    except Exception as e:
        print(f"Error in xoaKhuVuc: {str(e)}")
        return {
            "success": False,
            "message": str(e)
        }

def lay_khu_vuc_camera_cong() -> list:
    """
    Lấy danh sách khu vực, cổng và camera từ bảng pm_nc0004_1 (API backend mới)
    Returns:
        list: Danh sách dict khu vực, mỗi khu có các trường: maKhuVuc, tenKhuVuc, moTa, congVao, congRa, cameraVao, cameraRa
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0004_1",
        "func": "khu_vuc_camera_cong"
    }
    try:
        res = requests.post(api, json=payload)
        data = handle_api_response(res)
        # Nếu API trả về {'success': True, 'data': [...]}, lấy data
        if isinstance(data, dict) and 'data' in data:
            return data['data']
        return data
    except Exception as e:
        print(f"Lỗi lấy khu vực camera/cổng: {str(e)}")
        return []

def layDanhSachCamera() -> list:
    """
    Lấy danh sách camera từ bảng pm_nc0006_1 (API backend)
    Returns:
        list: Danh sách dict camera
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0006_1",
        "func": "data"
    }
    try:
        res = requests.post(api, json=payload)
        data = handle_api_response(res)
        # Nếu API trả về {'success': True, 'data': [...]}, lấy data
        if isinstance(data, dict) and 'data' in data:
            return data['data']
        return data
    except Exception as e:
        print(f"Lỗi lấy danh sách camera: {str(e)}")
        return []
    
def themCamera(camera: dict) -> dict:
    """
    Thêm camera mới
    Args:
        camera (dict): Thông tin camera (maCamera, tenCamera, loaiCamera, chucNangCamera, maKhuVuc, linkRTSP)
    Returns:
        dict: Response từ API chứa success và message
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0006_1",
        "func": "add",
        "maCamera": camera.get("maCamera"),
        "tenCamera": camera.get("tenCamera"),
        "loaiCamera": camera.get("loaiCamera"),
        "chucNangCamera": camera.get("chucNangCamera"),
        "maKhuVuc": camera.get("maKhuVuc"),
        "linkRTSP": camera.get("linkRTSP"),
    }
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print(f"Lỗi thêm camera: {str(e)}")
        return {"success": False, "message": str(e)}

def capNhatCamera(camera: dict) -> dict:
    """
    Cập nhật thông tin camera
    Args:
        camera (dict): Thông tin camera (maCamera, tenCamera, loaiCamera, chucNangCamera, maKhuVuc, linkRTSP)
    Returns:
        dict: Response từ API chứa success và message
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0006_1",
        "func": "edit",
        "maCamera": camera.get("maCamera"),
        "tenCamera": camera.get("tenCamera"),
        "loaiCamera": camera.get("loaiCamera"),
        "chucNangCamera": camera.get("chucNangCamera"),
        "maKhuVuc": camera.get("maKhuVuc"),
        "linkRTSP": camera.get("linkRTSP"),
    }
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print(f"Lỗi cập nhật camera: {str(e)}")
        return {"success": False, "message": str(e)}

def xoaCamera(ma_camera: str) -> dict:
    """
    Xóa camera theo mã
    Args:
        ma_camera (str): Mã camera cần xóa
    Returns:
        dict: Response từ API chứa success và message
    """
    api = url.url_api
    payload = {
        "table": "pm_nc0006_1",
        "func": "delete",
        "maCamera": ma_camera
    }
    try:
        res = requests.post(api, json=payload)
        return handle_api_response(res)
    except Exception as e:
        print(f"Lỗi xóa camera: {str(e)}")
        return {"success": False, "message": str(e)}
