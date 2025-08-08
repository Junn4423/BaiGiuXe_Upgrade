<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ts_lv0041.php");
require_once("$vDir../clsall/ts_lv0042.php");
////////init object////////////////////
	$mots_lv0041=new ts_lv0041($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0041');
	$mots_lv0042=new ts_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0042');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TS0057.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['ajax']))
{
	echo '[CHECK]';
	echo '<select name="txtlv911" id="txtlv911"   tabindex="24"  style="width:80%" onkeypress="return CheckKey(event,1)" />'.$mots_lv0042->LV_LinkFieldMulti('lv011'," and lv010='".$_GET['cutid']."' and lv003='".$_GET['itemid']."' and lv011='".$_GET['cateid']."'").'</select>	';
	echo '[ENDCHECK]';
	exit;
}
if(isset($_GET['ajaxcut']))
{
	echo '[CUTCHECK]';
echo '<select name="txtlv909" id="txtlv909"   tabindex="21"  style="width:80%" onkeypress="return CheckKey(event,1)" onChange="ChangeCut_LoadColor(this.value)" /><option value="">--Chọn cut--</option>'.$mots_lv0042->LV_LinkField('lv009',$_GET['itemid']).'</select>	';
	echo '[ENDCUTCHECK]';
	exit;
}
if(isset($_GET['ajaxcolor']))
{
	echo '[COLCHECK]';
echo '<select name="txtlv908" id="txtlv908"   tabindex="22"  style="width:80%" onkeypress="return CheckKey(event,1)"   onChange="ChangeColor_LoadCateSize(this.value)" /><option value="">--Chọn màu--</option>'.$mots_lv0042->LV_LinkFieldMulti('lv008'," and lv010='".$_GET['cutid']."' and lv003='".$_GET['itemid']."'").'</select>	';
	echo '[ENDCOLCHECK]';
	exit;
}
if(isset($_GET['ajaxcate']))
{
	echo '[CATCHECK]';
echo '<select name="txtlv910" id="txtlv910"   tabindex="23"  style="width:80%" onkeypress="return CheckKey(event,1)"    onChange="ChangeCate_LoadSize(this.value)" /><option value="">--Chọn loại--</option>'.$mots_lv0042->LV_LinkFieldMulti('lv010'," and lv010='".$_GET['cutid']."' and lv003='".$_GET['itemid']."' and lv009='".$_GET['colorid']."'").'</select>	';
	echo '[ENDCATCHECK]';
	exit;
}
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//Lấy mã phiếu nhập kho
$mots_lv0041->lv001=InsertWithCheck('ts_lv0041', 'lv001', 'PN-'.getmonth($vNow)."/".getyear($vNow)."-",4);
$isExists =0;//$mots_lv0041->LV_Exist($mots_lv0041->lv001);
$mots_lv0041->lv009=$_POST['txtlv809'];
$mots_lv0041->lv009=($mots_lv0041->lv009=="")?GetServerDate():$mots_lv0041->lv009;
if($flagCtrl == 1){
$mots_lv0041->lv002=$_POST['txtlv802'];
$mots_lv0041->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$mots_lv0041->lv004=$_POST['txtlv804'];
$mots_lv0041->lv005=$_POST['txtlv805'];
$mots_lv0041->lv006=$_POST['txtlv806'];
$mots_lv0041->lv007=0;	
$mots_lv0041->lv008=$_POST['txtlv808'];
$mots_lv0041->lv010=$_POST['txtlv810'];
	$vStrMessage = "";
	if((int)$isExists==0){
		$bResultI = $mots_lv0041->LV_InsertTemp();
		if($bResultI == true){
			$mots_lv0042->LV_InsertTemp($mots_lv0041->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2),$mots_lv0041->lv002);
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
		} else{
			$vStrMessage = sof_error();
			$flagCtrl = 0;
		}
	} else if((int)$isExists>=1 && (int)$mots_lv0042->lv007==0){
			$mots_lv0041->LV_Update();
			$mots_lv0042->LV_InsertTemp($mots_lv0041->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2),$mots_lv0041->lv002);	
			$vStrMessage = $vLangArr[9];
			$flagCtrl = 1;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$mots_lv0041->Load($mots_lv0041->ID);
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
	function RunFunction()
	{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>ts_lv0044/ts_lv0044.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	}
	function Add()
	{
	var o=document.frmadd;
	var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv008="+o.txtlv908.value+"&txtlv009="+o.txtlv909.value+"&txtlv010="+o.txtlv910.value+"&txtlv011="+o.txtlv911.value+"&txtlv012="+o.txtlv912.value+"&txtlv015="+o.txtlv915.value+"&txtlv018="+o.txtlv918.value+"&txtOpt=1";
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>ts_lv0044/ts_lv0044.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	o.txtlv903.focus();
	}
	function LoadType(to)
	{

		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'BANHANG':
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'MUAHANG':
				LoadPopupParent(to,'txtlv806','ts_lv0021','lv003');
				break;
		}
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('ts_lv0043/ts_lv0043exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value+'&lv003='+o.txtlv802.value,1);
	}
	function LoadSource()
	{
	var o=document.frmadd;
	var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'BANHANG':
				ajax_do ('ts_lv0043/ts_lv0043excesource.php?&lang=<?php echo $plang;?>&Type=BANHANG&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
			case 'TRAHANG':
				ajax_do ('ts_lv0043/ts_lv0043excesource.php?&lang=<?php echo $plang;?>&Type=TRAHANG&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
			case 'MUAHANG':
				ajax_do ('ts_lv0043/ts_lv0043excesource.php?&lang=<?php echo $plang;?>&Type=MUAHANG&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
		}

		
	}
	-->
	</script>
</head>
<?php
if($mots_lv0041->GetAdd()>0)
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
						<td class="td" colspan="3"><h2><?php echo $vLangArr[17];?></h2></td>
					</tr>
					<tr><td class="td" colspan="3">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="td" width="100%" align="center">
							<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" class="tbl">	
								<tr>
									<td class="td" align="center">
										<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<?php if($vStrMessage!=""){ ?>
												<tr>
												  <td class="td" height="20px" colspan="4" align="center"><font color="#3366CC"><?php echo $vStrMessage;?></font></td>
												</tr>
												<?php }?>
												<tr>
													<td class="td" width="18%" height="20px" align="left"><?php echo $vLangArr[19];?></td>	
												  <td class="td" width="32%"><input name="txtlv801" type="text" id="txtlv801"  value="<?php echo InsertWithCheck('ts_lv0041', 'lv001', 'PN-'.getmonth($vNow)."/".getyear($vNow)."-",4);?>" tabindex="3" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"  readonly="true"/></td>
													<td class="td" width="17%" height="20px" align="left" valign="top"><?php echo $vLangArr[20];?></td>
												  <td class="td" width="33%"><select name="txtlv802" id="txtlv802"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
                                                    <?php echo $mots_lv0041->LV_LinkField('lv002',$mots_lv0041->lv002);?>
                                                  </select>
                                                    <br />
                                                    <table>
                                                      <tr>
                                                        
                                                        <td><ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" xml:lang="pop-nav1">
                                                            <li class="menupopT">
                                                              <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch32" id="txtlvsearch32" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv802','sl_lv0001','lv003')" onFocus="LoadPopupParent(this,'txtlv802','sl_lv0001','lv003')" tabindex="200">
                                                              <div id="lv_popup" lang="lv_popup1" xml:lang="lv_popup1"> </div>
                                                            </li>
                                                        </ul></td>
                                                      </tr>
                                                    </table>                                                  </td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[22];?></td>
												  <td height="20px" class="td"><input name="txtlv804" type="text" id="txtlv804"  value="<?php echo $mots_lv0041->lv004;?>" tabindex="4" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>		<td><?php echo $vLangArr[27];?></td>
												  <td><input name="txtlv809" type="text" id="txtlv809" value="<?php echo $mots_lv0041->FormatView($mots_lv0041->lv009,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)" />
                                                    <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv809);return false;" /></td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[23];?></td>
													<td height="20px" class="td" valign="top"><label>
													  <select name="txtlv805" id="txtlv805"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
												
                                                      <?php echo $mots_lv0041->LV_LinkField('lv005',$mots_lv0041->lv005);?>
                                                      </select>
                                                      <input type="button" name="Load2" value="۩▲" tabindex="20" onClick="LoadSource()" >
                                                      <br />
													</label></td>
												    <td height="20px" class="td" ><?php echo $vLangArr[24];?></td>
												    <td height="20px" class="td"><input name="txtlv806" type="text" id="txtlv806"  value="<?php echo $mots_lv0041->lv006;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>  <br />
                                                      <table>
                                                        <tr>
                                                          
                                                          <td><ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" xml:lang="pop-nav3">
                                                              <li class="menupopT">
                                                                <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadType(this)" onFocus="LoadType(this)" tabindex="200">
                                                                <div id="lv_popup3" lang="lv_popup3" xml:lang="lv_popup3"> </div>
                                                              </li>
                                                          </ul></td>
                                                        </tr>
                                                      </table></td>
												</tr>
												
												<tr height="1">
                                                	<td class="td"><?php echo $vLangArr[54];?></td>
												    <td  class="td"><input name="txtlv810" rows="3" id="txtlv810" style="width:80%" tabindex="13" value="<?php echo ($mots_lv0041->lv010=="")?"10":$mots_lv0041->lv010;?>" /></td>
													<td class="td"><?php echo $vLangArr[26];?></td>
												    <td  class="td"><textarea name="txtlv808" rows="3" id="txtlv808" style="width:80%" tabindex="13" ><?php echo $mots_lv0041->lv008;?></textarea></td>
											    </tr>												
												<tr height="1">
												  <td class="td" colspan="4">&nbsp;</td>
												</tr>
												<tr height="1">
												  <td class="td" colspan="4"><table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="13">
				<img name="table_r1_c1" src="<?php echo $vDir;?>images/pictures/table_r1_c1.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="*" background="<?php echo $vDir;?>images/pictures/table_r1_c2.gif">
				</td>
			<td width="13">
				<img name="table_r1_c3" src="<?php echo $vDir;?>images/pictures/table_r1_c3.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="11">
				</td>
		</tr>
		<tr>
			<td background="<?php echo $vDir;?>images/pictures/table_r2_c1.gif">
				</td>
			<td><table width="100%" border="0">
                                                    <tr>
                                                      <td width="100%" align="center"><h3><?php echo $vLangArr[16];?></h3></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td width="13%"><?php echo $vLangArr[31];?></td>
                                                          <td width="34%"><select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:80%" onkeypress="return CheckKey(event,1)" onChange="ChangeItem_LoadCut(this.value)"/>
                                                            <?php echo $mots_lv0042->LV_LinkField('lv003',$mots_lv0042->lv003);?>
                                                            </select>
                                                            <br />
                                                            <table>
                                                              <tr>
                                                                
                                                                <td><ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" xml:lang="pop-nav4">
                                                                    <li class="menupopT">
                                                                      <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch13" id="txtlvsearch13" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,lv001)')" tabindex="200">
                                                                      <div id="lv_popup4" lang="lv_popup4" xml:lang="lv_popup4"> </div>
                                                                    </li>
                                                                </ul></td>
                                                              </tr>
                                                            </table></td>
                                                          <td width="17%"><label>
                                                            <input type="button" name="Load" value="۩▲" tabindex="20" onClick="LoadItem()" >
                                                          </label></td>
                                                          <td width="36%">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td ><?php echo $vLangArr[37];?></td>
                                                          <td><div id="cutgetid"><select name="txtlv909" id="txtlv909"   tabindex="21"  style="width:80%" onkeypress="return CheckKey(event,1)" onChange="ChangeCut_LoadColor(this.value)"/>
                                                          <?php echo $mots_lv0042->LV_LinkField('lv009',$mots_lv0042->lv009);?>
                                                           
							  </select></div><br>
							  <table><tr><td>
							    <ul id="pop-nav7" lang="pop-nav7" onMouseOver="ChangeName(this,7)" onkeyup="ChangeName(this,7)"> <li class="menupopT">
							      <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch7" id="txtlvsearch7" style="width:200px" onKeyUp="LoadPopupParentWHCondi(this,'txtlv914','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)',document.frmadd.txtlv802.value)" onFocus="LoadPopupParentWH(this,'txtlv914','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)',document.frmadd.txtlv802.value)" tabindex="200" >
							      <div id="lv_popup7" lang="lv_popup7"> </div>						  
						  </li>
					  </ul></td></tr></table></td>
                                                          <td ><?php echo $vLangArr[36];?></td>
                                                          <td><div id="colorgetid"><input type="text" name="txtlv908" id="txtlv908"  style="width:80%"  tabindex="22"  value="<?php echo $mots_lv0042->lv008;?>" onKeyPress="return CheckKey(event,1)"></div></td>
                                                        </tr>
                                                        <tr>
                                                        	<td><?php echo $vLangArr[39];?></td>
                                                          <td><div id="catgetid"><select name="txtlv910" id="txtlv910"   tabindex="24"  style="width:80%" onkeypress="return CheckKey(event,1)" onChange="changecategory_change(this.value)"/>
                                                          <?php echo $mots_lv0042->LV_LinkField('lv010',$mots_lv0042->lv010);?>
							  </select></div></td>
                                                          <td><?php echo $vLangArr[38];?></td>
                                                            <td><div id="sizegetid">
                                                            <select name="txtlv911" id="txtlv911"   tabindex="25"  style="width:80%" onkeypress="return CheckKey(event,1)" onChange="changecategory_change(this.value)"/>
                                                           
							  </select></div></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[32];?></td>
                                                          <td><input name="txtlv904" id="txtlv904"   tabindex="26"  style="width:80%" onKeyPress="return CheckKey(event,1)" value="<?php echo (float)$mots_lv0042->lv004;?>"/></td>
                                                          <td><?php echo $vLangArr[33];?></td>
                                                          <td><select name="txtlv905" id="txtlv905"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $mots_lv0042->LV_LinkField('lv005',$mots_lv0042->lv005);?>
                                                            </select>
                                                            <br /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[34];?></td>
                                                          <td><input name="txtlv906" type="text" id="txtlv906" value="<?php echo (float)$mots_lv0042->lv006;?>" tabindex="27" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                          <td><?php echo $vLangArr[35];?></td>
                                                          <td><select name="txtlv907" id="txtlv907"   tabindex="11"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $mots_lv0042->LV_LinkField('lv007',$mots_lv0042->lv007);?>
                                                            </select></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[46];?></td>
                                                          <td><input name="txtlv918" type="text" id="txtlv918" value="<?php echo $mots_lv0042->lv018;?>" tabindex="27" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                          <td><?php echo $vLangArr[40];?></td>
                                                          <td><select name="txtlv912" id="txtlv912"   tabindex="28"  style="width:80%" onkeypress="return CheckKey(event,1)" />
                                                            <?php echo $mots_lv0042->LV_LinkField('lv012',$mots_lv0042->lv012);?>
                                                            </select>
                                                            <br />
                                                            <table>
                                                              <tr>
                                                                
                                                                <td><ul id="pop-nav8" lang="pop-nav8" onMouseOver="ChangeName(this,8)" xml:lang="pop-nav4">
                                                                    <li class="menupopT">
                                                                      <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch13" id="txtlvsearch13" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv912','ts_lv0036','lv002')" onFocus="LoadPopupParent(this,'txtlv912','ts_lv0036','lv002')" tabindex="200">
                                                                      <div id="lv_popup8" lang="lv_popup8" xml:lang="lv_popup8"> </div>
                                                                    </li>
                                                                </ul></td>
                                                              </tr>
                                                              
                                                          </table></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[26];?></td>
                                                          <td><input name="txtlv915" type="text" id="txtlv915" value="<?php echo $mots_lv0042->lv015;?>" tabindex="27" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                          <td>&nbsp;</td>
                                                          <td>&nbsp;</td>
                                                        </tr>
														
                                                      </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td><img border="0" title="<?php echo $vLangArr[35];?>" class="imgButton" onClick="Add()" onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add_02<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" src="<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg" tabindex="29" onKeyPress="return CheckKey(event,11)"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><?php
$isRun=1;
if($isRun==1)
{
?>														
														<img type="image" class="btAdd" name="save" onClick="Save();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="66"/>
<?php
}
?>															
														<img type="image" class="btAdd" name="back" onClick="Back();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[5];?>" tabindex="67" onKeyUp="return loadkey(event,2)"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td><div id="idProdcess"></div></td>
                                                    </tr>
                                                    
                                                  </table>
				 
<!--////////////////////////////////////Code add here///////////////////////////////////////////-->			</td>
			<td background="<?php echo $vDir;?>images/pictures/table_r2_c3.gif">
				</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<img name="table_r3_c1" src="<?php echo $vDir;?>images/pictures/table_r3_c1.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td background="<?php echo $vDir;?>images/pictures/table_r3_c2.gif">
				</td>
			<td>
				<img name="table_r3_c3" src="<?php echo $vDir;?>images/pictures/table_r3_c3.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td></td>
		</tr>
	</table></td>
											  </tr>
												<tr height="1"><td class="td" colspan="4">
												<div id="lvloaddata"></div></td>
												</tr>
												<tr>
													<td class="td" align="center" colspan="4">
<?php
$isRun=1;
if($isRun==1)
{
?>														
														<img type="image" class="btAdd" name="save" onClick="Save();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="67"/>
<?php
}
?>															
														<img type="image" class="btAdd" name="back" onClick="Back();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[5];?>" tabindex="67" onKeyUp="return loadkey(event,2)"/></td>
												</tr>
												<tr><td class="td" height="20px" colspan="4" align="center">&nbsp;</td>
											</table>
										</form>
										
									</td>
								</tr>
							</table>
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="25%"><td>&nbsp;</td></tr>
	</table>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<script language="javascript">
window.setTimeout('RunFunction()',100);
document.frmadd.txtlv903.focus();
function ChangeCate_LoadSize(value)
		{
			$xmlhttp=null;
			
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajax=ajaxcheck"+"&itemid="+itemid+"&cutid="+cutid+"&colorid="+"&cateid="+value;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChanged;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChanged()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('sizegetid').innerHTML=domainid;
			}
		}
		function ChangeItem_LoadCut(value)
		{
			$xmlhttp=null;
			
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxcut=ajaxcheck"+"&itemid="+value;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChangedCut;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChangedCut()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CUTCHECK]')+10;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCUTCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('cutgetid').innerHTML=domainid;
			}
		}
		function ChangeCut_LoadColor(value)
		{
			itemid=document.frmadd.txtlv903.value;
			$xmlhttp=null;
			
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxcolor=ajaxcheck"+"&itemid="+itemid+"&cutid="+value;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChangedColor;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChangedColor()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[COLCHECK]')+10;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCOLCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('colorgetid').innerHTML=domainid;
			}
		}
		function ChangeColor_LoadCateSize(value)
		{
			itemid=document.frmadd.txtlv903.value;
			cutid=document.frmadd.txtlv909.value;
			
			$xmlhttp=null;
			
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxcate=ajaxcheck"+"&itemid="+itemid+"&cutid="+cutid+"&colorid="+value;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChangedCateSize;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChangedCateSize()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CATCHECK]')+10;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCATCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('catgetid').innerHTML=domainid;
			}
		}
		function GetXmlHttpObject()
		{
			if (window.XMLHttpRequest)
			{
			  // code for IE7+, Firefox, Chrome, Opera, Safari
				return new XMLHttpRequest();
			}
			if (window.ActiveXObject)
			{
			  // code for IE6, IE5
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			return null;
		}
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>