<?php
/////////////coding tc_lv0009///////////////
class   tc_lv0009 extends lv_controler
{
	public $isConnectSQLSERVER = false;
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
	public $lv006=null;
	public $lv007=null;
	public $lv008=null;
	public $lv009=null;
	public $lv001_re=null;
	public $lv002_re=null;
	public $lv003_re=null;
	public $lv004_re=null;
	public $lv005_re=null;
	public $lv006_re=null;
	public $lv007_re=null;
	public $lv008_re=null;
	public $lv009_re=null;
	public $lvopt=null;
	public $lvCalID=null;
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv095,lv096,lv120,lv121,lv122,lv123";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='tc_lv0009';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv095"=>"96","lv096"=>"97","lv120"=>"121","lv121"=>"122","lv122"=>"123","lv123"=>"124");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv095"=>"10","lv096"=>"10","lv120"=>"10","lv121"=>"10","lv122"=>"10","lv123"=>"10");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=1;
		$this->lang=$_GET['lang'];
		
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv011 from tc_lv0013 B where  B.lv001='$this->lvCalID'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv011']>=2)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_CheckLocked($vlv002)
	{
		$lvsql="select lv011 from  tc_lv0013 Where lv001='$vlv002'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['lv011']<=2) 
					return true;
				else 
					return false;
			}
			else
			return false;
		}else
		return false;
	}
	function LV_Load()
	{
		$vsql="select * from  tc_lv0009";
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
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv120=$vrow['lv120'];
			$this->lv121=$vrow['lv121'];
			$this->lv122=$vrow['lv122'];
			$this->lv123=$vrow['lv123'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  tc_lv0009 Where lv001='$vlv001'";
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
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv120=$vrow['lv120'];
			$this->lv121=$vrow['lv121'];
			$this->lv122=$vrow['lv122'];
			$this->lv123=$vrow['lv123'];
		}
	}
	function LV_LoadMonthID($vlv002,$vlv003,$vlv004)
	{
		$lvsql="select * from  tc_lv0009 Where lv002='$vlv002' and lv003='$vlv003' and lv004='$vlv004'";
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
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv120=$vrow['lv120'];
			$this->lv121=$vrow['lv121'];
			$this->lv122=$vrow['lv122'];
			$this->lv123=$vrow['lv123'];
		}
	}
	function LV_ReLoadMonthID($vlv002,$vlv003,$vlv004)
	{
		$lvsql="select * from  tc_lv0009 Where lv002='$vlv002' and lv003='$vlv003' and lv004='$vlv004'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001_re=$vrow['lv001'];
			$this->lv002_re=$vrow['lv002'];
			$this->lv003_re=$vrow['lv003'];
			$this->lv004_re=$vrow['lv004'];
			$this->lv005_re=$vrow['lv005'];
			$this->lv006_re=$vrow['lv006'];	
			$this->lv007_re=$vrow['lv007'];
			$this->lv008_re=$vrow['lv008'];
			$this->lv009_re=$vrow['lv009'];
			$this->lv095_re=$vrow['lv095'];
			$this->lv096_re=$vrow['lv096'];
			$this->lv120_re=$vrow['lv120'];
			$this->lv121_re=$vrow['lv121'];
			$this->lv122_re=$vrow['lv122'];
			$this->lv123_re=$vrow['lv123'];
		}
	}
	function LV_FNLoadMonthID($vlv002,$vlv003,$vlv004)
	{
		$lvsql="select SUM(IF(lv007='A',1,0.5)) FN  from  tc_lv0011 Where lv002 in (select A.lv001 from tc_lv0010 A where A.lv002='$vlv002') and MONTH(lv004)='$vlv003' and YEAR(lv004)='$vlv004' and lv007 in ('A','HA')";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['FN'];
			
		}
		return 0;
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$lvsql="insert into tc_lv0009 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009')";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$lvsql="Update tc_lv0009 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009' where  lv001='$this->lv001' AND lv005<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) {
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateALCL()
	{
		if($this->isEdit==0) return false;
		$lvsql="Update tc_lv0009 set lv096='$this->lv096',lv120='$this->lv120',lv121='$this->lv121',lv122='$this->lv122',lv123='$this->lv123' where  lv001='$this->lv001'";// AND lv005<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) {
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateOther()
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lvCalID)) return false;
	    $lvsql="Update tc_lv0009 set lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009' where  lv001='$this->lv001' AND lv005<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateKhoaPhep($vlv003,$vlv004)
	{
		if($this->isApr==0) return false;
		$vsql="update tc_lv0009 set lv050=1 where lv003='".((int)$vlv003)."' and lv004='".$vlv004."'";
		$vresult1=db_query($vsql);
		return $vReturn;
	}
	function LV_UpdateMoKhoaPhep($vlv003,$vlv004)
	{
		if($this->isApr==0) return false;
		$vsql="update tc_lv0009 set lv050=0 where lv003='".((int)$vlv003)."' and lv004='".$vlv004."'";
		$vresult1=db_query($vsql);
		return $vReturn;
	}
	function LV_UpdateKhoaCong($vlv003,$vlv004)
	{
		if($this->isApr==0) return false;
		$vsql="update tc_lv0009 set lv005=1 where lv003='".((int)$vlv003)."' and lv004='".$vlv004."'";
		$vresult1=db_query($vsql);
		return $vReturn;
	}
	function LV_UpdateMoKhoaCong($vlv003,$vlv004)
	{
		if($this->isApr==0) return false;
		$vsql="update tc_lv0009 set lv005=0 where lv003='".((int)$vlv003)."' and lv004='".$vlv004."'";
		$vresult1=db_query($vsql);
		return $vReturn;
	}
	function LV_GetCurHSo($vlv003,$vlv004)
	{
		$strReturn="";
		$lvsql="select lv002 from  tc_lv0009 Where lv003='$vlv003' and lv004='$vlv004'";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($strReturn=='') 
				$strReturn="'".$vrow['lv002']."'";
			else
				$strReturn=$strReturn.",'".$vrow['lv002']."'";
		}
		return $strReturn;
	}
	function LV_UpdateMonthShiftCal($vid,$vlv100,$vlv004)
	{
		
		if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv100) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv100')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv100='$vlv100'  WHERE lv001='$vid'  AND lv005<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateMonthNumDayPNDauKy($vNVID,$vlv029,$vlv004)
	{
		//if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv100) values('$vNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv029')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv121='$vlv029'  WHERE lv002='$vNVID' and lv003=month('$vlv004') and lv004=year('$vlv004')  AND lv005<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdatePreHSo($vlv003,$vlv004)
	{
		//if($this->isAdd==0) return false;	
		if($vlv003==1)
		{
			$premonth=12;
			$preyear=($vlv004)-1;
		}
		else
		{
			$premonth=($vlv003-1);
			$preyear=$vlv004;
		}
		$lsNVID=$this->LV_GetCurHSo($vlv003,$vlv004);
		if($lsNVID!="")
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007,lv008) select A.lv001,'$vlv003','$vlv004',0,'".getInfor($this->UserID,2)."',0,0 from hr_lv0020 A where (A.lv009 not in (2,3)) and (A.lv001 not in($lsNVID))";
		else
		{
			$vsql="select count(*) Counts from tc_lv0009 A where A.lv003='".$premonth."' and A.lv004='".$preyear."'";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow['Counts']>0)
				{
					 $lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007,lv008) select A.lv002,'$vlv003','$vlv004',0,'".getInfor($this->UserID,2)."',A.lv007,A.lv008 from tc_lv0009 A where A.lv003='".$premonth."' and A.lv004='".$preyear."'";
				}
			else
			{
				$this->LV_UpdatePreHSo1($vlv003,$vlv004);
				
			}
		}
		$vReturn= db_query($lvsql);
		if($vReturn){			
			$this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
		}
		if($lsNVID=="")		$lsNVID=$this->LV_GetCurHSo($vlv003,$vlv004);
		$lvsql="select lv001 from hr_lv0020 where lv001 in ($lsNVID) and (lv009 not in ('2','3'))";
				$vresult=db_query($lvsql);
				while($vrow=db_fetch_array($vresult))
				{
					$vFNUsed=$this->LV_GetNumberTimeCardPH($vrow['lv001'],$vlv004,$vlv003,"PH")*2;
					$vFNUsed=$vFNUsed/8;
					$vsql="update tc_lv0009 set lv095='".$vFNUsed."' where lv002='".$vrow['lv001']."' and lv003='$vlv003' and lv004='".$vlv004."'";
					$vresult1=db_query($vsql);
				}
		
		return $vReturn;
	}
	function LV_GetNumberTimeCard($vEmpID,$vyear,$vmonth,$vMaCong)
	{
		$vListEmp="'".$vEmpID."'";
		$vsql="select (sum(left(A.lv005,2))+sum(substr(A.lv005,4,5))/60+sum(substr(A.lv005,7,8))/360) AL_Add from tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 where A.lv100=0 AND YEAR(A.lv004)='$vyear' and Month(A.lv004)='$vmonth' and B.lv002 ='$vEmpID' and A.lv007='$vMaCong' and A.lv015<>'';";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['AL_Add'];
		}
		return 0;
	}
	function LV_GetNumberTimeCardPH($vEmpID,$vyear,$vmonth,$vMaCong)
	{
		$vListEmp="'".$vEmpID."'";
		$vsql="select (sum(left(A.lv005,2))+sum(substr(A.lv005,4,5))/60+sum(substr(A.lv005,7,8))/360) AL_Add from tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 inner join tc_lv0003 C on A.lv004=C.lv002 where A.lv100=0 AND YEAR(A.lv004)='$vyear' and Month(A.lv004)='$vmonth' and B.lv002 ='$vEmpID' and A.lv007<>'$vMaCong' and A.lv015<>'';";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['AL_Add'];
		}
		return 0;
	}
	function LV_GetTimeAddClear($vEmpID,$vyear)
	{
		$vReturnArr=Array();
		$vListEmp="'".$vEmpID."'";
		$vsql="select (sum(left(A.lv016,2))+sum(substr(A.lv016,4,5))/60+sum(substr(A.lv016,7,8))/360) cleartimes,(sum(left(A.lv017,2))+sum(substr(A.lv017,4,5))/60+sum(substr(A.lv017,7,8))/360) addtimes from tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 where YEAR(A.lv004)='$vyear' and B.lv002 ='$vEmpID' ;";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vReturnArr['cleartimes']=$vrow['cleartimes'];
			$vReturnArr['addtimes']=$vrow['addtimes'];
			return $vReturnArr;
		}
		$vReturnArr['cleartimes']=0;
		$vReturnArr['addtimes']=0;
		return $vReturnArr;
	}
	function LV_UpdateMonthPetrol($vid,$vlv009,$vlv004)
	{
		//if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv009) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv009')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv009='$vlv009'  WHERE lv001='$vid'  AND lv155<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateMonthNumDayAllowance($vid,$vlv028,$vlv004)
	{
		//if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv028) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv028')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv028='$vlv028'  WHERE lv001='$vid'  AND lv005<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateMonthNumDayLaundry($vid,$vlv029,$vlv004)
	{
		//if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv029) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv029')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv029='$vlv029'  WHERE lv001='$vid'  AND lv005<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateMonthNumDayInsurance($vid,$vlv030,$vlv004)
	{
		//if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv030) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv030')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv030='$vlv030'  WHERE lv001='$vid';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateMonthMeal($vid,$vlv094,$vlv004,$vopt=1)
	{
		//if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			
			switch($vopt)
			{
				case 1:
					$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv094) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv094')";
					break;
				case 2:
					$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv012) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv094')";
					break;
				case 3:
					$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv013) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv094')";
					break;
				case 4:
					$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv014) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv094')";
					break;
				case 5:
					$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv015) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv094')";
					break;
			}
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		switch($vopt)
			{
				case 1:
					$lvsql = "Update tc_lv0009 set lv094='$vlv094'  WHERE lv001='$vid'  AND lv155<=0;";
					break;
				case 2:
					$lvsql = "Update tc_lv0009 set lv012='$vlv094'  WHERE lv001='$vid'  AND lv155<=0;";
					break;
				case 3:
					$lvsql = "Update tc_lv0009 set lv013='$vlv094'  WHERE lv001='$vid'  AND lv155<=0;";
					break;
				case 4:
					$lvsql = "Update tc_lv0009 set lv014='$vlv094'  WHERE lv001='$vid'  AND lv155<=0;";
					break;
				case 5:
					$lvsql = "Update tc_lv0009 set lv015='$vlv094'  WHERE lv001='$vid'  AND lv155<=0;";
					break;
			}
		
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateMonthMealEmp($vid,$vlv027,$vlv004,$vopt=1)
	{
		//if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			switch($vopt)
			{
				case 1:
					$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv027) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv027')";
					break;
				case 2:
					echo $lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv022) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv027')";
					break;
				case 3:
					$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv023) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv027')";
					break;
				case 4:
					$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv024) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv027')";
					break;
				case 5:
					$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv025) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv027')";
					break;
			}
			
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		switch($vopt)
			{
				case 1:
					$lvsql = "Update tc_lv0009 set lv027='$vlv027'  WHERE lv001='$vid'  AND lv155<=0;";
					break;
				case 2:
					$lvsql = "Update tc_lv0009 set lv022='$vlv027'  WHERE lv001='$vid'  AND lv155<=0;";
					break;
				case 3:
					$lvsql = "Update tc_lv0009 set lv023='$vlv027'  WHERE lv001='$vid'  AND lv155<=0;";
					break;
				case 4:
					$lvsql = "Update tc_lv0009 set lv024='$vlv027'  WHERE lv001='$vid'  AND lv155<=0;";
					break;
				case 5:
					$lvsql = "Update tc_lv0009 set lv025='$vlv027'  WHERE lv001='$vid'  AND lv155<=0;";
					break;
			}
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdatePreHSo1($vlv003,$vlv004)
	{
		if($this->isAdd==0) return false;	
		if($vlv003==1)
		{
			$premonth=12;
			$preyear=($vlv004)-1;
		}
		else
		{
			$premonth=($vlv003-1);
			$preyear=$vlv004;
		}
		$lsNVID=$this->LV_GetCurHSo($vlv003,$vlv004);
		if($lsNVID!="")
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007,lv008) select A.lv001,'$vlv003','$vlv004',0,'".getInfor($this->UserID,2)."',IF(ISNULL((select BZ.lv003 from hr_lv0033 AZ inner join hr_lv0008 BZ on AZ.lv003=BZ.lv001	 where AZ.lv002=A.lv001  limit 0,1)),(select AX.lv007 from tc_lv0009 AX where AX.lv002=A.lv001 and AX.lv003='".$premonth."' and AX.lv004='".$preyear."' limit 0,1),(select BZ.lv003 from hr_lv0033 AZ inner join hr_lv0008 BZ on AZ.lv003=BZ.lv001	 where AZ.lv002=A.lv001 order by AZ.lv003 DESC limit 0,1)) lv007,'' from hr_lv0020 A where A.lv009 in  in (2,3) and (A.lv001 not in($lsNVID))";
		else
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007,lv008) select A.lv001,'$vlv003','$vlv004',0,'".getInfor($this->UserID,2)."',IF(ISNULL((select BZ.lv003 from hr_lv0033 AZ inner join hr_lv0008 BZ on AZ.lv003=BZ.lv001	 where AZ.lv002=A.lv001  limit 0,1)),(select AX.lv007 from tc_lv0009 AX where AX.lv002=A.lv001 and AX.lv003='".$premonth."' and AX.lv004='".$preyear."' limit 0,1),(select BZ.lv003 from hr_lv0033 AZ inner join hr_lv0008 BZ on AZ.lv003=BZ.lv001	 where AZ.lv002=A.lv001 order by AZ.lv003 DESC limit 0,1)) lv007,'' from hr_lv0020 A where A.lv009 not in (2,3)";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$this->LV_UpdateHSOAuto($vlv003,$vlv004,$lsNVID);
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_UpdateHSOAuto($vlv003,$vlv004,$lsNVID)
	{
		$lvsql=" select A.lv001 lv002,IF(ISNULL((select BZ.lv003 from hr_lv0033 AZ inner join hr_lv0008 BZ on AZ.lv003=BZ.lv001	 where AZ.lv002=A.lv001 )),(select AX.lv007 from tc_lv0009 AX where AX.lv002=A.lv001 and AX.lv003='".$premonth."' and AX.lv004='".$preyear."' limit 0,1),(select BZ.lv003 from hr_lv0033 AZ inner join hr_lv0008 BZ on AZ.lv003=BZ.lv001	 where AZ.lv002=A.lv001 order by AZ.lv003 DESC limit 0,1)) lv007 from hr_lv0020 A where A.lv009 in (0,1) and (A.lv001 in($lsNVID))";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$sql = "Update tc_lv0009 set lv007='".$vrow['lv007']."'  WHERE lv002='".$vrow['lv002']."' AND lv003='$vlv003' AND lv004='$vlv004' AND lv005<=0;";
			$vReturn= db_query($sql);
		}
	}
	function LV_UpdateMonthHSO($vid,$vlv007,$vlv004)
	{
		if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv007')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv007='$vlv007'  WHERE lv001='$vid' AND lv005<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateMonthEat($vid,$vlv009,$vlv004)
	{
		if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv009) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv009')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv009='$vlv009'  WHERE lv001='$vid'  AND lv005<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateMonthRate($vid,$vlv008,$vlv004)
	{
		//if($this->isEdit==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv008) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."','$vlv008')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv008='$vlv008'  WHERE lv001='$vid'  AND lv005<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM tc_lv0009  WHERE tc_lv0009.lv005<=0 AND tc_lv0009.lv001 IN ($lvarr)";// and (select count(*) from ts_lv0009 B where  B.lv002= tc_lv0009.lv001)<=0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_AprovalAll($vlv003,$vlv004)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0009 set lv005=1  WHERE tc_lv0009.lv003='$vlv003' and tc_lv0009.lv004='$vlv004'  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAprovalAll($vlv003,$vlv004)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0009 set lv005=0  WHERE tc_lv0009.lv003='$vlv003' and tc_lv0009.lv004='$vlv004'  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0009 set lv005=1  WHERE tc_lv0009.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.approval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_AprovalMeal($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0009 set lv155=1  WHERE tc_lv0009.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_CheckExistMonth($vlv004)
	{
		$lvsql = "select count(*) nums from tc_lv0009  WHERE lv003=month('$vlv004') and lv004=year('$vlv004') and lv002='$this->lvNVID'  ";
		$bResultC = db_query($lvsql);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_AprovalAprUnp($vyear,$vmonth,$vlv004,$vopt)
	{
		if($this->isApr==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),'$vopt','".$this->LV_UserID."')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv005='$vopt'  WHERE lv002='$this->lvNVID' and lv004='$vyear' and lv003='$vmonth'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0007.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_AprovalOne($vlv001,$vlv004)
	{
		if($this->isApr==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),1,'".$this->LV_UserID."')";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv005=1  WHERE lv001='$vlv001'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0007.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_AprovalOneMeal($vlv001,$vlv004)
	{
		if($this->isApr==0) return false;
		if($this->LV_CheckExistMonth($vlv004)<=0)
		{
			$lvsql="insert into tc_lv0009 (lv002,lv003,lv004,lv005,lv006,lv155) values('$this->lvNVID',month('$vlv004'),year('$vlv004'),0,'".getInfor($this->UserID,2)."',1)";
			$vReturn= db_query($lvsql);
			if($vReturn){
			 $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.insert',sof_escape_string($lvsql));
			 return $vReturn;
			}
		}
		$lvsql = "Update tc_lv0009 set lv155=1  WHERE lv001='$vlv001'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0007.approval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_CongDu($vEmpID,$vMonth,$vYear,$vSoCong)
	{
		$lvsql = "Update tc_lv0009 set lv096='$vSoCong'  WHERE lv002='$vEmpID' and lv003='$vMonth' and lv004='$vYear'  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0009 set lv005=0  WHERE tc_lv0009.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UnAprovalMeal($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0009 set lv155=0  WHERE tc_lv0009.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0009.unapproval',sof_escape_string($lvsql));
		return $vReturn;
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
		if($this->lv007!="") $strCondi=$strCondi." and lv007  like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and lv008  like '%$this->lv008%'";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0009 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
			//////////////////////Buil list////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		if($curRow<0) $curRow=0;	if($lvList=="") $lvList=$this->DefaultFieldList;
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
		$lvTrH="<tr class=\"lvhtable\">	<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td><td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>@#01</tr>";		$lvTr="<tr class=\"lvlinehtable@01\"><td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>	<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>@#01</tr>";
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=@#04>@02</td>";
		$sqlS = "SELECT * FROM tc_lv0009 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
//////////////////////Buil list////////////////////
	function LV_BuilListInput($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		$this->LV_CheckLock();
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
		$lvAdd=$this->isAdd;
		$this->isAdd=0;	
		$this->isEdit=0;	
		$this->isDel=0;	
		$lvTable="
		<table  align=\"center\" class=\"lvtable\">
		<!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>"."</td></tr>
		";
		$lvTable=$lvTable."<tr ><td colspan=\"".(count($lstArr))."\">";
		if($lvAdd>0)		$lvTable=$lvTable."<a class=\"lvtoolbar\" href=\"javascript:Save();\" tabindex=\"47\"><img src=\"../images/controlright/save_f2.png\"  alt=\"Save\" title=\"<?php echo $vLangArr[1];?>\" name=\"save\" border=\"0\" align=\"middle\" id=\"save\" /> <?php echo $vLangArr[2];?></a>";
		$lvTable=$lvTable."</td><td colspan=\"2\" align=right>".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</td></tr>
		@#01
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr ><td colspan=\"".(count($lstArr))."\">";
		if($lvAdd>0) $lvTable=$lvTable."<a class=\"lvtoolbar\" href=\"javascript:Save();\" tabindex=\"47\"><img src=\"../images/controlright/save_f2.png\"  alt=\"Save\" title=\"<?php echo $vLangArr[1];?>\" name=\"save\" border=\"0\" align=\"middle\" id=\"save\" /> <?php echo $vLangArr[2];?></a>";
		$lvTable=$lvTable. "</td><td colspan=\"2\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">	<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td><td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>@#01</tr>";		$lvTr="<tr class=\"lvlinehtable@01\"><td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>	<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>@#01</tr>";
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td >@02";
		$lvTdInput="<td ><input id=\"@03\" name=\"@03\" value=\"@02\" tabindex=2  onKeyUp=\"return CheckKeyCheckOther(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@13,'@14')\"></td>";
		$lvTdInputHidden="<td >@02<input type=hidden id=\"@03\" name=\"@03\" value=\"@02\" ></td>";
		$sqlS = "SELECT * FROM tc_lv0009 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				switch($lstArr[$i])
				{
					case 'lv007':
						if($lvAdd>0)
						{
							$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),str_replace("@14","txt".$lstArr[$i],str_replace("@03","txt".$lstArr[$i].$vorder,str_replace("@13",$vorder,$lvTdInput))));
							break;
						}
					case 'lv001':
					case 'lv002':
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),str_replace("@03","txt".$lstArr[$i].$vorder,$lvTdInputHidden));
					break;
					default:
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				}
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
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
			window.open('".$this->Dir."tc_lv0009/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
			
			$strTempChk=str_replace("@01",$i,$lvChk.$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]]);
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
		$sqlS = "SELECT * FROM tc_lv0009 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
		$sqlS = "SELECT * FROM tc_lv0009 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			case 'lv002':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv0006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv008':
				$vsql="select lv001, concat(lv003,'(',lv004,'%)') lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0025 where lv002 in (select A.lv001 from tc_lv0013 A where A.lv011=1) ";				
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectID)
	{
		$lvopt=$this->lvopt;
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv008':
				$vsql="select lv001,concat(lv003,'(',lv004,'%)') lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0025 where lv001='$vSelectID' ";
				$lvopt=0;
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