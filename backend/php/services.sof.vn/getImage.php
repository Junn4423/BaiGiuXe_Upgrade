<?php
// === 1. Nhận request POST ===
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Chỉ hỗ trợ POST"]);
    exit;
}

// === 2. Lấy dữ liệu từ body POST ===
$year = $_POST['year'] ?? null;
$month = $_POST['month'] ?? null;
$day = $_POST['day'] ?? null;
$filename = $_POST['file'] ?? null;

// === 3. Kiểm tra dữ liệu đầu vào ===
if (!$year || !$month || !$day || !$filename) {
    http_response_code(400);
    echo json_encode(["error" => "Thiếu tham số."]);
    exit;
}

// === 4. Tạo đường dẫn tuyệt đối với tìm kiếm thông minh ===
$rootDir = "C:/ParkingLot_Images/";

// Đảm bảo an toàn đường dẫn (chống directory traversal)
$filename = str_replace(['..', '\\'], ['', '/'], $filename);

// Try to find the file in the date-based structure
$fullPath = null;

// First try the exact date-based path
$dateBasedPath = $rootDir . "Nam_$year/Thang_$month/Ngay_$day/" . basename($filename);
if (file_exists($dateBasedPath)) {
    $fullPath = $dateBasedPath;
} else {
    // If not found, try direct path (in case file includes subdirectory structure)
    if (file_exists($rootDir . $filename)) {
        $fullPath = $rootDir . $filename;
    } else {
        // Search in recent dates (last 7 days) for the file
        for ($i = 0; $i < 7; $i++) {
            $searchDate = date("Y-m-d", strtotime("-$i days"));
            $searchYear = date("Y", strtotime($searchDate));
            $searchMonth = date("m", strtotime($searchDate));
            $searchDay = date("d", strtotime($searchDate));
            
            $searchPath = $rootDir . "Nam_$searchYear/Thang_$searchMonth/Ngay_$searchDay/" . basename($filename);
            if (file_exists($searchPath)) {
                $fullPath = $searchPath;
                break;
            }
        }
    }
}

// === 5. Kiểm tra tồn tại ===
if (!$fullPath || !file_exists($fullPath) || !is_file($fullPath)) {
    http_response_code(404);
    echo json_encode(["error" => "Không tìm thấy ảnh: " . basename($filename)]);
    exit;
}

// === 6. Đọc và mã hoá base64 ===
$imageData = file_get_contents($fullPath);
$mimeType = mime_content_type($fullPath);
$base64 = 'data:' . $mimeType . ';base64,' . base64_encode($imageData);

// === 7. Trả kết quả JSON ===
header("Content-Type: application/json");
echo json_encode([
    "filename" => $filename,
    "base64" => $base64
]);
exit;
?>
