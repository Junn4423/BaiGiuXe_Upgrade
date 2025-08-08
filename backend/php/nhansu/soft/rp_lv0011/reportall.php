<?php
session_start();
$sExport=$_GET['childfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=timecard.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=timecard.doc');
}
if($sExport=="pdf"){
header('Content-Type: text/html; charset=utf-8');}
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="timecard.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/rp_lv0011.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/tc_lv0002.php");
require_once("../../clsall/tc_lv0004.php");
require_once("../../clsall/jo_lv0004.php");
require_once("../../clsall/hr_lv0038.php");
require_once("../../clsall/tc_lv0020.php");
require_once("../../clsall/hr_lv0002.php");
require_once("../../clsall/tc_lv0013.php");
/////////////init object//////////////
$morp_lv0011=new rp_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0146');
$mojo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0002');
$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$morp_lv0011->ArrDep=$mohr_lv0002->LV_LoadArray();
$morp_lv0011->ArrShift=$motc_lv0004->LV_LoadArray();
$morp_lv0011->motc_lv0020=$motc_lv0020;
$morp_lv0011->mohr_lv0038=$mohr_lv0038;
$morp_lv0011->motc_lv0013=$motc_lv0013;
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0052.txt",$plang);
$morp_lv0011->DonXinPhep=$mojo_lv0004;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0011->mohr_lv0038=$mohr_lv0038;
$morp_lv0011->ArrPush[0]=$vLangArr[17];
$morp_lv0011->ArrPush[1]=$vLangArr[18];
$morp_lv0011->ArrPush[2]=$vLangArr[20];
$morp_lv0011->ArrPush[3]=$vLangArr[21];
$morp_lv0011->ArrPush[4]=$vLangArr[22];
$morp_lv0011->ArrPush[5]=$vLangArr[23];
$morp_lv0011->ArrPush[6]=$vLangArr[24];
$morp_lv0011->ArrPush[7]=$vLangArr[25];
$morp_lv0011->ArrPush[8]=$vLangArr[26];
$morp_lv0011->ArrPush[9]=$vLangArr[27];
$morp_lv0011->ArrPush[10]=$vLangArr[28];
$morp_lv0011->ArrPush[11]=$vLangArr[29];
$morp_lv0011->ArrPush[12]=$vLangArr[37];
$morp_lv0011->ArrPush[13]=$vLangArr[48];
$morp_lv0011->ArrPush[14]=$vLangArr[43];
$morp_lv0011->ArrPush[15]=$vLangArr[41];
$morp_lv0011->ArrPush[16]=$vLangArr[42];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
//$ma=$_GET['ma'];
$lvopt=$_GET['txtopt'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0011->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0011');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0011->lv028=trim($_GET['txtlv003']);
$morp_lv0011->lv029=trim($_GET['txtlv002']);
//if($morp_lv0011->GetApr()==0)	$morp_lv0011->lv029_=$morp_lv0011->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$morp_lv0011->lv030=$morp_lv0011->LV_UserID;
$morp_lv0011->lv007=trim($_GET['txtlv006']);
$morp_lv0011->paratimecard=trim($_GET['txtlv020']);
$morp_lv0011->lvState=(int)($_GET['txtlv021']);
$morp_lv0011->lvSort=(int)($_GET['txtlv022']);
$morp_lv0011->isStaffOff=$_GET['isStaffOff'];
$morp_lv0011->isChildCheck=(int)$_GET['isChildCheck'];
$vShowDept=$_GET['ShowDept'];
$vlv221=(int)$_GET['txtlv221'];
if($vlv221==2) $morp_lv0011->isType=1;
$vlv222=(int)$_GET['txtlv222'];
$morp_lv0011->datefrom=recoverdate($_GET['txtdatefrom'],$plang);
$morp_lv0011->dateto=recoverdate($_GET['txtdateto'],$plang);
$year=getyear($morp_lv0011->datefrom);
$month=getmonth($morp_lv0011->datefrom);
$morp_lv0011->motc_lv0013->LV_LoadActiveIDMonth((int)$month,$year);
//$morp_lv0011->datefrom=$year."-".Fillnum($month,2)."-01";
//$morp_lv0011->dateto=$year."-".Fillnum($month,2)."-".GetDayInMonth($year,$month);
if($morp_lv0011->LV_UserID!="") $mohr_lv0020->LV_LoadID($morp_lv0011->LV_UserID);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$morp_lv0011->ListView;
$curPage = $morp_lv0011->CurPage;
$maxRows =$morp_lv0011->MaxRows;
$vOrderList=$morp_lv0011->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$morp_lv0011->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
if ($sExport == "excel" || $sExport == "world") {
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
}
else
{
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<div>
<script>
function Show_CC_Title(Stt)
{
	if(document.getElementById('CC_Title_'+Stt).innerHTML=='')
	{
		document.getElementById('CC_Title_'+Stt).innerHTML=document.getElementById('CC_Title').innerHTML;
		document.getElementById('CCC_Title_'+Stt).innerHTML=document.getElementById('CCC_Title').innerHTML;
	}
	else
	{
		document.getElementById('CC_Title_'+Stt).innerHTML='';
		document.getElementById('CCC_Title_'+Stt).innerHTML='';
	}
	
}
</script>
<style>
table td 
{
	padding:2px;
}
</style>
<?php
}
if($morp_lv0011->GetView()==1)
{
if($vlv221==1)
{
	echo "<div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$morp_lv0011->FormatView($morp_lv0011->datefrom,2)." to ".$morp_lv0011->FormatView($morp_lv0011->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div>";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $morp_lv0011->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$sExport);
}
elseif($vlv221==3)
{
	$morp_lv0011->datefrom=$year."-".Fillnum(1,2)."-01";
	$morp_lv0011->dateto=recoverdate($_GET['txtdateto'],$plang);
	//$morp_lv0011->dateto=$year."-".Fillnum(3,2)."-".GetDayInMonth($year,'03');
	echo "<div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$morp_lv0011->FormatView($morp_lv0011->datefrom,2)." to ".$morp_lv0011->FormatView($morp_lv0011->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div>";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $morp_lv0011->LV_BuilListReportOtherPrintClearAL_CL($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$sExport);
}
else
{
	?>
<table border="0" cellspacing="0" style="width: 1000px;">
<tbody>
<?php
if ($sExport!= "excel" &&  $sExport != "world") {
	?>`
	<tr>
	<td colspan="5" rowspan="4" align="center" valign="middle"><strong><span style="font-size: large;">
	<img ondblclick="this.src='../../logotech.png'" src="../../logo.png" style="height:80px"/>
	</span></strong></td>
	<td colspan="5" rowspan="2" align="left" valign="middle" width="500"><strong><span style="font-size: medium;text-align:center"><div ondblclick="this.innerHTML='MINH PHUONG INVESTMENT TECHNOLOGY JSC'">CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG</div></span></strong></td>
	<td colspan="16" rowspan="4" align="center" valign="middle"><strong><span style="font-size: large;font-size:24px"></span></strong>
	</td>
	</tr>
<?php
}
else
{
?>
<tr>
	<td colspan="10" rowspan="2" align="left" valign="middle" width="500"><strong><span style="font-size: medium;text-align:center"><div ondblclick="this.innerHTML='MINH PHUONG INVESTMENT TECHNOLOGY JSC'">CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG</div></span></strong></td>
	<td colspan="16" rowspan="4" align="center" valign="middle"><strong><span style="font-size: large;font-size:24px"></span></strong>
	</td>
	</tr>
<?php
}
?>
<tr>
</tr>
<?php
if ($sExport == "excel" || $sExport == "world") {
	?>
<tr>
<td colspan="5" align="center" valign="middle"><strong><span style="border:0px #fff solid;width:100%;text-align:center;font:bold 20px arial,tahoma;"> BÁO CÁO CÔNG" </strong></td>
</tr>
<tr>
<td colspan="5" align="center" valign="middle"><span style="border:0px #fff solid;width:100%;text-align:center;">
<?php echo 'Từ ngày';?>:<?php echo $morp_lv0011->FormatView($morp_lv0011->datefrom,2);?> <?php echo ' đến ngày';?> <?php echo $morp_lv0011->FormatView($morp_lv0011->dateto,2);?></span></td>
</tr>
<?php
}
else
{
?>	
<tr>
<td colspan="5" align="center" valign="middle"><strong><span >
	
<input type="text" value="BÁO CÁO CÔNG" style="border:0px #fff solid;width:100%;text-align:center;font:bold 20px arial,tahoma;"/></span></strong></td>
</tr>
<tr>
<td colspan="5" align="center" valign="middle"><span style="font-size: small;"><input type="text" value="<?php echo 'Từ ngày';?>:<?php echo $morp_lv0011->FormatView($morp_lv0011->datefrom,2);?> <?php echo ' đến ngày';?> <?php echo $morp_lv0011->FormatView($morp_lv0011->dateto,2);?>" style="border:0px #fff solid;width:100%;text-align:center;"/></td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php	
	echo "<!--<div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$morp_lv0011->FormatView($morp_lv0011->datefrom,2)." to ".$morp_lv0011->FormatView($morp_lv0011->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div>-->";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $morp_lv0011->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$sExport,0,$vShowDept);
    if(trim($mohr_lv0020->lv001)!="" && $mohr_lv0020->lv001!=NULL)
	{
		if($year=="" && $month=="")
		{
			$lvNow=GetServerDate();
			$lvyear=getyear($lvNow);
			$lvmonth=getmonth($lvNow);
			echo $morp_lv0011->GetTimeCode($mohr_lv0020->lv001,"2000-01-01",$lvyear."-".$lvmonth."-".GetDayInMonth((int)$lvyear,(int)$lvmonth),'1');
		}
		else
    		echo $morp_lv0011->GetTimeCode($mohr_lv0020->lv001,$year."-".$month."-01",$year."-".$month."-".GetDayInMonth((int)$year,(int)$month),'1');
    }            
                
?>	
<?php
if(strpos('  ;'.$morp_lv0011->paratimecard.";",';7;')>0)
	{
$motc_lv0002=new tc_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0003.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0002->ArrPush[0]=$vLangArr[17];
$motc_lv0002->ArrPush[1]=$vLangArr[18];
$motc_lv0002->ArrPush[2]=$vLangArr[20];
$motc_lv0002->ArrPush[3]=$vLangArr[21];
$motc_lv0002->ArrPush[4]=$vLangArr[22];
$motc_lv0002->ArrPush[5]=$vLangArr[23];
$motc_lv0002->ArrPush[6]=$vLangArr[24];
$motc_lv0002->ArrPush[7]=$vLangArr[25];
$motc_lv0002->ArrPush[8]=$vLangArr[26];


	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0002->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////

$maxRows = 10000;
$vFieldList='lv001,lv002,lv003';
echo $motc_lv0002->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
$vOrderList='';
	}
if(strpos('  ;'.$morp_lv0011->paratimecard.";",';15;')>0)
	{
$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0007.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0004->ArrPush[0]='';
$motc_lv0004->ArrPush[1]=$vLangArr[18];
$motc_lv0004->ArrPush[2]=$vLangArr[20];
$motc_lv0004->ArrPush[3]=$vLangArr[21];
$motc_lv0004->ArrPush[4]=$vLangArr[22];
$motc_lv0004->ArrPush[5]=$vLangArr[23];
$motc_lv0004->ArrPush[6]=$vLangArr[31];
$motc_lv0004->ArrPush[7]=$vLangArr[32];
$motc_lv0004->ArrPush[8]=$vLangArr[33];
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0004->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0004');
//////////////////////////////////////////////////////////////////////////////////////////////////////

$maxRows = 10000;
echo $motc_lv0004->LV_BuilListReportNoLogo($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
					
	}
if(strpos('  ;'.$morp_lv0011->paratimecard.";",'21;')>0)
	{
?>

<div style="float:left">	
<h2><?php echo $vLangArr[48];?></h2>
<br />
<ul style="padding:10px;margin:0px;">
<li><?php echo $vLangArr[49];?></li>
<li><?php echo $vLangArr[50];?></li>
<li><?php echo $vLangArr[51];?></li>
<li><?php echo $vLangArr[52];?></li>
<li><?php echo $vLangArr[53];?></li>
</ul>	
</div>
</div>
<?php
}
if(strpos('  ;'.$morp_lv0011->paratimecard.";",'20;')>0 && 1==0)
	{
?>

<div style="float:left">	
<h2><?php echo 'PHẢN ÁNH GIỜ VÀO RA';?></h2>
<br />
<ul style="padding:10px;margin:0px;">
<!--<li><?php echo 'Màu xanh là giờ vào bình thường lấy từ máy chấm công';?></li>-->
<li><?php echo 'Giờ có gạch chân là giờ vào được nhập tay vào';?></li>
<!--<li><?php echo 'Màu đỏ là giờ làm ra qua ngày (giờ ra ca 3)';?></li>
<li><?php echo 'Giờ bị gạch giữ (xóa) là giờ bị xóa';?></li>-->
</ul>	
</div>
</div>
<?php
}
?>
</div>	
						
<?php
}
} else {
	include("../permit.php");
}
?>
