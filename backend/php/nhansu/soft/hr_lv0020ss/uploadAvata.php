<?php
// uploadAvata.php

if (isset($_FILES['image'])) {
    
    $ma_nv = $_POST['maNv'] ?? ''; 
    $tenNv = $_POST['tenNv'] ?? ''; 
	
    
    if (empty($ma_nv)) {
        echo "Không có mã nhân viên.";
        exit;
    }

    $targetDir = "../../hinhnhanvien/";  // Thư mục lưu ảnh
	
	$targetDir = $targetDir . $ma_nv . "/";
	$targetFile = $targetDir . $ma_nv . ".jpg";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true); // Tạo thư mục nếu chưa có
    }

    // Lấy phần mở rộng file ảnh gốc
    $fileExt = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

    // Đổi tên file thành mã nhân viên + phần mở rộng
    $fileName = $ma_nv . '.' . $fileExt;

    $targetFile = $targetDir . $fileName;

    // Kiểm tra file có phải ảnh không
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File không phải là ảnh.";
        exit;
    }

    // Giới hạn dung lượng (ví dụ 3MB)
    $maxSize = 3 * 1024 * 1024;
    if ($_FILES["image"]["size"] > $maxSize) {
        echo "Ảnh quá lớn. Vui lòng chọn ảnh dưới 3MB.";
        exit;
    }

    // Kiểm tra định dạng ảnh (chỉ cho phép jpg, png, gif)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($check['mime'], $allowedTypes)) {
        echo "Chỉ cho phép ảnh JPG, PNG, GIF.";
        exit;
    }

    // Di chuyển file lên thư mục uploads
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "Upload thành công: " . $fileName;
		
		
		 // Ghi mã nhân viên và tên nhân viên vào file .txt
		$infoFile = $targetDir . $ma_nv . ".txt";
        $content =  $tenNv;
        file_put_contents($infoFile, $content);
    } else {
        echo "Lỗi khi lưu file.";
    }
} else {
    echo "Không nhận được file ảnh.";
}
?>
