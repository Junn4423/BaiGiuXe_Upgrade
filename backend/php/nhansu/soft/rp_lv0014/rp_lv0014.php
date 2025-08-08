<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/rp_lv0014.php");
require_once("../clsall/hr_lv0020.php");

/////////////init object//////////////
$morp_lv0014=new  rp_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0014');
$mohr_lv0020=new  hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
/////////////init object//////////////
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TC0044.txt",$plang);
$morp_lv0014->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0014->ArrPush[0]=$vLangArr[16];
$morp_lv0014->ArrPush[1]=$vLangArr[18];
$morp_lv0014->ArrPush[2]=$vLangArr[19];
$morp_lv0014->ArrPush[3]=$vLangArr[20];
$morp_lv0014->ArrPush[4]=$vLangArr[21];
$morp_lv0014->ArrPush[5]=$vLangArr[22];
$morp_lv0014->ArrPush[6]=$vLangArr[23];
$morp_lv0014->ArrPush[7]=$vLangArr[24];
$morp_lv0014->ArrPush[8]=$vLangArr[25];
$morp_lv0014->ArrPush[9]=$vLangArr[26];
$morp_lv0014->ArrPush[10]=$vLangArr[27];
$morp_lv0014->ArrPush[11]=$vLangArr[28];
$morp_lv0014->ArrPush[12]=$vLangArr[29];
$morp_lv0014->ArrPush[13]=$vLangArr[30];
$morp_lv0014->ArrPush[14]=$vLangArr[31];
$morp_lv0014->ArrPush[15]=$vLangArr[32];
$morp_lv0014->ArrPush[16]=$vLangArr[33];
$morp_lv0014->ArrPush[17]=$vLangArr[34];
$morp_lv0014->ArrPush[18]=$vLangArr[35];
$morp_lv0014->ArrPush[19]=$vLangArr[36];
$morp_lv0014->ArrPush[20]=$vLangArr[37];
$morp_lv0014->ArrPush[21]=$vLangArr[38];
$morp_lv0014->ArrPush[22]=$vLangArr[39];
$morp_lv0014->ArrPush[23]=$vLangArr[40];
$morp_lv0014->ArrPush[24]=$vLangArr[41];
$morp_lv0014->ArrPush[25]=$vLangArr[42];
$morp_lv0014->ArrPush[26]=$vLangArr[43];
$morp_lv0014->ArrPush[27]=$vLangArr[44];
$morp_lv0014->ArrPush[28]=$vLangArr[45];
$morp_lv0014->ArrPush[29]=$vLangArr[46];
$morp_lv0014->ArrPush[30]=$vLangArr[47];
$morp_lv0014->ArrPush[31]=$vLangArr[48];
$morp_lv0014->ArrPush[32]=$vLangArr[49];
$morp_lv0014->ArrPush[33]=$vLangArr[50];
$morp_lv0014->ArrPush[34]=$vLangArr[51];
$morp_lv0014->ArrPush[35]=$vLangArr[52];
$morp_lv0014->ArrPush[36]=$vLangArr[53];
$morp_lv0014->ArrPush[37]=$vLangArr[54];
$morp_lv0014->ArrPush[38]=$vLangArr[55];
$morp_lv0014->ArrPush[39]=$vLangArr[56];
$morp_lv0014->ArrPush[40]=$vLangArr[57];
$morp_lv0014->ArrPush[41]=$vLangArr[58];
$morp_lv0014->ArrPush[42]=$vLangArr[59];
$morp_lv0014->ArrPush[43]=$vLangArr[60];
$morp_lv0014->ArrPush[44]=$vLangArr[61];
$morp_lv0014->ArrPush[45]=$vLangArr[62];
$morp_lv0014->ArrPush[46]=$vLangArr[63];
$morp_lv0014->ArrPush[47]=$vLangArr[64];
$morp_lv0014->ArrPush[48]=$vLangArr[65];
$morp_lv0014->ArrPush[49]=$vLangArr[66];
$morp_lv0014->ArrPush[50]=$vLangArr[67];
$morp_lv0014->ArrPush[51]=$vLangArr[68];
$morp_lv0014->ArrPush[52]=$vLangArr[69];
$morp_lv0014->ArrPush[53]=$vLangArr[70];
$morp_lv0014->ArrPush[54]=$vLangArr[71];
$morp_lv0014->ArrPush[55]=$vLangArr[72];
$morp_lv0014->ArrPush[56]=$vLangArr[73];
$morp_lv0014->ArrPush[57]=$vLangArr[74];
$morp_lv0014->ArrPush[58]=$vLangArr[75];
$morp_lv0014->ArrPush[59]=$vLangArr[76];
$morp_lv0014->ArrPush[60]=$vLangArr[77];
$morp_lv0014->ArrPush[61]=$vLangArr[78];
$morp_lv0014->ArrPush[62]=$vLangArr[79];

$morp_lv0014->ArrFunc[0]='//Function';
$morp_lv0014->ArrFunc[1]=$vLangArr[55];
$morp_lv0014->ArrFunc[2]=$vLangArr[4];
$morp_lv0014->ArrFunc[3]=$vLangArr[6];
$morp_lv0014->ArrFunc[4]=$vLangArr[7];
$morp_lv0014->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$morp_lv0014->ArrFunc[6]=GetLangExcept('Apr',$plang);
$morp_lv0014->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$morp_lv0014->ArrFunc[8]=$vLangArr[10];
$morp_lv0014->ArrFunc[9]=$vLangArr[12];
$morp_lv0014->ArrFunc[10]=$vLangArr[0];
$morp_lv0014->ArrFunc[11]=$vLangArr[82];
$morp_lv0014->ArrFunc[12]=$vLangArr[83];
$morp_lv0014->ArrFunc[13]=$vLangArr[84];
$morp_lv0014->ArrFunc[14]=$vLangArr[85];
$morp_lv0014->ArrFunc[15]=$vLangArr[86];

////Other
$morp_lv0014->ArrOther[1]=$vLangArr[80];
$morp_lv0014->ArrOther[2]=$vLangArr[81];

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","RP0007.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$morp_lv0014->lv002=getyear($vNow)."-".getmonth($vNow)."-"."01";
$morp_lv0014->lv003=$vNow;
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$lvDateFrom=getyear($vNow)."-".getmonth($vNow)."-"."01";
$lvDateTo=$vNow;
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0014->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0014');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$morp_lv0014->ListView;
$curPage = $morp_lv0014->CurPage;
$maxRows =$morp_lv0014->MaxRows;
$vOrderList=$morp_lv0014->ListOrder;
$vSortNum=$morp_lv0014->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$morp_lv0014->SaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0014',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

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
if($morp_lv0014->GetApr()==0){
$morp_lv0014->lv029=$morp_lv0014->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');	
if($morp_lv0014->lv029=="") $morp_lv0014->lv029="''";
}	

if($maxRows ==0) $maxRows = 10;
$mohr_lv0020->LV_LoadID(getInfor($_SESSION['ERPSOFV2RUserID'],2));
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<?php
if($morp_lv0014->GetView()==1)
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
 	var o=document.frmprint;
	o.target="_blank";
	<?php
	if($morp_lv0014->GetApr()>=1)
	{
	?>
	o.txtlv002.value=getChecked(o.chklv002.value,'chklv002');
	<?php
	}
	?>
	o.txtlvcomkh.value=getChecked(o.chklv005.value,'chklv005');
	o.txtlvcomnv.value=getChecked(o.chklv007.value,'chklv007');
	o.action="rp_lv0014?func=rpt"
	o.submit();
}
function Refresh()
{
	
}
//-->
</script>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft">
					<form  method="get" name="frmprint" id="frmprint" enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>" />
                    	<input name="txtStringID" type="hidden" id="txtStringID" />
                        <input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
					 <table width="100%" border="0" align="center" class="table1">
							 <tr>
				      <td  height="20" width="120"><?php echo $vLangArr[1]." from";?></td>
				      <td  height="20"><input name="txtdatefrom" type="text" id="txtdatefrom" value="<?php echo $morp_lv0014->FormatView($lvDateFrom,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmprint.txtdatefrom);return false;" /></span></td>
						  </tr>		
						  <tr>
				      <td  height="20"><?php echo $vLangArr[1]." to";?></td>
				      <td  height="20"><input name="txtdateto" type="text" id="txtdateto" value="<?php echo $morp_lv0014->FormatView($lvDateTo,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmprint.txtdateto);return false;" /></span></td>
						  </tr>		

                             <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[2];?></td>
							  <td  height="20"><input name="txtlv002" type="hidden" id="txtlv002" value="<?php echo $morp_lv0014->lv002;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $morp_lv0014->GetBuilCheckListDept($morp_lv0014->lv002,'chklv002',10,'hr_lv0002','lv003',$morp_lv0014->lv029);?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo 'Mã nhân viên';?></td>
							  <td  height="20"><table><tr><td><input name="txtlv004" type="text" id="txtlv004" value="<?php echo $morp_lv0011->lv004;?>" tabindex="9" maxlength="50" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" /></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv004_search" id="txtlv004_search" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv004','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopupParent(this,'txtlv004','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
					  		</tr>	
							<tr>
								<td><?php echo 'Cơm KH';?></td>
								<td>
								 <div style="max-height:200px;overflow:auto">
								<table align="center" class="lvtable">
									<input type="hidden" value="5" name="chklv005" id="chklv005"><input type="hidden"  name="txtlvcomkh" id="txtlvcomkh">
									<tbody><tr class="lvlinehtable1">
										<td width="1%"><input type="checkbox" tabindex="10" title="" value="1" id="chklv0050" ></td><td><?php echo 'T1';?></td>
										
									</tr>
									<tr class="lvlinehtable1">
										<td width="1%"><input type="checkbox" tabindex="10" title="" value="2" id="chklv0051" ></td><td><?php echo 'T2';?></td>
									</tr>
									<tr class="lvlinehtable1">
										<td width="1%"><input type="checkbox" tabindex="10" title="" value="3" id="chklv0052" ></td><td><?php echo 'T3';?></td>
									</tr>
									<tr class="lvlinehtable1">
										<td width="1%"><input type="checkbox" tabindex="10" title="" value="4" id="chklv0053" ></td><td><?php echo 'T4';?></td>
									</tr>
									<tr class="lvlinehtable1">
										<td width="1%"><input type="checkbox" tabindex="10" title="" value="5" id="chklv0054" ></td><td><?php echo 'T5';?></td>
									</tr>
									</tbody>
								</table>
								</div>
							</td>
						   </tr>	
						   
							<tr>
								<td><?php echo 'Cơm NV';?></td>
								<td>
								 <div style="max-height:200px;overflow:auto">
								<table align="center" class="lvtable">
									<input type="hidden" value="5" name="chklv007" id="chklv007"><input type="hidden"  name="txtlvcomnv" id="txtlvcomnv">
									<tbody><tr class="lvlinehtable1">
										<td width="1%"><input type="checkbox" tabindex="10" title="" value="1" id="chklv0070" ></td><td><?php echo 'T1';?></td>
										
									</tr>
									<tr class="lvlinehtable1">
										<td width="1%"><input type="checkbox" tabindex="10" title="" value="2" id="chklv0071" ></td><td><?php echo 'T2';?></td>
									</tr>
									<tr class="lvlinehtable1">
										<td width="1%"><input type="checkbox" tabindex="10" title="" value="3" id="chklv0072" ></td><td><?php echo 'T3';?></td>
									</tr>
									<tr class="lvlinehtable1">
										<td width="1%"><input type="checkbox" tabindex="10" title="" value="4" id="chklv0073" ></td><td><?php echo 'T4';?></td>
									</tr>
									<tr class="lvlinehtable1">
										<td width="1%"><input type="checkbox" tabindex="10" title="" value="5" id="chklv0074" ></td><td><?php echo 'T5';?></td>
									</tr>
									</tbody>
								</table>
								</div>
							</td>
						   </tr>
							 <tr>
							  <td  height="20" ><?php echo $vLangArr[3];?></td><td>
							  <select name="txtopt" id="txtopt"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
							  <option value="0"><?php echo 'Số và giờ ăn';?></option>
                              <option value="1" selected="selected"><?php echo 'Số lần ăn';?></option>
							  <option value="2" selected="selected"><?php echo 'Số và tiền ăn';?></option>
							  <option value="3" selected="selected"><?php echo 'Báo cao ăn cả năm';?></option>
							 
                              </select></td>
							</tr>
                            <tr>
							  <td  height="20" ><?php echo 'Kết xuất';?></td><td>
							  <select name="childfunc" id="childfunc"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
							  <option value="pdf"><?php echo 'Pdf';?></option>
                              <option value="excel"><?php echo 'Excel';?></option>
							  <option value="word"><?php echo 'Word';?></option>							 
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
div.innerHTML='<?php echo $vLangArr[0];?>';	
</script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php
} else {
	include("../permit.php");
}
?>
