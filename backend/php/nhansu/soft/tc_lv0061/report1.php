<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0061.php");
require_once("../../clsall/tc_lv0062.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$motc_lv0061=new tc_lv0061($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0061');
$motc_lv0062=new tc_lv0062($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0062');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0100.txt",$plang);
$motc_lv0061->lang=strtoupper($plang);
$motc_lv0061->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0061->ArrPush[0]=$vLangArr[17];
$motc_lv0061->ArrPush[1]=$vLangArr[18];
$motc_lv0061->ArrPush[2]=$vLangArr[19];
$motc_lv0061->ArrPush[3]=$vLangArr[20];
$motc_lv0061->ArrPush[4]=$vLangArr[21];
$motc_lv0061->ArrPush[5]=$vLangArr[22];
$motc_lv0061->ArrPush[6]=$vLangArr[23];
$motc_lv0061->ArrPush[7]=$vLangArr[24];
$motc_lv0061->ArrPush[8]=$vLangArr[25];
$motc_lv0061->ArrPush[9]=$vLangArr[26];
$motc_lv0061->ArrPush[10]=$vLangArr[27];
$strParent=$motc_lv0061->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$motc_lv0062->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("../../","TC0102.txt",$plang);
$motc_lv0062->ArrPush[0]=$vLangArr1[17];
$motc_lv0062->ArrPush[1]=$vLangArr1[18];
$motc_lv0062->ArrPush[2]=$vLangArr1[20];
$motc_lv0062->ArrPush[3]=$vLangArr1[21];
$motc_lv0062->ArrPush[4]=$vLangArr1[22];
$motc_lv0062->ArrPush[5]=$vLangArr1[23];
$motc_lv0062->ArrPush[6]=$vLangArr1[24];
$motc_lv0062->ArrPush[7]=$vLangArr1[25];
$motc_lv0062->ArrPush[8]=$vLangArr1[26];
$motc_lv0062->ArrPush[9]=$vLangArr1[27];
$motc_lv0062->ArrPush[10]=$vLangArr1[28];
$motc_lv0062->ArrPush[11]=$vLangArr1[29];
$motc_lv0062->ArrPush[12]=$vLangArr1[30];
$motc_lv0062->ArrPush[13]=$vLangArr1[31];
$motc_lv0062->ArrPush[14]=$vLangArr1[32];
$motc_lv0062->ArrPush[15]=$vLangArr1[33];
$motc_lv0062->ArrPush[16]=$vLangArr1[34];
$motc_lv0062->ArrPush[17]=$vLangArr1[35];
if($plang=="") $plang="VN";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$motc_lv0062->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($motc_lv0061->GetView()==1)
{
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
	<?php  
	$motc_lv0061->LV_LoadID($vlv001);
	 $strDetail=$motc_lv0062->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$motc_lv0061->lv006);

			
	
	?>
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($motc_lv0061->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$motc_lv0061->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center"><img  src="<?php echo $motc_lv0062->GetLogo();?>" /></td>
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
    <td align="left" ><?php echo $motc_lv0061->lv009;;?></td>
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
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $vLangArr[39];?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $motc_lv0061->GetCompany();?></b></span></td>
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