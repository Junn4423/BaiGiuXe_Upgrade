<?php
// Chỗ đỗ xe
class pm_nc0005 extends lv_controler{
    public $lv001; // Mã chỗ đỗ (PK)
    public $lv002; // Mã khu vực (FK)
    public $lv003; // Trạng thái: TRONG/DA_DAT
	
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
    // Lấy tất cả chỗ đỗ (có tên khu vực)
    function LoadAll() {
        $sql = "SELECT s.*, z.lv002 as zone_name
                FROM pm_nc0005 s
                JOIN pm_nc0004 z ON s.lv002 = z.lv001";
        return db_query($sql);
    }

    // Lấy thông tin một chỗ đỗ theo mã
    function GetById($spotId) {
        $spotId = addslashes($spotId);
        $sql = "SELECT s.*, z.lv002 as zone_name
                FROM pm_nc0005 s
                JOIN pm_nc0004 z ON s.lv002 = z.lv001
                WHERE s.lv001 = '$spotId'";
        $result = db_query($sql);
        return $result;
    }
	function LoadID($maKhuVuc){
		$sql = "SELECT s.*, z.lv002 as zone_name
                FROM pm_nc0005 s
                JOIN pm_nc0004 z ON s.lv002 = z.lv001 where s.lv002 = '$maKhuVuc'";
		return db_query($sql);
	}
    // Thêm mới chỗ đỗ
    function KB_Insert() {
        // Nếu trạng thái rỗng thì mặc định là 'TRONG'
        if (!$this->lv003) $this->lv003 = 'TRONG';
        $sql = "INSERT INTO pm_nc0005 (lv001, lv002, lv003) VALUES ('$this->lv001', '$this->lv002', '$this->lv003')";
        return db_query($sql);
    }

    // Sửa chỗ đỗ
    function KB_Update() {
        $sql = "UPDATE pm_nc0005 SET lv002 = '$this->lv002', lv003 = '$this->lv003' WHERE lv001 = '$this->lv001'";
        return db_query($sql);
    }
	
    // Xóa chỗ đỗ (chỉ xóa nếu không có phiên gửi xe đang sử dụng)
    function KB_Delete($spotId) {
        $spotId = addslashes($spotId);
        // Kiểm tra còn phiên gửi xe đang hoạt động
        $sqlCheck = "SELECT COUNT(*) AS total FROM pm_nc0009 WHERE lv004 = '$spotId' AND lv014 = 'DANG_GUI'";
        $result = db_query($sqlCheck);
        $row = db_fetch_array($result);
        if ($row['total'] > 0) return false; // Không cho xóa

        $sql = "DELETE FROM pm_nc0005 WHERE lv001 = '$spotId'";
        return db_query($sql);
    }

    // Đổi trạng thái chỗ đỗ (TRONG/DA_DAT)
    function KB_ChinhSuaTrangThai($spotId, $status) {
        $spotId = addslashes($spotId);
        $status = addslashes($status);
        // Chỉ chấp nhận 2 trạng thái
        if ($status != '1' && $status != '0') return false;
        $sql = "UPDATE pm_nc0005 SET lv003 = '$status' WHERE lv001 = '$spotId'";
        return db_query($sql);
    }

    // Lấy danh sách chỗ đỗ còn trống
    function LoadAvailable() {
        $sql = "SELECT s.*, z.lv002 as zone_name
                FROM pm_nc0005 s
                JOIN pm_nc0004 z ON s.lv002 = z.lv001
                WHERE s.lv003 = 'TRONG'";
        return db_query($sql);
    }
}
?>