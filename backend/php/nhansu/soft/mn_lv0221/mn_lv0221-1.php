<?php
$vDir  = '';if (isset( $_GET['ID']) &&  $_GET['ID'] != "") $vDir = '../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/mn_lv0221.php");
require_once("$vDir../clsall/sl_lv0007.php");
require_once("$vDir../clsall/cr_lv0202.php");
require_once("$vDir../clsall/cr_lv0203.php");
require_once("$vDir../clsall/cr_lv0092.php");
require_once("$vDir../clsall/wh_lv0003.php");
require_once("$vDir../clsall/cr_lv0324.php");
require_once("$vDir../clsall/jo_lv0016.php");
require_once("$vDir../clsall/cr_lv0108.php");
require_once("$vDir../clsall/cr_lv0109.php");
/////////////init object//////////////
$momn_lv0221=new mn_lv0221($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0221');
$lvcr_lv0202=new cr_lv0202('admin','admin','Cr0202');
$lvcr_lv0203=new cr_lv0203('admin','admin','Cr0203');
$mocr_lv0092=new cr_lv0092('admin','admin','Cr0092');
$mowh_lv0003=new wh_lv0003('admin','admin','Wh0003');
$mocr_lv0324=new cr_lv0324('admin','admin','Wh0003');
$mojo_lv0016=new jo_lv0016('admin','admin','Wh0003');
$lvcr_lv0108=new cr_lv0108('admin','admin','Cr0108');
$lvcr_lv0109=new cr_lv0109('admin','admin','Cr0109');
$mojo_lv0016->LV_Load();
$momn_lv0221->lvcr_lv0202=$lvcr_lv0202;
$lvcr_lv0203->mocr_lv0324=$mocr_lv0324;
$momn_lv0221->lvcr_lv0203=$lvcr_lv0203;
$momn_lv0221->mocr_lv0092=$mocr_lv0092;
$momn_lv0221->mowh_lv0003=$mowh_lv0003;
$momn_lv0221->mojo_lv0016=$mojo_lv0016;
$momn_lv0221->lvcr_lv0108=$lvcr_lv0108;
$momn_lv0221->lvcr_lv0109=$lvcr_lv0109;
$momn_lv0221->TypePO=$_GET['TypePO'];
$momn_lv0221->LV_OptionType();
$momn_lv0221->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","WH0024.txt",$plang);
if($momn_lv0221->GetView()>0)
{	
	if(isset($_GET['ajaxchitiethistory']))
	{
		require_once("$vDir../clsall/cr_lv0105.php");
		$mocr_lv0105=new cr_lv0105($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0221');
		if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","SL0317.txt",$plang);
		$mocr_lv0105->lang=strtoupper($plang);
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$mocr_lv0105->ArrPush[0]=$vLangArr[17];
		$mocr_lv0105->ArrPush[1]=$vLangArr[18];
		$mocr_lv0105->ArrPush[2]=$vLangArr[19];
		$mocr_lv0105->ArrPush[3]=$vLangArr[20];
		$mocr_lv0105->ArrPush[4]='Trạng thái';
		$mocr_lv0105->ArrPush[5]='Người duyệt/không duyệt';
		$mocr_lv0105->ArrPush[6]='Ngày giờ';
		$mocr_lv0105->ArrPush[7]=$vLangArr[24];
		$mocr_lv0105->ArrPush[8]=$vLangArr[25];
		$mocr_lv0105->ArrPush[10]='Ghi chú';

		$vhopdongid=$_GET['hopdongid'];
		//$mosl_lv0014->LV_LoadID($vhopdongid);
		echo '[HDCHECKID]';
		echo $vhopdongid;
		echo '[HDCHECKIDEND]';
		echo '[HDCHECKINFO]';
		$mocr_lv0105->lv002=$vhopdongid;
		$mocr_lv0105->lv007='';
		$curRow=0;
		$maxRows=11111111111;
		$mocr_lv0105->DefaultFieldList="lv004,lv003,lv005,lv009";
		echo $mocr_lv0105->LV_BuilListReport_Short($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);
		echo '[HDCHECKINFOEND]';
		exit();
	}
}
$momn_lv0221->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0221->ArrPush[0]=$vLangArr[17];
$momn_lv0221->ArrPush[1]=$vLangArr[18];
$momn_lv0221->ArrPush[2]=$vLangArr[19];
$momn_lv0221->ArrPush[3]=$vLangArr[20];
$momn_lv0221->ArrPush[4]=$vLangArr[21];
$momn_lv0221->ArrPush[5]=$vLangArr[22];
$momn_lv0221->ArrPush[6]=$vLangArr[23];
$momn_lv0221->ArrPush[7]=$vLangArr[24];
$momn_lv0221->ArrPush[8]=$vLangArr[25];
$momn_lv0221->ArrPush[9]=$vLangArr[26];
$momn_lv0221->ArrPush[10]=$vLangArr[27];
$momn_lv0221->ArrPush[11]=$vLangArr[28];
$momn_lv0221->ArrPush[12]=$vLangArr[29];
$momn_lv0221->ArrPush[13]=$vLangArr[40];
$momn_lv0221->ArrPush[14]=$vLangArr[31];
$momn_lv0221->ArrPush[15]=$vLangArr[32];
$momn_lv0221->ArrPush[16]='Tỷ giá tiền tệ thứ 2';
$momn_lv0221->ArrPush[28]='Trạng thái duyệt';
$momn_lv0221->ArrPush[13]='Tiền tệ thứ 2';
$momn_lv0221->ArrPush[14]='Tỷ giá VNĐ';
$momn_lv0221->ArrPush[15]='';
$momn_lv0221->ArrPush[16]='Tỷ giá tiền tệ thứ 2';
$momn_lv0221->ArrPush[17]='Tiền tệ chính';
$momn_lv0221->ArrPush[88]='Mã nhóm đơn hàng';
$momn_lv0221->ArrPush[89]='Phiếu ĐNVT';
$momn_lv0221->ArrPush[90]='PBH Số';
$momn_lv0221->ArrPush[190]='Tên dự án';
$momn_lv0221->ArrPush[91]='Phiếu đầu ra';
$momn_lv0221->ArrPush[213]='Tổng tiền';
$momn_lv0221->ArrPush[214]='Thanh toán';
$momn_lv0221->ArrPush[99]='Tiền nợ treo';
$momn_lv0221->ArrPush[100]='Tiền nợ còn lại';
$momn_lv0221->ArrPush[115]='Mã công việc';
$momn_lv0221->ArrPush[212]='Tổng tiền mua VNĐ';
$momn_lv0221->ArrPush[213]='Tổng tiền mua chính';
$momn_lv0221->ArrPush[214]='Thanh toán chính';
$momn_lv0221->ArrPush[215]='Tổng tiền mua thứ 2';
$momn_lv0221->ArrPush[216]='Thanh toán thứ 2';
$momn_lv0221->ArrPush[217]='Qui đổi thanh toán thứ 2 → chính';
$momn_lv0221->ArrPush[218]='Qui đổi thanh toán';
$momn_lv0221->ArrPush[219]='Tổng tiền nợ còn lại';
$momn_lv0221->ArrPush[221]='Thanh toán VND';
$momn_lv0221->ArrPush[222]='Qui đổi thanh toán VND → chính';
$momn_lv0221->ArrPush[283]='Tổng tiền mua chính trước VAT';
$momn_lv0221->ArrPush[293]='Tiền VAT';

$momn_lv0221->ArrPush[105]=$vLangArr[42];
$momn_lv0221->ArrPush[106]=$vLangArr[43];
$momn_lv0221->ArrPush[107]=$vLangArr[44];
$momn_lv0221->ArrPush[108]=$vLangArr[45];
$momn_lv0221->ArrPush[109]=$vLangArr[46];
$momn_lv0221->ArrPush[110]=$vLangArr[47];
$momn_lv0221->ArrPush[111]=$vLangArr[48];
$momn_lv0221->ArrPush[112]=$vLangArr[49];
$momn_lv0221->ArrPush[113]=$vLangArr[50];
$momn_lv0221->ArrPush[114]=$vLangArr[51];

$momn_lv0221->ArrPush[200]='Chức năng';

$momn_lv0221->ArrFunc[0]='//Function';
$momn_lv0221->ArrFunc[1]=$vLangArr[2];
$momn_lv0221->ArrFunc[2]=$vLangArr[4];
$momn_lv0221->ArrFunc[3]=$vLangArr[6];
$momn_lv0221->ArrFunc[4]=$vLangArr[7];
$momn_lv0221->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$momn_lv0221->ArrFunc[6]=GetLangExcept('duyet',$plang);
$momn_lv0221->ArrFunc[7]=GetLangExcept('tralai',$plang);
$momn_lv0221->ArrFunc[8]=$vLangArr[10];
$momn_lv0221->ArrFunc[9]=$vLangArr[12];
$momn_lv0221->ArrFunc[10]=$vLangArr[0];
$momn_lv0221->ArrFunc[11]=$vLangArr[35];
$momn_lv0221->ArrFunc[12]=$vLangArr[36];
$momn_lv0221->ArrFunc[13]=$vLangArr[37];
$momn_lv0221->ArrFunc[14]=$vLangArr[38];
$momn_lv0221->ArrFunc[15]=$vLangArr[39];

////Other
$momn_lv0221->ArrOther[1]=$vLangArr[33];
$momn_lv0221->ArrOther[2]=$vLangArr[34];
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
	$vresult=$momn_lv0221->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"mn_lv0221",$lvMessage);
}
elseif($flagID==2)
{
$momn_lv0221->lv001=$_POST['txtlv001'];
if( $_GET['ID']=="")
$momn_lv0221->lv002=$_POST['txtlv002'];
else
$momn_lv0221->lv002= $_GET['ID'] ?? '';
$momn_lv0221->lv003=$_POST['txtlv003'];
$momn_lv0221->lv004=$_POST['txtlv004'];
$momn_lv0221->lv005=$_POST['txtlv005'];
$momn_lv0221->lv006=$_POST['txtlv006'];
$momn_lv0221->lv007=$_POST['txtlv007'];
$momn_lv0221->lv008=$_POST['txtlv008'];
$momn_lv0221->lv009=$_POST['txtlv009'];
$momn_lv0221->lv010=$_POST['txtlv010'];
$momn_lv0221->lv011=$_POST['txtlv011'];
$momn_lv0221->lv012=$_POST['txtlv012'];
$momn_lv0221->lv013=$_POST['txtlv013'];
$momn_lv0221->lv014=$_POST['txtlv014'];
}
elseif($flagID==3)
{
	$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
	$momn_lv0221->mosl_lv0007=$mosl_lv0007;
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$momn_lv0221->LV_Aproval($strar);
}
elseif($flagID==23)
{
	$strar="'".$strchk."'";
	$vresult=$momn_lv0221->LV_Aproval($strar);
}
elseif($flagID==13)
{
	$strar="'".$strchk."'";
	$vresult=$momn_lv0221->LV_AprovalNo($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$momn_lv0221->LV_UnAproval($strar);
}
elseif($flagID==24)
{
	$momn_lv0221->Remark=$_POST['txtRemark'];
	$strar="'".$strchk."'";
	$vresult=$momn_lv0221->LV_UnAproval($strar);
}
elseif($flagID==34)
{
	$momn_lv0221->Remark=$_POST['txtRemark'];
	$strar="'".$strchk."'";
	$vresult=$momn_lv0221->LV_Aproval($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0221->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0221');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$momn_lv0221->ListView;
$curPage = $momn_lv0221->CurPage;
$maxRows =$momn_lv0221->MaxRows;
$vOrderList=$momn_lv0221->ListOrder;
$vSortNum=$momn_lv0221->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$momn_lv0221->SaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0221',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if( $_GET['ID']=="")
$momn_lv0221->lv002=$_POST['txtlv002'];
else
$momn_lv0221->lv002= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;
$momn_lv0221->trangthai=$_GET['trangthai'];
$totalRowsC=$momn_lv0221->GetCount();
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
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engines.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
</head>
<script language="JavaScript" type="text/javascript">
<!--
function  showNhomDonHang(id,hopdongid,gpmhid)
{
	var o=document.getElementById(id);	
	o.style.display="block";
	$xmlhttp12=null;
	if(hopdongid=="") 
	{
	//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
	return false;
	}
	oheight='340';
	var noidung="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src=\"?lang=VN&opt=99&item=&link=Y3JfbHYwMjgzL2NyX2x2MDI4My0xMS5waHA=&trangthai=&trangthai2=&TypePO="+"&ChildID1=isedit&ChildID="+hopdongid+"&GPMHID="+gpmhid+"\" class=lvframe></iframe>";
	document.getElementById('chitietungtien_'+hopdongid).innerHTML=noidung;
}
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=1200 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function AprOk(value)
{
	if(confirm('Bạn có muốn duyệt đơn hàng và chuyển sang mục đơn hàng đã duyệt?(Y/N)'))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=23;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
}
function AprNoOk(value)
{
	if(confirm('Bạn có muốn duyệt đơn hàng này?(Y/N)'))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=13;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function Approvals(vValue)
{
	if(confirm('Bạn có muốn duyệt đơn hàng và chuyển sang mục đơn hàng đã duyệt?(Y/N)'))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=3;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
}
function UnApr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function UnApprovals(vValue)
{
	if(confirm('Bạn có muốn không duyệt đơn hàng này?(Y/N)'))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=4;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
}
function UnAprNoOk(value)
{
	if(confirm('Bạn có muốn trả lại đơn hàng này?(Y/N)'))
	{
		var o=document.frmchoose;
 		o.txtStringID.value=value;
		var objremark=document.getElementById('txttimeadd_'+value);
		if(objremark!=null) 
		{
			if(objremark.value!='Ghi chú') o.txtRemark.value=objremark.value;
		}
		o.target="_self";
		o.txtFlag.value=24;
		o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&trangthaiqt=<?php echo $_GET['trangthaiqt']?>&TypePO=<?php echo $_GET['TypePO']?>&GPMHID=<?php echo $mocr_lv0207->lv123;?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 	o.submit();
	}
}
function ApprovalsOk(value)
{
	if(confirm('Bạn có muốn duyệt đơn hàng này?(Y/N)'))
	{
		var o=document.frmchoose;
 		o.txtStringID.value=value;
		var objremark=document.getElementById('txtghichu_'+value);
		if(objremark!=null) 
		{
			if(objremark.value!='Ghi chú') o.txtRemark.value=objremark.value;
		}
		o.target="_self";
		o.txtFlag.value=34;
		o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&trangthaiqt=<?php echo $_GET['trangthaiqt']?>&TypePO=<?php echo $_GET['TypePO']?>&GPMHID=<?php echo $mocr_lv0207->lv123;?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 	o.submit();
	}
}
function Rpt()
{
	lv_chk_list(document.frmchoose,'lvChk',4);
}
function ReportVT(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>wh_lv0021?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function Report(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
	//var fun1="Report9('"+vValue+"')";
	//setTimeout(fun1,100);
	//var fun2="Report5('"+vValue+"')";
	//setTimeout(fun2,100);
}
function Report2(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}

function Report3(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt3&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
	var fun2="Report2('"+vValue+"')";
	setTimeout(fun2,100);
}
function Report9(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt9&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
	var fun2="Report19('"+vValue+"')";
	setTimeout(fun2,100);
}
function Report19(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt19&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function Report19KTT(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt19ktt&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function Report19KTVT(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt19ktvt&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function Report19KTCT(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt19ktct&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function Report69(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt69&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function Report10(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt10&TypeID=4&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
	var fun2="Report20('"+vValue+"')";
	setTimeout(fun2,100);
}
function Report20(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt20&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function Report20KTT(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt20ktt&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function Report20KTVT(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt20ktvt&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function Report20KTCT(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt20ktct&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function Report5(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt5&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
	//var fun2="Report5('"+vValue+"')";
	setTimeout(fun2,100);
}
function ReportPMH(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt1&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function ReportDNTU(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	var LANGIAOHANG=document.getElementById('LANGIAOHANG').value;
	o.action="<?php echo $vDir;?>mn_lv0221?func=<?php echo $_GET['func'];?>&childfunc=rpt5&ID="+vValue+"&lang=<?php echo $plang;?>&LANGIAOHANG="+LANGIAOHANG;
	o.submit();
}
function Save()
{
	Fillter_SoHoDon();
}
function Fillter_SoHoDon()
{
	var o=document.frmchoose;
	o.txtFlag.value=2;
    o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	o.submit();
}
function  showUngTien(id,hopdongid)
{
	var o=document.getElementById(id);	
	o.style.display="block";
	$xmlhttp12=null;
	if(hopdongid=="") 
	{
	//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
	return false;
	}
	oheight='340';
	var noidung="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src=\"?lang=VN&opt=27&item=&link=Y3JfbHYwMTc3L2NyX2x2MDE3Ny0yLnBocA=="+"&ChildID1=view&ChildID="+hopdongid+"\" class=lvframe></iframe>";
	document.getElementById('chitietungtien_'+hopdongid).innerHTML=noidung;
}
function showtimeadd(id)
{
	var o=document.getElementById('timeadd_'+id);
	o.style.display="block";
}
function closetimeadd(id)
{
	var o=document.getElementById('timeadd_'+id);
	o.style.display="none";
}
function showghichu(id)
{
	var o=document.getElementById('ghichu_'+id);
	o.style.display="block";
}
function closeghichu(id)
{
	var o=document.getElementById('ghichu_'+id);
	o.style.display="none";
}
function XuLyManHinh(o,id)
{
	var vid='ungtienid_'+id;
	var vid1='chitietungtien_'+id;
	var vid2='lvframefrm_'+id;
	if(o.title=='0')
	{
		o.title='1';
		var hok=document.body.scrollHeight;
		document.getElementById(vid).style=document.getElementById('txtisLarge').value;
		document.getElementById(vid).style.height=hok+'px';
		document.getElementById(vid1).style.height=(hok-60)+'px';
		document.getElementById(vid2).style.height=(hok-60)+'px';
		o.value='Thu nhỏ';
	}
	else
	{
		o.title='0';
		document.getElementById(vid).style=document.getElementById('txtisSmall').value;
		document.getElementById(vid).style.height="360px";
		document.getElementById(vid1).style.height="300px";
		document.getElementById(vid2).style.height="300px";
		o.value='Mở lớn';
	}
}
//-->
</script>
<?php
if($momn_lv0221->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft">
						<form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&TypePO=<?php echo $_GET['TypePO']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
							<input type="hidden" name="txtRemark" value=""/>
							<table style="background:#f2f2f2;font:10px arial" >	
								<tr>
									<td  height="20px"><input type="button" value="Lọc dữ liệu" onclick="Fillter_SoHoDon()"/></td>
									
									<td nowrap  height="20px"><?php echo 'Mã đơn hàng';?></td>
									<td nowrap> PBH Số</td>
									<td nowrap  height="20px"><?php echo 'Tên dự án';?></td>
									<td nowrap> Mã nhà cung cấp</td>
									<td nowrap  height="20px" nowrap><?php echo 'Ngày đặt hàng<br/>(yyyy-mm-dd)';?></td>
									<td nowrap> Người mua hàng</td>
									<td nowrap> Phiếu đầu ra</td>
									
									<td nowrap> Phiếu ĐNVT</td>
								</tr>
								<tr>
									<td><select class="norequired" name="LANGIAOHANG"  id="LANGIAOHANG"  style="min-width:90px;width:100%;">
											<option value='' selected="selected">Chọn đợt GH</option>
											<?php echo $momn_lv0221->LV_LinkField('lv000',$mosl_lv0013->LANGIAOHANG);?>
										</select>
									</td>
								<td  height="20px"><input  autocomplete="off" style="width:120px;text-align:center;" name="txtlv001" type="text" id="txtlv001" value="<?php echo $momn_lv0221->lv001;?>" tabindex="9" maxlength="50" style="width:100%" onKeyPress="return CheckKey(event,7)"></td>
								<td>
									<table width="95%">
											<tr>
											<td>
												<ul id="pop-nav33" lang="pop-nav33" onMouseOver="ChangeName(this,33)">
													<li class="menupopT">
													<input  autocomplete="off" onkeyup="LoadSelfNextParentNewSreen(this,'txtlv089','sl_lv0013','lv115','lv115,lv014,lv002,lv003,lv004,lv005','','',1)" onfocus="LoadSelfNextParentNewSreen(this,'txtlv089','sl_lv0013','lv115','lv115,lv014,lv002,lv003,lv004,lv005','','',1)" name="txtlv089" type="textbox" id="txtlv089" value="<?php echo $_POST['txtlv089'];?>" style="width:120px" tabindex="8" maxlength="50" onKeyPress="return CheckKey(event,7)">
														<div id="lv_popup33" lang="lv_popup33"> </div>
													</li>
												</ul>
												</td>
											</tr>
										</table>
								</td>
								<td  height="20px"><input  autocomplete="off" style="width:120px;text-align:center;" name="txtTenDuAn" type="text" id="txtTenDuAn" value="<?php echo $momn_lv0221->TenDuAn;?>" tabindex="9" maxlength="50" style="width:100%" onKeyPress="return CheckKey(event,7)"></td> 
								<td>
									<table width="95%">
											<tr>
											<td>
												<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)">
													<li class="menupopT">
													<input  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv002','wh_lv0003','lv001','concat(lv006,@! @!,lv010,@! @!,lv002,@! - @!,lv001)')" name="txtlv002" type="textbox" id="txtlv002" value="<?php echo $_POST['txtlv002'];?>" style="width:120px" tabindex="8" maxlength="50" onKeyPress="return CheckKey(event,7)">
														<div id="lv_popup" lang="lv_popup1"> </div>
													</li>
												</ul>
												</td>
											</tr>
										</table>
								</td> 
								<td  height="20px"><input  autocomplete="off" style="width:120px;text-align:center;" name="txtlv004" type="text" id="txtlv004" value="<?php echo $momn_lv0221->lv004;?>" tabindex="9" maxlength="50" style="width:100%" onKeyPress="return CheckKey(event,7)" onClick="if(self.gfPop)gfPop.fPopCalendar(this);return false;" autocomplete="off" ></td> 
								<td><table width="100%"><tr><td>
									<select name="txtlv010" id="txtlv010"   tabindex="14"  style="width:100px" onKeyPress="return CheckKeys(event,7,this)">
										<option value=''>...</option>
										<?php echo $momn_lv0221->LV_LinkField('lv010',$momn_lv0221->lv010);?>
									</select>
								</td>
								<td>
								<ul id="pop-nav22" lang="pop-nav22" onMouseOver="ChangeName(this,22)" onkeyup="ChangeName(this,22)"> <li class="menupopT">
									<input type="text" autocomplete="off" class="search_img_btn" name="txtlv010_search" id="txtlv010_search" style="width:60px" onKeyUp="LoadPopupParent(this,'txtlv010','hr_lv0020','concat(lv002,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv010','hr_lv0020','concat(lv002,@! @!,lv001)')" tabindex="200" >
									<div id="lv_popup22" lang="lv_popup22"> </div>						  
									</li>
									</ul></td></tr></table>
								</td>							
								<td>
									<table width="95%">
											<tr>
											<td>
												<ul id="pop-nav32" lang="pop-nav32" onMouseOver="ChangeName(this,32)">
													<li class="menupopT">
													<input  autocomplete="off" onkeyup="LoadSelfNextParentNewSreen(this,'txtlv090','cr_lv0113','lv001','lv001,lv002,lv003,lv004,lv005','','',1)" onfocus="LoadSelfNextParentNewSreen(this,'txtlv090','cr_lv0113','lv001','lv001,lv002,lv003,lv004,lv005','','',1)" name="txtlv090" type="textbox" id="txtlv090" value="<?php echo $_POST['txtlv090'];?>" style="width:120px" tabindex="8" maxlength="50" onKeyPress="return CheckKey(event,7)">
														<div id="lv_popup32" lang="lv_popup32"> </div>
													</li>
												</ul>
												</td>
											</tr>
										</table>
								</td> 
								
								<td>
									<table width="95%">
											<tr>
											<td>
												<ul id="pop-nav34" lang="pop-nav34" onMouseOver="ChangeName(this,34)">
													<li class="menupopT">
													<input  autocomplete="off" onkeyup="LoadSelfNextParentNewSreen(this,'txtlv088','cr_lv0150','lv001','lv001,lv002,lv003,lv004,lv005','','',1);" onfocus="LoadSelfNextParentNewSreen(this,'txtlv088','cr_lv0150','lv001','lv001,lv002,lv003,lv004,lv005','','',1);" name="txtlv088" type="textbox" id="txtlv088" value="<?php echo $_POST['txtlv088'];?>" style="width:120px" tabindex="8" maxlength="50" onKeyPress="return CheckKey(event,7)">
														<div id="lv_popup34" lang="lv_popup34"> </div>
													</li>
												</ul>
												</td>
											</tr>
										</table>
								</td> 		
								
								</tr>	
							</table>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					  	<input name="txtisSmall" type="hidden" id="txtisSmall" value="display:block;position:fixed;width:900px;height:300px;border-radius: 3px;background:#a3a3a3;padding:5px;color:#fff;text-align: center;z-index: 99999999;overflow:scroll;" />
						<input name="txtisLarge" type="hidden" id="txtisLarge" value="display:block;position:fixed;width:100%;min-height:600px;height:100%;top:0px;left:0px;border-radius: 3px;background:#a3a3a3;padding:5px;color:#fff;text-align: center;z-index: 99999999;overflow:scroll;" />

						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $momn_lv0221->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $momn_lv0221->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $momn_lv0221->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $momn_lv0221->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $momn_lv0221->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $momn_lv0221->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $momn_lv0221->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $momn_lv0221->lv009;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $momn_lv0221->lv011;?>"/>
					
						<?php echo $momn_lv0221->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  <script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>				  
</div></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>

<script language="javascript">
function  showDetailHistory(id,hopdongid)
{
	
	var o=document.getElementById(id);	
	o.style.display="block";
	$xmlhttp112=null;
	if(hopdongid=="") 
	{
	//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
	return false;
	}
	xmlhttp112=GetXmlHttpObject();
	if (xmlhttp112==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajaxchitiethistory=ajaxcheck"+"&hopdongid="+hopdongid;
	url=url.replace("#","");
	xmlhttp112.onreadystatechange=stateshowDetailHistory;
	xmlhttp112.open("GET",url,true);
	xmlhttp112.send(null);
}
function stateshowDetailHistory()
{
	fcus=false;
	if (xmlhttp112.readyState==4)
	{
		//ID
		var startdomain=xmlhttp112.responseText.indexOf('[HDCHECKID]')+11;
		var enddomain=xmlhttp112.responseText.indexOf('[HDCHECKIDEND]');
		var memberid=xmlhttp112.responseText.substr(startdomain,enddomain-startdomain);
		//Họ tên
		var startdomain=xmlhttp112.responseText.indexOf('[HDCHECKINFO]')+13;
		var enddomain=xmlhttp112.responseText.indexOf('[HDCHECKINFOEND]');
		var noidung=xmlhttp112.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('chitietlichsu_'+memberid).innerHTML=noidung;
		
	}
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
div.innerHTML='<?php echo $momn_lv0221->ArrPush[0];?>';	
</script>
</html>