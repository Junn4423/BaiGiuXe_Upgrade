<?php
$vDir = ($_GET['ID']) != '' ? '../' : '';

include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/tc_lv0003.php");

/////////////init object//////////////
$motc_lv0003=new tc_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0003');
$motc_lv0003->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TC0005.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0003->ArrPush[0]=$vLangArr[17];
$motc_lv0003->ArrPush[1]=$vLangArr[18];
$motc_lv0003->ArrPush[2]=$vLangArr[20];
$motc_lv0003->ArrPush[3]=$vLangArr[21];
$motc_lv0003->ArrPush[4]=$vLangArr[22];
$motc_lv0003->ArrPush[5]=$vLangArr[23];
$motc_lv0003->ArrPush[6]=$vLangArr[24];
$motc_lv0003->ArrPush[7]=$vLangArr[25];
$motc_lv0003->ArrPush[8]=$vLangArr[26];

$motc_lv0003->ArrFunc[0]='//Function';
$motc_lv0003->ArrFunc[1]=$vLangArr[2];
$motc_lv0003->ArrFunc[2]=$vLangArr[4];
$motc_lv0003->ArrFunc[3]=$vLangArr[6];
$motc_lv0003->ArrFunc[4]=$vLangArr[7];
$motc_lv0003->ArrFunc[5]='';
$motc_lv0003->ArrFunc[6]='';
$motc_lv0003->ArrFunc[7]='';
$motc_lv0003->ArrFunc[8]=$vLangArr[10];
$motc_lv0003->ArrFunc[9]=$vLangArr[12];
$motc_lv0003->ArrFunc[10]=$vLangArr[0];
$motc_lv0003->ArrFunc[11]=$vLangArr[26];
$motc_lv0003->ArrFunc[12]=$vLangArr[27];
$motc_lv0003->ArrFunc[13]=$vLangArr[28];
$motc_lv0003->ArrFunc[14]=$vLangArr[29];
$motc_lv0003->ArrFunc[15]=$vLangArr[30];
////Other
$motc_lv0003->ArrOther[1]=$vLangArr[24];
$motc_lv0003->ArrOther[2]=$vLangArr[25];
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
	$vresult=$motc_lv0003->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"tc_lv0003",$lvMessage);
}
elseif($flagID==2)
{
$motc_lv0003->lv001=$_POST['txtlv001'];
if( $_GET['ID']=="")
$motc_lv0003->lv002=$_POST['txtlv002'];
else
$motc_lv0003->lv002= $_GET['ID'] ?? '';
$motc_lv0003->lv003=$_POST['txtlv003'];
$motc_lv0003->lv004=$_POST['txtlv004'];
$motc_lv0003->lv005=$_POST['txtlv005'];
$motc_lv0003->lv006=$_POST['txtlv006'];
$motc_lv0003->lv007=$_POST['txtlv007'];
}
if($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0003->LV_Delete($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0003->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0003');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0003->ListView;
$curPage = $motc_lv0003->CurPage;
$maxRows =$motc_lv0003->MaxRows;
$vOrderList=$motc_lv0003->ListOrder;
//$vSortNum=$molv_lv0004->SortNum;
$vSortNum = 0;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$motc_lv0003->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0003',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0003->GetCount();
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
function FunctRunning1(vID)
{
	window.open('<?php echo $vDir;?>'+'tc_lv0003/?lang=<?php echo $plang;?>&func=download&ID='+vID,'download','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');

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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe height=500 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>tc_lv0003?func=<?php echo $_GET['func'];?>&func="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($motc_lv0003->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $motc_lv0003->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $motc_lv0003->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $motc_lv0003->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $motc_lv0003->lv003;?>"/>
					    
				  </form>

				  
</div></div>
</body>
				
<?php
} else {
	include("../tc_lv0003/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $motc_lv0003->ArrPush[0];?>';	
</script>
</html>