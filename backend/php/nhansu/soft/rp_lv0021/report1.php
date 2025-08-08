<?php
session_start();
$sExport=$_GET['func'];
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
require_once("../../clsall/rp_lv0021.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/tc_lv0002.php");
require_once("../../clsall/tc_lv0004.php");
require_once("../../clsall/hr_lv0002.php");
/////////////init object//////////////
$morp_lv0021=new rp_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0021');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0002');
$morp_lv0021->ArrDep=$mohr_lv0002->LV_LoadArray();
$morp_lv0021->ArrShift=$motc_lv0004->LV_LoadArray();
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0052.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0021->ArrPush[0]=$vLangArr[17];
$morp_lv0021->ArrPush[1]=$vLangArr[18];
$morp_lv0021->ArrPush[2]=$vLangArr[20];
$morp_lv0021->ArrPush[3]=$vLangArr[21];
$morp_lv0021->ArrPush[4]=$vLangArr[22];
$morp_lv0021->ArrPush[5]=$vLangArr[23];
$morp_lv0021->ArrPush[6]=$vLangArr[24];
$morp_lv0021->ArrPush[7]=$vLangArr[25];
$morp_lv0021->ArrPush[8]=$vLangArr[26];
$morp_lv0021->ArrPush[9]=$vLangArr[27];
$morp_lv0021->ArrPush[10]=$vLangArr[28];
$morp_lv0021->ArrPush[11]=$vLangArr[29];
$morp_lv0021->ArrPush[12]=$vLangArr[37];
$morp_lv0021->ArrPush[13]=$vLangArr[48];
$morp_lv0021->ArrPush[14]=$vLangArr[43];
$morp_lv0021->ArrPush[15]=$vLangArr[41];
$morp_lv0021->ArrPush[16]=$vLangArr[42];
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
$morp_lv0021->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0021');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0021->lv028=trim($_GET['txtlv003']);
$morp_lv0021->lv029=trim($_GET['txtlv002']);
if($morp_lv0021->lv029=="")
{
	if($morp_lv0021->GetApr()==0)	$morp_lv0021->lv029=$morp_lv0021->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
}
$morp_lv0021->lv030=trim($_GET['txtlv004']);
$morp_lv0021->lv007=trim($_GET['txtlv006']);
$morp_lv0021->paratimecard=trim($_GET['txtlv020']);
$morp_lv0021->lvState=(int)($_GET['txtlv021']);
$morp_lv0021->lvSort=(int)($_GET['txtlv022']);
$morp_lv0021->isStaffOff=$_GET['isStaffOff'];
$vlv221=(int)$_GET['txtlv221'];
if($vlv221==2) $morp_lv0021->isType=1;
$vlv222=(int)$_GET['txtlv222'];
$isshift=(int)$_GET['txtisshift'];
$morp_lv0021->datefrom=recoverdate($_GET['txtdatefrom'],$plang);
$morp_lv0021->dateto=recoverdate($_GET['txtdateto'],$plang);
$year=getyear($morp_lv0021->datefrom);
$month=getmonth($morp_lv0021->datefrom);
if($_GET['txtlv004']!="") $mohr_lv0020->LV_LoadID($_GET['txtlv004']);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$morp_lv0021->ListView;
$curPage = $morp_lv0021->CurPage;
$maxRows =$morp_lv0021->MaxRows;
$vOrderList=$morp_lv0021->ListOrder;
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$morp_lv0021->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<div>
<style>
table td 
{
	padding:2px;
}
</style>
<?php
if($morp_lv0021->GetView()==1)
{
if($vlv221==1)
{
	echo "<!--<div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$morp_lv0021->FormatView($morp_lv0021->datefrom,2)." to ".$morp_lv0021->FormatView($morp_lv0021->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div>-->";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $morp_lv0021->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$isshift);
}
else
{
	echo "<!--<div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$morp_lv0021->FormatView($morp_lv0021->datefrom,2)." to ".$morp_lv0021->FormatView($morp_lv0021->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div>-->";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $morp_lv0021->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$isshift);
    if(trim($mohr_lv0020->lv001)!="" && $mohr_lv0020->lv001!=NULL)
	{
		if($year=="" && $month=="")
		{
			$lvNow=GetServerDate();
			$lvyear=getyear($lvNow);
			$lvmonth=getmonth($lvNow);
			echo $morp_lv0021->GetTimeCode($mohr_lv0020->lv001,"2000-01-01",$lvyear."-".$lvmonth."-".GetDayInMonth((int)$lvyear,(int)$lvmonth),'1');
		}
		else
    		echo $morp_lv0021->GetTimeCode($mohr_lv0020->lv001,$year."-".$month."-01",$year."-".$month."-".GetDayInMonth((int)$year,(int)$month),'1');
    }            
                
?>	
</div>
</div>		
<?php
}
} else {
	include("../permit.php");
}
?>
