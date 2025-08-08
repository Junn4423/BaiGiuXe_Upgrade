<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/da_lh0004.php");

/////////////init object//////////////
$moda_lh0004=new da_lh0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Da0004');
$moda_lh0004->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($moda_lh0004->GetEdit()==1)
{
	if(isset($_GET['ajaxbangtext']))
	{
		$vdonhangid=$_GET['donhangid'];
		$vText=$_GET['textup'];
		$vText=str_replace('$$$','+',$vText);
		$voption=$_GET['optrun'];
		if($vdonhangid!='' && $vdonhangid!=NULL)
		{
			$vUserID=$moda_lh0004->LV_UserID;
			$vlvField='lv'.Fillnum($voption,3);
			switch($voption)
			{
				case 3:
				case 5:			
					$vsql="update da_lh0004 set $vlvField='$vText' where lv001='$vdonhangid'";
					break;
			}
			$vresult=db_query($vsql);

		}
		exit;
	}
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","CR0010.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moda_lh0004->ArrPush[0]=$vLangArr[17];
$moda_lh0004->ArrPush[1]=$vLangArr[18];
$moda_lh0004->ArrPush[2]="Mã giai đoạn";
$moda_lh0004->ArrPush[3]="Giai đoạn";
$moda_lh0004->ArrPush[4]=$vLangArr[22];
$moda_lh0004->ArrPush[5]=$vLangArr[23];
$moda_lh0004->ArrPush[6]=$vLangArr[24];
$moda_lh0004->ArrPush[7]=$vLangArr[25];

$moda_lh0004->ArrFunc[0]='//Function';
$moda_lh0004->ArrFunc[1]=$vLangArr[2];
$moda_lh0004->ArrFunc[2]=$vLangArr[4];
$moda_lh0004->ArrFunc[3]=$vLangArr[6];
$moda_lh0004->ArrFunc[4]=$vLangArr[7];
$moda_lh0004->ArrFunc[5]='';
$moda_lh0004->ArrFunc[6]='';
$moda_lh0004->ArrFunc[7]='';
$moda_lh0004->ArrFunc[8]=$vLangArr[10];
$moda_lh0004->ArrFunc[9]=$vLangArr[12];
$moda_lh0004->ArrFunc[10]=$vLangArr[0];
$moda_lh0004->ArrFunc[11]=$vLangArr[28];
$moda_lh0004->ArrFunc[12]=$vLangArr[29];
$moda_lh0004->ArrFunc[13]=$vLangArr[30];
$moda_lh0004->ArrFunc[14]=$vLangArr[31];
$moda_lh0004->ArrFunc[15]=$vLangArr[32];
////Other
$moda_lh0004->ArrOther[1]=$vLangArr[26];
$moda_lh0004->ArrOther[2]=$vLangArr[27];
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
	$vresult=$moda_lh0004->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"da_lh0004",$lvMessage);
}
if($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moda_lh0004->LV_Delete($strar);
}
elseif($flagID==6)
{
	$moda_lh0004->lv001=$_POST['qxtlv001'];
	$moda_lh0004->lv002=$_POST['qxtlv002'];
	$moda_lh0004->lv003=$_POST['qxtlv003'];
	$moda_lh0004->lv004=$_POST['qxtlv004'];
	$vresult=$moda_lh0004->LV_Insert();	
	if(!$vresult)
	{
		$moda_lh0004->Values['lv001']=$_POST['qxtlv001'];
		$moda_lh0004->Values['lv002']=$_POST['qxtlv002'];
		$moda_lh0004->Values['lv003']=$_POST['qxtlv003'];
		$moda_lh0004->Values['lv004']=$_POST['qxtlv004'];
		echo sof_error();	
	}
	$moda_lh0004->lv001='';
	$moda_lh0004->lv002='';
	$moda_lh0004->lv003='';
	$moda_lh0004->lv004='';
}
elseif($flagID==18)
{
	$vresult=$moda_lh0004->LV_GetDataAuto();
}
if($flagID>0)
{
	$moda_lh0004->lv001=$_POST['txtlv001'];
	$moda_lh0004->lv002=$_POST['txtlv002'];
	$moda_lh0004->lv003=$_POST['txtlv003'];
	$moda_lh0004->lv004=$_POST['txtlv004'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moda_lh0004->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'da_lh0004');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moda_lh0004->ListView;
$curPage = $moda_lh0004->CurPage;
$maxRows =$moda_lh0004->MaxRows;
$vOrderList=$moda_lh0004->ListOrder;
$vSortNum=$moda_lh0004->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moda_lh0004->SaveOperation($_SESSION['ERPSOFV2RUserID'],'da_lh0004',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moda_lh0004->GetCount();
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
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engines.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
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
	var str="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>da_lh0004?&func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>' class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
	function nhapkho()
	{
		window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=d2hfbHYwMTAyL3doX2x2MDEwMi5waHA=','_self');
	}
	function  kiemkho()
	{
		window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=d2hfbHYwMTAzL3doX2x2MDEwMy5waHA=','_self');
	}
	function sanpham()
	{
		window.open('?lang=<?php echo $plang;?>&opt=19&item=&link=c2xfbHYwMDA3L3NsX2x2MDAwNy5waHA=','_self');
	}
	function donvitinh()
	{
		window.open('?lang=<?php echo $plang;?>&opt=19&item=&link=c2xfbHYwMDA1L3NsX2x2MDAwNS5waHA=','_self');
	}
	function CombackHome()
	{
		window.open('?lang=<?php echo $plang;?>','_self')
	}
	function Save()
	{
		var o=document.frmchoose;
		o.txtFlag.value=6;
		if(o.qxtlv001.value==""){
			alert("Mã không rỗng");
			o.qxtlv001.focus();
		}	
		else if(o.qxtlv002.value==""){
			alert("Xin vui lòng nhập tên");
			o.qxtlv002.focus();
		}	
		else
		{
			o.submit();
		}
	}
	setTimeout(focusmain,1000);
function focusmain()
{
	document.getElementById('qxtlv001').focus();
}
function GetAutoPR()
{
	var o=document.frmchoose;
	if(confirm("Do you want to update the old version?(Y/N)"))
	{
		var o=document.frmchoose;
		o.txtFlag.value=18;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
		o.submit();
	}
}
function ChangeInfor()
{
	var o1=document.frmchoose;
 	o1.submit();
}
//-->
</script>
<?php
if($moda_lh0004->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">
	<div><div id="lvleft">
		<form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?><?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" method="post" name="frmchoose" id="frmchoose">
			<table style="background:#F2F2F2;padding:5px;color:#4D4D4F!important;" border="0" cellpadding="3" cellspacing="3">
				<tr>
						<td><!--<input style="width:80px;text-align:center" type="button" value="Load data" onclick="GetAutoPR()"/>--></td>
						<td align="center"><?php echo "Mã giai đoạn";?> </td>
						<td align="center"><?php echo "Giai đoạn";?></td>
						<td align="center"><?php echo $vLangArr[22];?></td>
						<td align="center"><?php echo $vLangArr[23];?></td>
					</tr>
					<tr>
						<td><input  style="width:80px;text-align:center" type="button" value="Tìm kiếm" onclick="ChangeInfor()"/></td>
						<td>
							<table width="95%">
								<tr>
									<td>
										<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)">
										<li class="menupopT">
											<input type="textbox" tabindex="1" name="txtlv001" id="txtlv001" value="<?php echo $moda_lh0004->lv001;?>" style="min-width:100px;width:100%;text-align:center;"  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv001','da_lh0004','lv001','concat(lv002,@! - @!,lv001)')"/>
											<div id="lv_popup" lang="lv_popup1"> </div>
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
										<ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)">
										<li class="menupopT">
											<input type="textbox" tabindex="1" name="txtlv002" id="txtlv002" value="<?php echo $moda_lh0004->lv002;?>" style="min-width:100px;width:100%;text-align:center;"  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv002','da_lh0004','lv002','concat(lv002,@! - @!,lv001)')"/>
											<div id="lv_popup2" lang="lv_popup2"> </div>
											</li>
										</ul>
									</td>
								</tr>
								</table>
						</td>
						<td>
							<input type="textbox" name="txtlv003" id="txtlv003"  style="min-width:100px;width:100%;text-align:center;" value="<?php echo $moda_lh0004->lv003;?>"/>	
						</td>
						<td>
							<table width="95%">
								<tr>
									<td>
										<ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)">
										<li class="menupopT">
											<input type="textbox" tabindex="1" name="txtlv004" id="txtlv004" value="<?php echo $moda_lh0004->lv004;?>" style="min-width:100px;width:100%;text-align:center;"  autocomplete="off" onkeyup="LoadSelfNextParent(this,'txtlv004','da_lh0004','lv004','concat(lv004,@! - @!,lv001)')"/>
											<div id="lv_popup4" lang="lv_popup4"> </div>
											</li>
										</ul>
									</td>
								</tr>
							</table>
						</td>	
				</tr>
			</table> 	
			<input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
			<input name="txtStringID" type="hidden" id="txtStringID" />
			<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
			<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
			<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>	
			<input type="hidden" name="txtlv005" id="txtlv005"  value="<?php echo $moda_lh0004->lv005;?>"/>		
			<input type="hidden" name="txtlv006" id="txtlv006"  value="<?php echo $moda_lh0004->lv006;?>"/>		
			<?php echo $moda_lh0004->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>	    
		</form>  
	</div></div>
</body>
				
<?php
} else {
	include("../da_lh0004/permit.php");
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
div.innerHTML='<?php echo $moda_lh0004->ArrPush[0];?>';	
</script>
</html>