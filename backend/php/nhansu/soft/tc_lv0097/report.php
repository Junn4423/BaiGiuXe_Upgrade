<?php
session_start();
$sExport=$_GET['childfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=employees.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=employees.doc');
}
if($sExport=="pdf"){
header('Content-Type: text/html; charset=utf-8');}


//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0097.php");

/////////////init object//////////////
$motc_lv0097=new tc_lv0097($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0097');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0126.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0097->ArrPush[0]=$vLangArr[17];
$motc_lv0097->ArrPush[1]=$vLangArr[18];
$motc_lv0097->ArrPush[2]=$vLangArr[19];
$motc_lv0097->ArrPush[3]=$vLangArr[20];
$motc_lv0097->ArrPush[4]=$vLangArr[21];
$motc_lv0097->ArrPush[5]=$vLangArr[22];
$motc_lv0097->ArrPush[6]=$vLangArr[23];
$motc_lv0097->ArrPush[7]=$vLangArr[24];
$motc_lv0097->ArrPush[8]=$vLangArr[25];
$motc_lv0097->ArrPush[9]=$vLangArr[26];
$motc_lv0097->ArrPush[10]=$vLangArr[27];
$motc_lv0097->ArrPush[11]=$vLangArr[28];
$motc_lv0097->ArrPush[12]=$vLangArr[29];
$motc_lv0097->ArrPush[13]=$vLangArr[30];
$motc_lv0097->ArrPush[14]=$vLangArr[31];
$motc_lv0097->ArrPush[15]=$vLangArr[32];
$motc_lv0097->ArrPush[16]=$vLangArr[33];
$motc_lv0097->ArrPush[17]=$vLangArr[34];
$motc_lv0097->ArrPush[18]=$vLangArr[35];
$motc_lv0097->ArrPush[19]=$vLangArr[36];
$motc_lv0097->ArrPush[20]=$vLangArr[37];
$motc_lv0097->ArrPush[21]=$vLangArr[38];
$motc_lv0097->ArrPush[22]=$vLangArr[39];
$motc_lv0097->ArrPush[23]=$vLangArr[40];
$motc_lv0097->ArrPush[24]=$vLangArr[41];
$motc_lv0097->ArrPush[25]=$vLangArr[42];
$motc_lv0097->ArrPush[26]=$vLangArr[43];
$motc_lv0097->ArrPush[27]='BQ Công';
$motc_lv0097->ArrPush[28]='Thưởng tết';
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0097->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0097');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0097->lv002=base64_decode( $_GET['ID']);
$vFieldList=$motc_lv0097->ListView;
$curPage = $motc_lv0097->CurPage;
$maxRows =$motc_lv0097->MaxRows;
$vOrderList=$motc_lv0097->ListOrder;
$vSortNum=$motc_lv0097->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0097->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($motc_lv0097->GetView()==1)
{
?>

				<?php echo $motc_lv0097->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
