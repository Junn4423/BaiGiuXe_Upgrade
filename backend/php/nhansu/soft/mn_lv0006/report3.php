<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0001.php");
require_once("../../clsall/sl_lv0013.php");
require_once("../../clsall/wh_lv0001.php");
require_once("../../clsall/sl_lv0014.php");
require_once("../../clsall/sl_lv0020.php");
require_once("../../clsall/sl_lv0051.php");
require_once("../../clsall/sl_lv0021.php");
require_once("../../clsall/sl_lv0052.php");
require_once("../../clsall/ac_lv0018.php");
require_once("../../clsall/ac_lv0019.php");
require_once("../../clsall/ac_lv0032.php");
require_once("../../clsall/ac_lv0033.php");
//Xuất kho thành phẩm và ph//

/////////////init object//////////////
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0006');
$mosl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0016');
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$mowh_lv0001=new wh_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0001');
$mosl_lv0052=new sl_lv0052($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0052');
$mosl_lv0021=new sl_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0021');
$mosl_lv0051=new sl_lv0051($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0051');
$mosl_lv0020=new sl_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0020');
$moac_lv0018=new ac_lv0018($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0018');
$moac_lv0019=new ac_lv0019($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0019');
$moac_lv0032=new ac_lv0032($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0032');
$moac_lv0033=new ac_lv0033($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0033');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
  
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0027.txt",$plang);
	$vLangArr2=GetLangFile("../../","SL0027.txt",$plang);
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$mosl_lv0013->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0013->ArrPush[0]=$vLangArr[54];
$mosl_lv0013->ArrPush[1]=$vLangArr[18];
$mosl_lv0013->ArrPush[2]=$vLangArr[19];
$mosl_lv0013->ArrPush[3]=$vLangArr[20];
$mosl_lv0013->ArrPush[4]=$vLangArr[21];
$mosl_lv0013->ArrPush[5]=$vLangArr[22];
$mosl_lv0013->ArrPush[6]=$vLangArr[23];
$mosl_lv0013->ArrPush[7]=$vLangArr[24];
$mosl_lv0013->ArrPush[8]=$vLangArr[25];
$mosl_lv0013->ArrPush[9]=$vLangArr[26];
$mosl_lv0013->ArrPush[10]=$vLangArr[27];
$mosl_lv0013->ArrPush[11]=$vLangArr[28];
$mosl_lv0013->ArrPush[12]=$vLangArr[29];
$mosl_lv0013->ArrPush[13]=$vLangArr[41];
$mosl_lv0013->ArrPush[14]=$vLangArr[40];
$mosl_lv0013->ArrPush[15]=$vLangArr[42];
$mosl_lv0013->ArrPush[16]=$vLangArr[45];
$mosl_lv0013->ArrPush[17]=$vLangArr[43];
$mosl_lv0013->ArrPush[18]=$vLangArr[44];
$mosl_lv0013->ArrPush[19]=$vLangArr[46];
$mosl_lv0013->ArrPush[20]=$vLangArr[47];
$mosl_lv0013->ArrPush[21]=$vLangArr[48];
$mosl_lv0013->ArrPush[22]=$vLangArr[49];
$mosl_lv0013->ArrPush[23]=$vLangArr[57];
$mosl_lv0013->ArrPush[24]=$vLangArr[51];
$mosl_lv0013->ArrPush[25]=$vLangArr[52];
$mosl_lv0013->ArrPush[26]=$vLangArr[53];
$mosl_lv0013->ArrPush[27]=$vLangArr[50];
$mosl_lv0013->ArrPush[28]=$vLangArr[60];
$mosl_lv0013->ArrPush[29]=$vLangArr[61];
$mosl_lv0013->ArrPush[30]=$vLangArr[62];
$mosl_lv0013->ArrPush[31]=$vLangArr[64];
$mosl_lv0013->ArrPush[32]=$vLangArr[65];
$mosl_lv0013->ArrPush[33]=$vLangArr[66];
$mosl_lv0013->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0013');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0013->lv001=$vlv001;
$vFieldList=$mosl_lv0013->ListView;
$curPage = $mosl_lv0013->CurPage;
$maxRows =$mosl_lv0013->MaxRows;
$vOrderList=$mosl_lv0013->ListOrder;
$mosl_lv0013->obj_child=$mosl_lv0014;
$strParent=$mosl_lv0013->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);


	$vLangArr=GetLangFile("../../","SL0029.txt",$plang);
$mosl_lv0014->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0014->ArrPush[0]=$vLangArr[17];
$mosl_lv0014->ArrPush[1]=$vLangArr[18];
$mosl_lv0014->ArrPush[2]=$vLangArr[19];
$mosl_lv0014->ArrPush[3]=$vLangArr[20];
$mosl_lv0014->ArrPush[4]=$vLangArr[21];
$mosl_lv0014->ArrPush[5]=$vLangArr[22];
$mosl_lv0014->ArrPush[6]=$vLangArr[23];
$mosl_lv0014->ArrPush[7]=$vLangArr[24]."@01";
$mosl_lv0014->ArrPush[8]=$vLangArr[25];
$mosl_lv0014->ArrPush[9]=$vLangArr[26];
$mosl_lv0014->ArrPush[10]=$vLangArr[27];
$mosl_lv0014->ArrPush[11]=$vLangArr[28];
$mosl_lv0014->ArrPush[12]=$vLangArr[29];
$mosl_lv0014->ArrPush[13]=$vLangArr[30];
$mosl_lv0014->ArrPush[14]=$vLangArr[31];
$mosl_lv0014->ArrPush[15]=$vLangArr[32];
$mosl_lv0014->ArrPush[16]=$vLangArr[33];
$mosl_lv0014->ArrPush[18]=$vLangArr[46];
$mosl_lv0014->ArrPush[19]=$vLangArr[47];
$mosl_lv0014->ArrPush[20]=$vLangArr[48];
$mosl_lv0014->ArrPush[21]=$vLangArr[49];
$mosl_lv0014->ArrPush[22]=$vLangArr[41];
$mosl_lv0014->ArrPush[24]=$vLangArr[44];
$mosl_lv0014->ArrPush[26]=$vLangArr[54];
$mosl_lv0014->ArrPush[17]=$vLangArr[59];
$mosl_lv0014->ArrPush[27]=$vLangArr[55];
$mosl_lv0014->ArrPush[28]=$vLangArr[56];

$mosl_lv0014->ArrFunc[0]='//Function';
$mosl_lv0014->ArrFunc[1]=$vLangArr[2];
$mosl_lv0014->ArrFunc[2]=$vLangArr[4];
$mosl_lv0014->ArrFunc[3]=$vLangArr[6];
$mosl_lv0014->ArrFunc[4]=$vLangArr[7];
$mosl_lv0014->ArrFunc[5]='';
$mosl_lv0014->ArrFunc[6]='';
$mosl_lv0014->ArrFunc[7]='';
$mosl_lv0014->ArrFunc[8]=$vLangArr[10];
$mosl_lv0014->ArrFunc[9]=$vLangArr[12];
$mosl_lv0014->ArrFunc[10]=$vLangArr[0];
$mosl_lv0014->ArrFunc[11]=$vLangArr[33];
$mosl_lv0014->ArrFunc[12]=$vLangArr[34];
$mosl_lv0014->ArrFunc[13]=$vLangArr[35];
$mosl_lv0014->ArrFunc[14]=$vLangArr[36];
$mosl_lv0014->ArrFunc[15]=$vLangArr[37];

////Other
$mosl_lv0014->ArrOther[1]=$vLangArr[31];
$mosl_lv0014->ArrOther[2]=$vLangArr[32];
$mosl_lv0014->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0014');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0014->ListView;
$curPage = $mosl_lv0014->CurPage;
$maxRows =$mosl_lv0014->MaxRows;
$vOrderList=$mosl_lv0014->ListOrder;
$vSortNum=$mosl_lv0014->SortNum;
/////////////init object//////////////
//$ma=$_GET['ma'];
$mosl_lv0014->lv002=$vlv001;
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vStrMessage="";
?>

<?php
if($mosl_lv0013->GetView()==1)
{
	$vLangArr1=GetLangFile("../../","SL0001.txt",$plang);
  $mosl_lv0013->LV_LoadID($vlv001);
  $mosl_lv0001->LV_LoadID($mosl_lv0013->lv002);
	/*if($mosl_lv0013->lv006>0)
	$vFieldList="lv003,lv004,lv005,lv006,lv009,lv010,lv011,lv012";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv008,lv009,lv010,lv011,lv012";//$vFieldList="lv003,lv004,lv005,lv006,lv008,lv009,lv010";*/
	 $strDetail=$mosl_lv0014->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,$paging,$vOrderList,$mosl_lv0013->lv006,0,$vSortNum,$mosl_lv0013->lv022);
	 
	?>
<html>
<head>
<title></title>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>	
<body  onkeyup="KeyPublicRun(event)">
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mosl_lv0013->lv011>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0013->lv001."'>":"";?></td>
  </tr>	
 <tr>
    <td align="center" onDblClick="this.innerHTML=''"><img  src="<?php echo $mosl_lv0013->GetLogo();?>" /></td>
  </tr>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''"><div>
    <div style="float:left;text-align:left"><strong><?php echo $mosl_lv0001->lv002;?></strong><br><?php echo $vLangArr1[24];?>: <?php echo $mosl_lv0001->lv006;?><br>

<?php echo $vLangArr1[28];?>: <?php echo $mosl_lv0001->lv010;?> <?php echo $vLangArr1[30];?>: <?php echo $mosl_lv0001->lv012;?><br> <?php echo $vLangArr1[21];?>: <?php echo $mosl_lv0001->lv003;?></div><div style="float:right;text-align:right"><strong><?php echo $mosl_lv0013->GetCompany();?></strong><br><?php echo $vLangArr1[24];?>: <?php echo $mosl_lv0013->GetAddress();?>
<br><?php echo $vLangArr1[28];?>: <?php echo $mosl_lv0013->GetPhone();?>   <?php echo $vLangArr1[30];?>: <?php echo $mosl_lv0013->GetFax();?> <br> 
<?php echo $vLangArr1[32];?>: <a href="<?php echo $mosl_lv0013->GetWeb();?>" target="_blank"><?php echo $mosl_lv0013->GetWeb();?></a></div>
    </div></td>
  </tr>
  <tr>
  	<td align="center"><?php echo $strParent;?></td>
  </tr>
  <tr>
    <td align="center"><?php echo $strDetail;?></td>
  </tr>
  <?php 
  if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0010.txt",$plang);
$mosl_lv0020->lang=strtoupper($plang);
$mosl_lv0020->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vKeeper=$vLangArr[37];
$mosl_lv0020->ArrPush[0]='';
$mosl_lv0020->ArrPush[1]=$vLangArr[18];
$mosl_lv0020->ArrPush[2]=$vLangArr[19];
$mosl_lv0020->ArrPush[3]=$vLangArr[20];
$mosl_lv0020->ArrPush[4]=$vLangArr[21];
$mosl_lv0020->ArrPush[5]=$vLangArr[22];
$mosl_lv0020->ArrPush[6]=$vLangArr[23];
$mosl_lv0020->ArrPush[7]=$vLangArr[24];
$mosl_lv0020->ArrPush[8]=$vLangArr[25];
$mosl_lv0020->ArrPush[9]=$vLangArr[26];
$mosl_lv0020->ArrPush[10]=$vLangArr[27];
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv006,lv008,lv009";



$mosl_lv0051->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0012.txt",$plang);
$mosl_lv0051->ArrPush[0]=$vLangArr[17];
$mosl_lv0051->ArrPush[1]=$vLangArr[18];
$mosl_lv0051->ArrPush[2]=$vLangArr[19];
$mosl_lv0051->ArrPush[3]=$vLangArr[20];
$mosl_lv0051->ArrPush[4]=$vLangArr[21];
$mosl_lv0051->ArrPush[5]=$vLangArr[22];
$mosl_lv0051->ArrPush[6]=$vLangArr[23];
$mosl_lv0051->ArrPush[7]=$vLangArr[24];
$mosl_lv0051->ArrPush[8]=$vLangArr[25];
$mosl_lv0051->ArrPush[9]=$vLangArr[26];
$mosl_lv0051->ArrPush[10]=$vLangArr[27];
$mosl_lv0051->ArrPush[11]=$vLangArr[28];
$mosl_lv0051->ArrPush[12]=$vLangArr[29];
$mosl_lv0051->ArrPush[13]=$vLangArr[30];
$mosl_lv0051->ArrPush[14]=$vLangArr[31];
$mosl_lv0051->ArrPush[15]=$vLangArr[32];
$mosl_lv0051->ArrPush[16]=$vLangArr[33];
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0015.txt",$plang);
$mosl_lv0021->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0021->ArrPush[0]='';
$mosl_lv0021->ArrPush[1]=$vLangArr[18];
$mosl_lv0021->ArrPush[2]=$vLangArr[19];
$mosl_lv0021->ArrPush[3]=$vLangArr[20];
$mosl_lv0021->ArrPush[4]=$vLangArr[21];
$mosl_lv0021->ArrPush[5]=$vLangArr[22];
$mosl_lv0021->ArrPush[6]=$vLangArr[23];
$mosl_lv0021->ArrPush[7]=$vLangArr[24];
$mosl_lv0021->ArrPush[8]=$vLangArr[25];
$mosl_lv0021->ArrPush[9]=$vLangArr[26];
$mosl_lv0021->ArrPush[10]=$vLangArr[27];
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv006,lv008,lv009";
$strParent=$mosl_lv0021->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mosl_lv0052->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","WH0012.txt",$plang);
$mosl_lv0052->ArrPush[0]=$vLangArr[17];
$mosl_lv0052->ArrPush[1]=$vLangArr[18];
$mosl_lv0052->ArrPush[2]=$vLangArr[19];
$mosl_lv0052->ArrPush[3]=$vLangArr[20];
$mosl_lv0052->ArrPush[4]=$vLangArr[21];
$mosl_lv0052->ArrPush[5]=$vLangArr[22];
$mosl_lv0052->ArrPush[6]=$vLangArr[23];
$mosl_lv0052->ArrPush[7]=$vLangArr[24];
$mosl_lv0052->ArrPush[8]=$vLangArr[25];
$mosl_lv0052->ArrPush[9]=$vLangArr[26];
$mosl_lv0052->ArrPush[10]=$vLangArr[27];
$mosl_lv0052->ArrPush[11]=$vLangArr[28];
$mosl_lv0052->ArrPush[12]=$vLangArr[29];
$mosl_lv0052->ArrPush[13]=$vLangArr[30];
$mosl_lv0052->ArrPush[14]=$vLangArr[31];
$mosl_lv0052->ArrPush[15]=$vLangArr[32];
$mosl_lv0052->ArrPush[16]=$vLangArr[33];
if($plang=="") $plang="VN";
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


  $vresultwh=$mowh_lv0001->LV_LoadAll();
  while($vrow=db_fetch_array($vresultwh))
  {
  if(trim($vrow['lv001'])!="")
  {
  ?>
  <tr>
  <td >
  <br/>
  <div style="background-color:#555;color:#fff;height:28px;font-size:14px;padding-top:5px">
  <strong><?php echo $vrow['lv003'].":(".$vrow['lv001'].")"; ?></strong>
  </div>
  </td>
  </tr>
  <tr>
  	<td>
  		<ul>
  <?php 
  	//Nhap
  	$vdsnhap=$mosl_lv0020->LV_LoadWH($vrow['lv001'],$mosl_lv0013->lv001);
  	 while($vnhap=db_fetch_array($vdsnhap))
  	{
  		$mosl_lv0020->lv001=$vnhap['lv001'];
  		$mosl_lv0051->lv002=$vnhap['lv001'];	
  		echo "<li  style='padding-left:10px;padding-top:10px'><strong> + ".$vLangArr2[55].":".$vnhap['lv001']."</strong><HR>
  		<ul><li  style='padding-left:20px;padding-top:0px'>";
  		echo $strParent=$mosl_lv0020->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);
  		$vFieldList="lv003,lv004,lv005,lv006,lv007,lv014";
	 	echo $strDetail=$mosl_lv0051->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mosl_lv0020->lv006);
	 	echo "</li></ul></li>";
  	}
  	//Xuat
  	$vdsxuat=$mosl_lv0021->LV_LoadWH($vrow['lv001'],$mosl_lv0013->lv001);
  	 while($vxuat=db_fetch_array($vdsxuat))
  	{
  		$mosl_lv0021->lv001=$vxuat['lv001'];
  		$mosl_lv0052->lv002=$vxuat['lv001'];	
  		echo "<li  style='padding-left:10px;padding-top:10px'><strong> + ".$vLangArr2[56].":".$vxuat['lv001']."</strong><HR>
  		<ul><li style='padding-left:20px;padding-top:0px'>";
  		echo $strParent=$mosl_lv0021->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);
  		$vFieldList="lv003,lv004,lv005,lv006,lv007,lv014";
	 	echo $strDetail=$mosl_lv0052->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mosl_lv0020->lv006);
	 	echo "</li></ul></li>";
  	}	
  ?>
  		</ul>
  	</td>
  </tr>
  
  <?php 
  }
  }
  ?>
   <tr>
  <td >
  <br/>
  <div style="background-color:#555;color:#fff;height:28px;font-size:14px;padding-top:5px">
  <strong><?php echo $vLangArr2[59]; ?></strong>
  </div>
  </td>
  </tr>
  <tr>
  	<td>
  		<ul>
  <?php
  //Hợp đồng
  if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AC0016.txt",$plang);
$moac_lv0019->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0019->ArrPush[0]='';
$moac_lv0019->ArrPush[1]=$vLangArr[18];
$moac_lv0019->ArrPush[2]=$vLangArr[19];
$moac_lv0019->ArrPush[3]=$vLangArr[20];
$moac_lv0019->ArrPush[4]=$vLangArr[21];
$moac_lv0019->ArrPush[5]=$vLangArr[22];
$moac_lv0019->ArrPush[6]=$vLangArr[23];
$moac_lv0019->ArrPush[7]=$vLangArr[24];
$moac_lv0019->ArrPush[8]=$vLangArr[25];
$moac_lv0019->ArrPush[9]=$vLangArr[26];
$moac_lv0019->ArrPush[10]=$vLangArr[27];
$moac_lv0019->ArrPush[11]=$vLangArr[28];
$moac_lv0019->ArrPush[12]=$vLangArr[29];
$moac_lv0019->ArrPush[13]=$vLangArr[30];
$moac_lv0019->ArrPush[14]=$vLangArr[31];
$moac_lv0019->ArrPush[15]=$vLangArr[32];
$moac_lv0019->ArrPush[16]=$vLangArr[33];
$moac_lv0019->ArrPush[17]=$vLangArr[34];
$moac_lv0019->ArrPush[18]=$vLangArr[43];
$moac_lv0019->ArrPush[19]=$vLangArr[42];
	  if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("../../","AC0007.txt",$plang);
	$moac_lv0018->lang=strtoupper($plang);
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$moac_lv0018->ArrPush[0]='';
	$moac_lv0018->ArrPush[1]=$vLangArr[18];
	$moac_lv0018->ArrPush[2]=$vLangArr[19];
	$moac_lv0018->ArrPush[3]=$vLangArr[20];
	$moac_lv0018->ArrPush[4]=$vLangArr[21];
	$moac_lv0018->ArrPush[5]=$vLangArr[22];
	$moac_lv0018->ArrPush[6]=$vLangArr[23];
	$moac_lv0018->ArrPush[7]=$vLangArr[24];
	$moac_lv0018->ArrPush[8]=$vLangArr[25];
	$moac_lv0018->ArrPush[9]=$vLangArr[26];
	$moac_lv0018->ArrPush[10]=$vLangArr[27];
	$moac_lv0018->ArrPush[11]=$vLangArr[28];
	$moac_lv0018->ArrPush[12]=$vLangArr[29];
	$moac_lv0018->ArrPush[13]=$vLangArr[30];
	$moac_lv0018->ArrPush[14]=$vLangArr[31];
	$moac_lv0018->ArrPush[15]=$vLangArr[32];
	$moac_lv0018->ArrPush[16]=$vLangArr[33];
	$moac_lv0018->ArrPush[17]=$vLangArr[34];
	$moac_lv0018->ArrPush[18]=$vLangArr[43];
	$moac_lv0018->ArrPush[19]=$vLangArr[42];
	if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AC0011.txt",$plang);
$moac_lv0032->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0032->ArrPush[0]='';
$moac_lv0032->ArrPush[1]=$vLangArr[18];
$moac_lv0032->ArrPush[2]=$vLangArr[19];
$moac_lv0032->ArrPush[3]=$vLangArr[20];
$moac_lv0032->ArrPush[4]=$vLangArr[21];
$moac_lv0032->ArrPush[5]=$vLangArr[22];
$moac_lv0032->ArrPush[6]=$vLangArr[23];
$moac_lv0032->ArrPush[7]=$vLangArr[24];
$moac_lv0032->ArrPush[8]=$vLangArr[25];
$moac_lv0032->ArrPush[9]=$vLangArr[26];
$moac_lv0032->ArrPush[10]=$vLangArr[27];
$moac_lv0032->ArrPush[11]=$vLangArr[28];
$moac_lv0032->ArrPush[12]=$vLangArr[29];
$moac_lv0032->ArrPush[13]=$vLangArr[30];
$moac_lv0032->ArrPush[14]=$vLangArr[31];
$moac_lv0032->ArrPush[15]=$vLangArr[32];
$moac_lv0032->ArrPush[16]=$vLangArr[33];
$moac_lv0032->ArrPush[17]=$vLangArr[34];
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","AC0024.txt",$plang);
$moac_lv0033->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0033->ArrPush[0]='';
$moac_lv0033->ArrPush[1]=$vLangArr[18];
$moac_lv0033->ArrPush[2]=$vLangArr[19];
$moac_lv0033->ArrPush[3]=$vLangArr[20];
$moac_lv0033->ArrPush[4]=$vLangArr[21];
$moac_lv0033->ArrPush[5]=$vLangArr[22];
$moac_lv0033->ArrPush[6]=$vLangArr[23];
$moac_lv0033->ArrPush[7]=$vLangArr[24];
$moac_lv0033->ArrPush[8]=$vLangArr[25];
$moac_lv0033->ArrPush[9]=$vLangArr[26];
$moac_lv0033->ArrPush[10]=$vLangArr[27];
$moac_lv0033->ArrPush[11]=$vLangArr[28];
$moac_lv0033->ArrPush[12]=$vLangArr[29];
$moac_lv0033->ArrPush[13]=$vLangArr[30];
$moac_lv0033->ArrPush[14]=$vLangArr[31];
$moac_lv0033->ArrPush[15]=$vLangArr[32];
$moac_lv0033->ArrPush[16]=$vLangArr[33];
$moac_lv0033->ArrPush[17]=$vLangArr[34];
	$moac_lv0018->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0014');
	$moac_lv0032->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0032');
//////////////////////////////////////////////////////////////////////////////////////////////////////
  	$vdsinvoice=$moac_lv0018->LV_LoadList($mosl_lv0013->lv001);
	$vFieldList1='';
	$vOrderList1='';
	$vFieldList2='';
	$vOrderList2='';
  	 while($vinvoice=db_fetch_array($vdsinvoice))
  	{
  		$moac_lv0018->lv001=$vinvoice['lv001'];
  		$moac_lv0019->lv001=$vinvoice['lv001'];	
		$moac_lv0032->lv002=$vinvoice['lv001'];
  		$moac_lv0033->lv002=$vinvoice['lv001'];	
		
  		echo "<li  style='padding-left:10px;padding-top:10px'><strong> + ".$vinvoice['lv001'].":".$vinvoice['lv004']."</strong><HR>
  		<ul><li  style='padding-left:20px;padding-top:0px'>";
		$moac_lv0018->ArrPush[0]='';
		if($vinvoice['lv002']==0)
		{
  		echo $strParent=$moac_lv0018->LV_BuilListReportOther($vFieldList1,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList1);
		echo $strDetail=$moac_lv0032->LV_BuilListReportBH($vFieldList2,'document.frmchoose','chkAll','lvChk',0, 1000,$paging,$vOrderList2);
		}
		else
		{
		echo $strParent=$moac_lv0019->LV_BuilListReportOther($vFieldList1,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList1);
	 	echo $strDetail=$moac_lv0033->LV_BuilListReportBH($vFieldList2,'document.frmchoose','chkAll','lvChk',0, 1000,$paging,$vOrderList2);
		}
	 	echo "</li></ul></li>";/**/
  	}
  ?>
   <tr>
  <td >
  <br/>
  <div style="background-color:#555;color:#fff;height:28px;font-size:14px;padding-top:5px">
  <strong><?php echo $vLangArr2[58]; ?></strong>
  </div>
  </td>
  </tr>
  <tr>
  	<td>
  		<ul>
  <?php
  //Hợp đồng
  	$vdshopdong=$mosl_lv0013->LV_LoadChild($mosl_lv0013->lv001);
	$vFieldList1=$mosl_lv0013->ListView;
	$vOrderList1=$mosl_lv0013->ListOrder;
	$vFieldList2=$mosl_lv0014->ListView;
	$vOrderList2=$mosl_lv0014->ListOrder;
	$mosl_lv0013->lv001='';
	$mosl_lv0013->lv002='';
	$mosl_lv0013->lv003='';
	$mosl_lv0013->lv004='';
	$mosl_lv0013->lv005='';
	$mosl_lv0013->lv006='';
  	 while($vhopdong=db_fetch_array($vdshopdong))
  	{
  		$mosl_lv0013->lv001=$vhopdong['lv001'];
  		$mosl_lv0014->lv002=$vhopdong['lv001'];	
  		echo "<li  style='padding-left:10px;padding-top:10px'><strong> + ".$vhopdong['lv001'].":".$vhopdong['lv003']."</strong><HR>
  		<ul><li  style='padding-left:20px;padding-top:0px'>";
		$mosl_lv0013->ArrPush[0]='';
  		echo $strParent=$mosl_lv0013->LV_BuilListReportOther($vFieldList1,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList1);
	 	echo $strDetail=$mosl_lv0014->LV_BuilListReportOther($vFieldList2,'document.frmchoose','chkAll','lvChk',0, 1000,$paging,$vOrderList2,$mosl_lv0013->lv006,0,$vSortNum,$vhopdong['lv001']);
	 	echo "</li></ul></li>";/**/
  	}
  ?>
  
</table>
</body>
	<?php
} else {
	include("../permit.php");
}
?>

