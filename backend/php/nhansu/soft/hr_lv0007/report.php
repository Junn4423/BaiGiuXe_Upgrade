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
require_once("../../clsall/hr_lv0007.php");

/////////////init object//////////////
$mohr_lv0007=new hr_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'HR0023');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0059.txt",$plang);

$mohr_lv0007->ArrPush[0]=$vLangArr[17];
$mohr_lv0007->ArrPush[1]=$vLangArr[18];
$mohr_lv0007->ArrPush[2]=$vLangArr[20];
$mohr_lv0007->ArrPush[3]=$vLangArr[21];
$mohr_lv0007->ArrPush[4]=$vLangArr[22];
$mohr_lv0007->ArrPush[5]=$vLangArr[23];
$mohr_lv0007->ArrPush[6]=$vLangArr[24];
$mohr_lv0007->ArrPush[7]=$vLangArr[28];

$mohr_lv0007->ArrFunc[0]='//Function';
$mohr_lv0007->ArrFunc[1]=$vLangArr[2];
$mohr_lv0007->ArrFunc[2]=$vLangArr[4];
$mohr_lv0007->ArrFunc[3]=$vLangArr[6];
$mohr_lv0007->ArrFunc[4]='';
$mohr_lv0007->ArrFunc[5]='';
$mohr_lv0007->ArrFunc[6]='';
$mohr_lv0007->ArrFunc[7]='';
$mohr_lv0007->ArrFunc[8]=$vLangArr[10];
$mohr_lv0007->ArrFunc[9]=$vLangArr[12];
$mohr_lv0007->ArrFunc[10]=$vLangArr[0];
$mohr_lv0007->ArrFunc[11]=$vLangArr[31];
////Other	
	$mohr_lv0007->ArrOther[1]=$vLangArr[29];
$mohr_lv0007->ArrOther[2]=$vLangArr[30];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0007->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0007');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0007->ListView;
$curPage = $mohr_lv0007->CurPage;
$maxRows =$mohr_lv0007->MaxRows;
$vOrderList=$mohr_lv0007->ListOrder;
$vSortNum=$mohr_lv0007->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0007->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mohr_lv0007->GetView()==1)
{
?>

				<?php echo $mohr_lv0007->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../hr_lv0007/permit.php");
}
?>
