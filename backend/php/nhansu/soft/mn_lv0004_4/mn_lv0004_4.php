<?php
$vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/mn_lv0004_4.php");

/////////////init object//////////////
$momn_lv0004_4=new mn_lv0004_4($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0004');
$momn_lv0004_4->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","MN0001.txt",$plang);
$momn_lv0004_4->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0004_4->ArrPush[0]=$vLangArr[17];
$momn_lv0004_4->ArrPush[1]=$vLangArr[18];
$momn_lv0004_4->ArrPush[2]=$vLangArr[19];
$momn_lv0004_4->ArrPush[3]=$vLangArr[20];
$momn_lv0004_4->ArrPush[4]=$vLangArr[21];
$momn_lv0004_4->ArrPush[5]=$vLangArr[22];
$momn_lv0004_4->ArrPush[6]=$vLangArr[23];
$momn_lv0004_4->ArrPush[7]=$vLangArr[24];
$momn_lv0004_4->ArrPush[8]=$vLangArr[25];
$momn_lv0004_4->ArrPush[9]=$vLangArr[26];
$momn_lv0004_4->ArrPush[10]=$vLangArr[27];
$momn_lv0004_4->ArrPush[11]=$vLangArr[28];
$momn_lv0004_4->ArrPush[12]=$vLangArr[38];
$momn_lv0004_4->ArrPush[13]=$vLangArr[37];
$momn_lv0004_4->ArrPush[100]='Nhóm';

$momn_lv0004_4->ArrFunc[0]='//Function';
$momn_lv0004_4->ArrFunc[1]=$vLangArr[2];
$momn_lv0004_4->ArrFunc[2]=$vLangArr[4];
$momn_lv0004_4->ArrFunc[3]=$vLangArr[6];
$momn_lv0004_4->ArrFunc[4]=$vLangArr[7];
$momn_lv0004_4->ArrFunc[5]='';
$momn_lv0004_4->ArrFunc[6]='Khoá';
$momn_lv0004_4->ArrFunc[7]='Mở khoá';
$momn_lv0004_4->ArrFunc[8]=$vLangArr[10];
$momn_lv0004_4->ArrFunc[9]=$vLangArr[12];
$momn_lv0004_4->ArrFunc[10]=$vLangArr[0];
$momn_lv0004_4->ArrFunc[11]=$vLangArr[31];
$momn_lv0004_4->ArrFunc[12]=$vLangArr[32];
$momn_lv0004_4->ArrFunc[13]=$vLangArr[33];
$momn_lv0004_4->ArrFunc[14]=$vLangArr[34];
$momn_lv0004_4->ArrFunc[15]=$vLangArr[35];

////Other
$momn_lv0004_4->ArrOther[1]=$vLangArr[29];
$momn_lv0004_4->ArrOther[2]=$vLangArr[30];
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
	$vresult=$momn_lv0004_4->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"mn_lv0004_4",$lvMessage);
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$momn_lv0004_4->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$momn_lv0004_4->LV_UnAproval($strar);
}
if($flagID>0)
{
	$momn_lv0004_4->lv001=$_POST['txtlv001'];
	if( $_GET['ID']=="")
	$momn_lv0004_4->lv002=$_POST['txtlv002'];
	else
	$momn_lv0004_4->lv002= $_GET['ID'] ?? '';
	$momn_lv0004_4->lv003=$_POST['txtlv003'];
	$momn_lv0004_4->lv004=$_POST['txtlv004'];
	$momn_lv0004_4->lv005=$_POST['txtlv005'];
	$momn_lv0004_4->lv006=$_POST['txtlv006'];
	$momn_lv0004_4->lv007=$_POST['txtlv007'];
	$momn_lv0004_4->lv008=$_POST['txtlv008'];
	$momn_lv0004_4->lv009=$_POST['txtlv009'];
	$momn_lv0004_4->lv010=$_POST['txtlv010'];
	$momn_lv0004_4->lv011=$_POST['txtlv011'];
	$momn_lv0004_4->lv012=$_POST['txtlv012'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0004_4->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0004_4');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$momn_lv0004_4->ListView;
$curPage = $momn_lv0004_4->CurPage;
$maxRows =$momn_lv0004_4->MaxRows;
$vOrderList=$momn_lv0004_4->ListOrder;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$momn_lv0004_4->SaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0004_4',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if( $_GET['ID']=="")
$momn_lv0004_4->lv002=$_POST['txtlv002'];
else
$momn_lv0004_4->lv002= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$momn_lv0004_4->GetCount();
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,8,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=500 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>mn_lv0004_4?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>'\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;
	ProcessHiden();scrollToBottom();
}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function Approvals(vValue)
{
	if(confirm("Bạn có đồng ý phát lệnh sản xuất không(Y/N)?"))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=3;
		o.target="_self";
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,8,0);?>"
		o.submit();
	}
}
function UnApr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function UnApprovals(vValue)
{
	if(confirm("Bạn có muốn huỷ LSX không?(Y/N)"))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.target="_self";
		o.txtFlag.value=4;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,8,0);?>"
		o.submit();
	}
}
//-->
</script>
<?php
if($momn_lv0004_4->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft">
					<form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo  $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,8,0);?>" method="post" name="frmchoose" id="frmchoose">
						<input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $momn_lv0004_4->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $momn_lv0004_4->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $momn_lv0004_4->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $momn_lv0004_4->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $momn_lv0004_4->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $momn_lv0004_4->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $momn_lv0004_4->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $momn_lv0004_4->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $momn_lv0004_4->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $momn_lv0004_4->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $momn_lv0004_4->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $momn_lv0004_4->lv011;?>"/>
					</form>				  
</div></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../mn_lv0004_4/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $momn_lv0004_4->ArrPush[0];?>';	
</script>
</html>