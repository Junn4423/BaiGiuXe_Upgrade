<?php
session_start();
$sExport=$_GET['func'];
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
require_once("../../clsall/hr_lv0016.php");

/////////////init object//////////////
$mohr_lv0016=new hr_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0042');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0133.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0016->ArrPush[0]=$vLangArr[17];
$mohr_lv0016->ArrPush[1]=$vLangArr[18];
$mohr_lv0016->ArrPush[2]=$vLangArr[20];
$mohr_lv0016->ArrPush[3]=$vLangArr[21];

$mohr_lv0016->ArrFunc[0]='//Function';
$mohr_lv0016->ArrFunc[1]=$vLangArr[2];
$mohr_lv0016->ArrFunc[2]=$vLangArr[4];
$mohr_lv0016->ArrFunc[3]=$vLangArr[6];
$mohr_lv0016->ArrFunc[4]=$vLangArr[7];
$mohr_lv0016->ArrFunc[5]='';
$mohr_lv0016->ArrFunc[6]='';
$mohr_lv0016->ArrFunc[7]='';
$mohr_lv0016->ArrFunc[8]=$vLangArr[8];
$mohr_lv0016->ArrFunc[9]=$vLangArr[10];
$mohr_lv0016->ArrFunc[10]=$vLangArr[0];
$mohr_lv0016->ArrFunc[11]=$vLangArr[24];
////Other
$mohr_lv0016->ArrOther[1]=$vLangArr[22];
$mohr_lv0016->ArrOther[2]=$vLangArr[23];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0016->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0016');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0016->ListView;
$curPage = $mohr_lv0016->CurPage;
$maxRows =$mohr_lv0016->MaxRows;
$vOrderList=$mohr_lv0016->ListOrder;
$vSortNum=$mohr_lv0016->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0016->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mohr_lv0016->GetView()==1)
{
?>

				<?php echo $mohr_lv0016->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
