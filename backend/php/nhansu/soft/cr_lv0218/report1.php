<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/jo_lv0004.php");
require_once("../../clsall/hr_lv0020.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mojo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'hr0020');
$mohr_lv0020_1=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'hr0020');
$mohr_lv0020_2=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'hr0020');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("../../","JO0005.txt",$plang);
$lvNow=GetServerDate();
$vStrMessage="";
?>

<?php
if($mojo_lv0004->GetRpt()==1)
{
?>
<?php  
	$mojo_lv0004->LV_LoadID($vlv001);		
	$mohr_lv0020->LV_LoadID($mojo_lv0004->lv015);	
	$mohr_lv0020_1->LV_LoadID($mojo_lv0004->lv013);	
	$vAEmp=explode(";",$mojo_lv0004->lv014);
	$vNameQly="";
	foreach($vAEmp as $vEmp)
	{	
		if($vEmp!="" && $vEmp!=NULL)
		{
		$mohr_lv0020_2->LV_LoadID($vEmp);	
		$vNameQly=$vNameQly.(($vNameQly!="")?"/":'').$mohr_lv0020_2->lv004." ".$mohr_lv0020_2->lv003." ".$mohr_lv0020_2->lv002;
		}
	}
	?>
<html>
<head>
<title><?php echo $mojo_lv0004->lv002;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
	
	<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo "<img src='../../clsall/barqlý trực tiếp/barqlý trực tiếp.php?barnumber=".$mojo_lv0004->lv001."'>";?></td>
  </tr>	
  <tr>
    <td align="center" onDblClick="this.innerHTML=''"><img  src="<?php echo $mojo_lv0004->GetLogo();?>" /></td>
  </tr>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''"><div>
    <div style="float:left;text-align:left;width:50%"><strong></strong><br/><strong>Mã đơn:<?php echo $mojo_lv0004->lv001;?></strong>
<br/> Ngày xin nghỉ từ: <?php echo  $mojo_lv0004->FormatView($mojo_lv0004->lv016,2);?>  đến: <?php echo  $mojo_lv0004->FormatView($mojo_lv0004->lv017,2);?>
<br/> Ngày xin đươc duyệt : <?php echo  $mojo_lv0004->FormatView($mojo_lv0004->lv018,2);?>  đến: <?php echo  $mojo_lv0004->FormatView($mojo_lv0004->lv019,2);?>

</div><div style="float:right;text-align:right"><strong><?php echo $mojo_lv0004->GetCompany();?></strong><br><?php echo 'Địa chỉ';?>: <?php echo $mojo_lv0004->GetAddress();?>
<br><?php echo 'Điện thoại';?>: <?php echo $mojo_lv0004->GetPhone();?>   <?php echo 'Fax';?>: <?php echo $mojo_lv0004->GetFax();?> <br> 
<?php echo 'Web';?>: <a href="<?php echo $mojo_lv0004->GetWeb();?>" target="_blank"><?php echo $mojo_lv0004->GetWeb();?></a></div>
    </div></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><font style="font-size:22px;"><strong><?php echo $mojo_lv0004->getvaluelink('lv003',$mojo_lv0004->lv003);?></strong></font></td>
  </tr>
 <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="line-height:30px">
	<table style="width: 642px;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="168" valign="bottom">
<p>Họ và tên :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
</td>
<td width="474" valign="bottom">
<p><?php echo $mojo_lv0004->getvaluelink('lv015',$mojo_lv0004->lv015);?></p>
</td>
</tr>
<tr>
<td width="168" valign="bottom">
<p>Bộ phận&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
</td>
<td width="474" valign="bottom">
<p><?php echo $mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029);?></p>
</td>
</tr>
<tr>
<td width="168" valign="bottom">
<p>Phòng &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</p>
</td>
<td width="474" valign="bottom">
<p><?php echo $mohr_lv0020->getvaluelink('lv025',$mohr_lv0020->lv025);?></p>
</td>
</tr>
<tr>
<td width="168" valign="bottom">
<p>Ngày vào làm việc chính thức&nbsp;&nbsp; </p>
</td>
<td width="474" valign="bottom">
<p>: <?php echo  $mohr_lv0020->FormatView($mohr_lv0020->lv030,2);?></p>
</td>
</tr>
</tbody>
</table>
<p>Xin Công ty xem xét cho tôi được :</p>
<p>- Nghỉ phép năm  &hellip;&hellip;&hellip;&hellip;&hellip;...&hellip; &hellip;&hellip;&hellip;ngày&nbsp;&nbsp;</p>
<p>- Nghỉ việc riêng có lương &hellip;&hellip;&hellip;&hellip;&hellip;... .ngày</p>
<p>- Nghỉ việc riêng không lương  &hellip;&hellip;&hellip;..... ngày</p>
<p>- Nghỉ ốm, tai nạn LĐ &hellip;&hellip;&hellip;&hellip;&hellip; &hellip;&hellip;&hellip;ngày</p>
<p>- Nghỉ thai sản theo chế độ&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;...ngày</p>
<p>- <?php echo 'Mã công:<strong>'.$mojo_lv0004->TimeCard;?></strong> &nbsp;&nbsp;&nbsp;&nbsp; Số ngày xin phép: <strong><?php echo $mojo_lv0004->NumsRequire;?></strong> &nbsp;&nbsp; Số ngày duyệt: <strong><?php echo $mojo_lv0004->NumsAproval;?></strong></p>
<p>L&yacute; do xin nghỉ:&nbsp;&nbsp; <?php 
		echo str_replace("\n","<br/>",$mojo_lv0004->lv008);
	?></p>
<p>Kể từ   <?php echo substr($mojo_lv0004->lv018,11,2);?> giờ,  <?php echo substr($mojo_lv0004->lv018,14,2);?> phút, ngày   &nbsp;<?php echo  $mojo_lv0004->FormatView($mojo_lv0004->lv018,2);?>  , đến  <?php echo substr($mojo_lv0004->lv019,11,2);?> giờ,  <?php echo substr($mojo_lv0004->lv019,14,2);?> phút, ngày&nbsp; <?php echo  $mojo_lv0004->FormatView($mojo_lv0004->lv019,2);?> Người thay thế c&ocirc;ng việc trong thời gian nghỉ (<em>nếu c&oacute;</em>): &nbsp;</p>
<p>T&ocirc;i cam đoan trở lại l&agrave;m việc b&igrave;nh thường sau thời gian xin nghỉ phép nêu trên.</p>
<p align="center">&nbsp;</p>
<table border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="231" valign="top">
<p align="center"><strong>Giám đốc/Phó giám đốc bộ phận</strong></p>
</td>
<td width="231" valign="top">
<p align="center"><strong>Trưởng phòng</strong></p>
</td>
<td width="231" valign="top">
<p align="center"><strong>Người làm đơn</strong></p>
</td>
</tr>
<tr>
<td width="231" valign="top">
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p>&nbsp;</p>
<p>Họ và tên : <?php echo $vNameQly;?></p>
</td>
<td width="231" valign="top">
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p>Họ và tên :  <?php echo $mohr_lv0020_1->lv004.''.$mohr_lv0020_1->lv003.' '.$mohr_lv0020_1->lv002;?></p>
</td>
<td width="231" valign="top">
<p align="center">&nbsp;</p>
<p align="center">Xin được chấp thuận</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p>&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p>Họ và tên : <?php echo $mohr_lv0020->lv004.''.$mohr_lv0020->lv003.' '.$mohr_lv0020->lv002;?></p>
</td>
</tr>
</tbody>
</table>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<table border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="694" valign="top">
<p align="center"><strong>PHẦN KIỂM SO&Aacute;T CỦA PH&Ograve;NG NH&Acirc;N SỰ </strong><em>(Khi c&oacute; sự điều chỉnh kh&aacute;c đơn</em>)</p>
</td>
</tr>
<tr>
<td width="694" valign="top">
<p>Chế độ nghỉ: .........................................................................................................................................</p>
<p>Số ngày thực nghỉ: ...............................................................................................................................</p>
<p>Kể từ &hellip;&hellip; giờ, &hellip;.ph&uacute;t, ngày   &hellip;./.&hellip;./&hellip;.. , đến &hellip;&hellip; giờ, &hellip;.ph&uacute;t, ngày &hellip;../.&hellip;./&hellip;. ./&hellip;&hellip;</p>
<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NH&Acirc;N   VI&Ecirc;N PHỤ TR&Aacute;CH</strong><em></em></p>
<p><em>&nbsp;</em></p>
<p><em>&nbsp;</em></p>
<p><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </em></p>
<p align="center"><em>&nbsp;</em></p>
<p align="center"><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</em></p>
<p align="right"><em>( nh&acirc;n vi&ecirc;n h&agrave;nh ch&aacute;nh nh&acirc;n sự theo dỏi x&aacute;c nhận số ngày nghỉ thực   tế) &nbsp;</em></p>
</td>
</tr>
</tbody>
</table>
	</td>
  </tr>
  
</table>
</body>
</html>					
<?php
} else {
	include("../permit.php");
}
?>
