<?php
session_start();
$sExport=$_GET['childfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=bangcom'.$_GET['txtmonth']."-".$_GET['txtyear'].'.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=bangcom'.$_GET['txtmonth']."-".$_GET['txtyear'].'.doc');
}
if($sExport=="pdf"){
header('Content-Type: text/html; charset=utf-8');}


//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
//}
$vDir='../';
include($vDir."paras.php");
include($vDir."config.php");
include($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/rp_lv0014.php");
require_once("$vDir../clsall/tc_lv0009.php");
require_once("$vDir../clsall/tc_lv0013.php");
require_once("$vDir../clsall/tc_lv0011.php");
require_once("$vDir../clsall/tc_lv0002.php");
require_once("$vDir../clsall/hr_lv0020.php");

/////////////init object//////////////
$morp_lv0014=new rp_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0014');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$morp_lv0014->Dir=$vDir;
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0002=new tc_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0002');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$morp_lv0014->is_tc09_add=0;
$morp_lv0014->is_tc09_apr=0;
$morp_lv0014->is_tc09_unapr=0;

if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","TC0091.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0014->ArrPush[0]=$vLangArr[18];
$morp_lv0014->ArrPush[1]=$vLangArr[19];
$morp_lv0014->ArrPush[2]=$vLangArr[21];
$morp_lv0014->ArrPush[3]=$vLangArr[20];
$morp_lv0014->ArrPush[4]=$vLangArr[22];
$morp_lv0014->ArrPush[5]=$vLangArr[23];
$morp_lv0014->ArrPush[6]=$vLangArr[24];
$morp_lv0014->ArrPush[7]=$vLangArr[25];
$morp_lv0014->ArrPush[30]=$vLangArr[29];
$morp_lv0014->ArrPush[39]=$vLangArr[39];

//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_GET["txtStringID"];
$flagID=(int)$_GET["txtFlag"];
$vFieldList=$_GET['txtFieldList'];
if(strpos($vFieldList,'lv001')===false) $vFieldList='lv001,'.$vFieldList;
$vOrderList=$_GET['txtOrderList'];
$vOrderList=$_GET['txtOrderList'];
$vStrMessage="";

if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$motc_lv0009->LV_LoadMonthID($morp_lv0014->lvNVID,$month,$year);
$motc_lv0009->LV_ReLoadMonthID($morp_lv0014->lvNVID,$month_re,$year_re);
$morp_lv0014->opt=$_GET['txtopt'];



$morp_lv0014->datefrom=recoverdate($_GET['txtdatefrom'],$plang);
$morp_lv0014->dateto=recoverdate($_GET['txtdateto'],$plang);
$month=getmonth($morp_lv0014->datefrom);
$year=getyear($morp_lv0014->datefrom);
$morp_lv0014->month=$month;
$morp_lv0014->year=$year;
//$morp_lv0014->day=$_GET['txtday'];
$morp_lv0014->lv004=$year."-".$month;
$year=getyear($morp_lv0014->datefrom);
$month=getmonth($morp_lv0014->datefrom);
$morp_lv0014->lv028="";
//if($morp_lv0014->GetApr()==0)  echo $morp_lv0014->lv028=$morp_lv0014->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$morp_lv0014->lv029=$_GET['txtlv002'];
$morp_lv0014->comkh=$_GET['txtlvcomkh'];
$morp_lv0014->comnv=$_GET['txtlvcomnv'];
if($morp_lv0014->GetApr()==0){
$morp_lv0014->lv029=$morp_lv0014->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');	
if($morp_lv0014->lv029=="") $morp_lv0014->lv029="''";
}	
$motc_lv0013->LV_LoadActiveIDMonth($month,$year);
$morp_lv0014->motc_lv0013=$motc_lv0013;
$morp_lv0014->lv001=$_GET['txtlv004'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<style type="text/css">
.lvsizeinput
{width:60px;
border:1;
}
.lvsizeinput2
{width:180px;
border:1;
}
.lvsizeselect
{width:160px;
border:1;
}
.lvsizeselect2
{width:60px;
border:1;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
</head>
<?php
if($morp_lv0014->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
			<div>
					<div style="text-align:center">
						<div ondblclick="this.innerHTML=''"><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="90px" height="100px" 
								src="<?php echo "../../images/employees/".$mohr_lv0020->lv001."/".$mohr_lv0020->lv007; ?>" /></div>
						
						<?php
							if(trim($morp_lv0014->day)!="")
							{
						?>
							<div style="font-size:35;font-weight:bold;"><?php echo $vLangArr[14];?></div>
							<div style="font-size:16;font-weight:bold;"><?php echo 	Ngày.":".$morp_lv0014->FormatView($morp_lv0014->year."-".$morp_lv0014->month."-".$morp_lv0014->day,2);?></div>
						<?php
							}
							else
							{
								if($_GET['txtopt']!=2)
								{
							?>
								<div style="font-size:35;font-weight:bold;"><?php echo $vLangArr[14];?></div>
								<div style="font-size:16;font-weight:bold;"><?php echo $vLangArr[15].":".$morp_lv0014->FormatView($morp_lv0014->datefrom,2);?>&nbsp;&nbsp;&nbsp;<?php echo $vLangArr[16].":".$morp_lv0014->FormatView($morp_lv0014->dateto,2);?></div>
								<?php
								}
								else
								{?>
								<center>
								<table style="width: 972px;font:12px Arial,tahoma; " border="0" cellspacing="0" cellpadding="0">
								<tr height="35">
								<td  width="972" height="35" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: x-large;">&nbsp;&nbsp;   <strong>MONTHLY MEAL VOUCHER FOLLOW UP&nbsp;&nbsp;</strong></span></td>
								</tr>
								<tr height="27">
								<td align="center">&nbsp;&nbsp;&nbsp;<strong>&nbsp; From: <?php echo $morp_lv0014->FormatView($morp_lv0014->datefrom,2);?> - <?php echo $morp_lv0014->FormatView($morp_lv0014->dateto,2);?></strong></td>
								</tr>
								<tr height="26">
								<td align="center">&nbsp;&nbsp; <strong>Date: <?php echo $morp_lv0014->FormatView(GetServerDate(),2);?></strong></td>
								</tr>
								<tr height="25">
								<td height="25">&nbsp;</td>
								</tr>
								</tbody>
								</table>
								</center>
							<?php
							}
							}
							?>
					</div>
					<div id="lvleft">
					    <?php 
						$morp_lv0014->SetAllDisiable();
						echo $morp_lv0014->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$_GET['txtopt'],$_GET['chkviewinfo']);?>
					</div>
				
		</div>
</body>
				
<?php
} else {
	include("../rp_lv0014/permit.php");
}
?>

</html>
