<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0031.php");
require_once("../../clsall/ts_lv0020.php");
require_once("../../clsall/ts_lv0009.php");
$vlWHID=$_GET['lv002'];	
$vlv005=$_GET['lv005'];	
$vlv006=$_GET['lv006'];	
$vDate=GetServerDate();
$vType=$_GET['Type'];	
switch($vType)
{
	case 'BANHANG':
		$mots_lv0031=new ts_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0012');
		$mots_lv0020=new ts_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0020');
		$mots_lv0031->objlot=$mots_lv0020;
		$vReturn=$mots_lv0031->LV_InsertCONTRACT(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate);	
?>
	alert('<?php echo $vReturn;?>');
<?php		
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
	case 'NHAPKHO':
		$mots_lv0009=new ts_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0009');
		$vReturn=$mots_lv0009->LV_InsertOutStockNoCondition($vlv006);
		///Save object
		break;
	case 'WEBOR':
///////////Init object ///////////////////////////////
		$mots_lv0031=new ts_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0012');
		$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
		$vReturn=$mots_lv0031->LV_InsertWEB(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv006,$vDate,$mosl_lv0007);
///Save object
}
?>
//alert('<?php echo $vReturn;?>');
div3 = document.getElementById('txtlv903');
div3.focus();

