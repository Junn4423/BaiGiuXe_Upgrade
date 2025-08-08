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
header('Content-Type: text/html; charset=utf-8');}


//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ki_lv0002.php");

/////////////init object//////////////
$moki_lv0002=new ki_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","KI0001.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0002->ArrPush[0]=$vLangArr[17];
$moki_lv0002->ArrPush[1]=$vLangArr[18];
$moki_lv0002->ArrPush[2]=$vLangArr[20];
$moki_lv0002->ArrPush[3]=$vLangArr[21];
$moki_lv0002->ArrPush[4]=$vLangArr[22];
$moki_lv0002->ArrPush[5]=$vLangArr[23];
$moki_lv0002->ArrPush[6]=$vLangArr[24];
$moki_lv0002->ArrPush[7]=$vLangArr[25];
$moki_lv0002->ArrPush[8]=$vLangArr[26];

$moki_lv0002->ArrFunc[0]='//Function';
$moki_lv0002->ArrFunc[1]=$vLangArr[2];
$moki_lv0002->ArrFunc[2]=$vLangArr[4];
$moki_lv0002->ArrFunc[3]=$vLangArr[6];
$moki_lv0002->ArrFunc[4]=$vLangArr[7];
$moki_lv0002->ArrFunc[5]='';
$moki_lv0002->ArrFunc[6]='';
$moki_lv0002->ArrFunc[7]='';
$moki_lv0002->ArrFunc[8]=$vLangArr[10];
$moki_lv0002->ArrFunc[9]=$vLangArr[12];
$moki_lv0002->ArrFunc[10]=$vLangArr[0];
$moki_lv0002->ArrFunc[11]=$vLangArr[25];
$moki_lv0002->ArrFunc[12]=$vLangArr[26];
$moki_lv0002->ArrFunc[13]=$vLangArr[27];
$moki_lv0002->ArrFunc[14]=$vLangArr[28];
$moki_lv0002->ArrFunc[15]=$vLangArr[29];
////Other
$moki_lv0002->ArrOther[1]=$vLangArr[23];
$moki_lv0002->ArrOther[2]=$vLangArr[24];
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
$moki_lv0002->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moki_lv0002->ListView;
$curPage = $moki_lv0002->CurPage;
$maxRows =$moki_lv0002->MaxRows;
$vOrderList=$moki_lv0002->ListOrder;
$moki_lv0002->lv002=base64_decode( $_GET['ID']);
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moki_lv0002->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($moki_lv0002->GetView()==1)
{
?>

				<?php echo $moki_lv0002->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../ki_lv0002/permit.php");
}
?>
