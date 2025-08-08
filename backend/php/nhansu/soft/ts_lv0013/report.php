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
require_once("../../clsall/ts_lv0013.php");

/////////////init object//////////////
$mots_lv0013=new ts_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0013');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0020.txt",$plang);

$mots_lv0013->ArrPush[0]=$vLangArr[17];
$mots_lv0013->ArrPush[1]=$vLangArr[18];
$mots_lv0013->ArrPush[2]=$vLangArr[20];
$mots_lv0013->ArrPush[3]=$vLangArr[21];

$mots_lv0013->ArrFunc[0]='//Function';
$mots_lv0013->ArrFunc[1]=$vLangArr[2];
$mots_lv0013->ArrFunc[2]=$vLangArr[4];
$mots_lv0013->ArrFunc[3]=$vLangArr[6];
$mots_lv0013->ArrFunc[4]=$vLangArr[7];
$mots_lv0013->ArrFunc[5]='';
$mots_lv0013->ArrFunc[6]='';
$mots_lv0013->ArrFunc[7]='';
$mots_lv0013->ArrFunc[8]=$vLangArr[8];
$mots_lv0013->ArrFunc[9]=$vLangArr[10];
$mots_lv0013->ArrFunc[10]=$vLangArr[0];
$mots_lv0013->ArrFunc[11]=$vLangArr[24];
$mots_lv0013->ArrFunc[12]=$vLangArr[25];
$mots_lv0013->ArrFunc[13]=$vLangArr[26];
$mots_lv0013->ArrFunc[14]=$vLangArr[27];
$mots_lv0013->ArrFunc[15]=$vLangArr[28];
////Other
$mots_lv0013->ArrOther[1]=$vLangArr[22];
$mots_lv0013->ArrOther[2]=$vLangArr[23];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0013->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0013');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mots_lv0013->ListView;
$curPage = $mots_lv0013->CurPage;
$maxRows =$mots_lv0013->MaxRows;
$vOrderList=$mots_lv0013->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mots_lv0013->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mots_lv0013->GetView()==1)
{
?>

				<?php echo $mots_lv0013->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
