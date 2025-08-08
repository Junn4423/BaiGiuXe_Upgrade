<?php
include("paras.php");
if($plang=="")  $plang="EN";
$vLangArr=GetLangFile("../","AD0045.txt",$plang);
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
//////////////////////////////////////////////////////////////////////////////////////////////////////
//$ma=$_GET['ma'];
$vFlagID=(int)$_POST["txtFlag"];
$vOldPwd=$_POST['txtOldPwd'];
$vNewPwd=$_POST['txtNewPwd'];
$vConfirmPwd=$_POST['txtConfirmPwd'];
$vStrMessage="";
if($vFlagID==1)
{
	$tsql="select lv001 from lv_lv0007 where lv001='".$_SESSION['ERPSOFV2RUserID']."' and lv005='".md5($vOldPwd)."'";
	$tresult=db_query($tsql);
	$tnum=db_num_rows($tresult);
	if($tnum>0)
	{
		$sql=" update lv_lv0007 set lv005='".md5($vNewPwd)."' where lv001='".$_SESSION['ERPSOFV2RUserID']."'";
		db_query($sql);
		$vStrMessage=$vLangArr[9];	
	}
	else
	{
		$vStrMessage=$vLangArr[10];
	}

}
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<script language="javascript">
	function Refresh()
	{
		var o =document.loginForm;
		o.txtOldPwd.value="";
		o.txtNewPwd.value="";
		o.txtConfirmPwd.value="";	
		o.txtOldPwd.focus();
	}
	function Cancel()
	{
		var o=document.loginForm;
		o.action="?<?php //echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>";
		o.submit();
	}
	function Save()
	{

		var o=document.loginForm;
		
		if(CheckValue())
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}	
	function CheckValue()
	{
		var o=document.loginForm;
		if( o.txtNewPwd.value.length<6 )
		{
			alert("<?php echo $vLangArr[11];?>");
			o.txtNewPwd.focus();
			return false;
		}
		else if(o.txtNewPwd.value!=o.txtConfirmPwd.value)
		{
			alert("<?php echo $vLangArr[12];?>");
			o.txtNewPwd.focus();
			return false;
		}
		return true;
	}
	function ThisFocus()//longersoft
	{
		var o=document.loginForm;	
		o.txtOldPwd.focus();
	}
</script>
<style>
#sof_pages1  .sof_pages_content
{
	background:#fff;
	text-align:left;
	padding:20px;
}
#sof_pages1  .sof_pages_content .frmlogin
{
	background:#f2f2f2;
	width:260px;
	font:12px Arial,Tahoma;
	font-weight:none;
	color:#000;
	overflow:hidden;
	padding:20px;
	border-right:1px #a3a3a3 solid;
	border-bottom:1px #a3a3a3 solid;
}
#sof_pages1  .sof_pages_content .frmlogin .loginname
{
	clear:both;
	padding:5px;
	overflow:hidden;

}
#sof_pages1  .sof_pages_content .frmlogin .loginname .inputtext
{
	width:250px;
	height:25px;
}
#sof_pages1  .sof_pages_content .frmlogin .loginname .selecttext
{
	width:180px;
	height:25px;
}
/*-----------start footer----------------*/
#sof_pages1 .sof_pages_footer
{
	clear:both;
	background:#ffffff ; 
	height:112px;
}
#sof_pages1 .sof_pages_footer .sof_pages_footer_left
{
	font:12px Arial,Tahoma;
	font-weight:none;
	color:#4d4d4f;
	float:left;
	right:left;
	width:333px;
	padding-left:30px;
	text-align:left;
}
#sof_pages1 .sof_pages_footer .sof_pages_footer_left span
{
	font:18px Arial,Tahoma;
	font-weight:none;
	color:#ff0000;
}
#sof_pages1 .sof_pages_footer .sof_pages_footer_right
{
	width:auto;
	padding-right:30px;
	text-align:right;
}
</style>
<?php

if(trim($_SESSION['ERPSOFV2RUserID'])!="")
{
?>

<body onLoad="ThisFocus('txtOldPwd');">
<div id="sof_pages1">
				
					<div class="hd_subtitle">
						<div class="lvtitle">
						<center><?php echo $vLangArr[5];?></center>
						</div>
					</div>
				
 <div class="sof_pages_content">
					<center>
					<div>
					<div class="frmlogin">
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form name="loginForm" method="post" action="?<?php echo $psaveget;?>" >
							<input type="hidden" name="txtFlag" id="txtFlag" value="">	
								<div><?php echo $vStrMessage;?></div>
								<div class="loginname">
									<div id="oldmatkhau" style="position:absolute;padding-top:5px;padding-left:10px;height:25px" onclick="this.style.display='none';document.loginForm.txtOldPwd.focus();cursor:text"><span style=";height:25px"><?php echo $vLangArr[6];?></span></div>
									<input  class="inputtext" type="password" id="txtOldPwd" name="txtOldPwd" maxlength="50" tabindex="2" onfocus="this.value = '';document.getElementById('oldmatkhau').style.display='none'" title="<?php echo $vLangArr[6];?>"/>
								</div>
								<div class="loginname">
									<div id="matkhau" style="position:absolute;padding-top:5px;padding-left:10px;height:25px" onclick="this.style.display='none';document.loginForm.txtPassword.focus();cursor:text"><span style=";height:25px"><?php echo $vLangArr[7];?></span></div>
									<input  class="inputtext" type="password" id="txtNewPwd" name="txtNewPwd" maxlength="50" tabindex="2" onfocus="this.value = '';document.getElementById('matkhau').style.display='none'" title="<?php echo $vLangArr[7];?>"/>
								</div>
								<div class="loginname">
									<div id="matkhauconfirm" style="position:absolute;padding-top:5px;padding-left:10px;height:25px" onclick="this.style.display='none';document.loginForm.txtConfirmPwd.focus();cursor:text"><span style=";height:25px"><?php echo $vLangArr[8];?></span></div>
									<input  class="inputtext" name="txtConfirmPwd" type="password" id="txtConfirmPwd" maxlength="50" tabindex="2" onfocus="this.value = '';document.getElementById('matkhauconfirm').style.display='none'" title="<?php echo $vLangArr[8];?>"/>
								</div>
				
								<div class="loginname"> 
									<div style="float:left"><input type="button" name="Submit" onClick="Save();" value="<?php echo $vLangArr[1];?>" class="button"  tabindex="4"></div>
									<div style="float:left"><input type="reset" name="clear" value="Làm lại" class="button" tabindex="5"></div>
									<div style="float:left"><input type="button" name="clear" onClick="Cancel()" value="<?php echo $vLangArr[2];?>" class="button" tabindex="5"></div>
								</div>
						</form>
					
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			</div>
					</div>
					</center>
				</div>
  </div>
</div>
</body>
<?php
} else {
	include("permit.php");
}
?>