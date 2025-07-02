<?php
// Quản lý camera ANPR
class pm_nc0006 extends lv_controler {
    public $lv001; // Mã camera (PK)
    public $lv002; // Tên camera
    public $lv003; // Loại camera
    public $lv004; // Chức năng camera
    public $lv005; // Mã khu vực
    public $lv006; // Link RSTP
	
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
    // Lấy tất cả camera
    function LoadAll() {
        $sql = "SELECT * FROM pm_nc0006";
        return db_query($sql);
    }

    // Lấy thông tin một camera theo mã
    function GetById($cameraId) {
        if (!$cameraId) return null;
        $sql = "SELECT * FROM pm_nc0006 WHERE lv001 = '".addslashes($cameraId)."' LIMIT 1";
        $result = db_query($sql);
        return db_fetch_array($result);
    }

    // Thêm mới camera
    function KB_Insert() {
        $lv001 = addslashes($this->lv001);

        // Kiểm tra mã camera trùng
        $sql_check = "SELECT COUNT(*) as c FROM pm_nc0006 WHERE lv001 = '$lv001'";
        $result = db_query($sql_check);
        $check = db_fetch_array($result);
        $check = db_fetch_array($result);

        if ($check !== false && isset($check['c']) && $check['c'] > 0) {
            return [
                'success' => false,
                'message' => "Mã camera đã tồn tại"
            ];
        }

        $sql = "INSERT INTO pm_nc0006 (lv001, lv002, lv003, lv004, lv005, lv006)
                VALUES (
                    '$lv001',
                    '".addslashes($this->lv002)."',
                    '".addslashes($this->lv003)."',
                    ".(($this->lv004 !== null) ? "'".addslashes($this->lv004)."'" : "NULL").",
                    ".(($this->lv005 !== null) ? "'".addslashes($this->lv005)."'" : "NULL").",
                    ".(($this->lv006 !== null) ? "'".addslashes($this->lv006)."'" : "NULL")."
                )";

        if (db_query($sql)) {
            return [
                'success' => true,
                'message' => 'Thêm camera thành công'
            ];
        }
        return [
            'success' => false,
            'message' => 'Lỗi khi thêm camera'
        ];
    }

    // Cập nhật camera
	function KB_Update() {
		// Kiểm tra dữ liệu bắt buộc: mã camera, tên, loại, mã khu
		if (!$this->lv001 || !$this->lv002 || !$this->lv003 || !$this->lv005) {
			return false;
		}

		// Kiểm tra tồn tại camera
		$row = db_fetch_array(db_query("SELECT 1 FROM pm_nc0006 WHERE lv001 = '" . addslashes($this->lv001) . "'"));
		if (!$row) {
			return false;
		}

		// Kiểm tra mã khu tồn tại trong bảng khu vực (pm_nc0004)
		$zone = db_fetch_array(db_query("SELECT 1 FROM pm_nc0004 WHERE lv001 = '" . addslashes($this->lv005) . "'"));
		if (!$zone) {
			return false;
		}

		// Cập nhật camera
		$sql = "UPDATE pm_nc0006 
				SET lv002 = '" . addslashes($this->lv002) . "',
					lv003 = '" . addslashes($this->lv003) . "',
					lv004 = " . ($this->lv004 !== null ? "'" . addslashes($this->lv004) . "'" : "NULL") . ",
					lv005 = '" . addslashes($this->lv005) . "',
					lv006 = " . ($this->lv006 !== null ? "'" . addslashes($this->lv006) . "'" : "NULL") . "
				WHERE lv001 = '" . addslashes($this->lv001) . "'";

		return db_query($sql) ? true : false;
	}

    // Xóa camera
    function KB_Delete($maCamera) {
		if (!$maCamera) {
			return [
				'success' => false,
				'message' => 'Thiếu mã camera'
			];
		}
		$sql = "DELETE FROM pm_nc0006 WHERE lv001 = '$maCamera'";

		if (db_query($sql)) {
			return [
				'success' => true,
				'message' => 'Xóa camera thành công (đã bỏ qua ràng buộc khóa ngoại)'
			];
		}

		return [
			'success' => false,
			'message' => 'Lỗi khi xóa camera'
		];
	}

    // Lấy danh sách camera theo mã khu vực
    function GetByZone($zoneId) {
        $sql = "SELECT * FROM pm_nc0006 WHERE lv005 = '".addslashes($zoneId)."'";
        return db_query($sql);
    }
}
?>
