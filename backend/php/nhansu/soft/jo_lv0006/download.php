<?php
session_start();
$sExport=$_GET['childfunc'];
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/jo_lv0006.php");
require_once("../../clsall/lv_httpdownload.php");
$molv_httpdownload=new lv_httpdownload();
$lvjo_lv0006=new jo_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0006');
$lvjo_lv0006->lv001=$_GET["ID"];
$lvjo_lv0006->LV_LoadID($lvjo_lv0006->lv001);
if($lvjo_lv0006->lv001==NULL || $lvjo_lv0006->lv001=="" || $lvjo_lv0006->GetView()<=0) exit;
$molv_httpdownload->set_byurl("../../images/human/File/tasks/".$lvjo_lv0006->lv002."_".$lvjo_lv0006->lv001."/".$lvjo_lv0006->lv006);
$molv_httpdownload->download();
?>