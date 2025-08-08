<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0010.php");
require_once("../../clsall/sl_lv0013.php");
require_once("../../clsall/sl_lv0001.php");
require_once("../../clsall/ts_lv0011.php");
require_once("../../clsall/ts_lv0001.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/sl_lv0009.php");
require_once("../../clsall/ts_lv0020.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0013');
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$mots_lv0011=new ts_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0011');
$mots_lv0010=new ts_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0010');
$mosl_lv0009=new sl_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0009');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$mots_lv0020=new ts_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0020');
$mots_lv0001=new ts_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0001');

$mots_lv0011->objlot=$mots_lv0020;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0015.txt",$plang);
$mots_lv0010->lang=strtoupper($plang);
$mots_lv0010->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vtitle=$vLangArr[37];;
//$mots_lv0010->ArrPush[0]=$vLangArr[37];
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
$vFieldList="lv001,lv002,lv008,lv009,lv010";
$strParent=$mots_lv0010->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mots_lv0011->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0017.txt",$plang);
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
$mots_lv0011->ArrPush[17]=$vLangArr[34];
$mots_lv0011->ArrPush[18]=$vLangArr[42];
$mots_lv0011->ArrPush[22]=$vLangArr[42];
$mots_lv0011->ArrPush[98]=$vLangArr[43];
$mots_lv0011->ArrPush[99]=$vLangArr[44];
$mots_lv0011->ArrPush[89]=$vLangArr[45];
$mots_lv0011->ArrPush[100]='PO#/ContractID';
if($plang=="") $plang="VN";
//$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15";
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
<title><?php echo $vtitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<?php  
	$mots_lv0010->LV_LoadID($vlv001);
	if($mots_lv0010->lv005=='BANHANG')
	{
		$mosl_lv0013->LV_LoadID($mots_lv0010->lv006);
		$mohr_lv0020->LV_LoadID($mosl_lv0013->lv010);
		$mosl_lv0001->LV_LoadID($mosl_lv0013->lv002);
		$mosl_lv0009->LV_LoadID($mosl_lv0013->lv007);
	}
	elseif($mots_lv0010->lv005=='CUS')
	{
		$mosl_lv0001->LV_LoadID($mots_lv0010->lv006);
		$mohr_lv0020->LV_LoadID($mots_lv0010->lv003);
	}
	//$vFieldList="lv003,lv004,lv005,lv006,lv007,lv014,lv015";
	$mots_lv0011->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0011');
//////////////////////////////////////////////////////////////////////////////////////////////////////
	//$vFieldList=$mots_lv0011->ListView;
	$vFieldList="lv003,lv004,lv005,lv006,lv007,lv015";
	$vOrderList=$mots_lv0011->ListOrder;
	$vSortNum=$mots_lv0011->SortNum;
	 $strDetail=$mots_lv0011->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mots_lv0010->lv006);

			
	
	?>
	<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
		<td align="right"><div><div style="float:left"><img src="../../logo.png" width="130"/></div><div><?php echo ($mots_lv0010->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mots_lv0010->lv001."'>":"";?></div></div></td>
	  </tr>	
  <tr>
		<td align="center">
		<font style="font-size:14px;font-weight:bold"><?php echo $mots_lv0010->GetCompany();?></font>
		<br/>
		<div>
		Địa chỉ:<?php echo $mots_lv0010->GetAddress();?>
		<div style="border-top:1px #000 solid;width:84%;height:20px;margin-top:5px;"></div>
		</div>
		</td>
	  </tr>
   <tr>
    <td><div align="center" class="lv0"><?php echo $vtitle;?></div></td>
	</tr>
	<tr>
	<td><div align="center" >Ngày <?php echo getday($mots_lv0010->lv009);?> tháng <?php echo getmonth($mots_lv0010->lv009);?> năm <?php echo getyear($mots_lv0010->lv009);?></div></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <!--
  <tr>
    <td align="center">
		<div style="float:left;text-align:left;width:50%;font-weight:none">
			<div style="padding-right:10px">
				<strong>Mã Phiếu:</strong> <?php echo $vlv001;?>
				<br><strong>Tên KH:</strong> <?php echo $mosl_lv0001->lv002;?>
				<br><strong>Ð.CHỈ:</strong> <?php echo $mosl_lv0001->lv006;?>
			</div>
		</div>
		<div style="float:left;text-align:left;width:50%;font-weight:none">
			<div style="padding-left:10px">
			<strong>Xuất tại kho:</strong> <?php $mots_lv0001->LV_LoadID($mots_lv0010->lv002);echo $mots_lv0001->lv003;?>
			<br><strong>NV:</strong> <?php echo $mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<br/><strong>ÐT:</strong> <?php echo $mohr_lv0020->lv039;?>
				
			</div>
		</div>
	</td>
  </tr>-->
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
    <td align="left" ><br/><?php echo $mots_lv0010->lv008;;?></td>
  </tr>
  <tr>
    <td align="right" ><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="*">&nbsp;</td>
						<td width="20">&nbsp;</td>
						<td width="*">&nbsp;</td>
						<td width="20">&nbsp;</td>
						<td width="*">&nbsp;</td>
						<td width="20">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo 'Người giao hàng';?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo 'Người nhận hàng';?></b></span></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo 'Người lập phiếu';?></b></span></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="7">&nbsp;</td></tr>
					<tr>
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
