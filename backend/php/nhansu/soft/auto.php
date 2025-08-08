<?php
ob_start();
//Define where you have placed the phptreeview folder.
$vArrLink=Array();
define("TREEVIEW_SOURCE", "../");	 
include(TREEVIEW_SOURCE."clsall/treeviewclasses.php"); //Include the phptreeview engine.
session_start();
//Cáº¥u hÃ¬nh 
	include("config.php");
	include("configrun.php");
	include("function.php");
	include("paras.php");
	include("excfile.php");
	include("librarianconfig.php");	
	include("../clsall/lv_controlmn.php");
	
/////////////////////////////////////////////////////////	
	$_SESSION['UserFilesPath']="/lvhrv1_0/images/human/";
	$plang=strtoupper($plang);
	if($plang!="VN" || $plang=="")
		$plang="EN";
	
//Object test	
	$molv_controlmn=new lv_controlmn();		
include("../clsall/lvsoft_v1_2010.php");
$molvhrv1_0=new lvhrv1_0($plang,$_SESSION['ERPSOFV2RUserID']);

include("paras.php");
if($plink=="" ) $plink=$molvhrv1_0->getfirstlink;
	if(strpos($molvhrv1_0->getoptionrun,"@".$popt."@")>0 || (($_GET['opt']==''|| $_GET['opt']==null || $_GET['opt']==4)))
		controlmain($popt,$pitem,$plink,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
	else
		include("permit.php");
?>