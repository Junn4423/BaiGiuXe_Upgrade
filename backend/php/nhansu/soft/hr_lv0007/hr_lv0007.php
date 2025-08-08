<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/hr_lv0007.php");

/////////////init object//////////////
$mohr_lv0007=new hr_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'HR0023');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","HR0059.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0007->ArrPush[0]=$vLangArr[17];
$mohr_lv0007->ArrPush[1]=$vLangArr[18];
$mohr_lv0007->ArrPush[2]=$vLangArr[20];
$mohr_lv0007->ArrPush[3]=$vLangArr[21];
$mohr_lv0007->ArrPush[4]=$vLangArr[22];
$mohr_lv0007->ArrPush[5]=$vLangArr[23];
$mohr_lv0007->ArrPush[6]=$vLangArr[24];
$mohr_lv0007->ArrPush[7]=$vLangArr[28];

$mohr_lv0007->ArrFunc[0]='//Function';
$mohr_lv0007->ArrFunc[1]=$vLangArr[2];
$mohr_lv0007->ArrFunc[2]=$vLangArr[4];
$mohr_lv0007->ArrFunc[3]=$vLangArr[6];
$mohr_lv0007->ArrFunc[4]='';
$mohr_lv0007->ArrFunc[5]='';
$mohr_lv0007->ArrFunc[6]='';
$mohr_lv0007->ArrFunc[7]='';
$mohr_lv0007->ArrFunc[8]=$vLangArr[10];
$mohr_lv0007->ArrFunc[9]=$vLangArr[12];
$mohr_lv0007->ArrFunc[10]=$vLangArr[0];
$mohr_lv0007->ArrFunc[11]=$vLangArr[31];
$mohr_lv0007->ArrFunc[12]=$vLangArr[32];
$mohr_lv0007->ArrFunc[13]=$vLangArr[33];
$mohr_lv0007->ArrFunc[14]=$vLangArr[34];
$mohr_lv0007->ArrFunc[15]=$vLangArr[35];
////Other	
	$mohr_lv0007->ArrOther[1]=$vLangArr[29];
$mohr_lv0007->ArrOther[2]=$vLangArr[30];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0007->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0007",$lvMessage);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0007->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0007');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0007->ListView;
$curPage = $mohr_lv0007->CurPage;
$maxRows =$mohr_lv0007->MaxRows;
$vOrderList=$mohr_lv0007->ListOrder;
$vSortNum=$mohr_lv0007->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0007->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0007',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0007->GetCount('');
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
function RunFunction(vID,func)
{
	var str="<br><iframe height=500 marginheight=0 marginwidth=0 frameborder=0 src=\"hr_lv0007?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function ReportAll(strvalue)
{
	window.open("hr_lv0007?func=rpt","_blank");
}
//-->
</script>
<?php
if($mohr_lv0007->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0007->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="0"/>
					    
				  </form>
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mohr_lv0007->ArrPush[0];?>';	
</script>