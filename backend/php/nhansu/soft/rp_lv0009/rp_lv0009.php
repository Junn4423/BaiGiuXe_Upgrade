<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/rp_lv0009.php");

/////////////init object//////////////
$morp_lv0009=new  rp_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0015');
/////////////init object//////////////

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","RP0003.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$morp_lv0009->lv002=getyear($vNow)."-".getmonth($vNow)."-"."01";
$morp_lv0009->lv003=$vNow;
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
	o.action="rp_lv0009?func=rpt";
	o.submit();
}
function LoadType(to)
	{

		var o=document.frmRpt;
		var vo=o.txtlv004.value;
		switch(vo)
		{
			case 'CONTRACT':
				LoadPopupParent(to,'txtlv005','sl_lv0013','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'RECONTRACT':
				LoadPopupParent(to,'txtlv005','sl_lv0013','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'PO':
				LoadPopupParent(to,'txtlv806','ts_lv0021','lv003');
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
					 <table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
							  <td width="166"  height="20"><?php echo $vLangArr[1];?></td>
							  <td width="178"  height="20"><select name="txtlv001" id="txtlv001"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)"><option value=""></option><?php echo $morp_lv0009->LV_LinkField('lv002',$morp_lv0009->lv002);?>
							 
                              </select>							    </td>
							</tr>
                       <tr>
                          <td  height="20"><?php echo $vLangArr[2];?></td>
                          <td  height="20"><input name="txtlv002" type="text" id="txtlv002" value="<?php echo formatdate($morp_lv0009->lv002,$plang);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
                          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
                                                                border="0" style="cursor:pointer" width="16" height="16" align="top" 
                                                                onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv002);return false;" /></span></td>
						</tr>							 
						<tr>
                          <td  height="20"><?php echo $vLangArr[40];?></td>
                          <td  height="20"><input name="txtlv022" type="text" id="txtlv022" value="<?php echo formatdate($morp_lv0009->lv022,$plang);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
                          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
                                                                border="0" style="cursor:pointer" width="16" height="16" align="top" 
                                                                onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv022);return false;" /></span></td>
						</tr>	
						<tr>
                          <td  height="20"><?php echo $vLangArr[3];?></td>
                          <td  height="20"><input name="txtlv003" type="text" id="txtlv003" value="<?php echo formatdate($morp_lv0009->lv003,$plang);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
                            <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
                                                                border="0" style="cursor:pointer" width="16" height="16" align="top" 
                                                                onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv003);return false;" /></span></td>
                              </tr>
                              <tr>
                                  <td  height="20"><?php echo $vLangArr[41];?></td>
                                  <td  height="20"><input name="txtlv023" type="text" id="txtlv023" value="<?php echo formatdate($morp_lv0009->lv003,$plang);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
                                    <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
                                                                        border="0" style="cursor:pointer" width="16" height="16" align="top" 
                                                                        onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv003);return false;" /></span></td>
                              </tr>
                             <tr>
                                  <td  height="20" valign="top"><?php echo $vLangArr[5];?></td>
                                  <td  height="20"><select name="txtlv006" id="txtlv006"   tabindex="7"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
                                    
                                  <option value=""></option>
                                  <?php echo $morp_lv0009->LV_LinkField('lv006',$morp_lv0009->lv006);?>
                                  </select>	<br>
                                  <table><tr><td><img src="../images/controlright/search.gif" ></td><td>
                                  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
                                    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv006','sl_lv0007','lv002')" onFocus="LoadPopupParent(this,'txtlv006','sl_lv0007','lv002')" tabindex="200" >
                                    <div id="lv_popup2" lang="lv_popup2"> </div>						  
                            </li>
                        </ul></td></tr></table>		</td>
						    </tr>
                             <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[39];?></td>
							  <td  height="20"><input name="txtlv008" type="hidden" id="txtlv008" value="<?php echo $morp_lv0009->lv008;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $morp_lv0009->GetBuilCheckList($morp_lv0009->lv008,'chklv008',10);?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[8];?></td>
				  <td  height="20"><input  name="txtlv007" type="text" id="txtlv007" value="<?php echo $morp_lv0009->lv007;?>" tabindex="9" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><br>
							  <table><tr><td><img src="../images/controlright/search.gif" ></td><td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onkeyup="LoadPopupParentWH(this,'txtlv007','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" onfocus="LoadPopupParentWH(this,'txtlv007','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
						  </tr>	
						  <tr>
							  <td  height="20"><?php echo $vLangArr[10];?></td>
							  <td  height="20"><select name="txtlv009" id="txtlv009"   tabindex="15"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
                              <option value=""></option>
							  <?php echo $morp_lv0009->LV_LinkField('lv009',$lvsl_lv0014->lv009);?>
							  </select>	<br><table><tr><td></td><td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch3" id="txtlvsearch3" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv009','sl_lv0029','lv002')" onFocus="LoadPopupParent(this,'txtlv009','sl_lv0029','lv002')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>							  </td>
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
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>