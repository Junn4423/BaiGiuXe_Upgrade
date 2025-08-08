<?php
session_start();
//require_once("../../clsall/cr_lv0086.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/cr_lv0086.php");
require_once("../../clsall/cr_lv0004.php");
//////////////init object////////////////
$lvcr_lv0086=new cr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0086');
$lvcr_lv0004=new cr_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0004');
$vocr_lv0004=new cr_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0004');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","CR0008.txt",$plang);
$lvcr_lv0086->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvcr_lv0086->lv001=$_POST['txtlv001'];
$lvcr_lv0086->lv002=$_POST['txtlv002'];
$lvcr_lv0086->lv003=$_POST['txtlv003'];
$lvcr_lv0086->lv006=$_POST['txtlv006'];
$lvcr_lv0086->lv007=$_POST['txtlv007'];
$lvcr_lv0086->lv111=$_POST['txtlv111'];
$lvcr_lv0086->lv008=$_POST['txtlv008'];
$lvcr_lv0086->lv009=getInfor($_SESSION['ERPSOFV2RUserID'], 2);
$lvcr_lv0086->lv010=$_POST['txtlv010'].' '.$_POST['txtlv010_'];	
if($_POST['txtlv010']=='' || $_POST['txtlv010']==NULL) $lvcr_lv0086->lv010=$lvcr_lv0086->DateCurrent;
$lvcr_lv0086->lv011=0;
$lvcr_lv0086->lv012=$_POST['txtlv012'];
if($vFlag==1)
{
		$vsql="select * from sp_lv0086";
		$vresult1=db_query($vsql);
		$lvcr_lv0086->lv010_=$lvcr_lv0086->lv010;
		if( $_GET['ID']!='')
			$lvcr_lv0086->lv002= $_GET['ID'];
		else
			$lvcr_lv0086->lv002=$lvcr_lv0004->LV_AutoBuilUser($lvcr_lv0004->LV_UserID);
		while ($vrow = db_fetch_array ($vresult1))
		{
			$lvcr_lv0086->lv010=$_POST['txtlv010'].' '.$_POST['txtlv010_'];	
			$lvcr_lv0086->lv003=$vrow['lv001'];
			$lvcr_lv0086->lv004=str_replace(",","",$_POST['txt4_'.$vrow['lv001']]);
			$lvcr_lv0086->lv005=0;//$_POST['txt5_'.$vrow['lv001']];
			if($lvcr_lv0086->lv004<>0)
			{
				$vresult=$lvcr_lv0086->LV_Insert();
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
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	//	window.parent.ClickShow();
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
		o.submit();
		
	}
	function SumAll()
	{
		var txt4_all=document.getElementById('txt4_all');
		var len=parseInt(txt4_all.title);
		var Tong=0;
		for(var i=1;i<len;i++)
		{
			value=parseFloat(document.getElementById('txt4_'+i).title);
			if(value>0) Tong=Tong+value;

		}
		txt4_all.innerHTML=NumberWithCommas(Tong);
	}
	
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv008.value=="")
		{
			alert("<?php echo 'Chọn người nhận';?>");
			o.txtlv008.focus();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	function LayLaiGiaTri(o)
	{
		o.value=o.title;
		o.select();
		
	}
	function SetGiaTri(o)
	{
		o.title=o.value;
		o.value=NumberWithCommas(o.title);
	}
-->
</script>
<?php
if($lvcr_lv0086->GetAdd()>0)
{
	$vocr_lv0004->LV_LoadID( $_GET['ID']);
	if($vocr_lv0004->lv007=='QT')
	{
		$vStaffID='';
		$vMaUngID= $_GET['ID'];
		$vArrPC=$vocr_lv0004->LV_GetAmountPC_ExtMore($vMaUngID,'QUYETTOAN',$vTongChi);
		if($vArrPC!=null)
		{
			foreach($vArrPC as $key => $vArrStaff)
			{
				foreach($vArrStaff as $vStaffID => $value)
				{
					;
					//($vMaUngID,$key,$value,$vStaffID);
				}
			}
		}
		if($lvcr_lv0086->lv008=='') $lvcr_lv0086->lv008=$vStaffID;
	}
?>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"  name="frmadd" id="frmadd"  method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<!--
							<tr>
							  <td  height="20" width="166"><?php echo $vLangArr[16];?></td>
							  <td  height="20" width="*" >
								<select name="txtlv002" id="txtlv002"   tabindex="11"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)">
									<?php echo $lvcr_lv0086->LV_LinkField('lv002',$lvcr_lv0086->lv002);?>
								</select>	  
							</tr>-->
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[17];?></td>
							  <td  height="20">
							  <table border="1" cellpadding="0" cellpadding="0" width="80%">
							  <?php
								$vsql="select * from cr_lv0003 where lv001<>'' order by lv008 asc ";
								$vresult=db_query($vsql);
								$i=0;
								$vOrder=1;
								while ($vrow = db_fetch_array ($vresult))
								{
									$vColor='';
									if($vrow['lv001']=='CCONT' || $vrow['lv001']=='CHIHO')
									{
										$vColor=';color:red;';
									}
									if(($i%2)==0)
									{
									 if($vOrder!=1)	echo "</tr>";
										echo "<tr style='padding:5px;height:20px;'>";
										$i=0;
									}
									echo '<td style="height:20px;text-align:right;'.$vColor.'"><strong>'.$vrow['lv008'].'.</strong></td><td style="height:20px;text-align:left;'.$vColor.'">'.$vrow['lv002'].'</td><td><input tabindex="6" style="width:100%;text-align:center;'.$vColor.'" type="textbox" name="txt4_'.$vrow['lv001'].'" id="txt4_'.$vOrder.'" title="0" value="0" onblur="SetGiaTri(this);SumAll()" onfocus="LayLaiGiaTri(this)"/></td>';
									$i++;
									$vOrder++;
								}
								if($vOrder>1)
								{ echo '</tr>
										<tr style="padding:5px;height:20px;"><td><strong>Tổng tiền:</strong></td><td colspan="5"><div id="txt4_all" style="font-weight:bold"  title="'.$vOrder.'"></div></td></tr>

								';
								}
							  ?>
							 	</table>
								
									</td>
						    </tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[26];?></td>
							  <td  height="20px"> 
							   <select  name="txtlv012" id="txtlv012" type="text" tabindex="9">
							   <?php echo $lvcr_lv0086->LV_LinkField('lv012',$lvcr_lv0086->lv012);?>
							  </select>	
								</td>
							</tr>				
							<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[20];?></td>
								<td width="*"  height="20"><table width="80%">
								<tr><td width="50%"><select name="txtlv006" id="txtlv006"   tabindex="11"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							 <?php echo $lvcr_lv0086->LV_LinkField('lv006',($lvcr_lv0086->lv006='' || $lvcr_lv0086->lv006==NULL)?'VND':$lvcr_lv0086->lv006);?>
							  </select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv006','hr_lv0018','lv002')" onFocus="LoadPopup(this,'txtlv006','hr_lv0018','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
					      </tr>
						  <tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[22];?></td>
								<td width="*"  height="20"><table width="80%">
								<tr><td width="50%"><select name="txtlv008" id="txtlv008"   tabindex="11"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
								<option value=""></option>
							<?php echo $lvcr_lv0086->LV_LinkField('lv008',$lvcr_lv0086->lv008);?>
							  </select></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input value="<?php echo $vStaffID;?>" type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv008','hr_lv0020','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv008','hr_lv0020','concat(lv001,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>					 </td>
					      </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[21];?></td>
							  <td  height="20"><input name="txtlv007" id="txtlv007"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvcr_lv0086->lv007;?>"/>							  </td>
						    </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo 'GC Hoá Đơn';?></td>
							  <td  height="20"><input name="txtlv111" id="txtlv111"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvcr_lv0086->lv111;?>"/>							  </td>
						    </tr>			
						     <tr>
							  <td  height="20px"><?php echo $vLangArr[24];?></td>
							  <td  height="20px">
								<input name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvcr_lv0086->FormatView($lvcr_lv0086->lv010,2);?>" tabindex="10" maxlength="50" style="width:100px" onKeyPress="return CheckKey(event,7)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv010);return false;">
								<select name="txtlv010_" type="text" id="txtlv010_" value="<?php echo $lvcr_lv0086->lv010_;?>" tabindex="10" maxlength="50" style="width:100px;text-align:center;" onKeyPress="return CheckKey(event,7)">
									<option value="00:00:00" <?php echo (($_POST['txtlv010_']=='' || $_POST['txtlv010_']=='00:00:00')?'selected="selected"':'');?>>---</option>
									<option value="08:00:00" <?php echo (($_POST['txtlv010_']=='08:00:00')?'selected="selected"':'');?>>08:00:00</option>
									<option value="09:00:00" <?php echo (($_POST['txtlv010_']=='09:00:00')?'selected="selected"':'');?>>09:00:00</option>
									<option value="10:00:00" <?php echo (($_POST['txtlv010_']=='10:00:00')?'selected="selected"':'');?>>10:00:00</option>
									<option value="11:00:00" <?php echo (($_POST['txtlv010_']=='11:00:00')?'selected="selected"':'');?>>11:00:00</option>
									<option value="12:00:00" <?php echo (($_POST['txtlv010_']=='12:00:00')?'selected="selected"':'');?>>12:00:00</option>
									<option value="13:00:00" <?php echo (($_POST['txtlv010_']=='13:00:00')?'selected="selected"':'');?>>13:00:00</option>
									<option value="14:00:00" <?php echo (($_POST['txtlv010_']=='14:00:00')?'selected="selected"':'');?>>14:00:00</option>
									<option value="15:00:00" <?php echo (($_POST['txtlv010_']=='15:00:00')?'selected="selected"':'');?>>15:00:00</option>
									<option value="16:00:00" <?php echo (($_POST['txtlv010_']=='16:00:00')?'selected="selected"':'');?>>16:00:00</option>
									<option value="17:00:00" <?php echo (($_POST['txtlv010_']=='17:00:00')?'selected="selected"':'');?>>17:00:00</option>
									<option value="18:00:00" <?php echo (($_POST['txtlv010_']=='18:00:00')?'selected="selected"':'');?>>18:00:00</option>
								</select>

						      </td>
							  </tr>				
							<tr>
							  <td  height="20" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
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
			      </form>	

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript"> var o=document.frmadd; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
		o.txtlv002.focus();
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