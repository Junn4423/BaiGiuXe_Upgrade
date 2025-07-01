<?php
include_once("pm_nc0004.php");
include_once("pm_nc0005.php");
include_once("pm_nc0006.php");
include_once("pm_nc0007.php");
include_once("pm_nc0008.php");
include_once("pm_nc0009.php");
include_once("pm_nc0010.php");

// Get parameters from the request
$id = $input['id'] ?? $_POST['id'] ?? $_GET['id'] ?? null;
$data = $input['data'] ?? $_POST['data'] ?? [];

switch ($vtable) {

    // ANPR Cameras (pm_nc0006)
    case "pm_nc0006_2":
        $pm_nc0006 = new pm_nc0006();
        switch ($vfun) {
            case "updateUrl":
                if (!$id || !isset($data['rtsp_url'])) {
                    $vOutput = ['success' => false, 'message' => 'Thiếu thông tin camera hoặc URL'];
                    break;
                }
                $rtsp_url = $data['rtsp_url'];
                $updateQuery = "UPDATE pm_nc0006 SET lv006 = '$rtsp_url' WHERE lv001 = '$id'";
                $result = db_query($updateQuery);
                if ($result) {
                    $vOutput = ['success' => true, 'message' => 'Cập nhật URL thành công'];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Lỗi khi cập nhật URL'];
                }
                break;
        }
        break;
    // Barrier Gates (pm_nc0007)
    
    case "pm_nc0004_2":
    $pm_nc0004 = new pm_nc0004();
    switch ($vfun) {
        case "data":
            $result = $pm_nc0004->LoadAll();
            $vOutput = [];
            while ($row = db_fetch_array($result)) {
                $vOutput[] = [
                    'maKhuVuc' => $row['lv001'],
                    'tenKhuVuc' => $row['lv002'],
                    'moTa' => $row['lv003']
                ];
            }
            break;

        case "getById":
            $zoneId = $id ?? $input['maKhuVuc'] ?? $_POST['maKhuVuc'] ?? $_GET['maKhuVuc'] ?? null;
            if ($zoneId) {
                $result = $pm_nc0004->GetById($zoneId);
                if ($result) {
                    $vOutput = [
                        'success' => true,
                        'data' => [
                            'maKhuVuc' => $result['lv001'],
                            'tenKhuVuc' => $result['lv002'],
                            'moTa' => $result['lv003']
                        ]
                    ];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Không tìm thấy khu vực'];
                }
            } else {
                $vOutput = ['success' => false, 'message' => 'Thiếu mã khu vực'];
            }
            break;

        case "add":
                $pm_nc0004->lv001 = $input['maKhuVuc'] ?? $_POST['lv001'] ?? null;
                $pm_nc0004->lv002 = $input['tenKhuVuc'] ?? $_POST['lv002'] ?? null;
                $pm_nc0004->lv003 = $input['moTa'] ?? $_POST['lv003'] ?? null;

				if (!$pm_nc0004->lv001|| !$pm_nc0004->lv002) {
					$vOutput = ['success' => false, 'message' => 'Thiếu mã hoặc tên khu vực'];
					break;
				}
				$vOutput = $pm_nc0004->KB_Insert();
				break;

        case "edit":
            $data = [
                'maKhuVuc' => $input['maKhuVuc'] ?? $_POST['maKhuVuc'] ?? null,
                'tenKhuVuc' => $input['tenKhuVuc'] ?? $_POST['tenKhuVuc'] ?? null,
                'moTa' => $input['moTa'] ?? $_POST['moTa'] ?? null
            ];

            if (!$data['maKhuVuc'] || !$data['tenKhuVuc']) {
                $vOutput = ['success' => false, 'message' => 'Thiếu mã hoặc tên khu vực'];
                break;
            }

            $vOutput = $pm_nc0004->KB_Update($data);
            break;

        case "delete":
            $maKhuVuc = $id ?? $input['maKhuVuc'] ?? $_POST['maKhuVuc'] ?? $_GET['maKhuVuc'] ?? null;
            if (!$maKhuVuc) {
                $vOutput = ['success' => false, 'message' => 'Thiếu mã khu vực'];
                break;
            }

            $vOutput = $pm_nc0004->KB_Delete($maKhuVuc);
            break;

        default:
            $vOutput = ['success' => false, 'message' => 'Hành động không hợp lệ'];
            break;
    }
    break;

    // Pricing Policies (pm_nc0008)
    case "pm_nc0008":
		$pm_nc0008  = new pm_nc0008();
        switch ($vfun) {
            case "getAllPolicies":
                $vOutput = $pm_nc0008->getAllPolicies();
                break;
			case "data":
				$objEmp = $pm_nc0008->KB_LayAllChinhSach();
                $vOutput = [];
                while ($vrow = db_fetch_array($objEmp)) {
					$vOutput[] = [
						'maChinhSach' => $vrow['lv001'],
						'maLoaiPT' => $vrow['lv002'],
						'thoiGian' => (int)$vrow['lv003'],
						'donGia' => (float)$vrow['lv004'],
						'quaGio' => (int)$vrow['lv005'], 
						'donGiaQuaGio' => isset($vrow['lv006']) ? (float)$vrow['lv006'] : null,
						'loaiChinhSach' => $vrow['lv007'],
						'tongNgay' => (int)$vrow['lv008']
					];
				}
				break;
            case "createPolicy":
                $policyData = $input['policyData'] ?? $_POST['policyData'] ?? [];
                $vOutput = $pm_nc0008->createPolicy($policyData);
                break;
            case "updatePolicy":
                $policyId = $input['policyId'] ?? $_POST['policyId'] ?? null;
                $policyData = $input['policyData'] ?? $_POST['policyData'] ?? [];
                if (!$policyId) {
                    $vOutput = ['success' => false, 'message' => 'Thiếu mã chính sách'];
                    break;
                }
                $vOutput = $pm_nc0008->updatePolicy($policyId, $policyData);
                break;
            case "deletePolicy":
                $policyId = $input['policyId'] ?? $_POST['policyId'] ?? null;
                if (!$policyId) {
                    $vOutput = ['success' => false, 'message' => 'Thiếu mã chính sách'];
                    break;
                }
                $vOutput = $pm_nc0008->deletePolicy($policyId);
                break;
            case "tinhPhiGuiXe":
                $maPhien = $input['maPhien'] ?? $_POST['maPhien'] ?? null;
                if (!$maPhien) {
                    $vOutput = ['success'=>false, 'message'=>'Thiếu mã phiên'];
                    break;
                }

                // Lấy thông tin phiên gửi xe
                $phienQuery = "SELECT p.lv001, p.lv005, p.lv010, p.lv008, p.lv009
                             FROM pm_nc0009 p
                             WHERE p.lv001 = '$maPhien'";
                $phienResult = db_query($phienQuery);
                $phien = db_fetch_array($phienResult);

                if (!$phien) {
                    $vOutput = ['success'=>false, 'message'=>'Không tìm thấy phiên gửi xe'];
                    break;
                }

                // Lấy thông tin chính sách giá
                $csQuery = "SELECT * FROM pm_nc0008 WHERE lv001 = '{$phien['lv005']}'";
                $csResult = db_query($csQuery);
                $chinhSach = db_fetch_array($csResult);

                if (!$chinhSach) {
                    $vOutput = ['success'=>false, 'message'=>'Không tìm thấy chính sách giá'];
                    break;
                }

                // Tính phí
                $tongPhut = $phien['lv010'];
                $phi = (float)$chinhSach['lv004']; // Phí cơ bản (5000 VND)
                $thoiGianCoBan = (int)$chinhSach['lv003']; // Thời gian cơ bản (ví dụ: 240 phút cho 4 tiếng)
                $coTinhPhiQuaGio = (int)$chinhSach['lv005']; // Cờ tính phí quá giờ
                $donGiaQuaGioBlock = (float)$chinhSach['lv006']; // Đơn giá cho mỗi block quá giờ (ví dụ: 5000 VND)

                // Nếu có tính phí quá giờ và tổng thời gian vượt quá thời gian cơ bản
                if ($coTinhPhiQuaGio == 1 && $tongPhut > $thoiGianCoBan) {
                    $phutQuaGio = $tongPhut - $thoiGianCoBan;
                    // Tính số block quá giờ, làm tròn lên. Mỗi block là 'thoiGianCoBan' phút.
                    $soBlockQuaGio = ceil($phutQuaGio / $thoiGianCoBan); 
                    $phi += $soBlockQuaGio * $donGiaQuaGioBlock;
                }

                // Cập nhật phí vào phiên gửi xe
                $updateQuery = "UPDATE pm_nc0009 SET lv013 = $phi WHERE lv001 = '$maPhien'";
                $updateResult = db_query($updateQuery);

                if ($updateResult) {
                    $vOutput = [
                        'success' => true,
                        'message' => 'Tính phí thành công',
                        'phi' => $phi,
                        'tongPhut' => $tongPhut
                    ];
                } else {
                    $vOutput = ['success'=>false, 'message'=>'Lỗi khi cập nhật phí'];
                }
                break;
			case "layChinhSachTuPT":
				$maLoaiPT = $input['maLoaiPT'] ?? $_POST['lv002'] ?? null;
				if ($maLoaiPT) {
                        $objEmp = $pm_nc0008->KB_LayChinhSachTuMaLoaiPT($maLoaiPT);
                        $vOutput = [];
                        while ($vrow = db_fetch_array($objEmp)) {
                            $vOutput[] = [
                                'maChinhSach'      => $vrow['lv001'] ?? null,
                                'maLoaiPT'       => $vrow['lv002'] ?? null,
                                'thoiGian'       => $vrow['lv003'] ?? null,
                                'donGia'     => $vrow['lv004'] ?? null,
                                'quaGio'    => $vrow['lv005'] ?? null,
                                'donGiaQuaGio'      => $vrow['lv006'] ?? null,
                            ];
                        }
                    } else {
                        $vOutput = ['success'=>false,'message'=>'Không có ma loai PT'];
                    }
				break;
        }
        break;

    // Nhật ký gửi xe theo mã thẻ (pm_nc0010)
    case "pm_nc0010":
        switch ($vfun) {
            case "layNhatKyTheoThe":
                $maThe = $input['maThe'] ?? $_POST['maThe'] ?? $_GET['maThe'] ?? null;
                $ngay = $input['ngay'] ?? $_POST['ngay'] ?? $_GET['ngay'] ?? null;
                
                if (!$maThe) {
                    $vOutput = ['success' => false, 'message' => 'Thiếu mã thẻ'];
                    break;
                }
                
                $vOutput = [];
                $sessionIds = [];
                
                if ($ngay && $ngay !== 'all') {
                    // Trường hợp chọn ngày cụ thể
                    // Chuyển đổi định dạng ngày từ dd-mm-yyyy sang ddmmyyyy
                    $ngayParts = explode('-', $ngay);
                    if (count($ngayParts) === 3) {
                        $ngayFormat = $ngayParts[0] . $ngayParts[1] . $ngayParts[2]; // ddmmyyyy
                        $tableName = "pm_nc0009_" . $ngayFormat;
                        
                        // Kiểm tra bảng có tồn tại không
                        $checkTableQuery = "SHOW TABLES LIKE '$tableName'";
                        $checkResult = db_query($checkTableQuery);
                        
                        if (db_num_rows($checkResult) > 0) {
                            // Tìm các phiên gửi xe của mã thẻ trong ngày
                            $sessionQuery = "SELECT lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015, lv016 
                                           FROM $tableName 
                                           WHERE lv002 = '$maThe'";
                            $sessionResult = db_query($sessionQuery);
                            
                            while ($session = db_fetch_array($sessionResult)) {
                                $sessionIds[] = $session['lv001'];
                                
                                // Lấy nhật ký từ pm_nc0010
                                $logQuery = "SELECT l.*, c.lv002 as tenCamera 
                                           FROM pm_nc0010 l 
                                           LEFT JOIN pm_nc0006 c ON l.lv003 = c.lv001 
                                           WHERE l.lv002 = '{$session['lv001']}' 
                                           ORDER BY l.lv004 ASC";
                                $logResult = db_query($logQuery);
                                
                                $logs = [];
                                while ($log = db_fetch_array($logResult)) {
                                    $logs[] = [
                                        'idNhatKy' => $log['lv001'],
                                        'maPhien' => $log['lv002'],
                                        'maCamera' => $log['lv003'],
                                        'tenCamera' => $log['tenCamera'],
                                        'thoiGianQuet' => $log['lv004'],
                                        'anhQuet' => $log['lv005'],
                                        'khopBienSo' => (int)$log['lv006'],
                                        'huongQuet' => $log['lv007']
                                    ];
                                }
                                
                                $vOutput[] = [
                                    'ngay' => $ngay,
                                    'maPhien' => $session['lv001'],
                                    'maThe' => $session['lv002'],
                                    'bienSo' => $session['lv003'],
                                    'viTriGui' => $session['lv004'],
                                    'maChinhSach' => $session['lv005'],
                                    'congVao' => $session['lv006'],
                                    'congRa' => $session['lv007'],
                                    'gioVao' => $session['lv008'],
                                    'gioRa' => $session['lv009'],
                                    'tongPhut' => (int)$session['lv010'],
                                    'anhVao' => $session['lv011'],
                                    'anhRa' => $session['lv012'],
                                    'phi' => (float)$session['lv013'],
                                    'trangThai' => $session['lv014'],
                                    'loaiPhuongTien' => $session['lv015'],
                                    'ghiChu' => $session['lv016'],
                                    'nhatKy' => $logs
                                ];
                            }
                        } else {
                            $vOutput = ['success' => false, 'message' => "Không tìm thấy dữ liệu cho ngày $ngay"];
                            break;
                        }
                    } else {
                        $vOutput = ['success' => false, 'message' => 'Định dạng ngày không hợp lệ (dd-mm-yyyy)'];
                        break;
                    }
                } else {
                    // Trường hợp lấy tất cả ngày có mã thẻ
                    // Tìm tất cả bảng pm_nc0009_*
                    $tablesQuery = "SHOW TABLES LIKE 'pm_nc0009_%'";
                    $tablesResult = db_query($tablesQuery);
                    
                    $foundTables = [];
                    while ($table = db_fetch_array($tablesResult)) {
                        $tableName = $table[0];
                        
                        // Kiểm tra xem bảng có chứa mã thẻ không
                        $checkQuery = "SELECT COUNT(*) as count FROM $tableName WHERE lv002 = '$maThe'";
                        $checkResult = db_query($checkQuery);
                        $count = db_fetch_array($checkResult);
                        
                        if ($count['count'] > 0) {
                            $foundTables[] = $tableName;
                        }
                    }
                    
                    // Kiểm tra cả bảng chính pm_nc0009
                    $checkMainQuery = "SELECT COUNT(*) as count FROM pm_nc0009 WHERE lv002 = '$maThe'";
                    $checkMainResult = db_query($checkMainQuery);
                    $mainCount = db_fetch_array($checkMainResult);
                    if ($mainCount['count'] > 0) {
                        $foundTables[] = 'pm_nc0009';
                    }
                    
                    // Lấy dữ liệu từ tất cả bảng tìm được
                    foreach ($foundTables as $tableName) {
                        $sessionQuery = "SELECT lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015, lv016 
                                       FROM $tableName 
                                       WHERE lv002 = '$maThe'";
                        $sessionResult = db_query($sessionQuery);
                        
                        while ($session = db_fetch_array($sessionResult)) {
                            // Lấy nhật ký từ pm_nc0010
                            $logQuery = "SELECT l.*, c.lv002 as tenCamera 
                                       FROM pm_nc0010 l 
                                       LEFT JOIN pm_nc0006 c ON l.lv003 = c.lv001 
                                       WHERE l.lv002 = '{$session['lv001']}' 
                                       ORDER BY l.lv004 ASC";
                            $logResult = db_query($logQuery);
                            
                            $logs = [];
                            while ($log = db_fetch_array($logResult)) {
                                $logs[] = [
                                    'idNhatKy' => $log['lv001'],
                                    'maPhien' => $log['lv002'],
                                    'maCamera' => $log['lv003'],
                                    'tenCamera' => $log['tenCamera'],
                                    'thoiGianQuet' => $log['lv004'],
                                    'anhQuet' => $log['lv005'],
                                    'khopBienSo' => (int)$log['lv006'],
                                    'huongQuet' => $log['lv007']
                                ];
                            }
                            
                            // Xác định ngày từ tên bảng
                            $ngayFromTable = 'hiện tại';
                            if ($tableName !== 'pm_nc0009') {
                                $dateStr = str_replace('pm_nc0009_', '', $tableName);
                                if (strlen($dateStr) === 8) {
                                    $ngayFromTable = substr($dateStr, 0, 2) . '-' . substr($dateStr, 2, 2) . '-' . substr($dateStr, 4, 4);
                                }
                            }
                            
                            $vOutput[] = [
                                'ngay' => $ngayFromTable,
                                'maPhien' => $session['lv001'],
                                'maThe' => $session['lv002'],
                                'bienSo' => $session['lv003'],
                                'viTriGui' => $session['lv004'],
                                'maChinhSach' => $session['lv005'],
                                'congVao' => $session['lv006'],
                                'congRa' => $session['lv007'],
                                'gioVao' => $session['lv008'],
                                'gioRa' => $session['lv009'],
                                'tongPhut' => (int)$session['lv010'],
                                'anhVao' => $session['lv011'],
                                'anhRa' => $session['lv012'],
                                'phi' => (float)$session['lv013'],
                                'trangThai' => $session['lv014'],
                                'loaiPhuongTien' => $session['lv015'],
                                'ghiChu' => $session['lv016'],
                                'nhatKy' => $logs
                            ];
                        }
                    }
                    
                    if (empty($vOutput)) {
                        $vOutput = ['success' => false, 'message' => 'Không tìm thấy dữ liệu cho mã thẻ này'];
                        break;
                    }
                }
                
                // Sắp xếp theo thời gian vào
                usort($vOutput, function($a, $b) {
                    return strtotime($b['gioVao']) - strtotime($a['gioVao']);
                });
                
                $vOutput = [
                    'success' => true,
                    'message' => 'Lấy nhật ký thành công',
                    'data' => $vOutput,
                    'tongSoPhien' => count($vOutput)
                ];
                break;
                
            default:
                $vOutput = ['success' => false, 'message' => 'Hành động không hợp lệ'];
                break;
        }
        break;

}
