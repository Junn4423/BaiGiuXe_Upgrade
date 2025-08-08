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
require_once("../../clsall/mn_lv0023.php");

/////////////init object//////////////
$momn_lv0023=new mn_lv0023($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0023');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0024.txt",$plang);
$momn_lv0023->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0023->ArrPush[0]=$vLangArr[17];
$momn_lv0023->ArrPush[1]=$vLangArr[18];
$momn_lv0023->ArrPush[2]=$vLangArr[19];
$momn_lv0023->ArrPush[3]=$vLangArr[20];
$momn_lv0023->ArrPush[4]=$vLangArr[21];
$momn_lv0023->ArrPush[5]=$vLangArr[22];
$momn_lv0023->ArrPush[6]=$vLangArr[23];
$momn_lv0023->ArrPush[7]=$vLangArr[24];
$momn_lv0023->ArrPush[8]=$vLangArr[25];
$momn_lv0023->ArrPush[9]=$vLangArr[26];
$momn_lv0023->ArrPush[10]=$vLangArr[27];
$momn_lv0023->ArrPush[11]=$vLangArr[28];
$momn_lv0023->ArrPush[12]=$vLangArr[29];
$momn_lv0023->ArrPush[13]=$vLangArr[40];
$momn_lv0023->ArrPush[14]=$vLangArr[31];
$momn_lv0023->ArrPush[15]=$vLangArr[32];
$momn_lv0023->ArrPush[28]='Trạng thái duyệt';
$momn_lv0023->ArrPush[99]='Tiền nợ treo';
$momn_lv0023->ArrPush[100]='Tiền nợ còn lại';
$momn_lv0023->ArrPush[115]='Mã công việc';
$momn_lv0023->ArrPush[105]=$vLangArr[42];
$momn_lv0023->ArrPush[106]=$vLangArr[43];
$momn_lv0023->ArrPush[107]=$vLangArr[44];
$momn_lv0023->ArrPush[108]=$vLangArr[45];
$momn_lv0023->ArrPush[109]=$vLangArr[46];
$momn_lv0023->ArrPush[110]=$vLangArr[47];
$momn_lv0023->ArrPush[111]=$vLangArr[48];
$momn_lv0023->ArrPush[112]=$vLangArr[49];
$momn_lv0023->ArrPush[113]=$vLangArr[50];
$momn_lv0023->ArrPush[114]=$vLangArr[51];

$momn_lv0023->ArrFunc[0]='//Function';
$momn_lv0023->ArrFunc[1]=$vLangArr[2];
$momn_lv0023->ArrFunc[2]=$vLangArr[4];
$momn_lv0023->ArrFunc[3]=$vLangArr[6];
$momn_lv0023->ArrFunc[4]=$vLangArr[7];
$momn_lv0023->ArrFunc[5]='';
$momn_lv0023->ArrFunc[6]='';
$momn_lv0023->ArrFunc[7]='';
$momn_lv0023->ArrFunc[8]=$vLangArr[10];
$momn_lv0023->ArrFunc[9]=$vLangArr[12];
$momn_lv0023->ArrFunc[10]=$vLangArr[0];
$momn_lv0023->ArrFunc[11]=$vLangArr[34];
$momn_lv0023->ArrFunc[12]=$vLangArr[35];
$momn_lv0023->ArrFunc[13]=$vLangArr[36];
$momn_lv0023->ArrFunc[14]=$vLangArr[37];
$momn_lv0023->ArrFunc[15]=$vLangArr[38];

////Other
$momn_lv0023->ArrOther[1]=$vLangArr[32];
$momn_lv0023->ArrOther[2]=$vLangArr[33];
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
$momn_lv0023->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0023');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0023->lv002=base64_decode( $_GET['ID']);
$vFieldList=$momn_lv0023->ListView;
$curPage = $momn_lv0023->CurPage;
$maxRows =$momn_lv0023->MaxRows;
$vOrderList=$momn_lv0023->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$momn_lv0023->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($momn_lv0023->GetView()==1)
{
?>

						<?php echo $momn_lv0023->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
