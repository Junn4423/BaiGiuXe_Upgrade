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
require_once("../../clsall/hr_lv0022.php");

/////////////init object//////////////
$mohr_lv0022=new hr_lv0022($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0062');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","HR0142.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0022->ArrPush[0]=$vLangArr[17];
$mohr_lv0022->ArrPush[1]=$vLangArr[18];
$mohr_lv0022->ArrPush[2]=$vLangArr[20];
$mohr_lv0022->ArrPush[3]=$vLangArr[21];

$mohr_lv0022->ArrFunc[0]='//Function';
$mohr_lv0022->ArrFunc[1]=$vLangArr[2];
$mohr_lv0022->ArrFunc[2]=$vLangArr[4];
$mohr_lv0022->ArrFunc[3]=$vLangArr[6];
$mohr_lv0022->ArrFunc[4]=$vLangArr[7];
$mohr_lv0022->ArrFunc[5]='';
$mohr_lv0022->ArrFunc[6]='';
$mohr_lv0022->ArrFunc[7]='';
$mohr_lv0022->ArrFunc[8]=$vLangArr[8];
$mohr_lv0022->ArrFunc[9]=$vLangArr[10];
$mohr_lv0022->ArrFunc[10]=$vLangArr[0];
$mohr_lv0022->ArrFunc[11]=$vLangArr[24];
////Other
$mohr_lv0022->ArrOther[1]=$vLangArr[22];
$mohr_lv0022->ArrOther[2]=$vLangArr[23];
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
$mohr_lv0022->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0022');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0022->lv002=base64_decode( $_GET['ID']);
$vFieldList=$mohr_lv0022->ListView;
$curPage = $mohr_lv0022->CurPage;
$maxRows =$mohr_lv0022->MaxRows;
$vOrderList=$mohr_lv0022->ListOrder;
$vSortNum=$mohr_lv0022->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0022->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mohr_lv0022->GetView()==1)
{
?>

				<?php echo $mohr_lv0022->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
