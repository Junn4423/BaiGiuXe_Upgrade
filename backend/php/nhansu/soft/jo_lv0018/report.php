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
require_once("$vDir../clsall/sl_lv0067.php");


/////////////init object//////////////
$mosl_lv0067=new sl_lv0067($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0067');
$mosl_lv0067->is_tc09_add=0;
$mosl_lv0067->is_tc09_apr=0;
$mosl_lv0067->is_tc09_unapr=0;

$month=getmonth($_GET['YearMonth']);
$year=getyear($_GET['YearMonth']);
if($month=='' || $month==NULL)
{
	$vNow=GetServerDate();
	$month=Fillnum(getmonth($vNow),2);
	$year=Fillnum(getyear($vNow),4);
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
$mosl_lv0067->lv004=$year."-".$month;
if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","SL0078.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0067->ArrPush[0]=$vLangArr[18];
$mosl_lv0067->ArrPush[1]=$vLangArr[19];
$mosl_lv0067->ArrPush[2]=$vLangArr[21];
$mosl_lv0067->ArrPush[3]=$vLangArr[20];
$mosl_lv0067->ArrPush[4]=$vLangArr[22];
$mosl_lv0067->ArrPush[5]=$vLangArr[23];
$mosl_lv0067->ArrPush[6]=$vLangArr[24];
$mosl_lv0067->ArrPush[7]=$vLangArr[25];
$mosl_lv0067->ArrPush[30]=$vLangArr[30];

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
$mosl_lv0067->month=$month;
$mosl_lv0067->year=$year;
$mosl_lv0067->lv004=$year."-".$month;
$mosl_lv0067->datefrom=$year."-".$month."-01";
$mosl_lv0067->dateto=$year."-".$month."-".Fillnum(GetDayInMonth($year,$month),2);
$mosl_lv0067->lv028="";
//if($mosl_lv0067->GetApr()==0)  echo $mosl_lv0067->lv028=$mosl_lv0067->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
//if($mosl_lv0067->GetApr()==0)  $mosl_lv0067->lv028=$mosl_lv0067->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$mosl_lv0067->lv001=$_GET['txtlv001'];
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
if($mosl_lv0067->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
			<div>
					<div style="text-align:center">
						<div><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="90px" height="100px" 
								src="<?php echo "../../images/employees/".$mohr_lv0020->lv001."/".$mohr_lv0020->lv007; ?>" /></div>
						<div style="font-size:35;font-weight:bold;"><?php echo $vLangArr[13];?></div>
						<div style="font-size:16;font-weight:bold;"><?php echo $vLangArr[15].":".$mosl_lv0067->FormatView($mosl_lv0067->datefrom,2);?>&nbsp;&nbsp;&nbsp;<?php echo $vLangArr[16].":".$mosl_lv0067->FormatView($mosl_lv0067->dateto,2);?></div>
					</div>
					<div id="lvleft">
					    <?php 
						$mosl_lv0067->SetAllDisiable();
						echo $mosl_lv0067->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum,0,$_GET['chkviewinfo']);?>
					</div>
					<div ondblclick="this.innerHTML=''" style="cursor:pointer">
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
	include("../sl_lv0067/permit.php");
}
?>

</html>
