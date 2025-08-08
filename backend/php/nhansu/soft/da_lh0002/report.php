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
require_once("../../clsall/da_lh0002.php");

/////////////init object//////////////
$moda_lh0002=new da_lh0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Da002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AC0003.txt",$plang);

$moda_lh0002->ArrPush[0]=$vLangArr[17];
$moda_lh0002->ArrPush[1]=$vLangArr[18];
$moda_lh0002->ArrPush[2]=$vLangArr[20];
$moda_lh0002->ArrPush[3]=$vLangArr[21];
$moda_lh0002->ArrPush[4]=$vLangArr[22];
$moda_lh0002->ArrPush[5]=$vLangArr[23];
$moda_lh0002->ArrPush[6]=$vLangArr[24];

$moda_lh0002->ArrFunc[0]='//Function';
$moda_lh0002->ArrFunc[1]=$vLangArr[2];
$moda_lh0002->ArrFunc[2]=$vLangArr[4];
$moda_lh0002->ArrFunc[3]=$vLangArr[6];
$moda_lh0002->ArrFunc[4]=$vLangArr[7];
$moda_lh0002->ArrFunc[5]='';
$moda_lh0002->ArrFunc[6]='';
$moda_lh0002->ArrFunc[7]='';
$moda_lh0002->ArrFunc[8]=$vLangArr[10];
$moda_lh0002->ArrFunc[9]=$vLangArr[12];
$moda_lh0002->ArrFunc[10]=$vLangArr[0];
$moda_lh0002->ArrFunc[11]=$vLangArr[27];
$moda_lh0002->ArrFunc[12]=$vLangArr[28];
$moda_lh0002->ArrFunc[13]=$vLangArr[29];
$moda_lh0002->ArrFunc[14]=$vLangArr[30];
$moda_lh0002->ArrFunc[15]=$vLangArr[31];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moda_lh0002->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'da_lh0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moda_lh0002->ListView;
$curPage = $moda_lh0002->CurPage;
$maxRows =$moda_lh0002->MaxRows;
$vOrderList=$moda_lh0002->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moda_lh0002->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($moda_lh0002->GetView()==1)
{
?>

				<?php echo $moda_lh0002->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
