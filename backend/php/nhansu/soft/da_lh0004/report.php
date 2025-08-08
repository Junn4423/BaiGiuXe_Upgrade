<?php
session_start();
$sExport=$_GET['childfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=Well_List.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=Well_List.doc');
}
if($sExport=="pdf"){
header('Content-Type: text/html; charset=utf-8');}
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="Well_List.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/cr_lv0039.php");

/////////////init object//////////////
$mocr_lv0039=new cr_lv0039($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0039');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","CR0010.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0039->ArrPush[0]=$vLangArr[17];
$mocr_lv0039->ArrPush[1]=$vLangArr[18];
$mocr_lv0039->ArrPush[2]=$vLangArr[20];
$mocr_lv0039->ArrPush[3]=$vLangArr[21];
$mocr_lv0039->ArrPush[4]=$vLangArr[22];
$mocr_lv0039->ArrPush[5]=$vLangArr[23];
$mocr_lv0039->ArrPush[6]=$vLangArr[24];
$mocr_lv0039->ArrPush[7]=$vLangArr[25];

$mocr_lv0039->ArrFunc[0]='//Function';
$mocr_lv0039->ArrFunc[1]=$vLangArr[2];
$mocr_lv0039->ArrFunc[2]=$vLangArr[4];
$mocr_lv0039->ArrFunc[3]=$vLangArr[6];
$mocr_lv0039->ArrFunc[4]=$vLangArr[7];
$mocr_lv0039->ArrFunc[5]='';
$mocr_lv0039->ArrFunc[6]='';
$mocr_lv0039->ArrFunc[7]='';
$mocr_lv0039->ArrFunc[8]=$vLangArr[10];
$mocr_lv0039->ArrFunc[9]=$vLangArr[12];
$mocr_lv0039->ArrFunc[10]=$vLangArr[0];
$mocr_lv0039->ArrFunc[11]=$vLangArr[24];
$mocr_lv0039->ArrFunc[12]=$vLangArr[25];
$mocr_lv0039->ArrFunc[13]=$vLangArr[26];
$mocr_lv0039->ArrFunc[14]=$vLangArr[27];
$mocr_lv0039->ArrFunc[15]=$vLangArr[28];
////Other
$mocr_lv0039->ArrOther[1]=$vLangArr[22];
$mocr_lv0039->ArrOther[2]=$vLangArr[23];
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
$mocr_lv0039->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0039');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mocr_lv0039->ListView;
$curPage = $mocr_lv0039->CurPage;
$maxRows =$mocr_lv0039->MaxRows;
$vOrderList=$mocr_lv0039->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mocr_lv0039->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
if ($sExport != "excel" && $sExport != "word") {
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
}
if($mocr_lv0039->GetView()==1)
{
?>
<table width="800">
<tr>
    <td colspan="6" align="center"><h1><?php echo $mocr_lv0039->ArrPush[0];?></h1></td>
</tr>
</table>
				<?php echo $mocr_lv0039->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../cr_lv0039/permit.php");
}
?>
