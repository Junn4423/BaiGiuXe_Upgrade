<?php
// Thẻ RFID
class pm_nc0003 extends lv_controler{
    public $lv001; // UID thẻ (PK)
    public $lv002; // loại thẻ
    public $lv003; // trạng thái
    public $lv004; // ngày thêm
	public $lv005; //Biển số xe
	public $lv006;
	public $lv007;
	
	//Mo comment la mo quyen ben frontend phai truyen token sau khi dang nhap vao
	// function __construct($vCheckAdmin,$vUserID,$vright)
	// {
		
		// $this->DateCurrent=GetServerDate()." ".GetServerTime();
		// $this->Set_User($vCheckAdmin,$vUserID,$vright);
		
		// $this->isRel=1;		
	 	// $this->isHelp=1;	
		// $this->isConfig=0;
		// $this->isRpt=0;		
	 	// $this->isFil=1;	
		// $this->isApr=0;		
		// $this->isUnApr=0;
		// $this->lang=$_GET['lang'];
		
		
	// }
	
    // Lấy tất cả thẻ
    function LoadAll() {
        $sql = "SELECT * FROM pm_nc0003";
        return db_query($sql);
    }

    // Kiểm tra thẻ tồn tại và có trạng thái hoạt động
    function CheckCardExists($uidThe) {
        $uidThe = addslashes($uidThe);
        $sql = "SELECT lv003 FROM pm_nc0003 WHERE lv001 = '$uidThe'";
        $result = db_query($sql);
        $row = db_fetch_array($result);
        
        if (!$row) {
            return ['exists' => false, 'active' => false, 'message' => 'Thẻ không tồn tại trong hệ thống'];
        }
        
        if ($row['lv003'] != 1) {
            return ['exists' => true, 'active' => false, 'message' => 'Thẻ chưa được kích hoạt'];
        }
        
        return ['exists' => true, 'active' => true, 'message' => 'Thẻ hợp lệ'];
    }

    // Thêm mới
    function KB_Insert() {
        // Kiểm tra trùng lặp UID thẻ
        $lv001_check = addslashes($this->lv001);
        $sql_check = "SELECT COUNT(*) as c FROM pm_nc0003 WHERE lv001 = '$lv001_check'";
        $result_check = db_query($sql_check);
        $check = db_fetch_array($result_check);
        
        if ($check !== false && isset($check['c']) && $check['c'] > 0) {
            error_log("PM_NC0003 Insert failed - Duplicate UID: " . $this->lv001);
            return false;
        }
        
        // Escape dữ liệu để tránh SQL injection
        $lv001_escaped = addslashes($this->lv001);
        $lv002_escaped = addslashes($this->lv002);
        $lv003_escaped = addslashes($this->lv003);
        
        // Xử lý các trường có thể NULL (cho thẻ KHACH) - Database cho phép NULL
        $lv005_value = ($this->lv005 !== null && trim($this->lv005) !== '') ? "'".addslashes($this->lv005)."'" : "NULL";
        $lv006_value = ($this->lv006 !== null && trim($this->lv006) !== '') ? "'".addslashes($this->lv006)."'" : "NULL";
        $lv007_value = ($this->lv007 !== null && trim($this->lv007) !== '') ? "'".addslashes($this->lv007)."'" : "NULL";
        
        // Log dữ liệu để debug
        error_log("PM_NC0003 Insert - Data: lv001={$lv001_escaped}, lv002={$lv002_escaped}, lv003={$lv003_escaped}, lv005={$lv005_value}, lv006={$lv006_value}, lv007={$lv007_value}");
        
        $sql = "INSERT INTO pm_nc0003 (lv001, lv002, lv003, lv004, lv005, lv006, lv007) VALUES ('$lv001_escaped', '$lv002_escaped', '$lv003_escaped', CURDATE(), $lv005_value, $lv006_value, $lv007_value)";
        
        error_log("PM_NC0003 Insert SQL: " . $sql);
        
        $result = db_query($sql);
        
        if (!$result) {
            $mysqlError = sof_error();
            error_log("PM_NC0003 Insert failed - MySQL Error: " . $mysqlError);
        }
        
        return $result;
    }

    // Sửa
    function KB_Update() {
        // Escape dữ liệu để tránh SQL injection
        $lv001_escaped = addslashes($this->lv001);
        $lv002_escaped = addslashes($this->lv002);
        $lv003_escaped = addslashes($this->lv003);
        
        // Xử lý các trường có thể NULL (cho thẻ KHACH) - Database cho phép NULL
        $lv005_value = ($this->lv005 !== null && trim($this->lv005) !== '') ? "'".addslashes($this->lv005)."'" : "NULL";
        $lv006_value = ($this->lv006 !== null && trim($this->lv006) !== '') ? "'".addslashes($this->lv006)."'" : "NULL";
        $lv007_value = ($this->lv007 !== null && trim($this->lv007) !== '') ? "'".addslashes($this->lv007)."'" : "NULL";
        
        error_log("PM_NC0003 Update - Data: lv001={$lv001_escaped}, lv002={$lv002_escaped}, lv003={$lv003_escaped}, lv005={$lv005_value}, lv006={$lv006_value}, lv007={$lv007_value}");
        
        $sql = "UPDATE pm_nc0003 SET lv002 = '$lv002_escaped', lv003 = '$lv003_escaped', lv005 = $lv005_value, lv006 = $lv006_value, lv007 = $lv007_value WHERE lv001 = '$lv001_escaped'";
        
        error_log("PM_NC0003 Update SQL: " . $sql);
        
        $result = db_query($sql);
        
        if (!$result) {
            $mysqlError = sof_error();
            error_log("PM_NC0003 Update failed - MySQL Error: " . $mysqlError);
        }
        
        return $result;
    }

    // Xóa (xóa nhiều, truyền vào chuỗi UID: 'UID1','UID2')
    function KB_Delete($lvarr) {
        $sql = "DELETE FROM pm_nc0003 WHERE lv001 IN ($lvarr)";
        return db_query($sql);
    }
	function KB_TimTheCoPhien($uidThe){
		$sql = "SELECT p3.*, p9.lv003 AS bienSo, p9.lv014 AS trangThaiXe
				FROM pm_nc0003 AS p3
				JOIN pm_nc0009 AS p9 ON p3.lv001 = p9.lv002
				WHERE p3.lv001 = '$uidThe' AND p9.lv014 = 'DANG_GUI'";
		return db_query($sql);
		
	}
	function KB_TimTheTuUID($uidThe){
		$sql = "select * from pm_nc0003 where lv001 = '$uidThe'";
		return db_query($sql);
	}
}
?>