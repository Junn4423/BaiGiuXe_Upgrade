<?php
$vDir  = '';if (isset( $_GET['ID']) &&  $_GET['ID'] != "") $vDir = '../';
include($vDir."paras.php");
require_once($vDir."../clsall/lv_controler.php");
require_once($vDir."../clsall/ki_lv0007.php");
require_once($vDir."../clsall/tc_lv0013.php");
/////////////init object//////////////
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$moki_lv0007=new ki_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0007');
if($motc_lv0013->GetApr()==1 && $motc_lv0013->GetUnApr()==1)
{
	if(isset($_POST['txtCalID']))
	{
		$motc_lv0013->LV_SetCal($_POST['txtCalID']);
	}
	$motc_lv0013->LV_GetCal();
	if($motc_lv0013->lv999!='' || $motc_lv0013->lv999!=NULL)
	{
		$motc_lv0013->LV_LoadID($motc_lv0013->lv999);
	}
	else
		$motc_lv0013->LV_LoadActiveID();
?>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				
	 <form name="frmcalculate" method="post">
	 	<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>	
		<input type="hidden" name="txtlv002"  tabindex="1" value="<?php echo $_POST['txtlv002'];?>"/>
		<input type="hidden" name="txtFullName"  tabindex="1" value="<?php echo $_POST['txtFullName'];?>"/>
		<input type="hidden" name="txtlv010"  tabindex="1" value="<?php echo $_POST['txtlv010'];?>"/>
		<input type="hidden" name="txtlv029"  tabindex="1" value="<?php echo $_POST['txtlv029'];?>"/>
	<?php 
	
		  $vTitle=''; 
		  if($plang=="EN")
			{	

					echo 'OPTION PARAMETER TO CACULATE ';
			}
		   else
		   {
				echo 'CHỌN THÔNG SỐ TÍNH LƯƠNG';
		   }
		   ?>
		   <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>"/>
		    <select name="txtCalID">
		    	<option value=""></option>
				<?php echo $motc_lv0013->LV_LinkField('lv999',$motc_lv0013->lv999);?>
			</select>
		  	<input type="submit" value="Chọn ngay" onclick="document.frmcalculate.submit()"/>
		  	</form>
		  	</div>
		</td>
		</tr>
		</tbody>
		</table>	
<?php
}
else
	$motc_lv0013->LV_LoadActiveID();
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$moki_lv0007->Dir=$vDir;
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile($vDir."../","KI0008.txt",$plang);
	
$moki_lv0007->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0007->ArrPush[0]=$vLangArr[17];
$moki_lv0007->ArrPush[1]=$vLangArr[18];
$moki_lv0007->ArrPush[2]=$vLangArr[19];
$moki_lv0007->ArrPush[3]=$vLangArr[20];
$moki_lv0007->ArrPush[4]=$vLangArr[21];
$moki_lv0007->ArrPush[5]=$vLangArr[22];
$moki_lv0007->ArrPush[6]=$vLangArr[23];
$moki_lv0007->ArrPush[7]=$vLangArr[24];
$moki_lv0007->ArrPush[8]=$vLangArr[25];
$moki_lv0007->ArrPush[100]='Tên nhân viên';
$moki_lv0007->ArrPush[101]='Tổng điểm trung bình';


$moki_lv0007->ArrFunc[0]='//Function';
$moki_lv0007->ArrFunc[1]=$vLangArr[2];
$moki_lv0007->ArrFunc[2]=$vLangArr[4];
$moki_lv0007->ArrFunc[3]=$vLangArr[6];
$moki_lv0007->ArrFunc[4]=$vLangArr[7];
$moki_lv0007->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$moki_lv0007->ArrFunc[6]=GetLangExcept('Apr',$plang);
$moki_lv0007->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$moki_lv0007->ArrFunc[8]=$vLangArr[10];
$moki_lv0007->ArrFunc[9]=$vLangArr[12];
$moki_lv0007->ArrFunc[10]=$vLangArr[0];
$moki_lv0007->ArrFunc[11]=$vLangArr[28];
$moki_lv0007->ArrFunc[12]=$vLangArr[29];
$moki_lv0007->ArrFunc[13]=$vLangArr[30];
$moki_lv0007->ArrFunc[14]=$vLangArr[31];
$moki_lv0007->ArrFunc[15]=$vLangArr[32];

////Other
$moki_lv0007->ArrOther[1]=$vLangArr[26];
$moki_lv0007->ArrOther[2]=$vLangArr[27];
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
	$vresult=$moki_lv0007->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ki_lv0007",$lvMessage);
}
elseif($flagID==2)
{
$moki_lv0007->lv001=$_POST['txtlv001'];
$moki_lv0007->lv002=$_POST['txtlv002'];
$moki_lv0007->lv003=$_POST['txtlv003'];
$moki_lv0007->lv004=$_POST['txtlv004'];
$moki_lv0007->lv005=$_POST['txtlv005'];
$moki_lv0007->lv006=$_POST['txtlv006'];
$moki_lv0007->lv007=$_POST['txtlv007'];
$moki_lv0007->lv008=$_POST['txtlv008'];
$moki_lv0007->lv009=$_POST['txtlv009'];
$moki_lv0007->lv010=$_POST['txtlv010'];
$moki_lv0007->lv011=$_POST['txtlv011'];
$moki_lv0007->lv012=$_POST['txtlv012'];
$moki_lv0007->lv013=$_POST['txtlv013'];
$moki_lv0007->lv014=$_POST['txtlv014'];
$moki_lv0007->lv015=$_POST['txtlv015'];
$moki_lv0007->lv016=$_POST['txtlv016'];
$moki_lv0007->lv017=$_POST['txtlv017'];
$moki_lv0007->lv018=$_POST['txtlv018'];
$moki_lv0007->lv019=$_POST['txtlv019'];
$moki_lv0007->lv020=$_POST['txtlv020'];
$moki_lv0007->lv021=$_POST['txtlv021'];
$moki_lv0007->lv022=$_POST['txtlv022'];
$moki_lv0007->lv023=$_POST['txtlv023'];
$moki_lv0007->lv024=$_POST['txtlv024'];
$moki_lv0007->lv025=$_POST['txtlv025'];
$moki_lv0007->lv026=$_POST['txtlv026'];
$moki_lv0007->lv027=$_POST['txtlv027'];
$moki_lv0007->lv028=$_POST['txtlv028'];
$moki_lv0007->lv029=$_POST['txtlv029'];
$moki_lv0007->lv030=$_POST['txtlv030'];
$moki_lv0007->lv031=$_POST['txtlv031'];
$moki_lv0007->lv032=$_POST['txtlv032'];
$moki_lv0007->lv033=$_POST['txtlv033'];
$moki_lv0007->lv034=$_POST['txtlv034'];
$moki_lv0007->lv035=$_POST['txtlv035'];
$moki_lv0007->lv036=$_POST['txtlv036'];
$moki_lv0007->lv037=$_POST['txtlv037'];
$moki_lv0007->lv038=$_POST['txtlv038'];
$moki_lv0007->lv039=$_POST['txtlv039'];
$moki_lv0007->lv040=$_POST['txtlv040'];
$moki_lv0007->lv041=$_POST['txtlv041'];
$moki_lv0007->lv042=$_POST['txtlv042'];
$moki_lv0007->lv043=$_POST['txtlv043'];
$moki_lv0007->FullName=$_POST['txtFullName'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moki_lv0007->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moki_lv0007->LV_UnAproval($strar);
}
elseif($flagID==5)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=explode("@",$strar);
	//Tinh
	if(trim($motc_lv0013->lv001)!='' && $motc_lv0013->lv001!=NULL) $moki_lv0007->LV_CalculateAuto($motc_lv0013);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0007->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0007');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moki_lv0007->ListView;
$curPage = $moki_lv0007->CurPage;
$maxRows =$moki_lv0007->MaxRows;
$vOrderList=$moki_lv0007->ListOrder;
$vSortNum=$moki_lv0007->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moki_lv0007->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0007',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$moki_lv0007->lv003=$motc_lv0013->lv001;
if(trim($moki_lv0007->lv003.'')=='') $moki_lv0007->lv003='NOCAL';
$moki_lv0007->lv029_=$moki_lv0007->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$moki_lv0007->lsempid=$_POST['LSEMPID'];
if($maxRows ==0) $maxRows = 10;
$totalRowsC=$moki_lv0007->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $moki_lv0007->lv002;?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv029=<?php echo $_POST['txtlv029'];?>','filter');
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
	if(confirm('Bạn muốn kích hoạt lại dữ liệu KPI Y/N?'))
	{
		var o=document.frmchoose;
		o.txtFlag.value=5;
   		 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
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
			var str="<br><iframe id='lvframefrm' height=1400 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>ki_lv0007?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&childfunc="+func+"&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
			break;
		default:
			var str="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>ki_lv0007?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&childfunc="+func+"&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	o.action="<?php echo $vDir;?>ki_lv0007?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&childfunc=rpt&ChildID="+vValue+"&lang=<?php echo $plang;?>";
	var fun2="Report1('"+vValue+"')";
	setTimeout(fun2,100);
	o.submit();
}	
function Report1(vValue)
{
var o=document.frmprocess1;
	o.target="_blank";
	o.action="<?php echo $vDir;?>ki_lv0007?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&childfunc=rpt1&ChildID="+vValue+"&lang=<?php echo $plang;?>";
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
//-->
</script>
<?php
if($moki_lv0007->GetView()==1)
{
?>
<link rel="stylesheet" href="../css/popup.css" type="text/css">
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID'] ?? '';?>&<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<table style="background:#f2f2f2;font:10px arial">
							<tr>								
							   <td  height="20px"><input type="button" value="Kích hoạt lại KPI" onclick="Apr_Recuiment()"/></td>
							   <td>Mã nhân viên:</td><td> <input type="text" name="txtlv002" id="txtlv002" tabindex="1" value="<?php echo $moki_lv0007->lv002;?>" onchange="ChangeInfor()"/></td>
							   <td>Tên nhân viên:</td>
							   <td>
							 		<ul lang="pop-nav1" onmouseover="ChangeName(this,1)" id="pop-nav"> <li class="menupopT"> <input onKeyPress="return CheckEnter(event)"  name="txtFullName" id="txtFullName" autocomplete="off"  tabindex="1" maxlength="255" style="width:200px" value="<?php echo $moki_lv0007->FullName;?>" onKeyUp="LoadSelfNextParent(this,'txtFullName','hr_lv0020','lv002','lv002')" onFocus="LoadSelfNextParent(this,'txtFullName','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)','concat(@! @!,lv004,@! @!,lv003,@! @!,lv002)')"/><div id="lv_popup" lang="lv_popup1"> </div>						  
										</li>
									</ul>
								</td>
								<td>
								CMND
								</td>
								<td>
								<input type="text"  tabindex="1" name="txtlv010" id="txtlv010" value="<?php echo $moki_lv0007->lv010;?>" onChange="ChangeInfor()"/></td>
								<td>
								Phòng ban
								</td>
								<td>
									<select name="txtlv029" id="txtlv029" tabindex="1" style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="ChangeInfor()">
								  		<option value=""></option>
								  		<?php echo $moki_lv0007->LV_LinkField('lv029',$moki_lv0007->lv029);?>
								    </select>
								</td>
							  </tr>	
						</table>
						<?php echo $moki_lv0007->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $moki_lv0007->lv001;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $moki_lv0007->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $moki_lv0007->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $moki_lv0007->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $moki_lv0007->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $moki_lv0007->lv007;?>"/>
						
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess1" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
</div></div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript" src="../javascripts/menupopup.js"></script>	
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $moki_lv0007->ArrPush[0];?>';	
<?php if($_GET['CandID']!="" && $_GET['CandID']!=NULL )
{
?>
setTimeout('FunctRunning1("<?php echo $_GET['CandID'];?>")',1000);
<?php 
}
?>
</script>
</html>