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
require_once("../../clsall/sl_lv0005.php");

/////////////init object//////////////
$mosl_lv0005=new sl_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0006');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0010.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0005->ArrPush[0]=$vLangArr[17];
$mosl_lv0005->ArrPush[1]=$vLangArr[18];
$mosl_lv0005->ArrPush[2]=$vLangArr[20];
$mosl_lv0005->ArrPush[3]=$vLangArr[21];
$mosl_lv0005->ArrPush[4]=$vLangArr[22];

$mosl_lv0005->ArrFunc[0]='//Function';
$mosl_lv0005->ArrFunc[1]=$vLangArr[2];
$mosl_lv0005->ArrFunc[2]=$vLangArr[4];
$mosl_lv0005->ArrFunc[3]=$vLangArr[6];
$mosl_lv0005->ArrFunc[4]=$vLangArr[7];
$mosl_lv0005->ArrFunc[5]='';
$mosl_lv0005->ArrFunc[6]='';
$mosl_lv0005->ArrFunc[7]='';
$mosl_lv0005->ArrFunc[8]=$vLangArr[10];
$mosl_lv0005->ArrFunc[9]=$vLangArr[12];
$mosl_lv0005->ArrFunc[10]=$vLangArr[0];
$mosl_lv0005->ArrFunc[11]=$vLangArr[25];
$mosl_lv0005->ArrFunc[12]=$vLangArr[26];
$mosl_lv0005->ArrFunc[13]=$vLangArr[27];
$mosl_lv0005->ArrFunc[14]=$vLangArr[28];
$mosl_lv0005->ArrFunc[15]=$vLangArr[29];
////Other
$mosl_lv0005->ArrOther[1]=$vLangArr[23];
$mosl_lv0005->ArrOther[2]=$vLangArr[24];
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
$mosl_lv0005->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0005');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0005->ListView;
$curPage = $mosl_lv0005->CurPage;
$maxRows =$mosl_lv0005->MaxRows;
$vOrderList=$mosl_lv0005->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0005->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mosl_lv0005->GetView()==1)
{
?>

				<?php echo $mosl_lv0005->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../sl_lv0005/permit.php");
}
?>
