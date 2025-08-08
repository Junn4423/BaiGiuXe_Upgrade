<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0013.php");
require_once("../../clsall/tc_lv0020.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/hr_lv0038.php");
require_once("../../clsall/tc_lv0008.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/ml_lv0008.php");
require_once("../../clsall/ml_lv0009.php");
require_once("../../clsall/ml_lv0013.php");
require_once("../../clsall/ml_lv0100.php");
require_once("../../clsall/class.phpmailer.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$vNow=GetServerDate();
/////////////init object//////////////
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0020_ok=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0020->ArrTimeCordPush[2]='Mã chấm công';
$motc_lv0020->ArrTimeCordPush[3]='Tên';
$motc_lv0020->ArrTimeCordPush[4]='Phần trăm';
$motc_lv0020->ArrTimeCordPush[5]='Số giờ làm';
$motc_lv0020->ArrTimeCordPush[6]='Lương/một giờ';
$motc_lv0020->ArrTimeCordPush[7]='Lương theo giờ';
$motc_lv0020->ArrTimeCordPush[8]='Tổng lương theo giờ làm(1)';

$motc_lv0020->ArrTime1CordPush[2]='Mã sản phẩm';
$motc_lv0020->ArrTime1CordPush[3]='Tên';
$motc_lv0020->ArrTime1CordPush[4]='Loại';
$motc_lv0020->ArrTime1CordPush[5]='Số lượng';
$motc_lv0020->ArrTime1CordPush[6]='Phần trăm loại';
$motc_lv0020->ArrTime1CordPush[7]='Giá';
$motc_lv0020->ArrTime1CordPush[8]='Lương theo sản phẩm';
$motc_lv0020->ArrTime1CordPush[9]='Tổng lương theo sản phẩm(2)';


$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";	
	$vLangArr=GetLangFile("../../","SL0020.txt",$plang);
	
$motc_lv0020->lang=strtoupper($plang);

?>
<?php
if(1==1)
{
	switch($motc_lv0020->lv095)
	{
		case 4:
			break;
		case 5:
			include("report1-heso.php");
			break;
		case 6:
			include("report1-heso.php");
			break;
		case 7:
			include("report1-heso.php");
			break;

default:
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<style>
.line_td
{
	border-bottom:1px #000 solid;
	padding:5px;
}
</style>
</head>
<body  onkeyup="KeyPublicRun(event)">
<center>
<!--
<table cellpadding="0" cellspacing="0" border="0" width="760">
<tr>
						<td  colspan="5" rowspan="2"><img  src="http://sof.vn/SOF/logo.png"   border="0" height="80"/></td>
						<td width="1" align="right" valign="top"><?php echo ($motc_lv0020->lv023==1)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$motc_lv0020->lv001."'>":"";?></td>
  </tr>
<tr>
  <td align="right" valign="top"><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="90px" height="100px" 
								src="<?php echo "../../images/employees/".$mohr_lv0020->lv001."/".$mohr_lv0020->lv007; ?>" /></td>
</tr>
</table>
-->
<?php
echo $motc_lv0020_ok->LV_GetOnePerson($vlv001);
	?>
</center>
</body>
</html>
<?php
	}
}
?>