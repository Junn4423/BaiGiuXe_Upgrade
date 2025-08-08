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
require_once("../../clsall/tc_lv0061.php");

/////////////init object//////////////
$motc_lv0061=new tc_lv0061($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0061');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0100.txt",$plang);
$motc_lv0061->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0061->ArrPush[0]=$vLangArr[17];
$motc_lv0061->ArrPush[1]=$vLangArr[18];
$motc_lv0061->ArrPush[2]=$vLangArr[19];
$motc_lv0061->ArrPush[3]=$vLangArr[20];
$motc_lv0061->ArrPush[4]=$vLangArr[21];
$motc_lv0061->ArrPush[5]=$vLangArr[22];
$motc_lv0061->ArrPush[6]=$vLangArr[23];
$motc_lv0061->ArrPush[7]=$vLangArr[24];
$motc_lv0061->ArrPush[8]=$vLangArr[25];
$motc_lv0061->ArrPush[9]=$vLangArr[26];
$motc_lv0061->ArrPush[10]=$vLangArr[27];
$motc_lv0061->ArrPush[11]=$vLangArr[28];
$motc_lv0061->ArrPush[12]=$vLangArr[29];
$motc_lv0061->ArrPush[13]=$vLangArr[30];
$motc_lv0061->ArrPush[14]=$vLangArr[31];
$motc_lv0061->ArrPush[15]=$vLangArr[32];
$motc_lv0061->ArrPush[16]=$vLangArr[33];
$motc_lv0061->ArrPush[17]=$vLangArr[34];
$motc_lv0061->ArrPush[18]=$vLangArr[35];
$motc_lv0061->ArrPush[19]=$vLangArr[36];
$motc_lv0061->ArrPush[20]=$vLangArr[37];
$motc_lv0061->ArrPush[21]=$vLangArr[38];
$motc_lv0061->ArrPush[22]=$vLangArr[39];
$motc_lv0061->ArrPush[23]=$vLangArr[40];
$motc_lv0061->ArrPush[24]=$vLangArr[41];
$motc_lv0061->ArrPush[25]=$vLangArr[42];




$motc_lv0061->ArrFunc[0]='//Function';
$motc_lv0061->ArrFunc[1]=$vLangArr[2];
$motc_lv0061->ArrFunc[2]=$vLangArr[4];
$motc_lv0061->ArrFunc[3]=$vLangArr[6];
$motc_lv0061->ArrFunc[4]=$vLangArr[7];
$motc_lv0061->ArrFunc[5]='';
$motc_lv0061->ArrFunc[6]='';
$motc_lv0061->ArrFunc[7]='';
$motc_lv0061->ArrFunc[8]=$vLangArr[10];
$motc_lv0061->ArrFunc[9]=$vLangArr[12];
$motc_lv0061->ArrFunc[10]=$vLangArr[0];
$motc_lv0061->ArrFunc[11]=$vLangArr[63];
$motc_lv0061->ArrFunc[12]=$vLangArr[64];
$motc_lv0061->ArrFunc[13]=$vLangArr[65];
$motc_lv0061->ArrFunc[14]=$vLangArr[66];

////Other
$motc_lv0061->ArrOther[1]=$vLangArr[61];
$motc_lv0061->ArrOther[2]=$vLangArr[62];
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
$motc_lv0061->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0061');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0061->ListView;
$curPage = $motc_lv0061->CurPage;
$maxRows =$motc_lv0061->MaxRows;
$vOrderList=$motc_lv0061->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0061->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($motc_lv0061->GetView()==1)
{
?>

						<?php echo $motc_lv0061->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
