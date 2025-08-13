<?php
// Phương Tiện
class pm_nc0002 extends lv_controler{
    public $lv001; // biển số (PK)
    public $lv002; // mã loại (FK)
    public $lv003; // tên chủ xe
    public $lv004; // đường dẫn khuôn mặt chủ xe
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
    // Lấy tất cả phương tiện
    function LoadAll() {
        $sql = "SELECT * FROM pm_nc0002";
        return db_query($sql);
    }

    // Thêm mới
    function KB_Insert() {
        // Debug: Log the values being inserted
        error_log("PM_NC0002 Insert - lv001: " . $this->lv001 . ", lv002: " . $this->lv002 . ", lv003: " . $this->lv003 . ", lv004: " . $this->lv004);
        
        // Escape strings to prevent SQL injection
        $lv001_escaped = addslashes($this->lv001);
        $lv002_escaped = addslashes($this->lv002);
        $lv003_escaped = addslashes($this->lv003);
        $lv004_escaped = addslashes($this->lv004);
        
        $sql = "INSERT INTO pm_nc0002 (lv001, lv002, lv003, lv004) VALUES ('$lv001_escaped', '$lv002_escaped', '$lv003_escaped', '$lv004_escaped')";
        error_log("PM_NC0002 Insert SQL: " . $sql);
        
        $result = db_query($sql);
        error_log("PM_NC0002 Insert Result: " . ($result ? "SUCCESS" : "FAILED"));
        
        return $result;
    }

    // Sửa
    function KB_Update() {
        $sql = "UPDATE pm_nc0002 SET lv002 = '$this->lv002', lv003 = '$this->lv003', lv004 = '$this->lv004' WHERE lv001 = '$this->lv001'";
        return db_query($sql);
    }

    // Xóa (xóa nhiều biển số, truyền vào: 'BS1','BS2')
    function KB_Delete($lvarr) {
        $sql = "DELETE FROM pm_nc0002 WHERE lv001 IN ($lvarr)";
        return db_query($sql);
    }
}
?>