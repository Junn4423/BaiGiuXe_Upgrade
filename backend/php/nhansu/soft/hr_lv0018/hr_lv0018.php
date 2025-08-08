<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/hr_lv0018.php");

/////////////init object//////////////
$mohr_lv0018=new hr_lv0018($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0037');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($mohr_lv0018->GetEdit()>0)
{
	
if(isset($_GET['ajaxbangtext']))
	{
		$vdonhangid=$_GET['donhangid'];
		$vText=$_GET['textup'];
		$voption=(int)$_GET['optrun'];
		if($vdonhangid!='' && $vdonhangid!=NULL)
		{
			$vlvField='lv'.Fillnum($voption,3);
			switch($voption)
			{
				case 3:
					$vsql="update hr_lv0018 set $vlvField='$vText' where lv001='$vdonhangid'";
					$mohr_lv0018->LV_UpdateChangeChild($vsql);
					break;
			}
			

		}
		exit;
	}
}
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","HR0088.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0018->ArrPush[0]=$vLangArr[16];
$mohr_lv0018->ArrPush[1]=$vLangArr[17];
$mohr_lv0018->ArrPush[2]=$vLangArr[19];
$mohr_lv0018->ArrPush[3]=$vLangArr[20];
$mohr_lv0018->ArrPush[4]=$vLangArr[21];
$mohr_lv0018->ArrPush[5]=$vLangArr[22];
$mohr_lv0018->ArrPush[6]=$vLangArr[23];
$mohr_lv0018->ArrPush[7]=$vLangArr[24];
$mohr_lv0018->ArrPush[8]=$vLangArr[25];

$mohr_lv0018->ArrFunc[0]='//Function';
$mohr_lv0018->ArrFunc[1]=$vLangArr[2];
$mohr_lv0018->ArrFunc[2]=$vLangArr[4];
$mohr_lv0018->ArrFunc[3]=$vLangArr[6];
$mohr_lv0018->ArrFunc[4]=$vLangArr[7];
$mohr_lv0018->ArrFunc[5]='';
$mohr_lv0018->ArrFunc[6]='';
$mohr_lv0018->ArrFunc[7]='';
$mohr_lv0018->ArrFunc[8]=$vLangArr[8];
$mohr_lv0018->ArrFunc[9]=$vLangArr[11];
$mohr_lv0018->ArrFunc[10]=$vLangArr[0];
$mohr_lv0018->ArrFunc[11]=$vLangArr[28];
$mohr_lv0018->ArrFunc[12]=$vLangArr[29];
$mohr_lv0018->ArrFunc[13]=$vLangArr[30];
$mohr_lv0018->ArrFunc[14]=$vLangArr[31];
$mohr_lv0018->ArrFunc[15]=$vLangArr[32];
////Other
$mohr_lv0018->ArrOther[1]=$vLangArr[26];
$mohr_lv0018->ArrOther[2]=$vLangArr[27];
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
	$vresult=$mohr_lv0018->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0018",$lvMessage);
}
elseif($flagID==2)
{
$mohr_lv0018->lv001=$_POST['txtlv001'];
$mohr_lv0018->lv002=$_POST['txtlv002'];
$mohr_lv0018->lv003=$_POST['txtlv003'];
}
elseif($flagID==6)
{
	$mohr_lv0018->lv001=$_POST['qxtlv001'];
	$mohr_lv0018->lv002=$_POST['qxtlv002'];
	$mohr_lv0018->lv003=$_POST['qxtlv003'];
	$mohr_lv0018->lv004=$_POST['qxtlv004'];
	$mohr_lv0018->lv005=$_POST['qxtlv005'];
	$vresult=$mohr_lv0018->LV_Insert();	
	if(!$vresult)
	{
		$mohr_lv0018->Values['lv001']=$_POST['qxtlv001'];
		$mohr_lv0018->Values['lv002']=$_POST['qxtlv002'];
		$mohr_lv0018->Values['lv003']=$_POST['qxtlv003'];
		$mohr_lv0018->Values['lv004']=$_POST['qxtlv004'];
		$mohr_lv0018->Values['lv005']=$_POST['qxtlv005'];
		echo sof_error();	
	}
	$mohr_lv0018->lv001='';
	$mohr_lv0018->lv002='';
	$mohr_lv0018->lv003='';
	$mohr_lv0018->lv004='';
	$mohr_lv0018->lv005='';
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0018->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0018');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0018->ListView;
$curPage = $mohr_lv0018->CurPage;
$maxRows =$mohr_lv0018->MaxRows;
$vSortNum=$mohr_lv0018->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0018->SaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0018',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0018->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>','filter');
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
	var str="<br><iframe height=300 marginheight=0 marginwidth=0 frameborder=0 src=hr_lv0018?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Save()
	{
		var o=document.frmchoose;
		o.txtFlag.value=6;
		if(o.qxtlv001.value==""){
			alert("Mã không rỗng");
			o.qxtlv001.focus();
		}	
		else if(o.qxtlv002.value==""){
			alert("Xin vui lòng nhập tên");
			o.qxtlv002.focus();
		}	
		else
		{
			o.submit();
		}
	}
//-->
</script>
<?php
if($mohr_lv0018->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0018->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0018->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mohr_lv0018->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mohr_lv0018->lv003;?>"/>
						
					    
				  </form>
				  
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
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
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mohr_lv0018->ArrPush[0];?>';	
</script>