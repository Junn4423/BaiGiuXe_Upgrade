<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0013.php");
require_once("$vDir../clsall/sl_lv0014.php");
////////init object////////////////////
	$lvsl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0013');
	$lvsl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0014');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['ajax']))
{
	echo '[CHECK]';
	$sql="select * from sl_lv0030";
echo '<select name="txtlv912" id="txtlv912"   tabindex="22"  style="width:80%" onkeypress="return CheckKey(event,1)" />'.$lvsl_lv0014->LV_LinkField('lv012',$_GET['categoryid']).'</select>	';
	echo '[ENDCHECK]';
	exit;
}
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//Lấy mã phiếu nhập kho
$lvsl_lv0013->lv001=InsertWithCheck('sl_lv0013', 'lv001', 'HDNCC-'.getmonth($vNow)."/".getyear($vNow)."-",1);
$isExists =0;//$lvsl_lv0013->LV_Exist($lvsl_lv0013->lv001);
$lvsl_lv0013->lv009=$_POST['txtlv809'];
if($flagCtrl == 1){
$lvsl_lv0013->lv002=$_POST['txtlv802'];
$lvsl_lv0013->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$lvsl_lv0013->lv004=$_POST['txtlv804'];
$lvsl_lv0013->lv005=$_POST['txtlv805'];
$lvsl_lv0013->lv006=$_POST['txtlv806'];
$lvsl_lv0013->lv007=$_POST['txtlv807'];	
$lvsl_lv0013->lv008=$_POST['txtlv808'];
$lvsl_lv0013->lv009=$_POST['txtlv809'];
$lvsl_lv0013->lv010=$_POST['txtlv810'];
$lvsl_lv0013->lv011=$_POST['txtlv811'];
$lvsl_lv0013->lv012=$_POST['txtlv812'];
$lvsl_lv0013->lv013=$_POST['txtlv813'];
$lvsl_lv0013->lv015=1;
	$vStrMessage = "";
	if((int)$isExists==0){
		$bResultI = $lvsl_lv0013->LV_InsertTemp();
		if($bResultI == true){
			$lvsl_lv0014->LV_InsertTemp($lvsl_lv0013->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2),$lvsl_lv0013->lv002);
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
		} else{
			$vStrMessage = sof_error();
			$flagCtrl = 0;
		}
	} else if((int)$isExists>=1 && (int)$lvsl_lv0014->lv007==0){
			$lvsl_lv0013->LV_Update();
			$lvsl_lv0014->LV_InsertTemp($lvsl_lv0013->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2),$lvsl_lv0013->lv002);	
			$vStrMessage = $vLangArr[9];
			$flagCtrl = 1;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$lvsl_lv0013->Load($lvsl_lv0013->ID);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
	.tblcaption
{
	color:#000099;
	font-weight:bold;
	background-color:#CFDDE9;
}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engines.js"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="<?php echo $vDir;?>jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "txtlv809",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "txtlv813",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
	<title><?php echo $vLangArr[17];?></title>
	<script>

	<!--
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv802.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv802.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	/*=============================================================================*/
	function Back() {
		
		opener.document.frmadd.submit();
		window.close();
	}
	/*=======================================================================================*/
	function isNumber(s){
		if(s!=""){
			var str=".,0123456789";
			for(var j=0;j<s.length;j++)
				if(str.indexOf(s.charAt(j))==-1)
					return false;
			return true;
		}	
		return true;
	}
	function RunFunction()
	{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>sl_lv0032/sl_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	}
	function Add()
	{
	var o=document.frmadd;
	var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv008="+o.txtlv908.value+"&txtlv009="+o.txtlv909.value+"&txtlv010="+o.txtlv910.value+"&txtlv011="+o.txtlv911.value+"&txtlv012="+o.txtlv912.value+"&txtlv013="+o.txtlv913.value+"&txtOpt=1";
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>sl_lv0032/sl_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	o.txtlv903.focus();
	}
	function LoadType(to)
	{

		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'BANHANG':
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'MUAHANG':
				LoadPopupParent(to,'txtlv806','ts_lv0021','lv003');
				break;
		}
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('ts_lv0046/ts_lv0046exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value,1);
	}
	function LoadSource()
	{
	var o=document.frmadd;
	var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'BANHANG':
				break;
			case 'TRAHANG':
				break;
			case 'MUAHANG':
				ajax_do ('ts_lv0046/ts_lv0046excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
		}

		
	}
	-->
	</script>
</head>
<?php
if($lvsl_lv0013->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
		<tr height="25%"><td>&nbsp;</td></tr>
		<tr height="*">
			<td>&nbsp;</td>
			<td width="100%" align="center">
				<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
					<tr>
						<td class="td" colspan="3"><h2><?php echo $vLangArr[17];?></h2></td>
					</tr>
					<tr><td class="td" colspan="3">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="td" width="100%" align="center">
							<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" class="tbl">	
								<tr>
									<td class="td" align="center">
										<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<?php if($vStrMessage!=""){ ?>
												<tr>
												  <td class="td" height="20px" colspan="4" align="center"><font color="#3366CC"><?php echo $vStrMessage;?></font></td>
												</tr>
												<?php }?>
												<tr>
													<td class="td" width="18%" height="20px" align="left"><?php echo $vLangArr[19];?></td>	
												  <td class="td" width="32%"><input name="txtlv801" type="text" id="txtlv801"  value="<?php echo InsertWithCheck('sl_lv0013', 'lv001', 'HDNCC-'.getmonth($vNow)."/".getyear($vNow)."-",1);?>" tabindex="3" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"  readonly="true"/></td>
													<td class="td" width="17%" height="20px" align="left" valign="top"><?php echo $vLangArr[60];?></td>
												  <td class="td" width="33%"><input name="txtlv802" type="text" id="txtlv802"  value="<?php echo $lvsl_lv0013->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/><br>
							  <table><tr><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch4" id="txtlvsearch4" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv802','ts_lv0003','lv002')" onFocus="LoadPopupParent(this,'txtlv802','ts_lv0003','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
												</tr>
												<tr>
												  <td class="td" height="20px" align="left"><?php echo $vLangArr[21];?></td>
												  <td height="20px" class="td"><input  name="txtlv803" type="text" id="txtlv803" value="<?php echo $lvsl_lv0013->lv003;?>" tabindex="4" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
												  <td><?php echo $vLangArr[55];?></td>
												  <td><input  name="txtlv814" type="text" id="txtlv814" value="<?php echo $lvsl_lv0013->lv014;?>" tabindex="4" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
											  </tr>
												<tr>
												  <td class="td" height="20px" align="left"><?php echo $vLangArr[22];?></td>
												  <td height="20px" class="td"><input name="txtlv804" type="text" id="txtlv804" value="<?php echo $lvsl_lv0013->FormatView($lvsl_lv0013->lv004,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)" />
                                                  <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv804);return false;" /></td>
												  <td><?php echo $vLangArr[23];?></td>
												  <td><input name="txtlv805" type="text" id="txtlv805" value="<?php echo $lvsl_lv0013->FormatView($lvsl_lv0013->lv005,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"  onKeyDown="document.frmadd.txtlv913.value=this.value"/>
                                                  <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv805);return false;" /></td>
											  </tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[24];?></td>
												  <td height="20px" class="td"><input  name="txtlv806" type="text" id="txtlv806" value="<?php echo $lvsl_lv0013->lv006;?>" tabindex="4" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>		<td><?php echo $vLangArr[28];?></td>
												  <td><input  name="txtlv810" type="text" id="txtlv810" value="<?php echo $lvsl_lv0013->lv010;?>" tabindex="4" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[25];?></td>
													<td height="20px" class="td" valign="top"><select name="txtlv807" id="txtlv807"   tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv007',$lvsl_lv0013->lv007);?>
							  </select>	<br><table><tr>
							    <td><img src="<?php echo $vDir;?>../images/controlright/search.gif" alt=""></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv807','sl_lv0009','lv002')" onFocus="LoadPopupParent(this,'txtlv807','sl_lv0009','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
												    <td height="20px" class="td" ><?php echo $vLangArr[26];?></td>
											      <td height="20px" class="td"><select name="txtlv808" id="txtlv808"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv008',$lvsl_lv0013->lv008);?>
							  </select><br><table><tr>
							    <td><img src="<?php echo $vDir;?>../images/controlright/search.gif" alt=""></td><td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch2" id="txtlvsearch2" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv808','sl_lv0008','lv002')" onFocus="LoadPopupParent(this,'txtlv808','sl_lv0008','lv002')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table></td>
												</tr>
											 <tr>
												  <td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[54];?></td>
												  <td height="20px" class="td" valign="top"><select name="txtlv812" id="txtlv812"   tabindex="15"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
                                <option value=""></option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv012',$lvsl_lv0013->lv012);?>
							  </select>	<br><table><tr>
							    <td><img src="<?php echo $vDir;?>../images/controlright/search.gif" alt=""></td><td>
							  <ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch3" id="txtlvsearch3" style="width:200px" onKeyUp="LoadPopup(this,'txtlv812','sl_lv0010','lv003')" onFocus="LoadPopup(this,'txtlv812','sl_lv0010','lv003')" tabindex="200" >
							    <div id="lv_popup5" lang="lv_popup5"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
												  <td height="20px" class="td" ><?php echo $vLangArr[57];?></td>
												  <td height="20px" class="td"><select name="txtlv817" id="txtlv817"   tabindex="15"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
                                <option value=""></option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv017',$lvsl_lv0013->lv017);?>
							  </select>	<br><table><tr>
							    <td><img src="<?php echo $vDir;?>../images/controlright/search.gif" alt=""></td><td>
							  <ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch3" id="txtlvsearch3" style="width:200px" onKeyUp="LoadPopup(this,'txtlv817','sl_lv0013','concat(lv003,lv016)')" onFocus="LoadPopup(this,'txtlv817','sl_lv0013','concat(lv003,lv016)')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
						</li>
					</ul></td></tr></table></td>
											  </tr>
											 <tr>
											   <td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[27];?></td>
											   <td height="20px" class="td" valign="top"><select name="txtlvopt1" id="txtlvopt1"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadTextParent(this,'txtlv809','sl_lv0016','lv003',document.frmadd.txtlv802.value,1,'<?php echo $plang;?>')"/>
							  <option value=""></option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv015',$lvsl_lv0013->lv013);?>
							  </select>	</td>
											   <td height="20px" class="td" ><?php echo $vLangArr[59];?></td>
											   <td height="20px" class="td"><select name="txtlvopt2" id="txtlvopt2"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadTextParent(this,'txtlv813','sl_lv0016','lv003',document.frmadd.txtlv802.value,1,'<?php echo $plang;?>')"/>
							  <option value=""></option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv015',$lvsl_lv0013->lv013);?>
							  </select>	</td>
										      </tr>
											 <tr>
											   <td height="20px" colspan="2" align="left" valign="top" class="td"><textarea name="txtlv809" rows="5" id="txtlv809" style="width:80%" tabindex="13"><?php echo $lvsl_lv0013->lv009;?></textarea></td>
											   <td height="20px" colspan="2" class="td" ><textarea name="txtlv813" rows="5" id="txtlv813" style="width:80%" tabindex="14"><?php echo $lvsl_lv0013->lv013;?></textarea></td>
										      </tr>												
												<tr height="1">
												  <td class="td" colspan="4">&nbsp;</td>
												</tr>
												<tr height="1">
												  <td class="td" colspan="4"><table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="13">
				<img name="table_r1_c1" src="<?php echo $vDir;?>images/pictures/table_r1_c1.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="*" background="<?php echo $vDir;?>images/pictures/table_r1_c2.gif">
				</td>
			<td width="13">
				<img name="table_r1_c3" src="<?php echo $vDir;?>images/pictures/table_r1_c3.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="11">
				</td>
		</tr>
		<tr>
			<td background="<?php echo $vDir;?>images/pictures/table_r2_c1.gif">
				</td>
			<td><table width="100%" border="0">
                                                    <tr>
                                                      <td width="100%" align="center"><h3><?php echo $vLangArr[16];?></h3></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td width="13%"><?php echo $vLangArr[32];?></td>
                                                          <td width="34%"><select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $lvsl_lv0014->LV_LinkField('lv003',$lvsl_lv0014->lv003);?>
                                                            </select>
                                                            <br />
                                                            <table>
                                                              <tr>
                                                                
                                                                <td><ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" xml:lang="pop-nav4">
                                                                    <li class="menupopT">
                                                                      <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch13" id="txtlvsearch13" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,lv001)')" tabindex="200">
                                                                      <div id="lv_popup4" lang="lv_popup4" xml:lang="lv_popup4"> </div>
                                                                    </li>
                                                                </ul></td>
                                                              </tr>
                                                            </table></td>
                                                          <td width="17%"><label>
                                                            <input type="button" name="Load" value="۩▲" tabindex="20" onClick="LoadItem()" >
                                                          </label></td>
                                                          <td width="36%">&nbsp;</td>
                                                        </tr>
                                                         <tr>
                                                          <td><?php echo $vLangArr[40];?></td>
                                                          <td><select name="txtlv911" id="txtlv911"   tabindex="21"  style="width:80%" onkeypress="return CheckKey(event,1)" onChange="changecategory_change(this.value)"/>
                                                          <?php echo $lvsl_lv0014->LV_LinkField('lv011',$lvsl_lv0014->lv011);?>
							  </select></td>
                                                          <td><?php echo $vLangArr[41];?></td>
                                                          <td><div id="sizegetid"><select name="txtlv912" id="txtlv912"   tabindex="22"  style="width:80%" onkeypress="return CheckKey(event,1)" />
                                                        
							  </select></div></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[33];?></td>
                                                          <td><input name="txtlv904" id="txtlv904"   tabindex="23"  style="width:80%" onKeyPress="return CheckKey(event,1)" value="<?php echo (float)$lvsl_lv0014->lv004;?>"/></td>
                                                          <td><?php echo $vLangArr[34];?></td>
                                                          <td><select name="txtlv905" id="txtlv905"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $lvsl_lv0014->LV_LinkField('lv005',$lvsl_lv0014->lv005);?>
                                                            </select>
                                                            <br /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[35];?></td>
                                                          <td><input name="txtlv906" type="text" id="txtlv906" value="<?php echo (float)$lvsl_lv0014->lv006;?>" tabindex="24" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                          <td><?php echo $vLangArr[36];?></td>
                                                          <td><select name="txtlv907" id="txtlv907"   tabindex="11"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $lvsl_lv0014->LV_LinkField('lv007',$lvsl_lv0014->lv007);?>
                                                            </select></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[38];?></td>
                                                          <td><input  name="txtlv909" type="text" id="txtlv909" value="<?php echo $lvsl_lv0014->lv009;?>" tabindex="25" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /><br>
							  <table><tr><td>
							    <ul id="pop-nav7" lang="pop-nav7" onMouseOver="ChangeName(this,7)" onkeyup="ChangeName(this,7)"> <li class="menupopT">
							      <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch7" id="txtlvsearch7" style="width:200px" onKeyUp="LoadPopupParentWH(this,'txtlv909','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" onFocus="LoadPopupParentWH(this,'txtlv909','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')')" tabindex="200" >
							      <div id="lv_popup7" lang="lv_popup7"> </div>						  
						  </li>
					  </ul></td></tr></table></td>
                                                          <td><?php echo $vLangArr[39];?></td>
                                                          <td><input  name="txtlv910" type="text" id="txtlv910" value="<?php echo $lvsl_lv0014->lv010;?>" tabindex="26" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[37];?></td>
                                                          <td><input type="text" name="txtlv908" id="txtlv908"  style="width:80%"  tabindex="26"  value="<?php echo (float)$lvsl_lv0014->lv008;?>" onKeyPress="return CheckKey(event,1)"></td>
                                                          <td><?php echo $vLangArr[42];?></td>
                                                          <td><input name="txtlv913" type="text" id="txtlv913" value="<?php echo $lvsl_lv0013->FormatView($lvsl_lv0014->lv013,2);?>" tabindex="28" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,1)"  onFocus="if(this.value=='')this.value=document.frmadd.txtlv805.value"/>                                                            <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv913);return false;" /></td>
                                                        </tr>
                                                       
														<!--
                                                        <tr>
                                                          <td><?php echo $vLangArr[40];?></td>
                                                          <td><select name="txtlv912" id="txtlv912"   tabindex="27"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                          <?php echo $lvsl_lv0014->LV_LinkField('lv012',$lvsl_lv0014->lv012);?>
                                                            </select><br>
							  <table><tr><td>
							    <ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
							      <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch5" id="txtlvsearch5" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv912','ac_lv0002','lv002')" onFocus="LoadPopupParent(this,'txtlv912','ac_lv0002','lv002')" tabindex="200" >
							      <div id="lv_popup5" lang="lv_popup5"> </div>						  
						  </li>
					  </ul></td></tr></table></td><td><?php echo $vLangArr[41];?></td>
                                                          <td><select name="txtlv913" id="txtlv913"   tabindex="28"  style="width:80%" onKeyPress="return CheckKey(event,1)"/>
							  <?php echo $lvsl_lv0014->LV_LinkField('lv013',$lvsl_lv0014->lv013);?>
							  </select><br><table><tr><td>
							  <ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch6" id="txtlvsearch6" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv913','ac_lv0002','lv002')" onFocus="LoadPopupParent(this,'txtlv913','ac_lv0002','lv002')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
						</li>
					</ul></td></tr></table></td>
                                                        </tr>-->
                                                      </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td><img border="0" title="<?php echo $vLangArr[35];?>" class="imgButton" onClick="Add()" onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add_02<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" src="<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg" tabindex="29" onKeyPress="return CheckKey(event,11)"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><?php
$isRun=1;
if($isRun==1)
{
?>														
														<img type="image" class="btAdd" name="save" onClick="Save();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="66"/>
<?php
}
?>															
														<img type="image" class="btAdd" name="back" onClick="Back();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[5];?>" tabindex="67" onKeyUp="return loadkey(event,2)"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td><div id="idProdcess"></div></td>
                                                    </tr>
                                                    
                                                  </table>
				 
<!--////////////////////////////////////Code add here///////////////////////////////////////////-->			</td>
			<td background="<?php echo $vDir;?>images/pictures/table_r2_c3.gif">
				</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<img name="table_r3_c1" src="<?php echo $vDir;?>images/pictures/table_r3_c1.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td background="<?php echo $vDir;?>images/pictures/table_r3_c2.gif">
				</td>
			<td>
				<img name="table_r3_c3" src="<?php echo $vDir;?>images/pictures/table_r3_c3.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td></td>
		</tr>
	</table></td>
											  </tr>
												<tr height="1"><td class="td" colspan="4">
												<div id="lvloaddata"></div></td>
												</tr>
												<tr>
													<td class="td" align="center" colspan="4">
<?php
$isRun=1;
if($isRun==1)
{
?>														
														<img type="image" class="btAdd" name="save" onClick="Save();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="67"/>
<?php
}
?>															
														<img type="image" class="btAdd" name="back" onClick="Back();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[5];?>" tabindex="67" onKeyUp="return loadkey(event,2)"/></td>
												</tr>
												<tr><td class="td" height="20px" colspan="4" align="center">&nbsp;</td>
											</table>
										</form>
										
									</td>
								</tr>
							</table>
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="25%"><td>&nbsp;</td></tr>
	</table>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<script language="javascript">
window.setTimeout('RunFunction()',100);
document.frmadd.txtlv903.focus();
changecategory_change(document.frmadd.txtlv911.value);
function changecategory_change(value)
		{
			$xmlhttp=null;
			if(value=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajax=ajaxcheck"+"&categoryid="+value;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChanged;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChanged()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('sizegetid').innerHTML=domainid;
			}
		}
		function GetXmlHttpObject()
		{
			if (window.XMLHttpRequest)
			{
			  // code for IE7+, Firefox, Chrome, Opera, Safari
				return new XMLHttpRequest();
			}
			if (window.ActiveXObject)
			{
			  // code for IE6, IE5
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			return null;
		}
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>