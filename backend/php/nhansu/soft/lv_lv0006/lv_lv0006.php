<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
	require_once("../clsall/lv_lv0006.php");

/////////////init object//////////////
$molv_lv0006=new  lv_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0011');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0013.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0006->ArrPush[0]=$vLangArr[17];
$molv_lv0006->ArrPush[1]=$vLangArr[18];
$molv_lv0006->ArrPush[2]=$vLangArr[19];
$molv_lv0006->ArrPush[3]=$vLangArr[20];

$molv_lv0006->ArrFunc[0]='//Function';
$molv_lv0006->ArrFunc[1]=$vLangArr[2];
$molv_lv0006->ArrFunc[2]=$vLangArr[4];
$molv_lv0006->ArrFunc[3]=$vLangArr[6];
$molv_lv0006->ArrFunc[4]=$vLangArr[7];
$molv_lv0006->ArrFunc[5]='';
$molv_lv0006->ArrFunc[6]='';
$molv_lv0006->ArrFunc[7]='';
$molv_lv0006->ArrFunc[8]=$vLangArr[8];
$molv_lv0006->ArrFunc[9]=$vLangArr[10];
$molv_lv0006->ArrFunc[10]=$vLangArr[0];
$molv_lv0006->ArrFunc[11]=$vLangArr[19];
////Other
$molv_lv0006->ArrOther[1]=$vLangArr[17];
$molv_lv0006->ArrOther[2]=$vLangArr[18];
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
	$vresult=$molv_lv0006->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"lv_lv0006",$lvMessage);
}
elseif($flagID==2)
{
$molv_lv0006->lv001=$_POST['txtlv001'];
$molv_lv0006->lv002=$_POST['txtlv002'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0006->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0006');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$molv_lv0006->ListView;
$curPage = $molv_lv0006->CurPage;
$maxRows =$molv_lv0006->MaxRows;
$vOrderList=$molv_lv0006->ListOrder;
$vSortNum=$molv_lv0006->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$molv_lv0006->SaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0006',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$molv_lv0006->GetCount('');
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
	 o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=200 marginheight=0 marginwidth=0 frameborder=0 src= lv_lv0006?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($molv_lv0006->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $molv_lv0006->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input  name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001" value="<?php echo $molv_lv0006->lv001;?>" />
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $molv_lv0006->lv002;?>" />						
					    
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
div.innerHTML='<?php echo $molv_lv0006->ArrPush[0];?>';	
</script>