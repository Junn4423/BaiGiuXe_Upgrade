<?php
//session_start(); 
//error_reporting(E_ERROR | E_PARSE);
unset( $_SESSION['NodesHasBeenAddedCheckBox'] );
unset( $_SESSION['treeviewcheckbox'] );
unset( $_SESSION['treeviewcheckbox'] );
if (isset( $_SESSION['NodesHasBeenAddedCheckBox'] )) {
	session_destroy();
}
if (isset( $_SESSION['treeviewcheckbox'] )) {
	session_destroy();
}
$vDir = '';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/lv_lv0007.php");
require_once("../clsall/jo_lv0016.php");

/////////////init object//////////////
$molv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
if($molv_lv0007->GetEdit()==1)
{
	if(isset($_GET['ajaxbangtext']))
	{
		$vdonhangid=$_GET['donhangid'];
		$vText=$_GET['textup'];
		$vText=str_replace('$$$','+',$vText);
		$voption=$_GET['optrun'];
		if($vdonhangid!='' && $vdonhangid!=NULL)
		{
			$vUserID=$molv_lv0007->LV_UserID;
			$vlvField='lv'.Fillnum($voption,3);
			switch($voption)
			{
				case 909:
				case 910:	
				case 911:	
				case 912:			
				case 913:
				case 914:
					$vsql="update lv_lv0007 set $vlvField='$vText' where lv001='$vdonhangid'";
					break;				
			}
			$vresult=db_query($vsql);

		}
		exit;
	}
}
$molv_lv0007->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","LV0003.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0007->ArrPush[0]=$vLangArr[17];
$molv_lv0007->ArrPush[1]=$vLangArr[18];
$molv_lv0007->ArrPush[2]=$vLangArr[20];
$molv_lv0007->ArrPush[3]=$vLangArr[22];
$molv_lv0007->ArrPush[4]=$vLangArr[23];
$molv_lv0007->ArrPush[5]=$vLangArr[21];
$molv_lv0007->ArrPush[6]=$vLangArr[24];
$molv_lv0007->ArrPush[7]=$vLangArr[25];
$molv_lv0007->ArrPush[8]=$vLangArr[26];
$molv_lv0007->ArrPush[9]='DeActive';
$molv_lv0007->ArrPush[10]='UserControl';
$molv_lv0007->ArrPush[11]='IPLogin';
$molv_lv0007->ArrPush[907]='Khu vực';
$molv_lv0007->ArrPush[910]='Thấy giá kho';
$molv_lv0007->ArrPush[911]='Thấy giá PBH';
$molv_lv0007->ArrPush[912]='Thấy giá BBG';
$molv_lv0007->ArrPush[913]='Thấy giá PMH';
$molv_lv0007->ArrPush[914]='Thấy giá SP';
$molv_lv0007->ArrPush[915]='Xem toàn quyền';
$molv_lv0007->ArrPush[905]='Trợ lý của :';
$molv_lv0007->ArrPush[906]='Thay thế NV nghỉ việc:';

$molv_lv0007->ArrFunc[0]='//Function';
$molv_lv0007->ArrFunc[1]=$vLangArr[2];
$molv_lv0007->ArrFunc[2]=$vLangArr[4];
$molv_lv0007->ArrFunc[3]=$vLangArr[6];
$molv_lv0007->ArrFunc[4]=$vLangArr[7];
$molv_lv0007->ArrFunc[5]='';
$molv_lv0007->ArrFunc[6]='DeActive';
$molv_lv0007->ArrFunc[7]='Active';
$molv_lv0007->ArrFunc[8]=$vLangArr[10];
$molv_lv0007->ArrFunc[9]=$vLangArr[12];
$molv_lv0007->ArrFunc[10]=$vLangArr[0];
$molv_lv0007->ArrFunc[11]=$vLangArr[29];
$molv_lv0007->ArrFunc[12]=$vLangArr[30];
$molv_lv0007->ArrFunc[13]=$vLangArr[31];
$molv_lv0007->ArrFunc[14]=$vLangArr[32];
$molv_lv0007->ArrFunc[15]=$vLangArr[33];
////Other
$molv_lv0007->ArrOther[1]=$vLangArr[27];
$molv_lv0007->ArrOther[2]=$vLangArr[28];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];

$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"lv_lv0007",$lvMessage);
}

elseif($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_Delete($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_Aproval($strar);
}
elseif($flagID==5)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_UnAproval($strar);
}
elseif($flagID==16)
{
	require_once("../clsall/ml_lv0008.php");
	require_once("../clsall/ml_lv0009.php");
	require_once("../clsall/ml_lv0013.php");
	require_once("../clsall/ml_lv0100.php");
	require_once("../clsall/class.phpmailer.php");
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_ResetPwd($strar);
}
elseif($flagID==34)
{
	$vGroupID=$_POST['txtlv003'];
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_ProcessAddGroup($strar,$vGroupID);
}
elseif($flagID==44)
{
	$vGroupID=$_POST['txtlv903'];
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_ProcessAddWarehouse($strar,$vGroupID);
}
if($flagID>0)
{
	$molv_lv0007->lv001=$_POST['txtlv001'];
	$molv_lv0007->lv002=$_POST['txtlv002'];
	$molv_lv0007->lv003_=$_POST['txtlv003'];
	$molv_lv0007->lv004=$_POST['txtlv004'];
	$molv_lv0007->lv005=$_POST['txtlv005'];
	$molv_lv0007->lv006=$_POST['txtlv006'];
	$molv_lv0007->lv007=$_POST['txtlv007'];
	$molv_lv0007->lv099=$_POST['txtlv099'];
	$molv_lv0007->lv903=$_POST['txtlv903'];
	$molv_lv0007->lv906=$_POST['txtlv906'];
$molv_lv0007->DeptList=$_POST['txtDeptList'];
}
//first is load
if(isset($_POST["txtFlag"]) && $_POST["txtFlag"] != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0007->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0007');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$molv_lv0007->ListView;

$curPage = $molv_lv0007->CurPage;
$maxRows =$molv_lv0007->MaxRows;
$vOrderList=$molv_lv0007->ListOrder;
$vSortNum=$molv_lv0007->SortNum;
}
elseif(isset($_POST["txtFlag"]) && $_POST["txtFlag"] == 2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$molv_lv0007->SaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0007',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$maxRows = $maxRows ?? 0;
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$molv_lv0007->GetCount();
$maxPages = 10;
if(!isset($curPage) || $curPage == "") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
</head>
<script language="JavaScript" type="text/javascript">
<!--
	function AddUser()
	{
		 var o=document.frmcomtemp;
 		 o.target="_self"; 
		 o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,1,0,0,0);?>"
		 o.submit();
	}
	function KindOfUser()
	{
		 var o=document.frmcomtemp;
 		 o.target="_self"; 
		 o.txtFlagControl.value="1";
		 o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,5,0,0,0);?>"
		 o.submit();
	}
	function AddPer()
	{
		Chked2Submit(document.frmchoose,'lvChk',6)
	}
	function AddPermission(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,3,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
	function ViewLogtime(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,4,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
	function ViewLogtimes()
	{
		Chked2Submit(document.frmchoose,'lvChk',9);
	}
	function Apr()
	{
		lv_chk_list(document.frmchoose,'lvChk',9);
	}
	function Approvals(vValue)
	{
	var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=4;
		 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0);?>"
		 o.submit();
	}
	function UnApr()
	{
		lv_chk_list(document.frmchoose,'lvChk',10);
	}
	function UnApprovals(vValue)
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.target="_self";
		o.txtFlag.value=5;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0);?>"
		o.submit();
	}
	function Help()
	{
		'http://www.sof.vn?option=com_content&amp;sectionid=0#';
	}

	function Reset()
	{
		Chked2Submit(document.frmchoose,"lvChk",26);
	}
	function ResetPass(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,17,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
function Add()
{
	RunFunction('','add');
}
function Edt()
{
	lv_chk_list(document.frmchoose,'lvChk',2);
}
function Edit(vValue)
{

	RunFunction(vValue,'edit');
}
function Fil()
{
	RunFunction('&lv001=<?php echo $_POST['txtlv001'] ?? ''; ?>
                &lv002=<?php echo $_POST['txtlv002'] ?? ''; ?>
                &lv003=<?php echo $_POST['txtlv003'] ?? ''; ?>
                &lv004=<?php echo $_POST['txtlv004'] ?? ''; ?>
                &lv005=<?php echo $_POST['txtlv005'] ?? ''; ?>
                &lv006=<?php echo $_POST['txtlv006'] ?? ''; ?>
                &lv007=<?php echo $_POST['txtlv007'] ?? ''; ?>
                &lv008=<?php echo $_POST['txtlv008'] ?? ''; ?>
                &lv906=<?php echo $_POST['txtlv906'] ?? ''; ?>',
                'filter');
}
function Del()
{
	lv_chk_list(document.frmchoose,'lvChk',3);
}
function Delete(vValue)
{
 	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=1;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>lv_lv0007?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function DoResetPass()
	{
		lv_chk_list(document.frmchoose,"lvChk",12);
	}
	function FunctRunning5(vValue)
	{
		var o=document.frmchoose;
			o.txtStringID.value=vValue;
			o.txtFlag.value=16;
			 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0);?>"
			 o.submit();
	}
function UpdateAddWarehouse()
{
	lv_chk_list(document.frmchoose,'lvChk',14);
}
function FunctRunning7(vValue)
{
	if(confirm("Bạn có muốn thêm kho không?(Y/N)"))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=44;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>"
		o.submit();
	}
}
function UpdateGroupPermission()
{
	lv_chk_list(document.frmchoose,'lvChk',13);
}
function FunctRunning6(vValue)
{
	if(confirm("Bạn có muốn cập nhật quyền không?(Y/N)"))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=34;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>"
		o.submit();
	}
}
function ChangeInfor()
{
	var o1=document.frmchoose;
	o1.submit();
}	
//-->
</script>
<?php
if($molv_lv0007->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div id="lvleft">
					  <form onsubmit="return false;" 
							action="?func=<?php echo htmlspecialchars($_GET['func'] ?? '', ENT_QUOTES); ?>&ID=<?php echo htmlspecialchars( $_GET['ID'] ?? '', ENT_QUOTES); ?>&trangthai=<?php echo htmlspecialchars($_GET['trangthai'] ?? '', ENT_QUOTES); ?>&TKACC=<?php echo htmlspecialchars($_GET['TKACC'] ?? '', ENT_QUOTES); ?>&<?php echo $psaveget;?>" 
							method="post" 
							name="frmchoose" 
							id="frmchoose">
						<input type="hidden" name="allcreen" value="<?php echo htmlspecialchars($_POST['allcreen'] ?? '', ENT_QUOTES); ?>"/>

					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					 
					  <table style="background:#f2f2f2;font:10px arial;width:100%;">
					  	<tr><td colspan="4">
							<table><tr>
								<td><input  style="width:80px;text-align:center" type="button" value="Tìm kiếm" onclick="ChangeInfor()"/></td>
								<td>Mã người dùng</td>
								<td><input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $molv_lv0007->lv001;?>" style="width:100%" onKeyPress="return CheckKey(event,7)"/></td>
								<td>Tên người dùng</td>
								<td><input name="txtlv004" type="text" id="txtlv004"  value="<?php echo $molv_lv0007->lv004;?>" style="width:100%" onKeyPress="return CheckKey(event,7)"/></td>
								<td>Mã nhân viên</td>
								<td><input name="txtlv006" type="text" id="txtlv006"  value="<?php echo $molv_lv0007->lv006;?>" style="width:100%" onKeyPress="return CheckKey(event,7)"/></td>
								<td>Khu vực</td>
								<td>
									<select class="norequired" name="txtlv906" id="txtlv906">
										<option value=""></option>
										<?php echo $molv_lv0007->LV_LinkField('lv906',$molv_lv0007->lv906);?>
									</select>	
								</td>
								<td>Active/DeActive</td>
								<td>
									<select class="norequired" name="txtlv007" id="txtlv007">
									<option value="" <?php echo (isset($_POST['txtlv007']) && $_POST['txtlv007'] == '') ? 'selected="selected"' : ''; ?>>Cả hai</option>
									<option value="0" <?php echo (isset($_POST['txtlv007']) && $_POST['txtlv007'] == '0') ? 'selected="selected"' : ''; ?>>Active</option>
									<option value="1" <?php echo (isset($_POST['txtlv007']) && $_POST['txtlv007'] == '1') ? 'selected="selected"' : ''; ?>>DeActive</option>

									</select>
								</td>
							</tr>
						</table>
						</td></tr>
						<tr>
							<td width="90">
					  <input  style="width:80px;text-align:center" type="button" value="View Log" onclick="ViewLogtimes()"/>
					  </td>
					  <td width="180"><a class="toolbar" href="javascript:DoResetPass();">
										<img height="20" src="../images/controlright/key.gif" title="<?php echo $vLangArr[14];?>" name="reset" border="0" align="middle" id="reset" /><?php echo 'Reset mật khẩu gửi mail';?></a>
									</td>
								
					<td>
						<table>
							<tr>
							<td>	
								<input style="width:190px;text-align:center;height:25px;" type="button" value="Thêm quyền hàng loạt" onclick="UpdateGroupPermission()" title="Chỉ thêm quyền"/>
							</td>
							<td nowrap>Chọn nhóm quyền</td>
							<td>
							<select class="norequired" name="txtlv003" id="txtlv003">
								<option value=""></option>
								<?php echo $molv_lv0007->LV_LinkField('lv003',$molv_lv0007->lv003_);?>
							</select>
							</td>
							<td>	
								<input style="width:190px;text-align:center;height:25px;" type="button" value="Thêm kho VT" onclick="UpdateAddWarehouse()" title="Chỉ thêm Kho"/>
							</td>
							<td nowrap>Chọn kho VT</td>
							<td>
							<select class="norequired" name="txtlv903" id="txtlv903">
								<option value=""></option>
								<?php echo $molv_lv0007->LV_LinkField('lv903',$molv_lv0007->lv903);?>
							</select>
							</td>
							</tr>
						</table>
					</td>
					<td></td>
					</tr>
					</table>
						<?php  if (!isset($vSortNum)) {
							$vSortNum = 0; // hoặc giá trị phù hợp với logic bạn cần
						} echo $molv_lv0007->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $molv_lv0007->lv002;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $molv_lv0007->lv005;?>"/>
						<input type="hidden" name="txtlv099" id="txtlv099" value="<?php echo $molv_lv0007->lv099;?>"/>
						<input type="hidden" name="txtDeptList" id="txtDeptList" value="<?php echo $molv_lv0007->DeptList;?>"/>
						
					    
				  </form>
				<form action="" name="frmcomtemp" method="post" target="_blank" enctype="multipart/form-data">
						<input type="hidden" name="txtlv001" id="txtlv001" />
						<input type="hidden" name="txtFlagControl" id="txtFlagControl" value="2" />
						<input type="hidden" name="curPg" id="curPg" value="">						
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
					</form>
				  
</div></div>
</body>
				
<?php
} else {
	include("../lv_lv0007/permit.php");
}
?>
<script language="javascript">
	function UpdateTextCheck(o,donhangid,option)
{
		$xmlhttp555=null;		
		xmlhttp555=GetXmlHttpObject();
		if (xmlhttp555==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		var value=(o.checked)?1:0;
		url=url+"&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+value+"&optrun="+option;
		url=url.replace("#","");
		xmlhttp555.onreadystatechange=stateactivebangtext;
		xmlhttp555.open("GET",url,true);
		xmlhttp555.send(null);	
}	
function stateactivebangtext()
{
}
function GetXmlHttpObject()
{
	if (window.XMLHttpRequest)
	{
	  // code for IE7+, Firefox, Chrome, Opera, Safari
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject)
	{
	  // code for IE6, IE5
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $molv_lv0007->ArrPush[0];?>';	
</script>
</html>