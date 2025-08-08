<?php
include("paras.php");
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile($vDir."../","AD0093.txt",$plang);
/////////////////////////////////////////////////////////////////////////////////////////////////////
$vFlag = (int)$_POST['txtFlag'];
$vUserID=$_POST["txtUserID"];
$vUserName=$_POST["txtUserName"];
$vRight=$_POST["cboRight"];
$vGroup=$_POST["cboGroup"];

$pBack = getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,$pchildlst,$plevel3lst,$pchild3lst);
?>
<script language="javascript">
<!--
function Help(){'http://www.sof.vn?option=com_content&amp;sectionid=0#';}
/*=======================================================================================*/
function Reload(){
	var o=document.frmchoose;
	o.action="?<?php echo $psaveget;?>";
	o.submit();
}
/*=======================================================================================*/
function Back(){
	var o=document.frmPostThis;
	o.action="?<?php echo $pBack;?>";
	o.submit();
}
/*=======================================================================================*/
function Filter(){
	var o=document.frmchoose;
	o.txtFlagFilter.value = 1;
	o.action="?<?php echo $pBack;?>";
	o.target="_self";
	o.submit();
}
/*==========================================================================================*/
//-->
</script>
<?php
//if(checkright("",$_SESSION['ERPSOFV2RUserID'],"Ad0012","")>0)
//{
?>
<div id="content_child">
	<div id="breadCrumb">
		<TABLE class="menubar" cellSpacing="0" cellPadding="0" width="100%" border="0">
		<TBODY>
			<TR>
				<TD class=menudottedline width="20%">
				<DIV class=pathway>
					<A href="http://www.sof.vn"><STRONG>SOF V3.0</STRONG></A> 
				</DIV>
				</TD>
				<TD class="menudottedline" align="right">
					<TABLE id="toolbar" cellSpacing="0" cellPadding="0" border="0" width="100%">
					<TBODY>
						<TR vAlign="center" align="middle">
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<?php
							if(checkright("",$_SESSION['ERPSOFV2RUserID'],"Ad0012","")>0)
							{
							?>
							<TD><a class="toolbar" href="javascript:Filter();">
								<img src="<?php echo $vDir;?>../images/lvicon/Filter.png" title="<?php echo $vLangArr[1];?>" 
									name="filter" id="filter" alt="save" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[2];?></a></TD>
							<?php
							}
							?>
							<TD><a class="toolbar" href="javascript:Back();">
								<img src="<?php echo $vDir;?>../images/controlright/move_f2.png" title="<?php echo $vLangArr[3];?>" 
									name="back" id="back" alt="back" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[4];?></a></TD>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD><a class="toolbar" href="javascript:Reload();">
								<img src="<?php echo $vDir;?>../images/lvicon/Reload.png" title="<?php echo $vLangArr[5];?>" 
									name="reload" id="reload" alt="reload" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[6];?></a></TD>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD>
								<a class="toolbar" onclick="window.open('http://www.sof.vn/help/','mambo_help_win','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" href="javascript:Help()">
								<img src="<?php echo $vDir;?>../images/lvicon/Help.png" title="<?php echo $vLangArr[7];?>" 
									name="help" id="help" alt="help" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[8];?></a></TD>
						</TR>
						</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
		</TABLE>
	</div>
	<h2 id="pageName"><?php echo $vLangArr[10];?></h2>
	<div class="story">
	<h3>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="13">
				<img name="table_r1_c1" src="<?php echo $vDir;?>../images/pictures/table_r1_c1.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="*" background="<?php echo $vDir;?>../images/pictures/table_r1_c2.gif">
				<img name="table_r1_c2" src="<?php echo $vDir;?>../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td width="13">
				<img name="table_r1_c3" src="<?php echo $vDir;?>../images/pictures/table_r1_c3.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="11">
				<img src="<?php echo $vDir;?>../images/pictures/spacer.gif" 
					width="1" height="12" border="0" alt=""></td>
		</tr>
		<tr>
			<td background="<?php echo $vDir;?>../images/pictures/table_r2_c1.gif">
				<img name="table_r2_c1" src="<?php echo $vDir;?>../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td>
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				<form action="" name="frmchoose" id="frmchoose" method="post">
					<input type="hidden" name="txtFlag" id="txtFlag" value="0" />
					<input type="hidden" name="txtFlagFilter" id="txtFlagFilter" value="0" />
					<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" >
						<?php if($vStrMessage!=""){?>
						<tr>
						  <td height="20px" colspan="2" align="center"><font color="#3366CC"><?php echo $vStrMessage;?></font></td>
						</tr>
						<?php }?>
						<tr>
							<td width="35%" height="20px" align="right"><?php echo $vLangArr[11];?></td>
							<td><input name="txtUserID" type="text" id="txtUserID"/></td>
						</tr>
						<tr>
							<td align="right"><?php echo $vLangArr[12];?></td>
							<td><input name="txtUserName" type="text" id="txtUserName"/></td>
						</tr>
						<tr>
							<td align="right"><?php echo $vLangArr[13];?></td>
							<td class="td">
								<select name="cboGroup" id="cboGroup">
									<option value="" selected="selected">------------------------------</option>
									<?php
									//Get list of department
									$strSQL1 = "SELECT lv001, lv002 FROM lv_lv0004 WHERE 1=1 ORDER BY UserGroupName ";
									$vResult1 = db_query($strSQL1);
									while($vrow1 = db_fetch_array($vResult1))
									{
									?>
										<option value="<?php echo $vrow1['lv001'];?>" title="<?php echo $vrow1['lv001'];?>" >
											<?php echo $vrow1['lv002']." [".$vLangArr[15].": ".$vrow1['lv001']."]";?></option>
									<?php 
									}
									?>
								</select></td>
						</tr>
						<tr>
							<td align="right"><?php echo $vLangArr[14];?></td>
							<td class="td">
								<select name="cboRight" id="cboRight">
									<option value="" selected="selected">------------------------------</option>
									<?php
									//Get list of department
									$strSQL2 = "SELECT ID, Descs FROM usercategory WHERE 1=1 ORDER BY ID ";
									$vResult2 = db_query($strSQL2);
									while($vrow2 = db_fetch_array($vResult2))
									{
									?>
										<option value="<?php echo $vrow2['ID'];?>" title="<?php echo $vrow2['Descs'];?>" >
											<?php echo $vrow2['Descs']." [".$vLangArr[15].": ".$vrow2['ID']."]";?></option>
									<?php 
									}
									?>
								</select></td>
						</tr>
					</table>
				</form>
				<script language="javascript">
				<!--
					var o = document.frmchoose;
					o.txtUserID.value="<?php  echo $vUserID;?>";
					o.txtUserName.value="<?php echo $vUserName;?>";
					o.cboGroup.value="<?php echo $vGroup;?>";
					o.cboRight.value="<?php echo $vRight;?>";
				//-->
				</script>
				<form action="" name="frmPostThis" id="frmPostThis" method="post">
					<input type="hidden" name="txtSQL" id="txtSQL" value="" />
				</form>
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			</td>
			<td background="<?php echo $vDir;?>../images/pictures/table_r2_c3.gif">
				<img name="table_r2_c3" src="<?php echo $vDir;?>../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td><img src="<?php echo $vDir;?>../images/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
		</tr>
		<tr>
			<td>
				<img name="table_r3_c1" src="<?php echo $vDir;?>../images/pictures/table_r3_c1.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td background="<?php echo $vDir;?>../images/pictures/table_r3_c2.gif">
				<img name="table_r3_c2" src="<?php echo $vDir;?>../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td>
				<img name="table_r3_c3" src="<?php echo $vDir;?>../images/pictures/table_r3_c3.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td><img src="<?php echo $vDir;?>../images/pictures/spacer.gif" width="1" height="16" border="0" alt=""></td>
		</tr>
	</table>
	</h3>
	</div>
</div>
<?php
//} else {
//	include("permit.php");
//}
?>