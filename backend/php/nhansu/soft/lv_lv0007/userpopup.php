<?php
session_start();
$vDir = "../";
include($vDir."config.php");
include($vDir."function.php");
include($vDir."paras.php");

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile($vDir."../","AD0092.txt",$plang);
////////////////////////////////////////////Get Data////////////////////////////////////////////////
$psql = $_POST['txtSQL'];		
$vFlag = (int)$_POST['txtFlag'];
$vUserID=$_POST["txtUserID"];
$vUserName=$_POST["txtUserName"];
$vRight=$_POST["txtRight"];
$vGroup=$_POST["cboGroup"];

if($psql=="")
{
	switch($vFlag)
	{
		case 1:
			$psql="	SELECT A.ID, A.UserName, A.UserRight, A.UserGroupID, B.UserGroupName UserGroup 
					FROM user A LEFT JOIN usergroup B ON A.UserGroupID=B.ID 
					WHERE 1=1 ";
			$vCondition="";
			//Create conditions for sql	statement
			if($vUserID!="") $vCondition = " AND A.ID LIKE '%$vUserID%'";
			if($vUserName!="") $vCondition = $vCondition." AND A.UserName LIKE '%$vUserName%'";
			if($vRight!="") $vCondition = $vCondition." AND A.UserRight LIKE '%$vRight%'";
			if($vGroup!="") $vCondition = $vCondition." AND A.UserGroupID='$vGroup'";
			$psql = $psql.$vCondition;
			break;
		case 2:
			$psql="	SELECT A.ID, A.UserName, A.UserRight, A.UserGroupID, B.UserGroupName UserGroup 
					FROM user A LEFT JOIN usergroup B ON A.UserGroupID=B.ID 
					WHERE 1=1 ";
			break;
		default:
			$psql="	SELECT A.ID, A.UserName, A.UserRight, A.UserGroupID, B.UserGroupName UserGroup 
					FROM user A LEFT JOIN usergroup B ON A.UserGroupID=B.ID 
					WHERE 1=1 ";
			break;
	}
}

$vsql=$psql;
$oUID=(int)$_GET["IDFlag"];
$oName=(int)$_GET["NameFlag"];
$oGroup=(int)$_GET["GroupFlag"];
$oRight=(int)$_GET["RightFlag"];
if($oUID!=0) {
	if($oUID==1) {
		$vFlagName="&IDFlag=1";
		$vsql=$vsql." ORDER BY A.ID ";
	} else {
		$vFlagName="&IDFlag=2";			
		$vsql=$vsql." ORDER BY A.ID DESC";
	}
} elseif ($oName!=0) {
	if($oName==1) {
		$vFlagName="&NameFlag=1";			
		$vsql=$vsql." ORDER BY A.UserName ";
	} else {
		$vFlagName="&NameFlag=2";			
		$vsql=$vsql." ORDER BY A.UserName DESC";
	}
} elseif($oGroup!=0) {
	if($oGroup==1) {
		$vFlagName="&GroupFlag=1";
		$vsql=$vsql." ORDER BY A.UserGroupID ";
	} else {
		$vFlagName="&GroupFlag=2";
		$vsql=$vsql." ORDER BY A.UserGroupID DESC";
	}
} elseif($oRight!=0) {
	if($oRight==1) {
		$vFlagName="&RightFlag=1";
		$vsql=$vsql." ORDER BY A.UserRight ";
	} else {
		$vFlagName="&RightFlag=2";
		$vsql=$vsql." ORDER BY A.UserRight DESC";
	}
}
if($vFlag!=0){
	$bResultS=db_query($vsql);
	$totalRows=db_num_rows($bResultS);
}
$curPage=(int)$_POST[curPg];
$maxRows =10;
$maxPages =3;
if($curPage=="") 
$curPage =1;
$curRow = ($curPage-1)*$maxRows+1;
$paging =phantrang($plang,$curPage,$totalRows,$maxRows,$maxPages,$curRow);
?>
<?php
if(is_numeric($_SESSION['ERPSOFV2RUserID']) || $_SESSION['ERPSOFV2RUserID']!=""){
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/lstyle.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/runtype/horizontalstyle.css" type="text/css">
	<script language="javascript" src="../../javascripts/pubscript.js"></script>
	<title><?php echo $vLangArr[1];?></title>
	<script>
	<!--
	/*=============================================================================*/
	function Search() {
		var o = document.frmUserSrch;
		o.txtFlag.value = 1;
		//o.action="<?php //echo $_SERVER['PHP_SELF']?>";
		o.action="<?php echo $vDir;?>user/userpopup.php?lang=<?php echo $plang;?>";
		o.target="_self";
		o.submit();
	}
	/*=============================================================================*/
	function GetBack(vValue) {
		opener.document.frmchoose.cboUser.value=vValue;
		window.close();
	}
	/*=============================================================================*/
	function Back() {
		window.close();
	}
	/*==========================================================================================*/
	function ViewSort(vValue){
		var o = document.frmchoose;
		o.curPg.value="<?php echo $curPage;?>";
		vValue=replaces("=0^","=1^",vValue);
		o.action="userpopup.php?lang=<?php echo $plang;?>"+vValue;

		o.txtUserID.value="<?php  echo $vUserID;?>";
		o.txtUserName.value="<?php echo $vUserName;?>";
		o.cboGroup.value="<?php echo $vGroup;?>";
		o.txtRight.value="<?php echo $vRight;?>";
		o.submit();
	}
	/*==========================================================================================*/
	//-->
	</script>
</head>
<body  onkeyup="KeyPublicRun(event)">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr height="25%"><td>&nbsp;</td></tr>
		<tr height="*">
			<td>&nbsp;</td>
			<td width="100%" align="center">
				<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
					<tr>
						<td class="td" colspan="3"><h2><?php echo $vLangArr[2];?></h2></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="td" width="100%" align="center">
							<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" class="tbl">	
								<tr>
									<td class="td" align="center">
										<form name="frmUserSrch" id="frmUserSrch" method="POST" action="#">
											<input type="hidden" name="txtFlag" id="txtFlag" value="1">
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<tr>
													<td class="td" width="20%" height="20px"><?php echo $vLangArr[4].":";?> </td>
													<td class="td"><input name="txtUserID" type="text" id="txtUserID" style="width:120px" tabindex="1" /></td>
													<td class="td" height="20px"><?php echo $vLangArr[7].":";?> </td>
													<td class="td">
														<select name="txtRight" id="txtRight" style="width:120px" tabindex="3">
															<option value="" selected="selected">------------------------------</option>
															<?php
															//Get list of department
															$strSQL = "SELECT ID, Descs FROM usercategory WHERE 1=1 ORDER BY ID ";
															$vResult = db_query($strSQL);
															while($vrow = db_fetch_array($vResult))
															{
															?>
																<option value="<?php echo $vrow['ID'];?>" title="<?php echo $vrow['Descs'];?>" >
																	<?php echo $vrow['Descs']." [".$vLangArr[8].": ".$vrow['ID']."]";?></option>
															<?php 
															}
															?>
														</select></td>
												</tr>
												<tr>
													<td class="td" height="20px"><?php echo $vLangArr[5].":";?> </td>
													<td class="td"><input name="txtUserName" type="text" id="txtUserName" style="width:120px" tabindex="2"/></td>
													<td class="td" height="20px"><?php echo $vLangArr[6].":";?> </td>
													<td class="td">
														<select name="cboGroup" id="cboGroup" style="width:120px" tabindex="4">
															<option value="" selected="selected">------------------------------</option>
															<?php
															//Get list of department
															$strSQL = "SELECT ID, UserGroupName FROM usergroup WHERE 1=1 ORDER BY UserGroupName ";
															$vResult = db_query($strSQL);
															while($vrow = db_fetch_array($vResult))
															{
															?>
																<option value="<?php echo $vrow['ID'];?>" title="<?php echo $vrow['UserGroupName'];?>" >
																	<?php echo $vrow['UserGroupName']." [".$vLangArr[8].": ".$vrow['ID']."]";?></option>
															<?php 
															}
															?>
														</select></td>
												</tr>
												<tr><td class="td" colspan="4">&nbsp;</td></tr>
												<tr>
													<td class="td" align="center" colspan="4">
														<input type="image" class="btAdd" name="search" onClick="Search();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_search.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_search.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_search_02.jpg';" 
															title="<?php echo $vLangArr[9];?>"/>
														<input type="image" class="btAdd" name="back" onClick="Back();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_back.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back_02.jpg';" 
															title="<?php echo $vLangArr[11];?>"/>													</td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
								
								<?php
								if($totalRows>0){
								?>
								<form name="frmchoose" id="frmchoose" method="POST" action="">
									<input type="hidden" id="curPg" name="curPg" value="<?php echo $curPage ;?>" />
									<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
									<input type="hidden" name="txtFlag" id="txtFlag" value="1">
									<tr>
										<td class="td">
											<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" class="tbl">	
												<tr>
													<td class="td" width="5%" align="center"><font color="#0033FF"><?php echo $vLangArr[3];?></font></td>
													<td class="td" width="15%" align="center"><a href="javascript:ViewSort('<?php echo $psaveget;?>&IDFlag=<?php echo ($oUID==0)?"0^":(($oUID==1)?"2^":"1^");?>')" style="text-decoration:none;" ><?php echo $vLangArr[4];?></a></td>
													<td class="td" width="*" align="center"><a href="javascript:ViewSort('<?php echo $psaveget;?>&NameFlag=<?php echo ($oName==0)?"0^":(($oName==1)?"2^":"1^");?>')" style="text-decoration:none;" ><?php echo $vLangArr[5];?></a></td>
													<td class="td" width="15%" align="center"><a href="javascript:ViewSort('<?php echo $psaveget;?>&GroupFlag=<?php echo ($oGroup==0)?"0^":(($oGroup==1)?"2^":"1^");?>')" style="text-decoration:none;" ><?php echo $vLangArr[6];?></a></td>
													<td class="td" width="15%" align="center"><a href="javascript:ViewSort('<?php echo $psaveget;?>&RightFlag=<?php echo ($oRight==0)?"0^":(($oRight==1)?"2^":"1^");?>')" style="text-decoration:none;" ><?php echo $vLangArr[7];?></a></td>
												</tr>
												<?php
												if($totalRows>0)
												{
													$i = 0;
													$low = $curRow;
													$curRow = 1;
													$vorder = 0;
													while(($arrS = db_fetch_array ($bResultS))&&($curRow<=$totalRows) && ($curRow <= $curPage*$maxRows))
													{
														$curRow++;
														$vorder+=1;	
														if($curRow>$low)
														{
												?>		
														<tr>
															<td class="td"><?php echo $vorder;?></td>
															<td class="td">
																<a href="javascript:GetBack('<?php echo $arrS['ID'];?>');"><?php echo $arrS['ID'];?></a></td>
															<td class="td"><?php echo $arrS['UserName'];?></td>
															<td class="td" title="<?php echo $arrS['UserGroup'];?>">
																<font color="#0033FF"><?php echo $arrS['UserGroupID'];?></font></td>
															<td class="td"><?php echo $arrS['UserRight'];?></td>
														</tr>
												<?php
														}
													}
												}
												?>
												<tr>
													<td class="td" height="20px" colspan="8"><?php echo $paging?></td>
												</tr>
											</table>
										</td>
									</tr>
									<input name="txtUserID" type="hidden" id="txtUserID" value="" />
									<input name="txtUserName" type="hidden" id="txtUserName" value="" />
									<input name="txtRight" type="hidden" id="txtRight" value="" />
									<input name="cboGroup" type="hidden" id="cboGroup" value="" />
								</form>
								<?php
								} else if($totalRows<=0 && $vFlag==1){
								?>
								<tr>
									<td class="td" align="center"><font color="#660033"><?php echo $vLangArr[13];?></font></td>
								</tr>
								<?php
								}
								?>
							</table>
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="25%"><td>&nbsp;</td></tr>
	</table>
</body>
<script language="javascript">
<!--
<?php 
if($vFlag==1)
{
?>
	//GetBack('<?php //echo $vPhotograph;?>');///Call function Back() type of javascript by php code after insert successfull.
<?php
}
?>
//-->
</script>
<script language="javascript">
	var o=document.frmUserSrch;
	o.txtUserID.value="<?php  echo $vUserID;?>";
	o.txtUserName.value="<?php echo $vUserName;?>";
	o.cboGroup.value="<?php echo $vGroup;?>";
	o.cboRight.value="<?php echo $vRight;?>";
</script>
</html>
<?php
} else {
	include("permit.php");
}
?>