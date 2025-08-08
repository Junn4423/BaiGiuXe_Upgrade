<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0007.php");
$vlv002=$_GET['lv002'];	
$vlv003=$_GET['lv003'];	
///////////Init object ///////////////////////////////
$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
$mosl_lv0007->LV_LoadID($vlv002);
///Save object

if($mosl_lv0007->lv001!=NULL && $mosl_lv0007->lv001!="")
{
$vConvert=((float)$mosl_lv0007->lv006==0)?'1':(float)$mosl_lv0007->lv006;
?>
div3 = document.getElementById('txtlv903');
div5 = document.getElementById('txtlv905');
div5.value='<?php echo $mosl_lv0007->lv004;?>';
div7 = document.getElementById('txtlv907');
div7.value='<?php echo $mosl_lv0007->lv005;?>';
divc = document.getElementById('txtconvert');
divc.value='<?php echo $vConvert;?>';
div8 = document.getElementById('txtlv908');
div8.value='<?php echo round($mosl_lv0007->lv007/$vConvert,1);?>';
div10 = document.getElementById('txtlv909');
div10.value='<?php echo $mosl_lv0007->lv008;?>'
div10 = document.getElementById('txtlv910');
div10.value='<?php echo $mosl_lv0007->lv011;?>';
div4 = document.getElementById('txtlv904'); 
//div4.select();
<?php 
if($mosl_lv0007->lv012=="FIFO" || $mosl_lv0007->lv012=="LIFO")
{
$vNow=GetServerDate();
$vTime=GetServerTime();
$vLotId=str_replace("-","",$vNow)."".str_replace(":","",$vTime);
?>
div14 = document.getElementById('txtlv914');
div14.value='<?php echo $vLotId?>';
<?php 
}?>
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