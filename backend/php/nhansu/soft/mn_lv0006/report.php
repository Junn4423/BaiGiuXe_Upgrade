<?php
session_start();
$sExport=$_GET['childfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=banhang_'.date(YmdHis).'.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=banhang_'.date(YmdHis).'.doc');
}
if($sExport=="pdf"){
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="banhang_'.date(YmdHis).'.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0013.php");
require_once("../../clsall/sl_lv0014.php");

/////////////init object//////////////
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0006');
$mosl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0014');
$mosl_lv0013->obj_child=$mosl_lv0014;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0027.txt",$plang);
$mosl_lv0013->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0013->ArrPush[0]=$vLangArr[17];
$mosl_lv0013->ArrPush[1]=$vLangArr[18];
$mosl_lv0013->ArrPush[2]=$vLangArr[19];
$mosl_lv0013->ArrPush[3]=$vLangArr[20];
$mosl_lv0013->ArrPush[4]=$vLangArr[21];
$mosl_lv0013->ArrPush[5]=$vLangArr[22];
$mosl_lv0013->ArrPush[6]=$vLangArr[23];
$mosl_lv0013->ArrPush[7]=$vLangArr[24];
$mosl_lv0013->ArrPush[8]=$vLangArr[25];
$mosl_lv0013->ArrPush[9]=$vLangArr[26];
$mosl_lv0013->ArrPush[10]=$vLangArr[27];
$mosl_lv0013->ArrPush[11]=$vLangArr[28];
$mosl_lv0013->ArrPush[12]=$vLangArr[29];
$mosl_lv0013->ArrPush[13]=$vLangArr[41];
$mosl_lv0013->ArrPush[14]=$vLangArr[40];
$mosl_lv0013->ArrPush[15]=$vLangArr[42];
$mosl_lv0013->ArrPush[16]=$vLangArr[45];
$mosl_lv0013->ArrPush[17]=$vLangArr[43];
$mosl_lv0013->ArrPush[18]=$vLangArr[44];
$mosl_lv0013->ArrPush[19]=$vLangArr[46];
$mosl_lv0013->ArrPush[20]=$vLangArr[47];
$mosl_lv0013->ArrPush[21]=$vLangArr[48];
$mosl_lv0013->ArrPush[22]=$vLangArr[49];
$mosl_lv0013->ArrPush[23]=$vLangArr[57];
$mosl_lv0013->ArrPush[24]=$vLangArr[51];
$mosl_lv0013->ArrPush[25]=$vLangArr[52];
$mosl_lv0013->ArrPush[26]=$vLangArr[53];
$mosl_lv0013->ArrPush[27]=$vLangArr[50];
$mosl_lv0013->ArrPush[28]=$vLangArr[60];
$mosl_lv0013->ArrPush[29]=$vLangArr[61];
$mosl_lv0013->ArrPush[30]=$vLangArr[62];

$mosl_lv0013->ArrPush[99]=$vLangArr[63];

$mosl_lv0013->ArrFunc[0]='//Function';
$mosl_lv0013->ArrFunc[1]=$vLangArr[2];
$mosl_lv0013->ArrFunc[2]=$vLangArr[4];
$mosl_lv0013->ArrFunc[3]=$vLangArr[6];
$mosl_lv0013->ArrFunc[4]=$vLangArr[7];
$mosl_lv0013->ArrFunc[5]='';
$mosl_lv0013->ArrFunc[6]='';
$mosl_lv0013->ArrFunc[7]='';
$mosl_lv0013->ArrFunc[8]=$vLangArr[10];
$mosl_lv0013->ArrFunc[9]=$vLangArr[12];
$mosl_lv0013->ArrFunc[10]=$vLangArr[0];
$mosl_lv0013->ArrFunc[11]=$vLangArr[34];
$mosl_lv0013->ArrFunc[12]=$vLangArr[35];
$mosl_lv0013->ArrFunc[13]=$vLangArr[36];
$mosl_lv0013->ArrFunc[14]=$vLangArr[37];
$mosl_lv0013->ArrFunc[15]=$vLangArr[38];

////Other
$mosl_lv0013->ArrOther[1]=$vLangArr[32];
$mosl_lv0013->ArrOther[2]=$vLangArr[33];
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
$mosl_lv0013->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0013');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0013->lv002=base64_decode( $_GET['ID']);
$vFieldList=$mosl_lv0013->ListView;
$curPage = $mosl_lv0013->CurPage;
$maxRows =$mosl_lv0013->MaxRows;
$vOrderList=$mosl_lv0013->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0013->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<?php
if($mosl_lv0013->GetView()==1)
{
?>

						<?php echo $mosl_lv0013->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
