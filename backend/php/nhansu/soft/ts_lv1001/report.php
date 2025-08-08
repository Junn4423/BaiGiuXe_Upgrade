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
require_once("../../clsall/sp_lv0011.php");

/////////////init object//////////////
$mosp_lv0011=new sp_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sp0008');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SP0046.txt",$plang);
$mosp_lv0011->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosp_lv0011->ArrPush[0]=$vLangArr[17];
$mosp_lv0011->ArrPush[1]=$vLangArr[18];
$mosp_lv0011->ArrPush[2]=$vLangArr[19];
$mosp_lv0011->ArrPush[3]=$vLangArr[20];
$mosp_lv0011->ArrPush[4]=$vLangArr[21];
$mosp_lv0011->ArrPush[5]=$vLangArr[22];
$mosp_lv0011->ArrPush[6]=$vLangArr[23];
$mosp_lv0011->ArrPush[7]=$vLangArr[24];
$mosp_lv0011->ArrPush[8]=$vLangArr[25];
$mosp_lv0011->ArrPush[9]=$vLangArr[26];
$mosp_lv0011->ArrPush[10]=$vLangArr[27];
$mosp_lv0011->ArrPush[11]=$vLangArr[28];
$mosp_lv0011->ArrPush[12]=$vLangArr[29];
$mosp_lv0011->ArrPush[13]=$vLangArr[30];
$mosp_lv0011->ArrPush[14]=$vLangArr[31];
$mosp_lv0011->ArrPush[15]=$vLangArr[32];
$mosp_lv0011->ArrPush[16]=$vLangArr[33];
$mosp_lv0011->ArrPush[17]=$vLangArr[34];
$mosp_lv0011->ArrPush[18]=$vLangArr[35];
$mosp_lv0011->ArrPush[19]=$vLangArr[36];
$mosp_lv0011->ArrPush[20]=$vLangArr[37];
$mosp_lv0011->ArrPush[21]=$vLangArr[38];
$mosp_lv0011->ArrPush[22]=$vLangArr[39];
$mosp_lv0011->ArrPush[23]=$vLangArr[40];
$mosp_lv0011->ArrPush[24]=$vLangArr[41];
$mosp_lv0011->ArrPush[25]=$vLangArr[42];
$mosp_lv0011->ArrPush[26]=$vLangArr[43];
$mosp_lv0011->ArrPush[27]=$vLangArr[44];
$mosp_lv0011->ArrPush[28]=$vLangArr[45];
$mosp_lv0011->ArrPush[29]=$vLangArr[46];
$mosp_lv0011->ArrPush[30]=$vLangArr[47];
$mosp_lv0011->ArrPush[31]=$vLangArr[48];
$mosp_lv0011->ArrPush[32]=$vLangArr[49];
$mosp_lv0011->ArrPush[33]=$vLangArr[50];
$mosp_lv0011->ArrPush[34]=$vLangArr[51];
$mosp_lv0011->ArrPush[35]=$vLangArr[52];
$mosp_lv0011->ArrPush[36]=$vLangArr[53];
$mosp_lv0011->ArrPush[37]=$vLangArr[54];
$mosp_lv0011->ArrPush[38]=$vLangArr[55];
$mosp_lv0011->ArrPush[39]=$vLangArr[56];
$mosp_lv0011->ArrPush[40]=$vLangArr[57];
$mosp_lv0011->ArrPush[41]=$vLangArr[58];
$mosp_lv0011->ArrPush[42]=$vLangArr[59];
$mosp_lv0011->ArrPush[43]=$vLangArr[60];
$mosp_lv0011->ArrPush[44]=$vLangArr[61];
$mosp_lv0011->ArrPush[45]=$vLangArr[62];
$mosp_lv0011->ArrPush[46]=$vLangArr[63];
$mosp_lv0011->ArrPush[47]=$vLangArr[64];
$mosp_lv0011->ArrPush[48]=$vLangArr[65];
$mosp_lv0011->ArrPush[49]=$vLangArr[66];
$mosp_lv0011->ArrPush[50]=$vLangArr[67];
$mosp_lv0011->ArrPush[51]=$vLangArr[68];
$mosp_lv0011->ArrPush[52]=$vLangArr[69];
$mosp_lv0011->ArrPush[53]=$vLangArr[70];

////Other
$mosp_lv0011->ArrOther[1]=$vLangArr[28];
$mosp_lv0011->ArrOther[2]=$vLangArr[29];
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
$mosp_lv0011->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sp_lv0011');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosp_lv0011->lv002=base64_decode( $_GET['ID']);
$vFieldList=$mosp_lv0011->ListView;
$curPage = $mosp_lv0011->CurPage;
$maxRows =$mosp_lv0011->MaxRows;
$vOrderList=$mosp_lv0011->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosp_lv0011->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mosp_lv0011->GetView()==1)
{
?>

						<?php echo $mosp_lv0011->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
