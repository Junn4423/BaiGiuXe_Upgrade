<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
$vDir  = '';if (isset( $_GET['ID']) &&  $_GET['ID'] != "") $vDir = '../';
include($vDir."paras.php");
require_once($vDir."../clsall/lv_controler.php");
require_once($vDir."../clsall/ki_lv0005.php");
/////////////init object//////////////
$lvki_lv0005=new ki_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0006');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvki_lv0005->lv001=$_GET['ChildID'];
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","HR0181.txt",$plang);
$lvki_lv0005->lang=strtoupper($plang.'');
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
if($vFlag==1)
{
	$lvki_lv0005->lv002=$_POST['txtlv002'];
	$lvki_lv0005->lv003=$_POST['txtlv003'];
	$lvki_lv0005->lv004=$_POST['txtlv004'];
	$lvki_lv0005->lv005=$_POST['txtlv005'];
	$lvki_lv0005->lv006=$_POST['txtlv006'];
	$lvki_lv0005->lv007=$_POST['txtlv007'];	
	$vresult=$lvki_lv0005->LV_Update();
	if($vresult==true) {
		if($_FILES['userfile']['name']!="")
		$vStrMessage=$vLangArr[11];
		$vFlag = 1;
	} else{
		$vStrMessage=$vLangArr[12].sof_error();		
		$vFlag = 0;
	}
}
else
{
	if(trim($lvki_lv0005->lv001)!="" || $lvki_lv0005->lv001!=NULL) 
	{
		$lvki_lv0005->LV_LoadID($lvki_lv0005->lv001);
		if($lvki_lv0005->lv001!=NULL && $lvki_lv0005->lv001!="")
		{
			$lvki_lv0005->lv008 = $lvki_lv0005->FormatView($lvki_lv0005->lv008,2);
			$lvki_lv0005->lv010 = $lvki_lv0005->FormatView($lvki_lv0005->lv010,2);
			$lvki_lv0005->lv040 = $lvki_lv0005->FormatView($lvki_lv0005->lv040,2);
			$lvki_lv0005->lv083 = $lvki_lv0005->FormatView($lvki_lv0005->lv083,2);
		}
	}
}

function DelFiles($path, $vFileName){
	if (is_dir($path)) {
		if ($dh = opendir($path)) {
			while (($file = readdir($dh)) !== false) {
				if(!(is_dir($path.$file) && $file!="." && $file!=".."  )) {
					if($file!=$vFileName && $file!="index.html") delete_file($path.$file);
				}
			}
			closedir($dh);
		}
	}
	//return $files;
}
function UploadImg($folder_name,$folderemp, $fname){
	$maxsize = 3169600;//Max file size 300kb
	$path = $folder_name.$folderemp."/";
	if( !is_dir($path )) create_folder( $folder_name,$folderemp);
	$vFileName = $fname;
	$arrName = explode(".", $fname);
		$fname = $arrName[0];///Get name without extention of file
	$result = upload_file($fpath, $fname, $path, $maxsize);
	if($result==1){
		$message = "Image uploaded successfully!";
		DelFiles($path, $vFileName);///Remove all other file
	}
	if($result==2)
		$message = "Incorrect file type!";
	if($result==3 || $result==4)
		$message = "Image size is very small or big!";
	if($result==5 || $result==6)
		$message = "Error in uploading file, please try again!";
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
<script language="javascript" src="../../javascripts/engines.js"></script></head>
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
		var o=document.frmedit;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmedit;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
	o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmedit;
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
if($lvki_lv0005->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmedit" id="frmedit" method="post" enctype="multipart/form-data">
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
									<p style="font-size:20px;font-weight:bold;margin:20px 0px 0px 0px;">PHIẾU ĐÁNH GIÁ KPI</p>
									</th> <th style="float: left; width: 180px; height: 70px;">
									<p style="float:left;font-size:12px;font-weight:100;margin:6px 0px 0px 5px;">M&atilde; số: HCNS-01</p>
									<p style="float:left;font-size:12px;font-weight:100;margin:5px 0px 0px 5px;">Lần sữa đổi: 01</p>
									<p style="float:left;font-size:12px;font-weight:100;margin:5px 0px 0px 5px;">Ngày áp dụng: 01/01/2018</p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="font-size: 14px; font-weight: bold; margin: 10px 0px 10px 40px; width: 640px; text-align: center;">CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG đánh giá nhân viên với những tiêu chí sau:</p>
									</th>
									</tr>
									<tr style="float:left;border:none;">
									<th style="float: left; width:785px; height: 25px; border-bottom: 1px dotted;">
									<p style="font-size:14px;font-weight:bold;margin:4px 0px 0px 10px;">VỊ TR&Iacute; ỨNG TUYỂN</p>
									</th> <th style="float: left; width: 390px; height: 40px; border-right: 1px dotted; border-top: 0px;">
									<p style="float:left;font-size:14px;font-weight:bold;margin:15px 0px 0px 10px;">
									<em>Nhân viên:</em> 
										<select class="required"  name="txtlv002" id="txtlv002" value="<?php echo $lvki_lv0005->lv002;?>" tabindex="1"  style="width:280px" onKeyPress="return CheckKey(event,7)"/>
										  <option value=""></option>
										  <?php echo $lvki_lv0005->LV_LinkField('lv002',$lvki_lv0005->lv002);?>
										  </select></p>
												</th> <th style="float: left; width: 395px; height: 40px; border-left: 0px; border-top: 0px;">
												<p style="float:left;font-size:14px;font-weight:bold;margin:15px 0px 0px 10px;"><em>KPI:</em> <select  name="txtlv089" id="txtlv089" tabindex="1"  style="width:285px" onKeyPress="return CheckKey(event,7)"/>
													<option value=""></option>
										 <?php echo $lvki_lv0005->LV_LinkField('lv004',$lvki_lv0005->lv004);?>
										 </select></p>
									</th>
									</tr>
									<tr>
									<th style="border-bottom:0px;border-left:0px;border-right:0px;">
									<p style="float:left;font-size:14px;font-weight:bold;margin:10px 0px 0px 10px;">1.	Thông tin cá nhân :</p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">-	Họ tên ứng viên : 
									<input class="required" name="txtlv003" type="text" id="txtlv003"  value="<?php echo $lvki_lv0005->lv003;?>" tabindex="2" maxlength="225" style="width:260px" /> 
									&nbsp;Nam&nbsp;<input type="radio" name="txtlv012" id="txtlv012" tabindex="2" style="width:15px" value="1" <?php echo ($lvki_lv0005->lv012=='1')?'checked="true"':'';?>/>&nbsp;
									Nữ &nbsp;<input type="radio" name="txtlv012" id="txtlv012" tabindex="2" style="width:15px" value="0" <?php echo ($lvki_lv0005->lv012=='0')?'checked="true"':'';?>/>&nbsp;
									Ngày sinh : <input class="required" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv010);return false;" name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvki_lv0005->lv010;?>" tabindex="2" maxlength="50" style="width:140px" />
										<span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv010);return false;" /> </span></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">
									-	Số CMND : <input class="required"  name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvki_lv0005->lv007;?>" tabindex="3" maxlength="15" style="width:160px;" /> 
									Ngày cấp : <input class="required" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv008);return false;" name="txtlv008" type="text" id="txtlv008" value="<?php echo $lvki_lv0005->lv008;?>" tabindex="3" maxlength="50" style="width:140px;" >
						      <span class="td"> <img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv008);return false;" /></span> 
									Nơi cấp : <input class="required" name="txtlv009" type="text" id="txtlv009" value="<?php echo $lvki_lv0005->lv009;?>" tabindex="3" maxlength="50" style="width:200px;" ></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">
									-	Tel liên hệ : <input class="required"   name="txtlv023" type="text" id="txtlv023" value="<?php echo $lvki_lv0005->lv023;?>" tabindex="4" maxlength="20" style="width:320px;" />  
									Email : <input name="txtlv024" type="text" id="txtlv024"  value="<?php echo $lvki_lv0005->lv024;?>" tabindex="4" maxlength="100" style="width:290px;" /></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">
									-	Hộ khẩu thường trú : <input class="required"  name="txtlv019" type="text" id="txtlv019" value="<?php echo $lvki_lv0005->lv019;?>" tabindex="5" maxlength="500" style="width:600px;" /></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">
									-	Địa chỉ cư ngụ (hoặc tạm trú) : <input name="txtlv020" type="text" id="txtlv020" value="<?php echo $lvki_lv0005->lv020;?>" tabindex="6" maxlength="500" style="width:540px" ></p>
									</th>
									</tr>
									
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:bold;margin:5px 0px 5px 20px;text-align:left;"><span style="text-decoration: underline;">4. câu hỏi sơ vấn</span></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Anh (Chị) sử dụng được các phần mềm ứng dụng : <input type="checkbox" value="word" name="txtlv033_1" id="txtlv033_1" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvki_lv0005->lv033.";",";word;")===false)?'':'checked="checked"';?>/> word, <input type="checkbox" value="excel" name="txtlv033_2" id="txtlv033_2" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvki_lv0005->lv033.";",";excel;")===false)?'':'checked="checked"';?>/> excel, <input type="checkbox" value="access" name="txtlv033_3" id="txtlv033_3" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvki_lv0005->lv033.";",";access;")===false)?'':'checked="checked"';?>/> access, <input type="checkbox" value="powerpoint" name="txtlv033_4" id="txtlv033_4" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvki_lv0005->lv033.";",";powerpoint;")===false)?'':'checked="checked"';?>/> powerpoint, <input type="checkbox" value="mạng nội bộ" name="txtlv033_5" id="txtlv033_5" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvki_lv0005->lv033.";",";mạng nội bộ;")===false)?'':'checked="checked"';?>/> mạng nội bộ, <input type="checkbox" value="autocad" name="txtlv033_6" id="txtlv033_6" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvki_lv0005->lv033.";",";autocad;")===false)?'':'checked="checked"';?>/> autocad, <input type="checkbox" value="coreldraw" name="txtlv033_7" id="txtlv033_7" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvki_lv0005->lv033.";",";coreldraw;")===false)?'':'checked="checked"';?>/> coreldraw, <input type="checkbox" value="foxpro" name="txtlv033_8" id="txtlv033_8" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvki_lv0005->lv033.";",";foxpro;")===false)?'':'checked="checked"';?>/> foxpro, <input type="checkbox" value="email/internet" name="txtlv033_9" id="txtlv033_9" tabindex="9" style="width:15px" <?php echo (strpos(";".$lvki_lv0005->lv033.";",";email/internet;")===false)?'':'checked="checked"';?>/> email/internet, phần mềm khác :<input name="txtlv088" type="text" id="txtlv088" value="<?php echo $lvki_lv0005->lv088;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" ></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Anh (chị) thấy t&iacute;nh chất công việc mình dự tuyển có khó không:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;không <input type="radio" name="txtlv073" id="txtlv073" tabindex="9" style="width:15px" value="0" <?php echo ($lvki_lv0005->lv073=='0')?'checked="true"':'';?>/> Có <input type="radio" name="txtlv073" id="txtlv073" tabindex="9" style="width:15px" value="1" <?php echo ($lvki_lv0005->lv073=='1')?'checked="true"':'';?>/></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	khả năng làm việc ngoài giờ, chủ nhật :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Có <input type="radio" name="txtlv074" id="txtlv074" tabindex="9" style="width:15px" value="1" <?php echo ($lvki_lv0005->lv074=='1')?'checked="true"':'';?>/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Đôi khi <input type="radio" name="txtlv074" id="txtlv074" tabindex="9" style="width:15px" value="2" <?php echo ($lvki_lv0005->lv074=='2')?'checked="true"':'';?>/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Không <input type="radio" name="txtlv074" id="txtlv074" tabindex="9" style="width:15px" value="0" <?php echo ($lvki_lv0005->lv074=='0')?'checked="true"':'';?>/></p>
									</th>
									</tr>
									<tr>
									<th>				
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Theo anh (chị) công việc này cần những yêu cầu kỹ năng gì: </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv075" id="txtlv075"  tabindex="9" style="width:530px;text-align:left"><?php echo $lvki_lv0005->lv075;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Các kỷ năng chuyên môn anh (chị) thông thạo nhất ? </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv076" id="txtlv076"  tabindex="9" style="width:530px;text-align:left"><?php echo $lvki_lv0005->lv076;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Năng khiếu, điểm mạnh của anh chị: </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv034" id="txtlv034  tabindex="9" style="width:530px;text-align:left"><?php echo $lvki_lv0005->lv034;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Điểm yếu, khuyết của anh chị (về kỷ năng chuyên môn, t&iacute;nh cách&hellip;  cần r&egrave;n luyện thêm.): </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv035" id="txtlv035"  tabindex="9" style="width:530px;text-align:left"><?php echo $lvki_lv0005->lv035;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Định hướng nghề nghiệp trong 02 - 03 năm tới của anh chị ? : </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv077" id="txtlv077"  tabindex="9" style="width:530px;text-align:left"><?php echo $lvki_lv0005->lv077;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
										<div style="clear:both">
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;width:200px;">&bull; Lý do ch&iacute;nh anh/chị muốn vào làm việc tại công ty TDL ME và nhận thấy mình phù hợp với công việc dự tuyển: </div>
											<div style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 20px;text-align:left;"><textarea name="txtlv078" id="txtlv078"  tabindex="9" style="width:530px;text-align:left;height:60px;"><?php echo $lvki_lv0005->lv078;?></textarea></div>
										</div>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Bạn có đánh giá được giá trị sức lao động của mình không:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Không  <input type="radio" name="txtlv079" id="txtlv079" tabindex="10" style="width:15px" value="0" <?php echo ($lvki_lv0005->lv079=='0')?'checked="true"':'';?>/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Có  <input type="radio" name="txtlv079" id="txtlv079" tabindex="10" style="width:15px" value="1" <?php echo ($lvki_lv0005->lv079=='1')?'checked="true"':'';?>/></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Theo bạn, chúng tôi có nhận ra những câu trả lời không trung thực của bạn không: Không <input type="radio" name="txtlv080" id="txtlv080" tabindex="10" style="width:15px" value="0" <?php echo ($lvki_lv0005->lv080=='0')?'checked="true"':'';?>/> Có <input type="radio" name="txtlv080" id="txtlv080" tabindex="10" style="width:15px" value="1" <?php echo ($lvki_lv0005->lv080=='1')?'checked="true"':'';?>/></p>
									</th>
									</tr>
									<tr>
									<th>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Anh (chị) có người thân, bạn b&egrave; đang làm việc tại TDL ME ?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;không <input type="radio" name="txtlv081" id="txtlv081" tabindex="10" style="width:15px" value="0" <?php echo ($lvki_lv0005->lv081=='0')?'checked="true"':'';?>/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;có <input type="radio" name="txtlv081" id="txtlv081" tabindex="10" style="width:15px" value="1" <?php echo ($lvki_lv0005->lv081=='1')?'checked="true"':'';?>/></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">&bull;	Anh (chị) có thường thay đổi số điện thoại di động không?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Không <input type="radio" name="txtlv082" id="txtlv082" tabindex="10" style="width:15px" value="0" <?php echo ($lvki_lv0005->lv082=='0')?'checked="true"':'';?>/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Có <input type="radio" name="txtlv082" id="txtlv082" tabindex="10" style="width:15px" value="1" <?php echo ($lvki_lv0005->lv082=='1')?'checked="true"':'';?>/></p>
									</th>
									</tr>
									<tr style="float:right;">
									<th style="float: right; width: 280px; height: 232px;">
									<p style=";font-size:14px;font-weight:bold;margin:10px 0px 5px 20px;text-align:center;"><span style="text-decoration: underline;"><em>Phần ghi chú của Công ty:</em></span></p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width: 504px; height: 110px;">
									<p style="float:left;font-size:14px;font-weight:100;margin:10px 0px 5px 20px;text-align:left;">Ngày có thể nhận việc : <input class="required" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv083);return false;" name="txtlv083" type="text" id="txtlv083" value="<?php echo $lvki_lv0005->lv083;?>" tabindex="11" maxlength="50" style="width:140px;" >
						      <span class="td"> <img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv083);return false;" /></span></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">Lương đề nghị : <input name="txtlv084" type="text" id="txtlv084" value="<?php echo $lvki_lv0005->lv084;?>" tabindex="11" maxlength="30" style="width:130px;text-align:left" > Sau thử việc <input name="txtlv085" type="text" id="txtlv085" value="<?php echo $lvki_lv0005->lv085;?>" tabindex="11" maxlength="30" style="width:140px;text-align:left" ></p>
									<p style="float:left;font-size:16px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">Đề nghị khác : <input name="txtlv087" type="text" id="txtlv087" value="<?php echo $lvki_lv0005->lv087;?>" tabindex="11" maxlength="30" style="width:354px;text-align:left" ></p>
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
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="50"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="51"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>	

				
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript"> /*var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);*/
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