<?php
$vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/tc_lv0007.php");
require_once("$vDir../clsall/tc_lv0009.php");
require_once("$vDir../clsall/tc_lv0013.php");

/////////////init object//////////////
$motc_lv0007=new tc_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0007');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$motc_lv0007->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$month=getmonth($_POST['txtMonthYear']);
$year=getyear($_POST['txtMonthYear']);
if($month=='' || $month==NULL)
{
	$motc_lv0013->LV_LoadActiveID();
	if($motc_lv0013->lv001!=null)
	{
		$vNow=$motc_lv0013->lv004;
		$month=Fillnum($motc_lv0013->lv006,2);
		$year=Fillnum($motc_lv0013->lv007,4);
	}
	else
	{
		$vNow=$motc_lv0013->DateCurrent;
		$month=Fillnum(getmonth($vNow),2);
		$year=Fillnum(getyear($vNow),4);
		$motc_lv0013->LV_LoadActiveIDMonth($month,$year);
		
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
$motc_lv0007->lv004=$year."-".$month;
if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","TC0022.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0007->ArrPush[0]=$vLangArr[17];
$motc_lv0007->ArrPush[1]=$vLangArr[18];
$motc_lv0007->ArrPush[2]=$vLangArr[20];
$motc_lv0007->ArrPush[3]=$vLangArr[21];
$motc_lv0007->ArrPush[4]=$vLangArr[22];
$motc_lv0007->ArrPush[5]=$vLangArr[23];
$motc_lv0007->ArrPush[6]=$vLangArr[24];
$motc_lv0007->ArrPush[7]=$vLangArr[25];
$motc_lv0007->ArrPush[8]=$vLangArr[26];
$motc_lv0007->ArrPush[9]=$vLangArr[27];
$motc_lv0007->ArrPush[10]=$vLangArr[28];
$motc_lv0007->ArrPush[11]=$vLangArr[29];
$motc_lv0007->ArrPush[12]=$vLangArr[43];
$motc_lv0007->ArrPush[13]=$vLangArr[37];
$motc_lv0007->ArrPush[14]=$vLangArr[51];
$motc_lv0007->ArrPush[15]=$vLangArr[49];
$motc_lv0007->ArrPush[16]=$vLangArr[50];
$motc_lv0007->ArrPush[17]=$vLangArr[52];
$motc_lv0007->ArrPush[18]='Clear Time';
$motc_lv0007->ArrPush[19]='Giờ sau 22h';
$motc_lv0007->ArrPush[100]='Mã hợp đồng';
$motc_lv0007->ArrPush[101]='Ẩn';

$motc_lv0007->ArrFunc[0]='//Function';
$motc_lv0007->ArrFunc[1]=$vLangArr[2];
$motc_lv0007->ArrFunc[2]=$vLangArr[4];
$motc_lv0007->ArrFunc[3]=$vLangArr[6];
$motc_lv0007->ArrFunc[4]=$vLangArr[7];
$motc_lv0007->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$motc_lv0007->ArrFunc[6]=GetLangExcept('Apr',$plang);
$motc_lv0007->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$motc_lv0007->ArrFunc[8]=$vLangArr[10];
$motc_lv0007->ArrFunc[9]=$vLangArr[12];
$motc_lv0007->ArrFunc[10]=$vLangArr[0];
$motc_lv0007->ArrFunc[11]=$vLangArr[32];
$motc_lv0007->ArrFunc[12]=$vLangArr[33];
$motc_lv0007->ArrFunc[13]=$vLangArr[34];
$motc_lv0007->ArrFunc[14]=$vLangArr[35];
$motc_lv0007->ArrFunc[15]=$vLangArr[36];
////Other
$motc_lv0007->ArrOther[1]=$vLangArr[30];
$motc_lv0007->ArrOther[2]=$vLangArr[31];
$motc_lv0007->ArrTimeCordPush[]=$vLangArr[31];
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

//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0007->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0007');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0007->ListView;
$curPage = $motc_lv0007->CurPage;
$maxRows =$motc_lv0007->MaxRows;
$vOrderList=$motc_lv0007->ListOrder;
$vSortNum=$motc_lv0007->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$motc_lv0007->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0007',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$motc_lv0007->lvNVID= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0007->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
if($flagID==1)
{
	$motc_lv0007->lv004=$year."-".$month."-01";
	for($i=$curRow+1;$i<$maxRows+$curRow+1;$i++)
	{
		$motc_lv0007->lv001=$_POST['txtlv001'.$i];
		$motc_lv0007->lv005=$_POST['txtlv005'.$i];
		$motc_lv0007->lv006=$_POST['txtlv006'.$i];
		$motc_lv0007->lv007=$_POST['txtlv007'.$i];
		$motc_lv0007->lv008=$_POST['txtlv008'.$i];
		$motc_lv0007->lv010=$_POST['txtlv010'.$i];
		$motc_lv0007->lv011=$_POST['txtlv011'.$i];
		$motc_lv0007->lv013=$_POST['txtlv013'.$i];
		$motc_lv0007->lv014=$_POST['txtlv014'.$i];
		$motc_lv0007->lv015=$_POST['txtlv015'.$i];
		$motc_lv0007->lv016=$_POST['txtlv016'.$i];
		$motc_lv0007->lv017=$_POST['txtlv017'.$i];
		$vresult=$motc_lv0007->LV_Update();
		
	}
	$motc_lv0007->LV_OrtherInsert($motc_lv0007->lvNVID,$year."-".$month."-01",$_POST['txtPara'],$_POST['txtRate']);
	$motc_lv0007->lv004=$year."-".$month;
	$motc_lv0007->lv001='';
		$motc_lv0007->lv005='';
		$motc_lv0007->lv006='';
		$motc_lv0007->lv007='';
		$motc_lv0007->lv008='';
		$motc_lv0007->lv010='';
	
}
elseif($flagID==3)
{
	$vresult=$motc_lv0007->LV_Aproval($year."-".$month."-01");
}
elseif($flagID==4)
{
	$vresult=$motc_lv0007->LV_UnAproval($year."-".$month."-01");
}
$motc_lv0009->LV_LoadMonthID($motc_lv0007->lvNVID,$month,$year);
$motc_lv0009->LV_ReLoadMonthID($motc_lv0007->lvNVID,$month_re,$year_re);
$motc_lv0007->lv004=$year."-".$month;
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
	var str="<br><iframe height=1000 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>tc_lv0007?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
	
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
	o.action="<?php echo $vDir;?>tc_lv0007?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
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
	 	var o=document.getElementById("txtlv005"+i);
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
//-->
</script>
<?php
if($motc_lv0007->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft">
                    <div style="line-height:28px"> <?php echo $vLangArr[39];?>:<?php echo GetUserName($motc_lv0007->lvNVID,$plang)."(".$motc_lv0007->lvNVID.")";?></div>
                    
                    <form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['child'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
                    <div style="line-height:28px"> <?php echo $vLangArr[40];?>:<input type="checkbox" name="chkviewinfo" value="1" <?php echo ((int)$_POST['chkviewinfo']==1)?'checked':'';?> onChange="ChangeInfor()"></div>
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
					</select><input type="button" id="txtPre" name="txtPre" value="Next" onClick="ChangeNext()"> <?php echo $vLangArr[38];?><input type="text" id="txtPara" name="txtPara" value="<?php echo ($motc_lv0009->lv007!="" && $motc_lv0009->lv007!=NULL)?$motc_lv0009->lv007:$motc_lv0009->lv007_re;?>" />
					<?php echo $vLangArr[48];?>
					<select name="txtRate" id="txtRate"  tabindex="12" maxlength="50" style="width:100px" onkeypress="return CheckKeys(event,7,this)">
                                <option value=""></option>
								<?php echo $motc_lv0007->LV_LinkField('lv099',($motc_lv0009->lv008!="" && $motc_lv0009->lv008!=NULL)?$motc_lv0009->lv008:$motc_lv0009->lv008_re);?>
                              </select>Set all 08:00:00 <input type="checkbox" onclick="settime8hour(this)">
					    <?php 
						echo $motc_lv0007->LV_BuilListInput($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						  <?php 
						  if((int)$_POST['chkviewinfo']==1)
						echo $motc_lv0007->GetTimeCode($motc_lv0007->lvNVID,$year."-".$month."-01",$year."-".$month."-".GetDayInMonth((int)$year,(int)$month),'1');?>
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
	include("../tc_lv0007/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $motc_lv0007->ArrPush[0];?>';	
</script>
</html>