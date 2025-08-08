<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");	
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0021.php");
require_once("../../clsall/hr_lv0001.php");
require_once("../../clsall/wh_lv0022.php");
require_once("../../clsall/wh_lv0003.php");
require_once("../../clsall/cr_lv0176.php");
require_once("../../soft/librarianconfig.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mohr_lv0001=new hr_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0001');
$mowh_lv0022=new wh_lv0022($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0022');
$mowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0020');
$mowh_lv0003=new wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
$mocr_lv0176=new cr_lv0176($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0022');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0024.txt",$plang);
$mowh_lv0021->lang=strtoupper($plang);
$mowh_lv0021->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0021->ArrPush[0]=$vLangArr[16];
$mowh_lv0021->ArrPush[1]=$vLangArr[18];
$mowh_lv0021->ArrPush[2]=$vLangArr[19];
$mowh_lv0021->ArrPush[3]=$vLangArr[20];
$mowh_lv0021->ArrPush[4]=$vLangArr[21];
$mowh_lv0021->ArrPush[5]=$vLangArr[22];
$mowh_lv0021->ArrPush[6]=$vLangArr[23];
$mowh_lv0021->ArrPush[7]=$vLangArr[24];
$mowh_lv0021->ArrPush[8]=$vLangArr[25];
$mowh_lv0021->ArrPush[9]=$vLangArr[26];
$mowh_lv0021->ArrPush[10]=$vLangArr[27];
$mowh_lv0021->ArrPush[11]=$vLangArr[28];
$mowh_lv0021->ArrPush[12]=$vLangArr[29];
$mowh_lv0021->ArrPush[13]=$vLangArr[30];
$mowh_lv0021->ArrPush[14]=$vLangArr[31];	
$mowh_lv0021->ArrPush[15]=$vLangArr[32];
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12,13";
$mowh_lv0021->DefaultFieldList="lv001,lv004,lv005,lv007,lv013,lv010,lv008";
$vFieldList="lv001,lv004,lv005,lv007,lv008,lv013,lv010";
$strParent=$mowh_lv0021->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mowh_lv0022->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0026.txt",$plang);
$mowh_lv0022->ArrPush[0]=$vLangArr[17];
$mowh_lv0022->ArrPush[1]=$vLangArr[18];
$mowh_lv0022->ArrPush[2]=$vLangArr[19];
$mowh_lv0022->ArrPush[3]=$vLangArr[20];
$mowh_lv0022->ArrPush[4]=$vLangArr[21];
$mowh_lv0022->ArrPush[5]=$vLangArr[22];
$mowh_lv0022->ArrPush[6]=$vLangArr[23];
$mowh_lv0022->ArrPush[7]=$vLangArr[24]."@01";
$mowh_lv0022->ArrPush[8]=$vLangArr[25];
$mowh_lv0022->ArrPush[9]=$vLangArr[26];
$mowh_lv0022->ArrPush[10]=$vLangArr[27];
$mowh_lv0022->ArrPush[11]=$vLangArr[28];
$mowh_lv0022->ArrPush[12]=$vLangArr[29];
$mowh_lv0022->ArrPush[13]=$vLangArr[30];
$mowh_lv0022->ArrPush[14]=$vLangArr[41];
$mowh_lv0022->ArrPush[15]=$vLangArr[42];
$mowh_lv0022->ArrPush[16]=$vLangArr[38]."@01";
	

$mowh_lv0022->ArrFunc[0]='//Function';
$mowh_lv0022->ArrFunc[1]=$vLangArr[2];
$mowh_lv0022->ArrFunc[2]=$vLangArr[4];
$mowh_lv0022->ArrFunc[3]=$vLangArr[6];
$mowh_lv0022->ArrFunc[4]=$vLangArr[7];
$mowh_lv0022->ArrFunc[5]='';
$mowh_lv0022->ArrFunc[6]='';
$mowh_lv0022->ArrFunc[7]='';
$mowh_lv0022->ArrFunc[8]=$vLangArr[10];
$mowh_lv0022->ArrFunc[9]=$vLangArr[12];
$mowh_lv0022->ArrFunc[10]=$vLangArr[0];
$mowh_lv0022->ArrFunc[11]=$vLangArr[33];
$mowh_lv0022->ArrFunc[12]=$vLangArr[34];
$mowh_lv0022->ArrFunc[13]=$vLangArr[35];
$mowh_lv0022->ArrFunc[14]=$vLangArr[36];
$mowh_lv0022->ArrFunc[15]=$vLangArr[37];

////Other
$mowh_lv0022->ArrOther[1]=$vLangArr[31];
$mowh_lv0022->ArrOther[2]=$vLangArr[32];
if($plang=="") $plang="VN";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mowh_lv0022->lv002=$vlv001;
$vStrMessage="";
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("../../","CR0044.txt",$plang);
?>

<?php
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
	$mowh_lv0003->LV_LoadID($mowh_lv0021->lv002);
	if($mowh_lv0021->lv006>0 || $mowh_lv0021->lv006==-1)
	$vFieldList="lv003,lv004,lv005,lv006,lv009,lv010,lv011,lv012,lv013,lv015";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv008,lv009,lv010,lv011,lv012,lv013,lv015";
	 $strDetail=$mowh_lv0022->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mowh_lv0021->lv006);
	 if($plang=="") $plang="VN";
	 $mohr_lv0001->LV_Load();		
	if($plang=='VN')
	{
		$vTenNCC='Nhà cung cấp:';
		$vTenNLH='Tên người liên hệ:';
		$vTenNLHValue='Ms. Phương Thảo';
		$vSoDT='SĐT:';
		$vSoDTValue='0906 657 877';
		$vEmail='E-mail:';
		$vEmailValue='cindythao@SOF.biz';
		$vTenCongTy= $mohr_lv0001->lv002;
		$vDiaChi= $mohr_lv0001->lv003;
		$vTenDiaChi='Trụ sở chính';
		$vDiaChiGH= $mohr_lv0001->lv104;
		$vTenDiaChiGH='<strong>Địa chỉ giao nhận hàng hoá & chứng từ</strong>';
		$vTenThuMua='NGƯỜI ĐỀ NGHỊ';
		$vNguoiDeNghi='TP.KHTH';
		$vKeToanKho='KẾ TOÁN TRƯỞNG';
		$VNguoiDuyet='GIÁM ĐỐC';
		$vTong='Tổng:';
		$vTongCong='Tổng cộng:';
	}
	else
	{
		$vTenThuMua='PROPONENT';
		$vNguoiDeNghi='MANAGER';
		$vKeToanKho='ACCOUNTANT';
		$VNguoiDuyet='GENERAL DIRECTOR';
		$vTenNCC='Supplier:';
		$vTenNLH='Contact Person:';
		$vTenNLHValue='Ms. Cindy';
		$vSoDT='Phone number:';
		$vSoDTValue='0906 657 877';
		$vEmail='E-mail:';
		$vEmailValue='cindythao@SOF.biz';
		$vTenCongTy= $mohr_lv0001->lv102;
		$vDiaChi= $mohr_lv0001->lv103;
		$vTenDiaChi='Head office';
		$vDiaChiGH= $mohr_lv0001->lv105;
		$vTenDiaChiGH='<strong>Delivery address for goods & documents</strong>';
		$vTong='Total:';
		$vTongCong='Sum total:';
	}
	$vLangArr=GetLangFile("../../","CR0215.txt",$plang);
	$mocr_lv0176->ArrPush[0]=$vLangArr[17];
	$mocr_lv0176->ArrPush[1]=$vLangArr[18];
	$mocr_lv0176->ArrPush[2]=$vLangArr[19];
	$mocr_lv0176->ArrPush[3]=$vLangArr[20];
	$mocr_lv0176->ArrPush[4]=$vLangArr[21];
	$mocr_lv0176->ArrPush[5]=$vLangArr[22];
	$mocr_lv0176->ArrPush[6]=$vLangArr[23];
	$mocr_lv0176->ArrPush[7]=$vLangArr[24];
	$mocr_lv0176->ArrPush[8]=$vLangArr[25];
	$mocr_lv0176->ArrPush[9]=$vLangArr[26];
	$mocr_lv0176->ArrPush[10]=$vLangArr[27];
	$mocr_lv0176->ArrPush[11]=$vLangArr[28];
	$mocr_lv0176->ArrPush[12]=$vLangArr[29];
	$mocr_lv0176->ArrPush[13]=$vLangArr[30];
	$mocr_lv0176->ArrPush[14]=$vLangArr[31];
	$mocr_lv0176->ArrPush[15]=$vLangArr[32];
	$mocr_lv0176->ArrPush[16]=$vLangArr[33];
	$mocr_lv0176->ArrPush[17]=$vLangArr[34];
	$mocr_lv0176->ArrPush[18]=$vLangArr[35];
	$mocr_lv0176->ArrPush[19]=$vLangArr[36];
	$mocr_lv0176->ArrPush[20]=$vLangArr[37];
	$mocr_lv0176->ArrPush[21]=$vLangArr[38];
	$mocr_lv0176->ArrPush[22]=$vLangArr[39];
	$mocr_lv0176->ArrPush[23]=$vLangArr[40];
	$mocr_lv0176->ArrPush[24]=$vLangArr[41];
	$mocr_lv0176->ArrPush[25]=$vLangArr[42];
	$mocr_lv0176->ArrPush[26]=$vLangArr[43];
	$mocr_lv0176->ArrPush[27]=$vLangArr[44];
	$mocr_lv0176->ArrPush[28]=$vLangArr[45];
	$mocr_lv0176->ArrPush[29]=$vLangArr[46];
	$mocr_lv0176->ArrPush[30]=$vLangArr[47];
	$mocr_lv0176->ArrPush[31]=$vLangArr[48];
	$mocr_lv0176->ArrPush[32]=$vLangArr[49];
	$mocr_lv0176->ArrPush[33]=$vLangArr[50];
	$mocr_lv0176->ArrPush[34]=$vLangArr[51];
	$mocr_lv0176->ArrPush[35]=$vLangArr[52];
	$mocr_lv0176->ArrPush[36]=$vLangArr[53];
	$mocr_lv0176->ArrPush[37]=$vLangArr[54];
	$mocr_lv0176->ArrPush[38]=$vLangArr[55];
	$mocr_lv0176->ArrPush[39]=$vLangArr[56];
	$mocr_lv0176->ArrPush[40]=$vLangArr[57];
	$mocr_lv0176->ArrPush[41]=$vLangArr[58];
	$mocr_lv0176->ArrPush[42]=$vLangArr[59];
	$mocr_lv0176->ArrPush[43]=$vLangArr[60];
	$mocr_lv0176->ArrPush[44]=$vLangArr[61];
	$mocr_lv0176->ArrPush[45]=$vLangArr[62];
	$mocr_lv0176->ArrPush[46]=$vLangArr[63];
	$mocr_lv0176->ArrPush[47]=$vLangArr[64];
	$mocr_lv0176->ArrPush[48]=$vLangArr[65];
	$mocr_lv0176->ArrPush[49]=$vLangArr[66];
	$mocr_lv0176->ArrPush[50]=$vLangArr[67];
	$mocr_lv0176->ArrPush[51]=$vLangArr[68];
	$mocr_lv0176->ArrPush[52]=$vLangArr[69];
	$mocr_lv0176->ArrPush[53]=$vLangArr[70];
	$mocr_lv0176->ArrPush[54]=$vLangArr[71];
	$mocr_lv0176->ArrPush[55]=$vLangArr[72];
	$mocr_lv0176->ArrPush[56]=$vLangArr[73];
	$mocr_lv0176->ArrPush[57]=$vLangArr[74];
	$mocr_lv0176->ArrPush[58]=$vLangArr[75];
	$mocr_lv0176->ArrPush[59]=$vLangArr[76];
	$mocr_lv0176->ArrPush[60]=$vLangArr[77];
	$mocr_lv0176->ArrPush[61]=$vLangArr[78];
	$mocr_lv0176->ArrPush[62]=$vLangArr[79];
	$mocr_lv0176->ArrPush[63]=$vLangArr[80];
	$mocr_lv0176->ArrPush[64]=$vLangArr[81];

	$mocr_lv0176->ArrPush[65]=$vLangArr[82];
	$mocr_lv0176->ArrPush[66]=$vLangArr[83];
	$mocr_lv0176->ArrPush[69]=$vLangArr[91];
	$mocr_lv0176->ArrPush[71]=GetLangExcept('ExtraDiscount',$plang);
	$mocr_lv0176->ArrPush[200]='Chức năng';
	$mocr_lv0176->ArrPush[100]='BOM';

	$mocr_lv0176->ArrPush[81]=$vLangArr[92];
	$mocr_lv0176->ArrPush[82]=$vLangArr[93];
	$mocr_lv0176->ArrPush[83]=$vLangArr[94];
	$mocr_lv0176->ArrPush[84]=$vLangArr[95];
	$mocr_lv0176->ArrPush[85]=$vLangArr[96];
	$mocr_lv0176->ArrPush[86]=$vLangArr[97];
	$mocr_lv0176->ArrPush[87]=$vLangArr[98];
	$mocr_lv0176->ArrPush[88]=$vLangArr[99];
	$mocr_lv0176->ArrPush[89]=$vLangArr[100];
	$mocr_lv0176->ArrPush[90]=$vLangArr[101];
	$mocr_lv0176->ArrPush[91]=$vLangArr[102];
	$mocr_lv0176->ArrPush[92]=$vLangArr[103];
	$mocr_lv0176->ArrPush[93]=$vLangArr[104];
	$mocr_lv0176->ArrPush[94]=$vLangArr[105];
	$mocr_lv0176->ArrPush[95]=$vLangArr[106];
	$mocr_lv0176->ArrPush[96]=$vLangArr[107];

	$mocr_lv0176->ArrPush[102]=$vLangArr[108];
	$mocr_lv0176->ArrPush[103]=$vLangArr[109];
	$mocr_lv0176->ArrPush[104]=$vLangArr[110];
	$mocr_lv0176->ArrPush[105]=$vLangArr[111];

	$mocr_lv0176->ArrPush[111]=$vLangArr[112];
	$mocr_lv0176->ArrPush[112]=$vLangArr[113];
	$mocr_lv0176->ArrPush[113]=$vLangArr[114];
	$mocr_lv0176->ArrPush[114]=$vLangArr[115];
	$mocr_lv0176->ArrPush[115]=$vLangArr[116];
	$mocr_lv0176->ArrPush[116]=$vLangArr[117];
	$mocr_lv0176->ArrPush[117]=$vLangArr[118];
	$mocr_lv0176->ArrPush[118]=$vLangArr[119];
	$mocr_lv0176->ArrPush[119]=$vLangArr[120];
	$mocr_lv0176->ArrPush[120]=$vLangArr[121];
	$mocr_lv0176->ArrPush[121]=$vLangArr[122];
	$mocr_lv0176->ArrPush[122]=$vLangArr[123];
	$mocr_lv0176->ArrPush[123]=$vLangArr[124];
	$mocr_lv0176->ArrPush[124]=$vLangArr[125];
	$mocr_lv0176->ArrPush[125]=$vLangArr[126];
	$mocr_lv0176->ArrPush[126]=$vLangArr[127];
	$mocr_lv0176->ArrPush[127]=$vLangArr[128];
	$mocr_lv0176->ArrPush[128]=$vLangArr[129];
	$mocr_lv0176->ArrPush[129]=$vLangArr[130];
	$mocr_lv0176->ArrPush[130]=$vLangArr[131];
	$mocr_lv0176->ArrPush[131]=$vLangArr[132];
	$mocr_lv0176->ArrPush[132]=$vLangArr[133];
	$mocr_lv0176->ArrPush[133]=$vLangArr[134];
	$mocr_lv0176->ArrPush[134]=$vLangArr[135];
	$mocr_lv0176->ArrPush[135]=$vLangArr[136];
	$mocr_lv0176->ArrPush[136]=$vLangArr[137];
	$mocr_lv0176->ArrPush[137]=$vLangArr[138];
	$mocr_lv0176->ArrPush[138]=$vLangArr[139];
	$mocr_lv0176->ArrPush[139]=$vLangArr[140];
	if($plang=='EN')
	{
		$mocr_lv0176->ArrPush[300]='Supplier';
		$mocr_lv0176->ArrPush[163]='Price(@@163)';
		$mocr_lv0176->ArrPush[164]='Amount(@@163)';
		$mocr_lv0176->ArrPush[205]='Our ref. Q\'ty';
	}
	else
	{
		$mocr_lv0176->ArrPush[300]='Mã NCC';
		$mocr_lv0176->ArrPush[163]='Đơn giá(@@163)';
		$mocr_lv0176->ArrPush[164]='Thành tiền(@@163)';
		$mocr_lv0176->ArrPush[205]='S\'lượng<br/>Our ref.';
	}
	 $mocr_lv0176->lv002=$vlv001;
	 $mocr_lv0176->LoadSaveOperationLocal($_SESSION['ERPSOFV2RUserID'],'cr_lv0176',$strCode);
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$vFieldList=$mocr_lv0176->ListView;
	$curPage = $mocr_lv0176->CurPage;
	$maxRows =$mocr_lv0176->MaxRows;
	$vOrderList=$mocr_lv0176->ListOrder;
	$vSortNum=$mocr_lv0176->SortNum;
	$mocr_lv0176->PerVAT=$mowh_lv0021->lv006;
	$mocr_lv0176->mowh_lv0021=$mowh_lv0021;
	$mocr_lv0176->lang=$plang;
	 $strDetail=$mocr_lv0176->LV_BuilListReportOtherMP($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vSortNum,$mowh_lv0021->lv006);

	
	?>
	<table width="1024" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mowh_lv0021->lv011>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mowh_lv0021->lv001."'>":"";?></td>
  </tr>	

   <tr>
    <td align="center" onDblClick="this.innerHTML=''"><div>
    <div style="float:left;text-align:left;font-size:12px;font-family:arial, times new roman;">
	<strong><?php echo $vTenNCC.' '.$mowh_lv0003->lv002;?></strong><br>
		<?php echo $vTenNLH;?> <?php echo $mowh_lv0003->lv003;?><br>
		<?php echo $vSoDT;?> <?php echo $mowh_lv0003->lv011;?><br/>
		 <?php echo $vEmail;?> <?php echo $mowh_lv0003->lv015;?>
		 <!--<br> Người liên hệ: <?php echo $mowh_lv0003->lv003;?>--></div>

<div style="float:right;text-align:left;width:60%;font-size:12px;font-family:arial, times new roman;white-space:nowrap;">
<strong><span style="text-align:left;font-size:16px;font-family:arial, times new roman;"><?php echo $vTenCongTy;?></span></strong>
<br><?php echo $vTenDiaChi;?>: <?php echo $vDiaChi;?>
<br>(<?php echo $vTenDiaChiGH;?>: <?php echo $vDiaChiGH;?> )<br/>
<?php echo $vTenNLH;?> <?php echo $vTenNLHValue;?>&nbsp;&nbsp;
<?php echo $vSoDT;?> <?php echo $vSoDTValue;?>&nbsp;&nbsp;
<?php echo $vEmail;?> <?php echo $vEmailValue;?>
 <!--<?php echo $vLangArr1[41];?>: <?php echo $mowh_lv0021->GetFax();?> <br> 
<?php echo $vLangArr1[42];?>: <a href="<?php echo $mowh_lv0021->GetWeb();?>" target="_blank"><?php echo $mowh_lv0021->GetWeb();?></a>--></div>
    </div></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $strParent;?></td>
  </tr>
    <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $strDetail;?></td>
  </tr>
  <tr>
		<td>
<?php
	if($plang=='EN')
	{
?>			
		<table onDblClick="this.innerHTML=''" style="font-size: 12px; font-family: arial, times new roman; width: 100%;" border="0" cellspacing="0">
			<colgroup width="55"></colgroup><colgroup span="2" width="157"></colgroup><colgroup width="133"></colgroup><colgroup width="150"></colgroup><colgroup width="166"></colgroup><colgroup width="145"></colgroup><colgroup span="2" width="159"></colgroup><colgroup width="181"></colgroup><colgroup width="547"></colgroup><colgroup width="102"></colgroup><colgroup width="116"></colgroup><colgroup width="86"></colgroup><colgroup width="100"></colgroup><colgroup width="147"></colgroup><colgroup width="176"></colgroup> 
				<tbody>
					<tr>
					<td colspan="18">
					<hr style="border:0px;border-top:3px #000 solid;" />
					</td>
					</tr>
					<tr>
					<td align="left" valign="top"><span style="font-size:12px;arial, font-family:times new roman;"><strong> NOTE</strong>:</span></td>
					<td style="font-size: 12px; arial, font-family:times new roman;white-space: nowrap;" width="1%" valign="top"><span style="color: #000000;">- Value quotation:</span></td>
					<td style="font-size: 12px; arial, font-family:times new roman;" colspan="15" align="left" valign="top"><?php echo $mowh_lv0021->lv104;?></td>
					</tr>
					<tr>
					<td align="left">&nbsp;</td>
					<td style="font-size:12px;arial, font-family:times new roman; " height="16" align="left" valign="middle"><span style="color: #000000;">- Warranty:</span></td>
					<td style="font-size:12px;arial, font-family:times new roman; " colspan="15" align="left"><?php echo $mowh_lv0021->lv105;?></td>
					</tr>
					<tr>
					<td style="font-size:12px;arial, font-family:times new roman; " height="16" align="center">&nbsp;</td>
					<td align="left"><span style="font-size:12px;arial, font-family:times new roman;">- Payment:</span></td>
					<td colspan="15" align="left"><?php echo $mowh_lv0021->lv107;?></td>
					</tr>
					<tr>
					<td style="font-size:12px;arial, font-family:times new roman; " height="16" align="center">&nbsp;</td>
					<td align="left"><span style="font-size:12px;arial, font-family:times new roman;">- Delivery time:</span></td>
					<td colspan="15" align="left"><?php echo $mowh_lv0021->lv106;?></td>
					</tr>
					<tr>
					<td colspan="18">
					<hr style="border:0px;border-top:3px #000 solid;" />
					</td>
					</tr>
				</tbody>
			</table>
			<?php
	}
	else
	{
		?>
			<table onDblClick="this.innerHTML=''" style="font-size: 12px; font-family: arial, times new roman; width: 100%;" border="0" cellspacing="0">
			<colgroup width="55"></colgroup><colgroup span="2" width="157"></colgroup><colgroup width="133"></colgroup><colgroup width="150"></colgroup><colgroup width="166"></colgroup><colgroup width="145"></colgroup><colgroup span="2" width="159"></colgroup><colgroup width="181"></colgroup><colgroup width="547"></colgroup><colgroup width="102"></colgroup><colgroup width="116"></colgroup><colgroup width="86"></colgroup><colgroup width="100"></colgroup><colgroup width="147"></colgroup><colgroup width="176"></colgroup> 
				<tbody>
					<tr>
					<td colspan="18">
					<hr style="border:0px;border-top:3px #000 solid;" />
					</td>
					</tr>
					<tr>
					<td align="left" valign="top" nowrap><span style="font-size:12px;arial, font-family:times new roman;"><strong> GHI CHÚ</strong>:</span></td>
					<td style="font-size: 12px; arial, font-family:times new roman;white-space: nowrap;" width="1%" valign="top"><span style="color: #000000;">- Hiệu lực mua hàng:</span></td>
					<td style="font-size: 12px; arial, font-family:times new roman;" colspan="15" align="left" valign="top"><?php echo $mowh_lv0021->lv104;?></td>
					</tr>
					<tr>
					<td align="left">&nbsp;</td>
					<td style="font-size:12px;arial, font-family:times new roman; " height="16" align="left" valign="middle"><span style="color: #000000;">- Bảo hành:</span></td>
					<td style="font-size:12px;arial, font-family:times new roman; " colspan="15" align="left"><?php echo $mowh_lv0021->lv105;?></td>
					</tr>
					<tr>
					<td style="font-size:12px;arial, font-family:times new roman; " height="16" align="center">&nbsp;</td>
					<td align="left"><span style="font-size:12px;arial, font-family:times new roman;">- Thanh toán :</span></td>
					<td colspan="15" align="left"><?php echo $mowh_lv0021->lv107;?></td>
					</tr>
					<tr>
					<td style="font-size:12px;arial, font-family:times new roman; " height="16" align="center">&nbsp;</td>
					<td align="left" nowrap><span style="font-size:12px;arial, font-family:times new roman;">- Thời gian giao hàng:</span></td>
					<td colspan="15" align="left"><?php echo $mowh_lv0021->lv106;?></td>
					</tr>
					<tr>
					<td colspan="18">
					<hr style="border:0px;border-top:3px #000 solid;" />
					</td>
					</tr>
				</tbody>
			</table>
		<?php
	}
	?>
		</td>
	</tr>
  <tr>
    <td align="left" ><?php //echo $mowh_lv0021->lv009;;?></td>
  </tr>
  <tr>
    <td align="right" ><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="1%">&nbsp;</td>
						<td width="20%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="20%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="20%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="20%">&nbsp;</td>
						<td width="1%">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $vTenThuMua;//$mowh_lv0021->getvaluelink('lv002',$mowh_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $vKeToanKho;//$mowh_lv0021->getvaluelink('lv002',$mowh_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $vNguoiDeNghi;//$mowh_lv0021->getvaluelink('lv002',$mowh_lv0021->lv002);?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $VNguoiDuyet;//$mowh_lv0021->GetCompany();?></b></span></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="120px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php echo GetUserName($mowh_lv0021->lv010,$plang);// for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<40; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<40; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<40; $i++) echo ".";?></td>
						<td>&nbsp;</td>
					</tr>
				</table></td>
  </tr>
</table>
</body>
</html>					
<?php
} else {
	include("../permit.php");
}
?>
