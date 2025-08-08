<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");	
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0001.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/wh_lv0021.php");
require_once("../../clsall/wh_lv0022.php");
require_once("../../clsall/wh_lv0003.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mohr_lv0001=new hr_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0001');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$mowh_lv0022=new wh_lv0022($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0022');
$mowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0022');
$mowh_lv0003=new wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0024.txt",$plang);
$mohr_lv0001->LV_Load();		

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
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12,13";
$mowh_lv0021->DefaultFieldList="lv001,lv004,lv005,lv007,lv013,lv010,lv008";
$vFieldList="lv001,lv004,lv005,lv007,lv008,lv013,lv010";
$mowh_lv0021->LV_LoadID($mowh_lv0021->lv001);
$mohr_lv0020->LV_LoadID($mowh_lv0021->lv010);
$strParent=$mowh_lv0021->LV_BuilListReportOtherNew($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);

$vTienTe=$mowh_lv0021->getvaluelink('lv016',$mowh_lv0021->lv016);

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
$mowh_lv0022->ArrPush[7]=$vLangArr[24]." $vTienTe";
$mowh_lv0022->ArrPush[8]=$vLangArr[25];
$mowh_lv0022->ArrPush[9]=$vLangArr[26];
$mowh_lv0022->ArrPush[10]=$vLangArr[27];
$mowh_lv0022->ArrPush[11]=$vLangArr[28];
$mowh_lv0022->ArrPush[12]='Mô tả';
$mowh_lv0022->ArrPush[55]='Thành tiền';
$mowh_lv0022->ArrPush[13]=$vLangArr[30];
$mowh_lv0022->ArrPush[14]=$vLangArr[41];
$mowh_lv0022->ArrPush[15]=$vLangArr[42];
$mowh_lv0022->ArrPush[16]=$vLangArr[38]." $vTienTe";
$mowh_lv0022->ArrPush[17]=$vLangArr[39]." $vTienTe";
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
	<?php  
	$mowh_lv0021->LV_LoadID($vlv001);
	$mowh_lv0003->LV_LoadID($mowh_lv0021->lv002);
	if($mowh_lv0021->lv006>0 || $mowh_lv0021->lv006==-1)
	$vFieldList="lv003,lv011,lv004,lv005,lv006,lv007,lv015";
	else
	$vFieldList="lv003,lv011,lv004,lv005,lv006,lv007,lv015";
	$mowh_lv0022->DefaultFieldList="lv003,lv011,lv004,lv005,lv006,lv007,lv015";
	 $strDetail=$mowh_lv0022->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mowh_lv0021->lv006);

			
	
	?>
	<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mowh_lv0021->lv011>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mowh_lv0021->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center">
	<table style="font-size:14px;font-family:arial, times new roman;" border="0" cellspacing="0">
<colgroup width="192"></colgroup><colgroup width="213"></colgroup><colgroup width="116"></colgroup><colgroup width="84"></colgroup><colgroup width="164"></colgroup><colgroup width="144"></colgroup><colgroup width="84"></colgroup> 
<tbody>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="7" height="22" align="left" valign="bottom"><strong>C&Ocirc;NG TY CỔ PHẦN C&Ocirc;NG NGHỆ ĐẦU TƯ MINH PHƯƠNG</strong><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="7" height="22" align="left" valign="bottom"><span style="color: #000000;">Trụ sở ch&iacute;nh: 101 Ung Văn Khi&ecirc;m, P.25, Q.B&igrave;nh Thạnh, TP.HCM</span><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="7" height="22" align="left" valign="bottom"><span style="color: #000000;">(Địa chỉ giao nhận h&agrave;ng h&oacute;a &amp; chứng từ: Load địa chỉ lv theo th&ocirc;ng tin người đề nghị MH</span><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="7" height="22" align="left" valign="bottom"><span style="color: #000000;">T&ecirc;n người li&ecirc;n hệ: <?php echo $mohr_lv0020->lv004;?> <?php echo (trim($mohr_lv0020->lv037)!='')?'SĐT: '.$mohr_lv0020->lv037:'';?> <?php echo (trim($mohr_lv0020->lv040)!='')?'Email: '.$mohr_lv0020->lv040:'';?></span><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="7" height="22" align="left" valign="bottom"><span style="color: #000000;"></span><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="7" height="47" align="center" valign="bottom"><strong><span style="color: #000000;font-size:28px;font-family:arial, times new roman;;">ĐƠN ĐẶT H&Agrave;NG</span></strong></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="4" height="22" align="left" valign="bottom"><span style="color: #000000;">T&ecirc;n Nh&agrave; cung cấp: <?php echo $mowh_lv0003->lv002;?></span><span style="color: #000000;"></span></td>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="3" align="left" valign="bottom"><span style="color: #000000;">Ng&agrave;y mua h&agrave;ng: <?php echo $mowh_lv0021->FormatView($mowh_lv0021->lv004,2);?></span><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="4" height="22" align="left" valign="bottom"><span style="color: #000000;">Địa chỉ: <?php echo $mowh_lv0003->lv006;?></span><span style="color: #000000;"></span></td>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="3" align="left" valign="bottom"><span style="color: #000000;">Phiếu mua h&agrave;ng: <?php echo $mowh_lv0021->lv001;?></span><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="4" height="22" align="left" valign="bottom"><span style="color: #000000;">Số t&agrave;i khoản: <?php echo $mowh_lv0003->lv016;?>  NH <?php echo $mowh_lv0003->lv019;?></span><span style="color: #000000;"></span></td>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="3" align="left" valign="bottom"><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="4" height="22" align="left" valign="bottom"><span style="color: #000000;">T&ecirc;n t&agrave;i khoản: <?php echo $mowh_lv0003->lv020;?></span><span style="color: #000000;"></span></td>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="3" align="left" valign="bottom"><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="4" height="22" align="left" valign="bottom"><span style="color: #000000;">T&ecirc;n người li&ecirc;n hệ: <?php echo $mowh_lv0003->lv003;?></span><span style="color: #000000;"></span></td>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="3" align="left" valign="bottom"><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="4" height="22" align="left" valign="bottom"><span style="color: #000000;">Số điện thoại: <?php echo $mowh_lv0003->lv015;?></span><span style="color: #000000;"></span></td>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="3" align="left" valign="bottom"><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="4" height="22" align="left" valign="bottom"><span style="color: #000000;">E-mail: <?php echo $mowh_lv0003->lv010;?></span><span style="color: #000000;"></span></td>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="3" align="left" valign="bottom"><span style="color: #000000;"></span></td>
</tr>
<tr>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="4" height="22" align="left" valign="bottom"><span style="color: #000000;">Nội dung: <?php echo $mowh_lv0021->lv104;?></span><span style="color: #000000;"></span></td>
<td style="font-size:14px;font-family:arial, times new roman;" colspan="3" align="left" valign="bottom"><span style="color: #000000;"></span></td>
</tr>
</tbody>
</table>	
    <!-- -------Header ------------------>
	<table width="1024" border="0" cellspacing="0" cellpadding="0" align="center">
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $strDetail;?></td>
  </tr>
  
  <tr>
    <td align="left" ><?php //echo $mowh_lv0021->lv009;;?></td>
  </tr>
  <tr>
    <td align="right" ><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="1%">&nbsp;</td>
						<td width="20%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="20%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="20%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo 'Người đề nghị';//$mowh_lv0021->getvaluelink('lv002',$mowh_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo 'Trưởng bộ phận';//$mowh_lv0021->getvaluelink('lv002',$mowh_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo 'Tổng Giám đốc';//$mowh_lv0021->getvaluelink('lv002',$mowh_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="120px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php echo GetUserName($mowh_lv0021->lv010,$plang);// for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<40; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<40; $i++) echo ".";?></td>
						<td>&nbsp;</td>						
					</tr>
				</table></td>
  </tr>
</table>
</body>
</html>					
<?php
} else {
	include("../permit.php");
}
?>
