<?php
$vDir  = '';if (isset( $_GET['ID']) &&  $_GET['ID'] != "") $vDir = '../';
include($vDir."paras.php");
require_once($vDir."../clsall/lv_controler.php");
require_once($vDir."../clsall/jo_lv0004.php");
require_once($vDir."../clsall/jo_lv0004_1.php");
require_once($vDir."../clsall/hr_lv0020.php");
/////////////init object//////////////
$mojo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$mojo_lv0004_1=new jo_lv0004_1($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004_1');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$mojo_lv0004->Dir=$vDir;
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile($vDir."../","AD0025.txt",$plang);
	$vLangArr1=GetLangFile($vDir."../","JO0005.txt",$plang);	
if(isset($_POST['txtlv009']))
$mojo_lv0004_1->lv009=$_POST['txtlv009'];
else
{
 $_POST['txtlv009']="0,1,5";
$mojo_lv0004_1->lv009=$_POST['txtlv009'];
}
if($_POST['qxtlv016']=="" || $_POST['qxtlv016']==NULL)
{
	$mojo_lv0004->lv016=$mojo_lv0004->FormatView(GetServerDate(),2);
	$mojo_lv0004->lv016_ext=$_POST['qxtlv017_ext'];
}
else 
{
	$mojo_lv0004->lv016=$_POST['qxtlv016'];
	$mojo_lv0004->lv016_ext=$_POST['qxtlv016_ext'];
}
if($_POST['qxtlv017']=="" || $_POST['qxtlv017']==NULL)
{
	$mojo_lv0004->lv017=$mojo_lv0004->FormatView(GetServerDate(),2);
	$mojo_lv0004->lv017_ext='20:00';
}
else 
{
	$mojo_lv0004->lv017=$_POST['qxtlv017'];
	$mojo_lv0004->lv017_ext=$_POST['qxtlv017_ext'];
}
if($_POST['qxtlv022']=="" || $_POST['qxtlv022']==NULL)	
	$mojo_lv0004->lv022=4;
else
	$mojo_lv0004->lv022=$_POST['qxtlv022'];

if($_POST['txtlv002']=="" || $_POST['txtlv002']==NULL)	
$mojo_lv0004->lv005="00:00:00";
else
$mojo_lv0004->lv005=$_POST['txtlv005'];
if($_POST['txtlv006']=="" || $_POST['txtlv006']==NULL)
$mojo_lv0004->lv006="00:00:00";
else
$mojo_lv0004->lv006=$_POST['txtlv006'];
$mojo_lv0004->lv007=$_POST['txtlv007'];
$mojo_lv0004->lang=strtoupper($plang);
$mojo_lv0004_1->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0004_1->ArrPush[0]=$vLangArr[17];
$mojo_lv0004_1->ArrPush[1]=$vLangArr[18];
$mojo_lv0004_1->ArrPush[2]=$vLangArr[19];
$mojo_lv0004_1->ArrPush[3]=$vLangArr[20];
$mojo_lv0004_1->ArrPush[4]=$vLangArr[21];
$mojo_lv0004_1->ArrPush[5]=$vLangArr[22];
$mojo_lv0004_1->ArrPush[6]=$vLangArr[23];
$mojo_lv0004_1->ArrPush[7]=$vLangArr[24];
$mojo_lv0004_1->ArrPush[8]=$vLangArr[25];
$mojo_lv0004_1->ArrPush[9]=$vLangArr[26];
$mojo_lv0004_1->ArrPush[10]=$vLangArr[27];
$mojo_lv0004_1->ArrPush[11]=$vLangArr[28];
$mojo_lv0004_1->ArrPush[12]=$vLangArr[29];
$mojo_lv0004_1->ArrPush[13]=$vLangArr[30];
$mojo_lv0004_1->ArrPush[14]=$vLangArr[31];
$mojo_lv0004_1->ArrPush[15]=$vLangArr[32];
$mojo_lv0004_1->ArrPush[16]=$vLangArr[33];
$mojo_lv0004_1->ArrPush[17]=$vLangArr[34];
$mojo_lv0004_1->ArrPush[18]=$vLangArr[35];
$mojo_lv0004_1->ArrPush[19]=$vLangArr[36];
$mojo_lv0004_1->ArrPush[20]=$vLangArr[37];
$mojo_lv0004_1->ArrPush[21]=$vLangArr[38];
$mojo_lv0004_1->ArrPush[22]=$vLangArr[39];
$mojo_lv0004_1->ArrPush[23]=$vLangArr[40];
$mojo_lv0004_1->ArrPush[24]=$vLangArr[41];
$mojo_lv0004_1->ArrPush[25]=$vLangArr[42];
$mojo_lv0004_1->ArrPush[26]=$vLangArr[43];
$mojo_lv0004_1->ArrPush[27]=$vLangArr[44];
$mojo_lv0004_1->ArrPush[28]=$vLangArr[45];
$mojo_lv0004_1->ArrPush[29]=$vLangArr[46];
$mojo_lv0004_1->ArrPush[30]=$vLangArr[47];
$mojo_lv0004_1->ArrPush[31]=$vLangArr[48];
$mojo_lv0004_1->ArrPush[32]=$vLangArr[49];
$mojo_lv0004_1->ArrPush[33]=$vLangArr[50];
$mojo_lv0004_1->ArrPush[34]=$vLangArr[51];
$mojo_lv0004_1->ArrPush[35]=$vLangArr[52];
$mojo_lv0004_1->ArrPush[36]=$vLangArr[53];
$mojo_lv0004_1->ArrPush[37]=$vLangArr[54];
$mojo_lv0004_1->ArrPush[38]=$vLangArr[55];
$mojo_lv0004_1->ArrPush[39]=$vLangArr[56];
$mojo_lv0004_1->ArrPush[40]=$vLangArr[57];
$mojo_lv0004_1->ArrPush[41]=$vLangArr[58];
$mojo_lv0004_1->ArrPush[42]=$vLangArr[59];
$mojo_lv0004_1->ArrPush[43]=$vLangArr[60];
$mojo_lv0004_1->ArrPush[44]=$vLangArr[61];
$mojo_lv0004_1->ArrPush[45]=$vLangArr[62];
$mojo_lv0004_1->ArrPush[46]=$vLangArr[71];
$mojo_lv0004_1->ArrPush[47]=$vLangArr[72];
$mojo_lv0004_1->ArrPush[48]=$vLangArr[73];
$mojo_lv0004_1->ArrPush[49]=$vLangArr[74];
$mojo_lv0004_1->ArrPush[50]=$vLangArr[75];
$mojo_lv0004_1->ArrPush[51]=$vLangArr[76];
$mojo_lv0004_1->ArrPush[52]=$vLangArr[78];
$mojo_lv0004_1->ArrPush[53]=$vLangArr[79];
$mojo_lv0004_1->ArrPush[61]=$vLangArr[80];
$mojo_lv0004_1->ArrPush[62]=$vLangArr[81];
$mojo_lv0004_1->ArrPush[63]=$vLangArr[82];
$mojo_lv0004_1->ArrPush[64]=$vLangArr[83];
$mojo_lv0004_1->ArrPush[65]=$vLangArr[84];
$mojo_lv0004_1->ArrPush[66]=$vLangArr[85];
$mojo_lv0004_1->ArrPush[67]=$vLangArr[86];
$mojo_lv0004_1->ArrPush[68]=$vLangArr[87];
$mojo_lv0004_1->ArrPush[69]=$vLangArr[88];
$mojo_lv0004_1->ArrPush[70]=$vLangArr[100];
$mojo_lv0004_1->ArrPush[71]=$vLangArr[90];
$mojo_lv0004_1->ArrPush[72]=$vLangArr[91];
$mojo_lv0004_1->ArrPush[73]=$vLangArr[92];
$mojo_lv0004_1->ArrPush[100]=$vLangArr[93];
$mojo_lv0004_1->ArrPush[102]=$vLangArr[101];
$mojo_lv0004_1->ArrPush[103]=$vLangArr[94];
$mojo_lv0004_1->ArrPush[104]=$vLangArr[95];
$mojo_lv0004_1->ArrPush[105]=$vLangArr[102];
$mojo_lv0004_1->ArrPush[106]=$vLangArr[103];
$mojo_lv0004_1->ArrPush[107]=$vLangArr[98];
$mojo_lv0004_1->ArrPush[151]=$vLangArr[96];
$mojo_lv0004_1->ArrPush[200]=$vLangArr[97];
$mojo_lv0004_1->ArrFunc[0]='//Function';
$mojo_lv0004_1->ArrFunc[1]=$vLangArr[2];
$mojo_lv0004_1->ArrFunc[2]=$vLangArr[4];
$mojo_lv0004_1->ArrFunc[3]=$vLangArr[6];
$mojo_lv0004_1->ArrFunc[4]=$vLangArr[7];
$mojo_lv0004_1->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mojo_lv0004_1->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mojo_lv0004_1->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mojo_lv0004_1->ArrFunc[8]=$vLangArr[10];
$mojo_lv0004_1->ArrFunc[9]=$vLangArr[12];
$mojo_lv0004_1->ArrFunc[10]=$vLangArr[0];
$mojo_lv0004_1->ArrFunc[11]=$vLangArr[65];
$mojo_lv0004_1->ArrFunc[12]=$vLangArr[66];
$mojo_lv0004_1->ArrFunc[13]=$vLangArr[67];
$mojo_lv0004_1->ArrFunc[14]=$vLangArr[68];
$mojo_lv0004_1->ArrFunc[15]=$vLangArr[69];

////Other
$mojo_lv0004_1->ArrOther[1]=$vLangArr[63];
$mojo_lv0004_1->ArrOther[2]=$vLangArr[64];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mojo_lv0004->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"jo_lv0004",$lvMessage);
}
elseif($flagID==2)
{
$mojo_lv0004_1->lv001=$_POST['txtlv001'];
$mojo_lv0004_1->lv002=$_POST['txtlv002'];
$mojo_lv0004_1->lv003=$_POST['txtlv003'];
$mojo_lv0004_1->lv004=$_POST['txtlv004'];
$mojo_lv0004_1->lv005=$_POST['txtlv005'];
$mojo_lv0004_1->lv006=$_POST['txtlv006'];
$mojo_lv0004_1->lv007=$_POST['txtlv007'];
$mojo_lv0004_1->lv008=$_POST['txtlv008'];
if(isset($_POST['txtlv009']))
$mojo_lv0004_1->lv009=$_POST['txtlv009'];
else
{
 $_POST['txtlv009']="0,1,5";
$mojo_lv0004_1->lv009=$_POST['txtlv009'];
}
$mojo_lv0004_1->lv010=$_POST['txtlv010'];
$mojo_lv0004_1->lv011=$_POST['txtlv011'];
$mojo_lv0004_1->lv012=$_POST['txtlv012'];
$mojo_lv0004_1->lv013=$_POST['txtlv013'];
$mojo_lv0004_1->lv014=$_POST['txtlv014'];
$mojo_lv0004_1->lv015=$_POST['txtlv015'];
$mojo_lv0004_1->lv016=$_POST['txtlv016'];
$mojo_lv0004_1->lv017=$_POST['txtlv017'];
$mojo_lv0004_1->lv018=$_POST['txtlv018'];
$mojo_lv0004_1->lv019=$_POST['txtlv019'];
$mojo_lv0004_1->lv020=$_POST['txtlv020'];
$mojo_lv0004_1->lv021=$_POST['txtlv021'];
$mojo_lv0004_1->lv022=$_POST['txtlv022'];
$mojo_lv0004_1->lv023=$_POST['txtlv023'];
$mojo_lv0004_1->lv024=$_POST['txtlv024'];
$mojo_lv0004_1->lv025=$_POST['txtlv025'];
$mojo_lv0004_1->lv026=$_POST['txtlv026'];
$mojo_lv0004_1->lv027=$_POST['txtlv027'];
$mojo_lv0004_1->lv028=$_POST['txtlv028'];
$mojo_lv0004_1->lv029=$_POST['txtlv029'];
$mojo_lv0004_1->lv030=$_POST['txtlv030'];
$mojo_lv0004_1->lv031=$_POST['txtlv031'];
$mojo_lv0004_1->lv032=$_POST['txtlv032'];
$mojo_lv0004_1->lv033=$_POST['txtlv033'];
$mojo_lv0004_1->lv034=$_POST['txtlv034'];
$mojo_lv0004_1->lv035=$_POST['txtlv035'];
$mojo_lv0004_1->lv036=$_POST['txtlv036'];
$mojo_lv0004_1->lv037=$_POST['txtlv037'];
$mojo_lv0004_1->lv038=$_POST['txtlv038'];
$mojo_lv0004_1->lv039=$_POST['txtlv039'];
$mojo_lv0004_1->lv040=$_POST['txtlv040'];
$mojo_lv0004_1->lv041=$_POST['txtlv041'];
$mojo_lv0004_1->lv042=$_POST['txtlv042'];
$mojo_lv0004_1->lv043=$_POST['txtlv043'];
$mojo_lv0004_1->lv044=$_POST['txtlv044'];
$mojo_lv0004_1->lv045=$_POST['txtlv045'];

$mojo_lv0004_1->lv060=$_POST['txtlv060'];
$mojo_lv0004_1->lv061=$_POST['txtlv061'];
$mojo_lv0004_1->lv062=$_POST['txtlv062'];
$mojo_lv0004_1->lv063=$_POST['txtlv063'];
$mojo_lv0004_1->lv064=$_POST['txtlv064'];
$mojo_lv0004_1->lv065=$_POST['txtlv065'];
$mojo_lv0004_1->lv066=$_POST['txtlv066'];
$mojo_lv0004_1->lv067=$_POST['txtlv067'];

$mojo_lv0004_1->lv099=$_POST['txtlv099'];
$mojo_lv0004_1->FullName=$_POST['txtFullName'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mojo_lv0004->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mojo_lv0004->LV_UnAproval($strar);
}
elseif($flagID==5)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=explode("@",$strar);
	foreach($strar as $var)
	{
		if($var!="")
		{
			$mojo_lv0004->lv015=$var;
			$mojo_lv0004->lv022=$_POST['qxtlv022'];
			$mojo_lv0004->lv016=$_POST['qxtlv016'].' '.$_POST['qxtlv016_ext'];
			$mojo_lv0004->lv017=$_POST['qxtlv017'].' '.$_POST['qxtlv017_ext'];
			$mojo_lv0004->lv003=$_POST['qxtlv003'];
			$mojo_lv0004->lv002=$_POST['qxtlv002'];
			if($_POST['qxtlv016']!="" && $_POST['qxtlv017']!="")
			{
				$mohr_lv0020->LV_LoadID($mojo_lv0004->lv015);
				if($mohr_lv0020->lv001!=NULL)
				{
					$vresult=$mojo_lv0004->LV_Insert();
				}
			}
		}
	}
	$mojo_lv0004->lv016=$_POST['qxtlv016'];
	$mojo_lv0004->lv017=$_POST['qxtlv017'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0004->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0004_1');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mojo_lv0004->ListView;
$curPage = $mojo_lv0004->CurPage;
$maxRows =$mojo_lv0004->MaxRows;
$vOrderList=$mojo_lv0004->ListOrder;
$vSortNum=$mojo_lv0004->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mojo_lv0004->SaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0004_1',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);
}
if($mojo_lv0004_1->GetApr()==0 || $mojo_lv0004_1->GetUnApr()==0)  $mojo_lv0004_1->lv029=$mojo_lv0004_1->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$mojo_lv0004->lv002= $_GET['ID'] ?? '';
$mojo_lv0004->lsempid=$_POST['LSEMPID'];
if($maxRows ==0) $maxRows = 10;
$totalRowsC=$mojo_lv0004_1->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>DỰ TUYỂN</title>
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv015=<?php echo $_POST['txtlv016'];?>&lv017=<?php echo $_POST['txtlv017'];?>&lv018=<?php echo $_POST['txtlv018'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv020=<?php echo $_POST['txtlv020'];?>&lv021=<?php echo $_POST['txtlv021'];?>&lv022=<?php echo $_POST['txtlv022'];?>&lv023=<?php echo $_POST['txtlv023'];?>&lv024=<?php echo $_POST['txtlv024'];?>&lv025=<?php echo $_POST['txtlv025'];?>&lv026=<?php echo $_POST['txtlv026'];?>&lv027=<?php echo $_POST['txtlv027'];?>&lv028=<?php echo $_POST['txtlv028'];?>&lv029=<?php echo $_POST['txtlv029'];?>&lv030=<?php echo $_POST['txtlv030'];?>&lv031=<?php echo $_POST['txtlv031'];?>&lv033=<?php echo $_POST['txtlv033'];?>&lv034=<?php echo $_POST['txtlv034'];?>&lv035=<?php echo $_POST['txtlv035'];?>&lv036=<?php echo $_POST['txtlv036'];?>&lv037=<?php echo $_POST['txtlv037'];?>&lv038=<?php echo $_POST['txtlv038'];?>&lv039=<?php echo $_POST['txtlv039'];?>&lv040=<?php echo $_POST['txtlv040'];?>&lv041=<?php echo $_POST['txtlv041'];?>&lv042=<?php echo $_POST['txtlv042'];?>&lv060=<?php echo $_POST['txtlv060'];?>&lv061=<?php echo $_POST['txtlv061'];?>&lv062=<?php echo $_POST['txtlv062'];?>&lv063=<?php echo $_POST['txtlv063'];?>&lv064=<?php echo $_POST['txtlv064'];?>&lv065=<?php echo $_POST['txtlv065'];?>&lv066=<?php echo $_POST['txtlv066'];?>&lv067=<?php echo $_POST['txtlv067'];?>&lv105=<?php echo $_POST['txtlv105'];?>&lv106=<?php echo $_POST['txtlv106'];?>','filter');
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
function Apr_Recuiment()
{
	lv_chk_list(document.frmchoose,'lvChk',7);
}
function FunctRunning2(vValue)
{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=5;
    o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	o.submit();

}
function FunctRunning1(vID)
{
RunFunction(vID,'child');
}
function RunFunction(vID,func)
{
	var oparent=window.parent.document.getElementById('showparent');
	if(oparent!=null) 
		var oheight=parseInt(oparent.style.height);
	else
		var oheight=0;
	oheight=oheight-10;
	if(isNaN(oheight)) oheight=1000;
	if(oheight<0) oheight=1000;
	switch(func)
	{
		case 'child':
			var str="<br><iframe id='lvframefrm' height=1400 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>jo_lv0004_1?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&childfunc="+func+"&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
			break;
		default:
			var str="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>jo_lv0004_1?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&childfunc="+func+"&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
			break;
	}
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
function Report(vValue)
{
var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>jo_lv0004?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&childfunc=rpt&ChildID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>&childfunc=<?php echo $_GET['childfunc']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>&childfunc=<?php echo $_GET['childfunc']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function ChangeInfor()
{
var o1=document.frmchoose;
 	o1.submit();
}
function CheckEnter(e)
{
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="13")
	{
		ChangeInfor();
	}
}
function SetDefaultGio(value)
{
	switch(parseInt(value))
	{
		case 6:
			document.getElementById('qxtlv016_ext').value='22:00';
			document.getElementById('qxtlv017_ext').value='';
			break;
		case 5:
			document.getElementById('qxtlv016_ext').value='12:00';
			document.getElementById('qxtlv017_ext').value='13:00';
			break;
		case 4:
			document.getElementById('qxtlv016_ext').value='17:00';
			document.getElementById('qxtlv017_ext').value='20:00';
			break;
		case 0:
			document.getElementById('qxtlv016_ext').value='08:00';
			document.getElementById('qxtlv017_ext').value='12:00';
			break;
		default:
			document.getElementById('qxtlv016_ext').value='00:00';
			document.getElementById('qxtlv017_ext').value='00:00';
			break;
	}		
	
}
function notSpecialChar(evt)
	{
		var e = evt; // for trans-browser compatibility
		var charCode = e.which || e.keyCode;
		if(charCode>=48 && charCode<=57) return true;
		if(charCode==8 || charCode==9 || charCode==13 || charCode==58 || charCode==47) return true;
		return false;

	}
//-->
</script>
<?php
if($mojo_lv0004->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<link rel="stylesheet" href="../css/popup.css" type="text/css">
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<table style="background:#f2f2f2;font:10px arial">
						<tr>
							<td width="70"><?php echo $vLangArr1[50];?></td>
							<td  height="20px"><select  name="qxtlv022"  id="qxtlv022"  tabindex="7" maxlength="255" style="width:90px" onKeyPress="return CheckKey(event,7)" onchange="SetDefaultGio(this.value)"/>
								<?php echo $mojo_lv0004->LV_LinkField('lv022',$mojo_lv0004->lv022);?>
							  </select>	</td>
							  <td  height="20px"><select  name="qxtlv003"  id="qxtlv003"  tabindex="7" maxlength="255" style="width:80px" onKeyPress="return CheckKey(event,7)"/>
								<?php echo $mojo_lv0004->LV_LinkField('lv003',$mojo_lv0004->lv003);?>
							  </select>	</td>
							  <td  height="20px"><select  name="qxtlv002"  id="qxtlv002"  tabindex="7" maxlength="255" style="width:80px" onKeyPress="return CheckKey(event,7)"/>
								<?php echo $mojo_lv0004->LV_LinkField('lv002',$mojo_lv0004->lv002);?>
							  </select>	</td>
							  <td  height="20px"><?php echo $vLangArr1[34];?></td>
							  <td  height="20px"><input onkeydown="return notSpecialChar(event);"  style="width:80px;text-align:center;" name="qxtlv016" type="text" id="qxtlv016" value="<?php echo $mojo_lv0004->lv016;?>" tabindex="8" maxlength="50" style="width:100%" ondblclick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.qxtlv016);return false;"></td>
							  <td  height="20px"><input onkeypress="return notSpecialChar(event);" style="width:50px;text-align:center;"  name="qxtlv016_ext" type="text" id="qxtlv016_ext" value="<?php echo $mojo_lv0004->lv016_ext;?>" title='hh:mm' tabindex="8" maxlength="225" style="width:100%" /></td>
							  <td  height="20px"><?php echo $vLangArr1[35];?></td>
							  <td  height="20px"><input onkeypress="return notSpecialChar(event);" style="width:80px;text-align:center;" name="qxtlv017" type="text" id="qxtlv017" value="<?php echo $mojo_lv0004->lv017;?>" tabindex="8" maxlength="50" style="width:100%"  ondblclick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.qxtlv017);return false;" onfocus="this.value=document.getElementById('qxtlv016').value;"></td>
							  <td  height="20px"><input onkeypress="return notSpecialChar(event);" style="width:50px;text-align:center;" name="qxtlv017_ext" type="text" id="qxtlv017_ext" value="<?php echo $mojo_lv0004->lv017_ext;?>" title='hh:mm' tabindex="9" maxlength="50" style="width:100%"></td>
							  <td  height="20px"><?php echo $vLangArr1[26];?></td>
							  <td  height="20px">
							  	<input type="textbox" name="qxtlv008" rows="6" id="qxtlv008"  tabindex="10" maxlength="50" style="width:80%" value="<?php echo $mojo_lv0004->lv008;?>"/>
						      </td>
							   <td  height="20px"><input type="button" value="<?php echo $vLangArr1[50];?>" onclick="Apr_Recuiment()"/></td>
							  </tr>	
							 </table>
							 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#fafafa;font:10px arial;padding-top:5px;">
								<tr>
									<td width="130"><?php echo $vLangArr1[49];?></td>
									<td width="250"><?php echo $vLangArr[19];?> <input type="text" name="txtlv001" id="txtlv001" tabindex="1" value="<?php echo $mojo_lv0004_1->lv001;?>" onchange="ChangeInfor()"/></td>
									<td><?php echo $vLangArr[20];?></td><td>
										<ul lang="pop-nav1" onmouseover="ChangeName(this,1)" id="pop-nav"> <li class="menupopT"> <input onKeyPress="return CheckEnter(event)"  name="txtFullName" id="txtFullName" autocomplete="off"  tabindex="9" maxlength="255" style="width:250px" value="<?php echo $mojo_lv0004_1->FullName;?>" onKeyUp="LoadSelfNextParent(this,'txtFullName','hr_lv0020','lv002','lv002')" onFocus="LoadSelfNextParent(this,'txtFullName','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)','concat(@! @!,lv004,@! @!,lv003,@! @!,lv002)')"/><div id="lv_popup" lang="lv_popup1"> </div></li></ul>
									</td>
									<td width="350"><?php echo $vLangArr[28];?> <input type="text"  tabindex="1" name="txtlv010" id="txtlv010" value="<?php echo $mojo_lv0004_1->lv010;?>" onChange="ChangeInfor()"/></td></tr></table>
						<?php echo $mojo_lv0004_1->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mojo_lv0004_1->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mojo_lv0004_1->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mojo_lv0004_1->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mojo_lv0004_1->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mojo_lv0004_1->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mojo_lv0004_1->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mojo_lv0004_1->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mojo_lv0004_1->lv009;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mojo_lv0004_1->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mojo_lv0004_1->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mojo_lv0004_1->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mojo_lv0004_1->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mojo_lv0004_1->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mojo_lv0004_1->lv016;?>"/>
						<input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mojo_lv0004_1->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $mojo_lv0004_1->lv018;?>"/>
						<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $mojo_lv0004_1->lv019;?>"/>
						<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $mojo_lv0004_1->lv020;?>"/>
						<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $mojo_lv0004_1->lv021;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $mojo_lv0004_1->lv022;?>"/>
						<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $mojo_lv0004_1->lv023;?>"/>
						<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $mojo_lv0004_1->lv024;?>"/>
						<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $mojo_lv0004_1->lv025;?>"/>
						<input type="hidden" name="txtlv026" id="txtlv026" value="<?php echo $mojo_lv0004_1->lv026;?>"/>
						<input type="hidden" name="txtlv027" id="txtlv027" value="<?php echo $mojo_lv0004_1->lv027;?>"/>
						<input type="hidden" name="txtlv028" id="txtlv028" value="<?php echo $qxtlv008->lv028;?>"/>
						<input type="hidden" name="txtlv029" id="txtlv029" value="<?php echo $mojo_lv0004_1->lv029;?>"/>
						<input type="hidden" name="txtlv030" id="txtlv030" value="<?php echo $mojo_lv0004_1->lv030;?>"/>
						<input type="hidden" name="txtlv031" id="txtlv031" value="<?php echo $mojo_lv0004_1->lv031;?>"/>
						<input type="hidden" name="txtlv032" id="txtlv032" value="<?php echo $mojo_lv0004_1->lv032;?>"/>
						<input type="hidden" name="txtlv033" id="txtlv033" value="<?php echo $mojo_lv0004_1->lv033;?>"/>
						<input type="hidden" name="txtlv034" id="txtlv034" value="<?php echo $mojo_lv0004_1->lv034;?>"/>
						<input type="hidden" name="txtlv035" id="txtlv035" value="<?php echo $mojo_lv0004_1->lv035;?>"/>
						<input type="hidden" name="txtlv036" id="txtlv036" value="<?php echo $mojo_lv0004_1->lv036;?>"/>
						<input type="hidden" name="txtlv037" id="txtlv037" value="<?php echo $mojo_lv0004_1->lv037;?>"/>
						<input type="hidden" name="txtlv038" id="txtlv038" value="<?php echo $mojo_lv0004_1->lv038;?>"/>
						<input type="hidden" name="txtlv039" id="txtlv039" value="<?php echo $mojo_lv0004_1->lv039;?>"/>
						<input type="hidden" name="txtlv040" id="txtlv040" value="<?php echo $mojo_lv0004_1->lv040;?>"/>
						<input type="hidden" name="txtlv041" id="txtlv041" value="<?php echo $mojo_lv0004_1->lv041;?>"/>
						<input type="hidden" name="txtlv042" id="txtlv042" value="<?php echo $mojo_lv0004_1->lv042;?>"/>
						<input type="hidden" name="txtlv043" id="txtlv043" value="<?php echo $mojo_lv0004_1->lv043;?>"/>
						<input type="hidden" name="txtlv044" id="txtlv044" value="<?php echo $mojo_lv0004_1->lv044;?>"/>
						<input type="hidden" name="txtlv045" id="txtlv045" value="<?php echo $mojo_lv0004_1->lv045;?>"/>
						<input type="hidden" name="txtlv060" id="txtlv060" value="<?php echo $mojo_lv0004_1->lv060;?>"/>
						<input type="hidden" name="txtlv061" id="txtlv061" value="<?php echo $mojo_lv0004_1->lv061;?>"/>
						<input type="hidden" name="txtlv062" id="txtlv062" value="<?php echo $mojo_lv0004_1->lv062;?>"/>
						<input type="hidden" name="txtlv063" id="txtlv063" value="<?php echo $mojo_lv0004_1->lv063;?>"/>
						<input type="hidden" name="txtlv064" id="txtlv064" value="<?php echo $mojo_lv0004_1->lv064;?>"/>
						<input type="hidden" name="txtlv065" id="txtlv065" value="<?php echo $mojo_lv0004_1->lv065;?>"/>
						<input type="hidden" name="txtlv066" id="txtlv066" value="<?php echo $mojo_lv0004_1->lv066;?>"/>
						<input type="hidden" name="txtlv067" id="txtlv067" value="<?php echo $mojo_lv0004_1->lv067;?>"/>
						<input type="hidden" name="txtlv105" id="txtlv105" value="<?php echo $mojo_lv0004_1->lv105;?>"/>
						<input type="hidden" name="txtlv106" id="txtlv106" value="<?php echo $mojo_lv0004_1->lv106;?>"/>
						<input type="hidden" name="txtlv099" id="txtlv099" value="<?php echo $mojo_lv0004_1->lv099;?>"/>

					    
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  
</div></div>
<script language="javascript" src="../javascripts/menupopup.js"></script>		
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">

div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mojo_lv0004_1->ArrPush[0];?>';	
<?php if($_GET['CandID']!="" && $_GET['CandID']!=NULL )
{
?>
setTimeout('FunctRunning1("<?php echo $_GET['CandID'];?>")',1000);
<?php 
}
?>
</script>
</html>