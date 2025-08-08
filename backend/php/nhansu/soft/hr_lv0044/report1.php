<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0044.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$vNow=GetServerDate();
/////////////init object//////////////
$mohr_lv0044=new hr_lv0044($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0060');
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
$vArr=$mohr_lv0044->LV_LoadArr($vlv001,$mohr_lv0044->lv011);
$strTemplate=$mohr_lv0044->lv010;
$strTemplate=str_replace('@#01',$mohr_lv0044->GetCompany(),$strTemplate);
$strTemplate=str_replace('@#02',$mohr_lv0044->GetAddress(),$strTemplate);
$strTemplate=str_replace('@#03',getmonth($mohr_lv0044->lv005),$strTemplate);
$strTemplate=str_replace('@#04',getyear($mohr_lv0044->lv005),$strTemplate);
$strTemplate=str_replace('@#15',$mohr_lv0044->FormatView($vArr[0],10),$strTemplate);
$strTemplate=str_replace('@#16',$mohr_lv0044->FormatView($vArr[11],10),$strTemplate);
$strTemplate=str_replace('@#19',getday($vNow),$strTemplate);
$strTemplate=str_replace('@#18',getmonth($vNow),$strTemplate);
$strTemplate=str_replace('@#17',getyear($vNow),$strTemplate);
/*$strTemplate=str_replace('@#06',$vArr[2],$strTemplate);
$strTemplate=str_replace('@#07',$mohr_lv0044->FormatView(($vArr[3]+$vArr[16]+$vArr[17]+$vArr[18]+$vArr[19]),1),$strTemplate);
$strTemplate=str_replace('@#09',$vArr[0],$strTemplate);
$strTemplate=str_replace('@#10',$mohr_lv0044->FormatView($vArr[1]+$vArr[12]+$vArr[13]+$vArr[14]+$vArr[15],1),$strTemplate);*/
$strTemplate=str_replace('@#05',$mohr_lv0044->FormatView($vArr[1],1),$strTemplate);
$strTemplate=str_replace('@#20',$mohr_lv0044->FormatView($vArr[12],1),$strTemplate);
$strTemplate=str_replace('@#21',$mohr_lv0044->FormatView($vArr[13],1),$strTemplate);
$strTemplate=str_replace('@#22',$mohr_lv0044->FormatView($vArr[14],1),$strTemplate);
$strTemplate=str_replace('@#23',$mohr_lv0044->FormatView($vArr[15],1),$strTemplate);
$strTemplate=str_replace('@#24',$mohr_lv0044->FormatView($vArr[1]*$mohr_lv0044->lv014/100,1),$strTemplate);
/*$strTemplate=str_replace('@#12',$vArr[0],$strTemplate);
$strTemplate=str_replace('@#13',$mohr_lv0044->FormatView(($vArr[1]+$vArr[12]+$vArr[13]+$vArr[14]+$vArr[15]),1),$strTemplate);*/
$strTemplate=str_replace('@#08',$mohr_lv0044->FormatView(($vArr[3]+$vArr[16]+$vArr[17]+$vArr[18]+$vArr[19])*20/100,1),$strTemplate);
/*$strTemplate=str_replace('@#11',$mohr_lv0044->FormatView(($vArr[1]+$vArr[12]+$vArr[13]+$vArr[14]+$vArr[15])*3/100,1),$strTemplate);
$strTemplate=str_replace('@#14',$mohr_lv0044->FormatView(($vArr[1]+$vArr[12]+$vArr[13]+$vArr[14]+$vArr[15])*2/100,1),$strTemplate);*/
$strTemplate=str_replace('<!--@20-->',$mohr_lv0044->LV_BuilListOther01($mohr_lv0044->lv001,$mohr_lv0044->lv011),$strTemplate);


echo $strTemplate;
?>
</body>
</html>
