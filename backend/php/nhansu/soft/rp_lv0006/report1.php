<?php
session_start();
$sExport=$_GET['childfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=employees.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=employees.doc');
}
if($sExport=="pdf"){
header('Content-Type: text/html; charset=utf-8');}

//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/rp_lv0006.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/rp_lv0006.php");
/////////////init object//////////////
$morp_lv0006=new rp_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0006');

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0025.txt",$plang);
$txtlv221=$_GET['txtlv221'];
if($txtlv221==2)
	$morp_lv0006->ArrPush[0]='BÁO CÁO PHÉP KL';
else
	$morp_lv0006->ArrPush[0]='BÁO CÁO PHÉP NĂM';
$morp_lv0006->ArrPush[1]=$vLangArr[18];
$morp_lv0006->ArrPush[2]=$vLangArr[19];
$morp_lv0006->ArrPush[3]=$vLangArr[20];
$morp_lv0006->ArrPush[4]=$vLangArr[21];
$morp_lv0006->ArrPush[5]=$vLangArr[22];
$morp_lv0006->ArrPush[6]=$vLangArr[23];
$morp_lv0006->ArrPush[7]=$vLangArr[24];
$morp_lv0006->ArrPush[8]=$vLangArr[25];
$morp_lv0006->ArrPush[9]=$vLangArr[26];
$morp_lv0006->ArrPush[10]=$vLangArr[27];
$morp_lv0006->ArrPush[11]=$vLangArr[28];
$morp_lv0006->ArrPush[12]=$vLangArr[29];
$morp_lv0006->ArrPush[13]=$vLangArr[30];
$morp_lv0006->ArrPush[14]=$vLangArr[31];
$morp_lv0006->ArrPush[15]=$vLangArr[32];
$morp_lv0006->ArrPush[16]=$vLangArr[33];
$morp_lv0006->ArrPush[17]=$vLangArr[34];
$morp_lv0006->ArrPush[18]=$vLangArr[35];
$morp_lv0006->ArrPush[19]=$vLangArr[36];
$morp_lv0006->ArrPush[20]=$vLangArr[37];
$morp_lv0006->ArrPush[21]=$vLangArr[38];
$morp_lv0006->ArrPush[22]=$vLangArr[39];
$morp_lv0006->ArrPush[23]=$vLangArr[40];
$morp_lv0006->ArrPush[24]=$vLangArr[41];
$morp_lv0006->ArrPush[25]=$vLangArr[42];
$morp_lv0006->ArrPush[26]=$vLangArr[43];
$morp_lv0006->ArrPush[27]=$vLangArr[44];
$morp_lv0006->ArrPush[28]=$vLangArr[45];
$morp_lv0006->ArrPush[29]=$vLangArr[46];
$morp_lv0006->ArrPush[30]=$vLangArr[47];
$morp_lv0006->ArrPush[31]=$vLangArr[48];
$morp_lv0006->ArrPush[32]=$vLangArr[49];
$morp_lv0006->ArrPush[33]=$vLangArr[50];
$morp_lv0006->ArrPush[34]=$vLangArr[51];
$morp_lv0006->ArrPush[35]=$vLangArr[52];
$morp_lv0006->ArrPush[36]=$vLangArr[53];
$morp_lv0006->ArrPush[37]=$vLangArr[54];
$morp_lv0006->ArrPush[38]=$vLangArr[55];
$morp_lv0006->ArrPush[39]=$vLangArr[56];
$morp_lv0006->ArrPush[40]=$vLangArr[57];
$morp_lv0006->ArrPush[41]=$vLangArr[58];
$morp_lv0006->ArrPush[42]=$vLangArr[59];
$morp_lv0006->ArrPush[43]=$vLangArr[60];
$morp_lv0006->ArrPush[44]=$vLangArr[61];
$morp_lv0006->ArrPush[45]=$vLangArr[62];
$morp_lv0006->ArrPush[98]='Tổng thêm giờ bù' ;
$morp_lv0006->ArrPush[99]='Tổng clear time';
$morp_lv0006->ArrPush[202]='T1';
$morp_lv0006->ArrPush[203]='T2';
$morp_lv0006->ArrPush[204]='T3';
$morp_lv0006->ArrPush[205]='T4';
$morp_lv0006->ArrPush[206]='T5';
$morp_lv0006->ArrPush[207]='T6';
$morp_lv0006->ArrPush[208]='T7';
$morp_lv0006->ArrPush[209]='T8';
$morp_lv0006->ArrPush[210]='T9';
$morp_lv0006->ArrPush[211]='T10';
$morp_lv0006->ArrPush[212]='T11';
$morp_lv0006->ArrPush[213]='T12';
$morp_lv0006->ArrPush[214]='Ký tên';
$morp_lv0006->ArrPush[309]='Tổng phép còn lại 2022 đã nghỉ';
$morp_lv0006->ArrPush[310]='Tổng phép 2023 không sử dụng hết';
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","RP0004.txt",$plang);
$morp_lv0006->ArrPush[46]=$vLangArr[14];
$morp_lv0006->ArrPush[47]=$vLangArr[15];
$morp_lv0006->ArrPush[48]=$vLangArr[16];
	//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
//$ma=$_GET['ma'];
$lvopt=$_GET['txtopt'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList='';
$vOrderList='';
if($txtlv221==2)
{
	$morp_lv0006->TCCodeID="'KL','1/2KL'";
	$morp_lv0006->KCodeID="KL";
}
else
{
	$morp_lv0006->TCCodeID="'P','1/2P'";
	$morp_lv0006->KCodeID="P";
}
$vStrMessage="";
if($_GET['txtlempid']!="" && $_GET['txtlempid']!=NULL)
{
	$morp_lv0006->lv001=$_GET['txtlempid'];
}
if($_GET['txtdepid']!="" && $_GET['txtdepid']!=NULL)
{
	$morp_lv0006->lv029=$_GET['txtdepid'];
}
if($_GET['txtstate']!="" && $_GET['txtstate']!=NULL)
{
	$morp_lv0006->lv009=$_GET['txtstate'];
}
$vdatefrom=recoverdate($_GET['txtdatefrom'],$plang);
$vdateto=recoverdate($_GET['txtdateto'],$plang);
$morp_lv0006->isStaffOff=$_GET['isStaffOff'];
$morp_lv0006->ReportYear=getyear($vdatefrom);
$morp_lv0006->ArrPush[104]='Tổng phép còn lại '.($morp_lv0006->ReportYear-1);
$morp_lv0006->ArrPush[101]='Phép hưởng '.$morp_lv0006->ReportYear;//.getmonth($vdateto)."/".$morp_lv0006->ReportYear;
$morp_lv0006->ArrPush[309]='Tổng phép còn lại '.($morp_lv0006->ReportYear-1).' đã nghỉ';
$morp_lv0006->ArrPush[310]='Tổng phép '.($morp_lv0006->ReportYear-1).' không sử dụng hết T3/'.$morp_lv0006->ReportYear;
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<center>
<?php
if($morp_lv0006->GetView()==1)
{
	
	
	echo "<div style='width:1024px'>";
	echo "<div align=\"center\" ondblclick=\"this.innerHTML=''\"><img  src=\"".$morp_lv0006->GetLogo()."\" style=\"max-width:1024px\" /></div>";
	echo "
		<div style='text-align:center'><h1>".$morp_lv0006->ArrPush[0]."</h1></div>
		<div style='text-align:center'><strong>Từ ngày ".$morp_lv0006->FormatView($vdatefrom,2)." đến ngày ".$morp_lv0006->FormatView($vdateto,2)."</strong></div>
		<div>&nbsp;</div>
		";
	echo $morp_lv0006->LV_FN_Main($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$txtlv221);
   echo "</div>";
                
?>	
</center>
		
<?php
} else {
	include("../permit.php");
}
?>
