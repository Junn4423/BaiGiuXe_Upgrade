// for desktop
<?php
$rootDir = "C:/ParkingLot_Images/";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $file = isset($_GET['file']) ? $_GET['file'] : null;
    
    if (!$file) {
        http_response_code(400);
        echo "Thiếu tham số file";
        exit;
    }

    // Đảm bảo an toàn đường dẫn (chống directory traversal)
    $file = str_replace(['..', '\\'], ['', '/'], $file);
    
    // Try to find the file in the date-based structure
    $fullPath = null;
    
    // First try direct path (includes subdirectory structure)
    if (file_exists($rootDir . $file)) {
        $fullPath = $rootDir . $file;
    } else {
        // If not found, search in current date structure  
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $dateBasedPath = $rootDir . "Nam_$year/Thang_$month/Ngay_$day/" . basename($file);
        
        if (file_exists($dateBasedPath)) {
            $fullPath = $dateBasedPath;
        } else {
            // Search in recent dates (last 7 days) for the file
            for ($i = 0; $i < 7; $i++) {
                $searchDate = date("Y-m-d", strtotime("-$i days"));
                $searchYear = date("Y", strtotime($searchDate));
                $searchMonth = date("m", strtotime($searchDate));
                $searchDay = date("d", strtotime($searchDate));
                
                $searchPath = $rootDir . "Nam_$searchYear/Thang_$searchMonth/Ngay_$searchDay/" . basename($file);
                if (file_exists($searchPath)) {
                    $fullPath = $searchPath;
                    break;
                }
            }
        }
    }

    if (!$fullPath || !file_exists($fullPath) || !is_file($fullPath)) {
        http_response_code(404);
        echo "File không tồn tại: " . basename($file);
        exit;
    }

    // Kiểm tra loại file
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    
    if (!in_array($extension, $allowedExtensions)) {
        http_response_code(403);
        echo "Loại file không được phép";
        exit;
    }

    // Xác định MIME type
    $mimeTypes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif'
    ];
    
    $mimeType = isset($mimeTypes[$extension]) ? $mimeTypes[$extension] : 'application/octet-stream';

    // Thiết lập headers
    header('Content-Type: ' . $mimeType);
    header('Content-Length: ' . filesize($fullPath));
    header('Cache-Control: public, max-age=31536000'); // Cache 1 năm
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
    
    // Hỗ trợ Last-Modified để caching hiệu quả
    $lastModified = filemtime($fullPath);
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastModified) . ' GMT');
    
    // Kiểm tra If-Modified-Since
    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
        $ifModifiedSince = strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']);
        if ($ifModifiedSince >= $lastModified) {
            http_response_code(304);
            exit;
        }
    }

    // Output file
    readfile($fullPath);
} else {
    http_response_code(405);
    echo "Chỉ hỗ trợ phương thức GET.";
}
?>
