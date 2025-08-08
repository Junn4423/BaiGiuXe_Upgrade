<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/ts_lv0016.php");

/////////////init object//////////////
$mots_lv0016=new  ts_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ts0016');
/////////////init object//////////////

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","TS0022.txt",$plang);
	$vLangArr1=GetLangFile("../","TS0044.txt",$plang);

$mots_lv0016->ArrPush[0]=$vLangArr1[17];
$mots_lv0016->ArrPush[1]=$vLangArr1[18];
$mots_lv0016->ArrPush[2]=$vLangArr1[20];
$mots_lv0016->ArrPush[3]=$vLangArr1[21];
$mots_lv0016->ArrPush[4]=$vLangArr1[22];
$mots_lv0016->ArrPush[5]=$vLangArr1[23];
$mots_lv0016->ArrPush[6]=$vLangArr1[24];
$mots_lv0016->ArrPush[7]=$vLangArr1[25];
$mots_lv0016->ArrPush[8]=$vLangArr1[26];
$mots_lv0016->ArrPush[9]=$vLangArr1[27];
$mots_lv0016->ArrPush[10]=$vLangArr1[35];

$mots_lv0016->ArrFunc[0]='//Function';
$mots_lv0016->ArrFunc[1]=$vLangArr1[2];
$mots_lv0016->ArrFunc[2]=$vLangArr1[4];
$mots_lv0016->ArrFunc[3]=$vLangArr1[6];
$mots_lv0016->ArrFunc[4]=$vLangArr1[7];
$mots_lv0016->ArrFunc[5]='';
$mots_lv0016->ArrFunc[6]='';
$mots_lv0016->ArrFunc[7]='';
$mots_lv0016->ArrFunc[8]=$vLangArr1[10];
$mots_lv0016->ArrFunc[9]=$vLangArr1[12];
$mots_lv0016->ArrFunc[10]=$vLangArr1[0];
$mots_lv0016->ArrFunc[11]=$vLangArr1[30];
$mots_lv0016->ArrFunc[12]=$vLangArr1[31];
$mots_lv0016->ArrFunc[13]=$vLangArr1[32];
$mots_lv0016->ArrFunc[14]=$vLangArr1[33];
$mots_lv0016->ArrFunc[15]=$vLangArr1[34];
////Other
$mots_lv0016->ArrOther[1]=$vLangArr1[28];
$mots_lv0016->ArrOther[2]=$vLangArr1[29];	
//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$mots_lv0016->lv002=getyear($vNow)."-".getmonth($vNow)."-"."01";
$mots_lv0016->lv003=$vNow;
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mots_lv0016->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0016');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mots_lv0016->ListView;
$curPage = $mots_lv0016->CurPage;
$maxRows =$mots_lv0016->MaxRows;
$vOrderList=$mots_lv0016->ListOrder;
$vSortNum=$mots_lv0016->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mots_lv0016->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ts_lv0016',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);
}

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script language="javascript" src="../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../javascripts/engines.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
function RptWH(vValue)
{
 	var o=document.frmRpt;
	o.target="_blank";
	o.txtlv018.value=getChecked(o.chklv018.value,'chklv018');
	o.action="ts_lv0016?func=rpt";
	o.submit();
}
function LoadType(to)
	{

		var o=document.frmRpt;
		var vo=o.txtlv004.value;
		switch(vo)
		{
			case 'BANHANG':
				LoadPopupParent(to,'txtlv005','sl_lv0013','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv005','sl_lv0013','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'MUAHANG':
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
				 <form name="frmchoose" method="post" id="frmchoose" enctype="multipart/form-data">
                	  <input name="txtStringID" type="hidden" id="txtStringID" />
                  	 <input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
                        <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
                         <table width="100%" border="0" align="center" id="table1">
                        <tr>
								<td colspan="2" height="100%" align="center">
								</font><?php echo $mots_lv0016->ListFieldSave('document.frmchoose',$vFieldList, $maxRows,$vOrderList,$vSortNum);?>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
						</table>
                  </form>
					<div><div id="lvleft"><form  method="get" name="frmRpt" id="frmRpt" enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="<?php echo $plang;?>" />
					 <table width="100%" border="0" align="center" id="table1">
							
							<tr>
							  <td width="166"  height="20"><?php echo $vLangArr[1];?></td>
							  <td  height="20">
							  <input name="txtlv001" type="hidden" id="txtlv001" value="<?php echo $morp_lv0005->lv001;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $mots_lv0016->GetBuilCheckListDept($mots_lv0016->lv001,'chklv001',10,'ts_lv0001','lv002',$mots_lv0016->lv001);?>
							  <!--
							  <select name="txtlv001" id="txtlv001"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
							   				<?php
												if($mots_lv0016->GetApr()==11)
												{
												?>
												<option value=""></option>
												<?php
												}
												?>
							  <?php //echo $mots_lv0016->LV_LinkField('lv012',$mots_lv0016->lv012);?>
							 
                              </select>			
-->							  </td>
							</tr>				  						
						
						 <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[5];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
							  <select name="txtlv006" id="txtlv006"   tabindex="7"  style="width:100%" onkeypress="return CheckKey(event,7)"/>
							    
							  <option value=""></option>
							  <?php echo $mots_lv0016->LV_LinkField('lv016',$mots_lv0016->lv016);?>
							  </select>
							  </td>
							  <td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv006','sl_lv0007','lv002')" onFocus="LoadPopupParent(this,'txtlv006','sl_lv0007','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
						    </tr>
                             <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[39];?></td>
							  <td  height="20"><input name="txtlv018" type="hidden" id="txtlv018" value="<?php echo $mots_lv0016->lv018;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $mots_lv0016->GetBuilCheckList($mots_lv0016->lv018,'chklv018',10);?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20">
							  <table width="80%"><tr><td width="50%">
							  <input  name="txtlv007" type="text" id="txtlv007" value="<?php echo $mots_lv0016->lv017;?>" tabindex="9" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)" />
							  </td>
							  <td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onkeyup="LoadPopupParentWH(this,'txtlv007','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" onfocus="LoadPopupParentWH(this,'txtlv007','ts_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
						  </tr>	
						   <tr>
							  <td  height="20"><?php echo $vLangArr[41];?></td>
							  <td  height="20"><select name="rad" id="rad" tabindex="10">
							  <option value="0"><?php echo $vLangArr[43];?></option>
							  <option value="1"><?php echo $vLangArr[44];?></option>
							  <option value="2"><?php echo $vLangArr[45];?></option>
							    </select></td>
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
div.innerHTML='<?php echo $vLangArr[42];?>';	
</script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>