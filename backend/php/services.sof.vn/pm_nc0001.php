<?php
// Loại Phương Tiện
class pm_nc0001 extends lv_controler {
    public $lv001; // mã loại (PK)
    public $lv002; // tên loại
    public $lv003; // mô tả
	
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
		$this->isRpt=0;		
	 	$this->isFil=1;	
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		
		
	}
	
    // Lấy toàn bộ
    function LoadAll() {
        $vsql = "SELECT * FROM pm_nc0001";
        $vresult = db_query($vsql);
        return $vresult;
    }

    // Thêm mới
    function KB_Insert() {
        $lvsql = "INSERT INTO pm_nc0001 (lv001, lv002, lv003) VALUES ('$this->lv001', '$this->lv002', '$this->lv003')";
        $vReturn = db_query($lvsql);
        return $vReturn;
    }

    // Sửa
    function KB_Update() {
        $lvsql = "UPDATE pm_nc0001 SET lv002 = '$this->lv002', lv003 = '$this->lv003' WHERE lv001 = '$this->lv001'";
        $vReturn = db_query($lvsql);
        return $vReturn;
    }

    // Xóa (xóa nhiều, truyền vào chuỗi id, ví dụ: 'A','B','C')
    function KB_Delete($lvarr) {
        // $lvarr dạng "'A','B','C'"
        $lvsql = "DELETE FROM pm_nc0001 WHERE lv001 IN ($lvarr)";
        $vReturn = db_query($lvsql);
        return $vReturn;
    }
}
?>