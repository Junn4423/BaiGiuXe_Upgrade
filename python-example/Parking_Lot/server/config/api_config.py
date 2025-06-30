import requests
import json
from server.url import url_login_api, url_api

def get_auth_token(username: str = "admin", password: str = "1") -> dict:
    """
    Lấy token authentication từ API login
    Returns: 
        dict with format {"code": "admin", "token": "HZQ7II7tk5p61FJI"}
    """
    try:
        payload = {
            "txtUserName": username,
            "txtPassword": password
        }
        response = requests.post(url_login_api, json=payload)
        response.raise_for_status()
        return response.json()
    except Exception as e:
        print(f"Error getting auth token: {str(e)}")
        return None

def get_headers() -> dict:
    """
    Tạo headers với token authentication
    Returns:
        dict: Headers với X-USER-CODE và X-USER-TOKEN
    """
    try:
        auth_data = get_auth_token()
        if auth_data:
            return {
                "X-USER-CODE": auth_data["code"],
                "X-USER-TOKEN": auth_data["token"]
            }
        return None
    except Exception as e:
        print(f"Error creating headers: {str(e)}")
        return None

def call_api_with_auth(payload: dict) -> dict:
    """
    Gọi API với authentication headers
    Args:
        payload (dict): Data gửi lên API
    Returns:
        dict: Response từ API
    """
    try:
        headers = get_headers()
        if not headers:
            raise Exception("Could not get authentication headers")
            
        response = requests.post(url_api, json=payload, headers=headers)
        response.raise_for_status()
        return response.json()
    except Exception as e:
        print(f"Error calling API: {str(e)}")
        return None
