<?php
session_start();
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/jo_lv0004_0.php");
require_once("../clsall/jo_lv0016.php");
require_once("../clsall/tc_lv0013.php");
require_once("../clsall/tc_lv0009.php");
require_once("../clsall/hr_lv0020.php");
require_once("../clsall/hr_lv0002.php");
require_once("../clsall/tc_lv0008.php");
require_once("../clsall/rp_lv0006.php");
/////////////init object//////////////
$mojo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$morp_lv0006=new rp_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$month=getmonth($motc_lv0008->DateCurrent);
$year=getyear($motc_lv0008->DateCurrent);
if($mojo_lv0004->GetView()==1)
{
	$vCodeList="'P','1/2P'";
	$vSoPhepDaDung=$motc_lv0008->get_count_codeidyear($motc_lv0008->LV_UserID,$year,$vCodeList);
?>
<?php
	if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0025.txt",$plang);
	
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
$morp_lv0006->ArrPush[104]='Phép còn lại '.($year-1);
$morp_lv0006->ArrPush[101]='Phép hưởng '.$year;
$morp_lv0006->ArrPush[46]='';
$morp_lv0006->ArrPush[47]='Số phép đã dùng';
$morp_lv0006->ArrPush[48]='Số phép còn lại';
$morp_lv0006->TCCodeID="'P','1/2P'";
$morp_lv0006->lv001=$morp_lv0006->LV_UserID;
$vdatefrom=$year.'-01-01';
$vdateto= $year.'-12-31';
$morp_lv0006->ReportYear=$year;


$vOrderList='1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23';
$vFieldList="lv001,lv030,lv029,lv002,lv100,lv103,lv201,lv202,lv203,lv204,lv205,lv206,lv207,lv208,lv209,lv210,lv211,lv212,lv101,lv102,lv213";
$txtlv221=1;
$morp_lv0006->TCCodeID="'KL','1/2KL'";
$morp_lv0006->KCodeID="KL";
$morp_lv0006->ArrPush[0]='BÁO CÁO PHÉP KL';
$txtlv221=2;
echo $morp_lv0006->LV_FN_Main($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$txtlv221);
}
?>	
						