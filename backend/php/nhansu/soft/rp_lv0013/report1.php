<?php
session_start();
$sExport=$_GET['funcexp'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=salary-full.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=salary-full.doc');
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
	$vLangArr=GetLangFile("../../","TC0038.txt","VN");
$motc_lv0020->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0020->ArrPush[0]=$vLangArr[16];
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
$motc_lv0020->ArrPush[75]=$vLangArr[102];
$motc_lv0020->ArrPush[76]=$vLangArr[103];
$motc_lv0020->ArrPush[77]=$vLangArr[104];
$motc_lv0020->ArrPush[78]=$vLangArr[105];
$motc_lv0020->ArrPush[79]=$vLangArr[106];
$motc_lv0020->ArrPush[80]=$vLangArr[107];
$motc_lv0020->ArrPush[81]=$vLangArr[108];
$motc_lv0020->ArrPush[82]=$vLangArr[109];
$motc_lv0020->ArrPush[83]=$vLangArr[110];
$motc_lv0020->ArrPush[84]=$vLangArr[111];
$motc_lv0020->ArrPush[85]=$vLangArr[112];
$motc_lv0020->ArrPush[86]=$vLangArr[113];
$motc_lv0020->ArrPush[87]=$vLangArr[114];
$motc_lv0020->ArrPush[88]=$vLangArr[115];

$motc_lv0020->ArrPush[91]='Số ngày TC <=4H';
$motc_lv0020->ArrPush[92]='Số ngày TC >4H';
$motc_lv0020->ArrPush[93]='Tiền cơm tăng ca';
$motc_lv0020->ArrPush[94]='Số công bù';

$motc_lv0020->ArrPush[101]=$vLangArr[103];
$motc_lv0020->ArrPush[102]='Mã KT';

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
$motc_lv0020->lv060=$vCalID;
$motc_lv0020->Bank=(int)$_GET['txtbank'];
$motc_lv0020->lv201=$_GET['txtlv002'];
$motc_lv0020->lv002=$_GET['txtlv004'];
$motc_lv0020->lv202=$_GET['txtlv003'];
$motc_lv0020->lv839=$_GET['txtlv839'];
$motc_lv0020->isChildCheck=(int)$_GET['isChildCheck'];
$motc_lv0013->LV_LoadID($motc_lv0020->lv060);
$motc_lv0020->isNghi=(int)$_GET['txtnghiviec'];
$motc_lv0020->isViet=(int)$_GET['txtisViet'];
$motc_lv0020->CalMonth=$motc_lv0013->lv006;
$motc_lv0020->CalYear=$motc_lv0013->lv007;
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
<script language="javascript">

function ProcessTextHiden(olv)
{
	obj = document.getElementById('showparenttext');
	if(obj==null)
		{
		}
	else
		{
			var nn6=document.getElementById&&!document.all;
			if(nn6)
				r = olv;
			else
				r = olv;
			LV_GetTable(r,nn6,obj)	
		}
}
function Calagain(e)
{
	var height=screen.height;
	var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
	var scrollLeft = document.documentElement.scrollLeft || document.body.scrollLeft;
	obj = document.getElementById('showparenttext');
	objdoc = document.getElementById('showparenttextdoc');
	if(scrollTop>(130))
	{
		obj.style.display="block";
		obj.style.top=(scrollTop)+"px";
	}
	else
	{
		obj.style.display="none";
		//obj.style.top=(height-180+scrollTop)+"px";
	}
	if(scrollLeft>(280))
	{
		objdoc.style.display="block";
		objdoc.style.top=(180)+"px";
		objdoc.style.left=(scrollLeft)+"px";
	}
	else
	{
		objdoc.style.display="none";
		//obj.style.top=(height-180+scrollTop)+"px";
	}
}
function LV_GetTable(r,nn6,obj)
{
	if(nn6)
		var res = r.parentNode.innerHTML.explode('<tr class="lvhtable">');
	else
		var res = r.parentElement.innerHTML.explode('<tr class="lvhtable">');
	var end=res[1].explode('</tr>');
	obj.innerHTML='<div id="showlisttmp"><table align="center" class="lvtable" border="1" cellspacing="0" cellpadding="0">'+'<tr>'+r.innerHTML+'</tr></table></div>';
}
</script>
<?php
if($morp_lv0013->GetRpt()==1)
{
	if($_GET['txtbanklist']==4)
{
	$vstrReturn= $motc_lv0020->LV_BuilListForeigner($motc_lv0013);
	echo $vstrReturn;
	exit;
}
elseif($_GET['txtbanklist']==5)
{
	$vstrReturn= $motc_lv0020->LV_BuilListHotel($motc_lv0013);
	echo $vstrReturn;
	exit;
}
elseif($_GET['txtbanklist']==1)
{
	echo '
	<style>
		table tr td
		{
			width:100px;
		}
	</style>
	<div style="width:800px">';
}
else
	echo '<div>';

?>
<style>
.lv_fixed_hd
{
/*position:fixed;*/
overflow:hidden;
background:blue;
text-align:left;
width:inherit
}
</style>
<body <?php echo (($_GET['funcexp']=='excel' || $_GET['funcexp']=='word')?'':'onscroll="Calagain(event)"')?> >
<div style="height:100px">
<!--<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;" >
	<tbody>
		<tr height="24">
			<td colspan="3" height="24" width="383"><?php echo $morp_lv0013->GetCompany();?></td>
			<td width="270">&nbsp;</td>
			<td width="166">&nbsp;</td>
			<td width="174">&nbsp;</td>
			<td width="64">&nbsp;</td>
		</tr>
		<tr height="33">
			<td colspan="3" height="33">Human Resources Dept</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="31">
			<td colspan="3" height="31"><?php echo $morp_lv0013->GetAddress();?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="28">
			<td colspan="3" height="28">Tel: <?php echo $morp_lv0013->GetPhone();?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>-->
<table border="0" cellspacing="0" style="width: 1000px;">
<tbody>
<tr>
<td colspan="16" rowspan="4" align="center" valign="middle"><strong><span style="font-size: large;"><img ondblclick="this.src='../../logotech.png'" src="../../logo.png" style="height:80px"/></span></strong></td>
<td colspan="5" rowspan="2" align="left" valign="middle" width="500"><strong><span style="font-size: medium;text-align:center"><div ondblclick="this.innerHTML='CÔNG TY CỔ PHẦN TDL-TECH'">CÔNG TY CỔ PHẦN CÔNG NGHỆ ĐẦU TƯ MINH PHƯƠNG</div></span></strong></td>
<td colspan="16" rowspan="4" align="center" valign="middle"><strong><span style="font-size: large;font-size:24px"><input type="text" value="BẢNG LƯƠNG NGHỈ VIỆC TH&Aacute;NG" style="border:0px #fff solid;width:100%;text-align:center;font:bold 20px arial,tahoma;"/>
<input type="text" value="<?php echo getmonth($motc_lv0013->lv004);?>/<?php echo getyear($motc_lv0013->lv004);?>" style="border:0px #fff solid;width:100%;text-align:center;font:bold 20px arial,tahoma;"/></span></strong></td>
</tr>
<tr>
</tr>
<tr>
<td colspan="5" align="center" valign="middle"><strong><span style="font-size: small;">PH&Ograve;NG NH&Acirc;N SỰ</span></strong></td>
</tr>
<tr>
<td colspan="5" align="center" valign="middle"><span style="font-size: small;"><?php echo $vLangArr[22];?>:<?php echo $motc_lv0013->FormatView($motc_lv0013->lv004,2);?> <?php echo 'đến ngày';?> <?php echo $motc_lv0013->FormatView($motc_lv0013->lv005,2);?></span></td>
</tr>
</tbody>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	<tr>
		<td colspan="4">
		
		<?php
		if($_GET['txtbanklist']!=1)
		{
		//echo '<div align="center" class=lv0>'.($motc_lv0020->ArrPush[0]).'</div>';
		}
		else
		{
		
		?>
		
		<div  align="center" style="font-weight:bold;font-size:14px">
		<?php
		if($motc_lv0020->Bank==1)
		{
			echo 'DANH S&Aacute;CH NH&Acirc;N VI&Ecirc;N NHẬN TIỀN LƯƠNG BẰNG CHUYỂN KHOẢN <br />
				LIST OF EMPLOYEES RECEIVED SALARY BY BANK TRANSFER';
		}
		else
			{
				echo 'DANH SÁCH NHÂN VIÊN NHẬN TIỀN LƯƠNG BẰNG TIỀN MẶT <br />
				LIST OF EMPLOYEES RECEIVED SALARY BY CASH';	
			}
		?>
</div>	
			
			<?php
			
			}?>
		</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td></td>
	  <td></td>
  </tr>
</table>
</div>
<div id="showparent1" style="text-align:left" >

					

						<?php
						switch($_GET['txtbanklist'])
						{
							case 1:
								if($motc_lv0020->Bank==1)
								$vFieldList='lv002,lv007,lv070,lv099,lv100';
								elseif($motc_lv0020->Bank==2)
								{
									$vFieldList='lv002,lv029,lv007,lv070,lv099,lv100';
								}
								else
								$vFieldList='lv002,lv007,lv079,lv096,lv100';
								$vOrderList='0.0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,0.0,96,97,9,99,100';
								break;
							case 2:
								
								break;
						}
						
						{
							 $motc_lv0020->option=$lvopt;								
							if($lvmau==0)
							$vstrReturn= $motc_lv0020->LV_BuilListReportOtherNone($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
							else
							$vstrReturn= $motc_lv0020->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
							echo $vstrReturn;
						}
						?>
<div id="showparenttext" style="position:absolute;top:600px;height:60px;overflow:hidden;display:none;z-index:989" ondblclick="this.innerHTML=''"><?php echo (($_GET['funcexp']=='excel' || $_GET['funcexp']=='word')?'':$vstrReturn);?></div>
<div id="showparenttextdoc" style="position:absolute;top:130px:left:0px;width:280px;overflow:hidden;display:block;z-index:987" ondblclick="this.innerHTML=''"><?php echo (($_GET['funcexp']=='excel' || $_GET['funcexp']=='word')?'':$vstrReturn);?></div>						
</div>						
<table style="width: 800px;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr height="36">
<td width="100">&nbsp;</td>
<td width="200" height="36">&nbsp;</td>
<td width="200">&nbsp;</td>
<td width="200">&nbsp;</td>
<td width="200">&nbsp;</td>
<td width="200">&nbsp;</td>
<td width="60">&nbsp;</td>
</tr>
<tr height="27">
<td>&nbsp;</td>
<td  height="27" align="center"><strong>Người lập biểu</strong></td>
<td>&nbsp;</td>
<td  height="27" align="center"><strong>Kế toán</strong></td>
<td>&nbsp;</td>
<td align="center"><strong>Duyệt</strong></td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td height="27">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td height="27">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td height="27">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="27">
<td>&nbsp;</td>
<td colspan="1" height="27" align="center">............................................................</td>
<td>&nbsp;</td>
<td colspan="1" height="27" align="center">............................................................</td>
<td>&nbsp;</td>
<td  align="center">............................................................</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>						
</div>						
</center>				
</body>
<?php
} else {
	include("../permit.php");
}
?>
