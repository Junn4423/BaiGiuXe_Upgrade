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
require_once("../../clsall/hr_lv0003.php");

/////////////init object//////////////
$mohr_lv0003=new hr_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0036');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0086.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0003->ArrPush[0]=$vLangArr[17];
$mohr_lv0003->ArrPush[1]=$vLangArr[18];
$mohr_lv0003->ArrPush[2]=$vLangArr[20];
$mohr_lv0003->ArrPush[3]=$vLangArr[21];
$mohr_lv0003->ArrPush[4]=$vLangArr[22];
$mohr_lv0003->ArrPush[5]=$vLangArr[19];

$mohr_lv0003->ArrFunc[0]='//Function';
$mohr_lv0003->ArrFunc[1]=$vLangArr[2];
$mohr_lv0003->ArrFunc[2]=$vLangArr[4];
$mohr_lv0003->ArrFunc[3]=$vLangArr[6];
$mohr_lv0003->ArrFunc[4]='';
$mohr_lv0003->ArrFunc[5]='';
$mohr_lv0003->ArrFunc[6]='';
$mohr_lv0003->ArrFunc[7]='';
$mohr_lv0003->ArrFunc[8]=$vLangArr[10];
$mohr_lv0003->ArrFunc[9]=$vLangArr[12];
$mohr_lv0003->ArrFunc[10]=$vLangArr[0];
$mohr_lv0003->ArrFunc[11]=$vLangArr[25];
////Other
$mohr_lv0003->ArrOther[1]=$vLangArr[23];
$mohr_lv0003->ArrOther[2]=$vLangArr[24];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0003->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0003');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0003->ListView;
$curPage = $mohr_lv0003->CurPage;
$maxRows =$mohr_lv0003->MaxRows;
$vOrderList=$mohr_lv0003->ListOrder;
$vSortNum=$mohr_lv0003->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0003->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mohr_lv0003->GetView()==1)
{
?>

				<?php echo $mohr_lv0003->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../hr_lv0003/permit.php");
}
?>
