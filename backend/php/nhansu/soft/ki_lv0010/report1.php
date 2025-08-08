<?php
session_start();
$sExport=$_GET['func'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=timecard.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=timecard.doc');
}
if($sExport=="pdf"){
header('Content-Type: text/html; charset=utf-8');}

//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="timecard.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ki_lv0010.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/hr_lv0038.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/tc_lv0002.php");
require_once("../../clsall/tc_lv0004.php");
require_once("../../clsall/hr_lv0002.php");
require_once("../../clsall/tc_lv0013.php");
/////////////init object//////////////
$moki_lv0010=new ki_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0010');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0002');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
$moki_lv0010->ArrDep=$mohr_lv0002->LV_LoadArray();
$moki_lv0010->ArrShift=$motc_lv0004->LV_LoadArray();
$moki_lv0010->mohr_lv0020=$mohr_lv0020;
$moki_lv0010->mohr_lv0038=$mohr_lv0038;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0052.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0010->ArrPush[0]=$vLangArr[17];
$moki_lv0010->ArrPush[1]=$vLangArr[18];
$moki_lv0010->ArrPush[2]=$vLangArr[20];
$moki_lv0010->ArrPush[3]=$vLangArr[21];
$moki_lv0010->ArrPush[4]=$vLangArr[22];
$moki_lv0010->ArrPush[5]=$vLangArr[23];
$moki_lv0010->ArrPush[6]=$vLangArr[24];
$moki_lv0010->ArrPush[7]=$vLangArr[25];
$moki_lv0010->ArrPush[8]=$vLangArr[26];
$moki_lv0010->ArrPush[9]=$vLangArr[27];
$moki_lv0010->ArrPush[10]=$vLangArr[28];
$moki_lv0010->ArrPush[11]=$vLangArr[29];
$moki_lv0010->ArrPush[12]=$vLangArr[37];
$moki_lv0010->ArrPush[13]=$vLangArr[48];
$moki_lv0010->ArrPush[14]=$vLangArr[43];
$moki_lv0010->ArrPush[15]=$vLangArr[41];
$moki_lv0010->ArrPush[16]=$vLangArr[42];
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
$moki_lv0010->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0010');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0010->lv028=trim($_GET['txtlv003']);
$moki_lv0010->lv029=trim($_GET['txtlv002']);
if($moki_lv0010->lv029=="")
{
	if($moki_lv0010->GetApr()==0)	$moki_lv0010->lv029=$moki_lv0010->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
}

$moki_lv0010->CalID=trim($_GET['txtlv001']);
$motc_lv0013->LV_LoadID($moki_lv0010->CalID);
$moki_lv0010->ObjCal=$motc_lv0013;
$moki_lv0010->lv030=trim($_GET['txtlv004']);
$moki_lv0010->lv007=trim($_GET['txtlv006']);
$moki_lv0010->paratimecard=trim($_GET['txtlv020']);
$moki_lv0010->lvState=(int)($_GET['txtlv021']);
$moki_lv0010->lvSort=(int)($_GET['txtlv022']);
$moki_lv0010->isStaffOff=$_GET['isStaffOff'];
$moki_lv0010->isDeptCurrent=$_GET['isDeptCurrent'];
$vlv221=(int)$_GET['txtlv221'];
if($vlv221==2) $moki_lv0010->isType=1;
$vlv222=(int)$_GET['txtlv222'];
$isshift=(int)$_GET['txtisshift'];
$moki_lv0010->isChildCheck=(int)$_GET['isChildCheck'];
$moki_lv0010->datefrom=recoverdate($_GET['txtdatefrom'],$plang);
$moki_lv0010->dateto=recoverdate($_GET['txtdateto'],$plang);
$year=getyear($moki_lv0010->datefrom);
$month=getmonth($moki_lv0010->datefrom);
if($_GET['txtlv004']!="") $mohr_lv0020->LV_LoadID($_GET['txtlv004']);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moki_lv0010->ListView;
$curPage = $moki_lv0010->CurPage;
$maxRows =$moki_lv0010->MaxRows;
$vOrderList=$moki_lv0010->ListOrder;
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moki_lv0010->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<div>
<style>
table td 
{
	padding:2px;
}
</style>
<?php
if($moki_lv0010->GetView()==1)
{
//if($vlv221==1)
{
	echo "<center><div style='width:880px'>";
	/*echo "<center><div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$moki_lv0010->FormatView($moki_lv0010->datefrom,2)." to ".$moki_lv0010->FormatView($moki_lv0010->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div></center>";*/
	echo '<table border="0" cellspacing="0" align="center" style="width:880px;">
	<tbody>
		<tr>
			<td align="left" colspan="7" valign="middle"><h3> <div onclick="this.innerHTML=\'CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG\'">CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG</div></h3></td>
		</tr>
		<tr>
			<td align="left" colspan="7" valign="middle"><font>Địa chỉ : '.$moki_lv0010->GetAddress().'</font></td>
		</tr>
		<tr>
			<td align="left" colspan="7" valign="middle"><font>Số điện thoại: '.$moki_lv0010->GetPhone().'</font></td>
		</tr>
		<tr>
			<td align="left" height="18"><font><br />
				</font></td>
			<td align="left"><font><br />
				</font></td>
			<td align="center"><font><br />
				</font></td>
			<td align="right" sdnum="1033;0;@"><font><br />
				</font></td>
			<td align="right" sdnum="1033;1033;M/D/YYYY" valign="middle"><font><br />
				</font></td>
			<td align="right" sdnum="1033;1033;M/D/YYYY" valign="middle"><font><br />
				</font></td>
			<td align="center"><font><br />
				</font></td>
		</tr>
		<tr>
			<td align="center" colspan="7" height="43" valign="middle"><b><font color="#000000" size="4">';
	if($vlv221==1)
		echo 'TỔNG HỢP KPI NHÂN VIÊN NĂM '.($motc_lv0013->lv007).'</font></b>';
	else		
		echo '		DANH SÁCH KPI NHÂN VIÊN TH&Aacute;NG '.Fillnum($motc_lv0013->lv006,2).'  NĂM '.($motc_lv0013->lv007).'</font></b>';
	echo '
	</td>
		</tr>
		
	</tbody>
</table>';
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
	switch($vlv221)
	{
		case 1:
			echo $moki_lv0010->LV_BuilListReportOtherPrintLateSoonSum($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$isshift);
			break;
		default:
			echo $moki_lv0010->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$isshift);
			break;
	}
				
	
}
?>
<table style="width: 800px;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr height="36">
<td width="100">&nbsp;</td>
<td width="200" height="36">&nbsp;</td>
<td width="200">&nbsp;</td>
<td width="200">&nbsp;</td>
<td width="60">&nbsp;</td>
</tr>
<tr><td colspan="5" align="right"><span style="font-size: small;"><input type="text" value="TP.HCM ngày <?php echo getday($moki_lv0010->DateCurrent);?> tháng <?php echo getmonth($moki_lv0010->DateCurrent);?> năm <?php echo getyear($moki_lv0010->DateCurrent);?>" style="border:0px #fff solid;width:100%;text-align:right;"/></td></tr>
<tr height="27">
<td>&nbsp;</td>
<td  height="27" align="center"><strong>Người lập biểu</strong></td>
<td>&nbsp;</td>
<td align="center"><strong>Người duyệt</strong></td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td height="27">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td height="27">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td height="27">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td>&nbsp;</td>
<td colspan="1" height="27" align="center">............................................................</td>
<td>&nbsp;</td>
<td  align="center">............................................................</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>							
<?php
echo "</div>
	</center>
	";
/*else
{
	echo "<center><div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$moki_lv0010->FormatView($moki_lv0010->datefrom,2)." to ".$moki_lv0010->FormatView($moki_lv0010->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div></center>";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $moki_lv0010->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$isshift);
   
?>	
</div>

</div>		
<?php
}
*/
} else {
	include("../permit.php");
}
?>
