<?php
session_start();
$sExport=$_GET['childdetailfunc'];
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
require_once("../../clsall/cr_lv0146.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/tc_lv0008.php");
require_once("../../clsall/hr_lv0020.php");


/////////////init object//////////////
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
$mocr_lv0146=new cr_lv0146($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0146');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("../../","TC0027.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0008->ArrPush[0]='';
$motc_lv0008->ArrPush[1]=$vLangArr[18];
$motc_lv0008->ArrPush[2]=$vLangArr[20];
$motc_lv0008->ArrPush[3]=$vLangArr[21];
$motc_lv0008->ArrPush[4]=$vLangArr[22];
$motc_lv0008->ArrPush[5]=$vLangArr[23];
$motc_lv0008->ArrPush[6]=$vLangArr[24];
$motc_lv0008->ArrPush[7]=$vLangArr[25];
$motc_lv0008->ArrPush[8]=$vLangArr[26];
$motc_lv0008->ArrPush[9]=$vLangArr[36];
$motc_lv0008->ArrPush[10]=$vLangArr[37];
$motc_lv0008->ArrPush[11]=$vLangArr[38];
$motc_lv0008->ArrPush[12]=$vLangArr[39];
$motc_lv0008->ArrPush[13]=$vLangArr[40];
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0022.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0146->ArrPush[0]=$vLangArr[17];
$mocr_lv0146->ArrPush[1]=$vLangArr[18];
$mocr_lv0146->ArrPush[2]=$vLangArr[20];
$mocr_lv0146->ArrPush[3]=$vLangArr[21];
$mocr_lv0146->ArrPush[4]=$vLangArr[22];
$mocr_lv0146->ArrPush[5]=$vLangArr[23];
$mocr_lv0146->ArrPush[6]=$vLangArr[24];
$mocr_lv0146->ArrPush[7]=$vLangArr[25];
$mocr_lv0146->ArrPush[8]=$vLangArr[26];
$mocr_lv0146->ArrPush[9]=$vLangArr[27];
$mocr_lv0146->ArrPush[10]=$vLangArr[28];
$mocr_lv0146->ArrPush[11]=$vLangArr[29];
$mocr_lv0146->ArrPush[12]=$vLangArr[43];
$mocr_lv0146->ArrPush[13]=$vLangArr[37];
$mocr_lv0146->ArrPush[14]=$vLangArr[51];
$mocr_lv0146->ArrPush[15]=$vLangArr[49];
$mocr_lv0146->ArrPush[16]=$vLangArr[50];
$mocr_lv0146->ArrPush[17]=$vLangArr[51];
$mocr_lv0146->ArrPush[18]=$vLangArr[52];
$mocr_lv0146->ArrPush[19]=$vLangArr[53];
$mocr_lv0146->ArrPush[20]=$vLangArr[54];
$mocr_lv0146->ArrPush[21]=$vLangArr[55];
$mocr_lv0146->ArrPush[100]=$vLangArr[56];
$mocr_lv0146->ArrPush[101]=$vLangArr[57];

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


//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0146->lv002=base64_decode($_GET['ChildID']);
$mocr_lv0146->lvNVID=$_GET['NVID'];
$mocr_lv0146->lv004=$_GET['YearMonth'];
$mohr_lv0020->LV_LoadID($mocr_lv0146->lvNVID);
$month=substr($_GET['YearMonth'],5,2);
$year=substr($_GET['YearMonth'],0,4);
$motc_lv0008->lv002=$_GET['NVID'];
$motc_lv0008->lv005=$year;
$motc_lv0009->LV_LoadMonthID($mocr_lv0146->lvNVID,$month,$year);


if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mocr_lv0146->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mocr_lv0146->GetView()==1)
{
?>
<table cellpadding="0" cellspacing="0" border="0" width="101%">
<tr>
						<td  colspan="5" rowspan="2">&nbsp;</td>
						<td width="1" align="right" valign="top"><?php echo ($motc_lv0009->lv005==1)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mohr_lv0020->lv001."_".$motc_lv0009->lv001."'>":"";?></td>
  </tr>
<tr>
  <td align="right" valign="top">&nbsp;</td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" border="1" width="101%">
<tr>
  <td colspan="4"><h1><?php echo $vLangArr[45];?></h1></td>
  <td width="23%" rowspan="4"><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="90px" height="100px" 
								src="<?php echo "../../images/employees/".$mohr_lv0020->lv001."/".$mohr_lv0020->lv007; ?>" /></td>
</tr>
<tr>
  <td width="20%"><?php echo $vLangArr[41].":".$mohr_lv0020->lv001;?></td>
   <td width="35%"><?php echo $vLangArr[42].":".$mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002;?></td>
  <td width="19%"><?php echo $vLangArr[46].":".$month."/".$year;?></td>
  <td rowspan="2"><?php echo "Xếp loại".":".$motc_lv0009->getvaluelink('lv008',$motc_lv0009->lv008);?></td>
  </tr>
<tr>
  <td><?php echo $vLangArr[43].":".$mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029);?></td>
  <td><?php echo $vLangArr[44].":".$mohr_lv0020->FormatView($mohr_lv0020->lv015,2);?></td>
  <td><?php echo "Hệ số lương".":".$motc_lv0009->lv007;?></td>
  </tr>
<tr>
	<td colspan="4"><?php 
	
	$motc_lv0008->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0008');
				$vFieldList=$motc_lv0008->ListView;
				$curPage = $motc_lv0008->CurPage;
				$maxRows =$motc_lv0008->MaxRows;
				$vOrderList=$motc_lv0008->ListOrder;
	echo $motc_lv0008->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?></td>
</tr>  
</table>
				<?php 
				$mocr_lv0146->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0146');
				$vFieldList=$mocr_lv0146->ListView;
				$curPage = $mocr_lv0146->CurPage;
				$maxRows =$mocr_lv0146->MaxRows;
				$vOrderList=$mocr_lv0146->ListOrder;
				echo $mocr_lv0146->LV_BuilListReportEmp($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
				 <?php 
					echo $mocr_lv0146->GetTimeCodeMore($mocr_lv0146->lvNVID,$year,$month);
						//echo $mocr_lv0146->GetTimeCode($mocr_lv0146->lvNVID,$year."-".$month."-01",$year."-".$month."-".GetDayInMonth((int)$year,(int)$month),'1');?>
					
<?php
} else {
	include("../cr_lv0146/permit.php");
}
?>
