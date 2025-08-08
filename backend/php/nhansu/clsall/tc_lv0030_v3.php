<?php
class tc_lv0030 extends lv_controler
{
//Declare string shift
var $ShiftOneDay=null;
var $ShiftTwoDay=null;
var $DonXinPhep=null;
var $NgayNghiLe=null;
var $ArrMonth=null;
var $ArrStaff=null;
protected $objhelp='tc_lv0030';
public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=0;
		$this->isRpt=0;	
		$this->isAdd=0;
		$this->isEdit=0;
		$this->isApr=0;
		$this->isUnApr=0;
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=0;	
		$this->isDel=0;
		$this->lang=$_GET['lang'];
		$this->ShiftOneDay="@";
		$this->ShiftTwoDay="@";
		
	}
	function LV_LamTronGio($vWorkTime)
	{
		return $vWorkTime;
		$vArrTimes=explode(":",$vWorkTime);
		if($vArrTimes[1]<25) 
			$vArrTimes[1]='00';
		elseif($vArrTimes[1]<55) 
			$vArrTimes[1]='00';
		else
		{
			$vArrTimes[0]=Fillnum($vArrTimes[0]+1,2);
			$vArrTimes[1]='00';
		}	
		return Fillnum($vArrTimes[0],2).":".Fillnum($vArrTimes[1],2).":".Fillnum($vArrTimes[2],2);
	}
	function GetMultiValue($sqlS)
	{
		$lv_str="";
		$bResult = db_query($sqlS);
		while ($vrow = db_fetch_array ($bResult)){	
			if($lv_str=="")
				$lv_str=$vrow['lv001'];
			else
				$lv_str=$lv_str."','".$vrow['lv001'];
		}
		$lv_str="'".$lv_str."'";
		return $lv_str;
	}
	function GetEmployees($sqlS)
	{
		$lv_str="";
		$bResult = db_query($sqlS);
		while ($vrow = db_fetch_array ($bResult)){	
		$this->ArrStaff[$vrow['lv001']][0]=true;
		$this->ArrStaff[$vrow['lv001']][29]=$vrow['lv029'];
		$this->ArrStaff[$vrow['lv001']][30]=$vrow['lv030'];
		$this->ArrStaff[$vrow['lv001']][44]=$vrow['lv044'];
			if($lv_str=="")
				$lv_str=$vrow['lv001'];
			else
				$lv_str=$lv_str."','".$vrow['lv001'];
		}
		$lv_str="'".$lv_str."'";
		return $lv_str;
	}
	function LV_GetChildDep($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001 from  hr_lv0002 where lv002 in ($vReturn) order by lv103 asc";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vReturn=$vReturn.",'".$vrow['lv001']."'";
		}
		return $vReturn;
	}
	function LV_GetEmpRun($vDept)
	{
		if($vDept=="")
			return $this->GetEmployees("select DD.lv001,DD.lv029,DD.lv030,DD.lv044 from hr_lv0020 DD where DD.lv009 not in ('2','3')");
		else
			return $this->GetEmployees("select DD.lv001,DD.lv029,DD.lv030,DD.lv044 from hr_lv0020 DD where DD.lv009 not in ('2','3') and DD.lv029 in (".$this->LV_GetChildDep($vDept).")");
	}
	function LV_GetEmpRunListID($vListID)
	{
		return $this->GetEmployees("select DD.lv001,DD.lv029,DD.lv030,DD.lv044 from hr_lv0020 DD where DD.lv001 in ($vListID)");

	}
	function LV_GetMonthly($vYear,$vMonth)
	{
		
		$vsql="select EE.lv002 StaffID,EE.lv100 ShiftCal,EE.lv005 Locks  from  tc_lv0009 EE where EE.lv003='$vMonth' and EE.lv004='$vYear'";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$this->ArrMonth[$vrow['StaffID']][0]=$vrow['Locks'];
			$this->ArrMonth[$vrow['StaffID']][1]=$vrow['ShiftCal'];
		}
	}
	function LV_CheckTCRa($vTimeTo,$vTimeOut)
	{
		if($vTimeTo>$vTimeOut) return $vTimeOut;
		return $vTimeTo;
	}
	function LV_CheckMiddleOffTime($vArrTime,$vMStartTime,$vMEndTime)
	{
		$nMStartTime=str_replace(":","",$vMStartTime);
		$nMEndTime=str_replace(":","",$vMEndTime);

		$vStartTime=$vArrTime[0][0];
		$nStartTime=str_replace(":","",$vStartTime);
		
		$vEndTime=$vArrTime[1][0];
		$nEndTime=str_replace(":","",$vEndTime);
		//Kiem tra gio trua co trong khoang nghi
		//Trong gio va giua gio
		if($nMStartTime>=$nStartTime && $nMEndTime<=$nEndTime)
		{
			return TIMEDIFF($vMEndTime,$vMStartTime);
		}
		elseif($nStartTime>$nMStartTime && $nStartTime<=$nMEndTime)
		{
			return TIMEDIFF($vMEndTime,$vStartTime);
		}
		elseif($nEndTime>$nMStartTime && $nEndTime<=$nMEndTime)
		{
			return TIMEDIFF($vEndTime,$vMStartTime);
		}
		return '00:00:00';

	}
	function LV_CheckTimeOverTime($vArrTime,$vShift,$vTimeToOverTime='17:30:00')
	{
		$vArr17h6h=Array();
		$vArr17h6h[0]='00:00:00';
		$vArr17h6h[1]='00:00:00';
		$vStartTime=$vArrTime[0];
		$nStartTime=str_replace(":","",$vStartTime);
		
		$vEndTime=$vArrTime[1];
		$nEndTime=str_replace(":","",$vEndTime);
		
		$nTimeToOverTime=str_replace(":","",$vTimeToOverTime);
		// Xac dinh gio ra lon hon 17:30 
		if((float)$nEndTime>(float)$nTimeToOverTime)
		{
			if($nEndTime<=220000)
			{
				$vArr17h6h[0]=TIMEDIFF($vEndTime,$vTimeToOverTime);
			}
			else
			{
				$vArr17h6h[0]=TIMEDIFF('22:00:00',$vTimeToOverTime);
				$vArr17h6h[1]=TIMEDIFF($vEndTime,$vStartTime);
			}
		}
		elseif($nEndTime<80000 && $nEndTime<$nStartTime)//Xac dinh gio ra nho hon 08:00 va gio ra nho hon gio vao.
		{
			$vArr17h6h[0]=TIMEDIFF('22:00:00',$vTimeToOverTime);
			$vArr17h6h[1]=TIMEDADD('02:00:00',$vEndTime);
		}
		return $vArr17h6h;
	}
	function LV_LamTronGioLam($vWorkTime,$vGioLam)
	{
		if($this->GetTime($vGioLam)==0) $vGioLam="08:00:00";
		$vArrTimes=explode(":",$vWorkTime);
		if($vArrTimes[0]>0)
			$vWT=$vArrTimes[0]*60+$vArrTimes[1]+1;
		else
			$vWT=((float)$vArrTimes[0])*60+(float)$vArrTimes[1];
		$vArrTimes=explode(":",$vGioLam);
		$vWHD=$vArrTimes[0]*60+$vArrTimes[1];
		if(($vWHD -$vWT)<=6)	
			return $vGioLam;	
		else
			return $vWorkTime;
	}
	function LV_LamTronGioTC($vWorkTime)
	{
		return $vWorkTime;
		$vArrTimes=explode(":",$vWorkTime);
		if($vArrTimes[1]<=29) 
			$vArrTimes[1]='00';
		elseif($vArrTimes[1]<=59) 
			$vArrTimes[1]='30';
		else
		{
			$vArrTimes[0]=Fillnum($vArrTimes[0]+1,2);
			$vArrTimes[1]='00';
		}	
		return Fillnum($vArrTimes[0],2).":".Fillnum($vArrTimes[1],2).":".Fillnum($vArrTimes[2],2);
	}
	function LV_RunAll($vArrDep,$vArrCong,$vArrShift,$vDate,$lineprocess,$vState,$vCheckNT,$vShiftCal=0,$vListEmp='',$vArrPro=NULL)
	{
		
		$vCLEmp=Array();
		$vArrCode=Array(0=>'X',1=>'T',2=>'S',3=>'TT',4=>'V');
		$vListEmp=trim($vListEmp);
		if($vListEmp!="" && $vListEmp!=NULL)
		{
			if(substr($vListEmp,strlen($vListEmp)-1,1)==",")
				$strar=substr($vListEmp,0,strlen($vListEmp)-1);
			else
				$strar=$vListEmp;
			$strar=str_replace(",","','",$strar);
			$vListEmp="'".$strar."'";
			$vListEmp=$this->LV_GetEmpRunListID($vListEmp);
			$vCondition1=" and   B.lv002  in ($vListEmp)";
		}
		else
		{
			 $vListEmp=$this->LV_GetEmpRun($lineprocess);
		}
		$this->DonXinPhep->LV_CheckPhepStateArrMulti($vDate,$vCheckNT,$vListEmp);
		$this->NgayNghiLe->LV_LoadDayIDArr($vDate);
		/*if($vCheckNT==1)
		{
			if($lineprocess=="")
				$sqlS = "SELECT A.lv001 CodeID,A.lv016,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,B.lv002 NVID,C.lv029 lv001,C.lv030 DateWork,D.lv007 Shift,DayOfWeek(A.lv004) DOWS,EE.lv100 ShiftCal,A.lv015,EE.lv005 Locks FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001  left join tc_lv0009 EE on EE.lv002=B.lv002 AND EE.lv003=MONTH('$vDate') and EE.lv004=YEAR('$vDate')  inner join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) WHERE A.lv100=0 AND C.lv009 not in ('2','3') and MONTH(A.lv004)=MONTH('$vDate') and YEAR(A.lv004)=YEAR('$vDate') and   B.lv002  in ($vListEmp)  order by C.lv029 ASC,A.lv004 ASC";
			else
				$sqlS = "SELECT A.lv001 CodeID,A.lv016,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,B.lv002 NVID,C.lv029 lv001,C.lv030 DateWork,D.lv007 Shift,DayOfWeek(A.lv004) DOWS,EE.lv100 ShiftCal,A.lv015,EE.lv005 Locks FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001  left join tc_lv0009 EE on EE.lv002=B.lv002 AND EE.lv003=MONTH('$vDate') and EE.lv004=YEAR('$vDate')  inner join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) WHERE A.lv100=0 AND C.lv009 not in ('2','3') and MONTH(A.lv004)=MONTH('$vDate') and YEAR(A.lv004)=YEAR('$vDate')  and   B.lv002  in ($vListEmp)  order by C.lv029 ASC,A.lv004 ASC";
		}
		else
		{
			if($lineprocess=="")
				$sqlS = "SELECT A.lv001 CodeID,A.lv016,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,B.lv002 NVID,C.lv029 lv001,C.lv030 DateWork,D.lv007 Shift,DayOfWeek(A.lv004) DOWS,EE.lv100 ShiftCal,A.lv015,EE.lv005 Locks FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001  left join tc_lv0009 EE on EE.lv002=B.lv002 AND EE.lv003=MONTH('$vDate') and EE.lv004=YEAR('$vDate')  inner join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) WHERE A.lv100=0 AND C.lv009 not in ('2','3') and A.lv004='$vDate' and   B.lv002  in ($vListEmp) order by C.lv029 ASC,A.lv004 ASC";
			else
				$sqlS = "SELECT A.lv001 CodeID,A.lv016,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,B.lv002 NVID,C.lv029 lv001,C.lv030 DateWork,D.lv007 Shift,DayOfWeek(A.lv004) DOWS,EE.lv100 ShiftCal,A.lv015,EE.lv005 Locks FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001  left join tc_lv0009 EE on EE.lv002=B.lv002 AND EE.lv003=MONTH('$vDate') and EE.lv004=YEAR('$vDate')  inner join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) WHERE A.lv100=0 AND C.lv009 not in ('2','3') and A.lv004='$vDate' and   B.lv002  in ($vListEmp)  order by C.lv029 ASC,A.lv004 ASC";
		}
		*/
		if($vCheckNT==1)
		{
			if($lineprocess=="")
				$sqlS = "SELECT distinct A.lv001 CodeID,A.lv016,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv021 ProjectID,DayOfWeek(A.lv004) DOWS,A.lv015,B.lv002 NVID,C.lv029 lv001,EE.lv005 LockMonth,A.lv089 FixDay,C.lv009 TTNV,C.lv027 NhomCC FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 EE on EE.lv002=B.lv002 and EE.lv003=MONTH('$vDate') and EE.lv004=YEAR('$vDate')  inner join hr_lv0020 C on C.lv001=B.lv002  WHERE A.lv100=0 and MONTH(A.lv004)=MONTH('$vDate') and YEAR(A.lv004)=YEAR('$vDate') and   B.lv002  in ($vListEmp) $vCondition1 order by A.lv099 ASC,A.lv004 ASC";
			else
				$sqlS = "SELECT distinct A.lv001 CodeID,A.lv016,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv021 ProjectID,DayOfWeek(A.lv004) DOWS,A.lv015,B.lv002 NVID,C.lv029 lv001,EE.lv005 LockMonth,A.lv089 FixDay,C.lv009 TTNV,C.lv027 NhomCC FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 EE on EE.lv002=B.lv002 and EE.lv003=MONTH('$vDate') and EE.lv004=YEAR('$vDate')  inner join hr_lv0020 C on C.lv001=B.lv002  WHERE A.lv100=0 and MONTH(A.lv004)=MONTH('$vDate') and YEAR(A.lv004)=YEAR('$vDate') and   B.lv002  in ($vListEmp) $vCondition1  order by A.lv099 ASC,A.lv004 ASC";
		}
		else
		{
			if($lineprocess=="")
				$sqlS = "SELECT distinct A.lv001 CodeID,A.lv016,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv021 ProjectID,DayOfWeek(A.lv004) DOWS,A.lv015,B.lv002 NVID,C.lv029 lv001,EE.lv005 LockMonth,A.lv089 FixDay,C.lv009 TTNV,C.lv027 NhomCC FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 EE on EE.lv002=B.lv002  and EE.lv003=MONTH('$vDate') and EE.lv004=YEAR('$vDate') inner join hr_lv0020 C on C.lv001=B.lv002  WHERE A.lv100=0 and A.lv004='$vDate' and   B.lv002  in ($vListEmp) $vCondition1 order by A.lv099 ASC,A.lv004 ASC";
			else
				$sqlS = "SELECT distinct A.lv001 CodeID,A.lv016,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,A.lv021 ProjectID,DayOfWeek(A.lv004) DOWS,A.lv015,B.lv002 NVID,C.lv029 lv001,EE.lv005 LockMonth,A.lv089 FixDay,C.lv009 TTNV,C.lv027 NhomCC FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 EE on EE.lv002=B.lv002  and EE.lv003=MONTH('$vDate') and EE.lv004=YEAR('$vDate') inner join hr_lv0020 C on C.lv001=B.lv002  WHERE A.lv100=0 and A.lv004='$vDate' and   B.lv002  in ($vListEmp) $vCondition1 order by A.lv099 ASC,A.lv004 ASC";
		}
		$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
		$mohr_lv0038->LV_LoadActiveFullArr($vListEmp);
		//echo $sqlS;
		//return;
		$vAHoliday=Array();
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$vYearCal=getyear($vDate);
		$vMonthCal=getmonth($vDate);
		$this->LV_GetMonthly($vYearCal,$vMonthCal);
		$this->motc_lv0012->LV_GetListTime_Arr($vDate,$vArrShift,$vArrDep[$vrow['lv001']][0],$vListEmp,$vCheckNT);
		while ($vrow = db_fetch_array ($bResult)){
			if($vrow['LockMonth']==1)
			{
				echo $vrow['NVID']." -> Đã khóa tháng này<br/>";
			}
			else
			{
				$isNoTreSom=true;
			$vStatePrj=$vArrDep[$vrow['lv001']][9];
			$vTimeWorkCur1='';
			// $vCount=$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],0);
			//$vTimeNghi=$this->DonXinPhep->TimeNghi;
			$vCheckTru=false;
			if($this->ArrStaff[$vrow['NVID']][0])
			{
			$vrow['Locks']=(int)$this->ArrMonth[$vrow['NVID']][0];
			if($vrow['Locks']==0 )// && $vrow['DOWS']!=1)//&& $vrow['NVID']=='0213')
			{
			$vrow['DateWork']=$this->ArrStaff[$vrow['NVID']][30];
			$vrow['ShiftCal']=$this->ArrMonth[$vrow['NVID']][1];
			if($this->ArrStaff[$vrow['NVID']][44]>'2000-01-01')
				$vrow['DateOff']=$this->ArrStaff[$vrow['NVID']][44];
			else
				$vrow['DateOff']='';
			$this->SQL_Exe1="";
			$this->SQL_Exe="";		
			$this->SQL_Delay="";
			//Lay CL tồn
			/*if($vCLEmp[$vrow['NVID']][0]!=true)
			{
				$vCLEmp[$vrow['NVID']][0]=true;
				$vCLEmp[$vrow['NVID']][1]=$this->motc_lv0008->LV_CheckOne_FNCB($vrow['NVID'],$vYearCal,1,$vMonthCal);
			}
			if($vrow['lv007']!='CL' && $vrow['lv007']!='1/2CL' )
			{
				//echo 'vinh:'.($this->GetTime($vrow['lv016'])/8).'vinh<br/>';
				
				$vCLEmp[$vrow['NVID']][1]=$vCLEmp[$vrow['NVID']][1]+$this->GetTime($vrow['lv016'])/8;
			}*/
			$vReturnTime=Array();
			$vDateCal=$vrow['lv004'];
			$vLongDateCal=(float)str_replace("-","",$vDateCal);
			$vArrTime=Array();
			if($vrow['ProjectID']!="")
			{
				$vCaPro=trim($vArrPro[$vrow['ProjectID']][0]);
				if($vCaPro==NULL) $vCaPro='';
			}
			else
				$vCaPro='';
				$vShiftCal1=0;
				$vTimeNghi='00:00:00';
				$vTimeNghiPhep='00:00:00';
				$vNuaNgay='04:00:00';
				$this->DonXinPhep->Shift='';
				$this->DonXinPhep->TimeCard='';
				//Tính nhiều đơn xin phép có P năm
				$vTimeCardID='';
				$vMaCong2='';
				$vNgayPhepNuaNgay='';
				$vTimeTCTruocGio='00:00:00';
				$vIsTCTruocGio=true;
				$vLan=0;
				$vXinNuaNgay=false;
				$vGioCTS='';
				$vGioCTE='';
				$this->DonXinPhep->TimeCard='';
				while(true)
				{
					$vNgayPhepNuaNgay='';
					$vCount=$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],0,$vLan);
					if($this->DonXinPhep->TimeCard!='QCC')
					{
						switch($this->DonXinPhep->TimeCard)
						{
							case 'CT':
								$vGioCTS=substr($this->DonXinPhep->lv016,11,8);
								$vGioCTE=substr($this->DonXinPhep->lv017,11,8);
								if($this->DonXinPhep->TimeCard!='' && $this->DonXinPhep->TimeCard!=null) $vXinNuaNgay=true;
								$vTimeNghi=$this->DonXinPhep->TimeNghi;
								break;
							case '1/2KL':
							case '1/2P':
								$vXinNuaNgay=true;
								$vNgayPhepNuaNgay=$this->DonXinPhep->lv016;
								break;
							case 'P':
								$vXinNuaNgay=true;
								$vTimeNghiPhep=$this->DonXinPhep->TimeNghi;
								break;
							default:
								if($this->DonXinPhep->TimeCard!='' && $this->DonXinPhep->TimeCard!=null) $vXinNuaNgay=true;
								$vTimeNghi=$this->DonXinPhep->TimeNghi;
								break;
						}
						if($this->DonXinPhep->Shift!='') $vShiftW=$this->DonXinPhep->Shift;
						if($this->DonXinPhep->TimeCard!='' && $this->DonXinPhep->TimeCard!=NULL)
						{
							if($this->DonXinPhep->TimeCard=='1/2KL' || $this->DonXinPhep->TimeCard=='1/2P' || $this->DonXinPhep->TimeCard=='P' )
							{

								if($vTimeCardID=='') 
									$vTimeCardID=$this->DonXinPhep->TimeCard;
								else
								{
									if($vTimeCardID=='1/2P')
									{
										$vMaCong2=$this->DonXinPhep->TimeCard;
									}
									else
									{
										$vMaCong2=$vTimeCardID;
										$vTimeCardID=$this->DonXinPhep->TimeCard;
									}
								}
								//break;
							}
							else
							{
								$vMaCong2=$this->DonXinPhep->TimeCard;
							}
							
						}
						else
						{
							//print_r($vArrTime[0]);
							if($vAHoliday[$vrow['lv004']][0]==1) 
							{
								if(count($vArrTime[0])<2 && $vReturnTime['GioLam']=='00:00:00')		
								{
									if($this->DonXinPhep->TimeCard!='O') {
									$vLong_DateW=(float)str_replace("-","",$vrow['DateWork']);
									if($vrow['DateOff']!='')
									{
										$vLong_DateO=(float)str_replace("-","",$vrow['DateOff']);
										if($vLong_DateW<=$vLongDateCal && $vLong_DateO>=$vLongDateCal) $vTimeCardID=$vAHoliday[$vrow['lv004']][1];
									}
									else
										if($vLong_DateW<=$vLongDateCal) $vTimeCardID=$vAHoliday[$vrow['lv004']][1];
								}
								}	
							}
						}
					}
					else
					{
						if($vMaCong2=='') $vMaCong2=$this->DonXinPhep->TimeCard;
					}
					$vLan++;
					if($vCount<=$vLan)
					{
						break;
					}
				}
				if($vTimeNghi=='')
				{
					$vTimeNghi=$vTimeNghiPhep;
					$vTimeNghiPhep='';
				}
				if($vTimeCardID=='' || $vTimeCardID==NULL) 
				{
					$vTimeCardID=$vMaCong2;
					$vMaCong2='';
				}
				if($vCount>1)
				{
					if($vTimeCardID==$vMaCong2)
						$this->SQL_Exe=$this->SQL_Exe.",lv008=''";	
					else
						$this->SQL_Exe=$this->SQL_Exe.",lv008='".$vMaCong2."'";				
				}
				else
				{
					$this->SQL_Exe=$this->SQL_Exe.",lv008=''";	
				}
				if(substr($vTimeCardID,0,3)=='0.5')
				{
					if(trim($this->DonXinPhep->Shift)!='' && ($this->DonXinPhep->Shift)!=NULL)
					{
						$vShiftCal1=1;
					} 
				}
			//TANG CA DAU GIO
			$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],8);
			$ArDateTime=NULL;
			if($this->DonXinPhep->lv022==8)
			{
				$ArDateFrom=explode(" ",$this->DonXinPhep->lv016);
				$ArDateTime[0]=$ArDateFrom[1];
				$ArDateTo=explode(" ",$this->DonXinPhep->lv017);
				$ArDateTime[1]=$ArDateTo[1];
			}
			if($vShiftCal==0)
			{
				
				if($vrow['ShiftCal']==1 || $vrow['FixDay']==1)
				{
					if($vrow['ProjectID']!='' && $vCaPro!='')
					{
						if($vrow['NhomCC']=='KHO')
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA_Kho($vrow['NVID'],$vDateCal,$vArrShift,$vCaPro,$vrow['lv015'],1);
							if(count($vArrTime[0])<4 && $vXinNuaNgay==false)
							{
								$vReturnTime['GioLam']='00:00:00';
								$vArrTime=null;
							}
							else
								$vReturnTime=$this->ProcessTime($vrow['NVID'],$vArrTime,$vArrShift,1,$vrow['lv015'],$vCaPro);
						}
						else
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA($vrow['NVID'],$vDateCal,$vArrShift,$vCaPro,$vrow['lv015'],1);
							$vReturnTime=$this->ProcessTime($vrow['NVID'],$vArrTime,$vArrShift,1,$vrow['lv015'],$vCaPro);
						}
					}
					else
					{
						if($vrow['NhomCC']=='KHO')
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA_Kho($vrow['NVID'],$vDateCal,$vArrShift,$vArrDep[$vrow['lv001']][0],$vrow['lv015'],1);
							if(count($vArrTime[0])<4 && $vXinNuaNgay==false)
							{
								$vReturnTime['GioLam']='00:00:00';
								$vArrTime=null;
							}
							else
								$vReturnTime=$this->ProcessTime($vrow['NVID'],$vArrTime,$vArrShift,1,$vrow['lv015'],$vArrDep[$vrow['lv001']][0]);
						}
						else
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA($vrow['NVID'],$vDateCal,$vArrShift,$vArrDep[$vrow['lv001']][0],$vrow['lv015'],1);
							$vReturnTime=$this->ProcessTime($vrow['NVID'],$vArrTime,$vArrShift,1,$vrow['lv015'],$vArrDep[$vrow['lv001']][0]);
						}
					}
						
					//$vReturnTime['CaIn']=$vrow['lv015'];
				}
				else
				{
					if($vrow['ProjectID']!='' && $vCaPro!='')
					{
						if($vrow['NhomCC']=='KHO')
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA_Kho($vrow['NVID'],$vDateCal,$vArrShift,$vCaPro,$vrow['lv015']);
							if(count($vArrTime[0])<4 && $vXinNuaNgay==false)
							{
								$vReturnTime['GioLam']='00:00:00';
								$vArrTime=null;
							}
							else
								$vReturnTime=$this->ProcessTime($vrow['NVID'],$vArrTime,$vArrShift,0,$vrow['lv015'],$vCaPro);
						}
						else
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA($vrow['NVID'],$vDateCal,$vArrShift,$vCaPro,$vrow['lv015']);
							$vReturnTime=$this->ProcessTime($vrow['NVID'],$vArrTime,$vArrShift,0,$vrow['lv015'],$vCaPro);
						}
					}
					else
					{
						//echo $vArrDep[$vrow['lv001']][0];
						if($vrow['NhomCC']=='KHO')
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA_Kho($vrow['NVID'],$vDateCal,$vArrShift,$vArrDep[$vrow['lv001']][0],$vrow['lv015']);
							//echo $vDateCal.'==>'.count($vArrTime[0]);
							if(count($vArrTime[0])<4 && $vXinNuaNgay==false)
							{
								$vReturnTime['GioLam']='00:00:00';
								$vArrTime=null;
							}
							else
								$vReturnTime=$this->ProcessTimeKho($vrow['NVID'],$vArrTime,$vArrShift,$vShiftCal,$vrow['lv015'],$vArrDep[$vrow['lv001']][0]);
							//echo '||='.$vReturnTime['GioLam'];
							//echo '<br/>';
						}
						else
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA($vrow['NVID'],$vDateCal,$vArrShift,$vArrDep[$vrow['lv001']][0],$vrow['lv015']);
							$vReturnTime=$this->ProcessTime($vrow['NVID'],$vArrTime,$vArrShift,0,$vrow['lv015'],$vArrDep[$vrow['lv001']][0]);
						}
					}
					
				}	
			}
			else
			{
				if($vrow['ProjectID']!='' && $vCaPro!='')
					{
						if($vrow['NhomCC']=='KHO')
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA_Kho($vrow['NVID'],$vDateCal,$vArrShift,$vCaPro,$vrow['lv015'],1);
							if(count($vArrTime[0])<4 && $vXinNuaNgay==false)
							{
								$vReturnTime['GioLam']='00:00:00';
								$vArrTime=null;
							}
							else
								$vReturnTime=$this->ProcessTime($vrow['NVID'],$vArrTime,$vArrShift,$vShiftCal,$vrow['lv015'],$vCaPro);
						}
						else
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA($vrow['NVID'],$vDateCal,$vArrShift,$vCaPro,$vrow['lv015'],1);
							$vReturnTime=$this->ProcessTime($vrow['NVID'],$vArrTime,$vArrShift,$vShiftCal,$vrow['lv015'],$vCaPro);
						}
						
					}
					else
					{
						//LV_GetListTimeA_Kho
						if($vrow['NhomCC']=='KHO')
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA_Kho($vrow['NVID'],$vDateCal,$vArrShift,$vArrDep[$vrow['lv001']][0],$vrow['lv015'],1);
							if($vArrTime[0]<4  && $vXinNuaNgay==false)
							{
								$vReturnTime['GioLam']='00:00:00';
								$vArrTime=null;
							}
							else
								$vReturnTime=$this->ProcessTimeKho($vrow['NVID'],$vArrTime,$vArrShift,$vShiftCal,$vrow['lv015'],$vArrDep[$vrow['lv001']][0]);
						}
						else
						{
							$vArrTime=$this->motc_lv0012->LV_GetListTimeA($vrow['NVID'],$vDateCal,$vArrShift,$vArrDep[$vrow['lv001']][0],$vrow['lv015'],1);
							$vReturnTime=$this->ProcessTime($vrow['NVID'],$vArrTime,$vArrShift,$vShiftCal,$vrow['lv015'],$vArrDep[$vrow['lv001']][0]);
						}
					}
				
			}
			
			if($this->DonXinPhep->lv022==8)
			{
				if($ArDateTime!=NULL)
				{
					if($ArDateTime[1]>$ArDateTime[0])
					{
						$vIsTC=false;
						$vTimeTC=TIMEDIFF($ArDateTime[1],$ArDateTime[0]);
						$vTimeTC=$this->LV_LamTronGioTC($vTimeTC);
						$vsql=$this->motc_lv0011->LV_UpdateTimeTCEmp($vrow['CodeID'],$vTimeTC,1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
					}
				}
			}
			
			$vTimeShiftCur=$vArrShift[0]['WD-'.$vrow['lv015']][0];	
			$vGioVao=$vReturnTime['GioVao'];
			$vGioRa=$vReturnTime['GioRa'];
			//echo $vDateCal.'->'.$vReturnTime['GioLam'].':<br/>';
			//FreeTimeStart
			 $vRealFreeTime=$this->LV_CheckMiddleOffTime($vArrTime[0],$vReturnTime['FreeTimeStart'],$vReturnTime['FreeTimeEnd']);
			if($vrow['DOWS']==7)
			{
				if($vrow['NhomCC']=='KHO')
				{
					if($vReturnTime['GioLam']>='06:55:00' )
					{
						$vReturnTime['GioLam']='08:00:00';
					}
				}
				else
				{
					if($vReturnTime['GioLam']>='02:55:00' )
					{
						$vReturnTime['GioLam']='08:00:00';
					}
				}	
			}
			//echo $vrow['CodeID']."-".$vrow['NVID'].",".$vReturnTime['CaIn']."<:>".$vArrTime[99][0][0]."<br/>";
			//print_r($vArrTime[0]);
			if($vrow['NhomCC']=='KHO')
			{
				if($vArrTime[0][0][0]!=NULL && $vArrTime[0][3][0]!=NULL)
				{
					$vTempArrTime[0]=$vArrTime[0][0][0];
					$vTempArrTime[1]=$vArrTime[0][count($vArrTime[0])-1][0];
					$vArrTime=$vTempArrTime;
				}
				else
				{
					$vArrTime=NULL;
				}
			}
			else
			{
			 	if($vArrTime[0][0][0]!=NULL && $vArrTime[0][1][0]!=NULL)
				{
					$vTempArrTime[0]=$vArrTime[0][0][0];
					$vTempArrTime[1]=$vArrTime[0][1][0];
					$vArrTime=$vTempArrTime;
				}
				else
				{
					$vArrTime=NULL;
				}
			}
			//print_r($vArrTime);
			if($vShiftCal==0)	
			{
				//Tam thoi ko cap nhat ca tu dong
				$vsql=$this->motc_lv0011->LV_UpdateShiftEmp($vrow['CodeID'],$vReturnTime['CaIn'],1);
				$this->SQL_Exe=$this->SQL_Exe.$vsql;
			}
			//Cap nhat sau 22h
			///$vReturnTime['Time22h']= $this->LV_LamTronGio($vReturnTime['Time22h']);
			//$vsql=$this->motc_lv0011->LV_UpdateTime22h($vrow['CodeID'],$this->LV_GetTimeMax($vReturnTime['Time22h'],'00:00:00','08:00:00'),1);
			//$this->SQL_Exe=$this->SQL_Exe.$vsql;
			//$this->motc_lv0011->LV_UpdateCongEmp($vrow['CodeID'],$vTimeCard);
			/*if($vrow['lv007']=='P' || $vrow['lv007']=='1/2P' || $vrow['lv007']=='CL' || $vrow['lv007']=='1/2CL' )
				$vTimeCardID=$vrow['lv007'];
			else
				$vTimeCardID="";*/
			$vTimeAddMore=0;
			if($vAHoliday[$vrow['lv004']][0]==NULL && $this->isHoLiday)
			{
				$this->NgayNghiLe->LV_LoadDayID($vrow['lv004']);
				$vAHoliday[$vrow['lv004']][0]=($this->NgayNghiLe->lv001==NULL)?0:1;
				$vAHoliday[$vrow['lv004']][1]=$this->NgayNghiLe->lv004;
			}
			$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],'0');
			/*if($this->DonXinPhep->TimeCard!='' && $this->DonXinPhep->TimeCard!=NULL)
			{
				if($this->DonXinPhep->TimeCard=='VR')
				{
					if(count($vArrTime)<2)  
						 $vTimeCardID=$this->DonXinPhep->TimeCard;
					else
						$vCheckTru=true;
				}
				else
					$vTimeCardID=$this->DonXinPhep->TimeCard;
			}*/
			if($vTimeCardID=='')
			{

				//print_r($vArrTime[0]);
				if($vAHoliday[$vrow['lv004']][0]==1) 
				{
					if(count($vArrTime)<2 && $vReturnTime['GioLam']=='00:00:00')		
					{
						if($this->DonXinPhep->TimeCard!='VR')
						{
							$vLong_DateW=(float)str_replace("-","",$vrow['DateWork']);
							if($vrow['DateOff']!='')
							{
								$vLong_DateO=(float)str_replace("-","",$vrow['DateOff']);
								if($vLong_DateW<=$vLongDateCal && $vLong_DateO>=$vLongDateCal) $vTimeCardID=$vAHoliday[$vrow['lv004']][1];
							}
							else
								if($vLong_DateW<=$vLongDateCal) $vTimeCardID=$vAHoliday[$vrow['lv004']][1];
						}
					}	
				}
			}
			
			$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],'3');
			$vTS=$this->DonXinPhep->lv022;
			if($vTS==3)  
			{
				$vTimeCardID=$this->DonXinPhep->TimeCard;
				if($vTimeCardID=='') $vTimeCardID='TS';
			}
			//echo 'vinhne:'.$vrow['lv004'].":".$vTimeCardID."<br/>";
			//echo $vrow['lv004'].'==>'.$vTimeCardID.'<br/>';
			if($vTimeCardID=="" || $vTimeCardID==NULL)
			{
				$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],'0');
				if($this->DonXinPhep->TimeCard=='VR')
				{
					if(count($vArrTime)<2)  $vTimeCardID=$this->DonXinPhep->TimeCard;
					else
						$vCheckTru=true;
				}
				else
					$vTimeCardID=$this->DonXinPhep->TimeCard;
				if($vTimeCardID=="" || $vTimeCardID==NULL)
				{
					$vTimeCardID=$this->LV_GetTimeCard($vrow['NVID'],$vArrCong,$vReturnTime);
					if(trim($vrow['ProjectID'])!='' && $vrow['ProjectID']!=NULL)
					{
						if($vTimeCardID=="VP" && $vrow['ProjectID']!="VP")
						{
							$vTimeCardID='CT';
						}
					}						
					if($vState==1)
					{
						$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' ";
					}
					else
						$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' and lv007=''";
				}
				else
				{
					if(trim($vrow['ProjectID'])!='' && $vrow['ProjectID']!=NULL)
					{
						if($vTimeCardID=="VP" && $vrow['ProjectID']!="VP")
						{
							$vTimeCardID='CT';
						}
					}		
					$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' ";
				}
			}
			else		
				{
					if(trim($vrow['ProjectID'])!='' && $vrow['ProjectID']!=NULL)
					{
						if($vTimeCardID=="VP" && $vrow['ProjectID']!="VP")
						{
							$vTimeCardID='CT';
						}
					}		
					$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' ";
				}
			$this->SQL_Exe1=$vsql;
			//db_query($vsql);

			$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],'1');
			if($this->DonXinPhep->lv022!=1) $this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],'2');
			$vTimeAddMore='00:00:00';
			if(($this->DonXinPhep->lv022==1 || $this->DonXinPhep->lv022==2))
			{
				$vTimeAddMore=$this->DonXinPhep->TimesAdd;
			}
			//echo $vrow['lv004'].'==>'.$vTimeCardID.'<br/>';
			$mohr_lv0038->LV_LoadActiveArr($vrow['NVID']);
			//echo $mohr_lv0038->lv002."<br/>";
			
			if($mohr_lv0038->lv007=='00:00:00'  || $mohr_lv0038->lv007==NULL) $mohr_lv0038->lv007='08:00:00';
			$vNuaNgay=$this->GetTimeDiv2($mohr_lv0038->lv007);
			if($vNuaNgay=='' || $vNuaNgay=='00:00:00') $vNuaNgay='04:00:00';
			switch($vStatePrj)
			{
				case 0:
					break;
				case 1:
					if($vReturnTime['GioLam']>'00:00:00')
					{
						if($vReturnTime['GioLam']>'04:00:00' && $vrow['DOWS']!=1)
							$vReturnTime['GioLam']='08:00:00';
						else
							$vReturnTime['GioLam']='04:00:00';
					}
					else
					{
						$vReturnTime['GioLam']='00:00:00';
					}
					break;
				case 2:
					if($vTimeCardID!='P' && $vTimeCardID!='VR' && $vTimeCardID!='L' && $vTimeCardID!='QCC')
					{
						switch($mohr_lv0038->lv011)
						{
							case 13:
							case 0:	
								//if($vTimeCardID=="" || $vTimeCardID==NULL)
								{
									if($vrow['DOWS']==1)
									{
										$vTimeCardID='';
										$vReturnTime['GioLam']='00:00:00';
									}
									else
									{
										if(substr($vTimeCardID,0,3)=='1/2')
										{
											$vReturnTime['GioLam']='04:00:00';
										}
										else
										{
											$vTimeCardID='X';
											$vReturnTime['GioLam']='08:00:00';
										}
										
									}
									$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' ";
									$this->SQL_Exe1=$vsql;
								}
								break;
							case 1:
								//if($vTimeCardID=="" || $vTimeCardID==NULL)
								{
									if($vrow['DOWS']==1 || $vrow['DOWS']==7)
									{
										$vTimeCardID='';
										$vReturnTime['GioLam']='00:00:00';
									}
									else
									{
										$vTimeCardID='X';
										$vReturnTime['GioLam']='08:00:00';
									}
									$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' ";
									$this->SQL_Exe1=$vsql;
								}
								break;
							case 2:
								//if($vTimeCardID=="" || $vTimeCardID==NULL)
								{
									if($vrow['DOWS']==1)
									{
										$vTimeCardID='';
										$vReturnTime['GioLam']='00:00:00';
									}
									elseif($vrow['DOWS']==7)
									{
										$vTimeCardID='X';
										$vReturnTime['GioLam']='04:00:00';
									}
									else
									{
										if(substr($vTimeCardID,0,3)=='1/2')
										{
											$vReturnTime['GioLam']='04:00:00';
										}
										else
										{
											$vTimeCardID='X';
											$vReturnTime['GioLam']='08:00:00';
										}
									}
									$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' ";
									$this->SQL_Exe1=$vsql;
									
								}
								break;
							default:
								break;
						}
					}

					break;
			}
			$vReturnTime['GioLam']=$this->LV_LamTronGio($vReturnTime['GioLam']);
			//if($vTimeShiftCur!="" && $vTimeShiftCur!=NULL && $vTimeShiftCur!="00:00:00" && $vTimeShiftCur!="00:00") $mohr_lv0038->lv007=$vTimeShiftCur;
			if($mohr_lv0038->lv007=='00:00:00' || $mohr_lv0038->lv007==NULL)
				$vTimeWorkCur=$this->LV_GetTimeMax($vReturnTime['GioLam'],$vTimeAddMore);
			else
				$vTimeWorkCur=$this->LV_GetTimeMax($vReturnTime['GioLam'],$vTimeAddMore,$mohr_lv0038->lv007);
			if((float)$vTimeWorkCur<0) $vTimeWorkCur='00:00:00';
			if($vTimeWorkCur=='00:00:00' && ($vAHoliday[$vrow['lv004']][0]==1 && ( $vTimeCardID=='L' || $vTimeCardID=='' || $vTimeCardID==NULL)) && $vTS!=3)
			{
				$vLong_DateW=(float)str_replace("-","",$vrow['DateWork']);
				if($vrow['DateOff']!='')
				{
					$vLong_DateO=(float)str_replace("-","",$vrow['DateOff']);
					if($vLong_DateW<=$vLongDateCal && $vLong_DateO>=$vLongDateCal) $vTimeCardID=$vAHoliday[$vrow['lv004']][1];
				}
				else
					if($vLong_DateW<=$vLongDateCal) $vTimeCardID=$vAHoliday[$vrow['lv004']][1];
				if($vTimeCardID=="")
					$vTimeWorkCur='00:00:00';
				else
					$vTimeWorkCur=$mohr_lv0038->lv007;
				if($vState==1)
					{
						$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' ";
					}
					else
						$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' and lv007=''";
					$this->SQL_Exe1=$vsql;
			}
			$vTimeCardID=trim($vTimeCardID);
			if(count($vArrTime)<2)  
			{
				$isNoTreSom=false;
			}
			switch($vTimeCardID)
			{
				case 'L':
					if($vReturnTime['CaIn']!="" && $vReturnTime['CaOut']!="")
						$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$vTimeWorkCur,1);
					else
						$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$mohr_lv0038->lv007,1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					break;
				case 'PT':
				case 'P':
				case 'HL':
				case 'B':
				case 'KH':
				case 'CT':
					if($vTimeCardID=='CT')
					{
						if(count($vArrTime)==0) $isNoTreSom=false;
					}
					else
						$isNoTreSom=false;
					if($mohr_lv0038->lv007!='00:00:00')
						$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$mohr_lv0038->lv007,1);
					else
					{
						$vTimeWorkCur='08:00:00';
						$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$vTimeWorkCur,1);
					}
					//$vTimeWorkCur=$mohr_lv0038->lv007;
					$this->SQL_Delay=",lv016='00:00:00'";
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					break;
				case 'QCC':
					//$isNoTreSom=false;
					if($mohr_lv0038->lv007!='00:00:00')
						$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$mohr_lv0038->lv007,1);
					else
					{
						$vTimeWorkCur='08:00:00';
						$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$vTimeWorkCur,1);
					}
					//$vTimeWorkCur=$mohr_lv0038->lv007;
					$this->SQL_Delay=",lv016='00:00:00'";
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					break;
				case '1/2P':
				//	echo 'vinh'.$vReturnTime['GioLam'].'<br/>';
					$isNoTreSom=false;
					if($vrow['DOWS']==7)
					{
						if($vReturnTime['GioLam']=="" || $vReturnTime['GioLam']==NULL || $vReturnTime['GioLam']=="00:00:00" || $vReturnTime['GioLam']=="00:00")
						{
							$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$vNuaNgay,1);
						}
						else
						{
							$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$mohr_lv0038->lv007,1);
						}
						//$vTimeWorkCur=$mohr_lv0038->lv007;
						$this->SQL_Delay=",lv016='00:00:00'";
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
					}
					else
					{
						if($vReturnTime['GioLam']=="" || $vReturnTime['GioLam']==NULL || $vReturnTime['GioLam']=="00:00:00" || $vReturnTime['GioLam']=="00:00")
						{
							$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$vNuaNgay,1);
						}
						else
						{
							/*
							if($vReturnTime['GioLam']<=$vNuaNgay && $vReturnTime['FreeTime']!='00:00:00')
							{
								$vTimeWorkCur=$this->LV_GetTimeMax($vReturnTime['GioLam'],TIMEADD(TIMEADD($vNuaNgay,$vTimeAddMore),$vReturnTime['FreeTime']),$mohr_lv0038->lv007);
							}
							else
								$vTimeWorkCur=$this->LV_GetTimeMax($vReturnTime['GioLam'],TIMEADD($vNuaNgay,$vTimeAddMore),$mohr_lv0038->lv007);
							*/
							$vTimeWorkCur='08:00:00';
							$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$vTimeWorkCur,1);
						}
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
					}
					break;
				case 'CL':
					$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],'00:00:00',1);
					//$vsql="update tc_lv0011 set lv016='08:00:00' where lv001='".$vrow['CodeID']."' ";
					//db_query($vsql);
					$this->SQL_Delay=",lv016='".$mohr_lv0038->lv007."'";
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					break;
				case '1/2':
				case '1/2VR':
				case '1/2KH':
				case '1/2KL':
				case '1/2KP':	
					$isNoTreSom=false;
					/*			
					if($vTimeWorkCur<$vNuaNgay)
					{
						if( $vReturnTime['FreeTime']=='' || $vReturnTime['FreeTime']=='0') $vReturnTime['FreeTime']='00:00:00';
						$vTimeWorkCur1=TIMEADD($vTimeWorkCur,$vReturnTime['FreeTime']);
						if($vTimeWorkCur1>$vRealFreeTime)
							$vTimeWorkCur1=TIMEDIFF($vTimeWorkCur1,$vRealFreeTime);
						else
							$vTimeWorkCur1='00:00:00';
						if($vTimeWorkCur1>=$vNuaNgay) 
							$vTimeWorkCur=$vNuaNgay;
						else
							$vTimeWorkCur=$vTimeWorkCur1;
					}
					else
						$vTimeWorkCur=$vNuaNgay;
					*/
					$vTimeWorkCur='04:00:00';
					$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$vTimeWorkCur,1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					break;
				case 'VR':
				case 'TS':
				case 'SL':
				case 'KL':
				case 'KP':
					$isNoTreSom=false;
					/*$hTimeNghi=$this->GetTime($vTimeNghi);
					if($hTimeNghi>0)
					{
						$hTimeWorkCur=$this->GetTime($vTimeWorkCur);
						if($vTimeNghi>=5)
						{
							$vTimeNghi=TIMEDIFF($vTimeNghi,$vReturnTime['FreeTime']);
						}
						if($hTimeWorkCur>(8-$hTimeNghi))
						{
							$vTimeWorkCur=TIMEDIFF($mohr_lv0038->lv007,$vTimeNghi);
						}
					}
					else
						if($vTimeWorkCur<$vNuaNgay)
						{
							if( $vReturnTime['FreeTime']=='' || $vReturnTime['FreeTime']=='0') $vReturnTime['FreeTime']='00:00:00';
							$vTimeWorkCur1=TIMEADD($vTimeWorkCur,$vReturnTime['FreeTime']);
							if($vTimeWorkCur1>=$vNuaNgay) 
								$vTimeWorkCur=$vNuaNgay;
							else
								$vTimeWorkCur=$vTimeWorkCur1;
						}
					$vArrcheck=$this->LV_CheckLateSoonTime($vrow['NVID'],$vReturnTime['CaIn'],$vGioVao,$vGioRa,$vTimeCardID);	
					$vSumTRESOM=TIMEADD($vArrcheck['DITRE'],$vArrcheck['VESOM']);
					$vArrcheck['DITRE']='00:00';
					$vArrcheck['VESOM']='00:00';*/
					$vTimeWorkCur='00:00:00';
					$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$vTimeWorkCur,1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					break;
				default:
					$isKhongCongFree=false;
					if(!(strpos($vReturnTime['GioLamThuc'],"-")===false)) $vReturnTime['GioLamThuc']='00:00:00';
					if($vCheckTru)
					{
						$isNoTreSom=false;
						$hTimeNghi=$this->GetTime($vTimeNghi);
						if($hTimeNghi>0)
						{
							$hTimeWorkCur=$this->GetTime($vTimeWorkCur);
							if($vTimeNghi>=5)
							{
								$vTimeNghi=TIMEDIFF($vTimeNghi,$vReturnTime['FreeTime']);
							}
							if($hTimeWorkCur>(8-$hTimeNghi))
							{
								$vTimeWorkCur=TIMEDIFF($mohr_lv0038->lv007,$vTimeNghi);
								$isKhongCongFree=true;
							}
						}
						else
							if($vTimeWorkCur<$vNuaNgay && ($vReturnTime['GioLamThuc']!=NULL && $vReturnTime['GioLamThuc']!="00:00:00"))
							{
								if( $vReturnTime['FreeTime']=='' || $vReturnTime['FreeTime']=='0') $vReturnTime['FreeTime']='00:00:00';
								if($vRealFreeTime>'00:00:00') $vTimeWorkCur1=TIMEADD($vTimeWorkCur,$vReturnTime['FreeTime']);
								if($vTimeWorkCur1>=$vNuaNgay) 
									$vTimeWorkCur=$vNuaNgay;
								else
									$vTimeWorkCur=$vTimeWorkCur1;
							}
						$vArrcheck=$this->LV_CheckLateSoonTime($vrow['NVID'],$vReturnTime['CaIn'],$vGioVao,$vGioRa,$vTimeCardID);	
						$vSumTRESOM=TIMEADD($vArrcheck['DITRE'],$vArrcheck['VESOM']);
						$vArrcheck['DITRE']='00:00';
						$vArrcheck['VESOM']='00:00';
					}
					//echo $vReturnTime['GioLamThuc'];
					
					//echo $vrow['lv004'].'->'.$vTimeWorkCur."+".$vReturnTime['FreeTime']."-".$vRealFreeTime;
					if($vTimeWorkCur<$vNuaNgay && ($vReturnTime['GioLamThuc']!=NULL && $vReturnTime['GioLamThuc']!="00:00:00"))
					{
						if(count($vArrTime)>1)
						{
							$vTimeCheck=TIMEDIFF($vArrTime[1],$vArrTime[0]);
							if(TIMEADD($vTimeWorkCur,$vReturnTime['FreeTime'])>$vTimeCheck && $vTimeWorkCur<='01:00:00') $isKhongCongFree=true;
							
						}
						if( $vReturnTime['FreeTime']=='' || $vReturnTime['FreeTime']=='0') $vReturnTime['FreeTime']='00:00:00';
						//Xet 
						if($isKhongCongFree==false) 
							$vTimeWorkCur1=TIMEADD($vTimeWorkCur,$vReturnTime['FreeTime']);
						else
						{
							$vTimeWorkCur1=$vTimeWorkCur;
						}
						//if($vReturnTime['FreeTime']>$vRealFreeTime)
						//	$vTimeWorkCur1=TIMEADD($vTimeWorkCur1,$vRealFreeTime);
						//else
						//	$vTimeWorkCur1='00:00:00';
						if($vTimeWorkCur1>=$vNuaNgay)
						{ 
							//echo "<br/>".$vTimeWorkCur1.",".$vRealFreeTime.'=';
							$vTimeWorkCur=TIMEDIFF($vTimeWorkCur1,substr($vRealFreeTime,0,5).':00');
						}
						else
							$vTimeWorkCur=$vTimeWorkCur1;
					}
					else
						$vTimeWorkCur=$this->LV_LamTronGioLam($vTimeWorkCur,$mohr_lv0038->lv007);
					if(!(strpos($vTimeWorkCur,"-")===false)) $vTimeWorkCur='00:00:00';
					

					if($vArrDep[$vrow['lv001']][10]==1)
					{
						if(($vrow['DOWS']==1 || ($vTimeCardID=='L' || $vAHoliday[$vrow['lv004']][1]=='L')) && $vTimeWorkCur>'00:00:00')
						{
							$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],'00:00:00',1);
							$this->SQL_Exe=$this->SQL_Exe.$vsql;
						}
						else
						{
							if($vTimeWorkCur>'00:00:00')
								$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],'08:00:00',1);
							else
								$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$vTimeWorkCur,1);
							$this->SQL_Exe=$this->SQL_Exe.$vsql;
						}
					}
					else
					{
						if($vTimeWorkCur>'00:00:00')
							$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],'08:00:00',1);
						else
							$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$vTimeWorkCur,1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
					}
					
					break;
			}
			//echo $vrow['NVID'].':'.$vTimeWorkCur."-----".$vCLEmp[$vrow['NVID']][1]."<br>";
			//echo $vrow['lv004'].":";
			//echo '('.$vReturnTime['GioLamThuc'].'>=TIMEADD(\'08:00:00\','.$vArrDep[$vrow['lv001']][11].') && '.$vArrDep[$vrow['lv001']][10].'==1)';
			//echo "<br/>";
			$vAutoTC=false;
			if($vArrDep[$vrow['lv001']][10]==1)
			{
				
				if($vTimeCardID=='L' || $vAHoliday[$vrow['lv004']][1]=='L')
				{
					$vTimeTC=$vReturnTime['GioLamThuc'];//TIMEDIFF($vReturnTime['GioLamThuc'],'08:00:00');
					$vTimeTC=TIMEADD($vTimeTC,$vTimeTCTG);
					//$vTimeTC=$this->LV_LamTronGioTC($vTimeTC);
					$vsql=$this->motc_lv0011->LV_UpdateTimeOverHoliday($vrow['CodeID'],$vTimeTC,1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					$vsql=$this->motc_lv0011->LV_UpdateTimeOverNight($vrow['CodeID'],'00:00:00',1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					$vsql=$this->motc_lv0011->LV_UpdateTimeTCEmp($vrow['CodeID'],'00:00:00',1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
				}
				else if($vrow['DOWS']==1)
				{
					$vTimeTC=$vReturnTime['GioLamThuc'];//TIMEDIFF($vReturnTime['GioLamThuc'],'08:00:00');
					$vTimeTC=TIMEADD($vTimeTC,$vTimeTCTG);
					//$vTimeTC=$this->LV_LamTronGioTC($vTimeTC);
					$vsql=$this->motc_lv0011->LV_UpdateTimeOverHoliday($vrow['CodeID'],'00:00:00',1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					$vsql=$this->motc_lv0011->LV_UpdateTimeOverNight($vrow['CodeID'],$vTimeTC,1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					$vsql=$this->motc_lv0011->LV_UpdateTimeTCEmp($vrow['CodeID'],'00:00:00',1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					$vAutoTC=true;

				}
				else
				{
					//$vReturnTime['GioLamThuc'];
					if($vReturnTime['GioLamThuc']>=TIMEADD('08:00:00',$vArrDep[$vrow['lv001']][11]))
					{
						$vTimeTC=TIMEDIFF($vReturnTime['GioLamThuc'],'08:00:00');
						$vTimeTC=TIMEADD($vTimeTC,$vTimeTCTG);
						//$vTimeTC=$this->LV_LamTronGioTC($vTimeTC);
						
						$vsql=$this->motc_lv0011->LV_UpdateTimeOverHoliday($vrow['CodeID'],'00:00:00',1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
						$vsql=$this->motc_lv0011->LV_UpdateTimeOverNight($vrow['CodeID'],'00:00:00',1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
						$vsql=$this->motc_lv0011->LV_UpdateTimeTCEmp($vrow['CodeID'],$vTimeTC,1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
					
						/*if($vTimeTC>='05:00:00')
						{
							$vsql=$this->motc_lv0011->LV_UpdateCodeEatTC($vrow['CodeID'],'1',1);
							$this->SQL_Exe=$this->SQL_Exe.$vsql;
						}
						else
						{
							$vsql=$this->motc_lv0011->LV_UpdateCodeEatTC($vrow['CodeID'],'0',1);
							$this->SQL_Exe=$this->SQL_Exe.$vsql;
						
						}
						*/
					}
					$vAutoTC=true;
				}
				$vTimeTC='00:00:00';
				
			}
			else
			{
				$vTimeTC=TIMEADD($vTimeTC,$vTimeTCTG);
				/*$vsql=$this->motc_lv0011->LV_UpdateCodeEatTC($vrow['CodeID'],'0',1);
				 $this->SQL_Exe=$this->SQL_Exe.$vsql;*/
			}
			$vLan=0;
			if($vIsTC==true) $vTimeTC='00:00:00';
			$vCount=0;
			 if($vTimeTC=='00:00:00' || $vTimeTC=='') $vIsTC=true;
			{
				//$vArrTime=$vArrTime[0];
			while(true)
			{
				$vCount=$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],4,$vLan);
				if($vCount==0) break;
				if($this->DonXinPhep->lv022==4 && substr($this->DonXinPhep->lv016,0,10)==$vrow['lv004'])
				{
					if($this->isCheckOut==true)
					{
						if(count($vArrTime)>1)
						{
							$ArDateTo=explode(" ",$this->DonXinPhep->lv017);
							$ArDateTo[1]=$this->LV_CheckTCRa($ArDateTo[1],$vArrTime[1]);
							$this->DonXinPhep->lv017=$ArDateTo[0].' '.$ArDateTo[1];
							$vTimeTC1=TIMEDIFF($this->DonXinPhep->lv017,$this->DonXinPhep->lv016);
							if(substr($ArDateTo[1],0,5)=='23:59') $vTimeTC1=TIMEADD($vTimeTC1,'00:01:00');
							if((strpos($vTimeTC1,"-")===false))
							{
								$vTimeTC=TIMEADD($vTimeTC,$vTimeTC1);
								
							}
							
						}
						
					}
					else
					{
						$vTimeTC1=TIMEDIFF($this->DonXinPhep->lv017,$this->DonXinPhep->lv016);
						if((strpos($vTimeTC1,"-")===false))
						{
							$vTimeTC=TIMEADD($vTimeTC,$vTimeTC1);
						}
					}
				}
				$vLan++;
				//echo $vTimeTC."<br/>";;
				if($vCount<=$vLan && $vCount>0)
				{
					if((strpos($vTimeTC,"-")===false))
					{
						$vTimeTC=$this->LV_LamTronGioTC($vTimeTC);
						$vsql=$this->motc_lv0011->LV_UpdateTimeTCEmp($vrow['CodeID'],$vTimeTC,1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
						if($vAHoliday[$vrow['lv004']][0]==1) 
						{
							if($vTimeTC>=$vTimeWorkCur && $vrow['TTNV']!=5)
							{
								$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],'00:00',1);
								$this->SQL_Exe=$this->SQL_Exe.$vsql;
							}
						}
					}
					else
					{
						if($vAutoTC==false)
						{
							$vsql=$this->motc_lv0011->LV_UpdateTimeTCEmp($vrow['CodeID'],'00:00',1);
							$this->SQL_Exe=$this->SQL_Exe.$vsql;
						}
					}
					break;
				}
			}
			if($vCount==0)
			{
				//Tính tăng ca.
				$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],7);
				if($this->DonXinPhep->lv022==7)
				{
					if($this->isCheckOut==true)
					{
						if(count($vArrTime)>1)
						{
							$ArDateFrom=explode(" ",$this->DonXinPhep->lv016);
							$ArDateFrom[1]=$this->LV_CheckTCRa($ArDateFrom[1],$vArrTime[1]);
							$this->DonXinPhep->lv016=$vrow['lv004'].' '.$ArDateFrom[1];

							$ArDateTo=explode(" ",$this->DonXinPhep->lv017);
							$ArDateTo[1]=$this->LV_CheckTCRa($ArDateTo[1],$vArrTime[1]);
							$this->DonXinPhep->lv017=$vrow['lv004'].' '.$ArDateTo[1];
							$vTimeTC=TIMEDIFF($this->DonXinPhep->lv017,$this->DonXinPhep->lv016);
							if(substr($ArDateTo[1],0,5)=='23:59') $vTimeTC=TIMEADD($vTimeTC,'00:01:00');
							if(!(strpos($vTimeTC,"-")===false))
							{
								$vTimeTC='00:00';
							}
						}
						else
							$vTimeTC='00:00';
						
					}
					else
					{
						$ArDateFrom=explode(" ",$this->DonXinPhep->lv016);
						$this->DonXinPhep->lv016=$vrow['lv004'].' '.$ArDateFrom[1];

						$ArDateTo=explode(" ",$this->DonXinPhep->lv017);
						$this->DonXinPhep->lv017=$vrow['lv004'].' '.$ArDateTo[1];
						$vTimeTC=TIMEDIFF($this->DonXinPhep->lv017,$this->DonXinPhep->lv016);
						if(substr($ArDateTo[1],0,5)=='23:59') $vTimeTC=TIMEADD($vTimeTC,'00:01:00');
					}
					if(strpos($vTimeTC,"-")===false)
					{
						$vTimeTC=$this->LV_LamTronGioTC($vTimeTC);
						$vsql=$this->motc_lv0011->LV_UpdateTimeTCEmp($vrow['CodeID'],$vTimeTC,1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
						if($vAHoliday[$vrow['lv004']][0]==1) 
						{
							if($vTimeTC>=$vTimeWorkCur && $vrow['TTNV']!=5)
							{
								$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],'00:00',1);
								$this->SQL_Exe=$this->SQL_Exe.$vsql;
							}
						}
					}
				}
				else
				{
					if($vIsTC==true && $vAutoTC==false)
					{
					$vsql=$this->motc_lv0011->LV_UpdateTimeTCEmp($vrow['CodeID'],'00:00',1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
					}
				}
			}
			}
			//Tính tăng ca.
			$vTimeTC='00:00:00';
			$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],5);
			if($this->DonXinPhep->lv022==5 && substr($this->DonXinPhep->lv016,0,10)==$vrow['lv004'])
			{
				if($this->isCheckOut==true)
				{
					if(count($vArrTime)>1)
					{
						$ArDateTo=explode(" ",$this->DonXinPhep->lv017);
						$ArDateTo[1]=$this->LV_CheckTCRa($ArDateTo[1],$vArrTime[1]);
						$this->DonXinPhep->lv017=$ArDateTo[0].' '.$ArDateTo[1];
						$vTimeTC=TIMEDIFF($this->DonXinPhep->lv017,$this->DonXinPhep->lv016);
						if(substr($ArDateTo[1],0,5)=='23:59') $vTimeTC=TIMEADD($vTimeTC,'00:01:00');
						if(!(strpos($vTimeTC,"-")===false))
						{
							$vTimeTC='00:00';
						}
					}
					else
						$vTimeTC='00:00';
					
				}
				else
					$vTimeTC=TIMEDIFF($this->DonXinPhep->lv017,$this->DonXinPhep->lv016);
				if(strpos($vTimeTC,"-")===false)
				{
					$vTimeTC=$this->LV_LamTronGioTC($vTimeTC);
					$vsql=$this->motc_lv0011->LV_UpdateTimeOverMiddle($vrow['CodeID'],$vTimeTC,1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
				}
			}
			else
			{
				if($vAutoTC==false)
					{
						$vsql=$this->motc_lv0011->LV_UpdateTimeOverMiddle($vrow['CodeID'],$vTimeTC,1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
					}
			}
			//Tính tăng ca.
			$vLan=0;
			$vCount=0;
			$vTimeTC='00:00:00';
			while(true)
			{
				$vCount=$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],9,$vLan);
				if($vCount==0) break;
				if($this->DonXinPhep->lv022==9)
				{
					if($this->isCheckOut==true)
					{
						if(count($vArrTime)>1)
						{
							$ArDateTo=explode(" ",$this->DonXinPhep->lv017);
							$ArDateTo[1]=$this->LV_CheckTCRa($ArDateTo[1],$vArrTime[1]);
							$this->DonXinPhep->lv017=$ArDateTo[0].' '.$ArDateTo[1];
							$vTimeTC1=TIMEDIFF($this->DonXinPhep->lv017,$this->DonXinPhep->lv016);
							if(substr($ArDateTo[1],0,5)=='23:59') $vTimeTC1=TIMEADD($vTimeTC1,'00:01:00');
							if((strpos($vTimeTC1,"-")===false))
							{
								$vTimeTC=TIMEADD($vTimeTC,$vTimeTC1);
								
							}
						}
					}
					else
					{
						$vTimeTC1=TIMEDIFF($this->DonXinPhep->lv017,$this->DonXinPhep->lv016);
						if((strpos($vTimeTC1,"-")===false))
						{
							$vTimeTC=TIMEADD($vTimeTC,$vTimeTC1);
						}
					}
				}
				$vLan++;
				if($vCount<=$vLan && $vCount>0)
				{
					if((strpos($vTimeTC,"-")===false))
					{
						$vTimeTC=$this->LV_LamTronGioTC($vTimeTC);
						$vsql=$this->motc_lv0011->LV_UpdateTimeOverHoliday($vrow['CodeID'],$vTimeTC,1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
						if($vAHoliday[$vrow['lv004']][0]==1) 
						{
							if($vTimeWorkCur>'00:00:00')
							{
								$vsql="update tc_lv0011 set lv007='L' where lv001='".$vrow['CodeID']."'";
								$this->SQL_Exe1=$vsql;
								$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],$mohr_lv0038->lv007,1);
								$this->SQL_Exe=$this->SQL_Exe.$vsql;
							}
							//if($vTimeTC>=$vTimeWorkCur && $vrow['TTNV']!=5)
							//{
							//	$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],'00:00',1);
							//	$this->SQL_Exe=$this->SQL_Exe.$vsql;
							//}
						}
					}
					else
					{
						if($vAutoTC==false)
						{
							$vsql=$this->motc_lv0011->LV_UpdateTimeOverHoliday($vrow['CodeID'],'00:00',1);
							$this->SQL_Exe=$this->SQL_Exe.$vsql;
						}
					}
					break;
				}
			}
			if($vCount==0)
			{
				if($vAutoTC==false)
					{
						$vsql=$this->motc_lv0011->LV_UpdateTimeOverHoliday($vrow['CodeID'],'00:00',1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
					}
			}
			$vLan=0;
			$vCount=0;
			$vTimeTC='00:00:00';
			while(true)
			{
				$vCount=$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],6,$vLan);
				if($vCount==0) break;
				if($this->DonXinPhep->lv022==6 && substr($this->DonXinPhep->lv016,0,10)==$vrow['lv004'])
				{
					if($this->isCheckOut==true)
					{
						if(count($vArrTime)>1)
						{
							$ArDateTo=explode(" ",$this->DonXinPhep->lv017);
							$ArDateTo[1]=$this->LV_CheckTCRa($ArDateTo[1],$vArrTime[1]);
							$this->DonXinPhep->lv017=$ArDateTo[0].' '.$ArDateTo[1];
							$vTimeTC1=TIMEDIFF($this->DonXinPhep->lv017,$this->DonXinPhep->lv016);
							if(substr($ArDateTo[1],0,5)=='23:59') $vTimeTC1=TIMEADD($vTimeTC1,'00:01:00');
							if((strpos($vTimeTC1,"-")===false))
							{
								$vTimeTC=TIMEADD($vTimeTC,$vTimeTC1);
								
							}
						}
					}
					else
					{
						$vTimeTC1=TIMEDIFF($this->DonXinPhep->lv017,$this->DonXinPhep->lv016);
						if((strpos($vTimeTC1,"-")===false))
						{
							$vTimeTC=TIMEADD($vTimeTC,$vTimeTC1);
						}
					}
				}
				$vLan++;
				//echo $vTimeTC."<br/>";;
				if($vCount<=$vLan && $vCount>0)
				{
					if((strpos($vTimeTC,"-")===false))
					{
						$vTimeTC=$this->LV_LamTronGioTC($vTimeTC);
						$vsql=$this->motc_lv0011->LV_UpdateTimeOverNight($vrow['CodeID'],$vTimeTC,1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
						//if($vAHoliday[$vrow['lv004']][0]==1 || $vrow['DOWS']==1) 
						if( $vrow['DOWS']==1 && $vCount>0)
						{
							if($vTimeTC>=$vTimeWorkCur && $vrow['TTNV']!=5)
							{
								$vsql=$this->motc_lv0011->LV_UpdateTimeWorkEmp($vrow['CodeID'],'00:00',1);
								$this->SQL_Exe=$this->SQL_Exe.$vsql;
							}
						}
					}
					else
					{
						if($vAutoTC==false)
						{
							$vsql=$this->motc_lv0011->LV_UpdateTimeOverNight($vrow['CodeID'],'00:00',1);
							$this->SQL_Exe=$this->SQL_Exe.$vsql;
						}
						
					}
					break;
				}
			}
			if($vCount==0)
			{
				if($vAutoTC==false)
					{
						$vsql=$this->motc_lv0011->LV_UpdateTimeOverNight($vrow['CodeID'],'00:00',1);
						$this->SQL_Exe=$this->SQL_Exe.$vsql;
					}
			}
			
			$this->DonXinPhep->LV_CheckPhepStateMulti($vrow['NVID'],$vrow['lv004'],13);
			$vStateRunCheck=0;
			if($vNgayPhepNuaNgay!='')
			{
				if($this->DonXinPhep->lv022==13)
				{
					//$vStateRunCheck=1;
					$isNoTreSom=false;
					$vsql=$this->motc_lv0011->LV_UpdateXinDiTreVeSom($vrow['CodeID'],1,1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
				}
				else
				{
					$vsql=$this->motc_lv0011->LV_UpdateXinDiTreVeSom($vrow['CodeID'],0,1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
				}
				if($vNgayPhepNuaNgay>='12:00:00')
					$vStateRunCheck=2;
				else
					$vStateRunCheck=3;
			}
			else
			{
				if($this->DonXinPhep->lv022==13)
				{
					//$isNoTreSom=false;
					$vsql=$this->motc_lv0011->LV_UpdateXinDiTreVeSom($vrow['CodeID'],1,1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
				}
				else
				{
					$vsql=$this->motc_lv0011->LV_UpdateXinDiTreVeSom($vrow['CodeID'],0,1);
					$this->SQL_Exe=$this->SQL_Exe.$vsql;
				}
				if(substr($vTimeCardID,0,3)=='1/2')
				{
					//$isNoTreSom=false;
				}
			}
			if($vStateRunCheck==0)
			{
				if($vrow['isDiTre']==1) $isNoTreSom=false;
				if(count($vArrTime)==0) $isNoTreSom=false;
				if($vReturnTime['CaIn']=='CaA0')
				{
					if($vTimeWorkCur>'00:00:00' && $vTimeWorkCur<'08:00:00')
					{
						if($isNoTreSom && $vrow['DOWS']!=1) 
						{
							$vArrcheck['DITRE']=TIMEDIFF('08:00:00',$vTimeWorkCur);
							$vArrcheck['VESOM']='00:00:00';
						}
						else
						{
							$vArrcheck['DITRE']='00:00:00';
							$vArrcheck['VESOM']='00:00:00';
						}
					}
					else
					{
						$vArrcheck['DITRE']='00:00:00';
						$vArrcheck['VESOM']='00:00:00';
					}
				}
				else
				{
					if($isNoTreSom && $vrow['DOWS']!=1 ) 
					{
						$vArrcheck=$this->LV_CheckLateSoonTime($vrow['NVID'],$vReturnTime['CaIn'],$vGioVao,$vGioRa,$vTimeCardID);	
				
						if($vGioCTS<='08:00:00' && $vGioCTS!='')
						{
							$vArrcheck['DITRE']='00:00:00';
						}
						//echo $vGioCTE.'==>'."$vGioCTE>='17:00:00'";
						if($vGioCTE>='17:00:00' && $vGioCTE!='')
						{
							$vArrcheck['VESOM']='00:00:00';
						}
					}
					else
					{
						$vArrcheck['DITRE']='00:00:00';
						$vArrcheck['VESOM']='00:00:00';
					}
				}
				switch($vStatePrj)
				{
					case 0:

						break;
					case 1:
						$vArrcheck['VESOM']='00:00:00';
						break;
					case 2:
						$vArrcheck['DITRE']='00:00:00';
						$vArrcheck['VESOM']='00:00:00';
						break;
				}
			}
			else
			{
				//echo 'VINH='.$vStateRunCheck;
				if($vStateRunCheck==2)
				{
					$vTimeCCCK=TIMEADD($vReturnTime['GioLam'],$vReturnTime['FreeTime']);
					if($vTimeCCCK<'04:00:00')
					{
						$vArrcheck['VESOM']=TIMEDIFF('04:00:00',$vTimeCCCK);
					}
					$vArrcheck['DITRE']='00:00:00';
				}
				elseif($vStateRunCheck==3)
				{
					$vTimeCCCK=TIMEADD($vReturnTime['GioLam'],$vReturnTime['FreeTime']);
					if(TIMEADD($vReturnTime['GioLam'],$vReturnTime['FreeTime'])<'04:00:00')
					{
						$vArrcheck['DITRE']=TIMEDIFF('04:00:00',$vReturnTime['GioLam']);
					}
					$vArrcheck['VESOM']='00:00:00';
				}
				else
				{
					$vArrcheck['VESOM']='00:00:00';
					$vArrcheck['DITRE']='00:00:00';
				}				
			}
			
			if(count($vArrTime)==0) 
			{
				$vArrcheck['VESOM']='00:00:00';
				$vArrcheck['DITRE']='00:00:00';
			}
			if($vrow['DOWS']==7)
			{
				if($isNoTreSom)
				{ 
					
					$vArrcheck['VESOM']='00:00:00';
					if($vrow['DOWS']==7)
					{
						if($vrow['NhomCC']=='KHO')
						{
							if($vGioRa<'16:00:00' && count($vArrTime)>1)
							{
								$vArrcheck['VESOM']=TIMEDIFF('16:00:00',$vGioRa);
							}
						}
						else
						{
							if($vGioRa<'12:00:00'  && count($vArrTime)>1)
							{
								$vArrcheck['VESOM']=TIMEDIFF('12:00:00',$vGioRa);
							}
						}	
						if($vGioCTE>='16:00:00' && $vGioCTE!='')
						{
							$vArrcheck['VESOM']='00:00:00';
						}
					}
				}
			}
			else if( $isNoTreSom==true && $vrow['NhomCC']=='KHO' && $vArrcheck['VESOM']=='00:00:00' && $vArrcheck['DITRE']=='00:00:00')
			{
				//Kiểm tra giờ làm không đủ 08:00
				if($vTimeWorkCur<'08:00:00' && $vTimeWorkCur>'00:00:00')
				{
					// Xử lý đi cho vào chuung mục về sớm
					//echo $vReturnTime['GioLam'].'<br/>';
					$vArrcheck['VESOM']=TIMEDIFF('08:00:00',$vReturnTime['GioLam']);
				}
			}
			if($vArrcheck['VESOM']<'00:06:00')
			{
				$vArrcheck['VESOM']='00:00:00';
			}
			if($vArrcheck['DITRE']<'00:06:00')
			{
				//echo $vrow['lv004'].'-->'.$vArrcheck['DITRE'].'<br/>';
				$vArrcheck['DITRE']='00:00:00';
			}
			$vsql=$this->motc_lv0011->LV_UpdateTimeLateSoonEmp($vrow['CodeID'],$vArrcheck['DITRE'],$vArrcheck['VESOM'],1);	
			$this->SQL_Exe=$this->SQL_Exe.$vsql;
			$this->SQL_Exe=$this->SQL_Exe.$this->SQL_Delay;
			//$this->motc_lv0011->LV_UpdateTimeLateEmp($vrow['CodeID'],$vArrcheck['DITRE'])	;	
			//$this->motc_lv0011->LV_UpdateTimeSoonEmp($vrow['CodeID'],$vArrcheck['VESOM']);	
			//Xử lý nửa công
			//Xử lý công vệ sinh
			//$this->motc_lv0011->LV_UpdateAuto($vrow['CodeID'],$vDateCal,$vReturnTime['GioLam']);
			$this->SQL_Exe1=str_replace(" where",$this->SQL_Exe." where",$this->SQL_Exe1);
			//echo "$vDateCal=>";
			//echo $this->SQL_Exe1;
			//echo "<br/>";
			db_query($this->SQL_Exe1);
			
			}
			}
		}
			
		}

	}
	function LV_CheckLateSoonTime($NVID,$shiftDay,$vGioVao,$vGioRa,$vTimeCardID)
	{
		
		$vArrTime=Array();
		$vArrTime['DITRE']='00:00:00';
		$vArrTime['VESOM']='00:00:00';
		$vArrTime['STATE']=0;
		if($shiftDay=="") return $vArrTime;
		if($shiftDay!="" && $shiftDay!=NULL)
		{
			//Lay gio ca
			$sqlShift = "select * from tc_lv0004 where lv001='$shiftDay'";
			$db_Shift = db_query($sqlShift);
			$objShift = db_fetch_array ($db_Shift);
			$shift_start=$objShift['lv003'];
			//$shift_end=$objShift['lv004'];
			$shift_end=(($vTimeCardID=='SS')?$objShift['lv007']:$objShift['lv004']);
			$passday=((int)str_replace(":","",$shift_start)>(int)str_replace(":","",$shift_end))?1:0;
			//Kiem tra gio vao ra theo ca
			//if(count($ArrTime)<2) return $vArrTime;
			//Khong qua ngay
			if($passday==0)
			{
				if((int)str_replace(":","",$vGioVao)>(int)str_replace(":","",$shift_start) && (int)str_replace(":","",$vGioRa)<(int)str_replace(":","",$shift_end))
				{
					$vArrTime['DITRE']=TIMEDIFF($vGioVao,$shift_start);
					$vArrTime['VESOM']=TIMEDIFF($shift_end,$vGioRa);
					$vArrTime['STATE']=3;
				}
				else if ((int)str_replace(":","",$vGioVao)>(int)str_replace(":","",$shift_start))
				{
					$vArrTime['DITRE']=TIMEDIFF($vGioVao,$shift_start);
					$vArrTime['STATE']=1;
				}
				else if((int)str_replace(":","",$vGioRa)<(int)str_replace(":","",$shift_end))
				{
					$vArrTime['VESOM']=TIMEDIFF($shift_end,$vGioRa);
					$vArrTime['STATE']=2;

				}

			}
			else
			{
				if((int)str_replace(":","",$vGioVao)>(int)str_replace(":","",$shift_start) && (int)str_replace(":","",$vGioRa)<(int)str_replace(":","",$shift_end))
				{
					$vArrTime['DITRE']=TIMEDIFF($vGioVao,$shift_start);
					$vArrTime['VESOM']=TIMEDIFF($shift_end,$vGioRa);
					$vArrTime['STATE']=3;
				}
				else if ((int)str_replace(":","",$vGioVao)>(int)str_replace(":","",$shift_start))
				{
					$vArrTime['DITRE']=TIMEDIFF($vGioVao,$shift_start);
					$vArrTime['STATE']=1;
				}
				else if((int)str_replace(":","",$vGioRa)<(int)str_replace(":","",$shift_end))
				{
					$vArrTime['VESOM']=TIMEDIFF($shift_end,$vGioRa);
					$vArrTime['STATE']=2;

				}
			}
			
			
		}
		return $vArrTime;
	}
	function GetTime($vTime)
	{
			$vArrH=explode(":",$vTime);
			$vHours=(float)$vArrH[0] ;
			$vMinutes=(float)$vArrH[1];
			$vSecond=(float)$vArrH[2];
			$vMinutes=(int)($vSecond/60)+$vMinutes;
			$vSecond=$vSecond%60;
			$vHours=$vHours+(int)($vMinutes/60)+(($vMinutes%60)/60);	
			return $vHours;
	}
	function GetTimeDiv2($vTime)
	{
			$vArrH=explode(":",$vTime);
			$vHours=$vArrH[0]/2 ;
			$vMinutes=$vArrH[1]/2;
			$vSecond=$vArrH[2]/2;
			
			return Fillnum($vHours,2).":".Fillnum($vMinutes,2).":".Fillnum($vSecond,2);
	}
	function LV_GetTimeMax($vGioLam,$vGioThem,$vWorkHD='08:00:00')
	{
		if(substr($vGioLam,0,1)=='-') $vGioLam="00:00:00";
		$vNewTime=TIMEADD($vGioLam,$vGioThem);
		if($vNewTime=="00:00:00" || $vGioLam=="00:00:00" || ($vNewTime==$vGioThem)) return "00:00:00";
		if(CompareTime($vNewTime,$vWorkHD))
		{
			return $vWorkHD;
		}
		return $vNewTime;
	}
	function LV_GetTimeCard($vEmpID,$vArrCong,$vReturnTime)
	{
		$vTimeCard='';
		$vCaIn=$vReturnTime['CaIn'];
		$vCaOut=$vReturnTime['CaOut'];
		
		if($vCaIn==$vCaOut || $vCaOut=="")
		{
			$vTimeCard=$vArrCong['CA-'.$vCaIn][0];
		}
		else
			{
				if($vCaIn=='CAHC' && $vCaOut=='CA1') 
					$vTimeCard=$vArrCong['CA-'.$vCaIn][0];
				else
					$vTimeCard=$vArrCong['CA-'.$vCaIn][1];
				if($vTimeCard=="" || $vTimeCard==NULL) $vTimeCard=$vArrCong['CA-'.$vCaIn][0];
			}
		
		//echo "$vCaIn,$vCaOut : $vTimeCard<br/>";
		return $vTimeCard;
		
	}
	function LV_RunToDay($vDate,$lineprocess,$vState,$vCheckNT)
	{
		$vArrCode=Array(0=>'X',1=>'T',2=>'S',3=>'TT',4=>'V');
		if($vCheckNT==1)
		{
			if($lineprocess=="")
				$sqlS = "SELECT A.lv001 CodeID,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,B.lv002 NVID,C.lv029 lv001,D.lv007 Shift,DayOfWeek(A.lv004) DOWS FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 inner join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) WHERE C.lv009 not in ('2','3') and MONTH(A.lv004)=MONTH('$vDate') and YEAR(A.lv004)=YEAR('$vDate')  order by C.lv029 ASC,A.lv004 ASC";
			else
				$sqlS = "SELECT A.lv001 CodeID,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,B.lv002 NVID,C.lv029 lv001,D.lv007 Shift,DayOfWeek(A.lv004) DOWS FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 inner join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) WHERE C.lv009 not in ('2','3') and MONTH(A.lv004)=MONTH('$vDate') and YEAR(A.lv004)=YEAR('$vDate')  and  C.lv029 in ('".str_replace(",","','",$lineprocess)."')  order by C.lv029 ASC,A.lv004 ASC";
		}
		else
		{
			if($lineprocess=="")
				$sqlS = "SELECT A.lv001 CodeID,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,B.lv002 NVID,C.lv029 lv001,D.lv007 Shift,DayOfWeek(A.lv004) DOWS FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 inner join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) WHERE C.lv009 not in ('2','3') and A.lv004='$vDate'  order by C.lv029 ASC,A.lv004 ASC";
			else
				$sqlS = "SELECT A.lv001 CodeID,A.lv002,A.lv003,A.lv004,A.lv005,A.lv006,A.lv007,A.lv008,A.lv009,A.lv010,B.lv002 NVID,C.lv029 lv001,D.lv007 Shift,DayOfWeek(A.lv004) DOWS FROM tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 inner join hr_lv0020 C on C.lv001=B.lv002 left join tc_lv0008 D on D.lv002=B.lv002  and D.lv005=year(A.lv004) WHERE C.lv009 not in ('2','3') and A.lv004='$vDate' and  C.lv029 in ('".str_replace(",","','",$lineprocess)."')  order by C.lv029 ASC,A.lv004 ASC";
		}
		$vAHoliday=Array();
		$vorder=$curRow;
		$bResult = db_query($sqlS);
			while ($vrow = db_fetch_array ($bResult)){
			//NVID NVID
			//lv010 Ca		
			//Shift year
			if($vrow['DOWS']!=1)
			{
				$vTimeCardID='';
				if($vAHoliday[$vrow['lv004']][0]==NULL)
				{
					$this->NgayNghiLe->LV_LoadDayID($vrow['lv004']);
					$vAHoliday[$vrow['lv004']][0]=($this->NgayNghiLe->lv001==NULL)?0:1;
					$vAHoliday[$vrow['lv004']][1]=$this->NgayNghiLe->lv004;
					
				}
				if($vAHoliday[$vrow['lv004']][0]==1) $vTimeCardID=$vAHoliday[$vrow['lv004']][1];
				if($vTimeCardID=="" || $vTimeCardID==NULL)
				{
					$this->DonXinPhep->LV_CheckPhep($vrow['NVID'],$vrow['lv004']);
					
					$vTimeCardID=$this->DonXinPhep->TimeCard;
					if($vTimeCardID=="" || $vTimeCardID==NULL)
					{
						$arrShift=$this->GetTimeListArr($vrow['NVID'],$vrow['lv004']);
						$lvcheck=$this->LV_CheckLateSoon($vrow['NVID'],$vrow['lv010'],$vrow['Shift'],$arrShift,$vrow['DOWS']);
						if($vState==1)
						{
							$vsql="update tc_lv0011 set lv007='".$vArrCode[$lvcheck]."' where lv001='".$vrow['CodeID']."' ";
						}
						else
							$vsql="update tc_lv0011 set lv007='".$vArrCode[$lvcheck]."' where lv001='".$vrow['CodeID']."' and lv007=''";
					}
					else
					{
						
						$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' ";
					}
				}
				else				
					$vsql="update tc_lv0011 set lv007='".$vTimeCardID."' where lv001='".$vrow['CodeID']."' ";
				db_query($vsql);
			}
			else
			{
				if($vState==1)
					{
					$vsql="update tc_lv0011 set lv007='' where lv001='".$vrow['CodeID']."' ";
				}
				db_query($vsql);
			}
		}
	}
	function LV_CheckLateSoon($NVID,$shiftDay,$shiftYear,$ArrTime,$vDOW)
	{
		if($shiftDay=="" && $shiftYear=="") $shiftDay="CAHC";
		if($shiftDay!="" && $shiftDay!=NULL)
		{
			//Lay gio ca
			$sqlShift = "select * from tc_lv0004 where lv001='$shiftDay'";
			$db_Shift = db_query($sqlShift);
			$objShift = db_fetch_array ($db_Shift);
			$shift_start=(int)str_replace(":","",$objShift['lv003']);
			$shift_end=(int)str_replace(":","",(($vDOW==7)?$objShift['lv006']:$objShift['lv004']));
			$passday=($shift_start>$shift_end)?1:0;
			//Kiem tra gio vao ra theo ca
			if(count($ArrTime)<2) return 4;
			if($passday==0)
			{
				if($ArrTime[0]>$shift_start && $ArrTime[1]<$shift_end)
					return 3;//Vao trễ và ra sớm
				else if ($ArrTime[0]>$shift_start)
					return 1;//Vào trễ
				else if($ArrTime[1]<$shift_end)
				 	return 2;//Ra sớm
				else
					return 0;
			}
			else
			{
				if($ArrTime[1]>$shift_start && $ArrTime[0]<$shift_end)
					return 3;//Vao trễ và ra sớm
				else if ($ArrTime[1]>$shift_start)
					return 1;//Vào trễ
				else if($ArrTime[0]<$shift_end)
				 	return 2;//Ra sớm
				else
					return 0;
			}
			
			
		}
		else if($shiftYear!="" && $shiftYear!=NULL)
		{
			//Lay gio ca
			$sqlShift = "select * from tc_lv0004 where lv001='$shiftYear'";
			$db_Shift = db_query($sqlShift);
			$objShift = db_fetch_array ($db_Shift);
			$shift_start=(int)str_replace(":","",$objShift['lv003']);
			$shift_end=(int)str_replace(":","",(($vDOW==7)?$objShift['lv006']:$objShift['lv004']));
			$passday=($shift_start>$shift_end)?1:0;
			//Kiem tra gio vao ra theo ca
			if(count($ArrTime)<2) return 4; 
			if($passday==0)
			{
				if($ArrTime[0]>$shift_start && $ArrTime[1]<$shift_end)
					return 3;//Vao trễ và ra sớm
				else if ($ArrTime[0]>$shift_start)
					return 1;//Vào trễ
				else if($ArrTime[1]<$shift_end)
				 	return 2;//Ra sớm
				else
					return 0;
			}
			else
			{
				if($ArrTime[1]>$shift_start && $ArrTime[0]<$shift_end)
					return 3;//Vao trễ và ra sớm
				else if ($ArrTime[1]>$shift_start)
					return 1;//Vào trễ
				else if($ArrTime[0]<$shift_end)
				 	return 2;//Ra sớm
				else
					return 0;
			}
		}
		else
		{
			return 5;
		}
	}
	function GetTimeListArr($vlv001,$vlv002)
	{
		$strReturn=array();
		$lvsql="select lv003,lv005 from  tc_lv0012 Where lv001='$vlv001' and lv002='$vlv002'  and lv006<>1 order by lv003 ASC";
		$vresult=db_query($lvsql);
		$count=db_num_rows($vresult);
		if($vresult){
			$i=1;
			while($vrow=db_fetch_array($vresult))
			{
				if(($i==1))
				{
					$strReturn[0]=(int)str_replace(":","",$vrow['lv003']);
				}
				else if($i==$count)
				{
					$strReturn[1]=(int)str_replace(":","",$vrow['lv003']);
				}
			$i++;
			}
		}
		return $strReturn;
	}
	function GetShift()
	{
		$vsql="select A.lv001,A.lv003,A.lv004,(TIMEDIFF(A.lv004,A.lv003)<=0) PareTime from tc_lv0004 A";
		$vResult=db_query($vsql);
		while($vrow=db_fetch_array($vResult))
		{
			if($vrow['PareTime']>0)
			{
				$this->ShiftOneDay=$this->ShiftOneDay+$vrow['lv001']+"@";
			}
			else
			{
				$this->ShiftTwoDay=$this->ShiftTwoDay+$vrow['lv001']+"@";	
			}
		}
	}
	function LV_TachArr($vArrShiftTime)
	{
		//print_r($vArrShiftTime);
		$vArrReturn=Array();
		$vCount=0;
		$vj=0;
		foreach($vArrShiftTime as $vShift)
		{
			$vArrReturn[$vCount][$vj]=$vShift[0];
			$vj++;
			if($vj%2==0)
			{
				$vCount++;
				$vj=0;
			}
			
			
		}
		return $vArrReturn;
	}
//Bộ tính tăng ca import()
	function LV_GetTangCaImp($vDate,$vArrTimeTC)
	{
	}
//Bộ xử lý phân tích giờ theo ca
	function ProcessTime($vEmpID,$vArrTime,$vArrShift,$vShiftCal,$vShift,$vListShiftReceive)
	{
		$vStatus=$vArrTime[99][0][0];
	//	if($vShiftCal==1)
	//	{
			
			//$vStatus=$vArrShift[0]['NS-'.$vShift][0];
		//	echo 'là sao?'.$vStatus."?";
		//}
	 	$vCount=count($vArrTime[0]);
		$vArrReturn=Array();
		//Ca trong ngày
		if($vStatus==0)
		{
			//$vStartTime=$vArrReturn['GioVao'];
			//$vEndTime=$vArrReturn['GioRa'];
			if($vShiftCal==1)
			{
			$vArrReturn['CaIn']=$vShift;
			$vArrReturn['CaOut']=$vShift;
			$vArrReturn['GioVao']=$vArrTime[0][0][0];
			$vArrReturn['GioRa']=$vArrTime[0][$vCount-1][0];
			}
			else
			{
				$vArrReturn= $this->CheckInShiftFirst($vArrTime,$vArrShift,$vListShiftReceive);
			}
			$vFreeTime=$vArrShift[0]['CA-'.$vArrReturn['CaIn']][5];
			$vArrReturn['FreeTime']=$vFreeTime;
			$vStartTime=$vArrShift[0]['IN-'.$vArrReturn['CaIn']][3];
			$vEndTime=$vArrShift[0]['OUT-'.$vArrReturn['CaIn']][4];			
			$vStartTime1='00:00:00';
			$vArrReturn['FreeTimeStart']=$vArrShift[0]['GAYO-'.$vArrReturn['CaIn']][6];
			$vEndTime1='00:00:00';
			$vArrReturn['FreeTimeEnd']=$vArrShift[0]['GAYT-'.$vArrReturn['CaIn']][7];	
			$vGay=$vArrShift[0]['GAY-'.$vArrReturn['CaIn']][1];
			$vArrShiftTime=Array();
			$io=0;
			if($vCount>0)
			{
				$vTru=false;
				if(count($vArrTime[0])%2==1) $vTru=true; 
				foreach($vArrTime[0]  as $vTime)
				{
					if($vStartTime>$vTime[0])
					{
						$vTime[0]=$vStartTime;
					}
					if($vEndTime<$vTime[0])
					{
						$vTime[0]=$vEndTime;
					}
					if((count($vArrTime[0])-1)==$io && $vTru==true && $io>0)
					{
						$vArrShiftTime[$io-1]=$vTime[0];
					}
					else
						$vArrShiftTime[$io]=$vTime[0];
					$io++;
				}
				$vCount=count($vArrShiftTime);
				if($vGay==1)
				{
				
				$vArr2Time=$this->LV_TachArr($vArrTime[0]);
				
				$vArrRA22h=$this->CheckInShift($vArr2Time[0],$vStartTime,$vEndTime,count($vArr2Time[0]),$vFreeTime);
				$vArrReturn['GioLam']=$vArrRA22h[0];
				$vArrReturn['Time22h']=$vArrRA22h[1];
				$vArrReturn['GioLamThuc']=$vArrRA22h[2];
				
				if(count($vArr2Time[1])>0)
				{
				/*echo $vEmpID.":";
				print_r($vArr2Time[1]);
				echo "$vStartTime1,$vEndTime1";
				echo "<br/>";*/
				$vArrRA22h1=$this->CheckInShift($vArr2Time[1],$vStartTime1,$vEndTime1,count($vArr2Time[1]),'00:00:00');
				
				$vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vArrRA22h1[0]);
				//echo "vinhne:".$vArrReturn['GioLam'].','.$vArrRA22h1[0]."=".$vArrReturn['GioLam']."<br>";
				$vArrReturn['Time22h']=TIMEADD($vArrReturn['Time22h'],$vArrRA22h1[1]);
				}
				}
				else
				{
					//print_r($vArrShiftTime);
					if($vFreeTime!='00:00:00')
					{
						$vFW=$this->GetTime($vFreeTime);
						$vMaxTime=$this->GetTime(TIMEDIFF($vEndTime,$vStartTime))-$this->GetTime($vFreeTime);
						$vArrRA22h=$this->CheckInShift($vArrShiftTime,$vStartTime,$vEndTime,$vCount,$vFreeTime);
						$vHW=$this->GetTime($vArrRA22h[0]);
						//Nếu Giờ làm tính < giờ làm /2 thì 
						//echo "$vHW<($vMaxTime-$vFW)/2";
						/*if($vHW<($vMaxTime-$vFW)/2)
						{
							if(($vHW+$vFW)>=($vMaxTime-$vFW)/2)
							{
								///CHo phép được nữa công
								$vArrRA22h[0]=$this->GetTimeDiv2(TIMEDIFF(TIMEDIFF($vEndTime,$vStartTime),$vFreeTime));
							}
						}*/
						$vArrReturn['GioLam']=$vArrRA22h[0];
						$vArrReturn['Time22h']=$vArrRA22h[1];
						$vArrReturn['GioLamThuc']=$vArrRA22h[2];
					}
					else
					{
						$vArrRA22h=$this->CheckInShift($vArrShiftTime,$vStartTime,$vEndTime,$vCount,$vFreeTime);
						$vArrReturn['GioLam']=$vArrRA22h[0];
						$vArrReturn['Time22h']=$vArrRA22h[1];
						$vArrReturn['GioLamThuc']=$vArrRA22h[2];
					}
				}
			}
			else
			{
				$vArrReturn['GioLam']=0;
			}
			
		}
		else//Ca thuộc hai ngày
		{
			
			$visNotNight=false;//Trường hợp làm qua đêm, nhưng ko đủ giờ, vẫn còn trong ngày
			$vCount=count($vArrTime[0]);
			if($vShiftCal==1)
			{
				$vArrReturn['CaIn']=$vShift;
				$vArrReturn['CaOut']=$vShift;				
				if($vCount==1 && str_replace(":","",$vArrTime[0][0][0])>=150000)
				{
					$vArrReturn['GioVao']=$vArrTime[0][0][0];
				}
				else
				{
					$vArrReturn['GioVao']=$vArrTime[0][1][0];
				}
				if($vArrReturn['GioVao']==NULL || $vArrReturn['GioVao']=="")
					$vArrReturn['GioRa']='';
				else
				{
					$intEndTime=str_replace(":","",$vArrShift[0]['OUT-'.$vArrReturn['CaIn']][4])+40500;			
					if($intEndTime>=str_replace(":","",$vArrTime[1][0][0]))
						$vArrReturn['GioRa']=$vArrTime[1][0][0];
					else
					{
						if($vCount==2)
						{
							$vArrReturn['GioVao']=$vArrTime[0][0][0];
							$vArrReturn['GioRa']=$vArrTime[0][1][0];
							if((float) TIMEDIFF($vArrReturn['GioRa'],$vArrReturn['GioVao'])<8)
								$visNotNight=true;
							else
								$visNotNight=false;
						}
						else
						$vArrReturn['GioVao']=$vArrReturn['GioRa']='';
					}
				}
				/*
				$vArrReturn['CaIn']=$vShift;
				$vArrReturn['CaOut']=$vShift;				
				if($vCount==1)
				{
					if(str_replace(":","",$vArrTime[0][0][0])>=150000)
						$vArrReturn['GioVao']=$vArrTime[0][0][0];
					else
						$vArrReturn['GioVao']='';
					if($vArrReturn['GioVao']==NULL || $vArrReturn['GioVao']=="")
						$vArrReturn['GioRa']='';
					else
						$vArrReturn['GioRa']=$vArrTime[1][0][0];
				}
				elseif($vCount==2)
				{
					$vArrReturn['GioVao']=$vArrTime[0][0][0];
					$vArrReturn['GioRa']=$vArrTime[0][1][0];
					$visNotNight=true;
				}
				*/
			}
			else
			{
				$vArrReturn= $this->CheckOutShiftFirst($vArrTime,$vArrShift,$vListShiftReceive);
				$vStartTime=$vArrReturn['GioVao'];
				$vEndTime=$vArrReturn['GioRa'];
				//echo $vArrReturn['CaIn']."<br/>";
			}
			$vFreeTime=$vArrShift[0]['CA-'.$vArrReturn['CaIn']][5];
			$vFreeTime=$vArrShift[0]['CA-'.$vArrReturn['CaIn']][5];
			$vStartTime=$vArrShift[0]['IN-'.$vArrReturn['CaIn']][3];
			$vEndTime=$vArrShift[0]['OUT-'.$vArrReturn['CaIn']][4];		
			$vArrReturnIn=$this->LV_CheckTimeInDay($vArrTime,$vStartTime,'24:00:00',$vFreeTime);
			if($vShiftCal==1)
			{
				$vArrReturnIn['CaIn']=$vShift;
				$vArrReturnIn['CaOut']=$vShift;				
			}
			$vArrShiftTime=Array();
			$io=0;
			if($vCount>0)
			{

				$vArrShiftTime[0]=$vArrReturn['GioVao'];
				$vArrShiftTime[1]=$vArrReturn['GioRa'];
				$vCount=count($vArrShiftTime);
				if($vArrShiftTime[1]!='' && ($vArrShiftTime[0]!=NULL && $vArrShiftTime[0]!=""))
				{
					if($visNotNight==true)
						$vArrRA22h=$this->CheckInShift($vArrShiftTime,$vStartTime,'23:59:59',$vCount,$vFreeTime);
					else
					$vArrRA22h=$this->CheckOutShift($vArrShiftTime,$vStartTime,$vEndTime,$vCount,$vFreeTime);
					$vArrReturn['GioLam']=$vArrRA22h[0];
					$vArrReturn['Time22h']=$vArrRA22h[1];
					$vArrReturn['GioLamThuc']=$vArrRA22h[2];
				}
				else
				{
					$vArrReturn['GioLam']=0;
					$vArrReturn['Time22h']=0;
					$vArrReturn['GioLamThuc']=0;
				}
				/*echo $vEmpID.":";
				print_r($vArrShiftTime);
				echo "<:> $vStartTime,$vEndTime";
				echo "<br/>";
				echo "vinhne:".$vArrReturn['GioLam'];*/
			}
			else
			{
				$vArrReturn['GioLam']=0;
				$vArrReturn['Time22h']=0;
				$vArrReturn['GioLamThuc']=0;
			}
			if($vArrReturnIn['GioLam']>=$vArrReturn['GioLam'])
				$vArrReturn=$vArrReturnIn;
		}
		return $vArrReturn;
	}	
	function ProcessTimeKho($vEmpID,$vArrTime,$vArrShift,$vShiftCal,$vShift,$vListShiftReceive)
	{
		$vStatus=$vArrTime[99][0][0];
	//	if($vShiftCal==1)
	//	{
			
			//$vStatus=$vArrShift[0]['NS-'.$vShift][0];
		//	echo 'là sao?'.$vStatus."?";
		//}
	 	$vCount=count($vArrTime[0]);
		$vArrReturn=Array();
		//Ca trong ngày
		if($vStatus==0)
		{
			//$vStartTime=$vArrReturn['GioVao'];
			//$vEndTime=$vArrReturn['GioRa'];
			if($vShiftCal==1)
			{
			$vArrReturn['CaIn']=$vShift;
			$vArrReturn['CaOut']=$vShift;
			$vArrReturn['GioVao']=$vArrTime[0][0][0];
			$vArrReturn['GioRa']=$vArrTime[0][$vCount-1][0];
			}
			else
			{
				$vArrReturn= $this->CheckInShiftFirst($vArrTime,$vArrShift,$vListShiftReceive);
			}
			$vFreeTime=$vArrShift[0]['CA-'.$vArrReturn['CaIn']][5];
			$vArrReturn['FreeTime']=$vFreeTime;
			$vStartTime=$vArrShift[0]['IN-'.$vArrReturn['CaIn']][3];
			$vEndTime=$vArrShift[0]['OUT-'.$vArrReturn['CaIn']][4];			
			$vStartTime1='00:00:00';
			$vArrReturn['FreeTimeStart']=$vArrShift[0]['GAYO-'.$vArrReturn['CaIn']][6];
			$vEndTime1='00:00:00';
			$vArrReturn['FreeTimeEnd']=$vArrShift[0]['GAYT-'.$vArrReturn['CaIn']][7];	
			$vGay=$vArrShift[0]['GAY-'.$vArrReturn['CaIn']][1];
			$vArrShiftTime=Array();
			$io=0;
			if($vCount>0)
			{
				//echo count($vArrTime[0]).'<br/>';
				$vArrTimeReturn=$vArrTime[0];
				$vTimePre='00:00:00';
				$vTimInOut=0;
				foreach($vArrTimeReturn  as $vTime)
				{
					if($vStartTime>$vTime[0])
					{
						$vTime[0]=$vStartTime;
					}
					if($vEndTime<$vTime[0])
					{
						$vTime[0]=$vEndTime;
					}
					//echo $vArrReturn['GioLam']."<br>";
					//Dò 1 giờ vào và 1 giờ ra kế tiếp thì mới đưa vào tính
					if($vTimePre>$vTime[0])
						$isGioLamHon=true;
					else
						$isGioLamHon=($vTime[0]>=$vEndTime)?true:false;
					$vTimInOut++;
					//echo $vTime[0].' ==> ';
					if($vTimInOut==2)
					{
						//echo "VINH: $vEndTime>$vStartTime <br/>";
						$vRun=true;
						if($vEndTime>$vStartTime)
						{
							//Xác định giờ nằm ngoài
							if($vTimePre>$vEndTime) $vRun=false;
						}
						else
						{
							//Xác định giờ khung giờ ngoài
							if($vTimePre>$vEndTime && $vTime[0]<$vStartTime) $vRun=false;
						}
						$vTimInOut=0;
						if($vRun)
						{
							//Nếu không có giờ ra.
							if($vFreeTime=='00:00:00' || trim($vFreeTime)=='' || $vFreeTime==NULL)
							{
								//Nếu vào nhỏ hơn giờ làm tính đủ vào
								if($vStartTime>=$vTimePre)
								{
									//Nếu giờ ra lớn giớ giờ ra qui định thì tính đủ
									if($vTime[0]>=$vEndTime || $vTimePre>$vTime[0])
									{
										$vTimeTinh=TIMEDIFF($vEndTime,$vStartTime);
										if(strpos($vTimeTinh,'-')===false) $vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vTimeTinh);
									}
									else //Ngược lại thì không đủ giờ làm
									{
										//Có thể lấy điều kiện để tính đủ giờ tại đây
										$vTimeTinh=TIMEDIFF($vTime[0],$vStartTime);
										if(strpos($vTimeTinh,'-')===false) $vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vTimeTinh);
									}
								}
								else
								{
									if($vTime[0]>=$vEndTime || $vTimePre>$vTime[0])
									{
										//Có thể lấy điều kiện để tính đủ giờ tại đây
										$vTimeTinh=TIMEDIFF($vEndTime,$vTimePre);
										if(strpos($vTimeTinh,'-')===false) $vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vTimeTinh);
									}
									else //Ngược lại thì không đủ giờ làm
									{
										//Có thể lấy điều kiện để tính đủ giờ tại đây
										$vTimeTinh=TIMEDIFF($vTime[0],$vTimePre);
										if(strpos($vTimeTinh,'-')===false) $vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vTimeTinh);
									}
								}
							}
							else
							{
								//Hiện tại có 4 đoạn
								//Đoạn 1, Và ngoài 1
								if($vStartTime1>=$vTimePre)
								{
									$vGioDau=($vStartTime>$vTimePre)?$vStartTime:$vTimePre;
									//Nếu giờ ra lớn giớ giờ ra qui định thì tính đủ
									if($vTime[0]>=$vEndTime || $vTimePre>$vTime[0])
									{
										$vTimeTinh=TIMEDIFF(TIMEDIFF($vEndTime,$vGioDau),$vFreeTime);
										if(strpos($vTimeTinh,'-')===false) $vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vTimeTinh);
									}
									else //Ngược lại thì không đủ giờ làm
									{
										//Có thể lấy điều kiện để tính đủ giờ tại đây
										if($vTime[0]>=$vEndTime1)
										{
											$vTimeTinh=TIMEDIFF(TIMEDIFF($vTime[0],$vGioDau),$vFreeTime);
											if(strpos($vTimeTinh,'-')===false)  $vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vTimeTinh);
										}
										elseif($vTime[0]>=$vStartTime1)
										{
											$vTimeTinh=TIMEDIFF($vStartTime1,$vGioDau);
											if(strpos($vTimeTinh,'-')===false)  $vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vTimeTinh);
										}
										else
										{
											$vTimeTinh=TIMEDIFF($vTime[0],$vGioDau);
											if(strpos($vTimeTinh,'-')===false)  $vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vTimeTinh);
										}
										
									}
								}
								else //Đoạn 3, Và ngoài 3 là 2
								{
									$vGioDau=($vEndTime1>$vTimePre)?$vEndTime1:$vTimePre;
									//if($vEndTime1>=$vTimePre)
									{
										//Nếu giờ ra lớn giớ giờ ra qui định thì tính đủ
										if($vTime[0]>=$vEndTime || $vTimePre>$vTime[0])
										{
											$vTimeTinh=TIMEDIFF($vEndTime,$vGioDau);
										if(strpos($vTimeTinh,'-')===false)  $vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vTimeTinh);
										}
										else //Ngược lại thì không đủ giờ làm
										{
											$vTimeTinh=TIMEDIFF($vTime[0],$vGioDau);
											if(strpos($vTimeTinh,'-')===false)  $vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],$vTimeTinh);
										}
									}
									/*else
									{
										if($vTime[0]>=$vEndTime)
										{
											$vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],TIMEDIFF($vEndTime,$vGioDau));
										}
										else //Ngược lại thì không đủ giờ làm
										{
											$vArrReturn['GioLam']=TIMEADD($vArrReturn['GioLam'],TIMEDIFF($vTime[0],$vGioDau));
										}
									}*/
								}
							}
						}
					}	
					$vTimePre=$vTime[0];
				}
			}
			else
			{
				$vArrReturn['GioLam']=0;
			}
		}
		else//Ca thuộc hai ngày
		{
			
			$visNotNight=false;//Trường hợp làm qua đêm, nhưng ko đủ giờ, vẫn còn trong ngày
			$vCount=count($vArrTime[0]);
			if($vShiftCal==1)
			{
				$vArrReturn['CaIn']=$vShift;
				$vArrReturn['CaOut']=$vShift;				
				if($vCount==1 && str_replace(":","",$vArrTime[0][0][0])>=150000)
				{
					$vArrReturn['GioVao']=$vArrTime[0][0][0];
				}
				else
				{
					$vArrReturn['GioVao']=$vArrTime[0][1][0];
				}
				if($vArrReturn['GioVao']==NULL || $vArrReturn['GioVao']=="")
					$vArrReturn['GioRa']='';
				else
				{
					$intEndTime=str_replace(":","",$vArrShift[0]['OUT-'.$vArrReturn['CaIn']][4])+40500;			
					if($intEndTime>=str_replace(":","",$vArrTime[1][0][0]))
						$vArrReturn['GioRa']=$vArrTime[1][0][0];
					else
					{
						if($vCount==2)
						{
							$vArrReturn['GioVao']=$vArrTime[0][0][0];
							$vArrReturn['GioRa']=$vArrTime[0][1][0];
							if((float) TIMEDIFF($vArrReturn['GioRa'],$vArrReturn['GioVao'])<8)
								$visNotNight=true;
							else
								$visNotNight=false;
						}
						else
						$vArrReturn['GioVao']=$vArrReturn['GioRa']='';
					}
				}
				/*
				$vArrReturn['CaIn']=$vShift;
				$vArrReturn['CaOut']=$vShift;				
				if($vCount==1)
				{
					if(str_replace(":","",$vArrTime[0][0][0])>=150000)
						$vArrReturn['GioVao']=$vArrTime[0][0][0];
					else
						$vArrReturn['GioVao']='';
					if($vArrReturn['GioVao']==NULL || $vArrReturn['GioVao']=="")
						$vArrReturn['GioRa']='';
					else
						$vArrReturn['GioRa']=$vArrTime[1][0][0];
				}
				elseif($vCount==2)
				{
					$vArrReturn['GioVao']=$vArrTime[0][0][0];
					$vArrReturn['GioRa']=$vArrTime[0][1][0];
					$visNotNight=true;
				}
				*/
			}
			else
			{
				$vArrReturn= $this->CheckOutShiftFirst($vArrTime,$vArrShift,$vListShiftReceive);
				$vStartTime=$vArrReturn['GioVao'];
				$vEndTime=$vArrReturn['GioRa'];
				//echo $vArrReturn['CaIn']."<br/>";
			}
			$vFreeTime=$vArrShift[0]['CA-'.$vArrReturn['CaIn']][5];
			$vFreeTime=$vArrShift[0]['CA-'.$vArrReturn['CaIn']][5];
			$vStartTime=$vArrShift[0]['IN-'.$vArrReturn['CaIn']][3];
			$vEndTime=$vArrShift[0]['OUT-'.$vArrReturn['CaIn']][4];		
			$vArrReturnIn=$this->LV_CheckTimeInDay($vArrTime,$vStartTime,'24:00:00',$vFreeTime);
			if($vShiftCal==1)
			{
				$vArrReturnIn['CaIn']=$vShift;
				$vArrReturnIn['CaOut']=$vShift;				
			}
			$vArrShiftTime=Array();
			$io=0;
			if($vCount>0)
			{
				$vArrShiftTime[0]=$vArrReturn['GioVao'];
				if($vCount>1) 
					$vArrShiftTime[count($vArrShiftTime)-1]=$vArrReturn['GioRa'];
				else
					$vArrShiftTime[1]='';
				$vCount=count($vArrShiftTime);
				if($vArrShiftTime[1]!='' && ($vArrShiftTime[0]!=NULL && $vArrShiftTime[0]!=""))
				{
					if($visNotNight==true)
						$vArrRA22h=$this->CheckInShift($vArrShiftTime,$vStartTime,'23:59:59',$vCount,$vFreeTime);
					else
					$vArrRA22h=$this->CheckOutShift($vArrShiftTime,$vStartTime,$vEndTime,$vCount,$vFreeTime);
					$vArrReturn['GioLam']=$vArrRA22h[0];
					$vArrReturn['Time22h']=$vArrRA22h[1];
					$vArrReturn['GioLamThuc']=$vArrRA22h[2];
				}
				else
				{
					$vArrReturn['GioLam']=0;
					$vArrReturn['Time22h']=0;
					$vArrReturn['GioLamThuc']=0;
				}
				/*echo $vEmpID.":";
				print_r($vArrShiftTime);
				echo "<:> $vStartTime,$vEndTime";
				echo "<br/>";
				echo "vinhne:".$vArrReturn['GioLam'];*/
			}
			else
			{
				$vArrReturn['GioLam']=0;
				$vArrReturn['Time22h']=0;
				$vArrReturn['GioLamThuc']=0;
			}
			if($vArrReturnIn['GioLam']>=$vArrReturn['GioLam'])
				$vArrReturn=$vArrReturnIn;
		}
		return $vArrReturn;
	}	
	function LV_CheckTimeInDay($vArrTime,$vStartTime,$vEndTime,$vFreeTime)
	{
		if($vArrTime<=1)
		{
			return false;
		}
		else
		{
			$i=0;
			if(count($vArrTime[0])>0)
			{
			foreach($vArrTime[0] as $Time)
			{
				if($i==0)
				$vArrShiftTime[0]=$Time[0];
				else
				$vArrShiftTime[1]=$Time[0];
				$i++;
			}
			}
		}
		$vArrRA22h=$this->CheckInShift($vArrShiftTime,$vStartTime,$vEndTime,$i,$vFreeTime);
		$vArrReturn['GioLam']=$vArrRA22h[0];
		$vArrReturn['Time22h']=$vArrRA22h[1];
		return $vArrReturn;
	}
	function CheckInShift($vArrTime,$vStartTime,$vEndTime,$vCount,$vFreeTime)
	{
		$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
		$motc_lv0004->EndTime=$vEndTime;
		$motc_lv0004->StartTime=$vStartTime;
		$vRegHours="00:00:00";
		$vTime22h="00:00:00";
		$vRegHoursReal="00:00:00";
		if($vCount==0 || $vCount==1) $vRegHours;		
		//Even
		$i=0;
		if(($vCount%2)==0)
		{
			for($i=0;$i<$vCount;$i++)
			{	
				//echo 'A:';
				//echo $vArrTime[$i].",".$vArrTime[$i+1].",0,$vFreeTime";
				//	echo "<br/>";
				$vCalTime=$motc_lv0004->LV_GetTimeShift($vArrTime[$i],$vArrTime[$i+1],0,$vFreeTime,$vRealTime);
				$vRegHours=TIMEADD($vCalTime,$vRegHours);	
				$vRegHoursReal=TIMEADD($vRealTime,$vRegHoursReal);	
				$vTimeF=str_replace(":","",$vArrTime[$i]);
				if($vTimeF>220000)
				{
					//echo "$vTime22h,$vCalTime";
					$vTime22h=TIMEADD($vTime22h,$vCalTime);
				}
				else
				{
					$vTimeS=str_replace(":","",$vArrTime[$i+1]);
					if($vTimeS>220000)
					{
						$vTime22h=TIMEADD($vTime22h,TIMEDIFF($vArrTime[$i+1],'22:00:00'));
					}
				}
				$i++;
			}
		}
		else//Uneven
		{
			//kiểm tra xem có giờ nào thuộc khoảng giờ qui định công ty không. 
			if($this->CheckInShiftBelong($vArrTime,$vStartTime,$vEndTime,$vCount))
				 $vRegHours="00:00:00";
			else
				{
					if($vCount==1)
					{
						$motc_lv0004->LV_GetTimeShift($vArrTime[0],$vEndTime,0,$vFreeTime)	;
					}
					else
					{
						for($i=0;$i<$vCount;$i=$i+2)
						{
							$vCalTime=$motc_lv0004->LV_GetTimeShift($vArrTime[$i],$vArrTime[$i+1],0,$vFreeTime,$vRealTime);
							$vRegHours=TIMEADD($vCalTime,$vRegHours);	
							$vRegHoursReal=TIMEADD($vRealTime,$vRegHoursReal);	
							$vTimeF=str_replace(":","",$vArrTime[$i]);
							if($vTimeF>220000)
							{
								$vTime22h=TIMEADD($vTime22h,$vCalTime);
							}
							else
							{
								$vTimeS=str_replace(":","",$vArrTime[$i+1]);
								if($vTimeS>220000)
								{
									$vTime22h=TIMEADD($vTime22h,TIMEDIFF($vArrTime[$i+1],'22:00:00'));
								}
							}
						}						
					}
				}
		}
		$vReturn=Array();
		$vReturn[0]=$vRegHours;
		$vReturn[1]=$vTime22h;
		$vReturn[2]=$vRegHoursReal;
		return $vReturn;
		
	}
	function CheckInShiftBelong($vArrTime,$vStartTime,$vEndTime,$vCount)
	{
		for($i=0;$i<$vCount;$i++)
		{
			if(!(CompareTime(	$vArrTime[$i],$vEndTime) || CompareTime($vStartTime,$vArrTime[$i]))) return false;
		}	
		return true;
		
	}
	function  CheckOutShift($vArrTime,$vStartTime,$vEndTime,$vCount,$vFreeTime)
	{
		$motc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
		$motc_lv0004->EndTime=$vEndTime;
		$motc_lv0004->StartTime=$vStartTime;
		$vRegHours="00:00:00";
		$vTime22h="00:00:00";
		if($vCount==0 || $vCount==1) $vRegHours;		
		//Even
		if(($vCount%2)==0)
		{
			for($i=0;$i<$vCount;$i++)
			{
				if($i==0 )
				{
					$vCalTime=$motc_lv0004->LV_GetTimeShift($vArrTime[$i],"24:00:00",1,$vFreeTime);
					$vRegHours=TIMEADD($vCalTime,$vRegHours);
					$vTimeF=str_replace(":","",$vArrTime[$i]);
					if($vTimeF>=220000)
					{
						$vTime22h=TIMEADD($vTime22h,$vCalTime);
					}
					else
					{
						$vTime22h=TIMEADD($vTime22h,'02:00:00');
					}
				}
				 else if($i==($vCount-1))
				 {
					$vCalTime=$motc_lv0004->LV_GetTimeShift("00:00:00",$vArrTime[$i],1);
					$vRegHours=TIMEADD($vCalTime,$vRegHours);
					$vTime22h=TIMEADD($vTime22h,$vArrTime[$i]);
				 }
				else
				{
					$vCalTime=$motc_lv0004->LV_GetTimeShift($vArrTime[$i],$vArrTime[$i+1],0,$vFreeTime);
					$vRegHours=TIMEADD($vCalTime,$vRegHours);
					$vTimeF=str_replace(":","",$vArrTime[$i]);
					if($vTimeF>220000)
					{
						$vTime22h=TIMEADD($vTime22h,$vCalTime);
					}
					else
					{
						$vTimeS=str_replace(":","",$vArrTime[$i+1]);
						if($vTimeS>220000)
						{
							$vTime22h=TIMEADD($vTime22h,TIMEDIFF($vArrTime[$i+1],'22:00:00'));
						}
					}
					$i++;
				}
			}			
		}
			else//Uneven
		{
			//kiểm tra xem có giờ nào thuộc khoảng giờ qui định công ty không. 
			if($this->CheckOutShiftBelong($vArrTime,$vStartTime,$vEndTime,$vCount))
				 $vRegHours="00:00:00";
			else
				{
					if($vCount==1)
					{
						$vCalTime=$motc_lv0004->LV_GetTimeShift("00:00:00",$vArrTime[0],0,$vFreeTime)	;
						$vTimeF=str_replace(":","",$vArrTime[$i]);
						if($vTimeF>=220000)
						{
							$vTime22h=TIMEADD($vTime22h,$vCalTime);
						}
						else
						{
							$vTime22h=TIMEADD($vTime22h,'02:00:00');
						}
						
					}
					else
					{
						for($i=0;$i<$vCount;$i=$i+2)
						{
						//Chú ý buil lại
							$vCalTime=$motc_lv0004->LV_GetTimeShift($vArrTime[$i],$vArrTime[$i+1],0,$vFreeTime);
							$vRegHours=TIMEADD($vCalTime,$vRegHours);	
							$vTimeF=str_replace(":","",$vArrTime[$i]);
							if($vTimeF>220000)
							{
								$vTime22h=TIMEADD($vTime22h,$vCalTime);
							}
							else
							{
								$vTimeS=str_replace(":","",$vArrTime[$i+1]);
								if($vTimeS>220000)
								{
									$vTime22h=TIMEADD($vTime22h,TIMEDIFF($vArrTime[$i+1],'22:00:00'));
								}
							}
						}						
					}
				}
		}	
		$vReturn=Array();
		$vReturn[0]=$vRegHours;
		$vReturn[1]=$vTime22h;
		return $vReturn;
	}
	function CheckOutShiftBelong($vArrTime,$vStartTime,$vEndTime,$vCount)
	{
		for($i=0;$i<$vCount;$i++)
		{
			if(!(CompareTime($vArrTime[$i],$vStartTime) && CompareTime($vEndTime,$vArrTime[$i]))) return false;
		}	
		return true;
		
	}	
	//Hàm kiểm tra xem tất cả giờ vào ra điều 
	function  CheckInShiftFirst($vArrTime,$vArrShift,$vListShiftReceive)
	{
		//Xác định giờ đầu, giờ kết thúc.
		$vCurArrTime=Array();
		$vCount=count($vArrTime[0]);
		$vArrReturn=Array();
		if($vCount>1)
		{
			$vShift=Array();
			$vStartTime=$vArrTime[0][0][0];
			$vEndTime=$vArrTime[0][$vCount-1][0];
			$vShift=$this->ConfirmShift($vArrShift,$vStartTime,$vEndTime,$vListShiftReceive);
			$vArrReturn['CaIn']=$vShift['In'];
			$vArrReturn['CaOut']=$vShift['Out'];
			$vArrReturn['GioVao']=$vStartTime;
			$vArrReturn['GioRa']=$vEndTime;
		}
		else
		{
			$vArrReturn['CaIn']='';
			$vArrReturn['CaOut']='';
		}
		return $vArrReturn;
		
	}
	function ConfirmShift($vArrShift,$vStartTime,$vEndTime,$vListShiftReceive)
	{
		//trả về 2 trạng thái
		//Ca làm việc
		//Từ giờ starttime xác định vị trí ca.
		$vShift=Array();
		$vStartInt=(int)str_replace(":","",$vStartTime);
		$vEndInt=(int)str_replace(":","",$vEndTime);
		$vShiftIn='';
		$vShiftOut='';
		$vDistantInSizeStart=0;
		$vDistantInSizeStartEnd=0;
		$vStartTrue=false;
		$vEndTrue=false;
		foreach($vArrShift as $vShift)
		{
			//echo ',,'.$vListShiftReceive.',',',vinh'.$vShift[1][0].'vinh,='.strpos(',,'.$vListShiftReceive.',',','.$vShift[1][0].',').'<br/>';
			if($vListShiftReceive=="" || (strpos(',,'.$vListShiftReceive.',',','.$vShift[1][0].',')>0))
			{
				//Ca đầu xác định ca làm việc
				$vShiftLast=$vShift[1][0];
				if($vStartTrue==false)
				{
					if($vStartInt<=$vShift[3][1])
					{
						$vStartTrue=true;
						if($vDistantInSizeStart==0)
						{
							$vShiftIn=$vShift[1][0];
						}
						else
						{
							$vUutien=false;
							$vTimeDiv="00:00:00";
							if($vStartInt>=$vShift[3][1])
								$vDistantInSizeStartNew=strtotime($vStartTime)-strtotime($vShift[3][0]);
							else
							{
								$vUutien=true;
								$vTimeDiv=TIMEDIFF($vShift[3][0],$vStartTime);
								$vDistantInSizeStartNew=strtotime($vShift[3][0])-strtotime($vStartTime);
							}
							if($vUutien)
							{
								//Xét số phút nhận
								//Mai làm
								if($vTimeDiv<='00:30:00')
									$vShiftIn=$vShift[1][0];
								else
									if($vDistantInSizeStartNew<$vDistantInSizeStart) $vShiftIn=$vShift[1][0];
							}
							else
								if($vDistantInSizeStartNew<$vDistantInSizeStart) $vShiftIn=$vShift[1][0];
						}
						if($vStartInt>=$vShift[3][1])
							$vDistantInSizeStart=strtotime($vStartTime)-strtotime($vShift[3][0]);
						else
							$vDistantInSizeStart=strtotime($vShift[3][0])-strtotime($vStartTime);
						
					}
					else
					{
						$vStartTrue=false;
						$vShiftIn=$vShift[1][0];
						if($vStartInt>=$vShift[3][1])
							$vDistantInSizeStart=strtotime($vStartTime)-strtotime($vShift[3][0]);
						else
							$vDistantInSizeStart=strtotime($vShift[3][0])-strtotime($vStartTime);
					}
				}
				if($vEndTrue==false)
				{
					if($vShift[3][1]<=$vShift[4][1])
					{
					if($vEndInt<=$vShift[4][1])
					{
						$vEndTrue=true;
						if($vDistantInSizeEnd==0)
						{
							$vShiftOut=$vShift[1][0];
						}
						else
						{
							if($vEndInt>=$vShift[4][1])
								$vDistantInSizeEndNew=strtotime($vEndTime)-strtotime($vShift[4][1]);
							else
								$vDistantInSizeEndNew=strtotime($vShift[4][0])-strtotime($vEndTime);
							if($vDistantInSizeEndNew<$vDistantInSizeEnd) $vShiftOut=$vShift[1][0];
						}
						if($vEndInt>=$vShift[4][1])
							$vDistantInSizeEnd=strtotime($vEndTime)-strtotime($vShift[4][1]);
						else
							$vDistantInSizeEnd=strtotime($vShift[4][0])-strtotime($vEndTime);
						
					}
					else
					{
						$vEndTrue=false;
						$vShiftOut=$vShift[1][0];
						if($vEndInt>=$vShift[4][1])
							$vDistantInSizeEnd=strtotime($vEndTime)-strtotime($vShift[4][1]);
						else
							$vDistantInSizeEnd=strtotime($vShift[4][0])-strtotime($vEndTime);
					}
					
					}
					//echo "HA:$vEndInt<".$vShift[4][1];
					//echo ": $vShiftOut<br>";
				}	
			}			
	
		}
		if($vShiftIn=='') $vShiftIn=$vShiftLast;
		if($vShiftOut=='') 
		{
			$vShiftOut=$vShiftLast;
		}
		///Ca cuối xác định công và có tăng ca không					
		$vShift['In']=$vShiftIn;
		$vShift['Out']=$vShiftOut;
		return $vShift;
		//Công của công việc 0 không có tăng ca, 1 có tăng ca.
	}
	function  CheckOutShiftFirst($vArrTime,$vArrShift,$vListShiftReceive)
	{
		//Xác định giờ đầu, giờ kết thúc.
		$vCurArrTime=Array();
		$vCount=count($vArrTime[0]);
		$vArrReturn=Array();
		if($vCount>0)
		{
			$vShift=Array();
			$vStartTime=$vArrTime[0][$vCount-1][0];
			$vEndTime=$vArrTime[1][0][0];
			$vShift=$this->ConfirmShiftOut($vArrShift,$vStartTime,$vEndTime,$vListShiftReceive);
			//print_r($vShift);
			if($vShift['In']!=$vArrShift[0][0][0])
			{
				$vArrReturn['CaIn']=$vShift['In'];
				$vArrReturn['CaOut']=$vArrShift[0][0][0];
			}
			elseif($vShift['Out']!=$vArrShift[0][0][0])
			{
				$vArrReturn['CaIn']=$vArrShift[0][0][0];
				$vArrReturn['CaOut']=$vShift['Out'];
			}
			else
			{
				$vArrReturn['CaIn']=$vArrShift[0][0][0];
				$vArrReturn['CaOut']=$vArrShift[0][0][0];
			}
			$vArrReturn['GioVao']=$vStartTime;
			$vArrReturn['GioRa']=$vEndTime;
			//$vArrReturn['CaIn']=$vShift['In'];
			//$vArrReturn['CaOut']=$vShift['Out'];
		}
		else
		{
			$vArrReturn['CaIn']=$vArrShift[0][0][0];
			$vArrReturn['CaOut']=$vArrShift[0][0][0];
		}
		
		return $vArrReturn;
	}
	function ConfirmShiftOut($vArrShift,$vStartTime,$vEndTime,$vListShiftReceive)
	{
		//trả về 2 trạng thái
		//Ca làm việc
		//Từ giờ starttime xác định vị trí ca.
		$vShift=Array();
		$vStartInt=(int)str_replace(":","",$vStartTime);
		$vEndInt=(int)str_replace(":","",$vEndTime);
		$vShiftIn='';
		$vShiftOut='';
		$vDistantInSizeStart=0;
		$vDistantInSizeStartEnd=0;
		$vStartTrue=false;
		$vEndTrue=false;
		foreach($vArrShift as $vShift)
		{
			if($vListShiftReceive=="" || (strpos(',,'.$vListShiftReceive.',',','.$vShift[1][0].',')>0))
			{
				//Ca đầu xác định ca làm việc
				$vShiftLast=$vShift[1][0];
				if($vStartTrue==false)
				{
					if($vStartInt<=$vShift[3][1])
					{
						$vStartTrue=true;
						if($vDistantInSizeStart==0)
						{
							$vShiftIn=$vShift[1][0];
						}
						else
						{
							if($vStartInt>=$vShift[3][1])
								$vDistantInSizeStartNew=$vStartInt-$vShift[3][1];
							else
								$vDistantInSizeStartNew=$vShift[3][1]-$vStartInt;
							if($vDistantInSizeStartNew<$vDistantInSizeStart) $vShiftIn=$vShift[1][0];
						}
						if($vStartInt>=$vShift[3][1])
							$vDistantInSizeStart=$vStartInt-$vShift[3][1];
						else
							$vDistantInSizeStart=$vShift[3][1]-$vStartInt;
						
					}
					else
					{
						$vStartTrue=false;
						$vShiftIn=$vShift[1][0];
						if($vStartInt>$vShift[3][1])
							$vDistantInSizeStart=$vStartInt-$vShift[3][1];
						else
							$vDistantInSizeStart=$vShift[3][1]-$vStartInt;
					}
				}
				if($vEndTrue==false)
				{
					if($vShift[3][1]<=$vShift[4][1])
					{
						if($vEndInt>=$vShift[4][1])
						{
							$vEndTrue=true;
							if($vDistantInSizeEnd==0)
							{
								$vShiftOut=$vShift[1][0];
							}
							else
							{
								if($vEndInt>=$vShift[4][1])
									$vDistantInSizeEndNew=$vEndInt-$vShift[4][1];
								else
									$vDistantInSizeEndNew=$vShift[4][1]-$vEndInt;
								if($vDistantInSizeEndNew<=$vDistantInSizeEnd) $vShiftOut=$vShift[1][0];
							}
							if($vEndInt>=$vShift[4][1])
								$vDistantInSizeEnd=$vEndInt-$vShift[4][1];
							else
								$vDistantInSizeEnd=$vShift[4][1]-$vEndInt;
							
						}
						else
						{
							if($vDistantInSizeEnd==0)
							{
								$vShiftOut=$vShift[1][0];
								if($vEndInt>=$vShift[4][1])
								$vDistantInSizeEnd=$vEndInt-$vShift[4][1];
								else
								$vDistantInSizeEnd=$vShift[4][1]-$vEndInt;
							}
							else
							{
								if($vEndInt>$vShift[4][1])
									$vDistantInSizeEndNew=$vEndInt-$vShift[4][1];
								else
									$vDistantInSizeEndNew=$vShift[4][1]-$vEndInt;
								if($vDistantInSizeEndNew<=$vDistantInSizeEnd) $vShiftOut=$vShift[1][0];
							}
							
						}
					
					}
					else
					{

							if($vDistantInSizeEnd==0)
							{
								$vShiftOut=$vShift[1][0];
							}
							else
							{
								if($vEndInt>=$vShift[4][1])
									$vDistantInSizeEndNew=$vEndInt-$vShift[4][1];
								else
									$vDistantInSizeEndNew=$vShift[4][1]-$vEndInt;
								//echo "if($vDistantInSizeEndNew<$vDistantInSizeEnd) $vShiftOut=".$vShift[1][0].";";
								if($vDistantInSizeEndNew<=$vDistantInSizeEnd) $vShiftOut=$vShift[1][0];
							}
							if($vEndInt>$vShift[4][1])
								$vDistantInSizeEnd=$vEndInt-$vShift[4][1];
							else
								$vDistantInSizeEnd=$vShift[4][1]-$vEndInt;
							
					}
					//echo "HA:$vEndInt<".$vShift[4][1];
					//echo ": $vShiftOut<br>";
				}	
			}
	
		}
		if($vShiftIn=='') $vShiftIn=$vShiftLast;
		if($vShiftOut=='') 
		{
			$vShiftOut=$vShiftLast;
		}
		///Ca cuối xác định công và có tăng ca không					
		$vShift['In']=$vShiftIn;
		$vShift['Out']=$vShiftOut;
		return $vShift;
		//Công của công việc 0 không có tăng ca, 1 có tăng ca.
	}
	//Hàm kiểm tra xem có giờ nào thuộc khoảng giờ của ca trong ngày không
	function CheckInShiftFirstBelong($vArrTime,$vStartTime,$vEndTime,$vCount)
	{
		for($i=0;$i<$vCount;$i++)
		{
			if(!(CompareTime(	$vArrTime[$i],$vEndTime) || CompareTime($vStartTime,$vArrTime[$i]))) return false;
		}	
		return true;
		
	}
	//Hàm kiểm tra xem có giờ nào thuộc khoảng giờ của ca qua ngày kế không	
	function CheckOutShiftFirstBelong($vArrTime,$vStartTime,$vEndTime,$vCount)
	{
		for($i=0;$i<$vCount;$i++)
		{
			if(!(CompareTime($vArrTime[$i],$vStartTime) && CompareTime($vEndTime,$vArrTime[$i]))) return false;
		}	
		return true;
		
	}	
	public function GetBuilCheckListDept($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002',$vDepID="")
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		if($vDepID=="") 
		{
			$vsql="select * from  ".$vTbl." where lv002='SOF' order by lv103 asc";
		}
		else
		{
			$vReturn="'".str_replace(",","','",$vDepID)."'";
			$vsql="select lv001,lv003 from  hr_lv0002 where (lv001 in ($vReturn))  order by lv003";
		}
		
		$strGetList="";
		$strGetScript="";
		$i=0;
		$vresult=db_query($vsql);
		$numrows=db_num_rows($vresult);
		while($vrow=db_fetch_array($vresult))		
		{

			$strTempChk=str_replace("@01",$i,$lvChk);
			$strTempChk=str_replace("@02",$vrow['lv001'],$strTempChk);
			if(strpos($vListID,",".$vrow['lv001'].",") === FALSE)
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			if($this->LV_IsNameDep==1)
				$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			else
				$strTemp=str_replace("@#02",$vrow[$vFieldView],$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow['lv001'],$vTbl,$vFieldView,$i,$numrows,'');
			$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	function GetBuilCheckListChild($vListID,$vID,$vParentID,$vTbl,$vFieldView,&$i,&$numrows,$vspace)
	{
		$strGetScript="";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>			
		</tr>
		";
		$vsql1="select * from  ".$vTbl." where lv002='".$vParentID."' order by lv003";
		$vresult1=db_query($vsql1);
		$vnum=db_num_rows($vresult1);
		$numrows=$numrows+$vnum;
		$i++;
		while($vrow1=db_fetch_array($vresult1))		
		{
			$strTempChk=str_replace("@01",$i,$lvChk);
			$strTempChk=str_replace("@02",$vrow1['lv001'],$strTempChk);
			if(strpos($vListID,",".$vrow1['lv001'].",") === FALSE)
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
			$strTempChk=str_replace("@04",'&nbsp;&nbsp;&nbsp;'.$vrow1['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			if($this->LV_IsNameDep==1)
				$strTemp=str_replace("@#02",$vspace.'|-----'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
			else
				$strTemp=str_replace("@#02",$vspace.'|-----'.$vrow1[$vFieldView],$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow1['lv001'],$vTbl,$vFieldView,$i,$numrows,$vspace.'&nbsp;&nbsp;&nbsp;');
			$i++;
		}
		$i--;
		return $strGetScript;
	}
	
	//////////get view///////////////
	function GetView()
	{
		return $this->isView;
	}//////////get view///////////////
	function GetRpt()
	{
		return $this->isRpt;
	}
	//////////get view///////////////
	function GetAdd()
	{
		return $this->isAdd;
	}	
	//////////get edit///////////////
	function GetEdit()
	{
		return $this->isEdit;
	}	
	//////////get edit///////////////
	function GetApr()
	{
		return $this->isApr;
	}		
	//////////get edit///////////////
	function GetUnApr()
	{
		return $this->isUnApr;
	}	
	function LV_ViewHelp($lvList,$lvFrom,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		return $this->TabFunction($lvFrom,$lvList,$maxRows);
	}
}
?>