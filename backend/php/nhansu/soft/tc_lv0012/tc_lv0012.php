<?php
$vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/tc_lv0012.php");
require_once("$vDir../clsall/tc_lv0009.php");
require_once("$vDir../clsall/tc_lv0013.php");
/////////////init object//////////////
$motc_lv0012=new tc_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0012');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$motc_lv0012->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$month=getmonth($_POST['txtMonthYear']);
$year=getyear($_POST['txtMonthYear']);
if($month=='' || $month==NULL)
{

	$motc_lv0013->LV_LoadActiveID();
	$vNow=$motc_lv0013->lv004;
	$month=Fillnum($motc_lv0013->lv006,2);
	$year=Fillnum($motc_lv0013->lv007,4);
}

$motc_lv0012->lv004=$year."-".$month;
if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","TC0033.txt",$plang);
$motc_lv0012->lang=$plang;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0012->ArrPush[0]=$vLangArr[17];
$motc_lv0012->ArrPush[1]=$vLangArr[18];
$motc_lv0012->ArrPush[2]=$vLangArr[20];
$motc_lv0012->ArrPush[3]=$vLangArr[21];
$motc_lv0012->ArrPush[4]=$vLangArr[22];
$motc_lv0012->ArrPush[5]=$vLangArr[23];
$motc_lv0012->ArrPush[6]=$vLangArr[24];
$motc_lv0012->ArrPush[7]=$vLangArr[25];
$motc_lv0012->ArrPush[8]=$vLangArr[26];
$motc_lv0012->ArrPush[9]=$vLangArr[27];
$motc_lv0012->ArrPush[10]=$vLangArr[28];
$motc_lv0012->ArrPush[11]=$vLangArr[29];

$motc_lv0012->ArrFunc[0]='//Function';
$motc_lv0012->ArrFunc[1]=$vLangArr[2];
$motc_lv0012->ArrFunc[2]=$vLangArr[4];
$motc_lv0012->ArrFunc[3]=$vLangArr[6];
$motc_lv0012->ArrFunc[4]=$vLangArr[7];
$motc_lv0012->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$motc_lv0012->ArrFunc[6]=GetLangExcept('Apr',$plang);
$motc_lv0012->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$motc_lv0012->ArrFunc[8]=$vLangArr[10];
$motc_lv0012->ArrFunc[9]=$vLangArr[12];
$motc_lv0012->ArrFunc[10]=$vLangArr[0];
$motc_lv0012->ArrFunc[11]=$vLangArr[32];
$motc_lv0012->ArrFunc[12]=$vLangArr[33];
$motc_lv0012->ArrFunc[13]=$vLangArr[34];
$motc_lv0012->ArrFunc[14]=$vLangArr[35];
$motc_lv0012->ArrFunc[15]=$vLangArr[36];
////Other
$motc_lv0012->ArrOther[1]=$vLangArr[30];
$motc_lv0012->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];
if(strpos($vFieldList,'lv001')===false) $vFieldList='lv001,'.$vFieldList;
$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if(isset($_GET['ajax']))
{
	echo '[CHECK]';
		$motc_lv0012->lvNVID=$_GET['vEmployeeID'];
		if($_GET['vopt']==2)
			$motc_lv0012->LV_UpdateStateOverTime($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vTime'],$_GET['vopt'],getInfor($_SESSION['ERPSOFV2RUserID'],2));
		else
			$motc_lv0012->LV_UpdateState($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vTime'],$_GET['vopt'],getInfor($_SESSION['ERPSOFV2RUserID'],2));
		echo $motc_lv0012->GetTimeListOutOff($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vid'],1);
	echo '[ENDCHECK]';
	echo '[CHECKID]';
	echo $_GET['vid'];
	echo '[ENDCHECKID]';
	exit;
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0012->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0012');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0012->ListView;
$curPage = $motc_lv0012->CurPage;
$maxRows =$motc_lv0012->MaxRows;
$vOrderList=$motc_lv0012->ListOrder;
$vSortNum=$motc_lv0012->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$motc_lv0012->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0012',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$motc_lv0012->lvNVID= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0012->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
if($flagID==1)
{
	$motc_lv0012->lv004=$year."-".$month."-01";
	for($i=$curRow+1;$i<$maxRows+$curRow+1;$i++)
	{
		$motc_lv0012->lv001=$motc_lv0012->lvNVID;
		$motc_lv0012->lv002=$_POST['txtlv004'.$i];
		$motc_lv0012->lv005=$motc_lv0012->Get_User($_SESSION['ERPSOFV2RUserID'],'lv006');
		$motc_lv0012->lv003=trim($_POST['txtlv006'.$i]);
		$motc_lv0012->lv004='I';
		if($motc_lv0012->lv003!='') $motc_lv0012->LV_Insert();
		$motc_lv0012->lv003=trim($_POST['txtlv007'.$i]);
		$motc_lv0012->lv004='O';
		if($motc_lv0012->lv003!='') $motc_lv0012->LV_Insert();				
	}
	$motc_lv0012->lv002='';
	$motc_lv0012->lv003='';
	$motc_lv0012->lv004=$year."-".$month;
	$motc_lv0012->lv001='';
		$motc_lv0012->lv005='';
		$motc_lv0012->lv006='';
		$motc_lv0012->lv007='';
		$motc_lv0012->lv008='';
		$motc_lv0012->lv010='';
	
}
elseif($flagID==3)
{
	$vresult=$motc_lv0012->LV_Aproval($year."-".$month."-01");
}
elseif($flagID==4)
{
	$vresult=$motc_lv0012->LV_UnAproval($year."-".$month."-01");
}
$motc_lv0009->LV_LoadMonthID($motc_lv0012->lvNVID,$month,$year);
$motc_lv0012->lv004=$year."-".$month;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<style type="text/css">
.lvsizeinput
{width:80px;
border:1;
}
.lvsizeinput2
{width:180px;
border:1;
}
.lvsizeselect
{width:160px;
border:1;
}
.lvsizeselect2
{width:60px;
border:1;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
</head>
<script language="JavaScript" type="text/javascript">
<?php 
if($motc_lv0012->GetView()==1)
{
?>
function deltime(vEmployeeID,vDate,vTime,vid)
{
	ChangeCompanyID(vEmployeeID,vDate,vTime,vid,1);
}
function overtime(vEmployeeID,vDate,vTime,vid)
{
	ChangeCompanyID(vEmployeeID,vDate,vTime,vid,2);
}
function undeltime(vEmployeeID,vDate,vTime,vid)
{
	ChangeCompanyID(vEmployeeID,vDate,vTime,vid,0);
}
function ChangeCompanyID(vEmployeeID,vDate,vTime,vid,vopt)
{
	$xmlhttp=null;
	
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajax=ajaxcheck"+"&vEmployeeID="+vEmployeeID+'&vDate='+vDate+'&vTime='+vTime+'&vid='+vid+'&vopt='+vopt;
	url=url.replace("#","");
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}
function stateChanged()
{
	if (xmlhttp.readyState==4)
	{
		var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
		var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		var startdomain=xmlhttp.responseText.indexOf('[CHECKID]')+9;
		var enddomain=xmlhttp.responseText.indexOf('[ENDCHECKID]');
		var divid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById(divid).innerHTML=domainid;
	}
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
<?php 
}
?>
<!--
function FunctRunning1(vID)
{
RunFunction(vID,'child');
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>','filter');
}
function Save()
	{
		var o=document.frmchoose;

				o.txtFlag.value="1";
				o.submit();
		
	}

//////////////RunFunction/////////////////////////
function RunFunction(vID,func)
{
	var str="<br><iframe height=1000 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>tc_lv0012?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
	
}

function Apr()
{
var o=document.frmchoose;
	o.txtFlag.value=3;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,6,0);?>"
	 o.submit();
}
function UnApr()
{
var o=document.frmchoose;
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,6,0);?>"
	 o.submit();
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
///////////////////////////Report/////////////////////
function Report(vValue)
{
var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>tc_lv0012?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function ChangeTimeCard(o)
{
var o1=document.frmchoose;
 	o1.submit();
}
function ChangeTimeCard1(o)
{
var o1=document.frmchoose;
	o1.txtMonthYear.value=o.value;
 	o1.submit();
}
function ChangePre()
{
var o1=document.frmchoose;
var month=parseFloat( o1.month.value);
var year=parseFloat(o1.year.value);
if(month==1)
{
	year=year-1;
	month=12;
	SetYear(year);
}
else
{
	month=month-1;
}
if(month>=10)
	o1.txtMonthYear.value=year+'-'+month;
else
	o1.txtMonthYear.value=year+'-0'+month;
 	o1.submit();
}
function ChangeNext()
{
var o1=document.frmchoose;
var month=parseFloat( o1.month.value);
var year=parseFloat(o1.year.value);

if(month==parseFloat(12))
{
	year=year+1;
	month=1;
	SetYear(year);
}
else
{
	month=parseFloat(month)+1;


}
if(month>=parseFloat(10))
{
	o1.txtMonthYear.value=year+'-'+month;
}
else
{
	o1.txtMonthYear.value=year+'-0'+month;
}
 	o1.submit();
}
function SetYear(years)
{
var o1=document.frmchoose;
	for(i=0;i<12;i++)
	{
	 if(parseInt(i)<10)
	 	o1.txtMonthYear.options[i].value=years+'-0'+(i+1);
	 else 
	 	o1.txtMonthYear.options[i].value=years+'-'+(i+1);
	
	}
	
}
//-->
</script>
<?php
if($motc_lv0012->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft">
                    <div> Tên:<?php echo GetUserName($motc_lv0012->lvNVID,$plang);?></div>
                    <form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['child'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,6,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <p>
					    <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					   
					    <input type="button" id="txtPre" name="txtPre" value="Previous" onClick="ChangePre()">
					   
					    <select id="txtMonthYear" name="txtMonthYear" onChange="ChangeTimeCard(this)">
						
					<?php
						
						for($i=1;$i<13;$i++)
						{
						if((int)$month==$i)
							echo '<option selected="selected" value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						else
							echo '<option value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						}
					?>	
					</select><input type="button" id="txtPre" name="txtPre" value="Next" onClick="ChangeNext()"> <?php echo $vLangArr[38];?> <input type="text" id="txtPara" name="txtPara" value="<?php echo $motc_lv0009->lv007;?>" />
					    <?php 
						echo $motc_lv0012->LV_BuilListInput($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					    <input name="txtStringID" type="hidden" id="txtStringID" />
					    <input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
					    <input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
					    <input name="txtFlag" type="hidden" id="txtFlag" value="2"/><input type="button" id="txtPre" name="txtPre" value="Previous" onClick="ChangePre()"><select id="txtMonthYear1" name="txtMonthYear1" onChange="ChangeTimeCard1(this)">
						
					<?php
						
						for($i=1;$i<13;$i++)
						{
						if((int)$month==$i)
							echo '<option selected="selected" value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						else
							echo '<option value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						}
					?>	
					</select><input type="button" id="txtPre" name="txtPre" value="Next" onClick="ChangeNext()">
					<input type="hidden" name="month" id="month" value="<?php echo $month;?>"/>
					<input type="hidden" name="year" id="year" value="<?php echo $year;?>"/>
					</form>
				<form method="post" enctype="multipart/form-data" name="frmprocess" > 
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
div.innerHTML='<?php echo $motc_lv0012->ArrPush[0];?>';	
</script>
</html>