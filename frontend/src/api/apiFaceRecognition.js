// apiFaceRecognition.js - API functions cho Face Recognition Service
// Kết nối với backend Face Recognition service chạy ở port 5050

const FACE_SERVICE_URL = "http://127.0.0.1:5055";

/**
 * Kiểm tra trạng thái của Face Recognition service
 * @returns {Promise<Object>} Status object
 */
export async function checkFaceServiceHealth() {
  try {
    const response = await fetch(`${FACE_SERVICE_URL}/healthz`);
    if (!response.ok) {
      throw new Error("Face service is not responding");
    }
    return await response.json();
  } catch (error) {
    console.error("Error checking face service health:", error);
    return { status: "error", error: error.message };
  }
}

/**
 * Nhận diện khuôn mặt từ ảnh base64
 * @param {string} imageBase64 - Ảnh dạng base64 (có thể bao gồm data:image/jpeg;base64,)
 * @returns {Promise<Object>} Kết quả nhận diện
 */
export async function recognizeFaceFromBase64(imageBase64) {
  try {
    const formData = new FormData();
    formData.append("image_base64", imageBase64);

    const response = await fetch(`${FACE_SERVICE_URL}/recognize`, {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    return result;
  } catch (error) {
    console.error("Error recognizing face:", error);
    return {
      success: false,
      error: error.message,
      faces: [],
    };
  }
}

/**
 * Nhận diện khuôn mặt từ file ảnh
 * @param {File} imageFile - File ảnh
 * @returns {Promise<Object>} Kết quả nhận diện
 */
export async function recognizeFaceFromFile(imageFile) {
  try {
    const formData = new FormData();
    formData.append("file", imageFile);

    const response = await fetch(`${FACE_SERVICE_URL}/recognize`, {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    return result;
  } catch (error) {
    console.error("Error recognizing face from file:", error);
    return {
      success: false,
      error: error.message,
      faces: [],
    };
  }
}

/**
 * Đăng ký khuôn mặt mới
 * @param {Object} params - Thông tin đăng ký
 * @param {string} params.name - Tên nhân viên
 * @param {string} params.employee_id - Mã nhân viên
 * @param {string} params.department - Phòng ban (optional)
 * @param {string} params.position - Chức vụ (optional)
 * @param {string} params.image - Ảnh base64
 * @returns {Promise<Object>} Kết quả đăng ký
 */
export async function registerFace(params) {
  try {
    const response = await fetch(`${FACE_SERVICE_URL}/register`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(params),
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    return result;
  } catch (error) {
    console.error("Error registering face:", error);
    return {
      success: false,
      message: error.message,
    };
  }
}

/**
 * Nhận diện khuôn mặt từ video stream (canvas)
 * @param {HTMLCanvasElement} canvas - Canvas chứa frame từ video
 * @returns {Promise<Object>} Kết quả nhận diện
 */
export async function recognizeFaceFromCanvas(canvas) {
  try {
    // Chuyển canvas thành base64
    const imageBase64 = canvas.toDataURL("image/jpeg", 0.8);
    return await recognizeFaceFromBase64(imageBase64);
  } catch (error) {
    console.error("Error recognizing face from canvas:", error);
    return {
      success: false,
      error: error.message,
      faces: [],
    };
  }
}

/**
 * Xác thực khuôn mặt với ảnh tham chiếu (đường dẫn tuyệt đối hoặc relative trong C:\\ParkingLot_Images\\NhanDien_khuonmat)
 * @param {Blob|File|string} captured - Ảnh khuôn mặt chụp (Blob/File hoặc base64 string)
 * @param {string} referencePath - Đường dẫn ảnh tham chiếu (pm_nc0002.lv004)
 * @param {number} tolerance - Ngưỡng so khớp (0.35-0.6), mặc định 0.45
 * @returns {Promise<{success:boolean, match:boolean, confidence:number, error?:string}>}
 */
export async function verifyFace(captured, referencePath, tolerance = 0.45) {
  try {
    const formData = new FormData();

    if (captured instanceof Blob || captured instanceof File) {
      const file =
        captured instanceof File
          ? captured
          : new File([captured], "captured.jpg", {
              type: captured.type || "image/jpeg",
            });
      formData.append("file", file);
    } else if (typeof captured === "string") {
      formData.append("image_base64", captured);
    } else {
      throw new Error("Invalid captured image");
    }

    if (referencePath && typeof referencePath === "string") {
      formData.append("reference_path", referencePath);
    }

    formData.append("tolerance", String(tolerance));

    const response = await fetch(`${FACE_SERVICE_URL}/verify`, {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    return await response.json();
  } catch (error) {
    console.error("Error verifying face:", error);
    return {
      success: false,
      match: false,
      confidence: null,
      error: error.message,
    };
  }
}

/**
 * Lấy thông tin nhân viên đã nhận diện
 * @param {string} employeeId - Mã nhân viên
 * @returns {Promise<Object>} Thông tin nhân viên
 */
export async function getEmployeeInfo(employeeId) {
  try {
    // Tạm thời trả về thông tin mock
    // Sau này có thể kết nối với database thực
    return {
      success: true,
      employee: {
        employee_id: employeeId,
        name: "Unknown",
        department: "Unknown",
        position: "Unknown",
      },
    };
  } catch (error) {
    console.error("Error getting employee info:", error);
    return {
      success: false,
      error: error.message,
    };
  }
}

/**
 * Xóa user khỏi hệ thống face recognition
 * @param {string} employeeId - Mã nhân viên
 * @returns {Promise<Object>} Kết quả xóa
 */
export async function deleteUser(employeeId) {
  try {
    const response = await fetch(`${FACE_SERVICE_URL}/delete_user`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        employee_id: employeeId,
      }),
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    return result;
  } catch (error) {
    console.error("Error deleting user:", error);
    return {
      success: false,
      message: error.message,
    };
  }
}

/**
 * Lấy danh sách tất cả users trong hệ thống face recognition
 * @returns {Promise<Object>} Danh sách users
 */
export async function listUsers() {
  try {
    const response = await fetch(`${FACE_SERVICE_URL}/users`);

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    return result;
  } catch (error) {
    console.error("Error listing users:", error);
    return {
      success: false,
      error: error.message,
      users: [],
      total: 0,
    };
  }
}

/**
 * Utility function để resize ảnh trước khi gửi
 * @param {string} base64Str - Ảnh base64
 * @param {number} maxWidth - Chiều rộng tối đa
 * @param {number} maxHeight - Chiều cao tối đa
 * @returns {Promise<string>} Ảnh đã resize
 */
export async function resizeImage(base64Str, maxWidth = 800, maxHeight = 600) {
  return new Promise((resolve) => {
    const img = new Image();
    img.src = base64Str;
    img.onload = () => {
      const canvas = document.createElement("canvas");
      let width = img.width;
      let height = img.height;

      if (width > height) {
        if (width > maxWidth) {
          height *= maxWidth / width;
          width = maxWidth;
        }
      } else {
        if (height > maxHeight) {
          width *= maxHeight / height;
          height = maxHeight;
        }
      }

      canvas.width = width;
      canvas.height = height;

      const ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0, width, height);

      resolve(canvas.toDataURL("image/jpeg", 0.8));
    };
  });
}

// Export default object với tất cả functions
export default {
  checkFaceServiceHealth,
  recognizeFaceFromBase64,
  recognizeFaceFromFile,
  registerFace,
  recognizeFaceFromCanvas,
  verifyFace,
  getEmployeeInfo,
  deleteUser,
  listUsers,
  resizeImage,
};
