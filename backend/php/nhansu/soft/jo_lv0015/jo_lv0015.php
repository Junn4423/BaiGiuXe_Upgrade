<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/jo_lv0015.php");

/////////////init object//////////////
$mojo_lv0015=new  jo_lv0015($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0015');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","JO0007.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0015->ArrPush[0]=$vLangArr[17];
$mojo_lv0015->ArrPush[1]=$vLangArr[18];
$mojo_lv0015->ArrPush[2]=$vLangArr[20];
$mojo_lv0015->ArrPush[3]=$vLangArr[21];

$mojo_lv0015->ArrFunc[0]='//Function';
$mojo_lv0015->ArrFunc[1]=$vLangArr[2];
$mojo_lv0015->ArrFunc[2]=$vLangArr[4];
$mojo_lv0015->ArrFunc[3]=$vLangArr[6];
$mojo_lv0015->ArrFunc[4]=$vLangArr[7];
$mojo_lv0015->ArrFunc[5]='';
$mojo_lv0015->ArrFunc[6]='';
$mojo_lv0015->ArrFunc[7]='';
$mojo_lv0015->ArrFunc[8]=$vLangArr[10];
$mojo_lv0015->ArrFunc[9]=$vLangArr[12];
$mojo_lv0015->ArrFunc[10]=$vLangArr[0];
$mojo_lv0015->ArrFunc[11]=$vLangArr[24];
$mojo_lv0015->ArrFunc[12]=$vLangArr[25];
$mojo_lv0015->ArrFunc[13]=$vLangArr[26];
$mojo_lv0015->ArrFunc[14]=$vLangArr[27];
$mojo_lv0015->ArrFunc[15]=$vLangArr[28];
////Other
$mojo_lv0015->ArrOther[1]=$vLangArr[22];
$mojo_lv0015->ArrOther[2]=$vLangArr[23];
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
	$vresult=$mojo_lv0015->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"jo_lv0015",$lvMessage);
}
elseif($flagID==2)
{
$mojo_lv0015->lv001=$_POST['txtlv001'];
$mojo_lv0015->lv002=$_POST['txtlv002'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0015->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0015');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mojo_lv0015->ListView;
$curPage = $mojo_lv0015->CurPage;
$maxRows =$mojo_lv0015->MaxRows;
$vOrderList=$mojo_lv0015->ListOrder;
$vSortNum=$mojo_lv0015->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mojo_lv0015->SaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0015',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mojo_lv0015->GetCount('');
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
	var str="<br><iframe height=200 marginheight=0 marginwidth=0 frameborder=0 src= jo_lv0015?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($mojo_lv0015->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mojo_lv0015->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input  name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mojo_lv0015->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mojo_lv0015->lv002;?>"/>					
					    
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
div.innerHTML='<?php echo $mojo_lv0015->ArrPush[0];?>';	
</script>