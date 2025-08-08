<?php
$vDir = '';
if (isset($_GET['ID']) && $_GET['ID'] != '') {
    $vDir = '../';
}

echo "Sdsd";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/tc_lv0020.php");
require_once("$vDir../clsall/tc_lv0064.php");
require_once("$vDir../clsall/tc_lv0013.php");
require_once("$vDir../clsall/tc_lv0031.php");
require_once("$vDir../clsall/tc_lv0009.php");
require_once("$vDir../clsall/tc_lv0008.php");
require_once("$vDir../clsall/tc_lv0025.php");
require_once("$vDir../clsall/hr_lv0038.php");
require_once("$vDir../clsall/hr_lv0020.php");
require_once("$vDir../clsall/ml_lv0008.php");
require_once("$vDir../clsall/ml_lv0009.php");
require_once("$vDir../clsall/ml_lv0013.php");
require_once("$vDir../clsall/ml_lv0100.php");
require_once("$vDir../clsall/class.phpmailer.php");
/////////////init object//////////////
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0031=new tc_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0031');
$motc_lv0064=new tc_lv0064($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0064');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
$motc_lv0025=new tc_lv0025($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0025');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
if($motc_lv0013->GetApr()==1 && $motc_lv0013->GetUnApr()==1)
{

	if(isset($_POST['txtCalID']))
	{	
		$motc_lv0013->LV_SetCal($_POST['txtCalID']);
	}
	$motc_lv0013->LV_GetCal();
	if($motc_lv0013->lv999!='' || $motc_lv0013->lv999!=NULL)
	{
		
		$motc_lv0013->LV_LoadID($motc_lv0013->lv999);
	}
	else
		$motc_lv0013->LV_LoadActiveID();
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
				<?php echo $motc_lv0013->LV_LinkField('lv999',$motc_lv0013->lv999);?>
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
	$motc_lv0013->LV_LoadActiveID();
$motc_lv0020->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TC0038.txt",$plang);
$motc_lv0020->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0020->ArrPush[0]=$vLangArr[16];
$motc_lv0020->ArrPush[1]=$vLangArr[18];
$motc_lv0020->ArrPush[2]=$vLangArr[19];
$motc_lv0020->ArrPush[3]=$vLangArr[20];
$motc_lv0020->ArrPush[4]=$vLangArr[21];
$motc_lv0020->ArrPush[5]=$vLangArr[22];
$motc_lv0020->ArrPush[6]=$vLangArr[23];
$motc_lv0020->ArrPush[7]=$vLangArr[24];
$motc_lv0020->ArrPush[8]=$vLangArr[25];
$motc_lv0020->ArrPush[9]=$vLangArr[26];
$motc_lv0020->ArrPush[10]=$vLangArr[27];
$motc_lv0020->ArrPush[11]=$vLangArr[28];
$motc_lv0020->ArrPush[12]=$vLangArr[29];
$motc_lv0020->ArrPush[13]=$vLangArr[30];
$motc_lv0020->ArrPush[14]=$vLangArr[31];
$motc_lv0020->ArrPush[15]=$vLangArr[32];
$motc_lv0020->ArrPush[16]=$vLangArr[33];
$motc_lv0020->ArrPush[17]=$vLangArr[34];
$motc_lv0020->ArrPush[18]=$vLangArr[35];
$motc_lv0020->ArrPush[19]=$vLangArr[36];
$motc_lv0020->ArrPush[20]=$vLangArr[37];
$motc_lv0020->ArrPush[21]=$vLangArr[38];
$motc_lv0020->ArrPush[22]=$vLangArr[39];
$motc_lv0020->ArrPush[23]=$vLangArr[40];
$motc_lv0020->ArrPush[24]=$vLangArr[41];
$motc_lv0020->ArrPush[25]=$vLangArr[42];
$motc_lv0020->ArrPush[26]=$vLangArr[43];
$motc_lv0020->ArrPush[27]=$vLangArr[44];
$motc_lv0020->ArrPush[28]=$vLangArr[45];
$motc_lv0020->ArrPush[29]=$vLangArr[46];
$motc_lv0020->ArrPush[30]=$vLangArr[47];
$motc_lv0020->ArrPush[31]=$vLangArr[48];
$motc_lv0020->ArrPush[32]=$vLangArr[49];
$motc_lv0020->ArrPush[33]=$vLangArr[50];
$motc_lv0020->ArrPush[34]=$vLangArr[51];
$motc_lv0020->ArrPush[35]=$vLangArr[52];
$motc_lv0020->ArrPush[36]=$vLangArr[53];
$motc_lv0020->ArrPush[37]=$vLangArr[54];
$motc_lv0020->ArrPush[38]=$vLangArr[55];
$motc_lv0020->ArrPush[39]=$vLangArr[56];
$motc_lv0020->ArrPush[40]=$vLangArr[57];
$motc_lv0020->ArrPush[41]=$vLangArr[58];
$motc_lv0020->ArrPush[42]=$vLangArr[59];
$motc_lv0020->ArrPush[43]=$vLangArr[60];
$motc_lv0020->ArrPush[44]=$vLangArr[61];
$motc_lv0020->ArrPush[45]=$vLangArr[62];
$motc_lv0020->ArrPush[46]=$vLangArr[63];
$motc_lv0020->ArrPush[47]=$vLangArr[64];
$motc_lv0020->ArrPush[48]=$vLangArr[65];
$motc_lv0020->ArrPush[49]=$vLangArr[66];
$motc_lv0020->ArrPush[50]=$vLangArr[67];
$motc_lv0020->ArrPush[51]=$vLangArr[68];
$motc_lv0020->ArrPush[52]=$vLangArr[69];
$motc_lv0020->ArrPush[53]=$vLangArr[70];
$motc_lv0020->ArrPush[54]=$vLangArr[71];
$motc_lv0020->ArrPush[55]=$vLangArr[72];
$motc_lv0020->ArrPush[56]=$vLangArr[73];
$motc_lv0020->ArrPush[57]=$vLangArr[74];
$motc_lv0020->ArrPush[58]=$vLangArr[75];
$motc_lv0020->ArrPush[59]=$vLangArr[76];
$motc_lv0020->ArrPush[60]=$vLangArr[77];
$motc_lv0020->ArrPush[61]=$vLangArr[78];
$motc_lv0020->ArrPush[62]=$vLangArr[79];
$motc_lv0020->ArrPush[63]=$vLangArr[80];
$motc_lv0020->ArrPush[64]=$vLangArr[81];
$motc_lv0020->ArrPush[65]=$vLangArr[82];
$motc_lv0020->ArrPush[66]=$vLangArr[83];
$motc_lv0020->ArrPush[67]=$vLangArr[84];
$motc_lv0020->ArrPush[68]=$vLangArr[85];
$motc_lv0020->ArrPush[69]=$vLangArr[86];
$motc_lv0020->ArrPush[70]=$vLangArr[87];
$motc_lv0020->ArrPush[71]=$vLangArr[88];
$motc_lv0020->ArrPush[72]=$vLangArr[89];
$motc_lv0020->ArrPush[73]=$vLangArr[90];
$motc_lv0020->ArrPush[74]=$vLangArr[91];
$motc_lv0020->ArrPush[75]=$vLangArr[102];
$motc_lv0020->ArrPush[76]=$vLangArr[103];
$motc_lv0020->ArrPush[77]=$vLangArr[104];
$motc_lv0020->ArrPush[78]=$vLangArr[105];
$motc_lv0020->ArrPush[79]=$vLangArr[106];
$motc_lv0020->ArrPush[80]=$vLangArr[107];
$motc_lv0020->ArrPush[81]=$vLangArr[108];
$motc_lv0020->ArrPush[82]=$vLangArr[109];
$motc_lv0020->ArrPush[83]=$vLangArr[110];
$motc_lv0020->ArrPush[84]=$vLangArr[111];
$motc_lv0020->ArrPush[85]=$vLangArr[112];
$motc_lv0020->ArrPush[86]=$vLangArr[113];
$motc_lv0020->ArrPush[87]=$vLangArr[114];
$motc_lv0020->ArrPush[88]=$vLangArr[115];
$motc_lv0020->ArrPush[89]=$vLangArr[116];
$motc_lv0020->ArrPush[90]=$vLangArr[117];

$motc_lv0020->ArrPush[91]=$vLangArr[121];
$motc_lv0020->ArrPush[92]=$vLangArr[122];
$motc_lv0020->ArrPush[93]=$vLangArr[123];
$motc_lv0020->ArrPush[94]=$vLangArr[124];
$motc_lv0020->ArrPush[95]=$vLangArr[125];
$motc_lv0020->ArrPush[96]=$vLangArr[126];
$motc_lv0020->ArrPush[97]=$vLangArr[127];
$motc_lv0020->ArrPush[98]=$vLangArr[128];



$motc_lv0020->ArrPush[101]=$vLangArr[103];
$motc_lv0020->ArrPush[102]='Mã KT';

$motc_lv0020->ArrFunc[0]='//Function';
$motc_lv0020->ArrFunc[1]=$vLangArr[99];
$motc_lv0020->ArrFunc[2]=$vLangArr[4];
$motc_lv0020->ArrFunc[3]=$vLangArr[6];
$motc_lv0020->ArrFunc[4]=$vLangArr[7];
$motc_lv0020->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$motc_lv0020->ArrFunc[6]=GetLangExcept('Apr',$plang);
$motc_lv0020->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$motc_lv0020->ArrFunc[8]=$vLangArr[10];
$motc_lv0020->ArrFunc[9]=$vLangArr[12];
$motc_lv0020->ArrFunc[10]=$vLangArr[0];
$motc_lv0020->ArrFunc[11]=$vLangArr[94];
$motc_lv0020->ArrFunc[12]=$vLangArr[95];
$motc_lv0020->ArrFunc[13]=$vLangArr[96];
$motc_lv0020->ArrFunc[14]=$vLangArr[97];
$motc_lv0020->ArrFunc[15]=$vLangArr[98];
////Other
$motc_lv0020->ArrOther[1]=$vLangArr[92];
$motc_lv0020->ArrOther[2]=$vLangArr[93];
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
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0020->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"tc_lv0020",$lvMessage);
}
elseif($flagID==2)
{
$motc_lv0020->lv001=$_POST['txtlv001'];
if( $_GET['ID']=="")
$motc_lv0020->lv002=$_POST['txtlv002'];
else
$motc_lv0020->lv002= $_GET['ID'] ?? '';
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0020->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0020->LV_UnAproval($strar);
}
elseif($flagID==5)
{
if( $_GET['ID']=="")
$motc_lv0020->lv002=$_POST['txtlv002'];
else
$motc_lv0020->lv002= $_GET['ID'] ?? '';
if((int)$_POST['txtCalID']==1)
{
$motc_lv0031=new tc_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0031');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
$motc_lv0025=new tc_lv0025($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0025');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');

$motc_lv0009->LV_LoadMonthID($motc_lv0020->lv002,$motc_lv0013->lv006,$motc_lv0013->lv007);
$motc_lv0031->LV_LoadCurrentID($motc_lv0013->lv001,$_POST['txtlv031']);
$motc_lv0025->LV_LoadID($motc_lv0009->lv008);
$motc_lv0020->mohr_lv0020=$mohr_lv0020;
$motc_lv0020->mohr_lv0038=$mohr_lv0038;
$motc_lv0020->motc_lv0008=$motc_lv0008;
$motc_lv0020->PreCalculate($motc_lv0013,$motc_lv0020->lv002,(int)$_POST['txtlv030'],$_POST['txtlv025'],$motc_lv0009->lv007,$motc_lv0031->lv004,$motc_lv0031->lv006,$_POST['txtlv031'],$motc_lv0009->lv008,$motc_lv0009->lv009);
}

$motc_lv0031=new tc_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0031');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
$motc_lv0025=new tc_lv0025($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0025');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');

$motc_lv0009->LV_LoadMonthID($motc_lv0020->lv002,$motc_lv0013->lv006,$motc_lv0013->lv007);
$motc_lv0031->LV_LoadCurrentID($motc_lv0013->lv001,$_POST['txtlv031']);
$motc_lv0025->LV_LoadID($motc_lv0009->lv008);
$motc_lv0020->mohr_lv0020=$mohr_lv0020;
$motc_lv0020->mohr_lv0038=$mohr_lv0038;
$motc_lv0020->motc_lv0008=$motc_lv0008;
$motc_lv0020->motc_lv0009=$motc_lv0009;
$motc_lv0064->LV_AutoInsertNV("'".$motc_lv0020->lv002."'",$motc_lv0013->lv001);
$motc_lv0020->Calculate($motc_lv0013,$motc_lv0020->lv002,(int)$_POST['txtlv030'],$_POST['txtlv025'],$motc_lv0009->lv007,$motc_lv0031->lv004,$motc_lv0031->lv006,$_POST['txtlv031'],$motc_lv0009->lv008,$motc_lv0009->lv009);

$motc_lv0020->lv001="";
$motc_lv0020->lv003="";
$motc_lv0020->lv004="";
$motc_lv0020->lv005="";
$motc_lv0020->lv006="";
$motc_lv0020->lv007="";
$motc_lv0020->lv008="";
$motc_lv0020->lv009="";
$motc_lv0020->lv010="";
$motc_lv0020->lv011="";
$motc_lv0020->lv012="";
$motc_lv0020->lv013="";
$motc_lv0020->lv014="";
$motc_lv0020->lv015="";
$motc_lv0020->lv016="";
$motc_lv0020->lv017="";
$motc_lv0020->lv018="";
$motc_lv0020->lv019="";
$motc_lv0020->lv020="";
$motc_lv0020->lv021="";
$motc_lv0020->lv022="";
$motc_lv0020->lv023="";
$motc_lv0020->lv024="";
$motc_lv0020->lv025="";
$motc_lv0020->lv026="";
$motc_lv0020->lv027="";
$motc_lv0020->lv028="";
$motc_lv0020->lv029="";
$motc_lv0020->lv030="";
$motc_lv0020->lv031="";
$motc_lv0020->lv032="";
$motc_lv0020->lv033="";
$motc_lv0020->lv034="";
$motc_lv0020->lv035="";
$motc_lv0020->lv036="";
$motc_lv0020->lv037="";
$motc_lv0020->lv038="";
$motc_lv0020->lv039="";
$motc_lv0020->lv040="";
$motc_lv0020->lv041="";
$motc_lv0020->lv042="";
$motc_lv0020->lv043="";
$motc_lv0020->lv044="";
$motc_lv0020->lv045="";
$motc_lv0020->lv046="";
$motc_lv0020->lv047="";
$motc_lv0020->lv048="";
$motc_lv0020->lv049="";
$motc_lv0020->lv050="";
$motc_lv0020->lv051="";
$motc_lv0020->lv052="";
$motc_lv0020->lv053="";
$motc_lv0020->lv054="";
$motc_lv0020->lv055="";
$motc_lv0020->lv056="";
$motc_lv0020->lv057="";
$motc_lv0020->lv058="";
$motc_lv0020->lv059="";
$motc_lv0020->lv060="";
$motc_lv0020->lv061="";
$motc_lv0020->lv062="";
$motc_lv0020->lv063="";
$motc_lv0020->lv064="";
$motc_lv0020->lv065="";
$motc_lv0020->lv065="";
$motc_lv0020->lv066="";
$motc_lv0020->lv067="";
$motc_lv0020->lv068="";
$motc_lv0020->lv069="";
$motc_lv0020->lv070="";
$motc_lv0020->lv071="";
$motc_lv0020->lv072="";
$motc_lv0020->lv073="";
$motc_lv0020->lv074="";
$motc_lv0020->lv075="";
$motc_lv0020->lv076="";
$motc_lv0020->lv077="";
$motc_lv0020->lv078="";
$motc_lv0020->lv079="";
$motc_lv0020->lv080="";
$motc_lv0020->lv081="";
$motc_lv0020->lv082="";
$motc_lv0020->lv083="";
$motc_lv0020->lv084="";
$motc_lv0020->lv085="";
$motc_lv0020->lv086="";
$motc_lv0020->lv087="";
$motc_lv0020->lv088="";
$motc_lv0020->lv089="";
$motc_lv0020->lv090="";
$motc_lv0020->lv091="";
$motc_lv0020->lv092="";
$motc_lv0020->lv093="";
$motc_lv0020->lv094="";
$motc_lv0020->lv095="";
$motc_lv0020->lv096="";
$motc_lv0020->lv097="";
$motc_lv0020->lv098=$motc_lv0013->lv001;
$motc_lv0020->lv099="";
$motc_lv0020->lv0100="";
$motc_lv0020->lv0101="";
}
elseif($flagID==6)
{
	$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0021');
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0020->LV_SendSalaryPayroll($strar);
	$motc_lv0020->lv001="";
$motc_lv0020->lv003="";
$motc_lv0020->lv004="";
$motc_lv0020->lv005="";
$motc_lv0020->lv006="";
$motc_lv0020->lv007="";
$motc_lv0020->lv008="";
$motc_lv0020->lv009="";
$motc_lv0020->lv010="";
$motc_lv0020->lv011="";
$motc_lv0020->lv012="";
$motc_lv0020->lv013="";
$motc_lv0020->lv014="";
$motc_lv0020->lv015="";
$motc_lv0020->lv016="";
$motc_lv0020->lv017="";
$motc_lv0020->lv018="";
$motc_lv0020->lv019="";
$motc_lv0020->lv020="";
$motc_lv0020->lv021="";
$motc_lv0020->lv022="";
$motc_lv0020->lv023="";
$motc_lv0020->lv024="";
$motc_lv0020->lv025="";
$motc_lv0020->lv026="";
$motc_lv0020->lv027="";
$motc_lv0020->lv028="";
$motc_lv0020->lv029="";
$motc_lv0020->lv030="";
$motc_lv0020->lv031="";
$motc_lv0020->lv032="";
$motc_lv0020->lv033="";
$motc_lv0020->lv034="";
$motc_lv0020->lv035="";
$motc_lv0020->lv036="";
$motc_lv0020->lv037="";
$motc_lv0020->lv038="";
$motc_lv0020->lv039="";
$motc_lv0020->lv040="";
$motc_lv0020->lv041="";
$motc_lv0020->lv042="";
$motc_lv0020->lv043="";
$motc_lv0020->lv044="";
$motc_lv0020->lv045="";
$motc_lv0020->lv046="";
$motc_lv0020->lv047="";
$motc_lv0020->lv048="";
$motc_lv0020->lv049="";
$motc_lv0020->lv050="";
$motc_lv0020->lv051="";
$motc_lv0020->lv052="";
$motc_lv0020->lv053="";
$motc_lv0020->lv054="";
$motc_lv0020->lv055="";
$motc_lv0020->lv056="";
$motc_lv0020->lv057="";
$motc_lv0020->lv058="";
$motc_lv0020->lv059="";
$motc_lv0020->lv060="";
$motc_lv0020->lv061="";
$motc_lv0020->lv062="";
$motc_lv0020->lv063="";
$motc_lv0020->lv064="";
$motc_lv0020->lv065="";
$motc_lv0020->lv065="";
$motc_lv0020->lv066="";
$motc_lv0020->lv067="";
$motc_lv0020->lv068="";
$motc_lv0020->lv069="";
$motc_lv0020->lv070="";
$motc_lv0020->lv071="";
$motc_lv0020->lv072="";
$motc_lv0020->lv073="";
$motc_lv0020->lv074="";
$motc_lv0020->lv075="";
$motc_lv0020->lv076="";
$motc_lv0020->lv077="";
$motc_lv0020->lv078="";
$motc_lv0020->lv079="";
$motc_lv0020->lv080="";
$motc_lv0020->lv081="";
$motc_lv0020->lv082="";
$motc_lv0020->lv083="";
$motc_lv0020->lv084="";
$motc_lv0020->lv085="";
$motc_lv0020->lv086="";
$motc_lv0020->lv087="";
$motc_lv0020->lv088="";
$motc_lv0020->lv089="";
$motc_lv0020->lv090="";
$motc_lv0020->lv091="";
$motc_lv0020->lv092="";
$motc_lv0020->lv093="";
$motc_lv0020->lv094="";
$motc_lv0020->lv095="";
$motc_lv0020->lv096="";
$motc_lv0020->lv097="";
$motc_lv0020->lv099="";
$motc_lv0020->lv0100="";
$motc_lv0020->lv0101="";
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0020->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0020');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0020->ListView;
$curPage = $motc_lv0020->CurPage;
$maxRows =$motc_lv0020->MaxRows;
$vOrderList=$motc_lv0020->ListOrder;
$vSortNum=$motc_lv0020->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$motc_lv0020->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0020',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if( $_GET['ID']=="")
$motc_lv0020->lv002=$_POST['txtlv002'];
else
$motc_lv0020->lv002= $_GET['ID'] ?? '';
$motc_lv0008->LV_LoadCurrentID($motc_lv0020->lv002,$motc_lv0013->lv007);
//$motc_lv0020->LV_LoadCurrentID($motc_lv0020->lv002,$motc_lv0020->lv098);
$motc_lv0020->lv060=$motc_lv0013->lv001;

if($maxRows ==0) $maxRows = 10;
$totalRowsC=$motc_lv0020->GetCount();
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
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
</head>
<script language="JavaScript" type="text/javascript">
<!--
function FunctRunning1(vID)
{
RunFunction(vID,'child');
}
function Add()
{

var o=document.frmchoose;
	o.txtFlag.value=5;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();

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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe height=1800 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>tc_lv0020?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	o.action="<?php echo $vDir;?>tc_lv0020?func=<?php echo $_GET['func'];?>&func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function SendSalaryPayroll()
{
	lv_chk_list(document.frmchoose,'lvChk',7);
}
function FunctRunning2(vValue)
{
	if(confirm("Bạn có đồng ý gửi phiếu lương và khóa lương?"))
		{
	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=6;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
	}
}
//-->
</script>
<?php
if($motc_lv0020->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" method="post" name="frmchoose" id="frmchoose">
					 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#f2f2f2;font:10px arial"><tr>
							<?php
							if($motc_lv0020->GetApr()==1 && $motc_lv0020->GetUnApr()==1)
							{?>
													<td><input type="button" value="Gửi mail phiếu lương" onclick="SendSalaryPayroll()"/></td>
							<?php
							}			
							?>			
							</tr>
						</table>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					  <!--<input type="checkbox" name="txtCalID" value="1"/>Tính lương theo hợp đồng cũ
                      <div style="float:left">Loại tính lương<select  name="txtlv030"  id="txtlv030"  tabindex="1" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/><?php echo $motc_lv0020->LV_LinkField('lv030',($motc_lv0020->lv030=="" && $motc_lv0020->lv030==null)?$motc_lv0008->lv008:$motc_lv0020->lv030);?></select>&nbsp; Phòng ban<select  name="txtlv031"  id="txtlv031"  tabindex="1" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/><?php echo $motc_lv0020->LV_LinkField('lv031',$motc_lv0020->lv031);?></select><br />&nbsp; Lương sản phẩm<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $motc_lv0020->lv025;?>">-->
					  <div>
						<?php echo $motc_lv0020->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $motc_lv0020->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $motc_lv0020->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $motc_lv0020->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $motc_lv0020->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $motc_lv0020->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $motc_lv0020->lv006;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $motc_lv0020->lv011;?>"/>
					  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  
</div></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $motc_lv0020->ArrPush[0];?>';	
</script>
</html>