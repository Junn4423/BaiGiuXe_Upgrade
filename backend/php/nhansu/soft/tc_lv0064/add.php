<?php
session_start();
//require_once("../../clsall/tc_lv0064.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0064.php");
//////////////init object////////////////
$lvtc_lv0064=new tc_lv0064($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0064');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0105.txt",$plang);

$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvtc_lv0064->lv001=InsertWithCheckExt('tc_lv0064', 'lv001', '',1);
$lvtc_lv0064->lv002= $_GET['ID'] ?? '';
$lvtc_lv0064->lv003=$_POST['txtlv003'];
$lvtc_lv0064->lv004=$_POST['txtlv004'];
$lvtc_lv0064->lv005=$_POST['txtlv005'];
$lvtc_lv0064->lv006=$_POST['txtlv006'];
$lvtc_lv0064->lv007=$_POST['txtlv007'];
$lvtc_lv0064->lv008=$_POST['txtlv008'];
$lvtc_lv0064->lv009=$_POST['txtlv009'];
$lvtc_lv0064->lv010=$_POST['txtlv010'];
$lvtc_lv0064->lv011=$_POST['txtlv011'];
$lvtc_lv0064->lv012=$_POST['txtlv012'];
if($vFlag==1)
{
		
		$vresult=$lvtc_lv0064->LV_Insert();
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
</head>
<script language="javascript">
<!--
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
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv003.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[27];?>");
			o.txtlv002.select();
		}
		else if(o.txtlv003.value=="")
		{
			alert("<?php echo $vLangArr[28];?>");
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
if($lvtc_lv0064->GetAdd()>0)
{
?>

<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmadd" method="post">
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvtc_lv0064->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvtc_lv0064->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
				  <td  height="20px"><table width="80%"><tr><td width="50%"><select  name="txtlv003"  id="txtlv003"  tabindex="7" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/><?php echo $lvtc_lv0064->LV_LinkField('lv003',$lvtc_lv0064->lv003);?>
				  </select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							     <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','hr_lv0020','concat(lv002,@!-@!,lv001)')" onFocus="LoadPopup(this,'txtlv003','hr_lv0020','concat(lv002,@!-@!,lv001)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>							 </td>
							  </tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
				  <td  height="20px"><table width="80%"><tr><td width="50%"><select  name="txtlv004"  id="txtlv004"  tabindex="10" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/><?php echo $lvtc_lv0064->LV_LinkField('lv004',$lvtc_lv0064->lv004);?>
				  </select></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							     <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadPopup(this,'txtlv004','hr_lv0002','lv003')" onFocus="LoadPopup(this,'txtlv004','hr_lv0002','lv003')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>							 </td>
							  </tr>							  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvtc_lv0064->lv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
								  <td  height="20px"><table width="80%"><tr><td width="50%"><select  name="txtlv007"  id="txtlv007"  tabindex="10"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
								  	 <option value=""></option>
								  <?php echo $lvtc_lv0064->LV_LinkField('lv007',$lvtc_lv0064->lv007);?>
								  </select></td><td>
											  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
											     <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','tc_lv0032','concat(lv002,@!-@!,lv001)')" onFocus="LoadPopup(this,'txtlv003','tc_lv0032','concat(lv002,@!-@!,lv001)')" tabindex="200" >
											    <div id="lv_popup3" lang="lv_popup3"> </div>						  
										</li>
									</ul></td></tr></table>							 </td>
							  </tr>	
							  <tr>
							  	<td  height="20"><?php echo $vLangArr[22];?></td>
				  				<td  height="20"><input name="txtlv008" id="txtlv008"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvtc_lv0064->FormatView($lvtc_lv0064->lv008,2);?>"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv008);return false;" /></span></td>
						 	</tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><input name="txtlv009" type="text" id="txtlv009" value="<?php echo $lvtc_lv0064->FormatView($lvtc_lv0064->lv009,2);?>" tabindex="9" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv009);return false;" /></span></td>
						    </tr>
						    <tr>
							  <td  height="20px"><?php echo $vLangArr[24];?></td>
				  <td  height="20px"><table width="80%"><tr><td width="50%"><select  name="txtlv010"  id="txtlv010"  tabindex="10" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/><?php echo $lvtc_lv0064->LV_LinkField('lv010',$lvtc_lv0064->lv010);?>
				  </select></td><td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							     <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadPopup(this,'txtlv010','tc_lv0004','lv002')" onFocus="LoadPopup(this,'txtlv010','tc_lv0004','lv002')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>							 </td>
							  </tr>
							  <tr>
							  	<td  height="20px"><?php echo $vLangArr[25];?></td>
				 				<td  height="20px"><select  name="txtlv011"  id="txtlv011"  tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)">
				 			   <option <?php echo ($lvtc_lv0064->lv011=='0')?'selected="selected"':'';?>  value="0">Trạng thái bình thường</option>
				 			   <option <?php echo ($lvtc_lv0064->lv011==1)?'selected="selected"':'';?>  value="1">Cho phép thêm ca</option>
				 				 </select></td>
							</tr>
							<tr>
							  	<td  height="20px"><?php echo $vLangArr[26];?></td>
				 				<td  height="20px"><select  name="txtlv012"  id="txtlv012"  tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)">
				 			   <option <?php echo ($lvtc_lv0064->lv012=='0')?'selected="selected"':'';?>  value="0">0.Không</option>
				 			   <option <?php echo ($lvtc_lv0064->lv012==1)?'selected="selected"':'';?>  value="1">1.Co</option>
				 				 </select></td>
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