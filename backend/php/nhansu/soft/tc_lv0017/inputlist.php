<?php
session_start();
//require_once("../../clsall/tc_lv0017.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0017.php");
require_once("../../clsall/tc_lv0013.php");
require_once("../../clsall/hr_lv0020.php");
//////////////init object////////////////
$lvtc_lv0017=new tc_lv0017($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0017');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
if($motc_lv0013->GetApr()==1 && $motc_lv0013->GetUnApr()==1)
{
	if(isset($_POST['txtCalID']))
	{
		$motc_lv0013->LV_SetCal($_POST['txtCalID']);
	}
	$motc_lv0013->LV_GetCal();
	if($motc_lv0013->lv999!='' || $motc_lv0013->lv999!=NULL)
	{
		$motc_lv0013->LV_LoadID($motc_lv0013->lv999);
	}
	else
		$motc_lv0013->LV_LoadActiveID();
?>
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				
	 <form name="frmcalculate" method="post">
	<?php 
	
		  $vTitle=''; 
		  if($plang=="EN")
			{	

					echo 'OPTION PARAMETER TO CACULATE ';
			}
		   else
		   {
				echo 'CHỌN THÔNG SỐ TÍNH LƯƠNG';
		   }
		   ?>
		   <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>"/>
		    <select name="txtCalID">
		    	<option value=""></option>
				<?php echo $motc_lv0013->LV_LinkField('lv999',$motc_lv0013->lv999);?>
			</select>
		  	<input type="submit" value="Chọn ngay" onclick="document.frmcalculate.submit()"/>
		  	</form>
		  	</div>
		  	
		</td>
		</tr>
		</tbody>
		</table>	
<?php
}
else
	$motc_lv0013->LV_LoadActiveID();
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0055.txt",$plang);

$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$data = array();
  
  function add_person( $lv002, $lv004, $lv005, $lv006, $lv007 )
  {
  global $data;
  
  $data []= array(
  'lv002' => $lv002,
  'lv004' => $lv004,
  'lv005' => $lv005,
  'lv006' => $lv006,
  'lv007' => $lv007
  );
  }
if($vFlag==1)
{
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
			  $lv002="";
			  $lv004="";
			  $lv005="";
			  $lv006="";
			  $lv007="";
			  $index = 1;
			  $cells = $row->getElementsByTagName( 'Cell' );
			  foreach( $cells as $cell )
			  { 
			  $ind = $cell->getAttribute( 'Index' );
			  if ( $ind != null ) $index = $ind;
  
			  if ( $index == 1 ) $lv002 = $cell->nodeValue;
			  if ( $index == 2 ) $lv004 = $cell->nodeValue;
			  if ( $index == 3 ) $lv005 = str_replace(",","",str_replace(".","",$cell->nodeValue));
			  if ( $index == 4 ) $lv006 = $cell->nodeValue;
			  if ( $index == 5 ) $lv007 = $cell->nodeValue;
			  
			  $index += 1;
		  }
	  	add_person( $lv002, $lv004, $lv005,$lv006,$lv007);
	  }
	  $first_row = false;
	  }
  }
foreach( $data as $row )
{
	$mohr_lv0020->LV_LoadID($row['lv002']);
	if($mohr_lv0020->lv001==$row['lv002'] && $mohr_lv0020->lv001!="")
	{
	$lvtc_lv0017->lv001=InsertWithCheckExt('tc_lv0017', 'lv001', '',1);
	$lvtc_lv0017->lv003=$motc_lv0013->lv001;
	$lvtc_lv0017->lv002=$row['lv002'];
	$lvtc_lv0017->lv004=$row['lv004'];
	$lvtc_lv0017->lv005=$row['lv005'];
	$lvtc_lv0017->lv006=$row['lv006'];
	$lvtc_lv0017->lv007=$row['lv007'];
	$lvtc_lv0017->lv008='0';
	$lvtc_lv0017->lv009=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$vresult=$lvtc_lv0017->LV_Insert();
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
		//o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0)?>";
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
if($lvtc_lv0017->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmadd" method="post" enctype="multipart/form-data" >
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr>
							  <td colspan="2" height="100%" align="center"><?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?></td>
						  </tr>
							<tr>
								<td colspan="2" height="100%" align="center">
                                </td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[23];?></td>
								<td width="*%"  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /><a href="MAU_CHI_PHI_CONG_TAC.zip" title="<?php echo $vLangArr[25];?>"><?php echo $vLangArr[24];?></a></td>
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