<?php
if($_GET['ChildID']!="")  $vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ki_lv0013.php");

/////////////init object//////////////
$moki_lv0013=new ki_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0009');
$moki_lv0013->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","KI0011.txt",$plang);
$moki_lv0013->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($moki_lv0013->GetEdit()==1)
{

if(isset($_GET['ajaxbangtext']))
{
	$vdonhangid=$_GET['donhangid'];
	$vText=$_GET['textup'];
	$voption=$_GET['optrun'];
	if($vdonhangid!='' && $vdonhangid!=NULL)
	{
		$vUserID=getInfor($_SESSION['ERPSOFV2RUserID'], 2);
		$vlvField='lv'.Fillnum($voption,3);
		switch($voption)
		{
			case 6:
				switch($moki_lv0013->kpi_opt)
				{
					case 2:
						$vsql="update ki_lv0006 set $vlvField='$vText',lv004=IF(ISNULL(lv012) or lv012='','$vText',lv004),lv005=IF(ISNULL(lv013) or lv013='','$vText',lv005),lv014='$vUserID',lv019=concat(CURDATE(),' ',CURTIME()) where lv001='$vdonhangid' and  lv016=0";
						break;
					default:
						$vsql="update ki_lv0006 set $vlvField='$vText',lv014='$vUserID',lv019=concat(CURDATE(),' ',CURTIME()) where lv001='$vdonhangid' and  lv016=0";
						break;
				}
				break;
			case 10:
				$vsql="update ki_lv0006 set $vlvField='$vText',lv014='$vUserID',lv019=concat(CURDATE(),' ',CURTIME()) where lv001='$vdonhangid' and  lv016=0";
				break;
		}
		$vresult=db_query($vsql);
	}
	exit;
}
}

$moki_lv0013->ArrPush[0]=$vLangArr[17];
$moki_lv0013->ArrPush[1]=$vLangArr[18];
$moki_lv0013->ArrPush[2]=$vLangArr[20];
$moki_lv0013->ArrPush[3]=$vLangArr[21];
$moki_lv0013->ArrPush[4]=$vLangArr[22];
$moki_lv0013->ArrPush[5]=$vLangArr[23];
$moki_lv0013->ArrPush[6]=$vLangArr[24];
$moki_lv0013->ArrPush[7]=$vLangArr[25];
$moki_lv0013->ArrPush[8]=$vLangArr[26];
$moki_lv0013->ArrPush[9]=$vLangArr[27];
$moki_lv0013->ArrPush[10]=$vLangArr[28];
$moki_lv0013->ArrPush[11]=$vLangArr[29];
$moki_lv0013->ArrPush[12]=$vLangArr[30];
$moki_lv0013->ArrPush[13]=$vLangArr[31];
$moki_lv0013->ArrPush[14]=$vLangArr[32];
$moki_lv0013->ArrPush[15]=$vLangArr[33];
$moki_lv0013->ArrPush[16]=$vLangArr[34];
$moki_lv0013->ArrPush[17]=$vLangArr[35];


$moki_lv0013->ArrFunc[0]='//Function';
$moki_lv0013->ArrFunc[1]=$vLangArr[2];
$moki_lv0013->ArrFunc[2]=$vLangArr[4];
$moki_lv0013->ArrFunc[3]=$vLangArr[6];
$moki_lv0013->ArrFunc[4]=$vLangArr[7];
$moki_lv0013->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$moki_lv0013->ArrFunc[6]=GetLangExcept('Apr',$plang);
$moki_lv0013->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$moki_lv0013->ArrFunc[8]=$vLangArr[10];
$moki_lv0013->ArrFunc[9]=$vLangArr[12];
$moki_lv0013->ArrFunc[10]=$vLangArr[0];
$moki_lv0013->ArrFunc[11]=$vLangArr[38];
$moki_lv0013->ArrFunc[12]=$vLangArr[39];
$moki_lv0013->ArrFunc[13]=$vLangArr[40];
$moki_lv0013->ArrFunc[14]=$vLangArr[41];
$moki_lv0013->ArrFunc[15]=$vLangArr[42];

////Other
$moki_lv0013->ArrOther[1]=$vLangArr[36];
$moki_lv0013->ArrOther[2]=$vLangArr[37];
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
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moki_lv0013->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ki_lv0013",$lvMessage);
}
elseif($flagID==2)
{
$moki_lv0013->lv001=$_POST['txtlv001'];
$moki_lv0013->lv002=$_POST['txtlv002'];
$moki_lv0013->lv003=$_POST['txtlv003'];
$moki_lv0013->lv004=$_POST['txtlv004'];
$moki_lv0013->lv005=$_POST['txtlv005'];
$moki_lv0013->lv006=$_POST['txtlv006'];
$moki_lv0013->lv007=$_POST['txtlv007'];
$moki_lv0013->lv008=$_POST['txtlv008'];
$moki_lv0013->lv009=$_POST['txtlv009'];
$moki_lv0013->lv010=$_POST['txtlv010'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moki_lv0013->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moki_lv0013->LV_UnAproval($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0013->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0013');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moki_lv0013->ListView;
$curPage = $moki_lv0013->CurPage;
$maxRows =$moki_lv0013->MaxRows;
$vOrderList=$moki_lv0013->ListOrder;
$vSortNum=$moki_lv0013->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moki_lv0013->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0013',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($_GET['ChildID']=="")
$moki_lv0013->lv002=$_POST['txtlv002'];
else
$moki_lv0013->lv002=$_GET['ChildID'];
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moki_lv0013->GetCount();
$maxPages = 10;
if($curPage=="") 
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{

	var str="<br><iframe id='lvframefrm' height=1500 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>ki_lv0013?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childfuncdetail="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
function Report(vValue)
{
var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>ki_lv0013?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function UpdateText(o,donhangid,option)
{
		$xmlhttp555=null;		
		xmlhttp555=GetXmlHttpObject();
		if (xmlhttp555==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		url=url+"&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+o.value+"&optrun="+option;
		url=url.replace("#","");
		xmlhttp555.onreadystatechange=stateactivebangtext;
		xmlhttp555.open("GET",url,true);
		xmlhttp555.send(null);	
}
function stateactivebangtext()
{
}
//-->
</script>
<?php
if($moki_lv0013->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $moki_lv0013->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $moki_lv0013->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $moki_lv0013->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $moki_lv0013->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $moki_lv0013->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $moki_lv0013->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $moki_lv0013->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $moki_lv0013->lv007;?>"/>				
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  
</div></div>
<script language="javascript">
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
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $moki_lv0013->ArrPush[0];?>';	
</script>
</html>