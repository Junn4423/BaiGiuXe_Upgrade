<?php
session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../librarianconfig.php");	
require_once("../paras.php");
require_once("../../clsall/mn_menusl0020.php");

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0028.txt",$plang);
//init object
$mn_menusl0020=new mn_menusl0020();
$mn_menusl0020->TypePO=$_GET['TypePO'];
//Set variant
$mn_menusl0020->itemlst=$pitemlst;
$mn_menusl0020->childlst=$pchildlst;
$mn_menusl0020->level3lst=$plevel3lst;
$mn_menusl0020->child3lst=$pchild3lst;
$mn_menusl0020->TypePO=$_GET['TypePO'];
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
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
			break;
		case 2:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
			break;
		case 3:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0)?>";	
			break;
		case 4:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0)?>";	
			break;
		case 5:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0)?>";	
			break;
		case 6:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,6,0)?>";	
			break;
		case 7:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,7,0)?>";	
			break;	
		case 8:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,8,0)?>";	
			break;
		case 9:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,9,0)?>";	
			break;	
		case 10:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>&ChildDetailID=<?php echo $_GET['ChildDetailID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,10,0)?>";	
			break;		
		case 24:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID=<?php echo $_GET['ChildID']?>&ChildDetailID=<?php echo $_GET['ChildDetailID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,24,0)?>";	
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
				<TD class="lvtitle" id="lvtitlelist"></TD>
			</TR>
		  </TBODY>
		</TABLE>
	</div>
	
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			<table width="100%" border="0">
              <tr>
                <td><TABLE id="toolbar" cellSpacing="0" cellPadding="0" border="0">
					<TBODY>
						<TR vAlign="center" align="middle">		
							<td> 
								<form name="frmhr_employee" action="#" method="post">
									<select name="cbxoption" tabindex="1" onChange="callchange(this)">
										<!--<option value="9" <?php echo ($mn_menusl0020->level3lst==9)?'selected="selected"':'';?> >9.<?php echo 'QA KQ PTH';?></option>-->
										<option value="1" <?php echo ($mn_menusl0020->level3lst==1)?'selected="selected"':'';?> >1.<?php echo $vLangArr[8];?></option>
										<option value="10" <?php echo ((int)$mn_menusl0020->level3lst==10)?'selected="selected"':'';?>>1.<?php echo 'Chi tiết PO';?></option>
										<!--<option value="5" <?php echo ((int)$mn_menusl0020->level3lst==5)?'selected="selected"':'';?>>2.<?php echo $vLangArr[12];?></option>-->
										<option value="2" <?php echo ((int)$mn_menusl0020->level3lst==2)?'selected="selected"':'';?>>2.<?php echo $vLangArr[9];?></option>
										<!--<option value="7" <?php echo ((int)$mn_menusl0020->level3lst==7)?'selected="selected"':'';?>>4.<?php echo 'Đề nghị nhập kho';?></option>
										<option value="4" <?php echo ((int)$mn_menusl0020->level3lst==4)?'selected="selected"':'';?>>5.<?php echo 'Nhập kho';?></option>-->
										<option value="6" <?php echo ((int)$mn_menusl0020->level3lst==6)?'selected="selected"':'';?>>3.<?php echo 'Lần thanh toán';?></option>
										<option value="8" <?php echo ((int)$mn_menusl0020->level3lst==8)?'selected="selected"':'';?>>4.<?php echo 'Đề nghị chi tiền';?></option>
										<option value="3" <?php echo ((int)$mn_menusl0020->level3lst==3)?'selected="selected"':'';?>>5.<?php echo $vLangArr[10];?></option>
										<option value="24" <?php echo ((int)$mn_menusl0020->level3lst==24)?'selected="selected"':'';?>>6.<?php echo 'ĐNVT';?></option>
									</select>
									<input type="hidden" name="txtEmployeeID" id="txtEmployeeID" value="<?php echo $_SESSION['ERPSOFV2RUserID'];?>" />
									<input type="hidden" name="txtFlagDocument" id="txtFlagDocument" />
								</form>
							</td>		
							<!--
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='9')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(9);">
								<img src="../images/icon/payment.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'QA KQ PTH';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>-->
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='1')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(1);">
								<img src="../images/icon/detail.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Chị tiết mặt hàng';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='10')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(10);">
								<img src="../images/icon/detail.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Chi tiết PO';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<!--
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='5')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(5);">
								<img src="../images/icon/detail.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[12];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>-->
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='2')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(2);">
								<img src="../images/icon/document.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[9];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<!--
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='7')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(7);">
								<img src="../images/icon/pricelist.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Đề nghị nhập kho';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='4')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(4);">
								<img src="../images/icon/pricelist.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Nhập kho';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							-->
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='6')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(6);">
								<img src="../images/icon/solan.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[13];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='8')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(8);">
								<img src="../images/icon/payment.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Đề nghị chi tiền';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='3')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(3);">
								<img src="../images/icon/payment.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[10];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD><a style="<?php echo ($mn_menusl0020->level3lst=='24')?'color:red!important;':'';?>" class="toolbar" href="javascript:rundisplayLayer(24);">
								<img src="../images/icon/pricelist.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'ĐNVT';?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							 <TD><a class="toolbar" href="javascript:Cancel();">
							 	<img src="../images/controlright/move_f2.png" alt="Back" name="Back" border="0" 
									align="middle" id="cancel" /> <br /><?php echo $vLangArr[2];?></a></TD>
						</TR>
				  </TBODY>
					</TABLE></td>
             
              <tr>
                <td><div >
	<?php
	$mn_menusl0020->Dir="../";
include($mn_menusl0020->GetLinkEmp());
?>
	</div></td>
              </tr>
            </table
			>
			
	<div id="lvright"></div>
</div>
<script language="javascript">
document.frmhr_employee.cbxoption.value="<?php echo $mn_menusl0020->level3lst;?>";
document.frmhr_employee.cbxoption.focus();
</script>
</body>
</html>
<?php
} else {
	include("../permit.php");
}
?>
