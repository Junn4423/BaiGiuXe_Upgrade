<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/rp_lv0006.php");

/////////////init object//////////////
$morp_lv0006=new  rp_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0006');
/////////////init object//////////////

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","RP0004.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$lvDateFrom=$morp_lv0006->FormatView(getyear($vNow)."-01-"."01",2);
$lvDateTo=$morp_lv0006->FormatView(getyear($vNow)."-12-"."31",2);
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
if(!isset($_POST['txtlv005'])) $morp_lv0006->lv005=$vNow;

$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vStrMessage=GetNoDelete($strar,"",$lvMessage);
}
elseif($flagID==2)
{

}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
}
else//last is RptWH
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
}
if($maxRows ==0) $maxRows = 10;
$morp_lv0006->lv003='0,1';
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmRpt','document.frmRpt.curPg',2);
?>
<?php
if($morp_lv0006->GetView()==1)
{
?>
<link rel="stylesheet" href="../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../css/popup.css" type="text/css">
<script language="javascript" src="../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../javascripts/engines.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
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
function RptWH(vValue)
{
 	var o=document.frmRpt;
	o.target="_blank";
	o.txtdepid.value=getChecked(o.chklv002.value,'chklv002');
	o.txtstate.value=getChecked(o.chklv003.value,'chklv003');
	o.action="rp_lv0006?func=rpt"
	o.submit();
}
function Refresh()
{
	
}
//-->
</script>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form  method="get" name="frmRpt" id="frmRpt" enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>" />
					 <table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
                             <tr>
							  <td width="166"  height="20" valign="top"><?php echo $vLangArr[2];?></td>
							  <td width="178"  height="20">
							  	<div style="max-height:300px;overflow:auto">
							  		<input name="txtdepid" type="hidden" id="txtdepid" value="<?php echo $morp_lv0006->lv002;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $morp_lv0006->GetBuilCheckListDep($morp_lv0006->lv002,'chklv002',10,'hr_lv0002','lv003');?></td>
						    	</div>
							</tr>	
						  <tr>
							  <td  height="20"><?php echo $vLangArr[3];?></td>
							  <td  height="20">
							  	<div style="max-height:200px;overflow:auto">
							 		<input name="txtstate" type="hidden" id="txtstate" value="<?php echo $morp_lv0006->lv003;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $morp_lv0006->GetBuilCheckList($morp_lv0006->lv003,'chklv003',10,'hr_lv0022');?></td>
					   			</div>
							</tr>	
					   <!--
                       <tr>
							  <td  height="20px"><?php echo $vLangArr[5];?></td>
							  <td  height="20px"><select name="txtlv006" id="txtlv006" tabindex="10" style="width:80%" onKeyPress="return CheckKey(event,7)"><option value=""></option><?php echo $morp_lv0006->LV_LinkField('lv106','P');?></select></td>
							  </tr>	-->
					   		<tr>
							  	<td  height="20"><?php echo $vLangArr[4];?></td>
							  	<td  height="20">
									<table width="80%"><tr><td width="50%">
										<input name="txtlempid" type="text" id="txtlempid" value="<?php echo $morp_lv0006->lv004;?>" tabindex="9" maxlength="50" style="width:100%" onKeyPress="return CheckKey(event,7)" />
										</td>
										<td>
											<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
												<input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlempid','hr_lv0020','concat(lv004,lv003,lv002)')" onFocus="LoadPopupParent(this,'txtlempid','hr_lv0020','concat(lv004,lv003,lv002)')" tabindex="200" >
												<div id="lv_popup" lang="lv_popup1"> </div>						  
												</li>
											</ul>
										</td></tr>
									</table>	
								</td>
					  		</tr>	
                              <tr>
				      <td  height="20"><?php echo $vLangArr[17];?></td>
				      <td  height="20"><input name="txtdatefrom" type="text" id="txtdatefrom" value="<?php echo ($lvDateFrom);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtdatefrom);return false;" /></span></td>
						  </tr>		
						  <tr>
				      <td  height="20"><?php echo $vLangArr[18];?></td>
				      <td  height="20"><input name="txtdateto" type="text" id="txtdateto" value="<?php echo ($lvDateTo);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtdateto);return false;" /></span></td>
						  </tr>	
							<tr>
								<td  height="20" width="166"><?php echo $vLangArr[19];?></td>
								<td  height="20"><input type="checkbox" value="1" name="isStaffOff" checked/></td>
							</tr> 
							<tr>
								<td  height="20" width="166"><?php echo 'Chọn báo cáo';?></td>
								<td>
									<select name="txtlv221">
										<option value="1"  selected="selected"><?php echo 'BÁO CÁO PHÉP NĂM';?></option>
										<option value="2" ><?php echo 'BÁO CÁO PHÉP KL';?></option>
									</select>
								</td>
							</tr>
							<tr>
							  <td  height="20" colspan="2"><input name="func" type="hidden" id="func" value="rpt"  /></td>
							</tr>
							<tr>
							  <td  height="20" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:RptWH();" tabindex="47"><img src="../images/lvicon/Rpt.png" 
            alt="RptWH" title="<?php echo $vLangArr[12];?>" 
            name="RptWH" border="0" align="middle" id="RptWH" /> <?php echo $vLangArr[12];?></a></TD>
                    <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[13];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[13];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>  
				  </form>
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[0];?>';	
</script>
<script language="javascript" src="../javascripts/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $plang;?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php
} else {
	include("../permit.php");
}
?>