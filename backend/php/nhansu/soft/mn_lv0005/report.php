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
require_once("../../clsall/mn_lv0005.php");

/////////////init object//////////////
$momn_lv0005=new mn_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0005');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","MN0015.txt",$plang);
$momn_lv0005->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0005->ArrPush[0]=$vLangArr[17];
$momn_lv0005->ArrPush[1]=$vLangArr[18];
$momn_lv0005->ArrPush[2]=$vLangArr[19];
$momn_lv0005->ArrPush[3]=$vLangArr[20];
$momn_lv0005->ArrPush[4]=$vLangArr[21];


$momn_lv0005->ArrFunc[0]='//Function';
$momn_lv0005->ArrFunc[1]=$vLangArr[2];
$momn_lv0005->ArrFunc[2]=$vLangArr[4];
$momn_lv0005->ArrFunc[3]=$vLangArr[6];
$momn_lv0005->ArrFunc[4]=$vLangArr[7];
$momn_lv0005->ArrFunc[5]='';
$momn_lv0005->ArrFunc[6]='';
$momn_lv0005->ArrFunc[7]='';
$momn_lv0005->ArrFunc[8]=$vLangArr[10];
$momn_lv0005->ArrFunc[9]=$vLangArr[12];
$momn_lv0005->ArrFunc[10]=$vLangArr[0];
$momn_lv0005->ArrFunc[11]=$vLangArr[33];
$momn_lv0005->ArrFunc[12]=$vLangArr[34];
$momn_lv0005->ArrFunc[13]=$vLangArr[35];
$momn_lv0005->ArrFunc[14]=$vLangArr[36];
$momn_lv0005->ArrFunc[15]=$vLangArr[37];

////Other
$momn_lv0005->ArrOther[1]=$vLangArr[31];
$momn_lv0005->ArrOther[2]=$vLangArr[32];
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
$momn_lv0005->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0005');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0005->lv002=base64_decode( $_GET['ID']);
$vFieldList=$momn_lv0005->ListView;
$curPage = $momn_lv0005->CurPage;
$maxRows =$momn_lv0005->MaxRows;
$vOrderList=$momn_lv0005->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$momn_lv0005->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($momn_lv0005->GetView()==1)
{
?>

						<?php echo $momn_lv0005->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../mn_lv0005/permit.php");
}
?>
