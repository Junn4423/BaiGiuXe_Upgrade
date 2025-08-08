<?php session_start(); ?>
<?php 
include("soft/config.php");
include("soft/function.php");
// destroy PHP session of currently logged in user
$vDate=GetServerDate();
$vTime=GetServerTime();
//session_start();
Logtime($_SESSION['ERPSOFV2RUserID'],$vDate,$vTime,1,$_SESSION['SOFIP'],$_SESSION['SOFMAC']);
$vsql="update lv_lv0007 set lv008='',lv009=concat(CurDate(),' ',CurTime()) where lv001='".$_SESSION['ERPSOFV2RUserID']."'";
$vresult=db_query($vsql);
unset( $_SESSION['userlogin_smcd'] );
unset( $_SESSION['ERPSOFV2RUserID'] );
unset( $_SESSION['ERPSOFV2RRRight'] );
unset( $_SESSION['SOFONLINE'] );
if (isset( $_SESSION['ERPSOFV2RUserID'] )) {
	session_destroy();
}
if (isset( $_SESSION['ERPSOFV2RRRight'] )) {
	session_destroy();
}
if (isset( $_SESSION['SOFONLINE'] )) {
	session_destroy();
}
if (isset( $_SESSION['userlogin_smcd'] )) {
	session_destroy();
}
redirect("index.php");
?>

