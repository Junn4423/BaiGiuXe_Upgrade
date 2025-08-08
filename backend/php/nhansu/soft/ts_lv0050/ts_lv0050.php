<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ts_lv0050.php");

/////////////init object//////////////
$mots_lv0050=new ts_lv0050($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0050');
$mots_lv0050->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TS0059.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0050->ArrPush[0]=$vLangArr[17];
$mots_lv0050->ArrPush[1]=$vLangArr[18];
$mots_lv0050->ArrPush[2]=$vLangArr[20];
$mots_lv0050->ArrPush[3]=$vLangArr[21];
$mots_lv0050->ArrPush[4]=$vLangArr[22];

$mots_lv0050->ArrFunc[0]='//Function';
$mots_lv0050->ArrFunc[1]=$vLangArr[2];
$mots_lv0050->ArrFunc[2]=$vLangArr[4];
$mots_lv0050->ArrFunc[3]=$vLangArr[6];
$mots_lv0050->ArrFunc[4]=$vLangArr[7];
$mots_lv0050->ArrFunc[5]='';
$mots_lv0050->ArrFunc[6]='';
$mots_lv0050->ArrFunc[7]='';
$mots_lv0050->ArrFunc[8]=$vLangArr[10];
$mots_lv0050->ArrFunc[9]=$vLangArr[12];
$mots_lv0050->ArrFunc[10]=$vLangArr[0];
$mots_lv0050->ArrFunc[11]=$vLangArr[25];
$mots_lv0050->ArrFunc[12]=$vLangArr[26];
$mots_lv0050->ArrFunc[13]=$vLangArr[27];
$mots_lv0050->ArrFunc[14]=$vLangArr[28];
$mots_lv0050->ArrFunc[15]=$vLangArr[29];
////Other
$mots_lv0050->ArrOther[1]=$vLangArr[23];
$mots_lv0050->ArrOther[2]=$vLangArr[24];
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
	$vresult=$mots_lv0050->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ts_lv0050",$lvMessage);
}
elseif($flagID==2)
{
$mots_lv0050->lv001=$_POST['txtlv001'];
$mots_lv0050->lv002=$_POST['txtlv002'];
$mots_lv0050->lv003=$_POST['txtlv003'];
}
if($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mots_lv0050->LV_Delete($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0050->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0050');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mots_lv0050->ListView;
$curPage = $mots_lv0050->CurPage;
$maxRows =$mots_lv0050->MaxRows;
$vOrderList=$mots_lv0050->ListOrder;
$vSortNum=$mots_lv0050->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mots_lv0050->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0050',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mots_lv0050->GetCount();
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
	var str="<br><iframe id='lvframefrm' height=250 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>ts_lv0050?&func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($mots_lv0050->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?><?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mots_lv0050->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mots_lv0050->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $mots_lv0050->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003"  value="<?php echo $mots_lv0050->lv003;?>"/>
					    
				  </form>

				  
</div></div>
<div id="lvright"></div>
</body>
				
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mots_lv0050->ArrPush[0];?>';	
</script>
</html>