<?php
include("paras.php");
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0009.txt",$plang);

$psql = $_POST['txtSQL'];
$vUserID = $_POST['txtUserID'];///Store UerID
$vRightID = $_POST['txtRightID'];///Store RightID

$curPage2 = (int)$_POST[curPg2];

///////////////////////////////////////////////////Get RightDetailID/////////////////////////////////////////////////////
$strSQL2 = "SELECT rd.ID AS rdID from rightdetail rd WHERE rd.UserID='$vUserID' AND rd.Right='$vRightID'";
$arrResult2 = db_query($strSQL2);
$intRows2 = db_fetch_array($arrResult2);
$strRdID = $intRows2['rdID'];///Store RightDetailID
///////////////////////////////////////////////////Get RightDetailID/////////////////////////////////////////////////////

//////////////////////////////////////////////////////Update Data////////////////////////////////////////////////////////
$strRcID = $_POST['txtStrID'];
$strEnable = $_POST['txtEnable'];
$vFlag = (int)$_POST['txtFlag'];

if($vFlag==1)
{
	$strRcID = substr($strRcID, 0, strlen($strRcID)-1);
	$arrRcID = explode("@", $strRcID);
	$strEnable = substr($strEnable, 0, strlen($strEnable)-1);
	$arrEnable = explode("@", $strEnable);
	if(DelRow($vFlag, $arrRcID, $strRdID))
	{
		AddRow($vFlag, $arrRcID, $arrEnable, $strRdID);
	}
	//else
		//exit();
}

function DelRow($vFlag, $arr, $strRdID)////////////////////Delete Data From rightdetailcontrol table////////////////////
{
	if($vFlag==1)
	{
		$num=count($arr);
		for($i=0; $i<$num; $i++)
		{
			$sqlD="DELETE FROM rightcontroldetail WHERE RightDetailID='$strRdID'";
			db_query($sqlD);
		}
		return true;
	}
	return false;
}

function AddRow($vFlag, $arr1, $arr2, $strRdID)////////////////////////Add Data to rightdetailcontrol table//////////////////////
{
	if($vFlag==1)
	{
		$num=count($arr1);
		for($i=0; $i<$num; $i++)
		{
			$sqlA="	INSERT INTO rightcontroldetail 
						SET RightControlID='$arr1[$i]', RightDetailID='$strRdID', Enable='$arr2[$i]'";
			db_query($sqlA);
		}
		return true;
	}
	return false;
}
//////////////////////////////////////////////////////Update Data////////////////////////////////////////////////////////
/////////////////////////////////////////////////Show Right Information//////////////////////////////////////////////////
$strSQL = "SELECT r.ID, r.Desc, r.Link FROM rights r WHERE ID = '$vRightID' ORDER BY ID";
$arrResult = db_query($strSQL);
$intRows = db_fetch_array($arrResult);
$strRight = ' '.$intRows['ID'].' | '.$intRows['Desc'].' | '.$intRows['Link'];
/////////////////////////////////////////////////Show Right Information//////////////////////////////////////////////////

////////////////////////////////////////////////////Get Permissions//////////////////////////////////////////////////////
$strSQL3 = "SELECT rc.*, rcd.RightDetailID, rcd.Enable 
			FROM rightcontrol rc LEFT JOIN rightcontroldetail rcd ON rc.ID=rcd.RightControlID 
			AND rcd.RightDetailID='$strRdID'";
$arrResult3 = db_query($strSQL3);
$totalRows = db_num_rows($arrResult3);
$curPage = (int)$_POST[curPg];
$maxRows = 10;
$maxPages = 10;
if($curPage == "")
	$curPage = 1;
$curRow = ($curPage-1) * $maxRows+1;
$paging = phantrang($plang,$curPage,$totalRows,$maxRows,$maxPages,$curRow);
////////////////////////////////////////////////////Get Permissions//////////////////////////////////////////////////////

?>
<script language="javascript">
<!--
function AddPerThem()
{
	ChkedAddPer(document.frmchoose, 'chkID', 'chkEnable');
}
function DoAddPerThis(frm, vStr1, vStr2)
{
	var o = document.frmSubmit;
	o.txtStrID.value = vStr1;
	o.txtEnable.value = vStr2;
	o.txtFlag.value = "1";
	o.submit();
	//Reload();
}

function Reload()
{
	document.frmchoose.submit();
}

function Help()
{
	'http://www.sof.vn?option=com_content&amp;sectionid=0#';
}

function Back()
{
	var o=document.frmchoose;
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,3,0,0,0)?>";
	BackHistory(o,o.action);
}
-->
</script>
<?php
if(checkright("",$_SESSION['ERPSOFV2RUserID'], "Ad0013", "Add") > 0)
{
?>
<div id="content_child">
	<div id="breadCrumb">
		<TABLE class="menubar" cellSpacing="0" cellPadding="0" width="100%" border="0">
		<TBODY>
			<TR>
				<TD class='menudottedline' width="40%">
				<DIV class=pathway>
					<A href="http://www.sof.vn"><STRONG>SOF CO., LTD</STRONG></A> 
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
							if(checkright("HR",$_SESSION['ERPSOFV2RUserID'], 'Ad0013', "Add") > 0)
							{
							?>

							<TD>
								<a class="toolbar" href="javascript:AddPerThem();">
								<img src="../images/controlright/apply_f2.png" title="<?php echo $vLangArr[1];?>" name="Edit" 
								border="0" align="middle"><br><?php echo $vLangArr[2];?></a>
							</TD>
							<?php
							}
							?>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD>
								<a class="toolbar" href="javascript:Back();">
								<img title="<?php echo $vLangArr[3];?>" src="../images/controlright/move_f2.png" 
								align="middle" border="0" name="back"><br><?php echo $vLangArr[4];?></a>
							</TD>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD>
								<a class="toolbar" href="javascript:Reload();">
								<img title="<?php echo $vLangArr[5];?>" src="../images/controlright/reload.gif" align="middle" 
								border="0" name="reload"><br><?php echo $vLangArr[6];?></a>
							</TD>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD>
								<a class="toolbar" 
								onclick="window.open('http://sof.vnindex2.php?option=com_content&amp;task=findkey&amp;pop=1&amp;keyref=screen.content', 'mambo_help_win','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" 
								href="javascript:Help()">
								<IMG title="<?php echo $vLangArr[7];?>" 
									src="../images/controlright/help.gif" align="middle" border="0" name="help">
								<BR><?php echo $vLangArr[8];?></a>
							</TD>
						</TR>
					  </TBODY>
					</TABLE>
				</TD>
			</TR>
		  </TBODY>
		</TABLE>
	</div>
	<h2 id="pageName"><?php echo $vLangArr[14];?></h2>
	<div class="story">
	<h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="13">
					<img name="table_r1_c1" src="../images/pictures/table_r1_c1.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="*" background="../images/pictures/table_r1_c2.gif">
					<img name="table_r1_c2" src="../images/pictures/spacer.gif" 
						width="1" height="1" border="0" alt=""></td>
				<td width="13">
					<img name="table_r1_c3" src="../images/pictures/table_r1_c3.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="11">
					<img src="../images/pictures/spacer.gif" 
						width="1" height="12" border="0" alt=""></td>
			</tr>
			<tr>
				<td background="../images/pictures/table_r2_c1.gif">
					<img name="table_r2_c1" src="../images/pictures/spacer.gif" 
						width="1" height="1" border="0" alt=""></td>
				<td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="?<?php echo $psaveget;?>" name="frmchoose" method="post">
						<input type="hidden" name="curPg" value="<?php echo $curPage;?>"/>
						<input type="hidden" name="curPg2" value="<?php echo $curPage2;?>"/>						
						<input name="txtRightID" type="hidden" id="txtRightID"  value="<?php echo $vRightID;?>" />
						<input name="txtStrID" type="hidden" id="txtStrID" />
						<input name="txtEnable" type="hidden" id="txtEnable" />
						<input name="txtUserID" type="hidden" id="txtUserID" value="<?php echo $vUserID;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="0"/>

						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
						<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" >
							<tr>
								<td align="left" colspan="4"><b><?php echo $vLangArr[10];?></b><?php echo $strRight; ?></td>					
								<td align="right" colspan="2"><a href="javascript:Back();" title="<?php echo $vLangArr[11];?>">
									<?php echo $vLangArr[12];?></a></td>
							</tr>
							<tr><td colspan="8"><br /></td></tr>
							<tr>
								<td width="10%" height="20px" align="center" ><b><?php echo $vLangArr[13];?></b></td>
								<td width="10%" align="center" >
									<input name="chkAll" type="checkbox" id="chkAll" value="checkbox" 
									onclick="DoChkAll(document.frmchoose, 'chkID', this);" /></td>
								<td width="15%" align="left" ><b><?php echo $vLangArr[14];?></b></td>
								<td width="45%" align="left" ><b><?php echo $vLangArr[15];?></b></td>
								<!--<td width="27.5%" align="left" ><b>RightDetail ID</b></td>-->
								<td width="10%" align="center" >
									<input name="chkAllEnable" type="checkbox" id="chkAllEnable" 
									onclick="DoChkAll(document.frmchoose, 'chkEnable', this);" value="checkbox"/></td>
								<td width="10%" align="left" ><b><?php echo $vLangArr[16];?></b></td>
							</tr>
							<?php
							if($totalRows>0)
							{
								$i = 0;
								$low = $curRow;
								$curRow = 1;
								$vorder = 0;
								while(($vrow = db_fetch_array ($arrResult3))&&($curRow<=$totalRows) && ($curRow <= $curPage*$maxRows))
								{
									$curRow++;
									$vorder+=1;	
									if($curRow>$low)
									{
							?>		
							<tr>
								<td height="20px" align="center" ><?php echo $vorder;?></td>		
								<td align="center" >
									<input name="chkID" type="checkbox" id="chkID" 
									value="<?php echo $vrow['ID'];?>" <?php echo ($vrow['RightDetailID'])?"checked":"";?>
									onclick="CheckOne(document.frmchoose, 'chkID', 'chkAll', this);" /></td>
								<td align="left" ><?php echo $vrow['ID']?></td>
								<td align="left" ><?php echo $vrow['Desc']?></td>
								<!--<td align="left" ><?php echo $vrow['RightDetailID']?></td>-->
								<td align="center" >
									<input name="chkEnable"  id="chkEnable" <?php echo ($vrow['Enable'])?"checked":"";?>  
									value="<?php echo $vrow['ID'];?>" type="checkbox" 
									onclick="CheckOne(document.frmchoose, 'chkEnable', 'chkAllEnable', this);" /></td>
								<td  align="left"><?php echo ($vrow['Enable']==1)?'Yes':'No';?></td>
							</tr>
							<?php
									}
								}
							}
							?>
							<tr>
								<td height="20px" colspan="6"><?php echo $paging?></td>
							</tr>
						</table>
					</form>
					<form action="?<?php echo $psaveget;?>" name="frmSubmit" method="post">
						<input name="txtRightID" type="hidden" id="txtRightID"  value="<?php echo $vRightID;?>" />
						<input name="txtStrID" type="hidden" id="txtStrID" value="<?php echo $strRcID;?>" />			
						<input name="txtEnable" type="hidden" id="txtEnable" value="<?php echo $strEnable;?>" />
						<input name="txtUserID" type="hidden" id="txtUserID" value="<?php echo $vUserID;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="0" />

						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
						<input type="hidden" name="curPg2" value="<?php echo $curPage2;?>"/>			
					</form>
				
	</div>
</div>
<?php
} else {
	include("permit.php");
}
?>