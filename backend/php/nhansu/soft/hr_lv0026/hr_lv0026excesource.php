<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0020.php");

$mohr_lv0020=new  hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');	
$vlEmpID=$_GET['EmpID'];	
$mohr_lv0020->LV_LoadID($vlEmpID);
///////////Init object ///////////////////////////////
if($mohr_lv0020->lv001!="" && $mohr_lv0020->lv001!=NULL)
{
?>
var div003 = document.getElementById('txtlv003');
div003.value='<?php echo $mohr_lv0020->lv002;?>';
var div005 = document.getElementById('txtlv005');
div005.value='<?php echo $mohr_lv0020->FormatView($mohr_lv0020->lv015,2);?>';
var div006 = document.getElementById('txtlv006');
div006.value='<?php echo $mohr_lv0020->lv010;?>';
var div007 = document.getElementById('txtlv007');
div007.value='<?php echo str_replace("'","",$mohr_lv0020->lv026);?>';
var div009 = document.getElementById('txtlv009');
div009.value='<?php echo str_replace("'","",$mohr_lv0020->lv034);?>';
var div012 = document.getElementById('txtlv012');
div012.value='<?php echo str_replace("'","",$mohr_lv0020->lv018);?>';
<?php
}
?>