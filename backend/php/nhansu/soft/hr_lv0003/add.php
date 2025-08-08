<?php
session_start();
//require_once("../../clsall/hr_lv0003.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0003.php");
//////////////init object////////////////
$lvhr_lv0003=new hr_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0036');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0087.txt",$plang);

$curPage = (int)($_POST['curPg'] ?? 1);
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0003->lv001=InsertWithCheckExt('hr_lv0003', 'lv001', 'CYP',3);
$lvhr_lv0003->lv002=recoverdate($_POST['txtlv002'],$plang);
$lvhr_lv0003->lv003=recoverdate($_POST['txtlv003'],$plang);
$lvhr_lv0003->lv004=$_POST['txtlv004'];
if($vFlag==1)
{
		
		$vresult=$lvhr_lv0003->LV_Insert();
		if($vresult==true) {
			$vStrMessage=$vLangArr[12];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[13].sof_error();		
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
</head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789.()"
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
		o.txtlv004.value="";v
		o.txtlv002.focus();
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
			alert("<?php echo $vLangArr[14];?>");		
			o.txtlv001.focus();
		}
		else if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[19];?>");		
			o.txtlv002.focus();
		}
		else if(o.txtlv003.value=="")
		{
			alert("<?php echo $vLangArr[19];?>");		
			o.txtlv003.focus();
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
if($lvhr_lv0003->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmadd" method="post">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvhr_lv0003->lv001;?>" tabindex="5" maxlength="6" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input type="text" name="txtlv002" id="txtlv002" style="width:140px; background-color:#EBF8FE" tabindex="6" value="" onDblClick="Clear(document.frmadd.txtlv002);"  onKeyPress="return CheckKey(event,7)" />
                                <img src="../<?php echo $vDir;?>images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
										border="0" style="cursor:pointer" width="16"  align="texttop" 
										onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv002);return false;"  tabindex="6" /></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><input type="text" name="txtlv003" id="txtlv003" style="width:140px; background-color:#EBF8FE" tabindex="7" value=""  onDblClick="Clear(document.frmadd.txtlv003);" onKeyPress="return CheckKey(event,7)"/>
                                <img src="../<?php echo $vDir;?>images/calendar/calendar.gif" name="imgDate2" id="imgDate2" 
										border="0" style="cursor:pointer" width="16"  align="texttop" 
										onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv003);return false;" tabindex="7" /></td>
							</tr>
<tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
				  <td  height="20px"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0003->lv004;?>" tabindex="8" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>							 
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
					  <input type="hidden" name="txtFlag" value="0">
					</form>	
<?php $lvhr_lv0003->lv002=($lvhr_lv0003->lv002!="")?formatdate($lvhr_lv0003->lv002, $plang):"";
$lvhr_lv0003->lv003=($lvhr_lv0003->lv003!="")?formatdate($lvhr_lv0003->lv003, $plang):"";
 ?>
			<script language="javascript">
			<!--
				var o = document.frmchoose;
				o.txtlv001.value = "<?php echo $lvhr_lv0003->lv001; ?>";
				o.txtlv002.value = "<?php echo $lvhr_lv0003->lv002; ?>";
				o.txtlv003.value = "<?php echo $lvhr_lv0003->lv003; ?>";
				o.txtlv004.value = "<?php echo $lvhr_lv0003->lv004; ?>";
				o.txtlv002.focus();
			//-->
			</script>
				
  </div>
</div>
<script language="javascript">
	var o=document.frmadd;
		o.txtlv001.focus();
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
	include("../ hr_lv0003/permit.php");
}
?>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
</html>