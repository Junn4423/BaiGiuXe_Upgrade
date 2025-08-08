<?php
session_start();
//require_once("../../clsall/cr_lv0086.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/cr_lv0086.php");
//////////////init object////////////////
$lvcr_lv0086=new cr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0086');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","CR0008.txt",$plang);

$curPage=(int)$_GET['curPg'];	
$vFlag=(int)$_GET['txtFlag'];
$vlv001=$_GET['lv001'];
$vlv002=$_GET['lv002'];
$vlv003=$_GET['lv003'];
$vlv004=$_GET['lv004'];
$vlv005=$_GET['lv005'];
$vlv006=$_GET['lv006'];
$vlv007=$_GET['lv007'];
$vlv008=$_GET['lv008'];
$vlv009=$_GET['lv009'];
$vlv010=$_GET['lv010'];
$vlv011=$_GET['lv011'];
$vlv005=$_GET['lv005'];
$vlv013=$_GET['lv013'];
$vlv014=$_GET['lv014'];
$vlv015=$_GET['lv015'];
$vlv016=$_GET['lv016'];
$vlv017=$_GET['lv017'];
$vlv018=$_GET['lv018'];
$vlv019=$_GET['lv019'];
$vlv020=$_GET['lv020'];
$vlv021=$_GET['lv021'];
$vlv022=$_GET['lv022'];
$vlv023=$_GET['lv023'];
$vlv024=$_GET['lv024'];
$vlv025=$_GET['lv025'];
$vlv026=$_GET['lv026'];
$vlv027=$_GET['lv027'];
$vlv028=$_GET['lv028'];
$vlv029=$_GET['lv029'];
$vlv030=$_GET['lv030'];
$vlv031=$_GET['lv031'];
$vlv032=$_GET['lv032'];
$vlv033=$_GET['lv033'];
$vlv034=$_GET['lv034'];
$vlv035=$_GET['lv035'];
$vlv070=$_GET['lv070'];
$vlv071=$_GET['lv071'];
$vlv072=$_GET['lv072'];
$vlv076=$_GET['lv076'];
$vlv029ex='';
if($lvcr_lv0086->GetApr()==0)  $vlv029ex=$lvcr_lv0086->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>

</head>
<script language="javascript">
<!--
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
function isphone(s){
	if(s!=""){
		var str="0123456789.()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert("<?php echo $vLangArr[21];?>")	
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmfilter;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function Cancel(){	var o=window.parent.document.getElementById('frmchoose');		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";		o.submit();	}
	function Save()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.txtFlag.value="2";
		o.txtlv001.value=document.frmfilter.txtlv001.value;
		o.txtlv002.value=document.frmfilter.txtlv002.value;		
		o.txtlv003.value=document.frmfilter.txtlv003.value;		
		o.txtlv004.value=document.frmfilter.txtlv004.value;		
		o.txtlv006.value=document.frmfilter.txtlv006.value;	
		o.txtlv007.value=document.frmfilter.txtlv007.value;
		o.txtlv008.value=document.frmfilter.txtlv008.value;
		o.txtlv005.value=document.frmfilter.txtlv005.value;
		o.txtlv013.value=document.frmfilter.txtlv013.value;
		o.txtlv014.value=document.frmfilter.txtlv014.value;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}

-->
</script>
<?php
if(1==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[1];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmfilter" id="frmfilter" method="post">
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
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="*"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $vlv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td width="180"  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input  name="txtlv002" type="text" id="txtlv002" value="<?php echo $vlv002;?>" tabindex="6" maxlength="38" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><table style="width:80%"><tr><td><select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:100%" onKeyPress="return CheckKey(event,7)" onblur="LoadUnit()"/>
								<?php echo $lvcr_lv0086->LV_LinkFieldExt('lv003',$vlv003);?>
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
							  <td  height="20px"><textarea  name="txtlv004" type="text" id="txtlv004"  tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"><?php echo $vlv004;?></textarea></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[26];?></td>
							  <td  height="20px"> 
									<input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvcr_lv0086->FormatView($vlv005,2);?>" tabindex="10" maxlength="50" style="width:100px" onKeyPress="return CheckKey(event,7)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv005);return false;">
									<select name="txtlv005_" type="text" id="txtlv005_" value="<?php echo $vlv010_;?>" tabindex="10" maxlength="50" style="width:100px;text-align:center;" onKeyPress="return CheckKey(event,7)">
										<option value="00:00:00" <?php echo (($_POST['txtlv005_']=='' || $_POST['txtlv005_']=='00:00:00')?'selected="selected"':'');?>>---</option>
										<option value="08:00:00" <?php echo (($_POST['txtlv005_']=='08:00:00')?'selected="selected"':'');?>>08:00:00</option>
										<option value="09:00:00" <?php echo (($_POST['txtlv005_']=='09:00:00')?'selected="selected"':'');?>>09:00:00</option>
										<option value="10:00:00" <?php echo (($_POST['txtlv005_']=='10:00:00')?'selected="selected"':'');?>>10:00:00</option>
										<option value="11:00:00" <?php echo (($_POST['txtlv005_']=='11:00:00')?'selected="selected"':'');?>>11:00:00</option>
										<option value="12:00:00" <?php echo (($_POST['txtlv005_']=='12:00:00')?'selected="selected"':'');?>>12:00:00</option>
										<option value="13:00:00" <?php echo (($_POST['txtlv005_']=='13:00:00')?'selected="selected"':'');?>>13:00:00</option>
										<option value="14:00:00" <?php echo (($_POST['txtlv005_']=='14:00:00')?'selected="selected"':'');?>>14:00:00</option>
										<option value="15:00:00" <?php echo (($_POST['txtlv005_']=='15:00:00')?'selected="selected"':'');?>>15:00:00</option>
										<option value="16:00:00" <?php echo (($_POST['txtlv005_']=='16:00:00')?'selected="selected"':'');?>>16:00:00</option>
										<option value="17:00:00" <?php echo (($_POST['txtlv005_']=='17:00:00')?'selected="selected"':'');?>>17:00:00</option>
										<option value="18:00:00" <?php echo (($_POST['txtlv005_']=='18:00:00')?'selected="selected"':'');?>>18:00:00</option>
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
											<?php echo $lvcr_lv0086->LV_LinkField('lv006',$vlv006);?>
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
											<?php echo $lvcr_lv0086->LV_LinkField('lv007',$vlv007);?>
											</select></td><td>
											<ul id="pop-nav7" lang="pop-nav7" onMouseOver="ChangeName(this,7)" onkeyup="ChangeName(this,7)"> <li class="menupopT">
												<input value="<?php echo $vStaffID;?>" type="text" autocomplete="off" class="search_img_btn" name="txtlv007_search" id="txtlv007_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv007','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv007','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
												<div id="lv_popup7" lang="lv_popup7"> </div>						  
												</li>
											</ul></td>
										</tr>
									</table>
								</td>
					      	</tr>			
							  <tr>
								<td height="20" valign="top"><?php echo $vLangArr[22];?></td>
								<td  height="20">
									<table width="80%">
										<tr><td width="50%"><select name="txtlv008" id="txtlv008"   tabindex="11"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
											<option value=""></option>
											<?php echo $lvcr_lv0086->LV_LinkField('lv008',$vlv008);?>
											</select></td><td>
											<ul id="pop-nav8" lang="pop-nav8" onMouseOver="ChangeName(this,8)" onkeyup="ChangeName(this,8)"> <li class="menupopT">
												<input value="<?php echo $vStaffID;?>" type="text" autocomplete="off" class="search_img_btn" name="txtlv008_search" id="txtlv008_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv008','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv008','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
												<div id="lv_popup8" lang="lv_popup8"> </div>						  
												</li>
											</ul></td>
										</tr>
									</table>
								</td>
					      	</tr>
							  <tr>
								<td height="20" valign="top"><?php echo $vLangArr[27];?></td>
								<td  height="20">
									<select name="txtlv013" id="txtlv013"   tabindex="11"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)"/>
										<option value=""></option>
										<?php echo $lvcr_lv0086->LV_LinkField('lv013',$vlv013);?>
									</select>
								</td>
					      	</tr>
							  <tr>
								<td height="20" valign="top"><?php echo $vLangArr[28];?></td>
								<td  height="20">
									<table width="80%">
										<tr><td width="50%"><input  name="txtlv014" type="text" id="txtlv014" value="<?php echo $vlv014;?>"  tabindex="11" maxlength="38" style="width:100%" onKeyPress="return CheckKey(event,7)" /></td><td>
											<ul id="pop-nav14" lang="pop-nav14" onMouseOver="ChangeName(this,14)" onkeyup="ChangeName(this,14)"> <li class="menupopT">
												<input onkeyup="LoadType(this)" onfocus="LoadType(this)" value="" type="text" autocomplete="off" class="search_img_btn" name="txtlv014_search" id="txtlv014_search" style="width:100%"  tabindex="200" >
												<div id="lv_popup14" lang="lv_popup14"> </div>						  
												</li>
											</ul></td>
										</tr>
									</table>
								</td>
					      	</tr>	
							  <tr>
								<td height="20" valign="top"><?php echo $vLangArr[29];?></td>
								<td  height="20">		
							  		<ul style="width:100%" id="pop-nav15" lang="pop-nav15" onmouseover="ChangeName(this,15)" onkeyup="ChangeName(this,15)"> <li class="menupopT">
										<input autocomplete="off" class="txtenterquick" type="text" style="width:80%;min-width:80px" name="txtlv015" id="txtlv015" onkeyup="LoadSelfNext<?php echo $vParentSearch;?>(this,'txtlv015','cr_lv0031','lv001','concat(lv001,@! @!,lv002)')" onkeypress="return CheckKey(event,7)" tabindex="2" value="<?php echo $vlv015;?>" >
										<div id="lv_popup15" lang="lv_popup15"></div>						  
										</li>
									</ul>	
								</td>
					      	</tr> 
							<tr>
							  <td colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../../images/lvicon/Filter.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[3];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>	

				
  </div>
</div>
<script language="javascript"> var o=document.frmfilter; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
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