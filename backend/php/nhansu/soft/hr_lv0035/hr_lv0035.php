<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/hr_lv0035.php");

/////////////init object//////////////
$mohr_lv0035=new hr_lv0035($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0066');
$mohr_lv0035->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($mohr_lv0035->GetEdit()==1)
{
	if(isset($_GET['ajaxbangtext']))
	{
		$vdonhangid=$_GET['donhangid'];
		$vText=$_GET['textup'];
		$vText=str_replace('$$$','+',$vText);
		$voption=$_GET['optrun'];
		if($vdonhangid!='' && $vdonhangid!=NULL)
		{
			$vUserID=$mohr_lv0035->LV_UserID;
			$vlvField='lv'.Fillnum($voption,3);
			switch($voption)
			{
				case 6:			
					$vsql="update hr_lv0035 set $vlvField='$vText' where lv001='$vdonhangid'";
					break;
			}
			$vresult=db_query($vsql);

		}
		exit;
	}
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","HR0152.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0035->ArrPush[0]=$vLangArr[17];
$mohr_lv0035->ArrPush[1]=$vLangArr[18];
$mohr_lv0035->ArrPush[2]=$vLangArr[20];
$mohr_lv0035->ArrPush[3]=$vLangArr[21];

$mohr_lv0035->ArrPush[4]='Số tiền trừ';
$mohr_lv0035->ArrPush[5]='Từ ngày';
$mohr_lv0035->ArrPush[6]='Đến ngày';
$mohr_lv0035->ArrPush[7]='Loại';

$mohr_lv0035->ArrFunc[0]='//Function';
$mohr_lv0035->ArrFunc[1]=$vLangArr[2];
$mohr_lv0035->ArrFunc[2]=$vLangArr[4];
$mohr_lv0035->ArrFunc[3]=$vLangArr[6];
$mohr_lv0035->ArrFunc[4]=$vLangArr[7];
$mohr_lv0035->ArrFunc[5]='';
$mohr_lv0035->ArrFunc[6]='';
$mohr_lv0035->ArrFunc[7]='';
$mohr_lv0035->ArrFunc[8]=$vLangArr[10];
$mohr_lv0035->ArrFunc[9]=$vLangArr[12];
$mohr_lv0035->ArrFunc[10]=$vLangArr[0];
$mohr_lv0035->ArrFunc[11]=$vLangArr[24];
$mohr_lv0035->ArrFunc[12]=$vLangArr[25];
$mohr_lv0035->ArrFunc[13]=$vLangArr[26];
$mohr_lv0035->ArrFunc[14]=$vLangArr[27];
$mohr_lv0035->ArrFunc[15]=$vLangArr[28];
////Other
$mohr_lv0035->ArrOther[1]=$vLangArr[22];
$mohr_lv0035->ArrOther[2]=$vLangArr[23];
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
	$vresult=$mohr_lv0035->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0035",$lvMessage);
}
elseif($flagID==2)
{
$mohr_lv0035->lv001=$_POST['txtlv001'];
$mohr_lv0035->lv002=$_POST['txtlv002'];
}
if($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0035->LV_Delete($strar);
}
elseif($flagID==6)
{
	$mohr_lv0035->lv001=$_POST['qxtlv001'];
	$mohr_lv0035->lv002=$_POST['qxtlv002'];
	$mohr_lv0035->lv003=$_POST['qxtlv003'];
	$mohr_lv0035->lv004=$_POST['qxtlv004'];
	$mohr_lv0035->lv005=$_POST['qxtlv005'];
	$mohr_lv0035->lv006=$_POST['qxtlv006'];
	$mohr_lv0035->lv007=$_POST['qxtlv007'];
	$vresult=$mohr_lv0035->LV_Insert();	
	if(!$vresult)
	{
		$mohr_lv0035->Values['lv001']=$_POST['qxtlv001'];
		$mohr_lv0035->Values['lv002']=$_POST['qxtlv002'];
		$mohr_lv0035->Values['lv003']=$_POST['qxtlv003'];
		$mohr_lv0035->Values['lv004']=$_POST['qxtlv004'];
		$mohr_lv0035->Values['lv005']=$_POST['qxtlv005'];
		$mohr_lv0035->Values['lv006']=$_POST['qxtlv006'];
		$mohr_lv0035->Values['lv007']=$_POST['qxtlv007'];
		echo sof_error();	
	}
	$mohr_lv0035->lv001='';
	$mohr_lv0035->lv002='';
	$mohr_lv0035->lv003='';
	$mohr_lv0035->lv004='';
	$mohr_lv0035->lv005='';
	$mohr_lv0035->lv006='';
	$mohr_lv0035->lv007='';
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0035->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0035');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0035->ListView;
$curPage = $mohr_lv0035->CurPage;
$maxRows =$mohr_lv0035->MaxRows;
$vOrderList=$mohr_lv0035->ListOrder;
$vSortNum=$mohr_lv0035->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0035->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0035',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0035->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>','filter');
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
	var str="<br><iframe height=250 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>hr_lv0035?&func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Save()
{
	var o=document.frmchoose;
	o.txtFlag.value=6;
	if(o.qxtlv001.value==""){
		alert("Mã không rỗng");
		o.qxtlv001.focus();
	}	
	else if(o.qxtlv002.value==""){
		alert("Xin vui lòng nhập tên");
		o.qxtlv002.focus();
	}	
	else
	{
		o.submit();
	}
}
//-->
</script>
<?php
if($mohr_lv0035->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft"><form onsubmit="return false;"
      action="?func=<?= htmlspecialchars($_GET['func'] ?? '') ?>&ID=<?= htmlspecialchars( $_GET['ID'] ?? '') ?><?= getsaveget($plang, $popt, $pitem, $plink, $pgroup, 0, 0, 0, 0); ?>"
      method="post"
      name="frmchoose"
      id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0035->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0035->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $mohr_lv0035->lv002;?>"/>
					    
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
div.innerHTML='<?php echo $mohr_lv0035->ArrPush[0];?>';	
</script>
</html>