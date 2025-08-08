<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/ki_lv0003.php");

/////////////init object//////////////
$moki_lv0003=new ki_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","KI0003.txt",$plang);
$moki_lv0003->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0003->ArrPush[0]=$vLangArr[17];
$moki_lv0003->ArrPush[1]=$vLangArr[18];
$moki_lv0003->ArrPush[2]=$vLangArr[19];
$moki_lv0003->ArrPush[3]=$vLangArr[20];
$moki_lv0003->ArrPush[4]=$vLangArr[21];
$moki_lv0003->ArrPush[5]=$vLangArr[22];
$moki_lv0003->ArrPush[6]=$vLangArr[23];
$moki_lv0003->ArrPush[7]=$vLangArr[24];
$moki_lv0003->ArrPush[8]=$vLangArr[25];
$moki_lv0003->ArrPush[9]=$vLangArr[26];
$moki_lv0003->ArrPush[10]=$vLangArr[27];

$moki_lv0003->ArrFunc[0]='//Function';
$moki_lv0003->ArrFunc[1]=$vLangArr[2];
$moki_lv0003->ArrFunc[2]=$vLangArr[4];
$moki_lv0003->ArrFunc[3]=$vLangArr[6];
$moki_lv0003->ArrFunc[4]=$vLangArr[7];
$moki_lv0003->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$moki_lv0003->ArrFunc[6]=GetLangExcept('Apr',$plang);
$moki_lv0003->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$moki_lv0003->ArrFunc[8]=$vLangArr[10];
$moki_lv0003->ArrFunc[9]=$vLangArr[12];
$moki_lv0003->ArrFunc[10]=$vLangArr[0];
$moki_lv0003->ArrFunc[11]=$vLangArr[28];
$moki_lv0003->ArrFunc[12]=$vLangArr[29];
$moki_lv0003->ArrFunc[13]=$vLangArr[30];
$moki_lv0003->ArrFunc[14]=$vLangArr[31];
$moki_lv0003->ArrFunc[15]=$vLangArr[32];

////Other
$moki_lv0003->ArrOther[1]=$vLangArr[26];
$moki_lv0003->ArrOther[2]=$vLangArr[27];
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
	$vresult=$moki_lv0003->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ki_lv0003",$lvMessage);
}
elseif($flagID==2)
{
$moki_lv0003->lv001=$_POST['txtlv001'];
$moki_lv0003->lv002=$_POST['txtlv002'];
$moki_lv0003->lv003=$_POST['txtlv003'];
$moki_lv0003->lv004=$_POST['txtlv004'];
$moki_lv0003->lv005=$_POST['txtlv005'];
$moki_lv0003->lv006=$_POST['txtlv006'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moki_lv0003->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moki_lv0003->LV_UnAproval($strar);
}
elseif($flagID==10)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moki_lv0003->LV_CheckUpdateRate($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moki_lv0003->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0003');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moki_lv0003->ListView;
$curPage = $moki_lv0003->CurPage;
$maxRows =$moki_lv0003->MaxRows;
$vOrderList=$moki_lv0003->ListOrder;
$vSortNum=$moki_lv0003->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moki_lv0003->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ki_lv0003',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
if($moki_lv0003->GetApr()<>1)
{
 $moki_lv0003->lv004=getInfor($_SESSION['ERPSOFV2RUserID'],2);
}
$totalRowsC=$moki_lv0003->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv016=<?php echo $_POST['txtlv016'];?>&lv017=<?php echo $_POST['txtlv017'];?>&lv018=<?php echo $_POST['txtlv018'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv020=<?php echo $_POST['txtlv020'];?>&lv021=<?php echo $_POST['txtlv021'];?>&lv022=<?php echo $_POST['txtlv022'];?>&lv023=<?php echo $_POST['txtlv023'];?>&lv024=<?php echo $_POST['txtlv024'];?>&lv025=<?php echo $_POST['txtlv025'];?>','filter');
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
			var str="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src=\"ki_lv0003?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src=\"ki_lv0003?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
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
	o.action="<?php echo $vDir;?>ki_lv0003?func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
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
function UpToStaffRate()
{
	lv_chk_list(document.frmchoose,'lvChk',8);
}
function FunctRunning3(vValue)
{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=10;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();
}
//-->
</script>
<?php
if($moki_lv0003->GetView()==1)
{
?>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $moki_lv0003->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $moki_lv0003->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $moki_lv0003->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $moki_lv0003->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $moki_lv0003->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $moki_lv0003->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $moki_lv0003->lv006;?>"/>
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $moki_lv0003->ArrPush[0];?>';	
</script>