<?php
session_start();
//require_once("../../clsall/tc_lv0021.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0021.php");
//////////////init object////////////////
$lvtc_lv0021=new tc_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0021');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0039.txt",$plang);

$curPage=(int)$_GET['curPg'];	
$vFlag=(int)$_GET['txtFlag'];
$vlv001=$_GET['lv001'];
$vlv002=$_GET['lv002'];
$vlv003=$_GET['lv003'];
$vlv004=$_GET['lv004'];
$vlv005=$_GET['lv005'];
$vlv006=$_GET['lv006'];
$vlv007=$_GET['lv007'];
$vlv008=$_GET['lv008'];
$vlv009=$_GET['lv009'];
$vlv010=$_GET['lv010'];
$vlv011=$_GET['lv011'];
$vlv012=$_GET['lv012'];
$vlv013=$_GET['lv013'];
$vlv014=$_GET['lv014'];
$vlv015=$_GET['lv015'];
$vlv016=$_GET['lv016'];
$vlv017=$_GET['lv017'];
$vlv018=$_GET['lv018'];
$vlv019=$_GET['lv019'];
$vlv098=$_GET['lv098'];
$vlv021=$_GET['lv021'];
$vlv022=$_GET['lv022'];
$vlv023=$_GET['lv023'];
$vlv024=$_GET['lv024'];
$vlv025=$_GET['lv025'];
$vlv026=$_GET['lv026'];
$vlv027=$_GET['lv027'];
$vlv028=$_GET['lv028'];
$vlv029=$_GET['lv029'];
$vlv096=$_GET['lv096'];
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
function isphone(s){
	if(s!=""){
		var str="0123456789.()-"
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
		var o=document.frmfilter;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function Cancel(){	var o=window.parent.document.getElementById('frmchoose');		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";		o.submit();	}
	function Save()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.txtFlag.value="2";
		o.txtlv001.value=document.frmfilter.txtlv001.value;
		o.txtlv002.value=document.frmfilter.txtlv002.value;		
		o.txtlv098.value=document.frmfilter.txtlv098.value;		
		o.txtlv021.value=document.frmfilter.txtlv021.value;			
		o.txtlv029.value=getChecked(document.frmfilter.chklv029.value,'chklv029');	
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,8,0)?>";
		o.submit();
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
if(1==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[1];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmfilter" method="post">
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
							  <td  height="20" valign="top"><?php echo 'Phòng ban';?></td>
							  <td  height="20">
								<input type="hidden" name="txtlv029"  id="txtlv029" value="<?php echo $vlv029;?>" tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<div style="width:100%;height:250px;position:relative;overflow: auto;top:0px;">
									<?php echo $lvtc_lv0021->GetBuilCheckListDept($vlv029,'chklv029',10,'hr_lv0002','lv003',$vlv029ex);?>
								</div>
								</td>
							</tr>
						<tr>
								<td width="166"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $vlv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" />			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20">
							  <table width="80%">
								<tr><td width="50%"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $vlv002;?>" tabindex="6" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" /></td>
									<td>
										<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv002_search" id="txtlv002_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv002','hr_lv0020','concat(lv004,@!@!,lv003,@!@!,lv002)')" onFocus="LoadPopup(this,'txtlv002','hr_lv0020','concat(lv004,@!@!,lv003,@!@!,lv002)')" tabindex="200" >
										<div id="lv_popup" lang="lv_popup1"> </div>						  
										</li>
										</ul></td></tr></table>	
									</td>
							</tr>
							
								<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[34];?></td>
							  <td  height="20">
							  <table width="80%">
								<tr><td width="50%">
										<input name="txtlv098"  id="txtlv098" style="width:100%" tabindex="26" value="<?php echo $vlv098;?>" onKeyPress="return CheckKeys(event,7,this)"><br>
									</td>
									<td>
										<ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv098_search" id="txtlv098_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv098','tc_lv0013','lv002')" onFocus="LoadPopup(this,'txtlv098','tc_lv0013','lv002')" tabindex="200" >
										<div id="lv_popup2" lang="lv_popup2"> </div>						  
											</li>
										</ul></td></tr></table>
									</td>
								</tr>		
								<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[35];?></td>
							  <td  height="20">
								<table width="80%">
									<tr><td width="50%"><input name="txtlv021"  id="txtlv021" style="width:100%" tabindex="27" value="<?php echo $vlv021;?>" onKeyPress="return CheckKeys(event,7,this)"><br>
										</td>
										<td>
											<ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
												<input type="text" autocomplete="off" class="search_img_btn" name="txtlv021_search" id="txtlv021_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv021','hr_lv0038','lv002')" onFocus="LoadPopup(this,'txtlv021','hr_lv0038','lv002')" tabindex="200" >
												<div id="lv_popup3" lang="lv_popup3"> </div>						  
												</li>
											</ul></td></tr></table>
								</td>
							</tr>		
							  
							
						  <tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../../images/lvicon/Filter.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[3];?></a></TD>
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
	var o=document.frmfilter;
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
	include("../permit.php");
}
?>
</body>
</html>