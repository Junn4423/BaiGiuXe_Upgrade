<?php
$vDir  = '';if (isset( $_GET['ID']) &&  $_GET['ID'] != "") $vDir = '../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/cr_lv0086.php");
require_once("$vDir../clsall/cr_lv0004.php");
require_once("$vDir../clsall/hr_lv0020.php");
require_once("$vDir../clsall/jo_lv0016.php");
require_once("$vDir../clsall/cr_lv0253.php");
require_once("$vDir../clsall/cr_lv0116.php");
require_once("$vDir../clsall/wh_lv0020.php");
/////////////init object//////////////
$mocr_lv0086=new cr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0086');
$mocr_lv0004=new cr_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0004');
$vocr_lv0004=new cr_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0004');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$mojo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$mocr_lv0253=new cr_lv0253($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0253');
$mocr_lv0116=new cr_lv0116($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0116');
$mowh_lv0020=new wh_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0020');
$mocr_lv0086->Dir=$vDir;
$mojo_lv0016->LV_Load();
$mocr_lv0086->mojo_lv0016=$mojo_lv0016;
$mocr_lv0253->mocr_lv0116=$mocr_lv0116;
$mocr_lv0253->objlot=$mowh_lv0020;
$mocr_lv0086->mocr_lv0253=$mocr_lv0253;
$vkeep=$_POST['qxtlvkeep'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
if($flagID==55)
{
	if($mocr_lv0366->GetEdit()==1)
	{
		$vdonhangid=$_POST['txtID1'];
		$voption=$_POST['txtField1'];
		$vText=$_POST['txtValues1'];
		$vlvField='lv'.Fillnum($voption,3);
		$vText=str_replace("|||",'\n',$vText);						
		$vsql="update cr_lv0005 set $vlvField='$vText' where lv001='$vdonhangid' and lv011=1 and lv027=1";
		$vresult=$mocr_lv0086->LV_UpdateChangeChild($vsql);
	}
?>
<script language="JavaScript" type="text/javascript">
window.close();
</script>
<?php
}
if($mocr_lv0086->GetApr()==1)
{
	if(isset($_GET['ajaxbangtext']))
	{
		$vdonhangid=$_GET['donhangid'];
		$vText=$_GET['textup'];
		$vText=str_replace('$$$','+',$vText);
		$vText=str_replace("|||",'\n',$vText);	
		$voption=$_GET['optrun'];
		if($vdonhangid!='' && $vdonhangid!=NULL)
		{
			$vUserID=$mocr_lv0086->LV_UserID;
			$vlvField='lv'.Fillnum($voption,3);
			switch($voption)
			{
				case 12:
					if($plang=='') $plang='VN';
					$vDate=recoverdate(substr($vText,0,10),$plang);
					$vTime=substr($vText,11,8);
					$vsql="update cr_lv0005 set $vlvField=concat('$vDate',' ','$vTime') where lv001='$vdonhangid' and lv011=1 and lv027=1";
					$mocr_lv0086->LV_UpdateChangeChild($vsql);
					break;
				case 15:
				case 16:
					$vsql="update cr_lv0005 set $vlvField='$vText' where lv001='$vdonhangid' and lv011=1 and lv027=1";
					$mocr_lv0086->LV_UpdateChangeChild($vsql);
					break;
				case 26:			
					$vsql="update cr_lv0005 set $vlvField='$vText' where lv001='$vdonhangid' and lv011=1 and lv027=1";
					$mocr_lv0086->LV_UpdateChangeChild($vsql);
					break;
			}

		}
		exit;
	}
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","CR0007.txt",$plang);
$mocr_lv0086->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0086->ArrPush[0]=$vLangArr[17];
$mocr_lv0086->ArrPush[1]=$vLangArr[18];
$mocr_lv0086->ArrPush[2]=$vLangArr[19];
$mocr_lv0086->ArrPush[3]=$vLangArr[20];
$mocr_lv0086->ArrPush[4]=$vLangArr[21];
$mocr_lv0086->ArrPush[5]=$vLangArr[22];
$mocr_lv0086->ArrPush[6]=$vLangArr[23];
$mocr_lv0086->ArrPush[7]=$vLangArr[24];
$mocr_lv0086->ArrPush[8]=$vLangArr[25];
$mocr_lv0086->ArrPush[9]=$vLangArr[26];
$mocr_lv0086->ArrPush[10]=$vLangArr[27];
$mocr_lv0086->ArrPush[11]=$vLangArr[28];
$mocr_lv0086->ArrPush[12]=$vLangArr[29];
$mocr_lv0086->ArrPush[13]=$vLangArr[30];
$mocr_lv0086->ArrPush[14]=$vLangArr[31];
$mocr_lv0086->ArrPush[15]=$vLangArr[32];
$mocr_lv0086->ArrPush[16]=$vLangArr[33];
$mocr_lv0086->ArrPush[17]=$vLangArr[34];
$mocr_lv0086->ArrPush[18]=$vLangArr[35];

$mocr_lv0086->ArrPush[23]='NV đề xuất';
$mocr_lv0086->ArrPush[24]='Ngày đề xuất';
$mocr_lv0086->ArrPush[25]='QLý duyệt';
$mocr_lv0086->ArrPush[26]='Ngày QL duyệt';

$mocr_lv0086->ArrPush[27]='Ghi nhận quản lý';
$mocr_lv0086->ArrPush[28]='Trạng thái duyệt';
$mocr_lv0086->ArrPush[50]='Loại CV';
$mocr_lv0086->ArrPush[90]='Mã công văn';
$mocr_lv0086->ArrPush[100]=$vLangArr[48];

$mocr_lv0086->ArrPush[97]=$vLangArr[49];
$mocr_lv0086->ArrPush[98]=$vLangArr[50];
$mocr_lv0086->ArrPush[99]=$vLangArr[51];

$mocr_lv0086->ArrPush[19]=$vLangArr[43];
$mocr_lv0086->ArrPush[20]=$vLangArr[44];
$mocr_lv0086->ArrPush[21]=$vLangArr[45];
$mocr_lv0086->ArrPush[22]=$vLangArr[46];
$mocr_lv0086->ArrPush[23]=$vLangArr[47];
$mocr_lv0086->ArrPush[200]='Chức năng';

$mocr_lv0086->ArrFunc[0]='//Function';
$mocr_lv0086->ArrFunc[1]=$vLangArr[2];
$mocr_lv0086->ArrFunc[2]=$vLangArr[4];
$mocr_lv0086->ArrFunc[3]=$vLangArr[6];
$mocr_lv0086->ArrFunc[4]=$vLangArr[7];
$mocr_lv0086->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mocr_lv0086->ArrFunc[6]=GetLangExcept('duyet',$plang);
$mocr_lv0086->ArrFunc[7]=GetLangExcept('tralai',$plang);
$mocr_lv0086->ArrFunc[8]=$vLangArr[10];
$mocr_lv0086->ArrFunc[9]=$vLangArr[12];
$mocr_lv0086->ArrFunc[10]=$vLangArr[0];
$mocr_lv0086->ArrFunc[11]=$vLangArr[38];
$mocr_lv0086->ArrFunc[12]=$vLangArr[39];
$mocr_lv0086->ArrFunc[13]=$vLangArr[40];
$mocr_lv0086->ArrFunc[14]=$vLangArr[41];
$mocr_lv0086->ArrFunc[15]=$vLangArr[42];

////Other
$mocr_lv0086->ArrOther[1]=$vLangArr[36];
$mocr_lv0086->ArrOther[2]=$vLangArr[37];

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
	$vresult=$mocr_lv0086->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"cr_lv0086",$lvMessage);
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mocr_lv0086->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mocr_lv0086->LV_UnAproval($strar);
}
elseif($flagID==6)
{
	/*$mocr_lv0004->LV_LoadActiveID($_POST['qxtlv002']);
	if($mocr_lv0004->lv001=='' || $mocr_lv0004->lv001==NULL) 
	$vMessage='Không có kế hoạch nào khởi tạo hôm nay!';
	else*/
	{
		$_POST['qxtlv006']=trim($_POST['qxtlv006']);
		$mohr_lv0020->LV_LoadID($_POST['qxtlv006']);
		if($mohr_lv0020->lv001!=null)
		{
			$mocr_lv0004->lv002=$_POST['qxtlv004'];
			$mocr_lv0004->lv097=$_POST['qxtlv008'];
			if( $_GET['ID']!='')
				$mocr_lv0086->lv002= $_GET['ID'];
			else
				$mocr_lv0086->lv002=$mocr_lv0004->LV_AutoBuilUser($mocr_lv0004->LV_UserID);
			$mocr_lv0086->lv003=$_POST['qxtlv003'];
			$mocr_lv0086->lv004=$_POST['qxtlv004'];
			$mocr_lv0086->lv010=$_POST['qxtlv010'];
			$mocr_lv0086->lv006=$_POST['qxtlv006'];	
			$mocr_lv0086->lv007=$_POST['qxtlv007'];
			$mocr_lv0086->lv005=$_POST['qxtlv005'].' '.$_POST['qxtlv005_'];	
			$mocr_lv0086->lv008=$_POST['qxtlv008'];
			$mocr_lv0086->lv009=$mocr_lv0086->LV_UserID;
			$mocr_lv0086->lv012=$_POST['qxtlv012'];
			$mocr_lv0086->lv111=$_POST['qxtlv111'];
			$mocr_lv0086->lv013=$_POST['qxtlv013'];
			$mocr_lv0086->lv014=$_POST['qxtlv014'];
			$vresult=$mocr_lv0086->LV_Insert();		
		}
	}
	$mocr_lv0086->lv002='';
	$mocr_lv0086->lv002='';
	$mocr_lv0086->lv003='';
	$mocr_lv0086->lv004='';
	$mocr_lv0086->lv005='';
	$mocr_lv0086->lv006='';
	$mocr_lv0086->lv007='';
	$mocr_lv0086->lv008='';
	$mocr_lv0086->lv009='';
	$mocr_lv0086->lv010='';
	$mocr_lv0086->lv011='';
	$mocr_lv0086->lv012='';
	$mocr_lv0086->lv013='';
	$mocr_lv0086->lv014='';
}

if($vkeep==1)
{
	$mocr_lv0086->tv001=$vkeep;
	$mocr_lv0086->tv002=$_POST['qxtlv002'];
	$mocr_lv0086->tv003=$_POST['qxtlv003'];
	$mocr_lv0086->tv004=$_POST['qxtlv004'];
	$mocr_lv0086->tv005=$_POST['qxtlv005'];
	$mocr_lv0086->tv006=$_POST['qxtlv006'];
	$mocr_lv0086->tv007=$_POST['qxtlv007'];
	$mocr_lv0086->tv008=$_POST['qxtlv008'];
	$mocr_lv0086->tv009=$_POST['qxtlv009'];
	$mocr_lv0086->tv012=$_POST['qxtlv012'];
	$mocr_lv0086->tv013=$_POST['qxtlv013'];
	$mocr_lv0086->tv014=$_POST['qxtlv014'];
}
if($flagID>0)
{
	$mocr_lv0086->lv001=$_POST['txtlv001'];
	$mocr_lv0086->lv002=$_POST['txtlv002'];
	$mocr_lv0086->lv003=$_POST['txtlv003'];
	$mocr_lv0086->lv004=$_POST['txtlv004'];
	$mocr_lv0086->lv005=$_POST['txtlv005'];
	$mocr_lv0086->lv006=$_POST['txtlv006'];
	$mocr_lv0086->lv007=$_POST['txtlv007'];
	$mocr_lv0086->lv008=$_POST['txtlv008'];
	$mocr_lv0086->lv009=$_POST['txtlv009'];
	$mocr_lv0086->lv010=$_POST['txtlv010'];
	$mocr_lv0086->lv011=$_POST['txtlv011'];
	$mocr_lv0086->lv012=$_POST['txtlv012'];
	$mocr_lv0086->lv012_=$_POST['txtlv012'];
	$mocr_lv0086->lv013=$_POST['txtlv013'];
	$mocr_lv0086->lv014=$_POST['txtlv014'];
	$mocr_lv0086->lv015=$_POST['txtlv015'];
	$mocr_lv0086->lv016=$_POST['txtlv016'];

	$mocr_lv0086->lv888=$_POST['txtlv888'];
	$mocr_lv0086->lv817=$_POST['txtlv817'];
	$mocr_lv0086->lv803=$_POST['txtlv803'];

	$mocr_lv0086->lv820=$_POST['txtlv820'];
	$mocr_lv0086->lv824=$_POST['txtlv824'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$mocr_lv0086->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0086');
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$vFieldList=$mocr_lv0086->ListView;
	$curPage = $mocr_lv0086->CurPage;
	$maxRows =$mocr_lv0086->MaxRows;
	$vOrderList=$mocr_lv0086->ListOrder;
	$vSortNum=$mocr_lv0086->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
	$maxRows =(int)$_POST['lvmaxrow'];
	$vSortNum=(int)$_POST['lvsort'];
	$mocr_lv0086->SaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0086',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);
}
//if($mocr_lv0086->GetApr()==0 || $mocr_lv0086->GetUnApr()==0) $mocr_lv0086->lv904=$mocr_lv0086->LV_UserID;
if($mocr_lv0086->tv003=="" || $mocr_lv0086->tv003==NULL) $mocr_lv0086->tv003="QUOT";
if($mocr_lv0086->tv006=="" || $mocr_lv0086->tv006==NULL) $mocr_lv0086->tv013="CUS";
if($mocr_lv0086->tv008=="" || $mocr_lv0086->tv008==NULL) $mocr_lv0086->tv008=$mocr_lv0086->LV_UserID;
if($mocr_lv0086->tv005=="" || $mocr_lv0086->tv005==NULL) $mocr_lv0086->tv005=$mocr_lv0086->FormatView($mocr_lv0086->DateCurrent,2);
$vocr_lv0004->LV_LoadID( $_GET['ID']);
if($vocr_lv0004->lv007=='QT')
{
	$vStaffID='';
	$vMaUngID= $_GET['ID'];
	$vArrPC=$vocr_lv0004->LV_GetAmountPC_ExtMore($vMaUngID,'QUYETTOAN',$vTongChi);
	if($vArrPC!=null)
	{
		foreach($vArrPC as $key => $vArrStaff)
		{
			foreach($vArrStaff as $vStaffID => $value)
			{
				;
				//($vMaUngID,$key,$value,$vStaffID);
			}
		}
	}
	if($mocr_lv0086->tv008=='') $mocr_lv0086->tv008=$vStaffID;
}	
if($_SESSION['ERPSOFV2RRight']!='admin')
{
	$mocr_lv0086->lv008=$mocr_lv0086->LV_UserID;
}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mocr_lv0086->GetCount();
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
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engines.js"></script>
<style>
ul#pop-nav ul
{
	top:23px;
}
input,select
{
	height:23px!important;
}
#txtfocusup
{
	height:1px!important;
}
</style>
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv070=<?php echo $_POST['txtlv070'];?>&lv071=<?php echo $_POST['txtlv071'];?>&lv072=<?php echo $_POST['txtlv072'];?>&lv076=<?php echo $_POST['txtlv076'];?>','filter');
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
	var oparent=window.parent.document.getElementById('showparent');
	if(oparent!=null) 
		var oheight=parseInt(oparent.style.height);
	else
		var oheight=0;
	oheight=oheight-10;
	if(isNaN(oheight)) oheight=1000;
	if(oheight<0) oheight=1000;
	if(oheight<400) oheight=500;
	var str="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>cr_lv0086?func=<?php echo $_GET['func'];?>&childfunc="+func+"&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'];?>&ChildID="+vID+"&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>' class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function Approvals(vValue)
{
	if(confirm('Bạn có muốn duyệt không?(Y/N)'))
	{
		var o=document.frmchoose;
 		o.txtStringID.value=vValue;
		o.txtFlag.value=3;
	 	o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 	o.submit();
	}
}
function UnApr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function UnApprovals(vValue)
{
	if(confirm('Bạn có muốn trả lại không?(Y/N)'))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=4;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 	o.submit();
	}
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
function Report(vValue)
{
var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>sp_lv0008?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
	var fun1="Report2('"+vValue+"')";
	setTimeout(fun1,100);
}
function Report2(vValue)
{
	var o=document.frmprocess1;
	o.target="_blank";
	o.action="<?php echo $vDir;?>sp_lv0008?func=<?php echo $_GET['func'];?>&childfunc=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
	//var fun2="Report3('"+vValue+"')";
	//setTimeout(fun2,100);
}	
function Save()
{
	var o=document.frmchoose;
	o.txtFlag.value=6;
	if(o.qxtlv003.value=="")
	{
		alert("Mã công việc không rỗng!");
		o.qxtlv003.focus();
	}	
	else if(o.qxtlv006.value=="")
	{
		alert("Mã nhân viên không rỗng!");
		o.qxtlv008.focus();
	}	
	else
	{
		o.submit();
	}
}
function CheckLoadID(value)
	{
		ajax_do ('<?php echo $vDir;?>cr_lv0086/cr_lv0086excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&LoadID='+value,1);
	}
//Lọc hoá đơn
function Fillter_SoHoDon()
{
	var o=document.frmchoose;
	o.txtFlag.value=2;
    o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	o.submit();
}
function RunDisableAll(cur)
{
	var o=document.getElementById("curTabView");
	o.value=cur;
	for(var js=0;js<=1;js++)
	{
		var o1=document.getElementById("cl_"+js+"_1");
		var o3=document.getElementById("hrtab_"+js);
		
		if(cur==js)
		{
			if(o1!=null) o1.style.display="block";
			if(o3!=null) o3.className="curshow";
			
		}
		else
		{
			if(o1!=null) o1.style.display="none";
			if(o3!=null) o3.className="cssTab";
		}
	}	
}
function jobshow(cur)
{
	for(var js=1;js<=3;js++)
	{
		var o1=document.getElementById("job_"+js);
		
		if(cur==js)
		{
			if(o1!=null) o1.style.display="block";
			
		}
		else
		{
			if(o1!=null) o1.style.display="none";
			
		}
	}	
}
function Load_quyettoan()
{
	var o1=document.getElementById("load_qtoan");
	o1.src="home.php?lang=VN&opt=27&item=&link=c3BfbHYwMzAwL3NwX2x2MDMwMC5waHA=";
}
function LoadType(to)
	{

		var o=document.frmchoose;
		var vo=o.qxtlv013.value;
		switch(vo)
		{
			case 'EMP':
				LoadPopupParent(to,'qxtlv014','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)');
				break;
			case 'OTH':
			case 'CUS':
				LoadPopupParent(to,'qxtlv014','sl_lv0001','concat(lv001,@! @!,lv002)');
				break;
			case 'SUP':
				LoadPopupParent(to,'qxtlv014','wh_lv0003','concat(lv001,@! @!,lv002)');
				break;
			case 'DEP':
				LoadPopupParent(to,'qxtlv014','hr_lv0002','concat(lv001,@! @!,lv002)');
				break;
			case 'HR':
				LoadPopupParent(to,'qxtlv014','tc_lv0013','concat(lv001,@! @!,lv002)');
				break;
		}
	}
function XuLyPostShow(o,donhangid,option)
{
	if(o.readOnly==false)
	{
		if(confirm('Bạn có muốn lưu không?(y/N)'))
		{
			document.frmprocessall.txtID1.value=donhangid;
			document.frmprocessall.txtField1.value=option;
			document.frmprocessall.txtValues1.value=o.value;
			document.frmprocessall.submit();
		}
	}
}
//-->
</script>
<style>
	.tablehr1 td
	{
		font:12px Arial,Tahoma;
		padding:3px;
	}
	.tablehr1 td .lvhtable
	{
		color:#fff !important;
	}
	.tablehr1
	{
		padding:0px;
		border:0px;
	}
	table .lvtable
	{
		border:0px!important;
		border-spacing:0px !important;
		width:1000px;
		float:left;
	}
	.fnt_bold
	{
		font:12px bold Arial,Tahoma !important;
	}
	.cssTab
	{
		color:#000;
		background:#eaeaea;
		padding:10px;
		padding-left:15px;
		padding-right:15px;
		font:14px Arial,Tahoma;
		border:0px #efefef solid;
		border-radius:7px 7px 0px 0px;
		cursor:pointer;
		margin-right:1px;
	}
	.curshow
	{
		color:#fff;
		background:#39b54a;
		padding:10px;
		padding-left:15px;
		padding-right:15px;
		font:14px Arial,Tahoma;
		border:0px #efefef solid;
		border-radius:7px 7px 0px 0px;
		margin-right:1px;
	}
	.cssTab:hover
	{
		border:1px #efefef solid;
		background:#00bff3;
		color:#fff;
	}
	.IdTabViewHr
	{
	}
	.IdTabViewHr li
	{
		float:left;
	}
	#tblHrClient select,input,textarea
	{
		border:1px #00bff3 solid;
		font:12px Arial,Tahoma;
	}
	.jobs li
	{
		float:left;
	}
	.job_wait
	{
		width:120px;
		background:#1278d1;
		color:#fff;
		padding:15px;
		padding-left:20px;
		padding-right:20px;
		cursor:pointer;
	}
	.job_approval
	{
		width:120px;
		background:#00bff3;
		color:#fff;
		padding:15px;
		padding-left:20px;
		padding-right:20px;
		cursor:pointer;
	}
	.job_cancel
	{
		width:120px;
		background:#6dcff6;
		color:#fff;
		padding:15px;
		padding-left:20px;
		padding-right:20px;
		cursor:pointer;
	}
	.cstblcolor, .cstblcolor td 
	{
		color:#fff;
	}
</style>
<?php
if($mocr_lv0086->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<!--
<table border="0" width="1000">
  		<tbody>
			<tr>
				<td align="left" id="TabViewHr">
					<ul class="IdTabViewHr">
						<li><div id="hrtab_0" class="curshow" onclick="RunDisableAll(0)">1.KẾ HOẠCH BÁN HÀNG</div></li>
						<li><div id="hrtab_1" class="cssTab" onclick="RunDisableAll(1)" ondblclick="Load_quyettoan()">2.KẾ HOẠCH NỘI BỘ</div></li>
					</ul></td>
			</tr>
		</tbody>
	</table>-->
	<div id="cl_0_1">
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><font color="red"><?php echo $vMessage;?></font></div>
					<div><div id="lvleft">
					<form method="post" enctype="multipart/form-data" name="frmprocess" > 
							<input name="txtID" type="hidden" id="txtID" />
					</form>
					<form method="post" enctype="multipart/form-data" name="frmprocess1" > 
							<input name="txtID" type="hidden" id="txtID" />
					</form>
					<form method="post" target="_blank" enctype="multipart/form-data" name="frmprocessall" id="frmprocessall" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"> 
				  		<input name="txtID1" type="hidden" id="txtID1" />
						<input name="txtField1" type="hidden" id="txtField1" />
						<input name="txtValues1" type="hidden" id="txtValues1" />
						<input name="txtFlag" type="hidden" id="txtFlag" value="55"/>
				 	</form>
						<form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
							<input id="curTabView" name="curTabView" type="hidden" value="<?php echo $_POST['curTabView'];?>"/>
							<table style="background:#f2f2f2;font:10px arial">	
								<tr>
									<td  height="20" align="center"><strong><?php echo $mocr_lv0086->ArrPush[5];?></strong></td>
									<td  height="20" align="center"><strong><?php echo $mocr_lv0086->ArrPush[3];?></strong></td>
									<td  height="20px" align="center"><?php echo $mocr_lv0086->ArrPush[4];?></td>
									<td align="center"><?php echo $mocr_lv0086->ArrPush[7];?></td>
									<td  height="20" align="center"><?php echo $mocr_lv0086->ArrPush[8];?></td>
									<td  height="20" align="center"><?php echo $mocr_lv0086->ArrPush[9];?></td>
									<td align="center">Ngày đến hạn<br/>(yyyy-mm-dd)</td>
									<td  height="20px" align="center">Ngày hoàn thành<br/>(yyyy-mm-dd)</td>
									<td align="center">Người tạo</td>
									<td align="center">Ngày tạo<br/>(yyyy-mm-dd)</td>
									
									<td></td>
								<tr>
									<td  height="20px"  align="center">
										<input name="txtlv004" type="text" id="txtlv004" title="<?php echo $mocr_lv0086->lv004;?>"   value="<?php echo $mocr_lv0086->lv004;?>" tabindex="9"  style="width:100%;text-align:center;"/>			
									</td> 
									<td  height="20px"  align="center">
										<ul id="pop-nav" lang="pop-nav2" onMouseOver="ChangeName(this,2)">
											<li class="menupopT">
											<input   onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};" autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv002','cr_lv0004','lv001','concat(lv002,@! @!,lv001)')" name="txtlv002" type="textbox" id="txtlv002" value="<?php echo $_POST['txtlv002'];?>" style="min-width:80px;width:100%;" tabindex="9" >
												<div id="lv_popup" lang="lv_popup2"> </div>
											</li>
										</ul>
									</td> 
									<td  height="20px"  align="center">
										<ul id="pop-nav37" lang="pop-nav37" onMouseOver="ChangeName(this,37)">
											<li class="menupopT">
											<input onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};" autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv003','sp_lv0086','lv001','concat(lv002,@! @!,lv001)')" name="txtlv003" type="textbox" id="txtlv003" value="<?php echo $_POST['txtlv003'];?>" style="width:70px" tabindex="9">
												<div id="lv_popup37" lang="lv_popup37"> </div>
											</li>
										</ul>
									</td> 
									<td  height="20px"  align="center">
									<ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)">
										<li class="menupopT">
										<input   onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};" autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv006','hr_lv0020','lv001','concat(lv002,@! @!,lv001)')" name="txtlv006" type="textbox" id="txtlv006" value="<?php echo $_POST['txtlv006'];?>" style="width:70px" tabindex="8" maxlength="50">
											<div id="lv_popup6" lang="lv_popup6"> </div>
										</li>
									</ul>
									</td>
									<td  height="20px"  align="center">
									<ul id="pop-nav7" lang="pop-nav7" onMouseOver="ChangeName(this,7)">
										<li class="menupopT">
										<input  onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};"  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv007','hr_lv0020','lv001','concat(lv002,@! @!,lv001)')" name="txtlv007" type="textbox" id="txtlv007" value="<?php echo $_POST['txtlv007'];?>" style="width:70px" tabindex="8" maxlength="50">
											<div id="lv_popup7" lang="lv_popup7"> </div>
										</li>
									</ul>
									</td>
									<td  height="20px"  align="center">
									<ul id="pop-nav8" lang="pop-nav8" onMouseOver="ChangeName(this,8)">
										<li class="menupopT">
										<input  onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};"  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv008','hr_lv0020','lv001','concat(lv002,@! @!,lv001)')" name="txtlv008" type="textbox" id="txtlv008" value="<?php echo $_POST['txtlv008'];?>" style="width:70px" tabindex="8" maxlength="50">
											<div id="lv_popup8" lang="lv_popup8"> </div>
										</li>
									</ul>
									</td>
									<td  height="20px" align="center">
										<input  autocomplete="off" style="width:70px;text-align:center;" name="txtlv005" type="text" id="txtlv005" value="<?php echo $mocr_lv0086->lv005;?>" tabindex="9"  style="width:100%">
									</td>
									<td>
										<input name="txtlv012" type="text" id="txtlv012" title="<?php echo $mocr_lv0086->lv012;?>" onfocus="if(this.value='') this.value=this.title;"  value="<?php echo $mocr_lv0086->lv010;?>" tabindex="5"  style="width:100%"/>			
									</td>
									
								<td  height="20px" align="center">
									<ul id="pop-nav20" lang="pop-nav20" onMouseOver="ChangeName(this,20)">
											<li class="menupopT">
											<input  onblur="if(this.value.substr(this.value.length-1,this.value.length)==',') {this.value=this.value.substr(0,this.value.length-1);};"  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv820','sp_lv0045','lv001','concat(lv002,@! - @!,lv001)')" name="txtlv820" type="textbox" id="txtlv820" value="<?php echo $_POST['txtlv820'];?>" style="width:70px" tabindex="8" maxlength="50">
												<div id="lv_popup20" lang="lv_popup20"> </div>
											</li>
										</ul></td> 
								<td align="center">
										<input name="txtlv824" type="text" id="txtlv824" title="<?php echo $mocr_lv0086->DateCurrent;?>" onfocus="if(this.value='') this.value=this.title;"  value="<?php echo $mocr_lv0086->lv824;?>" tabindex="5" maxlength="32" style="width:100%"/>			
								</td>
								<td  height="20px"><input type="button" value="Lọc dữ liệu" onclick="Fillter_SoHoDon()"/></td>
								</tr>	
							</table>
						<input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
							<input name="txtStringID" type="hidden" id="txtStringID" />
							<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
							<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
							<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
							<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mocr_lv0086->lv001;?>"/>
						
							<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mocr_lv0086->lv011;?>"/>
							<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mocr_lv0086->lv013;?>"/>
							<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mocr_lv0086->lv014;?>"/>
							<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mocr_lv0086->lv016;?>"/>
							<input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mocr_lv0086->lv017;?>"/>
							<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $mocr_lv0086->lv018;?>"/>
							<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $mocr_lv0086->lv019;?>"/>
							<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $mocr_lv0086->lv020;?>"/>
							<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $mocr_lv0086->lv021;?>"/>
							<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $mocr_lv0086->lv022;?>"/>
							<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $mocr_lv0086->lv023;?>"/>
							<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $mocr_lv0086->lv024;?>"/>
							<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $mocr_lv0086->lv025;?>"/>
							<input type="hidden" name="txtlv026" id="txtlv026" value="<?php echo $mocr_lv0086->lv026;?>"/>
							<input type="hidden" name="txtlv027" id="txtlv027" value="<?php echo $mocr_lv0086->lv027;?>"/>
							<input type="hidden" name="txtlv028" id="txtlv028" value="<?php echo $mocr_lv0086->lv028;?>"/>
							<input type="hidden" name="txtlv029" id="txtlv029" value="<?php echo $mocr_lv0086->lv029;?>"/>
							<input type="hidden" name="txtlv030" id="txtlv030" value="<?php echo $mocr_lv0086->lv030;?>"/>
							<input type="hidden" name="txtlv031" id="txtlv031" value="<?php echo $mocr_lv0086->lv031;?>"/>
							<input type="hidden" name="txtlv032" id="txtlv032" value="<?php echo $mocr_lv0086->lv032;?>"/>
							<input type="hidden" name="txtlv033" id="txtlv033" value="<?php echo $mocr_lv0086->lv033;?>"/>
							<input type="hidden" name="txtlv034" id="txtlv034" value="<?php echo $mocr_lv0086->lv034;?>"/>
							<input type="hidden" name="txtlv035" id="txtlv035" value="<?php echo $mocr_lv0086->lv035;?>"/>
							<input type="hidden" name="txtlv036" id="txtlv036" value="<?php echo $mocr_lv0086->lv036;?>"/>
							<input type="hidden" name="txtlv037" id="txtlv037" value="<?php echo $mocr_lv0086->lv037;?>"/>
							<input type="hidden" name="txtlv038" id="txtlv038" value="<?php echo $mocr_lv0086->lv038;?>"/>
							<input type="hidden" name="txtlv039" id="txtlv039" value="<?php echo $mocr_lv0086->lv039;?>"/>
							<input type="hidden" name="txtlv040" id="txtlv040" value="<?php echo $mocr_lv0086->lv040;?>"/>
							<input type="hidden" name="txtlv041" id="txtlv041" value="<?php echo $mocr_lv0086->lv041;?>"/>
							<input type="hidden" name="txtlv042" id="txtlv042" value="<?php echo $mocr_lv0086->lv042;?>"/>
							<input type="hidden" name="txtlv043" id="txtlv043" value="<?php echo $mocr_lv0086->lv043;?>"/>
							<input type="hidden" name="txtlv044" id="txtlv044" value="<?php echo $mocr_lv0086->lv044;?>"/>
							<input type="hidden" name="txtlv045" id="txtlv045" value="<?php echo $mocr_lv0086->lv045;?>"/>	
							<input type="hidden" name="txtlv046" id="txtlv046" value="<?php echo $mocr_lv0086->lv046;?>"/>							
							<input type="hidden" name="txtlv047" id="txtlv047" value="<?php echo $mocr_lv0086->lv047;?>"/>	
							<input type="hidden" name="txtlv048" id="txtlv048" value="<?php echo $mocr_lv0086->lv048;?>"/>	
							<input type="hidden" name="txtlv049" id="txtlv049" value="<?php echo $mocr_lv0086->lv049;?>"/>	
							<input type="hidden" name="txtlv050" id="txtlv050" value="<?php echo $mocr_lv0086->lv050;?>"/>	
							<input type="hidden" name="txtlv051" id="txtlv051" value="<?php echo $mocr_lv0086->lv051;?>"/>	
							<input type="hidden" name="txtlv070" id="txtlv070" value="<?php echo $mocr_lv0086->lv070;?>"/>	
							<input type="hidden" name="txtlv071" id="txtlv071" value="<?php echo $mocr_lv0086->lv071;?>"/>	
							<input type="hidden" name="txtlv072" id="txtlv072" value="<?php echo $mocr_lv0086->lv072;?>"/>	
							<input type="hidden" name="txtlv076" id="txtlv076" value="<?php echo $mocr_lv0086->lv076;?>"/>	
							<?php echo $mocr_lv0086->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
					</form>
					
			</div>
	</div>
</div>
<div id="cl_1_1" style="display:none">
	<iframe id="load_qtoan" height=2000 marginheight=0 marginwidth=0 frameborder=0 src="home.php?lang=VN&opt=27&item=&link=c3BfbHYwMzAwL3NwX2x2MDMwMC5waHA=" class=lvframe></iframe>
</div>
</body>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
function UpdateText(o,donhangid,option)
{
		$xmlhttp555=null;		
		xmlhttp555=GetXmlHttpObject();
		if (xmlhttp555==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		var value=o.value;
		switch(option)
		{
			case 26:
				value=replaces("\n","|||",value);
				value=replaces("+","$$$",value);
				break;
			default:
				value=replaces("+","$$$",value);
				break;
				break;
		}
		url=url+"&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+value+"&optrun="+option;
		url=url.replace("#","");
		xmlhttp555.onreadystatechange=stateactivebangtext;
		xmlhttp555.open("GET",url,true);
		xmlhttp555.send(null);	
}	
function UpdateTextCheck(o,donhangid,option)
{
		$xmlhttp555=null;		
		xmlhttp555=GetXmlHttpObject();
		if (xmlhttp555==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		var value=(o.checked)?1:0;
		url=url+"&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+value+"&optrun="+option;
		url=url.replace("#","");
		xmlhttp555.onreadystatechange=stateactivebangtext;
		xmlhttp555.open("GET",url,true);
		xmlhttp555.send(null);	
}	
function stateactivebangtext()
{
}
function GetXmlHttpObject()
{
	if (window.XMLHttpRequest)
	{
	  // code for IE7+, Firefox, Chrome, Opera, Safari
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject)
	{
	  // code for IE6, IE5
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}

</script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<script language="javascript">
function Load_Focus()
{
	document.frmchoose.qxtlv006.focus();
}
setTimeout("Load_Focus()",300);
</script>
</html>