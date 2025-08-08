<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/cr_lv0086.php");

$mocr_lv0086=new  cr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0086');
$vLoadID=$_GET['LoadID'];	
$mocr_lv0086->LV_LoadID($vLoadID);
$vDate=GetServerDate();
if($mocr_lv0086->lv001!='' && $mocr_lv0086->lv001!=NULL)
{
?>
div02 = document.getElementById('qxtlv002');
div02.value='<?php echo str_replace("'","",$mocr_lv0086->lv002);?>';
div03 = document.getElementById('qxtlv003');
div03.value='<?php echo str_replace("'","",$mocr_lv0086->lv003);?>';	
div06 = document.getElementById('qxtlv006');
div06.value='<?php echo str_replace("'","",$mocr_lv0086->lv006);?>';	
div07 = document.getElementById('qxtlv007');
div07.value='<?php echo str_replace("'","",$mocr_lv0086->lv007);?>';	
div08 = document.getElementById('qxtlv008');
div08.value='<?php echo str_replace("'","",$mocr_lv0086->lv008);?>';	
div12 = document.getElementById('qxtlv012');
div12.value='<?php echo str_replace("'","",$mocr_lv0086->lv012);?>';	
div04 = document.getElementById('qxtlv004');
div04.value='<?php echo str_replace("'","",$mocr_lv0086->lv004);?>';	
<?php
}
?>
div04 = document.getElementById('qxtlv004');
div04.focus();