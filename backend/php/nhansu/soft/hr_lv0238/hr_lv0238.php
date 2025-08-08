<?php
$vDir = '';
if (isset($_GET['ID']) && $_GET['ID'] != '') {
    $vDir = '../';
}
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/hr_lv0238.php");
require_once("$vDir../clsall/tc_lv0064.php");
/////////////init object//////////////
$mohr_lv0238=new hr_lv0238($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0238');
$motc_lv0064=new tc_lv0064($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0238');
$mohr_lv0238->motc_lv0064=$motc_lv0064;
$mohr_lv0238->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","HR0123.txt",$plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0238->ArrPush[0]=$vLangArr[17];
$mohr_lv0238->ArrPush[1]=$vLangArr[18];
$mohr_lv0238->ArrPush[2]=$vLangArr[20];
$mohr_lv0238->ArrPush[3]=$vLangArr[21];
$mohr_lv0238->ArrPush[4]=$vLangArr[22];
$mohr_lv0238->ArrPush[5]=$vLangArr[23];
$mohr_lv0238->ArrPush[6]=$vLangArr[24];
$mohr_lv0238->ArrPush[7]=$vLangArr[25];
$mohr_lv0238->ArrPush[8]=$vLangArr[26];
$mohr_lv0238->ArrPush[9]=$vLangArr[27];
$mohr_lv0238->ArrPush[10]=$vLangArr[28];
$mohr_lv0238->ArrPush[11]=$vLangArr[36];
$mohr_lv0238->ArrPush[12]=$vLangArr[37];
$mohr_lv0238->ArrPush[13]=$vLangArr[38];
$mohr_lv0238->ArrPush[14]=$vLangArr[39];
$mohr_lv0238->ArrPush[15]=$vLangArr[40];
$mohr_lv0238->ArrPush[16]=$vLangArr[41];
$mohr_lv0238->ArrPush[17]=$vLangArr[42];
$mohr_lv0238->ArrPush[18]=$vLangArr[43];
$mohr_lv0238->ArrPush[19]=$vLangArr[44];
$mohr_lv0238->ArrPush[20]=$vLangArr[45];
$mohr_lv0238->ArrPush[21]=$vLangArr[46];
$mohr_lv0238->ArrPush[22]=$vLangArr[47];
$mohr_lv0238->ArrPush[23]=$vLangArr[48];
$mohr_lv0238->ArrPush[24]=$vLangArr[49];
$mohr_lv0238->ArrPush[25]=$vLangArr[50];
$mohr_lv0238->ArrPush[26]=$vLangArr[51];
$mohr_lv0238->ArrPush[27]=$vLangArr[52];
$mohr_lv0238->ArrPush[28]=$vLangArr[53];
$mohr_lv0238->ArrPush[29]=$vLangArr[54];
$mohr_lv0238->ArrPush[30]=$vLangArr[55];
$mohr_lv0238->ArrPush[31]=$vLangArr[56];

$mohr_lv0238->ArrPush[32]=$vLangArr[60];
$mohr_lv0238->ArrPush[33]=$vLangArr[61];
$mohr_lv0238->ArrPush[34]=$vLangArr[62];
$mohr_lv0238->ArrPush[35]=$vLangArr[72];
$mohr_lv0238->ArrPush[36]=$vLangArr[73];
$mohr_lv0238->ArrPush[37]=$vLangArr[74];
$mohr_lv0238->ArrPush[38]=$vLangArr[75];

$mohr_lv0238->ArrPush[99]=$vLangArr[71];
$mohr_lv0238->ArrPush[100]=$vLangArr[57];
$mohr_lv0238->ArrPush[111]=$vLangArr[58];
$mohr_lv0238->ArrPush[101]=$vLangArr[59];
$mohr_lv0238->ArrPush[200]='Chức năng';
$mohr_lv0238->ArrPush[300]='KPI';

$mohr_lv0238->ArrFunc[0]='//Function';
$mohr_lv0238->ArrFunc[1]=$vLangArr[2];
$mohr_lv0238->ArrFunc[2]=$vLangArr[4];
$mohr_lv0238->ArrFunc[3]=$vLangArr[6];
$mohr_lv0238->ArrFunc[4]=$vLangArr[7];
$mohr_lv0238->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mohr_lv0238->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mohr_lv0238->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mohr_lv0238->ArrFunc[8]=$vLangArr[10];
$mohr_lv0238->ArrFunc[9]=$vLangArr[12];
$mohr_lv0238->ArrFunc[10]=$vLangArr[0];
$mohr_lv0238->ArrFunc[11]=$vLangArr[31];
$mohr_lv0238->ArrFunc[12]=$vLangArr[32];
$mohr_lv0238->ArrFunc[13]=$vLangArr[33];
$mohr_lv0238->ArrFunc[14]=$vLangArr[34];
$mohr_lv0238->ArrFunc[15]=$vLangArr[35];
////Other
$mohr_lv0238->ArrOther[1]=$vLangArr[29];
$mohr_lv0238->ArrOther[2]=$vLangArr[30];
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
	$vresult=$mohr_lv0238->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0038",$lvMessage);
}

if($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0238->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0238->LV_UnAproval($strar);
}
elseif($flagID==10)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0238->LV_ShowLich($strar);
}
elseif($flagID==11)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0238->LV_ShowLichFull($strar);
}
if($flagID>0)
{
$mohr_lv0238->lv001=$_POST['txtlv001'];
if (!isset($_GET['ID']) || $_GET['ID'] == '') 
$mohr_lv0238->lv002=$_POST['txtlv002'];
else
$mohr_lv0238->lv002= $_GET['ID'] ?? '';
$mohr_lv0238->lv003=$_POST['txtlv003'];
$mohr_lv0238->lv004=$_POST['txtlv004'];
$mohr_lv0238->lv005=$_POST['txtlv005'];
$mohr_lv0238->lv006=$_POST['txtlv006'];
$mohr_lv0238->lv007=$_POST['txtlv007'];
$mohr_lv0238->lv008=$_POST['txtlv008'];
$mohr_lv0238->lv009=$_POST['txtlv009'];
$mohr_lv0238->lv010=$_POST['txtlv010'];
$mohr_lv0238->lv011=$_POST['txtlv011'];
$mohr_lv0238->lv012=$_POST['txtlv012'];
$mohr_lv0238->lv013=$_POST['txtlv013'];
$mohr_lv0238->lv014=$_POST['txtlv014'];
$mohr_lv0238->lv021=$_POST['txtlv021'];
$mohr_lv0238->DepID=$_POST['txtDepID'];
$mohr_lv0238->FullName=$_POST['txtFullName'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0238->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0238');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0238->ListView;
$curPage = $mohr_lv0238->CurPage;
$maxRows =$mohr_lv0238->MaxRows;
$vOrderList=$mohr_lv0238->ListOrder;
$vSortNum=$mohr_lv0238->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
	$maxRows =(int)$_POST['lvmaxrow'];
	$vSortNum=(int)$_POST['lvsort'];
	$mohr_lv0238->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0238',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);
}
if (!isset($_GET['ID']) || $_GET['ID'] == '') 
$mohr_lv0238->lv002=$_POST['txtlv002'] ?? '';
else
$mohr_lv0238->lv002= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0238->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&DepID=<?php echo $_POST['txtDepID'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,24,0);?>"
	 o.submit();

}
//////////////FunctRunning1/////////////////////////
function FunctRunning1(vID)
{
RunFunction(vID,'child');
}
//////////////RunFunction/////////////////////////
function RunFunction(vID,func)
{
	var str="<br><iframe height=1000 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>hr_lv0238?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;
	ProcessHiden();
	scrollToBottom();
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,24,0);?>"
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,24,0);?>"
	 o.submit();
}
function ShowLich()
{
	lv_chk_list(document.frmchoose,'lvChk',8);
}
function FunctRunning3(vValue)
{
if(confirm("Bạn nên hiểu rõ trước khi đồng ý thực hiện tác vụ này - Chú ý chỉ thực hiện 1 lần cho 1 nhân viên ?"))
		{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=10;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,24,0);?>"
	 o.submit();
	}
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
///////////////////////////Report/////////////////////
function ShowLichFullCheck()
{
	lv_chk_list(document.frmchoose,'lvChk',11);
}
function FunctRunning4(vValue)
{
	if(confirm("Bạn nên hiểu rõ trước khi đồng ý thực hiện tác vụ này - Chú ý chỉ thực hiện 1 lần cho 1 nhân viên ?"))
		{
		var o=document.frmchoose;
	 	o.txtStringID.value=vValue;
		o.txtFlag.value=11;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,24,0);?>"
		o.submit();
	}
}	
///////////////////////////Report/////////////////////
function Report(vValue)
{
var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>hr_lv0238?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
	var fun2="Report1('"+vValue+"')";
	setTimeout(fun2,100);
}	
function Report1(vValue)
{
var o=document.frmprocess1;
	o.target="_blank";
	o.action="<?php echo $vDir;?>hr_lv0238?func=<?php echo $_GET['func'];?>&childfunc=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function showwold()
{
	lv_chk_list(document.frmchoose,'lvChk',7);
}
function FunctRunning2(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>hr_lv0238?func=<?php echo $_GET['func'];?>&childfunc=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function Save()
{
	ChangeInfor();
}
function ChangeInfor()
{
var o1=document.frmchoose;
 	o1.submit();
}
function CheckEnter(e)
{
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="13")
	{
		ChangeInfor();
	}
}
//-->
</script>
<link rel="stylesheet" href="../css/popup.css" type="text/css">
<?php
if($mohr_lv0238->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">
					<div><div id="lvleft"><form onsubmit="return false;"
      action="?func=<?= htmlspecialchars($_GET['func'] ?? '') ?>&ID=<?= htmlspecialchars( $_GET['ID'] ?? '') ?>&<?= getsaveget($plang, $popt, $pitem, $plink, $pgroup, 0, 0, 24, 0); ?>"
      method="post"
      name="frmchoose"
      id="frmchoose">

					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<table width="600" border="0" cellpadding="0" cellspacing="0" style="background:#f2f2f2;font:10px arial">
						<tr>
						<td><input  onKeyPress="return CheckEnter(event)"   style="width:80px;text-align:center" type="button" value="Tìm kiếm" onclick="ChangeInfor()"/></td>
						<td nowrap>Mã NV</td>
						<td><input  onKeyPress="return CheckEnter(event)"  type="textbox" name="txtlv002" id="txtlv002"  value="<?php echo $mohr_lv0238->lv002;?>"/></td>
						<td nowrap>Tên nhân viên</td>
						<td>
							  <ul lang="pop-nav1" onmouseover="ChangeName(this,1)" id="pop-nav"> <li class="menupopT"> <input onKeyPress="return CheckEnter(event)"  name="txtFullName" id="txtFullName" autocomplete="off"  tabindex="1" maxlength="255" style="width:200px" value="<?php echo $mohr_lv0238->FullName;?>" onKeyUp="LoadSelfNextParent(this,'txtFullName','hr_lv0020','lv002','lv002')" onFocus="LoadSelfNextParent(this,'txtFullName','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)','concat(@! @!,lv004,@! @!,lv003,@! @!,lv002)')"/><div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td><td nowrap><?php echo 'Mức lương';?></td><td>
					<input onKeyPress="return CheckEnter(event)" type="text" tabindex="1" name="txtlv021" id="txtlv021"
       value="<?= htmlspecialchars($mohr_lv0038->lv021 ?? '') ?>" onChange="ChangeInfor()" />


						<!--<td><input type="button" value="MASTER FILE" onclick="ExportMore(document.frmchoose,'xml',(document.frmchoose.isLastcHeck.checked)?1:0)"/></td>-->
						<td  height="20"><input type="checkbox" value="1" name="isLastcHeck" checked title='Chọn hợp đồng cuối'/></td>
						<!--<td><input type="button" title="<?php echo $vLangArr[65];?>" value="<?php echo $vLangArr[64];?>" onclick="showwold();"/></td><td><input type="button" value="<?php echo $vLangArr[66];?>" onclick="ShowLichFullCheck()"/></td><td><input type="button" value="<?php echo $vLangArr[67];?>" onclick="ShowLich()"/> <?php echo $vLangArr[68];?></td>--></tr></table>
						<?php echo $mohr_lv0238->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0238->lv001;?>"/>
						
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mohr_lv0238->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mohr_lv0238->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mohr_lv0238->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mohr_lv0238->lv006;?>"/>
                        <input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mohr_lv0238->lv007;?>"/>
                        <input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mohr_lv0238->lv008;?>"/>
                        <input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mohr_lv0238->lv009;?>"/>
					    <input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mohr_lv0238->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mohr_lv0238->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mohr_lv0238->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mohr_lv0238->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mohr_lv0238->lv014;?>"/>
						<input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mohr_lv0238->lv017;?>"/>
						<input type="hidden" name="txtDepID" id="txtDepID" value="<?php echo $mohr_lv0238->DepID;?>"/>
				  </form>
				<form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				</form>
				<form method="post" enctype="multipart/form-data" name="frmprocess1" > 
				  	<input name="txtID" type="hidden" id="txtID" />
				</form>  
</div></div>
</body>
				
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mohr_lv0238->ArrPush[0];?>';	
</script>
</html>