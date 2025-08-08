<?php
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
if($molv_lv0007->GetView()==1 )
{
	$degrees=0;
	$type=$_GET['type'];
	$vSize=(int)$_GET['size'];
	$vimage='';
	$vUserID=$_GET['UserID'];
	$visNoSave=false;
	switch($type)
	{
		case 8:
		   $vresult=db_query("select lv108 from erp_sof_documents_v4_0.hr_lv0041 where lv002='".$vUserID."'");
		   $vrow=db_fetch_array($vresult);
		   if($vrow)
		   {
			   $degrees=($vrow['lv108']);
		   }
		   else
		   {
			   $visNoSave=true;
		   }
		   break;
	   case 9:
		   $vresult=db_query("select lv109 from erp_sof_documents_v4_0.hr_lv0041 where lv002='".$vUserID."'");
		   $vrow=db_fetch_array($vresult);
		   if($vrow)
		   {
			$degrees=($vrow['lv109']);
		   }
		   else
		   {
			   $visNoSave=true;
		   }
		   break;
	   case 10:
		   $vresult=db_query("select lv110 from erp_sof_documents_v4_0.hr_lv0041 where lv002='".$vUserID."'");
		   $vrow=db_fetch_array($vresult);
		   if($vrow)
		   {
				$degrees=($vrow['lv110']);
		   }
		   else
		   {
			   $visNoSave=true;
		   }
		   break;
	   case 11:
		   $vresult=db_query("select lv111 from erp_sof_documents_v4_0.hr_lv0041 where lv002='".$vUserID."'");
		   $vrow=db_fetch_array($vresult);
		   if($vrow)
		   {
				$degrees=($vrow['lv111']);
		   }
		   else
		   {
			   $visNoSave=true;
		   }
		   break;
	   case 12:
		   $vresult=db_query("select lv112 from erp_sof_documents_v4_0.hr_lv0041 where lv002='".$vUserID."'");
		   $vrow=db_fetch_array($vresult);
		   if($vrow)
		   {
				$degrees=($vrow['lv112']);
		   }
		   else
		   {
			   $visNoSave=true;
		   }
		   break;						
		default:
		   break;
	}
	if($visNoSave==true)
	{
		readfile('../spacer.gif');
	}
	else
	{
	//$molv_lv0007->domains='http://localhost/levinhsoft/SOF';
	$molv_lv0007->domains='http://erp.SOF.biz';
	$im = imagecreatefromjpeg($molv_lv0007->domains.'/soft/hr_lv0020/readfile.php?UserID='.$vUserID.'&type='.$type.'&size='.$vSize.'&isPass=1'); 
	if($im==null)
	{
		$im = imagecreatefrompng($molv_lv0007->domains.'/soft/hr_lv0020/readfile.php?UserID='.$vUserID.'&type='.$type.'&size='.$vSize.'&isPass=1'); 
	}
	if($im==null)
	{
		$im = imagecreatefromgif($molv_lv0007->domains.'/soft/hr_lv0020/readfile.php?UserID='.$vUserID.'&type='.$type.'&size='.$vSize.'&isPass=1'); 
	}
	 if($degrees>0)
	 {
		$rotation = imagerotate($im, $degrees, 0);
	 }
	 else
	 	$rotation=$im;

	  
	// Flip the image 
	//imageflip($im, 1); 
	  
	// View the loaded image in browser 
	//header('Content-type: image/jpg');   
	imagejpeg($rotation); 
	imagedestroy($im); 
	}
}
?>