<?php
session_start();
$sExport=$_GET['func'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=employees.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=employees.doc');
}
if($sExport=="pdf"){
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0020.php");
require_once("../../clsall/tc_lv0013.php");
require_once("../../clsall/rp_lv0013.php");
/////////////init object//////////////
$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0013');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$morp_lv0013=new  rp_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0013');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0038.txt",$plang);
$motc_lv0020->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0020->ArrPush[0]=$vLangArr[17];
$motc_lv0020->ArrPush[1]=$vLangArr[18];
$motc_lv0020->ArrPush[2]=$vLangArr[19];
$motc_lv0020->ArrPush[3]=$vLangArr[20];
$motc_lv0020->ArrPush[4]=$vLangArr[21];
$motc_lv0020->ArrPush[5]=$vLangArr[22];
$motc_lv0020->ArrPush[6]=$vLangArr[23];
$motc_lv0020->ArrPush[7]=$vLangArr[24];
$motc_lv0020->ArrPush[8]=$vLangArr[25];
$motc_lv0020->ArrPush[9]=$vLangArr[26];
$motc_lv0020->ArrPush[10]=$vLangArr[27];
$motc_lv0020->ArrPush[11]=$vLangArr[28];
$motc_lv0020->ArrPush[12]=$vLangArr[29];
$motc_lv0020->ArrPush[13]=$vLangArr[30];
$motc_lv0020->ArrPush[14]=$vLangArr[31];
$motc_lv0020->ArrPush[15]=$vLangArr[32];
$motc_lv0020->ArrPush[16]=$vLangArr[33];
$motc_lv0020->ArrPush[17]=$vLangArr[34];
$motc_lv0020->ArrPush[18]=$vLangArr[35];
$motc_lv0020->ArrPush[19]=$vLangArr[36];
$motc_lv0020->ArrPush[20]=$vLangArr[37];
$motc_lv0020->ArrPush[21]=$vLangArr[38];
$motc_lv0020->ArrPush[22]=$vLangArr[39];
$motc_lv0020->ArrPush[23]=$vLangArr[40];
$motc_lv0020->ArrPush[24]=$vLangArr[41];
$motc_lv0020->ArrPush[25]=$vLangArr[42];
$motc_lv0020->ArrPush[26]=$vLangArr[43];
$motc_lv0020->ArrPush[27]=$vLangArr[44];
$motc_lv0020->ArrPush[28]=$vLangArr[45];
$motc_lv0020->ArrPush[29]=$vLangArr[46];
$motc_lv0020->ArrPush[30]=$vLangArr[47];
$motc_lv0020->ArrPush[31]=$vLangArr[48];
$motc_lv0020->ArrPush[32]=$vLangArr[49];
$motc_lv0020->ArrPush[33]=$vLangArr[50];
$motc_lv0020->ArrPush[34]=$vLangArr[51];
$motc_lv0020->ArrPush[35]=$vLangArr[52];
$motc_lv0020->ArrPush[36]=$vLangArr[53];
$motc_lv0020->ArrPush[37]=$vLangArr[54];
$motc_lv0020->ArrPush[38]=$vLangArr[55];
$motc_lv0020->ArrPush[39]=$vLangArr[56];
$motc_lv0020->ArrPush[40]=$vLangArr[57];
$motc_lv0020->ArrPush[41]=$vLangArr[58];
$motc_lv0020->ArrPush[42]=$vLangArr[59];
$motc_lv0020->ArrPush[43]=$vLangArr[60];
$motc_lv0020->ArrPush[44]=$vLangArr[61];
$motc_lv0020->ArrPush[45]=$vLangArr[62];
$motc_lv0020->ArrPush[46]=$vLangArr[63];
$motc_lv0020->ArrPush[47]=$vLangArr[64];
$motc_lv0020->ArrPush[48]=$vLangArr[65];
$motc_lv0020->ArrPush[49]=$vLangArr[66];
$motc_lv0020->ArrPush[50]=$vLangArr[67];
$motc_lv0020->ArrPush[51]=$vLangArr[68];
$motc_lv0020->ArrPush[52]=$vLangArr[69];
$motc_lv0020->ArrPush[53]=$vLangArr[70];
$motc_lv0020->ArrPush[54]=$vLangArr[71];
$motc_lv0020->ArrPush[55]=$vLangArr[72];
$motc_lv0020->ArrPush[56]=$vLangArr[73];
$motc_lv0020->ArrPush[57]=$vLangArr[74];
$motc_lv0020->ArrPush[58]=$vLangArr[75];
$motc_lv0020->ArrPush[59]=$vLangArr[76];
$motc_lv0020->ArrPush[60]=$vLangArr[77];
$motc_lv0020->ArrPush[61]=$vLangArr[78];
$motc_lv0020->ArrPush[62]=$vLangArr[79];
$motc_lv0020->ArrPush[63]=$vLangArr[80];
$motc_lv0020->ArrPush[64]=$vLangArr[81];
$motc_lv0020->ArrPush[65]=$vLangArr[82];
$motc_lv0020->ArrPush[66]=$vLangArr[83];
$motc_lv0020->ArrPush[67]=$vLangArr[84];
$motc_lv0020->ArrPush[68]=$vLangArr[85];
$motc_lv0020->ArrPush[69]=$vLangArr[86];
$motc_lv0020->ArrPush[70]=$vLangArr[87];
$motc_lv0020->ArrPush[71]=$vLangArr[88];
$motc_lv0020->ArrPush[72]=$vLangArr[89];
$motc_lv0020->ArrPush[73]=$vLangArr[90];
$motc_lv0020->ArrPush[74]=$vLangArr[91];
$motc_lv0020->ArrPush[75]=$vLangArr[92];
$motc_lv0020->ArrPush[76]=$vLangArr[93];
$motc_lv0020->ArrPush[77]=$vLangArr[64];
$motc_lv0020->ArrPush[78]=$vLangArr[95];
$motc_lv0020->ArrPush[79]=$vLangArr[96];
$motc_lv0020->ArrPush[80]=$vLangArr[97];
$motc_lv0020->ArrPush[81]=$vLangArr[98];
$motc_lv0020->ArrPush[82]=$vLangArr[99];
$motc_lv0020->ArrPush[83]=$vLangArr[100];
$motc_lv0020->ArrPush[84]=$vLangArr[101];
$motc_lv0020->ArrPush[85]=$vLangArr[102];
$motc_lv0020->ArrPush[86]=$vLangArr[103];
$motc_lv0020->ArrPush[87]=$vLangArr[104];
$motc_lv0020->ArrPush[88]=$vLangArr[105];
$motc_lv0020->ArrPush[89]=$vLangArr[106];
$motc_lv0020->ArrPush[90]=$vLangArr[107];
$motc_lv0020->ArrPush[91]=$vLangArr[108];
$motc_lv0020->ArrPush[92]=$vLangArr[109];
$motc_lv0020->ArrPush[93]=$vLangArr[110];
$motc_lv0020->ArrPush[94]=$vLangArr[111];
$motc_lv0020->ArrPush[95]=$vLangArr[112];
$motc_lv0020->ArrPush[96]=$vLangArr[113];
$motc_lv0020->ArrPush[97]=$vLangArr[114];
$motc_lv0020->ArrPush[98]=$vLangArr[115];
$motc_lv0020->ArrPush[99]=$vLangArr[116];
$motc_lv0020->ArrPush[91]='Số ngày TC <=4H';
$motc_lv0020->ArrPush[92]='Số ngày TC >4H';
$motc_lv0020->ArrPush[93]='Tiền cơm tăng ca';

$motc_lv0020->ArrPush[100]=$vLangArr[117];
$motc_lv0020->ArrPush[101]=$vLangArr[118];
$motc_lv0020->ArrPush[102]=$vLangArr[119];
$motc_lv0020->ArrPush[103]=$vLangArr[130];
$motc_lv0020->ArrPush[104]=$vLangArr[131];

$motc_lv0020->ArrPush[999]=$vLangArr[128];
$motc_lv0020->ArrPush[1000]=$vLangArr[129];


//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$lvopt=(int)$_GET['txtopt'];
$lvmau=(int)$_GET['txttemplate'];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;

$vStrMessage="";
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0013->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0013');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0013->lv002=base64_decode( $_GET['ID']);
$vFieldList=$morp_lv0013->ListView;
$curPage = $morp_lv0013->CurPage;
$maxRows =$morp_lv0013->MaxRows;
$vOrderList=$morp_lv0013->ListOrder;
$vSortNum=$morp_lv0013->SortNum;

//////////////////////////////////////////////////////////////////////////////////////////////////////
$curPage = $motc_lv0020->CurPage;
$maxRows =$motc_lv0020->MaxRows;
$vCalArrID=explode("@",$_GET['txtlv001']);
$vCalID=$vCalArrID[0];
$motc_lv0020->lv098=$vCalID;
$motc_lv0020->Bank=(int)$_GET['txtbank'];
$motc_lv0020->lv201=$_GET['txtlv002'];
$motc_lv0020->lv002=$_GET['txtlv004'];
$motc_lv0020->lv202=$_GET['txtlv003'];
$motc_lv0020->lv839=$_GET['txtlv839'];
$motc_lv0013->LV_LoadID($motc_lv0020->lv098);
$motc_lv0020->isNghi=(int)$_GET['txtnghiviec'];
$motc_lv0020->isViet=(int)$_GET['txtisViet'];
$motc_lv0020->isChildCheck=(int)$_GET['isChildCheck'];
$motc_lv0020->CalMonth=$motc_lv0013->lv006;
$motc_lv0020->CalYear=$motc_lv0013->lv007;
$vPreCalID=$motc_lv0013->LV_LoadPreMonth($motc_lv0013->lv006,$motc_lv0013->lv007);
if($maxRows ==0) $maxRows = 100000000;

$totalRowsC=$motc_lv0020->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<center>
<?php
if($morp_lv0013->GetRpt()==1)
{
?>
	<table border="0" cellpadding="0" cellspacing="0" width="800">
	
		<tr height="27">
			<td colspan="3" height="27" >SOF CO. LTD</td>
			
		</tr>
		<tr height="27">
			<td colspan="3" height="27">Human Resources Dept</td>
			
		</tr>
		<tr height="27">
			<td colspan="4" height="27">Lot III/21 19/5A, Industrial Group III, Tan Binh IZ, Tay Thanh Ward, Tan Phu District, Ho Chi Minh City</td>
			
		</tr>
		<tr height="27">
			<td colspan="3" height="27">Tel: 0650 767168</td>
			
		</tr>
		<tr height="33">
			<td colspan="3" height="33">To: Pearl Low</td>
			
		</tr>
		<tr height="27">
			
			<td colspan="3" align="center"><strong>SUMMARY OF PAYABLE TO EMPLOYEES<strong></td>
			
			
		</tr>
		<tr height="27">
			<td colspan="3" align="center">For the Month of <?php echo jdmonthname($motc_lv0013->lv006,2);?> ,2014
			<br/>From <?php echo $motc_lv0013->FormatView($motc_lv0013->lv004,2);?>&nbsp; to&nbsp; <?php echo $motc_lv0013->FormatView($motc_lv0013->lv005,2);?>
			</td>
			
		</tr>

	</tbody>
</table>
<table border="1" cellpadding="0" cellspacing="0"  width="800">
	<colgroup>
		<col width="36" />
		<col width="70" />
		<col width="188" />
		<col width="210" />
		<col width="71" />
		<col width="68" />
		<col width="158" />
		<col width="161" />
		<col width="163" />
		<col width="158" />
		<col width="167" />
		<col width="185" /></colgroup>
	<tbody>
		<tr height="20" style="font-weight:bold">
			<td align="right" height="20" width="36">1</td>
			<td width="70">2</td>
			<td width="188">3</td>
			<td width="210">4</td>
			<td width="71">5</td>
			<td width="68">6</td>
			<td width="158">7</td>
			<td width="161">8</td>
			<td width="163">9</td>
			<td width="158">10</td>
			<td width="167">11</td>
			<td width="185">12</td>
		</tr>	
		<tr height="27" style="font-weight:bold">
			<td height="27">No.</td>
			<td>&nbsp;</td>
			<td>Name</td>
			<td>Position</td>
			<td>No of empl</td>
			<td>&nbsp;</td>
			<td>Basic Salary</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Total payable</td>
			<td>&nbsp;</td>
			<td>Note</td>
		</tr>
		<tr height="17">
			<td height="17">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="34" style="font-weight:bold">
			<td height="34">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Current mth</td>
			<td>Prev. mth</td>
			<td>current mth</td>
			<td>&nbsp;</td>
			<td>Prev. mth</td>
			<td>current mth</td>
			<td>Prev. mth</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="27">
			<td height="27">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>actual payable</td>
			<td>basic</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
<?php
	$vArrDoi=Array(1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',7=>'VII',8=>'VIII',9=>'IX',10=>'X');
	if($_GET['txtlv002']!="")
	{
		$vCondition=" and lv001 in ('".str_replace(",","','",$_GET['txtlv002'])."')";
	}
	$vsql="select * from hr_lv0002 where 1=1 ".$vCondition;
	$vresult=db_query($vsql);
	$i=1;
	while($vrow=db_fetch_array($vresult))
	{
	$vStrHD='<tr height="37" style="font-weight:bold;background:yellow;">
			<td height="37" >@01</td>
			<td>&nbsp;</td>
			<td>@09</td>
			<td>&nbsp;</td>
			<td>@02</td>
			<td>@03</td>
			<td align="right">@04</td>
			<td align="right">@05</td>
			<td align="right">@06</td>
			<td align="right">@07</td>
			<td align="right">@08</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;</td>
		</tr>';
		$vsql1="select A.lv002 MaNV,concat(B.lv004,' ',B.lv003,' ',B.lv002) NameNV,B.lv005 Position,A.lv035 ActualPayable,A.lv069 TotalPayable,(select sum(BB.lv069) from tc_lv0021 BB where BB.lv002=A.lv002 and BB.lv098='$vPreCalID' limit 0,1) ReTotalPayable,A.lv012 NetMonth,(select BB.lv012 from tc_lv0021 BB where BB.lv002=A.lv002 and BB.lv098='$vPreCalID' limit 0,1) PreNetMonth from tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001  where A.lv098='$vCalID' and A.lv096='".$vrow['lv001']."' order by A.lv002";
		$vresult1=db_query($vsql1);
		$j=1;
		$vTr='<tr height="27">
			<td height="27">#01</td>
			<td>#02</td>
			<td>#03</td>
			<td>#04</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right">#05</td>
			<td  align="right">#06</td>
			<td  align="right">#07</td>
			<td  align="right">#08</td>
			<td  align="right">#09</td>
			<td  align="right">#10</td>
		</tr>';
		$vListTr="";		
		$vActualPayable=0;
		$vNetMonth=0;
		$vPreNetMonth=0;
		$vTotalPayable=0;
		$vPreTotalPayable=0;
		while($vrow1=db_fetch_array($vresult1))
		{
		$vActualPayable=$vActualPayable+(float)$vrow1['ActualPayable'];
		$vSumActualPayable=$vSumActualPayable+(float)$vrow1['ActualPayable'];
		$vNetMonth=$vNetMonth+(float)$vrow1['NetMonth'];
				$vSumNetMonth=$vSumNetMonth+(float)$vrow1['NetMonth'];
		$vPreNetMonth=$vPreNetMonth+(float)$vrow1['PreNetMonth'];
				$vSumPreNetMonth=$vSumPreNetMonth+(float)$vrow1['PreNetMonth'];
		$vTotalPayable=$vTotalPayable+(float)$vrow1['TotalPayable'];
				$vSumTotalPayable=$vSumTotalPayable+(float)$vrow1['TotalPayable'];
		$vPreTotalPayable=$vPreTotalPayable+(float)$vrow1['ReTotalPayable'];
				$vSumPreTotalPayable=$vSumPreTotalPayable+(float)$vrow1['ReTotalPayable'];
		
			$vStrTemp=$vTr;
			$vStrTemp=str_replace("#01",$j,$vStrTemp);
			$vStrTemp=str_replace("#02",$vrow1['MaNV'],$vStrTemp);
			$vStrTemp=str_replace("#03",$vrow1['NameNV'],$vStrTemp);
			$vStrTemp=str_replace("#04",$vrow1['Position'],$vStrTemp);
			$vStrTemp=str_replace("#05",$motc_lv0020->FormatView($vrow1['ActualPayable'],13),$vStrTemp);
			$vStrTemp=str_replace("#06",$motc_lv0020->FormatView($vrow1['NetMonth'],13),$vStrTemp);
			$vStrTemp=str_replace("#07",$motc_lv0020->FormatView($vrow1['PreNetMonth'],13),$vStrTemp);
			
			$vStrTemp=str_replace("#08",$motc_lv0020->FormatView($vrow1['TotalPayable'],13),$vStrTemp);
			$vStrTemp=str_replace("#09",$motc_lv0020->FormatView($vrow1['ReTotalPayable'],13),$vStrTemp);
			$vStrTemp=str_replace("#10",'&nbsp;',$vStrTemp);
			
			$vListTr=$vListTr.$vStrTemp;
			
			$j++;
		}
		$vsql2="select (select count(*) from tc_lv0021 A where A.lv098='$vCalID' and A.lv096='".$vrow['lv001']."') num1,(select count(*) from tc_lv0021 A where A.lv098='$vPreCalID' and A.lv096='".$vrow['lv001']."') num2";
		$vresult2=db_query($vsql2);
		$vrow2=db_fetch_array($vresult2);
		$vSumCur=$vSumCur+(int)$vrow2['num1'];
		$vSumPre=$vSumPre+(int)$vrow2['num2'];
		$vStrHD=str_replace("@01",$vArrDoi[$i],$vStrHD);
		$vStrHD=str_replace("@09",$vrow['lv003'],$vStrHD);
		$vStrHD=str_replace("@02",$motc_lv0020->FormatView($vrow2['num1'],13),$vStrHD);
		$vStrHD=str_replace("@03",$motc_lv0020->FormatView($vrow2['num2'],13),$vStrHD);
		$vStrHD=str_replace("@04",$motc_lv0020->FormatView($vActualPayable,13),$vStrHD);
		$vStrHD=str_replace("@05",$motc_lv0020->FormatView($vNetMonth,13),$vStrHD);
		$vStrHD=str_replace("@06",$motc_lv0020->FormatView($vPreNetMonth,13),$vStrHD);
		$vStrHD=str_replace("@07",$motc_lv0020->FormatView($vTotalPayable,13),$vStrHD);
		$vStrHD=str_replace("@08",$motc_lv0020->FormatView($vPreTotalPayable,13),$vStrHD);
		echo $vStrHD;
		echo $vListTr;
		$i++;
	}
		$vStrHD='<tr height="37" style="font-weight:bold;background:yellow;">
			<td height="37" >&nbsp;</td>
			<td colspan="3">Total</td>
			<td>'.$motc_lv0020->FormatView($vSumCur,13).'</td>
			<td>'.$motc_lv0020->FormatView($vSumPre,13).'</td>
			<td align="right">'.$motc_lv0020->FormatView($vSumActualPayable,13).'</td>
			<td align="right">'.$motc_lv0020->FormatView($vSumNetMonth,13).'</td>
			<td align="right">'.$motc_lv0020->FormatView($vSumPreNetMonth,13).'</td>
			<td align="right">'.$motc_lv0020->FormatView($vSumTotalPayable,13).'</td>
			<td align="right">'.$motc_lv0020->FormatView($vSumPreTotalPayable,13).'</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;</td>
		</tr>
		<tr height="29" style="font-weight:bold;">
			<td height="29">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right" style="color:red;">'.$motc_lv0020->FormatView($vSumActualPayable,13).'</td>
			<td align="right" style="color:red;">'.$motc_lv0020->FormatView($vSumNetMonth,13).'</td>
			<td align="right" style="color:red;">'.$motc_lv0020->FormatView($vSumPreNetMonth,13).'</td>
			<td align="right" style="color:red;">'.$motc_lv0020->FormatView($vSumTotalPayable,13).'</td>
			<td align="right" style="color:red;">'.$motc_lv0020->FormatView($vSumPreTotalPayable,13).'</td>
			<td>-</td>
		</tr>
		
		<tr height="27" style="font-weight:bold;">
			<td height="27">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right" >'.$motc_lv0020->FormatView($vSumActualPayable/$motc_lv0013->lv024,10).'$</td>
			<td align="right" >'.$motc_lv0020->FormatView($vSumNetMonth/$motc_lv0013->lv024,10).'$</td>
			<td align="right"  >'.$motc_lv0020->FormatView($vSumPreNetMonth/$motc_lv0013->lv024,10).'$</td>
			<td align="right"  >'.$motc_lv0020->FormatView($vSumTotalPayable/$motc_lv0013->lv024,10).'$</td>
			<td align="right"  >'.$motc_lv0020->FormatView($vSumPreTotalPayable/$motc_lv0013->lv024,10).'$</td>
			<td>&nbsp;</td>
		</tr>
		';

		echo $vStrHD;
		
?>			
	
	</tbody>
</table>		
<?php
} else {
	include("../permit.php");
}
?>
</center>	