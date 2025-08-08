<?php
session_start(); 
unset( $_SESSION['NodesHasBeenAddedCheckBox'] );
unset( $_SESSION['treeviewcheckbox'] );
unset( $_SESSION['treeviewcheckbox'] );
if (isset( $_SESSION['NodesHasBeenAddedCheckBox'] )) {
	session_destroy();
}
if (isset( $_SESSION['treeviewcheckbox'] )) {
	session_destroy();
}
include("paras.php");
if($plang=="")  $plang="EN";
$vLangArr=GetLangFile("../","AD0044.txt",$plang);
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
//////////////////////////////////////////////////////////////////////////////////////////////////////
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vStrMessage="";
if($flagID==1)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$sql="DELETE FROM lv_lv0007 WHERE lv_lv0007.lv001 IN (".$strar.") and (select count(*) from lv_lv0008 B where B.lv002=lv_lv0007.lv001)<=0 ";
	db_query($sql);
	//$vStrMessage=GetNoDelete($strar,"user");
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
$psql = str_replace("\'","'",$_POST['txtSQL']);
$vFlagFilter = (int)$_POST['txtFlagFilter'];
$vUserID = $_POST["txtlv001"];
$vUserName = $_POST["txtUserName"];
$vRight = $_POST["cboRight"];
$vGroup = $_POST["cboGroup"];
$psqlfix=" and lv001<>'admin' AND 1=1 ";
if($psql=="")
{
	switch($vFlagFilter)
	{
		case 1:
			$vCondition="";
			//Create conditions for sql	statement
			if($vUserID!="") $vCondition = " AND lv001 LIKE '%$vUserID%'";
			if($vUserName!="") $vCondition = $vCondition." AND lv004 LIKE '%$vUserName%'";
			if($vRight!="") $vCondition = $vCondition." AND lv003='$vRight'";
			if($vGroup!="") $vCondition = $vCondition." AND lv002='$vGroup'";
			$psql = $psql.$vCondition;
			break;
		case 2:
			break;
		default:
			break;
	}
}
$vsql=$psql;
$tsql="SELECT count(*) as nums FROM lv_lv0007 WHERE 1=1 ".$psqlfix.$vsql;
$sumresult=db_query($tsql);
$sumrow=db_fetch_array($sumresult);
$totalRows=$sumrow['nums'];
$curPage=(int)$_POST[curPg];
$maxRows = 100;
$maxPages =5;
if($curPage=="") 
$curPage =1;
$curRow = ($curPage-1)*$maxRows;
$paging =phantrang($plang,$curPage,$totalRows,$maxRows,$maxPages,$curRow);
?>
<script language="javascript">
	function AddUser()
	{
		 var o=document.frmcomtemp;
 		 o.target="_self"; 
		 o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,1,0,0,0);?>"
		 o.submit();
	}
	function KindOfUser()
	{
		 var o=document.frmcomtemp;
 		 o.target="_self"; 
		 o.txtFlagControl.value="1";
		 o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,5,0,0,0);?>"
		 o.submit();
	}

	function Edit()
	{
		open_edit();
	}
	function EditItem(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,2,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
	
	function Delete()
	{
		open_del('department/departmentdel.php','<?php echo  $ma;?>');
	}

	function AddPer()
	{
		Chked2Submit(document.frmchoose,'chkuser',6)
	}
	function AddPermission(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,3,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
	function ViewLogtime(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,4,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
	function ViewLogtimes()
	{
		Chked2Submit(document.frmchoose,'chkuser',9);
	}

	function Reload()
	{
		javascript:window.location.reload(true);
	}

	function Help()
	{
		'http://www.sof.vn?option=com_content&amp;sectionid=0#';
	}

	function DoResetPass()
	{
		Chked2Submit(document.frmchoose,"chkuser",26);
	}
	function ResetPass(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,17,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
	/*=========================================================================================*/
	function Filter(){
		var o=document.frmFilter;
		o.txtlv001.value="<?php  echo $vUserID;?>";
		o.txtUserName.value="<?php echo $vUserName;?>";
		o.cboGroup.value="<?php echo $vGroup;?>";
		o.cboRight.value="<?php echo $vRight;?>";
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,18,$pchildlst,$plevel3lst,$pchild3lst);?>";
		o.target="_self";
		o.submit();
	}
	/*=========================================================================================*/
</script>
<?php
echo $_SESSION['ERPSOFV2RRight'];
if(checkright("",$_SESSION['ERPSOFV2RUserID'],"Ad0012","")>0)
{
?>
<div id="content_child">
  <div id="lvtoolbar">
  <TABLE class=menubar cellSpacing=0 cellPadding=0 width="101%" border=0>
  <TBODY>
  <TR>
    <TD class=menudottedline width="40%">
      <DIV class=pathway><A 
      href="http://www.sof.vn"><STRONG><?php echo $vLangArr[0];?></STRONG></A> </DIV></TD>
    <TD class="menudottedline" align="right">
      <TABLE id=toolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
			<!--------------------------------------------->
			<?php
			if(checkright("",$_SESSION['ERPSOFV2RUserID'],"","")>0)
			{
			?>	
            <td>&nbsp;</td>		
			<TD><a class="toolbar" href="javascript:DoResetPass();">
				<img src="../images/controlright/key.gif" title="<?php echo $vLangArr[14];?>" 
					name="reset" border="0" align="middle" id="reset" /><br /><?php echo $vLangArr[15];?></a></TD>
			<?php
			}
			?>
<!--Nhung khoang trang nay de chen tag <td> phan cach giua cac menu icon-->
		  	 <?php
		 	if(checkright("",$_SESSION['ERPSOFV2RUserID'],"Ad0012","View")>0)
			{
		 ?>		
         <td>&nbsp;</td>	
          <TD><a class="toolbar" 
            href="javascript:ViewLogtimes();"><img 
            src="../images/controlright/logtime.png" title="Add Permisstion" name="new" border="0" align="middle" id="new" /> <br />
            <?php echo $vLangArr[1];?></a></TD>

		  <?php
		  }
		  ?>

		  	 <?php
		 	if(checkright("",$_SESSION['ERPSOFV2RUserID'],"Ad0012","AddP")>0)
			{
		 ?>
         <td>&nbsp;</td>			
          <TD><a class="toolbar" 
            href="javascript:AddPer();"><img src="../images/controlright/config.gif" title="" 
				name="new" border="0" align="middle" id="new" /> <br /><?php echo $vLangArr[2];?></a></TD>
		  <?php
		  }
		  ?>	  

		  	 <?php
		 	if(checkright("",$_SESSION['ERPSOFV2RUserID'],"Ad0012","Add")>0)
			{
		 ?>			
         <td>&nbsp;</td>  
          <TD class=lvtoolbar><a  
            href="javascript:AddUser();"><img alt=New 
            src="../images/lvicon/Add.png" align=middle border=0 name=new> <br><?php echo $vLangArr[3];?></a></TD>
			<?php
			}
			?>


		  	 <?php
		 	if(checkright("",$_SESSION['ERPSOFV2RUserID'],"Ad0012","Edit")>0)
			{
		 ?>			  
         <td>&nbsp;</td>
          <TD class=lvtoolbar><a 
            href="javascript:Edit();"><img 
            alt=Edit src="../images/lvicon/Edt.png" align=middle border=0 
            name=editA> <br><?php echo $vLangArr[4];?></a></TD>
			<?php
			}
			?>

		  <?php
		 	if(checkright("",$_SESSION['ERPSOFV2RUserID'],"Ad0012","Del")>0)
			{
		 ?>	
         <td>&nbsp;</td>
          <TD class=lvtoolbar ><a 
            href="javascript:Delete();"><img 
            alt=Move src="../images/lvicon/Del.png" align=middle border=0 
            name=movesect> <br><?php echo $vLangArr[5];?></a></TD>
		<?php
			}
			?>
			<td>&nbsp;</td>
          <TD><a class=toolbar 
            href="javascript:Reload();"><img 
            alt=Trash src="../images/lvicon/Reload.png" align=middle border=0 
            name=remove> <br><?php echo $vLangArr[6];?></a></TD>
<td>&nbsp;</td>
<TD><A class=toolbar 
            onclick="window.open('http://www.sof.vn/help/', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" 
            href="javascript:Help();"><IMG 
            alt=Help src="../images/lvicon/Help.png" align=middle border=0 
            name=help> <BR><?php echo $vLangArr[7];?></A> </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
  </div>
  <h2 id="pageName"><?php echo $vLangArr[8];?></h2>
  <div class="story">
    <h3>
		
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="?<?php echo $psaveget;?>" name="frmchoose" method="post">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo $curPage;?>">
						<table border="0" cellpadding="1" cellspacing="1" align="center" width="100%">
							<tr>
							  <td height="20px" colspan="6" align="center"><?php echo $vStrMessage;?></td>
							  </tr>
							<tr class="lvhtable">
								<td width="8%" height="20px" align="center"><?php echo $vLangArr[9];?></td>		
							  <td width="8%" align="center">
								<input name="chkall" type="checkbox" id="chkall" onclick="docheckall(this)" value="checkbox" /></td>
							  <td width="20%"><?php echo $vLangArr[10];?></td>
							  <td width="*"><?php echo $vLangArr[11];?></td>
							  <td width="18%" align="center"><?php echo $vLangArr[12];?></td>
							  <td width="10%" align="center"><?php echo $vLangArr[13];?></td>
							  <td width="10%" align="center"><?php echo $vLangArr[20];?></td>	
							  <td width="10%" align="center"><?php echo "Themes";?></td>								  
							</tr>
							<?php
						if($totalRows>0)
						 {
								$vorder=$curRow;
								$tsql="SELECT lv001 ID, lv002 UserGroupID, lv003 UserRight,lv004 UserName,lv006 EmployeeID,lv099 themes FROM lv_lv0007 WHERE 1=1 ".$psqlfix.$vsql." limit $curRow,$maxRows";
								$vresult=db_query($tsql);
							while (($vrow = db_fetch_array ($vresult)))
							   {	$vorder++;	
							?>		
							<tr class="<?php echo ($vorder%2==0)?'lvlinehtable0':'lvlinehtable1'; ?>">
							  <td height="20px" align="center"><?php echo $vorder;?></td>		
							  <td align="center">
								<input name="chkuser" type="checkbox" id="chkuser" onclick="onecheck(this)" value="<?php echo $vrow['ID'];?>" /></td>
							  <td><?php echo $vrow['ID']?></td>
							  <td><?php echo $vrow['UserName']?></td>
							  <td align="center"><?php echo $vrow['UserGroupID']?></td>
							  <td align="center"><?php echo $vrow['UserRight']?></td>
							  <td align="center"><?php echo $vrow['EmployeeID']?></td>	
								<td align="center"><?php echo $vrow['themes']?></td>						  
						  </tr>
						  <?php
							}
						}
						  ?>
						  <tr>
							<td height="20px" colspan="6"><?php echo $paging?></td>
						  </tr>
						</table>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFlag" type="hidden" id="txtFlag" />
						<input type="hidden" name="txtlv001" id="txtlv001" />
						
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
					</form>
					<form action="" name="frmcomtemp" method="post" target="_blank" enctype="multipart/form-data">
						<input type="hidden" name="txtlv001" id="txtlv001" />
						<input type="hidden" name="txtFlagControl" id="txtFlagControl" value="2" />
						<input type="hidden" name="curPg" id="curPg" value="">						
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
					</form>
					<form action="" name="frmfilter" id="frmfilter" id="frmFilter" method="post" enctype="multipart/form-data">
						<input name="txtlv001" type="hidden" id="txtlv001" value="" />
						<input name="txtUserName" type="hidden" id="txtUserName" value="" />
						<input name="cboRight" type="hidden" id="cboRight" value="" />
						<input name="cboGroup" type="hidden" id="cboGroup" value="" />
					</form>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			
	</h3>
  </div>
</div>
<?php
} else {
	include ("permit.php");
}
?>