<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/rp_lv0015.php");
require_once("../clsall/tc_lv0013.php");

/////////////init object//////////////
$morp_lv0015=new  rp_lv0015($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0015');
$motc_lv0013=new  tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
/////////////init object//////////////
$motc_lv0013->LV_LoadActiveID();
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TC0036.txt",$plang);
$morp_lv0015->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0015->ArrPush[0]=$vLangArr[17];
$morp_lv0015->ArrPush[1]=$vLangArr[18];
$morp_lv0015->ArrPush[2]=$vLangArr[20];
$morp_lv0015->ArrPush[3]=$vLangArr[21];
$morp_lv0015->ArrPush[4]=$vLangArr[22];
$morp_lv0015->ArrPush[5]=$vLangArr[23];
$morp_lv0015->ArrPush[6]=$vLangArr[24];
$morp_lv0015->ArrPush[7]=$vLangArr[25];
$morp_lv0015->ArrPush[8]=$vLangArr[26];
$morp_lv0015->ArrPush[9]=$vLangArr[27];
$morp_lv0015->ArrPush[10]=$vLangArr[28];
$morp_lv0015->ArrPush[11]=$vLangArr[40];
$morp_lv0015->ArrPush[12]=$vLangArr[41];
$morp_lv0015->ArrFunc[0]='//Function';
$morp_lv0015->ArrFunc[1]=$vLangArr[2];
$morp_lv0015->ArrFunc[2]=$vLangArr[4];
$morp_lv0015->ArrFunc[3]=$vLangArr[6];
$morp_lv0015->ArrFunc[4]=$vLangArr[7];
$morp_lv0015->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$morp_lv0015->ArrFunc[6]=GetLangExcept('Apr',$plang);
$morp_lv0015->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$morp_lv0015->ArrFunc[8]=$vLangArr[10];
$morp_lv0015->ArrFunc[9]=$vLangArr[12];
$morp_lv0015->ArrFunc[10]=$vLangArr[0];
$morp_lv0015->ArrFunc[11]=$vLangArr[31];
$morp_lv0015->ArrFunc[12]=$vLangArr[32];
$morp_lv0015->ArrFunc[13]=$vLangArr[33];
$morp_lv0015->ArrFunc[14]=$vLangArr[34];
$morp_lv0015->ArrFunc[15]=$vLangArr[35];
////Other
$morp_lv0015->ArrOther[1]=$vLangArr[29];
$morp_lv0015->ArrOther[2]=$vLangArr[30];
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","RP0008.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$morp_lv0015->lv002=getyear($vNow)."-".getmonth($vNow)."-"."01";
$morp_lv0015->lv003=$vNow;
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];

if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0015->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0015');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$morp_lv0015->ListView;
$curPage = $morp_lv0015->CurPage;
$maxRows =$morp_lv0015->MaxRows;
$vOrderList=$morp_lv0015->ListOrder;
$vSortNum=$morp_lv0015->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$morp_lv0015->SaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0015',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);
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
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<?php
if($morp_lv0015->GetView()==1)
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
	o.txtlv002.value=getChecked(o.chklv002.value,'chklv002');
	o.txtlv003.value=getChecked(o.chklv003.value,'chklv003');
	//o.txtlv004.value=getChecked(o.chklv004.value,'chklv004');
	o.action="rp_lv0015?func=rpt"
	o.submit();
}
function Refresh()
{
	
}
//-->
</script>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft">
					 <form name="frmchoose" method="post" id="frmchoose" enctype="multipart/form-data">
					 <table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								<div><div style="float:right"><?php echo $morp_lv0015->ListFieldSave('document.frmchoose',$vFieldList, $maxRows,$vOrderList,$vSortNum);?>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</div></div></td>	
							</tr>
						</table>
                	  <input name="txtStringID" type="hidden" id="txtStringID" />
                  	 <input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
                        <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
                  </form>
					<form  method="get" name="frmprint" id="frmprint" enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>" />
                    	<input name="txtStringID" type="hidden" id="txtStringID" />
                        <input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
					 <table width="100%" border="0" align="center" class="table1">
							<tr>
							  <td width="166"  height="20"><?php echo $vLangArr[1];?></td>
							  <td width="178"  height="20"><select name="txtlv001" id="txtlv001"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)"><?php echo $morp_lv0015->LV_LinkField('lv003',$motc_lv0013->lv001);?>
							 
                              </select>							    </td>
							</tr>
                             <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[2];?></td>
							  <td  height="20"><input name="txtlv002" type="hidden" id="txtlv002" value="<?php echo $morp_lv0015->lv002;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $morp_lv0015->GetBuilCheckListDep($morp_lv0015->lv002,'chklv002',10,'hr_lv0002','lv003');?></td>
						    </tr>	
							<!-- <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[7];?></td>
							  <td  height="20"><input name="txtlv004" type="hidden" id="txtlv004" value="<?php echo $morp_lv0015->lv004;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $morp_lv0015->GetBuilCheckList($morp_lv0015->lv002,'chklv004',10,'tc_lv0024','lv002');?></td>
						    </tr>-->	
						  <tr>
							  <td  height="20"><?php echo $vLangArr[3];?></td>
							  <td  height="20"><input name="txtlv003" type="hidden" id="txtlv003" value="<?php echo $morp_lv0015->lv008;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $morp_lv0015->GetBuilCheckList($morp_lv0015->lv003,'chklv003',10,'hr_lv0022');?></td>
					   </tr>	
					   <tr>
							  <td  height="20" ><?php echo $vLangArr[4];?></td><td><select name="txtopt" id="txtopt"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)"><option value="0"><?php echo $vLangArr[5];?></option>
                              <option value="1"><?php echo $vLangArr[6];?></option>
							 
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
