<?php
// Test auth debugging
header('Content-Type: text/plain');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-USER-CODE");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

echo "=== AUTH DEBUG TEST ===\n";

// Include config
include("config.php");
include("function.php");

// Start session
session_start();

echo "Session Info:\n";
echo "- Session ID: " . session_id() . "\n";
echo "- ERPSOFV2RRight: " . ($_SESSION['ERPSOFV2RRight'] ?? 'NOT SET') . "\n";
echo "- ERPSOFV2RUserID: " . ($_SESSION['ERPSOFV2RUserID'] ?? 'NOT SET') . "\n";

echo "\nHeaders:\n";
foreach (getallheaders() as $name => $value) {
    echo "- $name: $value\n";
}

echo "\nRequest Data:\n";
echo "- Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "- POST: " . json_encode($_POST) . "\n";
echo "- GET: " . json_encode($_GET) . "\n";
echo "- Raw Input: " . file_get_contents('php://input') . "\n";

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);
echo "- Parsed Input: " . json_encode($input) . "\n";

// Test simple database query
echo "\n=== DATABASE TEST ===\n";
$conn = db_connect();
if ($conn) {
    echo "✅ Database connected\n";
    
    // Test count query
    $result = db_query("SELECT COUNT(*) as count FROM pm_nc0002");
    if ($result) {
        $row = db_fetch_array($result);
        echo "✅ Records in pm_nc0002: " . $row['count'] . "\n";
    }
} else {
    echo "❌ Database connection failed\n";
}

echo "\n=== END TEST ===\n";
?>
