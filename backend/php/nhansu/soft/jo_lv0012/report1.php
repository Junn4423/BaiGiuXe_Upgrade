<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/jo_lv0012.php");
require_once("../../clsall/hr_lv0020.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mojo_lv0012=new jo_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'hr0020');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("../../","JO0005.txt",$plang);
$lvNow=GetServerDate();
$vStrMessage="";
?>

<?php
if($mojo_lv0012->GetRpt()==1)
{
?>
<?php  
	$mojo_lv0012->LV_LoadID($vlv001);		
	$mohr_lv0020->LV_LoadID(getInfor($_SESSION['ERPSOFV2RUserID'],2));	
	?>
<html>
<head>
<title><?php echo $mojo_lv0012->lv002;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
	
	<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".$mojo_lv0012->lv001."'>";?></td>
  </tr>	
  <tr>
    <td align="center" onDblClick="this.innerHTML=''"><img  src="<?php echo $mojo_lv0012->GetLogo();?>" /></td>
  </tr>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''"><div>
    <div style="float:left;text-align:left;width:50%"><strong><?php echo $mojo_lv0012->lv002;?></strong><br><?php echo $vLangArr1[39];?>: <?php echo $mojo_lv0012->lv006;?><br>

<?php echo $vLangArr1[40];?>: <?php echo $mojo_lv0012->lv010;?> <?php echo $vLangArr1[41];?>: <?php echo $mojo_lv0012->lv012;?><br> NgÆ°á»�i liÃªn há»‡: <?php echo $mojo_lv0012->lv003;?></div><div style="float:right;text-align:right"><strong><?php echo $mojo_lv0012->GetCompany();?></strong><br><?php echo $vLangArr1[39];?>: <?php echo $mojo_lv0012->GetAddress();?>
<br><?php echo $vLangArr1[40];?>: <?php echo $mojo_lv0012->GetPhone();?>   <?php echo $vLangArr1[41];?>: <?php echo $mojo_lv0012->GetFax();?> <br> 
<?php echo $vLangArr1[42];?>: <a href="<?php echo $mojo_lv0012->GetWeb();?>" target="_blank"><?php echo $mojo_lv0012->GetWeb();?></a></div>
    </div></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><font style="font-size:22px;"><strong><?php echo 'GIáº¤Y GIá»šI THIá»†U';?></strong></font></td>
  </tr>
 <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="line-height:30px"><?php 
	$PreName='Chá»‹';
	$FullName=$mohr_lv0020->lv004.' '.$mohr_lv0020->lv003.' '.$mohr_lv0020->lv002;
	echo $mojo_lv0012->GetCompany().' trÃ¢n trá»�ng giá»›i thiá»‡u';
	echo '<br>';
	if($mohr_lv0020->lv018==1)
	$PreName='Anh';
	echo $PreName.": ";
	echo $FullName;
	echo "<br>";
	echo 'Chá»©c vá»¥: ';
	echo $mohr_lv0020->lv005;
	echo "<br>";
	echo "Ä�Æ°á»£c cá»­  Ä‘áº¿n ".$mojo_lv0012->lv002." Ä‘á»ƒ lÃ m viá»‡c do cÃ´ng ty phÃ¢n cÃ´ng.";
	echo '<br>';
	echo 'Ä�á»� nghá»‹ QuÃ½ CÆ¡ Quan háº¿t sá»©c giÃºp Ä‘á»¡ cho '.$PreName.': '.$FullName.' sá»›m hoÃ n thÃ nh nhiá»‡m vá»¥ Ä‘Æ°á»£c giao<br>
TrÃ¢n trá»�ng gá»­i Ä‘áº¿n QuÃ½ CÃ´ng ty  lá»�i chÃ¢n thÃ nh cÃ¡m Æ¡n!
';
	?></td>
  </tr>
    <tr>
    <td align="right"><?php echo 'TP.HCM ngÃ y '.getday($lvNow).' thÃ¡ng '.getmonth($lvNow).' nÄƒm '.getyear($lvNow).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?></td>
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
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $mojo_lv0012->lv002;?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $mojo_lv0012->GetCompany();?></b></span></td>
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
