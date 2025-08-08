<?php

error_reporting(E_ERROR | E_PARSE);
ob_start();
session_start();
$degrees = 0;
include("../config.php");
include("../configrun.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/lv_lv0007.php");
header("Content-type: image/jpeg");
$molv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
if($_SESSION['ERPSOFV2RUserID']!=null && $_SESSION['ERPSOFV2RUserID']!='')
{
	$type=$_GET['type'];
	$vSize=(int)$_GET['size'];
	$vimage='';
	$vUserID=$_GET['UserID'];
 //$vUserID=$molv_lv0007->LV_LoadMemberID($vUserID);
 

 if($vUserID=='') exit();
 switch($type)
 {
	 case 8:
		$vresult=db_query("select lv008 from nhansu_sof_documents_v4_0.hr_lv0041 where lv002='".$vUserID."'");
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vimage=($vrow['lv008']);
			//$degrees=($vrow['lv108']);
			
			//imagejpeg($vimage);
			//echo $rotation = imagerotate($vimage, $degrees, 0);
			//imagepng($rotation);			
			//$vimage=base64_decode($vrow['lv008']);
		}
		break;
	case 9:
		$vresult=db_query("select lv009 from nhansu_sof_documents_v4_0.hr_lv0041 where lv002='".$vUserID."'");
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
		$vimage=($vrow['lv009']);
		//$vimage=base64_decode($vrow['lv009']);
		}
		break;
	case 10:
		$vresult=db_query("select lv010 from nhansu_sof_documents_v4_0.hr_lv0041 where lv002='".$vUserID."'");
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
		$vimage=($vrow['lv010']);
		//$vimage=base64_decode($vrow['lv010']);
		}
		break;
	case 11:
		$vresult=db_query("select lv011 from nhansu_sof_documents_v4_0.hr_lv0041 where lv002='".$vUserID."'");
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vimage=($vrow['lv011']);
			//$vimage=base64_decode($vrow['lv011']);
		}
		break;
	case 12:
		$vresult=db_query("select lv012 from nhansu_sof_documents_v4_0.hr_lv0041 where lv002='".$vUserID."'");
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vimage=($vrow['lv012']);
			//$vimage=base64_decode($vrow['lv012']);
		}
		break;						
	 default:
		break;
 }
 if($vimage=='')
 {
	readfile('../spacer.gif');
 }
 else
 {
	echo ($vimage);
 }
 

//imagepng($vimage);  
//imagedestroy($vimage);
}
?>
<?php ob_end_flush();?>