<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../images/employees/";
//require_once("../../clsall/hr_lv0044.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0044.php");
//////////////init object////////////////
$lvhr_lv0044=new hr_lv0044($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0060');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvhr_lv0044->lv001= $_GET['ID'] ?? '';
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0164.txt",$plang);
$mohr_lv0044->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
if($vFlag==1)
{
$lvhr_lv0044->lv002=$_POST['txtlv002'];
$lvhr_lv0044->lv003=$_POST['txtlv003'];
$lvhr_lv0044->lv004=$_POST['txtlv004'];
$lvhr_lv0044->lv005=$_POST['txtlv005'];
$lvhr_lv0044->lv006=$_POST['txtlv006'];
$lvhr_lv0044->lv007=$_POST['txtlv007'];
$lvhr_lv0044->lv008=$_POST['txtlv008'];
$lvhr_lv0044->lv009=$_POST['txtlv009'];
$lvhr_lv0044->lv010=$_POST['txtlv010'];
$lvhr_lv0044->lv011=$_POST['txtlv011'];
$lvhr_lv0044->lv012=$_POST['txtlv012'];
$lvhr_lv0044->lv013=$_POST['txtlv013'];
$lvhr_lv0044->lv014=$_POST['txtlv014'];		
		$vresult=$lvhr_lv0044->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvhr_lv0044->LV_LoadID($lvhr_lv0044->lv001);


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
<!-- TinyMCE -->
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "txtlv007",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
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
		elements : "txtlv008",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
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
		elements : "txtlv009",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
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
		elements : "txtlv010",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
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
		elements : "txtlv015",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
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

</head>
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
		//o.action="?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmedit;
		if(o.txtlv003.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv003.select();
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
if($lvhr_lv0044->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmedit" id="frmedit" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="760" border="0" align="center" class="table1">
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvhr_lv0044->lv001=="")?InsertWithCheckExt('hr_lv0044', 'lv001', '',10):$lvhr_lv0044->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0044->lv002;?>" tabindex="6" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" /></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv002_search" id="txtlv002_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv002','tc_lv0013','lv002')" onFocus="LoadPopup(this,'txtlv002','tc_lv0013','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><input name="txtlv003" id="txtlv003"   tabindex="7"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvhr_lv0044->lv003;?>" type="text"/></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><input name="txtlv004" id="txtlv004"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvhr_lv0044->lv004;?>"/></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvhr_lv0044->FormatView($lvhr_lv0044->lv005,2);?>" tabindex="9" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="9"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv005);return false;" /></span></td>
						    </tr>	
							 <tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
				  <td  height="20px"><select  name="txtlv020"  id="txtlv020"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadText(this,'txtlv007','hr_lv0043','lv003',document.frmedit.txtlv002.value,-1,'<?php echo $plang;?>')"/><option value=""></option><?php echo $lvhr_lv0044->LV_LinkField('lv008',$lvhr_lv0044->lv008);?>
				  </select>							 </td>
							  </tr>	
							  	<tr>
							  <td  height="20" valign="top">&nbsp;</td>
							  <td  height="20"><textarea name="txtlv007" rows="20" id="txtlv007" style="width:80%" tabindex="13"><?php echo $lvhr_lv0044->lv007;?></textarea></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
				  <td  height="20px"><select  name="txtlv021"  id="txtlv021"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadText(this,'txtlv008','hr_lv0043','lv003',document.frmedit.txtlv002.value,-1,'<?php echo $plang;?>')"/><option value=""></option><?php echo $lvhr_lv0044->LV_LinkField('lv008',$lvhr_lv0044->lv008);?>
				  </select>							 </td>
							  </tr>	
							  	<tr>
							  <td  height="20" valign="top">&nbsp;</td>
							  <td  height="20"><textarea name="txtlv008" rows="15" id="txtlv008" style="width:80%" tabindex="13"><?php echo $lvhr_lv0044->lv008;?></textarea></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[23];?></td>
				  <td  height="20px"><select  name="txtlv022"  id="txtlv0222"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadText(this,'txtlv009','hr_lv0043','lv003',document.frmedit.txtlv002.value,-1,'<?php echo $plang;?>')"/><option value=""></option><?php echo $lvhr_lv0044->LV_LinkField('lv008',$lvhr_lv0044->lv008);?>
				  </select>							 </td>
							  </tr>	
							  	<tr>
							  <td  height="20" valign="top">&nbsp;</td>
							  <td  height="20"><textarea name="txtlv009" rows="15" id="txtlv009" style="width:80%" tabindex="13"><?php echo $lvhr_lv0044->lv009;?></textarea></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[24];?></td>
				  <td  height="20px"><select  name="txtlv023"  id="txtlv023"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadText(this,'txtlv010','hr_lv0043','lv003',document.frmedit.txtlv002.value,-1,'<?php echo $plang;?>')"/><option value=""></option><?php echo $lvhr_lv0044->LV_LinkField('lv008',$lvhr_lv0044->lv008);?>
				  </select>							 </td>
							  </tr>	
							  	<tr>
							  <td  height="20" valign="top">&nbsp;</td>
							  <td  height="20"><textarea name="txtlv010" rows="15" id="txtlv010" style="width:80%" tabindex="13"><?php echo $lvhr_lv0044->lv010;?></textarea></td>
							</tr>	
                             <tr>
							  <td  height="20px"><?php echo $vLangArr[32];?></td>
				  <td  height="20px"><select  name="txtlv024"  id="txtlv024"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadText(this,'txtlv015','hr_lv0043','lv003',document.frmadd.txtlv002.value,-1,'<?php echo $plang;?>')"/><option value=""></option><?php echo $lvhr_lv0044->LV_LinkField('lv008',$lvhr_lv0044->lv008);?>
				  </select>							 </td>
							  </tr>	
							  	<tr>
							  <td  height="20" valign="top">&nbsp;</td>
							  <td  height="20"><textarea name="txtlv015" rows="15" id="txtlv015" style="width:80%" tabindex="13"><?php echo $lvhr_lv0044->lv015;?></textarea></td>
							</tr>	
							<tr>
							  <td  height="20"><?php echo $vLangArr[25];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%"><select name="txtlv011" type="text" id="txtlv011"  value="<?php echo $lvhr_lv0044->lv011;?>" tabindex="11" maxlength="225" style="width:100%" onKeyPress="return CheckKey(event,7)" ><?php echo $lvhr_lv0044->LV_LinkField('lv011',$lvhr_lv0044->lv011);?></select></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch3" id="txtlvsearch3" style="width:100%" onKeyUp="LoadPopup(this,'txtlv011','hr_lv0044','lv003')" onFocus="LoadPopup(this,'txtlv011','hr_lv0044','lv003')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
						    </tr>
                             <tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
				  <td  height="20"><input name="txtlv012" id="txtlv012"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvhr_lv0044->lv012;?>"/></td>
						  </tr>		
                            <tr>
							  <td  height="20"><?php echo $vLangArr[30];?></td>
				  <td  height="20"><input name="txtlv013" id="txtlv013"   tabindex="13"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvhr_lv0044->lv013;?>"/></td>
						  </tr>	
                          <tr>
							  <td  height="20"><?php echo $vLangArr[31];?></td>
				  <td  height="20"><input name="txtlv014" id="txtlv014"   tabindex="13"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvhr_lv0044->lv014;?>"/></td>
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