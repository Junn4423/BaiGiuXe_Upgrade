<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ts_lv0021.php");
require_once("$vDir../clsall/ts_lv0022.php");
require_once("$vDir../clsall/ts_lv0025.php");
require_once("$vDir../clsall/ts_lv0051.php");
////////init object////////////////////
	$mots_lv0021=new ts_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0021');
	$mots_lv0022=new ts_lv0022($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0022');
	$mots_lv0025=new ts_lv0025($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0025');
	
if(isset($_GET['ajax']))
{
	if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TS0031.txt",$plang);

	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$mots_lv0025->ArrPush[0]=$vLangArr[17];
	$mots_lv0025->ArrPush[1]=$vLangArr[18];
	$mots_lv0025->ArrPush[2]=$vLangArr[20];
	$mots_lv0025->ArrPush[3]=$vLangArr[21];
	$mots_lv0025->ArrPush[4]=$vLangArr[22];
	$mots_lv0025->ArrPush[5]=$vLangArr[23];
	$mots_lv0025->ArrPush[6]=$vLangArr[24];
	$mots_lv0025->ArrPush[7]=$vLangArr[25];
	$mots_lv0025->ArrPush[8]=$vLangArr[26];
	$mots_lv0025->ArrPush[9]=$vLangArr[27];
	$mots_lv0025->ArrPush[10]=$vLangArr[28];
	$mots_lv0025->ArrPush[11]=$vLangArr[29];
	$mots_lv0025->ArrPush[12]=$vLangArr[30];
	$mots_lv0025->ArrPush[13]=$vLangArr[38];
	$mots_lv0025->ArrPush[14]=$vLangArr[39];
	$mots_lv0025->ArrPush[15]=$vLangArr[41];
	$mots_lv0025->ArrPush[16]=$vLangArr[40];
	echo '[CHECK]';
	$vitemid=$_GET['itemid'];
	$vFieldList="lv002,lv009,lv012,lv013,lv014,lv015";
	$strParent=$mots_lv0025->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vitemid);
	echo $strParent;
	echo '[ENDCHECK]';
	echo '[CHECKITEM]';
	if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TS0026.txt",$plang);
	$mots_lv0022->lang=strtoupper($plang);
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$mots_lv0022->ArrPush[0]=$vLangArr[17];
	$mots_lv0022->ArrPush[1]=$vLangArr[18];
	$mots_lv0022->ArrPush[2]=$vLangArr[19];
	$mots_lv0022->ArrPush[3]=$vLangArr[20];
	$mots_lv0022->ArrPush[4]=$vLangArr[21];
	$mots_lv0022->ArrPush[5]=$vLangArr[22];
	$mots_lv0022->ArrPush[6]=$vLangArr[23];
	$mots_lv0022->ArrPush[7]=$vLangArr[24];
	$mots_lv0022->ArrPush[8]=$vLangArr[25];
	$mots_lv0022->ArrPush[9]=$vLangArr[26];
	$mots_lv0022->ArrPush[10]=$vLangArr[27];
	$mots_lv0022->ArrPush[11]=$vLangArr[28];
	$mots_lv0022->ArrPush[12]=$vLangArr[29];
	$mots_lv0022->ArrPush[13]=$vLangArr[30];
	$mots_lv0022->ArrPush[14]=$vLangArr[41];
	$mots_lv0022->ArrPush[15]=$vLangArr[42];
	$mots_lv0022->ArrPush[16]=$vLangArr[38];
	$mots_lv0022->ArrPush[17]=$vLangArr[44];
	$mots_lv0022->ArrPush[18]=$vLangArr[45];
	$vFieldList="lv002,lv006,lv008,lv009,lv013,lv015,lv016,lv017";
	$strParent1=$mots_lv0022->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vitemid);
	echo $strParent1;
	echo '[ENDCHECKITEM]';
	exit;
}		
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TS0039.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//LÃ¡ÂºÂ¥y mÃƒÂ£ phiÃ¡ÂºÂ¿u nhÃ¡ÂºÂ­p kho
$isExists = 0;//$mots_lv0021->LV_Exist($mots_lv0021->lv001);
if($flagCtrl == 1){
$mots_lv0021->lv011=0;
	$vStrMessage = "";
	$mots_lv0051=new ts_lv0051($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0051');
	$vResult=$mots_lv0051->LV_LoadSup(getInfor($_SESSION['ERPSOFV2RUserID'],2));
	while($vrow=db_fetch_array($vResult))
	{
		$mots_lv0021->lv001=InsertWithCheck('ts_lv0021', 'lv001', 'PM-'.getmonth($vNow)."/".getyear($vNow)."-",1);
		$mots_lv0021->lv002=$vrow['SupplierID'];
		$mots_lv0021->lv003="AUTO CREATE PO";
		$mots_lv0021->lv010=getInfor($_SESSION['ERPSOFV2RUserID'],2);
		$mots_lv0021->lv005=$mots_lv0021->FormatView($vrow['DeliveryDate'],2);
		$mots_lv0021->lv004=$mots_lv0021->FormatView($vNow,2);
		$bResultI = $mots_lv0021->LV_InsertTemp();
		if($bResultI == true){
			$mots_lv0022->LV_InsertTempPOCP($mots_lv0021->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2),$mots_lv0021->lv002);
			$vStrMessage = $vLangArr[51];
			$flagCtrl = 1;
		} else{
			$vStrMessage = $vLangArr[8].sof_error();
			$flagCtrl = 0;
		}
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
	#ls_spncc
	{
	  height: 85px;
	  width: 100%; 
	  display: block;
	  border: 1px solid #000;
	  background:#fff;
	  margin: 0px;
	  padding:0px;
	 overflow:auto;
	 position:absolute;
		top:0px;
	 
	}
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
				o.txtFlag.value="1";
				o.submit();
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('ts_lv0047/ts_lv0047exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value,1);		
		changeitem_change(document.frmadd.txtlv903.value);
	}
	function CalMaterials()
	{
		var o=document.frmadd;
		if(o.txtlv913.value=="")
		{
			alert("Please! DeliveryDate is not empty!");
			o.txtlv913.focus();
			return;
		}
		
		var lv914=o.txtlv914.value;
		var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv012="+o.txtlv912.value+"&txtlv013="+o.txtlv913.value+" "+o.txtlv913_.value+"&txtlv014="+lv914+"&txtOpt=2";
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>ts_lv0051/ts_lv0051.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
		div = document.getElementById('lvloaddata');
		div.innerHTML=str;
		o.txtlv903.focus();
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlvallamount.value=parseFloat(o.txtlv904.value*o.txtlv906.value);
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
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>ts_lv0051/ts_lv0051.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
		div = document.getElementById('lvloaddata');
		div.innerHTML=str;
	}
	function Add()
	{
		var o=document.frmadd;
		var lv914=o.txtlv914.value;
		if(parseFloat(o.txtlv904.value)==0)
		{
			alert("Please! Quanity is not zero!");
			o.txtlv904.focus();
		}
		else if(lv914=="")
		{
			alert("Please! Choose Supplier to Buy");
			lv914.focus();
		}		
		else if(o.txtlv913.value=="")
		{
			alert("Please! DeliveryDate is not empty!");
			o.txtlv913.focus();
		}
		else			
		{	
			var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv012="+o.txtlv912.value+"&txtlv013="+o.txtlv913.value+" "+o.txtlv913_.value+"&txtlv014="+lv914+"&txtOpt=1";
			var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>ts_lv0051/ts_lv0051.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
			div = document.getElementById('lvloaddata');
			div.innerHTML=str;
			o.txtlv903.focus();
		}
	}
	function setemptyradio()
	{
		var o=document.frmadd;
		var radioObj=o.txtlv9141;
		 if(!radioObj) return;
		 var radioLength = radioObj.length;
			if(radioLength == undefined){
			if(radioObj.checked==true) radioObj.checked=false;
				return "";
			}
			for(var i = 0; i < radioLength; i++) {
				if(radioObj[i].checked) {
					radioObj[i].checked=false;
				}
			}
		 
	}
	function getCheckedValue(radioObj) {
		if(!radioObj)
		{
			var o=document.frmadd;
			return o.txtlv914.value;
		}
		var radioLength = radioObj.length;
		var flag=false;
		if(radioLength == undefined)	return radioObj.value;
		if(radioObj.value== undefined)
		{
			var o=document.frmadd;
			 return o.txtlv914.value;
		}
		for(var i = 0; i < radioLength; i++) {
			if(radioObj[i].checked) {
				return radioObj[i].value;
			}
		}
		return "";
	}
	function Report(vValue)
	{
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>ts_lv0021?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	function set_pricencc(price,tax,discount,note)
	{
		var o=document.frmadd;
		CalculateM();
	}
	function set_pricenccs(price,tax,discount,note,ncc)
	{
		var o=document.frmadd;

		CalculateM();
	}
	function changeheight(o)
	{
		if(o.style.height=="")
			o.style.height="300px";
		else
			o.style.height="";
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
						<td class="td" width="100%" align="center">
							<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" class="tbl">	
								<tr>
									<td class="td" align="center">
										<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<?php if($vStrMessage!=""){ ?>
												<tr>
												  <td class="td" height="20px" colspan="4" align="center"><font color="#3366CC"><?php echo $vStrMessage;?></font></td>
												</tr>
												<?php }?>
											
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
                                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                       <!--  <tr>
                                                          <td style="line-height:30px;padding-bottom:5px;" colspan="4"><span onclick="CalMaterials()" style="cursor:pointer;padding:5px;font:bold 14px Arial"><img src="../images/icon/cal.png"/><?php echo $vLangArr[56];?></span></td>
                                                        </tr>-->
														<tr>
                                                          <td class="tdpar" width="13%"><?php echo $vLangArr[31];?></td>
                                                          <td class="tdpar" width="34%"><table border=0 cellpadding="0" cellspacing="0" width="100%"><tr><td width="40%"><div id="itemsgetid"><select name="txtlv903" id="txtlv903"   tabindex="19"  style="width:100%;" onkeypress="return CheckKeys(event,1,this)" onBlur="LoadItem()"  />
                                                          <?php echo $mots_lv0022->LV_LinkField('lv003',$mots_lv0022->lv003);?>
                                                            </select></div></td><td width="40%"><ul id="pop-nav" lang="pop-nav1"  onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" xml:lang="pop-nav1">
                                                                    <li class="menupopT">
                                                                      <input type="text" autocomplete="off" class="search_img_btn" name="txtlv903_search" id="txtlv903_search" style="width:100%"  onKeyUp="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@!-@!,lv010,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@!-@!,lv010,@! @!,lv001)')" tabindex="200" class="search_img_btn"/>
                                                                      <div id="lv_popup" lang="lv_popup1" xml:lang="lv_popup1"> </div>
                                                                    </li>
                                                                </ul></td><td width="20%" align="center"><div style="position:relative;" onmouseover="document.getElementById('viewhistory').style.display='block';" onmouseout="document.getElementById('viewhistory').style.display='none';"><img src="../images/lvicon/recent_m.png" border="0"/><div id="viewhistory" style="position:absolute;display:none;overflow:hidden;left:0px;background:#eee;z-index:99999">Empty</div></div></td></tr></table>
                                                            </td>
                                                          <td class="tdpar" colspan="2" rowspan="4"><div style="height:90px;width:100%;position:relative"><div id="ls_spncc" ondblclick="changeheight(this)"></div>
                                                          </div></td>
                                                          <!--  <td align="right" style="postion:relative"><div style="postion:relative;width:50%px;"><img id="txtimg_load_sp" name="txtimg_load_sp" style="right:50px;position:absolute;" src="http://thegioithietbilanh.vn/wp-content/plugins/load_products_content_trangchu/images/loading.gif" border="0" height="50"/></div></td>-->
                                                        </tr>
                                                        <tr>
                                                          <td class="tdpar"><?php echo $vLangArr[32];?></td>
                                                          <td class="tdpar"><input name="txtlv904" id="txtlv904"   onkeyup="CalculateM()"  onChange="CalculateM()"   tabindex="20"  style="width:40%" onKeyPress="return CheckKey(event,1)" value="<?php echo (float)$mots_lv0022->lv004;?>"/>
                                                          <select name="txtlv905" id="txtlv905"   tabindex="9"  style="width:40%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $mots_lv0022->LV_LinkField('lv005',$mots_lv0022->lv005);?>
                                                            </select>
                                                           </td>
                                                        </tr>
                                                        <tr>
                                                          <td class="tdpar"><?php echo $vLangArr[34];?></td>
                                                          <td class="tdpar"><input name="txtlv906" type="text" id="txtlv906"   onkeyup="CalculateM()"  onChange="CalculateM()"  value="<?php echo (float)$mots_lv0022->lv006;?>" tabindex="22" maxlength="255" style="width:40%" onKeyPress="return CheckKey(event,1)" />
                                                          <select name="txtlv907" id="txtlv907"   tabindex="11"  style="width:40%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $mots_lv0022->LV_LinkField('lv007',$mots_lv0022->lv007);?>
                                                            </select></td>
                                                        </tr>
                                                         <tr>
                                                        <td class="tdpar"><?php echo $vLangArr[52];?></td>
                                                        <td class="tdpar"> <input name="txtlv913" type="text" id="txtlv913" value="<?php echo $mots_lv0021->FormatView($mots_lv0022->lv013,2);?>" tabindex="24" maxlength="100" style="width:46%" onKeyPress="return CheckKey(event,7)" />
														  <input   name="txtlv913_" type="text" id="txtlv913_" value="00:00:00" tabindex="20" maxlength="255" style="width:30%" onKeyPress="return CheckKey(event,7)"/>
                                                    <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv913);return false;" /></td>												
                                                        </tr>
                                                        <tr>
                                                          <td class="tdpar"><?php echo $vLangArr[40];?></td>
                                                          <td class="tdpar" colspan="1"><input  name="txtlv912" type="text" id="txtlv912" value="<?php echo $mots_lv0022->lv012;?>" tabindex="26" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                           <td class="tdpar" ><?php echo $vLangArr[48];?></td><td  class="tdpar"><input  name="txtlvallamount" type="text" id="txtlvallamount" readonly="true" style="width:80%;background:#cccccc;border:1px #999999 solid"></td>
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
document.frmadd.txtlv903.focus();
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[55];?>';
div2 = document.getElementById('lv_right_titlelist');
div2.innerHTML='<?php echo $strParent;?>';
</script>
<script language="javascript">
changeitem_change(document.frmadd.txtlv903.value);
function changeitem_change(value)
		{
			$xmlhttp=null;
			if(value=="") 
			{
				alert("Please! Item is not empty!");
				return false;
			}
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajax=ajaxcheck"+"&itemid="+value;
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
				document.getElementById('ls_spncc').innerHTML=domainid;
				var startdomain1=xmlhttp.responseText.indexOf('[CHECKITEM]')+11;
				var enddomain1=xmlhttp.responseText.indexOf('[ENDCHECKITEM]');
				var domainid1=xmlhttp.responseText.substr(startdomain1,enddomain1-startdomain1);
				document.getElementById('viewhistory').innerHTML=domainid1;
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