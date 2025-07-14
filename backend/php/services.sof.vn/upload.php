<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

header('Content-Type: application/json');

// Danh sách các server MinIO
$minioConfigs = [
    [
        'name' => 'MinIO-1',
        'endpoint' => 'http://192.168.1.19:9000',
        'access_key' => 'minioadmin',
        'secret_key' => 'minioadmin',
    ],
    [
        'name' => 'MinIO-2',
        'endpoint' => 'http://192.168.1.90:9000',
        'access_key' => 'minioadmin',
        'secret_key' => 'minioadmin',
    ],
    [
        'name' => 'MinIO-3',
        'endpoint' => 'http://192.168.1.94:9000',
        'access_key' => 'minioadmin',
        'secret_key' => 'minioadmin',
    ],
];

// Tên bucket cần upload
$bucket = 'parking-lot-images';

// Kiểm tra file upload
if (!isset($_FILES['image']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No image uploaded']);
    exit;
}

$originalTmpPath = $_FILES['image']['tmp_name'];
$originalName = $_FILES['image']['name'];
$extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

// Xử lý tên file được gửi (filename)
$rawName = isset($_POST['filename']) && trim($_POST['filename']) !== ''
    ? $_POST['filename']
    : pathinfo($originalName, PATHINFO_FILENAME);

// Nếu không có đuôi, tự động thêm
$keyName = (pathinfo($rawName, PATHINFO_EXTENSION) === '') 
    ? $rawName . '.' . $extension
    : $rawName;

// Đường dẫn ảnh nén tạm (jpg)
$compressedTmpPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('compressed_') . '.jpg';

// Hàm nén ảnh JPEG hoặc chuyển PNG → JPG
function compressImage($sourcePath, $destPath, $maxWidth = 1280, $quality = 50) {
    $info = getimagesize($sourcePath);
    if (!$info) return false;

    list($srcWidth, $srcHeight) = $info;
    $mime = $info['mime'];

    // Load ảnh
    switch ($mime) {
        case 'image/jpeg':
            $src = imagecreatefromjpeg($sourcePath);
            break;
        case 'image/png':
            $src = imagecreatefrompng($sourcePath);
            // Fill trắng nếu ảnh trong suốt
            $bg = imagecreatetruecolor($srcWidth, $srcHeight);
            $white = imagecolorallocate($bg, 255, 255, 255);
            imagefill($bg, 0, 0, $white);
            imagecopy($bg, $src, 0, 0, 0, 0, $srcWidth, $srcHeight);
            $src = $bg;
            break;
        default:
            return false;
    }

    // Resize nếu ảnh lớn hơn maxWidth
    if ($srcWidth > $maxWidth) {
        $newWidth = $maxWidth;
        $newHeight = intval(($srcHeight / $srcWidth) * $maxWidth);
        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resized, $src, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);
    } else {
        $resized = $src;
    }

    // Nén và lưu
    return imagejpeg($resized, $destPath, $quality);
}


// Nén ảnh
$success = compressImage($originalTmpPath, $compressedTmpPath, 480, 30);
if (!$success) {
    http_response_code(500);
    echo json_encode(['error' => 'Unsupported image type. Only JPG and PNG supported.']);
    exit;
}

// So sánh dung lượng
$originalSize = filesize($originalTmpPath);
$compressedSize = filesize($compressedTmpPath);

if ($compressedSize < $originalSize) {
    // Dùng ảnh đã nén
    $uploadPath = $compressedTmpPath;
    $contentType = mime_content_type($compressedTmpPath);
} else {
    // Dùng ảnh gốc
    $uploadPath = $originalTmpPath;
    $contentType = mime_content_type($originalTmpPath);
}

// Bắt đầu upload
$results = [];

foreach ($minioConfigs as $minio) {
    try {
        $client = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-1',
            'endpoint' => $minio['endpoint'],
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key' => $minio['access_key'],
                'secret' => $minio['secret_key'],
            ],
            'suppress_php_deprecation_warning' => true,
        ]);

        if (!$client->doesBucketExist($bucket)) {
            $client->createBucket(['Bucket' => $bucket]);
        }

        $client->putObject([
            'Bucket' => $bucket,
            'Key' => $keyName,
            'SourceFile' => $uploadPath,
            'ContentType' => $contentType,
        ]);

        $fileUrl = rtrim($minio['endpoint'], '/') . '/' . $bucket . '/' . rawurlencode($keyName);

        $results[] = [
            'server' => $minio['name'],
            'status' => 'success',
            'url' => $fileUrl,
        ];
    } catch (AwsException $e) {
        $results[] = [
            'server' => $minio['name'],
            'status' => 'error',
            'message' => $e->getAwsErrorMessage() ?: $e->getMessage(),
        ];
    }
}

// Xoá file nén nếu có
if (file_exists($compressedTmpPath)) {
    unlink($compressedTmpPath);
}

// Trả kết quả
echo json_encode($results, JSON_PRETTY_PRINT);
