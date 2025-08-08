<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/ts_lv0050.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ts_lv0050.php");
//////////////init object////////////////
$lvts_lv0050=new ts_lv0050($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0050');
/////////Get ID///////////////
$lvts_lv0050->lv001= $_GET['ID'] ?? '';
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TS0060.txt",$plang);

$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$vStrMessage="";


if($vFlag==1)
{
		$lvts_lv0050->lv002=$_POST['txtlv002'];	
		$lvts_lv0050->lv003=$_POST['txtlv003'];	
		$vresult=$lvts_lv0050->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();
			$vFlag=0;
		}

}

$lvts_lv0050->LV_LoadID($lvts_lv0050->lv001);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
</head>
<script language="javascript">

	function Refresh()
	{
		var o=document.frmedit;
		o.txtlv002.value="<?php echo $lvts_lv0050->lv002;?>";
		o.txtlv002.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
		function Save()
	{
		var o=document.frmedit;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[18];?>");
			o.txtlv001.focus();
		}
		else if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[19];?>");
			o.txtlv002.focus();
		}
		else
		{
		o.txtFlag.value="1";
		o.submit();
		}
			
	}
</script>
<?php
if($lvts_lv0050->GetEdit()>0)
{
?>
<body >
<div id="content_child">
    <h2 id="pageName"><?php echo $vLangArr[15];?></h2>
  <div class="story">
    <h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f1f1f1">
			<tr>
				<td width="13">
					<img name="table_r1_c1" src="../images/pictures/table_r1_c1.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="*" background="../images/pictures/table_r1_c2.gif">
					</td>
				<td width="13">
					<img name="table_r1_c3" src="../images/pictures/table_r1_c3.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="11">
					</td>
			</tr>
			<tr>
				<td background="../images/pictures/table_r2_c1.gif">
					</td>
				<td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form name="frmedit" id="frmedit" action="#" method="post">
					<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="610" border="0" align="center" id="table1">
							<tr><td colspan="2" align="center">
					<?php		
						echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
						?>
							</td></tr>
							<tr>
								<td width="112"  height="20px"><?php echo $vLangArr[15];?></td>
							  <td width="335"  height="20px"><input  name="txtlv001" type="text" id="txtlv001" readonly="true" value="<?php echo $lvts_lv0050->lv001;?>" /></td>
							</tr>
						<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input  name="txtlv002" type="text" id="txtlv002" value="<?php echo $lvts_lv0050->lv002;?>" tabindex="6" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><input type="text" name="txtlv003" id="txtlv003" tabindex="7" style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvts_lv0050->lv003;?>"/>
							  </td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"> <TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="8"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /><?php echo $vLangArr[2];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="9"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="10"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove><?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					  <input type="hidden" name="txtFlag" value="0">
					</form>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<script language="javascript">
						var o =document.frmedit;
						o.txtlv002.value="<?php echo $lvts_lv0050->lv002;?>";	
					  </script>
<script language="javascript"> /*var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);*/
		o.txtlv002.focus();
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