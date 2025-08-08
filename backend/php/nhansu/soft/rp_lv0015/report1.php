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
require_once("../../clsall/tc_lv0013.php");
require_once("../../clsall/rp_lv0015.php");
/////////////init object//////////////
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$morp_lv0015=new  rp_lv0015($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0015');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0036.txt",$plang);
$morp_lv0015->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0015->ArrPush[0]=$vLangArr[16];
$morp_lv0015->ArrPush[1]=$vLangArr[18];
$morp_lv0015->ArrPush[2]=$vLangArr[20];
$morp_lv0015->ArrPush[3]=$vLangArr[21];
$morp_lv0015->ArrPush[4]=$vLangArr[22];
$morp_lv0015->ArrPush[5]=$vLangArr[23];
$morp_lv0015->ArrPush[6]=$vLangArr[24];
$morp_lv0015->ArrPush[7]=$vLangArr[25];
$morp_lv0015->ArrPush[8]=$vLangArr[26];
$morp_lv0015->ArrPush[9]=$vLangArr[27];
$morp_lv0015->ArrPush[10]=$vLangArr[28];
$morp_lv0015->ArrPush[11]=$vLangArr[40];
$morp_lv0015->ArrPush[12]=$vLangArr[41];

$morp_lv0015->ArrPush[99]='Tổng:';

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
$morp_lv0015->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0015');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0015->lv002=base64_decode( $_GET['ID']);
$vFieldList=$morp_lv0015->ListView;
$curPage = $morp_lv0015->CurPage;
$maxRows =$morp_lv0015->MaxRows;
$vOrderList=$morp_lv0015->ListOrder;
$vSortNum=$morp_lv0015->SortNum;

//////////////////////////////////////////////////////////////////////////////////////////////////////
$curPage = $morp_lv0015->CurPage;
$maxRows =$morp_lv0015->MaxRows;
$vCalArrID=explode("@",$_GET['txtlv001']);
$vCalID=$vCalArrID[0];
$morp_lv0015->lv053=$vCalID;
$morp_lv0015->lv201=$_GET['txtlv002'];
$morp_lv0015->lv202=$_GET['txtlv003'];
$morp_lv0015->lv203=$_GET['txtlv004'];
$motc_lv0013->LV_LoadID($morp_lv0015->lv053);
if($maxRows ==0) $maxRows = 100000000;

$totalRowsC=$morp_lv0015->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<?php
if($morp_lv0015->GetRpt()==1)
{
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	<tr>
		<td colspan="4"><div align="center" class=lv0><?php echo ($morp_lv0015->ArrPush[0]);?></div></td>
	</tr>
	<tr>
	  <td colspan="4" align="center"><strong><?php echo $vLangArr[38];?>: <?php echo Fillnum($motc_lv0013->lv006,2);?>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $vLangArr[39];?>: <?php echo $motc_lv0013->lv007;?></strong></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td></td>
	  <td></td>
  </tr>
</table>
<?php
						echo $morp_lv0015->LV_BuilListReport_Option($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
						
						?>
					
<?php
} else {
	include("../permit.php");
}
?>
