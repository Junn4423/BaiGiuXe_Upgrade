<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ki_lv0012.php");
require_once("../../clsall/sl_lv0043.php");
require_once("../../clsall/sl_lv0001.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"]);
$vlv001=$varr[0];
/////////////init object//////////////
$mosl_lv0043=new sl_lv0043($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0043');
$moki_lv0012=new ki_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0062');
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0040.txt",$plang);
if($moki_lv0012->GetView()==1)
{
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<style>
.right_style
{
	text-align:right;
}
.td_fontsmall
{
	font-size:9px;
}
</style>
</head>
<center>
<div style="width:810px">
<?php
$i=0;
foreach($varr as $empid)
{
$vlv001=$empid;
if($vlv001!="")
{
$moki_lv0012->LV_LoadID($empid);
$mosl_lv0043->LV_LoadID($moki_lv0012->lv002);
$mosl_lv0001->LV_LoadID($moki_lv0012->lv003);
if($mosl_lv0001->lv001!=NULL && $mosl_lv0001->lv001!="")
{
?>
<div style="float:left;<?php echo ($i%2==0)?'padding-right:30px':'';?>;text-align:justify;">
<table style="width: 390px;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top">
<div>
	<div style="float:left;width:30%;text-align:left">
		<img src="logo1.png" width="60%">
	</div>
	<div style="float:left;width:40%">
<p align="center" style="color:red;font:15px Arial;"><strong>Nhân Sâm Hàn Quốc</strong></p>
<p align="center"><strong><em>PHIẾU THƯỞNG </em></strong></p>
<p align="center"><strong><em>DOANH   SỐ & GIẢM GIÁ TẾT</em></strong></p>
	</div>
	<div style="float:right;width:30%;text-align:right">
		<img src="logo2.png" width="60%">
	</div>
</div>
<div style="clear:both">
<p>      Số Seri : <?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".$moki_lv0012->lv001."' />";?><strong><em>Áp dụng mua 01 lần đến hết <?php echo $moki_lv0012->FormatView($mosl_lv0043->lv007,2);?></em></strong></p>
<p align="justify"><strong><em>Mục đích: Thực hiện cam kết giảm giá vào dịp cuối năm <?php echo getyear($mosl_lv0043->lv004);?> cho   khách hàng thân quen có đăng ký tên & địa chỉ liên hệ - số điện thoại làm mã khách hàng.</em></p>
<p align="justify"><strong><em>Thưởng Doanh số:  Áp dụng theo   Danh mục hàng Khuyến Mãi Đặc Biệt & do khách hàng có Doanh số năm <?php echo getyear($mosl_lv0043->lv004);?> đạt : <?php echo $moki_lv0012->FormatView($moki_lv0012->lv007,10);?> đồng. Nên khách mua Tết theo Danh mục sẽ được giảm số tiền là = <?php echo $moki_lv0012->FormatView($moki_lv0012->LV_GetTron($moki_lv0012->lv007,$mosl_lv0043->lv008),10);?> đồng (~<?php echo $moki_lv0012->FormatView($mosl_lv0043->lv008,10);?>% doanh số).</em></p>
<p align="justify"><strong><em>Giảm giá Tết: Áp dụng cho sản phẩm Cty (không bao gồm Yến Sào   & Linh chi Nhật) & Do khách hàng có Doanh số mua trong năm đạt : <?php echo $moki_lv0012->FormatView($moki_lv0012->lv007,10);?> đồng. Nên Cty có   chính sách giảm giá là <?php echo $moki_lv0012->FormatView($moki_lv0012->lv004,10);?> % khi khách hàng đến mua hàng Cty, tới hết ngày <?php echo $moki_lv0012->FormatView($mosl_lv0043->lv007,2);?>. (Xem Chính sách Thưởng Doanh số & Tết Cty ban hành).</em></p>
<p align="justify"><strong><span style="text-decoration: underline;">Kiểm tra:</span></strong>  Khách hàng ghi rõ họ, tên và số điện   thoại để xác nhận<strong> mã thông tin</strong> trước   khi mua hàng.  Họ, tên: <?php echo $mosl_lv0001->lv002;?> Tel.: <?php echo $mosl_lv0001->lv001;?> <?php echo "Địa chỉ: ".$mosl_lv0001->lv006;?></p>
<p align="justify"><strong>Cty TNHH MTV TM-XNK NHÂN VIỆT</strong></p>
<p align="center">05 Trương Định P.6 Q.3 TP.HCM      Tel.: 3 9304 807  Mobile: 096 86 777 86 </p> 
</div>
</td>
</tr>
</tbody>
</table>
<p>      CHI TIẾT HÀNG BÁN THƯỞNG DOANH SỐ & GIẢM GIÁ TẾT</p>
<table style="width: 390px;" border="1" cellspacing="0" cellpadding="0" >
<tbody>
<tr>
<td width="3%" valign="top">
<p align="center"><strong>Stt</strong></p>
</td>
<td width="20%" valign="top">
<p align="center"><strong>Tên hàng hoá, qui cách</strong></p>
</td>
<td width="5%" valign="top">
<p align="center"><strong>Đơn vị</strong></p>
</td>
<td width="10%" valign="top">
<p align="center"><strong>SL</strong></p>
</td>
<td width="20%" valign="top">
<p align="center"><strong>Đơn giá</strong></p>
</td>
<td width="20%" valign="top">
<p align="center"><strong>Thành tiền</strong></p>
</td>
</tr>
<tr>
<td  valign="top">
<p align="center">(a)</p>
</td>
<td  valign="top">
<p align="center">(b)</p>
</td>
<td  valign="top">
<p align="center">(c)</p>
</td>
<td  valign="top">
<p align="center">(1)</p>
</td>
<td  valign="top">
<p align="center">(2)</p>
</td>
<td  valign="top">
<p align="center">(3)=(1) x (2)</p>
</td>
</tr>
<tr>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
</tr>
<tr>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
</tr>
<tr>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
</tr>
<tr>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
</tr>
<tr>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
</tr>
<tr>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
</tr>
<tr>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
</tr>
<tr>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top">
<p> &nbsp;</p>
</td>
</tr>
<tr>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top" colspan=4>
<p><strong>Tổng   cộng:</strong></p>
</td>

<td  valign="top">
<p> &nbsp;</p>
</td>
</tr>
<tr>
<td  valign="top">
<p> &nbsp;</p>
</td>
<td  valign="top"   valign="top" colspan=4>
<p><em>Thưởng Doanh số:</em></p>
</td>

<td  valign="top">
<p> </p>
</td>
</tr>
<tr>
<td  valign="top">
<p> </p>
</td>
<td  valign="top" colspan=4>
<p><em>Giảm giá (. . .   . . . . .%)</em></p>
</td>
<td  valign="top">
<p> </p>
</td>
</tr>
<tr>
<td  valign="top">
<p align="center"><strong> </strong></p>
</td>
<td  valign="top" colspan=4>
<p><strong>Thanh   toán:</strong></p>
</td>
<td  valign="top">
<p align="center"><strong> </strong></p>
</td>
</tr>
</tbody>
</table>
<br/>
<font style=""><strong>(*) Quý khách hàng nhớ mang theo phiếu khi mua hàng.</strong></font>
</div>
	<?php
 
$i++;	
echo ($i%2==0 && $i!=0)?'<div style="float:left;width:100%"><textarea style="width:100%;height:100px;border:0px #fff solid;"></textarea></div>':'';
}
}
} 
	?>
</div>	
</center>
<?php
} 
else 
{
	include("../permit.php");
}
?>
