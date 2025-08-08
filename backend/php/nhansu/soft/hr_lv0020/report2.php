<?php
session_start();
$vDir='../';
include($vDir."paras.php");
include($vDir."config.php");
include($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/hr_lv0038.php");
require_once("$vDir../clsall/hr_lv0020.php");
require_once("$vDir../clsall/hr_lv0043.php");
require_once("$vDir../clsall/hr_lv0042.php");
require_once("$vDir../clsall/jo_lv0016.php");
$mohr_lv0042=new hr_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0042');

/////////////init object//////////////
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
$vohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
$mohr_lv0043=new hr_lv0043($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0043');
$mojo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0016');
$mohr_lv0038->Dir=$vDir;

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","HR0123.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
</head>
<script language="javascript">
function ShowContract()
{
	document.getElementById('idhdsl').style.display='block';
}

</script>
<body  onkeyup="KeyPublicRun(event)" ondblclick="ShowContract()">
<div id="idhdsl" style="display:none;clear:both;">
<center>
<form name="frmpost" action="#">
	<input type="hidden" name="func" value="rpt1" />
	<input type="hidden" name="ID" id="ID" value="<?php echo  $_GET['ID'];?>"/>
	<div style="clear:both;font:bold 14px arial;width:600px;color:blue" >
		<div style="float:left"><?php echo $vLangArr[69];?></div>
		<div style="float:left">
		<select style=";color:blue" onchange="document.frmpost.submit()"  name="ContractID"  id="ContractID"  tabindex="6" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"  onKeyPress="return CheckKey(event,7)" onblur="LoadSource(this.value)"/>
										<option value=""></option><?php echo $mohr_lv0038->LV_LinkField('lv020',$_GET['ContractID']);?>
									</select>		
		</div>
		<div style="float:left"><input style=";color:blue" type="button" onclick="document.getElementById('idhdsl').style.display='none'" value="<?php echo $vLangArr[70];?>"/></div>
	</div>
</form>
<center>
<br clear="both"/>
</div>
<center>
<?php
$mojo_lv0016->LV_Load();
$mohr_lv0020->LV_LoadID($vlv001);
$mohr_lv0038->LV_LoadActive($mohr_lv0020->lv001);
if($_GET['ContractID']!="")
	$mohr_lv0043->LV_LoadID($_GET['ContractID']);	
else
	$mohr_lv0043->LV_LoadID($mojo_lv0016->lv016);
	$strReturn=$mohr_lv0043->lv003;
	$lvStartDate=$mohr_lv0038->lv004;
	$lvEndDate=$mohr_lv0038->lv005;
		$vArrGenDer=Array(0=>'Nữ',1=>'Nam');
		$vLangArrAC=Array(0=>'Chị',1=>'Anh');
		//Bảng nhân sự
		$strReturn=str_replace("@#01",$mohr_lv0020->lv001,$strReturn);
		$strReturn=str_replace("@*02",$mohr_lv0020->lv099,$strReturn);
		$strReturn=str_replace("@#03",$mohr_lv0020->getvaluelink('lv022',$mohr_lv0020->lv022),$strReturn);
		$strReturn=str_replace("@#11",$mohr_lv0020->FormatView($mohr_lv0020->lv015,2),$strReturn);
		$strReturn=str_replace("@#12",$mohr_lv0020->lv016,$strReturn);
		$strReturn=str_replace("@#13",$mohr_lv0020->lv034,$strReturn);
		$strReturn=str_replace("@#69",(trim($mohr_lv0020->lv035)=='')?$mohr_lv0020->lv034:$mohr_lv0020->lv035,$strReturn);
		$strReturn=str_replace("@#14",$mohr_lv0020->getvaluelink('lv032',$mohr_lv0020->lv032),$strReturn);
		$strReturn=str_replace("@#15",$mohr_lv0020->lv010,$strReturn);
		$strReturn=str_replace("@#16",$mohr_lv0020->FormatView($mohr_lv0020->lv011,2),$strReturn);
		$strReturn=str_replace("@#17",$mohr_lv0020->lv012,$strReturn);
		$strReturn=str_replace("@#15",$mohr_lv0020->lv010,$strReturn);
		$strReturn=str_replace("@#16",$mohr_lv0020->FormatView($mohr_lv0020->lv011,2),$strReturn);
		$strReturn=str_replace("@#17",$mohr_lv0020->lv012,$strReturn);
		$strReturn=str_replace("@#18",$mohr_lv0020->lv020,$strReturn);
		$strReturn=str_replace("@#19",$mohr_lv0020->FormatView($mohr_lv0020->lv021,2),$strReturn);
		$strReturn=str_replace("@#20",$mohr_lv0020->lv043,$strReturn);
		$strReturn=str_replace("@#21",$mohr_lv0020->GetMonthStartEnd($lvStartDate,$lvEndDate),$strReturn);
		//Ma so bao hiem
		$strReturn=str_replace("@#67",$mohr_lv0020->lv013,$strReturn);
		$strReturn=str_replace("@#68",$mohr_lv0020->FormatView($mohr_lv0020->lv013,2),$strReturn);
		$strReturn=str_replace("@#29",$mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029),$strReturn);
		//Ma so thue
		$strReturn=str_replace("@#53",$mohr_lv0020->lv008,$strReturn);		
		//Nguyen quan
		$strReturn=str_replace("@#54",$mohr_lv0020->lv045,$strReturn);		
		//Trinh do
		$strReturn=str_replace("@#55",$mohr_lv0020->getvaluelink('lv028',$mohr_lv0020->lv028),$strReturn);
		//Chuyên môn
		$strReturn=str_replace("@#56",$mohr_lv0020->getvaluelink('lv042',$mohr_lv0020->lv042),$strReturn);	
		//Bật
		$strReturn=str_replace("@#57",$mohr_lv0020->getvaluelink('lv048',$mohr_lv0020->lv001),$strReturn);
		//BL CB
		$strReturn=str_replace("@#58",$mohr_lv0020->lv050,$strReturn);
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
		$strReturn=str_replace("@#61",$mohr_lv0020->lv061,$strReturn);
		$strReturn=str_replace("@!61",$mohr_lv0020->lv067,$strReturn);
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
		
		//Bang hop dong
		$ContractLaborID=$mohr_lv0038->lv001;
		$lvStartDate=$mohr_lv0038->lv004;
		
		$lvEndDate=$mohr_lv0038->lv005;
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
		$strReturn=str_replace("@*01",$ContractLaborID,$strReturn);
		$strReturn=str_replace("@#22",getday($lvStartDate),$strReturn);
		$strReturn=str_replace("@#23",getmonth($lvStartDate),$strReturn);
		$strReturn=str_replace("@#24",getyear($lvStartDate),$strReturn);
		$strReturn=str_replace("@#25",getday($lvEndDate),$strReturn);
		$strReturn=str_replace("@#26",getmonth($lvEndDate),$strReturn);
		$strReturn=str_replace("@#27",getyear($lvEndDate),$strReturn);

		
		$strReturn=str_replace("@#47",getday($lvStartDate),$strReturn);
		$strReturn=str_replace("@#48",getmonth($lvStartDate),$strReturn);
		$strReturn=str_replace("@#49",getyear($lvStartDate),$strReturn);
		$strReturn=str_replace("@#50",getday($lvStartDate),$strReturn);
		$strReturn=str_replace("@#51",getmonth($lvStartDate),$strReturn);
		$strReturn=str_replace("@#52",getyear($lvStartDate),$strReturn);

		$lvStartDateTV=$mohr_lv0038->lv098;
		$strReturn=str_replace("@!47",getday($lvStartDateTV),$strReturn);
		$strReturn=str_replace("@!48",getmonth($lvStartDateTV),$strReturn);
		$strReturn=str_replace("@!49",getyear($lvStartDateTV),$strReturn);
		$strReturn=str_replace("@?49",substr(getyear($lvStartDateTV),2,2),$strReturn);
		
		$strReturn=str_replace("@!01",$mohr_lv0020->FormatView($mohr_lv0038->lv022,10),$strReturn);
		$strReturn=str_replace("@!02",$mohr_lv0020->FormatView($mohr_lv0038->lv013,10),$strReturn);
		$strReturn=str_replace("@!03",$mohr_lv0020->FormatView($mohr_lv0038->lv014,10),$strReturn);
		$strReturn=str_replace("@!04",$mohr_lv0020->FormatView($mohr_lv0038->lv026,10),$strReturn);
		$strReturn=str_replace("@!05",$mohr_lv0020->FormatView($mohr_lv0038->lv016,10),$strReturn);
		$strReturn=str_replace("@!06",$mohr_lv0020->FormatView($mohr_lv0038->lv018,10),$strReturn);
		$strReturn=str_replace("@!07",$mohr_lv0020->FormatView($mohr_lv0038->lv020,10),$strReturn);
		$strReturn=str_replace("@!08",$mohr_lv0020->FormatView($mohr_lv0038->lv025,10),$strReturn);
		$strReturn=str_replace("@!09",$mohr_lv0020->FormatView($mohr_lv0038->lv023,10),$strReturn);
		$strReturn=str_replace("@!10",$mohr_lv0020->FormatView($mohr_lv0038->lv031,10),$strReturn);
		$strReturn=str_replace("@!11",$mohr_lv0020->FormatView($mohr_lv0038->lv032,10),$strReturn);
		$strReturn=str_replace("@?11",$mohr_lv0020->FormatView($mohr_lv0038->lv032-$mohr_lv0038->lv022,10),$strReturn);
		$strReturn=str_replace("@!12",$mohr_lv0020->FormatView($mohr_lv0038->lv033,10),$strReturn);
		$strReturn=str_replace("@!13",$mohr_lv0020->FormatView($mohr_lv0038->lv034,10),$strReturn);
		$strReturn=str_replace("@!77",$mohr_lv0020->FormatView(round(((float)$mohr_lv0038->lv023)*100/((float)$mohr_lv0038->lv032+(float)$mohr_lv0038->lv013),0),10),$strReturn);
		
		$vTongLuong=$mohr_lv0038->lv022+$mohr_lv0038->lv013+$mohr_lv0038->lv014+$mohr_lv0038->lv026+$mohr_lv0038->lv016+$mohr_lv0038->lv018+$mohr_lv0038->lv020+$mohr_lv0038->lv025+$mohr_lv0038->lv023+$mohr_lv0038->lv031+$mohr_lv0038->lv032+$mohr_lv0038->lv033+$mohr_lv0038->lv034;
		$strReturn=str_replace("@!14",$mohr_lv0020->FormatView($vTongLuong,10),$strReturn);
		///Hop dong khac
		$vLaborPrevious=$_GET['HDOTHER'];
		$vohr_lv0038->LV_LoadID($vLaborPrevious);
		$strReturn=str_replace("@|01",($vohr_lv0038->lv022==0)?'------------------':$mohr_lv0020->FormatView($vohr_lv0038->lv022,10),$strReturn);
		$strReturn=str_replace("@|02",($vohr_lv0038->lv013==0)?'------------------':$mohr_lv0020->FormatView($vohr_lv0038->lv013,10),$strReturn);
		$strReturn=str_replace("@|03",($vohr_lv0038->lv014==0)?'------------------':$mohr_lv0020->FormatView($vohr_lv0038->lv014,10),$strReturn);
		$strReturn=str_replace("@|04",($vohr_lv0038->lv026==0)?'--------------------':$mohr_lv0020->FormatView($vohr_lv0038->lv026,10),$strReturn);
		$strReturn=str_replace("@|05",($vohr_lv0038->lv016==0)?'------------------':$mohr_lv0020->FormatView($vohr_lv0038->lv016,10),$strReturn);
		$strReturn=str_replace("@|06",($vohr_lv0038->lv018==0)?'------------------':$mohr_lv0020->FormatView($vohr_lv0038->lv018,10),$strReturn);
		$strReturn=str_replace("@|07",($vohr_lv0038->lv020==0)?'------------------':$mohr_lv0020->FormatView($vohr_lv0038->lv020,10),$strReturn);
		$strReturn=str_replace("@|08",($vohr_lv0038->lv025==0)?'------------------':$mohr_lv0020->FormatView($vohr_lv0038->lv025,10),$strReturn);
		$strReturn=str_replace("@|09",($vohr_lv0038->lv023==0)?'-----------------':$mohr_lv0020->FormatView($vohr_lv0038->lv023,10),$strReturn);
		$strReturn=str_replace("@|10",($vohr_lv0038->lv031==0)?'------------------':$mohr_lv0020->FormatView($vohr_lv0038->lv031,10),$strReturn);
		$strReturn=str_replace("@|11",($vohr_lv0038->lv032==0)?'-----------------':$mohr_lv0020->FormatView($vohr_lv0038->lv032,10),$strReturn);
		$strReturn=str_replace("@|12",($vohr_lv0038->lv033==0)?'-----------------':$mohr_lv0020->FormatView($vohr_lv0038->lv033,10),$strReturn);
		$strReturn=str_replace("@|13",($vohr_lv0038->lv034==0)?'-----------------':$mohr_lv0020->FormatView($vohr_lv0038->lv034,10),$strReturn);
		$vTongLuong=$vohr_lv0038->lv022+$vohr_lv0038->lv013+$vohr_lv0038->lv014+$vohr_lv0038->lv026+$vohr_lv0038->lv016+$vohr_lv0038->lv018+$vohr_lv0038->lv020+$vohr_lv0038->lv025+$vohr_lv0038->lv023+$vohr_lv0038->lv031+$vohr_lv0038->lv032+$vohr_lv0038->lv033+$vohr_lv0038->lv034;
		$strReturn=str_replace("@|14",($vTongLuong==0)?'------------------':$mohr_lv0020->FormatView($vTongLuong,10),$strReturn);
		echo  $strReturn;
?>
</center>
</body>
</html>