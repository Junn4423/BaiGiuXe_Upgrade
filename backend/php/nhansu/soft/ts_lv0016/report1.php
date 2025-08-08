<?php
session_start();
$vDir="../";
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0016.php");

/////////////init object//////////////
$mots_lv0016=new ts_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0016');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0044.txt",$plang);
	$vLangArr1 = GetLangFile("../../","TS0022.txt",$plang);
$strNow=GetServerDate();
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0016->ArrPush[0]=$vLangArr[17];
$mots_lv0016->ArrPush[1]=$vLangArr[18];
$mots_lv0016->ArrPush[2]=$vLangArr[20];
$mots_lv0016->ArrPush[3]=$vLangArr[21];
$mots_lv0016->ArrPush[4]=$vLangArr[22];
$mots_lv0016->ArrPush[5]=$vLangArr[23];
$mots_lv0016->ArrPush[6]=$vLangArr[24];
$mots_lv0016->ArrPush[7]=$vLangArr[25];
$mots_lv0016->ArrPush[8]=$vLangArr[26];
$mots_lv0016->ArrPush[9]=$vLangArr[27];
$mots_lv0016->ArrPush[10]=$vLangArr[35];

$mots_lv0016->ArrFunc[0]='//Function';
$mots_lv0016->ArrFunc[1]=$vLangArr[2];
$mots_lv0016->ArrFunc[2]=$vLangArr[4];
$mots_lv0016->ArrFunc[3]=$vLangArr[6];
$mots_lv0016->ArrFunc[4]=$vLangArr[7];
$mots_lv0016->ArrFunc[5]='';
$mots_lv0016->ArrFunc[6]='';
$mots_lv0016->ArrFunc[7]='';
$mots_lv0016->ArrFunc[8]=$vLangArr[10];
$mots_lv0016->ArrFunc[9]=$vLangArr[12];
$mots_lv0016->ArrFunc[10]=$vLangArr[0];
$mots_lv0016->ArrFunc[11]=$vLangArr[30];
$mots_lv0016->ArrFunc[12]=$vLangArr[31];
$mots_lv0016->ArrFunc[13]=$vLangArr[32];
$mots_lv0016->ArrFunc[14]=$vLangArr[33];
$mots_lv0016->ArrFunc[15]=$vLangArr[34];
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
$mots_lv0016->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0016');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0016->lv003=$_GET['txtlv001'];
$mots_lv0016->lv002=$_GET['txtlv006'];
$mots_lv0016->lv001=$_GET['txtlv007'];
$mots_lv0016->lv018=$_GET['txtlv018'];
$vFieldList=$mots_lv0016->ListView;
$curPage = $mots_lv0016->CurPage;
$maxRows =$mots_lv0016->MaxRows;
$vOrderList=$mots_lv0016->ListOrder;
$vSortNum=$mots_lv0016->SortNum;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mots_lv0016->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="<?php echo $vDir;?>../css/reportstyle.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo $vDir;?>../css/runtype/horizontalstyle.css" type="text/css">
<title><?php echo $vLangArr[0];?></title>
<style>
.tblRunChild
{
	color:#000099;
	font-weight:bold;
	background-color:#E2F0F1;
}
.htablerun{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	background-color:#E2F0F1;
	font-weight:bold;
	padding-top:2px;
	padding-left:2px;
	padding-right:2px;
	padding-bottom:2px;
	text-align:center;
	font-weight:bold;
}
</style>
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
if($mots_lv0016->GetView()==1)
{
?>
`<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<table border="0" cellpadding="0" cellspacing="0" width="740px" align="center">
		<!--
		<tr>
			<td class="specialtext" align="right" valign="top" colspan="5">
				<a href="javascript:window.print();" style="text-decoration:none; color:#888888;"><?php //echo "[ ".$vLangArr1[4]." ]";?></a>
				<a href="javascript:window.close();" style="text-decoration:none; color:#888888"><?php //echo "[ ".$vLangArr1[5]." ]";?></a>	
			</td>
		</tr>
		//-->
		<tr>
			<td align="center" colspan="6">
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>&nbsp;</td>
						<td width="1" align="right" valign="bottom"><?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".str_replace("/","",formatdate($strNow,$plang))."'>";?></td>
					</tr>
				</table>			</td>
		</tr>
		<tr>
	    <td align="center" colspan="6"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align="center" valign="middle"><div ondblclick="this.innerHTML=''"><img  src="<?php echo $mots_lv0016->GetLogo();?>" /></div></td>
              </tr>
              <tr>
                <td align="center" style="padding-right:2px;font-size:30px;font-weight:bold" ><?php echo ((int)$_GET['rad']==0)?$vLangArr1[42]:$vLangArr1[46];?></td>
              </tr>
             
            </table>
			  </td>
		</tr>
		<tr height="40px">
			<td width="399" valign="middle" class="address">
				<div id="addr" align="left" style="width:480px;">
					<?php echo $mots_lv0016->GetCompany();?>
				<br><?php echo $vLangArr1[18].":".$mots_lv0016->GetAddress();?>	
					<br><?php echo $vLangArr1[15].":".$mots_lv0016->GetPhone()."&nbsp;&nbsp;&nbsp;".$vLangArr1[16].":".$mots_lv0016->GetFax();?>
		  </div></td>
		    <td width="63" align="right" valign="top" class="boldtext">&nbsp;</td>
	        <td width="278" align="left" valign="top" class="boldtext">&nbsp;</td>
		</tr>
		<tr><td colspan="6" height="35px">&nbsp;</td></tr>
		<tr>

			<td height="20px" colspan="6" align="center" class="normaltext">
				<?php echo $mots_lv0016->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum,(int)$_GET['rad']);?>
</td>
		</tr>
		<tr height="40px"><td colspan="6" align="right"><span class="normaltext"><span class="boldtext"><?php echo $vLangArr1[19]." ".formatdate($strNow, $plang);?></span></span></td></tr>
		<tr>
			<td height="20px" colspan="6" align="center" class="normaltext">
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20px">&nbsp;</td>
						<td width="200px">&nbsp;</td>
						<td width="*">&nbsp;</td>
						<td width="200px">&nbsp;</td>
						<td width="20px">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style"><b><?php echo $vLangArr1[37];?></b>&nbsp;</td>
						<td class="center_style">&nbsp;</td>
						<td class="center_style"><b><?php echo $vLangArr1[38];?></b>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style"><?php for($i=0; $i<60; $i++) echo ".";?>&nbsp;</td>
						<td class="center_style">&nbsp;</td>
						<td class="center_style"><?php for($i=0; $i<60; $i++) echo ".";?>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>			</td>
		</tr>
		<tr><td colspan="6" height="40px">&nbsp;</td></tr>
	</table>					
<?php
} else {
	include("../permit.php");
}
?>
