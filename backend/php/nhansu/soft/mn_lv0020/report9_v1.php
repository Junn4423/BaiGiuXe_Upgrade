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
require_once("../../clsall/cr_lv0171.php");
require_once("../../soft/librarianconfig.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mohr_lv0001=new hr_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0001');
$mowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0020');
$mowh_lv0003=new wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
$mocr_lv0176=new cr_lv0176($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0022');
$lvcr_lv0292=new cr_lv0292($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0229');
$lvcr_lv0171=new cr_lv0171($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0171');  

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0024.txt",$plang);
$mowh_lv0021->lang=strtoupper($plang);
$mowh_lv0021->lv001=$vlv001;
$mowh_lv0021->an1=$_GET['txtan1'];
$mowh_lv0021->an2=$_GET['txtan2'];
$vTypeID=(int)$_GET['TypeID'];
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
<script language="javascript">
    function ShowContract()
{
	document.getElementById('idhdsl').style.display='block';
}
function HiddenContract()
{
	document.getElementById('idhdsl').style.display='none';
}
function ViewRpt()
{
	var o=document.frmpost;
	o.txtShowRpt.value=1;
	o.txtsave.value=0;
	o.txtEdit.value=0;
	o.submit();

}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()" ondblclick="ShowContract()">
<?php
if ($sExport != "excel" && $sExport != "word") {
?>	
<center>	
<div id="idhdsl" style="display:none;clear:both;width:100%;overflow:hidden">
	<form name="frmpost" action="#" method="get">
		<input type="hidden" name="func" value="child" />
		<input type="hidden" name="childfunc" value="rpt9" />
		
		<input type="hidden" name="ID" id="ID" value="<?php echo  $_GET['ID'] ?? '';?>"/>

		<div style="clear:both;font:bold 14px arial;width:780px;color:blue" >
        <table>
            <tr>
                <td nowrap>
                    Chọn mẫu
                </td>
                <td>
                    <select style="width:100px;color:blue"   name="TypeID"  id="TypeID"  tabindex="6"  onKeyPress="return CheckKey(event,7)"  onKeyPress="return CheckKey(event,7)">
                        <option value="" <?php echo ($vTypeID=='')?'selected="selected"':'';?>>Mẫu tổng hợp</option>
                        <option value="1" <?php echo ($vTypeID=='1')?'selected="selected"':'';?>>In cả 3 tiền tệ</option>
                        <option value="2" <?php echo ($vTypeID=='2')?'selected="selected"':'';?>>In tiền tệ chính</option>
                        <option value="3" <?php echo ($vTypeID=='3')?'selected="selected"':'';?>>In tiền tệ thứ 2</option>
                        <option value="4" <?php echo ($vTypeID=='4')?'selected="selected"':'';?>>In tiền tệ VND</option>
                        <option value="5" <?php echo ($vTypeID=='5')?'selected="selected"':'';?>>In tiền tệ chính + VND</option>
                        <option value="6" <?php echo ($vTypeID=='6')?'selected="selected"':'';?>>In tiền tệ chính + thứ 2</option>
                        <option value="7" <?php echo ($vTypeID=='7')?'selected="selected"':'';?>>In tiền tệ VND + thứ 2</option>
                    </select>		
            </td>
            <td nowrap>
			 Ẩn 1(SL BH,SL mua thêm)</td>
            </td>
            <td><input type="checkbox" name="txtan1" style="width:30px;color:blue" value=1 <?php echo ($_GET['txtan1']==1)?'checked="checked"':'';?>/></td>
            <td nowrap>
            Ẩn 2(SP Lỗi & TG trả)</td>
              <td><input type="checkbox" name="txtan2" style="width:30px;color:blue" value=1 <?php echo ($_GET['txtan2']==1)?'checked="checked"':'';?>/></td>
            <td>
                    <select name="childfuncchild" id="childfuncchild">
                        <option value=''>..Xuất file..</option>
                        <option value='word'>Word</option>
                        <option value='excel'>Excel</option>
                    </select>
            </td>
            <td><input style="width:80px;color:blue;padding:2px;;height:20px;" type="button" onclick="document.frmpost.submit()" value="Chấp nhận"/></td>
            <td><input style="width:100px;color:blue;padding:2px;;height:20px;" type="button" onclick="HiddenContract()" value="Ẩn chức năng"/>
            </td>
            </tr>
      </table>
			</div>
		</div>
	</form>
</div>
</center>	
<?php
}
?>

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
    <td style="font-family: Arial; font-size: 12px;" colspan="3" rowspan="8"  align="center" valign="top">
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
			<tr><td><strong><span style="color: #000000; font-size: 32px;">PURCHASE ORDER</span></strong></td></tr>
		</table>
		</span>
        </td>
        <td></td><td></td> <td></td>
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
        <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"></span></td>
        </tr>
        <tr>
        <td></td><td></td> <td></td>
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
                <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
			</tr>
    <tr>
    
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
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    <tr>
        <td></td><td></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;border-left: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">PROJECT</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">PI NO.</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">GOOD LOADING
Air/Sea</span></strong></td>
        <!--<td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"> <strong><span style="color: #000000; font-size: 12px;">PROJECT<br />FISRT DELIVERY<br /></span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"> <strong><span style="color: #000000; font-size: 12px;">PROJECT<br />SECOND DELIVERY<br /></span></strong></td>-->
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Loading Place</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">SHIPPING<br />BY</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Country<br/>LOCAL</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">LOADING<br />EX/FOB/CNF/DDP</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CHARGE<br />DOC E/D/CO</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CHARGE EXPRESS<br />DOC E/D/CO</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CHARGE EXPRESS<br/>FAULT PRODUCT</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">NAME EXPRESS<br />FAULT PRODUCT</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CHARGE EXPRESS<br/>FAULT PRODUCT</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"></span></td>
    </tr>
    <tr>
        <td></td><td></td>
        <td style=  "font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv031;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv032;?>
        </span></strong></td>
        <!--
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv033;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv034;?>
        </span></strong></td>
        -->
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
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->getvaluelink('lv054',$lvcr_lv0292->lv054);?>&nbsp;
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->getvaluelink('lv055',$lvcr_lv0292->lv055);?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv056;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    <tr>
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
        <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    <tr>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;border-left: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">IV</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">CO E/D</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CO</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">CQ</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">PL</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">SUR/ORIGIN B/I</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CERT WARRANTY</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">TEST WARRANTY<br />SAMPLE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">IES File & Test Integrating Sphere</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">DRAWING</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">MANUAL MAINTENAN</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CER. LM80 CHIP</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CER. LM79 LIGHT</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">CER. IEC/EN/EMC</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"></span></td>
    </tr>
    <tr>
        <td style=  "font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv071;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv072;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv073;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv074;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv075;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv076;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv077;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv078;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv079;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv080;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv081;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv082;?>&nbsp;
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv083;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv084;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
   
    <!-- 
    <tr>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;border-left: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">Warranty Time</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">FAULT PRODUCT<br/>WARRANTY</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">Q'TY<br />WARRANTY</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;">NAME EXPRESS<br />FAULT PRODUCT</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 12px;">Currancy DATE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 12px;">Currancy RATE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 12px;">Currancy DATE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 12px;">Currancy RATE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"></span></td>
    </tr>
    <tr>
        <td style=  "min-height:20px;font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->getvaluelink('lv051',$lvcr_lv0292->lv051);?>&nbsp;
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv052;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv053;?>
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
        <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    </tr>
    -->
            <tr>
                
                <td style="font-family: Arial; font-size: 12px;" align="left" valign="middle"><strong><span style="color: #000000; font-size: xx-large;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"></span></strong></td>
                <td style="font-family: Arial; font-size: 12px;" height="20" align="left" valign="middle"><strong><span style="color: #000000; font-size: xx-large;"></span></strong></td>
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
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Actual Quantity</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Warranty Time</span></strong></td>
    <?php   
    if($mowh_lv0021->an1!=1)
    {?>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Qty</span></strong></td>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Stock</span></strong></td>
    <?php
    }
    ?>
    <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Unit</span></strong></td>
    <?php
    $vCot13=false;
    $vCot14=false;
    $vCot15=false;
    switch($vTypeID)
    {
        case '0';
        case '1':
        case '2';
        case '5':
        case '6';
            $vCot13=true;
            echo '<td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Unit Amount ('.$mowh_lv0021->lv016.')</span></strong></td>';
            break;
        default:
            echo '';
            break;
    }
    ?> 
    <?php
    switch($vTypeID)
    {
        case '0';
        case '1':
        case '3':
        case '6';
        case '7';
            $vCot14=true;
            echo '<td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Unit Amount ('.$mowh_lv0021->lv012.')</span></strong></td>';
            break;
        default:
            echo '';
            break;
    }
    ?> 
    <?php
    switch($vTypeID)
    {
        case '0';
        case '1':
        case '4';
        case '5';
        case '7';
            $vCot15=true;
            echo '<td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Unit Amount (VND)</span></strong></td>';
            break;
        default:
            echo '';
            break;
    }
    $vTruCot=(($vCot13)?0:1)+(($vCot14)?0:1)+(($vCot15)?0:1)+($mowh_lv0021->an1!=1)?0:2; 
   if($vCot13) echo '<td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Amount ('.$mowh_lv0021->lv016.')</span></strong></td>';
   if($vCot14) echo '<td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Amount ('.$mowh_lv0021->lv012.')</span></strong></td>';
   if($vCot15) echo '<td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">Amount (VND)</span></strong></td>';
    ?> 
    <?php
    if($mowh_lv0021->an2!=1)
    {
    ?>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">FAULT PRODUCT<br/>TYPE</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">FAULT PRODUCT<br/>Q'TY</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="middle" bgcolor="#F4B183"><strong><span style="color: #000000; font-size: 14px;">FAULT PRODUCT<br/>TIME RETURN</span></strong></td>
    <?php
    }
    ?>  
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
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <?php
    }
    ?>
    <?php
    if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>';
    if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>';
    if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>';
    if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>';
    if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>';
    if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>';
    ?>
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
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@10</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@19</span></td>
    '.(($mowh_lv0021->an1!=1)?'
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@09</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@11</span></td>
    ':'').'
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@12</span></td>
    '.(($vCot13)?'<td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@13</span></td>':'').'
    '.(($vCot14)?'<td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@14</span></td>':'').'
    '.(($vCot15)?'<td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@15</span></td>':'').'
    '.(($vCot13)?'<td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@16</span></td>':'').'
    '.(($vCot14)?'<td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@17</span></td>':'').'
    '.(($vCot15)?'<td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@18</span></td>':'').'
    '.(($mowh_lv0021->an2!=1)?'
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@20</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@21</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@22</span></td>
    ':'').'
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
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@10</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@19</span></td>
    '.(($mowh_lv0021->an1!=1)?'
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@09</span></td>
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@11</span></td>':'').'
    <td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><span style="color: #000000;">@12</span></td>
    '.(($vCot13)?'<td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@13</span></td>':'').'
    '.(($vCot14)?'<td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@14</span></td>':'').'
    '.(($vCot15)?'<td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@15</span></td>':'').'
    '.(($vCot13)?'<td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@16</span></td>':'').'
    '.(($vCot14)?'<td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@17</span></td>':'').'
    '.(($vCot15)?'<td style="font-family: Arial; font-size: 12px;  border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><span style="color: #000000;">@18</span></td>':'').'
    '.(($mowh_lv0021->an1!=1)?'
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@20</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@21</span></td>
    <td style="font-family: Arial; font-size: 12px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><span style="color: #000000;">@22</span></td>
    ':'').'
    </tr>';
    $vArrDinhKem=$lvcr_lv0171->LV_GetDinhKemGMH($mowh_lv0021->lv001);
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
        $vTrTemp=str_replace("@06",$vrow['lv154'],$vTrTemp);
        //Original
        $vTrTemp=str_replace("@07",$vrow['lv050'],$vTrTemp);
        //Brand
        $vTrTemp=str_replace("@08",$vrow['lv049'],$vTrTemp);
        //Qty	
        $vTrTemp=str_replace("@09",$mocr_lv0176->FormatView($vrow['lv204'],20),$vTrTemp);
        //Actual Quantity	
        $vTrTemp=str_replace("@10",$mocr_lv0176->FormatView($vrow['lv004'],20),$vTrTemp);
        //Stock
        $vTrTemp=str_replace("@11",$mocr_lv0176->FormatView($vrow['lv004']-$vrow['lv204'],20),$vTrTemp);
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
         //Warranty Time
         $vTrTemp=str_replace("@19",$vrow['lv140'],$vTrTemp);
         //Fault Product Type
        $vTrTemp=str_replace("@20",$vrow['lv141'],$vTrTemp);
        //FAULT PRODUCT Q'TY
        $vTrTemp=str_replace("@21",$vrow['lv142'],$vTrTemp);
         //SP lỗi trả về
         $vTrTemp=str_replace("@22",$vrow['lv143'],$vTrTemp);
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
    <?php
        
       
        ?>
            <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">TT Advance Payment</span></strong>:<span style="color: #000000; font-size: 14px;"> <?php echo $mowh_lv0021->getvaluelink('lv007',$mowh_lv0021->lv007);?></span></td>
        <?php
       
        ?>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
        <td colspan="<?php echo (4-$vTruCot);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">TOTAL</span></strong></td>
        <td colspan="<?php echo ($vTypeID==0)?3:1;?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
       <?php
        if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($slv054,20).'</strong></span></td>';
        if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($slv163,20).'</strong></span></td>';
        if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($slv063,20).'</strong></span></td>';
       ?> 
    </tr>
    <tr>
    <?php
        if(count($vArrDinhKem)>0)
        {
        ?>
            <td colspan="2" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Bank Name:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv003;?></span></strong></td>
            <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[1][1];?></span></td>-->
            <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center" bgcolor="#FFC000"><span style="color: #000000;"><strong>DOC</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center" bgcolor="#FFC000"><span style="color: #000000;"><strong>ORGINAL</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
        <?php
        }
        else
        {
        ?>
            <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Bank Name:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv003;?></span></strong></td>
       <?php
        }
        ?> 
        <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
        <td colspan="<?php echo (4-$vTruCot);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">Extra Discount.:</span></span></strong></td>
        <td colspan="<?php echo ($vTypeID==0)?3:1;?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
        <?php
        if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($vTienDisCount,20).'</span></td>';
        if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($vTienDisCount163,20).'</span></td>';
        if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($vTienDisCount63,20).'</span></td>';
       ?> 
    </tr>    
    <tr>
    <?php
    if($vArrDinhKem[1][1]>0)
    {
    ?>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;">Bank Address:</span><span> <?php echo $lvcr_lv0292->lv004;?></span></strong></td>
        <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[1][1];?></span></td>-->
        <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>1.<?php echo $vArrDinhKem[1][2];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[1][5];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
    <?php
    }
    else
    {
    ?>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;">Bank Address:</span><span> <?php echo $lvcr_lv0292->lv004;?></span></strong></td>
    <?php
    }
    ?> 
    
    <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="<?php echo (4-$vTruCot);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">VAT.:</span></span></strong></td>
    <td colspan="<?php echo ($vTypeID==0)?3:1;?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <?php
        if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($vTienVAT,20).'</strong></span></td>';
        if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($vTienVAT163,20).'</strong></span></td>';
        if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($vTienVAT63,20).'</strong></span></td>';
    ?>    
    </tr>
    <tr>
    <?php
    if($vArrDinhKem[2][1]>0)
    {
    ?>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Account No.:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv005;?></span></td>
        <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[2][1];?></span></td>-->
        <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>2.<?php echo $vArrDinhKem[2][2];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[2][5];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
    <?php
    }
    else
    {
    ?>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Account No.:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv005;?></span></td>
    <?php
    }
    ?> 
    <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="<?php echo (4-$vTruCot);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">Net Amount:</span></strong></td>
    <td colspan="<?php echo ($vTypeID==0)?3:1;?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <?php
        if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($slv054_CoVAT,20).'</strong></span></td>';
        if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($slv163_CoVAT,20).'</strong></span></td>';
        if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($slv063_CoVAT,20).'</strong></span></td>';
    ?>    
    </tr>
    <tr>
    <?php
    if($vArrDinhKem[3][1]>0)
    {
    ?>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Beneficiary:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv006;?></span></td>
        <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[3][1];?></span></td>-->
        <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>3.<?php echo $vArrDinhKem[3][2];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[3][5];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
    <?php
    }
    else
    {
    ?>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Beneficiary:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv006;?></span></td>
    <?php
    }
    ?>     
    <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="<?php echo (4-$vTruCot);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">First Deposit:</span></span></strong></td>
    <td colspan="<?php echo ($vTypeID==0)?3:1;?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <?php
        if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($sTienDot1,20).'</span></td>';
        if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($sTienDot1_163,20).'</span></td>';
        if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($sTienDot1_63,20).'</span></td>';
    ?>    
    </tr>
    <tr>
    <?php
    if($vArrDinhKem[4][1]>0)
    {
    ?>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">Swift Code: <?php echo $lvcr_lv0292->lv007;?></span></td>
        <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[4][1];?></span></td>-->
        <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>4.<?php echo $vArrDinhKem[4][2];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[4][5];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
    <?php
    }
    else
    {
    ?>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">Swift Code: <?php echo $lvcr_lv0292->lv007;?></span></td>
    <?php
    }
    ?> 
    <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="<?php echo (4-$vTruCot);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">Second Deposit:</span></span></strong></td>
    <td colspan="<?php echo ($vTypeID==0)?3:1;?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <?php
        if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($sTienDot2,20).'</span></td>';
        if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($sTienDot2_163,20).'</span></td>';
        if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($sTienDot2_63,20).'</span></td>';
    ?>    
    </tr>
    <tr>
    <?php
    if($vArrDinhKem[5][1]>0)
    {
    ?>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;">IBAN: <?php echo $lvcr_lv0292->lv008;?></span></td>
        <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[5][1];?></span></td>-->
        <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>5.<?php echo $vArrDinhKem[5][2];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[5][5];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
    <?php
    }
    else
    {
    ?>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;">IBAN: <?php echo $lvcr_lv0292->lv008;?></span></td>
    <?php
    }
    ?>
    <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="<?php echo (4-$vTruCot);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">Third Deposit:</span></span></strong></td>
    <td colspan="<?php echo ($vTypeID==0)?3:1;?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <?php
        if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($sTienDot3,20).'</span></td>';
        if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($sTienDot3_163,20).'</span></td>';
        if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;">'.$mocr_lv0176->FormatView($sTienDot3_63,20).'</span></td>';
    ?>    
    </tr>
    <tr>
    <?php
    if($vArrDinhKem[6][1]>0)
    {
    ?>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
        <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[6][1];?></span></td>-->
        <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>6.<?php echo $vArrDinhKem[6][2];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[6][5];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
    <?php
    }
    else
    {
    ?>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
    <?php
    }
    ?> 
    <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="<?php echo (4-$vTruCot);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">Total Net Amount:</span></strong></td>
    <td colspan="<?php echo ($vTypeID==0)?3:1;?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <?php
        if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($sTienConLai,20).'</strong></span></td>';
        if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($sTienConLai_163,20).'</strong></span></td>';
        if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.$mocr_lv0176->FormatView($sTienConLai_63,20).'</strong></span></td>';
    ?> 
    </tr>
    <tr>
    <?php
    if($vArrDinhKem[7][1]>0)
    {
    ?>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
        <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[7][1];?></span></td>-->
        <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>7.<?php echo $vArrDinhKem[7][2];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[7][5];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
    <?php
    }
    else
    {
    ?>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
    <?php
    }
    ?> 
    <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td colspan="<?php echo (4-$vTruCot);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><strong><span style="color: #000000; font-size: 14px;">Payment Percent(%): <span style="color:red"><?php echo $mocr_lv0176->FormatView($vTongPercent,20).(($vTongPercent>0)?'%':'');?></span></span></strong></td>
    <td colspan="<?php echo ($vTypeID==0)?3:1;?>" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <?php
        if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.($mocr_lv0176->FormatView($sPercent,20).(($sPercent>0)?'%':'')).'</strong></span></td>';
        if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.($mocr_lv0176->FormatView($sPercent_163,20).(($sPercent_163>0)?'%':'')).'</strong></span></td>';
        if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="bottom"><span style="color: #000000;"><strong>'.($mocr_lv0176->FormatView($sPercent_63,20).(($sPercent_63>0)?'%':'')).'</strong></span></td>';
    ?> 
    </tr>    
    <tr>
    <?php
    if($vArrDinhKem[8][1]>0)
    {
    ?>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
        <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[8][1];?></span></td>-->
        <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>8.<?php echo $vArrDinhKem[8][2];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[8][5];?></strong></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
    <?php
    }
    else
    {
    ?>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
    <?php
    }
    ?> 
    <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            ?>
    </tr>
    <?php
    if($vArrDinhKem[9][1]>0)
    {
    ?>
        <tr>
            <td colspan="3" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
            <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[9][1];?></span></td>-->
            <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>9.<?php echo $vArrDinhKem[9][2];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[9][5];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            ?>
        </tr>
    <?php
    }
    ?> 
    <?php
    if($vArrDinhKem[10][1]>0)
    {
    ?>
        <tr>
            <td colspan="3" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
            <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[10][1];?></span></td>-->
            <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>11.<?php echo $vArrDinhKem[10][2];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[10][5];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            ?>
        </tr>
    <?php
    }
    ?> 
    <?php
    if($vArrDinhKem[11][1]>0)
    {
    ?>
        <tr>
            <td colspan="3" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
            <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[11][1];?></span></td>--->
            <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>12.<?php echo $vArrDinhKem[11][2];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[11][5];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
           <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            ?>
        </tr>
    <?php
    }
    ?> 
    <?php
    if($vArrDinhKem[12][1]>0)
    {
    ?>
        <tr>
            <td colspan="3" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
            <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[12][1];?></span></td>-->
            <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>12.<?php echo $vArrDinhKem[12][2];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[12][5];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
           <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            ?>
        </tr>
    <?php
    }
    ?> 
    <?php
    if($vArrDinhKem[13][1]>0)
    {
    ?>
        <tr>
            <td colspan="3" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
            <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[13][1];?></span></td>-->
            <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>13.<?php echo $vArrDinhKem[13][2];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[13][5];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
           <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            ?>
        </tr>
    <?php
    }
    ?> 
    <?php
    if($vArrDinhKem[14][1]>0)
    {
    ?>
        <tr>
            <td colspan="3" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
            <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[14][1];?></span></td>-->
            <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>14.<?php echo $vArrDinhKem[14][2];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[14][5];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
           <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            ?>
        </tr>
    <?php
    }
    ?> 
    <?php
    if($vArrDinhKem[15][1]>0)
    {
    ?>
        <tr>
            <td colspan="3" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
            <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[15][1];?></span></td>-->
            <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>15.<?php echo $vArrDinhKem[15][2];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[15][5];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            ?>
        </tr>
    <?php
    }
    ?> 
    <?php
    if($vArrDinhKem[16][1]>0)
    {
    ?>
        <tr>
            <td colspan="3" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
            <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"><?php echo $vArrDinhKem[16][1];?></span></td>-->
            <td nowrap bgcolor="#F4B183" style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left"><span style="color: #000000;"><strong>15.<?php echo $vArrDinhKem[16][2];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center"><span style="color: #000000;"><strong><?php echo $vArrDinhKem[16][5];?></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            ?>
        </tr>
    <?php
    }
    ?> 
    <tr>
            <td colspan="3" style="font-family: Arial; font-size: 12px;" height="28" align="left" valign="bottom"><span style="color: #000000; font-size: 14px;"></span></td>
            <td nowrap  style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"></span></td><!--<td nowrap  style="font-family: Arial; font-size: 12px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center"><span style="color: #000000;"></span></td>-->
            <td nowrap style="font-family: Arial; font-size: 12px;" align="left"><span style="color: #000000;"><strong></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong></strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td nowrap style="font-family: Arial; font-size: 12px;" align="center"><span style="color: #000000;"><strong>&nbsp;</strong></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            ?>
        </tr>
    <tr>
    <td colspan="8" style="font-family: Arial; font-size: 12px;font-family: Arial; font-size: 12px; border-top: 2px solid #000000;" height="33" align="left" valign="middle">
        <table width="100%">
        <tr><td width="33%" align="center"><strong>Purchase</strong></td>
        <td  width="33%" align="center"><strong> Authorized By</strong></td>
        <td width="*%" align="center"><strong>Accountant Manager</strong></td>
        <tr></table>
    </td>   
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;">Supplier :</span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <?php
    }
    ?>
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
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <?php
    }
    ?>
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
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <?php
    }
    ?>
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
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <?php
    }
    ?>
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
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <?php
    }
    ?>
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
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
    <?php
    }
    ?>
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
