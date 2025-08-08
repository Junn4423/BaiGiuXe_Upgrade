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
require_once("../../clsall/tc_lv0026.php");
require_once("../../clsall/tc_lv0013.php");
require_once("../../clsall/rp_lv0012.php");
/////////////init object//////////////
$motc_lv0026=new tc_lv0026($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0012');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$morp_lv0012=new  rp_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0012');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0042.txt",$plang);
$motc_lv0026->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0026->ArrPush[0]=$vLangArr[17];
$motc_lv0026->ArrPush[1]=$vLangArr[18];
$motc_lv0026->ArrPush[2]=$vLangArr[20];
$motc_lv0026->ArrPush[3]=$vLangArr[21];
$motc_lv0026->ArrPush[4]=$vLangArr[22];
$motc_lv0026->ArrPush[5]=$vLangArr[23];
$motc_lv0026->ArrPush[6]=$vLangArr[24];
$motc_lv0026->ArrPush[7]=$vLangArr[25];
$motc_lv0026->ArrPush[8]=$vLangArr[26];
$motc_lv0026->ArrPush[9]=$vLangArr[27];
$motc_lv0026->ArrPush[10]=$vLangArr[28];
$motc_lv0026->ArrPush[11]=$vLangArr[29];
$motc_lv0026->ArrPush[12]=$vLangArr[30];
$motc_lv0026->ArrPush[13]=$vLangArr[39];
$motc_lv0026->ArrPush[14]=$vLangArr[38];

//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$lvopt=(int)$_GET['txtopt'];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;

$vStrMessage="";
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0012->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0012');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0012->lv002=base64_decode( $_GET['ID']);
$vFieldList=$morp_lv0012->ListView;
$curPage = $morp_lv0012->CurPage;
$maxRows =$morp_lv0012->MaxRows;
$vOrderList=$morp_lv0012->ListOrder;
$vSortNum=$morp_lv0012->SortNum;

//////////////////////////////////////////////////////////////////////////////////////////////////////
$curPage = $motc_lv0026->CurPage;
$maxRows =$motc_lv0026->MaxRows;
$vCalArrID=explode("@",$_GET['txtlv001']);
$vCalID=$vCalArrID[0];
$motc_lv0026->lv003=$vCalID;
$motc_lv0026->days=$_GET['txtlv001_month'];
$motc_lv0026->lv012=$_GET['txtlv002'];
$motc_lv0026->lv202=$_GET['txtlv003'];
$motc_lv0013->LV_LoadID($motc_lv0026->lv003);
if($motc_lv0026->days=="")
{
	$motc_lv0026->datefrom=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-01";
	$motc_lv0026->dateto=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-".Fillnum(GetDayInMonth($motc_lv0013->lv007,$motc_lv0013->lv006),2);
}
else
{
	$motc_lv0026->datefrom=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-".Fillnum($motc_lv0026->days,2);
	$motc_lv0026->dateto=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->days,2)."-".Fillnum($motc_lv0026->days,2);
}
if($maxRows ==0) $maxRows = 100000000;

$totalRowsC=$motc_lv0026->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<?php
if($morp_lv0012->GetRpt()==1)
{
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	<tr>
		<td colspan="4"><div align="center" class=lv0><?php echo ($motc_lv0026->ArrPush[0]);?></div></td>
	</tr>
	<tr>
	  <td colspan="4" align="center">
	  <?php if($motc_lv0026->days>0)
	  {
	  ?>
		<?php echo "Ngày:";?>:<?php echo $motc_lv0013->FormatView($motc_lv0013->lv007."-".fillNum($motc_lv0013->lv006,2)."-".fillNum($motc_lv0026->days,2),2);?>
	  <?php
	  }
	  else
	  {
	  ?>
	  <?php echo "Từ ngày";?>:<?php echo $motc_lv0013->FormatView($motc_lv0013->lv004,2);?> <?php echo "Đến ngày: ";?> <?php echo $motc_lv0013->FormatView($motc_lv0013->lv005,2);?>
	  <?php
	  }
	  ?>
	  </td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td></td>
	  <td></td>
  </tr>
</table>
<?php 
if($_GET['txtopt']==0)
echo $motc_lv0026->LV_BuilListReportPrudctListDays($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
else
echo $motc_lv0026->LV_BuilListReportOtherGroup($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
?>
<?php
} else {
	include("../permit.php");
}
?>
