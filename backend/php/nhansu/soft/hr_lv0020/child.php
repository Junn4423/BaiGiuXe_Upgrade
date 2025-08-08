<?php
session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../librarianconfig.php");	
include("../paras.php");
include("../../clsall/hr_menuemployee.php");
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0101.txt",$plang);
//init object
$mohr_menuemployee=new hr_menuemployee();
//Set variant
$mohr_menuemployee->itemlst=$pitemlst;
$mohr_menuemployee->childlst=$pchildlst;
$mohr_menuemployee->level3lst=$plevel3lst;
$mohr_menuemployee->child3lst=$pchild3lst;
$vEmpName = "";

//Hiện liên kết cần hiễn thị
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
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
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
			break;
		case 2:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
			break;
		case 3:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0)?>";	
			break;
		case 4:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0)?>";	
			break;
		case 24:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,24,0)?>";	
			break;
		case 5:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0)?>";	
			break;
		case 6:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,6,0)?>";	
			break;
		case 7:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,7,0)?>";	
			break;
		case 8:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,8,0)?>";	
			break;
		case 9:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,9,0)?>";	
			break;
		case 10:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,10,0)?>";	
			break;
		case 11:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,11,0)?>";	
			break;
		case 12:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,12,0)?>";	
			break;
		case 13:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,13,0)?>";	
			o.txtFlagDocument.value="1";
			break;
		case 14:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,14,0)?>";	
			o.txtFlagDocument.value="1";
			break;			
		case 15:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,15,0)?>";	
			o.txtFlagDocument.value="1";
			break;
		case 16:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,16,0)?>";	
			o.txtFlagDocument.value="1";
			break;
		case 17:
			o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,17,0)?>";	
			o.txtFlagDocument.value="1";
			break;	
	}
	o.submit();
}

function Cancel(){
	var o=window.parent.document.getElementById('frmchoose');
	o.action="?func=<?php echo $_GET['func'] ?? '';?>"+"&ID=<?php echo  $_GET['ID'] ?? ''?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0)?>";
	o.submit();
}
</script>
<?php
if(trim($_SESSION['ERPSOFV2RUserID'])!="")
{
?>
<body  onkeyup="KeyPublicRun(event)">
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
                <td><TABLE id="toolbar" cellSpacing="0" cellPadding="0" border="0" width="100%">
					<TBODY>
						<TR vAlign="center" align="middle">				
							<td><form name="frmhr_employee" action="#" method="post">
									<select name="cbxoption" tabindex="1" onChange="callchange(this)" style="width:100px">
										<option value="1" <?php echo ($mohr_menuemployee->level3lst==1)?'selected="selected"':'';?> >1.<?php echo $vLangArr[10];?></option>
										<option value="2" <?php echo ((int)$mohr_menuemployee->level3lst==2)?'selected="selected"':'';?>>2.<?php echo $vLangArr[11];?></option>
										<option value="3" <?php echo ((int)$mohr_menuemployee->level3lst==3)?'selected="selected"':'';?>>3.<?php echo $vLangArr[12];?></option>
										<option value="4" <?php echo ((int)$mohr_menuemployee->level3lst==4)?'selected="selected"':'';?>>4.<?php echo $vLangArr[13].'-KT';?></option>
										<option value="24" <?php echo ((int)$mohr_menuemployee->level3lst==24)?'selected="selected"':'';?>>24.<?php echo $vLangArr[13].'-In';?></option>
										<option value="5" <?php echo ((int)$mohr_menuemployee->level3lst==5)?'selected="selected"':'';?>>5.<?php echo $vLangArr[14];?></option>
										<option value="6" <?php echo ((int)$mohr_menuemployee->level3lst==6)?'selected="selected"':'';?>>6.<?php echo $vLangArr[15];?></option>
										<option value="7" <?php echo ((int)$mohr_menuemployee->level3lst==7)?'selected="selected"':'';?>>7.<?php echo $vLangArr[16];?></option>
										<option value="8" <?php echo ((int)$mohr_menuemployee->level3lst==8)?'selected="selected"':'';?>>8.<?php echo $vLangArr[17];?></option>
										<option value="9" <?php echo ((int)$mohr_menuemployee->level3lst==9)?'selected="selected"':'';?>>9.<?php echo $vLangArr[18];?></option>
										<option value="10" <?php echo ((int)$mohr_menuemployee->level3lst==10)?'selected="selected"':'';?>>10.<?php echo $vLangArr[19];?></option>
										<option value="11" <?php echo ((int)$mohr_menuemployee->level3lst==11)?'selected="selected"':'';?>>11.<?php echo $vLangArr[20];?></option>
										<option value="12" <?php echo ((int)$mohr_menuemployee->level3lst==12)?'selected="selected"':'';?>>12.<?php echo $vLangArr[28];?></option>
										<option value="13" <?php echo ((int)$mohr_menuemployee->level3lst==13)?'selected="selected"':'';?>>13.<?php echo $vLangArr[29];?></option>
										<option value="14" <?php echo ((int)$mohr_menuemployee->level3lst==14)?'selected="selected"':'';?>>14.<?php echo $vLangArr[30];?></option>
										<option value="16" <?php echo ((int)$mohr_menuemployee->level3lst==16)?'selected="selected"':'';?>>16.<?php echo $vLangArr[31];?></option>
										<option value="17" <?php echo ((int)$mohr_menuemployee->level3lst==17)?'selected="selected"':'';?>>17.<?php echo $vLangArr[32];?></option>
									</select><br/>
									Chọn thao tác
								<input type="hidden" name="txtEmployeeID" id="txtEmployeeID" value="<?php echo $_SESSION['ERPSOFV2RUserID'];?>" />
								<input type="hidden" name="txtFlagDocument" id="txtFlagDocument" />
							  </form>
							  </td>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==1)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(1);">
								<img src="../images/icon/emergency_contact.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[10];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==2)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(2);">
								<img src="../images/icon/dependants.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[11];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==3)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(3);">
								<img src="../images/icon/immigration.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[12];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==4)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(4);">
								<img src="../images/icon/job.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[13].'-KT';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==24)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(24);">
								<img src="../images/icon/job.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[13].'-In';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==16)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(16);">
								<img src="../images/icon/payment.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[31];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==17)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(17);">
								<img src="../images/icon/payment.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[32];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==5)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(5);">
								<img src="../images/icon/payment.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[14];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==6)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(6);">
								<img src="../images/icon/work_experience.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[15];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==7)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(7);">
								<img src="../images/icon/education.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[16];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==8)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(8);">
								<img src="../images/icon/skills.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[17];?></a></TD>	
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>																																														
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==9)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(9);">
								<img src="../images/icon/languages.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[18];?></a></TD>	
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>																																														
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==10)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(10);">
								<img src="../images/icon/license.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[19];?></a></TD>		
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>																																														
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==11)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(11);">
								<img src="../images/icon/membership.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[20];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==12)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(12);">
								<img src="../images/icon/performance.png" title="<?php echo $vLangArr[100];?>" 
									 alt="perform" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[28];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==13)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(13);">
								<img src="../images/icon/document.png" title="<?php echo $vLangArr[100];?>" 
									 alt="document" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[29];?></a></TD>	
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($mohr_menuemployee->level3lst==14)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(14);">
								<img src="../images/icon/document.png" title="<?php echo $vLangArr[100];?>" 
									 alt="document" border="0" align="middle" width="27" height="27">
								<br><?php echo $vLangArr[30];?></a></TD>	
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>						
							 <TD ><a class="toolbar" href="javascript:Cancel();">
							 	<img src="../images/icon/move_f2.png" alt="Back" name="Back" border="0" 
									align="middle" id="cancel" /> <br /><?php echo $vLangArr[2];?></a></TD>
							
						</TR>
				  </TBODY>
					</TABLE></td>
              </tr>
              <tr>
                <td> </td>
              </tr>
              <tr>
                <td>
				<div id="showparenttext"></div>
				<div id="showparent">
				<div >
	<?php
	$mohr_menuemployee->Dir="../";
include($mohr_menuemployee->GetLinkEmp());
?>
	</div></div></td>
              </tr>
            </table>
	<div id="lvright"></div>
</div>
<script language="javascript">
document.frmhr_employee.cbxoption.value="<?php echo $mohr_menuemployee->level3lst;?>";
document.frmhr_employee.cbxoption.focus();
</script>
</body>
</html>
<?php
} else {
	include("../permit.php");
}
?>
