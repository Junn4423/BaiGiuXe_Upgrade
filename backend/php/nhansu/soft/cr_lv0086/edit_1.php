<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../images/employees/";
//require_once("../../clsall/cr_lv0086_1.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/cr_lv0086_1.php");
//////////////init object////////////////
$lvcr_lv0086_1=new cr_lv0086_1($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0086');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if(isset($_GET['ajax']))
{
	$vcusid=$_GET['cusid'];
	echo '[CHECK]';
	echo '<select name="txtlv004" id="txtlv004"   tabindex="8"  style="width:80%" onkeypress="return CheckKeys(event,1,this)" />'.$lvcr_lv0086_1->LV_LinkFieldExt('lv004',$vcusid).'</select>	';
	echo '[ENDCHECK]';
	exit;
}	
$lvcr_lv0086_1->lv001=$_GET['ChildID'];
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SP0012.txt",$plang);
$mocr_lv0086_1->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
if($vFlag==1)
{
$lvcr_lv0086_1->lv002=$_POST['txtlv002'];
$lvcr_lv0086_1->lv003=$_POST['txtlv003'];
$lvcr_lv0086_1->lv004=$_POST['txtlv004'];
$lvcr_lv0086_1->lv005=$_POST['txtlv005'];
$lvcr_lv0086_1->lv006=$_POST['txtlv006'];
$lvcr_lv0086_1->lv007=$_POST['txtlv007'];
$lvcr_lv0086_1->lv008=$_POST['txtlv008'];
$lvcr_lv0086_1->lv009=$_POST['txtlv009'];
$lvcr_lv0086_1->lv010=$_POST['txtlv010'];
$lvcr_lv0086_1->lv011=$_POST['txtlv011'];
$lvcr_lv0086_1->lv012=$_POST['txtlv012'];
$lvcr_lv0086_1->lv013=$_POST['txtlv013'];
$lvcr_lv0086_1->lv014=$_POST['txtlv014'];
$lvcr_lv0086_1->lv015=$_POST['txtlv015'];
$lvcr_lv0086_1->lv016=$_POST['txtlv016'];
$lvcr_lv0086_1->lv017=$_POST['txtlv017'];
$lvcr_lv0086_1->lv018=$_POST['txtlv018'];
$lvcr_lv0086_1->lv019=$_POST['txtlv019'];
$lvcr_lv0086_1->lv020=$_POST['txtlv020'];
$lvcr_lv0086_1->lv021=$_POST['txtlv021'];
$lvcr_lv0086_1->lv022=$_POST['txtlv022'];
$lvcr_lv0086_1->lv023=$_POST['txtlv023'];
$lvcr_lv0086_1->lv024=$_POST['txtlv024'];
$lvcr_lv0086_1->lv025=$_POST['txtlv025'];
$lvcr_lv0086_1->lv026=$_POST['txtlv026'];
$lvcr_lv0086_1->lv027=$_POST['txtlv027'];
$lvcr_lv0086_1->lv028=$_POST['txtlv028'];
$lvcr_lv0086_1->lv029=$_POST['txtlv029'];
$lvcr_lv0086_1->lv030=$_POST['txtlv030'];
$lvcr_lv0086_1->lv031=$_POST['txtlv031'];
$lvcr_lv0086_1->lv032=$_POST['txtlv032'];
$lvcr_lv0086_1->lv033=$_POST['txtlv033'];
$lvcr_lv0086_1->lv034=$_POST['txtlv034'];
$lvcr_lv0086_1->lv035=$_POST['txtlv035'];
$lvcr_lv0086_1->lv036=$_POST['txtlv036'];
$lvcr_lv0086_1->lv037=$_POST['txtlv037'];
$lvcr_lv0086_1->lv038=$_POST['txtlv038'];
$lvcr_lv0086_1->lv039=$_POST['txtlv039'];
$lvcr_lv0086_1->lv040=$lvcr_lv0086_1->DateCurrent;
$lvcr_lv0086_1->lv041=$_POST['txtlv041'];
$lvcr_lv0086_1->lv042=$_POST['txtlv042'];
$lvcr_lv0086_1->lv043=$_POST['txtlv043'];
$lvcr_lv0086_1->lv044=getInfor($_SESSION['ERPSOFV2RUserID'],2);;
$lvcr_lv0086_1->lv045=$_POST['txtlv045'];
$lvcr_lv0086_1->lv046=$_POST['txtlv046'];
$lvcr_lv0086_1->lv047=$_POST['txtlv047'];
$lvcr_lv0086_1->lv048=$_POST['txtlv048'];
$lvcr_lv0086_1->lv049=$_POST['txtlv049'];
$lvcr_lv0086_1->lv050=$_POST['txtlv050'];
$lvcr_lv0086_1->lv051=$_POST['txtlv051'];
		$lvsp_lv0007->LV_LoadActiveId($_POST['txtlv002']);
		if($lvsp_lv0007->lv001=="" || $lvsp_lv0007->lv001=NULL)
		{
		$vresult=$lvcr_lv0086_1->LV_Update();
		if($vresult==true) {
			if($_FILES['userfile']['name']!="")
			UploadImg($vDefaultPath,$lvcr_lv0086_1->lv001, $lvcr_lv0086_1->lv007);///Call function Upload file
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
		}
}
$lvcr_lv0086_1->LV_LoadID($lvcr_lv0086_1->lv001);
$lvcr_lv0086_1->lv029ex='';
if($lvcr_lv0086_1->GetApr()==0)  $lvcr_lv0086_1->lv029ex=$lvcr_lv0086_1->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script></head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789. ()-"
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
		o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmedit;
		if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[61];?>");
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
if($lvcr_lv0086_1->GetEdit()>0)
{
?>
<body onkeyup="KeyPublicRun(event)">
<div id="content_child" >
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
    <h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmedit" id="frmedit" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="4" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="150"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="300"  height="20">
								<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvcr_lv0086_1->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td width="180"  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input  name="txtlv002" type="text" id="txtlv002" value="<?php echo $lvcr_lv0086->lv002;?>" tabindex="6" maxlength="38" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><table style="width:80%"><tr><td><select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:100%" onKeyPress="return CheckKey(event,7)" onblur="LoadUnit()"/>
								<?php echo $lvcr_lv0086->LV_LinkFieldExt('lv003',$lvcr_lv0086->lv003);?>
							  </select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','cr_lv0003','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv003','cr_lv0003','concat(lv002,@! @!,lv001)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>
								
							 </td>
							  </tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><textarea  name="txtlv004" type="text" id="txtlv004"  tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"><?php echo $lvcr_lv0086->lv004;?></textarea></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[26];?></td>
							  <td  height="20px"> 
									<input name="txtlv012" type="text" id="txtlv012" value="<?php echo $lvcr_lv0086->FormatView($lvcr_lv0086->lv012,2);?>" tabindex="10" maxlength="50" style="width:100px" onKeyPress="return CheckKey(event,7)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv012);return false;">
									<select name="txtlv012_" type="text" id="txtlv012_" value="<?php echo $lvcr_lv0086->lv010_;?>" tabindex="10" maxlength="50" style="width:100px;text-align:center;" onKeyPress="return CheckKey(event,7)">
										<option value="00:00:00" <?php echo (($_POST['txtlv012_']=='' || $_POST['txtlv012_']=='00:00:00')?'selected="selected"':'');?>>---</option>
										<option value="08:00:00" <?php echo (($_POST['txtlv012_']=='08:00:00')?'selected="selected"':'');?>>08:00:00</option>
										<option value="09:00:00" <?php echo (($_POST['txtlv012_']=='09:00:00')?'selected="selected"':'');?>>09:00:00</option>
										<option value="10:00:00" <?php echo (($_POST['txtlv012_']=='10:00:00')?'selected="selected"':'');?>>10:00:00</option>
										<option value="11:00:00" <?php echo (($_POST['txtlv012_']=='11:00:00')?'selected="selected"':'');?>>11:00:00</option>
										<option value="12:00:00" <?php echo (($_POST['txtlv012_']=='12:00:00')?'selected="selected"':'');?>>12:00:00</option>
										<option value="13:00:00" <?php echo (($_POST['txtlv012_']=='13:00:00')?'selected="selected"':'');?>>13:00:00</option>
										<option value="14:00:00" <?php echo (($_POST['txtlv012_']=='14:00:00')?'selected="selected"':'');?>>14:00:00</option>
										<option value="15:00:00" <?php echo (($_POST['txtlv012_']=='15:00:00')?'selected="selected"':'');?>>15:00:00</option>
										<option value="16:00:00" <?php echo (($_POST['txtlv012_']=='16:00:00')?'selected="selected"':'');?>>16:00:00</option>
										<option value="17:00:00" <?php echo (($_POST['txtlv012_']=='17:00:00')?'selected="selected"':'');?>>17:00:00</option>
										<option value="18:00:00" <?php echo (($_POST['txtlv012_']=='18:00:00')?'selected="selected"':'');?>>18:00:00</option>
									</select>
								</td>
							</tr>					  
							<tr>
							   <tr>
								<td height="20" valign="top"><?php echo $vLangArr[20];?></td>
								<td  height="20">
									<table width="80%">
										<tr><td width="50%"><select name="txtlv006" id="txtlv006"   tabindex="11"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
											<option value=""></option>
											<?php echo $lvcr_lv0086->LV_LinkField('lv006',$lvcr_lv0086->lv006);?>
											</select></td><td>
											<ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
												<input value="<?php echo $vStaffID;?>" type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv006','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv008','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
												<div id="lv_popup6" lang="lv_popup6"> </div>						  
												</li>
											</ul></td>
										</tr>
									</table>
								</td>
					      	</tr>
							  <tr>
							   <tr>
								<td height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td  height="20">
									<table width="80%">
										<tr><td width="50%"><select name="txtlv007" id="txtlv007"   tabindex="11"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
											<option value=""></option>
											<?php echo $lvcr_lv0086->LV_LinkField('lv007',$lvcr_lv0086->lv007);?>
											</select></td><td>
											<ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,7)" onkeyup="ChangeName(this,7)"> <li class="menupopT">
												<input value="<?php echo $vStaffID;?>" type="text" autocomplete="off" class="search_img_btn" name="txtlv007_search" id="txtlv007_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv007','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv007','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
												<div id="lv_popup7" lang="lv_popup7"> </div>						  
												</li>
											</ul></td>
										</tr>
									</table>
								</td>
					      	</tr>
							<tr>
							  <td  height="20" colspan="3"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20" colspan="3"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
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
			</tr>
		</table>
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