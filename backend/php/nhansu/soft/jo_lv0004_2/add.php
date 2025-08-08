<?php
session_start();
$vDir="../";
//require_once("../../clsall/jo_lv0004.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/jo_lv0004.php");
require_once("../../clsall/jo_lv0016.php");
require_once("../../clsall/hr_lv0020.php");
//////////////init object////////////////
$lvjo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$lvjo_lv0016=new jo_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0016');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvjo_lv0016->LV_Load();
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","JO0006.txt",$plang);
$mojo_lv0004->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvjo_lv0004->lv001=$_POST['txtlv001'];
$lvjo_lv0004->lv002=$_POST['txtlv002'];
if($lvjo_lv0004->lv002=="" || $lvjo_lv0004->lv002==NULL) $lvjo_lv0004->lv002='Đơn xin nghỉ phép';
$lvjo_lv0004->lv003=$_POST['txtlv003'];

$lvjo_lv0004->lv006=$_POST['txtlv006'];
$lvjo_lv0004->lv007=$_POST['txtlv007'];
$lvjo_lv0004->lv008=$_POST['txtlv008'];
$lvjo_lv0004->lv009=$_POST['txtlv009'];
$lvjo_lv0004->lv010=$_POST['txtlv010'];
$lvjo_lv0004->lv011=$_POST['txtlv011'];
$lvjo_lv0004->lv012=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$lvjo_lv0004->lv013=$_POST['txtlv013'];
$lvjo_lv0004->lv014=$_POST['txtlv014'];
$lvjo_lv0004->lv015=$_POST['txtlv015'];
if($lvjo_lv0004->lv015=="" || $lvjo_lv0004->lv015==NULL) $lvjo_lv0004->lv015=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$lvjo_lv0004->lv016=$_POST['txtlv016'].' '.$_POST['txtlv016_'];
if(trim($lvjo_lv0004->lv016)=="" || $lvjo_lv0004->lv016==NULL) $lvjo_lv0004->lv016=ADDDATE(GetServerDate(),1).' 07:30:00';
$lvjo_lv0004->lv017=$_POST['txtlv017'].' '.$_POST['txtlv017_'];
if(trim($lvjo_lv0004->lv017)=="" || $lvjo_lv0004->lv017==NULL) $lvjo_lv0004->lv017=ADDDATE(GetServerDate(),1).' 17:00:00';
$lvjo_lv0004->lv018=$_POST['txtlv018'];
$lvjo_lv0004->lv019=$_POST['txtlv019'];
$lvjo_lv0004->lv020=$_POST['txtlv020'];
$lvjo_lv0004->lv021=$_POST['txtlv021'];
$lvjo_lv0004->lv022=$_POST['txtlv022'];
$lvjo_lv0004->lv023=GetServerDate().' '.GetServerTime();
if($vFlag==1)
{
		$lvjo_lv0004->lv014=$lvjo_lv0016->lv003;
		if($lvjo_lv0004->lv014=="")
			$lvjo_lv0004->lv014=$lvjo_lv0016->lv004;
		else
			$lvjo_lv0004->lv014=$lvjo_lv0004->lv014.";".$lvjo_lv0016->lv004;
		$lvjo_lv0004->lv004=0;
		$lvjo_lv0004->lv006=0;
		if($lvjo_lv0004->lv014=="")
		{
			$vStrMessage="Không lưu được,Do mã người duyệt chưa được cấu hình.";
		}
		else
		{
		$vresult=$lvjo_lv0004->LV_Insert_NoID();
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
		}
}
else if($vFlag==2)
{
		$data=null;
		$data = array();
  
  function add_person( $lv001,$lv002,$lv003, $lv004,$lv005,$lv006,$lv007,$lv008,$lv022,$lv019)
  {
  global $data;
  
  $data []= array(
  'lv001' => $lv001,
  'lv002' => $lv002,
  'lv003' => $lv003,
  'lv004' => $lv004,
  'lv004' => $lv004,
  'lv005' => $lv005,
  'lv006' => $lv006,
  'lv007' => $lv007,
  'lv008' => $lv008,
  'lv022' => $lv022,
  'lv019' => $lv019
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
			  $lv001='';
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
			  if ( $index == 9 ) $lv022 = $cell->nodeValue;
			  if ( $index == 10 ) $lv019 = $cell->nodeValue;
			  $index += 1;
		  }
	  	add_person( $lv001, $lv002, $lv003, $lv004, $lv005, $lv006,$lv007,$lv008,$lv022,$lv019);
	  }
	  $first_row = false;
	  }
  	}
	foreach( $data as $row )
	{
		if(trim($row['lv001'])!="" && $row['lv001']!=NULL)
		{
			$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
			$lvhr_lv0020->LV_LoadID($row['lv001']);
			if($lvhr_lv0020->lv001!="" && $lvhr_lv0020->lv001!=NULL)
			{
			$lvjo_lv0004->lv003=$row['lv003'];
			$lvjo_lv0004->lv002=$row['lv004'];
			$lvjo_lv0004->lv015=$row['lv001'];
			$lvjo_lv0004->lv016=$row['lv005'].' '.$row['lv006'];
			$lvjo_lv0004->lv017=$row['lv007'].' '.$row['lv008'];			
			$lvjo_lv0004->lv018=$row['lv018'];
			$lvjo_lv0004->lv019=$row['lv019'];
			echo $lvjo_lv0004->lv022=$row['lv022'];
			$vresult=$lvjo_lv0004->LV_Insert_NoID();
			if($vresult && $lv007==1)
			{
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
		o.txtlv018.value="";
		o.txtlv019.value="";
		o.txtlv020.value="";
		o.txtlv021.value="";
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
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[38];?>");
			o.txtlv001.select();
		}
		else if(o.txtlv015.value==""){
			alert("Người nghỉ phép không rỗng!");
			o.txtlv015.focus();
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
if($lvjo_lv0004->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
    <h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f1f1f1">
			<tr>
				<td width="13">
					<img name="table_r1_c1" src="../images/pictures/table_r1_c1.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="*" background="../images/pictures/table_r1_c2.gif">
					<img name="table_r1_c2" src="../images/pictures/spacer.gif" 
						width="1" height="1" border="0" alt=""></td>
				<td width="13">
					<img name="table_r1_c3" src="../images/pictures/table_r1_c3.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="11">
					<img src="../images/pictures/spacer.gif" 
						width="1" height="12" border="0" alt=""></td>
			</tr>
			<tr>
				<td background="../images/pictures/table_r2_c1.gif">
					<img name="table_r2_c1" src="../images/pictures/spacer.gif" 
						width="1" height="1" border="0" alt=""></td>
				<td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmadd" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag"  />
						<table width="100%" border="0" align="center" id="table">
							<tr>
							  <td colspan="2" height="100%" align="center"><p>
							    <label>
							      <input type="radio" name="load-enter" value="0" id="load-enter_0" <?php echo ($loadenter==0)?'checked':'';?> onClick="changestate(1)">
							      Nhập từng đơn xin phép
							    </label>
							    
							    <label>
							      <input type="radio" name="load-enter" value="1" id="load-enter_1" <?php echo ($loadenter==1)?'checked':'';?> onClick="changestate(2)">
							     Nạp danh sách đơn xin phép từ tập tin
							    </label>
							    <br>
						      </p></td>
						  </tr>
                         </table>
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
								<td width="166"  height="20px"><?php echo 'Chọn tập tin import';?></td>
								<td width="*%"  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="don-xin-phep.zip" title="<?php echo $vLangArr[33];?>"><?php echo 'Download mẫu';?></a></td>
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
								<td width="196"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="*%"  height="20">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvjo_lv0004->lv001=="")?InsertWithCheck('jo_lv0004', 'lv001', '',1):$lvjo_lv0004->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><table width="80%"><tr><td width="50%"><select name="txtlv003" id="txtlv003"   tabindex="5"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvjo_lv0004->LV_LinkField('lv003',$lvjo_lv0004->lv003);?>
							  </select>
							  </td>
							  <td  width="50%">
							  <ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" onFocus="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><table width="80%"><tr><td width="50%"><select name="txtlv002" id="txtlv002"   tabindex="5"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvjo_lv0004->LV_LinkField('lv002',$lvjo_lv0004->lv002);?>
							  </select>
							  </td>
							  <td  width="50%">
							  <ul id="pop-nav77" lang="pop-nav77" onkeyup="ChangeName(this,77)" onMouseOver="ChangeName(this,77)" onkeyup="ChangeName(this,77)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv002_search" id="txtlv002_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" onFocus="LoadPopup(this,'txtlv003','jo_lv0002','lv002')" tabindex="200" >
							    <div id="lv_popup77" lang="lv_popup77"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>							
							<tr>
							  <td  height="20"><?php echo $vLangArr[36];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
								<select name="txtlv022" id="txtlv022"   tabindex="5"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
										<?php echo $lvjo_lv0004->LV_LinkField('lv022',$lvjo_lv0004->lv022);?>
									</select>
							  </td><td>
							  <ul id="pop-nav66" lang="pop-nav66" onkeyup="ChangeName(this,66)" onMouseOver="ChangeName(this,66)" onkeyup="ChangeName(this,66)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv015_search" id="txtlv015_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv022','jo_lv0100','lv002')" onFocus="LoadPopup(this,'txtlv022','jo_lv0100','lv002')" tabindex="200" >
							    <div id="lv_popup66" lang="lv_popup66"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><textarea rows="5" name="txtlv008" id="txtlv008"   tabindex="7"  style="width:80%"><?php echo $lvjo_lv0004->lv008;?></textarea></td>
						    </tr>
						    <tr>
								<td width="196"  height="20"><?php echo $vLangArr[27];?></td>
								<td   height="20">
								<table width="80%"><tr><td width="50%">
									<select name="txtlv013" id="txtlv013"   tabindex="8"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
										<option value=""></option>
										<?php echo $lvjo_lv0004->LV_LinkField('lv013',$lvjo_lv0004->lv013);?>
									</select>
								</td><td>
							  <ul id="pop-nav4" lang="pop-nav4" onkeyup="ChangeName(this,4)" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv013_search" id="txtlv013_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv013','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv013','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
								<select name="txtlv015" id="txtlv015"   tabindex="9"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
										<?php echo $lvjo_lv0004->LV_LinkField('lv015',$lvjo_lv0004->lv015);?>
									</select>
							  </td><td>
							  <ul id="pop-nav6" lang="pop-nav6" onkeyup="ChangeName(this,6)" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv015_search" id="txtlv015_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv015','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv015','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[30];?></td>
				  <td  height="20"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv016);return false;"   name="txtlv016" type="text" id="txtlv016" value="<?php echo $lvjo_lv0004->FormatView($lvjo_lv0004->lv016,2);?>" tabindex="20" maxlength="255" style="width:40%"/><input   name="txtlv016_" type="text" id="txtlv016_" value="<?php echo substr($lvjo_lv0004->lv016,11,8);?>" tabindex="20" maxlength="255" style="width:40%" onKeyPress="return CheckKey(event,7)"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv016);return false;" /></span></td>
						  </tr>		
                          <tr>
							  <td  height="20"><?php echo $vLangArr[31];?></td>
							  <td  height="20"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv017);return false;"  name="txtlv017" type="text" id="txtlv017" value="<?php echo trim($lvjo_lv0004->FormatView($lvjo_lv0004->lv017,2));?>" tabindex="21" maxlength="50" style="width:40%" onKeyPress="return CheckKey(event,7)"><input   name="txtlv017_" type="text" id="txtlv017_" value="<?php echo substr($lvjo_lv0004->lv017,11,8);?>" tabindex="20" maxlength="255" style="width:40%" onKeyPress="return CheckKey(event,7)"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv017);return false;" /></span></td>
							  </tr>		
						<tr>
								<td width="196"  height="20"><?php echo $vLangArr[32];?></td>
								<td   height="20">
									<input name="txtlv018" id="txtlv018"   tabindex="22"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo trim($lvjo_lv0004->FormatView($lvjo_lv0004->lv018,4));?>" onfocus="if(document.frmadd.txtlv018.value=='') document.frmadd.txtlv018.value=document.frmadd.txtlv016.value+' '+document.frmadd.txtlv016_.value;"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv018);return false;" /></span></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[33];?></td>
							  <td  height="20"><input name="txtlv019" id="txtlv019" style="width:80%" tabindex="23" onKeyPress="return CheckKey(event,7)" value="<?php echo trim($lvjo_lv0004->FormatView($lvjo_lv0004->lv019,4));?>" onfocus="if(document.frmadd.txtlv019.value=='') document.frmadd.txtlv019.value=document.frmadd.txtlv017.value+' '+document.frmadd.txtlv017_.value;"/><span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv019);return false;" /></span></td>
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
<!---End Enter New Line-->          
					</form>	

	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmadd;
		o.txtlv008.focus();
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
	function SaveMul()
	{
		var o=document.frmadd;
		
				o.txtFlag.value=2;
				o.submit();

	}
	changestate(<?php echo (int)$loadenter+1;?>)
	var o=document.frmadd;
		o.txtlv099.focus();
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