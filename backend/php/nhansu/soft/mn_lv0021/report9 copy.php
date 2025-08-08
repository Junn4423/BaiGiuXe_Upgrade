<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");	
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0001.php");
require_once("../../clsall/wh_lv0021.php");
require_once("../../clsall/wh_lv0022.php");
require_once("../../clsall/wh_lv0003.php");
require_once("../../clsall/cr_lv0176.php");
require_once("../../clsall/cr_lv0292.php");
require_once("../../soft/librarianconfig.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mohr_lv0001=new hr_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0001');
$mowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0021');
$mowh_lv0003=new wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
$mocr_lv0176=new cr_lv0176($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0022');
$lvcr_lv0292=new cr_lv0292($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0229');

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0024.txt",$plang);
$mowh_lv0021->lang=strtoupper($plang);
$mowh_lv0021->lv001=$vlv001;

if($mowh_lv0021->GetView()==1)
{
?>
<html>
<head>
<title><?php echo $mowh_lv0021->ArrPush[0];?></title>
<style>
body
{
	font-family:arial,times new roman!important;
}
.center_style
{
	text-align:center;
}
.lvtable
{
	border-spacing: 0px!important; 
     border-radius: 0px!important;
}
table, td {
    color: #000;
    font-size: 12px!important;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<?php  
	$mowh_lv0021->LV_LoadID($vlv001);
    $lvcr_lv0292->LV_LoadLanGiaoHangGroup($mowh_lv0021->lv087,'');
	$mocr_lv0176->mowh_lv0021=$mowh_lv0021;
	//$mowh_lv0003->LV_LoadID($mowh_lv0021->lv002);	
	?>
	<table style="font-family: Arial; font-size: 12px;" border="0" cellspacing="0">
    <colgroup width="186"></colgroup><colgroup width="429"></colgroup><colgroup width="250"></colgroup><colgroup width="216"></colgroup><colgroup width="244"></colgroup><colgroup width="183"></colgroup><colgroup width="223"></colgroup><colgroup width="192"></colgroup><colgroup span="2" width="193"></colgroup><colgroup width="212"></colgroup><colgroup span="4" width="192"></colgroup> 
    <tbody>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" colspan="3" rowspan="10"  align="center" valign="top">
		<span style="color: #000000;">
		<table>
		<tr><td>&nbsp;</td></tr>
			
			
			<tr><td valign="top">
                <table>
                    <tr>
                        <td width="120">  
                            <img src="../../logo.png" width="120"/>
                        </td> 
                        <td>
                                    <div style="float:left;text-align:left;width:60%;font-size:12px;font-family:arial, times new roman;white-space:nowrap;">
                        <strong><span style="text-align:left;font-size:16px;font-family:arial, times new roman;">
                        <?php echo 'MINH PHUONG INVESTMENT TECHNOLOGY JSC';//$vTenCongTy;?></span></strong>
                        <br><?php //echo $vTenDiaChi;?><?php echo '101 Ung Van Khiem St., Ward 25 , Binh Thanh Dist, HCM City, VN';//$vDiaChi;?>
                        <br/>
                        <?php echo 'Mrs. CINDY/THAO : +84.906657877 MAIL: cindythao@SOF.biz';?> 
                        <br/>
                        <?php echo 'Address receive Doc & Goods: 54 An Phu Dong 13, Ward An Phu Dong,<br/> District 12, Viet Nam';?>
                            </div>
                        </td>
                    </tr>
                </table>
			</td></tr>		
            <tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>	
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td><strong><span style="color: #000000; font-size: 32px;">PURCHASE ORDER</span></strong></td></tr>
		</table>
		</span>
        </td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;border-left: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">VENDOR</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">P.O. SUPPLIER</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">ISSUE DATE<br /></span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">DELIVERY DATE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">LIMITED DELIVERY</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">SAMPLE CHECK<br /></span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CHARGE<br />SAMPLE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">LOADING SAMPLE<br />DATE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CHARGE  LOADING SAMPLE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">FISRT DELIVERY<br/>DATE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">SECOND DELIVERY<br/>DATE</span></strong></td>
        </tr>
        <tr>
				<td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
				<td style=  "font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv011;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv012;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv013;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv014;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv015;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv016;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv017;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv018;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv019;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv020;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv021;?>
				</span></strong></td>
			</tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">1</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">2</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">3</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">4</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">5</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">6</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">7</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">8</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">9</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">10</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">11</span></td>
    </tr>
    <tr>
    <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"></span></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;border-left: 2px solid #000000;" align="center" valign="top"> <strong><span style="color: #000000; font-size: 12px;">PROJECT</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"> <strong><span style="color: #000000; font-size: 12px;">PI NO.</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">GOOD LOADING
Air/Sea</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"> <strong><span style="color: #000000; font-size: 12px;">PROJECT<br />FISRT DELIVERY<br /></span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"> <strong><span style="color: #000000; font-size: 12px;">PROJECT<br />SECOND DELIVERY<br /></span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Loading Place</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">SHIPPING<br />BY</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Country<br/>LOCAL</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">LOADING<br />EX/FOB/CNF/DDP</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CHARGE<br />DOC E/D/CO</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CHARGE EXPRESS<br />DOC E/D/CO</span></strong></td>
    </tr>
    <tr>
				<td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
				<td style=  "font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv031;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv032;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv033;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv034;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv035;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->getvaluelink('lv036',$lvcr_lv0292->lv036);?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv037;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv038;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv039;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv040;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv041;?>
				</span></strong></td>
			</tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">1</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">2</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">3</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">4</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">5</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">6</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">7</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">8</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">9</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">10</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">11</span></td>
    </tr>
    <tr>
    <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"></span></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;border-left: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">Warranty Time</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">FAULT PRODUCT<br/>WARRANTY</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">Q'TY<br />WARRANTY</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">CHARGE EXPRESS<br/>FAULT PRODUCT</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">NAME EXPRESS<br />FAULT PRODUCT</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">CHARGE EXPRESS<br/>FAULT PRODUCT</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">NAME EXPRESS<br />FAULT PRODUCT</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 12px;">Currancy DATE</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 12px;">Currancy RATE</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 12px;">Currancy DATE</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 12px;">Currancy RATE</span></strong></td>
    </tr>
    <tr>
				<td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
				<td style=  "font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->getvaluelink('lv051',$lvcr_lv0292->lv051);?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv052;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv053;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->getvaluelink('lv054',$lvcr_lv0292->lv054);?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->getvaluelink('lv055',$lvcr_lv0292->lv055);?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv056;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv057;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv058;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv059;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv060;?>
				</span></strong></td>
				<td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
					<?php echo $lvcr_lv0292->lv061;?>
				</span></strong></td>
			</tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="30" align="left" valign="middle"><strong><span style="color: #000000; font-size: xx-large;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: xx-large;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="30" align="center" valign="middle"><span style="color: #000000;">1</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">2</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">3</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">4</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">5</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">6</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">7</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">8</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">9</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">10</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">11</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">12</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">13</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">14</span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="middle"><span style="color: #000000;">15</span></td>
    </tr>
    <tr>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;border-left: 2px solid #000000;" height="35" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Line</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Description</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Picture</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Model</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Order No</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Model Sup</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Original</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Brand</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Qty</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Actual Quantity</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Stock</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Unit</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Unit Amount (<?php echo $mowh_lv0021->lv016;?>)</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Unit Amount (<?php echo $mowh_lv0021->lv012;?>)</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Unit Amount (VND)</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Amount (<?php echo $mowh_lv0021->lv016;?>)</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Amount (<?php echo $mowh_lv0021->lv012;?>)</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Amount (VND)</span></strong></td>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
	<?php 
	$vTr='
    <tr>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;border-left: 1px solid #000000;" align="center" valign="middle"><span style="color: #000000;">@01</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@02</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@03</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@04</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@05</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@06</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@07</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@08</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@09</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@10</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@11</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@12</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@13</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@14</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@15</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@16</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@17</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@18</span></td>
    </tr>';
    $vTrNext='
    <tr>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000;border-left: 1px solid #000000;" align="center" valign="middle"><span style="color: #000000;">@01</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@02</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@03</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@04</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@05</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@06</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@07</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@08</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@09</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@10</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@11</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@12</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@13</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@14</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@15</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@16</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@17</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@18</span></td>
    </tr>';
	$sqlS = "SELECT A.*,AA.lv011 Description FROM wh_lv0022 A left join wh_lv0022_des AA on A.lv001=AA.lv001 WHERE A.lv002='$mowh_lv0021->lv001' $strSort";
    $bResult = db_query($sqlS);
    $vOrder=0;
    $vSoDong=0;
    $vCodeCheck='11111111111111111111';
    $vUnitName='';
    while ($vrow = db_fetch_array ($bResult))
    {
        $vOrder++;
        if($vOrder==1)
            $vTrTemp=$vTr;
        else
            $vTrTemp=$vTrNext;
        $vTrTemp=str_replace("@01",$vOrder,$vTrTemp);
        $vrow['lv011']=(trim($vrow['Description'])!='' && $vrow['Description']!=null)?$vrow['Description']:$vrow['lv011'];
        $vrow['lv011']=str_replace("\n\r","<br/>",$vrow['lv011']);
        $vrow['lv011']=str_replace("\r\n","<br/>",$vrow['lv011']);
        $vrow['lv011']=str_replace("\n","<br/>",$vrow['lv011']);
        $vrow['lv011']=str_replace("\r","<br/>",$vrow['lv011']);
        $vrow['lv011']=str_replace("<br/><br/><br/><br/>","<br/>",$vrow['lv011']);
        $vrow['lv011']=str_replace("<br/><br/><br/>","<br/>",$vrow['lv011']);
        $vrow['lv011']=str_replace("<br/><br/>","<br/>",$vrow['lv011']);
        $vTrTemp=str_replace("@02",$vrow['lv011'],$vTrTemp);

        $lvImg="<center><a target='_blank' href='".$mocr_lv0176->ImageLink."../cr_lv0176/readfile.php?UserID=".$vrow['lv001']."&type=8&size=0'><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width1=\"96px\" height=\"48px\" src=\"".$mocr_lv0176->ImageLink."../cr_lv0176/readfile.php?UserID=".$vrow['lv001']."&type=8&size=1\" /></a></center>";
        $vTrTemp=str_replace("@03",$lvImg,$vTrTemp);
        //Model
        $vTrTemp=str_replace("@04",$vrow['lv008'],$vTrTemp);
        //Order No.
        $vTrTemp=str_replace("@05",$vrow['lv009'],$vTrTemp);
        //Mode Sup
        $vTrTemp=str_replace("@06",'',$vTrTemp);
        //Original
        $vTrTemp=str_replace("@07",$vrow['lv050'],$vTrTemp);
        //Brand
        $vTrTemp=str_replace("@08",$vrow['lv049'],$vTrTemp);
        //Qty	
        $vTrTemp=str_replace("@09",$vrow['lv004'],$vTrTemp);
        //Actual Quantity	
        $vTrTemp=str_replace("@10",$vrow['lv004'],$vTrTemp);
        //Stock
        $vTrTemp=str_replace("@11",'',$vTrTemp);
        //Unit
        $vTrTemp=str_replace("@12",$vrow['lv005'],$vTrTemp);
        //Amount (USD)	
        $vTrTemp=str_replace("@13",$mocr_lv0176->FormatView(round($vrow['lv054']/$vrow['lv004'],2),20),$vTrTemp);
        //Amount (SGD)
        $vTrTemp=str_replace("@14",$mocr_lv0176->FormatView(round($vrow['lv163']/$vrow['lv004'],2),20),$vTrTemp);
        //Amount (VND)
        $vTrTemp=str_replace("@15",$mocr_lv0176->FormatView(round($vrow['lv063']/$vrow['lv004'],0),20),$vTrTemp);

        //Amount (USD)	
        $vTrTemp=str_replace("@16",$mocr_lv0176->FormatView($vrow['lv054'],20),$vTrTemp);
        //Amount (SGD)
        $vTrTemp=str_replace("@17",$mocr_lv0176->FormatView($vrow['lv163'],20),$vTrTemp);
        //Amount (VND)
        $vTrTemp=str_replace("@18",$mocr_lv0176->FormatView($vrow['lv063'],20),$vTrTemp);
        //@01
        $slv004=$slv004+$vrow['lv004'];
        $slv006=$slv006+$vrow['lv006'];
        $slv054=$slv054+$vrow['lv054'];
        $slv063=$slv063+$vrow['lv063'];
        $slv163=$slv163+$vrow['lv163'];

        echo $vTrTemp;
    }
    $vDiscount=(float)$mowh_lv0021->lv108;
    $vTienDisCount=round($slv054*$vDiscount/100,0);
    $vTienDisCount63=round($slv063*$vDiscount/100,0);
    $vTienDisCount163=round($slv163*$vDiscount/100,0);

    $vVAT=(float)$mowh_lv0021->lv006;
    $vTienVAT=($slv054-$vTienDisCount+$vCostShip)*$vVAT/100;
    $vTienVAT63=($slv063-$vTienDisCount+$vCostShip)*$vVAT/100;
    $vTienVAT163=($slv163-$vTienDisCount+$vCostShip)*$vVAT/100;

    $slv054_CoVAT=$slv054+$vTienVAT-$vTienDisCount;
    $slv063_CoVAT=$slv063+$vTienVAT63-$vTienDisCount63;
    $slv163_CoVAT=$slv163+$vTienVAT163-$vTienDisCount163;
////////////Chi tiền đợt 1
    $vDot='0,1';
    $sTienDot1=$mowh_lv0021->LV_GetPCMoneyDot($mowh_lv0021->lv001,$vDot,$mowh_lv0021->lv016);
    $sTienDot1_163=$mowh_lv0021->LV_GetPCMoneyDot($mowh_lv0021->lv001,$vDot,$mowh_lv0021->lv012);
    $sTienDot1_63=$mowh_lv0021->LV_GetPCMoneyDot($mowh_lv0021->lv001,$vDot,'VND');
////////Chi tiền đợt 2
    $vDot='2';
    $sTienDot2=$mowh_lv0021->LV_GetPCMoneyDot($mowh_lv0021->lv001,$vDot,$mowh_lv0021->lv016);
    $sTienDot2_163=$mowh_lv0021->LV_GetPCMoneyDot($mowh_lv0021->lv001,$vDot,$mowh_lv0021->lv012);
    $sTienDot2_63=$mowh_lv0021->LV_GetPCMoneyDot($mowh_lv0021->lv001,$vDot,'VND');
//////// Chi tiền đợt 3
    $vDot='3,4,5,6,7,8,9';
    $sTienDot3=$mowh_lv0021->LV_GetPCMoneyDot($mowh_lv0021->lv001,$vDot,$mowh_lv0021->lv016);
    $sTienDot3_163=$mowh_lv0021->LV_GetPCMoneyDot($mowh_lv0021->lv001,$vDot,$mowh_lv0021->lv012);
    $sTienDot3_63=$mowh_lv0021->LV_GetPCMoneyDot($mowh_lv0021->lv001,$vDot,'VND');

    ////////Tiền còn lại
    $sTongTienDot=$sTienDot1 + $sTienDot2 + $sTienDot3;
    $sTienConLai=$slv054_CoVAT - $sTongTienDot;
    $sTongTienDot_163=$sTienDot1_163 + $sTienDot2_163 + $sTienDot3_163;
    $sTienConLai_163=$slv163_CoVAT - $sTongTienDot_163;
    $sTongTienDot_63=$sTienDot1_63 + $sTienDot2_63 + $sTienDot3_63;
    $sTienConLai_63=$slv063_CoVAT -  $sTongTienDot_63;

    ///////% thanh toán
    if($sTienConLai==0 || $slv054_CoVAT==0)
        $sPercent=0;
    else
        $sPercent=$sTongTienDot*100/$slv054_CoVAT;
    if($sTienConLai_163==0 || $slv163_CoVAT==0)
        $sPercent_163=0;
    else
        $sPercent_163=$sTongTienDot_163*100/$slv163_CoVAT;
    if($sTienConLai_63==0 || $slv063_CoVAT==0)
        $sPercent_63=0;
    else
        $sPercent_63=$sTongTienDot_63*100/$slv063_CoVAT;
    $vTongPercent=round($sPercent+ $sPercent_163 + $sPercent_63,2);
    $sPercent=round($sPercent,2);
    $sPercent_163=round($sPercent_163,2);
    $sPercent_63=round($sPercent_63,2);

	?>
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">TT Advance Payment</span></strong>:<span style="color: #000000; font-size: 14px;"> <?php echo $mowh_lv0021->getvaluelink('lv007',$mowh_lv0021->lv007);?></span></td>
        <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
        <td colspan="3" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">TOTAL</span></strong></td>
        <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
        <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($slv054,20);?></span></td>
        <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($slv163,20);?></span></td>
        <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($slv063,20);?></span></td>
    </tr>
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Bank Name:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv003;?></span></strong></td>
        <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
        <td colspan="3" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">Extra Discount.:</span></span></strong></td>
        <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
        <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($vTienDisCount,20);?></span></td>
        <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($vTienDisCount163,20);?></span></td>
        <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($vTienDisCount63,20);?></span></td>
    </tr>    
    <tr>
    <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;">Bank Address:</span><span> <?php echo $lvcr_lv0292->lv004;?></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="3" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">VAT.:</span></span></strong></td>
    <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($vTienVAT,20);?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($vTienVAT163,20);?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($vTienVAT63,20);?></span></td>
    </tr>
    <tr>
    <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Account No.:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv005;?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="3" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">Net Amount:</span></strong></td>
    <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($slv054_CoVAT,20);?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($slv163_CoVAT,20);?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($slv063_CoVAT,20);?></span></td>
    </tr>
    <tr>
    <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Beneficiary:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv006;?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="3" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">First Deposit:</span></span></strong></td>
    <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($sTienDot1,20);?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($sTienDot1_163,20);?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($sTienDot1_63,20);?></span></td>
    </tr>
    <tr>
    <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">Swift Code: <?php echo $lvcr_lv0292->lv007;?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="3" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">Second Deposit:</span></span></strong></td>
    <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($sTienDot2,20);?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($sTienDot2_163,20);?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($sTienDot2_63,20);?></span></td>
    </tr>
    <tr>
    <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;">IBAN: <?php echo $lvcr_lv0292->lv008;?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="3" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">Third Deposit:</span></span></strong></td>
    <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($sTienDot3,20);?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($sTienDot3_163,20);?></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><?php echo $mocr_lv0176->FormatView($sTienDot3_63,20);?></span></td>
    </tr>
    <tr>
    <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="3" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">Total Net Amount:</span></strong></td>
    <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong><?php echo $mocr_lv0176->FormatView($sTienConLai,20);?></strong></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong><?php echo $mocr_lv0176->FormatView($sTienConLai_163,20);?></strong></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong><?php echo $mocr_lv0176->FormatView($sTienConLai_63,20);?></strong></span></td>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="3" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">Payment Percent(%): <span style="color:red"><?php echo $mocr_lv0176->FormatView($vTongPercent,20).(($vTongPercent>0)?'%':'');?></span></span></strong></td>
    <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong><?php echo $mocr_lv0176->FormatView($sPercent,20).(($sPercent>0)?'%':'');?></strong></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong><?php echo $mocr_lv0176->FormatView($sPercent_163,20).(($sPercent_163>0)?'%':'');?></strong></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong><?php echo $mocr_lv0176->FormatView($sPercent_63,20).(($sPercent_63>0)?'%':'');?></strong></span></td>
    </tr>
    
    <tr>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" height="28" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-bottom: 2px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    <tr>
    <td colspan="8" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="middle">
        <table width="100%">
        <tr><td width="33%" align="center"><strong>Purchase</strong></td>
        <td  width="33%" align="center"><strong> Authorized By</strong></td>
        <td width="*%" align="center"><strong>Accountant Manager</strong></td>
        <tr></table>
    </td>   
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;">Supplier :</span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    </tbody>
    </table>
</body>
</html>					
<?php
} else {
	include("../permit.php");
}
?>
