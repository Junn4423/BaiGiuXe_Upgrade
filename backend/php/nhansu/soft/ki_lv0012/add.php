<?php
session_start();
//require_once("../../clsall/ki_lv0012.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ki_lv0012.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/tc_lv0025.php");
require_once("../../clsall/tc_lv0013.php");
//////////////init object////////////////
$lvki_lv0012=new ki_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0012');
$lvtc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$lvtc_lv0025=new tc_lv0025($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0025');

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","KI0012.txt",$plang);

$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvki_lv0012->lv001=InsertWithCheckExt('ki_lv0012', 'lv001', '',1);
$lvki_lv0012->lv002=$_GET['ChildID'];
$lvki_lv0012->lv003=$_POST['txtlv003'];
$lvki_lv0012->lv004=$_POST['txtlv004'];
$lvki_lv0012->lv005=$_POST['txtlv005'];
$lvki_lv0012->lv006=$_POST['txtlv006'];
$lvki_lv0012->lv007=$_POST['txtlv007'];
$lvki_lv0012->lv008=$_POST['txtlv008'];
$lvki_lv0012->lv009=$_POST['txtlv009'];
$lvki_lv0012->lv010=$_POST['txtlv010'];
$lvki_lv0012->lv011=$_POST['txtlv011'];
$lvki_lv0012->lv012=$_POST['txtlv012'];
$lvki_lv0012->lv015=$_POST['txtlv015'];
if($vFlag==1)
{
		
		$vresult=$lvki_lv0012->LV_Insert();
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
function add_person($lv001,$lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv010,$lv011,$lv012)
  {
  global $data;
  
  $data []= array(
  'lv001' => $lv001,
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
			  $lv003="";
			  $index = 1;
			  $cells = $row->getElementsByTagName( 'Cell' );
			  foreach( $cells as $cell )
			  { 
			  $ind = $cell->getAttribute( 'Index' );
			  if ( $ind != null ) $index = $ind;
				if ( $index == 1 ) $lv001 = $cell->nodeValue;
				if ( $index == 2 ) $lv003 = $cell->nodeValue;
				if ( $index == 3 ) $lv004 = $cell->nodeValue;
				if ( $index == 4 ) $lv005 = $cell->nodeValue;
				if ( $index == 5 ) $lv006 = $cell->nodeValue;
				if ( $index == 6 ) $lv007 = $cell->nodeValue;
				if ( $index == 7 ) $lv008 = $cell->nodeValue;
				if ( $index == 8 ) $lv009 = $cell->nodeValue;
				if ( $index == 9 ) $lv010 = $cell->nodeValue;
				if ( $index == 10 ) $lv011 = $cell->nodeValue;
				if ( $index == 11 ) $lv012 = $cell->nodeValue;
			  $index += 1;
		  }
		  if(trim($lv003)!="")
		  {
			//if(is_numeric($lv001))		
			add_person( $lv001,$lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv010,$lv011,$lv012);
		  }
	  }
	  $first_row = false;
	  }
  	}
	$lvtc_lv0013->LV_LoadActiveID();
	$vArrRate=$lvtc_lv0025->LV_LoadArrCalID($lvtc_lv0013->lv001);
	$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
	foreach( $data as $row )
	{
		if(trim($row['lv003'])!="" && $row['lv003']!=NULL)
		{
			$lvhr_lv0020->LV_LoadID($row['lv003']);
			if($lvhr_lv0020->lv001!=NULL && $lvhr_lv0020->lv001!='')
			{
				$vPercen=(float)$vArrRate[$row['lv005']];
				$lvki_lv0012->lv002= $_GET['ID'] ?? '';
				$lvki_lv0012->lv003=$row['lv003'];
				
				if(trim($row['lv004'])=='' || $row['lv004']==NULL)
					$lvki_lv0012->lv004=$vPercen;
				else
					$lvki_lv0012->lv004=$row['lv004'];
				$lvki_lv0012->lv005=$row['lv005'];
				$lvki_lv0012->lv006=$row['lv006'];
				$lvki_lv0012->lv007=$row['lv007'];
				$lvki_lv0012->lv008=$row['lv008'];
				$lvki_lv0012->lv009=$row['lv009'];
				$lvki_lv0012->lv010=$row['lv010'];
				$lvki_lv0012->lv011=$row['lv011'];
				$lvki_lv0012->lv012=$row['lv012'];
				$lvki_lv0012->lv015=$row['lv015'];				
				$vCode=$lvki_lv0012->LV_CheckExistStaff( $_GET['ID'],$row['lv003']);
				if($vCode=="" || $vCode==NULL)
					$vresult=$lvki_lv0012->LV_Insert();
				else
				{
					$lvki_lv0012->lv001=$vCode;
					$vresult=$lvki_lv0012->LV_Update();
					}
				
			}
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
function isnumber(s){
	if(s!=""){
		var str="0123456789"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert("<?php echo $vLangArr[21];?>")	
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
		o.txtlv003.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo  $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[19];?>");
			o.txtlv002.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
function SaveMul()
	{
		var o=document.frmadd;
		o.txtFlag.value=2;
		o.submit();

	}
-->
</script>
<?php
if($lvki_lv0012->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmadd" method="post"  enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" id="table">
							<tr>
							  <td colspan="2" height="100%" align="center"><p>
							    <label>
							      <input type="radio" name="load-enter" value="0" id="load-enter_0" <?php echo ($loadenter==0)?'checked':'';?> onClick="changestate(1)">
							      Nhập từng đánh giá
							    </label>
							    
							    <label>
							      <input type="radio" name="load-enter" value="1" id="load-enter_1" <?php echo ($loadenter==1)?'checked':'';?> onClick="changestate(2)">
							     Nạp đánh giá từ tập tin
							    </label>
							    <br>
						      </p></td>
						  </tr>
                         </table>
						  <!---Load File-->                         
                         <div id="fileload" style="display:none">
                         <table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[31];?></td>
								<td width="*%"  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="mau_danh_gia.zip" title="<?php echo $vLangArr[33];?>"><?php echo 'Tải mẫu';?></a></td>
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
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="*%"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvki_lv0012->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvki_lv0012->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
				  <td  height="20px">
				  <table width="80%">
					<tr><td width="50%"><select  name="txtlv003"  id="txtlv003"  tabindex="7" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"/><?php echo $lvki_lv0012->LV_LinkField('lv003',$lvki_lv0012->lv003);?>
							</select></td>
				  <td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							     <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','hr_lv0020','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv003','hr_lv0020','concat(lv002,@! @!,lv001)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>							 </td>
							  </tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[29];?></td>
							  <td  height="20px"><input name="txtlv015" type="text" id="txtlv015" value="<?php echo (float)$lvki_lv0012->lv015;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>						  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input name="txtlv004" type="text" id="txtlv004" value="<?php echo (float)$lvki_lv0012->lv004;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvki_lv0012->lv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvki_lv0012->lv006;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvki_lv0012->lv007;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
							  <td  height="20px"><input name="txtlv008" type="text" id="txtlv008" value="<?php echo $lvki_lv0012->lv008;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[23];?></td>
							  <td  height="20px"><input name="txtlv009" type="text" id="txtlv009" value="<?php echo $lvki_lv0012->lv009;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[24];?></td>
							  <td  height="20px"><input name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvki_lv0012->lv010;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[25];?></td>
							  <td  height="20px"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvki_lv0012->lv011;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[26];?></td>
							  <td  height="20px"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo $lvki_lv0012->lv012;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
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
					</form>	

				
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmadd;
		o.txtlv003.focus();
</script>
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
	include("../permit.php");
}
?>
</body>
</html>