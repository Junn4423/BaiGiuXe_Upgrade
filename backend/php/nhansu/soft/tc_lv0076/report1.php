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
require_once("../../clsall/tc_lv0076.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/hr_lv0038.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/tc_lv0002.php");
require_once("../../clsall/tc_lv0004.php");
require_once("../../clsall/hr_lv0002.php");
require_once("../../clsall/tc_lv0061.php");
require_once("../../clsall/tc_lv0013.php");
/////////////init object//////////////
$motc_lv0076=new tc_lv0076($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0076');
$motc_lv0061=new tc_lv0061($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0061');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0002');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
$motc_lv0076->ArrDep=$mohr_lv0002->LV_LoadArray();
$motc_lv0076->ArrShift=$motc_lv0004->LV_LoadArray();
$motc_lv0076->mohr_lv0020=$mohr_lv0020;
$motc_lv0076->mohr_lv0038=$mohr_lv0038;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0052.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0076->ArrPush[0]=$vLangArr[17];
$motc_lv0076->ArrPush[1]=$vLangArr[18];
$motc_lv0076->ArrPush[2]=$vLangArr[20];
$motc_lv0076->ArrPush[3]=$vLangArr[21];
$motc_lv0076->ArrPush[4]=$vLangArr[22];
$motc_lv0076->ArrPush[5]=$vLangArr[23];
$motc_lv0076->ArrPush[6]=$vLangArr[24];
$motc_lv0076->ArrPush[7]=$vLangArr[25];
$motc_lv0076->ArrPush[8]=$vLangArr[26];
$motc_lv0076->ArrPush[9]=$vLangArr[27];
$motc_lv0076->ArrPush[10]=$vLangArr[28];
$motc_lv0076->ArrPush[11]=$vLangArr[29];
$motc_lv0076->ArrPush[12]=$vLangArr[37];
$motc_lv0076->ArrPush[13]=$vLangArr[48];
$motc_lv0076->ArrPush[14]=$vLangArr[43];
$motc_lv0076->ArrPush[15]=$vLangArr[41];
$motc_lv0076->ArrPush[16]=$vLangArr[42];
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
$motc_lv0076->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0076');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0076->lv028=trim($_GET['txtlv003']);
$motc_lv0076->lv029=trim($_GET['txtlv002']);
if($motc_lv0076->lv029=="")
{
	if($motc_lv0076->GetApr()==0)	$motc_lv0076->lv029=$motc_lv0076->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
}

$motc_lv0076->CalID=trim($_GET['txtlv001']);
$motc_lv0061->LV_LoadID($motc_lv0076->CalID);
$motc_lv0013->LV_LoadActiveIDMonth((int)getmonth($motc_lv0061->lv003),getyear($motc_lv0061->lv003));
$motc_lv0076->ObjCal=$motc_lv0013;
$motc_lv0076->lv030=trim($_GET['txtlv004']);
$motc_lv0076->lv007=trim($_GET['txtlv006']);
$motc_lv0076->paratimecard=trim($_GET['txtlv020']);
$motc_lv0076->lvState=(int)($_GET['txtlv021']);
$motc_lv0076->lvSort=(int)($_GET['txtlv022']);
$motc_lv0076->isStaffOff=$_GET['isStaffOff'];
$motc_lv0076->isDeptCurrent=$_GET['isDeptCurrent'];
$vlv221=(int)$_GET['txtlv221'];
if($vlv221==2) $motc_lv0076->isType=1;
$vlv222=(int)$_GET['txtlv222'];
$isshift=(int)$_GET['txtisshift'];
$motc_lv0076->isChildCheck=(int)$_GET['isChildCheck'];
$motc_lv0076->datefrom=recoverdate($_GET['txtdatefrom'],$plang);
$motc_lv0076->dateto=recoverdate($_GET['txtdateto'],$plang);
$year=getyear($motc_lv0076->datefrom);
$month=getmonth($motc_lv0076->datefrom);
if($_GET['txtlv004']!="") $mohr_lv0020->LV_LoadID($_GET['txtlv004']);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0076->ListView;
$curPage = $motc_lv0076->CurPage;
$maxRows =$motc_lv0076->MaxRows;
$vOrderList=$motc_lv0076->ListOrder;
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0076->GetCount();
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
if($motc_lv0076->GetView()==1)
{
//if($vlv221==1)
{
	echo "<center><div style='width:880px'>";
	/*echo "<center><div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$motc_lv0076->FormatView($motc_lv0076->datefrom,2)." to ".$motc_lv0076->FormatView($motc_lv0076->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div></center>";*/
	echo '<table border="0" cellspacing="0" align="center" style="width:880px;">
	<tbody>
		<tr>
			<td align="left" colspan="7" valign="middle"><h3> <div onclick="this.innerHTML=\'CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG\'">CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG</div></h3></td>
		</tr>
		<tr>
			<td align="left" colspan="7" valign="middle"><font>Địa chỉ : '.$motc_lv0076->GetAddress().'</font></td>
		</tr>
		<tr>
			<td align="left" colspan="7" valign="middle"><font>Số điện thoại: '.$motc_lv0076->GetPhone().' Fax: '.$motc_lv0076->GetFax().'</font></td>
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
			<td align="center" colspan="7" height="43" valign="middle"><b><font color="#000000" size="4">DANH SÁCH ĐÁNH GIÁ NHÂN VIÊN TH&Aacute;NG '.$motc_lv0076->FormatView($motc_lv0061->lv003,2).'  - Ng&agrave;y '.$motc_lv0076->FormatView($motc_lv0061->lv004,2).'</font></b></td>
		</tr>
		
	</tbody>
</table>';
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $motc_lv0076->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$isshift);
	
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
<tr><td colspan="5" align="right"><span style="font-size: small;"><input type="text" value="TP.HCM ngày <?php echo getday($motc_lv0076->DateCurrent);?> tháng <?php echo getmonth($motc_lv0076->DateCurrent);?> năm <?php echo getyear($motc_lv0076->DateCurrent);?>" style="border:0px #fff solid;width:100%;text-align:right;"/></td></tr>
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
		<div style='text-align:center'><strong>Date From ".$motc_lv0076->FormatView($motc_lv0076->datefrom,2)." to ".$motc_lv0076->FormatView($motc_lv0076->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div></center>";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $motc_lv0076->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$isshift);
   
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
