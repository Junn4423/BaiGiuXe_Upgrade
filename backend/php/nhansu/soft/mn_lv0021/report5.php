<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");	
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0021.php");
require_once("../../clsall/wh_lv0022.php");
require_once("../../clsall/wh_lv0003.php");
require_once("../../clsall/cr_lv0324.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////

$mowh_lv0022=new wh_lv0022($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0022');
$mowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0021');
$mowh_lv0003=new wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
$mocr_lv0324=new cr_lv0324($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0024.txt",$plang);
$mowh_lv0021->lang=strtoupper($plang);
$mowh_lv0021->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0021->ArrPush[0]=$vLangArr[16];
$mowh_lv0021->ArrPush[1]=$vLangArr[18];
$mowh_lv0021->ArrPush[2]=$vLangArr[19];
$mowh_lv0021->ArrPush[3]=$vLangArr[20];
$mowh_lv0021->ArrPush[4]=$vLangArr[21];
$mowh_lv0021->ArrPush[5]=$vLangArr[22];
$mowh_lv0021->ArrPush[6]=$vLangArr[23];
$mowh_lv0021->ArrPush[7]=$vLangArr[24];
$mowh_lv0021->ArrPush[8]=$vLangArr[25];
$mowh_lv0021->ArrPush[9]=$vLangArr[26];
$mowh_lv0021->ArrPush[10]=$vLangArr[27];
$mowh_lv0021->ArrPush[11]=$vLangArr[28];
$mowh_lv0021->ArrPush[12]=$vLangArr[29];
$mowh_lv0021->ArrPush[13]=$vLangArr[30];
$mowh_lv0021->ArrPush[14]=$vLangArr[31];	
$mowh_lv0021->ArrPush[15]=$vLangArr[32];
$mowh_lv0021->ArrPush[24]=$vLangArr[41];
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12,13,5";
$vFieldList="lv005,lv007,lv008,lv010,lv014";
$mowh_lv0021->LV_LoadIDAmount($mowh_lv0021->lv001);
$mocr_lv0324->LV_LoadLanGiaoHang($mowh_lv0021->lv001,$_GET['LANGIAOHANG']);
$vSoTienThanhToan=0;
if($_GET['LANGIAOHANG']=='')
{
	$vSoTienThanhToan=round($mowh_lv0021->lv015,0);
}
else
{
	$vVAT=$mocr_lv0324->VATPMH;
	$vSoTienThanhToan=0;
	//% tiền
	//$mocr_lv0324->lv003
	//% VAT 
	//$mocr_lv0324->lv011
	//SỐ tiền
	if($mocr_lv0324->lv012>0)
	{
		$vSoTienThanhToan=$vSoTienThanhToan+$mocr_lv0324->lv012;
	}
	else
	{
		if($mocr_lv0324->lv003>0)
		{
			$vSoTienThanhToan=$vSoTienThanhToan+$mocr_lv0324->lv003*($mowh_lv0021->lv015-$vVAT)/100;
		}
	}
	if($mocr_lv0324->lv013>0)
	{
		$vSoTienThanhToan=$vSoTienThanhToan+$mocr_lv0324->lv013;
	}
	else
	{
		
		if($mocr_lv0324->lv011>0 && $vVAT>0)
		{
			$vSoTienThanhToan=$vSoTienThanhToan+$mocr_lv0324->lv011*$vVAT/100;
		}
	}
	
	
}
$mowh_lv0003->LV_LoadID($mowh_lv0021->lv002);
//$strParent=$mowh_lv0021->LV_BuilListReportOtherNew($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mowh_lv0022->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0026.txt",$plang);
$mowh_lv0022->ArrPush[0]=$vLangArr[17];
$mowh_lv0022->ArrPush[1]=$vLangArr[18];
$mowh_lv0022->ArrPush[2]=$vLangArr[19];
$mowh_lv0022->ArrPush[3]=$vLangArr[20];
$mowh_lv0022->ArrPush[4]=$vLangArr[21];
$mowh_lv0022->ArrPush[5]=$vLangArr[22];
$mowh_lv0022->ArrPush[6]=$vLangArr[23];
$mowh_lv0022->ArrPush[7]=$vLangArr[24]."@01";
$mowh_lv0022->ArrPush[8]=$vLangArr[25];
$mowh_lv0022->ArrPush[9]=$vLangArr[26];
$mowh_lv0022->ArrPush[10]=$vLangArr[27];
$mowh_lv0022->ArrPush[11]=$vLangArr[28];
$mowh_lv0022->ArrPush[12]=$vLangArr[29];
$mowh_lv0022->ArrPush[13]=$vLangArr[30];
$mowh_lv0022->ArrPush[14]=$vLangArr[41];
$mowh_lv0022->ArrPush[15]=$vLangArr[42];
$mowh_lv0022->ArrPush[16]=$vLangArr[38]."@01";
$mowh_lv0022->ArrPush[17]=$vLangArr[39]."@01";
$mowh_lv0022->ArrPush[18]=$vLangArr[26]."(@02%)";;
	

$mowh_lv0022->ArrFunc[0]='//Function';
$mowh_lv0022->ArrFunc[1]=$vLangArr[2];
$mowh_lv0022->ArrFunc[2]=$vLangArr[4];
$mowh_lv0022->ArrFunc[3]=$vLangArr[6];
$mowh_lv0022->ArrFunc[4]=$vLangArr[7];
$mowh_lv0022->ArrFunc[5]='';
$mowh_lv0022->ArrFunc[6]='';
$mowh_lv0022->ArrFunc[7]='';
$mowh_lv0022->ArrFunc[8]=$vLangArr[10];
$mowh_lv0022->ArrFunc[9]=$vLangArr[12];
$mowh_lv0022->ArrFunc[10]=$vLangArr[0];
$mowh_lv0022->ArrFunc[11]=$vLangArr[33];
$mowh_lv0022->ArrFunc[12]=$vLangArr[34];
$mowh_lv0022->ArrFunc[13]=$vLangArr[35];
$mowh_lv0022->ArrFunc[14]=$vLangArr[36];
$mowh_lv0022->ArrFunc[15]=$vLangArr[37];

////Other
$mowh_lv0022->ArrOther[1]=$vLangArr[31];
$mowh_lv0022->ArrOther[2]=$vLangArr[32];
if($plang=="") $plang="VN";
$vOrderList="1,2,3,7,8,9,10,11,12,3,4,5,13,14,15";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mowh_lv0022->lv002=$vlv001;
$vStrMessage="";
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("../../","CR0044.txt",$plang);
?>

<?php
if($mowh_lv0021->GetView()==1)
{
?>
<html>
<head>
<title><?php echo $mowh_lv0021->ArrPush[0];?></title>
<style>
.center_style
{
	text-align:center;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body  onkeyup="KeyPublicRun(event)" style="background-color:#fff!important">
<center>
<div style="width: 840px; text-align: justify;">
<table style="width: 100%;" border="0" cellspacing="1" cellpadding="1">
<tbody>
<tr>
    <td colspan="16" align="right"><?php echo (1==1)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mocr_lv0324->lv009."'>":"";?></td>
  </tr>	
<tr>
<td width="50%" height="30" valign="top">
<table style="width: 100%;" border="0" cellspacing="1" cellpadding="1">
<tbody>
<tr>
<td style="white-space:nowrap;" colspan="16" height="30" align="center">
<p style="margin: 0px; text-align: center;"><span style="font-size:18px;font-family:arial,times new roman;"><strong><span style="font-size:18px;font-family:arial,times new roman;">C&Ocirc;NG TY CP C&Ocirc;NG NGHỆ ĐẦU TƯ MINH PHƯƠNG</span></strong></span></p>
<strong><span style="font-size:18px;font-family:arial,times new roman;"> </span></strong></td>
</tr>
<tr>
<td style="text-align: left;" colspan="16" height="30"><span style="font-size:16px;font-family:arial,times new roman;">101 Ung Văn Khi&ecirc;m, P.25, Quận B&igrave;nh Thạnh, TP.HCM</span></td>
</tr>
<tr>
<td style="text-align: left;" colspan="16" height="30"><span style="font-size:16px;font-family:arial,times new roman;">ĐT: 0287 300 1497 </span></td>
</tr>
<tr>
<td colspan="16">&nbsp;</td>
</tr>
<tr>
<td colspan="16" height="28" align="left">
<p style="margin:0 0 10px 0;"><span style="font-size:18px;font-family:arial,times new roman;"><strong><span style="font-size:16px;font-family:arial,times new roman;">Số : <?php echo $mocr_lv0324->lv009;?></span></strong></span></p>
</td>
</tr>
</tbody>
</table>
</td>
<td width="50%" height="30">
<table style="width: 100%;" border="0" cellspacing="1" cellpadding="1">
<tbody>
<tr>
<td style="white-space:nowrap;" colspan="16" height="30" align="center">
<p style="margin:0;"><span style="font-size:18px;font-family:arial,times new roman;"><strong><span style="font-size:18px;font-family:arial,times new roman;">CỘNG H&Ograve;A X&Atilde; HỘI CHỦ NGHĨA VIỆT NAM</span></strong></span></p>
</td>
</tr>
<tr>
<td colspan="16" height="30" align="center">
<p style="margin:0;"><span style="font-size:18px;font-family:arial,times new roman;"><strong><span style="font-size:18px;font-family:arial,times new roman;">Độc Lập - Tự Do - Hạnh Ph&uacute;c</span></strong></span></p>
</td>
</tr>
<tr>
<td colspan="16" height="30" align="center">
<hr style="margin: 0; width: 180px; height: 1px; background: #000;" />
</td>
</tr>
<tr>
<td colspan="16">&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;" colspan="16" height="30"><span style="font-size: 16px;"><span style="font-size:16px;font-family:arial,times new roman;">TP.HCM, Ng&agrave;y <?php echo getday($mowh_lv0021->DateCurrent);?> th&aacute;ng <?php echo getmonth($mowh_lv0021->DateCurrent);?> năm <?php echo getyear($mowh_lv0021->DateCurrent);?></span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table style="width: 100%;" border="0" cellspacing="1" cellpadding="1">
<tbody>
<tr>
<td style="height: 17px;" colspan="16">&nbsp;</td>
</tr>
<tr>
<td colspan="16" height="28" align="center"><span style="font-size: 28px;font-family:arial,times new roman;"><strong>GIẤY ĐỀ NGHỊ TẠM ỨNG</strong></span></td>
</tr>
<tr>
<td style="height: 20px;" colspan="16">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="text-align: left;" colspan="16" height="28"><span style="font-size:16px;font-family:arial,times new roman;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>K&iacute;nh gửi:</strong></span></td>
</tr>
<tr>
<td colspan="16" height="28"><span style="font-size:16px;font-family:arial,times new roman;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Căn cứ theo Phiếu Mua H&agrave;ng số: <?php echo $mowh_lv0021->lv001;?>&nbsp;ng&agrave;y <?php echo $mowh_lv0021->FormatView($mowh_lv0021->lv004,2);?>&nbsp;giữa <?php echo $mowh_lv0003->lv002;?>&nbsp;v&agrave; C&ocirc;ng Ty Cổ Phần C&ocirc;ng Nghệ Đầu Tư Minh Phương.</span></td>
</tr>
<tr>
<td colspan="16" height="28"><span style="font-size:16px;font-family:arial,times new roman;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Số tiền đề nghị tạm ứng 
<?php
if($mocr_lv0324->lv011==0 && $mocr_lv0324->lv012==0 && $mocr_lv0324->lv013==0)
{
?>
<?php echo ($mocr_lv0324->lv003>0)?''.$mocr_lv0324->FormatView($mocr_lv0324->lv003,20).'% ':' ';?>
<?php
}
?>
cho nh&agrave; cung cấp: <?php echo $mowh_lv0022->FormatView($vSoTienThanhToan,20);?> VNĐ</span>
</td>
</tr>
<tr>
<td colspan="16"><span style="font-size:16px;font-family:arial,times new roman;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(Bằng chữ: <?php echo LNum2Text($vSoTienThanhToan,'VN');?>)</span></td>
</tr>
<tr>
<td colspan="16"><span style="font-size:16px;font-family:arial,times new roman;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; K&iacute;nh đề nghị C&ocirc;ng ty vui l&ograve;ng chuyển tiền v&agrave;o t&agrave;i khoản:</span></td>
</tr>
<tr>
<td colspan="6" width="10%">&nbsp;</td>
<td style="height: 28px; white-space: nowrap;" colspan="3" width="10%" align="left"><span style="font-size:16px;font-family:arial,times new roman;">- T&ecirc;n t&agrave;i khoản</span></td>
<td style="height: 28px; white-space: nowrap;" colspan="5" width="*%" align="left" valign="top"><span style="font-size:16px;font-family:arial,times new roman;">: <?php echo $mowh_lv0003->lv002;?></span></td>
<td colspan="2" width="10%"><br /></td>
</tr>
<tr>
<td colspan="6">&nbsp;</td>
<td style="height: 28px; white-space: nowrap;" colspan="3" height="28" align="left"><span style="font-size:16px;font-family:arial,times new roman;">- Số t&agrave;i khoản</span></td>
<td style="height: 28px; white-space: nowrap;" colspan="5" height="28" align="left"><span style="font-size:16px;font-family:arial,times new roman;">: <?php echo $mowh_lv0003->lv016;?></span></td>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="6">&nbsp;</td>
<td style="height: 28px; white-space: nowrap;" colspan="3"><span style="font-size:16px;font-family:arial,times new roman;">- Tại ng&acirc;n h&agrave;ng</span></td>
<td style="height: 28px; white-space: nowrap;" colspan="5"><span style="font-size:16px;font-family:arial,times new roman;">: <?php echo $mowh_lv0003->lv017;?></span></td>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="16">
<table style="font-size: 14px; width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;" colspan="2" height="28" valign="middle"><strong><span style="color: #000000;font-size:16px;font-family:arial,times new roman;">Người đề nghị</span></strong></td>
<td style="text-align: center;" valign="middle"><br /></td>
<td align="left" valign="middle"><strong><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></strong></td>
<td align="left" valign="middle"><strong><span style="color: #000000;font-size:12px;font-family:arial,times new roman;"><br /></span></strong></td>
<td style="text-align: center;" colspan="2" valign="middle"><span style="color: #000000;font-size:12px;font-family:arial,times new roman;"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><strong>Kế to&aacute;n trưởng</strong></span></span></td>
<td align="left" valign="middle"><strong><span style="color: #000000;font-size:12px;font-family:arial,times new roman;"><br /></span></strong></td>
<td colspan="2" align="center" valign="middle"><span style="color: #000000;font-size:12px;font-family:arial,times new roman;"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><strong>P.TGĐ</strong></span></span></td>
<td colspan="2" align="center" valign="middle"><span style="color: #000000;font-size:12px;font-family:arial,times new roman;"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><strong>TGĐ</strong></span></span></td>
</tr>
<tr>
<td height="12" align="left"><span style="color: #000000;font-size:12px;font-family:arial,times new roman;"><br /></span></td>
<td align="center"><strong><br /></strong></td>
<td align="left"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></td>
<td align="left"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
<td align="left"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
</tr>
<tr>
<td height="23" align="left"><span style="color: #000000;font-size:12px;font-family:arial,times new roman;"><br /></span></td>
<td align="center"><strong><br /></strong></td>
<td align="left"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></td>
<td align="left"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
<td align="left"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td height="23" align="left"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></td>
<td align="center"><strong><br /></strong></td>
<td align="left"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></td>
<td align="left"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></td>
<td align="center"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
<td align="left"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;"><br /></span></td>
<td align="center"><strong><br /></strong></td>
<td align="left"><strong><br /></strong></td>
<td align="center"><strong><br /></strong></td>
<td align="left"><strong><br /></strong></td>
<td align="left"><strong><br /></strong></td>
</tr>
<tr>
<td style="text-align: center;" colspan="2" height="24"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;">Sự Thị Lương</span></td>
<td style="text-align: center;"><br /></td>
<td align="left"><span style="color: #000000;font-size:12px;font-family:arial,times new roman;"><br /></span></td>
<td align="center"><strong><br /></strong></td>
<td colspan="2" align="center"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;">Nguyễn Thuỳ Trang</span></td>
<td align="center"><strong><br /></strong></td>
<td colspan="2" align="center"><span style="color: #000000;font-size:16px;font-family:arial,times new roman;">Trần Thị Phương Thảo</span></td>
<td style=" " colspan="2" align="center"><span style="font-family: arial, "><span style="color: #000000;font-size:16px;font-family:arial,times new roman;">Đỗ Minh Duy</span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</center>
</body>
</html>					
<?php
} else {
	include("../permit.php");
}
?>
