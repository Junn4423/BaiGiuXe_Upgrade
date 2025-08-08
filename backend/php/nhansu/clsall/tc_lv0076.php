<?php
class tc_lv0076 extends lv_controler{
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
	public $lv006=null;
	public $lv007=null;
	public $lv008=null;
	public $lv009=null;
	public $lv010=null;
	public $paratimecard=null;
	public $datefrom=null;
	public $dateto=null;
	public $ArrEmp=null;
	public $ArrStateEmp=null;
	public $ArrEmpBack=null;
	public $Str_DateFromTo=null;
	public $lvHeader=null;
	public $lvState=null;
	public $lvSort=null;
	public $ArrTCEmp=null;
	public $DateWork=0;
	public $DateSun=0;
	public $ArrDept=null;
	public $ArrStateScan=null;
	public $ArrDateScan=null;
	var $vRowHeader="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>@02</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@03</b></td>
				<td class=\"tdhprint\" width=\"25%\" align=\"center\"><b>@04</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@05</b></td>
				<td class=\"tdhprint\" width=\"*\" align=\"center\"><b>@06</b></td>
			</tr>
		@01
		</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	var $vRowHeaderAll="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>@02</b></td>
				<td class=\"tdhprint\" width=\"15%\" align=\"center\"><b>@03</b></td>
				<td class=\"tdhprint\" width=\"*\" align=\"center\"><b>@04</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@05</b></td>
				<td class=\"tdhprint\" width=\"15%\" align=\"center\"><b>@06</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@07</b></td>
			</tr>
		@01
		</table>";
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011";	
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0");
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;	
	 	$this->isFil=1;	
	
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		$this->ArrDept=Array();
	}
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
	function LV_GetCodeNghi($vCode)
	{
		$vArrayCode=Array("0.5&"=>0.5,"&"=>1,"0.5K"=>0.5,"0.5X"=>0.5,"X"=>1);
		return $vArrayCode[$vCode];
	}
	function LV_GetTCEmpSum($vEmpID)
	{
		$vCode="'V','中','日','^','&','0.5K','C'";
		$return=0;
		$values=$this->ArrTCEmp[$vEmpID];
		if($values!=NULL) 
		{
			while (list($key, $value) = each($values)) { 	
				if(!(strpos($vCode,"'".$key."'")===false)) $return=$return+(int)$value;
				
			}
		}
		return $return;
	}
	function LV_GetDep($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		//if($this->isChildCheck=="") $this->isChildCheck=1;
		if($this->isChildCheck==1)
		{
			$vsql="select lv001 from  hr_lv0002 where lv001 in ($vReturn)  order by lv103 asc";
			$bResult=db_query($vsql);
			while ($vrow = db_fetch_array ($bResult)){
				//$vReturn=$vReturn.",'".$vrow['lv001']."'";
				$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
			}
		}
		return $vReturn;
	}
	function LV_GetChildDep($vDepID)
	{
		$vReturn="";
		if(trim($vDepID)=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001 from  hr_lv0002 where lv002 in ($vReturn) order by lv103 asc";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
		}
		return $vReturn;
	}
	function GetChildDept($vParentID,&$i)
	{
		$strReturn="";

		$vsql1="select lv001 from  hr_lv0002 where lv002='".$vParentID."' order by lv003";
		$vresult1=db_query($vsql1);
		$i++;
		while($vrow1=db_fetch_array($vresult1))		
		{
			$strReturn=$strReturn.",".$vrow1['lv001'];
			$strReturn=$strReturn.$this->GetBuilCheckListChild($vrow1['lv001'],$i);
			$i++;
		}
		$i--;
		return $strReturn;
	}
	function LV_GetListCalendar($vListEmployeeID,$vField)
	{
		if($this->ArrCalendar[$vListEmployeeID][0]==true) $this->ArrCalendar[$vListEmployeeID][1];
		$vsql="select $vField from tc_lv0010 where lv002 in ($vListEmployeeID)";
		$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
		   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
				else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
			}
		}
		$this->ArrCalendar[$vListEmployeeID][0]=true;
		$this->ArrCalendar[$vListEmployeeID][1]=$strReturn;
		return $strReturn;

	}
	function GetBuilCalendar($vEmployeeID,$vField)
	{
		$vsql="select $vField from tc_lv0010 where lv002='$vEmployeeID'";
		$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
		   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
				else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
			}
			return $strReturn;
		}
	}
	function LV_GetLimitDate($vstartdate,$venddate)
	{
		if(count($this->vArrDay)>0) return $this->vArrDay;
		$vstt=1;
		$vstartday=(int)getday($vstartdate);
		$vstartmonth=getmonth($vstartdate);
		$vstartyear=getyear($vstartdate);
		$vendday=(int)getday($venddate);
		$vendmonth=getmonth($venddate);
		$vendyear=getyear($venddate);
		if($vstartmonth!=$vendmonth)
		{
			$vStartNumDay=GetDayInMonth($vstartyear,$vstartmonth);
			for($i=$vstartday;$i<=$vStartNumDay;$i++)
			{
				$this->vArrDay[$vstt]=$vstartyear."-".Fillnum($vstartmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
			$vEndNumDay=$vendday;
			for($i=1;$i<=$vEndNumDay;$i++)
			{
				$this->vArrDay[$vstt]=$vendyear."-".Fillnum($vendmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
		}
		else
		{
			for($i=$vstartday;$i<=$vendday;$i++)
			{
				$this->vArrDay[$vstt]=$vstartyear."-".Fillnum($vstartmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
		}
		return $this->vArrDay;
	}
	function LV_GetHD($vConTractID)
	{
		$vsql="select lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026 from hr_lv0038 where lv001='$vConTractID'";
		$vresult=db_query($vsql);
		$strReturn="";
		return db_fetch_array($vresult);
	}
	function LV_ConfirmHD($vContractID,$vOldContractID,&$vABC=0,&$vPCCT=0)
	{
		if($this->ContractCompare['T'.$vContractID.'-'.$vOldContractID][0]==1) return $this->ContractCompare['T'.$vContractID.'-'.$vOldContractID][1];
		$this->ContractCompare['T'.$vContractID.','.$vOldContractID][0]=1;
		$vrow1=$this->LV_GetHD($vContractID);
		$vrow2=$this->LV_GetHD($vOldContractID);
		if($vrow1['lv013']==$vrow2['lv013'] && $vrow1['lv013']>0)
		{
			$vABC=1;
		}
		else
		{
			if($vrow1['lv013']>0 && $vrow2['lv013']>0)
			{
				$vABC=2;		
			}	
		}
		if($vrow1['lv023']==$vrow2['lv023'] && $vrow1['lv023']>0)
		{
			$vPCCT=1;
		}
		else
		{
			if($vrow1['lv023']>0 && $vrow2['lv023']>0)
			{
				$vPCCT=2;		
			}	
		}
		if($vrow1['lv022']==$vrow2['lv022'] && $vrow1['lv021']==$vrow2['lv021'] && $vrow1['lv013']==$vrow2['lv013'] && $vrow1['lv014']==$vrow2['lv014'] && $vrow1['lv016']==$vrow2['lv016'] && $vrow1['lv026']==$vrow2['lv026']  && $vrow1['lv018']==$vrow2['lv018'] && $vrow1['lv020']==$vrow2['lv020'] && $vrow1['lv023']==$vrow2['lv023'] && $vrow1['lv025']==$vrow2['lv025'] && $vrow1['lv026']==$vrow2['lv026'] )
		$this->ContractCompare['T'.$vContractID.'-'.$vOldContractID][1]=1;
		else
		$this->ContractCompare['T'.$vContractID.'-'.$vOldContractID][1]=0;
		return $this->ContractCompare['T'.$vContractID.'-'.$vOldContractID][1];
	}

	function TinhCongTheoNgayVP_BV($vEmpID,$vstartdate,$venddate,$vrate,$vCalID,&$ArrEmpList,$vContractID,$vNgayLam=-1)
	{
		$vTemArr=null;
		$ArrEmpListPre=null;
		$vListEmp="'".$vEmpID."'";
		$vListCalendar=$this->LV_GetListCalendar($vListEmp,'lv001');
		if($vListCalendar=="") $vListCalendar="''";
		$vArrDay=$this->LV_GetLimitDate($vstartdate,$venddate);
		$hesok=0;
		//$this->LV_GETHSOK($this->mohr_lv0020->lv029,$vCalID,$hesok,$tanggiamhso);
		for($i=1;$i<=count($vArrDay);$i++)
		{
			$vDay=$vArrDay[$i];
			if($this->ArrDaySpecial[0]['state']==false)
			{
				if(GetDayOfWeek($vDay)==7)	$this->ArrDaySpecial[0]['T7']=(int)$this->ArrDaySpecial[0]['T7']+1;
				if(GetDayOfWeek($vDay)==1)	$this->ArrDaySpecial[0]['CN']=(int)$this->ArrDaySpecial[0]['CN']+1;
			}
			if($vsql=="")
				$vsql="select $i stt,DAYOFWEEK(A.lv004) DOWS,A.lv007 MaCong,A.lv008 tiencomtc,A.lv010 tiencom,A.lv004 ngaytinh,A.lv011 DepID,A.lv005 RGTime,A.lv014 TCTime,IF(ISNULL(A.lv016),'00:00:00',A.lv016) TCTimeTrua,A.lv017 TCTimeDEM,A.lv018 TCTimeLe,A.lv099 ContractID,A.lv021 ProjectID from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 where A.lv100<>1 And A.lv004='$vDay' and A.lv002 in ($vListCalendar) ";
			else
				$vsql=$vsql." union
				       select $i stt,DAYOFWEEK(A.lv004) DOWS, A.lv007 MaCong,A.lv008 tiencomtc,A.lv010 tiencom,A.lv004 ngaytinh,A.lv011 DepID,A.lv005 RGTime,A.lv014 TCTime,IF(ISNULL(A.lv016),'00:00:00',A.lv016) TCTimeTrua,A.lv017 TCTimeDEM,A.lv018 TCTimeLe,A.lv099 ContractID,A.lv021 ProjectID from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 where A.lv100<>1 And A.lv004='$vDay' and A.lv002 in ($vListCalendar)";
		}
		$this->ArrDaySpecial[0]['state']=true;
		$vresult=db_query($vsql);
		$vContinue=1;
		$ArrEmpList["$vEmpID"][0]['TINHTS']=true;
		$ArrEmpList["$vEmpID"][0]['ISTS']=false;
		$vt=0;
		$vIsC=false;
		$this->isSameHD=0;
		$this->isRateTwo=false;
		$SoLanKhac=0;
		$SoLanGiong=0;
		$this->isABC=0;
		$this->isPCCT=0;
		$isABC=0;
		while($vrow=db_fetch_array($vresult))
		{
			if($vNgayLam!=13 || ($vNgayLam==13 && $vrow['DOWS']!=1))
			{
				if($vt==0)
				{
					$vContractID=$vrow['ContractID'];
					if($this->mohr_lv0038->lv001!=$vContractID)
					{
						$vIsC=true;
						$vPreContractID=$vContractID;				
					}	
				}				
				if($vContractID!=$vrow['ContractID'])
				{
					$SoLanKhac++;
					 $vContinue=$this->LV_ConfirmHD($vContractID,$vrow['ContractID'],$isABC,$isPCCT);
					 if($isABC==2) $this->isABC=2;
					 if($isPCCT==2) $this->isPCCT=2;
					 if($vContinue) $SoLanGiong++;
					 $this->isSameHD=$vContinue;
				}
				$vContractID=$vrow['ContractID'];
				if($vContinue==1)
				{
					$i=$vrow['stt'];
					$vGioLam=$this->GetTime($this->mohr_lv0038->lv007);
					if($vGioLam==0) $vGioLam=8;
					$vTimeLate=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeLate'];
					$vTimeSoon=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeSoon'];
					$vGIOTANGCA=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCA'];
					$vGIOTANGCACN=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCACN'];
					$vGIOTANGCADEM=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCADEM'];
					
					$ArrEmpList["$vEmpID"][$i]['value']=true;
					$ArrEmpList["$vEmpID"][$i]['DepID']=$vrow['DepID'];
					$ArrEmpList["$vEmpID"][$i]['HSCV']=$vrow['hscv'];
					$ArrEmpList["$vEmpID"][$i]['MaCong']=$vrow['MaCong'];
					$ArrEmpList["$vEmpID"][$i]['ngaytinh']=$vrow['ngaytinh'];
					$ArrEmpList["$vEmpID"][$i]['hesok']=$vrow['hesok'];		
					$ArrEmpList["$vEmpID"][0]['ContractID']=$vrow['ContractID'];
					$vSoGioTC=$this->GetTime(TIMEADD($vrow['TCTime'],$vrow['TCTimeDEM']));
					if($vSoGioTC>=1.5)
					{
						$ArrEmpList["$vEmpID"][0]['TC_LON_1_5H']=(int)$ArrEmpList["$vEmpID"][0]['TC_LON_1_5H']+1;
					}
					if($vSoGioTC>=2)
					{
						if($vSoGioTC<=4)
							$ArrEmpList["$vEmpID"][0]['TC_NHO_2H']=(int)$ArrEmpList["$vEmpID"][0]['TC_NHO_2H']+1;
						else
							$ArrEmpList["$vEmpID"][0]['TC_LON_2H']=(int)$ArrEmpList["$vEmpID"][0]['TC_LON_2H']+1;

					}
					if($vrow['MaCong']!='L' && $vrow['MaCong']!='P' && $vrow['MaCong']!='0.5P' && $vrow['MaCong']!='B' )
					{
						if($vrow['DOWS']==1)
						{
							$ArrEmpList["$vEmpID"][0]['CNTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['CNTime'],$vrow['RGTime']);			
							$ArrEmpList["$vEmpID"][0]['CNTimeS']=$ArrEmpList["$vEmpID"][0]['CNTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['CNTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['CNTimeH'],$vrow['RGTime']);
						}
						if($vrow['MaCong']!='CT' && ($vrow['ProjectID']==NULL || $vrow['ProjectID']=='VP' || trim($vrow['ProjectID'])==''))
						{
							$ArrEmpList["$vEmpID"][0]['RGTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['RGTime'],$vrow['RGTime']);			
							$ArrEmpList["$vEmpID"][0]['RGTimeS']=$ArrEmpList["$vEmpID"][0]['RGTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['RGTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['RGTimeH'],$vrow['RGTime']);
						}
						else
						{
							$ArrEmpList["$vEmpID"][0]['PJTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['PJTime'],$vrow['RGTime']);			
							$ArrEmpList["$vEmpID"][0]['PJTimeS']=$ArrEmpList["$vEmpID"][0]['PJTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['PJTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['PJTimeH'],$vrow['RGTime']);
						}
					}
					elseif($vrow['MaCong']=='0.5P' && $vrow['RGTime']!='04:00:00' && $vrow['RGTime']>'04:00:00')
					{
						$vTimeAgain=TIMEADD($vrow['RGTime'],'-04:00:00');
						if($vrow['DOWS']==1)
						{
							$ArrEmpList["$vEmpID"][0]['CNTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['CNTime'],$vTimeAgain);			
							$ArrEmpList["$vEmpID"][0]['CNTimeS']=$ArrEmpList["$vEmpID"][0]['CNTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['CNTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['CNTimeH'],$vTimeAgain);
						}
						if($vrow['MaCong']!='CT' && ($vrow['ProjectID']==NULL || $vrow['ProjectID']=='VP' || trim($vrow['ProjectID'])==''))
						{
							$ArrEmpList["$vEmpID"][0]['RGTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['RGTime'],$vTimeAgain);			
							$ArrEmpList["$vEmpID"][0]['RGTimeS']=$ArrEmpList["$vEmpID"][0]['RGTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['RGTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['RGTimeH'],$vTimeAgain);
						}
						else
						{
							$ArrEmpList["$vEmpID"][0]['PJTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['PJTime'],$vTimeAgain);			
							$ArrEmpList["$vEmpID"][0]['PJTimeS']=$ArrEmpList["$vEmpID"][0]['PJTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['PJTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['PJTimeH'],$vTimeAgain);
						}
					}
					$ArrEmpList["$vEmpID"][0]['TC150']= TIMEADD($ArrEmpList["$vEmpID"][0]['TC150'],$vrow['TCTime']);			
					$ArrEmpList["$vEmpID"][0]['TC150S']=$ArrEmpList["$vEmpID"][0]['TC150S']+round($this->GetTime($vrow['TCTime'])/$vGioLam,2);			
					
					$ArrEmpList["$vEmpID"][0]['TC150']= TIMEADD($ArrEmpList["$vEmpID"][0]['TC150'],$vrow['TCTimeTrua']);			
					$ArrEmpList["$vEmpID"][0]['TC150S']=$ArrEmpList["$vEmpID"][0]['TC150S']+round($this->GetTime($vrow['TCTimeTrua'])/$vGioLam,2);			
					
					$ArrEmpList["$vEmpID"][0]['TC200']= TIMEADD($ArrEmpList["$vEmpID"][0]['TC200'],$vrow['TCTimeDEM']);			
					$ArrEmpList["$vEmpID"][0]['TC200S']=$ArrEmpList["$vEmpID"][0]['TC200S']+round($this->GetTime($vrow['TCTimeDEM'])/$vGioLam,2);			
					
					$ArrEmpList["$vEmpID"][0]['TC300']=TIMEADD($ArrEmpList["$vEmpID"][0]['TC300'],$vrow['TCTimeLe']);
					$ArrEmpList["$vEmpID"][0]['TC300S']=$ArrEmpList["$vEmpID"][0]['TC300S']+round($this->GetTime($vrow['TCTimeLe'])/$vGioLam,2);		
					if($vrow['DOWS']!=1)
						{
							if($vrow['MaCong']=='O')
							{
								$ArrEmpList["$vEmpID"][0]['NGAYKHONGLAM']=(int)$ArrEmpList["$vEmpID"][0]['NGAYKHONGLAM']+1;
							}
						}
					switch($vrow['MaCong'])
					{
						case 'SS':
							if(str_replace(":","",$vrow['RGTime'])>=40000) $ArrEmpList["$vEmpID"][0][$vrow['MaCong']]=(int)$ArrEmpList["$vEmpID"][0][$vrow['MaCong']]+1;
							break;
						case '*':
							if($ArrEmpList["$vEmpID"][0]['ISTS']==false) $ArrEmpList["$vEmpID"][0]['TS_NGAYTINH']=getday($vrow['ngaytinh']);
							$ArrEmpList["$vEmpID"][0]['ISTS']=true;
							if(getday($vrow['ngaytinh'])<=15) $ArrEmpList["$vEmpID"][0]['TINHTS']=false;
							break;
						case 'SL':
							$ArrEmpList["$vEmpID"][0]['ISSL']=true;
							break;
						default:
							if($this->MaxLe[$vrow['ngaytinh']]==true)
							{
								if($vrow['MaCong']=='VP' || $vrow['MaCong']=='CT')  $ArrEmpList["$vEmpID"][0]['L']=(int)$ArrEmpList["$vEmpID"][0]['L']+1;
							}
							$ArrEmpList["$vEmpID"][0][$vrow['MaCong']]=(int)$ArrEmpList["$vEmpID"][0][$vrow['MaCong']]+1;
							break;
					}
					if((int)$ArrEmpList["$vEmpID"][0]['hesok']==0) $ArrEmpList["$vEmpID"][0]['hesok']=$vrow['hesok'];
					if($vrow['tiencom']!=1)
						$ArrEmpList["$vEmpID"][0]['tiencom']=(int)$ArrEmpList["$vEmpID"][0]['tiencom']+1;	
					else
						$ArrEmpList["$vEmpID"][0]['tiencoman']=(int)$ArrEmpList["$vEmpID"][0]['tiencoman']+1;	
					if($vrow['tiencomtc']!=1)
						$ArrEmpList["$vEmpID"][0]['tiencomtc']=(int)$ArrEmpList["$vEmpID"][0]['tiencomtc']+1;	
					else
						$ArrEmpList["$vEmpID"][0]['tiencomtcan']=(int)$ArrEmpList["$vEmpID"][0]['tiencomtcan']+1;	
					
				}
				else
				{
					
					$i=$vrow['stt'];
					$ArrEmpListPre["$vEmpID"][$i]['value']=true;
					$ArrEmpListPre["$vEmpID"][$i]['DepID']=$vrow['DepID'];
					$ArrEmpListPre["$vEmpID"][$i]['HSCV']=$vrow['hscv'];
					$ArrEmpListPre["$vEmpID"][$i]['MaCong']=$vrow['MaCong'];
					$ArrEmpListPre["$vEmpID"][$i]['ngaytinh']=$vrow['ngaytinh'];
					$ArrEmpListPre["$vEmpID"][$i]['hesok']=$vrow['hesok'];		
					$ArrEmpListPre["$vEmpID"][0]['ContractID']=$vrow['ContractID'];
					$vSoGioTC=$this->GetTime(TIMEADD($vrow['TCTime'],$vrow['TCTimeDEM']));
					if($vSoGioTC>=1.5)
					{
						$ArrEmpListPre["$vEmpID"][0]['TC_LON_1_5H']=(int)$ArrEmpListPre["$vEmpID"][0]['TC_LON_1_5H']+1;
					}
					if($vSoGioTC>2)
					{
						if($vSoGioTC<=4)
							$ArrEmpListPre["$vEmpID"][0]['TC_NHO_2H']=(int)$ArrEmpListPre["$vEmpID"][0]['TC_NHO_2H']+1;
						else
							$ArrEmpListPre["$vEmpID"][0]['TC_LON_2H']=(int)$ArrEmpListPre["$vEmpID"][0]['TC_LON_2H']+1;

					}
					if($vrow['MaCong']!='L' && $vrow['MaCong']!='P' && $vrow['MaCong']!='0.5P'  && $vrow['MaCong']!='B')
					{
						if($vrow['DOWS']==1)
						{
							$ArrEmpListPre["$vEmpID"][0]['CNTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['CNTime'],$vrow['RGTime']);			
							$ArrEmpListPre["$vEmpID"][0]['CNTimeS']=$ArrEmpListPre["$vEmpID"][0]['CNTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['CNTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['CNTimeH'],$vrow['RGTime']);
						}
						if($vrow['MaCong']!='CT' && ($vrow['ProjectID']==NULL || $vrow['ProjectID']=='VP' || trim($vrow['ProjectID'])==''))
						{
							$ArrEmpListPre["$vEmpID"][0]['RGTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['RGTime'],$vrow['RGTime']);			
							$ArrEmpListPre["$vEmpID"][0]['RGTimeS']=$ArrEmpListPre["$vEmpID"][0]['RGTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['RGTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['RGTimeH'],$vrow['RGTime']);
						}
						else
						{
							$ArrEmpListPre["$vEmpID"][0]['PJTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['PJTime'],$vrow['RGTime']);			
							$ArrEmpListPre["$vEmpID"][0]['PJTimeS']=$ArrEmpListPre["$vEmpID"][0]['PJTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['PJTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['PJTimeH'],$vrow['RGTime']);
						}
					}
					elseif($vrow['MaCong']=='0.5P' && $vrow['RGTime']!='04:00:00' && $vrow['RGTime']>'04:00:00')
					{
						$vTimeAgain=TIMEADD($vrow['RGTime'],'-04:00:00');
						if($vrow['DOWS']==1)
						{
							$ArrEmpListPre["$vEmpID"][0]['CNTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['CNTime'],$vTimeAgain);			
							$ArrEmpListPre["$vEmpID"][0]['CNTimeS']=$ArrEmpListPre["$vEmpID"][0]['CNTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['CNTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['CNTimeH'],$vTimeAgain);
						}
						if($vrow['MaCong']!='CT' && ($vrow['ProjectID']==NULL || $vrow['ProjectID']=='VP' || trim($vrow['ProjectID'])==''))
						{
							$ArrEmpListPre["$vEmpID"][0]['RGTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['RGTime'],$vTimeAgain);			
							$ArrEmpListPre["$vEmpID"][0]['RGTimeS']=$ArrEmpListPre["$vEmpID"][0]['RGTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['RGTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['RGTimeH'],$vTimeAgain);
						}
						else
						{
							$ArrEmpListPre["$vEmpID"][0]['PJTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['PJTime'],$vTimeAgain);			
							$ArrEmpListPre["$vEmpID"][0]['PJTimeS']=$ArrEmpListPre["$vEmpID"][0]['PJTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['PJTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['PJTimeH'],$vTimeAgain);
						}
					}
					$ArrEmpListPre["$vEmpID"][0]['TC150']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['TC150'],$vrow['TCTime']);			
					$ArrEmpListPre["$vEmpID"][0]['TC150S']=$ArrEmpListPre["$vEmpID"][0]['TC150S']+round($this->GetTime($vrow['TCTime'])/$vGioLam,2);			
					
					$ArrEmpListPre["$vEmpID"][0]['TC150']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['TC150'],$vrow['TCTimeTrua']);			
					$ArrEmpListPre["$vEmpID"][0]['TC150S']=$ArrEmpListPre["$vEmpID"][0]['TC150S']+round($this->GetTime($vrow['TCTimeTrua'])/$vGioLam,2);			
					
					$ArrEmpListPre["$vEmpID"][0]['TC200']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['TC200'],$vrow['TCTimeDEM']);			
					$ArrEmpListPre["$vEmpID"][0]['TC200S']=$ArrEmpListPre["$vEmpID"][0]['TC200S']+round($this->GetTime($vrow['TCTimeDEM'])/$vGioLam,2);			
					
					$ArrEmpListPre["$vEmpID"][0]['TC300']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['TC300'],$vrow['TCTimeLe']);
					$ArrEmpListPre["$vEmpID"][0]['TC300S']=$ArrEmpListPre["$vEmpID"][0]['TC300S']+round($this->GetTime($vrow['TCTimeLe'])/$vGioLam,2);
				
					if($vrow['DOWS']!=1)
						{
							if($vrow['MaCong']=='O')
							{
								$ArrEmpListPre["$vEmpID"][0]['NGAYKHONGLAM']=(int)$ArrEmpListPre["$vEmpID"][0]['NGAYKHONGLAM']+1;
							}
						}
					$ArrEmpListPre["$vEmpID"][0]['TCTimeTrua']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['TCTimeTrua'],$vrow['TCTimeTrua']);
					$ArrEmpListPre["$vEmpID"][0]['TCTimeTruaS']=$ArrEmpListPre["$vEmpID"][0]['TCTimeTruaS']+round($this->GetTime($vrow['TCTimeTrua'])/8,2);
					$ArrEmpListPre["$vEmpID"][0]['TCTimeDEM']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['TCTimeDEM'],$vrow['TCTimeDEM']);
					$ArrEmpListPre["$vEmpID"][0]['TCTimeDEMS']=$ArrEmpListPre["$vEmpID"][0]['TCTimeDEMS']+round($this->GetTime($vrow['TCTimeTrua'])/8,2);
					$ArrEmpListPre["$vEmpID"][0]['TCTimeLe']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['TCTimeLe'],$vrow['TCTimeLe']);
					$ArrEmpListPre["$vEmpID"][0]['TCTimeLeS']=$ArrEmpListPre["$vEmpID"][0]['TCTimeLeS']+round($this->GetTime($vrow['TCTimeLe'])/$vGioLam,2);
					switch($vrow['MaCong'])
					{
						case 'SS':
							if(str_replace(":","",$vrow['RGTime'])>=40000) $ArrEmpListPre["$vEmpID"][0][$vrow['MaCong']]=(int)$ArrEmpListPre["$vEmpID"][0][$vrow['MaCong']]+1;
							break;
						case '*':
							if($ArrEmpList["$vEmpID"][0]['ISTS']==false) 
							{
								$ArrEmpList["$vEmpID"][0]['TS_NGAYTINH']=getday($vrow['ngaytinh']);
								$ArrEmpListPre["$vEmpID"][0]['TS_NGAYTINH']=$ArrEmpList["$vEmpID"][0]['TS_NGAYTINH'];
							}
							break;
						default:
							if($this->MaxLe[$vrow['ngaytinh']]==true)
							{
								if($vrow['MaCong']=='VP' || $vrow['MaCong']=='CT')  $ArrEmpListPre["$vEmpID"][0]['L']=(int)$ArrEmpListPre["$vEmpID"][0]['L']+1;
							}
							$ArrEmpListPre["$vEmpID"][0][$vrow['MaCong']]=(int)$ArrEmpListPre["$vEmpID"][0][$vrow['MaCong']]+1;
							break;
					}
					if((int)$ArrEmpListPre["$vEmpID"][0]['hesok']==0) $ArrEmpListPre["$vEmpID"][0]['hesok']=$vrow['hesok'];
					if($vrow['tiencom']!=1)
						$ArrEmpListPre["$vEmpID"][0]['tiencom']=(int)$ArrEmpListPre["$vEmpID"][0]['tiencom']+1;	
					else
						$ArrEmpListPre["$vEmpID"][0]['tiencoman']=(int)$ArrEmpListPre["$vEmpID"][0]['tiencoman']+1;	
					if($vrow['tiencomtc']!=1)
						$ArrEmpListPre["$vEmpID"][0]['tiencomtc']=(int)$ArrEmpListPre["$vEmpID"][0]['tiencomtc']+1;	
					else
						$ArrEmpListPre["$vEmpID"][0]['tiencomtcan']=(int)$ArrEmpListPre["$vEmpID"][0]['tiencomtcan']+1;	
				}
			$vt++;
			}
		}
		//echo "if($SoLanKhac!=$SoLanGiong) $this->isSameHD=0; $this->isABC";
		if($SoLanKhac!=$SoLanGiong)
		{
			if($this->isABC==2) $this->isRateTwo=true;
			if($this->isPCCT==2) $this->isPCCTTwo=true;
			$this->isSameHD=0;
		} 
		if($vIsC==true)
		{
			if( $ArrEmpListPre["$vEmpID"][0]['RGTimeS']>0 )
			{
				$vTemArr=$ArrEmpList;
				$ArrEmpList=$ArrEmpListPre;
				$ArrEmpListPre=$vTemArr;
				$this->mohr_lv0038->LV_LoadActivePre($vPreContractID);
			}
		}
		return $ArrEmpListPre;
		
	}
	function LV_CheckSoNgayLe($vStartDate,$vEndDate)
	{
		$vArrLe=Array();
		$vsql="select lv002 from tc_lv0003 where (lv002>='$vStartDate 00:00:00' and lv002<='$vEndDate 23:59:59') and lv004='L'";
		$bResult=db_query($vsql);
		while($vrow = db_fetch_array ($bResult))
		{
			$vArrLe[$vrow['lv002']]=true;
		}
		return $vArrLe;
	}
	function LV_LoadPNQuy($vYear,$vMonth)
	{
		if($this->FNChuaNghi[0]==true) return;
		$vsql="select * from tc_lv0009 where lv005='$vMonth' and lv006='$vYear'";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->FNChuaNghi[$vrow['lv002']]=$vrow['lv029'];
		}
		$this->FNChuaNghi[0]=true;
	}
	function LV_CheckHD_THUVIEC($vEmployeeID)
	{
		if($this->ArrHDTV["$vEmployeeID"][0]==true) return $this->ArrHDTV["$vEmployeeID"][1];
		$this->ArrHDTV["$vEmployeeID"][0]=true;
		$this->ArrHDTV["$vEmployeeID"][1]='';
		$vsql="select DATE_ADD(lv005, INTERVAL 1 DAY) NgayKT from hr_lv0038 where lv002='$vEmployeeID' and lv003 in (2,5)";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
			
			$this->ArrHDTV["$vEmployeeID"][1]=$vrow["NgayKT"];
		}
		return $this->ArrHDTV["$vEmployeeID"][1];
	}
	function LV_GetPercent_HR($vState,$vDateW,$vDateCal,$vStaffID)
	{
		if($vState==5)
		{
			if(getmonth($vDateW)==getmonth($vDateCal) &&  getyear($vDateW)==getyear($vDateCal))
			{
				$vDay=getday($vDateW);
				if($vDay<=5)
					$vPercent=100;
				elseif($vDay<=10)
					$vPercent=75;
				elseif($vDay<=14)
					$vPercent=50;
				elseif($vDay<=20)
					$vPercent=25;
				elseif($vDay>=21)
					$vPercent=0;
			}
			else
			{
				$vPercent=100;
				
			}
		}
		else
		{
			//Check hợp đồng thử việc.
			$vDateW=$this->LV_CheckHD_THUVIEC($vStaffID);
			if(getmonth($vDateW)==getmonth($vDateCal) &&  getyear($vDateW)==getyear($vDateCal))
			{
				$vDay=getday($vDateW);
				if($vDay<=5)
					$vPercent=100;
				elseif($vDay<=10)
					$vPercent=75;
				elseif($vDay<=14)
					$vPercent=50;
				elseif($vDay<=20)
					$vPercent=25;
				elseif($vDay>=21)
					$vPercent=0;
			}
			else
			{
				$vPercent=100;
				
			}
		}
		return $vPercent;
	}
//////////////////////Buil list////////////////////
	function LV_BuilListReportOtherPrintLateSoon($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvopt=0,$vmau=0,$vshowgiokem=0,$isshift=0)
	{		
		$lvTable='
		<table border="1" cellspacing="0" class="lvtable">
	<tbody>
		<tr class="lvhtable">
			<td class="lvhtable" align="center" height="89" valign="middle"><b><font>Stt</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>M&atilde; NV</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>Họ v&agrave; T&ecirc;n </font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>Bộ phận </font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>Ng&agrave;y v&agrave;o l&agrave;m </font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>Ng&agrave;y c&ocirc;ng thực tế</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>Tăng ca </font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>MỨC ABC </font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>Giám đốc</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>P.<br />
				HCNS</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>Tr.Bộ phận</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>Tự nhận</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font>Số tiền sau đánh giá</font></b></td>
		</tr>
		
		@#02
	</tbody>
</table>
			';
		$vTRDept='<tr>
			<td align="left" height="44" valign="middle"><b><font size="3">I. HCNS</font></b></td>
			<td align="center" sdnum="1033;0;@" valign="middle"><b><font size="3"><br />
				</font></b></td>
			<td align="left" valign="middle"><b><font size="3"><br />
				</font></b></td>
			<td align="left" valign="middle"><b><font size="3"><br />
				</font></b></td>
			<td align="left" valign="middle"><b><font size="3"><br />
				</font></b></td>
			<td align="center" valign="middle"><font><br />
				</font></td>
			<td align="left" valign="middle"><font><br />
				</font></td>
			<td align="center" valign="middle"><font><br />
				</font></td>
			<td align="center" valign="middle"><font size="3"><br />
				</font></td>
			<td align="center" valign="middle"><font><br />
				</font></td>
			<td align="center" valign="middle"><font><br />
				</font></td>
			<td align="center" valign="middle"><font><br />
				</font></td>
			<td align="left" valign="middle"><font size="3"><br />
				</font></td>
		</tr>';
		$vTR='
		<tr  class="lvlinehtable@01">
			<td align="center" >@#01</td>
			<td align="left">@#02</td>
			<td align="left" nowrap >@#03</td>
			<td align="center" nowrap >@#04</td>
			<td align="center" >@#05</td>
			<td align="center" >@#06</td>
			<td align="center" >@#07</td>
			<td align="right" >@#08</td>
			<td align="center" >@#09</td>
			<td align="center" >@#10</td>
			<td align="center" >@#11</td>
			<td align="center" >@#12</td>
			<td align="right" >@#13</td>
		</tr>
		';
		$vTRBold='
		<tr  class="lvlinehtable@01">
			<td align="center" colspan="3"><strong>Tổng:</strong></td>
			<td align="center" nowrap >&nbsp;</td>
			<td align="center" >&nbsp;</td>
			<td align="center" ><strong>@#06</strong></td>
			<td align="center" ><strong>@#07</strong></td>
			<td align="right" ><strong>@#08</strong></td>
			<td align="center" >&nbsp;</td>
			<td align="center" >&nbsp;</td>
			<td align="center" >&nbsp;</td>
			<td align="center" >&nbsp;</td>
			<td align="right" ><strong>@#13</strong></td>
		</tr>
		';
		{
			$strCondi="";
			
			if($this->CalID!="")
			{
				$strCondi=$strCondi." AND CC.lv001='$this->CalID' ";
			}
			if($this->lv221!="")
			{
				$strCondi=$strCondi." AND  A.lv022 in ('".str_replace(",","','",$this->lv221)."') ";
			}
			if($this->lv028!="")
				$strCondi=$strCondi." AND  DD.lv009 in ('".str_replace(",","','",$this->lv028)."') ";
			if($this->lv029!="")  $strCondi=$strCondi." AND DD.lv029 in (".$this->LV_GetDep($this->lv029).")";
			if($this->lv030!="")  $strCondi=$strCondi." AND DD.lv001 in ('".$this->lv030."')";
			if($this->isStaffOff==1)  $strCondi=$strCondi." AND year(DD.lv044)<2014 ";
			switch($this->lvSort)
			{
				case 0:
					$lvsql="select A.*,DD.lv001 CodeID,DD.lv002 Name,DD.lv010 CMND,DD.lv030 NgayVaoLam,DD.lv034 CuTru,DD.lv035 TamTru,DD.lv015 NgaySinh,DD.lv005 Title,DD.lv062 NhomCT,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from tc_lv0062 A inner join tc_lv0061 CC on A.lv002=CC.lv001  inner join hr_lv0020 DD on A.lv003=DD.lv001 where 1=1 $strCondi  order by DD.lv029 Asc,DD.lv008 asc";
					break;
				case 1:
					$lvsql="select A.*,DD.lv001 CodeID,DD.lv002 Name,DD.lv010 CMND,DD.lv030 NgayVaoLam,DD.lv034 CuTru,DD.lv035 TamTru,DD.lv015 NgaySinh,DD.lv005 Title,DD.lv062 NhomCT,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from tc_lv0062 A inner join tc_lv0061 CC on A.lv002=CC.lv001  inner join hr_lv0020 DD on A.lv003=DD.lv001 where 1=1 $strCondi  order by DD.lv002,A.lv016 asc";
					break;
				case 2:
					 $lvsql="select A.*,DD.lv001 CodeID,DD.lv002 Name,DD.lv010 CMND,DD.lv030 NgayVaoLam,DD.lv034 CuTru,DD.lv035 TamTru,DD.lv015 NgaySinh,DD.lv005 Title,DD.lv062 NhomCT,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from tc_lv0062 A inner join tc_lv0061 CC on A.lv002=CC.lv001  inner join hr_lv0020 DD on A.lv003=DD.lv001 where 1=1 $strCondi  order by DD.lv062,DD.lv099 asc";
					break;	
				case 3:
					 $lvsql="select A.*,DD.lv001 CodeID,DD.lv002 Name,DD.lv010 CMND,DD.lv030 NgayVaoLam,DD.lv034 CuTru,DD.lv035 TamTru,DD.lv015 NgaySinh,DD.lv005 Title,DD.lv062 NhomCT,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from tc_lv0062 A inner join tc_lv0061 CC on A.lv002=CC.lv001  inner join hr_lv0020 DD on A.lv003=DD.lv001 where 1=1 $strCondi  order by DD.lv099,DD.lv062 asc";
					break;	
				case 4:
					$lvsql="select A.*,DD.lv001 CodeID,DD.lv002 Name,DD.lv010 CMND,DD.lv030 NgayVaoLam,DD.lv034 CuTru,DD.lv035 TamTru,DD.lv015 NgaySinh,DD.lv005 Title,DD.lv062 NhomCT,DD.lv030 DateWork,DD.lv029 Dep,DD.lv099 from tc_lv0062 A inner join tc_lv0061 CC on A.lv002=CC.lv001  inner join hr_lv0020 DD on A.lv003=DD.lv001 where 1=1 $strCondi  order by CC.lv004,DD.lv001 asc";
					break;	
			}
			$vorder=$curRow;
			$bResult = db_query($lvsql);
			$strDepart='';
			
			$vlv079_0=0;
			$vlv024_0=0;
			$vlv019_0=0;
			$vlv028_0=0;
			$vlv015_0=0;
			$vlv020_0=0;
			$vlv050_0=0;
			$vlv025_0=0;
			$vlv085_0=0;
			$vlv043_0=0;
			$vlv039_0=0;
			$vlv045_0=0;
			$vlv035_0=0;
			$vlv048_0=0;
			$vlv084_0=0;
			$vlv080_0=0;
			$strTrH='';
			$vOrder=0;
			$vLan=0;
			$vObjCal=$this->ObjCal;
			while ($vrow = db_fetch_array ($bResult)){
				$vPrev=0;
				while($vPrev<=1)
				{
					$vABC=0;
					///MOI THEM CODE TINH ABC//////
					$vEmployeeID=$vrow['CodeID'];
					$this->mohr_lv0020->LV_LoadFullIDCal($vEmployeeID,$vDateCal);
					$this->MaxLe=$this->LV_CheckSoNgayLe($vObjCal->lv004,$vObjCal->lv005);
					$vLong_DateW=(float)str_replace("-","",$this->mohr_lv0020->lv030);
					$vLongDateCal=(float)str_replace("-","",$vObjCal->lv005);
					$this->LV_LoadPNQuy($vObjCal->lv007,$vObjCal->lv006);
					//if($vLongDateCal<$vLong_DateW) return;
					$vArrDepartment=Array();
					$vDepartmentID=$this->mohr_lv0020->lv029;

					if($vPrev==0)
						$vArrEmpPre=$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vrate,$vObjCal->lv001,$vArrEmp,$this->mohr_lv0038->lv001);
					else
						$vArrEmp["$vEmployeeID"]=$vArrEmpPre["$vEmployeeID"];
					//echo $vArrEmp["$vEmployeeID"][0]['ContractID'];
					$this->mohr_lv0038->LV_LoadID($vArrEmp["$vEmployeeID"][0]['ContractID']);


			//END CODE ABC//
					if($vArrEmp["$vEmployeeID"]!=NULL)
					{

						$vTongTC=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC150'])+$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC200'])+$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC300']);
						$vTimeWork=(float)$vArrEmp["$vEmployeeID"][0]['RGTimeS'];
						$vTimeWorkPre=$vArrEmpPre["$vEmployeeID"][0]['RGTimeS'];
						$vTimeWorkCT=(float)$vArrEmp["$vEmployeeID"][0]['PJTimeS'];
						$vTimeWorkCN=(float)$vArrEmp["$vEmployeeID"][0]['CNTimeS'];
						$vTimeWorkPreCT=(float)$vArrEmpPre["$vEmployeeID"][0]['PJTimeS'];
						$vTimeWorkPreCN=(float)$vArrEmpPre["$vEmployeeID"][0]['CNTimeS'];
						$vTimeDiv=$this->GetTime($this->mohr_lv0038->lv007);
						if($vTimeDiv==0) $vTimeDiv=8;
						///Ngày làm VP
						$this->lv013=$vTimeWork;
						///Ngày làm CT
						$this->lv014=$vTimeWorkCT;
						///Ngày làm CN
						$this->lv019=$vTimeWorkCN;
						
						$this->lv028=0;
						///Ngày công thực tế
						$vCongBu=(int)$vArrEmp["$vEmployeeID"][0]['B'];
						$this->lv093_pre=(int)$vArrEmpPre["$vEmployeeID"][0]['B'];
						$TongCong=round($vTimeWork+$vTimeWorkCT+$vCongBu,2);
						//$this->lv025_=round($vTimeWork+$vTimeWorkCT+$vTimeWorkPre+$vTimeWorkPreCT+$this->lv093+$this->lv093_pre,2);
						//Hiệu quả CV(ABC)
						$vdaydiv=22;
						$vdaydivoth=22;
						$isCongThem=true;
						$isFullW=false;
						switch($this->mohr_lv0038->lv011)
						{
							case 13:
								//$isCongThem=false;
							case 0:	
								$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
								break;
							case 1:
								$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
								break;
							case 2:
								$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
								break;
							case 3: 
								$vdaydiv=count($this->vArrDay)-6;
								break;
							case 4: 
								$vdaydiv=8;
								break;
							case 7: 
								$vdaydiv=22;
								break;
							case 8: 
								$vdaydiv=25;
								break;
							case 9: 
								$vdaydiv=24;
								break;
							case 10: 
								$vdaydiv=26;
								$isCongThem=false;
								break;
							case 11: 
								$isFullW=true;
								$vdaydiv=count($this->vArrDay);
								break;
							case 12: 
								$isFullW=true;
								$vdaydiv=30;
								$isCongThem=false;
								break;
							case 5: 
								$vdaydiv=count($this->vArrDay)-4;
								break;
						}
						$vABCPercen=$this->LV_GetPercent_HR($this->mohr_lv0020->lv009,$this->mohr_lv0020->lv030,$vObjCal->lv004,$this->mohr_lv0020->lv001);
						if($this->isSameHD==1)
						{
							$vABCPercen=100;
						}
						$vRate=$vrow['lv004'];
						//Hiệu quả CV(ABC)
						if($this->isRateTwo)
						{
							//Chua
							if($this->mohr_lv0038->lv003!=2 && $this->mohr_lv0038->lv003!=5)
								$vABC=$this->mohr_lv0038->lv013*($vABCPercen/100)*($vRate/100)*$TongCong/$vdaydiv;
							else
								$vABC=$this->mohr_lv0038->lv013*($vRate/100)*$TongCong/$vdaydiv;	
						}
						else
						{
							if($vPrev==0)
							{
								if($this->mohr_lv0038->lv013>0)
									$this->ACBPercentNext=100-$vABCPercen;
								else
									$this->ACBPercentNext=$vABCPercen;
								//if($this->mohr_lv0038->lv003!=2 && $this->mohr_lv0038->lv003!=5)
									$vABC=$this->mohr_lv0038->lv013*($vABCPercen/100)*($vRate/100);
								//else
								//	$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100);
							}
							else
							{
								//if($this->mohr_lv0038->lv003!=2 && $this->mohr_lv0038->lv003!=5)
									$vABC=$this->mohr_lv0038->lv013*($this->ACBPercentNext/100)*($vRate/100);
								//else
								//	$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100);
							}
							
							
						}
						$vOrder++;
						$vlv006=$vlv006+$TongCong;
						$vlv007=$vlv007+$vTongTC;
						$vlv008=$vlv008+$this->mohr_lv0038->lv013;
						$vlv013=$vlv013+$vABC;
						$vLineOne=$vTR;
						$vLineOne=str_replace("@01",$vOrder%2,$vLineOne);
						$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
						$vLineOne=str_replace("@#02",$vrow['CodeID'],$vLineOne);
						$vLineOne=str_replace("@#03",$vrow['Name'],$vLineOne);
						$vLineOne=str_replace("@#04",$vrow['Dep'],$vLineOne);
						$vLineOne=str_replace("@#05",$this->FormatView($vrow['NgayVaoLam'],2),$vLineOne);
						$vLineOne=str_replace("@#06",$this->FormatView($TongCong,20),$vLineOne);
						$vLineOne=str_replace("@#07",$this->FormatView($vTongTC,20),$vLineOne);
						$vLineOne=str_replace("@#08",$this->FormatView($this->mohr_lv0038->lv013,20),$vLineOne);
						$vLineOne=str_replace("@#09",$vrow['lv005'],$vLineOne);
						$vLineOne=str_replace("@#10",$vrow['lv006'],$vLineOne);
						$vLineOne=str_replace("@#11",$vrow['lv007'],$vLineOne);
						$vLineOne=str_replace("@#12",$vrow['lv008'],$vLineOne);
						$vLineOne=str_replace("@#13",$this->FormatView($vABC,20),$vLineOne);
						$strTrH=$strTrH.$vLineOne;
					}
					$vPrev++;
				}
			}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#06",$this->FormatView($vlv006,20),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv007,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv008,20),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vlv013,20),$vLineOne);
		$strTrH=$strTrH.$vLineOne;	
		$strFullTbl=$lvTable;
		$strFullTbl=str_replace("@#02",$strTrH,$strFullTbl);
		$strFullTbl=str_replace("@#04",$vOrder,$strFullTbl);
	}
		
		return $strFullTbl;	
	}
	function LV_GetDepartment($vDepID)
	{
		if($this->ArrDept[$vDepID][0]==true) return $this->ArrDept[$vDepID][1];
		$this->ArrDept[$vDepID][0]=true;
		$this->ArrDept[$vDepID][1]=$this->getvaluelink('lv029',$vDepID);
		return $this->ArrDept[$vDepID][1];
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
	
	function LV_GetSecond($lvStartTime,$lvEndTime)
	{
		$lvsql="select TIME_TO_SEC(TIMEDIFF('$lvEndTime','$lvStartTime')) as lv_time";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		return $vrow['lv_time'];
	}
	
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0011 A WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	
	public function GetTimeCode($vEmployeeID,$vStartDate,$vEndDate,$vTimeCode)
	{
		
		$lvList='lv001,lv002,lv003';
		$ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"1");
		$lvOrderList='0,1,2';
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$lvTable="
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=@#04>@02</td>";
		$lv_more_sql="select A2.lv001 from tc_lv0010 A2 where A2.lv002='$vEmployeeID'";
		$lv_condi_addmore=$this->GetMultiValue($lv_more_sql);
		/*$sqlS="select VM.lv001,C.lv002 lv002,sum(VM.SumHour) +sum(VM.SumMinute/60) + sum(VM.SumSecond/360) lv003 from(select A.lv001,A.lv002,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360  from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') )  SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004!='1'																																																																																			  		UNION
		 select A.lv001,A.lv002,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv006,2)) + sum(substr(A1.lv006,4,5))/60 + sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004='1'
		 UNION
		 select '$vTimeCode' lv001,A.lv002,A.lv004,100 PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004='1') VM left join tc_lv0002 C on VM.lv001=C.lv001   GROUP BY lv001;";*/
		$sqlS="select VM.lv001,C.lv002 lv002,sum(VM.SumHour) +sum(VM.SumMinute/60) + sum(VM.SumSecond/360) lv003 from(";
		$vsql="select * from tc_lv0002 where lv004!='1'";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$strTemp="";																								
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
				$strTemp="select '".$vrow['lv001']."' lv001,'".sof_escape_string($vrow['lv002'])."' lv002,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360  from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') )  SumHour,0 SumMinute,0 SumSecond ";
				else
				 $strTemp=$strTemp." Union select '".$vrow['lv001']."' lv001,'".sof_escape_string($vrow['lv002'])."' lv002,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360  from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') )  SumHour,0 SumMinute,0 SumSecond";
			}
		}
		$vsql="select * from tc_lv0002 where lv004='1'";
		$vresult=db_query($vsql);
		if($vresult)
		{																							
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
					$strTemp="select '".$vrow['lv001']."' lv001,'".$vrow['lv002']."' lv002,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv006,2)) + sum(substr(A1.lv006,4,5))/60 + sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond
					UNION
		 select '$vTimeCode' lv001,'".$vrow['lv002']."' lv002,'".$vrow['lv004']."' lv004,100 PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond";
				 else
				 	$strTemp=$strTemp." Union select '".$vrow['lv001']."' lv001,'".$vrow['lv002']."' lv002,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv006,2)) + sum(substr(A1.lv006,4,5))/60 + sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond
					UNION
		 select '$vTimeCode' lv001,'".$vrow['lv002']."' lv002,'".$vrow['lv004']."' lv004,100 PerCent,(select sum(left(A1.lv005,2)) + sum(substr(A1.lv005,4,5))/60 + sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$lv_condi_addmore.") and (A1.lv004<='$vEndDate' and A1.lv004>='$vStartDate') ) SumHour,0 SumMinute,0 SumSecond";
			}
		}
		$sqlS=$sqlS.$strTemp.") VM left join tc_lv0002 C on VM.lv001=C.lv001   GROUP BY lv001;";
		$vSumSalary=0;
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if($bResult ) {
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$this->ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"10","lv004"=>"10");
		if($this->lang=='CN')
		{
			$this->ArrTimeCordPush[2]="Code";
			$this->ArrTimeCordPush[3]="Name code";
			$this->ArrTimeCordPush[4]="Hour(h)";
			$this->ArrTimeCordPush[5]="Date(d)";
		}
		else
		{
			$this->ArrTimeCordPush[2]="Mã công";
			$this->ArrTimeCordPush[3]="Tên công";
			$this->ArrTimeCordPush[4]="Giờ công(h)";
			$this->ArrTimeCordPush[5]="Ngày công(d)";
		}
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrTimeCordPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				if($lstArr[$i]=='lv003')
				{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrTimeCordPush[5],$vTemp);
				$strH=$strH.$vTemp;
				}
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			 $vSumSalary= $vSumSalary+$vrow['lv006'];
			for($i=0;$i<count($lstArr);$i++)
			{				
				$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$lvTd);
				$strL=$strL.$vTemp;
				if($lstArr[$i]=='lv003')
				{
					$vTemp=str_replace("@02",$this->FormatView($vrow['lv003']/8,(int)$this->ArrView[$lstArr[$i]]),$lvTd);
					$strL=$strL.$vTemp;
				}
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			$strTr=str_replace("@#04","",$strTr);
			
		}
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
		
		
	
	}
	function Get_String_DateFromTo()
	{
		$this->lvHeader="";
		$vTD_TrangThai='<td >Thời gian scan</td><td>Trạng thái</td><td>Scan</td><td>Không scan</td>';
		$vTD_TrangThaiBold='<td  style="background:#d3d3d3">Thời gian scan</td><td style="background:#d3d3d3">Trạng thái</td><td style="background:#d3d3d3">Scan</td><td style="background:#d3d3d3">Không scan</td>';
		$strTD="";
		$lvNumDate=DATEDIFF($this->dateto,$this->datefrom);
		$datecur=$this->datefrom;
		for($i=1;$i<=$lvNumDate+1;$i++)
		{
			$vDows=date('w', strtotime($datecur))+1;
			if($vDows==1)
			{
				$this->DateSun++;
				$this->lvHeader=$this->lvHeader.'<td colspan="4" class="tdhprint" style="background:#d3d3d3"><center><b>'.Fillnum(getday($datecur),2).'</b></center></td>';
				$this->lvHeader1=$this->lvHeader1.$vTD_TrangThaiBold;
				$this->lvFooter=$this->lvFooter.'<td colspan="4" style="background:#d3d3d3"><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
				$strTD=$strTD.''."<!--".str_replace("/","-",$datecur)."-->".'';
				$this->strTDF=$this->strTDF.'<td style="background:#d3d3d3">&nbsp;</td><td style="background:#d3d3d3">&nbsp;</td>'."<td style=\"background:#d3d3d3\"><!--Scan:".str_replace("/","-",$datecur)."-->".'</td><td  style="background:#d3d3d3"><!--NoScan:'.str_replace("/","-",$datecur)."-->".'</td>';
			}
			else
			{
				$this->lvHeader=$this->lvHeader.'<td colspan="4" class="tdhprint"><center><b>'.Fillnum(getday($datecur),2).'</b></center></td>';
				$strTD=$strTD.''."<!--".str_replace("/","-",$datecur)."-->".'';
				$this->strTDF=$this->strTDF.'<td>&nbsp;</td><td>&nbsp;</td>'."<td><!--Scan:".str_replace("/","-",$datecur)."-->".'</td><td><!--NoScan:'.str_replace("/","-",$datecur)."-->".'</td>';
				$this->lvHeader1=$this->lvHeader1.$vTD_TrangThai;
				$this->lvFooter=$this->lvFooter.'<td colspan="4"><center>'."<!--F-".str_replace("/","-",$datecur)."-->".'</center></td>';
			}
			$datecur=ADDDATE($this->datefrom,$i);
		}
		return $strTD;
	}
//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi=" and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where (DD.lv009=0 or DD.lv009=1)").")").")";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and A.lv010 like '%$this->lv010%'";
		if($this->lv028!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv009 in ('".str_replace(",","','",$this->lv028)."')").")").")";
		if($this->lv029!="")  $strCondi=$strCondi." and C.lv029 in (".$this->LV_GetDep($this->lv029).")";
		return $strCondi;
	}
	protected function GetConditionOrther()
	{
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		//if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->datefrom!="")  $strCondi=$strCondi." and A.lv004  >= ADDDATE('$this->datefrom',-1)";
		if($this->dateto!="")  $strCondi=$strCondi." and A.lv004  <= ADDDATE('$this->dateto',1)";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and A.lv010 like '%$this->lv010%'";
		if($this->lv028!="")  $strCondi=$strCondi." and B.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv009 in ('".str_replace(",","','",$this->lv028)."')").")";
		if($this->lv029!="")  $strCondi=$strCondi." and B.lv002 in (".$this->GetMultiValue("select DD.lv001 from hr_lv0020 DD where DD.lv029 in (".$this->LV_GetDep($this->lv029).")").")";
		if($this->lv030!="")  $strCondi=$strCondi." and A.lv002 in (".$this->GetMultiValue("select CC.lv001 from tc_lv0010 CC where CC.lv002 in ('".$this->lv030."')").")";
		return $strCondi;
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
	function SumSQLRun($vSQL,$vColpan,$vLang,$plang)
	{
		$vtr="<tr onDblClick=\"this.innerHTML=''\" style=\"cursor:move;font-size:20px;font-weight:bold\"><td class=\"right_hr\" colspan=\"$vColpan\" valign=\"top\" >$vLang: @01</td></tr>";
		$bResultS = db_query($vSQL);
		$vValue="";
		while($arrS=db_fetch_array($bResultS)){		
			if($vValue=="") $vValue=Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
			else $vValue=$vValue." ; ".Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
		}
		if($vValue!="") return  str_replace("@01",$vValue,$vtr);
		return "";
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
			$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
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
			$strTemp=str_replace("@#02",$vspace.'|-----'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow1['lv001'],$vTbl,$vFieldView,$i,$numrows,$vspace.'&nbsp;&nbsp;&nbsp;');
			$i++;
		}
		$i--;
		return $strGetScript;
	}
	public function GetBuilCheckList($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
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
		$vsql="select * from  ".$vTbl;
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
			$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	public function LV_LinkField($vFile,$vSelectlv001)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectlv001),2));
	}
private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv001':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0061";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";				
			case 'lv010':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004";
				break;
			case 'lv029':
				$vsql="select lv001,CONCAT(lv003,'[',lv002,']') lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
				break;
		}
		return $vsql;
	}
	public function getvaluelink($vFile,$vSelectID)
	{
		if (!empty($this->ArrGetValueLink[$vFile][$vSelectID][0] ?? null)) {return $this->ArrGetValueLink[$vFile][$vSelectID][1] ?? null;}
		if($vSelectID=="")
		{
			return $vSelectID;
		}
		switch($vFile)
		{
			case 'lv002':
				$vsql="select tc_lv0010.lv002,concat(hr_lv0020.lv004,' ',hr_lv0020.lv003,' ',hr_lv0020.lv002,'(',hr_lv0020.lv001,')') lv002,IF(tc_lv0010.lv001='$vSelectID',1,0) lv003 from  tc_lv0010 left join hr_lv0020 on hr_lv0020.lv001=tc_lv0010.lv002 where tc_lv0010.lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002 where lv001='$vSelectID'";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv010':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004 where lv001='$vSelectID'";
				break;
			case 'lv029':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 where lv001='$vSelectID'";
				break;
		}
		if($vsql=="")
		{
			return $vSelectID;
		}
		else
		{
			$lvResult = db_query($vsql);
			$this->ArrGetValueLink[$vFile][$vSelectID][0]=true;
		}
		while($row= db_fetch_array($lvResult)){
			$this->ArrGetValueLink[$vFile][$vSelectID][1]=($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
			return $this->ArrGetValueLink[$vFile][$vSelectID][1];
		}
		
	}
}
	?>