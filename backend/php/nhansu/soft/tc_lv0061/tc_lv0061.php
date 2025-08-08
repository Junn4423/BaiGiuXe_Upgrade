<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/tc_lv0061.php");

/////////////init object//////////////
$motc_lv0061=new tc_lv0061($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0061');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","TC0100.txt",$plang);
$motc_lv0061->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0061->ArrPush[0]=$vLangArr[17];
$motc_lv0061->ArrPush[1]=$vLangArr[18];
$motc_lv0061->ArrPush[2]=$vLangArr[19];
$motc_lv0061->ArrPush[3]=$vLangArr[20];
$motc_lv0061->ArrPush[4]=$vLangArr[21];
$motc_lv0061->ArrPush[5]=$vLangArr[22];
$motc_lv0061->ArrPush[6]=$vLangArr[23];
$motc_lv0061->ArrPush[7]=$vLangArr[24];
$motc_lv0061->ArrPush[8]=$vLangArr[25];
$motc_lv0061->ArrPush[9]=$vLangArr[26];
$motc_lv0061->ArrPush[10]=$vLangArr[27];

$motc_lv0061->ArrFunc[0]='//Function';
$motc_lv0061->ArrFunc[1]=$vLangArr[2];
$motc_lv0061->ArrFunc[2]=$vLangArr[4];
$motc_lv0061->ArrFunc[3]=$vLangArr[6];
$motc_lv0061->ArrFunc[4]=$vLangArr[7];
$motc_lv0061->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$motc_lv0061->ArrFunc[6]=GetLangExcept('Apr',$plang);
$motc_lv0061->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$motc_lv0061->ArrFunc[8]=$vLangArr[10];
$motc_lv0061->ArrFunc[9]=$vLangArr[12];
$motc_lv0061->ArrFunc[10]=$vLangArr[0];
$motc_lv0061->ArrFunc[11]=$vLangArr[28];
$motc_lv0061->ArrFunc[12]=$vLangArr[29];
$motc_lv0061->ArrFunc[13]=$vLangArr[30];
$motc_lv0061->ArrFunc[14]=$vLangArr[31];
$motc_lv0061->ArrFunc[15]=$vLangArr[32];

////Other
$motc_lv0061->ArrOther[1]=$vLangArr[26];
$motc_lv0061->ArrOther[2]=$vLangArr[27];
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
	$vresult=$motc_lv0061->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"tc_lv0061",$lvMessage);
}
elseif($flagID==2)
{
$motc_lv0061->lv001=$_POST['txtlv001'];
$motc_lv0061->lv002=$_POST['txtlv002'];
$motc_lv0061->lv003=$_POST['txtlv003'];
$motc_lv0061->lv004=$_POST['txtlv004'];
$motc_lv0061->lv005=$_POST['txtlv005'];
$motc_lv0061->lv006=$_POST['txtlv006'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0061->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0061->LV_UnAproval($strar);
}
elseif($flagID==10)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0061->LV_CheckUpdateRate($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0061->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0061');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0061->ListView;
$curPage = $motc_lv0061->CurPage;
$maxRows =$motc_lv0061->MaxRows;
$vOrderList=$motc_lv0061->ListOrder;
$vSortNum=$motc_lv0061->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$motc_lv0061->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0061',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
if($motc_lv0061->GetApr()<>1)
{
 $motc_lv0061->lv004=getInfor($_SESSION['ERPSOFV2RUserID'],2);
}
$totalRowsC=$motc_lv0061->GetCount();
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
			var str="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src=\"tc_lv0061?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<iframe id='lvframefrm' height='"+oheight+"' marginheight=0 marginwidth=0 frameborder=0 src=\"tc_lv0061?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
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
	o.action="<?php echo $vDir;?>tc_lv0061?func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
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
if($motc_lv0061->GetView()==1)
{
?>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					  <?php
						if($motc_lv0061->GetApr()==1)
						{?>
												<td><input type="button" value="<?php echo 'Cập nhật thêm nhân viên đánh giá';?>" onclick="UpToStaffRate()"/></td>
						<?php
						}
						?>
						<?php echo $motc_lv0061->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $motc_lv0061->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $motc_lv0061->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $motc_lv0061->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $motc_lv0061->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $motc_lv0061->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $motc_lv0061->lv006;?>"/>
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
div.innerHTML='<?php echo $motc_lv0061->ArrPush[0];?>';	
</script>