<?php
session_start();
//require_once("../../clsall/hr_lv0078.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0078.php");
//////////////init object////////////////
$lvhr_lv0078=new hr_lv0078($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0078');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","KI0009.txt",$plang);
$mohr_lv0078->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0078->lv001=$_POST['txtlv001'];
$lvhr_lv0078->lv002=$_POST['txtlv002'];
$lvhr_lv0078->lv003=$_POST['txtlv003'];
$lvhr_lv0078->lv004=$_POST['txtlv004'];
$lvhr_lv0078->lv005=$_POST['txtlv005'];
$lvhr_lv0078->lv006=$_POST['txtlv006'];
$lvhr_lv0078->lv007=$_POST['txtlv007'];
$lvhr_lv0078->lv008=$_POST['txtlv008'];
$lvhr_lv0078->lv009=$_POST['txtlv009'];
$lvhr_lv0078->lv010=$_POST['txtlv010'];
$lvhr_lv0078->lv011=$_POST['txtlv011'];
$lvhr_lv0078->lv012=$_POST['txtlv012'];
$lvhr_lv0078->lv013=$_POST['txtlv013'];
$lvhr_lv0078->lv014=$_POST['txtlv014'];
$lvhr_lv0078->lv015=$_POST['txtlv015'];
$lvhr_lv0078->lv016=$_POST['txtlv016'];
$lvhr_lv0078->lv017=$_POST['txtlv017'];
$lvhr_lv0078->lv018=$_POST['txtlv018'];
$lvhr_lv0078->lv019=$_POST['txtlv019'];
$lvhr_lv0078->lv020=$_POST['txtlv020'];
$lvhr_lv0078->lv021=$_POST['txtlv021'];
$lvhr_lv0078->lv022=$_POST['txtlv022'];
$lvhr_lv0078->lv023=$_POST['txtlv023'];
$lvhr_lv0078->lv024=$_POST['txtlv024'];
$lvhr_lv0078->lv025=$_POST['txtlv025'];
$lvhr_lv0078->lv026=$_POST['txtlv026'];
$lvhr_lv0078->lv027=$_POST['txtlv027'];
$lvhr_lv0078->lv028=$_POST['txtlv028'];
$lvhr_lv0078->lv029=$_POST['txtlv029'];
$lvhr_lv0078->lv030=$_POST['txtlv030'];
$lvhr_lv0078->lv031=$_POST['txtlv031'];
$lvhr_lv0078->lv032=$_POST['txtlv032'];
if(trim($_POST['txtlv033_1'])!="") $lvhr_lv0078->lv033=$lvhr_lv0078->lv033.";".$_POST['txtlv033_1'];
if(trim($_POST['txtlv033_2'])!="") $lvhr_lv0078->lv033=$lvhr_lv0078->lv033.";".$_POST['txtlv033_2'];
if(trim($_POST['txtlv033_3'])!="") $lvhr_lv0078->lv033=$lvhr_lv0078->lv033.";".$_POST['txtlv033_3'];
if(trim($_POST['txtlv033_4'])!="") $lvhr_lv0078->lv033=$lvhr_lv0078->lv033.";".$_POST['txtlv033_4'];
if(trim($_POST['txtlv033_5'])!="") $lvhr_lv0078->lv033=$lvhr_lv0078->lv033.";".$_POST['txtlv033_5'];
if(trim($_POST['txtlv033_6'])!="") $lvhr_lv0078->lv033=$lvhr_lv0078->lv033.";".$_POST['txtlv033_6'];
if(trim($_POST['txtlv033_7'])!="") $lvhr_lv0078->lv033=$lvhr_lv0078->lv033.";".$_POST['txtlv033_7'];
if(trim($_POST['txtlv033_8'])!="") $lvhr_lv0078->lv033=$lvhr_lv0078->lv033.";".$_POST['txtlv033_8'];
if(trim($_POST['txtlv033_9'])!="") $lvhr_lv0078->lv033=$lvhr_lv0078->lv033.";".$_POST['txtlv033_9'];
$lvhr_lv0078->lv034=$_POST['txtlv034'];
$lvhr_lv0078->lv035=$_POST['txtlv035'];
$lvhr_lv0078->lv036=$_POST['txtlv036'];
$lvhr_lv0078->lv037=$_POST['txtlv037'];
$lvhr_lv0078->lv038=$_FILES['userfile']['name'];
$lvhr_lv0078->lv039=getInfor($_SESSION['ERPSOFV2RUserID'], 2);
$lvhr_lv0078->lv040=GetServerDate()." ".GetServerTime();
$lvhr_lv0078->lv041='1';
$lvhr_lv0078->lv042=$_POST['txtlv042'];
$lvhr_lv0078->lv043=$_POST['txtlv043'];
$lvhr_lv0078->lv044=$_POST['txtlv044'];
$lvhr_lv0078->lv069=$_POST['txtlv069'];
$lvhr_lv0078->lv070=$_POST['txtlv070'];
$lvhr_lv0078->lv071=$_POST['txtlv071'];
$lvhr_lv0078->lv072=$_POST['txtlv072'];
$lvhr_lv0078->lv073=$_POST['txtlv073'];
$lvhr_lv0078->lv074=$_POST['txtlv074'];
$lvhr_lv0078->lv075=$_POST['txtlv075'];
$lvhr_lv0078->lv076=$_POST['txtlv076'];
$lvhr_lv0078->lv077=$_POST['txtlv077'];
$lvhr_lv0078->lv078=$_POST['txtlv078'];
$lvhr_lv0078->lv079=$_POST['txtlv079'];
$lvhr_lv0078->lv080=$_POST['txtlv080'];
$lvhr_lv0078->lv081=$_POST['txtlv081'];
$lvhr_lv0078->lv082=$_POST['txtlv082'];
$lvhr_lv0078->lv083=$_POST['txtlv083'];
$lvhr_lv0078->lv084=$_POST['txtlv084'];
$lvhr_lv0078->lv085=$_POST['txtlv085'];
$lvhr_lv0078->lv086=$_POST['txtlv086'];
$lvhr_lv0078->lv087=$_POST['txtlv087'];
$lvhr_lv0078->lv088=$_POST['txtlv088'];
$lvhr_lv0078->lv201=$_POST['txtlv201'];
$lvhr_lv0078->lv202=$_POST['txtlv202'];
$lvhr_lv0078->lv203=$_POST['txtlv203'];
$lvhr_lv0078->lv204=$_POST['txtlv204'];
$lvhr_lv0078->lv205=$_POST['txtlv205'];
$lvhr_lv0078->lv211=$_POST['txtlv211'];
$lvhr_lv0078->lv212=$_POST['txtlv212'];
$lvhr_lv0078->lv213=$_POST['txtlv213'];
$lvhr_lv0078->lv214=$_POST['txtlv214'];
$lvhr_lv0078->lv215=$_POST['txtlv215'];
$lvhr_lv0078->lv221=$_POST['txtlv221'];
$lvhr_lv0078->lv222=$_POST['txtlv222'];
$lvhr_lv0078->lv223=$_POST['txtlv223'];
$lvhr_lv0078->lv224=$_POST['txtlv224'];
$lvhr_lv0078->lv225=$_POST['txtlv225'];
if($_POST['txtlv301_1']!="" && $_POST['txtlv301_2']!="") $lvhr_lv0078->lv301=Fillnum($_POST['txtlv301_2'],4)."-".Fillnum($_POST['txtlv301_1'],2)."-01";
if($_POST['txtlv302_1']!="" && $_POST['txtlv302_2']!="") $lvhr_lv0078->lv302=Fillnum($_POST['txtlv302_2'],4)."-".Fillnum($_POST['txtlv302_1'],2)."-01";
$lvhr_lv0078->lv303=$_POST['txtlv303'];
$lvhr_lv0078->lv304=$_POST['txtlv304'];
$lvhr_lv0078->lv305=$_POST['txtlv305'];
$lvhr_lv0078->lv306=$_POST['txtlv306'];
$lvhr_lv0078->lv307=$_POST['txtlv307'];
$lvhr_lv0078->lv308=$_POST['txtlv308'];
$lvhr_lv0078->lv309=$_POST['txtlv309'];
$lvhr_lv0078->lv310=$_POST['txtlv310'];
$lvhr_lv0078->lv311=$_POST['txtlv311'];
$lvhr_lv0078->lv312=$_POST['txtlv312'];
$lvhr_lv0078->lv313=$_POST['txtlv313'];
$lvhr_lv0078->lv314=$_POST['txtlv314'];
$lvhr_lv0078->lv315=$_POST['txtlv315'];
if($_POST['txtlv321_1']!="" && $_POST['txtlv321_2']!="") $lvhr_lv0078->lv321=Fillnum($_POST['txtlv321_2'],4)."-".Fillnum($_POST['txtlv321_1'],2)."-01";
if($_POST['txtlv322_1']!="" && $_POST['txtlv322_2']!="") $lvhr_lv0078->lv322=Fillnum($_POST['txtlv322_2'],4)."-".Fillnum($_POST['txtlv322_1'],2)."-01";
$lvhr_lv0078->lv323=$_POST['txtlv323'];
$lvhr_lv0078->lv324=$_POST['txtlv324'];
$lvhr_lv0078->lv325=$_POST['txtlv325'];
$lvhr_lv0078->lv326=$_POST['txtlv326'];
$lvhr_lv0078->lv327=$_POST['txtlv327'];
$lvhr_lv0078->lv328=$_POST['txtlv328'];
$lvhr_lv0078->lv329=$_POST['txtlv329'];
$lvhr_lv0078->lv330=$_POST['txtlv330'];
$lvhr_lv0078->lv331=$_POST['txtlv331'];
$lvhr_lv0078->lv332=$_POST['txtlv332'];
$lvhr_lv0078->lv333=$_POST['txtlv333'];
$lvhr_lv0078->lv334=$_POST['txtlv334'];
$lvhr_lv0078->lv335=$_POST['txtlv335'];
if($_POST['txtlv341_1']!="" && $_POST['txtlv341_2']!="") $lvhr_lv0078->lv341=Fillnum($_POST['txtlv341_2'],4)."-".Fillnum($_POST['txtlv341_1'],2)."-01";
if($_POST['txtlv342_1']!="" && $_POST['txtlv342_2']!="") $lvhr_lv0078->lv342=Fillnum($_POST['txtlv342_2'],4)."-".Fillnum($_POST['txtlv342_1'],2)."-01";
$lvhr_lv0078->lv343=$_POST['txtlv343'];
$lvhr_lv0078->lv344=$_POST['txtlv344'];
$lvhr_lv0078->lv345=$_POST['txtlv345'];
$lvhr_lv0078->lv346=$_POST['txtlv346'];
$lvhr_lv0078->lv347=$_POST['txtlv347'];
$lvhr_lv0078->lv348=$_POST['txtlv348'];
$lvhr_lv0078->lv349=$_POST['txtlv349'];
$lvhr_lv0078->lv350=$_POST['txtlv350'];
$lvhr_lv0078->lv351=$_POST['txtlv351'];
$lvhr_lv0078->lv352=$_POST['txtlv352'];
$lvhr_lv0078->lv353=$_POST['txtlv353'];
$lvhr_lv0078->lv354=$_POST['txtlv354'];
$lvhr_lv0078->lv355=$_POST['txtlv355'];
if($vFlag==1)
{
		
		$vresult=$lvhr_lv0078->LV_Insert_No();
		if($vresult==true) {
			//UploadImg($lvhr_lv0078->lv001, $lvhr_lv0078->lv038);///Call function Upload file
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
function UploadImg($folder_name, $fname){
	$maxsize = 3169600;//Max file size 300KMB
	$path = "../../images/interview/";
	$arrName = explode(".", $fname);
		$fname = $arrName[0];///Get name without extention of file
	if(create_folder($path, $folder_name)==true){
		$path = $path.$folder_name."/";
		$result = upload_file($fpath, $fname, $path, $maxsize);
		if($result==1){
			$message = "Image uploaded successfully!";
			//$vFlag = 2;//Upload successful.
			//$fpath = "";
			//$fname = "";
		}
		if($result==2)
			$message = "Incorrect file type!";
		if($result==3 || $result==4)
			$message = "Image size is very small or big!";
		if($result==5 || $result==6)
			$message = "Error in uploading file, please try again!";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>
</head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789. ()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[61];?>");
			o.txtlv002.focus();
			}
		else if(o.txtlv003.value==""){
			alert("<?php echo $vLangArr[59];?>");
			o.txtlv003.focus();
			}
		else if(o.txtlv007.value==""){
			alert("<?php echo $vLangArr[62];?>");
			o.txtlv007.focus();
			}
		else if(o.txtlv008.value==""){
			alert("<?php echo $vLangArr[63];?>");
			o.txtlv008.focus();
			}
		else if(o.txtlv009.value==""){
			alert("<?php echo $vLangArr[64];?>");
			o.txtlv009.focus();
			}
		else if(o.txtlv023.value==""){
			alert("<?php echo 'Số điện thoại không để trống!';?>");
			o.txtlv023.focus();
			}			
		else if(o.txtlv019.value==""){
			alert("<?php echo $vLangArr[67];?>");
			o.txtlv019.focus();
			}
		else if(o.txtlv083.value==""){
			alert("<?php echo 'Ngày nhận việc không để trống!';?>");
			o.txtlv030.focus();
			}
		else if(o.txtlv084.value==""){
			alert("<?php echo 'Lương đề nghị không để trống!';?>");
			o.txtlv084.focus();
			}
		else
			{
				//o.txtlv038.value=o.userfile.value;
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
-->
</script>
<?php
if($lvhr_lv0078->GetAdd()>0)
{
?>
<style>
.table1 td:hover
{
	background:none;
}
</style>
<body onkeyup="KeyPublicRun(event)">
<div id="content_child" >
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"  name="frmadd" id="frmadd"  method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="3" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td colspan="3" height="100%" align="center">
								
								<div style="width: 790px;" ondblclick="this.innerHTML='">
									<table style="width: 790px;" border="1" cellspacing="0" cellpadding="0">
									<tbody>
									<tr style="border:0px;">
									<th style="float: left; width: 180px; height: 70px;">
									<p style="font-size:14px;font-weight:100;margin:0px 0px 0px 0px;"><img alt="" /></p>
									</th> <th style="float: left; width: 363px; height: 70px;">
									<p style="font-size:20px;font-weight:bold;margin:20px 0px 0px 0px;">PHIẾU ĐĂNG K&Yacute; DỰ TUYỂN</p>
									</th> <th style="float: left; width: 180px; height: 70px;">
									<p style="float:left;font-size:12px;font-weight:100;margin:6px 0px 0px 5px;">M&atilde; số: BM-HCNS-04</p>
									<p style="float:left;font-size:12px;font-weight:100;margin:5px 0px 0px 5px;">Lần sữa đổi: 01</p>
									<p style="float:left;font-size:12px;font-weight:100;margin:5px 0px 0px 5px;">Ngày áp dụng: 15/05/2012</p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="font-size: 14px; font-weight: bold; margin: 10px 0px 10px 40px; width: 640px; text-align: center;">Chúng tôi hân hạnh tiếp đón anh (chị) đ&atilde; đến tham gia dự tuyển. để giúp trao đổi thông tin thuận lợi hơn, xin vui l&ograve;ng ghi các thông tin liên quan vào mẩu sau :</p>
									</th>
									</tr>
									<tr style="float:left;border:none;">
									<th style="float: left; width:785px; height: 25px; border-bottom: 1px dotted;">
									<p style="font-size:14px;font-weight:bold;margin:4px 0px 0px 10px;">VỊ TR&Iacute; ỨNG TUYỂN</p>
									</th> <th style="float: left; width: 390px; height: 40px; border-right: 1px dotted; border-top: 0px;">
									<p style="float:left;font-size:14px;font-weight:bold;margin:15px 0px 0px 10px;">
									<em>Ưu tiên 1:</em> 
									<select class="required"  name="txtlv002" id="txtlv002" value="<?php echo $lvhr_lv0078->lv002;?>" tabindex="1"  style="width:280px" onKeyPress="return CheckKey(event,7)"/>
							  <option value=""></option>
							  <?php echo $lvhr_lv0078->LV_LinkField('lv002',$lvhr_lv0078->lv002);?>
							  </select></p>
									</th> <th style="float: left; width: 395px; height: 40px; border-left: 0px; border-top: 0px;">
									<p style="float:left;font-size:14px;font-weight:bold;margin:15px 0px 0px 10px;"><em>Ưu tiên 2:</em> <select  name="txtlv089" id="txtlv089" tabindex="1"  style="width:285px" onKeyPress="return CheckKey(event,7)"/>
										<option value=""></option>
							 <?php echo $lvhr_lv0078->LV_LinkField('lv002',$lvhr_lv0078->lv089);?>
							  </select></p>
									</th>
									</tr>
									<tr>
									<th style="border-bottom:0px;border-left:0px;border-right:0px;">
									<p style="float:left;font-size:14px;font-weight:bold;margin:10px 0px 0px 10px;">1.	Thông tin cá nhân :</p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">-	Họ tên ứng viên : 
									<input class="required" name="txtlv003" type="text" id="txtlv003"  value="<?php echo $lvhr_lv0078->lv003;?>" tabindex="2" maxlength="225" style="width:260px" /> 
									&nbsp;Nam&nbsp;<input type="radio" name="txtlv012" id="txtlv012" tabindex="2" style="width:15px" value="1" <?php echo ($lvhr_lv0078->lv012=='1')?'checked="true"':'';?>/>&nbsp;
									Nữ &nbsp;<input type="radio" name="txtlv012" id="txtlv012" tabindex="2" style="width:15px" value="0" <?php echo ($lvhr_lv0078->lv012=='0')?'checked="true"':'';?>/>&nbsp;
									Ngày sinh : <input class="required" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv010);return false;" name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvhr_lv0078->lv010;?>" tabindex="2" maxlength="50" style="width:140px" />
										<span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv010);return false;" /> </span></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">
									-	Số CMND : <input class="required"  name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvhr_lv0078->lv007;?>" tabindex="3" maxlength="15" style="width:160px;" /> 
									Ngày cấp : <input class="required" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv008);return false;" name="txtlv008" type="text" id="txtlv008" value="<?php echo $lvhr_lv0078->lv008;?>" tabindex="3" maxlength="50" style="width:140px;" >
						      <span class="td"> <img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv008);return false;" /></span> 
									Nơi cấp : <input class="required" name="txtlv009" type="text" id="txtlv009" value="<?php echo $lvhr_lv0078->lv009;?>" tabindex="3" maxlength="50" style="width:200px;" ></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">
									-	Tel liên hệ : <input class="required"   name="txtlv023" type="text" id="txtlv023" value="<?php echo $lvhr_lv0078->lv023;?>" tabindex="4" maxlength="20" style="width:320px;" />  
									Email : <input name="txtlv024" type="text" id="txtlv024"  value="<?php echo $lvhr_lv0078->lv024;?>" tabindex="4" maxlength="100" style="width:290px;" /></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">
									-	Hộ khẩu thường trú : <input class="required"  name="txtlv019" type="text" id="txtlv019" value="<?php echo $lvhr_lv0078->lv019;?>" tabindex="5" maxlength="500" style="width:600px;" /></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">
									-	Địa chỉ cư ngụ (hoặc tạm trú) : <input name="txtlv020" type="text" id="txtlv020" value="<?php echo $lvhr_lv0078->lv020;?>" tabindex="6" maxlength="500" style="width:540px" ></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">-	Tình trạng sức khoẻ :  
									chiều cao : <input name="txtlv069" type="text" id="txtlv069" value="<?php echo $lvhr_lv0078->lv069;?>" tabindex="7" maxlength="30" style="width:90px" >
									cân nặng : <input name="txtlv070" type="text" id="txtlv070" value="<?php echo $lvhr_lv0078->lv070;?>" tabindex="7" maxlength="30" style="width:90px" >
									khuyết tật (nếu có) : <input name="txtlv071" type="text" id="txtlv071" value="<?php echo $lvhr_lv0078->lv071;?>" tabindex="7" maxlength="30" style="width:100px" ></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">-	Tình trạng gia đình : 
									Độc thân&nbsp;<input type="radio" name="txtlv016" id="txtlv016" tabindex="7" style="width:15px" value="0" <?php echo ($lvhr_lv0078->lv016=='0')?'checked="true"':'';?> />&nbsp;
									Có gia đình&nbsp;<input type="radio" name="txtlv016" id="txtlv016" tabindex="7" style="width:15px" value="1" <?php echo ($lvhr_lv0078->lv016=='1')?'checked="true"':'';?>/>&nbsp;
									Ly thân, li dị&nbsp;<input type="radio" name="txtlv016" id="txtlv016" tabindex="7" style="width:15px" value="2" <?php echo ($lvhr_lv0078->lv016=='2')?'checked="true"':'';?>/>&nbsp;
									Số con : <input name="txtlv072" type="text" id="txtlv072" value="<?php echo $lvhr_lv0078->lv072;?>" tabindex="7" maxlength="30" style="width:100px" ></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:bold;margin:5px 0px 5px 20px;text-align:left;">2.	Quá trình học tập, đào tạo và các khoá huấn luyện ngắn hạn : (chỉ ghi những bằng cấp, chứng chỉ quan trọng)</p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width: 285px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;">Tên, địa chỉ trường, nơi đào tạo</p>
									</th> 
									<th style="float: left; width: 135px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;">Loại hình  đào tạo</p>
									</th> <th style="float: left; width: 119px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;">Chuyên nghành</p>
									</th> <th style="float: left; width: 125px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;">Tốt nghiệp LOẠI</p>
									</th> <th style="float: left; width: 114px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;">Thời gian học</p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width: 285px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv201" type="text" id="txtlv201" value="<?php echo $lvhr_lv0078->lv201;?>" tabindex="7" maxlength="30" style="width:280px;text-align:left" ></p>
									</th> <th style="float: left; width: 135px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv202" type="text" id="txtlv202" value="<?php echo $lvhr_lv0078->lv202;?>" tabindex="7" maxlength="30" style="width:115px;text-align:left" ></p>
									</th> <th style="float: left; width: 119px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv203" type="text" id="txtlv203" value="<?php echo $lvhr_lv0078->lv203;?>" tabindex="7" maxlength="30" style="width:115px;text-align:left" ></p>
									</th> <th style="float: left; width: 125px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv204" type="text" id="txtlv204" value="<?php echo $lvhr_lv0078->lv204;?>" tabindex="7" maxlength="30" style="width:115px;text-align:left" ></p>
									</th> <th style="float: left; width: 114px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv205" type="text" id="txtlv205" value="<?php echo $lvhr_lv0078->lv205;?>" tabindex="7" maxlength="30" style="width:100px;text-align:left" ></p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width: 285px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv211" type="text" id="txtlv211" value="<?php echo $lvhr_lv0078->lv211;?>" tabindex="7" maxlength="30" style="width:280px;text-align:left" ></p>
									</th> <th style="float: left; width: 135px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv212" type="text" id="txtlv212" value="<?php echo $lvhr_lv0078->lv212;?>" tabindex="7" maxlength="30" style="width:115px;text-align:left" ></p>
									</th> <th style="float: left; width: 119px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv213" type="text" id="txtlv213" value="<?php echo $lvhr_lv0078->lv213;?>" tabindex="7" maxlength="30" style="width:115px;text-align:left" ></p>
									</th> <th style="float: left; width: 125px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv214" type="text" id="txtlv214" value="<?php echo $lvhr_lv0078->lv214;?>" tabindex="7" maxlength="30" style="width:115px;text-align:left" ></p>
									</th> <th style="float: left; width: 114px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv215" type="text" id="txtlv215" value="<?php echo $lvhr_lv0078->lv215;?>" tabindex="7" maxlength="30" style="width:100px;text-align:left" ></p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width: 285px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv221" type="text" id="txtlv221" value="<?php echo $lvhr_lv0078->lv221;?>" tabindex="7" maxlength="30" style="width:280px;text-align:left" ></p>
									</th> <th style="float: left; width: 135px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv222" type="text" id="txtlv222" value="<?php echo $lvhr_lv0078->lv222;?>" tabindex="7" maxlength="30" style="width:115px;text-align:left" ></p>
									</th> <th style="float: left; width: 119px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv223" type="text" id="txtlv223" value="<?php echo $lvhr_lv0078->lv223;?>" tabindex="7" maxlength="30" style="width:115px;text-align:left" ></p>
									</th> <th style="float: left; width: 125px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv224" type="text" id="txtlv224" value="<?php echo $lvhr_lv0078->lv224;?>" tabindex="7" maxlength="30" style="width:115px;text-align:left" ></p>
									</th> <th style="float: left; width: 114px; height: 35px;">
									<p style="font-size:14px;font-weight:100;margin:10px 0px 0px 0px;"><input name="txtlv225" type="text" id="txtlv225" value="<?php echo $lvhr_lv0078->lv225;?>" tabindex="7" maxlength="30" style="width:100px;text-align:left" ></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:bold;margin:5px 0px 5px 20px;text-align:left;">3.	Quá trình làm việc : (ghi những thời gian gần nhất, quá trình làm việc ch&iacute;nh vào ô trên cùng)</p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width:100px; height: 195px;">
									<p style="font-size:14px;font-weight:100;margin:30px 0px 0px 0px;text-align:center;padding:5px;">Thời gian công tác: <br/>Từ tháng<br/><input name="txtlv301_1" type="text" id="txtlv301_1" value="<?php echo getmonth($lvhr_lv0078->lv301);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv301_2" type="text" id="txtlv301_2" value="<?php echo getyear($lvhr_lv0078->lv301);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" >
									<br/>Đến tháng<br/><input name="txtlv302_1" type="text" id="txtlv302_1" value="<?php echo getmonth($lvhr_lv0078->lv302);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv302_2" type="text" id="txtlv302_2" value="<?php echo getyear($lvhr_lv0078->lv302);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" ></p>
									</th> <th style="float: left; width: 684px; height: 195px;">
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Tên đơn vị : <input name="txtlv303" type="text" id="txtlv303" value="<?php echo $lvhr_lv0078->lv303;?>" tabindex="9" maxlength="100" style="width:280px;text-align:left" > Ngành họat động : <input name="txtlv304" type="text" id="txtlv304" value="<?php echo $lvhr_lv0078->lv304;?>" tabindex="9" maxlength="50" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Địa chỉ : <input name="txtlv305" type="text" id="txtlv305" value="<?php echo $lvhr_lv0078->lv305;?>" tabindex="9" maxlength="50" style="width:370px;text-align:left" > Quy mô : <input name="txtlv306" type="text" id="txtlv306" value="<?php echo $lvhr_lv0078->lv306;?>" tabindex="9" maxlength="30" style="width:130px;text-align:left" > Người</p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Nhiệm vụ khi mới vào: <input name="txtlv307" type="text" id="txtlv307" value="<?php echo $lvhr_lv0078->lv307;?>" tabindex="9" maxlength="50" style="width:220px;text-align:left" > Chức vụ sau cùng: <input name="txtlv308" type="text" id="txtlv308" value="<?php echo $lvhr_lv0078->lv308;?>" tabindex="9" maxlength="50" style="width:170px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Quản lý bao nhiêu nhân viên : <input name="txtlv309" type="text" id="txtlv309" value="<?php echo $lvhr_lv0078->lv309;?>" tabindex="9" maxlength="30" style="width:120px;text-align:left" >  Toàn bộ phận có bao nhiêu người : <input name="txtlv310" type="text" id="txtlv310" value="<?php echo $lvhr_lv0078->lv310;?>" tabindex="9" maxlength="30" style="width:123px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Mức lương khi mới vào: <input name="txtlv311" type="text" id="txtlv311" value="<?php echo $lvhr_lv0078->lv311;?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" > mức lương cuối cùng: <input name="txtlv312" type="text" id="txtlv312" value="<?php echo $lvhr_lv0078->lv312;?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Lý do nghỉ việc : <input name="txtlv313" type="text" id="txtlv313" value="<?php echo $lvhr_lv0078->lv313;?>" tabindex="9" maxlength="30" style="width:553px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Người liên hệ tham khảo : <input name="txtlv314" type="text" id="txtlv314" value="<?php echo $lvhr_lv0078->lv314;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" > sđt: <input name="txtlv315" type="text" id="txtlv315" value="<?php echo $lvhr_lv0078->lv315;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" ></p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width:100px; height: 195px;">
									<p style="font-size:14px;font-weight:100;margin:30px 0px 0px 0px;text-align:center;padding:5px;">Thời gian công tác: <br/>Từ tháng<br/><input name="txtlv321_1" type="text" id="txtlv321_1" value="<?php echo getmonth($lvhr_lv0078->lv321);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv321_2" type="text" id="txtlv321_2" value="<?php echo getyear($lvhr_lv0078->lv321);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" >
									<br/>Đến tháng<br/><input name="txtlv322_1" type="text" id="txtlv322_1" value="<?php echo getmonth($lvhr_lv0078->lv322);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv322_2" type="text" id="txtlv322_2" value="<?php echo getyear($lvhr_lv0078->lv322);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" ></p>
									</th> <th style="float: left; width: 684px; height: 195px;">
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Tên đơn vị : <input name="txtlv323" type="text" id="txtlv323" value="<?php echo $lvhr_lv0078->lv323;?>" tabindex="9" maxlength="100" style="width:280px;text-align:left" > Ngành họat động : <input name="txtlv324" type="text" id="txtlv324" value="<?php echo $lvhr_lv0078->lv324;?>" tabindex="9" maxlength="50" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Địa chỉ : <input name="txtlv325" type="text" id="txtlv325" value="<?php echo $lvhr_lv0078->lv325;?>" tabindex="9" maxlength="50" style="width:370px;text-align:left" > Quy mô : <input name="txtlv326" type="text" id="txtlv326" value="<?php echo $lvhr_lv0078->lv326;?>" tabindex="9" maxlength="30" style="width:130px;text-align:left" > Người</p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Nhiệm vụ khi mới vào: <input name="txtlv327" type="text" id="txtlv327" value="<?php echo $lvhr_lv0078->lv327;?>" tabindex="9" maxlength="50" style="width:220px;text-align:left" > Chức vụ sau cùng: <input name="txtlv328" type="text" id="txtlv328" value="<?php echo $lvhr_lv0078->lv328;?>" tabindex="9" maxlength="50" style="width:170px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Quản lý bao nhiêu nhân viên : <input name="txtlv329" type="text" id="txtlv329" value="<?php echo $lvhr_lv0078->lv329;?>" tabindex="9" maxlength="30" style="width:120px;text-align:left" >  Toàn bộ phận có bao nhiêu người : <input name="txtlv330" type="text" id="txtlv330" value="<?php echo $lvhr_lv0078->lv330;?>" tabindex="9" maxlength="30" style="width:123px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Mức lương khi mới vào: <input name="txtlv331" type="text" id="txtlv331" value="<?php echo $lvhr_lv0078->lv331;?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" > mức lương cuối cùng: <input name="txtlv332" type="text" id="txtlv332" value="<?php echo $lvhr_lv0078->lv332;?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Lý do nghỉ việc : <input name="txtlv333" type="text" id="txtlv333" value="<?php echo $lvhr_lv0078->lv333;?>" tabindex="9" maxlength="30" style="width:553px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Người liên hệ tham khảo : <input name="txtlv334" type="text" id="txtlv334" value="<?php echo $lvhr_lv0078->lv334;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" > sđt: <input name="txtlv315" type="text" id="txtlv315" value="<?php echo $lvhr_lv0078->lv315;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" ></p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width:100px; height: 195px;">
									<p style="font-size:14px;font-weight:100;margin:30px 0px 0px 0px;text-align:center;padding:5px;">Thời gian công tác: <br/>Từ tháng<br/><input name="txtlv341_1" type="text" id="txtlv341_1" value="<?php echo getmonth($lvhr_lv0078->lv341);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv341_2" type="text" id="txtlv341_2" value="<?php echo getyear($lvhr_lv0078->lv341);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" >
									<br/>Đến tháng<br/><input name="txtlv342_1" type="text" id="txtlv342_1" value="<?php echo getmonth($lvhr_lv0078->lv342);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv342_2" type="text" id="txtlv342_2" value="<?php echo getyear($lvhr_lv0078->lv342);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" ></p>
									</th> <th style="float: left; width: 684px; height: 195px;">
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Tên đơn vị : <input name="txtlv343" type="text" id="txtlv343" value="<?php echo $lvhr_lv0078->lv343;?>" tabindex="9" maxlength="100" style="width:280px;text-align:left" > Ngành họat động : <input name="txtlv344" type="text" id="txtlv344" value="<?php echo $lvhr_lv0078->lv344;?>" tabindex="9" maxlength="50" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Địa chỉ : <input name="txtlv345" type="text" id="txtlv345" value="<?php echo $lvhr_lv0078->lv345;?>" tabindex="9" maxlength="50" style="width:370px;text-align:left" > Quy mô : <input name="txtlv346" type="text" id="txtlv346" value="<?php echo $lvhr_lv0078->lv346;?>" tabindex="9" maxlength="30" style="width:130px;text-align:left" > Người</p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Nhiệm vụ khi mới vào: <input name="txtlv347" type="text" id="txtlv347" value="<?php echo $lvhr_lv0078->lv347;?>" tabindex="9" maxlength="50" style="width:220px;text-align:left" > Chức vụ sau cùng: <input name="txtlv348" type="text" id="txtlv348" value="<?php echo $lvhr_lv0078->lv348;?>" tabindex="9" maxlength="50" style="width:170px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Quản lý bao nhiêu nhân viên : <input name="txtlv349" type="text" id="txtlv349" value="<?php echo $lvhr_lv0078->lv349;?>" tabindex="9" maxlength="30" style="width:120px;text-align:left" >  Toàn bộ phận có bao nhiêu người : <input name="txtlv350" type="text" id="txtlv350" value="<?php echo $lvhr_lv0078->lv350;?>" tabindex="9" maxlength="30" style="width:123px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Mức lương khi mới vào: <input name="txtlv351" type="text" id="txtlv351" value="<?php echo $lvhr_lv0078->lv351;?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" > mức lương cuối cùng: <input name="txtlv352" type="text" id="txtlv352" value="<?php echo $lvhr_lv0078->lv352;?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Lý do nghỉ việc : <input name="txtlv353" type="text" id="txtlv353" value="<?php echo $lvhr_lv0078->lv353;?>" tabindex="9" maxlength="30" style="width:553px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Người liên hệ tham khảo : <input name="txtlv354" type="text" id="txtlv354" value="<?php echo $lvhr_lv0078->lv354;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" > sđt: <input name="txtlv355" type="text" id="txtlv355" value="<?php echo $lvhr_lv0078->lv355;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" ></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:bold;margin:5px 0px 5px 20px;text-align:left;"><span style="text-decoration: underline;">4. câu hỏi sơ vấn</span></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Anh (Chị) sử dụng được các phần mềm ứng dụng : <input type="checkbox" value="word" name="txtlv033_1" id="txtlv033_1" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvhr_lv0078->lv033.";",";word;")===false)?'':'checked="checked"';?>/> word, <input type="checkbox" value="excel" name="txtlv033_2" id="txtlv033_2" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvhr_lv0078->lv033.";",";excel;")===false)?'':'checked="checked"';?>/> excel, <input type="checkbox" value="access" name="txtlv033_3" id="txtlv033_3" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvhr_lv0078->lv033.";",";access;")===false)?'':'checked="checked"';?>/> access, <input type="checkbox" value="powerpoint" name="txtlv033_4" id="txtlv033_4" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvhr_lv0078->lv033.";",";powerpoint;")===false)?'':'checked="checked"';?>/> powerpoint, <input type="checkbox" value="mạng nội bộ" name="txtlv033_5" id="txtlv033_5" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvhr_lv0078->lv033.";",";mạng nội bộ;")===false)?'':'checked="checked"';?>/> mạng nội bộ, <input type="checkbox" value="autocad" name="txtlv033_6" id="txtlv033_6" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvhr_lv0078->lv033.";",";autocad;")===false)?'':'checked="checked"';?>/> autocad, <input type="checkbox" value="coreldraw" name="txtlv033_7" id="txtlv033_7" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvhr_lv0078->lv033.";",";coreldraw;")===false)?'':'checked="checked"';?>/> coreldraw, <input type="checkbox" value="foxpro" name="txtlv033_8" id="txtlv033_8" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvhr_lv0078->lv033.";",";foxpro;")===false)?'':'checked="checked"';?>/> foxpro, <input type="checkbox" value="email/internet" name="txtlv033_9" id="txtlv033_9" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvhr_lv0078->lv033.";",";email/internet;")===false)?'':'checked="checked"';?>/> email/internet, phần mềm khác :<input name="txtlv088" type="text" id="txtlv088" value="<?php echo $lvhr_lv0078->lv088;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" ></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Anh (chị) thấy t&iacute;nh chất công việc mình dự tuyển có khó không:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;không <input type="radio" name="txtlv073" id="txtlv073" tabindex="9" style="width:15px" value="0" <?php echo ($lvhr_lv0078->lv073=='0')?'checked="true"':'';?>/> Có <input type="radio" name="txtlv073" id="txtlv073" tabindex="9" style="width:15px" value="1" <?php echo ($lvhr_lv0078->lv073=='1')?'checked="true"':'';?>/></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	khả năng làm việc ngoài giờ, chủ nhật :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Có <input type="radio" name="txtlv074" id="txtlv074" tabindex="9" style="width:15px" value="1" <?php echo ($lvhr_lv0078->lv074=='1')?'checked="true"':'';?>/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Đôi khi <input type="radio" name="txtlv074" id="txtlv074" tabindex="9" style="width:15px" value="2" <?php echo ($lvhr_lv0078->lv074=='2')?'checked="true"':'';?>/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Không <input type="radio" name="txtlv074" id="txtlv074" tabindex="9" style="width:15px" value="0" <?php echo ($lvhr_lv0078->lv074=='0')?'checked="true"':'';?>/></p>
									</th>
									</tr>
									<tr>
									<th>				
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Theo anh (chị) công việc này cần những yêu cầu kỹ năng gì: </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv075" id="txtlv075"  tabindex="9" style="width:530px;text-align:left"><?php echo $lvhr_lv0078->lv075;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Các kỷ năng chuyên môn anh (chị) thông thạo nhất ? </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv076" id="txtlv076"  tabindex="9" style="width:530px;text-align:left"><?php echo $lvhr_lv0078->lv076;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Năng khiếu, điểm mạnh của anh chị: </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv034" id="txtlv034  tabindex="9" style="width:530px;text-align:left"><?php echo $lvhr_lv0078->lv034;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Điểm yếu, khuyết của anh chị (về kỷ năng chuyên môn, t&iacute;nh cách&hellip;  cần r&egrave;n luyện thêm.): </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv035" id="txtlv035"  tabindex="9" style="width:530px;text-align:left"><?php echo $lvhr_lv0078->lv035;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Định hướng nghề nghiệp trong 02 - 03 năm tới của anh chị ? : </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv077" id="txtlv077"  tabindex="9" style="width:530px;text-align:left"><?php echo $lvhr_lv0078->lv077;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Lý do ch&iacute;nh anh/chị muốn vào làm việc tại công ty TDL ME và nhận thấy mình phù hợp với công việc dự tuyển: </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv078" id="txtlv078"  tabindex="9" style="width:530px;text-align:left;height:60px;"><?php echo $lvhr_lv0078->lv078;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Bạn có đánh giá được giá trị sức lao động của mình không:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Không  <input type="radio" name="txtlv079" id="txtlv079" tabindex="10" style="width:15px" value="0" <?php echo ($lvhr_lv0078->lv079=='0')?'checked="true"':'';?>/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Có  <input type="radio" name="txtlv079" id="txtlv079" tabindex="10" style="width:15px" value="1" <?php echo ($lvhr_lv0078->lv079=='1')?'checked="true"':'';?>/></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Theo bạn, chúng tôi có nhận ra những câu trả lời không trung thực của bạn không: Không <input type="radio" name="txtlv080" id="txtlv080" tabindex="10" style="width:15px" value="0" <?php echo ($lvhr_lv0078->lv080=='0')?'checked="true"':'';?>/> Có <input type="radio" name="txtlv080" id="txtlv080" tabindex="10" style="width:15px" value="1" <?php echo ($lvhr_lv0078->lv080=='1')?'checked="true"':'';?>/></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Anh (chị) có người thân, bạn b&egrave; đang làm việc tại TDL ME ?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;không <input type="radio" name="txtlv081" id="txtlv081" tabindex="10" style="width:15px" value="0" <?php echo ($lvhr_lv0078->lv081=='0')?'checked="true"':'';?>/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;có <input type="radio" name="txtlv081" id="txtlv081" tabindex="10" style="width:15px" value="1" <?php echo ($lvhr_lv0078->lv081=='1')?'checked="true"':'';?>/></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Anh (chị) có thường thay đổi số điện thoại di động không?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Không <input type="radio" name="txtlv082" id="txtlv082" tabindex="10" style="width:15px" value="0" <?php echo ($lvhr_lv0078->lv082=='0')?'checked="true"':'';?>/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Có <input type="radio" name="txtlv082" id="txtlv082" tabindex="10" style="width:15px" value="1" <?php echo ($lvhr_lv0078->lv082=='1')?'checked="true"':'';?>/></p>
									</th>
									</tr>
									<tr style="float:right;">
									<th style="float: right; width: 280px; height: 232px;">
									<p style=";font-size:14px;font-weight:bold;margin:10px 0px 5px 20px;text-align:center;"><span style="text-decoration: underline;"><em>Phần ghi chú của Công ty:</em></span></p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width: 504px; height: 110px;">
									<p style="float:left;font-size:14px;font-weight:100;margin:10px 0px 5px 20px;text-align:left;">Ngày có thể nhận việc : <input class="required" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv083);return false;" name="txtlv083" type="text" id="txtlv083" value="<?php echo $lvhr_lv0078->lv083;?>" tabindex="11" maxlength="50" style="width:140px;" >
						      <span class="td"> <img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv083);return false;" /></span></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">Lương đề nghị : <input name="txtlv084" type="text" id="txtlv084" value="<?php echo $lvhr_lv0078->lv084;?>" tabindex="11" maxlength="30" style="width:130px;text-align:left" > Sau thử việc <input name="txtlv085" type="text" id="txtlv085" value="<?php echo $lvhr_lv0078->lv085;?>" tabindex="11" maxlength="30" style="width:140px;text-align:left" ></p>
									<p style="float:left;font-size:16px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">Đề nghị khác : <input name="txtlv087" type="text" id="txtlv087" value="<?php echo $lvhr_lv0078->lv087;?>" tabindex="11" maxlength="30" style="width:354px;text-align:left" ></p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width: 504px; height: 120px;">
									<p style="float:left;font-size:14px;font-weight:100;margin:10px 0px 5px 20px;text-align:left;">Tôi cam đoan các thông tin kê khai trên là đúng sự thật. nếu có gì sai trái</p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">tôi xin hoàn toàn chịu trách nhiệm liên quan.</p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">Chữ ký của ứng viên : &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">Ngày :&hellip;&hellip;&hellip;/&hellip;&hellip;&hellip;/&hellip;&hellip;&hellip;&hellip;</p>
									</th>
									</tr>
									</tbody>
									</table>
									</div>
								</td>
							</tr>			  							  							  							  							  							  							  																			
							<tr>
							  <td  height="20" colspan="3"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20" colspan="3"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="50"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="51"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="52"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>	

				
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript"> var o=document.frmadd; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
		o.txtlv001.focus();
</script>

<script language="javascript" src="../../javascripts/menupopup.js"></script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		Cancel();
	//-->
	</script>
	<?php
	}
	?>
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>