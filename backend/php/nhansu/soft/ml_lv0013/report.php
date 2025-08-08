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
require_once("../../clsall/ml_lv0013.php");

/////////////init object//////////////
$moml_lv0013=new ml_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0013');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","ML0026.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moml_lv0013->ArrPush[0]=$vLangArr[17];
$moml_lv0013->ArrPush[1]=$vLangArr[18];
$moml_lv0013->ArrPush[2]=$vLangArr[20];
$moml_lv0013->ArrPush[3]=$vLangArr[21];
$moml_lv0013->ArrPush[4]=$vLangArr[22];

$moml_lv0013->ArrFunc[0]='//Function';
$moml_lv0013->ArrFunc[1]=$vLangArr[2];
$moml_lv0013->ArrFunc[2]=$vLangArr[4];
$moml_lv0013->ArrFunc[3]=$vLangArr[6];
$moml_lv0013->ArrFunc[4]=$vLangArr[7];
$moml_lv0013->ArrFunc[5]='';
$moml_lv0013->ArrFunc[6]='';
$moml_lv0013->ArrFunc[7]='';
$moml_lv0013->ArrFunc[8]=$vLangArr[10];
$moml_lv0013->ArrFunc[9]=$vLangArr[12];
$moml_lv0013->ArrFunc[10]=$vLangArr[0];
$moml_lv0013->ArrFunc[11]=$vLangArr[25];
$moml_lv0013->ArrFunc[12]=$vLangArr[26];
$moml_lv0013->ArrFunc[13]=$vLangArr[27];
$moml_lv0013->ArrFunc[14]=$vLangArr[28];
$moml_lv0013->ArrFunc[15]=$vLangArr[29];
////Other
$moml_lv0013->ArrOther[1]=$vLangArr[23];
$moml_lv0013->ArrOther[2]=$vLangArr[24];
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
$moml_lv0013->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ml_lv0013');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moml_lv0013->ListView;
$curPage = $moml_lv0013->CurPage;
$maxRows =$moml_lv0013->MaxRows;
$vOrderList=$moml_lv0013->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moml_lv0013->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($moml_lv0013->GetView()==1)
{
?>

				<?php echo $moml_lv0013->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
