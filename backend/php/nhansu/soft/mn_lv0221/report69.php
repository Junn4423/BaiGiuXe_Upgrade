<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0021.php");
require_once("../../clsall/sl_lv0013.php");
require_once("../../clsall/cr_lv0176.php");
require_once("../../clsall/cr_lv0171.php");
require_once("../../clsall/wh_lv0003.php");
require_once("../../clsall/hr_lv0221.php");
require_once("../../clsall/lv_lv0007.php");
require_once("../../clsall/cr_lv0005.php");
require_once("../../clsall/cr_lv0003.php");
require_once("../../clsall/cr_lv0113.php");
require_once("../../clsall/cr_lv0324.php");
require_once("../../clsall/cr_lv0292.php");
require_once("../../clsall/cr_lv0283.php");
require_once("../../soft/librarianconfig.php");
if($plang=="") $plang="VN";
$ma=explode('@', $_GET['ID']);
$mahopdong=($ma[0]);
if(!isset($_GET['TypeID']))
{
    //$_GET['txtShowRpt']=1;
    $_GET['TypeID']='PO-EW';
}
/////////////init object//////////////
$mowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$vowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$mocr_lv0005=new cr_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$vocr_lv0005=new cr_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$mocr_lv0003=new cr_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$mocr_lv0113=new cr_lv0113($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$mocr_lv0324=new cr_lv0324($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0324');
$mocr_lv0292=new cr_lv0292($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0324');
$mocr_lv0171=new cr_lv0171($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0171');
$mocr_lv0283=new cr_lv0283($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0283');
$mowh_lv0021->mocr_lv0324=$mocr_lv0324;
$mowh_lv0021->LV_LoadID($mahopdong);
$mocr_lv0292->LV_LoadLanGiaoHangGroup($mowh_lv0021->lv087,'');
$mocr_lv0283->LV_LoadID($mowh_lv0021->lv087);
//$mosl_lv0013->LV_LoadID($mowh_lv0021->lv026);
$sExport=$_GET['childfuncchild'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename='.$mowh_lv0021->lv014.'.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$mowh_lv0021->lv014.'.doc');
}
if($sExport=="pdf"){
header('Content-Type: text/html; charset=utf-8');}
$mowh_lv0003=new wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$mocr_lv0176=new cr_lv0176($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$mocr_lv0176->mowh_lv0021=$mowh_lv0021;
$mowh_lv0003->LV_LoadID($mowh_lv0021->lv002);
$molv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');

$mohr_lv0221=new hr_lv0221($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');


$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$vSoLaMa=1;
if($mowh_lv0021->GetView()==1)
{
  //Lay Banner
  $vType='banner';

  //Lấy dữ liệu mẫu
  if($_GET['txtShowRpt']=='1')
    $strReturn=$mowh_lv0021->LV_LoadMau($mahopdong);
  else
    $strReturn=$mowh_lv0021->LV_LoadMauNguon($_GET['TypeID']);
	//$mohr_lv0221->LV_LoadID($mowh_lv0021->lv010);
	?>
<style>
.linetr td
{
	border-bottom:1px #adadad dotted !important;;
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
<script type="text/javascript">
//window.history.pushState("", "", "/");
</script>	
<header>
<link rel="stylesheet" href="../../css/duyetkt.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body  onkeyup="KeyPublicRun(event)" ondblclick="ShowContract()" style="font-size: 14px; font-family:arial, times new roman;">
<!--<link rel="stylesheet" href="<?php echo $mowh_lv0021->ImageLink;?>../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">-->
<style>
table, td
{
  font-size: 14px; font-family:arial, times new roman;
}
</style>
</header>

<?php
if ($sExport != "excel" && $sExport != "word") {
?>	
<center>	
<div id="idhdsl" style="display:none;clear:both;width:100%;overflow:hidden">
	<form name="frmpost" action="#" method="get">
		<input type="hidden" name="func" value="child" />
		<input type="hidden" name="childfunc" value="rpt69" />
		
		<input type="hidden" name="ID" id="ID" value="<?php echo  $_GET['ID'] ?? '';?>"/>
		<input type="hidden" name="lang" id="lang" value="<?php echo $_GET['lang'];?>"/>
    <input type="hidden" name="LANGIAOHANG" id="LANGIAOHANG" value="<?php echo $_GET['LANGIAOHANG'];?>"/>
    <input type="hidden" name="isWrite" id="isWrite" value="<?php echo $_GET['isWrite'];?>"/>
		<div style="clear:both;font:bold 14px arial;width:780px;color:blue" >
      <table>
          <tr>
            <td>
		          Template
            </td>
            <td>
              <select style="width:100px;color:blue"   name="TypeID"  id="TypeID"  tabindex="6"  onKeyPress="return CheckKey(event,7)"  onKeyPress="return CheckKey(event,7)"/>
                <option value=""></option>
                <?php echo $mowh_lv0021->LV_LinkField('lv888',$_GET['TypeID']);?>
              </select>		
            </td>
            <td nowrap>
              Chọn mã CV
            </td>
            <td>
              <select style="width:100px;color:blue"   name="MaCVID"  id="MaCVID"  tabindex="6"  onKeyPress="return CheckKey(event,7)"  onKeyPress="return CheckKey(event,7)"/>
                <option value=""></option>
                <?php echo $mocr_lv0005->LV_LinkField('lv089',$_GET['MaCVID']);?>
              </select>		
            </td>
            <td nowrap>Nhóm SP</td>
            <td><input type="checkbox" name="txtGroupProduct" style="width:30px;color:blue" value=1 <?php echo ($_GET['txtGroupProduct']==1)?'checked="checked"':'';?>/>
            <td>
              <select name="childfuncchild" id="childfuncchild">
                <option value=''>..Type File..</option>
                <option value='word'>Word</option>
                <option value='excel'>Excel</option>
              </select>
            </td>
            <td><input type="checkbox" name="txtHiddenCT" style="width:30px;color:blue" value=1 <?php echo ($_GET['txtHiddenCT']==1)?'checked="checked"':'';?>/>
            <td nowrap title="Ẩn chi tiết">Ẩn CT</td>
            <td><input type="checkbox" name="txtShowRpt" style="width:30px;color:blue" value=1 <?php echo ($_GET['txtShowRpt']==1)?'checked="checked"':'';?>/>
            <td nowrap>Show Save</td>
            <td><input type="checkbox" name="txtsave" style="width:30px;color:blue" value=1 <?php echo ($_GET['txtsave']==1)?'checked="checked"':'';?>/></td>
            <td nowrap>
              Save Report </td>
              <td><input type="checkbox" name="txtEdit" style="width:30px;color:blue" value=1 <?php echo ($_GET['txtEdit']==1)?'checked="checked"':'';?>/></td>
            <td nowrap>Edit Report</td>
            
            <td><input style="width:80px;color:blue;padding:2px;;height:20px;" type="button" onclick="document.frmpost.submit()" value="Accept"/></td>
            <td><input style="width:80px;color:blue;padding:2px;;height:20px;" type="button" onclick="HiddenContract()" value="Cancel"/>
            </td>
            </tr>
      </table>
			</div>
		</div>
	</form>
</div>
<?php
}
?>
</center>	
<center>	
<?php 
if($_GET['txtEdit']==0)
{
 
    if($_GET['txtShowRpt']=='1')
    {
      echo  $strReturn;
    }
    else
    {
     
          //////////Xử lý thông số báo giá
         //Ngày báo giá
         $strReturn=str_replace("@@002",getday($mocr_lv0283->lv004),$strReturn);
         //tháng báo giá
         $strReturn=str_replace("@@003",getmonth($mocr_lv0283->lv004),$strReturn);
         //năm báo giá
         $strReturn=str_replace("@@004",getyear($mocr_lv0283->lv004),$strReturn);
         //Ngày hết hạn
         $strReturn=str_replace("@@005",getday($mocr_lv0283->lv005),$strReturn);
         //tháng hết hạn báo giá
         $strReturn=str_replace("@@006",getmonth($mocr_lv0283->lv005),$strReturn);
         //năm hết hạn báo giá
         $strReturn=str_replace("@@007",getyear($mocr_lv0283->lv005),$strReturn);

         // Mã PMH
          $strReturn=str_replace("@!001",$mowh_lv0021->lv001,$strReturn);
          //NCC
          $strReturn=str_replace("@!002",$mowh_lv0003->lv002,$strReturn);
          //Chù đề
          $strReturn=str_replace("@!003",$mowh_lv0021->lv003,$strReturn);
          //Ngày mua hàng
          $strReturn=str_replace("@!004",$mohr_lv0221->FormatView($mowh_lv0021->lv004,2),$strReturn);
          //Ngày hết hạn
          $strReturn=str_replace("@!005",$mohr_lv0221->FormatView($mowh_lv0021->lv005,2),$strReturn);
          //Tỷ lệ thuế(%)
          $strReturn=str_replace("@!006",$mowh_lv0021->lv006,$strReturn);
          //Phương thức thanh toán
          $strReturn=str_replace("@!007",$mowh_lv0021->lv007,$strReturn);
          //Phương thức vận chuyển
          $strReturn=str_replace("@!008",$mowh_lv0021->lv008,$strReturn);
          //Ghi chú
          $strReturn=str_replace("@!009",$mowh_lv0021->lv009,$strReturn);
          //Người tạo
          $strReturn=str_replace("@!010",$mowh_lv0021->lv010,$strReturn);
          //Trạng thái 
          $strReturn=str_replace("@!011",$mowh_lv0021->lv011,$strReturn);
          //Tiền tệ thứ 2
          $strReturn=str_replace("@!012",$mowh_lv0021->lv012,$strReturn);
          //Tỷ giá VNĐ
          $strReturn=str_replace("@!013",$mowh_lv0021->lv013,$strReturn);
         //Tài khoản phải trả
          $strReturn=str_replace("@!014",$mowh_lv0021->lv014,$strReturn);
          //Tỷ giá tiền tệ thứ 2
          $strReturn=str_replace("@!015",$mowh_lv0021->lv015,$strReturn);
          //Mã HĐMH
          $strReturn=str_replace("@!086",$mocr_lv0283->lv086,$strReturn);
          //Mã nhóm lần mua hàng
          $strReturn=str_replace("@!087",$mowh_lv0021->lv087,$strReturn);
          //Phiếu ĐNVT
          $strReturn=str_replace("@!088",$mowh_lv0021->lv088,$strReturn);
          //PBH
          $strReturn=str_replace("@!089",$mowh_lv0021->lv089,$strReturn);
         //Phiếu đầu ra
         $strReturn=str_replace("@!090",$mowh_lv0021->lv090,$strReturn);
          /*
          NCC
          */
          //Mã
          $strReturn=str_replace("@*001",$mowh_lv0003->lv001,$strReturn);
          //Tên công ty
          $strReturn=str_replace("@*002",$mowh_lv0003->lv002,$strReturn);
          //Tên người liên hệ
          $strReturn=str_replace("@*003",$mowh_lv0003->lv003,$strReturn);
          //Tên người ký hợp đồng
          $strReturn=str_replace("@*004",$mowh_lv0003->lv004,$strReturn);
          //Điên thoại
          $strReturn=str_replace("@*005",$mowh_lv0003->lv005,$strReturn);
          //Điạ chỉ
          $strReturn=str_replace("@*006",$mowh_lv0003->lv006,$strReturn);
          //Tỉnh
          $strReturn=str_replace("@*007",$mowh_lv0003->lv007,$strReturn);
          //Quốc gia
          $strReturn=str_replace("@*008",$mowh_lv0003->lv008,$strReturn);
          //Ngày sinh
          $strReturn=str_replace("@*009",$mowh_lv0003->lv009,$strReturn);
          //Điện thoại
          $strReturn=str_replace("@*010",$mowh_lv0003->lv010,$strReturn);
          //Điên thoại di động
          $strReturn=str_replace("@*011",$mowh_lv0003->lv011,$strReturn);
          //Địa chỉ ngân hàng
          $strReturn=str_replace("@*012",$mowh_lv0003->lv012,$strReturn);
          //CMND/Mã số thuế
          $strReturn=str_replace("@*013",$mowh_lv0003->lv013,$strReturn);
          //Website
          $strReturn=str_replace("@*014",$mowh_lv0003->lv014,$strReturn);
          //Email
          $strReturn=str_replace("@*015",$mowh_lv0003->lv015,$strReturn);
         //Số tài khoản
          $strReturn=str_replace("@*016",$mowh_lv0003->lv016,$strReturn);
          //Tên ngân hàng
          $strReturn=str_replace("@*019",$mowh_lv0003->lv019,$strReturn);
          //Chủ tài khoản
          $strReturn=str_replace("@*020",$mowh_lv0003->lv020,$strReturn);
          //Người liên hệ
          $strReturn=str_replace("@*021",$mowh_lv0003->lv021,$strReturn);
          //Switch code
          $strReturn=str_replace("@*022",$mowh_lv0003->lv022,$strReturn);
          ///Xử lý lấy mẫu đính kèm VN
          $vContentDoc=$mocr_lv0171->LV_GetLayDuLieu($mowh_lv0021->lv087,0);
          $strReturn=str_replace("@$001", $vContentDoc,$strReturn);
          ///Xử lý lấy mẫu đính kèm EN
          $vContentDoc=$mocr_lv0171->LV_GetLayDuLieu($mowh_lv0021->lv087,1);
          $strReturn=str_replace("@$002", $vContentDoc,$strReturn);
          ///Xu ly thong tin
          $strReturn=str_replace("@$003",$mocr_lv0292->lv003,$strReturn);
          $strReturn=str_replace("@$004",$mocr_lv0292->lv004,$strReturn);
          $strReturn=str_replace("@$005",$mocr_lv0292->lv005,$strReturn);
          $strReturn=str_replace("@$006",$mocr_lv0292->lv006,$strReturn);
          $strReturn=str_replace("@$007",$mocr_lv0292->lv007,$strReturn);
          $strReturn=str_replace("@$008",$mocr_lv0292->lv008,$strReturn);
          $strReturn=str_replace("@$009",$mocr_lv0292->lv009,$strReturn);
          $strReturn=str_replace("@$010",$mocr_lv0292->lv010,$strReturn);
          $strReturn=str_replace("@$011",$mocr_lv0292->lv011,$strReturn);
          $strReturn=str_replace("@$012",$mocr_lv0292->lv012,$strReturn);
          $strReturn=str_replace("@$013",$mocr_lv0292->lv013,$strReturn);
          $strReturn=str_replace("@$014",$mocr_lv0292->lv014,$strReturn);
          $strReturn=str_replace("@$015",$mocr_lv0292->lv015,$strReturn);
          $strReturn=str_replace("@$016",$mocr_lv0292->lv016,$strReturn);
          $strReturn=str_replace("@$017",$mocr_lv0292->lv017,$strReturn);
          $strReturn=str_replace("@$018",$mocr_lv0292->lv018,$strReturn);
          $strReturn=str_replace("@$019",$mocr_lv0292->lv019,$strReturn);
          $strReturn=str_replace("@$020",$mocr_lv0292->lv020,$strReturn);
          $strReturn=str_replace("@$021",$mocr_lv0292->lv021,$strReturn);
          $strReturn=str_replace("@$022",$mocr_lv0292->lv022,$strReturn);
          $strReturn=str_replace("@$023",$mocr_lv0292->lv023,$strReturn);

          $strReturn=str_replace("@$031",$mocr_lv0292->lv011,$strReturn);
          $strReturn=str_replace("@$032",$mocr_lv0292->lv012,$strReturn);
          $strReturn=str_replace("@$033",$mocr_lv0292->lv013,$strReturn);
          $strReturn=str_replace("@$034",$mocr_lv0292->lv014,$strReturn);
          $strReturn=str_replace("@$035",$mocr_lv0292->lv015,$strReturn);
          $strReturn=str_replace("@$036",$mocr_lv0292->lv016,$strReturn);
          $strReturn=str_replace("@$037",$mocr_lv0292->lv017,$strReturn);
          $strReturn=str_replace("@$038",$mocr_lv0292->lv018,$strReturn);
          $strReturn=str_replace("@$039",$mocr_lv0292->lv019,$strReturn);
          $strReturn=str_replace("@$040",$mocr_lv0292->lv020,$strReturn);
          $strReturn=str_replace("@$041",$mocr_lv0292->lv021,$strReturn);
          $strReturn=str_replace("@$042",$mocr_lv0292->lv022,$strReturn);
          $strReturn=str_replace("@$043",$mocr_lv0292->lv023,$strReturn);

          $strReturn=str_replace("@$051",$mocr_lv0292->lv011,$strReturn);
          $strReturn=str_replace("@$052",$mocr_lv0292->lv012,$strReturn);
          $strReturn=str_replace("@$053",$mocr_lv0292->lv013,$strReturn);
          $strReturn=str_replace("@$054",$mocr_lv0292->lv014,$strReturn);
          $strReturn=str_replace("@$055",$mocr_lv0292->lv015,$strReturn);
          $strReturn=str_replace("@$056",$mocr_lv0292->lv016,$strReturn);
          $strReturn=str_replace("@$057",$mocr_lv0292->lv017,$strReturn);
          $strReturn=str_replace("@$058",$mocr_lv0292->lv018,$strReturn);
          $strReturn=str_replace("@$059",$mocr_lv0292->lv019,$strReturn);
          $strReturn=str_replace("@$060",$mocr_lv0292->lv020,$strReturn);
          $strReturn=str_replace("@$061",$mocr_lv0292->lv021,$strReturn);
          $strReturn=str_replace("@$062",$mocr_lv0292->lv022,$strReturn);
          $strReturn=str_replace("@$063",$mocr_lv0292->lv023,$strReturn);

          if($plang=="") $plang="VN";
          $mocr_lv0176->lang=$plang;
          $vLangArr=GetLangFile("../../","CR0215.txt",$plang);
          $mocr_lv0176->ArrPush[0]=$vLangArr[17];
          $mocr_lv0176->ArrPush[1]=$vLangArr[18];
          $mocr_lv0176->ArrPush[2]=$vLangArr[19];
          $mocr_lv0176->ArrPush[3]=$vLangArr[20];
          $mocr_lv0176->ArrPush[4]=$vLangArr[21];
          $mocr_lv0176->ArrPush[5]=$vLangArr[22];
          $mocr_lv0176->ArrPush[6]=$vLangArr[23];
          $mocr_lv0176->ArrPush[7]=$vLangArr[24].'('.$mowh_lv0021->lv016.')';
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
          $mocr_lv0176->ArrPush[55]=$vLangArr[72].'('.$mowh_lv0021->lv016.')';
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
          $mocr_lv0176->ArrPush[140]='Code';
          if($plang=='EN')
          {
            $mocr_lv0176->ArrPush[300]='Supplier';
            $mocr_lv0176->ArrPush[163]='Price('.$mowh_lv0021->lv012.')';
            $mocr_lv0176->ArrPush[164]='Amount('.$mowh_lv0021->lv012.')';
            $mocr_lv0176->ArrPush[205]='Our ref. Q\'ty';
          }
          else
          {
            $mocr_lv0176->ArrPush[300]='Mã NCC';
            $mocr_lv0176->ArrPush[163]='Đơn giá('.$mowh_lv0021->lv012.')';
            $mocr_lv0176->ArrPush[164]='Thành tiền('.$mowh_lv0021->lv012.')';
            $mocr_lv0176->ArrPush[205]='S\'lượng<br/>Our ref.';
          }
          
          $mocr_lv0176->lv002=$mowh_lv0021->lv001;
    //////////////////////////////////////////////////////////////////////////////////////////////////////
        
          $mocr_lv0176->ListMau=$vListMau;
          $vFieldList='lv011,lv008,lv004,lv005,lv006,lv054,lv095';
          $curPage = $mocr_lv0176->CurPage;
          $maxRows =$mocr_lv0176->MaxRows;
          $vOrderList='1,2,3,4,5,6,7,8,9,10';
          $vSortNum=$mocr_lv0176->SortNum;
          $mocr_lv0176->ListMau=$vListMau;
          $mocr_lv0176->DefaultFieldList=$vFieldList;
          $mocr_lv0176->ArrPush[1]='No';
          $mocr_lv0176->ArrPush[12]='DESCRIPTION';
          $mocr_lv0176->ArrPush[9]='MODEL';
          $mocr_lv0176->ArrPush[5]='QTY';
          $mocr_lv0176->ArrPush[6]='UNIT';
          $mocr_lv0176->ArrPush[7]='UNIT PRICE'.'<br/>('.$mowh_lv0021->lv016.')';
          $mocr_lv0176->ArrPush[55]='TOTAL AMOUNT'.'<br/>('.$mowh_lv0021->lv016.')';
          $mocr_lv0176->ArrPush[96]='IV PAYMENT';
          $mocr_lv0176->ArrPush[137]='TYPE';
          $mocr_lv0176->ArrPush[140]='Code';
          $mocr_lv0176->DonViTienTe=$mowh_lv0021->lv016;
          $vStrChildDetailMP=$mocr_lv0176->LV_BuilListReportOtherPBH($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
          $strReturn=str_replace("@@100",$vStrChildDetailMP,$strReturn);
          $strReturn=str_replace("@@101",$mocr_lv0176->TextKhongSum,$strReturn);
          $strReturn=str_replace("@@084",$mocr_lv0176->HD_TIENCHIETKHAU,$strReturn);
          $strReturn=str_replace("@@800",$mocr_lv0176->HD_TONGTIENHD,$strReturn);
          $vDocChu=LNum2Text($mocr_lv0176->HD_TONGTIENHD,'EN',$mowh_lv0021->lv016);
          $strReturn=str_replace("@@802",$vDocChu,$strReturn);
          $strReturn=str_replace("@@801",strtoupper($vDocChu),$strReturn);
          $vFieldList='lv811,lv008,lv136,lv004,lv005,lv006,lv054,lv095';
          $vOrderList='1,2,3,4,5,6,7,8,9,10';
          $mocr_lv0176->DefaultFieldList=$vFieldList;
          $vStrChildDetailMP=$mocr_lv0176->LV_BuilListReportOtherPBH($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
          $strReturn=str_replace("@@200",$vStrChildDetailMP,$strReturn);
          $vFieldList='lv811,lv008,lv136,lv139,lv004,lv005,lv006,lv054,lv095';
          $vOrderList='1,2,3,4,5,6,7,8,9,10';
          $mocr_lv0176->DefaultFieldList=$vFieldList;
          $vStrChildDetailMP=$mocr_lv0176->LV_BuilListReportOtherPBH($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
          $strReturn=str_replace("@@300",$vStrChildDetailMP,$strReturn);
          echo $strReturn;
          
  }

  if($_GET['txtsave']==1)
  {
    if($_GET['txtEdit']==1) $strReturn=$_POST['txtNoiDung'];
    $mowh_lv0021->LV_UpdateMau($mahopdong,$strReturn);
  }
}
else
{
  if($_GET['txtEdit']==0) echo  $strReturn;
  if($_GET['txtsave']==1 && trim($_POST['txtNoiDung'])!='')
    {
      if($_GET['txtEdit']==1) $strReturn=$_POST['txtNoiDung'];
      $mowh_lv0021->LV_UpdateMau($mahopdong,$strReturn);
    }
?>

<!-- TinyMCE -->
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<form name="frmedit" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&lang=<?php echo $_GET['lang'];?>&TypeID=<?php echo $_GET['TypeID'];?>&childfuncchild=<?php echo $_GET['childfuncchild'];?>&txtShowRpt=1&txtsave=1&txtEdit=<?php echo $_GET['txtEdit'];?>&LANGIAOHANG=<?php echo $_GET['LANGIAOHANG'];?>" method="post">
    <input type="hidden" name="func" value="child" />
		<input type="hidden" name="childfunc" value="rpt" />
		
		<input type="hidden" name="ID" id="ID" value="<?php echo  $_GET['ID'] ?? '';?>"/>
		<input type="hidden" name="lang" id="lang" value="<?php echo $_GET['lang'];?>"/>
    <input type="hidden" name="TypeID" id="TypeID" value="<?php echo $_GET['TypeID'];?>"/>
    <input type="hidden" name="childfuncchild" id="childfuncchild" value="<?php echo $_GET['childfuncchild'];?>"/>
    <input type="hidden" name="txtsave" id="txtsave" value="1"/>
    <input type="hidden" name="txtEdit" id="txtEdit" value="<?php echo $_GET['txtEdit'];?>"/>
    <input type="hidden" name="txtShowRpt" style="width:30px;color:blue" value=1 <?php echo ($_GET['txtShowRpt']==1)?'checked="checked"':'';?>/>
    <table width="100%">
      <tr>
       <td colspan="3">
          <textarea name="txtNoiDung" rows="20" id="txtNoiDung" style="width:80%" tabindex="7"><?php echo $strReturn;?></textarea>
        </td>
      </tr>
      <tr>
        <td width="1%">
        <input type="submit" name="SaveNoiDung" value="Save Edit Template"/>
        </td>
        <td width="1%">
          <input type="button" name="ViewNoiDung" value="View Template" onclick="ViewRpt()"/>
        </td>
        <td width="*"></td>
      </tr>
    </table>
    
</form> 

</center>	
<?php
}
}
else {
	include("../permit.php");
}
?>
