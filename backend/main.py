import os, sys, json
sys.path.append(os.path.dirname(__file__))

try:
    from backend.url import url_login_api
except ModuleNotFoundError:
    # Fallback when script executed directly (backend not on sys.path)
    sys.path.append(os.path.dirname(os.path.dirname(__file__)))
    from backend.url import url_login_api

from fastapi import FastAPI, HTTPException
from typing import List
from fastapi.middleware.cors import CORSMiddleware
import requests


from backend.schemas import LoaiPhuongTien, KhuVuc, PhienGuiXe, PhuongTien, TheRFID, ChoDo
import backend.api as service

app = FastAPI(title="Parking Lot Backend API", version="0.1.0")

# Allow frontend dev/prod origins
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"] ,
    allow_headers=["*"] ,
)


# ---------------- Loại Phương Tiện -----------------
@app.get("/vehicle-types", response_model=List[LoaiPhuongTien])
async def get_vehicle_types():
    """Lấy danh sách tất cả loại phương tiện"""
    try:
        data = service.layALLLoaiPhuongTien()
        # Chuyển về list[dict] để FastAPI tự validate
        return [item.dict() if hasattr(item, "dict") else item for item in data]
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))


@app.post("/vehicle-types", response_model=dict, status_code=201)
async def create_vehicle_type(loai: LoaiPhuongTien):
    """Thêm mới một loại phương tiện"""
    result = service.themLoaiPhuongTien(loai)
    if not result.get("success", True):
        raise HTTPException(status_code=400, detail=result.get("message", "Unknown error"))
    return result


@app.put("/vehicle-types/{ma_loai_pt}", response_model=dict)
async def update_vehicle_type(ma_loai_pt: str, loai: LoaiPhuongTien):
    """Cập nhật thông tin một loại phương tiện"""
    if loai.maLoaiPT != ma_loai_pt:
        raise HTTPException(status_code=400, detail="maLoaiPT ở path và body không khớp")

    result = service.capNhatLoaiPhuongTien(loai)
    if not result.get("success", True):
        raise HTTPException(status_code=400, detail=result.get("message", "Unknown error"))
    return result


@app.delete("/vehicle-types/{ma_loai_pt}", response_model=dict)
async def delete_vehicle_type(ma_loai_pt: str):
    """Xóa một loại phương tiện"""
    result = service.xoaLoaiPhuongTien(ma_loai_pt)
    if not result.get("success", True):
        raise HTTPException(status_code=400, detail=result.get("message", "Unknown error"))
    return result


# ---------------- Khu Vực -----------------
@app.get("/zones", response_model=List[KhuVuc])
async def get_zones():
    """Lấy danh sách khu vực"""
    try:
        data = service.layDanhSachKhuVuc()
        return [KhuVuc(maKhuVuc=item.maKhuVuc, tenKhuVuc=item.tenKhuVuc, moTa=item.moTa) for item in data]
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))


@app.post("/zones", response_model=dict, status_code=201)
async def create_zone(zone: KhuVuc):
    """Thêm khu vực mới"""
    result = service.themKhuVuc(zone)
    if not result.get("success", True):
        raise HTTPException(status_code=400, detail=result.get("message", "Unknown error"))
    return result


@app.put("/zones/{ma_khu_vuc}", response_model=dict)
async def update_zone(ma_khu_vuc: str, zone: KhuVuc):
    """Cập nhật khu vực"""
    if zone.maKhuVuc != ma_khu_vuc:
        raise HTTPException(status_code=400, detail="maKhuVuc ở path và body không khớp")

    result = service.capNhatKhuVuc(zone)
    if not result.get("success", True):
        raise HTTPException(status_code=400, detail=result.get("message", "Unknown error"))
    return result


@app.delete("/zones/{ma_khu_vuc}", response_model=dict)
async def delete_zone(ma_khu_vuc: str):
    """Xóa khu vực"""
    result = service.xoaKhuVuc(ma_khu_vuc)
    if not result.get("success", True):
        raise HTTPException(status_code=400, detail=result.get("message", "Unknown error"))
    return result


# ---------------- Phiên Gửi Xe -----------------
@app.get("/sessions", response_model=List[PhienGuiXe])
async def get_sessions():
    """Lấy tất cả phiên gửi xe"""
    try:
        data = service.layALLPhienGuiXe()
        return [item.dict() if hasattr(item, "dict") else item for item in data]
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))


@app.post("/sessions", response_model=dict, status_code=201)
async def create_session(session: PhienGuiXe):
    result = service.themPhienGuiXe(session)
    if not result.get("success", True):
        raise HTTPException(status_code=400, detail=result.get("message", "Unknown error"))
    return result


@app.put("/sessions/{ma_phien}", response_model=dict)
async def update_session(ma_phien: str, session: PhienGuiXe):
    if session.maPhien != ma_phien:
        raise HTTPException(status_code=400, detail="maPhien ở path và body không khớp")
    result = service.capNhatPhienGuiXe(session)
    if not result.get("success", True):
        raise HTTPException(status_code=400, detail=result.get("message", "Unknown error"))
    return result


@app.get("/sessions/by-card/{uid_the}", response_model=List[PhienGuiXe])
async def get_sessions_by_card(uid_the: str):
    try:
        data = service.loadPhienGuiXeTheoMaThe(uid_the)
        return [item.dict() if hasattr(item, "dict") else item for item in data]
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))


# ---------------- Root -----------------
@app.get("/")
async def root():
    return {"message": "Parking Lot Backend is running"}


@app.post("/auth/login", response_model=dict)
async def auth_login(payload: dict):
    username = payload.get("txtUserName") or payload.get("username")
    password = payload.get("txtPassword") or payload.get("password")
    if not username or not password:
        raise HTTPException(status_code=400, detail="Thiếu tên đăng nhập / mật khẩu")
    try:
        res = requests.post(
            url_login_api,
            json={"txtUserName": username, "txtPassword": password},
            timeout=10,
        )
        return res.json()
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))


# ---------------- Work Config -----------------

from pydantic import BaseModel


class WorkConfig(BaseModel):
    zone: str
    vehicle_type: str


@app.post("/work-config", status_code=201)
async def save_work_config(config: WorkConfig):
    """Lưu cấu hình làm việc vào backend/server/config/work_config.json"""
    try:
        # Đảm bảo thư mục tồn tại
        config_dir = os.path.join(os.path.dirname(__file__), 'server', 'config')
        os.makedirs(config_dir, exist_ok=True)
        config_path = os.path.join(config_dir, 'work_config.json')

        with open(config_path, 'w', encoding='utf-8') as f:
            json.dump(config.dict(), f, ensure_ascii=False, indent=2)

        return {"success": True, "message": "Config saved", "path": config_path}
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))


if __name__ == "__main__":
    import uvicorn

    uvicorn.run("backend.main:app", host="0.0.0.0", port=8000, reload=True) 