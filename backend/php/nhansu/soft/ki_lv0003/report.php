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
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ki_lv0003.php");

/////////////init object//////////////
$moki_lv0003=new ki_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","KI0003.txt",$plang);
$moki_lv0003->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0003->ArrPush[0]=$vLangArr[17];
$moki_lv0003->ArrPush[1]=$vLangArr[18];
$moki_lv0003->ArrPush[2]=$vLangArr[19];
$moki_lv0003->ArrPush[3]=$vLangArr[20];
$moki_lv0003->ArrPush[4]=$vLangArr[21];
$moki_lv0003->ArrPush[5]=$vLangArr[22];
$moki_lv0003->ArrPush[6]=$vLangArr[23];
$moki_lv0003->ArrPush[7]=$vLangArr[24];
$moki_lv0003->ArrPush[8]=$vLangArr[25];
$moki_lv0003->ArrPush[9]=$vLangArr[26];
$moki_lv0003->ArrPush[10]=$vLangArr[27];
$moki_lv0003->ArrPush[11]=$vLangArr[28];
$moki_lv0003->ArrPush[12]=$vLangArr[29];
$moki_lv0003->ArrPush[13]=$vLangArr[30];
$moki_lv0003->ArrPush[14]=$vLangArr[31];
$moki_lv0003->ArrPush[15]=$vLangArr[32];
$moki_lv0003->ArrPush[16]=$vLangArr[33];
$moki_lv0003->ArrPush[17]=$vLangArr[34];
$moki_lv0003->ArrPush[18]=$vLangArr[35];
$moki_lv0003->ArrPush[19]=$vLangArr[36];
$moki_lv0003->ArrPush[20]=$vLangArr[37];
$moki_lv0003->ArrPush[21]=$vLangArr[38];
$moki_lv0003->ArrPush[22]=$vLangArr[39];
$moki_lv0003->ArrPush[23]=$vLangArr[40];
$moki_lv0003->ArrPush[24]=$vLangArr[41];
$moki_lv0003->ArrPush[25]=$vLangArr[42];




$moki_lv0003->ArrFunc[0]='//Function';
$moki_lv0003->ArrFunc[1]=$vLangArr[2];
$moki_lv0003->ArrFunc[2]=$vLangArr[4];
$moki_lv0003->ArrFunc[3]=$vLangArr[6];
$moki_lv0003->ArrFunc[4]=$vLangArr[7];
$moki_lv0003->ArrFunc[5]='';
$moki_lv0003->ArrFunc[6]='';
$moki_lv0003->ArrFunc[7]='';
$moki_lv0003->ArrFunc[8]=$vLangArr[10];
$moki_lv0003->ArrFunc[9]=$vLangArr[12];
$moki_lv0003->ArrFunc[10]=$vLangArr[0];
$moki_lv0003->ArrFunc[11]=$vLangArr[63];
$moki_lv0003->ArrFunc[12]=$vLangArr[64];
$moki_lv0003->ArrFunc[13]=$vLangArr[65];
$moki_lv0003->ArrFunc[14]=$vLangArr[66];

////Other
$moki_lv0003->ArrOther[1]=$vLangArr[61];
$moki_lv0003->ArrOther[2]=$vLangArr[62];
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
$moki_lv0003->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0003');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moki_lv0003->ListView;
$curPage = $moki_lv0003->CurPage;
$maxRows =$moki_lv0003->MaxRows;
$vOrderList=$moki_lv0003->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moki_lv0003->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($moki_lv0003->GetView()==1)
{
?>

						<?php echo $moki_lv0003->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
