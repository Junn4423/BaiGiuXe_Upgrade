<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
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

session_start();
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
	case "cr_lv0382":

		switch ($vfun) {
			case "data":

				break;
			case "uploadAnh":

				break;

			case "themMoi":

				break;

			case "xoa":

				break;

			case "sua":

				break;
		}
		break;

}

// Endpoint đặc biệt để đồng bộ trạng thái chỗ đỗ
if ($vtable == 'sync_parking_status' && $vfun == 'sync') {
    include("pm_nc0005.php");
    $spotManager = new pm_nc0005();
    $result = $spotManager->SyncParkingSpotStatus();
    echo json_encode($result);
    exit();
}

include("kebao.php");
include("ngocchung.php");




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