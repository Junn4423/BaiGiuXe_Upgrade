<?php
session_start();
$sExport=$_GET['childfunc'];
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0211.php");
require_once("../../clsall/lv_httpdownload.php");
$molv_httpdownload=new lv_httpdownload();
$lvhr_lv0211=new hr_lv0211($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'HR0211');
if($lvhr_lv0211->GetView()==1)
{
$lvhr_lv0211->lv001= $_GET['ID'] ?? '';
$lvhr_lv0211->LV_LoadID($lvhr_lv0211->lv001);
if($lvhr_lv0211->lv001==NULL || $lvhr_lv0211->lv001=="" || $lvhr_lv0211->GetView()<=0) exit;
$molv_httpdownload->set_byurl("../../images/human/File/employees/".$lvhr_lv0211->lv002."_".$lvhr_lv0211->lv001."/".$lvhr_lv0211->lv006);
$molv_httpdownload->download();
}
else {
	include("../permit.php");
}
?>