<?php
session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/da_lh0003.php");
require_once("../../clsall/hr_lv0086.php");
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
  padding: 5px 12px;
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
VIGET.fileInputs = function() {
	  var $this = $(this),
	      $val = $this.val(),
	      valArray = $val.explode('\\'),
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
$lvda_lh0003=new da_lh0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0309');


$vFileID=$_GET['FileID'];
if($lvda_lh0003->GetAdd()>0 )
{
//////////////init object////////////////
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","ML0019.txt",$plang);

$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$vViTriUp=$_GET['ViTriUp'];
$extension='';
$namefile='';
if($vFlag==1)
{
	$lvhr_lv0086=new hr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0086');
	//$lvhr_lv0086->LV_Load();
	$vHinhUpdate=file_get_contents($_FILES['userfile']['tmp_name']);
	$vKetQua=$lvda_lh0003->LV_LoadStepCheckTemp($lvda_lh0003->LV_UserID);
	$lvda_lh0003->lv007=$lvda_lh0003->LV_UserID;
	$lvda_lh0003->lv006=$_FILES['userfile']['name'];
	$namefile=$_FILES['userfile']['name'];
	$extension = exten($lvda_lh0003->lv006);
	$extension=str_replace(".","",$extension);
	$extension=strtolower($extension);
	$lvda_lh0003->lv003='tailieu';
	$lvda_lh0003->lv002=$lvda_lh0003->LV_UserID;
	if($vKetQua==null)
	{
		$vresult=$lvda_lh0003->LV_InsertAutoTemp($vViTriUp,$vHinhUpdate);
	}
	else
	{
		$lvda_lh0003->lv001=$vKetQua;
		$vresult=$lvda_lh0003->LV_UpdateAutoTemp($vKetQua,$vViTriUp,$vHinhUpdate);
	}
	
}
/*$vloadattach=$lvda_lh0003->LV_LoadStep($lvda_lh0003->lv007,$lvda_lh0003->lv008,$lvda_lh0003->lv009,$_GET['CodeID']);
$vloadattach=str_replace("'","\'",$vloadattach);
$vloadattach=str_replace("
","",$vloadattach);*/

?>
<body style="background:none;">
<a style="display:none" id="ahrefname" href="#" onclick="openFileOption()" target="_self">Upload File</a>
<form name="frmpost" id="frmpost" target="_self" action="?childdetailfunc=uploadtemp&FileID=<?php echo $_GET['FileID'];?>&ViTriUp=<?php echo $_GET['ViTriUp'];?>&lang=<?php echo $_GET['lang'];?>" method="post" enctype="multipart/form-data">
	<span class="file-wrapper"  title="Chỉ tải tập tin PDF,khác không đọc được!">
	<input type="file" id="userfile" name="userfile" style="display:block"  onchange="loadfile(this)">
 	 <span class="button">Upload File</span>
  	</span>
	<input name="txtFlag" type="hidden" id="txtFlag"  />
</form>
<script>
var start="<?php echo $vFlag?>";
if(start==1)
{
<?php
if($vFlag==1) 
	$lvImg="<a target=\"_blank\" href=\"../da_lh0003/readfiletemp.php?FileID=".$vFileID."&type=".$vViTriUp."&size=0\"><div style=\"border-radius:5px;background:#aaa;padding:4px;color:#000;\">View</div></a>";
else
	$lvImg='';
?>		
	var o = window.parent.document.getElementById('attachfiletemp');
	o.innerHTML='<?php echo $lvImg;?>';
	var qxtlv006 = window.parent.document.getElementById('qxtlv006');
	if(qxtlv006!=null)
	{
		if(qxtlv006.value=='') qxtlv006.value='<?php echo $extension;?>';
	}
	var or=window.parent.document.getElementById('qxtlv004');
	if(or!=null)
	{
		or.value='<?php echo str_replace("'","",$namefile);?>';
	}
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
</script>
</body>
<?php 
} else {
	include("../../permit.php");
}
?>
</body>
</html>