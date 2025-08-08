<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0004.php");
require_once("../../clsall/ts_lv0005.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mots_lv0005=new ts_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0005');
$mots_lv0004=new ts_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0004');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0005.txt",$plang);
$mots_lv0004->lang=strtoupper($plang);
$mots_lv0004->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0004->ArrPush[0]=$vLangArr[16];
$mots_lv0004->ArrPush[1]=$vLangArr[18];
$mots_lv0004->ArrPush[2]=$vLangArr[19];
$mots_lv0004->ArrPush[3]=$vLangArr[20];
$mots_lv0004->ArrPush[4]=$vLangArr[21];
$mots_lv0004->ArrPush[5]=$vLangArr[22];
$mots_lv0004->ArrPush[6]=$vLangArr[23];
$mots_lv0004->ArrPush[7]=$vLangArr[24];
$mots_lv0004->ArrPush[8]=$vLangArr[25];
$mots_lv0004->ArrPush[9]=$vLangArr[26];
$mots_lv0004->ArrPush[10]=$vLangArr[27];
$mots_lv0004->ArrPush[11]=$vLangArr[28];
$mots_lv0004->ArrPush[12]=$vLangArr[29];
$mots_lv0004->ArrPush[13]=$vLangArr[30];
$mots_lv0004->ArrPush[14]=$vLangArr[31];	
$vOrderList="1,2,3,4,5,6,7";
$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007";
$strParent=$mots_lv0004->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mots_lv0005->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0008.txt",$plang);
$mots_lv0005->ArrPush[0]=$vLangArr[17];
$mots_lv0005->ArrPush[1]=$vLangArr[18];
$mots_lv0005->ArrPush[2]=$vLangArr[19];
$mots_lv0005->ArrPush[3]=$vLangArr[20];
$mots_lv0005->ArrPush[4]=$vLangArr[21];
$mots_lv0005->ArrPush[5]=$vLangArr[22];
$mots_lv0005->ArrPush[6]=$vLangArr[23];
$mots_lv0005->ArrPush[7]=$vLangArr[24];
$mots_lv0005->ArrPush[8]=$vLangArr[25];
$mots_lv0005->ArrPush[9]=$vLangArr[26];
$mots_lv0005->ArrPush[10]=$vLangArr[27];
$mots_lv0005->ArrPush[11]=$vLangArr[28];
$mots_lv0005->ArrPush[12]=$vLangArr[29];
$mots_lv0005->ArrPush[13]=$vLangArr[30];
$mots_lv0005->ArrPush[14]=$vLangArr[38];
$mots_lv0005->ArrPush[15]=$vLangArr[39];
$mots_lv0005->ArrPush[16]=$vLangArr[40];
$mots_lv0005->ArrPush[17]=$vLangArr[41];

$mots_lv0005->ArrFunc[0]='//Function';
$mots_lv0005->ArrFunc[1]=$vLangArr[2];
$mots_lv0005->ArrFunc[2]=$vLangArr[4];
$mots_lv0005->ArrFunc[3]=$vLangArr[6];
$mots_lv0005->ArrFunc[4]=$vLangArr[7];
$mots_lv0005->ArrFunc[5]='';
$mots_lv0005->ArrFunc[6]='';
$mots_lv0005->ArrFunc[7]='';
$mots_lv0005->ArrFunc[8]=$vLangArr[10];
$mots_lv0005->ArrFunc[9]=$vLangArr[12];
$mots_lv0005->ArrFunc[10]=$vLangArr[0];
$mots_lv0005->ArrFunc[11]=$vLangArr[33];
$mots_lv0005->ArrFunc[12]=$vLangArr[34];
$mots_lv0005->ArrFunc[13]=$vLangArr[35];
$mots_lv0005->ArrFunc[14]=$vLangArr[36];
$mots_lv0005->ArrFunc[15]=$vLangArr[37];

////Other
$mots_lv0005->ArrOther[1]=$vLangArr[31];
$mots_lv0005->ArrOther[2]=$vLangArr[32];
if($plang=="") $plang="VN";
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mots_lv0005->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mots_lv0004->GetView()==1)
{
?>
<html>
<head>
<title><?php echo $mots_lv0004->ArrPush[0];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<?php  
	$mots_lv0004->LV_LoadID($vlv001);
	if($mots_lv0004->lv006>0 || $mots_lv0004->lv006==-1)
	$vFieldList="lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012";
	 $strDetail=$mots_lv0005->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mots_lv0004->lv006);

			
	
	?>
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
		<td align="right"><div><div style="float:left"><img src="../../logo.png" width="130"/></div><div><?php echo ($mots_lv0004->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mots_lv0004->lv001."'>":"";?></div></div></td>
	  </tr>	
  <tr>
		<td align="center">
		<font style="font-size:14px;font-weight:bold"><?php echo $mots_lv0004->GetCompany();?></font>
		<br/>
		<div>
		Địa chỉ:<?php echo $mots_lv0004->GetAddress();?>
		<div style="border-top:1px #000 solid;width:84%;height:20px;margin-top:5px;"></div>
		</div>
		</td>
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
    <td align="left" ><?php echo $mots_lv0004->lv009;;?></td>
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
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $mots_lv0004->getvaluelink('lv002',$mots_lv0004->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $mots_lv0004->GetCompany();?></b></span></td>
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
	include("../ts_lv0004/permit.php");
}
?>
