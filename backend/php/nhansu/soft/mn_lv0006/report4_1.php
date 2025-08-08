<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0013.php");
require_once("../../clsall/sl_lv0014.php");
require_once("../../clsall/sl_lv0001.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mosl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0013');
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0012');
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("../../","SL0074.txt",$plang);
$mosl_lv0013->lang=strtoupper($plang);
$mosl_lv0013->lv001=$vlv001;
$mosl_lv0014->objparent=$mosl_lv0013;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0013->ArrPush[0]=$vLangArr1[16];
$mosl_lv0013->ArrPush[1]=$vLangArr1[18];
$mosl_lv0013->ArrPush[2]=$vLangArr1[19];
$mosl_lv0013->ArrPush[3]=$vLangArr1[20];
$mosl_lv0013->ArrPush[4]=$vLangArr1[21];
$mosl_lv0013->ArrPush[5]=$vLangArr1[22];
$mosl_lv0013->ArrPush[6]=$vLangArr1[23];
$mosl_lv0013->ArrPush[7]=$vLangArr1[24];
$mosl_lv0013->ArrPush[8]=$vLangArr1[25];
$mosl_lv0013->ArrPush[9]=$vLangArr1[26];
$mosl_lv0013->ArrPush[10]=$vLangArr1[27];
$mosl_lv0013->ArrPush[11]=$vLangArr1[28];
$mosl_lv0013->ArrPush[12]=$vLangArr1[29];
$mosl_lv0013->ArrPush[13]=$vLangArr1[30];
$mosl_lv0013->ArrPush[14]=$vLangArr1[31];	
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv007,lv010";
$strParent=$mosl_lv0013->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mosl_lv0014->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0023.txt",$plang);
$vLangArr=GetLangFile("../../","SL0029.txt",$plang);
$mosl_lv0014->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0014->ArrPush[0]=$vLangArr[17];
$mosl_lv0014->ArrPush[1]=$vLangArr[18];
$mosl_lv0014->ArrPush[2]=$vLangArr[19];
$mosl_lv0014->ArrPush[3]=$vLangArr[20];
$mosl_lv0014->ArrPush[4]=$vLangArr[21];
$mosl_lv0014->ArrPush[5]=$vLangArr[22];
$mosl_lv0014->ArrPush[6]=$vLangArr[23];
$mosl_lv0014->ArrPush[7]=$vLangArr[24]."@01";
$mosl_lv0014->ArrPush[8]=$vLangArr[25];
$mosl_lv0014->ArrPush[9]=$vLangArr[26]."(%)";
$mosl_lv0014->ArrPush[10]=$vLangArr[27];
$mosl_lv0014->ArrPush[11]=$vLangArr[28];
$mosl_lv0014->ArrPush[12]=$vLangArr[29]."(%)";
$mosl_lv0014->ArrPush[13]=$vLangArr[30];
$mosl_lv0014->ArrPush[14]=$vLangArr[31];
$mosl_lv0014->ArrPush[15]=$vLangArr[32];
$mosl_lv0014->ArrPush[16]=$vLangArr[33];
$mosl_lv0014->ArrPush[17]=$vLangArr[46];
$mosl_lv0014->ArrPush[18]=$vLangArr[47];
$mosl_lv0014->ArrPush[19]=$vLangArr[48];
$mosl_lv0014->ArrPush[20]=$vLangArr[49];

$mosl_lv0014->ArrPush[21]=$vLangArr[41]."@01";
$mosl_lv0014->ArrPush[22]=$vLangArr[42];
$mosl_lv0014->ArrPush[23]=$vLangArr[43];
$mosl_lv0014->ArrPush[24]=$vLangArr[44];
$mosl_lv0014->ArrPush[25]=$vLangArr[42];
$mosl_lv0014->ArrPush[26]=$vLangArr[54];
$mosl_lv0014->ArrPush[27]=$vLangArr[55];

$mosl_lv0014->ArrFunc[0]='//Function';
$mosl_lv0014->ArrFunc[1]=$vLangArr[2];
$mosl_lv0014->ArrFunc[2]=$vLangArr[4];
$mosl_lv0014->ArrFunc[3]=$vLangArr[6];
$mosl_lv0014->ArrFunc[4]=$vLangArr[7];
$mosl_lv0014->ArrFunc[5]='';
$mosl_lv0014->ArrFunc[6]='';
$mosl_lv0014->ArrFunc[7]='';
$mosl_lv0014->ArrFunc[8]=$vLangArr[10];
$mosl_lv0014->ArrFunc[9]=$vLangArr[12];
$mosl_lv0014->ArrFunc[10]=$vLangArr[0];
$mosl_lv0014->ArrFunc[11]=$vLangArr[33];
$mosl_lv0014->ArrFunc[12]=$vLangArr[34];
$mosl_lv0014->ArrFunc[13]=$vLangArr[35];
$mosl_lv0014->ArrFunc[14]=$vLangArr[36];
$mosl_lv0014->ArrFunc[15]=$vLangArr[37];

////Other
$mosl_lv0014->ArrOther[1]=$vLangArr[31];
$mosl_lv0014->ArrOther[2]=$vLangArr[32];
if($plang=="") $plang="VN";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mosl_lv0014->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mosl_lv0013->GetView()==1)
{
?>
<?php  
	$mosl_lv0013->LV_LoadID($vlv001);
	$mosl_lv0001->LV_LoadID($mosl_lv0013->lv002);
	$vOrderList="1,2,3,6,7,8,9,10,4,5,11,12,13,14,15,16,17,18,19,20";
	if($mosl_lv0013->lv006>0 || $mosl_lv0013->lv006==-1)
	$vFieldList="lv003,lv004,lv005,lv006";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv008,lv011,lv020";
	$strDetail=$mosl_lv0014->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mosl_lv0013->lv006);
	?>
<html>
<head>
<title><?php echo $mosl_lv0001->lv002;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mosl_lv0013->lv011>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0013->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center" onDblClick="this.innerHTML=''"><img  src="<?php echo $mosl_lv0014->GetLogo();?>" /></td>
  </tr>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''"><div>
    <div style="float:left;text-align:left"><strong><?php echo $mosl_lv0001->lv002;?></strong><br><?php echo $vLangArr1[39];?>: <?php echo $mosl_lv0001->lv006;?><br>

<?php echo $vLangArr1[40];?>: <?php echo $mosl_lv0001->lv010;?> <?php echo $vLangArr1[41];?>: <?php echo $mosl_lv0001->lv012;?><br> Người liên hệ: <?php echo $mosl_lv0001->lv003;?></div><div style="float:right;text-align:right"><strong><?php echo $mosl_lv0014->GetCompany();?></strong><br><?php echo $vLangArr1[39];?>: <?php echo $mosl_lv0014->GetAddress();?>
<br><?php echo $vLangArr1[40];?>: <?php echo $mosl_lv0014->GetPhone();?>   <?php echo $vLangArr1[41];?>: <?php echo $mosl_lv0014->GetFax();?> <br> 
<?php echo $vLangArr1[42];?>: <a href="<?php echo $mosl_lv0014->GetWeb();?>" target="_blank"><?php echo $mosl_lv0014->GetWeb();?></a></div>
    </div></td>
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
    <td align="left" ><?php echo $mosl_lv0013->lv009;;?></td>
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
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $mosl_lv0013->getvaluelink('lv002',$mosl_lv0013->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $mosl_lv0013->GetCompany();?></b></span></td>
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
