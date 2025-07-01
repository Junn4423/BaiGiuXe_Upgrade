<?php
// Phương Tiện
class pm_nc0002 extends lv_controler{
    public $lv001; // biển số (PK)
    public $lv002; // mã loại (FK)

    // Lấy tất cả phương tiện
    function LoadAll() {
        $sql = "SELECT * FROM pm_nc0002";
        return db_query($sql);
    }

    // Thêm mới
    function KB_Insert() {
        $sql = "INSERT INTO pm_nc0002 (lv001, lv002) VALUES ('$this->lv001', '$this->lv002')";
        return db_query($sql);
    }

    // Sửa
    function KB_Update() {
        $sql = "UPDATE pm_nc0002 SET lv002 = '$this->lv002' WHERE lv001 = '$this->lv001'";
        return db_query($sql);
    }

    // Xóa (xóa nhiều biển số, truyền vào: 'BS1','BS2')
    function KB_Delete($lvarr) {
        $sql = "DELETE FROM pm_nc0002 WHERE lv001 IN ($lvarr)";
        return db_query($sql);
    }
}
?>