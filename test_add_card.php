<?php
// Test script để debug lỗi thêm thẻ RFID
// File: test_add_card.php

// Include các file cần thiết (adjust path theo cấu trúc project)
include_once 'backend/php/services.sof.vn/function.php';
include_once 'backend/php/services.sof.vn/pm_nc0003.php';

// Test data
$testCases = [
    [
        'name' => 'Test 1: Thẻ KHACH',
        'data' => [
            'uidThe' => 'TEST_KHACH_001',
            'loaiThe' => 'KHACH',
            'trangThai' => '1'
        ]
    ],
    [
        'name' => 'Test 2: Thẻ VIP',
        'data' => [
            'uidThe' => 'TEST_VIP_001',
            'loaiThe' => 'VIP',
            'trangThai' => '1',
            'bienSoXe' => '86B12345'
        ]
    ],
    [
        'name' => 'Test 3: Thẻ NHANVIEN (sẽ bị lỗi enum)',
        'data' => [
            'uidThe' => 'TEST_NV_001',
            'loaiThe' => 'NHANVIEN',
            'trangThai' => '1'
        ]
    ]
];

echo "<h1>Test Add RFID Card</h1>";

foreach ($testCases as $test) {
    echo "<h2>{$test['name']}</h2>";
    echo "<p>Data: " . json_encode($test['data']) . "</p>";
    
    try {
        $pm_nc0003 = new pm_nc0003();
        $pm_nc0003->lv001 = $test['data']['uidThe'];
        $pm_nc0003->lv002 = $test['data']['loaiThe'];
        $pm_nc0003->lv003 = $test['data']['trangThai'];
        $pm_nc0003->lv005 = $test['data']['bienSoXe'] ?? '';
        $pm_nc0003->lv006 = '';
        $pm_nc0003->lv007 = '';
        
        // Apply business logic như trong kebao.php
        if ($pm_nc0003->lv002 == 'NHANVIEN') {
            $pm_nc0003->lv002 = 'VIP';
            echo "<p style='color: orange;'>Mapped NHANVIEN to VIP</p>";
        }
        
        if ($pm_nc0003->lv002 == 'KHACH') {
            $pm_nc0003->lv005 = '';
            $pm_nc0003->lv006 = '';
            $pm_nc0003->lv007 = '';
            echo "<p style='color: blue;'>Set empty values for KHACH</p>";
        }
        
        $result = $pm_nc0003->KB_Insert();
        
        if ($result) {
            echo "<p style='color: green;'>✓ SUCCESS: Thêm thẻ thành công</p>";
        } else {
            $error = sof_error();
            echo "<p style='color: red;'>✗ FAILED: " . $error . "</p>";
        }
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ EXCEPTION: " . $e->getMessage() . "</p>";
    }
    
    echo "<hr>";
}

echo "<h2>Database Info</h2>";
echo "<p>Check enum values for pm_nc0003.lv002:</p>";

try {
    $sql = "SHOW COLUMNS FROM pm_nc0003 LIKE 'lv002'";
    $result = db_query($sql);
    if ($result) {
        $row = db_fetch_array($result);
        echo "<pre>" . print_r($row, true) . "</pre>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>Error getting column info: " . $e->getMessage() . "</p>";
}

?>
