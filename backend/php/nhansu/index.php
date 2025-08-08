<?php
$lvIpClient=$_SERVER['REMOTE_ADDR'];
ob_start(); // Turn on output buffering
system('arp '.$lvIpClient.' -a'); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer
ob_start();
session_start(); 
include("soft/config.php");
include("soft/function.php");
require_once("clsall/lv_controler.php");
require_once("clsall/hr_lv0001.php");

include("token.php");

$right  = $_SESSION['ERPSOFV2RRight'] ?? null;
$userId = $_SESSION['ERPSOFV2RUserID'] ?? null;

$mohr_lv0001 = new hr_lv0001($right, $userId, 'Ad0001');

// include("chat/chat-api.php");
// $apiClient = new ChatApiClient(CHAT_API_BASE_URL, CHAT_SOCKET_URL);

$pmac = strpos($mycom, " ".$lvIpClient." "); // Find the position of Physical text
$lvmac=substr($mycom,($pmac+strlen($lvIpClient)+2),30); // Get Physical Address
$vFlag = intval($_POST['txtFlag'] ?? null);
if($userId!="" && $userId!=NULL)  redirect("soft/?lang=VN");
$vMessage = "";
if(isset($_POST['txtUserName']))
{
		$vUserName=$_POST['txtUserName'];
		$vPassword=$_POST['txtPassword'];
		$vgetopt=$_POST['cboLang'];
		if($vgetopt==0)
			$vlang="EN";
		else
			$vlang="VN";
		///////////////////////////////////////////////////////////////////////////////////////////////
		if(intval($vFlag)==1){
			$vMessage = "";
			$vnum=0;
			if($vUserName!="" && $vPassword!="")
			{
				
					$vsql="select *,DATEDIFF(curdate(),lv009) numdate,TIME_TO_SEC(concat(curdate(),' ',curtime())) tos,TIME_TO_SEC(lv009) fros from lv_lv0007 where lv001='$vUserName' and lv005='".md5($vPassword)."' and lv007=0";
					$vresult=db_query($vsql);
					if($vresult)
					{
						$vnum=db_num_rows($vresult);
					}
					if($vnum>0)
					{
						$vrow=db_fetch_array($vresult);
						if($vrow['lv008']!='' && $vrow['lv008']!=null)
						{
							 if($vrow['tos']-$vrow['fros']<0 && ($vrow['numdate']<=0))
							 {
								$vMessage = "Người dùng khác đã đăng nhập trước (".($vrow['tos']-$vrow['fros'])."s)!";
							}
							else
							{
								$_SESSION['ERPSOFV2RUserID']= $vrow['lv001'];
								$_SESSION['ERPSOFV2RRight']=$vrow['lv003'];
								$_SESSION['userlogin_smcd']=$vrow['lv006'];
								$_SESSION['SOFIP']=$lvIpClient;
								$_SESSION['SOFMAC']=$lvmac;
								$token = create_token($vrow['lv001']);
								$_SESSION['SOFONLINE']=$token;
								$vsql="update lv_lv0007 set lv008='".$_SESSION['SOFONLINE']."',lv009=concat(CurDate(),' ',CurTime()) where lv001='$vUserName'";
								$vresult=db_query($vsql);
								$vDate=GetServerDate();
								$vTime=GetServerTime();
								Logtime($_SESSION['ERPSOFV2RUserID'],$vDate,$vTime,0,$_SESSION['SOFIP'],$_SESSION['SOFMAC']);
								
								try {
									if (isset($apiClient) && $apiClient->isApiAvailable()) {
										// Đăng nhập
										$loginResult = $apiClient->login($vUserName, $vPassword);
									} else {
										// Bỏ qua tích hợp chat vì không khả dụng
									}
								} catch (Exception $e) {
								}
								redirect("soft/index.php?lang=$vlang");
							}
						}
						else
						{
							$_SESSION['ERPSOFV2RUserID']= $vrow['lv001'];
							$_SESSION['ERPSOFV2RRight']=$vrow['lv003'];
							$_SESSION['userlogin_smcd']=$vrow['lv006'];
							$_SESSION['SOFIP']=$lvIpClient;
							$_SESSION['SOFMAC']=$lvmac;
							$token = create_token($vrow['lv001']);
							$_SESSION['SOFONLINE']=$token;
							$vsql="update lv_lv0007 set lv008='".$_SESSION['SOFONLINE']."',lv009=concat(CurDate(),' ',CurTime()) where lv001='$vUserName'";
							$vresult=db_query($vsql);
							$vDate=GetServerDate();
							$vTime=GetServerTime();
							Logtime($_SESSION['ERPSOFV2RUserID'],$vDate,$vTime,0,$_SESSION['SOFIP'],$_SESSION['SOFMAC']);
							
							try {
								if (isset($apiClient) && $apiClient->isApiAvailable()) {
									// Đăng nhập
									$loginResult = $apiClient->login($vUserName, $vPassword);
								} else {
									// Bỏ qua tích hợp chat vì không khả dụng
								}
							} catch (Exception $e) {
							}
							redirect("soft/index.php?lang=$vlang");
						}
					} else {
						$vMessage = "Login failed, please try again!";
						$vFlagSelect = 1;
					}
			} else if($vUserName==""){
				$vMessage = "Please enter your Login Name!";
			} else if($vPassword==""){
				$vMessage = "Please enter your Password!";
				$vFlagFocus = 1;
			}
		}
	}
else
{
	
}
///////////////////////////////////////////////////////////////////////////////////////////////

?>
<html>
<head>	
<title>ERP SOF</title>
	<link href="logo.gif" rel="icon" type="image/gif"/>		
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<LINK REL="SHORTCUT ICON"  HREF="../logo.ico" >
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/cssverticalmenu.css" type="text/css">
	<script language="javascript" src="javascript/menuhorizontal.js"></script>
</head>
	<script language="javascript">
	/*=======================================================================*/
	function setFocus(){
		document.loginForm.txtUserName.focus();
	}
	/*=======================================================================*/
	function Login(){
		var o = document.loginForm;
		o.txtFlag.value = 1;
	}
	function ShowPassword()
	{	
		if(document.getElementById('txtPassword').type=='password')
		{
			document.getElementById('txtPassword').type='text';
			document.getElementById('thaymatkhau').value="ẨN MẬT KHẨU";
		}
		else
		{
			document.getElementById('txtPassword').type='password';
			document.getElementById('thaymatkhau').value="THẤY MẬT KHẨU";
		}
	}
	/*=======================================================================*/
	</script>
<body onload="callscreen1();">
		<center>
			<div id="sof_pages" style="width:400px!important;float:none!important;">
				<div class="sof_pages_header">
					<div class="hd_title">
						<div class="hd_title_left" style="width:250px;padding-top:10px!important;;padding-left:10px!important;text-align:center;">
							<font style="font-size:12px">
							CÔNG TY TNHH</font><font style="font-size:20px"> SOF</font>
							<!--<font style="font-size:12px">
							CÔNG TY TNHH</font><font style="font-size:20px"> SOF</font>-->
						</div>
						<div style="float:right;padding-top:1px;padding-right:1px">
							<img  width="120" src="images/logo/logo.png"/>
						</div>
					</div>
					<div class="hd_subtitle" style="padding-top:5px!important; height:50px;">
						<div class="lvtitle">
							<div style="float:left;"><a href='android/mp.apk'><img  height="40" src="android/android.png"/></a></div>
						<div style="float:left;padding-left:40px;padding-top:10px;">
						<center>ĐĂNG NHẬP</center>
						</div>
						</div>
					</div>
				</div>
				<div class="sof_pages_content" style="overflow:hidden;width:360px!important;">
					<center>
					<div style="width:320px!important;">
					<div class="frmlogin">
						<form name="loginForm" method="post" action="" onSubmit="submitForm(); return false;">
							<input type="hidden" name="txtFlag" id="txtFlag" value="">	
								<div style="color:red"><?php echo $vMessage;?></div>
								<div class="loginname">
										<input class="inputtext" type="text" id="txtUserName" name="txtUserName"  maxlength="32" tabindex="1" onblur="if(this.value == '') {this.value = this.title;};" onfocus="this.value = '';" title="Tên đăng nhập" value="Tên đăng nhập">
								</div>
								<div class="loginname">
									<div id="matkhau" style="position:absolute;padding-top:5px;padding-left:10px;height:25px" onclick="this.style.display='none';document.loginForm.txtPassword.focus();cursor:text"><span style=";height:25px">Mật khẩu</span></div>
									<input  class="inputtext" type="password" id="txtPassword" name="txtPassword" maxlength="50" tabindex="2" onfocus="this.value = '';document.getElementById('matkhau').style.display='none'" title="Mật khẩu"/>
								</div>
								<div class="loginname">
									<div style="float:left;padding-top:6px;">Ngôn ngữ : </div>
									<div style="float:right;text-align:right"><select name="cboLang" id="cboLang" class="selecttext" tabindex="3">
																	<option value="1" selected="selected">Vietnamese</option>
																	<option value="0">English</option>
																</select>
									</div>
								</div>
								<div class="loginname"> 
									<div><div style="float:left"><input  type="submit" name="Submit" onClick="Login();" value="ĐĂNG NHẬP" class="button"  tabindex="4" style="width:100px;"></div>
									<div style="float:right;padding-left:5px;"><input style="width:140px;" type="button" id="thaymatkhau" name="clear" onClick="ShowPassword(this.value)" value="THẤY MẬT KHẨU" class="button" tabindex="5"></div>
									<!---->
									</div>
									<!--
									<div style="clear:both;padding-top:10px;">
										<div style="float:left;"><input  style="width:80px;" type="reset" name="clear" value="Làm lại" class="button" tabindex="5"></div>
										div style="float:right;padding-left:5px;"><a href="quenmatkhau" style="color:#000;">Quên Password</a></div></div>
									</div>
									-->
								</div>
								
						</form>
					</div>
					</div>
					</center>
				</div>
			</div>
		</div>
		</center>
	</body>	
	
	<form name="frmdatabaseload" method="post" >
		<input type="hidden" name="txtFlag" id="txtFlag" value="2">
		<input type="hidden" name="txtDatabase" id="txtDatabase" value="">
	</form>
<!-- End Footer -->
<!-- End ImageReady Slices -->
<script language="javascript">

	var o=document.loginForm;
		o.txtUserName.focus();
	function LoadCustomer(customer)
	{
		var o=document.frmdatabaseload;
		o.txtDatabase.value=customer;
		o.submit();
	}
	
</script>
<script type="text/javascript">
        var glossymenu=new glossymenu.dd("glossymenu");
        glossymenu.init("glossymenu","menuhover");
    </script>  
</html>
<?php ob_end_flush();?>