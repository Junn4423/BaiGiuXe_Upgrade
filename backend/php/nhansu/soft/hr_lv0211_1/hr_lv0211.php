<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/hr_lv0211.php");

/////////////init object//////////////
$mohr_lv0211=new hr_lv0211($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0211');
$mohr_lv0211->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($mohr_lv0211->GetEdit()==1)
{
	if(isset($_GET['ajaxbangtext']))
	{
		$vdonhangid=$_GET['donhangid'];
		$voption=$_GET['optrun'];
		if($vdonhangid!='' && $vdonhangid!=NULL)
		{
			$vText=$_GET['textup'];
			$vUserID=$mohr_lv0211->LV_UserID;
			$vlvField='lv'.Fillnum($voption,3);
			switch($voption)
			{
				case 4:	
					 $vsql="update hr_lv0210 set $vlvField='$vText' where lv001='$vdonhangid' ";
					break;			
				
			}
			
			$vresult=db_query($vsql);
		}
		exit;
	}
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","HR0046.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0211->ArrPush[0]='DANH SÁCH TÀI LIỆU THÀNH VIÊN';
$mohr_lv0211->ArrPush[1]='STT';
$mohr_lv0211->ArrPush[2]='Mã tự động';
$mohr_lv0211->ArrPush[3]='Tên tài liệu';
$mohr_lv0211->ArrPush[4]='Loại tại liệu';
$mohr_lv0211->ArrPush[5]='Nhấp nháy';
$mohr_lv0211->ArrPush[6]='Chỉ tập tin PDF';
$mohr_lv0211->ArrPush[7]='Trạng thái';
$mohr_lv0211->ArrPush[8]='Quyền truy cập';
$mohr_lv0211->ArrPush[9]='Người tạo';
$mohr_lv0211->ArrPush[10]='Thứ tự';

$mohr_lv0211->ArrFunc[0]='//Function';
$mohr_lv0211->ArrFunc[1]=$vLangArr[2];
$mohr_lv0211->ArrFunc[2]=$vLangArr[4];
$mohr_lv0211->ArrFunc[3]=$vLangArr[6];
$mohr_lv0211->ArrFunc[4]=$vLangArr[7];
$mohr_lv0211->ArrFunc[5]='';
$mohr_lv0211->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mohr_lv0211->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mohr_lv0211->ArrFunc[8]=$vLangArr[10];
$mohr_lv0211->ArrFunc[9]=$vLangArr[12];
$mohr_lv0211->ArrFunc[10]=$vLangArr[0];
$mohr_lv0211->ArrFunc[11]=$vLangArr[28];
$mohr_lv0211->ArrFunc[12]=$vLangArr[29];
$mohr_lv0211->ArrFunc[13]=$vLangArr[30];
$mohr_lv0211->ArrFunc[14]=$vLangArr[31];
$mohr_lv0211->ArrFunc[15]=$vLangArr[32];
////Other
$mohr_lv0211->ArrOther[1]=$vLangArr[26];
$mohr_lv0211->ArrOther[2]=$vLangArr[27];
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
	$vresult=$mohr_lv0211->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0211",$lvMessage);
}
elseif($flagID==2)
{
$mohr_lv0211->lv001=$_POST['txtlv001'];
$mohr_lv0211->lv002= $_GET['ID'] ?? '';
$mohr_lv0211->lv003=$_POST['txtlv003'];
$mohr_lv0211->lv004=$_POST['txtlv004'];
$mohr_lv0211->lv005=$_POST['txtlv005'];
$mohr_lv0211->lv006=$_POST['txtlv006'];
$mohr_lv0211->lv007=$_POST['txtlv007'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0211->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0211->LV_UnAproval($strar);
}
//first is load
if (!isset($_POST["txtFlag"]) || $_POST["txtFlag"] == "")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0211->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0211');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0211->ListView;
$curPage = $mohr_lv0211->CurPage;
$maxRows =$mohr_lv0211->MaxRows;
$vOrderList=$mohr_lv0211->ListOrder;
$vSortNum=$mohr_lv0211->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0211->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0211',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mohr_lv0211->lv002= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0211->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = (($curPage-1)<0)?0:($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>MINH PHUONG</title>
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
	window.open('<?php echo $vDir;?>'+'hr_lv0211/?lang=<?php echo $plang;?>&childfunc=download&ID='+vID,'download','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');

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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,13,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe height=500 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>hr_lv0211?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>' class=lvframe></iframe>";
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
	o.target="_self";
	o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	o.target="_self";
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
//-->
</script>
<?php
if($mohr_lv0211->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,13,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0211->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0211->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $mohr_lv0211->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mohr_lv0211->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mohr_lv0211->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mohr_lv0211->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mohr_lv0211->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mohr_lv0211->lv007;?>"/>
					    
				  </form>

				  
</div></div>
</body>
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
			if(o.checked)
				value=1;
			else
				value=0;
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
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mohr_lv0211->ArrPush[0];?>';	
</script>				
<?php
} else {
	include("../permit.php");
}
?>

</html>