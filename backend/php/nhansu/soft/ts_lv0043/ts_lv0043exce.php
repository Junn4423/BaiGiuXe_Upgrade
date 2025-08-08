<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0012.php");
$vlv002=$_GET['lv002'];	
$vlv003=$_GET['lv003'];	
///////////Init object ///////////////////////////////
$mots_lv0012=new ts_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0012');
$mots_lv0012->LV_LoadWH($vlv002,$vlv003);
///Save object

if($mots_lv0012->lv001!=NULL && $mots_lv0012->lv001!="")
{
?>
div3 = document.getElementById('txtlv903');
div5 = document.getElementById('txtlv905');
div5.value='<?php echo $mots_lv0012->lv005;?>';
div7 = document.getElementById('txtlv907');
div7.value='<?php echo $mots_lv0012->lv007;?>';
div8 = document.getElementById('txtlv908');
div8.value='<?php echo $mots_lv0012->lv008;?>';
div9 = document.getElementById('txtlv909');
div9.value='<?php echo $mots_lv0012->lv009;?>';
div10 = document.getElementById('txtlv910');
div10.value='<?php echo $mots_lv0012->lv010;?>';
div11 = document.getElementById('txtlv911');
div11.value='<?php echo $mots_lv0012->lv011;?>';
div3.focus();
//div2 = document.getElementById('idBanlance');
//div2.value='<?php echo $mots_lv0012->lv004?>';
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