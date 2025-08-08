<?php
session_start();
exit();
header('Content-type: application/xml');
header('Content-Disposition: attachment; filename="master.xml"');
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0020.php");
/////////////init object//////////////
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$mohr_lv0020->lang=strtoupper($plang);
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$mohr_lv0020->ListEmp=$_GET['Emp'];
$vStrMessage="";

$mohr_lv0020->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0020');
$vFieldList=$mohr_lv0020->ListView;
$curPage = $mohr_lv0020->CurPage;
$maxRows =$mohr_lv0020->MaxRows;
$vOrderList=$mohr_lv0020->ListOrder;
$vSortNum=$mohr_lv0020->SortNum;
if($maxRows ==0) $maxRows = 10;
if($mohr_lv0020->GetApr()==0)  $mohr_lv0020->lv029=$mohr_lv0020->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$totalRowsC=$mohr_lv0020->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<?php
if($mohr_lv0020->GetView()==1)
{
	echo $mohr_lv0020->LV_BuilListXML($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
} else {
	include("../permit.php");
}
?>
