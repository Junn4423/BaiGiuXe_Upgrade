<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/ki_lv0010.php");
require_once("../clsall/tc_lv0013.php");

/////////////init object//////////////
$moki_lv0010=new  ki_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ki0010');
$motc_lv0013=new  tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');

/////////////init object//////////////
$motc_lv0013->LV_LoadActiveID();
$moki_lv0010->lv001=$motc_lv0013->lv001;
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","RP0002.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$lvDateFrom=getyear($vNow)."-".getmonth($vNow)."-"."01";
$lvDateTo=getyear($vNow)."-12-"."31";
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
if(!isset($_POST['txtlv005'])) $moki_lv0010->lv005=$vNow;
if($moki_lv0010->GetApr()==0)	$moki_lv0010->lv029=$moki_lv0010->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
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

$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmRpt','document.frmRpt.curPg',2);
?>
<?php
if($moki_lv0010->GetView()==1)
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
	o.txtlv002.value=getChecked(o.chklv002.value,'chklv002');
	o.txtlv003.value=getChecked(o.chklv003.value,'chklv003');
	o.action="ki_lv0010?func=rpt"
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
							  <td width="166"  height="20"><?php echo 'Chọn tháng đánh giá';?></td>
							  <td width="178"  height="20"><select name="txtlv001" id="txtlv001"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)"><?php echo $moki_lv0010->LV_LinkField('lv001',$moki_lv0010->lv001);?>
							 
                              </select>							    </td>
							</tr>
                             <tr>
							  <td width="166"  height="20" valign="top"><?php echo $vLangArr[2];?></td>
							  <td width="178"  height="20">
								  <div style="max-height:400px;overflow:auto">
									<input name="txtlv002" type="hidden" id="txtlv002" value="<?php echo $moki_lv0010->lv002;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $moki_lv0010->GetBuilCheckListDept($moki_lv0010->lv002,'chklv002',10,'hr_lv0002','lv003',$moki_lv0010->lv029);?>
								  </div>
							  </td>
						    </tr>
						    <tr>
							  <td  height="20" width="166"><?php echo 'Lấy phòng ban con';?></td>
							  <td  height="20"><input type="checkbox" value="1" name="isChildCheck" checked="true" /></td>
							</tr>	
						  <tr>
							  <td  height="20"><?php echo $vLangArr[3];?></td>
							  <td  height="20">
							   <div style="max-height:200px;overflow:auto">
									<input name="txtlv003" type="hidden" id="txtlv003" value="<?php echo $moki_lv0010->lv003;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $moki_lv0010->GetBuilCheckList('0,1,4,5,6','chklv003',10,'hr_lv0022');?>
								</div>
							</td>
					   </tr>	
                      
					   		<tr>
							  <td  height="20"><?php echo $vLangArr[4];?></td>
							  <td  height="20"><table><tr><td><input name="txtlv004" type="text" id="txtlv004" value="<?php echo $moki_lv0010->lv004;?>" tabindex="9" maxlength="50" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" /></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv004_search" id="txtlv004_search" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv004','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopupParent(this,'txtlv004','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
					  		</tr>	
                            <!--<tr>
				      <td  height="20"><?php echo $vLangArr[23];?></td>
				      <td  height="20"><input name="txtdatefrom" type="text" id="txtdatefrom" value="<?php echo $moki_lv0010->FormatView($lvDateFrom,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtdatefrom);return false;" /></span></td>
						  </tr>		
						  <tr>
				      <td  height="20"><?php echo $vLangArr[24];?></td>
				      <td  height="20"><input name="txtdateto" type="text" id="txtdateto" value="<?php echo $moki_lv0010->FormatView($lvDateTo,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtdateto);return false;" /></span></td>
						  </tr>		
                          <tr>
							  <td  height="20" ><?php echo $vLangArr[6];?></td><td>
							  <select name="txtopt" id="txtopt"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
							  <option value="0"><?php echo $vLangArr[7];?></option>
                              <option value="1"><?php echo $vLangArr[8].'(hh:mm:ss)';?></option>
							<option value="2"><?php echo $vLangArr[8].'(hh:mm)';?></option>
                              </select></td>
					   </tr>
						<tr>
					   		<td><?php echo $vLangArr[23];?></td><td><select name="txtisshift">
					   			<option value="0" >Không</option>
					   			<option value="1" selected="selected">Có</option>
					   		</select></td>
					   </tr>		-->	
					    <tr>
					   		<td><?php echo $vLangArr[28];?></td><td>
								<select name="txtlv221">
					   			<option value="0" ><?php echo 'Mẫu theo tháng';?></option>
								<option value="1" ><?php echo 'Mẫu bình quân năm';?></option>
					   		</select>
							   </td>
					   </tr>	
					   <tr>
					   		<td><?php echo $vLangArr[14];?></td><td><select name="txtlv022">
					   			<option value="0" ><?php echo $vLangArr[21];?></option>
					   			<option value="1" ><?php echo $vLangArr[22];?></option>
					   			<option value="2" ><?php echo 'Theo nhóm';?></option>
					   			<option value="3" ><?php echo 'Theo mã chấm công';?></option>
					   			<option value="4" selected="selected"><?php echo 'Theo ngày đơn';?></option>
					   		</select></td>
					   </tr>	
						 <tr>
								  <td  height="20" width="166"><?php echo $vLangArr[33];?></td>
								  <td  height="20"><input type="checkbox" value="1" name="isStaffOff"/></td>
								</tr> 
							<tr>
								<td>
								<?php echo $vLangArr[35];?>
								</td>
							  <td  height="20" colspan="2">
							  <select name="func">
									<option value="rpt">...</option>
									<option value="excel"><?php echo $vLangArr[36];?></option>
									<option value="word"><?php echo $vLangArr[37];?></option>
							  </select>
							  </td>
							</tr>							
							<tr>
							  <td  height="20" colspan="2">
	<TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
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