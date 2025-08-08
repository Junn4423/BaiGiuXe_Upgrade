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
require_once("../../clsall/ts_lv0002.php");

/////////////init object//////////////
$mots_lv0002=new ts_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0001.txt",$plang);
$mots_lv0002->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0002->ArrPush[0]=$vLangArr[17];
$mots_lv0002->ArrPush[1]=$vLangArr[18];
$mots_lv0002->ArrPush[2]=$vLangArr[19];
$mots_lv0002->ArrPush[3]=$vLangArr[20];
$mots_lv0002->ArrPush[4]=$vLangArr[21];
$mots_lv0002->ArrPush[5]=$vLangArr[22];
$mots_lv0002->ArrPush[6]=$vLangArr[23];
$mots_lv0002->ArrPush[7]=$vLangArr[24];
$mots_lv0002->ArrPush[8]=$vLangArr[25];
$mots_lv0002->ArrPush[9]=$vLangArr[26];
$mots_lv0002->ArrPush[10]=$vLangArr[27];
$mots_lv0002->ArrPush[11]=$vLangArr[28];
$mots_lv0002->ArrPush[12]=$vLangArr[29];
$mots_lv0002->ArrPush[13]=$vLangArr[30];
$mots_lv0002->ArrPush[14]=$vLangArr[31];
$mots_lv0002->ArrPush[15]=$vLangArr[32];
$mots_lv0002->ArrPush[16]=$vLangArr[33];
$mots_lv0002->ArrPush[17]=$vLangArr[34];
$mots_lv0002->ArrPush[18]=$vLangArr[35];
$mots_lv0002->ArrPush[19]=$vLangArr[36];
$mots_lv0002->ArrPush[20]=$vLangArr[37];
$mots_lv0002->ArrPush[21]=$vLangArr[38];
$mots_lv0002->ArrPush[22]=$vLangArr[39];
$mots_lv0002->ArrPush[23]=$vLangArr[40];
$mots_lv0002->ArrPush[24]=$vLangArr[41];
$mots_lv0002->ArrPush[25]=$vLangArr[42];
$mots_lv0002->ArrPush[26]=$vLangArr[43];
$mots_lv0002->ArrPush[27]=$vLangArr[44];
$mots_lv0002->ArrPush[28]=$vLangArr[45];
$mots_lv0002->ArrPush[29]=$vLangArr[46];
$mots_lv0002->ArrPush[30]=$vLangArr[47];
$mots_lv0002->ArrPush[31]=$vLangArr[48];
$mots_lv0002->ArrPush[32]=$vLangArr[49];
$mots_lv0002->ArrPush[33]=$vLangArr[50];
$mots_lv0002->ArrPush[34]=$vLangArr[51];
$mots_lv0002->ArrPush[35]=$vLangArr[52];
$mots_lv0002->ArrPush[36]=$vLangArr[53];
$mots_lv0002->ArrPush[37]=$vLangArr[54];
$mots_lv0002->ArrPush[38]=$vLangArr[55];
$mots_lv0002->ArrPush[39]=$vLangArr[56];
$mots_lv0002->ArrPush[40]=$vLangArr[57];
$mots_lv0002->ArrPush[41]=$vLangArr[58];
$mots_lv0002->ArrPush[42]=$vLangArr[59];
$mots_lv0002->ArrPush[43]=$vLangArr[60];



$mots_lv0002->ArrFunc[0]='//Function';
$mots_lv0002->ArrFunc[1]=$vLangArr[2];
$mots_lv0002->ArrFunc[2]=$vLangArr[4];
$mots_lv0002->ArrFunc[3]=$vLangArr[6];
$mots_lv0002->ArrFunc[4]=$vLangArr[7];
$mots_lv0002->ArrFunc[5]='';
$mots_lv0002->ArrFunc[6]='';
$mots_lv0002->ArrFunc[7]='';
$mots_lv0002->ArrFunc[8]=$vLangArr[10];
$mots_lv0002->ArrFunc[9]=$vLangArr[12];
$mots_lv0002->ArrFunc[10]=$vLangArr[0];
$mots_lv0002->ArrFunc[11]=$vLangArr[63];
$mots_lv0002->ArrFunc[12]=$vLangArr[64];
$mots_lv0002->ArrFunc[13]=$vLangArr[65];
$mots_lv0002->ArrFunc[14]=$vLangArr[66];

////Other
$mots_lv0002->ArrOther[1]=$vLangArr[61];
$mots_lv0002->ArrOther[2]=$vLangArr[62];
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
$mots_lv0002->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mots_lv0002->ListView;
$curPage = $mots_lv0002->CurPage;
$maxRows =$mots_lv0002->MaxRows;
$vOrderList=$mots_lv0002->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mots_lv0002->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mots_lv0002->GetView()==1)
{
?>

						<?php echo $mots_lv0002->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../ts_lv0002/permit.php");
}
?>
