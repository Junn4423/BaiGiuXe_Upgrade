<?php

$vDir = ''; 
//if($_GET['ChildDetailID']!="") $vDir='../';

if (isset($_GET['ChildDetailID']) && $_GET['ChildDetailID'] != "") {
    $vDir = '../';
}
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/cr_lv0413.php");
require_once("$vDir../clsall/wh_lv0020.php");
/////////////init object//////////////
$mocr_lv0413=new cr_lv0413($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0413');
$mowh_lv0020=new wh_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0020');
$mocr_lv0413->Dir=$vDir;
$mocr_lv0413->objlot=$mowh_lv0020;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($mocr_lv0413->GetEdit()==1)
{
	if(isset($_GET['ajaxbangtext']))
		{
			$vdonhangid=$_GET['donhangid'];
			$vText=$_GET['textup'];
			$voption=$_GET['optrun'];
			if($vdonhangid!='' && $vdonhangid!=NULL)
			{
				$vUserID=$mocr_lv0166->LV_UserID;
				$vlvField='lv'.Fillnum($voption,3);
				switch($voption)
				{
					case 14:
					case 101:
					case 102:
					case 103:
					case 104:
					case 105:
					case 106:
					case 110:
					case 111:
					case 112:
					case 113:
					case 114:
					case 119:
					case 123:
					case 124:
					case 125:
					case 126:
					case 127:
					case 128:									
						$vText=str_replace("|||",'\n',$vText);						
						$vsql="update cr_lv0109 set $vlvField='$vText' where lv001='$vdonhangid'";
						$mocr_lv0413->LV_UpdateChangeChild($vsql);
						break;
					case 117:		
						$vText=str_replace(",",'',$vText);
						$vsql="update cr_lv0109 set $vlvField='$vText' where lv001='$vdonhangid'";
						$mocr_lv0413->LV_UpdateChangeChild($vsql);
						break;
					case 115:
					case 116:
					case 118:	
					case 120:
						$vText = (trim($vText)!="")?recoverdate(($vText), $plang):' ';					
						$vsql="update cr_lv0109 set $vlvField='$vText' where lv001='$vdonhangid'";
						$mocr_lv0413->LV_UpdateChangeChild($vsql);
						if($voption==115)
						{
							$mocr_lv0413->LV_Update_BaoHanh($vdonhangid);
						}
						break;
					case 107:
					case 108:
						$vText=str_replace(",",'',$vText);
						$vsql="update cr_lv0109 set $vlvField='$vText' where lv001='$vdonhangid'";
						$mocr_lv0413->LV_UpdateChangeChild($vsql);
						break;
				}
				
			}
			exit;
	}
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","CR0066.txt",$plang);
$mocr_lv0413->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0413->ArrPush[0]=$vLangArr[17];
$mocr_lv0413->ArrPush[1]=$vLangArr[18];
$mocr_lv0413->ArrPush[2]=$vLangArr[19];
$mocr_lv0413->ArrPush[3]=$vLangArr[20];
$mocr_lv0413->ArrPush[4]=$vLangArr[21];
$mocr_lv0413->ArrPush[5]=$vLangArr[22];
$mocr_lv0413->ArrPush[6]=$vLangArr[23];
$mocr_lv0413->ArrPush[7]=$vLangArr[24];
$mocr_lv0413->ArrPush[8]=$vLangArr[25];
$mocr_lv0413->ArrPush[9]=$vLangArr[26];
$mocr_lv0413->ArrPush[10]=$vLangArr[27];
$mocr_lv0413->ArrPush[11]=$vLangArr[28];
$mocr_lv0413->ArrPush[12]=$vLangArr[29];
$mocr_lv0413->ArrPush[13]=$vLangArr[30];
$mocr_lv0413->ArrPush[14]=$vLangArr[31];
$mocr_lv0413->ArrPush[15]=$vLangArr[32];
$mocr_lv0413->ArrPush[16]=$vLangArr[33];
$mocr_lv0413->ArrPush[17]=$vLangArr[34];
$mocr_lv0413->ArrPush[18]=$vLangArr[42];
$mocr_lv0413->ArrPush[26]='Ghi chú 2';
$mocr_lv0413->ArrPush[850]='Brand';
$mocr_lv0413->ArrPush[851]='Xuất xứ';

$mocr_lv0413->ArrPush[809]='Model';
$mocr_lv0413->ArrPush[810]='Order No.';
$mocr_lv0413->ArrPush[931]='Tên sản phẩm';

$mocr_lv0413->ArrPush[89]=$vLangArr[49];
$mocr_lv0413->ArrPush[98]=$vLangArr[43];
$mocr_lv0413->ArrPush[99]=$vLangArr[44];
$mocr_lv0413->ArrPush[100]='PO#/ContractID';

$mocr_lv0413->ArrPush[201]='Tên NCC';
$mocr_lv0413->ArrPush[203]='Nguồn xuất kho';
$mocr_lv0413->ArrPush[204]='Mã tham chiếu';
$mocr_lv0413->ArrPush[205]='Tên KH';
$mocr_lv0413->ArrPush[210]='Ngày nhập kho';
$mocr_lv0413->ArrPush[199]='Mã số mua hàng';
$mocr_lv0413->ArrPush[189]='Mô tả';

$mocr_lv0413->ArrPush[102]='CO';
$mocr_lv0413->ArrPush[103]='CQ';
$mocr_lv0413->ArrPush[104]='BL';
$mocr_lv0413->ArrPush[105]='PL';
$mocr_lv0413->ArrPush[106]='Invoice';
$mocr_lv0413->ArrPush[107]='Số chứng nhận PCCC';
$mocr_lv0413->ArrPush[108]='Số series PCCC từ';
$mocr_lv0413->ArrPush[109]='Số series PCCC đến';
$mocr_lv0413->ArrPush[110]='Khoá chỉnh lô';
$mocr_lv0413->ArrPush[111]='Hợp Quy';

$mocr_lv0413->ArrPush[112]='Số tờ khai';
$mocr_lv0413->ArrPush[113]='Số Invoice';
$mocr_lv0413->ArrPush[114]='Tem năng lượng';
$mocr_lv0413->ArrPush[115]='Tiêu chuẩn quốc tế';
$mocr_lv0413->ArrPush[116]='Ngày tính bảo hành';
$mocr_lv0413->ArrPush[117]='Ngày đăng ký PCCC';
$mocr_lv0413->ArrPush[118]='Thời hạn dự kiến có tem';
$mocr_lv0413->ArrPush[119]='Ngày nhận tem PCCC';

$mocr_lv0413->ArrPush[120]='AWB/NCC';
$mocr_lv0413->ArrPush[121]='Ngày về';
$mocr_lv0413->ArrPush[122]='SL nhập kho 1';
$mocr_lv0413->ArrPush[123]='SL nhập kho chờ xuất';
$mocr_lv0413->ArrPush[124]='KV cất hàng theo SL PBH';
$mocr_lv0413->ArrPush[125]='KV cất hàng dư';
$mocr_lv0413->ArrPush[126]='Test QC đầu vào';
$mocr_lv0413->ArrPush[127]='Đề nghị chỉnh sửa';
$mocr_lv0413->ArrPush[128]='TK Làm Lại Sticker';
$mocr_lv0413->ArrPush[129]='QC chuyển kho';
$mocr_lv0413->ArrPush[130]='Hình ảnh đầu vào';
$mocr_lv0413->ArrPush[131]='SL bàn giao đầu ra';
$mocr_lv0413->ArrPush[132]='SL thùng/Pallet';
$mocr_lv0413->ArrPush[702]='Tài liệu chứng từ';
$mocr_lv0413->ArrPush[703]='Tài liệu kho';
$mocr_lv0413->ArrPush[704]='Tài liệu kế toán';

$mocr_lv0413->ArrFunc[0]='//Function';
$mocr_lv0413->ArrFunc[1]=$vLangArr[2];
$mocr_lv0413->ArrFunc[2]=$vLangArr[4];
$mocr_lv0413->ArrFunc[3]=$vLangArr[6];
$mocr_lv0413->ArrFunc[4]=$vLangArr[7];
$mocr_lv0413->ArrFunc[5]='';
$mocr_lv0413->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mocr_lv0413->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mocr_lv0413->ArrFunc[8]=$vLangArr[10];
$mocr_lv0413->ArrFunc[9]=$vLangArr[12];
$mocr_lv0413->ArrFunc[10]=$vLangArr[0];
$mocr_lv0413->ArrFunc[11]=$vLangArr[37];
$mocr_lv0413->ArrFunc[12]=$vLangArr[38];
$mocr_lv0413->ArrFunc[13]=$vLangArr[39];
$mocr_lv0413->ArrFunc[14]=$vLangArr[40];
$mocr_lv0413->ArrFunc[15]=$vLangArr[41];

////Other
$mocr_lv0413->ArrOther[1]=$vLangArr[35];
$mocr_lv0413->ArrOther[2]=$vLangArr[36];
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
if(!isset($_POST['txtlv109']))
{
	$_POST['txtlv109']='0';
	$mocr_lv0413->lv109=$_POST['txtlv109'];
}
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mocr_lv0413->LV_DeleteDetail($strar);
	$vStrMessage=GetNoDelete($strar,"cr_lv0413",$lvMessage);
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mocr_lv0413->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mocr_lv0413->LV_UnAproval($strar);
}
if($flagID>0)
{
	$mocr_lv0413->lv001=$_POST['txtlv001'];
	$mocr_lv0413->lv002=$_POST['txtlv002'];
	$mocr_lv0413->lv003=$_POST['txtlv003'];
	$mocr_lv0413->lv004=$_POST['txtlv004'];
	$mocr_lv0413->lv005=$_POST['txtlv005'];
	$mocr_lv0413->lv006=$_POST['txtlv006'];
	$mocr_lv0413->lv007=$_POST['txtlv007'];
	$mocr_lv0413->lv008=$_POST['txtlv008'];
	$mocr_lv0413->lv009=$_POST['txtlv009'];
	$mocr_lv0413->lv010=$_POST['txtlv010'];
	$mocr_lv0413->lv011=$_POST['txtlv011'];
	$mocr_lv0413->lv014=$_POST['txtlv014'];
	$mocr_lv0413->lv015=$_POST['txtlv015'];
	$mocr_lv0413->lv016=$_POST['txtlv016'];
	$mocr_lv0413->lv806=$_POST['txtlv806'];
	$mocr_lv0413->lv901=$_POST['txtlv901'];
	$mocr_lv0413->lv906=$_POST['txtlv906'];
	$mocr_lv0413->lv909=$_POST['txtlv909'];
	$mocr_lv0413->lv911=$_POST['txtlv911'];
	$mocr_lv0413->lv109=$_POST['txtlv109'];
	$mocr_lv0413->lv808=$_POST['txtlv808'];
	$mocr_lv0413->lv809=$_POST['txtlv809'];
	$mocr_lv0413->lv849=$_POST['txtlv849'];
	$mocr_lv0413->lv850=$_POST['txtlv850'];
	$mocr_lv0413->lv930=$_POST['txtlv930'];
	$mocr_lv0413->isShowCT=$_POST['isShowCT'];

}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0413->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0413');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mocr_lv0413->ListView;
$curPage = $mocr_lv0413->CurPage;
$maxRows =$mocr_lv0413->MaxRows;
$vOrderList=$mocr_lv0413->ListOrder;
$vSortNum=$mocr_lv0413->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
//$vFieldList=str_replace("lv013,","",$vFieldList);
$mocr_lv0413->SaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0413',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mocr_lv0413->lv002=$_GET['ChildDetailID'] ?? '';
if($maxRows ==0) $maxRows = 10;
$mocr_lv0413->trangthai=$_GET['trangthai'] ?? 0;
$totalRowsC=$mocr_lv0413->GetCount();
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
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engines.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv809=<?php echo $_POST['txtlv809'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv016=<?php echo $_POST['txtlv016'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc=<?php echo $_GET['childdetailfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&trangthai=<?php echo $_GET['trangthai']?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID=<?php echo $_GET['ChildDetailID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc=<?php echo $_GET['childdetailfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&trangthai=<?php echo $_GET['trangthai']?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID=<?php echo $_GET['ChildDetailID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc=<?php echo $_GET['childdetailfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&trangthai=<?php echo $_GET['trangthai']?>&trangthai=<?php echo $_GET['trangthai']?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID=<?php echo $_GET['ChildDetailID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	o.submit();
}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>cr_lv0413?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc=<?php echo $_GET['childdetailfunc'];?>&childdetailfuncv1="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID=<?php echo $_GET['ChildDetailID'];?>&ChildDetailIDV1="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Save()
{
	ChangeInfor();
}
function ChangeInfor()
{
	var o1=document.frmchoose;
 	o1.submit();
}
//-->
</script>
<?php
if($mocr_lv0413->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div>
  <div id="lvleft">
    <form onsubmit="return false;"
          action="?func=<?php echo htmlspecialchars($_GET['func'] ?? '', ENT_QUOTES); ?>
                  &childfunc=<?php echo htmlspecialchars($_GET['childfunc'] ?? '', ENT_QUOTES); ?>
                  &childdetailfunc=<?php echo htmlspecialchars($_GET['childdetailfunc'] ?? '', ENT_QUOTES); ?>
                  &ChildID=<?php echo htmlspecialchars($_GET['ChildID'] ?? '', ENT_QUOTES); ?>
                  &ChildDetailID=<?php echo htmlspecialchars($_GET['ChildDetailID'] ?? '', ENT_QUOTES); ?>
                  &ID=<?php echo htmlspecialchars( $_GET['ID'] ?? '', ENT_QUOTES); ?>
                  &trangthai=<?php echo htmlspecialchars($_GET['trangthai'] ?? '', ENT_QUOTES); ?>
                  &<?php echo getsaveget($plang, $popt, $pitem, $plink, $pgroup, 0, 0, 1, 0); ?>"
          method="post"
          name="frmchoose"
          id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mocr_lv0413->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mocr_lv0413->lv002;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mocr_lv0413->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mocr_lv0413->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mocr_lv0413->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mocr_lv0413->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mocr_lv0413->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mocr_lv0413->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mocr_lv0413->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mocr_lv0413->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mocr_lv0413->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mocr_lv0413->lv013;?>"/>
                        <input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mocr_lv0413->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mocr_lv0413->lv016;?>"/>
						<table style="background:#F2F2F2;padding:5px;color:#4D4D4F!important;" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td nowrap><input  style="width:160px;text-align:center" type="button" value="Tìm kiếm" onclick="ChangeInfor()"/></td>
								
								<td align="center" style="background:#eaeaea;"><?php echo 'Lô';?></td>
								<td align="center"><?php echo 'Sản phẩm';?></td>
								<td align="center"><?php echo 'Model';?></td>
								<td align="center"><?php echo 'Order No.';?></td>
								<td align="center"><?php echo 'Xuất xứ';?></td>
								<td align="center"><?php echo 'Brand';?></td>
								<td align="center"><?php echo 'Tên sản phẩm';?></td>
								<td align="center"><?php echo 'Mã phiếu nhập hàng';?> </td>
								<td align="center"><?php echo 'Ngày nhập hàng<br/>(yyyy-mm-dd)';?> </td>
								<td align="center"><?php echo 'Mã nhà cung cấp';?> </td>
								<td align="center"><?php echo 'Mã phiếu mua hàng';?></td>
						
								
							</tr>
							<tr>	
								<td nowrap>Thấy chứng từ Kho/KT
								<input type="checkbox" name="isShowCT" id="isShowCT" 
								value="1" <?php echo (isset($_POST['isShowCT']) && $_POST['isShowCT'] == 1) ? 'checked="true"' : ''; ?> 
								onclick="document.frmchoose.submit();"/>
								<td> <table width="95%">
									<tr>
									<td><input type="text" style="width:100px"  tabindex="1" name="txtlv014" id="txtlv014" value="<?php echo $mocr_lv0413->lv014;?>" onKeyPress="return CheckKey(event,7)"/></td>
							 	 	 <td>
									   <ul id="pop-nav14" lang="pop-nav14" onmouseover="ChangeName(this,14)" onkeyup="ChangeName(this,14)"> <li class="menupopT">
															<input type="text" autocomplete="off" class="search_img_btn" name="txtlv014_search" id="txtlv014_search" style="width:30px;" 
															onkeyup="LoadSelfNextParentNewSreen(this,'txtlv014','cr_lv0109','lv014','lv014,lv101,lv102,lv103,lv104,lv105,lv110,lv106,lv107,lv108,lv109','','',1)" 
															onfocus="if(this.value==''){this.value=document.frmchoose.txtlv014.value};this.style.width='200px';LoadSelfNextParentNewSreen(this,'txtlv014','cr_lv0109','lv014','lv014,lv101,lv102,lv103,lv104,lv105,lv110,lv106,lv107,lv108,lv109','','',1);" onfocusout="this.style.width='30px';" tabindex="200">
															<div id="lv_popup14" lang="lv_popup14"> </div>						  
															</li>
														</ul>
									</td></tr></table>
								</td>
								<td> <table width="95%">
									<tr>
									<td>
										<ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)">
											<li class="menupopT">
											<input  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv003','sl_lv0007','lv001','concat(lv001,@! @!,lv002)')" 
											name="txtlv003" type="textbox" id="txtlv003" 
											
											value="<?php echo htmlspecialchars($_POST['txtlv003'] ?? ''); ?>" 

											style="width:100%" tabindex="8" maxlength="50" onKeyPress="return CheckKey(event,7)">
												<div id="lv_popup3" lang="lv_popup3"> </div>
											</li>
										</ul>
										</td>
									</tr>
								</table></td>

								<td> <input type="text" style="width:100px"  tabindex="1" name="txtlv808" id="txtlv808" value="<?php echo $mocr_lv0413->lv808;?>" onKeyPress="return CheckKey(event,7)"/></td>
								<td> <input type="text" style="width:100px"  tabindex="1" name="txtlv809" id="txtlv809" value="<?php echo $mocr_lv0413->lv809;?>" onKeyPress="return CheckKey(event,7)"/></td>
								<td> <input type="text" style="width:100px"  tabindex="1" name="txtlv849" id="txtlv849" value="<?php echo $mocr_lv0413->lv849;?>" onKeyPress="return CheckKey(event,7)"/></td>
								<td> <input type="text" style="width:100px"  tabindex="1" name="txtlv850" id="txtlv850" value="<?php echo $mocr_lv0413->lv850;?>" onKeyPress="return CheckKey(event,7)"/></td>
								<td> <input type="text" style="width:100px"  tabindex="1" name="txtlv930" id="txtlv930" value="<?php echo $mocr_lv0413->lv930;?>" onKeyPress="return CheckKey(event,7)"/></td>

								<td> <input type="text" style="width:100px"  tabindex="1" name="txtlv901" id="txtlv901" value="<?php echo $mocr_lv0413->lv901;?>" onKeyPress="return CheckKey(event,7)"/></td>
								<td> <input type="text" style="width:100px"  tabindex="1" name="txtlv909" id="txtlv909" value="<?php echo $mocr_lv0413->lv909;?>" onKeyPress="return CheckKey(event,7)"/></td>
								<td>
									<table width="95%">
											<tr>
											<td>
												<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)">
													<li class="menupopT">
													<input  autocomplete="off"
													onkeyup="LoadSelfNextParent(this,'txtlv806','wh_lv0003','lv001','concat(lv006,@! @!,lv010,@! @!,lv002,@! - @!,lv001)')" 
													name="txtlv806" type="textbox" id="txtlv806" 
													value="<?php echo htmlspecialchars($_POST['txtlv806'] ?? ''); ?>" 
													style="width:100%" tabindex="1" maxlength="50" onKeyPress="return CheckKey(event,7)">
														<div id="lv_popup" lang="lv_popup1"> </div>
													</li>
												</ul>
												</td>
											</tr>
										</table>
								</td>
								<td> <table width="95%">
										<tr>
										<td>
											<ul id="pop-nav33" lang="pop-nav33" onMouseOver="ChangeName(this,33)">
												<li class="menupopT">
												<input  autocomplete="off" 
												onkeyup="LoadSelfNextParent(this,'txtlv906','ac_lv0002','lv001','concat(lv001,@! @!,lv002)')" 
												name="txtlv906" type="textbox" id="txtlv906" 
												value="<?php echo htmlspecialchars($_POST['txtlv906'] ?? ''); ?>" 

												style="width:100%" tabindex="8" maxlength="50" onKeyPress="return CheckKey(event,7)">
													<div id="lv_popup33" lang="lv_popup33"> </div>
												</li>
											</ul>
											</td>
										</tr>
									</table></td>
								
								
					</tr></table>
					<?php echo $mocr_lv0413->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
				  </form>
				  <iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>				  
</div></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
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
				case 5:
				case 11:
					value=replaces("\n","|||",value);
					break;
			}
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
div.innerHTML='<?php echo $mocr_lv0413->ArrPush[0];?>';	
</script>
</html>