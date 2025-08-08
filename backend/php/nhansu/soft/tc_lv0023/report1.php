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
require_once("../../clsall/tc_lv0023.php");
require_once("../../clsall/tc_lv0013.php");
/////////////init object//////////////
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$motc_lv0013->LV_GetCal();
if($motc_lv0013->lv999!='' || $motc_lv0013->lv999!=NULL)
{
	$motc_lv0013->LV_LoadID($motc_lv0013->lv999);
}
else
	$motc_lv0013->LV_LoadActiveID();
$motc_lv0023=new tc_lv0023($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0023');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0036.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0023->ArrPush[0]='DANH SÁCH TẠM ỨNG LƯƠNG THÁNG '.Fillnum($motc_lv0013->lv006,2).' '.$motc_lv0013->lv007;
$motc_lv0023->ArrPush[1]=$vLangArr[18];
$motc_lv0023->ArrPush[2]=$vLangArr[20];
$motc_lv0023->ArrPush[3]=$vLangArr[21];
$motc_lv0023->ArrPush[4]=$vLangArr[22];
$motc_lv0023->ArrPush[5]=$vLangArr[23];
$motc_lv0023->ArrPush[6]=$vLangArr[24];
$motc_lv0023->ArrPush[7]=$vLangArr[25];
$motc_lv0023->ArrPush[8]=$vLangArr[26];
$motc_lv0023->ArrPush[9]=$vLangArr[27];
$motc_lv0023->ArrPush[10]=$vLangArr[28];
$motc_lv0023->ArrPush[11]=$vLangArr[40];
$motc_lv0023->ArrPush[12]=$vLangArr[42];
$motc_lv0023->ArrPush[13]=$vLangArr[43];
$motc_lv0023->ArrPush[14]=$vLangArr[44];
$motc_lv0023->ArrPush[21]="Chức vụ";
$motc_lv0023->ArrPush[22]="Ký nhận";

//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_GET["ID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0023->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0023');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$strar=substr($strchk,0,strlen($strchk)-1);
$strar=str_replace("@","','",$strar);
$strar="'".$strar."'";
$motc_lv0023->LISTID=$strar;
$motc_lv0023->lv003=$motc_lv0013->lv001;
$vFieldList=$motc_lv0023->ListView;
$curPage = $motc_lv0023->CurPage;
$maxRows =$motc_lv0023->MaxRows;
$vOrderList=$motc_lv0023->ListOrder;
$vSortNum=$motc_lv0023->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0023->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($motc_lv0023->GetRpt()==1)
{
?>

				<?php 
				$vFieldList='lv002,lv020,lv005,lv021';
				echo $motc_lv0023->LV_BuilListReportDepart($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
