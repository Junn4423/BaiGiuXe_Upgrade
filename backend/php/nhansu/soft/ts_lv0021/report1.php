<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");	
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0021.php");
require_once("../../clsall/ts_lv0022.php");
require_once("../../clsall/ts_lv0003.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mots_lv0022=new ts_lv0022($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0022');
$mots_lv0021=new ts_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0021');
$mots_lv0003=new ts_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0024.txt",$plang);
$mots_lv0021->lang=strtoupper($plang);
$mots_lv0021->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0021->ArrPush[0]=$vLangArr[16];
$mots_lv0021->ArrPush[1]=$vLangArr[18];
$mots_lv0021->ArrPush[2]=$vLangArr[19];
$mots_lv0021->ArrPush[3]=$vLangArr[20];
$mots_lv0021->ArrPush[4]=$vLangArr[21];
$mots_lv0021->ArrPush[5]=$vLangArr[22];
$mots_lv0021->ArrPush[6]=$vLangArr[23];
$mots_lv0021->ArrPush[7]=$vLangArr[24];
$mots_lv0021->ArrPush[8]=$vLangArr[25];
$mots_lv0021->ArrPush[9]=$vLangArr[26];
$mots_lv0021->ArrPush[10]=$vLangArr[27];
$mots_lv0021->ArrPush[11]=$vLangArr[28];
$mots_lv0021->ArrPush[12]=$vLangArr[29];
$mots_lv0021->ArrPush[13]=$vLangArr[30];
$mots_lv0021->ArrPush[14]=$vLangArr[31];	
$mots_lv0021->ArrPush[15]=$vLangArr[32];
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv007,lv008,lv010";
$strParent=$mots_lv0021->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mots_lv0022->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0026.txt",$plang);
$mots_lv0022->ArrPush[0]=$vLangArr[17];
$mots_lv0022->ArrPush[1]=$vLangArr[18];
$mots_lv0022->ArrPush[2]=$vLangArr[19];
$mots_lv0022->ArrPush[3]=$vLangArr[20];
$mots_lv0022->ArrPush[4]=$vLangArr[21];
$mots_lv0022->ArrPush[5]=$vLangArr[22];
$mots_lv0022->ArrPush[6]=$vLangArr[23];
$mots_lv0022->ArrPush[7]=$vLangArr[24]."@01";
$mots_lv0022->ArrPush[8]=$vLangArr[25];
$mots_lv0022->ArrPush[9]=$vLangArr[26];
$mots_lv0022->ArrPush[10]=$vLangArr[27];
$mots_lv0022->ArrPush[11]=$vLangArr[28];
$mots_lv0022->ArrPush[12]=$vLangArr[29];
$mots_lv0022->ArrPush[13]=$vLangArr[30];
$mots_lv0022->ArrPush[14]=$vLangArr[41];
$mots_lv0022->ArrPush[15]=$vLangArr[42];
$mots_lv0022->ArrPush[16]=$vLangArr[38]."@01";
	

$mots_lv0022->ArrFunc[0]='//Function';
$mots_lv0022->ArrFunc[1]=$vLangArr[2];
$mots_lv0022->ArrFunc[2]=$vLangArr[4];
$mots_lv0022->ArrFunc[3]=$vLangArr[6];
$mots_lv0022->ArrFunc[4]=$vLangArr[7];
$mots_lv0022->ArrFunc[5]='';
$mots_lv0022->ArrFunc[6]='';
$mots_lv0022->ArrFunc[7]='';
$mots_lv0022->ArrFunc[8]=$vLangArr[10];
$mots_lv0022->ArrFunc[9]=$vLangArr[12];
$mots_lv0022->ArrFunc[10]=$vLangArr[0];
$mots_lv0022->ArrFunc[11]=$vLangArr[33];
$mots_lv0022->ArrFunc[12]=$vLangArr[34];
$mots_lv0022->ArrFunc[13]=$vLangArr[35];
$mots_lv0022->ArrFunc[14]=$vLangArr[36];
$mots_lv0022->ArrFunc[15]=$vLangArr[37];

////Other
$mots_lv0022->ArrOther[1]=$vLangArr[31];
$mots_lv0022->ArrOther[2]=$vLangArr[32];
if($plang=="") $plang="VN";
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mots_lv0022->lv002=$vlv001;
$vStrMessage="";
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("../../","SL0020.txt",$plang);
?>

<?php
if($mots_lv0021->GetView()==1)
{
?>
<html>
<head>
<title><?php echo $mots_lv0021->ArrPush[0];?></title>
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
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<?php  
	$mots_lv0021->LV_LoadID($vlv001);
	$mots_lv0003->LV_LoadID($mots_lv0021->lv002);
	if($mots_lv0021->lv006>0 || $mots_lv0021->lv006==-1)
	$vFieldList="lv003,lv004,lv005,lv006,lv009,lv010,lv011,lv012,lv013,lv015";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv008,lv009,lv010,lv011,lv012,lv013,lv015";
	 $strDetail=$mots_lv0022->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mots_lv0021->lv006);

			
	
	?>
	<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mots_lv0021->lv011>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mots_lv0021->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center"><div ondblclick="this.innerHTML=''"><img  src="<?php echo $mots_lv0022->GetLogo();?>" /></div></td>
  </tr>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''"><div>
    <div style="float:left;text-align:left"><strong><?php echo $mots_lv0003->lv002;?></strong><br><?php echo $vLangArr1[39];?>: <?php echo $mots_lv0003->lv006;?><br>

<?php echo $vLangArr1[40];?>: <?php echo $mots_lv0003->lv010;?> <?php echo $vLangArr1[41];?>: <?php echo $mots_lv0003->lv012;?><br> Người liên hệ: <?php echo $mots_lv0003->lv003;?></div><div style="float:right;text-align:right"><strong><?php echo $mots_lv0021->GetCompany();?></strong><br><?php echo $vLangArr1[39];?>: <?php echo $mots_lv0021->GetAddress();?>
<br><?php echo $vLangArr1[40];?>: <?php echo $mots_lv0021->GetPhone();?>   <?php echo $vLangArr1[41];?>: <?php echo $mots_lv0021->GetFax();?> <br> 
<?php echo $vLangArr1[42];?>: <a href="<?php echo $mots_lv0021->GetWeb();?>" target="_blank"><?php echo $mots_lv0021->GetWeb();?></a></div>
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
    <td align="left" ><?php echo $mots_lv0021->lv009;;?></td>
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
						<td width="20%">&nbsp;</td>
						<td width="1%">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo "THU MUA";//$mots_lv0021->getvaluelink('lv002',$mots_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo "KẾ TOÁN KHO";//$mots_lv0021->getvaluelink('lv002',$mots_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo "NGƯỜI ĐỀ NGHỊ";//$mots_lv0021->getvaluelink('lv002',$mots_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo "BGĐ";//$mots_lv0021->GetCompany();?></b></span></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="120px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php echo GetUserName(getInfor($_SESSION['ERPSOFV2RUserID'],2),$plang);// for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<40; $i++) echo ".";?></td>
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
