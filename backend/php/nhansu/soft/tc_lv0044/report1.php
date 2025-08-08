<?php
session_start();
$vDir='../';
include($vDir."paras.php");
include($vDir."config.php");
include($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/tc_lv0041.php");
require_once("$vDir../clsall/tc_lv0009.php");
require_once("$vDir../clsall/tc_lv0013.php");
require_once("$vDir../clsall/tc_lv0011.php");
require_once("$vDir../clsall/tc_lv0002.php");

/////////////init object//////////////
$motc_lv0041=new tc_lv0041($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0041');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$motc_lv0041->Dir=$vDir;
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0002=new tc_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0002');
$motc_lv0041->is_tc09_add=0;
$motc_lv0041->is_tc09_apr=0;
$motc_lv0041->is_tc09_unapr=0;

$month=getmonth($_GET['txtMonthYear']);
$year=getyear($_GET['txtMonthYear']);
if($month=='' || $month==NULL)
{
	$motc_lv0013->LV_LoadActiveID();
	$vNow=$motc_lv0013->lv004;
	$month=Fillnum($motc_lv0013->lv006,2);
	$year=Fillnum($motc_lv0013->lv007,4);
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
$motc_lv0041->lv004=$year."-".$month;
if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","TC0091.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0041->ArrPush[0]=$vLangArr[18];
$motc_lv0041->ArrPush[1]=$vLangArr[19];
$motc_lv0041->ArrPush[2]=$vLangArr[21];
$motc_lv0041->ArrPush[3]=$vLangArr[20];
$motc_lv0041->ArrPush[4]=$vLangArr[22];
$motc_lv0041->ArrPush[5]=$vLangArr[23];
$motc_lv0041->ArrPush[6]=$vLangArr[24];
$motc_lv0041->ArrPush[7]=$vLangArr[25];
$motc_lv0041->ArrPush[30]=$vLangArr[30];

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

if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$motc_lv0009->LV_LoadMonthID($motc_lv0041->lvNVID,$month,$year);
$motc_lv0009->LV_ReLoadMonthID($motc_lv0041->lvNVID,$month_re,$year_re);
$motc_lv0041->month=$month;
$motc_lv0041->year=$year;
$motc_lv0041->lv004=$year."-".$month;
$motc_lv0041->datefrom=$year."-".$month."-01";
$motc_lv0041->dateto=$year."-".$month."-".Fillnum(GetDayInMonth($year,$month),2);
$motc_lv0041->lv028="";
if($motc_lv0041->GetApr()==0)  $motc_lv0041->lv028=$motc_lv0041->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
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
<?php
if($motc_lv0041->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
			<div>
					<div style="text-align:center">
						<div><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="90px" height="100px" 
								src="<?php echo "../../images/employees/".$mohr_lv0020->lv001."/".$mohr_lv0020->lv007; ?>" /></div>
						<div style="font-size:35;font-weight:bold;"><?php echo $vLangArr[13];?></div>
						<div style="font-size:16;font-weight:bold;"><?php echo $vLangArr[15].":".$motc_lv0041->FormatView($motc_lv0041->datefrom,2);?>&nbsp;&nbsp;&nbsp;<?php echo $vLangArr[16].":".$motc_lv0041->FormatView($motc_lv0041->dateto,2);?></div>
					</div>
					<div id="lvleft">
					    <?php 
						$motc_lv0041->SetAllDisiable();
						echo $motc_lv0041->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum,0,$_POST['chkviewinfo']);?>
					</div>
					<div>
					<?php 
					if($plang=="") $plang="VN";
						$vLangArr=GetLangFile("$vDir../","TC0003.txt",$plang);

					//////////////////////////////////////////////////////////////////////////////////////////////////////
					$motc_lv0002->ArrPush[0]='';
					$motc_lv0002->ArrPush[1]=$vLangArr[18];
					$motc_lv0002->ArrPush[2]=$vLangArr[20];
					$motc_lv0002->ArrPush[3]=$vLangArr[21];
					$motc_lv0002->ArrPush[4]='Tổng';
					echo $motc_lv0002->LV_BuilListReportTC('lv001,lv002,lv003','document.frmchoose','chkAll','lvChk',$curRow, 1000,$paging,'',$motc_lv0041->ArrTC);?>
					</div>
		</div>
</body>
				
<?php
} else {
	include("../tc_lv0041/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $motc_lv0041->ArrPush[0];?>';	
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
			url=url+"?&ajaxmonth=month"+"&monthid="+value+"&value="+codeid+"&choose="+vopt+"&curday=<?php echo $year."-".$month."-01";?>&EmpID="+vEmpID;
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
						document.getElementById('btmonth_'+domainid1).value="M? kh�a";
						document.getElementById('btmonth_'+domainid1).onclick = function(){
						UpdateMonthly(domainid1,'','',4);
						}
					}
					else
					{
						document.getElementById('btmonth_'+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="blue";
						document.getElementById('btmonth_'+domainid1).value="M? kh�a";
					}
				}
				if(parseInt(domainid)==4)
				{
					if(parseInt(domainid2)==1)
					{
						//document.getElementById("btmonth_"+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="black";
						document.getElementById('btmonth_'+domainid1).value="Kh�a";
						document.getElementById('btmonth_'+domainid1).onclick = function(){
						UpdateMonthly(domainid1,'','',3);
						}
						
					}
					else
					{
						document.getElementById('btmonth_'+domainid1).style.color="black";
						document.getElementById('btmonth_'+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).value="Kh�a";
						
						
					}
				}
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
			url=url+"?&ajaxpro=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedProgram;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp1.readyState==4)
			{
				//document.getElementById('txtlv911').value=domainid2;
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