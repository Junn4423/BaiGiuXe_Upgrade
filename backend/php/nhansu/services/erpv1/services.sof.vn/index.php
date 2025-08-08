<?php
error_reporting(E_ERROR);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// ...existing code...
// Cho phép từ mọi origin (hoặc cụ thể origin nếu muốn)
header("Access-Control-Allow-Origin: *");

// Cho phép các phương thức
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

// Cho phép các header custom (như Content-Type)
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Nếu là request OPTIONS (preflight), trả về sớm
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	http_response_code(200);
	exit();
}


header(header: "Content-Type: application/json; charset=UTF-8");
include("config.php");
include("function.php");
include("lv_controler.php");


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);
$vtable = $input['table'] ?? $_POST['table'] ?? $_GET['table'];
$vfun = $input['func'] ?? $_POST['func'] ?? $_GET['func'];


$vlimit = isset($input['limit']) ? $input['limit'] : (isset($_POST['limit']) ? $_POST['limit'] : "");
$vmonth = isset($input['month']) ? $input['month'] : (isset($_POST['month']) ? $_POST['month'] : "");
$vyear = isset($input['year']) ? $input['year'] : (isset($_POST['year']) ? $_POST['year'] : "");


$vOutput = array();

function saveImageToDB($fileData, $cot, $lv001)
{
	try {
		// Kết nối đến CSDL
		$db = db_connect();
		// Kiểm tra xem lv002 = $lv001 đã tồn tại chưa
		$checkSql = "SELECT COUNT(*) as count FROM erp_sof_documents_v4_0.cr_lv0382 WHERE lv002 = ?";

		$checkStmt = mysqli_prepare($db, $checkSql);
		mysqli_stmt_bind_param($checkStmt, "s", $lv001);
		mysqli_stmt_execute($checkStmt);
		$result = mysqli_stmt_get_result($checkStmt);
		$row = mysqli_fetch_assoc($result);
		$exists = $row['count'] > 0;
		mysqli_stmt_close($checkStmt);


		if ($exists) {
			$sql = "UPDATE erp_sof_documents_v4_0.cr_lv0382 SET $cot = ? WHERE lv002 = ?";
		} else {
			$sql = "INSERT INTO erp_sof_documents_v4_0.cr_lv0382 (lv002, $cot) VALUES (?, ?)";
		}

		$stmt = mysqli_prepare($db, $sql);

		if (!$stmt) {
			throw new Exception("Lỗi chuẩn bị truy vấn: " . mysqli_error($db));
		}


		$null = NULL;

		if ($exists) {
			// Gắn tham số: "sb" = string ($lv001), blob ($fileData)
			mysqli_stmt_bind_param($stmt, "bs", $null, $lv001);
			mysqli_stmt_send_long_data($stmt, 0, $fileData);

		} else {
			mysqli_stmt_bind_param($stmt, "sb", $lv001, $null);
			mysqli_stmt_send_long_data($stmt, 1, $fileData);

		}

		// Thực thi truy vấn
		if (!mysqli_stmt_execute($stmt)) {
			throw new Exception("Lỗi thực thi truy vấn: " . mysqli_stmt_error($stmt));
		}

		// Đóng kết nối
		mysqli_stmt_close($stmt);
		mysqli_close($db);

		return [
			'success' => true,
			'message' => 'Lưu ảnh vào CSDL thành công.',
		];
	} catch (Exception $e) {
		return [
			'success' => false,
			'message' => $e->getMessage(),
		];
	}
}






switch ($vtable) {

	case "cr_lv0330":
		include("cr_lv0330.php");
		$cr_lv0330 = new cr_lv0330($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case "data":
				$vOutput = $cr_lv0330->getAll();
				break;
			case "capNhat":
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				// echo $lv001;
				$lv004 = $input['lv004'] ?? $_POST['lv004'] ?? "";
				$lv005 = $input['lv005'] ?? $_POST['lv005'] ?? "";
				$lv012 = $input['lv012'] ?? $_POST['lv012'] ?? "";
				$lv013 = $input['lv013'] ?? $_POST['lv013'] ?? "";
				$lv014 = $input['lv014'] ?? $_POST['lv014'] ?? "";
				$lv015 = $input['lv015'] ?? $_POST['lv015'] ?? "";
				$lv016 = $input['lv016'] ?? $_POST['lv016'] ?? "";
				$lv353 = $input['lv353'] ?? $_POST['lv353'] ?? "";
				$lv360 = $input['lv360'] ?? $_POST['lv360'] ?? "";
				$lv361 = $input['lv361'] ?? $_POST['lv361'] ?? "";
				$lv361 = $input['lv361'] ?? $_POST['lv362'] ?? "";
				$lv363 = $input['lv363'] ?? $_POST['lv363'] ?? "";
				$lv364 = $input['lv364'] ?? $_POST['lv364'] ?? "";
				$lv365 = $input['lv365'] ?? $_POST['lv365'] ?? "";
				$lv366 = $input['lv366'] ?? $_POST['lv366'] ?? "";
				$lv367 = $input['lv367'] ?? $_POST['lv367'] ?? "";
				$lv368 = $input['lv368'] ?? $_POST['lv368'] ?? "";
				$lv369 = $input['lv369'] ?? $_POST['lv369'] ?? "";
				$lv370 = $input['lv370'] ?? $_POST['lv370'] ?? "";
				$lv371 = $input['lv371'] ?? $_POST['lv371'] ?? "";
				$lv802 = $input['lv802'] ?? $_POST['lv802'] ?? "";
				$lv809 = $input['lv809'] ?? $_POST['lv809'] ?? "";
				$vOutput = $cr_lv0330->capNhat(
					$lv001,
					$lv004,
					$lv005,
					$lv012,
					$lv013,
					$lv014,
					$lv015,
					$lv016,
					$lv353,
					$lv360,
					$lv361,
					$lv362,
					$lv363,
					$lv364,
					$lv365,
					$lv366,
					$lv367,
					$lv368,
					$lv369,
					$lv370,
					$lv371,
					$lv802,
					$lv809
				);
				break;
			case "xoaPhieu":
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$vOutput = $cr_lv0330->xoaPhieu($lv001);
				break;
		}
		break;

	case "sl_lv0001":
		include("sl_lv0001.php");
		$sl_lv0001 = new sl_lv0001($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case "data":
				$vOutput = $sl_lv0001->getKhachHang();
		}
		break;

	case "cr_lv0334":
		switch ($vfun) {
			case "data":
				$vArrRe = [];
				$vsql = "SELECT * FROM `cr_lv0334`";
				$vresult = db_query($vsql);
				while ($vrow = mysqli_fetch_assoc($vresult)) {
					$vArrRe[] = $vrow;
				}
				$vOutput = $vresult;
		}
		break;


	case "cr_lv0052":
		include("cr_lv0052.php");
		$cr_lv0052 = new cr_lv0052($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case "data":
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$vOutput = $cr_lv0052->getChiTiet($lv001);
				break;
			case "xoa":
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$vOutput = $cr_lv0052->xoa($lv001);

		}
		break;

	case "hr_lv0020":
		include("hr_lv0020.php");
		$hr_lv0020 = new hr_lv0020($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case "data":
				$vOutput = $hr_lv0020->getNhanVien();
		}
		break;

	case "cr_lv0382":
		include("cr_lv0382.php");
		$cr_lv0382 = new cr_lv0382($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case "data":
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$vOutput = $cr_lv0382->getChiTietPhieu($lv001);
				break;
			case "uploadAnh":
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$cot = $input['cot'] ?? $_POST['cot'] ?? "";
				if (isset($_FILES['image'])) {
					$file = $_FILES['image'];
					$fileData = file_get_contents($file['tmp_name']);
					$vOutput = saveImageToDB($fileData, $cot, $lv001);

				} else {
					echo json_encode([
						'status' => 'error',
						'message' => 'Không nhận được ảnh.'
					]);
				}
				break;

			case "themMoi":
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$lv003 = $input['lv003'] ?? $_POST['lv003'] ?? "";
				$lv008 = $input['lv008'] ?? $_POST['lv008'] ?? "";
				$vOutput = $cr_lv0382->themMoi($lv001, $lv003, $lv008);
				break;

			case "xoa":
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$vOutput = $cr_lv0382->xoa($lv001);
				break;

			case "sua":
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$lv003 = $input['lv003'] ?? $_POST['lv003'] ?? "";
				$lv008 = $input['lv008'] ?? $_POST['lv008'] ?? "";
				$vOutput = $cr_lv0382->sua($lv001, $lv003, $lv008);
				break;


		}
		break;

	case "getAnhTable":
		switch ($vfun) {
			case "getAnh":
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? $_GET['lv001'];
				$cot = $input['cot'] ?? $_POST['cot'] ?? $_GET['cot'];
				if ($lv001) {
					// Kết nối đến CSDL
					$db = db_connect(); // Đảm bảo bạn đã gọi đúng hàm kết nối

					// Kiểm tra kết nối đến CSDL
					if ($db === false) {
						http_response_code(500);
						echo "Lỗi kết nối đến cơ sở dữ liệu.";
						break;
					}

					// Sử dụng mysqli_real_escape_string để bảo vệ khỏi SQL Injection
					$lv001 = mysqli_real_escape_string($db, $lv001);

					// Tạo câu truy vấn SQL
					$sql = "SELECT $cot FROM erp_sof_documents_v4_0.cr_lv0382 WHERE lv002 = '$lv001'";
					// Thực thi câu lệnh SQL
					$vresult = db_query($sql);

					if ($vresult && mysqli_num_rows($vresult) > 0) {
						// Lấy dữ liệu ảnh từ kết quả truy vấn
						$imageData = mysqli_fetch_assoc($vresult);
						$imageData = $imageData[$cot]; // Lấy dữ liệu của cột ảnh

						// Trả về ảnh dưới định dạng Content-Type đúng
						header("Content-Type: image/jpeg");
						echo $imageData;
					} else {
						http_response_code(404);
						echo "Image not found.";
					}

					// Đóng kết nối
					mysqli_free_result($vresult);
					mysqli_close($db); // Đảm bảo đóng kết nối sau khi sử dụng
				} else {
					http_response_code(400);
					echo "Missing lv001 parameter.";
				}
				break;


		}

}






if ($vfun == 'data') {
	$i = 1;
	echo "[";
	foreach ($vOutput as $vData) {
		if ($i > 1)
			echo ",";
		echo json_encode($vData);

		$i++;
	}
	echo "]";
} else
	echo json_encode($vOutput);