<?php
///////////Copy right sof.vn/////////////
//////////No Edit////////////////////
//////////Date:20:04:2009/////////////
session_start();
//require_once("../../clsall/hr_lv0214.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0214.php");
//////////////init object////////////////
$lvhr_lv0214=new  hr_lv0214($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0214');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0330.txt",$plang);
	
$curPage = (int)($_POST['curPg'] ?? 1);
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0214->lv001=$_POST['txtlv001'];
$lvhr_lv0214->lv002=$_POST['txtlv002'];
$lvhr_lv0214->lv003=$_POST['txtlv003'];
$lvhr_lv0214->lv004=$_POST['txtlv004'];
$lvhr_lv0214->lv005=$_POST['txtlv005'];
if($vFlag==1)
{
		
		$vresult=$lvhr_lv0214->LV_Insert();
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
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/responsive.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
</head>
<script language="javascript">
<!--
	function Refresh()
	{
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
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

-->
</script>
<?php
if($lvhr_lv0214->GetAdd()>0)
{
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"   name="frmadd" id="frmadd"  method="post">
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
								<td width="*"  height="20px">
									<input class="norequired" name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvhr_lv0214->lv001=="")?InsertWithCheckExt('hr_lv0214', 'lv001', 'CAI',3):$lvhr_lv0214->lv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)" />			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input class="norequired" name="txtlv002" type="text" id="txtlv002" value="<?php echo $lvhr_lv0214->lv002;?>" tabindex="6" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
								<td height="20" valign="top"><?php echo $vLangArr[17];?></td>
								<td height="20">
									<table style="width:80%">
										<tr>
											<td width="50%">
												<select class="norequired" name="txtlv003" id="txtlv003"   tabindex="7"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
												<option value=""></option>
												<?php echo $lvhr_lv0214->LV_LinkField('lv003',$lvhr_lv0214->lv003);?>
												</select>
											</td>
											<td width="50%">
												<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
													<input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','hr_lv0214','lv002')" onFocus="LoadPopup(this,'txtlv003','hr_lv0214','lv002')" tabindex="200" >
													<div id="lv_popup" lang="lv_popup1"> </div>						  
													</li>
												</ul>
											</td>
										</tr>
									</table>
									
								</td>
					      </tr>
						  <tr>
						  <td  height="20px"><?php echo $vLangArr[18];?></td>
						  <td  height="20px"><input class="norequired" name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0214->lv004;?>" tabindex="8" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						</tr>
						  <tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input class="norequired" name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvhr_lv0214->lv005;?>" tabindex="6" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
						
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="8"><img src="../images/controlright/save_f2.png" 
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

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<script language="javascript" src="../../javascripts/menupopup.js"></script>
<script language="javascript">
	var o=document.frmadd;
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
	include("permit.php");
}
?>
</body>
</html>