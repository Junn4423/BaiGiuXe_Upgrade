<?php
session_start();
//require_once("../../clsall/da_lh0003.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/da_lh0003.php");
//////////////init object////////////////
$lvda_lh0003=new da_lh0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Da0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","CR0279.txt",$plang);

$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvda_lh0003->lv001=InsertWithCheckExt('da_lh0003', 'lv001', '',0);
if($_GET['ChildID']=="")
$lvda_lh0003->lv002=$_POST['qxtlv002'];
else
$lvda_lh0003->lv002=$_GET['ChildID'];
$lvda_lh0003->lv003=$_POST['qxtlv003'];
$lvda_lh0003->lv004=$_POST['qxtlv004'];
$lvda_lh0003->lv005=$_POST['qxtlv005'];
$lvda_lh0003->lv006=$_POST['qxtlv006'];
$lvda_lh0003->lv007=$_POST['qxtlv007'];
$lvda_lh0003->lv008=$_POST['qxtlv008'];
$lvda_lh0003->lv011=$_POST['qxtlv011'];
$lvda_lh0003->lv012=$_POST['qxtlv012'];
$lvda_lh0003->lv013=$_POST['qxtlv013'];
$lvda_lh0003->lv014=$_POST['qxtlv014'];
$lvda_lh0003->lv015=$_POST['qxtlv015'];
$lvda_lh0003->lv016=$_POST['qxtlv016'];
$lvda_lh0003->lv017=$_POST['qxtlv017'];
$lvda_lh0003->lv018=$_POST['qxtlv018'];
if($vFlag==1)
{
		
		$vresult=$lvda_lh0003->LV_Insert();
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
<title>MINH PHUONG</title>
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
		o.qxtlv001.value="";
		o.qxtlv002.value="";
		o.qxtlv003.value="";
		o.qxtlv004.value="";
		o.qxtlv005.value="";
		o.qxtlv006.value="";
		o.qxtlv007.value="";
		o.qxtlv003.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.qxtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		o.qxtlv012.value=getChecked(o.chklv012.value,'chklv012');
		if(o.qxtlv006.value==""){
			alert("<?php echo 'Mô tả không trống!';?>");
			o.qxtlv006.focus();
			}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				if(str=='') 
					str=div.value;
				else
					 str=str+','+div.value;
				}
			
			}
			return str;
		}
-->
</script>
<?php
if($lvda_lh0003->GetAdd()>0)
{
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" method="post" enctype="multipart/form-data"   name="frmadd" id="frmadd" >
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag"  />
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>							
							<tr>
							  	<td  height="20px"><?php echo $vLangArr[20];?></td>
							  	<td  height="20px">
								  	<select class="norequired" name="qxtlv006"  id="qxtlv006"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)">
				  						<?php echo $lvda_lh0003->LV_LinkField('lv006',$lvda_lh0003->lv006);?>
				  					</select>
								</td>
							</tr>	
							<tr>
							  	<td  height="20px"><?php echo $vLangArr[21];?></td>
							  	<td  height="20px">
								  <input type="checkbox" name="qxtlv007" id="qxtlv007" tabindex="7"  onKeyPress="return CheckKey(event,7)" value="1" <?php echo ($lvda_lh0003->lv007==1)?'checked="true"':'';?>/>	
								</td>
							</tr>	
							<tr>
							  	<td  height="20px"><?php echo $vLangArr[25];?></td>
							  	<td  height="20px">
								<input class="norequired" name="qxtlv011" type="text" id="qxtlv011" value="<?php echo $lvda_lh0003->lv011;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								</td>
							</tr>	
							<tr>
							  	<td  height="20px"><?php echo $vLangArr[32];?></td>
							  	<td  height="20px">
								<input class="norequired" name="qxtlv018" type="text" id="qxtlv018" value="<?php echo $lvda_lh0003->lv018;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								</td>
							</tr>	
							
							<tr>
							  	<td  height="20px"><?php echo $vLangArr[27];?></td>
							  	<td  height="20px">
								<input class="norequired" name="qxtlv013" type="text" id="qxtlv013" value="<?php echo $lvda_lh0003->lv013;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								</td>
							</tr>	
							<tr>
							  	<td  height="20px"><?php echo $vLangArr[26];?></td>
							  	<td >
								  	<div style="max-height:200px;overflow:auto">
										<input type="hidden" name="qxtlv012" id="qxtlv012"   tabindex="8"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvda_lh0003->lv012;?>"/>
										<?php echo $lvda_lh0003->GetBuilCheckList($lvda_lh0003->lv012,'chklv012',10,'hr_lv0002','lv003');?>
									</div>
								</td>
							</tr>	
							<tr>
							  	<td  height="20px"><?php echo $vLangArr[18];?></td>
							  	<td  height="20px">
								<input class="norequired" name="qxtlv004" type="text" id="qxtlv004" value="<?php echo $lvda_lh0003->lv004;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								</td>
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
		o.qxtlv003.focus();
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
	include("../da_lh0003/permit.php");
}
?>
</body>
</html>