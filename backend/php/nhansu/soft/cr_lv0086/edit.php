<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
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
/////////Get ID///////////////
$lvcr_lv0086->lv001=$_GET['ChildDetailID'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","CR0008.txt",$plang);

$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$vStrMessage="";


if($vFlag==1)
{
		$lvcr_lv0086->lv002=$_POST['txtlv002'];
		$lvcr_lv0086->lv003=$_POST['txtlv003'];
		$lvcr_lv0086->lv004=$_POST['txtlv004'];
		$lvcr_lv0086->lv006=$_POST['txtlv006'];
		$lvcr_lv0086->lv007=$_POST['txtlv007'];	
		$lvcr_lv0086->lv111=$_POST['txtlv111'];
		$lvcr_lv0086->lv008=$_POST['txtlv008'];	
		$lvcr_lv0086->lv009=$lvcr_lv0086->LV_UserID;
		$lvcr_lv0086->lv010=$_POST['txtlv010'].' '.$_POST['txtlv010_'];	
		$lvcr_lv0086->lv005=$_POST['txtlv005'].' '.$_POST['txtlv005_'];	;	
		$lvcr_lv0086->lv013=$_POST['txtlv013'];	
		$lvcr_lv0086->lv014=$_POST['txtlv014'];	
		$lvcr_lv0086->lv015=$_POST['txtlv015'];	
		$vresult=$lvcr_lv0086->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();
			$vFlag=0;
		}

}

$lvcr_lv0086->LV_LoadID($lvcr_lv0086->lv001);
$lvcr_lv0086->lv005_=substr($lvcr_lv0086->lv005,11,8);
$lvcr_lv0086->lv010_=substr($lvcr_lv0086->lv010,11,8);
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
function isnumber(s){
	if(s!=""){
		var str="0123456789"
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
		var o=document.frmedit;
		o.txtlv002.value="<?php echo $lvcr_lv0086->lv002;?>";
		o.txtlv003.value="<?php echo $lvcr_lv0086->lv003;?>";
		o.txtlv004.value="<?php echo $lvcr_lv0086->lv004;?>";
		o.txtlv005.value="<?php echo $lvcr_lv0086->lv005;?>";
		o.txtlv006.value="<?php echo $lvcr_lv0086->lv006;?>";	
		o.txtlv007.value="<?php echo $lvcr_lv0086->lv007;?>";
		o.txtlv002.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
		o.submit();
	}
		function Save()
	{
		var o=document.frmedit;
		if(o.txtlv003.value=="")
		{
			alert("<?php echo 'Bạn vui lòng chọn mã công việc!';?>");
			o.txtlv003.focus();
		}
		else if(o.txtlv004.value=="")
		{
			alert("<?php echo 'Nội dung công việc không trống!';?>");
			o.txtlv004.focus();
		}
		else if(o.txtlv005.value=="")
		{
			alert("<?php echo 'Ngày hoàn thành công việc không trống!';?>");
			o.txtlv005.focus();
		}
		else if(o.txtlv006.value=="")
		{
			alert("<?php echo 'NV chính thực hiện không trống!';?>");
			o.txtlv006.focus();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
			
	}
	function LoadUnit()
	{
		var o=document.frmedit;
		ajax_do ('../cr_lv0086/cr_lv0086exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv004.value,1);
		window.setTimeout('CalculateC()',1000);
	}
	function LoadType(to)
	{

		var o=document.frmedit;
		var vo=o.txtlv013.value;
		switch(vo)
		{
			case 'EMP':
				LoadPopup(to,'txtlv014','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)');
				break;
			case 'OTH':
			case 'CUS':
				LoadPopup(to,'txtlv014','sl_lv0001','concat(lv001,@! @!,lv002)');
				break;
			case 'SUP':
				LoadPopup(to,'txtlv014','wh_lv0003','concat(lv001,@! @!,lv002)');
				break;
			case 'DEP':
				LoadPopup(to,'txtlv014','hr_lv0002','concat(lv001,@! @!,lv002)');
				break;
			case 'HR':
				LoadPopup(to,'txtlv014','tc_lv0013','concat(lv001,@! @!,lv002)');
				break;
		}
	}
</script>
<?php
if($lvcr_lv0086->GetEdit()>0)
{
?>
<body >

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form name="frmedit" id="frmedit" action="#" method="post">
					<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" id="table1">
							<tr><td colspan="2" align="center">
					<?php		
						echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
						?>
							</td></tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="*"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvcr_lv0086->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
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
									<input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvcr_lv0086->FormatView($lvcr_lv0086->lv005,2);?>" tabindex="10" maxlength="50" style="width:100px" onKeyPress="return CheckKey(event,7)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv005);return false;">
									<select name="txtlv005_" type="text" id="txtlv005_" value="<?php echo $lvcr_lv0086->lv005_;?>" tabindex="10" maxlength="50" style="width:100px;text-align:center;" onKeyPress="return CheckKey(event,7)">
										<option value="00:00:00" <?php echo (($lvcr_lv0086->lv005_=='' || $lvcr_lv0086->lv005_=='00:00:00')?'selected="selected"':'');?>>---</option>
										<option value="08:00:00" <?php echo (($lvcr_lv0086->lv005_=='08:00:00')?'selected="selected"':'');?>>08:00:00</option>
										<option value="09:00:00" <?php echo (($lvcr_lv0086->lv005_=='09:00:00')?'selected="selected"':'');?>>09:00:00</option>
										<option value="10:00:00" <?php echo (($lvcr_lv0086->lv005_=='10:00:00')?'selected="selected"':'');?>>10:00:00</option>
										<option value="11:00:00" <?php echo (($lvcr_lv0086->lv005_=='11:00:00')?'selected="selected"':'');?>>11:00:00</option>
										<option value="12:00:00" <?php echo (($lvcr_lv0086->lv005_=='12:00:00')?'selected="selected"':'');?>>12:00:00</option>
										<option value="13:00:00" <?php echo (($lvcr_lv0086->lv005_=='13:00:00')?'selected="selected"':'');?>>13:00:00</option>
										<option value="14:00:00" <?php echo (($lvcr_lv0086->lv005_=='14:00:00')?'selected="selected"':'');?>>14:00:00</option>
										<option value="15:00:00" <?php echo (($lvcr_lv0086->lv005_=='15:00:00')?'selected="selected"':'');?>>15:00:00</option>
										<option value="16:00:00" <?php echo (($lvcr_lv0086->lv005_=='16:00:00')?'selected="selected"':'');?>>16:00:00</option>
										<option value="17:00:00" <?php echo (($lvcr_lv0086->lv005_=='17:00:00')?'selected="selected"':'');?>>17:00:00</option>
										<option value="18:00:00" <?php echo (($lvcr_lv0086->lv005_=='18:00:00')?'selected="selected"':'');?>>18:00:00</option>
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
											<?php echo $lvcr_lv0086->LV_LinkField('lv008',$lvcr_lv0086->lv008);?>
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
										<?php echo $lvcr_lv0086->LV_LinkField('lv013',$lvcr_lv0086->lv013);?>
									</select>
								</td>
					      	</tr>
							  <tr>
								<td height="20" valign="top"><?php echo $vLangArr[28];?></td>
								<td  height="20">
									<table width="80%">
										<tr><td width="50%"><input  name="txtlv014" type="text" id="txtlv014" value="<?php echo $lvcr_lv0086->lv014;?>"  tabindex="11" maxlength="38" style="width:100%" onKeyPress="return CheckKey(event,7)" /></td><td>
											<ul id="pop-nav14" lang="pop-nav14" onMouseOver="ChangeName(this,14)" onkeyup="ChangeName(this,14)"> <li class="menupopT">
												<input onkeyup="LoadType(this)" onfocus="LoadType(this)" value="" type="text" autocomplete="off" class="search_img_btn" name="txtlv014_search" id="txtlv014_search" style="width:100%"  tabindex="200" >
												<div id="lv_popup14" lang="lv_popup14"> </div>						  
												</li>
											</ul></td>
										</tr>
									</table>
								</td>
					      	</tr>	
							<!--  <tr>
								<td height="20" valign="top"><?php echo $vLangArr[27];?></td>
								<td  height="20">
									<select name="txtlv015" id="txtlv015"   tabindex="11"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)"/>
										<option value=""></option>
										<?php echo $lvcr_lv0086->LV_LinkField('lv015',$lvcr_lv0086->lv013);?>
									</select>
								</td>
					      	</tr>
							
							<tr>
								<td height="20" valign="top"><?php echo $vLangArr[29];?></td>
								<td  height="20">		
							  		<ul style="width:100%" id="pop-nav15" lang="pop-nav15" onmouseover="ChangeName(this,15)" onkeyup="ChangeName(this,15)"> <li class="menupopT">
										<input autocomplete="off" class="txtenterquick" type="text" style="width:80%;min-width:80px" name="txtlv015" id="txtlv015" onkeyup="LoadSelfNext<?php echo $vParentSearch;?>(this,'txtlv015','cr_lv0031','lv001','concat(lv001,@! @!,lv002)')" onkeypress="return CheckKey(event,7)" tabindex="2" value="<?php echo $lvcr_lv0025->lv005;?>" onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};">
										<div id="lv_popup15" lang="lv_popup15"></div>						  
										</li>
									</ul>	
								</td>
					      	</tr> -->
							<tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag" /></td>
						  </tr>
							<tr>
							  <td  height="20px" colspan="2"> <TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /><?php echo $vLangArr[2];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove><?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript"> /*var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);*/
		o.txtlv003.focus();
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