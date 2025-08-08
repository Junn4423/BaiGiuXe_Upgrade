<?php
session_start();
$sExport=$_GET['childdetailfunc'];
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
require_once("../../clsall/cr_lv0413.php");
require_once("../../clsall/wh_lv0020.php");
/////////////init object//////////////
$mocr_lv0413=new cr_lv0413($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0413');
$mowh_lv0020=new wh_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0020');
$mocr_lv0413->Dir=$vDir;
$mocr_lv0413->objlot=$mowh_lv0020;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","CR0066.txt",$plang);
$mocr_lv0413->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0413->ArrPush[0]=$vLangArr[17];
$mocr_lv0413->ArrPush[1]=$vLangArr[18];
$mocr_lv0413->ArrPush[2]=$vLangArr[19];
$mocr_lv0413->ArrPush[3]=$vLangArr[20];
$mocr_lv0413->ArrPush[4]=$vLangArr[21];
$mocr_lv0413->ArrPush[5]=$vLangArr[22];
$mocr_lv0413->ArrPush[6]=$vLangArr[23];
$mocr_lv0413->ArrPush[7]=$vLangArr[24];
$mocr_lv0413->ArrPush[8]=$vLangArr[25];
$mocr_lv0413->ArrPush[9]=$vLangArr[26];
$mocr_lv0413->ArrPush[10]=$vLangArr[27];
$mocr_lv0413->ArrPush[11]=$vLangArr[28];
$mocr_lv0413->ArrPush[12]=$vLangArr[29];
$mocr_lv0413->ArrPush[13]=$vLangArr[30];
$mocr_lv0413->ArrPush[14]=$vLangArr[31];
$mocr_lv0413->ArrPush[15]=$vLangArr[32];
$mocr_lv0413->ArrPush[26]='Ghi chú 2';
$mocr_lv0413->ArrPush[89]=$vLangArr[49];
$mocr_lv0413->ArrPush[98]=$vLangArr[43];
$mocr_lv0413->ArrPush[99]=$vLangArr[44];
$mocr_lv0413->ArrPush[100]='PO#/ContractID';


$mocr_lv0413->ArrPush[201]='Tên NCC';
$mocr_lv0413->ArrPush[203]='Nguồn xuất kho';
$mocr_lv0413->ArrPush[204]='Mã tham chiếu';
$mocr_lv0413->ArrPush[205]='Tên KH';
$mocr_lv0413->ArrPush[210]='Ngày nhập kho';
$mocr_lv0413->ArrPush[199]='Mã số mua hàng';
$mocr_lv0413->ArrPush[189]='Mô tả';

$mocr_lv0413->ArrPush[102]='CO';
$mocr_lv0413->ArrPush[103]='CQ';
$mocr_lv0413->ArrPush[104]='BL';
$mocr_lv0413->ArrPush[105]='PL';
$mocr_lv0413->ArrPush[106]='Invoice';
$mocr_lv0413->ArrPush[107]='Số chứng nhận PCCC';
$mocr_lv0413->ArrPush[108]='Số series PCCC từ';
$mocr_lv0413->ArrPush[109]='Số series PCCC đến';
$mocr_lv0413->ArrPush[110]='Khoá chỉnh lô';
$mocr_lv0413->ArrPush[111]='Hợp Quy';

////Other
$mocr_lv0413->ArrOther[1]=$vLangArr[31];
$mocr_lv0413->ArrOther[2]=$vLangArr[32];
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
$mocr_lv0413->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0413');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0413->lv002=base64_decode( $_GET['ID']);
$vFieldList=$mocr_lv0413->ListView;
$curPage = $mocr_lv0413->CurPage;
$maxRows =$mocr_lv0413->MaxRows;
$vOrderList=$mocr_lv0413->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mocr_lv0413->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mocr_lv0413->GetView()==1)
{
?>

						<?php echo $mocr_lv0413->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>