<?php
session_start();
$vDir='../';
include($vDir."paras.php");
require_once($vDir."config.php");
require_once($vDir."configrun.php");
require_once($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ts_lv0032.php");

/////////////init object//////////////
$mots_lv0032=new ts_lv0032($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0032');
$mots_lv0032->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TS0039.txt",$plang);
$mots_lv0032->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0032->ArrPush[0]=$vLangArr[17];
$mots_lv0032->ArrPush[1]=$vLangArr[18];
$mots_lv0032->ArrPush[2]=$vLangArr[30];
$mots_lv0032->ArrPush[3]=$vLangArr[28];
$mots_lv0032->ArrPush[4]=$vLangArr[31];
$mots_lv0032->ArrPush[5]=$vLangArr[32];
$mots_lv0032->ArrPush[6]=$vLangArr[33];
$mots_lv0032->ArrPush[7]=$vLangArr[34];
$mots_lv0032->ArrPush[8]=$vLangArr[35];
$mots_lv0032->ArrPush[9]=$vLangArr[36];
$mots_lv0032->ArrPush[10]=$vLangArr[37];
$mots_lv0032->ArrPush[11]=$vLangArr[38];
$mots_lv0032->ArrPush[12]=$vLangArr[39];
$mots_lv0032->ArrPush[13]=$vLangArr[40];
$mots_lv0032->ArrPush[14]=$vLangArr[52];
$mots_lv0032->ArrPush[15]=$vLangArr[48];
$mots_lv0032->ArrPush[16]=$vLangArr[43];
$mots_lv0032->ArrPush[17]=$vLangArr[27];
$mots_lv0032->ArrPush[18]=$vLangArr[27];
$mots_lv0032->ArrPush[98]=$vLangArr[50];
$mots_lv0032->ArrPush[99]=$vLangArr[49];

$mots_lv0032->ArrFunc[0]='//Function';
$mots_lv0032->ArrFunc[1]=$vLangArr[2];
$mots_lv0032->ArrFunc[2]=$vLangArr[4];
$mots_lv0032->ArrFunc[3]=$vLangArr[6];
$mots_lv0032->ArrFunc[4]=$vLangArr[7];
$mots_lv0032->ArrFunc[5]='';
$mots_lv0032->ArrFunc[6]='';
$mots_lv0032->ArrFunc[7]='';
$mots_lv0032->ArrFunc[8]=$vLangArr[10];
$mots_lv0032->ArrFunc[9]=$vLangArr[12];
$mots_lv0032->ArrFunc[10]=$vLangArr[0];
$mots_lv0032->ArrFunc[11]=$vLangArr[43];
$mots_lv0032->ArrFunc[12]=$vLangArr[44];
$mots_lv0032->ArrFunc[13]=$vLangArr[45];
$mots_lv0032->ArrFunc[14]=$vLangArr[46];
$mots_lv0032->ArrFunc[15]=$vLangArr[47];

////Other
$mots_lv0032->ArrOther[1]=$vLangArr[41];
$mots_lv0032->ArrOther[2]=$vLangArr[42];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$flag=(int)$_GET["txtOpt"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mots_lv0032->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ts_lv0032",$lvMessage);
}
elseif($flagID==2)
{
$mots_lv0032->lv001=$_POST['txtlv001'];
$mots_lv0032->lv002=$_POST['txtlv002'];
$mots_lv0032->lv003=$_POST['txtlv003'];
$mots_lv0032->lv004=$_POST['txtlv004'];
$mots_lv0032->lv005=$_POST['txtlv005'];
$mots_lv0032->lv006=$_POST['txtlv006'];
$mots_lv0032->lv007=$_POST['txtlv007'];
$mots_lv0032->lv008=$_POST['txtlv008'];
$mots_lv0032->lv009=$_POST['txtlv009'];
$mots_lv0032->lv010=$_POST['txtlv010'];
$mots_lv0032->lv011=$_POST['txtlv011'];
$mots_lv0032->lv012=$_POST['txtlv012'];
$mots_lv0032->lv013=$_POST['txtlv013'];
}

if($flag==1)
{
	$mots_lv0032->lv001=$_GET['txtlv001'];
	$mots_lv0032->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$mots_lv0032->lv003=$_GET['txtlv003'];
	$mots_lv0032->lv004=$_GET['txtlv004'];
	$mots_lv0032->lv005=$_GET['txtlv005'];
	$mots_lv0032->lv006=$_GET['txtlv006'];
	$mots_lv0032->lv007=$_GET['txtlv007'];
	$mots_lv0032->lv008=$_GET['txtlv008'];
	$mots_lv0032->lv009=$_GET['txtlv009'];
	$mots_lv0032->lv010=$_GET['txtlv010'];
	$mots_lv0032->lv011=$_GET['txtlv011'];
	$mots_lv0032->lv012=$_GET['txtlv012'];
	$mots_lv0032->lv013=$_GET['txtlv013'];
	$strReturn=$mots_lv0032->LV_Insert();
	
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0032->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0032');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mots_lv0032->ListView;
$curPage = $mots_lv0032->CurPage;
$maxRows =$mots_lv0032->MaxRows;
$vOrderList=$mots_lv0032->ListOrder;
$vSortNum=$mots_lv0032->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mots_lv0032->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0032',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mots_lv0032->lv003='';
$mots_lv0032->lv004='';
$mots_lv0032->lv005='';
$mots_lv0032->lv006='';
$mots_lv0032->lv007='';
$mots_lv0032->lv008='';
$mots_lv0032->lv009='';
$mots_lv0032->lv010='';
$mots_lv0032->lv011='';
$mots_lv0032->lv012='';
$mots_lv0032->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mots_lv0032->GetCount();
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>ts_lv0032?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($mots_lv0032->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo  $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mots_lv0032->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mots_lv0032->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mots_lv0032->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mots_lv0032->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mots_lv0032->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mots_lv0032->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mots_lv0032->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mots_lv0032->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mots_lv0032->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mots_lv0032->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mots_lv0032->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mots_lv0032->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mots_lv0032->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mots_lv0032->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mots_lv0032->lv014;?>"/>	
					

				  </form>
			  
</div></div>
<div id="lvright"></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mots_lv0032->ArrPush[0];?>';	
</script>
</html>