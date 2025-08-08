<?php
session_start();
//require_once("../../clsall/mn_lv0005.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/mn_lv0005.php");
require_once("../../clsall/sl_lv0007.php");
//////////////init object////////////////
$lvmn_lv0005=new mn_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0005');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if(isset($_GET['ajax']))
{
	$lvmn_lv0005=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
	$vitemid=$_GET['itemid'];
	$lvmn_lv0005->LV_LoadID($vitemid);
	echo '[CHECK]';
	echo '<select name="txtlv005" id="txtlv005"   tabindex="9"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/> '.$lvmn_lv0005->LV_LinkField('lv005',$lvmn_lv0005->lv004).'</select>';
	echo '[ENDCHECK]';
	exit;
}	
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","MN0016.txt",$plang);
$momn_lv0005->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvmn_lv0005->lv001=$_POST['txtlv001'];
$lvmn_lv0005->lv002=$_POST['txtlv002'];
if($lvmn_lv0005->lv002==NULL || $lvmn_lv0005->lv002=="") $lvmn_lv0005->lv002= $_GET['ID'] ?? '';
$lvmn_lv0005->lv003=$_POST['txtlv003'];
if($vFlag==1)
{		
		$vresult=$lvmn_lv0005->LV_Insert();
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
else if($vFlag==2)
{
		$data = array();
function add_person( $lv001,$lv002,$lv003)
  {
  global $data;
  
  $data []= array(
  'lv001' => $lv001,
  'lv002' => $lv002,
  'lv003' => $lv003
  );
  }

	 $lvNow=GetServerDate()." ".GetServerTime();
	 if ( $_FILES['file']['tmp_name'] )
  	{
	  $dom=new DOMDocument();
	  	$dom->load( $_FILES['file']['tmp_name'] );
	  $rows = $dom->getElementsByTagName( 'Row' );
	  $first_row = true;
	  foreach ($rows as $row)
	  {
		  if ( !$first_row )
		  {
			  $first = "";
			  $middle = "";
			  $last = "";
			  $email = "";
			  
			  $index = 1;
			  $cells = $row->getElementsByTagName( 'Cell' );
			  foreach( $cells as $cell )
			  { 
			  $ind = $cell->getAttribute( 'Index' );
			  if ( $ind != null ) $index = $ind;
			 if ( $index == 1 ) $lv000 = $cell->nodeValue;
			  if ( $index == 2 ) $lv001 = $cell->nodeValue;
			  if ( $index == 3 ) $lv002 = $cell->nodeValue;
			  if ( $index == 4 ) $lv003 = $cell->nodeValue;
			  $index += 1;
		  }
	  	if(trim($lv001)!='') add_person( $lv001, $lv002, $lv003);
	  }
	  $first_row = false;
	  }
  	}
	foreach( $data as $row )
	{
	
		$vitemid=$row['lv002'];
		//$lvmn_lv0005->LV_LoadStrucID($row['lv002'],$row['lv003']);
		//if($lvmn_lv0005->lv001==NULL)
		$lvsl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
		$lvsl_lv0007->LV_LoadID($vitemid);
		if($lvsl_lv0007->lv001!=NULL && $lvsl_lv0007->lv001!="")
		{
			$lvmn_lv0005->lv001=$row['lv001'];
			$lvmn_lv0005->lv002=$row['lv002'];
			$lvmn_lv0005->lv003=$row['lv003'];
			$vresult=$lvmn_lv0005->LV_InsertTemp();
		}
		
	}
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>
</head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789.()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){	
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmadd;
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv008.value="";
		o.txtlv009.value="";
		o.txtlv010.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
-->
</script>
<?php
if($lvmn_lv0005->GetAdd()>0)
{
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"   name="frmadd" id="frmadd"  method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" id="table">
							<tr>
							  <td colspan="2" height="100%" align="center"><p>
							    <label>
							      <input type="radio" name="load-enter" value="0" id="load-enter_0" <?php echo ($loadenter==0)?'checked':'';?> onClick="changestate(1)">
							       <?php echo 'Nhập tay';?>
							    </label>
							    
							    <label>
							      <input type="radio" name="load-enter" value="1" id="load-enter_1" <?php echo ($loadenter==1)?'checked':'';?> onClick="changestate(2)">
							      <?php echo 'Tải từ tập tin';?>
							    </label>
							    <br>
						      </p></td>
						  </tr>
                         </table>
<!---Load File-->                         
                         <div id="fileload" style="display:none">
                         <table width="100%" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo 'Chọn tập tin để tải';?></td>
								<td  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="MAU_BARRCODE.zip" title="<?php echo $vLangArr[33];?>"><?php echo 'Tải tập tin';?></a></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
                                        <TBODY>
                                        <TR vAlign=center align=middle>
                                              <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:SaveMul();" tabindex="16"><img src="../images/controlright/save_f2.png" 
                                            alt="Save" title="<?php echo $vLangArr[1];?>" 
                                            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
                                          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
                                            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
                                            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
                                          <TD nowrap="nowrap"><a class=lvtoolbar 
                                            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
                                            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
                                            name=remove> <?php echo $vLangArr[6];?></a></TD>
                                            </TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
                      </div>
<!---End Load File-->
<!---Enter New Line-->                      
                      <div id="enterline" style="display:block">
						<table width="100%" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[15];?></td>
								<td  height="20">
									<input name="txtlv001" type="text" id="txtlv001"  value="" tabindex="5" maxlength="128" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
						    </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><table style="width:80%"><tr>
							  <td width="50%"><select name="txtlv002" id="txtlv002"   tabindex="7"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvmn_lv0005->LV_LinkField('lv002',$lvmn_lv0005->lv002);?>
							  </select>	</td>
							  <td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv002_search" id="txtlv002_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv002','sl_lv0007','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv002','sl_lv0007','concat(lv002,@! @!,lv001)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
				              <td  height="20"><input name="txtlv003" id="txtlv003"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvmn_lv0005->FormatView($lvmn_lv0005->lv003,2);?>"/></td>
							</tr>													
							<tr>
							  <td  height="20" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="47"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="48"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
			</div>
			      </form>	

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	function changestate(value)
	{
		var o1=document.getElementById('fileload');
		var o2=document.getElementById('enterline');
		if(value==2)
		{
			o1.style.display="block";
			o2.style.display="none";
			
		}
		else
		{
			o1.style.display="none";
			o2.style.display="block";
		}
	}
	changestate(<?php echo (int)$loadenter+1;?>)
	function SaveMul()
	{
		var o=document.frmadd;
		
				o.txtFlag.value=2;
				o.submit();

	}
	function changeitem_change(value)
	{
		$xmlhttp=null;
		if(value=="") 
		{
		alert("Please! Item is not empty!");
		return false;
		}
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		url=url+"?&ajax=ajaxcheck"+"&itemid="+value;
		url=url.replace("#","");
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	function stateChanged()
	{
		if (xmlhttp.readyState==4)
		{
			var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
			var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
			var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
			document.getElementById('itemsgetid').innerHTML=domainid;
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
	var o=document.frmadd;
		o.txtlv001.focus();
</script>

<script language="javascript" src="../../javascripts/menupopup.js"></script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		//Cancel();
	//-->
	</script>
	<?php
	}
	?>
<?php
} else {
	include("../mn_lv0005/permit.php");
}
?>
</body>
</html>