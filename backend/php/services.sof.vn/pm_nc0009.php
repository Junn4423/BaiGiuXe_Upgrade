<?php
/**
 * API endpoints for Parking Sessions (pm_nc0009)
 */

// Get all parking sessions
class pm_nc0009 extends lv_controler{
    public $lv001;
    public $lv002;
    public $lv003;
    public $lv004;
    public $lv005;
    public $lv006;
    public $lv007;
    public $lv009;
    public $lv008;
    public $lv011;
    public $lv012;
    public $lv013;
    public $lv014;
    public $lv015;
    public $lv016;
	
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
    function KB_Insert() {
        // Kiểm tra các trường bắt buộc
        if (!$this->lv002 || !$this->lv003 || !$this->lv005 || !$this->lv006 || !$this->lv008 || !$this->lv011) {
            return [
                'success' => false,
                'message' => 'Thiếu thông tin bắt buộc (mã thẻ, biển số, chính sách, cổng vào, giờ vào, hoặc ảnh vào).'
            ];
        }

        // Kiểm tra thẻ tồn tại và active
        $card = db_fetch_array(db_query("SELECT lv003 FROM pm_nc0003 WHERE lv001 = '{$this->lv002}'"));
        if (!$card || !$card['lv003']) {
            return [
                'success' => false,
                'message' => "Mã thẻ {$this->lv002} không tồn tại hoặc không hoạt động."
            ];
        }

        // Kiểm tra trùng phiên gửi
        $cnt = db_fetch_array(db_query("SELECT COUNT(*) as c FROM pm_nc0009 WHERE lv002 = '{$this->lv002}' AND lv014 = 'DANG_GUI'"));
        if ($cnt && $cnt['c'] > 0) {
            return [
                'success' => false,
                'message' => "Mã thẻ {$this->lv002} đang được sử dụng trong một phiên gửi xe khác."
            ];
        }

        // Kiểm tra trùng biển số
        $cnt_plate = db_fetch_array(db_query("SELECT COUNT(*) as c FROM pm_nc0009 WHERE lv003 = '{$this->lv003}' AND lv014 = 'DANG_GUI'"));
        if ($cnt_plate && $cnt_plate['c'] > 0) {
            return [
                'success' => false,
                'message' => "Biển số {$this->lv003} đang được sử dụng trong một phiên gửi xe khác."
            ];
        }
		// Kiểm tra biển số có đúng cảu nhân viên hay khác vip đó k
		$sqlCheck = db_fetch_array(db_query("
			SELECT COUNT(*) as c
			FROM pm_nc0003
			WHERE lv001 = '{$this->lv002}'
			  AND lv002 IN ('NHANVIEN', 'VIP')
			  AND lv005 != '{$this->lv003}'
		"));
		if ($sqlCheck && $sqlCheck['c'] > 0) {
			return [
				'success' => false,
				'message' => "Biển số {$this->lv003} không khớp với thẻ {$this->lv002} (loại NHANVIEN/VIP)."
			];
		}
        // Kiểm tra xe, thêm nếu chưa có
        $car = db_fetch_array(db_query("SELECT 1 FROM pm_nc0002 WHERE lv001 = '{$this->lv003}'"));
        if (!$car) {
            $vt = db_fetch_array(db_query("SELECT lv002 FROM pm_nc0008 WHERE lv001 = '{$this->lv005}'"));
            if (!$vt) {
                return [
                    'success' => false,
                    'message' => "Chính sách giá {$this->lv005} không hợp lệ."
                ];
            }
            $insert_car = db_query("INSERT INTO pm_nc0002 (lv001, lv002) VALUES ('{$this->lv003}', '{$vt['lv002']}')");
            if (!$insert_car) {
                return [
                    'success' => false,
                    'message' => "Không thể thêm thông tin xe với biển số {$this->lv003}."
                ];
            }
        }

        // Kiểm tra chính sách giá
        $cs = db_fetch_array(db_query("SELECT 1 FROM pm_nc0008 WHERE lv001 = '{$this->lv005}'"));
        if (!$cs) {
            return [
                'success' => false,
                'message' => "Chính sách giá {$this->lv005} không tồn tại."
            ];
        }

        // Kiểm tra cổng vào
        $gate = db_fetch_array(db_query("SELECT 1 FROM pm_nc0007 WHERE lv001 = '{$this->lv006}'"));
        if (!$gate) {
            return [
                'success' => false,
                'message' => "Cổng vào {$this->lv006} không tồn tại."
            ];
        }

        // Nếu có vị trí gửi, kiểm tra và đặt (đang bị comment)
        /*
        if ($this->lv004) {
            $upd = db_query("UPDATE pm_nc0005 SET lv003 = 'DA_DAT' WHERE lv001 = '{$this->lv004}' AND lv003 = 'TRONG'");
            if (!$upd) {
                return [
                    'success' => false,
                    'message' => "Vị trí gửi {$this->lv004} không khả dụng hoặc không tồn tại."
                ];
            }
        }
        */

        // Insert phiên gửi xe
        $sql = "INSERT INTO pm_nc0009 (lv002, lv003, lv004, lv005, lv006, lv008, lv011, lv014,lv015)
            VALUES ('{$this->lv002}', '{$this->lv003}', " .
            ($this->lv004 ? "'{$this->lv004}'" : "NULL") . ", '{$this->lv005}', '{$this->lv006}', '{$this->lv008}', '{$this->lv011}', 'DANG_GUI' , '{$this->lv015}')";

        $result = db_query($sql);

        if ($result) {
            // Lấy AUTO_INCREMENT id vừa insert
            $this->lv001 = sof_insert_id();
            
            // Đồng bộ trạng thái chỗ đỗ
            require_once 'pm_nc0005.php';
            $spotManager = new pm_nc0005();
            $spotManager->AutoSyncStatus();
            
            return [
                'success' => true,
                'message' => 'Thêm phiên gửi xe thành công.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Lỗi khi thêm phiên gửi xe vào cơ sở dữ liệu.'
        ];
    }
    function KB_Update() {
        if (!$this->lv001 || !$this->lv007 || !$this->lv009 || !$this->lv012 || !$this->lv016 ) {
            return false;
        }
        // Kiểm tra phiên gửi xe còn "DANG_GUI"
        $row = db_fetch_array(db_query("SELECT lv014 FROM pm_nc0009 WHERE lv001 = '{$this->lv001}'"));
        if (!$row || $row['lv014'] != 'DANG_GUI') return false;

        // Kiểm tra cổng ra
        $gate = db_fetch_array(db_query("SELECT 1 FROM pm_nc0007 WHERE lv001 = '{$this->lv007}'"));
        if (!$gate) return false;

        // Tính thời gian gửi (phút) và cập nhật
        $session = db_fetch_array(db_query("SELECT lv008 FROM pm_nc0009 WHERE lv001 = '{$this->lv001}'"));
        if (!$session) return false;
        $gioVao = strtotime($session['lv008']);
        $gioRa = strtotime($this->lv009);
        $phutGui = ($gioRa - $gioVao) / 60;
        if ($phutGui < 60) $phutGui = '60'; // Đảm bảo ít nhất 1 giờ
        // Cập nhật phiên gửi xe
        $sql = "UPDATE pm_nc0009 
                SET lv007='{$this->lv007}',
                    lv009='{$this->lv009}',
                    lv010='{$phutGui}',
                    lv012='{$this->lv012}',
                    lv014='DA_RA',
                    lv016='{$this->lv016}' 
                WHERE lv001='{$this->lv001}'";
        
        $result = db_query($sql);
        if ($result) {
            // Đồng bộ trạng thái chỗ đỗ khi xe ra
            require_once 'pm_nc0005.php';
            $spotManager = new pm_nc0005();
            $spotManager->AutoSyncStatus();
        }
        
        return $result ? true : false;
    }
	function KB_UpdateTrangThai_DangGui(){
		if (!$this->lv001) {
			return false;
		}

		// Kiểm tra phiên gửi xe có trạng thái là "DA_RA"
		$row = db_fetch_array(db_query("SELECT lv014 FROM pm_nc0009 WHERE lv001 = '{$this->lv001}'"));
		if (!$row || $row['lv014'] != 'DA_RA') return false;

		// Cập nhật trạng thái và xóa các cột liên quan
		$sql = "UPDATE pm_nc0009 
				SET lv014='DANG_GUI',
					lv007=NULL,
					lv009=NULL,
					lv010=NULL,
					lv012=NULL,
					lv013=NULL,
					lv016=NULL
				WHERE lv001='{$this->lv001}'";

		$result = db_query($sql);
		if ($result) {
			// Đồng bộ trạng thái chỗ đỗ khi xe vào lại
			require_once 'pm_nc0005.php';
			$spotManager = new pm_nc0005();
			$spotManager->AutoSyncStatus();
		}
		
		return $result ? true : false;
	}
    function LoadAll() {
        $sql = "Select * from pm_nc0009";
        $vresult = db_query($sql);
        return $vresult;
    }
    function KB_LoadPhienTheoUID($uId) {
        $sql = "Select * from pm_nc0009 where lv002 = '{$uId}' and lv014 = 'DANG_GUI'";
        $vresult = db_query($sql);
        return $vresult;
    }
    function KB_LoadPhienTheoUID_2($uId) {
        $sql = "Select * from pm_nc0009 where lv002 = '{$uId}' and lv014 = 'DA_RA'";
        $vresult = db_query($sql);
        return $vresult;
    }
	function tableExists($tableName) {
		$sql = ("SHOW TABLES LIKE '$tableName'");
		$result = db_query($sql);
		return $result && db_num_rows($result) > 0;
	}
    
	function KB_TaoPhienLamViec() {
		// Ngày hôm qua theo định dạng ddmmyyyy
		$yesterday = date('dmY', strtotime('-1 day'));
		$newTableName = "pm_nc0009_" . $yesterday;

		if ($this->tableExists($newTableName)) {
			return [
				'success' => false,
				'message' => "Bảng $newTableName đã tồn tại. Không thể tạo lại."
			];
		}
		// 1. Tạo bảng mới giống pm_nc0009
		$createTableSQL = "CREATE TABLE IF NOT EXISTS `$newTableName` LIKE pm_nc0009";
		if (!db_query($createTableSQL)) {
			return [
				'success' => false,
				'message' => "Không thể tạo bảng $newTableName."
			];
		}

		// 2. Xoá dữ liệu nếu bảng đã tồn tại
		if (!db_query("TRUNCATE TABLE `$newTableName`")) {
			return [
				'success' => false,
				'message' => "Không thể xoá dữ liệu cũ trong bảng $newTableName."
			];
		}

		// 3. Lấy dữ liệu từ pm_nc0009 có trạng thái khác 'DANG_GUI'
		$selectSQL = "SELECT * FROM pm_nc0009 WHERE lv014 != 'DANG_GUI'";
		$result = db_query($selectSQL);

		$copiedRows = 0;

		while ($row = db_fetch_array($result)) {
			if (!$row || !is_array($row)) continue;

			// Chỉ lấy các key dạng string (loại bỏ key số)
			$columns = array_filter(array_keys($row), 'is_string');
			$columnsList = "`" . implode("`, `", $columns) . "`";

			// Chỉ lấy giá trị của các key là string
			$values = array_map(function ($key) use ($row) {
				$value = $row[$key];
				return isset($value) ? "'" . addslashes($value) . "'" : "NULL";
			}, $columns);

			$valuesList = implode(", ", $values);

			$insertSQL = "INSERT INTO `$newTableName` ($columnsList) VALUES ($valuesList)";
			if (!db_query($insertSQL)) {
				return [
					'success' => false,
					'message' => "Lỗi khi sao chép dữ liệu sang bảng $newTableName: "
				];
			}

			$copiedRows++;
		}

		// 4. Xoá dữ liệu đã sao chép khỏi bảng gốc
		$deleteSQL = "DELETE FROM pm_nc0009 WHERE lv014 != 'DANG_GUI'";
		if (!db_query($deleteSQL)) {
			return [
				'success' => false,
				'message' => "Không thể xoá dữ liệu đã sao chép khỏi bảng pm_nc0009."
			];
		}

		return [
			'success' => true,
			'message' => "Đã tạo bảng $newTableName và sao lưu thành công $copiedRows dòng dữ liệu."
		];
	}
	
	function KB_TimPhienTheoBienSo($bienSo){
		$sql = "select * from pm_nc0009 where lv003 = '$bienSo' and lv014 ='DANG_GUI'";
		$vresult = db_query($sql);
		return $vresult;
	}
}