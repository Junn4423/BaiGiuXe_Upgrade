<?php
$vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/hr_lv0045.php");

/////////////init object//////////////
$mohr_lv0045=new hr_lv0045($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0071');
$mohr_lv0045->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","HR0166.txt",$plang);
$mohr_lv0045->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0045->ArrPush[0]=$vLangArr[17];
$mohr_lv0045->ArrPush[1]=$vLangArr[18];
$mohr_lv0045->ArrPush[2]=$vLangArr[20];
$mohr_lv0045->ArrPush[3]=$vLangArr[21];
$mohr_lv0045->ArrPush[4]=$vLangArr[22];
$mohr_lv0045->ArrPush[5]=$vLangArr[23];
$mohr_lv0045->ArrPush[6]=$vLangArr[24];
$mohr_lv0045->ArrPush[7]=$vLangArr[25];
$mohr_lv0045->ArrPush[8]=$vLangArr[26];
$mohr_lv0045->ArrPush[9]=$vLangArr[27];
$mohr_lv0045->ArrPush[10]=$vLangArr[28];
$mohr_lv0045->ArrPush[11]=$vLangArr[29];
$mohr_lv0045->ArrPush[12]=$vLangArr[30];
$mohr_lv0045->ArrPush[13]=$vLangArr[31];
$mohr_lv0045->ArrPush[14]=$vLangArr[32];

$mohr_lv0045->ArrFunc[0]='//Function';
$mohr_lv0045->ArrFunc[1]=$vLangArr[2];
$mohr_lv0045->ArrFunc[2]=$vLangArr[4];
$mohr_lv0045->ArrFunc[3]=$vLangArr[6];
$mohr_lv0045->ArrFunc[4]=$vLangArr[7];
$mohr_lv0045->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mohr_lv0045->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mohr_lv0045->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mohr_lv0045->ArrFunc[8]=$vLangArr[10];
$mohr_lv0045->ArrFunc[9]=$vLangArr[12];
$mohr_lv0045->ArrFunc[10]=$vLangArr[0];
$mohr_lv0045->ArrFunc[11]=$vLangArr[35];
$mohr_lv0045->ArrFunc[12]=$vLangArr[36];
$mohr_lv0045->ArrFunc[13]=$vLangArr[37];
$mohr_lv0045->ArrFunc[14]=$vLangArr[38];
$mohr_lv0045->ArrFunc[15]=$vLangArr[39];
////Other
$mohr_lv0045->ArrOther[1]=$vLangArr[33];
$mohr_lv0045->ArrOther[2]=$vLangArr[34];
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
$mohr_lv0045->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0045');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0045->ListView;
$curPage = $mohr_lv0045->CurPage;
$maxRows =$mohr_lv0045->MaxRows;
$vOrderList=$mohr_lv0045->ListOrder;
$vSortNum=$mohr_lv0045->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0045->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0045',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mohr_lv0045->lv002=$_GET['ChildID'];
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0045->GetCount();
$maxPages = 15;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	for($i=$curRow;$i<$maxRows+$curRow;$i++)
	{
		$mohr_lv0045->lv001=$_POST['txtlv001'.$i];
		$mohr_lv0045->lv002=$_POST['txtlv002'.$i];
		$mohr_lv0045->lv005=$_POST['txtlv005'.$i];
		$mohr_lv0045->lv009=$_POST['txtlv009'.$i];
		$vresult=$mohr_lv0045->LV_UpdateOther();

	}
	$mohr_lv0045->lv002=$_GET['ChildID'];
	$mohr_lv0045->lv001='';
	$mohr_lv0045->lv005='';
	$mohr_lv0045->lv009='';
	
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe height=600 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>hr_lv0045?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
if($mohr_lv0045->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0045->LV_BuilListInput($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
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
	include("$vDir../hr_lv0045/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mohr_lv0045->ArrPush[0];?>';	
</script>
</html>