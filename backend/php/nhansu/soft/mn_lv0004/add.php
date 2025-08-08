<?php
session_start();
//require_once("../../clsall/mn_lv0004.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/mn_lv0004.php");
require_once("../../clsall/sl_lv0007.php");
//////////////init object////////////////
$lvmn_lv0004=new mn_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0004');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if(isset($_GET['ajax']))
{
	$lvsl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
	$vitemid=$_GET['itemid'];
	$lvsl_lv0007->LV_LoadID($vitemid);
	echo '[CHECK]';
	echo '<select name="txtlv005" id="txtlv005"   tabindex="9"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/> '.$lvmn_lv0004->LV_LinkField('lv005',$lvsl_lv0007->lv004).'</select>';
	echo '[ENDCHECK]';
	exit;
}	
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","MN0002.txt",$plang);
$momn_lv0004->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvmn_lv0004->lv001=$_POST['txtlv001'];
$lvmn_lv0004->lv002= $_GET['ID'] ?? '';
$lvmn_lv0004->lv003=$_POST['txtlv003'];
$lvmn_lv0004->lv004=$_POST['txtlv004'];
$lvmn_lv0004->lv005=$_POST['txtlv005'];
$lvmn_lv0004->lv006=$_POST['txtlv006'];
$lvmn_lv0004->lv007=$_POST['txtlv007'];
$lvmn_lv0004->lv008=$_POST['txtlv008'];
$lvmn_lv0004->lv009=$_POST['txtlv009'];
$lvmn_lv0004->lv010=$_POST['txtlv010'];
$lvmn_lv0004->lv011=$_POST['txtlv011'];
$lvmn_lv0004->lv099=$_POST['txtlv099'];
if($lvmn_lv0004->lv011=="" || $lvmn_lv0004->lv011==NULL) $lvmn_lv0004->lv011="0";
if($vFlag==1)
{		
		$vresult=$lvmn_lv0004->LV_Insert();
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
function add_person( $lv001,$lv002,$lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv011)
  {
  global $data;
  
  $data []= array(
  'lv001' => $lv001,
  'lv002' => $lv002,
  'lv003' => $lv003,
  'lv004' => $lv004,
  'lv005' => $lv005,
  'lv006' => $lv006,
  'lv007' => $lv007,
  'lv008' => $lv008,
  'lv009' => $lv009,
  'lv011' => $lv011,
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
			 if ( $index == 1 ) $lv001 = $cell->nodeValue;
			  if ( $index == 2 ) $lv002 = $cell->nodeValue;
			  if ( $index == 3 ) $lv003 = $cell->nodeValue;
			  if ( $index == 4 ) $lv004 = $cell->nodeValue;
			  if ( $index == 5 ) $lv005 = $cell->nodeValue;
			  if ( $index == 6 ) $lv006 = $cell->nodeValue;
			  if ( $index == 7 ) $lv007 = $cell->nodeValue;
			  if ( $index == 8 ) $lv008 = $cell->nodeValue;
			  if ( $index == 9 ) $lv009 = $cell->nodeValue;
			  if ( $index == 10 ) $lv011 = $cell->nodeValue;
			  $index += 1;
		  }
	  	add_person( $lv001, $lv002, $lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv011);
	  }
	  $first_row = false;
	  }
  	}
	foreach( $data as $row )
	{
	
		$vitemid=$row['lv003'];
		//$lvmn_lv0004->LV_LoadStrucID($row['lv002'],$row['lv003']);
		//if($lvmn_lv0004->lv001==NULL)
		$lvsl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
		$lvsl_lv0007->LV_LoadID($vitemid);
		if($lvsl_lv0007->lv001!=NULL && $lvsl_lv0007->lv001!="")
		{
		$lvmn_lv0004->lv002=$row['lv002'];
		$lvmn_lv0004->lv003=$row['lv003'];
		$lvmn_lv0004->lv004=$row['lv004'];
		if($lvmn_lv0004->lv004<0) $lvmn_lv0004->lv004=-$lvmn_lv0004->lv004;
		$lvmn_lv0004->lv005=$row['lv005'];
		$lvmn_lv0004->lv006=$row['lv006'];
		$lvmn_lv0004->lv007=$row['lv007'];
		$lvmn_lv0004->lv008=$row['lv008'];
		$lvmn_lv0004->lv009=$row['lv009'];
		$lvmn_lv0004->lv011=$row['lv011'];
		$lvmn_lv0004->lv099=$row['lv001'];
		$vresult=$lvmn_lv0004->LV_InsertTemp();
		}
		/*else
		{
		$lvmn_lv0004->lv002=$row['lv002'];
		$lvmn_lv0004->lv003=$row['lv003'];
		$lvmn_lv0004->lv004=$row['lv004'];
		$lvmn_lv0004->lv005=$row['lv005'];
		$lvmn_lv0004->lv006=$row['lv006'];
		$lvmn_lv0004->lv007=$row['lv007'];
		$lvmn_lv0004->lv008=$row['lv008'];
		$lvmn_lv0004->lv009=$row['lv009'];
		$lvmn_lv0004->lv011=$row['lv011'];	
		$vresult=$lvmn_lv0004->LV_Update();
		}*/
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
		//o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv003.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv003.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
-->
</script>
<?php
if($lvmn_lv0004->GetAdd()>0)
{
$loadenter	=$_POST['load-enter'];
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"   name="frmadd" id="frmadd"  method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						 <input name="txtFlag" type="hidden" id="txtFlag"  />
						<table width="100%" border="0" align="center" id="table">
							<tr>
							  <td colspan="2" height="100%" align="center"><p>
							    <label>
							      <input type="radio" name="load-enter" value="0" id="load-enter_0" <?php echo ($loadenter==0)?'checked':'';?> onClick="changestate(1)">
							       <?php echo $vLangArr[34];?>
							    </label>
							    
							    <label>
							      <input type="radio" name="load-enter" value="1" id="load-enter_1" <?php echo ($loadenter==1)?'checked':'';?> onClick="changestate(2)">
							      <?php echo $vLangArr[35];?>
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
								<td width="166"  height="20px"><?php echo $vLangArr[32];?></td>
								<td  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="MAU_CAUTRUCNGUYENLIEU.zip" title="<?php echo $vLangArr[33];?>"><?php echo $vLangArr[32];?></a></td>
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvmn_lv0004->lv001=="")?InsertWithCheckExt('mn_lv0004', 'lv001', '',1):$lvmn_lv0004->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvmn_lv0004->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[17];?></td>
							  <td  height="20">
							 <table style="width:80%"><tr>
							  <td width="50%"><input name="txtlv003" type="text" id="txtlv003"  value="<?php echo $lvmn_lv0004->lv003;?>" tabindex="6" maxlength="225" style="width:100%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','sl_lv0007','concat(lv002,@! - @!, lv001)')" onFocus="LoadPopup(this,'txtlv003','sl_lv0007','concat(lv002,@! - @!, lv001)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				              <td  height="20"><input name="txtlv004" id="txtlv004"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo (float)$lvmn_lv0004->lv004;?>"/></td>
</tr>							  
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><table style="width:80%"><tr>
							  <td width="50%"><div id="itemsgetid"><select name="txtlv005" id="txtlv005"   tabindex="9"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvmn_lv0004->LV_LinkField('lv005',$lvmn_lv0004->lv005);?>
							  </select></div></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv005_search" id="txtlv005_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv005','sl_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv005','sl_lv0005','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo (float)$lvmn_lv0004->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td  height="20"><input name="txtlv007" id="txtlv007"   tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvmn_lv0004->lv007;?>"/> </td>
					      </tr>						 
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><input name="txtlv008" id="txtlv008"   tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvmn_lv0004->lv008;?>"/>		
							  </td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><table style="width:80%" ><tr>
							  <td width="50%">
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" name="txtlv009" id="txtlv009" tabindex="13" style="width:100%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvmn_lv0004->lv009;?>" onKeyUp="LoadSelf(this,'txtlv009','sl_lv0017','lv003')" onFocus="LoadSelf(this,'txtlv009','sl_lv0017','lv003')">
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
						    </tr>
                         	<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[31];?></td>
							  <td  height="20"><select name="txtlv011" id="txtlv011"   tabindex="9"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvmn_lv0004->LV_LinkField('lv011',$lvmn_lv0004->lv011);?>
							  </select></td>
						    </tr>		
							<tr>
							  <td  height="20" valign="top"><?php echo 'Nhóm';?></td>
							  <td  height="20"><input name="txtlv099" id="txtlv099"   tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvmn_lv0004->lv099;?>"/>		
							  </td>
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
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				
				</form>
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
		o.txtlv003.focus();
</script>

<script language="javascript" src="../../javascripts/menupopup.js"></script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		Cancel();
	//-->
	</script>
	<?php
	}
	?>
<?php
} else {
	include("../mn_lv0004/permit.php");
}
?>
</body>
</html>