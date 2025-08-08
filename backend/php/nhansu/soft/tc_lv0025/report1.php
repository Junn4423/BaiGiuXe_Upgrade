<?php
session_start();
$vDir='../';
include($vDir."paras.php");
include($vDir."config.php");
include($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/tc_lv0014.php");
require_once("$vDir../clsall/hr_lv0044.php");
require_once("$vDir../clsall/hr_lv0042.php");
require_once("$vDir../clsall/hr_lv0020.php");
require_once("$vDir../clsall/hr_lv0026.php");
require_once("$vDir../clsall/hr_lv0038.php");


/////////////init object//////////////
$motc_lv0014=new tc_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0071');
$mohr_lv0044=new hr_lv0044($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0060');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
$mohr_lv0026=new hr_lv0026($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0047');
$mohr_lv0042=new hr_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0044');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
$motc_lv0014->lang=strtoupper($plang);
$mohr_lv0044->lang=strtoupper($plang);
$mohr_lv0042->lang=strtoupper($plang);
$mohr_lv0020->lang=strtoupper($plang);
$mohr_lv0026->lang=strtoupper($plang);
$vNow=GetServerDate();
$motc_lv0014->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","Tc0014.txt",$plang);
?>

<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
<?php
$strTemplate=$motc_lv0014->LV_LoadTemplate($vlv001);
$mohr_lv0044->LV_Load($motc_lv0014->lv002);
$mohr_lv0020->LV_Load($motc_lv0014->lv003);
$strTemplate=str_replace("@#01",$mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002,$strTemplate);
if($mohr_lv0020->lv018==0)
{
	$strTemplate=str_replace('@#94"','"',$strTemplate);
	$strTemplate=str_replace('@#95"','" checked',$strTemplate);
	$strTemplate=str_replace('@#26','Bà',$strTemplate);
	$strTemplate=str_replace('@#28','Bà',$strTemplate);
}
else
{
	$strTemplate=str_replace('@#95"','"',$strTemplate);
	$strTemplate=str_replace('@#94"','" checked',$strTemplate);
	$strTemplate=str_replace('@#26','Ông',$strTemplate);
	$strTemplate=str_replace('@#28','Ông',$strTemplate);
}
$strTemplate=str_replace('@#02',$mohr_lv0020->FormatView($mohr_lv0020->lv015,2),$strTemplate);
$strTemplate=str_replace('@#03',$mohr_lv0020->getvaluelink('lv023',$mohr_lv0020->lv023),$strTemplate);
$strTemplate=str_replace('@#04',$mohr_lv0020->getvaluelink('lv022',$mohr_lv0020->lv022),$strTemplate);
$strTemplate=str_replace('@#05',$mohr_lv0020->getvaluelink('lv032',$mohr_lv0020->lv032),$strTemplate);
$strTemplate=str_replace('@#06',$mohr_lv0020->lv034,$strTemplate);
$strTemplate=str_replace('@#07',$mohr_lv0020->getvaluelink('lv032',$mohr_lv0020->lv032),$strTemplate);
$strTemplate=str_replace('@#08',$mohr_lv0020->lv010,$strTemplate);
$strTemplate=str_replace('@#10',$mohr_lv0020->FormatView($mohr_lv0020->lv011,2),$strTemplate);
$strTemplate=str_replace('@#09',$mohr_lv0020->lv012,$strTemplate);
$strTemplate=str_replace('@#11',$motc_lv0014->getvaluelink('lv005',$motc_lv0014->lv005),$strTemplate);
$strTemplate=str_replace('@#12',getmonth($mohr_lv0044->lv005)."/".getyear($mohr_lv0044->lv005),$strTemplate);
$strTemplate=str_replace('@#13',getmonth($mohr_lv0044->lv005)."/".getyear($mohr_lv0044->lv005),$strTemplate);
$strTemplate=str_replace('@#14',$mohr_lv0020->lv005.",".$mohr_lv0020->getvaluelink('lv026',$mohr_lv0020->lv026).",".$mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029)."(".$mohr_lv0026->GetCompany().")",$strTemplate);

$strTemplate=str_replace('@#15',$motc_lv0014->FormatView($motc_lv0014->lv007,1),$strTemplate);
$strTemplate=str_replace('@#16',$motc_lv0014->FormatView($motc_lv0014->lv010,1),$strTemplate);
$strTemplate=str_replace('@#17',$motc_lv0014->FormatView($motc_lv0014->lv011,1),$strTemplate);
$strTemplate=str_replace('@#18',$motc_lv0014->FormatView($motc_lv0014->lv012,1),$strTemplate);
$strTemplate=str_replace('@#19',$motc_lv0014->FormatView($motc_lv0014->lv013,1),$strTemplate);
$strTemplate=str_replace('@#20','&nbsp;',$strTemplate);

$strTemplate=str_replace('@#27',$mohr_lv0020->lv004.' '.$mohr_lv0020->lv003.' '.$mohr_lv0020->lv002,$strTemplate);
$strTemplate=str_replace('@#29',$mohr_lv0020->lv004.' '.$mohr_lv0020->lv003.' '.$mohr_lv0020->lv002,$strTemplate);
$strTemplate=str_replace('@#22',getday($vNow),$strTemplate);
$strTemplate=str_replace('@#23',getmonth($vNow),$strTemplate);
$strTemplate=str_replace('@#24',getyear($vNow),$strTemplate);
$mohr_lv0026->lv002=$motc_lv0014->lv003;

$strTemplate=str_replace('<!--@99-->',$mohr_lv0026->LV_BuilListOther('lv003,lv005,lv004,lv007,lv008,lv009','document.frmchoose','chkAll','lvChk',0, 1000,$paging,'0,1,2,5,4,3,6,7,8'),$strTemplate);
$strTemplate=str_replace('@#25',$mohr_lv0026->GetCompany(),$strTemplate);


echo $strTemplate;
?>
</body>
</html>

