<?php4session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ki_lv0003.php");
require_once("../../clsall/ki_lv0004.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$moki_lv0003=new ki_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0003');
$moki_lv0004=new ki_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0004');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","KI0003.txt",$plang);
$moki_lv0003->lang=strtoupper($plang);
$moki_lv0003->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0003->ArrPush[0]=$vLangArr[17];
$moki_lv0003->ArrPush[1]=$vLangArr[18];
$moki_lv0003->ArrPush[2]=$vLangArr[19];
$moki_lv0003->ArrPush[3]=$vLangArr[20];
$moki_lv0003->ArrPush[4]=$vLangArr[21];
$moki_lv0003->ArrPush[5]=$vLangArr[22];
$moki_lv0003->ArrPush[6]=$vLangArr[23];
$moki_lv0003->ArrPush[7]=$vLangArr[24];
$moki_lv0003->ArrPush[8]=$vLangArr[25];
$moki_lv0003->ArrPush[9]=$vLangArr[26];
$moki_lv0003->ArrPush[10]=$vLangArr[27];
$strParent=$moki_lv0003->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$moki_lv0004->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("../../","TC0102.txt",$plang);
$moki_lv0004->ArrPush[0]=$vLangArr1[17];
$moki_lv0004->ArrPush[1]=$vLangArr1[18];
$moki_lv0004->ArrPush[2]=$vLangArr1[20];
$moki_lv0004->ArrPush[3]=$vLangArr1[21];
$moki_lv0004->ArrPush[4]=$vLangArr1[22];
$moki_lv0004->ArrPush[5]=$vLangArr1[23];
$moki_lv0004->ArrPush[6]=$vLangArr1[24];
$moki_lv0004->ArrPush[7]=$vLangArr1[25];
$moki_lv0004->ArrPush[8]=$vLangArr1[26];
$moki_lv0004->ArrPush[9]=$vLangArr1[27];
$moki_lv0004->ArrPush[10]=$vLangArr1[28];
$moki_lv0004->ArrPush[11]=$vLangArr1[29];
$moki_lv0004->ArrPush[12]=$vLangArr1[30];
$moki_lv0004->ArrPush[13]=$vLangArr1[31];
$moki_lv0004->ArrPush[14]=$vLangArr1[32];
$moki_lv0004->ArrPush[15]=$vLangArr1[33];
$moki_lv0004->ArrPush[16]=$vLangArr1[34];
$moki_lv0004->ArrPush[17]=$vLangArr1[35];
if($plang=="") $plang="VN";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$moki_lv0004->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($moki_lv0003->GetView()==1)
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
	$moki_lv0003->LV_LoadID($vlv001);
	 $strDetail=$moki_lv0004->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$moki_lv0003->lv006);

			
	
	?>
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($moki_lv0003->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$moki_lv0003->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center"><img  src="<?php echo $moki_lv0004->GetLogo();?>" /></td>
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
    <td align="left" ><?php echo $moki_lv0003->lv009;;?></td>
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
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $moki_lv0003->GetCompany();?></b></span></td>
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