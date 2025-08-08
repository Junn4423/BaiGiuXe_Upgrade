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
require_once("../../clsall/jo_lv0040.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/tc_lv0002.php");
require_once("../../clsall/tc_lv0004.php");
require_once("../../clsall/hr_lv0002.php");
/////////////init object//////////////
$mojo_lv0040=new jo_lv0040($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0011');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0002');
$mojo_lv0040->ArrDep=$mohr_lv0002->LV_LoadArray();
$mojo_lv0040->ArrShift=$motc_lv0004->LV_LoadArray();
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0052.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0040->ArrPush[0]=$vLangArr[17];
$mojo_lv0040->ArrPush[1]=$vLangArr[18];
$mojo_lv0040->ArrPush[2]=$vLangArr[20];
$mojo_lv0040->ArrPush[3]=$vLangArr[21];
$mojo_lv0040->ArrPush[4]=$vLangArr[22];
$mojo_lv0040->ArrPush[5]=$vLangArr[23];
$mojo_lv0040->ArrPush[6]=$vLangArr[24];
$mojo_lv0040->ArrPush[7]=$vLangArr[25];
$mojo_lv0040->ArrPush[8]=$vLangArr[26];
$mojo_lv0040->ArrPush[9]=$vLangArr[27];
$mojo_lv0040->ArrPush[10]=$vLangArr[28];
$mojo_lv0040->ArrPush[11]=$vLangArr[29];
$mojo_lv0040->ArrPush[12]=$vLangArr[37];
$mojo_lv0040->ArrPush[13]=$vLangArr[48];
$mojo_lv0040->ArrPush[14]=$vLangArr[43];
$mojo_lv0040->ArrPush[15]=$vLangArr[41];
$mojo_lv0040->ArrPush[16]=$vLangArr[42];
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
$mojo_lv0040->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0040');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0040->lv028=trim($_GET['txtlv003']);
$mojo_lv0040->lv029=trim($_GET['txtlv002']);
if($mojo_lv0040->lv029=="")
{
	if($mojo_lv0040->GetApr()==0)	$mojo_lv0040->lv029=$mojo_lv0040->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
}
$mojo_lv0040->lv030=trim($_GET['txtlv004']);
$mojo_lv0040->lv007=trim($_GET['txtlv006']);
$mojo_lv0040->paratimecard=trim($_GET['txtlv020']);
$mojo_lv0040->lvState=(int)($_GET['txtlv021']);
$mojo_lv0040->lvSort=(int)($_GET['txtlv022']);
$mojo_lv0040->isStaffOff=$_GET['isStaffOff'];
$mojo_lv0040->isChildCheck=(int)$_GET['isChildCheck'];
$vlv221=(int)$_GET['txtlv221'];
if($vlv221==2) $mojo_lv0040->isType=1;
$vlv222=(int)$_GET['txtlv222'];
$isshift=(int)$_GET['txtisshift'];
$mojo_lv0040->datefrom=recoverdate($_GET['txtdatefrom'],$plang);
$mojo_lv0040->dateto=recoverdate($_GET['txtdateto'],$plang);
$year=getyear($mojo_lv0040->datefrom);
$month=getmonth($mojo_lv0040->datefrom);
if($_GET['txtlv004']!="") $mohr_lv0020->LV_LoadID($_GET['txtlv004']);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mojo_lv0040->ListView;
$curPage = $mojo_lv0040->CurPage;
$maxRows =$mojo_lv0040->MaxRows;
$vOrderList=$mojo_lv0040->ListOrder;
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mojo_lv0040->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<div>
<style>
table td 
{
	padding:2px;
}
</style>
<?php
if($mojo_lv0040->GetView()==1)
{
if($vlv221==1)
{
	/*echo "<center><div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$mojo_lv0040->FormatView($mojo_lv0040->datefrom,2)." to ".$mojo_lv0040->FormatView($mojo_lv0040->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div></center>";*/
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $mojo_lv0040->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$isshift);
}
else
{
	/*echo "<center><div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$mojo_lv0040->FormatView($mojo_lv0040->datefrom,2)." to ".$mojo_lv0040->FormatView($mojo_lv0040->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div></center>";*/
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $mojo_lv0040->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$isshift);
   
?>	
</div>

</div>		
<?php
}
} else {
	include("../permit.php");
}
?>
