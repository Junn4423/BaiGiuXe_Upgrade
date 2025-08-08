<?php
//session_start(); 
error_reporting(E_ERROR | E_PARSE);
unset( $_SESSION['NodesHasBeenAddedCheckBox'] );
unset( $_SESSION['treeviewcheckbox'] );
unset( $_SESSION['treeviewcheckbox'] );
if (isset( $_SESSION['NodesHasBeenAddedCheckBox'] )) {
	session_destroy();
}
if (isset( $_SESSION['treeviewcheckbox'] )) {
	session_destroy();
}
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/lv_lv0004.php");

/////////////init object//////////////
$molv_lv0004= new  lv_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0005');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0028.txt",$plang);
	
//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0004->ArrPush[0]=$vLangArr[13];
$molv_lv0004->ArrPush[1]=$vLangArr[14];
$molv_lv0004->ArrPush[2]=$vLangArr[15];
$molv_lv0004->ArrPush[3]=$vLangArr[16];

$molv_lv0004->ArrFunc[0]='//Function';
$molv_lv0004->ArrFunc[1]=$vLangArr[2];
$molv_lv0004->ArrFunc[2]=$vLangArr[4];
$molv_lv0004->ArrFunc[3]=$vLangArr[6];
$molv_lv0004->ArrFunc[4]=$vLangArr[7];
$molv_lv0004->ArrFunc[5]='';
$molv_lv0004->ArrFunc[6]=($plang=='VN')?'Phân quyền':'Permi';
$molv_lv0004->ArrFunc[7]='';
$molv_lv0004->ArrFunc[8]=$vLangArr[10];
$molv_lv0004->ArrFunc[9]=$vLangArr[11];
$molv_lv0004->ArrFunc[10]=$vLangArr[0];
$molv_lv0004->ArrFunc[11]=$vLangArr[19];
////Other
$molv_lv0004->ArrOther[1]=$vLangArr[17];
$molv_lv0004->ArrOther[2]=$vLangArr[18];
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
	$vresult=$molv_lv0004->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"lv_lv0004",$lvMessage);
}
elseif($flagID==2)
{
$molv_lv0004->lv001=$_POST['txtlv001'];
$molv_lv0004->lv002=$_POST['txtlv002'];
}
//first is load
if(isset($_POST["txtFlag"]) && $_POST["txtFlag"] != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0004->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0004');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$molv_lv0004->ListView;
$curPage = $molv_lv0004->CurPage;
$maxRows =$molv_lv0004->MaxRows;
$vOrderList=$molv_lv0004->ListOrder;
$vSortNum=$molv_lv0004->SortNum;
}
elseif(isset($_POST["txtFlag"]) && $_POST["txtFlag"] == 2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$molv_lv0004->SaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0004',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$maxRows = $maxRows ?? 0;
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$molv_lv0004->GetCount('');
$maxPages = 10;
if(!isset($curPage) || $curPage == "") 
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
	var str="<br><iframe id='lvframefrm' height=200 marginheight=0 marginwidth=0 frameborder=0 src= lv_lv0004?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Apr()
{
	Chked2Submit(document.frmchoose,'lvChk',6)
}
function AddPermission(vValue)
{
	var o=document.frmcomtemp;
	o.txtlv001.value=vValue;
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,3,0,0,0);?>";
	o.target="_self";
	o.submit();
}
//-->
</script>
<?php
if($molv_lv0004->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				<div id="lvleft">
  <form onsubmit="return false;" 
        action="?func=<?php echo htmlspecialchars($_GET['func'] ?? '', ENT_QUOTES); ?>&ID=<?php echo htmlspecialchars( $_GET['ID'] ?? '', ENT_QUOTES); ?>&trangthai=<?php echo htmlspecialchars($_GET['trangthai'] ?? '', ENT_QUOTES); ?>&TKACC=<?php echo htmlspecialchars($_GET['TKACC'] ?? '', ENT_QUOTES); ?>&<?php echo $psaveget;?>" 
        method="post" 
        name="frmchoose" 
        id="frmchoose">
    <input type="hidden" name="allcreen" value="<?php echo htmlspecialchars($_POST['allcreen'] ?? '', ENT_QUOTES); ?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php if (!isset($vSortNum)) {
    $vSortNum = 0; // hoặc giá trị phù hợp với logic bạn cần
} echo $molv_lv0004->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input  name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001" value="<?php echo $molv_lv0004->lv001;?>" />
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $molv_lv0004->lv002;?>" />					
					    
				  </form>
				  <form action="" name="frmcomtemp" method="post" target="_blank" enctype="multipart/form-data">
						<input type="hidden" name="txtlv001" id="txtlv001" />
						<input type="hidden" name="txtFlagControl" id="txtFlagControl" value="2" />
						<input type="hidden" name="curPg" id="curPg" value="">						
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
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
div.innerHTML='<?php echo $molv_lv0004->ArrPush[0];?>';	
</script>