<?php
error_reporting(E_ERROR | E_PARSE);
ob_start();
//Define where you have placed the phptreeview folder.
$vArrLink=Array();
define("TREEVIEW_SOURCE", "../");	 
include(TREEVIEW_SOURCE."clsall/treeviewclasses.php"); //Include the phptreeview engine.
session_start();
 
	include("config.php");
	include("configrun.php");
	include("function.php");
	include("paras.php");
	include("excfile.php");
	include("librarianconfig.php");	
	include("../clsall/lv_controlmn.php");
	require_once("../clsall/lv_controler.php");
	require_once("../clsall/hr_lv0020.php");
	if($_SESSION['ERPSOFV2RUserID']=="" || $_SESSION['ERPSOFV2RUserID']==NULL)  redirect('../index.php');	
	else
	{
if(isset($_GET['ajaxsate']))
	{	
		$vsql="update lv_lv0007 set lv098=concat(curdate(),' ',curtime()) where lv001='".$_SESSION['userlogin_smcd']."' and lv097<>''";
		$vresult=db_query($vsql);
	}	
/////////////////////////////////////////////////////////	
	$_SESSION['UserFilesPath']="/lvhrv1_0/images/human/";
	$plang=strtoupper($plang);
	if($plang!="VN" || $plang=="")
		$plang="EN";
	
//Object test	
	$molv_controlmn=new lv_controlmn();		
include("../clsall/lvsoft_v1_2010.php");
$molvhrv1_0=new lvhrv1_0($plang,$_SESSION['ERPSOFV2RUserID']);
if(isset($_GET['ajaxmenu']))
	{	
			echo '[CHECKOPT]';
				echo $vmenuopt=$_GET['menuopt'];
			echo '[ENDCHECKOPT]';
			echo '[CHECKDEF]';
				echo $strall=$molvhrv1_0->getmenuchildall($_SESSION['ERPSOFV2RUserID'],(int)$vmenuopt,$plang,$giatrian,$lvspt);
			echo '[ENDCHECKDEF]';
		exit();
	}
			
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
	$lvmenu=$molvhrv1_0->createframeall($_SESSION['ERPSOFV2RUserID'],(int)$_GET['opt'],$plang);
	if($_POST['txtflagfavorite']==1 )
	{
			$molvhrv1_0->lv_updatefavorite($_SESSION['ERPSOFV2RUserID'],$_POST['txtfavoritename'],$_POST['txtfavorite']);
	}	
	else if (isset($_POST['txtflagfavorite']) && $_POST['txtflagfavorite'] == 2)
	{
		$molvhrv1_0->lv_deletefavorite($_SESSION['userlogin_smcd'],$_POST['txtfavorite']);	
	}
	else if (($_POST['txtflagfavorite'] ?? null) == 3)
	{
		$molvhrv1_0->lv_deleteall($_SESSION['userlogin_smcd']);	
	}
	$lv_favorite_state=$molvhrv1_0->lv_checkfavorite($_SESSION['userlogin_smcd'],"?".$_SERVER['QUERY_STRING']);
	if($lv_favorite_state==true)
	{
		$str_favorite='<input type="hidden" name="txtfavorite" value="?'.$_SERVER['QUERY_STRING'].'"/>';
	}
	else
	{
		$str_favorite='<input type="hidden" name="txtfavorite" value="?'.$_SERVER['QUERY_STRING'].'"/>';
	if (!isset($_POST['txtfavorite']) || $_POST['txtfavorite'] == "") 
		{	if($_GET['link']!="" && $_GET['link']!=NULL)
			{
				$vName= $molvhrv1_0->lv_checkfavorite_name($_SESSION['userlogin_smcd'],base64_decode($_GET['link']),$plang);
				$molvhrv1_0->lv_updatefavorite($_SESSION['userlogin_smcd'],$vName,"?".$_SERVER['QUERY_STRING']);
			}
		}
	}
	$themes='';
if (isset($_POST['txtthemes']) && $_POST['txtthemes'] != "") 
	{
		$themes=$_POST['themes'];
		if($_SESSION['userlogin_smcd']!="" && $_SESSION['userlogin_smcd']!=NULL)
			GetUserThemeUpdate($_SESSION['userlogin_smcd'],$themes);
		else
			GetThemeUpdate($_SESSION['userlogin_smcd'],$themes);
	}
	else
	{
		$themes=getInfor($_SESSION['userlogin_smcd'],99);
	}
	if($themes=='')	$themes='themes1';
	$vallcreen = isset($_POST['allcreen']) ? $_POST['allcreen'] : "";	
	?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>SOF</title>
<?php  $xajax->printJavascript(TREEVIEW_SOURCE."ajax/framework"); //Enables real-time update. ?>
<link href="../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../logo.ico" >
<link rel="stylesheet" href="../css/<?php echo $themes;?>.css" type="text/css">
<link rel="StyleSheet" href="../css/menu.css" type="text/css">	
<link rel="stylesheet" href="../css/helppopup.css" type="text/css">
<link rel="stylesheet" href="../css/responsive.css" type="text/css">
<link rel="stylesheet" href="../chat/css/chat_tab.css" type="text/css">

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
var vitritab=1;
function callscreen2()
	{
			var o=document.getElementById('sof_left');
			var tt=document.getElementById('sof_pages_content');
			//tt.style.width="100% !important";
			if(o.style.width=='')
			{
				tt.style.width=(document.body.scrollWidth-280)+"px";
			}
			else
				tt.style.width=(document.body.scrollWidth-o.style.width-30)+"px";
			//resizeIframeIndex(screen.height,document.body.scrollWidth-22);
	}
	function runtrangchu()
	{
		window.open('?lang=<?php echo $plang;?>','_self')
	}
	function onmovebottom()
	{
		
		document.getElementById('blogIframe_1').contentWindow.document.getElementById('txtfocus').focus();
		
	}
	function moveup()
	{
		document.getElementById('blogIframe_1').contentWindow.document.getElementById('txtfocusup').focus();
	}
</script>
</head>
<script language="javascript">

var strnodenouse="";
var leftmenuspt=0;
</script>
<body  onkeyup="KeyPublicRun(event)">
		<div id="lvtitlelist" style="display:none"></div>
		<center>
		<div id="sof">		
			<center>
			<div id="sof_pages">			
				<div class="sof_pages_header" >
					<div class="hd_title">
						<div id="hd_title_left" class="hd_title_left" style="width:254px">
							<div class="hd_title_left_user" style="float:left;text-align:center;min-width:120px;">
								<center>
								<form name="frmfavorite" action="#" method="post"> 
							<input type="hidden" name="txtfavoritename" value=""/><input type="hidden" name="txtflagfavorite" value=""/> <?php echo $str_favorite;?>
							<ul>
								<li style="float:left">
									<ul id="menu2-nav">
										<li class="menusubT2"><div style="margin-top:0px;"><div style="float:left">
										<?php 
										$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
										$lvhr_lv0020->LV_LoadID($lvhr_lv0020->LV_UserID);
										if($lvhr_lv0020->lv018==1)
										{
											switch($lvhr_lv0020->lv009)
											{
												case 0:
													$vImageView='<image width="27" src="../images/duyet_nam.png"/>';
													break;
												default:
													$vImageView='<image width="27" src="../images/chuaduyet_nam.png"/>';
													break;
											}
												
												
										}
										else
										{
											switch($lvhr_lv0020->lv009)
											{
												case 0:
													$vImageView='<image width="27" src="../images/duyet_nu.png"/>';
													break;
												default:
													$vImageView='<image width="27" src="../images/chuaduyet_nu.png"/>';
													break;
											}
										}
										echo $vImageView;
										?>
										<!--<img width="27" src="user.png"/>--></div>
										<div style="float:left;padding-top:5px;min-width:120px;font-size:10px"><a style="font-size:10px;color:#F6941D!important;"><strong><?php echo GetUserName($_SESSION['userlogin_smcd'],$plang);?><?php //echo '('.$_SESSION['userlogin_smcd'].')';?></strong></a></div></div>
										<ul id="submenu2-nav" style="top:25px;left:0px">
									<?php  echo $molvhrv1_0->getTopBar($_SESSION['userlogin_smcd'],$plang);?>
											
									<!--<li><a onclick="oncloseall()" style="cursor:pointer"><font class=lvfuncview ><strong><?php echo GetLangTopBar(14,$plang);?></strong></font></a>-->
									<li>
									<strong> <a href="../logout1.php"><font class=lvfuncview ><strong><?php echo GetLangTopBar(4,$plang);?></strong></font></a></strong>
									</li>
									</ul>
									</li></ul>
								</li>
							</ul>
							</form>
								<center>
							</div>
							<div style="float:left;text-align:right;padding-right:0px">
								<img src="logo.gif" style="cursor:pointer;height:30px;" onclick="runtrangchu()"/>
							</div>
							<div style="float:right;text-align:right;padding-right:0px">								
								<div style="float:right"><img src="min.png" style="cursor:pointer;height:26px;padding-right:5px;" onclick="setLeftView(this)"/></div>
								<div style="float:right"><img src="../images/icon/trangchu.png" style="cursor:pointer;height:28px;display:none;padding-right:5px;" onclick="runtrangchu()" class="homeid"/></div>
							</div>
						</div>
						<div id="hd_menumain_left" style="float:left;padding-left:4px;padding-right:2px;padding-top:4px;padding-bottom:0px;">
							<div class="bg_next_prev" style="float:left;padding-left:5px"><img src="bottom.png"  style="z-index:9999;left:0px;cursor:pointer;height:28px;" onclick="onmovebottom()"></div>
							<div class="bg_next_prev" style="padding-left:5px;float:left"><img src="top.png" id="next_button_id" style="z-index:9999;cursor:pointer;height:28px;" onclick="moveup()"></div>
						</div>
						<div id="hd_title_content" style="float:left;overflow:hidden;height:35px;position:relative;">
							
							<div style="float:left">					
								<div id="hd_menumain" class="hd_menumain" style="float:left;margin-top:5px;position:absolute">
									<?php
										echo $molvhrv1_0->lv_getfavoritefull($_SESSION['ERPSOFV2RUserID'],$plang,$vArrLink);
									?>
									<input type="hidden" name="curtab" id="curtab" value="<?php echo count($vArrLink);?>"/>	
									<input type="hidden" name="fullscreen" id="fullscreen" value="0"/>	
								 </div>					
							</div>
							
							<div style="float: right;">
								<img id="chatButton" src="../chat/chat.png" alt="Chat Button">
							</div>

							<!-- Chat panel -->
							<div id="chatPanel" style="display: none;">
								<div id="chatHeader" style="background: #007bff;">
									<svg id="chatBackButton" class="chatIconButton" style="display: none;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
										<path fill="#ffffff" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
									</svg>
									<span id="chatTitle" style="font-weight: bold;">Tin nhắn</span>
									<div id="chatHeaderButtons">
										<svg id="chatSettingButton" class="chatIconButton" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
											<path fill="#ffffff" d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/>
										</svg>
										<button class="chatIconButton" id="closeChat">×</button>
									</div>
								</div>
								<div id="chatContent">
									<div id="userListPanel"></div>
									<div id="messagePanel" style="display: none; position: relative;">
										<div id="messageList"></div>
										<div id="filePreview"></div>
										<div id="messageForm">
											<input type="file" id="chatFileInput" multiple style="display: none">
											<svg class="chatIconButton" id="attachFileBtn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path d="M364.2 83.8c-24.4-24.4-64-24.4-88.4 0l-184 184c-42.1 42.1-42.1 110.3 0 152.4s110.3 42.1 152.4 0l152-152c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-152 152c-64 64-167.6 64-231.6 0s-64-167.6 0-231.6l184-184c46.3-46.3 121.3-46.3 167.6 0s46.3 121.3 0 167.6l-176 176c-28.6 28.6-75 28.6-103.6 0s-28.6-75 0-103.6l144-144c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-144 144c-6.7 6.7-6.7 17.7 0 24.4s17.7 6.7 24.4 0l176-176c24.4-24.4 24.4-64 0-88.4z"/>
											</svg>
											<input type="text" id="messageInput" placeholder="Nhập tin nhắn...">
											<button id="sendMessageBtn">Gửi</button>
										</div>
									</div>
								</div>
							</div>							
						</div>
						<div id="hd_title_right" class="hd_title_right" style="width:35px">
							<div id="hd_menumain_left" style="float:right;padding:4px;padding-bottom:0px;">
								<!------bottom--------->
							</div>
						</div>
					</div>
				</div>
				<?php //echo $lvmenu;?>
				<div class="sof_pages_full" id="sof_pages_full"  style="text-align:left;">
				<?php 
					//if($_SESSION['ERPSOFV2RUserID']!='employees')
					{
					?>
				<div style="height:39px"></div>
				<?php
					}
					?>
				<div style="">
				<?php
				//$vState=($_SESSION['ERPSOFV2RUserID']=='admin')?'block':'none';
				?>
				<div id="sof_left" style="float:left;<?php echo ($_SESSION['ERPSOFV2RUserID']=='employees')?'padding-top:0px!important;':'';?>;background:url(SOF.png) 100%;background-position: center;background-size: cover;">
					<div class="sof_left_menu"  style="display:<?php echo ($_SESSION['ERPSOFV2RUserID']=='employees')?'none':'block';?>">
						<?php								
						$giatrian=""; 
						$lvspt=0;
						$strall=$molvhrv1_0->getmenuchildall($_SESSION['ERPSOFV2RUserID'],(int)$_GET['opt'],$plang,$giatrian,$lvspt);
						echo str_replace("<!--".$_GET['opt']."-->",$strall,$lvmenu);
						?>
							<script language="javascript">
								strnodenouse="<?php echo $giatrian;?>";
								leftmenuspt=<?php echo $lvspt;?>;
							</script>
						<input type="hidden" name="idleft_cur" id="idleft_cur" value="<?php echo $molvhrv1_0->curmenu_stt;?>"/>
					</div>
					<?php 
					if($_SESSION['ERPSOFV2RUserID']=='employees')
					{
					?>
					<div class="sof_left_themes" style="display:block;">
						<?php 
							include('pagesleft.php')
						?>
					</div>
					<?php
					}
					?>
					<div class="sof_left_themes">
						<div class="sof_left_themes_title">
						<?php if($plang=='VN') 
								echo $lvhr_lv0020->lv005 ;
							else 
								echo $lvhr_lv0020->lv060 ;
								?>
						</div>
						<div class="sof_left_themes_content" style="clear:both;overflow:hidden">
							<form name="frmthemes" action="" method="post">
							<input type="hidden" name="txtthemes" value="1"/>
							<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
							<ul style="clear:both">
								<li>
								<?php
								$vKetQua=$lvhr_lv0020->LV_LoadStepCheck($lvhr_lv0020->lv001);
								
								if($vKetQua!=null)
								{
									echo "<img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"150px\" height=\"178px\" src=\"hr_lv0020/readfile.php?UserID=".$lvhr_lv0020->lv001."&type=8&size=1\" />";
								}
								else
								{
									if($lvhr_lv0020->lv018==1)
										{
											switch($lvhr_lv0020->lv009)
											{
												case 0:
													$vImageView='<image  width="150px"  src="../images/duyet_nam.png"/>';
													break;
												default:
													$vImageView='<image  width="150px" src="../images/chuaduyet_nam.png"/>';
													break;
											}
												
												
										}
										else
										{
											switch($lvhr_lv0020->lv009)
											{
												case 0:
													$vImageView='<image  width="150px"  src="../images/duyet_nu.png"/>';
													break;
												default:
													$vImageView='<image width="150px"   src="../images/chuaduyet_nu.png"/>';
													break;
											}
										}
										echo $vImageView;
								}

								?>
								</li>
							</ul>
							<!--<ul style="clear:both">
							<?php
							
							/*$vsql="select lv001,".(($plang=='VN')?'lv002':'lv003')." lv002 from lv_lv0011";
							$vresult=db_query($vsql);
							while($vrow=db_fetch_array($vresult))
							{
							?>
								<li>
								<div style="clear:both"><div style="float:left"><input onchange="document.frmthemes.submit()" type="radio" name="themes" value="<?php echo $vrow['lv001'];?>" <?php echo ($vrow['lv001']==$themes)?"checked":"";?>/></div><div style="float:left;padding-top:7px;padding-left:5px"><?php echo $vrow['lv002'];?></div></div>
								</li>
							<?php
							}
							*/
							?>
							</ul>-->
							</form>
						</div>
						
					</div>
				</div>
				
				<div id="sof_pages_content" class="sof_pages_content" style="position:relative;float:left">
					<div style="clear:both"><div id="lv_right_titlelist" style="text-align:right;width:50px;float:right"></div></div>
					<div id="showparenttext"></div>
					<div id="showparent">
			 <?php 
				$i=1;
				if(count($vArrLink)==1 && $popt!='' && $plink!='')
				{
							$vLink[0]='?'.$_SERVER['QUERY_STRING'];
							echo '<div id="lvtab_'.$i.'" style="display:none;width:100%;height:100%">';
								$strView=$strView.'if('.$i.'==i){ if(o.innerHTML==\'\')  {o.innerHTML=\'<iframe id="blogIframe_'.$i.'" onload="this.focus()" width="100%" height="100%" marginheight=0 marginwidth=0 frameborder=0 src="home.php'.$vLink[0].'" class=lvframe></iframe>\';}else return;}';
								$strViewLoad=$strViewLoad.'if('.$i.'==i){  o.innerHTML=\'<iframe id="blogIframe_'.$i.'" onload="this.focus()" width="100%" height="100%" marginheight=0 marginwidth=0 frameborder=0 src="home.php'.$vLink[0].'" class=lvframe></iframe>\';}';
								//controlmain($popt,$pitem,$plink,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
							echo '</div>';
				}
				else
				{
					foreach($vArrLink as $vLink)
					{
						$molvhrv1_0->FillSession($vLink[0]);
						include("paras.php");
						if(strpos($molvhrv1_0->getoptionrun,"@".$popt."@")>0 || 1==1 )
						{
							if(strpos($molvhrv1_0->getoptionrun,"@".$popt."@")===false)
							{
								$vLink[1]='?'.$_SERVER['QUERY_STRING'];
							}
							if($vLink[1]==true)
							{
								echo '<div id="lvtab_'.$i.'" style="display:block;width:100%;height:100%">';
								$vstrSetDefault="setviewtab($i)";
							}
							else
								echo '<div id="lvtab_'.$i.'" style="display:none;width:100%;height:100%">';
								$strView=$strView.'if('.$i.'==i){ if(o.innerHTML==\'\')  {o.innerHTML=\'<iframe id="blogIframe_'.$i.'" onload="this.focus()" width="100%" height="100%" marginheight=0 marginwidth=0 frameborder=0 src="home.php'.$vLink[0].'" class=lvframe></iframe>\';}else return;}';
								$strViewLoad=$strViewLoad.'if('.$i.'==i){  o.innerHTML=\'<iframe id="blogIframe_'.$i.'" onload="this.focus()" width="100%" height="100%" marginheight=0 marginwidth=0 frameborder=0 src="home.php'.$vLink[0].'" class=lvframe></iframe>\';}';
								//controlmain($popt,$pitem,$plink,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
							echo '</div>';
						}
						else
							include("permit.php");
						$i++;
					}
				}
				
			?>
				</div>
					<div id="lvright"></div>
					</div>
				</div>
				</div>
				<div class="sof_pages_footer" style="height:30px!important;"  >
					<div style="width:100%" >
						<table style="width:100%">
							<tr>
								<td style="width:88px">
									<img src="../images/logo/logo.png" height="25" onclick="runtrangchu()" style="cursor:pointer;"/>
								</td>
							
								<td  width="*%">
								<marquee onmouseover="this.stop()" onmouseout="this.start()" scrolldelay="190">
								<span style="color:#f2fb63;text-transform: uppercase;"><?php echo $molvhrv1_0->LV_GetAlarm();?></span>
								</marquee>
								</td>
								
							</tr>
							</table>
					</div>
					<div class="sof_pages_footer_right">
						<!--<div style="float:right;padding-right:10px">
							<?php
							//if($_SESSION['ERPSOFV2RUserID']!='employees') echo '<div style="float:left"><a href="http://www.sof.vn" target="_blank"><font color="#fff">Powered by</font><br/> <font color="white"> www.sof.vn</font> </a></div>';?>
							
						</div>>-->
						<a href="#" class="scrollup"></a>
					</div
				</div>
			</div>
		</div>
</div>
<center>
</div>		
</center>
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

<style>
	#sof
	{
		width:100% !important;
	}
	#sof_pages
	{
			width:100% !important;
			padding:0px;
			margin:0px;
	}
	
</style>

</body>
<script language="javascript">
setTimeout("callscreen2()",500);
function setConfirmView()
{
	var fullheight=0;
	var isfull=document.getElementById('fullscreen').value;
	if(isfull=='1') fullheight=0;
	var o=document.getElementById('sof_left');
	var tt=document.getElementById('sof_pages_content');	
	var ttpr=document.getElementById('showparent');
	if(o.style.display=="none" || (o.style.display=="" && document.body.scrollWidth<=1024))
	{
		o.style.height=(window.innerHeight-90-fullheight)+"px";
		tt.style.height=(window.innerHeight-70-fullheight)+"px";
		ttpr.style.height=(parseInt(tt.style.height)-10)+"px";
		tt.style.width=(document.body.scrollWidth-o.style.width-30)+"px";
		resizeIframeIndex(window.innerHeight-80-fullheight,document.body.scrollWidth);
	}
	else
	{
		o.style.height=(window.innerHeight-90-fullheight)+"px";
		tt.style.width=(window.innerHeight-274-fullheight)+"px !important";
		tt.style.height=(window.innerHeight-70-fullheight)+"px";
		ttpr.style.height=(parseInt(tt.style.height)-10)+"px";
		resizeIframeIndex(window.innerHeight-80-fullheight,document.body.scrollWidth-274);
	}
	return;
}
function setLeftView(t)
{
	var fullheight=0;
	var isfull=document.getElementById('fullscreen').value;
	if(isfull=='1') fullheight=0;
	var o=document.getElementById('sof_left');
	var tt=document.getElementById('sof_pages_content');
	var ttpr=document.getElementById('showparent');		
	if(o.style.display=="none" || (o.style.display=="" && document.body.scrollWidth<1000))
	{
		var w=document.body.scrollWidth;
		tt.style.width=(w-274)+"px";
		ttpr.style.width=(w-274)+"px";;
		o.style.display="block";
		t.src="min.png";
		o.style.height=(window.innerHeight-90-fullheight)+"px";
		tt.style.height=(window.innerHeight-70-fullheight)+"px";
		ttpr.style.height=tt.style.height;
		resizeIframeIndex(window.innerHeight-80-fullheight,w-274);
	}
	else
	{
		o.style.display="none";
		t.src="max.png";
		o.style.height=(window.innerHeight-90-fullheight)+"px";
		tt.style.height=(window.innerHeight-70-fullheight)+"px";
		ttpr.style.height=tt.style.height;
		tt.style.width=(document.body.scrollWidth)+"px";
		resizeIframeIndex(window.innerHeight-80-fullheight,document.body.scrollWidth);
	}
}
function AddFavorite()
{
	var o=document.frmfavorite;
	sum=<?php echo count($vArrLink);?>;
	o.txtflagfavorite.value="1";
	o.txtfavoritename.value=document.getElementById('lvtabli_'+sum).title;
	o.submit();	
}
function RemoveFavorite()
{
	var o=document.frmfavorite;
	sum=<?php echo count($vArrLink);?>;
	o.txtfavoritename.value=document.getElementById('lvtabli_'+sum).title;
	o.txtflagfavorite.value="2";
	o.submit();	
}
function RemoveFavoriteTab(vLink)
{
	var o=document.frmfavorite;
	sum=<?php echo count($vArrLink);?>;
	o.txtfavorite.value=vLink;
	o.txtflagfavorite.value="2";
	o.submit();	
}
function setviewtabload(i)
{
	curtab(i)
	sum=<?php echo count($vArrLink);?>;
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('lvtab_'+j);
		if(i==j)
		{
			o.style.display="block";
			//alert(window.innerHeight+'-'+window.innerHeight);
			vitritab=i;
			//o.style.height=(window.innerHeight-80)+"px";
			<?php echo $strViewLoad;?>
			//resizeIframeIndex(document.body.scrollHeight,document.body.scrollWidth-20);
			setConfirmView();
		}
		else
			o.style.display="none";
	}
}
function setviewtab(i)
{
	curtab(i)
	sum=<?php echo count($vArrLink);?>;
	
	for(jt=i+1;jt<=sum;jt++)
	{
		var o=document.getElementById('lvtab_'+jt);
		o.style.display="none";
	}
	for(jt=i-1;jt>=1;jt--)
	{	
		var o=document.getElementById('lvtab_'+jt);
		o.style.display="none";
	}
	if(i!=0)
	{
		var o=document.getElementById('lvtab_'+i);
		o.style.display="block";
		vitritab=i;
		<?php echo $strView;?>
		setConfirmView();
	}
		
	
}
function curtab(i)
{
	sum=<?php echo count($vArrLink);?>;
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('lvtabli_'+j);
		if(i==j)
		{
			
			o.className="lifullmenucur";
			var to=document.getElementById('curtab');
			to.value=i;
		
		}
		else
			o.className="lifullmenu";
	}
}
function oncloseall()
{
	var o=document.frmfavorite;
	o.action="?lang=<?php echo $plang;?>";
	o.txtflagfavorite.value="3";
	o.submit();	
}
function onmousenext()
{
	var hd_menumain=document.getElementById('hd_menumain');
	if(hd_menumain.style.left=="") hd_menumain.style.left=0;
	var vint=parseInt(hd_menumain.style.left)-170;
	var vw=parseInt(hd_menumain.style.width);
	if(-vint-170>vw) vint=-vw;
	hd_menumain.style.left=vint+"px";
}
function onmousepre()
{
	var hd_menumain=document.getElementById('hd_menumain');
	if(hd_menumain.style.left=="") hd_menumain.style.left=0;
	var vint=parseInt(hd_menumain.style.left)+170;
	if(vint>0) vint=0;
	hd_menumain.style.left=vint+"px";
}
function startscreen()
{
	var fullheight=0;
	var isfull=document.getElementById('fullscreen').value;
	if(isfull=='1') fullheight=0;
	var to=document.getElementById('sof_pages_full');
	to.style.height=(window.innerHeight-35-fullheight)+'px';
	var hd_left=document.getElementById('hd_title_left');
	var hd_right=document.getElementById('hd_title_right');
	var wleft=parseInt(hd_left.style.width);
	var wright=parseInt(hd_right.style.width);
	var hscre=window.innerWidth;
	var hd_content=document.getElementById('hd_title_content');
	var bnt_right=document.getElementById('next_button_id');
	hd_content.style.width=(hscre-(wleft+wright)-55)+"px";
	bnt_right.style.left=(hscre-(wleft+wright)-70)+"px";
	var hd_menumain=document.getElementById('hd_menumain');
	hd_menumain.style.width=(170)*<?php echo (count($vArrLink)>0)?count($vArrLink):1;?>+"px";	
}
function resizeIframeIndex(newHeight,newWidth)
{	
	var to=document.getElementById('curtab');
    document.getElementById('blogIframe_'+to.value).style.height = (parseInt(newHeight,10)+10) + 'px';
	document.getElementById('blogIframe_'+to.value).style.width = parseInt(newWidth,10) + 'px';
}	
<?php echo ($vstrSetDefault=="")?"setviewtab(1)":$vstrSetDefault;?>
</script>
<script language="javascript">
function closeall()
{
	for(var i=1;i<120;i++)
	{
		var vot=document.getElementById('ul_menu_'+i);
		if(vot==null)
		{
		}
		else
		{
			vot.style.display="none";
		}
	}
}
function openoptionhere(value)
		{
			var str=document.getElementById('sof_left').innerHTML;
			var n=str.indexOf('<!--'+value+'-->');
			closeall();
			if(n<=0)
			{
				
				var vot=document.getElementById('ul_menu_'+value);
				/*if(vot.style.display=="block") 
					vot.style.display="none";
				else*/
					vot.style.display="block";
			}
			$xmlhttp1=null;
			xmlhttp1=GetXmlHttpObject();
			if (xmlhttp1==null)	
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"&ajaxmenu=program"+"&menuopt="+value+"&lang=<?php echo $plang;?>";
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedLoadMenu;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
		}
function stateChangedLoadMenu()
{
	if (xmlhttp1.readyState==4)
		{		
			var startdomain1=xmlhttp1.responseText.indexOf('[CHECKDEF]')+10;
			var enddomain1=xmlhttp1.responseText.indexOf('[ENDCHECKDEF]');
			var domainid1=xmlhttp1.responseText.substr(startdomain1,enddomain1-startdomain1);
			var startdomain2=xmlhttp1.responseText.indexOf('[CHECKOPT]')+10;
			var enddomain2=xmlhttp1.responseText.indexOf('[ENDCHECKOPT]');
			var domainid2=xmlhttp1.responseText.substr(startdomain2,enddomain2-startdomain2);
			var str=document.getElementById('sof_left').innerHTML;
			document.getElementById('sof_left').innerHTML=str.replace('<!--'+domainid2+'-->',domainid1);
		}
}		
		function GetXmlHttpObject()
		{
			if (window.XMLHttpRequest)
			{
			  // code for IE7+, Firefox, Chrome, Opera, Safari
				return new XMLHttpRequest();
			}
			if (window.ActiveXObject)
			{
			  // code for IE6, IE5
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			return null;
		}
setTimeout("Load_CheckSate()",1000);
function Load_CheckSate()
{
			$xmlhttp11=null;
			xmlhttp11=GetXmlHttpObject();
			if (xmlhttp11==null)	
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"&ajaxsate=ok";
			url=url.replace("#","");
			xmlhttp11.onreadystatechange=stateChangedStates;
			xmlhttp11.open("GET",url,true);
			xmlhttp11.send(null);
}
function stateChangedStates()
{
	if (xmlhttp11.readyState==4)
		{	
		setTimeout("Load_CheckSate()",58000);
	}
}
startscreen();
</script>
<script language="javascript" src="../chat/javascripts/socket.io.min.js"></script>
<script language="javascript" src="../chat/javascripts/chat_socket.js"></script>
<script language="javascript" src="../chat/javascripts/chat_tab.js"></script>
<script>
  const chatUserId = "<?php echo $_SESSION['chat_user_id'] ?? ''; ?>";
  const chatToken = "<?php echo $_SESSION['chat_token'] ?? ''; ?>";
</script>

</html>
<?php
}?>
<?php ob_end_flush();?>