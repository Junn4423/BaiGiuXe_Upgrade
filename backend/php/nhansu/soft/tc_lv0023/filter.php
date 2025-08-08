<?php
session_start();
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0023.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
//////////////init object////////////////
$lvtc_lv0023=new tc_lv0023($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0023');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0037.txt",$plang);

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
$vlv012=$_GET['lv012'];
$vlv013=$_GET['lv013'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
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
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv001.focus();
	}
	function Cancel(){	var o=window.parent.document.getElementById('frmchoose');		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";		o.submit();	}
	function Save()
	{

		var o=window.parent.document.getElementById('frmchoose');
		o.txtFlag.value="2";
		o.txtlv001.value=document.frmfilter.txtlv001.value;
		o.txtlv002.value=document.frmfilter.txtlv002.value;	
		o.txtlv003.value=document.frmfilter.txtlv003.value;		
		o.txtlv004.value=document.frmfilter.txtlv004.value;		
		o.txtlv005.value=document.frmfilter.txtlv005.value;		
		o.txtlv006.value=document.frmfilter.txtlv006.value;		
		o.txtlv007.value=document.frmfilter.txtlv007.value;	
		o.txtlv012.value=document.frmfilter.txtlv012.value;		
		o.txtlv013.value=document.frmfilter.txtlv013.value;		
		o.txtlv010.value=document.frmfilter.txtlv010.value;				
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0)?>";
		o.submit();
	}
	///Get Radio
	function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
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
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmfilter" method="post">
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $vlv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $vlv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
				 			 <td  height="20px">
							   <table width="80%"><tr><td width="50%">
								   	<select name="txtlv003" id="txtlv003"  tabindex="7" maxlength="50" style="width:100%" onKeyPress="return CheckKeys(event,7,this)">
								  	 <?php echo $lvtc_lv0023->LV_LinkField('lv003',$vlv003);?>
	                              	</select>
							   </td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','tc_lv0013','lv002')" onFocus="LoadPopup(this,'txtlv003','tc_lv0013','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
						  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px">
							   <table width="80%"><tr><td width="50%">
							   		<select name="txtlv004" id="txtlv004"  tabindex="8" maxlength="50" style="width:100%" onKeyPress="return CheckKeys(event,7,this)">
							 		 	<option value=""></option>
							 		 	<?php echo $lvtc_lv0023->LV_LinkField('lv004',$vlv004);?>
                            	  	</select>
							   </td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv004_search" id="txtlv004_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv004','tc_lv0018','lv002')" onFocus="LoadPopup(this,'txtlv004','tc_lv0018','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px">
							  	<table width="80%"><tr><td width="50%">
							   	<input name="txtlv005" type="text" id="txtlv005" value="<?php echo $vlv005;?>" tabindex="10" maxlength="50" style="width:69%" onKeyPress="return CheckKey(event,7)"><select name="txtlv006" id="txtlv006"  tabindex="11" maxlength="50" style="width:30%" onKeyPress="return CheckKeys(event,7,this)">
							   	<option value=""></option>
							   <?php echo $lvtc_lv0023->LV_LinkField('lv006',$vlv006);?>
                              </select>
							   </td><td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv006','hr_lv0018','lv002')" onFocus="LoadPopup(this,'txtlv006','hr_lv0018','lv002')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
							  </tr>	
							   <tr>
							  <td  height="20px"><?php echo $vLangArr[29];?></td>
							  <td  height="20px"><input name="txtlv013" type="text" id="txtlv013" value="<?php echo $vlv013;?>" tabindex="12" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>		
							   <tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $vlv007;?>" tabindex="12" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[28];?></td>
							  <td  height="20px"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo $vlv012;?>" tabindex="12" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>		
								<tr>
							  <td  height="20px"><?php echo "Phòng ban";?></td>
							  <td  height="20px">
							   <table width="80%"><tr><td width="50%">
							   		<select name="txtlv010" id="txtlv010"  tabindex="15" maxlength="50" style="width:100%" onKeyPress="return CheckKey(event,7)">
							 			<option value=""></option>
							   			<?php echo $lvtc_lv0023->LV_LinkField('lv010',$vlv010);?>
                              		</select>
							   		</td><td>
								 	 <ul id="pop-nav3" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
								    <input type="text" autocomplete="off" class="search_img_btn" name="10" id="txtlv010_search" style="width:200px" onKeyUp="LoadPopup(this,'txtlv010','hr_lv0003','lv003')" onFocus="LoadPopup(this,'txtlv010','hr_lv0003','lv003')" tabindex="200" >
							    <div id="lv_popup5" lang="lv_popup5"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
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

				
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmfilter;
		o.txtlv001.select();
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