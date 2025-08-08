<?php
session_start();
$sExport=$_GET['childfunc'];
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
require_once("../../clsall/hr_lv0038.php");

/////////////init object//////////////
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0123.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0038->ArrPush[0]=$vLangArr[17];
$mohr_lv0038->ArrPush[1]=$vLangArr[18];
$mohr_lv0038->ArrPush[2]=$vLangArr[20];
$mohr_lv0038->ArrPush[3]=$vLangArr[21];
$mohr_lv0038->ArrPush[4]=$vLangArr[22];
$mohr_lv0038->ArrPush[5]=$vLangArr[23];
$mohr_lv0038->ArrPush[6]=$vLangArr[24];
$mohr_lv0038->ArrPush[7]=$vLangArr[25];
$mohr_lv0038->ArrPush[8]=$vLangArr[26];
$mohr_lv0038->ArrPush[9]=$vLangArr[27];
$mohr_lv0038->ArrPush[10]=$vLangArr[28];
$mohr_lv0038->ArrPush[11]=$vLangArr[36];
$mohr_lv0038->ArrPush[12]=$vLangArr[37];
$mohr_lv0038->ArrPush[13]=$vLangArr[38];
$mohr_lv0038->ArrPush[14]=$vLangArr[39];
$mohr_lv0038->ArrPush[15]=$vLangArr[40];
$mohr_lv0038->ArrPush[16]=$vLangArr[41];
$mohr_lv0038->ArrPush[17]=$vLangArr[42];
$mohr_lv0038->ArrPush[18]=$vLangArr[43];
$mohr_lv0038->ArrPush[19]=$vLangArr[44];
$mohr_lv0038->ArrPush[20]=$vLangArr[45];
$mohr_lv0038->ArrPush[21]=$vLangArr[46];
$mohr_lv0038->ArrPush[22]=$vLangArr[47];
$mohr_lv0038->ArrPush[23]=$vLangArr[48];
$mohr_lv0038->ArrPush[24]=$vLangArr[49];
$mohr_lv0038->ArrPush[25]=$vLangArr[50];
$mohr_lv0038->ArrPush[26]=$vLangArr[51];
$mohr_lv0038->ArrPush[27]=$vLangArr[52];
$mohr_lv0038->ArrPush[28]=$vLangArr[53];
$mohr_lv0038->ArrPush[29]=$vLangArr[54];
$mohr_lv0038->ArrPush[30]=$vLangArr[55];
$mohr_lv0038->ArrPush[31]=$vLangArr[56];

$mohr_lv0038->ArrPush[32]=$vLangArr[60];
$mohr_lv0038->ArrPush[33]=$vLangArr[61];
$mohr_lv0038->ArrPush[34]=$vLangArr[62];
$mohr_lv0038->ArrPush[35]=$vLangArr[72];
$mohr_lv0038->ArrPush[36]=$vLangArr[73];
$mohr_lv0038->ArrPush[37]=$vLangArr[74];
$mohr_lv0038->ArrPush[38]=$vLangArr[75];

$mohr_lv0038->ArrPush[100]=$vLangArr[57];
$mohr_lv0038->ArrPush[111]=$vLangArr[58];
$mohr_lv0038->ArrPush[101]=$vLangArr[59];

$mohr_lv0038->ArrPush[300]='KPI';

$mohr_lv0038->ArrFunc[0]='//Function';
$mohr_lv0038->ArrFunc[1]=$vLangArr[2];
$mohr_lv0038->ArrFunc[2]=$vLangArr[4];
$mohr_lv0038->ArrFunc[3]=$vLangArr[6];
$mohr_lv0038->ArrFunc[4]=$vLangArr[7];
$mohr_lv0038->ArrFunc[5]='';
$mohr_lv0038->ArrFunc[6]='';
$mohr_lv0038->ArrFunc[7]='';
$mohr_lv0038->ArrFunc[8]=$vLangArr[10];
$mohr_lv0038->ArrFunc[9]=$vLangArr[12];
$mohr_lv0038->ArrFunc[10]=$vLangArr[0];
$mohr_lv0038->ArrFunc[11]=$vLangArr[64];
$mohr_lv0038->ArrFunc[12]=$vLangArr[65];
$mohr_lv0038->ArrFunc[13]=$vLangArr[66];
$mohr_lv0038->ArrFunc[14]=$vLangArr[67];
$mohr_lv0038->ArrFunc[15]=$vLangArr[68];

////Other
$mohr_lv0038->ArrOther[1]=$vLangArr[62];
$mohr_lv0038->ArrOther[2]=$vLangArr[63];

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
$mohr_lv0038->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0038');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0038->lv002=base64_decode( $_GET['ID']);
$vFieldList=$mohr_lv0038->ListView;
$curPage = $mohr_lv0038->CurPage;
$maxRows =$mohr_lv0038->MaxRows;
$vOrderList=$mohr_lv0038->ListOrder;
$vSortNum=$mohr_lv0038->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0038->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mohr_lv0038->GetView()==1)
{
?>

				<?php echo $mohr_lv0038->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
