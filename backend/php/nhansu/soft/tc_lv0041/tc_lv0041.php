<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/tc_lv0041.php");
require_once("$vDir../clsall/tc_lv0009.php");
require_once("$vDir../clsall/tc_lv0008.php");
require_once("$vDir../clsall/tc_lv0013.php");
require_once("$vDir../clsall/tc_lv0011.php");
require_once("$vDir../clsall/hr_lv0020.php");
require_once("$vDir../clsall/tc_lv0002.php");
require_once("$vDir../clsall/tc_lv0012.php");
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
/////////////init object//////////////
$motc_lv0041=new tc_lv0041($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0041');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$motc_lv0041->Dir=$vDir;
$motc_lv0009=new tc_lv0009('admin','admin','Tc0009');
$motc_lv0008=new tc_lv0008('admin','admin','Tc0008');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$motc_lv0002=new tc_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0002');
$motc_lv0012=new tc_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0012');
$motc_lv0041->is_tc09_add=$motc_lv0041->GetAdd();
$motc_lv0041->is_tc09_apr=$motc_lv0041->GetApr();
$motc_lv0041->is_tc09_unapr=$motc_lv0041->GetUnApr();
$month=getmonth($_POST['txtMonthYear']);
$year=getyear($_POST['txtMonthYear']);
if($month=='' || $month==NULL)
{
	$motc_lv0013->LV_GetCal();
	if($motc_lv0013->lv999!='' && $motc_lv0013->lv999!=NULL) 
		$motc_lv0013->LV_LoadID($motc_lv0013->lv999);
	else
		$motc_lv0013->LV_LoadActiveID();
	if($motc_lv0013->lv001==NULL)
	{
		$motc_lv0013->LV_LoadActiveIDMonth(getmonth($motc_lv0013->DateCurrent),getyear($motc_lv0013->DateCurrent));
	}
	$vNow=$motc_lv0013->lv004;
	$month=Fillnum($motc_lv0013->lv006,2);
	$year=Fillnum($motc_lv0013->lv007,4);
}
else
{
	$motc_lv0013->LV_LoadActiveIDMonth($month,$year);
}
if($motc_lv0041->GetAdd()==1)
{
	if(isset($_GET['ajax222']))
	{
		echo '[CHECK]';
			$motc_lv0012->lvNVID=$_GET['vEmployeeID'];
			if($_GET['vopt']==3)
			{
				$motc_lv0012->LV_InsertAuto($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vTime'],0,getInfor($_SESSION['ERPSOFV2RUserID'],2));
			}
			else if($_GET['vopt']==2)
				$motc_lv0012->LV_UpdateStateOverTime($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vTime'],$_GET['vopt'],getInfor($_SESSION['ERPSOFV2RUserID'],2));
			else
				$motc_lv0012->LV_UpdateState($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vTime'],$_GET['vopt'],getInfor($_SESSION['ERPSOFV2RUserID'],2));
			echo $motc_lv0041->GetTimeListOutOff($_GET['vEmployeeID'],$_GET['vDate'],$_GET['vid'],1,1);
		echo '[ENDCHECK]';
		echo '[CHECKID]';
		echo $_GET['vid'];
		echo '[ENDCHECKID]';
		exit;
	}
	if(isset($_GET['ajaxpro']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$codeid=str_replace("nghiphepnam","&",$codeid);
			$motc_lv0041->lvNVID=$_GET['NVID'];
			if($codeid=='A' || $codeid=='HA') 
			{
				$vReturn=$motc_lv0008->LV_CheckOne_FNCB($_GET['NVID'],$year,0);
				if($vReturn>0)
				{
					$motc_lv0041->LV_UpdateCode($timeid,$codeid);
				}
				echo '[CONGP]';
					echo $vReturn;
				echo '[ENDCONGP]';
				echo '[CONGPDEF]';
					echo $codeid;
				echo '[ENDCONGPDEF]';
				echo '[CONGPDIS]';
					echo $timeid;
				echo '[ENDCONGPDIS]';
			}
			elseif($codeid=='B')
			{
				$vReturn=$motc_lv0008->LV_CheckOne_FNCB($_GET['NVID'],$year,1);
				if($vReturn>0)
				{
					$motc_lv0041->LV_UpdateCode($timeid,$codeid);
				}
				echo '[CONGP]';
					echo $vReturn;
				echo '[ENDCONGP]';
				echo '[CONGPDEF]';
					echo $codeid;
				echo '[ENDCONGPDEF]';
				echo '[CONGPDIS]';
					echo $timeid;
				echo '[ENDCONGPDIS]';
			}
			else
				$motc_lv0041->LV_UpdateCode($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxproject']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$codeid=str_replace("nghiphepnam","&",$codeid);
			$motc_lv0041->lvNVID=$_GET['NVID'];
			$motc_lv0041->LV_UpdateProject($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxshift']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0041->lvNVID=$_GET['NVID'];
			$motc_lv0041->LV_UpdateShift($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxshiftauto']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0041->lvNVID=$_GET['NVID'];
			$motc_lv0041->LV_UpdateShiftAuto($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxtimework']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0041->lvNVID=$_GET['NVID'];
			$motc_lv0041->LV_UpdateTimeWork($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxovertime']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0041->lvNVID=$_GET['NVID'];
			$motc_lv0041->LV_UpdateOverTime($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxcleartime']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0041->lvNVID=$_GET['NVID'];
			$motc_lv0041->LV_UpdateClearTime($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxgiobu']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0041->lvNVID=$_GET['NVID'];
			$motc_lv0041->LV_UpdateGioBu($timeid,$codeid);
			exit;
	}
	if(isset($_GET['ajaxgiosau22h']))
	{
			$timeid=$_GET['timecardid'];
			$codeid=$_GET['codeid'];
			$motc_lv0041->lvNVID=$_GET['NVID'];
			$motc_lv0041->LV_UpdateGioSau22h($timeid,$codeid);
			exit;
	}
	
}


if((int)$month==1)
{
	$month_re=12;
	$year_re=$year -1;
}
else
{
	$month_re=$month-1;
	$year_re=$year;
}
$motc_lv0041->lv004=$year."-".$month;
if($motc_lv0041->is_tc09_add==1)
{
if(isset($_GET['ajaxmonth']))
	{
			$timeid=$_GET['monthid'];
			$value=$_GET['value'];
			$opt=(int)$_GET['choose'];
			switch($opt)
			{
				case 1:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthHSO($timeid,$value,$_GET['curday']);
					break;
				case 2:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthRate($timeid,$value,$_GET['curday']);
					break;
				case 3:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_AprovalOne($timeid,$_GET['curday']);
					echo '[CHECK]';
					echo 3;
					echo '[ENDCHECK]';
					echo '[CHECKDEF]';
					echo $timeid;
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo $motc_lv0009->GetUnApr();
					echo '[ENDCHECKDIS]';
					break;
				case 4:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UnAproval($timeid);
					echo '[CHECK]';
					echo 4;
					echo '[ENDCHECK]';
					echo '[CHECKDEF]';
					echo $timeid;
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo $motc_lv0009->GetApr();
					echo '[ENDCHECKDIS]';
					break;
				case 5:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthPetrol($timeid,$value,$_GET['curday']);
					break;
				case 28:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthNumDayAllowance($timeid,$value,$_GET['curday']);
					break;
				case 29:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthNumDayLaundry($timeid,$value,$_GET['curday']);
					break;
				case 30:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthNumDayInsurance($timeid,$value,$_GET['curday']);
					break;
				case 100:
					$motc_lv0009->lvNVID=$_GET['EmpID'];
					$motc_lv0009->LV_UpdateMonthShiftCal($timeid,$value,$_GET['curday']);
					break;
			}
			exit;
	}
}
if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","TC0091.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0041->ArrPush[0]=$vLangArr[18];
$motc_lv0041->ArrPush[1]=$vLangArr[19];
$motc_lv0041->ArrPush[2]=$vLangArr[21];
$motc_lv0041->ArrPush[3]=$vLangArr[20];
$motc_lv0041->ArrPush[4]=$vLangArr[22];
$motc_lv0041->ArrPush[5]=$vLangArr[23];
$motc_lv0041->ArrPush[6]=$vLangArr[24];
$motc_lv0041->ArrPush[7]=$vLangArr[25];
$motc_lv0041->ArrPush[8]=$vLangArr[40];

$motc_lv0041->ArrFunc[0]='//Function';
$motc_lv0041->ArrFunc[1]=$vLangArr[2];
$motc_lv0041->ArrFunc[2]=$vLangArr[4];
$motc_lv0041->ArrFunc[3]=$vLangArr[6];
$motc_lv0041->ArrFunc[4]=$vLangArr[7];
$motc_lv0041->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$motc_lv0041->ArrFunc[6]=GetLangExcept('Apr',$plang);
$motc_lv0041->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$motc_lv0041->ArrFunc[8]=$vLangArr[10];
$motc_lv0041->ArrFunc[9]=$vLangArr[12];
$motc_lv0041->ArrFunc[10]=$vLangArr[0];
$motc_lv0041->ArrFunc[11]=$vLangArr[31];
$motc_lv0041->ArrFunc[12]=$vLangArr[32];
$motc_lv0041->ArrFunc[13]=$vLangArr[33];
$motc_lv0041->ArrFunc[14]=$vLangArr[34];
$motc_lv0041->ArrFunc[15]=$vLangArr[35];
////Other
$motc_lv0041->ArrOther[1]=$vLangArr[29];
$motc_lv0041->ArrOther[2]=$vLangArr[30];
$motc_lv0041->ArrTimeCordPush[]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$vFieldList=$_POST['txtFieldList'];
if(strpos($vFieldList,'lv001')===false) $vFieldList='lv001,'.$vFieldList;
$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0009->LV_AprovalAll($month,$year);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0009->LV_UnAprovalAll($month,$year);
}
elseif($flagID==5)
{
	$vresult=$motc_lv0009->LV_UpdatePreHSo($month,$year);
	$vresult=$motc_lv0008->LV_UpdateFN($year."-".$month."-01");
	echo '<font color="red">Đã cập nhất vào ngày giờ: '.$motc_lv0009->FormatView($motc_lv0009->DateCurrent,22).'</font>';
}
elseif($flagID==11)
{
	$lvNow=GetServerDate();
	$thisY=getyear($lvNow);
	if($year>=$thisY) $vresult=$motc_lv0008->LV_Update_PrevYear_ThisYear($year,($year-1));
}
elseif($flagID==10 && (int)$_POST['optTime']==36)
{
	global $data1;
  
	  function add_person1( $lv001,$lv002,$lv029)
	  {
	  global $data1;
	  
	  $data1 []= array(
	  'lv001' => $lv001,
	  'lv002' => $lv002,
	  'lv029' => $lv029,
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
				  $lv001="";
				  
				  $index = 1;
				  $cells = $row->getElementsByTagName( 'Cell' );
				  foreach( $cells as $cell )
				  { 
					  $ind = $cell->getAttribute( 'Index' );
					  if ( $ind != null ) $index = $ind;
					  if ( $index == 1 ) $lv001 = $cell->nodeValue;
					  if ( $index == 2 ) $lv002 = $cell->nodeValue;
					  if ( $index == 3 ) $lv029 = $cell->nodeValue;
					  $index += 1;
			  	}
			if(trim($lv001)!="" && $lv001!=NULL) 
				{
					add_person1( $lv001,$lv002,$lv029);
				}
		  }
		  $first_row = false;
		  }
		 
	  	}
		$lvtc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
		if($motc_lv0013->lv004==''|| $motc_lv0013->lv004==NULL) $motc_lv0013->lv004=$motc_lv0013->DateCurrent;
		foreach( $data1 as $row )
		{
			if(trim($row['lv001'])!="" && strpos(' ',trim($row['lv001']))===false )
			{
				$mohr_lv0020->LV_LoadID($row['lv001']);
				
				if($mohr_lv0020->lv001!=NULL)
				{
					$lvtc_lv0009->lvNVID=$mohr_lv0020->lv001;
					$lvtc_lv0009->LV_UpdateMonthNumDayPNDauKy($mohr_lv0020->lv001,$row['lv029'],$motc_lv0013->lv004);
				}
			}
		}
}
elseif($flagID==10)
{
	$data = array();
  
  function add_person( $lv001,$lv002,$lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv010,$lv011,$lv012,$lv013,$lv014,$lv015,$lv016,$lv017,$lv018,$lv019,$lv020,$lv021,$lv022,$lv023,$lv024,$lv025,$lv026,$lv027,$lv028,$lv029,$lv030,$lv031,$lv032,$lv033,$lv034)
  {
  global $data;
  $data []= array(
  'lv001' => $lv001,
  'lv002' => $lv002,
  'lv003' => $lv003,
  'lv004' => $lv004,
  'lv005' => $lv005,
  'lv006' => $lv006,
  'lv007' => $lv007,
  'lv008' => $lv008,
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
  'lv034' => $lv034
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
			  if ( $index == 6 ) $lv006 = $cell->nodeValue;
			  if ( $index == 7 ) $lv007 = $cell->nodeValue;
			  if ( $index == 8 ) $lv008 = $cell->nodeValue;
			  if ( $index == 9 ) $lv009 = $cell->nodeValue;
			  if ( $index == 10 ) $lv010 = $cell->nodeValue;
			  if ( $index == 11 ) $lv011 = $cell->nodeValue;
			  if ( $index == 12 ) $lv012 = $cell->nodeValue;
			  if ( $index == 13 ) $lv013 = $cell->nodeValue;
			  if ( $index == 14 ) $lv014 = $cell->nodeValue;
			  if ( $index == 15 ) $lv015 = $cell->nodeValue;
			  if ( $index == 16 ) $lv016 = $cell->nodeValue;
			  if ( $index == 17 ) $lv017 = $cell->nodeValue;
			  if ( $index == 18 ) $lv018 = $cell->nodeValue;
			  if ( $index == 19 ) $lv019 = $cell->nodeValue;
			  if ( $index == 20 ) $lv020 = $cell->nodeValue;
			  if ( $index == 21 ) $lv021 = $cell->nodeValue;
			  if ( $index == 22 ) $lv022 = $cell->nodeValue;
			  if ( $index == 23 ) $lv023 = $cell->nodeValue;
			  if ( $index == 24 ) $lv024 = $cell->nodeValue;
			  if ( $index == 25 ) $lv025 = $cell->nodeValue;
			  if ( $index == 26 ) $lv026 = $cell->nodeValue;
			  if ( $index == 27 ) $lv027 = $cell->nodeValue;
			  if ( $index == 28 ) $lv028 = $cell->nodeValue;
			  if ( $index == 29 ) $lv029 = $cell->nodeValue;
			  if ( $index == 30 ) $lv030 = $cell->nodeValue;
			  if ( $index == 31 ) $lv031 = $cell->nodeValue;
			  if ( $index == 32 ) $lv032 = $cell->nodeValue;
			  if ( $index == 33 ) $lv033 = $cell->nodeValue;
			  if ( $index == 34 ) $lv034 = $cell->nodeValue;
			  
			  
			  
			  $index += 1;
		  }
	  	add_person( $lv001, $lv002, $lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv010,$lv011,$lv012,$lv013,$lv014,$lv015,$lv016,$lv017,$lv018,$lv019,$lv020,$lv021,$lv022,$lv023,$lv024,$lv025,$lv026,$lv027,$lv028,$lv029,$lv030,$lv031,$lv032,$lv033,$lv034);
	  }
	    $first_row = false;
	  }
  	}
	global $data;
	$motc_lv0011=new tc_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0011');
	$motc_lv0011->LV_EMPALLLIST($motc_lv0013->lv004,$motc_lv0013->lv005);
	$voptTime=(int)$_POST['optTime'];
	$vFixCol=false;
	$vArrCol=Array();
	$vCot3=false;
	foreach( $data as $row )
	{
		if($vFixCol==false)
		{
			$vArrCol['lv003']=$row['lv003'];
			$vArrCol['lv004']=$row['lv004'];
			$vArrCol['lv005']=$row['lv005'];
			$vArrCol['lv006']=$row['lv006'];
			$vArrCol['lv007']=$row['lv007'];
			$vArrCol['lv008']=$row['lv008'];
			$vArrCol['lv009']=$row['lv009'];
			$vArrCol['lv010']=$row['lv010'];
			$vArrCol['lv011']=$row['lv011'];
			$vArrCol['lv012']=$row['lv012'];
			$vArrCol['lv013']=$row['lv013'];
			$vArrCol['lv014']=$row['lv014'];
			$vArrCol['lv015']=$row['lv015'];
			$vArrCol['lv016']=$row['lv016'];
			$vArrCol['lv017']=$row['lv017'];
			$vArrCol['lv018']=$row['lv018'];
			$vArrCol['lv019']=$row['lv019'];
			$vArrCol['lv020']=$row['lv020'];
			$vArrCol['lv021']=$row['lv021'];
			$vArrCol['lv022']=$row['lv022'];
			$vArrCol['lv023']=$row['lv023'];
			$vArrCol['lv024']=$row['lv024'];
			$vArrCol['lv025']=$row['lv025'];
			$vArrCol['lv026']=$row['lv026'];
			$vArrCol['lv027']=$row['lv027'];
			$vArrCol['lv028']=$row['lv028'];
			$vArrCol['lv029']=$row['lv029'];
			$vArrCol['lv030']=$row['lv030'];
			$vArrCol['lv031']=$row['lv031'];
			$vArrCol['lv032']=$row['lv032'];
			$vArrCol['lv033']=$row['lv033'];
			$vArrCol['lv034']=$row['lv034'];
		}		
		$mohr_lv0020->LV_LoadID(trim($row['lv001']));
		if($mohr_lv0020->lv001!=NULL && $mohr_lv0020->lv001!=NULL)
		{
			if($vFixCol==false) 
			{
				$vArrCol=$vArrCol1;
				if($vArrCol1['lv003']=='0') $vCot3=true;
			}
			//print_r($vArrCol);
			$vFixCol=true;
			 $vEmpID=$mohr_lv0020->lv001;
			
			//Ngày 1
			// 'Số ngày:'.$vArrCol['lv003'].",".$motc_lv0013->lv004.",".$motc_lv0013->lv005."<br/>";
			$vMoreAdv=0;
		if(trim($row['lv003']!="") || $voptTime==25)
		{
			if($vCot3==true)
			{
				switch(trim($row['lv003']))
				{
					case '0':
					case '1':
					case '2':
					case '3':
					case '4':
					case '5':
					case '10':
						$vMoreAdv=trim($row['lv003']);
						break;
					default:
						$vMoreAdv='0';
						break;
				}
			}
			else
			{
					$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv003'],$motc_lv0013->lv004,$motc_lv0013->lv005);
					//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-01";
					if($voptTime==5)
						$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv003'],0,$vEmpImport,$vMoreAdv);
					else
					$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv003'],$vMoreAdv);	
			}
		}		
						
		//Ngày 2
		if(trim($row['lv004']!="") || $voptTime==25)
		{
			 $vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv004'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-02";
			 if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv004'],0,$vEmpImport,$vMoreAdv);
			else
				$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv004'],$vMoreAdv);	
		}	
		//Ngày 3
		if(trim($row['lv005']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv005'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-03";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv005'],0,$vEmpImport,$vMoreAdv);
			else
				$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv005'],$vMoreAdv);	
		}	
		//Ngày 4
		if(trim($row['lv006']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv006'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-04";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv006'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv006'],$vMoreAdv);	
		}	
		//Ngày 5
		if(trim($row['lv007']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv007'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-05";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv007'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv007'],$vMoreAdv);	
		}	
		//Ngày 6
		if(trim($row['lv008']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv008'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-06";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv008'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv008'],$vMoreAdv);	
		}	
		//Ngày 7
		if(trim($row['lv009']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv009'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-07";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv009'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv009'],$vMoreAdv);	
		}	
		//Ngày 8
		if(trim($row['lv010']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv010'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-08";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv010'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv010'],$vMoreAdv);	
		}	
		//Ngày 9
		if(trim($row['lv011']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv011'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-09";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv011'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv011'],$vMoreAdv);	
		}	
		//Ngày 10
		if(trim($row['lv012']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv012'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-10";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv012'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv012'],$vMoreAdv);	
		}	
		//Ngày 11
		if(trim($row['lv013']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv013'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-11";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv013'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv013'],$vMoreAdv);	
		}	
		//Ngày 12
		if(trim($row['lv014']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv014'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-12";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv014'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv014'],$vMoreAdv);	
		}	
		//Ngày 13
		if(trim($row['lv015']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv015'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-13";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv015'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv015'],$vMoreAdv);	
		}	
		//Ngày 14
		if(trim($row['lv016']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv016'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-14";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv016'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv016'],$vMoreAdv);	
		}	
		//Ngày 15
		if(trim($row['lv017']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv017'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-15";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv017'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv017'],$vMoreAdv);	
		}	
		//Ngày 16
		if(trim($row['lv018']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv018'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-16";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv018'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv018'],$vMoreAdv);	
		}	
		//Ngày 17
		if(trim($row['lv019']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv019'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-17";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv019'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv019'],$vMoreAdv);	
		}	
		//Ngày 18
		if(trim($row['lv020']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv020'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-18";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv020'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv020'],$vMoreAdv);	
		}	
		//Ngày 19
		if(trim($row['lv021']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv021'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-19";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv021'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv021'],$vMoreAdv);	
		}	
		//Ngày 20
		if(trim($row['lv022']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv022'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-20";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv022'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv022'],$vMoreAdv);	
		}	
		//Ngày 21
		if(trim($row['lv023']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv023'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-21";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv023'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv023'],$vMoreAdv);	
		}	
		//Ngày 22
		if(trim($row['lv024']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv024'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-22";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv024'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv024'],$vMoreAdv);	
		}	
		//Ngày 23
		if(trim($row['lv025']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv025'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-23";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv025'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv025'],$vMoreAdv);	
		}	
		//Ngày 24
		if(trim($row['lv026']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv026'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-24";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv026'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv026'],$vMoreAdv);	
		}	
		//Ngày 25
		if(trim($row['lv027']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv027'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-25";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv027'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv027'],$vMoreAdv);	
		}	
		//Ngày 26
		if(trim($row['lv028']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv028'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-26";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv028'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv028'],$vMoreAdv);	
		}	
		//Ngày 27
		if(trim($row['lv029']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv029'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-27";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv029'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv029'],$vMoreAdv);	
		}	
		//Ngày 28
		if(trim($row['lv030']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv030'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-28";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv030'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv030'],$vMoreAdv);	
		}	
		//Ngày 29
		if(trim($row['lv031']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv031'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-29";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv031'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv031'],$vMoreAdv);	
		}	
		//Ngày 30
		if(trim($row['lv032']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv032'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-30";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv032'],0,$vEmpImport,$vMoreAdv);
			else
			$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv032'],$vMoreAdv);	
		}	
		//Ngày 31
		if(trim($row['lv033']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv033'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-31";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv033'],0,$vEmpImport,$vMoreAdv);
			else
				$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv033'],$vMoreAdv);	
		}
		//Ngày 32
		if(trim($row['lv034']!="") || $voptTime==25)
		{
			$vDate=$motc_lv0013->LV_LoadCalendarWork($vArrCol['lv034'],$motc_lv0013->lv004,$motc_lv0013->lv005);
			//$vDate=$motc_lv0013->lv007."-".Fillnum($motc_lv0013->lv006,2)."-31";
			if($voptTime==5)
				$motc_lv0012->LV_InsertXML($vEmpID,$vDate,$row['lv034'],0,$vEmpImport,$vMoreAdv);
			else
				$vresult=$motc_lv0011->LV_UpdateCodeEmpOption($voptTime,$vEmpID,$vDate,$row['lv034'],$vMoreAdv);	
		}
		}
		$vArrCol1=$vArrCol;		
		}
		if($voptTime==5)
		{
			$vsql="delete from tc_lv0012 where lv003='00:00:00'";
			db_query($vsql);
		}
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}

}
elseif($flagID==15)
{
	$vresult=$motc_lv0009->LV_UpdateKhoaPhep($month,$year);
}
elseif($flagID==16)
{
	$vresult=$motc_lv0009->LV_UpdateKhoaCong($month,$year);
}
elseif($flagID==17)
{
	$vresult=$motc_lv0009->LV_UpdateMoKhoaCong($month,$year);
}
elseif($flagID==18)
{
	$vresult=$motc_lv0009->LV_UpdateMoKhoaPhep($month,$year);
}
//first is load
if(($_POST['txtFlag']) != 2)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0041->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0041');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0041->ListView;
$curPage = $motc_lv0041->CurPage;
$maxRows =$motc_lv0041->MaxRows;
$vOrderList=$motc_lv0041->ListOrder;
$vSortNum=$motc_lv0041->SortNum;
}
elseif($_POST["txtFlag"]==2)
{
	$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$motc_lv0041->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0041',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}

$motc_lv0041->lvNVID= $_GET['ID'] ?? '';
if($maxRows ==0) $maxRows = 10;

//$totalRowsC=$motc_lv0041->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
//$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
$motc_lv0009->LV_LoadMonthID($motc_lv0041->lvNVID,$month,$year);
$motc_lv0009->LV_ReLoadMonthID($motc_lv0041->lvNVID,$month_re,$year_re);
$motc_lv0041->CalID=$motc_lv0013->lv001;
$motc_lv0041->month=$month;
$motc_lv0041->year=$year;
$motc_lv0041->dayfrom=$_POST['txtDayFrom'];
$motc_lv0041->dayto=$_POST['txtDayTo'];
$motc_lv0041->lv004=$year."-".$month;
if($motc_lv0041->dayfrom=="")
	$motc_lv0041->datefrom=$motc_lv0013->lv004;
else
	$motc_lv0041->datefrom=$year."-".$month."-".Fillnum($motc_lv0041->dayfrom,2);
//$motc_lv0041->datefrom=$year."-".$month."-01";	
if($motc_lv0041->dayto=="")
	$motc_lv0041->dateto=$motc_lv0013->lv005;
else
	$motc_lv0041->dateto=$year."-".$month."-".Fillnum($motc_lv0041->dayto,2);
//$motc_lv0041->dateto=$year."-".$month."-".GetDayInMonth($motc_lv0041->year,$motc_lv0041->month);
$motc_lv0041->lv028="";
$motc_lv0041->lv029=$_POST['txtlv029'];
$motc_lv0041->lv099=$_POST['txtlv099'];
if($motc_lv0041->GetApr()==0)	$motc_lv0041->lv028=$motc_lv0041->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
if(!isset($_POST['txtlv029']))	
{
	if($motc_lv0041->lv029=="") 
	{
		$mohr_lv0020->LV_LoadID(getInfor($_SESSION['ERPSOFV2RUserID'],2));
		$motc_lv0041->lv029=$mohr_lv0020->lv029;
	}
}	
$motc_lv0041->lv001=$_POST['txtlv001'];
$motc_lv0041->lv002=$_POST['txtlv002'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<style type="text/css">
.lvsizeinput
{width:60px;
border:1;
}
.lvsizeinput2
{width:180px;
border:1;
}
.lvsizeselect
{width:160px;
border:1;
}
.lvsizeselect2
{width:60px;
border:1;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascripts/pubscript.js"></script>
</head>
<script language="JavaScript" type="text/javascript">
<!--
function FunctRunning1(vID)
{
RunFunction(vID,'child');
}
function Add()
{

RunFunction('','add');
}
function Edt()
{
	lv_chk_list(document.frmchoose,'lvChk',2);
}
function Edit(vValue)
{

	RunFunction(vValue,'edit');
}
function Fil()
{
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv002'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>','filter');
}
function Save()
	{
		var o=document.frmchoose;

				o.txtFlag.value="1";
				o.submit();
		
	}

//////////////RunFunction/////////////////////////
function RunFunction(vID,func)
{
	var str="<br><iframe height=1000 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>tc_lv0041?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo  $_GET['ID'] ?? '';?>&ID=<?php echo  $_GET['ID'] ?? '';?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
	
}
function UpdateKhoaPhep()
{
	if(confirm("Bạn muốn khoá toàn bộ phép trong tháng này không Y/N?"))
	{
		var o=document.frmchoose;
		o.txtFlag.value=15;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
}
function UpdateKhoaCong()
{
	if(confirm("Bạn muốn khoá toàn bộ công trong tháng này không Y/N?"))
	{
		var o=document.frmchoose;
		o.txtFlag.value=16;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
}
function UpdateMoKhoaPhep()
{
	if(confirm("Bạn muốn mở khoá toàn bộ phép trong tháng này không Y/N?"))
	{
		var o=document.frmchoose;
		o.txtFlag.value=18;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
}
function UpdateMoKhoaCong()
{
	if(confirm("Bạn muốn mở khoá toàn bộ công trong tháng này không Y/N?"))
	{
		var o=document.frmchoose;
		o.txtFlag.value=17;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
}
function UpdatePreHsoNam()
{
	var o=document.frmchoose;
	o.txtFlag.value=11;
	o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	o.submit();
}
function UpdatePreHso()
{
	if(confirm('Bạn có muốn cập nhật thông tin tháng và năm làm việc!'))
	{
		var o=document.frmchoose;
		o.txtFlag.value=5;
	 	o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 	o.submit();
	}
}
function Apr()
{
var o=document.frmchoose;
	o.txtFlag.value=3;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function UnApr()
{
var o=document.frmchoose;
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
///////////////////////////Report/////////////////////
function Report(vValue)
{
var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>tc_lv0041?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function ChangeTimeCard(o)
{
var o1=document.frmchoose;
 	o1.submit();
}
function ChangeTimeCard1(o)
{
var o1=document.frmchoose;
	o1.txtMonthYear.value=o.value;
 	o1.submit();
}
function ChangeInfor()
{
var o1=document.frmchoose;
 	o1.submit();
}
function ChangePre()
{
var o1=document.frmchoose;
var month=parseFloat( o1.month.value);
var year=parseFloat(o1.year.value);
if(month==1)
{
	year=year-1;
	month=12;
	SetYear(year);
}
else
{
	month=month-1;
}
if(month>=10)
	o1.txtMonthYear.value=year+'-'+month;
else
	o1.txtMonthYear.value=year+'-0'+month;
 	o1.submit();
}
function ChangeNext()
{
var o1=document.frmchoose;
var month=parseFloat( o1.month.value);
var year=parseFloat(o1.year.value);

if(month==parseFloat(12))
{
	year=year+1;
	month=1;
	SetYear(year);
}
else
{
	month=parseFloat(month)+1;

}
if(month>=parseFloat(10))
{
	o1.txtMonthYear.value=year+'-'+month;
}
else
{
	o1.txtMonthYear.value=year+'-0'+month;
}
 	o1.submit();
}
function SetYear(years)
{
var o1=document.frmchoose;
	for(i=0;i<12;i++)
	{
	 if(parseInt(i)<10)
	 	o1.txtMonthYear.options[i].value=years+'-0'+(i+1);
	 else 
	 	o1.txtMonthYear.options[i].value=years+'-'+(i+1);
	
	}
	
}
function settime8hour(oj)
{
	var i=0;
	for(i=1;i<=31;i++)
	{
	 	var o=document.getElementById("txtlv002"+i);
	 	  if(o!= null)
	 	  {
		 	  if(oj.checked)
		 	  {
			 	  if(o.parentElement.parentElement.className!="lvlinehtable3")
		 	   o.value="08:00:00";
		 	  }
		 	  else
		 		 o.value="00:00:00";
	 	  }
	}
}
function checkRunCong(stt,o)
{
	var giatri=document.getElementById("txttimecardall");
	if(!o.checked) return;
	if(confirm("Bạn muốn chọn công ["+giatri.value+"] cho tất cả dòng cột này Y/N?"))
	{
	frm=document.frmchoose;
	var pt=frm.elements.length;
	var strrun="";
	
	var namept="lineday_"+stt;
	for(i=0;i<pt;i++)
    { var t=frm.elements[i];
	
      if(t.className==namept)
	    {
			strrun=t.lang;
			t.value=giatri.value;
			strrun=strrun.replace("@!99",giatri.value)
			window.setTimeout(strrun,10);
	    }
    }
	}
	
}

function checkRunTC(stt,o)
{
	var giatri=o;
	if(confirm("Bạn muốn chọn ["+giatri.value+"] cho tất cả dòng cột này Y/N?"))
	{
	frm=document.frmchoose;
	var pt=frm.elements.length;
	var strrun="";
	
	var namept="linecontrol_"+stt;
	for(i=0;i<pt;i++)
    { var t=frm.elements[i];
      if(t.className==namept)
	    {
			strrun=t.lang;
			if(stt==100)
				t.value=(giatri.value==1)?'Fixed':'Auto';
			if(stt==1)
				t.value=(t.value=='Khóa')?'Mở khóa':'Khóa';
			else
				t.value=giatri.value;
			strrun=strrun.replace("@!99",giatri.value)
			window.setTimeout(strrun,10);
	    }
    }
	}
	
}
function Save()
{
	ChangeInfor();
}
//-->
</script>
<?php
if($motc_lv0041->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft">
					<form action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['child'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmxml" id="frmxml"  enctype="multipart/form-data">
					<table style="background:#f2f2f2;font:10px arial">
					
						<tr>
							<!--
							<td>
							<input type="hidden" id="txtMonthYear" name="txtMonthYear" value="<?php echo $_POST['txtMonthYear'];?>">
							 <select id="optTime" name="optTime"  >
								<option >--<?php echo $vLangArr[42];?>--</option>
								<option value='1'><?php echo $vLangArr[43];?></option>
								<option value='5'><?php echo $vLangArr[44];?></option>
								<option value='15'><?php echo $vLangArr[45];?></option>
								<option value='25'><?php echo $vLangArr[46];?></option>
								<option value='35'><?php echo 'Tải mẫu công trình';?></option>
								<option value='36'><?php echo 'Tải phép năm đầu kỳ của tháng';?></option>
							</select>
							<input name="txtFlag" type="hidden" id="txtFlag" value="10"/>
						<?php echo $vLangArr[47];?><input type="file" name="file" /><input type="submit" value="<?php echo $vLangArr[48];?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="tc_lv0041/MAU.zip" title="<?php echo $vLangArr[33];?>"><?php echo $vLangArr[57];?></a>
				
							</td>
							<td width="90">&nbsp;
							</td>-->
							<td>
					  <!--<input type="button" value="<?php echo $vLangArr[49];?>" onclick="UpdatePreHsoNam()"/>-->
					 	  		<input type="button" value="<?php echo $vLangArr[50];?>" onclick="UpdatePreHso()"/>
						 	</td>
							<td>
								<input type="button" value="Khoá phép" onclick="UpdateKhoaPhep()"/>
							</td>
							<?php if($motc_lv0041->GetApr()==1) {?>
							<td>
							<input type="button" value="Mở khoá phép" onclick="UpdateMoKhoaPhep()"/>
							</td>
							<td>
							<input type="button" value="Khoá công" onclick="UpdateKhoaCong()"/>
							</td>
							<td>
							<input type="button" value="Mở khoá công" onclick="UpdateMoKhoaCong()"/>
							</td>
							<?php }?>
						</tr>
						
					</table>
						</form>
                    <form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['child'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <p>
					  <table style="background:#f2f2f2;font:10px arial">
						<tr>
								<td  height="20px" colspan=3>
					    <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					   
					    <input type="button" id="txtPre" name="txtPre" value="Previous" onClick="ChangePre()">
					   <select id="txtDayFrom" name="txtDayFrom"  onChange="ChangeInfor()">
							<option value=''><?php echo $vLangArr[51];?></option>
							<?php
							for($i=1;$i<=GetDayInMonth($motc_lv0041->year,$motc_lv0041->month);$i++)
							{
								if((int)$motc_lv0041->dayfrom==$i)
									echo '<option selected="selected" value="'.Fillnum($i,2).'">'.Fillnum($i,2).'</option>';							
								else
									echo '<option value="'.Fillnum($i,2).'">'.Fillnum($i,2).'</option>';							
							}
							?>
							
					   </select>					   
					    <select id="txtMonthYear" name="txtMonthYear" onChange="ChangeTimeCard(this)">
						
					<?php
						
						for($i=1;$i<13;$i++)
						{
						if((int)$month==$i)
							echo '<option selected="selected" value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						else
							echo '<option value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						}
					?>	
					</select>
					 <select id="txtDayTo" name="txtDayTo"  onChange="ChangeInfor()">
							<option value=''><?php echo $vLangArr[52];?></option>
							<?php
							for($i=1;$i<=GetDayInMonth($motc_lv0041->year,$motc_lv0041->month);$i++)
							{
								if((int)$motc_lv0041->dayto==$i)
									echo '<option selected="selected" value="'.Fillnum($i,2).'">'.Fillnum($i,2).'</option>';							
								else
									echo '<option value="'.Fillnum($i,2).'">'.Fillnum($i,2).'</option>';							
							}
							?>							
					   </select>
					<input type="button" id="txtPre" name="txtPre" value="Next" onClick="ChangeNext()"> 
					</td>
					<td><?php echo $vLangArr[53];?></td>
					<td colspan="2"><select  name="txtlv029"  id="txtlv029"  tabindex="1" maxlength="255" style="width:250px" onKeyPress="return CheckKey(event,7)" onChange="ChangeInfor()"><option value=''>...</option><?php echo $motc_lv0041->LV_GetChildDepSelect($motc_lv0041->lv028,$motc_lv0041->lv029);?></select> 
					</td>					
					<td>
					<?php echo $vLangArr[54];?> </td>
					<td>
					<table width="100%">
							<tr>
								<td>
									<ul id="pop-nav" lang="pop-nav11" onMouseOver="ChangeName(this,11)">
										<li class="menupopT">
										<input onkeyup="LoadSelfNextParentNewSreen(this,'txtlv001','hr_lv0020','lv001','lv001,lv002','','',0)"  type="text" name="txtlv001" id="txtlv001" value="<?php echo $motc_lv0041->lv001;?>"  onKeyPress="return CheckKey(event,7)"/>
							<div id="lv_popup" lang="lv_popup11"> </div>
									</li>
								</ul>
								</td>
							</tr>
						</table>						
					</td>
					</tr>
					<tr>
					<td><?php echo $vLangArr[55];?><input type="checkbox" name="chkviewtime" value="1" <?php echo ((int)$_POST['chkviewtime']==1)?'checked':'';?> onChange="ChangeInfor()"></td>
					<td colspan=2>
					<!-- Lọc SPI cho kinh doanh</td>
					<td><select  name="txtlv099"  id="txtlv099"  tabindex="1" maxlength="255" style="width:100px" onKeyPress="return CheckKey(event,7)" onChange="ChangeInfor()"><option value=''>...</option><?php echo $motc_lv0041->LV_LinkField('lv099',$motc_lv0041->lv099);?></select>-->
					<?php echo $vLangArr[26];?>:<input type="checkbox" name="chkviewinfo" value="1" <?php echo ((int)$_POST['chkviewinfo']==1)?'checked':'';?> onChange="ChangeInfor()">
					 </td>
					<td colspan=2><?php echo $vLangArr[56];?></td>
					<td><select name="txttimecardall" id="txttimecardall">
							<?php echo $motc_lv0041->LV_LinkField('lv007','');?></select>
						</select>
					</td>
					<td>
					<?php echo $vLangArr[57];?> </td>
					<td>
						<table width="100%">
							<tr>
								<td>
									<ul id="pop-nav" lang="pop-nav12" onMouseOver="ChangeName(this,12)">
										<li class="menupopT">
										<input onkeyup="LoadSelfNextParentNewSreen(this,'txtlv002','hr_lv0020','lv002','lv002,lv001','','',0)"  type="text" name="txtlv002" id="txtlv002" value="<?php echo $motc_lv0041->lv002;?>"  onKeyPress="return CheckKey(event,7)"/>
							<div id="lv_popup12" lang="lv_popup12"> </div>
									</li>
								</ul>
								</td>
							</tr>
						</table>				
					</td>
					</tr>
					</table>
					    <?php 
						echo $motc_lv0041->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmprocess','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum,0,$_POST['chkviewinfo'],(int)$_POST['chkviewtime']);?>
						  <?php 
						//  if((int)$_POST['chkviewinfo']==1)
						//echo $motc_lv0041->GetTimeCode($motc_lv0041->lvNVID,$year."-".$month."-01",$year."-".$month."-".GetDayInMonth((int)$year,(int)$month),'1');?>
					    <input name="txtStringID" type="hidden" id="txtStringID" />
					    <input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
					    <input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
					    <input name="txtFlag" type="hidden" id="txtFlag" value="2"/><input type="button" id="txtPre" name="txtPre" value="Previous" onClick="ChangePre()"><select id="txtMonthYear1" name="txtMonthYear1" onChange="ChangeTimeCard1(this)">
						
					<?php
						
						for($i=1;$i<13;$i++)
						{
						if((int)$month==$i)
							echo '<option selected="selected" value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						else
							echo '<option value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						}
					?>	
					</select><input type="button" id="txtPre" name="txtPre" value="Next" onClick="ChangeNext()">
					<input type="hidden" name="month" id="month" value="<?php echo $month;?>"/>
					<input type="hidden" name="year" id="year" value="<?php echo $year;?>"/>
					</form>
				<form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
						<input type="hidden" name="childfunc" id="year" value="rpt"/>
				  </form>
				  
</div></div>
<div>
					<?php 
					if($plang=="") $plang="VN";
						$vLangArr=GetLangFile("$vDir../","TC0003.txt",$plang);

					//////////////////////////////////////////////////////////////////////////////////////////////////////
					$motc_lv0002->ArrPush[0]='';
					$motc_lv0002->ArrPush[1]=$vLangArr[18];
					$motc_lv0002->ArrPush[2]=$vLangArr[20];
					$motc_lv0002->ArrPush[3]=$vLangArr[21];
					$motc_lv0002->ArrPush[4]=$vLangArr[22];
					$motc_lv0002->ArrPush[5]='Tổng';
					echo $motc_lv0002->LV_BuilListReportTC('lv001,lv002,lv003,lv004','document.frmchoose','chkAll','lvChk',$curRow, 1000,$paging,'',$motc_lv0041->ArrTC);?>
					</div>
</body>
				
<?php
} else {
	include("../tc_lv0041/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $motc_lv0041->ArrPush[0];?>';	
function UpdateMonthlyShift(value,vEmpID,obj,vopt)
		{
			if(obj.value=='Fixed')
			{
				codeid=0;
				obj.value='Auto';
			}
				
			else
			{
				obj.value='Fixed';
				codeid=1;
			}
				
			
			$xmlhttp=null;
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxmonth=month"+"&monthid="+value+"&value="+codeid+"&choose="+vopt+"&curday=<?php echo $year."-".$month."-01";?>&EmpID="+vEmpID;
			else
				url=url+"&ajaxmonth=month"+"&monthid="+value+"&value="+codeid+"&choose="+vopt+"&curday=<?php echo $year."-".$month."-01";?>&EmpID="+vEmpID;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChanged;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function UpdateMonthly(value,vEmpID,codeid,vopt)
		{
			$xmlhttp=null;
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxmonth=month"+"&monthid="+value+"&value="+codeid+"&choose="+vopt+"&curday=<?php echo $year."-".$month."-01";?>&EmpID="+vEmpID;
			else
				url=url+"&ajaxmonth=month"+"&monthid="+value+"&value="+codeid+"&choose="+vopt+"&curday=<?php echo $year."-".$month."-01";?>&EmpID="+vEmpID;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChanged;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChanged()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				var startdomain1=xmlhttp.responseText.indexOf('[CHECKDEF]')+10;
				var enddomain1=xmlhttp.responseText.indexOf('[ENDCHECKDEF]');
				var domainid1=xmlhttp.responseText.substr(startdomain1,enddomain1-startdomain1);
				var startdomain2=xmlhttp.responseText.indexOf('[CHECKDIS]')+10;
				var enddomain2=xmlhttp.responseText.indexOf('[ENDCHECKDIS]');
				var domainid2=xmlhttp.responseText.substr(startdomain2,enddomain2-startdomain2);
				if(parseInt(domainid)==3) 
				{
					if(parseInt(domainid2)==1)
					{
						//document.getElementById("btmonth_"+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="blue";
						document.getElementById('btmonth_'+domainid1).value="Mở khóa";
						document.getElementById('btmonth_'+domainid1).onclick = function(){
						UpdateMonthly(domainid1,'','',4);
						}
					}
					else
					{
						document.getElementById('btmonth_'+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="blue";
						document.getElementById('btmonth_'+domainid1).value="Mở khóa";
					}
				}
				if(parseInt(domainid)==4)
				{
					if(parseInt(domainid2)==1)
					{
						//document.getElementById("btmonth_"+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="black";
						document.getElementById('btmonth_'+domainid1).value="Khóa";
						document.getElementById('btmonth_'+domainid1).onclick = function(){
						UpdateMonthly(domainid1,'','',3);
						}
						
					}
					else
					{
						document.getElementById('btmonth_'+domainid1).style.color="black";
						document.getElementById('btmonth_'+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).value="Khóa";
						
						
					}
				}
			}
		}
		function runchangetimework(value,lvNVID,codeid)
		{
			$xmlhttp112=null;
			xmlhttp112=GetXmlHttpObject();
			if (xmlhttp112==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxtimework=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxtimework=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp112.onreadystatechange=stateChangedProgram;
			xmlhttp112.open("GET",url,true);
			xmlhttp112.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp112.readyState==4)
			{
			}
		}
		function runchangeshiftauto(value,lvNVID,so)
		{
			if(so.value=='Auto')
			{
				so.value='Fixed';
				codeid=1;
			}
			else
			{
				so.value='Auto';
				codeid=0;
			}
			$xmlhttp251=null;
			xmlhttp251=GetXmlHttpObject();
			if (xmlhttp251==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxshiftauto=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxshiftauto=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp251.onreadystatechange=stateChangedShiftAuto;
			xmlhttp251.open("GET",url,true);
			xmlhttp251.send(null);
		}
		function stateChangedShiftAuto()
		{
			if (xmlhttp251.readyState==4)
			{
			}
		}
		function runchangeovertime(value,lvNVID,codeid)
		{
			$xmlhttp113=null;
			xmlhttp113=GetXmlHttpObject();
			if (xmlhttp113==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxovertime=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxovertime=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp113.onreadystatechange=stateChangedProgram;
			xmlhttp113.open("GET",url,true);
			xmlhttp113.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp113.readyState==4)
			{
			}
		}
		function runchangecleartime(value,lvNVID,codeid)
		{
			$xmlhttp114=null;
			xmlhttp114=GetXmlHttpObject();
			if (xmlhttp114==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxcleartime=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxcleartime=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp114.onreadystatechange=stateChangedProgram;
			xmlhttp114.open("GET",url,true);
			xmlhttp114.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp114.readyState==4)
			{
			}
		}
		function runchangegiosau22h(value,lvNVID,codeid)
		{
			xmlhttp116=null;
			xmlhttp116=GetXmlHttpObject();
			if (xmlhttp116==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxgiosau22h=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxgiosau22h=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp116.onreadystatechange=stateChangedProgram;
			xmlhttp116.open("GET",url,true);
			xmlhttp116.send(null);
		}
		function runchangegiobu(value,lvNVID,codeid)
		{
			$xmlhttp115=null;
			xmlhttp115=GetXmlHttpObject();
			if (xmlhttp115==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxgiobu=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxgiobu=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp115.onreadystatechange=stateChangedProgram;
			xmlhttp115.open("GET",url,true);
			xmlhttp115.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp115.readyState==4)
			{
			}
		}
		function runchangeshift(value,lvNVID,codeid)
		{
			$xmlhttp111=null;
			xmlhttp111=GetXmlHttpObject();
			if (xmlhttp111==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxshift=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxshift=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp111.onreadystatechange=stateChangedProgram;
			xmlhttp111.open("GET",url,true);
			xmlhttp111.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp111.readyState==4)
			{
			}
		}
		
		function runchangeproject(value,lvNVID,codeid)
		{
			$xmlhttp31=null;
			xmlhttp31=GetXmlHttpObject();
			if (xmlhttp31==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			codeid=codeid.replace("&","nghiphepnam");
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxproject=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxproject=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp31.onreadystatechange=staterunchangeproject;
			xmlhttp31.open("GET",url,true);
			xmlhttp31.send(null);
		}
		function staterunchangeproject()
		{
			if (xmlhttp31.readyState==4)
			{
				var startdomain=xmlhttp31.responseText.indexOf('[CONGP]')+7;
				var enddomain=xmlhttp31.responseText.indexOf('[ENDCONGP]');
				var domainid=xmlhttp31.responseText.substr(startdomain,enddomain-startdomain);				
				var startdomain1=xmlhttp31.responseText.indexOf('[CONGPDEF]')+10;
				var enddomain1=xmlhttp31.responseText.indexOf('[ENDCONGPDEF]');
				var domainid1=xmlhttp31.responseText.substr(startdomain1,enddomain1-startdomain1);
				var startdomain2=xmlhttp31.responseText.indexOf('[CONGPDIS]')+10;
				var enddomain2=xmlhttp31.responseText.indexOf('[ENDCONGPDIS]');
				var domainid2=xmlhttp31.responseText.substr(startdomain2,enddomain2-startdomain2);
				if(domainid1=='B')
				{
					if(parseInt(domainid)<=0) 
						{
							document.getElementById('timecard_'+domainid2).value="";
							alert('Công B không còn để dùng');
						}
				}
				else if(domainid1=='A' || domainid1=='HA')
				{
					if(parseInt(domainid)<=0) 
						{
							document.getElementById('timecard_'+domainid2).value="";
							if(domainid1=='HA')
								alert('Công HA không còn để dùng');
							else
								alert('Công A không còn để dùng');
						}
				}
				else
				{
				}
				//document.getElementById('txtlv911').value=domainid2;
			}
		}
		function runchangetime(value,lvNVID,codeid)
		{
			$xmlhttp1=null;
			xmlhttp1=GetXmlHttpObject();
			if (xmlhttp1==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			codeid=codeid.replace("&","nghiphepnam");
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxpro=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxpro=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedProgram;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp1.readyState==4)
			{
				var startdomain=xmlhttp1.responseText.indexOf('[CONGP]')+7;
				var enddomain=xmlhttp1.responseText.indexOf('[ENDCONGP]');
				var domainid=xmlhttp1.responseText.substr(startdomain,enddomain-startdomain);				
				var startdomain1=xmlhttp1.responseText.indexOf('[CONGPDEF]')+10;
				var enddomain1=xmlhttp1.responseText.indexOf('[ENDCONGPDEF]');
				var domainid1=xmlhttp1.responseText.substr(startdomain1,enddomain1-startdomain1);
				var startdomain2=xmlhttp1.responseText.indexOf('[CONGPDIS]')+10;
				var enddomain2=xmlhttp1.responseText.indexOf('[ENDCONGPDIS]');
				var domainid2=xmlhttp1.responseText.substr(startdomain2,enddomain2-startdomain2);
				if(domainid1=='B')
				{
					if(parseInt(domainid)<=0) 
						{
							document.getElementById('timecard_'+domainid2).value="";
							alert('Công B không còn để dùng');
						}
				}
				else if(domainid1=='A' || domainid1=='HA')
				{
					if(parseInt(domainid)<=0) 
						{
							document.getElementById('timecard_'+domainid2).value="";
							if(domainid1=='HA')
								alert('Công HA không còn để dùng');
							else
								alert('Công A không còn để dùng');
						}
				}
				else
				{
				}
				//document.getElementById('txtlv911').value=domainid2;
			}
		}
		function deltime(vEmployeeID,vDate,vTime,vid)
{
	ChangeCompanyID(vEmployeeID,vDate,vTime,vid,1);
}
function overtime(vEmployeeID,vDate,vTime,vid)
{
	ChangeCompanyID(vEmployeeID,vDate,vTime,vid,2);
}
function undeltime(vEmployeeID,vDate,vTime,vid)
{
	ChangeCompanyID(vEmployeeID,vDate,vTime,vid,0);
}
function addtime(vEmployeeID,vDate,vid,oj)
{
	vTime=oj.value;
	if(vTime=='' || vTime=='0' || vTime=='00' || vTime=='00:' || vTime=='00:0' || vTime=='00:00' || vTime=='00:00:' || vTime=='00:00:0' || vTime=='00:00:00')
	return;
	closetimeadd(vid);
	var o=document.getElementById('txttimeadd_'+vid);
	o.value="00:00";
	ChangeCompanyID(vEmployeeID,vDate,vTime,vid,3);
}
function showtimeadd(id)
{
	var o=document.getElementById('timeadd_'+id);
	o.style.display="block";
}
function closetimeadd(id)
{
	var o=document.getElementById('timeadd_'+id);
	o.style.display="none";
}
function ChangeCompanyID(vEmployeeID,vDate,vTime,vid,vopt)
{
	$xmlhttp222=null;
	
	xmlhttp222=GetXmlHttpObject();
	if (xmlhttp222==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajax222=ajaxcheck"+"&vEmployeeID="+vEmployeeID+'&vDate='+vDate+'&vTime='+vTime+'&vid='+vid+'&vopt='+vopt;
	url=url.replace("#","");
	xmlhttp222.onreadystatechange=stateChanged222;
	xmlhttp222.open("GET",url,true);
	
	xmlhttp222.send(null);
}
function stateChanged222()
{
	if (xmlhttp222.readyState==4)
	{
		var startdomain=xmlhttp222.responseText.indexOf('[CHECK]')+7;
		var enddomain=xmlhttp222.responseText.indexOf('[ENDCHECK]');
		var domainid=xmlhttp222.responseText.substr(startdomain,enddomain-startdomain);
		var startdomain=xmlhttp222.responseText.indexOf('[CHECKID]')+9;
		var enddomain=xmlhttp222.responseText.indexOf('[ENDCHECKID]');
		var divid=xmlhttp222.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById(divid).innerHTML=domainid;
	}
}
		function GetXmlHttpObject()
		{
			if (window.XMLHttpRequest)
			{
			  // code for IE7+, Firefox, Chrome, Opera, Safari
				return new XMLHttpRequest();
			}
			if (window.ActiveXObject)
			{
			  // code for IE6, IE5
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			return null;
		}
</script>
</html>