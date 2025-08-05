<?php
header('Content-Type: application/json'); // trả về dạng JSON

$rootDir = "C:/ParkingLot_Images/";
$year = date("Y");
$month = date("m");
$day = date("d");

$subDir = "Nam_$year/Thang_$month/Ngay_$day/";
$targetDir = $rootDir . $subDir;

// Tạo thư mục nếu chưa tồn tại
if (!is_dir($targetDir)) {
    if (!mkdir($targetDir, 0755, true)) {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "filePath" => "",
            "message" => "Không thể tạo thư mục: $targetDir"
        ]);
        exit;
    }
}

// Thiết lập quyền cho thư mục trên hệ thống không phải Windows
if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
    chmod($targetDir, 0777);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['image'])) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "filePath" => "",
            "message" => "Không có file ảnh được gửi lên."
        ]);
        exit;
    }

    $file = $_FILES['image'];
    
    // Kiểm tra lỗi upload
    if ($file['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "filePath" => "",
            "message" => "Lỗi upload file: " . $file['error']
        ]);
        exit;
    }

    // Kiểm tra kích thước file (giới hạn 10MB)
    $maxFileSize = 10 * 1024 * 1024; // 10MB
    if ($file['size'] > $maxFileSize) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "filePath" => "",
            "message" => "File quá lớn. Giới hạn 10MB."
        ]);
        exit;
    }

    // Kiểm tra loại file
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mimeType, $allowedTypes)) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "filePath" => "",
            "message" => "Loại file không được hỗ trợ. Chỉ chấp nhận: JPG, PNG, GIF."
        ]);
        exit;
    }

    // Tạo tên file từ filename được gửi từ frontend hoặc sử dụng tên gốc
    $customFilename = isset($_POST['filename']) ? $_POST['filename'] : null;
    
    if ($customFilename) {
        // Sử dụng filename từ frontend (đã có timestamp)
        $filename = basename($customFilename);
        
        // Đảm bảo có extension
        $pathInfo = pathinfo($filename);
        if (!isset($pathInfo['extension'])) {
            $originalExt = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename .= '.' . ($originalExt ?: 'jpg');
        }
    } else {
        // Fallback: tạo tên file từ timestamp + tên gốc
        $timestamp = date("His");
        $originalName = basename($file["name"]);
        $filename = $timestamp . "_" . $originalName;
    }

    // Đường dẫn file đầy đủ
    $targetFile = $targetDir . $filename;

    // Di chuyển file upload đến thư mục đích
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Trả về response giống như MinIO để tương thích
        echo json_encode([
            "success" => true,
            "filename" => $filename,
            "filePath" => $subDir . $filename, // Đường dẫn tương đối
            "fullPath" => $targetFile, // Đường dẫn đầy đủ
            "message" => "Upload thành công",
            "isLocal" => true, // Flag để frontend biết đây là local storage
            "url" => $subDir . $filename // URL tương đối để truy cập
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "filePath" => "",
            "message" => "Upload thất bại. Không thể di chuyển file."
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "filePath" => "",
        "message" => "Chỉ hỗ trợ phương thức POST."
    ]);
}
?>
