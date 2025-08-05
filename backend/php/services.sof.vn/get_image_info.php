// for desktop
<?php
header('Content-Type: application/json');

$rootDir = "C:/ParkingLot_Images/";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $filename = isset($_GET['filename']) ? $_GET['filename'] : null;
    
    if (!$filename) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "message" => "Thiếu tham số filename"
        ]);
        exit;
    }

    // Nếu filename đã có đường dẫn tương đối (Nam_YYYY/Thang_MM/Ngay_DD/file.jpg)
    if (strpos($filename, 'Nam_') === 0) {
        $fullPath = $rootDir . $filename;
    } else {
        // Tìm file trong các thư mục theo ngày
        $fullPath = findImageFile($rootDir, $filename);
    }

    if ($fullPath && file_exists($fullPath)) {
        // Trả về thông tin file
        echo json_encode([
            "success" => true,
            "filename" => basename($fullPath),
            "relativePath" => str_replace($rootDir, '', $fullPath),
            "fullPath" => $fullPath,
            "url" => "get_image.php?file=" . urlencode(str_replace($rootDir, '', $fullPath)),
            "size" => filesize($fullPath),
            "lastModified" => filemtime($fullPath)
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            "success" => false,
            "message" => "File không tồn tại: " . $filename
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "message" => "Chỉ hỗ trợ phương thức GET."
    ]);
}

/**
 * Tìm file ảnh trong cấu trúc thư mục theo ngày
 */
function findImageFile($rootDir, $filename) {
    // Thử tìm trong thư mục hôm nay trước
    $today = date("Y/m/d");
    $todayPath = $rootDir . "Nam_" . date("Y") . "/Thang_" . date("m") . "/Ngay_" . date("d") . "/" . $filename;
    
    if (file_exists($todayPath)) {
        return $todayPath;
    }

    // Tìm trong các thư mục gần đây (7 ngày qua)
    for ($i = 0; $i < 7; $i++) {
        $date = date("Y/m/d", strtotime("-$i days"));
        $dateParts = explode('/', $date);
        $searchPath = $rootDir . "Nam_" . $dateParts[0] . "/Thang_" . $dateParts[1] . "/Ngay_" . $dateParts[2] . "/" . $filename;
        
        if (file_exists($searchPath)) {
            return $searchPath;
        }
    }

    // Tìm recursive trong toàn bộ thư mục (chậm hơn)
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootDir, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getFilename() === $filename) {
            return $file->getRealPath();
        }
    }

    return null;
}
?>
