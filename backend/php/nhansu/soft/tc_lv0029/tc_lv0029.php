<?php
session_start();
$vDir="";
require_once("../clsall/lv_controler.php");
require_once($vDir."../clsall/tc_lv0029.php");
require_once($vDir."../clsall/jo_lv0016.php");
$motc_lv0029=new tc_lv0029($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0029');
$mojo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0016');
function SaveAndGetFile($vFileRead,$odbcfile)
	{	

			$vDate=GetServerDate();
			$vTime=GetServerTime();
			$strFolder='';
//			$strFolder=$vUserID;


			$handle = fopen($vFileRead, "r" );
			$contents = fread($handle, filesize($vFileRead));
			fclose( $handle );
			$fp = fopen($odbcfile, "w" );
			fwrite( $fp,$contents );
			fclose( $fp);
			return $odbcfile;			
	}
$vDir="";
$plang=$_GET['lang'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TC0045.txt",$plang);
$motc_lv0029->ArrFunc[9]=$vLangArr[12];
$strCodeFile=$_GET['CodeFile'];
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$vopt=(int)$_POST['txtday'];
$datadate=$_POST['datadate'];
$vdatadate=recoverdate($_POST['datadate'],$plang);
if($datadate=="") $datadate=formatdate(GetServerDate(),$plang);
$vauto=$_GET['auto'];
if($vFlag==1 || $vauto==1)
{	
//$vPathSave="../database/";


/////////Load object/////////////
//$odbcfile =$_SERVER['DOCUMENT_ROOT']."/".dirname(dirname($_SERVER['PHP_SELF']))."/database/timecard.mdb";
/*if($_FILES['userfile']['tmp_name']!="" && filesize($_FILES['userfile']['tmp_name'])!=NULL) $strReturn=SaveAndGetFile($_FILES['userfile']['tmp_name'],$odbcfile);
$molv_connectdsn->Load('CON005');
$molv_toolodbc->setconnect('timecard','','',$odbcfile);
$molv_toolodbc->SetDataTranfer('','',0);
$molv_toolodbc->SetOwner('');
$motc_lv0029->LoadAccess($molv_toolodbc,$datadate,'CHECKINOUT','SSN','CHECKTIME','CHECKTIME','CHECKTYPE');
*/
$mojo_lv0016->LV_Load();
$vServer=$mojo_lv0016->lv006;
$vUser=$mojo_lv0016->lv007;
$vPass=$mojo_lv0016->lv008;
$vDatabase=$mojo_lv0016->lv009;

$motc_lv0029->LV_LoadSQLServer($vServer,$vUser,$vPass,$vDatabase,(int)getYear($vdatadate),(int)getMonth($vdatadate),(int)getDay($vdatadate),$vopt);

}
?>
<script language="javascript">
function Back()
{
opener.document.frmRequirement.txtPackingID.focus();
window.close();
}
function SaveLoadFile()
{
	var o=document.frmgeneral;
	if(o.datadate.value=="")
	{
		o.datadate.focus();
		alert('<?php echo $vLangArr[11];?>');
	}
	else
	{
		o.submit();
	}
}
</script>
<link rel="stylesheet" href="../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../css/popup.css" type="text/css">
<script language="javascript" src="../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../javascripts/engines.js"></script>
<?php

if(1==1)
{
?>
<!------------------------------------------------------------------------>
	
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				<form action="#" method="post" enctype="multipart/form-data" name="frmgeneral" id="frmgeneral" onsubmit="return false;">
					<input type="hidden" name="txtFlag" id="txtFlag" value="1" />
			<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td height="20px" colspan="3" align="right"><?php echo $motc_lv0029->LV_ViewHelp($vFieldList,'document.frmgeneral',$vOrderList);?></td>
			  </tr>
				<tr>
							  <td height="20px" colspan="3" align="center"><h2><?php echo $vLangArr[0];?></h2></td>
				</tr>
				  <tr>
				     <td width="308" align="left"><?php echo $vLangArr[4];?> :</td>
					<td width="266" height="20px" align="left"><input type="text" name="datadate" id="datadate" value="<?php echo $datadate;?>"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmgeneral.datadate);return false;" /></td>
		      </tr>
			<tr>
				<td ><?php echo $vLangArr[13];?></td>
				<td><input type="checkbox" name="txtday" value="1" <?php echo ($_POST['txtday']==1)?'checked="checked"':'';?>/>
			</tr>
				  <tr>
				    <td height="24" colspan="3" align="center">&nbsp;</td>
		      </tr>
				  <tr>
				    <td height="24" colspan="3" align="center"><input type="submit" name="Submit" value="<?php echo $vLangArr[6];?>" onclick="SaveLoadFile()"></td>
		      </tr>
                </table>					
		      </form>
			
    <iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $plang;?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php
} else {
	include("permit.php");
}
?>