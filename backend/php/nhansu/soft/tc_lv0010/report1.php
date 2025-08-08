<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0010.php");
require_once("../../clsall/tc_lv0011.php");

/////////////init object//////////////
$motc_lv0011=new tc_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0016');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

$plang="VN";
	$vLangArr=GetLangFile("../../","TC0019.txt",$plang);
$motc_lv0011->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0010->ArrPush[0]=$vLangArr[17];
$motc_lv0010->ArrPush[1]=$vLangArr[18];
$motc_lv0010->ArrPush[2]=$vLangArr[19];
$motc_lv0010->ArrPush[3]=$vLangArr[20];
$motc_lv0010->ArrPush[4]=$vLangArr[21];
$motc_lv0010->ArrPush[5]=$vLangArr[22];
$motc_lv0010->ArrPush[6]=$vLangArr[23];
$motc_lv0010->ArrPush[7]=$vLangArr[24];
$motc_lv0010->ArrPush[8]=$vLangArr[25];
$motc_lv0010->ArrPush[9]=$vLangArr[26];
$motc_lv0010->ArrPush[10]=$vLangArr[27];


$vLangArr=GetLangFile("../../","SL0029.txt",$plang);
$motc_lv0011->ArrPush[0]=$vLangArr[17];
$motc_lv0011->ArrPush[1]=$vLangArr[18];
$motc_lv0011->ArrPush[2]=$vLangArr[19];
$motc_lv0011->ArrPush[3]=$vLangArr[20];
$motc_lv0011->ArrPush[4]=$vLangArr[21];
$motc_lv0011->ArrPush[5]=$vLangArr[22];
$motc_lv0011->ArrPush[6]=$vLangArr[23];
$motc_lv0011->ArrPush[7]=$vLangArr[24];
$motc_lv0011->ArrPush[8]=$vLangArr[25];
$motc_lv0011->ArrPush[9]=$vLangArr[26];
$motc_lv0011->ArrPush[10]=$vLangArr[27];
$motc_lv0011->ArrPush[11]=$vLangArr[28];
$motc_lv0011->ArrPush[12]=$vLangArr[29];
$motc_lv0011->ArrPush[13]=$vLangArr[30];
$motc_lv0011->ArrPush[14]=$vLangArr[38];
$motc_lv0011->ArrPush[15]=$vLangArr[39];
$motc_lv0011->ArrPush[16]=$vLangArr[40];
$motc_lv0011->ArrPush[17]=$vLangArr[41];


$motc_lv0011->ArrFunc[0]='//Function';
$motc_lv0011->ArrFunc[1]=$vLangArr[2];
$motc_lv0011->ArrFunc[2]=$vLangArr[4];
$motc_lv0011->ArrFunc[3]=$vLangArr[6];
$motc_lv0011->ArrFunc[4]=$vLangArr[7];
$motc_lv0011->ArrFunc[5]='';
$motc_lv0011->ArrFunc[6]='';
$motc_lv0011->ArrFunc[7]='';
$motc_lv0011->ArrFunc[8]=$vLangArr[10];
$motc_lv0011->ArrFunc[9]=$vLangArr[12];
$motc_lv0011->ArrFunc[10]=$vLangArr[0];
$motc_lv0011->ArrFunc[11]=$vLangArr[33];
$motc_lv0011->ArrFunc[12]=$vLangArr[34];
$motc_lv0011->ArrFunc[13]=$vLangArr[35];
$motc_lv0011->ArrFunc[14]=$vLangArr[36];
$motc_lv0011->ArrFunc[15]=$vLangArr[37];

////Other
$motc_lv0011->ArrOther[1]=$vLangArr[31];
$motc_lv0011->ArrOther[2]=$vLangArr[32];
$vOrderList="1,2,3,6,7,8,9,10,4,5,11,12";
/////////////init object//////////////
$motc_lv0010=new tc_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$motc_lv0010->lang=strtoupper($plang);
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$motc_lv0011->lv002=$vlv001;
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vStrMessage="";
?>

<?php
if($motc_lv0010->GetView()==1)
{
  $motc_lv0010->LV_LoadID($vlv001);
	if($motc_lv0010->lv006>0)
	$vFieldList="lv003,lv004,lv005,lv006,lv009,lv010";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv008,lv009,lv010";
	 $strDetail=$motc_lv0011->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,$paging,$vOrderList,$motc_lv0010->lv006);
	 
	?>
<html>
<head>
<title></title>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>	
<body  onkeyup="KeyPublicRun(event)">
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($motc_lv0010->lv011>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$motc_lv0010->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center"><img  src="<?php echo $motc_lv0011->GetLogo();?>" /></td>
  </tr>
  <tr>
    <td align="center" class="lv0" onDblClick="this.innerHTML='&nbsp;'"><?php echo $motc_lv0010->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?></td>
  </tr>
    <tr>
    <td align="center"><h3 onDblClick="this.innerHTML='&nbsp;'"><?php echo "SỐ:".$motc_lv0010->lv001."&nbsp;&nbsp;&nbsp;"."NGÀY: ".$motc_lv0010->FormatView(GetServerDate(),2);?></h3></td>
  </tr>  
  <tr>
    <td align="center"><?php echo str_replace("<!--strAttack-->",$strDetail,$motc_lv0010->lv009);?></td>
  </tr>
</table>
</body>
	<?php
} else {
	include("../permit.php");
}
?>

