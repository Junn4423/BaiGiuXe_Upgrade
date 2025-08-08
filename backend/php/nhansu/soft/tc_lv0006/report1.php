<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0006.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");

//////////////init object////////////////
$lvtc_lv0006=new tc_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0006');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$lvtc_lv0006->lv001=$vlv001;
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AD0022.txt",$plang);
$motc_lv0006->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvtc_lv0006->LV_LoadID($lvtc_lv0006->lv001);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<?php
if($lvtc_lv0006->GetView()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
					
						<table width="760" border="1" align="center" class="table1" cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="3" height="100%" align="center">
								<table border="0" width="100%"><tr>
    <td align="right"><?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".$vlv001."'>";?></td>
  </tr>	
  <tr>
    <td align="center"><img  src="<?php echo $lvtc_lv0006->GetLogo();?>" /></td>
  </tr></table>		</td>	
							</tr>
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20"><?php echo $lvtc_lv0006->lv001."&nbsp;";?></td>
							    <td width="178" rowspan="6"><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="96px" height="128px" 
								src="<?php echo "../../images/employees/".$lvtc_lv0006->lv001."/".$lvtc_lv0006->lv007; ?>" /></td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><?php echo $lvtc_lv0006->lv002."&nbsp;";?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><?php echo $lvtc_lv0006->lv003."&nbsp;";?></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><?php echo $lvtc_lv0006->lv004."&nbsp;";?></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><?php echo $lvtc_lv0006->lv005."&nbsp;";?></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><?php echo $lvtc_lv0006->lv006."&nbsp;";?></td>
								</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[22];?></td>
							  <td  height="20" colspan="2">
							  <?php echo $lvtc_lv0006->getvaluelink('lv008',$lvtc_lv0006->lv008);?>													  </td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->getvaluelink('lv009',$lvtc_lv0006->lv009);?></td>
						    </tr>
                            <tr>
                              <td  height="20" colspan="3"><hr style="border: dashed"></td>
                            </tr>
                          <tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv010."&nbsp;";?></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[25];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->FormatView($lvtc_lv0006->lv011,2);?></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[26];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv012."&nbsp;";?></td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[27];?></td>
								<td  height="20" colspan="2">
									<?php echo $lvtc_lv0006->lv013."&nbsp;";?></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv014."&nbsp;";?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->FormatView($lvtc_lv0006->lv015,2);?></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[30];?></td>
				  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv016."&nbsp;";?></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[31];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->getvaluelink('lv017',$lvtc_lv0006->lv017);?></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[32];?></td>
							  <td  height="20" colspan="2"><?php echo (int)$lvtc_lv0006->lv018."&nbsp;";?></td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[33];?></td>
								<td  height="20" colspan="2">								<?php echo (int)$lvtc_lv0006->lv019;?></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[34];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv020."&nbsp;";?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[35];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->FormatView($lvtc_lv0006->lv021,2);?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[57];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv043."&nbsp;";?></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[36];?></td>
				  <td  height="20" colspan="2"> <?php echo $lvtc_lv0006->getvaluelink('lv022',$lvtc_lv0006->lv022);?>				 </td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[37];?></td>
							  <td  height="20" colspan="2">
                                <?php echo $lvtc_lv0006->getvaluelink('lv023',$lvtc_lv0006->lv023);?>                             </td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[38];?></td>
							  <td  height="20" colspan="2">
							  <?php echo $lvtc_lv0006->getvaluelink('lv024',$lvtc_lv0006->lv024);?>							  </td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[39];?></td>
								<td  height="20" colspan="2">
									<?php echo $lvtc_lv0006->getvaluelink('lv025',$lvtc_lv0006->lv025);?>											</td>
					      </tr>
							<tr>
							  <td  height="20" colspan="3"><hr style="border: dashed"></td>
						  </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[40];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->getvaluelink('lv026',$lvtc_lv0006->lv026);?></td>
						    </tr>
							<tr>
							  <td  height="22"><?php echo $vLangArr[41];?></td>
							  <td  height="22" colspan="2">  <?php echo $lvtc_lv0006->getvaluelink('lv027',$lvtc_lv0006->lv027);?>							  </td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[42];?></td>
				  <td  height="20" colspan="2">
				  <?php echo $lvtc_lv0006->getvaluelink('lv028',$lvtc_lv0006->lv028);?></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[43];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->getvaluelink('lv029',$lvtc_lv0006->lv029);?></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[44];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->FormatView($lvtc_lv0006->lv030,2);?></td>
							  </tr>		
							   <tr>
							  <td  height="20"><?php echo $vLangArr[58];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->FormatView($lvtc_lv0006->lv044,2);?></td>
							  </tr>	
                                <tr>
                                  <td  height="20" colspan="3"><hr style="border: dashed"></td>
                                </tr>
                           <tr>
								<td width="166"  height="20"><?php echo $vLangArr[45];?></td>
								<td  height="20" colspan="2"><?php echo $lvtc_lv0006->getvaluelink('lv031',$lvtc_lv0006->lv031);?></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[46];?></td>
							  <td  height="20" colspan="2"> <?php echo $lvtc_lv0006->getvaluelink('lv032',$lvtc_lv0006->lv032);?>						     </td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[47];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv033."&nbsp;";?></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[48];?></td>
				  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv034."&nbsp;";?></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[49];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv035."&nbsp;";?></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[50];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv036."&nbsp;";?></td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[51];?></td>
								<td  height="20" colspan="2">
									<?php echo $lvtc_lv0006->lv037."&nbsp;";?></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[52];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv038."&nbsp;";?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[53];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv039."&nbsp;";?></td>
						    </tr>
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[54];?></td>
								<td  height="20" colspan="2">
									<?php echo $lvtc_lv0006->lv040."&nbsp;";?></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[55];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv041."&nbsp;";?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[56];?></td>
							  <td  height="20" colspan="2"><?php echo $lvtc_lv0006->lv042."&nbsp;";?></td>
						    </tr>


							  							  							  							  							  							  							  																			
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
							</tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0024->lv002=($vlv001);
$vFieldList=$mohr_lv0024->ListView;
$curPage = $mohr_lv0024->CurPage;
$maxRows =$mohr_lv0024->MaxRows;
$vOrderList=$mohr_lv0024->ListOrder;

?>
<?php
if($mohr_lv0024->GetView()==1)
{
?>

				<?php echo $mohr_lv0024->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0026->ArrPush[12]=$vLangArr[30];

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
$mohr_lv0026->lv002=($vlv001);
$vFieldList=$mohr_lv0026->ListView;
$curPage = $mohr_lv0026->CurPage;
$maxRows =$mohr_lv0026->MaxRows;
$vOrderList=$mohr_lv0026->ListOrder;

?>
<?php
if($mohr_lv0026->GetView()==1)
{
?>

				<?php echo $mohr_lv0026->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0027->lv002=($vlv001);
$vFieldList=$mohr_lv0027->ListView;
$curPage = $mohr_lv0027->CurPage;
$maxRows =$mohr_lv0027->MaxRows;
$vOrderList=$mohr_lv0027->ListOrder;

?>
<?php
if($mohr_lv0027->GetView()==1)
{
?>

				<?php echo $mohr_lv0027->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0038->ArrPush[11]=$vLangArr[29];
$mohr_lv0038->ArrPush[12]=$vLangArr[30];

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
$mohr_lv0038->lv002=($vlv001);
$vFieldList=$mohr_lv0038->ListView;
$curPage = $mohr_lv0038->CurPage;
$maxRows =$mohr_lv0038->MaxRows;
$vOrderList=$mohr_lv0038->ListOrder;

?>
<?php
if($mohr_lv0038->GetView()==1)
{
?>

				<?php echo $mohr_lv0038->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0042->ArrPush[8]=$vLangArr[26];
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
$mohr_lv0042->lv002=($vlv001);
$vFieldList=$mohr_lv0042->ListView;
$curPage = $mohr_lv0042->CurPage;
$maxRows =$mohr_lv0042->MaxRows;
$vOrderList=$mohr_lv0042->ListOrder;

?>
<?php
if($mohr_lv0042->GetView()==1)
{
?>

				<?php echo $mohr_lv0042->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0029->lv002=($vlv001);
$vFieldList=$mohr_lv0029->ListView;
$curPage = $mohr_lv0029->CurPage;
$maxRows =$mohr_lv0029->MaxRows;
$vOrderList=$mohr_lv0029->ListOrder;

?>
<?php
if($mohr_lv0029->GetView()==1)
{
?>

				<?php echo $mohr_lv0029->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0028->ArrPush[10]=$vLangArr[28];
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
$mohr_lv0028->lv002=($vlv001);
$vFieldList=$mohr_lv0028->ListView;
$curPage = $mohr_lv0028->CurPage;
$maxRows =$mohr_lv0028->MaxRows;
$vOrderList=$mohr_lv0028->ListOrder;

?>
<?php
if($mohr_lv0028->GetView()==1)
{
?>

				<?php echo $mohr_lv0028->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0030->lv002=($vlv001);
$vFieldList=$mohr_lv0030->ListView;
$curPage = $mohr_lv0030->CurPage;
$maxRows =$mohr_lv0030->MaxRows;
$vOrderList=$mohr_lv0030->ListOrder;

?>
<?php
if($mohr_lv0030->GetView()==1)
{
?>

				<?php echo $mohr_lv0030->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0031->ArrPush[7]=$vLangArr[25];
$mohr_lv0031->ArrPush[8]=$vLangArr[26];
$mohr_lv0031->ArrPush[9]=$vLangArr[27];
$mohr_lv0031->ArrPush[10]=$vLangArr[28];
$mohr_lv0031->ArrPush[11]=$vLangArr[29];
$mohr_lv0031->ArrPush[12]=$vLangArr[30];

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
$mohr_lv0031->lv002=($vlv001);
$vFieldList=$mohr_lv0031->ListView;
$curPage = $mohr_lv0031->CurPage;
$maxRows =$mohr_lv0031->MaxRows;
$vOrderList=$mohr_lv0031->ListOrder;

?>
<?php
if($mohr_lv0031->GetView()==1)
{
?>

				<?php echo $mohr_lv0031->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0033->ArrPush[8]=$vLangArr[26];
$mohr_lv0033->ArrPush[9]=$vLangArr[27];
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
$mohr_lv0033->lv002=($vlv001);
$vFieldList=$mohr_lv0033->ListView;
$curPage = $mohr_lv0033->CurPage;
$maxRows =$mohr_lv0033->MaxRows;
$vOrderList=$mohr_lv0033->ListOrder;

?>
<?php
if($mohr_lv0033->GetView()==1)
{
?>

				<?php echo $mohr_lv0033->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0034->lv002=($vlv001);
$vFieldList=$mohr_lv0034->ListView;
$curPage = $mohr_lv0034->CurPage;
$maxRows =$mohr_lv0034->MaxRows;
$vOrderList=$mohr_lv0034->ListOrder;

?>
<?php
if($mohr_lv0034->GetView()==1)
{
?>

				<?php echo $mohr_lv0034->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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
$mohr_lv0036->lv002=($vlv001);
$vFieldList=$mohr_lv0036->ListView;
$curPage = $mohr_lv0036->CurPage;
$maxRows =$mohr_lv0036->MaxRows;
$vOrderList=$mohr_lv0036->ListOrder;

?>
<?php
if($mohr_lv0036->GetView()==1)
{
?>

				<?php echo $mohr_lv0036->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3">&nbsp;</td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"><?php 
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

$mohr_lv0041->ArrFunc[0]='//Function';
$mohr_lv0041->ArrFunc[1]=$vLangArr[2];
$mohr_lv0041->ArrFunc[2]=$vLangArr[4];
$mohr_lv0041->ArrFunc[3]=$vLangArr[6];
$mohr_lv0041->ArrFunc[4]=$vLangArr[7];
$mohr_lv0041->ArrFunc[5]='';
$mohr_lv0041->ArrFunc[6]='';
$mohr_lv0041->ArrFunc[7]='';
$mohr_lv0041->ArrFunc[8]=$vLangArr[10];
$mohr_lv0041->ArrFunc[9]=$vLangArr[12];
$mohr_lv0041->ArrFunc[10]=$vLangArr[0];
$mohr_lv0041->ArrFunc[11]=$vLangArr[32];
$mohr_lv0041->ArrFunc[12]=$vLangArr[33];
$mohr_lv0041->ArrFunc[13]=$vLangArr[34];
$mohr_lv0041->ArrFunc[14]=$vLangArr[35];
$mohr_lv0041->ArrFunc[15]=$vLangArr[36];
////Other
$mohr_lv0041->ArrOther[1]=$vLangArr[30];
$mohr_lv0041->ArrOther[2]=$vLangArr[31];
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
$mohr_lv0041->lv002=($vlv001);
$vFieldList=$mohr_lv0041->ListView;
$curPage = $mohr_lv0041->CurPage;
$maxRows =$mohr_lv0041->MaxRows;
$vOrderList=$mohr_lv0041->ListOrder;

?>
<?php
if($mohr_lv0041->GetView()==1)
{
?>

				<?php echo $mohr_lv0041->LV_BuilListReportView($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,'',$vOrderList);?>
					
<?php
}
?></td>
						  </tr>
					  </table>
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>