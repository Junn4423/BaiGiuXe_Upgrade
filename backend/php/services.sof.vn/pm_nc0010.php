<?php
/**
 * API endpoints for Scan Logs (pm_nc0010)
 */
class pm_nc0010 extends lv_controler{
    public $lv002; // session_id (mã phiên gửi xe)
    public $lv003; // camera_id
    public $lv004; // thời gian quét
    public $lv005; // ảnh (đường dẫn hoặc base64)
    public $lv006; // so khớp biển số (1/0)
    public $lv007; // direction: 'entry' hoặc 'exit'

    // Thêm mới nhật ký quét thẻ
    function KB_Insert() {
        if (!$this->lv002 || !$this->lv003 || !$this->lv004 || !$this->lv005 || !$this->lv007) {
            return false;
        }
        // Nếu lv006 (plate_match) chưa truyền thì mặc định là 0 (không khớp)
        $plate_match = ($this->lv006 !== null) ? $this->lv006 : 0;
        $sql = "INSERT INTO pm_nc0010 (lv002, lv003, lv004, lv005, lv006, lv007)
                VALUES ('{$this->lv002}', '{$this->lv003}', '{$this->lv004}', '{$this->lv005}', '{$plate_match}', '{$this->lv007}')";
        return db_query($sql) ? true : false;
    }
    
// Get all scan logs
function getAllScanLogs() {
    $conn = connectDB();
    
    try {
        $stmt = $conn->prepare("
            SELECT l.*, s.lv003 as license_plate, c.lv002 as camera_name
            FROM pm_nc0010 l
            JOIN pm_nc0009 s ON l.lv002 = s.lv001
            JOIN pm_nc0006 c ON l.lv003 = c.lv001
            ORDER BY l.lv004 DESC
        ");
        $stmt->execute();
        $logs = $stmt->fetchAll();
        
        apiResponse(true, "Scan logs retrieved successfully", $logs);
    } catch (PDOException $e) {
        apiResponse(false, "Error retrieving scan logs: " . $e->getMessage(), null, 500);
    }
}

// Get scan logs by session ID
function getScanLogsBySession($sessionId) {
    if (!validateParam($sessionId)) {
        apiResponse(false, "Session ID is required", null, 400);
    }
    
    $conn = connectDB();
    
    try {
        // Check if session exists
        if (!sessionExists($conn, $sessionId)) {
            apiResponse(false, "Parking session not found", null, 404);
        }
        
        $stmt = $conn->prepare("
            SELECT l.*, c.lv002 as camera_name
            FROM pm_nc0010 l
            JOIN pm_nc0006 c ON l.lv003 = c.lv001
            WHERE l.lv002 = ?
            ORDER BY l.lv004 ASC
        ");
        $stmt->execute([$sessionId]);
        $logs = $stmt->fetchAll();
        
        apiResponse(true, "Scan logs retrieved successfully", $logs);
    } catch (PDOException $e) {
        apiResponse(false, "Error retrieving scan logs: " . $e->getMessage(), null, 500);
    }
}

// Create a new scan log
function createScanLog($data) {
    if (!validateParam($data['lv002']) || !validateParam($data['lv003']) || 
        !validateParam($data['lv004']) || !validateParam($data['lv005'])) {
        apiResponse(false, "Session ID, camera ID, scan time, and image path are required", null, 400);
    }
    
    $conn = connectDB();
    
    try {
        // Check if session exists
        if (!sessionExists($conn, $data['lv002'])) {
            apiResponse(false, "Parking session not found", null, 404);
        }
        
        // Check if camera exists
        if (!cameraExists($conn, $data['lv003'])) {
            apiResponse(false, "Camera not found", null, 404);
        }
        
        // Set default values
        $plateMatch = isset($data['lv006']) ? ($data['lv006'] ? 1 : 0) : 0;
        
        $stmt = $conn->prepare("
            INSERT INTO pm_nc0010 (lv002, lv003, lv004, lv005, lv006, lv007)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            sanitizeInput($data['lv002']),
            sanitizeInput($data['lv003']),
            sanitizeInput($data['lv004']),
            sanitizeInput($data['lv005']),
            $plateMatch,
            isset($data['lv007']) ? sanitizeInput($data['lv007']) : null
        ]);
        
        $logId = $conn->lastInsertId();
        
        apiResponse(true, "Scan log created successfully", [
            "id" => $logId
        ]);
    } catch (PDOException $e) {
        apiResponse(false, "Error creating scan log: " . $e->getMessage(), null, 500);
    }
}
}