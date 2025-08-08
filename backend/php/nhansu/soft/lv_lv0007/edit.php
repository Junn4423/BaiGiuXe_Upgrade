<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/lv_lv0007.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/lv_lv0007.php");
//////////////init object////////////////
$lvlv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
/////////Get ID///////////////
$lvlv_lv0007->lv001= $_GET['ID'] ?? '';
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","LV0004.txt",$plang);

$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$vStrMessage="";


if($vFlag==1)
{
		$lvlv_lv0007->lv002=$_POST['txtlv002'];
		$lvlv_lv0007->lv003=$_POST['txtlv003'];
		$lvlv_lv0007->lv004=$_POST['txtlv004'];
		$lvlv_lv0007->lv005=$_POST['txtlv005'];
		$lvlv_lv0007->lv006=$_POST['txtlv006'];
		$lvlv_lv0007->lv094=$_POST['txtlv094'];
		$lvlv_lv0007->lv095=$_POST['txtlv095'];
		$lvlv_lv0007->lv099=$_POST['txtlv099'];	
		$lvlv_lv0007->lv906=$_POST['txtlv906'];
		$lvlv_lv0007->lv905=$_POST['txtlv905'];
		$lvlv_lv0007->lv904=$_POST['txtlv904'];
		$lvlv_lv0007->isDelMoreRight=$_POST['isDelMoreRight'];
		$lvlv_lv0007->isAddMoreRight=$_POST['isAddMoreRight'];
		$vresult=$lvlv_lv0007->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();
			$vFlag=0;
		}

}
$lvlv_lv0007->LV_LoadID($lvlv_lv0007->lv001);

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
		o.txtlv002.value="<?php echo $lvlv_lv0007->lv002;?>";
		o.txtlv003.value="<?php echo $lvlv_lv0007->lv003;?>";
		o.txtlv004.value="<?php echo $lvlv_lv0007->lv004;?>";
		o.txtlv005.value="<?php echo $lvlv_lv0007->lv005;?>";
		o.txtlv006.value="<?php echo $lvlv_lv0007->lv006;?>";	
		o.txtlv007.value="<?php echo $lvlv_lv0007->lv007;?>";
				
		o.txtlv002.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>";
		o.submit();
	}
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
		function Save()
	{
		var o=document.frmedit;
			{
			o.txtFlag.value="1";
			o.txtlv002.value=getChecked(o.chklv002.value,'chklv002');
			o.submit();
			}
			
	}
</script>
<?php
if($lvlv_lv0007->GetEdit()>0)
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvlv_lv0007->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
						<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv004" type="text" id="txtlv004"  value="<?php echo $lvlv_lv0007->lv004;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" /><br>
							 </td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							   <td  height="20px">
							   <div style="max-height:200px;overflow:auto">
												<input type="hidden" name="txtlv002" id="txtlv002"   tabindex="7"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvlv_lv0007->lv002;?>"/>
												<?php echo $lvlv_lv0007->GetBuilCheckList($lvlv_lv0007->lv002,'chklv002',10,'hr_lv0002','lv003');?>
								</div>				
										
							 </td>
							  </tr>	
							<tr>
								<td height="20" valign="top"><?php echo $vLangArr[18];?></td>
								<td height="20">
									<table style="width:80%">
										<tr>
											<td width="30%">
												<select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
												<option value=""></option>
												<?php echo $lvlv_lv0007->LV_LinkField('lv003',$lvlv_lv0007->lv003);?>
												</select>
											</td>
											<td width="70%">
												<table><tr><td>Thêm quyền nhóm này:</td><td><input type="checkbox" name="isAddMoreRight" value="1"/></td><td>Xóa quyền trước:</td><td><input type="checkbox" name="isDelMoreRight" value="1"/></td></tr></table>
											</td>
										</tr>
									</table>
									
								</td>
					      </tr>
						 
						  <tr>
								<td  height="20" valign="top"><?php echo $vLangArr[20];?></td>
								<td height="20">
								
								<table style="width:100%">
										<tr>
											<td width="30%">
												<input name="txtlv006" id="txtlv006"   tabindex="8"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvlv_lv0007->lv006;?>" readonly="true"/>
											</td>
											<td width="70%">
												<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
													<input type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv006','hr_lv0020','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv006','hr_lv0020','concat(lv002,@! @!,lv001)')" tabindex="200" >
													<div id="lv_popup" lang="lv_popup1"> </div>						  
													</li>
												</ul>
											</td>
										</tr>
									</table>
							  </td>
					      </tr>
						    <tr>
							  <td  height="20px"><?php echo 'UserControl';?></td>
							  <td  height="20px">
							  <select name="txtlv094" id="txtlv094"   tabindex="10"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
							  <option value=""></option>
							  <?php echo $lvlv_lv0007->LV_LinkField('lv094',$lvlv_lv0007->lv094);?>
							  </select></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo 'IPLogin';?></td>
							  <td  height="20px"><input name="txtlv095" type="text" id="txtlv095"  value="<?php echo $lvlv_lv0007->lv095;?>" tabindex="11" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" /><br>
							 </td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo 'Themes';?></td>
							  <td  height="20px">
							  <select name="txtlv099" id="txtlv099"   tabindex="10"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
							  <option value=""></option>
							  <?php echo $lvlv_lv0007->LV_LinkField('lv099',$lvlv_lv0007->lv099);?>
							  </select></td>
							  </tr>		
							  <tr>
							  	<td  height="20px"><?php echo 'Khu vực';?></td>								  
							 	 <td  height="20px"><input name="txtlv906" type="text" id="txtlv906"  value="<?php echo $lvlv_lv0007->lv906;?>" tabindex="11" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
							  </tr>		
							  <tr>
								<td  height="20" valign="top"><?php echo 'Thay thế NV nghỉ việc:';?></td>
								<td height="20">
								
								<table style="width:80%">
										<tr>
											
											<td width="100%">
												<ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
												<input name="txtlv905" id="txtlv905"   tabindex="8"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvlv_lv0007->lv905;?>" onKeyUp="LoadSelfNext<?php echo $vParentSearch;?>(this,'txtlv905','hr_lv0020','lv001','concat(lv006,@! @!,lv010,@! @!,lv002,@! - @!,lv001)')" onFocus="LoadSelfNext<?php echo $vParentSearch;?>(this,'txtlv905','hr_lv0020','lv001','concat(lv006,@! @!,lv010,@! @!,lv002,@! - @!,lv001)')" tabindex="200" onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};" >
													<div id="lv_popup5" lang="lv_popup5"> </div>						  
													</li>
												</ul>
											</td>
										</tr>
									</table>
							  </td>
					      </tr>	
						  <tr>
								<td  height="20" valign="top"><?php echo 'Trợ lý của :';?></td>
								<td height="20">
								<table style="width:80%">
										<tr>
											<td width="50%">
												<input name="txtlv904" id="txtlv904"   tabindex="8"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvlv_lv0007->lv904;?>"/>
											</td>
											<td width="50%">
												<ul id="pop-nav15" lang="pop-nav15" onMouseOver="ChangeName(this,15)" onkeyup="ChangeName(this,15)"> <li class="menupopT">
													<input type="text" autocomplete="off" class="search_img_btn" name="txtlv904_search" id="txtlv904_search" style="width:100%" onKeyUp="LoadSelfNext<?php echo $vParentSearch;?>(this,'txtlv904','hr_lv0020','lv001','concat(lv006,@! @!,lv010,@! @!,lv002,@! - @!,lv001)')" onFocus="LoadSelfNext<?php echo $vParentSearch;?>(this,'txtlv904','hr_lv0020','lv001','concat(lv006,@! @!,lv010,@! @!,lv002,@! - @!,lv001)')" tabindex="200" >
													<div id="lv_popup15" lang="lv_popup15"> </div>						  
													</li>
												</ul>
											</td>
										</tr>
									</table>
							  </td>
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
<script language="javascript"> var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
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