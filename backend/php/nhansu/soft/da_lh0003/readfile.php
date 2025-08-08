<?php
ob_start();
session_start();
include("../config.php");
include("../configrun.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/da_lh0003.php");

$moda_lh0003=new da_lh0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0309');
$moda_lh0003->LV_LoadID($_GET['FileID']);
switch($moda_lh0003->lv006)
{
	case 'pdf':
		header("Content-type: application/".$moda_lh0003->lv006);
		header('Content-Disposition: attachment; filename="'.$moda_lh0003->lv004.'"');
		break;
	case 'doc':
	case 'docx':
		header('Content-Type: application/vnd.ms-word; charset=utf-8');
		 header('Content-Disposition: attachment; filename="'.$moda_lh0003->lv004.'"');
		break;
	case 'xls':
	case 'xlsx':
		header('Content-Type: application/vnd.ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename="'.$moda_lh0003->lv004.'"');
		break;
	default:
		header("Content-type: application/".$moda_lh0003->lv006);
		header('Content-Disposition: attachment; filename="'.$moda_lh0003->lv004.'"');
		break;

}
if($moda_lh0003->GetView()==1)
{
	$type=$_GET['type'];
	$vSize=(int)$_GET['size'];
	$vimage='';
	$vUserID=$_GET['FileID'];
	$vresult=db_query("select lv008 from erp_sof_documents_v4_0.da_lh0003 where lv002='".$vUserID."'");
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