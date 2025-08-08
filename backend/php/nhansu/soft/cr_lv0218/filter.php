<?php
session_start();
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

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","JO0006.txt",$plang);

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
$vlv012=$_GET['lv012'];
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
$vlv036=$_GET['lv036'];
$vlv037=$_GET['lv037'];
$vlv038=$_GET['lv038'];
$vlv039=$_GET['lv039'];
$vlv040=$_GET['lv040'];
$vlv041=$_GET['lv041'];
$vlv042=$_GET['lv042'];
$vcheckmonth=$_GET['checkmonth'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>

</head>
<script language="javascript">
<!--
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
		
		o.txtlv002.value=document.frmfilter.txtlv002.value;		
		o.txtlv003.value=document.frmfilter.txtlv003.value;		
		o.txtlv022.value=document.frmfilter.txtlv022.value;		
		o.txtlv015.value=document.frmfilter.txtlv015.value;		
		o.txtlv016.value=document.frmfilter.txtlv016.value;
		o.txtlv017.value=document.frmfilter.txtlv017.value;
		if(document.frmfilter.txtcheckmonth.checked)
		{
			o.txtcheckmonth.value='1';
			o.txtcheckmonth.checked=true;
		}
		else
		{
			o.txtcheckmonth.value='0';
			o.txtcheckmonth.checked=false;
		}
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
					<form action="#" name="frmfilter" method="post">
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php $vlv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			
									Hiển thị tất cả<input type="checkbox" name="txtcheckmonth" value="1" onclick="document.frmchoose.submit();" <?php echo (($vcheckmonth==1)?'checked="true"':"");?>/>
									</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><table width="80%"><tr><td width="50%"><select name="txtlv002" id="txtlv002"   tabindex="5"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							   <option value=""></option>
							  <?php echo $lvjo_lv0004->LV_LinkField('lv002',$vlv002);?>
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
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><table width="80%"><tr>
							  <td width="50%"><select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:100%" onKeyPress="return CheckKey(event,7)">
							  <option value=""></option>
							  <?php echo $lvjo_lv0004->LV_LinkField('lv003',$lvjo_lv0004->lv003);?>
							  </select>	</td>
							  <td>
							  <ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" onFocus="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[36];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
								<select name="txtlv022" id="txtlv022"   tabindex="5"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
										<option value=""></option>
										<?php echo $lvjo_lv0004->LV_LinkField('lv022',$vlv022);?>
									</select>
							  </td><td>
							  <ul id="pop-nav66" lang="pop-nav66" onkeyup="ChangeName(this,66)" onMouseOver="ChangeName(this,66)" onkeyup="ChangeName(this,66)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv015_search" id="txtlv015_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv022','jo_lv0100','lv002')" onFocus="LoadPopup(this,'txtlv022','jo_lv0100','lv002')" tabindex="200" >
							    <div id="lv_popup66" lang="lv_popup66"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>					  
							
							<tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
							  <td  height="20"><table width="80%"><tr>
							  <td width="50%"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $vlv015;?>" tabindex="19" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/>
							  </td><td>
							  <ul id="pop-nav6" lang="pop-nav6" onkeyup="ChangeName(this,6)" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200%" onKeyUp="LoadPopup(this,'txtlv015','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@! - @!,lv001)')" onFocus="LoadPopup(this,'txtlv015','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@! - @!,lv001)')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[30];?></td>
				  <td  height="20"><input  name="txtlv016" type="text" id="txtlv016" value="<?php echo formatdate($lvjo_lv0004->lv016,$plang);?>" tabindex="20" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv016);return false;" /></span></td>
						  </tr>		
                          <tr>
							  <td  height="20"><?php echo $vLangArr[31];?></td>
							  <td  height="20"><input name="txtlv017" type="text" id="txtlv017" value="<?php echo formatdate($lvjo_lv0004->lv017,$plang);?>" tabindex="21" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv017);return false;" /></span></td>
							  </tr>		
						
						  <tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
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
<script language="javascript">
	var o=document.frmfilter;
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