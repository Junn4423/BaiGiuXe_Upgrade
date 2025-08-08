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
require_once("../../clsall/sp_lv0047.php");

/////////////init object//////////////
$mosp_lv0047=new sp_lv0047($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sp0047');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SP0032.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosp_lv0047->ArrPush[0]=$vLangArr[17];
$mosp_lv0047->ArrPush[1]=$vLangArr[18];
$mosp_lv0047->ArrPush[2]=$vLangArr[20];
$mosp_lv0047->ArrPush[3]=$vLangArr[21];
$mosp_lv0047->ArrPush[4]=$vLangArr[22];
$mosp_lv0047->ArrPush[5]=$vLangArr[23];
$mosp_lv0047->ArrPush[6]=$vLangArr[24];
$mosp_lv0047->ArrPush[7]=$vLangArr[25];
$mosp_lv0047->ArrPush[8]=$vLangArr[26];
$mosp_lv0047->ArrPush[9]=$vLangArr[27];

$mosp_lv0047->ArrFunc[0]='//Function';
$mosp_lv0047->ArrFunc[1]=$vLangArr[2];
$mosp_lv0047->ArrFunc[2]=$vLangArr[4];
$mosp_lv0047->ArrFunc[3]=$vLangArr[6];
$mosp_lv0047->ArrFunc[4]=$vLangArr[7];
$mosp_lv0047->ArrFunc[5]='';
$mosp_lv0047->ArrFunc[6]='';
$mosp_lv0047->ArrFunc[7]='';
$mosp_lv0047->ArrFunc[8]=$vLangArr[10];
$mosp_lv0047->ArrFunc[9]=$vLangArr[12];
$mosp_lv0047->ArrFunc[10]=$vLangArr[0];
$mosp_lv0047->ArrFunc[11]=$vLangArr[30];
$mosp_lv0047->ArrFunc[12]=$vLangArr[31];
$mosp_lv0047->ArrFunc[13]=$vLangArr[32];
$mosp_lv0047->ArrFunc[14]=$vLangArr[33];
$mosp_lv0047->ArrFunc[15]=$vLangArr[34];
////Other
$mosp_lv0047->ArrOther[1]=$vLangArr[28];
$mosp_lv0047->ArrOther[2]=$vLangArr[29];
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
$mosp_lv0047->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sp_lv0047');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosp_lv0047->lv002=base64_decode( $_GET['ID']);
$vFieldList=$mosp_lv0047->ListView;
$curPage = $mosp_lv0047->CurPage;
$maxRows =$mosp_lv0047->MaxRows;
$vOrderList=$mosp_lv0047->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosp_lv0047->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mosp_lv0047->GetView()==1)
{
?>

				<?php echo $mosp_lv0047->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../sp_lv0047/permit.php");
}
?>
