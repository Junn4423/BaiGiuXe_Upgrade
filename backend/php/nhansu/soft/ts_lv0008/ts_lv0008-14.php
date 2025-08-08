<?php
if($_GET['ChildDetailID']!='')
{
	$_GET['ChildID']=$_GET['ChildDetailID'];
}
if($_GET['ChildID']!="") $vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ts_lv0008.php");

/////////////init object//////////////
$mots_lv0008=new ts_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0008');
$mots_lv0008->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TS0010.txt",$plang);
$mots_lv0008->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0008->ArrPush[0]=$vLangArr[17];
$mots_lv0008->ArrPush[1]=$vLangArr[18];
$mots_lv0008->ArrPush[2]=$vLangArr[19];
$mots_lv0008->ArrPush[3]=$vLangArr[20];
$mots_lv0008->ArrPush[4]=$vLangArr[21];
$mots_lv0008->ArrPush[5]=$vLangArr[22];
$mots_lv0008->ArrPush[6]=$vLangArr[23];
$mots_lv0008->ArrPush[7]=$vLangArr[24];
$mots_lv0008->ArrPush[8]=$vLangArr[25];
$mots_lv0008->ArrPush[9]=$vLangArr[26];
$mots_lv0008->ArrPush[10]=$vLangArr[27];
$mots_lv0008->ArrPush[11]=$vLangArr[39];
$mots_lv0008->ArrPush[100]=$vLangArr[40];

$mots_lv0008->ArrFunc[0]='//Function';
$mots_lv0008->ArrFunc[1]=$vLangArr[2];
$mots_lv0008->ArrFunc[2]=$vLangArr[4];
$mots_lv0008->ArrFunc[3]=$vLangArr[6];
$mots_lv0008->ArrFunc[4]=$vLangArr[7];
$mots_lv0008->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mots_lv0008->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mots_lv0008->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mots_lv0008->ArrFunc[8]=$vLangArr[10];
$mots_lv0008->ArrFunc[9]=$vLangArr[12];
$mots_lv0008->ArrFunc[10]=$vLangArr[0];
$mots_lv0008->ArrFunc[11]=$vLangArr[32];
$mots_lv0008->ArrFunc[12]=$vLangArr[33];
$mots_lv0008->ArrFunc[13]=$vLangArr[34];
$mots_lv0008->ArrFunc[14]=$vLangArr[35];
$mots_lv0008->ArrFunc[15]=$vLangArr[36];

////Other
$mots_lv0008->ArrOther[1]=$vLangArr[30];
$mots_lv0008->ArrOther[2]=$vLangArr[31];
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
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mots_lv0008->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ts_lv0008",$lvMessage);
}
elseif($flagID==2)
{
$mots_lv0008->lv001=$_POST['txtlv001'];
if($_GET['ChildID']=="")
$mots_lv0008->lv006=$_POST['txtlv006'];
else
$mots_lv0008->lv006=$_GET['ChildID'];
$mots_lv0008->lv003=$_POST['txtlv003'];
$mots_lv0008->lv004=$_POST['txtlv004'];
$mots_lv0008->lv005=$_POST['txtlv005'];
$mots_lv0008->lv002=$_POST['txtlv002'];
$mots_lv0008->lv007=$_POST['txtlv007'];
$mots_lv0008->lv008=$_POST['txtlv008'];
$mots_lv0008->lv009=$_POST['txtlv009'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mots_lv0008->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mots_lv0008->LV_UnAproval($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0008->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0008');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mots_lv0008->ListView;
$curPage = $mots_lv0008->CurPage;
$maxRows =$mots_lv0008->MaxRows;
$vOrderList=$mots_lv0008->ListOrder;
$vSortNum=$mots_lv0008->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mots_lv0008->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0008',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($_GET['ChildID']=="")
$mots_lv0008->lv006=$_POST['txtlv006'];
else
$mots_lv0008->lv006=$_GET['ChildID'];
if($maxRows ==0) $maxRows = 10;
if($mots_lv0008->lv001==NULL || trim($mots_lv0008->lv001)=='') $mots_lv0008->lv001=$_GET['InvoiceID'];
$totalRowsC=$mots_lv0008->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,14,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=1500 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>ts_lv0008?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function Approvals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=3;
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,14,0);?>"
	 o.submit();
}
function UnApr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function UnApprovals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,14,0);?>"
	 o.submit();
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
function Report(vValue)
{
var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>ts_lv0008?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childfunc=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
	//var fun1="Report2('"+vValue+"')";
	//setTimeout(fun1,100);
	
}
function Report2(vValue)
{
	var o=document.frmprocess1;
	o.target="_blank";
	o.action="<?php echo $vDir;?>ts_lv0008?childfunc=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
	//var fun2="Report3('"+vValue+"')";
	//setTimeout(fun2,100);
}	
//-->
</script>
<?php
if($mots_lv0008->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,14,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mots_lv0008->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mots_lv0008->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mots_lv0008->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mots_lv0008->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mots_lv0008->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mots_lv0008->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mots_lv0008->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mots_lv0008->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mots_lv0008->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mots_lv0008->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mots_lv0008->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mots_lv0008->lv011;?>"/>
					

				  </form>
				   <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess1" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  
</div></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mots_lv0008->ArrPush[0];?>';	
</script>
</html>