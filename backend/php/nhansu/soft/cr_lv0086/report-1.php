<?php
session_start();
$sExport=$_GET['func'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=employees.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=employees.doc');
}
if($sExport=="pdf"){
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/cr_lv0086-1.php");
/////////////init object//////////////
$mocr_lv0086=new cr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0086');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","CR0007.txt",$plang);
$mocr_lv0086->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0086->ArrPush[0]=$vLangArr[17];
$mocr_lv0086->ArrPush[1]=$vLangArr[18];
$mocr_lv0086->ArrPush[2]=$vLangArr[19];
$mocr_lv0086->ArrPush[3]=$vLangArr[20];
$mocr_lv0086->ArrPush[4]=$vLangArr[21];
$mocr_lv0086->ArrPush[5]=$vLangArr[22];
$mocr_lv0086->ArrPush[6]=$vLangArr[23];
$mocr_lv0086->ArrPush[7]=$vLangArr[24];
$mocr_lv0086->ArrPush[8]=$vLangArr[25];
$mocr_lv0086->ArrPush[9]=$vLangArr[26];
$mocr_lv0086->ArrPush[10]=$vLangArr[27];
$mocr_lv0086->ArrPush[11]=$vLangArr[28];
$mocr_lv0086->ArrPush[12]=$vLangArr[29];
$mocr_lv0086->ArrPush[13]=$vLangArr[30];
$mocr_lv0086->ArrPush[14]=$vLangArr[31];
$mocr_lv0086->ArrPush[15]=$vLangArr[32];
$mocr_lv0086->ArrPush[16]=$vLangArr[33];
$mocr_lv0086->ArrPush[17]=$vLangArr[34];
$mocr_lv0086->ArrPush[18]=$vLangArr[35];
$mocr_lv0086->ArrPush[100]=$vLangArr[48];

$mocr_lv0086->ArrPush[97]=$vLangArr[49];
$mocr_lv0086->ArrPush[98]=$vLangArr[50];
$mocr_lv0086->ArrPush[99]=$vLangArr[51];

$mocr_lv0086->ArrPush[19]=$vLangArr[43];
$mocr_lv0086->ArrPush[20]=$vLangArr[44];
$mocr_lv0086->ArrPush[21]=$vLangArr[45];
$mocr_lv0086->ArrPush[22]=$vLangArr[46];
$mocr_lv0086->ArrPush[23]=$vLangArr[47];

$mocr_lv0086->ArrPush[24]='Hàng hoá';
$mocr_lv0086->ArrPush[25]='Ngày khai';
$mocr_lv0086->ArrPush[26]='Nơi nhận hàng';
$mocr_lv0086->ArrPush[27]='Nơi giao hàng';
$mocr_lv0086->ArrPush[95]='Ngày LĐĐ';
$mocr_lv0086->ArrPush[89]='STT/LĐĐ';
$mocr_lv0086->ArrPush[101]='Chi Hộ';
$mocr_lv0086->ArrPush[102]='Thực chi TX';
$mocr_lv0086->ArrPush[112]='Ghi chú sửa ứng';
$mocr_lv0086->ArrPush[113]='Mã chi tiết vận tải';
////Other
$mocr_lv0086->ArrOther[1]=$vLangArr[28];
$mocr_lv0086->ArrOther[2]=$vLangArr[29];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0086->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0086');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0086->lv008=base64_decode( $_GET['ID']);
$vFieldList=$mocr_lv0086->ListView;
$curPage = $mocr_lv0086->CurPage;
$maxRows =$mocr_lv0086->MaxRows;
$vOrderList=$mocr_lv0086->ListOrder;
if($mocr_lv0086->GetApr()==0 || $mocr_lv0086->GetUnApr()==0) echo $mocr_lv0086->lv904=$mocr_lv0086->LV_UserID;
if($maxRows ==0) $maxRows = 10;
$totalRowsC=$mocr_lv0086->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mocr_lv0086->GetView()==1)
{
?>
<center>	
<table border="0" cellspacing="0" style="width: 1000px;">
        <tbody>
            <tr>
                <td colspan="1"  align="center" valign="middle"><strong><span style="font-size: large;"><img ondblclick="this.src='../../logotech.png'" src="../../logo.png" style="height:80px"/></span></strong></td>
                <td colspan="4"  align="left" valign="middle" width="90%">
                    <strong>
                        <span style="font: 22px Arial,Tahoma;text-align:center"><div ondblclick="this.innerHTML='MINH PHUONG INVESTMENT TECHNOLOGY JSC'">CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG</div></span>

                </strong></td>
                
            </tr>
            <tr>
                <td colspan="5" align="center" valign="middle" style="padding:5px;"><strong><span style="font:bold 28px Arial,Tahoma;"><input type="text" value="BÁO CÁO ỨNG NỘI BỘ CHI TIẾT" style="border:0px #fff solid;width:100%;height:40px;text-align:center;font:28px arial,tahoma;"/></span></strong></td>
            </tr>
            <tr>
                <td colspan="5" align="center" valign="middle" style="padding:5px;"><?php echo 	'Từ ngày: '.$mosp_lv0292->dateworkfrom." đến ".$mosp_lv0292->dateworkto;?>
            </tr>
            </tbody>
    </table>

						<?php echo $mocr_lv0086->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
                        <table style="width:1000px;font: 26px Arial,Tahoma;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr><td colspan="9" align="right"><BR/><span style="font: 14px Arial,Tahoma;"><input type="text" value="TP. HCM ngày <?php echo getday($motc_lv0013->DateCurrent);?> tháng <?php echo getmonth($motc_lv0013->DateCurrent);?> năm <?php echo getyear($motc_lv0013->DateCurrent);?>" style="font: 12px Arial,Tahoma;border:0px #fff solid;width:100%;text-align:right;"/></td></tr>
<tr height="27">
<td>&nbsp;</td>
<td  height="27" align="center" style="font: 12px Arial,Tahoma;"><strong>NGƯỜI LẬP BIỂU</strong></td>
<td>&nbsp;</td>
<td  height="27" align="center" style="font: 12px Arial,Tahoma;"><strong>CHỦ QUẢN</strong></td>
<td>&nbsp;</td>
<td align="center" style="font: 12px Arial,Tahoma;"><strong>TỔNG GIÁM ĐỐC</strong></td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td height="27">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td height="27">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td height="27">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td>&nbsp;</td>
<td colspan="1" height="27" align="center">............................................................</td>
<td>&nbsp;</td>
<td colspan="1" height="27" align="center">............................................................</td>
<td>&nbsp;</td>
<td colspan="1" height="27" align="center">............................................................</td>
<td>&nbsp;</td>
</tr>
<tr height="36">
<td width="100">&nbsp;</td>
<td width="200" height="36">&nbsp;</td>
<td width="200">&nbsp;</td>
<td width="200">&nbsp;</td>
<td width="200">&nbsp;</td>
</tr>
</tbody>
</table>	
</center>					
<?php
} else {
	include("../permit.php");
}
?>
