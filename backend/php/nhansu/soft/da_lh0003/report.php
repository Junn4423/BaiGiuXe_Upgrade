<?php
session_start();
$sExport=$_GET['childdetailfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=ds_tailieu.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=ds_tailieu.doc');
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
require_once("../../clsall/da_lh0003.php");

/////////////init object//////////////
$moda_lh0003=new da_lh0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Da0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","CR0278.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moda_lh0003->ArrPush[0]=$vLangArr[17];
$moda_lh0003->ArrPush[1]=$vLangArr[18];
$moda_lh0003->ArrPush[2]=$vLangArr[20];
$moda_lh0003->ArrPush[3]=$vLangArr[21];
$moda_lh0003->ArrPush[4]="Giai đoạn";
$moda_lh0003->ArrPush[5]="Mã công việc";
$moda_lh0003->ArrPush[6]="Tên công việc (Tiếng Việt)";
$moda_lh0003->ArrPush[7]="Tên công việc (English)";
$moda_lh0003->ArrPush[8]="Mô tả công việc (Tiếng Việt)";
$moda_lh0003->ArrPush[9]="Mô tả công việc (English)";
$moda_lh0003->ArrPush[10]=$vLangArr[28];
$moda_lh0003->ArrPush[11]=$vLangArr[29];

$moda_lh0003->ArrPush[12]="Trạng thái";
$moda_lh0003->ArrPush[13]="Tên công việc";
$moda_lh0003->ArrPush[14]="Mã công việc";
$moda_lh0003->ArrPush[15]=$vLangArr[40];
$moda_lh0003->ArrPush[16]=$vLangArr[41];
$moda_lh0003->ArrPush[17]="Giai đoạn";
$moda_lh0003->ArrPush[18]=$vLangArr[43];
$moda_lh0003->ArrPush[19]="Mã dự án";
$moda_lh0003->ArrPush[20]="Ngày hoàn thành";
$moda_lh0003->ArrPush[21]="Chức năng";

$moda_lh0003->ArrFunc[0]='//Function';
$moda_lh0003->ArrFunc[1]=$vLangArr[2];
$moda_lh0003->ArrFunc[2]=$vLangArr[4];
$moda_lh0003->ArrFunc[3]=$vLangArr[6];
$moda_lh0003->ArrFunc[4]=$vLangArr[7];
$moda_lh0003->ArrFunc[5]='';
$moda_lh0003->ArrFunc[6]='';
$moda_lh0003->ArrFunc[7]='';
$moda_lh0003->ArrFunc[8]=$vLangArr[10];
$moda_lh0003->ArrFunc[9]=$vLangArr[12];
$moda_lh0003->ArrFunc[10]=$vLangArr[0];
$moda_lh0003->ArrFunc[11]=$vLangArr[32];
$moda_lh0003->ArrFunc[12]=$vLangArr[33];
$moda_lh0003->ArrFunc[13]=$vLangArr[34];
$moda_lh0003->ArrFunc[14]=$vLangArr[35];
$moda_lh0003->ArrFunc[15]=$vLangArr[36];
////Other
$moda_lh0003->ArrOther[1]=$vLangArr[30];
$moda_lh0003->ArrOther[2]=$vLangArr[31];
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
$moda_lh0003->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'da_lh0003');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moda_lh0003->ListView;
$curPage = $moda_lh0003->CurPage;
$maxRows =$moda_lh0003->MaxRows;
$vOrderList=$moda_lh0003->ListOrder;
$moda_lh0003->lv002=base64_decode( $_GET['ID']);
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moda_lh0003->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($moda_lh0003->GetView()==1)
{
?>

				<?php echo $moda_lh0003->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../da_lh0003/permit.php");
}
?>
