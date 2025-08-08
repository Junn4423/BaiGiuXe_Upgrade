<?php

$vDir = '';
if (isset($_GET['ID']) && $_GET['ID'] != "") {
    $vDir = '../';
}
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/mn_lv0005.php");

/////////////init object//////////////
$momn_lv0005=new mn_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0005');
$momn_lv0005->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","MN0015.txt",$plang);
$momn_lv0005->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0005->ArrPush[0]=$vLangArr[17];
$momn_lv0005->ArrPush[1]=$vLangArr[18];
$momn_lv0005->ArrPush[2]=$vLangArr[19];
$momn_lv0005->ArrPush[3]=$vLangArr[20];
$momn_lv0005->ArrPush[4]=$vLangArr[21];

$momn_lv0005->ArrFunc[0]='//Function';
$momn_lv0005->ArrFunc[1]=$vLangArr[2];
$momn_lv0005->ArrFunc[2]=$vLangArr[4];
$momn_lv0005->ArrFunc[3]=$vLangArr[6];
$momn_lv0005->ArrFunc[4]=$vLangArr[7];
$momn_lv0005->ArrFunc[5]='';
$momn_lv0005->ArrFunc[6]='';
$momn_lv0005->ArrFunc[7]='';
$momn_lv0005->ArrFunc[8]=$vLangArr[10];
$momn_lv0005->ArrFunc[9]=$vLangArr[12];
$momn_lv0005->ArrFunc[10]=$vLangArr[0];
$momn_lv0005->ArrFunc[11]=$vLangArr[24];
$momn_lv0005->ArrFunc[12]=$vLangArr[25];
$momn_lv0005->ArrFunc[13]=$vLangArr[26];
$momn_lv0005->ArrFunc[14]=$vLangArr[27];
$momn_lv0005->ArrFunc[15]=$vLangArr[28];

////Other
$momn_lv0005->ArrOther[1]=$vLangArr[22];
$momn_lv0005->ArrOther[2]=$vLangArr[23];
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
	$vresult=$momn_lv0005->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"mn_lv0005",$lvMessage);
}
elseif($flagID==2)
{
$momn_lv0005->lv001=$_POST['txtlv001'];
if( $_GET['ID']=="")
$momn_lv0005->lv002=$_POST['txtlv002'];
else
$momn_lv0005->lv002= $_GET['ID'] ?? '';
$momn_lv0005->lv003=$_POST['txtlv003'];

}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0005->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0005');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$momn_lv0005->ListView;
$curPage = $momn_lv0005->CurPage;
$maxRows =$momn_lv0005->MaxRows;
$vOrderList=$momn_lv0005->ListOrder;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$momn_lv0005->SaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0005',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if (isset($_GET['ID']) && $_GET['ID'] != "") 
$momn_lv0005->lv002=$_POST['txtlv002']?? '';
else
$momn_lv0005->lv002= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$momn_lv0005->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=500 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>mn_lv0005?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>'\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($momn_lv0005->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo htmlspecialchars($_GET['func'] ?? '', ENT_QUOTES); ?>&childfunc=<?php echo htmlspecialchars($_GET['childfunc'] ?? '', ENT_QUOTES);?>&ChildID=<?php echo htmlspecialchars($_GET['ChildID'] ?? '', ENT_QUOTES);?>&ID=<?php echo htmlspecialchars( $_GET['ID'] ?? '', ENT_QUOTES); ?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php if (!isset($vSortNum)) {
    $vSortNum = 0; // hoặc giá trị phù hợp với logic bạn cần
} echo $momn_lv0005->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $momn_lv0005->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $momn_lv0005->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $momn_lv0005->lv003;?>"/>
						
				  </form>
				  
</div></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../mn_lv0005/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $momn_lv0005->ArrPush[0];?>';	
</script>
</html>