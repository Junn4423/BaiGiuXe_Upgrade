<?php
session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0002.php");
//////////////init object////////////////
$lvhr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0052.txt",$plang);

$curPage=(int)$_GET['curPg'];	
$vFlag=(int)$_GET['txtFlag'];
$vlv001=$_GET['lv001'];
$vlv002=$_GET['lv002'];
$vlv003=$_GET['lv003'];
$vlv004=$_GET['lv004'];
$vlv005=$_GET['lv005'];
$vlv006=$_GET['lv006'];
$vlv007=$_GET['lv007'];
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
		o.txtlv007.value=document.frmfilter.txtlv007.value;		
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
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
								<td width="166"  height="20px"><?php echo $vLangArr[10];?></td>
								<td width="*%"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $vlv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[13];?></td>
							  <td  height="20px"><select  name="txtlv002"  id="txtlv002"  tabindex="6" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/><option value=""></option><?php echo $lvhr_lv0002->LV_LinkField('lv002',$vlv002);?></select><br><table><tr><td></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
						  <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch" id="txtlvsearch" style="width:200px" onKeyUp="LoadPopup(this,'txtlv002','hr_lv0001','lv002')" onFocus="LoadPopup(this,'txtlv002','hr_lv0001','lv002')" tabindex="200" >
						  <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
						
					</ul></td></tr></table>	</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[11];?></td>
							  <td  height="20px"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $vlv003;?>" tabindex="8	" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
<tr>
							  <td  height="20px"><?php echo $vLangArr[14];?></td>
				  <td  height="20px"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $vlv004;?>" tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>							  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[12];?></td>
							  <td  height="20px"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $vlv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							<tr>
							  <td  height="20px"><?php echo 'Code Kế Toán';?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $vlv007;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							<tr>
							  <tr>
							  <td  height="20px"><?php echo 'KPI';?></td>
							   <td  height="20px">
								<table width="80%"><tr><td width="50%">
								<select  name="txtlv099"  id="txtlv099"  tabindex="6" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,7,this)">	<option value=""></option>
									<?php echo $lvhr_lv0002->LV_LinkField('lv099',$lvhr_lv0002->lv099);?>
								</select></td><td>
								  	<ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
									  <input type="text"  autocomplete="off" class="search_img_btn" name="txtlv099_search" id="txtlv099_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv099','hr_lv0099','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv099','hr_lv0099','concat(lv001,@! @!,lv002)')" tabindex="200" >
									  <div id="lv_popup2" lang="lv_popup2"> </div>						  
									</li>
									</ul></td></tr>
								</table>	
								</td>
								</tr>
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
	include("../hr_lv0002/permit.php");
}
?>
</body>
</html>