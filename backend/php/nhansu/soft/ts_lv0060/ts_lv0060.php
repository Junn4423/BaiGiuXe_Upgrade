<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/ts_lv0060.php");

/////////////init object//////////////
$mots_lv0060=new  ts_lv0060($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0060');
/////////////init object//////////////

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","TS0065.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$mots_lv0060->lv002=getyear($vNow)."-".getmonth($vNow)."-"."01";
$mots_lv0060->lv003=$vNow;
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
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
<link rel="stylesheet" href="../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../css/popup.css" type="text/css">
<script language="javascript" src="../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../javascripts/engines.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
function RptWH(vValue)
{
 	var o=document.frmRpt;
	o.target="_blank";
	o.txtlv008.value=getChecked(o.chklv008.value,'chklv008');
	o.txtlv011.value=getChecked(o.chklv011.value,'chklv011');
	o.action="ts_lv0060?func=rpt";
	o.submit();
}
function LoadType(to)
	{

		var o=document.frmRpt;
		var vo=o.txtlv004.value;
		switch(vo)
		{
			case 'BANHANG':
				LoadPopupParent(to,'txtlv005','ts_lv0021','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv005','ts_lv0021','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'MUAHANG':
				LoadPopupParent(to,'txtlv005','ts_lv0021','lv003');
				break;
			case 'CUS':
				LoadPopupParent(to,'txtlv005','ts_lv0003','concat(lv002,@!-@!,lv001)');
				break;
		}
	}

function Refresh()
{
	
}
//-->
</script>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form  method="get" name="frmRpt" id="frmRpt" enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="<?php echo $plang;?>" />
					 <table width="100%" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
				      <td  height="20" width="100"><?php echo $vLangArr[2];?></td>
				      <td  height="20"><input name="txtlv002" type="text" id="txtlv002" value="<?php echo formatdate($mots_lv0060->lv002,$plang);?>" tabindex="7" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="110"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv002);return false;" /></span></td>
						  </tr>							 
							
						  <tr>
				      <td  height="20"><?php echo $vLangArr[3];?></td>
				      <td  height="20"><input name="txtlv003" type="text" id="txtlv003" value="<?php echo formatdate($mots_lv0060->lv003,$plang);?>" tabindex="8" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
				        <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="110"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv003);return false;" /></span></td>
						  </tr>					  						
						  <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[27];?></td>
							  <td  height="20"><table width="80%"><tr><td width="50%">
							  <select name="txtlv005" id="txtlv005"   tabindex="9"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
							  <option value=""></option>
							  <?php echo $mots_lv0060->LV_LinkField('lv005',$mots_lv0060->lv005);?>
							  </select></td>
							  <td>
							  <ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv005_search" id="txtlv005_search" style="width:50%" onKeyUp="LoadPopupParent(this,'txtlv005','ts_lv0003','concat(lv002,@!-@!,lv001)')" onFocus="LoadPopupParent(this,'txtlv005','ts_lv0003','concat(lv002,@!-@!,lv001)')"  tabindex="200" ><input type="checkbox" name="txtlv005_opt" id="txtlv005_opt" value="1">
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td></tr>
						 
						 <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[52];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
								<select name="txtlv013" id="txtlv013"   tabindex="11"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
									<option value=""></option>
									<?php echo $mots_lv0060->LV_LinkField('lv003',$mots_lv0060->lv003);?>
								</select>
								</td><td>
							  <ul id="pop-nav5" lang="pop-nav5" onkeyup="ChangeName(this,5)" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv013_search" id="txtlv013_search" style="width:50%" onKeyUp="LoadPopupParent(this,'txtlv013','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@!-@!,lv001)')" onFocus="LoadPopupParent(this,'txtlv013','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@!-@!,lv001)')" tabindex="200" ><input type="checkbox" name="txtlv013_opt" id="txtlv013_opt" value="1">Không chọn
							    <div id="lv_popup5" lang="lv_popup5"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
						    </tr>
						 <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[5];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
								<select name="txtlv006" id="txtlv006"   tabindex="11"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
									<option value=""></option>
									<?php echo $mots_lv0060->LV_LinkField('lv006',$mots_lv0060->lv006);?>
								</select>
								</td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onkeyup="ChangeName(this,2)" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv006','sl_lv0007','concat(lv002,@!-@!,lv001)')" onFocus="LoadPopupParent(this,'txtlv006','sl_lv0007','concat(lv002,@!-@!,lv001)')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
						    </tr>
                             <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[39];?></td>
							  <td  height="20"><input name="txtlv008" type="hidden" id="txtlv008" value="<?php echo $mots_lv0060->lv008;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $mots_lv0060->GetBuilCheckList($mots_lv0060->lv008,'chklv008',10);?></td>
						    </tr>		
							<tr>
								<td  height="20" valign="top"><?php  echo 'Lựa chọn nâng cáo theo nhóm sản phẩm';?></td>
								<td  height="20">
									<div style="float:left;width:60%" >
										<select name="optcate" id="optcate"   tabindex="11"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
											<option value="0"><?php echo '0.Lấy sản phẩm theo nhóm sản phẩm';?></option>
											<option value="1"><?php echo '1.Lấy đơn hàng theo nhóm sản phẩm';?></option>	
										</select>
									</div>
								</td>
						    </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo 'Trạng thái';?></td>
							  <td  height="20"><input name="txtlv011" type="hidden" id="txtlv011" value="<?php echo $mots_lv0060->lv011;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $mots_lv0060->GetBuilCheckListState($mots_lv0060->lv011,'chklv011',11);?>
							 </td>
						    </tr>
							<tr>
							  <td  height="20" valign="top"><?php  echo $vLangArr[63];?></td>
							  <td  height="20">
								<div style="float:left;width:60%" >
									<select name="rad" id="rad"   tabindex="11"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
										<option value="3"><?php echo $vLangArr[67];?></option>
									</select>
								</div>
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
document.frmRpt.txtlv011.value='';
	
</script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>