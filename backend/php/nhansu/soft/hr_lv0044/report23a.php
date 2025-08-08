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
$strTemplate=$mohr_lv0044->lv009;
$strTemplate=str_replace('@#01',$mohr_lv0044->GetCompany(),$strTemplate);
$strTemplate=str_replace('@#02',$mohr_lv0044->GetAddress(),$strTemplate);
$strTemplate=str_replace('@#03',getmonth($mohr_lv0044->lv005),$strTemplate);
$strTemplate=str_replace('@#04',getyear($mohr_lv0044->lv005),$strTemplate);
$strTemplate=str_replace('@#35',getday($vNow),$strTemplate);
$strTemplate=str_replace('@#36',getmonth($vNow),$strTemplate);
$strTemplate=str_replace('@#37',getyear($vNow),$strTemplate);
//count asc
$strTemplate=str_replace('@#07',$mohr_lv0044->FormatView($vArr[8],10),$strTemplate);
$strTemplate=str_replace('@#13',$mohr_lv0044->FormatView($vArr[8],10),$strTemplate);
$strTemplate=str_replace('@#19',$mohr_lv0044->FormatView($vArr[8],10),$strTemplate);
//count this insurance
$strTemplate=str_replace('@#74',$mohr_lv0044->FormatView($vArr[0],10),$strTemplate);
$strTemplate=str_replace('@#80',$mohr_lv0044->FormatView($vArr[0],10),$strTemplate);
$strTemplate=str_replace('@#86',$mohr_lv0044->FormatView($vArr[0],10),$strTemplate);
//sum this insurance
$strTemplate=str_replace('@#75',$mohr_lv0044->FormatView($vArr[1]+$vArr[12]+$vArr[13]+$vArr[14]+$vArr[15],10),$strTemplate);
$strTemplate=str_replace('@#81',$mohr_lv0044->FormatView($vArr[1]+$vArr[12]+$vArr[13]+$vArr[14]+$vArr[15],10),$strTemplate);
$strTemplate=str_replace('@#87',$mohr_lv0044->FormatView($vArr[1]+$vArr[12]+$vArr[13]+$vArr[14]+$vArr[15],10),$strTemplate);
//pay this insurance
$strTemplate=str_replace('@#76',$mohr_lv0044->FormatView(($vArr[1]+$vArr[12]+$vArr[13]+$vArr[14]+$vArr[15])*$mohr_lv0044->lv012/100,10),$strTemplate);
$strTemplate=str_replace('@#82',$mohr_lv0044->FormatView(($vArr[1]+$vArr[12]+$vArr[13]+$vArr[14]+$vArr[15])*$mohr_lv0044->lv013/100,10),$strTemplate);
$strTemplate=str_replace('@#88',$mohr_lv0044->FormatView(($vArr[1]+$vArr[12]+$vArr[13]+$vArr[14]+$vArr[15])*$mohr_lv0044->lv014/100,10),$strTemplate);
//count pre insurance
$strTemplate=str_replace('@#71',$mohr_lv0044->FormatView($vArr[33],10),$strTemplate);
$strTemplate=str_replace('@#77',$mohr_lv0044->FormatView($vArr[33],10),$strTemplate);
$strTemplate=str_replace('@#83',$mohr_lv0044->FormatView($vArr[33],10),$strTemplate);
//sum pre insurance
$strTemplate=str_replace('@#72',$mohr_lv0044->FormatView($vArr[34]+$vArr[35]+$vArr[36]+$vArr[37]+$vArr[38],10),$strTemplate);
$strTemplate=str_replace('@#78',$mohr_lv0044->FormatView($vArr[34]+$vArr[35]+$vArr[36]+$vArr[37]+$vArr[38],10),$strTemplate);
$strTemplate=str_replace('@#84',$mohr_lv0044->FormatView($vArr[34]+$vArr[35]+$vArr[36]+$vArr[37]+$vArr[38],10),$strTemplate);
//pay pre insurance
$strTemplate=str_replace('@#73',$mohr_lv0044->FormatView(($vArr[34]+$vArr[35]+$vArr[36]+$vArr[37]+$vArr[38])*$mohr_lv0044->lv012/100,10),$strTemplate);
$strTemplate=str_replace('@#79',$mohr_lv0044->FormatView(($vArr[34]+$vArr[35]+$vArr[36]+$vArr[37]+$vArr[38])*$mohr_lv0044->lv013/100,10),$strTemplate);
$strTemplate=str_replace('@#85',$mohr_lv0044->FormatView(($vArr[34]+$vArr[35]+$vArr[36]+$vArr[37]+$vArr[38])*$mohr_lv0044->lv014/100,10),$strTemplate);
///salary desc
$strTemplate=str_replace('@#06',$mohr_lv0044->FormatView((float)$vArr[5]+(float)$vArr[7],1),$strTemplate);
$strTemplate=str_replace('@#11',$mohr_lv0044->FormatView((float)$vArr[5]+(float)$vArr[7]+(float)$vArr[20]+(float)$vArr[21]+(float)$vArr[$mohr_lv0044->lv012]+(float)$vArr[23],1),$strTemplate);
$strTemplate=str_replace('@#17',$mohr_lv0044->FormatView((float)$vArr[5]+(float)$vArr[7]+(float)$vArr[20]+(float)$vArr[21]+(float)$vArr[$mohr_lv0044->lv012]+(float)$vArr[23],1),$strTemplate);
$strTemplate=str_replace('@#33',$mohr_lv0044->FormatView((float)$vArr[5]+(float)$vArr[7]+(float)$vArr[20]+(float)$vArr[21]+(float)$vArr[$mohr_lv0044->lv012]+(float)$vArr[23],1),$strTemplate);

$strTemplate=str_replace('@#12',$mohr_lv0044->FormatView(((float)$vArr[5]+(float)$vArr[7]+(float)$vArr[20]+(float)$vArr[21]+(float)$vArr[$mohr_lv0044->lv012]+(float)$vArr[23])*$mohr_lv0044->lv012/100,1),$strTemplate);
$strTemplate=str_replace('@#18',$mohr_lv0044->FormatView(((float)$vArr[5]+(float)$vArr[7]+(float)$vArr[20]+(float)$vArr[21]+(float)$vArr[$mohr_lv0044->lv012]+(float)$vArr[23])*$mohr_lv0044->lv013/100,1),$strTemplate);
$strTemplate=str_replace('@#34',$mohr_lv0044->FormatView(((float)$vArr[5]+(float)$vArr[7]+(float)$vArr[20]+(float)$vArr[21]+(float)$vArr[$mohr_lv0044->lv012]+(float)$vArr[23])*$mohr_lv0044->lv014/100,1),$strTemplate);
//salary asc	
$strTemplate=str_replace('@#05',$mohr_lv0044->FormatView((float)$vArr[6],1),$strTemplate);
$strTemplate=str_replace('@#08',$mohr_lv0044->FormatView((float)$vArr[6]+(float)$vArr[32]+(float)$vArr[24]+(float)$vArr[25]+(float)$vArr[26]+(float)$vArr[27],1),$strTemplate);
$strTemplate=str_replace('@#14',$mohr_lv0044->FormatView((float)$vArr[6]+(float)$vArr[32]+(float)$vArr[28]+(float)$vArr[29]+(float)$vArr[30]+(float)$vArr[31],1),$strTemplate);
$strTemplate=str_replace('@#30',$mohr_lv0044->FormatView((float)$vArr[6]+(float)$vArr[32]+(float)$vArr[28]+(float)$vArr[29]+(float)$vArr[30]+(float)$vArr[31],1),$strTemplate);

$strTemplate=str_replace('@#09',$mohr_lv0044->FormatView(($vArr[6]+(float)$vArr[32]+(float)$vArr[24]+(float)$vArr[25]+(float)$vArr[26]+(float)$vArr[27])*$mohr_lv0044->lv012/100,1),$strTemplate);
$strTemplate=str_replace('@#15',$mohr_lv0044->FormatView(($vArr[6]+(float)$vArr[32]+(float)$vArr[28]+(float)$vArr[29]+(float)$vArr[30]+(float)$vArr[31])*$mohr_lv0044->lv013/100,1),$strTemplate);
$strTemplate=str_replace('@#31',$mohr_lv0044->FormatView(($vArr[6]+(float)$vArr[32]+(float)$vArr[28]+(float)$vArr[29]+(float)$vArr[30]+(float)$vArr[31])*$mohr_lv0044->lv014/100,1),$strTemplate);
//count desc
$strTemplate=str_replace('@#10',$mohr_lv0044->FormatView($vArr[9]+$vArr[10],10),$strTemplate);
$strTemplate=str_replace('@#16',$mohr_lv0044->FormatView($vArr[9]+$vArr[10],10),$strTemplate);
$strTemplate=str_replace('@#32',$mohr_lv0044->FormatView($vArr[9]+$vArr[10],10),$strTemplate);
////Load sum other 
$strTemplate=str_replace('@#60',$mohr_lv0044->FormatView($vArr[20],10),$strTemplate);
$strTemplate=str_replace('@#61',$mohr_lv0044->FormatView($vArr[21],10),$strTemplate);
$strTemplate=str_replace('@#62',$mohr_lv0044->FormatView($vArr[$mohr_lv0044->lv012],10),$strTemplate);
$strTemplate=str_replace('@#63',$mohr_lv0044->FormatView($vArr[23],10),$strTemplate);
$strTemplate=str_replace('@#50',$mohr_lv0044->FormatView($vArr[28],10),$strTemplate);
$strTemplate=str_replace('@#51',$mohr_lv0044->FormatView($vArr[29],10),$strTemplate);
$strTemplate=str_replace('@#52',$mohr_lv0044->FormatView($vArr[30],10),$strTemplate);
$strTemplate=str_replace('@#53',$mohr_lv0044->FormatView($vArr[31],10),$strTemplate);
/*$strTemplate=str_replace('@#07',$mohr_lv0044->FormatView($vArr[3],1),$strTemplate);
$strTemplate=str_replace('@#09',$vArr[0],$strTemplate);
$strTemplate=str_replace('@#10',$mohr_lv0044->FormatView($vArr[1],1),$strTemplate);
$strTemplate=str_replace('@#05',$mohr_lv0044->FormatView($vArr[1],1),$strTemplate);
$strTemplate=str_replace('@#12',$vArr[0],$strTemplate);
$strTemplate=str_replace('@#13',$mohr_lv0044->FormatView($vArr[1],1),$strTemplate);
$strTemplate=str_replace('@#08',$mohr_lv0044->FormatView($vArr[1]*20/100,1),$strTemplate);
$strTemplate=str_replace('@#11',$mohr_lv0044->FormatView($vArr[3]*3/100,1),$strTemplate);
$strTemplate=str_replace('@#14',$mohr_lv0044->FormatView($vArr[1]*$mohr_lv0044->lv014/100,1),$strTemplate);
*/
$strTemplate=str_replace('<!--@#20-->',$mohr_lv0044->LV_BuilListOtherEdit($mohr_lv0044->lv001,2,$mohr_lv0044->lv011,$mohr_lv0044->FormatView($mohr_lv0044->lv012+$mohr_lv0044->lv013+$mohr_lv0044->lv014,10)),$strTemplate);
$strTemplate=str_replace('<!--@#70-->',$mohr_lv0044->LV_BuilListOtherEditAdd($mohr_lv0044->lv001,0,$mohr_lv0044->lv011,$mohr_lv0044->FormatView($mohr_lv0044->lv012+$mohr_lv0044->lv013+$mohr_lv0044->lv014,10)),$strTemplate);
$strTemplate=str_replace('<!--@#21-->',$mohr_lv0044->LV_BuilListOtherEditIncrease($mohr_lv0044->lv001,0,$mohr_lv0044->lv011,$mohr_lv0044->FormatView($mohr_lv0044->lv012+$mohr_lv0044->lv013+$mohr_lv0044->lv014,10)),$strTemplate);
$strTemplate=str_replace('<!--@22-->',$mohr_lv0044->LV_BuilListOtherEditDescrease($mohr_lv0044->lv001,0,$mohr_lv0044->lv011,$mohr_lv0044->FormatView($mohr_lv0044->lv012+$mohr_lv0044->lv013+$mohr_lv0044->lv014,10)),$strTemplate);



echo $strTemplate;
?>
</body>
</html>
