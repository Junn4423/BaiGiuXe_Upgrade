<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/jo_lv0019.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/jo_lv0019.php");
//////////////init object////////////////
$lvjo_lv0019=new jo_lv0019($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0019');
/////////Get ID///////////////
$lvjo_lv0019->lv001=$_GET['ChildID'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SP0029.txt",$plang);

$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$vStrMessage="";


if($vFlag==1)
{
		$lvjo_lv0019->lv002=$_POST['txtlv002'];
		$lvjo_lv0019->lv003=$_POST['txtlv003'];
		$lvjo_lv0019->lv004=$_POST['txtlv004'];
		$lvjo_lv0019->lv005=$_POST['txtlv005'];
		$lvjo_lv0019->lv006=$_POST['txtlv006'];
		$lvjo_lv0019->lv007=$_POST['txtlv007'];	
		$lvjo_lv0019->lv008=$_POST['txtlv008'];			
		$vresult=$lvjo_lv0019->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();
			$vFlag=0;
		}

}

$lvjo_lv0019->LV_LoadID($lvjo_lv0019->lv001);

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
		o.txtlv002.value="<?php echo $lvjo_lv0019->lv002;?>";
		o.txtlv003.value="<?php echo $lvjo_lv0019->lv003;?>";
		o.txtlv004.value="<?php echo $lvjo_lv0019->lv004;?>";
		o.txtlv005.value="<?php echo $lvjo_lv0019->lv005;?>";
		o.txtlv006.value="<?php echo $lvjo_lv0019->lv006;?>";	
		o.txtlv007.value="<?php echo $lvjo_lv0019->lv007;?>";
		o.txtlv008.value="<?php echo $lvjo_lv0019->lv008;?>";			
		o.txtlv002.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0)?>";
		o.submit();
	}
		function Save()
	{
		var o=document.frmedit;
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[26];?>");
			o.txtlv002.select();
		}
		else
			{
			o.txtFlag.value="1";
			o.submit();
			}
			
	}
</script>
<?php
if($lvjo_lv0019->GetEdit()>0)
{
?>
<body >
<div id="content_child">
    <h2 id="pageName"><?php echo $vLangArr[9];?></h2>
  <div class="story">
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
					<form name="frmedit" id="frmedit" action="#" method="post">
					<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="800" border="0" align="left" id="table1">
							<tr><td colspan="2" align="center">
					<?php		
						echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
						?>
							</td></tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvjo_lv0019->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
						<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvjo_lv0019->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" /><br>
							 </td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px">
								<table style="width:80%">
										<tr>
											<td width="50%">
												<select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
												<option value=""></option>
												<?php echo $lvjo_lv0019->LV_LinkField('lv003',$lvjo_lv0019->lv003);?>
												</select>
											</td>
											<td width="50%">
												<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
													<input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv003','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
													<div id="lv_popup" lang="lv_popup1"> </div>						  
													</li>
												</ul>
											</td>
										</tr>
									</table>
							 </td>
							  </tr>	
							<tr>
								<td height="20" valign="top"><?php echo $vLangArr[18];?></td>
								<td height="20">
									<table style="width:80%">
										<tr>
											<td width="50%">
												<select name="txtlv004" id="txtlv004"   tabindex="7"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
												<option value=""></option>
												<?php echo $lvjo_lv0019->LV_LinkField('lv004',$lvjo_lv0019->lv004);?>
												</select>
											</td>
											<td width="50%">
												<ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
													<input type="text" autocomplete="off" class="search_img_btn" name="txtlv004_search" id="txtlv004_search" onKeyUp="LoadPopup(this,'txtlv004','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv004','hr_lv0014','lv002')" style="width:100%"  tabindex="200" >
													<div id="lv_popup4" lang="lv_popup4"> </div>						  
													</li>
												</ul>
											</td>
										</tr>
									</table>
									
								</td>
					      </tr>
						  <tr>
								<td  height="20" valign="top"><?php echo $vLangArr[19];?></td>
								<td height="20"><input name="txtlv005" id="txtlv005"   tabindex="8"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvjo_lv0019->lv005;?>"/>
							  </td>
					      </tr>
						  <tr>
								<td  height="20" valign="top"><?php echo $vLangArr[20];?></td>
								<td height="20">
								<input name="txtlv006" id="txtlv006"   tabindex="8"  style="width:75%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvjo_lv0019->FormatView($lvjo_lv0019->lv006,2);?>"/>
								<span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv006);return false;" /></span>
							  </td>
					      </tr>
							  <tr>
							  <td  height="20px" valign="top"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><textarea name="txtlv007" cols="50" rows="8" id="txtlv007" style="width:80%" tabindex="11" ><?php echo $lvjo_lv0019->lv007;?></textarea></td>
							  </tr>
								<tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
							  <td  height="20px"><table style="width:80%">
										<tr>
											<td width="50%"><select name="txtlv008" id="txtlv008"   tabindex="10"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
							  <option value=""></option>
							  <?php echo $lvjo_lv0019->LV_LinkField('lv008',$lvjo_lv0019->lv008);?>
							  </select></td>
											<td width="50%">
							  <ul id="pop-nav8" lang="pop-nav8" onMouseOver="ChangeName(this,8)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv008_search" id="txtlv008_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv008','sp_lv0044','lv002')" onFocus="LoadPopup(this,'txtlv008','sp_lv0044','lv002')" tabindex="200" >
							    <div id="lv_popup8" lang="lv_popup8"> </div>						  
						</li>
					</ul></td></tr></table></td>
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
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
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