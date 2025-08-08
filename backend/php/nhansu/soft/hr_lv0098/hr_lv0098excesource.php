<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0038.php");

$mohr_lv0038=new  hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');	
$vlHDID=$_GET['HDID'];	
$vlv005=$_GET['lv005'];	
$vlv006=$_GET['lv006'];	
$vlv011=$_GET['lv011'];	
$vlv012=$_GET['lv012'];	
$vType=$_GET['Type'];	
$mohr_lv0038->LV_LoadID($vlHDID);
///////////Init object ///////////////////////////////
if($mohr_lv0038->lv001!="" && $mohr_lv0038->lv001!=NULL)
{
?>
var div024 = document.getElementById('txtlv006');
div024.value='<?php echo str_replace("'","",$mohr_lv0038->lv010);?>';
var div025 = document.getElementById('txtlv010');
div025.value='<?php echo str_replace("'","",$mohr_lv0038->lv027);?>';
var div026 = document.getElementById('txtlv011');
div026.value='<?php echo str_replace("'","",$mohr_lv0038->lv028);?>';
var div027 = document.getElementById('txtlv012');
div027.value='<?php echo str_replace("'","",$mohr_lv0038->lv029);?>';
var div028 = document.getElementById('txtlv013');
div028.value='<?php echo str_replace("'","",$mohr_lv0038->lv030);?>';
<?php
}
?>