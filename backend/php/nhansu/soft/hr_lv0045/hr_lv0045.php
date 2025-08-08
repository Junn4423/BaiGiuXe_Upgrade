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
$mohr_lv0045->ArrPush[15]=$vLangArr[33];
$mohr_lv0045->ArrPush[16]=$vLangArr[41];
$mohr_lv0045->ArrPush[17]=$vLangArr[42];
$mohr_lv0045->ArrPush[18]=$vLangArr[43];
$mohr_lv0045->ArrPush[19]=$vLangArr[44];
$mohr_lv0045->ArrPush[20]=$vLangArr[45];




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
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0045->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0045",$lvMessage);
}
elseif($flagID==2)
{
$mohr_lv0045->lv001=$_POST['txtlv001'];
$mohr_lv0045->lv002= $_GET['ID'] ?? '';
$mohr_lv0045->lv003=$_POST['txtlv003'];
$mohr_lv0045->lv004=$_POST['txtlv004'];
$mohr_lv0045->lv005=$_POST['txtlv005'];
$mohr_lv0045->lv006=$_POST['txtlv006'];
$mohr_lv0045->lv007=$_POST['txtlv007'];
$mohr_lv0045->lv008=$_POST['txtlv008'];
$mohr_lv0045->lv009=$_POST['txtlv009'];
$mohr_lv0045->lv010=$_POST['txtlv010'];
$mohr_lv0045->lv011=$_POST['txtlv011'];
$mohr_lv0045->lv012=$_POST['txtlv012'];
$mohr_lv0045->lv013=$_POST['txtlv013'];
$mohr_lv0045->lv014=$_POST['txtlv014'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0045->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0045->LV_UnAproval($strar);
}
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
$mohr_lv0045->lv002= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0045->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>','filter');
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
//////////////RunFunction/////////////////////////
function RunFunction(vID,func)
{
	var str="<br><iframe height=1000 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>hr_lv0045?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>"
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>"
	 o.submit();
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
///////////////////////////Report/////////////////////
function Report(vValue)
{
var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>hr_lv0045?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
//-->
</script>
<?php
if($mohr_lv0045->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0045->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0045->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $mohr_lv0045->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mohr_lv0045->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mohr_lv0045->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mohr_lv0045->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mohr_lv0045->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mohr_lv0045->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mohr_lv0045->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mohr_lv0045->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mohr_lv0045->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mohr_lv0045->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mohr_lv0045->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mohr_lv0045->lv013;?>"/>
                        <input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mohr_lv0045->lv014;?>"/>
					    
				  </form>
				<form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
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
div.innerHTML='<?php echo $mohr_lv0045->ArrPush[0];?>';	
</script>
</html>