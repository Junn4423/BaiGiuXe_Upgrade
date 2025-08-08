<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0013.php");
require_once("../../clsall/tc_lv0097.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/hr_lv0038.php");
require_once("../../clsall/tc_lv0008.php");
require_once("../../clsall/tc_lv0009.php");

//$ma=$_GET['ma'];
$varr=explode("@",$_POST["txtID"]);
$vNow=GetServerDate();
/////////////init object//////////////
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0019');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0038');
$motc_lv0097=new tc_lv0097($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0097_ok=new tc_lv0097($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0013->LV_GetCal();
if($motc_lv0013->lv999!='' || $motc_lv0013->lv999!=NULL)
{
	$motc_lv0013->LV_LoadID($motc_lv0013->lv999);
}
else
	$motc_lv0013->LV_LoadActiveID();
$motc_lv0097->ArrTimeCordPush[2]='Mã chấm công';
$motc_lv0097->ArrTimeCordPush[3]='Tên';
$motc_lv0097->ArrTimeCordPush[4]='Phần trăm';
$motc_lv0097->ArrTimeCordPush[5]='Số giờ';
$motc_lv0097->ArrTimeCordPush[6]='Lương/một giờ';
$motc_lv0097->ArrTimeCordPush[7]='Lương theo giờ';
$motc_lv0097->ArrTimeCordPush[8]='Tổng lương theo giờ làm(1)';

$motc_lv0097->ArrTime1CordPush[2]='Mã sản phẩm';
$motc_lv0097->ArrTime1CordPush[3]='Tên';
$motc_lv0097->ArrTime1CordPush[4]='Loại';
$motc_lv0097->ArrTime1CordPush[5]='Số lượng';
$motc_lv0097->ArrTime1CordPush[6]='Phần trăm loại';
$motc_lv0097->ArrTime1CordPush[7]='Giá';
$motc_lv0097->ArrTime1CordPush[8]='Lương theo sản phẩm';
$motc_lv0097->ArrTime1CordPush[9]='Tổng lương theo sản phẩm(2)';


$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="CN";	
	$vLangArr=GetLangFile("../../","SL0020.txt",$plang);
	
$motc_lv0097->lang=strtoupper($plang);
?>
<?php
if($mohr_lv0020->GetRpt()==1)
{
	switch($motc_lv0097->lv030)
	{
		case 3:
			break;
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
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<style>
.right_style
{
	text-align:right;
}
.td_fontsmall
{
	font-size:9px;
}
p
{
	padding:3px;
	padding-top:6px;
	padding-bottom:6px;
	margin:0px;
}
</style>
</head>
<body style="background:#fff">
<center>
<div style="width:1020px">
<?php
$i=1;
$motc_lv0097_ok->NguoiKy=$_POST['qxtnguoiky'];
$mohr_lv0020->LV_LoadID($motc_lv0097_ok->NguoiKy); 
$motc_lv0097_ok->TenNguoiKy=$mohr_lv0020->lv002;
$vArrCodeTrue=Array();
foreach($varr as $vSalary)
{
if(trim($vSalary)!='')
{
   if($vArrCodeTrue[$vSalary]!=true)
   {	
   	$vArrCodeTrue[$vSalary]=true;

	$motc_lv0097->LV_LoadID($vSalary);
	$mohr_lv0038->LV_LoadID($motc_lv0097->lv021);
	$mohr_lv0020->LV_LoadID($motc_lv0097->lv002); 
?>
	<div style="float:left;width:489px;<?php echo ($i%6==1 || $i%6==2 || $i%6==3 || $i%6==4)?'border-bottom:2px #c3c3c3 dashed;':'';?>;padding-right:20px;padding-bottom:10px;padding-top:20px;">
	<div style="width:489px;">
<?php
	echo $motc_lv0097_ok->LV_GetOnePerson($motc_lv0097->lv001,$i);
?>
	
	</div>
	</div>
	<?php
	$i++;
	}
}
} 
	?>
</div>	
</center>
</body>
</html>
<?php
	}
}
?>