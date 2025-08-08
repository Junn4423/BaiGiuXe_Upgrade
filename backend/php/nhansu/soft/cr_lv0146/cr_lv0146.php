<?php
$vDir='';
include($vDir."paras.php");
require_once($vDir."config.php");
require_once($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/cr_lv0146.php");
require_once("$vDir../clsall/tc_lv0009.php");
require_once("$vDir../clsall/tc_lv0013.php");

/////////////init object//////////////
$mocr_lv0146=new cr_lv0146($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0146');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$mocr_lv0146->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$month=getmonth($_POST['txtMonthYear'] ?? '');
$year=getyear($_POST['txtMonthYear'] ?? '');
if($month=='' || $month==NULL)
{
	//$motc_lv0013->LV_LoadActiveID();
	$vNow=substr($motc_lv0013->DateCurrent,0,10);
	$month=getmonth($vNow);
	$year=getyear($vNow);
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
$mocr_lv0146->lv004=$year."-".$month;
if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","TC0022.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0146->ArrPush[0]=$vLangArr[17];
$mocr_lv0146->ArrPush[1]=$vLangArr[18];
$mocr_lv0146->ArrPush[2]=$vLangArr[20];
$mocr_lv0146->ArrPush[3]=$vLangArr[21];
$mocr_lv0146->ArrPush[4]=$vLangArr[22];
$mocr_lv0146->ArrPush[5]=$vLangArr[23];
$mocr_lv0146->ArrPush[6]=$vLangArr[24];
$mocr_lv0146->ArrPush[7]=$vLangArr[25];
$mocr_lv0146->ArrPush[8]=$vLangArr[26];
$mocr_lv0146->ArrPush[9]=$vLangArr[27];
$mocr_lv0146->ArrPush[10]=$vLangArr[28];
$mocr_lv0146->ArrPush[11]=$vLangArr[29];
$mocr_lv0146->ArrPush[12]=$vLangArr[43];
$mocr_lv0146->ArrPush[13]=$vLangArr[37];
$mocr_lv0146->ArrPush[14]=$vLangArr[51];
$mocr_lv0146->ArrPush[15]=$vLangArr[49];
$mocr_lv0146->ArrPush[16]=$vLangArr[50];
$mocr_lv0146->ArrPush[17]=$vLangArr[52];
$mocr_lv0146->ArrPush[18]='Clear Time';
$mocr_lv0146->ArrPush[19]='Giờ sau 22h';
$mocr_lv0146->ArrPush[100]='Hợp đồng';
$mocr_lv0146->ArrPush[101]='Ẩn';
$mocr_lv0146->ArrPush[1000]='Thứ';

$mocr_lv0146->ArrFunc[0]='//Function';
$mocr_lv0146->ArrFunc[1]=$vLangArr[2];
$mocr_lv0146->ArrFunc[2]=$vLangArr[4];
$mocr_lv0146->ArrFunc[3]=$vLangArr[6];
$mocr_lv0146->ArrFunc[4]=$vLangArr[7];
$mocr_lv0146->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mocr_lv0146->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mocr_lv0146->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mocr_lv0146->ArrFunc[8]=$vLangArr[10];
$mocr_lv0146->ArrFunc[9]=$vLangArr[12];
$mocr_lv0146->ArrFunc[10]=$vLangArr[0];
$mocr_lv0146->ArrFunc[11]=$vLangArr[32];
$mocr_lv0146->ArrFunc[12]=$vLangArr[33];
$mocr_lv0146->ArrFunc[13]=$vLangArr[34];
$mocr_lv0146->ArrFunc[14]=$vLangArr[35];
$mocr_lv0146->ArrFunc[15]=$vLangArr[36];
////Other
$mocr_lv0146->ArrOther[1]=$vLangArr[30];
$mocr_lv0146->ArrOther[2]=$vLangArr[31];
$mocr_lv0146->ArrTimeCordPush[]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
//$flagID=(int)$_POST["txtFlag"] ?? '';
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];
if(strpos($vFieldList,'lv001')===false) $vFieldList='lv001,'.$vFieldList;
$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

//first is load
if(isset($_POST["txtFlag"]) && $_POST["txtFlag"] != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0146->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0146');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mocr_lv0146->ListView;
$curPage = $mocr_lv0146->CurPage;
$maxRows =$mocr_lv0146->MaxRows;
$vOrderList=$mocr_lv0146->ListOrder;
$vSortNum=$mocr_lv0146->SortNum;
}
elseif(isset($_POST["txtFlag"]) && $_POST["txtFlag"] = 2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mocr_lv0146->SaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0146',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mocr_lv0146->lvNVID=$mocr_lv0146->LV_UserID;
if($mocr_lv0146->GetApr()<>1 || $mocr_lv0146->GetUnApr()<>1)
{
	$mocr_lv0146->lv013=$mocr_lv0146->LV_UserID;
}

$maxRows = $maxRows ?? 0; 
if( $maxRows ==0) $maxRows = 10;

$totalRowsC=$mocr_lv0146->GetCount();
$maxPages = 10;
$curPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
if($flagID==1)
{
	$mocr_lv0146->lv004=$year."-".$month."-01";
	for($i=$curRow+1;$i<$maxRows+$curRow+1;$i++)
	{
		$mocr_lv0146->lv001=$_POST['txtlv001'.$i];
		$mocr_lv0146->lv005=$_POST['txtlv005'.$i];
		$mocr_lv0146->lv006=$_POST['txtlv006'.$i];
		$mocr_lv0146->lv007=$_POST['txtlv007'.$i];
		$mocr_lv0146->lv008=$_POST['txtlv008'.$i];
		$mocr_lv0146->lv010=$_POST['txtlv010'.$i];
		$mocr_lv0146->lv011=$_POST['txtlv011'.$i];
		$mocr_lv0146->lv013=$_POST['txtlv013'.$i];
		$mocr_lv0146->lv014=$_POST['txtlv014'.$i];
		$mocr_lv0146->lv015=$_POST['txtlv015'.$i];
		$mocr_lv0146->lv016=$_POST['txtlv016'.$i];
		$mocr_lv0146->lv017=$_POST['txtlv017'.$i];
		$vresult=$mocr_lv0146->LV_Update();
		
	}
	$mocr_lv0146->LV_OrtherInsert($mocr_lv0146->lvNVID,$year."-".$month."-01",$_POST['txtPara'],$_POST['txtRate']);
	$mocr_lv0146->lv004=$year."-".$month;
	$mocr_lv0146->lv001='';
		$mocr_lv0146->lv005='';
		$mocr_lv0146->lv006='';
		$mocr_lv0146->lv007='';
		$mocr_lv0146->lv008='';
		$mocr_lv0146->lv010='';
	
}
elseif($flagID==3)
{
	$vresult=$mocr_lv0146->LV_Aproval($year."-".$month."-01");
}
elseif($flagID==4)
{
	$vresult=$mocr_lv0146->LV_UnAproval($year."-".$month."-01");
}
$motc_lv0009->LV_LoadMonthID($mocr_lv0146->lvNVID,$month,$year);
$motc_lv0009->LV_ReLoadMonthID($mocr_lv0146->lvNVID,$month_re,$year_re);
$mocr_lv0146->lv004=$year."-".$month;
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
	var str="<br><iframe height=1000 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>cr_lv0146?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'];?>&ID=<?php echo  $_GET['ID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	o.action="<?php echo $vDir;?>cr_lv0146?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
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
	echo "sdsd";
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
if($mocr_lv0146->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft">
                    <div style="line-height:28px"> <?php echo $vLangArr[39];?>:<?php echo GetUserName($mocr_lv0146->lvNVID,$plang)."(".$mocr_lv0146->lvNVID.")";?></div>
                    
                    <form onSubmit="return false;" action="?func=<?php echo $_GET['func'] ?? '';?>&childfunc=<?php echo $_GET['child'] ?? '';?>&ID=<?php echo  $_GET['ID'] ?? ''?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <p>
					    <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					   
					    <input style="width:80px" type="button" id="txtPre" name="txtPre" value="Trở lại" onClick="ChangePre()">
					   
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
					</select> <input style="width:80px" type="button" id="txtPre" name="txtPre" value="Tiếp" onClick="ChangeNext()"> 
					    <?php 
						$vFieldList='lv004,lv999,lv012,lv099';
						$vSortNum = $vSortNum ?? 0;
						
						echo $mocr_lv0146->LV_BuilListInput($vFieldList,'document.frmchoose','chkAll','lvChk',0, 10000000,$paging,$vOrderList,$vSortNum);?>
						  <?php 
						if (isset($_POST['chkviewinfo']) && (int)$_POST['chkviewinfo'] == 1) 
						//echo $mocr_lv0146->GetTimeCode($mocr_lv0146->lvNVID,$year."-".$month."-01",$year."-".$month."-".GetDayInMonth((int)$year,(int)$month),'1');?>
					    <input name="txtStringID" type="hidden" id="txtStringID" />
					    <input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
					    <input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
					    <input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input style="width:80px" type="button" id="txtPre" name="txtPre" value="Trở lại" onClick="ChangePre()"> <select id="txtMonthYear1" name="txtMonthYear1" onChange="ChangeTimeCard1(this)">
						
					<?php
						
						for($i=1;$i<13;$i++)
						{
						if((int)$month==$i)
							echo '<option selected="selected" value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						else
							echo '<option value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						}
					?>	
					</select> <input style="width:80px" type="button" id="txtPre" name="txtPre" value="Tiếp" onClick="ChangeNext()">
					<input type="hidden" name="month" id="month" value="<?php echo $month;?>"/>
					<input type="hidden" name="year" id="year" value="<?php echo $year;?>"/>
					</form>
					<form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  
</div></div>
</body>
				
<?php
$vNow=substr($motc_lv0013->DateCurrent,0,10);
$monthcur=getmonth($vNow);
$yearcur=getyear($vNow);
if($mocr_lv0146->lv004<$yearcur.'-'.$monthcur)
{
	$vStartDate="01%2F".$month."%2F".$year;
	$vEndDate=GetDayInMonth((int)$year,(int)$month)."%2F".$month."%2F".$year;
	?>
	<iframe name="cl_7_3" id="cl_7_3" height=360 marginheight=0 marginwidth=0 frameborder=0 title="" src="https://erp.SOF.biz/soft/rp_lv0011/?lang=VN&txtlv002=&chklv002=29&isChildCheck=1&txtlv003=0%2C1%2C4%2C5%2C6&chklv003=9&txtlv004=<?php echo $motc_lv0013->LV_UserID;?>&txtlv004_search=&txtdatefrom=<?php echo $vStartDate;?>&txtdateto=<?php echo $vEndDate;?>&txtopt=0&chklv005=11&txtlv020=4%2C6%2C20%2C31%2C8%2C9%2C10&txtlv021=0&txtlv222=1&txtlv221=4&txtlv022=0&childfunc=&func=rptall" class=lvframe></iframe>
<?php	
	
}
} else {
	include("../cr_lv0146/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mocr_lv0146->ArrPush[0];?>';	
</script>
</html>