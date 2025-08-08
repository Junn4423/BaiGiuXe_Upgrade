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
header('Content-Type: text/html; charset=utf-8');}


//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/lv_lv0007.php");

/////////////init object//////////////
$molv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","LV0003.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0007->ArrPush[0]=$vLangArr[17];
$molv_lv0007->ArrPush[1]=$vLangArr[18];
$molv_lv0007->ArrPush[2]=$vLangArr[20];
$molv_lv0007->ArrPush[3]=$vLangArr[22];
$molv_lv0007->ArrPush[4]=$vLangArr[23];
$molv_lv0007->ArrPush[5]=$vLangArr[21];
$molv_lv0007->ArrPush[6]=$vLangArr[24];
$molv_lv0007->ArrPush[7]=$vLangArr[25];
$molv_lv0007->ArrPush[8]=$vLangArr[26];
$molv_lv0007->ArrPush[9]='DeActive';
$molv_lv0007->ArrPush[10]='UserControl';
$molv_lv0007->ArrPush[11]='IPLogin';
$molv_lv0007->ArrPush[907]='Khu vực';
$molv_lv0007->ArrPush[910]='Thấy giá kho';
$molv_lv0007->ArrPush[911]='Thấy giá PBH';
$molv_lv0007->ArrPush[912]='Thấy giá BBG';
$molv_lv0007->ArrPush[913]='Thấy giá PMH';
$molv_lv0007->ArrPush[914]='Thấy giá SP';
$molv_lv0007->ArrPush[915]='Xem toàn quyền';
$molv_lv0007->ArrPush[905]='Trợ lý của :';
$molv_lv0007->ArrPush[906]='Thay thế NV nghỉ việc:';

$molv_lv0007->ArrFunc[0]='//Function';
$molv_lv0007->ArrFunc[1]=$vLangArr[2];
$molv_lv0007->ArrFunc[2]=$vLangArr[4];
$molv_lv0007->ArrFunc[3]=$vLangArr[6];
$molv_lv0007->ArrFunc[4]=$vLangArr[7];
$molv_lv0007->ArrFunc[5]='';
$molv_lv0007->ArrFunc[6]='';
$molv_lv0007->ArrFunc[7]='';
$molv_lv0007->ArrFunc[8]=$vLangArr[10];
$molv_lv0007->ArrFunc[9]=$vLangArr[12];
$molv_lv0007->ArrFunc[10]=$vLangArr[0];
$molv_lv0007->ArrFunc[11]=$vLangArr[30];
$molv_lv0007->ArrFunc[12]=$vLangArr[31];
$molv_lv0007->ArrFunc[13]=$vLangArr[32];
$molv_lv0007->ArrFunc[14]=$vLangArr[33];
$molv_lv0007->ArrFunc[15]=$vLangArr[34];
////Other
$molv_lv0007->ArrOther[1]=$vLangArr[28];
$molv_lv0007->ArrOther[2]=$vLangArr[29];
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
$molv_lv0007->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0007');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0007->lv002=base64_decode( $_GET['ID']);
$vFieldList=$molv_lv0007->ListView;
$curPage = $molv_lv0007->CurPage;
$maxRows =$molv_lv0007->MaxRows;
$vOrderList=$molv_lv0007->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$molv_lv0007->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($molv_lv0007->GetView()==1)
{
?>

				<?php echo $molv_lv0007->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../lv_lv0007/permit.php");
}
?>
