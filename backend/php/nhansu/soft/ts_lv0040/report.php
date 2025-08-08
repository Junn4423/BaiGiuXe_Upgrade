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
require_once("../../clsall/ts_lv0040.php");

/////////////init object//////////////
$mots_lv0040=new ts_lv0040($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0037');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0037.txt",$plang);
$mots_lv0040->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0040->ArrPush[0]=$vLangArr[17];
$mots_lv0040->ArrPush[1]=$vLangArr[18];
$mots_lv0040->ArrPush[2]=$vLangArr[44];
$mots_lv0040->ArrPush[3]=$vLangArr[21];
$mots_lv0040->ArrPush[4]=$vLangArr[31];
$mots_lv0040->ArrPush[5]=$vLangArr[32];
$mots_lv0040->ArrPush[6]=$vLangArr[33];
$mots_lv0040->ArrPush[7]=$vLangArr[34];
$mots_lv0040->ArrPush[8]=$vLangArr[35];
$mots_lv0040->ArrPush[9]=$vLangArr[36];
$mots_lv0040->ArrPush[10]=$vLangArr[37];
$mots_lv0040->ArrPush[11]=$vLangArr[38];
$mots_lv0040->ArrPush[12]=$vLangArr[39];
$mots_lv0040->ArrPush[13]=$vLangArr[40];
$mots_lv0040->ArrPush[14]=$vLangArr[41];
$mots_lv0040->ArrPush[15]=$vLangArr[52];
$mots_lv0040->ArrPush[16]=$vLangArr[43];
$mots_lv0040->ArrPush[17]=$vLangArr[57];
$mots_lv0040->ArrPush[18]=$vLangArr[53];
$mots_lv0040->ArrPush[19]=$vLangArr[54];
$mots_lv0040->ArrPush[20]=$vLangArr[55];

$mots_lv0040->ArrFunc[0]='//Function';
$mots_lv0040->ArrFunc[1]=$vLangArr[2];
$mots_lv0040->ArrFunc[2]=$vLangArr[4];
$mots_lv0040->ArrFunc[3]=$vLangArr[6];
$mots_lv0040->ArrFunc[4]=$vLangArr[7];
$mots_lv0040->ArrFunc[5]='';
$mots_lv0040->ArrFunc[6]='';
$mots_lv0040->ArrFunc[7]='';
$mots_lv0040->ArrFunc[8]=$vLangArr[10];
$mots_lv0040->ArrFunc[9]=$vLangArr[12];
$mots_lv0040->ArrFunc[10]=$vLangArr[0];
$mots_lv0040->ArrFunc[11]=$vLangArr[36];
$mots_lv0040->ArrFunc[12]=$vLangArr[37];
$mots_lv0040->ArrFunc[13]=$vLangArr[38];
$mots_lv0040->ArrFunc[14]=$vLangArr[39];
$mots_lv0040->ArrFunc[15]=$vLangArr[40];
////Other
$mots_lv0040->ArrOther[1]=$vLangArr[31];
$mots_lv0040->ArrOther[2]=$vLangArr[32];
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
$mots_lv0040->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0040');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0040->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$vFieldList=$mots_lv0040->ListView;
$curPage = $mots_lv0040->CurPage;
$maxRows =$mots_lv0040->MaxRows;
$vOrderList=$mots_lv0040->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mots_lv0040->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mots_lv0040->GetView()==1)
{
?>

						<?php echo $mots_lv0040->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
