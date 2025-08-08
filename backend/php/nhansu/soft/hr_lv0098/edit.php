<?php
session_start();
//require_once("../../clsall/hr_lv0098.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0098.php");
//////////////init object////////////////
$lvhr_lv0098=new hr_lv0098($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0098');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0202.txt",$plang);
$lvhr_lv0098->lang= $plang;
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0098->lv001=$_GET['ChildID'];
if($vFlag==1)
{
		$lvhr_lv0098->lv002= $_GET['ID'] ?? '';
		$lvhr_lv0098->lv003=$_POST['txtlv003'];
		$lvhr_lv0098->lv004=$_POST['txtlv004'];
		$lvhr_lv0098->lv005=GetServerDate();
		$lvhr_lv0098->lv006=$_POST['txtlv006'];
		$lvhr_lv0098->lv007=$_POST['txtlv007'];
		$lvhr_lv0098->lv008=$_POST['txtlv008'];
		$lvhr_lv0098->lv009=$_POST['txtlv009'];
		$lvhr_lv0098->lv010=$_POST['txtlv010'];
		$lvhr_lv0098->lv011=$_POST['txtlv011'];
		$lvhr_lv0098->lv012=$_POST['txtlv012'];
		$lvhr_lv0098->lv013=$_POST['txtlv013'];
		$lvhr_lv0098->lv099=$_POST['txtlv099'];
		$vresult=$lvhr_lv0098->LV_Update();
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
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>
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
<!--
function isnumber(s){
	if(s!=""){
		var str="0123456789"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert("<?php echo $vLangArr[21];?>");	
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
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv003.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmedit;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,14,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmedit;
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[21];?>");
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
$lvhr_lv0098->LV_LoadID($lvhr_lv0098->lv001);
if($lvhr_lv0098->GetEdit()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmedit" method="post">
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
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="*%"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvhr_lv0098->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0098->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>												
							 <tr>
						  <td  height="20px"><?php echo $vLangArr[17];?></td>
			  <td  height="20px"><select  name="txtlv003"  id="txtlv003"  tabindex="6" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0098->LV_LinkField('lv003',$lvhr_lv0098->lv003);?>
			  </select>							 </td>
						  </tr>	
							<tr>
							  <td  height="20px"><?php echo 'Hợp đồng liên kết';?></td>
							  <td  height="20px"><select  name="txtlv099"  id="txtlv099"  onblur="LoadSource(this.value)"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0098->LV_LinkField('lv099',$lvhr_lv0098->lv099);?>
			  </select>	</td>
							  </tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv004);return false;" name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0098->FormatView($lvhr_lv0098->lv004,2);?>" tabindex="7" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv004);return false;" /></span></td>
							  </tr>
							 
								<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><select  name="txtlv006"  id="txtlv006"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0098->LV_LinkField('lv006',$lvhr_lv0098->lv006);?>
			  </select>	</td>
							  </tr>	
							 <tr>
							   <td  height="20px"><?php echo 'Chức vụ VN';?></td>
				  				<td  height="20px"><input name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvhr_lv0098->lv010;?>" tabindex="7" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							  <tr>
							   <td  height="20px"><?php echo 'Chức vụ EN';?></td>
				  				<td  height="20px"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvhr_lv0098->lv011;?>" tabindex="7" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							  <tr>
							   <td  height="20px"><?php echo 'Chức vụ theo luật VN';?></td>
				  				<td  height="20px"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo $lvhr_lv0098->lv012;?>" tabindex="7" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							  <tr>
							   <td  height="20px"><?php echo 'Chức vụ theo luật EN';?></td>
				  				<td  height="20px"><input name="txtlv013" type="text" id="txtlv013" value="<?php echo $lvhr_lv0098->lv013;?>" tabindex="7" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							
							<tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvhr_lv0098->lv007;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>		
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
				  <td  height="20px"><select  name="txtlvtype"  id="txtlvtype"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadText(this,'txtlv008','hr_lv0043','lv003',document.frmedit.txtlv002.value,2,'<?php echo $plang;?>'+'&StartDate='+document.frmedit.txtlv004.value+'&EndDate='+document.frmedit.txtlv005.value+'&TimeWork='+document.frmedit.txtlv007.value)"/><option value=""></option><?php echo $lvhr_lv0098->LV_LinkField('lv100',$lvhr_lv0098->lv100);?>
				  </select>							 </td>
							  </tr>	
							  	<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><textarea name="txtlv008" rows="20" id="txtlv008" style="width:80%" tabindex="13"><?php echo $lvhr_lv0098->lv008;?></textarea></td>
							</tr>
 <tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input readonly="readonly" name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvhr_lv0098->FormatView($lvhr_lv0098->lv005,2);?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      </td>
							  </tr>							
							<tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
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
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>