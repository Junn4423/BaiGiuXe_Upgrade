<?php
session_start();
$sExport=$_GET['childfunc'];
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0024.php");
require_once("../../clsall/lv_httpdownload.php");
$molv_httpdownload=new lv_httpdownload();
$lvts_lv0024=new ts_lv0024($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'SL0002');
$lvts_lv0024->lv001= $_GET['ID'] ?? '';
$lvts_lv0024->LV_LoadID($lvts_lv0024->lv001);
if($lvts_lv0024->lv001==NULL || $lvts_lv0024->lv001=="" || $lvts_lv0024->GetView()<=0) exit;
$molv_httpdownload->set_byurl("../../images/human/File/supplier/".$lvts_lv0024->lv002."_".$lvts_lv0024->lv001."/".$lvts_lv0024->lv006);
$molv_httpdownload->download();
?>