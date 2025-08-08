<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0023.php");
require_once("../../clsall/hr_lv0020.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$vNow=GetServerDate();
/////////////init object//////////////
$motc_lv0023=new tc_lv0023($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0023');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$motc_lv0023->LV_LoadID($vlv001);
$mohr_lv0020->LV_LoadID($motc_lv0023->lv002);
?>
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../../logo.ico" >
<TITLE>GIẤY ĐỀ NGHỊ THANH TOÁN                                                       </TITLE>
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
<style>
body
{
  font-family:12px Arial,tahoma ;
 
}
table
{
   line-height: 23px;
}
</style>
</head>
<BODY BGCOLOR="FFFFFF" TOPMARGIN=24 LEFTMARGIN=34>
<TABLE CELLPADDING=0 CELLSPACING=0 width="760" align="center">
<TR>
<TD WIDTH=0.210%></TD>
<TD WIDTH=0.456%></TD>
<TD WIDTH=0.070%></TD>
<TD WIDTH=8%></TD>
<TD WIDTH=6%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=0.526%></TD>
<TD WIDTH=7%></TD>
<TD WIDTH=0.439%></TD>
<TD WIDTH=7%></TD>
<TD WIDTH=0.631%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=0.658%></TD>
<TD WIDTH=0.351%></TD>
<TD WIDTH=0.009%></TD>
<TD WIDTH=0.693%></TD>
<TD WIDTH=4%></TD>
<TD WIDTH=0.368%></TD>
<TD WIDTH=3%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=3%></TD>
<TD WIDTH=0.439%></TD>
<TD WIDTH=0.325%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=3%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=6%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=0.728%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=0.351%></TD>
<TD WIDTH=9%></TD>
<TD WIDTH=0.395%></TD>
<TD WIDTH=0.105%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=5%></TD>
<TD WIDTH=0.088%></TD>
<TD WIDTH=0.263%></TD>
<TD WIDTH=0.395%></TD>
<TD WIDTH=0.026%></TD>
<TD WIDTH=0.044%></TD>
<TD WIDTH=0.061%></TD>
<TD WIDTH=0.859%></TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44 align="right"><?php echo ($motc_lv0023->lv008>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$motc_lv0023->lv001."'>":"";?></TD>
</TR>
<!--<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=13 ondblclick="this.innerHTML=''"><img  src="<?php echo $motc_lv0023->GetLogo();?>" /></TD>
</TR>-->
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44><strong>Đơn vị:</strong> <?php 
$vCompanyName=$motc_lv0023->GetCompany();
echo $vCompanyName;
?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=28><strong>Địa chỉ:</strong> <?php $vCompanyAddress=$motc_lv0023->GetAddress();
echo $vCompanyAddress;?></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=5><B>Mẫu số 05 - TT  </B></TD>
<TD COLSPAN=11></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=26></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=14>(Ban hành theo Thông tư số 200/2014/TT-BTC<BR> Ngày 22/12/2014 của Bộ Tài chính)</TD>
<TD COLSPAN=4></TD>
</TR>
<TR VALIGN=CENTER>
<TD COLSPAN=3></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=36><B><br/><font style="font:bold 22px Arial,tahoma;">GIẤY ĐỀ NGHỊ THANH TOÁN</h2></B></TD>
<TD COLSPAN=5></TD>
</TR>
<!--
<TR VALIGN=TOP>
<TD COLSPAN=3></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=36><B>Liên 1(lưu)</B></TD>
<TD COLSPAN=5></TD>
</TR>-->
<TR VALIGN=TOP>
<TD COLSPAN=3></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=36><B>Ngày <?php echo getday($motc_lv0023->lv013,2);?> tháng <?php echo getmonth($motc_lv0023->lv013,2);?> năm <?php echo getyear($motc_lv0023->lv013,2);?></B></TD>
<TD COLSPAN=5></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=26></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=14>Số:<?php echo $motc_lv0023->lv001;?></TD>
<TD COLSPAN=4></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=14></TD>
<TD COLSPAN=26></TD>
</TR>
<TR VALIGN=TOP>
  <TD COLSPAN=42 style="widows:120px">Kính gửi: <?php echo $vCompanyName;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=42 style="widows:120px">Tôi tên là: <?php echo $mohr_lv0020->lv002;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=42>Bộ phận (Hoặc địa chỉ): <?php echo $mohr_lv0020->lv034;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=42>Nội dung thanh toán: <?php echo $motc_lv0023->lv007;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD  COLSPAN=18>Số tiền: <?php echo $motc_lv0023->FormatView($motc_lv0023->lv005,10);?></TD>
  <TD COLSPAN=26>(Viết bằng chữ) : <?php echo LNum2Text($motc_lv0023->lv005,$plang);?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=42>(Kèm theo.....................chứng từ gốc)</TD>
  </TR>
<TR VALIGN=TOP>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><B>Giám đốc</B></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><B>Kế toán trưởng</B></TD>
<TD COLSPAN=2></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><B>Phụ trách bộ phận</B></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><B>Người đề nghị tạm ứng</B></TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>(Ký, ghi rõ họ tên)</TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>(Ký, ghi rõ họ tên)</TD>
<TD COLSPAN=2></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>(Ký, ghi rõ họ tên)</TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>(Ký, ghi rõ họ tên)</TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=90>&nbsp;</TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>.............................</TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>.............................</TD>
<TD COLSPAN=2></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><?php echo $motc_lv0023->getvaluelink('lv111',getInfor($_SESSION['ERPSOFV2RUserID'],2));?></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><?php echo $mohr_lv0020->lv002;?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=33></TD>
</TR>
</TABLE>
<div   ondblclick="this.innerHTML=''" >
<div style="height:40px">&nbsp;</div>
</div>

<TABLE CELLPADDING=0 CELLSPACING=0 width="760" align="center">
<TR>
<TD WIDTH=0.210%></TD>
<TD WIDTH=0.456%></TD>
<TD WIDTH=0.070%></TD>
<TD WIDTH=8%></TD>
<TD WIDTH=6%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=0.526%></TD>
<TD WIDTH=7%></TD>
<TD WIDTH=0.439%></TD>
<TD WIDTH=7%></TD>
<TD WIDTH=0.631%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=0.658%></TD>
<TD WIDTH=0.351%></TD>
<TD WIDTH=0.009%></TD>
<TD WIDTH=0.693%></TD>
<TD WIDTH=4%></TD>
<TD WIDTH=0.368%></TD>
<TD WIDTH=3%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=3%></TD>
<TD WIDTH=0.439%></TD>
<TD WIDTH=0.325%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=3%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=6%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=0.728%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=0.351%></TD>
<TD WIDTH=9%></TD>
<TD WIDTH=0.395%></TD>
<TD WIDTH=0.105%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=5%></TD>
<TD WIDTH=0.088%></TD>
<TD WIDTH=0.263%></TD>
<TD WIDTH=0.395%></TD>
<TD WIDTH=0.026%></TD>
<TD WIDTH=0.044%></TD>
<TD WIDTH=0.061%></TD>
<TD WIDTH=0.859%></TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44 align="right"><?php echo ($motc_lv0023->lv008>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$motc_lv0023->lv001."'>":"";?></TD>
</TR>
<!--<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=13 ondblclick="this.innerHTML=''"><img  src="<?php echo $motc_lv0023->GetLogo();?>" /></TD>
</TR>
-->
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44><strong>Đơn vị:</strong> <?php 
$vCompanyName=$motc_lv0023->GetCompany();
echo $vCompanyName;
?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=28><strong>Bộ phận:</strong> <?php echo  $vCompanyAddress;?></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=5><B>Mẫu số 05 - TT  </B></TD>
<TD COLSPAN=11></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=26></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=14>(Ban hành theo Thông tư số 200/2014/TT-BTC<BR> Ngày 22/12/2014 của Bộ Tài chính)</TD>
<TD COLSPAN=4></TD>
</TR>
<TR VALIGN=CENTER>
<TD COLSPAN=3></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=36><B><br/><font style="font:bold 22px Arial,tahoma;">GIẤY ĐỀ NGHỊ THANH TOÁN</h2></B></TD>
<TD COLSPAN=5></TD>
</TR>
<!--
<TR VALIGN=TOP>
<TD COLSPAN=3></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=36><B>Liên 2</B></TD>
<TD COLSPAN=5></TD>
</TR>-->
<TR VALIGN=TOP>
<TD COLSPAN=3></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=36><B>Ngày <?php echo getday($motc_lv0023->lv013,2);?> tháng <?php echo getmonth($motc_lv0023->lv013,2);?> năm <?php echo getyear($motc_lv0023->lv013,2);?></B></TD>
<TD COLSPAN=5></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=26></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=14>Số:<?php echo $motc_lv0023->lv001;?></TD>
<TD COLSPAN=4></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=16></TD>
<TD COLSPAN=26></TD>
</TR>
<TR VALIGN=TOP>
  <TD COLSPAN=42 style="widows:120px">Kính gửi: <?php echo $vCompanyName;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=42 style="widows:120px">Tôi tên là: <?php echo $mohr_lv0020->lv002;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=42>Bộ phận (Hoặc địa chỉ): <?php echo $mohr_lv0020->lv034;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=42>Số tiền: <?php echo $motc_lv0023->lv007;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD  COLSPAN=18>Đề nghị cho tạm ứng số tiền: <?php echo $motc_lv0023->FormatView($motc_lv0023->lv005,10);?></TD>
  <TD COLSPAN=26>(Viết bằng chữ) : <?php echo LNum2Text($motc_lv0023->lv005,$plang);?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=42>(Kèm theo.....................chứng từ gốc)</TD>
  </TR>
<TR VALIGN=TOP>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><B>Giám đốc</B></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><B>Kế toán trưởng</B></TD>
<TD COLSPAN=2></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><B>Phụ trách bộ phận</B></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><B>Người đề nghị tạm ứng</B></TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>(Ký, ghi rõ họ tên)</TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>(Ký, ghi rõ họ tên)</TD>
<TD COLSPAN=2></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>(Ký, ghi rõ họ tên)</TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>(Ký, ghi rõ họ tên)</TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=90>&nbsp;</TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>.............................</TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8>.............................</TD>
<TD COLSPAN=2></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><?php echo $motc_lv0023->getvaluelink('lv111',getInfor($_SESSION['ERPSOFV2RUserID'],2));?></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=8><?php echo $mohr_lv0020->lv002;?></TD>
</TR>
</TABLE>
</BODY></HTML>
<?php
  if(trim($motc_lv0023->lv001.'')=="")
  {
?>
  <script language="javascript">
    window.close();
  </script>
<?php
  }
?>  
