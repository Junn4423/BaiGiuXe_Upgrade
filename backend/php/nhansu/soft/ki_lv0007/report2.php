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
							<div style="width: 751px;" ondblclick="this.innerHTML='">
								<table style="width: 751px;" border="1" cellspacing="0" cellpadding="0">
								<tbody>
								<tr style="border:0px;">
								<th style="float: left; width: 170px; height: 60px;">
								<p style="font-size:14px;font-weight:100;margin:0px 0px 0px 0px;"><img alt="" /></p>
								</th> <th style="float: left; width: 373px; height: 60px;">
								<p style="font-size:16px;font-weight:bold;margin:20px 0px 0px 0px;">PHIẾU TỔNG HỢP KẾT QUẢ PHỎNG VẤN</p>
								</th> <th style="float: left; width: 180px; height: 60px;">
								<p style="float:left;font-size:12px;font-weight:100;margin:3px 0px 0px 5px;">Mã số: BM-HCNS-05</p>
								<p style="float:left;font-size:12px;font-weight:100;margin:3px 0px 0px 5px;">Lần sữa đổi: 01</p>
								<p style="float:left;font-size:12px;font-weight:100;margin:3px 0px 0px 5px;">Ngày &aacute;p dụng: 15/09/2013</p>
								</th>
								</tr>
								<tr>
								<th style="border-bottom:0px;border-left:0px;border-right:0px;">
								<p style="float:left;font-size:14px;font-weight:100;margin-left:20px;margin:10px 0px 0px 20px;">Họ tên ứng viên: <input class="required" name="txtlv003" type="text" id="txtlv003"  value="<?php echo $lvhr_lv0078->lv003;?>" tabindex="2" maxlength="225" style="width:200px" />  	Năm sinh: <input class="required" name="txtlv003" type="text" id="txtlv003"  value="<?php echo getyear(recoverdate($lvhr_lv0078->lv010,$plang));?>" tabindex="2" maxlength="120" style="width:160px" /> Giới tính: <?php echo ($lvhr_lv0078->lv012=='1')?'Nam':'Nữ';?>.</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:10px 0px 10px 20px;">Bộ phận: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.&hellip;&hellip;&hellip;&hellip;.	Vị trí: <?php echo $lvhr_lv0078->getvaluelink('lv002',$lvhr_lv0078->lv002);?></p>
								<p style="float:left;font-size:14px;font-weight:100;margin:10px 0px 10px 20px;">I/ Đ&Aacute;NH GI&Aacute; CỦA PH&Ograve;NG NH&Acirc;N SỰ:</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 240px; height: 25px;">
								<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 0px;">Nội dung cần đ&aacute;nh gi&aacute;</p>
								</th> <th style="float: left; width: 170px; height: 25px;">
								<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 0px;">Mức độ</p>
								</th> <th style="float: left; width: 274px; height: 25px;">
								<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 0px;">Nhận x&eacute;t</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 240px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">1. Hồ sơ, văn bằng c&aacute;c lọai</p>
								</th> <th style="float: left; width: 170px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 274px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 240px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">2. Tính c&aacute;ch, diện mạo</p>
								</th> <th style="float: left; width: 170px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 274px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 240px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">3. Sức khỏe</p>
								</th> <th style="float: left; width: 170px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 274px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 240px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">4. Kinh nghiệm</p>
								</th> <th style="float: left; width: 170px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 274px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 240px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">5. Khả năng lãnh đạo, s&aacute;ng tạo</p>
								</th> <th style="float: left; width: 170px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 274px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 240px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">6. &Yacute; thức làm việc, sự nhiệt t&igrave;nh</p>
								</th> <th style="float: left; width: 170px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 274px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 240px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">7. Khả năng tổ chức c&ocirc;ng việc</p>
								</th> <th style="float: left; width: 170px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 274px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="border:none;">
								<th style="border:none;">
								<p style="float:left;font-size:14px;font-weight:100;margin:10px 0px 0px 20px;">Mức lương đề xuất của ứng viên sau thử việc: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</p>
								<p style="float:left;font-size:14px;font-weight:100;margin-left:20px;margin:10px 0px 10px 20px;">Đồng &yacute; tiếp nhận&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;Kh&ocirc;ng đạt&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;đề nghị lưu hồ sơ..&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Dự kiến bố trí vào bộ phận: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..	Vị trí: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Ghi ch&uacute;: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Người đ&aacute;nh gi&aacute; : &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..Chức vụ: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:10px 0px 10px 20px;">II/ Đ&Aacute;NH GI&Aacute; CỦA BỘ PHẬN CHUY&Ecirc;N M&Ocirc;N:</p>
								</th>
								</tr>
								<tr style="width: 244px; float: left; margin-left: 20px;">
								<th style="float: left; width: 242px; height: 52px;">
								<p style="font-size:14px;font-weight:100;margin:18px 0px 0px 0px;">Nội dung đ&aacute;nh gi&aacute;</p>
								</th>
								</tr>
								<tr style="width: 202px; float: left;">
								<th style="float: left; width: 200px; height: 25px;">
								<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 0px;">Mức độ kiến thức</p>
								</th> <th style="float: left; width: 99px; height: 25px;">
								<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 0px;">L&yacute; thuyết</p>
								</th> <th style="float: left; width: 99px; height: 25px;">
								<p style="font-size:14px;font-weight:100;margin:5px 0px 0px 0px;">Thực tế</p>
								</th>
								</tr>
								<tr style="width: 244px; float: left;">
								<th style="float: left; width: 242px; height: 52px;">
								<p style="font-size:14px;font-weight:100;margin:18px 0px 0px 0px;">Nhận x&eacute;t</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 200px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 200px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 200px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 200px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 200px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="width: 690px; float: left; margin-left: 20px;">
								<th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 200px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th> <th style="float: left; width: 242px; height: 25px;">
								<p style="float:left;font-size:14px;font-weight:100;margin:5px 0px 0px 10px;">&nbsp;</p>
								</th>
								</tr>
								<tr style="border:none;">
								<th style="border:none;">
								<p style="float:left;font-size:14px;font-weight:100;margin-left:20px;margin:10px 0px 10px 20px;">Đồng &yacute; tiếp nhận&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;Kh&ocirc;ng đạt&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;đề nghị lưu hồ sơ..&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Nếu được c&oacute; thể bố trí vào tổ: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.&hellip;&hellip;&hellip;.....&hellip;từ ngày &hellip;&hellip; / &hellip;&hellip; / 20 &hellip;&hellip;</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Thời gian học việc, thử việc là: &hellip;&hellip;&hellip; th&aacute;ng.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kể từ ngày &hellip;&hellip; / &hellip;&hellip; / 20 &hellip;&hellip; đến ngày &hellip;&hellip; / &hellip;&hellip; / 20 &hellip;&hellip;</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Mức lương thử việc:&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;Phụ cấp kh&aacute;c:&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Mức lương chính thức:&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;. ABC &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;. Phụ cấp kh&aacute;c: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;...</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Ghi ch&uacute;: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Người đ&aacute;nh gi&aacute;: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;Chức vụ: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Sau khi nghe phổ biến một số qui định, nội qui C&ocirc;ng ty và yêu cầu c&ocirc;ng việc <em>ứng viên đã đồng &yacute; và cam kết thực hiện.</em></p>
								<p style="float:left;font-size:14px;font-weight:100;margin:0px 0px 10px 20px;">Chữ k&yacute; của ứng viên: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</p>
								<p style="float: left; font-size: 14px; font-weight: 100; margin: 0px 0px 10px 50px; width: 630px;">Ch&uacute;ng t&ocirc;i xin cam đoan đã đ&aacute;nh gi&aacute; nh&acirc;n sự một c&aacute;ch kh&aacute;ch quan, chính x&aacute;c, nếu c&oacute; điều g&igrave; sai tr&aacute;i ch&uacute;ng t&ocirc;i xin chịu h&ograve;an t&ograve;an tr&aacute;ch nhiệm trước Gi&aacute;m đốc C&ocirc;ng ty.</p>
								<p style="float: left; font-size: 15px; font-weight: 100; margin: 0px 0px 10px 50px; width: 630px;">Kính tr&igrave;nh Gi&aacute;m Đốc CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG x&eacute;t duyệt.</p>
								<p style="float: right; font-size: 15px; font-weight: 100; margin: 0px 100px 100px 0px; width: 200px;">GI&Aacute;M ĐỐC DUYỆT</p>
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