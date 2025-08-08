<?php
session_start();
$vDir='../';
include($vDir."paras.php");
include($vDir."config.php");
include($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/hr_lv0098.php");

/////////////init object//////////////
$mohr_lv0098=new hr_lv0098($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0098');
$mohr_lv0098->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","HR0201.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
<?php
echo $mohr_lv0098->LV_LoadTemplate($vlv001);
?>
</body>
</html>