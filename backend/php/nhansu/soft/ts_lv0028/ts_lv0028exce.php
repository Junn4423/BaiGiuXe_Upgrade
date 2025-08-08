<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0007.php");
require_once("../../clsall/ts_lv0012.php");
require_once("../../clsall/mn_lv0005.php");
$vlv002=$_GET['lv002'];	
$vlv003=$_GET['lv003'];	
///////////Init object ///////////////////////////////
$lvmn_lv0005=new mn_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0005');
$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
$mosl_lv0007->LV_LoadID($vlv002);
$mots_lv0012=new ts_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0012');
$mots_lv0012->LV_LoadWH($vlv002,'BTI');
if($mots_lv0012->lv008==0)
{
	$mots_lv0012->LV_LoadWH($vlv002,$vlv003);
	if($mots_lv0012->lv008==0)
		$vPrice=$mosl_lv0007->lv007;
	else
		$vPrice=$mots_lv0012->lv008;
}	
else
	$vPrice=$mots_lv0012->lv008;

///Save object

if($mosl_lv0007->lv001!=NULL && $mosl_lv0007->lv001!="")
{
	$vItemID=$mosl_lv0007->lv001;
}
else
{
?>
<?php
	$lvmn_lv0005->LV_LoadID($vlv002);
	if($lvmn_lv0005->lv001==NULL)
		$vItemID='';
	else
	{
		$vItemID=$lvmn_lv0005->lv002;
		$mosl_lv0007->LV_LoadID($vItemID);
	}
}
if($vItemID!=NULL && $vItemID!="")
{
?>
div3 = document.getElementById('txtlv903');
div3.value='<?php echo $vItemID;?>';
div5 = document.getElementById('txtlv905');
div5.value='<?php echo $mosl_lv0007->lv004;?>';
div8 = document.getElementById('txtlv908');
div8.value='<?php echo round($vPrice,0);?>';
div10 = document.getElementById('txtlv909');
div10.value='<?php echo $mosl_lv0007->lv008;?>'
div10 = document.getElementById('txtlv910');
div10.value='<?php echo $mosl_lv0007->lv011;?>';
div4 = document.getElementById('txtlv904'); 
//div4.select();
div15 = document.getElementById('txtimg_load_sp');
div15.src='<?php echo $mosl_lv0007->lv014;?>'
<?php
}
else
{
?>
div1 = document.getElementById('idNameStock');
div1.innerHTML="Item do not exist!";
div2 = document.getElementById('idBanlance');	
div2.innerHTML='';
<?php
}
db_close();
?>