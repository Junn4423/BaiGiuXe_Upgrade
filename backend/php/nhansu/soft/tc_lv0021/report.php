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
require_once("../../clsall/tc_lv0021.php");

/////////////init object//////////////
$motc_lv0021=new tc_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0021');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0038.txt",$plang);
$motc_lv0021->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0021->ArrPush[0]=$vLangArr[16];
$motc_lv0021->ArrPush[1]=$vLangArr[18];
$motc_lv0021->ArrPush[2]=$vLangArr[19];
$motc_lv0021->ArrPush[3]=$vLangArr[20];
$motc_lv0021->ArrPush[4]=$vLangArr[21];
$motc_lv0021->ArrPush[5]=$vLangArr[22];
$motc_lv0021->ArrPush[6]=$vLangArr[23];
$motc_lv0021->ArrPush[7]=$vLangArr[24];
$motc_lv0021->ArrPush[8]=$vLangArr[25];
$motc_lv0021->ArrPush[9]=$vLangArr[26];
$motc_lv0021->ArrPush[10]=$vLangArr[27];
$motc_lv0021->ArrPush[11]=$vLangArr[28];
$motc_lv0021->ArrPush[12]=$vLangArr[29];
$motc_lv0021->ArrPush[13]=$vLangArr[30];
$motc_lv0021->ArrPush[14]=$vLangArr[31];
$motc_lv0021->ArrPush[15]=$vLangArr[32];
$motc_lv0021->ArrPush[16]=$vLangArr[33];
$motc_lv0021->ArrPush[17]=$vLangArr[34];
$motc_lv0021->ArrPush[18]=$vLangArr[35];
$motc_lv0021->ArrPush[19]=$vLangArr[36];
$motc_lv0021->ArrPush[20]=$vLangArr[37];
$motc_lv0021->ArrPush[21]=$vLangArr[38];
$motc_lv0021->ArrPush[22]=$vLangArr[39];
$motc_lv0021->ArrPush[23]=$vLangArr[40];
$motc_lv0021->ArrPush[24]=$vLangArr[41];
$motc_lv0021->ArrPush[25]=$vLangArr[42];
$motc_lv0021->ArrPush[26]=$vLangArr[43];
$motc_lv0021->ArrPush[27]=$vLangArr[44];
$motc_lv0021->ArrPush[28]=$vLangArr[45];
$motc_lv0021->ArrPush[29]=$vLangArr[46];
$motc_lv0021->ArrPush[30]=$vLangArr[47];
$motc_lv0021->ArrPush[31]=$vLangArr[48];
$motc_lv0021->ArrPush[32]=$vLangArr[49];
$motc_lv0021->ArrPush[33]=$vLangArr[50];
$motc_lv0021->ArrPush[34]=$vLangArr[51];
$motc_lv0021->ArrPush[35]=$vLangArr[52];
$motc_lv0021->ArrPush[36]=$vLangArr[53];
$motc_lv0021->ArrPush[37]=$vLangArr[54];
$motc_lv0021->ArrPush[38]=$vLangArr[55];
$motc_lv0021->ArrPush[39]=$vLangArr[56];
$motc_lv0021->ArrPush[40]=$vLangArr[57];
$motc_lv0021->ArrPush[41]=$vLangArr[58];
$motc_lv0021->ArrPush[42]=$vLangArr[59];
$motc_lv0021->ArrPush[43]=$vLangArr[60];
$motc_lv0021->ArrPush[44]=$vLangArr[61];
$motc_lv0021->ArrPush[45]=$vLangArr[62];
$motc_lv0021->ArrPush[46]=$vLangArr[63];
$motc_lv0021->ArrPush[47]=$vLangArr[64];
$motc_lv0021->ArrPush[48]=$vLangArr[65];
$motc_lv0021->ArrPush[49]=$vLangArr[66];
$motc_lv0021->ArrPush[50]=$vLangArr[67];
$motc_lv0021->ArrPush[51]=$vLangArr[68];
$motc_lv0021->ArrPush[52]=$vLangArr[69];
$motc_lv0021->ArrPush[53]=$vLangArr[70];
$motc_lv0021->ArrPush[54]=$vLangArr[71];
$motc_lv0021->ArrPush[55]=$vLangArr[72];
$motc_lv0021->ArrPush[56]=$vLangArr[73];
$motc_lv0021->ArrPush[57]=$vLangArr[74];
$motc_lv0021->ArrPush[58]=$vLangArr[75];
$motc_lv0021->ArrPush[59]=$vLangArr[76];
$motc_lv0021->ArrPush[60]=$vLangArr[77];
$motc_lv0021->ArrPush[61]=$vLangArr[78];
$motc_lv0021->ArrPush[62]=$vLangArr[79];
$motc_lv0021->ArrPush[63]=$vLangArr[80];
$motc_lv0021->ArrPush[64]=$vLangArr[81];
$motc_lv0021->ArrPush[65]=$vLangArr[82];
$motc_lv0021->ArrPush[66]=$vLangArr[83];
$motc_lv0021->ArrPush[67]=$vLangArr[84];
$motc_lv0021->ArrPush[68]=$vLangArr[85];
$motc_lv0021->ArrPush[69]=$vLangArr[86];
$motc_lv0021->ArrPush[70]=$vLangArr[87];
$motc_lv0021->ArrPush[71]=$vLangArr[88];
$motc_lv0021->ArrPush[72]=$vLangArr[89];
$motc_lv0021->ArrPush[73]=$vLangArr[90];
$motc_lv0021->ArrPush[74]=$vLangArr[91];
$motc_lv0021->ArrPush[75]=$vLangArr[102];
$motc_lv0021->ArrPush[76]=$vLangArr[104];
$motc_lv0021->ArrPush[77]=$vLangArr[105];
$motc_lv0021->ArrPush[78]=$vLangArr[106];
$motc_lv0021->ArrPush[79]=$vLangArr[107];
$motc_lv0021->ArrPush[80]=$vLangArr[108];
$motc_lv0021->ArrPush[81]=$vLangArr[109];
$motc_lv0021->ArrPush[82]=$vLangArr[110];
$motc_lv0021->ArrPush[83]=$vLangArr[111];
$motc_lv0021->ArrPush[84]=$vLangArr[112];
$motc_lv0021->ArrPush[85]=$vLangArr[113];
$motc_lv0021->ArrPush[86]=$vLangArr[114];
$motc_lv0021->ArrPush[87]=$vLangArr[115];
$motc_lv0021->ArrPush[88]=$vLangArr[116];

$motc_lv0021->ArrPush[91]=$vLangArr[121];
$motc_lv0021->ArrPush[92]=$vLangArr[122];
$motc_lv0021->ArrPush[93]=$vLangArr[123];
$motc_lv0021->ArrPush[94]=$vLangArr[124];
$motc_lv0021->ArrPush[95]=$vLangArr[125];
$motc_lv0021->ArrPush[96]=$vLangArr[126];
$motc_lv0021->ArrPush[97]=$vLangArr[127];
$motc_lv0021->ArrPush[98]=$vLangArr[128];

$motc_lv0021->ArrPush[101]=$vLangArr[103];
$motc_lv0021->ArrPush[102]='Mã KT';

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
$motc_lv0021->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0021');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0021->ListView;
$curPage = $motc_lv0021->CurPage;
$maxRows =$motc_lv0021->MaxRows;
$vOrderList=$motc_lv0021->ListOrder;
$vSortNum=$motc_lv0021->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0021->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($motc_lv0021->GetView()==1)
{
?>

						<?php echo $motc_lv0021->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
