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
require_once("../../clsall/ki_lv0008.php");
require_once("../../clsall/tc_lv0013.php");
/////////////init object//////////////
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
/////////////init object//////////////
$moki_lv0008=new ki_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0008');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","KI0008.txt",$plang);
$moki_lv0008->lang=strtoupper($plang);
$motc_lv0013->LV_GetCal();
	if($motc_lv0013->lv999!='' || $motc_lv0013->lv999!=NULL)
	{
		$motc_lv0013->LV_LoadID($motc_lv0013->lv999);
	}
	else
		$motc_lv0013->LV_LoadActiveID();
$moki_lv0008->lv003=$motc_lv0013->lv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0008->ArrPush[0]=$vLangArr[17];
$moki_lv0008->ArrPush[1]=$vLangArr[18];
$moki_lv0008->ArrPush[2]=$vLangArr[19];
$moki_lv0008->ArrPush[3]=$vLangArr[20];
$moki_lv0008->ArrPush[4]=$vLangArr[21];
$moki_lv0008->ArrPush[5]=$vLangArr[22];
$moki_lv0008->ArrPush[6]=$vLangArr[23];
$moki_lv0008->ArrPush[7]=$vLangArr[24];
$moki_lv0008->ArrPush[8]=$vLangArr[25];
$moki_lv0008->ArrPush[100]='Tên nhân viên';
$moki_lv0008->ArrPush[101]='Tổng điểm trung bình';

$moki_lv0008->ArrFunc[0]='//Function';
$moki_lv0008->ArrFunc[1]=$vLangArr[2];
$moki_lv0008->ArrFunc[2]=$vLangArr[4];
$moki_lv0008->ArrFunc[3]=$vLangArr[6];
$moki_lv0008->ArrFunc[4]=$vLangArr[7];
$moki_lv0008->ArrFunc[5]='';
$moki_lv0008->ArrFunc[6]='';
$moki_lv0008->ArrFunc[7]='';
$moki_lv0008->ArrFunc[8]=$vLangArr[10];
$moki_lv0008->ArrFunc[9]=$vLangArr[12];
$moki_lv0008->ArrFunc[10]=$vLangArr[0];
$moki_lv0008->ArrFunc[11]=$vLangArr[28];
$moki_lv0008->ArrFunc[12]=$vLangArr[29];
$moki_lv0008->ArrFunc[13]=$vLangArr[30];
$moki_lv0008->ArrFunc[14]=$vLangArr[31];
$moki_lv0008->ArrFunc[15]=$vLangArr[32];

////Other
$moki_lv0008->ArrOther[1]=$vLangArr[26];
$moki_lv0008->ArrOther[2]=$vLangArr[27];
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
$moki_lv0008->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0008');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moki_lv0008->ListView;
$curPage = $moki_lv0008->CurPage;
$maxRows =$moki_lv0008->MaxRows;
$vOrderList=$moki_lv0008->ListOrder;
$vSortNum=$moki_lv0008->SortNum;

if($maxRows ==0) $maxRows = 10;
$moki_lv0008->lv029_=$moki_lv0008->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$totalRowsC=$moki_lv0008->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($moki_lv0008->GetView()==1)
{
?>

						<?php echo $moki_lv0008->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					
<?php
} else {
	include("../permit.php");
}
?>
