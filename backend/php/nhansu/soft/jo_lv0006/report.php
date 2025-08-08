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
require_once("../../clsall/jo_lv0006.php");

/////////////init object//////////////
$mojo_lv0006=new jo_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0006');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0004.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0006->ArrPush[0]=$vLangArr[17];
$mojo_lv0006->ArrPush[1]=$vLangArr[18];
$mojo_lv0006->ArrPush[2]=$vLangArr[20];
$mojo_lv0006->ArrPush[3]=$vLangArr[21];
$mojo_lv0006->ArrPush[4]=$vLangArr[22];
$mojo_lv0006->ArrPush[5]=$vLangArr[23];
$mojo_lv0006->ArrPush[6]=$vLangArr[24];
$mojo_lv0006->ArrPush[7]=$vLangArr[25];
$mojo_lv0006->ArrPush[8]=$vLangArr[26];

$mojo_lv0006->ArrFunc[0]='//Function';
$mojo_lv0006->ArrFunc[1]=$vLangArr[2];
$mojo_lv0006->ArrFunc[2]=$vLangArr[4];
$mojo_lv0006->ArrFunc[3]=$vLangArr[6];
$mojo_lv0006->ArrFunc[4]=$vLangArr[7];
$mojo_lv0006->ArrFunc[5]='';
$mojo_lv0006->ArrFunc[6]='';
$mojo_lv0006->ArrFunc[7]='';
$mojo_lv0006->ArrFunc[8]=$vLangArr[10];
$mojo_lv0006->ArrFunc[9]=$vLangArr[12];
$mojo_lv0006->ArrFunc[10]=$vLangArr[0];
$mojo_lv0006->ArrFunc[11]=$vLangArr[29];
$mojo_lv0006->ArrFunc[12]=$vLangArr[30];
$mojo_lv0006->ArrFunc[13]=$vLangArr[31];
$mojo_lv0006->ArrFunc[14]=$vLangArr[32];
$mojo_lv0006->ArrFunc[15]=$vLangArr[33];
////Other
$mojo_lv0006->ArrOther[1]=$vLangArr[27];
$mojo_lv0006->ArrOther[2]=$vLangArr[28];
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
$mojo_lv0006->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0006');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mojo_lv0006->ListView;
$curPage = $mojo_lv0006->CurPage;
$maxRows =$mojo_lv0006->MaxRows;
$vOrderList=$mojo_lv0006->ListOrder;
$mojo_lv0006->lv002=base64_decode( $_GET['ID']);
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mojo_lv0006->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mojo_lv0006->GetView()==1)
{
?>

				<?php echo $mojo_lv0006->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../jo_lv0006/permit.php");
}
?>
