<?php
session_start();
$sExport=$_GET['childfuncchild'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=hopdonglaodong.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=hopdonglaodong.doc');
}
if($sExport=="pdf"){
header('Content-Type: text/html; charset=utf-8');}
$vDir='../';
include($vDir."paras.php");
include($vDir."config.php");
include($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/hr_lv0098.php");
require_once("$vDir../clsall/hr_lv0038.php");
require_once("$vDir../clsall/hr_lv0020.php");
require_once("$vDir../clsall/hr_lv0043.php");
require_once("$vDir../clsall/hr_lv0042.php");
require_once("$vDir../clsall/jo_lv0016.php");
require_once("$vDir../clsall/hr_lv0018.php");
require_once("$vDir../clsall/hr_lv0001.php");
require_once("$vDir../clsall/hr_lv0002.php");
require_once("$vDir../clsall/hr_lv0036.php");
$mohr_lv0042=new hr_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0042');
$mohr_lv0036=new hr_lv0036($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0036');
/////////////init object//////////////
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$mohr_lv0020_NSD=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$mohr_lv0098=new hr_lv0098($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0098');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
$vohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
$mohr_lv0043=new hr_lv0043($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0043');
$mojo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0016');
$mohr_lv0018=new hr_lv0018($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0018');
$mohr_lv0001=new hr_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0001');
$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0001');
$mohr_lv0038->Dir=$vDir;

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

$varr=explode("@",$_GET["ID"]);
$vlv001=$varr[0];
$vCompany=$_GET['txtcongty'];
if($vCompany=='')
{
	$vCompany='DIHUNG';
	$_GET['txtcongty']=$vCompany;
}
$vnguoiky=$_GET['txtnguoiky'];
if($vnguoiky=='')
{
	$vnguoiky=$mohr_lv0020->LV_UserID;
	$_GET['txtnguoiky']=$vnguoiky;
}
$mohr_lv0001->LV_LoadID($vCompany);
$mohr_lv0020_NSD->LV_LoadID($vnguoiky);
if(trim($mohr_lv0020_NSD->lv066)!='' && $mohr_lv0020_NSD->lv066!=null)	$mohr_lv0020_NSD->lv002=$mohr_lv0020_NSD->lv066;
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","HR0123.txt",$plang);
if($mohr_lv0038->GetView()>0)
{
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/public.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
</head>
<script language="javascript">
function ShowContract()
{
	document.getElementById('idhdsl').style.display='block';
}
function HideContract()
{
	document.getElementById('idhdsl').style.display='none';
}
</script>
<body  onkeyup="KeyPublicRun(event)" ondblclick="ShowContract()">
<div id="idhdsl" style="display:none;clear:both;">
<center>
<?php
if ($sExport != "excel" && $sExport != "word") {
	?>
<form name="frmpost" action="#" method="get">
	<input type="hidden" name="func" value="child" />
	<input type="hidden" name="childfunc" value="rpt" />
	
	<input type="hidden" name="ID" id="ID" value="<?php echo  $_GET['ID'] ?? '';?>"/>
	<input type="hidden" name="lang" id="lang" value="<?php echo $_GET['lang'];?>"/>

	<div style="clear:both;font:bold 14px arial;width:880px;color:blue" >
		<div style="float:left">
			Chọn mẫu<br/>
			<select style="width:100px;color:blue"   name="ContractID"  id="ContractID"  tabindex="6"  onKeyPress="return CheckKey(event,7)"  onKeyPress="return CheckKey(event,7)"/>
				<option value=""></option><?php echo $mohr_lv0038->LV_LinkField('lv020',$_GET['ContractID']);?>
			</select>		
		</div>
		 <div  style="float:left">
		 	Chọn người ký:
		 	<table style="width:300px"><tr>
		 		<td style="width:50%">
				<select  name="txtnguoiky"  id="txtnguoiky"  tabindex="12" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)">
		  			<option value=""></option>
		  			<?php echo $mohr_lv0038->LV_LinkField('lv902',$_GET['txtnguoiky']);?>
				 </select>	
				</td>
				<td>
					<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
					<input type="text" autocomplete="off" class="search_img_btn" style="width:50%" onKeyUp="LoadPopup(this,'txtnguoiky','hr_lv0020','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtnguoiky','hr_lv0020','concat(lv002,@! @!,lv001)')" tabindex="200" >
					<div id="lv_popup" lang="lv_popup1"> </div>						  
					</li>
					</ul>
				</td>
				</tr>
			</table>
		 </div>
		  <div  style="float:left">
		  	<center>
		  		Chọn chi nhánh:
		  	</center>	
		  	<center>
				<select  name="txtcongty"  id="txtcongty"  tabindex="12" maxlength="255" style="width:150px;" onKeyPress="return CheckKey(event,7)">
		  			<option value=""></option>
		  			<?php echo $mohr_lv0038->LV_LinkField('lv903',$_GET['txtcongty']);?>
				 </select>	
			</center>
		</div>
		<!--<div style="float:left"><?php echo 'Chiều dài số tự động';?></div>
		<div style="float:left">
			<input style="width:50px" type="text" name="txtLen" id="txtLen" value="<?php echo $_GET['txtLen'];?>"/>
		</div>
		<div style="float:left"><?php echo 'Số thứ tự';?></div>
		<div style="float:left">
			<input style="width:50px" type="text" name="txtSTT" id="txtSTT" value="<?php echo $_GET['txtSTT'];?>"/>
		</div>-->
		<div style="float:left">		
			<center>Lưu mẫu 
			<input type="checkbox" name="txtsave" style="width:30px;color:blue" value=1 <?php echo ($_GET['txtsave']==1)?'checked="checked"':'';?>/>  
			</center>
		</div>
		<div style="float:left">		
			&nbsp;&nbsp;&nbsp;<input style="width:80px;color:blue;padding:10px;;height:30px;" type="button" onclick="document.frmpost.submit()" value="Chấp nhận"/>
			<br/>
			<select name="childfuncchild" id="childfuncchild">
				<option value=''>..Chọn..</option>
				<option value='word'>Word</option>
				<option value='excel'>Excel</option>
			</select>
		</div>
		<div style="float:left">		
			<center>
			<input style="width:80px;color:blue;padding:10px;;height:30px;" type="button" onclick="HideContract()" value="Ẩn"/>
			</center>
		</div>
	</div>
</form>
<?php
}
?>
<script language="javascript" src="../../javascripts/menupopup.js"></script>
<center>
</div>
<center>
<?php
$vOrder=(int)$_GET['txtSTT']+1;
foreach($varr as $vlv001)
{
if(trim($vlv001)!='')
{
	
$mojo_lv0016->LV_Load();
$mohr_lv0038->LV_LoadID($vlv001);
$vStrAlarm=$mohr_lv0036->LV_GetAlarm($mohr_lv0038->lv002);
$mohr_lv0098->LV_LoadID($mohr_lv0038->lv096);

$vHDLD='';
$vPhuLucHDLD='';
if($_GET['ContractID']!="")
	$mohr_lv0043->LV_LoadID($_GET['ContractID']);	
else
	$mohr_lv0043->LV_LoadID($mojo_lv0016->lv016);
	$strReturn=$mohr_lv0043->lv003;
	$lvStartDate=$mohr_lv0038->lv004;
	$lvEndDate=$mohr_lv0038->lv005;
	$ContractLaborID=$mohr_lv0038->lv001;
	$lvStartDateCal=ADDDATE($mohr_lv0038->lv004,31);
	$mohr_lv0020->LV_LoadFullIDCal($mohr_lv0038->lv002,$lvStartDateCal);
	if(trim($mohr_lv0020->lv066)!='' && $mohr_lv0020->lv066!=null)	$mohr_lv0020->lv002=$mohr_lv0020->lv066;
	$mohr_lv0038->MaSoHDTuDong='';
	$vMaHDCha=$mohr_lv0038->LV_LoadContractLaborParent($mohr_lv0038->lv099,$vDateContract,$vArrListContractLabor,$vHDLD,$vPhuLucHDLD,$mohr_lv0038->lv097);
	if($mohr_lv0038->MaSoHDTuDong=='')
	{
		$mohr_lv0038->MaSoHDTuDong=(($mohr_lv0038->lv003==0)?'1':$mohr_lv0038->lv003).substr($mohr_lv0038->lv002,2,11);
	}
	$vListContractLabor=$mohr_lv0038->LV_SortArrayStr($vArrListContractLabor);
	$strReturn=str_replace("@@038",$vMaHDCha,$strReturn);
	$strReturn=str_replace("@@053",$mohr_lv0001->lv010,$strReturn);
	//Mã số hợp đồng tự động
	$strReturn=str_replace("@@999",$mohr_lv0038->MaSoHDTuDong,$strReturn);
	//Mã số hợp đồng tự động kế tiếp
	if(substr($mohr_lv0038->lv003)>=3)
	{
		$vMaSoHDTuDong='PL001-'.$mohr_lv0038->MaSoHDTuDong;
		$strReturn=str_replace("@@893",$mohr_lv0038->getvaluelink('lv003',4),$strReturn);
	}
	else
	{
		$strReturn=str_replace("@@893",$mohr_lv0038->getvaluelink('lv003',$mohr_lv0038->lv003+1),$strReturn);
		$vMaSoHDTuDong=(substr($mohr_lv0038->MaSoHDTuDong,0,1)+1).substr($mohr_lv0038->MaSoHDTuDong,1,(strlen($mohr_lv0038->MaSoHDTuDong)-1));
	}

	$strReturn=str_replace("@@899",$vMaSoHDTuDong,$strReturn);
	//Mã số hợp đồng tự động
	$strReturn=str_replace("@@998",($mohr_lv0038->MaSoHDTuDong!='')?$mohr_lv0038->MaSoHDTuDong:$mohr_lv0038->lv006,$strReturn);
	//Mã số hợp đồng tự động
	$strReturn=str_replace("@@997",($mohr_lv0038->lv006!='')?$mohr_lv0038->lv006:$mohr_lv0038->MaSoHDTuDong,$strReturn);
	//Xác định hợp đồng là HĐ , PL hoặc cả 2
	//Xác định xem có phụ lục tham chiếu không?LV
	///Hop dong khac
		$vLaborPrevious=$_GET['HDOTHER'];
		if($vLaborPrevious=='' || $vLaborPrevious==NULL) $vLaborPrevious=$mohr_lv0038->lv099;
		$vohr_lv0038->LV_LoadID($vLaborPrevious);
	if($mohr_lv0098->lv001!=NULL)
	{
		$mohr_lv0098->lv016;
		if($vHDLD=='')
			$visPLHD=1;
		else
			$visPLHD=2;
		$vPhuLucHDLD=' '.$mohr_lv0098->lv016.' hiệu lực từ ngày '.$mohr_lv0098->FormatView($mohr_lv0098->lv004,2);
		$strReturn=str_replace("@*028",$mohr_lv0098->lv011,$strReturn);
		$strReturn=str_replace("@*029",$vohr_lv0038->getvaluelink('lv029',$mohr_lv0098->lv012),$strReturn);
		$strReturn=str_replace("@*030",$mohr_lv0098->lv013,$strReturn);
		$strReturn=str_replace("@*010",$vohr_lv0038->getvaluelink('lv910',$mohr_lv0098->lv006),$strReturn);
		$strReturn=str_replace("@*006",$mohr_lv0098->lv016,$strReturn);
		$strReturn=str_replace("@*004",$mohr_lv0098->FormatView($mohr_lv0098->lv004,2),$strReturn);
		//$strReturn=str_replace("@!027",$mohr_lv0098->lv010,$strReturn);
	}
	else //Tiếp tục xác định nếu không có phụ lục tham chiếu trước thì dò hợp đồng theo n cấp lấy hợp đồng và phụ lục cần
	{
		$strReturn=str_replace("@*028",$vohr_lv0038->lv028,$strReturn);
		$strReturn=str_replace("@*029",$vohr_lv0038->getvaluelink('lv029',$vohr_lv0038->lv029),$strReturn);
		$strReturn=str_replace("@*030",$vohr_lv0038->lv030,$strReturn);
		$strReturn=str_replace("@*010",$vohr_lv0038->getvaluelink('lv910',$vohr_lv0038->lv010),$strReturn);
		$strReturn=str_replace("@*310",$mohr_lv0020->getvaluelink('lv029',$vohr_lv0038->lv010),$strReturn);
		$strReturn=str_replace("@*006",$vohr_lv0038->lv006,$strReturn);
		$strReturn=str_replace("@*004",$vohr_lv0038->FormatView($vohr_lv0038->lv004,2),$strReturn);
		/*if(trim($vohr_lv0038->lv027)=='')
			$strReturn=str_replace("@!027",$mohr_lv0038->lv027,$strReturn);
		else*/
		//$strReturn=str_replace("@!027",$mohr_lv0038->lv027,$strReturn);
		if($vHDLD!='' && $vPhuLucHDLD!='')
		{
			$visPLHD=2;
		}
		elseif($vHDLD!='')
		{
			$visPLHD=0;
		}
		else
			$visPLHD=1;	
	}
	
		$strReturn=str_replace("@!027",$mohr_lv0038->lv027,$strReturn);
		$vArrGenDer=Array(0=>'Nữ',1=>'Nam');
		$vLangArrAC=Array(0=>'Chị',1=>'Anh');
		$vLangArrOB=Array(0=>'Bà',1=>'Ông');
		$vLangArrMS=Array(0=>'Mrs.',1=>'Mr.');
		//Thông số thay đổi phòng ban 
		$strReturn=str_replace("@$001",$mohr_lv0098->lv001,$strReturn);
		$strReturn=str_replace("@$002",$mohr_lv0098->lv002,$strReturn);
		$strReturn=str_replace("@$003",$mohr_lv0098->lv003,$strReturn);
		$strReturn=str_replace("@$004",$mohr_lv0098->FormatView($mohr_lv0098->lv004,2),$strReturn);
		$strReturn=str_replace("@$005",$mohr_lv0098->FormatView($mohr_lv0098->lv005,2),$strReturn);
		$strReturn=str_replace("@$006",$mohr_lv0098->lv006,$strReturn);
		$strReturn=str_replace("@$007",$mohr_lv0098->lv007,$strReturn);
		$strReturn=str_replace("@$008",$mohr_lv0098->lv008,$strReturn);
		$strReturn=str_replace("@$009",$mohr_lv0098->lv009,$strReturn);
		$strReturn=str_replace("@$010",$mohr_lv0098->lv010,$strReturn);
		$strReturn=str_replace("@$011",$mohr_lv0098->lv011,$strReturn);
		$strReturn=str_replace("@$012",$mohr_lv0098->getvaluelink('lv012',$mohr_lv0098->lv012),$strReturn);
		$strReturn=str_replace("@$012",$mohr_lv0098->lv012,$strReturn);
		$strReturn=str_replace("@$013",$mohr_lv0098->lv013,$strReturn);
		$strReturn=str_replace("@$014",$mohr_lv0098->FormatView($mohr_lv0098->lv014,2),$strReturn);
		$strReturn=str_replace("@$015",$mohr_lv0098->lv015,$strReturn);
		$strReturn=str_replace("@$096",$mohr_lv0098->lv096,$strReturn);
		$strReturn=str_replace('@$097',$mohr_lv0098->lv097,$strReturn);
		$strReturn=str_replace("@$099",$mohr_lv0098->lv099,$strReturn);
		//Thông số ngoài
		$strReturn=str_replace("@@001",$ContractLaborID,$strReturn);

		$strReturn=str_replace("@@002",getday($lvStartDate),$strReturn);
		$strReturn=str_replace("@@003",getmonth($lvStartDate),$strReturn);
		$strReturn=str_replace("@@004",getyear($lvStartDate),$strReturn);

		$strReturn=str_replace("@@005",getday($lvEndDate),$strReturn);
		$strReturn=str_replace("@@006",getmonth($lvEndDate),$strReturn);
		$strReturn=str_replace("@@007",getyear($lvEndDate),$strReturn);

		
		$strReturn=str_replace("@@008",getday($mohr_lv0020->DateCurrent),$strReturn);
		$strReturn=str_replace("@@009",getmonth($mohr_lv0020->DateCurrent),$strReturn);
		$strReturn=str_replace("@@010",getyear($mohr_lv0020->DateCurrent),$strReturn);
		$strReturn=str_replace("@@011",gettime($mohr_lv0020->DateCurrent),$strReturn);
		$strReturn=str_replace("@@012",substr(gettime($mohr_lv0020->DateCurrent),0,6),$strReturn);
		//Fill mã số thuế
		$strReturn=str_replace('@@013',$mohr_lv0020->LV_codeidfill($mohr_lv0020->lv013),$strReturn);

		$lvStartDateTV=$mohr_lv0038->lv098;
		$strReturn=str_replace("@@014",getday($lvStartDateTV),$strReturn);
		$strReturn=str_replace("@@015",getmonth($lvStartDateTV),$strReturn);
		$strReturn=str_replace("@@016",getyear($lvStartDateTV),$strReturn);
		$strReturn=str_replace("@@017",substr(getyear($lvStartDateTV),2,2),$strReturn);
		//Số thông
		$strReturn=str_replace("@@018",$mohr_lv0020->GetMonthStartEnd($lvStartDate,$lvEndDate),$strReturn);
		//Lương ký HĐ @@021
		//echo $mohr_lv0020->lv001.','.$mohr_lv0038->lv301.','.$mohr_lv0020->lv147.',(int)getmonth('.$mohr_lv0038->lv004.'),getyear('.$mohr_lv0038->lv004.')';
		$vSalaryInsurance=$mohr_lv0038->FormatView($mohr_lv0038->lv022,20);
		//	Lương công ty cấp bậc
		$RowLuongCapBac=$mohr_lv0020->LV_GetBacLuongCongTy($mohr_lv0038->lv300);
		
		$strReturn=str_replace("@@027",$mohr_lv0001->FormatView($RowLuongCapBac['lv010'],20),$strReturn);
		//85% lương đào tạo
		$strReturn=str_replace("@@019",$mohr_lv0020->FormatView(round($mohr_lv0038->lv022*$mohr_lv0038->lv017/100,0),20),$strReturn);
		//85% bậc lương công ty
		$strReturn=str_replace("@@020",$mohr_lv0020->FormatView(round(($RowLuongCapBac['lv010']+($RowLuongCapBac['lv010']*$RowLuongCapBac['lv011']/100+$RowLuongCapBac['lv010']*$RowLuongCapBac['lv012']/100)+$RowLuongCapBac['lv013']+$RowLuongCapBac['lv014']+$RowLuongCapBac['lv015']+$RowLuongCapBac['lv016'])*$mohr_lv0038->lv017/100,0),20),$strReturn);
		//85% bậc lương công ty
		if($mohr_lv0038->lv024=='VND')
			$strReturn=str_replace("@@099",$mohr_lv0020->FormatView(round($mohr_lv0038->lv022+($mohr_lv0038->lv022*$mohr_lv0038->lv032/100+$mohr_lv0038->lv022*$mohr_lv0038->lv033/100),-3),20),$strReturn);
		else
			$strReturn=str_replace("@@099",$mohr_lv0020->FormatView(round($mohr_lv0038->lv022+($mohr_lv0038->lv022*$mohr_lv0038->lv032/100+$mohr_lv0038->lv022*$mohr_lv0038->lv033/100),0),20),$strReturn);
		///////////vi Phạm////////////////
		$strReturn=str_replace("@@801",$vStrAlarm,$strReturn);
		//	Tên công ty
		$strReturn=str_replace("@@030",$mohr_lv0001->lv002,$strReturn);
		//Địa chỉ công ty
		$strReturn=str_replace("@@031",$mohr_lv0001->lv003,$strReturn);
		//Địa chỉ công ty
		$strReturn=str_replace("@@026",$mohr_lv0020->lv026,$strReturn);

		//Điện thoại
		$strReturn=str_replace("@@034",$mohr_lv0001->lv005,$strReturn);
		//Fax
		$strReturn=str_replace("@@035",$mohr_lv0001->lv006,$strReturn);
		//Mã công ty
		$mohr_lv0002->LV_LoadID($mohr_lv0020->lv029);
		$strReturn=str_replace("@@036",$mohr_lv0002->lv004,$strReturn);
		//Ma quoc tich
		$strReturn=str_replace("@@037",$mohr_lv0020->lv022,$strReturn);
		//Mã hợp đồng cha ( 1 năm, 2 năm và vô thời hạn)
		
		//Ngày hợp đồng cha ( 1 năm, 2 năm và vô thời hạn)
		$strReturn=str_replace("@@039",$mohr_lv0038->FormatView($vDateContract,2),$strReturn);
		//Danh sách phụ lục hợp đồng
		$strReturn=str_replace("@@040",$vListContractLabor,$strReturn);
		//Người đại diện ký
		$strReturn=str_replace("@@032",unicode_to_upper($mohr_lv0020_NSD->lv002),$strReturn);
		//Chức vụ ký
		$strReturn=str_replace("@@033",$mohr_lv0020_NSD->lv005,$strReturn);
		///********************Hop dong + thay doi chuc danh***********************///
		$strReturn=str_replace("@@050",$vHDLD,$strReturn);
		$strReturn=str_replace("@@051",$vPhuLucHDLD,$strReturn);
		
		//Nếu Cả hai thì giải quyết sau?
		if($visPLHD==0)
		{
			$strReturn=str_replace("@@052","HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@054","Khoản 3 Điều 1 và Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@055","Khoản 4 và khoản 5 Điều 1, Mục 2 và Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@056","Khoản 1 và Khoản 2 Điều 1 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@057","Khoản 4, Khoản 5 Điều 1 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@058","Mục 2 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@059","Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@060","Khoản 3 Điều 1 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@061","Khoản 4, Khoản 5 Điều 1 và Mục 2 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@062","Khoản 4 và khoản 5 Điều 1, Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@063","Khoản 3, Khoản 4, Khoản 5 Điều 1 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@064","Mục 2 và Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@065","Khoản 3 Điều 1 và Mục 2 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@066","Khoản 3, Khoản 4 và khoản 5 Điều 1, Mục 2 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@067","Khoản 3 Điều 1, Mục 2 và Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
			$strReturn=str_replace("@@068","Khoản 3, Khoản 4 và khoản 5 Điều 1, Mục 2 và Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD,$strReturn);
		}
		elseif($visPLHD==1)
		{
			$strReturn=str_replace("@@052","PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@054","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@055","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@056","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@057","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@058","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@059","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@060","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@061","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@062","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@063","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@064","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@065","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@066","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@067","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@068","Phụ lục hợp đồng lao động số: ".$vPhuLucHDLD,$strReturn);
		}
		else
		{
			$strReturn=str_replace("@@052","HĐLĐ số: ".$vHDLD.", "."PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@054","Khoản 3 Điều 1 và Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@055","Khoản 4 và khoản 5 Điều 1, Mục 2 và Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@056","Khoản 1 và Khoản 2 Điều 1 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@057","Khoản 4, Khoản 5 Điều 1 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@058","Mục 2 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@059","Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@060","Khoản 3 Điều 1 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@061","Khoản 4, Khoản 5 Điều 1 và Mục 2 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@062","Khoản 4 và khoản 5 Điều 1, Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@063","Khoản 3, Khoản 4, Khoản 5 Điều 1 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@064","Mục 2 và Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@065","Khoản 3 Điều 1 và Mục 2 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@066","Khoản 3, Khoản 4 và khoản 5 Điều 1, Mục 2 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@067","Khoản 3 Điều 1, Mục 2 và Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
			$strReturn=str_replace("@@068","Khoản 3, Khoản 4 và khoản 5 Điều 1, Mục 2 và Mục 3 Khoản 1 Điều 3 của HĐLĐ số: ".$vHDLD.", PLHĐLĐ số: ".$vPhuLucHDLD,$strReturn);
		}
		
		//Anh/Chị
		$strReturn=str_replace("@@086",$vLangArrAC[(int)$mohr_lv0020_NSD->lv018],$strReturn);
		//Ông/Bà
		$strReturn=str_replace("@@087",$vLangArrOB[(int)$mohr_lv0020_NSD->lv018],$strReturn);
		//Ông/Bà
		$strReturn=str_replace("@@088",$vLangArrMS[(int)$mohr_lv0020_NSD->lv018],$strReturn);
		//Ngày sinh 
		$strReturn=str_replace("@@089",getday($mohr_lv0020->lv015),$strReturn);
		//Tháng sinh 
		$strReturn=str_replace("@@090",getmonth($mohr_lv0020->lv015),$strReturn);
		//Năm sinh 
		$strReturn=str_replace("@@091",getyear($mohr_lv0020->lv015),$strReturn);
		//Nam/Nữ
		$strReturn=str_replace("@@095",$vArrGenDer[(int)$mohr_lv0020->lv018],$strReturn);
		//Anh/Chị
		$strReturn=str_replace("@@096",$vLangArrAC[(int)$mohr_lv0020->lv018],$strReturn);
		//Ông/Bà
		$strReturn=str_replace("@@097",$vLangArrOB[(int)$mohr_lv0020->lv018],$strReturn);
		//Ông/Bà
		$strReturn=str_replace("@@098",$vLangArrMS[(int)$mohr_lv0020->lv018],$strReturn);

		//Bảng nhân sự
		$strReturn=str_replace("@#001",$mohr_lv0020->lv001,$strReturn);
		$strReturn=str_replace("@#002",unicode_to_upper($mohr_lv0020->lv002),$strReturn);
		$strReturn=str_replace("@#003",$mohr_lv0020->lv002,$strReturn);
		$strReturn=str_replace("@#004",$mohr_lv0020->lv004,$strReturn);
		$strReturn=str_replace("@#005",$mohr_lv0020->lv005,$strReturn);
		$strReturn=str_replace("@#006",$mohr_lv0020->lv006,$strReturn);
		$strReturn=str_replace("@#007",$mohr_lv0020->lv007,$strReturn);
		$strReturn=str_replace("@#008",$mohr_lv0020->getvaluelink('lv008',$mohr_lv0020->lv008),$strReturn);
		$strReturn=str_replace("@#009",$mohr_lv0020->lv009,$strReturn);
		$strReturn=str_replace("@#010",$mohr_lv0020->lv010,$strReturn);
		$strReturn=str_replace("@#011",$mohr_lv0020->FormatView($mohr_lv0020->lv011,2),$strReturn);
		$strReturn=str_replace("@#012",$mohr_lv0020->lv012,$strReturn);
		$strReturn=str_replace("@#013",$mohr_lv0020->lv013,$strReturn);
		$strReturn=str_replace("@#014",$mohr_lv0020->lv014,$strReturn);
		if($mohr_lv0020->lv069==1)
			$strReturn=str_replace("@#015",getyear($mohr_lv0020->lv015),$strReturn);
		else
			$strReturn=str_replace("@#015",$mohr_lv0020->FormatView($mohr_lv0020->lv015,2),$strReturn);
		$strReturn=str_replace("@#016",$mohr_lv0020->lv016,$strReturn);
		$strReturn=str_replace("@#017",$mohr_lv0020->getvaluelink('lv017',$mohr_lv0020->lv017),$strReturn);
		$strReturn=str_replace("@#018",$mohr_lv0020->lv018,$strReturn);
		$strReturn=str_replace("@#019",$mohr_lv0020->lv019,$strReturn);
		$strReturn=str_replace("@#020",$mohr_lv0020->lv020,$strReturn);
		$strReturn=str_replace("@#021",$mohr_lv0020->FormatView($mohr_lv0020->lv021,2),$strReturn);
		$strReturn=str_replace("@#022",$mohr_lv0020->getvaluelink('lv022',$mohr_lv0020->lv022),$strReturn);
		$strReturn=str_replace("@#023",$mohr_lv0020->getvaluelink('lv023',$mohr_lv0020->lv023),$strReturn);
		$strReturn=str_replace("@#024",$mohr_lv0020->getvaluelink('lv024',$mohr_lv0020->lv024),$strReturn);
		$strReturn=str_replace("@#025",$mohr_lv0020->getvaluelink('lv025',$mohr_lv0020->lv025),$strReturn);
		$strReturn=str_replace("@#026",$mohr_lv0020->lv026,$strReturn);
		$strReturn=str_replace("@#027",$mohr_lv0020->lv027,$strReturn);
		$strReturn=str_replace("@#028",$mohr_lv0020->getvaluelink('lv028',$mohr_lv0020->lv028),$strReturn);
		$strReturn=str_replace("@#029",$mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029),$strReturn);
		$strReturn=str_replace("@#030",$mohr_lv0020->FormatView($mohr_lv0020->lv030,2),$strReturn);
		$strReturn=str_replace("@#031",$mohr_lv0020->getvaluelink('lv031',$mohr_lv0020->lv031),$strReturn);
		$strReturn=str_replace("@#032",$mohr_lv0020->getvaluelink('lv032',$mohr_lv0020->lv032),$strReturn);
		$strReturn=str_replace("@#033",$mohr_lv0020->lv033,$strReturn);
		$strReturn=str_replace("@#034",$mohr_lv0020->lv034,$strReturn);
		$strReturn=str_replace("@#035",$mohr_lv0020->lv035,$strReturn);
		$strReturn=str_replace("@#036",$mohr_lv0020->lv036,$strReturn);
		$strReturn=str_replace("@#037",$mohr_lv0020->lv037,$strReturn);
		$strReturn=str_replace("@#038",$mohr_lv0020->lv038,$strReturn);
		$strReturn=str_replace("@#039",$mohr_lv0020->lv039,$strReturn);
		$strReturn=str_replace("@#040",$mohr_lv0020->lv040,$strReturn);
		$strReturn=str_replace("@#041",$mohr_lv0020->lv041,$strReturn);
		$strReturn=str_replace("@#042",$mohr_lv0020->lv042,$strReturn);
		$strReturn=str_replace("@#043",$mohr_lv0020->lv043,$strReturn);
		$strReturn=str_replace("@#044",$mohr_lv0020->FormatView($mohr_lv0020->lv044,2),$strReturn);
		$strReturn=str_replace("@#045",$mohr_lv0020->lv045,$strReturn);
		$strReturn=str_replace("@#046",$mohr_lv0020->lv046,$strReturn);
		$strReturn=str_replace("@#047",$mohr_lv0020->lv047,$strReturn);
		$strReturn=str_replace("@#048",$mohr_lv0020->lv048,$strReturn);
		$strReturn=str_replace("@#049",$mohr_lv0020->lv049,$strReturn);
		$strReturn=str_replace("@#050",$mohr_lv0020->lv050,$strReturn);
		$strReturn=str_replace("@#051",$mohr_lv0020->lv051,$strReturn);
		$strReturn=str_replace("@#052",$mohr_lv0020->lv052,$strReturn);
		$strReturn=str_replace("@#053",$mohr_lv0020->lv053,$strReturn);
		$strReturn=str_replace("@#054",$mohr_lv0020->lv054,$strReturn);
		$strReturn=str_replace("@#055",$mohr_lv0020->lv055,$strReturn);
		$strReturn=str_replace("@#056",$mohr_lv0020->lv056,$strReturn);
		$strReturn=str_replace("@#057",$mohr_lv0020->lv057,$strReturn);
		$strReturn=str_replace("@#058",$mohr_lv0020->lv058,$strReturn);
		$strReturn=str_replace("@#059",$mohr_lv0020->lv059,$strReturn);
		$strReturn=str_replace("@#060",$mohr_lv0020->lv060,$strReturn);
		$strReturn=str_replace("@#061",$mohr_lv0020->lv061,$strReturn);
		$strReturn=str_replace("@#062",$mohr_lv0020->lv062,$strReturn);
		$strReturn=str_replace("@#063",$mohr_lv0020->lv063,$strReturn);
		$strReturn=str_replace("@#064",$mohr_lv0020->getvaluelink('lv064',$mohr_lv0020->lv064),$strReturn);
		$strReturn=str_replace("@#065",$mohr_lv0020->lv065,$strReturn);
		$strReturn=str_replace("@#066",$mohr_lv0020->lv066,$strReturn);
		$strReturn=str_replace("@#067",$mohr_lv0020->lv067,$strReturn);
		$strReturn=str_replace("@#068",$mohr_lv0020->lv068,$strReturn);
		$strReturn=str_replace("@#069",$mohr_lv0020->lv069,$strReturn);
		$strReturn=str_replace("@#070",$mohr_lv0020->lv070,$strReturn);
		$strReturn=str_replace("@#071",$mohr_lv0020->lv071,$strReturn);
		$strReturn=str_replace("@#072",$mohr_lv0020->lv072,$strReturn);
		$strReturn=str_replace("@#073",$mohr_lv0020->lv073,$strReturn);
		$strReturn=str_replace("@#074",$mohr_lv0020->lv074,$strReturn);
		$strReturn=str_replace("@#075",$mohr_lv0020->lv075,$strReturn);
		$strReturn=str_replace("@#076",$mohr_lv0020->lv076,$strReturn);
		$strReturn=str_replace("@#077",$mohr_lv0020->lv077,$strReturn);
		$strReturn=str_replace("@#078",$mohr_lv0020->lv078,$strReturn);
		$strReturn=str_replace("@#079",$mohr_lv0020->lv079,$strReturn);
		$strReturn=str_replace("@#080",$mohr_lv0020->lv080,$strReturn);
		$strReturn=str_replace("@#081",$mohr_lv0020->FormatView($mohr_lv0020->lv081,2),$strReturn);
		$strReturn=str_replace("@#082",$mohr_lv0020->FormatView($mohr_lv0020->lv082,2),$strReturn);
		$strReturn=str_replace("@#083",$mohr_lv0020->lv083,$strReturn);
		$strReturn=str_replace("@#084",$mohr_lv0020->lv084,$strReturn);
		$strReturn=str_replace("@#085",$mohr_lv0020->lv085,$strReturn);
		$strReturn=str_replace("@#086",$mohr_lv0020->lv086,$strReturn);
		$strReturn=str_replace("@#087",$mohr_lv0020->lv087,$strReturn);
		$strReturn=str_replace("@#088",$mohr_lv0020->lv088,$strReturn);
		$strReturn=str_replace("@#089",$mohr_lv0020->lv089,$strReturn);
		$strReturn=str_replace("@#090",$mohr_lv0020->lv090,$strReturn);
		$strReturn=str_replace("@#091",$mohr_lv0020->lv091,$strReturn);
		$strReturn=str_replace("@#092",$mohr_lv0020->lv092,$strReturn);
		$strReturn=str_replace("@#093",$mohr_lv0020->lv093,$strReturn);
		$strReturn=str_replace("@#094",$mohr_lv0020->lv094,$strReturn);
		$strReturn=str_replace("@#095",$mohr_lv0020->lv095,$strReturn);
		$strReturn=str_replace("@#096",$mohr_lv0020->lv096,$strReturn);
		$strReturn=str_replace("@#097",$mohr_lv0020->lv097,$strReturn);
		$strReturn=str_replace("@#098",$mohr_lv0020->lv098,$strReturn);
		$strReturn=str_replace("@#099",$mohr_lv0020->lv099,$strReturn);
		$strReturn=str_replace("@#100",$mohr_lv0020->lv100,$strReturn);
		$strReturn=str_replace("@#101",$mohr_lv0020->lv101,$strReturn);
		$strReturn=str_replace("@#102",$mohr_lv0020->lv102,$strReturn);
		$strReturn=str_replace("@#104",$mohr_lv0020->lv104,$strReturn);
		$strReturn=str_replace("@#105",$mohr_lv0020->lv105,$strReturn);
		$strReturn=str_replace("@#106",$mohr_lv0020->lv106,$strReturn);
		$strReturn=str_replace("@#298",$mohr_lv0020->getvaluelink('lv298',$mohr_lv0020->lv298),$strReturn);
		$strReturn=str_replace("@#299",$mohr_lv0020->getvaluelink('lv299',$mohr_lv0020->lv299),$strReturn);
		$strReturn=str_replace("@#300",$mohr_lv0020->getvaluelink('lv300',$mohr_lv0020->lv300),$strReturn);
		$strReturn=str_replace("@#301",$mohr_lv0020->getvaluelink('lv301',$mohr_lv0020->lv301),$strReturn);
		//Bảng nhân sự thông số mở rộng
		$strReturn=str_replace("@#921",$mohr_lv0020->GetMonthStartEnd($lvStartDate,$lvEndDate),$strReturn);
		//BL CB
		$strReturn=str_replace("@#958",$mohr_lv0020->lv050,$strReturn);
		if($plang=="VN")
		{
			$strReturn=str_replace("@#02",unicode_to_upper($mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002),$strReturn);
			$strReturn=str_replace("@#46",unicode_to_upper($mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002),$strReturn);
		}
		else
		{
			$strReturn=str_replace("@#02",unicode_to_upper($mohr_lv0020->lv002." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv004),$strReturn);
			$strReturn=str_replace("@#46",unicode_to_upper($mohr_lv0020->lv002." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv004),$strReturn);
		}
		$strReturn=str_replace("@#45",$vLangArrAC[(int)$mohr_lv0020->lv018],$strReturn);
		$strReturn=str_replace("@#65",$vArrGenDer[(int)$mohr_lv0020->lv018],$strReturn);
		$strReturn=str_replace("@#31",$mohr_lv0020->lv026,$strReturn);
		
		$strReturn=str_replace('@#60',$mohr_lv0020->LV_codeidfill($mohr_lv0020->lv013),$strReturn);
		$strReturn=str_replace("@#66",$mohr_lv0020->lv039,$strReturn);
		$strReturn=str_replace("@#67",$mohr_lv0020->lv013,$strReturn);
		$strReturn=str_replace("@#61",$mohr_lv0020->lv061,$strReturn);
		$strReturn=str_replace("@#62",$mohr_lv0020->lv027,$strReturn);
		
		//Ngày bắt đầu làm việc
		$strReturn=str_replace("@#71",$mohr_lv0020->FormatView($mohr_lv0020->lv030,2),$strReturn);
		//Từ ngày việc
		$strReturn=str_replace("@#70",$mohr_lv0020->FormatView($mohr_lv0020->lv044,2),$strReturn);
		//Chức vụ
		$strReturn=str_replace("@#72",$mohr_lv0020->lv005,$strReturn);
		//Tên hoa
		$strReturn=str_replace("@#73",$mohr_lv0020->lv006,$strReturn);
		//Nhó,
		$strReturn=str_replace("@#74",$mohr_lv0020->lv062,$strReturn);
		//Cong viec phai lam
		$strReturn=str_replace("@#75",$mohr_lv0020->lv066,$strReturn);
		$vLen=$_GET['txtLen'];
		if($vLen==0) $vLen=3;
		//Order
		$strReturn=str_replace("!#01",Fillnum($vOrder,$vLen),$strReturn);
		
		//Bang hop dong
		$ContractLaborID=$mohr_lv0038->lv001;
		$lvStartDate=$mohr_lv0038->lv004;
		$lvEndDate=$mohr_lv0038->lv005;
		
		
		$mohr_lv0018->LV_LoadID('VND');
		$vUSD=$mohr_lv0018->lv003;
		//Cong viec phai lam
		$strReturn=str_replace("@#76",$vUSD,$strReturn);
		$strReturn=str_replace("@!001",$mohr_lv0038->lv001,$strReturn);
		$strReturn=str_replace("@!002",$mohr_lv0038->lv002,$strReturn);
		$strReturn=str_replace("@!003",$mohr_lv0038->getvaluelink('lv003',$mohr_lv0038->lv003),$strReturn);
		$strReturn=str_replace("@!004",$mohr_lv0020->FormatView($mohr_lv0038->lv004,2),$strReturn);
		$vYearGet=$_GET['year'];
		if($mohr_lv0038->lv003==3)
		{
			$vyear=getyear($mohr_lv0038->lv004);
			if($vyear==getyear($mohr_lv0038->DateCurrent))
				$vDateKYHD=str_replace($vyear,($vyear+1),$mohr_lv0038->lv004);
			else
				$vDateKYHD=str_replace($vyear,getyear($mohr_lv0038->DateCurrent),$mohr_lv0038->lv004);
		}
		else
		{
			$vDateKYHD=ADDDATE($mohr_lv0038->lv005,1);
		}
		$strReturn=str_replace("@!405",$mohr_lv0020->FormatView($vDateKYHD,2),$strReturn);
		$strReturn=str_replace("@!445",getmonth($vDateKYHD),$strReturn);
		$strReturn=str_replace("@!455",getyear($vDateKYHD),$strReturn);

		$strReturn=str_replace("@@902",getday($vDateKYHD),$strReturn);
		$strReturn=str_replace("@@903",getmonth($vDateKYHD),$strReturn);
		$strReturn=str_replace("@@904",getyear($vDateKYHD),$strReturn);
		$vNumDay=365;
		$vDateKYHDEnd=ADDDATE($vDateKYHD,$vNumDay);
		$strReturn=str_replace("@@905",getday($vDateKYHDEnd),$strReturn);
		$strReturn=str_replace("@@906",getmonth($vDateKYHDEnd),$strReturn);
		$strReturn=str_replace("@@907",getyear($vDateKYHDEnd),$strReturn);
		///*************************************LAY PHEP ************************/
		$vDateFrom=ADDDATE($vDateKYHD,-366);
		$vDateTo=ADDDATE($vDateKYHD,-1);
		$vYear=getyear($vDateFrom);
		//Phép năm  NX
		//echo $mohr_lv0020->lv001.",'PN',$vDateFrom,$vDateTo<br/>";
		$vPN=$mohr_lv0020->LV_GetPhepFromTo($mohr_lv0020->lv001,'PN',$vDateFrom,$vDateTo);
		$strReturn=str_replace("@@100",$mohr_lv0020->FormatView(round($vPN,2),20),$strReturn);
		$vKH=$mohr_lv0020->LV_GetPhepFromTo($mohr_lv0020->lv001,'KH',$vDateFrom,$vDateTo);
		$strReturn=str_replace("@@101",$mohr_lv0020->FormatView(round($vKH,2),20),$strReturn);
		$vTNLĐ=$mohr_lv0020->LV_GetPhepFromTo($mohr_lv0020->lv001,'TNLĐ',$vDateFrom,$vDateTo);
		$strReturn=str_replace("@@102",$mohr_lv0020->FormatView(round($vTNLĐ,2),20),$strReturn);
		$vPT=$mohr_lv0020->LV_GetPhepFromTo($mohr_lv0020->lv001,'PT',$vDateFrom,$vDateTo);
		$strReturn=str_replace("@@103",$mohr_lv0020->FormatView(round($vPT,2),20),$strReturn);
		$vTS=$mohr_lv0020->LV_GetPhepFromTo($mohr_lv0020->lv001,'TS',$vDateFrom,$vDateTo);
		$strReturn=str_replace("@@104",$mohr_lv0020->FormatView(round($vTS,2),20),$strReturn);
		$vVR=$mohr_lv0020->LV_GetPhepFromTo($mohr_lv0020->lv001,'VR',$vDateFrom,$vDateTo);
		$strReturn=str_replace("@@105",$mohr_lv0020->FormatView(round($vVR,2),20),$strReturn);
		$vPB=$mohr_lv0020->LV_GetPhepFromTo($mohr_lv0020->lv001,'NB',$vDateFrom,$vDateTo);
		$strReturn=str_replace("@@106",$mohr_lv0020->FormatView(round($vPB,2),20),$strReturn);
		$vKP=$mohr_lv0020->LV_GetPhepFromTo($mohr_lv0020->lv001,'KP',$vDateFrom,$vDateTo);
		$strReturn=str_replace("@@107",$mohr_lv0020->FormatView(round($vKP,2),20),$strReturn);
		///*************************************END LAY PHEP ************************/

		$strReturn=str_replace("@!005",$mohr_lv0020->FormatView($mohr_lv0038->lv005,2),$strReturn);
		$strReturn=str_replace("@!006",$mohr_lv0038->lv006,$strReturn);
		$strReturn=str_replace("@!007",$mohr_lv0038->lv007,$strReturn);
		$strReturn=str_replace("@!008",$mohr_lv0038->lv008,$strReturn);
		$strReturn=str_replace("@!009",$mohr_lv0020->getvaluelink('lv010',$mohr_lv0038->lv009),$strReturn);
		$strReturn=str_replace("@!010",$mohr_lv0038->getvaluelink('lv910',$mohr_lv0038->lv010),$strReturn);
		$strReturn=str_replace("@!310",$mohr_lv0020->getvaluelink('lv029',$mohr_lv0038->lv010),$strReturn);
		$strReturn=str_replace("@!011",$mohr_lv0020->FormatView($mohr_lv0038->lv011,2),$strReturn);
		$vLoaiLuong='';
		switch($mohr_lv0038->lv012)
		{
			case 1:
			case 8:
			case 9:
				$vLoaiLuong='thời gian và được tính theo quy chế Công ty';
				break;
			default:
				$vLoaiLuong='sản phẩm dựa trên đơn giá niêm yết của Công ty tại từng thời điểm';
				break;
		}
		$strReturn=str_replace("@!012",$vLoaiLuong,$strReturn);
		$strReturn=str_replace("@!013",$mohr_lv0020->FormatView($mohr_lv0038->lv013,20),$strReturn);
		$strReturn=str_replace("@!014",$mohr_lv0020->FormatView($mohr_lv0038->lv014,20),$strReturn);
		$strReturn=str_replace("@!015",$mohr_lv0038->lv015,$strReturn);
		$strReturn=str_replace("@!016",$mohr_lv0020->FormatView($mohr_lv0038->lv016,20),$strReturn);
		$strReturn=str_replace("@!017",$mohr_lv0038->lv017,$strReturn);
		$strReturn=str_replace("@!018",$mohr_lv0020->FormatView($mohr_lv0038->lv018,20),$strReturn);
		$strReturn=str_replace("@!019",$mohr_lv0038->lv019,$strReturn);
		$strReturn=str_replace("@!020",$mohr_lv0020->FormatView($mohr_lv0038->lv020,20),$strReturn);
		$strReturn=str_replace("@!021",$mohr_lv0020->FormatView($mohr_lv0038->lv021,20),$strReturn);
		$strReturn=str_replace("@!022",$mohr_lv0020->FormatView($mohr_lv0038->lv022,20),$strReturn);
		$strReturn=str_replace("@!023",$mohr_lv0020->FormatView($mohr_lv0038->lv023,20),$strReturn);
		$strReturn=str_replace("@!024",$mohr_lv0038->lv024,$strReturn);
		$strReturn=str_replace("@!025",$mohr_lv0020->FormatView($mohr_lv0038->lv025,20),$strReturn);
		$strReturn=str_replace("@!026",$mohr_lv0020->FormatView($mohr_lv0038->lv026,20),$strReturn);
		$strReturn=str_replace("@!028",$mohr_lv0038->lv028,$strReturn);
		$strReturn=str_replace("@!029",$mohr_lv0038->getvaluelink('lv029',$mohr_lv0038->lv029),$strReturn);
		$strReturn=str_replace("@!030",$mohr_lv0038->lv030,$strReturn);
		$strReturn=str_replace("@!031",$mohr_lv0020->FormatView($mohr_lv0038->lv031,20),$strReturn);
		$strReturn=str_replace("@!032",$mohr_lv0020->FormatView($mohr_lv0038->lv032,20),$strReturn);
		$strReturn=str_replace("@!033",$mohr_lv0020->FormatView($mohr_lv0038->lv033,20),$strReturn);
		$strReturn=str_replace("@!034",$mohr_lv0020->FormatView($mohr_lv0038->lv034,20),$strReturn);
		$strReturn=str_replace("@!035",$mohr_lv0020->FormatView($mohr_lv0038->lv035,20),$strReturn);
		$strReturn=str_replace("@!036",$mohr_lv0020->FormatView($mohr_lv0038->lv036,20),$strReturn);
		$strReturn=str_replace("@!037",$mohr_lv0020->FormatView($mohr_lv0038->lv037,20),$strReturn);
		$strReturn=str_replace("@!098",$mohr_lv0020->FormatView($mohr_lv0038->lv098,2),$strReturn);
		$strReturn=str_replace("@!225",$mohr_lv0020->FormatView($mohr_lv0038->lv025+$mohr_lv0038->lv023,20),$strReturn);

		$strReturn=str_replace("@!335",$mohr_lv0020->FormatView($mohr_lv0038->lv033+$mohr_lv0038->lv035,20),$strReturn);
		$strReturn=str_replace("@!313",$mohr_lv0020->FormatView($mohr_lv0038->lv013+$mohr_lv0038->lv036,20),$strReturn);
		//Giáng chức
		$strReturn=str_replace("@!905",(!(strpos(','.$mohr_lv0038->lv097.",",",5,")===false))?'x':'',$strReturn);
		//Điều chức
		$strReturn=str_replace("@!906",(!(strpos(','.$mohr_lv0038->lv097.",",",6,")===false))?'x':'',$strReturn);
		//Điều chức
		$strReturn=str_replace("@!907",(!(strpos(','.$mohr_lv0038->lv097.",",",7,")===false))?'x':'',$strReturn);
		//Miễn chức
		$strReturn=str_replace("@!908",(!(strpos(','.$mohr_lv0038->lv097.",",",8,")===false))?'x':'',$strReturn);
		//Phục chức
		$strReturn=str_replace("@!909",(!(strpos(','.$mohr_lv0038->lv097.",",",9,")===false))?'x':'',$strReturn);
		//Điều lương
		$strReturn=str_replace("@!910",(!(strpos(','.$mohr_lv0038->lv097.",",",10,")===false))?'x':'',$strReturn);
		//Lưu chức ngừng lương
		$strReturn=str_replace("@!911",(!(strpos(','.$mohr_lv0038->lv097.",",",11,")===false))?'x':'',$strReturn);
		//Bồi thường
		$strReturn=str_replace("@!912",(!(strpos(','.$mohr_lv0038->lv097.",",",12,")===false))?'x':'',$strReturn);

		
		$strReturn=str_replace("@!099",$mohr_lv0038->lv099,$strReturn);
		$strReturn=str_replace("@!100",$mohr_lv0038->lv100,$strReturn);
		$strReturn=str_replace("@!101",$mohr_lv0038->lv101,$strReturn);
		$strReturn=str_replace("@!102",$mohr_lv0038->lv298,$strReturn);
		$strReturn=str_replace("@!103",$mohr_lv0038->lv299,$strReturn);
		$strReturn=str_replace("@!104",$mohr_lv0038->lv300,$strReturn);
		$strReturn=str_replace("@!125",$mohr_lv0020->FormatView($mohr_lv0038->lv025+$mohr_lv0038->lv023,20),$strReturn);
		$vTongCongLuong=$mohr_lv0038->lv034+$mohr_lv0038->lv023+$mohr_lv0038->lv025+$mohr_lv0038->lv020+$mohr_lv0038->lv016+$mohr_lv0038->lv022+$mohr_lv0038->lv026+$mohr_lv0038->lv032+$mohr_lv0038->lv033+$mohr_lv0038->lv013+$mohr_lv0038->lv018+$mohr_lv0038->lv031+$mohr_lv0038->lv035+$mohr_lv0038->lv036;
		$strReturn=str_replace("@!199",$mohr_lv0020->FormatView($vTongCongLuong,20),$strReturn);
		$lvStartDateCal=ADDDATE($vohr_lv0038->lv004,31);
		$mohr_lv0020->LV_LoadFullIDCal($vohr_lv0038->lv002,$lvStartDateCal);
		//Lương ký HĐ @@021
		$vSalaryInsurance=$mohr_lv0038->FormatView($mohr_lv0038->lv022,20);

		//	Lương công ty cấp bậc hợp đồng trước
		$RowLuongCapBac=$mohr_lv0020->LV_GetBacLuongCongTy($vohr_lv0038->lv300);
		$strReturn=str_replace("@@028",$mohr_lv0001->FormatView($RowLuongCapBac['lv010'],20),$strReturn);
		$strReturn=str_replace("@@022",$vohr_lv0038->FormatView($vSalaryInsurance,20),$strReturn);

		//Tiền ký hợp đồng
		//@@301
		$vLuongKyHopDong=$mohr_lv0020->LV_AutuFillDateExpireLBH($mohr_lv0020->lv301);
		$strReturn=str_replace("@@301",$vohr_lv0038->FormatView($vLuongKyHopDong,20),$strReturn);
		//Tiền ký hợp đồng Ưu tiên LCB
		//@@302
		if($mohr_lv0038->lv011>0)
			$strReturn=str_replace("@@302",$vohr_lv0038->FormatView($mohr_lv0038->lv011,20),$strReturn);
		else
			$strReturn=str_replace("@@302",$vohr_lv0038->FormatView($vLuongKyHopDong,20),$strReturn);		
		$vLuongKyHopDongTV=$mohr_lv0020->LV_AutuFillDateExpireLBHThuViec($mohr_lv0020->lv301);
		$strReturn=str_replace("@@303",$vohr_lv0038->FormatView($vLuongKyHopDongTV,20),$strReturn);
		if($mohr_lv0038->lv011>0)
			$strReturn=str_replace("@@304",$vohr_lv0038->FormatView($mohr_lv0038->lv011,20),$strReturn);
		else
			$strReturn=str_replace("@@304",$vohr_lv0038->FormatView($vLuongKyHopDongTV,20),$strReturn);

		$strReturn=str_replace("@*001",$vohr_lv0038->lv001,$strReturn);
		$strReturn=str_replace("@*002",$vohr_lv0038->lv002,$strReturn);
		$strReturn=str_replace("@*003",$vohr_lv0038->lv003,$strReturn);
		$strReturn=str_replace("@*005",$mohr_lv0020->FormatView($vohr_lv0038->lv005,2),$strReturn);
		$strReturn=str_replace("@*007",$vohr_lv0038->lv007,$strReturn);
		$strReturn=str_replace("@*008",$vohr_lv0038->lv008,$strReturn);
		$strReturn=str_replace("@*009",$mohr_lv0020->getvaluelink('lv010',$vohr_lv0038->lv009),$strReturn);
		$strReturn=str_replace("@*011",$mohr_lv0020->FormatView($vohr_lv0038->lv011,2),$strReturn);
		$vLoaiLuong='';
		switch($vohr_lv0038->lv012)
		{
			case 1:
			case 8:
			case 9:
				$vLoaiLuong='thời gian và được tính theo quy chế Công ty';
				break;
			default:
				$vLoaiLuong='sản phẩm dựa trên đơn giá niêm yết của Công ty tại từng thời điểm';
				break;
		}
		$strReturn=str_replace("@*012",$vLoaiLuong,$strReturn);
		$strReturn=str_replace("@*013",$mohr_lv0001->FormatView($vohr_lv0038->lv013,20),$strReturn);
		$strReturn=str_replace("@*014",$vohr_lv0038->lv014,$strReturn);
		$strReturn=str_replace("@*015",$vohr_lv0038->lv015,$strReturn);
		$strReturn=str_replace("@*016",$mohr_lv0001->FormatView($vohr_lv0038->lv016,20),$strReturn);
		$strReturn=str_replace("@*017",$vohr_lv0038->lv017,$strReturn);
		$strReturn=str_replace("@*018",$mohr_lv0001->FormatView($vohr_lv0038->lv018,20),$strReturn);
		$strReturn=str_replace("@*019",$vohr_lv0038->lv019,$strReturn);
		$strReturn=str_replace("@*020",$mohr_lv0001->FormatView($vohr_lv0038->lv020,20),$strReturn);
		$strReturn=str_replace("@*021",$mohr_lv0001->FormatView($vohr_lv0038->lv021,20),$strReturn);
		$strReturn=str_replace("@*022",$mohr_lv0001->FormatView($vohr_lv0038->lv022,20),$strReturn);
		$strReturn=str_replace("@*023",$mohr_lv0001->FormatView($vohr_lv0038->lv023,20),$strReturn);
		$strReturn=str_replace("@*024",$vohr_lv0038->lv024,$strReturn);
		$strReturn=str_replace("@*025",$mohr_lv0001->FormatView($vohr_lv0038->lv025,20),$strReturn);
		$strReturn=str_replace("@*026",$mohr_lv0001->FormatView($vohr_lv0038->lv026,20),$strReturn);
		$strReturn=str_replace("@*027",$vohr_lv0038->lv027,$strReturn);
		$strReturn=str_replace("@*031",$mohr_lv0001->FormatView($vohr_lv0038->lv031,20),$strReturn);
		$strReturn=str_replace("@*032",$mohr_lv0001->FormatView($vohr_lv0038->lv032,20),$strReturn);
		$strReturn=str_replace("@*033",$mohr_lv0001->FormatView($vohr_lv0038->lv033,20),$strReturn);
		$strReturn=str_replace("@*034",$mohr_lv0001->FormatView($vohr_lv0038->lv034,20),$strReturn);
		$strReturn=str_replace("@*035",$mohr_lv0001->FormatView($vohr_lv0038->lv035,20),$strReturn);
		$strReturn=str_replace("@*036",$mohr_lv0001->FormatView($vohr_lv0038->lv036,20),$strReturn);
		$strReturn=str_replace("@*037",$vohr_lv0038->lv037,$strReturn);
		$strReturn=str_replace("@*098",$mohr_lv0020->FormatView($vohr_lv0038->lv098,2),$strReturn);

		$strReturn=str_replace("@*225",$mohr_lv0001->FormatView($vohr_lv0038->lv025+$vohr_lv0038->lv023,20),$strReturn);
		$strReturn=str_replace("@*335",$mohr_lv0020->FormatView($vohr_lv0038->lv033+$vohr_lv0038->lv035,20),$strReturn);
		$strReturn=str_replace("@*313",$mohr_lv0020->FormatView($vohr_lv0038->lv013+$vohr_lv0038->lv036,20),$strReturn);
		//Lên chức
		$strReturn=str_replace("@*905",(!(strpos(','.$vohr_lv0038->lv097.",",",5,")===false))?'x':'',$strReturn);
		//Giáng chức
		$strReturn=str_replace("@*906",(!(strpos(','.$vohr_lv0038->lv097.",",",6,")===false))?'x':'',$strReturn);
		//Điều chức
		$strReturn=str_replace("@*907",(!(strpos(','.$vohr_lv0038->lv097.",",",7,")===false))?'x':'',$strReturn);
		//Miễn chức
		$strReturn=str_replace("@*908",(!(strpos(','.$vohr_lv0038->lv097.",",",8,")===false))?'x':'',$strReturn);
		//Phục chức
		$strReturn=str_replace("@*909",(!(strpos(','.$vohr_lv0038->lv097.",",",9,")===false))?'x':'',$strReturn);
		//Điều lương
		$strReturn=str_replace("@*910",(!(strpos(','.$vohr_lv0038->lv097.",",",10,")===false))?'x':'',$strReturn);
		//Lưu chức ngừng lương
		$strReturn=str_replace("@*911",(!(strpos(','.$vohr_lv0038->lv097.",",",11,")===false))?'x':'',$strReturn);
		//Bồi thường
		$strReturn=str_replace("@*912",(!(strpos(','.$vohr_lv0038->lv097.",",",12,")===false))?'x':'',$strReturn);

		$strReturn=str_replace("@*099",$vohr_lv0038->lv099,$strReturn);
		$strReturn=str_replace("@*100",$vohr_lv0038->lv100,$strReturn);
		$strReturn=str_replace("@*101",$vohr_lv0038->lv101,$strReturn);
		$strReturn=str_replace("@*102",$vohr_lv0038->lv298,$strReturn);
		$strReturn=str_replace("@*103",$vohr_lv0038->lv299,$strReturn);
		$strReturn=str_replace("@*104",$vohr_lv0038->lv300,$strReturn);
		$vTongCongLuong=$vohr_lv0038->lv034+$vohr_lv0038->lv023+$vohr_lv0038->lv025+$vohr_lv0038->lv020+$vohr_lv0038->lv016+$vohr_lv0038->lv022+$vohr_lv0038->lv026+$vohr_lv0038->lv032+$vohr_lv0038->lv033+$vohr_lv0038->lv013+$vohr_lv0038->lv018+$vohr_lv0038->lv031+$vohr_lv0038->lv035+$vohr_lv0038->lv036;
		$strReturn=str_replace("@*199",$mohr_lv0020->FormatView($vTongCongLuong,20),$strReturn);

		$vNumDays=round(DATEDIFF($lvEndDate,$lvStartDate)/360,0);
		switch($vNumDays)
		{
			case 0:
				$strReturn=str_replace("@!21",'<input type="checkbox" style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				$strReturn=str_replace("@!22",'<input type="checkbox" style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				$strReturn=str_replace("@!23",'<input type="checkbox" style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				break;
			case 1:
				$strReturn=str_replace("@!21",'<input type="checkbox"  checked="true" style="width:20px;height:15px;border:1px #fff solid;">',$strReturn);
				$strReturn=str_replace("@!22",'<input type="checkbox" style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				$strReturn=str_replace("@!23",'<input type="checkbox" style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				break;
			case 2:
				$strReturn=str_replace("@!21",'<input type="checkbox"   style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				$strReturn=str_replace("@!22",'<input type="checkbox" checked="true" style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				$strReturn=str_replace("@!23",'<input type="checkbox" style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				break;
			default:
				$strReturn=str_replace("@!21",'<input type="checkbox"   style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				$strReturn=str_replace("@!22",'<input type="checkbox"  style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				$strReturn=str_replace("@!23",'<input type="checkbox" checked="true" style="width:20px;height:15px;border:0px #fff solid;">',$strReturn);
				break;
		}
		
		echo  $strReturn;
		$vOrder++;
}
if ($sExport == "excel" || $sExport == "word") {
	//echo '<br/>&nbsp;';
}
}		
if($_GET['txtsave']==1)
{
	$vohr_lv0038->LV_UpdateMau( $_GET['ID'],$strReturn);
}
?>
</center>
</body>
</html>
<?php
}
?>