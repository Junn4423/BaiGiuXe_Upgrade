<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/hr_lv0238.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0238.php");
//////////////init object////////////////
$lvhr_lv0238=new hr_lv0238($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0238');
/////////Get ID///////////////
$lvhr_lv0238->lv001=$_GET['ChildID'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0124.txt",$plang);
$lvhr_lv0238->lang= $plang;
$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$vStrMessage="";
if($vFlag==1)
{
		$lvhr_lv0238->lv002=$_POST['txtlv002'];
		$lvhr_lv0238->lv003=$_POST['txtlv003'];
		$lvhr_lv0238->lv004=$_POST['txtlv004'];
		$lvhr_lv0238->lv005=$_POST['txtlv005'];
		$lvhr_lv0238->lv006=$_POST['txtlv006'];		
		$lvhr_lv0238->lv007=$_POST['txtlv007'];
		$lvhr_lv0238->lv008=$_POST['txtlv008'];
		$lvhr_lv0238->lv009=$_POST['txtlv009'];
		$lvhr_lv0238->lv010=$_POST['txtlv010'];
		$lvhr_lv0238->lv011=$_POST['txtlv011'];
		$lvhr_lv0238->lv012=$_POST['txtlv012'];
		$lvhr_lv0238->lv013=$_POST['txtlv013'];
		$lvhr_lv0238->lv014=$_POST['txtlv014'];
		$lvhr_lv0238->lv015=$_POST['txtlv015'];
		$lvhr_lv0238->lv016=$_POST['txtlv016'];
		$lvhr_lv0238->lv017=$_POST['txtlv017'];
		$lvhr_lv0238->lv018=$_POST['txtlv018'];
		$lvhr_lv0238->lv019=$_POST['txtlv019'];
		$lvhr_lv0238->lv020=$_POST['txtlv020'];
		$lvhr_lv0238->lv021=$_POST['txtlv021'];
		$lvhr_lv0238->lv022=$_POST['txtlv022'];
		$lvhr_lv0238->lv023=$_POST['txtlv023'];
		$lvhr_lv0238->lv024=$_POST['txtlv024'];
		$lvhr_lv0238->lv025=$_POST['txtlv025'];
		$lvhr_lv0238->lv026=$_POST['txtlv026'];
		$lvhr_lv0238->lv027=$_POST['txtlv027'];
		$lvhr_lv0238->lv028=$_POST['txtlv028'];
		$lvhr_lv0238->lv029=$_POST['txtlv029'];
		$lvhr_lv0238->lv030=$_POST['txtlv030'];
		$lvhr_lv0238->lv031=$_POST['txtlv031'];
		$lvhr_lv0238->lv032=$_POST['txtlv032'];
		$lvhr_lv0238->lv033=$_POST['txtlv033'];
		$lvhr_lv0238->lv034=$_POST['txtlv034'];
		$lvhr_lv0238->lv035=$_POST['txtlv035'];
		$lvhr_lv0238->lv036=$_POST['txtlv036'];
		$lvhr_lv0238->lv037=$_POST['txtlv037'];
		$lvhr_lv0238->lv098=$_POST['txtlv098'];
		$lvhr_lv0238->lv099=$_POST['txtlv099'];
		$lvhr_lv0238->lv299=$_POST['txtlv299'];
		$vresult=$lvhr_lv0238->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();
			$vFlag=0;
		}

}

$lvhr_lv0238->LV_LoadID($lvhr_lv0238->lv001);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<!-- TinyMCE -->
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
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
	
</script>
</head>
<script language="javascript">
function localreplaces(lookfor,replacewith,sentence)
{
	var s;
	s="";
	var len1,len2,len3,dem;
	len1=lookfor.length;
	len3=replacewith.length;
	len2=sentence.length;
	dem=0;
	if(len1>len2)
	   return sentence;
	else
			{for(var i=0;i<len2;i++)
			  {if(i<=len2-len1)
				   {for(var j=0;j<len1;j++)
				    if(lookfor.charAt(j)==sentence.charAt(i+j))
					  {				  dem++;
					  }
					 if(dem==len1)
					 {for(var p=0;p<len3;p++)
						s=s+replacewith.charAt(p);
						i=i+len1-1;
						dem=0;
					 }
					 else
					 {dem=0;
					  s=s+sentence.charAt(i);
					 }
				  }
				else
				 {s=s+sentence.charAt(i);
				 }
			}
			
			}return s;
}
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
		o.txtlv002.value="<?php echo $lvhr_lv0238->lv002;?>";
		o.txtlv003.value="<?php echo $lvhr_lv0238->lv003;?>";
		o.txtlv004.value="<?php echo $lvhr_lv0238->lv004;?>";
		o.txtlv005.value="<?php echo $lvhr_lv0238->lv005;?>";
		o.txtlv006.value="<?php echo $lvhr_lv0238->lv006;?>";				
		o.txtlv002.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,24,0)?>";
		o.submit();
	}
		function Save()
	{
		var o=document.frmedit;
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[24];?>");
			o.txtlv002.select();
		}
		else if(o.txtlv003.value==""){
			alert("<?php echo $vLangArr[25];?>");
			o.txtlv003.focus();
			}
		else if(o.txtlv004.value==""){
			alert("<?php echo $vLangArr[26];?>");
			o.txtlv004.select();
			}	
		else if(o.txtlv005.value==""){
			alert("<?php echo $vLangArr[26];?>");
			o.txtlv005.select();
			}
		else
			{
			o.txtFlag.value="1";
			o.submit();
			}
			
	}
	function text_replace(str)
	{
		str=localreplaces("'","|01",str);
		str=localreplaces("&","|02",str);
		return str;
	}
	function LoadHD(othis)
   {
		var o=document.frmedit;
		var strCotLuong='&cot21='+parseFloat('0'+o.txtlv021.value)+'&cot22='+parseFloat('0'+o.txtlv022.value)+'&cot13='+parseFloat('0'+o.txtlv013.value)+'&cot14='+parseFloat('0'+o.txtlv014.value)+'&cot26='+parseFloat('0'+o.txtlv026.value)+'&cot16='+parseFloat('0'+o.txtlv016.value)+'&cot18='+parseFloat('0'+o.txtlv018.value)+'&cot20='+parseFloat('0'+o.txtlv020.value)+'&cot25='+parseFloat('0'+o.txtlv025.value)+'&cot23='+parseFloat('0'+o.txtlv023.value)+'&cot31='+parseFloat('0'+o.txtlv031.value)+'&cot32='+parseFloat('0'+o.txtlv032.value)+'&cot33='+parseFloat('0'+o.txtlv033.value);
		var strTextRun='<?php echo $plang;?>'+'&StartDate='+o.txtlv004.value+'&StartDateTV='+o.txtlv098.value+'&EndDate='+o.txtlv005.value+'&TimeWork='+o.txtlv007.value+'&ContractLaborID='+o.txtlv006.value+'&TitleVN='+text_replace(o.txtlv027.value)+'&TitleEN='+text_replace(o.txtlv028.value)+'&HDPrevious='+o.txtlv099.value+'&LawTitleVN='+text_replace(o.txtlv029.value)+'&LawTitleEN='+text_replace(o.txtlv030.value)+strCotLuong;
		LoadText(othis,'txtlv008','hr_lv0043','lv003',o.txtlv002.value,2,strTextRun)
   }
</script>
<body bgcolor=""  onkeyup="KeyPublicRun(event)">
<div id="content_child">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
  <div class="story">
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form name="frmedit" action="#" method="post">
					<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr><td colspan="2" align="center">
					<?php		
						echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
						?>
							</td></tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="*%"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvhr_lv0238->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0238->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
				  <td  height="20px"><select  name="txtlv003"  id="txtlv003"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/><?php echo $lvhr_lv0238->LV_LinkField('lv003',$lvhr_lv0238->lv003);?></select>
				  
							 </td>
							  </tr>													  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv004);return false;" name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0238->FormatView($lvhr_lv0238->lv004,2);?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv004);return false;" /></span></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo 'Ngày in Hợp đồng';?></td>
							  <td  height="20px"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv098);return false;" name="txtlv098" type="text" id="txtlv098" value="<?php echo $lvhr_lv0238->FormatView($lvhr_lv0238->lv098,2);?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv098);return false;" /></span></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv005);return false;" name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvhr_lv0238->FormatView($lvhr_lv0238->lv005,2);?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv005);return false;" /></span></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvhr_lv0238->lv006;?>" tabindex="11" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>																			
							<tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvhr_lv0238->lv007;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							 <tr>
							 	 <td  height="20px"><?php echo $vLangArr[27];?></td>
				  				 <td  height="20px"><table style="width:80%"><tr><td style="width:50%"><select  name="txtlv010"  id="txtlv010"  tabindex="12" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)" <option value=""></option><?php echo $lvhr_lv0238->LV_LinkField('lv010',$lvhr_lv0238->lv010);?>
				  									</select>	
													</td>
							  <td>
								<ul id="pop-nav" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
									<input type="text" autocomplete="off" class="search_img_btn" name="txtlv010_search" id="txtlv010_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv010','hr_lv0002','concat(lv003,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv023','txtlv010','concat(lv003,@! @!,lv001)')" tabindex="200" >
									<div id="lv_popup" lang="lv_popup6"> </div>						  
									</li>
								</ul></td></tr></table></td>
				 				 </td>
							  </tr>		
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
				  				<td  height="20px"><select  name="txtlv009"  id="txtlv009"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadHD(this)"/><option value=""></option><?php echo $lvhr_lv0238->LV_LinkField('lv020',$lvhr_lv0238->lv009);?>
				  									</select>							 
				  				</td>
							  </tr>	
							  	<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><textarea name="txtlv008" rows="20" id="txtlv008" style="width:80%" tabindex="13"><?php echo $lvhr_lv0238->lv008;?></textarea></td>
							</tr>																	
							
							 <tr>
							  <td  height="20px"><?php echo $vLangArr[28];?></td>
				  				<td  height="20px"><select  name="txtlv011"  id="txtlv011"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0238->LV_LinkField('lv011',$lvhr_lv0238->lv011);?>
				  									</select>							 
				  				</td>
							  </tr>	
							   <tr>
							  <td  height="20px"><?php echo $vLangArr[29];?></td>
				  				<td  height="20px"><select  name="txtlv012"  id="txtlv012"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0238->LV_LinkField('lv012',$lvhr_lv0238->lv012);?>
				  									</select>							 
				  				</td>
							  </tr>
 <tr>
							  <td  height="20px"><?php echo $vLangArr[32];?></td>
				  				<td  height="20px"><select  name="txtlv015"  id="txtlv015"  tabindex="15" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" />
													<option value="0" <?php echo ($lvhr_lv0238->lv015=="0")?'selected="selected"':''?>>No</option>
													<option value="1" <?php echo ($lvhr_lv0238->lv015=="1")?'selected="selected"':''?>>Yes</option>
				  									</select>							 
				  				</td>
							  </tr>	
							
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[36];?></td>
							  <td  height="20px"><select  name="txtlv019"  id="txtlv019"  tabindex="17" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" />
													<option value="0" <?php echo ($lvhr_lv0238->lv019=="0")?'selected="selected"':''?>>Gross Salary</option>
													<option value="1" <?php echo ($lvhr_lv0238->lv019=="1")?'selected="selected"':''?>>Net Salary</option>
				  									</select>	</td>
							  </tr>								  
							    <tr>
							  <td  height="20px"><?php echo $vLangArr[38];?></td>
				  				<td  height="20px"><input name="txtlv021" type="text" id="txtlv021" value="<?php echo $lvhr_lv0238->lv021;?>" tabindex="20" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>	
							   <tr>
							  <td  height="20px"><?php echo $vLangArr[41];?></td>
				  				<td  height="20px"><select  name="txtlv024"  id="txtlv024"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0238->LV_LinkField('lv024',$lvhr_lv0238->lv024);?>
				  									</select>							 
				  				</td>
							  </tr>	
							  <tr>
							   <td  height="20px"><?php echo $vLangArr[44];?></td>
				  				<td  height="20px"><input name="txtlv027" type="text" id="txtlv027" value="<?php echo $lvhr_lv0238->lv027;?>" tabindex="21" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							  <tr>
							   <td  height="20px"><?php echo $vLangArr[45];?></td>
				  				<td  height="20px"><input name="txtlv028" type="text" id="txtlv028" value="<?php echo $lvhr_lv0238->lv028;?>" tabindex="21" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							  <tr>
							   <td  height="20px"><?php echo $vLangArr[46];?></td>
				  				<td  height="20px"><input name="txtlv029" type="text" id="txtlv029" value="<?php echo $lvhr_lv0238->lv029;?>" tabindex="21" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							  <tr>
							   <td  height="20px"><?php echo $vLangArr[47];?></td>
				  				<td  height="20px"><input name="txtlv030" type="text" id="txtlv030" value="<?php echo $lvhr_lv0238->lv030;?>" tabindex="21" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							 <tr>
							   <td  height="20px"><?php echo $vLangArr[48];?></td>
				  				<td  height="20px">
									<select  name="txtlv099"  id="txtlv099"  tabindex="6" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
										<option value=""></option><?php echo $lvhr_lv0238->LV_LinkField('lv099',$lvhr_lv0238->lv099);?>
				  					</select>							 
				  				</td>
							  </tr>	
							  <tr>
								<td  height="20"><?php echo 'KPI';?></td>
							    <td  height="20">
									<table style="width:80%"><tr><td style="width:50%">
										<select name="txtlv299"  id="txtlv299" value="<?php echo $lvhr_lv0020->lv299;?>" tabindex="11"  style="width:100%" onKeyPress="return CheckKey(event,7)">
									 	<?php echo $lvhr_lv0238->LV_LinkField('lv299',$lvhr_lv0238->lv299);?>
									 	</select>
								 	</td>
								  <td>
									<ul id="pop-nav99" lang="pop-nav99" onMouseOver="ChangeName(this,99)" onkeyup="ChangeName(this,99)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv299_search" id="txtlv299_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv299','ki_lv0003','lv002')" onFocus="LoadPopup(this,'txtlv299','ki_lv0003','lv002')" tabindex="200" >
										<div id="lv_popup99" lang="lv_popup99"> </div>						  
										</li>
									</ul></td></tr></table>
							    </td>
								
							</tr>
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
				
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmedit;
		o.txtlv003.focus();
</script>
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
</body>
</html>