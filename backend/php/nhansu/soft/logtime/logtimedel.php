<?php
include("paras.php");
$psaveget=empgetsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0070.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$psql = $_POST['txtSQL'];
$vUserID=$_POST['txtlv001'];
$strStartDate = $_POST['txtStartDate'];
$strEndDate = $_POST['txtEndDate'];
$flagControl=(int)$_POST['txtFlagControl'];
if($plang == "VN")//format: dd-mm-yyyy
{
	$strStartDate = cen_date_vn($strStartDate);//convert to: yyyy-mm-dd
	$strEndDate = cen_date_vn($strEndDate);
}
else//format: mm/dd/yyyy
{
	$strStartDate = cen_date($strStartDate);//convert to: yyyy-mm-dd
	$strEndDate = cen_date($strEndDate);
}

$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$vStrMessage="";

if($vFlag==1)
{
	//if($strStartDate >= $strMinDate && $strEndDate <= $strMaxDate)
//	{
		$sql="DELETE FROM log WHERE LoginDate BETWEEN '$strStartDate' AND '$strEndDate'";
		$vResult = db_query($sql);
		if($vResult==true)
		{
			$vStrMessage=$vLangArr[13];
		}
		else
		{
			$vStrMessage=$vLangArr[14];
		}
		//$vStrMessage=GetNoDelete($strar,"department");
//	}
//	else
//		$vStrMessage=$vLangArr[15];
}
//////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
$sql2="SELECT MIN(LoginDate) as MinDate, MAX(LoginDate) as MaxDate FROM log";
$vResult2 = db_query($sql2);
$intRows = db_fetch_array($vResult2);
$strMinDate = $intRows['MinDate'];
$strMaxDate = $intRows['MaxDate'];
if($plang == "VN")
	$vStrDate = $vLangArr[16]." ".en_date_vn($strMinDate)." ".$vLangArr[17]." ".en_date_vn($strMaxDate);
else
	$vStrDate = $vLangArr[16]." ".en_date($strMinDate)." ".$vLangArr[17]." ".en_date($strMaxDate);
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript">
<!--
function Help(){
	'http://www.sof.vn?option=com_content&amp;sectionid=0#';
}
function Reload(){
	javascript:window.location.reload(false);
}
function Back(){
	var o=document.frmgeneral;
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,0,0,0)?>";
	o.target="_self";
	o.submit();
}

function CheckDay(){
	var o=document.frmgeneral;
	if(o.txtStartDate.value==''){
		alert("<?php echo $vLangArr[10];?>");
		return false;
	}
	else if(o.txtEndDate.value==''){
		alert("<?php echo $vLangArr[11];?>");
		return false;
	}
	else if(o.txtStartDate.value>=o.txtEndDate.value){
		alert("<?php echo $vLangArr[12];?>");
		return false;
	}
	return true;
}
function Delete(){
	if(CheckDay()==true){
		var o=document.frmgeneral;
		o.action="<?php echo $_SERVER["PHP_SELF/logtime/logtimedel.php"]; ?>";
		o.txtEmployeeID.value="<?php echo $strEmpID;?>";
		o.txtFlag.value="1";
		//o.target="_blank";
		o.submit();
	}
}
//-->
</script>
<?php
if(checkright("",$_SESSION['ERPSOFV2RUserID'],"", "") > 0)
{
?>
<div id="content_child">
	<div id="breadCrumb">
	<TABLE class=menubar cellSpacing=0 cellPadding=0 width="100%" border=0>
		<TBODY>
			<TR>
				<TD class=menudottedline width="20%">
					<DIV class=pathway></DIV>
				</TD>
				<TD class=menudottedline align=right>
					<TABLE id=toolbar cellSpacing=0 cellPadding=0 border=0>
						<TBODY>
						<TR vAlign=center align=middle>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD>
								<a class="toolbar" href="javascript:Delete();">
						  		<img tittle="Delete" 
								src="../<?php echo $vDir;?>images/controlright/trush.gif" align="middle" border="0" 
								name="del" /><br><?php echo $vLangArr[1];?></a></TD>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD>
								<a class="toolbar" href="javascript:Back();">
						  		<img tittle="Back" 
								src="../<?php echo $vDir;?>images/controlright/move_f2.png" align="middle" border="0" 
								name="cancel" /><br><?php echo $vLangArr[2];?></a></TD>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD>
								<a class="toolbar" href="javascript:Reload();">
						  		<img tittle="Reload My Information" 
								src="../<?php echo $vDir;?>images/controlright/reload.gif" align="middle" border="0" 
								name="reload" /><br><?php echo $vLangArr[3];?></a>
							</TD>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD>
								<A class="toolbar" onClick="window.open('http://sof.vnindex2.php?option=com_content&amp;task=findkey&amp;pop=1&amp;keyref=screen.content', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" href="javascript:Help();">
								<img tittle="Help" src="../<?php echo $vDir;?>images/controlright/help.gif" align=middle border=0 name="help">
								<BR><?php echo $vLangArr[4];?></A>
							</TD>
						</TR>
						</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
		</TABLE>
	</div>
	<div class="story">
    <h3>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="" name="frmgeneral" method="post">
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td height="20px" align="" colspan="2">
									<font color="#CC0000" face="Arial, Helvetica, sans-serif" size="2pt"><?php echo $vStrMessage;?></font></td>
							</tr>
							<tr>
								<td  colspan="2" align="" ><b><?php echo $vLangArr[5];?></b><br></td>
							</tr>
							<tr>
								<td height="20px" width="30%" align="right"><?php echo $vLangArr[6];?></td>
								<!--**Doan nay duoc su dung de kiem tra language -> truyen vao ham showCalenda**-->
								<script language="javascript">
								<!--
								var jlang = "";
								var plang = "<?php echo $plang;?>";
								<?php 
								if($plang=="VN")
								{
								?>
									jlang = "VN";
								<?php
								}
								else
								{
								?>
									jlang = "US";
								<?php
								}
								?>
								//-->
								</script>
								<td><input type="text" name="txtStartDate" id="txtStartDate" readonly="true" 
									title="" size="15" style="text-align:center" />
									<img src="../<?php echo $vDir;?>images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
										border="0" style="cursor:pointer" width="16" height="16" 
										onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmgeneral.txtStartDate);return false;" 
										title="<?php echo $vLangArr[9];?>" /></td>
							</tr>
							<tr>
								<td height="20px" align="right"><?php echo $vLangArr[7];?></td>
								<td><input type="text"name="txtEndDate" id="txtEndDate" align="right" readonly="true" 
									title="" size="15" style="text-align:center" />
									<img src="../<?php echo $vDir;?>images/calendar/calendar.gif" name="imgDate2" id="imgDate2" 
										border="0" style="cursor:pointer" width="16" height="16" 
										onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmgeneral.txtEndDate);return false;"
										title="<?php echo $vLangArr[9];?>"/></td>
							</tr>
							<tr>
								<td colspan="2">
									<font size="2"><?php echo $vLangArr[8];?></font>
								</td>
							</tr>
							<tr>
								<td height="20px" align="" colspan="2">
									<font color="#0099FF" face="Arial, Helvetica, sans-serif" size="2pt"><?php echo $vStrDate;?></font></td>
							</tr>
						</table>
						<input type="hidden" name="txtFlag" id="txtFlag" value="0" />
						<input type="hidden" name="txtEmployeeID" id="txtEmployeeID" value="<?php echo $strEmpID;?>" />
						<input type="hidden"  name="txtlv001" id="txtlv001" value="<?php echo $vUserID;?>" />
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />

						<input type="hidden" name="txtFlagControl" id="txtFlagControl" value="<?php echo $flagControl;?>" />
					</form>
				
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php
} else {
	include("permit.php");
}
?>