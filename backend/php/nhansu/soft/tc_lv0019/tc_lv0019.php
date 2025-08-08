<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/tc_lv0019.php");

/////////////init object//////////////
$motc_lv0019=new tc_lv0019($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0019');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0025.txt",$plang);
$motc_lv0019->lang=strtoupper($plang);
if(isset($_POST['txtlv009']))
$motc_lv0019->lv009=$_POST['txtlv009'];
else
{
 $_POST['txtlv009']="0,1,5";
$motc_lv0019->lv009=$_POST['txtlv009'];
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0019->ArrPush[0]=$vLangArr[16];
$motc_lv0019->ArrPush[1]=$vLangArr[18];
$motc_lv0019->ArrPush[2]=$vLangArr[19];
$motc_lv0019->ArrPush[3]=$vLangArr[20];
$motc_lv0019->ArrPush[4]=$vLangArr[21];
$motc_lv0019->ArrPush[5]=$vLangArr[22];
$motc_lv0019->ArrPush[6]=$vLangArr[23];
$motc_lv0019->ArrPush[7]=$vLangArr[24];
$motc_lv0019->ArrPush[8]=$vLangArr[25];
$motc_lv0019->ArrPush[9]=$vLangArr[26];
$motc_lv0019->ArrPush[10]=$vLangArr[27];
$motc_lv0019->ArrPush[11]=$vLangArr[28];
$motc_lv0019->ArrPush[12]=$vLangArr[29];
$motc_lv0019->ArrPush[13]=$vLangArr[30];
$motc_lv0019->ArrPush[14]=$vLangArr[31];
$motc_lv0019->ArrPush[15]=$vLangArr[32];
$motc_lv0019->ArrPush[16]=$vLangArr[33];
$motc_lv0019->ArrPush[17]=$vLangArr[34];
$motc_lv0019->ArrPush[18]=$vLangArr[35];
$motc_lv0019->ArrPush[19]=$vLangArr[36];
$motc_lv0019->ArrPush[20]=$vLangArr[37];
$motc_lv0019->ArrPush[21]=$vLangArr[38];
$motc_lv0019->ArrPush[22]=$vLangArr[39];
$motc_lv0019->ArrPush[23]=$vLangArr[40];
$motc_lv0019->ArrPush[24]=$vLangArr[41];
$motc_lv0019->ArrPush[25]=$vLangArr[42];
$motc_lv0019->ArrPush[26]=$vLangArr[43];
$motc_lv0019->ArrPush[27]=$vLangArr[44];
$motc_lv0019->ArrPush[28]=$vLangArr[45];
$motc_lv0019->ArrPush[29]=$vLangArr[46];
$motc_lv0019->ArrPush[30]=$vLangArr[47];
$motc_lv0019->ArrPush[31]=$vLangArr[48];
$motc_lv0019->ArrPush[32]=$vLangArr[49];
$motc_lv0019->ArrPush[33]=$vLangArr[50];
$motc_lv0019->ArrPush[34]=$vLangArr[51];
$motc_lv0019->ArrPush[35]=$vLangArr[52];
$motc_lv0019->ArrPush[36]=$vLangArr[53];
$motc_lv0019->ArrPush[37]=$vLangArr[54];
$motc_lv0019->ArrPush[38]=$vLangArr[55];
$motc_lv0019->ArrPush[39]=$vLangArr[56];
$motc_lv0019->ArrPush[40]=$vLangArr[57];
$motc_lv0019->ArrPush[41]=$vLangArr[58];
$motc_lv0019->ArrPush[42]=$vLangArr[59];
$motc_lv0019->ArrPush[43]=$vLangArr[60];
$motc_lv0019->ArrPush[44]=$vLangArr[61];
$motc_lv0019->ArrPush[45]=$vLangArr[62];
	



$motc_lv0019->ArrFunc[0]='//Function';
$motc_lv0019->ArrFunc[1]=$vLangArr[2];
$motc_lv0019->ArrFunc[2]=$vLangArr[4];
$motc_lv0019->ArrFunc[3]=$vLangArr[6];
$motc_lv0019->ArrFunc[4]=$vLangArr[7];
$motc_lv0019->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$motc_lv0019->ArrFunc[6]=GetLangExcept('Apr',$plang);
$motc_lv0019->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$motc_lv0019->ArrFunc[8]=$vLangArr[10];
$motc_lv0019->ArrFunc[9]=$vLangArr[12];
$motc_lv0019->ArrFunc[10]=$vLangArr[0];
$motc_lv0019->ArrFunc[11]=$vLangArr[65];
$motc_lv0019->ArrFunc[12]=$vLangArr[66];
$motc_lv0019->ArrFunc[13]=$vLangArr[67];
$motc_lv0019->ArrFunc[14]=$vLangArr[68];
$motc_lv0019->ArrFunc[15]=$vLangArr[69];

////Other
$motc_lv0019->ArrOther[1]=$vLangArr[63];
$motc_lv0019->ArrOther[2]=$vLangArr[64];
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
	$vresult=$motc_lv0019->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"tc_lv0019",$lvMessage);
}
elseif($flagID==2)
{
$motc_lv0019->lv001=$_POST['txtlv001'];
$motc_lv0019->lv002=$_POST['txtlv002'];
$motc_lv0019->lv003=$_POST['txtlv003'];
$motc_lv0019->lv004=$_POST['txtlv004'];
$motc_lv0019->lv005=$_POST['txtlv005'];
$motc_lv0019->lv006=$_POST['txtlv006'];
$motc_lv0019->lv007=$_POST['txtlv007'];
$motc_lv0019->lv008=$_POST['txtlv008'];
$motc_lv0019->lv009=$_POST['txtlv009'];
$motc_lv0019->lv010=$_POST['txtlv010'];
$motc_lv0019->lv011=$_POST['txtlv011'];
$motc_lv0019->lv012=$_POST['txtlv012'];
$motc_lv0019->lv013=$_POST['txtlv013'];
$motc_lv0019->lv014=$_POST['txtlv014'];
$motc_lv0019->lv015=$_POST['txtlv015'];
$motc_lv0019->lv016=$_POST['txtlv016'];
$motc_lv0019->lv017=$_POST['txtlv017'];
$motc_lv0019->lv018=$_POST['txtlv018'];
$motc_lv0019->lv019=$_POST['txtlv019'];
$motc_lv0019->lv020=$_POST['txtlv020'];
$motc_lv0019->lv021=$_POST['txtlv021'];
$motc_lv0019->lv022=$_POST['txtlv022'];
$motc_lv0019->lv023=$_POST['txtlv023'];
$motc_lv0019->lv024=$_POST['txtlv024'];
$motc_lv0019->lv025=$_POST['txtlv025'];
$motc_lv0019->lv026=$_POST['txtlv026'];
$motc_lv0019->lv027=$_POST['txtlv027'];
$motc_lv0019->lv028=$_POST['txtlv028'];
$motc_lv0019->lv029=$_POST['txtlv029'];
$motc_lv0019->lv030=$_POST['txtlv030'];
$motc_lv0019->lv031=$_POST['txtlv031'];
$motc_lv0019->lv032=$_POST['txtlv032'];
$motc_lv0019->lv033=$_POST['txtlv033'];
$motc_lv0019->lv034=$_POST['txtlv034'];
$motc_lv0019->lv035=$_POST['txtlv035'];
$motc_lv0019->lv036=$_POST['txtlv036'];
$motc_lv0019->lv037=$_POST['txtlv037'];
$motc_lv0019->lv038=$_POST['txtlv038'];
$motc_lv0019->lv039=$_POST['txtlv039'];
$motc_lv0019->lv040=$_POST['txtlv040'];
$motc_lv0019->lv041=$_POST['txtlv041'];
$motc_lv0019->lv042=$_POST['txtlv042'];
$motc_lv0019->lv043=$_POST['txtlv043'];
$motc_lv0019->lv044=$_POST['txtlv044'];
$motc_lv0019->FullName=$_POST['txtFullName'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0019->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0019');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0019->ListView;
$curPage = $motc_lv0019->CurPage;
$maxRows =$motc_lv0019->MaxRows;
$vOrderList=$motc_lv0019->ListOrder;
$vSortNum=$motc_lv0019->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$motc_lv0019->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0019',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
$motc_lv0019->FullName=$_POST['txtFullName'];
if($motc_lv0019->GetApr()==0)  $motc_lv0019->lv029=$motc_lv0019->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$totalRowsC=$motc_lv0019->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv015=<?php echo $_POST['txtlv016'];?>&lv017=<?php echo $_POST['txtlv017'];?>&lv018=<?php echo $_POST['txtlv018'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv020=<?php echo $_POST['txtlv020'];?>&lv021=<?php echo $_POST['txtlv021'];?>&lv022=<?php echo $_POST['txtlv022'];?>&lv023=<?php echo $_POST['txtlv023'];?>&lv024=<?php echo $_POST['txtlv024'];?>&lv025=<?php echo $_POST['txtlv025'];?>&lv026=<?php echo $_POST['txtlv026'];?>&lv027=<?php echo $_POST['txtlv027'];?>&lv028=<?php echo $_POST['txtlv028'];?>&lv029=<?php echo $_POST['txtlv029'];?>&lv030=<?php echo $_POST['txtlv030'];?>&lv031=<?php echo $_POST['txtlv022'];?>&lv033=<?php echo $_POST['txtlv033'];?>&lv034=<?php echo $_POST['txtlv034'];?>&lv035=<?php echo $_POST['txtlv035'];?>&lv036=<?php echo $_POST['txtlv036'];?>&lv037=<?php echo $_POST['txtlv037'];?>&lv038=<?php echo $_POST['txtlv038'];?>&lv039=<?php echo $_POST['txtlv039'];?>&lv040=<?php echo $_POST['txtlv040'];?>&lv041=<?php echo $_POST['txtlv041'];?>&lv042=<?php echo $_POST['txtlv042'];?>&lv043=<?php echo $_POST['txtlv043'];?>&lv044=<?php echo $_POST['txtlv044'];?>','filter');
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
			var str="<br><iframe height=1400 marginheight=0 marginwidth=0 frameborder=0 src=tc_lv0019?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe height=1600 marginheight=0 marginwidth=0 frameborder=0 src=tc_lv0019?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	o.txtID.value=vValue;
	o.action="<?php echo $vDir;?>tc_lv0019/?func=rpt&lang=<?php echo $plang;?>";
	o.submit();
}
function ChangeInfor()
{
var o1=document.frmchoose;
 	o1.submit();
}
function CheckEnter(e)
{
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="13")
	{
		ChangeInfor();
	}
}
//-->
</script>
<?php
if($motc_lv0019->GetView()==1)
{
?>
<link rel="stylesheet" href="../css/popup.css" type="text/css">
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#f2f2f2;font:10px arial"><tr><td><?php echo $vLangArr[19];?> <input type="text" name="txtlv001" id="txtlv001" tabindex="1" value="<?php echo $motc_lv0019->lv001;?>" onchange="ChangeInfor()"/>
						&nbsp;&nbsp;&nbsp;</td><td><?php echo $vLangArr[20];?></td><td>
							  <ul lang="pop-nav1" onmouseover="ChangeName(this,1)" id="pop-nav"> <li class="menupopT"> <input onKeyPress="return CheckEnter(event)"  name="txtFullName" id="txtFullName" autocomplete="off"  tabindex="9" maxlength="255" style="width:100%" value="<?php echo $motc_lv0019->FullName;?>" onKeyUp="LoadSelfNextParent(this,'txtFullName','hr_lv0020','lv002','lv002')" onFocus="LoadSelfNextParent(this,'txtFullName','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)','concat(@! @!,lv004,@! @!,lv003,@! @!,lv002)')"/><div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td><td>&nbsp;&nbsp;&nbsp;<?php echo $vLangArr[28];?> <input type="text"  tabindex="1" name="txtlv010" id="txtlv010" value="<?php echo $motc_lv0019->lv010;?>" onChange="ChangeInfor()"/></td></tr></table>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $motc_lv0019->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $motc_lv0019->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $motc_lv0019->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $motc_lv0019->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $motc_lv0019->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $motc_lv0019->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $motc_lv0019->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $motc_lv0019->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $motc_lv0019->lv009;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $motc_lv0019->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $motc_lv0019->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $motc_lv0019->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $motc_lv0019->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $motc_lv0019->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $motc_lv0019->lv016;?>"/>
						<input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $motc_lv0019->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $motc_lv0019->lv018;?>"/>
						<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $motc_lv0019->lv019;?>"/>
						<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $motc_lv0019->lv020;?>"/>
						<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $motc_lv0019->lv021;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $motc_lv0019->lv022;?>"/>
						<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $motc_lv0019->lv023;?>"/>
						<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $motc_lv0019->lv024;?>"/>
						<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $motc_lv0019->lv025;?>"/>
						<input type="hidden" name="txtlv026" id="txtlv026" value="<?php echo $motc_lv0019->lv026;?>"/>
						<input type="hidden" name="txtlv027" id="txtlv027" value="<?php echo $motc_lv0019->lv027;?>"/>
						<input type="hidden" name="txtlv028" id="txtlv028" value="<?php echo $motc_lv0019->lv028;?>"/>
						<input type="hidden" name="txtlv029" id="txtlv029" value="<?php echo $motc_lv0019->lv029;?>"/>
						<input type="hidden" name="txtlv030" id="txtlv030" value="<?php echo $motc_lv0019->lv030;?>"/>
						<input type="hidden" name="txtlv031" id="txtlv031" value="<?php echo $motc_lv0019->lv031;?>"/>
						<input type="hidden" name="txtlv032" id="txtlv032" value="<?php echo $motc_lv0019->lv032;?>"/>
						<input type="hidden" name="txtlv033" id="txtlv033" value="<?php echo $motc_lv0019->lv033;?>"/>
						<input type="hidden" name="txtlv034" id="txtlv034" value="<?php echo $motc_lv0019->lv034;?>"/>
						<input type="hidden" name="txtlv035" id="txtlv035" value="<?php echo $motc_lv0019->lv035;?>"/>
						<input type="hidden" name="txtlv036" id="txtlv036" value="<?php echo $motc_lv0019->lv036;?>"/>
						<input type="hidden" name="txtlv037" id="txtlv037" value="<?php echo $motc_lv0019->lv037;?>"/>
						<input type="hidden" name="txtlv038" id="txtlv038" value="<?php echo $motc_lv0019->lv038;?>"/>
						<input type="hidden" name="txtlv039" id="txtlv039" value="<?php echo $motc_lv0019->lv039;?>"/>
						<input type="hidden" name="txtlv040" id="txtlv040" value="<?php echo $motc_lv0019->lv040;?>"/>
						<input type="hidden" name="txtlv041" id="txtlv041" value="<?php echo $motc_lv0019->lv041;?>"/>
						<input type="hidden" name="txtlv042" id="txtlv042" value="<?php echo $motc_lv0019->lv042;?>"/>
						<input type="hidden" name="txtlv043" id="txtlv043" value="<?php echo $motc_lv0019->lv043;?>"/>
						<input type="hidden" name="txtlv044" id="txtlv044" value="<?php echo $motc_lv0019->lv044;?>"/>

					    
				  </form>
				  <form method="post" action="<?php echo $vDir;?>tc_lv0019?func=rpt&lang=<?php echo $plang;?>" name="frmprocess" > 
				  		<input type="hidden" name="txtID" type="hidden" id="txtID" />
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
div.innerHTML='<?php echo $motc_lv0019->ArrPush[0];?>';	
</script>