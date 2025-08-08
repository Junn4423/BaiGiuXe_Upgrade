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
require_once("../../clsall/jo_lv0003.php");

/////////////init object//////////////
$mojo_lv0003=new jo_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","JO0003.txt",$plang);

$mojo_lv0003->ArrPush[0]=$vLangArr[17];
$mojo_lv0003->ArrPush[1]=$vLangArr[18];
$mojo_lv0003->ArrPush[2]=$vLangArr[20];
$mojo_lv0003->ArrPush[3]=$vLangArr[21];

$mojo_lv0003->ArrFunc[0]='//Function';
$mojo_lv0003->ArrFunc[1]=$vLangArr[2];
$mojo_lv0003->ArrFunc[2]=$vLangArr[4];
$mojo_lv0003->ArrFunc[3]=$vLangArr[6];
$mojo_lv0003->ArrFunc[4]=$vLangArr[7];
$mojo_lv0003->ArrFunc[5]='';
$mojo_lv0003->ArrFunc[6]='';
$mojo_lv0003->ArrFunc[7]='';
$mojo_lv0003->ArrFunc[8]=$vLangArr[8];
$mojo_lv0003->ArrFunc[9]=$vLangArr[10];
$mojo_lv0003->ArrFunc[10]=$vLangArr[0];
$mojo_lv0003->ArrFunc[11]=$vLangArr[24];
$mojo_lv0003->ArrFunc[12]=$vLangArr[25];
$mojo_lv0003->ArrFunc[13]=$vLangArr[26];
$mojo_lv0003->ArrFunc[14]=$vLangArr[27];
$mojo_lv0003->ArrFunc[15]=$vLangArr[28];
////Other
$mojo_lv0003->ArrOther[1]=$vLangArr[22];
$mojo_lv0003->ArrOther[2]=$vLangArr[23];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0003->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0003');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mojo_lv0003->ListView;
$curPage = $mojo_lv0003->CurPage;
$maxRows =$mojo_lv0003->MaxRows;
$vOrderList=$mojo_lv0003->ListOrder;
$vSortNum=$moml_lv0009->SortNum;
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mojo_lv0003->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mojo_lv0003->GetView()==1)
{
?>

				<?php echo $mojo_lv0003->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
