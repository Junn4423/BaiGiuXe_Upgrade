<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/rp_lv0002.php");
require_once("../clsall/tc_lv0013.php");
/////////////init object//////////////
$morp_lv0002=new  rp_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0002');
$motc_lv0013=new  tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
/////////////init object//////////////
$vday=getday($motc_lv0013->DateCurrent);
$vmonth=getmonth($motc_lv0013->DateCurrent);
$vyear=getyear($motc_lv0013->DateCurrent);
if($vday>10)
	$motc_lv0013->LV_LoadActiveIDMonth($vmonth,$vyear);
else
{
	if($vmonth==1)
	{
		$vmonthprev='01';
		$vyearprev=($vyear-1);
	}
	else
	{
		$vmonthprev=Fillnum($vmonth-1,2);
		$vyearprev=$vyear;
	}
	$motc_lv0013->LV_LoadActiveIDMonth($vmonthprev,$vyearprev);
}
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("$vDir../","TC0044.txt",$plang);
if($plang=="") $plang="VN";
	$vLangArr1=GetLangFile("$vDir../","RP0010.txt",$plang);	
$morp_lv0002->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0002->ArrPush[0]=$vLangArr[16];
//$morp_lv0002->ArrPush[1]=$vLangArr[18];
$morp_lv0002->ArrPush[2]=$vLangArr[19];
$morp_lv0002->ArrPush[3]=$vLangArr[20];
$morp_lv0002->ArrPush[4]=$vLangArr[21];
$morp_lv0002->ArrPush[5]=$vLangArr[22];
$morp_lv0002->ArrPush[6]=$vLangArr[23];
$morp_lv0002->ArrPush[7]=$vLangArr[24];
$morp_lv0002->ArrPush[8]=$vLangArr[25];
$morp_lv0002->ArrPush[9]=$vLangArr[26];
$morp_lv0002->ArrPush[10]=$vLangArr[27];
$morp_lv0002->ArrPush[11]=$vLangArr[28];
$morp_lv0002->ArrPush[12]=$vLangArr[29];
$morp_lv0002->ArrPush[13]=$vLangArr[30];
$morp_lv0002->ArrPush[14]=$vLangArr[31];
$morp_lv0002->ArrPush[15]=$vLangArr[32];
$morp_lv0002->ArrPush[16]=$vLangArr[33];
$morp_lv0002->ArrPush[17]=$vLangArr[34];
$morp_lv0002->ArrPush[18]=$vLangArr[35];
$morp_lv0002->ArrPush[19]=$vLangArr[36];
$morp_lv0002->ArrPush[20]=$vLangArr[37];
$morp_lv0002->ArrPush[21]=$vLangArr[38];
$morp_lv0002->ArrPush[22]=$vLangArr[39];
$morp_lv0002->ArrPush[23]=$vLangArr[40];
$morp_lv0002->ArrPush[24]=$vLangArr[41];
$morp_lv0002->ArrPush[25]=$vLangArr[42];
$morp_lv0002->ArrPush[26]=$vLangArr[43];
$morp_lv0002->ArrPush[27]=$vLangArr[44];
$morp_lv0002->ArrPush[28]=$vLangArr[45];
$morp_lv0002->ArrPush[29]=$vLangArr[46];
$morp_lv0002->ArrPush[30]=$vLangArr[47];
$morp_lv0002->ArrPush[31]=$vLangArr[48];
$morp_lv0002->ArrPush[32]=$vLangArr[49];
$morp_lv0002->ArrPush[33]=$vLangArr[50];
$morp_lv0002->ArrPush[34]=$vLangArr[51];
$morp_lv0002->ArrPush[35]=$vLangArr[52];
$morp_lv0002->ArrPush[36]=$vLangArr[53];
$morp_lv0002->ArrPush[37]=$vLangArr[54];
$morp_lv0002->ArrPush[38]=$vLangArr[55];
$morp_lv0002->ArrPush[39]=$vLangArr[56];
$morp_lv0002->ArrPush[40]=$vLangArr[57];
$morp_lv0002->ArrPush[41]=$vLangArr[58];
$morp_lv0002->ArrPush[42]=$vLangArr[59];
$morp_lv0002->ArrPush[43]=$vLangArr[60];
$morp_lv0002->ArrPush[44]=$vLangArr[61];
$morp_lv0002->ArrPush[45]=$vLangArr[62];
$morp_lv0002->ArrPush[46]=$vLangArr[63];
$morp_lv0002->ArrPush[47]=$vLangArr[64];
$morp_lv0002->ArrPush[48]=$vLangArr[65];
$morp_lv0002->ArrPush[49]=$vLangArr[66];
$morp_lv0002->ArrPush[50]=$vLangArr[67];
$morp_lv0002->ArrPush[51]=$vLangArr[68];
$morp_lv0002->ArrPush[52]=$vLangArr[69];
$morp_lv0002->ArrPush[53]=$vLangArr[70];
$morp_lv0002->ArrPush[54]=$vLangArr[71];
$morp_lv0002->ArrPush[55]=$vLangArr[72];
$morp_lv0002->ArrPush[56]=$vLangArr[73];
$morp_lv0002->ArrPush[57]=$vLangArr[74];
$morp_lv0002->ArrPush[58]=$vLangArr[75];
$morp_lv0002->ArrPush[59]=$vLangArr[76];
$morp_lv0002->ArrPush[60]=$vLangArr[77];
$morp_lv0002->ArrPush[61]=$vLangArr[78];
$morp_lv0002->ArrPush[62]=$vLangArr[79];
$morp_lv0002->ArrPush[63]=$vLangArr[80];
$morp_lv0002->ArrPush[64]=$vLangArr[81];
$morp_lv0002->ArrPush[65]=$vLangArr[82];
$morp_lv0002->ArrPush[66]=$vLangArr[83];
$morp_lv0002->ArrPush[67]=$vLangArr[84];
$morp_lv0002->ArrPush[68]=$vLangArr[85];
$morp_lv0002->ArrPush[69]=$vLangArr[86];
$morp_lv0002->ArrPush[70]=$vLangArr[87];
$morp_lv0002->ArrPush[71]=$vLangArr[88];
$morp_lv0002->ArrPush[72]=$vLangArr[89];
$morp_lv0002->ArrPush[73]=$vLangArr[90];
$morp_lv0002->ArrPush[74]=$vLangArr[91];
$morp_lv0002->ArrPush[75]=$vLangArr[102];
$morp_lv0002->ArrPush[76]=$vLangArr[103];
$morp_lv0002->ArrPush[77]=$vLangArr[104];
$morp_lv0002->ArrPush[78]=$vLangArr[105];
$morp_lv0002->ArrPush[79]=$vLangArr[106];
$morp_lv0002->ArrPush[80]=$vLangArr[107];
$morp_lv0002->ArrPush[81]=$vLangArr[108];
$morp_lv0002->ArrPush[82]=$vLangArr[109];
$morp_lv0002->ArrPush[83]=$vLangArr[110];
$morp_lv0002->ArrPush[84]=$vLangArr[111];
$morp_lv0002->ArrPush[85]=$vLangArr[112];
$morp_lv0002->ArrPush[86]=$vLangArr[113];
$morp_lv0002->ArrPush[87]=$vLangArr[114];
$morp_lv0002->ArrPush[88]=$vLangArr[115];
$morp_lv0002->ArrPush[89]=$vLangArr[116];
$morp_lv0002->ArrPush[90]=$vLangArr[117];

$morp_lv0002->ArrPush[91]=$vLangArr[121];
$morp_lv0002->ArrPush[92]=$vLangArr[122];
$morp_lv0002->ArrPush[93]=$vLangArr[123];
$morp_lv0002->ArrPush[94]=$vLangArr[124];
$morp_lv0002->ArrPush[95]=$vLangArr[125];
$morp_lv0002->ArrPush[96]=$vLangArr[126];
$morp_lv0002->ArrPush[97]=$vLangArr[127];
$morp_lv0002->ArrPush[98]=$vLangArr[128];

$morp_lv0002->ArrPush[101]=$vLangArr[120];
$morp_lv0002->ArrPush[102]='Mã KT';

$morp_lv0002->ArrFunc[0]='//Function';
$morp_lv0002->ArrFunc[1]=$vLangArr[55];
$morp_lv0002->ArrFunc[2]=$vLangArr[4];
$morp_lv0002->ArrFunc[3]=$vLangArr[6];
$morp_lv0002->ArrFunc[4]=$vLangArr[7];
$morp_lv0002->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$morp_lv0002->ArrFunc[6]=GetLangExcept('Apr',$plang);
$morp_lv0002->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$morp_lv0002->ArrFunc[8]=$vLangArr[10];
$morp_lv0002->ArrFunc[9]=$vLangArr[12];
$morp_lv0002->ArrFunc[10]=$vLangArr[0];
$morp_lv0002->ArrFunc[11]=$vLangArr[94];
$morp_lv0002->ArrFunc[12]=$vLangArr[95];
$morp_lv0002->ArrFunc[13]=$vLangArr[96];
$morp_lv0002->ArrFunc[14]=$vLangArr[97];
$morp_lv0002->ArrFunc[15]=$vLangArr[98];
////Other
$morp_lv0002->ArrOther[1]=$vLangArr[92];
$morp_lv0002->ArrOther[2]=$vLangArr[93];

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","RP0001.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$morp_lv0002->lv002=getyear($vNow)."-".getmonth($vNow)."-"."01";
$morp_lv0002->lv003=$vNow;
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];

if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0002->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$morp_lv0002->ListView;
$curPage = $morp_lv0002->CurPage;
$maxRows =$morp_lv0002->MaxRows;
$vOrderList=$morp_lv0002->ListOrder;
$vSortNum=$morp_lv0002->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$morp_lv0002->SaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0002',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

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
if($morp_lv0002->GetApr()==0)	$morp_lv0002->lv029=$morp_lv0002->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');

if($morp_lv0002->GetView()==1)
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
	o.txtlv839.value=getChecked(o.chklv839.value,'chklv839');
	o.txtABC.value=(o.chklv0050.checked)?'1':'0';
	if(o.txtbanklist.value=='2')
	{
		o.func.value='rpt1';
		o.action="rp_lv0002?func=rpt1"
	}
	else if(o.txtbanklist.value=='3')
	{
		o.func.value='rpt2';
		o.action="rp_lv0002?func=rpt2"
	}
	else if(o.txtbanklist.value=='4')
	{
		o.func.value='rpt4';
		o.action="rp_lv0002?func=rpt4"
	}
	else if(o.txtbanklist.value=='6')
	{
		o.func.value='rpt6';
		o.action="rp_lv0002?func=rpt6"
	}
	else if(o.txtbanklist.value=='7')
	{
		o.func.value='rpt7';
		o.action="rp_lv0002?func=rpt7"
	}
	else if(o.txtbanklist.value=='8')
	{
		o.func.value='rpt8';
		o.action="rp_lv0002?func=rpt8"
	}
	else if(o.txtbanklist.value=='9')
	{
		o.func.value='rpt9';
		o.action="rp_lv0002?func=rpt9"
	}
	else if(o.txtbanklist.value=='19')
	{
		o.func.value='rpt19';
		o.action="rp_lv0002?func=rpt19"
	}
	else if(o.txtbanklist.value=='10')
	{
		o.func.value='rpt10';
		o.action="rp_lv0002?func=rpt10"
	}
	else if(o.txtbanklist.value=='11')
	{
		o.func.value='rpt11';
		o.action="rp_lv0002?func=rpt11"
	}
	else if(o.txtbanklist.value=='12')
	{
		o.func.value='rpt12';
		o.action="rp_lv0002?func=rpt12"
	}
	else if(o.txtbanklist.value=='13')
	{
		o.func.value='rpt13';
		o.action="rp_lv0002?func=rpt13"
	}
	else if(o.txtbanklist.value=='14')
	{
		o.func.value='rpt14';
		o.action="rp_lv0002?func=rpt14"
	}
	else if(o.txtbanklist.value=='15')
	{
		o.func.value='rpt15';
		o.action="rp_lv0002?func=rpt15"
	}
	else if(o.txtbanklist.value=='16')
	{
		o.func.value='rpt16';
		o.action="rp_lv0002?func=rpt16"
	}
	else if(o.txtbanklist.value=='21')
	{
		o.func.value='rpt21';
		o.action="rp_lv0002?func=rpt21"
	}
	else if(o.txtbanklist.value=='22')
	{
		o.func.value='rpt22';
		o.action="rp_lv0002?func=rpt22"
	}
	else if(o.txtbanklist.value=='23')
	{
		o.func.value='rpt23';
		o.action="rp_lv0002?func=rpt23"
	}
	else if(o.txtbanklist.value=='24')
	{
		o.func.value='rpt24';
		o.action="rp_lv0002?func=rpt24"
	}
	else if(o.txtbanklist.value=='25')
	{
		o.func.value='rpt25';
		o.action="rp_lv0002?func=rpt25"
	}
	else if(o.txtbanklist.value=='26')
	{
		o.func.value='rpt26';
		o.action="rp_lv0002?func=rpt26"
	}
	else if(o.txtbanklist.value=='30')
	{
		o.func.value='rpt30';
		o.action="rp_lv0002?func=rpt30"
	}
	else if(o.txtbanklist.value=='31')
	{
		o.func.value='rpt31';
		o.action="rp_lv0002?func=rpt31"
	}
	else if(o.txtbanklist.value=='32')
	{
		o.func.value='rpt32';
		o.action="rp_lv0002?func=rpt32"
	}
	else if(o.txtbanklist.value=='33')
	{
		o.func.value='rpt33';
		o.action="rp_lv0002?func=rpt33"
	}
	else if(o.txtbanklist.value=='40')
	{
		o.func.value='rpt40';
		o.action="rp_lv0002?func=rpt40"
	}
	else if(o.txtbanklist.value=='41')
	{
		o.func.value='rpt41';
		o.action="rp_lv0002?func=rpt41"
	}
	else if(o.txtbanklist.value=='42')
	{
		o.func.value='rpt42';
		o.action="rp_lv0002?func=rpt42"
	}
	else if(o.txtbanklist.value=='43')
	{
		o.func.value='rpt43';
		o.action="rp_lv0002?func=rpt43"
	}
	else if(o.txtbanklist.value=='67')
	{
		o.func.value='rpt67';
		o.action="rp_lv0002?func=rpt67"
	}
	else if(o.txtbanklist.value=='44')
	{
		o.func.value='rpt44';
		o.action="rp_lv0002?func=rpt44"
	}
	else if(o.txtbanklist.value=='51')
	{
		o.func.value='rpt51';
		o.action="rp_lv0002?func=rpt51"
	}
	else if(o.txtbanklist.value=='52')
	{
		o.func.value='rpt52';
		o.action="rp_lv0002?func=rpt52"
	}
	else if(o.txtbanklist.value=='53')
	{
		o.func.value='rpt53';
		o.action="rp_lv0002?func=rpt53"
	}
	else if(o.txtbanklist.value=='68')
	{
		o.func.value='rpt68';
		o.action="rp_lv0002?func=rpt68"
	}
	else if(o.txtbanklist.value=='56')
	{
		o.func.value='rpt56';
		o.action="rp_lv0002?func=rpt56"
	}
	else if(o.txtbanklist.value=='58')
	{
		o.func.value='rpt58';
		o.action="rp_lv0002?func=rpt58"
	}
	else
	{
		o.func.value='rpt';
	o.action="rp_lv0002?func=rpt&lang=EN"
	}
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
								<div><div style="float:right"><?php echo $morp_lv0002->ListFieldSave('document.frmchoose',$vFieldList, $maxRows,$vOrderList,$vSortNum);?>
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
							  <td width="166"  height="20"><?php echo $vLangArr1[0];?></td>
							  <td width="178"  height="20"><select name="txtlv001" id="txtlv001"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)"><?php echo $morp_lv0002->LV_LinkField('lv001',$motc_lv0013->lv001);?>
							 
                              </select>							    </td>
							</tr>
                             <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr1[1];?></td>
							  <td  height="20">
							  <div style="height:200px;overflow:auto">
							  <input name="txtlv002" type="hidden" id="txtlv002" value="<?php echo $morp_lv0002->lv002;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $morp_lv0002->GetBuilCheckListDept($morp_lv0002->lv002,'chklv002',10,'hr_lv0002','lv003',$morp_lv0002->lv029);?>
							  </div>
							  </td>
						    </tr>	
						    <tr>
							  <td  height="20" width="166"><?php echo 'Lấy phòng ban con';?></td>
							  <td  height="20"><input type="checkbox" value="1" name="isChildCheck" checked="true" /></td>
							</tr>
							<tr>
							  <td  height="20" width="166"><?php echo 'Lấy phòng ban theo hợp đồng - dành cho báo cáo lương công trình';?></td>
							  <td  height="20"><input type="checkbox" value="1" name="isHDCheck" /></td>
							</tr>
							<tr>
							  <td  height="20"><?php echo 'Nhân viên';?></td>
							  <td  height="20"><table><tr><td><input name="txtlv004" type="text" id="txtlv004" value="<?php echo $morp_lv0011->lv004;?>" tabindex="9" maxlength="50" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" /></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv004_search" id="txtlv004_search" style="width:200px" onKeyUp="LoadPopupParent(this,'txtlv004','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopupParent(this,'txtlv004','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
					  		</tr>
							<!--
						  <tr>
							  <td  height="20"><?php echo $vLangArr[3];?></td>
							  <td  height="20"><input name="txtlv003" type="hidden" id="txtlv003" value="<?php echo $morp_lv0002->lv008;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $morp_lv0002->GetBuilCheckList($morp_lv0002->lv003,'chklv003',10,'hr_lv0022');?></td>
					   </tr>	-->
					   <tr>
							  <td  height="20" width="166"><?php echo 'Chọn công ty';?></td>
							  <td  height="20">
							  	  <select name="isBrand" id="isBrand"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
									<option value=""><?php echo 'Cả hai';?></option>
									<option value="SOF"><?php echo 'CTY CP MINH PHƯƠNG';?></option>
									<option value="TNHHMP"><?php echo 'CTY TNHH MINH PHUONG';?></option>
                             	 </select>
							 </td>
							</tr>
					   <tr>
							  <td  height="20" ><?php echo $vLangArr1[2];?></td><td>
							  <select name="txtopt" id="txtopt"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
							  <option value="0"><?php echo $vLangArr1[3];?></option>
                              <option value="1"><?php echo $vLangArr1[4];?></option>
							 
                              </select></td>
							</tr>
							
                            <tr>
							  <td  height="20" ><?php echo $vLangArr1[5];?></td><td>
								  <select name="txttemplate" id="txttemplate"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
									<option value="0"><?php echo $vLangArr1[6];?></option>
									<option value="1"><?php echo $vLangArr1[7];?></option>
								  </select>
							  </td>
							</tr> 			
							 <tr>
							  <td  height="20" ><?php echo $vLangArr1[8];?></td><td>
							  <select name="txtbank" id="txtbank"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
								<option value="0"><?php echo $vLangArr1[9];?></option>
								<option value="1"><?php echo $vLangArr1[10];?></option>
								<option value="2"><?php echo $vLangArr1[11];?></option>
                              </select></td>
							</tr>
							<tr>
							  <td  height="20" ><?php echo $vLangArr1[12];?></td><td>
							  <select name="txtkpcd" id="txtkpcd"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
								<option value="0"><?php echo $vLangArr1[13];?></option>
								<option value="1" selected="selected"><?php echo $vLangArr1[14];?></option>
                              </select></td>
							</tr>
							<tr>
							  <td  height="20" ><?php echo $vLangArr1[15];?></td><td>
							  <select name="txtnghiviec" id="txtnghiviec"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
								<option value="0"  selected="selected"><?php echo $vLangArr1[16];?></option>
								<option value="1"><?php echo $vLangArr1[17];?></option>
								<option value="2"><?php echo $vLangArr1[18];?></option>
                              </select></td>
							</tr>
							<tr>
							  <td  height="20" ><?php echo $vLangArr1[19];?></td><td>
							  <select name="txtoptbh" id="txtoptbh"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
								<option value="0" selected="selected"><?php echo $vLangArr1[20];?></option>
								<option value="1"><?php echo $vLangArr1[21];?></option>
								<option value="2"><?php echo $vLangArr1[22];?></option>
								<option value="3"><?php echo $vLangArr1[23];?></option>
								<option value="4"><?php echo $vLangArr1[24];?></option>
                              </select></td>
							</tr>
							<tr>
							  <td  height="20" ><?php echo $vLangArr1[25];?></td><td>
							  <select name="txtisViet" id="txtisViet"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
								<option value="0"  selected="selected"><?php echo $vLangArr1[26];?></option>
								<option value="1"><?php echo $vLangArr1[27];?></option>
								<option value="2"><?php echo $vLangArr1[28];?></option>
                              </select></td>
							</tr>
							<tr>
							  <td  height="20" ><?php echo $vLangArr1[29];?></td><td>
							  <select name="txtsort" id="txtsort"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
								<option value="0"><?php echo $vLangArr1[30];?></option>
								<option value="1"><?php echo $vLangArr1[31];?></option>
								<option value="2" selected="selected"><?php echo $vLangArr1[32];?></option>
                              </select></td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr1[33];?></td>
							  <td  height="20"> <div style="width:100%;height:150px;position:relative;overflow: auto;top:0px;"><?php echo $morp_lv0002->GetBuilCheckList('0,1,2,3,4,5','chklv839',10,'hr_lv0039','lv002',' order by lv003 asc');?></div></td>
							</tr>	
							<tr>
							  <td  height="20" ><?php echo $vLangArr1[34];?></td><td>
							  <select name="txtbanklist" id="txtbanklist"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
								<option value=""><?php echo $vLangArr1[35];?></option>
								  <option value="9"><?php echo $vLangArr1[36];?></option>
								  <option value="42"><?php echo 'Báo cáo ngân hàng ứng lương - TK1';?></option>
								  <option value="43"><?php echo 'Báo cáo ngân hàng ứng lương - TK2';?></option>
								  <option value="44"><?php echo 'Báo cáo tiền mặt ứng lương';?></option>
								  <option value="4"><?php echo $vLangArr1[36].' - Gửi Ngân Hàng';?></option>
								  <option value="19"><?php echo $vLangArr1[37];?></option>								 
								  <option value="30"><?php echo 'Báo cáo lương Văn Phòng';?></option>
								  <option value="40"><?php echo 'Báo cáo lương Văn Phòng - 1 Dòng Lương';?></option>
								  <option value="41" selected="selected"><?php echo 'Báo cáo lương mẫu tổng - 1 Dòng Lương';?></option>
								  <option value="51"><?php echo 'Báo cáo khoản trừ - Mẫu tổng';?></option>
								  <option value="52"><?php echo 'Báo cáo khoản trừ - Đi trễ và trừ hoàn ứng';?></option>
								  <option value="53"><?php echo 'Báo cáo khoản trừ - Trừ khác';?></option>
								  <!--<option value="7"><?php echo $vLangArr1[39];?></option>-->
								  <option value="10"><?php echo $vLangArr1[40];?></option>
								  <option value="12"><?php echo $vLangArr1[41];?></option>
								  <option value="21"><?php echo $vLangArr1[42];?></option>
								  <option value="22"><?php echo $vLangArr1[43];?></option>
								  <option value="23"><?php echo $vLangArr1[44];?></option>
								  <option value="11"><?php echo $vLangArr1[45];?></option>
								  <option value="13"><?php echo $vLangArr1[46];?></option>
								  <option value="14"><?php echo $vLangArr1[47];?></option>
								  <option value="25"><?php echo $vLangArr1[48];?></option>
								  <option value="15"><?php echo $vLangArr1[49];?></option>
								  <option value="67"><?php echo 'PIT năm lấy từ người phụ thuộc';?></option>
								  <option value="68"><?php echo '>> Báo cáo Lương Tháng 13';?></option>
								  <option value="56"><?php echo '>> Báo cáo ngân hàng Lương Tháng 13 - mẫu gửi ngân hàng';?></option>
								  <option value="58"><?php echo '>> Báo cáo tiền mặt Lương Tháng 13';?></option>   
                              </select></td>
							</tr> 
							<tr>
								<td>
								<?php echo 'Hiển thị thêm cột';?>
								</td>
							  <td  height="20" colspan="2">
							  	 <div style="max-height:200px;overflow:auto">
									<table align="center" class="lvtable">
										<input type="hidden" value="1" name="txtABC" id="txtABC"><input type="hidden"  name="txtlv020" id="txtlv020">
										<tbody>
										<tr class="lvlinehtable1">
											<td width="1%"><input type="checkbox" tabindex="10" title="" value="4" id="chklv0050" <?php echo ($morp_lv0002->GetApr()==1)?'checked="checked"':'';?>></td><td><?php echo 'ABC';?></td>
										</tr>
										<tr class="lvlinehtable1">
											<td width="1%"><input type="checkbox" tabindex="10" title="" value="4" id="chklv0051" <?php echo ($morp_lv0002->GetApr()==1)?'checked="checked"':'';?>></td><td><?php echo 'Tăng ca 150%';?></td>
										</tr>
										<tr class="lvlinehtable1">
											<td width="1%"><input type="checkbox" tabindex="10" title="" value="4" id="chklv0052" <?php echo ($morp_lv0002->GetApr()==1)?'checked="checked"':'';?>></td><td><?php echo 'Tăng ca 200%';?></td>
										</tr>
										<tr class="lvlinehtable1">
											<td width="1%"><input type="checkbox" tabindex="10" title="" value="20" id="chklv0053" <?php echo ($morp_lv0002->GetApr()==1)?'':'checked="checked"';?>></td><td><?php echo 'Tăng ca 300%';?></td>
										</tr>
										<tr class="lvlinehtable1">
											<td width="1%"><input type="checkbox" tabindex="10" title="" value="15" id="chklv0054" <?php echo ($morp_lv0002->GetApr()==1)?'':'checked="checked"';?>></td><td><?php echo 'Phụ cấp (nhà, điện thoại, ...)';?></td>
										</tr>
										<tr class="lvlinehtable1">
											<td width="1%"><input type="checkbox" tabindex="10" title="" value="21" id="chklv0055" <?php echo ($morp_lv0002->GetApr()==1)?'':'checked="checked"';?>></td><td><?php echo 'Khoản cộng';?></td>
										</tr>
										<tr class="lvlinehtable1">
											<td width="1%"><input type="checkbox" tabindex="10" title="" value="31" id="chklv0056" <?php echo ($morp_lv0002->GetApr()==1)?'':'checked="checked"';?>></td><td><?php echo 'Khoản trừ';?></td>
										</tr>
										</tbody>
									</table>
					</div>
							  </td>
							 </tr>
							<tr>
								<td>
								<?php echo $vLangArr1[50];?>
								</td>
							  <td  height="20" colspan="2">
							  <select name="funcexp">
									<option value=""></option>
									<option value="excel"><?php echo $vLangArr1[51];?></option>
									<option value="word"><?php echo $vLangArr1[52];?></option>
							  </select>
							  <input name="txtlv839" type="hidden" id="txtlv839" value="<?php echo $morp_lv0002->lv042;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							  <input name="func" type="hidden" id="func" value="rpt"  /></td>
							</tr>
			
							<tr>
							  <td  height="20" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:RptWH();" tabindex="47"><img src="../images/lvicon/Rpt.png" 
            alt="RptWH" title="<?php echo $vLangArr[14];?>" 
            name="RptWH" border="0" align="middle" id="RptWH" /> <?php echo $vLangArr[14];?></a></TD>
                    <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[15];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[15];?></a></TD>
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
