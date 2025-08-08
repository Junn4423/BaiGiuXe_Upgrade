<?php
session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../librarianconfig.php");	
include("../paras.php");
include("../../clsall/ki_menu0008.php");

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","KI0010.txt",$plang);
//init object
$moki_menu0008=new ki_menu0008();
//Set variant
$moki_menu0008->itemlst=$pitemlst;
$moki_menu0008->childlst=$pchildlst;
$moki_menu0008->level3lst=$plevel3lst;
$moki_menu0008->child3lst=$pchild3lst;
$vEmpName = "";

//Hiện liên kết cần hiễn thị
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF V2.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/menu.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/pubscript.js"></script>
<script language="javascript" src="../../javascripts/menuvertical.js"></script>
</head>
<script language="javascript" type="text/javascript">
function callchange(o)
{
rundisplayLayer(parseInt(o.value));
}
function rundisplayLayer(vOpt)
{
var o=document.frmhr_employee;
o.cbxoption.value=vOpt;
o.target="_self";
	switch(vOpt) {
		case 1:
			o.action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&childfunc=<?php echo $_GET['childfunc']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
			break;
		
				
	}
	o.submit();
}
function Cancel(){
	var o=window.parent.document.getElementById('frmchoose');
	o.action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&childfunc=<?php echo $_GET['childfunc']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0)?>";
	o.submit();
}
</script>
<?php
if(trim($_SESSION['ERPSOFV2RUserID'])!="")
{
?><body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
	<div id="top-nav">
	 
		<TABLE class="menubar" cellSpacing="0" cellPadding="0" width="100%" border="0">
		<TBODY>
			<TR>
			  <TD class="lvtitle" id="lvtitlelist"></TD>
			</TR>
		  </TBODY>
		</TABLE>
	</div>
	<h2 id="pageName"></h2>

			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			<table width="100%" border="0">
              <tr>
                <td><TABLE id="toolbar" cellSpacing="0" cellPadding="0" border="0">
					<TBODY>
						<TR vAlign="center" align="middle">				
							<td><form name="frmhr_employee" action="#" method="post">
								<select name="cbxoption" tabindex="1" onChange="callchange(this)" style="width:100px">
									<option value="1" <?php echo ($moki_menu0008->level3lst==1)?'selected="selected"':'';?> >1.<?php echo $vLangArr[8];?></option>
								</select><br/>
									Chọn thao tác
								<input type="hidden" name="txtEmployeeID" id="txtEmployeeID" value="<?php echo $_SESSION['ERPSOFV2RUserID'];?>" />
								<input type="hidden" name="txtFlagDocument" id="txtFlagDocument" />
							  </form>
							 </td>	
		
							<TD><a class="toolbar" href="javascript:rundisplayLayer(1);">
								<img src="../images/controlright/emergency_contact.gif" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[8];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>						
							 <TD ><a class="toolbar" href="javascript:Cancel();">
							 	<img src="../images/icon/move_f2.png" alt="Back" name="Back" border="0" 
									align="middle" id="cancel" /> <br /><?php echo $vLangArr[2];?></a></TD>
						</TR>
				  </TBODY>
					</TABLE></td>
              </tr>
             <tr><td><div ><div id="showparenttext"></div><div id="showparent">
	<?php
	$moki_menu0008->Dir="../";
include($moki_menu0008->GetLinkEmp());
?>
	</div></div></td></tr></table>
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			
	<div id="lvright"></div>
</div>
<script language="javascript">
document.frmhr_employee.cbxoption.value="<?php echo $moki_menu0008->level3lst;?>";
document.frmhr_employee.cbxoption.focus();
</script>
</body>
</html>
<?php
} else {
	include("../permit.php");
}
?>
