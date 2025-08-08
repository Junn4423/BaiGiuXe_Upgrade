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
require_once("../../clsall/ki_lv0004.php");

/////////////init object//////////////
$moki_lv0004=new ki_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0004');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","KI0005.txt",$plang);
$moki_lv0004->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0004->ArrPush[0]=$vLangArr[17];
$moki_lv0004->ArrPush[1]=$vLangArr[18];
$moki_lv0004->ArrPush[2]=$vLangArr[20];
$moki_lv0004->ArrPush[3]=$vLangArr[21];
$moki_lv0004->ArrPush[4]=$vLangArr[22];
$moki_lv0004->ArrPush[5]=$vLangArr[23];
$moki_lv0004->ArrPush[6]=$vLangArr[24];
$moki_lv0004->ArrPush[7]=$vLangArr[25];
$moki_lv0004->ArrPush[8]=$vLangArr[26];
$moki_lv0004->ArrPush[9]=$vLangArr[27];
$moki_lv0004->ArrPush[10]=$vLangArr[28];
$moki_lv0004->ArrPush[11]=$vLangArr[29];
$moki_lv0004->ArrPush[12]=$vLangArr[30];
$moki_lv0004->ArrPush[13]=$vLangArr[31];
$moki_lv0004->ArrPush[14]=$vLangArr[32];
$moki_lv0004->ArrPush[15]=$vLangArr[33];
$moki_lv0004->ArrPush[16]=$vLangArr[34];
$moki_lv0004->ArrPush[17]=$vLangArr[35];

////Other
$moki_lv0004->ArrOther[1]=$vLangArr[28];
$moki_lv0004->ArrOther[2]=$vLangArr[29];
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
$moki_lv0004->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0004');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0004->lv002=base64_decode( $_GET['ID']);
$vFieldList=$moki_lv0004->ListView;
$curPage = $moki_lv0004->CurPage;
$maxRows =$moki_lv0004->MaxRows;
$vOrderList=$moki_lv0004->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moki_lv0004->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($moki_lv0004->GetView()==1)
{
?>

						<?php echo $moki_lv0004->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
