<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/lv_lv0007.php");
require_once("../clsall/jo_lv0016.php");
$molv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0071.txt",$plang);

$psql = $_POST['txtSQL'];
$vFlagID = $_POST['txtFlag'];
$vlv001=$_POST["txtlv001"];
$vNewPwd=$_POST['txtNewPwd'];
$vConfirmPwd=$_POST['txtConfirmPwd'];
$vStrMessage="";
////////////////////////////////////////////Get Employee Data////////////////////////////////////////////
$strSQL = "SELECT lv001, lv002 FROM lv_lv0007 WHERE lv001='$vlv001'";
$vResult = db_query($strSQL);
$intRows = db_fetch_array($vResult);
if($intRows>0)
{
	$strFullName = $intRows['UserName']." (".$intRows['lv001'].") ";
}
////////////////////////////////////////////Get Employee Data////////////////////////////////////////////

///////////////////////////////////////////////Check Change//////////////////////////////////////////////
if($vFlagID==1)
{
	if($molv_lv0007->GetApr()==1 && $molv_lv0007->GetUnApr()==1)
{
	$strSQL2 = "UPDATE lv_lv0007 SET lv005='".md5($vNewPwd)."' WHERE (lv001='$vlv001')";
	$vResult2=db_query($strSQL2);
	if($vResult2==true) 
	{
		$vStrMessage=$vLangArr[9];
		//redirect("?lang");
		$vFlagID = 1;
	}
	else
	{
		$vStrMessage=$vLangArr[10].sof_error();	
		$vFlagID = 0;
	}
}
else
{
	echo 'Xin vui lòng liên hệ admin!';
}
}
///////////////////////////////////////////////Check Change//////////////////////////////////////////////
?>
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
<script language="javascript">
<!--
function FocusThis()
{
	var o=document.loginForm;	
	o.txtOldPwd.focus();
}
function Reload()
{
	javascript:window.location.reload(true);
}
function Cancel()
{
	var o=document.loginForm;
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
	o.submit();
}
function Save()
{
	var o=document.loginForm;
	if(CheckInput())
	{
		o.txtFlag.value="1";
		o.submit();
	}
}	
function CheckInput()
{
	var o=document.loginForm;	
	if(o.txtNewPwd.value==""){
		alert("<?php echo  $vLangArr[11];?>");
		o.txtNewPwd.focus();
		return false;
	}
	else if(o.txtNewPwd.value.length<6 || o.txtNewPwd.value.length>20){
		alert("<?php echo  $vLangArr[12];?>");
		o.txtNewPwd.select();
		return false;
	}
	else if(o.txtConfirmPwd.value==""){
		alert("<?php echo  $vLangArr[13];?>");
		o.txtConfirmPwd.focus();
		return false;
	}
	else if(o.txtConfirmPwd.value!=o.txtNewPwd.value){
		alert("<?php echo  $vLangArr[14];?>");
		o.txtConfirmPwd.select();
		return false;
	}
	return true;
}
function Help(){'http://www.ERPSOFV2R.com?option=com_content&amp;sectionid=0#';}	
//-->
</script>
<?php
//if(checkright("",$_SESSION['ERPSOFV2Rlv001'],"","")>0)
if($molv_lv0007->GetApr()==1 && $molv_lv0007->GetUnApr()==1)
{
?>
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
									<div id="matkhau" style="position:absolute;padding-top:5px;padding-left:10px;height:25px" onclick="this.style.display='none';document.loginForm.txtPassword.focus();cursor:text"><span style=";height:25px"><?php echo $vLangArr[6];?></span></div>
									<input  class="inputtext" type="password" id="txtNewPwd" name="txtNewPwd" maxlength="50" tabindex="2" onfocus="this.value = '';document.getElementById('matkhau').style.display='none'" title="<?php echo $vLangArr[6];?>"/>
								</div>
								<div class="loginname">
									<div id="matkhauconfirm" style="position:absolute;padding-top:5px;padding-left:10px;height:25px" onclick="this.style.display='none';document.loginForm.txtConfirmPwd.focus();cursor:text"><span style=";height:25px"><?php echo $vLangArr[7];?></span></div>
									<input  class="inputtext" name="txtConfirmPwd" type="password" id="txtConfirmPwd" maxlength="50" tabindex="2" onfocus="this.value = '';document.getElementById('matkhauconfirm').style.display='none'" title="<?php echo $vLangArr[7];?>"/>
								</div>
				
								<div class="loginname"> 
									<div style="float:left"><input type="button" name="Submit" onClick="Save();" value="<?php echo $vLangArr[1];?>" class="button"  tabindex="4"></div>
									<div style="float:left"><input type="reset" name="clear" value="Làm lại" class="button" tabindex="5"></div>
									<div style="float:left"><input type="button" name="clear" onClick="Cancel()" value="<?php echo $vLangArr[2];?>" class="button" tabindex="5"></div>
								</div>
							<input type="hidden" name="txtlv001" id="txtlv001" value="<?php echo $vlv001; ?>" />
							<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
						</form>
					
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			</div>
					</div>
					</center>
				</div>
  </div>
</div>
<?php
if($vFlagID==1)
{
?>
<script language="javascript">
	Cancel();
</script>
<?php
}
?>
<?php
} else {
	include("permit.php");
}
?>