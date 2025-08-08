<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ts_lv0021.php");
require_once("$vDir../clsall/ts_lv0022.php");
////////init object////////////////////
	$mots_lv0021=new ts_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0021');
	$mots_lv0022=new ts_lv0022($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0022');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TS0039.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//Láº¥y mÃ£ phiáº¿u nháº­p kho
$mots_lv0021->lv001=InsertWithCheck('ts_lv0021', 'lv001', 'PM-'.getmonth($vNow)."/".getyear($vNow)."-",3);
$mots_lv0021->lv004=$_POST['txtlv804'];
$mots_lv0021->lv004=($mots_lv0010->lv004=="")?$vNow:$mots_lv0021->lv004;
$isExists = 0;//$mots_lv0021->LV_Exist($mots_lv0021->lv001);
if($flagCtrl == 1){
$mots_lv0021->lv002=$_POST['txtlv802'];
$mots_lv0021->lv003=$_POST['txtlv803'];
$mots_lv0021->lv004=$_POST['txtlv804'];
$mots_lv0021->lv005=$_POST['txtlv805'];
$mots_lv0021->lv006=$_POST['txtlv806'];
$mots_lv0021->lv007=$_POST['txtlv807'];
$mots_lv0021->lv008=$_POST['txtlv808'];
$mots_lv0021->lv009=$_POST['txtlv809'];
$mots_lv0021->lv010=$_POST['txtlv810'];
$mots_lv0021->lv011=0;
	$vStrMessage = "";
	if((int)$isExists==0){
		$bResultI = $mots_lv0021->LV_InsertTemp();
		if($bResultI == true){
			$mots_lv0022->LV_InsertTemp($mots_lv0021->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2));
			$vStrMessage = $vLangArr[51];
			$flagCtrl = 1;
		} else{
			$vStrMessage = $vLangArr[8].sof_error();
			$flagCtrl = 0;
		}
	} else if((int)$isExists>=1 && (int)$mots_lv0022->lv011==0){
			$mots_lv0021->LV_Update();
			$mots_lv0022->LV_InsertTemp($mots_lv0021->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2));	
			$vStrMessage = $vLangArr[9];
			$flagCtrl = 1;
	}
}
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("$vDir../","TS0024.txt",$plang);
$mots_lv0021->ArrPush[0]=$vLangArr1[38];
$mots_lv0021->ArrPush[1]=$vLangArr1[18];
$mots_lv0021->ArrPush[2]=$vLangArr1[19];
$mots_lv0021->ArrPush[3]=$vLangArr1[20];
$mots_lv0021->ArrPush[4]=$vLangArr1[21];
$mots_lv0021->ArrPush[5]=$vLangArr1[22];
$mots_lv0021->ArrPush[6]=$vLangArr1[23];
$mots_lv0021->ArrPush[7]=$vLangArr1[24];
$mots_lv0021->ArrPush[8]=$vLangArr1[25];
$mots_lv0021->ArrPush[9]=$vLangArr1[26];
$mots_lv0021->ArrPush[10]=$vLangArr1[27];
$mots_lv0021->ArrPush[11]=$vLangArr1[28];
$mots_lv0021->ArrPush[12]=$vLangArr1[29];
$mots_lv0021->ArrPush[13]=$vLangArr1[40];
$mots_lv0021->ArrPush[14]=$vLangArr1[31];
$mots_lv0021->ArrPush[15]=$vLangArr1[32];
$vFieldList="lv001,lv004,lv005,lv012";
$strParent=$mots_lv0021->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vNow);
$strParent=str_replace("'","\'",$strParent);
$strParent=str_replace("
","",$strParent);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$mots_lv0021->Load($mots_lv0021->ID);
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
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('ts_lv0029/ts_lv0029exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value+'&lv003='+o.txtlv802.value,1);
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlv908amount.value=parseFloat(o.txtlv904.value*o.txtlv906.value*o.txtlv908.value/100);
		o.txtlv909amount.value=parseFloat(o.txtlv904.value*o.txtlv906.value*o.txtlv909.value/100);
		o.txtlvallamount.value=-parseFloat(o.txtlv909amount.value)+parseFloat(o.txtlv908amount.value)+parseFloat(o.txtlv904.value*o.txtlv906.value);
		
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
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>ts_lv0032/ts_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	}
	function Add()
	{
	var o=document.frmadd;
		if(o.txtlv913.value=="")
		{
			alert("Please! DeliveryDate is not empty.");
			o.txtlv913.focus();
		}
		else
		{
			var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv008="+o.txtlv908.value+"&txtlv009="+o.txtlv909.value+"&txtlv010="+o.txtlv910.value+"&txtlv011="+o.txtlv911.value+"&txtlv012="+o.txtlv912.value+"&txtlv013="+o.txtlv913.value+" "+o.txtlv913_.value+"&txtOpt=1";
			var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>ts_lv0032/ts_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
			div = document.getElementById('lvloaddata');
			div.innerHTML=str;
			o.txtlv903.focus();
		}
	}
	function Report(vValue)
	{
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>ts_lv0021?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	function LoadType(to)
	{

		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'BANHANG':
				LoadPopupParent(to,'txtlv806','sl_lv0013','concat(lv003,@! @!,lv002,@! @!,lv001)');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv806','sl_lv0013','concat(lv003,@! @!,lv002,@! @!,lv001)');
				break;
			case 'MUAHANG':
				LoadPopupParent(to,'txtlv806','ts_lv0021','lv003');
				break;
		}
	}
	-->
	</script>
</head>
<style>
table .tdpar
{
	border-bottom:1px #ececec solid;
	padding:5px;
}
table .tdpar input
{
	height:22px!important;
	width:100%;
}
table .tdpar select
{
	height:28px!important;
	width:100%;
}
table .tdpar textarea
{
	height:22px!important;
	width:100%;
}
</style>	
<?php
if($mots_lv0021->GetAdd()>0)
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
						<td class="tdpar" width="100%" align="center">
							<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" class="tbl">	
								<tr>
									<td class="tdpar" align="center">
										<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<?php if($vStrMessage!=""){ ?>
												<tr>
												  <td class="tdpar" height="20px" colspan="4" align="center"><font color="#3366CC"><?php echo $vStrMessage;?></font></td>
												</tr>
												<?php }?>
												<tr>
													<td class="tdpar" width="13%" height="20px" align="left"><?php echo $vLangArr[19];?></td>	
													<td class="tdpar" width="32%"><input name="txtlv801" type="text" id="txtlv801"  value="<?php echo ($mots_lv0021->lv001=="")?InsertWithCheckExt('ts_lv0021', 'lv001', 'PM',10):$mots_lv0021->lv001;?>" tabindex="3" maxlength="32" style="width:100%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
													<td class="tdpar" width="7%"></td>
													<td class="tdpar" width="13%" height="20px" align="left" valign="top"><?php echo $vLangArr[20];?></td>
													<td class="tdpar" width="32%">
                                                    <table width="100%;" style="border:0px">
                                                      <tr>
                                                        <td  width="50%">
															<select name="txtlv802" id="txtlv802"   tabindex="4"  style="width:100%" onkeypress="return CheckKeys(event,7,this)">
																<?php echo $mots_lv0021->LV_LinkField('lv002',$mots_lv0021->lv002);?>
															</select></td>
                                                        <td width="50%"><ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" xml:lang="pop-nav1">
                                                            <li class="menupopT">
                                                              <input type="text" autocomplete="off" class="search_img_btn" name="txtlv802_search" id="txtlv802_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv802','ts_lv0003','concat(lv002,@! - @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv802','ts_lv0003','concat(lv002,@! - @!,lv001)')" tabindex="200">
                                                              <div id="lv_popup" lang="lv_popup1" xml:lang="lv_popup1"> </div>
                                                            </li>
                                                        </ul></td>
                                                      </tr>
                                                    </table>
													</td>
													<td class="tdpar" width="7%"></td>
												</tr>
												<tr>
													<td class="tdpar" height="20px" align="left"><?php echo $vLangArr[21];?></td>
													<td height="20px" class="tdpar"><input name="txtlv803" type="text" id="txtlv803"  value="<?php echo $mots_lv0021->lv003;?>" tabindex="4" maxlength="225" style="width:100%" onKeyPress="return CheckKey(event,7)"/></td>		
													<td class="tdpar" width="7%"></td>
													<td class="tdpar"><?php echo $vLangArr[22];?></td>
													<td  class="tdpar"><input name="txtlv804" type="text" id="txtlv804" value="<?php echo $mots_lv0021->FormatView($mots_lv0021->lv004,2);?>" tabindex="5" maxlength="100" style="width:100%" onKeyPress="return CheckKey(event,7)" />
														</td><td class="tdpar" width="7%"><img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv804);return false;" /></td>
													
												</tr>
												<tr>
													<td class="tdpar" height="20px" align="left" valign="top"><?php echo $vLangArr[25];?></td>
													<td height="20px" class="tdpar"><label>
													  <select name="txtlv807" id="txtlv807"   tabindex="5"  style="width:100%" onkeypress="return CheckKey(event,7)"/>
												
                                                      <?php echo $mots_lv0021->LV_LinkField('lv007',$mots_lv0021->lv007);?>
                                                      </select>
													</label></td>
													<td class="tdpar" width="7%"></td>
												    <td height="20px" class="tdpar" ><?php echo $vLangArr[23];?></td>
													<td height="20px" class="tdpar"><input name="txtlv805" type="text" id="txtlv805" value="<?php echo $mots_lv0021->FormatView($mots_lv0021->lv005,2);?>" tabindex="5" maxlength="100" style="width:100%" onKeyPress="return CheckKey(event,7)" />
														<td class="tdpar" width="7%"><img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv805);return false;" /></td>
													
												</tr>
												
												<tr height="1">
													<td class="tdpar"><?php echo $vLangArr[26];?></td>
												    <td class="tdpar"><select name="txtlv808" id="txtlv808"   tabindex="6"  style="width:100%" onkeypress="return CheckKey(event,7)"/>
                                                      <?php echo $mots_lv0021->LV_LinkField('lv008',$mots_lv0021->lv008);?>
                                                    </select></td>
													<td class="tdpar" width="7%"></td>
												    <td class="tdpar" valign="top"><?php echo $vLangArr[24];?></td>
												    <td class="tdpar"><input name="txtlv806" type="text" id="txtlv806"  value="<?php echo (float)$mots_lv0021->lv006;?>" tabindex="7" maxlength="225" style="width:100%" onKeyPress="return CheckKey(event,7)"/></td>
													<td class="tdpar" width="3%"></td>
												</tr>												
												<tr height="1">
												  <td class="tdpar"><?php echo $vLangArr[27];?></td>
											      <td class="tdpar" colspan="4"><textarea name="textarea" rows="3" id="textarea" style="width:100%" tabindex="8" ><?php echo $mots_lv0021->lv007;?></textarea></td>
												  <td class="tdpar" width="3%"></td>
											  </tr>
												
												
												<tr height="1">
												  <td class="tdpar" colspan="6"><table border="0" cellpadding="0" cellspacing="0" width="100%">
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
                                                       <td width="100%" align="center" class="detail_title"><div ><div style="float:left"><?php echo $vLangArr[16];?></div><div style="float:right" ondblclick="this.innerHTML=''"><div style="right:50px;position:absolute;"><img id="txtimg_load_sp" name="txtimg_load_sp"  src="" border="0" height="90"/></div></div></div></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center">
													  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td class="tdpar" width="13%"><?php echo $vLangArr[31];?></td>
                                                          <td class="tdpar" width="25%">
														  <table border=0 cellpadding="0" cellspacing="0" width="100%"><tr><td width="50%"><div id="itemsgetid"><select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:100%;" onkeypress="return CheckKeys(event,1,this)" onBlur="LoadItem()" />
                                                          <?php echo $mots_lv0022->LV_LinkField('lv003',$mots_lv0022->lv003);?>
                                                            </select></div></td><td width="50%"><ul id="pop-nav4" lang="pop-nav4"  onkeyup="ChangeName(this,4)" onMouseOver="ChangeName(this,4)" xml:lang="pop-nav4">
                                                                    <li class="menupopT">
                                                                      <input type="text" autocomplete="off" class="search_img_btn" name="txtlv903_search" id="txtlv903_search" style="width:100%"  onKeyUp="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@!-@!,lv010,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@!-@!,lv010,@! @!,lv001)')" tabindex="200" class="search_img_btn"/>
                                                                      <div id="lv_popup4" lang="lv_popup4" xml:lang="lv_popup4"> </div>
                                                                    </li>
                                                                </ul></td></tr></table>
                                                            </td>
															<td class="tdpar" width="5%" ><td>
                                                          <td class="tdpar" width="13%"><?php echo $vLangArr[52];?></td>
														  <td class="tdpar"  width="25%">
														  <input name="txtlv913" type="text" id="txtlv913" value="<?php echo $mots_lv0021->FormatView($mots_lv0022->lv013,2);?>" tabindex="24" maxlength="100" style="width:56%" onKeyPress="return CheckKey(event,7)" />
														  <input   name="txtlv913_" type="text" id="txtlv913_" value="00:00:00" tabindex="20" maxlength="255" style="width:36%" onKeyPress="return CheckKey(event,7)"/>
														  
														  </td>
														  <td class="tdpar" width="5%"><img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv913);return false;" /></td>
															<td width="14%"></td>
                                                        </tr>
                                                        <tr>
															<td class="tdpar"><?php echo $vLangArr[32];?></td>
															<td class="tdpar"><input name="txtlv904" id="txtlv904"   onkeyup="CalculateM()"  onChange="CalculateM()"   tabindex="21"  style="width:100%" onKeyPress="return CheckKey(event,1)" value="<?php echo (float)$mots_lv0022->lv004;?>"/></td>
															<td class="tdpar" width="5%" ><td>
															<td class="tdpar"><?php echo $vLangArr[33];?></td>
															<td class="tdpar"><select name="txtlv905" id="txtlv905"   tabindex="9"  style="width:100%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $mots_lv0022->LV_LinkField('lv005',$mots_lv0022->lv005);?>
                                                            </select>
                                                            <br /></td>
															<td class="tdpar"></td>
                                                        </tr>
                                                        <tr>
															<td class="tdpar"><?php echo $vLangArr[34];?></td>
															<td class="tdpar"><input name="txtlv906" type="text" id="txtlv906"   onkeyup="CalculateM()"  onChange="CalculateM()"  value="<?php echo (float)$mots_lv0022->lv006;?>" tabindex="22" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,1)" /></td>
															<td class="tdpar" width="5%" ><td>
															<td class="tdpar"><?php echo $vLangArr[35];?></td>
															<td class="tdpar"><select name="txtlv907" id="txtlv907"   tabindex="11"  style="width:100%" onkeypress="return CheckKey(event,1)"/>
															<?php echo $mots_lv0022->LV_LinkField('lv007',$mots_lv0022->lv007);?>
															</select></td>
															<td class="tdpar"></td>
															<td class="tdpar"></td>
                                                        </tr>
                                                       
                                                        <tr>
                                                          <td class="tdpar"><?php echo $vLangArr[36];?></td>
                                                          <td class="tdpar"><input type="text" name="txtlv908" id="txtlv908"  onkeyup="CalculateM()"  onChange="CalculateM()" style="width:32%"  tabindex="23"  value="<?php echo (float)$mots_lv0022->lv008;?>" onKeyPress="return CheckKey(event,1)"> <input  name="txtlv908amount" type="text" id="txtlv908amount" readonly="true" style="width:63%;background:#cccccc;border:1px #999999 solid"></td>
                                                          <td class="tdpar" width="5%" ><td>
														  <td class="tdpar"><?php echo $vLangArr[37];?></td>
                                                          <td class="tdpar"><input type="text" name="txtlv909" id="txtlv909"  onkeyup="CalculateM()"  onChange="CalculateM()" tabindex="24"  style="width:32%" onKeyPress="return CheckKey(event,1)" value="<?php echo $mots_lv0022->lv009;?>">	<input  name="txtlv909amount" type="text" id="txtlv909amount" readonly="true" style="width:61%;background:#cccccc;border:1px #999999 solid">						 </td>
														  <td class="tdpar"></td>
														  <td class="tdpar"></td>
                                                        </tr>
                                                        <tr>
                                                          <td class="tdpar"><?php echo $vLangArr[38];?></td>
                                                          <td class="tdpar">
															<input  name="txtlv910" type="text" id="txtlv910" value="<?php echo $mots_lv0022->lv010;?>" tabindex="25" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,1)" /></td>
                                                          <td class="tdpar" width="5%" ><td>
														  <td class="tdpar"><?php echo $vLangArr[39];?></td>
                                                          <td class="tdpar"><input  name="txtlv911" type="text" id="txtlv911" value="<?php echo $mots_lv0022->lv011;?>" tabindex="26" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,1)" /></td>
														  <td class="tdpar"></td>
														  <td class="tdpar"></td>
                                                        </tr>
                                                        <tr>
                                                          <td class="tdpar"><?php echo $vLangArr[40];?></td>
                                                          <td class="tdpar" colspan="1"><input  name="txtlv912" type="text" id="txtlv912" value="<?php echo $mots_lv0022->lv012;?>" tabindex="26" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,1)" /></td>
                                                          <td class="tdpar" width="5%" ><td>
														  <td class="tdpar" ><?php echo $vLangArr[48];?></td><td><input  name="txtlvallamount" type="text" id="txtlvallamount" readonly="true" style="width:100%;background:#cccccc;border:1px #999999 solid"></td>
														  <td class="tdpar"></td>
														  <td class="tdpar"></td>
                                                        </tr>
                                                      </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td><img border="0" title="<?php echo $vLangArr[35];?>" class="imgButton" onClick="Add()" onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add_02<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" src="<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg" tabindex="8" onKeyPress="return CheckKey(event,11)"/></td>
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
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="26"/>
<?php
}
?>															
														<img type="image" class="btAdd" name="back" onClick="Back();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[5];?>" tabindex="27" onKeyUp="return loadkey(event,2)"/></td>
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
												<tr height="1"><td class="tdpar" colspan="6">
												<div id="lvloaddata"></div></td>
												</tr>
												<tr>
													<td class="tdpar" align="center" colspan="4">
<?php
$isRun=1;
if($isRun==1)
{
?>														
														<img type="image" class="btAdd" name="save" onClick="Save();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="26"/>
<?php
}
?>															
														<img type="image" class="btAdd" name="back" onClick="Back();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[5];?>" tabindex="27" onKeyUp="return loadkey(event,2)"/></td>
												</tr>
												<tr><td class="tdpar" height="20px" colspan="4" align="center">&nbsp;</td>
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
document.frmadd.txtlv903.focus();
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[54];?>';
div2 = document.getElementById('lv_right_titlelist');
div2.innerHTML='<?php echo $strParent;?>';
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>