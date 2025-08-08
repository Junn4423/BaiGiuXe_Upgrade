<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0013.php");
require_once("../../clsall/sl_lv0014.php");
require_once("../../clsall/sl_lv0001.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/sl_lv0009.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mosl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0013');
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0012');
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$mosl_lv0009=new sl_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0009');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
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
//$strParent=$mosl_lv0013->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



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
	$mohr_lv0020->LV_LoadID($mosl_lv0013->lv010);
	$mosl_lv0001->LV_LoadID($mosl_lv0013->lv002);
	$mosl_lv0009->LV_LoadID($mosl_lv0013->lv007);
	$vOrderList="1,2,3,5,4,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20";
	if($mosl_lv0013->lv006>0 || $mosl_lv0013->lv006==-1)
	$vFieldList="lv003,lv004,lv005,lv006";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv009,lv011,lv012,lv020";
	//$strDetail=$mosl_lv0014->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mosl_lv0013->lv006);
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
    <td align="center" onDblClick="this.innerHTML=''">
	<div>
		<div style="float:left;text-align:center;width:50%;font-weight:bold">
		<div style="padding:10px">
	<?php echo $mosl_lv0014->GetCompany();?></strong><br><?php echo $mosl_lv0014->GetAddress();?>
<br><?php echo $vLangArr1[40];?>: <?php echo $mosl_lv0014->GetPhone();?>   <?php echo $vLangArr1[41];?>: <?php echo $mosl_lv0014->GetFax();?> <br> 
		</div>
	</div>
	<div style="float:left;width:50%">
		<div style="padding:10px">
			<table width="80%" style="border:0px;text-align:center"><tr><td><strong>NGÀY:</strong></td><td><?php echo $mosl_lv0013->FormatView($mosl_lv0013->lv004,2);?></td><td><strong>SỐ HÐ:</strong></td><td><?php echo $mosl_lv0013->lv001;?></td></tr></table>
		</div>
	</div>
    </div></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><font style="font-size:25px;font-weight:bold">PHIẾU GIAO HÀNG</font></td>
  </tr>
    <tr>
    <td align="center">
		<div style="float:left;text-align:left;width:50%;font-weight:none">
			<div style="padding-right:10px">
				<strong>Tên KH:</strong> <?php echo $mosl_lv0001->lv002;?>
				<br><strong>Ð.CHỈ:</strong> <?php echo $mosl_lv0001->lv006;?>
			</div>
		</div>
		<div style="float:left;text-align:left;width:50%;font-weight:none">
			<div style="padding-left:10px">
			<strong>TDV:</strong> <?php echo $mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>ÐT:</strong> <?php echo $mohr_lv0020->lv039;?>
				<br><strong>THANH TOÁN:</strong> <?php echo $mosl_lv0009->lv002;?>
			</div>
		</div>
	</td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td align="center"><table align="center" class="lvtable" border="1" cellspacing="0" cellpadding="0">
		<tbody><tr class="lvhtable">
			<td width="1%" class="lvhtable"><?php echo $vLangArr[18];?></td>			
			<td width="" class="lvhtable" style="padding-left:30px;padding-right:30px"><?php echo $vLangArr[21];?></td>
			<td width="" class="lvhtable" style="padding-left:3px;padding-right:3px"><?php echo $vLangArr[23];?></td>
			<td width="" class="lvhtable"><?php echo $vLangArr[22];?> </td>
			<td width="" class="lvhtable" style="padding-left:5px;padding-right:5px"><?php echo $vLangArr[24];?></td>
			<td width="" class="lvhtable" style="padding-left:5px;padding-right:5px"><?php echo $vLangArr[41];?></td>
			<td width="" class="lvhtable"  style="padding-left:5px;padding-right:5px"><?php echo $vLangArr[27];?></td>
			<td width="" class="lvhtable" style="padding-left:5px;padding-right:5px"><?php echo $vLangArr[30];?></td>
		</tr>
<?php
	$vorder=1;
	$sqlS = "SELECT A.*,B.lv002 ItemName,C.lv002 UnitName,D.lv002 ProgName FROM sl_lv0014 A left join sl_lv0007 B on A.lv003=B.lv001 left join sl_lv0005 C on A.lv005=C.lv001 left join sl_lv0059 D on A.lv009=D.lv001 WHERE A.lv002='".$mosl_lv0013->lv001."' order by A.lv015 asc,A.lv001 asc";
	$bResult = db_query($sqlS);
	$sumMoney=0;
	$sumScore=0;
	$sumDiscount=0;
	while ($vrow = db_fetch_array ($bResult)){
	$sumMoney=$sumMoney+$vrow['lv004']*$vrow['lv006'];
	$sumScore=$sumScore+$vrow['lv012'];
	$sumDiscount=$sumDiscount+$vrow['lv004']*$vrow['lv006']*$vrow['lv011']/100;
	
?>		
		<tr class="lvlinehtable1">
			<td width="1%"><?php echo $vorder;?></td>
			<td align="left"><?php echo $vrow['ItemName'];?></td>
			<td align="center"><?php echo $vrow['UnitName'];?></td>
			<td align="right"><?php echo $mosl_lv0014->FormatView($vrow['lv004'],10);?></td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><?php echo $mosl_lv0014->FormatView($vrow['lv006'],10);?></td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><?php echo $mosl_lv0014->FormatView($vrow['lv004']*$vrow['lv006'],10);?></td>
			<td align="left" style="padding:2px;"><?php echo $vrow['ProgName'];?></td>
			<td align="right"><?php echo $mosl_lv0014->FormatView($vrow['lv012'],10);?></td>
		</tr>
<?php
	$vorder++;
}
?>		
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="5">TỔNG TIỀN:</td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0014->FormatView($sumMoney,10);?></strong></td>
			<td align="left">&nbsp;</td>
			<td align="right"><strong><?php echo $mosl_lv0014->FormatView($sumScore,10);?></strong></td>
		</tr>

		<tr ondblclick="this.innerHTML=''">
			<td class="lvlineboldtable" colspan="5">TỔNG TIỀN CHIẾT KHẤU:</td>
			<td class="lvlineboldtable" align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><?php echo $mosl_lv0014->FormatView($sumDiscount,10);?></td>
			<td align="left" colspan="2">&nbsp;</td>
		</tr>
<?php
	if($mosl_lv0013->lv007=="CASH" && $mosl_lv0013->lv022>0)
	{
		 $vsumCash=($sumMoney)*$mosl_lv0013->lv022/100;
?>		
		<tr ondblclick="this.innerHTML=''">
			<td class="lvlineboldtable" colspan="5" >CK TIỀN MẶT(<?php echo $mosl_lv0013->FormatView($mosl_lv0013->lv022,10);?>%):</td>
			<td class="lvlineboldtable" align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><?php echo $mosl_lv0014->FormatView($vsumCash,10);?></td>
			<td align="left" colspan="2">&nbsp;</td>
		</tr>
<?php
	}
?>				
			<tr ondblclick="this.innerHTML=''">
			<td class="lvlineboldtable" colspan="5">TỔNG TIỀN THANH TOÁN:</td>
			<td class="lvlineboldtable" align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><?php echo $mosl_lv0014->FormatView($sumMoney-$sumDiscount-$vsumCash,10);?></td>
			<td align="left" colspan="2">&nbsp;</td>
		</tr>
		<tr ondblclick="this.innerHTML=''">
			<td class="lvlineboldtable" colspan="8">Bằng chữ: <?php echo LNum2Text($sumMoney-$sumDiscount-$vsumCash,$plang);?> </td>
		</tr>
		
		</tbody></table></td>
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
						<td style="text-align:center" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>Người giao</b></span></b></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>Người KS</b></span></b></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>Khách hàng</b></span></b></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="120px"><td colspan="7">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
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
