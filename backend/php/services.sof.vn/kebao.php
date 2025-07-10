<?php
//ini_set('display_errors', 1); 
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
switch ($vtable) {
    // --- Loại Phương Tiện ---
    case "pm_nc0001":
        include("pm_nc0001.php");
        $pm_nc0001 = new pm_nc0001($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case "data":
                $objEmp = $pm_nc0001->LoadAll();
                $vOutput = [];
                while ($vrow = db_fetch_array($objEmp)) {
                    $vOutput[] = [
                        'maLoaiPT' => $vrow['lv001'],
                        'tenLoaiPT' => $vrow['lv002'],
                        'moTa' => $vrow['lv003'],
						'loaiXe' => $vrow['lv004'],
                    ];
                }
                break;
            case "add":
                $pm_nc0001->lv001 = $input['maLoaiPT'] ?? $_POST['lv001'] ?? null;
                $pm_nc0001->lv002 = $input['tenLoaiPT'] ?? $_POST['lv002'] ?? null;
                $pm_nc0001->lv003 = $input['moTa'] ?? $_POST['lv003'] ?? null;
                $pm_nc0001->lv004 = $input['loaiXe'] ?? $_POST['lv004'] ?? null;
				
                $result = $pm_nc0001->KB_Insert();
                $vOutput = $result ? ['success'=>true,'message'=>'Thêm mới thành công'] : ['success'=>false,'message'=>'Lỗi khi thêm mới'];
                break;
            case "delete":
                $delArr = $input['maLoaiPT'] ?? $_POST['lv001'] ?? null;
                if ($delArr) {
                    $arr = is_array($delArr) ? array_map(function($item){return "'".addslashes($item)."'";}, $delArr) : ["'".addslashes($delArr)."'"];
                    $lvarr = implode(',', $arr);
                    $result = $pm_nc0001->KB_Delete($lvarr);
                    $vOutput = $result ? ['success'=>true,'message'=>'Xóa thành công'] : ['success'=>false,'message'=>'Lỗi khi xóa'];
                } else {
                    $vOutput = ['success'=>false,'message'=>'Không có mã để xóa'];
                }
                break;
            case "edit":
                $pm_nc0001->lv001 = $input['maLoaiPT'] ?? $_POST['lv001'] ?? null;
                $pm_nc0001->lv002 = $input['tenLoaiPT'] ?? $_POST['lv002'] ?? null;
                $pm_nc0001->lv003 = $input['moTa'] ?? $_POST['lv003'] ?? null;
				$pm_nc0001->lv004 = $input['loaiXe'] ?? $_POST['lv004'] ?? null;
                $result = $pm_nc0001->KB_Update();
                $vOutput = $result ? ['success'=>true,'message'=>'Cập nhật thành công'] : ['success'=>false,'message'=>'Lỗi khi cập nhật'];
                break;
        }
        break;

    // --- Phương Tiện ---
    case "pm_nc0002":
        include("pm_nc0002.php");
        $pm_nc0002 = new pm_nc0002($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case "data":
                $objEmp = $pm_nc0002->LoadAll();
                $vOutput = [];
                while ($vrow = db_fetch_array($objEmp)) {
                    $vOutput[] = [
                        'bienSo' => $vrow['lv001'],
                        'maLoaiPT' => $vrow['lv002']
                    ];
                }
                break;
            case "add":
                $pm_nc0002->lv001 = $input['bienSo'] ?? $_POST['lv001'] ?? null;
                $pm_nc0002->lv002 = $input['maLoaiPT'] ?? $_POST['lv002'] ?? null;
                $result = $pm_nc0002->KB_Insert();
                $vOutput = $result ? ['success'=>true,'message'=>'Thêm mới thành công'] : ['success'=>false,'message'=>'Lỗi khi thêm mới'];
                break;
            case "delete":
                $delArr = $input['bienSo'] ?? $_POST['lv001'] ?? null;
                if ($delArr) {
                    $arr = is_array($delArr) ? array_map(function($item){return "'".addslashes($item)."'";}, $delArr) : ["'".addslashes($delArr)."'"];
                    $lvarr = implode(',', $arr);
                    $result = $pm_nc0002->KB_Delete($lvarr);
                    $vOutput = $result ? ['success'=>true,'message'=>'Xóa thành công'] : ['success'=>false,'message'=>'Lỗi khi xóa'];
                } else {
                    $vOutput = ['success'=>false,'message'=>'Không có mã để xóa'];
                }
                break;
            case "edit":
                $pm_nc0002->lv001 = $input['bienSo'] ?? $_POST['lv001'] ?? null;
                $pm_nc0002->lv002 = $input['maLoaiPT'] ?? $_POST['lv002'] ?? null;
                $result = $pm_nc0002->KB_Update();
                $vOutput = $result ? ['success'=>true,'message'=>'Cập nhật thành công'] : ['success'=>false,'message'=>'Lỗi khi cập nhật'];
                break;
        }
        break;

    // --- Thẻ RFID ---
    case "pm_nc0003":
        include("pm_nc0003.php");
        $pm_nc0003 = new pm_nc0003($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case "data":
                $objEmp = $pm_nc0003->LoadAll();
                $vOutput = [];
                while ($vrow = db_fetch_array($objEmp)) {
                    $vOutput[] = [
                        'uidThe' => $vrow['lv001'],
                        'loaiThe' => $vrow['lv002'],
                        'trangThai' => $vrow['lv003'],
                        'ngayPhatHanh' => $vrow['lv004'],
						'bienSoXe' => $vrow['lv005'],
						'maChinhSach' => $vrow['lv006'],
						'ngayKetThucCS' => $vrow['lv007'],
                    ];
                }
                break;
            case "add":
                $pm_nc0003->lv001 = $input['uidThe'] ?? $_POST['lv001'] ?? null;
                $pm_nc0003->lv002 = $input['loaiThe'] ?? $_POST['lv002'] ?? null;
                $pm_nc0003->lv003 = $input['trangThai'] ?? $_POST['lv003'] ?? null;
                $pm_nc0003->lv004 = date('Y-m-d');
				$pm_nc0003->lv005 = $input['bienSoXe'] ?? $_POST['lv005']??null;
				$pm_nc0003->lv006 = $input['maChinhSach'] ?? $_POST['lv006']??null;
				$pm_nc0003->lv007 = $input['ngayKetThucCS'] ?? $_POST['lv007']??null;
                $result = $pm_nc0003->KB_Insert();
                $vOutput = $result ? ['success'=>true,'message'=>'Thêm mới thành công'] : ['success'=>false,'message'=>'Lỗi khi thêm mới'];
                break;
            case "delete":
                $delArr = $input['uidThe'] ?? $_POST['lv001'] ?? null;
                if ($delArr) {
                    $arr = is_array($delArr) ? array_map(function($item){return "'".addslashes($item)."'";}, $delArr) : ["'".addslashes($delArr)."'"];
                    $lvarr = implode(',', $arr);
                    $result = $pm_nc0003->KB_Delete($lvarr);
                    $vOutput = $result ? ['success'=>true,'message'=>'Xóa thành công'] : ['success'=>false,'message'=>'Lỗi khi xóa'];
                } else {
                    $vOutput = ['success'=>false,'message'=>'Không có UID thẻ để xóa'];
                }
                break;
            case "edit":
                $pm_nc0003->lv001 = $input['uidThe'] ?? $_POST['lv001'] ?? null;
                $pm_nc0003->lv002 = $input['loaiThe'] ?? $_POST['lv002'] ?? null;
                $pm_nc0003->lv003 = $input['trangThai'] ?? $_POST['lv003'] ?? null;
                $pm_nc0003->lv004 = $input['ngayPhatHanh'] ?? $_POST['lv004'] ?? date('Y-m-d');
                $pm_nc0003->lv005 = $input['bienSoXe'] ?? $_POST['lv005'] ?? null;
                $pm_nc0003->lv006 = $input['maChinhSach'] ?? $_POST['lv006'] ?? null;
                $pm_nc0003->lv007 = $input['ngayKetThucCS'] ?? $_POST['lv007'] ?? null;
                $result = $pm_nc0003->KB_Update();
                $vOutput = $result ? ['success'=>true,'message'=>'Cập nhật thành công'] : ['success'=>false,'message'=>'Lỗi khi cập nhật'];
                break;
			case "timTheDangCoPhien":
				$pm_nc0003->lv001 = $input['uidThe'] ?? $_POST['lv001'] ?? null;
				$objEmp = $pm_nc0003->KB_TimTheCoPhien($pm_nc0003->lv001);
				$vOutput = [];
				while ($vrow = db_fetch_array($objEmp)){
					$vOutput[]=[
                        'uidThe' => $vrow['lv001'],
                        'loaiThe' => $vrow['lv002'],
                        'trangThai' => $vrow['lv003'],
                        'ngayPhatHanh' => $vrow['lv004'],
						'bienSo' => $vrow['bienSo'],
                        'trangThaiXe' => $vrow['trangThaiXe']
					];
				}
				break;
			case "timTheTuUID":
				$pm_nc0003->lv001 = $input['uidThe'] ?? $_POST['lv001'] ?? null;
				$objEmp = $pm_nc0003->KB_TimTheTuUID($pm_nc0003->lv001);
				$vOutput = [];
				while ($vrow = db_fetch_array($objEmp)){
					 $vOutput[] = [
                        'uidThe' => $vrow['lv001'],
                        'loaiThe' => $vrow['lv002'],
                        'trangThai' => $vrow['lv003'],
                        'ngayPhatHanh' => $vrow['lv004'],
						'bienSoXe' => $vrow['lv005'],
						'maChinhSach' => $vrow['lv006'],
						'ngayKetThucCS' => $vrow['lv007'],
                    ];
				}
				break;

        }
        break;

    // --- Khu vực đỗ xe ---
    case "pm_nc0004_1":
        include("pm_nc0004.php");
        $pm_nc0004 = new pm_nc0004($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case "data":
                $objEmp = $pm_nc0004->LoadAll();
                $vOutput = [];
                while ($vrow = db_fetch_array($objEmp)) {
                    $vOutput[] = [
                        'maKhuVuc' => $vrow['lv001'],
                        'tenKhuVuc' => $vrow['lv002'],
                        'moTa' => $vrow['lv003']
                    ];
                }
                break;
            case "khu_vuc_camera_cong":
                $objEmp = $pm_nc0004->LoadAll();
                $vOutput = [];

                while ($vrow = db_fetch_array($objEmp)) {
                    $maKhuVuc = $vrow['lv001'];
                    // Lấy danh sách cổng thuộc khu vực này
                    $congArr = [];
                    $congResult = $pm_nc0004->LayDanhSachCongThuocKhu($maKhuVuc);
                    while ($cong = db_fetch_array($congResult)) {
                        // Phân loại cổng vào/ra
                        if (strtolower($cong['lv003']) == 'vao') {
                            $congArr['congVao'][] = [
                                'maCong' => $cong['lv001'],
                                'tenCong' => $cong['lv002'],
                                'loaiCong' => $cong['lv003'],
								'viTriLapDat' => $cong['lv004']
                            ];
                        } elseif (strtolower($cong['lv003']) == 'ra') {
                            $congArr['congRa'][] = [
                                'maCong' => $cong['lv001'],
                                'tenCong' => $cong['lv002'],
                                'loaiCong' => $cong['lv003'], 
								'viTriLapDat' => $cong['lv004']
                            ];
                        }
                    }

                    // Lấy danh sách camera thuộc khu vực này
                    $cameraArr = [];
                    $cameraResult = $pm_nc0004->LayDanhSachCameraThuocKhu($maKhuVuc);
                    while ($cam = db_fetch_array($cameraResult)) {
                        // Phân loại camera vào/ra
                        if (strtolower($cam['lv003']) == 'vao') {
                            $cameraArr['cameraVao'][] = [
                                'maCamera' => $cam['lv001'],
                                'tenCamera' => $cam['lv002'],
                                'loaiCamera' => $cam['lv003'],
                                'chucNangCamera' => $cam['lv004'],
								'linkRTSP' => $cam['lv006'],
                            ];
                        } elseif (strtolower($cam['lv003']) == 'ra') {
                            $cameraArr['cameraRa'][] = [
                                'maCamera' => $cam['lv001'],
                                'tenCamera' => $cam['lv002'],
                                'loaiCamera' => $cam['lv003'],
                                'chucNangCamera' => $cam['lv004'],
								'linkRTSP' => $cam['lv006'],
                            ];
                        }
                    }

                    $vOutput[] = [
                        'maKhuVuc' => $vrow['lv001'],
                        'tenKhuVuc' => $vrow['lv002'],
                        'moTa' => $vrow['lv003'],
                        'congVao' => $congArr['congVao'] ?? [],
                        'congRa'  => $congArr['congRa'] ?? [],
                        'cameraVao' => $cameraArr['cameraVao'] ?? [],
                        'cameraRa'  => $cameraArr['cameraRa'] ?? []
                    ];
                }
                break;
        }
        break;

    // --- Chỗ đỗ xe ---
    case "pm_nc0005":
        include("pm_nc0005.php");
        $pm_nc0005 = new pm_nc0005($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case "data":
                $objEmp = $pm_nc0005->LoadAll();
                $vOutput = [];
                while ($vrow = db_fetch_array($objEmp)) {
                    $vOutput[] = [
                        'maChoDo' => $vrow['lv001'],
                        'maKhuVuc' => $vrow['lv002'],
                        'trangThai' => $vrow['lv003'],
                        'tenKhuVuc' => $vrow['zone_name'] ?? ''
                    ];
                }
                break;
			case "loadChoDauXeTheoKhu":
				$pm_nc0005->lv002 = $input['maKhuVuc'] ?? $_POST['lv002'] ?? null;
				$objEmp = $pm_nc0005->LoadID($pm_nc0005->lv002);
				$vOutput = [];
				while ($vrow = db_fetch_array($objEmp)) {
                    $vOutput[] = [
                        'maChoDo' => $vrow['lv001'],
                        'maKhuVuc' => $vrow['lv002'],
                        'trangThai' => $vrow['lv003'],
                        'tenKhuVuc' => $vrow['zone_name'] ?? ''
                    ];
                }
				break;
            case "add":
                $pm_nc0005->lv001 = $input['maChoDo'] ?? $_POST['lv001'] ?? null;
                $pm_nc0005->lv002 = $input['maKhuVuc'] ?? $_POST['lv002'] ?? null;
                $pm_nc0005->lv003 = $input['trangThai'] ?? $_POST['lv003'] ?? 'TRONG';
                $result = $pm_nc0005->KB_Insert();
                $vOutput = $result ? ['success'=>true,'message'=>'Thêm mới thành công'] : ['success'=>false,'message'=>'Lỗi khi thêm mới'];
                break;
            case "delete":
                $delArr = $input['maChoDo'] ?? $_POST['lv001'] ?? null;
                if ($delArr) {
                    $arr = is_array($delArr) ? array_map(function($item){return "'".addslashes($item)."'";}, $delArr) : ["'".addslashes($delArr)."'"];
                    $success = true;
                    foreach ($arr as $spotId) {
                        $spotId = trim($spotId, "'");
                        $result = $pm_nc0005->KB_Delete($spotId);
                        if (!$result) $success = false;
                    }
                    $vOutput = $success ? ['success'=>true,'message'=>'Xóa thành công'] : ['success'=>false,'message'=>'Lỗi khi xóa (có thể đang có xe gửi tại chỗ đỗ này)'];
                } else {
                    $vOutput = ['success'=>false,'message'=>'Không có mã lv001 để xóa'];
                }
                break;
            case "edit":
                $pm_nc0005->lv001 = $input['maChoDo'] ?? $_POST['lv001'] ?? null;
                $pm_nc0005->lv002 = $input['maKhuVuc'] ?? $_POST['lv002'] ?? null;
                $pm_nc0005->lv003 = $input['trangThai'] ?? $_POST['lv003'] ?? null;
                $result = $pm_nc0005->KB_Update();
                $vOutput = $result ? ['success'=>true,'message'=>'Cập nhật thành công'] : ['success'=>false,'message'=>'Lỗi khi cập nhật'];
                break;
				
			case "chinhSuaTrangThai":
				$pm_nc0005->lv001 = $input['maChoDo'] ?? $_POST['lv001'] ?? null;
				$pm_nc0005->lv003 = $input['trangThai'] ?? $_POST['lv003'] ?? null;
				$result = $pm_nc0005->KB_ChinhSuaTrangThai($pm_nc0005->lv001,$pm_nc0005->lv003);
				$vOutput = $result ? ['success'=>true,'message'=>'Cập nhật thành công'] : ['success'=>false,'message'=>'Lỗi khi cập nhật'];
				break;
				//chung thêm sync_data
			case "sync_data":
				$result = $pm_nc0005->sync_data();
				$vOutput = $result;
				break;
        }
        break;    
         case "pm_nc0009":
            include("pm_nc0009.php");
            include("pm_nc0010.php");
            include("pm_nc0003.php");
            $pm_nc0009 = new pm_nc0009($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
            $pm_nc0010 = new pm_nc0010($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
            $pm_nc0003 = new pm_nc0003($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
            switch ($vfun) {
                case "add": // Quét thẻ vào
                    
                    // Lấy mã thẻ
                    $uidThe = $input['uidThe'] ?? $_POST['lv002'] ?? null;
                    // Kiểm tra mã thẻ có tồn tại trong hệ thống không
                    if (!$uidThe) {
                        $vOutput = [
                            'success' => false,
                            'message' => 'Thiếu mã thẻ RFID'
                        ];
                        break;
                    }
                    $cardCheck = $pm_nc0003->CheckCardExists($uidThe);
                    if (!$cardCheck['exists']) {
                        $vOutput = [
                            'success' => false,
                            'message' => 'Thẻ RFID chưa tồn tại trong hệ thống. Vui lòng đăng ký thẻ trước khi sử dụng.'
                        ];
                        break;
                    }
                    if (!$cardCheck['active']) {
                        $vOutput = [
                            'success' => false,
                            'message' => 'Thẻ RFID chưa được kích hoạt. Vui lòng liên hệ quản trị viên.'
                        ];
                        break;
                    }
                    
                    // Gán dữ liệu phiên gửi xe
                    $pm_nc0009->lv002 = $uidThe;
                    $pm_nc0009->lv003 = $input['bienSo'] ?? $_POST['lv003'] ?? null;
                    $pm_nc0009->lv004 = $input['viTriGui'] ?? $_POST['lv004'] ?? null;
                    $pm_nc0009->lv005 = $input['chinhSach'] ?? $_POST['lv005'] ?? null;
                    $pm_nc0009->lv006 = $input['congVao'] ?? $_POST['lv006'] ?? null;
                    $pm_nc0009->lv008 = $input['gioVao'] ?? $_POST['lv008'] ?? null;
                    $pm_nc0009->lv011 = str_replace("\\", "/", $input['anhVao'] ?? $_POST['lv011'] ?? null);
                    $pm_nc0009->lv015 = str_replace("\\", "/", $input['anhMatVao'] ?? $_POST['lv015'] ?? null);

                    // Thêm mới phiên gửi xe
                    $result = $pm_nc0009->KB_Insert();

                    // Nếu thành công thì lưu nhật ký quét vào
                    if ($result['success']) {
                        $pm_nc0010->lv002 = $pm_nc0009->lv001;
                        $pm_nc0010->lv003 = $input['camera_id'] ?? null;
                        $pm_nc0010->lv004 = $pm_nc0009->lv008;
                        $pm_nc0010->lv005 = $pm_nc0009->lv011;
                        $pm_nc0010->lv006 = 1;
                        $pm_nc0010->lv007 = 'entry';
                        $pm_nc0010->KB_Insert();

                        $vOutput = [
                            'success' => true,
                            'message' => 'Quét thẻ vào thành công.',
                            'maPhien' => $pm_nc0009->lv001
                        ];
                    } else {
                        $vOutput = [
                            'success' => false,
                            'message' => $result['message'] 
                        ];
                    }
                    break;
                case "edit": // Quét thẻ ra
                    // Gán dữ liệu phiên gửi xe
                    $pm_nc0009->lv001 = $input['maPhien'] ?? $_POST['lv001'] ?? null;
                    $pm_nc0009->lv007 = $input['congRa'] ?? $_POST['lv007'] ?? null;
                    $pm_nc0009->lv009 = $input['gioRa'] ?? $_POST['lv009'] ?? null;
                    $pm_nc0009->lv012 = $input['anhRa'] ?? $_POST['lv012'] ?? null;
                    $pm_nc0009->lv016 = $input['anhMatRa'] ?? $_POST['lv016'] ?? null;
                    $plateRa = $input['plate'] ?? null; 

                    // Lấy biển số vào
                    $row = db_fetch_array(db_query("SELECT lv008, lv011,lv003 FROM pm_nc0009 WHERE lv001 = '{$pm_nc0009->lv001}'"));
                    if (!$row) {
                        $vOutput = ['success'=>false, 'message'=>'Không tìm thấy phiên gửi xe'];
                        break;
                    }
                    $bienSoVao = trim($row['lv003']);
                    $gioVao = strtotime($row['lv008']);
                    // Nếu có biển số ra, so sánh với biển số vào
                    if ($plateRa && strtolower($plateRa) !== strtolower($bienSoVao)) {
                        $vOutput = [
                            'success' => false,
                            'message' => 'Lỗi khác biển số, vui lòng kiểm tra lại'
                        ];
                        break;
                    }
                    // Phần tính thời gian gửi và cập nhật giữ nguyên
                    $result = $pm_nc0009->KB_Update();

                    // Nếu thành công thì lưu nhật ký quét ra
                    if ($result) {
                        $pm_nc0010->lv002 = $pm_nc0009->lv001;
                        $pm_nc0010->lv003 = $input['camera_id'] ?? null;
                        $pm_nc0010->lv004 = $pm_nc0009->lv009;
                        $pm_nc0010->lv005 = $pm_nc0009->lv012;
                        $pm_nc0010->lv006 = $input['plate_match'] ?? 0;
                        $pm_nc0010->lv007 = 'exit';
                        $pm_nc0010->KB_Insert();
                    }

                    $vOutput = $result ?
                        ['success'=>true,'message'=>'Quét thẻ ra thành công'] :
                        ['success'=>false,'message'=>'Lỗi khi quét thẻ ra'];
                    break;   
				case "edit_TrangThai": // Quét thẻ ra
                    // Gán dữ liệu phiên gửi xe
                    $pm_nc0009->lv001 = $input['maPhien'] ?? $_POST['lv001'] ?? null;
                    $result = $pm_nc0009->KB_UpdateTrangThai_DangGui();

                    $vOutput = $result ?
                        ['success'=>true,'message'=>'ĐỔI TRẠNG THÁI THÀNH ĐANG GỬI THÀNH CÔNG'] :
                        ['success'=>false,'message'=>'Lỗi khi đổi trạng thái'];
                    break;   
                case "data":
                    $objEmp = $pm_nc0009->LoadAll();
                    $vOutput = [];
                    while ($vrow = db_fetch_array($objEmp)) {
                        $vOutput[] = [
                            'maPhien'      => $vrow['lv001'] ?? null,
                            'uidThe'       => $vrow['lv002'] ?? null,
                            'bienSo'       => $vrow['lv003'] ?? null,
                            'viTriGui'     => $vrow['lv004'] ?? null,
                            'chinhSach'    => $vrow['lv005'] ?? null,
                            'congVao'      => $vrow['lv006'] ?? null,
                            'congRa'       => $vrow['lv007'] ?? null,
                            'gioVao'       => $vrow['lv008'] ?? null,
                            'gioRa'        => $vrow['lv009'] ?? null,
                            'phutGui'      => isset($vrow['lv010']) ? (float)$vrow['lv010'] : null,
                            'anhVao'       => $vrow['lv011'] ?? null,
                            'anhRa'        => $vrow['lv012'] ?? null,
                            'phi'          => isset($vrow['lv013']) ? (float)$vrow['lv013'] : null,
                            'trangThai'    => $vrow['lv014'] ?? null,
                            'camera_id'    => $vrow['camera_id'] ?? null,
                            'plate_match'  => isset($vrow['plate_match']) ? (int)$vrow['plate_match'] : null,
                        ];
                    }
                    break;
                case "layPhienGuiXeTuUID":
                    $uidThe = $input['uidThe'] ?? $_POST['lv002'] ?? null;
                    if ($uidThe) {
                        $objEmp = $pm_nc0009->KB_LoadPhienTheoUID($uidThe);
                        $vOutput = [];
                        while ($vrow = db_fetch_array($objEmp)) {
                            $vOutput[] = [
                                'maPhien'      => $vrow['lv001'] ?? null,
                                'uidThe'       => $vrow['lv002'] ?? null,
                                'bienSo'       => $vrow['lv003'] ?? null,
                                'viTriGui'     => $vrow['lv004'] ?? null,
                                'chinhSach'    => $vrow['lv005'] ?? null,
                                'congVao'      => $vrow['lv006'] ?? null,
                                'congRa'       => $vrow['lv007'] ?? null,
                                'gioVao'       => $vrow['lv008'] ?? null,
                                'gioRa'        => $vrow['lv009'] ?? null,
                                'phutGui'      => isset($vrow['lv010']) ? (float)$vrow['lv010'] : null,
                                'anhVao'       => $vrow['lv011'] ?? null,
                                'anhRa'        => $vrow['lv012'] ?? null,
                                'phi'          => isset($vrow['lv013']) ? (float)$vrow['lv013'] : null,
                                'trangThai'    => $vrow['lv014'] ?? null,
                                'anhMatVao'   => $vrow['lv015'] ?? null,
                                'anhMatRa'    => $vrow['lv016'] ?? null
                            ];
                        }
                    } else {
                        $vOutput = ['success'=>false,'message'=>'Không có UID thẻ để tìm kiếm'];
                    }
                break;
                    case "layPhienGuiXeTuUID_Da_Ra":
                    $uidThe = $input['uidThe'] ?? $_POST['lv002'] ?? null;
                    if ($uidThe) {
                        $objEmp = $pm_nc0009->KB_LoadPhienTheoUID_2($uidThe);
                        $vOutput = [];
                        while ($vrow = db_fetch_array($objEmp)) {
                            $vOutput[] = [
                                'maPhien'      => $vrow['lv001'] ?? null,
                                'uidThe'       => $vrow['lv002'] ?? null,
                                'bienSo'       => $vrow['lv003'] ?? null,
                                'viTriGui'     => $vrow['lv004'] ?? null,
                                'chinhSach'    => $vrow['lv005'] ?? null,
                                'congVao'      => $vrow['lv006'] ?? null,
                                'congRa'       => $vrow['lv007'] ?? null,
                                'gioVao'       => $vrow['lv008'] ?? null,
                                'gioRa'        => $vrow['lv009'] ?? null,
                                'phutGui'      => isset($vrow['lv010']) ? (float)$vrow['lv010'] : null,
                                'anhVao'       => $vrow['lv011'] ?? null,
                                'anhRa'        => $vrow['lv012'] ?? null,
                                'phi'          => isset($vrow['lv013']) ? (float)$vrow['lv013'] : null,
                                'trangThai'    => $vrow['lv014'] ?? null,
                                'anhMatVao'   => $vrow['lv015'] ?? null,
                                'anhMatRa'    => $vrow['lv016'] ?? null
                            ];
                        }
                    } else {
                        $vOutput = ['success'=>false,'message'=>'Không có UID thẻ để tìm kiếm'];
                    }
                break;
					case "taoBangChoPhienLamViec":
					$result = $pm_nc0009->KB_TaoPhienLamViec();
					if ($result['success']) {
						$vOutput = [
							'success' => true,
							'message' => $result['message']
						];
					} else {
						$vOutput = [
							'success' => false,
							'message' => $result['message']
						];
					}
				break;
					case "timPhienTheoBienSo":
					$pm_nc0009->lv003 = $input['bienSo'] ?? $_POST['lv003'] ?? null;
					$objEmp = $pm_nc0009->KB_TimPhienTheoBienSo($pm_nc0009->lv003);
					$vOutput=[];
					while ($vrow = db_fetch_array($objEmp)) {
                            $vOutput[] = [
                                'maPhien'      => $vrow['lv001'] ?? null,
                                'uidThe'       => $vrow['lv002'] ?? null,
                                'bienSo'       => $vrow['lv003'] ?? null,
                                'viTriGui'     => $vrow['lv004'] ?? null,
                                'chinhSach'    => $vrow['lv005'] ?? null,
                                'congVao'      => $vrow['lv006'] ?? null,
                                'congRa'       => $vrow['lv007'] ?? null,
                                'gioVao'       => $vrow['lv008'] ?? null,
                                'gioRa'        => $vrow['lv009'] ?? null,
                                'phutGui'      => isset($vrow['lv010']) ? (float)$vrow['lv010'] : null,
                                'anhVao'       => $vrow['lv011'] ?? null,
                                'anhRa'        => $vrow['lv012'] ?? null,
                                'phi'          => isset($vrow['lv013']) ? (float)$vrow['lv013'] : null,
                                'trangThai'    => $vrow['lv014'] ?? null,
                                'anhMatVao'   => $vrow['lv015'] ?? null,
                                'anhMatRa'    => $vrow['lv016'] ?? null
                            ];
                        }
            }
        break;
		
		case "pm_nc0006_1":
			
			include("pm_nc0006.php");
			$pm_nc0006 = new pm_nc0006();

			switch ($vfun) {
				case "data":
					$objEmp = $pm_nc0006->LoadAll();
					$vOutput = [];
					while ($vrow = db_fetch_array($objEmp)) {
						$vOutput[] = [
							'maCamera'       => $vrow['lv001'],
							'tenCamera'      => $vrow['lv002'],
							'loaiCamera'     => $vrow['lv003'],
							'chucNangCamera' => $vrow['lv004'],
							'maKhuVuc'       => $vrow['lv005'],
							'linkRTSP'       => $vrow['lv006']
						];
					}
					break;

				case "add":
					$pm_nc0006->lv001 = $input['maCamera']       ?? $_POST['lv001'] ?? null;
					$pm_nc0006->lv002 = $input['tenCamera']      ?? $_POST['lv002'] ?? null;
					$pm_nc0006->lv003 = $input['loaiCamera']     ?? $_POST['lv003'] ?? null;
					$pm_nc0006->lv004 = $input['chucNangCamera'] ?? $_POST['lv004'] ?? null;
					$pm_nc0006->lv005 = $input['maKhuVuc']       ?? $_POST['lv005'] ?? null;
					$pm_nc0006->lv006 = $input['linkRTSP']       ?? $_POST['lv006'] ?? null;

					$result = $pm_nc0006->KB_Insert();
					$vOutput = $result['success']
						? ['success' => true,  'message' => $result['message']]
						: ['success' => false, 'message' => $result['message']];
					break;

				case "edit":
					$pm_nc0006->lv001 = $input['maCamera']       ?? $_POST['lv001'] ?? null;
					$pm_nc0006->lv002 = $input['tenCamera']      ?? $_POST['lv002'] ?? null;
					$pm_nc0006->lv003 = $input['loaiCamera']     ?? $_POST['lv003'] ?? null;
					$pm_nc0006->lv004 = $input['chucNangCamera'] ?? $_POST['lv004'] ?? null;
					$pm_nc0006->lv005 = $input['maKhuVuc']       ?? $_POST['lv005'] ?? null;
					$pm_nc0006->lv006 = $input['linkRTSP']       ?? $_POST['lv006'] ?? null;

					$result = $pm_nc0006->KB_Update();
					$vOutput = $result
						? ['success' => true,  'message' => 'Cập nhật thành công']
						: ['success' => false, 'message' => 'Lỗi khi cập nhật'];
					break;

				case "delete":
					$pm_nc0006->lv001 = $input['maCamera'] ?? $_POST['lv001'] ?? null;
					if ($pm_nc0006->lv001) {
						$result = $pm_nc0006->KB_Delete($pm_nc0006->lv001);
						$vOutput = $result
							? ['success' => true,  'message' => 'Xóa thành công']
							: ['success' => false, 'message' => 'Lỗi khi xóa'];
					} else {
						$vOutput = ['success' => false, 'message' => 'Không có mã camera để xóa'];
					}
					break;
				
			}

		break;
		
		case "pm_nc0007":
			include("pm_nc0007.php");
			$pm_nc0007 = new pm_nc0007();

			switch ($vfun) {
				case "data":
					$obj = $pm_nc0007->LoadAll();
					$vOutput = [];
					while ($row = db_fetch_array($obj)) {
						$vOutput[] = [
							'maCong' => $row['lv001'],
							'tenCong' => $row['lv002'],
							'loaiCong' => $row['lv003'],
							'chucNangCamera' => $row['lv004'],
							'maKhuVuc' => $row['lv005']
						];
					}
					break;

				case "add":
					$pm_nc0007->lv001 = $input['maCong'] ?? $_POST['lv001'] ?? null;
					$pm_nc0007->lv002 = $input['tenCong'] ?? $_POST['lv002'] ?? null;
					$pm_nc0007->lv003 = $input['loaiCong'] ?? $_POST['lv003'] ?? null;
					$pm_nc0007->lv004 = $input['viTriLapDat'] ?? $_POST['lv004'] ?? null;
					$pm_nc0007->lv005 = $input['maKhuVuc'] ?? $_POST['lv005'] ?? null;
					$result = $pm_nc0007->KB_Insert();
					$vOutput = $result;
					break;

				case "edit":
					$pm_nc0007->lv001 = $input['maCong'] ?? $_POST['lv001'] ?? null;
					$pm_nc0007->lv002 = $input['tenCong'] ?? $_POST['lv002'] ?? null;
					$pm_nc0007->lv003 = $input['loaiCong'] ?? $_POST['lv003'] ?? null;
					$pm_nc0007->lv004 = $input['viTriLapDat'] ?? $_POST['lv004'] ?? null;
					$pm_nc0007->lv005 = $input['maKhuVuc'] ?? $_POST['lv005'] ?? null;
					$vOutput = $pm_nc0007->KB_Update()
						? ['success' => true, 'message' => 'Cập nhật thành công']
						: ['success' => false, 'message' => 'Lỗi khi cập nhật'];
					break;

				case "delete":
					$ma = $input['maCong'] ?? $_POST['lv001'] ?? null;
					$vOutput = $pm_nc0007->KB_Delete($ma);
					break;
			}
		break;
		
		case "lv_lv0007":
			include("lv_lv0007.php");
			$lv_lv0007 = new lv_lv0007();

			switch ($vfun) {
				case "data":
					$obj = $lv_lv0007->LV_Load();
					$vOutput = [];
					while ($row = db_fetch_array($obj)) {
						$vOutput[] = [
							'taiKhoanDN' => $row['lv001'],
							'nguoiThem' => $row['lv003'],
							'roleQuyen' => $row['lv004'],
							'matKhau' => $row['lv005'],
							'ten' => $row['lv006'],
							'quyenHan' => $row['lv900'],
							'khuVucLamViec' => $row['lv901'],
						];
					}
					break;
				case "layThongTinTaiKhoanTheoToken":
					$lv_lv0007->lv097 = $input['token'] ?? $_POST['lv097'] ?? null;
					$obj = $lv_lv0007->LV_LoadID($lv_lv0007->lv097);
					$vOutput = [];
					while ($row = db_fetch_array($obj)) {
						$vOutput[] = [
							'taiKhoanDN' => $row['lv001'],
							'nguoiThem' => $row['lv003'],
							'roleQuyen' => $row['lv004'],
							'matKhau' => $row['lv005'],
							'ten' => $row['lv006'],
							'quyenHan' => $row['lv900'],
							'khuVucLamViec' => $row['lv901'],
						];
					}
					break;
				case "add":
					$lv_lv0007->lv001 = $input['taiKhoanDN'] ?? $_POST['lv001'] ?? null;
					$lv_lv0007->lv003 = $input['nguoiThem'] ?? $_POST['lv003'] ?? null;
					$lv_lv0007->lv004 = $input['roleQuyen'] ?? $_POST['lv004'] ?? null;
					$lv_lv0007->lv005 = $input['matKhau'] ?? $_POST['lv005'] ?? null;
					$lv_lv0007->lv006 = $input['ten'] ?? $_POST['lv006'] ?? null;
					$lv_lv0007->lv900 = $input['quyenHan'] ?? $_POST['lv900'] ?? null;
					$lv_lv0007->lv901 = $input['khuVucLamViec'] ?? $_POST['lv901'] ?? null;
					$vOutput = $lv_lv0007->LV_Insert()
						? ['success' => true, 'message' => 'Thêm thành công']
						: ['success' => false, 'message' => 'Lỗi khi thêm tài khoản'];
					break;

				case "edit":
					$lv_lv0007->lv001 = $input['taiKhoanDN'] ?? $_POST['lv001'] ?? null;
					$lv_lv0007->lv003 = $input['nguoiThem'] ?? $_POST['lv003'] ?? null;
					$lv_lv0007->lv004 = $input['roleQuyen'] ?? $_POST['lv004'] ?? null;
					$lv_lv0007->lv005 = $input['matKhau'] ?? $_POST['lv005'] ?? null;
					$lv_lv0007->lv006 = $input['ten'] ?? $_POST['lv006'] ?? null;
					$lv_lv0007->lv900 = $input['quyenHan'] ?? $_POST['lv900'] ?? null;
					$lv_lv0007->lv901 = $input['khuVucLamViec'] ?? $_POST['lv901'] ?? null;
					$vOutput = $lv_lv0007->LV_Update()
						? ['success' => true, 'message' => 'Cập nhật thành công']
						: ['success' => false, 'message' => 'Lỗi khi cập nhật'];
					break;

			}
		break;

}
?>