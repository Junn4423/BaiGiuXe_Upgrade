<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/rp_lv0016.php");

/////////////init object//////////////
$morp_lv0016=new  rp_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0016');
/////////////init object//////////////

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","RP0009.txt",$plang);
$morp_lv0016->ArrFunc[11]=$vLangArr[65];
$morp_lv0016->ArrPush[0]=$vLangArr[17];
$morp_lv0016->ArrPush[1]=$vLangArr[18];
$morp_lv0016->ArrPush[2]=$vLangArr[19];
$morp_lv0016->ArrPush[3]=$vLangArr[20];
$morp_lv0016->ArrPush[4]=$vLangArr[21];
$morp_lv0016->ArrPush[5]=$vLangArr[22];
$morp_lv0016->ArrPush[6]=$vLangArr[23];
$morp_lv0016->ArrPush[7]=$vLangArr[24];
$morp_lv0016->ArrPush[8]=$vLangArr[25];
$morp_lv0016->ArrPush[9]=$vLangArr[26];
$morp_lv0016->ArrPush[10]=$vLangArr[27];
$morp_lv0016->ArrPush[11]=$vLangArr[28];
$morp_lv0016->ArrPush[12]=$vLangArr[29];
$morp_lv0016->ArrPush[13]=$vLangArr[30];
$morp_lv0016->ArrPush[14]=$vLangArr[31];
$morp_lv0016->ArrPush[15]=$vLangArr[32];
$morp_lv0016->ArrPush[16]=$vLangArr[33];
$morp_lv0016->ArrPush[17]=$vLangArr[34];
$morp_lv0016->ArrPush[18]=$vLangArr[35];
$morp_lv0016->ArrPush[19]=$vLangArr[36];
$morp_lv0016->ArrPush[20]=$vLangArr[37];
$morp_lv0016->ArrPush[21]=$vLangArr[38];
$morp_lv0016->ArrPush[22]=$vLangArr[39];
$morp_lv0016->ArrPush[23]=$vLangArr[40];
$morp_lv0016->ArrPush[24]=$vLangArr[41];
$morp_lv0016->ArrPush[25]=$vLangArr[42];
$morp_lv0016->ArrPush[26]=$vLangArr[43];
$morp_lv0016->ArrPush[27]=$vLangArr[44];
$morp_lv0016->ArrPush[28]=$vLangArr[45];
$morp_lv0016->ArrPush[29]=$vLangArr[46];
$morp_lv0016->ArrPush[30]=$vLangArr[47];
$morp_lv0016->ArrPush[31]=$vLangArr[48];
$morp_lv0016->ArrPush[32]=$vLangArr[49];
$morp_lv0016->ArrPush[33]=$vLangArr[50];
$morp_lv0016->ArrPush[34]=$vLangArr[51];
$morp_lv0016->ArrPush[35]=$vLangArr[52];
$morp_lv0016->ArrPush[36]=$vLangArr[53];
$morp_lv0016->ArrPush[37]=$vLangArr[54];
$morp_lv0016->ArrPush[38]=$vLangArr[55];
$morp_lv0016->ArrPush[39]=$vLangArr[56];
$morp_lv0016->ArrPush[40]=$vLangArr[57];
$morp_lv0016->ArrPush[41]=$vLangArr[58];
$morp_lv0016->ArrPush[42]=$vLangArr[59];
$morp_lv0016->ArrPush[43]=$vLangArr[60];
$morp_lv0016->ArrPush[44]=$vLangArr[61];
$morp_lv0016->ArrPush[45]=$vLangArr[62];
$morp_lv0016->ArrPush[46]=$vLangArr[71];
$morp_lv0016->ArrPush[47]=$vLangArr[72];
$morp_lv0016->ArrPush[48]=$vLangArr[73];
$morp_lv0016->ArrPush[49]=$vLangArr[74];
$morp_lv0016->ArrPush[50]=$vLangArr[75];
$morp_lv0016->ArrPush[51]=$vLangArr[76];
$morp_lv0016->ArrPush[52]=$vLangArr[78];
$morp_lv0016->ArrPush[53]=$vLangArr[79];
$morp_lv0016->ArrPush[61]=$vLangArr[80];
$morp_lv0016->ArrPush[62]=$vLangArr[81];
$morp_lv0016->ArrPush[63]=$vLangArr[82];
$morp_lv0016->ArrPush[64]=$vLangArr[83];
$morp_lv0016->ArrPush[65]=$vLangArr[84];
$morp_lv0016->ArrPush[66]=$vLangArr[85];
$morp_lv0016->ArrPush[67]=$vLangArr[86];
$morp_lv0016->ArrPush[100]='Code Machine';
$morp_lv0016->ArrPush[103]='AL vào làm';
$morp_lv0016->ArrPush[104]='AL/Năm';
$morp_lv0016->ArrPush[151]='Tiền SN';


$morp_lv0016->ArrFunc[1]=$vLangArr[2];
$morp_lv0016->ArrFunc[2]=$vLangArr[4];
$morp_lv0016->ArrFunc[3]=$vLangArr[6];
$morp_lv0016->ArrFunc[4]=$vLangArr[7];
$morp_lv0016->ArrFunc[8]=$vLangArr[10];
$morp_lv0016->ArrFunc[9]=$vLangArr[12];
$morp_lv0016->ArrFunc[10]=$vLangArr[0];
$morp_lv0016->ArrFunc[11]=$vLangArr[65];
$morp_lv0016->ArrFunc[12]=$vLangArr[66];
$morp_lv0016->ArrFunc[13]=$vLangArr[67];
$morp_lv0016->ArrFunc[14]=$vLangArr[68];
$morp_lv0016->ArrFunc[15]=$vLangArr[69];
//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$morp_lv0016->lv009="0,1,5";
$lvDateFrom=getyear($vNow)."-01-"."01";
$lvDateTo=$vNow;
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];
$vOrderList=$_POST['txtOrderList'];
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0016->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0016');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$morp_lv0016->ListView;
$curPage = $morp_lv0016->CurPage;
$maxRows =$morp_lv0016->MaxRows;
$vOrderList=$morp_lv0016->ListOrder;
$vSortNum=$morp_lv0016->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$morp_lv0016->SaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0016',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);
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
if($morp_lv0016->GetApr()==0)	$morp_lv0016->lv029=$morp_lv0016->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
if($maxRows ==0) $maxRows = 10;

$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<?php
if($morp_lv0016->GetView()==1)
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
 	var o=document.frmchoose;
	o.txtlv029.value=getChecked(o.chklv029.value,'chklv029');	
	o.txtlv028.value=getChecked(o.chklv028.value,'chklv028');
	o.txtlv042.value=getChecked(o.chklv042.value,'chklv042');
	o.txtlv009.value=getChecked(o.chklv009.value,'chklv009');
	o.txtlv051.value=getChecked(o.chklv051.value,'chklv051');
	o.target="_blank";
	o.action="rp_lv0016/?func="+o.childfunc.value+"&lang=<?php echo $plang;?>";
	o.submit();
	o.target="_self";
	o.action="";
}
function Refresh()
{
	
}
//-->
</script>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form  method="post" name="frmchoose" id="frmchoose" enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>" />
					<input name="txtStringID" type="hidden" id="txtStringID" />
                        <input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
					 <table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								<div><div style="float:right"><?php echo $morp_lv0016->ListFieldSave('document.frmchoose',$vFieldList, $maxRows,$vOrderList,$vSortNum);?></div></div>	
							</tr>
                             <tr>
							  <td width="166"  height="20" valign="top"><?php echo $vLangArr[47];?></td>
							  <td width="178"  height="20">
								<div style="width:100%;height:150px;position:relative;overflow: auto;top:0px;">
								<?php echo $morp_lv0016->GetBuilCheckListDept($morp_lv0016->lv002,'chklv029',10,'hr_lv0002','lv003',$morp_lv0016->lv029);?></td>
								</div>
							</tr>	
						  <tr>
							  <td  height="20"><?php echo $vLangArr[27];?></td>
							  <td  height="20"> <div style="width:100%;height:150px;position:relative;overflow: auto;top:0px;"><?php echo $morp_lv0016->GetBuilCheckList('0,1,4,5,6,7','chklv009',10,'hr_lv0022');?></div></td>
					   </tr>	
                       <tr>
							  <td  height="20"><?php echo $vLangArr[46];?></td>
							  <td  height="20"><div style="width:100%;height:150px;position:relative;overflow: auto;top:0px;"> <?php echo $morp_lv0016->GetBuilCheckList($morp_lv0016->lv028,'chklv028',10,'hr_lv0005');?></div></td>
					   </tr>	
					    <tr>
							  <td  height="20"><?php echo $vLangArr[60];?></td>
							  <td  height="20"><div style="width:100%;height:150px;position:relative;overflow: auto;top:0px;"><?php echo $morp_lv0016->GetBuilCheckList($morp_lv0016->lv042,'chklv042',10,'hr_lv0121');?></div></td>
					   </tr>	
					     <tr>
							  <td  height="20"><?php echo $vLangArr[78];?></td>
							  <td  height="20"><div style="width:100%;height:150px;position:relative;overflow: auto;top:0px;"><?php echo $morp_lv0016->GetBuilCheckList($morp_lv0016->lv051,'chklv051',10,'hr_lv0013');?></div></td>
					   </tr>	
					   		<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv001" type="text" id="txtlv001" value="<?php echo $morp_lv0016->lv004;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)" /><br><table><tr><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv001','hr_lv0020','concat(lv004,lv003,lv002)')" onFocus="LoadPopupParent(this,'txtlv001','hr_lv0020','concat(lv004,lv003,lv002)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
					  		</tr>	
                              <tr>
				      <td  height="20"><?php echo $vLangArr[1];?></td>
				      <td  height="20"><input name="txtdatefrom" type="text" id="txtdatefrom" value="<?php echo $morp_lv0016->FormatView($lvDateFrom,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.txtdatefrom);return false;" /></span></td>
						  </tr>		
						  <tr>
				      <td  height="20"><?php echo $vLangArr[2];?></td>
				      <td  height="20"><input name="txtdateto" type="text" id="txtdateto" value="<?php echo $morp_lv0016->FormatView($lvDateTo,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmchoose.txtdateto);return false;" /></span></td>
						  </tr>		
					<tr>
					  <td  height="20" ><?php echo $vLangArr[66];?></td><td>
					  <select name="childfunc" id="childfunc"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
					  <option value="pdf"><?php echo $vLangArr[69];?></option>
					  <option value="excel"><?php echo $vLangArr[67];?></option>
					  <option value="word"><?php echo $vLangArr[68];?></option>							 
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
            alt="RptWH" title="<?php echo $vLangArr[8];?>" 
            name="RptWH" border="0" align="middle" id="RptWH" /> <?php echo $vLangArr[8];?></a></TD>
                    <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[10];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[10];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>  
					<input name="txtlv029" type="hidden" id="txtlv029" value="<?php echo $morp_lv0016->lv002;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
					<input name="txtlv009" type="hidden" id="txtlv009" value="<?php echo $morp_lv0016->lv009;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
					<input name="txtlv028" type="hidden" id="txtlv028" value="<?php echo $morp_lv0016->lv028;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
					<input name="txtlv042" type="hidden" id="txtlv042" value="<?php echo $morp_lv0016->lv042;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
					<input name="txtlv051" type="hidden" id="txtlv051" value="<?php echo $morp_lv0016->lv051;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
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