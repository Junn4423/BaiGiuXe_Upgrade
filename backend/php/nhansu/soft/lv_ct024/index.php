<?php
session_start();
if($_SESSION['ERPSOFV2RUserID']!="" && $_SESSION['ERPSOFV2RUserID']!=NULL) 
{
$vDir = "../";
include($vDir."config.php");
include($vDir."function.php");
include($vDir."paras.php");
$objid=$_GET['objid'];
$objvaluearray=explode(";",str_replace(",",";",str_replace('"','',str_replace("'","",$_GET['objvalue']))));
$vAdd="";
for($i=0;$i<count($objvaluearray)-1;$i++)
{
$vAdd=$vAdd.$objvaluearray[$i].",";
}
$objvalue=$objvaluearray[count($objvaluearray)-1];
//$objvalue=$_GET['objvalue'];
$objtable=$_GET['objtable'];
if($objtable=='sl_lv0001')
{
	$objfieldsearch=$_GET['objfieldsearch'];
	$objfieldsearch=str_replace(",lv803","",$objfieldsearch);
	$objfieldsearch=str_replace(",lv804","",$objfieldsearch);
	$objfieldsearch=str_replace(",lv805","",$objfieldsearch);
	$objfieldsearch=str_replace("@!","'",$objfieldsearch);
}
else
{
	$objfieldsearch=str_replace("@!","'",$_GET['objfieldsearch']);
}
$objfieldreturn=str_replace("@!","'",$_GET['objfieldreturn']);

$lvList=str_replace("@!","'",$_GET['objfieldsearch']);
$vStrColumn="";
if(!(strpos($objfieldsearch,",")===false))
{
	$vArrField=explode(",",$objfieldsearch);
	$vSTT=1;
	foreach($vArrField as $vField)
	{
		if($objfieldsearch1=='')
			$objfieldsearch1=$vField;
		else
			$objfieldsearch1=$objfieldsearch1.",' ',".$vField;
		$vArrCot[$vField]='cot'.$vSTT;
		$vStrColumn=$vStrColumn.",".$vField." ".$vArrCot[$vField];
		$vSTT++;
	}
	$objfieldsearch="concat(".$objfieldsearch1.")";
}

$ParentSearch=str_replace("!!!","&",$_GET['ParentSearch']);
$ParentName=$_GET['ParentName'];
$once_opt=$_GET['once_opt'];
$vCondition="";
if($ParentName!='')
{
	if($ParentSearch!='')	
	{
		if(strpos($ParentSearch,',')===false)
		{
			if($once_opt==2)
					$vCondition=" and ($ParentName like '%/$ParentSearch/%')";
			else
				$vCondition=" and ($ParentName='$ParentSearch')";
		}
		else
		{
			$vCondition=" and ($ParentName in ($ParentSearch))"	;
		}
	}
}
if(trim($objvalue)=="")
{
	$lvsql="select $objfieldreturn lv001 $vStrColumn from $objtable where 1=1 $vCondition limit 0,20";
	//$lvsql="select distinct * from (select $objfieldreturn lv001 $vStrColumn from $objtable where 1=1 $vCondition limit 0,20)";
}
else
{
if($once_opt==2 || $once_opt==1)
	$lvsql="select distinct * from (select $objfieldreturn lv001 $vStrColumn from $objtable where $objfieldsearch like '$objvalue%' $vCondition union select $objfieldreturn lv001 $vStrColumn from $objtable where $objfieldsearch like '%$objvalue%' $vCondition union select $objfieldreturn lv001 $vStrColumn from $objtable where $objfieldsearch like '%$objvalue' $vCondition) A limit 0,20";
else
	$lvsql="select distinct * from (select concat('$vAdd',$objfieldreturn,',') lv001 $vStrColumn from $objtable where $objfieldsearch like '$objvalue%' $vCondition union select concat('$vAdd',$objfieldreturn,',') lv001 $vStrColumn from $objtable where $objfieldsearch like '%$objvalue%' $vCondition union select concat('$vAdd',$objfieldreturn,',') lv001 $vStrColumn from $objtable where $objfieldsearch like '%$objvalue' $vCondition) A limit 0,20";
}	
	?>
	//alert('<?php echo str_replace("'","!",$lvsql);?>');
	<?php
$strul="<ul id=subpop-nav><li class=menupopT><table border=0 width=100% class='lvtable'>@#01</table>@#99</li></ul>";

$strtr="<tr><td><a href=\"javascript:PopupSelect('@01','$objid')\" tabindex=200>@01&nbsp;&nbsp;@02</a></td></tr>";
$strAllTr='';
$lvResult = db_query($lvsql);
if($vStrColumn!='')
{
	switch($objtable)
	{
		case 'lv_lv0007':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/lv_lv0007.php");
			$molv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0111');
			$vLangArr=GetLangFile("../../","LV0003.txt",'VN');

			$molv_lv0007->ArrPush[0]=$vLangArr[11];
			$molv_lv0007->ArrPush[1]=$vLangArr[12];
			$molv_lv0007->ArrPush[2]=$vLangArr[13];
			$molv_lv0007->ArrPush[3]=$vLangArr[14];
			$molv_lv0007->ArrPush[4]=$vLangArr[15];
			$molv_lv0007->ArrPush[5]=$vLangArr[16];
			$molv_lv0007->ArrPush[6]=$vLangArr[17];
			$molv_lv0007->ArrPush[7]=$vLangArr[18];
			$molv_lv0007->ArrPush[8]=$vLangArr[19];
			$molv_lv0007->ArrPush[9]=$vLangArr[20];
			$molv_lv0007->ArrPush[10]=$vLangArr[21];
			$molv_lv0007->ArrPush[11]=$vLangArr[22];
			$molv_lv0007->ArrPush[12]=$vLangArr[23];
			$molv_lv0007->ArrPush[13]=$vLangArr[24];
			$molv_lv0007->ArrPush[14]=$vLangArr[25];
			$molv_lv0007->ArrPush[15]=$vLangArr[26];
			$molv_lv0007->ArrPush[16]=$vLangArr[27];
			$strAllTr=$molv_lv0007->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$objvalue);
			break;
		case 'hr_lv0002':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/hr_lv0002.php");
			$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0111');
			$vLangArr=GetLangFile("../../","AD0051.txt",'VN');

			//////////////////////////////////////////////////////////////////////////////////////////////////////
			$mohr_lv0002->ArrPush[0]=$vLangArr[11];
			$mohr_lv0002->ArrPush[1]=$vLangArr[12];
			$mohr_lv0002->ArrPush[2]=$vLangArr[13];
			$mohr_lv0002->ArrPush[3]=$vLangArr[14];
			$mohr_lv0002->ArrPush[4]=$vLangArr[15];
			$mohr_lv0002->ArrPush[5]=$vLangArr[16];
			$mohr_lv0002->ArrPush[6]=$vLangArr[17];
			
			$mohr_lv0002->ArrPush[7]=$vLangArr[18];
			$mohr_lv0002->ArrPush[8]=$vLangArr[19];
			$mohr_lv0002->ArrPush[9]=$vLangArr[20];
			$mohr_lv0002->ArrPush[10]=$vLangArr[21];
			$mohr_lv0002->ArrPush[11]=$vLangArr[22];
			$mohr_lv0002->ArrPush[12]=$vLangArr[23];
			$strAllTr=$mohr_lv0002->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$objvalue);
			break;
		case 'hr_lv0211':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/hr_lv0211.php");
			$mohr_lv0211=new hr_lv0211($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0211');
			$vLangArr=GetLangFile("../../","SL0323.txt",'VN');

			//////////////////////////////////////////////////////////////////////////////////////////////////////
			$mohr_lv0211->ArrPush[0]=$vLangArr[17];
			$mohr_lv0211->ArrPush[1]=$vLangArr[18];
			$mohr_lv0211->ArrPush[2]=$vLangArr[20];
			$mohr_lv0211->ArrPush[3]=$vLangArr[21];
			$mohr_lv0211->ArrPush[4]=$vLangArr[22];
			$mohr_lv0211->ArrPush[5]=$vLangArr[23];
			$mohr_lv0211->ArrPush[6]=$vLangArr[24];
			$mohr_lv0211->ArrPush[7]=$vLangArr[25];
			$mohr_lv0211->ArrPush[8]=$vLangArr[26];
			$mohr_lv0211->ArrPush[9]=$vLangArr[27];
			$mohr_lv0211->ArrPush[10]=$vLangArr[28];
			$mohr_lv0211->ArrPush[11]=$vLangArr[29];
			$mohr_lv0211->ArrPush[12]='Nhấp nháy';
			$strAllTr=$mohr_lv0211->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$objvalue);
			break;
		case 'hr_lv0020':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/hr_lv0020.php");
			$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0111');
			$vLangArr=GetLangFile("../../","AD0025.txt",'VN');
			$mohr_lv0020->ArrPush[0]=$vLangArr[17];
			$mohr_lv0020->ArrPush[1]=$vLangArr[18];
			$mohr_lv0020->ArrPush[2]=$vLangArr[19];
			$mohr_lv0020->ArrPush[3]=$vLangArr[20];
			$mohr_lv0020->ArrPush[4]=$vLangArr[21];
			$mohr_lv0020->ArrPush[5]=$vLangArr[22];
			$mohr_lv0020->ArrPush[6]=$vLangArr[23];
			$mohr_lv0020->ArrPush[7]=$vLangArr[24];
			$mohr_lv0020->ArrPush[8]=$vLangArr[25];
			$mohr_lv0020->ArrPush[9]=$vLangArr[26];
			$mohr_lv0020->ArrPush[10]=$vLangArr[27];
			$mohr_lv0020->ArrPush[11]=$vLangArr[28];
			$mohr_lv0020->ArrPush[12]=$vLangArr[29];
			$mohr_lv0020->ArrPush[13]=$vLangArr[30];
			$mohr_lv0020->ArrPush[14]=$vLangArr[31];
			$mohr_lv0020->ArrPush[15]=$vLangArr[32];
			$mohr_lv0020->ArrPush[16]=$vLangArr[33];
			$mohr_lv0020->ArrPush[17]=$vLangArr[34];
			$mohr_lv0020->ArrPush[18]=$vLangArr[35];
			$mohr_lv0020->ArrPush[19]=$vLangArr[36];
			$mohr_lv0020->ArrPush[20]=$vLangArr[37];
			$mohr_lv0020->ArrPush[21]=$vLangArr[38];
			$mohr_lv0020->ArrPush[22]=$vLangArr[39];
			$mohr_lv0020->ArrPush[23]=$vLangArr[40];
			$mohr_lv0020->ArrPush[24]=$vLangArr[41];
			$mohr_lv0020->ArrPush[25]=$vLangArr[42];
			$mohr_lv0020->ArrPush[26]=$vLangArr[43];
			$mohr_lv0020->ArrPush[27]=$vLangArr[44];
			$mohr_lv0020->ArrPush[28]=$vLangArr[45];
			$mohr_lv0020->ArrPush[29]=$vLangArr[46];
			$mohr_lv0020->ArrPush[30]=$vLangArr[47];
			$mohr_lv0020->ArrPush[31]=$vLangArr[48];
			$mohr_lv0020->ArrPush[32]=$vLangArr[49];
			$mohr_lv0020->ArrPush[33]=$vLangArr[50];
			$mohr_lv0020->ArrPush[34]=$vLangArr[51];
			$mohr_lv0020->ArrPush[35]=$vLangArr[52];
			$mohr_lv0020->ArrPush[36]=$vLangArr[53];
			$mohr_lv0020->ArrPush[37]=$vLangArr[54];
			$mohr_lv0020->ArrPush[38]=$vLangArr[55];
			$mohr_lv0020->ArrPush[39]=$vLangArr[56];
			$mohr_lv0020->ArrPush[40]=$vLangArr[57];
			$mohr_lv0020->ArrPush[41]=$vLangArr[58];
			$mohr_lv0020->ArrPush[206]=$vLangArr[63];
			$mohr_lv0020->ArrPush[207]=$vLangArr[64];
			$strAllTr=$mohr_lv0020->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$objvalue);
			break;
		case 'hr_lv0111':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/hr_lv0111.php");
			$mohr_lv0111=new hr_lv0111($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0111');
			$vLangArr=GetLangFile("../../","HR0220.txt",'VN');
			$mohr_lv0111->ArrPush[0]=$vLangArr[17];
			$mohr_lv0111->ArrPush[1]=$vLangArr[18];
			$mohr_lv0111->ArrPush[2]=$vLangArr[19];
			$mohr_lv0111->ArrPush[3]=$vLangArr[20];
			$mohr_lv0111->ArrPush[4]=$vLangArr[21];
			$mohr_lv0111->ArrPush[5]=$vLangArr[22];
			$mohr_lv0111->ArrPush[6]=$vLangArr[23];
			$mohr_lv0111->ArrPush[7]=$vLangArr[24];
			$mohr_lv0111->ArrPush[8]=$vLangArr[25];
			$mohr_lv0111->ArrPush[9]=$vLangArr[26];
			$mohr_lv0111->ArrPush[10]=$vLangArr[27];
			$mohr_lv0111->ArrPush[11]=$vLangArr[28];
			$mohr_lv0111->ArrPush[12]=$vLangArr[29];
			$strAllTr=$mohr_lv0111->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$objvalue);
			break;
		case 'sl_lv0013':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/sl_lv0013.php");
			$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
			$vLangArr=GetLangFile("../../","SL0027.txt",'VN');
			$mosl_lv0013->lang='VN';
			$mosl_lv0013->ArrPush[0]=$vLangArr[17];
			$mosl_lv0013->ArrPush[1]=$vLangArr[18];
			$mosl_lv0013->ArrPush[2]=$vLangArr[19];
			$mosl_lv0013->ArrPush[3]=$vLangArr[20];
			$mosl_lv0013->ArrPush[4]=$vLangArr[21];
			$mosl_lv0013->ArrPush[5]=$vLangArr[22];
			$mosl_lv0013->ArrPush[6]=$vLangArr[23];
			$mosl_lv0013->ArrPush[7]=$vLangArr[24];
			$mosl_lv0013->ArrPush[8]=$vLangArr[25];
			$mosl_lv0013->ArrPush[9]=$vLangArr[26];
			$mosl_lv0013->ArrPush[10]=$vLangArr[27];
			$mosl_lv0013->ArrPush[11]=$vLangArr[28];
			$mosl_lv0013->ArrPush[12]=$vLangArr[29];
			$mosl_lv0013->ArrPush[13]=$vLangArr[30];
			$mosl_lv0013->ArrPush[14]=$vLangArr[31];
			$mosl_lv0013->ArrPush[15]=$vLangArr[32];
			$mosl_lv0013->ArrPush[16]=$vLangArr[33];
			$mosl_lv0013->ArrPush[17]=$vLangArr[34];
			$mosl_lv0013->ArrPush[18]=$vLangArr[35];
			$mosl_lv0013->ArrPush[19]=$vLangArr[36];
			$mosl_lv0013->ArrPush[20]=$vLangArr[37];
			$mosl_lv0013->ArrPush[21]=$vLangArr[38];
			$mosl_lv0013->ArrPush[22]=$vLangArr[39];
			$mosl_lv0013->ArrPush[23]=$vLangArr[40];
			$mosl_lv0013->ArrPush[24]=$vLangArr[41];
			$mosl_lv0013->ArrPush[25]=$vLangArr[42];
			$mosl_lv0013->ArrPush[26]=$vLangArr[43];
			$mosl_lv0013->ArrPush[27]=$vLangArr[44];
			$mosl_lv0013->ArrPush[28]=$vLangArr[45];				
			$mosl_lv0013->ArrPush[29]=$vLangArr[46];
			$mosl_lv0013->ArrPush[30]=$vLangArr[47];
			$mosl_lv0013->ArrPush[31]=$vLangArr[48];
			$mosl_lv0013->ArrPush[70]='PBH Số(Cũ)';

			$mosl_lv0013->ArrPush[102]=$vLangArr[49];
			$mosl_lv0013->ArrPush[103]=$vLangArr[50];
			$mosl_lv0013->ArrPush[104]=$vLangArr[51];
			$mosl_lv0013->ArrPush[105]=$vLangArr[52];
			$mosl_lv0013->ArrPush[106]=$vLangArr[53];
			$mosl_lv0013->ArrPush[107]=$vLangArr[54];
			$mosl_lv0013->ArrPush[108]=$vLangArr[55];
			$mosl_lv0013->ArrPush[109]=$vLangArr[56];
			$mosl_lv0013->ArrPush[110]=$vLangArr[57];
			$mosl_lv0013->ArrPush[111]=$vLangArr[58];
			$mosl_lv0013->ArrPush[112]=$vLangArr[59];
			$mosl_lv0013->ArrPush[113]=$vLangArr[60];
			$mosl_lv0013->ArrPush[114]=$vLangArr[61];
			$mosl_lv0013->ArrPush[115]=$vLangArr[62];
			$mosl_lv0013->ArrPush[116]=$vLangArr[63];
			$mosl_lv0013->ArrPush[117]=$vLangArr[64];
			$mosl_lv0013->ArrPush[118]=$vLangArr[65];
			$mosl_lv0013->ArrPush[201]='HĐKT đính kèm';
			$mosl_lv0013->ArrPush[213]='Số PBH Mẫu';
			$mosl_lv0013->ArrPush[215]='Số BM/MR';
			$mosl_lv0013->ArrPush[225]='PLHĐKT';

			$mosl_lv0013->ArrPush[226]='NGÀY GH DỰ KIẾN';
			$mosl_lv0013->ArrPush[227]='TÌNH TRẠNG GH';
			$mosl_lv0013->ArrPush[228]='CẢNH BÁO HẠN GIAO HÀNG';
			$mosl_lv0013->ArrPush[229]='TÌNH TRẠNG ĐẶT HÀNG';
			$mosl_lv0013->ArrPush[230]='DK NGÀY HÀNG  VỀ TỪ';
			$mosl_lv0013->ArrPush[231]='DK NGÀY HÀNG VỀ ĐẾN';
			$mosl_lv0013->ArrPush[232]='GHI CHÚ';

			$mosl_lv0013->ArrPush[351]='TT trước';
			$mosl_lv0013->ArrPush[354]='Ngày giao hàng lần cuối tính bảo hành';
			$mosl_lv0013->ArrPush[355]='Ngày hết hạn BH';
			$strAllTr=$mosl_lv0013->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$objvalue);
			break;
		case 'sl_lv0010':
			$strul="<ul id=subpop-nav><li class=menupopT><table border=0 width=100% class=\"lvtable\">@#01</table></li></ul>";
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/sl_lv0010.php");
			$mosl_lv0010=new sl_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0012');
			$vLangArr=GetLangFile("../../","SL0020.txt",'VN');
			$mosl_lv0010->lang='VN';
			$mosl_lv0010->ArrPush[0]=$vLangArr[17];
			$mosl_lv0010->ArrPush[1]=$vLangArr[18];
			$mosl_lv0010->ArrPush[2]=$vLangArr[19];
			$mosl_lv0010->ArrPush[3]=$vLangArr[20];
			$mosl_lv0010->ArrPush[4]=$vLangArr[21];
			$mosl_lv0010->ArrPush[5]=$vLangArr[22];
			$mosl_lv0010->ArrPush[6]=$vLangArr[23];
			$mosl_lv0010->ArrPush[7]=$vLangArr[24];
			$mosl_lv0010->ArrPush[8]=$vLangArr[25];
			$mosl_lv0010->ArrPush[9]=$vLangArr[26];
			$mosl_lv0010->ArrPush[10]=$vLangArr[27];
			$mosl_lv0010->ArrPush[11]=$vLangArr[28];
			$mosl_lv0010->ArrPush[12]=$vLangArr[29];
			$mosl_lv0010->ArrPush[13]=$vLangArr[30];
			$mosl_lv0010->ArrPush[14]=$vLangArr[31];
			$mosl_lv0010->ArrPush[15]=$vLangArr[32];
			$mosl_lv0010->ArrPush[16]=$vLangArr[33];
			$mosl_lv0010->ArrPush[17]=$vLangArr[34];
			$mosl_lv0010->ArrPush[18]=$vLangArr[35];
			$mosl_lv0010->ArrPush[19]=$vLangArr[36];
			$mosl_lv0010->ArrPush[20]=$vLangArr[37];
			$mosl_lv0010->ArrPush[21]=$vLangArr[38];
			$mosl_lv0010->ArrPush[22]=$vLangArr[39];
			$mosl_lv0010->ArrPush[23]=$vLangArr[40];
			$mosl_lv0010->ArrPush[24]=$vLangArr[41];
			$mosl_lv0010->ArrPush[25]=$vLangArr[42];
			$mosl_lv0010->ArrPush[26]=$vLangArr[43];
			$mosl_lv0010->ArrPush[27]=$vLangArr[44];
			$mosl_lv0010->ArrPush[28]=$vLangArr[45];
			$mosl_lv0010->ArrPush[29]=$vLangArr[46];
			$mosl_lv0010->ArrPush[30]=$vLangArr[47];
			$mosl_lv0010->ArrPush[31]=$vLangArr[48];

			$mosl_lv0010->ArrPush[102]=$vLangArr[49];
			$mosl_lv0010->ArrPush[103]=$vLangArr[50];
			$mosl_lv0010->ArrPush[104]=$vLangArr[51];
			$mosl_lv0010->ArrPush[105]=$vLangArr[52];
			$mosl_lv0010->ArrPush[106]=$vLangArr[53];
			$mosl_lv0010->ArrPush[107]=$vLangArr[54];
			$mosl_lv0010->ArrPush[108]=$vLangArr[55];
			$mosl_lv0010->ArrPush[109]=$vLangArr[56];
			$mosl_lv0010->ArrPush[110]=$vLangArr[57];
			$mosl_lv0010->ArrPush[111]=$vLangArr[58];
			$mosl_lv0010->ArrPush[112]=$vLangArr[59];
			$mosl_lv0010->ArrPush[113]=$vLangArr[60];
			$mosl_lv0010->ArrPush[114]=$vLangArr[61];
			$mosl_lv0010->ArrPush[115]=$vLangArr[62];
			$mosl_lv0010->ArrPush[116]=$vLangArr[63];
			$mosl_lv0010->ArrPush[117]=$vLangArr[64];
			$mosl_lv0010->ArrPush[118]=$vLangArr[65];
			$mosl_lv0010->ArrPush[201]='BBG đính kèm';
			$mosl_lv0010->ArrPush[170]='Loại giảm giá';
			$mosl_lv0010->ArrPush[169]='Nhập giá sau giảm';

			$mosl_lv0010->ArrPush[395]='Người đề xuất duyệt';
			$mosl_lv0010->ArrPush[396]='Ngày giờ đề xuất duyệt';
			$mosl_lv0010->ArrPush[397]='Ngôn ngữ';
			$mosl_lv0010->ArrPush[398]='Mẫu BBG';
			$mosl_lv0010->ArrPush[399]='Field List';
			$mosl_lv0010->ArrPush[400]='Order List';

			$mosl_lv0010->ArrPush[900]='Tiền trước thuế';
			$strAllTr=$mosl_lv0010->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$objvalue);
			break;
		case 'sl_lv0001':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/sl_lv0001.php");
			$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
			$vLangArr=GetLangFile("../../","SL0001.txt",'VN');
			$mosl_lv0001->ArrPush[0]=$vLangArr[17];
			$mosl_lv0001->ArrPush[1]=$vLangArr[18];
			$mosl_lv0001->ArrPush[2]=$vLangArr[19];
			$mosl_lv0001->ArrPush[3]=$vLangArr[20];
			$mosl_lv0001->ArrPush[4]=$vLangArr[21];
			$mosl_lv0001->ArrPush[5]=$vLangArr[22];
			$mosl_lv0001->ArrPush[6]=$vLangArr[23];
			$mosl_lv0001->ArrPush[7]=$vLangArr[24];
			$mosl_lv0001->ArrPush[8]=$vLangArr[25];
			$mosl_lv0001->ArrPush[9]=$vLangArr[26];
			$mosl_lv0001->ArrPush[10]=$vLangArr[27];
			$mosl_lv0001->ArrPush[11]=$vLangArr[28];
			$mosl_lv0001->ArrPush[12]=$vLangArr[29];
			$mosl_lv0001->ArrPush[13]=$vLangArr[30];
			$mosl_lv0001->ArrPush[14]=$vLangArr[31];
			$mosl_lv0001->ArrPush[15]=$vLangArr[32];
			$mosl_lv0001->ArrPush[16]=$vLangArr[33];
			$mosl_lv0001->ArrPush[17]=$vLangArr[34];
			$mosl_lv0001->ArrPush[18]=$vLangArr[35];
			$mosl_lv0001->ArrPush[19]=$vLangArr[36];
			$mosl_lv0001->ArrPush[20]=$vLangArr[37];
			$mosl_lv0001->ArrPush[21]=$vLangArr[38];
			$mosl_lv0001->ArrPush[22]=$vLangArr[39];
			$mosl_lv0001->ArrPush[23]=$vLangArr[40];
			$mosl_lv0001->ArrPush[24]=$vLangArr[41];
			$mosl_lv0001->ArrPush[25]=$vLangArr[42];
			$mosl_lv0001->ArrPush[26]=$vLangArr[43];

			$mosl_lv0001->ArrPush[804]='Contact Name';
			$mosl_lv0001->ArrPush[805]='Title';
			$mosl_lv0001->ArrPush[806]='Mobile phone';
			$strAllTr=$mosl_lv0001->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$vLayVe);
			break;
		case 'sl_lv0007':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/sl_lv0007.php");
			$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0008');
			$vLangArr=GetLangFile("../../","SL0014.txt",'VN');
			$mosl_lv0007->ArrPush[0]=$vLangArr[17];
			$mosl_lv0007->ArrPush[1]=$vLangArr[18];
			$mosl_lv0007->ArrPush[2]=$vLangArr[19];
			$mosl_lv0007->ArrPush[3]=$vLangArr[20];
			$mosl_lv0007->ArrPush[4]=$vLangArr[21];
			$mosl_lv0007->ArrPush[5]=$vLangArr[22];
			$mosl_lv0007->ArrPush[6]=$vLangArr[23];
			$mosl_lv0007->ArrPush[7]=$vLangArr[24];
			$mosl_lv0007->ArrPush[8]=$vLangArr[25];
			$mosl_lv0007->ArrPush[9]=$vLangArr[26];
			$mosl_lv0007->ArrPush[10]=$vLangArr[27];
			$mosl_lv0007->ArrPush[11]=$vLangArr[28];
			$mosl_lv0007->ArrPush[12]=$vLangArr[29];
			$mosl_lv0007->ArrPush[13]=$vLangArr[30];
			$mosl_lv0007->ArrPush[14]=$vLangArr[31];
			$mosl_lv0007->ArrPush[15]=$vLangArr[32];
			$mosl_lv0007->ArrPush[16]=$vLangArr[33];
			$mosl_lv0007->ArrPush[17]=$vLangArr[41];
			$mosl_lv0007->ArrPush[18]=$vLangArr[42];
			$mosl_lv0007->ArrPush[19]=$vLangArr[43];
			$mosl_lv0007->ArrPush[20]=$vLangArr[44];
			$mosl_lv0007->ArrPush[23]='Giá vốn/Giá BQ';
			$mosl_lv0007->ArrPush[100]='Mã barcode';
			$mosl_lv0007->ArrPush[300]='Có BOM';
			$mosl_lv0007->ArrPush[99]='Không cần tồn';
			$strAllTr=$mosl_lv0007->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$vLayVe);
			break;
		case 'cr_lv0005':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/cr_lv0005.php");
			$mocr_lv0005=new cr_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0005');
			$vLangArr=GetLangFile("../../","CR0007.txt",$plang);

			//////////////////////////////////////////////////////////////////////////////////////////////////////
			$mocr_lv0005->ArrPush[0]=$vLangArr[17];
			$mocr_lv0005->ArrPush[1]=$vLangArr[18];
			$mocr_lv0005->ArrPush[2]=$vLangArr[19];
			$mocr_lv0005->ArrPush[3]=$vLangArr[20];
			$mocr_lv0005->ArrPush[4]=$vLangArr[21];
			$mocr_lv0005->ArrPush[5]=$vLangArr[22];
			$mocr_lv0005->ArrPush[6]=$vLangArr[23];
			$mocr_lv0005->ArrPush[7]=$vLangArr[24];
			$mocr_lv0005->ArrPush[8]=$vLangArr[25];
			$mocr_lv0005->ArrPush[9]=$vLangArr[26];
			$mocr_lv0005->ArrPush[10]=$vLangArr[27];
			$mocr_lv0005->ArrPush[11]=$vLangArr[28];
			$mocr_lv0005->ArrPush[12]=$vLangArr[29];
			$mocr_lv0005->ArrPush[13]=$vLangArr[30];
			$mocr_lv0005->ArrPush[14]=$vLangArr[31];
			$mocr_lv0005->ArrPush[15]=$vLangArr[32];
			$mocr_lv0005->ArrPush[16]=$vLangArr[33];
			$mocr_lv0005->ArrPush[17]=$vLangArr[34];
			$mocr_lv0005->ArrPush[18]=$vLangArr[35];
			$mocr_lv0005->ArrPush[100]=$vLangArr[48];
			$strAllTr=$mocr_lv0005->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$vLayVe);
			break;
		case 'wh_lv0003':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/wh_lv0003.php");
			$mowh_lv0003=new wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
			$vLangArr=GetLangFile("../../","WH0003.txt",'VN');
			$mowh_lv0003->lang='VN';
			$mowh_lv0003->ArrPush[0]=$vLangArr[17];
			$mowh_lv0003->ArrPush[1]=$vLangArr[18];
			$mowh_lv0003->ArrPush[2]=$vLangArr[19];
			$mowh_lv0003->ArrPush[3]=$vLangArr[20];
			$mowh_lv0003->ArrPush[4]=$vLangArr[21];
			$mowh_lv0003->ArrPush[5]=$vLangArr[22];
			$mowh_lv0003->ArrPush[6]=$vLangArr[23];
			$mowh_lv0003->ArrPush[7]=$vLangArr[24];
			$mowh_lv0003->ArrPush[8]=$vLangArr[25];
			$mowh_lv0003->ArrPush[9]=$vLangArr[26];
			$mowh_lv0003->ArrPush[10]=$vLangArr[27];
			$mowh_lv0003->ArrPush[11]=$vLangArr[28];
			$mowh_lv0003->ArrPush[12]=$vLangArr[29];
			$mowh_lv0003->ArrPush[13]='Địa chỉ ngân hàng';
			$mowh_lv0003->ArrPush[14]=$vLangArr[31];
			$mowh_lv0003->ArrPush[15]=$vLangArr[32];
			$mowh_lv0003->ArrPush[16]=$vLangArr[33];
			$mowh_lv0003->ArrPush[17]='Tài khoản';

			$mowh_lv0003->ArrPush[18]='Chi nhanh';
			$mowh_lv0003->ArrPush[19]='Xếp hạng';
			$mowh_lv0003->ArrPush[20]='Tên ngân hàng';
			$mowh_lv0003->ArrPush[21]='Chủ tài khoản';
			$mowh_lv0003->ArrPush[22]=$vLangArr[46];
			$mowh_lv0003->ArrPush[23]='Swift Code';
			$mowh_lv0003->ArrPush[25]='Ngày tạo';
			$mowh_lv0003->ArrPush[26]='Người tạo';
			$mowh_lv0003->ArrPush[27]=$vLangArr[47];
			$mowh_lv0003->ArrPush[98]=$vLangArr[48];
			$mowh_lv0003->ArrPush[99]=$vLangArr[49];
			$mowh_lv0003->ArrPush[100]=$vLangArr[50];
			$strAllTr=$mowh_lv0003->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$vLayVe);
			break;
		case 'wh_lv0021':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/wh_lv0021.php");
			$mowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0021');
			$vLangArr=GetLangFile("../../","WH0024.txt",'VN');
			$mowh_lv0021->lang='VN';
			//////////////////////////////////////////////////////////////////////////////////////////////////////
			$mowh_lv0021->ArrPush[0]=$vLangArr[17];
			$mowh_lv0021->ArrPush[1]=$vLangArr[18];
			$mowh_lv0021->ArrPush[2]=$vLangArr[19];
			$mowh_lv0021->ArrPush[3]=$vLangArr[20];
			$mowh_lv0021->ArrPush[4]=$vLangArr[21];
			$mowh_lv0021->ArrPush[5]=$vLangArr[22];
			$mowh_lv0021->ArrPush[6]=$vLangArr[23];
			$mowh_lv0021->ArrPush[7]=$vLangArr[24];
			$mowh_lv0021->ArrPush[8]=$vLangArr[25];
			$mowh_lv0021->ArrPush[9]=$vLangArr[26];
			$mowh_lv0021->ArrPush[10]=$vLangArr[27];
			$mowh_lv0021->ArrPush[11]=$vLangArr[28];
			$mowh_lv0021->ArrPush[12]=$vLangArr[29];
			$mowh_lv0021->ArrPush[13]=$vLangArr[40];
			$mowh_lv0021->ArrPush[14]=$vLangArr[31];
			$mowh_lv0021->ArrPush[15]=$vLangArr[32];

			$mowh_lv0021->ArrPush[88]='Mã nhóm đơn hàng';
			$mowh_lv0021->ArrPush[28]='Trạng thái duyệt';
			$mowh_lv0021->ArrPush[89]='Phiếu ĐNVT';
			$mowh_lv0021->ArrPush[90]='PBH Số';
			$mowh_lv0021->ArrPush[190]='Tên dự án';
			$mowh_lv0021->ArrPush[91]='Phiếu đầu ra';
			$mowh_lv0021->ArrPush[213]='Tổng tiền';
			$mowh_lv0021->ArrPush[214]='Thanh toán';
			$mowh_lv0021->ArrPush[99]='Tiền nợ treo';
			$mowh_lv0021->ArrPush[100]='Tiền nợ còn lại';
			$mowh_lv0021->ArrPush[115]='Mã công việc';
			$strAllTr=$mowh_lv0021->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$vLayVe);
			break;
		case 'cr_lv0283':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/cr_lv0283.php");
			$mocr_lv0283=new cr_lv0283($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0022');
			$vLangArr=GetLangFile("../../","CR0102.txt",'VN');
			$mocr_lv0283->ArrPush[0]=$vLangArr[17];
			$mocr_lv0283->ArrPush[1]=$vLangArr[18];
			$mocr_lv0283->ArrPush[2]=$vLangArr[19];
			$mocr_lv0283->ArrPush[3]=$vLangArr[20];
			$mocr_lv0283->ArrPush[4]=$vLangArr[21];
			$mocr_lv0283->ArrPush[5]=$vLangArr[22];
			$mocr_lv0283->ArrPush[6]=$vLangArr[23];
			$mocr_lv0283->ArrPush[7]=$vLangArr[24];
			$mocr_lv0283->ArrPush[8]=$vLangArr[25];
			$mocr_lv0283->ArrPush[9]=$vLangArr[26];
			$mocr_lv0283->ArrPush[10]='Ghi chú';
			$mocr_lv0283->ArrPush[11]='Mã NV tạo';
			$mocr_lv0283->ArrPush[12]='Ngày tạo';
			$mocr_lv0283->ArrPush[13]='Tiền tệ thứ 2';
			$mocr_lv0283->ArrPush[14]='Tỷ giá VNĐ';
			$mocr_lv0283->ArrPush[15]='';
			$mocr_lv0283->ArrPush[16]='Tỷ giá tiền tệ thứ 2';
			$mocr_lv0283->ArrPush[17]='Tiền tệ chính';

			$mocr_lv0283->ArrPush[89]='Phiếu ĐNVT';
			$mocr_lv0283->ArrPush[90]='PBH Số';
			$mocr_lv0283->ArrPush[190]='Tên dự án';
			$mocr_lv0283->ArrPush[91]='Phiếu đầu ra';
			$mocr_lv0283->ArrPush[212]='Tổng tiền mua VNĐ';
			$mocr_lv0283->ArrPush[212]='Tổng tiền mua VNĐ';
			$mocr_lv0283->ArrPush[213]='Tổng tiền mua chính';
			$mocr_lv0283->ArrPush[214]='Thanh toán chính';
			$mocr_lv0283->ArrPush[215]='Tổng tiền mua thứ 2';
			$mocr_lv0283->ArrPush[216]='Thanh toán thứ 2';
			$mocr_lv0283->ArrPush[217]='Qui đổi thanh toán thứ 2 → chính';
			$mocr_lv0283->ArrPush[218]='Qui đổi thanh toán';
			$mocr_lv0283->ArrPush[219]='Tổng tiền nợ còn lại';
			$mocr_lv0283->ArrPush[221]='Thanh toán VND';
			$mocr_lv0283->ArrPush[222]='Qui đổi thanh toán VND → chính';

			$mocr_lv0283->ArrPush[99]='Tiền nợ treo';
			$mocr_lv0283->ArrPush[100]='Tiền nợ còn lại';
			$mocr_lv0283->ArrPush[115]='Mã công việc';


			$mocr_lv0283->ArrPush[200]='Chức năng';
			$strAllTr=$mocr_lv0283->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$vLayVe);
			break;
		case 'wh_lv0022':
		case 'cr_lv0176':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/cr_lv0176.php");
			$mocr_lv0176=new cr_lv0176($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0022');
			$vLangArr=GetLangFile("../../","CR0215.txt",'VN');
//////////////////////////////////////////////////////////////////////////////////////////////////////
			$mocr_lv0176->ArrPush[0]=$vLangArr[17];
			$mocr_lv0176->ArrPush[1]=$vLangArr[18];
			$mocr_lv0176->ArrPush[2]=$vLangArr[19];
			$mocr_lv0176->ArrPush[3]=$vLangArr[20];
			$mocr_lv0176->ArrPush[4]=$vLangArr[21];
			$mocr_lv0176->ArrPush[5]=$vLangArr[22];
			$mocr_lv0176->ArrPush[6]=$vLangArr[23];
			$mocr_lv0176->ArrPush[7]=$vLangArr[24];
			$mocr_lv0176->ArrPush[8]=$vLangArr[25];
			$mocr_lv0176->ArrPush[9]=$vLangArr[26];
			$mocr_lv0176->ArrPush[10]=$vLangArr[27];
			$mocr_lv0176->ArrPush[11]=$vLangArr[28];
			$mocr_lv0176->ArrPush[12]=$vLangArr[29];
			$mocr_lv0176->ArrPush[13]='Our ref.';
			$mocr_lv0176->ArrPush[14]=$vLangArr[31];
			$mocr_lv0176->ArrPush[15]=$vLangArr[32];
			$mocr_lv0176->ArrPush[16]=$vLangArr[33];
			$mocr_lv0176->ArrPush[17]=$vLangArr[34];
			$mocr_lv0176->ArrPush[18]=$vLangArr[35];
			$mocr_lv0176->ArrPush[19]=$vLangArr[36];
			$mocr_lv0176->ArrPush[20]=$vLangArr[37];
			$mocr_lv0176->ArrPush[21]=$vLangArr[38];
			$mocr_lv0176->ArrPush[22]=$vLangArr[39];
			$mocr_lv0176->ArrPush[23]=$vLangArr[40];
			$mocr_lv0176->ArrPush[24]=$vLangArr[41];
			$mocr_lv0176->ArrPush[25]=$vLangArr[42];
			$mocr_lv0176->ArrPush[26]=$vLangArr[43];
			$mocr_lv0176->ArrPush[27]=$vLangArr[44];
			$mocr_lv0176->ArrPush[28]=$vLangArr[45];
			$mocr_lv0176->ArrPush[29]=$vLangArr[46];
			$mocr_lv0176->ArrPush[30]=$vLangArr[47];
			$mocr_lv0176->ArrPush[31]=$vLangArr[48];
			$mocr_lv0176->ArrPush[32]=$vLangArr[49];
			$mocr_lv0176->ArrPush[33]=$vLangArr[50];
			$mocr_lv0176->ArrPush[34]=$vLangArr[51];
			$mocr_lv0176->ArrPush[35]=$vLangArr[52];
			$mocr_lv0176->ArrPush[36]=$vLangArr[53];
			$mocr_lv0176->ArrPush[37]=$vLangArr[54];
			$mocr_lv0176->ArrPush[38]=$vLangArr[55];
			$mocr_lv0176->ArrPush[39]=$vLangArr[56];
			$mocr_lv0176->ArrPush[40]=$vLangArr[57];
			$mocr_lv0176->ArrPush[41]=$vLangArr[58];
			$mocr_lv0176->ArrPush[42]=$vLangArr[59];
			$mocr_lv0176->ArrPush[43]=$vLangArr[60];
			$mocr_lv0176->ArrPush[44]=$vLangArr[61];
			$mocr_lv0176->ArrPush[45]=$vLangArr[62];
			$mocr_lv0176->ArrPush[46]=$vLangArr[63];
			$mocr_lv0176->ArrPush[47]=$vLangArr[64];
			$mocr_lv0176->ArrPush[48]=$vLangArr[65];
			$mocr_lv0176->ArrPush[49]=$vLangArr[66];
			$mocr_lv0176->ArrPush[50]=$vLangArr[67];
			$mocr_lv0176->ArrPush[51]=$vLangArr[68];
			$mocr_lv0176->ArrPush[52]=$vLangArr[69];
			$mocr_lv0176->ArrPush[53]=$vLangArr[70];
			$mocr_lv0176->ArrPush[54]=$vLangArr[71];
			$mocr_lv0176->ArrPush[55]=$vLangArr[72];
			$mocr_lv0176->ArrPush[56]=$vLangArr[73];
			$mocr_lv0176->ArrPush[57]=$vLangArr[74];
			$mocr_lv0176->ArrPush[58]=$vLangArr[75];
			$mocr_lv0176->ArrPush[59]=$vLangArr[76];
			$mocr_lv0176->ArrPush[60]=$vLangArr[77];
			$mocr_lv0176->ArrPush[61]=$vLangArr[78];
			$mocr_lv0176->ArrPush[62]='Hình ảnh';
			$mocr_lv0176->ArrPush[63]=$vLangArr[80];
			$mocr_lv0176->ArrPush[64]=$vLangArr[81];

			$mocr_lv0176->ArrPush[65]=$vLangArr[82];
			$mocr_lv0176->ArrPush[66]=$vLangArr[83];
			$mocr_lv0176->ArrPush[69]=$vLangArr[91];
			$mocr_lv0176->ArrPush[71]='Giảm giá';
			$mocr_lv0176->ArrPush[200]='Chức năng';
			$mocr_lv0176->ArrPush[100]='Mã cha';

			$mocr_lv0176->ArrPush[81]=$vLangArr[92];
			$mocr_lv0176->ArrPush[82]=$vLangArr[93];
			$mocr_lv0176->ArrPush[83]=$vLangArr[94];
			$mocr_lv0176->ArrPush[84]=$vLangArr[95];
			$mocr_lv0176->ArrPush[85]=$vLangArr[96];
			$mocr_lv0176->ArrPush[86]=$vLangArr[97];
			$mocr_lv0176->ArrPush[87]=$vLangArr[98];
			$mocr_lv0176->ArrPush[88]=$vLangArr[99];
			$mocr_lv0176->ArrPush[89]=$vLangArr[100];
			$mocr_lv0176->ArrPush[90]=$vLangArr[101];
			$mocr_lv0176->ArrPush[91]=$vLangArr[102];
			$mocr_lv0176->ArrPush[92]=$vLangArr[103];
			$mocr_lv0176->ArrPush[93]=$vLangArr[104];
			$mocr_lv0176->ArrPush[94]=$vLangArr[105];
			$mocr_lv0176->ArrPush[95]=$vLangArr[106];
			$mocr_lv0176->ArrPush[96]=$vLangArr[107];

			$mocr_lv0176->ArrPush[102]=$vLangArr[108];
			$mocr_lv0176->ArrPush[103]=$vLangArr[109];
			$mocr_lv0176->ArrPush[104]=$vLangArr[110];
			$mocr_lv0176->ArrPush[105]=$vLangArr[111];

			$mocr_lv0176->ArrPush[111]=$vLangArr[112];
			$mocr_lv0176->ArrPush[112]=$vLangArr[113];
			$mocr_lv0176->ArrPush[113]=$vLangArr[114];
			$mocr_lv0176->ArrPush[114]=$vLangArr[115];
			$mocr_lv0176->ArrPush[115]=$vLangArr[116];
			$mocr_lv0176->ArrPush[116]=$vLangArr[117];
			$mocr_lv0176->ArrPush[117]=$vLangArr[118];
			$mocr_lv0176->ArrPush[118]=$vLangArr[119];
			$mocr_lv0176->ArrPush[119]=$vLangArr[120];
			$mocr_lv0176->ArrPush[120]=$vLangArr[121];
			$mocr_lv0176->ArrPush[121]=$vLangArr[122];
			$mocr_lv0176->ArrPush[122]=$vLangArr[123];
			$mocr_lv0176->ArrPush[123]=$vLangArr[124];
			$mocr_lv0176->ArrPush[124]=$vLangArr[125];
			$mocr_lv0176->ArrPush[125]=$vLangArr[126];
			$mocr_lv0176->ArrPush[126]=$vLangArr[127];
			$mocr_lv0176->ArrPush[127]=$vLangArr[128];
			$mocr_lv0176->ArrPush[128]=$vLangArr[129];
			$mocr_lv0176->ArrPush[129]=$vLangArr[130];
			$mocr_lv0176->ArrPush[130]=$vLangArr[131];
			$mocr_lv0176->ArrPush[131]=$vLangArr[132];
			$mocr_lv0176->ArrPush[132]=$vLangArr[133];
			$mocr_lv0176->ArrPush[133]=$vLangArr[134];
			$mocr_lv0176->ArrPush[134]=$vLangArr[135];
			$mocr_lv0176->ArrPush[135]=$vLangArr[136];
			$mocr_lv0176->ArrPush[136]=$vLangArr[137];
			$mocr_lv0176->ArrPush[137]=$vLangArr[138];
			$mocr_lv0176->ArrPush[138]=$vLangArr[139];
			$mocr_lv0176->ArrPush[139]=$vLangArr[140];
			$mocr_lv0176->ArrPush[140]='Code';
			$mocr_lv0176->ArrPush[141]='Hạn bảo hành';
			$mocr_lv0176->ArrPush[142]='Loại lỗi s\'p';
			$mocr_lv0176->ArrPush[143]='S\'lượng s\'p lỗi';
			$mocr_lv0176->ArrPush[144]='Thời gian trả s\'p lỗi';
			$mocr_lv0176->ArrPush[145]='Mã hàng NCC';
			$mocr_lv0176->ArrPush[170]='STT';
			$mocr_lv0176->ArrPush[300]='Mã NCC';
			$mocr_lv0176->ArrPush[163]='Đơn giá';
			$mocr_lv0176->ArrPush[164]='Thành tiền';
			$mocr_lv0176->ArrPush[205]='S\'lượng<br/>Our ref.';
			$mocr_lv0176->ArrPush[146]='Phí vận chuyển s\'p lỗi';
			$mocr_lv0176->ArrPush[147]='Đơn vị vận chuyển s\'p lỗi';
			$mocr_lv0176->ArrPush[148]='Số Bill Booking Vận chuyển';
			$mocr_lv0176->ArrPush[149]='SHIPPER';
			$mocr_lv0176->ArrPush[150]='Hạn giao hàng';
			$mocr_lv0176->ArrPush[151]='Ngày giao hàng dự kiến';
			$mocr_lv0176->ArrPush[152]='Phí vận chuyển';
			$mocr_lv0176->ArrPush[153]='Type (Our ref.)';
			$mocr_lv0176->ArrPush[154]='S\'lượng<br/>Sample';
			$mocr_lv0176->ArrPush[155]='Model Sup';
			$mocr_lv0176->ArrPush[156]='Thương hiệu<br/>NCC';
			$mocr_lv0176->ArrPush[157]='S\'lượng<br/> Extra';
			$mocr_lv0176->ArrPush[158]='Ngày phát hành';
			$mocr_lv0176->ArrPush[171]='Bản vẽ';
			$mocr_lv0176->ArrPush[172]='TEST IP (54/65/67/68)';
			$mocr_lv0176->ArrPush[173]='IES File & Test Integrating Sphere';
			$mocr_lv0176->ArrPush[174]='HDLĐ & Bảo trì bảo dưỡng';
			$mocr_lv0176->ArrPush[175]='CER. LM80 Chip';
			$mocr_lv0176->ArrPush[176]='Giấy HCHQ';
			$mocr_lv0176->ArrPush[177]='Hình ảnh hàng hóa/ Đóng gói';
			$mocr_lv0176->ArrPush[178]='Hình ảnh<br/>chip/driver/Phị kiện';
			$mocr_lv0176->ArrPush[179]='Ngày giao mẫu';
			$mocr_lv0176->ArrPush[180]='Đơn vị vận chuyển mẫu';
			$mocr_lv0176->ArrPush[181]='Ngày giao hàng';
			$mocr_lv0176->ArrPush[182]='Ngày giao hàng Đợt 2';
			$mocr_lv0176->ArrPush[183]='Sample Loading By';
			$mocr_lv0176->ArrPush[184]='Địa điểm lấy hàng';
			$mocr_lv0176->ArrPush[185]='Sample Loading type DDP';
			$mocr_lv0176->ArrPush[186]='Booking Bill Draf No.';
			$mocr_lv0176->ArrPush[187]='Country';
			$mocr_lv0176->ArrPush[188]='IV No';
			$mocr_lv0176->ArrPush[189]='CO No';
			$mocr_lv0176->ArrPush[190]='CO E/D No';
			$mocr_lv0176->ArrPush[191]='Giấy chứng nhận chất lượng (CQ)';
			$mocr_lv0176->ArrPush[192]='BL No.';
			$mocr_lv0176->ArrPush[193]='PL No.';
			$mocr_lv0176->ArrPush[194]='SUR/Orgin B/L No.';
			$mocr_lv0176->ArrPush[195]='Phiếu bảo hành';

			$mocr_lv0176->ArrPush[196]='Phiếu giao hàng';
			$mocr_lv0176->ArrPush[197]='Phiếu xuất kho';
			$mocr_lv0176->ArrPush[198]='Phiếu xuất xưởng';

			$mocr_lv0176->ArrPush[915]='Proj.';
			$mocr_lv0176->ArrPush[300]='SELLER';
			$mocr_lv0176->ArrPush[211]='Thuế(%)';
			$mocr_lv0176->ArrPush[210]='Thành tiền trước thuế';
			$strAllTr=$mocr_lv0176->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$vLayVe);
			break;
		case 'cr_lv0219':
			require_once("../../clsall/lv_controler.php");
			require_once("../../clsall/cr_lv0219.php");
			$mocr_lv0219=new cr_lv0219($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0219');
			$vLangArr=GetLangFile("../../","CR0325.txt",'VN');
//////////////////////////////////////////////////////////////////////////////////////////////////////
			$mocr_lv0219->ArrPush[0]=$vLangArr[17];
			$mocr_lv0219->ArrPush[1]=$vLangArr[18];
			$mocr_lv0219->ArrPush[2]=$vLangArr[19];
			$mocr_lv0219->ArrPush[3]=$vLangArr[20];
			$mocr_lv0219->ArrPush[4]=$vLangArr[21];
			$mocr_lv0219->ArrPush[5]=$vLangArr[22];
			$mocr_lv0219->ArrPush[6]=$vLangArr[23];
			$mocr_lv0219->ArrPush[7]=$vLangArr[24];
			$mocr_lv0219->ArrPush[8]=$vLangArr[25];
			$mocr_lv0219->ArrPush[9]=$vLangArr[26];
			$mocr_lv0219->ArrPush[10]=$vLangArr[27];
			$mocr_lv0219->ArrPush[11]=$vLangArr[28];
			$mocr_lv0219->ArrPush[12]=$vLangArr[29];
			$mocr_lv0219->ArrPush[13]='Our ref.';
			$mocr_lv0219->ArrPush[14]=$vLangArr[31];
			$mocr_lv0219->ArrPush[15]=$vLangArr[32];
			$mocr_lv0219->ArrPush[16]=$vLangArr[33];
			$mocr_lv0219->ArrPush[17]=$vLangArr[34];
			$mocr_lv0219->ArrPush[18]=$vLangArr[35];
			$mocr_lv0219->ArrPush[19]=$vLangArr[36];
			$mocr_lv0219->ArrPush[20]=$vLangArr[37];
			$mocr_lv0219->ArrPush[21]=$vLangArr[38];
			$mocr_lv0219->ArrPush[22]=$vLangArr[39];
			$mocr_lv0219->ArrPush[23]=$vLangArr[40];
			$mocr_lv0219->ArrPush[24]=$vLangArr[41];
			$mocr_lv0219->ArrPush[25]=$vLangArr[42];
			$mocr_lv0219->ArrPush[26]=$vLangArr[43];
			$mocr_lv0219->ArrPush[27]=$vLangArr[44];
			$mocr_lv0219->ArrPush[28]=$vLangArr[45];
			$mocr_lv0219->ArrPush[29]=$vLangArr[46];
			$mocr_lv0219->ArrPush[30]=$vLangArr[47];
			$mocr_lv0219->ArrPush[31]=$vLangArr[48];
			$mocr_lv0219->ArrPush[32]=$vLangArr[49];
			$mocr_lv0219->ArrPush[33]=$vLangArr[50];
			$mocr_lv0219->ArrPush[34]=$vLangArr[51];
			$mocr_lv0219->ArrPush[35]=$vLangArr[52];
			$mocr_lv0219->ArrPush[36]=$vLangArr[53];
			$mocr_lv0219->ArrPush[37]=$vLangArr[54];
			$mocr_lv0219->ArrPush[38]=$vLangArr[55];
			$mocr_lv0219->ArrPush[39]=$vLangArr[56];
			$mocr_lv0219->ArrPush[40]=$vLangArr[57];
			$mocr_lv0219->ArrPush[41]=$vLangArr[58];
			$mocr_lv0219->ArrPush[42]=$vLangArr[59];
			$mocr_lv0219->ArrPush[43]=$vLangArr[60];
			$mocr_lv0219->ArrPush[44]=$vLangArr[61];
			$mocr_lv0219->ArrPush[45]=$vLangArr[62];
			$mocr_lv0219->ArrPush[46]=$vLangArr[63];
			$mocr_lv0219->ArrPush[47]=$vLangArr[64];
			$mocr_lv0219->ArrPush[48]=$vLangArr[65];
			$mocr_lv0219->ArrPush[49]=$vLangArr[66];
			$mocr_lv0219->ArrPush[50]=$vLangArr[67];
			$mocr_lv0219->ArrPush[51]=$vLangArr[68];
			$mocr_lv0219->ArrPush[52]=$vLangArr[69];
			$mocr_lv0219->ArrPush[53]=$vLangArr[70];
			$mocr_lv0219->ArrPush[54]=$vLangArr[71];
			$mocr_lv0219->ArrPush[55]=$vLangArr[72];
			$mocr_lv0219->ArrPush[56]=$vLangArr[73];
			$mocr_lv0219->ArrPush[57]=$vLangArr[74];
			$mocr_lv0219->ArrPush[58]=$vLangArr[75];
			$mocr_lv0219->ArrPush[59]=$vLangArr[76];
			$mocr_lv0219->ArrPush[60]=$vLangArr[77];
			$mocr_lv0219->ArrPush[61]=$vLangArr[78];
			$mocr_lv0219->ArrPush[62]='Hình ảnh';
			$mocr_lv0219->ArrPush[63]=$vLangArr[80];
			$mocr_lv0219->ArrPush[64]=$vLangArr[81];

			$mocr_lv0219->ArrPush[65]=$vLangArr[82];
			$mocr_lv0219->ArrPush[66]=$vLangArr[83];
			$mocr_lv0219->ArrPush[69]=$vLangArr[91];
			$mocr_lv0219->ArrPush[71]='Giảm giá';
			$mocr_lv0219->ArrPush[131]='Tên sản phẩm';
			$mocr_lv0219->ArrPush[200]='Chức năng';
			$mocr_lv0219->ArrPush[100]='Mã cha';

			$mocr_lv0219->ArrPush[81]=$vLangArr[92];
			$mocr_lv0219->ArrPush[82]=$vLangArr[93];
			$mocr_lv0219->ArrPush[83]=$vLangArr[94];
			$mocr_lv0219->ArrPush[84]=$vLangArr[95];
			$mocr_lv0219->ArrPush[85]=$vLangArr[96];
			$mocr_lv0219->ArrPush[86]=$vLangArr[97];
			$mocr_lv0219->ArrPush[87]=$vLangArr[98];
			$mocr_lv0219->ArrPush[88]=$vLangArr[99];
			$mocr_lv0219->ArrPush[89]=$vLangArr[100];
			$mocr_lv0219->ArrPush[90]=$vLangArr[101];
			$mocr_lv0219->ArrPush[91]=$vLangArr[102];
			$mocr_lv0219->ArrPush[92]=$vLangArr[103];
			$mocr_lv0219->ArrPush[93]=$vLangArr[104];
			$mocr_lv0219->ArrPush[94]=$vLangArr[105];
			$mocr_lv0219->ArrPush[95]=$vLangArr[106];
			$mocr_lv0219->ArrPush[96]=$vLangArr[107];

			$mocr_lv0219->ArrPush[102]=$vLangArr[108];
			$mocr_lv0219->ArrPush[103]=$vLangArr[109];
			$mocr_lv0219->ArrPush[104]=$vLangArr[110];
			$mocr_lv0219->ArrPush[105]=$vLangArr[111];

			$mocr_lv0219->ArrPush[111]=$vLangArr[112];
			$mocr_lv0219->ArrPush[112]=$vLangArr[113];
			$mocr_lv0219->ArrPush[113]=$vLangArr[114];
			$mocr_lv0219->ArrPush[114]=$vLangArr[115];
			$mocr_lv0219->ArrPush[115]=$vLangArr[116];
			$mocr_lv0219->ArrPush[116]=$vLangArr[117];
			$mocr_lv0219->ArrPush[117]=$vLangArr[118];
			$mocr_lv0219->ArrPush[118]=$vLangArr[119];
			$mocr_lv0219->ArrPush[119]=$vLangArr[120];
			$mocr_lv0219->ArrPush[120]=$vLangArr[121];
			$mocr_lv0219->ArrPush[121]=$vLangArr[122];
			$mocr_lv0219->ArrPush[122]=$vLangArr[123];
			$mocr_lv0219->ArrPush[123]=$vLangArr[124];
			$mocr_lv0219->ArrPush[124]=$vLangArr[125];
			$mocr_lv0219->ArrPush[125]=$vLangArr[126];
			$mocr_lv0219->ArrPush[126]=$vLangArr[127];
			$mocr_lv0219->ArrPush[127]=$vLangArr[128];
			$mocr_lv0219->ArrPush[128]=$vLangArr[129];
			$mocr_lv0219->ArrPush[129]=$vLangArr[130];
			$mocr_lv0219->ArrPush[130]=$vLangArr[131];
			$mocr_lv0219->ArrPush[131]=$vLangArr[132];
			$mocr_lv0219->ArrPush[132]=$vLangArr[133];
			$mocr_lv0219->ArrPush[133]=$vLangArr[134];
			$mocr_lv0219->ArrPush[134]=$vLangArr[135];
			$mocr_lv0219->ArrPush[135]=$vLangArr[136];
			$mocr_lv0219->ArrPush[136]=$vLangArr[137];
			$mocr_lv0219->ArrPush[137]=$vLangArr[138];
			$mocr_lv0219->ArrPush[138]=$vLangArr[139];
			$mocr_lv0219->ArrPush[139]=$vLangArr[140];
			$mocr_lv0219->ArrPush[131]='Tên sản phẩm';
			$mocr_lv0219->ArrPush[140]='Code';
			$mocr_lv0219->ArrPush[141]='Hạn bảo hành';
			$mocr_lv0219->ArrPush[142]='Loại lỗi s\'p';
			$mocr_lv0219->ArrPush[143]='S\'lượng s\'p lỗi';
			$mocr_lv0219->ArrPush[144]='Thời gian trả s\'p lỗi';
			$mocr_lv0219->ArrPush[145]='Mã hàng NCC';
			$mocr_lv0219->ArrPush[170]='STT';
			$mocr_lv0219->ArrPush[300]='Mã NCC';
			$mocr_lv0219->ArrPush[163]='Đơn giá';
			$mocr_lv0219->ArrPush[164]='Thành tiền';
			$mocr_lv0219->ArrPush[205]='S\'lượng<br/>Our ref.';
			$mocr_lv0219->ArrPush[146]='Phí vận chuyển s\'p lỗi';
			$mocr_lv0219->ArrPush[147]='Đơn vị vận chuyển s\'p lỗi';
			$mocr_lv0219->ArrPush[148]='Số Bill Booking Vận chuyển';
			$mocr_lv0219->ArrPush[149]='SHIPPER';
			$mocr_lv0219->ArrPush[150]='Hạn giao hàng';
			$mocr_lv0219->ArrPush[151]='Ngày giao hàng dự kiến';
			$mocr_lv0219->ArrPush[152]='Phí vận chuyển';
			$mocr_lv0219->ArrPush[153]='Type (Our ref.)';
			$mocr_lv0219->ArrPush[154]='S\'lượng<br/>Sample';
			$mocr_lv0219->ArrPush[155]='Model Sup';
			$mocr_lv0219->ArrPush[156]='Thương hiệu<br/>NCC';
			$mocr_lv0219->ArrPush[157]='S\'lượng<br/> Extra';
			$mocr_lv0219->ArrPush[158]='Ngày phát hành';
			$mocr_lv0219->ArrPush[171]='Bản vẽ';
			$mocr_lv0219->ArrPush[172]='TEST IP (54/65/67/68)';
			$mocr_lv0219->ArrPush[173]='IES File & Test Integrating Sphere';
			$mocr_lv0219->ArrPush[174]='HDLĐ & Bảo trì bảo dưỡng';
			$mocr_lv0219->ArrPush[175]='CER. LM80 Chip';
			$mocr_lv0219->ArrPush[176]='Giấy HCHQ';
			$mocr_lv0219->ArrPush[177]='Hình ảnh hàng hóa/ Đóng gói';
			$mocr_lv0219->ArrPush[178]='Hình ảnh<br/>chip/driver/Phị kiện';
			$mocr_lv0219->ArrPush[179]='Ngày giao mẫu';
			$mocr_lv0219->ArrPush[180]='Đơn vị vận chuyển mẫu';
			$mocr_lv0219->ArrPush[181]='Ngày giao hàng';
			$mocr_lv0219->ArrPush[182]='Ngày giao hàng Đợt 2';
			$mocr_lv0219->ArrPush[183]='Sample Loading By';
			$mocr_lv0219->ArrPush[184]='Địa điểm lấy hàng';
			$mocr_lv0219->ArrPush[185]='Sample Loading type DDP';
			$mocr_lv0219->ArrPush[186]='Booking Bill Draf No.';
			$mocr_lv0219->ArrPush[187]='Country';
			$mocr_lv0219->ArrPush[188]='IV No';
			$mocr_lv0219->ArrPush[189]='CO No';
			$mocr_lv0219->ArrPush[190]='CO E/D No';
			$mocr_lv0219->ArrPush[191]='Giấy chứng nhận chất lượng (CQ)';
			$mocr_lv0219->ArrPush[192]='BL No.';
			$mocr_lv0219->ArrPush[193]='PL No.';
			$mocr_lv0219->ArrPush[194]='SUR/Orgin B/L No.';
			$mocr_lv0219->ArrPush[195]='Phiếu bảo hành';

			$mocr_lv0219->ArrPush[196]='Phiếu giao hàng';
			$mocr_lv0219->ArrPush[197]='Phiếu xuất kho';
			$mocr_lv0219->ArrPush[198]='Phiếu xuất xưởng';

			$mocr_lv0219->ArrPush[915]='Proj.';
			$mocr_lv0219->ArrPush[300]='SELLER';
			$mocr_lv0219->ArrPush[211]='Thuế(%)';
			$mocr_lv0219->ArrPush[210]='Thành tiền trước thuế';
			$strAllTr=$mocr_lv0219->LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue,$vLayVe);
			break;
		default:
			$strAllTr=LV_BuilPopup($lvList,$vArrCot,$lvResult,$objid,$objvalue);
			break;
	}
	//$vLayVe
	$vLayVe='';
	$strul= str_replace("@#99",$vLayVe,$strul);
	$strReturn=str_replace("'","\'",str_replace("@#01",$strAllTr,$strul));
	$strReturn=str_replace('"','\"',$strReturn);
	$strReturn=str_replace("
	","",$strReturn);

}
else
{
	while($row=db_fetch_array($lvResult)){
			$lvTemp=str_replace("@01",$row['lv001'],$strtr);
			$lvTemp=str_replace("@02",str_replace($objvalue,"<font color=\"#FF0000\">".$objvalue."</font>",$row['lv002']),$lvTemp);
			$strAllTr=$strAllTr.$lvTemp;
			}
	}
	$strReturn=str_replace("'","\'",str_replace("@#01",$strAllTr,$strul));
	$strReturn=str_replace('"','\"',$strReturn);
	$strReturn=str_replace("
	","",$strReturn);

?>
div1 = document.getElementById('lv_popup');
div1.innerHTML="<?php echo $strReturn;?>";
<?php
}
?>