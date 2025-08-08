<?php
session_start();
//require_once("../../clsall/hr_lv0026.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0026.php");
require_once("../../clsall/hr_lv0020.php");
//////////////init object////////////////
$lvhr_lv0026=new hr_lv0026($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0047');
$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0047');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0105.txt",$plang);

$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0026->lv001=InsertWithCheckExt('hr_lv0026', 'lv001', '',1);
$lvhr_lv0026->lv002= $_POST['txtlv002'] ?? '';
$lvhr_lv0026->lv003=$_POST['txtlv003'] ?? '';
$lvhr_lv0026->lv004=$_POST['txtlv004'] ?? '';
$lvhr_lv0026->lv005=$_POST['txtlv005'] ?? '';
$lvhr_lv0026->lv006=$_POST['txtlv006'] ?? '';
$lvhr_lv0026->lv007=$_POST['txtlv007'] ?? '';
$lvhr_lv0026->lv008=$_POST['txtlv008'] ?? '';
$lvhr_lv0026->lv009=$_POST['txtlv009'] ?? '';	
$lvhr_lv0026->lv010=$_POST['txtlv010'] ?? '';	
$lvhr_lv0026->lv012=$_POST['txtlv012'] ?? '';	
$lvhr_lv0026->lv013=$_POST['txtlv013'] ?? '';	
$lvhr_lv0026->lv100=$_POST['txtlv100'] ?? '';
//$lvhr_lv0026->lv011=(($_POST['txtlv011']=="" || $_POST['txtlv011']==NULL)?'1':$_POST['txtlv011']);	
$lvhr_lv0026->lv011 = (!isset($_POST['txtlv011']) || $_POST['txtlv011'] == "") ? '1' : $_POST['txtlv011'];
if($vFlag==1)
{
		
		$vresult=$lvhr_lv0026->LV_Insert();
		if($vresult==true) {
			$vStrMessage=$vLangArr[12];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[13].sof_error();		
			$vFlag = 0;
		}
}
else if($vFlag==2)
{
	$data = array();
function add_person( $lv002,$lv003,$lv004,$lv005,$lv006,$lv007,$lv008,$lv009,$lv010,$lv011,$lv012,$lv013)
  {
  global $data;
  
  $data []= array(
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
  'lv013' => $lv013
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

				if ( $index == 2 ) $lv002 = $cell->nodeValue;
				if ( $index == 3 ) $lv003 = $cell->nodeValue;
				if ( $index == 4 ) $lv004 = $cell->nodeValue;
				if ( $index == 5 ) $lv005 = $cell->nodeValue;
				if ( $index == 6 ) $lv006 = $cell->nodeValue;
				if ( $index == 7 ) $lv007 = $cell->nodeValue;
				if ( $index == 8 ) $lv008 = $cell->nodeValue;
				if ( $index == 9 ) $lv009 = $cell->nodeValue;
				if ( $index == 10) $lv010 = $cell->nodeValue;
				if ( $index == 11) $lv011 = $cell->nodeValue;
				if ( $index == 12) $lv012 = $cell->nodeValue;
				if ( $index == 13) $lv013 = $cell->nodeValue;
				if ( $index == 14) $lv100 = $cell->nodeValue;
			  
			  
			  $index += 1;
		  }
	  	add_person( $lv002,$lv003,$lv004,$lv005,$lv006,$lv007,$lv008,$lv009,$lv010,$lv011,$lv012,$lv013);
	  }
	  $first_row = false;
	  }
  	}
	$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
	foreach( $data as $row )
	{
		if(trim($row['lv002'])!="" && $row['lv002']!=NULL)
		{
			$lvhr_lv0020->LV_LoadID(trim($row['lv002']));
			if($lvhr_lv0020->lv001!=NULL && $lvhr_lv0020->lv001!='')
			{
				$lvhr_lv0026->lv002=$row['lv002'];
				$lvhr_lv0026->lv003=$row['lv003'];
				$lvhr_lv0026->lv004=$row['lv004'];
				$lvhr_lv0026->lv005=$row['lv005'];
				$lvhr_lv0026->lv006=$row['lv006'];
				$lvhr_lv0026->lv007=$row['lv007'];
				$lvhr_lv0026->lv008=$row['lv008'];
				$lvhr_lv0026->lv009=$row['lv009'];
				$lvhr_lv0026->lv010=$row['lv010'];
				$lvhr_lv0026->lv011=$row['lv011'];
				$lvhr_lv0026->lv012=$row['lv012'];
				$lvhr_lv0026->lv013=$row['lv013'];
				$vresult=$lvhr_lv0026->LV_InsertAuto();
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
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
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
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv008.value="0";
		o.txtlv009.value="";
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
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[25];?>");
			o.txtlv001.select();
		}
		else if(o.txtlv003.value==""){
			alert("<?php echo $vLangArr[26];?>");
			o.txtlv003.focus();
			}
		else if(o.txtlv005.value==""){
			alert("<?php echo $vLangArr[27];?>");
			o.txtlv005.select();
			}	
		
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	function LoadSource(value)
	{
		if(value!="")
		{
			var o=document.frmadd;
			ajax_do ('../hr_lv0026/hr_lv0026excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&EmpID='+value,1);
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
if($lvhr_lv0026->GetAdd()>0)
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
							     <input type="radio" name="load-enter" value="0" id="load-enter_0" 
									<?php echo (($loadenter ?? 0) == 0) ? 'checked' : ''; ?> 
									onClick="changestate(1)">
							      Nhập từng người phụ thuộc
							    </label>
							    
							    <label>
							     <input type="radio" name="load-enter" value="1" id="load-enter_1"
									<?php echo (isset($loadenter) && $loadenter == 1) ? 'checked' : ''; ?>
									onClick="changestate(2)">
							     Nạp người phụ thuộc từ tập tin
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
								<td width="166"  height="20px"><?php echo 'Chọn file *.xml';?></td>
								<td width="*%"  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="mau_phu_thuoc.zip" title="<?php echo $vLangArr[33];?>"><?php echo 'Tải mẫu';?></a></td>
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
					<form action="#" name="frmadd" method="post">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
								
								$vStrMessage = $vStrMessage ?? ''; 
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="*%"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvhr_lv0026->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							 
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0026->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[32];?></td>
				  				<td  height="20px">
									<table style="width:80%"><tr><td style="width:50%">
									<select  name="txtlv100"  id="txtlv100"  tabindex="6" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" onblur="LoadSource(this.value)">
										<option value=""></option><?php echo $lvhr_lv0026->LV_LinkField('lv100',$lvhr_lv0026->lv100);?>
				  					</select>	
									</td>
							  <td>
								<ul id="pop-nav" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
									<input type="text" autocomplete="off" class="search_img_btn" name="txtlv100_search" id="txtlv100_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv100','hr_lv0020','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv100','hr_lv0020','concat(lv002,@! @!,lv001)')" tabindex="200" >
									<div id="lv_popup" lang="lv_popup6"> </div>						  
									</li>
								</ul></td></tr></table>
				  				</td>
								
							  </tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $lvhr_lv0026->lv003;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
				  <td  height="20px"><select  name="txtlv004"  id="txtlv004"  tabindex="8" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
				  
							  <?php echo $lvhr_lv0026->LV_LinkField('lv004',$lvhr_lv0026->lv004);?>
							  </select>	</td>
							  </tr>							  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvhr_lv0026->FormatView($lvhr_lv0026->lv005,2);?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv005);return false;" /></span></td>
							  </tr>
								<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvhr_lv0026->lv006;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>		
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvhr_lv0026->lv007;?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
							  <td  height="20px"><input name="txtlv008" type="text" id="txtlv008" value="<?php echo (float)$lvhr_lv0026->lv008;?>" tabindex="11" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"><select  name="txtlv010"  id="txtlv010" tabindex="11" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/><?php echo $lvhr_lv0026->LV_LinkField('lv010',$lvhr_lv0026->lv010);?></select></td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[23];?></td>
							  <td  height="20px"><input name="txtlv009" type="text" id="txtlv009" value="<?php echo $lvhr_lv0026->lv009;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							 <tr>
							  <td  height="20px"><?php echo $vLangArr[28];?></td>
							  <td  height="20px"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo (int)$lvhr_lv0026->lv011;?>" tabindex="13" maxlength="1" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[29];?></td>
							  <td  height="20px"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo (int)$lvhr_lv0026->lv012;?>" tabindex="13" maxlength="1" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>							  
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[30];?></td>
							  <td  height="20px"><input name="txtlv013" type="text" id="txtlv013" value="<?php echo $lvhr_lv0026->FormatView($lvhr_lv0026->lv013,2);?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv013);return false;" /></span></td>
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
					</form>	
					</div>

				
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
</script>	
<script language="javascript">
	var o=document.frmadd;
		o.txtlv003.focus();
</script>
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