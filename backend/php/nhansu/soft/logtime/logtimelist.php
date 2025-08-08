<?php
include("paras.php");
if($plang=="")  $plang="EN";
$vLangArr=GetLangFile("../","AD0029.txt",$plang);
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
//////////////////////////////////////////////////////////////////////////////////////////////////////
//$ma=$_GET['ma'];
$psql = $_POST['txtSQL'];
$vUserID=$_POST['txtlv001'];
if($vUserID=="" || $vUserID==NULL) $vUserID=$_SESSION['ERPSOFV2RUserID'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$flagControl=(int)$_POST['txtFlagControl'];
$vStrMessage="";
if($flagID==1)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$sql="DELETE FROM log WHERE log.ID IN (".$strar.") ";
	db_query($sql);
	$vStrMessage=GetNoDelete($strar,"log");
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
$sqlTmp = " AND UserID='$vUserID' Order by LoginDate, LoginTime DESC ";
$sqlC = "SELECT COUNT(*) AS nums FROM log WHERE 1=1 ".$sqlTmp;
$bResultC = db_query($sqlC);
$arrRowC = db_fetch_array($bResultC);
$totalRowsC = $arrRowC['nums'];
$curPage = (int)$_POST['curPg'];
$maxRows = 10;
$maxPages = 10;
if($curPage=="") $curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<script language="javascript">
function Cancel()
{
	var o =document.frmchoose;
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>";
	o.target="_self";
	o.submit();
}
function DelByDate()
{
	var o =document.frmBlank;
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,1,0,0);?>"
	//o.target="_self";
	o.submit();
}
</script>
<?php
if(1==1)
{
?>
<div id="content_child">
  <div id="breadCrumb">
  <TABLE class=menubar cellSpacing=0 cellPadding=0 width="101%" border=0>
  <TBODY>
  <TR>
    <TD class=menudottedline width="20%">
      <DIV class=pathway></DIV></TD>
    <TD class=menudottedline align=right>
      <TABLE id=toolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
          <TD>&nbsp;</TD>
          <TD>&nbsp;</TD>
          <TD>&nbsp;</TD>
		  	<?php
		 	if(checkright("",$_SESSION['ERPSOFV2RUserID'],'Ad0014',"Del")>0)
			{
		 	?>
		  	<TD><a class=toolbar 
            	href="javascript:DelByDate();"><img alt=Move src="../images/controlright/trush.gif" align=middle border=0 
            	name=movesect> <br><?php echo $vLangArr[11];?></a></TD>
			<?php
			}
			?>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->
		  <?php
		 	if(checkright("",$_SESSION['ERPSOFV2RUserID'],'Ad0014',"Del")>0)
			{
		 ?>			  
          <TD><a class=toolbar 
            href="javascript:open_del('logtime/logtimelist.php','<?php echo  $ma;?>');"><img 
            alt=Move src="../images/controlright/trush.gif" align=middle border=0 
            name=movesect> <br><?php echo $vLangArr[2];?></a></TD>
		<?php
		}
		?>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->
		<?php 
			if($flagControl==2)
			{
		?>		
          <TD><a class="toolbar" href="javascript:Cancel();"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" 
            border="0" align="middle" id="cancel" /> <br />
            <?php echo $vLangArr[1];?></a></TD>
		<?php
			}
		?>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->
          <TD><a class=toolbar 
            href="document.frmchoose.submit();"><img 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <br>
<?php echo $vLangArr[3];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->
<TD><A class=toolbar 
            onclick="window.open('http://sof.vnindex2.php?option=com_content&amp;task=findkey&amp;pop=1&amp;keyref=screen.content', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" 
            href="http://www.sof.vn?option=com_content&amp;sectionid=0#"><IMG 
            alt=Help src="../images/controlright/help.gif" align=middle border=0 
            name=help> <BR><?php echo $vLangArr[4];?></A> </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
  </div>
  <h2 id="pageName"><?php echo $vLangArr[5];?></h2>
   <div class="story">
    <h3>
		
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="?<?php echo $psaveget;?>" name="frmchoose" method="post">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo $curPage;?>"/>
						<table border="0" cellpadding="1" cellspacing="1" align="center" width="100%" class="lvtable">
							<tr>
							  <td colspan="6" align="center"><?php echo $vStrMessage;?></td>
							  </tr>
							<tr class="lvhtable" >
								<td width="10%" height="20px" align="center" class="lvhtable"><?php echo $vLangArr[6];?></td>		
							  <td width="5%" height="20px" align="center"  class="lvhtable">
								<input name="chkall" type="checkbox" id="chkall" onclick="docheckall(this)" value="checkbox" /></td>
							  <td width="10%" height="20px" align="center"  class="lvhtable"> <?php echo $vLangArr[7];?> </td>
							  <td width="10%" height="20px" align="center"  class="lvhtable"> <?php echo 'User';?> </td>
							  <td width="25%" height="20px" align="center"  class="lvhtable"><?php echo $vLangArr[8];?></td>
							  <td width="25%" align="center"  class="lvhtable"><?php echo $vLangArr[9];?></td>
							  <td width="*" align="center"  class="lvhtable"><?php echo $vLangArr[10];?></td>
							</tr>
							<?php
							if($totalRowsC>0){
								$sqlS = "SELECT * FROM log WHERE 1=1 ".$sqlTmp." LIMIT $curRow, $maxRows";
								$vorder=$curRow;
								$bResult = db_query($sqlS);
								while ($vrow = db_fetch_array ($bResult)){
								$vorder++;	
							?>
							<tr>
							  <td class="lvlinehtable<?php echo (($vorder%2)==1)?1:0;?>" height="20px" align="center"><?php echo $vorder;?></td>		
							  <td class="lvlinehtable<?php echo (($vorder%2)==1)?1:0;?>" height="20px" align="center">
								<input name="chkuser" type="checkbox" id="chkuser" onclick="onecheck(this)" value="<?php echo $vrow['ID'];?>" /></td>
							  <td class="lvlinehtable<?php echo (($vorder%2)==1)?1:0;?>" height="20px" align="center"><?php echo $vrow['ID']?></td>
							  <td class="lvlinehtable<?php echo (($vorder%2)==1)?1:0;?>" height="20px" align="center"><?php echo $vrow['UserID']?></td>
							  <td class="lvlinehtable<?php echo (($vorder%2)==1)?1:0;?>" height="20px" align="center"><?php echo formatdate($vrow['LoginDate'], $plang)?></td>
							  <td class="lvlinehtable<?php echo (($vorder%2)==1)?1:0;?>" height="20px" align="center"><?php echo $vrow['LoginTime']?></td>
							  <td class="lvlinehtable<?php echo (($vorder%2)==1)?1:0;?>" height="20px" align="center"><?php echo $vrow['State']?></td>
						  	</tr>
						  	<?php
								}
							}
							?>
						  	<tr>
								<td height="20px" colspan="6"><?php echo $paging?></td>
						 	</tr>
						</table>
						<input type="hidden" name="txtlv001" value="<?php echo $vUserID;?>" />
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFlag" type="hidden" id="txtFlag" />
						<input name="txtFlagControl" type="hidden" id="txtFlagControl" value="<?php echo $flagControl;?>" />
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
					</form>
					<form action="department/departmentedit.php" name="frmcomtemp" method="post" target="_blank">
						<input type="hidden" name="txtDepartmentID" id="txtDepartmentID" />
						<input type="hidden" name="txtlv001" value="<?php echo $vUserID;?>" />
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
					</form>
					<form action="" id="frmBlank" name="frmBlank" method="post">
						<input type="hidden" name="txtlv001" value="<?php echo $vUserID;?>" />					
						<input type="hidden" id="txtBlank" name="txtBlank" value="" />
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
						<input type="hidden" name="txtFlagControl" id="txtFlagControl" value="<?php echo $flagControl;?>" />
					</form>
				
  </div>
</div>
<?php
} else {
	include ("permit.php");
}
?>