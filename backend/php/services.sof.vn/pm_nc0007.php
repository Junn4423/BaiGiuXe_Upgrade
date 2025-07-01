<?php
class pm_nc0007 extends lv_controler{
    public $lv001; // maCong
    public $lv002; // tenCong
    public $lv003; // loaiCong (VAO/RA)
    public $lv004; // viTriLapDat
    public $lv005; // maKhu

    function LoadAll() {
        $sql = "SELECT * FROM pm_nc0007 ORDER BY lv001";
        return db_query($sql);
    }

    function GetById($maCong) {
        if (!$maCong) return null;
        $sql = "SELECT * FROM pm_nc0007 WHERE lv001 = '".addslashes($maCong)."' LIMIT 1";
        return db_fetch_array(db_query($sql));
    }

    function KB_Insert() {
        if (!$this->lv001 || !$this->lv002 || !$this->lv003) {
            return ['success' => false, 'message' => 'Thiếu mã, tên hoặc loại cổng'];
        }

        if (!in_array($this->lv003, ['VAO', 'RA'])) {
            return ['success' => false, 'message' => "Loại cổng phải là 'VAO' hoặc 'RA'"];
        }

        $check = db_fetch_array(db_query("SELECT COUNT(*) c FROM pm_nc0007 WHERE lv001 = '".addslashes($this->lv001)."'"));
        if ($check && $check['c'] > 0) {
            return ['success' => false, 'message' => 'Mã cổng đã tồn tại'];
        }

        $sql = "INSERT INTO pm_nc0007 (lv001, lv002, lv003, lv004, lv005)
                VALUES (
                    '".addslashes($this->lv001)."',
                    '".addslashes($this->lv002)."',
                    '".addslashes($this->lv003)."',
                    ".($this->lv004 !== null ? "'".addslashes($this->lv004)."'" : "NULL").",
                    ".($this->lv005 !== null ? "'".addslashes($this->lv005)."'" : "NULL")."
                )";

        if (db_query($sql)) {
            return ['success' => true, 'message' => 'Thêm cổng thành công'];
        }

        return ['success' => false, 'message' => 'Lỗi khi thêm cổng'];
    }

    function KB_Update() {
        if (!$this->lv001 || !$this->lv002 || !$this->lv003) {
            return false;
        }

        if (!in_array($this->lv003, ['VAO', 'RA'])) return false;

        if (!$this->GetById($this->lv001)) return false;

        $sql = "UPDATE pm_nc0007 SET
                    lv002 = '".addslashes($this->lv002)."',
                    lv003 = '".addslashes($this->lv003)."',
                    lv004 = ".($this->lv004 !== null ? "'".addslashes($this->lv004)."'" : "NULL").",
                    lv005 = ".($this->lv005 !== null ? "'".addslashes($this->lv005)."'" : "NULL")."
                WHERE lv001 = '".addslashes($this->lv001)."'";

        return db_query($sql);
    }

    function KB_Delete($maCong) {
        if (!$maCong) return ['success' => false, 'message' => 'Thiếu mã cổng'];

        $exists = $this->GetById($maCong);
        if (!$exists) return ['success' => false, 'message' => 'Không tìm thấy cổng'];

        // Kiểm tra liên kết trong bảng phiên gửi xe
        $checkIn = db_fetch_array(db_query("SELECT COUNT(*) c FROM pm_nc0009 WHERE lv006 = '".addslashes($maCong)."'"));
        $checkOut = db_fetch_array(db_query("SELECT COUNT(*) c FROM pm_nc0009 WHERE lv007 = '".addslashes($maCong)."'"));

        if (($checkIn && $checkIn['c'] > 0) || ($checkOut && $checkOut['c'] > 0)) {
            return ['success' => false, 'message' => 'Không thể xóa vì cổng đang được sử dụng trong phiên gửi xe'];
        }

        $ok = db_query("DELETE FROM pm_nc0007 WHERE lv001 = '".addslashes($maCong)."'");
        return $ok
            ? ['success' => true, 'message' => 'Xóa cổng thành công']
            : ['success' => false, 'message' => 'Lỗi khi xóa cổng'];
    }
}
?>
