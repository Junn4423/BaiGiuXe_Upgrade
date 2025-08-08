<?php
/////////////coding tc_lv0011///////////////
class   tc_lv0011 extends lv_controler
{
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
	public $lv011=null;
	public $lv012=null;
	

///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv013,lv014,lv015,lv016,lv099,lv100";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	public $EmpCalendar=null;
	public $EMPALL=null;
	protected $objhelp='tc_lv0011';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv099"=>"100");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"0","lv016"=>"0","lv099"=>"0");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;
		$this->isRpt=0;	
		$this->isApr=0;
		$this->isUnApr=0;	
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=1;
		$this->lang=$_GET['lang'];
		$this->EmpCalendar=Array();
		
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv007 from  tc_lv0010 Where lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv007']>=1)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_CheckCountHDLD($vContractLaborID)
	{
		$lvsql="select count(*) nums from  tc_lv0011 Where lv099='$vContractLaborID'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			return $vrow['nums'];
			
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  tc_lv0011";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];
			
		}
		else
		{
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
			$this->lv007=null;
			$this->lv008=null;
			$this->lv009=null;
			$this->lv010=null;
			$this->lv011=null;
			$this->lv012=null;
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  tc_lv0011 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];	
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];	
			$this->lv012=$vrow['lv012'];
		}
		else
		{
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
			$this->lv007=null;
			$this->lv008=null;
			$this->lv009=null;
			$this->lv010=null;
			$this->lv011=null;
			$this->lv012=null;
		}
	}
	function GetBuilCalendar($vEmployeeID,$vField)
	{
		if($this->EmpCalendar[$vEmployeeID][0]!=true)
		{
		$this->EmpCalendar[$vEmployeeID][0]=true;
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
			$this->EmpCalendar[$vEmployeeID][1]=$strReturn;
		}
		}
		return $this->EmpCalendar[$vEmployeeID][1];
	}
	function LV_GetHoliday($vStartDate,$vEndDate,$vField='lv002')
	{
		$vsql="select $vField  from tc_lv0003  where lv002>='$vStartDate' and lv002<='$vEndDate'";
		$vresult=db_query($vsql);
			$strReturn="";
			if($vresult)
			{
				while($vrow=db_fetch_array($vresult))
				{
			   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
					else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
				}
				if($strReturn=='') return "''";
				return $strReturn;
			}
			if($strReturn=='') return "''";
			return $strReturn;
		
	}
	function LV_LoadDate($vEmployeeID,$vDateWork)
	{
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		$lvsql="select * from tc_lv0011  where lv002 in (".$calendar.")  and lv004='$vDateWork' ";		
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];	
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
		}
		else
		{
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
			$this->lv007=null;
			$this->lv008=null;
			$this->lv009=null;
			$this->lv010=null;
			$this->lv011=null;
			$this->lv013=null;
			$this->lv014=null;
			$this->lv015=null;
		}
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$lvsql="insert into tc_lv0011 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012')";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 $this->InsertLogOperation($this->DateCurrent,'tc_lv0011.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}	
	//Update auto	
	function LV_UpdateAuto($vEmployeeID,$vDateWork,$vRegularH,$vTimecode=0)
	{
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		$vsql="update tc_lv0011   set lv005='$vRegularH' where lv002 in ($calendar)  and lv004='$vDateWork' ";		
		return db_query($vsql);
	}
	function LV_EMPALLLIST($vStartDate,$vEndDate)
	{
		$vsql="select A.lv001,A.lv004,B.lv002 EMPID from tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 where (A.lv004)>='$vStartDate' and (A.lv004)<='$vEndDate';";
		$this->EMPALL[$vEmployeeID][0]=true;
		$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
				$this->EMPALL[$vrow['EMPID']][$vrow['lv004']]=$vrow['lv001'];
			}
		}
	}
	function LV_UpdateCodeEmp($vEmployeeID,$vDateWork,$vTimecode)
	{
			$vsql="update tc_lv0011   set lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";		
			return db_query($vsql);

	}
	function LV_UpdateCodeEatThuong($vCodeID,$vCom,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv010='$vCom' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv010='$vCom'";
			return db_query($vsql);
	}
	function LV_UpdateCodeEatTC($vCodeID,$vCom,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv008='$vCom' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv008='$vCom'";
			return db_query($vsql);
	}
	function LV_UpdateCodeEmpOption($voptTime,$vEmployeeID,$vDateWork,$vTimecode,$vMoreAdv=0)
	{
		if($vMoreAdv==0)
		{
			switch($voptTime)
			{
				case 0:
					$vsql="update tc_lv0011   set lv016='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
					break;
				case 1:
					$vsql="update tc_lv0011   set lv014='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
					break;
				case 2:
					$vsql="update tc_lv0011   set lv017='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
					break;
				case 15:
					$vsql="update tc_lv0011   set lv015='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
					break;
				case 35:
					$vsql="update tc_lv0011   set lv021='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
					break;
				case 25:
					switch(trim($vTimecode))
					{
						case 'P':
						case 'L':
						case 'B':
						case 'HL':
							$vsql="update tc_lv0011   set lv005='08:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						case '8':
							$vsql="update tc_lv0011   set lv005='08:00',lv007=IF(lv021='VP' or lv021='' or ISNULL(lv021),'VP','CT') where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						case '0.5':
							$vsql="update tc_lv0011   set lv005='04:00',lv007=IF(lv021='VP' or lv021='' or ISNULL(lv021),'VP','CT') where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";	
							break;
						case '0.5CT':
							$vsql="update tc_lv0011   set lv005='04:00',lv007='CT' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";	
							break;
						case '0.5VP':
							$vsql="update tc_lv0011   set lv005='04:00',lv007='VP' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";	
							break;
						case '0.5P':
							$vsql="update tc_lv0011   set lv005='04:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						case '4':
							$vsql="update tc_lv0011   set lv005='04:00',lv007='VP' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
						break;
						case 'VR':
						case 'KP':
						case 'TN':
						case 'TS':
							$vsql="update tc_lv0011   set lv005='00:00',lv016='00:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						case '0.5CL':
							$vsql="update tc_lv0011   set lv005='04:00',lv016='04:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
						break;
						default:
							if(is_numeric($vTimecode) && $vTimecode>0)
							{
								$vTimecode=str_replace(",",".",$vTimecode);
								//if($vTimecode>8) $vTimecode=8;
								$vTimeW=$this->LV_ConvertTime($vTimecode);
								$vsql="update tc_lv0011   set lv005='$vTimeW',lv007=IF(lv021='VP' or lv021='' or ISNULL(lv021),'VP','CT') where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							}
							else
							{
								$vTimecode=trim($vTimecode);
								$vsql="update tc_lv0011   set lv005='00:00',lv016='00:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							}
						break;
					}
					//echo $vsql;
					//echo "<br/>";
					break;
				
			}
			return db_query($vsql);
		}
		else
		{
			switch($vMoreAdv)
			{
				case 1:
					$vTimecode=$this->LV_ConvertTime($vTimecode);
					$vsql="update tc_lv0011   set lv014='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
					break;
				case 2:
					$vTimecode=$this->LV_ConvertTime($vTimecode);
					$vsql="update tc_lv0011   set lv016='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
					break;
				case 3:
					$vTimecode=$this->LV_ConvertTime($vTimecode);
					$vsql="update tc_lv0011   set lv017='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
					break;
				case 4:
					$vTimecode=$this->LV_ConvertTime($vTimecode);
					$vsql="update tc_lv0011   set lv018='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
					break;
				case 35:
					$vsql="update tc_lv0011   set lv021='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
					break;
				case 10:
					$vTimecode=strtoupper($vTimecode);
					switch(trim($vTimecode))
					{
						case 'P':
						case 'L':
						case 'CT':
						case 'VP':
						case 'HL':
						case 'B':
							$vsql="update tc_lv0011   set lv005='08:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						case '0.5VR':
							$vsql="update tc_lv0011   set lv005='04:00',lv007='0.5VR' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";	
							break;
						case '0.5P':
							$vsql="update tc_lv0011   set lv005='04:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						case '4':
							$vsql="update tc_lv0011   set lv005='04:00',lv007=IF(lv021='VP' or lv021='' or ISNULL(lv021),'VP','CT') where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
						break;
						case 'VR':
						case 'KP':
						case 'TN':
						case 'TS':
							$vsql="update tc_lv0011   set lv005='00:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						break;
						default:
						if(strpos($vTimecode,'+')===false)
						{
							$vTimecode=str_replace(",",".",$vTimecode);
							if(is_numeric($vTimecode) && $vTimecode>0)
							{
								$vTimecode=str_replace(",",".",$vTimecode);
								if($vTimecode<=0.5) 
									$vCodeShow='0.5VR';
								else
								 	$vCodeShow='VP';
								$vTimecodeH=$vTimecode*8;
								$vTimecode=$this->LV_ConvertTime($vTimecodeH);
								$vsql="update tc_lv0011  set lv005='$vTimecode',lv007='$vCodeShow' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							}
							else
							{
								$vTimecode=trim($vTimecode);
								$vsql="update tc_lv0011   set lv005='00:00',lv016='00:00',lv007='$vTimecode',lv016='00:00:00' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							}
						}
						else
						{
							$vTimecode=str_replace(",",".",$vTimecode);
							$vArrTimeCode=explode("+",$vTimecode);
							if(is_numeric($vArrTimeCode[0]) && $vArrTimeCode[0]>0)
							{
								$vTimecode=$vArrTimeCode[0];
								
								if($vArrTimeCode[1]=='0.5P')
								{
									$vCodeShow='0.5P';
									$vTimecode=$vTimecode+0.5;
								}
								else
								{
									if($vTimecode<=0.5) 
										$vCodeShow='0.5VR';
									else
										$vCodeShow='VP';
								}
								$vTimecodeH=$vTimecode*8;
								$vTimecode=$this->LV_ConvertTime($vTimecodeH);
								$vsql="update tc_lv0011  set lv005='$vTimecode',lv007='$vCodeShow' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							}
							else
							{
								$vTimecode=trim($vTimecode);
								$vsql="update tc_lv0011   set lv005='00:00',lv016='00:00',lv007='$vTimecode',lv016='00:00:00' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							}
						}
						break;
					}
					break;
				default:
					$vTimecode=strtoupper($vTimecode);
					switch(trim($vTimecode))
					{
						case 'P':
						case 'L':
						case 'CT':
						case 'VP':
						case 'HL':
							$vsql="update tc_lv0011   set lv005='08:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						case '0.5':
							$vsql="update tc_lv0011   set lv005='04:00',lv007=IF(lv021='VP' or lv021='' or ISNULL(lv021),'VP','CT') where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";	
							break;
						case '0.5P':
							$vsql="update tc_lv0011   set lv005='04:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						case '4':
							$vsql="update tc_lv0011   set lv005='04:00',lv007='8' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						case 'VR':
						case 'KP':
						case 'TN':
						case 'TS':
							$vsql="update tc_lv0011   set lv005='00:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							break;
						default:
							$vTimecode=str_replace(",",".",$vTimecode);
							if(is_numeric($vTimecode) && $vTimecode>0)
							{
								//if($vTimecode>8) $vTimecode=8;
								$vTimeW=$this->LV_ConvertTime($vTimecode);
								$vsql="update tc_lv0011   set lv005='$vTimeW',lv007='VP' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
								
							}
							else
							{
								$vTimecode=trim($vTimecode);
								$vsql="update tc_lv0011   set lv005='00:00',lv007='$vTimecode' where lv001='".$this->EMPALL[$vEmployeeID][$vDateWork]."'";
							}
						break;
					}
					break;
			}
			return db_query($vsql);
		}
	}
	function LV_ConvertTime($vhw)
	{
		$vhw=round($vhw,2);
		$vArrH=explode(".",$vhw);
		$vH=$vArrH[0];
		if(strlen($vArrH[1])==1)
			$vM=round(($vArrH[1]/10)*60,1);
		else
			$vM=round(($vArrH[1]/100)*60,1);
		$vArrM=explode(".",$vM);
		$sM=$vArrM[0];
		$vS=($vArrM[1]/10)*60;
		return Fillnum($vH,2).':'.Fillnum($sM,2).':'.Fillnum($vS,2);
	}
	function LV_UpdateShiftEmp($vCodeID,$vShift,$vExe=0)
	{		
			$vsql="update tc_lv0011   set lv015='$vShift' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv015='$vShift'";
			return db_query($vsql);

	}
	function LV_UpdateProject($vCodeID,$vProjectID,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv021='$vProjectID' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv021='$vProjectID'";
			return db_query($vsql);

	}
	function LV_UpdateCongEmp($vCodeID,$vTimecode)
	{
			$vsql="update tc_lv0011   set lv007='$vTimecode' where lv001='".$vCodeID."'";		
			return db_query($vsql);

	}
	function LV_UpdateTimeWorkEmp($vCodeID,$vRegular,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv005='$vRegular' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv005='$vRegular'";
			return db_query($vsql);
	}
	function LV_UpdateTime22h($vCodeID,$vRegular,$vExe=0)
	
	{		

			$vsql="update tc_lv0011  set lv028 ='$vRegular' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv028='$vRegular'";
			return db_query($vsql);
	}
	function LV_UpdateTimeTCEmp($vCodeID,$vTimeTC,$vExe=0)
	{
			//$vsql="update tc_lv0011   set lv006='$vTimeTC' where lv001='".$vCodeID."'";	

			$vsql = "UPDATE tc_lv0011 
				 SET lv028 = '$vRegular', 
					 lv017 = '$vRegular', 
					 lv018 = '$vRegular' 
				 WHERE lv001 = '$vCodeID'";	
			if($vExe==1) return ",lv014='$vTimeTC'";
			return db_query($vsql);
	}
	function LV_UpdateTimeLateSoonEmp($vCodeID,$vTimeLate,$vTimeSoon,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv019='$vTimeLate',lv020='$vTimeSoon' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv019='$vTimeLate',lv020='$vTimeSoon'";
			return db_query($vsql);
	}
	function LV_UpdateTimeLateEmp($vCodeID,$vTimeLate)
	{
			$vsql="update tc_lv0011   set lv019='$vTimeLate' where lv001='".$vCodeID."'";		
			return db_query($vsql);
	}
	function LV_UpdateTimeSoonEmp($vCodeID,$vTimeSoon)
	{
			$vsql="update tc_lv0011   set lv020='$vTimeSoon' where lv001='".$vCodeID."'";		
			return db_query($vsql);
	}
	function LV_UpdateTimeDiTreEmp($vCodeID,$vTimeDiTre,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv019='$vTimeDiTre' where lv001='".$vCodeID."'";	
			if($vExe==1) return ",lv019='$vTimeDiTre'";			
			return db_query($vsql);

	}
	function LV_UpdateTimeVeSomEmp($vCodeID,$vTimeVeSom,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv016='$vTimeVeSom' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv016='$vTimeVeSom'";
			return db_query($vsql);

	}
	function LV_UpdateTimeOverMiddle($vCodeID,$vTimeTCTrua,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv016='$vTimeTCTrua' where lv001='".$vCodeID."'";	
			if($vExe==1) return ",lv016='$vTimeTCTrua'";			
			return db_query($vsql);

	}
	function LV_UpdateTimeOverNight($vCodeID,$vTimeVeSom,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv017='$vTimeVeSom' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv017='$vTimeVeSom'";
			return db_query($vsql);

	}
	function LV_UpdateXinDiTreVeSom($vCodeID,$vTimeVeSom,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv013='$vTimeVeSom' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv013='$vTimeVeSom'";
			return db_query($vsql);

	}
	function LV_UpdateTimeOverHoliday($vCodeID,$vTimeVeSom,$vExe=0)
	{
			$vsql="update tc_lv0011   set lv018='$vTimeVeSom' where lv001='".$vCodeID."'";		
			if($vExe==1) return ",lv018='$vTimeVeSom'";
			return db_query($vsql);
	}
	function LV_UpdateAutoDelay($vEmployeeID,$vDateWork,$vRegularH,$vTimecode=0)
	{
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		 $vsql="update tc_lv0011   set lv016='$vRegularH' where lv002 in ($calendar)  and lv004='$vDateWork' ";		
		return db_query($vsql);
	}
	function LV_UpdateAutoMore($vEmployeeID,$vDateWork,$vRegularH,$vTimecode=0)
	{
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		$vsql="update tc_lv0011   set lv014='$vRegularH' where lv002 in ($calendar)  and lv004='$vDateWork' ";		
		return db_query($vsql);
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$lvsql="Update tc_lv0011 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0011.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM tc_lv0011  WHERE  tc_lv0011.lv001 IN ($lvarr) and (select count(*) from tc_lv0010 B where  B.lv001= tc_lv0011.lv002 AND B.lv007<=0)>0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0011.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_DeleteParent($lvarr)
	{
		if($this->isDel==0) return false;
		
		$lvsql = "DELETE FROM tc_lv0011  WHERE  tc_lv0011.lv002 IN (select lv001 from tc_lv0010 A where A.lv001 in ($lvarr) AND A.lv007<=0 )";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0011.delete',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0011 set lv007=1  WHERE tc_lv0011.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0011.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_GetCalendarEmp($vEmpID,$vField='lv001')
	{
		$vsql="select $vField from tc_lv0010 where lv002 ='$vEmpID' ";
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
	function LV_CopyCalendarAn($lvarr,$vEmpID)
	{
		if($this->isEdit==0) return false;
		$vsql="select lv004,lv005,lv006,lv007,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020 from tc_lv0011 where lv001 in ($lvarr) and lv100=1";
		$vresult=db_query($vsql);
		$vListCalendar=$this->LV_GetCalendarEmp($vEmpID);
		while($vrow=db_fetch_array($vresult))
		{
			$vsqlupdate="update tc_lv0011 set  lv005='".$vrow['lv005']."',lv006='".$vrow['lv006']."',lv007='".$vrow['lv007']."',lv010='".$vrow['lv010']."',lv011='".$vrow['lv011']."',lv012='".$vrow['lv012']."',lv013='".$vrow['lv013']."',lv014='".$vrow['lv014']."',lv015='".$vrow['lv015']."',lv016='".$vrow['lv016']."',lv017='".$vrow['lv017']."',lv018='".$vrow['lv018']."',lv019='".$vrow['lv019']."',lv020='".$vrow['lv020']."' where lv004='".$vrow['lv004']."' and lv100='0' and lv002 in ($vListCalendar) ";
			db_query($vsqlupdate);
		}
	}
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0011 set lv007=0  WHERE tc_lv0011.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0011.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_CheckLocked($vlv002)
	{
		 $lvsql="select lv007 from  tc_lv0010 Where lv001='$vlv002'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['lv007']<=0) 
					return true;
				else 
					return false;
			}
			else
			return false;
		}else
		return false;
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
	//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  = '$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and lv011 like '%$this->lv012%'";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0011 WHERE lv100<>1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
			//////////////////////Buil list////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		if($curRow<0) $curRow=0;	$this->LV_CheckLock();
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort="";
		switch($lvSortNum)
		{
			case 0:
				break;
			case 1:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"asc");
				break;
			case 2:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"desc");
				break;
		}
		$lvTable="
		<table  align=\"center\" class=\"lvtable\">
		<!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</td></tr>
		@#01
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>
			@#01
		</tr>
		";
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=@#04>@02</td>";
		$sqlS = "SELECT * FROM tc_lv0011 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strTr = '';
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				//$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
$vTemp = str_replace("@02", $this->ArrPush[$this->ArrGet[$lstArr[$i]] ?? 0] ?? '', $vTemp);

				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				//$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				
				
								// Lấy tên cột hiện tại
				$key = $lstArr[$i];

				// Lấy giá trị từ $vrow, nếu không có thì dùng chuỗi rỗng
				$value = isset($vrow[$key]) ? $vrow[$key] : '';

				// Lấy kiểu định dạng hiển thị
				$format = isset($this->ArrView[$key]) ? (int)$this->ArrView[$key] : 0;

				// Gọi FormatView và getvaluelink an toàn
				$formattedValue = $this->FormatView($value, $format);
				$linkedValue = $this->getvaluelink($key, $formattedValue);

				// Lấy giá trị lv001 nếu có
				$lv001 = isset($vrow['lv001']) ? $vrow['lv001'] : '';

				// Thay thế trong chuỗi href
				$hrefReplaced = str_replace("@01", $lv001, $lvHref);

				// Thay thế @02 bằng linkedValue trong href
				$hrefFinal = str_replace("@02", $linkedValue, $hrefReplaced);

				// Căn chỉnh nội dung theo kiểu format
				$aligned = $this->Align($lvTd, $format);

				// Thay thế @02 lần cuối cùng trong chuỗi đã căn chỉnh
				$vTemp = str_replace("@02", $hrefFinal, $aligned);

				
				
				
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\">
						<li class=\"menusubT1\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			window.open('".$this->Dir."tc_lv0011/?lang=".$this->lang."&childdetailfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
		}
	
		
		</script>
";
		$lvScript="<li class=\"menuT\"> @01 </li>";
		$lvexcel="<input class=lvbtdisplay type=\"button\" id=\"lvbuttonexcel\" value=\"".$this->ArrFunc[13]."\" onclick=\"Export($lvFrom,'excel')\">";
		$lvpdf="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrFunc[15]."\" onclick=\"Export($lvFrom,'pdf')\">";
		$lvword="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrFunc[14]."\" onclick=\"Export($lvFrom,'word')\">";
		$strGetList="";
		$strGetScript="";
		
		$strTemp=str_replace("@01",$lvexcel,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvword,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvpdf,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strReturn=str_replace("@#01",$strGetScript,$lvSelect).$strScript;
		return $strReturn;
		
	}
	/////////////////////ListFieldSave//////////////////////////
	function ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrder,$lvSortNum)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvArrOrder=explode(",",$lvOrder);
		$lvSelect="<ul id=\"menu-nav\" onkeyup=\"return CheckKeyCheckTab(event,$lvFrom,".count($lstArr).")\">
						<li class=\"menusubT\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[11]."
							<ul id=\"submenu-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function SelectChk(vFrom,len)
		{
			vFrom.txtFieldList.value=getChecked(len,'lvdisplaychk');
			vFrom.txtOrderList.value=getAlllen(len,'lvorder');
			vFrom.txtFlag.value=2;
			vFrom.submit();
		}
		function lv_on_open(opt)
		{
			div = document.getElementById('lvsllist');
			if(opt==0)
			{
				div.size=1;
			}
			else
				div.size=div.length;
			
		}
		function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{

				if(str=='') 
					str=''+div.value;
				else
					 str=str+','+div.value;

				}
			}
			return str;
		}
		function getAlllen(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
				div = document.getElementById(nameobj+i);
				if(str=='') 
					str=''+div.value;
				else
					 str=str+','+div.value;
			}
			return str;
		}
		</script>
";
		$lvScript="<li class=\"menuT\"> @01 </li>";
		$lvNumPage="".$this->ArrOther[2]."<input type=\"text\" class=\"lvmaxrow\" name=lvmaxrow id=lvmaxrow value=\"$maxRows\">";
		$lvSortPage="".GetLangSort(0,$this->lang)."<select class=\"lvsortrow\" name=lvsort id=lvsort >
				<option value=0 ".(($lvSortNum==0)?'selected':'').">".GetLangSort(1,$this->lang)."</option>
				<option value=1 ".(($lvSortNum==1)?'selected':'').">".GetLangSort(2,$this->lang)."</option>
				<option value=2 ".(($lvSortNum==2)?'selected':'').">".GetLangSort(3,$this->lang)."</option>
		</select>";
		$lvChk="<input type=\"checkbox\" id=\"lvdisplaychk@01\" name=\"lvdisplaychk@01\" value=\"@02\" @03><input id=\"lvorder@01\" name=\"lvorder@01\"  type=\"text\" value=\"@06\"\ style=\"width:20px\" >";
		$lvButton="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrOther[1]."\" onclick=\"SelectChk($lvFrom,".count($lstArr).")\">";
		$strGetList="";
		$strGetScript="";
		$strTemp=str_replace("@01",$lvButton,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvNumPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
				$strTemp=str_replace("@01",$lvSortPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		
		for ($i=0;$i<count($lstArr);$i++)
		{
			
			//$strTempChk=str_replace("@01",$i,$lvChk.$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]]);
			
			
			$key = $lstArr[$i];
			$getKey = $this->ArrGet[$key] ?? null;

			if (isset($this->ArrPush[(int)$getKey])) {
				$strTempChk = str_replace("@01", $i, $lvChk . $this->ArrPush[(int)$getKey]);
			} else {
				// Gán mặc định hoặc xử lý lỗi
				$strTempChk = str_replace("@01", $i, $lvChk . "[N/A]");
			}
			$strTempChk=str_replace("@02",$lstArr[$i],$strTempChk);
			
			$strTempChk=str_replace("@07",100+$i,$strTempChk);
			if(strpos($lvList,",".$lstArr[$i].",") === FALSE)
			{
				$strTempChk=str_replace("@03","",$strTempChk);
				
			}
			else
			{
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			}
			if(!isset($lvArrOrder[$i]) || $lvArrOrder[$i] === NULL || $lvArrOrder[$i] === "")
				{
				$strTempChk=str_replace("@06",$i,$strTempChk);
				}
			else
				$strTempChk=str_replace("@06",$lvArrOrder[$i],$strTempChk);
			
			
			$strTemp=str_replace("@01",$strTempChk,$lvScript);
			$strGetScript=$strGetScript.$strTemp;
		}
		$strReturn=str_replace("@#01",$strGetScript,$lvSelect).$strScript;
		return $strReturn;
		
	}
	public function GetBuilCheckList($vListID,$vID,$vTabIndex)
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		<script language=\"javascript\">
		function getChecked(len,nameobj,namevalue)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				div1 = document.getElementById(namevalue+i);
				if(str=='') 
					str=(namevalue=='')?div.value:div1.value;
				else
					 str=str+','+(namevalue=='')?div.value:div1.value;
				}
			
			}
			return str;
		}
		</script>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql="select * from  hr_lv0004";
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
			{
				$strTempChk=str_replace("@03","",$strTempChk);
			}
			else
			{
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			}
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			$strTemp=str_replace("@#02",$vrow['lv002']."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
//////////////////////Buil list////////////////////
	function LV_BuilListReport($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
			
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort="";
		switch($lvSortNum)
		{
			case 0:
				break;
			case 1:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"asc");
				break;
			case 2:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"desc");
				break;
		}
		$lvTable="<!--<div align=\"center\"><img  src=\"".$this->GetLogo()."\" style=\"max-width:1024px\" /></div>-->
		<div align=\"center\"><h1>".($this->ArrPush[0])."</h2></div>
		<table  align=\"center\" class=\"lvtable\" border=1>
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% class=@#04>@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=@#04>@02</td>";
		$sqlS = "SELECT * FROM tc_lv0011 WHERE lv100<>1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
			
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort="";
		switch($lvSortNum)
		{
			case 0:
				break;
			case 1:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"asc");
				break;
			case 2:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"desc");
				break;
		}
		$lvTable="
		<div align=\"center\" class=lv0>".($this->ArrPush[0])."</div>
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
		$sqlS = "SELECT * FROM tc_lv0011 WHERE lv100<>1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),0));
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";				
				break;
			case 'lv010':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004";
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
				break;	

		}
		return $vsql;
	}
	public function getvaluelink($vFile,$vSelectID)
	{
		$vsql ='';
		if (!empty($this->ArrGetValueLink[$vFile][$vSelectID][0] ?? null)) {return $this->ArrGetValueLink[$vFile][$vSelectID][1] ?? null;}
		if($vSelectID=="")
		{
			return $vSelectID;
		}
		switch($vFile)
		{
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002 where lv001='$vSelectID'";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv010':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004 where lv001='$vSelectID'";
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
		$lvopt = 0;
		while($row= db_fetch_array($lvResult)){
			$this->ArrGetValueLink[$vFile][$vSelectID][1]=($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
			return $this->ArrGetValueLink[$vFile][$vSelectID][1];
		}
		
	}
}
?>