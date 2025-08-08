<?php
session_start();
//require_once("../../clsall/hr_lv0238.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0238.php");
require_once("../../clsall/tc_lv0008.php");
require_once("../../clsall/tc_lv0010.php");
require_once("../../clsall/tc_lv0011.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/tc_lv0064.php");
require_once("../../clsall/hr_lv0002.php");
//////////////init object////////////////
$lvhr_lv0238=new hr_lv0238($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0238');
$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$motc_lv0064=new tc_lv0064($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0064');
$lvhr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0238');
$lvhr_lv0238->motc_lv0064=$motc_lv0064;
$lvhr_lv0020->LV_LoadID( $_GET['ID']);
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0124.txt",$plang);
$lvhr_lv0238->lang= $plang;
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0238->lv001=InsertWithCheckExt('hr_lv0038', 'lv001', '',1);
$lvhr_lv0238->lv002= $_GET['ID'] ?? '';
$lvhr_lv0238->lv003=$_POST['txtlv003'];
$lvhr_lv0238->lv004=$_POST['txtlv004'];
$lvhr_lv0238->lv005=$_POST['txtlv005'];
if($lvhr_lv0238->lv004=="" || $lvhr_lv0238->lv004==NULL) 
{
	$lvhr_lv0238->lv004=$lvhr_lv0020->lv030;
	if(getyear($lvhr_lv0020->lv030)>2000)
	{
	switch(getmonth($lvhr_lv0020->lv030))
	{
		case 11:
			$lvhr_lv0238->lv005=(getyear($lvhr_lv0020->lv030)+1)."-01-".getday($lvhr_lv0020->lv030);
			break;
		case 12:
			$lvhr_lv0238->lv005=(getyear($lvhr_lv0020->lv030)+1)."-02-".getday($lvhr_lv0020->lv030);
			break;
		default:
			$lvhr_lv0238->lv005=getyear($lvhr_lv0020->lv030)."-".Fillnum(getmonth($lvhr_lv0020->lv030)+2,2)."-".getday($lvhr_lv0020->lv030);
	}
	}
}	
$lvhr_lv0238->lv006=$_POST['txtlv006'];
$lvhr_lv0238->lv007=$_POST['txtlv007'];
$lvhr_lv0238->lv008=$_POST['txtlv008'];
$lvhr_lv0238->lv009=$_POST['txtlv009'];
if(!isset($_POST['txtlv010']))
{
	$lvhr_lv0238->lv010=$lvhr_lv0020->lv029;
}
else
	$lvhr_lv0238->lv010=$_POST['txtlv010'];
$lvhr_lv0238->lv011=$_POST['txtlv011'];
$lvhr_lv0238->lv012=$_POST['txtlv012'];
$lvhr_lv0238->lv013=$_POST['txtlv013'];
$lvhr_lv0238->lv014=$_POST['txtlv014'];
$lvhr_lv0238->lv015=$_POST['txtlv015'];
$lvhr_lv0238->lv016=$_POST['txtlv016'];
$lvhr_lv0238->lv017=$_POST['txtlv017'];
$lvhr_lv0238->lv018=$_POST['txtlv018'];
$lvhr_lv0238->lv019=$_POST['txtlv019'];
$lvhr_lv0238->lv020=$_POST['txtlv020'];
$lvhr_lv0238->lv021=$_POST['txtlv021'];
$lvhr_lv0238->lv022=$_POST['txtlv022'];
$lvhr_lv0238->lv023=$_POST['txtlv023'];
$lvhr_lv0238->lv024=$_POST['txtlv024'];
$lvhr_lv0238->lv025=$_POST['txtlv025'];
$lvhr_lv0238->lv026=$_POST['txtlv026'];
$lvhr_lv0238->lv027=$_POST['txtlv027'];
$lvhr_lv0238->lv028=$_POST['txtlv028'];
$lvhr_lv0238->lv029=$_POST['txtlv029'];
$lvhr_lv0238->lv030=$_POST['txtlv030'];
$lvhr_lv0238->lv031=$_POST['txtlv031'];
$lvhr_lv0238->lv032=$_POST['txtlv032'];
$lvhr_lv0238->lv033=$_POST['txtlv033'];
$lvhr_lv0238->lv034=$_POST['txtlv034'];
$lvhr_lv0238->lv035=$_POST['txtlv035'];
$lvhr_lv0238->lv036=$_POST['txtlv036'];
$lvhr_lv0238->lv037=$_POST['txtlv037'];

$lvhr_lv0238->lv099=$_POST['txtlv099'];
$lvhr_lv0238->lv098=$_POST['txtlv098'];
$lvhr_lv0238->lv299=$_POST['txtlv299'];
if(!isset($_POST['txtlv027']))
{
	$lvhr_lv0238->lv027=$lvhr_lv0020->lv005;
	$lvhr_lv0238->lv028=$lvhr_lv0020->lv060;
	$lvhr_lv0238->lv029=$lvhr_lv0020->lv061;
	$lvhr_lv0238->lv030=$lvhr_lv0020->lv067;

}
if($vFlag==1)
{
		
		$vresult=$lvhr_lv0238->LV_Insert_NoID();
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
			if($lvhr_lv0238->lv003!=9)
			{
				$lvtc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
				$lvtc_lv0011=new tc_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0011');
				$lvtc_lv0008->lang=$plang;
				$lvtc_lv0008->LV_InsertEmpContract($lvhr_lv0238->lv002,$lvhr_lv0238->lv010,$lvhr_lv0238->lv007,$_POST['txtlv004'],$_POST['txtlv005']);
				$lvtc_lv0010=new tc_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0238');
				//$lvtc_lv0010->lv001=InsertWithCheckExt('tc_lv0010', 'lv001', '',1);
				$lvhr_lv0002->LV_LoadID($lvhr_lv0238->lv010);
				$vShift1=$lvhr_lv0002->lv005;
				$vArrShift=explode(",",$vShift1);
				$vShift=$vArrShift[0];
				$lvtc_lv0010->lv002= $_GET['ID'] ?? '';
				$lvtc_lv0010->lv003="PRJ000001";
				$lvtc_lv0010->lv004=$_POST['txtlv004'];
				$lvtc_lv0010->lv005=$_POST['txtlv005'];
				$lvtc_lv0010->lv006=1;
				$lvtc_lv0010->lv008=$_SESSION['ERPSOFV2RUserID'];
				$lvtc_lv0010->lv009=GetServerDate();
				$lvtc_lv0010->lv010=$lvhr_lv0238->lv001;
				$lvResult=$lvtc_lv0010->LV_InsertNoID();
				
				if($lvResult)
				{
					$vTimesheetID=$lvtc_lv0010->lv001;
					$vDateLimited=$lvtc_lv0011->LV_GetHoliday($vStartDate,$vEndDate);
					if($vDateLimited=="''")
					{
						$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,IF(DayOfWeek(lv004)=1,'','$vShift'),'$lvhr_lv0238->lv001' from tc_lv0011_ where lv004>='$lvtc_lv0010->lv004' and lv004<='$lvtc_lv0010->lv005'";
						db_query($psql);
					}
					else
					{
						$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,IF(DayOfWeek(lv004)=1,'','$vShift'),'$lvhr_lv0238->lv001' from tc_lv0011_ where lv004>='$lvtc_lv0010->lv004' and lv004<='$lvtc_lv0010->lv005' and (lv004 not in ($vDateLimited))";
						db_query($psql);
						$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,IF(DayOfWeek(lv004)=1,'','$vShift'),'$lvhr_lv0238->lv001' from tc_lv0011_ where lv004>='$lvtc_lv0010->lv004' and lv004<='$lvtc_lv0010->lv005' and (A.lv004 in ($vDateLimited))";
						db_query($psql);
					}
					
					
				}
				$lvtc_lv0010->LV_UpdateBalanceCalanda($lvtc_lv0010->lv002,$lvtc_lv0010->lv001,$lvtc_lv0010->lv004,$lvtc_lv0010->lv005,$lvhr_lv0238->lv001,$lvhr_lv0238->lv099);
			}
			$lvhr_lv0238->LV_ShowLichFullStaff($lvhr_lv0238->lv002);
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
else if($vFlag==2)
{
		$data=null;
		$data = array();
  
  function add_person(  $lv001, $lv002,$lv003,$lv004,$lv005,$lv007,$lv010,$lv011,$lv012,$lv013,$lv014,$lv015,$lv016,$lv017,$lv018,$lv019,$lv020,$lv021,$lv022,$lv023,$lv024,$lv025,$lv026,$lv027,$lv028,$lv029,$lv030,$lv031,$lv032,$lv033,$lv034,$lv035,$lv036,$lv037,$lv888,$lv098,$lv009)
  {
  global $data;  
  $data []= array(
  'lv001' => $lv001,
  'lv002' => $lv002, 
  'lv003' => $lv003,   
  'lv004' => $lv004,
  'lv005' => $lv005,
  'lv007' => $lv007,
  'lv009' => $lv009,
  'lv010' => $lv010,
  'lv011' => $lv011,
  'lv012' => $lv012,
  'lv013' => $lv013,
  'lv014' => $lv014,
  'lv015' => $lv015,
  'lv016' => $lv016,
  'lv017' => $lv017,
  'lv018' => $lv018,
  'lv019' => $lv019,
  'lv020' => $lv020,
  'lv021' => $lv021,
  'lv022' => $lv022,
  'lv023' => $lv023,
  'lv024' => $lv024,
  'lv025' => $lv025,
  'lv026' => $lv026,
  'lv027' => $lv027,
  'lv028' => $lv028,
  'lv029' => $lv029,
  'lv030' => $lv030,
  'lv031' => $lv031,
  'lv032' => $lv032,
  'lv033' => $lv033,
  'lv034' => $lv034,
  'lv035' => $lv035,
  'lv036' => $lv036,
  'lv037' => $lv037,
  'lv098' => $lv098,
  'lv888' => $lv888
  );
  }

	 $lvNow=GetServerDate()." ".GetServerTime();
	 if ( $_FILES['file']['tmp_name'] )
  	{
	  $dom=new DOMDocument();
	  	$dom->load( $_FILES['file']['tmp_name'] );
	  $rows = $dom->getElementsByTagName( 'Row' );
	  $first_row = true;
	  foreach ($rows as $row)
	  {
		  if ( !$first_row )
		  {
			  $first = "";
			  $middle = "";
			  $last = "";
			  $email = "";
			  $lv001='';
			  $index = 1;
			  $cells = $row->getElementsByTagName( 'Cell' );
			  foreach( $cells as $cell )
			  { 
			  $ind = $cell->getAttribute( 'Index' );
			  if ( $ind != null ) $index = $ind;
  			  if ( $index == 1 ) $lv001 = $cell->nodeValue;
			  if ( $index == 2 ) $lv002 = $cell->nodeValue;
			  if ( $index == 3 ) $lv003 = $cell->nodeValue;
			  if ( $index == 4 ) $lv004 = $cell->nodeValue;
			  if ( $index == 5 ) $lv005 = $cell->nodeValue;
			  if ( $index == 6 ) $lv012 = $cell->nodeValue;
			  if ( $index == 7 ) $lv007 = $cell->nodeValue;
			  if ( $index == 8 ) $lv021 = $cell->nodeValue;
			  if ( $index == 9 ) $lv022 = $cell->nodeValue;
			  if ( $index == 10 ) $lv013 = $cell->nodeValue;
			  if ( $index == 11 ) $lv014 = $cell->nodeValue;
			  if ( $index == 12 ) $lv026 = $cell->nodeValue;
			  if ( $index == 13 ) $lv016 = $cell->nodeValue;
			  if ( $index == 14 ) $lv018 = $cell->nodeValue;
			  if ( $index == 15 ) $lv020 = $cell->nodeValue;
			  if ( $index == 16 ) $lv025 = $cell->nodeValue;
			  if ( $index == 17 ) $lv023 = $cell->nodeValue;
			  if ( $index == 18 ) $lv031 = $cell->nodeValue;
			  if ( $index == 19 ) $lv032 = $cell->nodeValue;
			  if ( $index == 20 ) $lv033 = $cell->nodeValue;
			  if ( $index == 21 ) $lv034 = $cell->nodeValue;
			  if ( $index == 22 ) $lv035 = $cell->nodeValue;
			  if ( $index == 23 ) $lv036 = $cell->nodeValue;
			  if ( $index == 24 ) $lv037 = $cell->nodeValue;

			  if ( $index == 25 ) $lv011 = $cell->nodeValue;
			  if ( $index == 26 ) $lv019 = $cell->nodeValue;
			  if ( $index == 27 ) $lv017 = $cell->nodeValue;
			  if ( $index == 28 ) $lv015 = $cell->nodeValue;
			  if ( $index == 29 ) $lv010 = $cell->nodeValue;
			  if ( $index == 30 ) $lv024 = $cell->nodeValue;
			  if ( $index == 31 ) $lv009 = $cell->nodeValue;
			  if ( $index == 32 ) $lv027 = $cell->nodeValue;
			  if ( $index == 33 ) $lv028 = $cell->nodeValue;
			  if ( $index == 34 ) $lv029 = $cell->nodeValue;
			  if ( $index == 35 ) $lv030 = $cell->nodeValue;
			  if ( $index == 36 ) $lv888 = $cell->nodeValue;
			  //if ( $index == 33 ) $lv034 = $cell->nodeValue;
			  if ( $index == 37 ) $lv098 = $cell->nodeValue;
			  $index += 1;
			}
			if(trim($lv001)!="" &&  $lv001!=NULL) add_person( $lv001, $lv002,$lv003,$lv004,$lv005,$lv007,$lv010,$lv011,$lv012,$lv013,$lv014,$lv015,$lv016,$lv017,$lv018,$lv019,$lv020,$lv021,$lv022,$lv023,$lv024,$lv025,$lv026,$lv027,$lv028,$lv029,$lv030,$lv031,$lv032,$lv033,$lv034,$lv035,$lv036,$lv037,$lv888,$lv098,$lv009);
	  }
	  $first_row = false;
	  }
  	}
	$lvtc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
	$lvtc_lv0011=new tc_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0011');
	$vDateLimited="''";//$lvtc_lv0011->LV_GetHoliday('2015-01-01','2050-01-01');
	$vStrNoSave="";
	$vKD=1;
	foreach( $data as $row )
	{
		$lv004=$row['lv004'];
		$lv005=$row['lv005'];
		$lv888=$row['lv888'];
		if(trim($row['lv001'])!="" && $row['lv001']!=NULL)
		{
			$lvhr_lv0020->LV_LoadID(trim($row['lv001']));
			if($lvhr_lv0020->lv001!=NULL)
			{
				$lvhr_lv0238->LV_LoadActiveSpecial($row['lv001']);
				$lvhr_lv0238->lv002=$lvhr_lv0020->lv001;
				$lvhr_lv0238->lv003=$row['lv003'];
				if($lv004=="" && $lv005=="")
				{
					$lvhr_lv0238->lv004=$lvhr_lv0238->FormatView(ADDDATE($lvhr_lv0238->lv004,1),2);
					$lvhr_lv0238->lv005=$lvhr_lv0238->FormatView(ADDDATE($lvhr_lv0238->lv004,365),2);
				}
				elseif($lv004=="")
				{
					$lvhr_lv0238->lv004=$lvhr_lv0238->FormatView(ADDDATE($lvhr_lv0238->lv004,1),2);
					$lvhr_lv0238->lv005=$lv005;
				}
				else
				{
					$lvhr_lv0238->lv004=$lv004;
					$lvhr_lv0238->lv005=$lv005;
				}
				$vStartDate=$lvhr_lv0238->lv004;
				$vEndDate=$lvhr_lv0238->lv005;
				$lvhr_lv0238->lv008=$row['lv008'];
				$lvhr_lv0238->lv009=$row['lv009'];				
				if(trim($row['lv010'])!='') 
				{
					$lvhr_lv0238->lv010=$row['lv010'];
				}
				else
					$lvhr_lv0238->lv010=$lvhr_lv0020->lv029;
				$lvhr_lv0238->lv011=$row['lv011'];
				$lvhr_lv0238->lv012=$row['lv012'];
				$lvhr_lv0238->lv013=$row['lv013'];
				$lvhr_lv0238->lv014=$row['lv014'];
				$lvhr_lv0238->lv015=$row['lv015'];
				$lvhr_lv0238->lv016=$row['lv016'];
				$lvhr_lv0238->lv017=$row['lv017'];
				$lvhr_lv0238->lv018=$row['lv018'];
				$lvhr_lv0238->lv020=$row['lv020'];
				$lvhr_lv0238->lv021=$row['lv021'];
				$lvhr_lv0238->lv022=$row['lv022'];
				$lvhr_lv0238->lv023=$row['lv023'];
				$lvhr_lv0238->lv024=$row['lv024'];
				$lvhr_lv0238->lv025=$row['lv025'];
				$lvhr_lv0238->lv026=$row['lv026'];
				if(trim($row['lv027'])!="" && $row['lv027']!=NULL)
					$lvhr_lv0238->lv027=$row['lv027'];
				else
					$lvhr_lv0238->lv027=$lvhr_lv0020->lv005;
				if(trim($row['lv028'])!="" && $row['lv028']!=NULL)
					$lvhr_lv0238->lv028=$row['lv028'];
				else
					$lvhr_lv0238->lv028=$lvhr_lv0020->lv060;
				if(trim($row['lv029'])!="" && $row['lv029']!=NULL)
					$lvhr_lv0238->lv029=$row['lv029'];
				else
					$lvhr_lv0238->lv029=$lvhr_lv0020->lv061;
				if(trim($row['lv030'])!="" && $row['lv030']!=NULL)
					$lvhr_lv0238->lv030=$row['lv030'];
				else
					$lvhr_lv0238->lv030=$lvhr_lv0020->lv067;
				$lvhr_lv0238->lv031=$row['lv031'];
				$lvhr_lv0238->lv032=$row['lv032'];
				$lvhr_lv0238->lv033=$row['lv033'];
				$lvhr_lv0238->lv034=$row['lv034'];
				$lvhr_lv0238->lv035=$row['lv035'];
				$lvhr_lv0238->lv036=$row['lv036'];
				$lvhr_lv0238->lv037=$row['lv037'];
				$lvhr_lv0238->lv098=$row['lv098'];
				if(trim($lvhr_lv0238->lv098)=='' || $lvhr_lv0238->lv098==NULL) $lvhr_lv0238->lv098=$lvhr_lv0238->lv004;
				if($lvhr_lv0238->lv001!=NULL)
				{
					$vOldContractID=$lvhr_lv0238->lv001;
					if($row['lv009']==1) $lvhr_lv0238->LV_Aproval("'".$lvhr_lv0238->lv001."'");
				}
				$vresult=$lvhr_lv0238->LV_Insert_NoID();
				if($vresult && $lv888==1)
				{
					$lvhr_lv0238->lv001=sof_insert_id();
					$lvhr_lv0002->LV_LoadID($lvhr_lv0238->lv010);
					$vShift1=$lvhr_lv0002->lv005;
					$vArrShift=explode(",",$vShift1);
					$vShift=$vArrShift[0];
					$lvtc_lv0008->lang=$plang;
					//$lvtc_lv0008->LV_InsertEmpContract($lvhr_lv0238->lv002,$lvhr_lv0238->lv010,$lvhr_lv0238->lv007,$lvhr_lv0238->lv004,$lvhr_lv0238->lv005);
					$lvtc_lv0010=new tc_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0238');
					//$lvtc_lv0010->lv001=InsertWithCheckExt('tc_lv0010', 'lv001', '',1);
					$lvtc_lv0010->lv002=$row['lv001'];
					$lvtc_lv0010->lv003="PRJ000001";
					$lvtc_lv0010->lv004=$vStartDate;
					$lvtc_lv0010->lv005=$vEndDate;
					$lvtc_lv0010->lv006=1;
					$lvtc_lv0010->lv008=$_SESSION['ERPSOFV2RUserID'];
					$lvtc_lv0010->lv009=GetServerDate();
					$lvtc_lv0010->lv010=$lvhr_lv0238->lv001;
					$lvResult=$lvtc_lv0010->LV_InsertNoID();
					if($lvResult)
					{
						$vTimesheetID=$lvtc_lv0010->lv001;
						//$vDateLimited=$lvtc_lv0011->LV_GetHoliday($vStartDate,$vEndDate);
						if($vDateLimited=="''")
						{
							$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv015,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,IF(DayOfWeek(lv004)=1,'','$vShift'),'$lvhr_lv0238->lv001' from tc_lv0011_ where lv004>='$lvtc_lv0010->lv004' and lv004<='$lvtc_lv0010->lv005'";
							db_query($psql);
						}
						else
						{
							$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv015,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,IF(DayOfWeek(lv004)=1,'','$vShift'),'$lvhr_lv0238->lv001' from tc_lv0011_ where lv004>='$lvtc_lv0010->lv004' and lv004<='$lvtc_lv0010->lv005' and (lv004 not in ($vDateLimited))";
							db_query($psql);
							$psql="insert into tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv015,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,IF(DayOfWeek(lv004)=1,'','$vShift'),'$lvhr_lv0238->lv001 from tc_lv0011_ where lv004>='$lvtc_lv0010->lv004' and lv004<='$lvtc_lv0010->lv005' and (A.lv004 in ($vDateLimited))";
							db_query($psql);
						}
						
					}
					$lvtc_lv0010->LV_UpdateBalanceCalanda($lvtc_lv0010->lv002,$lvtc_lv0010->lv001,$lvtc_lv0010->lv004,$lvtc_lv0010->lv005,$lvhr_lv0238->lv001,$vOldContractID);
				}
				$lvhr_lv0238->LV_ShowLichFullStaff($lvhr_lv0238->lv002);
			}
			else
			{
				$vStrNoSave=$vStrNoSave.$vKD.". ".$row['lv001']."-> Không thêm được vào phần mềm <br/>";
				$vKD++;
			}
		}
	}
		echo $vStrNoSave;
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			if($vStrNoSave=="")
				$vFlag = 1;
			else
				$vFlag = 0;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/public.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<!-- TinyMCE -->
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "txtlv008",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	
</script>
</head>
<script language="javascript">
<!--
function isnumber(s){
	if(s!=""){
		var str="0123456789"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert("<?php echo $vLangArr[21];?>");	
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv003.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,24,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		var StartDate=o.txtlv004.value;
		var EndDate=o.txtlv005.value;
		var SYear=(StartDate.substring(6,10));
		var EYear=(EndDate.substring(6,10));
		var SMonth=parseInt(StartDate.substring(3,5));
		var EMonth=parseInt(EndDate.substring(3,5));
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[24];?>");
			o.txtlv002.select();
		}
		else if(o.txtlv003.value==""){
			alert("<?php echo $vLangArr[25];?>");
			o.txtlv003.focus();
			}
		else if(o.txtlv004.value==""){
			alert("<?php echo $vLangArr[26];?>");
			o.txtlv004.select();
			}	
		else if(o.txtlv005.value==""){
			alert("<?php echo $vLangArr[26];?>");
			o.txtlv005.select();
			}
		else if((SYear>EYear) || (SYear==EYear && EMonth<SMonth ))
			{			
				alert("<?php echo 'Ngày bắt đầu hợp đồng không được lớn hơn ngày kết thúc';?>");
				o.txtlv004.select();
			}		
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	function LoadSource(value)
	{
		if(value!="")
		{
			var o=document.frmadd;
			ajax_do ('../hr_lv0238/hr_lv0238excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&HDID='+value+'&Type='+o.txtlv003.value,1);
		}

		
	}
		function SaveMul()
	{
		var o=document.frmadd;
		
				o.txtFlag.value=2;
				o.submit();

	}
	function text_replace(str)
	{
		str=localreplaces("'","|01",str);
		str=localreplaces("&","|02",str);
		return str;
	}
   function LoadHD(othis)
   {
		var o=document.frmadd;
		var strCotLuong='&cot21='+parseFloat('0'+o.txtlv021.value);
		var strTextRun='<?php echo $plang;?>'+'&StartDate='+o.txtlv004.value+'&StartDateTV='+o.txtlv098.value+'&EndDate='+o.txtlv005.value+'&TimeWork='+o.txtlv007.value+'&ContractLaborID='+o.txtlv006.value+'&TitleVN='+text_replace(o.txtlv027.value)+'&TitleEN='+text_replace(o.txtlv028.value)+'&HDPrevious='+o.txtlv099.value+'&LawTitleVN='+text_replace(o.txtlv029.value)+'&LawTitleEN='+text_replace(o.txtlv030.value)+strCotLuong;
		LoadText(othis,'txtlv008','hr_lv0043','lv003',o.txtlv002.value,2,strTextRun)
   }
   
-->
</script>
<?php
if($lvhr_lv0238->GetAdd()>0)
{
$loadenter	=$_POST['load-enter'];
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmadd" method="post"  enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag"  />
						<table width="100%" border="0" align="center" id="table">
							<tr>
							  <td colspan="2" height="100%" align="center"><p>
							    <label>
							      <input type="radio" name="load-enter" value="0" id="load-enter_0" <?php echo ($loadenter==0)?'checked':'';?> onClick="changestate(1)">
							      Nhập từng hợp đồng
							    </label>
							    
							    <label>
							      <input type="radio" name="load-enter" value="1" id="load-enter_1" <?php echo ($loadenter==1)?'checked':'';?> onClick="changestate(2)">
							     Nạp hợp đồng điều chỉnh lương từ tập tin
							    </label>
							    <br>
						      </p></td>
						  </tr>
                         </table>
<!---Load File-->                         
                         <div id="fileload" style="display:none">
                         <table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo 'Chọn tập tin import';?></td>
								<td width="*%"  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="dieu_chinh_luong_rong_baohiem.zip" title="<?php echo $vLangArr[33];?>"><?php echo 'Download mẫu';?></a></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
                                        <TBODY>
                                        <TR vAlign=center align=middle>
                                              <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:SaveMul();" tabindex="16"><img src="../images/controlright/save_f2.png" 
                                            alt="Save" title="<?php echo $vLangArr[1];?>" 
                                            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
                                          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
                                            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
                                            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
                                          <TD nowrap="nowrap"><a class=lvtoolbar 
                                            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
                                            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
                                            name=remove> <?php echo $vLangArr[6];?></a></TD>
                                            </TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
                      </div>
<!---End Load File-->
<!---Enter New Line-->                      
                      <div id="enterline" style="display:block">
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0238->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
				  				<td  height="20px"><select  name="txtlv003"  id="txtlv003"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/><?php echo $lvhr_lv0238->LV_LinkField('lv003',$lvhr_lv0238->lv003);?>
				 									</select>							 
				 				</td>
							  </tr>	
							
							  <tr>
							  <td  height="20px"><?php echo 'Chọn hợp đồng trước lấy dữ liệu';?></td>
				  				<td  height="20px">
									<select  name="txtlv099"  id="txtlv099"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" onblur="LoadSource(this.value)"/>
										<option value=""></option><?php echo $lvhr_lv0238->LV_LinkField('lv099',$lvhr_lv0238->lv099);?>
				  					</select>							 
				  				</td>
								
							  </tr>	
							
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv004);return false;" name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0238->FormatView($lvhr_lv0238->lv004,2);?>" tabindex="9" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv004);return false;" /></span></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo 'Ngày in hợp đồng thời vụ';?></td>
							  <td  height="20px"><input onfocus="if(this.value==''){this.value=document.frmadd.txtlv004.value;}" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv098);return false;" name="txtlv098" type="text" id="txtlv098" value="<?php echo $lvhr_lv0238->FormatView($lvhr_lv0238->lv098,2);?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv098);return false;" /></span></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv005);return false;" name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvhr_lv0238->FormatView($lvhr_lv0238->lv005,2);?>" tabindex="10" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv005);return false;" /></span></td>
							  </tr>
								<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvhr_lv0238->lv006;?>" tabindex="11" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>																			
							<tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvhr_lv0238->lv007;?>" tabindex="12" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							  <tr>
							 	 <td  height="20px"><?php echo $vLangArr[27];?></td>
				  				 <td  height="20px"><table style="width:80%"><tr><td style="width:50%"><select  name="txtlv010"  id="txtlv010"  tabindex="12" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)"> <?php echo $lvhr_lv0238->LV_LinkField('lv010',$lvhr_lv0238->lv010);?>
				  									</select>	
													</td>
							  <td>
								<ul id="pop-nav" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
									<input type="text" autocomplete="off" class="search_img_btn" name="txtlv010_search" id="txtlv010_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv010','hr_lv0002','concat(lv003,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv023','txtlv010','concat(lv003,@! @!,lv001)')" tabindex="200" >
									<div id="lv_popup" lang="lv_popup6"> </div>						  
									</li>
								</ul></td></tr></table></td>
				 				 </td>
							  </tr>		
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
				  				<td  height="20px"><select  name="txtlv009"  id="txtlv009"  tabindex="12" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadHD(this)"><?php echo $lvhr_lv0238->LV_LinkField('lv020',$lvhr_lv0238->lv009);?>
				  									</select>							 
				  				</td>
							  </tr>	
							  	<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><textarea name="txtlv008" rows="20" id="txtlv008" style="width:80%" tabindex="13"><?php echo $lvhr_lv0238->lv008;?></textarea></td>
							</tr>						
							   <tr>
							  <td  height="20px"><?php echo $vLangArr[32];?></td>
				  				<td  height="20px"><select  name="txtlv015"  id="txtlv015"  tabindex="12" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" />
													<option value="0" <?php echo ($lvhr_lv0238->lv015=="0")?'selected="selected"':''?>>No</option>
													<option value="1" <?php echo ($lvhr_lv0238->lv015=="1")?'selected="selected"':''?>>Yes</option>
				  									</select>							 
				  				</td>
							  </tr>	
							
							   
							  
							    <tr>
							  <td  height="20px"><?php echo $vLangArr[36];?></td>
							  <td  height="20px"><select  name="txtlv019"  id="txtlv019"  tabindex="12" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" />
													<option value="0" <?php echo ($lvhr_lv0238->lv019=="0")?'selected="selected"':''?>>Gross Salary</option>
													<option value="1" <?php echo ($lvhr_lv0238->lv019=="1")?'selected="selected"':''?>>Net Salary</option>
				  									</select>	</td>
							  </tr>	
							  											
							
							 <tr>
							  <td  height="20px"><?php echo $vLangArr[28];?></td>
				  				<td  height="20px"><select  name="txtlv011"  id="txtlv011"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0238->LV_LinkField('lv011',$lvhr_lv0238->lv011);?>
				  									</select>							 
				  				</td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[29];?></td>
				  				<td  height="20px"><select  name="txtlv012"  id="txtlv012"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0238->LV_LinkField('lv012',$lvhr_lv0238->lv012);?>
				  									</select>							 
				  				</td>
							  </tr>	
							   <tr>							  						    
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[38];?></td>
				  				<td  height="20px"><input name="txtlv021" type="text" id="txtlv021" value="<?php echo $lvhr_lv0238->lv021;?>" tabindex="20" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[41];?></td>
				  				<td  height="20px"><select  name="txtlv024"  id="txtlv024"  tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /><option value=""></option><?php echo $lvhr_lv0238->LV_LinkField('lv024',$lvhr_lv0238->lv024);?>
				  									</select>							 
				  				</td>
							  </tr>	
							  <tr>
							   <td  height="20px"><?php echo $vLangArr[44];?></td>
				  				<td  height="20px"><input name="txtlv027" type="text" id="txtlv027" value="<?php echo $lvhr_lv0238->lv027;?>" tabindex="21" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							  <tr>
							   <td  height="20px"><?php echo $vLangArr[45];?></td>
				  				<td  height="20px"><input name="txtlv028" type="text" id="txtlv028" value="<?php echo $lvhr_lv0238->lv028;?>" tabindex="21" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							  <tr>
							   <td  height="20px"><?php echo $vLangArr[46];?></td>
				  				<td  height="20px"><input name="txtlv029" type="text" id="txtlv029" value="<?php echo $lvhr_lv0238->lv029;?>" tabindex="21" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							  <tr>
							   <td  height="20px"><?php echo $vLangArr[47];?></td>
				  				<td  height="20px"><input name="txtlv030" type="text" id="txtlv030" value="<?php echo $lvhr_lv0238->lv030;?>" tabindex="21" style="width:80%" onKeyPress="return CheckKey(event,7)">							 
				  				</td>
							  </tr>
							  <tr>
								<td  height="20"><?php echo 'KPI';?></td>
							    <td  height="20">
									<table style="width:80%"><tr><td style="width:50%">
										<select name="txtlv299"  id="txtlv299" value="<?php echo $lvhr_lv0020->lv299;?>" tabindex="11"  style="width:100%" onKeyPress="return CheckKey(event,7)">
									 	<?php echo $lvhr_lv0238->LV_LinkField('lv299',$lvhr_lv0238->lv299);?>
									 	</select>
								 	</td>
								  <td>
									<ul id="pop-nav99" lang="pop-nav99" onMouseOver="ChangeName(this,99)" onkeyup="ChangeName(this,99)"> <li class="menupopT">
										<input type="text" autocomplete="off" class="search_img_btn" name="txtlv299_search" id="txtlv299_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv299','ki_lv0003','lv002')" onFocus="LoadPopup(this,'txtlv299','ki_lv0003','lv002')" tabindex="200" >
										<div id="lv_popup99" lang="lv_popup99"> </div>						  
										</li>
									</ul></td></tr></table>
							    </td>
								
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
                       </div>
<!---End Enter New Line-->                         


			
  </div>
</div>
<script language="javascript" src="../../javascripts/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
function localreplaces(lookfor,replacewith,sentence)
{
	var s;
	s="";
	var len1,len2,len3,dem;
	len1=lookfor.length;
	len3=replacewith.length;
	len2=sentence.length;
	dem=0;
	if(len1>len2)
	   return sentence;
	else
			{for(var i=0;i<len2;i++)
			  {if(i<=len2-len1)
				   {for(var j=0;j<len1;j++)
				    if(lookfor.charAt(j)==sentence.charAt(i+j))
					  {				  dem++;
					  }
					 if(dem==len1)
					 {for(var p=0;p<len3;p++)
						s=s+replacewith.charAt(p);
						i=i+len1-1;
						dem=0;
					 }
					 else
					 {dem=0;
					  s=s+sentence.charAt(i);
					 }
				  }
				else
				 {s=s+sentence.charAt(i);
				 }
			}
			
			}return s;
}
function changestate(value)
	{
		var o1=document.getElementById('fileload');
		var o2=document.getElementById('enterline');
		if(value==2)
		{
			o1.style.display="block";
			o2.style.display="none";
			
		}
		else
		{
			o1.style.display="none";
			o2.style.display="block";
		}
	}
	changestate(<?php echo (int)$loadenter+1;?>)
	var o=document.frmadd;
		o.txtlv003.focus();
</script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		Cancel();
	//-->
	</script>
	<?php
	}
	?>
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>