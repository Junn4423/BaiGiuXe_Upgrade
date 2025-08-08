<?php
$vDir = '';
if (isset($_GET['ID']) && $_GET['ID'] != '') {
    $vDir = '../';
}
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/hr_lv0036.php");

/////////////init object//////////////
$mohr_lv0036=new hr_lv0036($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0055');
$mohr_lv0036->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","HR0011.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0036->ArrPush[0]=$vLangArr[17];
$mohr_lv0036->ArrPush[1]=$vLangArr[18];
$mohr_lv0036->ArrPush[2]=$vLangArr[20];
$mohr_lv0036->ArrPush[3]=$vLangArr[21];
$mohr_lv0036->ArrPush[4]=$vLangArr[22];
$mohr_lv0036->ArrPush[5]=$vLangArr[23];
$mohr_lv0036->ArrPush[6]=$vLangArr[24];
$mohr_lv0036->ArrPush[7]=$vLangArr[25];
$mohr_lv0036->ArrPush[8]='Tiền phạt';
$mohr_lv0036->ArrPush[9]='Khoá';
$mohr_lv0036->ArrPush[10]='Người tạo';
$mohr_lv0036->ArrPush[11]='Ngày giờ tạo';
$mohr_lv0036->ArrPush[100]=$vLangArr[33];

$mohr_lv0036->ArrFunc[0]='//Function';
$mohr_lv0036->ArrFunc[1]=$vLangArr[2];
$mohr_lv0036->ArrFunc[2]=$vLangArr[4];
$mohr_lv0036->ArrFunc[3]=$vLangArr[6];
$mohr_lv0036->ArrFunc[4]=$vLangArr[7];

$mohr_lv0036->ArrFunc[5]='';
$mohr_lv0036->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mohr_lv0036->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mohr_lv0036->ArrFunc[8]=$vLangArr[10];
$mohr_lv0036->ArrFunc[9]=$vLangArr[12];
$mohr_lv0036->ArrFunc[10]=$vLangArr[0];
$mohr_lv0036->ArrFunc[11]=$vLangArr[28];
$mohr_lv0036->ArrFunc[12]=$vLangArr[29];
$mohr_lv0036->ArrFunc[13]=$vLangArr[30];
$mohr_lv0036->ArrFunc[14]=$vLangArr[31];
$mohr_lv0036->ArrFunc[15]=$vLangArr[32];
////Other
$mohr_lv0036->ArrOther[1]=$vLangArr[26];
$mohr_lv0036->ArrOther[2]=$vLangArr[27];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0036->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0036",$lvMessage);
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0036->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0036->LV_UnAproval($strar);
}
if($flagID>0)
{
	$mohr_lv0036->lv001=$_POST['txtlv001'];
	$mohr_lv0036->lv002= $_GET['ID'] ?? '';
	$mohr_lv0036->lv003=$_POST['txtlv003'];
	$mohr_lv0036->lv004=$_POST['txtlv004'];
	$mohr_lv0036->lv005=$_POST['txtlv005'];
	$mohr_lv0036->lv006=$_POST['txtlv006'];
	$mohr_lv0036->lv007=$_POST['txtlv007'];
	$mohr_lv0036->lv899=$_POST['txtlv899'];
	$mohr_lv0036->lv801=$_POST['txtlv801'];
	$mohr_lv0036->lv829=$_POST['txtlv829'];
	$mohr_lv0036->DateFrom=$_POST['txtDateFrom'];
	$mohr_lv0036->DateTo=$_POST['txtDateTo'];
	$mohr_lv0036->FullName=$_POST['txtFullName'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0036->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0036');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0036->ListView;
$curPage = $mohr_lv0036->CurPage;
$maxRows =$mohr_lv0036->MaxRows;
$vOrderList=$mohr_lv0036->ListOrder;
$vSortNum=$mohr_lv0036->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0036->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0036',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mohr_lv0036->lv002= $_GET['ID'] ?? '';
if(!isset($_POST['txtFlag']))
{
	$_POST['txtIsHU0']=1;
	$mohr_lv0036->IsHU0T=$_POST['txtIsHU0'];
}
else
{
	$mohr_lv0036->IsHU0T=$_POST['txtIsHU0'];
}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0036->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,12,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe height=500 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>hr_lv0036?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function LocDuLieu()
{
	var o=document.frmchoose;
	o.txtFlag.value=2;
	o.submit();
}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function Approvals(vValue)
{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=3;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
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
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
	 o.submit();
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
//-->
</script>
<?php
if($mohr_lv0036->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft">
					<form method="get" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
						<input name="childfunc" type="hidden" id="childfunc" value="rpt1" />
						<input name="lang" type="hidden" id="lang" value="<?php echo $plang;?>" />
						<input type="hidden" name="txtlv004"  autocomplete="off" >
						<input type="hidden"  name="txtlv899" value="<?php echo $mohr_lv0036->lv899;?>"/>
						<input type="hidden" name="txtlv801" value="<?php echo $mohr_lv0036->lv801;?>"/>
						<input type="hidden" name="txtFullName"  autocomplete="off" maxlength="255" style="width:100%;min-width:120px;" value="<?php echo $mohr_lv0036->FullName;?>"/>
						<input type="hidden" name="txtlv829" value="<?php echo $mohr_lv0036->lv829;?>"/>
						<input type="hidden" name="txtDateFrom" value="<?php echo $mohr_lv0036->DateFrom;?>" />
						<input type="hidden" name="txtDateTo" value="<?php echo $mohr_lv0036->DateTo;?>" />					
				  	</form>	
					<form onsubmit="return false;"
      action="?func=<?= htmlspecialchars($_GET['func'] ?? '') ?>&ID=<?= htmlspecialchars( $_GET['ID'] ?? '') ?>&<?= getsaveget($plang, $popt, $pitem, $plink, $pgroup, 0, 0, 12, 0); ?>"
      method="post"
      name="frmchoose"
      id="frmchoose">
					  	<input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						  <table width="800" border="0" cellpadding="2" cellspacing="2" style="background:#f2f2f2;font:10px arial"><tr>
							<tr>
								<td align="center"><input style="width:150px" type="button" value="Báo cáo" onclick="BaCaoTheoMau()"/></td>
								<td align="center"><?php echo "Nội dung";?> </td>
								<td align="center"><?php echo "Mã CC";?> </td>
								<td align="center"><?php echo "Mã nhân viên";?> </td>
								<td align="center"><?php echo "Tên nhân viên";?> </td>
								<td align="center"><?php echo "Phòng ban";?> </td>
								<td align="center"><?php echo "Đánh giá từ ngày";?> </td>
								<td align="center"><?php echo "đến ngày";?> </td>
								<td align="center"><?php echo "Ẩn HU0";?> </td>
							</tr>
							<tr>
								<td align="center"><input style="width:150px" type="button" value="Lọc đánh giá" onclick="LocDuLieu()"/></td>
								<td>
									<table width="100%">
											<tr>
											<td>
												<ul id="pop-nav33" lang="pop-nav33" onmouseover="ChangeName(this,33)">
													<li class="menupopT">
													<input name="txtlv004" id="txtlv004" autocomplete="off"
       onkeyup="LoadSelfNextParent(this,'txtlv004','hr_lv0035','lv001','concat(lv002,@! - @!,lv001)')"
       value="<?= htmlspecialchars($_POST['txtlv001'] ?? '') ?>"
       style="width:120px" tabindex="8" maxlength="50"
       onKeyPress="return CheckKey(event,7)"
       onblur="if(this.value.substr(this.value.length-1)==','){this.value=this.value.slice(0,-1);}">

														<div id="lv_popup33" lang="lv_popup33"> </div>
													</li>
												</ul>
												</td>
											</tr>
										</table>	
								</td>
								<td align="center"><input style="width:80px" type="text" name="txtlv899" id="txtlv899" tabindex="1" value="<?php echo $mohr_lv0036->lv899;?>"/></td>
								<td align="center"><input style="width:120px" type="text" name="txtlv801" id="txtlv801" tabindex="1" value="<?php echo $mohr_lv0036->lv801;?>"/></td>
								<td align="center">
									<ul lang="pop-nav1" onmouseover="ChangeName(this,1)" id="pop-nav"> <li class="menupopT"> <input onKeyPress="return CheckEnter(event)"  name="txtFullName" id="txtFullName" autocomplete="off"  tabindex="1" maxlength="255" style="width:100%;min-width:120px;" value="<?php echo $mohr_lv0036->FullName;?>" onKeyUp="LoadSelfNextParent(this,'txtFullName','hr_lv0020','lv002','lv002')" onFocus="LoadSelfNextParent(this,'txtFullName','hr_lv0020','lv002','lv002')"/>
										<div id="lv_popup" lang="lv_popup1"> </div>						  
										</li>
									</ul>
								</td>
								<td align="center"><input type="text"  tabindex="1" name="txtlv829" id="txtlv829" value="<?php echo $mohr_lv0036->lv829;?>"/></td>
								<td align="center"><input type="text"  tabindex="1" name="txtDateFrom" id="txtDateFrom" value="<?php echo $mohr_lv0036->DateFrom;?>" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.txtDateFrom);return false;"/></td>
								<td align="center"><input type="text"  tabindex="1" name="txtDateTo" id="txtDateTo" value="<?php echo $mohr_lv0036->DateTo;?>"  onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.txtDateTo);return false;"/></td>
								<td> <input type="checkbox"  tabindex="8" name="txtIsHU0" id="txtIsHU0" value="1" <?php echo ($mohr_lv0036->IsHU0T==1)?'checked="true"':'';?> onKeyPress="return CheckKey(event,7)" onclick="LocDuLieu()"/></td>
							</tr>
						</table>	
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0036->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $mohr_lv0036->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mohr_lv0036->lv003;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mohr_lv0036->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mohr_lv0036->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mohr_lv0036->lv007;?>"/>
					    <?php echo $mohr_lv0036->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
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
div.innerHTML='<?php echo $mohr_lv0036->ArrPush[0];?>';	
</script>
</html>