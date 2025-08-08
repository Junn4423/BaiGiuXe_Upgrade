<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ts_lv0008.php");
require_once("$vDir../clsall/ts_lv0009.php");
require_once("$vDir../clsall/wb_lv0006.php");	
////////init object////////////////////
	$mots_lv0008=new ts_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0008');
	$mots_lv0009=new ts_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0009');
	//$mowb_lv0006=new wb_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wb0011');
	//$mots_lv0009->obj_wb_lv0006=$mowb_lv0006;
if(isset($_GET['ajax']))
{
	$vwarehouseid=$_GET['warehouseid'];
	echo '[CHECK]';
	echo '<select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:100%" onkeypress="return CheckKeys(event,1,this)" onBlur="LoadItem()"/>';//'.$mots_lv0009->LV_LinkFieldExt('lv003',$vwarehouseid).'</select>	';
	echo '[ENDCHECK]';
	exit;
}	
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TS0037.txt",$plang);
	$vLangArr1=GetLangFile("$vDir../","TS0010.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//LÃ¡ÂºÂ¥y mÃƒÂ£ phiÃ¡ÂºÂ¿u nhÃ¡ÂºÂ­p kho
$mots_lv0008->lv001=InsertWithCheck('ts_lv0008', 'lv001', 'PN-'.getmonth($vNow)."/".getyear($vNow)."-",4);
$isExists =0;//$mots_lv0008->LV_Exist($mots_lv0008->lv001);
$mots_lv0008->lv009=$_POST['txtlv809'];
$mots_lv0008->lv009=($mots_lv0008->lv009=="")?GetServerDate():$mots_lv0008->lv009;
$mots_lv0008->lv009=($mots_lv0008->lv009=="")?GetServerDate():$mots_lv0008->lv009;
$mots_lv0008->lv005=$_POST['txtlv805'];
if($mots_lv0008->lv005=="" || $mots_lv0008->lv005==NULL) $mots_lv0008->lv005="MUAHANG";
if($flagCtrl == 1){
$mots_lv0008->lv002=$_POST['txtlv802'];
$mots_lv0008->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$mots_lv0008->lv004=$_POST['txtlv804'];
$mots_lv0008->lv006=$_POST['txtlv806'];
$mots_lv0008->lv007=0;	
$mots_lv0008->lv008=$_POST['txtlv808'];
	$vStrMessage = "";
	if((int)$isExists==0){
		$bResultI = $mots_lv0008->LV_InsertTemp();
		if($bResultI == true){
			$mots_lv0009->LV_InsertTemp($mots_lv0008->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2),$mots_lv0008->lv002);
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
		} else{
			$vStrMessage = sof_error();
			$flagCtrl = 0;
		}
	} else if((int)$isExists>=1 && (int)$mots_lv0009->lv007==0){
			$mots_lv0008->LV_Update();
			$mots_lv0009->LV_InsertTemp($mots_lv0008->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2),$mots_lv0008->lv002);	
			$vStrMessage = $vLangArr[9];
			$flagCtrl = 1;
	}
}
$mots_lv0008->ArrPush[0]=$vLangArr[17];
$mots_lv0008->ArrPush[1]=$vLangArr[18];
$mots_lv0008->ArrPush[2]=$vLangArr[19];
$mots_lv0008->ArrPush[3]=$vLangArr[20];
$mots_lv0008->ArrPush[4]=$vLangArr[21];
$mots_lv0008->ArrPush[5]=$vLangArr[22];
$mots_lv0008->ArrPush[6]=$vLangArr[23];
$mots_lv0008->ArrPush[7]=$vLangArr[24];
$mots_lv0008->ArrPush[8]=$vLangArr[25];
$mots_lv0008->ArrPush[9]=$vLangArr[26];
$mots_lv0008->ArrPush[10]=$vLangArr[27];
$mots_lv0008->ArrPush[11]=$vLangArr[28];
$mots_lv0008->ArrPush[12]=$vLangArr[29];
$mots_lv0008->ArrPush[13]=$vLangArr[40];
$mots_lv0008->ArrPush[14]=$vLangArr[31];
$mots_lv0008->ArrPush[15]=$vLangArr[32];
$vFieldList="lv001,lv004,lv009";
$strParent=$mots_lv0008->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vNow);
$strParent=str_replace("'","\'",$strParent);
$strParent=str_replace("
","",$strParent);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$mots_lv0008->Load($mots_lv0008->ID);
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
	function search_item(e)
	{
		var keynum;
		var keychar;
		var numcheck;
		if(window.event) // IE
		  {
		  keynum = e.keyCode;
		  }
		else if(e.which) // Netscape/Firefox/Opera
		  {
		  keynum = e.which;
		  }
		else
		{
			keynum = e.keyCode;
		}
		if(keynum=="115")
		{
			var o=document.frmadd;
			o.txtlv903_search.focus();
		}
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv802.value=="")
		{
			alert("<?php echo 'Please! Option warehouse to save';?>");
			o.txtlv802.focus();
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
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>ts_lv0030/ts_lv0030.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
		div = document.getElementById('lvloaddata');
		div.innerHTML=str;
		document.frmadd.txtlv903.focus();
	}
	function Add()
	{
		var o=document.frmadd;
		var vlv913=0;
		if(o.txtlv913.checked==true) vlv913=1;
		var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv008="+o.txtlv908.value+"&txtlv009="+o.txtlv909.value+"&txtlv010="+o.txtlv910.value+"&txtlv011="+o.txtlv911.value+"&txtlv012="+o.txtlv912.value+"&txtlv013="+vlv913+"&txtlv014="+o.txtlv914.value+"&txtlv015="+o.txtlv915.value+"&txtOpt=1";
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>ts_lv0030/ts_lv0030.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
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
				LoadPopupParent(to,'txtlv806','sl_lv0013','concat(lv003,@! @!,lv016,@! @!,lv002,@!-@!,lv004)');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv806','sl_lv0013','concat(lv003,@! @!,lv016,@! @!,lv002,@!-@!,lv004)');
				break;
			case 'MUAHANG':
				LoadPopupParent(to,'txtlv806','ts_lv0021','concat(lv003,@! - @!,lv001,@! SUP:@!,lv002,@! Delivery:@!,lv005)');
				break;
		}
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlv912amount.value=parseFloat(o.txtlv904.value*o.txtlv908.value*o.txtlv912.value/100);
		o.txtlv910amount.value=parseFloat(o.txtlv904.value*o.txtlv908.value*o.txtlv910.value/100);
		o.txtlvallamount.value=-parseFloat(o.txtlv912amount.value)+parseFloat(o.txtlv910amount.value)+parseFloat(o.txtlv904.value*o.txtlv908.value);
		
	}
	function CalculateMP()
	{
		var o=document.frmadd;
		o.txtlv904.value=parseFloat(o.txtlv906.value*o.txtconvert.value);
		CalculateM();
	}
	function CalculateMPR()
	{
		var o=document.frmadd;
		o.txtlv908.value=parseFloat(o.txtlvpriceconvert.value/o.txtconvert.value);
		CalculateM();
	}
	
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('ts_lv0027_/ts_lv0027exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value+'&lv003='+o.txtlv802.value,1);
	}
	function Report(vValue)
	{
	var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>ts_lv0008?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	function LoadSource()
	{
	var o=document.frmadd;
	var vo=o.txtlv805.value;
	var vlv013='0';
	if(o.txtlv913.checked)		vlv013='1';
		switch(vo)
		{
			case 'BANHANG':
				ajax_do ('ts_lv0027_/ts_lv0027excesource.php?&lang=<?php echo $plang;?>&Type=BANHANG&&childfunc=load'+'&lv002='+o.txtlv802.value+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value+'&lv913='+vlv013,1);
				window.setTimeout('RunFunction()',500);
				break;
			case 'TRAHANG':
				break;
			case 'MUAHANG':
				ajax_do ('ts_lv0027_/ts_lv0027excesource.php?&lang=<?php echo $plang;?>&Type=MUAHANG&&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value+'&lv913='+vlv013,1);
				window.setTimeout('RunFunction()',500);
				break;
		}

		
	}
	-->
	</script>
</head>
<?php
if($mots_lv0008->GetAdd()>0)
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
										<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											<input type="hidden" name="txtconvert" id="txtconvert" value="1"/>
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<?php if($vStrMessage!=""){ ?>
												<tr>
												  <td class="td" height="20px" colspan="4" align="center"><font color="#3366CC"><?php echo $vStrMessage;?></font></td>
												</tr>
												<?php }?>
												<tr>
													<td class="td" width="18%" height="20px" align="left"><?php echo $vLangArr[19];?></td>	
												  <td class="td" width="32%"><input name="txtlv801" type="text" id="txtlv801"  value="<?php echo InsertWithCheck('ts_lv0008', 'lv001', 'PN-'.getmonth($vNow)."/".getyear($vNow)."-",4);?>" tabindex="3" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"  readonly="true"/></td>
													<td class="td" width="17%" height="20px" align="left" valign="top"><?php echo $vLangArr[20];?></td>
												  <td class="td" width="33%"><select name="txtlv802" id="txtlv802"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)" onchange="changewarehourse_change(this.value)">
                                                    <?php echo $mots_lv0008->LV_LinkField('lv002',$mots_lv0008->lv002);?>
                                                  </select>                                   </td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[22];?></td>
												  <td height="20px" class="td"><input name="txtlv804" type="text" id="txtlv804"  value="<?php echo $mots_lv0008->lv004;?>" tabindex="4" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>		<td><?php echo $vLangArr[27];?></td>
												  <td><input name="txtlv809" type="text" id="txtlv809" value="<?php echo $mots_lv0008->FormatView($mots_lv0008->lv009,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)" />
                                                    <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv809);return false;" /> </td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[23];?></td>
													<td height="20px" class="td" valign="top"><label>
													  <select name="txtlv805" id="txtlv805"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
												
                                                      <?php echo $mots_lv0008->LV_LinkField('lv005',$mots_lv0008->lv005);?>
                                                      </select>
                                                      <input type="button" name="Load2" value="۩▲" tabindex="20" onClick="LoadSource()" >
													</label></td>
												    <td height="20px" class="td" ><?php echo $vLangArr[24];?></td>
												    <td height="20px" class="td"> 
                                                      <table style="border:0px;width:80%">
                                                        <tr>
                                                          <td><input name="txtlv806" type="text" id="txtlv806"  value="<?php echo $mots_lv0008->lv006;?>" tabindex="6" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/></td>
                                                          <td><ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" style="padding:0px;list-style:none;padding-left:5px;">
                                                              <li class="menupopT">
                                                                <input type="text" autocomplete="off" class="search_img_btn" name="txtlv806_search" id="txtlv806_search" style="width:100%;background-color:#dddddd" onKeyUp="LoadType(this)" onFocus="LoadType(this)" tabindex="200"/>
                                                                <div id="lv_popup" lang="lv_popup1" > </div>
                                                              </li>
                                                          </ul></td>
                                                        </tr>
                                                      </table></td>
												</tr>
												
												<tr height="1">
													<td class="td"><?php echo $vLangArr[26];?></td>
												    <td colspan="3" class="td"><textarea name="txtlv808" rows="1" id="txtlv808" style="width:80%" tabindex="13" ><?php echo $mots_lv0008->lv008;?></textarea></td>
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
                                                      <td width="100%" align="center" class="detail_title"><?php echo $vLangArr[16];?></h3></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td width="13%"><?php echo $vLangArr[31];?></td>
                                                          <td width="34%"><table border=0 cellpadding="0" cellspacing="0" width="100%"><tr><td width="80%"><div id="itemsgetid"><select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:100%;" onkeypress="return CheckKeys(event,1,this)" onBlur="LoadItem()" />
                                                            </select></div></td><td width="20%"></td></tr></table>
                                                            </td>
                                                          <td width="17%"><table>
                                                              <tr>
                                                                <td ><ul id="pop-nav4" lang="pop-nav4"  onkeyup="ChangeName(this,4)" onMouseOver="ChangeName(this,4)" xml:lang="pop-nav4">
                                                                    <li class="menupopT">
                                                                      <input type="text" autocomplete="off" class="search_img_btn" name="txtlv903_search" id="txtlv903_search" style="width:100%"  onKeyUp="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@!-@!,lv010,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@!-@!,lv010,@! @!,lv001)')" tabindex="200" class="search_img_btn"/>
                                                                      <div id="lv_popup4" lang="lv_popup4" xml:lang="lv_popup4"> </div>
                                                                    </li>
                                                                </ul></td>
                                                              </tr>
                                                            </table></td>
                                                            <td align="right" style="postion:relative"><div style="text-align:left"><input type="checkbox" name="txtlv913" id=txtlv913 value="0"/><?php echo $vLangArr[41];?></div><div style="postion:relative;width:50%px;"><img id="txtimg_load_sp" name="txtimg_load_sp" style="right:50px;position:absolute;" src="" border="0" height="50"/></div></td>
                                                        </tr>
														 <tr>
                                                          <td><?php echo $vLangArr[34];?></td>
                                                          <td><input name="txtlv906" type="text" onblur="CalculateMP()"  id="txtlv906" value="<?php echo (float)$mots_lv0009->lv006;?>" tabindex="21" maxlength="255" style="width:40%" onKeyPress="return CheckKey(event,1)" /><input name="txtlvpriceconvert" type="text" onblur="CalculateMPR()"  id="txtlvpriceconvert" value="<?php echo (float)$mots_lv0009->lv006;?>" tabindex="21" maxlength="255" style="width:40%" onKeyPress="return CheckKey(event,1)" /></td>
                                                          <td><?php echo $vLangArr[35];?></td>
                                                          <td><select name="txtlv907" id="txtlv907"  tabindex="29"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $mots_lv0009->LV_LinkField('lv007',$mots_lv0009->lv007);?>
                                                            </select></td>
                                                        </tr> 
													   <tr>
                                                          <td width="13%"><?php echo $vLangArr[32];?></td>
                                                          <td width="34%"><input onkeyup="CalculateM()"  onChange="CalculateM()" name="txtlv904" id="txtlv904"   tabindex="21"  style="width:80%" onKeyPress="return CheckKey(event,1)" value="<?php echo (float)$mots_lv0009->lv004;?>"/></td>
                                                          <td width="17%"><?php echo $vLangArr[33];?></td>
                                                          <td width="36%"><select name="txtlv905" id="txtlv905"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $mots_lv0009->LV_LinkField('lv005',$mots_lv0009->lv005);?>
                                                            </select>
                                                            <br /></td>
                                                        </tr>
                                                       
                                                       
                                                       
                                                        <tr>
                                                          <td><?php echo $vLangArr[36];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()" type="text" name="txtlv908" id="txtlv908"  style="width:80%"  tabindex="23"  value="<?php echo (float)$mots_lv0009->lv008;?>" onKeyPress="return CheckKey(event,1)"></td>
                                                          <td><?php echo $vLangArr[37];?></td>
                                                          <td><select name="txtlv909" id="txtlv909"   tabindex="13"  style="width:80%" onKeyPress="return CheckKey(event,1)"/>
							  <?php echo $mots_lv0009->LV_LinkField('lv009',$mots_lv0009->lv009);?>
							  </select></td>
                                                        </tr>
                                                         <tr>
                                                          <td><?php echo $vLangArr[42];?></td>
                                                          <td>
							  <table style="width:80%"><tr>
							  <td><input  name="txtlv914" type="text" id="txtlv914" value="<?php echo $mots_lv0009->lv014;?>" tabindex="23" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,1,this)" /></td>
							  <td>
							    <ul id="pop-nav7" lang="pop-nav7" onkeyup="ChangeName(this,7)" onMouseOver="ChangeName(this,7)" onkeyup="ChangeName(this,7)"> <li class="menupopT">
							      <input type="text" autocomplete="off" class="search_img_btn" name="txtlv914_search" id="txtlv914_search" style="width:100%" onKeyUp="LoadPopupParentWHCondi(this,'txtlv914','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)',document.frmadd.txtlv802.value)" onFocus="LoadPopupParentWHCondi(this,'txtlv914','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)',document.frmadd.txtlv802.value)" tabindex="200" >
							      <div id="lv_popup7" lang="lv_popup7"> </div>						  
						  </li>
					  </ul></td></tr></table></td>
					   <td><?php echo $vLangArr[39];?></td>
                                                          <td><input name="txtlv911" type="text" id="txtlv911" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv911);return false;" value="<?php echo $mots_lv0009->FormatView($vNow,2);?>" tabindex="23" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,1)" />
                                                    <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="123"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv911);return false;" /></td>
                                                         </tr>
                                                        <tr>
                                                           <td><?php echo $vLangArr[38];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()"  name="txtlv910" type="text" id="txtlv910" value="<?php echo (float)$mots_lv0009->lv010;?>" tabindex="26" maxlength="255" style="width:30%" onKeyPress="return CheckKey(event,1)" /><input  name="txtlv910amount" type="text" id="txtlv910amount" readonly="true" style="width:48%;background:#cccccc;border:1px #999999 solid"></td>
                                                          <td><?php echo $vLangArr[43];?></td>
                                                          <td><input  name="txtlv915" type="text" id="txtlv915" value="<?php echo $mots_lv0009->lv015;?>" tabindex="24" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                       </tr>
                                                         <tr>
                                                           <td><?php echo $vLangArr[40];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()"  name="txtlv912" type="text" id="txtlv912" value="<?php echo (float)$mots_lv0011->lv013;?>" tabindex="26" maxlength="255" style="width:30%" onKeyPress="return CheckKey(event,1)" /><input  name="txtlv912amount" type="text" id="txtlv912amount" readonly="true" style="width:48%;background:#cccccc;border:1px #999999 solid"></td>
                                                          <td ><?php echo $vLangArr[58];?></td><td><input  name="txtlvallamount" type="text" id="txtlvallamount" readonly="true" style="width:80%;background:#cccccc;border:1px #999999 solid"></td>
                                                         
                                                        </tr>
                                                         <tr>
                                                         	<td colspan="2"><img border="0" title="<?php echo $vLangArr[35];?>" class="imgButton" onClick="Add()" onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add_02<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" src="<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg" tabindex="29" onKeyPress="return CheckKey(event,11)"/></td>
                                                        	
                                                        </tr>
                                                      </table></td>
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
	 <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<script language="javascript">
window.setTimeout('RunFunction()',100);
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[61];?>';
div2 = document.getElementById('lv_right_titlelist');
div2.innerHTML='<?php echo $strParent;?>';
</script>
<script language="javascript">
changewarehourse_change(document.frmadd.txtlv802.value);
function changewarehourse_change(value)
		{
			$xmlhttp=null;
			if(value=="") 
			{
				//alert("Please! WarehourseID is not empty!");
				return false;
			}
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajax=ajaxcheck"+"&warehouseid="+value;
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
				document.getElementById('itemsgetid').innerHTML=domainid;
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