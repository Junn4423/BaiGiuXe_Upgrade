<?php
session_start();
//require_once("../../clsall/tc_lv0013.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0013.php");
//////////////init object////////////////
$lvtc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0012.txt",$plang);
$lvtc_lv0013->lang=strtoupper($plang);
$vNow=GetServerDate();
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvtc_lv0013->lv001=$_POST['txtlv001'];
$lvtc_lv0013->lv002=$_POST['txtlv002'];
$lvtc_lv0013->lv003=$_POST['txtlv003'];
$lvtc_lv0013->lv004=$_POST['txtlv004'];
if($lvtc_lv0013->lv004=="" || $lvtc_lv0013->lv004==NULL) $lvtc_lv0013->lv004=getyear($vNow)."/".getmonth($vNow)."/01";
$lvtc_lv0013->lv005=$_POST['txtlv005'];
if($lvtc_lv0013->lv005=="" || $lvtc_lv0013->lv005==NULL) $lvtc_lv0013->lv005=getyear($vNow)."/".getmonth($vNow)."/".GetDayInMonth(getyear($vNow),(int)getmonth($vNow));
$lvtc_lv0013->lv006=$_POST['txtlv006'];
if($lvtc_lv0013->lv006=="" || $lvtc_lv0013->lv006==NULL) $lvtc_lv0013->lv006=(int)getmonth($vNow);
$lvtc_lv0013->lv007=$_POST['txtlv007'];	
if($lvtc_lv0013->lv007=="" || $lvtc_lv0013->lv007==NULL) $lvtc_lv0013->lv007=getyear($vNow);
$lvtc_lv0013->lv008=$_POST['txtlv008'];
$lvtc_lv0013->lv009=$_POST['txtlv009'];
$lvtc_lv0013->lv010=$_POST['txtlv010'];
$lvtc_lv0013->lv011=0;
$lvtc_lv0013->lv012=$_POST['txtlv012'];
$lvtc_lv0013->lv013=$_POST['txtlv013'];
$lvtc_lv0013->lv014=$_POST['txtlv014'];
$lvtc_lv0013->lv015=$_POST['txtlv015'];
$lvtc_lv0013->lv016=$_POST['txtlv016'];
$lvtc_lv0013->lv017=$_POST['txtlv017'];
$lvtc_lv0013->lv018=$_POST['txtlv018'];
$lvtc_lv0013->lv019=$_POST['txtlv019'];
$lvtc_lv0013->lv020=$_POST['txtlv020'];
$lvtc_lv0013->lv021=$_POST['txtlv021'];
$lvtc_lv0013->lv022=$_POST['txtlv022'];
$lvtc_lv0013->lv023=$_POST['txtlv023'];
$lvtc_lv0013->lv024=$_POST['txtlv024'];
$lvtc_lv0013->lv025=$_POST['txtlv025'];
$lvtc_lv0013->lv026=$_POST['txtlv026'];
$lvtc_lv0013->lv051=$_POST['txtlv051'];

$lvtc_lv0013->lv098=$_POST['txtlv098'];
$lvtc_lv0013->lv099=$_POST['txtlv099'];
$lvtc_lv0013->lv100=$_POST['txtlv100'];
if($vFlag==1)
{
		
		$vresult=$lvtc_lv0013->LV_Insert();
		if($vresult==true) {
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
		//o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
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
if($lvtc_lv0013->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmadd" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvtc_lv0013->lv001=="")?InsertWithCheckExt('tc_lv0013', 'lv001', 'TIMES',4):$lvtc_lv0013->lv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)" />			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvtc_lv0013->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
								<select  name="txtlv003"  id="txtlv003"  tabindex="7" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/><?php echo $lvtc_lv0013->LV_LinkField('lv003',$lvtc_lv0013->lv003);?>
								</select>
							  </td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','tc_lv0039','concat(lv002,@!-@!,lv001)')" onFocus="LoadPopup(this,'txtlv003','tc_lv0039','concat(lv002,@!-@!,lv001)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
								</li>
							</ul></td></tr></table>
						</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><input name="txtlv004" id="txtlv004"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvtc_lv0013->FormatView($lvtc_lv0013->lv004,2);?>"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv004);return false;" /></span></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvtc_lv0013->FormatView($lvtc_lv0013->lv005,2);?>" tabindex="9" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv005);return false;" /></span></td>
						    </tr>	
							  	<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" rows="15" id="txtlv006" style="width:80%" tabindex="10" value="<?php echo $lvtc_lv0013->lv006;?>"></td>
							</tr>	
							  	<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[21];?></td>
							  <td  height="20"><input name="txtlv007"  id="txtlv007" style="width:80%" tabindex="11" value="<?php echo $lvtc_lv0013->lv007;?>"></td>
							</tr>	
							
							<tr>
								<td  height="20px"><?php echo $vLangArr[22];?></td>
								<td  height="20px">
									<select  name="txtlv008"  id="txtlv008"  tabindex="12" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)">
										<option value="0" <?php echo ($lvtc_lv0013->lv008=='0')?'selected="selected"':'';?>>No</option>
										<option value="1" <?php echo ($lvtc_lv0013->lv008=='1')?'selected="selected"':'';?>>Yes</option>
									</select>	 
								</td>
							  </tr>								 
							<tr>
							  <td  height="20px"><?php echo $vLangArr[23];?></td>
								<td  height="20px"><select  name="txtlv009"  id="txtlv009"  tabindex="12" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)">
										<option value="0" <?php echo ($lvtc_lv0013->lv009=='0')?'selected="selected"':'';?>>No</option>
										<option value="1" <?php echo ($lvtc_lv0013->lv009=='1' || $lvtc_lv0013->lv009=='')?'selected="selected"':'';?>>Yes</option>
									</select></td>
							  </tr>
							  	<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[24];?></td>
							  <td  height="20"><textarea name="txtlv010" rows="15" id="txtlv010" style="width:80%" tabindex="14"><?php echo $lvtc_lv0013->lv010;?></textarea></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><input name="txtlv012"  id="txtlv012" style="width:80%" tabindex="15" value="<?php echo ($lvtc_lv0013->lv012=="")?"8":$lvtc_lv0013->lv012;?>"  onKeyPress="return CheckKey(event,7)"></td>
							</tr>	
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[27];?></td>
							  <td  height="20"><input name="txtlv013"  id="txtlv013" style="width:80%" tabindex="16" value="<?php echo ($lvtc_lv0013->lv013=="")?"1.5":$lvtc_lv0013->lv013;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>	
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[28];?></td>
							  <td  height="20"><input name="txtlv014"  id="txtlv014" style="width:80%" tabindex="17" value="<?php echo ($lvtc_lv0013->lv014=="")?"1":$lvtc_lv0013->lv014;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>	
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[29];?></td>
							  <td  height="20"><input name="txtlv015"  id="txtlv015" style="width:80%" tabindex="18" value="<?php echo ($lvtc_lv0013->lv015=="")?"11000000":$lvtc_lv0013->lv015;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							 <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[33];?></td>
							  <td  height="20"><input name="txtlv016"  id="txtlv016" style="width:80%" tabindex="19" value="<?php echo ($lvtc_lv0013->lv016=="")?"1":$lvtc_lv0013->lv016;?>" onKeyPress="return CheckKey(event,7)"></td>
						  </tr>	
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[34];?></td>
							  <td  height="20"><input name="txtlv017"  id="txtlv017" style="width:80%" tabindex="20" value="<?php echo ($lvtc_lv0013->lv017=="")?"17.5":$lvtc_lv0013->lv017;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>	
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[35];?></td>
							  <td  height="20"><input name="txtlv018"  id="txtlv018" style="width:80%" tabindex="21" value="<?php echo ($lvtc_lv0013->lv018=="")?"3":$lvtc_lv0013->lv018;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>	
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[36];?></td>
							  <td  height="20"><input name="txtlv019"  id="txtlv019" style="width:80%" tabindex="22" value="<?php echo ($lvtc_lv0013->lv019=="")?"1":$lvtc_lv0013->lv019;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[37];?></td>
							  <td  height="20"><input name="txtlv020"  id="txtlv020" style="width:80%" tabindex="22" value="<?php echo ($lvtc_lv0013->lv020=="")?"7500000":$lvtc_lv0013->lv020;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
                            <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[38];?></td>
							  <td  height="20">
								<select name="txtlv021"  id="txtlv021" style="width:80%" tabindex="22" onKeyPress="return CheckKey(event,7)">
									<option value="0" <?php echo ($lvtc_lv0013->lv021=='0')?'selected="selected"':'';?>>No</option>
									<option value="1" <?php echo ($lvtc_lv0013->lv021=='1')?'selected="selected"':'';?>>Yes</option>
								</select>
							  </td>
							</tr>
							 <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[39];?></td>
							  <td  height="20"><input name="txtlv022"  id="txtlv022" style="width:80%" tabindex="22" value="<?php echo ($lvtc_lv0013->lv022=="")?"0.85":$lvtc_lv0013->lv022;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[40];?></td>
							  <td  height="20"><input name="txtlv023"  id="txtlv023" style="width:80%" tabindex="22" value="<?php echo ($lvtc_lv0013->lv023=="")?"4400000":$lvtc_lv0013->lv023;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[45];?></td>
							  <td  height="20"><input name="txtlv024"  id="txtlv024" style="width:80%" tabindex="22" value="<?php echo ($lvtc_lv0013->lv024=="")?"1":$lvtc_lv0013->lv024;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[46];?></td>
							  <td  height="20"><input name="txtlv025"  id="txtlv025" style="width:80%" tabindex="22" value="<?php echo ($lvtc_lv0013->lv025=="")?'20000':$lvtc_lv0013->lv025;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[15];?></td>
							  <td  height="20px">
							  <table width="80%"><tr><td width="50%"><select  name="txtlv051"  id="txtlv051"  tabindex="19" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/><?php echo $lvtc_lv0013->LV_LinkField('lv051',$lvtc_lv0013->lv051);?>
				  </select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv051_search" id="txtlv051_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv051','tc_lv0013','lv002')" onFocus="LoadPopup(this,'txtlv051','tc_lv0013','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>					 </td>
						  </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo 'Mốc tính phí công đoàn tối thiểu';?></td>
							  <td  height="20"><input name="txtlv026"  id="txtlv026" style="width:80%" tabindex="22" value="<?php echo ($lvtc_lv0013->lv026=="")?'42000000':$lvtc_lv0013->lv026;?>" onKeyPress="return CheckKey(event,7)">
							  
							  </td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo 'Tính gross salary theo công thức';?></td>
							  <td  height="20"><input name="txtlv099"  id="txtlv099" style="width:80%" tabindex="22" value="<?php echo ($lvtc_lv0013->lv099=="")?'':$lvtc_lv0013->lv099;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo 'Mã cột thay thế';?></td>
							  <td  height="20"><input name="txtlv100"  id="txtlv100" style="width:80%" tabindex="22" value="<?php echo ($lvtc_lv0013->lv100=="")?'N17':$lvtc_lv0013->lv100;?>" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo 'Cách tính lương';?></td>
							  <td  height="20">
								<select name="txtlv098"  id="txtlv098" style="width:80%" tabindex="22" onKeyPress="return CheckKey(event,7)">
									<option value="0">0. Cho phép tất cả trường hợp trừ ngày làm và ngày nghỉ việc không nằm tháng tính lương</option>
									<option selected="selected" value="1" <?php echo ($lvtc_lv0013->lv098=='1')?'selected="selected"':'';?>>1. Chỉ nhân viên có lương, có công , có thai sản, có nghỉ SL mới có dòng lương </option>
									<option value="2">2. Cho phép tất cả trường hợp được thêm dòng lương </option>
								</select>
							  </td>
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
<script language="javascript">
	var o=document.frmadd;
		o.txtlv002.focus();
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