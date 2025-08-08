<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0036.php");
require_once("../../clsall/jo_lv0016.php");
require_once("../../clsall/hr_lv0020.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mohr_lv0036=new hr_lv0036($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0055');
$mojo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0016');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($mohr_lv0036->GetView()==1)
{
$mohr_lv0036->lv001=$_GET['txtlv001'];
$mohr_lv0036->lv002= $_GET['ID'] ?? '';
$mohr_lv0036->lv003=$_GET['txtlv003'];
$mohr_lv0036->lv004=$_GET['txtlv004'];
$mohr_lv0036->lv005=$_GET['txtlv005'];
$mohr_lv0036->lv006=$_GET['txtlv006'];
$mohr_lv0036->lv007=$_GET['txtlv007'];
$mohr_lv0036->lv899=$_GET['txtlv899'];
$mohr_lv0036->lv801=$_GET['txtlv801'];
$mohr_lv0036->lv829=$_GET['txtlv829'];
$mohr_lv0036->DateFrom=$_GET['txtDateFrom'];
$vMonth=substr($_GET['txtDateFrom'],3,2);
$vYear=substr($_GET['txtDateFrom'],6,4);
$mohr_lv0036->DateTo=$_GET['txtDateTo'];
$mohr_lv0036->FullName=$_GET['txtFullName'];	
$vCondition=$mohr_lv0036->GetCondition();
$mojo_lv0016->LV_Load();
?>
<html>
<head>
<title><?php echo $vtitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
<center>
<table width="800" style="font-size: 12px;font-family:arial,times new roman;" border="0" cellspacing="0">
<tbody>
<tr>
	<td colspan="6" style="font-size: 18px;font-family:arial,times new roman;" height="27" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">C&Ocirc;NG TY CP CN ĐT MINH PHƯƠNG<br/></span></td>
</tr>
<tr>
	<td colspan="6" style="font-size: 18px;font-family:arial,times new roman;" align="center"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">DANH S&Aacute;CH PHẠT VI PHẠM NỘI QUY TH&Aacute;NG <?php echo $vMonth;?> NĂM <?php echo $vYear;?></span></strong>
</tr>
<tr>
	<td colspan="6" style="font-size: 12px;font-family:arial,times new roman;" align="center"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">(Sung c&ocirc;ng quỹ)</span></strong></td>
</tr>
<tr>
<td width="2%" style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" height="27" align="left"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">STT</span></strong></td>
<td width="20%" style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">Họ t&ecirc;n</span></strong></td>
<td width="*%" style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">Nội dung phạt</span></strong></td>
<td width="10%" style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">Ngày phạt</span></strong></td>
<td width="10%" style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">Tiền phạt</span></strong></td>
<td width="20%" style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">Ghi ch&uacute;</span></strong></td>
</tr>
</tr>
<?php
$lvsql="select  A.*,C.lv002 TenNV,D.lv002 NoiDungPhat from hr_lv0036 A left join hr_lv0020 C on A.lv002=C.lv001 left join hr_lv0035 D on A.lv004=D.lv001 where 1=1 $vCondition order by A.lv004,A.lv006";
$vReturn= db_query($lvsql);
$vi=0;
while($vrow=db_fetch_array($vReturn))
{
	$vi++;
	$vTenNV=$vrow['TenNV'];
	$vNoiDungPhat=$vrow['NoiDungPhat'];
	$vSumAll=$vSumAll+$vrow['lv007'];
?>
<tr>
	<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" height="27" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><?php echo $vi;?></span></td>
	<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><?php echo $vTenNV;?></span></td>
	<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><?php echo $vNoiDungPhat.' - '. $vrow['lv005'];?></span></td>
	<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="center"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><?php echo $mohr_lv0036->FormatView($vrow['lv006'],2);?></span></td>
	<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="right"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><?php echo $mohr_lv0036->FormatView($vrow['lv007'],20);?></span></td>
	<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
</tr>
<?php
}
?>
<tr>
<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" height="27" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">Tổng cộng</span></strong></td>
<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="right"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><?php echo $mohr_lv0036->FormatView($vSumAll,20);?></span></td>
<td style="font-size: 12px;font-family:arial,times new roman; border: 1px solid #000000;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
</tr>
<tr>
<td style="font-size: 12px;font-family:arial,times new roman;" height="27" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
</tr>
</table>
<table width="800" style="font-size: 12px;font-family:arial,times new roman;" border="0" cellspacing="0">
<tbody>
<tr>

<td style="font-size: 12px;font-family:arial,times new roman;" align="center"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">Người lập</span></strong></td>
<td width="30%" style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td width="30%" style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="center"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">Tổng Gi&aacute;m đốc</span></strong></td>

</tr>
<tr>

<td style="font-size: 12px;font-family:arial,times new roman;" align="center"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></strong></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></strong></td>

</tr>
<tr>
<td style="font-size: 12px;font-family:arial,times new roman;" align="center"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></strong></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></strong></td>

</tr>
<tr>

<td height="60" style="font-size: 12px;font-family:arial,times new roman;" align="center"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></strong></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></strong></td>

</tr>
<tr>

<td style="font-size: 12px;font-family:arial,times new roman;" align="center">
	<strong>
		<span style="font-family: &quot;Times New Roman&quot;; color: #000000;">
			<?php 
			$mohr_lv0020->LV_LoadID($mojo_lv0016->lv363);
			echo $mohr_lv0020->lv002;
			?>
		</span>
	</strong></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="left"><span style="font-family: &quot;Times New Roman&quot;; color: #000000;"><br /></span></td>
<td style="font-size: 12px;font-family:arial,times new roman;" align="center"><strong><span style="font-family: &quot;Times New Roman&quot;; color: #000000;">
	<span style="font-family: &quot;Times New Roman&quot;; color: #000000;">
		<?php 
		$mohr_lv0020->LV_LoadID($mojo_lv0016->lv361);
		echo $mohr_lv0020->lv002;
		?>
	</span>
	</strong>
</td>

</tr>
</tbody>
</table>
</center>

</body>
</html>					
<?php
} else {
	include("../permit.php");
}
?>
