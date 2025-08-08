<?php
session_start();
$vDir='';
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/jo_lv0020.php");
require_once("$vDir../clsall/sl_lv0003_1.php");
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
/////////////init object//////////////
$mojo_lv0020=new jo_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0020');
$mosl_lv0003_1=new sl_lv0003_1($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0003_1');
$vcodeid=1;
//$mosl_lv0003_1->LV_CheckValidState($vcodeid,$vvalue);
if($mojo_lv0020->GetEdit()==1)
{
	if(isset($_GET['ajax']))
	{
		$vvalue=$_GET['value'];
		$vcodeid=$_GET['codeid'];
		$vstate=0;
		if($vvalue==1)	$vstate=$mosl_lv0003_1->LV_CheckValidState($vcodeid);
		if($vstate==0)
		{
			$vsql="update sl_lv0003_1 set lv015='$vvalue' where lv001='$vcodeid'";
			echo '[CHECK]';
			echo $vvalue;
			echo '[ENDCHECK]';
			echo '[CHECKDEF]';
			echo $vcodeid;
			echo '[ENDCHECKDEF]';		
			db_query($vsql);
		}
		else
		{
			//$vsql="update sl_lv0003_1 set lv015='$vvalue' where lv001='$vcodeid'";
			echo '[CHECK]';
			echo 0;
			echo '[ENDCHECK]';
			echo '[CHECKDEF]';
			echo $vcodeid;
			echo '[ENDCHECKDEF]';		
			//db_query($vsql);
		}
			
		
		exit;
	}
}
$vNow=GetServerDate();
$mojo_lv0020->Dir=$vDir;
$day=getyear($_POST['day']);
if($day=="" || $day==NULL) $day=getday($vNow);
$month=getmonth($_POST['txtMonthYear']);
$year=getyear($_POST['txtMonthYear']);
if($month=='' || $month==NULL)
{
	$month=Fillnum(getmonth($vNow),2);
	$year=Fillnum(getyear($vNow),4);
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
$mojo_lv0020->lv004=$year."-".$month;
if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","SL0078_1.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0020->ArrPush[0]=$vLangArr[18];
$mojo_lv0020->ArrPush[1]=$vLangArr[19];
$mojo_lv0020->ArrPush[2]=$vLangArr[21];
$mojo_lv0020->ArrPush[3]=$vLangArr[20];
$mojo_lv0020->ArrPush[4]=$vLangArr[22];
$mojo_lv0020->ArrPush[5]=$vLangArr[23];
$mojo_lv0020->ArrPush[6]=$vLangArr[24];
$mojo_lv0020->ArrPush[7]=$vLangArr[25];


$mojo_lv0020->ArrFunc[0]='//Function';
$mojo_lv0020->ArrFunc[1]=$vLangArr[2];
$mojo_lv0020->ArrFunc[2]=$vLangArr[4];
$mojo_lv0020->ArrFunc[3]=$vLangArr[6];
$mojo_lv0020->ArrFunc[4]=$vLangArr[7];
$mojo_lv0020->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mojo_lv0020->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mojo_lv0020->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mojo_lv0020->ArrFunc[8]=$vLangArr[10];
$mojo_lv0020->ArrFunc[9]=$vLangArr[12];
$mojo_lv0020->ArrFunc[10]=$vLangArr[0];
$mojo_lv0020->ArrFunc[11]=$vLangArr[31];
$mojo_lv0020->ArrFunc[12]=$vLangArr[32];
$mojo_lv0020->ArrFunc[13]=$vLangArr[33];
$mojo_lv0020->ArrFunc[14]=$vLangArr[34];
$mojo_lv0020->ArrFunc[15]=$vLangArr[35];
////Other
$mojo_lv0020->ArrOther[1]=$vLangArr[29];
$mojo_lv0020->ArrOther[2]=$vLangArr[30];
$mojo_lv0020->ArrTimeCordPush[]=$vLangArr[31];
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
$mojo_lv0020->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0020');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mojo_lv0020->ListView;
$curPage = $mojo_lv0020->CurPage;
$maxRows =$mojo_lv0020->MaxRows;
$vOrderList=$mojo_lv0020->ListOrder;
$vSortNum=$mojo_lv0020->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mojo_lv0020->SaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0020',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mojo_lv0020->lvNVID= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mojo_lv0020->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
$mojo_lv0020->month=$month;
$mojo_lv0020->year=$year;
$mojo_lv0020->lv004=$year."-".$month;
$mojo_lv0020->datefrom=$year."-".$month."-01";
$mojo_lv0020->dateto=$year."-".$month."-".Fillnum(GetDayInMonth($year,(int)$month),2);
$mojo_lv0020->lv028="";
$mojo_lv0020->lv029=$_POST['txtlv029'];
$mojo_lv0020->lv001=$_POST['txtlv001'];
if($mojo_lv0020->GetApr()==0)
{	
	$mojo_lv0020->lv028=$mojo_lv0020->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
	$mojo_lv0020->lv001=$mojo_lv0020->Get_User($_SESSION['ERPSOFV2RUserID'],'lv006');
}	
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
function viewpopcalendar(vstt)
{
	var o=document.getElementById("calendarview_"+vstt);
	o.style.display="block";
}
function closepopcalendar(vstt)
{
	var o=document.getElementById("calendarview_"+vstt);
	o.style.display="none";
}

//////////////RunFunction/////////////////////////
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=1000 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>jo_lv0020?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rptretail&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
	var fun1="Report2('"+vValue+"')";
	setTimeout(fun1,100);
	
}
function Report2(vValue)
{
	var o=document.frmprocess1;
	o.target="_blank";
	o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
	var fun2="Report3('"+vValue+"')";
	setTimeout(fun2,100);
}	
function Report3(vValue)
{
	var o=document.frmprocess2;
	o.target="_blank";
	o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rpten&ID="+vValue+"&lang=<?php echo $plang;?>";	o.submit();
	var fun2="Report4('"+vValue+"')";
	setTimeout(fun2,100);
}	
function Report4(vValue)
{
	var o=document.frmprocess3;
	o.target="_blank";
	o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rptall&ID="+vValue+"&lang=<?php echo $plang;?>";
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
$vDateOpt=$year."-".Fillnum($month,2)."-".Fillnum($day,2);
if($mojo_lv0020->GetView()==1)
{
?>
<form onSubmit="return false;" action="#" method="post" name="frmchoose" id="frmchoose"> 
<div>
<input type="hidden" name="month" id="month" value="<?php echo $month;?>"/>
<input type="hidden" name="year" id="year" value="<?php echo $year;?>"/>
<input type="button" id="txtPre" name="txtPre" value="Tháng trước" onClick="ChangePre()" onchange="">
						<select type="textbox" style="width:40px" name="day" id="day" onChange="ChangeInfor()"/>
						<?php
							$vNumMonth=	GetDayInMonth($year,$month);
							for($i=1;$i<=$vNumMonth;$i++)
							{
								echo '<option value="'.$i.'" '.(($day==$i)?'selected="selected"':'').' >'.$i.'</option>';
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
					</select><input type="button" id="txtPre" name="txtPre" value="Tháng kế tiếp" onClick="ChangeNext()"> 
</div>					
<div style="width:1180px;position:relative;">
	<div style="clear:both;border-bottom:1px #2c2c2c solid;overflow:hidden;">
	<div style="float:left;width:100px;backgound:gray"><div style="padding:10px"><strong>Tên người<br/> đề xuất </strong></div></div>
	<div style="background:url(../images/24h.png);width:1080px;height:72px;float:left">
	</div>
	</div>
	<?php
		$lvul='
			<ul>
				<li>@#02</li>
				<li><p onclick="viewpopcalendar(\'@#01\')" style="cursor:pointer">@#03</p></li>
				<li><div id="calendarview_@#01" class="viewcalandar" style="display:none;clear:both;">
					<div style="float:left;width:90%">
				@#04
					</div>
					<div style="float:right;width:10%;color:red;cursor:pointer;overflow:hidden;"><p onclick="closepopcalendar(\'@#01\')"><img width="20" src="images/icon/close.png"/></p></div>
				</div></li>
			</ul>
		';
		$lvsql="
		select A.lv001,A.lv002,A.lv003,
		A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv011,
		A.lv012,A.lv013,A.lv014,A.lv015
		,concat(B.lv004,' ',B.lv002) NameEmp from sl_lv0003_1 A left join hr_lv0020 B on A.lv010=B.lv001 where A.lv006='$vDateOpt'
		union
		select A.lv001,A.lv002,A.lv003,
		A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,'00:00:00' lv011,
		ADDTIME(ADDTIME(A.lv012,concat('-',ADDTIME('24:00:00',-A.lv011))),concat('-',(DATEDIFF('$vDateOpt',A.lv006)-1)*24,':00:00')) lv012,A.lv013,A.lv014,A.lv015
		,concat(B.lv004,' ',B.lv002) NameEmp from sl_lv0003_1 A left join hr_lv0020 B on A.lv010=B.lv001 where A.lv006<'$vDateOpt' and ADDTIME(concat(A.lv006,' ',A.lv011),A.lv012)>='$vDateOpt'		
		";
		$vresult=db_query($lvsql);
		$vOrder=0;
		$vStrLine="";
		while($vrow=db_fetch_array($vresult))
		{
			if(str_replace(":","",$vrow['lv012'])>0)
			{
			$vArrTime=explode(":",$vrow['lv011']);
			$vleft=$vArrTime[0]*45+$vArrTime[1]*45/60+$vArrTime[2]*45/360;
			$vArrSpace=explode(":",$vrow['lv012']);
			$vwidth=$vArrSpace[0]*45+$vArrSpace[1]*45/60+$vArrSpace[2]*45/360;
			if($vwidth+$vleft>1080) $vwidth=1080-$vleft;
			$vColor=($vrow['lv015']==1)?'#fe7510':'#1796b0';
			echo '
			<div style="clear:both;">
			<div style="height:38px;float:left;width:98px;border-right:1px #2c2c2c solid;border-left:1px #2c2c2c solid;border-bottom:1px #2c2c2c solid"><div style="padding:5px">'.$vrow['lv010'].'</br>'.'<font style="">'.$vrow['NameEmp'].'</font>'.'</div></div>
			<div style="height:28px;position:relative;width:1080px;float:left;padding-top:5px;padding-bottom:5px;border-bottom:1px #2c2c2c solid">
				<div title="'.$vrow['lv008'].'" id="btmonth_'.$vrow['lv001'].'" style="position:absolute;background:'.$vColor.';left:'.$vleft.'px;width:'.$vwidth.'px;height:20x;color:white;padding:0px;cursor:pointer;"  onclick="viewpopcalendar(\''.$vrow['lv001'].'\')"><div style="float:left;padding:5px;">'.$vrow['lv0081'].'</div><div style="float:right"><span onclick=""><input title="Check để châp nhận" type="checkbox" value="1" '.(($vrow['lv015']==1)?'checked="checked"':'').' onclick="SendCheckApr(this,\''.$vrow['lv001'].'\')" /></span></div></div>';
				echo '<div id="calendarview_'.$vrow['lv001'].'" class="viewcalandar" style="display:none;clear:both;z-index:99999">
					<div style="float:left;width:90%">
					Tiêu đề:'.$vrow['lv008'].'<br/>
					Người liên hệ:'.$vrow['lv004'].'<br/>
					Điện thoại liên hệ:'.$vrow['lv005'].'<br/>
					Ngày liên hệ:'.$vrow['lv006'].'<br/>
					Giờ liên hệ:'.$vrow['lv011'].'<br/>
					Khoản thời gian gặp:'.$vrow['lv012'].'<br/>
					Nội dung:'.$vrow['lv008'].'<br/>
					</div>
					<div style="float:right;width:10%;color:red;cursor:pointer;overflow:hidden;"><p onclick="closepopcalendar(\''.$vrow['lv001'].'\')"><img width="20" src="images/icon/close.png"/></p></div>
				</div>';
echo '				
			</div>
			
			';
			echo '</div>';
			}
		}
	?>
</div>
</form>
<?php
} else {
	include("../jo_lv0020/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mojo_lv0020->ArrPush[0];?>';	
		function SendCheckApr(o,codeid)
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
			value=0;
			if(o.checked) value=1;
			if(n<0)
				url=url+"?&ajax=month"+"&value="+value+"&codeid="+codeid;
			else
				url=url+"&ajax=month"+"&value="+value+"&codeid="+codeid;
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
				if(parseInt(domainid)==1) 
				{			
					document.getElementById('btmonth_'+domainid1).style.background="#fe7510";					
				}	
				else
				{	
					alert('Đã có lịch cho xe được chấp nhận trùng với thời gian này!');
					document.getElementById('btmonth_'+domainid1).style.background="#1796b0";					
				}				
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