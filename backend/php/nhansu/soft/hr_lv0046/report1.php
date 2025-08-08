<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0044.php");
require_once("../../clsall/hr_lv0046.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$vNow=GetServerDate();
/////////////init object//////////////
$mohr_lv0044=new hr_lv0044($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0060');
$mohr_lv0046=new hr_lv0046($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0072');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0020.txt",$plang);
	
$mohr_lv0044->lang=strtoupper($plang);
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
<?php
$mohr_lv0044->LV_LoadID($vlv001);
$strTemplate=$mohr_lv0044->lv008;
$strTemplate=str_replace('@#01',$mohr_lv0044->GetCompany(),$strTemplate);
$strTemplate=str_replace('@#02',getmonth($mohr_lv0044->lv005),$strTemplate);
$strTemplate=str_replace('@#03',FillNum(1+(int)((int)getmonth($mohr_lv0044->lv005)/3),2),$strTemplate);
$strTemplate=str_replace('@#04',getyear($mohr_lv0044->lv005),$strTemplate);
$strTemplate=str_replace('@#12',getday($vNow),$strTemplate);
$strTemplate=str_replace('@#13',getmonth($vNow),$strTemplate);
$strTemplate=str_replace('@#14',getyear($vNow),$strTemplate);
$strTemplate=str_replace('@#05',$vArr[0],$strTemplate);
$strTemplate=str_replace('@#06',$vArr[4],$strTemplate);
$strTemplate=str_replace('@#07',$mohr_lv0044->FormatView($vArr[1],1),$strTemplate);
$strTemplate=str_replace('@#08',$mohr_lv0044->GetCompany(),$strTemplate);
$strTemplate=str_replace('@#09',$mohr_lv0044->GetAddress(),$strTemplate);
$strTemplate=str_replace('@#10',$mohr_lv0044->GetPhone(),$strTemplate);
$strTemp=$mohr_lv0046->LV_BuilListOther($vlv001,0);
$strTemplate=str_replace('<!--@#20-->',$strTemp,$strTemplate);
$strTemp=$mohr_lv0046->LV_BuilListOther($vlv001,1);
$strTemplate=str_replace('<!--@#21-->',$strTemp,$strTemplate);
$strTemp=$mohr_lv0046->LV_BuilListOther($vlv001,2);
$strTemplate=str_replace('<!--@#22-->',$strTemp,$strTemplate);
echo $strTemplate;
?>
</body>
</html>
