<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/cr_lv0218.php");
require_once("../clsall/cr_lv0086.php");
require_once("../clsall/rp_lv0011.php");
require_once("../clsall/tc_lv0009.php");
require_once("../clsall/tc_lv0013.php");
require_once("../clsall/cr_lv0211.php");



$morp_lv0011=new rp_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0218');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0218');
$mocr_lv0086=new cr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0218');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$mocr_lv0211=new cr_lv0211($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$morp_lv0011->mocr_lv0211=$mocr_lv0211;
/////////////init object//////////////
$mocr_lv0218=new cr_lv0218($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0218');
if($mocr_lv0218->GetView()==1)
{
	if(isset($_GET['ajaxtralaitk']))
	{
		$strchk=$_GET["CodeId"];
		$strar="'".$strchk."'";
		$vresult=$mocr_lv0086->LV_UnAprovalMore($strar);
		exit();
	}
	if(isset($_GET['ajaxduyettk']))
	{
		$strchk=$_GET["CodeId"];
		$strar="'".$strchk."'";
		$vresult=$mocr_lv0086->LV_AprovalDuyetThamKhao($strar);
		exit();
	}
	if(isset($_GET['ajaxchitiethistory']))
	{
		require_once("$vDir../clsall/cr_lv0372.php");
		$mocr_lv0372=new cr_lv0372($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0218');
		if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","SL0317.txt",$plang);
		$mocr_lv0372->lang=strtoupper($plang);
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$mocr_lv0372->ArrPush[0]=$vLangArr[17];
		$mocr_lv0372->ArrPush[1]=$vLangArr[18];
		$mocr_lv0372->ArrPush[2]=$vLangArr[19];
		$mocr_lv0372->ArrPush[3]=$vLangArr[20];
		$mocr_lv0372->ArrPush[4]='Trạng thái';
		$mocr_lv0372->ArrPush[5]='Người duyệt/không duyệt';
		$mocr_lv0372->ArrPush[6]='Ngày giờ';
		$mocr_lv0372->ArrPush[7]=$vLangArr[24];
		$mocr_lv0372->ArrPush[8]=$vLangArr[25];
		$mocr_lv0372->ArrPush[10]='Ghi chú';

		$vhopdongid=$_GET['hopdongid'];
		//$mosl_lv0014->LV_LoadID($vhopdongid);
		echo '[HDCHECKID]';
		echo $vhopdongid;
		echo '[HDCHECKIDEND]';
		echo '[HDCHECKINFO]';
		$mocr_lv0372->lv002=$vhopdongid;
		$mocr_lv0372->lv007='';
		$curRow=0;
		$maxRows=11111111111;
		$mocr_lv0372->DefaultFieldList="lv004,lv003,lv005,lv009";
		echo $mocr_lv0372->LV_BuilListReport_Short($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);
		echo '[HDCHECKINFOEND]';
		exit();
	}
}
if($mocr_lv0086->GetApr()==1)
{
	
	if(isset($_GET['ajaxbangtextchild']))
	{
		require_once("../clsall/cr_lv0090.php");
		$mocr_lv0090=new cr_lv0090($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0090');
		$vDieuKien='';
		//if($mocr_lv0090->GetApr()==0 || $mocr_lv0090->GetUnApr()==0)
		{
			$vdonhangid=$_GET['donhangid'];
			$vText=$_GET['textup'];
			$voption=$_GET['optrun'];
			if($vdonhangid!='' && $vdonhangid!=NULL)
			{
				$vlvField='lv'.Fillnum($voption,3);
				switch($voption)
				{
					case 6:
						$vsql="update cr_lv0090 set $vlvField='$vText',lv007=now(),lv010='$mocr_lv0090->LV_UserID' where lv001='$vdonhangid'   and lv009<=2 $vDieuKien";
						$vresult=db_query($vsql);
						break;
					case 9:
						$vsql="update cr_lv0090 set $vlvField='$vText',lv007=now(),lv010='$mocr_lv0090->LV_UserID' where lv001='$vdonhangid'  and lv009<=2 $vDieuKien";
						$vresult=db_query($vsql);
						break;
				}
			}
		}
		exit;
	}
	if(isset($_GET['ajaxbangtext']))
	{
		$vdonhangid=$_GET['donhangid'];
		$vText=$_GET['textup'];
		$vText=str_replace('$$$','+',$vText);
		$voption=$_GET['optrun'];
		if($vdonhangid!='' && $vdonhangid!=NULL)
		{
			$vUserID=$mocr_lv0086->LV_UserID;
			$vlvField='lv'.Fillnum($voption,3);
			switch($voption)
			{
				case 12:
					if($plang=='') $plang='VN';
					$vDate=recoverdate(substr($vText,0,10),$plang);
					$vTime=substr($vText,11,8);
					$vsql="update cr_lv0005 set $vlvField=concat('$vDate',' ','$vTime') where lv001='$vdonhangid' and lv011=1 and lv027<2";
					break;
				case 15:
				case 16:
				case 26:			
					$vsql="update cr_lv0005 set $vlvField='$vText' where lv001='$vdonhangid' and lv011=1 and lv027<2";
					break;
			}
			$vresult=db_query($vsql);

		}
		exit;
	}
	if(isset($_GET['ajaxworkload']))
	{
		$vhopdongid=$_GET['hopdongid'];
		require_once("$vDir../clsall/cr_lv0091.php");
		$mocr_lv0091=new cr_lv0091($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0090');
		$vLangArr11=GetLangFile("$vDir../","SL0004.txt",$plang);

		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$mocr_lv0091->ArrPush[0]=$vLangArr11[17];
		$mocr_lv0091->ArrPush[1]=$vLangArr11[18];
		$mocr_lv0091->ArrPush[2]=$vLangArr11[20];
		$mocr_lv0091->ArrPush[3]=$vLangArr11[21];
		$mocr_lv0091->ArrPush[4]=$vLangArr11[22];
		$mocr_lv0091->ArrPush[5]=$vLangArr11[23];
		$mocr_lv0091->ArrPush[6]=$vLangArr11[24];
		$mocr_lv0091->ArrPush[7]=$vLangArr11[25];
		$mocr_lv0091->ArrPush[8]=$vLangArr11[26];
		$mocr_lv0091->ArrPush[9]=$vLangArr11[27];
		$mocr_lv0091->ArrPush[10]=$vLangArr11[28];
		$mocr_lv0091->ArrPush[11]=$vLangArr11[29];

		$mocr_lv0091->ArrFunc[0]='//Function';
		$mocr_lv0091->ArrFunc[1]=$vLangArr11[2];
		$mocr_lv0091->ArrFunc[2]=$vLangArr11[4];
		$mocr_lv0091->ArrFunc[3]=$vLangArr11[6];
		$mocr_lv0091->ArrFunc[4]=$vLangArr11[7];
		$mocr_lv0091->ArrFunc[5]='';
		$mocr_lv0091->ArrFunc[6]='';
		$mocr_lv0091->ArrFunc[7]='';
		$mocr_lv0091->ArrFunc[8]=$vLangArr11[10];
		$mocr_lv0091->ArrFunc[9]=$vLangArr11[12];
		$mocr_lv0091->ArrFunc[10]=$vLangArr11[0];
		$mocr_lv0091->ArrFunc[11]=$vLangArr11[32];
		$mocr_lv0091->ArrFunc[12]=$vLangArr11[33];
		$mocr_lv0091->ArrFunc[13]=$vLangArr11[34];
		$mocr_lv0091->ArrFunc[14]=$vLangArr11[35];
		$mocr_lv0091->ArrFunc[15]=$vLangArr11[36];
		$mocr_lv0091->JobID=$vhopdongid;
		$curRow=0;
		$maxRows=11111111111;
		$mocr_lv0091->DefaultFieldList="lv005,lv003,lv004,lv009,lv010";
		if($mocr_lv0091->GetApr()<>1 || $mocr_lv0091->GetUnApr()<>1)
		{
			if($mocr_lv0091->GetApr()==1)
			{
				$mocr_lv0091->ListStaff=$mocr_lv0091->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
			}
		}
		$vFieldList='lv005,lv003,lv004,lv009,lv010';
		$vNoiDung1=$mocr_lv0091->LV_BuilListReport_Short($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);
		


		require_once("$vDir../clsall/cr_lv0090.php");
		$mocr_lv0090=new cr_lv0090($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0090');
		if($plang=="") $plang="VN";
		$vLangArr=GetLangFile("$vDir../","CR0086.txt",$plang);
		$mocr_lv0005->lang=strtoupper($plang);
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$mocr_lv0090->ArrPush[0]=$vLangArr[17];
		$mocr_lv0090->ArrPush[1]=$vLangArr[18];
		$mocr_lv0090->ArrPush[2]=$vLangArr[19];
		$mocr_lv0090->ArrPush[3]=$vLangArr[20];
		$mocr_lv0090->ArrPush[4]=$vLangArr[21];
		$mocr_lv0090->ArrPush[5]=$vLangArr[22];
		$mocr_lv0090->ArrPush[6]=$vLangArr[23];
		$mocr_lv0090->ArrPush[7]=$vLangArr[24];
		$mocr_lv0090->ArrPush[8]=$vLangArr[25];
		$mocr_lv0090->ArrPush[9]=$vLangArr[26];
		$mocr_lv0090->ArrPush[10]=$vLangArr[27];
		$mocr_lv0090->ArrPush[11]=$vLangArr[28];
		$mocr_lv0090->ArrPush[12]=$vLangArr[29];
		$mocr_lv0090->ArrPush[13]=$vLangArr[30];
		$mocr_lv0090->ArrPush[14]=$vLangArr[31];
		$mocr_lv0090->ArrPush[15]='Công ty';
		$mocr_lv0090->ArrPush[16]=$vLangArr[33];
		$mocr_lv0090->ArrPush[17]=$vLangArr[34];

		
		//$mosl_lv0014->LV_LoadID($vhopdongid);
		echo '[WKCHECKID]';
		echo $vhopdongid;
		echo '[WKCHECKIDEND]';
		echo '[WKCHECKIDINFO]';
		$mocr_lv0090->JobID=$vhopdongid;
		$curRow=0;
		$maxRows=11111111111;
		$mocr_lv0090->DefaultFieldList="lv005,lv016,lv014,lv003,lv004,lv011,lv012,lv013,lv006,lv009";
		if($mocr_lv0090->GetApr()<>1 || $mocr_lv0090->GetUnApr()<>1)
		{
			if($mocr_lv0090->GetApr()==1)
			{
				$mocr_lv0090->ListStaff=$mocr_lv0090->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
			}
		}
		echo '<strong>1. Bảng công đợi duyệt đính kèm:</strong><br/>';
		if($vNoiDung1!='')
		{
			echo $vNoiDung1;
		}
		else
		{
			echo 'Chưa có.';
		}
		echo '<strong>2. Phản hồi công việc:</strong><br/>';
		$vFieldList='lv005,lv004,lv012,lv013,lv006,lv009';
		$vNoiDung2=$mocr_lv0090->LV_BuilListReport_Short($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);
		if($vNoiDung2!='')
		{
			echo $vNoiDung2;
		}
		else
		{
			echo 'Chưa có.';
		}
		echo '[WKCHECKIDINFOEND]';
		exit();
	}
}
if($mocr_lv0086->GetApr()==1)
{
	$flagID = (int)($_POST["txtFlag"] ?? 0);
	if($flagID==3)
	{
		$strchk=$_POST["txtStringID"];
		$strar="'".$strchk."'";
		$vresult=$mocr_lv0086->LV_Aproval($strar);
	}
	if($flagID==13)
	{
		$strchk=$_POST["txtStringID"];
		$strar="'".$strchk."'";
		$vresult=$mocr_lv0086->LV_AprovalDuyetThamKhao($strar);
	}
	if($flagID==4)
	{
		$strchk=$_POST["txtStringID"];
		$strar="'".$strchk."'";
		$vresult=$mocr_lv0086->LV_UnAprovalMore($strar);
	}
	
}
if($mocr_lv0218->GetApr()==1)
{
	if(isset($_GET['ajaxmonth']))
	{
		$month=$_GET['month'];
		$year=$_GET['year'];
		$opt=(int)$_GET['choose'];
		$motc_lv0009->lvNVID=$_GET['EmpID'];
		$vDate=$year."-".Fillnum($month,2)."-01";
		$motc_lv0009->LV_AprovalAprUnp($year,$month,$vDate,$opt);
		exit();		
	}
	
}
if($morp_lv0011->GetView()==1)
{
	if(isset($_GET['ajaxchitietload']))
	{
		require_once("../clsall/jo_lv0004.php");
		$plang='VN';
		/////////////init object//////////////
		$mojo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Cr0218');
		$vLangArr=GetLangFile("../","JO0005.txt",$plang);
		$mojo_lv0004->lang=strtoupper($plang);
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$mojo_lv0004->ArrPush[0]=$vLangArr[17];
		$mojo_lv0004->ArrPush[1]=$vLangArr[18];
		$mojo_lv0004->ArrPush[2]=$vLangArr[19];
		$mojo_lv0004->ArrPush[3]=$vLangArr[20];
		$mojo_lv0004->ArrPush[4]=$vLangArr[21];
		$mojo_lv0004->ArrPush[5]=$vLangArr[22];
		$mojo_lv0004->ArrPush[6]=$vLangArr[23];
		$mojo_lv0004->ArrPush[7]=$vLangArr[24];
		$mojo_lv0004->ArrPush[8]=$vLangArr[25];
		$mojo_lv0004->ArrPush[9]=$vLangArr[26];
		$mojo_lv0004->ArrPush[10]=$vLangArr[27];
		$mojo_lv0004->ArrPush[11]=$vLangArr[28];
		$mojo_lv0004->ArrPush[12]=$vLangArr[29];
		$mojo_lv0004->ArrPush[13]=$vLangArr[30];
		$mojo_lv0004->ArrPush[14]=$vLangArr[31];
		$mojo_lv0004->ArrPush[15]=$vLangArr[32];
		$mojo_lv0004->ArrPush[16]=$vLangArr[33];
		$mojo_lv0004->ArrPush[17]=$vLangArr[34];
		$mojo_lv0004->ArrPush[18]=$vLangArr[35];
		$mojo_lv0004->ArrPush[19]=$vLangArr[36];
		$mojo_lv0004->ArrPush[20]=$vLangArr[37];
		$mojo_lv0004->ArrPush[21]=$vLangArr[38];
		$mojo_lv0004->ArrPush[22]=$vLangArr[39];
		$mojo_lv0004->ArrPush[23]=$vLangArr[40];
		$mojo_lv0004->ArrPush[24]=$vLangArr[41];
		$mojo_lv0004->ArrPush[26]='Ngày tạo đơn';
		$mojo_lv0004->ArrPush[100]='Tên';
		$mojo_lv0004->ArrPush[99]='Số ngày';
		$mojo_lv0004->ArrPush[830]='Phòng ban';
		

		$CodeId=$_GET['CodeId'];
		//$mosl_lv0014->LV_LoadID($vhopdongid);
		echo '[HDCHECKID]';
		echo $CodeId;
		echo '[HDCHECKIDEND]';
		echo '[HDCHECKINFO]';
		$mojo_lv0004->lv015=$_GET['nvid'];
		$mojo_lv0004->NgayXinPhep=$_GET['ngayphep'];
		$curRow=0;
		$maxRows=11111111111;
		$vOrderList='1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18';
		$mojo_lv0004->DefaultFieldList="lv015,lv829,lv003,lv025,lv016,lv017,lv098,lv008,lv013,lv018,lv019,lv021,lv009,lv010";
		$vFieldList="lv015,lv829,lv003,lv025,lv016,lv017,lv098,lv008,lv013,lv018,lv019,lv021,lv009,lv010";
		echo $mojo_lv0004->LV_BuilList7Day($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
		echo '[HDCHECKINFOEND]';
		exit();
	}
}

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$mocr_lv0218->ListStaff='';
$vCalID=$_GET['ThongSoLuong'] ?? '';
if(!isset($_POST['txtNVID']) && $vCalID=='')
{
	$_POST['txtNVID']=$mocr_lv0218->LV_UserID;
}
$mocr_lv0218->NVID=$_POST['txtNVID'];
if($mocr_lv0218->GetApr()<>1 )
{
	$mocr_lv0218->lv013=$mocr_lv0218->LV_UserID;
	if($mocr_lv0218->GetApr()==1)
	{
		
		$mocr_lv0218->ListStaff=$mocr_lv0218->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');

		$mocr_lv0218->lv029ex=$mocr_lv0218->ListStaff;
	}
}


if(!isset($_POST['txtMonthYear']) && $vCalID!='')
{
	$motc_lv0013->LV_LoadID($vCalID);
	$month=Fillnum($motc_lv0013->lv006,2);
	$year=$motc_lv0013->lv007;
	$_POST['txtMonthYear']=$year.'-'.$month;
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
	$_POST['txtDayFrom']=getday($motc_lv0013->lv004);
	$_POST['txtDayTo']=getday($motc_lv0013->lv005);
}
else
{
	$month=getmonth($_POST['txtMonthYear'] ?? '');
	$year=getyear($_POST['txtMonthYear'] ?? '');
	if($month=='' || $month==NULL)
	{
		$vNow=substr($mocr_lv0218->DateCurrent,0,10);
		$month=getmonth($mocr_lv0218->DateCurrent);
		$year=getyear($mocr_lv0218->DateCurrent);
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
	$motc_lv0013->LV_LoadActiveIDMonth($month,$year);
}
$mocr_lv0218->month=$month;
$mocr_lv0218->year=$year;
$mocr_lv0218->txtDayFrom=$_POST['txtDayFrom'] ?? '';
$mocr_lv0218->txtDayTo=$_POST['txtDayTo'] ?? '';
$mocr_lv0218->lv004=$year."-".$month;
if($mocr_lv0218->txtDayFrom=="")
{
	$mocr_lv0218->txtDayFrom=1;
	$mocr_lv0218->datefrom=$year."-".$month."-".Fillnum($mocr_lv0218->txtDayFrom,2);
}
else
	$mocr_lv0218->datefrom=$year."-".$month."-".Fillnum($mocr_lv0218->txtDayFrom,2);
//$motc_lv0041->datefrom=$year."-".$month."-01";	
if($mocr_lv0218->txtDayTo=="")
{
	$mocr_lv0218->txtDayTo=getday($mocr_lv0218->DateCurrent);
	$mocr_lv0218->dateto=substr($mocr_lv0218->DateCurrent,0,10);
}
else
	$mocr_lv0218->dateto=$year."-".$month."-".Fillnum($mocr_lv0218->txtDayTo,2);

//$mocr_lv0218->DateFrom=recoverdate($_POST['txtDateFrom'],$plang);
//$mocr_lv0218->DateTo=recoverdate($_POST['txtDateTo'],$plang);


$mocr_lv0218->DepID=$_POST['txtDepID'] ?? '';


require_once("../clsall/hr_lv0020.php");
require_once("../clsall/tc_lv0002.php");
require_once("../clsall/tc_lv0004.php");
require_once("../clsall/jo_lv0004.php");
require_once("../clsall/hr_lv0038.php");
require_once("../clsall/tc_lv0020.php");
require_once("../clsall/hr_lv0002.php");
require_once("../clsall/tc_lv0013.php");
/////////////init object//////////////

$mojo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
$mohr_lv0002=new hr_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0002');
$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$morp_lv0011->ArrDep=$mohr_lv0002->LV_LoadArray();
$morp_lv0011->ArrShift=$motc_lv0004->LV_LoadArray();
$morp_lv0011->motc_lv0020=$motc_lv0020;
$morp_lv0011->mohr_lv0038=$mohr_lv0038;
$morp_lv0011->motc_lv0013=$motc_lv0013;
if($plang=="") $plang="VN";
/*	$vLangArr=GetLangFile("../","TC0052.txt",$plang);
$morp_lv0011->DonXinPhep=$mojo_lv0004;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0011->mohr_lv0038=$mohr_lv0038;
$morp_lv0011->ArrPush[0]=$vLangArr[17];
$morp_lv0011->ArrPush[1]=$vLangArr[18];
$morp_lv0011->ArrPush[2]=$vLangArr[20];
$morp_lv0011->ArrPush[3]=$vLangArr[21];
$morp_lv0011->ArrPush[4]=$vLangArr[22];
$morp_lv0011->ArrPush[5]=$vLangArr[23];
$morp_lv0011->ArrPush[6]=$vLangArr[24];
$morp_lv0011->ArrPush[7]=$vLangArr[25];
$morp_lv0011->ArrPush[8]=$vLangArr[26];
$morp_lv0011->ArrPush[9]=$vLangArr[27];
$morp_lv0011->ArrPush[10]=$vLangArr[28];
$morp_lv0011->ArrPush[11]=$vLangArr[29];
$morp_lv0011->ArrPush[12]=$vLangArr[37];
$morp_lv0011->ArrPush[13]=$vLangArr[48];
$morp_lv0011->ArrPush[14]=$vLangArr[43];
$morp_lv0011->ArrPush[15]=$vLangArr[41];*/
$morp_lv0011->ArrPush[16]='Tên nhân viên';//$vLangArr[42];
//////Delete message///

//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0011->lv028='0,1,4,5,6';
$morp_lv0011->lv029=$mocr_lv0218->DepID;
//if($morp_lv0011->GetApr()==0)	$morp_lv0011->lv029_=$morp_lv0011->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
$morp_lv0011->lv030=trim($mocr_lv0218->NVID);
$morp_lv0011->lv007=trim($_GET['txtlv006']);
$morp_lv0011->isCongViec=$_POST['isCongViec'];
if($morp_lv0011->isCongViec==1)
$morp_lv0011->paratimecard='69';
else
$morp_lv0011->paratimecard='4,6,20,31,8,9,10';
$morp_lv0011->lvState=(int)($_GET['txtlv021']);
$morp_lv0011->lvSort=(int)($_GET['txtlv022']);
$morp_lv0011->isStaffOff=$_GET['isStaffOff'];
$morp_lv0011->isChildCheck=1;
$vShowDept=$_GET['ShowDept'];
$vlv221=24;
if($vlv221==2) $morp_lv0011->isType=1;
$vlv222=(int)$_GET['txtlv222'];
$vlv222=1;
$morp_lv0011->datefrom=$mocr_lv0218->datefrom;
$morp_lv0011->dateto=$mocr_lv0218->dateto;
$year=getyear($morp_lv0011->datefrom);
$month=getmonth($morp_lv0011->datefrom);
$morp_lv0011->month=$month;
$morp_lv0011->year=$year;
$morp_lv0011->motc_lv0013->LV_LoadActiveIDMonth((int)$month,$year);
$flagID = isset($_POST["txtFlag"]) ? (int)$_POST["txtFlag"] : 0;
$morp_lv0011->isLuuCV=false;
if($flagID==16)
{
	$vresult=$motc_lv0009->LV_UpdateKhoaCong($month,$year);
}
elseif($flagID==17)
{
	$vresult=$motc_lv0009->LV_UpdateMoKhoaCong($month,$year);
}
elseif($flagID==26)
{
	$morp_lv0011->isLuuCV=true;
}
//$morp_lv0011->datefrom=$year."-".Fillnum($month,2)."-01";
//$morp_lv0011->dateto=$year."-".Fillnum($month,2)."-".GetDayInMonth($year,$month);
if($_POST['txtNVID']!="") $mohr_lv0020->LV_LoadID($_POST['txtNVID']);
?>
<script language="JavaScript" type="text/javascript">
<!--
function UnApprovalsThamKhao(CodeId)
{
	if(confirm('Bạn có muốn trả lại bảng công không?(Y/N)'))
	{
		/*var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=13;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();*/
		$xmlhttp99=null;
		if(CodeId=="") 
		{
		//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
		return false;
		}
		xmlhttp99=GetXmlHttpObject();
		if (xmlhttp99==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		//var url='<?php echo $vLinkWeb;?>';
		var url=document.location;
		url=''+url;			
		var n = url.indexOf("?"); 
		if(n<0)
			url=url+"?&ajaxtralaitk=ajaxcheck"+"&CodeId="+CodeId;
		else
			url=url+"&ajaxtralaitk=ajaxcheck"+"&CodeId="+CodeId;
		url=url.replace("#","");
		xmlhttp99.onreadystatechange=stateChanged999;
		xmlhttp99.open("GET",url,true);
		xmlhttp99.send(null);
	}
}
function ApprovalsThamKhao(CodeId)
{
	if(confirm('Bạn có muốn duyệt tham khảo bảng công không?(Y/N)'))
	{
		/*var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=13;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();*/
		$xmlhttp99=null;
		if(CodeId=="") 
		{
		//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
		return false;
		}
		xmlhttp99=GetXmlHttpObject();
		if (xmlhttp99==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		//var url='<?php echo $vLinkWeb;?>';
		var url=document.location;
		url=''+url;			
		var n = url.indexOf("?"); 
		if(n<0)
			url=url+"?&ajaxduyettk=ajaxcheck"+"&CodeId="+CodeId;
		else
			url=url+"&ajaxduyettk=ajaxcheck"+"&CodeId="+CodeId;
		url=url.replace("#","");
		xmlhttp99.onreadystatechange=stateChanged999;
		xmlhttp99.open("GET",url,true);
		xmlhttp99.send(null);
	}
}
function stateChanged999()
{
	if (xmlhttp99.readyState==4)
	{

	}
}
function Approvals(vValue)
{
	if(confirm('Bạn có muốn duyệt bảng công không?(Y/N)'))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=3;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
}
function UnApprovals(vValue)
{
	if(confirm('Bạn có muốn trả lại bảng công không?(Y/N)'))
	{
		var o=document.frmchoose;
		o.txtStringID.value=vValue;
		o.txtFlag.value=4;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
		o.submit();
	}
}
function showDetailBBCV(id,CodeId,nvid,ngayphep)
{
	var o=document.getElementById(id);	
	o.style.display="block";
}
function  showDetailHD(id,CodeId,nvid,ngayphep)
{
	var o=document.getElementById(id);	
	o.style.display="block";
	$xmlhttp12=null;
	if(CodeId=="") 
	{
	//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
	return false;
	}
	xmlhttp12=GetXmlHttpObject();
	if (xmlhttp12==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	//var url='<?php echo $vLinkWeb;?>';
	var url=document.location;
	url=''+url;			
	var n = url.indexOf("?"); 
	if(n<0)
		url=url+"?&ajaxchitietload=ajaxcheck"+"&CodeId="+CodeId+"&nvid="+nvid+"&ngayphep="+ngayphep;
	else
		url=url+"&ajaxchitietload=ajaxcheck"+"&CodeId="+CodeId+"&nvid="+nvid+"&ngayphep="+ngayphep;
	url=url.replace("#","");
	xmlhttp12.onreadystatechange=stateChanged122;
	xmlhttp12.open("GET",url,true);
	xmlhttp12.send(null);
}
function stateChanged122()
{
	fcus=false;
	if (xmlhttp12.readyState==4)
	{
		//ID
		var startdomain=xmlhttp12.responseText.indexOf('[HDCHECKID]')+11;
		var enddomain=xmlhttp12.responseText.indexOf('[HDCHECKIDEND]');
		var memberid=xmlhttp12.responseText.substr(startdomain,enddomain-startdomain);
		//Họ tên
		var startdomain=xmlhttp12.responseText.indexOf('[HDCHECKINFO]')+13;
		var enddomain=xmlhttp12.responseText.indexOf('[HDCHECKINFOEND]');
		var noidung=xmlhttp12.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('chitietnoidung_'+memberid).innerHTML=noidung;
		
	}
}
function Show_CC_Title(Stt)
{
	if(document.getElementById('CC_Title_'+Stt).innerHTML=='')
	{
		document.getElementById('CC_Title_'+Stt).innerHTML=document.getElementById('CC_Title').innerHTML;
		document.getElementById('CCC_Title_'+Stt).innerHTML=document.getElementById('CCC_Title').innerHTML;
	}
	else
	{
		document.getElementById('CC_Title_'+Stt).innerHTML='';
		document.getElementById('CCC_Title_'+Stt).innerHTML='';
	}
	
}
function UpdateMonthly(o,vEmpID,year,month,vopt)
{
	if(confirm('Bạn có muốn '+((vopt==1)?'khoá công':'mở công')+' không?'))
	{
		$xmlhttp=null;
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		if(o.value=='Khóa công')
			o.value='Mở khoá';
		else
			o.value='Khóa công';
		var url=document.location;
		url=''+url;			
		var n = url.indexOf("?"); 
		if(n<0)
			url=url+"?&ajaxmonth=month"+"&year="+year+"&month="+month+"&choose="+vopt+"&EmpID="+vEmpID;
		else
			url=url+"&ajaxmonth=month"+"&year="+year+"&month="+month+"&choose="+vopt+"&EmpID="+vEmpID;
		url=url.replace("#","");
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
}
function stateChanged()
{
	if (xmlhttp.readyState==4)
	{

	}
}
function UpdateText(o,donhangid,option)
{
		$xmlhttp555=null;		
		xmlhttp555=GetXmlHttpObject();
		if (xmlhttp555==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		var value=o.value;
		url=url+"&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+value+"&optrun="+option;
		url=url.replace("#","");
		xmlhttp555.onreadystatechange=stateactivebangtext;
		xmlhttp555.open("GET",url,true);
		xmlhttp555.send(null);	
}	
function UpdateTextCheck(o,donhangid,option)
{
		$xmlhttp555=null;		
		xmlhttp555=GetXmlHttpObject();
		if (xmlhttp555==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url=document.location;
		var value=(o.checked)?1:0;
		url=url+"&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+value+"&optrun="+option;
		url=url.replace("#","");
		xmlhttp555.onreadystatechange=stateactivebangtext;
		xmlhttp555.open("GET",url,true);
		xmlhttp555.send(null);	
}	
function stateactivebangtext()
{
}
function  showDetailHistory(id,hopdongid)
{
	
	var o=document.getElementById(id);	
	o.style.display="block";
	$xmlhttp112=null;
	if(hopdongid=="") 
	{
	//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
	return false;
	}
	xmlhttp112=GetXmlHttpObject();
	if (xmlhttp112==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajaxchitiethistory=ajaxcheck"+"&hopdongid="+hopdongid;
	url=url.replace("#","");
	xmlhttp112.onreadystatechange=stateshowDetailHistory;
	xmlhttp112.open("GET",url,true);
	xmlhttp112.send(null);
}
function stateshowDetailHistory()
{
	fcus=false;
	if (xmlhttp112.readyState==4)
	{
		//ID
		var startdomain=xmlhttp112.responseText.indexOf('[HDCHECKID]')+11;
		var enddomain=xmlhttp112.responseText.indexOf('[HDCHECKIDEND]');
		var memberid=xmlhttp112.responseText.substr(startdomain,enddomain-startdomain);
		//Họ tên
		var startdomain=xmlhttp112.responseText.indexOf('[HDCHECKINFO]')+13;
		var enddomain=xmlhttp112.responseText.indexOf('[HDCHECKINFOEND]');
		var noidung=xmlhttp112.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('chitietlichsu_'+memberid).innerHTML=noidung;
		
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
function Save()
{
	ChangeInfor();
}
function ChangeInfor()
{
	{
		var o1=document.frmchoose;
		o1.submit();
	}
}		
function RunDisableAll(cur)
{
	return;
	var o=document.getElementById("curTabView");
	o.value=cur;
	for(var js=0;js<=1;js++)
	{
		var o1=document.getElementById("cl_"+js+"_1");
		var h1=document.getElementById("cl_"+js+"_2");
		var o3=document.getElementById("hrtab_"+js);
		var if1=document.getElementById("cl_"+js+"_3");
		if(cur==js)
		{
			if(o1!=null) 
			{
				o1.style.display="block";
				if(if1!=null) if1.src=h1.value;
			}
			if(o3!=null) o3.className="curshow";
			
		}
		else
		{
			if(o1!=null) o1.style.display="none";
			if(o3!=null) o3.className="cssTab";
		}
	}	
}
function jobshow(cur)
{
	for(var js=0;js<=1;js++)
	{
		var o1=document.getElementById("job_"+js);
		
		if(cur==js)
		{
			if(o1!=null) o1.style.display="block";
			
		}
		else
		{
			if(o1!=null) o1.style.display="none";
			
		}
	}	
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
function ChangeTimeCard(o)
{
	var o1=document.frmchoose;
 	o1.submit(); 
}
function SaveCongViec()
{
	if(confirm("Bạn muốn khoá toàn bộ công trong tháng này không Y/N?"))
	{
		var o=document.frmchoose;
		o.txtFlag.value=26;
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
function showBC(id)
{
	var o=document.getElementById('BCCV_'+id);	
	o.style.display="block";
}
function  showDetailHD1(id,hopdongid)
{
	var o=document.getElementById(id);	
	o.style.display="block";
	$xmlhttp12=null;
	if(hopdongid=="") 
	{
	//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
	return false;
	}
	xmlhttp12=GetXmlHttpObject();
	if (xmlhttp12==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajaxworkload=ajaxcheck"+"&hopdongid="+hopdongid;
	url=url.replace("#","");
	xmlhttp12.onreadystatechange=stateChanged90;
	xmlhttp12.open("GET",url,true);
	xmlhttp12.send(null);
}
function stateChanged90()
{
	fcus=false;
	if (xmlhttp12.readyState==4)
	{
		//ID
		var startdomain=xmlhttp12.responseText.indexOf('[WKCHECKID]')+11;
		var enddomain=xmlhttp12.responseText.indexOf('[WKCHECKIDEND]');
		var memberid=xmlhttp12.responseText.substr(startdomain,enddomain-startdomain);
		//Họ tên
		var startdomain=xmlhttp12.responseText.indexOf('[WKCHECKIDINFO]')+15;
		var enddomain=xmlhttp12.responseText.indexOf('[WKCHECKIDINFOEND]');
		var noidung=xmlhttp12.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('chitietnoidung_'+memberid).innerHTML=noidung;
		
	}
}
function UpdateTextChild(o,donhangid,option)
	{
			$xmlhttp552=null;		
			xmlhttp552=GetXmlHttpObject();
			if (xmlhttp552==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			var value=o.value;
			url=url+"&ajaxbangtextchild=ajaxcheck"+"&donhangid="+donhangid+"&textup="+value+"&optrun="+option;
			url=url.replace("#","");
			xmlhttp552.onreadystatechange=stateactivebangtextchild;
			xmlhttp552.open("GET",url,true);
			xmlhttp552.send(null);	
	}
	function stateactivebangtextchild()
	{

	}
//-->
</script>
<?php

if($mocr_lv0218->GetView()==1)
{
?>
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				
					<div><div id="lvleft">
					<form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					<input type="hidden" name="month" id="month" value="<?php echo $month;?>"/>
					<input type="hidden" name="year" id="year" value="<?php echo $year;?>"/>
					<input id="curTabView" name="curTabView" type="hidden" value="<?php echo $_POST['curTabView'];?>"/> 
					<input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
					<!--<table border="0" width="100%">
							<tbody>
								<tr>
									<td align="left" id="TabViewHr">
										<ul class="IdTabViewHr">
											<li><div id="hrtab_0" class="curshow" onclick="RunDisableAll(0)">Báo cáo công việc hàng ngày</div></li>
											<?php
											//if(($mojo_lv0004->LV_UserID!='MP001' && $mojo_lv0004->LV_UserID!='MP002') || $_SESSION['ERPSOFV2RUserID']=='admin')
											{
											?> 
											<li><div id="hrtab_1" class="cssTab" onclick="RunDisableAll(1)">Nhân viên chưa báo cáo</div></li>
											<?php
											}
											?>
									</td>
								</tr>
							</tbody>
						</table>-->
						<div id="cl_0_1">
							<table style="background:#F2F2F2;padding:5px;color:#4D4D4F!important;" border="0" cellpadding="3" cellspacing="3">
							<?php if($mocr_lv0218->GetApr()==1) {?>
							<tr>
								
								<td align="left" valign="top">
									<?php
									if($mocr_lv0086->GetApr()==1)
									{
										$vLangArr11=GetLangFile("$vDir../","CR0007.txt",$plang);
										$mocr_lv0086->lang=strtoupper($plang);
										//////////////////////////////////////////////////////////////////////////////////////////////////////
										$mocr_lv0086->ArrPush[0]=$vLangArr11[17];
										$mocr_lv0086->ArrPush[1]=$vLangArr11[18];
										$mocr_lv0086->ArrPush[2]=$vLangArr11[19];
										$mocr_lv0086->ArrPush[3]=$vLangArr11[20];
										$mocr_lv0086->ArrPush[4]=$vLangArr11[21];
										$mocr_lv0086->ArrPush[5]=$vLangArr11[22];
										$mocr_lv0086->ArrPush[6]=$vLangArr11[23];
										$mocr_lv0086->ArrPush[7]=$vLangArr11[24];
										$mocr_lv0086->ArrPush[8]=$vLangArr11[25];
										$mocr_lv0086->ArrPush[9]=$vLangArr11[26];
										$mocr_lv0086->ArrPush[10]=$vLangArr11[27];
										$mocr_lv0086->ArrPush[11]=$vLangArr11[28];
										$mocr_lv0086->ArrPush[12]=$vLangArr11[29];
										$mocr_lv0086->ArrPush[13]=$vLangArr11[30];
										$mocr_lv0086->ArrPush[14]=$vLangArr11[31];
										$mocr_lv0086->ArrPush[15]=$vLangArr11[32];
										$mocr_lv0086->ArrPush[16]=$vLangArr11[33];
										$mocr_lv0086->ArrPush[17]=$vLangArr11[34];
										$mocr_lv0086->ArrPush[18]=$vLangArr11[35];

										$mocr_lv0086->ArrPush[23]='NV đề xuất';
										$mocr_lv0086->ArrPush[24]='Ngày đề xuất';
										$mocr_lv0086->ArrPush[25]='QLý duyệt';
										$mocr_lv0086->ArrPush[26]='Ngày QL duyệt';

										$mocr_lv0086->ArrPush[27]='Ghi nhận quản lý';
										$mocr_lv0086->ArrPush[28]='Trạng thái duyệt';
										$mocr_lv0086->ArrPush[90]='Mã công văn';
										$mocr_lv0086->ArrPush[100]=$vLangArr11[48];

										$mocr_lv0086->ArrPush[97]=$vLangArr11[49];
										$mocr_lv0086->ArrPush[98]=$vLangArr11[50];
										$mocr_lv0086->ArrPush[99]=$vLangArr11[51];

										$mocr_lv0086->ArrPush[19]=$vLangArr11[43];
										$mocr_lv0086->ArrPush[20]=$vLangArr11[44];
										$mocr_lv0086->ArrPush[21]=$vLangArr11[45];
										$mocr_lv0086->ArrPush[22]=$vLangArr11[46];
										$mocr_lv0086->ArrPush[23]=$vLangArr11[47];
										$mocr_lv0086->ArrPush[200]='Chức năng';

										$mocr_lv0086->ArrFunc[0]='//Function';
										$mocr_lv0086->ArrFunc[1]=$vLangArr11[2];
										$mocr_lv0086->ArrFunc[2]=$vLangArr11[4];
										$mocr_lv0086->ArrFunc[3]=$vLangArr11[6];
										$mocr_lv0086->ArrFunc[4]=$vLangArr11[7];
										$mocr_lv0086->ArrFunc[5]=GetLangExcept('Rpt',$plang);
										$mocr_lv0086->ArrFunc[6]=GetLangExcept('duyet',$plang);
										$mocr_lv0086->ArrFunc[7]=GetLangExcept('tralai',$plang);
										$mocr_lv0086->ArrFunc[8]=$vLangArr11[10];
										$mocr_lv0086->ArrFunc[9]=$vLangArr11[12];
										$mocr_lv0086->ArrFunc[10]=$vLangArr11[0];
										$mocr_lv0086->ArrFunc[11]=$vLangArr11[38];
										$mocr_lv0086->ArrFunc[12]=$vLangArr11[39];
										$mocr_lv0086->ArrFunc[13]=$vLangArr11[40];
										$mocr_lv0086->ArrFunc[14]=$vLangArr11[41];
										$mocr_lv0086->ArrFunc[15]=$vLangArr11[42];
										$mocr_lv0086->lv013='HR';
										$mocr_lv0086->lv014=$motc_lv0013->lv001;
										$mocr_lv0086->DefaultFieldList="lv199,lv015,lv016,lv026,lv006,lv007";	
										$vFieldList="lv199,lv015,lv016,lv026,lv006,lv007";	
										echo $mocr_lv0086->LV_BuilListDuyetCong($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);
									}
									?>
								
							</tr>
						<?php }?>
								<tr>	
								
								<td  height="20px" colspan=3>									
									<table><tr><td>
										<input type="button" id="txtPre" name="txtPre" value="Về trước" onClick="ChangePre()" style="width:60px">
										<select id="txtDayFrom" name="txtDayFrom"  onChange="ChangeInfor()">
												<option value=''><?php echo $vLangArr[51];?></option>
												<?php
												for($i=1;$i<=GetDayInMonth($mocr_lv0218->year,$mocr_lv0218->month);$i++)
												{
													if((int)$mocr_lv0218->txtDayFrom==$i)
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
												for($i=1;$i<=GetDayInMonth($mocr_lv0218->year,$mocr_lv0218->month);$i++)
												{
													if((int)$mocr_lv0218->txtDayTo==$i)
														echo '<option selected="selected" value="'.Fillnum($i,2).'">'.Fillnum($i,2).'</option>';							
													else
														echo '<option value="'.Fillnum($i,2).'">'.Fillnum($i,2).'</option>';							
												}
												?>							
										</select>
										<input  style="width:60px" type="button" id="txtPre" name="txtPre" value="Tiếp" onClick="ChangeNext()"> 
										</td>
											<td nowrap>Nhân viên</td>
											<td  class="spec" style="padding-right:0px;padding-left:0px;min-width:100px;">
												<table cellspacing="0" cellpadding="0" border="0" width="100%">
													<tr>
														<td width="1%" >
															<input type="hidden" id="txtNVID_show" name="txtNVID_show" value=""/>
															<ul id="pop-nav" lang="pop-nav1" onmouseover="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
																<input type="text" autocomplete="off" class="search_img_btn" name="txtNVID_search" id="txtlv015_search" style="width:30px;" 
																onkeyup="LoadSelfNextParentNewSreen(this,'txtNVID','hr_lv0020','lv001','lv001,lv002,lv005','','',1);" 
																onfocus="if(this.value=='') {longterm = document.getElementById('txtNVID');if(longterm.value!='') {this.value=longterm.options[longterm.selectedIndex].text;}};this.select();this.style.width='200px';LoadSelfNextParentNewSreen(this,'txtNVID','hr_lv0020','lv001','lv001,lv002,lv005','','',1);" 
																onfocusout="this.style.width='30px';" tabindex="200">
																<div id="lv_popup" lang="lv_popup1"> </div>						  
																</li>
															</ul>
														</td>
														<td>
														<select onblur="changecompany_change(this.value)" class="norequired" name="txtNVID" id="txtNVID"   tabindex="6"  style="max-width:100px;width:100%" onKeyPress="return CheckKeys(event,7,this)">
															<option value="">Chọn tất cả</option>
															<?php echo $mocr_lv0218->LV_LinkField('lv013',$mocr_lv0218->NVID);?>
														</select>
														</td>
													</tr>
												</table>
											</td>
											<td nowrap>Phòng ban</td>
											<td>
												<select name="txtDepID"  id="txtDepID" value="<?php echo $mocr_lv0218->DepID;?>" tabindex="11"  style="max-width:100px;width:100%" onKeyPress="return CheckKey(event,7)">
												<option value=""></option>
												<?php echo $mocr_lv0218->LV_GetChildDepSelect($mocr_lv0218->lv029ex,$mocr_lv0218->DepID);//LV_LinkField('lv029',$lvhr_lv0020->lv029);?></select>
											</td>
											<td><input  style="width:80px;text-align:center" type="button" value="Tìm kiếm" onclick="ChangeInfor()"/></td>
											<!--
											<td nowrap>Trạng thái</td>
											<td>
												<select onblur="changecompany_change(this.value)" class="norequired" name="txtNVID" id="txtNVID"   tabindex="6"  style="max-width:100px;width:100%" onKeyPress="return CheckKeys(event,7,this)">
													<option value="">Cả hai</option>
													<option value="1" <?php echo ($mocr_lv0218->lv013.''=='1')?'selected="selected"':'';?>>Hoàn thành</option>
													<option value="0" <?php echo ($mocr_lv0218->lv013.''=='0')?'selected="selected"':'';?>>Chưa hoàn thành</option>
													
												</select>
											</td>-->
											<td>
											<input style="width:80px;" type="button" value="Khoá công" onclick="UpdateKhoaCong()"/>
											</td>
											<td>
											<input style="width:100px;" type="button" value="Mở khoá công" onclick="UpdateMoKhoaCong()"/>
											</td>
											<td>
											<input style="width:100px;" type="button" value="Lưu công việc" onclick="SaveCongViec()"/>
											</td>
											<td nowrap>Chỉ thấy BC công việc</td>
											<td><td> <input type="checkbox"  tabindex="8" name="isCongViec" id="isCongViec" value="1" <?php echo ($morp_lv0011->isCongViec==1)?'checked="true"':'';?> onKeyPress="return CheckKey(event,7)" onclick="ChangeInfor()"/></td></td>
												</tr>
											</table>
									</td>
								</tr>
							</table>
							
							<input name="txtStringID" type="hidden" id="txtStringID" />
							<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
							<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
							
											    
<?php 
	echo "<div style='width:600px'>
	<div style='text-align:center'><h1>".(($morp_lv0011->isCongViec==1)?'TỔNG HỢP BÁO CÁO CÔNG VIỆC':'DUYỆT BẢNG CÔNG')."</h1></div>
	<div style='text-align:center'><strong>Từ ngày ".$morp_lv0011->FormatView($morp_lv0011->datefrom,2)." đến ngày ".$morp_lv0011->FormatView($morp_lv0011->dateto,2)."</strong></div>
	<div>&nbsp;</div>
	</div>";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
	echo $morp_lv0011->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt,$vlv221,$vlv222,$sExport);
?>
					 	</div>
						<!--<div id="cl_1_1">
							<input type="hidden" name="cl_1_2" id="cl_1_2" value="home.php?lang=VN&opt=27&item=&link=Y3JfbHYwMjExL2NyX2x2MDIxMS5waHA="/>
							<iframe name="cl_1_3" id="cl_1_3" height=1000 marginheight=0 marginwidth=0 frameborder=0 title="" src="" class=lvframe></iframe>
						</div>	--->
				  </form>
				 
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
</div></div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
setTimeout("setFocusNow()",1000);
function setFocusNow()
{
document.frmchoose.qxtlv001.focus();
}
</script>