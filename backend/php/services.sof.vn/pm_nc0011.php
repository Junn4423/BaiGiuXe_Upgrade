<?php
// Loại Phương Tiện
class pm_nc0011 extends lv_controler {
    public $lv001; // mã khu vuc (PK)
    public $lv002; // taikhoanDN nhan vien
    public $lv003; // mô tả
	
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
	
     function LoadAll() {
        $vsql = "SELECT * FROM pm_nc0011";
        return db_query($vsql);
    }

    // Thêm mới
    function KB_Insert() {
        $lvsql = "INSERT INTO pm_nc0011 (lv001, lv002, lv003)
                  VALUES ('$this->lv001', '$this->lv002', '$this->lv003')";
        return db_query($lvsql);
    }

    // Xóa 1 bản ghi cụ thể theo khóa chính tổ hợp
    function KB_Delete($lv001, $lv002) {
        $lvsql = "DELETE FROM pm_nc0011 WHERE lv001 = '$lv001' AND lv002 = '$lv002'";
        return db_query($lvsql);
    }

    // Xóa nhiều bản ghi theo danh sách cặp khóa chính (nâng cao - nếu cần)
    function KB_Delete_Multiple($list) {
        // $list = [["kv001", "nv001"], ["kv002", "nv001"], ...]
        $conditions = array_map(function($item) {
            return "(lv001 = '{$item[0]}' AND lv002 = '{$item[1]}')";
        }, $list);

        $whereClause = implode(" OR ", $conditions);
        $lvsql = "DELETE FROM pm_nc0011 WHERE $whereClause";
        return db_query($lvsql);
    }

    function KB_LoadID($lv002){
        $vsql = "SELECT * FROM pm_nc0011 where lv002 = '$lv002'";
            return db_query($vsql);
    }
    function KB_XoaAll() {
    $lvsql = "DELETE FROM pm_nc0011 WHERE lv002 = '$this->lv002'";
    return db_query($lvsql);
}
}
?>