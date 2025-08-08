<?php
session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../librarianconfig.php");	
require_once("../paras.php");
require_once("../../clsall/tc_menusl0013.php");

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0013.txt",$plang);
//init object
$tc_menusl0013=new tc_menusl0013();
//Set variant
$tc_menusl0013->itemlst=$pitemlst;
$tc_menusl0013->childlst=$pchildlst;
$tc_menusl0013->level3lst=$plevel3lst;
$tc_menusl0013->child3lst=$pchild3lst;

//Hiện liên kết cần hiễn thị
?>
<br>
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
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
			break;
		case 2:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
			break;
		case 3:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0)?>";	
			break;
		case 4:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0)?>";	
			break;
		case 5:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0)?>";	
			break;		
		case 6:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,6,0)?>";	
			break;	
		case 7:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,7,0)?>";	
			break;	
		case 8:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,8,0)?>";	
			break;
		case 15:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,15,0)?>";	
			break;
		case 31:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,31,0)?>";	
			break;
		case 32:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,32,0)?>";	
			break;
		case 33:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,33,0)?>";	
			break;
	}
	o.submit();
}

function Cancel(){ var o=window.parent.document.getElementById('frmchoose');
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
	o.target="_self";
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
			  <TD class="lvtitle" id="lvtitlelist">&nbsp; </TD>
			</TR>
		  </TBODY>
		</TABLE>
	</div>
	
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			<table width="100%" border="0">
              <tr>
                <td><TABLE id="toolbar" cellSpacing="0" cellPadding="0" border="0" width="100%">
					<TBODY>
						<TR vAlign="center" align="middle">	
							 <td> <form name="frmhr_employee" action="#" method="post">
	 			 	<select name="cbxoption" tabindex="1" onChange="callchange(this)" style="width:150px">
					  	<option value="31" <?php echo ($tc_menusl0013->level3lst==31)?'selected="selected"':'';?> >1.<?php echo 'Đề nghị chi tiền';?></option>
						<option value="32" <?php echo ($tc_menusl0013->level3lst==32)?'selected="selected"':'';?> >2.<?php echo 'Phiếu chi';?></option>
						<option value="33" <?php echo ($tc_menusl0013->level3lst==33)?'selected="selected"':'';?> >3.<?php echo 'Bảo Hiểm';?></option>
						<!--<option value="1" <?php echo ($tc_menusl0013->level3lst==1)?'selected="selected"':'';?> >1.<?php echo $vLangArr[8];?></option>
						<option value="2" <?php echo ((int)$tc_menusl0013->level3lst==2)?'selected="selected"':'';?>>2.<?php echo $vLangArr[9];?></option>
						<option value="3" <?php echo ((int)$tc_menusl0013->level3lst==3)?'selected="selected"':'';?>>3.<?php echo $vLangArr[10];?></option>
                        <option value="4" <?php echo ((int)$tc_menusl0013->level3lst==4)?'selected="selected"':'';?>>4.<?php echo $vLangArr[11];?></option>-->
                        <option value="5" <?php echo ((int)$tc_menusl0013->level3lst==5)?'selected="selected"':'';?>>4.<?php echo $vLangArr[12];?></option>
						<!--<option value="6" <?php echo ((int)$tc_menusl0013->level3lst==2)?'selected="selected"':'';?>>6.<?php echo $vLangArr[13];?></option>
						<option value="7" <?php echo ((int)$tc_menusl0013->level3lst==7)?'selected="selected"':'';?>>7.<?php echo 'Thai sản';?></option>
						<option value="8" <?php echo ((int)$tc_menusl0013->level3lst==8)?'selected="selected"':'';?>>8.<?php echo 'Nạp lương';?></option>-->
						<option value="15" <?php echo ((int)$tc_menusl0013->level3lst==15)?'selected="selected"':'';?>>15.<?php echo 'Lương thưởng';?></option>
					</select>
	    <input type="hidden" name="txtEmployeeID" id="txtEmployeeID" value="<?php echo $_SESSION['ERPSOFV2RUserID'];?>" />
		<input type="hidden" name="txtFlagDocument" id="txtFlagDocument" /> </form><br/>Chọn thông số</td> 
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==31)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(31);">
								<img src="../images/controlright/timecard.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Đề nghị chi tiền';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==32)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(32);">
								<img src="../images/icon/outcome.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Chi tiền';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==33)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(33);">
								<img src="../images/icon/payment.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Bảo hiểm';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<!--<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==1)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(1);">
								<img src="../images/controlright/timecard.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[8];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==2)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(2);">
								<img src="../images/controlright/priceproduct.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[9];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==3)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(3);">
								<img src="../images/controlright/ratetc.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[10];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>		
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==4)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(4);">
								<img src="../images/controlright/hesok.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[11];?></a></TD>
                             <TD>&nbsp;</TD>
							<TD>&nbsp;</TD>		
-->
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==5)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(5);">
								<img src="../images/controlright/setproduct.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[12];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>		
							<!--	
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==6)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(6);">
								<img src="../images/controlright/monthly.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[13];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>			
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==7)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(7);">
								<img src="../images/controlright/monthly.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Trạng thái thưởng';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>			
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==8)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(8);">
								<img src="../images/controlright/monthly.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Tải lương';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>			
-->
							<TD class="toolbar_<?php echo ($tc_menusl0013->level3lst==15)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(15);">
								<img src="../images/controlright/icon_money_large.gif" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Tính thưởng tháng 13';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							 <TD><a class="toolbar" href="javascript:Cancel();">
							 	<img src="../images/controlright/move_f2.png" alt="Back" name="Back" border="0" 
									align="middle" id="cancel" /> <br /><?php echo $vLangArr[2];?></a></TD>
							<TD width="*">&nbsp;</TD>
						</TR>
				  </TBODY>
					</TABLE></td>
              </tr>
              <tr><td><div ><div id="showparenttext"></div><div id="showparent">
	<?php
	$tc_menusl0013->Dir="../";
include($tc_menusl0013->GetLinkEmp());
?>
	</div></div></td></tr></table>
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			
	<div id="lvright"></div>
</div>
<script language="javascript">
document.frmhr_employee.cbxoption.value="<?php echo $tc_menusl0013->level3lst;?>";
document.frmhr_employee.cbxoption.focus();
</script>
</body>
</html>
<?php
} else {
	include("../permit.php");
}
?>
