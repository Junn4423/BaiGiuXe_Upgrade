<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/jo_lv0004_2.php");
require_once("../clsall/jo_lv0016.php");
require_once("../clsall/tc_lv0013.php");

/////////////init object//////////////
$mojo_lv0004_2=new jo_lv0004_2($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$lvjo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0016');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$lvjo_lv0016->LV_Load();
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","JO0005.txt",$plang);
$mojo_lv0004_2->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0004_2->ArrPush[0]=$vLangArr[17];
$mojo_lv0004_2->ArrPush[1]=$vLangArr[18];
$mojo_lv0004_2->ArrPush[2]=$vLangArr[19];
$mojo_lv0004_2->ArrPush[3]=$vLangArr[20];
$mojo_lv0004_2->ArrPush[4]=$vLangArr[21];
$mojo_lv0004_2->ArrPush[5]=$vLangArr[22];
$mojo_lv0004_2->ArrPush[6]=$vLangArr[23];
$mojo_lv0004_2->ArrPush[7]=$vLangArr[24];
$mojo_lv0004_2->ArrPush[8]=$vLangArr[25];
$mojo_lv0004_2->ArrPush[9]=$vLangArr[26];
$mojo_lv0004_2->ArrPush[10]=$vLangArr[27];
$mojo_lv0004_2->ArrPush[11]=$vLangArr[28];
$mojo_lv0004_2->ArrPush[12]=$vLangArr[29];
$mojo_lv0004_2->ArrPush[13]=$vLangArr[30];
$mojo_lv0004_2->ArrPush[14]=$vLangArr[31];
$mojo_lv0004_2->ArrPush[15]=$vLangArr[32];
$mojo_lv0004_2->ArrPush[16]=$vLangArr[33];
$mojo_lv0004_2->ArrPush[17]=$vLangArr[34];
$mojo_lv0004_2->ArrPush[18]=$vLangArr[35];
$mojo_lv0004_2->ArrPush[19]=$vLangArr[36];
$mojo_lv0004_2->ArrPush[20]=$vLangArr[37];
$mojo_lv0004_2->ArrPush[21]=$vLangArr[38];
$mojo_lv0004_2->ArrPush[22]=$vLangArr[39];
$mojo_lv0004_2->ArrPush[23]=$vLangArr[40];
$mojo_lv0004_2->ArrPush[24]=$vLangArr[41];
$mojo_lv0004_2->ArrPush[100]='Tên';

$mojo_lv0004_2->ArrFunc[0]='//Function';
$mojo_lv0004_2->ArrFunc[1]=$vLangArr[2];
$mojo_lv0004_2->ArrFunc[2]=$vLangArr[4];
$mojo_lv0004_2->ArrFunc[3]=$vLangArr[6];
$mojo_lv0004_2->ArrFunc[4]=$vLangArr[7];
$mojo_lv0004_2->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mojo_lv0004_2->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mojo_lv0004_2->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mojo_lv0004_2->ArrFunc[8]=$vLangArr[10];
$mojo_lv0004_2->ArrFunc[9]=$vLangArr[12];
$mojo_lv0004_2->ArrFunc[10]=$vLangArr[0];
$mojo_lv0004_2->ArrFunc[11]=$vLangArr[44];
$mojo_lv0004_2->ArrFunc[12]=$vLangArr[45];
$mojo_lv0004_2->ArrFunc[13]=$vLangArr[46];
$mojo_lv0004_2->ArrFunc[14]=$vLangArr[47];
$mojo_lv0004_2->ArrFunc[15]=$vLangArr[48];

////Other
$mojo_lv0004_2->ArrOther[1]=$vLangArr[42];
$mojo_lv0004_2->ArrOther[2]=$vLangArr[43];
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
	$vresult=$mojo_lv0004_2->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"jo_lv0004_2",$lvMessage);
}
elseif($flagID==2)
{
$mojo_lv0004_2->lv001=$_POST['txtlv001'];
$mojo_lv0004_2->lv002=$_POST['txtlv002'];
$mojo_lv0004_2->lv003=$_POST['txtlv003'];
$mojo_lv0004_2->lv004=$_POST['txtlv004'];
$mojo_lv0004_2->lv005=$_POST['txtlv005'];
$mojo_lv0004_2->lv006=$_POST['txtlv006'];
$mojo_lv0004_2->lv007=$_POST['txtlv007'];
$mojo_lv0004_2->lv008=$_POST['txtlv008'];
$mojo_lv0004_2->lv009=$_POST['txtlv009'];
$mojo_lv0004_2->lv010=$_POST['txtlv010'];
$mojo_lv0004_2->lv011=$_POST['txtlv011'];
$mojo_lv0004_2->lv012=$_POST['txtlv012'];
$mojo_lv0004_2->lv013=$_POST['txtlv013'];
$mojo_lv0004_2->lv014=$_POST['txtlv014'];
$mojo_lv0004_2->lv015=$_POST['txtlv015'];
$mojo_lv0004_2->lv016=$_POST['txtlv016'];
$mojo_lv0004_2->lv017=$_POST['txtlv017'];
$mojo_lv0004_2->lv018=$_POST['txtlv018'];
$mojo_lv0004_2->lv019=$_POST['txtlv019'];
$mojo_lv0004_2->lv020=$_POST['txtlv020'];
$mojo_lv0004_2->lv021=$_POST['txtlv021'];
$mojo_lv0004_2->lv022=$_POST['txtlv022'];
$mojo_lv0004_2->lv023=$_POST['txtlv023'];
$mojo_lv0004_2->lv024=$_POST['txtlv024'];
$mojo_lv0004_2->lv025=$_POST['txtlv025'];

}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mojo_lv0004_2->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mojo_lv0004_2->LV_UnAproval($strar);
}
elseif($flagID==6)
{
	$mojo_lv0004_2->lv002=$_POST['qxtlv002'];
	$mojo_lv0004_2->lv003=$_POST['qxtlv003'];
	$mojo_lv0004_2->lv008=$_POST['qxtlv008'];
	$mojo_lv0004_2->lv015=$_POST['qxtlv015'];
	$mojo_lv0004_2->lv022=$_POST['qxtlv022'];
	$mojo_lv0004_2->lv012=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$mojo_lv0004_2->lv016=$_POST['qxtlv016_1']." ".$_POST['qxtlv016_2'];
	$mojo_lv0004_2->lv017=$_POST['qxtlv017_1']." ".$_POST['qxtlv017_2'];
	$mojo_lv0004_2->lv018=$_POST['qxtlv018_1']." ".$_POST['qxtlv018_2'];
	$mojo_lv0004_2->lv019=$_POST['qxtlv019_1']." ".$_POST['qxtlv019_2'];
	$mojo_lv0004_2->lv014=$lvjo_lv0016->lv003;
		if($mojo_lv0004_2->lv014=="")
			$mojo_lv0004_2->lv014=$lvjo_lv0016->lv004;
		else
			$mojo_lv0004_2->lv014=$mojo_lv0004_2->lv014.";".$lvjo_lv0016->lv004;
			$mojo_lv0004_2->lv004=0;
		$mojo_lv0004_2->lv006=0;
	$vresult=$mojo_lv0004_2->LV_Insert_NoID();	
	$mojo_lv0004_2->lv002='';
	$mojo_lv0004_2->lv002='';
	$mojo_lv0004_2->lv003='';
	$mojo_lv0004_2->lv004='';
	$mojo_lv0004_2->lv005='';
	$mojo_lv0004_2->lv006='';
	$mojo_lv0004_2->lv007='';
	$mojo_lv0004_2->lv008='';
	$mojo_lv0004_2->lv009='';
	$mojo_lv0004_2->lv010='';
	$mojo_lv0004_2->lv011='';
	$mojo_lv0004_2->lv012='';
	$mojo_lv0004_2->lv013='';
	$mojo_lv0004_2->lv014='';
	$mojo_lv0004_2->lv015='';
	$mojo_lv0004_2->lv016='';
	$mojo_lv0004_2->lv017='';
	$mojo_lv0004_2->lv018='';
	$mojo_lv0004_2->lv019='';
	
}
if($vkeep==1)
{
	$mojo_lv0004_2->tv002=$_POST['qxtlv002'];
	$mojo_lv0004_2->tv003=$_POST['qxtlv003'];
	$mojo_lv0004_2->tv008=$_POST['qxtlv008'];
	$mojo_lv0004_2->tv015=$_POST['qxtlv015'];
	$mojo_lv0004_2->tv016=$_POST['qxtlv016_1']." ".$_POST['qxtlv016_2'];
	$mojo_lv0004_2->tv017=$_POST['qxtlv017_1']." ".$_POST['qxtlv017_2'];
	$mojo_lv0004_2->tv018=$_POST['qxtlv018_1']." ".$_POST['qxtlv018_2'];
	$mojo_lv0004_2->tv019=$_POST['qxtlv019_1']." ".$_POST['qxtlv019_2'];
}
else
{
	$mojo_lv0004_2->tv015=getInfor($_SESSION['ERPSOFV2RUserID'],2);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0004_2->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0004_2');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mojo_lv0004_2->ListView;
$curPage = $mojo_lv0004_2->CurPage;
$maxRows =$mojo_lv0004_2->MaxRows;
$vOrderList=$mojo_lv0004_2->ListOrder;
$vSortNum=$mojo_lv0004_2->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mojo_lv0004_2->SaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0004_2',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
if($mojo_lv0004_2->GetApr()<>1 || $mojo_lv0004_2->GetUnApr()<>1)
{
 $mojo_lv0004_2->lv012=getInfor($_SESSION['ERPSOFV2RUserID'],2);
}
$mojo_lv0004_2->checkmonth=$_POST['txtcheckmonth'];
if($mojo_lv0004_2->checkmonth==0)
{
	$motc_lv0013->LV_LoadActiveID();
	$mojo_lv0004_2->lv016_=$motc_lv0013->lv004;
	$mojo_lv0004_2->lv017_=$motc_lv0013->lv005;
	
}
$mojo_lv0004_2->ListEmp=$mojo_lv0004_2->LV_CheckPhepFilter($mojo_lv0004_2->lv016_,$mojo_lv0004_2->lv017_);
$totalRowsC=$mojo_lv0004_2->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv016=<?php echo $_POST['txtlv016'];?>&lv017=<?php echo $_POST['txtlv017'];?>&lv018=<?php echo $_POST['txtlv018'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv020=<?php echo $_POST['txtlv020'];?>&lv021=<?php echo $_POST['txtlv021'];?>&lv022=<?php echo $_POST['txtlv022'];?>&lv023=<?php echo $_POST['txtlv023'];?>&lv024=<?php echo $_POST['txtlv024'];?>&lv025=<?php echo $_POST['txtlv025'];?>&checkmonth=<?php echo $_POST['txtcheckmonth'];?>','filter');
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
	 o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
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
			var str="<br><iframe height=1900 marginheight=0 marginwidth=0 frameborder=0 src=jo_lv0004_2?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe height=1900 marginheight=0 marginwidth=0 frameborder=0 src=jo_lv0004_2?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
	}
	
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
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
	o.action="<?php echo $vDir;?>jo_lv0004_2?func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function Save()
{
	var o=document.frmchoose;
	o.txtFlag.value=6;
	if(o.qxtlv016_1.value=="" && o.qxtlv017_1.value=="")
	{
		alert("Ngày không rỗng!");
		if(o.qxtlv006.value=="")
		{
			
			o.qxtlv006.focus();
		}
		else
		{
			o.qxtlv008.focus();
		}
	}
	else
	{
		
		o.submit();
		
	}
}
//-->
</script>
<?php
if($mojo_lv0004_2->GetView()==1)
{
?>
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mojo_lv0004_2->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mojo_lv0004_2->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mojo_lv0004_2->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mojo_lv0004_2->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mojo_lv0004_2->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mojo_lv0004_2->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mojo_lv0004_2->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mojo_lv0004_2->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mojo_lv0004_2->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mojo_lv0004_2->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mojo_lv0004_2->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mojo_lv0004_2->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mojo_lv0004_2->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mojo_lv0004_2->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mojo_lv0004_2->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mojo_lv0004_2->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mojo_lv0004_2->lv016;?>"/>
                        <input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mojo_lv0004_2->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $mojo_lv0004_2->lv018;?>"/>
						<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $mojo_lv0004_2->lv019;?>"/>
						<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $mojo_lv0004_2->lv020;?>"/>
						<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $mojo_lv0004_2->lv021;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $mojo_lv0004_2->lv022;?>"/>
						<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $mojo_lv0004_2->lv023;?>"/>
						<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $mojo_lv0004_2->lv024;?>"/>
						<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $mojo_lv0004_2->lv025;?>"/>					    
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
</div></div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
setTimeout("setFocusNow()",1000);
function setFocusNow()
{
document.frmchoose.qxtlv001.focus();
}
</script>