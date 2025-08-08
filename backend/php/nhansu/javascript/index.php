<?php
	session_start(); 
	include("soft/config.php");
	include("soft/function.php");
	$vUserName=$_POST['txtUserName'];
	$vPassword=$_POST['txtPassword'];
	$vgetopt=$_POST['cboLang'];
	if($vgetopt==0)
		$vlang="EN";
	else
		$vlang="VN";

	$vnum=0;
	if($vUserName!="" && $vPassword!="")
	{
		if(is_numeric(substr($vUserName,0,1)))//UserName la number -> kiem tra ben Employees
		{
			$vsql="SELECT * FROM employeelogin WHERE ID='$vUserName' AND Pwd='$vPassword' AND State=1";
			$vresult=db_query($vsql);
			if($vresult)
			{
				$vnum=db_num_rows($vresult);
			}
			if($vnum>0)
			{
				$vrow=db_fetch_array($vresult);
				$_SESSION['ERPSOFV2RUserID']= $vrow['ID'];
				$vDate=GetServerDate();
				$vTime=GetServerTime();
				EmpLogtime($_SESSION['ERPSOFV2RUserID'], $vDate, $vTime, 0);
//				redirect("soft/employees/?lang=".$vlang);
				redirect("soft/?lang=$vlang");				
			}
		}
		else //if(is_string(substr($vUserName,0,1)))//UserName la text -> kiem tra ben Administrator
		{
			$vsql="select * from user where ID='$vUserName' and UserPassword='".md5($vPassword)."'";
			$vresult=db_query($vsql);
			if($vresult)
			{
				$vnum=db_num_rows($vresult);
			}
			if($vnum>0)
			{
				$vrow=db_fetch_array($vresult);
				$_SESSION['ERPSOFV2RUserID']= $vrow['ID'];
				$_SESSION['ERPSOFV2RRight']=$vrow['UserRight'];
				$vDate=GetServerDate();
				$vTime=GetServerTime();
				Logtime($_SESSION['ERPSOFV2RUserID'],$vDate,$vTime,0);
				redirect("soft/?lang=$vlang");
			}
		}
	}
?>
<html>
<head>
<title>MINH PHUONG</title>
<link href="favicon.ico" rel="icon" type="image/gif"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script>
function setFocus(){
	document.loginForm.txtUserName.focus();
}
</script>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
.bodyTXT {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
.loginTXT {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
	height: 19px;
	vertical-align: middle;
	padding-top:0;
}
-->
</style></head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >

<!-- ImageReady Slices (orange_new.psd) -->
<table id="Table_01" width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="43%" align="right">&nbsp;</td>
    <td width="57%" align="center">&nbsp;</td>
  </tr>
</table>
<table id="Table_01" width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" align="center" bgcolor="#759744"><table id="Table_01" width="874" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="25"><img src="images/pictures/banner_line_01.gif" width="25" height="14" alt=""></td>
        <td width="72"><img src="images/pictures/banner_line_02.gif" width="72" height="14" alt=""></td>
        <td colspan="2"><img src="images/pictures/banner_line_03.gif" width="107" height="14" alt=""></td>
        <td colspan="5"><img src="images/pictures/banner_line_04.gif" width="610" height="14" alt=""></td>
        <td width="403"><img src="images/pictures/banner_line_05.gif" width="49" height="14" alt=""></td>
        <td width="52"><img src="images/pictures/banner_line_06.gif" width="10" height="14" alt=""></td>
      </tr>
    </table></td>
  </tr>
</table>
  <form name="loginForm" method="post" action="index.php" onSubmit="submitForm(); return false;">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%"><img src="images/pictures/spacer.gif" width="5" height="5" alt=""></td>
    <td width="60%"><table id="Table_01" width="717" height="379" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td rowspan="6"><img src="images/pictures/orange_newMain_01.gif" width="5" height="100%" alt=""></td>
        <td rowspan="5" valign="top"><img src="images/pictures/banner_01.gif" width="167" height="180">
          <table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="45%">&nbsp;</td>
              <td width="55%">&nbsp;</td>
            </tr>
            <tr>
              <td align="right" class="bodyTXT">Login Name : </td>
              <td>
			<input type="text" id="txtUserName" name="txtUserName" style="width:80; 
							height:19px;font-size:12px" maxlength="20"/>              </td>
            </tr>
            <tr>
              <td align="right" class="bodyTXT">Password : </td>
              <td><input type="password" id="txtPassword" name="txtPassword" style="width:80; height:19px;" 
							maxlength="20"/></td>
            </tr>
            <tr>
              <td align="right" class="bodyTXT">Language : </td>
              <td><select name="cboLang" id="cboLang" style="width:80; height:18px;font-size:12px">
								<option value="0" selected="selected">English</option>
								<option value="1">Vietnamese</option>
							</select></td>
            </tr>
            <tr>
			<td height="40" valign="bottom" align="center"><input type="Submit" name="Submit" value="Login" class="button" > </td>
            <td align="center" valign="bottom"><input type="reset" name="clear" value="Clear" class="button"></td>
            </tr>
            <tr>
             	<td></td>          
            </tr>
          </table></td>
        <td colspan="2" rowspan="3"><img src="images/pictures/banner_02.gif" width="94" height="121"></td>
        <td colspan="2"><img src="images/pictures/banner_03.gif" width="451" height="29" alt=""></td>
      </tr>
      <tr>
        <td colspan="2"><img src="images/pictures/banner_06.gif" width="451" height="46" alt=""></td>
      </tr>
      <tr>
        <td colspan="2"><img src="images/pictures/banner_08.gif" width="451" height="41" alt=""></td>
      </tr>
      <tr>
        <td><img src="images/pictures/banner_09.gif" width="23" height="22"></td>
        <td colspan="3"><img src="images/pictures/banner_10.gif" width="522" height="22" alt=""></td>
      </tr>
      <tr>
        <td><img src="images/pictures/orange_newMain_09.gif" width="23" height="169" alt=""></td>
        <td colspan="3" valign="top"><table width="80%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="bodyTXT"><?php include("languages/EN/AD0202.txt");?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="bottom"><img src="images/pictures/footer01_03.gif" width="167" height="25"></td>
        <td colspan="4"><img src="images/pictures/footer01_02.gif" width="545" height="31" alt=""></td>
      </tr>
      <tr>
        <td colspan="5"><img src="images/pictures/footer02_01.gif" width="657" height="40" alt=""></td>
        <td><img src="images/pictures/footer02_02.gif" width="60" height="40" alt=""></td>
      </tr>
      <tr>
        <td><img src="images/pictures/spacer.gif" width="5" height="1" alt=""></td>
        <td><img src="images/pictures/spacer.gif" width="167" height="1" alt=""></td>
        <td><img src="images/pictures/spacer.gif" width="23" height="1" alt=""></td>
        <td><img src="images/pictures/spacer.gif" width="71" height="1" alt=""></td>
        <td><img src="images/pictures/spacer.gif" width="391" height="1" alt=""></td>
        <td><img src="images/pictures/spacer.gif" width="60" height="1" alt=""></td>
      </tr>
    </table></td>
    <td width="20%" valign="top">&nbsp;</td>
  </tr>
</table>
</form>
<!-- End ImageReady Slices -->
<table width="100%">
<tr>
<td align="center"><a href="http://www.ecyromo.com" target="_blank">eCyromo</a> &copy;Copy right Software 2006 - 2007 All rights reserved.</td>
</tr>
</table>
<script language="javascript">
setFocus();
</script>
</body>
</html>