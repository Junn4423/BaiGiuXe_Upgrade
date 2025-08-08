<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0013.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$vNow=GetServerDate();
/////////////init object//////////////
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0020.txt",$plang);
	
$motc_lv0013->lang=strtoupper($plang);
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
<?php
$motc_lv0013->LV_LoadID($vlv001);
$strTemplate=$motc_lv0013->lv009;
$strTemplate=str_replace('@#01',$motc_lv0013->GetCompany(),$strTemplate);
$strTemplate=str_replace('@#02',$motc_lv0013->GetAddress(),$strTemplate);
$strTemplate=str_replace('@#03',getmonth($motc_lv0013->lv005),$strTemplate);
$strTemplate=str_replace('@#04',getyear($motc_lv0013->lv005),$strTemplate);
$strTemplate=str_replace('@#35',getday($vNow),$strTemplate);
$strTemplate=str_replace('@#36',getmonth($vNow),$strTemplate);
$strTemplate=str_replace('@#37',getyear($vNow),$strTemplate);
//count asc
$strTemplate=str_replace('@#07',$motc_lv0013->FormatView($vArr[8],10),$strTemplate);
$strTemplate=str_replace('@#13',$motc_lv0013->FormatView($vArr[8],10),$strTemplate);
$strTemplate=str_replace('@#19',$motc_lv0013->FormatView($vArr[8],10),$strTemplate);
///salary desc
$strTemplate=str_replace('@#05',$motc_lv0013->FormatView((float)$vArr[5]+(float)$vArr[7],1),$strTemplate);
$strTemplate=str_replace('@#11',$motc_lv0013->FormatView((float)$vArr[5]+(float)$vArr[7],1),$strTemplate);
$strTemplate=str_replace('@#17',$motc_lv0013->FormatView((float)$vArr[5]+(float)$vArr[7],1),$strTemplate);
$strTemplate=str_replace('@#33',$motc_lv0013->FormatView((float)$vArr[5]+(float)$vArr[7],1),$strTemplate);

$strTemplate=str_replace('@#12',$motc_lv0013->FormatView(((float)$vArr[5]+(float)$vArr[7])*20/100,1),$strTemplate);
$strTemplate=str_replace('@#18',$motc_lv0013->FormatView(((float)$vArr[5]+(float)$vArr[7])*3/100,1),$strTemplate);
$strTemplate=str_replace('@#34',$motc_lv0013->FormatView(((float)$vArr[5]+(float)$vArr[7])*2/100,1),$strTemplate);
//salary asc
$strTemplate=str_replace('@#06',$motc_lv0013->FormatView($vArr[6],1),$strTemplate);
$strTemplate=str_replace('@#08',$motc_lv0013->FormatView($vArr[6],1),$strTemplate);
$strTemplate=str_replace('@#14',$motc_lv0013->FormatView($vArr[6],1),$strTemplate);
$strTemplate=str_replace('@#30',$motc_lv0013->FormatView($vArr[6],1),$strTemplate);
$strTemplate=str_replace('@#06',$motc_lv0013->FormatView($vArr[6],1),$strTemplate);
$strTemplate=str_replace('@#06',$motc_lv0013->FormatView($vArr[6],1),$strTemplate);

$strTemplate=str_replace('@#09',$motc_lv0013->FormatView(($vArr[6])*20/100,1),$strTemplate);
$strTemplate=str_replace('@#15',$motc_lv0013->FormatView(($vArr[6])*3/100,1),$strTemplate);
$strTemplate=str_replace('@#31',$motc_lv0013->FormatView(($vArr[6])*2/100,1),$strTemplate);
//count desc
$strTemplate=str_replace('@#10',$motc_lv0013->FormatView($vArr[9]+$vArr[10],10),$strTemplate);
$strTemplate=str_replace('@#16',$motc_lv0013->FormatView($vArr[9]+$vArr[10],10),$strTemplate);
$strTemplate=str_replace('@#32',$motc_lv0013->FormatView($vArr[9]+$vArr[10],10),$strTemplate);
/*$strTemplate=str_replace('@#07',$motc_lv0013->FormatView($vArr[3],1),$strTemplate);
$strTemplate=str_replace('@#09',$vArr[0],$strTemplate);
$strTemplate=str_replace('@#10',$motc_lv0013->FormatView($vArr[1],1),$strTemplate);
$strTemplate=str_replace('@#05',$motc_lv0013->FormatView($vArr[1],1),$strTemplate);
$strTemplate=str_replace('@#12',$vArr[0],$strTemplate);
$strTemplate=str_replace('@#13',$motc_lv0013->FormatView($vArr[1],1),$strTemplate);
$strTemplate=str_replace('@#08',$motc_lv0013->FormatView($vArr[1]*20/100,1),$strTemplate);
$strTemplate=str_replace('@#11',$motc_lv0013->FormatView($vArr[3]*3/100,1),$strTemplate);
$strTemplate=str_replace('@#14',$motc_lv0013->FormatView($vArr[1]*2/100,1),$strTemplate);
*/
$strTemplate=str_replace('<!--@#20-->',$motc_lv0013->LV_BuilListOtherEdit($motc_lv0013->lv001,2),$strTemplate);
$strTemplate=str_replace('<!--@#21-->',$motc_lv0013->LV_BuilListOtherEditIncrease($motc_lv0013->lv001,0,$motc_lv0013->lv011),$strTemplate);
$strTemplate=str_replace('<!--@#22-->',$motc_lv0013->LV_BuilListOtherEditDescrease($motc_lv0013->lv001,0,$motc_lv0013->lv011),$strTemplate);



echo $strTemplate;
?>
</body>
</html>
