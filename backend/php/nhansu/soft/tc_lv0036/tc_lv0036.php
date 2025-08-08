<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("../clsall/lv_controler.php");
include($vDir."../clsall/tc_lv0036.php");
include($vDir."../clsall/tc_lv0030.php");
include($vDir."../clsall/tc_lv0008.php");
$motc_lv0030=new tc_lv0030($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0030');
$motc_lv0036=new tc_lv0036($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0036');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
//Get Basic information
$pGetLengthFile=(int)$_GET['LengthFile'];
$vNow=GetServerDate();
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TC0056.txt",$plang);
$motc_lv0030->ArrFunc[9]=$vLangArr[12];	
$loadenter=$vFlag;
if($vFlag==1)
{
 	$motc_lv0036->InsertAutoYear($_POST['txtlv005']);
}
else if($vFlag==2)
{
	$lineprocess=$_POST['txtlv002'];
	$motc_lv0036->lv005=$_POST['txtlv0051'];
	$motc_lv0036->lv006=$_POST['txtlv006'];
	$motc_lv0036->lv007=$_POST['txtlv007'];
	$motc_lv0036->lv008=$_POST['txtlv008'];
	$motc_lv0036->InsertDepartmenAuto(str_replace(",","','",$lineprocess));
}
//////////////////////////////////////////
//////////////////Get data time//////////////////////
?>
<?php

if($motc_lv0036->GetAdd()>0)
{
?>
<script language="javascript">
function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				if(str=='') 
					str=div.value;
				else
					 str=str+','+div.value;
				}
			
			}
			return str;
		}
function SaveLoadFile()
{
	var o=document.frmgeneral;
	if(o.txtlv005.value=="")
	{
		o.txtlv005.focus();
		alert('<?php echo $vLangArr[11];?>');
	}
	else
	{
		o.txtlv002.value=getChecked(o.chklv002.value,'chklv002');
		o.submit();
	}
}
</script>
<!------------------------------------------------------------------------>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="13" height="13">
				<img name="table_r1_c1" src="<?php echo $vDir;?>../../../images/pictures/table_r1_c1.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="*" background="<?php echo $vDir;?>../../../images/pictures/table_r1_c2.gif">
				<img name="table_r1_c2" src="<?php echo $vDir;?>../../../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td width="13">
				<img name="table_r1_c3" src="<?php echo $vDir;?>../../../images/pictures/table_r1_c3.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="11">
				<img src="<?php echo $vDir;?>../../../images/pictures/spacer.gif" 
					width="1" height="12" border="0" alt=""></td>
		</tr>
		<tr>
			<td background="<?php echo $vDir;?>../../../images/pictures/table_r2_c1.gif">
				<img name="table_r2_c1" src="<?php echo $vDir;?>../../../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td>
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				<form action="#" method="post" enctype="multipart/form-data" name="frmgeneral" id="frmgeneral" onsubmit="return false;">
					<input type="hidden" name="txtFlag" id="txtFlag" value="1" />
			<table width="440" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td height="20px" colspan="3" align="right"><?php echo $motc_lv0030->LV_ViewHelp($vFieldList,'document.frmgeneral',$vOrderList);?></td>
			  </tr>
				<tr>
							  <td height="20px" colspan="3" align="center"><h2><?php echo $vLangArr[0];?></h2></td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<p>
							    <label>
							      <input type="radio" onclick="changestate(1)"  <?php echo ($loadenter!=2)?'checked="checked"':'';?>  id="load-enter_0" value="0" name="load-enter">
							      <?php echo $vLangArr[13];?>
							    </label>
							    <label>
							      <input type="radio" onclick="changestate(2)" <?php echo ($loadenter==2)?'checked="checked"':'';?> id="load-enter_1" value="1" name="load-enter">
							      <?php echo $vLangArr[14];?>
							    </label>
							    <br>
						      </p>
					</td>
				</tr>
				<tr>
					<td colspan="3">
					<!-- ---------- -->				
							<div id="fileload" style="display:none">
									<table border="0">
									  <tr>
									     <td width="308"  valign="top"><?php echo $vLangArr[1];?> </td>
									  	<td width="17" height="20px" align="center" valign="top">:</td>
										<td width="266" height="20px" align="left"><input type="text" name="txtlv0051" id="txtlv0051" value="<?php echo ($_POST['txtlv0051']=="" || $_POST['txtlv0051']==NULL)?getyear(GetServerDate()):$_POST['txtlv0051'];?>"></td>
							      </tr>
									  <tr>
									    <td height="24" valign="top"><?php echo $vLangArr[2];?></td><td>:</td><td><input name="txtlv002" type="hidden" id="txtlv002" value="<?php echo $_POST['txtlv002'];?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $motc_lv0030->GetBuilCheckList($_POST['txtlv002'],'chklv002',10,'hr_lv0002','lv003');?></td>
							      </tr>
							        <tr>
									     <td width="308"  valign="top"><?php echo $vLangArr[4];?> </td>
									  	<td width="17" height="20px" align="center">:</td>
										<td width="266" height="20px" align="left"><input type="text" name="txtlv006" id="txtlv006" value="<?php echo ($_POST['txtlv006']=="" || $_POST['txtlv006']==NULL)?'08:00:00':$_POST['txtlv006'];?>"></td>
							      </tr>
					                <tr>
												  <td  height="20px" valign="top"><?php echo $vLangArr[3];?></td>
					                              <td width="17" height="20px" align="center" valign="top">:</td>
												  <td  height="20px"><select name="txtlv007" id="txtlv007"  tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
												   <?php echo $motc_lv0008->LV_LinkField('lv007',$motc_lv0008->lv007);?>
					                              </select>
												    <br>
												  <table><tr><td></td><td>
												  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
												    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch3" id="txtlvsearch3" style="width:200px" onKeyUp="LoadPopup(this,'txtlv007','tc_lv0004','lv002')" onFocus="LoadPopup(this,'txtlv007','tc_lv0004','lv002')" tabindex="200" >
												    <div id="lv_popup" lang="lv_popup1"> </div>						  
											</li>
										</ul></td></tr></table>	</td>
												  </tr>		
					                              <tr>
												  <td  height="20px" valign="top"><?php echo $vLangArr[5];?></td>
					                              <td width="17" height="20px" align="center">:</td>
												  <td  height="20px"><select name="txtlv008" id="txtlv008"  tabindex="13" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
												   <?php echo $motc_lv0008->LV_LinkField('lv008',$motc_lv0008->lv008);?>
					                              </select>
												    <br>
												  <table><tr><td></td><td>
												  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
												    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch4" id="txtlvsearch4" style="width:200px" onKeyUp="LoadPopup(this,'txtlv008','tc_lv0032','lv002')" onFocus="LoadPopup(this,'txtlv008','tc_lv0032','lv002')" tabindex="200" >
												    <div id="lv_popup2" lang="lv_popup2"> </div>						  
											</li>
										</ul></td></tr></table>	</td>
												  </tr>	
					               <tr>
									    <td height="24" colspan="3" align="center">&nbsp;</td>
							      </tr>
									  <tr>
									    <td height="24" colspan="3" align="center"><input type="submit" name="Submit" value="<?php echo $vLangArr[6];?>" onclick="SaveLoadFile()"></td>
							      </tr>
							      </table>
							</div>
<!-- ------ -->		      
							<div id="enterline" style="display:block">
								<table border="0">
									  <tr>
									     <td width="308"  valign="top"><?php echo $vLangArr[1];?> </td>
									  	<td width="17" height="20px" align="center" valign="top">:</td>
										<td width="266" height="20px" align="left"><input type="text" name="txtlv005" id="txtlv005" value="<?php echo ($_POST['txtlv005']=="" || $_POST['txtlv005']==NULL)?getyear(GetServerDate()):$_POST['txtlv005'];?>"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
																				border="0" style="cursor:pointer" width="16" height="16" align="top" 
																				onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmgeneral.txtlv005);return false;" /></td>
								      </tr>
								       </tr>
										  <tr>
										    <td height="24" colspan="3" align="center"><input type="submit" name="Submit" value="<?php echo $vLangArr[6];?>" onclick="SaveLoadFile()"></td>
								      </tr>
							      </table>
							</div>
						</td>
					</tr>
                </table>					
		      </form>
			</td>
			<td background="<?php echo $vDir;?>../../../images/pictures/table_r2_c3.gif">
				<img name="table_r2_c3" src="<?php echo $vDir;?>../../../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td><img src="<?php echo $vDir;?>../../../images/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
		</tr>
		<tr>
			<td>
				<img name="table_r3_c1" src="<?php echo $vDir;?>../../../images/pictures/table_r3_c1.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td background="<?php echo $vDir;?>../../../images/pictures/table_r3_c2.gif">
				<img name="table_r3_c2" src="<?php echo $vDir;?>../../../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td>
				<img name="table_r3_c3" src="<?php echo $vDir;?>../../../images/pictures/table_r3_c3.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td><img src="<?php echo $vDir;?>../../../images/pictures/spacer.gif" width="1" height="16" border="0" alt=""></td>
		</tr>
	</table>
	<script language="javascript">
	function changestate(value)
	{
		var o1=document.getElementById('fileload');
		var o2=document.getElementById('enterline');
		var o3=document.getElementById('txtFlag');
		if(value==2)
		{
			o1.style.display="block";
			o2.style.display="none";
			o3.value="2";
			
		}
		else
		{
			o1.style.display="none";
			o2.style.display="block";
			o3.value="1";
		}
	}
	changestate(<?php echo (int)$loadenter;?>)
	var o=document.frmadd;
		o.txtlv001.focus();
</script>
    <iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $plang;?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php
} else {
	include("permit.php");
}
?>