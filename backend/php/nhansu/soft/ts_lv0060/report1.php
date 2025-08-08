<?php
session_start();
$vDir="../";
include($vDir."paras.php");
include($vDir."config.php");
include($vDir."function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0060.php");
require_once("../../clsall/sl_lv0001.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/sl_lv0070.php");
////Init object//////////////
$mots_lv0060 = new ts_lv0060($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0060');	
$mosl_lv0070 = new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0070');	
$mosl_lv0001 = new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');	
$mohr_lv0020 = new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');	
/////////Varian////////////////		
$mosl_lv0070->LV_Load();
$mots_lv0060->obj_conf=$mosl_lv0070;
$vOptRun=(int)$_GET['rad'];
$vtax=(int)$_GET['tax'];
$vCateOpt=(int)$_GET['optcate'];
$vlv001=$_GET['txtlv001'];//wh
$vlv002=$_GET['txtlv002'];//startdate
$vlv003=$_GET['txtlv003'];//Enddate
$vlv004=$_GET['txtlv004'];//Source
$vlv005=$_GET['txtlv005'];//Reference
$vlv005_opt=(int)$_GET['txtlv005_opt'];//Reference
$vlv006=$_GET['txtlv006'];//Reference
$vlv007=$_GET['txtlv007'];//Reference
$vlv008=$_GET['txtlv008'];//Reference
$vlv009=$_GET['txtlv011'];//Reference
$vlv013=$_GET['txtlv013'];//Reference
$vlv013_opt=(int)$_GET['txtlv013_opt'];//Reference
$vlv016=$_GET['txtlv016'];//Reference
$vlv022=$_GET['txtlv022'];//Reference
$vexist=$_GET['txtexist'];//Reference
$strNow=GetServerDate();
	if($plang=="" || $plang!="EN") $plang="VN";
		$vLangArr = GetLangFile("../../","TS0065.txt",$plang);

////////////////////////////////////////////Get Data////////////////////////////////////////////////
////////////////////////////////////////////Get Data////////////////////////////////////////////////
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="<?php echo $vDir;?>../css/reportstyle.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo $vDir;?>../css/runtype/horizontalstyle.css" type="text/css">
<title><?php echo $vLangArr[0];?></title>
<style>
.tblRunChild
{
	color:#000099;
	font-weight:bold;
	background-color:#E2F0F1;
}
.htablerun{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	background-color:#E2F0F1;
	font-weight:bold;
	padding-top:2px;
	padding-left:2px;
	padding-right:2px;
	padding-bottom:2px;
	text-align:center;
	font-weight:bold;
}
</style>
<script language="javascript" src="../../javascripts/printscript.js"></script>
</head>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("<?php echo $vDir;?>../");
function ViewInfos(vValue,vType){
	var o = document.frmPostThis;
	if(vType=="X")
	{
	o.txtOutStockID.value = vValue;
	o.txtReceiptionID.value="";
	//o.txtFlag.value = "5";
	o.action="<?php echo $vDir;?>sl_lv0024/?func=&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	}
	else
	{
	o.txtOutStockID.value ="";
	o.txtReceiptionID.value = vValue;
	//o.txtFlag.value = "5";
	o.action="<?php echo $vDir;?>ts_lv0008/?func=&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	
	}	
	o.target="_blank";
	o.submit();
}
function ViewLot(vValue,vStockID){
window.open('<?php echo $vDir;?>wh_lots/wh_lotsview.php?lang=<?php echo $plang;?>&StockID='+vStockID+'&LotID='+vValue,'Requirement','width=600,height=200,left=200,top=350,resizable=yes,screenX=0,screenY=100,scrollbars=yes');
}
function RemoveCol(vname,vobj,vcount)
{
	var i=0;
	for(i=1;i<=vcount;i++)
	{
		var myTD=document.getElementById(vname+"_"+i);
		myTD.parentNode.removeChild(myTD);
	}
	vobj.parentNode.removeChild(vobj);
}
</script>
<?php
if($mots_lv0060->GetView()==1)
{
?>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<table border="0" cellpadding="0" cellspacing="0" width="940px" align="center">
		<tr>
			<td align="center" colspan="6">
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>&nbsp;</td>
						<td width="1" align="right" valign="bottom"><?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".str_replace("/","",formatdate($strNow,$plang))."'>";?></td>
					</tr>
				</table>			</td>
		</tr>
		<tr>
			<td align="center" colspan="6">
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
				  <tr>
					<td align="right"><div><div style="float:left"><img src="../../logo.png" width="130"/></div><div><?php echo ($mosl_lv0013->lv011>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0013->lv001."'>":"";?></div></div></td>
				  </tr>	
					<tr>
					<td align="center">
					<font style="font-size:14px;font-weight:bold"><?php echo $mosl_lv0001->GetCompany();?></font>
					<br/>
					<div>
					Địa chỉ:<?php echo $mosl_lv0001->GetAddress();?>
					<div style="border-top:1px #000 solid;width:84%;height:20px;margin-top:5px;"></div>
					</div>
					</td>
				  </tr>
				    <tr>
                 <td align="center"><font style="font-size:25px;font-weight:bold"><?php echo 'BÁO CÁO CÔNG NỢ KHÁCH HÀNG';?></font></td>
              </tr>
              <tr>
                <td align="center">
				<table width="190" border="0" cellspacing="1" cellpadding="1">
			  <tr>
				<td width="*%"><b><?php echo $vLangArr[2];?>:</b></td>
				<td><?php echo $vlv002;?></td>
			  </tr>
			  <tr>
				<td width="*%"><b><?php echo $vLangArr[3];?>:</b></td>
				<td><?php echo $vlv003;?></td>
			  </tr>
				  </table>
				</td>
				</tr>
				</table>
			  </td>
		</tr>
	
		<tr><td colspan="6" height="35px">
<?php
	if($vlv005!="" && $vlv005_opt!=1)
	{
		$mosl_lv0001->LV_LoadID($vlv005);
		echo "<div>".$vLangArr[27]." : ".$mosl_lv0001->lv002." (".$mosl_lv0001->lv001.")"."</div>";
	}
	if($vlv013!="" && $vlv013_opt!=1)
	{
		$mohr_lv0020->LV_LoadID($vlv013);
		echo "<div>".$vLangArr[26]." : ".$mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002." (".$mohr_lv0020->lv001.")"."</div>";
	}
	$vPoint=50000;
?>			
		</td></tr>
		<tr>

			<td height="20px" colspan="6" align="center" class="normaltext">
				<?php 
				switch($vOptRun)
				{	
					case 5:
						
						echo $strDataShow = $mots_lv0060->PrintInOutPutInStockInvoiceSum($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),2,$vlv005,$vlv005_opt,$vlv013,$vlv013_opt,$vlv006,$vlv009,$vlv016,$vlv008,$vCateOpt,$vtax,$vlv022);
						break;
					case 3:
						echo $strDataShow = $mots_lv0060->PrintInOutPutInStockCustomer($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),2,$vlv005,$vlv005_opt,$vlv013,$vlv013_opt,$vlv006,$vlv009,$vlv016,$vlv008,$vCateOpt,$vtax,$vPoint,$vlv022);
						break;
					default:
						echo $strDataShow = $mots_lv0060->PrintInOutPutInStockDetail($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),2,$vlv005,$vlv005_opt,$vlv013,$vlv013_opt,$vlv006,$vlv009,$vlv016,$vlv008,$vCateOpt,$vtax,$vlv022);
						break;
				}
				?></td>
		</tr>
		<tr height="40px"><td colspan="6" align="right"><span class="normaltext"><span class="boldtext"><?php echo $vLangArr[19]." ".formatdate($strNow, $plang);?></span></span></td></tr>
		<tr>
			<td height="20px" colspan="6" align="center" class="normaltext">
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20px">&nbsp;</td>
						<td width="200px">&nbsp;</td>
						<td width="*">&nbsp;</td>
						<td width="200px">&nbsp;</td>
						<td width="20px">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style"><b><?php echo $vLangArr[37];?></b>&nbsp;</td>
						<td class="center_style">&nbsp;</td>
						<td class="center_style"><b><?php echo $vLangArr[38];?></b>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style"><?php for($i=0; $i<60; $i++) echo ".";?>&nbsp;</td>
						<td class="center_style">&nbsp;</td>
						<td class="center_style"><?php for($i=0; $i<60; $i++) echo ".";?>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>			</td>
		</tr>
		<tr><td colspan="6" height="40px">&nbsp;</td></tr>
	</table>
		<form action="" id="frmPostThis" name="frmPostThis" method="post">
			<input type="hidden" name="txtFlag" id="txtFlag" value="0" />
			<input type="hidden" name="txtOutStockID" id="txtOutStockID" value="" />
			<input type="hidden" name="txtReceiptionID" id="txtReceiptionID" value="" />
			
		</form>	
</body>
<?php 
}?>
</html>