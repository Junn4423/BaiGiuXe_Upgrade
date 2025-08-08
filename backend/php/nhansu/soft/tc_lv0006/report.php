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
require_once("../../clsall/tc_lv0006.php");

/////////////init object//////////////
$motc_lv0006=new tc_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0006');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0025.txt",$plang);
$motc_lv0006->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0006->ArrPush[0]=$vLangArr[17];
$motc_lv0006->ArrPush[1]=$vLangArr[18];
$motc_lv0006->ArrPush[2]=$vLangArr[19];
$motc_lv0006->ArrPush[3]=$vLangArr[20];
$motc_lv0006->ArrPush[4]=$vLangArr[21];
$motc_lv0006->ArrPush[5]=$vLangArr[22];
$motc_lv0006->ArrPush[6]=$vLangArr[23];
$motc_lv0006->ArrPush[7]=$vLangArr[24];
$motc_lv0006->ArrPush[8]=$vLangArr[25];
$motc_lv0006->ArrPush[9]=$vLangArr[26];
$motc_lv0006->ArrPush[10]=$vLangArr[27];
$motc_lv0006->ArrPush[11]=$vLangArr[28];
$motc_lv0006->ArrPush[12]=$vLangArr[29];
$motc_lv0006->ArrPush[13]=$vLangArr[30];
$motc_lv0006->ArrPush[14]=$vLangArr[31];
$motc_lv0006->ArrPush[15]=$vLangArr[32];
$motc_lv0006->ArrPush[16]=$vLangArr[33];
$motc_lv0006->ArrPush[17]=$vLangArr[34];
$motc_lv0006->ArrPush[18]=$vLangArr[35];
$motc_lv0006->ArrPush[19]=$vLangArr[36];
$motc_lv0006->ArrPush[20]=$vLangArr[37];
$motc_lv0006->ArrPush[21]=$vLangArr[38];
$motc_lv0006->ArrPush[22]=$vLangArr[39];
$motc_lv0006->ArrPush[23]=$vLangArr[40];
$motc_lv0006->ArrPush[24]=$vLangArr[41];
$motc_lv0006->ArrPush[25]=$vLangArr[42];
$motc_lv0006->ArrPush[26]=$vLangArr[43];
$motc_lv0006->ArrPush[27]=$vLangArr[44];
$motc_lv0006->ArrPush[28]=$vLangArr[45];
$motc_lv0006->ArrPush[29]=$vLangArr[46];
$motc_lv0006->ArrPush[30]=$vLangArr[47];
$motc_lv0006->ArrPush[31]=$vLangArr[48];
$motc_lv0006->ArrPush[32]=$vLangArr[49];
$motc_lv0006->ArrPush[33]=$vLangArr[50];
$motc_lv0006->ArrPush[34]=$vLangArr[51];
$motc_lv0006->ArrPush[35]=$vLangArr[52];
$motc_lv0006->ArrPush[36]=$vLangArr[53];
$motc_lv0006->ArrPush[37]=$vLangArr[54];
$motc_lv0006->ArrPush[38]=$vLangArr[55];
$motc_lv0006->ArrPush[39]=$vLangArr[56];
$motc_lv0006->ArrPush[40]=$vLangArr[57];
$motc_lv0006->ArrPush[41]=$vLangArr[58];
$motc_lv0006->ArrPush[42]=$vLangArr[59];
$motc_lv0006->ArrPush[43]=$vLangArr[60];
$motc_lv0006->ArrPush[100]='Code Machine';	


$motc_lv0006->ArrFunc[0]='//Function';
$motc_lv0006->ArrFunc[1]=$vLangArr[2];
$motc_lv0006->ArrFunc[2]=$vLangArr[4];
$motc_lv0006->ArrFunc[3]=$vLangArr[6];
$motc_lv0006->ArrFunc[4]=$vLangArr[7];
$motc_lv0006->ArrFunc[5]='';
$motc_lv0006->ArrFunc[6]='';
$motc_lv0006->ArrFunc[7]='';
$motc_lv0006->ArrFunc[8]=$vLangArr[10];
$motc_lv0006->ArrFunc[9]=$vLangArr[12];
$motc_lv0006->ArrFunc[10]=$vLangArr[0];
$motc_lv0006->ArrFunc[11]=$vLangArr[63];
$motc_lv0006->ArrFunc[12]=$vLangArr[64];
$motc_lv0006->ArrFunc[13]=$vLangArr[65];
$motc_lv0006->ArrFunc[14]=$vLangArr[66];

////Other
$motc_lv0006->ArrOther[1]=$vLangArr[61];
$motc_lv0006->ArrOther[2]=$vLangArr[62];
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
$motc_lv0006->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0006');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0006->ListView;
$curPage = $motc_lv0006->CurPage;
$maxRows =$motc_lv0006->MaxRows;
$vOrderList=$motc_lv0006->ListOrder;
$vSortNum=$motc_lv0006->SortNum;

if($maxRows ==0) $maxRows = 10;
if($motc_lv0006->GetApr()==0)  $motc_lv0006->lv029=$motc_lv0006->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$totalRowsC=$motc_lv0006->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($motc_lv0006->GetView()==1)
{
?>

						<?php echo $motc_lv0006->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
