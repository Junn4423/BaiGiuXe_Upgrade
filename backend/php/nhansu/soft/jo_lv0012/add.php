<?php
session_start();
$vDir="../";
//require_once("../../clsall/jo_lv0012.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/jo_lv0012.php");
//////////////init object////////////////
$lvjo_lv0012=new jo_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","JO0006.txt",$plang);
$mojo_lv0012->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvjo_lv0012->lv001=$_POST['txtlv001'];
$lvjo_lv0012->lv002=$_POST['txtlv002'];
$lvjo_lv0012->lv003=$_POST['txtlv003'];
$lvjo_lv0012->lv004=$_POST['txtlv004'];
$lvjo_lv0012->lv005=$_POST['txtlv005'];
$lvjo_lv0012->lv006=$_POST['txtlv006'];
$lvjo_lv0012->lv007=$_POST['txtlv007'];
$lvjo_lv0012->lv008=$_POST['txtlv008'];
$lvjo_lv0012->lv009=$_POST['txtlv009'];
$lvjo_lv0012->lv010=$_POST['txtlv010'];
$lvjo_lv0012->lv011=$_POST['txtlv011'];
$lvjo_lv0012->lv012=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$lvjo_lv0012->lv013=$_POST['txtlv013'];
$lvjo_lv0012->lv014=$_POST['txtlv014'];
$lvjo_lv0012->lv015=$_POST['txtlv015'];
$lvjo_lv0012->lv016=$_POST['txtlv016'];
if($lvjo_lv0012->lv016=="" || $lvjo_lv0012->lv016==NULL) $lvjo_lv0012->lv016=GetServerDate();
$lvjo_lv0012->lv017=$_POST['txtlv017'];
$lvjo_lv0012->lv018=$_POST['txtlv018'];
$lvjo_lv0012->lv019=$_POST['txtlv019'];
$lvjo_lv0012->lv020=$_POST['txtlv020'];
$lvjo_lv0012->lv021=$_POST['txtlv021'];
$lvjo_lv0012->lv022=$_POST['txtlv022'];
$lvjo_lv0012->lv023=GetServerDate().' '.GetServerTime();
if($vFlag==1)
{
		
		$vresult=$lvjo_lv0012->LV_Insert();
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
		o.txtlv011.value="";
		o.txtlv012.value="";
		o.txtlv013.value="";
		o.txtlv014.value="";
		o.txtlv015.value="";
		o.txtlv016.value="";
		o.txtlv017.value="";
		o.txtlv018.value="";
		o.txtlv019.value="";
		o.txtlv020.value="";
		o.txtlv021.value="";
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
		//o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[38];?>");
			o.txtlv001.select();
		}
		else if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[39];?>");
			o.txtlv002.focus();
			}
		else if(o.txtlv008.value==""){
			alert("<?php echo $vLangArr[40];?>");
			o.txtlv008.focus();
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
if($lvjo_lv0012->GetAdd()>0)
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvjo_lv0012->lv001=="")?InsertWithCheck('jo_lv0012', 'lv001', 'TASK',1):$lvjo_lv0012->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvjo_lv0012->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvjo_lv0012->LV_LinkField('lv003',$lvjo_lv0012->lv003);?>
							  </select>	<br><table><tr><td>
							  <ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" onFocus="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				 			  <td  height="20"><select name="txtlv004" id="txtlv004"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvjo_lv0012->LV_LinkField('lv004',$lvjo_lv0012->lv004);?>
							  </select>	<br><table><tr><td>
							  <ul id="pop-nav2" lang="pop-nav2" onkeyup="ChangeName(this,2)" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv004','jo_lv0003','lv002')" onFocus="LoadPopup(this,'txtlv004','jo_lv0003','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
								</li>
							  </ul></td></tr></table></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><select name="txtlv006" id="txtlv006"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvjo_lv0012->LV_LinkField('lv006',$lvjo_lv0012->lv006);?>
							  </select>	<br><table><tr><td>
							  <ul id="pop-nav3" lang="pop-nav3" onkeyup="ChangeName(this,3)" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv006','jo_lv0003','lv002')" onFocus="LoadPopup(this,'txtlv006','jo_lv0003','lv002')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table></td>
							  </tr>	
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><textarea rows="5" name="txtlv008" id="txtlv008"   tabindex="12"  style="width:80%"><?php echo $lvjo_lv0012->lv008;?></textarea></td>
						    </tr>
						    <tr>
								<td width="166"  height="20"><?php echo $vLangArr[27];?></td>
								<td width="178"  height="20">
									<input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvjo_lv0012->lv013;?>" readonly="true" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>	
									<br><table><tr><td>
							  <ul id="pop-nav4" lang="pop-nav4" onkeyup="ChangeName(this,4)" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv013','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv013','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
							  <td  height="20"><input name="txtlv014" type="text" id="txtlv014" readonly="true"  value="<?php echo $lvjo_lv0012->lv014;?>" tabindex="18" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <br><table><tr><td>
							  <ul id="pop-nav5" lang="pop-nav5" onkeyup="ChangeName(this,5)" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv014','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv014','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup5" lang="lv_popup5"> </div>						  
						</li>
					</ul></td></tr></table>
						</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
							  <td  height="20"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvjo_lv0012->lv015;?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <br><table><tr><td>
							  <ul id="pop-nav6" lang="pop-nav6" onkeyup="ChangeName(this,6)" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv015','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv015','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[30];?></td>
				  <td  height="20"><input  name="txtlv016" type="text" id="txtlv016" value="<?php echo formatdate($lvjo_lv0012->lv016,$plang);?>" tabindex="20" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv016);return false;" /></span></td>
						  </tr>		
                          <tr>
							  <td  height="20"><?php echo $vLangArr[31];?></td>
							  <td  height="20"><input name="txtlv017" type="text" id="txtlv017" value="<?php echo formatdate($lvjo_lv0012->lv017,$plang);?>" tabindex="21" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv017);return false;" /></span></td>
							  </tr>		
						<tr>
								<td width="166"  height="20"><?php echo $vLangArr[32];?></td>
								<td width="178"  height="20">
									<input name="txtlv018" id="txtlv018"   tabindex="22"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo formatdate($lvjo_lv0012->lv018,$plang);?>" onfocus="if(document.frmadd.txtlv018.value=='') document.frmadd.txtlv018.value=document.frmadd.txtlv017.value;"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv018);return false;" /></span></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[33];?></td>
							  <td  height="20"><input name="txtlv019" id="txtlv019" style="width:80%" tabindex="23" onKeyPress="return CheckKey(event,7)" value="<?php echo formatdate($lvjo_lv0012->lv019,$plang);?>"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv019);return false;" /></span></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[34];?></td>
							  <td  height="20"><input  name="txtlv020" type="text" id="txtlv020" value="<?php echo $lvjo_lv0012->lv020;?>" tabindex="24" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[36];?></td>
								<td width="178"  height="20">
									<select name="txtlv022" id="txtlv022"   tabindex="24"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvjo_lv0012->LV_LinkField('lv022',$lvjo_lv0012->lv022);?>
							  </select><br><table><tr><td>
							  <ul id="pop-nav7" lang="pop-nav7" onkeyup="ChangeName(this,7)" onMouseOver="ChangeName(this,7)" onkeyup="ChangeName(this,7)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch2" id="txtlvsearch2" style="width:200px" onKeyUp="LoadPopup(this,'txtlv022','jo_lv0015','lv002')" onFocus="LoadPopup(this,'txtlv022','jo_lv0015','lv002')" tabindex="200" >
							    <div id="lv_popup7" lang="lv_popup7"> </div>						  
						</li>
					</ul></td></tr></table>			</td>
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