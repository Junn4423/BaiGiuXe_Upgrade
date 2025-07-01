<?php
// Khu vực đỗ xe
class pm_nc0004 extends lv_controler{
    public $lv001; // Mã khu vực (PK)
    public $lv002; // Tên khu vực
    public $lv003; // Mô tả

    // Lấy tất cả khu vực
    function LoadAll() {
        $sql = "SELECT * FROM pm_nc0004 ORDER BY lv001";
        return db_query($sql);
    }

    // Lấy thông tin một khu vực theo mã
    function GetById($zoneId) {
        if (!$zoneId) return null;
        $sql = "SELECT * FROM pm_nc0004 WHERE lv001 = '".addslashes($zoneId)."' LIMIT 1";
        $result = db_query($sql);
        return db_fetch_array($result);
    }

    // Thêm mới khu vực
	function KB_Insert() {
		$lv001 = addslashes($this->lv001);
		$sql_check = "SELECT COUNT(*) as c FROM pm_nc0004 WHERE lv001 = '$lv001'";
		$result = db_query($sql_check);
		$check = db_fetch_array($result);


		if ($check !== false && isset($check['c']) && $check['c'] > 0) {
			return [
				'success' => false,
				'message' => "TRUNG MA KHU"
			];
		}

		$sql = "INSERT INTO pm_nc0004 (lv001, lv002, lv003) 
				VALUES (
					'$lv001',
					'".addslashes($this->lv002)."',
					".(($this->lv003 !== null) ? "'".addslashes($this->lv003)."'" : "NULL")."
				)";

		if (db_query($sql)) {
			return [
				'success' => true,
				'message' => 'Thêm khu vực thành công'
			];
		}

		return [
			'success' => false,
			'message' => 'Lỗi khi thêm khu vực'
		];
	}

    // Cập nhật khu vực
    function KB_Update($data) {
        // Lấy và validate dữ liệu đầu vào
        $maKhuVuc = $data['maKhuVuc'] ?? null;
        $tenKhuVuc = $data['tenKhuVuc'] ?? null;
        $moTa = $data['moTa'] ?? null;

        // Kiểm tra dữ liệu bắt buộc
        if (!$maKhuVuc || !$tenKhuVuc) {
            return [
                'success' => false,
                'message' => 'Thiếu thông tin bắt buộc (mã hoặc tên khu vực)'
            ];
        }

        // Kiểm tra tồn tại
        if (!$this->GetById($maKhuVuc)) {
            return [
                'success' => false,
                'message' => 'Không tìm thấy khu vực cần cập nhật'
            ];
        }

        // Chuẩn bị câu SQL
        $sql = "UPDATE pm_nc0004 
                SET lv002 = '".addslashes($tenKhuVuc)."',
                    lv003 = ".(($moTa !== null) ? "'".addslashes($moTa)."'" : "NULL")."
                WHERE lv001 = '".addslashes($maKhuVuc)."'";

        // Thực thi và trả về kết quả
        if (db_query($sql)) {
            return [
                'success' => true,
                'message' => 'Cập nhật khu vực thành công'
            ];
        }
        return [
            'success' => false,
            'message' => 'Lỗi khi cập nhật khu vực'
        ];
    }

    // Xóa khu vực
    function KB_Delete($maKhuVuc) {
        if (!$maKhuVuc) {
            return [
                'success' => false,
                'message' => 'Thiếu mã khu vực'
            ];
        }

        // Kiểm tra tồn tại
        if (!$this->GetById($maKhuVuc)) {
            return [
                'success' => false,
                'message' => 'Không tìm thấy khu vực cần xóa'
            ];
        }

        // Kiểm tra ràng buộc với chỗ đỗ xe
        $checkSql = "SELECT COUNT(*) as count FROM pm_nc0005 WHERE lv002 = '".addslashes($maKhuVuc)."'";
        $checkResult = db_query($checkSql);
        $checkRow = db_fetch_array($checkResult);
        
        if ($checkRow['count'] > 0) {
            return [
                'success' => false,
                'message' => 'Không thể xóa khu vực đang có chỗ đỗ xe'
            ];
        }

        // Thực hiện xóa
        $sql = "DELETE FROM pm_nc0004 WHERE lv001 = '".addslashes($maKhuVuc)."'";
        if (db_query($sql)) {
            return [
                'success' => true,
                'message' => 'Xóa khu vực thành công'
            ];
        }
        return [
            'success' => false,
            'message' => 'Lỗi khi xóa khu vực'
        ];
    }

    // Lấy danh sách camera theo khu vực
    function LayDanhSachCameraThuocKhu($zoneId) {
        $sql = "SELECT * FROM pm_nc0006 WHERE lv005 = '".addslashes($zoneId)."'";
        return db_query($sql);
    }

    // Lấy danh sách cổng theo khu vực 
    function LayDanhSachCongThuocKhu($zoneId) {
        $sql = "SELECT * FROM pm_nc0007 WHERE lv005 = '".addslashes($zoneId)."'";
        return db_query($sql);
    }

    // Lấy danh sách chỗ đỗ theo khu vực
    function GetSpotsByZone($zoneId) {
        $sql = "SELECT s.*, z.lv002 as zone_name
                FROM pm_nc0005 s
                JOIN pm_nc0004 z ON s.lv002 = z.lv001
                WHERE s.lv002 = '".addslashes($zoneId)."'";
        return db_query($sql);
    }
}
?>