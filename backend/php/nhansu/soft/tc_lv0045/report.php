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
require_once("../../clsall/tc_lv0045.php");

/////////////init object//////////////
$motc_lv0045=new tc_lv0045($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0018');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0029.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0045->ArrPush[0]=$vLangArr[17];
$motc_lv0045->ArrPush[1]=$vLangArr[18];
$motc_lv0045->ArrPush[2]=$vLangArr[20];
$motc_lv0045->ArrPush[3]=$vLangArr[21];
$motc_lv0045->ArrPush[4]=$vLangArr[22];
$motc_lv0045->ArrPush[5]=$vLangArr[23];
$motc_lv0045->ArrPush[6]=$vLangArr[24];
$motc_lv0045->ArrPush[7]=$vLangArr[25];
$motc_lv0045->ArrPush[8]=$vLangArr[26];

$motc_lv0045->ArrFunc[0]='//Function';
$motc_lv0045->ArrFunc[1]=$vLangArr[2];
$motc_lv0045->ArrFunc[2]=$vLangArr[4];
$motc_lv0045->ArrFunc[3]=$vLangArr[6];
$motc_lv0045->ArrFunc[4]=$vLangArr[7];
$motc_lv0045->ArrFunc[5]='';
$motc_lv0045->ArrFunc[6]='';
$motc_lv0045->ArrFunc[7]='';
$motc_lv0045->ArrFunc[8]=$vLangArr[10];
$motc_lv0045->ArrFunc[9]=$vLangArr[12];
$motc_lv0045->ArrFunc[10]=$vLangArr[0];
$motc_lv0045->ArrFunc[11]=$vLangArr[25];
$motc_lv0045->ArrFunc[12]=$vLangArr[26];
$motc_lv0045->ArrFunc[13]=$vLangArr[27];
$motc_lv0045->ArrFunc[14]=$vLangArr[28];
$motc_lv0045->ArrFunc[15]=$vLangArr[29];
////Other
$motc_lv0045->ArrOther[1]=$vLangArr[23];
$motc_lv0045->ArrOther[2]=$vLangArr[24];
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
$motc_lv0045->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0045');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0045->ListView;
$curPage = $motc_lv0045->CurPage;
$maxRows =$motc_lv0045->MaxRows;
$vOrderList=$motc_lv0045->ListOrder;
$motc_lv0045->lv002=base64_decode( $_GET['ID']);
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0045->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($motc_lv0045->GetView()==1)
{
?>

				<?php echo $motc_lv0045->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
