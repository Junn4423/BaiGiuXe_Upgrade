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
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0014.php");

/////////////init object//////////////
$mots_lv0014=new ts_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0015');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0015.txt",$plang);
$mots_lv0014->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0014->ArrPush[0]=$vLangArr[17];
$mots_lv0014->ArrPush[1]=$vLangArr[18];
$mots_lv0014->ArrPush[2]=$vLangArr[19];
$mots_lv0014->ArrPush[3]=$vLangArr[20];
$mots_lv0014->ArrPush[4]=$vLangArr[21];
$mots_lv0014->ArrPush[5]=$vLangArr[22];
$mots_lv0014->ArrPush[6]=$vLangArr[23];
$mots_lv0014->ArrPush[7]=$vLangArr[24];
$mots_lv0014->ArrPush[8]=$vLangArr[25];
$mots_lv0014->ArrPush[9]=$vLangArr[26];
$mots_lv0014->ArrPush[10]=$vLangArr[27];

////Other
$mots_lv0014->ArrOther[1]=$vLangArr[28];
$mots_lv0014->ArrOther[2]=$vLangArr[29];
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
$mots_lv0014->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0014');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0014->lv002=base64_decode( $_GET['ID']);
$vFieldList=$mots_lv0014->ListView;
$curPage = $mots_lv0014->CurPage;
$maxRows =$mots_lv0014->MaxRows;
$vOrderList=$mots_lv0014->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mots_lv0014->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mots_lv0014->GetView()==1)
{
?>

						<?php echo $mots_lv0014->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
