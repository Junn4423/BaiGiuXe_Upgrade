<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/cr_lv0413.php");
/////////////init object//////////////
$mocr_lv0413=new cr_lv0413($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0413');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","CR0086.txt",$plang);
$mocr_lv0413->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0413->ArrPush[0]=$vLangArr[17];
$mocr_lv0413->ArrPush[1]=$vLangArr[18];
$mocr_lv0413->ArrPush[2]=$vLangArr[19];
$mocr_lv0413->ArrPush[3]=$vLangArr[20];
$mocr_lv0413->ArrPush[4]=$vLangArr[21];
$mocr_lv0413->ArrPush[5]=$vLangArr[22];
$mocr_lv0413->ArrPush[6]=$vLangArr[23];
$mocr_lv0413->ArrPush[7]=$vLangArr[24];
$mocr_lv0413->ArrPush[8]=$vLangArr[25];
$mocr_lv0413->ArrPush[9]=$vLangArr[26];
$mocr_lv0413->ArrPush[10]=$vLangArr[27];
$mocr_lv0413->ArrPush[11]=$vLangArr[28];
$mocr_lv0413->ArrPush[12]=$vLangArr[29];
$mocr_lv0413->ArrPush[13]=$vLangArr[30];
$mocr_lv0413->ArrPush[14]='Đã hoàn thành';
$mocr_lv0413->ArrPush[15]=$vLangArr[32];
$mocr_lv0413->ArrPush[16]=$vLangArr[33];
$mocr_lv0413->ArrPush[17]=$vLangArr[34];
$mocr_lv0413->ArrPush[910]='Tên dự án';

$mocr_lv0413->ArrFunc[0]='//Function';
$mocr_lv0413->ArrFunc[1]=$vLangArr[2];
$mocr_lv0413->ArrFunc[2]=$vLangArr[4];
$mocr_lv0413->ArrFunc[3]=$vLangArr[6];
$mocr_lv0413->ArrFunc[4]=$vLangArr[7];
$mocr_lv0413->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mocr_lv0413->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mocr_lv0413->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mocr_lv0413->ArrFunc[8]=$vLangArr[10];
$mocr_lv0413->ArrFunc[9]=$vLangArr[12];
$mocr_lv0413->ArrFunc[10]=$vLangArr[0];
$mocr_lv0413->ArrFunc[11]=$vLangArr[44];
$mocr_lv0413->ArrFunc[12]=$vLangArr[45];
$mocr_lv0413->ArrFunc[13]=$vLangArr[46];
$mocr_lv0413->ArrFunc[14]=$vLangArr[47];
$mocr_lv0413->ArrFunc[15]=$vLangArr[48];

////Other
$mocr_lv0413->ArrOther[1]=$vLangArr[42];
$mocr_lv0413->ArrOther[2]=$vLangArr[43];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vkeep=$_POST['qxtlvkeep'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mocr_lv0413->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"cr_lv0413",$lvMessage);
}
if($flagID>0)
{
	$mocr_lv0413->lv001=$_POST['txtlv001'];
	$mocr_lv0413->lv002=$_POST['txtlv002'];
	$mocr_lv0413->lv003=$_POST['txtlv003'];
	$mocr_lv0413->lv004=$_POST['txtlv004'];
	$mocr_lv0413->lv005=$_POST['txtlv005'];
	$mocr_lv0413->lv006=$_POST['txtlv006'];
	$mocr_lv0413->lv007=$_POST['txtlv007'];
	//$mocr_lv0413->lv008=$_POST['txtlv008'];
	$mocr_lv0413->lv009=$_POST['txtlv009'];
	$mocr_lv0413->lv010=$_POST['txtlv010'];
	$mocr_lv0413->lv011=$_POST['txtlv011'];
	$mocr_lv0413->lv012=$_POST['txtlv012'];
	$mocr_lv0413->lv013=$_POST['txtlv013'];
	$mocr_lv0413->lv014=$_POST['txtlv014'];
	$mocr_lv0413->lv015=$_POST['txtlv015'];
	$mocr_lv0413->lv016=$_POST['txtlv016'];
	$mocr_lv0413->lv017=$_POST['txtlv017'];
	$mocr_lv0413->lv018=$_POST['txtlv018'];
	$mocr_lv0413->lv019=$_POST['txtlv019'];
	$mocr_lv0413->lv020=$_POST['txtlv020'];
	$mocr_lv0413->lv021=$_POST['txtlv021'];
	$mocr_lv0413->lv022=$_POST['txtlv022'];
	$mocr_lv0413->lv023=$_POST['txtlv023'];
	$mocr_lv0413->lv024=$_POST['txtlv024'];
	$mocr_lv0413->lv025=$_POST['txtlv025'];

}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mocr_lv0413->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mocr_lv0413->LV_UnAproval($strar);
}

if($vkeep==1)
{
	$mocr_lv0413->tv001=$vkeep;
	$mocr_lv0413->tv002=$_POST['qxtlv002'];
	$mocr_lv0413->tv003=$_POST['qxtlv003'];
	$mocr_lv0413->tv008=$_POST['qxtlv008'];
	$mocr_lv0413->tv015=$_POST['qxtlv015'];
	$mocr_lv0413->tv022=$_POST['qxtlv022'];
	$mocr_lv0413->tv016=$_POST['qxtlv016_1']." ".$_POST['qxtlv016_2'];
	$mocr_lv0413->tv017=$_POST['qxtlv017_1']." ".$_POST['qxtlv017_2'];
	$mocr_lv0413->tv018=$_POST['qxtlv018_1']." ".$_POST['qxtlv018_2'];
	$mocr_lv0413->tv019=$_POST['qxtlv019_1']." ".$_POST['qxtlv019_2'];
}
else
{
	$mocr_lv0413->tv008=getInfor($_SESSION['ERPSOFV2RUserID'],2);
}
if(!isset($_POST['txtDateFrom']))
{
	$vYear=getyear($mocr_lv0413->DateCurrent);
	$vMonth=getmonth($mocr_lv0413->DateCurrent);
	$vDay=getday($mocr_lv0413->DateCurrent);
	if($vDay==1)
	{
		if($vMonth==1)
			$_POST['txtDateFrom']="31/12/".($vYear-1);
		else
			$_POST['txtDateFrom']=Fillnum(GetDayInMonth($vYear,$vMonth-1),2)."/".Fillnum($vMonth-1,2)."/".$vYear;
	}
	else
	{
		$_POST['txtDateFrom']=Fillnum($vDay-1,2)."/".$vMonth."/".$vYear;
	}
	$_POST['txtDateTo']=$vDay."/".$vMonth."/".$vYear;
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mocr_lv0413->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0413');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mocr_lv0413->ListView;
$curPage = $mocr_lv0413->CurPage;
$maxRows =$mocr_lv0413->MaxRows;
$vOrderList=$mocr_lv0413->ListOrder;
$vSortNum=$mocr_lv0413->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mocr_lv0413->SaveOperation($_SESSION['ERPSOFV2RUserID'],'cr_lv0413',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
/*
if($mocr_lv0413->GetApr()<>1 || $mocr_lv0413->GetUnApr()<>1)
{
	$mocr_lv0413->lv008=$mocr_lv0413->LV_UserID;
	if($mocr_lv0413->GetApr()==1)
	{
		
		$mocr_lv0413->ListStaff=$mocr_lv0413->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');

		$mocr_lv0413->lv029ex=$mocr_lv0413->ListStaff;
	}
}
*/

$mocr_lv0413->trangthai='0';
$totalRowsC=$mocr_lv0413->GetCount();
$mocr_lv0413->trangthai='1';
$totalRowsC1=$mocr_lv0413->GetCount();
$mocr_lv0413->trangthai='';
$totalRowsC2=$mocr_lv0413->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
//$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv016=<?php echo $_POST['txtlv016'];?>&lv017=<?php echo $_POST['txtlv017'];?>&lv018=<?php echo $_POST['txtlv018'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv020=<?php echo $_POST['txtlv020'];?>&lv021=<?php echo $_POST['txtlv021'];?>&lv022=<?php echo $_POST['txtlv022'];?>&lv023=<?php echo $_POST['txtlv023'];?>&lv024=<?php echo $_POST['txtlv024'];?>&lv025=<?php echo $_POST['txtlv025'];?>&checkmonth=<?php echo $_POST['txtcheckmonth'];?>','filter');
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
			var str="<br><iframe height=1900 marginheight=0 marginwidth=0 frameborder=0 src=cr_lv0413?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe height=1900 marginheight=0 marginwidth=0 frameborder=0 src=cr_lv0413?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
	}
	
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
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
	o.action="<?php echo $vDir;?>cr_lv0413?func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function SetDefaultGio(value)
{
	switch(parseInt(value))
	{
		case 6:
			if(document.getElementById('qxtlv016_2').value=='') document.getElementById('qxtlv016_2').value='22:00';
			if(document.getElementById('qxtlv017_2').value=='')  document.getElementById('qxtlv017_2').value='';
			break;
		case 5:
			if(document.getElementById('qxtlv016_2').value=='') document.getElementById('qxtlv016_2').value='12:00';
			if(document.getElementById('qxtlv017_2').value=='')  document.getElementById('qxtlv017_2').value='13:00';
			break;
		case 4:
			if(document.getElementById('qxtlv016_2').value=='') document.getElementById('qxtlv016_2').value='17:00';
			if(document.getElementById('qxtlv017_2').value=='')  document.getElementById('qxtlv017_2').value='20:00';
			break;
		case 0:
			if(document.getElementById('qxtlv016_2').value=='') document.getElementById('qxtlv016_2').value='08:00';
			if(document.getElementById('qxtlv017_2').value=='')  document.getElementById('qxtlv017_2').value='17:00';
			break;
		default:
		if(document.getElementById('qxtlv016_2').value=='') document.getElementById('qxtlv016_2').value='00:00';
		if(document.getElementById('qxtlv017_2').value=='')  document.getElementById('qxtlv017_2').value='00:00';
			break;
	}		
	
}
function runchangephep(codeid)
		{
			if(codeid!='P' && codeid!='0.5P')
			{
				return ;
			} 
			$xmlhttp=null;
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var lvNVID=document.getElementById('qxtlv015').value;
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxphep=program"+"&year=<?php echo $motc_lv0013->lv007;?>&month=<?php echo $motc_lv0013->lv006;?>&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxphep=program"+"&year=<?php echo $motc_lv0013->lv007;?>&month=<?php echo $motc_lv0013->lv006;?>&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChangedProgram;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				if(domainid=='')
				{
					var startdomain1=xmlhttp.responseText.indexOf('[CHECKDEF]')+10;
					var enddomain1=xmlhttp.responseText.indexOf('[ENDCHECKDEF]');
					var domainid1=xmlhttp.responseText.substr(startdomain1,enddomain1-startdomain1);
					document.getElementById('msphepid').innerHTML=domainid1;
				}
				else
				{
					alert(domainid);
				}
				
			}
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
function Save()
{
	ChangeInfor();
}
function ChangeInfor()
{
	{
		var o1=document.frmchoose;
		o1.submit();
	}
}		
function RunDisableAll(cur)
{
	var o=document.getElementById("curTabView");
	o.value=cur;
	for(var js='0';js<=6;js++)
	{
		var o1=document.getElementById("cl_"+js+"_1");
		var h1=document.getElementById("cl_"+js+"_2");
		var o3=document.getElementById("hrtab_"+js);
		var if1=document.getElementById("cl_"+js+"_3");
		if(cur==js)
		{
			if(o1!=null) 
			{
				o1.style.display="block";
				if(if1!=null) if1.src=h1.value;
			}
			if(o3!=null) o3.className="curshow";
			
		}
		else
		{
			if(o1!=null) o1.style.display="none";
			if(o3!=null) o3.className="cssTab";
		}
	}	
}
function jobshow(cur)
{
	for(var js='0';js<=6;js++)
	{
		var o1=document.getElementById("job_"+js);
		
		if(cur==js)
		{
			if(o1!=null) o1.style.display="block";
			
		}
		else
		{
			if(o1!=null) o1.style.display="none";
			
		}
	}	
}	
//-->
</script>
<?php
if($mocr_lv0413->GetApr()==0 && $mocr_lv0413->GetUnApr()==0)
{
	$mocr_lv0413->DefaultFieldList='lv001,lv015,lv829,lv003,lv022,lv025,lv016,lv017,lv098,lv008,lv013,lv018,lv019,lv021';
}
if($mocr_lv0413->GetView()==1)
{
?>
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					<input id="curTabView" name="curTabView" type="hidden" value="<?php echo $_POST['curTabView'];?>"/> 
					<input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					<table border="0" width="100%">
							<tbody>
								<tr>
									<td align="left" id="TabViewHr">
										<ul class="IdTabViewHr">
											<li><div id="hrtab_0" class="curshow" onclick="RunDisableAll(0)" style="min-width:100px">Lô đầu vào PMH<?php echo (($totalRowsC>0)?'('.$totalRowsC.')':'');?></div></li>											
											<li><div id="hrtab_1" class="cssTab" onclick="RunDisableAll(1)" style="min-width:100px">Lô đầu vào PTH<?php echo (($totalRowsC1>0)?'('.$totalRowsC1.')':'');?></div></li>
											<li><div id="hrtab_2" class="cssTab" onclick="RunDisableAll(2)" style="min-width:100px">Tổng hợp<?php echo (($totalRowsC2>0)?'('.$totalRowsC2.')':'');?></div></li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
						<div id="cl_0_1">
							<input type="hidden" name="cl_0_2" id="cl_0_2" value="home.php?lang=VN&opt=19&item=&link=Y3JfbHYwNDEzL2NyX2x2MDQxMy0xLnBocA==&trangthai=0"/>
							<iframe name="cl_0_3" id="cl_0_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="home.php?lang=VN&opt=27&item=&link=Y3JfbHYwNDEzL2NyX2x2MDQxMy0xLnBocA==&trangthai=0" class=lvframe></iframe>
					 	</div>
						<div id="cl_1_1">
							<input type="hidden" name="cl_1_2" id="cl_1_2" value="home.php?lang=VN&opt=19&item=&link=Y3JfbHYwNDEzL2NyX2x2MDQxMy0xLnBocA==&trangthai=1"/>
							<iframe name="cl_1_3" id="cl_1_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						</div>	
						<div id="cl_2_1">
							<input type="hidden" name="cl_2_2" id="cl_2_2" value="home.php?lang=VN&opt=19&item=&link=Y3JfbHYwNDEzL2NyX2x2MDQxMy0xLnBocA==&trangthai="/>
							<iframe name="cl_2_3" id="cl_2_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						</div>							
				  </form>
				 
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
</div></div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
<?php
if($totalRowsC>0)
{
?>
var qtri_pbh_kho=window.parent.document.getElementById("qtri_pbh_kho");
if(qtri_pbh_kho!=null)
{
	qtri_pbh_kho.innerText='(<?php echo $totalRowsC;?>)';
}
<?php
}
?>
setTimeout("setFocusNow()",1000);
function setFocusNow()
{
	document.frmchoose.qxtlv001.focus();
}
</script>