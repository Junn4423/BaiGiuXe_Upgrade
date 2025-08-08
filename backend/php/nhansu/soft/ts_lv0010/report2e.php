<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0010.php");
require_once("../../clsall/ts_lv0011.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mots_lv0011=new ts_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0011');
$mots_lv0010=new ts_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0010');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0015.txt",$plang);
$mots_lv0010->lang=strtoupper($plang);
$mots_lv0010->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0010->ArrPush[0]=$vLangArr[37];
$mots_lv0010->ArrPush[1]=$vLangArr[18];
$mots_lv0010->ArrPush[2]=$vLangArr[19];
$mots_lv0010->ArrPush[3]=$vLangArr[20];
$mots_lv0010->ArrPush[4]=$vLangArr[21];
$mots_lv0010->ArrPush[5]=$vLangArr[22];
$mots_lv0010->ArrPush[6]=$vLangArr[23];
$mots_lv0010->ArrPush[7]=$vLangArr[24];
$mots_lv0010->ArrPush[8]=$vLangArr[25];
$mots_lv0010->ArrPush[9]=$vLangArr[26];
$mots_lv0010->ArrPush[10]=$vLangArr[27];
$mots_lv0010->ArrPush[11]=$vLangArr[40];
$mots_lv0010->ArrPush[12]=$vLangArr[41];
$mots_lv0010->ArrPush[13]=$vLangArr[42];

$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv006,lv008,lv009,lv010,lv011";
$strParent=$mots_lv0010->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mots_lv0011->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0012.txt",$plang);
$mots_lv0011->ArrPush[0]=$vLangArr[17];
$mots_lv0011->ArrPush[1]=$vLangArr[18];
$mots_lv0011->ArrPush[2]=$vLangArr[19];
$mots_lv0011->ArrPush[3]=$vLangArr[20];
$mots_lv0011->ArrPush[4]=$vLangArr[21];
$mots_lv0011->ArrPush[5]=$vLangArr[22];
$mots_lv0011->ArrPush[6]=$vLangArr[23];
$mots_lv0011->ArrPush[7]=$vLangArr[24];
$mots_lv0011->ArrPush[8]=$vLangArr[25];
$mots_lv0011->ArrPush[9]=$vLangArr[26];
$mots_lv0011->ArrPush[10]=$vLangArr[27];
$mots_lv0011->ArrPush[11]=$vLangArr[28];
$mots_lv0011->ArrPush[12]=$vLangArr[29];
$mots_lv0011->ArrPush[13]=$vLangArr[30];
$mots_lv0011->ArrPush[14]=$vLangArr[31];
$mots_lv0011->ArrPush[15]=$vLangArr[32];
$mots_lv0011->ArrPush[16]=$vLangArr[33];
if($plang=="") $plang="VN";
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mots_lv0011->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mots_lv0010->GetView()==1)
{
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<?php  
	$mots_lv0010->LV_LoadID($vlv001);
	$vFieldList="lv003,lv004,lv005,lv006,lv007,lv014,lv015";
	 $strDetail=$mots_lv0011->LV_BuilListReportOtherSoon($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mots_lv0010->lv006);

			
	
	?>
	<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mots_lv0010->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mots_lv0010->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center"><div ondblclick="this.innerHTML=''"><img  src="<?php echo $mots_lv0011->GetLogo();?>" /></div></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $strParent;?></td>
  </tr>
    <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $strDetail;?></td>
  </tr>
  <tr>
    <td align="left" ><?php echo $mots_lv0010->lv009;
	$vLangArr=GetLangFile("../../","TS0015.txt",$plang);
	?></td>
  </tr>
  <tr>
    <td align="right" ><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="150">&nbsp;</td>
						<td width="143">&nbsp;</td>
						<td width="117">&nbsp;</td>
						<td width="20">&nbsp;</td>
						<td width="117">&nbsp;</td>
						<td width="20">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><center><b><?php echo $vLangArr[38];?></b></center></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><center><b><?php echo $vLangArr[43];?></b></center></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><center><b><?php echo $vLangArr[39];?></b></center></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
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
