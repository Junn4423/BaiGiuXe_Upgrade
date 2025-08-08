<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/hr_lv0001.php");

/////////////init object//////////////
$mohr_lv0001=new hr_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0001');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0019.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0001->ArrPush[0]=$vLangArr[11];
$mohr_lv0001->ArrPush[1]=$vLangArr[12];
$mohr_lv0001->ArrPush[2]=$vLangArr[13];
$mohr_lv0001->ArrPush[3]=$vLangArr[14];
$mohr_lv0001->ArrPush[4]=$vLangArr[17];
$mohr_lv0001->ArrPush[5]=$vLangArr[25];
$mohr_lv0001->ArrPush[6]=$vLangArr[18];
$mohr_lv0001->ArrPush[7]=$vLangArr[20];
$mohr_lv0001->ArrPush[8]=$vLangArr[19];
$mohr_lv0001->ArrPush[9]=$vLangArr[21];
$mohr_lv0001->ArrPush[10]=$vLangArr[22];
$mohr_lv0001->ArrPush[11]=$vLangArr[23];
$mohr_lv0001->ArrPush[12]=$vLangArr[24];
$mohr_lv0001->ArrPush[13]=$vLangArr[26];
$mohr_lv0001->ArrPush[14]=$vLangArr[27];
$mohr_lv0001->ArrPush[15]=$vLangArr[35];
$mohr_lv0001->ArrPush[16]=$vLangArr[36];
$mohr_lv0001->ArrPush[17]=$vLangArr[37];

$mohr_lv0001->ArrPush[202]='TK VCB';
$mohr_lv0001->ArrPush[203]='Tên chủ TK VCB';
$mohr_lv0001->ArrPush[204]='Ngân hàng VCB';

$mohr_lv0001->ArrPush[212]='TK SacomBank';
$mohr_lv0001->ArrPush[213]='Tên chủ TK SacomBank';
$mohr_lv0001->ArrPush[214]='Ngân hàng SacomBank';


$mohr_lv0001->ArrFunc[0]='//Function';
$mohr_lv0001->ArrFunc[1]=$vLangArr[2];
$mohr_lv0001->ArrFunc[2]=$vLangArr[4];
$mohr_lv0001->ArrFunc[3]=$vLangArr[6];
$mohr_lv0001->ArrFunc[4]=$vLangArr[7];
$mohr_lv0001->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mohr_lv0001->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mohr_lv0001->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mohr_lv0001->ArrFunc[8]=$vLangArr[8];
$mohr_lv0001->ArrFunc[9]=$vLangArr[10];
$mohr_lv0001->ArrFunc[10]=$vLangArr[0];
$mohr_lv0001->ArrFunc[11]=$vLangArr[30];
$mohr_lv0001->ArrFunc[12]=$vLangArr[31];
$mohr_lv0001->ArrFunc[13]=$vLangArr[32];
$mohr_lv0001->ArrFunc[14]=$vLangArr[33];
$mohr_lv0001->ArrFunc[15]=$vLangArr[34];
////Other
$mohr_lv0001->ArrOther[1]=$vLangArr[28];
$mohr_lv0001->ArrOther[2]=$vLangArr[29];
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
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0001->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0001",$lvMessage);
}
elseif($flagID==2)
{
$mohr_lv0001->lv001=$_POST['txtlv001'];
$mohr_lv0001->lv003=$_POST['txtlv003'];
$mohr_lv0001->lv004=$_POST['txtlv004'];
$mohr_lv0001->lv005=$_POST['txtlv005'];
$mohr_lv0001->lv006=$_POST['txtlv006'];
$mohr_lv0001->lv007=$_POST['txtlv007'];
$mohr_lv0001->lv008=$_POST['txtlv008'];
$mohr_lv0001->lv009=$_POST['txtlv009'];
$mohr_lv0001->lv010=$_POST['txtlv010'];
$mohr_lv0001->lv011=$_POST['txtlv011'];
$mohr_lv0001->lv012=$_POST['txtlv012'];
$mohr_lv0001->lv013=$_POST['txtlv013'];
$mohr_lv0001->lv014=$_POST['txtlv014'];
$mohr_lv0001->lv015=$_POST['txtlv015'];
$mohr_lv0001->lv016=$_POST['txtlv016'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0001->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0001->LV_UnAproval($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0001->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0001');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0001->ListView;$vOrderList=$mohr_lv0001->ListOrder;
$curPage = $mohr_lv0001->CurPage;
$maxRows =$mohr_lv0001->MaxRows;
$vOrderList=$mohr_lv0001->ListOrder;
$vSortNum=$mohr_lv0001->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0001->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0001',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0001->GetCount('');
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<script language="JavaScript" type="text/javascript">
<!--
function Fil()
{
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv015=<?php echo $_POST['txtlv016'];?>','filter');
}
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
	var str="<br><iframe height=850 marginheight=0 marginwidth=0 frameborder=0 src=\"hr_lv0001?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
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
	o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
	o.submit();
}
//-->
</script>
<?php
if($mohr_lv0001->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0001->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="0"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0001->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mohr_lv0001->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mohr_lv0001->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mohr_lv0001->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mohr_lv0001->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mohr_lv0001->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mohr_lv0001->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mohr_lv0001->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mohr_lv0001->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mohr_lv0001->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mohr_lv0001->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mohr_lv0001->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mohr_lv0001->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mohr_lv0001->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mohr_lv0001->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mohr_lv0001->lv016;?>"/>
					    
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
div.innerHTML='<?php echo $mohr_lv0001->ArrPush[0];?>';	
</script>