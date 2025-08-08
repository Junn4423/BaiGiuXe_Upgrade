<?php
//session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/jo_lv0016.php");	
////////init object////////////////////
	$mojo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0016');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","JO0012.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$flagCtrl = (int)($_POST['txtFlag'] ?? 0);
$vNow=GetServerDate();
//Láº¥y mÃ£ phiáº¿u nháº­p kho
$mojo_lv0016->lv001=$_SESSION['ERPSOFV2RUserID'];
$isExists =$mojo_lv0016->LV_Exist($mojo_lv0016->lv001);
$mojo_lv0016->lv002=$_POST['txtlv802'] ?? '';
$mojo_lv0016->lv002=GetServerDate()." ".GetServerTime();
if($flagCtrl == 1){
$mojo_lv0016->lv003=$_POST['txtlv803'];
$mojo_lv0016->lv004=$_POST['txtlv804'];
$mojo_lv0016->lv006=$_POST['txtlv806'];
$mojo_lv0016->lv005=$_POST['txtlv805'];
$mojo_lv0016->lv006=$_POST['txtlv806'];	
$mojo_lv0016->lv007=$_POST['txtlv807'];	
$mojo_lv0016->lv008=$_POST['txtlv808'];
$mojo_lv0016->lv009=$_POST['txtlv809'];
$mojo_lv0016->lv010=$_POST['txtlv810'];
$mojo_lv0016->lv011=$_POST['txtlv811'];
$mojo_lv0016->lv012=$_POST['txtlv812'];	
$mojo_lv0016->lv013=$_POST['txtlv813'];
$mojo_lv0016->lv014=$_POST['txtlv814'];
$mojo_lv0016->lv015=$_POST['txtlv815'];
$mojo_lv0016->lv016=$_POST['txtlv816'];
$mojo_lv0016->lv026=$_POST['txtlv826'];	
$mojo_lv0016->lv027=$_POST['txtlv827'];	
$mojo_lv0016->lv028=$_POST['txtlv828'];
$mojo_lv0016->lv029=$_POST['txtlv829'];
$mojo_lv0016->lv337=$_POST['txtlv337'];
$mojo_lv0016->lv338=$_POST['txtlv338'];
$mojo_lv0016->lv339=$_POST['txtlv339'];
$mojo_lv0016->lv340=$_POST['txtlv340'];
$mojo_lv0016->lv341=$_POST['txtlv341'];
$mojo_lv0016->lv342=$_POST['txtlv342'];
$mojo_lv0016->lv343=$_POST['txtlv343'];
$mojo_lv0016->lv344=$_POST['txtlv344'];

$mojo_lv0016->lv345=$_POST['txtlv345'];
$mojo_lv0016->lv346=$_POST['txtlv346'];
$mojo_lv0016->lv347=$_POST['txtlv347'];
$mojo_lv0016->lv348=$_POST['txtlv348'];
$mojo_lv0016->lv349=$_POST['txtlv349'];
$mojo_lv0016->lv350=$_POST['txtlv350'];
$mojo_lv0016->lv351=$_POST['txtlv351'];

$mojo_lv0016->lv361=$_POST['txtlv361'];
$mojo_lv0016->lv362=$_POST['txtlv362'];
$mojo_lv0016->lv363=$_POST['txtlv363'];
	$vStrMessage = "";
	if((int)$isExists==0){
		$bResultI = $mojo_lv0016->LV_Insert();
		if($bResultI == true){
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
		} else{
			$vStrMessage = sof_error();
			$flagCtrl = 0;
		}
	} else if((int)$isExists>=1 && (int)$mots_lv0009->lv007==0){
			$mojo_lv0016->LV_Update();
			$vStrMessage = $vLangArr[9];
			$flagCtrl = 1;
	}
}
$mojo_lv0016->LV_Load();
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$mojo_lv0016->Load($mojo_lv0016->ID);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
	.tblcaption
{
	color:#000099;
	font-weight:bold;
	background-color:#CFDDE9;
}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engines.js"></script>
	<title><?php echo $vLangArr[17];?></title>
	<script>

	<!--
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv802.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv802.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	/*=============================================================================*/
	function Back() {
		
		opener.document.frmadd.submit();
		window.close();
	}
	/*=======================================================================================*/
	function isNumber(s){
		if(s!=""){
			var str=".,0123456789";
			for(var j=0;j<s.length;j++)
				if(str.indexOf(s.charAt(j))==-1)
					return false;
			return true;
		}	
		return true;
	}
	
	function Add()
{

RunFunction('','add');
}
function Edt()
{
	lv_chk_list(document.frmchoose,'lvChk',2);
}
function Edit(vValue)
{

	RunFunction(vValue,'edit');
}
function Fil()
{
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>','filter');
}
function Del()
{
	lv_chk_list(document.frmchoose,'lvChk',3);
}
function Delete(vValue)
{
 	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.target="_self";
	o.txtFlag.value=2;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();

}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function Approvals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=3;
	o.target="_self";
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function UnApr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function UnApprovals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.target="_self";
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=2000 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>jo_lv0016?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
	-->
	</script>
</head>
<?php
if($mojo_lv0016->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
		<tr height="25%"><td>&nbsp;</td></tr>
		<tr height="*">
			<td>&nbsp;</td>
			<td width="100%" align="center">
				<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
					<tr>
						<td>&nbsp;</td>
						<td class="td" width="100%" align="center">
							<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" class="tbl">	
								<tr>
									<td class="td" align="center">
									
									<form name="frmadd" id="frmadd" method="POST"
										  action="?func=<?= htmlspecialchars($func) ?>&ID=<?= htmlspecialchars($id) ?>&<?= $saveGet ?>"
										  autocomplete="off">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<?php $vStrMessage = $vStrMessage ?? ''; if($vStrMessage!="" ){ ?>
												<tr>
												  <td class="td" height="20px" colspan="4" align="center"><font color="#3366CC"><?php echo $vStrMessage;?></font></td>
												</tr>
												<?php }?>
												<tr>
													<td class="td" width="18%" height="20px" align="left"><?php echo $vLangArr[13];?></td>	
												  <td class="td" width="32%"><input name="txtlv801" type="text" id="txtlv801"  value="<?php echo $mojo_lv0016->lv001;?>" tabindex="3" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"  readonly="true"/></td>
													<td class="td" width="17%" height="20px" align="left" valign="top"><?php echo $vLangArr[14];?></td>
												  <td class="td" width="33%"><input name="txtlv802" type="text" id="txtlv802" value="<?php echo $mojo_lv0016->FormatView($mojo_lv0016->lv002,22);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true" />                           </td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[15];?></td>
												  <td height="20px" class="td">
												  <table width="80%"><tr><td width="50%">
														<input name="txtlv803" type="text" id="txtlv803"  value="<?php echo $mojo_lv0016->lv003;?>" tabindex="4" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
													  </td><td>
													  <ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
														<input type="text" autocomplete="off" class="search_img_btn" name="txtlv803_search" id="txtlv803_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv803','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopupParent(this,'txtlv803','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
														<div id="lv_popup" lang="lv_popup1"> </div>						  
												</li>
											</ul></td></tr></table>
												 </td>
												  <td><?php echo $vLangArr[16];?></td>									 
												   <td height="20px" class="td">
													 <table width="80%"><tr><td width="50%">
														<input name="txtlv804" type="text" id="txtlv804"  value="<?php echo $mojo_lv0016->lv004;?>" tabindex="4" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
													  </td><td>
													  <ul id="pop-nav2" lang="pop-nav2" onkeyup="ChangeName(this,2)" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
														<input type="text" autocomplete="off" class="search_img_btn" name="txtlv804_search" id="txtlv804_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv804','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopupParent(this,'txtlv804','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
														<div id="lv_popup2" lang="lv_popup2"> </div>						  
												</li>
											</ul></td></tr></table>
											</td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[17];?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv805" id="txtlv805"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv005;?>" /></td>
												</tr>  
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[18];?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv806" id="txtlv806"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv006;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[19];?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv807" id="txtlv807"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv007;?>" /></td>
												</tr>  
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[20];?></td>
													<td height="20px" class="td" valign="top"><input type="password" name="txtlv808" id="txtlv808"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv008;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[21];?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv809" id="txtlv809"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv009;?>" /></td>
												</tr> 
												<tr>
													<td><?php echo 'Chọn hợp đồng để In';?></td>									 
												   <td height="20px" class="td">
													 <table width="80%"><tr><td width="50%">
														<input name="txtlv816" type="text" id="txtlv816"  value="<?php echo $mojo_lv0016->lv016;?>" tabindex="4" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
													  </td><td>
													  <ul id="pop-nav3" lang="pop-nav3" onkeyup="ChangeName(this,3)" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
														<input type="text" autocomplete="off" class="search_img_btn" name="txtlv816_search" id="txtlv816_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv816','hr_lv0043','concat(lv001,@! @!,lv002)')" onFocus="LoadPopupParent(this,'txtlv816','hr_lv0043','concat(lv001,@! @!,lv002)')" tabindex="200" >
														<div id="lv_popup3" lang="lv_popup3"> </div>						  
												</li>
											</ul></td></tr></table>
											</td>
												</tr>  
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[22];?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv826" id="txtlv826"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv026;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[23];?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv827" id="txtlv827"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv027;?>" /></td>
												</tr>  
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[24];?></td>
													<td height="20px" class="td" valign="top"><input type="password" name="txtlv828" id="txtlv828"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv028;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[25];?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv829" id="txtlv829"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv029;?>" /></td>
												</tr> 												
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[26];?></td>
													<td height="20px" class="td" valign="top" colspan="3"><input type="text" name="txtlv815" id="txtlv815"   tabindex="5"  style="width:90%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv015;?>" /></td>
												</tr>  
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Người kiểm kho( dấu , cho nhiều người)';?></td>
													<td height="20px" class="td" valign="top" ><input type="text" name="txtlv337" id="txtlv337"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv337;?>" /></td>
												
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Người duyệt kiểm kho và giữ kho ';?></td>
													<td height="20px" class="td" valign="top" ><input type="text" name="txtlv338" id="txtlv338"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv338;?>" /></td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Giao việc cho mua hàng';?></td>
													<td height="20px" class="td" valign="top" ><input type="text" name="txtlv339" id="txtlv339"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv339;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Duyệt mua hàng';?></td>
													<td height="20px" class="td" valign="top" ><input type="text" name="txtlv340" id="txtlv340"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv340;?>" /></td>
												</tr>  
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Giao việc đầu vào';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv341" id="txtlv341"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv341;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Duyệt đầu vào';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv342" id="txtlv342"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv342;?>" /></td>
												</tr> 
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Giao việc chi tiền';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv343" id="txtlv343"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv343;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Duyệt chi tiền';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv344" id="txtlv344"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv344;?>" /></td>
												</tr> 
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Giao việc thu tiền';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv345" id="txtlv345"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv345;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Duyệt thu tiền';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv346" id="txtlv346"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv346;?>" /></td>
												</tr> 
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Giao việc xuất hoá đơn';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv347" id="txtlv347"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv347;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Duyệt xuất hoá đơn';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv348" id="txtlv348"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv348;?>" /></td>
												</tr> 
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Giao việc xuất kho 4';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv349" id="txtlv349"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv349;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Duyệt xuất kho 4';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv350" id="txtlv350"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv350;?>" /></td>
												</tr> 
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Link hồ sơ ổ đĩa chia sẽ';?></td>
													<td height="20px" class="td" valign="top" colspan="3"><input type="text" name="txtlv351" id="txtlv351"   tabindex="5"  style="width:90%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv351;?>" /></td>
												</tr>  
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Tổng giám đốc';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv361" id="txtlv361"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv361;?>" /></td>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Phó tổng giám đốc';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv362" id="txtlv362"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv362;?>" /></td>
												</tr> 
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo 'Kế toán trưởng';?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv363" id="txtlv363"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mojo_lv0016->lv363;?>" /></td>													
												<tr height="1">
												  <td class="td" colspan="4">&nbsp;</td>
												</tr>
												<tr height="1">
												  <td class="td" colspan="4"><table border="0" cellpadding="0" cellspacing="0" width="100%">		
	</table></td>
											  </tr>
									
												<tr>
													<td class="td" align="center" colspan="4">
<?php
$isRun=1;
if($isRun==1)
{
?>														
														<img type="image" class="btAdd" name="save" onClick="Save();" 
															src="<?php echo $vDir;?>../images/controlright/save_f2.png" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/controlright/save_f2.png"
															onMouseOver="this.src='<?php echo $vDir;?>../images/controlright/save_f2.png" 
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="67"/>
<?php
}
?>															
														</td>
												</tr>
												<tr><td class="td" height="20px" colspan="4" align="center">&nbsp;</td>
											</table>
										</form>

	 <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[17];?>';
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>