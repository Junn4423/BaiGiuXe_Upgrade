<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../../images/employees/";
//require_once("../../clsall/tc_lv0061.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0061.php");
//////////////init object////////////////
$lvtc_lv0061=new tc_lv0061($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0061');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvtc_lv0061->lv001= $_GET['ID'] ?? '';
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0101.txt",$plang);
$lvtc_lv0061->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
if($vFlag==1)
{
$lvtc_lv0061->lv002=$_POST['txtlv002'];
$lvtc_lv0061->lv003=$_POST['txtlv003'];
$lvtc_lv0061->lv004=$_POST['txtlv004'];
$lvtc_lv0061->lv005=$_POST['txtlv005'];
$lvtc_lv0061->lv006=$_POST['txtlv006'];
if($_FILES['userfile']['name']=="")
$lvtc_lv0061->lv007=$_POST['txtlv007'];
else
$lvtc_lv0061->lv007=$_FILES['userfile']['name'];
$lvtc_lv0061->lv008=$_POST['txtlv008'];
$lvtc_lv0061->lv009=$_POST['txtlv009'];
$lvtc_lv0061->lv010=$_POST['txtlv010'];
$lvtc_lv0061->lv011=$_POST['txtlv011'];
$lvtc_lv0061->lv012=$_POST['txtlv012'];
$lvtc_lv0061->lv013=$_POST['txtlv013'];
$lvtc_lv0061->lv014=$_POST['txtlv014'];
$lvtc_lv0061->lv015=$_POST['txtlv015'];
$lvtc_lv0061->lv016=$_POST['txtlv016'];
$lvtc_lv0061->lv017=$_POST['txtlv017'];
$lvtc_lv0061->lv018=$_POST['txtlv018'];
$lvtc_lv0061->lv019=$_POST['txtlv019'];
$lvtc_lv0061->lv020=$_POST['txtlv020'];
$lvtc_lv0061->lv021=$_POST['txtlv021'];
$lvtc_lv0061->lv022=$_POST['txtlv022'];
$lvtc_lv0061->lv023=$_POST['txtlv023'];		
		$vresult=$lvtc_lv0061->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvtc_lv0061->LV_LoadID($lvtc_lv0061->lv001);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script></head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789.()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmedit;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmedit;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmedit;
		 if(o.txtlv002.value==""){
				alert("<?php echo $vLangArr[36];?>");
				o.txtlv002.focus();
				}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}

-->
</script>
<?php
if($lvtc_lv0061->GetEdit()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
    <h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f1f1f1">
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
					<form action="#" name="frmedit" id="frmedit" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvtc_lv0061->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
						    </tr>
							 <tr>
								<td width="166"  height="20"><?php echo $vLangArr[16];?></td>
								<td width="178"  height="20">
									<input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvtc_lv0061->lv002;?>" tabindex="5" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
						    </tr>
							  <tr>
								<td width="166"  height="20"><?php echo $vLangArr[17];?></td>
								<td width="178"  height="20">
									<input name="txtlv003" type="text" id="txtlv003"  value="<?php echo $lvtc_lv0061->FormatView($lvtc_lv0061->lv003,2);?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>	
									 <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv003);return false;" /></span></td>
					      </tr>
							
							<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
							  <td  height="20"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvtc_lv0061->FormatView($lvtc_lv0061->lv004,2);?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv004);return false;" /></span></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" rows="5" id="txtlv006" style="width:80%" tabindex="23" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvtc_lv0061->lv006;?>"/></td>
						    </tr>
							
						<tr>
							  <td  height="20" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="47"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="48"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>	

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript"> /*var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);*/
		o.txtlv001.focus();
</script>
<script language="javascript" src="../../javascripts/menupopup.js"></script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		Cancel();
	//-->
	</script>
	<?php
	}
	?>
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>