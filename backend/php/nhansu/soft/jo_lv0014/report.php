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
require_once("../../clsall/jo_lv0014.php");

/////////////init object//////////////
$mojo_lv0014=new jo_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","JO0005.txt",$plang);
$mojo_lv0014->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0014->ArrPush[0]=$vLangArr[17];
$mojo_lv0014->ArrPush[1]=$vLangArr[18];
$mojo_lv0014->ArrPush[2]=$vLangArr[19];
$mojo_lv0014->ArrPush[3]=$vLangArr[20];
$mojo_lv0014->ArrPush[4]=$vLangArr[21];
$mojo_lv0014->ArrPush[5]=$vLangArr[22];
$mojo_lv0014->ArrPush[6]=$vLangArr[23];
$mojo_lv0014->ArrPush[7]=$vLangArr[24];
$mojo_lv0014->ArrPush[8]=$vLangArr[25];
$mojo_lv0014->ArrPush[9]=$vLangArr[26];
$mojo_lv0014->ArrPush[10]=$vLangArr[27];
$mojo_lv0014->ArrPush[11]=$vLangArr[28];
$mojo_lv0014->ArrPush[12]=$vLangArr[29];
$mojo_lv0014->ArrPush[13]=$vLangArr[30];
$mojo_lv0014->ArrPush[14]=$vLangArr[31];
$mojo_lv0014->ArrPush[15]=$vLangArr[32];
$mojo_lv0014->ArrPush[16]=$vLangArr[33];
$mojo_lv0014->ArrPush[17]=$vLangArr[34];
$mojo_lv0014->ArrPush[18]=$vLangArr[35];
$mojo_lv0014->ArrPush[19]=$vLangArr[36];
$mojo_lv0014->ArrPush[20]=$vLangArr[37];
$mojo_lv0014->ArrPush[21]=$vLangArr[38];
$mojo_lv0014->ArrPush[22]=$vLangArr[39];
$mojo_lv0014->ArrPush[23]=$vLangArr[40];
$mojo_lv0014->ArrPush[24]=$vLangArr[41];
$mojo_lv0014->ArrPush[25]=$vLangArr[42];




$mojo_lv0014->ArrFunc[0]='//Function';
$mojo_lv0014->ArrFunc[1]=$vLangArr[2];
$mojo_lv0014->ArrFunc[2]=$vLangArr[4];
$mojo_lv0014->ArrFunc[3]=$vLangArr[6];
$mojo_lv0014->ArrFunc[4]=$vLangArr[7];
$mojo_lv0014->ArrFunc[5]='';
$mojo_lv0014->ArrFunc[6]='';
$mojo_lv0014->ArrFunc[7]='';
$mojo_lv0014->ArrFunc[8]=$vLangArr[10];
$mojo_lv0014->ArrFunc[9]=$vLangArr[12];
$mojo_lv0014->ArrFunc[10]=$vLangArr[0];
$mojo_lv0014->ArrFunc[11]=$vLangArr[63];
$mojo_lv0014->ArrFunc[12]=$vLangArr[64];
$mojo_lv0014->ArrFunc[13]=$vLangArr[65];
$mojo_lv0014->ArrFunc[14]=$vLangArr[66];

////Other
$mojo_lv0014->ArrOther[1]=$vLangArr[61];
$mojo_lv0014->ArrOther[2]=$vLangArr[62];
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
$mojo_lv0014->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0014');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mojo_lv0014->ListView;
$curPage = $mojo_lv0014->CurPage;
$maxRows =$mojo_lv0014->MaxRows;
$vOrderList=$mojo_lv0014->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mojo_lv0014->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mojo_lv0014->GetView()==1)
{
?>

						<?php echo $mojo_lv0014->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
