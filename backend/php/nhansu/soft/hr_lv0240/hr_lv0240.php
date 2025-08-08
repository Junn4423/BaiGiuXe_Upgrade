<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/hr_lv0240.php");

/////////////init object//////////////
$mohr_lv0240=new hr_lv0240($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0240');
$mohr_lv0240->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($mohr_lv0240->GetEdit()==1)
{
	if(isset($_GET['ajaxbangtext']))
	{
		$vdonhangid=$_GET['donhangid'];
		$vText=$_GET['textup'];
		$vText=str_replace('$$$','+',$vText);
		$voption=$_GET['optrun'];
		if($vdonhangid!='' && $vdonhangid!=NULL)
		{
			$vUserID=$mohr_lv0240->LV_UserID;
			$vlvField='lv'.Fillnum($voption,3);
			switch($voption)
			{
				case 3:			
					$vsql="update hr_lv0240 set $vlvField='$vText' where lv001='$vdonhangid'";
					break;
			}
			$vresult=db_query($vsql);

		}
		exit;
	}
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","HR0323.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0240->ArrPush[0]=$vLangArr[17];
$mohr_lv0240->ArrPush[1]=$vLangArr[18];
$mohr_lv0240->ArrPush[2]=$vLangArr[20];
$mohr_lv0240->ArrPush[3]=$vLangArr[21];
$mohr_lv0240->ArrPush[4]=$vLangArr[22];
$mohr_lv0240->ArrPush[5]=$vLangArr[23];
$mohr_lv0240->ArrPush[6]=$vLangArr[24];
$mohr_lv0240->ArrPush[7]=$vLangArr[25];

$mohr_lv0240->ArrFunc[0]='//Function';
$mohr_lv0240->ArrFunc[1]=$vLangArr[2];
$mohr_lv0240->ArrFunc[2]=$vLangArr[4];
$mohr_lv0240->ArrFunc[3]=$vLangArr[6];
$mohr_lv0240->ArrFunc[4]=$vLangArr[7];
$mohr_lv0240->ArrFunc[5]='';
$mohr_lv0240->ArrFunc[6]='';
$mohr_lv0240->ArrFunc[7]='';
$mohr_lv0240->ArrFunc[8]=$vLangArr[10];
$mohr_lv0240->ArrFunc[9]=$vLangArr[12];
$mohr_lv0240->ArrFunc[10]=$vLangArr[0];
$mohr_lv0240->ArrFunc[11]=$vLangArr[28];
$mohr_lv0240->ArrFunc[12]=$vLangArr[29];
$mohr_lv0240->ArrFunc[13]=$vLangArr[30];
$mohr_lv0240->ArrFunc[14]=$vLangArr[31];
$mohr_lv0240->ArrFunc[15]=$vLangArr[32];
////Other
$mohr_lv0240->ArrOther[1]=$vLangArr[26];
$mohr_lv0240->ArrOther[2]=$vLangArr[27];
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
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0240->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0240",$lvMessage);
}
elseif($flagID==6)
{
	$mohr_lv0240->lv001=$_POST['qxtlv001'];
	$mohr_lv0240->lv002=$_POST['qxtlv002'];
	$mohr_lv0240->lv003=$_POST['qxtlv003'];
	$mohr_lv0240->lv004=$_POST['qxtlv004'];
	$vresult=$mohr_lv0240->LV_Insert();	
	if(!$vresult)
	{
		$mohr_lv0240->Values['lv001']=$_POST['qxtlv001'];
		$mohr_lv0240->Values['lv002']=$_POST['qxtlv002'];
		$mohr_lv0240->Values['lv003']=$_POST['qxtlv003'];
		$mohr_lv0240->Values['lv004']=$_POST['qxtlv004'];
		echo sof_error();	
	}
	$mohr_lv0240->lv001='';
	$mohr_lv0240->lv002='';
	$mohr_lv0240->lv003='';
	$mohr_lv0240->lv004='';
}
elseif($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0240->LV_Delete($strar);
}

if($flagID>0)
{
	$mohr_lv0240->lv001=$_POST['txtlv001'];
	$mohr_lv0240->lv002=$_POST['txtlv002'];
	$mohr_lv0240->lv003=$_POST['txtlv003'];
	$mohr_lv0240->lv004=$_POST['txtlv004'] ?? '';
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$mohr_lv0240->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0240');
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$vFieldList=$mohr_lv0240->ListView;
	$curPage = $mohr_lv0240->CurPage;
	$maxRows =$mohr_lv0240->MaxRows;
	$vOrderList=$mohr_lv0240->ListOrder;
	$vSortNum=$mohr_lv0240->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0240->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0240',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0240->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>MINH PHUONG</title>
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'] ?? '';?>
	&lv002=<?php echo $_POST['txtlv002'] ?? '';?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var oparent=window.parent.document.getElementById('showparent');
	if(oparent!=null) 
		var oheight=parseInt(oparent.style.height);
	else
		var oheight=0;
	oheight=oheight-10;
	if(isNaN(oheight)) oheight=1000;
	if(oheight<0) oheight=1000;
	var str="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>hr_lv0240?&func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>' class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Save()
{
	var o=document.frmchoose;
	o.txtFlag.value=6;
	if(o.qxtlv001.value==""){
		alert("Trade Term Code is not empty!");
		o.qxtlv001.focus();
	}	
	else if(o.qxtlv002.value==""){
		alert("Trade Term Name is not empty!");
		o.qxtlv002.focus();
	}	
	else
	{
		o.submit();
	}
}
	setTimeout(focusmain,1000);
function focusmain()
{
	document.getElementById('qxtlv001').focus();
}
//-->
</script>
<?php
if($mohr_lv0240->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft">
					<form onSubmit="return false;" 
      action="?func=<?= $_GET['func'] ?? '' ?>&ID=<?=  $_GET['ID'] ?? '' ?><?= getsaveget($plang, $popt, $pitem, $plink, $pgroup, 0, 0, 0, 0); ?>" 
      method="post" name="frmchoose" id="frmchoose">
					  	<input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>						
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0240->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $mohr_lv0240->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003"  value="<?php echo $mohr_lv0240->lv003;?>"/>
					    <?php echo $mohr_lv0240->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
				  </form>

				  
</div></div>
</body>
				
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
function UpdateTextCheck(o,donhangid,option)
{
		$xmlhttp555=null;		
		xmlhttp555=GetXmlHttpObject();
		if (xmlhttp555==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		var value=(o.checked)?1:0;
		url=url+"&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+value+"&optrun="+option;
		url=url.replace("#","");
		xmlhttp555.onreadystatechange=stateactivebangtext;
		xmlhttp555.open("GET",url,true);
		xmlhttp555.send(null);	
}	
function stateactivebangtext()
{
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
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mohr_lv0240->ArrPush[0];?>';	
</script>
</html>