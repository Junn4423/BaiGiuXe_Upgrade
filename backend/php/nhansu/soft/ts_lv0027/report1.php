<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0008.php");
require_once("../../clsall/ts_lv0009.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mots_lv0009=new ts_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0009');
$mots_lv0008=new ts_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0008');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0010.txt",$plang);
$mots_lv0008->lang=strtoupper($plang);
$mots_lv0008->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0008->ArrPush[0]=$vLangArr[17];
$mots_lv0008->ArrPush[1]=$vLangArr[18];
$mots_lv0008->ArrPush[2]=$vLangArr[19];
$mots_lv0008->ArrPush[3]=$vLangArr[20];
$mots_lv0008->ArrPush[4]=$vLangArr[21];
$mots_lv0008->ArrPush[5]=$vLangArr[22];
$mots_lv0008->ArrPush[6]=$vLangArr[23];
$mots_lv0008->ArrPush[7]=$vLangArr[24];
$mots_lv0008->ArrPush[8]=$vLangArr[25];
$mots_lv0008->ArrPush[9]=$vLangArr[26];
$mots_lv0008->ArrPush[10]=$vLangArr[27];
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv006,lv008,lv009";
$strParent=$mots_lv0008->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mots_lv0009->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0012.txt",$plang);
$mots_lv0009->ArrPush[0]=$vLangArr[17];
$mots_lv0009->ArrPush[1]=$vLangArr[18];
$mots_lv0009->ArrPush[2]=$vLangArr[19];
$mots_lv0009->ArrPush[3]=$vLangArr[20];
$mots_lv0009->ArrPush[4]=$vLangArr[21];
$mots_lv0009->ArrPush[5]=$vLangArr[22];
$mots_lv0009->ArrPush[6]=$vLangArr[23];
$mots_lv0009->ArrPush[7]=$vLangArr[24];
$mots_lv0009->ArrPush[8]=$vLangArr[25];
$mots_lv0009->ArrPush[9]=$vLangArr[26];
$mots_lv0009->ArrPush[10]=$vLangArr[27];
$mots_lv0009->ArrPush[11]=$vLangArr[28];
$mots_lv0009->ArrPush[12]=$vLangArr[29];
$mots_lv0009->ArrPush[13]=$vLangArr[30];
$mots_lv0009->ArrPush[14]=$vLangArr[31];
$mots_lv0009->ArrPush[15]=$vLangArr[32];
$mots_lv0009->ArrPush[16]=$vLangArr[33];
if($plang=="") $plang="VN";
$vOrderList="1,2,3,6,7,8,9,10,4,5,11,12,13,14,15";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mots_lv0009->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mots_lv0008->GetView()==1)
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
	$mots_lv0008->LV_LoadID($vlv001);
	$vFieldList="lv003,lv004,lv005,lv006,lv007,lv014";
	 $strDetail=$mots_lv0009->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mots_lv0008->lv006);

			
	
	?>
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mots_lv0008->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mots_lv0008->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center"><img  src="<?php echo $mots_lv0009->GetLogo();?>" /></td>
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
    <td align="left" ><?php echo $mots_lv0008->lv009;;?></td>
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
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $mots_lv0008->getvaluelink('lv002',$mots_lv0008->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $mots_lv0008->GetCompany();?></b></span></td>
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
