<?php
session_start();
$sExport=$_GET['childfunc'];
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0012.php");
require_once("../../clsall/lv_httpdownload.php");
$molv_httpdownload=new lv_httpdownload();
$lvsl_lv0012=new sl_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0014');
$lvsl_lv0012->lv001= $_GET['ID'] ?? '';
$lvsl_lv0012->LV_LoadID($lvsl_lv0012->lv001);
if($lvsl_lv0012->lv001==NULL || $lvsl_lv0012->lv001=="" || $lvsl_lv0012->GetView()<=0) exit;
$molv_httpdownload->set_byurl("../../images/human/File/quotations/".$lvsl_lv0012->lv002."_".$lvsl_lv0012->lv001."/".$lvsl_lv0012->lv006);
$molv_httpdownload->download();
?>