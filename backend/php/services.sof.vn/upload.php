<?php
/**
 * MinIO Image Upload Service
 * Uploads images to multiple MinIO servers for redundancy
 */

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// MinIO configuration for multiple servers
$minioServers = [
    [
        'name' => 'MinIO-1',
        'endpoint' => '192.168.1.19:9000',
        'accessKey' => 'minioadmin',
        'secretKey' => 'minioadmin',
        'bucket' => 'parking-lot-images',
        'region' => 'us-east-1'
    ],
    [
        'name' => 'MinIO-2', 
        'endpoint' => '192.168.1.90:9000',
        'accessKey' => 'minioadmin',
        'secretKey' => 'minioadmin',
        'bucket' => 'parking-lot-images',
        'region' => 'us-east-1'
    ],
    [
        'name' => 'MinIO-3',
        'endpoint' => '192.168.1.94:9000', 
        'accessKey' => 'minioadmin',
        'secretKey' => 'minioadmin',
        'bucket' => 'parking-lot-images',
        'region' => 'us-east-1'
    ]
];

/**
 * Generate AWS4 signature for MinIO authentication
 */
function generateAWS4Signature($method, $uri, $query, $headers, $payload, $accessKey, $secretKey, $region, $service, $timestamp) {
    $date = substr($timestamp, 0, 8);
    
    // Task 1: Create canonical request
    $canonicalHeaders = '';
    $signedHeaders = '';
    ksort($headers);
    foreach ($headers as $key => $value) {
        $key = strtolower($key);
        $canonicalHeaders .= $key . ':' . trim($value) . "\n";
        $signedHeaders .= $key . ';';
    }
    $signedHeaders = rtrim($signedHeaders, ';');
    
    $canonicalRequest = $method . "\n" . $uri . "\n" . $query . "\n" . $canonicalHeaders . "\n" . $signedHeaders . "\n" . hash('sha256', $payload);
    
    // Task 2: Create string to sign
    $credentialScope = $date . '/' . $region . '/' . $service . '/aws4_request';
    $stringToSign = "AWS4-HMAC-SHA256\n" . $timestamp . "\n" . $credentialScope . "\n" . hash('sha256', $canonicalRequest);
    
    // Task 3: Calculate signature
    $kDate = hash_hmac('sha256', $date, 'AWS4' . $secretKey, true);
    $kRegion = hash_hmac('sha256', $region, $kDate, true);
    $kService = hash_hmac('sha256', $service, $kRegion, true);
    $kSigning = hash_hmac('sha256', 'aws4_request', $kService, true);
    $signature = hash_hmac('sha256', $stringToSign, $kSigning);
    
    return $signature;
}

/**
 * Upload file to MinIO server using curl with AWS4 authentication
 */
function uploadToMinIO($server, $fileName, $fileContent, $contentType) {
    $url = "http://" . $server['endpoint'] . "/" . $server['bucket'] . "/" . rawurlencode($fileName);
    $timestamp = gmdate('Ymd\THis\Z');
    $date = substr($timestamp, 0, 8);
    
    // Prepare headers for signature
    $headers = [
        'host' => $server['endpoint'],
        'x-amz-content-sha256' => hash('sha256', $fileContent),
        'x-amz-date' => $timestamp
    ];
    
    // Generate signature
    $signature = generateAWS4Signature(
        'PUT',
        '/' . $server['bucket'] . '/' . rawurlencode($fileName),
        '',
        $headers,
        $fileContent,
        $server['accessKey'],
        $server['secretKey'],
        $server['region'],
        's3',
        $timestamp
    );
    
    // Create authorization header
    $credentialScope = $date . '/' . $server['region'] . '/s3/aws4_request';
    $signedHeaders = 'host;x-amz-content-sha256;x-amz-date';
    $authorization = 'AWS4-HMAC-SHA256 Credential=' . $server['accessKey'] . '/' . $credentialScope . 
                    ', SignedHeaders=' . $signedHeaders . ', Signature=' . $signature;
    
    // Setup curl
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => $fileContent,
        CURLOPT_HTTPHEADER => [
            'Content-Type: ' . $contentType,
            'Content-Length: ' . strlen($fileContent),
            'Authorization: ' . $authorization,
            'X-Amz-Content-Sha256: ' . hash('sha256', $fileContent),
            'X-Amz-Date: ' . $timestamp,
            'Host: ' . $server['endpoint']
        ],
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        return [
            'server' => $server['name'],
            'status' => 'error',
            'message' => 'cURL Error: ' . $error
        ];
    }
    
    if ($httpCode === 200 || $httpCode === 201) {
        return [
            'server' => $server['name'],
            'status' => 'success',
            'url' => "http://" . $server['endpoint'] . "/" . $server['bucket'] . "/" . rawurlencode($fileName)
        ];
    } else {
        return [
            'server' => $server['name'],
            'status' => 'error',
            'message' => 'HTTP ' . $httpCode . ': ' . $response,
            'response' => $response
        ];
    }
}

/**
 * Generate filename with timestamp (matches frontend format)
 */
function generateFileName($prefix = 'image', $extension = 'jpg') {
    $timestamp = gmdate('Y-m-d\TH-i-s-v\Z');
    return $prefix . '_' . $timestamp . '.' . $extension;
}

/**
 * Validate and sanitize filename
 */
function sanitizeFileName($filename) {
    // Remove any directory traversal attempts
    $filename = basename($filename);
    // Remove any non-alphanumeric chars except dots, dashes, underscores
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
    // Ensure it's not empty
    if (empty($filename)) {
        $filename = 'image_' . time() . '.jpg';
    }
    return $filename;
}

// Main upload handler
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Only POST method is allowed');
    }
    
    // Log incoming request for debugging
    error_log('Upload request received: ' . json_encode([
        'FILES' => $_FILES,
        'POST' => $_POST,
        'content_type' => $_SERVER['CONTENT_TYPE'] ?? 'unknown'
    ]));
    
    // Check if file was uploaded
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errorMessages = [
            UPLOAD_ERR_INI_SIZE => 'File size exceeds PHP upload_max_filesize',
            UPLOAD_ERR_FORM_SIZE => 'File size exceeds form MAX_FILE_SIZE',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload'
        ];
        
        $errorCode = $_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE;
        $errorMessage = $errorMessages[$errorCode] ?? 'Unknown upload error';
        
        throw new Exception('File upload error: ' . $errorMessage);
    }
    
    $uploadedFile = $_FILES['image'];
    $filename = $_POST['filename'] ?? null;
    
    // Validate file type
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $detectedType = finfo_file($finfo, $uploadedFile['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($uploadedFile['type'], $allowedTypes) && !in_array($detectedType, $allowedTypes)) {
        throw new Exception('Invalid file type. Only JPEG, PNG, and GIF are allowed. Detected: ' . $detectedType);
    }
    
    // Use detected MIME type for safety
    $contentType = $detectedType ?: $uploadedFile['type'];
    
    // Validate file size (max 10MB)
    if ($uploadedFile['size'] > 10 * 1024 * 1024) {
        throw new Exception('File size too large. Maximum 10MB allowed. Uploaded: ' . round($uploadedFile['size'] / 1024 / 1024, 2) . 'MB');
    }
    
    // Generate or sanitize filename
    if (!$filename) {
        $extension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION) ?: 'jpg';
        $filename = generateFileName('image', $extension);
    } else {
        $filename = sanitizeFileName($filename);
    }
    
    // Read file content
    $fileContent = file_get_contents($uploadedFile['tmp_name']);
    if ($fileContent === false) {
        throw new Exception('Failed to read uploaded file');
    }
    
    // Log upload attempt
    error_log('Starting upload: ' . json_encode([
        'filename' => $filename,
        'size' => strlen($fileContent),
        'type' => $contentType,
        'servers' => count($minioServers)
    ]));
    
    // Upload to all MinIO servers
    $results = [];
    $successCount = 0;
    
    foreach ($minioServers as $server) {
        $result = uploadToMinIO($server, $filename, $fileContent, $contentType);
        $results[] = $result;
        
        if ($result['status'] === 'success') {
            $successCount++;
            error_log('Upload success to ' . $server['name'] . ': ' . $result['url']);
        } else {
            error_log('Upload failed to ' . $server['name'] . ': ' . $result['message']);
        }
    }
    
    // Prepare response
    if ($successCount === 0) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Failed to upload to any MinIO server',
            'filename' => $filename,
            'results' => $results
        ]);
    } else {
        $message = $successCount === count($minioServers) 
            ? 'Successfully uploaded to all servers'
            : "Uploaded to {$successCount} out of " . count($minioServers) . " servers";
            
        echo json_encode($results);
    }
    
} catch (Exception $e) {
    error_log('Upload error: ' . $e->getMessage());
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'error_type' => get_class($e)
    ]);
} catch (Error $e) {
    error_log('Upload fatal error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal server error',
        'error_type' => get_class($e)
    ]);
}
?>
