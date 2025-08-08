<?php
session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0033.php");
require_once("../../clsall/tc_lv0023.php");
require_once("../../clsall/tc_lv0013.php");

/////////////init object//////////////
$lvtc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
if($lvtc_lv0013->GetApr()==1 && $lvtc_lv0013->GetUnApr()==1)
{
	if(isset($_POST['txtCalID']))
	{
		$lvtc_lv0013->LV_SetCal($_POST['txtCalID']);
	}
	$lvtc_lv0013->LV_GetCal();
	if($lvtc_lv0013->lv999!='' || $lvtc_lv0013->lv999!=NULL)
	{
		$lvtc_lv0013->LV_LoadID($lvtc_lv0013->lv999);
	}
	else
		$lvtc_lv0013->LV_LoadActiveID();
?>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				
	 <form name="frmcalculate" method="post">
	<?php 
	
		  $vTitle=''; 
		  if($plang=="EN")
			{	

					echo 'OPTION PARAMETER TO CACULATE ';
			}
		   else
		   {
				echo 'CHỌN THÔNG SỐ TÍNH LƯƠNG';
		   }
		   ?>
		   <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>"/>
		    <select name="txtCalID">
		    	<option value=""></option>
				<?php echo $lvtc_lv0013->LV_LinkField('lv999',$lvtc_lv0013->lv999);?>
			</select>
		  	<input type="submit" value="Chọn ngay" onclick="document.frmcalculate.submit()"/>
		  	</form>
		  	</div>
		  	
		</td>
		</tr>
		</tbody>
		</table>	
<?php
}
else
	$lvtc_lv0013->LV_LoadActiveID();
$lvtc_lv0033=new tc_lv0033($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0033');
$lvtc_lv0023=new tc_lv0023($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0023');
$lvtc_lv0033->Dir='../';
$vDir='../';
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";

	$vLangArr=GetLangFile("../../","AD0025.txt",$plang);
	$vLangArr1=GetLangFile("../../","TC0037.txt",$plang);
$lvtc_lv0033->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$lvtc_lv0033->ArrPush[0]=$vLangArr[17];
$lvtc_lv0033->ArrPush[1]=$vLangArr[18];
$lvtc_lv0033->ArrPush[2]=$vLangArr[19];
$lvtc_lv0033->ArrPush[3]=$vLangArr[20];
$lvtc_lv0033->ArrPush[4]=$vLangArr[21];
$lvtc_lv0033->ArrPush[5]=$vLangArr[22];
$lvtc_lv0033->ArrPush[6]=$vLangArr[23];
$lvtc_lv0033->ArrPush[7]=$vLangArr[24];
$lvtc_lv0033->ArrPush[8]=$vLangArr[25];
$lvtc_lv0033->ArrPush[9]=$vLangArr[26];
$lvtc_lv0033->ArrPush[10]=$vLangArr[27];
$lvtc_lv0033->ArrPush[11]=$vLangArr[28];
$lvtc_lv0033->ArrPush[12]=$vLangArr[29];
$lvtc_lv0033->ArrPush[13]=$vLangArr[30];
$lvtc_lv0033->ArrPush[14]=$vLangArr[31];
$lvtc_lv0033->ArrPush[15]=$vLangArr[32];
$lvtc_lv0033->ArrPush[16]=$vLangArr[33];
$lvtc_lv0033->ArrPush[17]=$vLangArr[34];
$lvtc_lv0033->ArrPush[18]=$vLangArr[35];
$lvtc_lv0033->ArrPush[19]=$vLangArr[36];
$lvtc_lv0033->ArrPush[20]=$vLangArr[37];
$lvtc_lv0033->ArrPush[21]=$vLangArr[38];
$lvtc_lv0033->ArrPush[22]=$vLangArr[39];
$lvtc_lv0033->ArrPush[23]=$vLangArr[40];
$lvtc_lv0033->ArrPush[24]=$vLangArr[41];
$lvtc_lv0033->ArrPush[25]=$vLangArr[42];
$lvtc_lv0033->ArrPush[26]=$vLangArr[43];
$lvtc_lv0033->ArrPush[27]=$vLangArr[44];
$lvtc_lv0033->ArrPush[28]=$vLangArr[45];
$lvtc_lv0033->ArrPush[29]=$vLangArr[46];
$lvtc_lv0033->ArrPush[30]=$vLangArr[47];
$lvtc_lv0033->ArrPush[31]=$vLangArr[48];
$lvtc_lv0033->ArrPush[32]=$vLangArr[49];
$lvtc_lv0033->ArrPush[33]=$vLangArr[50];
$lvtc_lv0033->ArrPush[34]=$vLangArr[51];
$lvtc_lv0033->ArrPush[35]=$vLangArr[52];
$lvtc_lv0033->ArrPush[36]=$vLangArr[53];
$lvtc_lv0033->ArrPush[37]=$vLangArr[54];
$lvtc_lv0033->ArrPush[38]=$vLangArr[55];
$lvtc_lv0033->ArrPush[39]=$vLangArr[56];
$lvtc_lv0033->ArrPush[40]=$vLangArr[57];
$lvtc_lv0033->ArrPush[41]=$vLangArr[58];
$lvtc_lv0033->ArrPush[42]=$vLangArr[59];
$lvtc_lv0033->ArrPush[43]=$vLangArr[60];
$lvtc_lv0033->ArrPush[44]=$vLangArr[61];
$lvtc_lv0033->ArrPush[45]=$vLangArr[62];
$lvtc_lv0033->ArrFunc[0]='//Function';
$lvtc_lv0033->ArrFunc[1]=$vLangArr[2];
$lvtc_lv0033->ArrFunc[2]=$vLangArr[4];
$lvtc_lv0033->ArrFunc[3]=$vLangArr[6];
$lvtc_lv0033->ArrFunc[4]=$vLangArr[7];
$lvtc_lv0033->ArrFunc[8]=$vLangArr[10];
$lvtc_lv0033->ArrFunc[9]=$vLangArr[12];
$lvtc_lv0033->ArrFunc[10]=$vLangArr[0];
$lvtc_lv0033->ArrFunc[11]=$vLangArr[65];
$lvtc_lv0033->ArrFunc[12]=$vLangArr[66];
$lvtc_lv0033->ArrFunc[13]=$vLangArr[67];
$lvtc_lv0033->ArrFunc[14]=$vLangArr[68];
$lvtc_lv0033->ArrFunc[15]=$vLangArr[69];

////Other
$lvtc_lv0033->ArrOther[1]=$vLangArr[63];
$lvtc_lv0033->ArrOther[2]=$vLangArr[64];
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
if($flagID==4)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@",",",$strar);
	$vresult=$lvtc_lv0023->LV_InsertMulti($strar,$lvtc_lv0013->lv001,$_POST['lvsave_txtlv004'],$_POST['lvsave_txtlv005'],$_POST['lvsave_txtlv006'],$_POST['lvsave_txtlv007'],0,getInfor($_SESSION['ERPSOFV2RUserID'],2));
}
elseif($flagID==2)
{
$lvtc_lv0033->lv001=$_POST['txtlv001'];
$lvtc_lv0033->lv002=$_POST['txtlv002'];
$lvtc_lv0033->lv003=$_POST['txtlv003'];
$lvtc_lv0033->lv004=$_POST['txtlv004'];
$lvtc_lv0033->lv005=$_POST['txtlv005'];
$lvtc_lv0033->lv006=$_POST['txtlv006'];
$lvtc_lv0033->lv007=$_POST['txtlv007'];
$lvtc_lv0033->lv008=$_POST['txtlv008'];
$lvtc_lv0033->lv009=$_POST['txtlv009'];
$lvtc_lv0033->lv010=$_POST['txtlv010'];
$lvtc_lv0033->lv011=$_POST['txtlv011'];
$lvtc_lv0033->lv012=$_POST['txtlv012'];
$lvtc_lv0033->lv013=$_POST['txtlv013'];
$lvtc_lv0033->lv014=$_POST['txtlv014'];
$lvtc_lv0033->lv015=$_POST['txtlv015'];
$lvtc_lv0033->lv016=$_POST['txtlv016'];
$lvtc_lv0033->lv017=$_POST['txtlv017'];
$lvtc_lv0033->lv018=$_POST['txtlv018'];
$lvtc_lv0033->lv019=$_POST['txtlv019'];
$lvtc_lv0033->lv020=$_POST['txtlv020'];
$lvtc_lv0033->lv021=$_POST['txtlv021'];
$lvtc_lv0033->lv022=$_POST['txtlv022'];
$lvtc_lv0033->lv023=$_POST['txtlv023'];
$lvtc_lv0033->lv024=$_POST['txtlv024'];
$lvtc_lv0033->lv025=$_POST['txtlv025'];
$lvtc_lv0033->lv026=$_POST['txtlv026'];
$lvtc_lv0033->lv027=$_POST['txtlv027'];
$lvtc_lv0033->lv028=$_POST['txtlv028'];
$lvtc_lv0033->lv029=$_POST['txtlv029'];
$lvtc_lv0033->lv030=$_POST['txtlv030'];
$lvtc_lv0033->lv031=$_POST['txtlv031'];
$lvtc_lv0033->lv032=$_POST['txtlv032'];
$lvtc_lv0033->lv033=$_POST['txtlv033'];
$lvtc_lv0033->lv034=$_POST['txtlv034'];
$lvtc_lv0033->lv035=$_POST['txtlv035'];
$lvtc_lv0033->lv036=$_POST['txtlv036'];
$lvtc_lv0033->lv037=$_POST['txtlv037'];
$lvtc_lv0033->lv038=$_POST['txtlv038'];
$lvtc_lv0033->lv039=$_POST['txtlv039'];
$lvtc_lv0033->lv040=$_POST['txtlv040'];
$lvtc_lv0033->lv041=$_POST['txtlv041'];
$lvtc_lv0033->lv042=$_POST['txtlv042'];
$lvtc_lv0033->lv043=$_POST['txtlv043'];
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$lvtc_lv0033->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0033');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$lvtc_lv0033->ListView;
$curPage = $lvtc_lv0033->CurPage;
$maxRows =$lvtc_lv0033->MaxRows;
$vOrderList=$lvtc_lv0033->ListOrder;
$vSortNum=$lvtc_lv0033->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$lvtc_lv0033->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0033',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$lvtc_lv0033->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="../../css/menu.css" type="text/css">	
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/pubscript.js"></script>
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv015=<?php echo $_POST['txtlv016'];?>&lv017=<?php echo $_POST['txtlv017'];?>&lv018=<?php echo $_POST['txtlv018'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv020=<?php echo $_POST['txtlv020'];?>&lv021=<?php echo $_POST['txtlv021'];?>&lv022=<?php echo $_POST['txtlv022'];?>&lv023=<?php echo $_POST['txtlv023'];?>&lv024=<?php echo $_POST['txtlv024'];?>&lv025=<?php echo $_POST['txtlv025'];?>&lv026=<?php echo $_POST['txtlv026'];?>&lv027=<?php echo $_POST['txtlv027'];?>&lv028=<?php echo $_POST['txtlv028'];?>&lv029=<?php echo $_POST['txtlv029'];?>&lv030=<?php echo $_POST['txtlv030'];?>&lv031=<?php echo $_POST['txtlv022'];?>&lv033=<?php echo $_POST['txtlv033'];?>&lv034=<?php echo $_POST['txtlv034'];?>&lv035=<?php echo $_POST['txtlv035'];?>&lv036=<?php echo $_POST['txtlv036'];?>&lv037=<?php echo $_POST['txtlv037'];?>&lv038=<?php echo $_POST['txtlv038'];?>&lv039=<?php echo $_POST['txtlv039'];?>&lv040=<?php echo $_POST['txtlv040'];?>&lv041=<?php echo $_POST['txtlv041'];?>&lv042=<?php echo $_POST['txtlv042'];?>','filter');
}
function Delete(vValue)
{
 	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>&<?php echo $psaveget;?>"
	 o.submit();

}
function FunctRunning1(vID)
{
RunFunction(vID,'child');
}
function RunFunction(vID,func)
{
	var str="<br><iframe height=1600 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>tc_lv0033?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";

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
	o.action="<?php echo $vDir;?>tc_lv0033?func=<?php echo $_GET['func'];?>&func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function Save()
	{var o=document.frmchoose;		
		if(o.lvsave_txtlv005.value=='')
		{
			alert('No empty');
			o.lvsave_txtlv005.focus();
			return;
		}
		else if( parseFloat('0'+o.lvsave_txtlv005.value)<=0)
		{
			alert('More than zero');
			o.lvsave_txtlv005.focus();
			return;
		}
		else
		lv_chk_list(document.frmchoose,'lvChk',3);
		
	}
//-->
</script>
<?php
if($lvtc_lv0023->GetAdd()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>&<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
                      <table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>	
							  <tr>
							  <td width="166"  height="20px"><?php echo $vLangArr1[18];?></td>
							  <td width="*%"  height="20px"><select name="lvsave_txtlv004" id="lvsave_txtlv004"  tabindex="8" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							   <?php echo $lvtc_lv0023->LV_LinkField('lv004',$lvtc_lv0023->lv004);?>
                              </select>
							   </td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr1[19];?></td>
							  <td  height="20px"><input name="lvsave_txtlv005" type="text" id="lvsave_txtlv005" value="<?php echo ($_POST['lvsave_txtlv005']=='')?'500000':$_POST['lvsave_txtlv005'];?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							  
							 
							   <tr>
							  <td  height="20px"><?php echo $vLangArr1[20];?></td>
							  <td  height="20px"><select name="lvsave_txtlv006" id="lvsave_txtlv006"  tabindex="11" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							   <?php echo $lvtc_lv0023->LV_LinkField('lv006',$lvtc_lv0023->lv006);?>
                              </select>
							    <br></td>
							  </tr>		
							    <tr>
							  <td  height="20px"><?php echo $vLangArr1[21];?></td>
							  <td  height="20px"><input name="lvsave_txtlv007" type="text" id="txtlv007" value="<?php echo $lvtc_lv0023->lv007;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>																																	
							<tr>
							  <td  height="20px" colspan="2"></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2">&nbsp;</td>
						  </tr>
					  </table><img border="0" align="middle" id="save" name="save" title="&lt;?php echo ;?&gt;" alt="Save" src="../images/controlright/save_f2.png" onClick="Save()">
						<?php echo $lvtc_lv0033->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?><img border="0" align="middle" id="save" name="save"  alt="Save" src="../images/controlright/save_f2.png" onClick="Save()">
				    <input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $lvtc_lv0033->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $lvtc_lv0033->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $lvtc_lv0033->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $lvtc_lv0033->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $lvtc_lv0033->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $lvtc_lv0033->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $lvtc_lv0033->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $lvtc_lv0033->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $lvtc_lv0033->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $lvtc_lv0033->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $lvtc_lv0033->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $lvtc_lv0033->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $lvtc_lv0033->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $lvtc_lv0033->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $lvtc_lv0033->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $lvtc_lv0033->lv016;?>"/>
						<input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $lvtc_lv0033->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $lvtc_lv0033->lv018;?>"/>
						<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $lvtc_lv0033->lv019;?>"/>
						<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $lvtc_lv0033->lv020;?>"/>
						<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $lvtc_lv0033->lv021;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $lvtc_lv0033->lv022;?>"/>
						<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $lvtc_lv0033->lv023;?>"/>
						<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $lvtc_lv0033->lv024;?>"/>
						<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $lvtc_lv0033->lv025;?>"/>
						<input type="hidden" name="txtlv026" id="txtlv026" value="<?php echo $lvtc_lv0033->lv026;?>"/>
						<input type="hidden" name="txtlv027" id="txtlv027" value="<?php echo $lvtc_lv0033->lv027;?>"/>
						<input type="hidden" name="txtlv028" id="txtlv028" value="<?php echo $lvtc_lv0033->lv028;?>"/>
						<input type="hidden" name="txtlv029" id="txtlv029" value="<?php echo $lvtc_lv0033->lv029;?>"/>
						<input type="hidden" name="txtlv030" id="txtlv030" value="<?php echo $lvtc_lv0033->lv030;?>"/>
						<input type="hidden" name="txtlv031" id="txtlv031" value="<?php echo $lvtc_lv0033->lv031;?>"/>
						<input type="hidden" name="txtlv032" id="txtlv032" value="<?php echo $lvtc_lv0033->lv032;?>"/>
						<input type="hidden" name="txtlv033" id="txtlv033" value="<?php echo $lvtc_lv0033->lv033;?>"/>
						<input type="hidden" name="txtlv034" id="txtlv034" value="<?php echo $lvtc_lv0033->lv034;?>"/>
						<input type="hidden" name="txtlv035" id="txtlv035" value="<?php echo $lvtc_lv0033->lv035;?>"/>
						<input type="hidden" name="txtlv036" id="txtlv036" value="<?php echo $lvtc_lv0033->lv036;?>"/>
						<input type="hidden" name="txtlv037" id="txtlv037" value="<?php echo $lvtc_lv0033->lv037;?>"/>
						<input type="hidden" name="txtlv038" id="txtlv038" value="<?php echo $lvtc_lv0033->lv038;?>"/>
						<input type="hidden" name="txtlv039" id="txtlv039" value="<?php echo $lvtc_lv0033->lv039;?>"/>
						<input type="hidden" name="txtlv040" id="txtlv040" value="<?php echo $lvtc_lv0033->lv040;?>"/>
						<input type="hidden" name="txtlv041" id="txtlv041" value="<?php echo $lvtc_lv0033->lv041;?>"/>
						<input type="hidden" name="txtlv042" id="txtlv042" value="<?php echo $lvtc_lv0033->lv042;?>"/>
						<input type="hidden" name="txtlv043" id="txtlv043" value="<?php echo $lvtc_lv0033->lv043;?>"/>
						<input type="hidden" name="txtlv044" id="txtlv044" value="<?php echo $lvtc_lv0033->lv044;?>"/>

					    
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  
</div><div id="lvright"></div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $lvtc_lv0033->ArrPush[0];?>';	
</script>