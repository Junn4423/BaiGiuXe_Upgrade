<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ts_lv0010.php");
require_once("$vDir../clsall/ts_lv0011.php");
require_once("$vDir../clsall/ts_lv0020.php");
require_once("$vDir../clsall/wb_lv0006.php");	
////////init object////////////////////
	$mots_lv0010=new ts_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0010');
	$mots_lv0011=new ts_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0011');
	//$mowb_lv0006=new wb_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wb0011');
	//$mots_lv0011->obj_wb_lv0006=$mowb_lv0006;
if(isset($_GET['ajax']))
{
	$vwarehouseid=$_GET['warehouseid'];
	echo '[CHECK]';
	echo '<select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:100%" onkeyup="search_item(event)"  onkeypress="return CheckKeys(event,1,this)" onBlur="LoadItem()"/>';//.$mots_lv0011->LV_LinkFieldExt('lv003',$vwarehouseid).'</select>	';
	echo '[ENDCHECK]';
	exit;
}	
if(isset($_GET['ajaxptxk']))
{
	$ptxkid=$_GET['ptxkid'];
	$vwhid=$_GET['whid'];
	echo '[PTXKCHECK]';
	switch($ptxkid)
	{
		case 'NOIBO':
			echo '<select name="txtlv811" id="txtlv811"   tabindex="6"  style="width:100%" onkeyup="search_item(event)"  onkeypress="return CheckKeys(event,1,this)"  ><option value="">..Chọn thủ kho..</option>'.$mots_lv0010->LV_LinkField('lv911',$vwhid).'</select>	';
			break;
		default:
			echo '<select name="txtlv811" id="txtlv811"   tabindex="6"  style="width:100%" onkeyup="search_item(event)"  onkeypress="return CheckKeys(event,1,this)"  ><option value="">..Chọn thủ kho..</option>'.$mots_lv0010->LV_LinkField('lv011','').'</select>	';
			break;
	}
	echo '[ENDPTXKCHECK]';
	exit;
}
if(isset($_GET['ajaxlot']))
{
	$mots_lv0011=new ts_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0011');
	$mots_lv0020=new ts_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0020');
	$mots_lv0011->objlot=$mots_lv0020;
	$mots_lv0011->lang=$plang;
	$mots_lv0011->objlot->lv003=$_GET['whid'];
	echo '[CHECKLOT]';
	$strLot=$mots_lv0011->LV_LinkField('lv014',$_GET['itemid']);
	if($strLot!="")
	{
		echo '<select name="txtlv914" id="txtlv914"   tabindex="22"  style="width:100%" onkeypress="return CheckKeys(event,1,this)" ><option value="">...Chọn lô</option>'.$strLot.'</select>	';
	}
	else
		{
		echo '<input  name="txtlv914" type="text" id="txtlv914" value="" tabindex="23" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,1,this)" />';
		}
	echo '[ENDCHECKLOT]';
	exit;
}	
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TS0038.txt",$plang);
	$vLangArr1=GetLangFile("$vDir../","TS0015.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//Lấy mã phiếu nhập kho
$mots_lv0010->lv001=InsertWithCheckFist('ts_lv0010', 'lv001', '/XKVT/MP'.substr(getyear($vNow),-2,2),5);
//$mots_lv0010->lv001=InsertWithCheck('ts_lv0010', 'lv001', 'PX-'.getmonth($vNow)."/".getyear($vNow)."-",4);
$isExists = 0;//$mots_lv0010->LV_Exist($mots_lv0010->lv001);
$mots_lv0010->lv009=$_POST['txtlv809'];
$mots_lv0010->lv009=($mots_lv0010->lv009=="")?$vNow:$mots_lv0010->lv009;
if($mots_lv0010->lv002=="" || $mots_lv0010->lv002==NULL) $mots_lv0010->lv002="CAPPHAT";
if($mots_lv0010->lv099=="" || $mots_lv0010->lv099==NULL) $mots_lv0010->lv099="KHOVATTU";
if($mots_lv0010->lv010=="" || $mots_lv0010->lv010==NULL) $mots_lv0010->lv010="NOIBO";
$mots_lv0011->lv006=($mots_lv0011->lv006=="")?$vNow:$mots_lv0011->lv006;
$mots_lv0011->lv005=($mots_lv0011->lv005=="")?'PHONGBAN':$mots_lv0011->lv005;
if($flagCtrl == 1){	
$mots_lv0010->lv002=$_POST['txtlv802'];
$mots_lv0010->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$vKQ1=$mots_lv0010->LV_CheckCountDetail();	
if($vKQ1)
{
	$vKQ=$mots_lv0010->LV_CheckDetail($mots_lv0010->lv003,$mots_lv0010->lv002,$vNow,$vKQMsg);
	if($vKQ)
	{
	$mots_lv0010->lv004=$_POST['txtlv804'];
	$mots_lv0010->lv005=$_POST['txtlv805'];
	$mots_lv0010->lv006=$_POST['txtlv806'];
	$mots_lv0010->lv007=0;	
	$mots_lv0010->lv008=$_POST['txtlv808'];
	$mots_lv0010->lv011=$_POST['txtlv811'];
	$mots_lv0010->lv010=$_POST['txtlv810'];
	$mots_lv0010->lv099=$_POST['txtlv899'];
		$vStrMessage = "";
		if((int)$isExists==0){
			$bResultI = $mots_lv0010->LV_InsertTemp();
			if($bResultI == true){
				$mots_lv0011->LV_InsertTemp($mots_lv0010->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2));
				$vStrMessage = $vLangArr[13];
				$flagCtrl = 1;
				$mots_lv0010->lv001="";
			} else{
				$vStrMessage = sof_error();
				$flagCtrl = 0;
			}
		} else if((int)$isExists>=1 && (int)$mots_lv0011->lv007==0){
				$mots_lv0010->LV_Update();
				$mots_lv0011->LV_InsertTemp($mots_lv0010->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2));	
				$vStrMessage = $vLangArr[9];
				$flagCtrl = 1;
		}
	}
	else
	{
		$vStrMessage="<font color='red'>PHIẾU NÀY KHÔNG LƯU ĐƯỢC:<br/>".$vKQMsg.'</font>';
	}
}
else
{
	$mots_lv0010->lv009=recoverdate($mots_lv0010->lv009,$plang);
	$vKQMsg='Do chưa nhập chi tiết';
	$vStrMessage="<font color='red'>PHIẾU NÀY KHÔNG LƯU ĐƯỢC: ".$vKQMsg.'</font>';
}
}
$mots_lv0010->ArrPush[0]=$vLangArr1[17];
$mots_lv0010->ArrPush[1]=$vLangArr1[18];
$mots_lv0010->ArrPush[2]=$vLangArr1[19];
$mots_lv0010->ArrPush[3]=$vLangArr1[20];
$mots_lv0010->ArrPush[4]=$vLangArr1[21];
$mots_lv0010->ArrPush[5]=$vLangArr1[22];
$mots_lv0010->ArrPush[6]=$vLangArr1[23];
$mots_lv0010->ArrPush[7]=$vLangArr1[24];
$mots_lv0010->ArrPush[8]=$vLangArr1[25];
$mots_lv0010->ArrPush[9]=$vLangArr1[26];
$mots_lv0010->ArrPush[10]=$vLangArr1[27];
$mots_lv0010->ArrPush[11]=$vLangArr1[40];
$mots_lv0010->ArrPush[12]=$vLangArr1[41];
$mots_lv0010->ArrPush[13]=$vLangArr1[42];
$vFieldList="lv001,lv004,lv005,lv006,lv011,lv012";
$strParent=$mots_lv0010->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vNow);
$strParent=str_replace("'","\'",$strParent);
$strParent=str_replace("
","",$strParent);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$mots_lv0010->Load($mots_lv0010->ID);
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
			alert("<?php echo 'Xin vui lòng chọn kho để lưu';?>");
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
		var o=document.frmadd;
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>ts_lv0031/ts_lv0031.php?&WHID="+o.txtlv802.value+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	document.frmadd.txtlv903.focus();
	}
	function Add()
	{
	var o=document.frmadd;
	var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv008="+o.txtlv908.value+"&txtlv014="+o.txtlv914.value+"&txtlv015="+o.txtlv915.value+"&WHID="+o.txtlv802.value+"&txtlv999="+o.txtlv999.value+"&txtOpt=1";
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>ts_lv0031/ts_lv0031.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	o.txtlv903.select();
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
			case 'KIEMKHO':
				LoadPopupParent(to,'txtlv806','ts_lv0004','concat(lv005,@! @!,lv002,@! @!,lv001)');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv806','sl_lv0013','concat(lv003,@! @!,lv002,@! @!,lv001)');
				break;
			case 'MUAHANG':
				LoadPopupParent(to,'txtlv806','ts_lv0021','lv003');
				break;
			case 'PHONGBAN':
				LoadPopupParent(to,'txtlv806','hr_lv0002','concat(lv003,@! - @!,lv001)');
				break;
			case 'NHAPKHO':
				LoadPopupParent(to,'txtlv806','ts_lv0008','concat(lv001,@! - @!,lv002,@! @!,lv006)');
				break;
			case 'WEBTRANSAC':
				LoadPopupParentSecond(to,'txtlv806','wb_lv0016','concat(lv002,@! @!,lv005,@! @!,lv009,@! @!,lv015,@! =@!,lv001)');
				break;
			case 'CUS':
				LoadPopupParent(to,'txtlv806','sl_lv0001','concat(lv002,@! - @!,lv001)');
				break;
		}
	}
	function LoadSource()
	{
	var o=document.frmadd;
	var vo=o.txtlv805.value;
		switch(vo)
		{
		case 'BANHANG':
			ajax_do ('ts_lv0028/ts_lv0028excesource.php?&lang=<?php echo $plang;?>&Type=BANHANG&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
			window.setTimeout('RunFunction()',500);
			break;
		case 'TRAHANG':
			ajax_do ('ts_lv0028/ts_lv0028excesource.php?&lang=<?php echo $plang;?>&Type=TRAHANG&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
			window.setTimeout('RunFunction()',500);
			break;
		case 'MUAHANG':
			ajax_do ('ts_lv0028/ts_lv0028excesource.php?&lang=<?php echo $plang;?>&Type=MUAHANG&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
			window.setTimeout('RunFunction()',500);
			break;
		case 'NHAPKHO':
			ajax_do ('ts_lv0028/ts_lv0028excesource.php?&lang=<?php echo $plang;?>&Type=NHAPKHO&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
			window.setTimeout('RunFunction()',500);
			break;
		case 'WEBTRANSAC':
			ajax_do ('ts_lv0028/ts_lv0028excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv006='+o.txtlv806.value,1);
			window.setTimeout('RunFunction()',500);
			break;
		}		
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlv911amount.value=parseFloat(o.txtlv904.value*o.txtlv908.value*o.txtlv911.value/100);
		o.txtlv910amount.value=parseFloat(o.txtlv904.value*o.txtlv908.value*o.txtlv910.value/100);
		o.txtlvallamount.value=-parseFloat(o.txtlv911amount.value)+parseFloat(o.txtlv910amount.value)+parseFloat(o.txtlv904.value*o.txtlv908.value);
	}
	function RunNextItem()
	{
		LoadItem();
		document.frmadd.txtlv904.select();
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('ts_lv0028/ts_lv0028exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value+'&lv003='+o.txtlv802.value,1);
		changeitemlot_change(o.txtlv903.value,o.txtlv802.value);
	}
	function Report(vValue)
	{
	var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>ts_lv0010?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	-->
	</script>
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
</head>
<?php
if($mots_lv0010->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
		<tr height="*">
			<td>&nbsp;</td>
			<td width="100%" align="center">
				<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
					<tr><td class="td" colspan="3">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="td" width="100%" align="center">
							<table cellspacing="0" cellpadding="0" border="0" id=lvtoolbar cellSpacing=0 cellPadding=0 border=0 width="100%">
								<TBODY>
								<TR vAlign=center align=middle class="linetr">
									<TD width="1%" nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="47"><img height="20" src="../images/controlright/save_f2.png" 
									alt="Save" title="Save" 
									name="save" border="0" align="middle" id="save" /> </a></TD>
									<td width="1%" nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="47">LƯU</a></td>
								<!--<TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:OpenMailText('<?php echo $plang;?>');" tabindex="48"><img src="../images/controlright/information.gif" 
									alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
									border="0" align="middle" id="cancel" /><?php echo 'Close';?></a></TD>
								<TD nowrap="nowrap"><a class=lvtoolbar 
									href="javascript:RefreshMain();" tabindex="49"><img title="<?php echo $vLangArr[5];?>" 
									alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
									name=remove> <?php echo 'Reresh';?></a></TD>-->
									<td width="*"><h2>TRẢ VẬT TƯ TỪ NHÂN VIÊN</h2></td>
									</TR>
								</TBODY>
							</TABLE> 
							<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" class="tbl">	
								<tr>
									<td class="td" align="center">
										<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<?php if($vStrMessage!=""){ ?>
												<tr>
												  <td class="td" height="20px" colspan="6" align="center"><font color="#3366CC"><?php echo $vStrMessage;?></font></td>
												</tr>
												<?php }?>
												<tr>
													
													<td class="tdpar" height="20px" align="left" width="105"><?php echo $vLangArr[20];?></td>
													<td class="tdpar">
														<select name="txtlv802" id="txtlv802"   tabindex="2"  onkeypress="return CheckKey(event,7)"  onchange="changewarehourse_change(this.value)">
														<?php echo $mots_lv0010->LV_LinkField('lv002',$mots_lv0010->lv002);?>
														</select>
													</td>
													<td class="tdpar" width="150"></td>
													<td class="tdpar" height="20px" align="left" width="95"><?php echo $vLangArr[22];?></td>
													<td height="20px" class="tdpar"><input name="txtlv804" type="text" id="txtlv804"  value="<?php echo $mots_lv0010->lv004;?>"  maxlength="225" onKeyPress="return CheckKey(event,7)"/></td>		
													<td class="tdpar"><input title="<?php echo $vLangArr[19];?>" name="txtlv801" type="text" id="txtlv801"  value="<?php echo $mots_lv0010->lv001;?>" maxlength="32" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
												</tr>
												<tr>
													<td class="tdpar"><?php echo $vLangArr[27];?></td>	
													<td class="tdpar">
														<input name="txtlv809" type="text" id="txtlv809" value="<?php echo $mots_lv0010->FormatView($mots_lv0010->lv009,2);?>" tabindex="3" maxlength="100" onKeyPress="return CheckKey(event,7)"/>
													</td>
													<td class="tdpar">
														<img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv809);return false;" /> <span style="padding:5px">&nbsp;Xuất đến kho <font color="red"> &#8595;</font></span>
                                                    </td>
													<td class="tdpar"><?php echo $vLangArr[26];?></td>
												    <td colspan="3" class="tdpar"><textarea name="txtlv808" rows="3" id="txtlv808" tabindex="10" ><?php echo $mots_lv0010->lv008;?></textarea></td>
												</tr>
												
												<tr>
													<td class="tdpar" height="20px" align="left"><?php echo $vLangArr1[40];?></td>
													<td height="20px" class="tdpar">
													  <select name="txtlv810" id="txtlv810"   tabindex="4"  style="width:100%" onkeypress="return CheckKey(event,7)" onchange="changeptxk_change(this.value)"/>
                                                      <?php echo $mots_lv0010->LV_LinkField('lv010',$mots_lv0010->lv010);?>
                                                      </select>
													</td>
													<td height="20px" class="tdpar">  
													  <select name="txtlv899" id="txtlv899"   tabindex="5"  style="width:100%" onkeypress="return CheckKey(event,7)" onchange="changekho_change(this.value)"/>
                                                      <?php echo $mots_lv0010->LV_LinkField('lv099',$mots_lv0010->lv099);?>
                                                      </select>
													
													</td>
												    <td height="20px" class="tdpar" ><?php echo $vLangArr1[41];?></td>
												    <td height="20px" class="tdpar">
														<div style="width:100%" id="ptxkgetid">
															<select name="txtlv811" id="txtlv811"   tabindex="6"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
																<option value=""></option>
																<?php echo $mots_lv0010->LV_LinkField('lv011',$mots_lv0010->lv011);?>
															</select>
														</div>
													</td>                                                          
                                                    <td height="20px" class="tdpar">
														<ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" xml:lang="pop-nav5">
                                                            <li class="menupopT">
																<input type="text" autocomplete="off" class="search_img_btn" name="txtlv811_search" id="txtlv811_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv811','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@!-@!,lv001)')" onFocus="LoadPopupParent(this,'txtlv811','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200">
																<div id="lv_popup5" lang="lv_popup5" xml:lang="lv_popup5"> </div>
                                                            </li>
                                                        </ul>
													</td>
												</tr>
												<tr>
													<td class="tdpar" height="20px" align="left"><?php echo $vLangArr[23];?></td>
													<td height="20px" class="tdpar">
														<select name="txtlv805" id="txtlv805"   tabindex="7"  onkeypress="return CheckKey(event,7)"/>
														<?php echo $mots_lv0010->LV_LinkField('lv005',$mots_lv0010->lv005);?>
														</select>
													</td>
													<td height="20px" class="tdpar">
														<input type="button" tabindex="9" name="Load2" value="۩▲<?php echo ($plang=='VN')?'Lấy DL':'Get Data';?>" tabindex="20" onClick="LoadSource()" style="padding:3px;height:30px!important;width:80px;"> 
													</td>
												    <td height="20px" class="tdpar" ><?php echo $vLangArr[24];?></td>
												    <td height="20px" class="tdpar">
														<input name="txtlv806" type="text" id="txtlv806"  value="<?php echo $mots_lv0010->lv006;?>" tabindex="8" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"  readonly="true"/>
													</td>                                                          
                                                    <td height="20px" class="tdpar">
														<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" xml:lang="pop-nav3">
                                                              <li class="menupopT">
                                                                <input type="text" autocomplete="off" class="search_img_btn" name="txtlv806_search" id="txtlv806_search" style="width:100%" onKeyUp="LoadType(this)" onFocus="LoadType(this)" tabindex="200">
                                                                <div id="lv_popup" lang="lv_popup1" xml:lang="lv_popup1"> </div>
                                                              </li>
                                                          </ul>
													</td>
												</tr>
												<tr height="1">
												  <td class="td" colspan="6">&nbsp;</td>
												</tr>
												
												<tr height="1">
												  <td class="td" colspan="6"><table border="0" cellpadding="0" cellspacing="0" width="100%">
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
                                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
															<td class="tdpar"><?php echo $vLangArr[31];?></td>
															<td class="tdpar">
																<input tabindex="20" title="barcode hoặc mã sản phẩm" name="txtlv903" id="txtlv903"  style="width:100%;" onkeypress="return CheckKeys(event,9,this)" onBlur="LoadItem()" />
															</td>
                                                            <td class="tdpar">
																<ul id="pop-nav4" lang="pop-nav4" onkeyup="ChangeName(this,4)" onMouseOver="ChangeName(this,4)" xml:lang="pop-nav4">
                                                                    <li class="menupopT">
                                                                      <input type="text" autocomplete="off" class="search_img_btn" name="txtlv903_search" id="txtlv903_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@!-@!,lv010,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@!-@!,lv010,@! @!,lv001)')" tabindex="200">
                                                                      <div id="lv_popup4" lang="lv_popup4" xml:lang="lv_popup4"> </div>
                                                                    </li>
                                                                </ul>
															</td>
															<td class="tdpar"><?php echo ($plang=='VN')?'Kiểu xuất kho':'Type OutStock';?></td>
															<td class="tdpar">
																<select name="txtlv999" id="txtlv999" onkeypress="return CheckKey(event,1)"/>
																	<option value=""></option>
																	<?php echo $mots_lv0011->LV_LinkField('lv099',$mots_lv0011->lv099);?>
																</select>
															</td>
															<td class="tdpar" width="90">&nbsp;</td>
                                                        </tr>
														 <tr>
                                                         <td><?php echo $vLangArr[35];?></td>
                                                          <td><select name="txtlv907" id="txtlv907"   tabindex="11"  onkeypress="return CheckKey(event,1)"  style="width:100%" />
                                                            <option value=""></option>
															<?php echo $mots_lv0011->LV_LinkField('lv007',$mots_lv0011->lv007);?>
                                                            </select></td>
															<td class="tdpar"  width="80">
																<ul id="pop-nav8" lang="pop-nav8" onkeyup="ChangeName(this,8)" onMouseOver="ChangeName(this,8)" onkeyup="ChangeName(this,8)"> <li class="menupopT">
																  <input type="text" autocomplete="off" class="search_img_btn" name="txtlv907_search" id="txtlv907_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv907','hr_lv0020','concat(lv002,@! - @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv907','hr_lv0020','concat(lv002,@! - @!,lv001)')" tabindex="200" >
																  <div id="lv_popup8" lang="lv_popup8"> </div>						  
																	</li>
																</ul>
															</td>
															<td><?php echo $vLangArr[34];?></td>
                                                          <td><input name="txtlv906" type="text" id="txtlv906" value="<?php echo $mots_lv0010->FormatView($mots_lv0011->lv006,2);?>" tabindex="22" maxlength="255" onKeyPress="return CheckKey(event,1)"  style="width:100%" /></td>
                                                          <td class="tdpar">
																<img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="123" border="0" style="cursor:pointer" width="16" height="16" align="top" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv906);return false;" />
															</td>
                                                        </tr>
                                                        <tr>
															<td class="tdpar"><?php echo $vLangArr[32];?></td>
															<td class="tdpar"><input  name="txtlv904" id="txtlv904"   tabindex="21"  onKeyPress="return CheckKey(event,1)" value="<?php echo (float)$mots_lv0011->lv004;?>"/></td>
															<td class="tdpar">
																<select title="<?php echo $vLangArr[33];?>" name="txtlv905" id="txtlv905"     onkeypress="return CheckKey(event,1)"/>
																	<?php echo $mots_lv0011->LV_LinkField('lv005',$mots_lv0011->lv005);?>
																</select>
															</td>
															<td class="tdpar"><?php echo $vLangArr[36];?></td>
															<td class="tdpar">
																<table width="100%">
																	<tr>
																		<td width="70%">
																			<input onkeyup="CalculateM()"  onChange="CalculateM()" type="text" name="txtlv908" id="txtlv908"   tabindex="24"  value="<?php echo (float)$mots_lv0011->lv008;?>" onKeyPress="return CheckKey(event,1)">
																		</td>
																		<td width="30%">
																			<select title="<?php echo $vLangArr[37];?>" name="txtlv909" id="txtlv909"   onKeyPress="return CheckKey(event,1)"/>
																				<?php echo $mots_lv0011->LV_LinkField('lv009',$mots_lv0011->lv009);?>
																			</select>
																		</td>
																	</tr>
																</table>
															</td>
															<td class="tdpar">
																
															</td>
                                                        </tr>
                                                        <tr>
															<td class="tdpar">
																<?php echo $vLangArr[42];?>
															</td>
															<td class="tdpar">
																<div id="txtlotid"><input  name="txtlv914" type="text" id="txtlv914" value="<?php echo $mots_lv0011->lv014;?>" tabindex="23" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,1,this)" /></div>
															</td>
															<td class="tdpar">
															    <ul id="pop-nav7" lang="pop-nav7" onMouseOver="ChangeName(this,7)" onkeyup="ChangeName(this,7)"> <li class="menupopT">
																	<input type="text" autocomplete="off" class="search_img_btn" name="txtlv914_search" id="txtlv914_search" style="width:100%" onKeyUp="LoadPopupParentWHCondi(this,'txtlv914','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)',document.frmadd.txtlv802.value)" onFocus="LoadPopupParentWHCondi(this,'txtlv914','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)',document.frmadd.txtlv802.value)"  tabindex="200" >
																	<div id="lv_popup7" lang="lv_popup7"> </div>						  
																	</li>
													  			</ul>
													  		</td>
															<td class="tdpar"><?php echo $vLangArr[43];?></td>
															<td class="tdpar" colspan="2"><input  name="txtlv915" type="text" id="txtlv915" value="<?php echo $mots_lv0011->lv015;?>" tabindex="25" maxlength="255" onKeyPress="return CheckKey(event,1)" /></td>
                                                        </tr>
                                                        <!--<tr>
                                                          <td><?php echo $vLangArr[39];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()"  name="txtlv911" type="text" id="txtlv911" value="<?php echo (float)$mots_lv0011->lv011;?>" tabindex="26" maxlength="255" style="width:30%" onKeyPress="return CheckKey(event,1)" /><input  name="txtlv911amount" type="text" id="txtlv911amount" readonly="true" style="width:48%;background:#cccccc;border:1px #999999 solid"></td>
                                                          <td><?php echo $vLangArr[38];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()"  name="txtlv910" type="text" id="txtlv910" value="<?php echo (float)$mots_lv0011->lv010;?>" tabindex="14" maxlength="255" style="width:30%" onKeyPress="return CheckKey(event,1)" /><input  name="txtlv910amount" type="text" id="txtlv910amount" readonly="true" style="width:48%;background:#cccccc;border:1px #999999 solid"></td>
                                                        </tr>
														-->
                                                        <tr>
                                                        	<td colspan="2"><img border="0" title="<?php echo $vLangArr[35];?>" class="imgButton" onClick="Add()" tabindex="26"  onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add_02<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" src="<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg" onKeyPress="return CheckKey(event,11)"/></td>
                                                        <!--	<td ><?php echo $vLangArr[62];?></td><td><input  name="txtlvallamount" type="text" id="txtlvallamount" readonly="true" style="width:80%;background:#cccccc;border:1px #999999 solid"></td>-->
                                                        </tr>
													
                                                      </table></td>
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
												<tr height="1"><td class="td" colspan="6">
												<div id="lvloaddata"></div></td>
												</tr>
												<tr>
													<td class="td" align="center" colspan="6">
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
												<tr><td class="td" height="20px" colspan="6" align="center">&nbsp;</td>
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
div.innerHTML='<?php echo $vLangArr[64];?>';	
div2 = document.getElementById('lv_right_titlelist');
div2.innerHTML='<?php echo $strParent;?>';
</script>
<script language="javascript">
		changewarehourse_change(document.frmadd.txtlv802.value);
		changeptxk_change('');
		function changewarehourse_change(value)
		{
		return;	window.setTimeout('RunFunction()',100);
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
		function changekho_change(value)
		{
			$xmlhttp11=null;
			xmlhttp11=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxptxk=ajaxcheck"+"&ptxkid="+document.getElementById('txtlv810').value+'&whid='+value;
			url=url.replace("#","");
			xmlhttp11.onreadystatechange=stateChangedptxk;
			xmlhttp11.open("GET",url,true);
			xmlhttp11.send(null);
		}
		function changeptxk_change(value)
		{
			if(value=='NOIBO') document.getElementById('txtlv805').value='NHAPKHO';
			return;
		}
		function stateChangedptxk()
		{
			if (xmlhttp11.readyState==4)
			{
				var startdomain=xmlhttp11.responseText.indexOf('[PTXKCHECK]')+11;
				var enddomain=xmlhttp11.responseText.indexOf('[ENDPTXKCHECK]');
				var domainid=xmlhttp11.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('ptxkgetid').innerHTML=domainid;
			}
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
		function changeitemlot_change(value,whid)
		{
			$xmlhttp1=null;
			if(whid=="")
			{
				//alert("Mã kho rỗng!");
				return false;
			}
			if(value=="") 
			{
				//alert("Mã!");
				return false;
			}
			
			xmlhttp1=GetXmlHttpObject();
			if (xmlhttp1==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxlot=ajaxcheck"+"&itemid="+value+"&whid="+whid;
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedLot;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
		}
		function stateChangedLot()
		{
			if (xmlhttp1.readyState==4)
			{
				var startdomain=xmlhttp1.responseText.indexOf('[CHECKLOT]')+10;
				var enddomain=xmlhttp1.responseText.indexOf('[ENDCHECKLOT]');
				var domainid=xmlhttp1.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('txtlotid').innerHTML=domainid;
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