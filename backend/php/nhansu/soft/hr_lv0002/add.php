<?php
session_start();
//require_once("../../clsall/hr_lv0002.php");
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

$curPage = (int)($_POST['curPg'] ?? 1);
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0002->lv001=$_POST['txtlv001'];
$lvhr_lv0002->lv002=$_POST['txtlv002'];
$lvhr_lv0002->lv003=$_POST['txtlv003'];
$lvhr_lv0002->lv004=$_POST['txtlv004'];
$lvhr_lv0002->lv005=$_POST['txtlv005'];
$lvhr_lv0002->lv006=$_POST['txtlv006'];
$lvhr_lv0002->lv007=$_POST['txtlv007'];
$lvhr_lv0002->lv008=$_POST['txtlv008'];
$lvhr_lv0002->lv009=$_POST['txtlv009'];
$lvhr_lv0002->lv010=$_POST['txtlv010'];
$lvhr_lv0002->lv011=$_POST['txtlv011'];
$lvhr_lv0002->lv099=$_POST['txtlv099'];
$lvhr_lv0002->lv100=$_POST['txtlv100'];
$lvhr_lv0002->lv103=$_POST['txtlv103'];
$lvhr_lv0002->lv198=$_POST['txtlv198'];
$lvhr_lv0002->lv199=$_POST['txtlv199'];
$lvhr_lv0002->lv200=$_POST['txtlv200'];
$lvhr_lv0002->lv300=$_POST['txtlv300'];
if($vFlag==1)
{
		
		$vresult=$lvhr_lv0002->LV_Insert();
		if($vresult==true) {
			$vStrMessage=$vLangArr[16];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[17].sof_error();		
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
function isphone(s){
	if(s!=""){
		var str="0123456789.()"
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
			alert("<?php echo $vLangArr[14];?>");		
			o.txtlv001.focus();
		}
		else if(o.txtlv003.value=="")
		{
			alert("<?php echo $vLangArr[20];?>");		
			o.txtlv003.focus();
		}
		else
			{
				o.txtlv005.value=getChecked(o.chklv005.value,'chklv005');
				o.txtFlag.value="1";
				o.submit();

			}
		
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
-->
</script>
<?php
if($lvhr_lv0002->GetAdd()>0)
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
								<td width="166"  height="20px"><?php echo $vLangArr[10];?></td>
								<td width="*%"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $vlv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[13];?></td>
							  <td  height="20px">
								<table width="80%"><tr><td width="50%"><select  name="txtlv002"  id="txtlv002"  tabindex="6" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/><?php echo $lvhr_lv0002->LV_LinkField('lv002',$lvhr_lv0002->lv002);?></select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
						  <input type="text"  autocomplete="off" class="search_img_btn" name="txtlv002_search" id="txtlv002_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv002','hr_lv0001','lv002')" onFocus="LoadPopup(this,'txtlv002','hr_lv0001','lv002')" tabindex="200" >
						  <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
						
					</ul></td></tr></table>	</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[11];?></td>
							  <td  height="20px"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $lvhr_lv0002->lv003;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[14];?></td>
				  <td  height="20px"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0002->lv004;?>" tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>
								<tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
				  <td  height="20px"><select  name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvhr_lv0002->lv006;?>" tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)">
								<option value="0"  <?php echo ($lvhr_lv0002->lv006=="0")?'selected="selected"':''?>>0.Theo năm</option>
								<option value="1" <?php echo ($lvhr_lv0002->lv006=="1")?'selected="selected"':''?>>1.Theo tháng</option>
								</select>
				  </td>
							  </tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[12];?></td>
							  <td  height="20px"><input name="txtlv005" type="hidden" id="txtlv005" value="<?php echo $lvhr_lv0002->lv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							  	<?php echo $lvhr_lv0002->GetBuilCheckShift($lvhr_lv0002->lv005,'chklv005',10,'tc_lv0004','lv002');?>
							  </td>
							  </tr>
							   <tr>
								<td  height="20px"><?php echo $vLangArr[22];?></td>
								<td  height="20px"><input  name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvhr_lv0002->lv007;?>" tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo 'Chọn hình thức vượt công chuẩn';?></td>
							  <td  height="20px"><select  name="txtlv008"  id="txtlv008"  tabindex="9" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/><?php echo $lvhr_lv0002->LV_LinkField('lv008',$lvhr_lv0002->lv008);?></select>
							  </td>
							  </tr>
							  <tr>
							  	<td  height="20px"><?php echo 'Hình thức tính công';?></td>
				  				<td  height="20px">
					  				<select  name="txtlv009" type="text" id="txtlv009" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)">
										<option value="0"  <?php echo ($lvhr_lv0002->lv009=="0")?'selected="selected"':''?>>0.Tính công thực</option>
										<option value="1" <?php echo ($lvhr_lv0002->lv009=="1")?'selected="selected"':''?>>1.Tính hơn nữa công được 1 công</option>
										<option value="2" <?php echo ($lvhr_lv0002->lv009=="2")?'selected="selected"':''?>>2.Tính luôn đủ công</option>
									</select>
				  				</td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo 'KPI';?></td>
							   <td  height="20px">
								<table width="80%"><tr><td width="50%"><select  name="txtlv099"  id="txtlv099"  tabindex="11" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/><?php echo $lvhr_lv0002->LV_LinkField('lv099',$lvhr_lv0002->lv099);?></select></td><td>
								  	<ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
									  <input type="text"  autocomplete="off" class="search_img_btn" name="txtlv099_search" id="txtlv099_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv099','ki_lv0003','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv099','ki_lv0003','concat(lv001,@! @!,lv002)')" tabindex="200" >
									  <div id="lv_popup2" lang="lv_popup2"> </div>						  
									</li>
									
									</ul></td></tr>
								</table>	
								</td>
								</tr>
								<tr>
							 	 <td  height="20px"><?php echo 'Tính tăng ca tự động';?></td>
								  <td  height="20px"><select  name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvhr_lv0002->lv010;?>" tabindex="12" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)">
												<option value="0"  <?php echo ($lvhr_lv0002->lv010=="0" || $lvhr_lv0002->lv010=="")?'selected="selected"':''?>>0.No</option>
												<option value="1" <?php echo ($lvhr_lv0002->lv010=="1" )?'selected="selected"':''?>>1.Yes</option>
												</select>
								  </td>
							  </tr>
							   <tr>
								<td  height="20px"><?php echo 'Nhập số giờ bắt đầu tính tăng ca';?></td>
								<td  height="20px"><input  name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvhr_lv0002->lv013;?>" tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo 'Người quản lý trực tiếp';?></td>
							   <td  height="20px">
								<table width="80%"><tr><td width="50%"><input class="norequired" name="txtlv100" type="text" id="txtlv100" value="<?php echo $lvhr_lv0002->lv100;?>" tabindex="13" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/></td><td>
								  	<ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
									  <input type="text"  autocomplete="off" class="search_img_btn" name="txtlv100_search" id="txtlv100_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv100','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv100','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
									  <div id="lv_popup3" lang="lv_popup3"> </div>						  
									</li>
									
									</ul></td></tr>
								</table>	
								</td>
								</tr>
								<tr>
									<td  height="20px"><?php echo 'Người duyệt tạm ứng/thanh toán';?></td>
									<td  height="20px">
										<table width="80%"><tr><td width="50%"><input class="norequired" name="txtlv200" type="text" id="txtlv200" value="<?php echo $lvhr_lv0002->lv200;?>" tabindex="13" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/></td><td>
											<ul id="pop-nav13" lang="pop-nav13" onMouseOver="ChangeName(this,13)" onkeyup="ChangeName(this,13)"> <li class="menupopT">
											<input type="text"  autocomplete="off" class="search_img_btn" name="txtlv200_search" id="txtlv200_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv200','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv200','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
											<div id="lv_popup13" lang="lv_popup13"> </div>						  
											</li></ul></td></tr>
										</table>	
									</td>
								</tr>
								<tr>
									<td  height="20px"><?php echo 'Người duyệt ĐNVT';?></td>
									<td  height="20px">
										<table width="80%"><tr><td width="50%"><input class="norequired" name="txtlv198" type="text" id="txtlv198" value="<?php echo $lvhr_lv0002->lv198;?>" tabindex="13" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/></td><td>
											<ul id="pop-nav23" lang="pop-nav23" onMouseOver="ChangeName(this,23)" onkeyup="ChangeName(this,13)"> <li class="menupopT">
											<input type="text"  autocomplete="off" class="search_img_btn" name="txtlv200_search" id="txtlv200_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv198','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv198','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
											<div id="lv_popup23" lang="lv_popup23"> </div>						  
											</li></ul></td></tr>
										</table>	
									</td>
								</tr>
								<tr>
									<td  height="20px"><?php echo 'Người duyệt Bảo Hành';?></td>
									<td  height="20px">
										<table width="80%"><tr><td width="50%"><input class="norequired" name="txtlv199" type="text" id="txtlv199" value="<?php echo $lvhr_lv0002->lv199;?>" tabindex="13" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/></td><td>
											<ul id="pop-nav33" lang="pop-nav33" onMouseOver="ChangeName(this,33)" onkeyup="ChangeName(this,13)"> <li class="menupopT">
											<input type="text"  autocomplete="off" class="search_img_btn" name="txtlv200_search" id="txtlv200_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv199','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv199','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
											<div id="lv_popup33" lang="lv_popup33"> </div>						  
											</li></ul></td></tr>
										</table>	
									</td>
								</tr>
								<tr>
									<td  height="20px"><?php echo 'Quản lý BC công việc';?></td>
									<td  height="20px">
										<table width="80%"><tr><td width="50%"><input class="norequired" name="txtlv300" type="text" id="txtlv300" value="<?php echo $lvhr_lv0002->lv300;?>" tabindex="13" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/></td><td>
											<ul id="pop-nav17" lang="pop-nav17" onMouseOver="ChangeName(this,17)" onkeyup="ChangeName(this,13)"> <li class="menupopT">
											<input type="text"  autocomplete="off" class="search_img_btn" name="txtlv300_search" id="txtlv300_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv300','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv199','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
											<div id="lv_popup17" lang="lv_popup17"> </div>						  
											</li></ul></td></tr>
										</table>	
									</td>
								</tr>
								<tr>
								<td  height="20px"><?php echo 'Thứ tự';?></td>
								<td  height="20px"><input  name="txtlv103" type="text" id="txtlv103" value="<?php echo $lvhr_lv0002->lv103;?>" tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>
							 <tr>
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
					  <input type="hidden" name="txtFlag" value="0">
					</form>	

				
  </div>
</div>
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
	include("permit.php");
}
?>
</body>
</html>