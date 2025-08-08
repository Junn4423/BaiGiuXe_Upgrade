<?php
session_start();
if($_SESSION['ERPSOFV2RUserID']=="" || $_SESSION['ERPSOFV2RUserID']==NULL)
{
	exit();
}
$vDir = "../";
include($vDir."config.php");
include($vDir."function.php");
include($vDir."paras.php");
$objid=$_GET['objid'];
$objvalue=$_GET['objvalue'];
$objtable=$_GET['objtable'];
$objfield=str_replace("@!","'",$_GET['objfield']);
$id2=$_GET['id2'];
$lvopt=(int)$_GET['lvopt'];
if(trim($objvalue)=="")
$lvsql="";
else
{
$lvsql="select lv001,$objfield lv002 from $objtable where lv001='$objvalue' ";
$lvResult = db_query($lvsql);
$row=db_fetch_array($lvResult);
		$strReturn=$row['lv002'];
}
switch($lvopt)
{
	case 1:
	require_once($vDir."../clsall/lv_controler.php");
	include($vDir."../clsall/sl_lv0001.php");
	$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
	$mosl_lv0001->LV_LoadID($id2);
	$strReturn=str_replace("@01",$mosl_lv0001->lv002,$strReturn);
	$strReturn=str_replace("@02",$mosl_lv0001->lv006,$strReturn);
	$strReturn=str_replace("@03",$mosl_lv0001->lv010,$strReturn);
	$strReturn=str_replace("@04",$mosl_lv0001->lv012,$strReturn);
	$strReturn=str_replace("@05",$mosl_lv0001->lv013,$strReturn);
	$strReturn=str_replace("@06",$mosl_lv0001->lv016,$strReturn);
	$strReturn=str_replace("@07",$mosl_lv0001->lv004,$strReturn);
	$strReturn=str_replace("@08",$mosl_lv0001->lv005,$strReturn);
	break;
	case 2:
		require_once("$vDir../clsall/lv_controler.php");
		require_once("$vDir../clsall/hr_lv0020.php");
		require_once("$vDir../clsall/hr_lv0042.php");
		$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
		$mohr_lv0042=new hr_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0042');
		$plang=$_GET['lang'];	
		$pHD=$_GET['HD'];
		if($plang=="") $plang="VN";	
		$vLangArr=GetLangFile($vDir."../","HR0162.txt",$plang);	
		$lvStartDate=recoverdate($_GET['StartDate'],$plang);
		$lvEndDate=recoverdate($_GET['EndDate'],$plang);
		$BasicSal=$mohr_lv0042->LV_LoadBasicSal($id2,$pHD);
		$mohr_lv0020->LV_LoadFullID($id2);
		$strReturn=str_replace("@#01",$vLangArr[(int)$mohr_lv0020->lv018],$strReturn);
		$strReturn=str_replace("@#45",$vLangArr[(int)$mohr_lv0020->lv018],$strReturn);
		$strReturn=str_replace("@#03",$mohr_lv0020->getvaluelink('lv022',$mohr_lv0020->lv022),$strReturn);
		$strReturn=str_replace("@#11",$mohr_lv0020->FormatView($mohr_lv0020->lv015,2),$strReturn);
		$strReturn=str_replace("@#12",$mohr_lv0020->lv016,$strReturn);
		$strReturn=str_replace("@#13",$mohr_lv0020->lv034,$strReturn);
		$strReturn=str_replace("@#14",$mohr_lv0020->getvaluelink('lv032',$mohr_lv0020->lv032),$strReturn);
		$strReturn=str_replace("@#15",$mohr_lv0020->lv010,$strReturn);
		$strReturn=str_replace("@#16",$mohr_lv0020->FormatView($mohr_lv0020->lv011,2),$strReturn);
		$strReturn=str_replace("@#17",$mohr_lv0020->lv012,$strReturn);
		$strReturn=str_replace("@#15",$mohr_lv0020->lv010,$strReturn);
		$strReturn=str_replace("@#16",$mohr_lv0020->FormatView($mohr_lv0020->lv011,2),$strReturn);
		$strReturn=str_replace("@#17",$mohr_lv0020->lv012,$strReturn);
		$strReturn=str_replace("@#18",$mohr_lv0020->lv020,$strReturn);
		$strReturn=str_replace("@#19",$mohr_lv0020->FormatView($mohr_lv0020->lv021,2),$strReturn);
		$strReturn=str_replace("@#20",$mohr_lv0020->lv043,$strReturn);
		$strReturn=str_replace("@#21",$mohr_lv0020->GetMonthStartEnd($lvStartDate,$lvEndDate),$strReturn);
		//$strReturn=str_replace("@#56",DATEDIFF($lvEndDate,$lvStartDate),$strReturn);
		$strReturn=str_replace("@#22",getday($lvStartDate),$strReturn);
		$strReturn=str_replace("@#23",getmonth($lvStartDate),$strReturn);
		$strReturn=str_replace("@#24",getyear($lvStartDate),$strReturn);
		$strReturn=str_replace("@#25",getday($lvEndDate),$strReturn);
		$strReturn=str_replace("@#26",getmonth($lvEndDate),$strReturn);
		$strReturn=str_replace("@#27",getyear($lvEndDate),$strReturn);
		$strReturn=str_replace("@#29",$mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029),$strReturn);
		$strReturn=str_replace("@#30",$mohr_lv0020->lv005,$strReturn);
		$strReturn=str_replace("@#31",$mohr_lv0020->getvaluelink('lv026',$mohr_lv0020->lv026),$strReturn);
		//TimeWork
		$strReturn=str_replace("@#32",$_GET['TimeWork'],$strReturn);
		//Basic Salary
		$strReturn=str_replace("@#33",$mohr_lv0020->FormatView($BasicSal,10),$strReturn);		
		///StartDate
		$strReturn=str_replace("@#47",getday($lvStartDate),$strReturn);
		$strReturn=str_replace("@#48",getmonth($lvStartDate),$strReturn);
		$strReturn=str_replace("@#49",getyear($lvStartDate),$strReturn);
		$strReturn=str_replace("@#50",getday($lvStartDate),$strReturn);
		$strReturn=str_replace("@#51",getmonth($lvStartDate),$strReturn);
		$strReturn=str_replace("@#52",getyear($lvStartDate),$strReturn);
		//Ma so thue
		$strReturn=str_replace("@#53",$mohr_lv0020->lv008,$strReturn);		
		//Nguyen quan
		$strReturn=str_replace("@#54",$mohr_lv0020->lv045,$strReturn);		
		//Trinh do
		$strReturn=str_replace("@#55",$mohr_lv0020->getvaluelink('lv028',$mohr_lv0020->lv028),$strReturn);
		//Chuyên môn
		$strReturn=str_replace("@#56",$mohr_lv0020->getvaluelink('lv042',$mohr_lv0020->lv042),$strReturn);	
		//Bật
		$strReturn=str_replace("@#57",$mohr_lv0020->getvaluelink('lv048',$mohr_lv0020->lv001),$strReturn);
		//BL CB
		$strReturn=str_replace("@#58",$mohr_lv0020->lv050,$strReturn);
		if($plang=="VN")
		{
			$strReturn=str_replace("@#02",$mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002,$strReturn);
			$strReturn=str_replace("@#46",$mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002,$strReturn);
		}
		else
		{
			$strReturn=str_replace("@#02",$mohr_lv0020->lv002." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv004,$strReturn);
			$strReturn=str_replace("@#46",$mohr_lv0020->lv002." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv004,$strReturn);
		}
		break;
	case 3:
	require_once($vDir."../clsall/lv_controler.php");
	include($vDir."../clsall/ts_lv0003.php");
	$mots_lv0003=new ts_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
	$mots_lv0003->LV_LoadID($id2);
	$strReturn=str_replace("@01",$mots_lv0003->lv002,$strReturn);
	$strReturn=str_replace("@02",$mots_lv0003->lv006,$strReturn);
	$strReturn=str_replace("@03",$mots_lv0003->lv010,$strReturn);
	$strReturn=str_replace("@04",$mots_lv0003->lv012,$strReturn);
	$strReturn=str_replace("@05",$mots_lv0003->lv013,$strReturn);
	$strReturn=str_replace("@06",$mots_lv0003->lv016,$strReturn);
	$strReturn=str_replace("@07",$mots_lv0003->lv004,$strReturn);
	$strReturn=str_replace("@08",$mots_lv0003->lv005,$strReturn);
	break;
	default:
		break;
}
$strReturn=str_replace("'","\'",$strReturn);
$strReturn=str_replace('"','\"',$strReturn);
$strReturn=str_replace("
","",$strReturn);
?>
if(confirm("Do you want to reload data?Y/N"))
{
tinyMCE.get('<?php echo $objid;?>').execCommand('mceInsertContent',true,'<?php echo $strReturn;?>');

}