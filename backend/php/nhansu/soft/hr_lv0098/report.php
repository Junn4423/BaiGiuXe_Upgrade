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
require_once("../../clsall/hr_lv0098.php");

/////////////init object//////////////
$mohr_lv0098=new hr_lv0098($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0098');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0201.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0098->ArrPush[0]=$vLangArr[17];
$mohr_lv0098->ArrPush[1]=$vLangArr[18];
$mohr_lv0098->ArrPush[2]=$vLangArr[20];
$mohr_lv0098->ArrPush[3]=$vLangArr[21];
$mohr_lv0098->ArrPush[4]=$vLangArr[22];
$mohr_lv0098->ArrPush[5]=$vLangArr[23];
$mohr_lv0098->ArrPush[6]=$vLangArr[24];
$mohr_lv0098->ArrPush[7]=$vLangArr[25];
$mohr_lv0098->ArrPush[8]=$vLangArr[26];
$mohr_lv0098->ArrPush[9]=$vLangArr[27];
$mohr_lv0098->ArrPush[10]=$vLangArr[28];
$mohr_lv0098->ArrPush[11]='Chức vụ VN';
$mohr_lv0098->ArrPush[12]='Chức vụ EN';
$mohr_lv0098->ArrPush[13]='Chức vụ theo luật VN';
$mohr_lv0098->ArrPush[14]='Chức vụ theo luật EN';
$mohr_lv0098->ArrPush[100]='Hợp đồng liên kết';

$mohr_lv0098->ArrFunc[0]='//Function';
$mohr_lv0098->ArrFunc[1]=$vLangArr[2];
$mohr_lv0098->ArrFunc[2]=$vLangArr[4];
$mohr_lv0098->ArrFunc[3]=$vLangArr[6];
$mohr_lv0098->ArrFunc[4]=$vLangArr[7];
$mohr_lv0098->ArrFunc[5]='';
$mohr_lv0098->ArrFunc[6]='';
$mohr_lv0098->ArrFunc[7]='';
$mohr_lv0098->ArrFunc[8]=$vLangArr[10];
$mohr_lv0098->ArrFunc[9]=$vLangArr[12];
$mohr_lv0098->ArrFunc[10]=$vLangArr[0];
$mohr_lv0098->ArrFunc[11]=$vLangArr[64];
$mohr_lv0098->ArrFunc[12]=$vLangArr[65];
$mohr_lv0098->ArrFunc[13]=$vLangArr[66];
$mohr_lv0098->ArrFunc[14]=$vLangArr[67];
$mohr_lv0098->ArrFunc[15]=$vLangArr[68];

////Other
$mohr_lv0098->ArrOther[1]=$vLangArr[62];
$mohr_lv0098->ArrOther[2]=$vLangArr[63];

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
$mohr_lv0098->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0098');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0098->lv002=base64_decode( $_GET['ID']);
$vFieldList=$mohr_lv0098->ListView;
$curPage = $mohr_lv0098->CurPage;
$maxRows =$mohr_lv0098->MaxRows;
$vOrderList=$mohr_lv0098->ListOrder;
$vSortNum=$mohr_lv0098->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0098->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mohr_lv0098->GetView()==1)
{
?>

				<?php echo $mohr_lv0098->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
