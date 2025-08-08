<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/lv_lv0007.php");
$molv_lv0007=new  lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
if($plang=="")  $plang="EN";
$vLangArr=GetLangFile("../","AD0042.txt",$plang);
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

$psql = str_replace("\'","'",$_POST['txtSQL']);
$vFlag=$_POST["txtFlag"];
$vUserID=$_POST["txtlv001"];
$vUserGroupID=$_POST["cbxUserGroupID"];
$vUserRight=$_POST["cboRight"];
$vUserName=$_POST["txtUserName"];
$vPwd=$_POST['txtPassword'];
$vEmployeeID=$_POST['txtEmployeeID'];
$curPage=(int)$_POST[curPg];	
$vStrMessage="";
if($vFlag==1)
{
		$molv_lv0007->lv001=$vUserID;
		$molv_lv0007->lv002=$vUserGroupID;
		$molv_lv0007->lv003='';
		$molv_lv0007->lv004=$vUserName;
		$molv_lv0007->lv005=$vPwd;
		$molv_lv0007->lv006=$vEmployeeID;
		$molv_lv0007->GroupID=$vUserRight;
		$vresult=$molv_lv0007->Insert();
		if($vresult==true) 
			$vStrMessage=$vLangArr[10];
		else
			$vStrMessage=$vLangArr[11].sof_error();		

}
?>
<script language="javascript">
function Reload()
{
	javascript:window.location.reload(true);
}
function Cancel()
{
	var o=document.frmEmployee;
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>";
	o.submit();
}
function Save()
{
	var o=document.frmEmployee;
	if(o.txtlv001.value=="")
		alert("<?php echo $vLangArr[12];?>");
	else
		{
			o.txtFlag.value="1";
			o.cbxUserGroupID.value=getChecked(o.chklv002.value,'chklv002');
			o.submit();
		}
	
}
function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				if(str=='') 
					str=div.value;
				else
					 str=str+','+div.value;
				}
			
			}
			return str;
		}
function Help()
{
	'http://www.sof.vn?option=com_content&amp;sectionid=0#';
}
/*==========================================================================================*/
function popupEmployee() {
	window.open('employee/employeepop.php?lang=<?php echo $plang;?>','mywindow','width=520,height=560,left=200,top=100,screenX=0,screenY=100');
}
/*==========================================================================================*/
</script>
<?php
if(checkright("",$_SESSION['ERPSOFV2RUserID'],"Ad0012","Add")>0)
{
?>
<link rel="stylesheet" href="../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../css/popup.css" type="text/css">
<script language="javascript" src="../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../javascripts/engines.js"></script>
<div id="content_child">
  <div id="breadCrumb">
  <TABLE class=menubar cellSpacing=0 cellPadding=0 width="101%" border=0>
  <TBODY>
  <TR>
    <TD class=menudottedline width="20%">
      <DIV class=pathway><A 
      href="http://www.sof.vn"><STRONG><?php echo $vLangArr[0];?></STRONG></A></DIV></TD>
    <TD class=menudottedline align=right>
      <TABLE id=toolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->
          <TD><a class="toolbar" href="javascript:Save();"><img src="../images/controlright/save_f2.png" 
            alt="Save" 
            name="save" border="0" align="middle" id="save" /> <br /><?php echo $vLangArr[1];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->
          <TD><a class="toolbar" href="javascript:Cancel();"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" 
            border="0" align="middle" id="cancel" /> <br /><?php echo $vLangArr[2];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->
          <TD><a class=toolbar 
            href="javascript:Reload();"><img 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <br><?php echo $vLangArr[3];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->
<TD><A class=toolbar 
            onclick="window.open('http://www.sof.vn/help/', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" 
            href="javascript:Help();"><IMG 
            alt=Help src="../images/controlright/help.gif" align=middle border=0 
            name=help> <BR><?php echo $vLangArr[4];?></A> </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
  </div>
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
					<form action="?<?php echo $psaveget;?>" name="frmEmployee" method="post">
						<table width="100%" border="0" align="center" class="table1" cellpadding="0" cellspacing="0">
							<tr>
							  <td  height="20px" colspan="3" align="center">
							  	<?php echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";?></td>
						  </tr>
							<tr>
								<td width="20%" rowspan="6" height="20px">&nbsp;</td>
								<td width="25%" height="20px"><?php echo $vLangArr[5];?></td>
								<td width="*" height="20px"><input name="txtlv001" type="text" id="txtlv001" width="144px" value="<?php echo $vUserID;?>" /></td>			
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[6];?></td>
							  <td  height="20px"><input name="txtPassword" type="password" id="txtPassword" value="<?php echo $vPwd;?>" width="144px" /></td>
						  </tr>
						  <tr>
							<td height="20px"><?php echo $vLangArr[7];?></td>
							<td><input name="txtUserName" type="text" id="txtUserName" width="144px" value="<?php echo $vUserName;?>"></td>
						</tr>
						  <tr>
							<td height="20px"><?php echo $vLangArr[8];?></td>
							<td  height="20"><input name="cbxUserGroupID" type="hidden" id="cbxUserGroupID" value="<?php echo $vrow['lv002'];?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $molv_lv0007->GetBuilCheckList($vrow['lv002'],'chklv002',10,'hr_lv0002','lv003');?></td>
							<!--
							<td><select name="cbxUserGroupID" id="cbxUserGroupID" style="width:144px">
							  <option value="" selected="selected">...</option>
							  <?php
				//Get list of department
					$vsql="select * from hr_lv0002 where lv002='BROTEX'";	
					$vresult=db_query($vsql);
					while ($vrow = db_fetch_array ($vresult))
					{
				
				?>
							  <option value="<?php echo $vrow['lv001'];?>" ><?php echo $vrow['lv003'];?></option>
							  <?php 
							  $vsql1="select * from hr_lv0002 where lv002='".$vrow['lv001']."'";	
							  $vresult1=db_query($vsql1);
								while ($vrow1 = db_fetch_array ($vresult1))
								{
								?>
							  <option value="<?php echo $vrow1['lv001'];?>" >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $vrow1['lv003'];?></option>
							  <?php 
							  }
					}
					?>
							</select></td>-->
						  </tr>
						  <tr>
							<td height="20px"><?php echo $vLangArr[9];?></td>
							<td>
								<select name="cboRight" id="cboRight" >
									<option value="" selected="selected">...</option>
							  <?php
				//Get list of department
					$vsql="select * from lv_lv0004";	
					$vresult=db_query($vsql);
					while ($vrow = db_fetch_array ($vresult))
					{
				
				?>
							  <option value="<?php echo $vrow['lv001'];?>" ><?php echo $vrow['lv002'];?></option>
							  <?php 
					}
					?>
							</select></td>
						</tr>
						<tr><td><?php echo $vLangArr[13];?></td>
						<td>
							<table width="80%">
								<tr><td width="50%">
									<input type="text" name="txtEmployeeID" id="txtEmployeeID" value="<?php echo $vEmployeeID;?>" readonly="true" style="background-color:#DFDFDF; font-weight:bold;width:100%"/>
									</td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT"> 
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtEmployeeID_search" id="txtEmployeeID_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtEmployeeID','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopupParent(this,'txtEmployeeID','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
						</tr>
						 <tr>
							<td></td>
							<td height="20px"><?php echo 'Themes';?></td>
							<td>
								<select name="cboThemes" id="cboThemes" >
									<option value="" selected="selected">...</option>
									<?php 
									$sqlS1 = "SELECT lv001 ID, lv002 Descs FROM lv_lv0011";
									$bResultS1 = db_query($sqlS1);
									$totalRows1 = db_num_rows($bResultS1);
									if($totalRows1>0){
										while($arrS1 = db_fetch_array($bResultS1)){
										?>
											<option value="<?php echo $arrS1['ID'];?>"><?php echo $arrS1['ID']." (".$arrS1['Descs'].")";?></option>
										<?php
										}
									}
									?>
							</select></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="3"><input name="txtFlag" type="hidden" id="txtFlag"/></td>
						  </tr>
					  </table>
					  <input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
						<input type="hidden" name="curPg" id="curPg" value="<?php echo $curPage;?>">					  
					</form>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
<script language="javascript" src="../javascripts/menupopup.js"></script>		
<script language="javascript">		
	<?php 
	if($vFlag==1)
	{
	?>
		Cancel();///Call function Back() type of javascript by php code after insert successfull.
	<?php
	}
	?>		
	</script>			
    </h3>
  </div>
</div>
<?php
} else {
	include("permit.php");
}
?>