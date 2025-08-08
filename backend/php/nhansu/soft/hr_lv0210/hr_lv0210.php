<?php
//session_start();
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/hr_lv0210.php");
require_once("../clsall/hr_lv0020.php");
//////////////init object////////////////
$lvhr_lv0210=new hr_lv0210($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0210');
$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
if($lvhr_lv0210->GetView()>0)
{
	$lvhr_lv0210->lv002=$_POST['txtlv002'];
$plang=$_GET['lang'];
if($plang!="VN" || $plang=="")
$plang="EN";
//$prehr_lv0106=$curhr_lv0106;//Tạm thời để
?>
<html>
<head>
<title>MINH PHUONG</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/reportstyle.css" type="text/css">
<script language="JavaScript" type="text/javascript">
function ShowHide(v)
{
	o=document.getElementById('litangleft_'+v);
	//o1=document.getElementById('litangleftnd_'+v);
	if(o.style.display=='none')
	{
		o.style.display='block';
		//o1.style.display='block';
	}
	else
	{
		o.style.display='none';
		//o1.style.display='none';
	}
}

function Save()
{
	ChangeInfor();
}
function ChangeInfor()
{
	//if(LV_CheckSearch())
	{
		var o1=document.frmchoose;
		o1.submit();
	}
}	
</script>
<div class="hd_cafe" style="width:100%">
	<ul class="qlycafe" style="width:100%">
		<li style="width:100%"><div class="licafe" style="width:100%">
			<strong>XEM TÀI LIỆU</strong></li>
	</ul>
</div>
<div style="padding-left:10px">
<form method="post" name="frmchoose" > 
<table><tr><td>Tìm tài liệu</td><td><table width="95%">
										<tr>
										<td>
											<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)">
											<li class="menupopT">
												<input  onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};" type="textbox" name="txtlv002" id="txtlv002" value="<?php echo $lvhr_lv0210->lv002;?>" style="min-width:280px;width:100%;"  autocomplete="off" 
												onkeyup="LoadSelfNextParentNewSreen(this,'txtlv002','hr_lv0211','lv002','lv002,lv004,lv003','','',0)" onKeyPress="return CheckKey(event,7)"/>
												<div id="lv_popup" lang="lv_popup1"> </div>
												</li>
											</ul>
											</td>
											<td><input type="button" value="Tìm kiếm" onclick="ChangeInfor()"/>
										</tr>
										</table></td></tr></table>
</form>										
<center>
	<?php

	$lvhr_lv0020->LV_LoadID($lvhr_lv0210->LV_UserID);
	$lvhr_lv0210->ThuHangHienTai=$lvhr_lv0020->lv029;
	if($lvhr_lv0210->ThuHangHienTai=='' || $lvhr_lv0210->ThuHangHienTai==null) $lvhr_lv0210->ThuHangHienTai='';
	echo $lvhr_lv0210->LV_TaiLieuThanhVien($lvhr_lv0020->lv029);
	?>
</center>
</div>
<style>
@keyframes example {
  from {background-color: #64C5C4 ;}
  to {background-color: yellow;}
}
.nhapnhay
{
  background-color: #64C5C4;
  animation-name: example;
  animation-duration: 4s;
  animation-iteration-count: infinite;
}
.home_title
{
	font-weight:bold;
	padding:10px;
	padding-left:20px;
	background:url(pointer.png) no-repeat;
	list-style:none;
}		
		table.ftable
{
	background-color:#fff;
	width:100%;
	text-align:left;
	margin:0 auto;
}
table.ftable tr
{

}
table.f_table tr:nth-child(even) 
{
	background-color:#f0f0f0;
}
table.ftable tr td
{
	padding:8px 15px 8px 15px;
}
table.sftable tr td
{
	padding:2px 10px 2px 10px;
}
table.f_table tr td
{
	padding:6px 15px 6px 15px;
}
table.ftable tr td.grey
{
	background-color:#f0f0f0;
}
.ftable table
{
	width:100%;
}
td.editor table tr td
{
	padding:0px !important;
}
td.titlerow,tr.titlerow
{
	background-color:#fff !important;
	border-bottom:1px #e5e5e5 solid;
}
#tab_notice li:hover
{
	color:#0485be !important;
}
#sof_pages  .sof_pages_content
{
	background:#fff;
	text-align:left;
	padding:10px;
	padding-left:0px;
	padding-right:0px;
}
</style>
      	
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>