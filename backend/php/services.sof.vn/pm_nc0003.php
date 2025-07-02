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
        $sql = "INSERT INTO pm_nc0003 (lv001, lv002, lv003, lv004, lv005,lv006,lv007) VALUES ('$this->lv001', '$this->lv002', '$this->lv003', CURDATE(), '$this->lv005','$this->lv006','$this->lv007')";
        return db_query($sql);
    }

    // Sửa
    function KB_Update() {
        $sql = "UPDATE pm_nc0003 SET lv002 = '$this->lv002', lv003 = '$this->lv003', lv005 = '$this->lv005', lv006 = '$this->lv006', lv007 = '$this->lv007' WHERE lv001 = '$this->lv001'";
        return db_query($sql);
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