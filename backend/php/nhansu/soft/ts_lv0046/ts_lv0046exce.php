<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0007.php");
$vlv002=$_GET['lv002'];	
///////////Init object ///////////////////////////////
$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0012');
$mosl_lv0007->LV_LoadID($vlv002);
///Save object

if($mosl_lv0007->lv001!=NULL && $mosl_lv0007->lv001!="")
{
?>
div5 = document.getElementById('txtlv905');
div5.value='<?php echo $mosl_lv0007->lv004;?>';
div7 = document.getElementById('txtlv906');
div7.value='<?php echo $mosl_lv0007->lv007;?>';
div8 = document.getElementById('txtlv907');
div8.value='<?php echo $mosl_lv0007->lv008;?>';
div3.focus();
//div2 = document.getElementById('idBanlance');
//div2.value='<?php echo $mosl_lv0007->lv004?>';
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