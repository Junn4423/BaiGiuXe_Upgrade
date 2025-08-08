<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0041.php");
require_once("../../clsall/ts_lv0042.php");
require_once("../../clsall/sl_lv0001.php");
require_once("../../clsall/sl_lv0013.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$lvArrMonth=array(1=>"Jan",2=>"Feb",3=>"Mar",4=>"Apr",5=>"May",6=>"Jun",7=>"Jul",8=>"Aug",9=>"Sep",10=>"Oct",11=>"Nov",12=>"Dec");
/////////////init object//////////////
$mots_lv0042=new ts_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0009');
$mots_lv0041=new ts_lv0041($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0008');
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0013');

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0058.txt",$plang);
$mots_lv0041->lang=strtoupper($plang);
$mots_lv0041->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vKeeper=$vLangArr[37];

$mots_lv0042->lang=strtoupper("EN");
//////////////////////////////////////////////////////////////////////////////////////////////////////



$mots_lv0042->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mots_lv0041->GetView()==1)
{
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/reportstyle.css" type="text/css">
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">

	<?php  
	$mots_lv0041->LV_LoadID($vlv001);
	$mosl_lv0013->LV_LoadID($mots_lv0041->lv006);
	$mosl_lv0001->LV_LoadID($mosl_lv0013->lv002);
	 $strDetail=$mots_lv0042->PrintInPackingListParent(strtoupper($plang),$vlv001);

			
	
	?>
	
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mots_lv0041->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mots_lv0041->lv001."'>":"";?></td>
  </tr>	
 <tr>
	    <td align="center" colspan="6"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td><table ><tr><td><img  src="../../images/images/logo_vian.png" /></td><td style="font-weight:bold">PLOT 3/21, 19/5A ST, TAN BINH IND'L PARK,TAN PHU DIST, HO CHI MINH CITY - VIET NAM</td></tr></table></td>
              </tr>
              <tr>
                <td align="center" style="padding-right:2px;font-size:30px;font-weight:bold" ><?php echo $vLangArr[0];?></td>
              </tr>
              <tr>
                <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="*%" valign="top"><b><?php echo $vLangArr[40];?></b> <?php echo $mots_lv0041->lv008;?></td>
    <td><?php echo $vlv002;?></td>
    <td width="*%" align="right" valign="top"><b><?php echo $vLangArr[41];?> <?php echo getday($mots_lv0041->lv009)." ".$lvArrMonth[(int)getmonth($mots_lv0041->lv009)]." ".getyear($mots_lv0041->lv009);?></b><br/> <b><?php echo $vLangArr[42]." ".$mots_lv0041->lv006;?></b></td>
  </tr>
</table></td>
              </tr>
            </table>
			  </td>
		</tr>
   <tr>
    <td>
<!--------------Title----------------------->
<table style="width: 821px;" border="1" cellspacing="0" cellpadding="0">
<colgroup><col width="84"></col> <col width="90"></col> <col width="70"></col> <col width="168"></col> <col width="92"></col> <col span="2" width="69"></col> <col width="64"></col> <col width="23"></col> <col width="64"></col> <col width="28"></col> </colgroup> 
<tbody>
<tr height="35">
<td colspan="11" width="821" height="35">PACKING LIST</td>
</tr>
<tr height="19">
<td height="19">Seller :</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2">Invoice No. and Date :</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="19">
<td colspan="4" rowspan="4" width="412" height="105"><?php echo $mosl_lv0001->lv002;?><br /> <?php echo $mosl_lv0001->lv006;?> <br /> TEL: <?php echo $mosl_lv0001->lv010;?><br /> FAX: <?php echo $mosl_lv0001->lv012;?></td>
<td colspan="7" rowspan="2"><?php echo $mosl_lv0013->lv016;?></td>
</tr>
<tr height="15">
</tr>
<tr height="32">
<td colspan="7" height="32">DATE :&nbsp;   DEC.26, 2014</td>
</tr>
<tr height="39">
<td colspan="7" height="39">&nbsp;</td>
</tr>
<tr height="19">
<td height="19">Sender :</td>
<td colspan="3">&nbsp;</td>
<td colspan="7">L/C No. and Date :</td>
</tr>
<tr height="19">
<td colspan="4" rowspan="5" width="412" height="120"><?php echo $mosl_lv0013->GetCompany();?><br /> <?php echo $mosl_lv0013->GetAddress();?> <br /> <br /> TEL : <?php echo $mosl_lv0013->GetPhone();?><br /> FAX : <?php echo $mosl_lv0013->GetFax();?></td>
<td colspan="7" rowspan="5">BY&nbsp; T/T</td>
</tr>
<tr height="19">
</tr>
<tr height="19">
</tr>
<tr height="19">
</tr>
<tr height="44">
</tr>
<tr height="19">
<td height="19">Consignee :</td>
<td colspan="3">&nbsp;</td>
<td>Buyer :</td>
<td colspan="6">&nbsp;</td>
</tr>
<tr height="19">
<td colspan="4" rowspan="5" width="412" height="100"><?php echo $mosl_lv0001->lv019;?></td>
<td colspan="7" rowspan="5" width="409">SAME AS CONSIGNEE</td>
</tr>
<tr height="19">
</tr>
<tr height="19">
</tr>
<tr height="19">
</tr>
<tr height="24">
</tr>
<tr height="19">
<td height="19">Notify :</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="7">Based on Purchase No. :<br /></td>
</tr>
<tr height="19">
<td colspan="4" rowspan="2" height="31">SAME AS ABOVE</td>
<td colspan="7" rowspan="6" width="409">PO# : 3220007576&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   ( 62,492 PCS)<br /> PO# : 3220008042&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( 8,272   PCS)</td>
</tr>
<tr height="12">
</tr>
<tr height="19">
<td colspan="4" height="19">Departure Date :</td>
</tr>
<tr height="27">
<td height="27">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="25">
<td colspan="4" height="25">ON OR AROUND</td>
</tr>
<tr height="36">
<td colspan="4" height="36">DEC.26, 2014</td>
</tr>
<tr height="19">
<td colspan="2" height="19">Vessel/Flight</td>
<td>From :</td>
<td>&nbsp;</td>
<td colspan="3">Terms of Delivery and   Payment :</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="19">
<td height="19">&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2">LONG AN,   VIETNAM</td>
<td colspan="7" rowspan="3">BY TTC (AWB#: 198 582 784)</td>
</tr>
<tr height="19">
<td height="19">TO :</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="19">
<td colspan="4" height="19">BINH DUONG, VIETNAM</td>
</tr>
</tbody>
</table>
<!--------End Title--------------->	
	
	
	</td>
  </tr>
  <tr>
    <td align="center"><?php echo $strParent;?></td>
  </tr>
    <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $strDetail;?></td>
  </tr>
  <tr>
    <td align="left" ></td>
  </tr>
  <tr>
    <td align="right" ><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="250">&nbsp;</td>
						<td width="243">&nbsp;</td>
						<td width="217">&nbsp;</td>
						<td width="20">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move">&nbsp;</td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $mots_lv0041->GetCompany();?></b></span></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move">&nbsp;</td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
					</tr>
				</table></td>
  </tr>
</table>
</body>
</html>					
<?php
} else {
	include("../permit.php");
}
?>
