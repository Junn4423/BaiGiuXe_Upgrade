<?php
session_start();
$sExport=$_GET['childfunc'];
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0047.php");
require_once("../../clsall/lv_httpdownload.php");
$molv_httpdownload=new lv_httpdownload();
$lvhr_lv0047=new hr_lv0047($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0014');
$lvhr_lv0047->lv001= $_GET['ID'] ?? '';
$lvhr_lv0047->LV_LoadID($lvhr_lv0047->lv001);
if($lvhr_lv0047->lv001==NULL || $lvhr_lv0047->lv001=="" || $lvhr_lv0047->GetView()<=0) exit;
$molv_httpdownload->set_byurl("../../images/human/File/insurances/".$lvhr_lv0047->lv002."_".$lvhr_lv0047->lv001."/".$lvhr_lv0047->lv006);
$molv_httpdownload->download();
?>