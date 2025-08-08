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
require_once("../../clsall/cr_lv0342.php");
require_once("../../clsall/cr_lv0292.php");
require_once("../../clsall/cr_lv0171.php");
require_once("../../soft/librarianconfig.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mohr_lv0001=new hr_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0001');
$mowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0342');
$mowh_lv0003=new wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
$lvwh_lv0003=new wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
$mocr_lv0342=new cr_lv0342($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0342');
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
$mowh_lv0021->LV_LoadID($vlv001);
if($mowh_lv0021->GetView()==1)
{
    $plang="VN";
	$vLangArr=GetLangFile("../../","CR0215.txt",$plang);
    $mocr_lv0342->DefaultFieldList="lv299,lv052,lv157,lv149,lv150,lv151,lv011,lv914,lv012,lv152,lv061,lv008,lv009,lv139,lv049,lv154,lv155,lv004,lv153,lv204,lv156,lv005,lv006,lv054,lv140,lv158,lv170,lv171,lv172,lv173,lv174,lv175,lv176,lv177,lv178,lv179,lv180,lv181,lv183,lv185,lv195,lv196,lv190,lv197,lv194,lv141,lv142,lv143,lv145,lv146,lv147";//
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    $mocr_lv0342->ArrPush[0]=$vLangArr[17];
    $mocr_lv0342->ArrPush[1]=$vLangArr[18];
    $mocr_lv0342->ArrPush[2]=$vLangArr[19];
    $mocr_lv0342->ArrPush[3]=$vLangArr[20];
    $mocr_lv0342->ArrPush[4]=$vLangArr[21];
    $mocr_lv0342->ArrPush[5]=$vLangArr[22];
    $mocr_lv0342->ArrPush[6]=$vLangArr[23];
    $mocr_lv0342->ArrPush[7]=$vLangArr[24];
    $mocr_lv0342->ArrPush[8]=$vLangArr[25];
    $mocr_lv0342->ArrPush[9]='Model';
    $mocr_lv0342->ArrPush[10]=$vLangArr[27];
    $mocr_lv0342->ArrPush[11]=$vLangArr[28];
    $mocr_lv0342->ArrPush[12]='Mô tả sản phẩm';
    $mocr_lv0342->ArrPush[13]='Our ref.';
    $mocr_lv0342->ArrPush[14]=$vLangArr[31];
    $mocr_lv0342->ArrPush[15]=$vLangArr[32];
    $mocr_lv0342->ArrPush[16]=$vLangArr[33];
    $mocr_lv0342->ArrPush[17]=$vLangArr[34];
    $mocr_lv0342->ArrPush[18]=$vLangArr[35];
    $mocr_lv0342->ArrPush[19]=$vLangArr[36];
    $mocr_lv0342->ArrPush[20]=$vLangArr[37];
    $mocr_lv0342->ArrPush[21]=$vLangArr[38];
    $mocr_lv0342->ArrPush[22]=$vLangArr[39];
    $mocr_lv0342->ArrPush[23]=$vLangArr[40];
    $mocr_lv0342->ArrPush[24]=$vLangArr[41];
    $mocr_lv0342->ArrPush[25]=$vLangArr[42];
    $mocr_lv0342->ArrPush[26]=$vLangArr[43];
    $mocr_lv0342->ArrPush[27]=$vLangArr[44];
    $mocr_lv0342->ArrPush[28]=$vLangArr[45];
    $mocr_lv0342->ArrPush[29]=$vLangArr[46];
    $mocr_lv0342->ArrPush[30]=$vLangArr[47];
    $mocr_lv0342->ArrPush[31]=$vLangArr[48];
    $mocr_lv0342->ArrPush[32]=$vLangArr[49];
    $mocr_lv0342->ArrPush[33]=$vLangArr[50];
    $mocr_lv0342->ArrPush[34]=$vLangArr[51];
    $mocr_lv0342->ArrPush[35]=$vLangArr[52];
    $mocr_lv0342->ArrPush[36]=$vLangArr[53];
    $mocr_lv0342->ArrPush[37]=$vLangArr[54];
    $mocr_lv0342->ArrPush[38]=$vLangArr[55];
    $mocr_lv0342->ArrPush[39]=$vLangArr[56];
    $mocr_lv0342->ArrPush[40]=$vLangArr[57];
    $mocr_lv0342->ArrPush[41]=$vLangArr[58];
    $mocr_lv0342->ArrPush[42]=$vLangArr[59];
    $mocr_lv0342->ArrPush[43]=$vLangArr[60];
    $mocr_lv0342->ArrPush[44]=$vLangArr[61];
    $mocr_lv0342->ArrPush[45]=$vLangArr[62];
    $mocr_lv0342->ArrPush[46]=$vLangArr[63];
    $mocr_lv0342->ArrPush[47]=$vLangArr[64];
    $mocr_lv0342->ArrPush[48]=$vLangArr[65];
    $mocr_lv0342->ArrPush[49]=$vLangArr[66];
    $mocr_lv0342->ArrPush[50]=$vLangArr[67];
    $mocr_lv0342->ArrPush[51]='Brand';
    $mocr_lv0342->ArrPush[52]=$vLangArr[69];
    $mocr_lv0342->ArrPush[53]=$vLangArr[70];
    $mocr_lv0342->ArrPush[54]=$vLangArr[71];
    $mocr_lv0342->ArrPush[55]=$vLangArr[72];
    $mocr_lv0342->ArrPush[56]=$vLangArr[73];
    $mocr_lv0342->ArrPush[57]=$vLangArr[74];
    $mocr_lv0342->ArrPush[58]=$vLangArr[75];
    $mocr_lv0342->ArrPush[59]=$vLangArr[76];
    $mocr_lv0342->ArrPush[60]=$vLangArr[77];
    $mocr_lv0342->ArrPush[61]=$vLangArr[78];
    $mocr_lv0342->ArrPush[62]='Hình ảnh';
    $mocr_lv0342->ArrPush[63]=$vLangArr[80];
    $mocr_lv0342->ArrPush[64]=$vLangArr[81];

    $mocr_lv0342->ArrPush[65]=$vLangArr[82];
    $mocr_lv0342->ArrPush[66]=$vLangArr[83];
    $mocr_lv0342->ArrPush[69]=$vLangArr[91];
    $mocr_lv0342->ArrPush[71]=GetLangExcept('ExtraDiscount',$plang);
    $mocr_lv0342->ArrPush[200]='Chức năng';
    $mocr_lv0342->ArrPush[100]='Mã cha';

    $mocr_lv0342->ArrPush[81]=$vLangArr[92];
    $mocr_lv0342->ArrPush[82]=$vLangArr[93];
    $mocr_lv0342->ArrPush[83]=$vLangArr[94];
    $mocr_lv0342->ArrPush[84]=$vLangArr[95];
    $mocr_lv0342->ArrPush[85]=$vLangArr[96];
    $mocr_lv0342->ArrPush[86]=$vLangArr[97];
    $mocr_lv0342->ArrPush[87]=$vLangArr[98];
    $mocr_lv0342->ArrPush[88]=$vLangArr[99];
    $mocr_lv0342->ArrPush[89]=$vLangArr[100];
    $mocr_lv0342->ArrPush[90]=$vLangArr[101];
    $mocr_lv0342->ArrPush[91]=$vLangArr[102];
    $mocr_lv0342->ArrPush[92]=$vLangArr[103];
    $mocr_lv0342->ArrPush[93]=$vLangArr[104];
    $mocr_lv0342->ArrPush[94]=$vLangArr[105];
    $mocr_lv0342->ArrPush[95]=$vLangArr[106];
    $mocr_lv0342->ArrPush[96]=$vLangArr[107];

    $mocr_lv0342->ArrPush[102]=$vLangArr[108];
    $mocr_lv0342->ArrPush[103]=$vLangArr[109];
    $mocr_lv0342->ArrPush[104]=$vLangArr[110];
    $mocr_lv0342->ArrPush[105]=$vLangArr[111];

    $mocr_lv0342->ArrPush[111]=$vLangArr[112];
    $mocr_lv0342->ArrPush[112]=$vLangArr[113];
    $mocr_lv0342->ArrPush[113]=$vLangArr[114];
    $mocr_lv0342->ArrPush[114]=$vLangArr[115];
    $mocr_lv0342->ArrPush[115]=$vLangArr[116];
    $mocr_lv0342->ArrPush[116]=$vLangArr[117];
    $mocr_lv0342->ArrPush[117]=$vLangArr[118];
    $mocr_lv0342->ArrPush[118]=$vLangArr[119];
    $mocr_lv0342->ArrPush[119]=$vLangArr[120];
    $mocr_lv0342->ArrPush[120]=$vLangArr[121];
    $mocr_lv0342->ArrPush[121]=$vLangArr[122];
    $mocr_lv0342->ArrPush[122]=$vLangArr[123];
    $mocr_lv0342->ArrPush[123]=$vLangArr[124];
    $mocr_lv0342->ArrPush[124]=$vLangArr[125];
    $mocr_lv0342->ArrPush[125]=$vLangArr[126];
    $mocr_lv0342->ArrPush[126]=$vLangArr[127];
    $mocr_lv0342->ArrPush[127]=$vLangArr[128];
    $mocr_lv0342->ArrPush[128]=$vLangArr[129];
    $mocr_lv0342->ArrPush[129]=$vLangArr[130];
    $mocr_lv0342->ArrPush[130]=$vLangArr[131];
    $mocr_lv0342->ArrPush[131]=$vLangArr[132];
    $mocr_lv0342->ArrPush[132]=$vLangArr[133];
    $mocr_lv0342->ArrPush[133]=$vLangArr[134];
    $mocr_lv0342->ArrPush[134]=$vLangArr[135];
    $mocr_lv0342->ArrPush[135]=$vLangArr[136];
    $mocr_lv0342->ArrPush[136]=$vLangArr[137];
    $mocr_lv0342->ArrPush[137]=$vLangArr[138];
    $mocr_lv0342->ArrPush[138]=$vLangArr[139];
    $mocr_lv0342->ArrPush[139]=$vLangArr[140];
    $mocr_lv0342->ArrPush[140]='Code';
    $mocr_lv0342->ArrPush[141]='Hạn bảo hành';
    $mocr_lv0342->ArrPush[142]='Loại lỗi s\'p';
    $mocr_lv0342->ArrPush[143]='S\'lượng s\'p lỗi';
    $mocr_lv0342->ArrPush[144]='Thời gian trả s\'p lỗi';
    $mocr_lv0342->ArrPush[145]='Mã hàng NCC';
    $mocr_lv0342->ArrPush[170]='STT';
    if($plang=='EN')
    {
        $mocr_lv0342->ArrPush[300]='Supplier';
        $mocr_lv0342->ArrPush[163]='Price('.$mowh_lv0021->lv012.')';
        $mocr_lv0342->ArrPush[164]='Amount('.$mowh_lv0021->lv012.')';
        $mocr_lv0342->ArrPush[205]='Our ref. Q\'ty';
        $mocr_lv0342->ArrPush[7]='Price('.$mowh_lv0021->lv016.')';
        $mocr_lv0342->ArrPush[55]='Amount('.$mowh_lv0021->lv016.')';
    }
    else
    {
        $mocr_lv0342->ArrPush[300]='Mã NCC';
        $mocr_lv0342->ArrPush[163]='Đơn giá('.$mowh_lv0021->lv012.')';
        $mocr_lv0342->ArrPush[164]='Thành tiền('.$mowh_lv0021->lv012.')';
        $mocr_lv0342->ArrPush[205]='S\'lượng<br/>Our ref.';
        $mocr_lv0342->ArrPush[7]='Đơn giá('.$mowh_lv0021->lv016.')';
        $mocr_lv0342->ArrPush[55]='Thành tiền('.$mowh_lv0021->lv016.')';
    }
    $mocr_lv0342->ArrPush[146]='Phí vận chuyển s\'p lỗi';
    $mocr_lv0342->ArrPush[147]='Đơn vị vận chuyển s\'p lỗi';
    $mocr_lv0342->ArrPush[148]='Số Bill Booking Vận chuyển';
    $mocr_lv0342->ArrPush[149]='SHIPPER';
    $mocr_lv0342->ArrPush[150]='Hạn giao hàng';
    $mocr_lv0342->ArrPush[151]='Ngày giao hàng dự kiến';
    $mocr_lv0342->ArrPush[152]='Phí vận chuyển';
    $mocr_lv0342->ArrPush[153]='Type (Our ref.)';
    $mocr_lv0342->ArrPush[154]='S\'lượng<br/>Sample';
    $mocr_lv0342->ArrPush[155]='Model Sup';
    $mocr_lv0342->ArrPush[156]='Thương hiệu<br/>NCC';
    $mocr_lv0342->ArrPush[157]='S\'lượng<br/> Extra';
    $mocr_lv0342->ArrPush[158]='Ngày phát hành';
    $mocr_lv0342->ArrPush[159]='Catalogue';
    $mocr_lv0342->ArrPush[171]='Bản vẽ';
    $mocr_lv0342->ArrPush[172]='TEST IP (54/65/67/68)';
    $mocr_lv0342->ArrPush[173]='IES File & Test Integrating Sphere';
    $mocr_lv0342->ArrPush[174]='HDLĐ & Bảo trì bảo dưỡng';
    $mocr_lv0342->ArrPush[175]='CER. LM80 Chip';
    $mocr_lv0342->ArrPush[176]='Giấy HCHQ';
    $mocr_lv0342->ArrPush[177]='Hình ảnh hàng hóa/ Đóng gói';
    $mocr_lv0342->ArrPush[178]='Hình ảnh<br/>chip/driver/Phị kiện';
    $mocr_lv0342->ArrPush[179]='Ngày giao mẫu';
    $mocr_lv0342->ArrPush[180]='Đơn vị vận chuyển mẫu';
    $mocr_lv0342->ArrPush[181]='Ngày giao hàng';
    $mocr_lv0342->ArrPush[182]='Ngày giao hàng Đợt 2';
    $mocr_lv0342->ArrPush[183]='Sample Loading By';
    $mocr_lv0342->ArrPush[184]='Địa điểm lấy hàng';
    $mocr_lv0342->ArrPush[185]='Sample Loading type DDP';
    $mocr_lv0342->ArrPush[186]='Booking Bill Draf No.';
    $mocr_lv0342->ArrPush[187]='Country';
    $mocr_lv0342->ArrPush[188]='IV No';
    $mocr_lv0342->ArrPush[189]='CO No';
    $mocr_lv0342->ArrPush[190]='CO E/D No';
    $mocr_lv0342->ArrPush[191]='Giấy chứng nhận chất lượng (CQ)';
    $mocr_lv0342->ArrPush[192]='BL No.';
    $mocr_lv0342->ArrPush[193]='PL No.';
    $mocr_lv0342->ArrPush[194]='SUR/Orgin B/L No.';
    $mocr_lv0342->ArrPush[195]='Phiếu bảo hành';

    $mocr_lv0342->ArrPush[196]='Phiếu giao hàng';
    $mocr_lv0342->ArrPush[197]='Phiếu xuất kho';
    $mocr_lv0342->ArrPush[198]='Phiếu xuất xưởng';

    $mocr_lv0342->ArrPush[915]='Proj.';
    $mocr_lv0342->ArrPush[300]='SELLER';
    
    $mocr_lv0342->ArrFunc[0]='//Function';

    $mocr_lv0342->ArrFunc[1]=$vLangArr[2];
    $mocr_lv0342->ArrFunc[2]=$vLangArr[4];
    $mocr_lv0342->ArrFunc[3]=$vLangArr[6];
    $mocr_lv0342->ArrFunc[4]=$vLangArr[7];
    $mocr_lv0342->ArrFunc[5]=GetLangExcept('Rpt',$plang);
    $mocr_lv0342->ArrFunc[6]=GetLangExcept('Apr',$plang);
    $mocr_lv0342->ArrFunc[7]=GetLangExcept('UnApr',$plang);
    $mocr_lv0342->ArrFunc[8]=$vLangArr[10];
    $mocr_lv0342->ArrFunc[9]=$vLangArr[12];
    $mocr_lv0342->ArrFunc[10]=$vLangArr[0];
    $mocr_lv0342->ArrFunc[11]=$vLangArr[86];
    $mocr_lv0342->ArrFunc[12]=$vLangArr[87];
    $mocr_lv0342->ArrFunc[13]=$vLangArr[88];
    $mocr_lv0342->ArrFunc[14]=$vLangArr[89];
    $mocr_lv0342->ArrFunc[15]=$vLangArr[90];
    ////Other
    $mocr_lv0342->ArrOther[1]=$vLangArr[84];
    $mocr_lv0342->ArrOther[2]=$vLangArr[85];
    $flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
    $vFieldList=$_POST['txtFieldList'];
    $vOrderList=$_POST['txtOrderList'];
    if(($_POST['txtFlag']) != 2)
    {
        //////////////////////////////////////////////////////////////////////////////////////////////////////
        $mocr_lv0342->LoadSaveOperationLocal($_SESSION['ERPSOFV2RUserID'],'cr_lv0342_2',$strCode);
        //////////////////////////////////////////////////////////////////////////////////////////////////////
        $vFieldList=$mocr_lv0342->ListView;
        $curPage = $mocr_lv0342->CurPage;
        $maxRows =$mocr_lv0342->MaxRows;
        $vOrderList=$mocr_lv0342->ListOrder;
        $vSortNum=$mocr_lv0342->SortNum;
    }
    elseif($_POST["txtFlag"]==2)
    {
        $curPage = (int)$_POST['curPg'];
        $maxRows =(int)$_POST['lvmaxrow'];
        $vSortNum=(int)$_POST['lvsort'];
        $mocr_lv0342->SaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0342_2',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);
    }
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
<link rel="stylesheet" href="<?php echo $mosl_lv0010->ImageLink;?>../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<link rel="stylesheet" href="../../css/menu.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()" ondblclick="ShowContract()">
<?php
if ($sExport != "excel" && $sExport != "word") {
?>	
<center>	
<div id="idhdsl" style="display:none;clear:both;width:100%;overflow:hidden">
    <table>
        <tr>
        <td  valign="top">
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
    </td>    
        <td valign="top" onmouseover="this.style.height='200px';">
    <form name="frmchoose" method="post" id="frmchoose" enctype="multipart/form-data">
                <table width="100%" border="0" align="center" class="table1">
                <tr>
                    <td colspan="2" height="100%" align="center">
                    <div><div style="float:right"><?php echo $mocr_lv0342->ListFieldSave('document.frmchoose',$vFieldList, $maxRows,$vOrderList,$vSortNum);?>
                                    <?php
                    echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
                    ?>			</div></div></td>	
                </tr>
                </table>
                        <input name="txtStringID" type="hidden" id="txtStringID" />
                        <input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
                <input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
                <input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
                <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
    </form>
    </td>
    
    </tr>
    </table>
</div>
</center>	
<?php
}
?>
	<?php  
	//$mowh_lv0021->LV_LoadID($vlv001);
    $lvcr_lv0292->LV_LoadLanGiaoHangGroup($mowh_lv0021->lv087,'');
    $lvwh_lv0003->LV_LoadID($lvcr_lv0292->lv026);
	$mocr_lv0342->mowh_lv0021=$mowh_lv0021;
	//$mowh_lv0003->LV_LoadID($mowh_lv0021->lv002);	
	?>
	<table style="font-family: Arial; font-size: 12px;" border="0" cellspacing="0">
    <colgroup width="186"></colgroup><colgroup width="429"></colgroup><colgroup width="250"></colgroup><colgroup width="216"></colgroup><colgroup width="244"></colgroup><colgroup width="183"></colgroup><colgroup width="223"></colgroup><colgroup width="192"></colgroup><colgroup span="2" width="193"></colgroup><colgroup width="212"></colgroup><colgroup span="4" width="192"></colgroup> 
    <colgroup width="*"></colgroup> 
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
                                <?php echo 'CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG';//$vTenCongTy;?></span></strong>
                                <br><?php //echo $vTenDiaChi;?><?php echo '101 Ung Van Khiem, Phường 25, Q.Bình Thạnh, HCM, VN';//$vDiaChi;?>
                                <br/>
                                <?php echo 'Mrs. CINDY/THẢO : 0906657877  E-Mail: cindythao@SOF.biz';?> 
                                <br/>
                                <?php echo 'Địa chỉ giao nhận hàng hóa: 54 An Phu Dong 13, Phường An Phú Đông, Q.  12, HCM, VN.
                                <br/>Liên hệ Ms. Thạch: 0987649832 ';?>
                                    </div>
                        </td>
                    </tr>
                </table>
			</td></tr>			
            <tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td><strong><span style="color: #000000; font-size: 32px;">ĐƠN ĐẶT HÀNG</span></strong></td></tr>
		</table>
		</span>
        </td>
        <td></td><td></td><td></td>
        <td colspan="8"></td>
        <td nowrap style="font-family: Arial; font-size: 12px;border-left: 2px solid #000000; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Hạn bảo hành</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Phí vận chuyển<br/>s'p lỗi</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Đơn vị<br/>vận chuyển s'p lỗi</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"></span></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"></span></td>
        <td width="*">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td></td><td></td><td></td>
            <td colspan="8"></td>
            <td style="font-family: Arial; font-size: 12px;border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
                <?php echo $lvcr_lv0292->getvaluelink('lv051',$lvcr_lv0292->lv051);?>
            </span></strong></td>
            <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
                <?php echo $lvcr_lv0292->getvaluelink('lv054',$lvcr_lv0292->lv054);?>
            </span></strong></td>
            <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
                <?php echo $lvcr_lv0292->getvaluelink('lv055',$lvcr_lv0292->lv055);?>
            </span></strong></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <td width="*"></td>
        </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td width="*"></td>
    </tr>
    <tr>
        <td></td><td></td>
        <td colspan="6"></td>
        <td nowrap style="font-family: Arial; font-size: 12px;border-left: 2px solid #000000; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Vendor</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">PI NO.</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Ngày phát hành</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Hạn giao hàng</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Phương thức<br/>giao hàng</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"><strong><span style="color: #000000; font-size: 12px;">Địa điểm<br/>giao hàng</span></strong></td>
        <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"></span></td>
        <td width="*"></td>
    </tr>
    <tr>
        <td></td><td></td>
        <td colspan="6"></td>
        <td style="font-family: Arial; font-size: 12px;border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv026;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv032;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv013;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv015;?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->lv025;?>&nbsp;
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
            <?php echo $lvcr_lv0292->getvaluelink('lv036',$lvcr_lv0292->lv036);?>
        </span></strong></td>
        <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
        <td width="*"></td>
    </tr>
    <tr>
    
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="center" valign="top"><strong><span style="color: #000000; font-size: 12px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000; font-size: 12px;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td width="*"></td>
    </tr>
    <?php
    $vi=0;
    $vArrDinhKem1=$lvcr_lv0171->LV_GetDinhKemGMH($mowh_lv0021->lv087,'1');
    if(count($vArrDinhKem1)>0)
    {
        ?>
        
        <?php 
        $vTitle='';
        $vContentLine='';
        foreach($vArrDinhKem1 as $vDinhKem)
        {
            $vi++;
            if($vi==1)
            {
                $vTitle=$vTitle.'<td style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;border-left: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">'.$vDinhKem[2].'</span></strong></td>';
                $vContentLine=$vContentLine.'<td style=  "font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000;border-left: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">'.$vDinhKem[5].'</span></strong></td>';
            }
            else
            {
                $vTitle=$vTitle.'<td style="font-family: Arial; font-size: 12px; border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000;" align="center" valign="top" bgcolor="#FFC000"> <strong><span style="color: #000000; font-size: 12px;">'.$vDinhKem[2].'</span></strong></td>';
                $vContentLine=$vContentLine.'<td style=  "font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">'.$vDinhKem[5].'</span></strong></td>';
            }
        }
        $vBlank='';
        for($i=$vi;$i<14;$i++)
        {
            $vBlank=$vBlank.'<td>&nbsp;</td>';
        }
    }
    echo  '<tr>'.$vBlank.$vTitle.'</tr>';
    echo  '<tr>'.$vBlank.$vContentLine.'</tr>';

    ?>
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
        <td nowrap style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"></span></td>
    </tr>
    <tr>
				
				<td style=  "font-family: Arial; font-size: 12px; border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign="top" bgcolor="#D9D9D9"><strong><span style="color: #000000; ">
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
                <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
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
        <td width="*"></td>
    </tr>
    <?php
    $vCot13=true;
    $vCot14=true;
    $vCot15=true;
    $vTruCot=4;
    
    $vArrDinhKem=Array();//$lvcr_lv0171->LV_GetDinhKemGMH($mowh_lv0021->lv087,'0');
    

	$sqlS = "SELECT A.*,AA.lv011 Description FROM wh_lv0022 A left join wh_lv0022_des AA on A.lv001=AA.lv001 inner join wh_lv0021 B on A.lv002=B.lv001 WHERE B.lv001='$mowh_lv0021->lv001' $strSort";
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
        //@01
        $slv004=$slv004+$vrow['lv004'];
        $slv006=$slv006+$vrow['lv006'];
        $slv054=$slv054+$vrow['lv054'];
        $slv063=$slv063+$vrow['lv063'];
        $slv163=$slv163+$vrow['lv163'];
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
    <tr><td colspan="20">
        <?php 
        $mocr_lv0342->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0342_2');
        //////////////////////////////////////////////////////////////////////////////////////////////////////
        $mocr_lv0342->lv002= $_GET['ID'] ?? '';
        $vFieldList=$mocr_lv0342->ListView;
        $curPage = $mocr_lv0342->CurPage;
        $maxRows =$mocr_lv0342->MaxRows;
        $vOrderList=$mocr_lv0342->ListOrder;
        $mocr_lv0342->DefaultFieldList="lv299,lv052,lv157,lv149,lv150,lv151,lv011,lv914,lv012,lv152,lv061,lv008,lv009,lv139,lv049,lv154,lv155,lv004,lv153,lv204,lv156,lv005,lv006,lv054,lv140,lv158,lv170,lv171,lv172,lv173,lv174,lv175,lv176,lv177,lv178,lv179,lv180,lv181,lv183,lv185,lv195,lv196,lv190,lv197,lv194,lv141,lv142,lv143,lv145,lv146,lv147";//
       // $vFieldList=$mocr_lv0342->DefaultFieldList;
        $mocr_lv0342->lang='EN';
        $mocr_lv0342->isSTT=14;
        $mocr_lv0342->strTD='';
        echo $mocr_lv0342->LV_BuilListReportOtherMPGroup($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
    </td></tr>
    <tr>
    <?php
        ?>
            <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="center"><strong><span style="color: #000000; font-size: 14px;">Hình thức thanh toán</span></strong>:<span style="color: #000000; font-size: 14px;"> <?php echo $mowh_lv0021->getvaluelink('lv007',$mowh_lv0021->lv007);?></span></td>
        <?php
       
        ?>
        <td colspan="6" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><strong>Chành</strong></span></td>

        <td colspan="<?php echo (4-$vTruCot+($vTypeID==0)?3:1);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><strong><span style="color: #000000; font-size: 14px;">Tổng</span></strong></td>
       <?php
       $vStrTem=$mocr_lv0342->strTD;
       $vStrTem=str_replace('<!--lv054-->',$mocr_lv0342->FormatView($slv054,20),$vStrTem);
       $vStrTem=str_replace('<!--lv163-->',$mocr_lv0342->FormatView($slv163,20),$vStrTem);
       $vStrTem=str_replace('<!--lv063-->',$mocr_lv0342->FormatView($slv063,20),$vStrTem);
       echo $vStrTem;
        //if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($slv054,20).'</strong></span></td>';
        //if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($slv163,20).'</strong></span></td>';
        //if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($slv063,20).'</strong></span></td>';
       ?> 
    </tr>
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="center"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Ngân hàng:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv003;?></span></strong></td>
        <td colspan="6" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;">Tên công ty: <?php echo $lvwh_lv0003->lv002;?></span></td>
        <td colspan="<?php echo (4-$vTruCot+($vTypeID==0)?3:1);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">Giảm giá:</span></span></strong></td>
        <?php
        $vStrTem=$mocr_lv0342->strTD;
        $vStrTem=str_replace('<!--lv054-->',$mocr_lv0342->FormatView($vTienDisCount,20),$vStrTem);
        $vStrTem=str_replace('<!--lv163-->',$mocr_lv0342->FormatView($vTienDisCount163,20),$vStrTem);
        $vStrTem=str_replace('<!--lv063-->',$mocr_lv0342->FormatView($vTienDisCount63,20),$vStrTem);
        echo $vStrTem;
        //if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($vTienDisCount,20).'</span></td>';
        //if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($vTienDisCount163,20).'</span></td>';
        //if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($vTienDisCount63,20).'</span></td>';
       ?> 
    </tr>    
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="center"><span style="color: #000000; font-size: 14px;">Địa chỉ:</span><span> <?php echo $lvcr_lv0292->lv004;?></span></strong></td>
        <td colspan="6" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;">Địa chỉ: <?php echo $lvwh_lv0003->lv006;?></span></td>
        <td  colspan="<?php echo (4-$vTruCot+($vTypeID==0)?3:1);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">VAT.:</span></span></strong></td>
    <?php
        $vStrTem=$mocr_lv0342->strTD;
        $vStrTem=str_replace('<!--lv054-->',$mocr_lv0342->FormatView($vTienVAT,20),$vStrTem);
        $vStrTem=str_replace('<!--lv163-->',$mocr_lv0342->FormatView($vTienVAT163,20),$vStrTem);
        $vStrTem=str_replace('<!--lv063-->',$mocr_lv0342->FormatView($vTienVAT63,20),$vStrTem);
        echo $vStrTem;
        //if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($vTienVAT,20).'</strong></span></td>';
        //if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($vTienVAT163,20).'</strong></span></td>';
        //if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($vTienVAT63,20).'</strong></span></td>';
    ?>    
    </tr>
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="center"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">STK:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv005;?></span></td>
        <td colspan="6" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;">Thông tin liên hệ: <?php echo $lvwh_lv0003->lv003;?></span></td>
        <td  colspan="<?php echo (4-$vTruCot+($vTypeID==0)?3:1);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><strong><span style="color: #000000; font-size: 14px;">Thành Tiền:</span></strong></td>
    <?php
     $vStrTem=$mocr_lv0342->strTD;
     $vStrTem=str_replace('<!--lv054-->',$mocr_lv0342->FormatView($slv054_CoVAT,20),$vStrTem);
     $vStrTem=str_replace('<!--lv163-->',$mocr_lv0342->FormatView($slv163_CoVAT,20),$vStrTem);
     $vStrTem=str_replace('<!--lv063-->',$mocr_lv0342->FormatView($slv063_CoVAT,20),$vStrTem);
     echo $vStrTem;
        //if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($slv054_CoVAT,20).'</strong></span></td>';
        //if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($slv163_CoVAT,20).'</strong></span></td>';
        //if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($slv063_CoVAT,20).'</strong></span></td>';
    ?>    
    </tr>
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="center"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 14px;">Đơn vị thụ hưởng:</span></span><span style="color: #000000; font-size: 14px;"> <?php echo $lvcr_lv0292->lv006;?></span></td>
        <td colspan="6" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;">E-Mail: <?php echo $lvwh_lv0003->lv015;?></span></td>
        <td  colspan="<?php echo (4-$vTruCot+($vTypeID==0)?3:1);?>"" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">Thanh Toán đợt 01:</span></span></strong></td>
    <?php
     $vStrTem=$mocr_lv0342->strTD;
     $vStrTem=str_replace('<!--lv054-->',$mocr_lv0342->FormatView($sTienDot1,20),$vStrTem);
     $vStrTem=str_replace('<!--lv163-->',$mocr_lv0342->FormatView($sTienDot1_163,20),$vStrTem);
     $vStrTem=str_replace('<!--lv063-->',$mocr_lv0342->FormatView($sTienDot1_63,20),$vStrTem);
     echo $vStrTem;
        //if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($sTienDot1,20).'</span></td>';
        //if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($sTienDot1_163,20).'</span></td>';
        //if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($sTienDot1_63,20).'</span></td>';
    ?>    
    </tr>
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="center"><strong><span style="color: #000000; font-size: 14px;"></span></td>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
        <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"></span></td>
        <td  colspan="<?php echo (4-$vTruCot+($vTypeID==0)?3:1);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">Thanh Toán đợt 02:</span></span></strong></td>
    <?php
    $vStrTem=$mocr_lv0342->strTD;
    $vStrTem=str_replace('<!--lv054-->',$mocr_lv0342->FormatView($sTienDot2,20),$vStrTem);
    $vStrTem=str_replace('<!--lv163-->',$mocr_lv0342->FormatView($sTienDot2_163,20),$vStrTem);
    $vStrTem=str_replace('<!--lv063-->',$mocr_lv0342->FormatView($sTienDot2_63,20),$vStrTem);
    echo $vStrTem;
        //if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($sTienDot2,20).'</span></td>';
        //if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($sTienDot2_163,20).'</span></td>';
        //if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($sTienDot2_63,20).'</span></td>';
    ?>    
    </tr>
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="center"><span style="color: #000000; font-size: 14px;"></span></td>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
        <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"></span></td>
        <td colspan="<?php echo (4-$vTruCot+($vTypeID==0)?3:1);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><strong><span style="text-decoration: underline;"><span style="color: #000000; font-size: 12px;">Thanh Toán đợt 03:</span></span></strong></td>
    <?php
        $vStrTem=$mocr_lv0342->strTD;
        $vStrTem=str_replace('<!--lv054-->',$mocr_lv0342->FormatView($sTienDot3,20),$vStrTem);
        $vStrTem=str_replace('<!--lv163-->',$mocr_lv0342->FormatView($sTienDot3_163,20),$vStrTem);
        $vStrTem=str_replace('<!--lv063-->',$mocr_lv0342->FormatView($sTienDot3_63,20),$vStrTem);
        echo $vStrTem;
        //if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($sTienDot3,20).'</span></td>';
        //if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($sTienDot3_163,20).'</span></td>';
        //if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;">'.$mocr_lv0342->FormatView($sTienDot3_63,20).'</span></td>';
    ?>    
    </tr>
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="center"><span style="color: #000000; font-size: 14px;"></span></td>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
        <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"></span></td>
        <td colspan="<?php echo (4-$vTruCot+($vTypeID==0)?3:1);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><strong><span style="color: #000000; font-size: 14px;">Tổng Cộng:</span></strong></td>
    <?php
        $vStrTem=$mocr_lv0342->strTD;
        $vStrTem=str_replace('<!--lv054-->',$mocr_lv0342->FormatView($sTienConLai,20),$vStrTem);
        $vStrTem=str_replace('<!--lv163-->',$mocr_lv0342->FormatView($sTienConLai_163,20),$vStrTem);
        $vStrTem=str_replace('<!--lv063-->',$mocr_lv0342->FormatView($sTienConLai_63,20),$vStrTem);
        echo $vStrTem;
        //if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($sTienConLai,20).'</strong></span></td>';
        //if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($sTienConLai_163,20).'</strong></span></td>';
        //if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.$mocr_lv0342->FormatView($sTienConLai_63,20).'</strong></span></td>';
    ?> 
    </tr>
    <!--
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="center"><span style="color: #000000; font-size: 14px;"></span></td>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
        <td colspan="4" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"></span></td>
        <td colspan="<?php echo (4-$vTruCot+($vTypeID==0)?3:1);?>" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><strong><span style="color: #000000; font-size: 14px;">Phần trăm thanh toán(%): <span style="color:red"><?php echo $mocr_lv0342->FormatView($vTongPercent,20).(($vTongPercent>0)?'%':'');?></span></span></strong></td>
    <?php
        $vStrTem=$mocr_lv0342->strTD;
        $vStrTem=str_replace('<!--lv054-->',($mocr_lv0342->FormatView($sPercent,20).(($sPercent>0)?'%':'')),$vStrTem);
        $vStrTem=str_replace('<!--lv163-->',($mocr_lv0342->FormatView($sPercent_163,20).(($sPercent_163>0)?'%':'')),$vStrTem);
        $vStrTem=str_replace('<!--lv063-->',($mocr_lv0342->FormatView($sPercent_63,20).(($sPercent_63>0)?'%':'')),$vStrTem);
        //echo $vStrTem;
        //if($vCot13) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.($mocr_lv0342->FormatView($sPercent,20).(($sPercent>0)?'%':'')).'</strong></span></td>';
        //if($vCot14) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.($mocr_lv0342->FormatView($sPercent_163,20).(($sPercent_163>0)?'%':'')).'</strong></span></td>';
        //if($vCot15) echo '<td style="font-family: Arial; font-size: 12px;" align="right" valign="center"><span style="color: #000000;"><strong>'.($mocr_lv0342->FormatView($sPercent_63,20).(($sPercent_63>0)?'%':'')).'</strong></span></td>';
    ?> 
    </tr>    -->
    <tr>
        <td colspan="7" style="font-family: Arial; font-size: 12px;" height="33" align="left" valign="center"><span style="color: #000000; font-size: 14px;"></span></td>
        <td colspan="2" style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <?php
            if($vTypeID==0)
            {
            ?>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <td style="font-family: Arial; font-size: 12px; " align="left" valign="center"><span style="color: #000000;"><br /></span></td>
            <?php
            }
            echo $vStrTem=$mocr_lv0342->strTD;
            ?>
    </tr>
    <tr>
    <td colspan="4" style="font-family: Arial; font-size: 12px;;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"> Xác nhận bởi Nhà cung cấp</span></strong><br/>(Họ và tên, Chức vụ, ký, đóng dấu)</td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td style="font-family: Arial; font-size: 12px;border-top: 2px solid #000000;" align="left" valign="middle"><strong><span style="color: #000000; font-size: 14px;"><br /></span></strong></td>
    <td colspan="20" style=" border-left: 1px solid #000000;font-family: Arial; font-size: 12px;font-family: Arial; font-size: 12px; border-top: 2px solid #000000;" height="33" align="left" valign="middle">
        <table width="100%">
        <tr><td colspan="3" align="left"><strong>Xác nhận bởi Bên Mua</strong></td>
            <td style="font-family: Arial; font-size: 12px;" align="right" valign="middle"><strong><span style="color: #000000; font-size: 14px;">Ngày......tháng......năm............</span></strong></td>
        </tr>
        <tr><td width="20%" align="left"><strong>Lập bởi</strong></td>
        <td  width="30%" align="center"><strong>KTT</strong></td>
        <td width="25%" align="center"><strong>Duyệt bởi</strong></td>
        <td width="25%" align="center"><strong>BGĐ</strong></td>
        <tr></table>
    </td>   
    
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
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <?php
    }
    ?>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <?php
    }
    ?>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <?php
    }
    ?>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <?php
    }
    ?>
    </tr>
    <tr>
    <td style="font-family: Arial; font-size: 12px;" height="27" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px; border-left: 1px solid #000000;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <?php
    if($vTypeID==0)
    {
    ?>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
    <td style="font-family: Arial; font-size: 12px;" align="left" valign="center"><span style="color: #000000;"><br /></span></td>
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
