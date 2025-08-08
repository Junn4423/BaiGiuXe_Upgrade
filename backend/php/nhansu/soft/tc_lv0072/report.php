<?php
session_start();
$sExport=$_GET['childfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=bangchamcong'.$_GET['YearMonth'].'.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=bangchamcong'.$_GET['YearMonth'].'.doc');
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
require_once("$vDir../clsall/tc_lv0072.php");
require_once("$vDir../clsall/tc_lv0009.php");
require_once("$vDir../clsall/tc_lv0013.php");
require_once("$vDir../clsall/tc_lv0011.php");
require_once("$vDir../clsall/tc_lv0002.php");
require_once("$vDir../clsall/hr_lv0020.php");

/////////////init object//////////////
$motc_lv0072=new tc_lv0072($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0072');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$motc_lv0072->Dir=$vDir;
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0002=new tc_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0002');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$motc_lv0072->is_tc09_add=0;
$motc_lv0072->is_tc09_apr=0;
$motc_lv0072->is_tc09_unapr=0;

$month=getmonth($_GET['YearMonth']);
$year=getyear($_GET['YearMonth']);
if($month=='' || $month==NULL)
{
	$motc_lv0013->LV_LoadActiveID();
	$vNow=$motc_lv0013->lv004;
	$month=Fillnum($motc_lv0013->lv006,2);
	$year=Fillnum($motc_lv0013->lv007,4);
}
if((int)$month==1)
{
	$month_re=12;
	$year_re=$year -1;
}
else
{
	$month_re=$month-1;
	$year_re=$year;
}
$motc_lv0072->lv004=$year."-".$month;
if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","TC0091.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0072->ArrPush[0]=$vLangArr[18];
$motc_lv0072->ArrPush[1]=$vLangArr[19];
$motc_lv0072->ArrPush[2]=$vLangArr[21];
$motc_lv0072->ArrPush[3]=$vLangArr[20];
$motc_lv0072->ArrPush[4]=$vLangArr[22];
$motc_lv0072->ArrPush[5]=$vLangArr[23];
$motc_lv0072->ArrPush[6]=$vLangArr[24];
$motc_lv0072->ArrPush[7]=$vLangArr[25];
$motc_lv0072->ArrPush[8]=$vLangArr[40];
$motc_lv0072->ArrPush[30]=$vLangArr[30];

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
$motc_lv0009->LV_LoadMonthID($motc_lv0072->lvNVID,$month,$year);
$motc_lv0009->LV_ReLoadMonthID($motc_lv0072->lvNVID,$month_re,$year_re);
$motc_lv0013->LV_LoadActiveIDMonth($month,$year);
$motc_lv0072->CalID=$motc_lv0013->lv001;
$motc_lv0072->month=$month;
$motc_lv0072->year=$year;
$motc_lv0072->lv004=$year."-".$month;
if($_GET['dayfrom']!="")
	$motc_lv0072->datefrom=$year."-".$month."-".$_GET['dayfrom'];
else
	$motc_lv0072->datefrom=$motc_lv0013->lv004;
if($_GET['dayto']!="")
	$motc_lv0072->dateto=$year."-".$month."-".$_GET['dayto'];
else
	$motc_lv0072->dateto=$motc_lv0013->lv005;
$motc_lv0072->isTime=(int)$_GET['isTime'];
$motc_lv0072->lv028="";
if($motc_lv0072->GetApr()==0)  echo $motc_lv0072->lv028=$motc_lv0072->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$motc_lv0072->lv029=$_GET['txtlv029'];
if($motc_lv0072->GetApr()==0)  $motc_lv0072->lv028=$motc_lv0072->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
if(!isset($_GET['txtlv029']))	
{
	if($motc_lv0072->lv029=="") 
	{
		$mohr_lv0020->LV_LoadID(getInfor($_SESSION['ERPSOFV2RUserID'],2));
		$motc_lv0072->lv029=$mohr_lv0020->lv029;
	}
}	
$motc_lv0072->lv001=$_GET['txtlv001'];
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
if($motc_lv0072->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
			<div>
					<div style="text-align:center">
						<div><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="90px" height="100px" 
								src="<?php echo "../../images/employees/".$mohr_lv0020->lv001."/".$mohr_lv0020->lv007; ?>" /></div>
						<div style="font-size:35;font-weight:bold;"><?php echo $vLangArr[13];?></div>
						<div style="font-size:16;font-weight:bold;"><?php echo $vLangArr[15].":".$motc_lv0072->FormatView($motc_lv0072->datefrom,2);?>&nbsp;&nbsp;&nbsp;<?php echo $vLangArr[16].":".$motc_lv0072->FormatView($motc_lv0072->dateto,2);?></div>
					</div>
					<div id="lvleft">
					    <?php 
						$motc_lv0072->SetAllDisiable();
						echo $motc_lv0072->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum,0,$_GET['chkviewinfo']);?>
					</div>
					<div ondblclick="this.innerHTML=''" style="cursor:pointer">
					<?php 
					if($plang=="") $plang="VN";
						$vLangArr=GetLangFile("$vDir../","TC0003.txt",$plang);

					//////////////////////////////////////////////////////////////////////////////////////////////////////
					$motc_lv0002->ArrPush[0]='';
					$motc_lv0002->ArrPush[1]=$vLangArr[18];
					$motc_lv0002->ArrPush[2]=$vLangArr[20];
					$motc_lv0002->ArrPush[3]=$vLangArr[21];
					$motc_lv0002->ArrPush[4]=$vLangArr[22];
					$motc_lv0002->ArrPush[5]='Tổng';
					echo $motc_lv0002->LV_BuilListReportTC('lv001,lv002,lv003,lv004','document.frmchoose','chkAll','lvChk',$curRow, 1000,$paging,'',$motc_lv0072->ArrTC);?>
					</div>
					<div>
						<table style="width: 100%;" border="0" align="center">
<tbody>
<tr height="5">
<td width="55"><br /></td>
<td width="55"><br /></td>
<td width="55"><br /></td>
<td width="55"><br /></td>
<td width="55"><br /></td>
<td width="30"><br /></td>
<td width="80"><br /></td>
<td width="55"><br /></td>
<td width="85"><br /></td>
<td width="28"><br /></td>
</tr>
<tr>
<td><br /></td>
<td colspan="3">
<div style="text-align: center;"><strong>NGƯỜI KÝ DUYỆT<br /></strong></div>
</td>
<td><br /></td>
<td><br /></td>
<td colspan="3">
<div style="text-align: center;"><strong>NGƯỜI LẬP<br /></strong></div>
</td>
<td><br /></td>
</tr>
<tr>
<td><br /></td>
<td colspan="3">
<div style="text-align: center;"><em>(K&yacute; t&ecirc;n)</em></div>
</td>
<td><br /></td>
<td><br /></td>
<td colspan="3">
<div style="text-align: center;"><em>(K&yacute; t&ecirc;n)</em></div>
</td>
<td><br /></td>
</tr>
<tr>
<td><br /></td>
<td colspan="3">
<div style="text-align: center;"><em>Ghi r&otilde; họ v&agrave; t&ecirc;n</em></div>
</td>
<td><br /></td>
<td><br /></td>
<td colspan="3">
<div style="text-align: center;"><em>Ghi r&otilde; họ v&agrave; t&ecirc;n</em></div>
</td>
<td><br /></td>
</tr>
<tr>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
</tr>
<tr>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
<td><br /></td>
</tr>
<tr>
<td><br /></td>
<td colspan="3">
<div style="text-align: center;">....................................</div>
</td>
<td><br /></td>
<td><br /></td>
<td colspan="3">
<div style="text-align: center;">....................................</div>
</td>
<td><br /></td>
</tr>
</tbody>
</table>
					</div>
		</div>
</body>
				
<?php
} else {
	include("../tc_lv0072/permit.php");
}
?>

</html>
