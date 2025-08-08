<?php
$vDir='../';
// if (( $_GET['ID'] ?? '') != "" || ($_GET['DNPCID'] ?? '') != "") {
	// if (($_GET['ID1'] ?? '') != 'view') {
		// $vDir = '../';
	// }
// }
include($vDir."paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/hr_lv0042.php");
require_once("../clsall/cr_lv0202.php");
/////////////init object//////////////
if (isset($_GET['DNPCID']) && $_GET['DNPCID'] != "")
{
	$mohr_lv0042=new hr_lv0042('admin','admin','Hr0044');
}
else
{
	$mohr_lv0042=new hr_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0044');
}
$mocr_lv0202=new cr_lv0202('admin','admin','Hr0044');
$mohr_lv0042->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","HR0109.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////

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

//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0042->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0042');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0042->ListView;
$curPage = $mohr_lv0042->CurPage;
$maxRows =$mohr_lv0042->MaxRows;
$vOrderList=$mohr_lv0042->ListOrder;
$vSortNum=$mohr_lv0042->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0042->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0042',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if (!isset($_GET['ID']) || $_GET['ID'] == '') 
	$mohr_lv0042->lv002=$_POST['txtlv002'] ?? '';
else
	$mohr_lv0042->lv002= $_GET['ID'] ?? '';
$mohr_lv0042->lv003=$_GET['ChildID'] ??'';

	if (!isset($_GET['DNPCID']) || $_GET['DNPCID'] == '')
{
	$mocr_lv0202->LV_LoadID($_GET['DNPCID'] ?? '');
	$mohr_lv0042->lv012=$mocr_lv0202->lv001;
	if($mocr_lv0202->lv002==3 && $mocr_lv0202->lv027<3)
	{
		//Xứ lý tạo tự động 
		$vSoTien=$mocr_lv0202->LV_GetAccountAmount2($mocr_lv0202->lv001);
		$mohr_lv0042->LV_CreateAuutoDNPC($mocr_lv0202->lv001,$mocr_lv0202->lv008,$vSoTien,$mocr_lv0202->lv011,$mocr_lv0202->lv120,$mocr_lv0202->lv122);
	}
	
}
if (!isset($_GET['DNPCID']) || $_GET['DNPCID'] == '')
{
//$mohr_lv0042=new hr_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0044');
}
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0042->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0042",$lvMessage);
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0042->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0042->LV_UnAproval($strar);
}

if($flagID>0)
{
	$mohr_lv0042->lv001=$_POST['txtlv001'];
	if( $_GET['ID']=='')
		$mohr_lv0042->lv002=$_POST['txtlv002'];
	else
		$mohr_lv0042->lv002= $_GET['ID'] ?? '';
	$mohr_lv0042->lv003=$_GET['ChildID'];
	$mohr_lv0042->lv004=$_POST['txtlv004'];
	$mohr_lv0042->lv005=$_POST['txtlv005'];
	$mohr_lv0042->lv006=$_POST['txtlv006'];
	$mohr_lv0042->lv829=$_POST['txtlv829'];
	$mohr_lv0042->DateFrom=$_POST['txtDateFrom'];
	$mohr_lv0042->DateTo=$_POST['txtDateTo'];
	$mohr_lv0042->FullName=$_POST['txtFullName'];
	
}
$mohr_lv0042->lv012=$_GET['DNPCID'] ?? '';

	if (!isset($_GET['ID']) || $_GET['ID'] == '') 
	$mohr_lv0042->lv002=$_POST['txtlv002'] ?? '';
else
	$mohr_lv0042->lv002= $_GET['ID'] ?? '';
$mohr_lv0042->lv003=$_GET['ChildID'] ?? '';
$mohr_lv0042->ArrPush[0]=$vLangArr[17];
$mohr_lv0042->ArrPush[1]=$vLangArr[18];
$mohr_lv0042->ArrPush[2]=$vLangArr[20];
$mohr_lv0042->ArrPush[3]=$vLangArr[21];
$mohr_lv0042->ArrPush[4]=$vLangArr[22];
$mohr_lv0042->ArrPush[5]=$vLangArr[23];
$mohr_lv0042->ArrPush[6]=$vLangArr[24];
$mohr_lv0042->ArrPush[7]=$vLangArr[25];
$mohr_lv0042->ArrPush[8]=$vLangArr[33];
$mohr_lv0042->ArrPush[9]=$vLangArr[39];
$mohr_lv0042->ArrPush[10]=$vLangArr[40];
$mohr_lv0042->ArrPush[11]='Ghi chú';
$mohr_lv0042->ArrPush[13]='Mã liên kết';
$mohr_lv0042->ArrPush[14]='Trạng thái khoá';
$mohr_lv0042->ArrPush[28]='Trạng thái duyệt';
$mohr_lv0042->ArrPush[33]='Tên nhân viên';

$mohr_lv0042->ArrPush[21]='Số tháng';
$mohr_lv0042->ArrPush[22]='Tổng tiền';
$mohr_lv0042->ArrPush[23]='Đã trừ';
$mohr_lv0042->ArrPush[24]='Còn lại';

$mohr_lv0042->ArrFunc[0]='//Function';
$mohr_lv0042->ArrFunc[1]=$vLangArr[2];
$mohr_lv0042->ArrFunc[2]=$vLangArr[4];
$mohr_lv0042->ArrFunc[3]=$vLangArr[6];
$mohr_lv0042->ArrFunc[4]=$vLangArr[7];
$mohr_lv0042->ArrFunc[5]='';
$mohr_lv0042->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mohr_lv0042->ArrFunc[7]=GetLangExcept('UnApr',$plang);;
$mohr_lv0042->ArrFunc[8]=$vLangArr[10];
$mohr_lv0042->ArrFunc[9]=$vLangArr[12];
$mohr_lv0042->ArrFunc[10]=$vLangArr[0];
$mohr_lv0042->ArrFunc[11]=$vLangArr[28];
$mohr_lv0042->ArrFunc[12]=$vLangArr[29];
$mohr_lv0042->ArrFunc[13]=$vLangArr[30];
$mohr_lv0042->ArrFunc[14]=$vLangArr[31];
$mohr_lv0042->ArrFunc[15]=$vLangArr[32];
////Other
$mohr_lv0042->ArrOther[1]=$vLangArr[26];
$mohr_lv0042->ArrOther[2]=$vLangArr[27];

if($mohr_lv0042->lv003=='')
{
	//$mohr_lv0042->lv003=$mohr_lv0042->LV_LoadContractApr($mohr_lv0042->lv002);
	//$mohr_lv0042->LV_Disable();
}
if($maxRows ==0) $maxRows = 10;
if(!isset($_POST['txtFlag']))
{
	$_POST['txtIsHU0']=0;
	$mohr_lv0042->IsHU0T=$_POST['txtIsHU0'];
}
else
{
	$mohr_lv0042->IsHU0T=$_POST['txtIsHU0'];
}
$totalRowsC=$mohr_lv0042->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engines.js"></script>	
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
</head>
<script language="JavaScript" type="text/javascript">
<!--
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $mohr_lv0042->lv002;?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID=<?php echo $_GET['ChildID']?>&DNPCID=<?php echo $_GET['DNPCID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe height=500 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>hr_lv0042?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID=<?php echo $_GET['ChildID']?>&DNPCID=<?php echo $_GET['DNPCID']?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function BaCaoTheoMau()
{
	
	var vValue='';
	var o=document.frmprocess;
	var o1=document.frmchoose;
	o.txtlv004.value=o1.txtlv004.value;
	o.txtlv899.value=o1.txtlv899.value;
	o.txtlv801.value=o1.txtlv801.value;
	o.txtFullName.value=o1.txtFullName.value;
	o.txtlv829.value=o1.txtlv829.value;
	o.txtDateFrom.value=o1.txtDateFrom.value;
	o.txtDateTo.value=o1.txtDateTo.value;
	o.target="_blank";
	o.action="<?php echo $vDir;?>hr_lv0036?func=<?php echo $_GET['func'];?>&childfunc=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function Approvals(vValue)
{
	if(confirm("Bạn có muốn khoá không(Y/N)?"))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=3;
		o.target="_self";
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
	 	o.submit();
	}
}
function UnApr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function UnApprovals(vValue)
{
	if(confirm("Bạn có muốn mơ khoá không(Y/N)?"))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.target="_self";
		o.txtFlag.value=4;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
	 	o.submit();
	}
}
function LocDuLieu()
{
	var o=document.frmchoose;
	o.txtFlag.value=2;
	o.submit();
}
function BaCaoTheoMau()
{
	
	var vValue='';
	var o1=document.frmchoose;
	o.txtlv002.value=o1.txtlv002.value;
	o.txtlv829.value=o1.txtlv829.value;
	o.txtDateFrom.value=o1.txtDateFrom.value;
	o.txtDateTo.value=o1.txtDateTo.value;
	o.target="_blank";
	o.action="<?php echo $vDir;?>hr_lv0042?func=<?php echo $_GET['func'];?>&childfunc=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
//-->
</script>
<?php

if($mohr_lv0042->GetView()==1 || ($_GET['DNPCID']!=''))
{

?>
<body  onkeyup="KeyPublicRun(event)">

			
					<form method="get" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
						<input name="childfunc" type="hidden" id="childfunc" value="rpt1" />
						<input name="lang" type="hidden" id="lang" value="<?php echo $plang;?>" />
						<input type="hidden"  name="txtlv899" id="txtlv899" value="<?php echo $mohr_lv0042->lv899;?>"/>
						<input type="hidden" name="txtlv801" id="txtlv801" value="<?php echo $mohr_lv0042->lv801;?>"/>
						<input type="hidden" name="txtFullName" id="txtFullName" autocomplete="off" maxlength="255" style="width:100%;min-width:120px;" value="<?php echo $mohr_lv0042->FullName;?>"/>
						<input type="hidden" name="txtlv829" id="txtlv829" value="<?php echo $mohr_lv0042->lv829;?>"/>
						<input type="hidden" name="txtDateFrom" id="txtDateFrom" value="<?php echo $mohr_lv0042->DateFrom;?>" />
						<input type="hidden" name="txtDateTo" id="txtDateTo" value="<?php echo $mohr_lv0042->DateTo;?>" />					
				  	</form>	
					<div>
  <div id="lvleft">
    <form onsubmit="return false;" 
          action="?func=<?= htmlspecialchars($_GET['func'] ?? '') ?>
                   &childfunc=<?= htmlspecialchars($_GET['childfunc'] ?? '') ?>
                   &ChildID=<?= htmlspecialchars($_GET['ChildID'] ?? '') ?>
                   &DNPCID=<?= htmlspecialchars($_GET['DNPCID'] ?? '') ?>
                   &ID=<?= htmlspecialchars( $_GET['ID'] ?? '') ?>
                   &<?= getsaveget($plang, $popt, $pitem, $plink, $pgroup, 0, 0, 1, 0); ?>" 
          method="post" 
          name="frmchoose" 
          id="frmchoose">
					<?php
					if (isset($_GET['DNPCID']) && $_GET['DNPCID'] != "")
					{
						?>
					<table width="800" border="0" cellpadding="2" cellspacing="2" style="background:#f2f2f2;font:10px arial"><tr>
							<tr>
								<td align="center"><input style="width:150px" type="button" value="Báo cáo" onclick="BaCaoTheoMau()"/></td>
								<td align="center"><?php echo "Mã nhân viên";?> </td>
								<td align="center"><?php echo "Đánh giá từ ngày";?> </td>
								<td align="center"><?php echo "đến ngày";?> </td>
								<td align="center"><?php echo "Chỉ hiển thị còn nợ";?> </td>
							</tr>
							<tr>
								<td align="center"><input style="width:150px" type="button" value="Lọc đánh giá" onclick="LocDuLieu()"/></td>
								<td>
									<table width="100%">
											<tr>
											<td>
												<ul id="pop-nav" lang="pop-nav33" onmouseover="ChangeName(this,33)">
													<li class="menupopT">
													<input name="txtlv002" id="txtlv002"  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv002','hr_lv0020','lv001','concat(lv002,@! - @!,lv001)')" value="<?php echo $_POST['txtlv002'];?>" style="width:120px" tabindex="8" maxlength="50" onKeyPress="return CheckKey(event,7)" onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};">
														<div id="lv_popup" lang="lv_popup33"> </div>
													</li>
												</ul>
												</td>
											</tr>
										</table>	
								</td>
								
								<td align="center"><input type="text"  tabindex="1" name="txtDateFrom" id="txtDateFrom" value="<?php echo $mohr_lv0042->DateFrom;?>" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.txtDateFrom);return false;"/></td>
								<td align="center"><input type="text"  tabindex="1" name="txtDateTo" id="txtDateTo" value="<?php echo $mohr_lv0042->DateTo;?>"  onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.txtDateTo);return false;"/></td>
								<td> <input type="checkbox"  tabindex="8" name="txtIsHU0" id="txtIsHU0" value="1" <?php echo ($mohr_lv0042->IsHU0T==1)?'checked="true"':'';?> onKeyPress="return CheckKey(event,7)" onclick="LocDuLieu()"/></td>
							</tr>
						</table>
					<?php
					}
					else
					{
						$mohr_lv0042->LV_GetAnAll();
					}
					?>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0042->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0042->lv001;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mohr_lv0042->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mohr_lv0042->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mohr_lv0042->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mohr_lv0042->lv006;?>"/>
				  </form>
				  <iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>				  				  
				  
</div></div>
</body>
				
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mohr_lv0042->ArrPush[0];?>';	
</script>
</html>