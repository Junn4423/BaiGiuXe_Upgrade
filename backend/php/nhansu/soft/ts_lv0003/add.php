<?php
session_start();
//require_once("../../clsall/ts_lv0003.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0003.php");
//////////////init object////////////////
$lvts_lv0003=new ts_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0004.txt",$plang);
$mots_lv0003->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvts_lv0003->lv001=$_POST['txtlv001'];
$lvts_lv0003->lv002=$_POST['txtlv002'];
$lvts_lv0003->lv003=$_POST['txtlv003'];
$lvts_lv0003->lv004=$_POST['txtlv004'];
$lvts_lv0003->lv005=$_POST['txtlv005'];
$lvts_lv0003->lv006=$_POST['txtlv006'];
$lvts_lv0003->lv007=$_POST['txtlv007'];
$lvts_lv0003->lv008=$_POST['txtlv008'];
if($lvts_lv0003->lv008=="" || $lvts_lv0003->lv008==NULL) $lvts_lv0003->lv008='VN';
$lvts_lv0003->lv009=$_POST['txtlv009'];
$lvts_lv0003->lv010=$_POST['txtlv010'];
$lvts_lv0003->lv011=$_POST['txtlv011'];
$lvts_lv0003->lv012=$_POST['txtlv012'];
$lvts_lv0003->lv013=$_POST['txtlv013'];
$lvts_lv0003->lv014=$_POST['txtlv014'];
$lvts_lv0003->lv015=$_POST['txtlv015'];
$lvts_lv0003->lv016=$_POST['txtlv016'];
$lvts_lv0003->lv017=$_POST['txtlv017'];
$lvts_lv0003->lv018=$_POST['txtlv018'];
$lvts_lv0003->lv019=$_POST['txtlv019'];
$lvts_lv0003->lv020=$_POST['txtlv020'];
$lvts_lv0003->lv021=$_POST['txtlv021'];
$lvts_lv0003->lv022=$_POST['txtlv022'];
$lvts_lv0003->lv026=$_POST['txtlv026'];
if($vFlag==1)
{
		
		$vresult=$lvts_lv0003->LV_Insert();
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
function add_person( $lv001,$lv002,$lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv010,$lv011,$lv012,$lv013,$lv014,$lv015,$lv016,$lv017,$lv018,$lv019,$lv020,$lv021,$lv022,$lv026)
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
  'lv010' => $lv010,
  'lv011' => $lv011,
  'lv012' => $lv012,
  'lv013' => $lv013,
  'lv014' => $lv014,
  'lv015' => $lv015,
  'lv016' => $lv016,
  'lv017' => $lv017,
  'lv018' => $lv018,
  'lv019' => $lv019,
  'lv020' => $lv020,
  'lv021' => $lv021,
  'lv022' => $lv022,
  'lv026' => $lv026,
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
			  if ( $index == 10 ) $lv010 = $cell->nodeValue;
			  if ( $index == 11 ) $lv011 = $cell->nodeValue;
			  if ( $index == 12 ) $lv012 = $cell->nodeValue;
			  if ( $index == 13 ) $lv013 = $cell->nodeValue;
			  if ( $index == 14 ) $lv014 = $cell->nodeValue;
			  if ( $index == 15 ) $lv015 = $cell->nodeValue;
			  if ( $index == 16 ) $lv016 = $cell->nodeValue;
			  if ( $index == 17 ) $lv017 = $cell->nodeValue;
			  if ( $index == 18 ) $lv018 = $cell->nodeValue;
			  if ( $index == 19 ) $lv019 = $cell->nodeValue;
			  if ( $index == 20 ) $lv020 = $cell->nodeValue;
			  if ( $index == 21 ) $lv021 = $cell->nodeValue;
			  if ( $index == 22 ) $lv022 = $cell->nodeValue;
			  if ( $index == 23 ) $lv026 = $cell->nodeValue;
			  
			  
			  $index += 1;
		  }
	  	add_person( $lv001, $lv002, $lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv010,$lv011,$lv012,$lv013,$lv014,$lv015,$lv016,$lv017,$lv018,$lv019,$lv020,$lv021,$lv022,$lv026);
	  }
	  $first_row = false;
	  }
  	}
	foreach( $data as $row )
	{
		$lvts_lv0003->LV_LoadID($row['lv001']);
		if($lvts_lv0003->lv001==NULL)
		{
		$lvts_lv0003->lv001=$row['lv001'];
		$lvts_lv0003->lv002=$row['lv002'];
		$lvts_lv0003->lv003=$row['lv003'];
		$lvts_lv0003->lv004=$row['lv004'];
		$lvts_lv0003->lv005=$row['lv005'];
		$lvts_lv0003->lv006=$row['lv006'];
		$lvts_lv0003->lv007=$row['lv007'];
		$lvts_lv0003->lv008=$row['lv008'];
		$lvts_lv0003->lv009=$row['lv009'];
		$lvts_lv0003->lv010=$row['lv010'];
		$lvts_lv0003->lv011=$row['lv011'];
		$lvts_lv0003->lv012=$row['lv012'];
		$lvts_lv0003->lv013=$row['lv013'];
		$lvts_lv0003->lv014=$row['lv014'];
		$lvts_lv0003->lv015=$row['lv015'];		
		$lvts_lv0003->lv016=$row['lv016'];
		$lvts_lv0003->lv017=$row['lv017'];		
		$lvts_lv0003->lv018=$row['lv018'];
		$lvts_lv0003->lv019=$row['lv019'];
		$lvts_lv0003->lv020=$row['lv020'];
		$lvts_lv0003->lv021=$row['lv021'];
		$lvts_lv0003->lv022=$row['lv022'];
		$lvts_lv0003->lv026=$row['lv026'];
		$vresult=$lvts_lv0003->LV_Insert();
		}
		else
		{
		$lvts_lv0003->lv001=$row['lv001'];
		$lvts_lv0003->lv002=$row['lv002'];
		$lvts_lv0003->lv003=$row['lv003'];
		$lvts_lv0003->lv004=$row['lv004'];
		$lvts_lv0003->lv005=$row['lv005'];
		$lvts_lv0003->lv006=$row['lv006'];
		$lvts_lv0003->lv007=$row['lv007'];
		$lvts_lv0003->lv008=$row['lv008'];
		$lvts_lv0003->lv009=$row['lv009'];
		$lvts_lv0003->lv010=$row['lv010'];
		$lvts_lv0003->lv011=$row['lv011'];
		$lvts_lv0003->lv012=$row['lv012'];
		$lvts_lv0003->lv013=$row['lv013'];
		$lvts_lv0003->lv014=$row['lv014'];
		$lvts_lv0003->lv015=$row['lv015'];		
		$lvts_lv0003->lv016=$row['lv016'];
		$lvts_lv0003->lv017=$row['lv017'];	
		$lvts_lv0003->lv018=$row['lv018'];
		$lvts_lv0003->lv019=$row['lv019'];	
		$lvts_lv0003->lv020=$row['lv020'];
		$lvts_lv0003->lv021=$row['lv021'];
		$lvts_lv0003->lv022=$row['lv022'];	
		$lvts_lv0003->lv026=$row['lv026'];		
		$vresult=$lvts_lv0003->LV_Update();
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
<title>SOF</title>
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
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv008.value="";
		o.txtlv009.value="";
		o.txtlv010.value="";
		o.txtlv011.value="";
		o.txtlv012.value="";
		o.txtlv013.value="";
		o.txtlv014.value="";
		o.txtlv015.value="";
		o.txtlv016.value="";
		o.txtlv017.value="";
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
		//o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
	function SaveMul()
	{
		var o=document.frmadd;
		
				o.txtFlag.value=2;
				o.submit();

	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[33];?>");
			o.txtlv001.select();
		}
		else if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv002.focus();
			}
		else if(!isphone(o.txtlv010.value)){
			alert("<?php echo $vLangArr[32];?>");
			o.txtlv010.focus();
			}	
		else if(!isphone(o.txtlv011.value)){
			alert("<?php echo $vLangArr[32];?>");
			o.txtlv011.focus();
			}	
		else if(!isphone(o.txtlv012.value)){
			alert("<?php echo $vLangArr[35];?>");
			o.txtlv012.focus();
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
if($lvts_lv0003->GetAdd()>0)
{
$loadenter	=$_POST['load-enter'];
?>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"  name="frmadd" id="frmadd"  method="post" enctype="multipart/form-data">
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
							      <?php echo 'Nạp tập tin';?>
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
								<td width="166"  height="20px"><?php echo 'Chọn tập tin xml tải lên';?></td>
								<td  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="KHACHHANGDOITAC.zip" title="<?php echo 'click here to download';?>"><?php echo 'Download mẫu';?></a></td>
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvts_lv0003->lv001=="")?InsertWithCheckExt('ts_lv0003', 'lv001', 'SUP',7):$lvts_lv0003->lv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)" />			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvts_lv0003->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $lvts_lv0003->lv003;?>" tabindex="7" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvts_lv0003->lv004;?>" tabindex="8" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvts_lv0003->lv005;?>" tabindex="9" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvts_lv0003->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							 <tr>
								<td height="20" valign="top"><?php echo $vLangArr[23];?></td>
								<td height="20">
									<table style="width:80%">
										<tr>
											<td width="50%">
												<select name="txtlv009" id="txtlv009"   tabindex="10"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
												<option value=""></option>
												<?php echo $lvts_lv0003->LV_LinkField('lv009',$lvts_lv0003->lv009);?>
												</select>
											</td>
											<td width="50%">
												<ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
													<input type="text" autocomplete="off" class="search_img_btn" name="txtlv009_search" id="txtlv009_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv009','hr_lv0083','lv002')" onFocus="LoadPopup(this,'txtlv009','hr_lv0083','lv002')" tabindex="200" >
													<div id="lv_popup4" lang="lv_popup4"> </div>						  
													</li>
												</ul>
											</td>
										</tr>
									</table>
									
								</td>
					      </tr>
							<tr>
								<td  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td height="20"><table style="width:80%">
										<tr>
											<td width="50%"><select name="txtlv007" id="txtlv007"   tabindex="11"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvts_lv0003->LV_LinkField('lv007',$lvts_lv0003->lv007);?>
							  </select></td>
											<td width="50%">
							  <ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv007_search" id="txtlv007_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv007','hr_lv0023','lv002')" onFocus="LoadPopup(this,'txtlv007','hr_lv0023','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
					      </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><table style="width:80%">
										<tr>
											<td width="50%"><select name="txtlv008" id="txtlv008"   tabindex="12"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvts_lv0003->LV_LinkField('lv008',$lvts_lv0003->lv008);?>
							  </select></td>
											<td width="50%">
							  <ul id="pop-nav2" lang="pop-nav2" onkeyup="ChangeName(this,2)" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv008_search" id="txtlv008_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv008','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv008','hr_lv0014','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
                          <tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20"><input  name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvts_lv0003->lv010;?>" tabindex="14" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[25];?></td>
							  <td  height="20"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvts_lv0003->lv011;?>" tabindex="15" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo $lvts_lv0003->lv012;?>" tabindex="16" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[27];?></td>
								<td  height="20">
									<input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvts_lv0003->lv013;?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
							  <td  height="20"><input name="txtlv014" type="text" id="txtlv014"  value="<?php echo $lvts_lv0003->lv014;?>" tabindex="18" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
							  <td  height="20"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvts_lv0003->lv015;?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[30];?></td>
				  <td  height="20"><input  name="txtlv016" type="text" id="txtlv016" value="<?php echo $lvts_lv0003->lv016;?>" tabindex="20" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>							  
						<tr>
							  <td  height="20"><?php echo $vLangArr[36];?></td>
				  <td  height="20"><input  name="txtlv017" type="text" id="txtlv017" value="<?php echo $lvts_lv0003->lv017;?>" tabindex="21" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>		
						  <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[37];?></td>
							  <td  height="20"><table style="width:80%"><tr>
							  <td width="50%"><select name="txtlv018" id="txtlv018"   tabindex="21"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  	<option value=""></option>
								<?php echo $lvts_lv0003->LV_LinkField('lv018',$lvts_lv0003->lv018);?>
							  </select></td>
							  <td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)"  onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv018_search" id="txtlv018_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv018','ts_lv0050','lv002')" onFocus="LoadPopup(this,'txtlv018','ts_lv0050','lv002')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>	
							<tr>
							  <td  height="20"><?php echo $vLangArr[38];?></td>
							<td  height="20"><input  name="txtlv019" type="text" id="txtlv019" value="<?php echo $lvts_lv0003->lv019;?>" tabindex="21" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>	
						  <tr>
							  <td  height="20"><?php echo $vLangArr[39];?></td>
							<td  height="20"><input  name="txtlv020" type="text" id="txtlv020" value="<?php echo $lvts_lv0003->lv020;?>" tabindex="21" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>	
						  <tr>
							  <td  height="20"><?php echo $vLangArr[41];?></td>
							<td  height="20"><input  name="txtlv022" type="text" id="txtlv022" value="<?php echo $lvts_lv0003->lv022;?>" tabindex="21" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>	
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[40];?></td>
							  <td  height="20"><table style="width:80%"><tr>
							  <td width="50%"><select name="txtlv021" id="txtlv021"   tabindex="21"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  	<option value=""></option>
								<?php echo $lvts_lv0003->LV_LinkField('lv021',$lvts_lv0003->lv021);?>
							  </select></td>
							  <td>
							  <ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)"  onkeyup="ChangeName(this,5)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv021_search" id="txtlv021_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv021','ac_lv0002','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv021','ac_lv0002','concat(lv001,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup5" lang="lv_popup5"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
						<tr>
							  <td  height="20"><?php echo $vLangArr[42];?></td>
							<td  height="20"><input  name="txtlv026" type="text" id="txtlv026" value="<?php echo (float)$lvts_lv0003->lv026;?>" tabindex="21" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
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
var o=document.frmadd; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
		o.txtlv001.focus();
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
	include("../ts_lv0003/permit.php");
}
?>
</body>
</html>