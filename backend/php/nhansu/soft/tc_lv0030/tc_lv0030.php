<?php

session_start();
$vDir = "";
include($vDir."paras.php");
require_once("../clsall/lv_controler.php");
include($vDir."../clsall/tc_lv0004.php");
include($vDir."../clsall/tc_lv0002.php");
include($vDir."../clsall/tc_lv0003.php");
include($vDir."../clsall/tc_lv0030.php");
include($vDir."../clsall/hr_lv0038.php");
include($vDir."../clsall/tc_lv0012.php");
include($vDir."../clsall/tc_lv0011.php");
include($vDir."../clsall/tc_lv0009.php");
include($vDir."../clsall/tc_lv0008.php");
include($vDir."../clsall/hr_lv0002.php");
include($vDir."../clsall/sl_lv0013.php");
include($vDir."../clsall/jo_lv0004.php");

$motc_lv0030=new tc_lv0030($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0030');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0030');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0030');
//Get Basic information
$pGetLengthFile=(int)$_GET['LengthFile'];
$vNow=GetServerDate();
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TC0046.txt",$plang);
$motc_lv0030->ArrFunc[9]=$vLangArr[12];	
if($vFlag==1)
{
  $vDateCal=recoverdate($_POST['datadate'],$plang);
?>	
<?php
//////////////////Init object////////////
$motc_lv0012=new tc_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0012');
$motc_lv0011=new tc_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0011');
$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
$motc_lv0002=new tc_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0002');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$mojo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$motc_lv0003=new tc_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0003');
$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0002');
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0002');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$vArrShift=$motc_lv0004->LV_LoadArray();
$vArrCong=$motc_lv0002->LV_LoadArray();
$vArrDep=$mohr_lv0002->LV_LoadArray();
//$vArrPro=$mosl_lv0013->LV_LoadArray();
$motc_lv0030->DonXinPhep=$mojo_lv0004;
$motc_lv0030->NgayNghiLe=$motc_lv0003;
//$motc_lv0011->LV_EMPALLLIST(getyear($vDateCal),getmonth($vDateCal));
$motc_lv0030->motc_lv0012=$motc_lv0012;
$motc_lv0030->motc_lv0011=$motc_lv0011;
$motc_lv0030->motc_lv0008=$motc_lv0008;	
//////////////////////////////////////////
//////////////////Get data time//////////////////////
$lineprocess=$_POST['txtlv002'];
$motc_lv0030->lv002=
$vListEmp=$_POST['txtlv001'];
$motc_lv0030->isCheckOut=($_POST['isCheckOut']==1)?true:false;
if($motc_lv0030->GetApr()==0)	$motc_lv0030->lv029=$motc_lv0030->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
//$motc_lv0030->LV_RunToDay($vDateCal,$lineprocess,$_POST['txtStateUp'],$_POST['txtday']);
$motc_lv0030->isHoLiday=($_POST['isHoLiday']==1)?true:false;	

$motc_lv0030->LV_RunAll($vArrDep,$vArrCong,$vArrShift,$vDateCal,$lineprocess,$_POST['txtStateUp'],$_POST['txtday'],$_POST['txtCalShift'],$vListEmp,$vArrPro);
$vUpdateMonth=$_POST['txtCalUpdateMonth'];

	if($vUpdateMonth==1)
	{
		$month=getmonth($vDateCal);
		$year=getyear($vDateCal);
		//$vresult=$motc_lv0009->LV_UpdatePreHSo($month,$year);
		//$vresult=$motc_lv0008->LV_UpdateFN($vNow);
	}
	echo '<font color="red">Đã xử lý thành công lúc:'.GetServerTime().'</font>';
}
?>
<?php
if(1==1)
{
?>
<script language="javascript">
function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				if(str=='') 
					str=div.value;
				else
					 str=str+','+div.value;
				}
			
			}
			return str;
		}
function SaveLoadFile()
{
	var o=document.frmgeneral;
	if(o.datadate.value=="")
	{
		o.datadate.focus();
		alert('<?php echo $vLangArr[11];?>');
	}
	else
	{
		o.txtlv002.value=getChecked(o.chklv002.value,'chklv002');
		o.submit();
	}
}
</script>
<link rel="stylesheet" href="../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../css/popup.css" type="text/css">
<script language="javascript" src="../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../javascripts/engines.js"></script>
<!------------------------------------------------------------------------>
	
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				<form action="#" method="post" enctype="multipart/form-data" name="frmgeneral" id="frmgeneral" onsubmit="return false;">
					<input type="hidden" name="txtFlag" id="txtFlag" value="1" />
			<table width="760" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
				  <td height="20px" colspan="3" align="right"><?php echo $motc_lv0030->LV_ViewHelp($vFieldList,'document.frmgeneral',$vOrderList);?></td>
			  </tr>
				<tr>
							  <td height="20px" colspan="3" align="center"><h2><?php echo $vLangArr[0];?></h2></td>
				</tr>
				  <tr>
				     <td width="308" align="center"><?php echo $vLangArr[1];?> </td>
				  	<td width="17" height="20px" align="center">:</td>
					<td width="266" height="20px" align="left"><input type="text" name="datadate" id="datadate" value="<?php echo $_POST['datadate'];?>"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmgeneral.datadate);return false;" /></td>
		      </tr>
			   <tr>
				    <td height="24" align="center"><?php echo 'Mã nhân viên';?></td>
					<td width="17" height="20px" align="center">:</td>
					<td>
					
					<table width="80%">
						<tr>
							<td>
								<ul id="pop-nav" lang="pop-nav2" onMouseOver="ChangeName(this,2)" xml:lang="pop-nav2">
									<li class="menupopT">
									<input  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv001','hr_lv0020','lv001','concat(lv004,@! @!,lv003,@! @!,lv002,@! - @!,lv001)')" name="txtlv001" type="textbox" id="txtlv001" value="<?php echo $_POST['txtlv001'];?>" style="width:100%" tabindex="8" maxlength="50" >
							<div id="lv_popup" lang="lv_popup2"> </div>
									</li>
								</ul>
							</td>
						</tr>
					</table>
					</td>
		      </tr>
				  <tr>
				    <td height="24" align="center"><?php echo $vLangArr[2];?></td><td>:</td><td>
					<div style="height:200px;overflow:auto">
					<input name="txtlv002" type="hidden" id="txtlv002" value="<?php echo $_POST['txtlv002'];?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $motc_lv0030->GetBuilCheckListDept($motc_lv0030->lv002,'chklv002',10,'hr_lv0002','lv003',$motc_lv0030->lv029);?>
					</div>
					</td>
		      </tr>
			   <tr>
				<td align="center">Tính đè lên kết quả cũ </td>
					<td width="17" height="20px" align="center">:</td>
				<td><input type="checkbox" name="txtStateUp" value="1" checked="true"/>
			</tr>
			  <tr>
				<td align="center">Tính dựa vào ca có sẵn </td>
					<td width="17" height="20px" align="center">:</td>
				<td><input type="checkbox" name="txtCalShift" value="1" <?php echo ($_POST['txtCalShift']==1)?'checked="checked"':'';?>>
			</tr>
			 <tr>
				<td align="center">Cập nhật phép,lễ, giờ bù </td>
					<td width="17" height="20px" align="center">:</td>
				<td><input type="checkbox" name="txtCalUpdateMonth" value="1" <?php echo ($_POST['txtCalUpdateMonth']==1)?'checked="checked"':'';?>/>
			</tr>
			<tr>
				<td align="center"><?php echo 'Tính tăng ca theo phép kiểm tra giờ ra';?> </td>
					<td width="17" height="20px" align="center">:</td>
				<td><input type="checkbox" name="isCheckOut" value="1"  checked="true"/>
			</tr>
			<tr>
				<td align="center"><?php echo 'Tính công theo ngày lễ đã thiết lập';?> </td>
					<td width="17" height="20px" align="center">:</td>
				<td><input type="checkbox" name="isHoLiday" value="1" <?php echo ($_POST['isHoLiday']==1 || $vFlag!=1)?'checked="checked"':'';?>/>
			</tr>
			<tr>
				<td align="center">Lấy theo tháng/năm </td>
					<td width="17" height="20px" align="center">:</td>
				<td><input type="checkbox" name="txtday" value="1"  checked="true"/>
			</tr>
               <tr>
				    <td height="24" colspan="3" align="center">&nbsp;</td>
		      </tr>
				  <tr>
				    <td height="24" colspan="3" align="center"><input type="submit" name="Submit" value="<?php echo $vLangArr[6];?>" onclick="SaveLoadFile()"></td>
		      </tr>
                </table>					
		      </form>
<h2><?php 
$vLangArr=GetLangFile("$vDir../","TC0052.txt",$plang);
echo $vLangArr[48];?></h2>
<br />	
<ul>
<li><?php echo '0. Bình thường';?></li>
<li><?php echo $vLangArr[49];?></li>
<li><?php echo $vLangArr[50];?></li>
<li><?php echo $vLangArr[51];?></li>
<li><?php echo $vLangArr[52];?></li>
<li><?php echo $vLangArr[53];?></li>
</ul>	
</div>
</div>					 
    <iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $plang;?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php
} else {
	include("permit.php");
}
?>