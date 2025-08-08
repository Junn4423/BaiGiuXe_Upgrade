<?php
ob_start();
session_start();
include("../config.php");
include("../configrun.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/da_lh0003.php");
header("Content-type: application/pdf");
$moda_lh0003=new da_lh0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0309');
if($moda_lh0003->GetView()==1)
{
	$type=$_GET['type'];
	$vSize=(int)$_GET['size'];
	$vimage='';
	$vUserID=$moda_lh0003->LV_UserID;
	$vresult=db_query("select lv008 from erp_sof_documents_v4_0.da_lh0003_temp where lv007='".$vUserID."'");
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