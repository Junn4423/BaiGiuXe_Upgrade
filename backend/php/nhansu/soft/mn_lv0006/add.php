<?php
session_start();
//require_once("../../clsall/sl_lv0013.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0013.php");
require_once("../../clsall/sl_lv0014.php");
//////////////init object////////////////
$lvsl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0006');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0028.txt",$plang);
$mosl_lv0013->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvsl_lv0013->lv001=$_POST['txtlv001'];
if( $_GET['ID']=="")
$lvsl_lv0013->lv002=$_POST['txtlv002'];
else
$lvsl_lv0013->lv002= $_GET['ID'] ?? '';
$lvsl_lv0013->lv003=$_POST['txtlv003'];
$lvsl_lv0013->lv004=$_POST['txtlv004'];
$lvsl_lv0013->lv005=$_POST['txtlv005'];
$lvsl_lv0013->lv006=$_POST['txtlv006'];
$lvsl_lv0013->lv007=$_POST['txtlv007'];
$lvsl_lv0013->lv008=$_POST['txtlv008'];
$lvsl_lv0013->lv009=$_POST['txtlv009'];
$lvsl_lv0013->lv010=$_POST['txtlv010'];
$lvsl_lv0013->lv011=$_POST['txtlv011'];
$lvsl_lv0013->lv012=$_POST['txtlv012'];
$lvsl_lv0013->lv013=$_POST['txtlv013'];
$lvsl_lv0013->lv014=$_POST['txtlv014'];
$lvsl_lv0013->lv015=0;
$lvsl_lv0013->lv016=$_POST['txtlv016'];
$lvsl_lv0013->lv017=$_POST['txtlv017'];	
$lvsl_lv0013->lv022=$_POST['txtlv022'];	
if($vFlag==1)
{
		
		$vresult=$lvsl_lv0013->LV_Insert();
		if($vresult==true) {
			$lvsl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0016');
			$lvsl_lv0014->LV_InsertOther($vresult=$lvsl_lv0013->lv012,$vresult=$lvsl_lv0013->lv001);
			
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}

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
		elements : "txtlv013",
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
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv008.value="";
		o.txtlv009.value="";
		o.txtlv010.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv002.select();
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
if($lvsl_lv0013->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
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
					<form action="#" name="frmadd" method="post" enctype="multipart/form-data">
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvsl_lv0013->lv001=="")?InsertWithCheckExt('sl_lv0013', 'lv001', '',10):$lvsl_lv0013->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" />			</td>
						    </tr>
                            <tr>
							  <td  height="20"><?php echo $vLangArr[34];?></td>
				  <td  height="20"><input  name="txtlv016" type="text" id="txtlv016" value="<?php echo $lvsl_lv0013->lv016;?>" tabindex="5" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>	
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
							  <input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvsl_lv0013->lv002;?>" tabindex="6" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" readonly="true"/>
							  </td>
							  <td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv002_search" id="txtlv002_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv002','sl_lv0001','lv002')" onFocus="LoadPopup(this,'txtlv002','sl_lv0001','lv002')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><input name="txtlv003" id="txtlv003"   tabindex="7"  style="width:40%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvsl_lv0013->lv003;?>" type="text"/>	<input name="txtlv014" id="txtlv014"   tabindex="7"  style="width:40%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvsl_lv0013->lv014;?>" type="text"/>	</td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><input name="txtlv004" id="txtlv004"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvsl_lv0013->FormatView($lvsl_lv0013->lv004,2);?>"/><span class="td"><img tabindex="8" src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv004);return false;" /></span>							 </td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvsl_lv0013->FormatView($lvsl_lv0013->lv005,2);?>" tabindex="9" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="9"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv005);return false;" /></span></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo (float)$lvsl_lv0013->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							  <tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td width="178"  height="20">
								<table width="80%"><tr><td width="50%"><select name="txtlv007" id="txtlv007"   tabindex="11"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv007',$lvsl_lv0013->lv007);?>
							  </select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadPopup(this,'txtlv007','sl_lv0009','lv002')" onFocus="LoadPopup(this,'txtlv007','sl_lv0009','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
					      </tr>
						  <tr>
							  <td  height="20"><?php echo $vLangArr[37];?></td>
							  <td  height="20"><input name="txtlv022" type="text" id="txtlv022" value="<?php echo (float)$lvsl_lv0013->lv022;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><table width="80%"><tr><td width="50%">
							  <select name="txtlv008" id="txtlv008"   tabindex="12"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv008',$lvsl_lv0013->lv008);?>
							  </select>
							  </td>
							  <td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv008_search" id="txtlv008_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv008','sl_lv0008','lv002')" onFocus="LoadPopup(this,'txtlv008','sl_lv0008','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[33];?></td>
							  <td  height="20"><select name="txtlvopt1" id="txtlvopt1"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadText(this,'txtlv009','sl_lv0016','lv003',document.frmadd.txtlv002.value,1,'<?php echo $plang;?>')"/>
							  <option value=""></option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv015',$lvsl_lv0013->lv013);?>
							  </select>							  </td>
							  </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><textarea name="txtlv009" rows="20" id="txtlv009" style="width:80%" tabindex="13"><?php echo $lvsl_lv0013->lv009;?></textarea></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[33];?></td>
							  <td  height="20"><select name="txtlvopt2" id="txtlvopt2"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadText(this,'txtlv013','sl_lv0016','lv003',document.frmadd.txtlv002.value,1,'<?php echo $plang;?>')"/>
							  <option value=""></option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv015',$lvsl_lv0013->lv013);?>
							  </select>							  </td>
							  </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><textarea name="txtlv013" rows="20" id="txtlv013" style="width:80%" tabindex="14"><?php echo $lvsl_lv0013->lv013;?></textarea></td>
						    </tr>
                          <tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20"><input  name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvsl_lv0013->LV_UserID;?>" tabindex="14" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
						  </tr>	
						  <tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[26];?></td>
								<td width="178"  height="20"><table width="80%"><tr><td width="50%">
								<select name="txtlv012" id="txtlv012"   tabindex="15"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
                                <option value=""></option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv012',$lvsl_lv0013->lv012);?>
							  </select>
							  </td>
							  <td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv012_search" id="txtlv012_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv012','sl_lv0010','lv003')" onFocus="LoadPopup(this,'txtlv012','sl_lv0010','lv003')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
					      </tr>	
                          <tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[35];?></td>
								<td width="178"  height="20"><table width="80%"><tr><td width="50%">
								<select name="txtlv017" id="txtlv017"   tabindex="15"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
                                <option value=""></option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv017',$lvsl_lv0013->lv017);?>
							  </select>
							  </td>
							  <td>
							  <ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv017_search" id="txtlv017_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv017','sl_lv0013','concat(lv003,@! @!,lv016,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv017','sl_lv0013','concat(lv003,@! @!,lv016,@! @!,lv001)')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
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
	var o=document.frmadd;
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