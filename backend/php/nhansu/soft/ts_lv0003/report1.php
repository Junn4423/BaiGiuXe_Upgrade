<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0003.php");
require_once("../../clsall/hr_lv0020.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mots_lv0003=new ts_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0003');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'hr0020');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("../../","SL0020.txt",$plang);
$lvNow=GetServerDate();
$vStrMessage="";
?>

<?php
if($mots_lv0003->GetRpt()==1)
{
?>
<?php  
	$mots_lv0003->LV_LoadID($vlv001);		
	$mohr_lv0020->LV_LoadID(getInfor($_SESSION['ERPSOFV2RUserID'],2));	
	?>
<html>
<head>
<title><?php echo $mots_lv0003->lv002;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	
	<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".$mots_lv0003->lv001."'>";?></td>
  </tr>	
  <tr>
    <td align="center" onDblClick="this.innerHTML=''"><img  src="<?php echo $mots_lv0003->GetLogo();?>" /></td>
  </tr>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''"><div>
    <div style="float:left;text-align:left;width:50%"><strong><?php echo $mots_lv0003->lv002;?></strong><br><?php echo $vLangArr1[39];?>: <?php echo $mots_lv0003->lv006;?><br>

<?php echo $vLangArr1[40];?>: <?php echo $mots_lv0003->lv010;?> <?php echo $vLangArr1[41];?>: <?php echo $mots_lv0003->lv012;?><br> Người liên hệ: <?php echo $mots_lv0003->lv003;?></div><div style="float:right;text-align:right"><strong><?php echo $mots_lv0003->GetCompany();?></strong><br><?php echo $vLangArr1[39];?>: <?php echo $mots_lv0003->GetAddress();?>
<br><?php echo $vLangArr1[40];?>: <?php echo $mots_lv0003->GetPhone();?>   <?php echo $vLangArr1[41];?>: <?php echo $mots_lv0003->GetFax();?> <br> 
<?php echo $vLangArr1[42];?>: <a href="<?php echo $mots_lv0003->GetWeb();?>" target="_blank"><?php echo $mots_lv0003->GetWeb();?></a></div>
    </div></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><font style="font-size:22px;"><strong><?php echo 'GIẤY GIỚI THIỆU';?></strong></font></td>
  </tr>
 <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="line-height:30px"><?php 
	$PreName='Chị';
	$FullName=$mohr_lv0020->lv004.' '.$mohr_lv0020->lv003.' '.$mohr_lv0020->lv002;
	echo $mots_lv0003->GetCompany().' trân trọng giới thiệu';
	echo '<br>';
	if($mohr_lv0020->lv018==1)
	$PreName='Anh';
	echo $PreName.": ";
	echo $FullName;
	echo "<br>";
	echo 'Chức vụ: ';
	echo $mohr_lv0020->lv005;
	echo "<br>";
	echo "Được cử  đến ".$mots_lv0003->lv002." để làm việc do công ty phân công.";
	echo '<br>';
	echo 'Đề nghị Quý Cơ Quan hết sức giúp đỡ cho '.$PreName.': '.$FullName.' sớm hoàn thành nhiệm vụ được giao<br>
Trân trọng gửi đến Quý Công ty  lời chân thành cám ơn!
';
	?></td>
  </tr>
    <tr>
    <td align="right"><?php echo 'TP.HCM ngày '.getday($lvNow).' tháng '.getmonth($lvNow).' năm '.getyear($lvNow).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?></td>
  </tr>
  <tr>
    <td align="right" ><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="250">&nbsp;</td>
						<td width="243">&nbsp;</td>
						<td width="217">&nbsp;</td>
						<td width="20">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $mots_lv0003->lv002;?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $mots_lv0003->GetCompany();?></b></span></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
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
