<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/hr_lv0033.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0033.php");
//////////////init object////////////////
$lvhr_lv0033=new hr_lv0033($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0052');
/////////Get ID///////////////
$lvhr_lv0033->lv001=$_GET['ChildID'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0120.txt",$plang);

$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$vStrMessage="";


if($vFlag==1)
{
		$lvhr_lv0033->lv002=$_POST['txtlv002'];
		$lvhr_lv0033->lv003=$_POST['txtlv003'];
		$lvhr_lv0033->lv004=$_POST['txtlv004'];
		$lvhr_lv0033->lv005=$_POST['txtlv005'];
		$lvhr_lv0033->lv006=$_POST['txtlv006'];	
		$lvhr_lv0033->lv007=$_POST['txtlv007'];	
		$vresult=$lvhr_lv0033->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();
			$vFlag=0;
		}

}
$lvhr_lv0033->LV_LoadID($lvhr_lv0033->lv001);
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
		o.txtlv002.value="<?php echo $lvhr_lv0033->lv002;?>";
		o.txtlv003.value="<?php echo $lvhr_lv0033->lv003;?>";
		o.txtlv004.value="<?php echo $lvhr_lv0033->lv004;?>";
		o.txtlv005.value="<?php echo $lvhr_lv0033->lv005;?>";
		o.txtlv006.value="<?php echo $lvhr_lv0033->lv006;?>";
		o.txtlv007.value="<?php echo $lvhr_lv0033->lv007;?>";
		o.txtlv002.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,10,0)?>";
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
		else if(o.txtlv003.value==""){
			alert("<?php echo $vLangArr[22];?>");
			o.txtlv004.focus();
			}
		else if(o.txtlv004.value==""){
			alert("<?php echo $vLangArr[23];?>");
			o.txtlv007.select();
			}	
		else if(o.txtlv005.value==""){
			alert("<?php echo $vLangArr[23];?>");
			o.txtlv007.select();
			}	
		else
			{
			o.txtFlag.value="1";
			o.submit();
			}
			
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvhr_lv0033->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0033->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
								  <td  height="20px">
								  <table width="80%"><tr><td width="50%"><select  name="txtlv003"  id="txtlv003"  tabindex="7" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/><?php echo $lvhr_lv0033->LV_LinkField('lv003',$lvhr_lv0033->lv003);?>
				  </select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
						  <input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','hr_lv0008','lv002')" onFocus="LoadPopup(this,'txtlv003','hr_lv0008','lv002')" tabindex="200" >
						  <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
						
					</ul></td></tr></table>						 </td>
							  </tr>											  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv004);return false;" name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0033->FormatView($lvhr_lv0033->lv004,2);?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv004);return false;" /></span></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv005);return false;" name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvhr_lv0033->FormatView($lvhr_lv0033->lv005,2);?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv005);return false;" /></span></td>
							  </tr>
								<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvhr_lv0033->lv006;?>" tabindex="11" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>		
                               <tr>
							  <td  height="20px"><?php echo $vLangArr[24];?></td>
				  			  <td  height="20px"><table width="80%"><tr><td width="50%"><select  name="txtlv007"  id="txtlv007"  tabindex="12" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/><option value=""></option><?php echo $lvhr_lv0033->LV_LinkField('lv007',$lvhr_lv0033->lv007);?>
				  </select></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
						  <input type="text" autocomplete="off" class="search_img_btn" name="txtlv007_search" id="txtlv007_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv007','hr_lv0009','lv002')" onFocus="LoadPopup(this,'txtlv007','hr_lv0009','lv002')" tabindex="200" >
						  <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
						
					</ul></td></tr></table>						 </td>
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
		o.txtlv003.select();
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
</body>
</html>