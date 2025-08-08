<?php

error_reporting(E_ERROR | E_PARSE);

session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0108.php");
require_once("../../clsall/hr_lv0086.php");
require_once("../../clsall/hr_lv0020.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<style>
.file-wrapper {
  cursor: pointer;
  display: inline-block;
  overflow: hidden;
  position: relative;
}
.file-wrapper .button {
  background: #aaa;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  cursor: pointer;
  display: inline-block;
  font-size: 11px;
  font-weight: bold;
  padding: 4px 18px;
  text-transform: uppercase;
}
.file-wrapper input {
  cursor: pointer;
  height: 100%;
  position: absolute;
  right: 0;
  top: 0;
}
.file-wrapper input {
  filter: alpha(opacity=50);
  -moz-opacity: 0.5;
  opacity: 0.5;
}
.file-wrapper input {
  filter: alpha(opacity=1);
  -moz-opacity: 0.01;
  opacity: 0.01;
}
.file-wrapper input {
  font-size: 100px;
}
</style>
<script>
var VIGET = {};
VIGET.fileInputs = function() {
	  var $this = $(this),
	      $val = $this.val(),
	      valArray = $val.split('\\'),
	      newVal = valArray[valArray.length-1],
	      $button = $this.siblings('.button'),
	      $fakeFile = $this.siblings('.file-holder');
	  if(newVal !== '') {
	    $button.text('Photo Chosen');
	    if($fakeFile.length === 0) {
	      $button.after('' + newVal + '');
	    } else {
	      $fakeFile.text(newVal);
	    }
	  }
	};
	 
	$(document).ready(function() {
	  $('.file-wrapper input[type=file]')
	  .bind('change focus click', VIGET.fileInputs);
	});
	
	
	
</script>
</head>
<?php
function UploadImg($folder_name, $fname){
	$maxsize = 320971520;//Max file size 30KB
	$path = "../../".$_GET['mabienban']."/";
	$arrName = explode(".", $fname);

	if(create_folder($path, $folder_name)==true || is_dir($path.$folder_name)){
		$path = $path.$folder_name."/";
		$result = upload_filemail($fpath, $fname, $path, $maxsize);
		if($result==1){
			$message = "Image uploaded successfully!";
			//$vFlag = 2;//Upload successful.
			//$fpath = "";
			//$fname = "";
		}
		if($result==2)
			$message = "Incorrect file type!";
		if($result==3 || $result==4)
			$message = "Image size is very small or big!";
		if($result==5 || $result==6)
			$message = "Error in uploading file, please try again!";
	}
}
$lvhr_lv0108=new hr_lv0108($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');


$vUserID=$_GET['UserID'];
//$vIsOk=$lvhr_lv0108->LV_CheckSelft($lvhr_lv0108->LV_UserID,$vUserID);
if($lvhr_lv0108->GetApr()>0 && $lvhr_lv0108->GetUnApr()>0)
{
//////////////init object////////////////
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","ML0019.txt",$plang);

$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$vViTriUp=$_GET['ViTriUp'];

$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');

$nv = $mohr_lv0020->LV_LoadID($vUserID);
$tenNv = $nv["lv002"];
$phongBan= $nv["lv029"];
$chucVu = !empty($nv["lv005"]) ? $nv["lv005"] : "Không có";

if($vFlag==1)
{
	$lvhr_lv0086=new hr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0086');
	//$lvhr_lv0086->LV_Load();
		$vHinhUpdate=$lvhr_lv0108->scaleImageFileToBlob($_FILES['userfile']['tmp_name'],$lvhr_lv0086->lv010,$lvhr_lv0086->lv011);
		$vKetQua=$lvhr_lv0108->LV_LoadStepCheck($vUserID);
		$lvhr_lv0108->lv002=$vUserID;
		$lvhr_lv0108->lv003='contract';
		$lvhr_lv0108->lv007=$lvhr_lv0108->LV_UserID;
		if($vKetQua==null)
		{
			
			$vresult=$lvhr_lv0108->LV_InsertAuto($vViTriUp,$vHinhUpdate);
		}
		else
		{
			$lvhr_lv0108->lv001=$vKetQua;
			$vresult=$lvhr_lv0108->LV_UpdateAuto($vKetQua,$vViTriUp,$vHinhUpdate);
		}
	
}
/*$vloadattach=$lvhr_lv0108->LV_LoadStep($lvhr_lv0108->lv007,$lvhr_lv0108->lv008,$lvhr_lv0108->lv009,$_GET['CodeID']);
$vloadattach=str_replace("'","\'",$vloadattach);
$vloadattach=str_replace("
","",$vloadattach);*/

?>
<body style="background:none;">
<a style="display:none" id="ahrefname" href="#" onclick="openFileOption()" target="_self">Tải hình</a>
<form name="frmpost" id="frmpost" target="_self" action="?func=upload&UserID=<?php echo $_GET['UserID'];?>&ViTriUp=<?php echo $_GET['ViTriUp'];?>&lang=<?php echo $_GET['lang'];?>" method="post" enctype="multipart/form-data">
	<span class="file-wrapper">
	<input type="file" id="userfile" name="userfile" style="display:block"   onchange="loadfile(this); uploadAvataNhanVien(); uploadAnhApi();">
 	  <!--<span class="button">Tải ảnh</span>-->
	  <img style="height:20px;cursor:pointer;" title="Phải nhấn  nút thêm để chọn được nhiều sản phẩm!" tabindex="6" border="0" title="Tiền" class="imgButton" onmouseout="this.src='../../images/iconcontrol/taianh.png';" onmouseover="this.src='../../images/iconcontrol/taianh_hover.png';"  src="../../images/iconcontrol/taianh.png" onkeypress="return CheckKey(event,11)">
  	</span>
	<input name="txtFlag" type="hidden" id="txtFlag"  />
</form>
<script language="javascript">
var start="<?php echo $vFlag?>";

if(start==1)
{
<?php
if($vFlag==1) 
	$lvImg="<a target=\"_blank\" href=\"hr_lv0020/readfile.php?UserID=".$vUserID."&type=".$vViTriUp."&size=0\"><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"hr_lv0020/readfile.php?UserID=".$vUserID."&type=".$vViTriUp."&size=1\" /></a>";
else
	$lvImg='';
?>		
	var o = window.parent.document.getElementById('attachfile_<?php echo $vViTriUp;?>_'+'<?php echo $vUserID;?>');

	o.innerHTML='<?php echo $lvImg;?>';
}
function loadfile(o)
{
	frmpost.txtFlag.value=1;
	frmpost.submit();
}
function openFileOption()
{
	var o = document.getElementById('userfile');
	o.click();	 
}


function uploadAvataNhanVien() {
		
		var fileInput = document.getElementById('userfile');
		
		const urlParams = new URLSearchParams(window.location.search);
		
		
		var file = fileInput.files[0];
		
		  const formData = new FormData();
		  formData.append("image", file);
		  formData.append("maNv", urlParams.get('UserID'));
		  formData.append("tenNv", "<?php echo addslashes($tenNv); ?>");
		  
		  

		  fetch("uploadAvata.php", {
			method: "POST",
			body: formData
		  })
		  .then(response => response.text())
		  .then(result => {
			document.getElementById('result').innerText = result;
		  })
		  .catch(error => {
			console.error("Lỗi:", error);
			document.getElementById('result').innerText = "Đã xảy ra lỗi khi upload ảnh.";
		 });
	}
	
	
function uploadAnhApi() {
    var fileInput = document.getElementById('userfile');
    const urlParams = new URLSearchParams(window.location.search);
    var file = fileInput.files[0];

    var formData = new FormData();
    formData.append("image", file);
    formData.append("employee_id", urlParams.get('UserID'));
	 formData.append("name", "<?php echo addslashes($tenNv); ?>");
	formData.append("department", "<?php echo addslashes($phongBan); ?>");
    formData.append("position", "<?php echo addslashes($chucVu); ?>");

	  fetch('http://192.168.1.20:5005/api/register', {
		method: 'POST',
		body: formData
		})
		.then(response => {
			console.log("Raw response:", response);
			if (!response.ok) {
				throw new Error(`HTTP error! status: ${response.status}`);
			}
			return response.json();
		})
		.then(data => {
			console.log("Response JSON:", data);
			alert(data.message || "Đăng ký thành công!");
		})
		.catch(error => {
			console.error('Lỗi khi gọi API:', error.message || error);
			alert("Đã xảy ra lỗi khi gọi API: " + error.message);
		});
}
			
</script>
</body>
<?php 
} else {
	include("../permit.php");
}
?>
</body>
</html>