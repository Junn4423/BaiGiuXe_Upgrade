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
require_once("../../clsall/lv_lv0001.php");

/////////////init object//////////////
$molv_lv0001=new lv_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Lv0001');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0301.txt",$plang);

$molv_lv0001->ArrPush[0]=$vLangArr[17];
$molv_lv0001->ArrPush[1]=$vLangArr[18];
$molv_lv0001->ArrPush[2]=$vLangArr[20];
$molv_lv0001->ArrPush[3]=$vLangArr[21];
$molv_lv0001->ArrPush[4]=$vLangArr[22];
$molv_lv0001->ArrPush[5]=$vLangArr[23];
$molv_lv0001->ArrPush[6]=$vLangArr[24];
$molv_lv0001->ArrPush[7]=$vLangArr[25];
$molv_lv0001->ArrPush[8]=$vLangArr[26];

$molv_lv0001->ArrFunc[0]='//Function';
$molv_lv0001->ArrFunc[1]=$vLangArr[2];
$molv_lv0001->ArrFunc[2]=$vLangArr[4];
$molv_lv0001->ArrFunc[3]=$vLangArr[6];
$molv_lv0001->ArrFunc[4]=$vLangArr[7];
$molv_lv0001->ArrFunc[5]='';
$molv_lv0001->ArrFunc[6]='';
$molv_lv0001->ArrFunc[7]='';
$molv_lv0001->ArrFunc[8]=$vLangArr[10];
$molv_lv0001->ArrFunc[9]=$vLangArr[12];
$molv_lv0001->ArrFunc[10]=$vLangArr[0];
$molv_lv0001->ArrFunc[11]=$vLangArr[29];
$molv_lv0001->ArrFunc[12]=$vLangArr[30];
$molv_lv0001->ArrFunc[13]=$vLangArr[31];
$molv_lv0001->ArrFunc[14]=$vLangArr[32];
$molv_lv0001->ArrFunc[15]=$vLangArr[33];
////Other
$molv_lv0001->ArrOther[1]=$vLangArr[27];
$molv_lv0001->ArrOther[2]=$vLangArr[28];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0001->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0001');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$molv_lv0001->ListView;
$curPage = $molv_lv0001->CurPage;
$maxRows =$molv_lv0001->MaxRows;
$vOrderList=$molv_lv0001->ListOrder;
$vSortNum=$molv_lv0001->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$molv_lv0001->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($molv_lv0001->GetView()==1)
{
?>

				<?php echo $molv_lv0001->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
