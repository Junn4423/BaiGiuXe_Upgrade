<?php
session_start();
$sExport=$_GET['childfunc'];
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/da_lh0003.php");
require_once("../../clsall/lv_httpdownload.php");
$molv_httpdownload=new lv_httpdownload();
$lvda_lh0003=new da_lh0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0309');
if($lvda_lh0003->GetView()==1)
{
$lvda_lh0003->lv001= $_GET['ID'] ?? '';
$lvda_lh0003->LV_LoadID($lvda_lh0003->lv001);
if($lvda_lh0003->lv001==NULL || $lvda_lh0003->lv001=="" || $lvda_lh0003->GetView()<=0) exit;
$molv_httpdownload->set_byurl("../../images/human/File/employees/".$lvda_lh0003->lv002."_".$lvda_lh0003->lv001."/".$lvda_lh0003->lv006);
$molv_httpdownload->download();
}
else {
	include("../permit.php");
}
?>