<?php
/////////////coding tc_lv0013///////////////
class   tc_lv0013 extends lv_controler
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
	public $lv010=null;
	public $lv011=null;
	public $lv012=null;
	public $lv013=null;
	public $lv014=null;
	public $lv015=null;
	public $lv016=null;
	public $lv017=null;
	public $lv018=null;
	public $lv019=null;
	public $lv020=null;
	public $lv021=null;
	public $lv022=null;
	public $isCal=null;
///////////
	public $DefaultFieldList="lv199,lv111,lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv098";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='tc_lv0013';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv098"=>"99","lv099"=>"100","lv100"=>"101","lv199"=>"200","lv111"=>"112");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"10","lv004"=>"2","lv005"=>"2","lv006"=>"10","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"10","lv013"=>"10","lv014"=>"10","lv015"=>"10","lv016"=>"1","lv017"=>"1","lv018"=>"1","lv019"=>"1","lv020"=>"1","lv021"=>"1","lv022"=>"1","lv023"=>"1","lv024"=>"1","lv025"=>"0","lv026"=>"10","lv098"=>"0","lv099"=>"0","lv100"=>"0");	

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
	
	function LV_Load()
	{
		$vsql="select * from  tc_lv0013";
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
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
		}
	}
	function LV_LoadID($vlv001)
	{
		
		$lvsql="select * from  tc_lv0013 Where lv001='$vlv001'";
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
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
		}
		else
			$this->lv001=NULL;
	}
	function LV_LoadNextMonth($vMonth,$vYear)
	{
		if($vMonth==12)
		{
		$vMonth1=1;
		$vYear1=$vYear+1;
		}
		else
		{
			$vMonth1=$vMonth+1;
			$vYear1=$vYear;
		}
		
		$lvsql="select lv001 from  tc_lv0013 Where lv006='$vMonth1' and lv007='$vYear1'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['lv001'];
		}
		return '';
	}
	function LV_LoadPreMonth($vMonth,$vYear)
	{
		if($vMonth==1)
		{
		$vMonth1=12;
		$vYear1=$vYear-1;
		}
		else
		{
			$vMonth1=$vMonth-1;
			$vYear1=$vYear;
		}
		
		$lvsql="select lv001 from  tc_lv0013 Where lv006='$vMonth1' and lv007='$vYear1'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['lv001'];
		}
		return '';
	}
	function LV_LoadActiveID()
	{
		$lvsql="select * from  tc_lv0013 Where lv011=1";
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
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
		}
		else
			$this->lv001=NULL;
	}
	function LV_LoadActiveIDMonth($vmonth,$vyear)
	{
		$vmonth=(int)$vmonth;
		$lvsql="select * from  tc_lv0013 Where lv006='$vmonth' and lv007='$vyear'";
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
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
			return $this->lv001;
		}
		else
			$this->lv001=NULL;
	}
	function LV_LoadCalendarWork($vTT,$vStartDate,$vEndDate)
	{
		return $this->lv007."-".Fillnum($this->lv006,2)."-".Fillnum($vTT,2);
		$vTT=(int)$vTT;
		if($this->TIMESDATE[0]==true)
		{
			return $this->TIMESDATE[$vTT];
		}
		else
		{
			$this->TIMESDATE[0]=true;
			$i=0;
			while(true)
			{
				$vDateCur=ADDDATE($vStartDate,$i);
				$i++;
				$vDay=(int)getday($vDateCur);
				$this->TIMESDATE[$vDay]=$vDateCur;
				if($vDateCur==$vEndDate) break;
			}
			
		}
		return $this->TIMESDATE[$vTT];
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$lvsql="insert into tc_lv0013 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv098,lv099,lv100) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023','$this->lv024','$this->lv025','$this->lv026','$this->lv098','$this->lv099','$this->lv100')";
		$vReturn= db_query($lvsql);
		if($vReturn) {
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0013.insert',sof_escape_string($lvsql));
		//$this->LV_CheckSaleOrder();
		$this->LV_InsertOther($this->lv001,$this->lv051);
		}
		return $vReturn;
	}	
	function LV_CheckSaleOrder()
	{
		if($this->lv001=="" || $this->lv001==NULL) return false;
		$lvsql="select count(*) num from sl_lv0013 where lv001='$this->lv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow['num']>0)
		{
			$lvsql="update sl_lv0013 set lv003='$this->lv002',lv004='$this->lv004',lv005='$this->lv005' where lv001='$this->lv001' where lv011<>1";
		}
		else
		{
			$lvsql="insert into sl_lv0013(lv001,lv002,lv003,lv004,lv005)  values('$this->lv001','SOF','$this->lv002','$this->lv004','$this->lv005')";
		}
		return $vresult=db_query($lvsql);
	}
	function LV_InsertOther($lv002,$vlv0022)
	{
		$lvsql="insert into tc_lv0014 (lv002,lv003,lv004) select '$lv002',lv003,lv004 from tc_lv0014 where lv002='$vlv0022'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0014.insert',sof_escape_string($lvsql));
		$lvsql="insert into tc_lv0015 (lv002,lv003,lv004,lv005) select '$lv002',lv003,lv004,lv005 from tc_lv0015 where lv002='$vlv0022'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0015.insert',sof_escape_string($lvsql));
		$lvsql="insert into tc_lv0025 (lv002,lv003,lv004,lv005) select '$lv002',lv003,lv004,lv005 from tc_lv0025 where lv002='$vlv0022'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0025.insert',sof_escape_string($lvsql));
		$lvsql="insert into tc_lv0031 (lv002,lv003,lv004,lv005,lv006,lv007) select '$lv002',lv003,lv004,lv005,lv006,lv007 from tc_lv0031 where lv002='$vlv0022'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0031.insert',sof_escape_string($lvsql));
		$lvsql="insert into tc_lv0047 (lv001,lv002,lv003,lv004,lv005,lv006,lv007) select lv001,'$lv002',lv003,lv004,lv005,lv006,lv007 from tc_lv0047 where lv002='$vlv0022'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0047.insert',sof_escape_string($lvsql));
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$lvsql="Update tc_lv0013 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018',lv019='$this->lv019',lv020='$this->lv020',lv021='$this->lv021',lv022='$this->lv022',lv023='$this->lv023',lv024='$this->lv024',lv025='$this->lv025',lv026='$this->lv026',lv098='$this->lv098',lv099='$this->lv099',lv100='$this->lv100' where  lv001='$this->lv001' AND lv011<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{	
			//$this->LV_CheckSaleOrder();
			if($this->isCal) $this->LV_CalCongThem($this->lv001,$this->lv021,$this->lv016,$this->lv015);
			$this->InsertLogOperation($this->DateCurrent,'tc_lv0013.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	public function LV_SetCal($vCalID)
	{
		$lvsql="Update lv_lv0007 set lv100='$vCalID' where  lv001='".$_SESSION['ERPSOFV2RUserID']."';";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{	
			$this->InsertLogOperation($this->DateCurrent,'lv_lv0007.update',sof_escape_string($lvsql));
			$this->LV_UpdateCalculateSave($vCalID);
		}
		return $vReturn;
	}
	function LV_UpdateFinishAuto($vcalID)
	{
		$lvsql="Update tc_lv0013 set lv101='1' where  lv001='$vcalID'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{	
			$this->InsertLogOperation($this->DateCurrent,'tc_lv0013.update',sof_escape_string($lvsql));
		}
		return $vReturn;	
	}
	function LV_UpdateCalculateSave($vCalID)
	{
		$vlistEmp=$this->GetMultiValue("select BB.lv003 lv001  from tc_lv0064 BB where BB.lv002='$vCalID'");
		
		$this->LV_LoadID($vCalID);
		//$vDateFrom=$this->objtc_lv0013->lv007."-".$this->objtc_lv0013->lv006."-".GetDayInMonth($this->objtc_lv0013->lv007,$this->objtc_lv0013->lv006);
		$lvsql="insert into tc_lv0064(lv002,lv003,lv004,lv005) select '$vCalID',A.lv001,A.lv029,A.lv009 from hr_lv0020 A where A.lv009 not in (2,3) and A.lv030<='".$this->lv005."' and A.lv001 not in ($vlistEmp)";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.insert',sof_escape_string($lvsql));
		$lvsql="insert into tc_lv0064(lv002,lv003,lv004,lv005) select '$vCalID',A.lv001,A.lv029,A.lv009 from hr_lv0020 A where A.lv009 in (2,3) and year(A.lv044)='".$this->lv007."' and month(A.lv044)='".$this->lv006."'  and A.lv001 not in ($vlistEmp)";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.insert',sof_escape_string($lvsql));
		return $vReturn;
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
	public function LV_GetCal()
	{
		$this->lv999='';
		$lvsql="select lv100 from  lv_lv0007 Where lv001='".$_SESSION['ERPSOFV2RUserID']."';";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv999=$vrow['lv100'];
			return $vrow['lv100'];
		}
	}
	function LV_UpdateStateStaff($vCalID)
	{
		
		$lvsql="Update tc_lv0013 set lv097=lv097+1 where  lv001='$vCalID' ;";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{	
			$this->InsertLogOperation($this->DateCurrent,'tc_lv0013.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM tc_lv0013  WHERE tc_lv0013.lv011<=0 AND tc_lv0013.lv001 IN ($lvarr) and (select count(*) from tc_lv0014 where tc_lv0013.lv001=tc_lv0014.lv002)<=0 and (select count(*) from tc_lv0015 where tc_lv0013.lv001=tc_lv0015.lv002)<=0  and (select count(*) from tc_lv0025 where tc_lv0013.lv001=tc_lv0025.lv002)<=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0013.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0013 set lv011=lv011+1  WHERE tc_lv0013.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0013.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_AprovalLuong($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0013 set lv111=1  WHERE tc_lv0013.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0013.approval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_AprovalHoanThanh($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0013 set lv111=2  WHERE tc_lv0013.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0013.approval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_TraLaiCong($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0013 set lv111=0  WHERE tc_lv0013.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0013.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0013 set lv011=lv011-1  WHERE tc_lv0013.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0013.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_GetListEmp($vDepartment,$vField)
	{
		$vsql="select $vField from hr_lv0020 where lv029 in ($vDepartment)";
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
	function LV_GetTongHeCong($vCalID,$vListEmp)
	{
		$vsql="select sum(lv024) sumcong from tc_lv0021 where lv053='".$vCalID."'  and lv002 in ($vListEmp) ";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)		return $vrow['sumcong'];
		return 0;
		
	}
	function LV_CalCongThem($vCalID,$vTotalAdd,$vPhicongdoan,$vMucTNCN)
	{
		
		$vsql="select lv003 from tc_lv0031 where lv002='".$vCalID."' and lv007=1";
		$vresult=db_query($vsql);
		$strReturn="";
		while($vrow=db_fetch_array($vresult))
		{
			if($strReturn=="") $strReturn="'".$vrow['lv003']."'";
				else $strReturn=$strReturn.",'".$vrow['lv003']."'";
		}
		$vListEmp=$this->LV_GetListEmp($strReturn,'lv001');
		if($vListEmp=="") return 0;
		$tongcong=$this->LV_GetTongHeCong($vCalID,$vListEmp);
		$vsql="update tc_lv0021 set lv025=$vTotalAdd*lv024/$tongcong where lv002 in($vListEmp)";
		$vresult=db_query($vsql);
		$vsql="update tc_lv0021 set lv029=lv022+lv023+lv025+lv026+lv027+lv028+lv030 where lv002 in($vListEmp)";
		$vresult=db_query($vsql);
		$vsql="update tc_lv0021 set lv033=(lv029-lv032-lv044-lv031)*$vPhicongdoan/100 where lv002 in($vListEmp) and lv033>0";
		$vresult=db_query($vsql);
		$vsql="update tc_lv0021 set lv039=lv029-$vMucTNCN-lv033-lv034-lv041-lv032 where lv002 in($vListEmp)";
		$vresult=db_query($vsql);
		$this->LV_UpdateTax($vCalID,$vListEmp);
		$vresult=db_query($vsql);
		$vsql="update tc_lv0021 set lv046=lv029-lv033-lv032-lv031-lv044-lv038 where lv002 in($vListEmp)";
		$vresult=db_query($vsql);
		$vsql="update tc_lv0021 set lv045=lv029+lv020-lv037-lv034-lv033-lv032-lv031-lv044-lv038 where lv002 in($vListEmp)";
		return $vresult;
	}
	function LV_UpdateTax($vCalID,$vListEmp)
	{
		$vsql="select A.lv001,A.lv039 from  tc_lv0021 A where A.lv002<$vSalaray Order by lv004 ";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vlv038=$this->LV_GetTax($vrow['lv039']);
			$vupdatesql="update tc_lv0021 set lv038=$vlv038 where lv001='".$vrow['lv001']."'";
			$vresult=db_query($vupdatesql);
		}
	}
	function LV_GetTax($vSalaray)//Get percent of tax
	{
		if($vSalaray==0) return 0;
		$vReturn=0;
		$i=0;
		$vFrom[0]=0;
		$vTo[0]=0;		
		$vPerCal[0]=0;
		$vsql="select * from  tc_lv0005 A where A.lv002<$vSalaray Order by lv004 ";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vFrom[$i]=$vrow['lv002'];
			$vTo[$i]=$vrow['lv003'];
			$vPerCal[$i]=$vrow['lv004'];
			$i=$i+1;			
			
		}				
		for($j=0;$j<$i;$j++)
		{
			if($j==$i-1)
			{
				$vReturn=$vReturn+($vSalaray-$vFrom[$j])*$vPerCal[$j]/100;		
			}
			else
			{
				$vReturn=$vReturn+($vTo[$j]-$vFrom[$j])*$vPerCal[$j]/100;		
			}
		}
		return $vReturn;
	}	
	function LV_CopyPreInsert($vPrevID)
	{
		$this->LV_LoadID($vPrevID);
		$this->lv001=InsertWithCheckExt('tc_lv0013', 'lv001', 'TIMES',4);
		$vPreMonth=$this->lv006;
		$vPreYear=$this->lv007;
		if($vPreMonth==12)
		{
			$vMonth=1;
			$vYear=$vPreYear+1;
		}
		else
		{
			$vMonth=$vPreMonth+1;
			$vYear=$vPreYear;
		}
		$this->lv006=$vMonth;
		$this->lv007=$vYear;
		$this->lv002='TÍNH LƯƠNG THÁNG '.$vMonth.'.'.$vYear;
		$this->lv004="01-".Fillnum($vMonth,2)."-".$vYear;
		$this->lv005=GetDayInMonth($this->lv007,$this->lv006)."-".Fillnum($vMonth,2)."-".$vYear;
		$this->lv009=0;
		$this->lv051=$vPrevID;
		$this->LV_Insert();
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
		if($this->lv002!="") $strCondi=$strCondi." and lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="") $strCondi=$strCondi." and lv007  like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and lv008  like '%$this->lv008%'";
		if($this->lv009!="") $strCondi=$strCondi." and lv009  like '%$this->lv009%'";
		if($this->lv010!="") $strCondi=$strCondi." and lv010  like '%$this->lv010%'";
		if($this->lv011!="") $strCondi=$strCondi." and lv011  like '%$this->lv011%'";
		if($this->lv015!="") $strCondi=$strCondi." and lv015  like '%$this->lv015%'";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0013 WHERE 1=1 ".$this->GetCondition();
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
		$lvHref="<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\" class=@#04>@02</a></span>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM tc_lv0013 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				//$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$key1 = $lstArr[$i];
				$key2 = isset($this->ArrGet[$key1]) ? (int)$this->ArrGet[$key1] : null;

				if ($key2 !== null && isset($this->ArrPush[$key2])) {
					$vTemp = str_replace("@02", $this->ArrPush[$key2], $vTemp);
				} else {
					$vTemp = str_replace("@02", '', $vTemp); // hoặc giá trị mặc định
				}
				
				$strH=$strH.$vTemp;	
			}
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv199':
						$vStr1='';
						$vChucNang="
						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
						<tr>
						";
						$vChucNang=$vChucNang.'<td><span onclick="ProcessTextHidenMore(this)"><a href="javascript:FunctRunning1(\''.$vrow['lv001'].'\')"><img style="cursor:pointer;width:25px;;padding:5px;"  alt="NoImg" src="../images/icon/work_experience.png" align="middle" border="0" name="new" class="lviconimg"></a></span></td>';
						if(($vrow['lv098']<1)) 
						{
							$vChucNang=$vChucNang.'
							<td>
							
							<img Title="'.((isset($vrow['lv027']) && $vrow['lv027']==0) ? 'Edit' : 'View').'" 
								 style="cursor:pointer;width:25px;padding:5px;" 
								 onclick="Edit(\''.($vrow['lv001']).'\')" 
								 alt="NoImg" 
								 src="../images/icon/'.((isset($vrow['lv027']) && $vrow['lv027']==0) ? 'Edt.png' : 'detail.png').'" 
								 align="middle" 
								 border="0" 
								 name="new" 
								 class="lviconimg">
							</td>';
						}
						$vChucNang1111 = $vChucNang1111 ?? '';
						$vChucNang=$vChucNang.$vStr1;
						$vStr1='
							<td>
								<div style="cursor:pointer;color:blue;" onclick="showUngTien(\'ungtienid_'.$vrow['lv001'].'\',\''.$vrow['lv001'].'\')">'.'<img style="cursor:pointer;width:25px;;padding:5px;"  alt="NoImg" src="../images/icon/outcome.png" title="Tạo đề nghị chi tiền"/>'.'</div>
									<div style="display:none;position:absolute;z-index:999999999999;background:#efefef;width:1000px;" id="ungtienid_'.$vrow['lv001'].'" class="noidung_member">					
									
									<div class="hd_cafe" style="width:100%">
										<ul class="qlycafe" style="width:100%">
										<li style="padding:10px;"><img onclick="document.getElementById(\'ungtienid_'.$vrow['lv001'].'\').style.display=\'none\';" width="20" src="images/icon/close.png"/></li>
										<li style="padding:10px;"><div style="width:100%;padding-top:2px;">
										
										<div>
										<div style="float:left;"><strong>ĐỀ NGHỊ TẠM ỨNG/THANH TOÁN: '.$vrow['lv009'].' ['.$vrow['lv001'].']</strong></div>'.'
											<div style="float:right;padding-left:50px;">'.$vChucNang1111.'</div>
										</div>
										'.'
											</div>
											</li>
										</ul>
									</div>
									<div id="chitietungtien_'.$vrow['lv001'].'" style="min-width:360px;overflow:hidden;overflow: scroll;"></div>
									<div width="100%;height:40px;">
										<center>
											<div style="width:160px;border-radius:5px;cursor:pointer;height:30px;padding-top:10px;" onclick="document.getElementById(\'ungtienid_'.$vrow['lv001'].'\').style.display=\'none\';">ĐÓNG LẠI</div>
										</center>
									</div>
								</div>	
							</td>
							';
							
						$vChucNang=$vChucNang.$vStr1;
						$vChucNang=$vChucNang."</tr></table>";
						//$vTemp=str_replace("@02",$vChucNang,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));						
						$viewIndex = isset($lstArr[$i]) ? $lstArr[$i] : null;
						$alignValue = isset($this->ArrView[$viewIndex]) ? (int)$this->ArrView[$viewIndex] : 0;
						$vTemp = str_replace("@02", $vChucNang, $this->Align($lvTd, $alignValue));
						
						break;
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
			}				
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
			window.open('".$this->Dir."tc_lv0013/?lang=".$this->lang."&func='+value+'&ID=".base64_encode($this->lv001)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
			$key1 = $lstArr[$i];
			$key2 = isset($this->ArrGet[$key1]) ? (int)$this->ArrGet[$key1] : null;

			if ($key2 !== null && isset($this->ArrPush[$key2])) {
				$strTempChk = str_replace("@01", $i, $lvChk . $this->ArrPush[$key2]);
			} else {
				// Gán giá trị mặc định hoặc bỏ qua nếu không tồn tại
				$strTempChk = str_replace("@01", $i, $lvChk);
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
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM tc_lv0013 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM tc_lv0013 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			if($vrow['lv007']==1)		$strTr=str_replace("@#04","",$strTr);
			
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
			case 'lv003':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0039";
				break;	
			case 'lv009':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002";
				break;
			case 'lv051':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0013 order by lv004 desc";
				break;
			case 'lv999':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0013 where lv011<=1 order by lv004 desc";
				break;
			default:
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
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0039 where lv001='$vSelectID'";	
				break;
			case 'lv009':
				$vsql="select lv001, lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002 where lv001='$vSelectID'";	
				break;
			case 'lv051':
				$vsql="select lv001, lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv003 where lv001='$vSelectID'";	
				break;
			case 'lv098':
				$vsql="select * from
				(
				select 0 lv001,'0. Cho phép tất cả - (Ai có ngày làm và ngày nghỉ việc thoả ĐK lương)' lv002,IF('0'='$vSelectID',1,0) lv003 
				union
				select 1 lv001,'1. Có công + lương, thai sản và nghỉ có lương' lv002,IF('1'='$vSelectID',1,0) lv003 
				union
				select 2 lv001,'2. Tất cả điều được ra dòng lương.' lv002,IF('1'='$vSelectID',1,0) lv003 
				) MP where lv003=1 
				";
				break;
			case 'lv111':
				$vsql="select * from
				(
				select 0 lv001,'Tính công' lv002,IF('0'='$vSelectID',1,0) lv003 
				union
				select 1 lv001,'Tính lương' lv002,IF('1'='$vSelectID',1,0) lv003 
				union
				select 2 lv001,'Hoàn thành' lv002,IF('1'='$vSelectID',1,0) lv003 
				) MP where lv003=1 
				";
				break;
			default:
				$vsql ="";
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