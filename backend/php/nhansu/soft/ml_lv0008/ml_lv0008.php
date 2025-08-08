<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ml_lv0008.php");

/////////////init object//////////////
$moml_lv0008=new ml_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0008');
$moml_lv0008->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","ML0013.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moml_lv0008->ArrPush[0]=$vLangArr[17];
$moml_lv0008->ArrPush[1]=$vLangArr[18];
$moml_lv0008->ArrPush[2]=$vLangArr[20];
$moml_lv0008->ArrPush[3]=$vLangArr[21];
$moml_lv0008->ArrPush[4]=$vLangArr[22];
$moml_lv0008->ArrPush[5]=$vLangArr[23];
$moml_lv0008->ArrPush[6]=$vLangArr[24];
$moml_lv0008->ArrPush[7]=$vLangArr[25];
$moml_lv0008->ArrPush[8]=$vLangArr[26];
$moml_lv0008->ArrPush[9]=$vLangArr[34];
$moml_lv0008->ArrPush[10]=$vLangArr[35];

$moml_lv0008->ArrFunc[0]='//Function';
$moml_lv0008->ArrFunc[1]=$vLangArr[2];
$moml_lv0008->ArrFunc[2]=$vLangArr[4];
$moml_lv0008->ArrFunc[3]=$vLangArr[6];
$moml_lv0008->ArrFunc[4]=$vLangArr[7];
$moml_lv0008->ArrFunc[5]='';
$moml_lv0008->ArrFunc[6]='';
$moml_lv0008->ArrFunc[7]='';
$moml_lv0008->ArrFunc[8]=$vLangArr[10];
$moml_lv0008->ArrFunc[9]=$vLangArr[12];
$moml_lv0008->ArrFunc[10]=$vLangArr[0];
$moml_lv0008->ArrFunc[11]=$vLangArr[29];
$moml_lv0008->ArrFunc[12]=$vLangArr[30];
$moml_lv0008->ArrFunc[13]=$vLangArr[31];
$moml_lv0008->ArrFunc[14]=$vLangArr[32];
$moml_lv0008->ArrFunc[15]=$vLangArr[33];
////Other
$moml_lv0008->ArrOther[1]=$vLangArr[27];
$moml_lv0008->ArrOther[2]=$vLangArr[28];
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
	$vresult=$moml_lv0008->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ml_lv0008",$lvMessage);
}
elseif($flagID==2)
{
$moml_lv0008->lv001=$_POST['txtlv001'];
$moml_lv0008->lv002=$_POST['txtlv002'];
$moml_lv0008->lv003=$_POST['txtlv003'];
$moml_lv0008->lv004=$_POST['txtlv004'];
$moml_lv0008->lv005=$_POST['txtlv005'];
$moml_lv0008->lv006=$_POST['txtlv006'];
$moml_lv0008->lv007=$_POST['txtlv007'];
}
if($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moml_lv0008->LV_Delete($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moml_lv0008->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ml_lv0008');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moml_lv0008->ListView;
$curPage = $moml_lv0008->CurPage;
$maxRows =$moml_lv0008->MaxRows;
$vOrderList=$moml_lv0008->ListOrder;
$vSortNum=$moml_lv0008->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moml_lv0008->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ml_lv0008',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
if($_SESSION['ERPSOFV2RUserID']!="admin") $moml_lv0008->lv002=$_SESSION['ERPSOFV2RUserID'];
$totalRowsC=$moml_lv0008->GetCount();
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe height=500 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>ml_lv0008?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;
	scrollToBottom();
}
function FunctRunning1(vID)
{
	window.open('<?php echo $vDir;?>'+'ml_lv0008/?lang=<?php echo $plang;?>&childfunc=download&ID='+vID,'download','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');

}
//-->
</script>
<?php
if($moml_lv0008->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $moml_lv0008->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $moml_lv0008->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $moml_lv0008->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $moml_lv0008->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $moml_lv0008->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $moml_lv0008->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $moml_lv0008->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $moml_lv0008->lv007;?>"/>
				  </form>

				  
</div></div>
</body>
				
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $moml_lv0008->ArrPush[0];?>';	
</script>
</html>