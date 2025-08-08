<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/lv_lv0005.php");

/////////////init object//////////////
$molv_lv0005=new lv_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0009');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0011.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0005->ArrPush[0]=$vLangArr[17];
$molv_lv0005->ArrPush[1]=$vLangArr[18];
$molv_lv0005->ArrPush[2]=$vLangArr[20];
$molv_lv0005->ArrPush[3]=$vLangArr[21];
$molv_lv0005->ArrPush[4]=$vLangArr[22];
$molv_lv0005->ArrPush[5]=$vLangArr[23];
$molv_lv0005->ArrPush[6]=$vLangArr[24];
$molv_lv0005->ArrPush[7]=$vLangArr[25];
$molv_lv0005->ArrPush[8]=$vLangArr[26];

$molv_lv0005->ArrFunc[0]='//Function';
$molv_lv0005->ArrFunc[1]=$vLangArr[2];
$molv_lv0005->ArrFunc[2]=$vLangArr[4];
$molv_lv0005->ArrFunc[3]=$vLangArr[6];
$molv_lv0005->ArrFunc[4]=$vLangArr[7];
$molv_lv0005->ArrFunc[5]='';
$molv_lv0005->ArrFunc[6]='';
$molv_lv0005->ArrFunc[7]='';
$molv_lv0005->ArrFunc[8]=$vLangArr[10];
$molv_lv0005->ArrFunc[9]=$vLangArr[12];
$molv_lv0005->ArrFunc[10]=$vLangArr[0];
$molv_lv0005->ArrFunc[11]=$vLangArr[28];
////Other
$molv_lv0005->ArrOther[1]=$vLangArr[26];
$molv_lv0005->ArrOther[2]=$vLangArr[27];
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
	$vresult=$molv_lv0005->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"lv_lv0005",$lvMessage);
}
elseif($flagID==2)
{
$molv_lv0005->lv001=$_POST['txtlv001'];
$molv_lv0005->lv002=$_POST['txtlv002'];
$molv_lv0005->lv003=$_POST['txtlv003'];
$molv_lv0005->lv004=$_POST['txtlv004'];
$molv_lv0005->lv005=$_POST['txtlv005'];
$molv_lv0005->lv006=$_POST['txtlv006'];
}
if($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0005->LV_DeleteAdmin($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0005->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0005');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$molv_lv0005->ListView;
$curPage = $molv_lv0005->CurPage;
$maxRows =$molv_lv0005->MaxRows;
$vOrderList=$molv_lv0005->ListOrder;
$vSortNum=$molv_lv0005->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$molv_lv0005->SaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0005',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$molv_lv0005->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>','filter');
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
	var str="<br><iframe id='lvframefrm' height=300 marginheight=0 marginwidth=0 frameborder=0 src=lv_lv0005?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($molv_lv0005->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $molv_lv0005->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $molv_lv0005->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $molv_lv0005->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $molv_lv0005->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $molv_lv0005->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $molv_lv0005->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $molv_lv0005->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $molv_lv0005->lv007;?>"/>
					    
				  </form>
				  
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../lv_lv0005/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $molv_lv0005->ArrPush[0];?>';	
</script>