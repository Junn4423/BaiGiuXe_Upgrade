<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/tc_lv0042.php");
require_once("$vDir../clsall/tc_lv0009.php");
require_once("$vDir../clsall/tc_lv0008.php");
require_once("$vDir../clsall/tc_lv0013.php");
require_once("$vDir../clsall/tc_lv0011.php");
require_once("$vDir../clsall/hr_lv0020.php");
require_once("$vDir../clsall/tc_lv0002.php");
require_once("$vDir../clsall/tc_lv0060.php");
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
/////////////init object//////////////
$motc_lv0042=new tc_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0042');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$motc_lv0042->Dir=$vDir;
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$motc_lv0002=new tc_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0002');
$motc_lv0060=new tc_lv0060($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0060');
$motc_lv0042->is_tc09_add=$motc_lv0042->GetAdd();
$motc_lv0042->is_tc09_apr=$motc_lv0042->GetApr();
$motc_lv0042->is_tc09_unapr=$motc_lv0042->GetUnApr();
$month=getmonth($_POST['txtMonthYear']);
$year=getyear($_POST['txtMonthYear']);
if($month=='' || $month==NULL)
{
	$motc_lv0013->LV_LoadActiveID();
	$vNow=$motc_lv0013->lv004;
	$month=Fillnum($motc_lv0013->lv006,2);
	$year=Fillnum($motc_lv0013->lv007,4);
}
if($motc_lv0042->GetAdd()==1)
{
	if(isset($_GET['ajax222']))
	{
		echo '[CHECK]';
			$motc_lv0060->lvNVID=$_GET['vEmployeeID'];
			if($_GET['vopt']==3)
			{
				$motc_lv0060->LV_InsertAuto($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vTime'],0,getInfor($_SESSION['ERPSOFV2RUserID'],2));
			}
			else if($_GET['vopt']==2)
				$motc_lv0060->LV_UpdateStateOverTime($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vTime'],$_GET['vopt'],getInfor($_SESSION['ERPSOFV2RUserID'],2));
			else
				$motc_lv0060->LV_UpdateState($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vTime'],$_GET['vopt'],getInfor($_SESSION['ERPSOFV2RUserID'],2));
			echo $motc_lv0042->GetTimeListOutOff($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vid'],1,1);
		echo '[ENDCHECK]';
		echo '[CHECKID]';
		echo $_GET['vid'];
		echo '[ENDCHECKID]';
		exit;
	}
	if(isset($_GET['ajaxpro']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0042->lvNVID=$_GET['NVID'];
			if($codeid=='A' || $codeid=='HA') 
			{
				$vReturn=$motc_lv0008->LV_CheckOne_FNCB($_GET['NVID'],$year,0);
				if($vReturn>0)
				{
					$motc_lv0042->LV_UpdateCode($timeid,$codeid);
				}
				echo '[CONGP]';
					echo $vReturn;
				echo '[ENDCONGP]';
				echo '[CONGPDEF]';
					echo $codeid;
				echo '[ENDCONGPDEF]';
				echo '[CONGPDIS]';
					echo $timeid;
				echo '[ENDCONGPDIS]';
			}
			elseif($codeid=='B')
			{
				$vReturn=$motc_lv0008->LV_CheckOne_FNCB($_GET['NVID'],$year,1);
				if($vReturn>0)
				{
					$motc_lv0042->LV_UpdateCode($timeid,$codeid);
				}
				echo '[CONGP]';
					echo $vReturn;
				echo '[ENDCONGP]';
				echo '[CONGPDEF]';
					echo $codeid;
				echo '[ENDCONGPDEF]';
				echo '[CONGPDIS]';
					echo $timeid;
				echo '[ENDCONGPDIS]';
			}
			else
				$motc_lv0042->LV_UpdateCode($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxshift']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0042->lvNVID=$_GET['NVID'];
			$motc_lv0042->LV_UpdateShift($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxtimework']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0042->lvNVID=$_GET['NVID'];
			$motc_lv0042->LV_UpdateTimeWork($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxovertime']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0042->lvNVID=$_GET['NVID'];
			$motc_lv0042->LV_UpdateOverTime($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxcleartime']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0042->lvNVID=$_GET['NVID'];
			$motc_lv0042->LV_UpdateClearTime($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxgiobu']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0042->lvNVID=$_GET['NVID'];
			$motc_lv0042->LV_UpdateGioBu($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxgiosau22h']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0042->lvNVID=$_GET['NVID'];
			$motc_lv0042->LV_UpdateGioSau22h($timeid,$codeid);
			exit;
	}
	
}


if((int)$month==1)
{
	$month_re=12;
	$year_re=$year -1;
}
else
{
	$month_re=$month-1;
	$year_re=$year;
}
$motc_lv0042->lv004=$year."-".$month;
if($motc_lv0042->is_tc09_add==1)
{
if(isset($_GET['ajaxmonth']))
	{
			$timeid=$_GET['monthid'];
			$value=$_GET['value'];
			$opt=(int)$_GET['choose'];
			switch($opt)
			{
				case 1:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthHSO($timeid,$value,$_GET['curday']);
					break;
				case 2:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthRate($timeid,$value,$_GET['curday']);
					break;
				case 3:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_AprovalOneMeal($timeid,$_GET['curday']);
					echo '[CHECK]';
					echo 3;
					echo '[ENDCHECK]';
					echo '[CHECKDEF]';
					echo $timeid;
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo $motc_lv0009->GetUnApr();
					echo '[ENDCHECKDIS]';
					break;
				case 4:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UnAprovalMeal($timeid);
					echo '[CHECK]';
					echo 4;
					echo '[ENDCHECK]';
					echo '[CHECKDEF]';
					echo $timeid;
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo $motc_lv0009->GetApr();
					echo '[ENDCHECKDIS]';
					break;
				case 5:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthPetrol($timeid,$value,$_GET['curday']);
					break;
				case 94:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthMeal($timeid,$value,$_GET['curday']);
					break;
				case 12:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthMeal($timeid,$value,$_GET['curday'],2);
					break;
				case 13:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthMeal($timeid,$value,$_GET['curday'],3);
					break;
				case 14:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthMeal($timeid,$value,$_GET['curday'],4);
					break;
				case 15:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthMeal($timeid,$value,$_GET['curday'],5);
					break;
				case 27:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthMealEmp($timeid,$value,$_GET['curday']);
					break;
				case 22:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthMealEmp($timeid,$value,$_GET['curday'],2);
					break;
				case 23:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthMealEmp($timeid,$value,$_GET['curday'],3);
					break;
				case 24:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthMealEmp($timeid,$value,$_GET['curday'],4);
					break;
				case 25:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthMealEmp($timeid,$value,$_GET['curday'],5);
					break;
				
			}
			exit;
	}
}
if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","TC0091.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0042->ArrPush[0]=$vLangArr[18];
$motc_lv0042->ArrPush[1]=$vLangArr[19];
$motc_lv0042->ArrPush[2]=$vLangArr[21];
$motc_lv0042->ArrPush[3]=$vLangArr[20];
$motc_lv0042->ArrPush[4]=$vLangArr[22];
$motc_lv0042->ArrPush[5]=$vLangArr[23];
$motc_lv0042->ArrPush[6]=$vLangArr[24];
$motc_lv0042->ArrPush[7]=$vLangArr[25];
$motc_lv0042->ArrPush[8]=$vLangArr[40];

$motc_lv0042->ArrFunc[0]='//Function';
$motc_lv0042->ArrFunc[1]=$vLangArr[2];
$motc_lv0042->ArrFunc[2]=$vLangArr[4];
$motc_lv0042->ArrFunc[3]=$vLangArr[6];
$motc_lv0042->ArrFunc[4]=$vLangArr[7];
$motc_lv0042->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$motc_lv0042->ArrFunc[6]=GetLangExcept('Apr',$plang);
$motc_lv0042->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$motc_lv0042->ArrFunc[8]=$vLangArr[10];
$motc_lv0042->ArrFunc[9]=$vLangArr[12];
$motc_lv0042->ArrFunc[10]=$vLangArr[0];
$motc_lv0042->ArrFunc[11]=$vLangArr[31];
$motc_lv0042->ArrFunc[12]=$vLangArr[32];
$motc_lv0042->ArrFunc[13]=$vLangArr[33];
$motc_lv0042->ArrFunc[14]=$vLangArr[34];
$motc_lv0042->ArrFunc[15]=$vLangArr[35];
////Other
$motc_lv0042->ArrOther[1]=$vLangArr[29];
$motc_lv0042->ArrOther[2]=$vLangArr[30];
$motc_lv0042->ArrTimeCordPush[]=$vLangArr[31];
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
if($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0009->LV_AprovalAll($month,$year);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0009->LV_UnAprovalAll($month,$year);
}
elseif($flagID==5)
{
	$vresult=$motc_lv0009->LV_UpdatePreHSo($month,$year);
	$vresult=$motc_lv0008->LV_UpdateFN(GetServerDate());
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0042->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0042');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0042->ListView;
$curPage = $motc_lv0042->CurPage;
$maxRows =$motc_lv0042->MaxRows;
$vOrderList=$motc_lv0042->ListOrder;
$vSortNum=$motc_lv0042->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$motc_lv0042->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0042',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$motc_lv0042->lvNVID= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

//$totalRowsC=$motc_lv0042->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
//$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
$motc_lv0009->LV_LoadMonthID($motc_lv0042->lvNVID,$month,$year);
$motc_lv0009->LV_ReLoadMonthID($motc_lv0042->lvNVID,$month_re,$year_re);
$motc_lv0013->LV_LoadActiveIDMonth($month,$year);
$motc_lv0042->CalID=$motc_lv0013->lv001;
$motc_lv0042->month=$month;
$motc_lv0042->year=$year;
$motc_lv0042->dayfrom=$_POST['txtDayFrom'];
$motc_lv0042->dayto=$_POST['txtDayTo'];
$motc_lv0042->lv004=$year."-".$month;
if($motc_lv0042->dayfrom=="")
	$motc_lv0042->datefrom=$motc_lv0013->lv004;
else
	$motc_lv0042->datefrom=$year."-".$month."-".Fillnum($motc_lv0042->dayfrom,2);
$motc_lv0042->datefrom=$year."-".$month."-01";	
if($motc_lv0042->dayto=="")
	$motc_lv0042->dateto=$motc_lv0013->lv005;
else
	$motc_lv0042->dateto=$year."-".$month."-".Fillnum($motc_lv0042->dayto,2);
$motc_lv0042->dateto=$year."-".$month."-".GetDayInMonth($motc_lv0042->year,$motc_lv0042->month);
$motc_lv0042->lv028="";
$motc_lv0042->lv029=$_POST['txtlv029'];
$motc_lv0042->lv099=$_POST['txtlv099'];
if($motc_lv0042->GetApr()==0)	$motc_lv0042->lv028=$motc_lv0042->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
if(!isset($_POST['txtlv029']))	
{
	if($motc_lv0042->lv029=="") 
	{
		$mohr_lv0020->LV_LoadID(getInfor($_SESSION['ERPSOFV2RUserID'],2));
		$motc_lv0042->lv029=$mohr_lv0020->lv029;
	}
}	
$motc_lv0042->lv001=$_POST['txtlv001'];
$motc_lv0042->lv002=$_POST['txtlv002'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<style type="text/css">
.lvsizeinput
{width:60px;
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv002'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>','filter');
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
	var str="<br><iframe height=1000 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>tc_lv0042?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
	
}
function UpdatePreHso()
{
var o=document.frmchoose;
	o.txtFlag.value=5;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function Apr()
{
var o=document.frmchoose;
	o.txtFlag.value=3;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function UnApr()
{
var o=document.frmchoose;
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	o.action="<?php echo $vDir;?>tc_lv0042?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
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
function ChangeInfor()
{
var o1=document.frmchoose;
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
function settime8hour(oj)
{
	var i=0;
	for(i=1;i<=31;i++)
	{
	 	var o=document.getElementById("txtlv002"+i);
	 	  if(o!= null)
	 	  {
		 	  if(oj.checked)
		 	  {
			 	  if(o.parentElement.parentElement.className!="lvlinehtable3")
		 	   o.value="08:00:00";
		 	  }
		 	  else
		 		 o.value="00:00:00";
	 	  }
	}
}
function checkRunCong(stt,o)
{
	var giatri=document.getElementById("txttimecardall");
	if(!o.checked) return;
	if(confirm("Bạn muốn chọn công ["+giatri.value+"] cho tất cả dòng cột này Y/N?"))
	{
	frm=document.frmchoose;
	var pt=frm.elements.length;
	var strrun="";
	
	var namept="lineday_"+stt;
	for(i=0;i<pt;i++)
    { var t=frm.elements[i];
	
      if(t.className==namept)
	    {
			strrun=t.lang;
			t.value=giatri.value;
			strrun=strrun.replace("@!99",giatri.value)
			window.setTimeout(strrun,10);
	    }
    }
	}
	
}

function checkRunTC(stt,o)
{
	var giatri=o;
	if(confirm("Bạn muốn chọn ["+giatri.value+"] cho tất cả dòng cột này Y/N?"))
	{
	frm=document.frmchoose;
	var pt=frm.elements.length;
	var strrun="";
	
	var namept="linecontrol_"+stt;
	for(i=0;i<pt;i++)
    { var t=frm.elements[i];
      if(t.className==namept)
	    {
			strrun=t.lang;
			t.value=giatri.value;
			strrun=strrun.replace("@!99",giatri.value)
			window.setTimeout(strrun,10);
	    }
    }
	}
	
}

//-->
</script>
<?php
if($motc_lv0042->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft">
                    <form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['child'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <p>
					  <table style="background:#f2f2f2;font:10px arial">
						<tr>
								<td  height="20px" colspan=3>
					    <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					   
					    <input type="button" id="txtPre" name="txtPre" value="Previous" onClick="ChangePre()">
					   <select id="txtDayFrom" name="txtDayFrom"  onChange="ChangeInfor()">
							<option value=''>Từ ngày</option>
							<?php
							for($i=1;$i<=GetDayInMonth($motc_lv0042->year,$motc_lv0042->month);$i++)
							{
								if((int)$motc_lv0042->dayfrom==$i)
									echo '<option selected="selected" value="'.Fillnum($i,2).'">'.Fillnum($i,2).'</option>';							
								else
									echo '<option value="'.Fillnum($i,2).'">'.Fillnum($i,2).'</option>';							
							}
							?>
							
					   </select>					   
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
					</select>
					 <select id="txtDayTo" name="txtDayTo"  onChange="ChangeInfor()">
							<option value=''>Đến ngày</option>
							<?php
							for($i=1;$i<=GetDayInMonth($motc_lv0042->year,$motc_lv0042->month);$i++)
							{
								if((int)$motc_lv0042->dayto==$i)
									echo '<option selected="selected" value="'.Fillnum($i,2).'">'.Fillnum($i,2).'</option>';							
								else
									echo '<option value="'.Fillnum($i,2).'">'.Fillnum($i,2).'</option>';							
							}
							?>							
					   </select>
					<input type="button" id="txtPre" name="txtPre" value="Next" onClick="ChangeNext()"> 
					Thấy giờ xóa<input type="checkbox" name="chkviewtime" value="1" <?php echo ((int)$_POST['chkviewtime']==1)?'checked':'';?> onChange="ChangeInfor()">
					</td>
					<td>
					Phòng ban</td>
					<td><select  name="txtlv029"  id="txtlv029"  tabindex="1" maxlength="255" style="width:100px" onKeyPress="return CheckKey(event,7)" onChange="ChangeInfor()"><option value=''>...</option><?php echo $motc_lv0042->LV_GetChildDepSelect($motc_lv0042->lv028,$motc_lv0042->lv029);?></select> 
					</td>
					
					<td>
					Mã nhân viên </td>
					<td><input type="text" name="txtlv001" id="txtlv001" value="<?php echo $motc_lv0042->lv001;?>" onChange="ChangeInfor()"/>
					</td>
					</tr>
					<tr>
					
					<td>
					 <?php if($motc_lv0042->GetApr()==1) {?>
					 <input type="button" value="Cập nhật năm-tháng làm việc" onclick="UpdatePreHso()"/><?php }?>
					 </td>
					
					
					<td colspan=2>
					<!-- Lọc SPI cho kinh doanh</td>
					<td><select  name="txtlv099"  id="txtlv099"  tabindex="1" maxlength="255" style="width:100px" onKeyPress="return CheckKey(event,7)" onChange="ChangeInfor()"><option value=''>...</option><?php echo $motc_lv0042->LV_LinkField('lv099',$motc_lv0042->lv099);?></select>-->
					<?php echo $vLangArr[26];?>:<input type="checkbox" name="chkviewinfo" value="1" <?php echo ((int)$_POST['chkviewinfo']==1)?'checked':'';?> onChange="ChangeInfor()">
					 </td>
					<td>Chọn công mặc định</td>
					<td><select name="txttimecardall" id="txttimecardall">
							<?php echo $motc_lv0042->LV_LinkField('lv007','');?></select>
						</select>
					</td>
					<td>
					Tên nhân viên </td>
					<td><input type="text" name="txtlv002" id="txtlv002" value="<?php echo $motc_lv0042->lv002;?>" onChange="ChangeInfor()"/>
					</td>
					</tr>
					</table>
					    <?php 
						echo $motc_lv0042->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmprocess','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum,0,$_POST['chkviewinfo'],(int)$_POST['chkviewtime']);?>
						  <?php 
						//  if((int)$_POST['chkviewinfo']==1)
						//echo $motc_lv0042->GetTimeCode($motc_lv0042->lvNVID,$year."-".$month."-01",$year."-".$month."-".GetDayInMonth((int)$year,(int)$month),'1');?>
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
						<input type="hidden" name="childfunc" id="year" value="rpt"/>
				  </form>
				  
</div></div>
<div>
					<?php 
					if($plang=="") $plang="VN";
						$vLangArr=GetLangFile("$vDir../","TC0003.txt",$plang);

					//////////////////////////////////////////////////////////////////////////////////////////////////////
					$motc_lv0002->ArrPush[0]='';
					$motc_lv0002->ArrPush[1]=$vLangArr[18];
					$motc_lv0002->ArrPush[2]=$vLangArr[20];
					$motc_lv0002->ArrPush[3]=$vLangArr[21];
					$motc_lv0002->ArrPush[4]=$vLangArr[22];
					$motc_lv0002->ArrPush[5]='Tổng';
					echo $motc_lv0002->LV_BuilListReportTC('lv001,lv002,lv003,lv004','document.frmchoose','chkAll','lvChk',$curRow, 1000,$paging,'',$motc_lv0042->ArrTC);?>
					</div>
</body>
				
<?php
} else {
	include("../tc_lv0042/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $motc_lv0042->ArrPush[0];?>';	
		function UpdateMonthly(value,vEmpID,codeid,vopt)
		{
			$xmlhttp=null;
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxmonth=month"+"&monthid="+value+"&value="+codeid+"&choose="+vopt+"&curday=<?php echo $year."-".$month."-01";?>&EmpID="+vEmpID;
			else
				url=url+"&ajaxmonth=month"+"&monthid="+value+"&value="+codeid+"&choose="+vopt+"&curday=<?php echo $year."-".$month."-01";?>&EmpID="+vEmpID;
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
				var startdomain1=xmlhttp.responseText.indexOf('[CHECKDEF]')+10;
				var enddomain1=xmlhttp.responseText.indexOf('[ENDCHECKDEF]');
				var domainid1=xmlhttp.responseText.substr(startdomain1,enddomain1-startdomain1);
				var startdomain2=xmlhttp.responseText.indexOf('[CHECKDIS]')+10;
				var enddomain2=xmlhttp.responseText.indexOf('[ENDCHECKDIS]');
				var domainid2=xmlhttp.responseText.substr(startdomain2,enddomain2-startdomain2);
				if(parseInt(domainid)==3) 
				{
					if(parseInt(domainid2)==1)
					{
						//document.getElementById("btmonth_"+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="blue";
						document.getElementById('btmonth_'+domainid1).value="Mở khóa";
						document.getElementById('btmonth_'+domainid1).onclick = function(){
						UpdateMonthly(domainid1,'','',4);
						}
					}
					else
					{
						document.getElementById('btmonth_'+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="blue";
						document.getElementById('btmonth_'+domainid1).value="Mở khóa";
					}
				}
				if(parseInt(domainid)==4)
				{
					if(parseInt(domainid2)==1)
					{
						//document.getElementById("btmonth_"+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="black";
						document.getElementById('btmonth_'+domainid1).value="Khóa";
						document.getElementById('btmonth_'+domainid1).onclick = function(){
						UpdateMonthly(domainid1,'','',3);
						}
						
					}
					else
					{
						document.getElementById('btmonth_'+domainid1).style.color="black";
						document.getElementById('btmonth_'+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).value="Khóa";
						
						
					}
				}
			}
		}
		function runchangetimework(value,lvNVID,codeid)
		{
			$xmlhttp112=null;
			xmlhttp112=GetXmlHttpObject();
			if (xmlhttp112==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxtimework=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxtimework=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp112.onreadystatechange=stateChangedProgram;
			xmlhttp112.open("GET",url,true);
			xmlhttp112.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp112.readyState==4)
			{
			}
		}
		function runchangeovertime(value,lvNVID,codeid)
		{
			$xmlhttp113=null;
			xmlhttp113=GetXmlHttpObject();
			if (xmlhttp113==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxovertime=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxovertime=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp113.onreadystatechange=stateChangedProgram;
			xmlhttp113.open("GET",url,true);
			xmlhttp113.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp113.readyState==4)
			{
			}
		}
		function runchangecleartime(value,lvNVID,codeid)
		{
			$xmlhttp114=null;
			xmlhttp114=GetXmlHttpObject();
			if (xmlhttp114==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxcleartime=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxcleartime=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp114.onreadystatechange=stateChangedProgram;
			xmlhttp114.open("GET",url,true);
			xmlhttp114.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp114.readyState==4)
			{
			}
		}
		function runchangegiosau22h(value,lvNVID,codeid)
		{
			xmlhttp116=null;
			xmlhttp116=GetXmlHttpObject();
			if (xmlhttp116==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxgiosau22h=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxgiosau22h=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp116.onreadystatechange=stateChangedProgram;
			xmlhttp116.open("GET",url,true);
			xmlhttp116.send(null);
		}
		function runchangegiobu(value,lvNVID,codeid)
		{
			$xmlhttp115=null;
			xmlhttp115=GetXmlHttpObject();
			if (xmlhttp115==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxgiobu=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxgiobu=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp115.onreadystatechange=stateChangedProgram;
			xmlhttp115.open("GET",url,true);
			xmlhttp115.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp115.readyState==4)
			{
			}
		}
		function runchangeshift(value,lvNVID,codeid)
		{
			$xmlhttp111=null;
			xmlhttp111=GetXmlHttpObject();
			if (xmlhttp111==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxshift=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxshift=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp111.onreadystatechange=stateChangedProgram;
			xmlhttp111.open("GET",url,true);
			xmlhttp111.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp111.readyState==4)
			{
			}
		}
		function runchangetime(value,lvNVID,codeid)
		{
			$xmlhttp1=null;
			xmlhttp1=GetXmlHttpObject();
			if (xmlhttp1==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxpro=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxpro=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedProgram;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp1.readyState==4)
			{
				var startdomain=xmlhttp1.responseText.indexOf('[CONGP]')+7;
				var enddomain=xmlhttp1.responseText.indexOf('[ENDCONGP]');
				var domainid=xmlhttp1.responseText.substr(startdomain,enddomain-startdomain);				
				var startdomain1=xmlhttp1.responseText.indexOf('[CONGPDEF]')+10;
				var enddomain1=xmlhttp1.responseText.indexOf('[ENDCONGPDEF]');
				var domainid1=xmlhttp1.responseText.substr(startdomain1,enddomain1-startdomain1);
				var startdomain2=xmlhttp1.responseText.indexOf('[CONGPDIS]')+10;
				var enddomain2=xmlhttp1.responseText.indexOf('[ENDCONGPDIS]');
				var domainid2=xmlhttp1.responseText.substr(startdomain2,enddomain2-startdomain2);
				if(domainid1=='B')
				{
					if(parseInt(domainid)<=0) 
						{
							document.getElementById('timecard_'+domainid2).value="";
							alert('Công B không còn để dùng');
						}
				}
				else if(domainid1=='A' || domainid1=='HA')
				{
					if(parseInt(domainid)<=0) 
						{
							document.getElementById('timecard_'+domainid2).value="";
							if(domainid1=='HA')
								alert('Công HA không còn để dùng');
							else
								alert('Công A không còn để dùng');
						}
				}
				else
				{
				}
				//document.getElementById('txtlv911').value=domainid2;
			}
		}
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
function addtime(vEmployeeID,vDate,vid,oj)
{
	vTime=oj.value;
	if(vTime=='' || vTime=='0' || vTime=='00' || vTime=='00:' || vTime=='00:0' || vTime=='00:00' || vTime=='00:00:' || vTime=='00:00:0' || vTime=='00:00:00')
	return;
	closetimeadd(vid);
	var o=document.getElementById('txttimeadd_'+vid);
	o.value="00:00";
	ChangeCompanyID(vEmployeeID,vDate,vTime,vid,3);
}
function showtimeadd(id)
{
	var o=document.getElementById('timeadd_'+id);
	o.style.display="block";
}
function closetimeadd(id)
{
	var o=document.getElementById('timeadd_'+id);
	o.style.display="none";
}
function ChangeCompanyID(vEmployeeID,vDate,vTime,vid,vopt)
{
	$xmlhttp222=null;
	
	xmlhttp222=GetXmlHttpObject();
	if (xmlhttp222==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajax222=ajaxcheck"+"&vEmployeeID="+vEmployeeID+'&vDate='+vDate+'&vTime='+vTime+'&vid='+vid+'&vopt='+vopt;
	url=url.replace("#","");
	xmlhttp222.onreadystatechange=stateChanged222;
	xmlhttp222.open("GET",url,true);
	
	xmlhttp222.send(null);
}
function stateChanged222()
{
	if (xmlhttp222.readyState==4)
	{
		var startdomain=xmlhttp222.responseText.indexOf('[CHECK]')+7;
		var enddomain=xmlhttp222.responseText.indexOf('[ENDCHECK]');
		var domainid=xmlhttp222.responseText.substr(startdomain,enddomain-startdomain);
		var startdomain=xmlhttp222.responseText.indexOf('[CHECKID]')+9;
		var enddomain=xmlhttp222.responseText.indexOf('[ENDCHECKID]');
		var divid=xmlhttp222.responseText.substr(startdomain,enddomain-startdomain);
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
</script>
</html>