<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");	
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0021.php");
require_once("../../clsall/wh_lv0022.php");
require_once("../../clsall/wh_lv0003.php");
require_once("../../clsall/cr_lv0176.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mowh_lv0022=new wh_lv0022($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0022');
$mowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0221');
$mowh_lv0003=new wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
$mocr_lv0176=new cr_lv0176($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0022');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0024.txt",$plang);
$mowh_lv0021->lang=strtoupper($plang);
$mowh_lv0021->lv001=$vlv001;
$mowh_lv0021->LV_LoadID($vlv001);
$mocr_lv0176->mowh_lv0021=$mowh_lv0021;
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
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv007,lv008,lv010";
$strParent=$mowh_lv0021->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



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
$mowh_lv0022->ArrPush[7]=$vLangArr[24]."@01";
$mowh_lv0022->ArrPush[8]=$vLangArr[25];
$mowh_lv0022->ArrPush[9]=$vLangArr[26];
$mowh_lv0022->ArrPush[10]=$vLangArr[27];
$mowh_lv0022->ArrPush[11]=$vLangArr[28];
$mowh_lv0022->ArrPush[12]=$vLangArr[29];
$mowh_lv0022->ArrPush[13]=$vLangArr[30];
$mowh_lv0022->ArrPush[14]=$vLangArr[41];
$mowh_lv0022->ArrPush[15]=$vLangArr[42];
$mowh_lv0022->ArrPush[16]=$vLangArr[38]."@01";
	

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
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15";
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
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<?php  
	$mowh_lv0021->LV_LoadID($vlv001);
	$mowh_lv0003->LV_LoadID($mowh_lv0021->lv002);
	if($mowh_lv0021->lv006>0 || $mowh_lv0021->lv006==-1)
	$vFieldList="lv003,lv004,lv005,lv006,lv009,lv010,lv011,lv012,lv013,lv015";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv008,lv009,lv010,lv011,lv012,lv013,lv015";
	 $strDetail=$mowh_lv0022->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mowh_lv0021->lv006);
	 if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","CR0215.txt",$plang);
	$mocr_lv0176->ArrPush[0]=$vLangArr[17];
	$mocr_lv0176->ArrPush[1]=$vLangArr[18];
	$mocr_lv0176->ArrPush[2]=$vLangArr[19];
	$mocr_lv0176->ArrPush[3]=$vLangArr[20];
	$mocr_lv0176->ArrPush[4]=$vLangArr[21];
	$mocr_lv0176->ArrPush[5]=$vLangArr[22];
	$mocr_lv0176->ArrPush[6]=$vLangArr[23];
	$mocr_lv0176->ArrPush[7]=$vLangArr[24];
	$mocr_lv0176->ArrPush[8]=$vLangArr[25];
	$mocr_lv0176->ArrPush[9]=$vLangArr[26];
	$mocr_lv0176->ArrPush[10]=$vLangArr[27];
	$mocr_lv0176->ArrPush[11]=$vLangArr[28];
	$mocr_lv0176->ArrPush[12]=$vLangArr[29];
	$mocr_lv0176->ArrPush[13]=$vLangArr[30];
	$mocr_lv0176->ArrPush[14]=$vLangArr[31];
	$mocr_lv0176->ArrPush[15]=$vLangArr[32];
	$mocr_lv0176->ArrPush[16]=$vLangArr[33];
	$mocr_lv0176->ArrPush[17]=$vLangArr[34];
	$mocr_lv0176->ArrPush[18]=$vLangArr[35];
	$mocr_lv0176->ArrPush[19]=$vLangArr[36];
	$mocr_lv0176->ArrPush[20]=$vLangArr[37];
	$mocr_lv0176->ArrPush[21]=$vLangArr[38];
	$mocr_lv0176->ArrPush[22]=$vLangArr[39];
	$mocr_lv0176->ArrPush[23]=$vLangArr[40];
	$mocr_lv0176->ArrPush[24]=$vLangArr[41];
	$mocr_lv0176->ArrPush[25]=$vLangArr[42];
	$mocr_lv0176->ArrPush[26]=$vLangArr[43];
	$mocr_lv0176->ArrPush[27]=$vLangArr[44];
	$mocr_lv0176->ArrPush[28]=$vLangArr[45];
	$mocr_lv0176->ArrPush[29]=$vLangArr[46];
	$mocr_lv0176->ArrPush[30]=$vLangArr[47];
	$mocr_lv0176->ArrPush[31]=$vLangArr[48];
	$mocr_lv0176->ArrPush[32]=$vLangArr[49];
	$mocr_lv0176->ArrPush[33]=$vLangArr[50];
	$mocr_lv0176->ArrPush[34]=$vLangArr[51];
	$mocr_lv0176->ArrPush[35]=$vLangArr[52];
	$mocr_lv0176->ArrPush[36]=$vLangArr[53];
	$mocr_lv0176->ArrPush[37]=$vLangArr[54];
	$mocr_lv0176->ArrPush[38]=$vLangArr[55];
	$mocr_lv0176->ArrPush[39]=$vLangArr[56];
	$mocr_lv0176->ArrPush[40]=$vLangArr[57];
	$mocr_lv0176->ArrPush[41]=$vLangArr[58];
	$mocr_lv0176->ArrPush[42]=$vLangArr[59];
	$mocr_lv0176->ArrPush[43]=$vLangArr[60];
	$mocr_lv0176->ArrPush[44]=$vLangArr[61];
	$mocr_lv0176->ArrPush[45]=$vLangArr[62];
	$mocr_lv0176->ArrPush[46]=$vLangArr[63];
	$mocr_lv0176->ArrPush[47]=$vLangArr[64];
	$mocr_lv0176->ArrPush[48]=$vLangArr[65];
	$mocr_lv0176->ArrPush[49]=$vLangArr[66];
	$mocr_lv0176->ArrPush[50]=$vLangArr[67];
	$mocr_lv0176->ArrPush[51]=$vLangArr[68];
	$mocr_lv0176->ArrPush[52]=$vLangArr[69];
	$mocr_lv0176->ArrPush[53]=$vLangArr[70];
	$mocr_lv0176->ArrPush[54]=$vLangArr[71];
	$mocr_lv0176->ArrPush[55]=$vLangArr[72];
	$mocr_lv0176->ArrPush[56]=$vLangArr[73];
	$mocr_lv0176->ArrPush[57]=$vLangArr[74];
	$mocr_lv0176->ArrPush[58]=$vLangArr[75];
	$mocr_lv0176->ArrPush[59]=$vLangArr[76];
	$mocr_lv0176->ArrPush[60]=$vLangArr[77];
	$mocr_lv0176->ArrPush[61]=$vLangArr[78];
	$mocr_lv0176->ArrPush[62]=$vLangArr[79];
	$mocr_lv0176->ArrPush[63]=$vLangArr[80];
	$mocr_lv0176->ArrPush[64]=$vLangArr[81];
	
	$mocr_lv0176->ArrPush[65]=$vLangArr[82];
	$mocr_lv0176->ArrPush[66]=$vLangArr[83];
	$mocr_lv0176->ArrPush[69]=$vLangArr[91];
	$mocr_lv0176->ArrPush[200]='Chức năng';
	
	$mocr_lv0176->ArrPush[81]=$vLangArr[92];
	$mocr_lv0176->ArrPush[82]=$vLangArr[93];
	$mocr_lv0176->ArrPush[83]=$vLangArr[94];
	$mocr_lv0176->ArrPush[84]=$vLangArr[95];
	$mocr_lv0176->ArrPush[85]=$vLangArr[96];
	$mocr_lv0176->ArrPush[86]=$vLangArr[97];
	$mocr_lv0176->ArrPush[87]=$vLangArr[98];
	$mocr_lv0176->ArrPush[88]=$vLangArr[99];
	$mocr_lv0176->ArrPush[89]=$vLangArr[100];
	$mocr_lv0176->ArrPush[90]=$vLangArr[101];
	$mocr_lv0176->ArrPush[91]=$vLangArr[102];
	$mocr_lv0176->ArrPush[92]=$vLangArr[103];
	$mocr_lv0176->ArrPush[93]=$vLangArr[104];
	$mocr_lv0176->ArrPush[94]=$vLangArr[105];
	$mocr_lv0176->ArrPush[95]=$vLangArr[106];
	$mocr_lv0176->ArrPush[96]=$vLangArr[107];
	if($plang=='EN')
	{
		$mocr_lv0176->ArrPush[300]='Supplier';
		$mocr_lv0176->ArrPush[163]='Price(@@163)';
		$mocr_lv0176->ArrPush[164]='Amount(@@163)';
	}
	else
	{
		$mocr_lv0176->ArrPush[300]='Mã NCC';
		$mocr_lv0176->ArrPush[163]='Đơn giá(@@163)';
		$mocr_lv0176->ArrPush[164]='Thành tiền(@@163)';
	}
	 $vFieldList='lv012,lv011';
	 $mocr_lv0176->lv002=$vlv001;
	 $strDetail1=$mocr_lv0176->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mowh_lv0021->lv006);

			
	
	?>
	<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mowh_lv0021->lv011>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mowh_lv0021->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center"><div ondblclick="this.innerHTML=''"><img style="width:1024px"  src="<?php echo $mowh_lv0022->GetLogo();?>" /></div></td>
  </tr>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''"><div>
    <div style="float:left;text-align:left"><strong><?php echo $mowh_lv0003->lv002;?></strong><br><?php echo $vLangArr1[39];?>: <?php echo $mowh_lv0003->lv006;?><br>

<?php echo $vLangArr1[40];?>: <?php echo $mowh_lv0003->lv010;?> <?php echo $vLangArr1[41];?>: <?php echo $mowh_lv0003->lv012;?><br> Người liên hệ: <?php echo $mowh_lv0003->lv003;?></div><div style="float:right;text-align:right"><strong><?php echo $mowh_lv0021->GetCompany();?></strong><br><?php echo $vLangArr1[39];?>: <?php echo $mowh_lv0021->GetAddress();?>
<br><?php echo $vLangArr1[40];?>: <?php echo $mowh_lv0021->GetPhone();?>   <?php echo $vLangArr1[41];?>: <?php echo $mowh_lv0021->GetFax();?> <br> 
<?php echo $vLangArr1[42];?>: <a href="<?php echo $mowh_lv0021->GetWeb();?>" target="_blank"><?php echo $mowh_lv0021->GetWeb();?></a></div>
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
    <td align="left" ><?php echo $mowh_lv0021->lv009;;?></td>
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
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo "THU MUA";//$mowh_lv0021->getvaluelink('lv002',$mowh_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo "KẾ TOÁN KHO";//$mowh_lv0021->getvaluelink('lv002',$mowh_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo "NGƯỜI ĐỀ NGHỊ";//$mowh_lv0021->getvaluelink('lv002',$mowh_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo "BGĐ";//$mowh_lv0021->GetCompany();?></b></span></td>
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
