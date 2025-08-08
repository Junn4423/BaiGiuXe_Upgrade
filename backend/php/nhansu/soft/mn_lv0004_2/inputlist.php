<?php
$vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/mn_lv0004_2.php");

/////////////init object//////////////
$momn_lv0004_2=new mn_lv0004_2($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0004');
$momn_lv0004_2->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","WH0008.txt",$plang);
$momn_lv0004_2->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0004_2->ArrPush[0]=$vLangArr[17];
$momn_lv0004_2->ArrPush[1]=$vLangArr[18];
$momn_lv0004_2->ArrPush[2]=$vLangArr[19];
$momn_lv0004_2->ArrPush[3]=$vLangArr[20];
$momn_lv0004_2->ArrPush[4]=$vLangArr[21];
$momn_lv0004_2->ArrPush[5]=$vLangArr[22];
$momn_lv0004_2->ArrPush[6]=$vLangArr[23];
$momn_lv0004_2->ArrPush[7]=$vLangArr[24];
$momn_lv0004_2->ArrPush[8]=$vLangArr[25];
$momn_lv0004_2->ArrPush[9]=$vLangArr[26];
$momn_lv0004_2->ArrPush[10]=$vLangArr[27];
$momn_lv0004_2->ArrPush[11]=$vLangArr[28];
$momn_lv0004_2->ArrPush[12]=$vLangArr[29];
$momn_lv0004_2->ArrPush[13]=$vLangArr[30];
$momn_lv0004_2->ArrPush[14]=$vLangArr[31];
$momn_lv0004_2->ArrPush[15]=$vLangArr[32];

$momn_lv0004_2->ArrFunc[0]='//Function';
$momn_lv0004_2->ArrFunc[1]=$vLangArr[2];
$momn_lv0004_2->ArrFunc[2]=$vLangArr[4];
$momn_lv0004_2->ArrFunc[3]=$vLangArr[6];
$momn_lv0004_2->ArrFunc[4]=$vLangArr[7];
$momn_lv0004_2->ArrFunc[5]='';
$momn_lv0004_2->ArrFunc[6]='';
$momn_lv0004_2->ArrFunc[7]='';
$momn_lv0004_2->ArrFunc[8]=$vLangArr[10];
$momn_lv0004_2->ArrFunc[9]=$vLangArr[12];
$momn_lv0004_2->ArrFunc[10]=$vLangArr[0];
$momn_lv0004_2->ArrFunc[11]=$vLangArr[33];
$momn_lv0004_2->ArrFunc[12]=$vLangArr[34];
$momn_lv0004_2->ArrFunc[13]=$vLangArr[35];
$momn_lv0004_2->ArrFunc[14]=$vLangArr[36];
$momn_lv0004_2->ArrFunc[15]=$vLangArr[37];

////Other
$momn_lv0004_2->ArrOther[1]=$vLangArr[31];
$momn_lv0004_2->ArrOther[2]=$vLangArr[32];
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

//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0004_2->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0004_2');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$momn_lv0004_2->ListView;
$curPage = $momn_lv0004_2->CurPage;
$maxRows =$momn_lv0004_2->MaxRows;
$vOrderList=$momn_lv0004_2->ListOrder;
$vSortNum=$momn_lv0004_2->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$momn_lv0004_2->SaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0004_2',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$momn_lv0004_2->lv002=$_GET['ChildID'];
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$momn_lv0004_2->GetCount();
$maxPages = 15;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	for($i=$curRow;$i<$maxRows+$curRow;$i++)
	{
		$momn_lv0004_2->lv001=$_POST['txtlv001'.$i];
		$momn_lv0004_2->lv002=$_POST['txtlv002'.$i];
		$momn_lv0004_2->lv008=$_POST['txtlv008'.$i];
		$momn_lv0004_2->lv009=$_POST['txtlv009'.$i];
		$momn_lv0004_2->lv010=$_POST['txtlv010'.$i];
		$momn_lv0004_2->lv011=$_POST['txtlv011'.$i];
		$momn_lv0004_2->lv012=$_POST['txtlv012'.$i];
		$vresult=$momn_lv0004_2->LV_UpdateOther();

	}
	$momn_lv0004_2->lv002=$_GET['ChildID'];
	$momn_lv0004_2->lv001='';
	$momn_lv0004_2->lv008='';
	$momn_lv0004_2->lv009='';
	$momn_lv0004_2->lv010='';
	$momn_lv0004_2->lv011='';
	$momn_lv0004_2->lv012='';
	
}
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,6,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=600 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>mn_lv0004_2?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>'\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Save()
	{
		var o=document.frmchoose;

				o.txtFlag.value="1";
				o.submit();
		
	}
//-->
</script>
<?php
if($momn_lv0004_2->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $momn_lv0004_2->LV_BuilListInput($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="0"/>
					
					

				  </form>
				  
</div></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../mn_lv0004_2/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $momn_lv0004_2->ArrPush[0];?>';	
</script>
</html>