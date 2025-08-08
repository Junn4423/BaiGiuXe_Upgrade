<?php
session_start();
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0038.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
//////////////init object////////////////
$lvhr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0124.txt",$plang);

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
$vlv014=$_GET['lv014'];
$vlv017=$_GET['lv017'];
$vDepID=$_GET['DepID'];
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
</head>
<script language="javascript">
<!--
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
		o.txtlv008.value="";
		o.txtlv009.value="";
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
		o.txtlv008.value=document.frmfilter.txtlv008.value;		
		o.txtlv009.value=document.frmfilter.txtlv009.value;
		o.txtlv010.value=document.frmfilter.txtlv010.value;		
		o.txtlv012.value=document.frmfilter.txtlv012.value;		
		o.txtlv013.value=document.frmfilter.txtlv013.value;		
		o.txtlv014.value=document.frmfilter.txtlv014.value;	
		o.txtlv017.value=document.frmfilter.txtlv017.value;
		o.txtDepID.value=getChecked(document.frmfilter.chkDept.value,'chkDept');
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $vlv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)" />			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $vlv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><select  name="txtlv003"  id="txtlv003"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <option value=""></option>
							  <?php echo $lvhr_lv0038->LV_LinkField('lv003',$vlv003);?></select></td>
							</tr>
							<tr>
								<td><?php echo 'Phòng ban';?></td>
								<td><input type="hidden" name="txtDepID"  id="txtDepID" value="<?php echo $vlv029;?>" tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<div style="width:250px;height:150px;position:relative;overflow: auto;top:0px;">
									<?php echo $lvhr_lv0038->GetBuilCheckListDept($vDepID,'chkDept',10,'hr_lv0002','lv003',$vlv029ex);?>
								</div>
								</td>
							</tr>						
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
								  <td  height="20px"><input name="txtlv004" type="text" id="txtlv004" value="<?php echo $vlv004;?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmfilter.txtlv004);return false;" /></span></td>
						  </tr>
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $vlv005;?>" tabindex="11" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmfilter.txtlv005);return false;" /></span></td>
							  </tr>
								<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $vlv006;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $vlv007;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>		
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
				  <td  height="20px"><select  name="txtlv008"  id="txtlv008"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
				  <option value=""></option>
				  <?php echo $lvhr_lv0038->LV_LinkField('lv008',$vlv008);?>
				  </select>							 </td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[23];?></td>
				  <td  height="20px"><input  name="txtlv009"  id="txtlv009"  tabindex="14" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							 </td>
							  </tr>
							   <tr>
							 	 <td  height="20px"><?php echo $vLangArr[27];?></td>
				  				 <td  height="20px"><table style="width:80%"><tr><td style="width:50%"><select  name="txtlv010"  id="txtlv010"  tabindex="12" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/>
									<option value=""></option>
									<?php echo $lvhr_lv0038->LV_LinkField('lv010',$lvhr_lv0038->lv010);?>
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
							  <td  height="20px"><?php echo $vLangArr[29];?></td>
				  				<td  height="20px"><select  name="txtlv012"  id="txtlv012"  tabindex="14" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" />
									<option value=""></option><?php echo $lvhr_lv0038->LV_LinkField('lv012',$lvhr_lv0038->lv012);?>
				  									</select>							 
				  				</td>
							  </tr>	
							   <tr>
							  <td  height="20px"><?php echo $vLangArr[30];?></td>
				  				<td  height="20px"><select  name="txtlv013"  id="txtlv013"  tabindex="15" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0038->LV_LinkField('lv013',$lvhr_lv0038->lv013);?>
				  									</select>							 
				  				</td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[31];?></td>
							  <td  height="20px"><input name="txtlv014" type="text" id="txtlv014" value="<?php echo $vlv014;?>" tabindex="16" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[34];?></td>
							  <td  height="20px"><input name="txtlv017" type="text" id="txtlv017" value="<?php echo $vlv017;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">	</td>
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
<script language="javascript" src="../../javascripts/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmfilter;
		o.txtlv001.select();
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