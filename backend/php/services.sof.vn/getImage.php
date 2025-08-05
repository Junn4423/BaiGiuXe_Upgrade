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

// === 4. Tạo đường dẫn tuyệt đối ===
$rootDir = "C:/ParkingLot_Images/";
$path = $rootDir . "Nam_$year/Thang_$month/Ngay_$day/" . basename($filename);

// === 5. Kiểm tra tồn tại ===
if (!file_exists($path)) {
    http_response_code(404);
    echo json_encode(["error" => "Không tìm thấy ảnh."]);
    exit;
}

// === 6. Đọc và mã hoá base64 ===
$imageData = file_get_contents($path);
$mimeType = mime_content_type($path);
$base64 = 'data:' . $mimeType . ';base64,' . base64_encode($imageData);

// === 7. Trả kết quả JSON ===
header("Content-Type: application/json");
echo json_encode([
    "filename" => $filename,
    "base64" => $base64
]);
exit;
?>
