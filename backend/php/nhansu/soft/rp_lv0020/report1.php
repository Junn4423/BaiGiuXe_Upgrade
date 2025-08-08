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

$morp_lv0006->ArrPush[0]=$vLangArr[17];
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
$morp_lv0020->ArrPush[46]=$vLangArr[71];
$morp_lv0020->ArrPush[47]=$vLangArr[72];
$morp_lv0020->ArrPush[48]=$vLangArr[73];
$morp_lv0020->ArrPush[49]=$vLangArr[74];
$morp_lv0020->ArrPush[50]=$vLangArr[75];
$morp_lv0020->ArrPush[51]=$vLangArr[76];
$morp_lv0020->ArrPush[52]=$vLangArr[78];
$morp_lv0020->ArrPush[53]=$vLangArr[79];
$morp_lv0020->ArrPush[61]=$vLangArr[80];
$morp_lv0020->ArrPush[62]=$vLangArr[81];
$morp_lv0020->ArrPush[63]=$vLangArr[82];
$morp_lv0020->ArrPush[64]=$vLangArr[83];
$morp_lv0020->ArrPush[65]=$vLangArr[84];
$morp_lv0020->ArrPush[66]=$vLangArr[85];
$morp_lv0020->ArrPush[67]=$vLangArr[86];
$morp_lv0020->ArrPush[100]='Code Machine';
$morp_lv0020->ArrPush[103]='AL vào làm';
$morp_lv0020->ArrPush[104]='AL/Năm';
$morp_lv0020->ArrPush[151]='Tiền SN';
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
$vFieldList=$_POST['txtFieldList'];
$vOrderList=$_POST['txtOrderList'];
$morp_lv0006->TCCodeID=$_GET['txtlv006'];
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
$vdatefrom=$_GET['txtdatefrom'];
$vdateto=$_GET['txtdateto'];
$morp_lv0006->ReportYear=getyear($vdatefrom);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<?php
if($morp_lv0006->GetView()==1)
{
	
	
	echo "<div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[0]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$morp_lv0006->FormatView($vdatefrom,2)." to ".$morp_lv0006->FormatView($vdateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div>";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv015,lv029,lv100,lv101,lv102";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,100,101,102';
	echo $morp_lv0006->LV_FN($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt);
   
                
?>	

		
<?php
} else {
	include("../permit.php");
}
?>
