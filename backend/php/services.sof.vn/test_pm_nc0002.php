<?php
// Test script để debug API
header('Content-Type: application/json');
include 'config.php';
include 'lv_controler.php';  // Include base controller class
include 'pm_nc0002.php';

echo "=== DEBUG TEST PM_NC0002 ===\n";

// Test connection
$conn = db_connect();
if ($conn) {
    echo "✅ Database connection: SUCCESS\n";
} else {
    echo "❌ Database connection: FAILED\n";
    exit;
}

// Test simple query
$testQuery = "SELECT COUNT(*) as count FROM pm_nc0002";
$testResult = db_query($testQuery);
if ($testResult) {
    $row = db_fetch_array($testResult);
    echo "✅ Current records in pm_nc0002: " . $row['count'] . "\n";
} else {
    echo "❌ Failed to query pm_nc0002\n";
}

// Test insert
echo "\n=== TESTING INSERT ===\n";
$pm_nc0002 = new pm_nc0002();
$pm_nc0002->lv001 = "TEST" . time(); // Unique license plate
$pm_nc0002->lv002 = "OT";
$pm_nc0002->lv003 = "Test User";
$pm_nc0002->lv004 = "test_image.jpg";

echo "Testing data:\n";
echo "- lv001 (bienSo): " . $pm_nc0002->lv001 . "\n";
echo "- lv002 (maLoaiPT): " . $pm_nc0002->lv002 . "\n";
echo "- lv003 (tenChuXe): " . $pm_nc0002->lv003 . "\n";
echo "- lv004 (duongDanKhuonMat): " . $pm_nc0002->lv004 . "\n";

$result = $pm_nc0002->KB_Insert();
if ($result) {
    echo "✅ INSERT: SUCCESS\n";
} else {
    echo "❌ INSERT: FAILED\n";
    echo "MySQL Error: " . sof_error() . "\n";
}

echo "\n=== END TEST ===\n";
?>