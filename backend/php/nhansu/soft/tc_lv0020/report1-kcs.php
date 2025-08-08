<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0013.php");
require_once("../../clsall/tc_lv0020.php");
require_once("../../clsall/hr_lv0020.php");

//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$vNow=GetServerDate();
/////////////init object//////////////
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0020->ArrTimeCordPush[2]='Mã chấm công';
$motc_lv0020->ArrTimeCordPush[3]='Tên';
$motc_lv0020->ArrTimeCordPush[4]='Phần trăm';
$motc_lv0020->ArrTimeCordPush[5]='Số giờ làm';
$motc_lv0020->ArrTimeCordPush[6]='Lương/một giờ';
$motc_lv0020->ArrTimeCordPush[7]='Lương theo giờ';
$motc_lv0020->ArrTimeCordPush[8]='Tổng lương theo giờ làm(1)';

$motc_lv0020->ArrTime1CordPush[2]='Mã sản phẩm';
$motc_lv0020->ArrTime1CordPush[3]='Tên';
$motc_lv0020->ArrTime1CordPush[4]='Loại';
$motc_lv0020->ArrTime1CordPush[5]='Số lượng';
$motc_lv0020->ArrTime1CordPush[6]='Phần trăm loại';
$motc_lv0020->ArrTime1CordPush[7]='Giá';
$motc_lv0020->ArrTime1CordPush[8]='Lương theo sản phẩm';
$motc_lv0020->ArrTime1CordPush[9]='Tổng lương theo sản phẩm(2)';


$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";	
	$vLangArr=GetLangFile("../../","SL0020.txt",$plang);
	
$motc_lv0020->lang=strtoupper($plang);
$motc_lv0020->LV_LoadID($vlv001);
$motc_lv0013->LV_LoadID($motc_lv0020->lv020);
$mohr_lv0020->LV_LoadID($motc_lv0020->lv002);
?>
<?php
if($motc_lv0020->getrpt()==1)
{
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
<table cellpadding="0" cellspacing="0" border="0" width="101%">
<tr>
						<td  colspan="5" rowspan="2"><img  src="<?php echo $motc_lv0020->GetLogo();?>"  width="80%" border="0" height="100"/></td>
						<td width="1" align="right" valign="top"><?php echo ($motc_lv0020->lv023==1)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$motc_lv0020->lv001."'>":"";?></td>
  </tr>
<tr>
  <td align="right" valign="top"><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="90px" height="100px" 
								src="<?php echo "../../images/employees/".$mohr_lv0020->lv001."/".$mohr_lv0020->lv007; ?>" /></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" border="1" width="101%">
<tr>
  <td width="14%">Mã nhân viên </td>
  <td width="32%"><?php echo $mohr_lv0020->lv001;?></td>
  <td width="15%">Tên nhân viên </td>
  <td width="23%"><?php echo $mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002;?></td>
  </tr>
<tr>
  <td>Phòng ban </td>
  <td><?php echo $mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029);?></td>
  <td>Phái</td>
  <td><?php echo ($mohr_lv0020->lv018==0)?'Nam':'Nữ';?></td>
  </tr>
<tr>
  <td>Số CMND</td>
  <td><?php echo $mohr_lv0020->lv010;?></td>
  <td>Ngày sinh </td>
  <td><?php echo $mohr_lv0020->FormatView($mohr_lv0020->lv015,2);?></td>
  </tr>
</table>
<table cellpadding="0" cellspacing="0" border="1" width="101%">
<tr>
  <td>Lương tính bảo hiểm </td>
  <td>Lương không tính bảo hiểm </td>
  <td>Tổng lương </td>
</tr>
<tr><td><?php echo $motc_lv0020->FormatView($motc_lv0020->lv006,1);?></td><td><?php echo $motc_lv0020->FormatView($motc_lv0020->lv007,1);?></td><td><?php echo $motc_lv0020->FormatView($motc_lv0020->lv006+$motc_lv0020->lv007,1);?></td></tr>
<tr>
  <td colspan="3"><table border="0" width="100%"><tr><td valign="top"><?php  
  $strSumSalary=$motc_lv0020->GetTimeCodehours($motc_lv0020->lv020,$motc_lv0020->lv002,$motc_lv0020->lv022,$motc_lv0013,'1');
 echo str_replace("@#02",$motc_lv0020->FormatView($motc_lv0020->lv017,1),$strSumSalary);
  ?></td><td valign="top"><?php  
  $strSumSalary=$motc_lv0020->GetItemTimecard($motc_lv0020->lv020,$motc_lv0020->lv002);
 echo str_replace("@#02",$motc_lv0020->FormatView($motc_lv0020->lv025,1),$strSumSalary);
  ?></td></tr>
    <tr>
      <td valign="top"><table width="100%" cellspacing="0" cellpadding="0" border="1">
        <tr>
          <td colspan="3" align="center">Bảo hiểm </td>
          </tr>
        <tr>
          <td>Bảo hiểm xã hôi </td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0013->lv012,10)."%";?></td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv012,1);?></td>
        </tr>
        <tr>
          <td>Bảo hiểm y tế </td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0013->lv013,10)."%";?></td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv013,1);?></td>
        </tr>
        <tr>
          <td>Bảo hiểm thất nghiệp </td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0013->lv014,10)."%";?></td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv014,1);?></td>
        </tr>
        <tr class="lvlineboldtable">
          <td colspan="2">Tổng lương trả bảo hiểm (3)</td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv012+$motc_lv0020->lv013+$motc_lv0020->lv014,1);?></td>
        </tr>
      </table></td>
      <td valign="top"><table width="100%" cellspacing="0" cellpadding="0" border="1">
        <tr>
          <td colspan="2" align="center">Các khoản cộng </td>
          </tr>
        <tr>
          <td>Lương thưởng </td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv008,1);?></td>
        </tr>
        <tr>
          <td>Công tác phí</td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv011,1);?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="lvlineboldtable">
          <td>Tổng lương các khoản cộng (4)</td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv008+$motc_lv0020->lv011,1);?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td valign="top"><table width="100%" cellspacing="0" cellpadding="0" border="1">
        <tr>
          <td colspan="2" align="center">Các khỏa trừ </td>
          </tr>
        <tr>
          <td>Khoản lương trừ </td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv009,1);?></td>
        </tr>
        <tr>
          <td>Tiền tạm ứng </td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv012,1);?></td>
        </tr>
        <tr class="lvlineboldtable">
          <td>Tổng lương các khoản trừ (5)</td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv009+$motc_lv0020->lv012,1);?></td>
        </tr>
        <tr class="lvlineboldtable">
          <td>Chú ý :(6)=(1)+(2)-(3)+(4)-(5)</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
      <td valign="top"><table width="100%" cellspacing="0" cellpadding="0" border="1">
        <tr>
          <td colspan="2" align="center">Tính thuế thu nhập </td>
          </tr>
        <tr>
          <td>Khoản lương trừ thuế TNCN bản thân(7) </td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0013->lv015,1);?></td>
        </tr>
        <tr>
          <td>Khoản lương trừ người phụ thuộc (8) </td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv026,1);?></td>
        </tr>
        <tr>
          <td>Khoản lương phải trả thuế TNCN :(6)-(7)-(8) </td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv027,1);?></td>
        </tr>
        <tr class="lvlineboldtable">
          <td>Tiền thuế TNCN (9) </td>
          <td><?php echo $motc_lv0013->FormatView($motc_lv0020->lv028,1);?></td>
        </tr>
      </table></td>
    </tr>
    <tr class="lvlineboldtable">
      <td valign="top">Tổng lương chưa có thuế TNCN(6): <?php echo $motc_lv0020->FormatView($motc_lv0020->lv019,1);?></td>
      <td valign="top">Tổng lương có thuế TNCN (6)-(9): <?php echo $motc_lv0020->FormatView($motc_lv0020->lv029,1);?></td>
    </tr>
    <tr class="lvlineboldtable">
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr class="lvlineboldtable">
      <td colspan="2" valign="top"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="250">&nbsp;</td>
						<td width="243">&nbsp;</td>
						<td width="217">&nbsp;</td>
						<td width="20">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td onDblClick="this.innerHTML=''" style="cursor:move" align="center"><b><span  style="cursor:move" ><b>Kế toán </b></span></b></td>
						<td>&nbsp;</td>
						<td align="center" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b>Người nhận </b></span></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td align="center" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td align="center" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
					</tr>
		  </table></td>
      </tr>
  </table></td>
  </tr>
<tr>
  <td colspan="3">&nbsp;</td>
</tr>
</table>

</body>
</html>
<?php
}
?>