<?php
$vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ts_lv1001.php");
require_once("$vDir../clsall/ts_lv0003.php");

/////////////init object//////////////
$mots_lv1001=new ts_lv1001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts1001');
$mots_lv1001->Dir=$vDir;
$mots_lv1001->path_server="../../images/uploads/";
$mots_lv1001->path_web=getInfor($_SESSION['ERPSOFV2RUserID'],2)."/";
$mots_lv1001->img_height=50;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if(isset($_GET['ajax']))
{
	$vcusid=$_GET['cusid'];
	$mots_lv0003=new ts_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0003');
	$mots_lv0003->LV_LoadID($vcusid);
	echo '[CHECK]';
	echo $mots_lv0003->lv002;
	echo '[ENDCHECK]';
	echo '[TCHECK]';
	echo $mots_lv0003->lv019;
	echo '[ENDTCHECK]';
	echo '[SCHECK]';
	echo $mots_lv0003->lv020;
	echo '[ENDSCHECK]';
	exit;
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","SP0046.txt",$plang);
$mots_lv1001->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv1001->ArrPush[0]=$vLangArr[17];
$mots_lv1001->ArrPush[1]=$vLangArr[18];
$mots_lv1001->ArrPush[2]=$vLangArr[19];
$mots_lv1001->ArrPush[3]=$vLangArr[20];
$mots_lv1001->ArrPush[4]=$vLangArr[21];
$mots_lv1001->ArrPush[5]=$vLangArr[22];
$mots_lv1001->ArrPush[6]=$vLangArr[23];
$mots_lv1001->ArrPush[7]=$vLangArr[24];
$mots_lv1001->ArrPush[8]=$vLangArr[25];
$mots_lv1001->ArrPush[9]=$vLangArr[26];
$mots_lv1001->ArrPush[10]=$vLangArr[27];
$mots_lv1001->ArrPush[11]=$vLangArr[28];
$mots_lv1001->ArrPush[12]=$vLangArr[29];
$mots_lv1001->ArrPush[13]=$vLangArr[30];
$mots_lv1001->ArrPush[14]=$vLangArr[31];
$mots_lv1001->ArrPush[15]=$vLangArr[32];
$mots_lv1001->ArrPush[16]=$vLangArr[33];
$mots_lv1001->ArrPush[17]=$vLangArr[34];
$mots_lv1001->ArrPush[18]=$vLangArr[35];
$mots_lv1001->ArrPush[19]=$vLangArr[46];
$mots_lv1001->ArrPush[20]=$vLangArr[47];
$mots_lv1001->ArrPush[21]=$vLangArr[48];
$mots_lv1001->ArrPush[22]=$vLangArr[49];

$mots_lv1001->ArrFunc[0]='//Function';
$mots_lv1001->ArrFunc[1]=$vLangArr[2];
$mots_lv1001->ArrFunc[2]=$vLangArr[4];
$mots_lv1001->ArrFunc[3]=$vLangArr[6];
$mots_lv1001->ArrFunc[4]=$vLangArr[7];
$mots_lv1001->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mots_lv1001->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mots_lv1001->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mots_lv1001->ArrFunc[8]=$vLangArr[10];
$mots_lv1001->ArrFunc[9]=$vLangArr[12];
$mots_lv1001->ArrFunc[10]=$vLangArr[0];
$mots_lv1001->ArrFunc[11]=$vLangArr[38];
$mots_lv1001->ArrFunc[12]=$vLangArr[39];
$mots_lv1001->ArrFunc[13]=$vLangArr[40];
$mots_lv1001->ArrFunc[14]=$vLangArr[41];
$mots_lv1001->ArrFunc[15]=$vLangArr[42];

////Other
$mots_lv1001->ArrOther[1]=$vLangArr[36];
$mots_lv1001->ArrOther[2]=$vLangArr[37];
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
function UploadImg($folder_name, $fname){
	$maxsize = 3169600;//Max file size 300KMB
	$path = "../../images/uploads/";
	$arrName = explode(".", $fname);
	$fname = $arrName[0];///Get name without extention of file
	create_folder($path, $folder_name);
	$path = $path.$folder_name."/";
	$result = upload_file($fpath, $fname, $path, $maxsize);
	if($result==1){
		$message = "Image uploaded successfully!";
		//$vFlag = 2;//Upload successful.
		//$fpath = "";
		//$fname = "";
	}
	if($result==2)
		$message = "Incorrect file type!";
	if($result==3 || $result==4)
		$message = "Image size is very small or big!";
	if($result==5 || $result==6)
		$message = "Error in uploading file, please try again!";	
	
}
if($flagID==1)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mots_lv1001->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ts_lv1001",$lvMessage);
}
elseif($flagID==2)
{
$mots_lv1001->lv001=$_POST['txtlv001'];
$lvts_lv1001->lv002=$_POST['txtlv002'];
$mots_lv1001->lv003=$_POST['txtlv003'];
$mots_lv1001->lv004=$_POST['txtlv004'];
$mots_lv1001->lv005=$_POST['txtlv005'];
$mots_lv1001->lv006=$_POST['txtlv006'];
$mots_lv1001->lv007=$_POST['txtlv007'];
$mots_lv1001->lv008=$_POST['txtlv008'];
$mots_lv1001->lv009=$_POST['txtlv009'];
$mots_lv1001->lv010=$_POST['txtlv010'];
$mots_lv1001->lv011=$_POST['txtlv011'];
$mots_lv1001->lv012=$_POST['txtlv012'];
$mots_lv1001->lv013=$_POST['txtlv013'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mots_lv1001->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mots_lv1001->LV_UnAproval($strar);
}
elseif($flagID==6)
{
	
	$mots_lv1001->lv002= $_GET['ID'] ?? '';
	$mots_lv1001->lv003=$_POST['qxtlv003'];
	$mots_lv1001->lv004=$_POST['qxtlv004'];
	$mots_lv1001->lv005=$_POST['qxtlv005'];
	$mots_lv1001->lv006=$_POST['qxtlv006'];
	$mots_lv1001->lv007=$_POST['qxtlv007'];
	$mots_lv1001->lv008=$_POST['qxtlv008'];
	$mots_lv1001->lv009=$_POST['qxtlv009'];
	$mots_lv1001->lv010=$_POST['qxtlv010'];
	$mots_lv1001->lv011=$_POST['qxtlv011'];
	$mots_lv1001->lv012=$_POST['qxtlv012'];
	$mots_lv1001->lv013=$_POST['qxtlv013'];
	$mots_lv1001->lv017=$_POST['qxtlv017'];
	$mots_lv1001->lv020=$_POST['qxtlv020'];
	if($_FILES['userfile']['name']=="" || $_FILES['userfile']['name']==NULL)
		$mots_lv1001->lv018=$_POST['qxtlv018'];
	else
	{
		$mots_lv1001->lv018="qt_".time().exten($_FILES['userfile']['name']);
	}
	$vresult=$mots_lv1001->LV_Insert();
	if($vresult)
	{
		if($_FILES['userfile']['name']!="" && $_FILES['userfile']['name']!=NULL)	UploadImg(getInfor($_SESSION['ERPSOFV2RUserID'],2), $mots_lv1001->lv018);///Call function Upload file
		$vMessage='Nhập phí xe thành công!';
	}
	else
	{
		$vMessage='Không lưu được!';
	}
	
	$mots_lv1001->lv002='';
	$mots_lv1001->lv002='';
	$mots_lv1001->lv003='';
	$mots_lv1001->lv004='';
	$mots_lv1001->lv005='';
	$mots_lv1001->lv006='';
	$mots_lv1001->lv007='';
	$mots_lv1001->lv008='';
	$mots_lv1001->lv009='';
	$mots_lv1001->lv010='';
	$mots_lv1001->lv011='';
	$mots_lv1001->lv012='';
	$mots_lv1001->lv013='';
	$mots_lv1001->lv014='';
	$mots_lv1001->lv015='';
	$mots_lv1001->lv016='';
	$mots_lv1001->lv017='';
	$mots_lv1001->lv020='';
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv1001->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv1001');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mots_lv1001->ListView;
$curPage = $mots_lv1001->CurPage;
$maxRows =$mots_lv1001->MaxRows;
$vOrderList=$mots_lv1001->ListOrder;
$vSortNum=$mots_lv1001->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mots_lv1001->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv1001',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
$mots_lv1001->lv002= $_GET['ID'] ?? '';
$totalRowsC=$mots_lv1001->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>MINH PHUONG</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engines.js"></script>
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc=<?php echo $_GET['childdetailfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0);?>"
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
	var str="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>ts_lv1001?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc=<?php echo $_GET['childdetailfunc'];?>&childdetailfunc2="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&ExtChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc=<?php echo $_GET['childdetailfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0);?>"
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
	o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc=<?php echo $_GET['childdetailfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0);?>"
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
	o.action="<?php echo $vDir;?>ts_lv1001?func=<?php echo $_GET['func'];?>&childdetailfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function Save()
{
	var o=document.frmchoose;
	o.txtFlag.value=6;
	if(parseFloat(o.qxtlv003.value)<=0)
	{
			alert("Tiền phải lớn hơn 0");
			o.qxtlv003.focus();
	}	
	else if(o.qxtlv007.value=="")
	{
		alert("Phải nhập tên khách hàng");
		o.qxtlv007.focus();
			
	}
	else if(o.qxtlv012.value=="")
	{
		alert("Phải nhập mã sản phẩm");
		o.qxtlv012.focus();
			
	}
	else
		o.submit();
}
//-->
</script>
<?php
if($mots_lv1001->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><font color="red"><?php echo $vMessage;?></font></div>
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc=<?php echo $_GET['childdetailfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&ID=<?php echo  $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0);?>" method="post" name="frmchoose" id="frmchoose" enctype="multipart/form-data"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mots_lv1001->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mots_lv1001->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mots_lv1001->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mots_lv1001->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mots_lv1001->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mots_lv1001->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mots_lv1001->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mots_lv1001->lv007;?>"/>	
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mots_lv1001->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mots_lv1001->lv009;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mots_lv1001->lv011;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mots_lv1001->lv010;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mots_lv1001->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mots_lv1001->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mots_lv1001->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mots_lv1001->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mots_lv1001->lv016;?>"/>
						<input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mots_lv1001->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $mots_lv1001->lv018;?>"/>
						<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $mots_lv1001->lv019;?>"/>
						<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $mots_lv1001->lv020;?>"/>
						<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $mots_lv1001->lv021;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $mots_lv1001->lv022;?>"/>
						<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $mots_lv1001->lv023;?>"/>
						<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $mots_lv1001->lv024;?>"/>
						<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $mots_lv1001->lv025;?>"/>
						<input type="hidden" name="txtlv026" id="txtlv026" value="<?php echo $mots_lv1001->lv026;?>"/>
						<input type="hidden" name="txtlv027" id="txtlv027" value="<?php echo $mots_lv1001->lv027;?>"/>
						<input type="hidden" name="txtlv028" id="txtlv028" value="<?php echo $mots_lv1001->lv028;?>"/>
						<input type="hidden" name="txtlv029" id="txtlv029" value="<?php echo $mots_lv1001->lv029;?>"/>
						<input type="hidden" name="txtlv030" id="txtlv030" value="<?php echo $mots_lv1001->lv030;?>"/>
						<input type="hidden" name="txtlv031" id="txtlv031" value="<?php echo $mots_lv1001->lv031;?>"/>
						<input type="hidden" name="txtlv032" id="txtlv032" value="<?php echo $mots_lv1001->lv032;?>"/>
						<input type="hidden" name="txtlv033" id="txtlv033" value="<?php echo $mots_lv1001->lv033;?>"/>
						<input type="hidden" name="txtlv034" id="txtlv034" value="<?php echo $mots_lv1001->lv034;?>"/>
						<input type="hidden" name="txtlv035" id="txtlv035" value="<?php echo $mots_lv1001->lv035;?>"/>
						<input type="hidden" name="txtlv036" id="txtlv036" value="<?php echo $mots_lv1001->lv036;?>"/>
						<input type="hidden" name="txtlv037" id="txtlv037" value="<?php echo $mots_lv1001->lv037;?>"/>
						<input type="hidden" name="txtlv038" id="txtlv038" value="<?php echo $mots_lv1001->lv038;?>"/>
						<input type="hidden" name="txtlv039" id="txtlv039" value="<?php echo $mots_lv1001->lv039;?>"/>
						<input type="hidden" name="txtlv040" id="txtlv040" value="<?php echo $mots_lv1001->lv040;?>"/>
						<input type="hidden" name="txtlv041" id="txtlv041" value="<?php echo $mots_lv1001->lv041;?>"/>
						<input type="hidden" name="txtlv042" id="txtlv042" value="<?php echo $mots_lv1001->lv042;?>"/>
						<input type="hidden" name="txtlv043" id="txtlv043" value="<?php echo $mots_lv1001->lv043;?>"/>
						<input type="hidden" name="txtlv044" id="txtlv044" value="<?php echo $mots_lv1001->lv044;?>"/>
						<input type="hidden" name="txtlv045" id="txtlv045" value="<?php echo $mots_lv1001->lv045;?>"/>	
						<input type="hidden" name="txtlv046" id="txtlv046" value="<?php echo $mots_lv1001->lv046;?>"/>							
						<input type="hidden" name="txtlv047" id="txtlv047" value="<?php echo $mots_lv1001->lv047;?>"/>	
						<input type="hidden" name="txtlv048" id="txtlv048" value="<?php echo $mots_lv1001->lv048;?>"/>	
						<input type="hidden" name="txtlv049" id="txtlv049" value="<?php echo $mots_lv1001->lv049;?>"/>	
						<input type="hidden" name="txtlv050" id="txtlv050" value="<?php echo $mots_lv1001->lv050;?>"/>	
						<input type="hidden" name="txtlv051" id="txtlv051" value="<?php echo $mots_lv1001->lv051;?>"/>	
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  
</div></div>
</body>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
function changecustomer_change(value)
		{
			$xmlhttp=null;
			if(value=="") 
			{
				return false;
			}
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajax=ajaxcheck"+"&cusid="+value;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChanged;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChanged()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('qxtlv007').value=domainid;
				var startdomain=xmlhttp.responseText.indexOf('[TCHECK]')+8;
				var enddomain=xmlhttp.responseText.indexOf('[ENDTCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('qxtlv008').value=domainid;
				var startdomain=xmlhttp.responseText.indexOf('[SCHECK]')+8;
				var enddomain=xmlhttp.responseText.indexOf('[ENDSCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('qxtlv009').value=domainid;
				document.getElementById('qxtlv007').focus();
			}
		}
		function CalculateC()
		{
			var o=document.frmchoose;
			o.qxtlv005.value=parseFloat(o.qxtlv003.value*o.qxtlv004.value/100);
			return true;
			
			
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
document.frmchoose.qxtlv003.focus();
</script>
</html>