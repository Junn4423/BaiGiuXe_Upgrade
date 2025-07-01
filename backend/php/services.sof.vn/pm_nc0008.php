<?php
/**
 * API endpoints for Barrier Gates (pm_nc0007)
 */

// Get all gates
class pm_nc0008 extends lv_controler{
	public $lv001;
    public $lv002; 
    public $lv003; 
	public $lv004;
	public $lv005;
	public $lv006;
	public $lv007;
	public $lv008;
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
	function KB_LayChinhSachTuMaLoaiPT($maLoaiPT)
	{
		$sql="select * from pm_nc0008 where lv002 ='$maLoaiPT'";
		$result = db_query($sql);
		return $result;
	}

    function getAllPolicies() {
        $sql = "SELECT * FROM pm_nc0008";
        $result = db_query($sql);
        $policies = [];
        while ($row = db_fetch_array($result)) {
            $policies[] = [
                'lv001' => $row['lv001'],
                'lv002' => $row['lv002'],
                'lv003' => $row['lv003'],
                'lv004' => $row['lv004'],
                'lv005' => $row['lv005'],
                'lv006' => $row['lv006']
            ];
        }
        $vOutput = ['success' => true, 'data' => $policies];
        return $vOutput;
    }
	// Ngoài nhận các giá trị lv001 ... còn có thể nhận các giá trị maChinhSach, maLoai.....
    function createPolicy($policyData) {
        // Lấy dữ liệu từ mảng $policyData, ưu tiên lvxxx, nếu không có thì dùng tên thay thế
		$lv001 = $policyData['lv001'] ?? $policyData['maChinhSach'] ?? null;
		$lv002 = $policyData['lv002'] ?? $policyData['maLoaiPT'] ?? null;
		$lv003 = $policyData['lv003'] ?? $policyData['thoiGian'] ?? null;
		$lv004 = $policyData['lv004'] ?? $policyData['donGia'] ?? null;
		$lv005 = $policyData['lv005'] ?? $policyData['quaGio'] ?? null;
		$lv006 = $policyData['lv006'] ?? $policyData['donGiaQuaGio'] ?? null;
		$lv007 = $policyData['lv007'] ?? $policyData['loaiChinhSach'] ?? null;
		$lv008 = $policyData['lv008'] ?? $policyData['tongNgay'] ?? null;

		// Kiểm tra nếu thiếu dữ liệu bắt buộc
		if (!$lv001 || !$lv002  || !$lv004) {
			return ['success' => false, 'message' => 'Thiếu thông tin bắt buộc'];
		}

		// Kiểm tra mã chính sách đã tồn tại chưa
		$checkSql = "SELECT COUNT(*) as count FROM pm_nc0008 WHERE lv001 = '" . addslashes($lv001) . "'";
		$checkResult = db_query($checkSql);
		$checkRow = db_fetch_array($checkResult);

		if ($checkRow['count'] > 0) {
			return ['success' => false, 'message' => 'Mã chính sách đã tồn tại'];
		}

		// Xử lý giá trị NULL cho các trường tuỳ chọn
		$lv005 = $lv005 !== null ? "'".addslashes($lv005)."'" : "NULL";
		$lv006 = $lv006 !== null ? (float)$lv006 : "NULL";

		// Thêm vào bảng
		$sql = "INSERT INTO pm_nc0008 (lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008) 
				VALUES (
					'".addslashes($lv001)."',
					'".addslashes($lv002)."',
					'".addslashes($lv003)."',
					'".addslashes($lv004)."',
					$lv005,
					$lv006,
					'".addslashes($lv007)."',
					'".addslashes($lv008)."'
				)";

		if (db_query($sql)) {
			return ['success' => true, 'message' => 'Thêm chính sách thành công'];
		} else {
			return ['success' => false, 'message' => 'Lỗi khi thêm chính sách'];
		}
    }
	function KB_LayAllChinhSach() {
        $sql = "SELECT * FROM pm_nc0008";
        $result = db_query($sql);
        return $result;
    }
    function updatePolicy($policyId, $policyData) {
		$lv002 = $policyData['lv002'] ?? $policyData['maLoaiPT'] ?? null;
		$lv003 = $policyData['lv003'] ?? $policyData['thoiGian'] ?? null;
		$lv004 = $policyData['lv004'] ?? $policyData['donGia'] ?? null;
		$lv005 = $policyData['lv005'] ?? $policyData['quaGio'] ?? null;
		$lv006 = $policyData['lv006'] ?? $policyData['donGiaQuaGio'] ?? null;
		$lv007 = $policyData['lv007'] ?? $policyData['loaiChinhSach'] ?? null;
		$lv008 = $policyData['lv008'] ?? $policyData['tongNgay'] ?? null;

		$sql = "UPDATE pm_nc0008 
				SET lv002 = '".addslashes($lv002)."',
					lv003 = '".addslashes($lv003)."',
					lv004 = '".addslashes($lv004)."',
					lv005 = '".addslashes($lv005)."',
					lv006 = '".addslashes($lv006)."',
					lv007 = '".addslashes($lv007)."',
					lv008 = '".addslashes($lv008)."'
				WHERE lv001 = '".addslashes($policyId)."'";
        
        if (db_query($sql)) {
            return ['success' => true, 'message' => 'Cập nhật chính sách thành công'];
        } else {
            return ['success' => false, 'message' => 'Lỗi khi cập nhật chính sách'];
        }
    }

    function deletePolicy($policyId) {
        // Check if policy is being used
        $checkSql = "SELECT COUNT(*) as count FROM pm_nc0009 WHERE lv005 = '$policyId'";
        $checkResult = db_query($checkSql);
        $checkRow = db_fetch_array($checkResult);
        
        if ($checkRow['count'] > 0) {
            return ['success' => false, 'message' => 'Không thể xóa chính sách đang được sử dụng'];
        }

        $sql = "DELETE FROM pm_nc0008 WHERE lv001 = '$policyId'";
        
        if (db_query($sql)) {
            return ['success' => true, 'message' => 'Xóa chính sách thành công'];
        } else {
            return ['success' => false, 'message' => 'Lỗi khi xóa chính sách'];
        }
    }
}