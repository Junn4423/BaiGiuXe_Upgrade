<?php
session_start();
$sExport=$_GET['funcexp'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=luongchinh_vp.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=luongchinh_vp.doc');
}
if($sExport=="pdf"){
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="luongchinh_vp.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0020.php");
require_once("../../clsall/tc_lv0013.php");
require_once("../../clsall/rp_lv0002.php");
/////////////init object//////////////
$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0002');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$morp_lv0002=new  rp_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($morp_lv0002->GetAdd()==1)
{
	if(isset($_GET['ajaxprint']))
	{
		echo '[CHECK]';
			echo $morp_lv0002->LV_DemSoLanIn($_SESSION['ERPSOFV2RUserID'],$_GET['CalID'],$vDept);
		echo '[ENDCHECK]';
		exit;
	}
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0038.txt","VN");
$motc_lv0020->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0020->ArrPush[0]=$vLangArr[17];
$motc_lv0020->ArrPush[1]=$vLangArr[18];
$motc_lv0020->ArrPush[2]=$vLangArr[19];
$motc_lv0020->ArrPush[3]=$vLangArr[20];
$motc_lv0020->ArrPush[4]=$vLangArr[21];
$motc_lv0020->ArrPush[5]=$vLangArr[22];
$motc_lv0020->ArrPush[6]=$vLangArr[23];
$motc_lv0020->ArrPush[7]=$vLangArr[24];
$motc_lv0020->ArrPush[8]=$vLangArr[25];
$motc_lv0020->ArrPush[9]=$vLangArr[26];
$motc_lv0020->ArrPush[10]=$vLangArr[27];
$motc_lv0020->ArrPush[11]=$vLangArr[28];
$motc_lv0020->ArrPush[12]=$vLangArr[29];
$motc_lv0020->ArrPush[13]=$vLangArr[30];
$motc_lv0020->ArrPush[14]=$vLangArr[31];
$motc_lv0020->ArrPush[15]=$vLangArr[32];
$motc_lv0020->ArrPush[16]=$vLangArr[33];
$motc_lv0020->ArrPush[17]=$vLangArr[34];
$motc_lv0020->ArrPush[18]=$vLangArr[35];
$motc_lv0020->ArrPush[19]=$vLangArr[36];
$motc_lv0020->ArrPush[20]=$vLangArr[37];
$motc_lv0020->ArrPush[21]=$vLangArr[38];
$motc_lv0020->ArrPush[22]=$vLangArr[39];
$motc_lv0020->ArrPush[23]=$vLangArr[40];
$motc_lv0020->ArrPush[24]=$vLangArr[41];
$motc_lv0020->ArrPush[25]=$vLangArr[42];
$motc_lv0020->ArrPush[26]=$vLangArr[43];
$motc_lv0020->ArrPush[27]=$vLangArr[44];
$motc_lv0020->ArrPush[28]=$vLangArr[45];
$motc_lv0020->ArrPush[29]=$vLangArr[46];
$motc_lv0020->ArrPush[30]=$vLangArr[47];
$motc_lv0020->ArrPush[31]=$vLangArr[48];
$motc_lv0020->ArrPush[32]=$vLangArr[49];
$motc_lv0020->ArrPush[33]=$vLangArr[50];
$motc_lv0020->ArrPush[34]=$vLangArr[51];
$motc_lv0020->ArrPush[35]=$vLangArr[52];
$motc_lv0020->ArrPush[36]=$vLangArr[53];
$motc_lv0020->ArrPush[37]=$vLangArr[54];
$motc_lv0020->ArrPush[38]=$vLangArr[55];
$motc_lv0020->ArrPush[39]=$vLangArr[56];
$motc_lv0020->ArrPush[40]=$vLangArr[57];
$motc_lv0020->ArrPush[41]=$vLangArr[58];
$motc_lv0020->ArrPush[42]=$vLangArr[59];
$motc_lv0020->ArrPush[43]=$vLangArr[60];
$motc_lv0020->ArrPush[44]=$vLangArr[61];
$motc_lv0020->ArrPush[45]=$vLangArr[62];
$motc_lv0020->ArrPush[46]=$vLangArr[63];
$motc_lv0020->ArrPush[47]=$vLangArr[64];
$motc_lv0020->ArrPush[48]=$vLangArr[65];
$motc_lv0020->ArrPush[49]=$vLangArr[66];
$motc_lv0020->ArrPush[50]=$vLangArr[67];
$motc_lv0020->ArrPush[51]=$vLangArr[68];
$motc_lv0020->ArrPush[52]=$vLangArr[69];
$motc_lv0020->ArrPush[53]=$vLangArr[70];
$motc_lv0020->ArrPush[54]=$vLangArr[71];
$motc_lv0020->ArrPush[55]=$vLangArr[72];
$motc_lv0020->ArrPush[56]=$vLangArr[73];
$motc_lv0020->ArrPush[57]=$vLangArr[74];
$motc_lv0020->ArrPush[58]=$vLangArr[75];
$motc_lv0020->ArrPush[59]=$vLangArr[76];
$motc_lv0020->ArrPush[60]=$vLangArr[77];
$motc_lv0020->ArrPush[61]=$vLangArr[78];
$motc_lv0020->ArrPush[62]=$vLangArr[79];
$motc_lv0020->ArrPush[63]=$vLangArr[80];
$motc_lv0020->ArrPush[64]=$vLangArr[81];
$motc_lv0020->ArrPush[65]=$vLangArr[82];
$motc_lv0020->ArrPush[66]=$vLangArr[83];
$motc_lv0020->ArrPush[67]=$vLangArr[84];
$motc_lv0020->ArrPush[68]=$vLangArr[85];
$motc_lv0020->ArrPush[69]=$vLangArr[86];
$motc_lv0020->ArrPush[70]=$vLangArr[87];
$motc_lv0020->ArrPush[71]=$vLangArr[88];
$motc_lv0020->ArrPush[72]=$vLangArr[89];
$motc_lv0020->ArrPush[73]=$vLangArr[90];
$motc_lv0020->ArrPush[74]=$vLangArr[91];
$motc_lv0020->ArrPush[75]=$vLangArr[102];
$motc_lv0020->ArrPush[75]=$vLangArr[102];
$motc_lv0020->ArrPush[76]=$vLangArr[104];
$motc_lv0020->ArrPush[77]=$vLangArr[105];
$motc_lv0020->ArrPush[78]=$vLangArr[106];
$motc_lv0020->ArrPush[79]=$vLangArr[107];
$motc_lv0020->ArrPush[80]=$vLangArr[108];
$motc_lv0020->ArrPush[81]=$vLangArr[98];
$motc_lv0020->ArrPush[82]=$vLangArr[99];
$motc_lv0020->ArrPush[91]='Số ngày TC <=4H';
$motc_lv0020->ArrPush[92]='Số ngày TC >4H';
$motc_lv0020->ArrPush[93]='Tiền cơm tăng ca';
$motc_lv0020->ArrPush[83]=$vLangArr[100];
$motc_lv0020->ArrPush[84]=$vLangArr[101];
$motc_lv0020->ArrPush[85]=$vLangArr[102];
$motc_lv0020->ArrPush[86]=$vLangArr[103];
$motc_lv0020->ArrPush[87]=$vLangArr[104];
$motc_lv0020->ArrPush[88]=$vLangArr[105];
$motc_lv0020->ArrPush[89]=$vLangArr[106];
$motc_lv0020->ArrPush[90]=$vLangArr[107];
$motc_lv0020->ArrPush[91]=$vLangArr[108];
$motc_lv0020->ArrPush[92]=$vLangArr[109];
$motc_lv0020->ArrPush[93]=$vLangArr[110];
$motc_lv0020->ArrPush[94]=$vLangArr[111];
$motc_lv0020->ArrPush[95]=$vLangArr[112];
$motc_lv0020->ArrPush[96]=$vLangArr[113];
$motc_lv0020->ArrPush[97]=$vLangArr[114];
$motc_lv0020->ArrPush[98]=$vLangArr[115];
$motc_lv0020->ArrPush[99]=$vLangArr[116];
$motc_lv0020->ArrPush[100]=$vLangArr[117];
$motc_lv0020->ArrPush[101]=$vLangArr[118];
$motc_lv0020->ArrPush[102]=$vLangArr[119];
$motc_lv0020->ArrPush[103]=$vLangArr[130];
$motc_lv0020->ArrPush[104]=$vLangArr[131];

$motc_lv0020->ArrPush[999]=$vLangArr[128];
$motc_lv0020->ArrPush[1000]=$vLangArr[129];


//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$lvopt=(int)$_GET['txtopt'];
$lvmau=(int)$_GET['txttemplate'];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;

$vStrMessage="";
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0002->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0002->lv002=base64_decode( $_GET['ID']);
$vFieldList=$morp_lv0002->ListView;
$curPage = $morp_lv0002->CurPage;
$maxRows =$morp_lv0002->MaxRows;
$vOrderList=$morp_lv0002->ListOrder;
$vSortNum=$morp_lv0002->SortNum;

//////////////////////////////////////////////////////////////////////////////////////////////////////
$curPage = $motc_lv0020->CurPage;
$maxRows =$motc_lv0020->MaxRows;
$vCalArrID=explode("@",$_GET['txtlv001']);
$vCalID=$vCalArrID[0];
$motc_lv0020->lv060=$vCalID;
$motc_lv0020->Bank=(int)$_GET['txtbank'];
$motc_lv0020->lv201=$_GET['txtlv002'];
$motc_lv0020->lv002=$_GET['txtlv004'];
$motc_lv0020->lv202=$_GET['txtlv003'];
$motc_lv0020->lv839=$_GET['txtlv839'];
$motc_lv0020->optbh=$_GET['txtoptbh'];
$motc_lv0020->ismau=$_GET['txtsort'];
$motc_lv0020->isBrand=$_GET['isBrand'];
$motc_lv0020->isABC=(int)$_GET['txtABC'];
$motc_lv0020->isBrand=$_GET['isBrand'];
$motc_lv0013->LV_LoadID($motc_lv0020->lv060);
$motc_lv0020->isNghi=(int)$_GET['txtnghiviec'];
$motc_lv0020->isViet=(int)$_GET['txtisViet'];
$motc_lv0020->isChildCheck=(int)$_GET['isChildCheck'];
$motc_lv0020->isHDCheck=(int)$_GET['isHDCheck'];

$motc_lv0020->CalMonth=$motc_lv0013->lv006;
$motc_lv0020->CalYear=$motc_lv0013->lv007;
if($maxRows ==0) $maxRows = 100000000;

$totalRowsC=$motc_lv0020->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if ($sExport == "excel") {
}
else
{
	
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<?php
}
?>
<center>
<?php
if($morp_lv0002->GetRpt()==1)
{
?>
<script language="javascript">
<!--
function Show_CC_Title(Stt)
{
	if(document.getElementById('CC_Title_'+Stt).innerHTML=='')
	{
		document.getElementById('CC_Title_'+Stt).innerHTML=document.getElementById('CC_Title').innerHTML;
		document.getElementById('CCC_Title_'+Stt).innerHTML=document.getElementById('CCC_Title').innerHTML;
	}
	else
	{
		document.getElementById('CC_Title_'+Stt).innerHTML='';
		document.getElementById('CCC_Title_'+Stt).innerHTML='';
	}
	
}
function printWindowTimes(vDir){//hidden images
	var div=document.getElementById('MenuDiv');
	div.innerHTML="";//Gan du lieu rong vao tag div
	var solanin=document.getElementById('solanin');
	solanin.innerHTML="Số lần in:1 và giờ in";
	window.print();
	setTimeout('reloadImage(\''+vDir+'\')', 5000);
}
function reloadImage(vDir){//reshow images
	var div=document.getElementById('MenuDiv');
	div.innerHTML='<a href=\"javascript:printWindowTimes(\''+vDir+'\');\" style=\"text-decoration:none; color:#888888;\"><img id=\"imgPrint\" name=\"imgPrint\" src=\"'+vDir+'images/iconcontrol/printer.gif\" border=\"0\" align=\"absmiddle\" title=\"Print\"></a>';
}
function RemoveCol(vname,vobj,vcount)
{
	var i=0;
	for(i=1;i<=vcount;i++)
	{
		var myTD=document.getElementById(vname+"_"+i);
		if(myTD!=null) myTD.parentNode.removeChild(myTD);
	}
	for(i=1;i<=vcount;i++)
	{
		var myTD=document.getElementById(vname+"_"+i);
		if(myTD!=null) myTD.parentNode.removeChild(myTD);
	}
	vobj.parentNode.removeChild(vobj);
}
-->
</script>
<style>
table td
{
	padding:1px;
}
</style>
<!--<div id="MenuDiv" style="position: absolute; right: 2px; top: 12px; width: 100px; left: 1322px; visibility: visible;"><a href="javascript:printWindowTimes('../../');" style="text-decoration:none; color:#888888;"><img id="imgPrint" name="imgPrint" src="../../images/iconcontrol/printer.gif" border="0" align="absmiddle" title="Print"></a></div>-->
<table border="0" cellspacing="0" style="width: 800px;">
<tbody>
<tr>
<?php 
if($sExport != "excel")
{
?>
<td colspan="<?php echo  ($sExport == "excel")?'0':'2';?>" rowspan="4" align="center" valign="middle"><strong><span style="font-size: large;"><img ondblclick="this.src='../../logotech.png'" src="../../logo.png" style="height:80px"/></span></strong></td>
<?php
}
?>
<td colspan="<?php echo  ($sExport == "excel")?'5':'3';?>" rowspan="2" align="left" valign="middle" width="500"><strong><span style="font-size: medium;text-align:center"><div ondblclick="this.innerHTML='MINH PHUONG INVESTMENT TECHNOLOGY JSC'">
<?php
if($motc_lv0020->isBrand=='SOF')
echo 'CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG';
else
echo 'CÔNG TY TNHH THIẾT BỊ ĐIỆN MINH PHƯƠNG';
?>
</div></span></strong></td>
</tr>
<tr>
</tr>
<tr>
<td colspan="5" align="center" valign="middle"><strong><span style="font-size: large;font-size:24px">DANH SÁCH ỨNG LƯƠNG THÁNG <?php echo getmonth($motc_lv0013->lv004);?>/<?php echo getyear($motc_lv0013->lv004);?></span></strong></td>
</tr>
<tr>
<td colspan="5" align="center" valign="middle"><span style="font-size: small;"><?php echo $vLangArr[22];?>:<?php echo $motc_lv0013->FormatView($motc_lv0013->lv004,2);?> <?php echo 'đến ngày';?> <?php echo $motc_lv0013->FormatView($motc_lv0013->lv005,2);?></td>
</tr>
</tbody>
</table>

<?php
$vstrReturn= $motc_lv0020->LV_LuongNganHangUngLuongTK2($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum,$motc_lv0013,$motc_lv0020->optbh,$motc_lv0020->ismau);
echo $vstrReturn;
?>
<table  border="0" cellspacing="0" width="800">
<colgroup width="71"></colgroup><colgroup width="316"></colgroup><colgroup width="177"></colgroup><colgroup width="183"></colgroup><colgroup width="316"></colgroup> 
<tbody>
<tr>
<td  height="25" align="left" bgcolor="#FFFFFF"><br /></td>
<td  align="left" bgcolor="#FFFFFF"><br /></td>
<td  align="left" valign="middle" bgcolor="#FFFFFF"><br /></td>
<td  colspan="2" align="center" bgcolor="#FFFFFF">TP.HCM ngày ...... tháng <?php echo getmonth($motc_lv0013->DateCurrent);?> năm <?php echo getyear($motc_lv0013->DateCurrent);?></td>
</tr>
<tr>
<td  colspan="2" height="25" align="center" bgcolor="#FFFFFF"><strong>Lập bảng</strong></td>
<td  align="left" valign="middle" bgcolor="#FFFFFF"><br /></td>
<td  colspan="2" align="center" bgcolor="#FFFFFF"><strong>Chủ t&agrave;i khoản</strong></td>
</tr>
<tr>
<td  height="25" align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" valign="middle" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
</tr>
<tr>
<td  height="25" align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" valign="middle" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
</tr>
<tr>
<td  height="25" align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" valign="middle" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
</tr>
<tr>
<td  height="25" align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" valign="middle" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
</tr>
<tr>
<td  height="25" align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" valign="middle" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
<td  align="left" bgcolor="#FFFFFF"><span style="color: #000000;"><br /></span></td>
</tr>
<tr>
<td  colspan="2" height="25" align="center" bgcolor="#FFFFFF"><strong>ĐOÀN THỊ THU ĐÀO</strong></td>
<td  align="left" valign="middle" bgcolor="#FFFFFF"><br /></td>
<td  colspan="2" align="center" bgcolor="#FFFFFF"><strong>
<?php
if($motc_lv0020->isBrand=='SOF')
echo 'ĐỖ MINH DUY';
else
echo 'ĐỖ MINH DUY';
//echo 'Trần Thị Phương Thảo';
?></strong></td>
</tr>
</tbody>
</table>					
<?php
} else {
	include("../permit.php");
}
?>
</center>	