<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/jo_lv0012.php");

/////////////init object//////////////
$mojo_lv0012=new jo_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0012');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($mojo_lv0012->GetApr()==1)
{
if(isset($_GET['ajaxbangtext']))
{
	$vdonhangid=$_GET['donhangid'];
	$vText=$_GET['textup'];
	$voption=$_GET['optrun'];
	$vCondition="";
	if($vdonhangid!='' && $vdonhangid!=NULL)
	{
		$mojo_lv0012->LV_LoadID($vdonhangid);
		$vUserID=getInfor($_SESSION['ERPSOFV2RUserID'], 2);
		switch($voption)
		{
			case 10:
				$vsql="update jo_lv0004 set lv010='$vText' where lv001='$vdonhangid' and lv021>0 and lv006 =0";				
			break;
			case 18:
				$vText = ($vText!="")?recoverdate(($vText), $plang).' '.substr(trim($vText),11,8):$this->DateDefault;
				$vsql="update jo_lv0004 set lv018='$vText' where lv001='$vdonhangid' and lv021>0 and lv006 =0";				
			break;
			case 19:
				$vText = ($vText!="")?recoverdate(($vText), $plang).' '.substr(trim($vText),11,8):$this->DateDefault;
				$vsql="update jo_lv0004 set lv019='$vText' where lv001='$vdonhangid' and lv021>0 and lv006 =0 ";							
				break;

		}
		
		$vresult=db_query($vsql);
	}
	exit;
}
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","JO0005.txt",$plang);
$mojo_lv0012->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mojo_lv0012->ArrPush[0]=$vLangArr[17];
$mojo_lv0012->ArrPush[1]=$vLangArr[18];
$mojo_lv0012->ArrPush[2]=$vLangArr[19];
$mojo_lv0012->ArrPush[3]=$vLangArr[20];
$mojo_lv0012->ArrPush[4]=$vLangArr[21];
$mojo_lv0012->ArrPush[5]=$vLangArr[22];
$mojo_lv0012->ArrPush[6]=$vLangArr[23];
$mojo_lv0012->ArrPush[7]=$vLangArr[24];
$mojo_lv0012->ArrPush[8]=$vLangArr[25];
$mojo_lv0012->ArrPush[9]=$vLangArr[26];
$mojo_lv0012->ArrPush[10]=$vLangArr[27];
$mojo_lv0012->ArrPush[11]=$vLangArr[28];
$mojo_lv0012->ArrPush[12]=$vLangArr[29];
$mojo_lv0012->ArrPush[13]=$vLangArr[30];
$mojo_lv0012->ArrPush[14]=$vLangArr[31];
$mojo_lv0012->ArrPush[15]=$vLangArr[32];
$mojo_lv0012->ArrPush[16]=$vLangArr[33];
$mojo_lv0012->ArrPush[17]=$vLangArr[34];
$mojo_lv0012->ArrPush[18]=$vLangArr[35];
$mojo_lv0012->ArrPush[19]=$vLangArr[36];
$mojo_lv0012->ArrPush[20]=$vLangArr[37];
$mojo_lv0012->ArrPush[21]=$vLangArr[38];
$mojo_lv0012->ArrPush[22]=$vLangArr[39];
$mojo_lv0012->ArrPush[23]=$vLangArr[40];
$mojo_lv0012->ArrPush[24]=$vLangArr[41];
$mojo_lv0012->ArrPush[26]='Ngày giờ tạo';
$mojo_lv0012->ArrPush[99]='Số ngày/lần/số giờ';
$mojo_lv0012->ArrPush[100]='Tên';
$mojo_lv0012->ArrPush[830]='Phòng ban';
$mojo_lv0012->ArrPush[200]='Chức năng';

$mojo_lv0012->ArrFunc[0]='//Function';
$mojo_lv0012->ArrFunc[1]=$vLangArr[2];
$mojo_lv0012->ArrFunc[2]=$vLangArr[4];
$mojo_lv0012->ArrFunc[3]=$vLangArr[6];
$mojo_lv0012->ArrFunc[4]=$vLangArr[7];
$mojo_lv0012->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mojo_lv0012->ArrFunc[6]=(($plang=='VN')?'Duyệt':'Approval');
$mojo_lv0012->ArrFunc[7]=(($plang=='VN')?'Không duyệt':'UnApproval');
$mojo_lv0012->ArrFunc[8]=$vLangArr[10];
$mojo_lv0012->ArrFunc[9]=$vLangArr[12];
$mojo_lv0012->ArrFunc[10]=$vLangArr[0];
$mojo_lv0012->ArrFunc[11]=$vLangArr[44];
$mojo_lv0012->ArrFunc[12]=$vLangArr[45];
$mojo_lv0012->ArrFunc[13]=$vLangArr[46];
$mojo_lv0012->ArrFunc[14]=$vLangArr[47];
$mojo_lv0012->ArrFunc[15]=$vLangArr[48];

////Other
$mojo_lv0012->ArrOther[1]=$vLangArr[42];
$mojo_lv0012->ArrOther[2]=$vLangArr[43];
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
	$vresult=$mojo_lv0012->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"jo_lv0012",$lvMessage);
}
elseif($flagID==2)
{
$mojo_lv0012->lv001=$_POST['txtlv001'];
$mojo_lv0012->lv002=$_POST['txtlv002'];
$mojo_lv0012->lv003=$_POST['txtlv003'];
$mojo_lv0012->lv004=$_POST['txtlv004'];
$mojo_lv0012->lv005=$_POST['txtlv005'];
$mojo_lv0012->lv006=$_POST['txtlv006'];
$mojo_lv0012->lv007=$_POST['txtlv007'];
$mojo_lv0012->lv008=$_POST['txtlv008'];
$mojo_lv0012->lv009=$_POST['txtlv009'];
$mojo_lv0012->lv010=$_POST['txtlv010'];
$mojo_lv0012->lv011=$_POST['txtlv011'];
$mojo_lv0012->lv012=$_POST['txtlv012'];
$mojo_lv0012->lv013=$_POST['txtlv013'];
$mojo_lv0012->lv014=$_POST['txtlv014'];
$mojo_lv0012->lv015=$_POST['txtlv015'];
$mojo_lv0012->lv016=$_POST['txtlv016'];
$mojo_lv0012->lv017=$_POST['txtlv017'];
$mojo_lv0012->lv018=$_POST['txtlv018'];
$mojo_lv0012->lv019=$_POST['txtlv019'];
$mojo_lv0012->lv020=$_POST['txtlv020'];
$mojo_lv0012->lv021=$_POST['txtlv021'];
$mojo_lv0012->lv022=$_POST['txtlv022'];
$mojo_lv0012->lv023=$_POST['txtlv023'];
$mojo_lv0012->lv024=$_POST['txtlv024'];
$mojo_lv0012->lv025=$_POST['txtlv025'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mojo_lv0012->LV_Aproval($strar);
}
elseif($flagID==13)
{
	$strar=$strchk;
	$vresult=$mojo_lv0012->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mojo_lv0012->LV_UnAproval($strar);
}
elseif($flagID==14)
{
	$strar=$strchk;
	$vresult=$mojo_lv0012->LV_UnAproval($strar);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$mojo_lv0012->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0012');
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$vFieldList=$mojo_lv0012->ListView;
	$curPage = $mojo_lv0012->CurPage;
	$maxRows =$mojo_lv0012->MaxRows;
	$vOrderList=$mojo_lv0012->ListOrder;
	$vSortNum=$mojo_lv0012->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
	$maxRows =(int)$_POST['lvmaxrow'];
	$vSortNum=(int)$_POST['lvsort'];
	$mojo_lv0012->SaveOperation($_SESSION['ERPSOFV2RUserID'],'jo_lv0012',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
//$mojo_lv0012->lv014=getInfor($_SESSION['ERPSOFV2RUserID'],2);
//$mojo_lv0012->lv004="1";

$mojo_lv0012->lv006="0";
$totalRowsC=$mojo_lv0012->GetCount();
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
			var str="<br><iframe height=1900 marginheight=0 marginwidth=0 frameborder=0 src=jo_lv0012?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe height=1900 marginheight=0 marginwidth=0 frameborder=0 src=jo_lv0012?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
	}
	
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function AprQLy(vValue)
{
	if(confirm("Bạn có muốn duyệt đơn này?(Y/N)"))
	{
		ApprovalsOne(vValue)
	}
}
function ApprovalsOne(vValue)
{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=13;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();
}
function Approvals(vValue)
{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=3;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();
}
function UnApr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function UnAprQLy(vValue)
{
	if(confirm("Bạn có muốn không duyệt đơn này?(Y/N)"))
	{
		UnApprovalsOne(vValue)
	}
}
function UnApprovalsOne(vValue)
{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=14;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();
}
function UnApprovals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();
}
function Rpt()
{
	lv_chk_list(document.frmchoose,'lvChk',4);
}
function Report(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>jo_lv0004?func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
//-->
</script>
<?php
if($mojo_lv0012->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mojo_lv0012->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mojo_lv0012->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mojo_lv0012->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mojo_lv0012->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mojo_lv0012->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mojo_lv0012->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mojo_lv0012->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mojo_lv0012->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mojo_lv0012->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mojo_lv0012->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mojo_lv0012->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mojo_lv0012->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mojo_lv0012->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mojo_lv0012->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mojo_lv0012->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mojo_lv0012->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mojo_lv0012->lv016;?>"/>
                        <input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mojo_lv0012->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $mojo_lv0012->lv018;?>"/>
						<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $mojo_lv0012->lv019;?>"/>
						<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $mojo_lv0012->lv020;?>"/>
						<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $mojo_lv0012->lv021;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $mojo_lv0012->lv022;?>"/>
						<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $mojo_lv0012->lv023;?>"/>
						<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $mojo_lv0012->lv024;?>"/>
						<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $mojo_lv0012->lv025;?>"/>					    
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
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mojo_lv0012->ArrPush[0];?>';	
function UpdateText(o,donhangid,option)
{
	$xmlhttp555=null;		
	xmlhttp555=GetXmlHttpObject();
	if (xmlhttp555==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+o.value+"&optrun="+option;
	url=url.replace("#","");
	xmlhttp555.onreadystatechange=stateactivebangtext;
	xmlhttp555.open("GET",url,true);
	xmlhttp555.send(null);	
}
function stateactivebangtext()
{
}
function GetXmlHttpObject()
	{
		if (window.XMLHttpRequest)
		{
		  // code for IE7+, Firefox, Chrome, Opera, Safari
			return new XMLHttpRequest();
		}
		if (window.ActiveXObject)
		{
		  // code for IE6, IE5
			return new ActiveXObject("Microsoft.XMLHTTP");
		}
		return null;
	}
</script>