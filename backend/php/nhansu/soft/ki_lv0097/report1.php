<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0078.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");

//////////////init object////////////////
$lvhr_lv0078=new hr_lv0078($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0078');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$varr=explode("@",$_GET["ChildID"],2);
$vlv001=$varr[0];
$lvhr_lv0078->lv001=$vlv001;
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0022.txt",$plang);
$lvhr_lv0078->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0078->LV_LoadID($lvhr_lv0078->lv001);
if($lvhr_lv0078->lv001!=NULL && $lvhr_lv0078->lv001!="")
		{
			$lvhr_lv0078->lv008 = $lvhr_lv0078->FormatView($lvhr_lv0078->lv008,2);
			$lvhr_lv0078->lv010 = $lvhr_lv0078->FormatView($lvhr_lv0078->lv010,2);
			$lvhr_lv0078->lv040 = $lvhr_lv0078->FormatView($lvhr_lv0078->lv040,2);
			$lvhr_lv0078->lv083 = $lvhr_lv0078->FormatView($lvhr_lv0078->lv083,2);
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $lvhr_lv0078->lv005." ".$lvhr_lv0078->lv004." ".$lvhr_lv0078->lv003."(".$lvhr_lv0078->lv001.")";?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<style>
input,textarea
{
	border:0px #fff solid;
}
</style>
<?php
if($lvhr_lv0078->GetView()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
					
						<center>
						<div style="width: 790px;" ondblclick="this.innerHTML='">
									<table style="width: 790px;" border="1" cellspacing="0" cellpadding="0">
									<tbody>
									<tr style="border:0px;">
									<th style="float: left; width: 209px; height: 70px;">
									<p style="font-size:14px;font-weight:100;margin:0px 0px 0px 0px;"><img height="70" src="../../logo.png" /></p>
									</th> <th style="float: left; width: 363px; height: 70px;">
									<p style="font-size:20px;font-weight:bold;margin:20px 0px 0px 0px;">PHIẾU ĐĂNG K&Yacute; DỰ TUYỂN</p>
									</th> <th style="float: left; width: 209px; height: 70px;">
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
									<em>Ưu tiên 1:</em> <?php echo $lvhr_lv0078->getvaluelink('lv002',$lvhr_lv0078->lv002);?></p>
									</th> <th style="float: left; width: 395px; height: 40px; border-left: 0px; border-top: 0px;">
									<p style="float:left;font-size:14px;font-weight:bold;margin:15px 0px 0px 10px;"><em>Ưu tiên 2:</em> <?php echo $lvhr_lv0078->getvaluelink('lv002',$lvhr_lv0078->lv089);?></p>
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
										</p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 10px;">
									-	Số CMND : <input class="required"  name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvhr_lv0078->lv007;?>" tabindex="3" maxlength="15" style="width:160px;" /> 
									Ngày cấp : <input class="required" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv008);return false;" name="txtlv008" type="text" id="txtlv008" value="<?php echo $lvhr_lv0078->lv008;?>" tabindex="3" maxlength="50" style="width:140px;" >
						      
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
									<th style="float: left; width:100px; height: 198px;">
									<p style="font-size:14px;font-weight:100;margin:30px 0px 0px 0px;text-align:center;padding:5px;">Thời gian công tác: <br/>Từ tháng<br/><input name="txtlv301_1" type="text" id="txtlv301_1" value="<?php echo getmonth($lvhr_lv0078->lv301);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv301_2" type="text" id="txtlv301_2" value="<?php echo getyear($lvhr_lv0078->lv301);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" >
									<br/>Đến tháng<br/><input name="txtlv302_1" type="text" id="txtlv302_1" value="<?php echo getmonth($lvhr_lv0078->lv302);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv302_2" type="text" id="txtlv302_2" value="<?php echo getyear($lvhr_lv0078->lv302);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" ></p>
									</th> <th style="float: left; width: 680px; height: 198px;">
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Tên đơn vị : <input name="txtlv303" type="text" id="txtlv303" value="<?php echo $lvhr_lv0078->lv303;?>" tabindex="9" maxlength="100" style="width:280px;text-align:left" > Ngành họat động : <input name="txtlv304" type="text" id="txtlv304" value="<?php echo $lvhr_lv0078->lv304;?>" tabindex="9" maxlength="50" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Địa chỉ : <input name="txtlv305" type="text" id="txtlv305" value="<?php echo $lvhr_lv0078->lv305;?>" tabindex="9" maxlength="50" style="width:370px;text-align:left" > Quy mô : <input name="txtlv306" type="text" id="txtlv306" value="<?php echo $lvhr_lv0078->lv306;?>" tabindex="9" maxlength="30" style="width:130px;text-align:left" > Người</p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Nhiệm vụ khi mới vào: <input name="txtlv307" type="text" id="txtlv307" value="<?php echo $lvhr_lv0078->lv307;?>" tabindex="9" maxlength="50" style="width:220px;text-align:left" > Chức vụ sau cùng: <input name="txtlv308" type="text" id="txtlv308" value="<?php echo $lvhr_lv0078->lv308;?>" tabindex="9" maxlength="50" style="width:170px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Quản lý bao nhiêu nhân viên : <input name="txtlv309" type="text" id="txtlv309" value="<?php echo $lvhr_lv0078->lv309;?>" tabindex="9" maxlength="30" style="width:120px;text-align:left" >  Toàn bộ phận có bao nhiêu người : <input name="txtlv310" type="text" id="txtlv310" value="<?php echo $lvhr_lv0078->lv310;?>" tabindex="9" maxlength="30" style="width:123px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Mức lương khi mới vào: <input name="txtlv311" type="text" id="txtlv311" value="<?php echo $lvhr_lv0078->FormatView($lvhr_lv0078->lv311,20);?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" > mức lương cuối cùng: <input name="txtlv312" type="text" id="txtlv312" value="<?php echo $lvhr_lv0078->FormatView($lvhr_lv0078->lv312,20);?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Lý do nghỉ việc : <input name="txtlv313" type="text" id="txtlv313" value="<?php echo $lvhr_lv0078->lv313;?>" tabindex="9" maxlength="30" style="width:553px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Người liên hệ tham khảo : <input name="txtlv314" type="text" id="txtlv314" value="<?php echo $lvhr_lv0078->lv314;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" > sđt: <input name="txtlv315" type="text" id="txtlv315" value="<?php echo $lvhr_lv0078->lv315;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" ></p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width:100px; height: 198px;">
									<p style="font-size:14px;font-weight:100;margin:30px 0px 0px 0px;text-align:center;padding:5px;">Thời gian công tác: <br/>Từ tháng<br/><input name="txtlv321_1" type="text" id="txtlv321_1" value="<?php echo getmonth($lvhr_lv0078->lv321);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv321_2" type="text" id="txtlv321_2" value="<?php echo getyear($lvhr_lv0078->lv321);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" >
									<br/>Đến tháng<br/><input name="txtlv322_1" type="text" id="txtlv322_1" value="<?php echo getmonth($lvhr_lv0078->lv322);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv322_2" type="text" id="txtlv322_2" value="<?php echo getyear($lvhr_lv0078->lv322);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" ></p>
									</th> <th style="float: left; width: 680px; height: 198px;">
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Tên đơn vị : <input name="txtlv323" type="text" id="txtlv323" value="<?php echo $lvhr_lv0078->lv323;?>" tabindex="9" maxlength="100" style="width:280px;text-align:left" > Ngành họat động : <input name="txtlv324" type="text" id="txtlv324" value="<?php echo $lvhr_lv0078->lv324;?>" tabindex="9" maxlength="50" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Địa chỉ : <input name="txtlv325" type="text" id="txtlv325" value="<?php echo $lvhr_lv0078->lv325;?>" tabindex="9" maxlength="50" style="width:370px;text-align:left" > Quy mô : <input name="txtlv326" type="text" id="txtlv326" value="<?php echo $lvhr_lv0078->lv326;?>" tabindex="9" maxlength="30" style="width:130px;text-align:left" > Người</p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Nhiệm vụ khi mới vào: <input name="txtlv327" type="text" id="txtlv327" value="<?php echo $lvhr_lv0078->lv327;?>" tabindex="9" maxlength="50" style="width:220px;text-align:left" > Chức vụ sau cùng: <input name="txtlv328" type="text" id="txtlv328" value="<?php echo $lvhr_lv0078->lv328;?>" tabindex="9" maxlength="50" style="width:170px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Quản lý bao nhiêu nhân viên : <input name="txtlv329" type="text" id="txtlv329" value="<?php echo $lvhr_lv0078->lv329;?>" tabindex="9" maxlength="30" style="width:120px;text-align:left" >  Toàn bộ phận có bao nhiêu người : <input name="txtlv330" type="text" id="txtlv330" value="<?php echo $lvhr_lv0078->lv330;?>" tabindex="9" maxlength="30" style="width:123px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Mức lương khi mới vào: <input name="txtlv331" type="text" id="txtlv331" value="<?php echo $lvhr_lv0078->FormatView($lvhr_lv0078->lv331,20);?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" > mức lương cuối cùng: <input name="txtlv332" type="text" id="txtlv332" value="<?php echo $lvhr_lv0078->FormatView($lvhr_lv0078->lv332,20);?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Lý do nghỉ việc : <input name="txtlv333" type="text" id="txtlv333" value="<?php echo $lvhr_lv0078->lv333;?>" tabindex="9" maxlength="30" style="width:553px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Người liên hệ tham khảo : <input name="txtlv334" type="text" id="txtlv334" value="<?php echo $lvhr_lv0078->lv334;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" > sđt: <input name="txtlv315" type="text" id="txtlv315" value="<?php echo $lvhr_lv0078->lv315;?>" tabindex="9" maxlength="30" style="width:230px;text-align:left" ></p>
									</th>
									</tr>
									<tr style="float:left;">
									<th style="float: left; width:100px; height: 198px;">
									<p style="font-size:14px;font-weight:100;margin:30px 0px 0px 0px;text-align:center;padding:5px;">Thời gian công tác: <br/>Từ tháng<br/><input name="txtlv341_1" type="text" id="txtlv341_1" value="<?php echo getmonth($lvhr_lv0078->lv341);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv341_2" type="text" id="txtlv341_2" value="<?php echo getyear($lvhr_lv0078->lv341);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" >
									<br/>Đến tháng<br/><input name="txtlv342_1" type="text" id="txtlv342_1" value="<?php echo getmonth($lvhr_lv0078->lv342);?>" tabindex="9" maxlength="100" style="width:25px;text-align:center" >/<input name="txtlv342_2" type="text" id="txtlv342_2" value="<?php echo getyear($lvhr_lv0078->lv342);?>" tabindex="9" maxlength="50" style="width:40px;text-align:center" ></p>
									</th> <th style="float: left; width: 680px; height: 198px;">
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Tên đơn vị : <input name="txtlv343" type="text" id="txtlv343" value="<?php echo $lvhr_lv0078->lv343;?>" tabindex="9" maxlength="100" style="width:280px;text-align:left" > Ngành họat động : <input name="txtlv344" type="text" id="txtlv344" value="<?php echo $lvhr_lv0078->lv344;?>" tabindex="9" maxlength="50" style="width:180px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Địa chỉ : <input name="txtlv345" type="text" id="txtlv345" value="<?php echo $lvhr_lv0078->lv345;?>" tabindex="9" maxlength="50" style="width:370px;text-align:left" > Quy mô : <input name="txtlv346" type="text" id="txtlv346" value="<?php echo $lvhr_lv0078->lv346;?>" tabindex="9" maxlength="30" style="width:130px;text-align:left" > Người</p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Nhiệm vụ khi mới vào: <input name="txtlv347" type="text" id="txtlv347" value="<?php echo $lvhr_lv0078->lv347;?>" tabindex="9" maxlength="50" style="width:220px;text-align:left" > Chức vụ sau cùng: <input name="txtlv348" type="text" id="txtlv348" value="<?php echo $lvhr_lv0078->lv348;?>" tabindex="9" maxlength="50" style="width:170px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Quản lý bao nhiêu nhân viên : <input name="txtlv349" type="text" id="txtlv349" value="<?php echo $lvhr_lv0078->lv349;?>" tabindex="9" maxlength="30" style="width:120px;text-align:left" >  Toàn bộ phận có bao nhiêu người : <input name="txtlv350" type="text" id="txtlv350" value="<?php echo $lvhr_lv0078->lv350;?>" tabindex="9" maxlength="30" style="width:123px;text-align:left" ></p>
									<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 10px;text-align:left;">Mức lương khi mới vào: <input name="txtlv351" type="text" id="txtlv351" value="<?php echo $lvhr_lv0078->FormatView($lvhr_lv0078->lv351,20);?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" > mức lương cuối cùng: <input name="txtlv352" type="text" id="txtlv352" value="<?php echo $lvhr_lv0078->FormatView($lvhr_lv0078->lv352,20);?>" tabindex="9" maxlength="30" style="width:180px;text-align:left" ></p>
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
									<p style="float:left;font-size:14px;font-weight:100;margin:10px 0px 5px 20px;text-align:left;">Ngày có thể nhận việc : <input class="required" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv083);return false;" name="txtlv083" type="text" id="txtlv083" value="<?php echo $lvhr_lv0078->lv083;?>" tabindex="11" maxlength="50" style="width:140px;" ></p>
									<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 5px 20px;text-align:left;">Lương đề nghị : <input name="txtlv084" type="text" id="txtlv084" value="<?php echo $lvhr_lv0078->FormatView($lvhr_lv0078->lv084,20);?>" tabindex="11" maxlength="30" style="width:130px;text-align:left" > Sau thử việc: <input name="txtlv085" type="text" id="txtlv085" value="<?php echo $lvhr_lv0078->FormatView($lvhr_lv0078->lv085,20);?>" tabindex="11" maxlength="30" style="width:140px;text-align:left" ></p>
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
									</center>
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>