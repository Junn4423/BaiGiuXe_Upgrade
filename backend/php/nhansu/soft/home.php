<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
	//echo LNum2Text(11300.37,'EN','USD');
	
	
$right  = $_SESSION['ERPSOFV2RRight'] ?? null;
$userId = $_SESSION['ERPSOFV2RUserID'] ?? null;
if(isset($_GET['add_sl_lv0001']))
{
	require_once("../clsall/lv_controler.php");
	require_once("../clsall/sl_lv0001.php");
	/////////////init object//////////////
	$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
	if($mosl_lv0001->GetAdd()==1)
	{
		$mosl_lv0001->lv001=$_GET['qxtlv001'];
		$mosl_lv0001->lv002=$_GET['qxtlv002'];
		$mosl_lv0001->lv003=$_GET['qxtlv003'];
		$mosl_lv0001->lv004=$_GET['qxtlv004'];
		$mosl_lv0001->lv005=$_GET['qxtlv005'];
		$mosl_lv0001->lv006=$_GET['qxtlv006'];
		$mosl_lv0001->lv007=$_GET['qxtlv007'];
		$mosl_lv0001->lv008=$_GET['qxtlv008'];
		$mosl_lv0001->lv009=$_GET['qxtlv009'];
		$mosl_lv0001->lv010=$_GET['qxtlv010'];
		$mosl_lv0001->lv011=$_GET['qxtlv011'];
		$mosl_lv0001->lv012=$_GET['qxtlv012'];
		$mosl_lv0001->lv013=$_GET['qxtlv013'];
		$mosl_lv0001->lv014=$_GET['qxtlv014'];
		$mosl_lv0001->lv015=$_GET['qxtlv015'];
		$mosl_lv0001->lv016=$_GET['qxtlv016'];
		$mosl_lv0001->lv017=$_GET['qxtlv017'];
		$mosl_lv0001->lv018=$_GET['qxtlv018'];
		$mosl_lv0001->lv019=$_GET['qxtlv019'];
		$mosl_lv0001->lv020=$_GET['qxtlv020'];
		$mosl_lv0001->lv021=$_GET['qxtlv021'];
		$mosl_lv0001->lv022=$_GET['qxtlv022'];
		$mosl_lv0001->lv023=$_GET['qxtlv023'];
		$mosl_lv0001->lv803=$_GET['qxtlv803'];
		$mosl_lv0001->lv804=$_GET['qxtlv804'];
		$mosl_lv0001->lv805=$_GET['qxtlv805'];
		$mosl_lv0001->lv807=$_GET['qxtlv807'];
		$vIDCus=$mosl_lv0001->LV_CheckExitCus($mosl_lv0001->lv001);
		if($vIDCus==null)		
			$vresult=$mosl_lv0001->LV_Insert();	
		else
			$vresult=$mosl_lv0001->LV_Insert_Update();	
		echo '[CHECKSLLV0001]';
		echo ($vresult)?1:0;
		echo '[ENDCHECKSLLV0001]';	
		echo '[CHECKSLLV00ID]';
		echo $mosl_lv0001->lv001;
		echo '[ENDCHECKSLLV00ID]';	
	}
	exit();
}	
if(isset($_GET['add_cr_lv0027']))
{
	require_once("../clsall/lv_controler.php");
	require_once("../clsall/cr_lv0027.php");
	/////////////init object//////////////
	$mocr_lv0027=new cr_lv0027($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0027');
	if($mocr_lv0027->GetAdd()==1)
	{
		$mocr_lv0027->lv001=$_GET['cxtlv001'];
		$mocr_lv0027->lv002=$_GET['cxtlv002'];
		$mocr_lv0027->lv003=$_GET['cxtlv003'];
		$mocr_lv0027->lv004=$_GET['cxtlv004'];
		$mocr_lv0027->lv005=$_GET['cxtlv005'];
		$mocr_lv0027->lv006=$_GET['cxtlv006'];
		$mocr_lv0027->lv007=$_GET['cxtlv007'];
		$mocr_lv0027->lv008=$_GET['cxtlv008'];
		$mocr_lv0027->lv009=$_GET['cxtlv009'];
		$mocr_lv0027->lv010=$_GET['cxtlv010'];
		$mocr_lv0027->lv011=$_GET['cxtlv011'];
		$mocr_lv0027->lv012=$_GET['cxtlv012'];
		$mocr_lv0027->lv013=$_GET['cxtlv013'];
		$mocr_lv0027->lv014=$_GET['cxtlv014'];
		$mocr_lv0027->lv015=$_GET['cxtlv015'];
		$mocr_lv0027->lv016=$_GET['cxtlv016'];
		$mocr_lv0027->lv017=$_GET['cxtlv017'];
		$mocr_lv0027->lv018=$_GET['cxtlv018'];
		$mocr_lv0027->lv019=$_GET['cxtlv019'];
		$mocr_lv0027->lv020=$_GET['cxtlv020'];
		$mocr_lv0027->lv021=$_GET['cxtlv021'];
		$mocr_lv0027->lv022=$_GET['cxtlv022'];
		$mocr_lv0027->lv023=$_GET['cxtlv023'];
		$mocr_lv0027->lv803=$_GET['cxtlv803'];
		$mocr_lv0027->lv804=$_GET['cxtlv804'];
		$mocr_lv0027->lv805=$_GET['cxtlv805'];
		$mocr_lv0027->lv807=$_GET['cxtlv807'];
		$vIDCus=$mocr_lv0027->LV_CheckExitCus($mocr_lv0027->lv001);
		if($vIDCus==null)		
			$vresult=$mocr_lv0027->LV_Insert();	
		else
			$vresult=$mocr_lv0027->LV_Insert_Update();	
		echo '[CHECKSLLV0001]';
		echo ($vresult)?1:0;
		echo '[ENDCHECKSLLV0001]';	
		echo '[CHECKSLLV00ID]';
		echo $mocr_lv0027->lv803;
		echo '[ENDCHECKSLLV00ID]';	
	}
	exit();
}	
	if($_SESSION['ERPSOFV2RUserID']=="" || $_SESSION['ERPSOFV2RUserID']==NULL)  redirect('../index.php');	
	else
	{
/////////////////////////////////////////////////////////	
	$_SESSION['UserFilesPath']="/lvhrv1_0/images/human/";
	$plang=strtoupper($plang);
	if($plang!="VN" || $plang=="")
		$plang="EN";
	
//Object test	
	$molv_controlmn=new lv_controlmn();		
include("../clsall/lvsoft_v1_2010.php");
$molvhrv1_0=new lvhrv1_0($plang,$_SESSION['ERPSOFV2RUserID']);
//////////////////////////////////////////////////////
//Init object
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
	$xajax = new xajax();
	include(TREEVIEW_SOURCE."ajax/ajax.php");	//Enables real-time update. Must be called before any headers or HTML output have been sent.
	$xajax->processRequests();
	
	//Define identify name(s) to your treeview(s); Add more comma separated names to create more than one treeview. The treeview names must always be unique. You canÂ´t even use the same treeview names on different php sites. 
	$treeviewid = array("treeviewcheckbox");
	
	include(TREEVIEW_SOURCE."clsall/treeviewcreate.php"); //Creates phptreeview objects.	

	$opt = isset($_GET['opt']) ? (int)$_GET['opt'] : 0; // hoặc giá trị mặc định phù hợp
	$lvmenu = $molvhrv1_0->createframeall($_SESSION['ERPSOFV2RUserID'], $opt, $plang);
	if(isset($_POST['txtflagfavorite']) && $_POST['txtflagfavorite'])
	{
			$molvhrv1_0->lv_updatefavorite($_SESSION['ERPSOFV2RUserID'],$_POST['txtfavoritename'],$_POST['txtfavorite']);
	
	}	
	else if(isset($_POST['txtflagfavorite']) && $_POST['txtflagfavorite']==2)
	{
		$molvhrv1_0->lv_deletefavorite($_SESSION['ERPSOFV2RUserID'],$_POST['txtfavorite']);	
	}
	$lv_favorite_state=$molvhrv1_0->lv_checkfavorite($_SESSION['ERPSOFV2RUserID'],"?".$_SERVER['QUERY_STRING']);
	if($lv_favorite_state==true)
	{
		$str_favorite='<input type="hidden" name="txtfavoritename" value=""/><input type="hidden" name="txtflagfavorite" value="2"/> <input type="hidden" name="txtfavorite" value="?'.$_SERVER['QUERY_STRING'].'"/><a href="javascript:RemoveFavorite()">'.GetLangTopBar(10,$lang).'</a>';
	}
	else
	{
		$lang = isset($_GET['lang']) ? $_GET['lang'] : 'vi';
		$str_favorite='<input type="hidden" name="txtfavoritename" value=""/><input type="hidden" name="txtflagfavorite" value="1"/> <input type="hidden" name="txtfavorite" value="?'.$_SERVER['QUERY_STRING'].'"/><a href="javascript:AddFavorite()">'.GetLangTopBar(9,$lang).'</a>';
	}
	$themes=getInfor($_SESSION['userlogin_smcd'],99);
	if($themes=='')	$themes='themes1';	
	$molvhrv1_0->ThuHangHienTai=$molvhrv1_0->LV_GetLevel($molvhrv1_0->LV_UserID);
	if($molvhrv1_0->ThuHangHienTai=='' || $molvhrv1_0->ThuHangHienTai==null) $molvhrv1_0->ThuHangHienTai='AA';
	$vNoiDung=$molvhrv1_0->LV_TaiLieuThanhVien($molvhrv1_0->LV_UserID);
	?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>SOF</title>
<?php  $xajax->printJavascript(TREEVIEW_SOURCE."ajax/framework"); //Enables real-time update. ?>
<link href="../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../logo.ico" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="../css/<?php echo $themes;?>.css" type="text/css">
<link rel="StyleSheet" href="../css/menu.css" type="text/css">	
<link rel="stylesheet" href="../css/helppopup.css" type="text/css">
<link rel="stylesheet" href="../css/responsive_v1.css" type="text/css">
<style type="text/css">
.topbarview
{
 color:#FFFFFF;
 font-family:Arial, Helvetica, sans-serif;
 font-weight:bold;
 font-size:11px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" src="../javascripts/screen.js"></script>
<script language="javascript" src="../javascripts/pubscript.js"></script>
<script language="javascript" src="../javascripts/engines.js"></script>
<script language="javascript" src="../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../javascripts/menuvertical.js"></script>
<script language="javascript" src="../javascripts/jquery.js"></script>
<script language="javascript">
function callscreen2()
	{
		/*var heightscreen=document.body.scrollHeight ;
		vsof_pages=document.getElementById('sof_pages');
		vsof_left=document.getElementById('sof_left');
		vsof_pages.style.height=heightscreen+"px";
		vsof_left.style.minHeight=vsof_pages.style.height;*/
		vsof_menu=document.getElementById('submenu-nav');
		if(screen.height-300<0) 
			vsof_menu.style.height=(screen.height-250)+"px";
		else
			vsof_menu.style.height=(screen.height-250)+"px";
		vsof_func=document.getElementById('func_id');
		var lefts=parent.document.getElementById('sof_left');
	/*	if(lefts.style.display=="none")
		{
			vsof_func.style.width=(parent.document.body.scrollWidth-0)+"px";
		}
		else
			vsof_func.style.width=(parent.document.body.scrollWidth-294)+"px";
	*/	
	}
</script>
</head>
<script language="javascript">
function AddFavorite()
{
	var o=document.frmfavorite;
	o.txtfavoritename.value=document.getElementById('lvtitlelist').innerHTML;
	o.submit();	
}
function RemoveFavorite()
{
	var o=document.frmfavorite;
	o.txtfavoritename.value=document.getElementById('lvtitlelist').innerHTML;
	o.submit();	
}
var strnodenouse="";
var leftmenuspt=0;
function closepopchinhanh()
{
	var chinhanh=document.getElementById('chinhanh');
	chinhanh.style.display='none';
	
}
function openpopchinhanh()
{
	<?php
	
	if($vNoiDung=='' || $vNoiDung==null)
	{
	?>
	return;
	<?php
	}
	?>
	var chinhanh=document.getElementById('chinhanh');
	chinhanh.style.display='block';
	
}
</script>
<body  onkeyup="KeyPublicRun(event)" onload="">
<style>
	#showparent
	{
		width:100%!important;
	}
	#showparenttext
	{
		width:100%!important;
	}
</style>	
<div name="chinhanh" id="chinhanh" style="display: none;opacity: 0.9; position: absolute; top: 20px; z-index: 2147483647;width:100%;height:100%;background:#ffff;">
						<center><?php echo $vNoiDung;?>	<!--<img onclick="closepopchinhanh()" src="chuongtrinh/ck3.jpg" style="width:90%;cursor:pointer;"/>--></center>
									<?php  //echo $molvhrv1_0->LV_GetLinkCN();?>
						</div>	
					<div style="clear:both"><div id="lv_right_titlelist" style="text-align:right;width:50px;float:right"></div></div>
					<div id="showparenttext" style="width:100%!important;"><input type="textbox" id="txtfocusup" value='' style="height:1px;width:1px;background:#fff;border:0px #fff;"/></div>
					<div id="showparent" style="text-align:left;width:100%!important;" >
					
			 <?php 
				$molvhrv1_0->FillSessionEmpty();
				include("paras.php"); 
				if(!isset($plink)) $plink=$molvhrv1_0->getfirstlink;
				

				controlmain($popt,$pitem,$plink,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
					/*if(strpos($molvhrv1_0->getoptionrun,"@".$popt."@")>0 || (($_GET['opt']==''|| $_GET['opt']==null || $_GET['opt']==4)))
						controlmain($popt,$pitem,$plink,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
					else
						include("permit.php");*/
			?>
				<a href="#" class="scrollup"></a>
				</div>
				<div id="lvright" style="clear:both;"><input type="textbox" id="txtfocus" value='' style="height:1px;width:1px;background:#fff;border:0px #fff;"/></div>
				</div>
<script type="text/javascript">
    $(document).ready(function(){ 
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        }); 
		
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
 
    });
</script>
	
<script language="javascript" src="../javascripts/menuhelppopup.js"></script>
<!-- End ImageReady Slices -->
</body>
<script language="javascript">
setTimeout("callscreen2()",500);
function setZoom(i)
{
	var o=document.frmthemes;
	o.allcreen.value=((i==0)?"1":"0");
	o.submit();
}
//parent.resizeIframeIndex(document.body.scrollHeight-100,document.body.scrollWidth);
</script>
</html>
<?php
}?>
<?php ob_end_flush();?>