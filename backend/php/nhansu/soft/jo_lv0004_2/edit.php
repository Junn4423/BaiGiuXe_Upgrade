<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDir="../";
$vDefaultPath="../../../images/employees/";
//require_once("../../clsall/jo_lv0004.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/jo_lv0004.php");
//////////////init object////////////////
$lvjo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvjo_lv0004->lv001= $_GET['ID'] ?? '';
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","JO0006.txt",$plang);
$mojo_lv0004->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
if($vFlag==1)
{
$lvjo_lv0004->lv002=$_POST['txtlv002'];
$lvjo_lv0004->lv003=$_POST['txtlv003'];
$lvjo_lv0004->lv004=$_POST['txtlv004'];
$lvjo_lv0004->lv005=$_POST['txtlv005'];
$lvjo_lv0004->lv006=$_POST['txtlv006'];
if($_FILES['userfile']['name']=="")
$lvjo_lv0004->lv007=$_POST['txtlv007'];
else
$lvjo_lv0004->lv007=$_FILES['userfile']['name'];
$lvjo_lv0004->lv008=$_POST['txtlv008'];
$lvjo_lv0004->lv009=$_POST['txtlv009'];
$lvjo_lv0004->lv010=$_POST['txtlv010'];
$lvjo_lv0004->lv011=$_POST['txtlv011'];
$lvjo_lv0004->lv012=$_POST['txtlv012'];
$lvjo_lv0004->lv013=$_POST['txtlv013'];
$lvjo_lv0004->lv014=$_POST['txtlv014'];
$lvjo_lv0004->lv015=$_POST['txtlv015'];
$lvjo_lv0004->lv016=$_POST['txtlv016'].' '.$_POST['txtlv016_'];
$lvjo_lv0004->lv017=$_POST['txtlv017'].' '.$_POST['txtlv017_'];
$lvjo_lv0004->lv018=$_POST['txtlv018'];
$lvjo_lv0004->lv019=$_POST['txtlv019'];
$lvjo_lv0004->lv020=$_POST['txtlv020'];
$lvjo_lv0004->lv021=$_POST['txtlv021'];
$lvjo_lv0004->lv022=$_POST['txtlv022'];
$lvjo_lv0004->lv023=$_POST['txtlv023'];		
		$vresult=$lvjo_lv0004->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvjo_lv0004->LV_LoadID($lvjo_lv0004->lv001);


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
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[38];?>");
			o.txtlv001.select();
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
if($lvjo_lv0004->GetEdit()>0)
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
					<form action="#" name="frmedit" method="post" enctype="multipart/form-data">
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvjo_lv0004->lv001=="")?InsertWithCheck('jo_lv0004', 'lv001', 'TASK',1):$lvjo_lv0004->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><table width="80%"><tr><td width="50%"><select name="txtlv003" id="txtlv003"   tabindex="5"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvjo_lv0004->LV_LinkField('lv003',$lvjo_lv0004->lv003);?>
							  </select>
							  </td>
							  <td  width="50%">
							  <ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" onFocus="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><table width="80%"><tr><td width="50%"><select name="txtlv002" id="txtlv002"   tabindex="5"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvjo_lv0004->LV_LinkField('lv002',$lvjo_lv0004->lv002);?>
							  </select>
							  </td>
							  <td  width="50%">
							  <ul id="pop-nav77" lang="pop-nav77" onkeyup="ChangeName(this,77)" onMouseOver="ChangeName(this,77)" onkeyup="ChangeName(this,77)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv002_search" id="txtlv002_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" onFocus="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" tabindex="200" >
							    <div id="lv_popup77" lang="lv_popup77"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[36];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
								<select name="txtlv022" id="txtlv022"   tabindex="5"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
										<?php echo $lvjo_lv0004->LV_LinkField('lv022',$lvjo_lv0004->lv022);?>
									</select>
							  </td><td>
							  <ul id="pop-nav66" lang="pop-nav66" onkeyup="ChangeName(this,66)" onMouseOver="ChangeName(this,66)" onkeyup="ChangeName(this,66)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv015_search" id="txtlv015_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv022','jo_lv0100','lv002')" onFocus="LoadPopup(this,'txtlv022','jo_lv0100','lv002')" tabindex="200" >
							    <div id="lv_popup66" lang="lv_popup66"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>							
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><textarea rows="5" name="txtlv008" id="txtlv008"   tabindex="7"  style="width:80%"><?php echo $lvjo_lv0004->lv008;?></textarea></td>
						    </tr>
						    <tr>
								<td width="196"  height="20"><?php echo $vLangArr[27];?></td>
								<td   height="20">
								<table width="80%"><tr><td width="50%">
									<input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvjo_lv0004->lv013;?>" readonly="true" tabindex="8" maxlength="500" style="width:100%" onKeyPress="return CheckKey(event,7)"/>	
								</td><td>
							  <ul id="pop-nav4" lang="pop-nav4" onkeyup="ChangeName(this,4)" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv013_search" id="txtlv013_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv013','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv013','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
							  <input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvjo_lv0004->lv015;?>" tabindex="9" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/>
							  </td><td>
							  <ul id="pop-nav6" lang="pop-nav6" onkeyup="ChangeName(this,6)" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv015_search" id="txtlv015_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv015','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv015','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[30];?></td>
				  <td  height="20"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv016);return false;"   name="txtlv016" type="text" id="txtlv016" value="<?php echo $lvjo_lv0004->FormatView($lvjo_lv0004->lv016,2);?>" tabindex="20" maxlength="255" style="width:40%"/><input   name="txtlv016_" type="text" id="txtlv016_" value="<?php echo substr($lvjo_lv0004->lv016,11,8);?>" tabindex="20" maxlength="255" style="width:40%" onKeyPress="return CheckKey(event,7)"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv016);return false;" /></span></td>
						  </tr>		
                          <tr>
							  <td  height="20"><?php echo $vLangArr[31];?></td>
							  <td  height="20"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv017);return false;"  name="txtlv017" type="text" id="txtlv017" value="<?php echo trim($lvjo_lv0004->FormatView($lvjo_lv0004->lv017,2));?>" tabindex="21" maxlength="50" style="width:40%" onKeyPress="return CheckKey(event,7)"><input   name="txtlv017_" type="text" id="txtlv017_" value="<?php echo substr($lvjo_lv0004->lv017,11,8);?>" tabindex="20" maxlength="255" style="width:40%" onKeyPress="return CheckKey(event,7)"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv017);return false;" /></span></td>
							  </tr>		
						<tr>
								<td width="196"  height="20"><?php echo $vLangArr[32];?></td>
								<td   height="20">
									<input name="txtlv018" id="txtlv018"   tabindex="22"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo trim($lvjo_lv0004->FormatView($lvjo_lv0004->lv018,4));?>" onfocus="if(document.frmedit.txtlv018.value=='') document.frmedit.txtlv018.value=document.frmedit.txtlv016.value+' '+document.frmedit.txtlv016_.value;"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv018);return false;" /></span></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[33];?></td>
							  <td  height="20"><input name="txtlv019" id="txtlv019" style="width:80%" tabindex="23" onKeyPress="return CheckKey(event,7)" value="<?php echo trim($lvjo_lv0004->FormatView($lvjo_lv0004->lv019,4));?>" onfocus="if(document.frmedit.txtlv019.value=='') document.frmedit.txtlv019.value=document.frmedit.txtlv017.value+' '+document.frmedit.txtlv017_.value;"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv019);return false;" /></span></td>
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
				</td>
				<td background="../images/pictures/table_r2_c3.gif">
					<img name="table_r2_c3" src="../images/pictures/spacer.gif" 
						width="1" height="1" border="0" alt=""></td>
				<td><img src="../images/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
			</tr>
			<tr>
				<td>
					<img name="table_r3_c1" src="../images/pictures/table_r3_c1.gif" 
						width="13" height="16" border="0" alt=""></td>
				<td background="../images/pictures/table_r3_c2.gif">
					<img name="table_r3_c2" src="../images/pictures/spacer.gif" 
						width="1" height="1" border="0" alt=""></td>
				<td>
					<img name="table_r3_c3" src="../images/pictures/table_r3_c3.gif" 
						width="13" height="16" border="0" alt=""></td>
				<td><img src="../images/pictures/spacer.gif" width="1" height="16" border="0" alt=""></td>
			</tr>
		</table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmedit;
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