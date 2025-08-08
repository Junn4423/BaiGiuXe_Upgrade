<?php
$vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/tc_lv0097.php");
require_once("$vDir../clsall/tc_lv0013.php");
require_once("$vDir../clsall/hr_lv0020.php");

/////////////init object//////////////
$motc_lv0097=new tc_lv0097($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0097');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$motc_lv0097->Dir=$vDir;
$motc_lv0097->motc_lv0013=$motc_lv0013;
$motc_lv0097->mohr_lv0020=$mohr_lv0020;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TC0126.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0097->ArrPush[0]=$vLangArr[17];
$motc_lv0097->ArrPush[1]=$vLangArr[18];
$motc_lv0097->ArrPush[2]=$vLangArr[19];
$motc_lv0097->ArrPush[3]=$vLangArr[20];
$motc_lv0097->ArrPush[4]=$vLangArr[21];
$motc_lv0097->ArrPush[5]=$vLangArr[22];
$motc_lv0097->ArrPush[6]=$vLangArr[23];
$motc_lv0097->ArrPush[7]=$vLangArr[24];
$motc_lv0097->ArrPush[8]=$vLangArr[25];
$motc_lv0097->ArrPush[9]=$vLangArr[26];
$motc_lv0097->ArrPush[10]=$vLangArr[27];
$motc_lv0097->ArrPush[11]=$vLangArr[28];
$motc_lv0097->ArrPush[12]=$vLangArr[29];
$motc_lv0097->ArrPush[13]=$vLangArr[30];
$motc_lv0097->ArrPush[14]=$vLangArr[31];
$motc_lv0097->ArrPush[15]=$vLangArr[32];
$motc_lv0097->ArrPush[16]=$vLangArr[33];
$motc_lv0097->ArrPush[17]=$vLangArr[34];
$motc_lv0097->ArrPush[18]=$vLangArr[35];
$motc_lv0097->ArrPush[19]=$vLangArr[36];
$motc_lv0097->ArrPush[20]=$vLangArr[37];
$motc_lv0097->ArrPush[21]=$vLangArr[38];
$motc_lv0097->ArrPush[22]=$vLangArr[39];
$motc_lv0097->ArrPush[23]=$vLangArr[40];
$motc_lv0097->ArrPush[24]=$vLangArr[41];
$motc_lv0097->ArrPush[25]=$vLangArr[42];
$motc_lv0097->ArrPush[26]=$vLangArr[43];
$motc_lv0097->ArrPush[27]='BQ Công';
$motc_lv0097->ArrPush[28]='Thưởng tết';
$motc_lv0097->ArrPush[54]="T1-CÔNG";
$motc_lv0097->ArrPush[55]="T1-BQ";
$motc_lv0097->ArrPush[58]="T2-CÔNG";
$motc_lv0097->ArrPush[59]="T2-BQ";
$motc_lv0097->ArrPush[62]="T3-CÔNG";
$motc_lv0097->ArrPush[63]="T3-BQ";
$motc_lv0097->ArrPush[66]="T4-CÔNG";
$motc_lv0097->ArrPush[67]="T4-BQ";
$motc_lv0097->ArrPush[70]="T5-CÔNG";
$motc_lv0097->ArrPush[71]="T5-BQ";
$motc_lv0097->ArrPush[74]="T6-CÔNG";
$motc_lv0097->ArrPush[75]="T6-BQ";
$motc_lv0097->ArrPush[78]="T7-CÔNG";
$motc_lv0097->ArrPush[79]="T7-BQ";
$motc_lv0097->ArrPush[82]="T8-CÔNG";
$motc_lv0097->ArrPush[83]="T8-BQ";
$motc_lv0097->ArrPush[86]="T9-CÔNG";
$motc_lv0097->ArrPush[87]="T9-BQ";
$motc_lv0097->ArrPush[90]="T10-CÔNG";
$motc_lv0097->ArrPush[91]="T10-BQ";
$motc_lv0097->ArrPush[94]="T11-CÔNG";
$motc_lv0097->ArrPush[95]="T11-BQ";
$motc_lv0097->ArrPush[98]="T12-CÔNG";
$motc_lv0097->ArrPush[99]="T12-BQ";


$motc_lv0097->ArrFunc[0]='//Function';
$motc_lv0097->ArrFunc[1]=$vLangArr[2];
$motc_lv0097->ArrFunc[2]=$vLangArr[4];
$motc_lv0097->ArrFunc[3]=$vLangArr[6];
$motc_lv0097->ArrFunc[4]=$vLangArr[7];
$motc_lv0097->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$motc_lv0097->ArrFunc[6]=GetLangExcept('Apr',$plang);
$motc_lv0097->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$motc_lv0097->ArrFunc[8]=$vLangArr[10];
$motc_lv0097->ArrFunc[9]=$vLangArr[12];
$motc_lv0097->ArrFunc[10]=$vLangArr[0];
$motc_lv0097->ArrFunc[11]=$vLangArr[46];
$motc_lv0097->ArrFunc[12]=$vLangArr[47];
$motc_lv0097->ArrFunc[13]=$vLangArr[48];
$motc_lv0097->ArrFunc[14]=$vLangArr[49];
$motc_lv0097->ArrFunc[15]=$vLangArr[50];
////Other
$motc_lv0097->ArrOther[1]=$vLangArr[44];
$motc_lv0097->ArrOther[2]=$vLangArr[45];
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
	$vresult=$motc_lv0097->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"tc_lv0097",$lvMessage);
}
elseif($flagID==2)
{
	$motc_lv0097->lv001=$_POST['txtlv001'];
	$motc_lv0097->lv002= $_GET['ID'] ?? '';
	$motc_lv0097->lv003=$_POST['txtlv003'];
	$motc_lv0097->lv004=$_POST['txtlv004'];
	$motc_lv0097->lv016=$_POST['txtlv016'];
	$motc_lv0097->lv129=$_POST['txtlv129'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0097->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0097->LV_UnAproval($strar);
}
elseif($flagID==5)
{
	$vyear=$_POST['qxtyear'];
	$motc_lv0097->datefrom=$vyear.'-01-01';
	$motc_lv0097->dateto=$vyear.'-12-31';
	$motc_lv0097->typecal=$_POST['qxtlv001'];
	$motc_lv0097->CalID=$_POST['qxtlv030'];
	$motc_lv0097->DeptCal=$_POST['qxtlv029'];
	$motc_lv0097->CachTinh=$_POST['qxtlv016'];
	$motc_lv0097->AutoCalSalary( $_GET['ID']);
	$motc_lv0097->lv001='';
	$motc_lv0097->lv002='';
	$motc_lv0097->lv003='';
	$motc_lv0097->lv004='';
	$motc_lv0097->lv005='';
	$motc_lv0097->lv006='';
	$motc_lv0097->lv007='';
	$motc_lv0097->lv008='';
	$motc_lv0097->lv009='';
	$motc_lv0097->lv010='';
	$motc_lv0097->lv011='';
	$motc_lv0097->lv012='';
	$motc_lv0097->lv013='';
	$motc_lv0097->lv014='';
	$motc_lv0097->lv015='';
	$motc_lv0097->lv016='';
	$motc_lv0097->lv017='';
}
elseif($flagID==11)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$motc_lv0097->LV_UpdateChuyenKhoan($strar,0);
		
}
elseif($flagID==12)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$motc_lv0097->LV_UpdateChuyenKhoan($strar,1);
}
//first is load
if (!isset($_POST["txtFlag"]) || $_POST["txtFlag"] == "")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0097->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0097');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0097->ListView;
$curPage = $motc_lv0097->CurPage;
$maxRows =$motc_lv0097->MaxRows;
$vOrderList=$motc_lv0097->ListOrder;
$vSortNum=$motc_lv0097->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$motc_lv0097->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0097',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$motc_lv0097->lv002= $_GET['ID'] ?? '';
$motc_lv0013->LV_LoadID( $_GET['ID']);
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0097->GetCount();
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
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/engine.js"></script>
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv016=<?php echo $_POST['txtlv016'];?>&lv129=<?php echo $_POST['txtlv129'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,15,0);?>"
	 o.submit();

}
//////////////RunFunction/////////////////////////
function RunFunction(vID,func)
{
	var str="<br><iframe height=1000 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>tc_lv0097?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,15,0);?>"
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,15,0);?>"
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
	o.txtID.value=vValue;
	document.frmprocess.qxtnguoiky.value=document.frmchoose.txtnguoiky.value;
	o.action="<?php echo $vDir;?>tc_lv0097/?childfunc=rpt&lang=<?php echo $plang;?>";
	o.submit();
}

function ChangeTextNow(vopt)
{
	var o=document.frmchoose;
	switch(vopt)
	{
		case '1':
			o.qxtlv002.value="01/01/"+o.qxtyear.value;
			o.qxtlv003.value="31/10/"+o.qxtyear.value;
			o.btCal.focus();
			return;
		case '2':
			o.qxtlv002.value="01/01/"+o.qxtyear.value;
			o.qxtlv003.value="31/12/"+o.qxtyear.value;
			o.btCal.focus();
			return;
		default:
			o.qxtlv002.value="01/01/"+o.qxtyear.value;
			o.qxtlv003.value="31/12/"+o.qxtyear.value;
			o.qxtlv002.select();
			return;
	}
	
}
function Cal_BonusNow()
{
	if(confirm("Bạn có muốn tự động tính thưởng mới không (Y/N)?"))
	{
		var o=document.frmchoose;
		o.txtFlag.value=5;
	    o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,15,0);?>"
		o.submit();
	}
}
function UpdateChuyenKhoan()
{
	lv_chk_list(document.frmchoose,'lvChk',11);
}
function FunctRunning4(vValue)
{
	if(confirm("Bạn có đồng ý cập nhật chuyển khoản?"))
	{
		var o=document.frmchoose;
	 	o.txtStringID.value=vValue;
		o.txtFlag.value=11;
		 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,15,0);?>"
		 o.submit();
	}
}
function UpdateTienMat()
{
	lv_chk_list(document.frmchoose,'lvChk',8);
}
function FunctRunning3(vValue)
{
	if(confirm("Bạn có đồng ý cập nhật tiền mặt?"))
	{
		var o=document.frmchoose;
	 	o.txtStringID.value=vValue;
		o.txtFlag.value=12;
		 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,15,0);?>"
		 o.submit();
	}
}
//-->
</script>
<?php
if($motc_lv0097->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,15,0);?>" method="post" name="frmchoose" id="frmchoose">
					 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#f2f2f2;font:10px arial"><tr>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $motc_lv0097->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $motc_lv0097->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $motc_lv0097->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $motc_lv0097->lv004;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $motc_lv0097->lv016;?>"/>
						<input type="hidden" name="txtlv129" id="txtlv129" value="<?php echo $motc_lv0097->lv129;?>"/>
						<?php if($motc_lv0097->GetApr()==1 && $motc_lv0097->GetUnApr()==1)
							{?>
						<table style="background:#f2f2f2;font:10px arial">
							<tr>
								<td>Loại tính</td>
								<td  height="20px">
									<select  name="qxtlv016"  id="qxtlv016"  tabindex="7" maxlength="255" style="width:80%" onchange="ChangeTextNow(this.value)">
					  						<option value="0" <?php echo ($_POST['qxtlv016']=='0')?'selected="selected"':'';?>>Bình quân năm</option>
					  				</select>	
					  			</td>
					  			<td>Năm tínnh</td>
								<td>
								<select  name="qxtyear"  id="qxtyear"  tabindex="7" maxlength="255" style="width:50px">
								<?php
								for($i=($motc_lv0013->lv007-3);$i<=($motc_lv0013->lv007+3);$i++)
								{
								?>
									<option value="<?php echo $i;?>" <?php echo ($i==(($POST['qxtyear']=='')?($motc_lv0013->lv007-1):$POST['qxtyear']))?'selected="selected"':''?>><?php echo $i;?></option>
								<?php
								}
								?>
								</select>
								</td>
								<td>Phòng ban</td>
								<td  height="20px">
									<select  name="qxtlv029"  id="qxtlv029"  tabindex="7" maxlength="255" style="width:80%" >
											<option value=""></option>
					  						<?php echo $motc_lv0097->LV_LinkField('lv029',$_POST['qxtlv029']);?>
					  				</select>	
					  			</td>
								<td  height="20px"><input name="btCal" type="button" value="Tính ngay" tabindex="7" onclick="Cal_BonusNow()"/></td>
							  </tr>	
							 
							  						<?php
if($mohr_lv0020->GetApr()==1 && $mohr_lv0020->GetUnApr()==1)
{?>
 						<tr>
						<td width="60"><input type="button" value="Chuyển khoản" onclick="UpdateChuyenKhoan()"/></td>
						<td> <input type="button" value="Tiền mặt" onclick="UpdateTienMat()"/></td>
						<td>Người lập biểu</td>
						<td colspan="4">
						 <table width="80%"><tr><td width="50%">
							<select  name="txtnguoiky"  id="txtnguoiky"  tabindex="7" maxlength="255" style="width:80%" >
									<option value=""></option>
			  						<?php echo $motc_lv0097->LV_LinkField('lv003',$_POST['txtnguoiky']);?>
			  				</select>
			  				 </td>
							    <td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="qxtnguoiky_search" id="qxtnguoiky_search" style="width:100%"  onKeyUp="LoadPopupParent(this,'txtnguoiky','hr_lv0020','concat(lv002,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtnguoiky','hr_lv0020','concat(lv002,@! @!,lv001)')"   tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>
		  				</td>

						</tr>
<?php
}			
?>	

							  
						</table>
						<?php
					}
					?>
						<?php echo $motc_lv0097->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>    
				  </form>
				<form method="post" action="<?php echo $vDir;?>tc_lv0097?func=childfunc&lang=<?php echo $plang;?>" name="frmprocess" > 
				  		<input type="hidden" name="txtID" type="hidden" id="txtID" />
				  		<input type="hidden"  name="qxtnguoiky"  id="qxtnguoiky"/ >
				  </form>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>				  
</div></div>
</body>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
			
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $motc_lv0097->ArrPush[0];?>';	
</script>
</html>