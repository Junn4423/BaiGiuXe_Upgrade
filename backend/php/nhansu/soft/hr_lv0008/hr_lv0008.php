<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/hr_lv0008.php");
/////////////init object//////////////
$mohr_lv0008=new hr_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'HR0025');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("../","HR0061.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0008->ArrPush[0]=$vLangArr[17];
$mohr_lv0008->ArrPush[1]=$vLangArr[18];
$mohr_lv0008->ArrPush[2]=$vLangArr[20];
$mohr_lv0008->ArrPush[3]=$vLangArr[21];
$mohr_lv0008->ArrPush[4]=$vLangArr[29];
$mohr_lv0008->ArrPush[5]=$vLangArr[30];
$mohr_lv0008->ArrPush[6]=$vLangArr[31];

$mohr_lv0008->ArrFunc[0]='//Function';
$mohr_lv0008->ArrFunc[1]=$vLangArr[2];
$mohr_lv0008->ArrFunc[2]=$vLangArr[4];
$mohr_lv0008->ArrFunc[3]=$vLangArr[6];
$mohr_lv0008->ArrFunc[4]=$vLangArr[7];
$mohr_lv0008->ArrFunc[5]='';
$mohr_lv0008->ArrFunc[6]='';
$mohr_lv0008->ArrFunc[7]='';
$mohr_lv0008->ArrFunc[8]=$vLangArr[10];
$mohr_lv0008->ArrFunc[9]=$vLangArr[11];
$mohr_lv0008->ArrFunc[10]=$vLangArr[0];
$mohr_lv0008->ArrFunc[11]=$vLangArr[24];
$mohr_lv0008->ArrFunc[12]=$vLangArr[25];
$mohr_lv0008->ArrFunc[13]=$vLangArr[26];
$mohr_lv0008->ArrFunc[14]=$vLangArr[27];
$mohr_lv0008->ArrFunc[15]=$vLangArr[28];
////Other
$mohr_lv0008->ArrOther[1]=$vLangArr[22];
$mohr_lv0008->ArrOther[2]=$vLangArr[23];
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
	$vresult=$mohr_lv0008->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0008",$lvMessage);
}
elseif($flagID==2)
{
$mohr_lv0008->lv001=$_POST['txtlv001'];
$mohr_lv0008->lv002=$_POST['txtlv002'];
$mohr_lv0008->lv003=$_POST['txtlv003'];
$mohr_lv0008->lv004=$_POST['txtlv004'];
$mohr_lv0008->lv005=$_POST['txtlv005'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0008->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0008');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0008->ListView;
$curPage = $mohr_lv0008->CurPage;
$maxRows =$mohr_lv0008->MaxRows;
$vOrderList=$mohr_lv0008->ListOrder;
$vSortNum=$mohr_lv0008->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0008->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0008',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0008->GetCount();
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
function Fil()
{
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>','filter');
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
	var str="<br><iframe height=250 marginheight=0 marginwidth=0 frameborder=0 src=\"hr_lv0008?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($mohr_lv0008->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0008->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0008->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mohr_lv0008->lv002;?>"/>
					    <input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mohr_lv0008->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mohr_lv0008->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mohr_lv0008->lv005;?>"/>
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
div.innerHTML='<?php echo $mohr_lv0008->ArrPush[0];?>';	
</script>