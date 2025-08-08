<?php
ob_start();
session_start();
include("../config.php");
include("../configrun.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0211.php");
header("Content-type: application/pdf");
$mohr_lv0211=new hr_lv0211($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'HR0210');
$mohr_lv0211->LV_LoadID($_GET['FileID']);
switch($mohr_lv0211->lv006)
{
	case 'png':
	case 'jpg':
	case 'jpeg':
		header("Content-type: image/".$mohr_lv0211->lv006);
		//header('Content-Disposition: attachment; filename="'.$mocr_lv0291->lv006.'"');
		//header('Content-Disposition: attachment; filename="'.$mocr_lv0291->lv004.'.'.$mocr_lv0291->lv006.'"');
		break;
	case 'pdf':
		header("Content-type: application/".$mohr_lv0211->lv006);
		//header('Content-Disposition: attachment; filename="'.$mohr_lv0211->lv004.'"');
		break;
	case 'doc':
	case 'docx':
		header('Content-Type: application/vnd.ms-word; charset=utf-8');
		 header('Content-Disposition: attachment; filename="'.$mohr_lv0211->lv004.'"');
		break;
	case 'xls':
	case 'xlsx':
		header('Content-Type: application/vnd.ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename="'.$mohr_lv0211->lv004.'"');
		break;
	default:
		header("Content-type: application/".$mohr_lv0211->lv006);
		header('Content-Disposition: attachment; filename="'.$mohr_lv0211->lv004.'"');
		break;
}
if($mohr_lv0211->GetView()==1)
{
	$type=$_GET['type'];
	$vSize=(int)$_GET['size'];
	$vimage='';
	$vUserID=$_GET['FileID'];
	$vresult=db_query("select lv008 from erp_sof_documents_v4_0.hr_lv0211 where lv002='".$vUserID."'");
	$vrow=db_fetch_array($vresult);
	if($vrow)
	{
	$vimage=($vrow['lv008']);
	//$vimage=base64_decode($vrow['lv008']);
	}
	if($vSize==0)
		echo ($vimage); 
	else
	{
		echo ($vimage);
	}
}
?>
<?php ob_end_flush();?>