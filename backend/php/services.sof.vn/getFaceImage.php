<?php
// getFaceImage.php - API để lấy ảnh khuôn mặt từ thư mục NhanDien_khuonmat

// === 1. Nhận request POST ===
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Chỉ hỗ trợ POST"]);
    exit;
}

// === 2. Lấy dữ liệu từ body POST ===
$filename = $_POST['file'] ?? null;

// === 3. Kiểm tra dữ liệu đầu vào ===
if (!$filename) {
    http_response_code(400);
    echo json_encode(["error" => "Thiếu tham số filename."]);
    exit;
}

// === 4. Sanitize filename để tránh path traversal ===
$filename = basename($filename);

// === 5. Tạo đường dẫn tuyệt đối đến thư mục khuôn mặt ===
$faceImageDir = "C:/ParkingLot_Images/NhanDien_khuonmat/";
$path = $faceImageDir . $filename;

// === 6. Kiểm tra tồn tại ===
if (!file_exists($path)) {
    http_response_code(404);
    echo json_encode([
        "success" => false,
        "error" => "Không tìm thấy ảnh khuôn mặt: " . $filename,
        "path" => $path
    ]);
    exit;
}

// === 7. Kiểm tra có phải file ảnh không ===
$allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
$mimeType = mime_content_type($path);

if (!in_array($mimeType, $allowedTypes)) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "error" => "File không phải là ảnh hợp lệ: " . $mimeType
    ]);
    exit;
}

// === 8. Đọc và mã hoá base64 ===
try {
    $imageData = file_get_contents($path);
    if ($imageData === false) {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "error" => "Không thể đọc file ảnh"
        ]);
        exit;
    }

    $base64 = base64_encode($imageData);

    // === 9. Trả kết quả JSON ===
    header("Content-Type: application/json");
    echo json_encode([
        "success" => true,
        "filename" => $filename,
        "base64" => $base64,
        "mimeType" => $mimeType,
        "size" => strlen($imageData)
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => "Lỗi server: " . $e->getMessage()
    ]);
}

exit;
?>
