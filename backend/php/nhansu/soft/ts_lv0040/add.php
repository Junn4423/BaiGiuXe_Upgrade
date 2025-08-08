<?php
session_start();
//require_once("../../clsall/ts_lv0040.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0040.php");
require_once("../../clsall/sl_lv0007.php");
//////////////init object////////////////
$lvts_lv0040=new ts_lv0040($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0037');
$lvsl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0013.txt",$plang);
$mots_lv0040->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$data = array();
  
  function add_person( $lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv014,$lv015)
  {
  global $data;
  
  $data []= array(
  'lv003' => $lv003,
  'lv004' => $lv004,
  'lv005' => $lv005,
  'lv006' => $lv006,
  'lv007' => $lv007,
  'lv008' => $lv008,
  'lv009' => $lv009,
  'lv014' => $lv014,
  'lv015' => $lv015,
  );
  }
if($vFlag==1)
{
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
  
			  if ( $index == 1 ) $lv003 = $cell->nodeValue;
			  if ( $index == 2 ) $lv004 = $cell->nodeValue;
			  if ( $index == 3 ) $lv005 = $cell->nodeValue;
			  if ( $index == 4 ) $lv006 = $cell->nodeValue;
			  if ( $index == 5 ) $lv007 = $cell->nodeValue;
			  if ( $index == 6 ) $lv008 = $cell->nodeValue;
			  if ( $index == 7 ) $lv009 = $cell->nodeValue;
			  if ( $index == 8 ) $lv014 = $cell->nodeValue;
			  if ( $index == 9 ) $lv015 = $cell->nodeValue;
			  
			  $index += 1;
		  }
	  	add_person( $lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv014,$lv015);
	  }
	  $first_row = false;
	  }
  }
foreach( $data as $row )
{
	$lvsl_lv0007->LV_LoadID($row['lv003']);
	if($lvsl_lv0007->lv001==$row['lv003'])
	{
	$lvts_lv0040->lv001=InsertWithCheckExt('ts_lv0040', 'lv001', '',1);
	$lvts_lv0040->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$lvts_lv0040->lv003=$lvsl_lv0007->lv001;
	$lvts_lv0040->lv004=$row['lv004'];
	$lvts_lv0040->lv005=$row['lv005'];
	$lvts_lv0040->lv006=$row['lv006'];
	$lvts_lv0040->lv007=$row['lv007'];
	$lvts_lv0040->lv008=$row['lv008'];
	$lvts_lv0040->lv009=$row['lv009'];
	$lvts_lv0040->lv014=$row['lv014'];
	$lvts_lv0040->lv015=$row['lv015'];
	$lvts_lv0040->lv016=$lvNow;
	
	$vresult=$lvts_lv0040->LV_Insert();
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
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv008.value="";
		o.txtlv009.value="";
		o.txtlv010.value="";
		o.txtlv011.value="";
	//	o.txtlv012.value="";
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
		//o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
	
				o.txtFlag.value="1";
				o.submit();
		
	}
-->
</script>
<?php
if($lvts_lv0040->GetAdd()>0)
{
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"   name="frmadd" id="frmadd"  method="post" enctype="multipart/form-data" >
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[34];?></td>
								<td  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  />
							  <a href="MAU_NHAP_KHO_TEMPLATE.zip" title="<?php echo $vLangArr[36];?>"><?php echo $vLangArr[35];?></a></td>
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

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
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
	include("../permit.php");
}
?>
</body>
</html>