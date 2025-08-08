<?php
/////////////coding hr_lv0038///////////////
class   hr_lv0238 extends lv_controler
{
	public $lv001=null;
	public $FullName =null;
	public $DepID  =null;
	
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
	public $lv099=null;
///////////
	public $DefaultFieldList="lv199,lv001,lv002,lv110,lv003,lv004,lv005,lv006,lv007,lv009,lv010,lv011,lv012,lv015,lv019,lv021,lv027,lv028,lv029,lv030,lv098,lv099,lv008,lv299";		
	//public $DefaultFieldList="lv001,lv002,lv110,lv003,lv004,lv005,lv006,lv007,lv009,lv010,lv011,lv012,lv015,lv019,lv021,lv022,lv017,lv013,lv014,lv026,lv016,lv018,lv024,lv020,lv025,lv023,lv031,lv032,lv033,lv034,lv035,lv036,lv037,lv027,lv028,lv029,lv030,lv098,lv099,lv100,lv008,lv299";	
////////////////////GetDate
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='hr_lv0238';
	public $Dir="";
	public $StaffFull=Array();
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv028"=>"29","lv029"=>"30","lv030"=>"31","lv031"=>"32","lv032"=>"33","lv033"=>"34","lv034"=>"35","lv035"=>"36","lv036"=>"37","lv037"=>"38","lv098"=>"99","lv099"=>"100","lv100"=>"101","lv110"=>"111",'lv299'=>"300","lv199"=>"200");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"2","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"10","lv013"=>"10","lv014"=>"10","lv015"=>"0","lv016"=>"10","lv017"=>"10","lv018"=>"10","lv019"=>"10","lv020"=>"10","lv021"=>"10","lv022"=>"10","lv023"=>"10","lv024"=>"0","lv025"=>"10","lv026"=>"10","lv027"=>"0","lv028"=>"0","lv029"=>"0","lv030"=>"0","lv031"=>"10","lv032"=>"10","lv033"=>"10","lv034"=>"10","lv035"=>"10","lv036"=>"10","lv037"=>"10","lv098"=>"2","lv099"=>"0","lv100"=>"10","lv110"=>"0","lv299"=>"0");	
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
		$vsql="select * from  hr_lv0038";
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
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv299=$vrow['lv299'];
		}
		else
		{
			$this->lv001=null;
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  hr_lv0038 Where lv001='$vlv001'";
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
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv299=$vrow['lv299'];
		}
		else
		{
			$this->lv001=null;
		}
	}
	function LV_LoadIDNoActive($vlv001)
	{
		$lvsql="select * from  hr_lv0038 Where lv001='$vlv001' and lv009=0";
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
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv299=$vrow['lv299'];
		}
		else
		{
			$this->lv001=null;
		}
	}
	function LV_LoadNewID($vlv002)
	{
		$lvsql="select lv001 from  hr_lv0038 Where lv002='$vlv002' Order by lv004 DESC limit 0,1";
		$vresult=db_query($lvsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['lv001'];
		}
		return -1;
	}
	function LV_LoadActiveFullArr($vListEmp)
	{
		
		$lvsql="select * from  hr_lv0038 Where lv002 in ($vListEmp) and lv009='1'";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->StaffFull[$vrow['lv002']]['lv001']=$vrow['lv001'];
			$this->StaffFull[$vrow['lv002']]['lv002']=$vrow['lv002'];
			$this->StaffFull[$vrow['lv002']]['lv003']=$vrow['lv003'];
			$this->StaffFull[$vrow['lv002']]['lv004']=$vrow['lv004'];
			$this->StaffFull[$vrow['lv002']]['lv005']=$vrow['lv005'];
			$this->StaffFull[$vrow['lv002']]['lv006']=$vrow['lv006'];	
			$this->StaffFull[$vrow['lv002']]['lv007']=$vrow['lv007'];
			$this->StaffFull[$vrow['lv002']]['lv008']=$vrow['lv008'];
			$this->StaffFull[$vrow['lv002']]['lv009']=$vrow['lv009'];
			$this->StaffFull[$vrow['lv002']]['lv010']=$vrow['lv010'];	
			$this->StaffFull[$vrow['lv002']]['lv011']=$vrow['lv011'];
			$this->StaffFull[$vrow['lv002']]['lv012']=$vrow['lv012'];
			$this->StaffFull[$vrow['lv002']]['lv013']=$vrow['lv013'];
			$this->StaffFull[$vrow['lv002']]['lv014']=$vrow['lv014'];
			$this->StaffFull[$vrow['lv002']]['lv015']=$vrow['lv015'];
			$this->StaffFull[$vrow['lv002']]['lv016']=$vrow['lv016'];
			$this->StaffFull[$vrow['lv002']]['lv017']=$vrow['lv017'];
			$this->StaffFull[$vrow['lv002']]['lv018']=$vrow['lv018'];
			$this->StaffFull[$vrow['lv002']]['lv019']=$vrow['lv019'];
			$this->StaffFull[$vrow['lv002']]['lv020']=$vrow['lv020'];
			$this->StaffFull[$vrow['lv002']]['lv021']=$vrow['lv021'];
			$this->StaffFull[$vrow['lv002']]['lv022']=$vrow['lv022'];
			$this->StaffFull[$vrow['lv002']]['lv023']=$vrow['lv023'];
			$this->StaffFull[$vrow['lv002']]['lv024']=$vrow['lv024'];
			$this->StaffFull[$vrow['lv002']]['lv025']=$vrow['lv025'];
			$this->StaffFull[$vrow['lv002']]['lv026']=$vrow['lv026'];
			$this->StaffFull[$vrow['lv002']]['lv027']=$vrow['lv027'];
			$this->StaffFull[$vrow['lv002']]['lv028']=$vrow['lv028'];
			$this->StaffFull[$vrow['lv002']]['lv029']=$vrow['lv029'];
			$this->StaffFull[$vrow['lv002']]['lv030']=$vrow['lv030'];
			$this->StaffFull[$vrow['lv002']]['lv031']=$vrow['lv031'];
			$this->StaffFull[$vrow['lv002']]['lv032']=$vrow['lv032'];
			$this->StaffFull[$vrow['lv002']]['lv033']=$vrow['lv033'];
			$this->StaffFull[$vrow['lv002']]['lv034']=$vrow['lv034'];
			$this->StaffFull[$vrow['lv002']]['lv035']=$vrow['lv035'];
			$this->StaffFull[$vrow['lv002']]['lv036']=$vrow['lv036'];
			$this->StaffFull[$vrow['lv002']]['lv037']=$vrow['lv037'];
			$this->StaffFull[$vrow['lv002']]['lv098']=$vrow['lv098'];
			$this->StaffFull[$vrow['lv002']]['lv099']=$vrow['lv099'];
			$this->StaffFull[$vrow['lv002']]['lv299']=$vrow['lv299'];
		}	
		
	}
	function LV_LoadActiveArr($vEmpID)
	{
		if($this->StaffFull[$vEmpID]!=NULL)
		{
			$this->lv001=$this->StaffFull[$vEmpID]['lv001'];
			$this->lv002=$this->StaffFull[$vEmpID]['lv002'];
			$this->lv003=$this->StaffFull[$vEmpID]['lv003'];
			$this->lv004=$this->StaffFull[$vEmpID]['lv004'];
			$this->lv005=$this->StaffFull[$vEmpID]['lv005'];
			$this->lv006=$this->StaffFull[$vEmpID]['lv006'];	
			$this->lv007=$this->StaffFull[$vEmpID]['lv007'];
			$this->lv008=$this->StaffFull[$vEmpID]['lv008'];
			$this->lv009=$this->StaffFull[$vEmpID]['lv009'];
			$this->lv010=$this->StaffFull[$vEmpID]['lv010'];
			$this->lv011=$this->StaffFull[$vEmpID]['lv011'];
			$this->lv012=$this->StaffFull[$vEmpID]['lv012'];
			$this->lv013=$this->StaffFull[$vEmpID]['lv013'];
			$this->lv014=$this->StaffFull[$vEmpID]['lv014'];
			$this->lv015=$this->StaffFull[$vEmpID]['lv015'];
			$this->lv016=$this->StaffFull[$vEmpID]['lv016'];
			$this->lv017=$this->StaffFull[$vEmpID]['lv017'];
			$this->lv018=$this->StaffFull[$vEmpID]['lv018'];
			$this->lv019=$this->StaffFull[$vEmpID]['lv019'];
			$this->lv020=$this->StaffFull[$vEmpID]['lv020'];
			$this->lv021=$this->StaffFull[$vEmpID]['lv021'];
			$this->lv022=$this->StaffFull[$vEmpID]['lv022'];
			$this->lv023=$this->StaffFull[$vEmpID]['lv023'];
			$this->lv024=$this->StaffFull[$vEmpID]['lv024'];
			$this->lv025=$this->StaffFull[$vEmpID]['lv025'];
			$this->lv026=$this->StaffFull[$vEmpID]['lv026'];
			$this->lv027=$this->StaffFull[$vEmpID]['lv027'];
			$this->lv028=$this->StaffFull[$vEmpID]['lv028'];
			$this->lv029=$this->StaffFull[$vEmpID]['lv029'];
			$this->lv030=$this->StaffFull[$vEmpID]['lv030'];
			$this->lv031=$this->StaffFull[$vEmpID]['lv031'];
			$this->lv032=$this->StaffFull[$vEmpID]['lv032'];
			$this->lv033=$this->StaffFull[$vEmpID]['lv033'];
			$this->lv034=$this->StaffFull[$vEmpID]['lv034'];
			$this->lv035=$this->StaffFull[$vEmpID]['lv035'];
			$this->lv036=$this->StaffFull[$vEmpID]['lv036'];
			$this->lv037=$this->StaffFull[$vEmpID]['lv037'];
			$this->lv098=$this->StaffFull[$vEmpID]['lv098'];
			$this->lv099=$this->StaffFull[$vEmpID]['lv099'];
			$this->StaffFull[$vrow['lv002']]['lv299']=$vrow['lv299'];
			
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
			$this->lv013=null;
			$this->lv014=null;
			$this->lv015=null;
			$this->lv016=null;
			$this->lv017=null;
			$this->lv018=null;
			$this->lv019=null;
			$this->lv020=null;
			$this->lv021=null;
			$this->lv022=null;
			$this->lv023=null;
			$this->lv024=null;
			$this->lv025=null;
			$this->lv026=null;
			$this->lv027=null;
			$this->lv028=null;
			$this->lv029=null;
			$this->lv030=null;
			$this->lv031=null;
			$this->lv032=null;
			$this->lv033=null;
			$this->lv034=null;
			$this->lv035=null;
			$this->lv036=null;
			$this->lv037=null;
		}
	}
	function LV_LoadActive($lv002)
	{
		$lvsql="select * from  hr_lv0038 Where lv002='$lv002' and lv009='1' limit 0,1";
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
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv299=$vrow['lv299'];
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
			$this->lv013=null;
			$this->lv014=null;
			$this->lv015=null;
			$this->lv016=null;
			$this->lv017=null;
			$this->lv018=null;
			$this->lv019=null;
			$this->lv020=null;
			$this->lv021=null;
			$this->lv022=null;
			$this->lv023=null;
			$this->lv024=null;
			$this->lv025=null;
			$this->lv026=null;
			$this->lv027=null;
			$this->lv028=null;
			$this->lv029=null;
			$this->lv030=null;
			$this->lv031=null;
			$this->lv032=null;
			$this->lv033=null;
			$this->lv034=null;
			$this->lv035=null;
			$this->lv036=null;
			$this->lv037=null;
		}
	}
	function LV_LoadHDMonth($vEmpID,$sMonth,$sYear)
	{
		$vMinDate='2015-01-01';
		$vMaxDate=$this->DateCurrent;
		$cM=getmonth($vMaxDate);
		$cY=getyear($vMaxDate);
		$vArrContractBuild=Array();
		
		$lvsql="
		SELECT MP.* FROM (
			select IF(A.lv100=1,CURDATE(),A.lv004) DateS,A.lv100 IsActive,ADDDATE(A.lv005,1) DateE,A.lv001,A.lv003,A.lv004,A.lv005,A.lv009,A.lv010,A.lv021,A.lv022,A.lv023,A.lv024,A.lv025,A.lv027,A.lv028 from hr_lv0038 A where A.lv003<>'9' and A.lv002='".$vEmpID."' $vCondition
			UNION
			select B.lv004 DateS,A.lv100 IsActive,ADDDATE(A.lv005,1) DateE,A.lv001,A.lv003,A.lv004,A.lv005,A.lv009,IF(B.lv003='DOICVPB' OR B.lv003='DOIPHONGBAN',B.lv006,A.lv010) lv010,A.lv021,A.lv022,A.lv023,A.lv024,A.lv025,B.lv010 lv027,B.lv011 lv028 from hr_lv0038 A inner join hr_lv0098 B on B.lv099=A.lv001 where A.lv003<>'9' and  A.lv002='".$vEmpID."' $vCondition
		) MP order by MP.DateS ASC";
		$vresult=db_query($lvsql);
		$vArrContractSave=Array();
		$vPre=0;
		$isFirst=false;
		$vCodeFirst='';
		$vArrHD=Array();
		$vACot3=Array();
		$vACot7=Array();
		$vContractID='';
		while($vrow=db_fetch_array($vresult))
		{
			if($vrow['lv009']==1) $vContractIDNo=$vrow['lv001'];
			if($vrow['IsActive']==1 && $vArrHD[0]!=$vrow['lv001'] )
			{
				if($vArrHD!=NULL)
				{
					if($vArrHD[1]<$vrow['DateS'])
					{
						$vdatefrom=$vArrHD[1];
					}
					else
						$vdatefrom=$vrow['DateS'];
				}
				else
				{
					if($vMinDate>$vrow['lv004'])
						$vdatefrom=$vMinDate;
					else
						$vdatefrom=$vrow['lv004'];
				}
			}
			else
			{
				if($vMinDate>$vrow['DateS'])
				{
					$vdatefrom=$vMinDate;
				}
				else
					$vdatefrom=$vrow['DateS'];
			}
			$vArrHD[0]=$vrow['lv001'];
			$vArrHD[1]=$vrow['DateE'];
			$vYearS=getyear($vdatefrom);
			$vYearE=getyear($vMaxDate);
			$vYMin=getyear($vMinDate);
			if($vYearS<$vYMin) $vYearS=$vYMin;
			for($y=$vYearS;$y<=$vYearE;$y++)
			{
				if($y==$vYearS)
				{
					$vMonthS=(int)getmonth($vdatefrom);
				}
				else
					$vMonthS=1;
				if($y==$cY) 
					$vMonthE=$cM;
				else 
					$vMonthE=12;
				for($m=$vMonthS;$m<=$vMonthE;$m++)
				{
					if($sMonth==$m && $y==$sYear)
					{
						$vContractID=$vrow['lv001'];
					}
					
				}
		
			}			
			
		}
		if($vContractID=='') $vContractID=$vContractIDNo;
		return $vContractID;
	}
	function LV_LoadActivePre($lv001)
	{
		$lvsql="select * from  hr_lv0038 Where lv001='$lv001'";
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
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv299=$vrow['lv299'];
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
			$this->lv013=null;
			$this->lv014=null;
			$this->lv015=null;
			$this->lv016=null;
			$this->lv017=null;
			$this->lv018=null;
			$this->lv019=null;
			$this->lv020=null;
			$this->lv021=null;
			$this->lv022=null;
			$this->lv023=null;
			$this->lv024=null;
			$this->lv025=null;
			$this->lv026=null;
			$this->lv027=null;
			$this->lv028=null;
			$this->lv029=null;
			$this->lv030=null;
			$this->lv031=null;
			$this->lv032=null;
			$this->lv033=null;
			$this->lv034=null;
			$this->lv035=null;
			$this->lv036=null;
			$this->lv037=null;
		}
	}
	function LV_LoadActiveSpecial($lv002)
	{
		$lvsql="select * from  hr_lv0038 Where lv002='$lv002' and lv009='1'";
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
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv299=$vrow['lv299'];
		}	
		else
		{
			$lvsql="select * from  hr_lv0038 Where lv002='$lv002' order by lv004 desc";
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
				$this->lv027=$vrow['lv027'];
				$this->lv028=$vrow['lv028'];
				$this->lv029=$vrow['lv029'];
				$this->lv030=$vrow['lv030'];
				$this->lv031=$vrow['lv031'];
				$this->lv032=$vrow['lv032'];
				$this->lv033=$vrow['lv033'];
				$this->lv034=$vrow['lv034'];
				$this->lv035=$vrow['lv035'];
				$this->lv036=$vrow['lv036'];
				$this->lv037=$vrow['lv037'];
				$this->lv098=$vrow['lv098'];
				$this->lv099=$vrow['lv099'];
				$this->lv299=$vrow['lv299'];
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
				$this->lv013=null;
				$this->lv014=null;
				$this->lv015=null;
				$this->lv016=null;
				$this->lv017=null;
				$this->lv018=null;
				$this->lv019=null;
				$this->lv020=null;
				$this->lv021=null;
				$this->lv022=null;
				$this->lv023=null;
				$this->lv024=null;
				$this->lv025=null;
				$this->lv026=null;
				$this->lv027=null;
				$this->lv028=null;
				$this->lv029=null;
				$this->lv030=null;
				$this->lv031=null;
				$this->lv032=null;
				$this->lv033=null;
				$this->lv034=null;
				$this->lv035=null;
				$this->lv036=null;
				$this->lv037=null;
			}
		}
	}
	function LV_PreLoadActive($lv002)
	{
		$lvsql="select * from  hr_lv0038 Where lv002='$lv002' and lv009='2' order by lv004 desc";
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
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv299=$vrow['lv299'];
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
			$this->lv013=null;
			$this->lv014=null;
			$this->lv015=null;
			$this->lv016=null;
			$this->lv017=null;
			$this->lv018=null;
			$this->lv019=null;
			$this->lv020=null;
			$this->lv021=null;
			$this->lv022=null;
			$this->lv023=null;
			$this->lv024=null;
			$this->lv025=null;
			$this->lv026=null;
			$this->lv027=null;
			$this->lv028=null;
			$this->lv029=null;
			$this->lv030=null;
			$this->lv031=null;
			$this->lv032=null;
			$this->lv033=null;
			$this->lv034=null;
			$this->lv035=null;
			$this->lv036=null;
			$this->lv037=null;
		}
	}
	function LV_LoadTemplate($vlv001)
	{
		$strReturn="";
		$lvsql="select A.*,B.lv003 lv013 from  hr_lv0038 A left join hr_lv0043 B on A.lv008=B.lv001 Where A.lv001='$vlv001'";
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
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv299=$vrow['lv299'];
			$strReturn=$vrow['lv008'];
			
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
			$this->lv013=null;
			$this->lv014=null;
			$this->lv015=null;
			$this->lv016=null;
			$this->lv017=null;
			$this->lv018=null;
			$this->lv019=null;
			$this->lv020=null;
			$this->lv021=null;
			$this->lv022=null;
			$this->lv023=null;
			$this->lv024=null;
			$this->lv025=null;
			$this->lv026=null;
			$this->lv027=null;
			$this->lv028=null;
			$this->lv029=null;
			$this->lv030=null;
			$this->lv031=null;
			$this->lv032=null;
			$this->lv033=null;
			$this->lv034=null;
			$this->lv035=null;
			$this->lv036=null;
			$this->lv037=null;
		}
		return $strReturn;
	}
	function LV_Insert($vdatabase='')
	{
		if($this->isAdd==0) return false;
		if($vdatabase=='')
		{
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$this->lv098 = ($this->lv098!="")?recoverdate(($this->lv098), $this->lang):$this->DateDefault;
		$lvsql="insert into hr_lv0038 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028,lv029,lv030,lv031,lv032,lv033,lv034,lv035,lv036,lv037,lv098,lv099,lv299) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','".sof_escape_string($this->lv008)."','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023','$this->lv024','$this->lv025','$this->lv026','$this->lv027','$this->lv028','$this->lv029','$this->lv030','$this->lv031','$this->lv032','$this->lv033','$this->lv034','$this->lv035','$this->lv036','$this->lv037','$this->lv098','$this->lv099','$this->lv299')";
		}
		else
		{
			$lvsql="insert into $vdatabase.hr_lv0038 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028,lv029,lv030,lv031,lv032,lv033,lv034,lv035,lv036,lv037,lv098,lv099,lv299) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','".sof_escape_string($this->lv008)."','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023','$this->lv024','$this->lv025','$this->lv026','$this->lv027','$this->lv028','$this->lv029','$this->lv030','$this->lv031','$this->lv032','$this->lv033','$this->lv034','$this->lv035','$this->lv036','$this->lv037','$this->lv098','$this->lv099','$this->lv299')";
		}
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			if($this->lv099!="" || $this->lv099!=NULL)
			{
				$this->LV_InsertDetail($this->lv099,$this->lv001,$vdatabase);
			}
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0038.insert',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_Insert_NoID()
	{
		if($this->isAdd==0) return false;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$this->lv098 = ($this->lv098!="")?recoverdate(($this->lv098), $this->lang):$this->DateDefault;
		$lvsql="insert into hr_lv0038 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028,lv029,lv030,lv031,lv032,lv033,lv034,lv035,lv036,lv037,lv098,lv299) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023','$this->lv024','$this->lv025','$this->lv026','$this->lv027','$this->lv028','$this->lv029','$this->lv030','$this->lv031','$this->lv032','$this->lv033','$this->lv034','$this->lv035','$this->lv036','$this->lv037','$this->lv098','$this->lv299')";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{	
			$this->lv001 = sof_insert_id();
			if($this->lv099!="" || $this->lv099!=NULL)
			{
				$this->LV_InsertDetail($this->lv099,$this->lv001);
			}
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0038.insert',sof_escape_string($lvsql));
		}
		 
		return $vReturn;
	}
	function LV_InsertDetail($vID,$vNewID,$vdatabase='')
	{
		if($vdatabase!='') $vdatabase=$vdatabase.".";
		$vsql="insert into hr_lv0042(lv002,lv003,lv004,lv005,lv006,lv007) select A.lv002,'$vNewID',A.lv004,A.lv005,A.lv006,A.lv007 from hr_lv0042 A where A.lv003='$vID'";
		$vReturn= db_query($vsql);
		return $vReturn;
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$this->lv098 = ($this->lv098!="")?recoverdate(($this->lv098), $this->lang):$this->DateDefault;
		$lvsql="Update hr_lv0038 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='".sof_escape_string($this->lv008)."',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018',lv019='$this->lv019',lv020='$this->lv020',lv021='$this->lv021',lv023='$this->lv023',lv024='$this->lv024',lv025='$this->lv025',lv027='$this->lv027',lv028='$this->lv028',lv029='$this->lv029',lv030='$this->lv030',lv031='$this->lv031',lv032='$this->lv032',lv033='$this->lv033',lv034='$this->lv034',lv035='$this->lv035',lv036='$this->lv036',lv037='$this->lv037',lv096='$this->lv096',lv097='$this->lv097',lv098='$this->lv098',lv099='$this->lv099',lv298='$this->lv298',lv299='$this->lv299',lv300='$this->lv300',lv301='$this->lv301' where  lv001='$this->lv001' AND lv009<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0038.update',sof_escape_string($lvsql));
			$lvsql="update tc_lv0010 set lv004='$this->lv004',lv005='$this->lv005' where lv010='".$this->lv001."'";
			$vReturn= db_query($lvsql);
			if($vReturn) 
			{
				$this->InsertLogOperation($this->DateCurrent,'tc_lv0010.update',sof_escape_string($lvsql));
				$lvsql1="delete from  tc_lv0011  where lv099='".$this->lv001."' and (lv004>'$this->lv005' or lv004<'$this->lv004')";
				$vReturn= db_query($lvsql1);
				if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0010.update',sof_escape_string($lvsql1));
			}
		}
			
		return $vReturn;
	}
	function LV_ShowLich($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql="Update tc_lv0011 set lv100=0  where  lv099 in (select A.lv001 from hr_lv0038 A where A.lv001 in ($lvarr) and A.lv009=0);";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0038.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_ShowLichFullStaff($vStaffID)
	{
		if($this->isApr==0) return false;
		$lvsql="select A.lv001,A.lv004,A.lv005 from hr_lv0038 A where A.lv002 ='$vStaffID' order by A.lv004 ASC,A.lv005 ASC";
		$vresult=db_query($lvsql);
		$vHDVisible='';
		while($vrow=db_fetch_array($vresult))
		{
			$lvsql1="Update tc_lv0011 set lv100=0  where lv099='".$vrow['lv001']."' and lv004>='".$vrow['lv004']."'";
			$vReturn= db_query($lvsql1);
			if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0011.update',sof_escape_string($lvsql1));
			if($vHDVisible!='')
			{
				$lvsql2="Update tc_lv0011 set lv100=1  where lv099 in ($vHDVisible) and lv004>='".$vrow['lv004']."' and lv004<='".$vrow['lv005']."'";
				$vReturn= db_query($lvsql2);
				if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0011.update',sof_escape_string($lvsql2));
			}
			if($vHDVisible=='')
				$vHDVisible="'".$vrow['lv001']."'";
			else
				$vHDVisible=$vHDVisible.",'".$vrow['lv001']."'";
		}
		return $vReturn;
	}
	function LV_ShowLichFull($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql="select A.lv001,A.lv004,A.lv005 from hr_lv0038 A where A.lv001 in ($lvarr) and A.lv009=0 order by A.lv004 ASC,A.lv005 ASC";
		$vresult=db_query($lvsql);
		$vHDVisible='';
		while($vrow=db_fetch_array($vresult))
		{
			$lvsql1="Update tc_lv0011 set lv100=0  where lv099='".$vrow['lv001']."' and lv004>='".$vrow['lv004']."'";
			$vReturn= db_query($lvsql1);
			if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0011.update',sof_escape_string($lvsql1));
			if($vHDVisible!='')
			{
				$lvsql2="Update tc_lv0011 set lv100=1  where lv099='$vHDVisible' and lv004>='".$vrow['lv004']."' and lv004<='".$vrow['lv005']."'";
				$vReturn= db_query($lvsql2);
				if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0011.update',sof_escape_string($lvsql2));
			}
			$vHDVisible=$vrow['lv001'];
			$vDayEnd=$vrow['lv005'];
		}
		return $vReturn;
	}
	function LV_GetCheckSameOne($vTypeCheck,$vTypeString,$vDateContract='',$vHDID='',$vStrPL='',$vType=0)
	{
		$vIsTrue=false;
		$vArrTmp=Array();
		$vArrTypeCheck=explode(",",$vTypeCheck);
		foreach($vArrTypeCheck as $vType)
		{
			$vArrTmp[$vType]=true;
		}
		$vArrTypeString=explode(",",$vTypeString);
		foreach($vArrTypeString as $vType)
		{
			if($vArrTmp[$vType])
			{
				if($this->ArrHDOrPL[$vType][0])
				{
					if($vDateContract>$this->ArrHDOrPL[$vType][1])
					{
						$this->ArrHDOrPL[$vType][1]=$vDateContract;
						$this->ArrHDOrPL[$vType][2]=$vHDID;
						$this->ArrHDOrPL[$vType][3]=$vStrPL;
						$this->ArrHDOrPL[$vType][4]=$vType;
						
					}
				}
				else
				{
					$this->ArrHDOrPL[$vType][0]=true;
					$this->ArrHDOrPL[$vType][1]=$vDateContract;
					$this->ArrHDOrPL[$vType][2]=$vHDID;
					$this->ArrHDOrPL[$vType][3]=$vStrPL;
					$this->ArrHDOrPL[$vType][4]=$vType;
				}
				
				
				$vIsTrue= true;
			} 
		}
		return $vIsTrue;
	}
	function LV_GetHD_PLHD($vTypeCheck,&$vHD='',&$vPLHD='')
	{
		$vArrTmp=Array();
		$vArrTypeCheck=explode(",",$vTypeCheck);
		$vArrMaHDSave=Array();
		foreach($vArrTypeCheck as $vType)
		{
			if(!$vArrMaHDSave[$this->ArrHDOrPL[$vType][2]])
			{
				$vArrMaHDSave[$this->ArrHDOrPL[$vType][2]]=true;
				//echo $this->ArrHDOrPL[$vType][3];
				if($this->ArrHDOrPL[$vType][4]==1)
				{
					if($vPLHD!='')
						$vPLHD=$vPLHD.', PLHĐLĐ số: '.$this->ArrHDOrPL[$vType][3];
					else
						$vPLHD=$this->ArrHDOrPL[$vType][3];
				}
				else
				{
					if($vHD!='')
						$vHD=$vHD.', HĐLĐ số: '.$this->ArrHDOrPL[$vType][3];
					else
						$vHD=$this->ArrHDOrPL[$vType][3];
				}
			}
			
		}
	}
	//Lấy thông hợp đồng
	function LV_ThayDoiLuong($vParentID,$vDateContract,&$vArrListContractLabor,$vHDLD='',$vPLHDLD='',$vTypeCheck='',$vMaChucDanh)
	{
		if($vParentID=='') return;
		$lvsql="select A.lv001,A.lv003,A.lv004,A.lv016,A.lv099,A.lv097 from hr_lv0098 A where A.lv099='$vParentID' and A.lv001<>'$vMaChucDanh'";
		$vresult=db_query($lvsql);
		$vHDVisible='';
		$vParentID='';
		while($vrow=db_fetch_array($vresult))
		{
			$vDateContract=$vrow['lv004'];
			$vArrListContractLabor[$vrow['lv004']]='PLHĐLĐ số: '.$vrow['lv016'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
			/*
			if($vArrListContractLabor=='')
			{
				$vArrListContractLabor='PLHĐLĐ số: '.$vrow['lv016'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
			}
			else
			{
				$vArrListContractLabor=$vArrListContractLabor.', PLHĐLĐ số: '.$vrow['lv016'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
			}
			*/
			$vParentID=$vrow['lv001'];
			$vHDVisible=$vrow['lv006'];
			if($vrow['lv096']!=NULL && trim($vrow['lv096'])!='') $vHDVisible=$this->LV_ThayDoiLuongChild($vrow['lv096'],$vDateContract,$vArrListContractLabor,$vHDLD,$vPLHDLD,$vTypeCheck);
			return $vHDVisible;	
		}
		return $vHDVisible;
	}
	function LV_ThayDoiLuongChild($vParentID,$vDateContract,&$vArrListContractLabor,$vHDLD='',$vPLHDLD='',$vTypeCheck='',$vMaChucDanh)
	{
		$lvsql="select A.lv001,A.lv003,A.lv004,A.lv016,A.lv099,A.lv096 from hr_lv0098 A where A.lv096='$vParentID' and A.lv001<>'$vMaChucDanh'";
		$vresult=db_query($lvsql);
		$vHDVisible='';
		$vParentID='';
		while($vrow=db_fetch_array($vresult))
		{
			$vDateContract=$vrow['lv004'];
			$vArrListContractLabor[$vrow['lv004']]='PLHĐLĐ số: '.$vrow['lv016'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
			/*
			if($vArrListContractLabor=='')
			{
				$vArrListContractLabor='PLHĐLĐ số: '.$vrow['lv016'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
			}
			else
			{
				$vArrListContractLabor='PLHĐLĐ số: '.$vrow['lv016'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2).', '.$vArrListContractLabor;
			}
			*/
			$vParentID=$vrow['lv001'];
			$vHDVisible=$vrow['lv006'];
			$vHDVisible=$this->LV_LoadContractLaborChild($vrow['lv096'],$vDateContract,$vArrListContractLabor,$vHDLD,$vPLHDLD,$vTypeCheck);
			return $vHDVisible;	
		}
		return $vHDVisible;
	}
	function LV_SortArrayStr($vArrListContractLabor)
	{
		$vReturn='';
		sort($vArrListContractLabor);
		foreach($vArrListContractLabor as $vStr)
		{
			if($vReturn=='') $vReturn=$vStr;
			else
				$vReturn=$vReturn.", ".$vStr;
		}
		return $vReturn;
	}
	//Lấy mã hợp đồng Cha
	function LV_LoadContractLaborParent($vParentID,&$vDateContract,&$vArrListContractLabor,&$vHDLD='',&$vPLHDLD='',$vTypeCheck='',$vMaChucDanh='')
	{
		$this->isLoop=0;
		$lvsql="select A.lv001,A.lv002,A.lv003,A.lv004,A.lv006,A.lv099,A.lv097 from hr_lv0038 A where A.lv001='$vParentID'";
		$vresult=db_query($lvsql);
		$vHDVisible='';
		$vParentID='';
		while($vrow=db_fetch_array($vresult))
		{
			switch($vrow['lv003'])
			{
				case 0:
					$this->MaSoHDTuDong='1'.substr($vrow['lv002'],2,11);
					$vDateContract=$vrow['lv004'];
					if($vHDLD=='')
						{
							$vHDLDTemp=' '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
							if($this->LV_GetCheckSameOne($vrow['lv097'],$vTypeCheck,$vDateContract,$vrow['lv006'],$vHDLDTemp))
							{	
								$vHDLD=$vHDLDTemp;
							}
						}
					//$vArrListContractLabor=' HĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
					$vArrListContractLabor[$vrow['lv004']]=' HĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
					$vHDVisible=$vrow['lv006'];
					$this->LV_ThayDoiLuong($vrow['lv001'],$vDateContract,$vArrListContractLabor,$vHDLD,$vPLHDLD,$vTypeCheck,$vMaChucDanh);
					return $vHDVisible;
					break;
				case 1:
				case 2:
				case 3:
					$this->MaSoHDTuDong=$vrow['lv003'].substr($vrow['lv002'],2,11);
					$vDateContract=$vrow['lv004'];
					if($vHDLD=='')
						{
							$vHDLDTemp=' '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
							if($this->LV_GetCheckSameOne($vrow['lv097'],$vTypeCheck,$vDateContract,$vrow['lv006'],$vHDLDTemp))
							{	
								$vHDLD=$vHDLDTemp;
							}
						}
					//$vArrListContractLabor=' HĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
					$vArrListContractLabor[$vrow['lv004']]=' HĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
					$vHDVisible=$vrow['lv006'];
					$this->LV_ThayDoiLuong($vrow['lv001'],$vDateContract,$vArrListContractLabor,$vHDLD,$vPLHDLD,$vTypeCheck,$vMaChucDanh);
					return $vHDVisible;
					break;
				default:
					$vDateContract=$vrow['lv004'];
					if($vParentID!=$vrow['lv099'])
					{
						if($vPLHDLD=='')
						{
							$vHDLDTemp=' '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
							if($this->LV_GetCheckSameOne($vrow['lv097'],$vTypeCheck,$vDateContract,$vrow['lv006'],$vHDLDTemp,1))
							{	
								$vPLHDLD=$vHDLDTemp;
							}
						}
						$vArrListContractLabor[$vrow['lv004']]='PLHĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
						/*
						if($vArrListContractLabor=='')
						{
							$vArrListContractLabor='PLHĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
						}
						else
						{
							$vArrListContractLabor='PLHĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2).', '.$vArrListContractLabor;
						}
						*/
						$this->LV_ThayDoiLuong($vrow['lv001'],$vDateContract,$vArrListContractLabor,$vHDLD,$vPLHDLD,$vTypeCheck,$vMaChucDanh);
						$vParentID=$vrow['lv001'];
						$vHDVisible=$vrow['lv006'];
						$vHDVisible=$this->LV_LoadContractLaborChild($vrow['lv099'],$vDateContract,$vArrListContractLabor,$vHDLD,$vPLHDLD,$vTypeCheck,$vMaChucDanh);
						return $vHDVisible;
					}
					break;
			}
		}
		return $vHDVisible;
	}
	function LV_LoadContractLaborChild($vParentID,&$vDateContract,&$vArrListContractLabor,&$vHDLD,&$vPLHDLD,$vTypeCheck,$vMaChucDanh='')
	{
		$lvsql="select A.lv001,A.lv002,A.lv003,A.lv004,A.lv006,A.lv099,A.lv097 from hr_lv0038 A where A.lv001='$vParentID'";
		$vresult=db_query($lvsql);
		$vHDVisible='';
		while($vrow=db_fetch_array($vresult))
		{
			switch($vrow['lv003'])
			{
				case 1:
				case 2:
				case 3:
					$this->MaSoHDTuDong=$vrow['lv003'].substr($vrow['lv002'],2,11);
					$vDateContract=$vrow['lv004'];
					$vHDVisible=$vrow['lv006'];
					if($vHDLD=='')
						{
							$vHDLDTemp=' '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
							if($this->LV_GetCheckSameOne($vrow['lv097'],$vTypeCheck,$vDateContract,$vrow['lv006'],$vHDLDTemp))
							{	
								$vHDLD=$vHDLDTemp;
							}
						}
					$vArrListContractLabor[$vrow['lv004']]='HĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
					/*
					if($vArrListContractLabor=='')
						$vArrListContractLabor='HĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
					else
						$vArrListContractLabor='HĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2).', '.$vArrListContractLabor;
					*/
					$this->LV_ThayDoiLuong($vrow['lv001'],$vDateContract,$vArrListContractLabor,$vHDLD,$vPLHDLD,$vTypeCheck,$vMaChucDanh);
					return $vHDVisible;
					break;
			
				default:
					$vDateContract=$vrow['lv004'];
					if($vParentID!=$vrow['lv099'])
					{
						if($vPLHDLD=='')
						{
							$vPLHDLDTemp=' '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
							if($this->LV_GetCheckSameOne($vrow['lv097'],$vTypeCheck,$vDateContract,$vrow['lv006'],$vPLHDLDTemp,1))
							{	
								$vPLHDLD=$vPLHDLDTemp;
							}
						}
						$vArrListContractLabor[$vrow['lv004']]='PLHĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
						/*if($vArrListContractLabor=='')
							$vArrListContractLabor='PLHĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2);
						else
							$vArrListContractLabor='PLHĐLĐ số: '.$vrow['lv006'].' hiệu lực từ ngày '.$this->FormatView($vDateContract,2).', '.$vArrListContractLabor;
						*/
						$vParentID=$vrow['lv001'];
						$vHDVisible=$vrow['lv006'];
						$this->LV_ThayDoiLuong($vrow['lv001'],$vDateContract,$vArrListContractLabor,$vHDLD,$vPLHDLD,$vTypeCheck,$vMaChucDanh);
						if($this->isLoop<100)
						{
							$vHDVisible=$this->LV_LoadContractLaborChild($vrow['lv099'],$vDateContract,$vArrListContractLabor,$vHDLD,$vPLHDLD,$vTypeCheck,$vMaChucDanh);
							$this->isLoop++;
						} 

						return $vHDVisible;

					}
					break;
			}
		}
	}
	function LV_ContractRunAll($vStaffID,$vdatabase)
	{
		$vArrStaff=$this->LV_ContractAll($vStaffID,$vdatabase);
		foreach($vArrStaff as $vrow)
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
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];

			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
			$this->lv299=$vrow['lv299'];
			if($this->LV_Insert($vdatabase))
			{
				$lvtc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
				$lvtc_lv0011=new tc_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0011');
				$lvtc_lv0008->lang=$this->lang;
				$lvtc_lv0008->LV_InsertEmpContract($this->lv002,$this->lv010,$this->lv007,$this->lv004,$this->lv005,$vdatabase);
				$lvtc_lv0010=new tc_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0046');
				//$lvtc_lv0010->lv001=InsertWithCheckExt('tc_lv0010', 'lv001', '',1);
				$lvtc_lv0010->lv002=$vStaffID;
				$lvtc_lv0010->lv003="PRJ000001";
				$lvtc_lv0010->lv004=$this->lv004;
				$lvtc_lv0010->lv005=$this->lv005;
				$lvtc_lv0010->lv006=1;
				$lvtc_lv0010->lv008=$_SESSION['ERPSOFV2RUserID'];
				$lvtc_lv0010->lv009=GetServerDate();
				$lvtc_lv0010->lv010=$this->lv001;
				$lvResult=$lvtc_lv0010->LV_InsertNoID($vdatabase);				
				if($lvResult)
				{
					$vTimesheetID=$lvtc_lv0010->lv001;
					$vDateLimited=$lvtc_lv0011->LV_GetHoliday($this->lv004,$this->lv005);
					$psql="insert into $vdatabase.tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,'$this->lv001' from $vdatabase.tc_lv0011_ where lv004>='$lvtc_lv0010->lv004' and lv004<='$lvtc_lv0010->lv005' and (lv004 not in ($vDateLimited))";
					db_query($psql);
					$psql="insert into $vdatabase.tc_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv099) select '$vTimesheetID',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,'$this->lv001' from $vdatabase.tc_lv0011_ where lv004>='$lvtc_lv0010->lv004' and lv004<='$lvtc_lv0010->lv005' and (lv004 in ($vDateLimited))";
					db_query($psql);
				}
				$lvtc_lv0010->LV_UpdateBalanceCalanda($lvtc_lv0010->lv002,$lvtc_lv0010->lv001,$lvtc_lv0010->lv004,$lvtc_lv0010->lv005,$this->lv001,$this->lv099,$vdatabase);
			}
			break;
		}
	}
	function LV_ContractAll($vStaffID,$vdatabase)
	{
		$vArrStaff=Array();
		$lvsql="select * from  hr_lv0038  Where lv002='$vStaffID' and lv001 not in ( select A.lv102 from $vdatabase.hr_lv0038 A where A.lv002='$vStaffID' )";
		$vresult=db_query($lvsql);
		$i=0;
		while($vrow=db_fetch_array($vresult))
		{
			$vArrStaff[$i]=$vrow;
			$i++;
		}
		return $vArrStaff;
	}
	function LV_BuilListXML($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
		$lvTable='<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>vt</Author>
  <LastAuthor>vt</LastAuthor>
  <Created>2017-10-06T03:57:47Z</Created>
  <Version>12.00</Version>
 </DocumentProperties>
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <Colors>
   <Color>
    <Index>9</Index>
    <RGB>#006600</RGB>
   </Color>
   <Color>
    <Index>11</Index>
    <RGB>#996600</RGB>
   </Color>
  </Colors>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>8190</WindowHeight>
  <WindowWidth>16380</WindowWidth>
  <WindowTopX>0</WindowTopX>
  <WindowTopY>0</WindowTopY>
  <TabRatio>500</TabRatio>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s16" ss:Name="Comma">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
  </Style>
  <Style ss:ID="s61" ss:Name="Normal 2">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s62" ss:Name="Normal 3">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Calibri" x:CharSet="134" x:Family="Swiss" ss:Size="11"
    ss:Color="#000000"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s70">
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s71">
   <Interior/>
  </Style>
  <Style ss:ID="s72" ss:Parent="s16">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Interior ss:Color="#FFFFFF" ss:Pattern="Solid"/>
   <Protection/>
  </Style>
  <Style ss:ID="s73">
   <Interior ss:Color="#FFCC99" ss:Pattern="Solid"/>
   <NumberFormat/>
  </Style>
  <Style ss:ID="s74">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Interior ss:Color="#33CCCC" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s75">
   <Interior ss:Color="#FFFFFF" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s76">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s77">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s78">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="8" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s79">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="11" ss:Bold="0"/>
   <Interior ss:Color="#FFFFFF" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s80">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="0"/>
   <Interior ss:Color="#FFFFFF" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s81">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s82">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1" ss:Italic="1"
    ss:Underline="Single"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s83">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1" ss:StrikeThrough="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s84" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
   <Protection/>
  </Style>
  <Style ss:ID="s85">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="11" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s86" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="0"/>
   <Protection/>
  </Style>
  <Style ss:ID="s87">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat/>
  </Style>
  <Style ss:ID="s88">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1" ss:StrikeThrough="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s89">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="11" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s90">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Size="11" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s91">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="0"/>
  </Style>
  <Style ss:ID="s92">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="0"/>
  </Style>
  <Style ss:ID="s93">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s94">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman1" ss:Bold="1"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="d\-m\-yy"/>
  </Style>
  <Style ss:ID="s95">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior ss:Color="#FFFFFF" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s96">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior ss:Color="#FFFFFF" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s97">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior ss:Color="#FFFFFF" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s98">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s99">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s100">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s101">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s102">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s103">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
  </Style>
  <Style ss:ID="s104">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s105">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="12"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s106">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s107" ss:Parent="s16">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Color="#000000"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s108">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <Interior/>
   <NumberFormat/>
  </Style>
  <Style ss:ID="s109" ss:Parent="s16">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Interior ss:Color="#FFFFFF" ss:Pattern="Solid"/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s110" ss:Parent="s62">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman11"/>
   <Interior ss:Color="#FFCC99" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s111">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <Interior ss:Color="#33CCCC" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s112">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <Interior ss:Color="#FFFFFF" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s113">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s114">
   <Font ss:FontName="Arial" x:Family="Swiss"/>
  </Style>
  <Style ss:ID="s115">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s116" ss:Parent="s16">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Color="#000000"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
   <Protection/>
  </Style>
  <Style ss:ID="s117" ss:Parent="s16">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Color="#000000"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s118">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s119">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Color="#FF0000"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s120">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <NumberFormat/>
  </Style>
  <Style ss:ID="s121">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s122">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior ss:Color="#FFFF00" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s123">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s124" ss:Parent="s61">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="11" ss:Bold="1"/>
   <Interior/>
   <NumberFormat ss:Format="0"/>
  </Style>
  <Style ss:ID="s125">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <Interior/>
  </Style>
  <Style ss:ID="s126">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior/>
  </Style>
  <Style ss:ID="s127">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior/>
  </Style>
  <Style ss:ID="s128">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior/>
  </Style>
  <Style ss:ID="s129">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior/>
  </Style>
  <Style ss:ID="s130">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior/>
  </Style>
  <Style ss:ID="s131">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior/>
  </Style>
  <Style ss:ID="s132">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior/>
  </Style>
  <Style ss:ID="s133">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s134">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="12"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s135">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s136">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s137" ss:Parent="s16">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s138">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <Interior/>
   <NumberFormat/>
  </Style>
  <Style ss:ID="s139" ss:Parent="s16">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s140" ss:Parent="s62">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Times New Roman11"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s141">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <Interior/>
   <NumberFormat ss:Format="@"/>
  </Style>
 </Styles>
 <Names>
  <NamedRange ss:Name="__Anonymous_Sheet_DB__1" ss:RefersTo="=#REF!"/>
 </Names>
 <Worksheet ss:Name="DSNV PHÚ THUẬN">
  <Names>
   <NamedRange ss:Name="_FilterDatabase"
    ss:RefersTo="=\'DSNV PHÚ THUẬN\'!R1C1:R30C61" ss:Hidden="1"/>
  </Names>
  <Table ss:ExpandedColumnCount="61" ss:ExpandedRowCount="3000" x:FullColumns="1"
   x:FullRows="1" ss:DefaultRowHeight="15">
   <Column ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="119.25"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="69"/>
   <Column ss:AutoFitWidth="0" ss:Width="95.25"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="69"/>
   <Column ss:AutoFitWidth="0" ss:Width="69.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="89.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="82.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="60.75" ss:Span="1"/>
   <Column ss:Index="13" ss:AutoFitWidth="0" ss:Width="207.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="99.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="75"/>
   <Column ss:AutoFitWidth="0" ss:Width="200.25"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="96"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="90"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="90"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="82.5"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="61.5" ss:Span="1"/>
   <Column ss:Index="26" ss:AutoFitWidth="0" ss:Width="60.75" ss:Span="2"/>
   <Column ss:Index="29" ss:AutoFitWidth="0" ss:Width="61.5" ss:Span="1"/>
   <Column ss:Index="31" ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="61.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="61.5"/>
   <Column ss:StyleID="s71" ss:AutoFitWidth="0" ss:Width="61.5"/>
   <Column ss:StyleID="s72" ss:AutoFitWidth="0" ss:Width="61.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:StyleID="s73" ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:StyleID="s74" ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:StyleID="s75" ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="60.75" ss:Span="1"/>
   <Column ss:Index="43" ss:StyleID="s76" ss:AutoFitWidth="0" ss:Width="76.5"/>
   <Column ss:Index="51" ss:AutoFitWidth="0" ss:Width="122.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="60.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="126"/>
   <Column ss:AutoFitWidth="0" ss:Width="72.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="60.75" ss:Span="6"/>
   <Column ss:AutoFitWidth="0" ss:Width="60.75" ss:Span="2"/>
   <Column ss:AutoFitWidth="0" ss:Width="80"/>
   <Column ss:AutoFitWidth="0" ss:Width="80"/>
   <Column ss:AutoFitWidth="0" ss:Width="80"/>
   <Column ss:AutoFitWidth="0" ss:Width="80"/>
   <Column ss:Index="57" ss:StyleID="s70" ss:AutoFitWidth="0" ss:Width="75"/>
   <Row ss:AutoFitHeight="0" ss:Height="154.5" ss:StyleID="s71">
    <Cell ss:StyleID="s77"><Data ss:Type="String">Mã nhân viên</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s78"><Data ss:Type="String">Họ và Tên</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
     <Cell ss:StyleID="s81"><Data ss:Type="String">Loại hợp đồng&#10;1: Hợp đồng có thời hạn&#10;2: Thử việc&#10;3. Hợp đồng vô thời hạn&#10;5. Hợp đồng học việc&#10;6.Hợp đồng thời vụ&#10;7. HD có thời hạn 1 năm</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
   
    <Cell ss:StyleID="s80"><Data ss:Type="String">Ngày bắt đầu hợp đồng</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s80"><Data ss:Type="String">Ngày kết thúc  hợpđồng</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
   
    <Cell ss:StyleID="s82"><Data ss:Type="String">Cách tính lương&#10;1:Lương thời gian&#10;2:Lương thời gian không PIT&#10;3:Lương ngày + CN*1.5&#10;4:Lương ngày + CN*2</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s83"><Data ss:Type="String">Giờ làm/ngày</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s80"><Data ss:Type="String">Lương Bảo Hiểm = Lương CB hoặc =0&#10;(Nếu có cột này sẽ tính bảo hiểm, không thì ko tính)</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s84"><Data ss:Type="String">Lương CB</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s85"><Data ss:Type="String">Phụ cấp chức vụ</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s79"><Data ss:Type="String">Phụ cấp trách nhiệm</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s86"><Data ss:Type="String">Chuyên cần</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s79"><Data ss:Type="String">Kỹ luật tác phong</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s79"><Data ss:Type="String">Tiền cơm</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s79"><Data ss:Type="String">Xăng xe</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s85"><Data ss:Type="String">Điện thoại</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s85"><Data ss:Type="String">Nhà ở</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s85"><Data ss:Type="String">Thâm niên</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s85"><Data ss:Type="String">Thái độ phục vụ KH</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s85"><Data ss:Type="String">Bảo trì, bảo dưỡng xe</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
      <Cell ss:StyleID="s85"><Data ss:Type="String">Thưởng Kết quả hoàn thành công việc</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
      <Cell ss:StyleID="s85"><Data ss:Type="String">Thưởng đạt tiêu chí về kho của VNM</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
      <Cell ss:StyleID="s85"><Data ss:Type="String">Hiệu quả thu nợ</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
      <Cell ss:StyleID="s85"><Data ss:Type="String">Hiệu quả giao hàng</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s87"><Data ss:Type="String">Các ngày nghỉ trong tuần&#10;0:Nghỉ CN&#10;1:Nghỉ T7,CN&#10;2:Nghỉ 1/2 T7, CN&#10;10:Tính lương đặc biệt 26 ngày&#10;11:Tính lương không nghỉ&#10;12:Tính lương đặc biệt 30 ngày&#10;13:Nghỉ CN - Không tính công CN nếu có làm</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s80"><Data ss:Type="String">Loại lương&#10;0: Gross &#10;1: Net</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s80"><Data ss:Type="String">Không tính công ngày lễ</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s80"><Data ss:Type="String">Phí công đoàn0: No1: Yes</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
       <Cell ss:StyleID="s79"><Data ss:Type="String">Phòngban</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
      <Cell ss:StyleID="s77"><Data ss:Type="String">Tiền tệ</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s80"><Data ss:Type="String">Kích hoạt ngay hợpđồng chính &#10;0: No1: Yes</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s78"><Data ss:Type="String">Chức vụ</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s78"><Data ss:Type="String">Chức vụ (E)</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s78"><Data ss:Type="String">Chức vụ (Luật)</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s78"><Data ss:Type="String">Chức vụ  (Luật Tiếng Anh)</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
    <Cell ss:StyleID="s88"><Data ss:Type="String">Tạo lịch</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>
   </Row>	  
   ';
  

		if($this->ListEmp!="")
			{
				$strar=substr($this->ListEmp,0,strlen($this->ListEmp)-1);
				$strar=str_replace("@","','",$strar);
				$strar="'".$strar."'";
				$vCondition=" And lv001 in ($strar) ";
			}
		if($this->isLastCheck==1)
			$sqlS = " SELECT A.*,B.lv002 NameStaff FROM hr_lv0038 A inner join hr_lv0020 B on A.lv002=B.lv001  WHERE  1=1 ".$this->RptCondition."  order by A.lv002,A.lv004,A.lv005 ";
		else
			$sqlS = " SELECT A.*,B.lv002 NameStaff FROM hr_lv0038 A inner join hr_lv0020 B on A.lv002=B.lv001  WHERE  1=1 ".$this->RptCondition."  $strSort ";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$vEmpCheck='0000000000000000000000000';
		$lvTable1='';
		while ($vrow1 = db_fetch_array ($bResult)){

				
				if($this->isLastCheck==1)
				{
					if($vEmpCheck!=$vrow1['lv002'])
					{
						$lvTable=$lvTable.$lvTable1;
						$vEmpCheck=$vrow1['lv002'];
					}
				}
				else
					$lvTable=$lvTable.$lvTable1;
				$lvTable1='
				<Row ss:AutoFitHeight="0">
					<Cell ss:StyleID="s79"><Data ss:Type="String">'.$vrow1['lv002'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['NameStaff'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv003'].'</Data></Cell>
					
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$this->FormatView($vrow1['lv004'],2).'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$this->FormatView($vrow1['lv005'],2).'</Data></Cell>
					
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv012'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv007'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv021'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv022'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv013'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv014'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv026'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv016'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv018'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv020'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv025'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv023'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv031'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv032'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv033'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv034'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv035'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv036'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv037'].'</Data></Cell>

					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv011'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv019'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv017'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv015'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv010'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv024'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">1</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv027'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv028'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv029'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">'.$vrow1['lv030'].'</Data></Cell>
					<Cell ss:StyleID="s80"><Data ss:Type="String">1</Data></Cell>
				</Row>
				';
		}
		$lvTable=$lvTable.$lvTable1;
		$lvTable=$lvTable.'
		 </Table>
			  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
			   <PageSetup>
			    <Layout x:StartPageNumber="1"/>
			    <Header x:Margin="0.78749999999999998"
			     x:Data="&amp;C&amp;&quot;Times New Roman,Regular&quot;&amp;12&amp;A"/>
			    <Footer x:Margin="0.78749999999999998"
			     x:Data="&amp;C&amp;&quot;Times New Roman,Regular&quot;&amp;12Page &amp;P"/>
			    <PageMargins x:Bottom="1.0527777777777778" x:Left="0.78749999999999998"
			     x:Right="0.78749999999999998" x:Top="1.0527777777777778"/>
			   </PageSetup>
			   <Print>
			    <ValidPrinterInfo/>
			    <HorizontalResolution>300</HorizontalResolution>
			    <VerticalResolution>300</VerticalResolution>
			   </Print>
			   <Zoom>83</Zoom>
			   <Selected/>
			   <FreezePanes/>
			   <FrozenNoSplit/>
			   <SplitHorizontal>1</SplitHorizontal>
			   <TopRowBottomPane>1</TopRowBottomPane>
			   <ActivePane>2</ActivePane>
			   <Panes>
			    <Pane>
			     <Number>3</Number>
			     <ActiveCol>34</ActiveCol>
			    </Pane>
			    <Pane>
			     <Number>2</Number>
			     <ActiveRow>4</ActiveRow>
			     <ActiveCol>11</ActiveCol>
			    </Pane>
			   </Panes>
			   <ProtectObjects>False</ProtectObjects>
			   <ProtectScenarios>False</ProtectScenarios>
			   <EnableSelection>NoSelection</EnableSelection>
			  </WorksheetOptions>
			 </Worksheet>
			</Workbook>';
		return $lvTable;
		
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM hr_lv0038  WHERE hr_lv0038.lv001 IN ($lvarr) AND hr_lv0038.lv009<=0 ";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0038.delete',sof_escape_string($lvsql));
			$vArrHD=explode(",",$lvarr);
			foreach($vArrHD as $vHD)
			{
				$vHD=str_replace("'","",$vHD);
				$this->LV_LoadID($vHD);
				if($this->lv001==null)
				{
					$lvsql = "DELETE FROM tc_lv0010  WHERE lv010='$vHD'";
					$vReturn= db_query($lvsql);
				}
			}
		}
		
		return $vReturn;
	}	
	/////lv admin delete
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql="select A.*,B.lv029 DeptOld,C.lv001 CalID,C.lv004 StartDate,C.lv005 EndDate,C.lv011 StateW from hr_lv0038 A inner join hr_lv0020 B on A.lv002=B.lv001 left join tc_lv0013 C on C.lv007=year(A.lv004) and C.lv006=month(A.lv004)  WHERE A.lv001 IN ($lvarr) order by A.lv004";
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$lvsql = "Update hr_lv0038 set lv009=IF(lv009>2,2,lv009+1),lv101=IF(CURDATE()<lv004,lv101,IF(lv101>=1,2,lv101+1))  WHERE hr_lv0038.lv001 IN ('".$vrow['lv001']."')  ";
			$vReturn= db_query($lvsql);
			if($vReturn) 
			{
				$this->InsertLogOperation($this->DateCurrent,'hr_lv0038.approval',sof_escape_string($lvsql));
				if($vrow['lv009']=='0' && $vrow['lv003']=='1' )
				{
					$lvsql = "Update hr_lv0020 set lv009=0,lv081='".$vrow['lv004']."'  WHERE hr_lv0020.lv001='".$vrow['lv002']."' and lv009<>0";
					$vReturn= db_query($lvsql);
				}
				if($vrow['StateW']<=1)
				{
					$this->motc_lv0064->LV_ControlChangeDept($vrow['CalID'],$vrow['lv002'],$vrow['lv010'],$vrow['DeptOld'],$vrow['lv004'],$vrow['StartDate'],$vrow['EndDate']);
				}
			}
		}
		$this->LV_UpdateEmpState($lvarr);
		return $vReturn;
	}	
	function LV_AcceptPreActive()
	{
		$lvsql="select lv001,lv002,lv010,lv027,lv028,lv029,lv030 from  hr_lv0038 Where lv101='0' and lv101<>lv009 and lv004<=CurDate() ";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vID=$vrow['lv001'];
			$vDeptID=$vrow['lv010'];
			$vEmpID=$vrow['lv002'];	
			$vTitleVN=$vrow['lv027'];	
			$vTitleEN=$vrow['lv028'];	
			$vTitleLawVN=$vrow['lv029'];	
			$vTitleLawEN=$vrow['lv030'];	
	
			$lvsql = "Update hr_lv0020 set lv029='$vDeptID',lv005='$vTitleVN',lv060='$vTitleEN',lv061='$vTitleLawVN',lv067='$vTitleLawEN' where lv001='$vEmpID'";
			$vReturn= db_query($lvsql);
			$lvsql = "Update hr_lv0038 set lv101=lv009 where lv001='$vID'";
			$vReturn= db_query($lvsql);
		}
	}
	function LV_UpdateEmpState($lvarr)
	{
		$lvsql = "Update hr_lv0020 set lv009=0 WHERE hr_lv0020.lv009=1 and hr_lv0020.lv001 IN (select B.lv002 from hr_lv0038 B WHERE B.lv001 IN ($lvarr) and B.lv101=1 and B.lv003 <> '9')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0020.approval',sof_escape_string($lvsql));
		$lvsql = "Update hr_lv0020 set lv029=(select B.lv010 from hr_lv0038 B WHERE B.lv002=hr_lv0020.lv001 and B.lv001 IN ($lvarr) and B.lv101=1 and B.lv003 <> '9'),lv005=(select B.lv027 from hr_lv0038 B WHERE B.lv002=hr_lv0020.lv001 and B.lv001 IN ($lvarr) and B.lv101=1 and B.lv003 <> '9'),lv060=(select B.lv028 from hr_lv0038 B WHERE B.lv002=hr_lv0020.lv001 and B.lv001 IN ($lvarr) and B.lv101=1 and B.lv003 <> '9'),lv061=(select B.lv029 from hr_lv0038 B WHERE B.lv002=hr_lv0020.lv001 and B.lv001 IN ($lvarr) and B.lv101=1 and B.lv003 <> '9'),lv067=(select B.lv030 from hr_lv0038 B WHERE B.lv002=hr_lv0020.lv001 and B.lv001 IN ($lvarr) and B.lv101=1 and B.lv003 <> '9')  WHERE hr_lv0020.lv001 IN (select B.lv002 from hr_lv0038 B WHERE B.lv001 IN ($lvarr) and B.lv101=1 and B.lv003 <> '9')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0020.approval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update hr_lv0038 set lv009=IF(lv009<=0,0,lv009-1)  WHERE hr_lv0038.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0038.unapproval',sof_escape_string($lvsql));
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
	function GetEmployees($sqlS)
	{
		$lv_str="";
		$bResult = db_query($sqlS);
		while ($vrow = db_fetch_array ($bResult)){	
		$this->ArrStaff[$vrow['lv001']][0]=true;
		$this->ArrStaff[$vrow['lv001']][29]=$vrow['lv029'];
		$this->ArrStaff[$vrow['lv001']][30]=$vrow['lv030'];
			if($lv_str=="")
				$lv_str=$vrow['lv001'];
			else
				$lv_str=$lv_str."','".$vrow['lv001'];
		}
		$lv_str="'".$lv_str."'";
		return $lv_str;
	}
	//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi="";
		if($this->FullName!="")
		{	
			$vArrName=explode(",",$this->FullName);
			foreach($vArrName as $vName)
			{
				if($vName!="")
				{
				if($strCondi=="")	
					$strCondi= " AND ( B.lv002  like '%$vName%'";
				else
					$strCondi=$strCondi." OR B.lv002  like '%$vName%'";		
				}
			}
			$strCondi=$strCondi.")";
			
		}
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001 like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002 = '$this->lv002'";
		if($this->DepID!="")
		{
			$vListEmp=$this->GetEmployees("select DD.lv001,DD.lv029,DD.lv030 from hr_lv0020 DD where DD.lv009 not in ('2','3') and DD.lv029 in (".$this->LV_GetChildDep($this->DepID).")");
			$strCondi=$strCondi." and A.lv002 in ($vListEmp)";
		}
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003 like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004 like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005 like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006 like '%$this->lv006%'";
		if($this->lv007!="") $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="") $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="") $strCondi=$strCondi." and A.lv010 = '$this->lv010'";
		if($this->lv011!="") $strCondi=$strCondi." and A.lv011 like '%$this->lv011%'";
		if($this->lv012!="") $strCondi=$strCondi." and A.lv012 like '%$this->lv012%'";
		if($this->lv013!="") $strCondi=$strCondi." and A.lv013 like '%$this->lv013%'";
		if($this->lv014!="") $strCondi=$strCondi." and A.lv014 like '%$this->lv014%'";
		if($this->lv015!="") $strCondi=$strCondi." and A.lv015 like '%$this->lv015%'";
		if($this->lv016!="") $strCondi=$strCondi." and A.lv016 like '%$this->lv016%'";
		if($this->lv017!="") $strCondi=$strCondi." and A.lv017 like '%$this->lv017%'";
		if($this->lv018!="") $strCondi=$strCondi." and A.lv018 like '%$this->lv018%'";
		if($this->lv019!="") $strCondi=$strCondi." and A.lv019 like '%$this->lv019%'";
		if($this->lv020!="") $strCondi=$strCondi." and A.lv020 like '%$this->lv020%'";
		if($this->lv021!="") $strCondi=$strCondi." and A.lv021 = '$this->lv021'";
		if($this->lv022!="") $strCondi=$strCondi." and A.lv022 = '$this->lv022'";
		return $strCondi;
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
	public function GetBuilCheckListDep($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
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
		$vsql="select * from  ".$vTbl." where lv002='SOF' order by lv103 asc";
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
						$vsql1="select * from  ".$vTbl." where lv002='".$vrow['lv001']."' order by lv003";
						$vresult1=db_query($vsql1);
						$numrows=$numrows+db_num_rows($vresult1);
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
							$strTemp=str_replace("@#02",'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
							$strGetScript=$strGetScript.$strTemp;
							$i++;
							$vsql2="select * from  ".$vTbl." where lv002='".$vrow1['lv001']."' order by lv003";
							$vresult2=db_query($vsql2);
							$numrows=$numrows+db_num_rows($vresult2);
							while($vrow2=db_fetch_array($vresult2))		
							{
								$strTempChk=str_replace("@01",$i,$lvChk);
								$strTempChk=str_replace("@02",$vrow2['lv001'],$strTempChk);
								if(strpos($vListID,",".$vrow2['lv001'].",") === FALSE)
									$strTempChk=str_replace("@03","",$strTempChk);
								else
									$strTempChk=str_replace("@03","checked=checked",$strTempChk);
								
								$strTempChk=str_replace("@04",'&nbsp;&nbsp;&nbsp;'.$vrow2['lv003'],$strTempChk);
								
								$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
								$strTemp=str_replace("@#02",'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$vrow2[$vFieldView]."(".$vrow2['lv001'].")",$strTemp);
								$strGetScript=$strGetScript.$strTemp;
								$i++;
								$vsql3="select * from  ".$vTbl." where lv002='".$vrow2['lv001']."' order by lv003";
								$vresult3=db_query($vsql3);
								$numrows=$numrows+db_num_rows($vresult3);
								while($vrow3=db_fetch_array($vresult3))		
								{
									$strTempChk=str_replace("@01",$i,$lvChk);
									$strTempChk=str_replace("@02",$vrow3['lv001'],$strTempChk);
									if(strpos($vListID,",".$vrow3['lv001'].",") === FALSE)
										$strTempChk=str_replace("@03","",$strTempChk);
									else
										$strTempChk=str_replace("@03","checked=checked",$strTempChk);
									
									$strTempChk=str_replace("@04",'&nbsp;&nbsp;&nbsp;'.$vrow3['lv003'],$strTempChk);
									
									$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
									$strTemp=str_replace("@#02",'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$vrow3[$vFieldView]."(".$vrow3['lv001'].")",$strTemp);
									$strGetScript=$strGetScript.$strTemp;
									$i++;
									
								}
							}
						}
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM hr_lv0038 A WHERE  1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_GetSalary($vEmpID,$vYear,$vMonth)
	{
		$vslq="select sum(A.lv050) SalaryMoney from tc_lv0021 A inner join tc_lv0013 B on A.lv060=B.lv001 where A.lv002='$vEmpID' and B.lv006='$vMonth' and B.lv007='$vYear'";
		$bResultC = db_query($vslq);
		$arrRowC = db_fetch_array($bResultC);
		if($arrRowC['SalaryMoney']==0) return '&nbsp;';
		return $arrRowC['SalaryMoney'];
	}
	function LV_GetBonus($vEmployeeID,$vContractLaborID)
	{
		$vslq="select sum(A.lv005) Bonus from hr_lv0042 A where A.lv002='$vEmployeeID' and A.lv003='$vContractLaborID'";
		$bResultC = db_query($vslq);
		$arrRowC = db_fetch_array($bResultC);
		if($arrRowC['Bonus']==0) return '&nbsp;';
		return $arrRowC['Bonus'];
	}
	function LV_GetSalaryIncrease($vEmpID,$vShowLuong=0)
	{
		$vMinDate='2015-01-01';
		$vMaxDate=$this->DateCurrent;
		$cM=getmonth($vMaxDate);
		$cY=getyear($vMaxDate);
		$vArrContractBuild=Array();
		$vTable='
		<table id="bmtangluong" style="width: 1000px;" class="tblprint" id="tabletc" border="1" cellpadding="0" cellspacing="0">
			<colgroup>
				<col width="7%"></col> 
				<col width="5%"></col>
				<col width="10%"></col>
				<col width="10%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="10%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
				<col width="5%"></col> 
			</colgroup> 
			<tbody>
				<tr height="21">
					<td class="lvhtable" rowspan="2" height="42" >Tháng /Năm</td>
					<td class="lvhtable" rowspan="2">Mã NV</td>
					<td class="lvhtable" rowspan="2">Tên NV</td>
					<td class="lvhtable" rowspan="2">PHÒNG BAN</td>
					<td class="lvhtable" colspan="4">Hợp đồng</td>
					<td class="lvhtable" colspan="15">LƯƠNG</td>
					<td class="lvhtable" colspan="2">CHỨC VỤ</td>
					<td class="lvhtable" rowspan="2">Lương thực lãnh</td>
					</tr>
					<tr>
						<td class="lvhtable">Ngày ký HĐ</td>
						<td class="lvhtable">Ngày hết hạn HĐ</td>
						<td class="lvhtable">MaHĐ</td>
						<td class="lvhtable">Trạng thái</td>
						<td class="lvhtable" align=center>Lương BH</td>
						<td class="lvhtable" align=center>Lương CB</td>
						<td class="lvhtable" align=center>Hiểu quả CV (ABC)</td>
						<td class="lvhtable" align=center>Tiền ăn ca</td>
						<td class="lvhtable" align=center>Trợ cấp điện thoại</td>
						<td class="lvhtable" align=center>Trợ cấp nhà trọ</td>
						<td class="lvhtable" align=center>Công tác phí</td>
						<td class="lvhtable" align=center>Xăng xe</td>
						<td class="lvhtable" align=center>Phụ cấp trách nhiệm</td>
						<td class="lvhtable" align=center>Phụ cấp công trình</td>
						<td class="lvhtable" align=center>Phụ cấp khác </td>
						<td class="lvhtable" align=center>Lương</td>
						<td class="lvhtable" align=center>Tổng lương(1)</td>
						<td class="lvhtable" align=center>Tổng lương(2)</td>
						<td class="lvhtable" align=center>Tăng lương</td>
						<td class="lvhtable" align=center>Chức vụ VN</td>
						<td class="lvhtable" align=center>Chức vụ EN</td>
					</tr>
					<tr>
						<td align=center>01</td>
						<td align=center>02</td>
						<td align=center>03</td>
						<td align=center>04</td>
						<td align=center>05</td>
						<td align=center>06</td>
						<td align=center>07</td>
						<td align=center>08</td>
						<td align=center>09</td>
						<td align=center>10</td>
						<td align=center>11</td>
						<td align=center>12</td>
						<td align=center>13</td>
						<td align=center>14</td>
						<td align=center>15</td>
						<td align=center>16</td>
						<td align=center>17</td>
						<td align=center>18</td>
						<td align=center>19</td>
						<td align=center>20</td>
						<td align=center>21</td>
						<td align=center>22</td>
						<td align=center>23</td>
						<td align=center>24</td>
						<td align=center>25</td>
						<td align=center>26</td>
					</tr>
					@01
			</tbody>
		</table>';
		$vTrTitle='
			<tr>
				<td colspan="26">
				<font style="font:bold 18px Arial,tahoma;">Năm @01 <input style="border:0px #fff solid;background:#fff;color:red;font:20px Arial,Tahoma;" title="Click vào đây để ẩn/hiện" onclick="AnHienNam(@01)" type="button" name="@01" id="@01" value="@02"/></font>
				</td>
			</tr>
		';
		$vTrStr='
		<tr style="background-color:@@01;@02" height="21">
			<td style="padding:3px" align="left">@#01</td>
			<td style="padding:3px" align="center">@#02</td>
			<td style="padding:3px" align="left">@#16</td>
			<td style="padding:3px" align="left">@#03</td>
			<td style="padding:3px" align="right">@#04</td>		
			<td style="padding:3px" align="right">@#05</td>
			<td style="padding:3px" align="right">@#06</td>
			<td style="padding:3px" align="right">@#07</td>
			<td style="padding:3px" align="right">@#08</td>
			<td style="padding:3px" align="right">@#09</td>
			<td style="padding:3px" align="right">@#10</td>
			<td style="padding:3px" align="right">@#11</td>
			<td style="padding:3px" align="right">@#12</td>
			<td style="padding:3px" align="right">@#13</td>
			<td style="padding:3px" align="right">@#14</td>
			<td style="padding:3px" align="right">@#15</td>
			<td style="padding:3px" align="right">@#17</td>
			<td style="padding:3px" align="right">@#18</td>
			<td style="padding:3px" align="right">@#19</td>
			<td style="padding:3px" align="right">@#20</td>
			<td style="padding:3px" align="right">@#21</td>
			<td style="padding:3px" align="right">@#22</td>
			<td style="padding:3px" align="right">@#23</td>
			<td style="padding:3px" align="right">@#24</td>
			<td style="padding:3px" align="right">@#25</td>
			<td style="padding:3px" align="right">@#26</td>
		</tr>
';
		$lvsql="
		SELECT MP.* FROM (
			select IF(A.lv100=1,CURDATE(),A.lv004) DateS,A.lv100 IsActive,ADDDATE(A.lv005,1) DateE,A.lv001,A.lv003,A.lv004,A.lv005,A.lv009,A.lv010,A.lv021,A.lv022,A.lv013,A.lv014,A.lv026,A.lv016,A.lv018,A.lv020,A.lv023,A.lv024,A.lv025,A.lv027,A.lv028,A.lv031,A.lv032,A.lv033 from hr_lv0038 A where A.lv002='".$vEmpID."' $vCondition
			UNION
			select B.lv004 DateS,A.lv100 IsActive,ADDDATE(A.lv005,1) DateE,A.lv001,A.lv003,A.lv004,A.lv005,A.lv009,IF(B.lv003='DOICVPB' OR B.lv003='DOIPHONGBAN',B.lv006,A.lv010) lv010,A.lv021,A.lv022,A.lv013,A.lv014,A.lv026,A.lv016,A.lv018,A.lv020,A.lv023,A.lv024,A.lv025,B.lv010 lv027,B.lv011 lv028,A.lv031,A.lv032,A.lv033 from hr_lv0038 A inner join hr_lv0098 B on B.lv099=A.lv001 where A.lv002='".$vEmpID."' $vCondition
		) MP order by MP.DateS ASC";
		$vresult=db_query($lvsql);
		$vArrContractSave=Array();
		$vPre=0;
		$isFirst=false;
		$vCodeFirst='';
		$vArrHD=Array();
		$vACot3=Array();
		$vACot7=Array();
		$vNameVN=$this->getvaluelink('lv110',$vEmpID);
		while($vrow=db_fetch_array($vresult))
		{
			if($vrow['IsActive']==1 && $vArrHD[0]!=$vrow['lv001'] )
			{
				if($vArrHD!=NULL)
				{
					if($vArrHD[1]<$vrow['DateS'])
					{
						$vdatefrom=$vArrHD[1];
					}
					else
						$vdatefrom=$vrow['DateS'];
				}
				else
				{
					if($vMinDate>$vrow['lv004'])
						$vdatefrom=$vMinDate;
					else
						$vdatefrom=$vrow['lv004'];
				}
			}
			else
			{
				if($vMinDate>$vrow['DateS'])
				{
					$vdatefrom=$vMinDate;
				}
				else
					$vdatefrom=$vrow['DateS'];
			}
			$vArrHD[0]=$vrow['lv001'];
			$vArrHD[1]=$vrow['DateE'];
			$vYearS=getyear($vdatefrom);
			$vYearE=getyear($vMaxDate);
			$vYMin=getyear($vMinDate);
			if($vYearS<$vYMin) $vYearS=$vYMin;
			for($y=$vYearS;$y<=$vYearE;$y++)
			{
				if($y==$vYearS)
				{
					$vMonthS=(int)getmonth($vdatefrom);
				}
				else
					$vMonthS=1;
				if($y==$cY) 
					$vMonthE=$cM;
				else 
					$vMonthE=12;
				for($m=$vMonthS;$m<=$vMonthE;$m++)
				{
					$stt=$y.'-'.Fillnum($m,2);
					$this->datefrom=$y.'-'.Fillnum($m,2).'-01';
					$this->dateto=$y.'-'.Fillnum($m,2)."-".GetDayInMonth($y,$m);	
					$vArrContractBuild[$stt]['y']=$y;
					$vArrContractBuild[$stt]['m']=$m;
					$vArrContractBuild[$stt]['cot1']=Fillnum($m,2).'-'.$y;
					$vArrContractBuild[$stt]['cot2']=$vEmpID;
					if($vACot3[$vrow['lv010']][0]==true)
						$vArrContractBuild[$stt]['cot3']=$vACot3[$vrow['lv010']][1];
					else
					{
						$vACot3[$vrow['lv010']][1]=$this->getvaluelink('lv010',$vrow['lv010']);
						$vACot3[$vrow['lv010']][0]=true;
						$vArrContractBuild[$stt]['cot3']=$vACot3[$vrow['lv010']][1];
					}
					$vArrContractBuild[$stt]['cot4']=$this->FormatView($vrow['DateS'],2);
					$vArrContractBuild[$stt]['cot5']=$this->FormatView($vrow['lv005'],2);
					$vArrContractBuild[$stt]['cot6']=$vrow['lv001'];
					if($vACot7[$vrow['lv009']][0]==true)
						$vArrContractBuild[$stt]['cot7']=$vACot7[$vrow['lv009']][1];
					else
					{
						$vACot7[$vrow['lv009']][1]=$this->getvaluelink('lv009',$vrow['lv009']);
						$vACot7[$vrow['lv009']][0]=true;
						$vArrContractBuild[$stt]['cot7']=$vACot7[$vrow['lv009']][1];
					}
					$vArrContractBuild[$stt]['cot8']=$this->FormatView($vrow['lv021'],10);
					$vArrContractBuild[$stt]['cot9']=$this->FormatView($vrow['lv022'],10);
					//Cot moi
					//ngonngu
					$vArrContractBuild[$stt]['cot82']=$vrow['lv013'];
					//vitinh
					$vArrContractBuild[$stt]['cot83']=$vrow['lv014'];
					//Tham nien
					$vArrContractBuild[$stt]['cot84']=$vrow['lv026'];
					//Chuyên môn
					$vArrContractBuild[$stt]['cot85']=$vrow['lv016'];
					//Kỹ Thuật
					$vArrContractBuild[$stt]['cot86']=$vrow['lv018'];
					//Chức vụ
					$vArrContractBuild[$stt]['cot87']=$vrow['lv020'];
					//TCGT
					$vArrContractBuild[$stt]['cot88']=$vrow['lv025'];
					//TCSH
					$vArrContractBuild[$stt]['cot89']=$vrow['lv023'];
					//Môi trường
					$vArrContractBuild[$stt]['cot90']=$vrow['lv031'];
					//Chuyên cần
					$vArrContractBuild[$stt]['cot91']=$vrow['lv032'];
					//PC tiền cơm
					$vArrContractBuild[$stt]['cot92']=$vrow['lv033'];
					//END cot moi
					$vTongCongLuong=($vrow['lv022']+$vrow['lv013']+$vrow['lv014']+$vrow['lv026']+$vrow['lv016']+$vrow['lv018']+$vrow['lv020']+$vrow['lv025']+$vrow['lv023']+$vrow['lv031']+$vrow['lv032']);
					$vTongCongLuong2=$vrow['lv033'];
					$vArrContractBuild[$stt]['cot11']=$this->FormatView($vTongCongLuong,10);
					if($isFirst==false )
					{
						$isFirst=true;
						$vArrContractBuild[$stt]['cot12']='&nbsp;';
						$vCodeFirst=$stt;
					}
					else
					{
						if($vCodeFirst==$stt)
						{
							$vArrContractBuild[$stt]['cot12']='&nbsp;';
						}
						else
							$vArrContractBuild[$stt]['cot12']=($vPre<=0)?'&nbsp;':((($vTongCongLuong2)!=$vPre)?$this->FormatView((($vTongCongLuong2)-$vPre),10):'&nbsp');
					}
					$vArrContractBuild[$stt]['cot24']=$vrow['lv027'];
					$vArrContractBuild[$stt]['cot25']=$vrow['lv028'];
					$vArrContractBuild[$stt]['cot26']='&nbsp;';
					$vPre=$vTongCongLuong2;
				}
		
			}			
			$vPre=$vTongCongLuong2;		
		}
		$vCurY=0;
		$vNY=getyear($this->DateCurrent);
		foreach($vArrContractBuild as $vArrContract)
		{
			$y=$vArrContract['y'];
			if($vCurY!=$y)
			{		
				$vTitleN=str_replace("@01",$y,$vTrTitle);
				$vTitleN=str_replace("@02",(($vNY==$y)?'-':'+'),$vTitleN);
				$lvListTrAll=$lvListTrAll.$vTitleN;
				$vCurY=$y;
			}
			$LineTrStr=str_replace("@02",($vNY==$y)?'displays:none':'display:none',str_replace("@01",$vCurY,$vTrStr));
			$LineTrStr=str_replace("@#01",$vArrContract['cot1'],$LineTrStr);
			$LineTrStr=str_replace("@#02",$vArrContract['cot2'],$LineTrStr);
			$LineTrStr=str_replace("@#03",$vArrContract['cot3'],$LineTrStr);
			$LineTrStr=str_replace("@#04",$vArrContract['cot4'],$LineTrStr);
			$LineTrStr=str_replace("@#05",$vArrContract['cot5'],$LineTrStr);
			$LineTrStr=str_replace("@#06",$vArrContract['cot6'],$LineTrStr);
			$LineTrStr=str_replace("@#07",$vArrContract['cot7'],$LineTrStr);
			$LineTrStr=str_replace("@#08",$vArrContract['cot8'],$LineTrStr);
			$LineTrStr=str_replace("@#09",$vArrContract['cot9'],$LineTrStr);
			$LineTrStr=str_replace("@#10",$vArrContract['cot10'],$LineTrStr);
			$LineTrStr=str_replace("@#11",$this->FormatView($vArrContract['cot82'],10),$LineTrStr);
			$LineTrStr=str_replace("@#12",$this->FormatView($vArrContract['cot83'],10),$LineTrStr);
			$LineTrStr=str_replace("@#13",$this->FormatView($vArrContract['cot84'],10),$LineTrStr);
			$LineTrStr=str_replace("@#14",$this->FormatView($vArrContract['cot85'],10),$LineTrStr);
			$LineTrStr=str_replace("@#15",$this->FormatView($vArrContract['cot86'],10),$LineTrStr);
			$LineTrStr=str_replace("@#16",$this->FormatView($vArrContract['cot87'],10),$LineTrStr);
			$LineTrStr=str_replace("@#17",$this->FormatView($vArrContract['cot88'],10),$LineTrStr);
			$LineTrStr=str_replace("@#18",$this->FormatView($vArrContract['cot89'],10),$LineTrStr);
			$LineTrStr=str_replace("@#19",$this->FormatView($vArrContract['cot90'],10),$LineTrStr);
			$LineTrStr=str_replace("@#20",$this->FormatView($vArrContract['cot91'],10),$LineTrStr);
			$LineTrStr=str_replace("@#21",$this->FormatView($vArrContract['cot92'],10),$LineTrStr);
			$LineTrStr=str_replace("@#22",$vArrContract['cot11'],$LineTrStr);
			$LineTrStr=str_replace("@#23",$vArrContract['cot12'],$LineTrStr);			
			$LineTrStr=str_replace("@#24",$vArrContract['cot24'],$LineTrStr);
			$LineTrStr=str_replace("@#25",$vArrContract['cot25'],$LineTrStr);
			
			if($vShowLuong==1)
				$LineTrStr=str_replace("@#26",$this->FormatView($this->LV_GetSalary($vEmpID,$vArrContract['y'],$vArrContract['m']),20),$LineTrStr);	
			else
				$LineTrStr=str_replace("@#26",$vArrContract['cot15'],$LineTrStr);
			$LineTrStr=str_replace("@#16",$vNameVN,$LineTrStr);
			
			$lvListTrAll=$lvListTrAll.$LineTrStr;
		}
		
		
		return str_replace("@01",$lvListTrAll,$vTable);
	}
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
			<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyPress=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>
			@#01
		</tr>
		";
		$lvHref="<a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT A.*,A.lv002 lv110 FROM hr_lv0038 A inner join hr_lv0020 B on A.lv002=B.lv001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow,$maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strTr = '';
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
					case 'lv199':
						$vChucNang="<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
						<tr>
						";
						//$vChucNang=$vChucNang.'<td><a href="'.$this->LinkQR.'" target="_blank">QR</a><td>';
						$vChucNang=$vChucNang.'<td><span onclick="ProcessTextHidenMore(this)"><a href="javascript:FunctRunning1(\''.$vrow['lv001'].'\')"><img style="cursor:pointer;width:25px;;padding:5px;"  alt="NoImg" src="../images/icon/work_experience.png" align="middle" border="0" name="new" class="lviconimg"></a></span></td>';
						if($this->GetEdit()==1 && $vrow['lv009']==0)
						{
							$vChucNang=$vChucNang.'
							<td><img Title="'.(($vrow['lv009']==0)?'Edit':'View').'" style="cursor:pointer;width:25px;padding:5px;" onclick="Edit(\''.($vrow['lv001']).'\')" alt="NoImg" src="../images/icon/'.(($vrow['lv009']==0)?'Edt.png':'detail.png').'" align="middle" border="0" name="new" class="lviconimg"></td>
							';
						}
						if($this->GetApr()==1 && $vrow['lv009']<2)
						{
							$vChucNang=$vChucNang.'<td><input type="button" value="'.(($vrow['lv009']==1)?'Khoá 	2':'Khoá').'" style="padding:3px;border-radius:3px;font-weight:bold;cursor:pointer;" onclick="Approvals(\''.$vrow['lv001'].'@\')"/></td>';
						}
						if($this->GetUnApr()==1 && $vrow['lv009']>0)
						{
							$vChucNang=$vChucNang.'<td><input type="button" value="Mở khoá" style="padding:3px;border-radius:3px;font-weight:bold;cursor:pointer;" onclick="UnApprovals(\''.$vrow['lv001'].'@\')"/></td>';
						}
						
						$vChucNang=$vChucNang."</tr></table>";
						//$vTemp=str_replace("@02",$vChucNang,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));		
						$vTemp = str_replace("@02", $vChucNang, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						
						break;
						break;
					case 'lv100':
						$vBonus=$this->LV_GetBonus($vrow['lv002'],$vrow['lv001']);
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vBonus,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				$strL=$strL.$vTemp;
			
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv009']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
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
			window.open('$this->Dir'+'hr_lv0038/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
		}
		function ExportMore(vFrom,value,isLastCheck)
		{
			window.open('$this->Dir'+'hr_lv0038/?lang=".$this->lang."&childfunc='+value+'&isLastCheck='+isLastCheck+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
	//////////////////////Buil list////////////////////
	function LV_BuilListReportView($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
		<div align=\"left\"><h1>".($this->ArrPush[0])."</h2></div>
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
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT A.*,A.lv002 lv110 FROM hr_lv0038 A WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				if($lstArr[$i]=='lv100')
				{
					$vBonus=$this->LV_GetBonus($vrow['lv002'],$vrow['lv001']);
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vBonus,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
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
	function LV_BuilListReport($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		$sExport=$_GET['childfunc'];
		if ($sExport == "excel") {
				$this->ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"2","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"0","lv016"=>"0","lv017"=>"0","lv018"=>"0","lv019"=>"0","lv020"=>"0","lv021"=>"0","lv022"=>"0","lv023"=>"0","lv024"=>"0","lv025"=>"0","lv026"=>"0","lv027"=>"0","lv028"=>"0","lv110"=>"0");		
				
		}
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
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT A.*,A.lv002 lv110 FROM hr_lv0038 A inner join hr_lv0020 B on A.lv002=B.lv001 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
				if($lstArr[$i]=='lv002')
				{
					if ($sExport == "excel") {
					$vTemp=str_replace("@02",'<Data ss:Type="String">="'.$vrow[$lstArr[$i]].'"</Data>',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
					else
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=='lv100')
				{
					$vBonus=$this->LV_GetBonus($vrow['lv002'],$vrow['lv001']);
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vBonus,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	//Điều khiển đổi phòng ban
	function LV_ControlChangeDept($vCalID,$vStaffID,$vDepNewID,$vDepOldID,$vDateChange,$vStartDate,$vEndDate)
	{
		//Xác định phòng ban hiện tại và phòng ban mới có đổi không
		if($vDepNewID!=$vDepOldID)
		{
			//Nếu đổi thì xứ lý các vấn đề sau.
			//Kiểm tra xem phòng ban chưa tạo thì tạo
			//echo "$vCalID,$vStaffID,$vDepNewID,$vDateChange";
			$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepNewID,$vDateChange,3);
			if($vCheckExist=='')
			{
				$this->lv002=$vCalID;
				$this->lv003=$vStaffID;
				$this->lv004=$vDepNewID;
				$this->lv008=$vDateChange;
				$this->lv009=$vEndDate;
				$vReturn=$this->LV_InsertAutoNoDate();//Tạo cho đổi phòng ban mới
				//Kiểm tra tồn tại đổi phòng ban
				//xem nhan vien do co chua?
				$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepOldID,$vStartDate,1);
				if(getday($vDateChange)!=1) $vDateChange=ADDDATE($vDateChange,-1);
				if($vCheckExist=='')
				{
					$this->lv002=$vCalID;
					$this->lv003=$vStaffID;
					$this->lv004=$vDepOldID;
					$this->lv008=$vStartDate;
					$this->lv009=$vDateChange;
					$this->LV_InsertAutoNoDate();
				}
				else
				{
					$this->lv001=$vCheckExist;
					$this->lv002=$vCalID;
					$this->lv003=$vStaffID;
					$this->lv004=$vDepOldID;
					$this->lv008=$vStartDate;
					$this->lv009=$vDateChange;
					$this->LV_UpdateNoDate();
				}
			}	
			else
			{
				//Nếu co trong day
				$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepNewID,$vDateChange,1);
				if($vCheckExist=='')
				{
					$this->lv002=$vCalID;
					$this->lv003=$vStaffID;
					$this->lv004=$vDepNewID;
					$this->lv008=$vDateChange;
					$this->lv009=$vEndDate;
					$vReturn=$this->LV_InsertAutoNoDate();//Tạo cho đổi phòng ban mới
					//Kiểm tra tồn tại đổi phòng ban
					$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepOldID,$vStartDate,1);
					if(getday($vDateChange)!=1) $vDateChange=ADDDATE($vDateChange,-1);
					if($vCheckExist=='')
					{
						$this->lv002=$vCalID;
						$this->lv003=$vStaffID;
						$this->lv004=$vDepOldID;
						$this->lv008=$vStartDate;
						$this->lv009=$vDateChange;
						$this->LV_InsertAutoNoDate();
					}
					else
					{
						$this->lv001=$vCheckExist;
						$this->lv002=$vCalID;
						$this->lv003=$vStaffID;
						$this->lv004=$vDepOldID;
						$this->lv008=$vStartDate;
						$this->lv009=$vDateChange;
						$this->LV_UpdateNoDate();
					}
				}	
				else
				{
					//Kiểm tra tồn tại đổi phòng ban cũ, nếu chưa có tạo
					$vCheckExistTemp=$vCheckExist;
					$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepOldID,$vStartDate,2);
					if($vCheckExist=='')
					{
						$this->lv001=$vCheckExistTemp;
						$this->lv002=$vCalID;
						$this->lv003=$vStaffID;
						$this->lv004=$vDepOldID;
						$this->lv008=$vStartDate;
						$this->lv009=$vDateChange;
						$this->LV_UpdateNoDate();
					}
					
				}
				
			}
			//xét có tồn tại phòng ban đã đổi chưa, chưa thì chọn vào.
			//Nếu có tồn tại, thì xem có trùng lắp thời gian không, nếu không thì chèn vào, nếu có thì sửa lại
		}
		else
		{
			//Kiểm tra xem phòng ban chưa tạo thì tạo
			$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepNewID,$vStartDate,1);
			if($vCheckExist=='')
			{
				$this->lv002=$vCalID;
				$this->lv003=$vStaffID;
				$this->lv004=$vDepNewID;
				$this->lv008=$vStartDate;
				$this->lv009=$vEndDate;
				$this->LV_InsertAutoNoDate();
			}	
		}
		

	}
	function LV_CheckExistChange($vCalID,$vStaffID,$vDeptID,$vDateChange,$vOpt=0)
	{
		if($vOpt==0)
			$sqlC = "SELECT lv001 FROM tc_lv0064 WHERE lv002='$vCalID' and lv003='$vStaffID'  and lv008='$vDateChange'";
		elseif($vOpt==2)
			$sqlC = "SELECT lv001 FROM tc_lv0064 WHERE lv002='$vCalID' and lv003='$vStaffID' and lv004='$vDeptID'  and lv008='$vDateChange'";
		elseif($vOpt==3)
			$sqlC = "SELECT lv001 FROM tc_lv0064 WHERE lv002='$vCalID' and lv003='$vStaffID'";
		else
			$sqlC = "SELECT lv001 FROM tc_lv0064 WHERE lv002='$vCalID' and lv003='$vStaffID'  and lv004='$vDeptID'";
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		if($arrRowC)
		return $arrRowC['lv001'];
		return '';
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
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003,lv003 tangdan from  hr_lv0039 order by tangdan asc";
				break;			
			case 'lv020':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0043 where lv004=0";
				break;			
			case 'lv010':
				$vsql="select lv001,CONCAT(lv003,'[',lv002,']') lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0041";
				break;
			case 'lv012':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0032";
				break;
			case 'lv024':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 order by lv004";
				break;
			case 'lv099':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0038 where lv002='$this->lv002'";
				break;
			case 'lv299':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ki_lv0003";
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv110':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0039 where lv001='$vSelectID'";	
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tm_lv0001 where lv001='$vSelectID'";	
				$lvopt=1;
				break;
			case 'lv010':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 where lv001='$vSelectID'";	
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0041 where lv001='$vSelectID'";	
				break;
			case 'lv012':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0032 where lv001='$vSelectID'";	
				break;
			case 'lv024':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 where lv001='$vSelectID'";	
				break;
			case 'lv299':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ki_lv0003 where lv001='$vSelectID'";
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
		{	$lvopt = 0;
			$lvResult = db_query($vsql);
			while($row= db_fetch_array($lvResult)){
			return ($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
		}
		}
		
	}
}
?>