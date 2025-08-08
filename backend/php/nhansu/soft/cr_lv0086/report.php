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
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/cr_lv0086.php");

/////////////init object//////////////
$mocr_lv0086=new cr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0086');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","CR0007.txt",$plang);
$mocr_lv0086->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0086->ArrPush[0]=$vLangArr[17];
$mocr_lv0086->ArrPush[1]=$vLangArr[18];
$mocr_lv0086->ArrPush[2]=$vLangArr[19];
$mocr_lv0086->ArrPush[3]=$vLangArr[20];
$mocr_lv0086->ArrPush[4]=$vLangArr[21];
$mocr_lv0086->ArrPush[5]=$vLangArr[22];
$mocr_lv0086->ArrPush[6]=$vLangArr[23];
$mocr_lv0086->ArrPush[7]=$vLangArr[24];
$mocr_lv0086->ArrPush[8]=$vLangArr[25];
$mocr_lv0086->ArrPush[9]=$vLangArr[26];
$mocr_lv0086->ArrPush[10]=$vLangArr[27];
$mocr_lv0086->ArrPush[11]=$vLangArr[28];
$mocr_lv0086->ArrPush[12]=$vLangArr[29];
$mocr_lv0086->ArrPush[13]=$vLangArr[30];
$mocr_lv0086->ArrPush[14]=$vLangArr[31];
$mocr_lv0086->ArrPush[15]=$vLangArr[32];
$mocr_lv0086->ArrPush[16]=$vLangArr[33];
$mocr_lv0086->ArrPush[17]=$vLangArr[34];
$mocr_lv0086->ArrPush[18]=$vLangArr[35];
$mocr_lv0086->ArrPush[100]=$vLangArr[48];

$mocr_lv0086->ArrPush[97]=$vLangArr[49];
$mocr_lv0086->ArrPush[98]=$vLangArr[50];
$mocr_lv0086->ArrPush[99]=$vLangArr[51];

$mocr_lv0086->ArrPush[19]=$vLangArr[43];
$mocr_lv0086->ArrPush[20]=$vLangArr[44];
$mocr_lv0086->ArrPush[21]=$vLangArr[45];
$mocr_lv0086->ArrPush[22]=$vLangArr[46];
$mocr_lv0086->ArrPush[23]=$vLangArr[47];

$mocr_lv0086->ArrPush[24]='Hàng hoá';
$mocr_lv0086->ArrPush[25]='Ngày khai';
$mocr_lv0086->ArrPush[26]='Nơi nhận hàng';
$mocr_lv0086->ArrPush[27]='Nơi giao hàng';
$mocr_lv0086->ArrPush[95]='Ngày LĐĐ';
$mocr_lv0086->ArrPush[89]='STT/LĐĐ';
$mocr_lv0086->ArrPush[90]='Mã công văn';
$mocr_lv0086->ArrPush[101]='Chi Hộ';
$mocr_lv0086->ArrPush[102]='Thực chi TX';
$mocr_lv0086->ArrPush[112]='GC Hoá Đơn';
$mocr_lv0086->ArrPush[113]='Mã chi tiết vận tải';

$mocr_lv0086->ArrPush[97]=$vLangArr[49];
$mocr_lv0086->ArrPush[98]=$vLangArr[50];
$mocr_lv0086->ArrPush[99]=$vLangArr[51];

$mocr_lv0086->ArrPush[19]=$vLangArr[43];
$mocr_lv0086->ArrPush[20]=$vLangArr[44];
$mocr_lv0086->ArrPush[21]=$vLangArr[45];
$mocr_lv0086->ArrPush[22]=$vLangArr[46];
$mocr_lv0086->ArrPush[23]=$vLangArr[47];

$mocr_lv0086->ArrPush[24]='Hàng hoá';
$mocr_lv0086->ArrPush[25]='Ngày khai';
$mocr_lv0086->ArrPush[26]='Nơi nhận hàng';
$mocr_lv0086->ArrPush[27]='Nơi giao hàng';
$mocr_lv0086->ArrPush[95]='Ngày LĐĐ';
$mocr_lv0086->ArrPush[89]='STT/LĐĐ';
$mocr_lv0086->ArrPush[101]='Chi Hộ';
$mocr_lv0086->ArrPush[102]='Thực chi TX';
$mocr_lv0086->ArrPush[112]='GC Hoá Đơn';
$mocr_lv0086->ArrPush[113]='Mã chi tiết vận tải';
////Other
$mocr_lv0086->ArrOther[1]=$vLangArr[28];
$mocr_lv0086->ArrOther[2]=$vLangArr[29];
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
$mocr_lv0086->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0086');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0086->lv002=base64_decode( $_GET['ID']);
$vFieldList=$mocr_lv0086->ListView;
$curPage = $mocr_lv0086->CurPage;
$maxRows =$mocr_lv0086->MaxRows;
$vOrderList=$mocr_lv0086->ListOrder;
if($mocr_lv0086->GetApr()==0 || $mocr_lv0086->GetUnApr()==0) $mocr_lv0086->lv009=$mocr_lv0086->LV_UserID;
if($maxRows ==0) $maxRows = 10;
$totalRowsC=$mocr_lv0086->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mocr_lv0086->GetView()==1)
{
?>

						<?php echo $mocr_lv0086->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
