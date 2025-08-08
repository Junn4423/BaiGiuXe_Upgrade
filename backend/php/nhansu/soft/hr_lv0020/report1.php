<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");

//////////////init object////////////////
$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$lvhr_lv0020->lv001=$vlv001;
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0022.txt",$plang);
$mohr_lv0020->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0020->LV_LoadID($lvhr_lv0020->lv001);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $lvhr_lv0020->lv002.'('.$lvhr_lv0020->lv001.')';?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/pubscript.js"></script>
<style>
.tablehr1 td
{
	font:12px Arial,Tahoma;
	padding:3px;
}
.tablehr1 td .lvhtable
{
	color:#fff !important;
}
.tablehr1
{
	padding:0px;
	border:0px;
}
table .lvtable
{
	border:0px!important;
	border-spacing:0px !important;
	width:1000px;
	float:left;
}
.fnt_bold
{
	font:12px bold Arial,Tahoma !important;
}
</style>
<?php
if($lvhr_lv0020->GetView()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
					
						<table width="1000" border="1" align="left" class="tablehr1" cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="4" height="100%" align="left"  >
								<table border="0"  width="1000" ><tr>
    <td align="right" ondblclick="this.innerHTML=''"><?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".$vlv001."'>";?></td>
  </tr>	
  <tr>
    <td align="left"  ondblclick="this.innerHTML=''"><img  src="<?php echo $lvhr_lv0020->GetLogo();?>" /></td>
  </tr></table>		</td>	
							</tr>
							<tr>
								<td colspan="4" align="left" ondblclick="this.innerHTML=''">
								<table id="bc_1" width="1000" border="1" align="left" class="tablehr1" cellpadding="0" cellspacing="0">
									<tr>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[15];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv001."&nbsp;";?></strong></td>
										<td colspan="2" rowspan="2"><div style="float:right"><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="96px" height="128px" 
										src="<?php echo "../../images/employees/".$lvhr_lv0020->lv001."/".$lvhr_lv0020->lv007; ?>" /></div></td>
									</tr>
									<tr>
									  <td  height="20"><?php echo $vLangArr[16];?></td>
									  <td  height="20"><strong><?php echo $lvhr_lv0020->lv002."&nbsp;";?></strong></td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[19];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv005;?>&nbsp;</strong></td>
										<td  height="20"><?php echo $vLangArr[20];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv006;?>&nbsp;</strong></td>
									</tr>	
									<tr>
										<td  height="20"><?php echo $vLangArr[43];?>&nbsp;</td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv029',$lvhr_lv0020->lv029);?>&nbsp;</strong></td>
										</td>
										<td  height="20"><?php echo $vLangArr[23];?></td>
									  <td  height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv009',$lvhr_lv0020->lv009);?>&nbsp;</strong></td>
									</tr>
									<tr>
									  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[24];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv010;?></strong></td>
										<td  height="20"><?php echo $vLangArr[25];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv011,2);?></strong></td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[26];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv012;?></strong></td>
										<td  height="20"><?php echo $vLangArr[27];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv013;?></strong></td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[28];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv014;?></strong></td>
										<td  height="20"><?php echo $vLangArr[29];?></td>
										<td  height="20"><strong><?php echo ($lvhr_lv0020->lv069==1)?getyear($lvhr_lv0020->lv015):$lvhr_lv0020->FormatView($lvhr_lv0020->lv015,2);?></strong></td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[30];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv016;?></strong></td>
										<td  height="20"><?php echo $vLangArr[62];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv045;?></strong></td>
									</tr>
										<tr>
									  <td  height="20"><?php echo $vLangArr[32];?></td>
									  <td  height="20"><strong><?php echo ((int)$lvhr_lv0020->lv018==0)?"Nữ":"Nam";?></strong></td>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[33];?></td>
										<td height="20"><strong><?php echo ((int)$lvhr_lv0020->lv019==0)?'Không':'Có';?></strong></td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[34];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv020;?></strong></td>
										<td  height="20"><?php echo $vLangArr[35];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv021,2);?></strong></td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[57];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv043;?></strong></td>
										<td  height="20"><?php echo $vLangArr[36];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv022',$lvhr_lv0020->lv022);?></strong></td>
									</tr>							  
									<tr>
									  <td  height="20"><?php echo $vLangArr[31];?></td>
									  <td  height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv017',$lvhr_lv0020->lv017);?></strong></td>
									  <td  height="20"><?php echo $vLangArr[37];?></td>
									  <td  height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv023',$lvhr_lv0020->lv023);?></strong></td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[38];?></td>
										<td  height="20"> <strong><?php echo $lvhr_lv0020->getvaluelink('lv024',$lvhr_lv0020->lv024);?></strong></td>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[76];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv099;?></strong></td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[77];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv102;?></strong></td>
													
										<td height="20"><?php echo 'Mã NV chính(Chỉ user HC)';?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv101;?></strong></td>
									</tr>
									<tr>
										<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[40];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv026',$lvhr_lv0020->lv026);?></strong></td>
										<td  height="20"><?php echo $vLangArr[41];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv027',$lvhr_lv0020->lv027);?></strong></td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[42];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv028',$lvhr_lv0020->lv028);?></strong></td>
									  <td  height="20"><?php echo $vLangArr[22];?></td>
									  <td  height="20"><strong><?php echo $lvhr_lv0020->lv008;?></strong></td>
									</tr>							  
									<tr>  
									  <td  height="20"><?php echo $vLangArr[44];?></td>
									  <td  height="20"><strong><?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv030,2);?></strong></td>
									  <td  height="20"><?php echo $vLangArr[58];?></td>
									  <td  height="20"><strong><?php echo $lvhr_lv0020->FormatView($lvhr_lv0020->lv044,2);?></strong></td>
									</tr>		
									<tr>
										  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
									</tr>
									<tr>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[45];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv031',$lvhr_lv0020->lv031);?></strong></td>
										<td  height="20"><?php echo $vLangArr[46];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv032',$lvhr_lv0020->lv032);?></strong></td>
									</tr>
									<tr>
										<td  height="20"><?php echo $vLangArr[47];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv033;?></strong></td>
										<td  height="20"><?php echo $vLangArr[48];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv034;?></strong></td>
									</tr>							  
									<tr>
										<td  height="20"><?php echo $vLangArr[49];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv035;?></strong></td>
										<td  height="20"><?php echo $vLangArr[50];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv036;?></strong></td>
									</tr>		
									<tr>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[51];?></td>
										<td height="20">
											<strong><?php echo $lvhr_lv0020->lv037;?></strong></td>
										<td  height="20"><?php echo $vLangArr[52];?></td>
										<td  height="20"><strong><?php echo $lvhr_lv0020->lv038;?></strong></td>
									</tr>
									<tr>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[53];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv039;?></strong></td>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[54];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv040;?></strong></td>
									</tr>
									<tr>
									  <td  height="20"><?php echo $vLangArr[55];?></td>
									  <td  height="20"><strong><?php echo $lvhr_lv0020->lv041;?></strong></td>
									  <td  height="20"><?php echo $vLangArr[56];?></td>
									  <td  height="20"><strong><?php echo $lvhr_lv0020->getvaluelink('lv042',$lvhr_lv0020->lv042);?></strong></td>
									</tr>
									<tr>
										  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
									</tr>
									<tr>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[75];?></td>
										<td height="20"><strong><?php echo ((int)$lvhr_lv0020->lv072==0)?'Không':'Có';?></strong></td>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[64];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv061;?></strong></td>
									</tr>
									<tr>
									<td height="20" class="fnt_bold"><?php echo $vLangArr[63];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv060;?></strong></td>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[70];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv067;?></strong></td>
									</tr>
									<tr>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[65];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv062;?></strong></td>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[66];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv063;?></strong></td>
									</tr>
									<tr>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[67];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv064;?></strong></td>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[68];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv065;?></strong></td>
									</tr>
									<tr>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[69];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv066;?></strong></td>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[81];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv049;?></strong></td>
									</tr>
									<tr>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[71];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv068;?></strong></td>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[72];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv069;?></strong></td>
									</tr>
									<tr>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[73];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv070;?></strong></td>
										<td height="20" class="fnt_bold"><?php echo $vLangArr[74];?></td>
										<td height="20"><strong><?php echo $lvhr_lv0020->lv071;?></strong></td>
									</tr>

									</table>
							  	</td>								
							<tr>
							  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
							</tr>
							
							  <?php   
require_once("../../clsall/hr_lv0024.php");

/////////////init object//////////////
$mohr_lv0024=new hr_lv0024($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0049');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0100.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0024->ArrPush[0]=$vLangArr[17];
$mohr_lv0024->ArrPush[1]=$vLangArr[18];
$mohr_lv0024->ArrPush[2]=$vLangArr[20];
$mohr_lv0024->ArrPush[3]=$vLangArr[21];
$mohr_lv0024->ArrPush[4]=$vLangArr[22];
$mohr_lv0024->ArrPush[5]=$vLangArr[23];
$mohr_lv0024->ArrPush[6]=$vLangArr[24];
$mohr_lv0024->ArrPush[7]=$vLangArr[25];
$mohr_lv0024->ArrPush[8]=$vLangArr[26];

$mohr_lv0024->ArrFunc[0]='//Function';
$mohr_lv0024->ArrFunc[1]=$vLangArr[2];
$mohr_lv0024->ArrFunc[2]=$vLangArr[4];
$mohr_lv0024->ArrFunc[3]=$vLangArr[6];
$mohr_lv0024->ArrFunc[4]=$vLangArr[7];
$mohr_lv0024->ArrFunc[5]='';
$mohr_lv0024->ArrFunc[6]='';
$mohr_lv0024->ArrFunc[7]='';
$mohr_lv0024->ArrFunc[8]=$vLangArr[10];
$mohr_lv0024->ArrFunc[9]=$vLangArr[12];
$mohr_lv0024->ArrFunc[10]=$vLangArr[0];
$mohr_lv0024->ArrFunc[11]=$vLangArr[29];
$mohr_lv0024->ArrFunc[12]=$vLangArr[30];
$mohr_lv0024->ArrFunc[13]=$vLangArr[31];
$mohr_lv0024->ArrFunc[14]=$vLangArr[32];
$mohr_lv0024->ArrFunc[15]=$vLangArr[33];
////Other
$mohr_lv0024->ArrOther[1]=$vLangArr[27];
$mohr_lv0024->ArrOther[2]=$vLangArr[28];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0024->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0024');
$mohr_lv0024->lv002=$vlv001;
$vFieldList=$mohr_lv0024->ListView;
$curPage = $mohr_lv0024->CurPage;
$maxRows =$mohr_lv0024->MaxRows;
$vOrderList=$mohr_lv0024->ListOrder;
$vCount=$mohr_lv0024->GetCount();
if($mohr_lv0024->GetView()==1 && $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0024->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					</td>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>
<?php
}
?>
							  <?php 
require_once("../../clsall/hr_lv0026.php");

/////////////init object//////////////
$mohr_lv0026=new hr_lv0026($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0047');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0103.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0026->lang=strtoupper($plang);
$mohr_lv0026->ArrPush[0]=$vLangArr[17];
$mohr_lv0026->ArrPush[1]=$vLangArr[18];
$mohr_lv0026->ArrPush[2]=$vLangArr[20];
$mohr_lv0026->ArrPush[3]=$vLangArr[21];
$mohr_lv0026->ArrPush[4]=$vLangArr[22];
$mohr_lv0026->ArrPush[5]=$vLangArr[23];
$mohr_lv0026->ArrPush[6]=$vLangArr[24];
$mohr_lv0026->ArrPush[7]=$vLangArr[25];
$mohr_lv0026->ArrPush[8]=$vLangArr[26];
$mohr_lv0026->ArrPush[9]=$vLangArr[27];
$mohr_lv0026->ArrPush[10]=$vLangArr[28];
$mohr_lv0026->ArrPush[11]=$vLangArr[29];
$mohr_lv0026->ArrPush[12]=$vLangArr[37];
$mohr_lv0026->ArrPush[13]=$vLangArr[38];
$mohr_lv0026->ArrPush[14]=$vLangArr[39];
$mohr_lv0026->ArrPush[100]=$vLangArr[40];

$mohr_lv0026->ArrFunc[0]='//Function';
$mohr_lv0026->ArrFunc[1]=$vLangArr[2];
$mohr_lv0026->ArrFunc[2]=$vLangArr[4];
$mohr_lv0026->ArrFunc[3]=$vLangArr[6];
$mohr_lv0026->ArrFunc[4]=$vLangArr[7];
$mohr_lv0026->ArrFunc[5]='';
$mohr_lv0026->ArrFunc[6]='';
$mohr_lv0026->ArrFunc[7]='';
$mohr_lv0026->ArrFunc[8]=$vLangArr[10];
$mohr_lv0026->ArrFunc[9]=$vLangArr[12];
$mohr_lv0026->ArrFunc[10]=$vLangArr[0];
$mohr_lv0026->ArrFunc[11]=$vLangArr[32];
$mohr_lv0026->ArrFunc[12]=$vLangArr[33];
$mohr_lv0026->ArrFunc[13]=$vLangArr[34];
$mohr_lv0026->ArrFunc[14]=$vLangArr[35];
$mohr_lv0026->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0026->ArrOther[1]=$vLangArr[30];
$mohr_lv0026->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0026->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0026');
$mohr_lv0026->lv002=$vlv001;
$vFieldList=$mohr_lv0026->ListView;
$curPage = $mohr_lv0026->CurPage;
$maxRows =$mohr_lv0026->MaxRows;
$vOrderList=$mohr_lv0026->ListOrder;
$vCount=$mohr_lv0026->GetCount();

if($mohr_lv0026->GetView()==1 && $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0026->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					</td>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}
?>
							<?php 
require_once("../../clsall/hr_lv0027.php");

/////////////init object//////////////
$mohr_lv0027=new hr_lv0027($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0054');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0107.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0027->ArrPush[0]=$vLangArr[17];
$mohr_lv0027->ArrPush[1]=$vLangArr[18];
$mohr_lv0027->ArrPush[2]=$vLangArr[20];
$mohr_lv0027->ArrPush[3]=$vLangArr[21];
$mohr_lv0027->ArrPush[4]=$vLangArr[22];
$mohr_lv0027->ArrPush[5]=$vLangArr[23];
$mohr_lv0027->ArrPush[6]=$vLangArr[24];
$mohr_lv0027->ArrPush[7]=$vLangArr[25];
$mohr_lv0027->ArrPush[8]=$vLangArr[26];
$mohr_lv0027->ArrPush[9]=$vLangArr[27];
$mohr_lv0027->ArrPush[10]=$vLangArr[28];
$mohr_lv0027->ArrPush[11]=$vLangArr[29];
$mohr_lv0027->ArrPush[12]=$vLangArr[30];

$mohr_lv0027->ArrFunc[0]='//Function';
$mohr_lv0027->ArrFunc[1]=$vLangArr[2];
$mohr_lv0027->ArrFunc[2]=$vLangArr[4];
$mohr_lv0027->ArrFunc[3]=$vLangArr[6];
$mohr_lv0027->ArrFunc[4]=$vLangArr[7];
$mohr_lv0027->ArrFunc[5]='';
$mohr_lv0027->ArrFunc[6]='';
$mohr_lv0027->ArrFunc[7]='';
$mohr_lv0027->ArrFunc[8]=$vLangArr[10];
$mohr_lv0027->ArrFunc[9]=$vLangArr[12];
$mohr_lv0027->ArrFunc[10]=$vLangArr[0];
$mohr_lv0027->ArrFunc[11]=$vLangArr[32];
$mohr_lv0027->ArrFunc[12]=$vLangArr[33];
$mohr_lv0027->ArrFunc[13]=$vLangArr[34];
$mohr_lv0027->ArrFunc[14]=$vLangArr[35];
$mohr_lv0027->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0027->ArrOther[1]=$vLangArr[30];
$mohr_lv0027->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0027->lv002=$vlv001;
$mohr_lv0027->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0027');
$vFieldList=$mohr_lv0027->ListView;
$curPage = $mohr_lv0027->CurPage;
$maxRows =$mohr_lv0027->MaxRows;
$vOrderList=$mohr_lv0027->ListOrder;
$vCount=$mohr_lv0027->GetCount();

if($mohr_lv0027->GetView()==1 && $vCount>0)
{
?>
<tr>
							  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0027->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
</td>
						  </tr>
<tr>
							  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
						  </tr>						  
					<?php
}
require_once("../../clsall/hr_lv0133.php");
$mohr_lv0133=new hr_lv0133($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0133');
$mohr_lv0133->DefaultFieldList='lv001,lv002,lv090,lv091,lv003,lv004,lv005,lv006,lv007';
/////////////init object//////////////
$vLangArr=GetLangFile("../../","HR0264.txt",$plang);
$mohr_lv0133->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0133->ArrPush[0]=$vLangArr[17];
$mohr_lv0133->ArrPush[1]=$vLangArr[18];
$mohr_lv0133->ArrPush[2]=$vLangArr[20];
$mohr_lv0133->ArrPush[3]=$vLangArr[21];
$mohr_lv0133->ArrPush[4]=$vLangArr[22];
$mohr_lv0133->ArrPush[5]=$vLangArr[23];
$mohr_lv0133->ArrPush[6]=$vLangArr[24];
$mohr_lv0133->ArrPush[7]=$vLangArr[25];
$mohr_lv0133->ArrPush[8]=$vLangArr[26];
$mohr_lv0133->ArrPush[91]=($plang=='EN')?'Date From':'Từ ngày';
$mohr_lv0133->ArrPush[92]=($plang=='EN')?'Date To':'Đến ngày';


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0133->lv003=$vlv001;
$mohr_lv0133->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0133');
$vFieldList=$mohr_lv0133->DefaultFieldList;
$curPage = $mohr_lv0133->CurPage;
$maxRows =$mohr_lv0133->MaxRows;
$vOrderList='1,2,3,4,5,6,7,8,9';
$vCount=$mohr_lv0133->GetCount();

if($mohr_lv0133->GetView()==1 && $vCount>0)
{
?>
<tr>
							  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0133->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
</td>
						  </tr>
<tr>
							  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
						  </tr>						  
					<?php
}
require_once("../../clsall/ts_lv0020.php");
require_once("../../clsall/ts_lv0009.php");
$mots_lv0009=new ts_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0009');
$mots_lv0020=new ts_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0020');
$mots_lv0009->objlot=$mots_lv0020;
/////////////init object//////////////
$vLangArr=GetLangFile("../../","WH0012.txt",$plang);
$mots_lv0009->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0009->ArrPush[0]=($plang=='VN')?'TRẢ VẬT TƯ ':'RETURN ITEM PRODUCT';
$mots_lv0009->ArrPush[1]=$vLangArr[18];
$mots_lv0009->ArrPush[2]=$vLangArr[19];
$mots_lv0009->ArrPush[3]=$vLangArr[20];
$mots_lv0009->ArrPush[4]=$vLangArr[21];
$mots_lv0009->ArrPush[5]=$vLangArr[22];
$mots_lv0009->ArrPush[6]=$vLangArr[23];
$mots_lv0009->ArrPush[7]=$vLangArr[24];
$mots_lv0009->ArrPush[8]=$vLangArr[25];
$mots_lv0009->ArrPush[9]=$vLangArr[26];
$mots_lv0009->ArrPush[10]=$vLangArr[27];
$mots_lv0009->ArrPush[11]=$vLangArr[28];
$mots_lv0009->ArrPush[12]=$vLangArr[29];
$mots_lv0009->ArrPush[13]=$vLangArr[30];
$mots_lv0009->ArrPush[14]=$vLangArr[31];
$mots_lv0009->ArrPush[15]=$vLangArr[32];
$mots_lv0009->ArrPush[16]=$vLangArr[33];
$mots_lv0009->ArrPush[17]=$vLangArr[34];
$mots_lv0009->ArrPush[18]=$vLangArr[42];
$mots_lv0009->ArrPush[89]=$vLangArr[49];
$mots_lv0009->ArrPush[98]=$vLangArr[43];
$mots_lv0009->ArrPush[99]=$vLangArr[44];
$mots_lv0009->ArrPush[100]='PO#/ContractID';
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0009->lv007=$vlv001;
$mots_lv0009->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0009');
$vFieldList=$mots_lv0009->DefaultFieldList;
$curPage = $mots_lv0009->CurPage;
$maxRows =$mots_lv0009->MaxRows;
$vCount=$mots_lv0009->GetCount();

if($mots_lv0009->GetView()==1 && $vCount>0)
{
?>
<tr>
							  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mots_lv0009->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
</td>
						  </tr>
<tr>
							  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
						  </tr>						  
					<?php
}
require_once("../../clsall/ts_lv0011.php");
$mots_lv0011=new ts_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0011');
$mots_lv0011->objlot=$mots_lv0020;
/////////////init object//////////////
$vLangArr=GetLangFile("../../","WH0017.txt",$plang);
$mots_lv0011->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0011->ArrPush[0]=($plang=='VN')?'NHẬN VẬT TƯ ':'RECEIVE ITEM PRODUCT';
$mots_lv0011->ArrPush[1]=$vLangArr[18];
$mots_lv0011->ArrPush[2]=$vLangArr[19];
$mots_lv0011->ArrPush[3]=$vLangArr[20];
$mots_lv0011->ArrPush[4]=$vLangArr[21];
$mots_lv0011->ArrPush[5]=$vLangArr[22];
$mots_lv0011->ArrPush[6]=$vLangArr[23];
$mots_lv0011->ArrPush[7]=$vLangArr[24];
$mots_lv0011->ArrPush[8]=$vLangArr[25];
$mots_lv0011->ArrPush[9]=$vLangArr[26];
$mots_lv0011->ArrPush[10]=$vLangArr[27];
$mots_lv0011->ArrPush[11]=$vLangArr[28];
$mots_lv0011->ArrPush[12]=$vLangArr[29];
$mots_lv0011->ArrPush[13]=$vLangArr[30];
$mots_lv0011->ArrPush[14]=$vLangArr[31];
$mots_lv0011->ArrPush[15]=$vLangArr[32];
$mots_lv0011->ArrPush[16]=$vLangArr[33];
$mots_lv0011->ArrPush[17]=$vLangArr[34];
$mots_lv0011->ArrPush[18]=$vLangArr[42];
$mots_lv0011->ArrPush[22]=$vLangArr[42];
$mots_lv0011->ArrPush[98]=$vLangArr[43];
$mots_lv0011->ArrPush[99]=$vLangArr[44];
$mots_lv0011->ArrPush[89]=$vLangArr[45];
$mots_lv0011->ArrPush[100]='PO#/ContractID';
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0011->lv007=$vlv001;
$mots_lv0011->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0011');
$vFieldList=$mots_lv0011->DefaultFieldList;
$curPage = $mots_lv0011->CurPage;
$maxRows =$mots_lv0011->MaxRows;
$vCount=$mots_lv0011->GetCount();

if($mots_lv0011->GetView()==1 && $vCount>0)
{
?>
<tr>
							  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mots_lv0011->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
</td>
						  </tr>
<tr>
							  <td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
						  </tr>						  
					<?php
}
require_once("../../clsall/hr_lv0038.php");

/////////////init object//////////////
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0123.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0038->ArrPush[0]=$vLangArr[17];
$mohr_lv0038->ArrPush[1]=$vLangArr[18];
$mohr_lv0038->ArrPush[2]=$vLangArr[20];
$mohr_lv0038->ArrPush[3]=$vLangArr[21];
$mohr_lv0038->ArrPush[4]=$vLangArr[22];
$mohr_lv0038->ArrPush[5]=$vLangArr[23];
$mohr_lv0038->ArrPush[6]=$vLangArr[24];
$mohr_lv0038->ArrPush[7]=$vLangArr[25];
$mohr_lv0038->ArrPush[8]=$vLangArr[26];
$mohr_lv0038->ArrPush[9]=$vLangArr[27];
$mohr_lv0038->ArrPush[10]=$vLangArr[28];
$mohr_lv0038->ArrPush[11]=$vLangArr[36];
$mohr_lv0038->ArrPush[12]=$vLangArr[37];
$mohr_lv0038->ArrPush[13]=$vLangArr[38];
$mohr_lv0038->ArrPush[14]=$vLangArr[39];
$mohr_lv0038->ArrPush[15]=$vLangArr[40];
$mohr_lv0038->ArrPush[16]=$vLangArr[41];
$mohr_lv0038->ArrPush[17]=$vLangArr[42];
$mohr_lv0038->ArrPush[18]=$vLangArr[43];
$mohr_lv0038->ArrPush[19]=$vLangArr[44];
$mohr_lv0038->ArrPush[20]=$vLangArr[45];
$mohr_lv0038->ArrPush[21]=$vLangArr[46];
$mohr_lv0038->ArrPush[22]=$vLangArr[47];
$mohr_lv0038->ArrPush[23]=$vLangArr[48];
$mohr_lv0038->ArrPush[24]=$vLangArr[49];
$mohr_lv0038->ArrPush[25]=$vLangArr[50];
$mohr_lv0038->ArrPush[26]=$vLangArr[51];
$mohr_lv0038->ArrPush[27]=$vLangArr[52];
$mohr_lv0038->ArrPush[28]=$vLangArr[53];
$mohr_lv0038->ArrPush[29]=$vLangArr[54];
$mohr_lv0038->ArrPush[30]=$vLangArr[55];
$mohr_lv0038->ArrPush[31]=$vLangArr[56];

$mohr_lv0038->ArrPush[32]=$vLangArr[60];
$mohr_lv0038->ArrPush[33]=$vLangArr[61];
$mohr_lv0038->ArrPush[34]=$vLangArr[62];

$mohr_lv0038->ArrPush[100]=$vLangArr[57];
$mohr_lv0038->ArrPush[111]=$vLangArr[58];
$mohr_lv0038->ArrPush[101]=$vLangArr[59];

$mohr_lv0038->ArrFunc[0]='//Function';
$mohr_lv0038->ArrFunc[1]=$vLangArr[2];
$mohr_lv0038->ArrFunc[2]=$vLangArr[4];
$mohr_lv0038->ArrFunc[3]=$vLangArr[6];
$mohr_lv0038->ArrFunc[4]=$vLangArr[7];
$mohr_lv0038->ArrFunc[5]='';
$mohr_lv0038->ArrFunc[6]='';
$mohr_lv0038->ArrFunc[7]='';
$mohr_lv0038->ArrFunc[8]=$vLangArr[10];
$mohr_lv0038->ArrFunc[9]=$vLangArr[12];
$mohr_lv0038->ArrFunc[10]=$vLangArr[0];
$mohr_lv0038->ArrFunc[11]=$vLangArr[32];
$mohr_lv0038->ArrFunc[12]=$vLangArr[33];
$mohr_lv0038->ArrFunc[13]=$vLangArr[34];
$mohr_lv0038->ArrFunc[14]=$vLangArr[35];
$mohr_lv0038->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0038->ArrOther[1]=$vLangArr[30];
$mohr_lv0038->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0038->lv002=$vlv001;
$mohr_lv0038->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0038');
$vFieldList=$mohr_lv0038->ListView;
$curPage = $mohr_lv0038->CurPage;
$maxRows =$mohr_lv0038->MaxRows;
$vOrderList=$mohr_lv0038->ListOrder;
$vCount=$mohr_lv0038->GetCount();

if($mohr_lv0038->GetView()==1 && $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0038->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					</td>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}
require_once("../../clsall/hr_lv0098.php");

/////////////init object//////////////
$mohr_lv0098=new hr_lv0098($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0057');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0201.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0098->ArrPush[0]=$vLangArr[17];
$mohr_lv0098->ArrPush[1]=$vLangArr[18];
$mohr_lv0098->ArrPush[2]=$vLangArr[20];
$mohr_lv0098->ArrPush[3]=$vLangArr[21];
$mohr_lv0098->ArrPush[4]=$vLangArr[22];
$mohr_lv0098->ArrPush[5]=$vLangArr[23];
$mohr_lv0098->ArrPush[6]=$vLangArr[24];
$mohr_lv0098->ArrPush[7]=$vLangArr[25];
$mohr_lv0098->ArrPush[8]=$vLangArr[26];
$mohr_lv0098->ArrPush[9]=$vLangArr[27];
$mohr_lv0098->ArrPush[10]=$vLangArr[28];
$mohr_lv0098->ArrPush[11]=$vLangArr[29];
$mohr_lv0098->ArrPush[12]=$vLangArr[30];
$mohr_lv0098->ArrPush[13]=$vLangArr[31];
$mohr_lv0098->ArrPush[14]=$vLangArr[32];
$mohr_lv0098->ArrPush[100]=$vLangArr[33];

//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0098->lv002=$vlv001;
$mohr_lv0098->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0098');
$vFieldList=$mohr_lv0098->ListView;
$curPage = $mohr_lv0098->CurPage;
$maxRows =$mohr_lv0098->MaxRows;
$vOrderList=$mohr_lv0098->ListOrder;
$vCount=$mohr_lv0098->GetCount();
if($mohr_lv0098->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">

				<?php echo $mohr_lv0098->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php

} 
if($mohr_lv0038->GetView()==1)
{
	?>
	<tr>
		<td  height="20" colspan="4" ondblclick="this.innerHTML=''"><h1><?php echo ($plang=='VN')?'BÁO CÁO QUÁ TRÌNH TĂNG LƯƠNG, ĐỔI PHÒNG BAN, CHỨC VỤ':'REPORT HISTORY CHANGE SALLARY, CHANGE DEPPARMENT, CHANGE TITLE';?></h1></td>
	</tr>
	<tr>
		<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
<?php					
	//require_once("../../clsall/tc_lv0021.php");
	$motc_lv0021=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0021');
	if($motc_lv0021->GetView()==1)
		echo $mohr_lv0038->LV_GetSalaryIncrease($vlv001,1);
	else
		echo $mohr_lv0038->LV_GetSalaryIncrease($vlv001);
?>
<script language="javascript">
function AnHienNam(y)
{
	var o=document.getElementById('bmtangluong');
	var oj=document.getElementById(y);
	if(oj.value=='-')
	{
		oj.value='+';
		o.innerHTML=replaces(y+';displays:none',y+';display:none',o.innerHTML)
	}
	else
	{
		oj.value='-';
		o.innerHTML=replaces(y+';display:none',y+';displays:none',o.innerHTML)
	}
	
}
</script>
	</tr>
	<tr>
		<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
	</tr>	
<?php	
}
require_once("../../clsall/hr_lv0042.php");

/////////////init object//////////////
$mohr_lv0042=new hr_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0044');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0109.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0042->ArrPush[0]=$vLangArr[17];
$mohr_lv0042->ArrPush[1]=$vLangArr[18];
$mohr_lv0042->ArrPush[2]=$vLangArr[20];
$mohr_lv0042->ArrPush[3]=$vLangArr[21];
$mohr_lv0042->ArrPush[4]=$vLangArr[22];
$mohr_lv0042->ArrPush[5]=$vLangArr[23];
$mohr_lv0042->ArrPush[6]=$vLangArr[24];
$mohr_lv0042->ArrPush[7]=$vLangArr[25];
$mohr_lv0042->ArrPush[8]=$vLangArr[33];
$mohr_lv0042->ArrPush[9]=$vLangArr[27];
$mohr_lv0042->ArrPush[10]=$vLangArr[28];
$mohr_lv0042->ArrPush[11]=$vLangArr[29];
$mohr_lv0042->ArrPush[12]=$vLangArr[30];


$mohr_lv0042->ArrFunc[0]='//Function';
$mohr_lv0042->ArrFunc[1]=$vLangArr[2];
$mohr_lv0042->ArrFunc[2]=$vLangArr[4];
$mohr_lv0042->ArrFunc[3]=$vLangArr[6];
$mohr_lv0042->ArrFunc[4]=$vLangArr[7];
$mohr_lv0042->ArrFunc[5]='';
$mohr_lv0042->ArrFunc[6]='';
$mohr_lv0042->ArrFunc[7]='';
$mohr_lv0042->ArrFunc[8]=$vLangArr[10];
$mohr_lv0042->ArrFunc[9]=$vLangArr[12];
$mohr_lv0042->ArrFunc[10]=$vLangArr[0];
$mohr_lv0042->ArrFunc[11]=$vLangArr[32];
$mohr_lv0042->ArrFunc[12]=$vLangArr[33];
$mohr_lv0042->ArrFunc[13]=$vLangArr[34];
$mohr_lv0042->ArrFunc[14]=$vLangArr[35];
$mohr_lv0042->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0042->ArrOther[1]=$vLangArr[30];
$mohr_lv0042->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0042->lv002=$vlv001;
$mohr_lv0042->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0042');
$vFieldList=$mohr_lv0042->ListView;
$curPage = $mohr_lv0042->CurPage;
$maxRows =$mohr_lv0042->MaxRows;
$vOrderList=$mohr_lv0042->ListOrder;
$vCount=$mohr_lv0042->GetCount();
if($mohr_lv0042->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">

				<?php echo $mohr_lv0042->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>
<?php
}
require_once("../../clsall/hr_lv0029.php");

/////////////init object//////////////
$mohr_lv0029=new hr_lv0029($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0050');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0111.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0029->ArrPush[0]=$vLangArr[17];
$mohr_lv0029->ArrPush[1]=$vLangArr[18];
$mohr_lv0029->ArrPush[2]=$vLangArr[20];
$mohr_lv0029->ArrPush[3]=$vLangArr[21];
$mohr_lv0029->ArrPush[4]=$vLangArr[22];
$mohr_lv0029->ArrPush[5]=$vLangArr[23];
$mohr_lv0029->ArrPush[6]=$vLangArr[24];
$mohr_lv0029->ArrPush[7]=$vLangArr[25];
$mohr_lv0029->ArrPush[8]=$vLangArr[26];
$mohr_lv0029->ArrPush[9]=$vLangArr[27];
$mohr_lv0029->ArrPush[10]=$vLangArr[28];
$mohr_lv0029->ArrPush[11]=$vLangArr[29];
$mohr_lv0029->ArrPush[12]=$vLangArr[30];

$mohr_lv0029->ArrFunc[0]='//Function';
$mohr_lv0029->ArrFunc[1]=$vLangArr[2];
$mohr_lv0029->ArrFunc[2]=$vLangArr[4];
$mohr_lv0029->ArrFunc[3]=$vLangArr[6];
$mohr_lv0029->ArrFunc[4]=$vLangArr[7];
$mohr_lv0029->ArrFunc[5]='';
$mohr_lv0029->ArrFunc[6]='';
$mohr_lv0029->ArrFunc[7]='';
$mohr_lv0029->ArrFunc[8]=$vLangArr[10];
$mohr_lv0029->ArrFunc[9]=$vLangArr[12];
$mohr_lv0029->ArrFunc[10]=$vLangArr[0];
$mohr_lv0029->ArrFunc[11]=$vLangArr[32];
$mohr_lv0029->ArrFunc[12]=$vLangArr[33];
$mohr_lv0029->ArrFunc[13]=$vLangArr[34];
$mohr_lv0029->ArrFunc[14]=$vLangArr[35];
$mohr_lv0029->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0029->ArrOther[1]=$vLangArr[30];
$mohr_lv0029->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0029->lv002=$vlv001;
$mohr_lv0029->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0029');
$vFieldList=$mohr_lv0029->ListView;
$curPage = $mohr_lv0029->CurPage;
$maxRows =$mohr_lv0029->MaxRows;
$vOrderList=$mohr_lv0029->ListOrder;
$vCount=$mohr_lv0029->GetCount();
if($mohr_lv0029->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0029->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>	
<?php
}
require_once("../../clsall/hr_lv0028.php");

/////////////init object//////////////
$mohr_lv0028=new hr_lv0028($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0048');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0113.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0028->ArrPush[0]=$vLangArr[17];
$mohr_lv0028->ArrPush[1]=$vLangArr[18];
$mohr_lv0028->ArrPush[2]=$vLangArr[20];
$mohr_lv0028->ArrPush[3]=$vLangArr[21];
$mohr_lv0028->ArrPush[4]=$vLangArr[22];
$mohr_lv0028->ArrPush[5]=$vLangArr[23];
$mohr_lv0028->ArrPush[6]=$vLangArr[24];
$mohr_lv0028->ArrPush[7]=$vLangArr[25];
$mohr_lv0028->ArrPush[8]=$vLangArr[26];
$mohr_lv0028->ArrPush[9]=$vLangArr[27];
$mohr_lv0028->ArrPush[10]=$vLangArr[35];
$mohr_lv0028->ArrPush[11]=$vLangArr[29];
$mohr_lv0028->ArrPush[12]=$vLangArr[30];

$mohr_lv0028->ArrFunc[0]='//Function';
$mohr_lv0028->ArrFunc[1]=$vLangArr[2];
$mohr_lv0028->ArrFunc[2]=$vLangArr[4];
$mohr_lv0028->ArrFunc[3]=$vLangArr[6];
$mohr_lv0028->ArrFunc[4]=$vLangArr[7];
$mohr_lv0028->ArrFunc[5]='';
$mohr_lv0028->ArrFunc[6]='';
$mohr_lv0028->ArrFunc[7]='';
$mohr_lv0028->ArrFunc[8]=$vLangArr[10];
$mohr_lv0028->ArrFunc[9]=$vLangArr[12];
$mohr_lv0028->ArrFunc[10]=$vLangArr[0];
$mohr_lv0028->ArrFunc[11]=$vLangArr[32];
$mohr_lv0028->ArrFunc[12]=$vLangArr[33];
$mohr_lv0028->ArrFunc[13]=$vLangArr[34];
$mohr_lv0028->ArrFunc[14]=$vLangArr[35];
$mohr_lv0028->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0028->ArrOther[1]=$vLangArr[30];
$mohr_lv0028->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0028->lv002=$vlv001;
$mohr_lv0028->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0028');
$vFieldList=$mohr_lv0028->ListView;
$curPage = $mohr_lv0028->CurPage;
$maxRows =$mohr_lv0028->MaxRows;
$vOrderList=$mohr_lv0028->ListOrder;
$vCount=$mohr_lv0028->GetCount();
if($mohr_lv0028->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0028->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}
require_once("../../clsall/hr_lv0030.php");

/////////////init object//////////////
$mohr_lv0030=new hr_lv0030($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0056');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0115.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0030->ArrPush[0]=$vLangArr[17];
$mohr_lv0030->ArrPush[1]=$vLangArr[18];
$mohr_lv0030->ArrPush[2]=$vLangArr[20];
$mohr_lv0030->ArrPush[3]=$vLangArr[21];
$mohr_lv0030->ArrPush[4]=$vLangArr[22];
$mohr_lv0030->ArrPush[5]=$vLangArr[23];
$mohr_lv0030->ArrPush[6]=$vLangArr[24];
$mohr_lv0030->ArrPush[7]=$vLangArr[25];
$mohr_lv0030->ArrPush[8]=$vLangArr[26];
$mohr_lv0030->ArrPush[9]=$vLangArr[27];
$mohr_lv0030->ArrPush[10]=$vLangArr[28];
$mohr_lv0030->ArrPush[11]=$vLangArr[29];
$mohr_lv0030->ArrPush[12]=$vLangArr[30];

$mohr_lv0030->ArrFunc[0]='//Function';
$mohr_lv0030->ArrFunc[1]=$vLangArr[2];
$mohr_lv0030->ArrFunc[2]=$vLangArr[4];
$mohr_lv0030->ArrFunc[3]=$vLangArr[6];
$mohr_lv0030->ArrFunc[4]=$vLangArr[7];
$mohr_lv0030->ArrFunc[5]='';
$mohr_lv0030->ArrFunc[6]='';
$mohr_lv0030->ArrFunc[7]='';
$mohr_lv0030->ArrFunc[8]=$vLangArr[10];
$mohr_lv0030->ArrFunc[9]=$vLangArr[12];
$mohr_lv0030->ArrFunc[10]=$vLangArr[0];
$mohr_lv0030->ArrFunc[11]=$vLangArr[32];
$mohr_lv0030->ArrFunc[12]=$vLangArr[33];
$mohr_lv0030->ArrFunc[13]=$vLangArr[34];
$mohr_lv0030->ArrFunc[14]=$vLangArr[35];
$mohr_lv0030->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0030->ArrOther[1]=$vLangArr[30];
$mohr_lv0030->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0030->lv002=$vlv001;
$mohr_lv0030->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0030');
$vFieldList=$mohr_lv0030->ListView;
$curPage = $mohr_lv0030->CurPage;
$maxRows =$mohr_lv0030->MaxRows;
$vOrderList=$mohr_lv0030->ListOrder;
$vCount=$mohr_lv0030->GetCount();
if($mohr_lv0030->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0030->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}
require_once("../../clsall/hr_lv0031.php");

/////////////init object//////////////
$mohr_lv0031=new hr_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0051');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0117.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0031->ArrPush[0]=$vLangArr[17];
$mohr_lv0031->ArrPush[1]=$vLangArr[18];
$mohr_lv0031->ArrPush[2]=$vLangArr[20];
$mohr_lv0031->ArrPush[3]=$vLangArr[21];
$mohr_lv0031->ArrPush[4]=$vLangArr[22];
$mohr_lv0031->ArrPush[5]=$vLangArr[23];
$mohr_lv0031->ArrPush[6]=$vLangArr[24];
$mohr_lv0031->ArrPush[7]=$vLangArr[32];
$mohr_lv0031->ArrPush[8]=$vLangArr[33];
$mohr_lv0031->ArrPush[9]=$vLangArr[34];
$mohr_lv0031->ArrPush[10]=$vLangArr[35];

$mohr_lv0031->ArrFunc[0]='//Function';
$mohr_lv0031->ArrFunc[1]=$vLangArr[2];
$mohr_lv0031->ArrFunc[2]=$vLangArr[4];
$mohr_lv0031->ArrFunc[3]=$vLangArr[6];
$mohr_lv0031->ArrFunc[4]=$vLangArr[7];
$mohr_lv0031->ArrFunc[5]='';
$mohr_lv0031->ArrFunc[6]='';
$mohr_lv0031->ArrFunc[7]='';
$mohr_lv0031->ArrFunc[8]=$vLangArr[10];
$mohr_lv0031->ArrFunc[9]=$vLangArr[12];
$mohr_lv0031->ArrFunc[10]=$vLangArr[0];
$mohr_lv0031->ArrFunc[11]=$vLangArr[32];
$mohr_lv0031->ArrFunc[12]=$vLangArr[33];
$mohr_lv0031->ArrFunc[13]=$vLangArr[34];
$mohr_lv0031->ArrFunc[14]=$vLangArr[35];
$mohr_lv0031->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0031->ArrOther[1]=$vLangArr[30];
$mohr_lv0031->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0031->lv002=$vlv001;
$mohr_lv0031->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0031');
$vFieldList=$mohr_lv0031->ListView;
$curPage = $mohr_lv0031->CurPage;
$maxRows =$mohr_lv0031->MaxRows;
$vOrderList=$mohr_lv0031->ListOrder;
$vCount=$mohr_lv0031->GetCount();
if($mohr_lv0031->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0031->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}
require_once("../../clsall/hr_lv0033.php");

/////////////init object//////////////
$mohr_lv0033=new hr_lv0033($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0052');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0119.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0033->ArrPush[0]=$vLangArr[17];
$mohr_lv0033->ArrPush[1]=$vLangArr[18];
$mohr_lv0033->ArrPush[2]=$vLangArr[20];
$mohr_lv0033->ArrPush[3]=$vLangArr[21];
$mohr_lv0033->ArrPush[4]=$vLangArr[22];
$mohr_lv0033->ArrPush[5]=$vLangArr[23];
$mohr_lv0033->ArrPush[6]=$vLangArr[24];
$mohr_lv0033->ArrPush[7]=$vLangArr[25];
$mohr_lv0033->ArrPush[8]=$vLangArr[33];
$mohr_lv0033->ArrPush[9]=$vLangArr[33];
$mohr_lv0033->ArrPush[10]=$vLangArr[28];
$mohr_lv0033->ArrPush[11]=$vLangArr[29];
$mohr_lv0033->ArrPush[12]=$vLangArr[30];

$mohr_lv0033->ArrFunc[0]='//Function';
$mohr_lv0033->ArrFunc[1]=$vLangArr[2];
$mohr_lv0033->ArrFunc[2]=$vLangArr[4];
$mohr_lv0033->ArrFunc[3]=$vLangArr[6];
$mohr_lv0033->ArrFunc[4]=$vLangArr[7];
$mohr_lv0033->ArrFunc[5]='';
$mohr_lv0033->ArrFunc[6]='';
$mohr_lv0033->ArrFunc[7]='';
$mohr_lv0033->ArrFunc[8]=$vLangArr[10];
$mohr_lv0033->ArrFunc[9]=$vLangArr[12];
$mohr_lv0033->ArrFunc[10]=$vLangArr[0];
$mohr_lv0033->ArrFunc[11]=$vLangArr[32];
$mohr_lv0033->ArrFunc[12]=$vLangArr[33];
$mohr_lv0033->ArrFunc[13]=$vLangArr[34];
$mohr_lv0033->ArrFunc[14]=$vLangArr[35];
$mohr_lv0033->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0033->ArrOther[1]=$vLangArr[30];
$mohr_lv0033->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0033->lv002=$vlv001;
$mohr_lv0033->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0033');
$vFieldList=$mohr_lv0033->ListView;
$curPage = $mohr_lv0033->CurPage;
$maxRows =$mohr_lv0033->MaxRows;
$vOrderList=$mohr_lv0033->ListOrder;
$vCount=$mohr_lv0033->GetCount();
if($mohr_lv0033->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0033->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}
require_once("../../clsall/hr_lv0034.php");

/////////////init object//////////////
$mohr_lv0034=new hr_lv0034($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0048');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0121.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0034->ArrPush[0]=$vLangArr[17];
$mohr_lv0034->ArrPush[1]=$vLangArr[18];
$mohr_lv0034->ArrPush[2]=$vLangArr[20];
$mohr_lv0034->ArrPush[3]=$vLangArr[21];
$mohr_lv0034->ArrPush[4]=$vLangArr[22];
$mohr_lv0034->ArrPush[5]=$vLangArr[23];
$mohr_lv0034->ArrPush[6]=$vLangArr[24];
$mohr_lv0034->ArrPush[7]=$vLangArr[25];
$mohr_lv0034->ArrPush[8]=$vLangArr[26];
$mohr_lv0034->ArrPush[9]=$vLangArr[27];
$mohr_lv0034->ArrPush[10]=$vLangArr[28];
$mohr_lv0034->ArrPush[11]=$vLangArr[29];
$mohr_lv0034->ArrPush[12]=$vLangArr[30];

$mohr_lv0034->ArrFunc[0]='//Function';
$mohr_lv0034->ArrFunc[1]=$vLangArr[2];
$mohr_lv0034->ArrFunc[2]=$vLangArr[4];
$mohr_lv0034->ArrFunc[3]=$vLangArr[6];
$mohr_lv0034->ArrFunc[4]=$vLangArr[7];
$mohr_lv0034->ArrFunc[5]='';
$mohr_lv0034->ArrFunc[6]='';
$mohr_lv0034->ArrFunc[7]='';
$mohr_lv0034->ArrFunc[8]=$vLangArr[10];
$mohr_lv0034->ArrFunc[9]=$vLangArr[12];
$mohr_lv0034->ArrFunc[10]=$vLangArr[0];
$mohr_lv0034->ArrFunc[11]=$vLangArr[32];
$mohr_lv0034->ArrFunc[12]=$vLangArr[33];
$mohr_lv0034->ArrFunc[13]=$vLangArr[34];
$mohr_lv0034->ArrFunc[14]=$vLangArr[35];
$mohr_lv0034->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0034->ArrOther[1]=$vLangArr[30];
$mohr_lv0034->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0034->lv002=$vlv001;
$mohr_lv0034->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0034');
$vFieldList=$mohr_lv0034->ListView;
$curPage = $mohr_lv0034->CurPage;
$maxRows =$mohr_lv0034->MaxRows;
$vOrderList=$mohr_lv0034->ListOrder;
$vCount=$mohr_lv0034->GetCount();
if($mohr_lv0034->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0034->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}
require_once("../../clsall/hr_lv0036.php");

/////////////init object//////////////
$mohr_lv0036=new hr_lv0036($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0047');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0011.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0036->ArrPush[0]=$vLangArr[17];
$mohr_lv0036->ArrPush[1]=$vLangArr[18];
$mohr_lv0036->ArrPush[2]=$vLangArr[20];
$mohr_lv0036->ArrPush[3]=$vLangArr[21];
$mohr_lv0036->ArrPush[4]=$vLangArr[22];
$mohr_lv0036->ArrPush[5]=$vLangArr[23];
$mohr_lv0036->ArrPush[6]=$vLangArr[24];
$mohr_lv0036->ArrPush[7]=$vLangArr[25];
$mohr_lv0036->ArrPush[8]=$vLangArr[26];
$mohr_lv0036->ArrPush[9]=$vLangArr[27];
$mohr_lv0036->ArrPush[10]=$vLangArr[28];
$mohr_lv0036->ArrPush[11]=$vLangArr[29];
$mohr_lv0036->ArrPush[12]=$vLangArr[30];

$mohr_lv0036->ArrFunc[0]='//Function';
$mohr_lv0036->ArrFunc[1]=$vLangArr[2];
$mohr_lv0036->ArrFunc[2]=$vLangArr[4];
$mohr_lv0036->ArrFunc[3]=$vLangArr[6];
$mohr_lv0036->ArrFunc[4]=$vLangArr[7];
$mohr_lv0036->ArrFunc[5]='';
$mohr_lv0036->ArrFunc[6]='';
$mohr_lv0036->ArrFunc[7]='';
$mohr_lv0036->ArrFunc[8]=$vLangArr[10];
$mohr_lv0036->ArrFunc[9]=$vLangArr[12];
$mohr_lv0036->ArrFunc[10]=$vLangArr[0];
$mohr_lv0036->ArrFunc[11]=$vLangArr[32];
$mohr_lv0036->ArrFunc[12]=$vLangArr[33];
$mohr_lv0036->ArrFunc[13]=$vLangArr[34];
$mohr_lv0036->ArrFunc[14]=$vLangArr[35];
$mohr_lv0036->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0036->ArrOther[1]=$vLangArr[30];
$mohr_lv0036->ArrOther[2]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0036->lv002=$vlv001;
$mohr_lv0036->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0036');
$vFieldList=$mohr_lv0036->ListView;
$curPage = $mohr_lv0036->CurPage;
$maxRows =$mohr_lv0036->MaxRows;
$vOrderList=$mohr_lv0036->ListOrder;
$vCount=$mohr_lv0036->GetCount();
if($mohr_lv0036->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
				<?php echo $mohr_lv0036->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}
require_once("../../clsall/hr_lv0041.php");

/////////////init object//////////////
$mohr_lv0041=new hr_lv0041($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0057');
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0046.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0041->ArrPush[0]=$vLangArr[17];
$mohr_lv0041->ArrPush[1]=$vLangArr[18];
$mohr_lv0041->ArrPush[2]=$vLangArr[20];
$mohr_lv0041->ArrPush[3]=$vLangArr[21];
$mohr_lv0041->ArrPush[4]=$vLangArr[22];
$mohr_lv0041->ArrPush[5]=$vLangArr[23];
$mohr_lv0041->ArrPush[6]=$vLangArr[24];
$mohr_lv0041->ArrPush[7]=$vLangArr[25];
$mohr_lv0041->ArrPush[8]=$vLangArr[26];
$mohr_lv0041->ArrPush[9]=$vLangArr[27];
$mohr_lv0041->ArrPush[10]=$vLangArr[28];
$mohr_lv0041->ArrPush[11]=$vLangArr[29];
$mohr_lv0041->ArrPush[12]=$vLangArr[30];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0041->lv002=$vlv001;
$mohr_lv0041->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0041');
$vFieldList=$mohr_lv0041->ListView;
$curPage = $mohr_lv0041->CurPage;
$maxRows =$mohr_lv0041->MaxRows;
$vOrderList=$mohr_lv0041->ListOrder;
$vCount=$mohr_lv0041->GetCount();
if($mohr_lv0041->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">

				<?php echo $mohr_lv0041->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}
require_once("../../clsall/rp_lv0011.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/tc_lv0002.php");
require_once("../../clsall/tc_lv0004.php");
require_once("../../clsall/jo_lv0004.php");
require_once("../../clsall/hr_lv0038.php");
require_once("../../clsall/tc_lv0020.php");
require_once("../../clsall/hr_lv0002.php");
require_once("../../clsall/tc_lv0013.php");
/////////////init object//////////////
$morp_lv0011=new rp_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0011');
$mojo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0002');
$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$morp_lv0011->ArrDep=$mohr_lv0002->LV_LoadArray();
$morp_lv0011->ArrShift=$motc_lv0004->LV_LoadArray();
$morp_lv0011->motc_lv0020=$motc_lv0020;
$morp_lv0011->mohr_lv0020=$mohr_lv0020;
$morp_lv0011->motc_lv0013=$motc_lv0013;
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0052.txt",$plang);
$morp_lv0011->DonXinPhep=$mojo_lv0004;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0011->mohr_lv0038=$mohr_lv0038;
$morp_lv0011->ArrPush[0]=$vLangArr[17];
$morp_lv0011->ArrPush[1]=$vLangArr[18];
$morp_lv0011->ArrPush[2]=$vLangArr[20];
$morp_lv0011->ArrPush[3]=$vLangArr[21];
$morp_lv0011->ArrPush[4]=$vLangArr[22];
$morp_lv0011->ArrPush[5]=$vLangArr[23];
$morp_lv0011->ArrPush[6]=$vLangArr[24];
$morp_lv0011->ArrPush[7]=$vLangArr[25];
$morp_lv0011->ArrPush[8]=$vLangArr[26];
$morp_lv0011->ArrPush[9]=$vLangArr[27];
$morp_lv0011->ArrPush[10]=$vLangArr[28];
$morp_lv0011->ArrPush[11]=$vLangArr[29];
$morp_lv0011->ArrPush[12]=$vLangArr[37];
$morp_lv0011->ArrPush[13]=$vLangArr[48];
$morp_lv0011->ArrPush[14]=$vLangArr[43];
$morp_lv0011->ArrPush[15]=$vLangArr[41];
$morp_lv0011->ArrPush[16]=$vLangArr[42];
$morp_lv0011->lv030=$vlv001;
$morp_lv0011->paratimecard='7';
if($morp_lv0011->GetView()==1)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">
<?php
				echo "<div style='width:600px'>
		<div style='text-align:left'><h1>".$vLangArr[54]."</h1></div>
		<div>&nbsp;</div>
		</div>";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $morp_lv0011->LV_GetFullReport($vlv001);
?>				
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0020.php");
require_once("../../clsall/tc_lv0013.php");
/////////////init object//////////////
$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0038.txt","VN");
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
$motc_lv0020->ArrPush[76]=$vLangArr[104];
$motc_lv0020->ArrPush[77]=$vLangArr[105];
$motc_lv0020->ArrPush[78]=$vLangArr[106];
$motc_lv0020->ArrPush[79]=$vLangArr[107];
$motc_lv0020->ArrPush[80]=$vLangArr[108];
$motc_lv0020->ArrPush[81]=$vLangArr[109];
$motc_lv0020->ArrPush[82]=$vLangArr[110];
$motc_lv0020->ArrPush[83]=$vLangArr[111];
$motc_lv0020->ArrPush[84]=$vLangArr[112];
$motc_lv0020->ArrPush[85]=$vLangArr[113];
$motc_lv0020->ArrPush[86]=$vLangArr[114];
$motc_lv0020->ArrPush[87]=$vLangArr[115];
$motc_lv0020->ArrPush[88]=$vLangArr[116];
$motc_lv0020->ArrPush[101]=$vLangArr[103];

$motc_lv0020->ArrPush[999]=$vLangArr[128];
$motc_lv0020->ArrPush[1000]=$vLangArr[129];
$motc_lv0020->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0020->lv002=$vlv001;
$vFieldList=$motc_lv0020->ListView;
$curPage = 1;
$maxRows =10000;
$vOrderList=$motc_lv0020->ListOrder;
$vSortNum=$motc_lv0020->SortNum;
$vCount=$motc_lv0020->GetCount();
if($motc_lv0020->GetView()==1 & $vCount>0)
{
?>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''"><h1><?php echo ($plang=='VN')?'BÁO CÁO LỊCH SỬ LƯƠNG':'REPORT HISTORY SALLARY';?></h1></td>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">

				<?php echo $motc_lv0020->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 10000,1,$vOrderList,$vSortNum);?>
				</tr>
				<tr>
					<td  height="20" colspan="4" ondblclick="this.innerHTML=''">&nbsp;</td>
				</tr>					
<?php
}

} else {
	include("../permit.php");
}
?>
</body>
</html>