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
require_once("../../clsall/tc_lv0027.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/rp_lv0004.php");
/////////////init object//////////////
$morp_lv0004=new rp_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0004');
$motc_lv0027=new tc_lv0027($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0027');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0052.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0027->ArrPush[0]=$vLangArr[17];
$motc_lv0027->ArrPush[1]=$vLangArr[18];
$motc_lv0027->ArrPush[2]=$vLangArr[20];
$motc_lv0027->ArrPush[3]=$vLangArr[21];
$motc_lv0027->ArrPush[4]=$vLangArr[22];
$motc_lv0027->ArrPush[5]=$vLangArr[23];
$motc_lv0027->ArrPush[6]=$vLangArr[24];
$motc_lv0027->ArrPush[7]=$vLangArr[25];
$motc_lv0027->ArrPush[8]=$vLangArr[26];
$motc_lv0027->ArrPush[9]=$vLangArr[27];
$motc_lv0027->ArrPush[10]=$vLangArr[28];
$motc_lv0027->ArrPush[11]=$vLangArr[29];
$motc_lv0027->ArrPush[12]=$vLangArr[37];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
//$ma=$_GET['ma'];
$lvopt=$_GET['txtopt'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0027->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0027');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0027->lv004=trim(str_replace("/","-",$_GET['txtlv005']));
$motc_lv0027->lv028=trim($_GET['txtlv003']);
$motc_lv0027->lv029=trim($_GET['txtlv002']);
$motc_lv0027->lv030=trim($_GET['txtlv004']);
$motc_lv0027->lv007=trim($_GET['txtlv006']);
$year=getyear($motc_lv0027->lv004);
$month=getmonth($motc_lv0027->lv004);
if($_GET['txtlv004']!="") $mohr_lv0020->LV_LoadID($_GET['txtlv004']);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0027->ListView;
$curPage = $motc_lv0027->CurPage;
$maxRows =$motc_lv0027->MaxRows;
$vOrderList=$motc_lv0027->ListOrder;
$vSortNum=$motc_lv0027->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0027->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<?php
if($morp_lv0004->GetView()==1)
{
	if(trim($mohr_lv0020->lv001)!="" && $mohr_lv0020->lv001!=NULL)
	{
	$vFieldList="lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
		$motc_lv0009->LV_LoadMonthID($mohr_lv0020->lv001,$month,$year);
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
  <td width="14%"><?php echo $vLangArr[46];?></td>
  <td width="32%"><?php echo $month;?></td>
  <td width="15%"><?php echo $vLangArr[47];?></td>
  <td width="23%"><?php echo $year;?></td>
  </tr>
<tr>
  <td><?php echo $vLangArr[41];?></td>
  <td><?php echo $mohr_lv0020->lv001;?></td>
  <td><?php echo $vLangArr[42];?></td>
  <td><?php echo $mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002;?></td>
  </tr>
<tr>
  <td><?php echo $vLangArr[43];?></td>
  <td><?php echo $mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029);?></td>
  <td><?php echo $vLangArr[44];?></td>
  <td><?php echo $mohr_lv0020->FormatView($mohr_lv0020->lv015,2);?></td>
  </tr>
</table>
				<?php 
	}
	else
	{
	echo "<h1>".$vLangArr[45]."</h1>";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	}
				echo $motc_lv0027->LV_BuilListReportOtherPrint($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt);
    if(trim($mohr_lv0020->lv001)!="" && $mohr_lv0020->lv001!=NULL)
	{
		if($year=="" && $month=="")
		{
			$lvNow=GetServerDate();
			$lvyear=getyear($lvNow);
			$lvmonth=getmonth($lvNow);
			echo $motc_lv0027->GetTimeCode($mohr_lv0020->lv001,"2000-01-01",$lvyear."-".$lvmonth."-".GetDayInMonth((int)$lvyear,(int)$lvmonth),'1');
		}
		else
    		echo $motc_lv0027->GetTimeCode($mohr_lv0020->lv001,$year."-".$month."-01",$year."-".$month."-".GetDayInMonth((int)$year,(int)$month),'1');
    }            
                
?>					
<?php
} else {
	include("../permit.php");
}
?>
