<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0031.php");
$vlWHID=$_GET['lv002'];	
$vlv005=$_GET['lv005'];	
$vlv006=$_GET['lv006'];	
$vDate=GetServerDate();
$vType=$_GET['Type'];	
switch($vType)
{
	case 'BANHANG':
		$mots_lv0031=new ts_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0012');
		$vReturn=$mots_lv0031->LV_InsertCONTRACT(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate);
		break;
	case 'TRAHANG':
		$mots_lv0031=new ts_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0012');
		$vReturn=$mots_lv0031->LV_InsertCONTRACT(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate);
		break;
	case 'MUAHANG':
		///////////Init object ///////////////////////////////
		$mots_lv0031=new ts_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0012');
		$vReturn=$mots_lv0031->LV_InsertPO(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate);
		///Save object
		break;
		
}
?>
div3 = document.getElementById('txtlv903');
div3.focus();

